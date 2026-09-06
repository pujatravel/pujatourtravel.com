# Testing & Quality Assurance Specification

> Dokumen spesifikasi strategi pengujian, penjaminan mutu (*Quality Assurance*), skenario End-to-End (E2E), standar pengujian keamanan, matriks UAT, dan kriteria penerimaan rilis (*Definition of Done*) untuk website Puja Tour Travel.

---

## 1. Pendahuluan & Prinsip Pengujian

Dokumen ini mendefinisikan strategi menyeluruh untuk memvalidasi bahwa seluruh fitur sistem Puja Tour Travel berjalan sesuai kebutuhan bisnis, aman, berkinerja stabil, dan memberikan pengalaman pengguna yang optimal sebelum dinyatakan selesai (*Done*) atau dirilis ke produksi.

### 1.1 Prinsip Inti Pengujian
1. **Pengujian Berbasis Perilaku (*Behavior-Driven*)**: Pengujian tidak hanya memeriksa apakah halaman dapat dibuka (HTTP 200), melainkan memvalidasi integritas logika bisnis, validasi input, penyimpanan data, dan perubahan status sistem.
2. **Pengujian Sejak Dini (*Shift-Left Testing*)**: Verifikasi dilakukan pada setiap tahapan penulisan kode, bukan ditumpuk di akhir proyek.
3. **Cakupan Wajib Setiap Fitur**:
   - **Happy Path**: Alur normal dengan input data yang valid dan diharapkan.
   - **Validation & Error Path**: Penanganan data kosong, format salah, atau masukan di luar batas yang diizinkan.
   - **Boundary Cases**: Nilai minimum, maksimum, nilai ekstrem, dan karakter khusus.
   - **Authorization & Security**: Pembatasan hak akses, proteksi CSRF/XSS, dan isolasi sesi.
   - **Responsive & Accessibility**: Tampilan lintas perangkat dan kemudahan navigasi keyboard.
   - **Regression Check**: Memastikan fitur baru tidak merusak fungsionalitas yang telah ada sebelumnya.

### 1.2 Filosofi Siklus Pengujian
```text
Bangun Fitur (Build) ──► Uji Mandiri (Validate) ──► Simulasikan Error (Break)
                                                               │
Rilis (Release) ◄── Verifikasi Ulang (Verify) ◄── Perbaiki (Fix & Retest)
```

---

## 2. Piramida Pengujian (*Testing Pyramid*) & Pembagian Level

Untuk efisiensi eksekusi dan pemeliharaan kode, pengujian dibagi ke dalam tingkatan piramida pengujian terstruktur:

```text
                 ┌──────────────────────────┐
                 │    Manual UAT & Smoke    │  (Validasi Bisnis & Observasi UI)
                 ├──────────────────────────┤
                 │   End-to-End (E2E) Flow  │  (Alur Kritis Pengguna Antar-Halaman)
                 ├──────────────────────────┤
                 │ Feature & Integration    │  (HTTP Endpoint, Database, Event)
                 ├──────────────────────────┤
                 │    Unit Testing (PHP)    │  (Kalkulasi, Mutator, Validasi Murni)
                 └──────────────────────────┘
```

| Level Pengujian | Target Cakupan | Alat / Metode | Contoh Kasus Uji |
| :--- | :--- | :--- | :--- |
| **Unit Test** | Fungsi terisolasi tanpa dependensi eksternal berat. | PHPUnit (`tests/Unit`) | Format mata uang rupiah, slug generator, sanitasi nomor WhatsApp. |
| **Feature / Integration** | Interaksi antar-komponen (Route, Controller, Model, DB). | PHPUnit (`tests/Feature`) | Pengiriman form reservasi, autentikasi admin, kalkulasi harga paket. |
| **End-to-End (E2E)** | Alur lengkap dari perspektif pengguna browser. | Browser Subagent / Playwright | Penjelajahan paket ➔ pengisian formulir ➔ verifikasi di CMS admin. |
| **Manual QA & UAT** | Uji akseptansi pengguna bisnis dan konsistensi visual. | Manual checklist lintas perangkat | Kemudahan alur admin, kejelasan teks hukum, keterbacaan pada smartphone. |

