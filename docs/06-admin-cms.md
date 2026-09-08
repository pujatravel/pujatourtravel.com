# 06 — Admin Dashboard & CMS Specifications
# Puja Tour Travel Website

> Dokumen ini mendefinisikan arsitektur, modul antarmuka, alur kerja operasional, dan aturan teknis untuk Dashboard Administrator serta Content Management System (CMS) Puja Tour Travel.
> Panel ini dirancang untuk pengguna non-teknis agar seluruh data operasional, katalog paket wisata, reservasi, data pelanggan, dan konten publik dapat dikelola mandiri tanpa perlu mengubah kode sumber aplikasi.

---

# 1. Sasaran & Filosofi Admin CMS

### 1.1 Sasaran Utama
Admin CMS berfungsi sebagai pusat komando operasional Puja Tour Travel untuk:
- Mengelola data master paket wisata, harga dinamis, fasilitas, dan jadwal perjalanan (*itinerary*).
- Memantau dan memperbarui status permintaan reservasi yang masuk dari calon wisatawan.
- Mencatat basis data pelanggan dan memantau riwayat perjalanan berulang (*repeat orders*).
- Menganalisis efektivitas saluran perolehan pelanggan (*lead source tracking*).
- Memperbarui seluruh teks beranda, informasi legalitas CV, profil pemandu, galeri, kontak, dan SEO.
- Mengunggah dan mengorganisasi berkas aset digital pada perpustakaan media (*Media Library*).

### 1.2 Filosofi Desain (*Task-First Admin*)
```text
PUBLIC WEBSITE : Marketing First (Visual emosional, inspiratif, & persuasif)
ADMIN CMS      : Task First (Kecepatan kerja, kejelasan data, akurasi, & keamanan transaksi)
```
Antarmuka admin mengutamakan kesederhanaan, navigasi terstruktur, formulir yang mudah diisi, dan tabel data yang cepat dicari/difilter.

---

# 2. Otentikasi & Keamanan Sesi Admin

Seluruh rute pada prefix `/admin/*` wajib dilindungi oleh otentikasi login server-side, kecuali rute `/admin/login`.

### 2.1 Alur Masuk & Proteksi Rute
```text
Pengguna Non-Login Mengakses /admin/*
              │
              ▼
Redirect Otomatis ke /admin/login (Flash message: "Silakan login terlebih dahulu")
              │
              ▼
Input Kredensial Valid (Email/Username + Password)
              │
              ▼
Otentikasi Sukses ──► Regenerasi Session ID ──► Redirect ke /admin/dashboard
```

### 2.2 Spesifikasi Halaman Login (`/admin/login`)
- **Field Input**:
  - `email` / `username`: Wajib diisi.
  - `password`: Wajib diisi (tipe password dengan toggle intip kata sandi).
  - `remember`: Checkbox opsional "Ingat Saya" untuk memperpanjang masa aktif token sesi.
- **Kebijakan Keamanan**:
  - *Password Hashing*: Wajib menggunakan algoritma Bcrypt (PHP 8.4+/Laravel).
  - *Rate Limiting*: Pembatasan maksimal 5 kali percobaan gagal berturut-turut per menit untuk mencegah serangan *brute-force*.
  - *Pesan Galat Ramah & Aman*: Jika login gagal, tampilkan pesan generik *"Email atau password yang Anda masukkan salah"* tanpa membocorkan keberadaan username/email di database.
  - *CSRF Protection*: Seluruh form admin wajib menyertakan token `@csrf`.

### 2.3 Mekanisme Logout (`/admin/logout`)
- Mengakhiri sesi pengguna, menghapus cookie sesi, dan mengarahkan staf kembali ke halaman `/admin/login`.

---

# 3. Tata Letak Dasbor & Sistem Navigasi

