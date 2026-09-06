# 05 — Public Website Specifications
# Puja Tour Travel Website

> Dokumen ini mendefinisikan spesifikasi teknis dan fungsional seluruh halaman website publik Puja Tour Travel yang dapat diakses oleh calon wisatawan tanpa perlu login.
> Dokumen ini menjadi pedoman utama dalam pengembangan komponen antarmuka, tata letak section, integrasi data CMS, optimasi konversi, dan SEO publik.

---

# 1. Sasaran & Prinsip Website Publik

### 1.1 Alur Pengalaman Pengunjung (*Visitor Conversion Journey*)
Website publik dirancang untuk memandu calon wisatawan melalui alur konversi yang terarah:
```text
[DISCOVER]      Pengunjung menemukan website via Google, Medsos, atau Rekomendasi.
    ▼
[UNDERSTAND]    Mengenal kredibilitas Puja Tour Travel, profil lokal, dan legalitas CV.
    ▼
[TRUST]         Melihat ulasan asli, foto aktivitas riil, dan pemandu tersertifikasi.
    ▼
[EXPLORE]       Menjelajahi katalog paket wisata, rincian fasilitas, dan itinerary.
    ▼
[INQUIRE]       Menghubungi admin via WhatsApp untuk tanya jadwal atau konsultasi.
    ▼
[RESERVE]       Mengisi formulir permintaan reservasi resmi di website.
```

### 1.2 Prinsip Desain Sisi Publik
- **Kredibilitas Tinggi**: Menampilkan data bisnis aktual dan legalitas resmi; dilarang mengarang klaim fiktif.
- **Konversi Jelas**: Setiap halaman memiliki ajakan bertindak (*Call-to-Action / CTA*) yang konsisten dan mudah diakses.
- **Mobile-First & Responsif**: Beroperasi mulus pada ponsel pintar tanpa pergeseran horizontal (*zero overflow-x*).
- **Cepat & Ringan**: Optimasi kompresi gambar modern (WebP/AVIF), pemuatan bertahap (*lazy loading*), dan tanpa animasi yang memberatkan kinerja browser.
- **Berbasis Basis Data (*Database-Driven*)**: Seluruh harga, kontak, itinerary, dan teks konten bersumber dari database dan dapat diubah melalui admin CMS.

---

# 2. Struktur Global & Komponen Navigasi

Seluruh halaman publik menggunakan tata letak konsisten:
```text
┌─────────────────────────────────────────────────────────────┐
│ Header (Logo, Navigasi Utama, Tombol Reservasi & WhatsApp)   │
├─────────────────────────────────────────────────────────────┤
│ Main Content Area (Konten Spesifik Halaman)                 │
├─────────────────────────────────────────────────────────────┤
│ Global Conversion CTA Section                               │
├─────────────────────────────────────────────────────────────┤
│ Footer (Profil Brand, Tautan Cepat, Kontak, Medsos, Hak Cipta)│
└─────────────────────────────────────────────────────────────┘
  [Tombol Melayang WhatsApp Aktif di Pojok Kanan Bawah]
```

### 2.1 Header & Navigasi
- **Desktop**:
  - Sisi Kiri: Logo resmi Puja Tour Travel (tautan kembali ke `/`).
  - Bagian Tengah: Menu navigasi utama (`Beranda`, `Tentang Kami`, `Paket Wisata`, `Galeri`, `Testimonial`, `Kontak`) dengan penanda visual status halaman aktif (*active state*).
  - Sisi Kanan: Tombol cepat "Reservasi" (`/reservasi`) dan tombol WhatsApp CS.
- **Mobile (Drawer Menu)**:
  - Header ramping memuat logo dan tombol *Hamburger*.
  - Menu drawer menampilkan seluruh tautan vertikal berjarak sentuh nyaman (min. 44x44px) dilengkapi tombol aksi penuh WhatsApp dan Reservasi di bagian bawah.
- **Sticky Header**:
  - Header tetap menempel di bagian atas saat halaman digulir ke bawah (*scroll*), dengan ketinggian lebih ramping (*compact*) dan bayangan halus (*shadow-md*).

### 2.2 Tombol Melayang WhatsApp (*Floating WhatsApp*)
- Terpasang di pojok kanan bawah (*bottom-right*) seluruh halaman publik.
- Dilengkapi animasi denyut lembut (*subtle pulse*) tanpa mengganggu area baca.
- Pada halaman detail paket wisata, tombol WhatsApp secara otomatis menyertakan nama paket terkait saat membuka aplikasi WhatsApp.
- **Aturan Akses**: Tautan WhatsApp hanya terbuka setelah pengguna mengklik tombol secara sukarela; dilarang membuka jendela obrolan secara otomatis (*no auto-popup / auto-redirect*).

