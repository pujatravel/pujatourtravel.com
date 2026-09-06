# 12 — Third-Party Integrations Specifications
# Puja Tour Travel Website

> Dokumen ini mendefinisikan arsitektur integrasi layanan pihak ketiga (*Third-Party Services*), protokol komunikasi antarmuka, penanganan kegagalan (*graceful degradation & fallback*), isolasi kredensial lingkungan, serta batasan ruang lingkup integrasi untuk website Puja Tour Travel.
> Dokumen ini menjadi pedoman utama dalam mengintegrasikan WhatsApp Click-to-Chat, Google Maps, Google Analytics 4, notifikasi email SMTP, tautan media sosial, serta penyimpanan berkas media secara andal tanpa membuat dependensi kritis yang rentan melumpuhkan sistem utama.

---

# 1. Prinsip & Sasaran Integrasi Eksternal

### 1.1 Prinsip Desain Integrasi (*Core Integration Principles*)
1. **Pragmatis & Sederhana**: Memprioritaskan metode integrasi paling ringan (seperti URL *Deep Link* daripada bot webhook kompleks) yang sudah menyelesaikan kebutuhan bisnis secara tuntas.
2. **Kemandirian Sistem Inti (*Non-Critical Dependency*)**: Gangguan teknis atau matinya layanan pihak ketiga (Google Maps, WhatsApp, atau penyedia email) **tidak boleh** melumpuhkan fungsi dasar website publik atau menggagalkan penyimpanan transaksi reservasi.
3. **Penurunan Fungsi yang Anggun (*Graceful Degradation & Fallback*)**: Jika antarmuka pihak ketiga gagal dimuat, antarmuka selalu menyajikan informasi teks alternatif (misal: jika peta interaktif gagal, alamat fisik dan tombol arah tetap dapat digunakan).
4. **Isolasi Rahasia & Kredensial**: Kunci API, token rahasia, dan kredensial server disimpan secara eksklusif pada variabel lingkungan `.env` di backend, dan dilarang terekspos ke bundle JavaScript klien.
5. **Perlindungan Privasi Wisatawan**: Dilarang meneruskan data pribadi wisatawan (*PII*) ke layanan analitik atau pihak ketiga yang tidak berwenang.

### 1.2 Arsitektur Hubungan Integrasi
```text
                          PUJA TOUR TRAVEL SISTEM
                                     │
         ┌───────────────────────────┼───────────────────────────┐
         ▼                           ▼                           ▼
[LAYANAN INTI PELANGGAN]   [OPERASIONAL & BISNIS]      [INFRASTRUKTUR & SERVER]
  ├── WhatsApp Deep Link     ├── Google Analytics 4      ├── DNS & Domain Resmi
  └── Google Maps Sematan    ├── Email Notifikasi SMTP   ├── Sertifikat SSL/TLS
                             └── Media Library Storage   └── Reverse Proxy Nginx
```

---

# 2. Integrasi Layanan Inti Pelanggan

### 2.1 WhatsApp Click-to-Chat Deep Link
WhatsApp merupakan saluran komunikasi primer dan konversi tercepat bagi Puja Tour Travel.
- **Strategi MVP**: Menggunakan protokol URL standar WhatsApp (`https://wa.me/{nomor}`) tanpa memerlukan bot atau WhatsApp Business API berbayar.
- **Normalisasi Nomor Telepon**: Nomor resmi diambil dari konfigurasi database/CMS (`contact_information.whatsapp`), dibersihkan menjadi format internasional:
  ```text
  Input Admin: 0812-3456-7890 ──► Normalisasi: 6281234567890
  URL Resmi  : https://wa.me/6281234567890
  ```

#### Lokasi & Templat Pesan Kontekstual (*Prefilled Messages*)
Seluruh pesan teks otomatis di-encode dengan aman menggunakan fungsi `rawurlencode()`:
1. **Tombol Mengambang Global (*Floating Action Button*)**:
   - Lokasi: Pojok kanan bawah layar website.
   - Pesan Bawaan: *"Halo Puja Tour Travel, saya ingin bertanya mengenai layanan paket wisata di Pangandaran."*
2. **Tombol "Tanya via WhatsApp" pada Detail Paket Wisata**:
   - Menautkan nama paket secara spesifik:
     ```text
     Halo Puja Tour Travel, saya tertarik dengan paket wisata [Nama Paket] (https://pujatourtravel.com/paket-wisata/{slug}). Mohon info ketersediaan tanggal dan rincian perjalanannya.
     ```
