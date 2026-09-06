# 03 — Sitemap & Page Specifications
# Puja Tour Travel Website

> Dokumen ini mendefinisikan arsitektur sitemap, routing URL, hierarki navigasi, spesifikasi section halaman, penempatan Call-to-Action (CTA), dan pemetaan data untuk website publik serta dashboard CMS Puja Tour Travel.
> Dokumen ini menjadi acuan utama pengembangan routing, struktur antarmuka, dan integrasi data antarkomponen.

---

# 1. Arsitektur Sistem & Struktur Area Web

Website Puja Tour Travel terbagi menjadi dua area utama yang terisolasi secara hak akses:

```text
WEBSITE PUJA TOUR TRAVEL
│
├── PUBLIC WEBSITE (Akses Terbuka / Tanpa Login)
│   ├── / (Beranda)
│   ├── /tentang-kami
│   ├── /paket-wisata
│   │   └── /paket-wisata/{slug}
│   ├── /galeri
│   ├── /testimonial
│   ├── /reservasi
│   └── /kontak
│
└── ADMIN DASHBOARD (Akses Terproteksi / Wajib Login)
    └── /admin
        ├── /login
        ├── /dashboard
        ├── /homepage (CMS Beranda)
        ├── /about (CMS Profil)
        ├── /legal (CMS Legalitas)
        ├── /tour-guides (CMS Pemandu Wisata)
        ├── /packages (Katalog & Editor Paket)
        ├── /galleries (CMS Galeri)
        ├── /testimonials (CMS Testimonial)
        ├── /reservations (Manajemen Reservasi)
        ├── /customers (Manajemen Pelanggan)
        ├── /customer-sources (Saluran Sumber)
        ├── /contact (CMS Kontak & Lokasi)
        ├── /social-media (CMS Akun Medsos)
        ├── /seo (Pengaturan Meta Tag)
        ├── /media (Pengelola Berkas Unggahan)
        └── /settings (Pengaturan Website)
```

---

# 2. Sitemap & Matriks Rute Publik

| Halaman | Rute URL | Tujuan Utama | Titik Konversi (*CTA*) |
|---|---|---|---|
| **Beranda** | `/` | Pengenalan brand, membangun kepercayaan, showcase paket unggulan | *Lihat Paket Wisata*, *Konsultasi via WhatsApp* |
| **Tentang Kami** | `/tentang-kami` | Profil bisnis, sejarah, visi-misi, nilai kearifan lokal, pemandu wisata | *Lihat Paket Wisata*, *Hubungi Kami* |
| **Katalog Paket** | `/paket-wisata` | Menampilkan seluruh paket aktif dengan filter kategori | *Lihat Detail Paket* |
| **Detail Paket** | `/paket-wisata/{slug}` | Informasi mendalam paket: harga, fasilitas, pengecualian, dan itinerary | *Reservasi Sekarang*, *Tanya via WhatsApp* |
| **Galeri** | `/galeri` | Dokumentasi visual destinasi dan aktivitas wisatawan riil | *Lihat Paket Terkait*, *Konsultasi WhatsApp* |
| **Testimonial** | `/testimonial` | Bukti sosial (*social proof*) ulasan wisatawan terdahulu | *Reservasi Sekarang* |
| **Reservasi** | `/reservasi` | Formulir pemesanan tanggal perjalanan dan jumlah peserta | *Kirim Permintaan Reservasi* |
| **Kontak & Lokasi** | `/kontak` | Alamat fisik kantor di Pangandaran, nomor kontak, dan peta Google Maps | *Chat via WhatsApp*, *Buka Google Maps* |

---

# 3. Spesifikasi Blueprint Halaman Publik

---

