<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Ulasan & Testimonial Wisatawan — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="Cerita dan testimoni nyata dari para wisatawan yang telah menikmati liburan seru di Pangandaran bersama Puja Tour & Travel.">
    <meta name="keywords" content="testimoni Puja Tour, ulasan wisata Pangandaran, review body rafting Green Canyon, pengalaman wisatawan Pangandaran, rating tour guide">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Ulasan & Testimonial Wisatawan — Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Cerita dan testimoni nyata dari para wisatawan yang telah menikmati liburan seru di Pangandaran bersama Puja Tour & Travel.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ulasan & Testimonial Wisatawan — Puja Tour & Travel Pangandaran">
    <meta name="twitter:description" content="Cerita dan testimoni nyata dari para wisatawan yang telah menikmati liburan seru di Pangandaran bersama Puja Tour & Travel.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): TravelAgency with AggregateRating — enables Google star ratings -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => 'Puja Tour Travel',
        'url' => url('/'),
        'description' => 'Biro perjalanan wisata resmi di Pangandaran yang menyediakan paket tur Green Canyon, body rafting, dan wisata bahari.',
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => number_format($averageRating, 1),
            'bestRating' => '5',
            'worstRating' => '1',
            'reviewCount' => $testimonials->count(),
        ],
        'review' => $testimonials->take(5)->map(function ($t) {
            return [
                '@type' => 'Review',
                'author' => [
                    '@type' => 'Person',
                    'name' => $t->customer_name,
                ],
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => $t->rating,
                    'bestRating' => '5',
                ],
                'reviewBody' => $t->review_text,
                'datePublished' => $t->trip_date ? $t->trip_date->toDateString() : $t->created_at->toDateString(),
            ];
        })->values()->toArray(),
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
                'name' => 'Testimonial',
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

    <!-- MAIN CONTENT -->
    <main class="py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- PAGE HEADER -->
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-2">
                    Bukti Sosial & Kepuasan Pelanggan
                </span>
                <h1 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight">
                    Pengalaman Nyata Bersama Puja Tour
                </h1>
                <p class="text-xs sm:text-sm md:text-base text-slate-600 mt-2.5 sm:mt-3 leading-relaxed">
                    Lebih dari ribuan wisatawan keluarga, rombongan kantor, dan komunitas telah mempercayakan liburan Pangandaran mereka bersama kami.
                </p>

                <!-- STATS BAR -->
                <div class="mt-6 sm:mt-8 grid grid-cols-1 xs:grid-cols-3 gap-3 xs:gap-0 divide-y xs:divide-y-0 xs:divide-x divide-neutral-200 max-w-lg mx-auto bg-surface-soft p-4 rounded-2xl border border-neutral-200 shadow-xs">
                    <div class="pb-2.5 xs:pb-0 xs:px-2">
                        <span class="font-display font-black text-xl sm:text-2xl text-slate-900">4.9/5</span>
                        <span class="text-[11px] text-slate-500 block font-medium mt-0.5">Rating Rata-Rata</span>
                    </div>
                    <div class="py-2.5 xs:py-0 xs:px-2">
                        <span class="font-display font-black text-xl sm:text-2xl text-emerald-700">100%</span>
                        <span class="text-[11px] text-slate-500 block font-medium mt-0.5">Guide Lokal Bersertifikat</span>
                    </div>
                    <div class="pt-2.5 xs:pt-0 xs:px-2">
                        <span class="font-display font-black text-xl sm:text-2xl text-slate-900">{{ $testimonials->count() }}+</span>
                        <span class="text-[11px] text-slate-500 block font-medium mt-0.5">Ulasan Terverifikasi</span>
                    </div>
                </div>

                <div class="mt-6 sm:mt-8 flex justify-center">
                    <button type="button" id="btn-open-review-modal" class="w-full xs:w-auto inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 min-h-11 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-xs hover:shadow-md transition cursor-pointer">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                        <span>Tulis Ulasan & Bagikan Pengalaman</span>
                    </button>
                </div>

                @if(session('testimonial_success'))
                    <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm flex items-start gap-3 shadow-2xs text-left max-w-lg mx-auto">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5"></i>
                        <div>
                            <strong>Berhasil Terkirim!</strong>
                            <p class="mt-0.5">{{ session('testimonial_success') }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- SVG Gold Star Gradient Definition -->
            <svg class="sr-only" aria-hidden="true" width="0" height="0">
                <defs>
                    <linearGradient id="goldStarGradTesti" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="#FDE047" />
                        <stop offset="45%" stop-color="#F59E0B" />
                        <stop offset="100%" stop-color="#D97706" />
                    </linearGradient>
                </defs>
            </svg>

            @if($testimonials->count() > 0)
                <!-- Sub-Header: Informasi Ulasan Asli & Petunjuk Klik Detail -->
                <div class="flex flex-col xs:flex-row xs:items-end justify-between gap-3 mb-6 sm:mb-8">
                    <div>
                        <span class="text-[10px] xs:text-xs font-bold text-slate-400 uppercase tracking-widest block">Ulasan Wisatawan Asli</span>
                        <h2 class="text-base sm:text-xl font-display font-extrabold text-slate-900 mt-0.5">Semua Cerita Pengalaman Tamu</h2>
                    </div>
                    <div class="inline-flex items-center gap-1.5 text-[11px] text-emerald-700 font-semibold bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-200/80 self-start xs:self-auto shadow-2xs">
                        <i data-lucide="mouse-pointer-click" class="w-3.5 h-3.5 text-emerald-600 shrink-0"></i>
                        <span>Ketuk ulasan untuk membaca cerita lengkap</span>
                    </div>
                </div>

                <!-- TAMPILAN BERGESER: Auto-Scrolling Marquee di Desktop + Interactive Carousel di Mobile -->
                <div id="testi-slider-view" class="w-full">
                    <!-- Marquee Showcase Container with Edge Fade Masks -->
                    <div class="relative w-full overflow-hidden select-none py-2 testimonial-marquee-wrapper" id="testi-page-wrapper">
                        <!-- Left & Right Gradient Fade Masks -->
                        <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-8 sm:w-24 bg-linear-to-r from-[#f4f6f1] to-transparent z-10"></div>
                        <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-8 sm:w-24 bg-linear-to-l from-[#f4f6f1] to-transparent z-10"></div>

                        <!-- The Marquee Track (Smooth Walking Animation, Pauses on Hover) -->
                        <div id="testi-page-track" class="testimonial-marquee-track flex gap-6 px-4">
                            @php
                                $loopCount = $testimonials->count() < 4 ? 4 : 2;
                            @endphp
                            @for($repeat = 0; $repeat < $loopCount; $repeat++)
                                @foreach($testimonials as $tIndex => $t)
                                    <div class="testimonial-card group w-77.5 sm:w-95 shrink-0 bg-surface-soft rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200 flex flex-col justify-between hover:shadow-card-hover hover:border-emerald-400 hover:-translate-y-1 transition-all duration-300 cursor-pointer"
                                         data-name="{{ $t->customer_name }}"
                                         data-city="{{ $t->customer_city ?? 'Wisatawan' }}"
                                         data-package="{{ $t->package_name ?? 'Paket Wisata Pangandaran' }}"
                                         data-rating="{{ (int)($t->rating ?? 5) }}"
                                         data-review="{{ $t->review_text }}"
                                         data-date="{{ $t->trip_date ? $t->trip_date->translatedFormat('d F Y') : ($t->created_at ? $t->created_at->translatedFormat('d F Y') : '') }}"
                                         data-avatar="{{ $t->avatar_url ?? '' }}"
                                         data-initials="{{ substr($t->customer_name, 0, 2) }}"
                                         title="Klik untuk membaca ulasan lengkap {{ $t->customer_name }}">
                                        <div>
                                            <!-- Header: Bintang Emas di Tengah & Badge Terverifikasi -->
                                            <div class="flex flex-col items-center justify-center text-center mb-4">
                                                <div class="flex items-center justify-center gap-1.5 mb-2">
                                                    @php $r = (int)($t->rating ?? 5); @endphp
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $r)
                                                            <svg class="w-5 h-5 drop-shadow-[0_2px_4px_rgba(245,158,11,0.35)] transition-transform duration-200 group-hover:scale-110" viewBox="0 0 24 24" fill="url(#goldStarGradTesti)" stroke="#d97706" stroke-width="0.5">
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
                                                    <span>Ulasan Terverifikasi</span>
                                                </span>
                                            </div>

                                            <p class="text-slate-700 text-xs sm:text-sm italic leading-relaxed line-clamp-4 text-center">
                                                "{{ $t->review_text }}"
                                            </p>

                                            <!-- Indikator Interaktif Baca Selengkapnya -->
                                            <div class="mt-3 flex items-center justify-center">
                                                <span class="text-[11px] font-bold text-emerald-700 group-hover:text-emerald-800 inline-flex items-center gap-1 bg-emerald-50/80 group-hover:bg-emerald-100 px-2.5 py-1 rounded-full border border-emerald-200/70 transition">
                                                    <span>Baca Selengkapnya</span>
                                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-3.5 pt-5 mt-5 border-t border-neutral-200">
                                            @if($t->avatar_url)
                                                <img src="{{ $t->avatar_url }}" alt="{{ $t->customer_name }}" class="w-11 h-11 rounded-full object-cover shrink-0 shadow-inner">
                                            @else
                                                <div class="w-11 h-11 rounded-full bg-emerald-100 text-emerald-800 font-bold font-display text-base flex items-center justify-center shrink-0 shadow-inner">
                                                    {{ substr($t->customer_name, 0, 2) }}
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <h4 class="font-display font-bold text-slate-900 text-sm truncate group-hover:text-emerald-800 transition">{{ $t->customer_name }}</h4>
                                                <span class="text-xs text-slate-400 block truncate">
                                                    {{ $t->customer_city ?? 'Wisatawan' }} • {{ $t->package_name ?? 'Paket Wisata' }}
                                                </span>
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
                            <div id="testi-page-dots-mobile" class="flex items-center gap-1.5 py-1">
                                @foreach($testimonials as $idx => $t)
                                    <button type="button" class="testi-page-dot h-2 rounded-full transition-all duration-300 {{ $idx === 0 ? 'w-6 bg-emerald-700' : 'w-2 bg-neutral-300' }}" data-index="{{ $idx }}" aria-label="Lihat ulasan {{ $idx + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif

                        <!-- Tombol Navigasi: Sebelumnya & Lanjut ke Ulasan Berikutnya -->
                        <div class="flex items-center gap-2.5 w-full max-w-sm justify-center">
                            <!-- Tombol Sebelumnya -->
                            <button type="button" id="btn-prev-testi-page" aria-label="Ulasan Sebelumnya" class="w-11 h-11 rounded-2xl bg-surface-soft hover:bg-neutral-100 active:scale-95 border border-neutral-200 text-slate-700 flex items-center justify-center shadow-xs transition cursor-pointer shrink-0">
                                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-600"></i>
                            </button>

                            <!-- Tombol Utama: Lanjut ke Ulasan Berikutnya -->
                            <button type="button" id="btn-next-testi-page" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-emerald-700 hover:bg-emerald-800 active:scale-[0.98] text-white font-bold text-xs sm:text-sm shadow-md shadow-emerald-700/20 transition cursor-pointer">
                                <span>Lanjut ke Ulasan Berikutnya</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 text-emerald-200"></i>
                            </button>
                        </div>

                        <!-- Petunjuk Ramah & Enak Dibaca -->
                        <p class="text-[11px] text-slate-500 font-medium flex items-center gap-1.5">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-600 shrink-0"></i>
                            <span>Ketuk ulasan untuk membaca versi lengkap</span>
                        </p>
                    </div>
                </div>
            @else
                <div class="py-12 text-center text-slate-400">
                    <i data-lucide="message-square" class="w-10 h-10 mx-auto text-slate-300 mb-3"></i>
                    <p class="text-sm">Belum ada ulasan yang dipublikasikan saat ini.</p>
                </div>
            @endif

            <!-- GRAND CTA SECTION (Sesuai Desain Konsisten Website) -->
            <div class="mt-14 sm:mt-18 lg:mt-20 rounded-2xl sm:rounded-3xl bg-slate-950 text-white p-6 sm:p-10 lg:p-14 relative overflow-hidden shadow-xl border border-slate-800 text-center">
                <!-- Decorative Glow Background -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-4 sm:space-y-5">
                    <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mx-auto border border-emerald-500/30 shadow-2xs">
                        <i data-lucide="compass" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    </div>
                    <h2 class="font-display font-extrabold text-xl sm:text-2xl lg:text-4xl text-white tracking-tight">
                        Siap Membuat Cerita Liburan Anda Sendiri?
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl mx-auto">
                        Konsultasikan destinasi impian Anda bersama tim profesional Puja Tour & Travel. Pemandu lokal ramah, asuransi lengkap, dan kepuasan terjamin.
                    </p>
                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-3.5">
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" 
                           target="_blank" 
                           class="w-full sm:w-auto px-6 py-3 min-h-11 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Chat WhatsApp Tim Reservasi</span>
                        </a>
                        <a href="{{ route('calculator') }}" 
                           class="w-full sm:w-auto px-6 py-3 min-h-11 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 transition-all duration-300 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                            <i data-lucide="calculator" class="w-4 h-4"></i>
                            <span>Hitung Estimasi Biaya</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- PERSISTENT FLOATING WHATSAPP BUTTON -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20Pangandaran" target="_blank" class="flex items-center gap-2.5 px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
            <i data-lucide="message-circle" class="w-5 h-5"></i>
            <span class="text-xs font-bold hidden sm:inline">Tanya Kami di WhatsApp</span>
        </a>
    </div>

    <!-- MODAL TULIS ULASAN / TESTIMONI WISATAWAN -->
    <div id="review-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <!-- Backdrop -->
        <div id="review-modal-backdrop" class="fixed inset-0 bg-slate-950/65 backdrop-blur-xs transition-opacity duration-300 opacity-0 cursor-pointer"></div>

        <!-- Modal Box -->
        <div id="review-modal-box" class="relative bg-white rounded-2xl sm:rounded-3xl max-w-lg w-full p-5 sm:p-8 shadow-2xl border border-neutral-200 z-10 transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between pb-4 border-b border-neutral-200">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">Form Ulasan Tamu</span>
                    <h3 class="font-display font-extrabold text-lg sm:text-xl text-slate-900 mt-1">Bagikan Pengalaman Liburan Anda</h3>
                </div>
                <button type="button" id="btn-close-review-modal" aria-label="Tutup Modal" class="p-2 min-w-10 min-h-10 flex items-center justify-center rounded-xl text-slate-400 hover:text-slate-700 hover:bg-neutral-100 transition cursor-pointer">
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
                    <input type="text" name="customer_name" required placeholder="Contoh: Rian & Annisa / Budi Santoso" class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-slate-50 text-slate-900 text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Kota Asal / Domisili</label>
                        <input type="text" name="customer_city" placeholder="Contoh: Bandung / Jakarta" class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-slate-50 text-slate-900 text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Paket yang Diikuti</label>
                        <select name="package_name" class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-slate-50 text-slate-900 text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                            <option value="">-- Pilih Paket (Opsional) --</option>
                            @if(isset($packages))
                                @foreach($packages as $p)
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
                    <div class="flex flex-col xs:flex-row xs:items-center gap-2.5 xs:gap-3 p-3 rounded-xl bg-slate-50 border border-neutral-200">
                        <div class="flex items-center gap-1.5 text-2xl text-slate-300" id="star-rating-group">
                            <button type="button" data-rating="1" class="star-btn cursor-pointer text-amber-400 p-1">★</button>
                            <button type="button" data-rating="2" class="star-btn cursor-pointer text-amber-400 p-1">★</button>
                            <button type="button" data-rating="3" class="star-btn cursor-pointer text-amber-400 p-1">★</button>
                            <button type="button" data-rating="4" class="star-btn cursor-pointer text-amber-400 p-1">★</button>
                            <button type="button" data-rating="5" class="star-btn cursor-pointer text-amber-400 p-1">★</button>
                        </div>
                        <span id="star-rating-label" class="text-xs font-bold text-slate-800">5 Bintang (Sangat Puas)</span>
                    </div>
                    <input type="hidden" name="rating" id="input-rating-value" value="5">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Ulasan Pengalaman Wisata *</label>
                    <textarea name="review_text" rows="3" required placeholder="Ceritakan bagaimana keseruan trip, keramahan pemandu, atau keamanan fasilitas bersama Puja Tour..." class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-slate-50 text-slate-900 text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition"></textarea>
                </div>

                <!-- Moderation Notice -->
                <div class="p-3 sm:p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-start gap-2.5">
                    <i data-lucide="shield-check" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                    <p class="leading-relaxed">
                        Ulasan Anda akan diteruskan ke <strong>panel admin Puja Tour</strong> untuk diverifikasi (ACC) sebelum ditampilkan di website agar terhindar dari spam.
                    </p>
                </div>

                <div class="pt-2 flex flex-col-reverse xs:flex-row items-stretch xs:items-center justify-end gap-2.5 sm:gap-3">
                    <button type="button" id="btn-cancel-review" class="w-full xs:w-auto px-5 py-2.5 min-h-11 rounded-xl border border-neutral-200 text-slate-600 hover:bg-neutral-100 font-semibold text-xs transition cursor-pointer flex items-center justify-center">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit-review" class="w-full xs:w-auto px-6 py-2.5 min-h-11 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
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

    <!-- MODAL DETAIL ULASAN TAMU (Pop-up Baca Ulasan Lengkap) -->
    <div id="testi-detail-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="modal-testi-customer-name">
        <!-- Backdrop Gelap Halus -->
        <div id="testi-detail-backdrop" class="fixed inset-0 bg-slate-950/75 backdrop-blur-xs transition-opacity duration-300 opacity-0"></div>

        <!-- Box Konten Modal Pop-up -->
        <div id="testi-detail-box" class="relative bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-neutral-100 transform transition-all duration-300 scale-95 opacity-0 my-auto z-10">
            <!-- Tombol Tutup Silang (X) -->
            <button type="button" id="btn-close-testi-detail" class="absolute top-5 right-5 w-9 h-9 rounded-full bg-neutral-100 hover:bg-neutral-200 text-slate-500 hover:text-slate-900 flex items-center justify-center transition cursor-pointer" aria-label="Tutup ulasan">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <!-- Header Modal: Bintang Rating & Badge Terverifikasi -->
            <div class="flex flex-wrap items-center gap-2.5 sm:gap-3 pr-10">
                <div id="modal-testi-stars" class="flex items-center gap-1">
                    <!-- Dinamis di-generate JS -->
                </div>
                <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200/80 shadow-2xs">
                    <i data-lucide="badge-check" class="w-3.5 h-3.5 text-emerald-600"></i>
                    <span>Ulasan Terverifikasi</span>
                </span>
            </div>

            <!-- Teks Lengkap Ulasan (Full Text) -->
            <div class="mt-5 relative">
                <div class="absolute -top-3 -left-2 text-emerald-100 pointer-events-none select-none">
                    <svg class="w-12 h-12 fill-current opacity-70" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                </div>
                <div class="relative z-10 max-h-72 overflow-y-auto pr-2 custom-scrollbar">
                    <p id="modal-testi-review-text" class="text-slate-800 text-sm sm:text-base leading-relaxed italic whitespace-pre-line">
                        <!-- Teks ulasan lengkap diisi oleh JS -->
                    </p>
                </div>
            </div>

            <!-- Identitas Tamu & Detail Trip -->
            <div class="mt-6 pt-5 border-t border-neutral-200 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3.5 min-w-0">
                    <div id="modal-testi-avatar-wrapper" class="w-12 h-12 rounded-full overflow-hidden shrink-0 shadow-inner flex items-center justify-center">
                        <!-- Avatar / Inisial diisi oleh JS -->
                    </div>
                    <div class="min-w-0">
                        <h4 id="modal-testi-customer-name" class="font-display font-bold text-slate-900 text-base truncate"></h4>
                        <span id="modal-testi-meta" class="text-xs text-slate-500 block truncate font-medium"></span>
                        <span id="modal-testi-date" class="text-[11px] text-emerald-700 font-semibold block mt-0.5"></span>
                    </div>
                </div>
            </div>

            <!-- Modal Actions Footer -->
            <div class="mt-6 pt-4 border-t border-neutral-100 flex flex-col xs:flex-row items-stretch xs:items-center justify-end gap-2.5">
                <button type="button" id="btn-dismiss-testi-detail" class="px-5 py-2.5 min-h-11 rounded-xl border border-neutral-200 hover:bg-neutral-100 text-slate-700 font-bold text-xs transition cursor-pointer">
                    Tutup
                </button>
                <a id="btn-modal-testi-whatsapp" href="#" target="_blank" class="px-5 py-2.5 min-h-11 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition inline-flex items-center justify-center gap-2 cursor-pointer">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Tanya Paket Ini</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileDrawer = document.getElementById('mobile-drawer');
            const closeDrawerBtn = document.getElementById('close-drawer-btn');

            if (mobileMenuBtn && mobileDrawer) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileDrawer.classList.remove('hidden');
                });
            }
            if (closeDrawerBtn && mobileDrawer) {
                closeDrawerBtn.addEventListener('click', () => {
                    mobileDrawer.classList.add('hidden');
                });
            }

            // --- Review Submission Modal Logic ---
            const reviewModal = document.getElementById('review-modal');
            const modalBackdrop = document.getElementById('review-modal-backdrop');
            const modalBox = document.getElementById('review-modal-box');
            const openModalBtn = document.getElementById('btn-open-review-modal');
            const closeModalBtn = document.getElementById('btn-close-review-modal');
            const cancelModalBtn = document.getElementById('btn-cancel-review');
            const closeSuccessBtn = document.getElementById('btn-close-review-success');
            const reviewForm = document.getElementById('form-submit-review');
            const reviewSuccessState = document.getElementById('review-success-state');

            function openReviewModal() {
                if (!reviewModal) return;
                reviewModal.classList.remove('hidden');
                reviewModal.classList.add('flex');
                setTimeout(() => {
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
                setTimeout(() => {
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

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && reviewModal && !reviewModal.classList.contains('hidden')) {
                    closeReviewModal();
                }
            });

            // --- Star Rating Interactive Selector ---
            const starButtons = document.querySelectorAll('.star-btn');
            const ratingInput = document.getElementById('input-rating-value');
            const ratingLabel = document.getElementById('star-rating-label');

            const ratingLabels = {
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

                starButtons.forEach((btn) => {
                    const r = parseInt(btn.getAttribute('data-rating'), 10);
                    if (r <= val) {
                        btn.classList.add('text-amber-400');
                        btn.classList.remove('text-slate-300');
                    } else {
                        btn.classList.remove('text-amber-400');
                        btn.classList.add('text-slate-300');
                    }
                });
            }

            starButtons.forEach((btn) => {
                btn.addEventListener('click', function() {
                    setRating(this.getAttribute('data-rating'));
                });
            });

            // --- Form AJAX Submission ---
            if (reviewForm) {
                reviewForm.addEventListener('submit', (e) => {
                    e.preventDefault();

                    const submitBtn = document.getElementById('btn-submit-review');
                    const submitText = document.getElementById('btn-submit-text');

                    if (submitBtn) {
                        submitBtn.disabled = true;
                        if (submitText) submitText.textContent = 'Mengirim...';
                    }

                    const formData = new FormData(reviewForm);

                    fetch(reviewForm.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        if (data.success) {
                            reviewForm.classList.add('hidden');
                            if (reviewSuccessState) {
                                reviewSuccessState.classList.remove('hidden');
                            }
                        } else {
                            alert(data.message || 'Gagal mengirim ulasan.');
                            if (submitBtn) submitBtn.disabled = false;
                            if (submitText) submitText.textContent = 'Kirim Ulasan';
                        }
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    })
                    .catch((err) => {
                        console.error(err);
                        reviewForm.submit();
                    });
                });
            }

            // --- Testimonial Detail Pop-up Modal (Baca Ulasan Lengkap) ---
            const detailModal = document.getElementById('testi-detail-modal');
            const detailBackdrop = document.getElementById('testi-detail-backdrop');
            const detailBox = document.getElementById('testi-detail-box');
            const btnCloseDetail = document.getElementById('btn-close-testi-detail');
            const btnDismissDetail = document.getElementById('btn-dismiss-testi-detail');
            const modalReviewText = document.getElementById('modal-testi-review-text');
            const modalCustomerName = document.getElementById('modal-testi-customer-name');
            const modalMeta = document.getElementById('modal-testi-meta');
            const modalDate = document.getElementById('modal-testi-date');
            const modalStars = document.getElementById('modal-testi-stars');
            const modalAvatarWrapper = document.getElementById('modal-testi-avatar-wrapper');
            const modalWhatsappBtn = document.getElementById('btn-modal-testi-whatsapp');
            const companyWaNum = "{{ $waNum }}";

            function openTestimonialDetail(card) {
                if (!detailModal || !card) return;

                const name = card.getAttribute('data-name') || 'Wisatawan';
                const city = card.getAttribute('data-city') || 'Wisatawan';
                const pkg = card.getAttribute('data-package') || 'Paket Wisata Pangandaran';
                const rating = parseInt(card.getAttribute('data-rating') || '5', 10);
                const review = card.getAttribute('data-review') || '';
                const date = card.getAttribute('data-date') || '';
                const avatar = card.getAttribute('data-avatar') || '';
                const initials = card.getAttribute('data-initials') || name.substring(0, 2);

                if (modalReviewText) modalReviewText.textContent = `"${review}"`;
                if (modalCustomerName) modalCustomerName.textContent = name;
                if (modalMeta) modalMeta.textContent = `${city} • ${pkg}`;
                if (modalDate) modalDate.textContent = date ? `Trip: ${date}` : '';

                // Generate Stars SVG
                if (modalStars) {
                    let starHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= rating) {
                            starHtml += `
                                <svg class="w-5 h-5 drop-shadow-[0_2px_4px_rgba(245,158,11,0.35)]" viewBox="0 0 24 24" fill="url(#goldStarGradTesti)" stroke="#d97706" stroke-width="0.5">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            `;
                        } else {
                            starHtml += `
                                <svg class="w-5 h-5 text-slate-200" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            `;
                        }
                    }
                    modalStars.innerHTML = starHtml;
                }

                // Avatar / Initials
                if (modalAvatarWrapper) {
                    if (avatar) {
                        modalAvatarWrapper.innerHTML = `<img src="${avatar}" alt="${name}" class="w-full h-full object-cover">`;
                    } else {
                        modalAvatarWrapper.innerHTML = `
                            <div class="w-full h-full bg-emerald-100 text-emerald-800 font-bold font-display text-base flex items-center justify-center">
                                ${initials}
                            </div>
                        `;
                    }
                }

                // WhatsApp Inquiry Link
                if (modalWhatsappBtn) {
                    const waText = `Halo Admin Puja Tour & Travel, saya membaca ulasan pengalaman dari ${name} mengenai ${pkg}. Saya tertarik dan ingin tanya info paket tersebut.`;
                    modalWhatsappBtn.href = `https://wa.me/${companyWaNum}?text=${encodeURIComponent(waText)}`;
                }

                // Show modal with animation
                detailModal.classList.remove('hidden');
                detailModal.classList.add('flex');
                setTimeout(() => {
                    if (detailBackdrop) detailBackdrop.classList.remove('opacity-0');
                    if (detailBox) {
                        detailBox.classList.remove('scale-95', 'opacity-0');
                        detailBox.classList.add('scale-100', 'opacity-100');
                    }
                }, 20);

                if (typeof lucide !== 'undefined') lucide.createIcons();
            }

            function closeTestimonialDetail() {
                if (!detailModal) return;
                if (detailBackdrop) detailBackdrop.classList.add('opacity-0');
                if (detailBox) {
                    detailBox.classList.remove('scale-100', 'opacity-100');
                    detailBox.classList.add('scale-95', 'opacity-0');
                }
                setTimeout(() => {
                    detailModal.classList.remove('flex');
                    detailModal.classList.add('hidden');
                }, 300);
            }

            if (btnCloseDetail) btnCloseDetail.addEventListener('click', closeTestimonialDetail);
            if (btnDismissDetail) btnDismissDetail.addEventListener('click', closeTestimonialDetail);
            if (detailBackdrop) detailBackdrop.addEventListener('click', closeTestimonialDetail);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && detailModal && !detailModal.classList.contains('hidden')) {
                    closeTestimonialDetail();
                }
            });

            // Card click listener with pointer movement threshold to distinguish click vs drag/swipe
            const allTestiCards = document.querySelectorAll('.testimonial-card');
            allTestiCards.forEach((card) => {
                let startX = 0;
                let startY = 0;
                let isDragging = false;

                card.addEventListener('pointerdown', (e) => {
                    startX = e.clientX;
                    startY = e.clientY;
                    isDragging = false;
                });

                card.addEventListener('pointermove', (e) => {
                    if (Math.abs(e.clientX - startX) > 10 || Math.abs(e.clientY - startY) > 10) {
                        isDragging = true;
                    }
                });

                card.addEventListener('click', (e) => {
                    if (isDragging) return;
                    openTestimonialDetail(card);
                });
            });

            // --- Mobile Testimonial Slider Interactive Logic (Testimonial Page) ---
            var testiPageWrapper = document.getElementById('testi-page-wrapper');
            var btnNextTestiPage = document.getElementById('btn-next-testi-page');
            var btnPrevTestiPage = document.getElementById('btn-prev-testi-page');
            var testiPageDots = document.querySelectorAll('#testi-page-dots-mobile .testi-page-dot');
            var totalTestiPage = {{ $testimonials->count() }};
            var testiPageAutoSlideTimer = null;

            function getTestiPageCardStep() {
                if (!testiPageWrapper) return 334;
                var firstCard = testiPageWrapper.querySelector('.testimonial-card');
                var secondCard = firstCard ? firstCard.nextElementSibling : null;
                if (firstCard && secondCard) {
                    return secondCard.offsetLeft - firstCard.offsetLeft;
                }
                return firstCard ? firstCard.offsetWidth + 24 : 334;
            }

            function slideNextTestiPage() {
                if (!testiPageWrapper) return;
                var step = getTestiPageCardStep();
                var maxScroll = testiPageWrapper.scrollWidth - testiPageWrapper.clientWidth;
                if (testiPageWrapper.scrollLeft >= maxScroll - 20) {
                    testiPageWrapper.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    testiPageWrapper.scrollBy({ left: step, behavior: 'smooth' });
                }
                resetTestiPageAutoSlide();
            }

            function slidePrevTestiPage() {
                if (!testiPageWrapper) return;
                var step = getTestiPageCardStep();
                if (testiPageWrapper.scrollLeft <= 15) {
                    var maxScroll = testiPageWrapper.scrollWidth - testiPageWrapper.clientWidth;
                    testiPageWrapper.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    testiPageWrapper.scrollBy({ left: -step, behavior: 'smooth' });
                }
                resetTestiPageAutoSlide();
            }

            function updateTestiPageDots() {
                if (!testiPageWrapper || totalTestiPage <= 0 || !testiPageDots.length) return;
                var step = getTestiPageCardStep();
                var currentIdx = Math.round(testiPageWrapper.scrollLeft / step) % totalTestiPage;
                testiPageDots.forEach(function(dot, idx) {
                    if (idx === currentIdx) {
                        dot.classList.remove('w-2', 'bg-neutral-300');
                        dot.classList.add('w-6', 'bg-emerald-700');
                    } else {
                        dot.classList.remove('w-6', 'bg-emerald-700');
                        dot.classList.add('w-2', 'bg-neutral-300');
                    }
                });
            }

            function startTestiPageAutoSlide() {
                if (window.innerWidth >= 640 || !testiPageWrapper) return;
                stopTestiPageAutoSlide();
                testiPageAutoSlideTimer = setInterval(function() {
                    slideNextTestiPage();
                }, 6000);
            }

            function stopTestiPageAutoSlide() {
                if (testiPageAutoSlideTimer) {
                    clearInterval(testiPageAutoSlideTimer);
                    testiPageAutoSlideTimer = null;
                }
            }

            function resetTestiPageAutoSlide() {
                stopTestiPageAutoSlide();
                startTestiPageAutoSlide();
            }

            if (btnNextTestiPage) {
                btnNextTestiPage.addEventListener('click', slideNextTestiPage);
            }
            if (btnPrevTestiPage) {
                btnPrevTestiPage.addEventListener('click', slidePrevTestiPage);
            }

            if (testiPageDots.length) {
                testiPageDots.forEach(function(dot) {
                    dot.addEventListener('click', function() {
                        var targetIdx = parseInt(this.getAttribute('data-index'), 10);
                        var step = getTestiPageCardStep();
                        if (testiPageWrapper) {
                            testiPageWrapper.scrollTo({ left: targetIdx * step, behavior: 'smooth' });
                        }
                        resetTestiPageAutoSlide();
                    });
                });
            }

            if (testiPageWrapper) {
                var scrollTimeout = null;
                testiPageWrapper.addEventListener('scroll', function() {
                    if (scrollTimeout) cancelAnimationFrame(scrollTimeout);
                    scrollTimeout = requestAnimationFrame(updateTestiPageDots);
                }, { passive: true });

                testiPageWrapper.addEventListener('touchstart', stopTestiPageAutoSlide, { passive: true });
                testiPageWrapper.addEventListener('touchend', function() {
                    setTimeout(startTestiPageAutoSlide, 3000);
                }, { passive: true });
            }

            startTestiPageAutoSlide();
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 640) {
                    stopTestiPageAutoSlide();
                } else {
                    startTestiPageAutoSlide();
                }
            });
        });
    </script>
</body>
</html>