---

## 3. Manajemen Lingkungan & Data Uji (*Test Environments & Data*)

### 3.1 Pemisahan Lingkungan Uji
- **Lingkungan Development**: Menggunakan database lokal (Laragon), factory seeders, dan akun uji coba. Mode *debug* diizinkan aktif.
- **Lingkungan Staging / Testing**: Menyerupai konfigurasi server produksi, menggunakan basis data terpisah dengan data tiruan terstruktur (*synthetic data*). Mode *debug* nonaktif.
- **Lingkungan Production**: Hanya berisi data riil bisnis. **Dilarang keras** menyisakan akun admin dummy, reservasi palsu, atau gambar placeholder di lingkungan ini saat *go-live*.

### 3.2 Standar Data Uji (*Synthetic Test Data*)
Data uji harus jelas dapat diidentifikasi dan merepresentasikan berbagai variasi skenario bisnis:
- Format nama pengujian: Gunakan awalan eksplisit seperti `TEST CUSTOMER`, `TEST PACKAGE`, atau format email `test_user@example.com`.
- **Dilarang Menggunakan**: Nama tokoh publik, selebritas, nama presiden, atau merek dagang nyata sebagai data dummy.
- **Variasi Data Uji yang Wajib Dibuat**:
  - Pelanggan baru vs pelanggan lama (pembelian berulang / *repeat booking*).
  - Status reservasi: `Pending`, `Processing`, `Confirmed`, `Completed`, `Cancelled`.
  - Status paket wisata: `Draft`, `Published`, `Archived`.
  - Isian teks panjang (deskripsi & catatan khusus) dan isian opsional kosong (*null*).

---

## 4. Spesifikasi Pengujian Fungsional Website Publik & Paket Wisata

### 4.1 Pengujian Halaman Publik Utama
- **Beranda (Homepage)**:
  - Hero section tampil dengan CTA utama yang aktif.
  - Section paket unggulan (*Featured Packages*) memuat paket yang berstatus `Published`.
  - Galeri destinasi, testimoni pelanggan, dan section *About Us* tampil dinamis dari database.
  - *Resilience Check*: Jika salah satu section konten kosong (misal belum ada testimoni), halaman beranda harus tetap tampil rapi tanpa *crash* atau error layout.
- **Navigasi & Kontak**:
  - Tautan menu header, navigasi mobile (hamburger), dan tautan footer berfungsi tanpa *broken link*.
  - Tautan WhatsApp mengarah ke nomor resmi dengan parameter teks pesan terenkode rapi.
  - Widget Google Maps memuat lokasi resmi Puja Tour Travel dan memiliki fallback tautan langsung.

### 4.2 Siklus Hidup & Pengujian Paket Wisata (*Package Lifecycle*)
- **Status Publikasi Paket**:
  - `Published`: Tampil di daftar katalog publik, dapat dicari, dan dapat diakses via URL slug.
  - `Draft`: Tersimpan di database admin, dapat disunting staf, tetapi **tersembunyi total** dari website publik (akses URL langsung menghasilkan HTTP 404).
  - `Archived`: Tidak muncul pada katalog aktif publik; reservasi lama yang merujuk ke paket ini tetap mempertahankan integritas relasi datanya.
- **Retensi Harga Historis (*Price History Integrity*)**:
  - Harga yang tersimpan pada reservasi pelanggan harus bersifat historis (*snapshot* harga saat pemesanan dibuat).
  - Perubahan harga paket di CMS tidak boleh mengubah total harga pada data reservasi lama yang sudah tercatat.