### 3.1 Beranda (*Homepage* — `/`)
- **Tujuan**: Membangun kesan pertama profesional, memvalidasi reputasi lokal, dan mengarahkan pengunjung ke katalog paket atau WhatsApp.
- **Hierarki Section**:
  1. **Header & Navbar**: Logo, navigasi utama, dan tombol aksi cepat WhatsApp.
  2. **Hero Section**:
     - *Headline*: Pesan selamat datang yang mengedepankan pengalaman lokal Pangandaran.
     - *Subheadline*: Penjelasan ringkas nilai layanan Puja Tour Travel.
     - *Primary CTA*: "Lihat Paket Wisata" (`/paket-wisata`).
     - *Secondary CTA*: "Konsultasi via WhatsApp" (Tautan langsung chat).
     - *Visual*: Foto lanskap berkualitas tinggi destinasi Pangandaran (misal: Green Canyon / Pantai Batu Karas).
  3. **Trust Elements Bar**: CV resmi, asuransi, pemandu tersertifikasi, peralatan standar keselamatan.
  4. **Featured Packages**: Grid 3–4 paket unggulan dengan kartu ringkas (gambar, kategori, durasi, harga dasar, tombol "Lihat Detail").
  5. **About Preview**: Cerita singkat komitmen Puja Tour Travel + tombol "Kenal Lebih Dekat" (`/tentang-kami`).
  6. **Gallery Preview**: 6 foto dokumentasi perjalanan terbaik + tombol "Lihat Semua Galeri" (`/galeri`).
  7. **Testimonial Snippet**: 3 ulasan wisatawan pilihan dengan nama, rating, dan foto.
  8. **Conversion Banner (CTA)**: Ajakan merencanakan liburan impian ke Pangandaran.
  9. **Location & Contact Snapshot**: Alamat kantor fisik dan jam operasional.
  10. **Footer**: Navigasi lengkap, tautan media sosial resmi, informasi hak cipta.

---

### 3.2 Tentang Kami (*About Us* — `/tentang-kami`)
- **Tujuan**: Menjelaskan identitas, latar belakang, komitmen keselamatan, dan keterikatan bisnis dengan masyarakat Pangandaran.
- **Hierarki Section**:
  1. **Page Header**: Judul halaman dan breadcrumb navigasi.
  2. **Profil Perusahaan**: Visi, misi, dan filosofi pelayanan.
  3. **Nilai Keunggulan Bisnis**: *Local Experience*, *Safety First*, *Professional Service*, dan *Local Wisdom*.
  4. **Legalitas CV**: Nomor Induk Berusaha (NIB) dan transparansi entitas hukum resmi.
  5. **Tim Pemandu Wisata (*Tour Guides*)**: Foto profil pemandu lokal, pengalaman, sertifikasi keselamatan, dan spesialisasi destinasi.
  6. **Komitmen Konservasi**: Keterlibatan dalam pelestarian penyu dan hutan mangrove.
  7. **CTA Banner**: "Jelajahi Paket Wisata Kami" (`/paket-wisata`).

---

### 3.3 Katalog Paket Wisata (*Package Listing* — `/paket-wisata`)
- **Tujuan**: Mempermudah wisatawan menelusuri pilihan tur sesuai minat dan durasi yang diinginkan.
- **Hierarki Section**:
  1. **Page Header**: Pengantar katalog wisata Pangandaran.
  2. **Filter Kategori Dinamis**: Tab filter berbasis database (`Semua`, `Eksklusif`, `Semi Edukasi`, `Nuansa Budaya`).
  3. **Package Grid**:
     - Gambar sampul (*thumbnail*).
     - Badge kategori dan badge durasi.
     - Judul paket wisata.
     - Deskripsi singkat (*short description*).
     - Harga resmi per satuan (misal: `Rp 750.000 / pax`).
     - Tombol aksi utama: "Lihat Detail" (`/paket-wisata/{slug}`).
  4. **Pagination / Infinite Scroll**: Navigasi halaman jika jumlah paket bertambah.
  5. **Empty State**: Pesan informatif ramah jika kategori yang dipilih belum memiliki paket aktif.

---

### 3.4 Detail Paket Wisata (*Package Detail* — `/paket-wisata/{slug}`)
- **Tujuan**: Halaman konversi utama yang memberikan seluruh detail teknis perjalanan untuk menghilangkan keraguan calon pelanggan.
- **Hierarki Section**:
  1. **Breadcrumb**: `Beranda > Paket Wisata > [Nama Paket]`.
  2. **Hero Detail**: Judul paket, kategori, durasi, lokasi utama, dan galeri foto pratinjau.
  3. **Sticky Booking Card / Sidebar (Desktop)**:
     - Harga paket resmi dan satuan pemesanan.
     - Tombol Utama: "Reservasi Sekarang" (`/reservasi?package={slug}`).
     - Tombol Sekunder: "Tanya via WhatsApp" (Pesan otomatis membawa konteks paket).
  4. **Gambaran Umum (*Overview*)**: Deskripsi komprehensif pengalaman tur.
  5. **Fasilitas Termasuk & Tidak Termasuk**:
     - *Inclusions (✓)*: Pemandu, perahu/transport, tiket wisata, asuransi, makan, perlengkapan rafting.
     - *Exclusions (✕)*: Pengeluaran pribadi, akomodasi luar paket, tips opsional.
  6. **Rincian Itinerary**: Jadwal terstruktur per jam (waktu, nama aktivitas, lokasi, penjelasan singkat).
  7. **Galeri Dokumentasi Khusus Paket**: Foto-foto aktivitas riil paket tersebut.
  8. **Paket Terkait (*Related Packages*)**: Rekomendasi 2–3 paket alternatif dalam kategori serupa.

