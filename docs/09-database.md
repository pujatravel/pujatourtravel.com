# 09 — Database Specifications
# Puja Tour Travel Website

> Dokumen ini mendefinisikan arsitektur basis data relasional (*RDBMS*), skema tabel, kamus data (*data dictionary*), relasi antar entitas (*ERD*), indeks performa, aturan integritas referensial, urutan migrasi Laravel, serta protokol pencadangan dan pemulihan untuk sistem Puja Tour Travel.
> Dokumen ini menjadi sumber acuan utama (*Single Source of Truth*) bagi pengembang dan AI Agent dalam menulis migrasi Laravel, model Eloquent, relasi foreign key, validasi data, serta optimasi kueri.

---

# 1. Prinsip Perancangan & Integritas Basis Data

### 1.1 Filosofi Relasional & Skalabilitas Pragmatis
Basis data Puja Tour Travel dirancang menggunakan MySQL 8.x dengan prinsip:
- **Relasional Murni**: Menghubungkan entitas melalui *Foreign Keys* yang terisolasi dan terlindungi.
- **Normalisasi Tepat Guna (3NF)**: Menghilangkan redundansi data tanpa membuat struktur tabel menjadi *over-engineered*.
- **Sumber Kebenaran Tunggal (*Single Source of Truth*)**: Seluruh konten dinamis website publik, katalog paket wisata, media gambar, transaksi reservasi, dan profil pelanggan dikelola tersentralisasi pada basis data.

```text
[ADMIN CMS] ──► Ubah Data di Database ──► [BACKEND API] ──► Ditampilkan di [PUBLIC WEBSITE]
```

### 1.2 Strategi Kunci Primer (*Primary Key*) & Kode Acuan Publik
1. **Internal Primary Key**: Seluruh tabel menggunakan tipe data numerik `BIGINT UNSIGNED AUTO_INCREMENT` (`$table->id()` di Laravel) untuk performa indeks join internal tercepat.
2. **Public Unique Code**: Entitas transaksi dan pelanggan memiliki kode unik publik terpisah yang mudah dibaca manusia:
   - Reservasi: `RES-YYYY-XXXXXX` (misal: `RES-2026-000152`).
   - Pelanggan: `CUS-YYYY-XXXXXX` (misal: `CUS-2026-000084`).
   - Kode publik digunakan pada URL, pesan WhatsApp, invoice, dan pencarian admin, sementara relasi database internal tetap menggunakan `id`.

### 1.3 Kebijakan Waktu (*Timestamp*), Timezone, & Soft Deletes
- **Timezone Baku**: Seluruh operasi waktu aplikasi dan database menggunakan zona waktu lokal operasional: **`Asia/Jakarta` (WIB / UTC+7)**.
- **Standar Tanggal**:
  - Kolom riwayat audit: Tipe `TIMESTAMP` (`created_at`, `updated_at`).
  - Tanggal perjalanan wisata: Tipe `DATE` murni (`travel_date`), tanpa komponen jam.
- **Kebijakan Soft Deletes**: Digunakan pada tabel master yang memiliki relasi historis transaksi (`packages`, `customers`, `media`, `testimonials`, `tour_guides`) menggunakan `$table->softDeletes()` (`deleted_at`).

---

# 2. Diagram Hubungan Entitas (ERD) & Relasi Data

### 2.1 Arsitektur Relasional Menyeluruh
```text
┌────────────────────────┐
│         users          │
└───────────┬────────────┘
            │ (manages)
            ▼
┌────────────────────────┐
│     package_           │
│     categories         │
└───────────┬────────────┘
            │ 1:N
            ▼
┌────────────────────────┐         ┌────────────────────────┐
│        packages        │────────►│         media          │
└─────┬────────┬───┬─────┘         └───────────▲────────────┘
      │ 1:N    │   │ 1:N                       │
      │        │   └────────► package_         │ (references
      │        │              exclusions       │  media_id)
      │        ▼                               │
      │   package_facilities                   │
      ▼                                        │
package_itineraries                            │
                                               │
┌────────────────────────┐                     │
│    customer_sources    │                     │
└─────┬──────────────┬───┘                     │
      │ 1:N          │                         │
      ▼              │                         │
┌──────────────┐     │                         │
│  customers   │     │                         │
└─────┬────────┘     │                         │
      │ 1:N          │ 1:N                     │
      ▼              ▼                         │
┌────────────────────────┐                     │
│      reservations      │                     │
└───────────┬────────────┘                     │
            │ 1:N                              │
            ▼                                  │
┌────────────────────────┐                     │
│  reservation_status_   │                     │
│        history         │                     │
└────────────────────────┘                     │
                                               │
┌──────────────────────────────────────────────┴──────────────┐
│ KONTEN STATIS / CMS LAINNYA:                                │
│ galleries, testimonials, tour_guides, legal_documents,      │
│ website_settings, homepage_content, trust_items             │
└─────────────────────────────────────────────────────────────┘
```

