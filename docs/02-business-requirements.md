# 02 — Business Requirements
# Puja Tour Travel Website

> Dokumen ini mendefinisikan kebutuhan bisnis, target pengguna, aturan bisnis (*business rules*), serta kriteria penerimaan (*acceptance criteria*) untuk pengembangan website dan sistem administrasi Puja Tour Travel.
> Semua keputusan teknis, rancangan database, API, tampilan public, dan admin CMS harus mengacu pada dokumen ini.

---

# 1. Project Objective & Core Capabilities

Website Puja Tour Travel berfungsi sebagai platform digital terpadu yang mencakup:
- Website resmi profil bisnis (*Company Profile*)
- Media promosi digital & katalog paket wisata Pangandaran
- Saluran perolehan calon pelanggan (*Lead Generation Channel*)
- Sistem penerimaan permintaan reservasi (*Reservation Request System*)
- Manajemen data pelanggan terpusat (*Customer Management System*)
- Pengelolaan konten dinamis mandiri (*Content Management System / CMS*)

Sistem melayani dua kelompok aktor utama:

```text
[CUSTOMER / VISITOR]
Discover → Explore Packages → Inquire (WhatsApp) → Reserve

[ADMINISTRATOR]
Manage Content → Manage Packages → Manage Reservations → Manage Customers
```

---

# 2. Business Goals

### 2.1 Build Official Online Presence
- Website menjadi satu-satunya pusat informasi resmi (*single source of truth*) Puja Tour Travel.
- Mencegah informasi penting tersebar tidak terstruktur hanya di media sosial atau chat WhatsApp.
- Menjawab pertanyaan mendasar calon wisatawan:
  - Siapa Puja Tour Travel & legalitasnya.
  - Pilihan paket wisata, destinasi, dan itinerary perjalanan.
  - Fasilitas yang termasuk (*inclusions*) dan tidak termasuk (*exclusions*).
  - Informasi harga resmi dan tata cara pemesanan/kontak.

### 2.2 Increase Customer Trust
- Membangun keyakinan calon wisatawan sebelum melakukan reservasi melalui:
  - Transparansi legalitas entitas bisnis (CV).
  - Profil dan sertifikasi pemandu wisata (*tour guide*).
  - Standar keselamatan (*safety information & equipment*).
  - Galeri dokumentasi perjalanan aktual.
  - Testimonial riil dari pelanggan terdahulu.
  - Lokasi kantor dan kontak resmi yang dapat diverifikasi.
- **Aturan**: Jangan membuat klaim bisnis berlebihan (*unsubstantiated claims*) yang tidak didukung data resmi dari klien.

### 2.3 Generate Leads & Clear Conversion Points
- Setiap halaman website harus memiliki titik konversi yang jelas:
  - **Primary Conversion**: Permintaan Reservasi (*Reservation Request Form*) dan Tanya Pemandu via WhatsApp (*WhatsApp Inquiry*).
  - **Secondary Conversion**: Eksplorasi detail paket wisata, kunjungan media sosial, dan penelusuran galeri/profil.

### 2.4 Structured Reservation Management
- Setiap permintaan reservasi dari website harus tersimpan rapi ke dalam database sistem.
- Menghilangkan ketergantungan pencatatan manual di chat WhatsApp.
- Informasi minimal reservasi mencakup: Data Pelanggan, Paket Wisata, Tanggal Perjalanan, Jumlah Peserta, Sumber Permintaan (*Source*), Status, dan Catatan Tambahan.

### 2.5 Structured Customer Tracking (Multi-Reservation)
- Pelanggan dicatat sebagai entitas tersendiri yang dapat memiliki banyak riwayat reservasi (*1 Customer to Many Reservations*).
- Sistem mencatat riwayat pemesanan ulang (*repeat orders*) untuk analisis loyalitas pelanggan.

### 2.6 Dynamic Content Management (CMS)
- Administrator dapat mengubah seluruh konten publik website tanpa perlu menyentuh atau mengubah *source code*.
- Konten dinamis meliputi: Beranda, Paket Wisata, Harga, Itinerary, Galeri, Testimonial, Profil Guide, Legalitas, Kontak, Media Sosial, dan Pengaturan SEO.

---

# 3. Target Users & Permissions

