<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Kontak & Lokasi Kantor — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="Hubungi kantor resmi Puja Tour & Travel Pangandaran. WhatsApp hotline 24 jam, alamat kantor operasional, dan petunjuk arah lokasi.">
    <meta name="keywords" content="kontak Puja Tour Travel, WhatsApp Puja Tour, alamat kantor wisata Pangandaran, lokasi biro travel Pangandaran, hubungi tour guide Pangandaran">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Kontak & Lokasi Kantor — Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Hubungi kantor resmi Puja Tour & Travel Pangandaran. WhatsApp hotline 24 jam, alamat kantor operasional, dan petunjuk arah lokasi.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Kontak & Lokasi Kantor — Puja Tour & Travel Pangandaran">
    <meta name="twitter:description" content="Hubungi kantor resmi Puja Tour & Travel Pangandaran. WhatsApp hotline 24 jam, alamat kantor operasional, dan petunjuk arah lokasi.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): TravelAgency -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => 'Puja Tour Travel',
        'description' => 'Biro perjalanan wisata resmi di Pangandaran yang menyediakan paket tur Green Canyon, body rafting, dan wisata bahari.',
        'url' => url('/'),
        'telephone' => $settings['phone_number'] ?? '+6281234567890',
        'email' => $settings['email_address'] ?? 'info@pujatourtravel.com',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $settings['office_address'] ?? 'Jl. Pantai Barat No. 88',
            'addressLocality' => 'Pangandaran',
            'addressRegion' => 'Jawa Barat',
            'postalCode' => '46396',
            'addressCountry' => 'ID',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '-7.697500',
            'longitude' => '108.652500',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
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
                'name' => 'Kontak',
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
        $opHours = $settings['operational_hours'] ?? 'Setiap Hari: 06.00 - 21.00 WIB';
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
                <a href="{{ route('contact') }}" class="text-emerald-700 font-semibold hover:text-emerald-800 transition">Kontak</a>
            </nav>



            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Drawer -->
    <div id="drawer-overlay" class="fixed inset-0 bg-slate-900/60 z-50 hidden opacity-0 transition-opacity duration-300"></div>
    <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-4/5 max-w-sm bg-surface-soft border-l border-neutral-200 z-50 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col justify-between p-6 invisible pointer-events-none">
        <div>
            <div class="flex items-center justify-between pb-6 border-b border-neutral-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="font-display font-extrabold text-base text-slate-900">PUJA TOUR</span>
                </div>
                <button id="close-menu-btn" class="p-2 text-slate-500 hover:bg-neutral-100 rounded-xl">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <nav class="py-6 space-y-1 text-sm font-medium">
                <a href="{{ route('home') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Beranda</a>
                <a href="{{ route('packages.index') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Paket Wisata</a>
                <a href="{{ route('about') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">FAQ</a>
                <a href="{{ route('gallery') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Galeri</a>
                <a href="{{ route('contact') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl bg-emerald-50 text-emerald-700 font-bold">Kontak</a>
            </nav>
        </div>
    </div>

    <!-- BREADCRUMBS -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition flex items-center gap-1">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                <span>Beranda</span>
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-semibold">Kontak & Lokasi Kantor</span>
        </nav>
    </div>

    <!-- MAIN CONTACT CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-20">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                Layanan Pelanggan
            </span>
            <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 mt-3 tracking-tight">
                Hubungi Kami & Kunjungi Kantor
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Siap merencanakan liburan impian? Hubungi tim reservasi kami untuk konsultasi rute, penjemputan, atau kunjungi kantor operasional kami di Pantai Barat Pangandaran.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Contact Cards & Info (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                <!-- 1. Alamat Kantor Card -->
                <div class="bg-surface-soft rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                        <i data-lucide="map-pin" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-base text-slate-900">Kantor Operasional</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">{{ $officeAddr }}</p>
                        <span class="inline-block mt-2 text-[11px] font-bold text-emerald-700">Strategis &bull; Akses Dekat Pantai Barat</span>
                    </div>
                </div>

                <!-- 2. WhatsApp Hotline Card -->
                <div class="bg-surface-soft rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                        <i data-lucide="phone-call" class="w-6 h-6"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-display font-bold text-base text-slate-900">Hotline & WhatsApp</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Respons cepat dalam hitungan menit</p>
                        <a href="https://wa.me/{{ $waNum }}" target="_blank" class="text-base sm:text-lg font-display font-extrabold text-emerald-700 hover:text-emerald-800 transition block mt-1">
                            {{ $phoneNum }}
                        </a>
                        <span class="text-[11px] text-slate-400 block mt-0.5">{{ $opHours }}</span>
                    </div>
                </div>

                <!-- 3. Email & Penawaran Kedinasan -->
                <div class="bg-surface-soft rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                        <i data-lucide="mail" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-base text-slate-900">Surat & Proposal Gathering</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Permintaan penawaran resmi, SPK, dan faktur</p>
                        <a href="mailto:{{ $emailAddr }}" class="text-sm font-semibold text-slate-800 hover:text-emerald-700 transition block mt-1">
                            {{ $emailAddr }}
                        </a>
                    </div>
                </div>

                <!-- 4. Legalitas Resmi CV Box -->
                <div class="bg-slate-900 text-white rounded-3xl p-6 shadow-md space-y-2.5 text-xs">
                    <div class="flex items-center gap-2 font-bold text-emerald-400">
                        <i data-lucide="badge-check" class="w-4 h-4"></i>
                        <span>Legalitas Badan Usaha Resmi:</span>
                    </div>
                    <p class="text-slate-300 leading-relaxed text-[11px]">
                        <strong>CV PUJA TOUR PANGANDARAN</strong><br>
                        NIB: 1209210088891 &bull; TDUP Pariwisata Terdaftar<br>
                        Pemandu: Himpunan Pramuwisata Indonesia (HPI) DPC Pangandaran
                    </p>
                </div>
            </div>

            <!-- Interactive Direct Message to WA Form (7 cols) -->
            <div class="lg:col-span-7 bg-surface-soft rounded-3xl p-6 sm:p-10 shadow-soft border border-neutral-200">
                <div class="pb-5 border-b border-neutral-200 mb-6">
                    <h2 class="font-display font-bold text-2xl text-slate-900">Kirim Pesan & Permintaan Khusus</h2>
                    <p class="text-xs text-slate-500 mt-1">Isi formulir di bawah ini untuk terhubung langsung ke WhatsApp Customer Support kami.</p>
                </div>

                <form id="contact-form" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Nama Lengkap *</label>
                            <input type="text" id="msg-name" required placeholder="Contoh: Hendra Wijaya" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Jenis Permintaan *</label>
                            <select id="msg-topic" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                                <option value="Konsultasi Paket Wisata">Konsultasi Paket Wisata</option>
                                <option value="Corporate / Family Gathering">Corporate / Family Gathering (Rombongan)</option>
                                <option value="Body Rafting Green Canyon">Body Rafting Green Canyon</option>
                                <option value="Snorkeling & Wisata Bahari">Snorkeling & Wisata Bahari</option>
                                <option value="Kebutuhan Bus / Transport">Kebutuhan Bus / Transportasi</option>
                                <option value="Custom Itinerary Pangandaran">Custom Itinerary Pangandaran</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Estimasi Jumlah Tamu</label>
                            <input type="text" id="msg-pax" placeholder="Contoh: 10 Orang / Fleksibel" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Rencana Tanggal (Opsional)</label>
                            <input type="date" id="msg-date" min="{{ date('Y-m-d') }}" placeholder="Pilih tanggal trip (opsional)..." class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition custom-datepicker-input">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Pesan atau Pertanyaan Anda *</label>
                        <textarea id="msg-content" rows="4" required placeholder="Tuliskan detail rencana liburan, kebutuhan khusus, atau pertanyaan Anda..." class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition"></textarea>
                    </div>

                    <!-- Auto-composed Notification Notice -->
                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs">
                        <i data-lucide="sparkles" class="w-4 h-4 text-emerald-700 shrink-0"></i>
                        <span>Pesan Anda akan otomatis terformat rapi dan langsung terketik di WhatsApp Admin, tinggal Anda kirim!</span>
                    </div>

                    <button type="submit" class="w-full py-4 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        <span>Kirim Pesan Otomatis ke WhatsApp CS</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Dynamic Google Maps Section -->
        <div class="mt-12 bg-surface-soft rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="font-display font-bold text-xl sm:text-2xl text-slate-900">Peta Navigasi & Lokasi Kantor</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Temukan kantor operasional kami di Google Maps untuk panduan rute perjalanan.</p>
                </div>
                <a href="{{ $settings['google_maps_url'] ?? 'https://maps.google.com/?q=-7.6974127,108.6477546' }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-50 text-emerald-800 hover:bg-emerald-100 font-bold text-xs border border-emerald-200 transition shrink-0">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    <span>Buka di Google Maps</span>
                </a>
            </div>

            <div class="rounded-2xl overflow-hidden shadow-inner border border-neutral-200 bg-slate-100 h-80 sm:h-96 relative">
                <iframe 
                    title="Lokasi Kantor Puja Tour & Travel Pangandaran"
                    src="{{ $settings['google_maps_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.739775073105!2d108.6477546!3d-7.6974127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6598c19958348b%3A0x6b45f949c256ca61!2sPantai%20Pangandaran!5e0!3m2!1sid!2sid!4v1709800000000!5m2!1sid!2sid' }}" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-full">
                </iframe>
            </div>
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

    <!-- Form WhatsApp Redirect Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('contact-form');
            if (form) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const name = document.getElementById('msg-name').value.trim();
                    const topic = document.getElementById('msg-topic').value;
                    const pax = document.getElementById('msg-pax').value.trim() || 'Fleksibel';
                    const dateInput = document.getElementById('msg-date');
                    const altDate = dateInput?.parentElement?.querySelector('.flatpickr-input[type="text"]');
                    const dateVal = altDate && altDate.value ? altDate.value : (dateInput && dateInput.value ? dateInput.value : '');
                    const content = document.getElementById('msg-content').value.trim();

                    if (!name || name.length < 2) {
                        alert('Mohon masukkan nama lengkap Anda terlebih dahulu.');
                        document.getElementById('msg-name').focus();
                        return;
                    }

                    if (!content || content.length < 2) {
                        alert('Mohon tuliskan pesan atau pertanyaan Anda.');
                        document.getElementById('msg-content').focus();
                        return;
                    }

                    let text = `Halo Admin Puja Tour & Travel Pangandaran,\n\n`;
                    text += `Perkenalkan saya *${name}*, ingin konsultasi / kirim pesan melalui website:\n\n`;
                    text += `📋 *Detail Permintaan:*\n`;
                    text += `• *Nama Lengkap:* ${name}\n`;
                    text += `• *Jenis Permintaan:* ${topic}\n`;
                    text += `• *Estimasi Jumlah Tamu:* ${pax}\n`;
                    if (dateVal) {
                        text += `• *Rencana Tanggal Trip:* ${dateVal}\n`;
                    }
                    text += `\n💬 *Isi Pesan / Pertanyaan:*\n`;
                    text += `"${content}"\n\n`;
                    text += `Mohon info ketersediaan jadwal, penawaran harga, dan rekomendasi terbaiknya. Terima kasih!`;

                    const waNum = "{{ $waNum }}";
                    window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(text)}`, '_blank');
                });
            }
        });
    </script>
</body>
</html>