---

# 3. Spesifikasi Skema Tabel & Kamus Data (*Data Dictionary*)

### 3.1 Otentikasi & Pengguna Admin
#### Tabel: `users`
Menyimpan akun staf dan administrator internal pengelola sistem.
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `name` | Varchar(100) | No | - | Nama lengkap staf admin. |
| `email` | Varchar(100) | No | - | Email login, berindeks **UNIQUE**. |
| `password` | Varchar(255) | No | - | Password ter-hash (Bcrypt/Argon2). |
| `role` | Varchar(30) | No | `'admin'` | Hak akses (`admin`, `super_admin`). |
| `is_active` | Boolean | No | `true` | Menonaktifkan akun tanpa menghapus data. |
| `remember_token`| Varchar(100) | Yes | Null | Token sesi login Laravel. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |

---

### 3.2 Modul Paket Wisata
#### Tabel: `package_categories`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `name` | Varchar(50) | No | - | Nama kategori (Eksklusif, Edukasi, Budaya). |
| `slug` | Varchar(60) | No | - | URL slug, **UNIQUE**. |
| `description` | Text | Yes | Null | Penjelasan singkat kategori. |
| `display_order`| Integer | No | `0` | Urutan penayangan di navigasi. |
| `is_active` | Boolean | No | `true` | Status aktif kategori. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |

#### Tabel: `packages`
Tabel master katalog paket wisata Pangandaran.
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `category_id` | Bigint unsigned | No | - | Foreign Key ke `package_categories.id`. |
| `name` | Varchar(150) | No | - | Nama paket wisata (contoh: Green Canyon VIP). |
| `slug` | Varchar(160) | No | - | Slug SEO publik, **UNIQUE**. |
| `short_description` | Text | Yes | Null | Cuplikan singkat kartu beranda (2-3 kalimat). |
| `description` | Longtext | Yes | Null | Ulasan lengkap pengalaman tur. |
| `price` | Decimal(15,2) | No | - | Nilai nominal angka murni tanpa simbol. |
| `currency` | Varchar(10) | No | `'IDR'` | Satuan mata uang. |
| `price_unit` | Varchar(30) | No | `'pax'` | Satuan pemesanan (pax, orang, rombongan). |
| `duration` | Varchar(50) | No | - | Label durasi (misal: "1 Hari", "2H1M"). |
| `location` | Varchar(150) | No | - | Lokasi utama (misal: Green Canyon, Batu Karas). |
| `thumbnail_media_id`| Bigint unsigned | Yes | Null | Foreign Key ke `media.id` (Foto sampul). |
| `featured` | Boolean | No | `false` | Tampil di section rekomendasi Beranda. |
| `status` | Enum | No | `'DRAFT'` | Pilihan: `DRAFT`, `PUBLISHED`, `ARCHIVED`. |
| `seo_title` | Varchar(150) | Yes | Null | Judul kustom mesin pencari. |
| `seo_description` | Text | Yes | Null | Deskripsi meta pencarian. |
| `og_media_id` | Bigint unsigned | Yes | Null | Foreign Key ke `media.id` untuk Open Graph banner. |
| `published_at` | Timestamp | Yes | Null | Waktu penayangan publik. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |
| `deleted_at` | Timestamp | Yes | Null | Soft delete timestamp. |

#### Tabel: `package_facilities` (Fasilitas Termasuk / Inclusions)
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `package_id` | Bigint unsigned | No | - | Foreign Key ke `packages.id` (ON DELETE CASCADE). |
| `name` | Varchar(150) | No | - | Item fasilitas (misal: "Pemandu Rafting Bersertifikat"). |
| `description` | Text | Yes | Null | Keterangan tambahan (opsional). |
| `display_order`| Integer | No | `0` | Urutan penayangan. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |

#### Tabel: `package_exclusions` (Tidak Termasuk / Exclusions)
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `package_id` | Bigint unsigned | No | - | Foreign Key ke `packages.id` (ON DELETE CASCADE). |
| `name` | Varchar(150) | No | - | Item yang tidak didapat (misal: "Pengeluaran Pribadi"). |
| `description` | Text | Yes | Null | Keterangan tambahan (opsional). |
| `display_order`| Integer | No | `0` | Urutan penayangan. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |

#### Tabel: `package_itineraries` (Susunan Jadwal Tur)
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `package_id` | Bigint unsigned | No | - | Foreign Key ke `packages.id` (ON DELETE CASCADE). |
| `time` | Varchar(20) | No | - | Slot jam (misal: "08:00", "09:30 - 12:00"). |
| `title` | Varchar(150) | No | - | Judul aktivitas (misal: "Aktivitas Body Rafting"). |
| `description` | Text | Yes | Null | Ulasan aktivitas. |
| `location` | Varchar(150) | Yes | Null | Titik lokasi spesifik. |
| `display_order`| Integer | No | `0` | Urutan alur jadwal perjalanan. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |

