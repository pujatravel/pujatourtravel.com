# 07 — Reservation System Specifications
# Puja Tour Travel Website

> Dokumen ini mendefinisikan arsitektur lengkap, logika bisnis, aturan validasi, siklus status (*lifecycle*), pencegahan duplikasi, dan integrasi operasional untuk Sistem Reservasi Puja Tour Travel.
> Dokumen ini menjadi pedoman utama implementasi alur formulir publik (*frontend*), pemrosesan transaksi (*backend*), skema database, serta panel manajemen reservasi pada Admin CMS.

---

# 1. Konsep Dasar & Batasan Sistem Reservasi

### 1.1 Definisi Reservasi
Dalam sistem Puja Tour Travel, reservasi diartikan sebagai:
> **Permintaan perjalanan resmi (*Structured Inquiry & Lead Capture*) dari calon wisatawan untuk memesan paket wisata pada tanggal dan jumlah peserta tertentu.**

### 1.2 Batasan Ruang Lingkup (*Scope Boundaries*)
- Reservasi baru **tidak otomatis** menjadi pemesanan terkonfirmasi (*not an instant auto-confirmed booking*).
- Sistem ini **tidak mencakup** integrasi gateway pembayaran otomatis (*Payment Gateway*) kartu kredit atau e-wallet instan. Seluruh pembayaran uang muka (DP) atau pelunasan diproses melalui transfer bank manual setelah diverifikasi oleh staf admin.
- Sistem ini **tidak memerlukan** mesin penjadwalan ketersediaan slot jam (*real-time availability engine*) yang kompleks. Ketersediaan tanggal divalidasi langsung secara personal oleh staf melalui kontak WhatsApp.

### 1.3 Alur Utama Reservasi (*High-Level Flow*)
```text
Customer Isi Form Publik
           │
           ▼
Validasi Data & Normalisasi Nomor HP
           │
           ▼
Pencocokan / Pembuatan Customer (Atomic Transaction)
           │
           ▼
Reservasi Tersimpan (Status: PENDING, Source: Website)
           │
           ▼
Staf Buka Detail di Admin CMS & Hubungi Wisatawan via WhatsApp
           │
           ▼
Status: DIPROSES ──► Status: DIKONFIRMASI ──► Trip Berjalan ──► Status: SELESAI
     │                     │
     └─────────────────────┴──► Status: DIBATALKAN (Bila batal)
```

---

# 2. Titik Masuk & Parameter Rute Reservasi

### 2.1 Pintu Masuk Pengguna (*Entry Points*)
1. **Navigasi Utama & Tombol Header**: Mengarah ke form kosong `/reservasi`.
2. **Halaman Detail Paket Wisata**: Tombol "Reservasi Sekarang" mengarah ke `/reservasi?package={slug}`.
3. **Banner Promosi Beranda**: Tombol konversi yang mengarahkan ke form reservasi.

### 2.2 Penanganan Konteks Paket (*Pre-Filled Context*)
- Jika pengguna membuka rute dengan parameter query (misal: `/reservasi?package=green-canyon-vip`):
  - Sistem otomatis mencocokkan parameter `slug` dengan paket wisata di database.
  - Jika paket ditemukan dan berstatus `published`, paket tersebut otomatis terpilih pada menu dropdown paket.
  - Pengguna tetap diperbolehkan mengganti pilihan paket jika berubah pikiran.

---

# 3. Struktur Data Formulir & Aturan Validasi

Formulir reservasi dirancang ringkas untuk meminimalkan hambatan (*friction*) calon wisatawan dalam mengirimkan pesanan:

```text
┌─────────────────────────────────────────────────────────────┐
│ 1. Data Pemesan (Nama Lengkap, No WhatsApp, Email Opsional) │
├─────────────────────────────────────────────────────────────┤
│ 2. Data Perjalanan (Pilihan Paket, Tanggal Trip, Jumlah Pax)│
├─────────────────────────────────────────────────────────────┤
│ 3. Permintaan Tambahan (Rute Kustom & Catatan Khusus)        │
├─────────────────────────────────────────────────────────────┤
│ [Kirim Permintaan Reservasi]                                │
└─────────────────────────────────────────────────────────────┘
```

