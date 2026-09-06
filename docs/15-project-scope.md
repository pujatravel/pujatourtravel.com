# Project Scope & Boundary Specification

> Dokumen spesifikasi ruang lingkup proyek (*project scope*), batasan pekerjaan (*in-scope vs out-of-scope*), prioritas implementasi (MVP), prosedur manajemen perubahan (*change request*), alokasi jadwal kerja, serta kriteria penerimaan akhir (*acceptance deliverables*) Puja Tour Travel.

---

## 1. Pendahuluan & Sasaran Proyek

Dokumen ini mendefinisikan batasan formal pengembangan website **Puja Tour Travel** untuk memastikan proyek tetap fokus pada kebutuhan utama bisnis, terlaksana tepat waktu, terhindar dari pemekaran cakupan tak terkendali (*scope creep*), dan tidak terjebak dalam kompleksitas teknis berlebih (*anti-overengineering*).

### 1.1 Identitas & Tujuan Sistem
Sistem yang dibangun memadukan 6 fungsi utama dalam satu kesatuan platform yang efisien:
1. **Company Profile**: Menampilkan identitas resmi, legalitas, sejarah, dan nilai keunggulan biro wisata.
2. **Tour Catalog**: Menampilkan katalog paket wisata dinamis (Green Canyon, Pangandaran, Goa Lanang, dll.) lengkap dengan durasi, harga, fasilitas, dan rencana perjalanan (*itinerary*).
3. **Lead Generation & Reservation**: Menangkap minat pengunjung melalui formulir pemesanan paket wisata dan saluran pemesanan cepat via WhatsApp.
4. **Customer Database**: Mengelola basis data riwayat pemesanan pelanggan untuk memfasilitasi retensi dan pemesanan berulang (*repeat booking*).
5. **Content Management System (CMS)**: Panel administrasi mandiri agar pemilik bisnis dapat memperbarui konten, paket, foto, dan kontak tanpa menyentuh kode program.
6. **Search Engine & Marketing Foundation**: Struktur ramah SEO lokal dan pelacakan interaksi berbasis Google Analytics 4 (GA4).

```text
                                PUJA TOUR TRAVEL PLATFORM
                                           │
          ┌────────────────────────────────┼────────────────────────────────┐
          │                                │                                │
    WEBSITE PUBLIK                    ADMIN CMS                     BASIS DATA
  ├── Katalog Paket Wisata          ├── Pengelolaan Paket & Kategori  ├── Pelanggan (Customers)
  ├── Formulir Reservasi            ├── Pemrosesan Reservasi          ├── Reservasi (Reservations)
  ├── Profil & Legalitas            ├── Manajemen Data Pelanggan      ├── Riwayat Status Pemesanan
  ├── Galeri & Ulasan               ├── Pengaturan Konten & Media     ├── Paket Wisata & Galeri
  └── Tautan Cepat WhatsApp         └── Dashboard Operasional Ringkas └── Pengaturan Website
```

---

## 2. Rincian Ruang Lingkup Pekerjaan (*In-Scope*)

Berikut adalah modul dan fungsionalitas yang masuk dalam cakupan rilis Minimum Viable Product (MVP):

### 2.1 Website Publik (*Public Website*)
- **Beranda (Homepage)**: Hero banner, nilai keunggulan (*trust items*), cuplikan paket unggulan, ringkasan profil, cuplikan galeri, testimoni pilihan, widget kontak & peta, footer lengkap, dan floating button WhatsApp.
- **Halaman Tentang Kami (`/tentang-kami`)**: Visi misi, sejarah perusahaan, legalitas resmi, sertifikasi, serta profil pemandu wisata.
- **Katalog Paket Wisata (`/paket-wisata`)**: Daftar paket berstatus `Published`, filter kategori destinasi, kartu informasi harga, dan paginasi.
- **Detail Paket Wisata (`/paket-wisata/{slug}`)**: Informasi harga per pax, durasi, fasilitas termasuk & tidak termasuk (*inclusions & exclusions*), timeline *itinerary*, galeri foto, serta tombol CTA menuju formulir reservasi.
- **Galeri Foto (`/galeri`)**: Dokumentasi visual perjalanan tour beresolusi optimal dengan deskripsi singkat.
- **Testimoni Pelanggan (`/testimonial`)**: Ulasan nyata pelanggan beserta informasi asal kota atau nama paket.
- **Formulir Pemesanan (`/reservasi`)**: Formulir pemesanan responsif dengan pemilihan paket, penentuan tanggal tour, jumlah pax, dan catatan kebutuhan khusus.
- **Halaman Kontak (`/kontak`)**: Informasi alamat kantor, jam operasional, email, nomor telepon, tautan WhatsApp, dan peta interaktif.