---

### 3.3 Modul Media & Galeri
#### Tabel: `media`
Perpustakaan aset digital terpusat (*Central Media Library*).
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `filename` | Varchar(255) | No | - | Nama berkas tersimpan di storage (disanitasi). |
| `original_filename`| Varchar(255) | No | - | Nama asli berkas saat diunggah klien. |
| `mime_type` | Varchar(100) | No | - | Tipe konten (`image/webp`, `image/jpeg`, `application/pdf`). |
| `file_size` | Bigint unsigned | No | - | Ukuran berkas dalam bytes. |
| `storage_path` | Varchar(255) | No | - | Lokasi penyimpanan lokal/S3 (`media/packages/...`). |
| `alt_text` | Varchar(255) | Yes | Null | Teks deskripsi aksesibilitas & SEO. |
| `title` | Varchar(150) | Yes | Null | Judul atau label berkas. |
| `media_type` | Enum | No | `'IMAGE'` | Pilihan: `IMAGE`, `DOCUMENT`, `VIDEO`. |
| `uploaded_by` | Bigint unsigned | Yes | Null | Foreign Key ke `users.id` (staf pengunggah). |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |
| `deleted_at` | Timestamp | Yes | Null | Soft delete timestamp. |

#### Tabel: `galleries`
Dokumentasi visual perjalanan di Pangandaran.
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `media_id` | Bigint unsigned | No | - | Foreign Key ke `media.id`. |
| `title` | Varchar(150) | No | - | Judul foto dokumentasi. |
| `description` | Text | Yes | Null | Cerita singkat foto. |
| `category` | Varchar(50) | No | - | Kategori (Alam, Rafting, Budaya, Kuliner). |
| `featured` | Boolean | No | `false` | Tayang di grid pilihan Beranda. |
| `display_order`| Integer | No | `0` | Urutan penayangan. |
| `status` | Enum | No | `'PUBLISHED'`| Pilihan: `DRAFT`, `PUBLISHED`, `ARCHIVED`. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |
| `deleted_at` | Timestamp | Yes | Null | Soft delete timestamp. |

---

### 3.4 Modul Bukti Sosial & Pemandu Wisata
#### Tabel: `testimonials`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `customer_name`| Varchar(100) | No | - | Nama pemesan yang tertera di kartu testimoni. |
| `customer_photo_media_id`| Bigint unsigned | Yes | Null | Foreign Key ke `media.id` (Foto profil). |
| `package_id` | Bigint unsigned | Yes | Null | Foreign Key ke `packages.id` (Paket yang diulas). |
| `testimonial` | Text | No | - | Isi ulasan pengalaman perjalanan. |
| `rating` | Tinyint unsigned| No | `5` | Nilai kepuasan (skala 1 s.d. 5). |
| `testimonial_date`| Date | Yes | Null | Tanggal ulasan diterima. |
| `featured` | Boolean | No | `false` | Ditampilkan di carousel beranda. |
| `status` | Enum | No | `'PUBLISHED'`| Pilihan: `DRAFT`, `PUBLISHED`, `ARCHIVED`. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |
| `deleted_at` | Timestamp | Yes | Null | Soft delete timestamp. |

#### Tabel: `tour_guides`
Profil pemandu wisata resmi bersertifikasi.
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `name` | Varchar(100) | No | - | Nama lengkap pemandu. |
| `photo_media_id`| Bigint unsigned | Yes | Null | Foreign Key ke `media.id` (Foto berseragam). |
| `short_bio` | Text | Yes | Null | Profil singkat & kepribadian. |
| `experience` | Varchar(50) | No | - | Lama jam terbang (misal: "8+ Tahun"). |
| `certification`| Varchar(150) | No | - | Sertifikasi resmi pemandu wisata (HPI/BNSP). |
| `specialization`| Varchar(100) | Yes | Null | Keahlian khusus (Body Rafting, Wisata Budaya). |
| `display_order`| Integer | No | `0` | Urutan penayangan kartu. |
| `status` | Enum | No | `'PUBLISHED'`| Pilihan: `DRAFT`, `PUBLISHED`, `ARCHIVED`. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |
| `deleted_at` | Timestamp | Yes | Null | Soft delete timestamp. |