---

### 3.5 Galeri Dokumentasi (*Gallery* — `/galeri`)
- **Tujuan**: Menghadirkan visualisasi autentik suasana alam dan keseruan aktivitas wisatawan.
- **Hierarki Section**:
  1. **Page Header & Deskripsi Galeri**.
  2. **Filter Kategori Foto**: `Semua`, `Destinasi Alam`, `Aktivitas Body Rafting`, `Budaya & Kuliner`, `Konservasi`.
  3. **Grid Media Responsif**: Tampilan grid foto berkualitas tinggi dengan optimasi kompresi.
  4. **Lightbox Modal**: Pratinjau gambar layar penuh yang ringan dan ramah layar sentuh ponsel.

---

### 3.6 Testimonial (*Social Proof* — `/testimonial`)
- **Tujuan**: Membangun kredibilitas melalui pengalaman nyata wisatawan terdahulu.
- **Hierarki Section**:
  1. **Page Header**: Judul dan statistik kepuasan wisatawan.
  2. **Grid Ulasan**:
     - Foto wisatawan (atau inisial).
     - Nama lengkap / asal kota wisatawan.
     - Nama paket wisata yang diikuti.
     - Rating bintang kepuasan.
     - Tanggal ulasan.
     - Isi testimoni autentik.
  3. **Bottom CTA**: "Siap Membuat Cerita Liburan Anda Sendiri?" (`/reservasi`).

---

### 3.7 Formulir Reservasi (*Reservation Request* — `/reservasi`)
- **Tujuan**: Menerima data permintaan perjalanan resmi dari calon pelanggan secara valid dan terstruktur.
- **Hierarki Section**:
  1. **Page Header**: Petunjuk pengisian formulir pemesanan.
  2. **Formulir Permintaan Perjalanan**:
     - **Data Kontak**: Nama Lengkap (*wajib*), Nomor WhatsApp Aktif (*wajib*), Alamat Email (*opsional*).
     - **Data Perjalanan**: Pilihan Paket Wisata (*dropdown/context pre-filled*), Tanggal Perjalanan (`travel_date >= today`, *wajib*), Jumlah Peserta (integer minimal 1, *wajib*).
     - **Permintaan Tambahan**: Textarea untuk rute kustom, preferensi makanan, atau penjemputan khusus.
  3. **Kebijakan & Transparansi**: Keterangan bahwa form ini merupakan permintaan reservasi awal yang akan dikonfirmasi admin tanpa pemotongan biaya instan.
  4. **Tombol Submit**: "Kirim Permintaan Reservasi".
  5. **Feedback Tampilan**:
     - *Success State*: Pesan terima kasih informatif + estimasi waktu tim admin menghubungi via WhatsApp.
     - *Error State*: Penjelasan kesalahan input data yang mudah dipahami tanpa pesan teknis server.

---

### 3.8 Kontak & Lokasi (*Contact* — `/kontak`)
- **Tujuan**: Menyediakan saluran komunikasi resmi dan membuktikan keberadaan kantor fisik bisnis.
- **Hierarki Section**:
  1. **Page Header & Greeting Kontak**.
  2. **Kartu Informasi Kontak**:
     - Nomor WhatsApp CS & Operasional.
     - Alamat email resmi.
     - Alamat lengkap kantor di Pangandaran.
     - Jam operasional pelayanan.
  3. **Integrasi Peta Google Maps**: Peta interaktif berbasis koordinat GPS aktual + tombol "Buka Petunjuk Arah".
  4. **Tautan Media Sosial Resmi**: Instagram, TikTok, Facebook, dan YouTube.

---

# 4. Sistem Navigasi & Komponen Persisten

### 4.1 Header & Navigasi Desktop
- **Kiri**: Logo resmi Puja Tour Travel (tautan ke `/`).
- **Tengah**: Menu navigasi: `Beranda`, `Tentang Kami`, `Paket Wisata`, `Galeri`, `Testimonial`, `Kontak`.
- **Kanan**:
  - Tombol aksi utama: `Reservasi` (Button primer).
  - Tombol WhatsApp CS (Button aksen hijau dengan ikon WhatsApp).

