# Deployment & Production Infrastructure Specification

> Dokumen spesifikasi arsitektur infrastruktur produksi, manajemen lingkungan (*environment*), alur rilis aplikasi (*deployment pipeline*), pengerasan keamanan server, strategi pencadangan (*backup & recovery*), serta pemantauan sistem Puja Tour Travel.

---

## 1. Pendahuluan & Sasaran Deployment

Dokumen ini mendefinisikan standar operasional dan teknis untuk memindahkan aplikasi Puja Tour Travel dari lingkungan pengembangan (*development*) ke lingkungan produksi (*production*) secara aman, stabil, dan terprediksi.

### 1.1 Empat Pilar Utama Deployment
Aktivitas deployment berpegang teguh pada empat pilar:
1. **Reliability (Keandalan)**: Aplikasi berjalan stabil tanpa memicu error fatal atau gangguan layanan bagi pengunjung dan admin.
2. **Security (Keamanan)**: Server, basis data, dan berkas konfigurasi diamankan dari akses publik yang tidak berwenang.
3. **Repeatability (Dapat Diulang)**: Setiap tahap rilis memiliki langkah baku yang terdokumentasi dan dapat direproduksi secara konsisten.
4. **Recoverability (Pemulihan Cepat)**: Jika terjadi insiden atau kegagalan rilis, sistem memiliki prosedur pemulihan (*disaster recovery*) dan *rollback* yang jelas.

### 1.2 Target Arsitektur MVP (Pragmatis)
Untuk skala bisnis awal (*Small-Medium Enterprise*), arsitektur dirancang efisien dan mandiri tanpa kompleksitas berlebih (*no over-engineering*):
- **Tunggal VPS (Virtual Private Server)**: Menjalankan Nginx, PHP-FPM, MySQL 8, dan penyimpanan media lokal dalam satu lingkungan terisolasi yang terkelola dengan baik.
- Menghindari penggunaan orkestrasi rumit (seperti Kubernetes atau arsitektur *microservices*) sebelum kapasitas lalu lintas dan kebutuhan bisnis menuntutnya.

```text
Pengunjung / Admin
       │
       ▼
Domain & DNS (Cloudflare / Registrar)
       │ (Port 80 / 443 HTTPS)
       ▼
VPS Firewall (UFW: 80, 443, Custom SSH)
       │
       ▼
Reverse Proxy & Web Server (Nginx)
  ├── Static Assets Cache & Media Storage (storage/app/public)
  └── FastCGI Pass (127.0.0.1:9000 / unix socket)
       │
       ▼
Application Runtime (PHP 8.4.25+ / Laravel Framework)
  ├── Process Manager (Systemd Queue Worker)
  ├── Background Scheduler (Cron: php artisan schedule:run)
  └── Internal Data Access
       │
       ▼
Database Server (MySQL 8.0 - Localhost Only)
```

---

## 2. Pemisahan Lingkungan (*Environment Separation*)

Sistem mengadopsi pemisahan lingkungan yang ketat untuk mencegah kontaminasi data dan kegagalan sistem.

| Lingkungan | Fungsi Utama | Karakteristik & Aturan |
| :--- | :--- | :--- |
| **Development** | Tempat penulisan kode, penambahan fitur, dan perbaikan *bug*. | - Menggunakan lingkungan lokal (Laragon / PHP CLI lokal).<br>- `APP_ENV=local`, `APP_DEBUG=true`.<br>- Menggunakan data tiruan (*factory/seeder*).<br>- **Dilarang keras** menggunakan kredensial atau basis data riil produksi. |
| **Testing / Staging** | Verifikasi rilis, pengujian integrasi, dan uji regresi sebelum rilis publik. | - Menyerupai lingkungan produksi (*production-like*).<br>- `APP_ENV=staging`, `APP_DEBUG=false`.<br>- Menggunakan basis data terpisah dengan data sintetis representatif. |
| **Production** | Lingkungan aktif yang digunakan langsung oleh pelanggan dan staf admin. | - `APP_ENV=production`, `APP_DEBUG=false`.<br>- Wajib menggunakan domain resmi, sertifikat SSL/TLS valid.<br>- Kredensial rahasia diisolasi ketat dalam file `.env` produksi. |