### 2.3 Footer Global
- **Identitas Brand**: Logo resmi dan ringkasan singkat profil Puja Tour Travel.
- **Navigasi Cepat**: Tautan ke Tentang Kami, Paket Wisata, Galeri, Testimonial, Reservasi, dan Kontak.
- **Kategori Paket**: Tautan cepat ke kategori Eksklusif, Semi Edukasi, dan Nuansa Budaya.
- **Informasi Kontak**: Nomor WhatsApp, telepon, email resmi, alamat fisik kantor di Pangandaran, dan jam operasional.
- **Media Sosial**: Tautan resmi akun Instagram, TikTok, Facebook, dan YouTube.
- **Hak Cipta**: Pernyataan kepemilikan hak cipta resmi.

---

# 3. Spesifikasi Rinci Halaman Publik

---

### 3.1 Beranda (*Homepage* — `/`)
- **Tujuan**: Memperkenalkan Puja Tour Travel, menanamkan rasa percaya, menampilkan paket unggulan, dan memfasilitasi konversi awal.
- **Rincian Section**:
  1. **Hero Section**:
     - *Headline*: Pesan selamat datang inspiratif berorientasi pengalaman wisata Pangandaran.
     - *Subheadline*: Penjelasan nilai keunggulan lokal dan kenyamanan layanan.
     - *Primary CTA*: "Lihat Paket Wisata" (Tautan ke `/paket-wisata`).
     - *Secondary CTA*: "Konsultasi via WhatsApp" (Tautan langsung obrolan).
     - *Visual*: Foto lanskap berkualitas tinggi destinasi Pangandaran dengan lapisan peredup halus (*dark scrim/overlay*) untuk memastikan keterbacaan teks.
  2. **Trust Elements Bar**:
     - 4 kartu keunggulan: Legalitas Badan Hukum CV, Pemandu Lokal Tersertifikasi, Perlengkapan Keselamatan Terstandar, Asuransi Perjalanan.
  3. **Paket Wisata Unggulan (*Featured Packages*)**:
     - Menampilkan 3–6 paket wisata aktif yang ditandai `featured = true`.
     - Setiap kartu memuat: foto sampul (rasio 16:10), badge kategori, badge durasi, judul paket, deskripsi ringkas, harga per pax, dan tombol "Lihat Detail".
     - Tautan bawah: "Lihat Semua Paket Wisata" (`/paket-wisata`).
  4. **Tentang Kami Preview**:
     - Cuplikan sejarah dan komitmen kearifan lokal + tombol "Kenal Lebih Dekat" (`/tentang-kami`).
  5. **Mengapa Memilih Kami (*Why Choose Us*)**:
     - 4 pilar layanan: Pengetahuan Destinasi Mendalam, Layanan Ramah & Terorganisir, Prioritas Keselamatan, Perjalanan Autentik.
  6. **Galeri Dokumentasi Pilihan**:
     - Grid 6 foto kegiatan riil wisatawan + tombol "Lihat Semua Galeri" (`/galeri`).
  7. **Testimonial Pilihan**:
     - 3 ulasan pelanggan terverifikasi lengkap dengan foto, nama, rating bintang, dan nama paket yang diambil.
  8. **Banner Ajakan Bertindak (*Final Conversion Banner*)**:
     - Judul persuasif untuk merencanakan liburan ke Pangandaran + tombol ganda "Pilih Paket" dan "Hubungi WhatsApp".
  9. **Lokasi Kantor Fisik**:
     - Cuplikan alamat kantor di Pangandaran dan peta Google Maps interaktif.

---

### 3.2 Halaman Tentang Kami (*About Us* — `/tentang-kami`)
- **Tujuan**: Menjelaskan identitas, legalitas, nilai-nilai lokal, dan profil tim pemandu wisata Puja Tour Travel.
- **Rincian Section**:
  1. **Page Header**: Judul halaman "Tentang Puja Tour Travel" dan deskripsi pengantar.
  2. **Profil & Sejarah Singkat**: Kisah pendirian bisnis dan komitmen memajukan pariwisata Pangandaran.
  3. **Visi & Misi Perusahaan**: Komitmen pelayanan profesional, pelestarian lingkungan, dan kenyamanan pelanggan.
  4. **Nilai-Nilai Utama**: *Local Experience*, *Safety First*, *Professionalism*, dan *Local Wisdom*.
  5. **Transparansi Legalitas CV**: Nomor Induk Berusaha (NIB) dan dokumen pendukung resmi yang dapat diverifikasi.
  6. **Tim Pemandu Wisata (*Tour Guides*)**:
     - Kartu profil pemandu: foto resmi, nama lengkap, pengalaman memandu, spesialisasi rute, dan nomor sertifikasi resmi.
  7. **Kepedulian Konservasi**: Keterlibatan dalam pelestarian penyu dan hutan mangrove di pesisir Pangandaran.
  8. **Bottom CTA**: "Siap Berpetualang Bersama Kami?" (`/paket-wisata`).

