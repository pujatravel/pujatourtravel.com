<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Kalkulator & Estimasi Biaya Wisata Pangandaran — Puja Tour & Travel</title>
    <meta name="description" content="Simulasi dan estimasi biaya paket wisata Pangandaran, body rafting Green Canyon, diskon rombongan otomatis, dan reservasi WhatsApp instan.">
    <meta name="keywords" content="harga paket wisata Pangandaran, estimasi biaya body rafting Green Canyon, kalkulator wisata, biaya snorkeling Pasir Putih, harga tour Pangandaran">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Kalkulator & Estimasi Biaya Wisata Pangandaran — Puja Tour & Travel">
    <meta property="og:description" content="Simulasi dan estimasi biaya paket wisata Pangandaran, body rafting Green Canyon, diskon rombongan otomatis, dan reservasi WhatsApp instan.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Kalkulator & Estimasi Biaya Wisata Pangandaran — Puja Tour & Travel">
    <meta name="twitter:description" content="Simulasi dan estimasi biaya paket wisata Pangandaran, body rafting Green Canyon, diskon rombongan otomatis, dan reservasi WhatsApp instan.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

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
                'name' => 'Estimasi Biaya',
                'item' => url()->current(),
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    @include('partials.analytics')
</head>
<body class="bg-surface-soft text-slate-800 antialiased selection:bg-emerald-700 selection:text-white pt-20 sm:pt-24">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
        $igUrl = $settings['instagram_url'] ?? 'https://www.instagram.com/puja_tourtravel/';
        $tiktokUrl = $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel';
        $companyName = $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN';
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
            <span class="text-slate-900 font-semibold">Estimasi Biaya Wisata</span>
        </nav>
    </div>

    <!-- MAIN CALCULATOR CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 pb-20">
        <!-- PAGE HEADER -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
            <div class="inline-flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-widest text-emerald-700 mb-2 sm:mb-3">
                <i data-lucide="sparkles" class="w-4 h-4 text-emerald-600"></i>
                <span>Simulasi Anggaran & Estimasi Biaya Transparan</span>
            </div>
            <h1 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-5xl text-slate-900 tracking-tight">
                Simulasi & Estimasi Biaya Liburan
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm lg:text-base mt-3 max-w-2xl mx-auto leading-relaxed">
                Rancang anggaran liburan Anda secara akurat dan terbuka. Dilengkapi otomatisasi diskon rombongan hingga 15%, pilihan add-on fleksibel, dan kemudahan booking instan ke WhatsApp resmi.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- LEFT COLUMN: FORM PARAMETERS (7 COLS) -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200 space-y-6">
                <!-- Header Box -->
                <div class="flex items-center gap-3.5 pb-5 border-b border-neutral-100">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center shrink-0 shadow-2xs">
                        <i data-lucide="sliders-horizontal" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Parameter Rencana Liburan</h2>
                        <p class="text-xs text-slate-500">Sesuaikan paket dan jumlah peserta untuk melihat kalkulasi biaya</p>
                    </div>
                </div>

                <!-- 1. PILIH PAKET WISATA -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Pilih Paket Wisata <span class="text-emerald-700">*</span>
                        </label>
                        <span class="text-[11px] font-semibold text-slate-400">Total {{ $packages->count() }} Pilihan Paket</span>
                    </div>
                    <select id="calc-page-package" class="w-full px-4 py-3.5 rounded-2xl border border-neutral-200 bg-canvas text-slate-900 font-semibold text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition cursor-pointer shadow-2xs">
                        @foreach($packages as $pkg)
                            <option value="{{ $pkg->slug }}" 
                                    data-name="{{ $pkg->name }}" 
                                    data-price="{{ (int) $pkg->price }}" 
                                    data-duration="{{ $pkg->duration ?? '1 Hari' }}"
                                    data-category="{{ $pkg->category->name ?? 'Wisata' }}"
                                    data-location="{{ $pkg->location ?? 'Pangandaran' }}"
                                    data-image="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}"
                                    data-url="{{ route('packages.show', $pkg->slug) }}"
                                    {{ (request('package') === $pkg->slug || request('paket') === $pkg->slug) ? 'selected' : '' }}>
                                {{ $pkg->name }} ({{ $pkg->formatted_price }} / {{ $pkg->price_unit }})
                            </option>
                        @endforeach
                    </select>

                    <!-- LIVE PACKAGE PREVIEW CARD (Dinamis dari Paket Terpilih) -->
                    <div id="selected-pkg-preview" class="mt-3.5 p-3 sm:p-3.5 rounded-2xl bg-slate-50 border border-slate-200/90 flex flex-col xs:flex-row xs:items-center justify-between gap-3 sm:gap-4 transition-all duration-300">
                        <div class="flex items-center gap-3 min-w-0">
                            <img id="preview-pkg-img" src="{{ asset('images/greencanyon.jpg') }}" alt="Preview" class="w-14 h-14 rounded-xl object-cover shrink-0 border border-slate-200 shadow-2xs">
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span id="preview-pkg-badge" class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        Wisata Alam
                                    </span>
                                    <span id="preview-pkg-duration" class="text-[11px] text-slate-500 font-medium flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                                        <span>1 Hari</span>
                                    </span>
                                </div>
                                <h4 id="preview-pkg-title" class="font-display font-bold text-xs sm:text-sm text-slate-900 truncate">
                                    Paket Wisata
                                </h4>
                            </div>
                        </div>
                        <a id="preview-pkg-link" href="#" target="_blank" class="shrink-0 inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-white border border-neutral-200 hover:border-emerald-500 text-slate-700 hover:text-emerald-700 font-semibold text-xs transition shadow-2xs">
                            <span>Detail Rundown</span>
                            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>

                <!-- 2. JUMLAH PESERTA & TANGGAL TRIP -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                    <!-- Jumlah Peserta dengan Stepper & Quick Pills -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                                Jumlah Peserta <span class="text-emerald-700">*</span>
                            </label>
                            <span id="pax-discount-indicator" class="text-[11px] font-bold text-slate-500">
                                Harga Normal
                            </span>
                        </div>
                        
                        <!-- Stepper Input -->
                        <div class="flex items-center gap-2">
                            <button type="button" id="btn-pax-minus" aria-label="Kurangi Peserta" class="w-11 h-11 rounded-xl bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 font-bold flex items-center justify-center transition cursor-pointer shrink-0 border border-slate-200/80 active:scale-95">
                                <i data-lucide="minus" class="w-4 h-4"></i>
                            </button>
                            <div class="relative flex-1">
                                <input type="number" id="calc-page-pax" min="1" max="500" step="1" inputmode="numeric" value="4" class="w-full text-center px-3 py-2.5 rounded-xl border border-neutral-200 bg-canvas text-slate-900 font-extrabold text-base focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none transition">
                            </div>
                            <button type="button" id="btn-pax-plus" aria-label="Tambah Peserta" class="w-11 h-11 rounded-xl bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 font-bold flex items-center justify-center transition cursor-pointer shrink-0 border border-slate-200/80 active:scale-95">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <!-- Quick Selection Pills -->
                        <div class="flex flex-wrap gap-1.5 mt-2.5">
                            <button type="button" class="btn-quick-pax px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-slate-100 hover:bg-emerald-50 hover:text-emerald-800 text-slate-600 transition cursor-pointer" data-pax="2">
                                2 Pax
                            </button>
                            <button type="button" class="btn-quick-pax px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-slate-100 hover:bg-emerald-50 hover:text-emerald-800 text-slate-600 transition cursor-pointer" data-pax="4">
                                4 Pax
                            </button>
                            <button type="button" class="btn-quick-pax px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-slate-100 hover:bg-emerald-50 hover:text-emerald-800 text-slate-600 transition cursor-pointer" data-pax="6">
                                6 Pax (Hemat 10%)
                            </button>
                            <button type="button" class="btn-quick-pax px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-slate-100 hover:bg-emerald-50 hover:text-emerald-800 text-slate-600 transition cursor-pointer" data-pax="10">
                                10+ Pax (Hemat 15%)
                            </button>
                        </div>

                        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1.5">
                            <i data-lucide="tag" class="w-3.5 h-3.5 text-emerald-700 shrink-0"></i>
                            <span>Diskon 10% untuk 5-9 pax &bull; 15% untuk ≥10 pax</span>
                        </p>
                    </div>

                    <!-- Rencana Tanggal Trip -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                                Rencana Tanggal Trip
                            </label>
                            <span class="text-[11px] text-slate-400 font-medium">Opsional</span>
                        </div>
                        <div class="relative">
                            <input type="date" id="calc-page-date" min="{{ date('Y-m-d') }}" placeholder="Pilih tanggal trip..." class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 bg-canvas text-slate-800 font-medium text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none transition custom-datepicker-input">
                        </div>
                        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-emerald-700 shrink-0"></i>
                            <span>Jadwal fleksibel, dapat disesuaikan kembali via WhatsApp</span>
                        </p>
                    </div>
                </div>

                <!-- 3. ADD-ONS LAYANAN TAMBAHAN (OPSIONAL) -->
                <div class="pt-4 border-t border-neutral-100">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">Layanan Tambahan (Opsional)</label>
                            <p class="text-xs text-slate-500">Pilih fasilitas pelengkap untuk kenyamanan ekstra liburan Anda</p>
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2 py-0.5 rounded-md">
                            Kustomisasi
                        </span>
                    </div>

                    <div class="space-y-3">
                        <!-- Addon 1: Drone 4K -->
                        <label class="group flex items-start justify-between p-4 rounded-2xl bg-canvas border border-neutral-200 hover:border-emerald-300 has-checked:border-emerald-600 has-checked:bg-emerald-50/40 has-checked:shadow-2xs cursor-pointer transition-all duration-200">
                            <div class="flex items-start gap-3.5 min-w-0">
                                <div class="pt-0.5">
                                    <input type="checkbox" id="addon-drone" data-cost="350000" data-type="flat" class="calc-addon rounded-lg text-emerald-700 focus:ring-emerald-700 w-4.5 h-4.5 border-neutral-300 cursor-pointer">
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-700 transition">
                                            Dokumentasi Video Drone 4K Sinematik
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">
                                        Pengambilan video udara profesional di tebing Green Canyon atau garis pantai Pangandaran.
                                    </p>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-emerald-700 shrink-0 ml-3 whitespace-nowrap bg-white px-2.5 py-1 rounded-lg border border-neutral-200">
                                +Rp 350.000 / trip
                            </span>
                        </label>

                        <!-- Addon 2: Gala Dinner Seafood -->
                        <label class="group flex items-start justify-between p-4 rounded-2xl bg-canvas border border-neutral-200 hover:border-emerald-300 has-checked:border-emerald-600 has-checked:bg-emerald-50/40 has-checked:shadow-2xs cursor-pointer transition-all duration-200">
                            <div class="flex items-start gap-3.5 min-w-0">
                                <div class="pt-0.5">
                                    <input type="checkbox" id="addon-seafood" data-cost="85000" data-type="per_pax" class="calc-addon rounded-lg text-emerald-700 focus:ring-emerald-700 w-4.5 h-4.5 border-neutral-300 cursor-pointer">
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-700 transition">
                                            Gala Dinner Seafood Bakar Pesisir
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">
                                        Menu olahan laut segar: kepiting, udang, cumi saus padang, dan ikan bakar bumbu rempah.
                                    </p>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-emerald-700 shrink-0 ml-3 whitespace-nowrap bg-white px-2.5 py-1 rounded-lg border border-neutral-200">
                                +Rp 85.000 / pax
                            </span>
                        </label>

                        <!-- Addon 3: Antar-Jemput Transport -->
                        <label class="group flex items-start justify-between p-4 rounded-2xl bg-canvas border border-neutral-200 hover:border-emerald-300 has-checked:border-emerald-600 has-checked:bg-emerald-50/40 has-checked:shadow-2xs cursor-pointer transition-all duration-200">
                            <div class="flex items-start gap-3.5 min-w-0">
                                <div class="pt-0.5">
                                    <input type="checkbox" id="addon-transport" data-cost="150000" data-type="per_pax" class="calc-addon rounded-lg text-emerald-700 focus:ring-emerald-700 w-4.5 h-4.5 border-neutral-300 cursor-pointer">
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-700 transition">
                                            Antar-Jemput Stasiun / Bandara Banjar
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">
                                        Armada private ber-AC (Hiace / Elf / Avanza) dengan driver lokal berpengalaman.
                                    </p>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-emerald-700 shrink-0 ml-3 whitespace-nowrap bg-white px-2.5 py-1 rounded-lg border border-neutral-200">
                                +Rp 150.000 / pax
                            </span>
                        </label>
                    </div>
                </div>

                <!-- 4. DATA KONTAK PEMESAN & CATATAN -->
                <div class="pt-4 border-t border-neutral-100 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">
                            Nama Pemesan
                        </label>
                        <input type="text" id="calc-page-name" placeholder="Nama Lengkap Anda (contoh: Hendra Wijaya)" class="w-full px-4 py-3 rounded-2xl border border-neutral-200 bg-canvas text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">
                            Catatan Tambahan (Opsional)
                        </label>
                        <textarea id="calc-page-notes" rows="2" placeholder="Tuliskan permintaan khusus (misal: titik temu stasiun, menu vegetarian, dll)..." class="w-full px-4 py-3 rounded-2xl border border-neutral-200 bg-canvas text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none transition"></textarea>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: STICKY LIVE INVOICE / VOUCHER SUMMARY (5 COLS) -->
            <div class="lg:col-span-5 self-start sticky top-24 space-y-6">
                <!-- Voucher Receipt Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200 relative overflow-hidden">
                    <!-- Voucher Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-neutral-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                <i data-lucide="receipt" class="w-5 h-5"></i>
                            </div>
                            <h3 class="font-display font-bold text-base sm:text-lg text-slate-900">
                                Rincian Estimasi Biaya
                            </h3>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-bold uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                            <span>Real-Time</span>
                        </span>
                    </div>

                    <!-- Breakdown Rows -->
                    <div class="py-5 space-y-3.5 text-xs sm:text-sm">
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Paket Terpilih:</span>
                            <span id="summary-pkg-name" class="font-semibold text-slate-900 text-right max-w-44 truncate">-</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Harga Dasar / Pax:</span>
                            <span id="summary-pkg-price" class="font-semibold text-slate-900">Rp 0</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Jumlah Peserta:</span>
                            <span id="summary-pax" class="font-semibold text-slate-900">4 Orang</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Subtotal Paket:</span>
                            <span id="summary-subtotal" class="font-semibold text-slate-900">Rp 0</span>
                        </div>

                        <!-- Diskon Row (Dinamis) -->
                        <div id="summary-discount-row" class="hidden items-center justify-between text-emerald-700 font-bold bg-emerald-50/80 px-3 py-2 rounded-xl border border-emerald-200/80">
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-600"></i>
                                <span>Potongan Diskon:</span>
                            </span>
                            <span id="summary-discount">-Rp 0</span>
                        </div>

                        <!-- Add-ons Row (Dinamis) -->
                        <div id="summary-addon-row" class="hidden items-center justify-between text-slate-600">
                            <span>Layanan Tambahan (Add-on):</span>
                            <span id="summary-addon" class="font-semibold text-slate-900">+Rp 0</span>
                        </div>

                        <!-- Dashed Divider -->
                        <div class="border-t-2 border-dashed border-neutral-200 my-4"></div>

                        <!-- Grand Total Highlight -->
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-500 font-medium">Estimasi Total Akhir</span>
                                <span class="text-[10px] text-emerald-800 font-bold bg-emerald-100/70 px-2 py-0.5 rounded-full">
                                    All-Inclusive
                                </span>
                            </div>
                            <span id="summary-grand-total" class="font-display font-extrabold text-3xl sm:text-4xl text-emerald-700 tracking-tight">
                                Rp 0
                            </span>
                            <span class="text-[11px] text-slate-400">
                                Sudah mencakup tiket retribusi, asuransi trip, dan pemandu resmi HPI.
                            </span>
                        </div>
                    </div>

                    <!-- Direct Send via WhatsApp Button -->
                    <div class="pt-4 border-t border-neutral-100">
                        <button type="button" id="btn-calc-page-send" data-whatsapp="{{ $waNum }}" class="w-full py-4 px-6 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm text-center transition-all duration-300 flex items-center justify-center gap-2.5 shadow-md hover:shadow-lg hover:-translate-y-0.5 active:scale-98 cursor-pointer">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                            <span>Kirim Rincian Estimasi ke WhatsApp CS</span>
                        </button>
                        <p class="text-[11px] text-slate-400 text-center mt-2.5 flex items-center justify-center gap-1.5">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Konsultasi gratis &bull; Tim reservasi merespons dalam hitungan menit</span>
                        </p>
                    </div>
                </div>

                <!-- Trust Guarantee Box -->
                <div class="p-5 sm:p-6 rounded-3xl bg-white border border-neutral-200 space-y-3 shadow-2xs">
                    <div class="flex items-center gap-2 font-bold text-slate-900 text-xs sm:text-sm">
                        <i data-lucide="shield-check" class="w-4 h-4 text-emerald-700"></i>
                        <span>Jaminan Transparansi Pemesanan:</span>
                    </div>
                    <ul class="space-y-2 text-xs text-slate-600">
                        <li class="flex items-start gap-2">
                            <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5"></i>
                            <span><strong>Tanpa Biaya Siluman:</strong> Harga final sesuai invoice resmi tanpa pungli tambahan di lokasi trip.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5"></i>
                            <span><strong>DP Fleksibel 20% - 30%:</strong> Transfer aman ke rekening bank resmi perseroan CV Puja Tour.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5"></i>
                            <span><strong>Garansi Cuaca Ekstrem:</strong> Fleksibilitas penjadwalan ulang atau penyesuaian rute alternatif.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 2. SECTION PANDUAN TIER DISKON ROMBONGAN -->
        <section class="mt-16 sm:mt-20">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                    Skema Anggaran Rombongan
                </span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 mt-2 tracking-tight">
                    Panduan Diskon & Kapasitas Peserta
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1.5 leading-relaxed">
                    Semakin banyak peserta trip yang Anda bawa, semakin hemat biaya per orang dengan potongan otomatis sistem.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
                <!-- Tier 1 -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-neutral-200 shadow-soft hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full">
                                Small Group
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center group-hover:bg-emerald-50 group-hover:text-emerald-700 transition">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-1">Trip 1 - 4 Orang</h3>
                        <p class="text-xs font-bold text-slate-500 mb-3">Tarif Normal Standar Private</p>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Pilihan ideal bagi pasangan, backpacker, atau keluarga inti. Trip private tanpa digabung dengan peserta luar lainnya.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-neutral-100 text-xs text-slate-700 space-y-1.5">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Private river guide berlisensi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Asuransi jiwa pariwisata resmi</span>
                        </div>
                    </div>
                </div>

                <!-- Tier 2 -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border-2 border-emerald-500/80 shadow-soft hover:shadow-card-hover transition-all duration-300 flex flex-col justify-between relative group">
                    <div class="absolute -top-3 left-6">
                        <span class="px-3 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-700 text-white shadow-2xs">
                            Favorit Keluarga
                        </span>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-4 pt-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                Group Saving
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                <i data-lucide="sparkles" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-1">Trip 5 - 9 Orang</h3>
                        <p class="text-xs font-bold text-emerald-700 mb-3">Diskon Otomatis 10%</p>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Cocok untuk rombongan keluarga besar, sahabat, atau rekan kerja. Otomatis memangkas 10% dari total tagihan paket dasar.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-neutral-100 text-xs text-slate-700 space-y-1.5">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Hemat hingga ratusan ribu rupiah</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Pemandu khusus rombongan keluarga</span>
                        </div>
                    </div>
                </div>

                <!-- Tier 3 -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-neutral-200 shadow-soft hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-900 bg-emerald-100/70 px-2.5 py-1 rounded-full">
                                Corporate & Gathering
                            </span>
                            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center group-hover:bg-emerald-50 group-hover:text-emerald-700 transition">
                                <i data-lucide="building-2" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-1">Trip 10+ Orang</h3>
                        <p class="text-xs font-bold text-emerald-700 mb-3">Diskon Maksimal 15%</p>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Solusi gathering instansi, perusahaan, sekolah, atau komunitas. Potongan 15% plus fasilitas penunjang gathering lengkap.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-neutral-100 text-xs text-slate-700 space-y-1.5">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Gratis spanduk / banner tour gathering</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>Faktur resmi CV & proposal penawaran</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. GRAND CTA SECTION (Sesuai Desain Konsisten Website) -->
        <section class="mt-16 sm:mt-20">
            <div class="rounded-3xl bg-slate-950 text-white p-8 sm:p-12 lg:p-16 relative overflow-hidden shadow-xl border border-slate-800 text-center">
                <!-- Decorative Glow Background -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-5">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mx-auto border border-emerald-500/30 shadow-2xs">
                        <i data-lucide="compass" class="w-6 h-6"></i>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-white tracking-tight">
                        Punya Kebutuhan Khusus atau Rencana Custom Trip?
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl mx-auto">
                        Diskusikan rute impian, sewa armada bus pariwisata, atau menu prasmanan gathering bersama tim lokal kami tanpa komitmen apa pun.
                    </p>
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3.5">
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20custom%20trip%20ke%20Pangandaran" 
                           target="_blank" 
                           class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Chat WhatsApp Tim Reservasi</span>
                        </a>
                        <a href="{{ route('packages.index') }}" 
                           class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 transition-all duration-300 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                            <i data-lucide="compass" class="w-4 h-4"></i>
                            <span>Lihat Katalog Paket Wisata</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- GLOBAL FOOTER -->
    @include('partials.footer')

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20estimasi%20biaya" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center"
       aria-label="Hubungi Kami via WhatsApp">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

    <!-- Page Specific Script for Advanced Calculator -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectPkg = document.getElementById('calc-page-package');
            const inputPax = document.getElementById('calc-page-pax');
            const btnPaxMinus = document.getElementById('btn-pax-minus');
            const btnPaxPlus = document.getElementById('btn-pax-plus');
            const quickPaxBtns = document.querySelectorAll('.btn-quick-pax');
            const paxIndicator = document.getElementById('pax-discount-indicator');

            const previewImg = document.getElementById('preview-pkg-img');
            const previewBadge = document.getElementById('preview-pkg-badge');
            const previewDuration = document.getElementById('preview-pkg-duration');
            const previewTitle = document.getElementById('preview-pkg-title');
            const previewLink = document.getElementById('preview-pkg-link');

            const inputDate = document.getElementById('calc-page-date');
            const inputName = document.getElementById('calc-page-name');
            const inputNotes = document.getElementById('calc-page-notes');
            const addonChecks = document.querySelectorAll('.calc-addon');
            const btnSend = document.getElementById('btn-calc-page-send');

            const summaryPkgName = document.getElementById('summary-pkg-name');
            const summaryPkgPrice = document.getElementById('summary-pkg-price');
            const summaryPax = document.getElementById('summary-pax');
            const summarySubtotal = document.getElementById('summary-subtotal');
            const summaryDiscountRow = document.getElementById('summary-discount-row');
            const summaryDiscount = document.getElementById('summary-discount');
            const summaryAddonRow = document.getElementById('summary-addon-row');
            const summaryAddon = document.getElementById('summary-addon');
            const summaryGrandTotal = document.getElementById('summary-grand-total');

            // Update live package preview
            function updatePackagePreview(opt) {
                if (!opt) return;
                const name = opt.getAttribute('data-name') || opt.text;
                const duration = opt.getAttribute('data-duration') || '1 Hari';
                const category = opt.getAttribute('data-category') || 'Wisata';
                const image = opt.getAttribute('data-image') || '';
                const url = opt.getAttribute('data-url') || '#';

                if (previewTitle) previewTitle.textContent = name;
                if (previewDuration) {
                    previewDuration.innerHTML = `<i data-lucide="clock" class="w-3 h-3 text-slate-400"></i><span>${duration}</span>`;
                }
                if (previewBadge) previewBadge.textContent = category;
                if (previewImg && image) previewImg.src = image;
                if (previewLink) previewLink.href = url;

                if (typeof lucide !== 'undefined') lucide.createIcons();
            }

            // Recalculate cost
            function recalculate() {
                if (!selectPkg || !inputPax) return;
                const opt = selectPkg.querySelector('option[value="' + selectPkg.value + '"]') || selectPkg.options[selectPkg.selectedIndex];
                const basePrice = parseInt(opt ? opt.getAttribute('data-price') || '0' : '0', 10);
                const pkgName = opt ? (opt.getAttribute('data-name') || opt.text) : 'Paket Wisata';
                
                let rawPax = parseInt(inputPax.value || '1', 10);
                if (isNaN(rawPax) || rawPax < 1) rawPax = 1;
                if (rawPax > 500) rawPax = 500;
                const pax = rawPax;

                updatePackagePreview(opt);

                const subtotal = basePrice * pax;

                let discountRate = 0;
                if (pax >= 10) {
                    discountRate = 0.15;
                    if (paxIndicator) {
                        paxIndicator.innerHTML = '<span class="inline-flex items-center gap-1.5"><i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-600"></i><span>Diskon Maksimal 15% Aktif</span></span>';
                        paxIndicator.className = 'text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 inline-flex items-center';
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    }
                } else if (pax >= 5) {
                    discountRate = 0.10;
                    if (paxIndicator) {
                        paxIndicator.innerHTML = '<span class="inline-flex items-center gap-1.5"><i data-lucide="tag" class="w-3.5 h-3.5 text-emerald-600"></i><span>Diskon 10% Aktif</span></span>';
                        paxIndicator.className = 'text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 inline-flex items-center';
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    }
                } else {
                    if (paxIndicator) {
                        paxIndicator.innerHTML = 'Harga Standar Regular';
                        paxIndicator.className = 'text-[11px] font-bold text-slate-500';
                    }
                }

                const discountAmount = Math.round(subtotal * discountRate);

                let addonTotal = 0;
                const activeAddons = [];
                addonChecks.forEach(chk => {
                    if (chk.checked) {
                        const cost = parseInt(chk.getAttribute('data-cost') || '0', 10);
                        const type = chk.getAttribute('data-type');
                        const itemTotal = (type === 'per_pax') ? (cost * pax) : cost;
                        addonTotal += itemTotal;
                        const labelEl = chk.closest('label').querySelector('.font-bold');
                        activeAddons.push({
                            label: labelEl ? labelEl.textContent.trim() : 'Layanan Tambahan',
                            total: itemTotal
                        });
                    }
                });

                const grandTotal = subtotal - discountAmount + addonTotal;

                if (summaryPkgName) summaryPkgName.textContent = pkgName;
                if (summaryPkgPrice) summaryPkgPrice.textContent = 'Rp ' + basePrice.toLocaleString('id-ID');
                if (summaryPax) summaryPax.textContent = pax + ' Orang';
                if (summarySubtotal) summarySubtotal.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

                if (discountAmount > 0) {
                    if (summaryDiscountRow) summaryDiscountRow.classList.remove('hidden');
                    if (summaryDiscount) summaryDiscount.textContent = '-Rp ' + discountAmount.toLocaleString('id-ID') + ' (' + (discountRate * 100) + '%)';
                } else {
                    if (summaryDiscountRow) summaryDiscountRow.classList.add('hidden');
                }

                if (addonTotal > 0) {
                    if (summaryAddonRow) summaryAddonRow.classList.remove('hidden');
                    if (summaryAddon) summaryAddon.textContent = '+Rp ' + addonTotal.toLocaleString('id-ID');
                } else {
                    if (summaryAddonRow) summaryAddonRow.classList.add('hidden');
                }

                if (summaryGrandTotal) summaryGrandTotal.textContent = 'Rp ' + (isNaN(grandTotal) ? 0 : grandTotal).toLocaleString('id-ID');

                return { pkgName, pax, grandTotal, discountAmount, activeAddons };
            }

            // Event Listeners
            if (selectPkg) selectPkg.addEventListener('change', recalculate);

            // Stepper buttons
            if (btnPaxMinus && inputPax) {
                btnPaxMinus.addEventListener('click', () => {
                    let cur = parseInt(inputPax.value, 10) || 1;
                    if (cur > 1) {
                        inputPax.value = cur - 1;
                        recalculate();
                    }
                });
            }
            if (btnPaxPlus && inputPax) {
                btnPaxPlus.addEventListener('click', () => {
                    let cur = parseInt(inputPax.value, 10) || 1;
                    if (cur < 500) {
                        inputPax.value = cur + 1;
                        recalculate();
                    }
                });
            }

            // Quick pills
            quickPaxBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const targetPax = parseInt(btn.getAttribute('data-pax'), 10);
                    if (targetPax && inputPax) {
                        inputPax.value = targetPax;
                        recalculate();
                    }
                });
            });

            // Prevent letters or invalid chars on pax input
            if (inputPax) {
                inputPax.addEventListener('keydown', (e) => {
                    if (['e', 'E', '+', '-', '.'].includes(e.key)) {
                        e.preventDefault();
                    }
                });
                inputPax.addEventListener('input', () => {
                    inputPax.value = inputPax.value.replace(/[^0-9]/g, '');
                    recalculate();
                });
                inputPax.addEventListener('blur', () => {
                    let pax = parseInt(inputPax.value, 10);
                    if (isNaN(pax) || pax < 1) inputPax.value = 1;
                    else if (pax > 500) inputPax.value = 500;
                    recalculate();
                });
            }

            if (inputDate) {
                inputDate.addEventListener('change', () => {
                    const today = new Date().toISOString().split('T')[0];
                    if (inputDate.value && inputDate.value < today) {
                        inputDate.value = today;
                        alert('Tanggal trip tidak boleh di masa lalu. Tanggal telah otomatis disesuaikan ke hari ini.');
                    }
                });
            }

            addonChecks.forEach(chk => chk.addEventListener('change', recalculate));

            // Initial calculation
            recalculate();

            // WhatsApp send button
            if (btnSend) {
                btnSend.addEventListener('click', () => {
                    const data = recalculate();
                    const name = inputName && inputName.value.trim() ? inputName.value.trim() : 'Wisatawan';

                    const today = new Date().toISOString().split('T')[0];
                    const altDate = inputDate?.parentElement?.querySelector('.flatpickr-input[type="text"]');
                    let date = altDate && altDate.value ? altDate.value : (inputDate && inputDate.value ? inputDate.value : 'Belum ditentukan');
                    if (inputDate && inputDate.value && inputDate.value < today) {
                        date = today;
                        inputDate.value = today;
                    }

                    const notes = inputNotes && inputNotes.value.trim() ? inputNotes.value.trim() : '-';

                    let msg = `Halo Admin Puja Tour & Travel Pangandaran,\n\n`;
                    msg += `Perkenalkan saya *${name}*, ingin konsultasi & booking berdasarkan simulasi kalkulator website:\n\n`;
                    msg += `*Detail Rencana Liburan:*\n`;
                    msg += `• *Nama Pemesan:* ${name}\n`;
                    msg += `• *Paket Pilihan:* ${data.pkgName}\n`;
                    msg += `• *Jumlah Peserta:* ${data.pax} Orang\n`;
                    msg += `• *Rencana Tanggal:* ${date}\n`;
                    if (data.activeAddons && data.activeAddons.length > 0) {
                        msg += `• *Layanan Tambahan:*\n`;
                        data.activeAddons.forEach(a => {
                            msg += `   - ${a.label} (+Rp ${a.total.toLocaleString('id-ID')})\n`;
                        });
                    }
                    if (data.discountAmount > 0) {
                        msg += `• *Potongan Diskon:* -Rp ${data.discountAmount.toLocaleString('id-ID')}\n`;
                    }
                    msg += `• *Estimasi Total Akhir:* Rp ${data.grandTotal.toLocaleString('id-ID')}\n`;
                    if (notes !== '-') {
                        msg += `• *Catatan Tambahan:* ${notes}\n`;
                    }
                    msg += `\nMohon konfirmasi ketersediaan jadwal, penawaran resmi, dan instruksi booking. Terima kasih!`;

                    const waNum = btnSend.getAttribute('data-whatsapp') || '6281234567890';
                    window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(msg)}`, '_blank');
                });
            }

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>
