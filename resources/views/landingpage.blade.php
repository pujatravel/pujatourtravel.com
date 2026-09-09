<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Puja Tour & Travel Pangandaran — Jelajahi Pesona Bahari & Petualangan Green Canyon</title>
    <meta name="description" content="Puja Tour & Travel Pangandaran menyediakan paket wisata eksklusif, body rafting Green Canyon, snorkeling Pasir Putih, dan petualangan alam terbaik bersama pemandu lokal berlisensi resmi.">
    <meta name="keywords" content="Puja Tour Travel, Wisata Pangandaran, Paket Wisata Pangandaran, Body Rafting Green Canyon, Pasir Putih Pangandaran, Batu Karas, Tour Guide Pangandaran">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Meta Sosial -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Puja Tour & Travel Pangandaran — Petualangan Alam & Bahari Terbaik">
    <meta property="og:description" content="Paket liburan Pangandaran terlengkap, legalitas resmi CV, pemandu bersertifikasi HPI, dan jaminan kenyamanan liburan Anda.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Puja Tour & Travel Pangandaran — Petualangan Alam & Bahari Terbaik">
    <meta name="twitter:description" content="Paket liburan Pangandaran terlengkap, legalitas resmi CV, pemandu bersertifikasi HPI, dan jaminan kenyamanan liburan Anda.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): TravelAgency -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => 'Puja Tour Travel',
        'description' => 'Biro perjalanan wisata resmi di Pangandaran yang menyediakan paket tur Green Canyon, body rafting, dan wisata bahari.',
        'url' => url('/'),
        'telephone' => $settings['phone_number'] ?? '+6281234567890',
        'email' => $settings['email_address'] ?? 'info@pujatourtravel.com',
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
            'https://instagram.com/pujatourtravel',
            'https://tiktok.com/@pujatourtravel',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Structured Data (JSON-LD): WebSite with SearchAction — enables Google Sitelinks Search Box -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Puja Tour Travel',
        'alternateName' => 'Puja Tour & Travel Pangandaran',
        'url' => url('/'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => route('packages.index') . '?search={search_term_string}',
            ],
            'query-input' => 'required name=search_term_string',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/puja_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/puja_logo.png') }}">

    <!-- Vite Assets -->
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
        $opHours = $settings['operational_hours'] ?? 'Setiap Hari: 06.00 - 21.00 WIB';
        $igUrl = $settings['instagram_url'] ?? 'https://instagram.com/pujatourtravel';
        $tiktokUrl = $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel';
    @endphp


    <!-- 2. STICKY NAVBAR (Seamless Borderless Design) -->
    <header id="main-header" class="sticky top-0 z-40 w-full bg-surface-soft/95 backdrop-blur-md transition-all duration-300 py-3.5 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Brand Logo (Clean Borderless) -->
            <a href="#" class="flex items-center gap-3 group">
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

            <!-- Desktop Nav Items -->
            <nav class="hidden lg:flex items-center gap-7 font-medium text-slate-600 text-sm">
                <a href="{{ route('home') }}" class="text-emerald-700 font-semibold hover:text-emerald-800 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="hover:text-emerald-700 transition">Paket Wisata</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-700 transition">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="hover:text-emerald-700 transition">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="hover:text-emerald-700 transition">FAQ</a>
                <a href="{{ route('gallery') }}" class="hover:text-emerald-700 transition">Galeri</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak</a>
            </nav>

            <!-- Header Action CTA -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20paket%20wisata%20Pangandaran" target="_blank" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Tanya Trip CS</span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" aria-label="Buka Menu" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Drawer & Backdrop -->
    <div id="drawer-overlay" class="fixed inset-0 bg-slate-900/60 z-50 hidden opacity-0 transition-opacity duration-300"></div>
    <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-4/5 max-w-sm bg-surface-soft border-l border-neutral-200 z-50 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col justify-between p-6">
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
                <a href="{{ route('home') }}" class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 text-emerald-700 font-bold transition">
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
    <section id="beranda" class="relative min-h-[88vh] flex items-center justify-center overflow-hidden bg-slate-950 group">
        <!-- Hero Background Auto-Slider Container -->
        <div id="hero-slider" class="absolute inset-0 z-0 overflow-hidden select-none">
            <!-- Slide 1 -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100" data-location="Pantai Pangandaran • Hamparan Pasir & Pesona Bahari">
                <img src="{{ asset('images/hero_pangandaran.jpg') }}" alt="Pantai Pangandaran" class="w-full h-full object-cover object-center scale-105 transition-transform duration-7000 ease-out">
            </div>
            <!-- Slide 2 -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 pointer-events-none" data-location="Green Canyon Cukang Taneuh • Ngarai Stalaktit Air Zamrud">
                <img src="{{ asset('images/greencanyon.jpg') }}" alt="Green Canyon" class="w-full h-full object-cover object-center scale-105 transition-transform duration-7000 ease-out">
            </div>
            <!-- Slide 3 -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 pointer-events-none" data-location="Pantai Pasir Putih • Snorkeling Terumbu Karang & Ikan Badut">
                <img src="{{ asset('images/pasir_putih.jpg') }}" alt="Pasir Putih" class="w-full h-full object-cover object-center scale-105 transition-transform duration-7000 ease-out">
            </div>
            <!-- Slide 4 -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 pointer-events-none" data-location="Pantai Batu Karas • Golden Sunset & Wisata Selancar">
                <img src="{{ asset('images/sunset_batu_karas.jpg') }}" alt="Batu Karas" class="w-full h-full object-cover object-center scale-105 transition-transform duration-7000 ease-out">
            </div>
            <!-- Slide 5 -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 pointer-events-none" data-location="Cagar Alam Pananjung • Hutan Lindung Tropis & Satwa Liar">
                <img src="{{ asset('images/cagar_alam.jpg') }}" alt="Cagar Alam" class="w-full h-full object-cover object-center scale-105 transition-transform duration-7000 ease-out">
            </div>

            <!-- Deep Scrim Overlay for Crystal Clear Text Contrast -->
            <div class="absolute inset-0 bg-linear-to-b from-slate-950/85 via-slate-950/75 to-slate-950/90 z-1"></div>
        </div>

        <!-- Floating Destination Badge (Auto-updates with slide in top-right corner) -->
        <div class="absolute top-6 right-4 sm:right-8 z-20 hidden md:inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/80 backdrop-blur-md border border-white/20 text-xs font-medium text-emerald-300 shadow-lg">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span id="hero-location-text">Pantai Pangandaran • Hamparan Pasir & Pesona Bahari</span>
        </div>

        <!-- Hero Slider Arrow Navigation Controls -->
        <button id="hero-prev-btn" type="button" aria-label="Slide Sebelumnya" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-slate-900/60 hover:bg-slate-900/90 border border-white/20 text-white flex items-center justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition duration-300 shadow-xl cursor-pointer">
            <i data-lucide="chevron-left" class="w-6 h-6"></i>
        </button>
        <button id="hero-next-btn" type="button" aria-label="Slide Selanjutnya" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-slate-900/60 hover:bg-slate-900/90 border border-white/20 text-white flex items-center justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition duration-300 shadow-xl cursor-pointer">
            <i data-lucide="chevron-right" class="w-6 h-6"></i>
        </button>

        <!-- Slide Indicators (Pills & Active Indicator elevated safely above bottom cards) -->
        <div id="hero-dots" class="absolute bottom-16 sm:bottom-20 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/80 backdrop-blur-md border border-white/15 shadow-md">
            <button type="button" class="hero-dot w-8 h-2 rounded-full bg-emerald-400 transition-all duration-300 cursor-pointer" data-slide="0" aria-label="Slide 1"></button>
            <button type="button" class="hero-dot w-2.5 h-2 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="1" aria-label="Slide 2"></button>
            <button type="button" class="hero-dot w-2.5 h-2 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="2" aria-label="Slide 3"></button>
            <button type="button" class="hero-dot w-2.5 h-2 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="3" aria-label="Slide 4"></button>
            <button type="button" class="hero-dot w-2.5 h-2 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="4" aria-label="Slide 5"></button>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:pt-20 lg:pb-28 w-full">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left Content -->
                <div class="lg:col-span-7 text-center lg:text-left space-y-6">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-emerald-300 text-xs sm:text-sm font-semibold">
                        <i data-lucide="sparkles" class="w-4 h-4 text-amber-400"></i>
                        <span>Partner Resmi Wisata & Petualangan Pangandaran</span>
                    </div>

                    <!-- Main H1 Title (Solid Colors) -->
                    <h1 class="font-display font-extrabold text-4xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-[1.15]">
                        Jelajahi Pesona Bahari & Petualangan <span class="text-emerald-400">Pangandaran</span> Tak Terlupakan
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-base sm:text-lg text-slate-200 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                        Nikmati sensasi seru Body Rafting Green Canyon, panorama eksotis Pasir Putih, dan pesona bahari terbaik bersama pemandu lokal profesional tersertifikasi HPI. Liburan aman, nyaman, dan berkesan.
                    </p>

                    <!-- Trust Stats Counter -->
                    <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/15 max-w-lg mx-auto lg:mx-0 text-white">
                        <div>
                            <div class="font-display font-bold text-2xl sm:text-3xl text-amber-400">5.000+</div>
                            <div class="text-xs text-slate-300">Wisatawan Puas</div>
                        </div>
                        <div>
                            <div class="font-display font-bold text-2xl sm:text-3xl text-emerald-400">100%</div>
                            <div class="text-xs text-slate-300">Pemandu Berlisensi</div>
                        </div>
                        <div>
                            <div class="font-display font-bold text-2xl sm:text-3xl text-white flex items-center justify-center lg:justify-start gap-1">
                                <span>4.9/5</span>
                                <i data-lucide="star" class="w-5 h-5 fill-amber-400 text-amber-400"></i>
                            </div>
                            <div class="text-xs text-slate-300">Ulasan Google</div>
                        </div>
                    </div>

                    <!-- Call To Action Buttons (Solid Colors) -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#paket" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-base shadow-sm transition flex items-center justify-center gap-2">
                            <span>Jelajahi Paket Wisata</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-slate-900/80 border border-white/20 hover:bg-slate-900 text-white font-semibold text-base transition flex items-center justify-center gap-2">
                            <i data-lucide="message-circle" class="w-5 h-5 text-emerald-400"></i>
                            <span>Konsultasi WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Right: Quick Trip Finder Widget -->
                <div class="lg:col-span-5">
                    <div class="bg-surface-soft rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200 text-slate-800">
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
                                    <input type="date" id="calc-date" min="{{ date('Y-m-d') }}" placeholder="Pilih tanggal trip..." class="w-full px-3.5 py-3 rounded-xl border border-neutral-200 bg-canvas text-slate-800 font-medium text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 transition outline-none custom-datepicker-input">
                                </div>
                            </div>

                            <!-- Calculation Result Box (Soft Natural Canvas) -->
                            <div class="p-4 rounded-2xl bg-canvas border border-neutral-200 flex items-center justify-between">
                                <div>
                                    <span class="text-xs font-medium text-slate-500 block">Estimasi Total Biaya</span>
                                    <span class="text-[10px] text-emerald-800 font-semibold bg-emerald-100 px-2 py-0.5 rounded inline-block mt-0.5">Termasuk Pemandu & Alat</span>
                                </div>
                                <div class="text-right">
                                    <span id="calc-total-display" class="font-display font-extrabold text-xl sm:text-2xl text-emerald-800">Rp 900.000</span>
                                </div>
                            </div>

                            <!-- Quick Action Button (Solid Emerald) -->
                            <button type="button" id="btn-order-whatsapp" data-whatsapp="{{ $waNum }}" class="w-full py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow-sm transition flex items-center justify-center gap-2">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Kirim & Booking via WhatsApp</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. TRUST ELEMENTS / 4 PILAR KREDIBILITAS (Soft Natural Surface Cards) -->
    <section class="relative -mt-10 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Card 1 -->
            <div class="bg-surface-soft rounded-2xl p-6 shadow-soft border border-neutral-200 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <i data-lucide="landmark" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Legalitas Usaha Resmi</h3>
                    <p class="text-xs text-slate-500 mt-1">Berbadan hukum CV resmi, terpercaya, dan amanah untuk corporate maupun keluarga.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-surface-soft rounded-2xl p-6 shadow-soft border border-neutral-200 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <i data-lucide="badge-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Pemandu Lisensi HPI</h3>
                    <p class="text-xs text-slate-500 mt-1">Guide lokal berpengalaman, ramah, dan bersertifikat resmi kepemanduan wisata.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-surface-soft rounded-2xl p-6 shadow-soft border border-neutral-200 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Standar Safety Teruji</h3>
                    <p class="text-xs text-slate-500 mt-1">Perlengkapan lifejacket, helmet, dan asuransi kecelakaan diri di setiap trip.</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-surface-soft rounded-2xl p-6 shadow-soft border border-neutral-200 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <i data-lucide="banknote" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Harga Jujur & Transparan</h3>
                    <p class="text-xs text-slate-500 mt-1">Tanpa biaya tersembunyi. Layanan all-inclusive tiket, instruktur, makan, dan dokumentasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. PAKET WISATA UNGGULAN (KATALOG DINAMIS BERBASIS DATABASE) -->
    <section id="paket" class="py-20 lg:py-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
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
            @forelse($packages as $pkg)
                <div class="package-card flex flex-col bg-surface-soft rounded-3xl overflow-hidden shadow-soft hover:shadow-card-hover transition-all duration-300 border border-neutral-200 group" data-category="{{ $pkg->category->slug ?? 'all' }}">
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
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/75 via-transparent to-slate-950/30 pointer-events-none"></div>

                        <!-- Category / Rekomendasi Badge (Top Left) -->
                        <div class="absolute top-4 left-4 z-10 pointer-events-none">
                            @if($pkg->featured)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500 text-slate-950 shadow-sm flex items-center gap-1">
                                    <i data-lucide="star" class="w-3 h-3 fill-slate-950"></i>
                                    <span>Rekomendasi</span>
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-700 text-white shadow-sm">
                                    {{ $pkg->category->name ?? 'Wisata' }}
                                </span>
                            @endif
                        </div>

                        <!-- Click to View Gallery Hover Badge (Top Right) -->
                        <div class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-900/85 backdrop-blur-md text-emerald-300 border border-white/20 shadow-md flex items-center gap-1.5">
                                <i data-lucide="camera" class="w-3.5 h-3.5 text-emerald-400"></i>
                                <span>{{ count($galleryImages) }} Foto (Buka)</span>
                            </span>
                        </div>

                        <!-- Duration Badge (Bottom Right) -->
                        @if($pkg->duration)
                            <div class="absolute bottom-3 right-3 z-10 pointer-events-none">
                                <span class="px-2.5 py-1 rounded-xl text-[11px] font-bold bg-slate-900/90 text-white flex items-center gap-1 backdrop-blur-xs shadow-md border border-white/10">
                                    <i data-lucide="clock" class="w-3 h-3 text-emerald-400"></i>
                                    <span>{{ $pkg->duration }}</span>
                                </span>
                            </div>
                        @endif

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
    <section id="destinasi" class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 bg-emerald-950 px-3 py-1 rounded-full border border-emerald-800">
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
                <div class="md:col-span-2 relative h-80 rounded-3xl overflow-hidden group shadow-md bg-slate-800">
                    <img src="{{ asset('images/greencanyon.jpg') }}" alt="Green Canyon Cukang Taneuh" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-slate-950/60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="text-xs font-bold text-emerald-300 bg-slate-900/80 px-3 py-1 rounded-full border border-emerald-700/50">Ngarai Tropis Ikonik</span>
                        <h3 class="font-display font-bold text-2xl text-white mt-2">Green Canyon (Cukang Taneuh)</h3>
                        <p class="text-xs text-slate-300 mt-1 max-w-md">Air zamrud berkilau di antara tebing stalaktit purba berusia jutaan tahun dengan pemandangan alami yang menenangkan.</p>
                    </div>
                </div>

                <div class="relative h-80 rounded-3xl overflow-hidden group shadow-md bg-slate-800">
                    <img src="{{ asset('images/pasir_putih.jpg') }}" alt="Pasir Putih & Snorkeling" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-slate-950/60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="text-xs font-bold text-emerald-300 bg-slate-900/80 px-3 py-1 rounded-full border border-emerald-700/50">Taman Laut Terumbu Karang</span>
                        <h3 class="font-display font-bold text-xl text-white mt-2">Pantai Pasir Putih</h3>
                        <p class="text-xs text-slate-300 mt-1">Snorkeling bersama ratusan ikan karang tropis di air laut yang jernih dan tenang.</p>
                    </div>
                </div>

                <div class="relative h-80 rounded-3xl overflow-hidden group shadow-md bg-slate-800">
                    <img src="{{ asset('images/sunset_batu_karas.jpg') }}" alt="Sunset Batu Karas" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-slate-950/60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="text-xs font-bold text-amber-400 bg-slate-900/80 px-3 py-1 rounded-full border border-amber-700/50">Surfing & Golden Sunset</span>
                        <h3 class="font-display font-bold text-xl text-white mt-2">Pantai Batu Karas</h3>
                        <p class="text-xs text-slate-300 mt-1">Titik sunset terindah di Jawa Barat dengan suasana santai dan deretan cafe kayu estetik.</p>
                    </div>
                </div>

                <div class="md:col-span-2 relative h-80 rounded-3xl overflow-hidden group shadow-md bg-slate-800">
                    <img src="{{ asset('images/cagar_alam.jpg') }}" alt="Cagar Alam Pananjung" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-slate-950/60"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="text-xs font-bold text-emerald-300 bg-slate-900/80 px-3 py-1 rounded-full border border-emerald-700/50">Hutan Lindung & Satwa Asli</span>
                        <h3 class="font-display font-bold text-2xl text-white mt-2">Taman Wisata Alam & Cagar Alam Pananjung</h3>
                        <p class="text-xs text-slate-300 mt-1 max-w-md">Jelajahi keasrian hutan hujan tropis dengan kawanan rusa liar, pohon beringin raksasa, dan situs gua bersejarah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. KEUNGGULAN / WHY CHOOSE PUJA TOUR & TRAVEL -->
    <section id="keunggulan" class="py-20 lg:py-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <!-- Left Image & Badge -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-lg border border-neutral-200">
                    <img src="{{ asset('images/greencanyon.jpg') }}" alt="Puja Tour Experience" class="w-full h-112.5 object-cover">
                </div>
                <!-- Floating Card (Soft Surface) -->
                <div class="absolute -bottom-6 -right-6 bg-surface-soft rounded-2xl p-5 shadow-soft border border-neutral-200 max-w-xs hidden sm:block">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                            <i data-lucide="award" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <div class="font-display font-bold text-slate-900 text-base">Pemandu Terpercaya</div>
                            <div class="text-xs text-slate-500">Pilihan #1 Wisatawan di Pangandaran</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                    Nilai Keunggulan Kami
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
                    Mengapa Wisatawan Memilih <span class="text-emerald-700">Puja Tour & Travel</span>?
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Kami bukan sekadar agen perjalanan umum. Kami adalah putra daerah asli Pangandaran yang berdedikasi menghadirkan petualangan autentik dengan standar keselamatan tertinggi, keramahan khas Sunda, dan harga transparan.
                </p>

                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-surface-soft shadow-soft border border-neutral-200">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 font-bold">
                            01
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 text-base">Pemandu Lokal Berlisensi Resmi HPI</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Memahami setiap sudut rahasia, arus sungai yang aman, dan spot foto terbaik yang jarang diketahui turis biasa.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-surface-soft shadow-soft border border-neutral-200">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 font-bold">
                            02
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 text-base">Safety First & Perlengkapan Standar</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Semua perlengkapan pelampung, helm, dan asuransi kecelakaan diri selalu diperiksa secara berkala sebelum trip.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-surface-soft shadow-soft border border-neutral-200">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 font-bold">
                            03
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 text-base">Dokumentasi HD & Drone Eksklusif</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Abadikan momen petualangan Anda dengan foto underwater dan video drone tanpa ribet bawa kamera sendiri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. GALERI DOKUMENTASI AKTIVITAS (Soft Canvas Background) -->
    <section id="galeri" class="py-20 bg-canvas-soft border-y border-neutral-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-surface-soft px-3 py-1 rounded-full border border-neutral-200">
                    Dokumentasi Asli
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-3 tracking-tight">
                    Momen Keseruan Wisatawan Bersama Puja
                </h2>
                <p class="text-slate-600 text-sm mt-2">
                    Foto-foto riil kebahagiaan wisatawan dan indahnya pesona Pangandaran. Klik gambar untuk melihat resolusi penuh.
                </p>
            </div>

            <!-- Dynamic Galleries Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($galleries as $gal)
                    <div class="gallery-item cursor-pointer group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition bg-neutral-200"
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
        </div>
    </section>

    <!-- 9. ULASAN & TESTIMONIAL PELANGGAN (Soft Surface Cards) -->
    <section id="testimoni" class="py-20 lg:py-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                Ulasan Terverifikasi
            </span>
            <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-3 tracking-tight">
                Apa Kata Wisatawan Tentang Puja Tour?
            </h2>
            <p class="text-slate-600 text-sm mt-2">
                Kepuasan dan senyuman Anda adalah prioritas utama seluruh tim kami di lapangan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($testimonials as $testi)
                <div class="bg-surface-soft rounded-3xl p-8 shadow-soft border border-neutral-200 flex flex-col justify-between hover:shadow-card-hover transition">
                    <div>
                        <div class="flex items-center text-amber-500 gap-1 text-sm mb-4">
                            @for($i = 0; $i < ($testi->rating ?? 5); $i++)
                                <i data-lucide="star" class="w-4 h-4 fill-amber-400 text-amber-400"></i>
                            @endfor
                        </div>
                        <p class="text-slate-700 text-sm italic leading-relaxed">
                            "{{ $testi->review_text }}"
                        </p>
                    </div>
                    <div class="flex items-center gap-4 pt-6 mt-6 border-t border-neutral-200">
                        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-800 flex items-center justify-center font-bold font-display text-lg">
                            {{ substr($testi->customer_name, 0, 2) }}
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 text-sm">{{ $testi->customer_name }}</h4>
                            <span class="text-xs text-slate-400">{{ $testi->customer_city ?? 'Wisatawan' }} • {{ $testi->package_name ?? 'Paket Pangandaran' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center py-8 text-slate-400">Belum ada testimoni.</p>
            @endforelse
        </div>
    </section>

    <!-- 10. INTERACTIVE RESERVATION FORM / TRIP PLANNER (Solid Slate 900) -->
    <section id="booking-section" class="py-20 bg-slate-900 text-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 bg-slate-800 px-3.5 py-1 rounded-full border border-slate-700">
                    Formulir Reservasi Cepat
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-white mt-3 tracking-tight">
                    Wujudkan Liburan Impian Anda ke Pangandaran
                </h2>
                <p class="text-slate-300 text-sm mt-2 max-w-xl mx-auto">
                    Isi formulir di bawah ini untuk konsultasi jadwal, custom itinerary, atau langsung terhubung dengan admin via WhatsApp.
                </p>
            </div>

            <div class="bg-surface-soft rounded-3xl p-6 sm:p-10 shadow-soft text-slate-800 border border-neutral-200">
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
        <div class="text-center mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
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
            @forelse($faqs as $index => $faq)
                <div class="bg-surface-soft rounded-2xl border border-neutral-200 overflow-hidden shadow-soft">
                    <button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between font-display font-bold text-slate-900 text-base hover:text-emerald-700 transition">
                        <span>{{ $faq->question }}</span>
                        <i data-lucide="chevron-down" class="faq-icon w-5 h-5 text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-6 pb-5 text-slate-600 text-xs sm:text-sm leading-relaxed border-t border-neutral-200 pt-3">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-slate-400">
                    <p class="text-sm">Belum ada daftar FAQ.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- 12. OFFICE LOCATION & CONTACT -->
    <section id="kontak" class="py-20 bg-canvas-soft border-t border-neutral-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-5 space-y-5">
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-surface-soft px-3 py-1 rounded-full border border-neutral-200">
                        Kantor Operasional
                    </span>
                    <h2 class="font-display font-extrabold text-3xl text-slate-900 tracking-tight">
                        Kunjungi Kami di Pangandaran
                    </h2>
                    <p class="text-slate-600 text-sm">
                        Kantor operasional kami siap menyambut Anda untuk konsultasi rute, titik kumpul trip, maupun penjemputan rombongan.
                    </p>

                    <div class="space-y-3.5 pt-2 text-sm text-slate-700">
                        <div class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5"></i>
                            <div>
                                <strong>Alamat Kantor:</strong>
                                <p class="text-xs text-slate-600 mt-0.5">{{ $officeAddr }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="phone" class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5"></i>
                            <div>
                                <strong>WhatsApp & Hotline:</strong>
                                <p class="text-xs text-slate-600 mt-0.5">{{ $phoneNum }} (Online 24 Jam)</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="mail" class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5"></i>
                            <div>
                                <strong>Email Resmi:</strong>
                                <p class="text-xs text-slate-600 mt-0.5">{{ $emailAddr }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="clock" class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5"></i>
                            <div>
                                <strong>Jam Pelayanan:</strong>
                                <p class="text-xs text-slate-600 mt-0.5">{{ $opHours }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="rounded-3xl overflow-hidden shadow-md border border-neutral-200 bg-neutral-200 h-80 relative">
                        <iframe 
                            title="Lokasi Puja Tour Pangandaran"
                            src="{{ $settings['google_maps_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.739775073105!2d108.6477546!3d-7.6974127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6598c19958348b%3A0x6b45f949c256ca61!2sPantai%20Pangandaran!5e0!3m2!1sid!2sid!4v1709800000000!5m2!1sid!2sid' }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 13. GLOBAL FOOTER (Solid Slate 950) -->
    <footer class="bg-slate-950 text-slate-400 text-xs py-14 border-t border-slate-800">
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
                        <li><a href="#beranda" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="#paket" class="hover:text-emerald-400 transition">Paket Wisata</a></li>
                        <li><a href="#destinasi" class="hover:text-emerald-400 transition">Destinasi Populer</a></li>
                        <li><a href="#keunggulan" class="hover:text-emerald-400 transition">Keunggulan Layanan</a></li>
                        <li><a href="#galeri" class="hover:text-emerald-400 transition">Galeri Foto</a></li>
                        <li><a href="#testimoni" class="hover:text-emerald-400 transition">Ulasan Wisatawan</a></li>
                    </ul>
                </div>

                <!-- Col 3: Paket Populer (Dynamic) -->
                <div>
                    <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-4">Paket Favorit</h4>
                    <ul class="space-y-2.5">
                        @foreach($packages->take(5) as $fp)
                            <li><a href="#paket" class="hover:text-emerald-400 transition">{{ $fp->name }}</a></li>
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
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.login') }}" class="hover:text-emerald-400 font-bold text-slate-400 flex items-center gap-1">
                        <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                        <span>Login Admin CMS</span>
                    </a>
                    <span>•</span>
                    <a href="#" class="hover:text-slate-400">Kebijakan Privasi</a>
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
        <div class="absolute top-4 left-4 right-4 sm:top-6 sm:left-6 sm:right-6 z-30 flex items-center justify-between pointer-events-none">
            <!-- Left Info Badges -->
            <div class="flex items-center gap-2 sm:gap-3 pointer-events-auto">
                <div class="px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-white/20 backdrop-blur-md flex items-center gap-2 shadow-lg">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span id="lightbox-title" class="text-xs sm:text-sm font-bold text-white max-w-35 sm:max-w-md truncate">Galeri Foto</span>
                </div>
                <span id="lightbox-counter" class="text-xs font-semibold px-3 py-1.5 rounded-full bg-white/10 text-emerald-300 border border-white/15 shadow-sm">
                    Foto 1 / 1
                </span>
            </div>

            <!-- Right Controls (Autoplay Toggle & Close) -->
            <div class="flex items-center gap-2 pointer-events-auto">
                <button id="lightbox-autoplay-btn" type="button" aria-label="Jeda Slide Otomatis" title="Jeda / Lanjut Putar Otomatis" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-slate-900/90 hover:bg-slate-800 border border-white/20 text-xs font-medium text-white/90 cursor-pointer transition shadow-lg">
                    <i data-lucide="pause" class="w-3.5 h-3.5 text-emerald-400" id="lightbox-play-icon"></i>
                    <span id="lightbox-autoplay-label">Auto-Slide Aktif</span>
                </button>
                <button id="lightbox-close" aria-label="Tutup Galeri" class="text-white/80 hover:text-white p-2.5 rounded-full bg-slate-900/90 hover:bg-slate-800 border border-white/20 transition cursor-pointer shadow-lg">
                    <i data-lucide="x" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                </button>
            </div>
        </div>

        <!-- Slider Navigation Arrows -->
        <button id="lightbox-prev" aria-label="Foto Sebelumnya" class="absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-slate-900/80 hover:bg-slate-900 border border-white/20 text-white flex items-center justify-center transition-all duration-200 shadow-2xl hover:scale-105 cursor-pointer">
            <i data-lucide="chevron-left" class="w-6 h-6 sm:w-7 sm:h-7"></i>
        </button>
        <button id="lightbox-next" aria-label="Foto Selanjutnya" class="absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-slate-900/80 hover:bg-slate-900 border border-white/20 text-white flex items-center justify-center transition-all duration-200 shadow-2xl hover:scale-105 cursor-pointer">
            <i data-lucide="chevron-right" class="w-6 h-6 sm:w-7 sm:h-7"></i>
        </button>

        <!-- Main Slider Viewport -->
        <div class="relative w-full max-w-5xl h-[64vh] sm:h-[70vh] flex flex-col items-center justify-center pt-8 sm:pt-4">
            <div class="relative w-full h-full flex items-center justify-center overflow-hidden rounded-2xl sm:rounded-3xl shadow-2xl border border-white/10 bg-slate-900/60">
                <img id="lightbox-image" src="" alt="Galeri Preview" class="max-w-full max-h-full object-contain transition-opacity duration-300">
            </div>
            <p id="lightbox-caption" class="text-slate-300 text-xs sm:text-sm mt-3 font-medium text-center px-4 max-w-2xl line-clamp-2"></p>
        </div>

        <!-- Bottom Actions & Dot Thumbnails -->
        <div class="absolute bottom-4 sm:bottom-6 left-1/2 -translate-x-1/2 z-30 flex flex-col sm:flex-row items-center gap-3 w-full max-w-xl px-4 justify-center">
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

</body>
</html>
