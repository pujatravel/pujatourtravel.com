<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Galeri Dokumentasi Wisata Pangandaran — Puja Tour & Travel</title>
    <meta name="description" content="Koleksi foto dan dokumentasi kegiatan body rafting Green Canyon, snorkeling Pasir Putih, pantai Batu Karas, dan keindahan alam Pangandaran.">
    <meta name="keywords" content="galeri wisata Pangandaran, foto body rafting Green Canyon, dokumentasi snorkeling Pasir Putih, foto Batu Karas, galeri Puja Tour">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Galeri Dokumentasi Wisata Pangandaran — Puja Tour & Travel">
    <meta property="og:description" content="Koleksi foto dan dokumentasi kegiatan body rafting Green Canyon, snorkeling Pasir Putih, pantai Batu Karas, dan keindahan alam Pangandaran.">
    <meta property="og:image" content="{{ asset('images/cagar_alam.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Galeri Dokumentasi Wisata Pangandaran — Puja Tour & Travel">
    <meta name="twitter:description" content="Koleksi foto dan dokumentasi kegiatan body rafting Green Canyon, snorkeling Pasir Putih, pantai Batu Karas, dan keindahan alam Pangandaran.">
    <meta name="twitter:image" content="{{ asset('images/cagar_alam.jpg') }}">

    <!-- Structured Data (JSON-LD): ImageGallery — helps Google Images -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ImageGallery',
        'name' => 'Galeri Dokumentasi Wisata Pangandaran — Puja Tour & Travel',
        'description' => 'Koleksi foto dan dokumentasi kegiatan body rafting Green Canyon, snorkeling Pasir Putih, pantai Batu Karas, dan keindahan alam Pangandaran.',
        'url' => url()->current(),
        'publisher' => [
            '@type' => 'TravelAgency',
            'name' => 'Puja Tour Travel',
            'url' => url('/'),
            'logo' => asset('images/puja_logo.png'),
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
                'name' => 'Galeri',
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
    </style>

    @include('partials.analytics')
</head>
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white pt-20 sm:pt-24">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
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
            <span class="text-slate-900 font-semibold">Galeri Dokumentasi</span>
        </nav>
    </div>

    <!-- MAIN GALLERY CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-20">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                Dokumentasi Lapangan
            </span>
            <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 mt-3 tracking-tight">
                Galeri Petualangan Pangandaran
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Setiap momen petualangan Anda bersama pemandu kami diabadikan dengan hasil foto jernih & video berkesan. Klik foto untuk melihat tampilan penuh.
            </p>

            <!-- Social Channel Buttons -->
            <div class="flex items-center justify-center gap-3 mt-6">
                <a href="{{ $igUrl }}" target="_blank" class="px-4 py-2 rounded-xl bg-white border border-neutral-200 text-slate-700 hover:text-pink-600 hover:border-pink-300 text-xs font-semibold transition flex items-center gap-2 shadow-xs">
                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                    </svg>
                    <span>Instagram @puja_tourtravel</span>
                </a>
                <a href="{{ $tiktokUrl }}" target="_blank" class="px-4 py-2 rounded-xl bg-white border border-neutral-200 text-slate-700 hover:text-slate-900 hover:border-slate-400 text-xs font-semibold transition flex items-center gap-2 shadow-xs">
                    <svg class="w-4 h-4 text-slate-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.298-.002.595.042.88.13V9.4a6.33 6.33 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.66a6.34 6.34 0 0 0 10.82 4.49 6.27 6.27 0 0 0 1.89-4.49V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-.9-.07z"/>
                    </svg>
                    <span>TikTok Resmi</span>
                </a>
            </div>
        </div>

        <!-- Dynamic Photo Bento Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($galleries as $gal)
                <div class="gallery-item group relative h-72 rounded-3xl overflow-hidden cursor-pointer shadow-soft border border-neutral-200 bg-slate-900"
                     data-img="{{ $gal->image_url }}"
                     data-caption="{{ $gal->caption ?? $gal->title }}">
                    <img src="{{ $gal->image_url }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-80 group-hover:opacity-100 transition"></div>
                    
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-900/80 backdrop-blur-md text-emerald-400 border border-white/10">
                            {{ $gal->category ?? 'Wisata' }}
                        </span>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h3 class="font-display font-bold text-sm leading-snug">{{ $gal->title }}</h3>
                        @if($gal->caption)
                            <p class="text-[11px] text-slate-300 mt-1 line-clamp-1">{{ $gal->caption }}</p>
                        @endif
                    </div>

                    <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-emerald-700/80 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i data-lucide="zoom-in" class="w-4 h-4"></i>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-16 bg-surface-soft rounded-3xl border border-neutral-200 text-slate-500">
                    Belum ada foto galeri yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </main>

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
                <p>© {{ date('Y') }} {{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN' }}. All rights reserved.</p>
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

    <!-- LIGHTBOX MODAL WITH FULL SLIDER CAROUSEL -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-slate-950/95 backdrop-blur-md hidden items-center justify-center p-3 sm:p-6 select-none" role="dialog" aria-modal="true" aria-label="Galeri Foto Wisata">
        <!-- Top Controls Bar -->
        <div class="absolute top-3 left-3 right-3 sm:top-6 sm:left-6 sm:right-6 z-30 flex items-center justify-between gap-2 pointer-events-none">
            <!-- Left Info Badges -->
            <div class="flex items-center gap-1.5 sm:gap-3 pointer-events-auto min-w-0 shrink">
                <div class="px-2.5 py-1.5 sm:px-3.5 sm:py-1.5 rounded-full bg-slate-900/90 border border-white/20 backdrop-blur-md flex items-center gap-1.5 sm:gap-2 shadow-lg min-w-0">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                    <span id="lightbox-title" class="text-xs sm:text-sm font-bold text-white max-w-[90px] xs:max-w-[140px] sm:max-w-xs md:max-w-md truncate">Dokumentasi Wisatawan</span>
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
                <a id="lightbox-wa-link" href="#" target="_blank" data-whatsapp="{{ $waNum }}" class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-md">
                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                    <span>Tanya via WhatsApp</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20tertarik%20dengan%20foto%20wisatanya" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

</body>
</html>
