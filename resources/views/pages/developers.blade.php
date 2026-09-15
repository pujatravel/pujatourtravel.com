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

    {{-- Geo & Local SEO Tags --}}
    <meta name="geo.region" content="ID-JB">
    <meta name="geo.placename" content="Pangandaran">
    <meta name="geo.position" content="-7.697500;108.652500">
    <meta name="ICBM" content="-7.697500, 108.652500">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour & Travel Pangandaran">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('developers') }}">
    <meta property="og:title" content="Tim Pengembang — Di Balik Layar Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Mengenal tim pengembang di balik platform digital resmi Puja Tour & Travel Pangandaran. Dibangun oleh talenta muda PPLG dengan standar rekayasa perangkat lunak modern.">
    <meta property="og:image" content="{{ asset('images/og_image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Tim Pengembang — Di Balik Layar Puja Tour & Travel Pangandaran">
    <meta name="twitter:description" content="Profil pengembang sistem di balik platform digital resmi Puja Tour & Travel Pangandaran.">
    <meta name="twitter:image" content="{{ asset('images/og_image.jpg') }}">

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
                'item' => route('developers'),
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
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white pt-20 sm:pt-24">

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
        <div data-nav-color="dark" class="relative rounded-3xl overflow-hidden bg-slate-950 text-white shadow-xl border border-slate-800/80">
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
                                 decoding="async"
                                 width="80"
                                 height="80"
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
                <!-- 1. Laravel 11 -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-rose-400/50 hover:bg-rose-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-rose-50 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Official Laravel Logo (Devicon) -->
                        <svg class="w-7 h-7" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#f0513f" d="M27.271.11c-.2.078-5.82 3.28-12.487 7.112-8.078 4.644-12.227 7.09-12.449 7.32-.19.225-.34.482-.438.76-.167.564-.179 82.985-.01 83.578.061.23.26.568.44.754.436.46 48.664 28.19 49.25 28.324.272.065.577.054.88-.03.658-.165 48.76-27.834 49.188-28.286.175-.195.375-.532.44-.761.084-.273.115-4.58.115-13.655v-13.26l11.726-6.735c11.056-6.357 11.733-6.755 12.017-7.191l.29-.47V43.287c0-15.548.03-14.673-.585-15.235-.165-.146-5.798-3.433-12.53-7.31L100.89 13.71h-1.359l-11.963 6.87c-6.586 3.788-12.184 7.027-12.457 7.203-.272.18-.597.512-.73.753l-.242.417-.054 13.455-.048 13.46-9.879 5.69c-5.434 3.124-9.957 5.71-10.053 5.734-.175.049-.187-1.232-.187-25.966V15.293l-.26-.447c-.326-.545 1.136.324-13.544-8.114C27.803-.348 28.098-.2 27.27.11zm11.317 10.307c5.15 2.955 9.364 5.4 9.364 5.43 0 .031-4.516 2.641-10.035 5.813l-10.041 5.765-10.023-5.764c-5.507-3.173-10.02-5.783-10.02-5.814 0-.03 4.505-2.64 10.013-5.805l9.999-5.752.69.376c3.357 1.907 6.708 3.824 10.053 5.751zm71.668 13.261c5.422 3.122 9.908 5.702 9.95 5.744.114.103-19.774 11.535-20.046 11.523-.272-.008-19.915-11.335-19.907-11.473.01-.157 19.773-11.527 19.973-11.496.091.022 4.607 2.59 10.03 5.702zM16.3 25.328l9.558 5.503.055 27.247.05 27.252.233.368c.122.194.352.459.52.581.158.115 5.477 3.146 11.818 6.724l11.52 6.506v11.527c0 6.326-.043 11.516-.097 11.516-.041 0-10-5.699-22.124-12.676L5.793 97.201l-.03-38.966-.019-38.954.49.271c.283.15 4.807 2.748 10.065 5.775zm33.754 19.18v25.109l-.387.253c-.525.332-19.667 11.335-19.732 11.335-.03 0-.054-11.336-.054-25.193l.012-25.182 10-5.752c5.499-3.165 10.034-5.733 10.088-5.714.039.024.073 11.34.073 25.144zm38.15-5.775 10.023 5.763V55.92c0 10.838-.011 11.42-.176 11.357-.107-.041-4.642-2.64-10.083-5.774l-9.91-5.69v-11.42c0-6.287.032-11.424.062-11.424.043 0 4.577 2.592 10.084 5.764zm34.164 5.587c0 6.254-.042 11.412-.084 11.462-.072.115-19.896 11.538-20.022 11.538-.031 0-.062-5.135-.062-11.423v-11.42l10-5.756c5.507-3.16 10.042-5.752 10.084-5.752.053 0 .084 5.105.084 11.351zM95.993 70.933 52.005 96.04 32.056 84.693S76 59.277 76.176 59.343zm2.215 14.827-.034 11.442-22.028 12.676c-12.12 6.976-22.082 12.675-22.132 12.675-.053 0-.095-4.658-.095-11.516V99.51l22.08-12.592c12.132-6.923 22.101-12.59 22.154-12.602.043 0 .062 5.148.054 11.443z"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">Laravel 11</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Backend Core & MVC</p>
                </div>

                <!-- 2. Tailwind CSS -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-cyan-400/50 hover:bg-cyan-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-cyan-50 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Official Tailwind CSS Logo (Devicon) -->
                        <svg class="w-7 h-7" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                            <path d="M64.004 25.602c-17.067 0-27.73 8.53-32 25.597 6.398-8.531 13.867-11.73 22.398-9.597 4.871 1.214 8.352 4.746 12.207 8.66C72.883 56.629 80.145 64 96.004 64c17.066 0 27.73-8.531 32-25.602-6.399 8.536-13.867 11.735-22.399 9.602-4.87-1.215-8.347-4.746-12.207-8.66-6.27-6.367-13.53-13.738-29.394-13.738zM32.004 64c-17.066 0-27.73 8.531-32 25.602C6.402 81.066 13.87 77.867 22.402 80c4.871 1.215 8.352 4.746 12.207 8.66 6.274 6.367 13.536 13.738 29.395 13.738 17.066 0 27.73-8.53 32-25.597-6.399 8.531-13.867 11.73-22.399 9.597-4.87-1.214-8.347-4.746-12.207-8.66C55.128 71.371 47.868 64 32.004 64zm0 0" fill="#06B6D4"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">Tailwind CSS</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Modern UI Styling</p>
                </div>

                <!-- 3. MySQL -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-sky-400/50 hover:bg-sky-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-sky-50 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Official MySQL Dolphin "Sakila" Logo (Devicon) -->
                        <svg class="w-8 h-8" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#00618A" d="M117.688 98.242c-6.973-.191-12.297.461-16.852 2.379-1.293.547-3.355.559-3.566 2.18.711.746.82 1.859 1.387 2.777 1.086 1.754 2.922 4.113 4.559 5.352 1.789 1.348 3.633 2.793 5.551 3.961 3.414 2.082 7.223 3.27 10.504 5.352 1.938 1.23 3.859 2.777 5.75 4.164.934.684 1.563 1.75 2.773 2.18v-.195c-.637-.812-.801-1.93-1.387-2.777l-2.578-2.578c-2.52-3.344-5.719-6.281-9.117-8.719-2.711-1.949-8.781-4.578-9.91-7.73l-.199-.199c1.922-.219 4.172-.914 5.949-1.391 2.98-.797 5.645-.59 8.719-1.387l4.164-1.187v-.793c-1.555-1.594-2.664-3.707-4.359-5.152-4.441-3.781-9.285-7.555-14.273-10.703-2.766-1.746-6.184-2.883-9.117-4.363-.988-.496-2.719-.758-3.371-1.586-1.539-1.961-2.379-4.449-3.566-6.738-2.488-4.793-4.93-10.023-7.137-15.066-1.504-3.437-2.484-6.828-4.359-9.91-9-14.797-18.687-23.73-33.695-32.508-3.195-1.867-7.039-2.605-11.102-3.57l-6.543-.395c-1.332-.555-2.715-2.184-3.965-2.977C16.977 3.52 4.223-3.312.539 5.672-1.785 11.34 4.016 16.871 6.09 19.746c1.457 2.012 3.32 4.273 4.359 6.539.688 1.492.805 2.984 1.391 4.559 1.438 3.883 2.695 8.109 4.559 11.695.941 1.816 1.98 3.727 3.172 5.352.727.996 1.98 1.438 2.18 2.973-1.227 1.715-1.297 4.375-1.984 6.543-3.098 9.77-1.926 21.91 2.578 29.137 1.383 2.223 4.641 6.98 9.117 5.156 3.918-1.598 3.043-6.539 4.164-10.902.254-.988.098-1.715.594-2.379v.199l3.57 7.133c2.641 4.254 7.324 8.699 11.297 11.699 2.059 1.555 3.68 4.242 6.344 5.152v-.199h-.199c-.516-.805-1.324-1.137-1.98-1.781-1.551-1.523-3.277-3.414-4.559-5.156-3.613-4.902-6.805-10.27-9.711-15.855-1.391-2.668-2.598-5.609-3.77-8.324-.453-1.047-.445-2.633-1.387-3.172-1.281 1.988-3.172 3.598-4.164 5.945-1.582 3.754-1.789 8.336-2.375 13.082-.348.125-.195.039-.398.199-2.762-.668-3.73-3.508-4.758-5.949-2.594-6.164-3.078-16.09-.793-23.191.59-1.836 3.262-7.617 2.18-9.316-.516-1.691-2.219-2.672-3.172-3.965-1.18-1.598-2.355-3.703-3.172-5.551-2.125-4.805-3.113-10.203-5.352-15.062-1.07-2.324-2.875-4.676-4.359-6.738-1.645-2.289-3.484-3.977-4.758-6.742-.453-.984-1.066-2.559-.398-3.566.215-.684.516-.969 1.191-1.191 1.148-.887 4.352.297 5.547.793 3.18 1.32 5.832 2.578 8.527 4.363 1.289.855 2.598 2.512 4.16 2.973h1.785c2.789.641 5.914.195 8.523.988 4.609 1.402 8.738 3.582 12.488 5.949 11.422 7.215 20.766 17.48 27.156 29.734 1.027 1.973 1.473 3.852 2.379 5.945 1.824 4.219 4.125 8.559 5.941 12.688 1.816 4.113 3.582 8.27 6.148 11.695 1.348 1.801 6.551 2.766 8.918 3.766 1.66.699 4.379 1.43 5.949 2.379 3 1.809 5.906 3.965 8.723 5.945 1.402.992 5.73 3.168 5.945 4.957zm-88.605-75.52c-1.453-.027-2.48.156-3.566.395v.199h.195c.695 1.422 1.918 2.34 2.777 3.566l1.98 4.164.199-.195c1.227-.867 1.789-2.25 1.781-4.363-.492-.52-.562-1.164-.992-1.785-.562-.824-1.66-1.289-2.375-1.98zm0 0"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">MySQL</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Database Relasional</p>
                </div>

                <!-- 4. Blade Templates -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-amber-400/50 hover:bg-amber-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-amber-50 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Laravel Blade Templating Engine Mark -->
                        <svg class="w-7 h-7" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="8" fill="url(#blade-grad)"/>
                            <defs>
                                <linearGradient id="blade-grad" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#F59E0B"/>
                                    <stop offset="1" stop-color="#D97706"/>
                                </linearGradient>
                            </defs>
                            <path d="M11.5 9.5c-1.5 0-2.5 1-2.5 2.5v2c0 1.5-.8 2-2 2 1.2 0 2 .5 2 2v2c0 1.5 1 2.5 2.5 2.5" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.5 9.5c1.5 0 2.5 1 2.5 2.5v2c0 1.5.8 2 2 2-1.2 0-2 .5-2 2v2c0 1.5-1 2.5-2.5 2.5" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.5 13l3 6" stroke="#FEF3C7" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">Blade Templates</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Dynamic Templating</p>
                </div>

                <!-- 5. Vite Bundler -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-purple-400/50 hover:bg-purple-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-purple-50 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Official Vite Logo (Devicon) -->
                        <svg class="w-7 h-7" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="vite-grad-a" x1="6" x2="235" y1="33" y2="344" gradientTransform="translate(0 .937) scale(.3122)" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#41d1ff"/>
                                    <stop offset="1" stop-color="#bd34fe"/>
                                </linearGradient>
                                <linearGradient id="vite-grad-b" x1="194.651" x2="236.076" y1="8.818" y2="292.989" gradientTransform="translate(0 .937) scale(.3122)" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#ffea83"/>
                                    <stop offset=".083" stop-color="#ffdd35"/>
                                    <stop offset="1" stop-color="#ffa800"/>
                                </linearGradient>
                            </defs>
                            <path fill="url(#vite-grad-a)" d="M124.766 19.52 67.324 122.238c-1.187 2.121-4.234 2.133-5.437.024L3.305 19.532c-1.313-2.302.652-5.087 3.261-4.622L64.07 25.187a3.09 3.09 0 0 0 1.11 0l56.3-10.261c2.598-.473 4.575 2.289 3.286 4.594Z"/>
                            <path fill="url(#vite-grad-b)" d="M91.46 1.43 48.954 9.758a1.56 1.56 0 0 0-1.258 1.437l-2.617 44.168a1.563 1.563 0 0 0 1.91 1.614l11.836-2.735a1.562 1.562 0 0 1 1.88 1.836l-3.517 17.219a1.562 1.562 0 0 0 1.985 1.805l7.308-2.223c1.133-.344 2.223.652 1.985 1.812l-5.59 27.047c-.348 1.692 1.902 2.614 2.84 1.164l.625-.968 34.64-69.13c.582-1.16-.421-2.48-1.69-2.234l-12.185 2.352a1.558 1.558 0 0 1-1.793-1.965l7.95-27.562A1.56 1.56 0 0 0 91.46 1.43Z"/>
                        </svg>
                    </div>
                    <h4 class="font-display font-bold text-sm text-slate-900">Vite Bundler</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Asset Pipeline</p>
                </div>

                <!-- 6. PHP 8.2+ -->
                <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:border-indigo-400/50 hover:bg-indigo-50/20 transition-all duration-300 group">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-indigo-50 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                        <!-- Official PHP Oval Logo (Devicon) -->
                        <svg class="w-8 h-8" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <radialGradient id="php-grad" cx="0" cy="0" r="1" gradientTransform="matrix(84.04136 0 0 84.04136 38.426 42.169)" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#AEB2D5"/>
                                    <stop offset=".3" stop-color="#AEB2D5"/>
                                    <stop offset=".75" stop-color="#484C89"/>
                                    <stop offset="1" stop-color="#484C89"/>
                                </radialGradient>
                            </defs>
                            <path fill="url(#php-grad)" d="M0 64c0 18.593 28.654 33.667 64 33.667 35.346 0 64-15.074 64-33.667 0-18.593-28.655-33.667-64-33.667C28.654 30.333 0 45.407 0 64Z"/>
                            <path fill="#777bb3" d="M64 95.167c33.965 0 61.5-13.955 61.5-31.167 0-17.214-27.535-31.167-61.5-31.167S2.5 46.786 2.5 64c0 17.212 27.535 31.167 61.5 31.167Z"/>
                            <path fill="#ffffff" d="M26.731 47.726a1.39 1.39 0 0 0-1.364 1.123L18.81 82.588a1.39 1.39 0 0 0 1.363 1.653h7.35a1.39 1.39 0 0 0 1.363-1.124l1.525-7.846h5.151c2.912 0 5.364-.318 7.287-.944 1.977-.642 3.796-1.731 5.406-3.237a16.522 16.522 0 0 0 3.259-4.087c.831-1.487 1.429-3.147 1.775-4.931.86-4.423.161-7.964-2.076-10.524-2.216-2.537-5.698-3.823-10.349-3.823H26.731zm7.459 8.1h3.891c3.107 0 4.186.682 4.553 1.089.607.674.723 2.097.331 4.112-.439 2.257-1.253 3.858-2.42 4.756-1.194.92-3.138 1.386-5.773 1.386h-2.786l2.204-11.343zm23.83-8.1h-7.291a1.39 1.39 0 0 0-1.364 1.124l-6.557 33.738a1.39 1.39 0 0 0 1.363 1.654h7.291a1.39 1.39 0 0 0 1.364-1.124l3.537-18.205h4.682c2.168 0 2.624.463 2.641.484.132.14.305.795.019 2.264l-2.9 14.927a1.39 1.39 0 0 0 1.364 1.654h7.408a1.39 1.39 0 0 0 1.363-1.124l3.051-15.7c.715-3.686.103-6.45-1.82-8.217-1.836-1.686-4.91-2.505-9.398-2.505h-4.81l1.421-7.315a1.39 1.39 0 0 0-1.364-1.655zm17.439 0H84.096a1.39 1.39 0 0 0-1.363 1.123l-6.558 33.739a1.39 1.39 0 0 0 1.364 1.653h7.35a1.39 1.39 0 0 0 1.363-1.124l1.525-7.846h5.15c2.911 0 5.364-.318 7.286-.944 1.978-.642 3.797-1.731 5.408-3.238a16.52 16.52 0 0 0 3.258-4.086c.832-1.487 1.428-3.147 1.775-4.931.86-4.423.162-7.964-2.076-10.524-2.216-2.537-5.697-3.823-10.35-3.823h-1.657zm7.459 8.1h3.891c3.107 0 4.186.682 4.552 1.089.61.674.724 2.097.333 4.112-.44 2.257-1.254 3.858-2.421 4.756-1.195.92-3.139 1.386-5.773 1.386h-2.786l2.204-11.343z"/>
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
        <div data-nav-color="dark" class="rounded-3xl bg-slate-950 text-white p-8 sm:p-12 lg:p-14 relative overflow-hidden shadow-xl border border-slate-800 text-center">
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