> [!CAUTION]
> Jangan pernah mengimpor atau menggunakan data pribadi pelanggan dari basis data produksi ke dalam lingkungan *development* atau mesin lokal developer!

---

## 3. Infrastruktur & Jaringan Produksi

### 3.1 Domain & DNS
Domain resmi bisnis dikontrol dan dimiliki langsung oleh manajemen Puja Tour Travel. Tim teknis membantu pengelolaan rekaman (*DNS records*):
- **Root Domain (`example.com`)**: Diarahkan ke alamat IP publik VPS menggunakan **A Record**.
- **Subdomain WWW (`www.example.com`)**: Diarahkan ke root domain menggunakan **CNAME Record** atau A Record.
- **Kebijakan Canonical Domain**: Tetapkan satu format resmi (disarankan non-WWW: `https://example.com`), dan lakukan redirect HTTP 301 otomatis untuk variasi `http://`, `http://www.`, dan `https://www.`.
- **Propagasi DNS**: Selalu perhitungkan waktu propagasi DNS (antara 15 menit hingga 24 jam) saat melakukan perubahan nameserver atau IP server.

### 3.2 Sertifikat SSL / TLS (HTTPS)
- Seluruh lalu lintas web wajib menggunakan enkripsi **TLS 1.2 / TLS 1.3**.
- Menggunakan sertifikat gratis terpercaya dari **Let's Encrypt** melalui *Certbot*, atau sertifikat Edge SSL melalui Cloudflare.
- Pasang mekanisme pembaruan otomatis (*auto-renewal*) via cron/systemd timer:
  ```bash
  certbot renew --dry-run
  ```
- **Pencegahan Mixed Content**: Pastikan semua aset gambar, stylesheet, dan skrip dimuat secara absolut melalui protokol `https://` atau path relatif.

### 3.3 Konfigurasi Reverse Proxy (Nginx)
Nginx bertindak sebagai web server garda depan (*reverse proxy*) yang menangani terminasi SSL, penyajian berkas statis, kompresi gzip, dan pembatasan akses direktori sensitif.

Contoh konfigurasi Nginx untuk Laravel (`/etc/nginx/sites-available/pujatourtravel.conf`):

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name pujatourtravel.com www.pujatourtravel.com;
    return 301 https://pujatourtravel.com$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name www.pujatourtravel.com;

    ssl_certificate /etc/letsencrypt/live/pujatourtravel.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/pujatourtravel.com/privkey.pem;

    return 301 https://pujatourtravel.com$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name pujatourtravel.com;

    root /var/www/pujatourtravel/public;
    index index.php index.html;

    # SSL Security Headers
    ssl_certificate /etc/letsencrypt/live/pujatourtravel.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/pujatourtravel.com/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    charset utf-8;
    client_max_body_size 12M;

    # Logging
    access_log /var/log/nginx/pujatourtravel_access.log;
    error_log /var/log/nginx/pujatourtravel_error.log warn;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Static Assets Caching
    location ~* \.(jpg|jpeg|png|gif|ico|webp|svg|css|js|woff|woff2|ttf)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
        access_log off;
        log_not_found off;
    }

    # PHP-FPM FastCGI
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock; # Sesuaikan dengan versi PHP server
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    # Blokir akses ke berkas sensitif / hidden files (.env, .git)
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 4. Alur & Urutan Rilis Produksi (*Deployment Sequence*)

Setiap rilis versi baru ke server produksi harus mengikuti tahapan standar untuk meminimalkan waktu henti (*downtime*) dan mencegah kerusakan data.

```text
[1. Commit / Tag] ──► [2. Database Backup] ──► [3. Git Pull] ──► [4. Composer --no-dev]
                                                                          │
[8. Live / Smoke] ◄── [7. Restart FPM/Queue] ◄── [6. Artisan Cache] ◄── [5. Migrate & Build]
```

### 4.1 Prosedur Eksekusi Deployment
Jalankan langkah-langkah berikut di terminal server (menggunakan user deployer/sudo non-root):