#### Tabel: `legal_documents`
Transparansi badan hukum perseroan komanditer (CV).
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `name` | Varchar(150) | No | - | Nama dokumen (misal: "NIB Usaha Wisata"). |
| `document_type`| Varchar(50) | No | - | Tipe: `BUSINESS_LICENSE`, `CERTIFICATE`, dsb. |
| `description` | Text | Yes | Null | Penjelasan peruntukan izin. |
| `media_id` | Bigint unsigned | No | - | Foreign Key ke `media.id` (File PDF / Gambar). |
| `display_order`| Integer | No | `0` | Urutan tampilan kartu legalitas. |
| `status` | Enum | No | `'PUBLISHED'`| Pilihan: `DRAFT`, `PUBLISHED`, `ARCHIVED`. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |
| `deleted_at` | Timestamp | Yes | Null | Soft delete timestamp. |

---

### 3.5 Modul Pelanggan & Reservasi Transaksional
#### Tabel: `customer_sources`
Katalog saluran pemasaran & perolehan pelanggan.
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `name` | Varchar(50) | No | - | Nama saluran (Website, Instagram, TikTok, WA). |
| `slug` | Varchar(60) | No | - | Slug saluran, **UNIQUE**. |
| `description` | Text | Yes | Null | Keterangan saluran akuisisi. |
| `display_order`| Integer | No | `0` | Urutan dropdown. |
| `is_active` | Boolean | No | `true` | Status aktif saluran. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |

#### Tabel: `customers`
Master data pelanggan wisatawan (*CRM Lite*).
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `customer_code`| Varchar(30) | No | - | Kode unik pelanggan (`CUS-YYYY-XXXXXX`), **UNIQUE**. |
| `name` | Varchar(100) | No | - | Nama lengkap wisatawan. |
| `phone` | Varchar(25) | No | - | Nomor kontak input asli pengguna. |
| `normalized_phone`| Varchar(25) | No | - | Nomor dinormalisasi (`628xxx`), **INDEX**. |
| `email` | Varchar(100) | Yes | Null | Alamat surel wisatawan. |
| `source_id` | Bigint unsigned | No | - | Foreign Key ke `customer_sources.id`. |
| `preferred_contact_channel`| Enum | Yes | `'WHATSAPP'`| Pilihan: `WHATSAPP`, `PHONE`, `EMAIL`. |
| `notes` | Text | Yes | Null | Catatan internal privat staf admin. |
| `is_active` | Boolean | No | `true` | Status aktifitas customer. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |
| `deleted_at` | Timestamp | Yes | Null | Soft delete timestamp. |

#### Tabel: `reservations`
Pusat catatan permintaan perjalanan (*Structured Inquiries*).
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `reservation_code`| Varchar(30) | No | - | Kode unik publik (`RES-YYYY-XXXXXX`), **UNIQUE**. |
| `customer_id` | Bigint unsigned | No | - | Foreign Key ke `customers.id` (RESTRICT on delete). |
| `package_id` | Bigint unsigned | No | - | Foreign Key ke `packages.id` (RESTRICT on delete). |
| `source_id` | Bigint unsigned | No | - | Foreign Key ke `customer_sources.id`. |
| `travel_date` | Date | No | - | Tanggal rencana trip (`travel_date >= today`). |
| `participant_count`| Integer | No | `1` | Jumlah peserta tur (CHECK: `> 0`). |
| `status` | Enum | No | `'PENDING'` | `PENDING`, `PROCESSING`, `CONFIRMED`, `COMPLETED`, `CANCELLED`. |
| `booking_price`| Decimal(15,2) | Yes | Null | Snapshot harga mengikat saat booking disepakati. |
| `currency` | Varchar(10) | No | `'IDR'` | Satuan mata uang. |
| `custom_itinerary`| Text | Yes | Null | Permintaan destinasi kustom pemesan. |
| `customer_message`| Text | Yes | Null | Catatan kebutuhan khusus (makanan, jemput). |
| `admin_notes` | Text | Yes | Null | Catatan internal operasional staf admin. |
| `confirmed_at` | Timestamp | Yes | Null | Waktu status diubah ke CONFIRMED. |
| `completed_at` | Timestamp | Yes | Null | Waktu status diubah ke COMPLETED. |
| `cancelled_at` | Timestamp | Yes | Null | Waktu pembatalan reservasi. |
| `cancellation_reason`| Text | Yes | Null | Alasan resmi jika reservasi dibatalkan. |
| `created_at` / `updated_at` | Timestamp | Yes | Null | Audit timestamp. |

#### Tabel: `reservation_status_history`
Jejak audit operasional (*Audit Trail*) perubahan status reservasi.
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan & Aturan |
|---|---|---|---|---|
| `id` | Bigint unsigned | No | Auto | Primary Key. |
| `reservation_id`| Bigint unsigned | No | - | Foreign Key ke `reservations.id` (ON DELETE CASCADE). |
| `old_status` | Varchar(30) | Yes | Null | Status sebelum perubahan. |
| `new_status` | Varchar(30) | No | - | Status setelah pembaruan. |
| `changed_by` | Bigint unsigned | Yes | Null | Foreign Key ke `users.id` (Staf pengubah). |
| `note` | Text | Yes | Null | Catatan justifikasi transisi status. |
| `created_at` | Timestamp | No | Auto | Waktu pencatatan perubahan. |

