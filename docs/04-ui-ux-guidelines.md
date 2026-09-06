# 04 — UI/UX Guidelines
# Puja Tour Travel Website

> Dokumen ini mendefinisikan standar desain visual, sistem antarmuka (*design system*), pengalaman pengguna (*user experience*), responsivitas *mobile-first*, serta aturan aksesibilitas untuk website Puja Tour Travel.
> Dokumen ini menjadi pedoman wajib bagi pengembang antarmuka dan AI coding agent untuk memastikan seluruh halaman konsisten, elegan, berkinerja tinggi, dan berorientasi pada konversi.

---

# 1. Tujuan Desain & Prioritas UX

### 1.1 Karakter Visual Brand (*Design Personality*)
Website Puja Tour Travel harus memancarkan karakter berikut:
- **Professional & Trustworthy**: Tata letak rapi, tipografi tertata, kredibilitas legalitas transparan, dan navigasi terstruktur.
- **Natural & Authentic**: Menonjolkan keindahan alam Pangandaran (pantai, laut, ngarai, hutan lindung, dan kearifan lokal).
- **Warm & Welcoming**: Ramah bagi wisatawan domestik maupun mancanegara melalui sudut kartu melengkung halus (*rounded corners*), foto hangat, dan bahasa yang komunikatif.
- **Premium Yet Accessible**: Menghadirkan kesan elegan pada paket eksklusif tanpa menghilangkan nilai kerakyatan dan keaslian destinasi lokal.
- **Fast & Effortless**: Pemuatan halaman instan, tanpa lag animasi berlebihan, dan alur pemesanan tanpa hambatan (*zero friction*).

### 1.2 Hirarki Prioritas UX
```text
1. Clarity (Kejelasan informasi harga, jadwal, & fasilitas)
      ▼
2. Usability (Kemudahan navigasi & pengisian formulir)
      ▼
3. Trust (Legalitas resmi, pemandu tersertifikasi, testimoni riil)
      ▼
4. Conversion (Titik aksi reservasi & tombol WhatsApp yang jelas)
      ▼
5. Visual Appeal (Estetika visual modern yang mendukung fungsi)
```
> **Prinsip Utama**: Estetika visual tidak boleh mengorbankan keterbacaan, performa, atau kemudahan penggunaan.

---

# 2. Arah Visual (*Visual Direction*)

Gunakan pendekatan: **Modern Tourism + Editorial Photography + Clean Layout + Natural Elements**.

### Hindari Gaya Visual Berikut (*Anti-Patterns*):
- ✕ *Overly Corporate*: Terlalu kaku seperti portal perbankan atau korporasi multinasional.
- ✕ *Overly Futuristic / Gaming*: Menggunakan warna neon mencolok, *cyberpunk*, atau tema gelap menyeluruh (*all-dark mode*).
- ✕ *Generic AI Template*: Latar belakang gradasi ungu/biru generik, kartu melayang seragam yang membosankan, dan ikon acak tanpa makna.
- ✕ *Excessive Glassmorphism*: Efek kaca buram berlebihan yang menurunkan kontras keterbacaan teks.

---

# 3. Sistem Desain & Token Warna (*Color System*)

Sistem warna dirancang fleksibel agar mudah diselaraskan saat aset logo dan *brand guideline* final ditetapkan oleh pihak manajemen.

