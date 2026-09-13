<!DOCTYPE html>
<html lang="id" class="scroll-smooth scroll-pt-24 sm:scroll-pt-28">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Kebijakan Pengembalian Dana (Refund Policy) — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="Kebijakan resmi pembatalan reservasi, pengembalian dana (refund), reschedule bebas biaya, dan garansi cuaca force majeure di CV Puja Tour & Travel Pangandaran.">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Kebijakan Pengembalian Dana — Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Ketentuan refund transparan, skema pembatalan, garansi cuaca force majeure, dan tata cara klaim pengembalian dana.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

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
                'name' => 'Kebijakan Pengembalian',
                'item' => url()->current(),
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
<body class="bg-[#f8fafc] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white pt-20 sm:pt-24">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
        $companyName = $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN';
    @endphp

    <!-- GLOBAL NAVBAR -->
    @include('partials.navbar')

    <!-- MAIN CONTENT -->
    <main class="py-10 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                <span>/</span>
                <span class="text-slate-400">Legalitas & Keuangan</span>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Kebijakan Pengembalian</span>
            </nav>

            <!-- Header Title -->
            <div class="mb-8 sm:mb-12 border-b border-slate-200 pb-6 sm:pb-8">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold border border-slate-200 mb-4 shadow-2xs">
                    <i data-lucide="wallet-cards" class="w-4 h-4 text-emerald-700 shrink-0"></i>
                    <span class="leading-snug">Ketentuan Transaksi Finansial, Pembatalan & Pengembalian Dana</span>
                </div>
                <h1 class="font-display font-extrabold text-2xl sm:text-4xl lg:text-5xl text-slate-900 tracking-tight">
                    Kebijakan Pengembalian Dana (Refund Policy)
                </h1>
                <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-2.5 sm:mt-3 max-w-3xl leading-relaxed">
                    Pedoman resmi dan transparan mengenai pengembalian dana <em>(refund)</em>, ketentuan penjadwalan ulang <em>(reschedule)</em>, serta perlindungan garansi cuaca buruk di <strong>{{ $companyName }}</strong>.
                </p>

                <!-- Document Meta Bar -->
                <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-6 border-t border-slate-200 text-xs">
                    <div class="bg-white/60 sm:bg-transparent p-3 sm:p-0 rounded-xl sm:rounded-none border border-slate-100 sm:border-none">
                        <span class="text-slate-600 block text-[11px] font-semibold">Status Kebijakan</span>
                        <span class="font-bold text-slate-800">Resmi & Transparan</span>
                    </div>
                    <div class="bg-white/60 sm:bg-transparent p-3 sm:p-0 rounded-xl sm:rounded-none border border-slate-100 sm:border-none">
                        <span class="text-slate-600 block text-[11px] font-semibold">Terakhir Diperbarui</span>
                        <span class="font-bold text-slate-800">{{ date('d F Y') }}</span>
                    </div>
                    <div class="bg-white/60 sm:bg-transparent p-3 sm:p-0 rounded-xl sm:rounded-none border border-slate-100 sm:border-none">
                        <span class="text-slate-600 block text-[11px] font-semibold">Unit Layanan</span>
                        <span class="font-bold text-slate-800 truncate block">Divisi Keuangan & Reservasi</span>
                    </div>
                    <div class="bg-white/60 sm:bg-transparent p-3 sm:p-0 rounded-xl sm:rounded-none border border-slate-100 sm:border-none">
                        <span class="text-slate-600 block text-[11px] font-semibold">Estimasi Pencairan</span>
                        <span class="font-bold text-slate-800">1 – 3 Hari Kerja</span>
                    </div>
                </div>
            </div>

            <!-- Main Layout: 2 Columns (Sticky TOC on Desktop + Detailed Content) -->
            <div class="grid lg:grid-cols-12 gap-10 items-start">
                <!-- Left Sidebar: Quick Table of Contents & Quick Contact -->
                <aside class="lg:col-span-4 sticky top-24 space-y-6 hidden lg:block">
                    <!-- Table of Contents Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                        <div class="flex items-center gap-2 pb-4 mb-4 border-b border-slate-100 text-xs font-bold uppercase tracking-wider text-slate-800">
                            <i data-lucide="list" class="w-4 h-4 text-emerald-700"></i>
                            <span>Daftar Isi Kebijakan Refund</span>
                        </div>
                        <nav class="space-y-1.5 text-xs text-slate-600">
                            <a href="#pasal-1" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">01</span>
                                <span class="truncate">Prinsip Umum Pembatalan</span>
                            </a>
                            <a href="#pasal-2" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">02</span>
                                <span class="truncate">Skema Tier Waktu & Persentase</span>
                            </a>
                            <a href="#pasal-3" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">03</span>
                                <span class="truncate">Garansi Cuaca Ekstrem (Force Majeure)</span>
                            </a>
                            <a href="#pasal-4" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">04</span>
                                <span class="truncate">Opsi Bebas Biaya Ganti Tanggal</span>
                            </a>
                            <a href="#pasal-5" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">05</span>
                                <span class="truncate">Ketentuan Rombongan Gathering</span>
                            </a>
                            <a href="#pasal-6" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">06</span>
                                <span class="truncate">Layanan Hotel & Akomodasi Mitra</span>
                            </a>
                            <a href="#pasal-7" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">07</span>
                                <span class="truncate">Tata Cara & Prosedur Klaim Refund</span>
                            </a>
                            <a href="#pasal-8" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">08</span>
                                <span class="truncate">Durasi Pencairan & Rekening Tujuan</span>
                            </a>
                            <a href="#pasal-9" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">09</span>
                                <span class="truncate">Layanan Bantuan & Kontak Keuangan</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Trust Highlights Box -->
                    <div class="bg-emerald-50/70 rounded-3xl p-6 border border-emerald-200/80 text-xs space-y-3.5">
                        <div class="flex items-center gap-2 text-emerald-900 font-bold">
                            <i data-lucide="shield-check" class="w-4 h-4 text-emerald-700"></i>
                            <span>Garansi Kepastian Finansial</span>
                        </div>
                        <ul class="space-y-2 text-emerald-950/80 leading-relaxed">
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Banjir Green Canyon: Garansi 100% Refund tiket atau Free Reschedule.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Proses verifikasi kilat maksimal 1x24 jam kerja.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Pencairan langsung via transfer bank resmi berbadan hukum CV.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Support Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 text-xs space-y-3">
                        <h4 class="font-display font-bold text-slate-900 text-sm">Konsultasi Refund?</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Butuh bantuan cek status pengembalian dana atau ingin konsultasi ganti tanggal trip?
                        </p>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20pengembalian%20dana%20(refund)" target="_blank" class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold flex items-center justify-center gap-2 transition shadow-xs">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Chat Divisi Keuangan</span>
                        </a>
                    </div>
                </aside>

                <!-- Right Column: Detailed Clauses (Pasal-Pasal Lengkap & Rinci) -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Summary Highlight Cards (Tier Visual) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white border border-slate-200 rounded-3xl p-5 text-center shadow-xs">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block mb-1">H-7 atau Lebih</span>
                            <span class="font-display font-extrabold text-2xl text-slate-900 block">Refund 100%</span>
                            <span class="text-xs text-slate-500 mt-1 block">Pengembalian penuh tanpa denda penalti</span>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-3xl p-5 text-center shadow-xs">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block mb-1">H-6 s/d H-3</span>
                            <span class="font-display font-extrabold text-2xl text-slate-900 block">Refund 50%</span>
                            <span class="text-xs text-slate-500 mt-1 block">Kompensasi persiapan awal kru armada</span>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-3xl p-5 text-center shadow-xs">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block mb-1">H-2 s/d Hari H</span>
                            <span class="font-display font-extrabold text-2xl text-slate-900 block">Opsi Reschedule</span>
                            <span class="text-xs text-slate-500 mt-1 block">Dapat dijadwalkan ulang ke tanggal lain</span>
                        </div>
                    </div>

                    <!-- PASAL 1 -->
                    <article id="pasal-1" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                01
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 1</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Prinsip Umum & Dasar Hukum Pembatalan</h2>
                            </div>
                        </header>
                        <p>
                            Kebijakan Pengembalian Dana <em>(Refund Policy)</em> ini disusun oleh <strong>{{ $companyName }}</strong> sebagai bentuk transparansi transaksi finansial dan perlindungan konsumen sesuai dengan ketentuan <strong>Undang-Undang Nomor 8 Tahun 1999 tentang Perlindungan Konsumen</strong> serta ketentuan perdata yang berlaku di Indonesia.
                        </p>
                        <p class="text-slate-600">
                            Setiap reservasi paket wisata melibatkan penguncian slot pemandu bersertifikat HPI, reservasi perahu jukung pesisir, pembelian tiket barcode konservasi alam, dan pemesanan konsumsi kuliner khas Pangandaran. Kebijakan ini menyeimbangkan antara fleksibilitas wisatawan dengan kepastian mata pencaharian mitra lokal Pangandaran.
                        </p>
                    </article>

                    <!-- PASAL 2 -->
                    <article id="pasal-2" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                02
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 2</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Skema Tier Waktu Pembatalan Sepihak oleh Wisatawan</h2>
                            </div>
                        </header>
                        <p>
                            Apabila pembatalan dilakukan atas kehendak atau alasan pribadi pihak Pemesan, pengembalian dana uang muka <em>(Down Payment)</em> mengacu pada perhitungan rentang waktu berikut:
                        </p>
                        <div class="space-y-3 pt-1 text-xs sm:text-sm">
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <div class="flex items-center justify-between">
                                    <strong class="text-slate-900">A. Pembatalan H-7 atau Lebih (Lebih dari 7 Hari Kalender)</strong>
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-800 font-bold text-xs">Refund 100%</span>
                                </div>
                                <p class="text-slate-600 leading-relaxed pt-1">
                                    Wisatawan berhak menerima pengembalian dana penuh sebesar 100% dari total DP yang telah disetorkan. Perusahaan hanya membebankan biaya administrasi transfer perbankan antar-bank (jika nomor rekening tujuan berbeda dari bank operasional kami).
                                </p>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <div class="flex items-center justify-between">
                                    <strong class="text-slate-900">B. Pembatalan H-6 hingga H-3 (3 s/d 6 Hari Kalender)</strong>
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-800 font-bold text-xs">Refund 50%</span>
                                </div>
                                <p class="text-slate-600 leading-relaxed pt-1">
                                    Wisatawan berhak menerima pengembalian sebesar 50% dari total DP. Sisa 50% dialokasikan untuk mengganti biaya operasional penalti pemesanan perahu dan penggantian biaya reservasi kru pemandu yang telah dijadwalkan.
                                </p>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <div class="flex items-center justify-between">
                                    <strong class="text-slate-900">C. Pembatalan Kurang dari 48 Jam (H-2, H-1, Hari H, atau No-Show)</strong>
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-800 font-bold text-xs">Non-Refundable</span>
                                </div>
                                <p class="text-slate-600 leading-relaxed pt-1">
                                    DP dinyatakan hangus karena seluruh tiket resmi balai konservasi telah diterbitkan secara non-refundable, bahan konsumsi makan siang telah dibelanjakan, dan pemandu lokal telah bersiap di lokasi. Namun demikian, wisatawan dipersilakan memilih <strong>Opsi Penjadwalan Ulang (Reschedule)</strong> sesuai Pasal 4.
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 3 -->
                    <article id="pasal-3" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                03
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 3</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Garansi Cuaca Buruk & Kondisi Kahar (Force Majeure)</h2>
                            </div>
                        </header>
                        <p>
                            Keselamatan wisatawan adalah harga mati yang tidak dapat ditawar. Apabila trip wisata tidak dapat dilaksanakan akibat bencana alam atau instruksi larangan resmi dari Pos Pantau SAR, BMKG, atau Pemkab Pangandaran (seperti debit banjir bandang di Green Canyon, sungai keruh berbahaya, atau ombak pasang laut selatan):
                        </p>
                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 space-y-2.5 text-xs sm:text-sm">
                            <strong class="text-slate-900 block">Jaminan Perlindungan Force Majeure Puja Tour:</strong>
                            <ul class="space-y-2 text-slate-600 pl-2">
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                    <span><strong>Pengembalian Penuh 100% (Full Refund):</strong> Seluruh biaya destinasi yang ditutup akan dikembalikan 100% tanpa potongan penalti pembatalan.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                    <span><strong>Opsi Pengalihan Destinasi Aman:</strong> Jika peserta tetap ingin berwisata, rute dialihkan ke destinasi alternatif yang aman (misal Citumang / Santirah / Goa Pananjung), dengan penyesuaian selisih harga jika ada.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                    <span><strong>Deposit Terbuka <em>(Open Trip Ticket)</em>:</strong> Dana DP dapat disimpan sebagai saldo aktif berlaku selama 1 (satu) tahun penuh untuk digunakan sewaktu-waktu saat cuaca telah membaik.</span>
                                </li>
                            </ul>
                        </div>
                    </article>

                    <!-- PASAL 4 -->
                    <article id="pasal-4" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                04
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 4</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Opsi Bebas Biaya Penjadwalan Ulang (Reschedule)</h2>
                            </div>
                        </header>
                        <p>
                            Sebagai solusi terbaik daripada pembatalan yang berpotensi memotong dana, kami menyediakan kebijakan penjadwalan ulang yang sangat fleksibel:
                        </p>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 pl-2">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Permohonan ganti tanggal dapat diajukan selambat-lambatnya <strong>H-3 (tiga hari kalender)</strong> sebelum hari keberangkatan.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Pengajuan reschedule tidak dikenakan biaya denda administratif <em>(Free of Charge)</em>.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Tanggal pengganti dapat disesuaikan hingga jangka waktu maksimal 6 (enam) bulan sejak tanggal pemesanan awal, menyesuaikan ketersediaan kuota pemandu lokal.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 5 -->
                    <article id="pasal-5" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                05
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 5</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Ketentuan Rombongan Korporat, Instansi & Gathering</h2>
                            </div>
                        </header>
                        <p>
                            Bagi pemesanan rombongan skala besar (perusahaan, kedinasan, reuni, atau sekolah dengan jumlah peserta lebih dari 30 orang):
                        </p>
                        <div class="grid sm:grid-cols-2 gap-3 text-xs pt-1">
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">Pengurangan Peserta Mendadak</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Pengurangan peserta rombongan pada H-1 atau hari H tidak dapat memotong nilai invoice yang sudah disepakati untuk sewa armada bus dan perahu borongan.
                                </p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">Klausul Adendum SPK</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Perubahan klausul pembatalan rombongan korporat dapat dituangkan dalam Adendum Surat Perintah Kerja (SPK) resmi sesuai kesepakatan kedua belah pihak.
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 6 -->
                    <article id="pasal-6" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                06
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 6</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Kebijakan Layanan Hotel & Penginapan Rekanan</h2>
                            </div>
                        </header>
                        <p>
                            Untuk paket wisata yang menyertakan akomodasi (hotel bintang, resort pantai, atau homestay), kebijakan pengembalian dana biaya kamar mengikuti regulasi masing-masing pengelola hotel:
                        </p>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 pl-2">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Sebagian besar hotel di kawasan wisata Pantai Pangandaran menetapkan kebijakan <em>non-refundable</em> saat periode <em>High Season</em> (musim liburan sekolah, Idul Fitri, Natal, dan Tahun Baru).</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Puja Tour akan membantu negosiasi pengalihan tanggal kamar <em>(reschedule stay)</em> kepada manajemen hotel semaksimal mungkin tanpa membebankan biaya tambahan dari pihak kami.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 7 -->
                    <article id="pasal-7" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                07
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 7</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Tata Cara & Prosedur Pengajuan Klaim Pengembalian</h2>
                            </div>
                        </header>
                        <p>
                            Untuk memastikan pencairan dana berjalan tertib, aman, dan dapat dipertanggungjawabkan dalam audit pembukuan CV, pemesan wajib mengikuti langkah-langkah berikut:
                        </p>
                        <ol class="list-decimal pl-5 space-y-2 text-xs sm:text-sm text-slate-600">
                            <li><strong>Pengajuan Tertulis:</strong> Kirimkan permohonan pembatalan/refund melalui WhatsApp hotline resmi atau email resmi kami dengan menyertakan foto e-invoice / bukti transfer DP.</li>
                            <li><strong>Alasan Pembatalan:</strong> Sertakan alasan pembatalan secara singkat untuk arsip layanan mutu kami.</li>
                            <li><strong>Data Rekening Tujuan:</strong> Cantumkan nama bank, nomor rekening, dan nama pemilik rekening. <strong>Nama pemilik rekening wajib sama dengan nama yang terdaftar di invoice pemesanan</strong> demi mencegah potensi penipuan pihak ketiga.</li>
                            <li><strong>Verifikasi Dokumen:</strong> Tim keuangan akan memvalidasi data reservasi dan menerbitkan Formulir Konfirmasi Refund dalam waktu maksimal 1 x 24 jam kerja.</li>
                        </ol>
                    </article>

                    <!-- PASAL 8 -->
                    <article id="pasal-8" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                08
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 8</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Durasi Pencairan & Rekening Pengirim Resmi</h2>
                            </div>
                        </header>
                        <p>
                            Ketentuan transfer pencairan dana ke rekening wisatawan diatur sebagai berikut:
                        </p>
                        <div class="grid sm:grid-cols-2 gap-3 text-xs pt-1">
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">Waktu Pencairan 1 – 3 Hari Kerja</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Dana refund akan ditransfer kembali ke rekening wisatawan dalam kurun waktu 1 (satu) hingga 3 (tiga) hari kerja perbankan sejak tanggal formulir refund disetujui.
                                </p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">Rekening Resmi Pengirim</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Pengembalian dana hanya dikirim melalui rekening bank resmi atas nama <strong>{{ $companyName }}</strong> disertai bukti transfer resmi berformat PDF / foto struk.
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 9 -->
                    <article id="pasal-9" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 lg:p-8 shadow-xs border border-slate-200 space-y-5 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                09
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 9</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Layanan Bantuan Keuangan & Pusat Pengaduan</h2>
                            </div>
                        </header>
                        <p>
                            Jika Anda membutuhkan klarifikasi mengenai perhitungan nominal pengembalian dana atau ingin memeriksa status pencairan transfer, silakan hubungi tim keuangan operasional kami:
                        </p>

                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-xs sm:text-sm space-y-3">
                            <div class="flex items-start gap-3">
                                <i data-lucide="building-2" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">Badan Usaha Resmi:</strong>
                                    <span class="text-slate-600">{{ $companyName }} — Divisi Keuangan & Refund</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="map-pin" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">Alamat Kantor Operasional:</strong>
                                    <span class="text-slate-600">{{ $officeAddr }}</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="phone" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">WhatsApp Hotline Keuangan:</strong>
                                    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20cek%20status%20refund" target="_blank" class="text-emerald-700 font-bold hover:underline">
                                        {{ $phoneNum }} (Layanan Cepat)
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="mail" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">Email Layanan Finansial:</strong>
                                    <a href="mailto:{{ $emailAddr }}" class="text-emerald-700 font-bold hover:underline">
                                        {{ $emailAddr }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 italic">
                            Catatan: Seluruh proses pengembalian dana diawasi dan ditandatangani oleh pimpinan manajemen CV Puja Tour & Travel Pangandaran demi kenyamanan dan kepercayaan wisatawan.
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20kebijakan%20refund" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
            const btn = document.getElementById('mobile-menu-btn');
            const drawer = document.getElementById('mobile-drawer');
            const closeBtn = document.getElementById('close-drawer-btn');
            if (btn && drawer) {
                btn.addEventListener('click', () => drawer.classList.remove('hidden'));
                if (closeBtn) closeBtn.addEventListener('click', () => drawer.classList.add('hidden'));
            }

            // Scroll spy & smooth anchor offset handling for TOC
            const tocLinks = document.querySelectorAll('aside nav a[href^="#"]');
            const articles = document.querySelectorAll('article[id^="pasal-"]');

            function updateActiveToc() {
                const headerHeight = document.getElementById('main-header')?.offsetHeight || 80;
                const scrollPos = window.scrollY + headerHeight + 50;

                let currentId = '';
                articles.forEach(article => {
                    const top = article.offsetTop;
                    if (scrollPos >= top) {
                        currentId = article.getAttribute('id');
                    }
                });

                tocLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (href === '#' + currentId) {
                        link.classList.add('bg-emerald-50', 'text-emerald-800', 'font-bold');
                        link.classList.remove('text-slate-600');
                    } else {
                        link.classList.remove('bg-emerald-50', 'text-emerald-800', 'font-bold');
                        link.classList.add('text-slate-600');
                    }
                });
            }

            window.addEventListener('scroll', updateActiveToc, { passive: true });
            updateActiveToc();

            // Smooth scroll click handler with header offset
            tocLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    const targetId = link.getAttribute('href');
                    if (targetId && targetId.startsWith('#')) {
                        const targetEl = document.querySelector(targetId);
                        if (targetEl) {
                            e.preventDefault();
                            const headerHeight = document.getElementById('main-header')?.offsetHeight || 80;
                            const targetPosition = targetEl.getBoundingClientRect().top + window.scrollY - headerHeight - 24;
                            window.scrollTo({
                                top: Math.max(0, targetPosition),
                                behavior: 'smooth'
                            });
                            history.pushState(null, '', targetId);
                            setTimeout(updateActiveToc, 100);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