### 4.2 Navigasi Mobile (Drawer / Hamburger Menu)
- **Header Mobile**: Logo di kiri, tombol *Hamburger Menu* di kanan.
- **Drawer Menu**:
  - Menampilkan seluruh menu halaman secara vertikal dengan area sentuh jari (*touch target*) minimal 44x44 px.
  - Tautan langsung WhatsApp dan tombol "Kirim Reservasi" berukuran penuh di bagian bawah menu drawer.
  - Tombol tutup silang (✕) yang jelas di pojok kanan atas.

### 4.3 Visual Active State & Sticky Header
- Halaman yang sedang aktif ditandai secara visual (*underline* warna aksen, warna teks berbeda, atau penanda kontras).
- Header menggunakan mekanisme *Sticky Header* (tetap berada di atas saat pengguna menggulir halaman) dengan tinggi proporsional agar tidak menutupi area baca.

### 4.4 Persistent Floating WhatsApp Button
- Terpasang di pojok kanan bawah (*bottom-right*) pada seluruh halaman website publik.
- Memiliki animasi denyut halus (*subtle pulse*) untuk menarik perhatian tanpa mengganggu pembacaan konten.
- Pada layar mobile, posisi tombol diatur aman agar tidak menutupi tombol formulir penting (*safe padding*).

### 4.5 Footer Navigation & Grouping
```text
Puja Tour Travel
Biro perjalanan wisata resmi di Pangandaran, Jawa Barat.

[Tentang Bisnis]         [Paket Wisata]          [Bantuan & Legal]       [Hubungi Kami]
• Profil Perusahaan      • Eksklusif             • Cara Reservasi        • WhatsApp CS
• Tim Pemandu            • Semi Edukasi          • Syarat & Ketentuan    • Email Resmi
• Galeri Dokumentasi     • Nuansa Budaya         • Legalitas CV          • Kantor Pangandaran
• Testimonial Wisatawan  • Semua Paket Wisata    • Kebijakan Privasi     • Akun Media Sosial
───────────────────────────────────────────────────────────────────────────────────────────
© 2026 Puja Tour Travel. Hak Cipta Dilindungi Undang-Undang.
```

---

# 5. Jalur Konversi & Tautan Internal (*Internal Linking*)

Website dirancang untuk mengarahkan pengunjung menuju aksi nyata melalui 4 jalur konversi utama:

```text
[JALUR 1: EKSPLORASI DETAIL KE FORM RESERVASI]
Beranda ──► Katalog Paket ──► Detail Paket ──► Klik "Reservasi Sekarang" ──► Form Terisi Otomatis ──► Submit

[JALUR 2: KONSULTASI INSTAN VIA WHATSAPP KONTEKSTUAL]
Detail Paket ──► Klik "Tanya via WhatsApp" ──► WhatsApp Terbuka dengan Pesan Otomatis Membawa Nama Paket

[JALUR 3: RESERVASI LANGSUNG DARI BERANDA]
Beranda ──► Klik "Reservasi" di Header / Hero ──► Pilih Paket di Form ──► Submit Permintaan

[JALUR 4: MEDIA SOSIAL KE LANDING PAGE]
Instagram / TikTok ──► Tautan Bio / Ads ──► Landing Paket ──► Reservasi / WhatsApp Chat
```

---

# 6. Standar URL, Slug, & Breadcrumb

### 6.1 Kaidah Format URL & Slug
1. **Huruf Kecil Mutlak (*Lowercase*)**: Semua rute menggunakan huruf kecil (contoh: `/paket-wisata`, bukan `/Paket-Wisata`).
2. **Pemisah Tanda Hubung (*Hyphens*)**: Menggunakan strip `-`, bukan garis bawah `_` atau spasi (contoh: `green-canyon-vip`).
3. **Deskriptif & Ramah SEO**: Menggambarkan konten halaman tanpa parameter ID acak pada sisi publik.
   - *Benar*: `/paket-wisata/body-rafting-green-canyon`
   - *Dilarang*: `/package.php?id=82` atau `/paket/view/item1`
4. **Keunikan Slug (*Unique Constraint*)**: Slug paket wisata wajib unik di database.

### 6.2 Kaidah Breadcrumb
Breadcrumb wajib diimplementasikan pada halaman bertingkat (*deep-level pages*), khususnya halaman detail paket wisata:
```text
Beranda  ›  Paket Wisata  ›  Green Canyon VIP
```

---

# 7. Status Tampilan Antarmuka (*UI States*)

Setiap halaman dinamis wajib mengakomodasi skenario tampilan berikut:

### 7.1 Halaman Kesalahan Khusus (*Custom Error Pages*)
- **Halaman 404 (Not Found)**:
  - Tampilan visual ramah bertema wisata.
  - Pesan: "Halaman yang Anda cari tidak ditemukan atau telah dipindahkan."
  - Tombol navigasi penyelamat: "Kembali ke Beranda" dan "Lihat Paket Wisata".
- **Halaman 500 (Server Error)**:
  - Pesan tenang tanpa menampilkan *code exception* atau *stack trace* PHP kepada publik.
  - Tombol: "Muat Ulang Halaman" atau "Hubungi CS WhatsApp".

### 7.2 Kondisi Data Kosong (*Empty States*)
- **Katalog Paket Kosong**: "Belum ada paket wisata aktif pada kategori ini. Silakan pilih kategori lain atau hubungi admin."
- **Galeri Kosong**: "Dokumentasi perjalanan sedang diperbarui."
- **Testimonial Kosong**: "Ulasan pelanggan sedang diverifikasi."

### 7.3 Status Pemuatan (*Skeleton Loading*)
- Menampilkan kerangka abu-abu beranimasi samar (*shimmer skeleton cards*) saat data paket atau galeri sedang dimuat melalui AJAX/Livewire/SPA untuk menghindari layar putih kosong (*blank screen*).

---

# 8. Struktur Metadata SEO & Open Graph

Setiap halaman publik wajib menyertakan tag HTML semantik dan metadata berikut:

| Parameter | Sumber Data Beranda | Sumber Data Detail Paket |
|---|---|---|
| `<title>` | `Puja Tour Travel - Paket Wisata Pangandaran Terbaik & Terpercaya` | `[Nama Paket] - Paket Wisata Pangandaran | Puja Tour Travel` |
| `<meta name="description">` | Ringkasan profil dan penawaran utama dari CMS settings. | `short_description` paket wisata terkait. |
| `<link rel="canonical">` | `https://pujatourtravel.com/` | `https://pujatourtravel.com/paket-wisata/{slug}` |
| `og:title` | Sama dengan title tag beranda. | Nama paket wisata resmi. |
| `og:description` | Meta description beranda. | Ringkasan fasilitas dan keunggulan paket. |
| `og:image` | Banner utama beranda (rasio 1200x630 px). | Gambar thumbnail utama paket wisata. |
| `og:url` | URL absolut halaman. | URL absolut halaman detail paket. |

---

# 9. Prioritas Implementasi Halaman Publik

- **P0 (Kritis / Rilis Pertama)**:
  - `/` (Beranda)
  - `/paket-wisata` (Katalog Paket)
  - `/paket-wisata/{slug}` (Detail Paket Wisata)
  - `/reservasi` (Formulir Reservasi)
  - `/kontak` (Kontak & Peta Lokasi)
  - Halaman 404 Kustom
- **P1 (Penting / Penguat Brand)**:
  - `/tentang-kami` (Profil & Legalitas CV)
  - `/galeri` (Dokumentasi Perjalanan)
  - `/testimonial` (Ulasan Pelanggan)
- **P2 / Opsional**:
  - `/tour-guide` (Halaman khusus panduan independen jika terpisah dari Tentang Kami)

---

# 10. Arsitektur & Rute Admin Dashboard (`/admin/*`)

Area admin mengelola seluruh data operasional bisnis dan berada di bawah prefix rute `/admin`.