| Tipe Pengguna | Deskripsi | Hak Akses & Kemampuan | Batasan |
|---|---|---|---|
| **Public Visitor** | Calon wisatawan yang mengakses website publik tanpa perlu akun/login. | - Menjelajahi beranda dan profil bisnis<br>- Melihat katalog dan detail paket wisata<br>- Memeriksa harga, fasilitas, dan itinerary<br>- Melihat galeri, testimonial, dan profil guide<br>- Mengirim form permintaan reservasi<br>- Menghubungi admin melalui tautan WhatsApp | Tidak memiliki akses ke admin dashboard dan data privat pengguna lain. |
| **Administrator** | Staf/pemilik internal Puja Tour Travel yang mengelola operasional digital. | - Otentikasi login aman<br>- Mengakses metrik dan ringkasan dashboard<br>- Mengelola paket, kategori, harga, dan itinerary<br>- Memproses dan memperbarui status reservasi<br>- Mengelola database pelanggan dan histori reservasi<br>- Mengelola galeri, testimonial, guide, dan legalitas<br>- Mengatur profil kontak, media sosial, dan SEO | Wajib menjaga kerahasiaan data privat pelanggan (*PII*). |

---

# 4. Customer Journey & Conversion Funnel

### 4.1 Customer Journey Flow
```text
Public Visitor
      │
      ▼
Homepage / Social Media Landing
      │
      ▼
Explore Tour Packages (Katalog)
      │
      ▼
Package Detail Page (Cek Itinerary, Fasilitas, & Harga)
      │
      ├──────────────────────────────┐
      ▼                              ▼
Submit Reservation Form        WhatsApp Direct Inquiry
      │                              │
      ▼                              ▼
Lead Recorded in Database      Direct Chat Follow-up
      │                              │
      └──────────────┬───────────────┘
                     ▼
             Admin Verification
                     │
                     ▼
             Confirmed Booking
                     │
                     ▼
               Trip Execution
                     │
                     ▼
           Trip Completed & Review
```

### 4.2 Conversion Funnel Stages
1. **Visitor**: Pengunjung unik yang mengakses website publik.
2. **Lead**: Pengunjung yang menunjukkan minat dengan mengisi form reservasi atau mengklik CTA WhatsApp kontekstual.
3. **Inquiry**: Tahap diskusi/konfirmasi detail perjalanan dengan admin.
4. **Confirmed Booking**: Reservasi yang telah diverifikasi dan disepakati tanggal serta biayanya.
5. **Customer**: Pelanggan yang telah terdaftar dalam sistem dengan transaksi aktif.
6. **Trip Completed**: Perjalanan selesai dilaksanakan; kandidat untuk pemberian testimonial.

---

# 5. Customer & Lead Source Tracking

Setiap reservasi yang masuk wajib memiliki atribut **Source** untuk mengukur efektivitas saluran pemasaran.

### 5.1 Definisi Saluran Sumber (Source Options)
- **Website**: Calon pelanggan menemukan website secara langsung/organik melalui mesin pencari (Google Search, Direct URL) lalu mengisi form reservasi.
- **Instagram**: Mengetahui Puja Tour Travel dari konten/iklan Instagram sebelum diarahkan ke website atau reservasi.
- **TikTok**: Mengetahui bisnis dari video/live TikTok.
- **Facebook**: Mengetahui bisnis dari grup, halaman, atau iklan Facebook.
- **WhatsApp**: Pelanggan menghubungi langsung via WhatsApp tanpa mengisi form website terlebih dahulu (diinput manual oleh admin).
- **Referral**: Rekomendasi dari pelanggan sebelumnya, mitra hotel, komunitas, atau relasi bisnis.
- **Offline**: Pelanggan datang langsung ke kantor fisik atau mendapatkan brosur cetak di lapangan.
- **Other**: Saluran lain di luar kategori standar.

> **Catatan Arsitektur**: *Source* (sumber akuisisi) dan *Contact Channel* (media komunikasi, misal WhatsApp) adalah dua hal berbeda. Contoh: Pelanggan bersumber dari Instagram, namun berkomunikasi melalui WhatsApp.

---

# 6. Tour Package Requirements

Paket wisata merupakan produk utama yang ditawarkan oleh Puja Tour Travel.