---

### 3.3 Katalog Paket Wisata (*Package Listing* — `/paket-wisata`)
- **Tujuan**: Menampilkan seluruh paket perjalanan aktif dengan kemudahan navigasi filter.
- **Rincian Section**:
  1. **Page Header**: Judul katalog dan panduan singkat memilih paket perjalanan.
  2. **Filter Kategori Dinamis**: Tab filter berbasis database (`Semua`, `Eksklusif`, `Semi Edukasi`, `Nuansa Budaya`).
  3. **Package Grid**:
     - Desktop: 3 kolom kartu paket.
     - Tablet: 2 kolom.
     - Mobile: 1 kolom penuh.
     - Hanya menampilkan paket dengan status `published`.
  4. **Empty State**: Pesan ramah dan informatif bila kategori yang dipilih belum memiliki paket aktif.
  5. **Pagination**: Navigasi halaman jika jumlah paket bertambah di masa depan.

---

### 3.4 Detail Paket Wisata (*Package Detail* — `/paket-wisata/{slug}`)
- **Tujuan**: Halaman konversi utama yang menyajikan rincian teknis lengkap suatu paket wisata.
- **Rincian Section**:
  1. **Breadcrumb**: `Beranda > Paket Wisata > [Nama Paket]`.
  2. **Hero Detail Paket**:
     - Judul paket wisata, badge kategori, badge durasi, lokasi destinasi.
     - Gambar sampul utama dan foto galeri pendukung paket.
  3. **Ringkasan Cepat (*Quick Info Pills*)**:
     - Durasi tur (contoh: 2H1M), lokasi utama (contoh: Green Canyon), kuota peserta ideal, titik kumpul.
  4. **Panel Pemesanan Melayang (*Sticky Booking Card*)**:
     - Tampilan harga resmi per satuan (misal: `Rp 750.000 / pax`).
     - Tombol Aksi Utama: "Reservasi Sekarang" (`/reservasi?package={slug}`).
     - Tombol Aksi Sekunder: "Tanya via WhatsApp" (Pesan otomatis memuat nama paket).
     - Pada layar ponsel, panel ini bertransformasi menjadi *Sticky Bottom Bar* di bawah layar.
  5. **Deskripsi Komprehensif (*Overview*)**:
     - Penjelasan mendalam mengenai pengalaman dan keistimewaan perjalanan.
  6. **Fasilitas Termasuk & Tidak Termasuk**:
     - *Inclusions (✓)*: Pemandu lokal, transportasi perahu, tiket masuk, makan, asuransi, perlengkapan rafting.
     - *Exclusions (✕)*: Pengeluaran pribadi, akomodasi di luar kesepakatan, transportasi luar kota asal.
  7. **Rincian Itinerary Perjalanan**:
     - Jadwal terstruktur per jam (waktu, nama aktivitas, lokasi, dan penjelasan ringkas).
  8. **Paket Terkait (*Related Packages*)**:
     - Rekomendasi 2–3 paket alternatif dalam kategori yang serupa.

---

### 3.5 Galeri Dokumentasi (*Gallery* — `/galeri`)
- **Tujuan**: Memberikan bukti visual autentik keindahan destinasi dan keceriaan rombongan wisatawan terdahulu.
- **Rincian Section**:
  1. **Page Header & Pengantar Galeri**.
  2. **Filter Kategori Dokumentasi**: Tab filter foto (`Semua`, `Destinasi Alam`, `Aktivitas Body Rafting`, `Budaya & Kuliner`, `Konservasi`).
  3. **Media Grid Responsif**: Tata letak grid foto berkualitas tinggi dengan aspek rasio rapi.
  4. **Lightbox Modal Interaktif**:
     - Tampilan layar penuh gambar saat diklik.
     - Dilengkapi tombol navigasi (Sebelumnya, Selanjutnya, Tutup) dan dukungan gestur geser (*swipe*) pada layar ponsel.
     - Hanya menampilkan foto yang berstatus `published`.

---