### 3.1 Palet Warna Alam Pangandaran (Rekomendasi Utama)
| Token Warna | Peran Antarmuka | Contoh Nuansa | Penggunaan Spesifik |
|---|---|---|---|
| **Primary** | Aksen utama & identitas brand | *Deep Emerald Green* / *Ocean Teal* | Tombol aksi utama (CTA), status aktif navigasi, tautan penting. |
| **Secondary** | Pendukung & variasi visual | *Coastal Blue* / *Fresh Mint* | Badge kategori, banner promosi pendukung, elemen sekunder. |
| **Accent** | Aksen penarik perhatian | *Warm Sand* / *Golden Sunset* | Rating bintang, sorotan harga khusus, kartu promo terbatas. |
| **Neutral (Light)** | Latar belakang halaman | *Pure White* (`#FFFFFF`) / *Soft Cream* (`#F9FAFB`) | Background utama halaman, kartu konten, modal popup. |
| **Neutral (Dark)** | Tipografi & kontras | *Charcoal* (`#111827`) / *Deep Slate* (`#1F2937`) | Heading teks, body text, footer background. |
| **Status (Success)** | Konfirmasi sukses | *Emerald Green* (`#10B981`) | Pesan reservasi terkirim, tombol WhatsApp. |
| **Status (Warning)** | Perhatian & peringatan | *Amber / Gold* (`#F59E0B`) | Slot paket terbatas, peringatan form belum lengkap. |
| **Status (Danger)** | Kesalahan & pembatalan | *Rose Red* (`#EF4444`) | Pesan error validasi, status pemesanan dibatalkan. |

### 3.2 Aturan Kontras & Keterbacaan (WCAG 2.1 AA)
- Teks utama wajib memiliki rasio kontras minimal **4.5:1** terhadap latar belakang.
- Dilarang keras menggunakan teks abu-abu terang (*light gray*) di atas latar belakang putih.
- Bagian berlatar gelap (*dark section*) hanya digunakan secara selektif pada Hero banner, Banner CTA penutup, dan Footer.

---

# 4. Tipografi (*Typography System*)

Gunakan maksimal 2 rumpun font modern (atau 1 *superfamily* berkualitas tinggi seperti Inter, Outfit, atau Plus Jakarta Sans):
- **Heading / Display**: Font ramah bertema modern yang tegas namun hangat.
- **Body / Interface**: Font sans-serif yang sangat nyaman dibaca pada layar kecil ponsel.

### 4.1 Skala Tipografi Responsif
| Tingkatan | Ukuran Desktop | Ukuran Tablet | Ukuran Mobile | Line Height | Font Weight |
|---|---|---|---|---|---|
| **Display** | 56–64 px | 44–48 px | 36–40 px | 1.1 – 1.2 | Bold (700) |
| **Heading 1 (H1)** | 40–48 px | 34–38 px | 28–32 px | 1.2 | Bold (700) |
| **Heading 2 (H2)** | 32–36 px | 28–30 px | 24–26 px | 1.25 | Semibold / Bold |
| **Heading 3 (H3)** | 24–28 px | 22–24 px | 20–22 px | 1.3 | Semibold (600) |
| **Heading 4 (H4)** | 20–22 px | 18–20 px | 18 px | 1.35 | Medium / Semibold |
| **Body Large** | 18 px | 17 px | 16 px | 1.6 | Regular (400) |
| **Body (Default)**| 16 px | 16 px | 15–16 px | 1.5 – 1.7 | Regular (400) |
| **Body Small** | 14 px | 14 px | 13–14 px | 1.5 | Regular / Medium |
| **Caption** | 12–13 px | 12 px | 12 px | 1.4 | Medium (500) |

> **Catatan Responsif**: Judul besar (H1) pada layar mobile smartphone wajib mengecil secara proporsional agar tidak mendominasi layar secara berlebihan.

---

# 5. Tata Letak, Grid, & Sistem Spasi

### 5.1 Lebar Maksimal Kontainer (*Max-Width*)
- **Desktop Standar**: `1200 px` – `1280 px` (Tengah / *mx-auto*).
- **Large Desktop**: Maksimal `1320 px`.
- **Padding Horizontal Kontainer**:
  - Desktop: `24 px` – `40 px`
  - Tablet: `20 px` – `32 px`
  - Mobile: `16 px` – `20 px` (Bebas dari luapan horizontal / *zero overflow-x*).