### 10.1 Matriks Rute Admin
| Modul | Rute URL | Metode HTTP | Deskripsi Fungsi |
|---|---|---|---|
| **Otentikasi** | `/admin/login` | GET, POST | Halaman masuk aman staf administrator |
| | `/admin/logout` | POST | Mengakhiri sesi login admin |
| **Dashboard** | `/admin/dashboard` | GET | Ringkasan metrik reservasi, paket, dan customer |
| **Paket Wisata** | `/admin/packages` | GET | Daftar paket, filter kategori, pencarian |
| | `/admin/packages/create` | GET, POST | Formulir penambahan paket wisata baru |
| | `/admin/packages/{id}/edit` | GET, PUT | Editor rincian paket, fasilitas, dan itinerary |
| | `/admin/packages/{id}/archive` | POST | Mengarsipkan paket tanpa menghapus data historis |
| **Reservasi** | `/admin/reservations` | GET | Tabel reservasi, filter status, filter tanggal |
| | `/admin/reservations/{id}` | GET | Rincian lengkap pemesan, paket, dan log |
| | `/admin/reservations/{id}/status`| PUT | Memperbarui status (*Pending, Diproses, dll.*) |
| **Pelanggan** | `/admin/customers` | GET | Daftar master pelanggan dan total riwayat trip |
| | `/admin/customers/{id}` | GET | Profil pelanggan dan riwayat seluruh reservasi |
| **Sumber Lead** | `/admin/customer-sources` | GET, POST, PUT | Kelola opsi saluran akuisisi (*Instagram, TikTok, dll.*) |
| **CMS Beranda** | `/admin/homepage` | GET, PUT | Editor teks hero, banner gambar, dan section beranda |
| **CMS Profil** | `/admin/about` | GET, PUT | Editor sejarah bisnis, visi, misi, dan nilai |
| **CMS Legalitas** | `/admin/legal` | GET, PUT | Unggah NIB, dokumen izin usaha, dan identitas CV |
| **CMS Pemandu** | `/admin/tour-guides` | GET, POST, PUT, DELETE | Kelola data pemandu, sertifikasi, dan foto |
| **CMS Galeri** | `/admin/galleries` | GET, POST, DELETE | Unggah dan kelola foto galeri dokumentasi |
| **CMS Review** | `/admin/testimonials` | GET, POST, PUT, DELETE | Kelola dan kurasi ulasan testimonial |
| **CMS Kontak** | `/admin/contact` | GET, PUT | Nomor WhatsApp resmi, alamat kantor, koordinat GPS |
| **CMS Medsos** | `/admin/social-media` | GET, PUT | Tautan resmi Instagram, TikTok, Facebook, YouTube |
| **Pengaturan SEO** | `/admin/seo` | GET, PUT | Meta title global, meta description, favicon, OG Image |
| **Pengelola File** | `/admin/media` | GET, POST, DELETE | Manajemen file gambar dan aset digital terpusat |

### 10.2 Kebijakan Proteksi Rute Admin
1. Seluruh rute `/admin/*` (kecuali `/admin/login`) wajib dilindungi oleh middleware otentikasi Laravel (`auth`).
2. Akses tanpa izin secara otomatis diarahkan (*redirect*) ke `/admin/login` dengan pesan sesi yang sesuai.
3. Tindakan krusial (seperti mengubah status reservasi atau mengarsipkan paket) wajib dilindungi dari serangan *CSRF* (*Cross-Site Request Forgery*).

---

# 11. Matriks Relasi Halaman ke Data (*Page-to-Data Mapping*)

| Halaman | Data yang Dibaca dari Basis Data | Data yang Dihasilkan / Disimpan |
|---|---|---|
| **Beranda (`/`)** | Setting situs, konten hero, paket berstatus `featured = true`, cuplikan galeri, cuplikan testimonial, kontak resmi. | - |
| **Tentang Kami (`/tentang-kami`)** | Konten profil perusahaan, dokumen legalitas CV, data pemandu wisata aktif. | - |
| **Katalog (`/paket-wisata`)** | Kategori aktif, seluruh paket wisata dengan status `published`. | - |
| **Detail Paket (`/paket-wisata/{slug}`)** | Data paket, rincian fasilitas (*inclusions/exclusions*), itinerary, galeri paket, paket rekomendasi terkait. | - |
| **Galeri (`/galeri`)** | Seluruh media gambar berstatus `published` beserta kategori foto. | - |
| **Testimonial (`/testimonial`)** | Seluruh ulasan pelanggan berstatus `published`. | - |
| **Reservasi (`/reservasi`)** | Daftar paket aktif untuk pilihan dropdown, konfigurasi kontak. | Membuat/memperbarui data `Customer` dan membuat baris baru `Reservation` (status `Pending`, source `Website`). |
| **Kontak (`/kontak`)** | Data kontak resmi, alamat kantor fisik, koordinat peta GPS, tautan media sosial. | - |
| **Admin Dashboard** | Agregasi statistik: total paket, reservasi pending, reservasi confirmed, total customer. | - |

---

# 12. Matriks Hak Akses Halaman (*Page Access Matrix*)