### 3.6 Testimonial (*Social Proof* — `/testimonial`)
- **Tujuan**: Menghadirkan ulasan kepuasan pelanggan sebagai pendorong keputusan calon wisatawan.
- **Rincian Section**:
  1. **Page Header & Statistik Kepuasan Pelanggan**.
  2. **Grid Ulasan Wisatawan**:
     - Foto profil wisatawan (atau inisial avatar elegan).
     - Nama lengkap wisatawan dan asal kota.
     - Nama paket wisata yang telah diselesaikan.
     - Rating bintang kepuasan (1–5 bintang).
     - Ulasan pengalaman autentik.
     - Tanggal perjalanan.
  3. **Aturan Mutlak**: Dilarang menggunakan ulasan fiktif; seluruh data wajib bersumber dari wisatawan nyata.
  4. **Bottom CTA**: Ajakan memesan perjalanan impian ke Pangandaran.

---

### 3.7 Formulir Reservasi (*Reservation Request* — `/reservasi`)
- **Tujuan**: Menerima data permintaan pemesanan perjalanan secara terstruktur ke dalam database.
- **Rincian Form**:
  1. **Header Panduan**: Petunjuk ringkas pengisian formulir pemesanan.
  2. **Bagian 1: Informasi Kontak Pelanggan**:
     - *Nama Lengkap*: Wajib diisi (teks).
     - *Nomor WhatsApp Aktif*: Wajib diisi (format nomor telepon Indonesia diawali 08/62).
     - *Alamat Email*: Opsional (validasi format email jika diisi).
  3. **Bagian 2: Rincian Rencana Perjalanan**:
     - *Pilihan Paket Wisata*: Wajib dipilih (dropdown otomatis terisi jika berasal dari URL `/reservasi?package={slug}`).
     - *Tanggal Rencana Perjalanan*: Wajib dipilih (`travel_date >= hari ini`).
     - *Jumlah Peserta*: Wajib diisi (bilangan bulat minimal 1 orang).
  4. **Bagian 3: Permintaan Tambahan (*Custom Request*)**:
     - *Catatan Tambahan*: Textarea opsional untuk permintaan kustomisasi rute, menu makan vegetarian, penjemputan stasiun/bandara, atau kebutuhan lansia/anak.
  5. **Pencegahan Klik Ganda**: Tombol submit otomatis terkunci (*disabled*) dengan indikator loading saat pengiriman data berlangsung.
  6. **Hasil Pengiriman Form**:
     - Data tersimpan otomatis ke database dengan status awal `Pending` dan sumber `Website`.
     - *Success State*: Pesan terima kasih ramah mengonfirmasi bahwa data berhasil diterima dan tim operasional akan menghubungi via WhatsApp.
     - *Error State*: Pesan galat jelas jika koneksi terganggu atau ada field input yang belum memenuhi validasi.

---

### 3.8 Halaman Kontak & Lokasi (*Contact* — `/kontak`)
- **Tujuan**: Membuka saluran komunikasi langsung dan membuktikan keberadaan kantor fisik resmi di Pangandaran.
- **Rincian Section**:
  1. **Page Header & Salam Pelayanan**.
  2. **Detail Kontak Operasional**:
     - Nomor WhatsApp Customer Service.
     - Alamat email resmi.
     - Alamat kantor fisik lengkap di Pangandaran.
     - Jam operasional pelayanan kantor.
  3. **Peta Google Maps Terintegrasi**:
     - Peta interaktif berbasis koordinat GPS aktual (latitude/longitude) + tautan "Buka Petunjuk Arah di Google Maps".
  4. **Tautan Media Sosial Resmi**: Instagram, TikTok, Facebook, YouTube.

---

# 4. Keamanan Data & Kebijakan Data Privat Publik

Sisi publik harus menerapkan prinsip paparan data minimal (*Principle of Least Data Exposure*):
- **Data yang Boleh Ditampilkan ke Publik**: Nama paket, deskripsi, harga published, foto galeri published, ulasan testimonial publik, profil pemandu wisata publik, alamat kantor resmi.
- **Data yang DILARANG Keras Bocor ke Publik**:
  - Nomor telepon/WhatsApp wisatawan lain.
  - Alamat email wisatawan lain.
  - Catatan internal staf admin (*admin notes*).
  - Rincian data transaksi reservasi tanpa otentikasi login admin.
- Endpoint publik dilarang mengembalikan seluruh atribut model basis data mentah (`User`, `Reservation`, `Customer`). Selalu gunakan *API Resource* atau seleksi kolom spesifik pada Eloquent query.

---

# 5. Standar Responsivitas & Kinerja Frontend