### 5.2 Sistem Kolom Grid Responsif
| Komponen Konten | Desktop (≥ 1024px) | Tablet (768px - 1023px) | Mobile (< 768px) |
|---|---|---|---|
| **Katalog Paket Wisata** | 3 Kolom | 2 Kolom | 1 Kolom |
| **Elemen Kepercayaan (Trust)**| 4 Kolom | 2 Kolom | 2 Kolom / 1 Kolom |
| **Galeri Dokumentasi** | 3–4 Kolom | 2–3 Kolom | 2 Kolom (Grid) |
| **Ulasan Testimonial** | 3 Kolom | 2 Kolom / Slider | 1 Kolom / Slider |
| **Formulir Reservasi** | 2 Kolom (Data Diri & Trip) | 1 Kolom | 1 Kolom |

### 5.3 Skala Jarak Antar-Section (*Vertical Spacing*)
- **Desktop**: `80 px` – `112 px`
- **Tablet**: `64 px` – `80 px`
- **Mobile**: `48 px` – `64 px`
- **Skala Spasi Komponen**: Gunakan kelipatan 4/8 (`4, 8, 12, 16, 20, 24, 32, 40, 48, 64 px`). Hindari nilai angka acak seperti 17px atau 29px.

---

# 6. Spesifikasi Komponen Desain (*Component System*)

### 6.1 Sudut Melengkung (*Border Radius*)
- **Small (Tag, Badge, Button Kecil)**: `8 px`
- **Medium (Input Formulir, Tombol Default)**: `10 px` – `12 px`
- **Large / Card (Kartu Paket, Panel Modal)**: `16 px` – `20 px`
- **Pill (Badge Kategori, Kapsul Filter)**: `9999 px` (*full-rounded*)

### 6.2 Kartu Paket Wisata (*Package Card*)
- **Rasio Gambar Sampul**: Wajib konsisten **4:3** atau **16:10** dengan `object-fit: cover`.
- **Struktur Kartu**:
  ```text
  ┌─────────────────────────────────────────┐
  │ [Foto Sampul 16:10]   [Badge Kategori]  │
  ├─────────────────────────────────────────┤
  │ Durasi: 2H1M          Lokasi: Pangandaran│
  │ Judul Paket Wisata                      │
  │ Deskripsi singkat paket...              │
  ├─────────────────────────────────────────┤
  │ Mulai dari:                             │
  │ Rp 750.000 / pax        [Lihat Detail]  │
  └─────────────────────────────────────────┘
  ```
- **Interaksi Hover**: Elevasi bayangan halus (*subtle shadow md*) dan sedikit pembesaran gambar (*scale 1.03* dengan durasi 300ms). Dilarang rotasi atau gerakan ekstrem.

### 6.3 Sistem Bayangan (*Elevation & Shadows*)
Gunakan efek bayangan lembut alami, bukan bayangan hitam pekat:
- **Shadow SM**: Kartu default, input teks saat fokus.
- **Shadow MD**: Kartu paket saat di-hover, navigasi sticky.
- **Shadow LG / XL**: Modal popup, drawer mobile, floating WhatsApp button.

### 6.4 Ikonografi (*Icons*)
- Gunakan satu pustaka ikon tunggal yang seragam (rekomendasi: **Lucide Icons** atau **Heroicons**).
- Ketebalan garis (*stroke width*) konsisten (1.5px atau 2px).
- Tombol yang hanya berisi ikon wajib dilengkapi atribut aksesibilitas `aria-label` (contoh: `<button aria-label="Tutup menu">`).

---

# 7. Elemen Interaktif, Tombol, & Formulir