3. **Tombol Konfirmasi Setelah Reservasi Sukses Terkirim**:
   - Membawa kode acuan publik:
     ```text
     Halo Puja Tour Travel, saya baru saja mengirim permintaan reservasi untuk paket [Nama Paket] dengan Kode Reservasi [RES-2026-000152]. Mohon konfirmasinya.
     ```
4. **Tombol Cepat Admin CMS**:
   - Staf admin dapat mengklik tombol *"Chat Wisatawan"* pada detail reservasi untuk langsung menyapa calon wisatawan tanpa perlu menyimpan kontak secara manual di ponsel staf.

### 2.2 Integrasi Google Maps (Lokasi Kantor & Titik Kumpul)
- **Tujuan**: Membangun kredibilitas bisnis lokal, membuktikan keberadaan kantor fisik di Pangandaran, dan memudahkan wisatawan menemukan rute penjemputan.
- **Sumber Data**: Kolom `address`, `latitude`, `longitude`, dan `google_maps_url` pada tabel `contact_information`.
- **Implementasi Antarmuka**:
  1. **Peta Sematan Responsif (*Embedded Map Iframe*)**: Menggunakan iframe responsif dengan atribut `loading="lazy"` agar tidak memperlambat LCP beranda.
  2. **Tautan Langsung Aplikasi Peta**: Tombol *"Buka di Google Maps"* mengarahkan pengguna ke aplikasi peta bawaan ponsel atau Google Maps web dengan rute navigasi akurat.
- **Rencana Cadangan (*Fallback*)**: Jika jaringan Google terblokir atau kuota API habis, antarmuka tetap menampilkan teks alamat fisik lengkap dan petunjuk patokan jalan (*landmark*).

---

# 3. Integrasi Operasional, Media, & Komunikasi

### 3.1 Google Analytics 4 (GA4) & Pelacakan Konversi
- **Strategi Pelacakan**: Memantau perilaku pengunjung dan titik konversi utama tanpa menghambat kinerja peramban.
- **Konfigurasi Non-Blocking**: Skrip Google Tag dimuat asinkron (`async`) dengan ID pengukuran yang dikelola via environment variable:
  ```html
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.ga.measurement_id') }}"></script>
  ```
- **Katalog Peristiwa Konversi Kritis**:
  - `whatsapp_click`: Dilacak saat pengunjung mengklik tombol WhatsApp di mana pun.
  - `reservation_submit`: Dilacak saat pengunjung mengirim form reservasi.
  - `reservation_success`: Dilacak saat server mengonfirmasi keberhasilan penyimpanan reservasi.
- **Prinsip Bebas PII (*Zero PII Policy*)**: Dilarang keras mengirimkan nama wisatawan, nomor telepon, atau alamat email ke parameter event Google Analytics.

### 3.2 Notifikasi Email Transaksional (SMTP)
- **Fungsi**: Mengirimkan pemberitahuan otomatis ke kotak masuk email staf/pemilik saat ada permintaan reservasi baru dari website publik.
- **Penyedia Layanan**: Menggunakan protokol SMTP standar Laravel (`config/mail.php`) yang dapat dihubungkan ke layanan email hosting cPanel, Google Workspace, Mailgun, atau Brevo.
- **Kemandirian Transaksi (*Decoupled Execution*)**:
  - Pengiriman email notifikasi diproses di latar belakang (*queue / background job*) atau dieksekusi setelah transaksi database selesai (`DB::afterCommit`).
  - **Prinsip Utama**: Jika server SMTP mengalami kegagalan kirim atau timeout jaringan, data transaksi reservasi **wajib tetap tersimpan sempurna** di database. Kegagalan email tidak boleh memicu rollback reservasi.

### 3.3 Integrasi Penyimpanan Media (*Media Storage*)
- **Fase MVP**: Penyimpanan lokal terstruktur pada direktori server (`storage/app/public/media`) yang ditautkan via symlink publik (`php artisan storage:link`).
- **Skalabilitas Masa Depan**: Menggunakan abstraction filesystem bawaan Laravel (`Storage::disk()`). Aplikasi dapat beralih ke penyimpanan cloud *Object Storage* (AWS S3, Cloudflare R2, atau DigitalOcean Spaces) cukup dengan memperbarui konfigurasi `.env` tanpa merombak kode program.

