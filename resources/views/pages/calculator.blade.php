<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Kalkulator & Estimasi Biaya Wisata Pangandaran — Puja Tour & Travel</title>
    <meta name="description" content="Hitung estimasi biaya paket wisata Pangandaran, body rafting Green Canyon, diskon rombongan, dan booking via WhatsApp instan.">
    <meta name="keywords" content="harga paket wisata Pangandaran, estimasi biaya body rafting Green Canyon, kalkulator wisata, biaya snorkeling Pasir Putih, harga tour Pangandaran">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Kalkulator & Estimasi Biaya Wisata Pangandaran — Puja Tour & Travel">
    <meta property="og:description" content="Hitung estimasi biaya paket wisata Pangandaran, body rafting Green Canyon, diskon rombongan, dan booking via WhatsApp instan.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Kalkulator & Estimasi Biaya Wisata Pangandaran — Puja Tour & Travel">
    <meta name="twitter:description" content="Hitung estimasi biaya paket wisata Pangandaran, body rafting Green Canyon, diskon rombongan, dan booking via WhatsApp instan.">
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
                'name' => 'Estimasi Biaya',
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
            <span class="text-slate-900 font-semibold">Estimasi Biaya Wisata</span>
        </nav>
    </div>

    <!-- MAIN CALCULATOR CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-20">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700">
                Kalkulator Transparan
            </span>
            <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 mt-3 tracking-tight">
                Simulasi & Estimasi Biaya Liburan
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Hitung perkiraan biaya trip Pangandaran secara akurat sesuai jumlah peserta dan paket pilihan Anda, lengkap dengan otomatisasi diskon rombongan!
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Form Parameters (7 cols) -->
            <div class="lg:col-span-7 bg-surface-soft rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200 space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-neutral-200">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                        <i data-lucide="calculator" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="font-display font-bold text-lg text-slate-900">Parameter Perjalanan</h2>
                        <p class="text-xs text-slate-500">Sesuaikan data rencana kunjungan Anda</p>
                    </div>
                </div>

                <!-- 1. Pilih Paket -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Pilih Paket Wisata *</label>
                    <select id="calc-page-package" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 font-medium text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                        @foreach($packages as $pkg)
                            <option value="{{ $pkg->slug }}" data-name="{{ $pkg->name }}" data-price="{{ (int) $pkg->price }}" data-duration="{{ $pkg->duration }}" {{ (request('package') === $pkg->slug || request('paket') === $pkg->slug) ? 'selected' : '' }}>
                                {{ $pkg->name }} ({{ $pkg->formatted_price }} / {{ $pkg->price_unit }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. Jumlah Peserta & Tanggal -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Jumlah Peserta (Pax) *</label>
                        <div class="flex items-center">
                            <input type="number" id="calc-page-pax" min="1" max="500" value="4" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-900 font-bold text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">Diskon 10% untuk 5-9 pax &bull; 15% untuk 10+ pax</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Rencana Tanggal Trip</label>
                        <input type="date" id="calc-page-date" min="{{ date('Y-m-d') }}" placeholder="Pilih tanggal trip..." class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition custom-datepicker-input">
                    </div>
                </div>

                <!-- 3. Add-ons Opsional -->
                <div class="pt-4 border-t border-neutral-200">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-3">Layanan Tambahan (Opsional)</label>
                    <div class="space-y-2.5">
                        <label class="flex items-center justify-between p-3 rounded-2xl bg-white border border-neutral-200 hover:border-emerald-700/50 cursor-pointer transition">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="addon-drone" data-cost="350000" data-type="flat" class="calc-addon rounded text-emerald-700 w-4 h-4">
                                <div>
                                    <span class="text-xs font-bold text-slate-900 block">Dokumentasi Video Drone 4K</span>
                                    <span class="text-[11px] text-slate-500">Video sinematik tebing & panorama dari udara</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-emerald-700">+Rp 350.000 / trip</span>
                        </label>

                        <label class="flex items-center justify-between p-3 rounded-2xl bg-white border border-neutral-200 hover:border-emerald-700/50 cursor-pointer transition">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="addon-seafood" data-cost="85000" data-type="per_pax" class="calc-addon rounded text-emerald-700 w-4 h-4">
                                <div>
                                    <span class="text-xs font-bold text-slate-900 block">Gala Dinner Seafood Bakar</span>
                                    <span class="text-[11px] text-slate-500">Menu kepiting, udang, cumi, ikan bakar pesisir</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-emerald-700">+Rp 85.000 / pax</span>
                        </label>

                        <label class="flex items-center justify-between p-3 rounded-2xl bg-white border border-neutral-200 hover:border-emerald-700/50 cursor-pointer transition">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="addon-transport" data-cost="150000" data-type="per_pax" class="calc-addon rounded text-emerald-700 w-4 h-4">
                                <div>
                                    <span class="text-xs font-bold text-slate-900 block">Antar-Jemput Stasiun / Bandara Banjar-Pangandaran</span>
                                    <span class="text-[11px] text-slate-500">Armada AC Pariwisata Private</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-emerald-700">+Rp 150.000 / pax</span>
                        </label>
                    </div>
                </div>

                <!-- 4. Data Kontak Pemesan -->
                <div class="pt-4 border-t border-neutral-200 space-y-4">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">Nama Pemesan</label>
                    <input type="text" id="calc-page-name" placeholder="Nama Lengkap Anda (contoh: Hendra Wijaya)" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                    <textarea id="calc-page-notes" rows="2" placeholder="Catatan tambahan (misal: penjemputan stasiun, request menu, dll)..." class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition"></textarea>
                </div>
            </div>

            <!-- Sticky Live Summary & WhatsApp CTA (5 cols) -->
            <div class="lg:col-span-5 sticky top-24 space-y-6">
                <div class="bg-surface-soft rounded-3xl p-6 sm:p-8 shadow-soft border border-neutral-200">
                    <h3 class="font-display font-bold text-lg text-slate-900 pb-4 border-b border-neutral-200">
                        Rincian Estimasi Biaya
                    </h3>

                    <div class="py-5 space-y-3.5 text-xs sm:text-sm">
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Paket Dipilih:</span>
                            <span id="summary-pkg-name" class="font-semibold text-slate-900 text-right max-w-48 truncate">-</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Harga Dasar / Pax:</span>
                            <span id="summary-pkg-price" class="font-semibold text-slate-900">Rp 0</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Jumlah Peserta:</span>
                            <span id="summary-pax" class="font-semibold text-slate-900">4 Orang</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Subtotal Paket:</span>
                            <span id="summary-subtotal" class="font-semibold text-slate-900">Rp 0</span>
                        </div>
                        <div id="summary-discount-row" class="hidden items-center justify-between text-emerald-700 font-bold">
                            <span>Potongan Diskon Rombongan:</span>
                            <span id="summary-discount">-Rp 0</span>
                        </div>
                        <div id="summary-addon-row" class="hidden items-center justify-between text-slate-600">
                            <span>Layanan Tambahan (Add-on):</span>
                            <span id="summary-addon" class="font-semibold text-slate-900">+Rp 0</span>
                        </div>

                        <!-- Grand Total -->
                        <div class="pt-4 border-t border-neutral-200 flex items-baseline justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-medium">Estimasi Total Akhir</span>
                                <span class="text-[10px] text-emerald-700 font-bold">Harga Bersih / Tanpa Biaya Tersembunyi</span>
                            </div>
                            <span id="summary-grand-total" class="font-display font-extrabold text-2xl sm:text-3xl text-emerald-700">
                                Rp 0
                            </span>
                        </div>
                    </div>

                    <!-- Direct Send via WhatsApp Button -->
                    <div class="pt-4 border-t border-neutral-200">
                        <button type="button" id="btn-calc-page-send" data-whatsapp="{{ $waNum }}" class="w-full py-4 px-6 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm text-center transition flex items-center justify-center gap-2.5 shadow-md hover:shadow-lg duration-200">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                            <span>Kirim Rincian Estimasi ke WA</span>
                        </button>
                        <p class="text-[11px] text-slate-400 text-center mt-2.5">
                            Konsultasi gratis &bull; Tim reservasi akan mengonfirmasi dalam hitungan menit
                        </p>
                    </div>
                </div>

                <!-- Trust Box -->
                <div class="p-5 rounded-2xl bg-canvas border border-neutral-200 space-y-2 text-xs text-slate-600">
                    <div class="flex items-center gap-2 font-bold text-slate-900">
                        <i data-lucide="info" class="w-4 h-4 text-emerald-700"></i>
                        <span>Ketentuan Pemesanan:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-slate-500 pl-1">
                        <li>Jadwal trip fleksibel dapat disesuaikan kebutuhan rombongan.</li>
                        <li>Pembayaran DP cukup 20% - 30% via transfer bank resmi CV.</li>
                        <li>Garansi refund atau penjadwalan ulang jika cuaca ekstrem.</li>
                    </ul>
                </div>
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

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20estimasi%20biaya" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

    <!-- Page Specific Script for Advanced Calculator -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectPkg = document.getElementById('calc-page-package');
            const inputPax = document.getElementById('calc-page-pax');
            const inputDate = document.getElementById('calc-page-date');
            const inputName = document.getElementById('calc-page-name');
            const inputNotes = document.getElementById('calc-page-notes');
            const addonChecks = document.querySelectorAll('.calc-addon');
            const btnSend = document.getElementById('btn-calc-page-send');

            const summaryPkgName = document.getElementById('summary-pkg-name');
            const summaryPkgPrice = document.getElementById('summary-pkg-price');
            const summaryPax = document.getElementById('summary-pax');
            const summarySubtotal = document.getElementById('summary-subtotal');
            const summaryDiscountRow = document.getElementById('summary-discount-row');
            const summaryDiscount = document.getElementById('summary-discount');
            const summaryAddonRow = document.getElementById('summary-addon-row');
            const summaryAddon = document.getElementById('summary-addon');
            const summaryGrandTotal = document.getElementById('summary-grand-total');

            function recalculate() {
                if (!selectPkg || !inputPax) return;
                const opt = selectPkg.querySelector('option[value="' + selectPkg.value + '"]') || selectPkg.options[selectPkg.selectedIndex];
                const basePrice = parseInt(opt ? opt.getAttribute('data-price') || '0' : '0', 10);
                const pkgName = opt ? (opt.getAttribute('data-name') || opt.text) : 'Paket Wisata';
                const rawPax = parseInt(inputPax.value || '1', 10);
                const pax = isNaN(rawPax) ? 1 : Math.max(1, Math.min(500, rawPax));

                const subtotal = basePrice * pax;

                let discountRate = 0;
                if (pax >= 10) discountRate = 0.15;
                else if (pax >= 5) discountRate = 0.10;

                const discountAmount = Math.round(subtotal * discountRate);

                let addonTotal = 0;
                const activeAddons = [];
                addonChecks.forEach(chk => {
                    if (chk.checked) {
                        const cost = parseInt(chk.getAttribute('data-cost') || '0', 10);
                        const type = chk.getAttribute('data-type');
                        const itemTotal = (type === 'per_pax') ? (cost * pax) : cost;
                        addonTotal += itemTotal;
                        activeAddons.push({
                            label: chk.closest('label').querySelector('.text-xs').textContent.trim(),
                            total: itemTotal
                        });
                    }
                });

                const grandTotal = subtotal - discountAmount + addonTotal;

                if (summaryPkgName) summaryPkgName.textContent = pkgName;
                if (summaryPkgPrice) summaryPkgPrice.textContent = 'Rp ' + basePrice.toLocaleString('id-ID');
                if (summaryPax) summaryPax.textContent = pax + ' Orang';
                if (summarySubtotal) summarySubtotal.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

                if (discountAmount > 0) {
                    if (summaryDiscountRow) summaryDiscountRow.classList.remove('hidden');
                    if (summaryDiscount) summaryDiscount.textContent = '-Rp ' + discountAmount.toLocaleString('id-ID') + ' (' + (discountRate * 100) + '%)';
                } else {
                    if (summaryDiscountRow) summaryDiscountRow.classList.add('hidden');
                }

                if (addonTotal > 0) {
                    if (summaryAddonRow) summaryAddonRow.classList.remove('hidden');
                    if (summaryAddon) summaryAddon.textContent = '+Rp ' + addonTotal.toLocaleString('id-ID');
                } else {
                    if (summaryAddonRow) summaryAddonRow.classList.add('hidden');
                }

                if (summaryGrandTotal) summaryGrandTotal.textContent = 'Rp ' + (isNaN(grandTotal) ? 0 : grandTotal).toLocaleString('id-ID');

                return { pkgName, pax, grandTotal, discountAmount, activeAddons };
            }

            if (selectPkg) selectPkg.addEventListener('change', recalculate);
            if (inputPax) {
                inputPax.addEventListener('input', recalculate);
                inputPax.addEventListener('blur', () => {
                    let pax = parseInt(inputPax.value, 10);
                    if (isNaN(pax) || pax < 1) inputPax.value = 1;
                    else if (pax > 500) inputPax.value = 500;
                    recalculate();
                });
            }
            if (inputDate) {
                inputDate.addEventListener('change', () => {
                    const today = new Date().toISOString().split('T')[0];
                    if (inputDate.value && inputDate.value < today) {
                        inputDate.value = today;
                        alert('Tanggal trip tidak boleh di masa lalu. Tanggal telah otomatis disesuaikan ke hari ini.');
                    }
                });
            }
            addonChecks.forEach(chk => chk.addEventListener('change', recalculate));
            recalculate();

            if (btnSend) {
                btnSend.addEventListener('click', () => {
                    const data = recalculate();
                    const name = inputName && inputName.value.trim() ? inputName.value.trim() : 'Wisatawan';

                    const today = new Date().toISOString().split('T')[0];
                    const altDate = inputDate?.parentElement?.querySelector('.flatpickr-input[type="text"]');
                    let date = altDate && altDate.value ? altDate.value : (inputDate && inputDate.value ? inputDate.value : 'Belum ditentukan');
                    if (inputDate && inputDate.value && inputDate.value < today) {
                        date = today;
                        inputDate.value = today;
                    }

                    const notes = inputNotes && inputNotes.value.trim() ? inputNotes.value.trim() : '-';

                    let msg = `Halo Admin Puja Tour & Travel Pangandaran,\n\n`;
                    msg += `Perkenalkan saya *${name}*, ingin konsultasi & booking berdasarkan simulasi kalkulator website:\n\n`;
                    msg += `📋 *Detail Rencana Liburan:*\n`;
                    msg += `• *Nama Pemesan:* ${name}\n`;
                    msg += `• *Paket Pilihan:* ${data.pkgName}\n`;
                    msg += `• *Jumlah Peserta:* ${data.pax} Orang\n`;
                    msg += `• *Rencana Tanggal:* ${date}\n`;
                    if (data.activeAddons && data.activeAddons.length > 0) {
                        msg += `• *Layanan Tambahan:*\n`;
                        data.activeAddons.forEach(a => {
                            msg += `   - ${a.label} (Rp ${a.total.toLocaleString('id-ID')})\n`;
                        });
                    }
                    msg += `• *Estimasi Total:* Rp ${data.grandTotal.toLocaleString('id-ID')}\n`;
                    if (notes !== '-') {
                        msg += `• *Catatan Tambahan:* ${notes}\n`;
                    }
                    msg += `\nMohon info ketersediaan jadwal dan prosedur pembayaran. Terima kasih!`;

                    const waNum = btnSend.getAttribute('data-whatsapp') || '6281234567890';
                    window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(msg)}`, '_blank');
                });
            }
        });
    </script>
</body>
</html>