---

### 3.6 Modul CMS & Pengaturan Website Publik
#### Tabel: `website_settings` (Konfigurasi Global Tunggal)
| Nama Kolom | Tipe Data | Nullable | Keterangan |
|---|---|---|---|
| `id` | Bigint unsigned | No | Single row ID = 1. |
| `site_name` | Varchar(100) | No | Nama resmi ("Puja Tour Travel Pangandaran"). |
| `site_tagline`| Varchar(200) | Yes | Slogan resmi perusahaan. |
| `logo_media_id`| Bigint unsigned | Yes | FK ke `media.id` untuk logo header. |
| `favicon_media_id`| Bigint unsigned | Yes | FK ke `media.id` untuk icon browser. |
| `default_og_media_id`| Bigint unsigned | Yes | FK ke `media.id` untuk banner share media sosial. |
| `timezone` | Varchar(50) | No | Standar: `'Asia/Jakarta'`. |
| `created_at` / `updated_at` | Timestamp | Yes | Audit timestamp. |

#### Tabel: `homepage_content` (Editor Beranda)
| Nama Kolom | Tipe Data | Nullable | Keterangan |
|---|---|---|---|
| `id` | Bigint unsigned | No | Single row ID = 1. |
| `hero_title` | Varchar(200) | No | Teks headline utama Hero Beranda. |
| `hero_subtitle`| Text | Yes | Kalimat pendukung di bawah judul Hero. |
| `hero_media_id`| Bigint unsigned | Yes | FK ke `media.id` (Foto latar Hero). |
| `primary_cta_text` / `primary_cta_url` | Varchar(100) / (255) | Yes | Tombol aksi utama (misal: "Lihat Paket Wisata"). |
| `secondary_cta_text` / `secondary_cta_url`| Varchar(100) / (255) | Yes | Tombol aksi kedua (misal: "Hubungi Kami"). |
| `about_title` / `about_description` | Varchar(150) / Text | Yes | Ringkasan profil singkat pada beranda. |
| `about_media_id`| Bigint unsigned | Yes | FK ke `media.id` untuk ilustrasi section about beranda. |
| `cta_title` / `cta_description` | Varchar(150) / Text | Yes | Teks ajakan aksi section penutup Beranda. |
| `cta_primary_text` / `cta_primary_url` | Varchar(100) / (255) | Yes | Tombol konversi WhatsApp/Reservasi di section bawah. |
| `updated_at` | Timestamp | Yes | Waktu sunting terakhir. |

#### Tabel: `trust_items` (Elemen Kepercayaan Beranda)
| Nama Kolom | Tipe Data | Nullable | Keterangan |
|---|---|---|---|
| `id` | Bigint unsigned | No | Primary Key. |
| `title` | Varchar(100) | No | Judul pilar (misal: "Legalitas Usaha CV Terdaftar"). |
| `description` | Text | Yes | Ulasan komitmen keamanan & kenyamanan. |
| `icon` | Varchar(50) | Yes | Nama icon Lucide/Heroicon. |
| `display_order`| Integer | No | Urutan kartu trust item. |
| `status` | Enum | No | `PUBLISHED`, `DRAFT`. |
| `created_at` / `updated_at` | Timestamp | Yes | Audit timestamp. |

#### Tabel: `about_content`, `about_missions`, `about_values`
- `about_content`: `id`, `title`, `introduction`, `history`, `vision`, `updated_at`.
- `about_missions`: `id`, `title`, `description`, `display_order`, `status`, `timestamps`.
- `about_values`: `id`, `title`, `description`, `icon`, `display_order`, `status`, `timestamps`.

#### Tabel: `contact_information` (Kontak Resmi Bisnis)
| Nama Kolom | Tipe Data | Nullable | Keterangan |
|---|---|---|---|
| `id` | Bigint unsigned | No | Single row ID = 1. |
| `business_name`| Varchar(100) | No | Nama resmi CV. |
| `whatsapp` | Varchar(25) | No | Nomor WhatsApp resmi CS (format `628xxx`). |
| `phone` | Varchar(25) | Yes | Nomor telepon alternatif / kantor fisik. |
| `email` | Varchar(100) | No | Alamat email resmi operasional. |
| `address` | Text | No | Alamat kantor fisik di Pangandaran. |
| `latitude` | Decimal(10,8) | Yes | Koordinat GPS (-90 s.d. 90). |
| `longitude` | Decimal(11,8) | Yes | Koordinat GPS (-180 s.d. 180). |
| `google_maps_url`| Text | Yes | Tautan langsung sematan Google Maps. |
| `updated_at` | Timestamp | Yes | Waktu sunting terakhir. |

