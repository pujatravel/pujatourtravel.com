# 01 — Project Overview
# Puja Tour Travel Website

> Dokumen ini merupakan dasar pemahaman proyek sebelum proses development dimulai.
> Semua keputusan teknis dan implementasi harus tetap mengacu pada kebutuhan bisnis
> yang dijelaskan dalam dokumentasi proyek lainnya.

---

# 1. Project Identity & Architecture

### 1.1 Project Identity
- **Project Name**: Puja Tour Travel Website
- **Business Name**: Puja Tour Travel
- **Industry**: Biro Perjalanan Wisata / Travel & Tour Lokal
- **Primary Location**: Pangandaran, Jawa Barat, Indonesia

### 1.2 Project Type
Website ini bukan sekadar website profil statis (*static company profile*), melainkan sebuah aplikasi web dinamis (*database-driven digital business platform*) yang mengintegrasikan:
1. **Public Website**: Menampilkan profil, katalog paket wisata, galeri, testimonial, informasi legalitas, dan peta lokasi.
2. **Online Reservation System**: Menampung formulir permintaan reservasi paket wisata dari wisatawan secara terstruktur.
3. **Lead Generation & WhatsApp Integration**: Mendorong konversi cepat melalui tombol WhatsApp kontekstual dan formulir reservasi.
4. **Customer Management System (CRM Lite)**: Mencatat basis data pelanggan dan riwayat transaksi masa lalu (*multi-reservation*).
5. **Lead Source Tracking**: Melacak saluran perolehan pelanggan (Instagram, TikTok, Website, Referral, dll.).
6. **Admin Dashboard & CMS**: Panel kontrol terproteksi untuk mengelola seluruh konten, paket wisata, harga, galeri, dan reservasi tanpa mengubah kode sumber.

---

# 2. Project Purpose & Business Positioning

### 2.1 Project Purpose
Membangun platform resmi Puja Tour Travel sebagai pusat informasi digital terpercaya yang menghubungkan calon wisatawan dengan keindahan Pangandaran, sekaligus mempermudah manajemen operasional dan reservasi internal.

### 2.2 About Puja Tour Travel
Puja Tour Travel adalah biro wisata lokal yang berfokus menghadirkan pengalaman perjalanan yang aman, nyaman, informatif, dan sarat nilai kearifan lokal di wilayah Pangandaran dan sekitarnya (Green Canyon, Batu Karas, Cagar Alam Pananjung, dll.).

### 2.3 Business Positioning
> **Puja Tour Travel sebagai mitra perjalanan lokal terpercaya di Pangandaran yang mendampingi wisatawan menikmati destinasi secara nyaman, aman, terencana, dan bermakna.**

### 2.4 Core Business Values
- **Local Experience**: Menguasai destinasi lokal Pangandaran secara mendalam dan menyajikan pengalaman autentik.
- **Safety**: Mengedepankan keselamatan wisatawan (peralatan standar, asuransi, pemandu tersertifikasi).
- **Professional Service**: Pelayanan ramah, terorganisir, transparan, dan responsif.
- **Local Wisdom**: Mendukung pelestarian alam, konservasi (penyu/mangrove), dan pemberdayaan masyarakat lokal.

---

# 3. Website Objectives

| No | Sasaran Utama | Deskripsi Implementasi |
|---|---|---|
| **1** | **Brand Awareness** | Menjadi identitas digital resmi agar calon wisatawan mudah menemukan dan mengenali kredibilitas bisnis. |
| **2** | **Trust Building** | Meyakinkan wisatawan melalui legalitas resmi (CV), foto pemandu, asuransi, dokumentasi riil, dan ulasan pelanggan. |
| **3** | **Package Promotion** | Menampilkan katalog paket wisata lengkap beserta rincian fasilitas (*inclusions/exclusions*) dan itinerary. |
| **4** | **Lead Generation** | Menyediakan saluran konversi yang jelas (CTA WhatsApp dan formulir reservasi online). |
| **5** | **Structured Reservation** | Merekam permintaan pemesanan langsung ke database, menghilangkan kekacauan pencatatan manual di chat. |
| **6** | **Customer Tracking** | Memantau histori pelanggan untuk mengenali pemesanan berulang (*repeat orders*) dan sumber akuisisi. |

---

# 4. Target User Personas & Roles

```text
[PUBLIC VISITOR / CUSTOMER]
Akses publik tanpa login ──► Cari Informasi ──► Lihat Paket ──► Chat WhatsApp / Kirim Reservasi

[ADMINISTRATOR]
Login terproteksi ──► Kelola Konten & Harga ──► Proses Reservasi ──► Kelola Data Customer
```

- **Public Visitor**: Wisatawan domestik/internasional yang mencari informasi paket wisata, memeriksa fasilitas/harga, dan melakukan reservasi.
- **Administrator**: Staf internal atau pemilik Puja Tour Travel yang mengelola operasional website, memantau metrik performa, dan merespons pemesanan.

---

