<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Katalog Paket Wisata Pangandaran Terlengkap — Puja Tour & Travel</title>
    <meta name="description" content="Pilihan paket wisata Pangandaran terlengkap: Body Rafting Green Canyon, Snorkeling Pasir Putih, River Tubing Santirah, dan Gathering Corporate.">
    <meta name="keywords" content="paket wisata Pangandaran, body rafting Green Canyon, snorkeling Pasir Putih, river tubing Santirah, tour Pangandaran murah, harga wisata Pangandaran">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Katalog Paket Wisata Pangandaran Terlengkap — Puja Tour & Travel">
    <meta property="og:description" content="Pilihan paket wisata Pangandaran terlengkap: Body Rafting Green Canyon, Snorkeling Pasir Putih, River Tubing Santirah, dan Gathering Corporate.">
    <meta property="og:image" content="{{ asset('images/greencanyon.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Katalog Paket Wisata Pangandaran Terlengkap — Puja Tour & Travel">
    <meta name="twitter:description" content="Pilihan paket wisata Pangandaran terlengkap: Body Rafting Green Canyon, Snorkeling Pasir Putih, River Tubing Santirah, dan Gathering Corporate.">
    <meta name="twitter:image" content="{{ asset('images/greencanyon.jpg') }}">

    <!-- Structured Data (JSON-LD): ItemList — enables Google product carousel -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Paket Wisata Pangandaran — Puja Tour Travel',
        'description' => 'Katalog lengkap paket wisata Pangandaran dari Puja Tour & Travel.',
        'url' => url()->current(),
        'numberOfItems' => $packages->total(),
        'itemListElement' => $packages->map(function ($pkg, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'url' => route('packages.show', $pkg->slug),
                'name' => $pkg->name,
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
                'name' => 'Paket Wisata',
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

    <!-- Vite Assets -->
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
        $currentCategory = request('category', 'all');
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

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-7 font-medium text-slate-600 text-sm">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="text-emerald-700 font-semibold hover:text-emerald-800 transition">Paket Wisata</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-700 transition">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="hover:text-emerald-700 transition">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="hover:text-emerald-700 transition">FAQ</a>
                <a href="{{ route('gallery') }}" class="hover:text-emerald-700 transition">Galeri</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak</a>
            </nav>



            <!-- Mobile Home Link -->
            <div class="flex items-center gap-2 lg:hidden">
                <a href="{{ route('home') }}" class="p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition">
                    <i data-lucide="home" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- BREADCRUMB -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition flex items-center gap-1">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                <span>Beranda</span>
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-semibold">Semua Paket Wisata</span>
        </nav>
    </div>

    <!-- CATALOG HEADER -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-8">
        <div class="bg-surface-soft rounded-3xl p-8 sm:p-12 shadow-soft border border-neutral-200 text-center relative overflow-hidden">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                Katalog Lengkap
            </span>
            <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 mt-3 tracking-tight">
                Pilihan Paket Wisata Pangandaran
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-2xl mx-auto">
                Temukan petualangan air tawar, pantai, surfing, hingga gathering eksklusif dengan harga transparan dan pemandu bersertifikasi resmi HPI.
            </p>

            <!-- Search and Filter Form -->
            <form action="{{ route('packages.index') }}" method="GET" class="mt-8 max-w-2xl mx-auto flex flex-col sm:flex-row items-center gap-3">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="w-full flex-1 flex items-center gap-2 bg-white px-3 py-2 rounded-2xl border border-neutral-200 shadow-sm focus-within:ring-2 focus-within:ring-emerald-700 transition">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                    <input type="text" name="search" maxlength="100" value="{{ $search ?? request('search') }}" placeholder="Cari Green Canyon, Snorkeling, Rafting..." class="w-full text-xs sm:text-sm text-slate-800 placeholder-slate-400 outline-none bg-transparent">
                    @if($search)
                        <a href="{{ route('packages.index', ['category' => request('category'), 'sort' => request('sort')]) }}" title="Hapus pencarian" class="p-1 text-slate-400 hover:text-slate-600">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </a>
                    @endif
                </div>

                <div class="w-full sm:w-auto flex items-center gap-2">
                    <select name="sort" onchange="this.form.submit()" class="px-3.5 py-2.5 rounded-xl border border-neutral-200 bg-white text-slate-800 text-xs font-medium focus:ring-2 focus:ring-emerald-700 outline-none transition shadow-sm">
                        <option value="latest" {{ ($sort ?? request('sort')) === 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="popular" {{ ($sort ?? request('sort')) === 'popular' ? 'selected' : '' }}>Rekomendasi</option>
                        <option value="price_asc" {{ ($sort ?? request('sort')) === 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                        <option value="price_desc" {{ ($sort ?? request('sort')) === 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                    </select>

                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition shadow-sm whitespace-nowrap">
                        Cari Paket
                    </button>
                </div>
            </form>

            @if($categoryNotFound)
                <div class="mt-4 max-w-lg mx-auto p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-amber-600 shrink-0"></i>
                        <span>Kategori yang Anda pilih tidak tersedia. Silakan pilih kategori resmi di bawah:</span>
                    </div>
                    <a href="{{ route('packages.index') }}" class="font-bold underline shrink-0 hover:text-amber-950">Lihat Semua</a>
                </div>
            @endif

            @if($search)
                <div class="mt-4 flex items-center justify-center gap-2 text-xs text-slate-500">
                    <span>Hasil pencarian untuk: <strong class="text-slate-800">"{{ $search }}"</strong></span>
                    <a href="{{ route('packages.index', ['category' => request('category'), 'sort' => request('sort')]) }}" class="text-emerald-700 hover:underline font-bold inline-flex items-center gap-1">
                        <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
                        <span>Hapus Filter</span>
                    </a>
                </div>
            @endif

            <!-- Category Filter Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mt-6">
                <a href="{{ route('packages.index', ['search' => $search, 'sort' => request('sort')]) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-semibold transition {{ ($categorySlug ?? 'all') === 'all' ? 'bg-emerald-700 text-white shadow-sm' : 'bg-canvas text-slate-600 hover:bg-neutral-200 border border-neutral-200' }}">
                    Semua ({{ \App\Models\Package::where('status', 'PUBLISHED')->count() }})
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('packages.index', ['category' => $cat->slug, 'search' => $search, 'sort' => request('sort')]) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-semibold transition {{ ($categorySlug ?? '') === $cat->slug ? 'bg-emerald-700 text-white shadow-sm' : 'bg-canvas text-slate-600 hover:bg-neutral-200 border border-neutral-200' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PACKAGES GRID -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        @if($packages->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $pkg)
                    <div class="package-card flex flex-col bg-surface-soft rounded-3xl overflow-hidden shadow-soft hover:shadow-card-hover transition-all duration-300 border border-neutral-200 group">
                        <div class="relative h-60 overflow-hidden bg-neutral-100">
                            <img src="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $pkg->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-4 left-4">
                                @if($pkg->featured)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500 text-slate-950 shadow-sm flex items-center gap-1">
                                        <i data-lucide="star" class="w-3 h-3 fill-slate-950"></i>
                                        <span>Rekomendasi</span>
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-700 text-white shadow-sm">
                                        {{ $pkg->category->name ?? 'Wisata' }}
                                    </span>
                                @endif
                            </div>
                            @if($pkg->duration)
                                <div class="absolute bottom-4 right-4">
                                    <span class="px-3 py-1 rounded-xl text-xs font-bold bg-slate-900/90 text-white flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-emerald-400"></i>
                                        <span>{{ $pkg->duration }}</span>
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1.5 text-xs font-semibold text-emerald-700 mb-1">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                    <span>{{ $pkg->location ?? 'Pangandaran' }}</span>
                                </div>
                                <h3 class="font-display font-bold text-xl text-slate-900 group-hover:text-emerald-700 transition">
                                    <a href="{{ route('packages.show', $pkg->slug) }}">
                                        {{ $pkg->name }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                    {{ $pkg->short_description ?? 'Petualangan eksotis bersama Puja Tour & Travel Pangandaran.' }}
                                </p>

                                <!-- Facilities Badge -->
                                @if(is_array($pkg->inclusions) && count($pkg->inclusions) > 0)
                                    <div class="flex flex-wrap gap-1.5 mt-4">
                                        @foreach(array_slice($pkg->inclusions, 0, 3) as $inc)
                                            <span class="text-[11px] bg-neutral-100 text-slate-700 px-2 py-0.5 rounded-md flex items-center gap-1">
                                                <i data-lucide="check" class="w-3 h-3 text-emerald-700"></i>
                                                <span>{{ $inc }}</span>
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="pt-5 mt-5 border-t border-neutral-200 flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] text-slate-400 block font-medium">Mulai dari</span>
                                    <span class="font-display font-bold text-xl text-emerald-700">{{ $pkg->formatted_price }}</span>
                                    <span class="text-xs text-slate-400">/ {{ $pkg->price_unit }}</span>
                                </div>
                                <a href="{{ route('packages.show', $pkg->slug) }}" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-emerald-700 text-white font-semibold text-xs transition flex items-center gap-1.5 shadow-sm">
                                    <span>Baca Selengkapnya</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $packages->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-surface-soft rounded-3xl border border-neutral-200">
                <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="search-x" class="w-8 h-8"></i>
                </div>
                <h3 class="font-display font-bold text-xl text-slate-900">Tidak Ada Paket yang Sesuai</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-md mx-auto">
                    Coba ubah kata kunci pencarian atau pilih kategori paket wisata lainnya.
                </p>
                <div class="mt-6">
                    <a href="{{ route('packages.index') }}" class="px-5 py-2.5 rounded-xl bg-emerald-700 text-white font-bold text-xs hover:bg-emerald-800 transition">
                        Reset Filter & Pencarian
                    </a>
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
                        @if(!request()->routeIs('home'))
                            <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        @endif
                        @if(!request()->routeIs('packages.index'))
                            <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Semua Paket Wisata</a></li>
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

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20katalog%20paket%20wisata%20Pangandaran" 
       target="_blank" 
       aria-label="Hubungi WhatsApp Puja Tour"
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center group">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

</body>
</html>
