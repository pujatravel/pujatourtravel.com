<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="qdDKl_CxJFHAbq1E6QwMEswIo28qlBmfiYo6ykUNxi0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">

    {{-- SEO: Title sesuai foto 2 — singkat, natural, kaya keyword --}}
    <title>Puja Tour & Travel Pangandaran | Wisata Terbaik di Pangandaran</title>
    <meta name="description" content="Nikmati liburan seru di Pangandaran bersama Puja Tour & Travel. Tersedia paket wisata Pangandaran, Green Canyon, snorkeling, pantai, dan berbagai pilihan perjalanan menarik lainnya.">
    <meta name="keywords" content="Puja Tour Travel, wisata Pangandaran, paket wisata Pangandaran, Green Canyon, body rafting, snorkeling Pasir Putih, tour guide Pangandaran, liburan Pangandaran">

    {{-- Canonical: homepage eksplisit, bukan current() agar tidak ada variasi URL --}}
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph / Meta Sosial -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour & Travel Pangandaran">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Puja Tour & Travel Pangandaran | Wisata Terbaik di Pangandaran">
    <meta property="og:description" content="Nikmati liburan seru di Pangandaran bersama Puja Tour & Travel. Tersedia paket wisata Pangandaran, Green Canyon, snorkeling, pantai, dan berbagai pilihan perjalanan menarik lainnya.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Puja Tour & Travel Pangandaran — Paket Wisata Green Canyon & Pantai">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Puja Tour & Travel Pangandaran | Wisata Terbaik di Pangandaran">
    <meta name="twitter:description" content="Nikmati liburan seru di Pangandaran bersama Puja Tour & Travel. Tersedia paket wisata Pangandaran, Green Canyon, snorkeling, pantai, dan berbagai pilihan perjalanan menarik lainnya.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): TravelAgency — homepage utama -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        '@id' => url('/') . '#travelagency',
        'name' => 'Puja Tour & Travel Pangandaran',
        'alternateName' => ['Puja Tour Travel', 'Puja Tour Pangandaran'],
        'description' => 'Biro perjalanan wisata resmi di Pangandaran. Tersedia paket wisata Green Canyon, body rafting, snorkeling, dan wisata pantai dengan pemandu lokal berlisensi HPI.',
        'url' => url('/'),
        'logo' => asset('images/puja_logo.png'),
        'image' => asset('images/hero_pangandaran.jpg'),
        'telephone' => $settings['phone_number'] ?? '+6281234567890',
        'email' => $settings['email_address'] ?? 'info@pujatourtravel.com',
        'priceRange' => '$$',
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
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens' => '06:00',
            'closes' => '21:00',
        ],
        'sameAs' => [
            $settings['instagram_url'] ?? 'https://www.instagram.com/puja_tourtravel/',
            $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel',
        ],
        'hasMap' => 'https://maps.google.com/?q=Pangandaran',
        'areaServed' => 'Pangandaran, Jawa Barat',
        'knowsAbout' => ['Green Canyon', 'Body Rafting', 'Wisata Pantai Pangandaran', 'Snorkeling', 'Batu Karas'],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <!-- Structured Data (JSON-LD): WebSite + WebPage (homepage) -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'name' => 'Puja Tour & Travel Pangandaran',
                'url' => url('/'),
                'publisher' => ['@id' => url('/') . '#travelagency'],
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => [
                        '@type' => 'EntryPoint',
                        'urlTemplate' => route('packages.index') . '?search={search_term_string}',
                    ],
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            [
                '@type' => 'WebPage',
                '@id' => url('/') . '#webpage',
                'url' => url('/'),
                'name' => 'Puja Tour & Travel Pangandaran | Wisata Terbaik di Pangandaran',
                'description' => 'Nikmati liburan seru di Pangandaran bersama Puja Tour & Travel. Tersedia paket wisata Pangandaran, Green Canyon, snorkeling, pantai, dan berbagai pilihan perjalanan menarik lainnya.',
                'isPartOf' => ['@id' => url('/') . '#website'],
                'about' => ['@id' => url('/') . '#travelagency'],
                'inLanguage' => 'id-ID',
                'breadcrumb' => [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        [
                            '@type' => 'ListItem',
                            'position' => 1,
                            'name' => 'Beranda',
                            'item' => url('/'),
                        ],
                    ],
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicons for Browsers & Google Search -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}?v=3">
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>

    @include('partials.analytics')