Tata letak admin menggunakan struktur standar industri yang ergonomis:
```text
┌─────────────────────────────────────────────────────────────────────────┐
│ Topbar (Logo Admin, Toggle Sidebar, Tautan "Lihat Website", Profil Staf)│
├───────────────────────┬─────────────────────────────────────────────────┤
│ Sidebar Navigasi      │ Area Konten Utama                               │
│                       │                                                 │
│ • Dashboard           │ Breadcrumb Navigasi                             │
│ • Operasional         │ Header Halaman & Tombol Aksi Cepat              │
│ • Konten CMS          │ Flash Message (Sukses / Galat)                  │
│ • Pengaturan Website  │ Panel Tabel Data / Formulir Editor              │
│ • Media Library       │ Pagination                                      │
└───────────────────────┴─────────────────────────────────────────────────┘
```

### 3.1 Struktur Menu Sidebar
1. **Dasbor**: `/admin/dashboard`
2. **Operasional Perjalanan**:
   - *Reservasi Wisata*: `/admin/reservations`
   - *Data Pelanggan*: `/admin/customers`
   - *Saluran Sumber Lead*: `/admin/customer-sources`
3. **Katalog & Produk**:
   - *Paket Wisata*: `/admin/packages`
   - *Kategori Paket*: `/admin/packages/categories`
4. **Manajemen Konten Publik (CMS)**:
   - *Halaman Beranda*: `/admin/homepage`
   - *Profil & Nilai Bisnis*: `/admin/about`
   - *Legalitas CV*: `/admin/legal`
   - *Pemandu Wisata*: `/admin/tour-guides`
   - *Galeri Foto*: `/admin/galleries`
   - *Ulasan Testimonial*: `/admin/testimonials`
5. **Pengaturan & Sistem**:
   - *Kontak & Titik Peta*: `/admin/contact`
   - *Media Sosial*: `/admin/social-media`
   - *Pengaturan SEO*: `/admin/seo`
   - *Perpustakaan Media*: `/admin/media`
   - *Pengaturan Situs*: `/admin/settings`

### 3.2 Karakteristik Navigasi Sidebar
- Memiliki status aktif yang jelas (*highlighted background*) pada menu yang sedang dibuka.
- Dapat diciutkan (*collapsible*) pada layar desktop untuk memperluas ruang pandang tabel data.
- Berubah menjadi panel geser (*drawer overlay*) yang mudah ditutup pada layar tablet dan smartphone.

---

# 4. Ringkasan Dasbor Operasional (`/admin/dashboard`)

Halaman utama setelah staf berhasil login yang memberikan gambaran cepat kondisi bisnis terkini.

### 4.1 Kartu Metrik Kunci (*KPI Cards*)
| Indikator | Definisi & Sumber Data | Tujuan Operasional |
|---|---|---|
| **Reservasi Menunggu** | Jumlah reservasi dengan status `Pending` | Memerlukan tindak lanjut segera oleh tim admin |
| **Pemesanan Terkonfirmasi** | Jumlah reservasi dengan status `Dikonfirmasi` | Jadwal perjalanan aktif yang siap diberangkatkan |
| **Trip Selesai** | Total reservasi dengan status `Selesai` | Rekam jejak keberhasilan tur yang telah tuntas |
| **Total Paket Aktif** | Jumlah paket wisata berstatus `Published` | Pemantauan produk wisata yang tersedia di web |
| **Total Wisatawan** | Jumlah data unik pada tabel `customers` | Pertumbuhan basis data pelanggan Puja Tour Travel |
| **Pelanggan Berulang** | Jumlah customer dengan reservasi > 1 kali | Indikator kepuasan dan loyalitas wisatawan |

### 4.2 Widget Dasbor Utama
1. **Tabel Reservasi Terbaru**: Menampilkan 5–10 reservasi terakhir yang masuk lengkap dengan nama pemesan, paket, tanggal trip, badge status, dan tautan langsung ke rincian reservasi.
2. **Peringatan Butuh Tindakan Segera (*Actionable Alerts*)**:
   - Kotak peringatan mencolok bila ada reservasi berstatus `Pending` lebih dari 24 jam belum diproses.
   - Peringatan bila ada paket wisata yang masih berstatus `Draft` atau gambar galeri yang belum dipublikasikan.