- **Detail Paket & Itinerary**:
  - Memastikan fasilitas (*inclusions*), pengecualian (*exclusions*), dan galeri foto paket sesuai data CMS.
  - Itinerary tampil berurutan berdasarkan nomor urut hari/jam kegiatan secara konsisten di admin dan antarmuka publik.

---

## 5. Pengujian Mesin Reservasi & Pengelolaan Pelanggan

### 5.1 Alur Reservasi Normal (*Happy Path*)
```text
Pengunjung Memilih Paket ──► Mengisi Form Reservasi ──► Validasi Form
                                                               │
Konfirmasi Sukses ◄── Buat Data Reservasi (Pending) ◄── Normalisasi & Match Customer
```
- **Kriteria Keberhasilan**:
  1. Input data tervalidasi di sisi klien dan server.
  2. Sistem mencari pelanggan berdasarkan nomor WhatsApp ternormalisasi: jika ditemukan, hubungkan ke data pelanggan yang ada; jika baru, buat record pelanggan baru.
  3. Record reservasi baru tercipta dengan status awal wajib `Pending`.
  4. Atribusi sumber pesanan (*source*) tercatat dengan benar (`Website`, `Instagram`, `WhatsApp`, dll.).
  5. Antarmuka menampilkan halaman/modal sukses pemesanan dengan nomor referensi unik.

### 5.2 Matriks Validasi Form Reservasi
Validasi di sisi server (*Form Request Laravel*) adalah otoritas mutlak:

| Bidang Isian | Kasus Uji Positif | Kasus Uji Negatif (Wajib Ditolak) |
| :--- | :--- | :--- |
| **Nama Lengkap** | "Budi Santoso", 3 - 100 karakter. | Kosong, < 3 karakter, > 100 karakter, script tag `<script>`. |
| **Nomor WhatsApp** | "081234567890", "+6281234567890" | Kosong, huruf alfabet, nomor < 9 digit atau > 15 digit. |
| **Alamat Email** | "budi@example.com", opsional kosong. | Format email invalid ("budi@", "budi.com"). |
| **Tanggal Tour** | Tanggal masa depan (H+1 atau lebih). | Tanggal hari kemarin / masa lalu, format tanggal tidak valid. |
| **Jumlah Peserta (Pax)**| Bilangan bulat 1 s/d batas kapasitas paket. | Angka 0, angka negatif (-2), angka desimal (2.5), nilai non-numerik. |
| **Paket Wisata** | ID / UUID paket yang valid & `Published`. | ID paket fiktif, paket berstatus `Draft`, paket berstatus `Archived`. |
| **Catatan Khusus** | Teks keterangan, opsional kosong. | Karakter melebihi 1.000 karakter, payload injeksi HTML/XSS. |

### 5.3 Pengujian Mesin Status Reservasi (*State Machine*)
- **Transisi Status yang Diizinkan**:
  - `Pending` ➔ `Processing` ➔ `Confirmed` ➔ `Completed`
  - `Pending` / `Processing` / `Confirmed` ➔ `Cancelled`
- **Transisi Status yang Dilarang (Invalid)**:
  - `Completed` ➔ `Pending` (Reservasi selesai tidak boleh dikembalikan ke status awal).
  - `Cancelled` ➔ `Completed` (Reservasi batal tidak boleh langsung selesai tanpa konfirmasi ulang).
- **Pencatatan Riwayat (*Audit Trail*)**: Setiap perubahan status wajib mencatat timestamp, status lama, status baru, dan ID admin yang melakukan perubahan.

### 5.4 Normalisasi Pelanggan & Anti-Duplikasi
- **Normalisasi Nomor Telepon**: Format `0812...`, `+62812...`, dan `62812...` harus dinormalisasi ke format standar internasional tunggal (contoh: `6281234567890`) sebelum pencocokan data dilakukan.
- **Pencegahan Duplikasi**: Pelanggan yang memesan untuk kedua kalinya dengan nomor telepon yang sama tidak boleh membuat record pelanggan baru; jumlah reservasi pada profil pelanggan yang bersangkutan harus bertambah (*repeat customer*).

