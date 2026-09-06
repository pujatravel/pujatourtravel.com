# 10 — Security Specifications & Hardening Guidelines
# Puja Tour Travel Website

> Dokumen ini mendefinisikan standar keamanan siber (*cybersecurity*), arsitektur pertahanan berlapis (*Defense in Depth*), mitigasi ancaman (*Threat Modeling*), proteksi data pribadi wisatawan (*PII*), pengamanan berkas unggahan, serta konfigurasi pengerasan (*hardening*) server dan aplikasi Puja Tour Travel.
> Seluruh pengembang dan AI Agent wajib mematuhi panduan ini dalam setiap tahap penulisan kode, perancangan API, konfigurasi middleware Laravel, dan penerapan lingkungan produksi.

---

# 1. Prinsip Dasar & Model Ancaman (*Threat Modeling*)

### 1.1 Prinsip Desain Keamanan (*Core Security Principles*)
1. **Defense in Depth**: Menerapkan perlindungan berlapis di setiap tingkatan (jaringan, web server Nginx, middleware Laravel, Form Request, model Eloquent, hingga basis data MySQL).
2. **Klien Tidak Terpercaya (*Client Is Untrusted*)**: Seluruh data yang datang dari browser, input formulir, parameter URL, headers, dan cookies wajib dianggap dapat dimanipulasi oleh penyerang.
3. **Hak Istimewa Terendah (*Principle of Least Privilege*)**: Setiap aktor, akun admin, proses server, dan user basis data hanya diberikan hak akses minimum yang mutlak dibutuhkan.
4. **Gagal Secara Aman (*Fail Securely*)**: Jika otentikasi atau otorisasi gagal, sistem wajib menolak akses secara default (*deny by default*) dan mengembalikan respon error generik tanpa membocorkan rincian sistem internal.
5. **Paparan Data Minimal (*Data Minimization & Least Exposure*)**: Sistem hanya mengumpulkan, menyimpan, dan mengembalikan data yang benar-benar esensial bagi operasional perjalanan wisata.

### 1.2 Model Ancaman & Batas Kepercayaan (*Trust Boundaries*)
```text
                         [ INTERNET PUBLIK ]
                                 │
                 (Ancaman: Bot Spam, Scraping, DDoS)
                                 ▼
                     ┌───────────────────────┐
                     │ HTTPS / Nginx Reverse │ (Firewall, TLS, Rate Limit,
                     │         Proxy         │  Security Headers)
                     └───────────┬───────────┘
                                 │
                (Ancaman: XSS, CSRF, Parameter Tampering)
                                 ▼
                     ┌───────────────────────┐
                     │  Laravel Application  │ (Auth Guard, Middleware, Form
                     │        Backend        │  Request, Sanitasi Input)
                     └───────────┬───────────┘
                                 │
                 (Ancaman: SQL Injection, Data Breach, IDOR)
                                 ▼
                     ┌───────────────────────┐
                     │ Private MySQL 8 &     │ (Encrypted at Rest, Localhost/
                     │ Storage Directory     │  Private Network, No Direct Ext Access)
                     └───────────────────────┘
```

---

# 2. Otentikasi, Manajemen Sesi, & Akses Admin

### 2.1 Penyimpanan & Hashing Kata Sandi
- Kata sandi admin **wajib** di-hash menggunakan algoritma modern standar industri (Bcrypt dengan cost factor minimal 12 atau Argon2id).
- **Larangan Keras**: Dilarang menggunakan MD5, SHA1, SHA256 biasa, atau menyimpan password dalam bentuk teks terbuka (*plaintext*).
- Kata sandi dilarang dicatat dalam berkas log server, response API, ataupun error stack trace.

### 2.2 Kebijakan Cookie & Sesi (*Session Hardening*)
Jika menggunakan sesi berbasis cookie Laravel (`config/session.php`):
- `HttpOnly = true`: Mencegah skrip JavaScript berbahaya di sisi klien membaca cookie sesi (mitigasi XSS session hijacking).
- `Secure = true`: Memastikan cookie hanya dikirim melalui koneksi HTTPS terenkripsi.
- `SameSite = 'lax'` (atau `'strict'`): Mencegah serangan pemalsuan permintaan antar-situs (*CSRF*).
- `lifetime`: Sesi admin dibatasi kedaluwarsa otomatis (misal: 120 menit) jika tidak ada aktivitas pengguna.
- **Pembersihan Sesi Logout**: Saat admin menekan tombol logout, sesi wajib di-invalidate secara server-side dan token sesi di-regenerate (`$request->session()->invalidate()`).