3. **Tombol Pintas Aksi Cepat (*Quick Actions*)**:
   - Tombol "+ Tambah Paket Baru", "Periksa Reservasi Baru", "+ Unggah Foto Galeri", dan "Edit Teks Beranda".

---

# 5. Manajemen Paket Wisata (`/admin/packages`)

Modul inti untuk mengelola produk perjalanan yang dipasarkan kepada wisatawan.

### 5.1 Tabel Master Paket
- **Kolom Tabel**: Pratinjau Foto Sampul, Judul Paket, Kategori, Harga Dasar, Status Publikasi (`Draft`, `Published`, `Archived`), Penanda Unggulan (`Featured`), Tanggal Pembaruan, Tombol Aksi.
- **Pencarian & Filter**: Pencarian instan berbasis nama/slug paket, filter dropdown kategori, dan filter status publikasi.

### 5.2 Formulir Editor Paket Wisata
Formulir dikelompokkan secara terstruktur:
1. **Informasi Dasar**:
   - `name`: Nama paket wisata (*wajib*).
   - `slug`: URL slug ramah SEO (*wajib*, terisi otomatis dari nama, format lowercase & hyphen, unik).
   - `category_id`: Pilihan kategori wisata (*wajib*).
   - `duration`: Teks durasi tur (contoh: "1 Hari", "2H1M", "3H2M").
   - `location`: Lokasi utama (contoh: "Green Canyon & Batu Karas, Pangandaran").
   - `short_description`: Ringkasan 2–3 kalimat untuk kartu pratinjau.
   - `description`: Deskripsi lengkap narasi pengalaman tur (dukungan rich text editor sederhana).
2. **Harga & Skema Pemesanan**:
   - `price`: Nilai nominal angka murni tanpa simbol (misal: `750000`).
   - `price_unit`: Satuan pemesanan (misal: "pax", "orang", "rombongan").
3. **Fasilitas Termasuk & Tidak Termasuk**:
   - *Inclusions (Termasuk)*: Daftar berulang (*repeater field*) item fasilitas yang didapat.
   - *Exclusions (Tidak Termasuk)*: Daftar berulang hal-hal yang menjadi pengeluaran pribadi wisatawan.
4. **Susunan Jadwal Perjalanan (*Itinerary Repeater*)**:
   - Tabel berulang yang memuat slot jadwal: Jam pelaksanaan (contoh: `08:00`), Nama aktivitas, Lokasi, dan Deskripsi singkat. Item dapat diatur ulang urutannya (*reorderable*).
5. **Aset Visual & Media**:
   - Pilihan foto sampul utama (*thumbnail*) dan foto-foto galeri pendukung tur dari Media Library.
6. **Optimasi SEO Paket**:
   - `seo_title` & `seo_description`: Teks kustom untuk mesin pencari (jika dikosongkan, otomatis mengambil nama dan deskripsi singkat paket).
7. **Pengaturan Publikasi**:
   - Pilihan status: `Draft` (hanya terlihat di admin), `Published` (tayang di website publik), `Archived` (dinonaktifkan).
   - Checkbox `featured`: Menandai paket agar tampil pada section unggulan di Beranda.

### 5.3 Kebijakan Integritas & Penghapusan Paket
- **Duplikasi Paket**: Admin dapat menduplikasi paket yang sudah ada untuk mempercepat pembuatan tur baru. Duplikasi otomatis menghasilkan slug baru dan berstatus awal `Draft`.
- **Aturan Proteksi Histori**: Dilarang menghapus paket secara fisik (*hard delete*) jika paket tersebut pernah dipesan dalam data riwayat reservasi. Sistem wajib mengalihkannya ke opsi **Arsipkan (*Archive*)** agar data transaksi lama tetap utuh.