```bash
# 1. Pindah ke direktori aplikasi
cd /var/www/pujatourtravel

# 2. Aktifkan Maintenance Mode (Opsional untuk rilis dengan migrasi berisiko)
php artisan down --secret="pujarelease2026"

# 3. Pencadangan Basis Data Cepat (Pre-release Backup)
mysqldump -u puja_user -p puja_db | gzip > /var/backups/pujatourtravel/db_pre_deploy_$(date +%Y%m%d_%H%M%S).sql.gz

# 4. Ambil kode terbaru dari Git branch utama
git fetch origin main
git reset --hard origin/main

# 5. Instalasi dependensi PHP produksi (tanpa dev package, dengan autoloader optimal)
composer install --no-dev --optimize-autoloader --no-interaction

# 6. Kompilasi aset frontend produksi
npm ci
npm run build

# 7. Eksekusi migrasi basis data
php artisan migrate --force

# 8. Optimasi dan caching konfigurasi Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 9. Pastikan symbolic link storage publik terpasang
php artisan storage:link

# 10. Restart PHP-FPM & Antrean Worker
sudo systemctl restart php8.2-fpm
php artisan queue:restart

# 11. Matikan Maintenance Mode (Sistem kembali online)
php artisan up

# 12. Validasi status kesehatan aplikasi
curl -I https://pujatourtravel.com/health
```

---

## 5. Konfigurasi Lingkungan Produksi (`.env`)

File `.env` di server produksi dikelola secara manual dan terisolasi. Kredensial rahasia tidak boleh tersimpan dalam repositori Git.

### 5.1 Parameter Kritis `.env` Produksi
```env
# Identitas Aplikasi & URL
APP_NAME="Puja Tour Travel"
APP_ENV=production
APP_KEY=base64:GENERATE_VIA_KEY_GENERATE_CMD
APP_DEBUG=false
APP_URL=https://pujatourtravel.com

# Manajemen Log
LOG_CHANNEL=daily
LOG_LEVEL=warning
LOG_DEPRECATIONS_CHANNEL=null

# Koneksi Basis Data Produksi (Dedicated User, Bukan Root)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=puja_production_db
DB_USERNAME=puja_app_user
DB_PASSWORD=Gunakan_Password_Acak_32_Karakter_Kuat!

# Keamanan Sesi & Cookie
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

# Antrean & Cache
QUEUE_CONNECTION=database
CACHE_STORE=database

# Konfigurasi Mailer (Notifikasi Reservasi)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@pujatourtravel.com
MAIL_PASSWORD=rahasia_smtp_key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@pujatourtravel.com"
MAIL_FROM_NAME="${APP_NAME}"

# Integrasi Eksternal Bisnis
WHATSAPP_PHONE="6281234567890"
GOOGLE_MAPS_EMBED_URL="https://www.google.com/maps/embed?..."
GOOGLE_MAPS_PLACE_URL="https://maps.google.com/..."
GA_MEASUREMENT_ID="G-XXXXXXXXXX"
```

> [!IMPORTANT]
> - `APP_DEBUG` wajib bernilai `false`. Kebocoran layar *debug* di produksi dapat membongkar seluruh kunci rahasia dan struktur basis data kepada publik.
> - Berikan hak akses terbatas pada file `.env`: `chmod 600 .env` dan pastikan pemiliknya adalah user aplikasi server.

---

## 6. Manajemen Proses & Layanan Server

### 6.1 Laravel Queue Worker (Systemd Service)
Layanan latar belakang untuk pengiriman email dan pemrosesan antrean dikelola oleh systemd agar otomatis *restart* saat server *reboot* atau terjadi *crash*.

Buat berkas unit `/etc/systemd/system/pujatour-queue.service`:
```ini
[Unit]
Description=Puja Tour Travel Queue Worker
After=network.target mysql.service

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/pujatourtravel/artisan queue:work database --sleep=3 --tries=3 --max-time=3600
RestartSec=5s

[Install]
WantedBy=multi-user.target
```

Aktifkan layanan:
```bash
sudo systemctl daemon-reload
sudo systemctl enable --now pujatour-queue.service
sudo systemctl status pujatour-queue.service
```

### 6.2 Laravel Task Scheduler (Crontab)
Penjadwal tugas bawaan Laravel (pembersihan token kadaluarsa, backup otomatis, agregasi statistik) didaftarkan pada crontab sistem:

```bash
# Buka crontab milik user web server (www-data)
sudo crontab -u www-data -e

# Tambahkan baris berikut (dijalankan setiap menit)
* * * * * cd /var/www/pujatourtravel && php artisan schedule:run >> /dev/null 2>&1
```

---

## 7. Pengerasan Keamanan Server (*Server Hardening*)