# 5. Core System Architecture & Concepts

### 5.1 Database-Driven Architecture
Seluruh data operasional bisnis wajib bersumber dari basis data (MySQL) dan tidak boleh di-*hardcode* pada tampilan frontend:
- Nama paket, deskripsi, harga, fasilitas, itinerary
- Kontak resmi bisnis, nomor WhatsApp, akun media sosial
- Konten beranda, visi-misi, dokumen legalitas, profil pemandu wisata

### 5.2 Integritas Harga Historis (*Price Integrity*)
Sistem memisahkan harga jual saat ini (`package.price`) dengan harga saat pemesanan disepakati (`reservation.booking_price`). Perubahan harga paket di masa depan **tidak boleh** merusak atau mengubah data historis reservasi lama.

---

# 6. Functional Modules Overview

### 6.1 Tour Package System
- **Kategori Awal**:
  - *Eksklusif*: Paket privat/VIP (Green Canyon VIP, resort, dokumentasi drone).
  - *Semi Edukasi*: Wisata alam & konservasi (Cagar Alam, Penyu, Mangrove, Goa Lanang).
  - *Nuansa Budaya*: Kearifan lokal, workshop pengolahan hasil laut, seni tradisi.
- **Status Publikasi**:
  - `Draft`: Hanya dapat diakses di admin CMS.
  - `Published`: Aktif tampil di katalog publik dan form reservasi.
  - `Archived`: Dinonaktifkan dari katalog publik tetapi dipertahankan untuk integritas histori transaksi.

### 6.2 Reservation System
Alur siklus status reservasi:
```text
Customer Kirim Form ──► [Pending] ──► [Diproses] ──► [Dikonfirmasi] ──► [Selesai]
                                │             │              │
                                └─────────────┴──────────────┴──► [Dibatalkan]
```
- **Informasi Wajib**: Data Pelanggan, Paket Wisata, Tanggal Perjalanan (`travel_date >= today`), Jumlah Peserta (integer > 0), dan Sumber (*Source*).

### 6.3 Customer Management & Source Tracking
- Entitas **Customer** terpisah dari entitas **Reservation** (*1 Customer Has Many Reservations*).
- Sistem mengenali pelanggan lama melalui nomor WhatsApp untuk menghindari duplikasi data.
- Setiap pemesanan mencatat asal saluran (*Source*): `Website`, `Instagram`, `TikTok`, `Facebook`, `WhatsApp`, `Referral`, `Offline`, atau `Other`.

### 6.4 Integrasi Konversi & Peta
- **WhatsApp Integration**: Floating button di semua halaman publik, serta CTA kontekstual pada halaman detail paket yang menyertakan nama paket secara otomatis saat membuka chat.
- **Google Maps**: Menampilkan alamat kantor fisik dengan titik koordinat GPS aktual (latitude/longitude).

---

# 7. Technical & Non-Functional Requirements

### 7.1 Keamanan & Otentikasi
- Halaman dashboard admin wajib dilindungi oleh otentikasi sesi dan password hashing yang aman.
- Otorisasi hak akses divalidasi di backend pada setiap pemanggilan endpoint/API.
- Data sensitif pelanggan (nomor HP, email, catatan admin) bersifat privat dan tidak boleh terekspos ke publik.
- Seluruh kredensial rahasia (API key, password database) disimpan dalam file `.env` dan tidak boleh di-*commit* ke repositori Git.

### 7.2 Mobile-First & Responsif
- Desain antarmuka dirancang dengan pendekatan *Mobile-First*, mengingat mayoritas wisatawan mengakses website melalui smartphone.
- Antarmuka beroperasi mulus pada ponsel cerdas, tablet, maupun layar desktop.

### 7.3 Standar UI State & Form Validation
Setiap komponen data dinamis wajib memiliki 4 status tampilan:
1. **Loading State**: Animasi indikator saat memuat data.
2. **Empty State**: Pesan informatif bila belum ada data (misal: "Belum ada paket wisata tersedia").
3. **Error State**: Pesan jelas bila koneksi atau pengambilan data gagal.
4. **Success State**: Konfirmasi keberhasilan aksi (misal: "Permintaan reservasi berhasil dikirim").

Validasi formulir wajib dijalankan secara berlapis pada sisi **Frontend** (validasi instan UX) dan **Backend** (keamanan data mutlak).

### 7.4 Optimasi Performa & SEO
- **Performa**: Kompresi gambar optimal, *lazy loading*, kueri basis data efisien, dan membatasi animasi berlebihan.
- **SEO & Social Sharing**: URL ramah mesin pencari, struktur HTML semantik, meta description, sitemap, serta tag Open Graph (`og:title`, `og:image`, `og:description`) untuk tampilan pratinjau rapi saat dibagikan ke media sosial.

---

# 8. Project Scope & Boundaries