### 3.1 Spesifikasi Kolom Formulir
| Nama Kolom | Tipe Input | Aturan Wajib | Aturan Validasi & Format |
|---|---|---|---|
| `name` | Teks | **Wajib** | Minimal 3 karakter, maksimal 100 karakter, teks bebas nama orang. |
| `phone` | Teks / Tel | **Wajib** | Format nomor telepon Indonesia valid, dinormalisasi ke format `628xxx`. |
| `email` | Email | Opsional | Format email valid sesuai RFC 5322 (jika diisi). |
| `package_id` | Dropdown | **Wajib** | Harus ID/Slug paket yang ada di database dan berstatus `published`. |
| `travel_date`| Date Picker | **Wajib** | Tanggal valid, tidak boleh tanggal lampau (`travel_date >= today`). |
| `participant_count` | Number | **Wajib** | Bilangan bulat (*integer*) positif, minimal 1 orang. |
| `custom_itinerary` | Textarea | Opsional | Maksimal 1.000 karakter, kebutuhan destinasi kustom. |
| `customer_message` | Textarea | Opsional | Maksimal 1.000 karakter, catatan kebutuhan lansia/makanan/titik jemput. |

### 3.2 Normalisasi Nomor Telepon / WhatsApp
Nomor telepon yang dimasukkan pengguna dalam berbagai format (contoh: `0812-3456-7890`, `+62 812 3456 7890`, atau `081234567890`) wajib dinormalisasi di sisi backend menjadi format standar:
```text
Input Mentah : 0812-3456-7890  ──►  Normalisasi Server: 6281234567890
```
- **Tujuan**: Mempermudah deteksi pelanggan lama, memastikan pembuatan tautan *Click-to-Chat* WhatsApp selalu valid, dan mencegah duplikasi data customer.

### 3.3 Validasi Berlapis (*Two-Layer Validation*)
1. **Frontend Validation**: Memberikan pesan kesalahan instan di bawah field terkait sebelum data dikirim ke server.
2. **Backend Validation (Authority)**: Seluruh data divalidasi ulang secara ketat di Laravel Form Request (`StoreReservationRequest`). Frontend validation tidak pernah dianggap sebagai sistem keamanan.

---

# 4. Mekanisme Pengiriman & Penomoran Unik

### 4.1 Pencegahan Duplikasi Pengiriman (*Double-Submit Prevention*)
- Saat pengguna menekan tombol "Kirim Permintaan Reservasi":
  - Tombol submit langsung terkunci (*disabled*) di sisi antarmuka.
  - Teks tombol berubah menjadi indikator proses (*"Mengirim Permintaan..."*) dilengkapi animasi spinner.
  - Mengabaikan klik berulang selama proses request HTTP berlangsung.

### 4.2 Nilai Kolom yang Dikendalikan Server (*Server-Controlled Values*)
Klien dilarang menentukan nilai-nilai berikut; seluruhnya dihasilkan atau ditetapkan mutlak oleh server:
- `status`: Otomatis ditetapkan bernilai **`PENDING`**.
- `source`: Otomatis ditetapkan bernilai **`Website`** untuk reservasi yang masuk via form publik.
- `reservation_code`: Kode acuan publik yang digenerate oleh server.

### 4.3 Format Kode Reservasi Publik (*Reservation Code*)
Setiap reservasi diberikan kode unik yang mudah dibaca manusia untuk keperluan komunikasi antara wisatawan dan admin:
```text
RES-YYYY-XXXXXX
Contoh: RES-2026-000142
```
- `internal_id`: Primary key integer auto-increment untuk relasi basis data internal.
- `reservation_code`: String unik publik untuk identifikasi pesanan di pesan WhatsApp dan konfirmasi.

---

# 5. Logika Pencocokan Pelanggan (*Customer Matching & CRM*)

