# 11 — SEO & Analytics Specifications
# Puja Tour Travel Website

> Dokumen ini mendefinisikan arsitektur optimasi mesin pencari (*Search Engine Optimization / SEO*), data terstruktur (*Schema.org / JSON-LD*), integrasi Local SEO Pangandaran, metadata media sosial (*Open Graph & Twitter Cards*), serta konfigurasi pelacakan konversi analitik (*Google Analytics 4 & UTM Tracking*) untuk Puja Tour Travel.
> Dokumen ini menjadi pedoman utama dalam membangun website yang mudah ditemukan di Google, memiliki rasio klik tinggi (*High CTR*), memantau alur konversi wisatawan, serta menjaga privasi data pengguna tanpa mengorbankan performa web (*Core Web Vitals*).

---

# 1. Prinsip Dasar & Sasaran Utama

### 1.1 Sasaran SEO (*SEO Objectives*)
- **Dapat Ditemukan (*Discoverable*)**: Mengamankan peringkat teratas pada kata kunci pencarian wisata Pangandaran (contoh: *"paket wisata green canyon"*, *"tour travel pangandaran"*).
- **Dapat Diindeks (*Indexable*)**: Struktur URL bersih, kanonikalitas yang jelas, dan peta situs XML (*sitemap.xml*) yang selalu terbarui.
- **Dapat Dipahami (*Understandable*)**: Menggunakan semantik HTML5 yang tepat dan data terstruktur JSON-LD valid.
- **Menarik Dibagikan (*Shareable*)**: Cuplikan pratinjau kaya (*rich snippet preview*) saat tautan dibagikan ke WhatsApp, Facebook, atau Twitter.
- **Terkur (*Measurable*)**: Mengukur interaksi nyata pengunjung hingga menjadi prospek pemesan (*lead capture*).

### 1.2 Piramida Prioritas SEO
```text
           ┌────────────────────────┐
           │   Conversion Tracking  │ (WhatsApp clicks, Reservasi submit)
           ├────────────────────────┤
           │   Web Analytics (GA4)  │ (Traffic source, page engagement)
           ├────────────────────────┤
           │  Structured Data JSON  │ (LocalBusiness, Tour, Breadcrumb)
           ├────────────────────────┤
           │   Local SEO Pangandaran│ (Konsistensi NAP, Google Maps)
           ├────────────────────────┤
           │   On-Page & Image SEO  │ (Meta tags, H1-H3, alt text, WebP)
           ├────────────────────────┤
           │     Technical SEO      │ (Clean URL, canonical, robots, sitemap)
           └────────────────────────┘
```

---

# 2. Arsitektur URL, Slug, & Kanonikalitas

### 2.1 Struktur URL Bersih & Ramah Pengguna
Seluruh URL publik wajib menggunakan jalur teks deskriptif (*slug-based*) yang mudah dibaca manusia dan mesin pencari:
```text
BERSIH & RAMAH SEO (DIREKOMENDASIKAN):
/
/tentang-kami
/paket-wisata
/paket-wisata/green-canyon-vip
/galeri
/testimonial
/reservasi
/kontak

TIDAK RAMAH SEO (DILARANG):
/page?id=12
/tour.php?package_id=5
/content/view/abc982
```

### 2.2 Aturan Baku Penulisan Slug (*Slug Rules*)
- Huruf kecil murni (*lowercase*), hanya menggunakan huruf, angka, dan tanda hubung pemisah (`-`).
- Tidak menggunakan karakter khusus, garis bawah (`_`), atau spasi kosong.
- Dilarang membuat slug yang terlalu panjang atau berulang (*no keyword stuffing in slugs*).
- **Kebijakan Pengalihan (*301 Redirect*)**: Jika slug paket wisata diubah melalui CMS, sistem harus mencatat riwayat dan melakukan *Permanent Redirect (301)* dari URL lama ke URL baru agar tidak memutus tautan eksternal atau backlink Google.

