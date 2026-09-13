<!DOCTYPE html>
<html lang="id" class="scroll-smooth scroll-pt-24 sm:scroll-pt-28">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Tentang Kami — Profil Resmi Biro Wisata Puja Tour Pangandaran</title>
    <meta name="description" content="Profil resmi Puja Tour & Travel Pangandaran. Biro wisata berbadan hukum CV, pemandu lokal berlisensi resmi HPI, standar keselamatan K3 SNI, dan terpercaya melayani 15.000+ wisatawan.">
    <meta name="keywords" content="profil Puja Tour Travel, tentang Puja Tour Pangandaran, biro wisata resmi Pangandaran, tour guide bersertifikat HPI, CV travel Pangandaran, body rafting Green Canyon">

    <link rel="canonical" href="{{ url('/tentang-kami') }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour & Travel Pangandaran">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/tentang-kami') }}">
    <meta property="og:title" content="Tentang Kami — Profil Resmi Biro Wisata Puja Tour Pangandaran">
    <meta property="og:description" content="Profil resmi Puja Tour & Travel Pangandaran. Biro wisata berbadan hukum CV, pemandu lokal berlisensi resmi HPI, standar keselamatan K3 SNI, dan terpercaya melayani 15.000+ wisatawan.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Tentang Kami — Profil Resmi Biro Wisata Puja Tour Pangandaran">
    <meta name="twitter:description" content="Biro wisata resmi berbadan hukum CV di Pangandaran. Pemandu berlisensi HPI, standar keselamatan teruji, dan pengalaman 15.000+ wisatawan puas.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): TravelAgency -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => 'Puja Tour & Travel Pangandaran',
        'alternateName' => 'Puja Tour Travel',
        'description' => 'Biro perjalanan wisata resmi berbadan hukum CV di Pangandaran yang menyediakan paket body rafting Green Canyon, wisata bahari Pasir Putih, dan gathering perusahaan.',
        'url' => url('/'),
        'logo' => asset('images/puja_logo.png'),
        'image' => asset('images/hero_pangandaran.jpg'),
        'telephone' => $settings['phone_number'] ?? '+62 812-3456-7890',
        'email' => $settings['email_address'] ?? 'info@pujatourtravel.com',
        'priceRange' => 'Rp 100.000 - Rp 1.500.000',
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
        'sameAs' => [
            $settings['instagram_url'] ?? 'https://www.instagram.com/puja_tourtravel/',
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
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
        $companyName = $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN';
        $igUrl = $settings['instagram_url'] ?? 'https://www.instagram.com/puja_tourtravel/';
        $tiktokUrl = $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel';
    @endphp

    <!-- GLOBAL NAVBAR -->
    @include('partials.navbar')

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

    <!-- 1. CINEMATIC HERO SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-2 pb-12">
        <div class="relative rounded-3xl overflow-hidden bg-slate-950 text-white shadow-xl border border-slate-800/80">
            <!-- Background Image with Modern Cinematic Gradient Mask -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/hero_pangandaran.jpg') }}" alt="Pangandaran Tourism" class="w-full h-full object-cover object-center opacity-30">
                <div class="absolute inset-0 bg-linear-to-t from-slate-950 via-slate-950/70 to-slate-950/30"></div>
            </div>

            <!-- Content Grid: Left Text & Right Floating Trust Card -->
            <div class="relative z-10 p-7 sm:p-12 lg:p-16 grid lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <!-- Trust Pill Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/10 backdrop-blur-md border border-white/20 text-emerald-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Biro Perjalanan Wisata Resmi Pangandaran • Berizin CV</span>
                    </div>

                    <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-white tracking-tight leading-[1.15]">
                        Mengenal Jati Diri & Semangat Pelayanan <span class="text-emerald-400">Puja Tour</span>
                    </h1>

                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl font-normal">
                        Lahir dari inisiatif putra daerah asli Pangandaran. Kami mendedikasikan diri untuk menghadirkan pengalaman liburan bahari dan petualangan sungai yang berkesan, transparan tanpa biaya tersembunyi, serta berstandar keselamatan K3 internasional.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap items-center gap-3.5 pt-2">
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" 
                           target="_blank" 
                           class="px-6 py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Konsultasi Liburan Gratis</span>
                        </a>
                        <a href="{{ route('packages.index') }}" 
                           class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 backdrop-blur-md transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                            <span>Jelajahi Paket Wisata</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Feature Badge Card (Glassmorphic) -->
                <div class="lg:col-span-5">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 sm:p-7 text-white space-y-4 shadow-2xl">
                        <div class="flex items-center gap-3 pb-3 border-b border-white/15">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400 shrink-0">
                                <i data-lucide="shield-check" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <span class="text-xs text-emerald-300 font-bold uppercase tracking-wider block">Standar Komitmen Kami</span>
                                <h3 class="font-display font-bold text-base text-white">Keamanan & Keaslian Budaya</h3>
                            </div>
                        </div>
                        <ul class="space-y-2.5 text-xs text-slate-200 leading-relaxed">
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                <span>Pemandu sungai & laut resmi bersertifikat HPI Jawa Barat.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                <span>Peralatan K3 berstandar SNI & proteksi asuransi jiwa pariwisata.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                <span>Kantor operasional resmi berlokasi strategis di Pantai Barat.</span>
                            </li>
                        </ul>
                        <div class="pt-3 border-t border-white/15 flex items-center justify-between text-xs">
                            <span class="text-slate-300 font-medium">Rating Tamu Google & Trip</span>
                            <div class="flex items-center gap-1 text-amber-300 font-bold">
                                <span>★ 4.9 / 5.0</span>
                                <span class="text-[11px] text-slate-300 font-normal">(1.200+ Ulasan)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. KEY STATS SECTION (Unified Floating Metric Dock) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-soft border border-neutral-200/90 grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 lg:gap-0 lg:divide-x divide-neutral-200/80">
            <!-- Stat 1 -->
            <div class="flex items-start gap-4 lg:px-6 first:pl-0 group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-700 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-emerald-700 group-hover:text-white transition-all">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight block leading-none">10+</span>
                    <span class="text-xs sm:text-sm font-bold text-slate-800 mt-2 block">Tahun Pengalaman</span>
                    <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">Mengarungi alam & sungai Pangandaran sejak 2014</p>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="flex items-start gap-4 lg:px-6 group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-700 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-emerald-700 group-hover:text-white transition-all">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight block leading-none">15.000+</span>
                    <span class="text-xs sm:text-sm font-bold text-slate-800 mt-2 block">Wisatawan Puas</span>
                    <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">Keluarga, rombongan sekolah, dan korporat</p>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="flex items-start gap-4 lg:px-6 group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-700 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-emerald-700 group-hover:text-white transition-all">
                    <i data-lucide="award" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight block leading-none">100%</span>
                    <span class="text-xs sm:text-sm font-bold text-slate-800 mt-2 block">Lisensi Resmi HPI</span>
                    <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">Pemandu lokal bersertifikat rescue nasional</p>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="flex items-start gap-4 lg:px-6 last:pr-0 group">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200/80 text-amber-600 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-amber-600 group-hover:text-white transition-all">
                    <i data-lucide="star" class="w-5 h-5 fill-amber-400 text-amber-500 group-hover:text-white group-hover:fill-white transition-colors"></i>
                </div>
                <div>
                    <span class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight block leading-none">4.9<span class="text-base text-slate-400 font-bold"> / 5.0</span></span>
                    <span class="text-xs sm:text-sm font-bold text-slate-800 mt-2 block">Tingkat Kepuasan</span>
                    <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">1.200+ ulasan nyata Google Maps & testimoni</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. STORYTELLING & MILESTONE TIMELINE -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Row 1: Company Story (Left) & Visual Bento Gallery (Right) - Symmetrical Heights -->
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            <!-- Left: Company Narrative & Story -->
            <div class="lg:col-span-6 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-2">
                        Kisah & Perjalanan Kami
                    </span>
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
                        Dari Kecintaan pada Alam Pangandaran, Menjadi Standar Layanan Profesional
                    </h2>
                </div>

                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Puja Tour & Travel berawal dari komunitas pemandu arung jeram Green Canyon dan peselancar pantai Batu Karas. Kami menyaksikan betapa megahnya keindahan ngarai hijau Cukang Taneuh, hamparan pasir putih, dan deburan ombak pesisir selatan Jawa Barat.
                </p>

                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Namun di masa lalu, wisatawan sering menghadapi kebingungan: harga yang tidak seragam, kelayakan alat keselamatan yang dipertanyakan, hingga minimnya transparansi fasilitas. Dari sanalah lahir tekad untuk mendirikan <strong>{{ $companyName }}</strong> — sebuah biro wisata resmi yang mengintegrasikan keramahan khas Sunda dengan standar keamanan pariwisata modern.
                </p>

                <!-- Core Values Highlight Grid -->
                <div class="grid grid-cols-1 xs:grid-cols-3 gap-2.5 sm:gap-3 pt-2">
                    <div class="p-4 rounded-2xl bg-surface-soft border border-neutral-200/90 shadow-2xs text-center group hover:border-emerald-300 transition-all">
                        <span class="font-display font-black text-xl text-emerald-700 block">100%</span>
                        <span class="text-xs font-bold text-slate-800 block mt-0.5">Warga Lokal</span>
                        <span class="text-[10px] text-slate-500 block mt-0.5">Navigasi arus ahli</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-surface-soft border border-neutral-200/90 shadow-2xs text-center group hover:border-emerald-300 transition-all">
                        <span class="font-display font-black text-xl text-emerald-700 block">Resmi CV</span>
                        <span class="text-xs font-bold text-slate-800 block mt-0.5">Berbadan Hukum</span>
                        <span class="text-[10px] text-slate-500 block mt-0.5">NIB & Kemenkumham</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-surface-soft border border-neutral-200/90 shadow-2xs text-center group hover:border-emerald-300 transition-all">
                        <span class="font-display font-black text-xl text-emerald-700 block">K3 SNI</span>
                        <span class="text-xs font-bold text-slate-800 block mt-0.5">Standar Safety</span>
                        <span class="text-[10px] text-slate-500 block mt-0.5">Asuransi pariwisata</span>
                    </div>
                </div>
            </div>

            <!-- Right: Visual Bento Gallery (2x2 Balanced Photo Grid) -->
            <div class="lg:col-span-6 grid grid-cols-1 xs:grid-cols-2 gap-4 items-center">
                <div class="space-y-4">
                    <div class="relative group rounded-3xl overflow-hidden shadow-soft border border-neutral-200">
                        <img src="{{ asset('images/greencanyon.jpg') }}" alt="Body Rafting Green Canyon" class="w-full h-56 sm:h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/85 via-slate-950/20 to-transparent flex flex-col justify-end p-4 text-white">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-400">Arung Jeram & Rafting</span>
                            <h4 class="font-display font-bold text-sm text-white">Green Canyon Sanctuary</h4>
                        </div>
                    </div>

                    <div class="relative group rounded-3xl overflow-hidden shadow-soft border border-neutral-200">
                        <img src="{{ asset('images/cagar_alam.jpg') }}" alt="Cagar Alam Pananjung" class="w-full h-44 sm:h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/85 via-slate-950/20 to-transparent flex flex-col justify-end p-4 text-white">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-400">Wisata Konservasi Hutan</span>
                            <h4 class="font-display font-bold text-sm text-white">Cagar Alam Pananjung</h4>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-4 sm:pt-6">
                    <div class="relative group rounded-3xl overflow-hidden shadow-soft border border-neutral-200">
                        <img src="{{ asset('images/pasir_putih.jpg') }}" alt="Snorkeling Pasir Putih" class="w-full h-44 sm:h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/85 via-slate-950/20 to-transparent flex flex-col justify-end p-4 text-white">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-400">Wisata Bahari & Karang</span>
                            <h4 class="font-display font-bold text-sm text-white">Pasir Putih & Kapal Karam</h4>
                        </div>
                    </div>

                    <div class="relative group rounded-3xl overflow-hidden shadow-soft border border-neutral-200">
                        <img src="{{ asset('images/sunset_batu_karas.jpg') }}" alt="Sunset Pantai Batu Karas" class="w-full h-56 sm:h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/85 via-slate-950/20 to-transparent flex flex-col justify-end p-4 text-white">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-400">Pantai Selancar & Senja</span>
                            <h4 class="font-display font-bold text-sm text-white">Sunset Batu Karas</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2: Milestone Timeline (Visual Interactive Roadmap Journey) -->
        <div class="mt-16 pt-12 border-t border-neutral-200/80">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-2">
                        <i data-lucide="milestone" class="w-3.5 h-3.5"></i>
                        <span>Jejak Langkah 1 Dekade</span>
                    </div>
                    <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">
                        Tonggak Pencapaian (Milestones)
                    </h3>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 max-w-md leading-relaxed">
                    Perjalanan satu dekade membangun standar pariwisata Pangandaran yang aman, berizin resmi, dan berakar pada kearifan lokal.
                </p>
            </div>

            <!-- Horizontal Journey Track with Connected Progress Line -->
            <div class="relative">
                <!-- Visual Connection Line on Desktop -->
                <div class="hidden lg:block absolute top-11 left-12 right-12 h-1 bg-linear-to-r from-emerald-600 via-emerald-500 to-teal-400 z-0 rounded-full"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 relative z-10">
                    <!-- Milestone 1: 2014 -->
                    <div class="relative bg-white rounded-3xl p-6 sm:p-7 border border-neutral-200 shadow-soft hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group overflow-hidden">
                        <div class="relative z-10">
                            <!-- Node Indicator -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-10 h-10 rounded-full bg-emerald-700 text-white font-display font-black text-xs flex items-center justify-center shadow-sm ring-4 ring-white">
                                    01
                                </div>
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold uppercase font-mono tracking-wider">
                                    Tahun 2014
                                </span>
                            </div>

                            <h4 class="font-display font-bold text-slate-900 text-base sm:text-lg mb-2 group-hover:text-emerald-700 transition">
                                Komunitas River Guide
                            </h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Memulai rintisan pemanduan body rafting Green Canyon dan Citumang dengan mengedepankan kearifan navigasi arus lokal.
                            </p>
                        </div>

                        <div class="relative z-10 pt-4 mt-5 border-t border-neutral-100 text-[11px] font-bold text-emerald-700 flex items-center gap-1.5">
                            <i data-lucide="waves" class="w-3.5 h-3.5"></i>
                            <span>Pionir Arung Jeram</span>
                        </div>
                    </div>

                    <!-- Milestone 2: 2018 -->
                    <div class="relative bg-white rounded-3xl p-6 sm:p-7 border border-neutral-200 shadow-soft hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group overflow-hidden">
                        <div class="relative z-10">
                            <!-- Node Indicator -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-10 h-10 rounded-full bg-emerald-700 text-white font-display font-black text-xs flex items-center justify-center shadow-sm ring-4 ring-white">
                                    02
                                </div>
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold uppercase font-mono tracking-wider">
                                    Tahun 2018
                                </span>
                            </div>

                            <h4 class="font-display font-bold text-slate-900 text-base sm:text-lg mb-2 group-hover:text-emerald-700 transition">
                                Badan Hukum Resmi CV
                            </h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Meresmikan badan usaha CV, membuka kantor transit Pantai Barat, menjalin kemitraan asuransi resmi, dan sertifikasi HPI DPC Jawa Barat.
                            </p>
                        </div>

                        <div class="relative z-10 pt-4 mt-5 border-t border-neutral-100 text-[11px] font-bold text-emerald-700 flex items-center gap-1.5">
                            <i data-lucide="file-check-2" class="w-3.5 h-3.5"></i>
                            <span>Legalitas Kemenkumham</span>
                        </div>
                    </div>

                    <!-- Milestone 3: 2022 -->
                    <div class="relative bg-white rounded-3xl p-6 sm:p-7 border border-neutral-200 shadow-soft hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group overflow-hidden">
                        <div class="relative z-10">
                            <!-- Node Indicator -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-10 h-10 rounded-full bg-emerald-700 text-white font-display font-black text-xs flex items-center justify-center shadow-sm ring-4 ring-white">
                                    03
                                </div>
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold uppercase font-mono tracking-wider">
                                    Tahun 2022
                                </span>
                            </div>

                            <h4 class="font-display font-bold text-slate-900 text-base sm:text-lg mb-2 group-hover:text-emerald-700 transition">
                                Corporate Gathering
                            </h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Melayani reservasi rombongan korporat dan instansi kedinasan secara all-in lengkap dengan hotel rekanan, prasmanan seafood, dan bus wisata.
                            </p>
                        </div>

                        <div class="relative z-10 pt-4 mt-5 border-t border-neutral-100 text-[11px] font-bold text-emerald-700 flex items-center gap-1.5">
                            <i data-lucide="building" class="w-3.5 h-3.5"></i>
                            <span>All-Inclusive Event</span>
                        </div>
                    </div>

                    <!-- Milestone 4: Kini (FEATURED HIGHLIGHT CARD) -->
                    <div class="relative bg-linear-to-b from-emerald-50/80 via-white to-white rounded-3xl p-6 sm:p-7 border-2 border-emerald-500 shadow-md hover:shadow-lg transition-all duration-300 flex flex-col justify-between group overflow-hidden">
                        <!-- Big Watermark Year -->
                        <span class="font-display font-black text-6xl text-emerald-100 select-none absolute top-2 right-3 pointer-events-none">
                            NOW
                        </span>

                        <div class="relative z-10">
                            <!-- Node Indicator -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-10 h-10 rounded-full bg-emerald-700 text-white font-display font-black text-xs flex items-center justify-center shadow-sm ring-4 ring-emerald-200">
                                    04
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-wider shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>
                                    <span>Aktif Saat Ini</span>
                                </span>
                            </div>

                            <h4 class="font-display font-bold text-slate-900 text-base sm:text-lg mb-2 group-hover:text-emerald-700 transition">
                                Ekowisata Berkelanjutan
                            </h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Mempelopori wisata ramah lingkungan bebas sampah plastik di kawasan sungai serta mengedukasi pelestarian penyu di pesisir Pangandaran.
                            </p>
                        </div>

                        <div class="relative z-10 pt-4 mt-5 border-t border-emerald-200/80 text-[11px] font-bold text-emerald-800 flex items-center gap-1.5">
                            <i data-lucide="leaf" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Zero Waste & Konservasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. EMPAT PILAR KEUNGGULAN (Clean Unified Emerald Theme - Sesuai Tema Beranda) -->
    <section class="py-16 bg-[#f4f6f1] border-y border-neutral-200/90 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-2">
                    Standar Kualitas Layanan
                </span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight">
                    Mengapa Wisatawan Memilih Puja Tour?
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2 leading-relaxed">
                    Kombinasi integritas layanan, standar keselamatan teruji, dan keramahan asli masyarakat pesisir Pangandaran.
                </p>
            </div>

            <!-- Asymmetrical 3-Column Bento Grid (Maks 3 Warna: Putih, Emerald, Slate) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
                <!-- Bento Tile 1 (Pilar Utama - Spans 2 cols): Pemandu HPI -->
                <div class="lg:col-span-2 bg-white rounded-3xl p-7 sm:p-9 border border-neutral-200 shadow-soft hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                                <i data-lucide="award" class="w-3.5 h-3.5 text-emerald-600"></i>
                                <span>Pilar Keunggulan Utama</span>
                            </div>
                            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center group-hover:bg-emerald-700 group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-2xs">
                                <i data-lucide="compass" class="w-6 h-6"></i>
                            </div>
                        </div>

                        <h3 class="font-display font-extrabold text-xl sm:text-2xl text-slate-900 group-hover:text-emerald-700 transition tracking-tight mb-3">
                            Pemandu Lokal Berlisensi Resmi HPI Jawa Barat
                        </h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-xl">
                            Bukan sekadar pemandu jalan. Seluruh tim river guide dan pemandu bahari kami adalah warga asli Pangandaran yang bersertifikasi resmi HPI (Himpunan Pramuwisata Indonesia). Menguasai navigasi arus Green Canyon, terlatih teknik penyelamatan air (water rescue), dan melayani dengan senyum keramahan Sunda.
                        </p>
                    </div>

                    <div class="pt-6 mt-6 border-t border-neutral-100 flex flex-wrap items-center gap-3 text-xs">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 font-semibold text-[11px]">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600"></i>
                            Sertifikat Resmi HPI DPC Jabar
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 font-semibold text-[11px]">
                            <i data-lucide="waves" class="w-3.5 h-3.5 text-emerald-600"></i>
                            Water Rescue Standard SNI
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 font-semibold text-[11px]">
                            <i data-lucide="smile" class="w-3.5 h-3.5 text-emerald-600"></i>
                            Ramah & Informatif
                        </span>
                    </div>
                </div>

                <!-- Bento Tile 2 (Standar K3 - Spans 1 col): Peralatan K3 -->
                <div class="lg:col-span-1 bg-white rounded-3xl p-7 border border-neutral-200 shadow-soft hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center group-hover:bg-emerald-700 group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-2xs">
                                <i data-lucide="life-buoy" class="w-6 h-6"></i>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider bg-emerald-50 border border-emerald-200/80 px-2.5 py-1 rounded-full">
                                Standar K3
                            </span>
                        </div>

                        <h3 class="font-display font-bold text-slate-900 text-base sm:text-lg mb-2 group-hover:text-emerald-700 transition">
                            Peralatan K3 & Asuransi Resmi
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Peralatan standar SNI/CE terawat: life jacket berdaya apung tinggi, helm sungai, dan dry bag, dilengkapi proteksi asuransi jiwa pariwisata resmi.
                        </p>

                        <!-- Checklist -->
                        <ul class="space-y-2 text-xs text-slate-700">
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                                <span>Life Jacket SNI Berdaya Apung</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                                <span>Helm Arung Jeram & Dry Bag</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                                <span>Polis Asuransi Jiwa Pariwisata Sah</span>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-4 mt-6 border-t border-neutral-100 text-[11px] font-bold text-emerald-700 flex items-center gap-1.5">
                        <i data-lucide="shield" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <span>Zero Compromise Safety</span>
                    </div>
                </div>

                <!-- Bento Tile 3 (Transparansi Biaya - Spans 1 col): Harga Jujur -->
                <div class="lg:col-span-1 bg-white rounded-3xl p-7 border border-neutral-200 shadow-soft hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center group-hover:bg-emerald-700 group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-2xs">
                                <i data-lucide="receipt-text" class="w-6 h-6"></i>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider bg-emerald-50 border border-emerald-200/80 px-2.5 py-1 rounded-full">
                                Transparansi Tarif
                            </span>
                        </div>

                        <h3 class="font-display font-bold text-slate-900 text-base sm:text-lg mb-2 group-hover:text-emerald-700 transition">
                            Harga Jujur Tanpa Biaya Siluman
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Seluruh rincian tiket retribusi, sewa perahu nelayan, pemandu HPI, hingga konsumsi sudah tercakup tanpa ada pungli tersembunyi di lokasi trip.
                        </p>

                        <div class="p-3.5 rounded-2xl bg-emerald-50/80 border border-emerald-200/70 text-emerald-900 text-xs">
                            <span class="font-bold block mb-1">Jaminan All-Inclusive:</span>
                            <p class="text-[11px] text-emerald-800 leading-relaxed">Apa yang tertulis di invoice resmi adalah jumlah final yang Anda bayarkan.</p>
                        </div>
                    </div>

                    <div class="pt-4 mt-6 border-t border-neutral-100 text-[11px] font-bold text-emerald-700 flex items-center gap-1.5">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <span>Bebas Pungli & Biaya Tersembunyi</span>
                    </div>
                </div>

                <!-- Bento Tile 4 (Kelestarian & Warga - Spans 2 cols): Ekowisata -->
                <div class="lg:col-span-2 bg-white rounded-3xl p-7 sm:p-9 border border-neutral-200 shadow-soft hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                                <i data-lucide="leaf" class="w-3.5 h-3.5 text-emerald-600"></i>
                                <span>Ekowisata Berkelanjutan</span>
                            </div>
                            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center group-hover:bg-emerald-700 group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-2xs">
                                <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                            </div>
                        </div>

                        <h3 class="font-display font-extrabold text-xl sm:text-2xl text-slate-900 group-hover:text-emerald-700 transition tracking-tight mb-2">
                            Kelestarian Alam & Pemberdayaan Warga Lokal
                        </h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-xl">
                            Kami menerapkan aturan zero-littering dan larangan perusakan ekosistem stalaktit di sungai Green Canyon. Setiap perjalanan bersama Puja Tour secara langsung memberdayakan nelayan tradisional perahu, warung kuliner rumahan, dan konservasi penyu Pangandaran.
                        </p>
                    </div>

                    <div class="pt-6 mt-6 border-t border-neutral-100 flex flex-wrap items-center gap-3 text-xs">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 font-semibold text-[11px]">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-600"></i>
                            Zero Plastic River Trail
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 font-semibold text-[11px]">
                            <i data-lucide="users-round" class="w-3.5 h-3.5 text-emerald-600"></i>
                            Mitra Nelayan & Kuliner Tradisional
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 font-semibold text-[11px]">
                            <i data-lucide="heart" class="w-3.5 h-3.5 text-emerald-600"></i>
                            Pemberdayaan Warga Pesisir
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. LEGALITAS, SERTIFIKASI & TRANSPARANSI USAHA (Official Credential Vault) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-3xl p-7 sm:p-10 lg:p-12 shadow-soft border border-neutral-200/90 relative overflow-hidden">
            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between pb-8 border-b border-neutral-200 gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-800 text-xs font-bold uppercase tracking-wider mb-2">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-700"></i>
                        <span>Pusat Transparansi Hukum & Audit</span>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight">
                        Legalitas Resmi & Keabsahan Perusahaan
                    </h2>
                    <p class="text-slate-600 text-xs sm:text-sm mt-1.5 max-w-xl leading-relaxed">
                        Kami menjamin keamanan mutlak setiap transaksi finansial, kepastian hukum SPK dinas, dan kredibilitas perseroan resmi.
                    </p>
                </div>

                <div class="shrink-0">
                    <div class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-900 text-xs font-extrabold shadow-2xs">
                        <i data-lucide="badge-check" class="w-5 h-5 text-emerald-700"></i>
                        <span>Badan Hukum Sah Terdaftar Pemerintah</span>
                    </div>
                </div>
            </div>

            <!-- 4 Official Verifiable Credential Badges -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 pt-8">
                <!-- Credential 1: Badan Usaha CV -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-50/80 border border-neutral-200/90 flex flex-col justify-between hover:bg-white hover:border-emerald-300 hover:shadow-card-hover transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-white border border-neutral-200 text-emerald-700 flex items-center justify-center shadow-2xs group-hover:bg-emerald-700 group-hover:text-white transition-all">
                                <i data-lucide="file-badge" class="w-5 h-5"></i>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100/80 px-2.5 py-0.5 rounded-full uppercase">Kemenkumham</span>
                        </div>
                        <h4 class="font-display font-bold text-sm sm:text-base text-slate-900 mb-1.5">Badan Usaha Resmi CV</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Terdaftar sah di Kementerian Hukum dan HAM Republik Indonesia dengan akta pendirian notaris resmi.
                        </p>
                    </div>
                    <div class="pt-3.5 mt-4 border-t border-neutral-200/60 flex items-center justify-between text-[11px] font-medium text-slate-500">
                        <span>Status Perizinan:</span>
                        <span class="font-bold text-emerald-700 flex items-center gap-1">
                            <i data-lucide="check" class="w-3 h-3"></i> Terverifikasi
                        </span>
                    </div>
                </div>

                <!-- Credential 2: NIB & Izin Pariwisata -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-50/80 border border-neutral-200/90 flex flex-col justify-between hover:bg-white hover:border-emerald-300 hover:shadow-card-hover transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-white border border-neutral-200 text-emerald-700 flex items-center justify-center shadow-2xs group-hover:bg-emerald-700 group-hover:text-white transition-all">
                                <i data-lucide="badge-percent" class="w-5 h-5"></i>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100/80 px-2.5 py-0.5 rounded-full uppercase">KBLI 79120</span>
                        </div>
                        <h4 class="font-display font-bold text-sm sm:text-base text-slate-900 mb-1.5">NIB & Izin Pariwisata</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Memiliki Nomor Induk Berusaha (NIB) dengan Klasifikasi Baku Lapangan Usaha Biro Perjalanan Wisata.
                        </p>
                    </div>
                    <div class="pt-3.5 mt-4 border-t border-neutral-200/60 flex items-center justify-between text-[11px] font-medium text-slate-500">
                        <span>Sistem OSS:</span>
                        <span class="font-bold text-emerald-700 flex items-center gap-1">
                            <i data-lucide="check" class="w-3 h-3"></i> Sah Beroperasi
                        </span>
                    </div>
                </div>

                <!-- Credential 3: Sertifikasi HPI Jabar -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-50/80 border border-neutral-200/90 flex flex-col justify-between hover:bg-white hover:border-emerald-300 hover:shadow-card-hover transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-white border border-neutral-200 text-emerald-700 flex items-center justify-center shadow-2xs group-hover:bg-emerald-700 group-hover:text-white transition-all">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100/80 px-2.5 py-0.5 rounded-full uppercase">HPI DPC</span>
                        </div>
                        <h4 class="font-display font-bold text-sm sm:text-base text-slate-900 mb-1.5">Sertifikasi HPI Jabar</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Seluruh pemandu bernaung resmi di bawah Himpunan Pramuwisata Indonesia DPC Pangandaran / Jawa Barat.
                        </p>
                    </div>
                    <div class="pt-3.5 mt-4 border-t border-neutral-200/60 flex items-center justify-between text-[11px] font-medium text-slate-500">
                        <span>Pemandu Resmi:</span>
                        <span class="font-bold text-emerald-700 flex items-center gap-1">
                            <i data-lucide="check" class="w-3 h-3"></i> Bersertifikat
                        </span>
                    </div>
                </div>

                <!-- Credential 4: Rekening Bank Resmi -->
                <div class="p-5 sm:p-6 rounded-2xl bg-slate-50/80 border border-neutral-200/90 flex flex-col justify-between hover:bg-white hover:border-emerald-300 hover:shadow-card-hover transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-white border border-neutral-200 text-emerald-700 flex items-center justify-center shadow-2xs group-hover:bg-emerald-700 group-hover:text-white transition-all">
                                <i data-lucide="landmark" class="w-5 h-5"></i>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100/80 px-2.5 py-0.5 rounded-full uppercase">Anti Fraud</span>
                        </div>
                        <h4 class="font-display font-bold text-sm sm:text-base text-slate-900 mb-1.5">Rekening Bank Resmi CV</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Transaksi transfer pembayaran hanya sah melalui rekening perusahaan atas nama CV resmi, bebas risiko rekening pribadi.
                        </p>
                    </div>
                    <div class="pt-3.5 mt-4 border-t border-neutral-200/60 flex items-center justify-between text-[11px] font-medium text-slate-500">
                        <span>Keamanan Dana:</span>
                        <span class="font-bold text-emerald-700 flex items-center gap-1">
                            <i data-lucide="check" class="w-3 h-3"></i> Rekening Sah
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. TESTIMONI WISATAWAN ASLI (Auto-Scrolling Marquee & Interactive Slider) -->
    @if($testimonials->count() > 0)
        <section class="py-16 lg:py-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-2">
                            Ulasan & Pengalaman Nyata
                        </span>
                        <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight">
                            Apa Kata Wisatawan Tentang Puja Tour?
                        </h2>
                        <p class="text-slate-600 text-xs sm:text-sm mt-1.5 leading-relaxed max-w-xl">
                            Kejujuran ulasan dari para tamu yang telah mempercayakan momen liburan mereka di Pangandaran bersama tim kami.
                        </p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ route('testimonial') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-surface-soft hover:bg-neutral-100 text-slate-700 font-semibold text-xs sm:text-sm border border-neutral-200 transition shadow-2xs">
                            <span>Lihat Semua Ulasan ({{ $testimonials->count() }})</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Marquee Showcase Container with Edge Fade Masks -->
            <div class="relative w-full overflow-hidden select-none py-2 testimonial-marquee-wrapper" id="about-testi-wrapper">
                <!-- Left & Right Gradient Fade Masks -->
                <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-8 sm:w-24 bg-linear-to-r from-[#f4f6f1] to-transparent z-10"></div>
                <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-8 sm:w-24 bg-linear-to-l from-[#f4f6f1] to-transparent z-10"></div>

                <!-- SVG Gold Star Gradient Definition -->
                <svg class="sr-only" aria-hidden="true" width="0" height="0">
                    <defs>
                        <linearGradient id="goldStarGradAbout" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#FDE047" />
                            <stop offset="45%" stop-color="#F59E0B" />
                            <stop offset="100%" stop-color="#D97706" />
                        </linearGradient>
                    </defs>
                </svg>

                <!-- The Marquee Track (Smooth Walking Animation, Pauses on Hover) -->
                <div id="about-testi-track" class="testimonial-marquee-track flex gap-6 px-4">
                    @php
                        // Memastikan setidaknya 6-8 kartu untuk infinite loop halus tanpa jeda visual
                        $loopCount = $testimonials->count() < 4 ? 4 : 2;
                    @endphp
                    @for($repeat = 0; $repeat < $loopCount; $repeat++)
                        @foreach($testimonials as $tIndex => $t)
                            <div class="testimonial-card w-77.5 sm:w-95 shrink-0 bg-white rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200 flex flex-col justify-between hover:shadow-card-hover hover:border-emerald-300 transition-all duration-300">
                                <div>
                                    <!-- Header: Bintang Emas di Tengah & Badge Terverifikasi -->
                                    <div class="flex flex-col items-center justify-center text-center mb-4">
                                        <div class="flex items-center justify-center gap-1.5 mb-2">
                                            @php $r = (int)($t->rating ?? 5); @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $r)
                                                    <svg class="w-5 h-5 drop-shadow-[0_2px_4px_rgba(245,158,11,0.35)] transition-transform duration-200 hover:scale-115" viewBox="0 0 24 24" fill="url(#goldStarGradAbout)" stroke="#d97706" stroke-width="0.5">
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
                                            <span>Wisatawan Terverifikasi</span>
                                        </span>
                                    </div>

                                    <p class="text-xs sm:text-sm text-slate-700 leading-relaxed italic text-center line-clamp-4">
                                        "{{ $t->review_text }}"
                                    </p>
                                </div>

                                <div class="pt-5 mt-5 border-t border-neutral-100 flex items-center gap-3.5">
                                    <div class="w-11 h-11 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-sm shrink-0 shadow-inner font-display">
                                        {{ substr($t->customer_name, 0, 2) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold font-display text-sm text-slate-900 truncate">{{ $t->customer_name }}</h4>
                                        <span class="text-xs text-slate-400 block truncate">{{ $t->customer_city ?? 'Wisatawan' }} • {{ $t->package_name ?? 'Paket Pangandaran' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>

            <!-- Mobile Only: Navigasi Lanjut Ulasan Slider (Hanya Tampil di Layar Ponsel) -->
            <div class="sm:hidden flex flex-col items-center gap-3.5 mt-6 px-4">
                <!-- Indikator Titik Aktif (Active Slide Tracker) -->
                @if($testimonials->count() > 1)
                    <div id="about-testi-dots-mobile" class="flex items-center gap-1.5 py-1">
                        @foreach($testimonials as $idx => $t)
                            <button type="button" class="about-testi-dot h-2 rounded-full transition-all duration-300 {{ $idx === 0 ? 'w-6 bg-emerald-700' : 'w-2 bg-neutral-300' }}" data-index="{{ $idx }}" aria-label="Lihat ulasan {{ $idx + 1 }}"></button>
                        @endforeach
                    </div>
                @endif

                <!-- Tombol Navigasi: Sebelumnya & Lanjut ke Ulasan Berikutnya -->
                <div class="flex items-center gap-2.5 w-full max-w-sm justify-center">
                    <!-- Tombol Sebelumnya -->
                    <button type="button" id="btn-prev-testi-about" aria-label="Ulasan Sebelumnya" class="w-11 h-11 rounded-2xl bg-white hover:bg-neutral-100 active:scale-95 border border-neutral-200 text-slate-700 flex items-center justify-center shadow-xs transition cursor-pointer shrink-0">
                        <i data-lucide="chevron-left" class="w-5 h-5 text-slate-600"></i>
                    </button>

                    <!-- Tombol Utama: Lanjut ke Ulasan Berikutnya -->
                    <button type="button" id="btn-next-testi-about" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-emerald-700 hover:bg-emerald-800 active:scale-[0.98] text-white font-bold text-xs sm:text-sm shadow-md shadow-emerald-700/20 transition cursor-pointer">
                        <span>Lanjut ke Ulasan Berikutnya</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 text-emerald-200"></i>
                    </button>
                </div>

                <!-- Petunjuk Ramah & Enak Dibaca -->
                <p class="text-[11px] text-slate-500 font-medium flex items-center gap-1.5">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-600 shrink-0"></i>
                    <span>Ketuk tombol atau usap layar untuk membaca ulasan lainnya</span>
                </p>
            </div>
        </section>
    @endif

    <!-- 7. GRAND CTA SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-20">
        <div class="rounded-3xl bg-slate-950 text-white p-8 sm:p-12 lg:p-16 relative overflow-hidden shadow-xl border border-slate-800 text-center">
            <!-- Decorative Glow Background -->
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-2xl mx-auto space-y-5">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mx-auto border border-emerald-500/30">
                    <i data-lucide="compass" class="w-6 h-6"></i>
                </div>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-white tracking-tight">
                    Siap Merencanakan Liburan Terbaik di Pangandaran?
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Diskusikan rencana perjalanan Anda bersama tim lokal kami. Dapatkan rekomendasi rute terbaik, penyesuaian anggaran, hingga fasilitas gathering instansi tanpa komitmen apa pun.
                </p>
                <div class="pt-2 flex flex-wrap justify-center gap-3.5">
                    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20paket%20wisata%20Pangandaran" 
                       target="_blank" 
                       class="px-6 py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Chat WhatsApp Tim Reservasi</span>
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>Lokasi Kantor Operasional</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20info%20paket%20wisata" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center"
       aria-label="Hubungi Kami via WhatsApp">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();

            // --- Mobile Testimonial Slider Interactive Logic (About Page) ---
            var aboutWrapper = document.getElementById('about-testi-wrapper');
            var btnNextAbout = document.getElementById('btn-next-testi-about');
            var btnPrevAbout = document.getElementById('btn-prev-testi-about');
            var aboutDots = document.querySelectorAll('#about-testi-dots-mobile .about-testi-dot');
            var totalAboutTesti = {{ $testimonials->count() }};
            var aboutAutoSlideTimer = null;

            function getAboutCardStep() {
                if (!aboutWrapper) return 334;
                var firstCard = aboutWrapper.querySelector('.testimonial-card');
                var secondCard = firstCard ? firstCard.nextElementSibling : null;
                if (firstCard && secondCard) {
                    return secondCard.offsetLeft - firstCard.offsetLeft;
                }
                return firstCard ? firstCard.offsetWidth + 24 : 334;
            }

            function slideNextAbout() {
                if (!aboutWrapper) return;
                var step = getAboutCardStep();
                var maxScroll = aboutWrapper.scrollWidth - aboutWrapper.clientWidth;
                if (aboutWrapper.scrollLeft >= maxScroll - 20) {
                    aboutWrapper.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    aboutWrapper.scrollBy({ left: step, behavior: 'smooth' });
                }
                resetAboutAutoSlide();
            }

            function slidePrevAbout() {
                if (!aboutWrapper) return;
                var step = getAboutCardStep();
                if (aboutWrapper.scrollLeft <= 15) {
                    var maxScroll = aboutWrapper.scrollWidth - aboutWrapper.clientWidth;
                    aboutWrapper.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    aboutWrapper.scrollBy({ left: -step, behavior: 'smooth' });
                }
                resetAboutAutoSlide();
            }

            function updateAboutDots() {
                if (!aboutWrapper || totalAboutTesti <= 0 || !aboutDots.length) return;
                var step = getAboutCardStep();
                var currentIdx = Math.round(aboutWrapper.scrollLeft / step) % totalAboutTesti;
                aboutDots.forEach(function(dot, idx) {
                    if (idx === currentIdx) {
                        dot.classList.remove('w-2', 'bg-neutral-300');
                        dot.classList.add('w-6', 'bg-emerald-700');
                    } else {
                        dot.classList.remove('w-6', 'bg-emerald-700');
                        dot.classList.add('w-2', 'bg-neutral-300');
                    }
                });
            }

            function startAboutAutoSlide() {
                if (window.innerWidth >= 640 || !aboutWrapper) return;
                stopAboutAutoSlide();
                aboutAutoSlideTimer = setInterval(function() {
                    slideNextAbout();
                }, 6000);
            }

            function stopAboutAutoSlide() {
                if (aboutAutoSlideTimer) {
                    clearInterval(aboutAutoSlideTimer);
                    aboutAutoSlideTimer = null;
                }
            }

            function resetAboutAutoSlide() {
                stopAboutAutoSlide();
                startAboutAutoSlide();
            }

            if (btnNextAbout) {
                btnNextAbout.addEventListener('click', slideNextAbout);
            }
            if (btnPrevAbout) {
                btnPrevAbout.addEventListener('click', slidePrevAbout);
            }

            if (aboutDots.length) {
                aboutDots.forEach(function(dot) {
                    dot.addEventListener('click', function() {
                        var targetIdx = parseInt(this.getAttribute('data-index'), 10);
                        var step = getAboutCardStep();
                        if (aboutWrapper) {
                            aboutWrapper.scrollTo({ left: targetIdx * step, behavior: 'smooth' });
                        }
                        resetAboutAutoSlide();
                    });
                });
            }

            if (aboutWrapper) {
                var scrollTimeout = null;
                aboutWrapper.addEventListener('scroll', function() {
                    if (scrollTimeout) cancelAnimationFrame(scrollTimeout);
                    scrollTimeout = requestAnimationFrame(updateAboutDots);
                }, { passive: true });

                aboutWrapper.addEventListener('touchstart', stopAboutAutoSlide, { passive: true });
                aboutWrapper.addEventListener('touchend', function() {
                    setTimeout(startAboutAutoSlide, 3000);
                }, { passive: true });
            }

            startAboutAutoSlide();
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 640) {
                    stopAboutAutoSlide();
                } else {
                    startAboutAutoSlide();
                }
            });
        });
    </script>
</body>
</html>