---

## 6. Pengujian Panel Admin CMS & Autentikasi

### 6.1 Autentikasi & Manajemen Sesi Admin
- **Login Sukses**: Kombinasi email dan password yang benar menghasilkan sesi login dan redirect ke Dashboard.
- **Login Gagal**: Password salah, email tidak terdaftar, atau akun berstatus nonaktif menghasilkan pesan error yang aman tanpa membocorkan eksistensi email pengguna.
- **Proteksi Akses Tanpa Login**: Percobaan mengakses rute `/admin`, `/admin/packages`, `/admin/reservations` tanpa sesi aktif wajib dialihkan ke halaman login admin dengan HTTP 302/401.
- **Logout & Invalidation**: Menekan tombol logout menghancurkan sesi di server; tombol *Back* pada browser tidak boleh menampilkan data yang membutuhkan autentikasi.

### 6.2 Otorisasi & Pencegahan Akses Ilegal (*IDOR Prevention*)
- Pengguna yang tidak terautentikasi atau pengguna tanpa wewenang dilarang melakukan aksi mutasi data pada API/Controller admin:
  - Manipulasi ID pada URL seperti `PATCH /admin/reservations/{id}/status` wajib memverifikasi permission admin di level middleware/policy Laravel.

### 6.3 Validasi Unggah Berkas Media (*Media Upload Security*)
- **Jenis Berkas yang Diizinkan**: JPG, PNG, WebP (maksimal 2MB per gambar).
- **Kasus Pengujian Negatif (Wajib Diblokir)**:
  - Berkas dengan ekstensi ganda atau manipulasi ekstensi (contoh: `destinasi.jpg.php`, `shell.php.png`).
  - Berkas dengan MIME type tidak sesuai header berkas (*magic bytes verification*).
  - Berkas executable (`.exe`, `.sh`, `.bat`, `.js`).
  - Berkas gambar berukuran melebihi batas batas kuota konfigurasi server.

---

## 7. Pengujian Keamanan Sistem (*Security Testing*)

Setiap form masukan dan endpoint API wajib diuji terhadap celah keamanan web standar OWASP:

| Skenario Pengujian | Metode & Payload Uji | Ekspektasi Sistem |
| :--- | :--- | :--- |
| **SQL Injection** | `' OR 1=1 --`, `1; DROP TABLE users;` pada form pencarian dan query filter. | Input di-escape aman via Eloquent ORM / PDO binding; tidak terjadi eksekusi DDL/SQL error. |
| **Cross-Site Scripting (XSS)**| `<script>alert('xss')</script>`, `<img src=x onerror=alert(1)>` pada form reservasi/ulasan. | Input disimpan dan dirender sebagai teks biasa ter-escape (`htmlspecialchars` / Blade `{{ }}`). |
| **CSRF Protection** | Mengirim request `POST /reservasi` atau aksi admin tanpa header token `_token`. | Request ditolak dengan HTTP 419 (Page Expired / CSRF Token Mismatch). |
| **Rate Limiting** | Melakukan 30 request POST reservasi atau percobaan login dalam waktu 1 menit dari IP yang sama. | Request dibatasi dengan respons HTTP 429 (Too Many Requests). |
| **Sensitive Data Exposure**| Memicu error 500 buatan pada endpoint API publik. | Respons menampilkan pesan error generik tanpa stack trace, query SQL, atau env paths. |
| **Secure Cookie Flags** | Memeriksa header `Set-Cookie` pada sesi produksi. | Flag `Secure`, `HttpOnly`, dan `SameSite=Lax` terpasang secara utuh. |

---

## 8. Pengujian Basis Data & Integritas Transaksional

### 8.1 Integritas Transaksi DB (*ACID Atomicity*)
Proses reservasi melibatkan pembuatan/pembaharuan data pada beberapa tabel sekaligus:
1. Pembuatan atau pembaruan record `customers`.
2. Pembuatan record `reservations`.
3. Pembuatan riwayat awal pada `reservation_status_histories`.