### 6.1 Data Fields Paket Wisata
| Field | Tipe Data | Keterangan |
|---|---|---|
| `name` | String | Nama paket wisata (contoh: *Green Canyon Body Rafting VIP*). |
| `slug` | String (Unique) | URL slug ramah SEO (contoh: `green-canyon-body-rafting-vip`). |
| `category` | Enum / FK | Kategori paket wisata. |
| `short_description` | Text | Ringkasan singkat untuk tampilan kartu (*card preview*). |
| `description` | LongText / HTML | Deskripsi lengkap mengenai pengalaman perjalanan. |
| `thumbnail` | String (Image URL) | Gambar sampul utama paket. |
| `price` | Decimal / Integer | Nilai nominal harga dasar. |
| `price_unit` | String | Satuan harga (contoh: `pax`, `orang`, `rombongan`). |
| `duration` | String | Durasi tur (contoh: `1 Hari`, `2H1M`, `3H2M`). |
| `location` | String | Lokasi destinasi utama (contoh: `Green Canyon, Pangandaran`). |
| `facilities` | JSON / Array | Daftar fasilitas yang termasuk (*inclusions*). |
| `exclusions` | JSON / Array | Daftar hal yang tidak termasuk dalam paket. |
| `itinerary` | JSON / Relation | Rincian susunan jadwal perjalanan (*time, activity, details*). |
| `featured` | Boolean | Penanda apakah paket ditampilkan di section unggulan beranda. |
| `status` | Enum | Status publikasi (`draft`, `published`, `archived`). |
| `gallery` | Relation / JSON | Koleksi foto/dokumentasi khusus paket terkait (*opsional*). |
| `seo_title` | String | Judul kustom untuk meta title browser (*opsional*). |
| `seo_description` | Text | Deskripsi kustom untuk search engine snippet (*opsional*). |
| `og_image` | String (Image URL) | Gambar preview saat tautan dibagikan ke medsos (*opsional*). |

### 6.2 Kategori Paket Wisata Awal
1. **Eksklusif**: Paket tur premium/privat dengan fasilitas lengkap (contoh: Green Canyon VIP, akomodasi resor, dokumentasi drone).
2. **Semi Edukasi**: Penggabungan wisata alam dengan edukasi konservasi (contoh: Cagar Alam Pananjung, Konservasi Penyu, Hutan Mangrove, Goa Lanang).
3. **Nuansa Budaya**: Pengalaman kearifan lokal, sentra pengolahan hasil laut, workshop seni tradisi, dan kuliner khas Pangandaran.

### 6.3 Siklus Status & Visibilitas Paket
```text
[Draft]     ──(Publish)──►  [Published]
  ▲                              │
  │                              ▼
(Edit)                     [Archived] (Disembunyikan dari publik, histori tetap ada)
```
- **Draft**: Hanya tampil pada admin CMS, tersembunyi dari website publik.
- **Published**: Ditampilkan aktif pada katalog publik dan dapat dipilih saat reservasi.
- **Archived**: Dinonaktifkan dari katalog publik, namun tetap tersimpan di sistem untuk menjaga integritas data reservasi historis.

### 6.4 Integritas Harga Historis (*Price Integrity*)
- Harga pada database bersifat dinamis dan dapat diperbarui oleh admin kapan saja.
- **Aturan Mutlak**: Perubahan harga pada paket wisata master **tidak boleh** mengubah nilai harga pemesanan pada data reservasi lama yang sudah tercatat.
- Sistem membedakan `package.price` (harga jual saat ini) dengan `reservation.booking_price` (harga yang disepakati saat pemesanan dibuat).

### 6.5 Fasilitas, Pengecualian, & Itinerary
- **Fasilitas (*Inclusions*)**: Pemandu lokal, transportasi, tiket masuk wisata, perlengkapan keselamatan/body rafting, makan, dokumentasi, asuransi (sesuai paket).
- **Pengecualian (*Exclusions*)**: Pengeluaran pribadi, transportasi luar kota asal, aktivitas opsional berbayar.
- **Itinerary**: Disimpan terstruktur per slot waktu:
  ```json
  [
    {"time": "08:00", "title": "Penjemputan", "location": "Hotel / Meeting Point", "description": "Briefing keselamatan bersama tour guide."},
    {"time": "09:30", "title": "Aktivitas Body Rafting", "location": "Green Canyon", "description": "Menjelajahi ngarai dan gua air selama 3 jam."}
  ]
  ```

---

# 7. Reservation Management System

Reservasi pada website adalah **permintaan perjalanan awal (*Reservation Request*)**, bukan sistem tiket instan dengan pemotongan kuota otomatis.