### 2.3 URL Kanonikal (*Canonical URL*)
Setiap halaman publik yang dapat diindeks wajib memiliki tag `<link rel="canonical" href="...">` di dalam elemen `<head>`:
```html
<link rel="canonical" href="https://pujatourtravel.com/paket-wisata/green-canyon-vip">
```
- **Aturan Pembersihan Parameter**: Parameter pelacakan kampanye pemasaran (seperti `?utm_source=instagram&utm_campaign=promo`) **dilarang** dimasukkan ke dalam URL kanonikal. Kanonikal selalu merujuk pada URL murni berprotokol HTTPS di domain produksi resmi.

---

# 3. Metadata Halaman, Judul, & Media Sosial

### 3.1 Pola Judul Halaman (*Page Title Pattern*)
Judul halaman dibatasi antara **50–60 karakter**:
- **Format Baku**: `{Nama Halaman / Paket} | Puja Tour Travel`
- **Contoh Penerapan**:
  - Beranda: `Puja Tour Travel | Paket Wisata Pangandaran Terpercaya`
  - Katalog Paket: `Paket Wisata Pangandaran | Puja Tour Travel`
  - Rincian Paket: `Green Canyon VIP Rafting | Puja Tour Travel`
  - Profil: `Tentang Kami & Legalitas | Puja Tour Travel`
  - Kontak: `Kontak & Lokasi Kantor | Puja Tour Travel Pangandaran`

### 3.2 Deskripsi Meta (*Meta Description*)
Deskripsi meta dibatasi antara **140–160 karakter**:
- Menyajikan ringkasan persuasif, alami, dan merefleksikan isi aktual halaman tanpa penumpukan kata kunci (*no keyword stuffing*).
- Beranda: *"Jelajahi keindahan Pangandaran bersama Puja Tour Travel. Layanan paket wisata Green Canyon, body rafting, dan pemandu lokal berizin resmi."*

### 3.3 Logika Fallback Metadata Otomatis
Jika administrator tidak mengisi kolom SEO kustom pada formulir editor CMS, sistem secara otomatis menghasilkan metadata cadangan (*deterministic fallback*):
```text
Custom SEO Title Kosong       ──► Fallback: {Nama Paket} | Puja Tour Travel
Custom SEO Description Kosong ──► Fallback: short_description dari paket wisata
Custom OG Image Kosong        ──► Fallback: Foto thumbnail paket wisata ──► Global OG Image
```

### 3.4 Open Graph (Facebook, WhatsApp) & Twitter Cards
Untuk memastikan pratinjau tautan (*link preview card*) tampil prima saat dibagikan calon wisatawan di aplikasi perpesanan dan media sosial:
```html
<!-- Open Graph Metadata -->
<meta property="og:site_name" content="Puja Tour Travel">
<meta property="og:type" content="website">
<meta property="og:title" content="Paket Green Canyon VIP | Puja Tour Travel">
<meta property="og:description" content="Petualangan body rafting Green Canyon eksklusif dengan pemandu bersertifikat resmi di Pangandaran.">
<meta property="og:url" content="https://pujatourtravel.com/paket-wisata/green-canyon-vip">
<meta property="og:image" content="https://pujatourtravel.com/storage/media/packages/og-green-canyon.webp">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter / X Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Paket Green Canyon VIP | Puja Tour Travel">
<meta name="twitter:description" content="Petualangan body rafting Green Canyon eksklusif dengan pemandu bersertifikat resmi.">
<meta name="twitter:image" content="https://pujatourtravel.com/storage/media/packages/og-green-canyon.webp">
```

---

# 4. Pengindeksan: Robots.txt & XML Sitemap

### 4.1 Kebijakan Pengindeksan (`/robots.txt`)
Berkas `robots.txt` diletakkan pada akar domain publik (`public/robots.txt`) untuk menginstruksikan bot mesin pencari:
```text
User-agent: *
Allow: /
Disallow: /admin/
Disallow: /admin/*
Disallow: /api/admin/
Disallow: /storage/media/private/

Sitemap: https://pujatourtravel.com/sitemap.xml
```
- **Pencegahan Fatal**: Dilarang menggunakan `Disallow: /` pada lingkungan produksi karena akan memblokir seluruh perayapan mesin pencari.