#### Tabel: `social_links` (Tautan Media Sosial Resmi)
| Nama Kolom | Tipe Data | Nullable | Keterangan |
|---|---|---|---|
| `id` | Bigint unsigned | No | Primary Key. |
| `platform` | Varchar(30) | No | Platform (`INSTAGRAM`, `TIKTOK`, `FACEBOOK`, `YOUTUBE`). |
| `label` | Varchar(50) | No | Label display (misal: "@pujatourtravel"). |
| `url` | Varchar(255) | No | URL lengkap profil resmi. |
| `username` | Varchar(50) | Yes | Handle akun. |
| `display_order`| Integer | No | Urutan tampil di footer & header. |
| `is_active` | Boolean | No | Status aktif penayangan. |
| `created_at` / `updated_at` | Timestamp | Yes | Audit timestamp. |

---

# 4. Kebijakan Integritas Relasional, Foreign Keys, & Constraint

### 4.1 Aksi Penghapusan Relasi (*Referential Integrity Rules*)
| Relasi Entitas | Foreign Key | Aksi On Delete | Alasan Bisnis |
|---|---|---|---|
| `packages.category_id` | `category_id` | **RESTRICT** | Kategori tidak boleh dihapus jika masih ada paket aktif di dalamnya. |
| `package_facilities.package_id` | `package_id` | **CASCADE** | Fasilitas tur otomatis terhapus jika paket dihapus. |
| `package_exclusions.package_id` | `package_id` | **CASCADE** | Pengecualian tur otomatis terhapus jika paket dihapus. |
| `package_itineraries.package_id`| `package_id` | **CASCADE** | Jadwal tur otomatis terhapus jika paket dihapus. |
| `reservations.customer_id` | `customer_id` | **RESTRICT** | Data master customer dilarang dihapus jika memiliki histori transaksi reservasi. |
| `reservations.package_id` | `package_id` | **RESTRICT** | Paket wisata dilarang di-*hard delete* jika pernah dipesan. Paket dialihkan ke status `ARCHIVED`. |
| `reservations.source_id` | `source_id` | **RESTRICT** | Saluran akuisisi tidak boleh dihapus jika masih ada pemesanan yang merujuk padanya. |
| `reservation_status_history.reservation_id` | `reservation_id` | **CASCADE** | Audit log terikat mutlak pada siklus baris reservasi. |
| Kolom Lampiran Media (`thumbnail_media_id`, dsb.) | `media_id` | **SET NULL / RESTRICT** | Mencegah file media terhapus saat masih digunakan sebagai aset visual aktif. |

### 4.2 Snapshot Nilai Transaksi Historis (`booking_price`)
- Ketika transaksi pemesanan disepakati, sistem mengunci nilai harga per pax pada `reservations.booking_price`.
- Perubahan harga jual di masa depan pada `packages.price` tidak boleh memengaruhi perhitungan nilai pembukuan transaksi lama.

---

# 5. Strategi Pengindeksan & Optimasi Kueri (*Performance*)

### 5.1 Indeks Unik (*Unique Indexes*)
- `users.email`
- `package_categories.slug`
- `packages.slug`
- `customer_sources.slug`
- `customer_sources.name`
- `customers.customer_code`
- `reservations.reservation_code`

### 5.2 Indeks Pencarian & Penyaringan Kueri Cepat (*B-Tree Indexes*)
- `packages(status, featured, created_at)`: Mempercepat kueri beranda dan katalog publik (`WHERE status = 'PUBLISHED'`).
- `customers(normalized_phone)`: Menjamin deduplikasi instan nomor telepon wisatawan saat reservasi masuk.
- `customers(name, email)`: Mempercepat pencarian data pelanggan pada bilah pencarian Admin CMS.
- `reservations(status, travel_date)`: Mempercepat filter tanggal dan tab status di panel admin reservasi.
- `reservations(customer_id, created_at)`: Mempercepat agregasi riwayat reservasi pada halaman profil pelanggan.

### 5.3 Pencegahan Masalah N+1 Kueri & Proyeksi Data
- **Eager Loading Wajib**: Seluruh kueri Eloquent untuk paket wajib memuat relasi sekaligus:
  ```php
  Package::with(['category', 'thumbnail', 'facilities', 'exclusions', 'itineraries'])
      ->where('status', 'PUBLISHED')
      ->get();
  ```
- **Proyeksi Kolom Khusus**: Hindari penggunaan `SELECT *` pada API publik. Hanya pilih kolom yang relevan untuk mempercepat waktu transfer data dan melindungi integritas database.