### 7.1 Alur Pemrosesan Reservasi
```text
Customer Kirim Request
       │
       ▼
Status: PENDING
       │ (Admin meninjau ketersediaan slot & menghubungi customer)
       ▼
Status: DIPROSES
       │ (Kesepakatan jadwal & pembayaran DP/lunas)
       ▼
Status: DIKONFIRMASI
       │ (Trip telah sukses dilaksanakan)
       ▼
Status: SELESAI

*Catatan: Dari status PENDING, DIPROSES, atau DIKONFIRMASI dapat berpindah ke DIBATALKAN bila ada pembatalan resmi.
```

### 7.2 Struktur Data Reservasi
- **Data Wajib**:
  - `customer_id`: Relasi ke data pelanggan.
  - `package_id`: Relasi ke paket wisata yang dipilih.
  - `travel_date`: Tanggal rencana perjalanan (`travel_date >= today`).
  - `participant_count`: Jumlah peserta perjalanan (bilangan bulat > 0).
  - `source`: Saluran asal pemesanan.
  - `status`: Status reservasi saat ini.
- **Data Opsional / Tambahan**:
  - `custom_itinerary`: Permintaan rute atau destinasi tambahan khusus dari pelanggan.
  - `special_requests`: Permintaan khusus (menu makanan vegetarian, penjemputan bandara/stasiun, kebutuhan lansia/anak).
  - `admin_notes`: Catatan internal admin (tidak dapat dilihat oleh customer).
  - `cancellation_reason`: Alasan pembatalan jika status diubah menjadi Dibatalkan.

### 7.3 Validasi Aturan Reservasi
- `travel_date`: Wajib berupa tanggal valid masa depan atau hari ini. Tidak boleh menerima tanggal lampau.
- `participant_count`: Wajib berupa integer positif minimal 1 orang.
- `phone / whatsapp`: Wajib nomor telepon valid yang dapat dihubungi melalui WhatsApp.

---

# 8. Customer Management (CRM Lite)

Data pelanggan dipisahkan dari entitas transaksi reservasi agar bisnis dapat mengelola basis data wisatawan jangka panjang.

### 8.1 Struktur Data Customer
```text
Customer (Master Entity)
├── ID
├── Name
├── Phone / WhatsApp
├── Email (Opsional)
├── Acquisition Source
├── Internal Notes
├── Created At & Updated At
└── Reservations (HasMany)
     ├── Reservation #001 (Misal: Green Canyon - 2026-04-10 - Selesai)
     └── Reservation #014 (Misal: Nuansa Budaya - 2026-08-17 - Dikonfirmasi)
```

### 8.2 Identifikasi & Pencegahan Duplikasi Data
- Sistem memanfaatkan **Nomor Telepon / WhatsApp** sebagai kandidat kunci identifikasi unik saat reservasi baru dikirimkan.
- Jika nomor WhatsApp yang sama melakukan reservasi kedua, sistem mengaitkan reservasi baru tersebut ke profil customer yang sudah ada, bukan membuat baris customer baru yang redundan.
- Sistem **tidak boleh** melakukan deduplikasi hanya berdasarkan kecocokan nama (karena potensi kesamaan nama orang berbeda).

---

# 9. Content Management System (CMS) & Dynamic Data

Semua informasi bisnis yang dapat berubah sewaktu-waktu harus tersimpan di database dan dapat dikelola melalui CMS tanpa campur tangan programmer.

### 9.1 Cakupan Pengelolaan Konten
1. **Beranda (*Homepage*)**: Hero headline, subheadline, banner gambar, call-to-action (CTA).
2. **Katalog Paket Wisata**: Tambah, ubah deskripsi, ubah harga, susun itinerary, unggah gambar, kelola status visibilitas.
3. **Profil Bisnis & Nilai Perusahaan (*About Us*)**: Sejarah singkat, visi-misi, nilai kearifan lokal.
4. **Legalitas Bisnis**: Nama badan hukum CV, nomor izin usaha (NIB), dokumen legalitas resmi (gambar / PDF preview).
5. **Pemandu Wisata (*Tour Guides*)**: Nama guide, foto profesional, pengalaman, keahlian, nomor sertifikasi resmi.
6. **Galeri Dokumentasi**: Unggah foto aktivitas wisatawan, filter kategori foto (Alam, Budaya, Kuliner, Aktivitas).
7. **Testimonial Pelanggan**: Nama wisatawan, foto, ulasan, paket yang diambil, rating kepuasan.
8. **Kontak & Lokasi**: Alamat kantor fisik di Pangandaran, koordinat GPS (latitude/longitude), tautan Google Maps, email resmi.
9. **Media Sosial**: Tautan resmi akun Instagram, TikTok, Facebook, YouTube.
10. **Pengaturan Global & SEO**: Meta title, meta description, favicon, logo website, nomor WhatsApp utama.