### 2.3 Pencegahan Brute Force & Pembatasan Upaya Login
- Endpoint login `/admin/login` wajib dilindungi throttle limiter Laravel (`throttle:login`):
  - Maksimal **5 percobaan login gagal dalam 1 menit** per alamat IP atau email.
  - Setelah melampaui batas, sistem mengunci login sementara selama 60 detik.
- **Pesan Galat Generik**: Jika login gagal, tampilkan pesan seragam *"Email atau kata sandi yang Anda masukkan salah."* Dilarang membedakan respon seperti *"Email tidak terdaftar"* untuk mencegah penyerang melakukan pemindaian akun (*user enumeration*).

---

# 3. Otorisasi & Perlindungan Rute Backend

### 3.1 Penegakan Otorisasi Sisi Server (*Server-Side Authority*)
- Otorisasi wajib divalidasi di backend pada setiap permintaan HTTP, bukan mengandalkan antarmuka frontend.
- Menyembunyikan tombol "Hapus" atau menu di UI **bukanlah sistem keamanan**. Penyerang dapat mengirimkan request HTTP langsung ke endpoint endpoint tersebut.
- Seluruh rute admin `/admin/*` dan endpoint API `/api/admin/*` wajib dilindungi oleh middleware otentikasi Laravel (`auth` atau `auth:sanctum`).

### 3.2 Pencegahan Akses Langsung Objek (*IDOR Protection*)
- Pada rute seperti `/admin/customers/{id}` atau `/admin/reservations/{id}`, sistem wajib memvalidasi hak akses admin sebelum mengembalikan data.
- **Ketiadaan Akses Publik**: Pengunjung publik dilarang keras membaca detail reservasi atau customer berdasarkan nomor ID internal (`GET /api/reservations/{id}` dilarang berstatus publik).

### 3.3 Larangan Nilai Kontrol dari Hidden Input
- Status reservasi (`PENDING`), saluran asal (`Website`), dan hak akses **tidak boleh** ditentukan dari input tersembunyi (`<input type="hidden" name="status" value="...">`).
- Nilai-nilai kritis operasional ini wajib ditetapkan secara mutlak oleh backend controller.

---

# 4. Validasi Masukan, Sanitasi, & Pertahanan Injeksi

### 4.1 Pertahanan Terhadap SQL Injection
- Seluruh kueri basis data wajib menggunakan **Eloquent ORM** atau **Prepared Statements / Parameterized Queries**.
- **Larangan Mutlak**: Dilarang menyusun kueri SQL melalui penggabungan string (*string concatenation*) dari input pengguna:
  ```php
  // DILARANG (VULNERABLE):
  DB::select("SELECT * FROM customers WHERE name = '$input'");

  // WAJIB (SECURE):
  Customer::where('name', $input)->first();
  // ATAU
  DB::select("SELECT * FROM customers WHERE name = ?", [$input]);
  ```

### 4.2 Pertahanan Terhadap Cross-Site Scripting (XSS)
- **Escape Otomatis Blade**: Gunakan sintaks standar Blade `{{ $variable }}` yang secara otomatis menerapkan fungsi `htmlspecialchars()`.
- Hindari penggunaan sintaks raw HTML `{!! $variable !!}` untuk input yang berasal dari pengguna (nama wisatawan, catatan reservasi, pesan khusus).
- **Sanitasi Rich Text Editor CMS**: Jika konten deskripsi paket wisata atau artikel menggunakan format HTML dari editor admin, teks wajib disanitasi menggunakan pustaka purifier (seperti HTMLPurifier) dengan whitelist tag yang ketat (`<p>`, `<h3>`, `<strong>`, `<em>`, `<ul>`, `<li>`, `<a>`, `<img>`). Blokir tag berbahaya: `<script>`, `<iframe>`, `<object>`, `<embed>`, dan atribut event JavaScript (`onclick`, `onload`, `javascript:`).

### 4.3 Perlindungan Terhadap CSRF (Cross-Site Request Forgery)
- Seluruh permintaan HTTP pengubah status (`POST`, `PUT`, `PATCH`, `DELETE`) wajib menyertakan token CSRF (`@csrf` pada Blade atau header `X-CSRF-TOKEN` pada AJAX request).
- Token diverifikasi otomatis oleh middleware bawaan Laravel (`VerifyCsrfToken`).