---

# 6. Anti-Patterns Basis Data & Solusi Standar

| Pola Keliru (*Anti-Pattern*) | Risiko & Masalah | Solusi Standar yang Diterapkan |
|---|---|---|
| Menyimpan fasilitas/itinerary sebagai teks koma berulang (*CSV String*) | Kueri tidak terstruktur, sulit diurutkan, tidak dapat difilter | Dibuatkan tabel berulang terpisah: `package_facilities` & `package_itineraries` dengan kolom `display_order`. |
| Menyimpan harga mata uang sebagai teks string (misal: "Rp 750.000") | Tidak bisa diagregasi, dijumlahkan, atau diurutkan secara matematis | Disimpan sebagai tipe angka presisi tinggi `DECIMAL(15,2)` pada kolom `price` dan `booking_price`. |
| Menghapus fisik paket wisata yang memiliki riwayat pemesanan | Merusak relasi *Foreign Key* dan membuat data laporan reservasi menjadi *broken/orphan* | Menggunakan proteksi relasi `RESTRICT` dan pengubahan status ke `ARCHIVED` (*Soft Deletion*). |
| Menyimpan nomor telepon dengan variasi karakter bebas | Deduplikasi gagal karena perbedaan tanda strip atau awalan `08` vs `+62` | Menambahkan kolom `normalized_phone` berformat seragam `628xxx` dengan indeks kueri cepat. |

---

# 7. Transaksi Database (*DB::transaction*) & Atomisitas

Operasi yang melibatkan lebih dari satu tabel wajib dibungkus dalam transaksi database untuk menjamin integritas data secara penuh:

### 7.1 Alur Transaksi Reservasi Masuk
```php
DB::transaction(function () use ($validatedData) {
    // 1. Normalisasi nomor telepon
    $normalizedPhone = normalize_phone($validatedData['phone']);

    // 2. Cari atau buat master customer
    $customer = Customer::firstOrCreate(
        ['normalized_phone' => $normalizedPhone],
        [
            'customer_code' => generate_customer_code(),
            'name'          => $validatedData['name'],
            'phone'         => $validatedData['phone'],
            'email'         => $validatedData['email'] ?? null,
            'source_id'     => $websiteSourceId,
        ]
    );

    // 3. Simpan transaksi reservasi
    $reservation = Reservation::create([
        'reservation_code'  => generate_reservation_code(),
        'customer_id'       => $customer->id,
        'package_id'        => $validatedData['package_id'],
        'source_id'         => $websiteSourceId,
        'travel_date'       => $validatedData['travel_date'],
        'participant_count' => $validatedData['participant_count'],
        'status'            => 'PENDING',
        'custom_itinerary'  => $validatedData['custom_itinerary'] ?? null,
        'customer_message'  => $validatedData['customer_message'] ?? null,
    ]);

    // 4. Catat riwayat status awal
    ReservationStatusHistory::create([
        'reservation_id' => $reservation->id,
        'old_status'     => null,
        'new_status'     => 'PENDING',
        'note'           => 'Permintaan reservasi dikirim melalui website publik.',
    ]);

    return $reservation;
});
```
- Jika penyimpanan customer sukses tetapi reservasi gagal, seluruh proses di-*rollback* sehingga tidak ada data sampah yang tersimpan.

---

# 8. Urutan Eksekusi Migrasi Laravel (*Migration Sequence*)

Berkas migrasi Laravel wajib diurutkan berdasarkan pohon dependensi *Foreign Key* agar tidak terjadi kegagalan eksekusi saat perintah `php artisan migrate` dijalankan:

```text
001_create_users_table.php
002_create_package_categories_table.php
003_create_media_table.php
004_create_packages_table.php
005_create_package_facilities_table.php
006_create_package_exclusions_table.php
007_create_package_itineraries_table.php
008_create_customer_sources_table.php
009_create_customers_table.php
010_create_reservations_table.php
011_create_reservation_status_history_table.php
012_create_galleries_table.php
013_create_testimonials_table.php
014_create_tour_guides_table.php
015_create_legal_documents_table.php
016_create_website_settings_table.php
017_create_homepage_content_table.php
018_create_trust_items_table.php
019_create_about_content_table.php
020_create_about_missions_table.php
021_create_about_values_table.php
022_create_contact_information_table.php
023_create_social_links_table.php
```

### Kebijakan Database Seeder & Data Lingkungan
- **Lingkungan Lokal / Testing (`APP_ENV=local`)**: Diizinkan menjalankan seeder berisi data simulasi dummy untuk kebutuhan UI dan alur pengujian fitur.
- **Lingkungan Produksi (`APP_ENV=production`)**: **Dilarang keras** mengeksekusi seeder pengujian. Lingkungan produksi hanya mengeksekusi migrasi skema dan seeder akun admin awal yang aman.