Data pelanggan dipisahkan dari entitas transaksi reservasi (*1 Customer to Many Reservations*).

### 5.1 Alur Transaksi Pembuatan Data
```text
Data Reservasi Masuk di Backend
              │
              ▼
Cari Customer Berdasarkan Nomor WhatsApp yang Dinormalisasi
              │
      ┌───────┴───────┐
      ▼               ▼
[Ditemukan]      [Tidak Ditemukan]
Gunakan ID       Buat Baris Baru di Tabel Customers
Customer Lama    (Nama, WhatsApp, Email, Source: Website)
      │               │
      └───────┬───────┘
              ▼
Simpan Baris Reservasi Baru ke Tabel Reservations (Terkait Customer ID)
              │
              ▼
Commit Database Transaction
```

### 5.2 Perlindungan Integritas Transaksi (*DB Transaction*)
Pencarian/pembuatan data Customer dan pembuatan data Reservasi **wajib dibungkus** dalam `DB::transaction()`:
- Jika penyimpanan customer berhasil tetapi penyimpanan reservasi gagal, seluruh proses di-*rollback*.
- Menjamin tidak ada data sampah (*orphan customer*) yang tersimpan tanpa catatan transaksi.

### 5.3 Snapshot Harga Pemesanan (*Booking Price Snapshot*)
- Sistem menyimpan nilai `booking_price` pada tabel reservasi saat pemesanan disepakati:
  - `package.price`: Harga jual master paket yang dinamis (dapat naik/turun di masa depan).
  - `reservation.booking_price`: Nilai kesepakatan harga per pax yang mengikat transaksi tersebut.
  - **Prinsip**: Perubahan harga master paket di masa depan tidak boleh mengubah riwayat nilai pemesanan lama.

---

# 6. Siklus Hidup Status Reservasi (*Reservation Lifecycle*)

### 6.1 Daftar Nilai Status Resmi
| Nilai Status | Label UI Admin | Definisi & Tahapan Operasional |
|---|---|---|
| `PENDING` | **Pending** | Permintaan baru masuk dari website; belum diverifikasi atau dihubungi staf. |
| `PROCESSING`| **Diproses** | Staf sedang memeriksa ketersediaan slot, menghitung custom request, atau menghubungi customer via WA. |
| `CONFIRMED` | **Dikonfirmasi**| Jadwal trip dan rincian biaya telah disepakati (misal DP telah ditransfer). Booking resmi tercatat. |
| `COMPLETED` | **Selesai** | Rombongan wisatawan telah selesai melaksanakan perjalanan wisata di Pangandaran. |
| `CANCELLED` | **Dibatalkan** | Pemesanan dibatalkan oleh pelanggan atau kuota trip tidak memungkinkan. Wajib mencatat alasan pembatalan. |

### 6.2 Diagram Transisi Status
```text
                 ┌──────────────┐
                 │   PENDING    │
                 └──────┬───────┘
                        │ (Admin mulai tindak lanjut)
                        ▼
                 ┌──────────────┐
                 │  PROCESSING  │
                 └──────┬───────┘
                        │ (Jadwal & biaya disepakati)
                        ▼
                 ┌──────────────┐
                 │  CONFIRMED   │
                 └──────┬───────┘
                        │ (Trip selesai terlaksana)
                        ▼
                 ┌──────────────┐
                 │  COMPLETED   │
                 └──────────────┘

* Pembatalan (CANCELLED) dapat dilakukan dari status PENDING, PROCESSING, atau CONFIRMED.
* Transisi terlarang: Status COMPLETED tidak dapat diubah kembali ke PENDING atau PROCESSING tanpa otorisasi khusus.
```

---

# 7. Antarmuka Pemrosesan di Admin CMS

### 7.1 Tabel Manajemen Reservasi (`/admin/reservations`)
- **Fitur Penyaringan**:
  - Filter Status Cepat: Tab `Semua`, `Pending` (dengan badge hitungan mencolok), `Diproses`, `Dikonfirmasi`, `Selesai`, `Dibatalkan`.
  - Filter Dropdown: Paket Wisata dan Saluran Sumber (*Source*).
  - Filter Rentang Tanggal: Tanggal rencana perjalanan (*Travel Date*) dan tanggal pemesanan (*Created At*).
  - Pencarian Teks: Berdasarkan Kode Reservasi, Nama Pemesan, atau Nomor WhatsApp.