### 3.4 Tautan Media Sosial Resmi
- **Saluran Terintegrasi**: Akun resmi Instagram, TikTok, Facebook, dan YouTube Puja Tour Travel yang dikelola melalui tabel `social_links`.
- **Standar Keamanan Tautan Keluar**: Seluruh tautan media sosial wajib dibuka pada tab baru dengan atribut keamanan:
  ```html
  <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">
  ```
  Atribut `noopener noreferrer` mencegah serangan *tab-nabbing* dan kebocoran informasi headers privat.

---

# 4. Matriks Konfigurasi & Variabel Lingkungan (.env)

Seluruh kredensial integrasi pihak ketiga diisolasi pada berkas lingkungan:

```ini
# ==============================================================================
# INTEGRASI PUJA TOUR TRAVEL (.env)
# ==============================================================================

# Identitas Aplikasi & URL Dasar
APP_NAME="Puja Tour Travel"
APP_URL=https://pujatourtravel.com

# Integrasi Kontak WhatsApp Resmi Bisnis
WHATSAPP_OFFICIAL_NUMBER=6281234567890

# Integrasi Google Analytics 4
GA_MEASUREMENT_ID=G-XXXXXXXXXX

# Integrasi Google Maps (Opsional jika menggunakan Static Maps API)
GOOGLE_MAPS_API_KEY=AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

# Integrasi Notifikasi Email SMTP
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@pujatourtravel.com
MAIL_PASSWORD=secret-smtp-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@pujatourtravel.com
MAIL_FROM_NAME="Puja Tour Travel System"
ADMIN_NOTIFICATION_EMAIL=admin@pujatourtravel.com

# Driver Media Storage (public / s3)
FILESYSTEM_DISK=public
```

---

# 5. Matriks Kegagalan & Penanganan Fallback (*Graceful Degradation*)

| Layanan Terintegrasi | Tingkat Risiko | Dampak Jika Layanan Gangguan / Mati | Solusi Penanganan & Cadangan (*Fallback Plan*) |
|---|---|---|---|
| **WhatsApp Web / App** | Rendah | Aplikasi WA di ponsel pengguna tidak terpasang atau API wa.me bermasalah | Otomatis membuka WhatsApp Web pada desktop, dan menyediakan nomor telepon manual serta formulir reservasi online di website. |
| **Google Maps Sematan** | Rendah | Iframe peta gagal memuat atau jaringan Google terputus | Menampilkan alamat teks fisik kantor lengkap di Pangandaran disertai tombol arah langsung ke URL koordinat GPS. |
| **Google Analytics 4** | Rendah | Script diblokir ekstensi ad-blocker pengguna | Skrip dimuat `async`; kegagalan GA4 tidak menghentikan fungsi interaksi apa pun pada halaman website. |
| **Server Email SMTP** | Menengah | Notifikasi email ke admin gagal terkirim | Data reservasi tetap aman di database; status email dicatat di log server; staf tetap dapat memantau reservasi via dashboard admin CMS. |
| **Penyimpanan Gambar** | Tinggi | File fisik gambar hilang atau storage tidak terbaca | Menampilkan gambar placeholder default bertema pariwisata yang elegan tanpa membuat tata letak halaman rusak. |
| **DNS / Web Server** | Kritis | Domain tidak dapat diakses pengguna | Menggunakan DNS terpercaya (Cloudflare) dengan perlindungan DDoS dan sertifikat SSL otomatis. |

---

# 6. Batasan Ruang Lingkup Integrasi (*MVP Scope Boundaries*)

Demi menjaga stabilitas dan efisiensi peluncuran fase awal, sistem membatasi integrasi pihak ketiga yang belum dibutuhkan:

```text
DIIMPLEMENTASIKAN DI TAHAP MVP:
├── WhatsApp Click-to-Chat Deep Link (wa.me)
├── Google Maps Responsive Embed & External Route Link
├── Google Analytics 4 (Pelacakan Event Konversi & UTM)
├── Notifikasi Email Transaksional Masuk (SMTP)
└── Tautan Akun Resmi Media Sosial (IG, TikTok, FB)

DITUNDA KE TAHAP MASA DEPAN (NON-MVP):
├── WhatsApp Business Cloud API / Chatbot Otomatis
├── Gateway Pembayaran Otomatis (Midtrans, Xendit, Doku)
├── Mesin Sinkronisasi Ketersediaan Kalender Eksternal
├── Sistem Tiket Pesawat / Kereta Api Eksternal (API OTA)
└── Otentikasi Masuk Pengunjung via Akun Google (Google OAuth)
```

---

# 7. Daftar Periksa Kesiapan Integrasi (*Acceptance Checklist*)