### 4.2 Larangan Indeks pada Halaman Privat (*Meta Robots Noindex*)
Halaman-halaman berikut wajib menyertakan tag `<meta name="robots" content="noindex, nofollow">`:
- Seluruh panel admin (`/admin/*`) dan halaman login staf (`/admin/login`).
- Halaman pratinjau draf (*Draft Preview*).
- Halaman galat sistem (404 Not Found, 500 Internal Server Error).
- Endpoint API internal.

### 4.3 Peta Situs XML Dinamis (`/sitemap.xml`)
Sitemap di-generate secara dinamis atau diperbarui otomatis saat status paket wisata berubah:
- **Halaman yang Masuk Sitemap**:
  - Halaman Statis Utama: `/`, `/tentang-kami`, `/paket-wisata`, `/galeri`, `/testimonial`, `/kontak`, `/reservasi`.
  - Halaman Dinamis: Seluruh URL paket wisata yang berstatus **`PUBLISHED`** (`/paket-wisata/{slug}`).
- **Pengecualian Mutlak**: Paket berstatus `DRAFT` atau `ARCHIVED`, halaman admin, dan URL pengalihan dilarang dicantumkan di sitemap.

---

# 5. Data Terstruktur (*Schema.org / JSON-LD*)

Membantu bot Google memahami entitas bisnis dan memicu tampilan *Rich Snippets* di hasil pencarian.

### 5.1 LocalBusiness Schema (Pada Beranda & Halaman Kontak)
```json
{
  "@context": "https://schema.org",
  "@type": "TravelAgency",
  "name": "Puja Tour Travel",
  "description": "Biro perjalanan wisata resmi di Pangandaran yang menyediakan paket tur Green Canyon, body rafting, dan wisata bahari.",
  "url": "https://pujatourtravel.com",
  "telephone": "+6281234567890",
  "email": "info@pujatourtravel.com",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Pantai Barat No. 12",
    "addressLocality": "Pangandaran",
    "addressRegion": "Jawa Barat",
    "postalCode": "46396",
    "addressCountry": "ID"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "-7.697500",
    "longitude": "108.652500"
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
    "opens": "07:00",
    "closes": "21:00"
  },
  "sameAs": [
    "https://www.instagram.com/puja_tourtravel/",
    "https://tiktok.com/@pujatourtravel",
    "https://facebook.com/pujatourtravel"
  ]
}
```

### 5.2 Product / TouristTrip Schema (Pada Halaman Detail Paket)
```json
{
  "@context": "https://schema.org",
  "@type": "TouristTrip",
  "name": "Paket Wisata Green Canyon VIP",
  "description": "Pengalaman body rafting menyusuri ngarai Green Canyon bersama pemandu berpengalaman.",
  "touristType": "Semua Usia",
  "offers": {
    "@type": "Offer",
    "price": "750000",
    "priceCurrency": "IDR",
    "availability": "https://schema.org/InStock",
    "url": "https://pujatourtravel.com/paket-wisata/green-canyon-vip"
  },
  "provider": {
    "@type": "TravelAgency",
    "name": "Puja Tour Travel"
  }
}
```

### 5.3 BreadcrumbList Schema (Navigasi Rute Hirarkis)
```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Beranda",
      "item": "https://pujatourtravel.com"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Paket Wisata",
      "item": "https://pujatourtravel.com/paket-wisata"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Green Canyon VIP",
      "item": "https://pujatourtravel.com/paket-wisata/green-canyon-vip"
    }
  ]
}
```

---

# 6. Local SEO Pangandaran & Konsistensi NAP

Karena Puja Tour Travel melayani pariwisata fisik di kawasan Pangandaran, otoritas pencarian lokal sangat menentukan konversi:
1. **Konsistensi NAP (*Name, Address, Phone*)**:
   - Nama Bisnis, Alamat Lengkap Fisik di Pangandaran, dan Nomor Telepon/WhatsApp resmi wajib tertulis identik di Footer website, Halaman Kontak, Google Business Profile (GBP), dan dokumen legalitas.
