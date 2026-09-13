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
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-2">
                    Bukti Sosial & Kepuasan Pelanggan
                </span>
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
                    Pengalaman Nyata Bersama Puja Tour
                </h1>
                <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                    Lebih dari ribuan wisatawan keluarga, rombongan kantor, dan komunitas telah mempercayakan liburan Pangandaran mereka bersama kami.
                </p>

                <!-- STATS BAR -->
                <div class="mt-8 grid grid-cols-3 gap-4 max-w-lg mx-auto bg-surface-soft p-4 rounded-2xl border border-neutral-200 shadow-sm">
                    <div>
                        <span class="font-display font-black text-2xl text-slate-900">4.9/5</span>
                        <span class="text-[11px] text-slate-500 block font-medium">Rating Rata-Rata</span>
                    </div>
                    <div class="border-x border-neutral-200">
                        <span class="font-display font-black text-2xl text-emerald-700">100%</span>
                        <span class="text-[11px] text-slate-500 block font-medium">Guide Lokal Bersertifikat</span>
                    </div>
                    <div>
                        <span class="font-display font-black text-2xl text-slate-900">{{ $testimonials->count() }}+</span>
                        <span class="text-[11px] text-slate-500 block font-medium">Ulasan Terverifikasi</span>
                    </div>
                </div>

                <div class="mt-8 flex justify-center">
                    <button type="button" id="btn-open-review-modal" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-sm hover:shadow-md transition cursor-pointer">
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

            <!-- TESTIMONIALS GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($testimonials as $t)
                    <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200 flex flex-col justify-between hover:shadow-md transition">
                        <div>
                            <!-- Header: Bintang Emas di Tengah & Badge Terverifikasi -->
                            <div class="flex flex-col items-center justify-center text-center mb-4">
                                <div class="flex items-center justify-center gap-1.5 mb-2">
                                    @php $r = (int)($t->rating ?? 5); @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $r)
                                            <svg class="w-5 h-5 drop-shadow-[0_2px_4px_rgba(245,158,11,0.35)] transition-transform duration-200 hover:scale-115" viewBox="0 0 24 24" fill="url(#goldStarGradTesti)" stroke="#d97706" stroke-width="0.5">
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

                            <!-- Review Text -->
                            <p class="text-slate-700 text-xs sm:text-sm leading-relaxed italic mb-6 text-center">
                                "{{ $t->review_text }}"
                            </p>
                        </div>

                        <div class="pt-4 border-t border-neutral-200 flex items-center gap-3">
                            @if($t->avatar_url)
                                <img src="{{ $t->avatar_url }}" alt="{{ $t->customer_name }}" class="w-10 h-10 rounded-full object-cover shrink-0">
                            @else
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ substr($t->customer_name, 0, 2) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h4 class="font-display font-bold text-xs sm:text-sm text-slate-900 truncate">{{ $t->customer_name }}</h4>
                                <span class="text-[11px] text-slate-400 block truncate">
                                    {{ $t->customer_city ?? 'Wisatawan' }} • {{ $t->package_name ?? 'Paket Wisata' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-400">
                        <i data-lucide="message-square" class="w-10 h-10 mx-auto text-slate-300 mb-3"></i>
                        <p class="text-sm">Belum ada ulasan yang dipublikasikan saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- BOTTOM CTA BANNER (Section 3.6 / 03-sitemap-and-pages.md) -->
            <div class="mt-16 rounded-3xl bg-slate-900 bg-gradient-to-r from-emerald-800 to-slate-900 text-white p-8 sm:p-12 text-center shadow-lg relative overflow-hidden">
                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl">
                        Siap Membuat Cerita Liburan Anda Sendiri?
                    </h2>
                    <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                        Konsultasikan destinasi impian Anda bersama tim profesional Puja Tour & Travel. Pemandu lokal ramah, asuransi lengkap, dan kepuasan terjamin.
                    </p>
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ route('calculator') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-white text-emerald-900 font-bold text-xs hover:bg-neutral-100 transition shadow">
                            Hitung Estimasi Biaya
                        </a>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Puja%20Tour,%20saya%20tertarik%20dengan%20paket%20wisata%20Pangandaran" target="_blank" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-emerald-600 text-white font-bold text-xs hover:bg-emerald-500 transition shadow flex items-center justify-center gap-2">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Chat WhatsApp Langsung</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white pt-14 pb-8 border-t border-slate-800 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-10 border-b border-slate-800">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
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
        });
    </script>
</body>
</html>