### 9.2 Aturan Integritas Data & Anti-Halusinasi
- **Aturan untuk AI Agent & Pengembang**: Dilarang keras mengarang data bisnis fiktif (nomor telepon, alamat, klaim legalitas palsu, atau sertifikasi palsu).
- Jika data aktual dari pemilik bisnis belum diserahkan, gunakan format placeholder yang jelas:
  ```text
  [BUSINESS WHATSAPP]
  [BUSINESS ADDRESS]
  [PACKAGE PRICE]
  NEEDS CONFIRMATION
  ```

---

# 10. Komponen Khusus & Integrasi

### 10.1 WhatsApp Context-Aware Integration
WhatsApp adalah saluran konversi tercepat di Indonesia. Integrasi WhatsApp harus mengikuti aturan berikut:
- **Floating Button**: Tombol mengambang di pojok kanan bawah pada seluruh halaman publik untuk respon cepat.
- **Context-Aware Message**: Pada halaman detail paket wisata, tombol WhatsApp membuka chat dengan pesan pembuka otomatis yang menyertakan nama paket terkait:
  ```text
  Halo Puja Tour Travel, saya sedang melihat paket [Nama Paket Wisata] di website dan ingin berkonsultasi mengenai ketersediaan jadwal serta penawarannya.
  ```
- **User Action Trigger**: Tautan WhatsApp **hanya boleh terbuka** akibat aksi klik sukarela oleh pengguna. Sistem tidak boleh membuka WhatsApp secara otomatis tanpa interaksi pengguna (*no auto-popup / unsolicited redirect*).

### 10.2 Keamanan Data & Privasi
- **Data Publik**: Nama paket, deskripsi, harga published, foto galeri, profil guide publik, ulasan testimonial publik, alamat kantor resmi.
- **Data Privat (Dilarang terekspos ke publik)**: Nomor HP/WhatsApp pelanggan, email pelanggan, catatan internal reservasi (*admin notes*), daftar histori reservasi individu, log audit sistem.
- Tidak boleh ada endpoint publik seperti `/reservation/123` yang dapat dibaca bebas tanpa mekanisme otentikasi admin atau secure token.

---

# 11. Business Rules Catalog (BR)

Daftar aturan bisnis resmi yang wajib dipatuhi dalam kode program:

### 11.1 Package Rules (`BR-PKG`)
- `BR-PKG-001`: Paket berstatus `Draft` tidak boleh tampil pada katalog website publik.
- `BR-PKG-002`: Hanya paket berstatus `Published` yang tampil pada katalog dan form reservasi publik.
- `BR-PKG-003`: Paket berstatus `Archived` dinonaktifkan dari katalog publik, namun datanya tidak boleh dihapus fisik (*hard delete*) jika memiliki riwayat reservasi.
- `BR-PKG-004`: Setiap paket wajib memiliki relasi kategori yang valid.
- `BR-PKG-005`: Harga paket wajib dikelola melalui database dan tidak boleh berupa nilai statis (*hardcoded*) pada template Blade/frontend.
- `BR-PKG-006`: Perubahan harga master paket tidak boleh mengubah harga historis pada reservasi yang telah tercatat sebelumnya.
- `BR-PKG-007`: Paket yang ditandai `featured = true` ditampilkan pada section unggulan beranda (dengan pembatasan jumlah wajar, misal 3–6 paket).