### 8.1 Lingkup Inti (*Core Scope*)
- Public Website responsif (Beranda, Paket Wisata, Detail Paket, Galeri, Testimonial, Legalitas, Panduan, Kontak).
- Sistem Formulir Permintaan Reservasi & Pelacakan Sumber.
- Integrasi WhatsApp Kontekstual & Peta Lokasi Google Maps.
- Dashboard Admin, Manajemen Paket, Manajemen Reservasi, Manajemen Customer, dan CMS Konten Dinamis.

### 8.2 Di Luar Cakupan Awal (*Out of Scope*)
Fitur-fitur berikut tidak termasuk dalam rilis awal:
- Payment gateway otomatis (kartu kredit, e-wallet instan) — pembayaran ditangani via transfer manual / konfirmasi admin.
- Aplikasi mobile native (Android / iOS).
- Integrasi API pemesanan tiket pesawat atau kamar hotel pihak ketiga.
- Sistem multi-vendor / marketplace tour guide.
- Chatbot AI otomatis atau bot WhatsApp auto-reply.
- Sistem penggajian (*payroll*) atau pembukuan akuntansi kompleks.

### 8.3 Filosofi Pengembangan
> **Sederhana, aman, mudah dipelihara, dan tepat guna.**
Hindari *overengineering* (misal: arsitektur microservices, message broker rumit, atau dependensi berlebih) yang tidak memberikan nilai bisnis langsung.

---

# 9. AI Coding Agent & Developer Rules

1. **Anti-Halusinasi Data Bisnis**: Dilarang keras mengarang data resmi (nomor WhatsApp, alamat, dokumen izin usaha, testimoni palsu). Gunakan placeholder standar jika data belum ada: `[BUSINESS WHATSAPP]`, `[BUSINESS ADDRESS]`, `NEEDS CONFIRMATION`.
2. **Database Integrity**: Gunakan migrasi Laravel resmi untuk setiap perubahan skema tabel.
3. **Penyimpanan Kode**: Pastikan kode PHP diformat dengan Laravel Pint (`vendor/bin/pint --format agent`) dan lolos pengujian otomatis (`php artisan test`).
4. **Data Privacy**: Jangan pernah mengekspos data pribadi pelanggan ke publik tanpa otentikasi admin.

---

# 10. Definition of Done (DoD)

Proyek dinyatakan selesai jika daftar periksa berikut terpenuhi secara fungsional:

### 10.1 Public Website
- [ ] Beranda menampilkan hero section, paket unggulan, nilai keunggulan, galeri, dan kontak.
- [ ] Halaman katalog paket dapat difilter berdasarkan kategori paket.
- [ ] Halaman detail paket menampilkan deskripsi lengkap, harga, fasilitas, pengecualian, dan itinerary.
- [ ] Tombol WhatsApp mengarahkan ke nomor resmi dengan pesan kontekstual nama paket.
- [ ] Formulir reservasi memvalidasi input tanggal perjalanan dan jumlah peserta secara tepat.
- [ ] Halaman profil memuat legalitas perusahaan, profil pemandu, galeri dokumentasi, dan ulasan pelanggan.

### 10.2 Admin Dashboard & CMS
- [ ] Otentikasi login admin berfungsi aman.
- [ ] Dashboard menampilkan ringkasan metrik (Total Paket, Reservasi Pending, Total Pelanggan).
- [ ] Manajemen Paket dapat menambah, mengedit, mempublikasikan, dan mengarsipkan paket wisata.
- [ ] Manajemen Reservasi dapat memfilter data, melihat detail pemesan, dan mengubah status reservasi.
- [ ] Manajemen Pelanggan mencatat riwayat pemesanan yang pernah dilakukan oleh pelanggan tersebut.
- [ ] Seluruh data kontak, sosial media, dan teks beranda dapat diubah melalui CMS.

### 10.3 Teknis & Lingkungan
- [ ] Tampilan responsif optimal di perangkat mobile smartphone.
- [ ] Semua rute admin terlindungi (*protected middleware*).
- [ ] Seluruh pengujian fitur dan unit test lolos tanpa galat.
- [ ] Berkas `.env` terkonfigurasi dengan benar untuk lingkungan lokal/produksi.

---

# 11. Dokumen Terkait

- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) — Rincian kebutuhan bisnis, alur reservasi, dan katalog aturan bisnis (*Business Rules*)
- `03-sitemap-and-pages.md` — Struktur halaman, hierarki URL, navigasi, dan rincian section UI
- `04-ui-ux-guidelines.md` — Panduan visual, palet warna, tipografi, dan komponen antarmuka
- `05-public-website.md` — Spesifikasi teknis implementasi website publik
- `06-admin-cms.md` — Arsitektur modul dan halaman dashboard admin
- `07-reservation-system.md` — Logika bisnis sistem pemesanan perjalanan
- `08-customer-management.md` — Spesifikasi modul manajemen pelanggan (CRM)
- `09-database.md` — Skema database, kamus data, relasi tabel, dan migrasi
- `10-security.md` — Kebijakan otentikasi, validasi data, dan keamanan sistem