> [!IMPORTANT]
> Seluruh operasi di atas wajib dibungkus dalam blok `DB::transaction`. Jika salah satu tahap gagal (misal: koneksi DB terputus saat penulisan history), seluruh operasi harus di-*rollback* total sehingga tidak menghasilkan record data setengah jadi (*orphan data*).

### 8.2 Pengujian Kinerja Kueri (*Query Optimization*)
- Menghindari masalah **N+1 Query**: Kueri daftar reservasi dan paket wisata wajib menggunakan teknik *eager loading* (`Package::with(['category', 'galleries'])`).
- Verifikasi keberadaan database index pada kolom pencarian frekuensi tinggi (`reservations.status`, `reservations.reservation_code`, `customers.phone`).

---

## 9. Pengujian Responsivitas, Lintas Browser & Aksesibilitas

### 9.1 Matriks Breakpoint Layar
Website harus diverifikasi pada dimensi tampilan utama:
- **Mobile Smartphone** (360px – 414px): Verifikasi navigasi drawer, ukuran tombol touch target (min 44x44px), kemudahan input form, ketiadaan *horizontal scrollbar*.
- **Tablet** (768px – 1024px): Penataan tata letak grid 2 kolom pada daftar paket dan kartu fasilitas.
- **Desktop & Widescreen** (1280px – 1920px): Grid 3-4 kolom, navigasi horizontal penuh, layout proporsional tanpa elemen terentang berlebihan.

### 9.2 Kompatibilitas Lintas Browser
Pengujian fungsional dan visual wajib dilakukan pada mesin render browser utama:
1. **Google Chrome / Chromium Engine** (Desktop & Android).
2. **Apple Safari / WebKit Engine** (Desktop macOS & iOS iPhone/iPad).
3. **Mozilla Firefox** (Gecko Engine).
4. **Microsoft Edge** (Chromium).

### 9.3 Aksesibilitas (WCAG 2.1 AA)
- Seluruh formulir memiliki elemen `<label>` yang terhubung dengan atribut `for="input_id"`.
- Kontras warna antara teks dan background memenuhi rasio minimum 4.5:1.
- Navigasi keyboard penuh menggunakan tombol `Tab`, `Enter`, dan `Space` pada seluruh link, tombol, dan form input.
- Setiap elemen gambar memuat atribut `alt` deskriptif untuk pembaca layar (*screen reader*).

---

## 10. Pengujian Integrasi Eksternal & Ketahanan Sistem

Integrasi pihak ketiga berpotensi mengalami gangguan sewaktu-waktu. Sistem harus dirancang dengan prinsip *graceful degradation*:

```text
Layanan Eksternal Mengalami Timeout / Gangguan
       │
       ├── Google Maps API Gagal  ──► Tampilkan teks alamat fisik & tautan koordinat eksternal.
       ├── WhatsApp Webhook Error ──► Transaksi reservasi internal tetap tersimpan aman di basis data.
       ├── Analytics GA4 Terblokir ──► Pengunjung tetap dapat menjelajah dan memesan tanpa kendala.
       └── Mailgun / SMTP Down    ──► Notifikasi masuk ke antrean database (dapat di-retry oleh queue worker).
```

---

## 11. Skenario End-to-End (E2E) & User Acceptance Testing (UAT)

### 11.1 Skenario Pengujian End-to-End Utama

#### Skenario E2E-01: Penjelajahan Katalog Wisata Publik
- **Aktor**: Pengunjung Website.
- **Langkah**: Buka Beranda ➔ Gulir ke Paket Unggulan ➔ Klik "Lihat Semua Paket" ➔ Buka Detail Paket Green Canyon ➔ Periksa Fasilitas & Itinerary ➔ Klik Tab Galeri Foto.
- **Ekspektasi**: Semua halaman termuat lancar, gambar tampil tajam, dan tidak ada aset yang gagal dimuat (HTTP 404).