2. **Koordinat Peta Interaktif**:
   - Halaman kontak menyematkan peta lokasi resmi dengan titik koordinat lintang (*latitude*) dan bujur (*longitude*) riil yang terhubung ke Google Maps.
3. **Konteks Lokalitas Konten**:
   - Menuliskan entitas geografis lokal yang relevan (Batu Karas, Green Canyon, Pantai Barat, Pantai Timur, Cagar Alam Pananjung, Pasir Putih) secara organik pada narasi paket wisata.

---

# 7. On-Page SEO, Semantik HTML, & Optimasi Aset Gambar

### 7.1 Struktur Heading Semantik
- **Tepat Satu `<h1>` per Halaman**: Setiap halaman hanya memiliki satu tag `<h1>` yang menjadi judul topik utama:
  - Beranda: `<h1>Jelajahi Pesona Wisata Pangandaran Bersama Puja Tour Travel</h1>`
  - Detail Paket: `<h1>Paket Wisata Green Canyon VIP</h1>`
- Sub-bagian menggunakan `<h2>` untuk modul utama dan `<h3>` untuk kartu item tur / fasilitas.

### 7.2 Optimasi Gambar & Aksesibilitas (*Image SEO*)
- **Penamaan Berkas Bermakna**: Hindari nama berkas mentah kamera (`IMG_9041.jpg`). Gunakan nama deskriptif (`green-canyon-body-rafting-pangandaran.webp`).
- **Atribut `alt` Wajib**: Seluruh gambar informatif wajib memiliki deskripsi alternatif yang akurat dan natural (`alt="Wisatawan menikmati body rafting di jeram Green Canyon Pangandaran"`). Gambar murni dekoratif menggunakan `alt=""`.
- **Format Modern**: Konversi gambar otomatis ke format **WebP** atau **AVIF** untuk kompresi ukuran berkas maksimal tanpa menurunkan ketajaman visual.
- **Dimensi Gambar Stabil**: Selalu deklarasikan atribut `width` dan `height` atau rasio aspek CSS untuk mencegah lonjakan tata letak saat gambar dimuat (*Cumulative Layout Shift / CLS*).
- **Lazy Loading**: Gunakan atribut bawaan browser `loading="lazy"` pada gambar di bawah garis lipatan (*below the fold*). Gambar banner utama Hero di atas lipatan menggunakan `loading="eager"` demi kecepatan LCP (*Largest Contentful Paint*).

---

# 8. Arsitektur Pelacakan Analitik & Konversi (GA4)

Website menggunakan Google Analytics 4 (GA4) untuk memantau perilaku pengunjung tanpa memperlambat performa situs:

```text
Pengunjung Buka Website ──► GA4 Memuat Asinkron (Non-Blocking)
                                │
   ┌────────────────────────────┼────────────────────────────┐
   ▼                            ▼                            ▼
Event: page_view       Event: package_view          Event: whatsapp_click
   │                            │                            │
   └────────────────────────────┼────────────────────────────┘
                                ▼
                   Event: reservation_submit
                                ▼
                   Event: reservation_success (Konversi Utama)
```

### 8.1 Standar Muat Skrip Non-Blocking
- Skrip pelacakan analitik dimuat menggunakan atribut `async` atau `defer` agar tidak menghambat perenderan halaman utama (*no render-blocking*).
- Kunci ID pengukuran GA4 (`MEASUREMENT_ID`) disimpan pada konfigurasi lingkungan `.env` (`VITE_GA_MEASUREMENT_ID` atau `GA_MEASUREMENT_ID`), dilarang di-*hardcode* acak di banyak berkas.