### 4.4 Kebijakan CORS (Cross-Origin Resource Sharing)
- Pada lingkungan produksi, konfigurasi CORS (`config/cors.php`) dilarang menggunakan wildcard bebas (`allowed_origins => ['*']`) untuk rute yang menangani sesi otentikasi.
- Izinkan hanya domain resmi Puja Tour Travel.

---

# 5. Pembatasan Laju Kueri (*Rate Limiting*) & Anti-Abuse

| Endpoint / Fungsionalitas | Batas Laju (*Rate Limit*) | Tujuan Mitigasi |
|---|---|---|
| `POST /admin/login` | 5 percobaan per menit per IP | Mencegah serangan pembobolan password (*Brute Force Attack*). |
| `POST /api/reservations` | 5 permintaan per menit per IP | Mencegah bot spamming formulir dan luapan transaksi palsu. |
| `POST /api/contact` | 3 pesan per menit per IP | Mencegah spam pesan pada kotak masuk CS. |
| Kueri Pencarian Publik | 60 request per menit per IP | Mencegah beban kueri berat berlebihan (*Resource Exhaustion*). |

### Proteksi Anti-Spam Ringan (*Honeypot Protection*)
- Formulir reservasi publik menyertakan kolom tersembunyi yang disembunyikan menggunakan CSS (misal: `website_url_field`).
- Pengguna manusia tidak akan mengisi kolom ini. Jika server mendeteksi kolom tersebut memiliki isi saat formulir dikirim, sistem otomatis menolak request tersebut sebagai bot tanpa memicu eksekusi database.

---

# 6. Keamanan Berkas Unggahan (*File Upload Security*)

Modul Media Library dan unggahan berkas merupakan area bertaraf risiko tinggi (*High Risk*):

```text
Unggahan Klien ──► 1. Validasi Ukuran (Max 3MB/10MB)
                   │
                   ▼
               2. Verifikasi MIME Type (Bukan hanya ekstensi file)
                   │
                   ▼
               3. Pembuatan Nama Acak Server-Side (Sanitasi Karakter)
                   │
                   ▼
               4. Simpan di Direktori Non-Eksekusi (No PHP Execution)
```

### 6.1 Daftar Putih Format Unggahan (*Strict Whitelist*)
- **Foto / Gambar**: `image/jpeg`, `image/png`, `image/webp`, `image/avif` (Maksimal ukuran: **3 MB**).
- **Dokumen Legalitas / Izin**: `application/pdf` (Maksimal ukuran: **10 MB**).
- **Larangan Keras**: Dilarang mengizinkan ekstensi berkas yang dapat dieksekusi oleh web server: `.php`, `.phtml`, `.exe`, `.sh`, `.bat`, `.js`, `.html`, `.svg` (SVG rentan menyisipkan payload XSS berbasis XML).

### 6.2 Validasi MIME Type Sebenarnya
- Backend dilarang hanya mengecek string ekstensi nama berkas (misal: `file.php.jpg`).
- Laravel menggunakan validasi berbasis PHP Fileinfo yang memeriksa konten biner berkas (*Magic Bytes*):
  ```php
  $request->validate([
      'file' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:3072'],
  ]);
  ```

### 6.3 Penamaan Acak & Pencegahan Path Traversal
- Berkas yang diunggah dilarang disimpan menggunakan nama asli yang dikirimkan klien.
- Nama berkas wajib digenerate ulang oleh server menggunakan hash acak unik (misal: `hash_hmac` atau UUID: `4f7d2b8e-8a12-4f33.webp`).
- Hal ini mencegah serangan *Directory Path Traversal* (`../../etc/passwd`).

### 6.4 Isolasi Direktori Media & Larangan Eksekusi Skrip
- Berkas media publik disimpan di direktori `storage/app/public/media` dan ditautkan via symlink publik.
- Konfigurasi web server Nginx wajib mematikan eksekusi skrip PHP di dalam direktori penyimpanan publik:
  ```nginx
  location ^~ /storage/ {
      location ~ \.(php|phar|phtml)$ {
          deny all;
      }
  }
  ```

---

# 7. Perlindungan Data Pribadi (*PII*) & Privasi Wisatawan

### 7.1 Cakupan Data Pribadi yang Dilindungi
Data pribadi wisatawan yang tersimpan pada modul Customer dan Reservasi mencakup:
- Nama Lengkap Pemesan
- Nomor Kontak Telepon / WhatsApp
- Alamat Email
- Catatan Khusus Perjalanan & Catatan Internal Staf (*Admin Notes*)

