# 08 — Customer Management Specifications
# Puja Tour Travel Website

> Dokumen ini mendefinisikan arsitektur lengkap, pemodelan data, logika deduplikasi, atribuisi sumber, penelusuran riwayat transaksi, antarmuka Admin CMS, serta standar privasi data pribadi (*PII*) untuk modul Manajemen Pelanggan (*Customer Management / CRM Lite*) Puja Tour Travel.
> Dokumen ini menjadi acuan utama pengembangan entitas `customers`, relasi *1-to-Many* ke `reservations`, normalisasi nomor telepon, dan analitik loyalitas wisatawan.

---

# 1. Konsep Dasar & Tujuan Manajemen Pelanggan (CRM Lite)

### 1.1 Definisi & Batasan Entitas Pelanggan
Dalam ekosistem Puja Tour Travel, **Customer** didefinisikan sebagai:
> **Individu wisatawan yang berinteraksi resmi dengan Puja Tour Travel dan memiliki atau berpotensi memiliki catatan transaksi reservasi perjalanan.**

Customer merupakan entitas master yang **berdiri sendiri dan terpisah secara relasional** dari entitas reservasi (*1 Customer to Many Reservations*).

### 1.2 Pemisahan Entitas: Customer vs Reservation
Sistem dilarang keras menyimpan data kontak pemesan hanya sebagai kolom teks mentah di dalam baris reservasi tanpa relasi entitas master.

```text
PENDEKATAN KELIRU (DATA REDUNDAN & PECAH):
Reservation
├── customer_name
├── customer_phone
├── customer_email
├── package_id
└── travel_date

PENDEKATAN BENAR (RELASIONAL & BERSIH):
Customer (Master Entity)
├── id
├── customer_code (CUS-YYYY-XXXXXX)
├── name
├── phone (Normalized: 628xxx)
├── email
├── source_id (Acquisition Channel)
└── admin_notes
       │
       ▼ (HasMany: 1 ke N)
Reservations (Transactional Entity)
├── id
├── reservation_code (RES-YYYY-XXXXXX)
├── customer_id (Foreign Key)
├── package_id
├── travel_date
├── participant_count
└── status
```

### 1.3 Siklus Hidup Pelanggan (*Customer Lifecycle*)
```text
Pengunjung Anonim (Visitor)
           │ (Menjelajahi website / media sosial)
           ▼
Calon Pelanggan (Lead / Inquiry via WA / Web)
           │ (Mengisi form reservasi / memesan paket)
           ▼
Pelanggan Aktif (Customer with Pending / Confirmed Reservation)
           │ (Trip selesai terlaksana)
           ▼
Pelanggan Tuntas (Customer with Completed Trip)
           │ (Melakukan reservasi paket lain di masa depan)
           ▼
Pelanggan Berulang (Repeat Customer)
```
- **Batasan**: Pengunjung website anonim tidak otomatis dibuatkan baris data customer. Penciptaan data customer baru dipicu oleh pengiriman reservasi resmi atau entri manual oleh admin.

---

# 2. Penciptaan & Akuisisi Data Pelanggan

Data pelanggan masuk ke dalam basis data melalui dua pintu utama:

```text
┌──────────────────────────────────────┐     ┌──────────────────────────────────────┐
│       1. FORM RESERVASI PUBLIK       │     │        2. ENTRI MANUAL ADMIN         │
│ (/reservasi atau ?package={slug})    │     │ (/admin/customers/create)            │
└──────────────────┬───────────────────┘     └──────────────────┬───────────────────┘
                   │                                            │
                   ▼                                            ▼
     Normalisasi Nomor WhatsApp                    Normalisasi Nomor WhatsApp
                   │                                            │
                   ▼                                            ▼
      Pemeriksaan Duplikasi (WA)                   Pemeriksaan Duplikasi (WA)
         ┌─────────┴─────────┐                        ┌─────────┴─────────┐
         ▼                   ▼                        ▼                   ▼
    [Ditemukan]       [Baru / Unik]              [Ditemukan]       [Baru / Unik]
   Tautkan ID          Buat Row Baru            Tampilkan Dialog    Buat Row Baru
   Customer Lama       di Customers              Konfirmasi Data    di Customers
```