### 2.2 Panel Pengelolaan Konten (Admin CMS)
- **Autentikasi Aman**: Login staf admin dengan proteksi *brute-force*, CSRF, dan manajemen sesi.
- **Dashboard Operasional**: Menampilkan metrik total pelanggan, total reservasi, reservasi pending, dan grafik performa paket.
- **Manajemen Paket Wisata**: CRUD lengkap paket wisata, kategori, penetapan harga, pengelolaan fasilitas/itinerary, serta status publikasi (`Draft`, `Published`, `Archived`).
- **Manajemen Reservasi**: Pemantauan data masuk, verifikasi pesanan, pembaruan status (`Pending` ➔ `Processing` ➔ `Confirmed` ➔ `Completed` / `Cancelled`), serta pencatatan log riwayat status.
- **Manajemen Pelanggan**: Registrasi otomatis pelanggan dari form reservasi, normalisasi nomor WhatsApp, riwayat transaksi per pelanggan, serta atribusi sumber (*acquisition source*).
- **Pengelolaan Media & Berkas**: Unggah gambar teroptimasi, sanitasi nama berkas, validasi tipe MIME, dan proteksi eksekusi skrip di folder penyimpanan.
- **Pengaturan Website & SEO**: Konfigurasi nama bisnis, kontak, alamat, tautan media sosial, favicon, meta tag global, dan integrasi analitik.

### 2.3 Integrasi Pihak Ketiga (*Third-Party Integrations*)
- **WhatsApp Direct Booking**: Generator tautan deep link WhatsApp dengan nomor resmi dan template pesan terenkode otomatis berdasarkan paket yang dipilih.
- **Google Maps**: Penyematan peta iframe lokasi kantor fisik Puja Tour Travel dengan tautan pembuka aplikasi Google Maps eksternal.
- **Google Analytics 4**: Pelacakan event kunci non-PII (`page_view`, `whatsapp_click`, `reservation_submit`).

---

## 3. Batasan di Luar Ruang Lingkup (*Out-of-Scope*)

Untuk mencegah pembengkakan arsitektur dan menjaga kestabilan peluncuran MVP, fitur-fitur berikut **tidak termasuk** dalam cakupan kontrak tahap ini dan dialokasikan sebagai rencana pengembangan lanjutan (*Future Roadmap*):

| Modul / Fitur | Status Scope | Penjelasan & Rencana Alternatif |
| :--- | :---: | :--- |
| **Online Payment Gateway** (Midtrans, Xendit, Doku) | **Out-of-Scope** | Pembayaran dan verifikasi bukti transfer ditangani secara personal oleh admin via WhatsApp atau mutasi manual. |
| **Real-time Inventory & Room Availability Engine** | **Out-of-Scope** | Ketersediaan kuota tour dan penginapan dikonfirmasi secara manual oleh staf operasional setelah reservasi masuk. |
| **Sistem Tiket Pesawat & Kereta Api** | **Out-of-Scope** | Layanan berfokus eksklusif pada paket wisata darat/laut lokal Pangandaran dan sekitarnya. |
| **Aplikasi Mobile Native** (Android APK / iOS IPA) | **Out-of-Scope** | Digantikan dengan antarmuka web responsif performa tinggi yang ramah peramban ponsel pintar (*mobile web*). |
| **Bot Chat Otomatis / AI Chatbot** | **Out-of-Scope** | Percakapan chat WhatsApp dilayani langsung oleh tim *customer service* manusia untuk menjaga sentuhan personal. |
| **Sistem Keuangan, Invoicing & Payroll ERP** | **Out-of-Scope** | Pembukuan dan penggajian internal dikelola melalui sistem akuntansi terpisah milik perusahaan. |
| **Multi-Vendor Marketplace & Afiliasi** | **Out-of-Scope** | Website bersifat eksklusif satu vendor (*single-merchant*) milik Puja Tour Travel. |
| **Mesin Kupon Diskon & Poin Loyalitas Rumit** | **Out-of-Scope** | Penyesuaian diskon khusus rombongan ditangani manual pada saat konfirmasi admin. |

---

## 4. Matriks Prioritas Implementasi (MoSCoW / MVP Priority)

Implementasi fitur berpedoman pada prinsip prioritas ketat agar fondasi aplikasi berdiri kokoh sebelum pengerjaan fitur pendukung:

```text
[P0: Kritis (Must-Have)] ──► [P1: Penting (Should-Have)] ──► [P2: Tambahan (Could-Have)]
```

### 4.1 Prioritas P0 — Kritis (*Must-Have*)
*Wajib selesai 100% agar sistem dapat berfungsi dan layak dirilis ke publik:*
- Arsitektur Laravel, konfigurasi database MySQL, dan sistem migrasi Eloquent.
- Autentikasi dan otorisasi Admin CMS.
- Website publik: Beranda, katalog paket wisata, dan detail paket.
- Mesin reservasi: Formulir publik, validasi data server-side, dan pembuatan record pesanan.
- Database pelanggan: Pencatatan profil dan pencegahan duplikasi nomor kontak.
- Pengerasan keamanan: Proteksi CSRF, sanitasi XSS, PDO binding, dan enkripsi sesi.
- Infrastruktur produksi: Setup VPS, Nginx reverse proxy, SSL Let's Encrypt, dan pencadangan database.

### 4.2 Prioritas P1 — Penting (*Should-Have*)
*Menyempurnakan kredibilitas bisnis, aspek legalitas, dan saluran konversi:*
- Halaman Tentang Kami, legalitas dokumen resmi, dan profil pemandu wisata.
- Halaman Galeri foto dokumentasi dan halaman Testimoni pelanggan.
- Integrasi tombol interaktif WhatsApp deep link dan sematan Google Maps.
- Pengaturan identitas dan kontak website via CMS.
- Fondasi SEO on-page, XML Sitemap, `robots.txt`, dan pelacakan Google Analytics 4.
- Filter dan pencarian data reservasi pada panel admin.

### 4.3 Prioritas P2 — Peningkatan Lanjutan (*Could-Have / Future*)
*Fitur penyempurna yang dapat dikembangkan pasca-rilis MVP:*
- Otomatisasi integrasi WhatsApp Business API via webhook provider.
- Ekspor rekapitulasi data reservasi ke format spreadsheet (Excel / CSV).
- Integrasi payment gateway otomatis untuk pembayaran uang muka (DP).
- Kalender reservasi interaktif (*interactive booking calendar*) pada dashboard admin.

---

## 5. Prosedur Manajemen Perubahan (*Change Request*)

Setiap permintaan penambahan fitur, perubahan alur, atau modifikasi desain yang berada di luar dokumen spesifikasi ini harus melalui prosedur resmi *Change Request* (CR) untuk mengevaluasi dampaknya terhadap anggaran dan jadwal rilis.

```text
Usulan Kebutuhan Baru ──► Analisis Dampak Teknis ──► Evaluasi Biaya & Jadwal ──► Persetujuan Bersama ──► Eksekusi Kode
```

### 5.1 Klasifikasi Jenis Perubahan

| Kategori | Batasan & Kriteria | Dampak Terhadap Proyek |
| :--- | :--- | :--- |
| **Revisi Minor** | - Penyesuaian teks konten, tipografi, dan label tombol.<br>- Perbaikan margin, padding, atau variasi palet warna sekunder.<br>- Penataan ulang susunan section konten tanpa menambah entitas database. | Termasuk dalam kuota pemeliharaan proyek reguler; tidak mengubah jadwal rilis utama. |
| **Perubahan Mayor (CR)** | - Penambahan entitas atau tabel baru pada basis data.<br>- Pengubahan alur kerja utama reservasi atau autentikasi.<br>- Integrasi payment gateway, API pihak ketiga baru, atau aplikasi mobile.<br>- Perombakan desain arsitektur antarmuka secara menyeluruh. | Memerlukan dokumen *Change Request* terpisah, estimasi biaya tambahan, dan perpanjangan jadwal rilis. |

---

## 6. Garansi, SLA & Dukungan Pemeliharaan (*Warranty Scope*)

### 6.1 Batasan Garansi Proyek
- **Masa Garansi**: Berlaku selama **30 (tiga puluh) hari kalender** terhitung sejak tanggal penandatanganan Berita Acara Serah Terima (BAST) / persetujuan UAT final.
- **Cakupan Garansi (Ditanggung Pengembang)**:
  - Perbaikan kesalahan teknis (*bugs*) pada fitur yang telah disepakati dalam ruang lingkup.
  - Penanganan error aplikasi yang menyebabkan alur reservasi atau admin terhenti.
  - Perbaikan ketidaksesuaian tampilan antarmuka dengan panduan desain yang disetujui.