### 7.2 Kebijakan Paparan Data Klien (*Zero Public Exposure*)
- **Respon Reservasi Minimal**: Setelah reservasi dikirim, server publik hanya mengembalikan kode unik publik dan pesan status:
  ```json
  {
    "success": true,
    "reservation_code": "RES-2026-000152",
    "message": "Permintaan reservasi Anda berhasil dikirim."
  }
  ```
- Dilarang keras mengembalikan objek model `Customer`, rincian email, nomor telepon, atau `admin_notes` pada respon JSON publik.
- Seluruh endpoint API yang menyajikan daftar atau detail pelanggan wajib memerlukan otentikasi sesi admin.

### 7.3 Ketiadaan Data Finansial Sensitif
- Sistem Puja Tour Travel **tidak menyimpan** nomor kartu kredit, kode CVV, nomor rekening bank pribadi wisatawan, ataupun kredensial gateway pembayaran pihak ketiga di basis data.
- Seluruh transaksi uang muka dan pelunasan diverifikasi manual oleh staf melalui rekening resmi perseroan.

---

# 8. Pengelolaan Rahasia (*Secrets Management*) & Lingkungan

### 8.1 Isolasi Kredensial Lingkungan
- Seluruh kredensial sensitif wajib disimpan pada berkas `.env` server dan dimuat via fungsi `env()` / `config()` Laravel:
  - Password basis data (`DB_PASSWORD`)
  - Kunci aplikasi (`APP_KEY`)
  - Kunci API pihak ketiga (Google Maps, dsb.)
  - Konfigurasi mailer server
- **Larangan Commit Git**: Berkas `.env` dan `.env.production` wajib tercantum pada berkas `.gitignore`. Dilarang meng-commit rahasia aplikasi ke repositori kode.

### 8.2 Izin Akses Berkas Server (*File Permissions*)
Pada server produksi:
- Berkas kode sumber aplikasi: `chmod 644` untuk file dan `chmod 755` untuk direktori.
- Direktori writable: `storage/` dan `bootstrap/cache/` dimiliki oleh user web server (`www-data`).
- Berkas konfigurasi `.env`: `chmod 600` (hanya dapat dibaca oleh user aplikasi).

### 8.3 Pemisahan Mode Debug (*Debug Mode*)
- Pada lingkungan produksi (`APP_ENV=production`):
  - `APP_DEBUG = false`: Wajib dimatikan mutlak.
  - Tampilan kesalahan fatal hanya memunculkan halaman ramah pengguna standar HTTP (500 / 404).
  - Dilarang keras menampilkan halaman debug detail (Ignition / stack trace) ke hadapan publik karena mengekspos variabel lingkungan, struktur tabel, dan potongan kode.

---

# 9. Header Keamanan Web (*HTTP Security Headers*)

Server produksi (Nginx / Cloudflare / Laravel Middleware) wajib menyertakan header keamanan modern:

```http
# Mencegah browser menebak tipe MIME berkas (Sniffing Attack)
X-Content-Type-Options: nosniff

# Melindungi dari serangan clickjacking (Embedding via iframe external)
X-Frame-Options: SAMEORIGIN

# Membatasi rujukan asal trafik keluar demi privasi pengguna
Referrer-Policy: strict-origin-when-cross-origin

# Mematikan akses sensor peramban yang tidak relevan
Permissions-Policy: camera=(), microphone=(), geolocation=()

# Memaksa komunikasi selalu melalui koneksi aman HTTPS (HSTS)
Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
```

### Content Security Policy (CSP)
- Menerapkan konfigurasi CSP yang realistis untuk membatasi sumber eksekusi skrip:
  ```http
  Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://maps.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com; connect-src 'self'; frame-ancestors 'self';
  ```

---

# 10. Protokol Tanggap Insiden Keamanan (*Incident Response*)

Jika terjadi indikasi insiden siber, tim teknis wajib melaksanakan tahapan penanganan berikut:

```text
[1. DETEKSI] ──► Identifikasi anomali log, peringatan server, atau laporan celah.
      │
      ▼
[2. ISOLASI] ──► Batasi akses (karantina berkas, putus sesi terdampak, atau blokir IP).
      │
      ▼
[3. ROTASI]  ──► Lakukan rotasi massal kredensial (.env APP_KEY, DB_PASSWORD, SSH keys).
      │
      ▼
[4. PATCH]   ──► Perbaiki celah keamanan pada kode / perbarui dependensi (composer update).
      │
      ▼
[5. AUDIT]   ──► Tinjau berkas log sistem untuk memastikan tidak ada pintu belakang (backdoor).
```