#### Skenario E2E-02: Pengiriman Reservasi oleh Pelanggan Baru
- **Aktor**: Calon Pelanggan.
- **Langkah**: Buka halaman reservasi paket ➔ Lengkapi form (Nama, WA, Email, Tanggal Tour H+7, 4 Pax) ➔ Submit formulir.
- **Ekspektasi**: Respons sukses tampil; kode reservasi unik diterbitkan; data tersimpan di DB dengan status `Pending`; sumber tercatat `Website`.

#### Skenario E2E-03: Pemrosesan Reservasi oleh Administrator
- **Aktor**: Staf Admin.
- **Langkah**: Login ke `/admin/login` ➔ Buka menu Reservasi ➔ Temukan reservasi baru dari E2E-02 ➔ Ubah status menjadi `Confirmed` ➔ Berikan catatan admin.
- **Ekspektasi**: Status berubah real-time pada tabel; riwayat perubahan status tercatat beserta nama admin yang mengeksekusi.

#### Skenario E2E-04: Pemesanan Ulang Pelanggan Lama (*Repeat Booking*)
- **Aktor**: Pelanggan yang Pernah Memesan.
- **Langkah**: Mengirim form pemesanan paket kedua dengan nomor WhatsApp yang sama persis seperti pada E2E-02 namun memilih paket dan tanggal berbeda.
- **Ekspektasi**: Record pelanggan tidak bertambah ganda; profil pelanggan di admin kini memiliki 2 riwayat reservasi aktif.

#### Skenario E2E-05: Penerbitan Paket Wisata Melalui CMS
- **Aktor**: Tim Marketing / Admin.
- **Langkah**: Tambah paket baru ➔ Isi data lengkap ➔ Simpan sebagai `Draft` ➔ Verifikasi bahwa paket belum muncul di publik ➔ Ubah status ke `Published` ➔ Buka katalog publik.
- **Ekspektasi**: Paket langsung tampil di katalog publik setelah status diubah ke `Published`.

### 11.2 Matriks Pengujian Akseptansi Bisnis (*User Acceptance Testing - UAT*)

| Kode UAT | Skenario Bisnis yang Diuji | Kriteria Penerimaan Bisnis | Status Uji |
| :--- | :--- | :--- | :---: |
| **UAT-01** | Menjelajahi informasi profil dan legalitas biro wisata di halaman About. | Informasi izin usaha, profil perusahaan, dan pemandu wisata tampil jelas dan meyakinkan. | [ ] |
| **UAT-02** | Mencari paket wisata berdasarkan kategori dan kata kunci destinasi. | Hasil pencarian instan dan akurat menampilkan paket yang relevan. | [ ] |
| **UAT-03** | Mengirim pertanyaan langsung melalui floating button WhatsApp. | Aplikasi WhatsApp otomatis terbuka dengan pesan pembuka ramah yang mencantumkan nama paket. | [ ] |
| **UAT-04** | Pelanggan memesan paket untuk rombongan keluarga besar (15 Pax). | Form menerima input, total pax tercatat benar, dan tidak terjadi kendala batas ukuran data. | [ ] |
| **UAT-05** | Admin memfilter daftar reservasi berdasarkan status `Pending` dan rentang tanggal. | Tabel reservasi hanya menampilkan transaksi yang sesuai filter dengan data akurat. | [ ] |
| **UAT-06** | Admin mengekspor atau mencetak rekap data reservasi pelanggan. | Data tercetak rapi sesuai struktur kolom nama, nomor kontak, paket, dan status pembayaran. | [ ] |
| **UAT-07** | Mengunggah foto dokumentasi tour resolusi tinggi (1920x1080) ke galeri. | Gambar berhasil terunggah, di-compress optimal, dan tampil cepat di galeri publik. | [ ] |
| **UAT-08** | Mengakses website melalui koneksi seluler lambat (simulasi 3G). | Struktur halaman dan teks utama tetap terbaca cepat sebelum seluruh gambar selesai dimuat. | [ ] |

