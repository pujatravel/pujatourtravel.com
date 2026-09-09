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

    <link rel="icon" type="image/png" href="{{ asset('images/puja_logo.png') }}">

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
        $igUrl = $settings['instagram_url'] ?? 'https://instagram.com/pujatourtravel';
        $tiktokUrl = $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel';
    @endphp

    <!-- STICKY NAVBAR -->
    <header id="main-header" class="sticky top-0 z-40 w-full bg-surface-soft/95 backdrop-blur-md transition-all duration-300 py-3.5 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                    <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-full h-full object-contain">
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

            <nav class="hidden lg:flex items-center gap-7 font-medium text-slate-600 text-sm">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="hover:text-emerald-700 transition">Paket Wisata</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-700 transition">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="hover:text-emerald-700 transition">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="hover:text-emerald-700 transition">FAQ</a>
                <a href="{{ route('gallery') }}" class="hover:text-emerald-700 transition">Galeri</a>
                <a href="{{ route('testimonial') }}" class="text-emerald-700 font-semibold hover:text-emerald-800 transition">Testimonial</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak</a>
            </nav>

            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20info%20paket%20wisata" target="_blank" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Tanya Trip CS</span>
                </a>
            </div>

            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition" aria-label="Toggle Menu">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </header>

    <!-- MOBILE DRAWER -->
    <div id="mobile-drawer" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden lg:hidden">
        <div class="fixed top-0 right-0 bottom-0 w-5/6 max-w-sm bg-white p-6 shadow-2xl flex flex-col justify-between overflow-y-auto">
            <div>
                <div class="flex items-center justify-between pb-6 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-10 h-10 object-contain">
                        <span class="font-display font-extrabold text-lg text-slate-900">PUJA TOUR</span>
                    </div>
                    <button id="close-drawer-btn" class="p-2 rounded-xl text-slate-500 hover:bg-slate-100">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <nav class="mt-6 flex flex-col gap-3 font-medium text-slate-700 text-sm">
                    <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-xl hover:bg-slate-50">Beranda</a>
                    <a href="{{ route('packages.index') }}" class="px-4 py-2.5 rounded-xl hover:bg-slate-50">Paket Wisata</a>
                    <a href="{{ route('about') }}" class="px-4 py-2.5 rounded-xl hover:bg-slate-50">Tentang Kami</a>
                    <a href="{{ route('calculator') }}" class="px-4 py-2.5 rounded-xl hover:bg-slate-50">Estimasi Biaya</a>
                    <a href="{{ route('faq') }}" class="px-4 py-2.5 rounded-xl hover:bg-slate-50">FAQ</a>
                    <a href="{{ route('gallery') }}" class="px-4 py-2.5 rounded-xl hover:bg-slate-50">Galeri</a>
                    <a href="{{ route('testimonial') }}" class="px-4 py-2.5 rounded-xl bg-emerald-50 text-emerald-800 font-bold">Testimonial</a>
                    <a href="{{ route('contact') }}" class="px-4 py-2.5 rounded-xl hover:bg-slate-50">Kontak</a>
                </nav>
            </div>
            <div class="pt-6 border-t border-slate-100">
                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20info%20paket%20wisata" target="_blank" class="w-full py-3 rounded-xl bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Hubungi via WhatsApp</span>
                </a>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- PAGE HEADER -->
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="px-4 py-1.5 rounded-full bg-emerald-100/80 text-emerald-800 text-xs font-bold uppercase tracking-wider inline-block mb-3">
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
            </div>

            <!-- TESTIMONIALS GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($testimonials as $t)
                    <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200 flex flex-col justify-between hover:shadow-md transition">
                        <div>
                            <!-- Star Rating -->
                            <div class="flex items-center gap-1 text-amber-500 mb-4">
                                @for($i = 0; $i < ($t->rating ?? 5); $i++)
                                    <i data-lucide="star" class="w-4 h-4 fill-amber-500"></i>
                                @endfor
                            </div>

                            <!-- Review Text -->
                            <p class="text-slate-700 text-xs sm:text-sm leading-relaxed italic mb-6">
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
            <div class="mt-16 rounded-3xl bg-linear-to-r from-emerald-800 to-slate-900 text-white p-8 sm:p-12 text-center shadow-lg relative overflow-hidden">
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
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-8 h-8 object-contain">
                        <span class="font-display font-extrabold text-lg text-white">PUJA TOUR</span>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed">
                        Biro perjalanan wisata resmi di Pangandaran, Jawa Barat. Menghadirkan liburan aman, nyaman, dan berkesan.
                    </p>
                </div>
                <div>
                    <h4 class="font-display font-bold text-sm text-white mb-3">Menu Utama</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Paket Wisata</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('calculator') }}" class="hover:text-white transition">Estimasi Biaya</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-display font-bold text-sm text-white mb-3">Bantuan & Legal</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition">FAQ Wisatawan</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-white transition">Galeri Perjalanan</a></li>
                        <li><a href="{{ route('testimonial') }}" class="hover:text-white transition">Testimonial Pelanggan</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Legalitas CV Resmi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-display font-bold text-sm text-white mb-3">Kontak Resmi</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li>{{ $officeAddr }}</li>
                        <li>WhatsApp: {{ $phoneNum }}</li>
                        <li>Email: {{ $emailAddr }}</li>
                    </ul>
                </div>
            </div>
            <div class="pt-6 text-center text-slate-500 text-[11px]">
                &copy; 2026 Puja Tour & Travel Pangandaran. Seluruh Hak Cipta Dilindungi.
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
        });
    </script>
</body>
</html>