### 11.2 Reservation Rules (`BR-RES`)
- `BR-RES-001`: Setiap reservasi baru yang masuk melalui public website secara otomatis berstatus `Pending`.
- `BR-RES-002`: Setiap data reservasi wajib terhubung dengan satu entitas Customer yang valid.
- `BR-RES-003`: Setiap data reservasi wajib terhubung dengan satu entitas Paket Wisata yang valid.
- `BR-RES-004`: Tanggal rencana perjalanan (`travel_date`) wajib hari ini atau masa mendatang (`travel_date >= today`).
- `BR-RES-005`: Jumlah peserta (`participant_count`) wajib berupa bilangan bulat positif minimal 1.
- `BR-RES-006`: Setiap reservasi wajib memiliki atribut `source` akuisisi.
- `BR-RES-007`: Hanya administrator terotentikasi yang berhak mengubah status reservasi.
- `BR-RES-008`: Data reservasi yang telah selesai (*Completed*) atau dibatalkan (*Cancelled*) wajib dipertahankan sebagai data histori operasional.

### 11.3 Customer Rules (`BR-CUS`)
- `BR-CUS-001`: Customer adalah entitas independen yang dapat memiliki banyak transaksi reservasi (*one-to-many*).
- `BR-CUS-002`: Data profil pelanggan bersifat rahasia (*private*) dan hanya dapat diakses melalui admin dashboard berotentikasi.
- `BR-CUS-003`: Sistem melakukan pengecekan nomor WhatsApp saat reservasi masuk untuk mencegah duplikasi entitas customer.

### 11.4 Content Management Rules (`BR-CMS`)
- `BR-CMS-001`: Seluruh halaman administrasi CMS wajib dilindungi oleh otentikasi login admin.
- `BR-CMS-002`: Tampilan publik hanya menyajikan konten dinamis yang berstatus `Published`.
- `BR-CMS-003`: Dilarang melakukan *hardcoding* data bisnis operasional (nomor kontak, alamat, harga, nama paket) pada berkas template tampilan.

### 11.5 Source Tracking Rules (`BR-SRC`)
- `BR-SRC-001`: Reservasi dari website publik secara otomatis diberi label sumber `Website`.
- `BR-SRC-002`: Input reservasi manual oleh admin di dashboard wajib memilih salah satu nilai sumber yang telah ditentukan.

### 11.6 Privacy & Security Rules (`BR-PRV`)
- `BR-PRV-001`: Data PII (*Personally Identifiable Information*) pelanggan tidak boleh dibocorkan ke respon API publik.
- `BR-PRV-002`: Catatan khusus admin (*admin notes*) bersifat internal dan tidak boleh ditampilkan ke sisi customer.

---

# 12. Business Metrics & Dashboard KPI

Dashboard admin harus menyajikan ringkasan indikator performa operasional:

### 12.1 Metrik Operasional Utama
- **Total Packages**: Jumlah paket aktif yang dipublikasikan.
- **Pending Reservations**: Jumlah reservasi baru yang memerlukan respon tindak lanjut segera.
- **Confirmed Bookings**: Jumlah perjalanan yang telah terjadwal dan siap diberangkatkan.
- **Completed Trips**: Jumlah total perjalanan yang berhasil diselesaikan.
- **Total Customers**: Jumlah wisatawan unik yang tersimpan di basis data.
- **Repeat Customers**: Jumlah wisatawan yang pernah memesan lebih dari 1 kali.

### 12.2 Metrik Sumber Akuisisi (*Acquisition Breakdown*)
- Distribusi jumlah reservasi dan customer berdasarkan sumber (Instagram, Website, TikTok, WhatsApp, Referral, Offline).

---

# 13. Project Priorities & Scope Boundaries

### 13.1 Skala Prioritas Fitur
- **P0 (Kritis / Wajib untuk Rilis Awal)**:
  - Website Publik Responsif (Beranda, Profil Singkat, Kontak).
  - Katalog Paket Wisata & Halaman Detail Paket (Harga, Fasilitas, Itinerary).
  - Integrasi Tombol WhatsApp & Form Permintaan Reservasi.
  - Otentikasi Admin & Dashboard Ringkasan.
  - CMS Manajemen Paket Wisata & Harga.
  - Manajemen Data Reservasi & Pengubahan Status.
  - Manajemen Data Pelanggan & Histori Reservasi.
- **P1 (Penting / Penguat Kredibilitas)**:
  - Manajemen Galeri Foto Dokumentasi Wisata.
  - Manajemen Testimonial & Review Pelanggan.
  - Publikasi Dokumen Legalitas CV & Pemandu Wisata.
  - Pelacakan Sumber Akuisisi Pelanggan (*Source Tracking*).
  - Peta Lokasi Kantor Google Maps Terintegrasi.
  - Pengaturan Meta Tag SEO Dasar.