### 5.1 Tata Letak Ponsel Pintar (*Mobile-First*)
- Seluruh komponen diuji pada lebar layar smartphone (360px – 414px).
- Dilarang keras terjadi luapan horizontal (*zero horizontal overflow*).
- Jarak antar-elemen interaktif minimal 8px untuk mencegah salah tekan jari.

### 5.2 Kinerja Pemuatan Halaman
- Format gambar wajib menggunakan **WebP** / **AVIF** dengan resolusi proporsional.
- Gambar di bawah layar wajib menyertakan atribut `loading="lazy"`.
- Foto Hero utama dioptimalkan agar termuat instan demi skor *Largest Contentful Paint (LCP)* yang tinggi.
- Hindari pustaka animasi JavaScript yang berat; gunakan transisi murni CSS Tailwind.

---

# 6. Struktur Metadata SEO & Media Sosial

Setiap halaman publik wajib menyertakan metadata lengkap:
- `<title>` unik per halaman.
- `<meta name="description">` deskriptif dan memikat (140–160 karakter).
- Tag Open Graph lengkap (`og:title`, `og:description`, `og:image`, `og:url`) agar tampilan pratinjau saat tautan dibagikan ke WhatsApp atau Facebook terlihat profesional dan menarik.
- Tag Twitter Card (`twitter:card`, `twitter:title`, `twitter:description`, `twitter:image`).

---

# 7. Katalog Komponen Antarmuka Publik Reusable

Komponen antarmuka yang wajib dibuat secara terpusat untuk menjaga konsistensi:
1. `HeaderNavbar`: Navigasi desktop dan drawer menu ponsel.
2. `FooterGlobal`: Navigasi bawah, kontak, dan tautan sosial media.
3. `FloatingWhatsApp`: Tombol aksi obrolan melayang dengan penyesuaian pesan kontekstual.
4. `PackageCard`: Kartu ringkasan paket wisata (foto sampul, badge kategori, harga, tombol detail).
5. `TrustItem`: Komponen sorotan keunggulan (ikon, judul, deskripsi).
6. `LightboxModal`: Penampil gambar resolusi penuh dengan kontrol navigasi.
7. `TestimonialCard`: Kartu ulasan wisatawan dengan rating bintang.
8. `SectionHeader`: Judul section terstandar dengan label kecil dan teks pengantar.
9. `EmptyState`: Tampilan ramah bila data paket atau ulasan belum tersedia.
10. `SkeletonCard`: Efek animasi berkilau (*shimmer*) saat data sedang dimuat.

---

# 8. Daftar Periksa Kesiapan Rilis Website Publik (*Checklist*)

- [ ] **Navigasi Global**: Seluruh tautan header dan drawer mobile berfungsi dan mengarah ke URL yang benar.
- [ ] **Beranda**: Hero section, trust bar, paket unggulan, galeri, dan testimonial tampil proporsional di mobile dan desktop.
- [ ] **Katalog Paket**: Filter kategori dinamis berfungsi memilah paket; hanya paket `published` yang ditampilkan.
- [ ] **Detail Paket**: Menampilkan harga, fasilitas (inclusions/exclusions), itinerary terstruktur, dan paket terkait yang relevan.
- [ ] **WhatsApp Contextual**: Tombol WhatsApp di detail paket membuka chat dengan teks yang memuat nama paket secara otomatis.
- [ ] **Formulir Reservasi**: Berhasil memvalidasi nama, nomor WhatsApp valid, tanggal perjalanan masa depan, dan jumlah peserta > 0.
- [ ] **Pencegahan Spam**: Tombol submit form otomatis terkunci saat pengiriman data berlangsung.
- [ ] **Privasi Data**: Tidak ada nomor kontak pelanggan atau catatan admin yang terekspos di sisi publik.
- [ ] **Halaman Kesalahan**: Halaman 404 kustom tampil dengan ramah dan menyediakan tombol navigasi kembali ke beranda.
- [ ] **SEO & Metadata**: Tag Open Graph dan meta description terisi lengkap di seluruh halaman publik.

---

# 9. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Gambaran umum identitas dan visi proyek
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) — Kebutuhan bisnis dan aturan alur data
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) — Struktur navigasi dan pohon rute URL
- [04-ui-ux-guidelines.md](file:///c:/laragon/www/pujatourtravel.com/docs/04-ui-ux-guidelines.md) — Panduan desain visual, tipografi, dan warna
- `06-admin-cms.md` — Spesifikasi dashboard admin dan manajemen konten
- `07-reservation-system.md` — Logika pemrosesan dan siklus reservasi
- `09-database.md` — Skema tabel basis data dan relasi
- `10-security.md` — Standar keamanan dan perlindungan data pribadi