- **Pengecualian Garansi (Di Luar Tanggung Jawab Pengembang)**:
  - Kerusakan yang disebabkan oleh manipulasi kode sumber atau konfigurasi server oleh pihak ketiga tanpa izin tertulis.
  - Gangguan layanan eksternal di luar kendali teknis (gangguan jaringan WhatsApp, downtime server Cloudflare, perubahan kebijakan Google Maps).
  - Masalah akibat kelalaian pembayaran perpanjangan sewa domain atau VPS oleh pemilik bisnis.
  - Penambahan fitur baru yang tidak tercantum dalam dokumen ruang lingkup MVP.

---

## 7. Rencana Jadwal Pengerjaan (*Project Timeline*)

Total estimasi pengerjaan proyek dirancang dalam durasi **4 hingga 5 minggu kalender**:

```text
[Minggu 1: Fondasi] ──► [Minggu 2: Publik & CMS] ──► [Minggu 3: Reservasi] ──► [Minggu 4: Integrasi & Uji] ──► [Minggu 5: UAT & Go-Live]
```

| Fase & Waktu | Target Pencapaian (*Milestones*) | Luaran Kerja (*Deliverables*) |
| :--- | :--- | :--- |
| **Minggu 1**<br>Fondasi & Arsitektur | Setup repositori Laravel, migrasi skema basis data, sistem autentikasi admin, dan implementasi design system tokens. | Basis data siap pakai, model Eloquent, rute autentikasi admin aktif. |
| **Minggu 2**<br>Publik & CMS Core | Pembangunan layout beranda, halaman tentang kami, galeri, serta modul CRUD paket wisata pada admin CMS. | Tampilan website publik awal dan panel pengelolaan paket wisata. |
| **Minggu 3**<br>Mesin Reservasi | Pembangunan formulir reservasi, mesin validasi input, pencatatan pelanggan, dan modul pemrosesan reservasi admin. | Alur reservasi dari frontend ke backend admin berfungsi penuh. |
| **Minggu 4**<br>Integrasi & Testing | Integrasi WhatsApp link, Google Maps, setup SEO & GA4, pengujian otomatis PHPUnit, serta penanganan error. | Rangkaian automated test lulus, website ramah SEO dan terintegrasi. |
| **Minggu 5**<br>UAT & Peluncuran | Uji akseptansi pengguna (UAT) bersama klien, perbaikan bug minor, deployment ke VPS produksi, dan verifikasi akhir. | Website aktif di domain resmi (`pujatourtravel.com`) dengan SSL aktif. |

---

## 8. Hasil Kerja Utama (*Deliverables*)

Pada akhir masa pengerjaan proyek, pihak pengembang menyerahkan luaran resmi berikut:
1. **Source Code Aplikasi**: Repositori kode bersih berbasis Laravel, teruji, dan terdokumentasi rapi.
2. **Basis Data Produksi**: Skema MySQL terstruktur lengkap dengan migrasi teruji dan data konfigurasi awal.
3. **Panel Admin CMS Aktif**: Akses akun administrator untuk mengelola konten dan reservasi.
4. **Infrastruktur VPS Siap Pakai**: Konfigurasi Nginx, PHP-FPM, UFW firewall, dan sertifikat SSL aktif.
5. **Cadangan Basis Data Awal**: Snapshot cadangan basis data pra-peluncuran (*pre-launch backup*).
6. **Dokumentasi Lengkap Proyek**: Panduan teknis komprehensif (`docs/01` s/d `docs/15`) dan petunjuk instalasi pada `README.md`.

---

## 9. Kriteria Penerimaan Akhir (*Final Acceptance Checklist*)

Proyek dinyatakan rampung secara sah apabila seluruh kriteria penerimaan berikut terpenuhi:

