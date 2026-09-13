<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>FAQ — Pertanyaan Seputar Wisata Pangandaran & Puja Tour</title>
    <meta name="description" content="Pertanyaan umum seputar body rafting Green Canyon, snorkeling Pasir Putih, keamanan anak & pemula, dan cara pemesanan trip di Puja Tour & Travel.">
    <meta name="keywords" content="FAQ Puja Tour, pertanyaan wisata Pangandaran, body rafting aman, Green Canyon pemula, cara booking wisata Pangandaran, snorkeling Pasir Putih">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="FAQ — Pertanyaan Seputar Wisata Pangandaran & Puja Tour">
    <meta property="og:description" content="Pertanyaan umum seputar body rafting Green Canyon, snorkeling Pasir Putih, keamanan anak & pemula.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="FAQ — Pertanyaan Seputar Wisata Pangandaran & Puja Tour">
    <meta name="twitter:description" content="Pertanyaan umum seputar body rafting Green Canyon, snorkeling Pasir Putih, keamanan anak & pemula.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): FAQPage — enables Google FAQ Rich Results -->
    @if($faqs->count() > 0)
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqs->map(function ($faq) {
            return [
                '@type' => 'Question',
                'name' => $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq->answer,
                ],
            ];
        })->values()->toArray(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
    @endif

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
                'name' => 'FAQ',
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
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
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
            <span class="text-slate-900 font-semibold">Pertanyaan Umum (FAQ)</span>
        </nav>
    </div>

    <!-- MAIN FAQ CONTAINER -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 pb-16 sm:pb-20">
        <div class="text-center mb-8 sm:mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                Pusat Bantuan
            </span>
            <h1 class="font-display font-extrabold text-2xl sm:text-4xl lg:text-5xl text-slate-900 mt-2.5 sm:mt-3 tracking-tight">
                Pertanyaan yang Sering Diajukan
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-2 max-w-2xl mx-auto">
                Temukan jawaban lengkap seputar keamanan rafting, persiapan trip, fasilitas, dan ketentuan pemesanan di Puja Tour & Travel.
            </p>
        </div>

        <!-- FAQ Accordion List -->
        <div class="space-y-3 sm:space-y-4">
            @forelse($faqs as $fIndex => $faq)
                <div class="faq-item bg-surface-soft rounded-2xl border border-neutral-200 overflow-hidden shadow-xs hover:border-emerald-300 transition-all duration-300">
                    <button type="button" class="faq-toggle w-full px-4 sm:px-6 py-3.5 sm:py-5 text-left flex items-center justify-between gap-3 sm:gap-4 font-display font-bold text-slate-900 text-sm sm:text-base hover:text-emerald-700 transition cursor-pointer min-h-12">
                        <span class="leading-snug">{{ $faq->question }}</span>
                        <div class="faq-icon w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 transition-transform duration-300">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </button>
                    <div class="faq-collapse">
                        <div class="faq-collapse-inner">
                            <div class="faq-collapse-content px-4 sm:px-6 pb-5 sm:pb-6 pt-1 text-slate-600 text-xs sm:text-sm leading-relaxed border-t border-neutral-200/60 bg-white/50">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center bg-surface-soft rounded-2xl text-slate-500 text-xs sm:text-sm">
                    Belum ada data pertanyaan.
                </div>
            @endforelse
        </div>

        <!-- Masih Punya Pertanyaan Lain? -->
        <div class="mt-12 sm:mt-14 p-6 sm:p-10 rounded-2xl sm:rounded-3xl bg-slate-900 text-white text-center shadow-lg relative overflow-hidden">
            <div class="relative z-10 max-w-xl mx-auto space-y-3.5 sm:space-y-4">
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mx-auto">
                    <i data-lucide="help-circle" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                </div>
                <h3 class="font-display font-bold text-xl sm:text-2xl text-white">Punya Pertanyaan Khusus Lainnya?</h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Tim customer support kami siap melayani pertanyaan seputar rute custom, menu gathering, atau kebutuhan khusus keluarga Anda 24 jam sehari.
                </p>
                <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4">
                    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" target="_blank" class="w-full sm:w-auto px-6 py-3 min-h-11 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md transition flex items-center justify-center gap-2">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Chat WhatsApp Tim CS</span>
                    </a>
                    <a href="{{ route('contact') }}" class="w-full sm:w-auto px-6 py-3 min-h-11 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 transition flex items-center justify-center gap-2">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                        <span>Lihat Kontak & Lokasi</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20mau%20tanya" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

</body>
</html>