### 7.1 Firewall (UFW)
Hanya port layanan publik dan SSH yang diizinkan masuk dari internet:
```bash
# Default deny incoming, allow outgoing
sudo ufw default deny incoming
sudo ufw default allow outgoing

# Izinkan HTTP, HTTPS, dan Port SSH khusus
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw allow 22/tcp  # Disarankan ganti ke custom port (misal: 2222/tcp)

# Aktifkan firewall
sudo ufw enable
```
*Port MySQL (3306) tidak boleh dibuka ke publik; MySQL hanya merespons koneksi lokal `127.0.0.1`.*

### 7.2 Pengerasan Akses SSH
Edit konfigurasi `/etc/ssh/sshd_config`:
```ini
# Nonaktifkan autentikasi password (hanya izinkan SSH Key)
PasswordAuthentication no
PubkeyAuthentication yes

# Nonaktifkan login langsung user root
PermitRootLogin no

# Batasi jumlah percobaan login
MaxAuthTries 3
```
Terapkan perubahan dengan `sudo systemctl restart sshd`.

### 7.3 Izin Berkas & Direktori (*Permissions*)
Pastikan hak akses berkas diatur dengan prinsip *least privilege*:
```bash
cd /var/www/pujatourtravel

# Set kepemilikan ke user deployer dan grup web server
sudo chown -R deployer:www-data .

# Set izin direktori 755 dan berkas 644
sudo find . -type d -exec chmod 755 {} \;
sudo find . -type f -exec chmod 644 {} \;

# Berikan izin tulis grup ke direktori writable
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

---

## 8. Strategi Pencadangan (*Backup*) & Pemulihan Bencana (*Restore*)

### 8.1 Kebijakan Cadangan (Backup Policy)
1. **Basis Data (MySQL)**:
   - Dilakukan setiap hari pukul 02:00 WIB secara otomatis melalui skrip cron.
   - Menggunakan format terkompresi `.sql.gz`.
   - **Skema Retensi**:
     - Harian: Disimpan selama 7 hari terakhir.
     - Mingguan: Disimpan selama 4 minggu terakhir.
     - Bulanan: Disimpan selama 3 bulan terakhir.
2. **Berkas Media Publik (`storage/app/public/media`)**:
   - Dilakukan pencadangan inkremental mingguan menggunakan `rsync` atau `tar`.

### 8.2 Skrip Otomatisasi Backup Basis Data
File `/usr/local/bin/backup-pujadb.sh`:
```bash
#!/bin/bash
BACKUP_DIR="/var/backups/pujatourtravel/db"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="puja_production_db"
DB_USER="puja_backup_user"
DB_PASS="password_khusus_backup"

mkdir -p "$BACKUP_DIR"

# Ekspor dan kompresi basis data
mysqldump -u "$DB_USER" -p"$DB_PASS" --single-transaction --quick "$DB_NAME" | gzip > "$BACKUP_DIR/${DB_NAME}_${DATE}.sql.gz"

# Hapus cadangan harian yang lebih lama dari 7 hari
find "$BACKUP_DIR" -type f -name "*.sql.gz" -mtime +7 -delete
```

### 8.3 Prosedur Pemulihan Basis Data (*Restore Procedure*)
Jika terjadi kegagalan sistem atau korupsi data:
```bash
# 1. Posisikan website dalam maintenance mode
php artisan down --message="Sedang dilakukan pemulihan basis data."

# 2. Ekstrak dan masukkan cadangan SQL ke basis data
gunzip < /var/backups/pujatourtravel/db/puja_production_db_20260906_020000.sql.gz | mysql -u puja_app_user -p puja_production_db

# 3. Bersihkan cache aplikasi
php artisan cache:clear
php artisan config:cache

# 4. Buka kembali akses website
php artisan up
```

---

## 9. Prosedur Rollback & Rencana Kontinjensi

Jika rilis baru menimbulkan kegagalan fatal pada fungsi reservasi atau crash pada aplikasi:

```text
Insiden Rilis Terdeteksi
       │
       ▼
Aktifkan Maintenance Mode (php artisan down)
       │
       ▼