### 8.2 Katalog Peristiwa Analitik Kustom (*Custom Event Catalog*)
| Nama Event | Parameter Aman | Momen Pemicu Pelacakan |
|---|---|---|
| `page_view` | `page_title`, `page_location` | Pengunjung memuat halaman baru. |
| `package_view` | `package_id`, `package_name`, `category_name`, `price` | Pengunjung membuka halaman detail paket wisata. |
| `whatsapp_click`| `click_location` (header, floating, package_detail) | Pengunjung menekan tombol chat WhatsApp CS. |
| `reservation_start`| `package_id`, `package_name` | Pengunjung mulai mengisi formulir reservasi. |
| `reservation_submit`| `package_id`, `pax_count` | Pengunjung menekan tombol kirim reservasi. |
| `reservation_success`| `package_id`, `booking_code` | Server mengembalikan respon sukses reservasi (Konversi Utama). |
| `contact_click` | `channel` (email, phone, maps) | Pengunjung mengklik tautan kontak atau peta. |

### 8.3 Pelacakan Kampanye Pemasaran (UTM Tracking)
Website mendukung penangkapan parameter UTM dari tautan iklan media sosial atau promosi:
- `utm_source`: Asal platform trafik (misal: `instagram`, `tiktok`, `facebook`).
- `utm_medium`: Tipe media (misal: `social`, `cpc`, `bio_link`).
- `utm_campaign`: Nama program promosi (misal: `liburan_sekolah_2026`).
- **Pemisahan Konsep**: Parameter UTM digunakan untuk analisis efektivitas kampanye pemasaran digital, sedangkan kolom `customer_sources` di database mencatat saluran relasi bisnis pelanggan.

---

# 9. Privasi Data Pengguna dalam Analitik (*Zero PII Leakage*)

- **Larangan Keras Pengiriman Data Pribadi (*No PII in Analytics*)**:
  - Dilarang mengirimkan Nama Lengkap Pemesan, Nomor WhatsApp, Alamat Email, atau Isi Catatan Khusus Wisatawan ke dalam event parameter Google Analytics.
  - Parameter hanya boleh memuat ID paket, nama paket, kategori, atau kode publik reservasi.
- **Kemandirian Aplikasi**: Jika skrip Google Analytics diblokir oleh ekstensi browser pengguna (ad-blocker) atau gagal dimuat karena gangguan jaringan, seluruh fitur website publik dan form reservasi **wajib tetap berfungsi 100% normal**.

---

# 10. Praktik Terlarang (*SEO & Analytics Anti-Patterns*)

| Praktik Terlarang (*Anti-Pattern*) | Dampak / Kerusakan | Kebijakan Standar Puja Tour Travel |
|---|---|---|
| Penumpukan Kata Kunci (*Keyword Stuffing*) | Penalti peringkat Google, teks tidak terbaca | Menulis narasi informatif, mengalir alami, dan fokus pada kenyamanan pembaca. |
| Teks / Tautan Tersembunyi (*Hidden Text / White-on-White*) | Dianggap manipulasi mesin pencari (*Black Hat*) | Seluruh teks yang dapat dibaca bot wajib terlihat jelas oleh mata manusia. |
| Ulasan Testimoni & Rating Palsu | Menipu calon wisatawan, melanggar etika & hukum | Seluruh testimoni wajib berasal dari wisatawan riil dengan kurasi admin CMS. |
| Duplikasi Deskripsi Antar Paket | Konten tipis (*Thin Content*), persaingan kanonikal internal | Setiap paket wajib memiliki keunikan fasilitas, durasi, dan itinerary. |
| Melacak Data Pribadi di Analitik | Pelanggaran regulasi privasi data (GDPR/UU PDP) | Menerapkan *Zero PII Policy* pada seluruh dimensi dan metrik kustom analitik. |

---

# 11. Daftar Periksa Kesiapan (*SEO & Analytics Acceptance Checklist*)

### 11.1 Metadata & Arsitektur Mesin Pencari
- [ ] Seluruh halaman publik memiliki `<title>` unik (50–60 karakter) dan `<meta name="description">` (140–160 karakter).
- [ ] Tag `<link rel="canonical">` terpasang di semua halaman publik tanpa parameter URL tracking.
- [ ] Tag Open Graph (`og:title`, `og:description`, `og:image`, `og:url`) dan Twitter Card aktif serta valid.
- [ ] Fallback otomatis berfungsi saat admin mengosongkan kolom SEO kustom paket.
- [ ] Halaman admin (`/admin/*`), draf, dan pratinjau terlindungi tag `noindex, nofollow`.