---

# 11. Daftar Periksa Kesiapan Keamanan (*Security Acceptance Checklist*)

### 11.1 Otentikasi & Otorisasi
- [ ] Kata sandi admin di-hash dengan Bcrypt/Argon2 (tidak ada plaintext).
- [ ] Cookie sesi terkonfigurasi `HttpOnly`, `Secure`, dan `SameSite`.
- [ ] Endpoint login dibatasi rate limiter (maks 5 percobaan gagal per menit).
- [ ] Pesan galat otentikasi bersifat generik tanpa membedakan email/password.
- [ ] Seluruh rute `/admin/*` dan API admin terkunci otentikasi wajib.
- [ ] Status reservasi dan sumber pesanan dikendalikan mutlak di backend.

### 11.2 Injeksi & Sanitasi Data
- [ ] Seluruh kueri basis data menggunakan Eloquent ORM atau parameterized query.
- [ ] Tidak ada kueri SQL yang disusun melalui penggabungan string mentah input user.
- [ ] Seluruh output template publik di-escape otomatis oleh Blade `{{ }}`.
- [ ] Konten rich text CMS disanitasi menggunakan pustaka purifier ber-whitelist ketat.
- [ ] Token CSRF diverifikasi aktif pada seluruh form POST/PUT/DELETE.

### 11.3 Unggahan Berkas
- [ ] Ekstensi dan MIME type berkas diverifikasi secara biner (bukan hanya nama string).
- [ ] Ekstensi berbahaya (`.php`, `.exe`, `.sh`, `.html`, `.svg`) diblokir mutlak.
- [ ] Nama berkas diunggah diacak server-side (mencegah path traversal).
- [ ] Eksekusi skrip PHP dimatikan pada direktori penyimpanan publik Nginx.

### 11.4 Privasi & Infrastruktur Server
- [ ] Data kontak dan catatan privat customer tidak terekspos pada endpoint API publik.
- [ ] Berkas `.env` tidak ter-commit di repositori Git dan memiliki izin berkas `600`.
- [ ] Mode debug (`APP_DEBUG`) bernilai `false` di lingkungan produksi.
- [ ] Header keamanan modern (HSTS, CSP, X-Frame-Options, dsb.) aktif di web server.
- [ ] Port basis data MySQL (3306) terisolasi lokal dan tidak terbuka bebas ke internet publik.

---

# 12. Aturan Implementasi Pengembang & AI Agent

1. **Jangan Membuka Pintu Belakang (*No Backdoors / Bypass*)**: Dilarang mematikan otentikasi, middleware CSRF, atau Form Request validation demi kemudahan debugging.
2. **Sanitasi Sebelum Menyimpan**: Sanitasi dan validasi seluruh input di sisi server sebelum menyimpannya ke dalam database.
3. **Penyembunyian Informasi Galat**: Tampilkan halaman error generik kepada publik. Log detail pengecualian teknis hanya ditulis ke berkas log server yang terlindungi (`storage/logs/laravel.log`).
4. **Isolasi Rahasia Produksi**: Jangan pernah mencantumkan kunci rahasia atau password riil di dalam kode program, template komentar, ataupun berkas dokumentasi.

---

# 13. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Gambaran arsitektur sistem dan batas hak akses
- [06-admin-cms.md](file:///c:/laragon/www/pujatourtravel.com/docs/06-admin-cms.md) — Alur otentikasi login admin dan modul CMS terlindungi
- [07-reservation-system.md](file:///c:/laragon/www/pujatourtravel.com/docs/07-reservation-system.md) — Keamanan formulir reservasi publik, rate limiting, dan honeypot
- [08-customer-management.md](file:///c:/laragon/www/pujatourtravel.com/docs/08-customer-management.md) — Standar perlindungan data pribadi wisatawan (*PII*)
- [09-database.md](file:///c:/laragon/www/pujatourtravel.com/docs/09-database.md) — Keamanan skema relasional, hak akses user database, dan isolasi kueri
- `11-seo-and-analytics.md` — Pengamanan data analitik tanpa mengekspos data pribadi
- `13-deployment.md` — Konfigurasi SSL/TLS, Nginx security headers, dan hardening VPS produksi
- `14-testing.md` — Rancangan skenario pengujian penetrasi dan unit test keamanan