---

## 12. Manajemen Cacat & Pelaporan Bug (*Bug Lifecycle*)

### 12.1 Klasifikasi Tingkat Keparahan (*Severity Levels*)
- **Critical (Blocker)**: Sistem inti lumpuh total, database corrupt, admin tidak bisa login sama sekali, atau transaksi reservasi gagal secara massal. Memerlukan penanganan darurat segera.
- **High**: Fitur utama tidak berjalan semestinya (misal: tombol submit form tidak merespons, status reservasi tidak dapat diperbarui), tetapi sistem secara umum masih aktif.
- **Medium**: Masalah fungsionalitas parsial yang memiliki *workaround* sementara (misal: filter pencarian tanggal tidak akurat, layout berantakan pada tablet tertentu).
- **Low / Cosmetic**: Kesalahan kecil antarmuka, salah ketik teks (*typo*), atau inkonsistensi margin/padding yang tidak mengganggu alur bisnis.

### 12.2 Format Standar Laporan Bug
```text
Kode Cacat     : BUG-RES-[Nomor]
Judul Masalah  : [Ringkasan singkat masalah yang terjadi]
Tingkat Bahaya : [Critical / High / Medium / Low]
Lingkungan     : [Staging / Localhost / Production]
Halaman / URL  : [URL tempat ditemukannya bug]
Perangkat/OS   : [Contoh: iPhone 14 / Safari iOS 17 / Windows 11 Chrome]

Langkah Reproduksi:
1. Buka halaman URL ...
2. Masukkan data input ...
3. Klik tombol ...

Hasil yang Diharapkan : [Perilaku sistem yang seharusnya terjadi]
Hasil yang Terjadi    : [Error, crash, atau perilaku salah yang terjadi]
Bukti Pendukung       : [Tangkapan layar / rekaman layar / log error server]
```

### 12.3 Alur Status Penyelesaian Bug
```text
Dilaporkan (Open) ──► Sedang Diperbaiki (In Progress) ──► Siap Diuji Ulang (Ready for Retest)
                                                                 │
Ditutup Selesai (Closed) ◄── Terverifikasi Sukses (Verified) ◄───┘ (Jika gagal: Kembali ke In Progress)
```

---

## 13. Kriteria Kesiapan Rilis (*Definition of Done*) & Quality Gates

Suatu fitur atau rilis versi hanya dapat dinyatakan **SELESAI (DONE)** dan diizinkan naik ke lingkungan produksi apabila memenuhi seluruh gerbang kualitas (*Quality Gates*) berikut:

```text
[Implementation] ──► [Lint & Type Check] ──► [Feature Tests] ──► [Security Check] ──► [UAT Approval] ──► [Production Deploy]
```

### 13.1 Checklist Kesiapan Rilis (*Release Readiness Checklist*)
- [ ] **Kualitas Kode**: Kode telah melalui *review*, diformat rapi via Laravel Pint, dan bebas dari error linting.
- [ ] **Uji Otomatis**: Seluruh rangkaian pengujian PHPUnit (`php artisan test`) lulus 100% tanpa kegagalan (*zero failures*).
- [ ] **Integritas Basis Data**: Migrasi berjalan lancar pada database staging dan terbukti *reversible* / aman.
- [ ] **Keamanan**: Mode debug (`APP_DEBUG=false`) terkonfirmasi mati; tidak ada kredensial atau API key yang bocor di repositori.
- [ ] **Penyimpanan Berkas**: Direktori upload terisolasi, symlink storage aktif, dan berkas executable diblokir.
- [ ] **Kinerja Web**: Aset frontend terkompilasi optimal via Vite (`npm run build`); seluruh gambar terkompresi.
- [ ] **Pembersihan Data Uji**: Seluruh data transaksi palsu, akun tester, dan konten dummy telah dibersihkan dari basis data produksi.
- [ ] **Persetujuan UAT**: Skenario akseptansi bisnis telah diverifikasi dan disetujui oleh pemilik produk.

