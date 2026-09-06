# PUJA TOUR TRAVEL

Website informasi, promosi, paket wisata, dan reservasi
untuk Puja Tour Travel, Pangandaran.

---

## PROJECT DOCUMENTATION

Dokumentasi proyek dibagi menjadi beberapa dokumen agar requirement
lebih terstruktur dan mudah digunakan selama proses development.

### Core Documentation

- [Project Overview](docs/01-project-overview.md)
- [Business Requirements](docs/02-business-requirements.md)
- [Sitemap & Pages](docs/03-sitemap-and-pages.md)
- [UI/UX Guidelines](docs/04-ui-ux-guidelines.md)

### Website

- [Public Website](docs/05-public-website.md)
- [Admin CMS](docs/06-admin-cms.md)
- [Reservation System](docs/07-reservation-system.md)
- [Customer Management](docs/08-customer-management.md)

### Technical

- [Database](docs/09-database.md)
- [Security](docs/10-security.md)
- [SEO & Analytics](docs/11-seo-and-analytics.md)
- [Integration](docs/12-integration.md)
- [Deployment](docs/13-deployment.md)

### Quality & Scope

- [Testing](docs/14-testing.md)
- [Project Scope](docs/15-project-scope.md)

---

# IMPORTANT DEVELOPMENT RULES

## 1. Documentation Is the Source of Truth

Semua development harus mengikuti requirement
yang terdapat di folder `docs/`.

Jangan membuat fitur besar berdasarkan asumsi.

---

## 2. Read Relevant Documentation Before Coding

Sebelum mengerjakan suatu fitur:

1. Baca README.md.
2. Identifikasi dokumentasi yang relevan.
3. Periksa implementasi existing.
4. Gunakan component yang sudah tersedia.
5. Hindari duplicate implementation.
6. Implementasikan sesuai requirement.

---

## 3. Do Not Overengineer

Project ini ditujukan untuk bisnis travel skala kecil.

Prioritaskan:

- Simplicity
- Stability
- Maintainability
- Performance
- Security

Jangan membuat sistem enterprise yang tidak diperlukan.

---

## 4. CMS FIRST

Data bisnis harus berasal dari database/CMS.

Jangan hardcode:

- Paket wisata
- Harga
- Galeri
- Testimoni
- Nomor WhatsApp
- Social media
- Alamat
- Informasi kontak
- Konten homepage

---

## 5. NO FAKE BUSINESS DATA

Jangan mengarang:

- Legalitas
- Nomor izin
- Sertifikasi
- Nama guide
- Testimonial
- Harga
- Alamat
- Nomor WhatsApp
- Social media

Jika data belum diberikan:

`[DATA BELUM TERSEDIA]`

---

## 6. MOBILE FIRST

Semua halaman wajib responsive.

Prioritas:

Mobile → Tablet → Desktop

---

## 7. SECURITY

Jangan:

- Commit `.env`
- Hardcode API keys
- Hardcode database credentials
- Menyimpan password plain text
- Menampilkan error database ke user

---

## 8. CODE QUALITY

Gunakan:

- Reusable components
- Meaningful naming
- Clean architecture
- Server-side validation
- Database migrations
- Proper error handling

Hindari:

- Duplicate code
- Giant components
- Hardcoded business data
- Unnecessary dependencies

---

# DEVELOPMENT PRIORITY

Urutan pengerjaan:

1. Project setup
2. Database
3. Authentication
4. Design system
5. Public website
6. CMS
7. Package management
8. Reservation
9. Customer management
10. Integration
11. SEO
12. Testing
13. Deployment
14. Final QA

---

# FINAL GOAL

Build a production-ready website for Puja Tour Travel that is:

- Modern
- Professional
- Responsive
- Fast
- Secure
- Easy to manage
- CMS-driven
- Reservation-ready
- SEO-friendly
- Maintainable

The website should help convert visitors into
inquiries, reservations, and customers.