---

# 6. Manajemen Reservasi Perjalanan (`/admin/reservations`)

Modul operasional harian untuk menindaklanjuti permintaan perjalanan dari wisatawan.

### 6.1 Tabel Manajemen Reservasi
- **Kolom Tabel**: ID Pemesanan (contoh: `#RES-2026-0042`), Nama Pelanggan, Kontak WhatsApp, Paket Wisata, Tanggal Perjalanan, Jumlah Peserta, Saluran Asal (*Source*), Status, Tanggal Masuk, Aksi.
- **Pencarian & Filter Multi-Kriteria**:
  - Pencarian berbasis Nama Pemesan, No WhatsApp, atau ID Reservasi.
  - Filter Status: `Semua`, `Pending`, `Diproses`, `Dikonfirmasi`, `Selesai`, `Dibatalkan`.
  - Filter Paket Wisata & Saluran Sumber.
  - Filter rentang tanggal rencana perjalanan (*Travel Date*).

### 6.2 Halaman Rincian Reservasi (`/admin/reservations/{id}`)
- **Bagian Rincian Pemesanan**: Menampilkan paket wisata, tanggal trip, jumlah peserta, tanggal form dikirimkan, dan rincian biaya pemesanan yang disepakati (`booking_price`).
- **Bagian Informasi Wisatawan**: Nama lengkap, tautan tombol langsung "Chat WhatsApp" (membuka chat dengan template sapaan resmi), dan alamat email.
- **Permintaan Khusus Pelanggan**: Catatan kustomisasi itinerary atau preferensi makanan yang diinput wisatawan saat mengisi form.
- **Catatan Internal Staf (*Admin Notes*)**: Kolom catatan privat antar-staf internal (contoh: *"Customer DP 50% via transfer BCA pada 10 Sep"*). Catatan ini tidak pernah terekspos ke sisi publik.
- **Kontrol Pengubahan Status (*Status Transition*)**:
  - Tombol aksi pembaruan status ke tahapan berikutnya:
    ```text
    [Pending] ──► [Diproses] ──► [Dikonfirmasi] ──► [Selesai]
         │              │               │
         └──────────────┴───────────────┴──► [Dibatalkan] (Wajib isi alasan)
    ```

---

# 7. Manajemen Basis Data Pelanggan (`/admin/customers`)

Modul CRM sederhana untuk mencatat dan menjaga hubungan jangka panjang dengan wisatawan.

### 7.1 Tabel Master Pelanggan
- **Kolom Tabel**: Nama Wisatawan, Nomor WhatsApp, Email, Saluran Asal Pertama (*Acquisition Source*), Total Trip yang Pernah Dipesan, Tanggal Terdaftar, Tombol Profil.
- **Pencarian**: Berdasarkan nama, nomor telepon, atau email.

### 7.2 Profil Wisatawan & Histori Pemesanan (`/admin/customers/{id}`)
- Menampilkan data lengkap kontak dan preferensi wisatawan.
- **Riwayat Reservasi (*Reservation History Table*)**: Menampilkan daftar seluruh reservasi yang pernah dibuat oleh pelanggan tersebut beserta status dan tanggal perjalanannya.
- **Privasi Mutlak**: Data kontak pelanggan hanya dapat dibaca oleh staf berwenang dan dilarang terekspos ke endpoint API publik mana pun.

---

# 8. Modul Pengelolaan Konten Publik (CMS)

Staf dapat memperbarui teks dan elemen visual website publik secara instan:

### 8.1 CMS Beranda (`/admin/homepage`)
- Mengatur teks judul Hero (*Headline*), sub-judul, foto latar belakang Hero, dan tautan tombol CTA.
- Mengelola teks kartu pada *Trust Elements Bar* dan deskripsi section promosi.