---

# 9. Pencadangan (*Backup*), Pemulihan (*Restore*), & Keamanan Data

### 9.1 Protokol Pencadangan Rutin
- Pencadangan harian otomatis mencakup:
  1. Dump SQL basis data MySQL terkompresi (`.sql.gz`).
  2. Direktori berkas fisik media yang diunggah (`storage/app/public/media`).
- Berkas cadangan diuji secara berkala untuk memastikan prosedur pemulihan (*disaster recovery*) dapat berjalan sempurna saat terjadi insiden server.

### 9.2 Keamanan Informasi Data Pribadi (*PII Protection*)
- Data kontak wisatawan (`phone`, `email`, `notes`) terisolasi di database dan hanya dapat diakses melalui koneksi terotentikasi staf admin.
- Kredensial koneksi database disimpan eksklusif pada berkas `.env` dan dilarang keras di-*hardcode* ke dalam kode sumber aplikasi atau repositori Git.

---

# 10. Daftar Periksa Kesiapan Skema Basis Data (*Acceptance Checklist*)

### 10.1 Skema & Definisi Tabel
- [ ] Seluruh 23 tabel inti terdefinisi lengkap dengan tipe data MySQL 8 yang presisi.
- [ ] Nilai nominal harga menggunakan tipe `DECIMAL(15,2)`.
- [ ] Tanggal perjalanan wisata menggunakan tipe `DATE` murni.
- [ ] Seluruh tabel memiliki kolom audit timestamp (`created_at`, `updated_at`).
- [ ] Tabel master pendukung transaksi mengimplementasikan soft delete (`deleted_at`).

### 10.2 Integritas Relasi & Constraint
- [ ] Foreign key `customer_id` dan `package_id` pada tabel `reservations` berkonfigurasi `ON DELETE RESTRICT`.
- [ ] Relasi anak paket (`facilities`, `exclusions`, `itineraries`) berkonfigurasi `ON DELETE CASCADE`.
- [ ] Constraint unik diterapkan pada `users.email`, `packages.slug`, `customers.customer_code`, dan `reservations.reservation_code`.
- [ ] Kolom `participant_count` memiliki validasi integer positif minimal 1.

### 10.3 Indeks & Kueri
- [ ] Indeks B-Tree terpasang pada kolom `normalized_phone`, `travel_date`, `status`, dan `created_at`.
- [ ] Semua kueri publik menyertakan filter `status = 'PUBLISHED'`.
- [ ] Kueri relasi paket dan reservasi menerapkan eager loading untuk mencegah masalah kueri N+1.

### 10.4 Migrasi & Transaksi
- [ ] Urutan migrasi terstruktur logis dari entitas independen menuju entitas dengan dependensi foreign key.
- [ ] Logika reservasi dan deduplikasi customer dibungkus dalam `DB::transaction`.
- [ ] Seeder pengujian terisolasi hanya untuk lingkungan lokal (*development*).

---

# 11. Aturan Implementasi Pengembang & AI Agent

1. **Gunakan Laravel Migration**: Dilarang mengubah struktur tabel langsung via phpMyAdmin atau MySQL CLI di lingkungan produksi tanpa membuat berkas migrasi Laravel resmi.
2. **Hindari Hard Delete Data Riwayat**: Jangan pernah menghapus paket wisata atau pelanggan yang telah memiliki riwayat reservasi. Gunakan status `ARCHIVED` atau soft delete.
3. **Pemisahan Harga Saat Ini vs Harga Booking**: Jangan pernah memperbarui riwayat nilai transaksi lama jika harga master paket diubah di kemudian hari. Selalu gunakan `reservations.booking_price`.
4. **Validasi Dua Arah**: Integritas basis data didukung bersama oleh constraint database (tipe data, not null, FK, check) dan Form Request validation di sisi aplikasi.

---

# 12. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Visi bisnis, aktor sistem, dan cakupan proyek
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) — Aturan bisnis inti dan pemodelan data entitas
- [06-admin-cms.md](file:///c:/laragon/www/pujatourtravel.com/docs/06-admin-cms.md) — Antarmuka pengelolaan data master dan konten CMS
- [07-reservation-system.md](file:///c:/laragon/www/pujatourtravel.com/docs/07-reservation-system.md) — Alur transaksi pembuatan reservasi dan status lifecycle
- [08-customer-management.md](file:///c:/laragon/www/pujatourtravel.com/docs/08-customer-management.md) — Logika deduplikasi pelanggan dan keterkaitan relasi CRM
- `10-security.md` — Kebijakan otentikasi database, sanitasi SQL Injection, dan enkripsi PII
- `13-deployment.md` — Konfigurasi koneksi MySQL di server produksi dan prosedur backup otomatis