- **P2 (Penyempurnaan / Tahap Lanjutan)**:
  - Ekspor Laporan Bulanan (Excel/PDF).
  - Notifikasi Email Otomatis untuk Admin/Customer.
  - Filter analitik lanjutan dan pencarian mendalam.

### 13.2 Batasan di Luar Cakupan (*Out of Scope*)
Fitur-fitur berikut **tidak termasuk** dalam lingkup awal proyek:
- Integrasi Payment Gateway otomatis (kartu kredit, virtual account instan, e-wallet) — pembayaran diproses manual via transfer bank/konfirmasi admin.
- Aplikasi Mobile Android / iOS (cukup website mobile-responsive).
- Mesin pemesanan tiket pesawat atau kamar hotel eksternal (*third-party booking engine*).
- Sistem multi-vendor / marketplace tour guide pihak ketiga.
- Chatbot AI atau automated WhatsApp bot auto-reply.
- Sistem penggajian (*payroll*) atau akuntansi pembukuan kompleks.

---

# 14. Acceptance Criteria

Proyek dinyatakan memenuhi kriteria kebutuhan bisnis jika seluruh poin berikut terpenuhi:

### 14.1 Website Publik
- [ ] Pengunjung dapat membaca informasi resmi bisnis, profil, dan legalitas Puja Tour Travel.
- [ ] Pengunjung dapat menelusuri katalog paket wisata dengan kategori yang jelas.
- [ ] Pengunjung dapat membuka halaman detail paket wisata untuk melihat harga, fasilitas, pengecualian, dan itinerary.
- [ ] Pengunjung dapat melihat dokumentasi galeri perjalanan dan testimonial pelanggan.
- [ ] Pengunjung dapat mengklik CTA WhatsApp yang membawa konteks nama paket yang sedang dilihat.
- [ ] Pengunjung dapat mengirimkan form permintaan reservasi perjalanan dengan validasi data input.
- [ ] Tampilan website beroperasi optimal dan nyaman diakses pada perangkat smartphone (*mobile-first*).

### 14.2 Reservasi & Pelanggan
- [ ] Reservasi yang dikirimkan melalui form publik tersimpan ke database dengan status awal `Pending`.
- [ ] Reservasi baru secara otomatis terhubung dengan data profil pelanggan (membuat baru atau menggunakan data existing berdasar nomor WhatsApp).
- [ ] Admin dapat melihat daftar reservasi, melakukan pencarian, memfilter berdasarkan status/sumber, dan memperbarui status reservasi.
- [ ] Admin dapat melihat riwayat perjalanan seorang pelanggan (*customer reservation history*).
- [ ] Perubahan harga master paket tidak mengubah nilai harga pemesanan pada reservasi masa lalu.

### 14.3 Admin CMS
- [ ] Admin dapat melakukan login secara aman ke dashboard.
- [ ] Admin dapat menambah, mengubah, mengarsipkan, dan mempublikasikan paket wisata beserta itinerary dan harganya.
- [ ] Admin dapat mengunggah dan mengelola foto galeri serta ulasan testimonial.
- [ ] Admin dapat memperbarui informasi kontak bisnis, tautan media sosial, dan data legalitas tanpa menyentuh kode program.
- [ ] Data privat pelanggan terlindungi dan tidak dapat diakses oleh publik tanpa otentikasi.

---

# 15. Dokumen Terkait

Dokumen kebutuhan bisnis ini menjadi acuan bagi dokumen perencanaan teknis lainnya:
- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Gambaran umum dan identitas proyek
- `03-sitemap-and-pages.md` — Struktur halaman website publik dan menu CMS
- `04-ui-ux-guidelines.md` — Panduan desain visual, tipografi, dan warna
- `05-public-website.md` — Spesifikasi teknis halaman publik
- `06-admin-cms.md` — Spesifikasi teknis dashboard administrator
- `07-reservation-system.md` — Alur kerja dan logika sistem reservasi
- `08-customer-management.md` — Desain modul pengelolaan pelanggan
- `09-database.md` — Skema basis data, relasi tabel, dan migrasi
- `10-security.md` — Kebijakan otentikasi dan perlindungan data privat
- `11-seo-and-analytics.md` — Optimasi search engine dan tracking performa
- `15-project-scope.md` — Batasan ruang lingkup dan timeline pengembangan