- [ ] **Tampilan Responsif**: Seluruh halaman publik tampil rapi dan proporsional di perangkat Mobile, Tablet, dan Desktop tanpa *horizontal scrollbar*.
- [ ] **Katalog Paket Wisata**: Admin dapat membuat, mengubah, menerbitkan, dan mengarsipkan paket wisata; data langsung tercermin pada katalog publik.
- [ ] **Alur Reservasi Sukses**: Pengunjung dapat mengisi dan mengirim form pemesanan; data tersimpan di basis data dengan status `Pending`.
- [ ] **Pencegahan Duplikasi Pelanggan**: Pemesanan kedua oleh pelanggan yang sama berhasil ditautkan ke riwayat profil pelanggan yang ada.
- [ ] **Panel Admin CMS Berfungsi Penuh**: Seluruh menu (Paket, Reservasi, Pelanggan, Galeri, Testimoni, Pengaturan) beroperasi tanpa error server.
- [ ] **Integrasi Eksternal Berjalan**: Tombol WhatsApp mengarahkan ke nomor tujuan resmi; widget Google Maps memuat peta lokasi kantor.
- [ ] **Keamanan Terverifikasi**: Mode debug nonaktif (`APP_DEBUG=false`), proteksi CSRF aktif, dan direktori upload terproteksi dari eksekusi skrip.
- [ ] **Pengujian Selesai**: Seluruh uji otomatis PHPUnit lulus; skenario UAT bisnis telah ditinjau dan disetujui.
- [ ] **Deployment Berhasil**: Website dapat diakses publik melalui domain resmi via protokol aman HTTPS dengan sertifikat valid.
- [ ] **Serah Terima Dokumentasi**: Seluruh 15 berkas spesifikasi teknis telah lengkap, terstruktur, dan diserahkan.

---

## 10. Aturan Pengendalian Ruang Lingkup untuk AI Coding Agent

Bagi AI Coding Assistant (Antigravity) maupun pengembang yang mengeksekusi proyek ini:
1. **Fokus pada Persyaratan Tertulis**: Implementasikan fitur sesuai spesifikasi yang telah didefinisikan. Dilarang menambahkan arsitektur kompleks (*overengineering*) tanpa instruksi eksplisit.
2. **Patuhi Batasan Out-of-Scope**: Jangan pernah mengimplementasikan payment gateway, sistem login pelanggan mandiri, atau bot otomatisasi kecuali terdapat persetujuan *Change Request*.
3. **Pertahankan Sifat Dinamis Data**: Dilarang melakukan *hardcode* teks paket, harga, nomor telepon, atau data bisnis lainnya di dalam file Blade view jika data tersebut seharusnya dapat dikelola via CMS.
4. **Dilarang Membuat Data Dummy di Produksi**: Data fiktif hanya diizinkan di lingkungan lokal/testing melalui Laravel Factories dan Seeders.
5. **Kendalikan Dependensi Eksternal**: Hindari instalasi paket (*Composer / NPM package*) berlebihan yang tidak esensial untuk kebutuhan MVP.
6. **Prioritaskan Kestabilan Sistem**: Setiap penambahan kode harus mempertimbangkan kesesuaian basis data, API, antarmuka, keamanan, dan prosedur deployment.

---

## 11. Struktur Dokumentasi Proyek Lengkap

Dengan selesainya dokumen ini, seluruh rangkaian 15 dokumen spesifikasi teknis proyek **Puja Tour Travel** telah rampung dan saling terhubung secara utuh:

```text
c:/laragon/www/pujatourtravel.com/
├── README.md
└── docs/
    ├── 01-project-overview.md       (Gambaran Umum Proyek & Spesifikasi Teknis)
    ├── 02-business-requirements.md   (Kebutuhan Bisnis & Aturan Validasi)
    ├── 03-sitemap-and-pages.md       (Struktur Halaman & Navigasi)
    ├── 04-ui-ux-guidelines.md        (Panduan Desain & Standar Antarmuka)
    ├── 05-public-website.md          (Arsitektur Website Publik)
    ├── 06-admin-cms.md               (Panel Pengelolaan Konten / Admin CMS)
    ├── 07-reservation-system.md      (Alur & Mesin Pemesanan Paket)
    ├── 08-customer-management.md     (Manajemen Data Pelanggan & Riwayat)
    ├── 09-database.md                (Skema Basis Data & Migrasi Eloquent)
    ├── 10-security.md                (Standar Keamanan Aplikasi & Autentikasi)
    ├── 11-seo-and-analytics.md       (Strategi SEO & Analitik GA4)
    ├── 12-integration.md             (Integrasi Layanan WhatsApp & Google Maps)
    ├── 13-deployment.md              (Spesifikasi Infrastruktur & Panduan Rilis)
    ├── 14-testing.md                 (Strategi Pengujian & Penjaminan Mutu)
    └── 15-project-scope.md           (Ruang Lingkup Proyek & Pengendali Scope - Dokumen ini)
```

---

## 12. Dokumen Terkait

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
- [14-testing.md](file:///c:/laragon/www/pujatourtravel.com/docs/14-testing.md) - Strategi Pengujian & Penjaminan Mutu
- **15-project-scope.md** - Ruang Lingkup Proyek & Batasan Rilis *(Dokumen ini)*