### 8.2 CMS Profil Bisnis & Legalitas (`/admin/about` & `/admin/legal`)
- Mengubah teks sejarah pendirian, visi, misi, dan pilar keunggulan lokal.
- Mengunggah dokumen legalitas badan hukum CV (Nomor NIB, nama perseroan komanditer, serta file surat izin usaha).

### 8.3 CMS Pemandu Wisata (`/admin/tour-guides`)
- CRUD profil pemandu: Nama lengkap, foto seragam resmi, pengalaman memandu, bahasa yang dikuasai, dan nomor sertifikasi resmi dari asosiasi pemandu wisata.

### 8.4 CMS Galeri Dokumentasi (`/admin/galleries`)
- Mengunggah foto dokumentasi perjalanan tunggal atau multi-upload sekaligus.
- Memberikan judul foto, memilih kategori dokumentasi (Alam, Rafting, Budaya, Kuliner), teks alternatif (*alt text* untuk SEO), dan status publikasi (`Draft` / `Published`).

### 8.5 CMS Ulasan Testimonial (`/admin/testimonials`)
- Mengelola ulasan wisatawan: Nama pelanggan, asal kota, foto profil, nama paket wisata yang diikuti, rating bintang (1–5), teks ulasan, dan penanda featured.
- Seluruh testimoni wajib diverifikasi dari wisatawan riil sebelum dipublikasikan.

### 8.6 CMS Kontak, Lokasi, & Media Sosial (`/admin/contact` & `/admin/social-media`)
- Memperbarui nomor WhatsApp resmi CS, alamat email operasional, jam kantor, dan alamat kantor fisik.
- Memperbarui koordinat titik GPS (Latitude & Longitude) agar peta Google Maps pada website publik selalu akurat.
- Memperbarui tautan URL resmi Instagram, TikTok, Facebook, dan YouTube.

---

# 9. Perpustakaan Media Terpusat (`/admin/media`)

Pengelolaan berkas gambar dan dokumen digital agar rapi, aman, dan tidak berantakan:
- **Format yang Didukung**:
  - Foto: `JPG`, `JPEG`, `PNG`, `WEBP`, `AVIF` (maksimal 3 MB per berkas).
  - Dokumen Legalitas: `PDF` (maksimal 5 MB).
- **Kebijakan Keamanan Unggahan**:
  - Validasi ketat *MIME type* asli berkas di sisi server (dilarang hanya memeriksa ekstensi nama berkas).
  - Penamaan file otomatis disanitasi menggunakan pola unik (misal: UUID atau slug aman) untuk mencegah tabrakan nama berkas (*file collision*).
  - Penyimpanan file terisolasi pada direktori penyimpanan publik Laravel (`storage/app/public/...`).
- **Pencegahan Galat Hapus (*Accidental Deletion*)**: Sistem memeriksa apakah gambar sedang digunakan oleh paket aktif atau galeri sebelum mengizinkan staf menghapus file secara permanen.

---

# 10. Standar Antarmuka, Formulir, & Integritas Transaksi

1. **Peringatan Perubahan Belum Disimpan (*Unsaved Changes Prompt*)**:
   - Jika staf telah mengetik atau mengubah formulir lalu mencoba menutup atau berpindah halaman tanpa menekan tombol simpan, browser otomatis menampilkan dialog konfirmasi pengaman.
2. **Dialog Konfirmasi untuk Tindakan Destruktif**:
   - Aksi pengarsipan paket, pembatalan reservasi, atau penghapusan media wajib melewati jendela dialog konfirmasi (*Confirmation Modal*) dengan penjelasan konsekuensi yang jelas.
3. **Integritas Transaksi Basis Data (*Database Transactions*)**:
   - Operasi yang melibatkan penyimpanan bertingkat (seperti menyimpan paket beserta baris itinerary dan daftar fasilitas) wajib dibungkus dalam `DB::transaction` untuk mencegah data tersimpan sebagian (*inconsistent data state*) bila terjadi kendala jaringan.