| Nama Halaman / Modul | Publik (Tanpa Login) | Administrator (Login) |
|---|:---:|:---:|
| Halaman Beranda (`/`) | Ya (Read-Only) | Ya (Kelola via CMS) |
| Halaman Tentang Kami (`/tentang-kami`) | Ya (Read-Only) | Ya (Kelola via CMS) |
| Halaman Katalog Paket (`/paket-wisata`) | Ya (Read-Only) | Ya (Kelola via CMS) |
| Halaman Detail Paket (`/paket-wisata/{slug}`) | Ya (Read-Only) | Ya (Kelola via CMS) |
| Halaman Galeri (`/galeri`) | Ya (Read-Only) | Ya (Kelola via CMS) |
| Halaman Testimonial (`/testimonial`) | Ya (Read-Only) | Ya (Kelola via CMS) |
| Halaman Form Reservasi (`/reservasi`) | Ya (Create Request) | Ya (Kelola via Admin) |
| Halaman Kontak (`/kontak`) | Ya (Read-Only) | Ya (Kelola via CMS) |
| Halaman Login Admin (`/admin/login`) | Ya (Form Login) | Redirect ke Dashboard |
| Dashboard Ringkasan (`/admin/dashboard`) | **Dilarang (403/Redirect)** | Ya (Full Access) |
| Detail Data Reservasi (`/admin/reservations/*`) | **Dilarang (403/Redirect)** | Ya (Full Access) |
| Basis Data Pelanggan (`/admin/customers/*`) | **Dilarang (403/Redirect)** | Ya (Full Access) |
| Seluruh Modul Pengaturan CMS (`/admin/*`) | **Dilarang (403/Redirect)** | Ya (Full Access) |

---

# 13. Strategi Call-to-Action (CTA) & Konversi Mobile

### 13.1 Standarisasi Label CTA
Gunakan penamaan label tombol yang seragam untuk tindakan yang serupa di seluruh halaman:
- **Katalog & Detail**: Gunakan *"Lihat Detail Paket"* untuk navigasi kartu, dan *"Reservasi Sekarang"* untuk tombol konversi utama.
- **WhatsApp**: Gunakan *"Konsultasi via WhatsApp"* atau *"Tanya via WhatsApp"*.
- **Formulir**: Gunakan *"Kirim Permintaan Reservasi"*.
- *Hindari inkonsistensi* penggunaan istilah berganti-ganti seperti "Book Now", "Pesan Tour", "Order", atau "Daftar".

### 13.2 Optimasi Konversi Mobile
Pada tampilan smartphone, halaman detail paket wisata menyertakan **Sticky Bottom Bar** (bilah aksi melayang di bagian bawah layar) yang berisi ringkasan harga dan tombol cepat "Reservasi" serta ikon WhatsApp agar pengguna tidak perlu menggulir jauh ke atas untuk melakukan pemesanan.

---

# 14. Aksesibilitas & Performa Halaman

1. **Aksesibilitas (A11y)**:
   - Seluruh elemen tombol dan tautan memiliki kontras warna memenuhi standar WCAG 2.1 AA.
   - Semua gambar konten wajib memiliki atribut `alt` deskriptif untuk pembaca layar (*screen reader*).
   - Seluruh kontrol formulir memiliki tag `<label>` yang terhubung secara semantik ke elemen `<input>`.
2. **Performa**:
   - Gambar otomatis dikonversi ke format modern WebP/AVIF dengan kompresi optimal.
   - Pemuatan aset gambar di bawah layar menggunakan atribut `loading="lazy"`.
   - Mengurangi penggunaan script JavaScript pihak ketiga yang memperlambat *First Contentful Paint (FCP)*.

---

# 15. Daftar Periksa Kesiapan Halaman (*Definition of Done*)

### 15.1 Checklist Halaman Publik
- [ ] Rute URL sesuai dengan spesifikasi dokumen dan menghasilkan kode status HTTP 200.
- [ ] Seluruh halaman publik teruji responsif di layar ponsel cerdas (viewport 360px - 414px) dan desktop.
- [ ] Tombol WhatsApp membuka aplikasi WhatsApp dengan nomor resmi dan pesan pembuka kontekstual yang tepat.
- [ ] Formulir reservasi memvalidasi input tanggal perjalanan dan jumlah peserta sebelum mengirim data.
- [ ] Data yang tampil di halaman publik hanya data yang berstatus `Published` di database.
- [ ] Halaman 404 kustom tampil rapi saat pengguna mengakses URL yang tidak terdaftar.
- [ ] Tidak ada data sensitif pelanggan (nomor HP, email, catatan admin) yang bocor di halaman publik atau respon JSON publik.

### 15.2 Checklist Halaman Admin
- [ ] Rute `/admin/*` berhasil memblokir pengunjung non-login dan mengarahkan ke `/admin/login`.
- [ ] Admin dapat melakukan CRUD paket wisata beserta fasilitas, exclusion, dan itinerary.
- [ ] Admin dapat memfilter dan memperbarui status reservasi (*Pending, Diproses, Dikonfirmasi, Selesai, Dibatalkan*).
- [ ] Halaman detail pelanggan menampilkan riwayat seluruh reservasi yang pernah dibuat.
- [ ] Seluruh perubahan data melalui CMS langsung tercermin pada halaman publik terkait tanpa perlu restart aplikasi.