Periksa Penyebab: Kode Aplikasi vs Migrasi Basis Data?
       │
       ├── Jika hanya masalah kode aplikasi:
       │   ├── Git checkout ke tag/commit stabil sebelumnya (git checkout v1.0.1)
       │   ├── composer install --no-dev && npm run build
       │   ├── php artisan cache:clear && php artisan optimize
       │   └── Restart PHP-FPM
       │
       └── Jika melibatkan migrasi basis data yang merusak data:
           ├── WARNING: Jangan rollback migrasi sembarangan jika kolom/tabel telah dihapus!
           ├── Putuskan apakah fix-forward lebih cepat atau restore backup pre-deploy.
           └── Lakukan restore basis data dari file pre-deploy jika tidak ada alternatif lain.
       │
       ▼
Verifikasi Smoke Test & Buka Aplikasi (php artisan up)
```

---

## 10. Pemantauan & Pemeliharaan Pasca-Rilis (*Monitoring*)

### 10.1 Endpoint Pemeriksaan Kesehatan (*Health Check*)
Aplikasi menyediakan endpoint ringan `GET /health` yang digunakan oleh layanan *uptime monitoring* (misal: UptimeRobot / BetterStack) untuk mengecek ketersediaan server:
- **Respon Sukses (HTTP 200)**:
  ```json
  {
    "status": "ok",
    "timestamp": "2026-09-06T12:00:00Z",
    "services": {
      "database": "connected",
      "storage": "writable"
    }
  }
  ```
- *Catatan: Endpoint ini tidak boleh membocorkan informasi sensitif seperti versi server, password, atau struktur direktori.*

### 10.2 Pemantauan Sumber Daya Server
Secara berkala pantau metrik server:
- **Disk Space (`df -h`)**: Pastikan penggunaan disk tidak melebihi 80%. Disk penuh dapat menghentikan penulisan log, unggahan gambar paket, dan transaksi basis data.
- **Memori & CPU (`htop` / `top`)**: Awasi konsumsi memori proses PHP-FPM dan MySQL.
- **Log Errors**: Periksa log aplikasi di `storage/logs/laravel.log` dan log web server di `/var/log/nginx/pujatourtravel_error.log`.

---

## 11. Daftar Periksa Kesiapan Rilis (*Acceptance Checklist*)

### 11.1 Checklist Pra-Rilis (*Pre-Deployment*)
- [ ] Seluruh fitur baru telah lulus pengujian lokal dan *code review*.
- [ ] File konfigurasi `.env` produksi telah diverifikasi (`APP_DEBUG=false`, `APP_ENV=production`).
- [ ] Backup basis data pra-rilis (*pre-deploy snapshot*) telah dieksekusi dan diverifikasi.
- [ ] Migrasi basis data yang akan dijalankan bersifat *backward-compatible* dan tidak menghapus data esensial tanpa verifikasi.
- [ ] Domain aktif, sertifikat SSL valid, dan rekaman DNS mengarah ke IP yang benar.

### 11.2 Checklist Pengujian Pasca-Rilis (*Smoke Testing*)
- [ ] **Sertifikat & Redirect**: Halaman `http://` otomatis dialihkan ke `https://` tanpa *mixed content warning*.
- [ ] **Ketersediaan Publik**: Beranda utama, daftar paket wisata, dan halaman detail paket dapat dibuka dengan cepat.
- [ ] **Aset Statis & Media**: Gambar destinasi, logo, dan thumbnail ter-load sempurna dari media storage publik.
- [ ] **Alur Reservasi**: Formulir pemesanan paket dapat diisi dan sukses tersimpan ke basis data.
- [ ] **Login & Admin CMS**: Panel admin (`/admin/login`) dapat diakses, autentikasi bekerja normal, dan proteksi CSRF aktif.
- [ ] **Integrasi Eksternal**: Tombol *Chat WhatsApp* mengarah ke nomor resmi dengan parameter teks yang tepat; widget Google Maps tampil normal.
- [ ] **Status Antrean**: Background queue worker berstatus aktif (`systemctl status pujatour-queue`).
- [ ] **Pembersihan Cache**: Seluruh tampilan publik menampilkan konten dan harga paket terbaru sesuai basis data.

---

## 12. Aturan Implementasi Pengembang & AI Agent