### 7.1 WhatsApp & Media Sosial
- [ ] Tombol WhatsApp mengarah ke nomor resmi yang valid dengan format internasional `628xxx`.
- [ ] Tombol WhatsApp kontekstual pada halaman paket membawa nama paket yang sedang dilihat.
- [ ] Pesan WhatsApp setelah reservasi sukses menyertakan nomor kode reservasi publik.
- [ ] Tombol WhatsApp mengambang (*floating button*) tampil presisi di perangkat mobile dan desktop.
- [ ] Seluruh tautan media sosial mengarah ke akun resmi dengan atribut `target="_blank"` dan `rel="noopener noreferrer"`.

### 7.2 Google Maps & Lokasi
- [ ] Titik sematan peta Google Maps akurat menunjukkan lokasi kantor fisik di Pangandaran.
- [ ] Tombol *"Buka di Google Maps"* berfungsi membuka rute navigasi di ponsel pengguna.
- [ ] Halaman kontak tetap menyajikan teks alamat yang lengkap dan jelas jika iframe peta dinonaktifkan.

### 7.3 Analitik & Pelacakan Konversi
- [ ] ID pengukuran Google Analytics 4 dimuat melalui konfigurasi `.env`.
- [ ] Event kustom (`package_view`, `whatsapp_click`, `reservation_success`) terlacak akurat pada dashboard real-time GA4.
- [ ] Parameter kampanye pemasaran (`utm_source`, `utm_medium`, `utm_campaign`) terdeteksi di analitik.
- [ ] Tidak ada data pribadi sensitif wisatawan yang dikirimkan ke parameter GA4.

### 7.4 Email & Penyimpanan Berkas
- [ ] Email notifikasi reservasi baru berhasil diterima di kotak masuk admin dengan rincian pemesanan lengkap.
- [ ] Jika kredensial SMTP dimatikan atau koneksi email putus, pengiriman formulir reservasi tetap berhasil menyimpan data ke database.
- [ ] Unggahan foto galeri dan paket wisata tersimpan di direktori storage dengan tautan publik yang dapat dimuat cepat.

---

# 8. Aturan Implementasi Pengembang & AI Agent

1. **Gunakan Helper Terpusat**: Seluruh pembentukan URL WhatsApp wajib menggunakan fungsi pembantu tunggal (`WhatsAppHelper::buildUrl()`), dilarang merakit string URL wa.me secara manual di sembarang berkas Blade.
2. **Kemandirian Transaksi**: Selalu bungkus eksekusi pengiriman email notifikasi di luar transaksi reservasi kritis, atau gunakan Laravel Queue / Events (`ReservationCreated` event listener).
3. **Jangan Membocorkan Kunci API**: Kunci API pihak ketiga (Google Maps, Mailer) hanya boleh diakses melalui helper `config('services.xxx')` di backend.
4. **Hindari Permintaan Sinkron yang Memblokir**: Dilarang melakukan panggilan HTTP eksternal yang bersifat *blocking* di tengah proses perenderan halaman publik.

---

# 9. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Gambaran umum bisnis, kontak, dan target audiens
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) — Penempatan komponen interaktif (peta kontak, tombol WhatsApp floating)
- [05-public-website.md](file:///c:/laragon/www/pujatourtravel.com/docs/05-public-website.md) — Tata letak komponen CTA WhatsApp dan sematan peta pada halaman publik
- [06-admin-cms.md](file:///c:/laragon/www/pujatourtravel.com/docs/06-admin-cms.md) — Pengelolaan data kontak, peta lokasi, dan tautan media sosial via CMS
- [07-reservation-system.md](file:///c:/laragon/www/pujatourtravel.com/docs/07-reservation-system.md) — Alur notifikasi setelah reservasi berhasil dikirim
- [09-database.md](file:///c:/laragon/www/pujatourtravel.com/docs/09-database.md) — Skema tabel `contact_information`, `social_links`, dan `website_settings`
- [10-security.md](file:///c:/laragon/www/pujatourtravel.com/docs/10-security.md) — Pengamanan variabel lingkungan `.env` dan proteksi data pribadi wisatawan
- [11-seo-and-analytics.md](file:///c:/laragon/www/pujatourtravel.com/docs/11-seo-and-analytics.md) — Konfigurasi peristiwa konversi GA4 dan parameter kampanye UTM
- `13-deployment.md` — Konfigurasi SMTP produksi, integrasi DNS, dan pemasangan sertifikat SSL Nginx