### 7.1 Hirarki Tombol Aksi (*CTA Hierarchy*)
```text
[PRIMARY BUTTON]    : Warna solid kontras (misal: Emerald Green), teks tebal, untuk aksi utama.
[SECONDARY BUTTON]  : Garis tepi (outline) atau latar lembut, untuk aksi alternatif.
[TERTIARY / TEXT]   : Teks bergaris bawah halus atau panah (→), untuk navigasi ringan.
```
- **Area Sentuh Ponsel (*Touch Target*)**: Tinggi tombol minimal **44 px** agar nyaman ditekan oleh jari tangan.
- **Status Tombol Wajib**: `Default`, `Hover`, `Focus-visible` (cincin fokus kontras), `Active`, `Disabled`, dan `Loading` (indikator spinner dan teks berubah "Memproses...").

### 7.2 Formulir Reservasi & Validasi Input
1. **Label Selalu Terlihat**: Setiap field input wajib memiliki elemen `<label>` yang jelas. Dilarang hanya mengandalkan teks placeholder di dalam kotak.
2. **Penanda Field Wajib**: Kolom wajib ditandai bintang merah dengan petunjuk konteks (`* Wajib diisi`).
3. **Pesan Validasi Kontekstual**: Tampilkan pesan galat tepat di bawah kolom input terkait dengan bahasa yang ramah (contoh: *"Silakan masukkan nomor WhatsApp aktif yang diawali 08..."*).
4. **Pencegahan Klik Ganda**: Tombol submit otomatis terkunci (*disabled*) selama proses pengiriman berlangsung.

---

# 8. Fotografi, Media, & Panduan Visual

### 8.1 Standar Fotografi Autentik
- Prioritaskan foto riil aktivitas wisatawan di Pangandaran (keaslian air Green Canyon, aktivitas perahu, pantai matahari terbenam).
- Hindari stok foto generik internasional yang tidak mencerminkan lanskap khas Pangandaran.
- Gambar wajib dioptimalkan ke format modern (**WebP** / **AVIF**) dengan pemuatan bertahap (*lazy loading*).

### 8.2 Komposisi Hero Banner
- Jika teks judul berada di atas foto pemandangan, wajib menggunakan lapisan peredup halus (*dark gradient overlay / scrim*) agar teks tetap terbaca tajam tanpa mengaburkan keindahan foto.

---

# 9. Animasi & Interaksi Mikro (*Motion System*)

Animasi digunakan secara hemat untuk memberikan umpan balik (*feedback*), orientasi ruang, dan kesan profesional:
- **Durasi Mikro**: `150 ms` – `200 ms` (hover tombol, transisi warna tautan).
- **Durasi Transisi Sedang**: `250 ms` – `300 ms` (pembukaan dropdown, modal dialog, kartu terangkat).
- **Durasi Halaman / Drawer**: `300 ms` – `400 ms` (slide masuk drawer mobile).
- **Peredam Gerakan (*Reduced Motion*)**: Hormati pengaturan sistem pengguna `prefers-reduced-motion: reduce` dengan mematikan efek parallax dan animasi pergeseran.

---

# 10. Pengalaman Pengguna Ponsel (*Mobile-First Experience*)

Mengingat sebagian besar wisatawan mengakses website melalui smartphone:
1. **Tanpa Geser Samping (*Zero Horizontal Scroll*)**: Dilarang ada elemen yang meluap keluar batas layar (`overflow-x: hidden`).
2. **Sticky Bottom Bar (Detail Paket)**: Pada halaman detail paket di layar ponsel, sediakan bilah aksi menempel di bagian bawah layar yang memuat harga ringkas dan tombol pemesanan cepat.
3. **Navigasi Drawer Ringan**: Menu hamburger terbuka cepat, teks berjarak nyaman untuk jempol, dan tombol tutup (✕) mudah dijangkau.
4. **Floating WhatsApp Aman**: Posisi tombol WhatsApp diatur dengan jarak aman (*safe margin*) agar tidak menutupi tombol formulir penting.

---

# 11. Perbedaan Desain Public Website vs Admin CMS