Bagi pengembang maupun AI Coding Assistant yang bekerja dalam repositori ini:
1. **Dilarang Menjalankan Server Development di Produksi**: Jangan pernah mengeksekusi `php artisan serve` atau `npm run dev` sebagai layanan produksi.
2. **Dilarang Menyimpan File `.env` ke Git**: File `.env` wajib berada dalam `.gitignore`. Jangan pernah memasukkan file kredensial asli ke repositori.
3. **Wajib Selalu Menggunakan Migrasi**: Segala perubahan struktur basis data harus melalui file migrasi Laravel versioned, bukan mengeksekusi query DDL manual di server.
4. **Wajib Menjalankan Backup Sebelum Migrasi Berisiko**: Lakukan dump basis data sebelum menjalankan migrasi yang mengubah tipe data atau indeks besar.
5. **Dilarang Menjalankan Seeder Data Dummy di Produksi**: Perintah `php artisan db:seed` atau `migrate:fresh` **dilarang keras** dijalankan di lingkungan produksi.
6. **Pastikan Mode Debug Nonaktif**: Nilai `APP_DEBUG` wajib `false`. Jika terjadi error, tampilkan halaman error ramah pengguna (HTTP 500 generik) dan periksa detailnya melalui file log server.
7. **Isolasi Port Basis Data**: Port MySQL (3306) tidak boleh dibuka ke jaringan publik. Akses remote hanya diizinkan via SSH Tunneling jika diperlukan.
8. **Optimasi Wajib Saat Deploy**: Selalu jalankan `php artisan config:cache`, `route:cache`, dan `view:cache` setelah proses instalasi dependensi dan migrasi.
9. **Pastikan Symbolic Link Storage Terhubung**: Verifikasi bahwa `public/storage` mengarah ke `storage/app/public` melalui `php artisan storage:link`.
10. **Periksa Izin Akses Direktori**: Pastikan user web server (`www-data`) memiliki izin tulis penuh pada folder `storage/` dan `bootstrap/cache/`.

---

## 13. Dokumen Terkait

- [01-project-overview.md](file:///c:/laragon/www/pujatourtravel.com/docs/01-project-overview.md) - Gambaran Umum Proyek & Spesifikasi Teknis
- [02-business-requirements.md](file:///c:/laragon/www/pujatourtravel.com/docs/02-business-requirements.md) - Kebutuhan Bisnis & Aturan Validasi
- [03-sitemap-and-pages.md](file:///c:/laragon/www/pujatourtravel.com/docs/03-sitemap-and-pages.md) - Struktur Halaman & Navigasi
- [04-ui-ux-guidelines.md](file:///c:/laragon/www/pujatourtravel.com/docs/04-ui-ux-guidelines.md) - Panduan Desain & Standar Antarmuka
- [05-public-website.md](file:///c:/laragon/www/pujatourtravel.com/docs/05-public-website.md) - Arsitektur Website Publik
- [06-admin-cms.md](file:///c:/laragon/www/pujatourtravel.com/docs/06-admin-cms.md) - Panel Pengelolaan Konten (Admin CMS)
- [07-reservation-system.md](file:///c:/laragon/www/pujatourtravel.com/docs/07-reservation-system.md) - Alur & Mesin Pemesanan Paket
- [08-customer-management.md](file:///c:/laragon/www/pujatourtravel.com/docs/08-customer-management.md) - Manajemen Data Pelanggan & Riwayat
- [09-database.md](file:///c:/laragon/www/pujatourtravel.com/docs/09-database.md) - Skema Basis Data & Migrasi Eloquent
- [10-security.md](file:///c:/laragon/www/pujatourtravel.com/docs/10-security.md) - Standar Keamanan Aplikasi & Autentikasi
- [11-seo-and-analytics.md](file:///c:/laragon/www/pujatourtravel.com/docs/11-seo-and-analytics.md) - Strategi SEO & Analitik
- [12-integration.md](file:///c:/laragon/www/pujatourtravel.com/docs/12-integration.md) - Integrasi Layanan Eksternal (WhatsApp & Maps)
- **13-deployment.md** - Spesifikasi Infrastruktur & Panduan Deployment *(Dokumen ini)*
- [14-testing.md](file:///c:/laragon/www/pujatourtravel.com/docs/14-testing.md) - Strategi Pengujian & QA *(Dokumen Berikutnya)*
- [15-project-scope.md](file:///c:/laragon/www/pujatourtravel.com/docs/15-project-scope.md) - Ruang Lingkup Proyek & Batasan Rilis
