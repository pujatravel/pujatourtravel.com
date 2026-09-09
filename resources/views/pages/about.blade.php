<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Tentang Kami — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="Profil resmi Puja Tour & Travel Pangandaran. Berbadan hukum CV resmi, pemandu bersertifikasi HPI, dan spesialis liburan bahari, Green Canyon, dan corporate gathering.">
    <meta name="keywords" content="profil Puja Tour Travel, tentang Puja Tour Pangandaran, biro wisata resmi Pangandaran, tour guide bersertifikat HPI, CV travel Pangandaran">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Tentang Kami — Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Profil resmi Puja Tour & Travel Pangandaran. Berbadan hukum CV resmi, pemandu bersertifikasi HPI, dan spesialis liburan bahari.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Tentang Kami — Puja Tour & Travel Pangandaran">
    <meta name="twitter:description" content="Profil resmi Puja Tour & Travel Pangandaran. Berbadan hukum CV resmi, pemandu bersertifikasi HPI, dan spesialis liburan bahari.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): Organization — helps Google Knowledge Panel -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => 'Puja Tour Travel',
        'alternateName' => 'Puja Tour & Travel Pangandaran',
        'description' => 'Biro perjalanan wisata resmi di Pangandaran yang menyediakan paket tur Green Canyon, body rafting, dan wisata bahari.',
        'url' => url('/'),
        'logo' => asset('images/puja_logo.png'),
        'image' => asset('images/hero_pangandaran.jpg'),
        'telephone' => $settings['phone_number'] ?? '+6281234567890',
        'email' => $settings['email_address'] ?? 'info@pujatourtravel.com',
        'foundingDate' => '2020',
        'numberOfEmployees' => [
            '@type' => 'QuantitativeValue',
            'minValue' => 5,
            'maxValue' => 20,
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $settings['office_address'] ?? 'Jl. Pantai Barat No. 88',
            'addressLocality' => 'Pangandaran',
            'addressRegion' => 'Jawa Barat',
            'postalCode' => '46396',
            'addressCountry' => 'ID',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '-7.697500',
            'longitude' => '108.652500',
        ],
        'areaServed' => [
            '@type' => 'Place',
            'name' => 'Pangandaran, Jawa Barat, Indonesia',
        ],
        'sameAs' => [
            $settings['instagram_url'] ?? 'https://instagram.com/pujatourtravel',
            $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

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
                'name' => 'Tentang Kami',
                'item' => url()->current(),
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicons for Google Search & Browsers -->
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>

    @include('partials.analytics')
</head>
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
    @endphp

    <!-- STICKY NAVBAR -->
    <header id="main-header" class="sticky top-0 z-40 w-full bg-surface-soft/95 backdrop-blur-md transition-all duration-300 py-3.5 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                    <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja Tour & Travel" class="w-full h-full object-contain">
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

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-7 font-medium text-slate-600 text-sm">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="hover:text-emerald-700 transition">Paket Wisata</a>
                <a href="{{ route('about') }}" class="text-emerald-700 font-semibold hover:text-emerald-800 transition">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="hover:text-emerald-700 transition">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="hover:text-emerald-700 transition">FAQ</a>
                <a href="{{ route('gallery') }}" class="hover:text-emerald-700 transition">Galeri</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak</a>
            </nav>

            <!-- Header Action CTA -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20info%20tentang%20layanan%20wisata" target="_blank" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Tanya Trip CS</span>
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button id="mobile-menu-btn" aria-label="Buka Menu" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Drawer -->
    <div id="drawer-overlay" class="fixed inset-0 bg-slate-900/60 z-50 hidden opacity-0 transition-opacity duration-300"></div>
    <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-4/5 max-w-sm bg-surface-soft border-l border-neutral-200 z-50 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col justify-between p-6">
        <div>
            <div class="flex items-center justify-between pb-6 border-b border-neutral-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="font-display font-extrabold text-base text-slate-900">PUJA TOUR</span>
                </div>
                <button id="close-menu-btn" class="p-2 text-slate-500 hover:bg-neutral-100 rounded-xl">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <nav class="py-6 space-y-1 text-sm font-medium">
                <a href="{{ route('home') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Beranda</a>
                <a href="{{ route('packages.index') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Paket Wisata</a>
                <a href="{{ route('about') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl bg-emerald-50 text-emerald-700 font-bold">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">FAQ</a>
                <a href="{{ route('gallery') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Galeri</a>
                <a href="{{ route('contact') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Kontak</a>
            </nav>
        </div>
    </div>

    <!-- BREADCRUMBS -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition flex items-center gap-1">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                <span>Beranda</span>
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-semibold">Tentang Kami</span>
        </nav>
    </div>

    <!-- HERO SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="relative rounded-3xl overflow-hidden bg-slate-900 text-white p-8 sm:p-14 lg:p-20 shadow-xl">
            <div class="absolute inset-0 opacity-25">
                <img src="{{ asset('images/hero_pangandaran.jpg') }}" alt="Pangandaran Sea" class="w-full h-full object-cover">
            </div>
            <div class="relative z-10 max-w-2xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 uppercase tracking-wider mb-4">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                    <span>Legalitas Resmi CV Puja Tour Pangandaran</span>
                </span>
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-white tracking-tight leading-tight">
                    Mitra Terpercaya Liburan & Petualangan Bahari Pangandaran
                </h1>
                <p class="text-slate-300 text-sm sm:text-base mt-4 leading-relaxed">
                    Lebih dari sekadar agen perjalanan — kami adalah putra daerah Pangandaran yang berdedikasi menghadirkan pengalaman liburan aman, berkesan, dan penuh kehangatan kearifan lokal.
                </p>
                <div class="flex flex-wrap items-center gap-4 mt-8">
                    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip" target="_blank" class="px-6 py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md transition flex items-center gap-2">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Konsultasi Perjalanan</span>
                    </a>
                    <a href="{{ route('packages.index') }}" class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 transition flex items-center gap-2">
                        <span>Lihat Paket Wisata</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- KEY STATS SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
            <div class="bg-surface-soft rounded-2xl p-6 shadow-soft border border-neutral-200">
                <span class="font-display font-extrabold text-3xl sm:text-4xl text-emerald-700">10+</span>
                <span class="block text-xs font-bold text-slate-800 mt-1">Tahun Pengalaman</span>
                <span class="text-[11px] text-slate-500">Mengarungi alam Pangandaran</span>
            </div>
            <div class="bg-surface-soft rounded-2xl p-6 shadow-soft border border-neutral-200">
                <span class="font-display font-extrabold text-3xl sm:text-4xl text-emerald-700">15.000+</span>
                <span class="block text-xs font-bold text-slate-800 mt-1">Wisatawan Terlayani</span>
                <span class="text-[11px] text-slate-500">Keluarga & Corporate Gathering</span>
            </div>
            <div class="bg-surface-soft rounded-2xl p-6 shadow-soft border border-neutral-200">
                <span class="font-display font-extrabold text-3xl sm:text-4xl text-emerald-700">100%</span>
                <span class="block text-xs font-bold text-slate-800 mt-1">Pemandu Lisensi HPI</span>
                <span class="text-[11px] text-slate-500">Standar Rescue & Keamanan SNI</span>
            </div>
            <div class="bg-surface-soft rounded-2xl p-6 shadow-soft border border-neutral-200">
                <span class="font-display font-extrabold text-3xl sm:text-4xl text-emerald-700">4.9/5</span>
                <span class="block text-xs font-bold text-slate-800 mt-1">Rating Kepuasan Tamu</span>
                <span class="text-[11px] text-slate-500">Berdasarkan ulasan asli Google & WA</span>
            </div>
        </div>
    </section>

    <!-- PROFIL PERUSAHAAN & NILAI UTAMA -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-6 space-y-5">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                    Visi & Dedikasi
                </span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight">
                    Membawa Wisatawan Menikmati Pangandaran yang Otentik dan Aman
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Puja Tour & Travel berawal dari inisiatif para pemandu lokal senior Green Canyon dan peselancar Batu Karas yang ingin memberikan layanan pariwisata profesional berstandar internasional tanpa meninggalkan keramahan budaya pesisir Sunda.
                </p>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Kami memastikan setiap rute perjalanan, peralatan body rafting, armada transportasi perahu, serta konsumsi prasmanan dipersiapkan dengan teliti dan transparan tanpa ada biaya tersembunyi.
                </p>

                <!-- 3 Komitmen Utama -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-surface-soft border border-neutral-200">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="shield" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">Safety First & Asuransi Lengkap</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Setiap peserta dilindungi asuransi jiwa dan wajib menggunakan alat safety standar internasional.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-surface-soft border border-neutral-200">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="award" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">Legalitas Usaha & Pajak Resmi</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Berbadan hukum CV resmi, memiliki rekening perusahaan terverifikasi, dan siap invoice SPK kedinasan.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-surface-soft border border-neutral-200">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">Konservasi Lingkungan & Masyarakat Lokal</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Kami aktif mendukung kebersihan aliran Green Canyon, pelestarian penyu, dan mempekerjakan guide warga sekitar.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <img src="{{ asset('images/greencanyon.jpg') }}" alt="Green Canyon Adventure" class="w-full h-64 object-cover rounded-3xl shadow-soft">
                    <img src="{{ asset('images/cagar_alam.jpg') }}" alt="Cagar Alam Pananjung" class="w-full h-48 object-cover rounded-3xl shadow-soft">
                </div>
                <div class="space-y-4 pt-8">
                    <img src="{{ asset('images/pasir_putih.jpg') }}" alt="Pasir Putih Pangandaran" class="w-full h-48 object-cover rounded-3xl shadow-soft">
                    <img src="{{ asset('images/sunset_batu_karas.jpg') }}" alt="Sunset Batu Karas" class="w-full h-64 object-cover rounded-3xl shadow-soft">
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL SECTION -->
    @if($testimonials->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                    Pengalaman Wisatawan
                </span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 mt-2">
                    Apa Kata Mereka Tentang Puja Tour?
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($testimonials as $t)
                    <div class="bg-surface-soft rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1 text-amber-500 mb-3">
                                @for($i = 0; $i < ($t->rating ?? 5); $i++)
                                    <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                                @endfor
                            </div>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic">
                                "{{ $t->review_text }}"
                            </p>
                        </div>
                        <div class="pt-5 mt-5 border-t border-neutral-200 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-sm">
                                {{ substr($t->customer_name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900">{{ $t->customer_name }}</h4>
                                <span class="text-[11px] text-slate-400">{{ $t->customer_city ?? 'Wisatawan' }} &bull; {{ $t->package_name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-12 border-b border-slate-800">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 shrink-0">
                            <img src="{{ asset('images/puja_logo.png') }}" alt="Logo" class="w-full h-full object-contain">
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
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Paket Wisata</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('calculator') }}" class="hover:text-white transition">Estimasi Biaya</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-white transition">Galeri</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Kontak</a></li>
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
                <p>© {{ date('Y') }} {{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN' }}. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.login') }}" class="hover:text-emerald-400 font-bold text-slate-400 flex items-center gap-1">
                        <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                        <span>Login Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20info%20paket%20wisata" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

</body>
</html>