</head>
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white overflow-x-hidden">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
        $opHours = $settings['operational_hours'] ?? 'Setiap Hari: 06.00 - 21.00 WIB';
        $igUrl = $settings['instagram_url'] ?? 'https://www.instagram.com/puja_tourtravel/';
        $tiktokUrl = $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel';
    @endphp


    <!-- 2. STICKY NAVBAR (Dynamic Background Detection) -->
    <header id="main-header" class="fixed top-0 left-0 right-0 z-40 w-full py-3 sm:py-3.5 is-transparent-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-3">
            <!-- Brand Logo (Clean Borderless) -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group shrink-0">
                <div class="w-9 h-9 sm:w-12 sm:h-12 shrink-0 flex items-center justify-center">
                    <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja Tour & Travel" class="w-full h-full object-contain drop-shadow-sm">
                </div>
                <div class="flex flex-col">
                    <span class="nav-brand-title font-display font-extrabold text-base sm:text-xl leading-tight tracking-tight text-white transition-colors duration-300">
                        PUJA<span class="nav-brand-accent text-emerald-400 transition-colors duration-300 ml-1">TOUR</span>
                    </span>
                    <span class="nav-brand-subtitle text-[9px] sm:text-[10px] tracking-widest font-bold text-white/70 uppercase transition-colors duration-300 hidden sm:block">
                        & Travel Pangandaran
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <nav class="hidden lg:flex items-center gap-7 font-medium text-sm">
                <a href="#beranda" class="nav-link-item text-emerald-400 font-semibold transition-colors duration-300">Beranda</a>
                <a href="{{ route('packages.index') }}" class="nav-link-item text-white/90 hover:text-white transition-colors duration-300">Paket Wisata</a>
                <a href="{{ route('about') }}" class="nav-link-item text-white/90 hover:text-white transition-colors duration-300">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="nav-link-item text-white/90 hover:text-white transition-colors duration-300">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="nav-link-item text-white/90 hover:text-white transition-colors duration-300">FAQ</a>
                <a href="{{ route('gallery') }}" class="nav-link-item text-white/90 hover:text-white transition-colors duration-300">Galeri</a>
                <a href="{{ route('contact') }}" class="nav-link-item text-white/90 hover:text-white transition-colors duration-300">Kontak</a>
            </nav>



            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" aria-label="Buka Menu" class="lg:hidden p-2 rounded-xl text-white hover:bg-white/10 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Drawer & Backdrop -->
    <div id="drawer-overlay" class="fixed inset-0 bg-slate-900/60 z-50 hidden opacity-0 transition-opacity duration-300"></div>
    <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-4/5 max-w-sm bg-surface-soft border-l border-neutral-200 z-50 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col justify-between p-6 invisible pointer-events-none">
        <div>
            <div class="flex items-center justify-between pb-6 border-b border-neutral-200">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-display font-extrabold text-base text-slate-900">PUJA TOUR</span>
                        <span class="text-[10px] text-slate-500 block uppercase font-bold">Pangandaran</span>
                    </div>
                </div>
                <button id="close-menu-btn" aria-label="Tutup Menu" class="p-2 rounded-xl text-slate-500 hover:bg-neutral-100 transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <nav class="py-6 space-y-1.5 font-medium text-slate-700 text-sm">
                <a href="#beranda" class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 text-emerald-700 font-bold transition">
                    <span>Beranda</span>
                </a>
                <a href="{{ route('packages.index') }}" class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">
                    <span>Paket Wisata</span>
                </a>
                <a href="{{ route('about') }}" class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">
                    <span>Tentang Kami</span>
                </a>
                <a href="{{ route('calculator') }}" class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">
                    <span>Estimasi Biaya</span>
                </a>
                <a href="{{ route('faq') }}" class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">
                    <span>FAQ</span>
                </a>
                <a href="{{ route('gallery') }}" class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">
                    <span>Galeri</span>
                </a>
                <a href="{{ route('contact') }}" class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">
                    <span>Kontak & Lokasi</span>
                </a>
            </nav>
        </div>

        <div class="pt-6 border-t border-neutral-200 space-y-3">
            <a href="https://wa.me/{{ $waNum }}" target="_blank" class="w-full py-3 rounded-xl bg-slate-900 text-white font-semibold text-xs flex items-center justify-center gap-2 hover:bg-slate-800 transition">
                <i data-lucide="message-circle" class="w-4 h-4 text-emerald-400"></i>
                <span>Chat WhatsApp Resmi</span>
            </a>
            <a href="#booking-section" class="drawer-link w-full py-3 rounded-xl bg-emerald-700 text-white font-semibold text-xs flex items-center justify-center gap-2 hover:bg-emerald-800 transition shadow-sm">
                <span>Formulir Pemesanan</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>

    <!-- 3. HERO BANNER SECTION WITH CINEMATIC AUTO-SLIDER (Solid Slate 950) -->
    @php
        $heroBadge = $settings['hero_badge'] ?? 'Partner Resmi Wisata & Petualangan Pangandaran';
        $heroTitle = $settings['hero_title'] ?? 'Jelajahi Pesona Bahari & Petualangan Pangandaran Tak Terlupakan';
        $heroHighlight = $settings['hero_title_highlight'] ?? 'Pangandaran';
        $heroSubtitle = $settings['hero_subtitle'] ?? 'Nikmati sensasi seru Body Rafting Green Canyon, panorama eksotis Pasir Putih, dan pesona bahari terbaik bersama pemandu lokal profesional tersertifikasi HPI. Liburan aman, nyaman, dan berkesan.';

        $stat1Val = $settings['hero_stat_1_val'] ?? '5.000+';
        $stat1Lbl = $settings['hero_stat_1_lbl'] ?? 'Wisatawan Puas';
        $stat2Val = $settings['hero_stat_2_val'] ?? '100%';
        $stat2Lbl = $settings['hero_stat_2_lbl'] ?? 'Pemandu Berlisensi';
        $stat3Val = $settings['hero_stat_3_val'] ?? '4.9/5';
        $stat3Lbl = $settings['hero_stat_3_lbl'] ?? 'Ulasan Google';

        $heroSlidesList = collect();
        $sourceSlides = (isset($heroSliders) && $heroSliders->count() > 0) ? $heroSliders : ((isset($galleries) && $galleries->count() > 0) ? $galleries->where('is_slider', true) : collect());

        foreach ($sourceSlides as $g) {
            $imgPath = $g->image_url ?? $g->image_path;
            if ($imgPath) {
                $heroSlidesList->push([
                    'image' => asset($imgPath),
                    'location' => ($g->title ?? 'Destinasi Wisata') . ' • ' . ($g->caption ?? 'Pesona Indah Pangandaran'),
                    'title' => $g->title ?? 'Galeri Pangandaran',
                ]);
            }
        }

        $defaultSlides = [
            ['image' => asset('images/hero_pangandaran.jpg'), 'location' => 'Pantai Pangandaran • Hamparan Pasir & Pesona Bahari', 'title' => 'Pantai Pangandaran'],
            ['image' => asset('images/greencanyon.jpg'), 'location' => 'Green Canyon Cukang Taneuh • Ngarai Stalaktit Air Zamrud', 'title' => 'Green Canyon'],
            ['image' => asset('images/pasir_putih.jpg'), 'location' => 'Pantai Pasir Putih • Snorkeling Terumbu Karang & Ikan Badut', 'title' => 'Pasir Putih'],
            ['image' => asset('images/sunset_batu_karas.jpg'), 'location' => 'Pantai Batu Karas • Golden Sunset & Wisata Selancar', 'title' => 'Batu Karas'],
            ['image' => asset('images/cagar_alam.jpg'), 'location' => 'Cagar Alam Pananjung • Hutan Lindung Tropis & Satwa Liar', 'title' => 'Cagar Alam'],
        ];

        if ($heroSlidesList->count() < 3) {
            foreach ($defaultSlides as $ds) {
                if ($heroSlidesList->count() >= 5) break;
                $heroSlidesList->push($ds);
            }
        }
    @endphp
    <section id="beranda" data-nav-color="dark" class="relative min-h-svh sm:min-h-[90vh] flex items-center justify-center overflow-hidden bg-slate-950 group pt-16 sm:pt-0">
        <!-- Hero Background Auto-Slider Container -->
        <div id="hero-slider" class="absolute inset-0 z-0 overflow-hidden select-none">
            @foreach($heroSlidesList as $index => $slide)
                <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}" data-location="{{ $slide['location'] }}">
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="w-full h-full object-cover object-center scale-105 transition-transform duration-7000 ease-out">
                </div>
            @endforeach

            <!-- Deep Scrim Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/90 via-slate-950/75 to-slate-950/90 z-1"></div>
        </div>

        <!-- Floating Destination Badge - desktop only -->
        <div class="absolute top-20 sm:top-28 right-4 sm:right-8 z-20 hidden md:inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/80 backdrop-blur-md border border-white/20 text-xs font-medium text-emerald-300 shadow-lg">
            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-400 shrink-0"></i>
            <span id="hero-location-text">{{ $heroSlidesList->first()['location'] ?? 'Wisata Pangandaran' }}</span>
        </div>

        <!-- Hero Slider Arrow Navigation -->
        <button id="hero-prev-btn" type="button" aria-label="Slide Sebelumnya" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-20 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-slate-900/60 hover:bg-slate-900/90 border border-white/20 text-white flex items-center justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition duration-300 shadow-xl cursor-pointer">
            <i data-lucide="chevron-left" class="w-5 h-5 sm:w-6 sm:h-6"></i>
        </button>
        <button id="hero-next-btn" type="button" aria-label="Slide Selanjutnya" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-20 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-slate-900/60 hover:bg-slate-900/90 border border-white/20 text-white flex items-center justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition duration-300 shadow-xl cursor-pointer">
            <i data-lucide="chevron-right" class="w-5 h-5 sm:w-6 sm:h-6"></i>
        </button>

        <!-- Slide Indicators -->
        <div id="hero-dots" class="absolute bottom-8 sm:bottom-16 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-900/80 backdrop-blur-md border border-white/15 shadow-md">
            @foreach($heroSlidesList as $index => $slide)
                <button type="button" class="hero-dot {{ $index === 0 ? 'w-6 sm:w-8 bg-emerald-400' : 'w-2 sm:w-2.5 bg-white/40' }} h-1.5 sm:h-2 rounded-full hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12 sm:pt-32 sm:pb-16 lg:pt-36 lg:pb-28">
            <div class="grid lg:grid-cols-12 gap-6 sm:gap-8 lg:gap-12 items-center">

                <!-- Hero Left: Main Text Content -->
                <div class="lg:col-span-7 text-center lg:text-left space-y-4 sm:space-y-5">

                    <!-- Badge -->
                    <div class="inline-flex items-center px-3 py-1.5 rounded-full bg-white/10 border border-white/20 text-emerald-300 text-[11px] sm:text-sm font-semibold max-w-full mt-1 sm:mt-0">
                        <span class="truncate">{{ $heroBadge }}</span>
                    </div>

                    <!-- Main H1 Title -->
                    <h1 class="font-display font-extrabold text-[1.75rem] sm:text-4xl lg:text-6xl text-white tracking-tight leading-tight sm:leading-[1.15] wrap-break-word">
                        @if(!empty($heroHighlight) && str_contains($heroTitle, $heroHighlight))
                            {!! str_replace($heroHighlight, '<span class="text-emerald-400">' . e($heroHighlight) . '</span>', e($heroTitle)) !!}
                        @else
                            {{ $heroTitle }}
                        @endif
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base lg:text-lg text-slate-300 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        {{ $heroSubtitle }}
                    </p>

                    <!-- Trust Stats -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-x-3 gap-y-1.5 text-xs text-slate-300 font-medium">
                        <span class="inline-flex items-center gap-1 text-amber-400 font-bold">
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                            <span>{{ $stat3Val }}</span>
                        </span>
                        <span class="text-white/30 hidden sm:inline">•</span>
                        <span>{{ $stat1Val }} {{ $stat1Lbl }}</span>
                        <span class="text-white/30 hidden sm:inline">•</span>
                        <span class="text-emerald-300 font-semibold">{{ $stat2Lbl }}</span>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center lg:justify-start gap-3">
                        <a href="#paket" class="px-6 py-3 sm:px-8 sm:py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow-sm transition flex items-center justify-center">
                            Jelajahi Paket Wisata
                        </a>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" target="_blank" class="px-6 py-3 sm:px-7 sm:py-3.5 rounded-xl bg-slate-900/80 border border-white/20 hover:bg-slate-900 text-white font-semibold text-sm transition flex items-center justify-center gap-2">
                            <i data-lucide="message-circle" class="w-4 h-4 text-emerald-400"></i>
                            <span>Konsultasi WhatsApp</span>
                        </a>
                    </div>

                    <!-- Mobile: Compact Trip Planner CTA (replaces widget on mobile) -->
                    <div class="lg:hidden pt-1">
                        <a href="#booking-section" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl border border-white/20 bg-white/5 text-white/80 text-xs font-semibold hover:bg-white/10 transition">
                            <i data-lucide="compass" class="w-3.5 h-3.5 text-emerald-400"></i>
                            <span>Atau isi formulir reservasi lengkap ↓</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Right: Trip Finder Widget (desktop only) -->
                <div class="hidden lg:block lg:col-span-5">
                    <div class="bg-surface-soft rounded-3xl p-6 lg:p-8 shadow-soft border border-neutral-200 text-slate-800">
                        <div class="flex items-center gap-3 pb-5 border-b border-neutral-200">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                <i data-lucide="compass" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h2 class="font-display font-bold text-lg text-slate-900 leading-snug">Rencanakan Trip Anda</h2>
                                <p class="text-xs text-slate-500">Kalkulasi estimasi harga instan & ketersediaan</p>
                            </div>
                        </div>

                        <form class="space-y-4 pt-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Pilih Paket Wisata</label>
                                <select id="calc-package" class="w-full px-3.5 py-3 rounded-xl border border-neutral-200 bg-canvas text-slate-800 font-medium text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 transition outline-none">
                                    @foreach($allPackages as $pkg)
                                        <option value="{{ $pkg->slug }}" data-price="{{ (int) $pkg->price }}">
                                            {{ $pkg->name }} ({{ $pkg->formatted_price }} / {{ $pkg->price_unit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Jumlah Peserta</label>
                                    <input type="number" id="calc-pax" min="1" max="200" value="4" class="w-full px-3.5 py-3 rounded-xl border border-neutral-200 bg-canvas text-slate-800 font-bold text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 transition outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Rencana Tanggal</label>
                                    <input type="date" id="calc-date" min="{{ date('Y-m-d') }}" class="w-full px-3.5 py-3 rounded-xl border border-neutral-200 bg-canvas text-slate-800 font-medium text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 transition outline-none custom-datepicker-input">
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-canvas border border-neutral-200 flex items-center justify-between">
                                <div>
                                    <span class="text-xs font-medium text-slate-500 block">Estimasi Total Biaya</span>
                                    <span class="text-[10px] text-emerald-800 font-semibold bg-emerald-100 px-2 py-0.5 rounded inline-block mt-0.5">Termasuk Pemandu & Alat</span>
                                </div>
                                <div class="text-right">
                                    <span id="calc-total-display" class="font-display font-extrabold text-2xl text-emerald-800">Rp 900.000</span>
                                </div>
                            </div>

                            <button type="button" id="btn-order-whatsapp" data-whatsapp="{{ $waNum }}" class="w-full py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow-sm transition flex items-center justify-center gap-2">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Kirim & Booking via WhatsApp</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile Trip Finder Widget (compact, below hero text) -->
                <div class="lg:hidden">
                    <div class="bg-surface-soft rounded-2xl p-4 shadow-soft border border-neutral-200 text-slate-800">
                        <div class="flex items-center gap-2.5 pb-3 border-b border-neutral-200 mb-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                <i data-lucide="compass" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="font-display font-bold text-sm text-slate-900">Rencanakan Trip Anda</p>
                                <p class="text-[11px] text-slate-500">Estimasi harga instan</p>
                            </div>
                        </div>
                        <div class="space-y-2.5">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1 uppercase tracking-wide">Pilih Paket</label>
                                <select class="w-full px-3 py-2.5 rounded-xl border border-neutral-200 bg-white text-slate-800 font-medium text-xs outline-none" onchange="document.getElementById('calc-package').value = this.value; document.getElementById('calc-package').dispatchEvent(new Event('change'))">
                                    @foreach($allPackages as $pkg)
                                        <option value="{{ $pkg->slug }}" data-price="{{ (int) $pkg->price }}">{{ $pkg->name }} ({{ $pkg->formatted_price }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-600 mb-1 uppercase tracking-wide">Peserta</label>
                                    <input type="number" value="4" min="1" max="200" class="w-full px-3 py-2.5 rounded-xl border border-neutral-200 bg-white text-slate-800 font-bold text-xs outline-none" onchange="document.getElementById('calc-pax').value = this.value; document.getElementById('calc-pax').dispatchEvent(new Event('input'))">
                                </div>
                                <div class="flex flex-col justify-end">
                                    <div class="px-3 py-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-center">
                                        <span class="text-[10px] text-slate-500 block">Estimasi</span>
                                        <span class="font-display font-extrabold text-sm text-emerald-700" id="mobile-calc-total">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="btn-order-whatsapp-mobile" data-whatsapp="{{ $waNum }}" class="w-full py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition flex items-center justify-center gap-1.5">
                                <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                <span>Kirim & Booking via WhatsApp</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. TRUST ELEMENTS / 4 PILAR KREDIBILITAS RESMI (Corporate, Formal & Terpercaya) -->
    <section class="relative -mt-8 sm:-mt-10 lg:-mt-12 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 border border-slate-200/90 shadow-xl shadow-slate-950/5">
            <!-- Top Verified Strip -->
            <div class="flex flex-wrap items-center justify-between gap-3 pb-5 mb-5 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-800">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                    </span>
                    <span class="text-xs sm:text-sm font-bold tracking-wide text-slate-900 uppercase">
                        Standar Layanan & Jaminan Legalitas Resmi Puja Tour
                    </span>
                </div>
                <div class="text-xs font-semibold text-slate-500">
                    <span>Terdaftar & Beroperasi Resmi di Pangandaran</span>
                </div>
            </div>

            <!-- 4 Pillar Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 lg:gap-6">
                <!-- Pilar 1: Legalitas Usaha -->
                <div class="group flex items-start gap-3.5 p-4 rounded-xl sm:rounded-2xl bg-slate-50/70 border border-slate-200/70 hover:bg-white hover:border-emerald-500 hover:shadow-md transition-all duration-300">
                    <div class="w-11 h-11 rounded-xl bg-white border border-slate-200/80 text-emerald-700 flex items-center justify-center shrink-0 shadow-sm group-hover:bg-emerald-700 group-hover:text-white group-hover:border-emerald-700 transition-colors duration-300">
                        <i data-lucide="building-2" class="w-5 h-5"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-700">Badan Hukum Resmi</span>
                        <h3 class="font-display font-bold text-slate-900 text-sm mt-0.5 leading-snug">Legalitas CV Terdaftar</h3>
                        <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">Berizin resmi Kemenkumham & NIB OSS. Amanah untuk trip keluarga, dinas & gathering instansi.</p>
                    </div>
                </div>

                <!-- Pilar 2: Pemandu Lisensi HPI -->
                <div class="group flex items-start gap-3.5 p-4 rounded-xl sm:rounded-2xl bg-slate-50/70 border border-slate-200/70 hover:bg-white hover:border-emerald-500 hover:shadow-md transition-all duration-300">
                    <div class="w-11 h-11 rounded-xl bg-white border border-slate-200/80 text-emerald-700 flex items-center justify-center shrink-0 shadow-sm group-hover:bg-emerald-700 group-hover:text-white group-hover:border-emerald-700 transition-colors duration-300">
                        <i data-lucide="badge-check" class="w-5 h-5"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-700">Lisensi Resmi HPI</span>
                        <h3 class="font-display font-bold text-slate-900 text-sm mt-0.5 leading-snug">Pemandu Bersertifikat</h3>
                        <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">Guide lokal asli Pangandaran dengan lisensi HPI resmi dan pelatihan keselamatan susur sungai.</p>
                    </div>
                </div>

                <!-- Pilar 3: Standar Safety Teruji -->
                <div class="group flex items-start gap-3.5 p-4 rounded-xl sm:rounded-2xl bg-slate-50/70 border border-slate-200/70 hover:bg-white hover:border-emerald-500 hover:shadow-md transition-all duration-300">
                    <div class="w-11 h-11 rounded-xl bg-white border border-slate-200/80 text-emerald-700 flex items-center justify-center shrink-0 shadow-sm group-hover:bg-emerald-700 group-hover:text-white group-hover:border-emerald-700 transition-colors duration-300">
                        <i data-lucide="life-buoy" class="w-5 h-5"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-700">Proteksi & Asuransi</span>
                        <h3 class="font-display font-bold text-slate-900 text-sm mt-0.5 leading-snug">Standar K3 & Keamanan</h3>
                        <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">Peralatan standar SNI/CE terawat (pelampung/life jacket & helm), dilengkapi asuransi keselamatan peserta.</p>
                    </div>
                </div>

                <!-- Pilar 4: Harga Jujur & Transparan -->
                <div class="group flex items-start gap-3.5 p-4 rounded-xl sm:rounded-2xl bg-slate-50/70 border border-slate-200/70 hover:bg-white hover:border-emerald-500 hover:shadow-md transition-all duration-300">
                    <div class="w-11 h-11 rounded-xl bg-white border border-slate-200/80 text-emerald-700 flex items-center justify-center shrink-0 shadow-sm group-hover:bg-emerald-700 group-hover:text-white group-hover:border-emerald-700 transition-colors duration-300">
                        <i data-lucide="receipt-text" class="w-5 h-5"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-700">All-Inclusive & Invoice</span>
                        <h3 class="font-display font-bold text-slate-900 text-sm mt-0.5 leading-snug">Transparansi Biaya</h3>
                        <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">Biaya pasti tanpa pungli di lokasi. Menerbitkan invoice & kwitansi resmi untuk reimbursement.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. PAKET WISATA UNGGULAN (KATALOG DINAMIS BERBASIS DATABASE) -->
    <section id="paket" class="py-20 lg:py-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 reveal-fade-up">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                Katalog Pilihan
            </span>
            <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-3 tracking-tight">
                Paket Wisata Favorit Pangandaran
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Pilih paket perjalanan impian Anda, mulai dari petualangan body rafting Green Canyon hingga paket eksklusif keluarga & corporate gathering.
            </p>

            <!-- Category Filter Links -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mt-8">
                <a href="{{ route('packages.index') }}" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition bg-emerald-700 text-white shadow-sm">
                    Katalog Lengkap ({{ $totalPackagesCount ?? 8 }})
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('packages.index', ['category' => $cat->slug]) }}" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition bg-surface-soft text-slate-600 hover:bg-[#ecefe9] border border-neutral-200">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Dynamic Package Grid from Database (Menampilkan Pilihan Unggulan) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($packages as $loopIndex => $pkg)
                <div class="package-card flex flex-col bg-surface-soft rounded-3xl overflow-hidden shadow-soft hover:shadow-card-hover transition-all duration-300 border border-neutral-200 group reveal-fade-up {{ $loopIndex % 3 === 1 ? 'delay-100' : ($loopIndex % 3 === 2 ? 'delay-200' : '') }}" data-category="{{ $pkg->category->slug ?? 'all' }}">
                    <!-- Card Image Area with Multi-Image Auto-Slider & Lightbox Click -->
                    @php
                        $galleryImages = $pkg->gallery_images;
                    @endphp
                    <div class="package-card-slider relative h-64 overflow-hidden bg-slate-950 cursor-pointer group/slider select-none"
                         data-package-name="{{ $pkg->name }}"
                         data-package-location="{{ $pkg->location ?? 'Pangandaran' }}"
                         data-package-duration="{{ $pkg->duration ?? '-' }}"
                         data-package-price="{{ $pkg->formatted_price }} / {{ $pkg->price_unit }}"
                         data-package-slug="{{ $pkg->slug }}"
                         data-package-images='@json($galleryImages)'
                         title="Klik foto untuk melihat galeri lengkap {{ $pkg->name }}">

                        <!-- Slides -->
                        <div class="card-slides-wrapper absolute inset-0 w-full h-full">
                            @foreach($galleryImages as $idx => $img)
                                <img src="{{ asset($img) }}"
                                     alt="{{ $pkg->name }} - Foto {{ $idx + 1 }}"
                                     class="card-slide-img absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out group-hover:scale-105 {{ $idx === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}"
                                     data-slide-index="{{ $idx }}"
                                     loading="lazy">
                            @endforeach
                        </div>

                        <!-- Subtle Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-slate-950/30 pointer-events-none"></div>

                        <!-- Click to View Gallery Hover Badge (Top Right) -->
                        <div class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-900/85 backdrop-blur-md text-emerald-300 border border-white/20 shadow-md flex items-center gap-1.5">
                                <i data-lucide="camera" class="w-3.5 h-3.5 text-emerald-400"></i>
                                <span>{{ count($galleryImages) }} Foto (Buka)</span>
                            </span>
                        </div>

                        <!-- Slide Dots (Bottom Left) -->
                        @if(count($galleryImages) > 1)
                            <div class="card-slider-dots absolute bottom-3 left-4 z-10 flex items-center gap-1 pointer-events-none">
                                @foreach($galleryImages as $idx => $img)
                                    <span class="card-dot h-1.5 rounded-full {{ $idx === 0 ? 'bg-emerald-400 w-3.5' : 'bg-white/50 w-1.5' }} transition-all duration-300"></span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1.5 text-xs font-semibold text-emerald-700 mb-1">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                <span>{{ $pkg->location ?? 'Pangandaran' }}</span>
                            </div>
                            <h3 class="font-display font-bold text-xl text-slate-900 group-hover:text-emerald-700 transition">
                                <a href="{{ route('packages.show', $pkg->slug) }}">
                                    {{ $pkg->name }}
                                </a>
                            </h3>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                {{ $pkg->short_description ?? 'Petualangan eksotis bersama Puja Tour & Travel Pangandaran.' }}
                            </p>

                            <!-- Facilities Badge -->
                            @if(is_array($pkg->inclusions) && count($pkg->inclusions) > 0)
                                <div class="flex flex-wrap gap-1.5 mt-4">
                                    @foreach(array_slice($pkg->inclusions, 0, 3) as $inc)
                                        <span class="text-[11px] bg-neutral-100 text-slate-700 px-2 py-0.5 rounded-md flex items-center gap-1">
                                            <i data-lucide="check" class="w-3 h-3 text-emerald-700"></i>
                                            <span>{{ $inc }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="pt-5 mt-5 border-t border-neutral-200 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-400 block font-medium">Mulai dari</span>
                                <span class="font-display font-bold text-xl text-emerald-700">{{ $pkg->formatted_price }}</span>
                                <span class="text-xs text-slate-400">/ {{ $pkg->price_unit }}</span>
                            </div>
                            <a href="{{ route('packages.show', $pkg->slug) }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-emerald-700 text-white font-semibold text-xs transition flex items-center gap-2 shadow-sm">
                                <span>Baca Selengkapnya</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-slate-400">
                    <p class="text-base font-bold text-slate-600">Belum ada paket wisata aktif.</p>
                    <p class="text-xs mt-1">Silakan tambahkan paket melalui dashboard Admin CMS.</p>
                </div>
            @endforelse
        </div>

        <!-- CTA ke Halaman Lengkap Semua Paket -->
        <div class="mt-12 text-center">
            <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-surface-soft hover:bg-white text-slate-900 font-bold text-sm border border-neutral-200 hover:border-emerald-700 shadow-soft hover:shadow-card-hover transition-all duration-300 group">
                <span>Jelajahi Semua Paket Wisata ({{ $totalPackagesCount ?? 8 }} Pilihan Lengkap)</span>
                <i data-lucide="arrow-right" class="w-4 h-4 text-emerald-700 group-hover:translate-x-1.5 transition-transform"></i>
            </a>
        </div>
    </section>

    <!-- 6. DESTINASI IKONIK & PENGALAMAN (Solid Slate 900) -->
    <section id="destinasi" data-nav-color="dark" class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 reveal-fade-up">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">
                        Destinasi Terbaik
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-white mt-3 tracking-tight">
                        Eksplorasi Keajaiban Alam Pangandaran
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base mt-2 max-w-xl">
                        Kombinasi sempurna antara ngarai air tawar tropis, pantai pasir putih, ombak selancar kelas dunia, dan cagar alam asri.
                    </p>
                </div>
                <a href="#booking-section" class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 font-semibold text-sm transition">
                    <span>Konsultasikan Rute Custom</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Destination Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 relative h-80 rounded-3xl overflow-hidden group shadow-md bg-slate-800 reveal-fade-up">
                    <img src="{{ asset('images/greencanyon.jpg') }}" alt="Green Canyon Cukang Taneuh" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-slate-950/60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="font-display font-bold text-2xl text-white">Green Canyon (Cukang Taneuh)</h3>
                        <p class="text-xs text-slate-300 mt-1 max-w-md">Air zamrud berkilau di antara tebing stalaktit purba berusia jutaan tahun dengan pemandangan alami yang menenangkan.</p>
                    </div>
                </div>

                <div class="relative h-80 rounded-3xl overflow-hidden group shadow-md bg-slate-800 reveal-fade-up delay-100">
                    <img src="{{ asset('images/pasir_putih.jpg') }}" alt="Pasir Putih & Snorkeling" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-slate-950/60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="font-display font-bold text-xl text-white">Pantai Pasir Putih</h3>
                        <p class="text-xs text-slate-300 mt-1">Snorkeling bersama ratusan ikan karang tropis di air laut yang jernih dan tenang.</p>
                    </div>
                </div>

                <div class="relative h-80 rounded-3xl overflow-hidden group shadow-md bg-slate-800 reveal-fade-up delay-150">
                    <img src="{{ asset('images/sunset_batu_karas.jpg') }}" alt="Sunset Batu Karas" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-slate-950/60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="font-display font-bold text-xl text-white">Pantai Batu Karas</h3>
                        <p class="text-xs text-slate-300 mt-1">Titik sunset terindah di Jawa Barat dengan suasana santai dan deretan cafe kayu estetik.</p>
                    </div>
                </div>

                <div class="md:col-span-2 relative h-80 rounded-3xl overflow-hidden group shadow-md bg-slate-800 reveal-fade-up delay-200">
                    <img src="{{ asset('images/cagar_alam.jpg') }}" alt="Cagar Alam Pananjung" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-slate-950/60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="font-display font-bold text-2xl text-white">Taman Wisata Alam & Cagar Alam Pananjung</h3>
                        <p class="text-xs text-slate-300 mt-1 max-w-md">Jelajahi keasrian hutan hujan tropis dengan kawanan rusa liar, pohon beringin raksasa, dan situs gua bersejarah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. KEUNGGULAN & BUKTI KEPERCAYAN (Authentic Local Travel Agency) -->
    <section id="keunggulan" class="py-20 lg:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-8 sm:gap-10 lg:gap-16 items-center">
            <!-- Left Image with Clean Authentic Caption & Dynamic Slider -->
            <div class="lg:col-span-5 relative reveal-fade-left">
                <!-- Slider Frame Container -->
                <div id="authentic-slider-container" class="relative group rounded-2xl sm:rounded-3xl overflow-hidden shadow-sm hover:shadow-md border border-neutral-200 bg-neutral-900 h-70 sm:h-90 lg:h-107.5 cursor-pointer" title="Klik untuk melihat foto lebih besar">
                    <!-- Slide Items -->
                    <div id="authentic-slides" class="relative w-full h-full">
                        <!-- Slide 1: Green Canyon -->
                        <div class="authentic-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-100 z-10"
                             data-location="Titik awal penyusunan rute & pengawalan trip di Green Canyon, Pangandaran."
                             data-tag="Green Canyon">
                            <img src="{{ asset('images/greencanyon.jpg') }}" alt="Pemandu Lokal Puja Tour di Green Canyon" class="w-full h-full object-cover">
                        </div>

                        <!-- Slide 2: Pasir Putih & Snorkeling -->
                        <div class="authentic-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0"
                             data-location="Spot snorkeling & penyeberangan perahu di Pantai Pasir Putih, Pangandaran."
                             data-tag="Pasir Putih">
                            <img src="{{ asset('images/pasir_putih.jpg') }}" alt="Spot Snorkeling & Perahu Wisata Pasir Putih" class="w-full h-full object-cover">
                        </div>

                        <!-- Slide 3: Cagar Alam Pananjung -->
                        <div class="authentic-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0"
                             data-location="Rute susur rimba cagar alam & jalur konservasi fauna Pananjung, Pangandaran."
                             data-tag="Cagar Alam">
                            <img src="{{ asset('images/cagar_alam.jpg') }}" alt="Eksplorasi Rimba & Cagar Alam Pangandaran" class="w-full h-full object-cover">
                        </div>

                        <!-- Slide 4: Sunset Batu Karas -->
                        <div class="authentic-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0"
                             data-location="Area santai sunset & pengawalan watersport di Pantai Batu Karas, Pangandaran."
                             data-tag="Batu Karas">
                            <img src="{{ asset('images/sunset_batu_karas.jpg') }}" alt="Sunset & Wisata Bahari Batu Karas" class="w-full h-full object-cover">
                        </div>

                        <!-- Slide 5: Pantai Barat Pangandaran -->
                        <div class="authentic-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0"
                             data-location="Pusat koordinasi pemandu lokal & pengawasan keselamatan di Pantai Barat Pangandaran."
                             data-tag="Pantai Barat">
                            <img src="{{ asset('images/hero_pangandaran.jpg') }}" alt="Pusat Koordinasi Wisata Pantai Barat Pangandaran" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Top Floating Tag Badge -->
                    <div class="absolute top-3.5 left-3.5 z-20 pointer-events-none">
                        <span id="authentic-slide-tag" class="px-3 py-1 rounded-full text-xs font-bold bg-slate-900/80 text-white backdrop-blur-md border border-white/20 shadow-md">
                            Green Canyon
                        </span>
                    </div>

                    <!-- Slide Navigation Arrows (Appear on hover) -->
                    <button type="button" id="authentic-prev" aria-label="Foto Sebelumnya" class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-slate-900/70 hover:bg-slate-900 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 shadow-md cursor-pointer border border-white/20">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    </button>
                    <button type="button" id="authentic-next" aria-label="Foto Selanjutnya" class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-slate-900/70 hover:bg-slate-900 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 shadow-md cursor-pointer border border-white/20">
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </button>

                    <!-- Bottom Indicator Dots -->
                    <div id="authentic-dots" class="absolute bottom-3 left-1/2 -translate-x-1/2 z-20 flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-950/60 backdrop-blur-md border border-white/15">
                    </div>
                </div>

                <!-- Dynamic Location Caption with Lucide Icon (NO Windows Emoji, Clean Direct Icon) -->
                <div class="mt-3 flex items-start gap-1.5 text-left">
                    <i data-lucide="map-pin" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                    <p id="authentic-location-caption" class="text-xs sm:text-sm text-slate-600 font-medium leading-relaxed transition-all duration-300">
                        Titik awal penyusunan rute & pengawalan trip di Green Canyon, Pangandaran.
                    </p>
                </div>
            </div>

            <!-- Right Content: Evidence-Driven Hierarchy -->
            <div class="lg:col-span-7 space-y-6 reveal-fade-right delay-100">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                        Pengalaman Lokal Autentik
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-3 tracking-tight leading-snug">
                        Dikelola Langsung oleh Putra Daerah Pangandaran
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                        Kami menyusun rute dan mendampingi trip berdasarkan pemahaman lapangan langsung—mulai dari kondisi debit air sungai, spot terumbu karang yang aman, hingga pertolongan keselamatan di pantai.
                    </p>
                </div>

                <!-- 3 Concrete Primary Proofs (Clean Typography, No Heavy Card Clutter) -->
                <div class="space-y-6 pt-4 border-t border-neutral-200">
                    <div class="flex items-start gap-4 reveal-fade-up">
                        <span class="font-display font-extrabold text-2xl text-emerald-700 leading-none pt-1">01</span>
                        <div>
                            <h3 class="font-display font-bold text-slate-900 text-base">Tim Guide Asli Pangandaran (Berlisensi HPI)</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                                Pemandu kami lahir dan tumbuh di Pangandaran. Memahami karakter debit air Green Canyon, titik terumbu karang aman di Pasir Putih, serta penanganan darurat di lapangan.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 reveal-fade-up delay-100">
                        <span class="font-display font-extrabold text-2xl text-emerald-700 leading-none pt-1">02</span>
                        <div>
                            <h3 class="font-display font-bold text-slate-900 text-base">Peralatan Standar & Asuransi Keselamatan Diri</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                                Setiap peserta dilengkapi pelampung (life jacket) terawat, helm sungai standar, serta asuransi keselamatan resmi di setiap paket trip tanpa biaya tambahan.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 reveal-fade-up delay-200">
                        <span class="font-display font-extrabold text-2xl text-emerald-700 leading-none pt-1">03</span>
                        <div>
                            <h3 class="font-display font-bold text-slate-900 text-base">Rincian Biaya Transparan (All-Inclusive)</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                                Seluruh harga paket sudah mencakup tiket masuk destinasi, sewa peralatan, instruktur, hingga retribusi lokal. Tanpa kaget biaya tersembunyi di tempat wisata.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. GALERI DOKUMENTASI AKTIVITAS (Soft Canvas Background) -->
    <section id="galeri" class="py-20 bg-canvas-soft border-y border-neutral-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12 reveal-fade-up">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                    Dokumentasi Asli
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-3 tracking-tight">
                    Momen Keseruan Wisatawan Bersama Puja
                </h2>
                <p class="text-slate-600 text-sm mt-2">
                    Foto-foto riil kebahagiaan wisatawan dan indahnya pesona Pangandaran. Klik gambar untuk melihat resolusi penuh.
                </p>
            </div>

            <!-- Dynamic Galleries Grid (Maks 4 Foto) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">
                @forelse($galleries->take(4) as $gIndex => $gal)
                    <div class="gallery-item cursor-pointer group relative h-40 sm:h-52 lg:h-64 rounded-xl sm:rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition bg-neutral-200 reveal-scale-up {{ $gIndex % 4 === 1 ? 'delay-100' : ($gIndex % 4 === 2 ? 'delay-150' : ($gIndex % 4 === 3 ? 'delay-200' : '')) }}"
                         data-img="{{ $gal->image_url }}"
                         data-caption="{{ $gal->title }} - {{ $gal->caption }}">
                        <img src="{{ $gal->image_url }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <div class="w-10 h-10 rounded-full bg-surface-soft text-slate-900 flex items-center justify-center shadow">
                                <i data-lucide="zoom-in" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-4 text-center py-8 text-slate-400">Belum ada foto galeri.</p>
                @endforelse
            </div>

            <!-- CTA: Lihat Selengkapnya (Halaman Galeri) -->
            <div class="mt-10 text-center reveal-fade-up">
                <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm shadow-sm hover:shadow-md transition group">
                    <span>Lihat Selengkapnya</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-emerald-400 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- 9. ULASAN & TESTIMONIAL PELANGGAN (Auto-Scrolling Marquee & Review Submission) -->
    <section id="testimoni" class="py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 reveal-fade-up">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                        Ulasan Terverifikasi
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-2 tracking-tight">
                        Apa Kata Wisatawan Tentang Puja Tour?
                    </h2>
                    <p class="text-slate-600 text-sm mt-2 max-w-xl">
                        Cerita nyata kepuasan dari wisatawan yang menikmati keindahan alam dan petualangan bahari Pangandaran bersama tim kami.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <button type="button" id="btn-open-review-modal" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-sm hover:shadow-md transition cursor-pointer">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                        <span>Tulis Ulasan Anda</span>
                    </button>
                    <a href="{{ route('testimonial') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-surface-soft hover:bg-neutral-100 text-slate-700 font-semibold text-xs sm:text-sm border border-neutral-200 transition">
                        <span>Lihat Semua ({{ $testimonials->count() }})</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            @if(session('testimonial_success'))
                <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm flex items-start gap-3 shadow-2xs">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5"></i>
                    <div>
                        <strong>Berhasil Terkirim!</strong>
                        <p class="mt-0.5">{{ session('testimonial_success') }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Marquee Showcase Container with Edge Fade Masks -->
        <div class="relative w-full overflow-hidden select-none py-2" id="testimonial-marquee-wrapper">
            <!-- Left & Right Gradient Fade Masks -->
            <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-8 sm:w-24 bg-gradient-to-r from-[#f4f6f1] to-transparent z-10"></div>
            <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-8 sm:w-24 bg-gradient-to-l from-[#f4f6f1] to-transparent z-10"></div>

            <!-- SVG Gold Star Gradient Definition -->
            <svg class="sr-only" aria-hidden="true" width="0" height="0">
                <defs>
                    <linearGradient id="goldStarGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="#FDE047" />
                        <stop offset="45%" stop-color="#F59E0B" />
                        <stop offset="100%" stop-color="#D97706" />
                    </linearGradient>
                </defs>
            </svg>

            <!-- The Marquee Track (Smooth Walking Animation, Pauses on Hover) -->
            <div id="testimonial-track" class="testimonial-marquee-track flex gap-6 px-4">
                @php
                    // Ensure at least 6-8 items for an infinite loop with zero visual gaps
                    $loopCount = $testimonials->count() < 4 ? 4 : 2;
                @endphp
                @for($repeat = 0; $repeat < $loopCount; $repeat++)
                    @foreach($testimonials as $tIndex => $testi)
                        <div class="testimonial-card w-77.5 sm:w-95 shrink-0 bg-surface-soft rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200 flex flex-col justify-between hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300">
                            <div>
                                <!-- Header: Bintang Emas di Tengah & Badge Terverifikasi -->
                                <div class="flex flex-col items-center justify-center text-center mb-4">
                                    <div class="flex items-center justify-center gap-1.5 mb-2">
                                        @php $rating = (int)($testi->rating ?? 5); @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $rating)
                                                <svg class="w-5 h-5 drop-shadow-[0_2px_4px_rgba(245,158,11,0.35)] transition-transform duration-200 hover:scale-115" viewBox="0 0 24 24" fill="url(#goldStarGrad)" stroke="#d97706" stroke-width="0.5">
                                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-slate-200" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200/80 shadow-2xs">
                                        <i data-lucide="badge-check" class="w-3.5 h-3.5 text-emerald-600"></i>
                                        <span>Terverifikasi</span>
                                    </span>
                                </div>
                                <p class="text-slate-700 text-xs sm:text-sm italic leading-relaxed line-clamp-4 text-center">
                                    "{{ $testi->review_text }}"
                                </p>
                            </div>
                            <div class="flex items-center gap-3.5 pt-5 mt-5 border-t border-neutral-200">
                                <div class="w-11 h-11 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold font-display text-base shrink-0 shadow-inner">
                                    {{ substr($testi->customer_name, 0, 2) }}
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-display font-bold text-slate-900 text-sm truncate">{{ $testi->customer_name }}</h4>
                                    <span class="text-xs text-slate-400 block truncate">{{ $testi->customer_city ?? 'Wisatawan' }} • {{ $testi->package_name ?? 'Paket Pangandaran' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>

    </section>

    <!-- 10. INTERACTIVE RESERVATION FORM / TRIP PLANNER (Solid Slate 900) -->
    <section id="booking-section" data-nav-color="dark" class="py-20 bg-slate-900 text-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal-fade-up">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">
                    Formulir Reservasi Cepat
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-white mt-3 tracking-tight">
                    Wujudkan Liburan Impian Anda ke Pangandaran
                </h2>
                <p class="text-slate-300 text-sm mt-2 max-w-xl mx-auto">
                    Isi formulir di bawah ini untuk konsultasi jadwal, custom itinerary, atau langsung terhubung dengan admin via WhatsApp.
                </p>
            </div>

            <div class="bg-surface-soft rounded-3xl p-6 sm:p-10 shadow-soft text-slate-800 border border-neutral-200 reveal-scale-up delay-100">
                <form class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Lengkap *</label>
                        <input type="text" id="calc-name" placeholder="Contoh: Budi Santoso" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-canvas text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 transition outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Catatan Khusus / Kustomisasi Rute</label>
                        <textarea id="calc-note" rows="3" placeholder="Tuliskan permintaan khusus (misal: butuh penjemputan stasiun, menu vegetarian, ada peserta lansia/anak)..." class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-canvas text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 transition outline-none"></textarea>
                    </div>

                    <div class="p-4 rounded-2xl bg-canvas border border-neutral-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2 text-xs text-slate-600">
                            <i data-lucide="shield-check" class="w-5 h-5 text-emerald-700 shrink-0"></i>
                            <span>Data Anda aman & langsung terhubung ke WhatsApp resmi Puja Tour.</span>
                        </div>
                        <button type="button" onclick="document.getElementById('btn-order-whatsapp').click()" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow-sm transition flex items-center justify-center gap-2">
                            <span>Kirim Permintaan Trip</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- 11. FAQ (FREQUENTLY ASKED QUESTIONS) ACCORDION -->
    <section id="faq" class="py-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal-fade-up">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                Tanya Jawab
            </span>
            <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-3 tracking-tight">
                Pertanyaan yang Sering Diajukan
            </h2>
            <p class="text-slate-600 text-sm mt-2">
                Informasi penting seputar persiapan trip, perlengkapan, dan jaminan kenyamanan Anda.
            </p>
        </div>

        <div class="space-y-4">
            @forelse($faqs as $fIndex => $faq)
                <div class="faq-item bg-surface-soft rounded-2xl border border-neutral-200 overflow-hidden shadow-soft reveal-fade-up {{ $fIndex % 2 === 1 ? 'delay-100' : '' }} {{ $fIndex === 0 ? 'is-active' : '' }}">
                    <button type="button" class="faq-toggle w-full px-6 py-4.5 text-left flex items-center justify-between font-display font-bold text-slate-900 text-base hover:text-emerald-700 transition cursor-pointer">
                        <span>{{ $faq->question }}</span>
                        <i data-lucide="chevron-down" class="faq-icon w-5 h-5 text-slate-400 transition-transform duration-300 shrink-0 {{ $fIndex === 0 ? 'rotate-180 text-emerald-700' : '' }}"></i>
                    </button>
                    <div class="faq-collapse {{ $fIndex === 0 ? 'is-open' : '' }}">
                        <div class="faq-collapse-inner">
                            <div class="faq-collapse-content px-6 pb-5 text-slate-600 text-xs sm:text-sm leading-relaxed border-t border-neutral-200/70 pt-3">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-slate-400">
                    <p class="text-sm">Belum ada daftar FAQ.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- 12. OFFICE LOCATION & CONTACT (CLEAN & SIMPLE) -->
    <section id="kontak" class="py-16 sm:py-20 bg-surface-soft border-t border-neutral-200/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mb-10 reveal-fade-up">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-2">Lokasi & Kontak</span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight">
                    Kunjungi Kami di Pangandaran
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Kantor operasional kami siap menyambut Anda untuk konsultasi rute, briefing keselamatan, titik kumpul trip, hingga penjemputan rombongan bus.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 items-stretch">
                <!-- Left: Compact & Clean Contact Card (1/2 width) -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 lg:p-9 shadow-sm border border-neutral-200 flex flex-col justify-between reveal-fade-left h-full">
                    <div class="space-y-5 text-sm">
                        <!-- 1. Alamat -->
                        <div>
                            <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Alamat Kantor</span>
                            <p class="font-medium text-slate-800 mt-1 leading-relaxed">{{ $officeAddr }}</p>
                            <span class="text-xs text-emerald-700 font-semibold block mt-1">Dekat Pantai Barat Pangandaran</span>
                        </div>

                        <hr class="border-neutral-100">

                        <!-- 2. WhatsApp & Telepon -->
                        <div>
                            <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">WhatsApp & Hotline</span>
                            <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" target="_blank" class="font-display font-bold text-lg text-emerald-700 hover:underline block mt-0.5">
                                {{ $phoneNum }}
                            </a>
                            <span class="text-xs text-slate-600 block mt-0.5">Online 24 Jam • Respon Cepat</span>
                        </div>

                        <hr class="border-neutral-100">

                        <!-- 3. Jam Operasional -->
                        <div>
                            <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Jam Operasional</span>
                            <p class="font-medium text-slate-800 mt-0.5">{{ $opHours }}</p>
                            <span class="text-xs text-slate-600 block mt-0.5">Buka setiap hari termasuk akhir pekan & libur nasional</span>
                        </div>

                        <hr class="border-neutral-100">

                        <!-- 4. Email -->
                        <div>
                            <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Email Resmi</span>
                            <a href="mailto:{{ $emailAddr }}" class="font-medium text-slate-800 hover:text-emerald-700 transition block mt-0.5">
                                {{ $emailAddr }}
                            </a>
                            <span class="text-xs text-slate-600 block mt-0.5">Untuk permintaan surat, proposal & invoice instansi</span>
                        </div>
                    </div>

                    <!-- Clean Action Buttons -->
                    <div class="pt-6 mt-6 border-t border-neutral-100 flex flex-col sm:flex-row gap-3">
                        <a href="https://maps.google.com/?q={{ urlencode($officeAddr) }}" target="_blank" rel="noopener noreferrer" class="flex-1 py-3 px-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm text-center transition shadow-xs">
                            Buka Google Maps
                        </a>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" target="_blank" rel="noopener noreferrer" class="flex-1 py-3 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs sm:text-sm text-center transition">
                            Chat WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Right: Clean Interactive Google Map (1/2 width, exact same height) -->
                <div class="reveal-fade-right h-full flex flex-col">
                    <div class="flex-1 w-full min-h-95 lg:min-h-0 rounded-3xl overflow-hidden shadow-sm border border-neutral-200 bg-slate-100 relative">
                        <iframe 
                            title="Lokasi Kantor Puja Tour Pangandaran"
                            src="{{ $settings['google_maps_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.739775073105!2d108.6477546!3d-7.6974127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6598c19958348b%3A0x6b45f949c256ca61!2sPantai%20Pangandaran!5e0!3m2!1sid!2sid!4v1709800000000!5m2!1sid!2sid' }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="absolute inset-0 w-full h-full">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 13. GLOBAL FOOTER (Solid Slate 950) -->
    <footer data-nav-color="dark" class="bg-slate-950 text-slate-400 text-xs py-14 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 shrink-0 flex items-center justify-center">
                            <img src="{{ asset('images/puja_logo.png') }}" alt="Puja Tour Travel" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <span class="font-display font-extrabold text-xl text-white block">{{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN' }}</span>
                            <span class="text-[10px] text-emerald-400 tracking-widest uppercase font-bold">Pangandaran Destination Specialist</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                        Mitra terpercaya liburan dan petualangan di Pangandaran. Berbadan hukum resmi CV dengan pemandu lokal bersertifikat HPI dan standar keselamatan teruji.
                    </p>
                    <div class="flex items-center gap-2.5 pt-2 text-slate-300">
                        <a href="{{ $igUrl }}" target="_blank" aria-label="Instagram" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                            </svg>
                        </a>
                        <a href="{{ $tiktokUrl }}" target="_blank" aria-label="TikTok" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.298-.002.595.042.88.13V9.4a6.33 6.33 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.66a6.34 6.34 0 0 0 10.82 4.49 6.27 6.27 0 0 0 1.89-4.49V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-.9-.07z"/>
                            </svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" aria-label="Facebook" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                        </a>
                        <a href="https://youtube.com" target="_blank" aria-label="YouTube" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33zM9.75 15.02V8.5l5.75 3.26-5.75 3.26z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-4">Navigasi</h4>
                    <ul class="space-y-2.5">
                        @if(!request()->routeIs('packages.index'))
                            <li><a href="{{ route('packages.index') }}" class="hover:text-emerald-400 transition">Paket Wisata</a></li>
                        @endif
                        @if(!request()->routeIs('about'))
                            <li><a href="{{ route('about') }}" class="hover:text-emerald-400 transition">Tentang Kami</a></li>
                        @endif
                        @if(!request()->routeIs('calculator'))
                            <li><a href="{{ route('calculator') }}" class="hover:text-emerald-400 transition">Estimasi Biaya</a></li>
                        @endif
                        @if(!request()->routeIs('gallery'))
                            <li><a href="{{ route('gallery') }}" class="hover:text-emerald-400 transition">Galeri Foto</a></li>
                        @endif
                        @if(!request()->routeIs('testimonial'))
                            <li><a href="{{ route('testimonial') }}" class="hover:text-emerald-400 transition">Ulasan Wisatawan</a></li>
                        @endif
                        @if(!request()->routeIs('faq'))
                            <li><a href="{{ route('faq') }}" class="hover:text-emerald-400 transition">Tanya Jawab (FAQ)</a></li>
                        @endif
                        @if(!request()->routeIs('contact'))
                            <li><a href="{{ route('contact') }}" class="hover:text-emerald-400 transition">Kontak & Lokasi</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Col 3: Paket Populer (Dynamic) -->
                <div>
                    <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-4">Paket Favorit</h4>
                    <ul class="space-y-2.5">
                        @foreach($packages->take(5) as $fp)
                            <li><a href="{{ route('packages.show', $fp->slug) }}" class="hover:text-emerald-400 transition">{{ $fp->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 4: Pembayaran Aman -->
                <div>
                    <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-4">Pembayaran Aman</h4>
                    <p class="text-[11px] text-slate-400 mb-3">Menerima transfer bank resmi CV & pembayaran digital:</p>
                    <div class="grid grid-cols-2 gap-2 text-center text-[10px] font-bold text-slate-200">
                        <div class="bg-slate-900 py-1.5 px-2 rounded-md border border-slate-800">BCA</div>
                        <div class="bg-slate-900 py-1.5 px-2 rounded-md border border-slate-800">MANDIRI</div>
                        <div class="bg-slate-900 py-1.5 px-2 rounded-md border border-slate-800">BRI</div>
                        <div class="bg-slate-900 py-1.5 px-2 rounded-md border border-slate-800">QRIS</div>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-500">
                <p>© {{ date('Y') }} {{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN' }}. Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2">
                    <a href="{{ route('privacy-policy') }}" class="hover:text-emerald-400 transition">Kebijakan Privasi</a>
                    <span>•</span>
                    <a href="{{ route('terms-conditions') }}" class="hover:text-emerald-400 transition">Syarat & Ketentuan</a>
                    <span>•</span>
                    <a href="{{ route('refund-policy') }}" class="hover:text-emerald-400 transition">Kebijakan Pengembalian</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- 14. FLOATING WHATSAPP BUTTON (Solid Emerald) -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour%20%26%20Travel,%20saya%20ingin%20tanya%20info%20paket%20wisata%20Pangandaran" 
       target="_blank" 
       aria-label="Hubungi WhatsApp Puja Tour"
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center group">
        <span class="absolute -top-10 right-0 bg-slate-900 text-white text-[11px] font-bold px-3 py-1 rounded-xl shadow-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition duration-200 pointer-events-none flex items-center gap-1">
            <i data-lucide="message-circle" class="w-3 h-3 text-emerald-400"></i>
            <span>Tanya Admin Langsung</span>
        </span>
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

    <!-- 15. GALLERY LIGHTBOX MODAL WITH FULL SLIDER CAROUSEL -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-slate-950/95 backdrop-blur-md hidden items-center justify-center p-3 sm:p-6 select-none" role="dialog" aria-modal="true" aria-label="Galeri Foto Wisata">
        <!-- Top Controls Bar -->
        <div class="absolute top-3 left-3 right-3 sm:top-6 sm:left-6 sm:right-6 z-30 flex items-center justify-between gap-2 pointer-events-none">
            <!-- Left Info Badges -->
            <div class="flex items-center gap-1.5 sm:gap-3 pointer-events-auto min-w-0 shrink">
                <div class="px-2.5 py-1.5 sm:px-3.5 sm:py-1.5 rounded-full bg-slate-900/90 border border-white/20 backdrop-blur-md flex items-center gap-1.5 sm:gap-2 shadow-lg min-w-0">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                    <span id="lightbox-title" class="text-xs sm:text-sm font-bold text-white max-w-[90px] xs:max-w-[140px] sm:max-w-xs md:max-w-md truncate">Galeri Foto</span>
                </div>
                <span id="lightbox-counter" class="text-[11px] sm:text-xs font-semibold px-2.5 py-1.5 sm:px-3 sm:py-1.5 rounded-full bg-white/10 text-emerald-300 border border-white/15 shadow-sm shrink-0 whitespace-nowrap">
                    Foto 1 / 1
                </span>
            </div>

            <!-- Right Controls (Autoplay Toggle, Fit Mode, Fullscreen & Close) -->
            <div class="flex items-center gap-1.5 sm:gap-2 pointer-events-auto shrink-0">
                <button id="lightbox-autoplay-btn" type="button" aria-label="Jeda Slide Otomatis" title="Jeda / Lanjut Putar Otomatis (Spasi)" class="hidden sm:inline-flex items-center gap-1.5 p-2 sm:px-3.5 sm:py-2 rounded-full bg-slate-900/90 hover:bg-slate-800 border border-white/20 text-xs font-medium text-white/90 cursor-pointer transition shadow-lg">
                    <i data-lucide="pause" class="w-4 h-4 sm:w-3.5 sm:h-3.5 text-emerald-400" id="lightbox-play-icon"></i>
                    <span id="lightbox-autoplay-label" class="hidden md:inline">Auto-Slide Aktif</span>
                </button>
                <button id="lightbox-fit-btn" type="button" aria-label="Mode Tampilan" title="Ganti Mode Tampilan (Penuh / Proporsional) (M)" class="inline-flex items-center gap-1.5 p-2 sm:px-3.5 sm:py-2 rounded-full bg-slate-900/90 hover:bg-slate-800 border border-white/20 text-xs font-medium text-white/90 cursor-pointer transition shadow-lg">
                    <i data-lucide="maximize" class="w-4 h-4 sm:w-3.5 sm:h-3.5 text-emerald-400" id="lightbox-fit-icon"></i>
                    <span id="lightbox-fit-label" class="hidden sm:inline">Mode Penuh</span>
                </button>
                <button id="lightbox-fullscreen-btn" type="button" aria-label="Layar Penuh" title="Layar Penuh (F)" class="hidden md:inline-flex items-center gap-1.5 p-2 sm:px-3.5 sm:py-2 rounded-full bg-slate-900/90 hover:bg-slate-800 border border-white/20 text-xs font-medium text-white/90 cursor-pointer transition shadow-lg">
                    <i data-lucide="expand" class="w-4 h-4 sm:w-3.5 sm:h-3.5 text-emerald-400" id="lightbox-fullscreen-icon"></i>
                    <span id="lightbox-fullscreen-label" class="hidden lg:inline">Layar Penuh</span>
                </button>
                <button id="lightbox-close" aria-label="Tutup Galeri" title="Tutup (Esc)" class="text-white/80 hover:text-white p-2 sm:p-2.5 rounded-full bg-slate-900/90 hover:bg-slate-800 border border-white/20 transition cursor-pointer shadow-lg shrink-0">
                    <i data-lucide="x" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                </button>
            </div>
        </div>

        <!-- Slider Navigation Arrows -->
        <button id="lightbox-prev" aria-label="Foto Sebelumnya" title="Sebelumnya (←)" class="absolute left-2 sm:left-4 md:left-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-slate-900/80 hover:bg-slate-900 border border-white/20 text-white flex items-center justify-center transition-all duration-200 shadow-2xl hover:scale-105 cursor-pointer">
            <i data-lucide="chevron-left" class="w-6 h-6 sm:w-7 sm:h-7"></i>
        </button>
        <button id="lightbox-next" aria-label="Foto Selanjutnya" title="Selanjutnya (→)" class="absolute right-2 sm:right-4 md:right-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-slate-900/80 hover:bg-slate-900 border border-white/20 text-white flex items-center justify-center transition-all duration-200 shadow-2xl hover:scale-105 cursor-pointer">
            <i data-lucide="chevron-right" class="w-6 h-6 sm:w-7 sm:h-7"></i>
        </button>

        <!-- Main Slider Viewport (Immersive Full Dimensions, Edge-to-Edge Responsive) -->
        <div class="relative w-full max-w-[94vw] 2xl:max-w-[92vw] h-[82vh] sm:h-[86vh] flex flex-col items-center justify-center pt-14 sm:pt-16 pb-16 px-1 sm:px-6">
            <div id="lightbox-image-container" class="relative w-full h-full flex items-center justify-center overflow-hidden">
                <img id="lightbox-image" src="" alt="Galeri Preview" title="Klik untuk beralih mode penuh / pas" class="max-w-full max-h-full w-auto h-auto object-contain rounded-2xl sm:rounded-3xl shadow-2xl border border-white/15 cursor-zoom-in transition-all duration-300 select-none">
            </div>
            <p id="lightbox-caption" class="text-slate-200 text-xs sm:text-sm mt-2.5 font-medium text-center px-4 max-w-4xl line-clamp-2 drop-shadow-md" style="transition: opacity 0.2s ease, transform 0.2s ease;"></p>
        </div>

        <!-- Bottom Actions & Dot Thumbnails -->
        <div class="absolute bottom-3 sm:bottom-5 left-1/2 -translate-x-1/2 z-30 flex flex-col sm:flex-row items-center gap-2.5 w-full max-w-xl px-4 justify-center">
            <!-- Thumbnail Dots -->
            <div id="lightbox-dots" class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-900/80 border border-white/15 backdrop-blur-md shadow-md">
            </div>

            <!-- Quick Action Links -->
            <div class="flex items-center gap-2">
                <a id="lightbox-detail-link" href="#" class="hidden px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold border border-white/20 transition gap-1.5 shadow-md">
                    <span>Baca Selengkapnya</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
                <a id="lightbox-wa-link" href="#" target="_blank" data-whatsapp="{{ $waNum }}" class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-md">
                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                    <span>Tanya via WhatsApp</span>
                </a>
            </div>
        </div>
    </div>

    <!-- MODAL TULIS ULASAN / TESTIMONI WISATAWAN -->
    <div id="review-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <!-- Backdrop -->
        <div id="review-modal-backdrop" class="fixed inset-0 bg-slate-950/65 backdrop-blur-xs transition-opacity duration-300 opacity-0 cursor-pointer"></div>

        <!-- Modal Box -->
        <div id="review-modal-box" class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-neutral-200 z-10 transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between pb-4 border-b border-neutral-200">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">Form Ulasan Tamu</span>
                    <h3 class="font-display font-extrabold text-xl text-slate-900 mt-1">Bagikan Pengalaman Liburan Anda</h3>
                </div>
                <button type="button" id="btn-close-review-modal" aria-label="Tutup Modal" class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-neutral-100 transition cursor-pointer">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <p class="text-xs text-slate-600 mt-3 leading-relaxed">
                Ceritakan kepuasan dan momen berkesan Anda bersama Puja Tour & Travel. Ulasan Anda akan ditinjau oleh admin sebelum ditampilkan ke publik.
            </p>

            <form id="form-submit-review" action="{{ route('testimonial.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Lengkap / Panggilan *</label>
                    <input type="text" name="customer_name" required placeholder="Contoh: Rian & Annisa / Budi Santoso" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-slate-50 text-slate-900 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Kota Asal / Domisili</label>
                        <input type="text" name="customer_city" placeholder="Contoh: Bandung / Jakarta" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-slate-50 text-slate-900 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Paket yang Diikuti</label>
                        <select name="package_name" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-slate-50 text-slate-900 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                            <option value="">-- Pilih Paket (Opsional) --</option>
                            @if(isset($allPackages))
                                @foreach($allPackages as $p)
                                    <option value="{{ $p->name }}">{{ $p->name }}</option>
                                @endforeach
                            @endif
                            <option value="Body Rafting Green Canyon">Body Rafting Green Canyon</option>
                            <option value="Snorkeling Pantai Pasir Putih">Snorkeling Pantai Pasir Putih</option>
                            <option value="Sunset & Surfing Batu Karas">Sunset & Surfing Batu Karas</option>
                            <option value="Custom Family / Corporate Gathering">Custom Family / Corporate Gathering</option>
                        </select>
                    </div>
                </div>

                <!-- Interactive Star Rating -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Rating Kepuasan *</label>
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-neutral-200">
                        <div class="flex items-center gap-1 text-2xl text-slate-300" id="star-rating-group">
                            <button type="button" data-rating="1" class="star-btn cursor-pointer text-amber-400">★</button>
                            <button type="button" data-rating="2" class="star-btn cursor-pointer text-amber-400">★</button>
                            <button type="button" data-rating="3" class="star-btn cursor-pointer text-amber-400">★</button>
                            <button type="button" data-rating="4" class="star-btn cursor-pointer text-amber-400">★</button>
                            <button type="button" data-rating="5" class="star-btn cursor-pointer text-amber-400">★</button>
                        </div>
                        <span id="star-rating-label" class="text-xs font-bold text-slate-800">5 Bintang (Sangat Puas)</span>
                    </div>
                    <input type="hidden" name="rating" id="input-rating-value" value="5">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Ulasan Pengalaman Wisata *</label>
                    <textarea name="review_text" rows="3" required placeholder="Ceritakan bagaimana keseruan trip, keramahan pemandu, atau keamanan fasilitas bersama Puja Tour..." class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-slate-50 text-slate-900 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition"></textarea>
                </div>

                <!-- Moderation Notice -->
                <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-start gap-2.5">
                    <i data-lucide="shield-check" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                    <p class="leading-relaxed">
                        Ulasan Anda akan diteruskan ke <strong>panel admin Puja Tour</strong> untuk diverifikasi (ACC) sebelum ditampilkan di website agar terhindar dari spam.
                    </p>
                </div>

                <div class="pt-2 flex items-center justify-end gap-3">
                    <button type="button" id="btn-cancel-review" class="px-5 py-2.5 rounded-xl border border-neutral-200 text-slate-600 hover:bg-neutral-100 font-semibold text-xs transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit-review" class="px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <span id="btn-submit-text">Kirim Ulasan</span>
                        <i data-lucide="send" class="w-3.5 h-3.5" id="btn-submit-icon"></i>
                    </button>
                </div>
            </form>

            <!-- Success State Message (hidden by default) -->
            <div id="review-success-state" class="hidden py-8 text-center space-y-4">
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-700 mx-auto flex items-center justify-center shadow-inner">
                    <i data-lucide="check-circle-2" class="w-8 h-8"></i>
                </div>
                <h4 class="font-display font-extrabold text-xl text-slate-900">Ulasan Berhasil Dikirim!</h4>
                <p class="text-xs text-slate-600 max-w-sm mx-auto leading-relaxed">
                    Terima kasih atas ulasan berharga Anda! Testimoni telah diteruskan ke panel admin Puja Tour & Travel untuk diverifikasi sebelum dipublikasikan.
                </p>
                <div class="pt-2">
                    <button type="button" id="btn-close-review-success" class="px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition cursor-pointer">
                        Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal Interactive Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Review Submission Modal Logic ---
        var reviewModal = document.getElementById('review-modal');
        var modalBackdrop = document.getElementById('review-modal-backdrop');
        var modalBox = document.getElementById('review-modal-box');
        var openModalBtn = document.getElementById('btn-open-review-modal');
        var closeModalBtn = document.getElementById('btn-close-review-modal');
        var cancelModalBtn = document.getElementById('btn-cancel-review');
        var closeSuccessBtn = document.getElementById('btn-close-review-success');
        var reviewForm = document.getElementById('form-submit-review');
        var reviewSuccessState = document.getElementById('review-success-state');

        function openReviewModal() {
            if (!reviewModal) return;
            reviewModal.classList.remove('hidden');
            reviewModal.classList.add('flex');
            setTimeout(function() {
                modalBackdrop.classList.remove('opacity-0');
                modalBox.classList.remove('scale-95', 'opacity-0');
                modalBox.classList.add('scale-100', 'opacity-100');
            }, 20);
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }

        function closeReviewModal() {
            if (!reviewModal) return;
            modalBackdrop.classList.add('opacity-0');
            modalBox.classList.remove('scale-100', 'opacity-100');
            modalBox.classList.add('scale-95', 'opacity-0');
            setTimeout(function() {
                reviewModal.classList.remove('flex');
                reviewModal.classList.add('hidden');
                if (reviewSuccessState) reviewSuccessState.classList.add('hidden');
                if (reviewForm) {
                    reviewForm.classList.remove('hidden');
                    reviewForm.reset();
                    setRating(5);
                }
            }, 300);
        }

        if (openModalBtn) openModalBtn.addEventListener('click', openReviewModal);
        if (closeModalBtn) closeModalBtn.addEventListener('click', closeReviewModal);
        if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeReviewModal);
        if (closeSuccessBtn) closeSuccessBtn.addEventListener('click', closeReviewModal);
        if (modalBackdrop) modalBackdrop.addEventListener('click', closeReviewModal);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && reviewModal && !reviewModal.classList.contains('hidden')) {
                closeReviewModal();
            }
        });

        // --- Star Rating Interactive Selector ---
        var starButtons = document.querySelectorAll('.star-btn');
        var ratingInput = document.getElementById('input-rating-value');
        var ratingLabel = document.getElementById('star-rating-label');

        var ratingLabels = {
            1: '1 Bintang (Kurang Puas)',
            2: '2 Bintang (Cukup)',
            3: '3 Bintang (Puas)',
            4: '4 Bintang (Sangat Puas)',
            5: '5 Bintang (Sangat Puas & Istimewa)'
        };

        function setRating(val) {
            val = parseInt(val, 10);
            if (ratingInput) ratingInput.value = val;
            if (ratingLabel) ratingLabel.textContent = ratingLabels[val] || (val + ' Bintang');

            starButtons.forEach(function(btn) {
                var r = parseInt(btn.getAttribute('data-rating'), 10);
                if (r <= val) {
                    btn.classList.add('text-amber-400');
                    btn.classList.remove('text-slate-300');
                } else {
                    btn.classList.remove('text-amber-400');
                    btn.classList.add('text-slate-300');
                }
            });
        }

        starButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var r = this.getAttribute('data-rating');
                setRating(r);
            });
        });

        // --- Form AJAX Submission ---
        if (reviewForm) {
            reviewForm.addEventListener('submit', function(e) {
                e.preventDefault();

                var submitBtn = document.getElementById('btn-submit-review');
                var submitText = document.getElementById('btn-submit-text');

                if (submitBtn) {
                    submitBtn.disabled = true;
                    if (submitText) submitText.textContent = 'Mengirim...';
                }

                var formData = new FormData(reviewForm);

                fetch(reviewForm.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(res) {
                    return res.json();
                })
                .then(function(data) {
                    if (data.success) {
                        reviewForm.classList.add('hidden');
                        if (reviewSuccessState) {
                            reviewSuccessState.classList.remove('hidden');
                        }
                    } else {
                        alert(data.message || 'Gagal mengirim ulasan. Silakan periksa kembali formulir.');
                        if (submitBtn) submitBtn.disabled = false;
                        if (submitText) submitText.textContent = 'Kirim Ulasan';
                    }
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                })
                .catch(function(err) {
                    console.error(err);
                    reviewForm.submit();
                });
            });
        }
    });
    </script>
</body>
</html>