### 2.1 Pendaftaran Otomatis via Reservasi Publik (*Atomic Flow*)
- Saat calon wisatawan mengirimkan formulir reservasi pada website:
  1. Backend menormalisasi nomor WhatsApp yang dimasukkan.
  2. Sistem mencari apakah ada customer yang telah terdaftar dengan nomor tersebut.
  3. **Jika Ditemukan**: Menggunakan `customer_id` yang ada tanpa menduplikasi data profil.
  4. **Jika Belum Ada**: Membuat baris master customer baru dengan sumber (*source*) otomatis diatur ke `Website`.
  5. Seluruh proses penciptaan customer dan reservasi dibungkus dalam satu transaksi database (`DB::transaction`).

### 2.2 Entri Manual oleh Administrator
Admin dapat mendaftarkan pelanggan secara manual ketika calon wisatawan menghubungi bisnis secara langsung melalui saluran luar website (misal: WhatsApp CS, Instagram Direct Message, TikTok, Facebook Messenger, telepon, rekomendasi kenalan, atau datang langsung ke kantor fisik).
- Setelah profil customer tersimpan, staf dapat langsung membuatkan reservasi perjalanan terkait dari dasbor admin.

### 2.3 Atribusi Saluran Akuisisi (*Acquisition Source vs Reservation Source*)
Sistem membedakan secara tegas antara saluran awal perolehan pelanggan (*Customer Acquisition Source*) dan saluran pengiriman pemesanan tertentu (*Reservation Source*):
- **Customer Acquisition Source**: Saluran pertama kali wisatawan mengenal bisnis (contoh: `Instagram`).
- **Reservation Source**: Saluran yang digunakan pada transaksi spesifik (contoh: Reservasi #1 via `Instagram`, Reservasi #2 via `Website`, Reservasi #3 via `WhatsApp`).
- **Integritas Historis**: Pembaruan saluran akuisisi customer tidak boleh mengubah histori saluran pada transaksi reservasi lama.

---

# 3. Identifikasi Pelanggan & Pencegahan Duplikasi

### 3.1 Kandidat Kunci Unik Utama (*Primary Match*)
- **Nomor Telepon / WhatsApp yang Dinormalisasi** digunakan sebagai kandidat kunci utama identifikasi profil customer.
- WhatsApp adalah saluran komunikasi utama operasional Puja Tour Travel, sehingga nomor telepon memiliki keandalan verifikasi tertinggi.

### 3.2 Standar Normalisasi Nomor Telepon (`628xxx`)
Seluruh nomor kontak wajib dibersihkan dari spasi, tanda hubung, tanda kurung, dan awalan lokal sebelum disimpan atau dicocokkan:
```text
Format Masukan Pengguna           Format Standar Database
0812-3456-7890             ──►    6281234567890
+62 812 3456 7890          ──►    6281234567890
081234567890               ──►    6281234567890
62 812-3456-7890           ──►    6281234567890
```
- **Manfaat**: Menjamin pencarian instan akurat, mencegah pembuatan profil ganda akibat perbedaan format pengetikan, dan memastikan URL *Click-to-Chat* (`https://wa.me/628xxx`) selalu valid.

### 3.3 Batasan Pencocokan & Larangan Auto-Merge Berdasarkan Nama
- **Dilarang keras** menggabungkan dua baris customer secara otomatis hanya berdasarkan kesamaan nama (contoh: nama umum seperti "Budi" atau "Dewi" dapat dimiliki oleh banyak individu berbeda).
- Jika nama sama namun nomor telepon berbeda, sistem wajib memperlakukannya sebagai **dua customer yang berbeda**.
- Fitur penggabungan profil (*Customer Merge*) tidak dimasukkan dalam MVP inti demi menjaga integritas pembukuan reservasi.

### 3.4 Peringatan Duplikasi pada Form Admin
- Pada form pembuatan customer manual di Admin CMS, jika admin memasukkan nomor telepon yang telah terdaftar, antarmuka wajib menampilkan notifikasi peringatan:
  > *"Pelanggan dengan nomor telepon ini sudah terdaftar: [Nama Pelanggan] ([Kode Customer]). Apakah Anda ingin membuka profil yang sudah ada?"*
- Terdapat tombol cepat menuju profil pelanggan terkait untuk mencegah redundansi data yang disengaja.

---

# 4. Spesifikasi Struktur Data & Bidang Pelanggan

### 4.1 Spesifikasi Kolom Data Pelanggan (`customers`)
| Nama Kolom | Tipe Data | Aturan Wajib | Aturan Validasi & Keterangan |
|---|---|---|---|
| `id` | Bigint unsigned | **Wajib** | Primary Key auto-increment. |
| `customer_code` | Varchar(30) | **Wajib** | Kode unik publik yang di-generate server (`CUS-YYYY-XXXXXX`). |
| `name` | Varchar(100) | **Wajib** | Nama lengkap wisatawan (minimal 3 karakter, sanitasi XSS). |
| `phone` | Varchar(25) | **Wajib** | Nomor WhatsApp dinormalisasi ke format `628xxx`, berindeks. |
| `email` | Varchar(100) | Opsional | Format email valid sesuai RFC 5322 (nullable). |
| `source_id` | Bigint unsigned | **Wajib** | Foreign key ke tabel `customer_sources` (Website, IG, WA, dsb.). |
| `admin_notes` | Text | Opsional | Catatan internal privat staf (riwayat preferensi, alergi, dsb.). |
| `created_at` | Timestamp | Otomatis | Waktu pendaftaran pertama pelanggan. |
| `updated_at` | Timestamp | Otomatis | Waktu pembaruan data terakhir. |

### 4.2 Format Kode Pelanggan Publik (*Customer Code*)
Setiap pelanggan memiliki kode unik acuan:
```text
CUS-YYYY-XXXXXX
Contoh: CUS-2026-000125
```
- Digunakan untuk rujukan cepat pada administrasi manual, pencetakan dokumen, dan korespondensi.

### 4.3 Catatan Internal Staf (*Admin Notes*)
- Kolom `admin_notes` diperuntukkan bagi catatan privat operasional tim Puja Tour Travel (contoh: *"Customer menyukai hotel dekat pantai barat. Sering bepergian bersama keluarga besar. Sensitif terhadap makanan pedas"*).
- **Aturan Privasi Mutlak**: Bidang ini bersifat rahasia internal dan **dilarang keras** diekspos ke antarmuka publik atau respon API publik.

---

# 5. Klasifikasi Pelanggan & Metrik Loyalitas

### 5.1 Definisi Pelanggan Baru vs Pelanggan Berulang
Sistem menghitung klasifikasi loyalitas wisatawan secara otomatis berbasis riwayat transaksi tanpa memerlukan penandaan manual (*no manual flag*):
- **Pelanggan Baru (*New Customer*)**: Pelanggan yang baru memiliki tepat **1 riwayat reservasi** (`reservation_count = 1`).
- **Pelanggan Berulang (*Repeat Customer*)**: Pelanggan yang memiliki **lebih dari 1 riwayat reservasi** (`reservation_count > 1`).
- **Pelanggan Prospek (*Prospect / Lead*)**: Pelanggan yang didaftarkan manual oleh staf namun belum memiliki riwayat reservasi (`reservation_count = 0`).

### 5.2 Agregasi Otomatis & Statistik Profil
Pada halaman rincian pelanggan, sistem menyajikan agregasi data aktual dari tabel `reservations`:
- **Total Reservasi**: Jumlah keseluruhan pemesanan yang pernah dibuat.
- **Reservasi Dikonfirmasi (*Confirmed*)**: Total pemesanan yang telah disepakati & diverifikasi.
- **Trip Selesai (*Completed*)**: Total perjalanan yang telah sukses dilaksanakan.
- **Reservasi Batal (*Cancelled*)**: Total pemesanan yang dibatalkan beserta alasannya.
- **Tanggal Transaksi Terakhir (*Last Reservation*)**: Tanggal transaksi terbaru (`MAX(reservations.created_at)`).
- **Jadwal Trip Mendatang (*Next Upcoming Trip*)**: Reservasi berstatus `CONFIRMED` dengan tanggal `travel_date >= today`.

### 5.3 Snapshot Riwayat Harga & Integritas Data Historis
- Setiap reservasi mengikat snapshot nilai harga saat pemesanan terjadi (`reservations.booking_price`).
- Jika harga paket wisata di masa depan dinaikkan atau diturunkan melalui modul paket CMS, total riwayat transaksi lama pada profil customer tetap merefleksikan nilai kesepakatan riil saat trip berlangsung.

---

# 6. Antarmuka Manajemen Pelanggan di Admin CMS

### 6.1 Tabel Master Pelanggan (`/admin/customers`)
Antarmuka efisien untuk mengelola basis data wisatawan:
- **Kolom Tabel**:
  1. Nama Lengkap Pelanggan & Kode Customer (`CUS-2026-000125`).
  2. Kontak WhatsApp (dengan tombol cepat salin & tautan chat).
  3. Alamat Email (jika tersedia).
  4. Saluran Akuisisi (*Acquisition Source Badge*: Instagram, Website, WhatsApp, dsb.).
  5. Total Reservasi (dilengkapi badge khusus **"Repeat Customer"** jika > 1).
  6. Tanggal Terdaftar (*Created At*).
  7. Aksi (Tombol Lihat Profil Detail & Edit Data).
- **Pencarian Multi-Bidang (*Multi-Field Search*)**:
  - Pencarian fleksibel berdasarkan Nama Pelanggan, Nomor WhatsApp (baik format lokal `0812` maupun internasional `628`), Email, atau Kode Customer.
  - Pencarian berjalan server-side, toleran spasi, dan *case-insensitive*.
- **Penyaringan (*Filtering*)**:
  - Filter berdasarkan Saluran Akuisisi (*Acquisition Source*).
  - Filter berdasarkan Tipe Loyalitas (Semua, Pelanggan Berulang, Pelanggan Baru).
  - Filter berdasarkan Rentang Tanggal Pendaftaran (*Date Range Picker*).
- **Pengurutan (*Sorting*)**:
  - Paling Baru Mendaftar (*Default: Newest First*).
  - Paling Lama Mendaftar (*Oldest*).
  - Nama A–Z dan Z–A.
  - Jumlah Reservasi Terbanyak (*Most Reservations*).
- **Paginasi Standar**: 20 pelanggan per halaman dengan navigasi paginasi bersih.

### 6.2 Halaman Profil & Detail Pelanggan (`/admin/customers/{id}`)
Tata letak ringkas dan komprehensif:
```text
┌────────────────────────────────────────────────────────────────────────┐
│ [CUS-2026-000125] Budi Santoso                 [Edit Profil] [Chat WA] │
│ Terdaftar sejak: 12 Agustus 2026 | Sumber: Instagram                   │
├────────────────────────────────────────────────────────────────────────┤
│ KARTU INFORMASI KONTAK           │ KARTU RINGKASAN TRANSAKSI           │
│ WhatsApp : 0812-3456-7890        │ Total Reservasi : 3 Trip            │
│ Email    : budi@example.com      │ Dikonfirmasi    : 1 Trip            │
│ Status   : Repeat Customer ★     │ Selesai         : 2 Trip            │
├────────────────────────────────────────────────────────────────────────┤
│ CATATAN INTERNAL STAF (ADMIN NOTES)                                    │
│ [Textarea: Menyukai hotel view pantai. Penjemputan langganan stasiun]  │
│ [Simpan Catatan]                                                       │
├────────────────────────────────────────────────────────────────────────┤
│ TABEL RIWAYAT RESERVASI WISATAWAN                                      │
│ Kode        Paket            Tgl Trip     Pax   Status        Aksi     │
│ RES-000125  Green Canyon VIP 20 Sep 2026  4 pax COMPLETED     [Detail] │
│ RES-000187  Nuansa Budaya    03 Okt 2026  6 pax CONFIRMED     [Detail] │
└────────────────────────────────────────────────────────────────────────┘
```

### 6.3 Tindakan Operasional Cepat
- Tombol **"Chat via WhatsApp"**: Membuka tautan langsung `https://wa.me/628xxx` tanpa perlu menyimpan kontak ke ponsel staf terlebih dahulu.
- Tombol **"Lihat Reservasi"**: Mengarahkan langsung ke halaman rincian reservasi `/admin/reservations/{id}`.

### 6.4 Status Antarmuka (*Interface States*)
- **Loading State**: Menampilkan animasi skeleton tabel saat data pelanggan sedang di-fetch.
- **Empty State**: Menampilkan ilustrasi bersih dan pesan informatif saat belum ada customer atau hasil pencarian tidak ditemukan:
  > *"Belum ada data pelanggan yang cocok. Data pelanggan akan otomatis terisi saat ada reservasi masuk atau ditambahkan secara manual."*
- **Error State**: Menampilkan pesan galat ramah pengguna disertai tombol aksi *"Coba Lagi"*.

---

# 7. Keamanan Data, Hak Akses, & Privasi (*PII*)

### 7.1 Kebijakan Akses Berwenang (*Role-Based Access*)
- Data pelanggan tergolong Informasi Privat yang Dapat Diidentifikasi (*Personally Identifiable Information / PII*).
- Seluruh endpoint dan tampilan data customer hanya dapat diakses oleh staf internal yang terotentikasi di Admin CMS.

### 7.2 Isolasi API Publik (*Zero Exposure*)
- **Dilarang keras** menyediakan endpoint publik yang dapat menampilkan daftar pelanggan, detail kontak, email, ataupun riwayat perjalanan.
- Respon JSON dari pengiriman formulir reservasi publik **hanya mengembalikan kode reservasi publik**, tanpa menyertakan objek utuh `Customer` atau `admin_notes`.

### 7.3 Integritas Relasional & Proteksi Penghapusan (*Foreign Key Safety*)
- Tabel `reservations` memiliki relasi foreign key `customer_id` ke `customers.id`.
- **Proteksi Hapus Data Master**:
  - Dilarang keras melakukan penghapusan fisik (*hard delete*) pada data customer yang telah memiliki histori transaksi reservasi.
  - Hal ini guna mencegah terjadinya baris transaksi yatim piatu (*broken orphan records*) dan menjaga kepatuhan pembukuan operasional.
  - Jika pelanggan tidak aktif, staf dapat memberikan catatan status atau mengarsipkan profil tanpa merusak relasi transaksi.

### 7.4 Sanitasi Input & Kebijakan Logging Bersih
- Seluruh input form (`name`, `admin_notes`) wajib disanitasi terhadap potensi serangan XSS dan SQL Injection.
- **Logging Hygiene**: Log sistem dan error tracker server dilarang mencatat data kontak pribadi (nomor telepon dan email pelanggan) dalam format teks terbuka tanpa masking.

---

# 8. Daftar Periksa Kesiapan Manajemen Pelanggan (*Acceptance Checklist*)

### 8.1 Daftar Master & Pencarian
- [ ] Admin dapat melihat seluruh daftar pelanggan dengan paginasi (20 item per halaman).
- [ ] Kolom menampilkan nama, nomor WhatsApp, email, saluran akuisisi, total reservasi, dan tanggal pendaftaran.
- [ ] Pencarian instan berfungsi untuk nama, nomor telepon (format `08` maupun `62`), email, dan kode pelanggan.
- [ ] Filter berdasarkan saluran asal (*source*) dan status loyalitas (Semua, Baru, Repeat) berjalan akurat.
- [ ] Pengurutan tabel (Paling baru, paling lama, abjad, dan trip terbanyak) berfungsi baik.

### 8.2 Halaman Detail & Riwayat Transaksi
- [ ] Halaman profil `/admin/customers/{id}` menyajikan ringkasan lengkap data pribadi dan statistik trip.
- [ ] Riwayat reservasi tertata rapi dalam tabel terurut kronologis (terbaru di atas).
- [ ] Setiap baris riwayat reservasi dapat diklik menuju detail reservasi terkait.
- [ ] Badge *Repeat Customer* muncul secara otomatis jika reservasi > 1.
- [ ] Tombol pintas chat WhatsApp menghasilkan URL valid `https://wa.me/628xxx`.

### 8.3 Pembuatan & Pembaruan Data
- [ ] Reservasi publik otomatis membuat atau mengaitkan data customer secara atomik (`DB::transaction`).
- [ ] Normalisasi nomor telepon otomatis mengonversi variasi pengetikan ke format `628xxx`.
- [ ] Admin dapat membuat data customer baru secara manual dengan saluran asal yang dapat dipilih.
- [ ] Peringatan nomor ganda muncul jika admin memasukkan nomor telepon yang sudah ada di database.
- [ ] Admin dapat memperbarui profil dan catatan privat (*admin notes*).

### 8.4 Keamanan, Integritas Relasi, & Privasi
- [ ] Tidak ada endpoint publik yang mengekspos data pribadi pelanggan.
- [ ] Customer yang memiliki riwayat reservasi dilindungi dari penghapusan fisik (*hard delete*).
- [ ] Foreign key `customer_id` pada tabel `reservations` tervalidasi dan konsisten.
- [ ] Logging aplikasi mematuhi kaidah privasi data (*clean logging hygiene*).

---

# 9. Aturan Implementasi Pengembang & AI Agent

1. **Pisahkan Entity Customer dan Reservation**: Jangan pernah menyimpan nama/telepon hanya sebagai teks lepas pada tabel reservasi tanpa menautkannya ke model `Customer`.
2. **Nomor WhatsApp sebagai Kunci Pencocokan**: Gunakan nomor telepon yang dinormalisasi sebagai acuan deduplikasi pelanggan. Jangan menduplikasi berdasarkan kecocokan nama semata.
3. **Pemisahan Sumber Akuisisi dan Transaksi**: Sumber awal pelanggan (`customer.source_id`) merepresentasikan saluran pertama mereka mengenal bisnis, sedangkan `reservation.source_id` merepresentasikan saluran pengiriman pemesanan tertentu.
4. **Kalkulasi Agregasi Dinamis**: Hitung total transaksi, status loyalitas repeat customer, dan riwayat trip secara langsung melalui relasi Eloquent (`withCount('reservations')`), bukan dengan membuat kolom penanda manual yang rentan tidak sinkron.
5. **Dilarang Memalsukan Data (*No Fake Data in Production*)**: Dilarang membuat data profil customer fiktif atau klaim metrik palsu di lingkungan produksi. Seluruh pengujian wajib menggunakan database seeder di lingkungan lokal (*local development*).

---

# 10. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) — Gambaran umum dan tujuan bisnis platform Puja Tour Travel
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) — Kebutuhan bisnis, aturan data, dan katalog *BR*
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) — Rute navigasi halaman `/admin/customers` dan detail profil
- [04-ui-ux-guidelines.md](file:///c:/laragon/www/pujatourtravel.com/docs/04-ui-ux-guidelines.md) — Panduan desain tabel admin, lencana status, dan modal
- [05-public-website.md](file:///c:/laragon/www/pujatourtravel.com/docs/05-public-website.md) — Titik tangkap calon pelanggan dari formulir website publik
- [06-admin-cms.md](file:///c:/laragon/www/pujatourtravel.com/docs/06-admin-cms.md) — Spesifikasi modul manajemen pelanggan pada dashboard admin
- [07-reservation-system.md](file:///c:/laragon/www/pujatourtravel.com/docs/07-reservation-system.md) — Logika pencocokan pelanggan saat reservasi masuk (*matching logic*)
- `09-database.md` — Definisi skema tabel `customers`, relasi foreign key, indeks, dan migrasi Laravel
- `10-security.md` — Kebijakan perlindungan data privat pelanggan (*PII*) dan otorisasi sesi admin