---

# 16. Pohon Visual Sitemap Keseluruhan

```text
[PUBLIC AREA]
/ (Beranda)
├── /tentang-kami (Profil Perusahaan, Nilai, Legalitas, & Pemandu)
├── /paket-wisata (Katalog Paket dengan Filter Kategori)
│   └── /paket-wisata/{slug} (Detail Paket, Fasilitas, Itinerary, & Booking CTA)
├── /galeri (Koleksi Foto Dokumentasi Wisata & Lightbox)
├── /testimonial (Ulasan Wisatawan Riil)
├── /reservasi (Formulir Pemesanan Perjalanan)
│   └── /reservasi?package={slug} (Formulir Terisi Otomatis Konteks Paket)
└── /kontak (Alamat Fisik, Jam Operasional, & Peta Google Maps)

[ADMIN AREA - PROTECTED]
/admin/login (Pintu Masuk Otentikasi)
└── /admin/dashboard (Pusat Kendali & Metrik Operasional)
    │
    ├── [MANAJEMEN PAKET & TRANSAKSI]
    │   ├── /admin/packages (Daftar & Status Paket)
    │   ├── /admin/packages/create (Tambah Paket)
    │   ├── /admin/packages/{id}/edit (Ubah Konten & Harga Paket)
    │   ├── /admin/reservations (Daftar Reservasi & Filter)
    │   ├── /admin/reservations/{id} (Rincian & Pembaruan Status Reservasi)
    │   ├── /admin/customers (Database Pelanggan)
    │   └── /admin/customers/{id} (Histori Perjalanan Pelanggan)
    │
    ├── [MANAJEMEN KONTEN PUBLIK (CMS)]
    │   ├── /admin/homepage (Hero & Banner Beranda)
    │   ├── /admin/about (Visi, Misi, & Sejarah)
    │   ├── /admin/legal (Dokumen Legalitas CV)
    │   ├── /admin/tour-guides (Profil & Sertifikasi Pemandu)
    │   ├── /admin/galleries (Manajemen Galeri Foto)
    │   └── /admin/testimonials (Kurasi Ulasan Testimonial)
    │
    └── [PENGATURAN & SISTEM]
        ├── /admin/customer-sources (Master Saluran Sumber Akuisisi)
        ├── /admin/contact (Kontak Resmi & Titik GPS Peta)
        ├── /admin/social-media (Akun Medsos Resmi)
        ├── /admin/seo (Metadata SEO Global)
        ├── /admin/media (Pengelola Aset Digital)
        └── /admin/settings (Konfigurasi Global Website)
```

---

# 17. Aturan Implementasi Pengembang & AI Agent

1. **Konsistensi Rute**: Dilarang mengubah nama rute publik atau admin di luar spesifikasi tanpa pembaruan dokumen ini.
2. **Pemisahan Logika Data**: Rute publik hanya boleh menampilkan data dengan status `Published`. Data berstatus `Draft` atau `Archived` dilarang bocor ke view publik.
3. **Konfigurasi Database-Driven**: Jangan menyimpan data kontak bisnis, harga, atau konten halaman secara statis di template Blade/HTML. Semuanya wajib diambil dari database.
4. **Validasi Formulir Ganda**: Seluruh formulir wajib memiliki validasi di sisi browser (UX instan) dan validasi ketat di Laravel Form Request (Backend Security).

---

# 18. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Gambaran umum identitas dan tujuan bisnis
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) — Kebutuhan bisnis, siklus reservasi, dan aturan bisnis (*BR*)
- `04-ui-ux-guidelines.md` — Panduan visual antarmuka, warna, tipografi, dan gaya komponen
- `05-public-website.md` — Spesifikasi teknis implementasi halaman publik
- `06-admin-cms.md` — Spesifikasi teknis dan antarmuka dashboard admin
- `07-reservation-system.md` — Alur komprehensif sistem pemesanan perjalanan
- `08-customer-management.md` — Desain modul pengelolaan data pelanggan
- `09-database.md` — Skema tabel basis data, relasi, dan kamus data
- `10-security.md` — Arsitektur proteksi keamanan dan kebijakan data pribadi
- `11-seo-and-analytics.md` — Strategi optimasi mesin pencari dan pelacakan metrik
