<!DOCTYPE html>
<html lang="id" class="scroll-smooth scroll-pt-24 sm:scroll-pt-28">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Tim Pengembang PPLG — Puja Tour & Travel Pangandaran">
    <title>Tim Pengembang — Di Balik Layar Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="Mengenal tim pengembang berbakat di balik platform digital resmi Puja Tour & Travel Pangandaran. Dibangun secara mandiri oleh talenta Rekayasa Perangkat Lunak (PPLG).">
    <meta name="keywords" content="tim pengembang puja tour, developer puja tour travel, rekayasa perangkat lunak, PPLG SMKN 1 Ciamis, Muhammad Fikri Haikal, Putra Galuh, Nabil Cahyadi">

    <link rel="canonical" href="{{ route('developers') }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour & Travel Pangandaran">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('developers') }}">
    <meta property="og:title" content="Tim Pengembang — Di Balik Layar Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Mengenal tim pengembang di balik platform digital resmi Puja Tour & Travel Pangandaran. Dibangun oleh talenta muda PPLG dengan standar rekayasa perangkat lunak modern.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Tim Pengembang — Di Balik Layar Puja Tour & Travel Pangandaran">
    <meta name="twitter:description" content="Profil pengembang sistem di balik platform digital resmi Puja Tour & Travel Pangandaran.">
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
                'name' => 'Tim Pengembang',
                'item' => url()->current(),
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            <span class="text-slate-900 font-semibold">Tim Pengembang</span>
        </nav>
    </div>

    <!-- 1. CINEMATIC HERO SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-2 pb-10">
        <div class="relative rounded-3xl overflow-hidden bg-slate-950 text-white shadow-xl border border-slate-800/80">
            <!-- Ambient Glow Background -->
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-teal-600/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] bg-size-[20px_20px] opacity-20"></div>

            <div class="relative z-10 p-7 sm:p-12 lg:p-16 text-center max-w-4xl mx-auto space-y-6">
                <!-- Trust Pill Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold bg-white/10 backdrop-blur-md border border-white/20 text-emerald-300 mx-auto">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Engineering Behind Puja Tour • PPLG Team</span>
                </div>

                <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-white tracking-tight leading-[1.15]">
                    Dedikasi di Balik Layar <br class="hidden sm:block">
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-emerald-400 via-teal-300 to-emerald-200">
                        Puja Tour & Travel
                    </span>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto font-normal">
                    Platform digital terintegrasi ini dirancang dan dikembangkan secara mandiri oleh talenta muda jurusan <strong class="text-white font-semibold">Rekayasa Perangkat Lunak (PPLG)</strong> untuk mendukung digitalisasi pariwisata Pangandaran dengan standar performa tinggi, keamanan teruji, dan desain modern.
                </p>

                <!-- Highlight Metrics / Pills -->
                <div class="pt-3 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3 text-xs font-semibold">
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-slate-900/80 border border-slate-800 text-slate-300">
                        <i data-lucide="users" class="w-3.5 h-3.5 text-emerald-400"></i>
                        <span>3 Software Developers</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-slate-900/80 border border-slate-800 text-slate-300">
                        <i data-lucide="layers" class="w-3.5 h-3.5 text-teal-400"></i>
                        <span>Laravel 11 & Tailwind CSS</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-slate-900/80 border border-slate-800 text-slate-300">
                        <i data-lucide="zap" class="w-3.5 h-3.5 text-amber-400"></i>
                        <span>High-Speed Performance</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-slate-900/80 border border-slate-800 text-slate-300">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-400"></i>
                        <span>Clean & Secure Code</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. DEVELOPER CARDS SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-emerald-700 font-extrabold text-xs tracking-wider uppercase bg-emerald-100/80 px-3 py-1 rounded-full border border-emerald-200">
                Profil Tim Inti
            </span>
            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-3">
                Mengenal Sosok di Balik Kode & Desain
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($developers as $index => $dev)
                {{-- Card: overflow-visible agar avatar bisa overlap banner tanpa terpotong --}}
                <div class="group relative rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col hover:-translate-y-1" style="overflow:visible;">

                    {{-- Wrapper overflow-hidden hanya untuk sudut kartu --}}
                    <div class="rounded-3xl overflow-hidden flex flex-col flex-1">

                    <!-- Top Accent Banner (bersih tanpa pill) -->
                    <div class="relative h-32 bg-linear-to-br from-slate-950 via-emerald-950 to-slate-900 shrink-0 overflow-hidden">
                        <!-- Dot grid pattern -->
                        <div class="absolute inset-0 bg-[radial-gradient(#10b981_1px,transparent_1px)] bg-size-[14px_14px] opacity-20"></div>
                        <!-- Emerald glow accent -->
                        <div class="absolute -top-8 -right-8 w-32 h-32 bg-emerald-500/20 rounded-full blur-2xl pointer-events-none"></div>
                    </div>

                    <!-- Avatar + Nama Row — avatar di luar overflow-hidden banner, tidak terpotong -->
                    <div class="px-6 sm:px-7 -mt-10 relative z-20 flex items-start gap-4">
                        <!-- Avatar -->
                        <div class="relative w-20 h-20 shrink-0 rounded-2xl p-0.75 bg-white shadow-xl border-2 border-white ring-4 ring-emerald-500/30 group-hover:ring-emerald-500/60 transition-all duration-300">
                            <img src="{{ $dev['avatar_url'] }}"
                                 alt="Foto Profil {{ $dev['name'] }}"
                                 class="w-full h-full object-cover object-top rounded-xl bg-slate-100"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($dev['name']) }}&background=047857&color=ffffff&size=256&bold=true';">
                            <!-- GitHub Badge -->
                            <div class="absolute -bottom-1.5 -right-1.5 bg-slate-900 p-1.25 rounded-full border-2 border-white shadow-md" title="GitHub Profile Avatar">
                                <svg class="w-3 h-3 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                </svg>
                            </div>
                        </div>
                        <!-- Nama + Role di bawah nama -->
                        <div class="flex-1 min-w-0 pt-11">
                            <h3 class="font-display font-bold text-base text-slate-900 group-hover:text-emerald-700 transition leading-snug">
                                {{ $dev['name'] }}
                            </h3>
                            <p class="text-[11px] text-slate-500 mt-1 leading-tight">
                                {{ $dev['role'] }}
                            </p>
                        </div>
                    </div>

                    <!-- Konten bawah (flex-1 agar button selalu di bawah) -->
                    <div class="px-6 sm:px-7 pb-0 relative z-10 flex flex-col flex-1">

                        <!-- Bio Description -->
                        <p class="mt-4 text-xs text-slate-600 leading-relaxed">
                            {{ $dev['bio'] }}
                        </p>

                        <!-- Tech Stack Tags -->
                        <div class="mt-5">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Keahlian & Fokus:</span>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($dev['skills'] as $skill)
                                    <span class="text-[10px] font-medium bg-slate-100 text-slate-700 px-2.5 py-1 rounded-md border border-slate-200">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action Buttons: GitHub, Instagram, Email (mt-auto = selalu ke bawah) -->
                    <div class="px-6 sm:px-8 py-5 mt-auto border-t border-slate-100 bg-slate-50/60 flex flex-col gap-2.5">
                        <div class="grid grid-cols-2 gap-2">
                            <!-- GitHub Profile Link -->
                            <a href="{{ $dev['github_url'] }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-slate-900 hover:bg-black text-white text-xs font-semibold shadow-xs transition hover:scale-[1.02]">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                </svg>
                                <span>GitHub</span>
                            </a>

                            <!-- Instagram Profile Link -->
                            <a href="{{ $dev['instagram_url'] }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-linear-to-r from-pink-600 via-rose-500 to-amber-500 hover:opacity-95 text-white text-xs font-semibold shadow-xs transition hover:scale-[1.02]">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                                </svg>
                                <span>Instagram</span>
                            </a>
                        </div>

                        <!-- Email Direct Link -->
                        <a href="mailto:{{ $dev['email'] }}" 
                           class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-white border border-slate-200 hover:border-emerald-600 hover:text-emerald-700 text-slate-700 text-[11px] font-medium transition">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span class="truncate">{{ $dev['email'] }}</span>
                        </a>
                    </div>
                    </div>{{-- end wrapper overflow-hidden --}}
                </div>{{-- end card --}}
            @endforeach
        </div>
    </section>

    <!-- 3. TECHNOLOGY STACK ARCHITECTURE -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-16">
        <div class="rounded-3xl bg-white border border-slate-200/90 p-8 sm:p-12 shadow-sm">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-emerald-700 font-extrabold text-xs tracking-wider uppercase bg-emerald-100/80 px-3 py-1 rounded-full border border-emerald-200">
                    Arsitektur Teknologi
                </span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-3">
                    Dibangun dengan Teknologi Web Modern
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-2">
                    Kombinasi ekosistem PHP enterprise, styling utility-first, dan database relasional tangguh untuk menghadirkan pengalaman pengguna secepat kilat.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6 text-center">
                <!-- Laravel -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-rose-400/50 hover:bg-rose-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-rose-100 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Laravel Official SVG Logo -->
                        <svg class="w-7 h-7" viewBox="0 0 50 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v21.248l8.008-4.611v-10.88a.808.808 0 0 1 .028-.21c.007-.023.02-.043.028-.066.015-.042.029-.085.051-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.04.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.931v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.584L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.896l3.364-1.937zM39.243 7.717l-8.006 4.608 8.006 4.609 8.005-4.61-8.005-4.607zm-.801 10.895l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-7.982-4.597-9.211 5.303-8.207 4.574 7.587 4.774z" fill="#FF2D20"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">Laravel 11</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Backend Core & MVC</p>
                </div>

                <!-- Tailwind CSS -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-cyan-400/50 hover:bg-cyan-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-cyan-100 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Tailwind CSS Official SVG Logo -->
                        <svg class="w-7 h-7" viewBox="0 0 54 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M27 0C19.8 0 15.3 3.6 13.5 10.8C16.2 7.2 19.35 5.85 22.95 6.75C25.004 7.263 26.472 8.754 28.097 10.403C30.744 13.09 33.808 16.2 40.5 16.2C47.7 16.2 52.2 12.6 54 5.4C51.3 9 48.15 10.35 44.55 9.45C42.496 8.937 41.028 7.446 39.403 5.797C36.756 3.11 33.692 0 27 0ZM13.5 16.2C6.3 16.2 1.8 19.8 0 27C2.7 23.4 5.85 22.05 9.45 22.95C11.504 23.464 12.972 24.954 14.597 26.603C17.244 29.29 20.308 32.4 27 32.4C34.2 32.4 38.7 28.8 40.5 21.6C37.8 25.2 34.65 26.55 31.05 25.65C28.996 25.137 27.528 23.646 25.903 21.997C23.256 19.31 20.192 16.2 13.5 16.2Z" fill="#06B6D4"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">Tailwind CSS</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Modern UI Styling</p>
                </div>

                <!-- MySQL -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-blue-400/50 hover:bg-blue-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-blue-100 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- MySQL Official SVG Logo (Simple Icons) -->
                        <svg class="w-7 h-7" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.405 5.501c-.115 0-.193.014-.274.033v.013h.014c.054.104.146.18.214.274.054.107.1.214.154.32l.014-.015c.094-.066.14-.172.14-.333-.04-.047-.046-.094-.068-.133-.04-.067-.1-.1-.194-.14v-.02zm-10.642.692c-.18 0-.33.022-.474.062l-.006.02c.24.146.434.322.618.503.104.108.2.216.298.322.013-.013.016-.027.02-.04.068-.06.07-.166.047-.268-.014-.065-.052-.12-.1-.172-.154-.14-.344-.2-.4-.428zm14.154-.018c.205.01.41.033.614.066a7.86 7.86 0 0 1 1.34.407 9.22 9.22 0 0 1 1.084.527c.367.227.707.48 1.02.76a10.9 10.9 0 0 1 .86.853c.267.307.52.627.745.96a9.5 9.5 0 0 1 .56 1.013c.127.32.24.647.327.98.087.333.153.673.18 1.013.027.34.02.687-.014 1.02-.033.34-.1.68-.207 1.007-.107.326-.253.64-.42.94a7.67 7.67 0 0 1-.607.88 8.23 8.23 0 0 1-.76.787 9.63 9.63 0 0 1-.9.68 10.83 10.83 0 0 1-1.013.553c-.36.166-.72.313-1.094.433-.373.12-.76.213-1.147.28-.387.067-.78.1-1.167.107-.387.006-.773-.014-1.153-.06-.38-.046-.753-.12-1.12-.22-.367-.1-.727-.233-1.073-.393-.346-.16-.68-.347-.993-.56a9.87 9.87 0 0 1-.887-.72 9.93 9.93 0 0 1-.753-.827A8.63 8.63 0 0 1 6.5 13.3a8.87 8.87 0 0 1-.466-1.027 8.98 8.98 0 0 1-.3-1.06 9.42 9.42 0 0 1-.133-1.087 9.8 9.8 0 0 1 .02-1.1c.04-.367.113-.727.213-1.08a8.9 8.9 0 0 1 .38-.993 9.27 9.27 0 0 1 .554-.92 9.5 9.5 0 0 1 .706-.82 9.83 9.83 0 0 1 .84-.713 10.5 10.5 0 0 1 .96-.594 11.19 11.19 0 0 1 1.047-.453c.36-.127.72-.24 1.087-.32a11.34 11.34 0 0 1 1.127-.186c.38-.04.76-.054 1.14-.047zm-1.56 1.46c-.033.008-.066.014-.1.02v.014c.1.146.187.3.273.447.08.14.153.286.22.433l.013-.013c.08-.054.12-.134.12-.254-.033-.053-.046-.113-.08-.16-.12-.153-.3-.226-.446-.487zm2.98-.153c-.14 0-.26.034-.38.094-.054.027-.1.06-.147.093l.013.02c.087.013.16.04.234.06.127.047.24.12.346.207.08.066.14.146.2.226l.02-.02c.046-.053.06-.12.06-.2-.013-.04-.02-.08-.04-.12-.073-.12-.186-.173-.307-.36zm-5.46.72c-.067.007-.134.02-.2.034v.013c.147.18.273.367.393.56.087.14.16.286.24.433l.013-.013c.1-.054.153-.127.153-.254-.04-.053-.053-.113-.087-.16-.127-.153-.313-.22-.513-.613zm8.38.627c-.046 0-.086.007-.12.013v.014c.074.106.134.226.194.34.06.107.107.22.153.333l.014-.013c.066-.054.093-.12.093-.22-.033-.047-.04-.1-.073-.153-.107-.153-.254-.206-.26-.313zm-1.3-.046c-.066 0-.126.013-.18.04v.013c.087.127.167.26.24.393.067.12.127.24.18.367l.013-.014c.08-.053.114-.126.114-.24-.027-.046-.04-.1-.08-.146-.107-.14-.254-.2-.287-.413zM2.08 6.62c-.1 0-.193.013-.28.046v.014c.1.153.193.307.28.467.08.14.153.286.22.433l.013-.013c.087-.054.127-.134.127-.254-.033-.054-.053-.114-.087-.16-.127-.154-.3-.234-.273-.533zm17.527.94c-.04.007-.08.014-.12.02v.014c.08.12.153.24.227.367.066.12.12.24.167.36l.013-.014c.073-.053.1-.12.1-.22-.034-.047-.04-.1-.074-.154-.1-.126-.24-.18-.313-.373zm-15.02.487c-.054.007-.1.014-.154.02v.013c.08.127.154.26.22.393.06.12.12.247.174.373l.013-.013c.08-.054.113-.127.113-.247-.033-.047-.04-.1-.073-.154-.1-.14-.24-.2-.293-.385zm12.487.473c-.033.007-.066.014-.1.02v.013c.08.12.147.247.214.374.053.113.1.233.14.353l.013-.014c.08-.053.107-.12.107-.213-.033-.047-.04-.1-.073-.154-.1-.12-.234-.18-.3-.38zm-1.967-.42c-.06.007-.12.014-.173.027v.013c.087.127.167.254.24.387.06.12.12.24.173.367l.013-.014c.08-.053.107-.12.107-.22-.033-.047-.04-.1-.073-.153-.107-.134-.253-.2-.287-.407zM20 9.287c-.033.007-.06.014-.093.027v.013c.073.12.14.24.207.367.053.113.1.233.14.353l.014-.014c.073-.053.1-.12.1-.213-.034-.047-.04-.1-.074-.153-.1-.127-.24-.18-.294-.38zm-16.92.6c-.1 0-.186.014-.273.04v.013c.1.154.187.307.274.467.08.14.153.287.22.433l.014-.013c.086-.054.12-.127.12-.247-.034-.053-.053-.113-.087-.16-.12-.153-.294-.227-.267-.533zm2.52.094c-.06.006-.12.014-.167.02v.014c.087.126.16.253.234.387.066.12.12.24.173.36l.013-.013c.08-.054.114-.127.114-.24-.034-.047-.04-.1-.074-.154-.107-.126-.253-.186-.293-.373zm12.527.913c-.033.007-.06.014-.093.02v.013c.073.12.14.247.207.374.053.113.1.233.14.353l.013-.013c.074-.054.1-.12.1-.214-.033-.046-.04-.1-.073-.153-.1-.127-.24-.18-.294-.38zm-15.44.273c-.1 0-.18.014-.26.04v.013c.1.154.18.307.267.467.073.14.147.286.213.433l.013-.014c.087-.053.12-.126.12-.246-.033-.054-.053-.114-.087-.16-.12-.154-.293-.22-.267-.533zm12.74.433c-.033.006-.066.013-.1.02v.013c.08.12.147.247.22.373.054.114.1.234.14.354l.014-.013c.073-.054.1-.12.1-.214-.033-.047-.04-.1-.073-.153-.1-.127-.234-.18-.3-.38zm-1.967-.433c-.053.006-.1.013-.153.026v.014c.087.126.16.253.234.38.06.12.12.24.173.36l.013-.013c.08-.054.107-.12.107-.22-.033-.047-.04-.1-.073-.154-.107-.126-.253-.186-.3-.393z" fill="#4479A1"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">MySQL</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Database Relasional</p>
                </div>

                <!-- Blade Templates -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-amber-400/50 hover:bg-amber-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-amber-100 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Blade Template: Blade/Scalpel icon representing Laravel Blade engine -->
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.707 5.826a1 1 0 0 0-1.414 0l-9.19 9.19-1.547-1.548a1 1 0 0 0-1.414 1.415l2.254 2.254a1 1 0 0 0 1.414 0l9.897-9.897a1 1 0 0 0 0-1.414Z" fill="#D97706"/>
                            <path d="M3 20h4l10-10-4-4L3 16v4Z" fill="#FCD34D" opacity=".5"/>
                            <path d="M14 4l4 4-1 1-4-4 1-1Z" fill="#D97706"/>
                            <circle cx="4.5" cy="19.5" r="1.5" fill="#D97706"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">Blade Templates</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Dynamic Templating</p>
                </div>

                <!-- Vite -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-purple-400/50 hover:bg-purple-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-purple-100 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Vite Official SVG Logo (Simple Icons) -->
                        <svg class="w-7 h-7" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="vite-a" x1="6" y1=".7" x2="15.1" y2="21.2" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#41d1ff"/>
                                    <stop offset="1" stop-color="#bd34fe"/>
                                </linearGradient>
                                <linearGradient id="vite-b" x1="9.9" y1="5.7" x2="13.5" y2="17.9" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#ff3e00"/>
                                    <stop offset="1" stop-color="#ff8900"/>
                                </linearGradient>
                            </defs>
                            <path d="M21.2 5.4 13 21.5c-.2.4-.8.4-1-.1L3.5 5.4a.6.6 0 0 1 .6-.9l8.9 1.7c.1 0 .2 0 .3-.1l8.8-1.7c.5-.1.8.5.1.9Z" fill="url(#vite-a)"/>
                            <path d="M15.7 2 10 3a.3.3 0 0 0-.2.2l-.7 8.3a.3.3 0 0 0 .4.3l2.1-.5c.3-.1.5.2.4.4L11 17c-.1.3.3.5.5.3l.7-.8L17 7.5c.1-.3-.2-.5-.4-.5l-2.2.5c-.3.1-.5-.2-.4-.5l1-4.6c0-.3-.1-.5-.3-.4Z" fill="url(#vite-b)"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">Vite Bundler</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Asset Pipeline</p>
                </div>

                <!-- PHP -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-indigo-400/50 hover:bg-indigo-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-indigo-100 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- PHP Official SVG Logo -->
                        <svg class="w-8 h-8" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                            <path d="M64 33.039c-33.74 0-61.094 13.862-61.094 30.961S30.26 94.961 64 94.961 125.094 81.099 125.094 64 97.74 33.039 64 33.039zm-14.552 33.09l-1.44 7.935H40.68l5.44-29.881h15.28c6.69 0 10.348 3.23 10.348 8.732 0 7.571-5.393 13.214-13.3 13.214zm40.788 0l-1.44 7.935H81.47l5.44-29.881h15.28c6.69 0 10.35 3.23 10.35 8.732 0 7.571-5.394 13.214-13.304 13.214zm-57.2-4.208h5.485c3.15 0 5.045-1.62 5.045-4.482 0-1.91-1.26-2.934-3.732-2.934h-4.99l-1.808 7.416zm40.788 0h5.485c3.15 0 5.047-1.62 5.047-4.482 0-1.91-1.262-2.934-3.733-2.934h-4.99l-1.809 7.416z" fill="#777BB3"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">PHP 8.2+</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Core Language</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. DEDICATION & BACK TO HOME CTA -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-20">
        <div class="rounded-3xl bg-slate-950 text-white p-8 sm:p-12 lg:p-14 relative overflow-hidden shadow-xl border border-slate-800 text-center">
            <!-- Glow background -->
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-teal-600/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-2xl mx-auto space-y-5">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mx-auto border border-emerald-500/30">
                    <i data-lucide="code-2" class="w-6 h-6"></i>
                </div>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-white tracking-tight">
                    Mendukung Pariwisata Pangandaran Menuju Era Digital
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Website ini didedikasikan untuk kemudahan wisatawan menjelajahi keindahan alam Pangandaran sekaligus mendukung pelaku biro perjalanan lokal CV Puja Tour & Travel dalam menyajikan layanan terbaik dan terpercaya.
                </p>
                <div class="pt-2 flex flex-wrap justify-center gap-3.5">
                    <a href="{{ route('home') }}" 
                       class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Kembali ke Beranda</span>
                    </a>
                    <a href="{{ route('packages.index') }}" 
                       class="px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                        <i data-lucide="compass" class="w-4 h-4"></i>
                        <span>Eksplor Paket Wisata</span>
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
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>