4. **Umpan Balik Status Aksi (*Feedback States*)**:
   - Setiap operasi yang berhasil langsung memunculkan notifikasi melayang (*Toast Notification*) hijau di pojok kanan atas (contoh: *"Paket wisata berhasil dipublikasikan"*).
   - Selama proses penyimpanan berlangsung, tombol form otomatis terkunci (*disabled*) dengan teks *"Menyimpan data..."* untuk mencegah pengiriman ganda.

---

# 11. Daftar Periksa Kesiapan Admin CMS (*Definition of Done*)

- [ ] **Sistem Otentikasi**: Rute `/admin/*` berhasil memblokir akses tanpa login dan mengarahkan ke formulir masuk.
- [ ] **Perlindungan Brute-Force**: Mekanisme pembatasan percobaan login (rate limiter) beroperasi normal.
- [ ] **Dasbor Operasional**: Seluruh kartu metrik KPI dan tabel reservasi terbaru menampilkan data aktual dari database.
- [ ] **Manajemen Paket**: Formulir paket mampu menyimpan dan memperbarui data dasar, harga angka, daftar fasilitas repeater, dan jadwal itinerary.
- [ ] **Pencegahan Hapus Paket**: Paket yang memiliki riwayat reservasi tidak dapat dihapus keras, melainkan dialihkan ke opsi arsip.
- [ ] **Manajemen Reservasi**: Staf dapat memfilter daftar reservasi berdasarkan status/tanggal, serta dapat memperbarui status pemesanan.
- [ ] **Basis Data Pelanggan**: Data customer terhubung rapi dengan histori perjalanannya dan nomor kontak terlindungi dari publik.
- [ ] **Perpustakaan Media**: Unggah gambar memvalidasi tipe berkas dan batas ukuran secara ketat di sisi server.
- [ ] **CMS Dinamis**: Seluruh perubahan teks beranda, legalitas CV, kontak kantor, dan media sosial langsung terbarui pada website publik tanpa perlu restart aplikasi.
- [ ] **Responsif Admin**: Antarmuka dasbor dan tabel data dapat dioperasikan secara nyaman melalui perangkat tablet dan smartphone.

---

# 12. Aturan Implementasi Pengembang & AI Agent

1. **Otorisasi Server-Side**: Dilarang hanya menyembunyikan tombol di frontend. Seluruh aksi create, update, delete, dan publish wajib divalidasi otorisasi dan hak aksesnya di controller backend Laravel.
2. **Validasi Request Ketat**: Gunakan Laravel Form Request khusus (misal: `PackageStoreRequest`, `ReservationUpdateRequest`) untuk memastikan integritas tipe data sebelum masuk ke database.
3. **Dilarang Menampilkan Data Dummy**: Seluruh halaman admin wajib menampilkan data riil dari database; jika data masih kosong, tampilkan komponen *Empty State* yang rapi.
4. **Proteksi Data Pribadi Wisatawan**: Jangan mengekspos data pelanggan pada rute publik atau respon JSON tanpa enkripsi/otentikasi sesi staf.

---

# 13. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Identitas bisnis dan visi sistem digital
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) — Aturan bisnis, alur reservasi, dan katalog aturan (*BR*)
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) — Struktur rute admin `/admin/*` dan website publik
- [04-ui-ux-guidelines.md](file:///c:/laragon/www/pujatourtravel.com/docs/04-ui-ux-guidelines.md) — Prinsip desain antarmuka, komponen, dan tipografi
- [05-public-website.md](file:///c:/laragon/www/pujatourtravel.com/docs/05-public-website.md) — Integrasi data CMS ke tampilan website publik
- `07-reservation-system.md` — Spesifikasi mendalam alur pemrosesan pemesanan
- `08-customer-management.md` — Desain modul pengelolaan hubungan pelanggan (CRM)
- `09-database.md` — Skema tabel basis data, migrasi, dan relasi Eloquent
- `10-security.md` — Kebijakan otentikasi, proteksi sesi, dan keamanan data
