<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>{{ $package->seo_title ?? $package->name . ' — Puja Tour & Travel Pangandaran' }}</title>
    <meta name="description" content="{{ $package->seo_description ?? ($package->short_description ?? 'Paket wisata terbaik di Pangandaran bersama pemandu lokal berlisensi.') }}">
    <meta name="keywords" content="{{ $package->name }}, paket wisata Pangandaran, {{ $package->location ?? 'Pangandaran' }}, Puja Tour Travel, {{ $package->category->name ?? 'wisata alam' }}">
    
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $package->name }} — Puja Tour & Travel">
    <meta property="og:description" content="{{ $package->short_description }}">
    <meta property="og:image" content="{{ asset($package->image_url ?? 'images/greencanyon.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $package->name }} — Puja Tour & Travel">
    <meta name="twitter:description" content="{{ $package->short_description }}">
    <meta name="twitter:image" content="{{ asset($package->image_url ?? 'images/greencanyon.jpg') }}">

    <!-- Structured Data (JSON-LD): TouristTrip & BreadcrumbList -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TouristTrip',
        'name' => $package->name,
        'description' => $package->short_description ?? $package->name,
        'touristType' => 'Semua Usia',
        'offers' => [
            '@type' => 'Offer',
            'price' => (int) $package->price,
            'priceCurrency' => 'IDR',
            'availability' => 'https://schema.org/InStock',
            'url' => url()->current(),
        ],
        'provider' => [
            '@type' => 'TravelAgency',
            'name' => 'Puja Tour Travel',
            'url' => url('/'),
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
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
                'name' => 'Paket Wisata',
                'item' => route('packages.index'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $package->name,
                'item' => url()->current(),
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/puja_logo.png') }}">

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
        $bookingWaText = urlencode("Halo Admin Puja Tour & Travel, saya ingin konsultasi & booking paket \"{$package->name}\" ({$package->formatted_price}/{$package->price_unit}). Mohon info jadwal dan ketersediaannya.");
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
                <a href="{{ route('packages.index') }}" class="text-emerald-700 font-semibold hover:text-emerald-800 transition">Paket Wisata</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-700 transition">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="hover:text-emerald-700 transition">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="hover:text-emerald-700 transition">FAQ</a>
                <a href="{{ route('gallery') }}" class="hover:text-emerald-700 transition">Galeri</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak</a>
            </nav>

            <!-- Header Action CTA -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/{{ $waNum }}?text={{ $bookingWaText }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Tanya Trip CS</span>
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center gap-2 lg:hidden">
                <a href="{{ route('packages.index') }}" class="text-xs font-bold text-emerald-700 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200">
                    Paket Wisata
                </a>
                <a href="{{ route('home') }}" class="p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition" aria-label="Kembali ke Beranda">
                    <i data-lucide="home" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- BREADCRUMBS -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500 overflow-x-auto whitespace-nowrap">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition flex items-center gap-1">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                <span>Beranda</span>
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <a href="{{ route('packages.index') }}" class="hover:text-emerald-700 transition">Paket Wisata</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            @if($package->category)
                <a href="{{ route('packages.index', ['category' => $package->category->slug]) }}" class="hover:text-emerald-700 transition">
                    {{ $package->category->name }}
                </a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            @endif
            <span class="text-slate-900 font-semibold truncate">{{ $package->name }}</span>
        </nav>
    </div>

    <!-- MAIN DETAIL CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT / MAIN CONTENT (8 COLS) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Package Hero & Image Banner -->
                <div class="bg-surface-soft rounded-3xl overflow-hidden shadow-soft border border-neutral-200">
                    <div class="relative h-72 sm:h-96 md:h-112 w-full bg-slate-900 overflow-hidden">
                        <img src="{{ $package->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $package->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                        
                        <!-- Badges on Image -->
                        <div class="absolute top-6 left-6 flex flex-wrap items-center gap-2">
                            @if($package->featured)
                                <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-amber-500 text-slate-950 shadow-md flex items-center gap-1.5">
                                    <i data-lucide="star" class="w-3.5 h-3.5 fill-slate-950"></i>
                                    <span>Paket Rekomendasi</span>
                                </span>
                            @endif
                            <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-700 text-white shadow-md">
                                {{ $package->category->name ?? 'Wisata Alam' }}
                            </span>
                        </div>

                        <!-- Title & Meta over bottom of image -->
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <div class="flex flex-wrap items-center gap-4 text-xs font-medium text-slate-200 mb-2">
                                <span class="flex items-center gap-1.5 bg-slate-900/70 backdrop-blur-sm px-3 py-1 rounded-xl">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-400"></i>
                                    <span>{{ $package->location ?? 'Pangandaran, Jawa Barat' }}</span>
                                </span>
                                @if($package->duration)
                                    <span class="flex items-center gap-1.5 bg-slate-900/70 backdrop-blur-sm px-3 py-1 rounded-xl">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-emerald-400"></i>
                                        <span>Durasi: {{ $package->duration }}</span>
                                    </span>
                                @endif
                            </div>
                            <h1 class="font-display font-extrabold text-2xl sm:text-3xl md:text-4xl text-white tracking-tight leading-tight">
                                {{ $package->name }}
                            </h1>
                        </div>
                    </div>

                    <!-- Highlight Highlights Bar -->
                    <div class="p-6 sm:p-8 border-b border-neutral-200 bg-white grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                        <div class="p-3 rounded-2xl bg-canvas border border-neutral-200">
                            <span class="text-[11px] text-slate-400 block font-medium">Harga Mulai</span>
                            <span class="font-display font-extrabold text-lg sm:text-xl text-emerald-700">{{ $package->formatted_price }}</span>
                            <span class="text-[10px] text-slate-400">/ {{ $package->price_unit }}</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-canvas border border-neutral-200">
                            <span class="text-[11px] text-slate-400 block font-medium">Durasi Trip</span>
                            <span class="font-display font-bold text-sm sm:text-base text-slate-800 mt-1 block">{{ $package->duration ?? 'Fleksibel' }}</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-canvas border border-neutral-200">
                            <span class="text-[11px] text-slate-400 block font-medium">Pemandu</span>
                            <span class="font-display font-bold text-sm sm:text-base text-emerald-800 mt-1 block">Lisensi HPI</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-canvas border border-neutral-200">
                            <span class="text-[11px] text-slate-400 block font-medium">Jaminan</span>
                            <span class="font-display font-bold text-sm sm:text-base text-slate-800 mt-1 block">Termasuk Asuransi</span>
                        </div>
                    </div>
                </div>

                <!-- 1. Deskripsi Lengkap -->
                <div class="bg-surface-soft rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200">
                    <div class="flex items-center gap-3 pb-4 mb-6 border-b border-neutral-200">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h2 class="font-display font-bold text-xl text-slate-900">Deskripsi & Rincian Pengalaman</h2>
                            <p class="text-xs text-slate-500">Mengenal lebih dalam petualangan yang akan Anda dapatkan</p>
                        </div>
                    </div>

                    @if($package->short_description)
                        <div class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-200/60 mb-6">
                            <p class="text-sm font-medium text-emerald-950 leading-relaxed">
                                {{ $package->short_description }}
                            </p>
                        </div>
                    @endif

                    <div class="prose max-w-none text-slate-700 text-sm sm:text-base leading-relaxed space-y-4">
                        <p>
                            {{ $package->description ?? 'Nikmati petualangan tak terlupakan di Pangandaran bersama tim Puja Tour & Travel. Paket ini telah dirancang dengan standar keselamatan tertinggi, jadwal yang terorganisir rapi, dan fasilitas lengkap untuk kenyamanan maksimal Anda dan keluarga.' }}
                        </p>
                        <p>
                            Dengan dipandu langsung oleh pemandu lokal berlisensi resmi HPI (Himpunan Pramuwisata Indonesia), Anda akan diajak menjelajahi sudut-sudut eksotis terbaik, menikmati sajian kuliner khas Sunda yang lezat, serta mengabadikan momen-momen indah tanpa khawatir mengenai keamanan perlengkapan.
                        </p>
                    </div>
                </div>

                <!-- 2. Fasilitas Termasuk & Tidak Termasuk -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Termasuk (Inclusions) -->
                    <div class="bg-surface-soft rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200">
                        <div class="flex items-center gap-3 pb-4 mb-4 border-b border-neutral-200">
                            <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                <i data-lucide="check" class="w-5 h-5"></i>
                            </div>
                            <h3 class="font-display font-bold text-lg text-slate-900">Fasilitas Termasuk</h3>
                        </div>

                        <ul class="space-y-3 text-xs sm:text-sm text-slate-700 font-medium">
                            @if(is_array($package->inclusions) && count($package->inclusions) > 0)
                                @foreach($package->inclusions as $inc)
                                    <li class="flex items-start gap-2.5">
                                        <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                        </div>
                                        <span>{{ $inc }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-start gap-2.5">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span>Pemandu Wisata Lokal Bersertifikasi HPI</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span>Peralatan Standard Keselamatan Lengkap</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span>Tiket Masuk Obyek Wisata & Asuransi Jiwa</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span>Dokumentasi Foto Selama Kegiatan</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Tidak Termasuk (Exclusions) -->
                    <div class="bg-surface-soft rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200">
                        <div class="flex items-center gap-3 pb-4 mb-4 border-b border-neutral-200">
                            <div class="w-9 h-9 rounded-xl bg-slate-200 text-slate-700 flex items-center justify-center">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </div>
                            <h3 class="font-display font-bold text-lg text-slate-900">Belum Termasuk</h3>
                        </div>

                        <ul class="space-y-3 text-xs sm:text-sm text-slate-600 font-medium">
                            @if(is_array($package->exclusions) && count($package->exclusions) > 0)
                                @foreach($package->exclusions as $exc)
                                    <li class="flex items-start gap-2.5">
                                        <div class="w-5 h-5 rounded-full bg-neutral-200 text-slate-500 flex items-center justify-center shrink-0 mt-0.5">
                                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                        </div>
                                        <span>{{ $exc }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-start gap-2.5">
                                    <div class="w-5 h-5 rounded-full bg-neutral-200 text-slate-500 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span>Transportasi pribadi menuju titik kumpul</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-5 h-5 rounded-full bg-neutral-200 text-slate-500 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span>Pengeluaran pribadi di luar kesepakatan paket</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-5 h-5 rounded-full bg-neutral-200 text-slate-500 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span>Tips sukarela pemandu lapangan</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- 3. Rundown / Itinerary Kegiatan -->
                @if(is_array($package->itinerary) && count($package->itinerary) > 0)
                    <div class="bg-surface-soft rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-neutral-200">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                                <i data-lucide="calendar" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h2 class="font-display font-bold text-xl text-slate-900">Rencana Perjalanan (Itinerary)</h2>
                                <p class="text-xs text-slate-500">Estimasi jadwal kegiatan untuk kenyamanan trip Anda</p>
                            </div>
                        </div>

                        <div class="relative pl-6 sm:pl-8 border-l-2 border-emerald-200 space-y-6">
                            @foreach($package->itinerary as $step)
                                <div class="relative">
                                    <div class="absolute -left-7.75 sm:-left-9.75 top-1 w-4 h-4 rounded-full bg-emerald-700 ring-4 ring-emerald-100"></div>
                                    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-neutral-200 shadow-xs">
                                        <div class="flex flex-wrap items-center justify-between gap-2 mb-1.5">
                                            <h4 class="font-display font-bold text-base text-slate-900">{{ $step['activity'] ?? 'Kegiatan Wisata' }}</h4>
                                            @if(!empty($step['time']))
                                                <span class="px-2.5 py-0.5 rounded-lg text-xs font-bold bg-slate-900 text-emerald-400">
                                                    {{ $step['time'] }}
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                            {{ $step['desc'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 4. Pilar Kepercayaan -->
                <div class="bg-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-md">
                    <h3 class="font-display font-bold text-lg text-white mb-4">Mengapa Liburan Bersama Puja Tour?</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="flex items-start gap-3">
                            <i data-lucide="shield-check" class="w-6 h-6 text-emerald-400 shrink-0 mt-0.5"></i>
                            <div>
                                <h4 class="font-bold text-xs text-white">Legalitas Resmi CV</h4>
                                <p class="text-[11px] text-slate-300 mt-0.5">Berbadan hukum resmi dan terpercaya untuk rombongan & keluarga.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="user-check" class="w-6 h-6 text-emerald-400 shrink-0 mt-0.5"></i>
                            <div>
                                <h4 class="font-bold text-xs text-white">Guide Berlisensi</h4>
                                <p class="text-[11px] text-slate-300 mt-0.5">Pemandu lokal profesional bersertifikat HPI ramah & sabar.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="heart-handshake" class="w-6 h-6 text-emerald-400 shrink-0 mt-0.5"></i>
                            <div>
                                <h4 class="font-bold text-xs text-white">Garansi Kepuasan</h4>
                                <p class="text-[11px] text-slate-300 mt-0.5">Pelayanan ramah, fleksibel, dan transparan tanpa biaya tersembunyi.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT / BOOKING SIDEBAR (4 COLS STICKY) -->
            <div class="lg:col-span-4 sticky top-24 space-y-6">
                
                <!-- Main Booking Card -->
                <div class="bg-surface-soft rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200">
                    <div class="pb-5 border-b border-neutral-200">
                        <span class="text-xs font-semibold text-slate-400 block uppercase tracking-wider">Harga Resmi Paket</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="font-display font-extrabold text-3xl sm:text-4xl text-emerald-700">{{ $package->formatted_price }}</span>
                            <span class="text-xs font-bold text-slate-500">/ {{ $package->price_unit }}</span>
                        </div>
                        <span class="inline-block mt-2 px-2.5 py-1 rounded-md text-[11px] font-bold bg-amber-100 text-amber-900">
                            Diskon s/d 15% untuk Rombongan 10+ Orang
                        </span>
                    </div>

                    <!-- Quick WhatsApp Booking CTA -->
                    <div class="py-5 space-y-3">
                        <a href="https://wa.me/{{ $waNum }}?text={{ $bookingWaText }}" 
                           target="_blank" 
                           class="w-full py-4 px-6 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm text-center transition flex items-center justify-center gap-2.5 shadow-md hover:shadow-lg hover:-translate-y-0.5 duration-200">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                            <span>Booking Cepat via WhatsApp</span>
                        </a>

                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneNum) }}" 
                           class="w-full py-3 px-4 rounded-xl bg-white hover:bg-neutral-100 text-slate-800 font-bold text-xs text-center border border-neutral-200 transition flex items-center justify-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4 text-emerald-700"></i>
                            <span>Hubungi Hotline: {{ $phoneNum }}</span>
                        </a>
                    </div>

                    <!-- Quick Information Summary List -->
                    <div class="pt-5 border-t border-neutral-200 space-y-3 text-xs text-slate-600">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Minimal Peserta:</span>
                            <span class="font-bold text-slate-800">1 Orang / Fleksibel</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Lokasi Penjemputan:</span>
                            <span class="font-bold text-slate-800">Pangandaran</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Metode Bayar:</span>
                            <span class="font-bold text-slate-800">DP Transfer & Pelunasan di Tempat</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Konfirmasi Jadwal:</span>
                            <span class="font-bold text-emerald-700">Instan via WhatsApp</span>
                        </div>
                    </div>

                    <!-- Quick Consultation Box -->
                    <div class="mt-6 p-4 rounded-2xl bg-canvas border border-neutral-200 text-xs">
                        <span class="font-bold text-slate-900 block mb-1">Butuh Jadwal Khusus?</span>
                        <p class="text-slate-500 leading-relaxed">
                            Kami siap menyesuaikan jadwal keberangkatan, custom menu makan, atau penjemputan stasiun/bandara.
                        </p>
                    </div>
                </div>

                <!-- Back to All Packages Button -->
                <div class="text-center">
                    <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700 transition">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Lihat Semua Katalog Paket Wisata</span>
                    </a>
                </div>

            </div>

        </div>

        <!-- RELATED PACKAGES SECTION -->
        @if($relatedPackages && $relatedPackages->count() > 0)
            <div class="mt-20 pt-12 border-t border-neutral-200">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                            Pilihan Lainnya
                        </span>
                        <h3 class="font-display font-bold text-2xl text-slate-900 mt-2">Paket Wisata Terkait</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Eksplorasi opsi liburan lainnya yang tak kalah seru</p>
                    </div>
                    <a href="{{ route('packages.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition flex items-center gap-1">
                        <span>Lihat Semua ({{ \App\Models\Package::where('status', 'PUBLISHED')->count() }})</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPackages as $rel)
                        <div class="flex flex-col bg-surface-soft rounded-3xl overflow-hidden shadow-soft hover:shadow-card-hover transition-all duration-300 border border-neutral-200 group">
                            <div class="relative h-48 overflow-hidden bg-neutral-100">
                                <img src="{{ $rel->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-700 text-white">
                                        {{ $rel->category->name ?? 'Wisata' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-1 text-[11px] font-semibold text-emerald-700 mb-1">
                                        <i data-lucide="map-pin" class="w-3 h-3"></i>
                                        <span>{{ $rel->location ?? 'Pangandaran' }}</span>
                                    </div>
                                    <h4 class="font-display font-bold text-base text-slate-900 group-hover:text-emerald-700 transition line-clamp-1">
                                        {{ $rel->name }}
                                    </h4>
                                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">
                                        {{ $rel->short_description }}
                                    </p>
                                </div>
                                <div class="pt-4 mt-4 border-t border-neutral-200 flex items-center justify-between">
                                    <div>
                                        <span class="text-[10px] text-slate-400 block font-medium">Mulai dari</span>
                                        <span class="font-display font-bold text-base text-emerald-700">{{ $rel->formatted_price }}</span>
                                    </div>
                                    <a href="{{ route('packages.show', $rel->slug) }}" class="px-3.5 py-2 rounded-xl bg-slate-900 hover:bg-emerald-700 text-white font-semibold text-xs transition flex items-center gap-1">
                                        <span>Detail</span>
                                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
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
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Semua Paket Wisata</a></li>
                        <li><a href="{{ route('home') }}#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('home') }}#faq" class="hover:text-white transition">Pertanyaan Umum (FAQ)</a></li>
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

    <!-- MOBILE STICKY BOTTOM BAR (Section 10.2 / 04-ui-ux-guidelines.md) -->
    <div class="fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/80 px-4 py-3 lg:hidden shadow-lg flex items-center justify-between gap-3">
        <div class="flex flex-col">
            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Mulai Dari</span>
            <div class="flex items-baseline gap-1">
                <span class="font-display font-black text-emerald-700 text-base sm:text-lg">{{ $package->formatted_price }}</span>
                <span class="text-[11px] text-slate-500 font-medium">/ {{ $package->price_unit }}</span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="https://wa.me/{{ $waNum }}?text={{ $bookingWaText }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-1.5 whitespace-nowrap">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Pesan Sekarang</span>
            </a>
            <a href="{{ route('calculator') }}" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition" title="Hitung Estimasi Biaya">
                <i data-lucide="calculator" class="w-4 h-4"></i>
            </a>
        </div>
    </div>

    <!-- Floating WhatsApp Button (With Safe Padding on Mobile) -->
    <a href="https://wa.me/{{ $waNum }}?text={{ $bookingWaText }}" 
       target="_blank" 
       aria-label="Hubungi WhatsApp Puja Tour"
       class="fixed bottom-20 lg:bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center group">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

</body>
</html>