### 7.2 Halaman Detail Reservasi (`/admin/reservations/{id}`)
1. **Header Ringkasan**: Kode reservasi, badge status saat ini, tanggal form dibuat, tombol cetak/ekspor.
2. **Kartu Data Wisatawan**:
   - Nama lengkap pemesan.
   - Tombol Cepat **"Chat via WhatsApp"**: Membuka tautan `https://wa.me/628xxx` dengan template sapaan resmi:
     ```text
     Halo Kak [Nama Pemesan], terima kasih telah melakukan reservasi di Puja Tour Travel untuk paket [Nama Paket] pada tanggal [Tanggal Trip]. Kami ingin mengonfirmasi detail perjalanan Anda...
     ```
   - Alamat email pemesan dan tautan profil master customer.
3. **Kartu Rincian Perjalanan**:
   - Paket wisata yang dipilih, tanggal perjalanan, jumlah peserta, dan catatan permintaan kustom.
4. **Catatan Internal Staf (*Admin Notes*)**:
   - Area pengetikan catatan privat operasional (contoh: *"Customer transfer DP Rp 500.000 via BCA tanggal 11 Sep. Penjemputan di Hotel Horison jam 08:00"*). Catatan ini hanya terlihat oleh staf admin.
5. **Panel Kontrol Pengubahan Status**:
   - Dropdown atau tombol aksi pembaruan status ke tahap berikutnya beserta kolom input alasan jika status diubah ke `Dibatalkan`.

---

# 8. Keamanan, Batas Laju (*Rate Limiting*), & Privasi

### 8.1 Pembatasan Laju Permintaan (*Rate Limiting*)
- Endpoint publik `POST /api/reservations` wajib dilindungi oleh throttle rate limiter Laravel:
  - Maksimal **5 permintaan reservasi per 1 menit** per IP address untuk mencegah serangan bot spam atau luapan form massal.

### 8.2 Proteksi Anti-Spam Ringan (*Honeypot*)
- Menyertakan kolom tersembunyi (*honeypot input*) pada form publik yang tidak terlihat oleh mata manusia (disembunyikan via CSS).
- Jika kolom honeypot terisi saat form dikirimkan, server otomatis menolak request tersebut sebagai bot tanpa memicu proses database.

### 8.3 Sanitasi Input (Anti-XSS & Anti-Injection)
- Seluruh input teks (`name`, `custom_itinerary`, `customer_message`) disanitasi sebagai teks murni (*plain text*). Dilarang merender tag HTML mentah dari input pengguna ke tampilan website atau admin panel.

### 8.4 Prinsip Paparan Data Minimal (*Least Data Exposure*)
- Setelah reservasi berhasil dikirim, server publik **hanya mengembalikan** respon ringkas:
  ```json
  {
    "success": true,
    "reservation_code": "RES-2026-000142",
    "message": "Permintaan reservasi Anda berhasil dikirim. Tim kami akan segera menghubungi Anda via WhatsApp."
  }
  ```
- Dilarang keras mengembalikan seluruh model `Customer` atau `admin_notes` pada respon JSON publik.

---

# 9. Integritas Basis Data & Proteksi Penghapusan

- **Integritas Relasional (*Foreign Keys*)**:
  - `reservations.customer_id` terhubung ke `customers.id`.
  - `reservations.package_id` terhubung ke `packages.id`.
  - `reservations.source_id` terhubung ke `customer_sources.id`.
- **Proteksi Hapus Data Master**:
  - Paket wisata yang telah memiliki relasi transaksi di tabel `reservations` dilarang dihapus fisik (*hard delete*). Sebagai gantinya, status paket diubah menjadi `archived`.
  - Data customer yang memiliki histori reservasi dilindungi dari penghapusan sembarangan demi kepatuhan catatan pembukuan operasional.