### 11.2 Peta Situs & Local SEO
- [ ] Berkas `/robots.txt` aktif, mengizinkan publik, dan memblokir perayapan folder `/admin/`.
- [ ] Berkas `/sitemap.xml` dinamis aktif dan hanya memuat paket wisata berstatus `PUBLISHED`.
- [ ] Data terstruktur JSON-LD `LocalBusiness`, `TouristTrip`, dan `BreadcrumbList` tervalidasi di Rich Results Test Google.
- [ ] Informasi NAP (*Name, Address, Phone*) seragam di seluruh halaman website publik.

### 11.3 Performa Web & On-Page
- [ ] Setiap halaman hanya memiliki tepat satu tag `<h1>`.
- [ ] Seluruh gambar memiliki atribut `alt` deskriptif dan dimensi `width`/`height`.
- [ ] Format gambar menggunakan WebP/AVIF dengan lazy loading pada gambar di bawah lipatan.
- [ ] LCP (*Largest Contentful Paint*) dan CLS (*Cumulative Layout Shift*) memenuhi ambang batas hijau Core Web Vitals.

### 11.4 Pelacakan Analitik & Privasi
- [ ] Google Analytics 4 dimuat secara asinkron tanpa memblokir perenderan UI.
- [ ] Pelacakan event kustom (`package_view`, `whatsapp_click`, `reservation_success`) aktif dan konsisten.
- [ ] Parameter kampanye UTM dapat ditangkap dengan benar.
- [ ] Tidak ada data pribadi wisatawan (nama, telepon, email) yang terkirim ke Google Analytics.
- [ ] Formulir reservasi tetap berjalan lancar jika ad-blocker mematikan skrip analitik.

---

# 12. Aturan Implementasi Pengembang & AI Agent

1. **Gunakan Nilai Dinamis CMS**: Ambil judul, deskripsi, dan gambar Open Graph paket wisata langsung dari database model `Package`, bukan teks hardcoded statis.
2. **Sanitasi JSON-LD**: Escape seluruh data masukan sebelum dirender ke dalam blok `<script type="application/ld+json">` untuk mencegah celah XSS.
3. **Pemisahan Sumber Analitik vs Sumber CRM**: Gunakan parameter UTM untuk platform analitik, dan simpan `source_id` baku pada tabel database untuk keperluan operasional reservasi.
4. **Pertahankan Performa Web**: Jangan memasukkan skrip analitik pihak ketiga secara berlebihan yang memperlambat skor performa Google PageSpeed.

---

# 13. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Gambaran umum bisnis dan target audiens wisatawan
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) — Arsitektur rute navigasi dan hierarki halaman website
- [05-public-website.md](file:///c:/laragon/www/pujatourtravel.com/docs/05-public-website.md) — Implementasi tampilan publik, elemen semantik HTML, dan CTA
- [06-admin-cms.md](file:///c:/laragon/www/pujatourtravel.com/docs/06-admin-cms.md) — Pengelolaan metadata SEO dan Open Graph paket pada dashboard admin
- [07-reservation-system.md](file:///c:/laragon/www/pujatourtravel.com/docs/07-reservation-system.md) — Pelacakan konversi alur reservasi dan penanganan sumber pesanan
- [09-database.md](file:///c:/laragon/www/pujatourtravel.com/docs/09-database.md) — Skema kolom `seo_title`, `seo_description`, dan `customer_sources`
- [10-security.md](file:///c:/laragon/www/pujatourtravel.com/docs/10-security.md) — Privasi data wisatawan (*PII*) dan Content Security Policy (CSP)
- `12-integration.md` — Integrasi teknis Google Analytics 4, Tag Manager, dan WhatsApp API
- `13-deployment.md` — Konfigurasi domain produksi HTTPS, caching Nginx, dan verifikasi Search Console