| Aspek Desain | Public Website | Admin CMS Dashboard |
|---|---|---|
| **Tujuan Utama** | Inspirasi wisata, membangun kepercayaan, & konversi reservasi | Kecepatan kerja, kejelasan data, efisiensi kelola konten |
| **Gaya Visual** | Visual emosional, kaya foto destinasi, layout dinamis | Bersih, berbasis kartu data, tabel padat rapi |
| **Fokus Elemen** | Banner besar, kartu paket, ulasan, galeri foto | Tabel data, filter status, form editor, tombol aksi cepat |
| **Animasi** | Transisi lembut, efek hover, lightbox galeri | Minimalis instan, tanpa animasi dekoratif |

---

# 12. Aksesibilitas Web (*Web Accessibility Standards*)

- **Struktur Heading Tunggal**: Setiap halaman hanya memiliki satu tag `<h1>` yang mewakili judul utama halaman.
- **Navigasi Keyboard Penuh**: Seluruh tombol, formulir, dan tautan dapat dijelajahi menggunakan tombol `Tab` dan diaktifkan dengan tombol `Enter`/`Space`.
- **Indikator Fokus Visual**: Jangan pernah mematikan `outline: none` tanpa menggantinya dengan ring fokus kustom yang kontras.
- **Deskripsi Gambar Alternatif**: Semua foto konten memiliki atribut `alt` deskriptif (contoh: `alt="Wisatawan melakukan body rafting di Green Canyon Pangandaran"`).

---

# 13. Daftar Periksa Kesiapan UI/UX (*Checklists*)

### 13.1 Visual & Layout Checklist
- [ ] Tipografi konsisten mengikuti skala hirarki font yang ditentukan.
- [ ] Warna teks dan tombol memenuhi standar kontras keterbacaan WCAG AA.
- [ ] Spasi antar-section dan padding kontainer konsisten di semua resolusi.
- [ ] Seluruh kartu paket memiliki rasio gambar sampul yang seragam.

### 13.2 Responsif & Mobile Checklist
- [ ] Desain diuji pada layar ponsel 360px – 414px tanpa luapan horizontal.
- [ ] Seluruh tombol dan area interaktif memiliki ukuran sentuh minimal 44x44px.
- [ ] Menu hamburger mobile berfungsi mulus dan mudah ditutup.
- [ ] Tombol melayang WhatsApp tidak menutupi tombol aksi atau konten penting.

### 13.3 Feedback & State Checklist
- [ ] Tampilan pemuatan (*skeleton loading*) aktif saat data dinamis dimuat.
- [ ] Pesan ramah (*empty state*) muncul jika data paket/galeri kosong.
- [ ] Tampilan error tidak mengekspos galat teknis kode ke pengguna umum.
- [ ] Konfirmasi sukses pemesanan reservasi memberikan instruksi langkah berikutnya yang jelas.

---

# 14. Aturan Implementasi untuk AI Coding Agent

1. **Gunakan Utility Classes Terstruktur**: Manfaatkan utility class Tailwind CSS yang telah terpasang di proyek secara konsisten.
2. **Jangan Mengarang Gaya Baru**: Selalu gunakan token warna, ukuran font, dan border radius yang sudah didefinisikan dalam dokumen ini.
3. **Komponen Reusable**: Buat komponen terpusat untuk elemen berulang seperti `PackageCard`, `PrimaryButton`, `SectionHeader`, dan `BadgeStatus`.
4. **Validasi Mobile**: Selalu uji kode antarmuka pada tampilan mobile sebelum menyatakan fitur selesai.

---

# 15. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Identitas bisnis dan tujuan umum proyek
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) — Kebutuhan bisnis, aturan data, dan siklus reservasi
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) — Struktur navigasi halaman publik dan admin
- `05-public-website.md` — Spesifikasi teknis implementasi halaman publik
- `06-admin-cms.md` — Desain antarmuka dan alur modul admin CMS
- `07-reservation-system.md` — Logika pemrosesan reservasi
- `09-database.md` — Struktur basis data dan relasi tabel
- `10-security.md` — Standar keamanan dan privasi data