---

# 10. Daftar Periksa Kesiapan Sistem Reservasi (*Acceptance Checklist*)

### 10.1 Formulir Publik Sisi Pengguna
- [ ] Formulir reservasi dapat dibuka pada URL `/reservasi` dan menerima parameter query `/reservasi?package={slug}`.
- [ ] Dropdown paket otomatis memilih paket yang sesuai dengan parameter URL.
- [ ] Tanggal perjalanan tidak mengizinkan pemilihan tanggal lampau.
- [ ] Kolom jumlah peserta memvalidasi input angka positif minimal 1.
- [ ] Tombol kirim form terkunci saat request berjalan untuk mencegah klik ganda.
- [ ] Tampilan pesan konfirmasi sukses menampilkan nomor kode reservasi publik (`RES-YYYY-XXXXXX`).

### 10.2 Pemrosesan Server-Side & Keamanan
- [ ] Request reservasi tervalidasi lengkap di controller melalui Laravel Form Request.
- [ ] Nomor telepon otomatis dinormalisasi menjadi format standar `628xxx`.
- [ ] Sistem mengenali pelanggan lama berdasarkan nomor WhatsApp tanpa menduplikasi data customer.
- [ ] Pembuatan customer dan reservasi dibungkus dalam `DB::transaction`.
- [ ] Status awal reservasi selalu diatur ke `PENDING` dan sumber diatur ke `Website`.
- [ ] Endpoint reservasi dilindungi oleh rate limiter dan proteksi honeypot anti-spam.

### 10.3 Panel Admin CMS
- [ ] Admin dapat melihat daftar seluruh reservasi dengan status badge yang jelas.
- [ ] Admin dapat memfilter reservasi berdasarkan status, paket, sumber, dan rentang tanggal trip.
- [ ] Halaman rincian reservasi menampilkan seluruh informasi pemesan, paket, dan tombol cepat chat WhatsApp.
- [ ] Admin dapat memperbarui status reservasi dan menambahkan catatan internal (*admin notes*).
- [ ] Seluruh data kontak pemesan terlindungi aman di dalam sesi admin yang terotentikasi.

---

# 11. Aturan Implementasi Pengembang & AI Agent

1. **Dilarang Menjadwalkan Tiket Otomatis**: Jangan membuat status langsung `CONFIRMED` saat reservasi dikirimkan publik. Seluruh reservasi masuk berstatus awal `PENDING`.
2. **Jangan Mengubah Riwayat Harga**: Pastikan kolom `booking_price` terisi nilai saat transaksi terjadi agar perubahan harga master paket di masa depan tidak merusak histori transaksi lama.
3. **Pemisahan Controller**: Pisahkan controller penerimaan form publik (`PublicReservationController`) dengan controller pemrosesan admin (`Admin/ReservationController`).
4. **Log Error Aman**: Jangan mencatat (*logging*) data privat pemesan (email, nomor telepon) secara terbuka pada berkas log aplikasi.

---

# 12. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Gambaran umum dan tujuan bisnis proyek
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) — Kebutuhan bisnis, aturan data, dan katalog *BR*
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) — Struktur navigasi rute `/reservasi` dan `/admin/reservations`
- [04-ui-ux-guidelines.md](file:///c:/laragon/www/pujatourtravel.com/docs/04-ui-ux-guidelines.md) — Panduan desain form, tombol aksi, dan pesan validasi
- [05-public-website.md](file:///c:/laragon/www/pujatourtravel.com/docs/05-public-website.md) — Implementasi tampilan form reservasi publik
- [06-admin-cms.md](file:///c:/laragon/www/pujatourtravel.com/docs/06-admin-cms.md) — Alur operasional modul reservasi di dashboard admin
- `08-customer-management.md` — Desain modul pengelolaan data pelanggan (CRM)
- `09-database.md` — Skema tabel `reservations`, `customers`, dan migrasi Laravel
- `10-security.md` — Standar perlindungan data privat dan validasi form
