<!DOCTYPE html>
<html lang="id" class="scroll-smooth scroll-pt-24 sm:scroll-pt-28">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Kebijakan Privasi — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="Kebijakan Privasi resmi Puja Tour & Travel Pangandaran. Pelajari bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda saat menggunakan layanan kami.">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Kebijakan Privasi — Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Kebijakan Privasi resmi Puja Tour & Travel Pangandaran mengenai perlindungan dan keamanan data wisatawan.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): BreadcrumbList -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Beranda',
                'item' => url('/'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Kebijakan Privasi',
                'item' => url()->current(),
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>

    @include('partials.analytics')
</head>
<body class="bg-[#f8fafc] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white pt-20 sm:pt-24">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
        $companyName = $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN';
    @endphp

    <!-- STICKY NAVBAR -->
    <header id="main-header" class="sticky top-0 z-40 w-full bg-surface-soft/95 backdrop-blur-md transition-all duration-300 py-3.5 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                    <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-extrabold text-xl leading-tight tracking-tight text-slate-900 group-hover:text-emerald-700 transition">
                        PUJA<span class="text-emerald-700 ml-1">TOUR</span>
                    </span>
                    <span class="text-[10px] tracking-widest font-bold text-slate-500 uppercase">
                        & Travel Pangandaran
                    </span>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-7 font-medium text-slate-600 text-sm">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="hover:text-emerald-700 transition">Paket Wisata</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-700 transition">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="hover:text-emerald-700 transition">Estimasi Biaya</a>
                <a href="{{ route('gallery') }}" class="hover:text-emerald-700 transition">Galeri</a>
                <a href="{{ route('testimonial') }}" class="hover:text-emerald-700 transition">Ulasan</a>
                <a href="{{ route('faq') }}" class="hover:text-emerald-700 transition">FAQ</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak</a>
            </nav>

            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Drawer -->
    <div id="mobile-drawer" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden lg:hidden">
        <div class="fixed top-0 right-0 bottom-0 w-4/5 max-w-sm bg-white p-6 shadow-2xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-6 border-b border-neutral-200">
                    <span class="font-display font-bold text-lg text-slate-900">Menu Utama</span>
                    <button id="close-drawer-btn" class="p-2 text-slate-500 hover:text-slate-800">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <div class="py-6 flex flex-col gap-4 font-medium text-slate-700">
                    <a href="{{ route('home') }}" class="py-2 hover:text-emerald-700 transition">Beranda</a>
                    <a href="{{ route('packages.index') }}" class="py-2 hover:text-emerald-700 transition">Paket Wisata</a>
                    <a href="{{ route('about') }}" class="py-2 hover:text-emerald-700 transition">Tentang Kami</a>
                    <a href="{{ route('calculator') }}" class="py-2 hover:text-emerald-700 transition">Estimasi Biaya</a>
                    <a href="{{ route('gallery') }}" class="py-2 hover:text-emerald-700 transition">Galeri Foto</a>
                    <a href="{{ route('testimonial') }}" class="py-2 hover:text-emerald-700 transition">Ulasan Wisatawan</a>
                    <a href="{{ route('faq') }}" class="py-2 hover:text-emerald-700 transition">FAQ</a>
                    <a href="{{ route('contact') }}" class="py-2 hover:text-emerald-700 transition">Kontak</a>
                </div>
            </div>
            <div class="pt-6 border-t border-neutral-200 text-xs text-slate-400">
                &copy; {{ date('Y') }} {{ $companyName }}.
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="py-10 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                <span>/</span>
                <span class="text-slate-400">Legalitas & Kepatuhan</span>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Kebijakan Privasi</span>
            </nav>

            <!-- Header Title -->
            <div class="mb-12 border-b border-slate-200 pb-8">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold border border-slate-200 mb-4 shadow-2xs">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-700"></i>
                    <span>Kepatuhan UU No. 27 Tahun 2022 tentang Perlindungan Data Pribadi (UU PDP)</span>
                </div>
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 tracking-tight">
                    Kebijakan Privasi & Perlindungan Data Wisatawan
                </h1>
                <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
                    Transparansi penuh mengenai prinsip kami dalam mengumpulkan, mengelola, menjaga kerahasiaan, dan melindungi seluruh data pribadi wisatawan yang mempercayakan liburannya kepada <strong>{{ $companyName }}</strong>.
                </p>

                <!-- Document Meta Bar -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 pt-6 border-t border-slate-200 text-xs">
                    <div>
                        <span class="text-slate-600 block text-[11px] font-semibold">Status Dokumen</span>
                        <span class="font-bold text-slate-800">Resmi & Aktif Berlaku</span>
                    </div>
                    <div>
                        <span class="text-slate-600 block text-[11px] font-semibold">Terakhir Diperbarui</span>
                        <span class="font-bold text-slate-800">{{ date('d F Y') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-600 block text-[11px] font-semibold">Pengendali Data</span>
                        <span class="font-bold text-slate-800">{{ $companyName }}</span>
                    </div>
                    <div>
                        <span class="text-slate-600 block text-[11px] font-semibold">Wilayah Yurisdiksi</span>
                        <span class="font-bold text-slate-800">Hukum Republik Indonesia</span>
                    </div>
                </div>
            </div>

            <!-- Main Layout: 2 Columns (Sticky TOC on Desktop + Detailed Content) -->
            <div class="grid lg:grid-cols-12 gap-10 items-start">
                <!-- Left Sidebar: Quick Table of Contents & Quick Contact -->
                <aside class="lg:col-span-4 sticky top-24 space-y-6 hidden lg:block">
                    <!-- Table of Contents Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                        <div class="flex items-center gap-2 pb-4 mb-4 border-b border-slate-100 text-xs font-bold uppercase tracking-wider text-slate-800">
                            <i data-lucide="list" class="w-4 h-4 text-emerald-700"></i>
                            <span>Daftar Isi Kebijakan</span>
                        </div>
                        <nav class="space-y-1.5 text-xs text-slate-600">
                            <a href="#pasal-1" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">01</span>
                                <span class="truncate">Landasan Hukum & Ruang Lingkup</span>
                            </a>
                            <a href="#pasal-2" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">02</span>
                                <span class="truncate">Kategori Data yang Dikumpulkan</span>
                            </a>
                            <a href="#pasal-3" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">03</span>
                                <span class="truncate">Metode Pengumpulan Data</span>
                            </a>
                            <a href="#pasal-4" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">04</span>
                                <span class="truncate">Tujuan Pemrosesan Data</span>
                            </a>
                            <a href="#pasal-5" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">05</span>
                                <span class="truncate">Larangan Jual Beli Data</span>
                            </a>
                            <a href="#pasal-6" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">06</span>
                                <span class="truncate">Keamanan & Retensi Penyimpanan</span>
                            </a>
                            <a href="#pasal-7" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">07</span>
                                <span class="truncate">Dokumentasi Foto & Privasi Visual</span>
                            </a>
                            <a href="#pasal-8" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">08</span>
                                <span class="truncate">Kebijakan Cookie & Analitik</span>
                            </a>
                            <a href="#pasal-9" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">09</span>
                                <span class="truncate">Hak-Hak Subjek Data (UU PDP)</span>
                            </a>
                            <a href="#pasal-10" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">10</span>
                                <span class="truncate">Kontak Resmi & Pengajuan Hak</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Trust Highlights Box -->
                    <div class="bg-emerald-50/70 rounded-3xl p-6 border border-emerald-200/80 text-xs space-y-3.5">
                        <div class="flex items-center gap-2 text-emerald-900 font-bold">
                            <i data-lucide="lock" class="w-4 h-4 text-emerald-700"></i>
                            <span>Komitmen Privasi Utama</span>
                        </div>
                        <ul class="space-y-2 text-emerald-950/80 leading-relaxed">
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Zero Data Selling: Data tidak pernah dijual kepada pihak ketiga mana pun.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Hanya digunakan untuk tiket resmi, asuransi trip, dan briefing keselamatan.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Hak penarikan publikasi foto & penghapusan ulasan dijamin sepenuhnya.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Support Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 text-xs space-y-3">
                        <h4 class="font-display font-bold text-slate-900 text-sm">Butuh Bantuan Privasi?</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Hubungi tim operasional kami untuk pertanyaan data pribadi atau permintaan penghapusan data.
                        </p>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20mengenai%20kebijakan%20privasi" target="_blank" class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold flex items-center justify-center gap-2 transition shadow-xs">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Chat WhatsApp Hotline</span>
                        </a>
                    </div>
                </aside>

                <!-- Right Column: Detailed Clauses (Pasal-Pasal Lengkap & Rinci) -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- PASAL 1 -->
                    <article id="pasal-1" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                01
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 1</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Landasan Hukum & Ruang Lingkup Kebijakan</h2>
                            </div>
                        </header>
                        <p>
                            Kebijakan Privasi ini merupakan wujud komitmen nyata <strong>{{ $companyName }}</strong> (selanjutnya disebut "Perusahaan", "Kami", atau "Puja Tour") dalam mematuhi seluruh perundang-undangan perlindungan data yang berlaku di Negara Kesatuan Republik Indonesia, khususnya:
                        </p>
                        <ul class="space-y-2 text-slate-600 pl-2">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Undang-Undang Republik Indonesia Nomor 27 Tahun 2022</strong> tentang Pelindungan Data Pribadi (UU PDP).</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Undang-Undang Nomor 11 Tahun 2008</strong> jo. <strong>Undang-Undang Nomor 1 Tahun 2024</strong> tentang Informasi dan Transaksi Elektronik (UU ITE).</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Peraturan Pemerintah Nomor 71 Tahun 2019</strong> tentang Penyelenggaraan Sistem dan Transaksi Elektronik (PSTE).</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Regulasi teknis operasional biro perjalanan wisata dan standar keselamatan asuransi pariwisata Pangandaran.</span>
                            </li>
                        </ul>
                        <p class="text-slate-600">
                            Dalam konteks UU PDP, {{ $companyName }} bertindak sebagai <strong>Pengendali Data Pribadi <em>(Data Controller)</em></strong> yang bertanggung jawab penuh atas penentuan tujuan dan pelaksanaan pemrosesan data pribadi seluruh calon wisatawan, pelanggan rombongan, serta pengunjung situs web ini.
                        </p>
                    </article>

                    <!-- PASAL 2 -->
                    <article id="pasal-2" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                02
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 2</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Kategori Data Pribadi yang Kami Kumpulkan</h2>
                            </div>
                        </header>
                        <p>
                            Kami mengumpulkan data secara terbatas sesuai asas minimisasi data <em>(data minimization)</em>, hanya untuk data yang benar-benar esensial demi kelancaran reservasi, legalitas tiket, dan keselamatan trip Anda:
                        </p>

                        <div class="space-y-3.5 pt-2">
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-1">
                                <h3 class="font-bold text-slate-900 text-xs sm:text-sm flex items-center gap-2">
                                    <i data-lucide="user-check" class="w-4 h-4 text-slate-600"></i>
                                    A. Data Identitas Wisatawan
                                </h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Nama lengkap sesuai kartu identitas resmi (KTP/SIM/Paspor), tanggal lahir atau rentang usia (diwajibkan oleh perusahaan asuransi wisata), jenis kelamin, dan kota asal/domisili.
                                </p>
                            </div>

                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-1">
                                <h3 class="font-bold text-slate-900 text-xs sm:text-sm flex items-center gap-2">
                                    <i data-lucide="phone" class="w-4 h-4 text-slate-600"></i>
                                    B. Data Kontak & Komunikasi Lapangan
                                </h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Nomor telepon seluler / WhatsApp aktif penanggung jawab rombongan (Tour Leader / PIC), alamat email untuk pengiriman konfirmasi invoice/e-voucher, serta kontak darurat <em>(emergency contact)</em> keluarga yang dapat dihubungi saat situasi darurat.
                                </p>
                            </div>

                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-1">
                                <h3 class="font-bold text-slate-900 text-xs sm:text-sm flex items-center gap-2">
                                    <i data-lucide="activity" class="w-4 h-4 text-slate-600"></i>
                                    C. Informasi Kesiapan Fisik & Kondisi Medis Khusus
                                </h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Khusus untuk aktivitas petualangan berisiko sedang hingga tinggi (misalnya: <em>Body Rafting Green Canyon Full Track</em>, <em>River Tubing Santirah</em>, atau <em>Snorkeling Pasir Putih</em>), pemandu kami memerlukan informasi mengenai riwayat kesehatan khusus (seperti asma, riwayat jantung, epilepsi, kehamilan, cedera tulang) serta kemampuan berenang. Informasi ini semata-mata digunakan untuk menyiapkan perlengkapan keselamatan ekstra <em>(life jacket tipe tertentu)</em> dan penugasan personel pemandu <em>rescue</em> tambahan.
                                </p>
                            </div>

                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-1">
                                <h3 class="font-bold text-slate-900 text-xs sm:text-sm flex items-center gap-2">
                                    <i data-lucide="credit-card" class="w-4 h-4 text-slate-600"></i>
                                    D. Data Verifikasi Transaksi Pembayaran
                                </h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Salinan bukti transfer perbankan, nama pemilik rekening pengirim, dan tanggal transfer untuk verifikasi uang muka (down payment) atau pelunasan. <strong>Puja Tour tidak pernah mencatat, meminta, atau menyimpan data kartu kredit, nomor CVV, PIN ATM, atau kode OTP perbankan Anda.</strong>
                                </p>
                            </div>

                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-1">
                                <h3 class="font-bold text-slate-900 text-xs sm:text-sm flex items-center gap-2">
                                    <i data-lucide="message-square" class="w-4 h-4 text-slate-600"></i>
                                    E. Data Ulasan Wisatawan & Rating
                                </h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Nama, domisili, skor bintang, serta testimoni pengalaman trip yang Anda kirimkan secara sukarela melalui formulir ulasan di website.
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 3 -->
                    <article id="pasal-3" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                03
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 3</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Metode & Saluran Pengumpulan Data Pribadi</h2>
                            </div>
                        </header>
                        <p>Data pribadi dikumpulkan melalui saluran resmi berikut dengan persetujuan <em>(consent)</em> sadar dari wisatawan:</p>
                        <div class="grid sm:grid-cols-2 gap-3.5 pt-1 text-xs">
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block text-xs mb-1">1. Formulir Digital Website</strong>
                                <p class="text-slate-600 leading-relaxed">Pengisian kalkulator estimasi biaya, formulir reservasi online, dan formulir ulasan testimoni.</p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block text-xs mb-1">2. Percakapan WhatsApp Resmi</strong>
                                <p class="text-slate-600 leading-relaxed">Komunikasi konsultasi rencana paket, jadwal kedatangan, dan konfirmasi manifest peserta dengan Admin CS.</p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block text-xs mb-1">3. Kantor Fisik Operasional</strong>
                                <p class="text-slate-600 leading-relaxed">Registrasi dan verifikasi kedatangan langsung di kantor Puja Tour Pangandaran sebelum keberangkatan trip.</p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block text-xs mb-1">4. Log Teknis Anonim</strong>
                                <p class="text-slate-600 leading-relaxed">Pengumpulan otomatis alamat IP tersamarkan dan informasi peramban web untuk analisis teknis server.</p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 4 -->
                    <article id="pasal-4" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                04
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 4</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Tujuan Pemrosesan & Pemanfaatan Data</h2>
                            </div>
                        </header>
                        <p>
                            Seluruh data pribadi yang terkumpul digunakan semata-mata untuk tujuan legal dan operasional penyelenggaraan wisata:
                        </p>
                        <ul class="space-y-2.5 text-slate-600 pl-2 text-xs sm:text-sm">
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Pendaftaran Polis Asuransi Wisata:</strong> Mendaftarkan setiap peserta pada program asuransi kecelakaan pariwisata resmi Pangandaran sesuai data manifest.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Penerbitan Karcis Masuk Konservasi:</strong> Memproses izin dan karcis masuk resmi pada balai konservasi (seperti Green Canyon Cukang Taneuh atau BKSDA Cagar Alam Pananjung).</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Penugasan Pemandu Lokal HPI:</strong> Memastikan jumlah pemandu lokal bersertifikat HPI mencukupi rasio aman rombongan (1 pemandu per 5-6 peserta body rafting).</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Penyediaan Fasilitas & Logistik:</strong> Menyiapkan ukuran rompi keselamatan, perahu penjemputan, reservasi hotel, hingga pesanan konsumsi seafood bakar.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Sistem Peringatan Keselamatan:</strong> Menginformasikan kondisi cuaca laut, ombak pasang, atau penutupan sementara sungai secara cepat via WhatsApp.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Kebutuhan Dokumen Resmi Perusahaan:</strong> Pembuatan Surat Perintah Kerja (SPK), invoice resmi berbadan hukum CV, dan faktur pajak bagi klien korporat atau instansi kedinasan.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 5 -->
                    <article id="pasal-5" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                05
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 5</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Komitmen Larangan Mutlak Jual Beli Data</h2>
                            </div>
                        </header>
                        <div class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-200/80 text-emerald-950 text-xs sm:text-sm leading-relaxed">
                            <strong>Prinsip Perlindungan Utama:</strong> CV Puja Tour & Travel Pangandaran menegaskan bahwa kami <strong>TIDAK PERNAH DAN TIDAK AKAN PERNAH</strong> menjual, menyewakan, memperdagangkan, atau membagikan data pribadi wisatawan kepada pihak ketiga untuk kepentingan telemarketing, periklanan spam, broker data, atau tujuan komersial di luar paket wisata yang dipesan.
                        </div>
                        <p class="text-slate-600">
                            Data wisatawan hanya akan diteruskan secara terbatas dan terkendali kepada entitas resmi berikut:
                        </p>
                        <ol class="list-decimal pl-5 space-y-1.5 text-xs sm:text-sm text-slate-600">
                            <li><strong>Perusahaan Asuransi Wisata:</strong> Guna registrasi polis perlindungan keselamatan peserta selama trip.</li>
                            <li><strong>Badan Pengelola Objek Wisata:</strong> Pengelola resmi pos tiket wisata alam Pangandaran untuk registrasi manifest perahu & pemandu.</li>
                            <li><strong>Penyedia Transportasi & Akomodasi Mitra:</strong> Hotel resort atau penyedia bus yang dipesan atas permintaan langsung pemesan.</li>
                            <li><strong>Aparat Penegak Hukum:</strong> Hanya jika terdapat perintah resmi tertulis yang sah berdasarkan ketentuan hukum acara pidana Republik Indonesia.</li>
                        </ol>
                    </article>

                    <!-- PASAL 6 -->
                    <article id="pasal-6" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                06
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 6</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Standar Keamanan & Retensi Penyimpanan Data</h2>
                            </div>
                        </header>
                        <p>
                            Kami mengimplementasikan langkah-langkah keamanan teknis dan organisasi untuk melindungi data Anda dari akses tanpa izin, kehilangan, atau pengubahan ilegal:
                        </p>
                        <div class="grid sm:grid-cols-3 gap-3 text-xs pt-1">
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block mb-1">Enkripsi TLS 1.3</strong>
                                <p class="text-slate-600 leading-relaxed">Seluruh transmisi formulir website dienkripsi dengan standar HTTPS modern.</p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block mb-1">Akses Berizin Terbatas</strong>
                                <p class="text-slate-600 leading-relaxed">Hanya staf reservasi & operasional resmi yang memegang kredensial akses data.</p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block mb-1">Retensi 1 Tahun</strong>
                                <p class="text-slate-600 leading-relaxed">Data manifest trip dihapus berkala setelah masa audit pembukuan & asuransi selesai.</p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 7 -->
                    <article id="pasal-7" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                07
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 7</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Dokumentasi Foto, Video & Privasi Visual</h2>
                            </div>
                        </header>
                        <p>
                            Selama perjalanan wisata, kru pemandu dan tim fotografer kami dapat mengambil dokumentasi foto maupun video keseruan aktivitas wisatawan (seperti di Green Canyon, Batu Karas, atau Pasir Putih) sebagai fasilitas kenang-kenangan gratis bagi peserta:
                        </p>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 pl-2">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Hasil dokumentasi trip diberikan secara utuh kepada peserta melalui tautan penyimpanan awan (Google Drive) atau transfer data langsung.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Perusahaan dapat menampilkan sebagian foto dokumentasi suasana wisata di website atau media sosial resmi Puja Tour untuk keperluan portofolio keindahan Pangandaran.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Hak Privasi Visual (Opt-Out):</strong> Jika Anda atau anggota rombongan berkeberatan fotonya dipublikasikan di kanal promosi, Anda berhak memberitahukan kepada pemandu atau Admin CS kami kapan saja. Kami akan segera menurunkan, menyamarkan, atau menghapus foto yang bersangkutan.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 8 -->
                    <article id="pasal-8" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                08
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 8</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Kebijakan Penggunaan Cookie & Analitik Website</h2>
                            </div>
                        </header>
                        <p>
                            Situs web ini menggunakan cookie esensial dan analitik ringan yang bertujuan untuk menjaga kestabilan sistem:
                        </p>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 pl-2">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Cookie Fungsional:</strong> Diperlukan untuk mengingat preferensi tampilan Anda dan keamanan formulir reservasi (proteksi CSRF).</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Analitik Pengunjung Realtime:</strong> Menghitung jumlah pengguna aktif secara anonim tanpa merekam identitas pribadi <em>(zero PII tracking)</em> untuk keperluan pemeliharaan kapasitas server.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Anda dapat menonaktifkan atau menghapus cookie sewaktu-waktu melalui pengaturan peramban internet <em>(browser settings)</em> pada perangkat Anda.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 9 -->
                    <article id="pasal-9" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                09
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 9</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Hak-Hak Anda sebagai Subjek Data Pribadi</h2>
                            </div>
                        </header>
                        <p>
                            Berdasarkan Bab VI Undang-Undang Pelindungan Data Pribadi (UU PDP), Anda memiliki hak-hak hukum berikut terhadap data pribadi Anda yang tersimpan pada sistem kami:
                        </p>
                        <div class="grid sm:grid-cols-2 gap-3 text-xs pt-1">
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">1. Hak Akses & Informasi</strong>
                                <p class="text-slate-600 leading-relaxed">Berhak meminta konfirmasi apakah data pribadi Anda sedang kami proses dan mendapatkan salinan data tersebut.</p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">2. Hak Koreksi & Pembaruan</strong>
                                <p class="text-slate-600 leading-relaxed">Berhak memperbaiki kesalahan ketik nama, nomor kontak, atau rincian paket jika terdapat kekeliruan data.</p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">3. Hak Penghapusan (Erasure)</strong>
                                <p class="text-slate-600 leading-relaxed">Berhak meminta data kontak atau ulasan yang pernah dipublikasikan dihapus setelah trip wisata selesai.</p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">4. Hak Penarikan Persetujuan</strong>
                                <p class="text-slate-600 leading-relaxed">Berhak menarik persetujuan pengiriman pesan promosi dan penawaran paket wisata di masa depan.</p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 10 -->
                    <article id="pasal-10" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-5 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                10
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 10</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Saluran Resmi Pengajuan Hak & Pertanyaan Privasi</h2>
                            </div>
                        </header>
                        <p>
                            Untuk mengajukan permohonan hak subjek data, klarifikasi kebijakan, atau pengaduan terkait kerahasiaan data, Anda dapat menghubungi Petugas Perlindungan Data <em>(Data Protection Officer)</em> kami melalui saluran resmi berikut:
                        </p>

                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-xs sm:text-sm space-y-3">
                            <div class="flex items-start gap-3">
                                <i data-lucide="building-2" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">Badan Usaha Resmi:</strong>
                                    <span class="text-slate-600">{{ $companyName }}</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="map-pin" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">Alamat Kantor Operasional:</strong>
                                    <span class="text-slate-600">{{ $officeAddr }}</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="phone" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">WhatsApp Hotline Resmi:</strong>
                                    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20mengajukan%20pertanyaan%20privasi" target="_blank" class="text-emerald-700 font-bold hover:underline">
                                        {{ $phoneNum }} (Respon Cepat)
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="mail" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">Email Korespondensi Privasi:</strong>
                                    <a href="mailto:{{ $emailAddr }}" class="text-emerald-700 font-bold hover:underline">
                                        {{ $emailAddr }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 italic">
                            Catatan: Setiap permohonan tertulis akan diverifikasi identitasnya dan ditindaklanjuti dalam waktu selambat-lambatnya 1 x 24 jam kerja sejak permohonan diterima secara lengkap.
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-12 border-b border-slate-800">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 shrink-0">
                            <img src="{{ asset('images/puja_logo.png') }}" alt="Puja Tour Logo" class="w-full h-full object-contain">
                        </div>
                        <span class="font-display font-extrabold text-xl text-white">
                            PUJA<span class="text-emerald-400 ml-1">TOUR</span>
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Penyedia paket wisata resmi Pangandaran, body rafting Green Canyon, snorkeling Pasir Putih, dan gathering perusahaan terpercaya.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-emerald-400 mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-xs text-slate-400">
                        @if(!request()->routeIs('home'))
                            <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        @endif
                        @if(!request()->routeIs('packages.index'))
                            <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Paket Wisata</a></li>
                        @endif
                        @if(!request()->routeIs('about'))
                            <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        @endif
                        @if(!request()->routeIs('calculator'))
                            <li><a href="{{ route('calculator') }}" class="hover:text-white transition">Estimasi Biaya</a></li>
                        @endif
                        @if(!request()->routeIs('gallery'))
                            <li><a href="{{ route('gallery') }}" class="hover:text-white transition">Galeri Foto</a></li>
                        @endif
                        @if(!request()->routeIs('testimonial'))
                            <li><a href="{{ route('testimonial') }}" class="hover:text-white transition">Ulasan Wisatawan</a></li>
                        @endif
                        @if(!request()->routeIs('faq'))
                            <li><a href="{{ route('faq') }}" class="hover:text-white transition">Pertanyaan Umum (FAQ)</a></li>
                        @endif
                        @if(!request()->routeIs('contact'))
                            <li><a href="{{ route('contact') }}" class="hover:text-white transition">Kontak & Lokasi</a></li>
                        @endif
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-emerald-400 mb-4">Kantor Operasional</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">{{ $officeAddr }}</p>
                    <p class="text-xs text-emerald-400 font-bold mt-2">Hotline: {{ $phoneNum }}</p>
                    <p class="text-xs text-slate-400 mt-1">Email: {{ $emailAddr }}</p>
                </div>
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-emerald-400 mb-4">Legalitas Resmi</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Berbadan hukum resmi CV dengan izin pariwisata terdaftar dan pemandu bersertifikasi kepemanduan HPI Jawa Barat.
                    </p>
                </div>
            </div>
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-500">
                <p>© {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
                <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2">
                    <a href="{{ route('privacy-policy') }}" class="text-emerald-400 font-semibold transition">Kebijakan Privasi</a>
                    <span>•</span>
                    <a href="{{ route('terms-conditions') }}" class="hover:text-emerald-400 transition">Syarat & Ketentuan</a>
                    <span>•</span>
                    <a href="{{ route('refund-policy') }}" class="hover:text-emerald-400 transition">Kebijakan Pengembalian</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20informasi%20layanan" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
            const btn = document.getElementById('mobile-menu-btn');
            const drawer = document.getElementById('mobile-drawer');
            const closeBtn = document.getElementById('close-drawer-btn');
            if (btn && drawer) {
                btn.addEventListener('click', () => drawer.classList.remove('hidden'));
                if (closeBtn) closeBtn.addEventListener('click', () => drawer.classList.add('hidden'));
            }

            // Scroll spy & smooth anchor offset handling for TOC
            const tocLinks = document.querySelectorAll('aside nav a[href^="#"]');
            const articles = document.querySelectorAll('article[id^="pasal-"]');

            function updateActiveToc() {
                const headerHeight = document.getElementById('main-header')?.offsetHeight || 80;
                const scrollPos = window.scrollY + headerHeight + 50;

                let currentId = '';
                articles.forEach(article => {
                    const top = article.offsetTop;
                    if (scrollPos >= top) {
                        currentId = article.getAttribute('id');
                    }
                });

                tocLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (href === '#' + currentId) {
                        link.classList.add('bg-emerald-50', 'text-emerald-800', 'font-bold');
                        link.classList.remove('text-slate-600');
                    } else {
                        link.classList.remove('bg-emerald-50', 'text-emerald-800', 'font-bold');
                        link.classList.add('text-slate-600');
                    }
                });
            }

            window.addEventListener('scroll', updateActiveToc, { passive: true });
            updateActiveToc();

            // Smooth scroll click handler with header offset
            tocLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    const targetId = link.getAttribute('href');
                    if (targetId && targetId.startsWith('#')) {
                        const targetEl = document.querySelector(targetId);
                        if (targetEl) {
                            e.preventDefault();
                            const headerHeight = document.getElementById('main-header')?.offsetHeight || 80;
                            const targetPosition = targetEl.getBoundingClientRect().top + window.scrollY - headerHeight - 24;
                            window.scrollTo({
                                top: Math.max(0, targetPosition),
                                behavior: 'smooth'
                            });
                            history.pushState(null, '', targetId);
                            setTimeout(updateActiveToc, 100);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
