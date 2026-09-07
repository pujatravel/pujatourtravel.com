<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puja Tour & Travel Pangandaran — Jelajahi Pesona Bahari & Petualangan Green Canyon</title>
    <meta name="description" content="Puja Tour & Travel Pangandaran menyediakan paket wisata eksklusif, body rafting Green Canyon, snorkeling Pasir Putih, dan petualangan alam terbaik bersama pemandu lokal berlisensi resmi.">
    <meta name="keywords" content="Puja Tour Travel, Wisata Pangandaran, Paket Wisata Pangandaran, Body Rafting Green Canyon, Pasir Putih Pangandaran, Batu Karas, Tour Guide Pangandaran">

    <!-- Open Graph / Meta Sosial -->
    <meta property="og:title" content="Puja Tour & Travel Pangandaran — Petualangan Alam & Bahari Terbaik">
    <meta property="og:description" content="Paket liburan Pangandaran terlengkap, legalitas resmi CV, pemandu bersertifikasi HPI, dan jaminan kenyamanan liburan Anda.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:type" content="website">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-sand-50 text-slate-800 antialiased selection:bg-ocean-500 selection:text-white">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
        $opHours = $settings['operational_hours'] ?? 'Setiap Hari: 06.00 - 21.00 WIB';
        $igUrl = $settings['instagram_url'] ?? 'https://instagram.com/pujatourtravel';
        $tiktokUrl = $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel';
    @endphp

    <!-- 1. TOP ANNOUNCEMENT BAR -->
    <div class="bg-gradient-to-r from-ocean-900 via-ocean-800 to-lagoon-800 text-white text-xs sm:text-sm py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-2 text-center sm:text-left">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-teak-500 text-slate-900 shadow-sm animate-pulse">
                    PROMO LIBURAN
                </span>
                <span class="text-slate-100 font-medium">Diskon s/d 15% untuk Rombongan & Paket Eksklusif Pangandaran!</span>
            </div>
            <div class="flex items-center gap-4 text-xs">
                <a href="https://wa.me/{{ $waNum }}" target="_blank" class="flex items-center gap-1.5 text-cyan-200 hover:text-white transition">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67Z"/></svg>
                    <span>Hotline: {{ $phoneNum }}</span>
                </a>
                <span class="text-slate-400 hidden sm:inline">|</span>
                <span class="text-slate-200 hidden sm:inline">📍 Pangandaran, Jawa Barat</span>
            </div>
        </div>
    </div>

    <!-- 2. STICKY MODERN NAVBAR -->
    <header id="main-header" class="sticky top-0 z-40 w-full glass-nav border-b border-slate-200/80 transition-all duration-300 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="relative w-12 h-12 rounded-full overflow-hidden border-2 border-teak-500 shadow-md group-hover:scale-105 transition-transform duration-300 bg-white">
                    <img src="{{ asset('images/puja_logo.jpg') }}" alt="Logo Puja Tour & Travel" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-extrabold text-xl sm:text-2xl leading-tight tracking-tight text-slate-900 group-hover:text-ocean-600 transition">
                        PUJA<span class="text-teak-600 ml-1 font-bold">TOUR</span>
                    </span>
                    <span class="text-[10px] sm:text-xs tracking-widest font-bold text-lagoon-700 uppercase">
                        & Travel Pangandaran
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <nav class="hidden lg:flex items-center gap-8 font-medium text-slate-700 text-sm">
                <a href="#beranda" class="text-ocean-600 font-semibold hover:text-ocean-700 transition">Beranda</a>
                <a href="#paket" class="hover:text-ocean-600 transition">Paket Wisata</a>
                <a href="#destinasi" class="hover:text-ocean-600 transition">Destinasi</a>
                <a href="#keunggulan" class="hover:text-ocean-600 transition">Keunggulan</a>
                <a href="#galeri" class="hover:text-ocean-600 transition">Galeri</a>
                <a href="#testimoni" class="hover:text-ocean-600 transition">Ulasan</a>
                <a href="#faq" class="hover:text-ocean-600 transition">FAQ</a>
                <a href="#kontak" class="hover:text-ocean-600 transition">Kontak</a>
            </nav>

            <!-- Action Buttons -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Puja%20Tour%20%26%20Travel,%20saya%20ingin%20tanya%20info%20paket%20wisata%20Pangandaran" 
                   target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-lagoon-600/30 text-lagoon-800 bg-lagoon-50 hover:bg-lagoon-100 font-semibold text-sm transition shadow-sm">
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67Z"/></svg>
                    <span>Tanya CS</span>
                </a>
                <a href="#booking-section" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-ocean-600 via-ocean-700 to-lagoon-700 hover:from-ocean-700 hover:to-lagoon-800 text-white font-semibold text-sm transition shadow-glow-ocean hover:shadow-lg">
                    <span>Reservasi Trip</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" aria-label="Buka Menu Navigasi" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-slate-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </header>

    <!-- Mobile Drawer & Backdrop -->
    <div id="drawer-overlay" class="fixed inset-0 bg-slate-900/60 z-50 hidden opacity-0 transition-opacity duration-300"></div>
    <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-4/5 max-w-sm bg-white z-50 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col justify-between p-6">
        <div>
            <div class="flex items-center justify-between pb-6 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/puja_logo.jpg') }}" alt="Puja Tour" class="w-10 h-10 rounded-full border border-teak-500">
                    <span class="font-display font-extrabold text-lg text-slate-900">PUJA TOUR</span>
                </div>
                <button id="close-menu-btn" aria-label="Tutup Menu" class="p-2 text-slate-400 hover:text-slate-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <nav class="flex flex-col gap-4 py-6 font-semibold text-slate-700">
                <a href="#beranda" class="drawer-link hover:text-ocean-600 transition">Beranda</a>
                <a href="#paket" class="drawer-link hover:text-ocean-600 transition">Paket Wisata</a>
                <a href="#destinasi" class="drawer-link hover:text-ocean-600 transition">Destinasi Populer</a>
                <a href="#keunggulan" class="drawer-link hover:text-ocean-600 transition">Keunggulan Layanan</a>
                <a href="#galeri" class="drawer-link hover:text-ocean-600 transition">Galeri Wisata</a>
                <a href="#testimoni" class="drawer-link hover:text-ocean-600 transition">Ulasan Wisatawan</a>
                <a href="#faq" class="drawer-link hover:text-ocean-600 transition">Tanya Jawab (FAQ)</a>
                <a href="#kontak" class="drawer-link hover:text-ocean-600 transition">Kontak Kami</a>
            </nav>
        </div>
        <div class="flex flex-col gap-3 pt-6 border-t border-slate-100">
            <a href="https://wa.me/{{ $waNum }}" target="_blank" class="w-full py-3 rounded-xl bg-emerald-600 text-white font-bold text-center flex items-center justify-center gap-2 shadow-md">
                <span>Chat via WhatsApp</span>
            </a>
            <a href="#booking-section" class="drawer-link w-full py-3 rounded-xl bg-ocean-600 text-white font-bold text-center">
                <span>Reservasi Online</span>
            </a>
        </div>
    </div>

    <!-- 3. HERO SECTION (HIGH IMPACT) -->
    <section id="beranda" class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-ocean-950">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero_pangandaran.jpg') }}" alt="Pangandaran Ocean" class="w-full h-full object-cover object-center scale-105 animate-pulse duration-10000">
            <div class="absolute inset-0 bg-gradient-to-r from-ocean-950/90 via-ocean-950/75 to-slate-900/60"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-ocean-950 via-transparent to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 w-full">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left Content -->
                <div class="lg:col-span-7 text-center lg:text-left space-y-6">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-cyan-200 text-xs sm:text-sm font-semibold shadow-inner">
                        <span class="w-2 h-2 rounded-full bg-teak-400 animate-ping"></span>
                        <span>✨ Partner Resmi Wisata & Petualangan Pangandaran</span>
                    </div>

                    <!-- Main H1 Title -->
                    <h1 class="font-display font-extrabold text-4xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-[1.15]">
                        Jelajahi Pesona Bahari & Petualangan <span class="text-gradient-ocean">Pangandaran</span> Tak Terlupakan
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-base sm:text-lg text-slate-200 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                        Nikmati sensasi seru Body Rafting Green Canyon, panorama eksotis Pasir Putih, dan pesona bahari terbaik bersama pemandu lokal profesional tersertifikasi HPI. Liburan aman, nyaman, dan berkesan!
                    </p>

                    <!-- Trust Stats Counter -->
                    <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/15 max-w-lg mx-auto lg:mx-0 text-white">
                        <div>
                            <div class="font-display font-bold text-2xl sm:text-3xl text-teak-400">5.000+</div>
                            <div class="text-xs text-slate-300">Wisatawan Puas</div>
                        </div>
                        <div>
                            <div class="font-display font-bold text-2xl sm:text-3xl text-cyan-400">100%</div>
                            <div class="text-xs text-slate-300">Pemandu Berlisensi</div>
                        </div>
                        <div>
                            <div class="font-display font-bold text-2xl sm:text-3xl text-emerald-400">4.9/5 ⭐</div>
                            <div class="text-xs text-slate-300">Ulasan Google</div>
                        </div>
                    </div>

                    <!-- Call To Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#paket" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-teak-500 via-teak-600 to-amber-600 hover:from-teak-600 hover:to-amber-700 text-white font-bold text-base shadow-glow-teak hover:scale-105 transition-all flex items-center justify-center gap-2">
                            <span>Jelajahi Paket Wisata</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl glass-dark border border-white/20 hover:bg-white/20 text-white font-semibold text-base transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67Z"/></svg>
                            <span>Konsultasi WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Right: Quick Trip Finder Widget (Dynamic Select Options) -->
                <div class="lg:col-span-5">
                    <div class="glass-card bg-white/95 rounded-3xl p-6 sm:p-8 shadow-2xl border border-white/60 text-slate-800">
                        <div class="flex items-center gap-3 pb-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-ocean-100 text-ocean-700 flex items-center justify-center font-bold text-xl">
                                🧭
                            </div>
                            <div>
                                <h2 class="font-display font-bold text-lg text-slate-900 leading-snug">Rencanakan Trip Anda</h2>
                                <p class="text-xs text-slate-500">Kalkulasi estimasi harga instan & ketersediaan</p>
                            </div>
                        </div>

                        <form class="space-y-4 pt-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Pilih Paket Wisata</label>
                                <div class="relative">
                                    <select id="calc-package" class="w-full pl-3.5 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 font-medium text-sm focus:bg-white focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition outline-none">
                                        @foreach($packages as $pkg)
                                            <option value="{{ $pkg->slug }}" data-price="{{ (int) $pkg->price }}">
                                                {{ $pkg->name }} ({{ $pkg->formatted_price }} / {{ $pkg->price_unit }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Jumlah Peserta</label>
                                    <input type="number" id="calc-pax" min="1" max="200" value="4" class="w-full px-3.5 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 font-bold text-sm focus:bg-white focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Rencana Tanggal</label>
                                    <input type="date" id="calc-date" class="w-full px-3 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 font-medium text-sm focus:bg-white focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition outline-none">
                                </div>
                            </div>

                            <!-- Calculation Result Box -->
                            <div class="p-4 rounded-2xl bg-gradient-to-br from-ocean-50 to-lagoon-50 border border-ocean-100/80 flex items-center justify-between">
                                <div>
                                    <span class="text-xs font-medium text-slate-500 block">Estimasi Total Biaya</span>
                                    <span class="text-[10px] text-emerald-700 font-semibold bg-emerald-100 px-2 py-0.5 rounded-full inline-block mt-0.5">Termasuk Pemandu & Alat</span>
                                </div>
                                <div class="text-right">
                                    <span id="calc-total-display" class="font-display font-extrabold text-xl sm:text-2xl text-ocean-700">Rp 900.000</span>
                                </div>
                            </div>

                            <!-- Quick Action Button -->
                            <button type="button" id="btn-order-whatsapp" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67Z"/></svg>
                                <span>Kirim & Booking via WhatsApp</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. TRUST ELEMENTS / 4 PILAR KREDIBILITAS -->
    <section class="relative -mt-10 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100 flex items-start gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-ocean-100 text-ocean-600 flex items-center justify-center shrink-0 text-2xl">
                    🏛️
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Legalitas Usaha Resmi</h3>
                    <p class="text-xs text-slate-500 mt-1">Berbadan hukum CV resmi, terpercaya, dan amanah untuk corporate maupun keluarga.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100 flex items-start gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-lagoon-100 text-lagoon-600 flex items-center justify-center shrink-0 text-2xl">
                    🎖️
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Pemandu Lisensi HPI</h3>
                    <p class="text-xs text-slate-500 mt-1">Guide lokal berpengalaman, ramah, dan bersertifikat resmi kepemanduan wisata.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100 flex items-start gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-teak-100 text-teak-600 flex items-center justify-center shrink-0 text-2xl">
                    🦺
                </div>
                <div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Standar Safety Teruji</h3>
                    <p class="text-xs text-slate-500 mt-1">Perlengkapan lifejacket, helmet, dan asuransi kecelakaan diri di setiap trip.</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100 flex items-start gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 text-2xl">
                    💎
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
            <span class="text-xs font-extrabold uppercase tracking-widest text-ocean-600 bg-ocean-50 px-3 py-1 rounded-full border border-ocean-200">
                Katalog Pilihan
            </span>
            <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-3 tracking-tight">
                Paket Wisata Favorit Pangandaran
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Pilih paket perjalanan impian Anda, mulai dari petualangan body rafting Green Canyon hingga paket eksklusif keluarga & corporate gathering.
            </p>

            <!-- Dynamic Category Filter Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mt-8">
                <button class="package-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition bg-ocean-600 text-white shadow-md shadow-ocean-600/30" data-category="all">
                    Semua Paket
                </button>
                @foreach($categories as $cat)
                    <button class="package-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition bg-white text-slate-600 hover:bg-slate-100 border border-slate-200" data-category="{{ $cat->slug }}">
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Dynamic Package Grid from Database -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($packages as $pkg)
                <div class="package-card flex flex-col bg-white rounded-3xl overflow-hidden shadow-soft hover:shadow-card-hover transition-all duration-300 border border-slate-100 group" data-category="{{ $pkg->category->slug ?? 'all' }}">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $pkg->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 left-4">
                            @if($pkg->featured)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-teak-500 text-slate-900 shadow-sm">
                                    ⭐ Rekomendasi
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-ocean-600 text-white shadow-sm">
                                    {{ $pkg->category->name ?? 'Wisata' }}
                                </span>
                            @endif
                        </div>
                        @if($pkg->duration)
                            <div class="absolute bottom-4 right-4">
                                <span class="px-3 py-1 rounded-xl text-xs font-bold bg-slate-900/80 text-cyan-300 backdrop-blur-md">
                                    ⏱️ {{ $pkg->duration }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs font-semibold text-ocean-600 mb-1">
                                <span>📍 {{ $pkg->location ?? 'Pangandaran' }}</span>
                            </div>
                            <h3 class="font-display font-bold text-xl text-slate-900 group-hover:text-ocean-600 transition">
                                {{ $pkg->name }}
                            </h3>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                {{ $pkg->short_description ?? 'Petualangan eksotis bersama Puja Tour & Travel Pangandaran.' }}
                            </p>

                            <!-- Facilities Badge -->
                            @if(is_array($pkg->inclusions) && count($pkg->inclusions) > 0)
                                <div class="flex flex-wrap gap-1.5 mt-4">
                                    @foreach(array_slice($pkg->inclusions, 0, 4) as $inc)
                                        <span class="text-[11px] bg-slate-100 text-slate-700 px-2 py-0.5 rounded-md">✓ {{ $inc }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="pt-5 mt-5 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-400 block font-medium">Mulai dari</span>
                                <span class="font-display font-bold text-xl text-ocean-600">{{ $pkg->formatted_price }}</span>
                                <span class="text-xs text-slate-400">/ {{ $pkg->price_unit }}</span>
                            </div>
                            <button class="btn-view-package px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-ocean-600 text-white font-semibold text-xs transition"
                                    data-title="{{ $pkg->name }}"
                                    data-desc="{{ $pkg->description ?? $pkg->short_description }}"
                                    data-price="{{ $pkg->formatted_price }} / {{ $pkg->price_unit }}"
                                    data-duration="{{ $pkg->duration ?? '-' }}"
                                    data-img="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}">
                                Lihat Detail
                            </button>
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
    </section>

    <!-- 6. DESTINASI IKONIK & PENGALAMAN (SHOWCASE) -->
    <section id="destinasi" class="py-20 bg-gradient-to-b from-slate-900 to-ocean-950 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-cyan-400 bg-cyan-950/80 px-3.5 py-1 rounded-full border border-cyan-800/80">
                        Destinasi Terbaik
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-white mt-3 tracking-tight">
                        Eksplorasi Keajaiban Alam Pangandaran
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base mt-2 max-w-xl">
                        Kombinasi sempurna antara ngarai air tawar tropis, pantai pasir putih, ombak selancar kelas dunia, dan kuliner pesisir otentik.
                    </p>
                </div>
                <a href="#booking-section" class="inline-flex items-center gap-2 text-cyan-300 hover:text-white font-semibold text-sm transition">
                    <span>Konsultasikan Rute Custom</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <!-- Destination Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 relative h-80 rounded-3xl overflow-hidden group shadow-lg">
                    <img src="{{ asset('images/greencanyon.jpg') }}" alt="Green Canyon Cukang Taneuh" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="text-xs font-bold text-emerald-300 bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-700/50">Ngarai Tropis Ikonik</span>
                        <h3 class="font-display font-bold text-2xl text-white mt-2">Green Canyon (Cukang Taneuh)</h3>
                        <p class="text-xs text-slate-300 mt-1 max-w-md">Air zamrud berkilau di antara tebing stalaktit purba berusia jutaan tahun dengan pemandangan alami yang menenangkan.</p>
                    </div>
                </div>

                <div class="relative h-80 rounded-3xl overflow-hidden group shadow-lg">
                    <img src="{{ asset('images/pasir_putih.jpg') }}" alt="Pasir Putih & Snorkeling" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="text-xs font-bold text-cyan-300 bg-cyan-950/80 px-3 py-1 rounded-full border border-cyan-700/50">Taman Laut Terumbu Karang</span>
                        <h3 class="font-display font-bold text-xl text-white mt-2">Pantai Pasir Putih</h3>
                        <p class="text-xs text-slate-300 mt-1">Snorkeling bersama ratusan ikan karang tropis di air laut yang jernih dan tenang.</p>
                    </div>
                </div>

                <div class="relative h-80 rounded-3xl overflow-hidden group shadow-lg">
                    <img src="{{ asset('images/sunset_batu_karas.jpg') }}" alt="Sunset Batu Karas" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="text-xs font-bold text-amber-300 bg-amber-950/80 px-3 py-1 rounded-full border border-amber-700/50">Surfing & Golden Sunset</span>
                        <h3 class="font-display font-bold text-xl text-white mt-2">Pantai Batu Karas</h3>
                        <p class="text-xs text-slate-300 mt-1">Titik sunset terindah di Jawa Barat dengan suasana santai dan deretan cafe kayu estetik.</p>
                    </div>
                </div>

                <div class="md:col-span-2 relative h-80 rounded-3xl overflow-hidden group shadow-lg">
                    <img src="{{ asset('images/cagar_alam.jpg') }}" alt="Cagar Alam Pananjung" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="text-xs font-bold text-emerald-300 bg-emerald-950/80 px-3 py-1 rounded-full border border-emerald-700/50">Hutan Lindung & Satwa Asli</span>
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
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ asset('images/greencanyon.jpg') }}" alt="Puja Tour Experience" class="w-full h-[450px] object-cover">
                </div>
                <!-- Floating Card -->
                <div class="absolute -bottom-6 -right-6 glass-card bg-white/95 rounded-2xl p-5 shadow-xl border border-white max-w-xs hidden sm:block">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-teak-100 text-teak-600 flex items-center justify-center font-bold text-2xl">
                            🏆
                        </div>
                        <div>
                            <div class="font-display font-bold text-slate-900 text-base">Top Rated Tour</div>
                            <div class="text-xs text-slate-500">Pilihan #1 Wisatawan di Pangandaran</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-bold uppercase tracking-widest text-teak-700 bg-teak-100 px-3.5 py-1 rounded-full border border-teak-200">
                    Nilai Keunggulan Kami
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
                    Mengapa Wisatawan Memilih <span class="text-ocean-600">Puja Tour & Travel</span>?
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Kami bukan sekadar agen perjalanan umum. Kami adalah putra daerah asli Pangandaran yang berdedikasi menghadirkan petualangan autentik dengan standar keselamatan tertinggi, keramahan khas Sunda, dan harga transparan.
                </p>

                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white shadow-sm border border-slate-100 hover:border-ocean-300 transition">
                        <div class="w-10 h-10 rounded-xl bg-ocean-100 text-ocean-600 flex items-center justify-center shrink-0 font-bold">
                            01
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 text-base">Pemandu Lokal Berlisensi Resmi HPI</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Memahami setiap sudut rahasia, arus sungai yang aman, dan spot foto terbaik yang jarang diketahui turis biasa.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white shadow-sm border border-slate-100 hover:border-lagoon-300 transition">
                        <div class="w-10 h-10 rounded-xl bg-lagoon-100 text-lagoon-600 flex items-center justify-center shrink-0 font-bold">
                            02
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 text-base">Safety First & Perlengkapan Standar Internasional</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Semua perlengkapan pelampung, helm, dan asuransi kecelakaan selalu diperiksa secara berkala sebelum trip.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white shadow-sm border border-slate-100 hover:border-teak-300 transition">
                        <div class="w-10 h-10 rounded-xl bg-teak-100 text-teak-600 flex items-center justify-center shrink-0 font-bold">
                            03
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-slate-900 text-base">Dokumentasi HD & Drone Eksklusif</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Abadikan momen petualangan Anda dengan foto underwater dan video drone sinematik tanpa ribet bawa kamera sendiri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. GALERI DOKUMENTASI AKTIVITAS (MASONRY WITH DYNAMIC GALLERIES) -->
    <section id="galeri" class="py-20 bg-sand-100/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-ocean-600 bg-ocean-50 px-3 py-1 rounded-full border border-ocean-200">
                    Dokumentasi Asli
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 mt-3 tracking-tight">
                    Momen Keseruan Wisatawan Bersama Puja
                </h2>
                <p class="text-slate-600 text-sm mt-2">
                    Foto-foto riil kebahagiaan wisatawan dan indahnya pesona Pangandaran. Klik gambar untuk melihat resolusi penuh!
                </p>
            </div>

            <!-- Dynamic Galleries Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($galleries as $gal)
                    <div class="gallery-item cursor-pointer group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition"
                         data-img="{{ $gal->image_url }}"
                         data-caption="{{ $gal->title }} - {{ $gal->caption }}">
                        <img src="{{ $gal->image_url }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/80 text-slate-900 flex items-center justify-center font-bold">🔍</span>
                        </div>
                    </div>
                @empty
                    <p class="col-span-4 text-center py-8 text-slate-400">Belum ada foto galeri.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 9. ULASAN & TESTIMONIAL PELANGGAN (DYNAMIC TESTIMONIALS) -->
    <section id="testimoni" class="py-20 lg:py-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full border border-emerald-200">
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
                <div class="bg-white rounded-3xl p-8 shadow-soft border border-slate-100 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="flex items-center text-amber-400 gap-1 text-sm mb-4">
                            {{ str_repeat('⭐', $testi->rating) }}
                        </div>
                        <p class="text-slate-700 text-sm italic leading-relaxed">
                            "{{ $testi->review_text }}"
                        </p>
                    </div>
                    <div class="flex items-center gap-4 pt-6 mt-6 border-t border-slate-100">
                        <div class="w-12 h-12 rounded-full bg-ocean-100 text-ocean-700 flex items-center justify-center font-bold font-display text-lg">
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

    <!-- 10. INTERACTIVE RESERVATION FORM / TRIP PLANNER -->
    <section id="booking-section" class="py-20 bg-gradient-to-br from-ocean-900 via-ocean-950 to-slate-950 text-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-cyan-300 bg-cyan-950/80 px-3.5 py-1 rounded-full border border-cyan-800">
                    Formulir Reservasi Cepat
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-white mt-3 tracking-tight">
                    Wujudkan Liburan Impian Anda ke Pangandaran
                </h2>
                <p class="text-slate-300 text-sm mt-2 max-w-xl mx-auto">
                    Isi formulir di bawah ini untuk konsultasi jadwal, custom itinerary, atau langsung terhubung dengan admin via WhatsApp.
                </p>
            </div>

            <div class="glass-card bg-white/95 rounded-3xl p-6 sm:p-10 shadow-2xl text-slate-800 border border-white/60">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Lengkap *</label>
                            <input type="text" id="calc-name" placeholder="Contoh: Budi Santoso" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor WhatsApp Aktif *</label>
                            <input type="tel" id="calc-phone" placeholder="Contoh: 08123456789" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Catatan Khusus / Kustomisasi Rute</label>
                        <textarea id="calc-note" rows="3" placeholder="Tuliskan permintaan khusus (misal: butuh penjemputan stasiun, menu vegetarian, ada peserta lansia/anak)..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-ocean-500 focus:border-ocean-500 transition outline-none"></textarea>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3 text-xs text-slate-500">
                            <span class="text-xl">🔒</span>
                            <span>Data Anda aman & langsung terhubung ke WhatsApp resmi Puja Tour.</span>
                        </div>
                        <button type="button" onclick="document.getElementById('btn-order-whatsapp').click()" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                            <span>Kirim Permintaan Trip</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- 11. FAQ (FREQUENTLY ASKED QUESTIONS) ACCORDION -->
    <section id="faq" class="py-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-ocean-600 bg-ocean-50 px-3 py-1 rounded-full border border-ocean-200">
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
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
                    <button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between font-display font-bold text-slate-900 text-base hover:text-ocean-600 transition">
                        <span>{{ $faq->question }}</span>
                        <svg class="faq-icon w-5 h-5 text-slate-400 transition-transform duration-300 {{ $index === 0 ? '' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="faq-content hidden px-6 pb-5 text-slate-600 text-xs sm:text-sm leading-relaxed border-t border-slate-100 pt-3">
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
    <section id="kontak" class="py-20 bg-sand-100/70 border-t border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-5 space-y-5">
                    <span class="text-xs font-bold uppercase tracking-widest text-ocean-700 bg-ocean-100 px-3 py-1 rounded-full">
                        Kantor Operasional
                    </span>
                    <h2 class="font-display font-extrabold text-3xl text-slate-900 tracking-tight">
                        Kunjungi Kami di Pangandaran
                    </h2>
                    <p class="text-slate-600 text-sm">
                        Kantor operasional kami siap menyambut Anda untuk konsultasi rute, titik kumpul trip, maupun penjemputan rombongan.
                    </p>

                    <div class="space-y-3 pt-2 text-sm text-slate-700">
                        <div class="flex items-start gap-3">
                            <span class="text-lg">📍</span>
                            <div>
                                <strong>Alamat Kantor:</strong>
                                <p class="text-xs text-slate-600">{{ $officeAddr }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-lg">📱</span>
                            <div>
                                <strong>WhatsApp & Hotline:</strong>
                                <p class="text-xs text-slate-600">{{ $phoneNum }} (Online 24 Jam)</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-lg">✉️</span>
                            <div>
                                <strong>Email Resmi:</strong>
                                <p class="text-xs text-slate-600">{{ $emailAddr }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-lg">⏰</span>
                            <div>
                                <strong>Jam Pelayanan:</strong>
                                <p class="text-xs text-slate-600">{{ $opHours }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-200 bg-slate-200 h-80 relative">
                        <iframe 
                            title="Lokasi Puja Tour Pangandaran"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.739775073105!2d108.6477546!3d-7.6974127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6598c19958348b%3A0x6b45f949c256ca61!2sPantai%20Pangandaran!5e0!3m2!1sid!2sid!4v1709800000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 13. GLOBAL FOOTER -->
    <footer class="bg-ocean-950 text-slate-400 text-xs py-14 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/puja_logo.jpg') }}" alt="Puja Tour Travel" class="w-12 h-12 rounded-full border-2 border-teak-500">
                        <div>
                            <span class="font-display font-extrabold text-xl text-white block">{{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN' }}</span>
                            <span class="text-[10px] text-cyan-400 tracking-widest uppercase font-bold">Pangandaran Destination Specialist</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                        Mitra terpercaya liburan dan petualangan di Pangandaran. Berbadan hukum resmi CV dengan pemandu lokal bersertifikat HPI dan standar keselamatan teruji.
                    </p>
                    <div class="flex items-center gap-3 pt-2 text-slate-300">
                        <a href="{{ $igUrl }}" target="_blank" aria-label="Instagram" class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center hover:bg-ocean-600 transition">📷</a>
                        <a href="{{ $tiktokUrl }}" target="_blank" aria-label="TikTok" class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center hover:bg-ocean-600 transition">🎵</a>
                        <a href="#" aria-label="Facebook" class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center hover:bg-ocean-600 transition">📘</a>
                        <a href="#" aria-label="YouTube" class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center hover:bg-ocean-600 transition">▶️</a>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-4">Navigasi</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#beranda" class="hover:text-cyan-300 transition">Beranda</a></li>
                        <li><a href="#paket" class="hover:text-cyan-300 transition">Paket Wisata</a></li>
                        <li><a href="#destinasi" class="hover:text-cyan-300 transition">Destinasi Populer</a></li>
                        <li><a href="#keunggulan" class="hover:text-cyan-300 transition">Keunggulan Layanan</a></li>
                        <li><a href="#galeri" class="hover:text-cyan-300 transition">Galeri Foto</a></li>
                        <li><a href="#testimoni" class="hover:text-cyan-300 transition">Ulasan Wisatawan</a></li>
                    </ul>
                </div>

                <!-- Col 3: Paket Populer (Dynamic) -->
                <div>
                    <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-4">Paket Favorit</h4>
                    <ul class="space-y-2.5">
                        @foreach($packages->take(5) as $fp)
                            <li><a href="#paket" class="hover:text-cyan-300 transition">{{ $fp->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 4: Metode Pembayaran -->
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
                    <a href="{{ route('admin.login') }}" class="hover:text-cyan-400 font-bold text-slate-400">🔒 Login Admin CMS</a>
                    <span>•</span>
                    <a href="#" class="hover:text-slate-400">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- 14. FLOATING WHATSAPP BUTTON (PULSE ANIMATION) -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour%20%26%20Travel,%20saya%20ingin%20tanya%20info%20paket%20wisata%20Pangandaran" 
       target="_blank" 
       aria-label="Hubungi WhatsApp Puja Tour"
       class="fixed bottom-6 right-6 z-40 bg-emerald-500 hover:bg-emerald-600 text-white p-3.5 sm:p-4 rounded-full shadow-2xl hover:scale-110 transition-all duration-300 flex items-center justify-center group">
        <span class="absolute -top-10 right-0 bg-slate-900 text-white text-[11px] font-bold px-3 py-1 rounded-xl shadow-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition duration-200 pointer-events-none">
            💬 Tanya Admin Langsung
        </span>
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67Z"/></svg>
    </a>

    <!-- 15. GALLERY LIGHTBOX MODAL -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-slate-950/90 hidden items-center justify-center p-4 backdrop-blur-md">
        <button id="lightbox-close" aria-label="Tutup Galeri" class="absolute top-6 right-6 text-white/80 hover:text-white p-2 rounded-full bg-white/10 hover:bg-white/20 transition">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="max-w-4xl max-h-[85vh] flex flex-col items-center">
            <img id="lightbox-image" src="" alt="Galeri Preview" class="max-w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl">
            <p id="lightbox-caption" class="text-slate-200 text-sm mt-4 font-medium text-center"></p>
        </div>
    </div>

    <!-- 16. QUICK PACKAGE DETAIL MODAL -->
    <div id="package-modal" class="fixed inset-0 z-50 bg-slate-950/80 hidden items-center justify-center p-4 backdrop-blur-md">
        <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-white/40 flex flex-col">
            <div class="relative h-56 bg-slate-900">
                <img id="package-modal-img" src="" alt="Package Detail" class="w-full h-full object-cover">
                <button id="package-modal-close" aria-label="Tutup Modal" class="absolute top-4 right-4 text-white bg-slate-950/60 hover:bg-slate-950 p-2 rounded-full transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span id="package-modal-duration" class="px-3 py-1 rounded-xl text-xs font-bold bg-ocean-100 text-ocean-700"></span>
                    <span id="package-modal-price" class="font-display font-extrabold text-xl text-ocean-600"></span>
                </div>
                <h3 id="package-modal-title" class="font-display font-bold text-2xl text-slate-900 leading-snug"></h3>
                <p id="package-modal-desc" class="text-xs sm:text-sm text-slate-600 leading-relaxed"></p>
                
                <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                    <a id="package-modal-wa" href="#" target="_blank" class="flex-1 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm text-center transition flex items-center justify-center gap-2 shadow-md">
                        <span>Pesan via WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