---

## 14. Panduan Pengujian untuk Pengembang & AI Coding Agent

Bagi pengembang maupun AI Assistant yang mengelola repositori ini:
1. **Dilarang Menyatakan Tugas Selesai Tanpa Bukti Uji**: Setiap perubahan logika kode wajib disertai bukti eksekusi pengujian (output terminal pengujian atau verifikasi respons).
2. **Jalankan Uji yang Relevan Setelah Setiap Perubahan**:
   - Perubahan Controller / Route ➔ Jalankan feature test terkait.
   - Perubahan Skema Basis Data ➔ Verifikasi integritas migrasi dan rollback.
   - Perubahan Antarmuka Blade / CSS ➔ Periksa tampilan responsif mobile dan konsistensi tombol.
3. **Dilarang Menghapus atau Mematikan Test Demi Lolos Build**: Jika sebuah test gagal, perbaiki implementasi kode atau perbarui test case jika requirement bisnis memang telah berubah.
4. **Dilarang Mengabaikan Validasi atau Proteksi Keamanan**: Jangan pernah menonaktifkan CSRF middleware atau mematikan validasi data hanya untuk membuat request pengujian berhasil.
5. **Gunakan Konvensi Penamaan Test yang Deskriptif**: Tuliskan nama method pengujian dengan gaya snake_case yang menjelaskan perilaku sistem secara eksplisit:
   - `test_it_creates_pending_reservation_successfully()`
   - `test_it_rejects_past_travel_dates()`
   - `test_it_reuses_existing_customer_on_repeat_booking()`
   - `test_unauthenticated_user_cannot_access_admin_dashboard()`

---

## 15. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) - Gambaran Umum Proyek & Spesifikasi Teknis
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) - Kebutuhan Bisnis & Aturan Validasi
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) - Struktur Halaman & Navigasi
- [04-ui-ux-guidelines.md](file:///c:/laragon/www/pujatourtravel.com/docs/04-ui-ux-guidelines.md) - Panduan Desain & Standar Antarmuka
- [05-public-website.md](file:///c:/laragon/www/pujatourtravel.com/docs/05-public-website.md) - Arsitektur Website Publik
- [06-admin-cms.md](file:///c:/laragon/www/pujatourtravel.com/docs/06-admin-cms.md) - Panel Pengelolaan Konten (Admin CMS)
- [07-reservation-system.md](file:///c:/laragon/www/pujatourtravel.com/docs/07-reservation-system.md) - Alur & Mesin Pemesanan Paket
- [08-customer-management.md](file:///c:/laragon/www/pujatourtravel.com/docs/08-customer-management.md) - Manajemen Data Pelanggan & Riwayat
- [09-database.md](file:///c:/laragon/www/pujatourtravel.com/docs/09-database.md) - Skema Basis Data & Migrasi Eloquent
- [10-security.md](file:///c:/laragon/www/pujatourtravel.com/docs/10-security.md) - Standar Keamanan Aplikasi & Autentikasi
- [11-seo-and-analytics.md](file:///c:/laragon/www/pujatourtravel.com/docs/11-seo-and-analytics.md) - Strategi SEO & Analitik
- [12-integration.md](file:///c:/laragon/www/pujatourtravel.com/docs/12-integration.md) - Integrasi Layanan Eksternal (WhatsApp & Maps)
- [13-deployment.md](file:///c:/laragon/www/pujatourtravel.com/docs/13-deployment.md) - Spesifikasi Infrastruktur & Panduan Deployment
- **14-testing.md** - Strategi Pengujian & Penjaminan Mutu *(Dokumen ini)*
- [15-project-scope.md](file:///c:/laragon/www/pujatourtravel.com/docs/15-project-scope.md) - Ruang Lingkup Proyek & Batasan Rilis *(Dokumen Berikutnya)*
