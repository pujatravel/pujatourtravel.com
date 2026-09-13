<!DOCTYPE html>
<html lang="id" class="scroll-smooth scroll-pt-24 sm:scroll-pt-28">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Syarat & Ketentuan Layanan — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="Syarat dan Ketentuan resmi layanan paket wisata, prosedur reservasi, standar keselamatan body rafting, dan perlindungan asuransi di CV Puja Tour & Travel Pangandaran.">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Syarat & Ketentuan Layanan — Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Ketentuan pemesanan paket wisata Pangandaran, standar keselamatan petualangan, asuransi, dan kebijakan force majeure.">
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
                'name' => 'Syarat & Ketentuan',
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
                <span class="text-slate-400">Legalitas & Ketentuan</span>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Syarat & Ketentuan</span>
            </nav>

            <!-- Header Title -->
            <div class="mb-12 border-b border-slate-200 pb-8">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold border border-slate-200 mb-4 shadow-2xs">
                    <i data-lucide="file-check" class="w-4 h-4 text-emerald-700"></i>
                    <span>Perjanjian Resmi Jasa Perjalanan Wisata & Petualangan Alam</span>
                </div>
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 tracking-tight">
                    Syarat & Ketentuan Layanan
                </h1>
                <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
                    Aturan resmi dan kesepakatan hukum antara <strong>{{ $companyName }}</strong> dengan setiap wisatawan atau penanggung jawab rombongan dalam rangka pemesanan paket wisata, keselamatan aktivitas alam, dan kenyamanan liburan di Pangandaran.
                </p>

                <!-- Document Meta Bar -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 pt-6 border-t border-slate-200 text-xs">
                    <div>
                        <span class="text-slate-600 block text-[11px] font-semibold">Status Dokumen</span>
                        <span class="font-bold text-slate-800">Resmi & Mengikat Hukum</span>
                    </div>
                    <div>
                        <span class="text-slate-600 block text-[11px] font-semibold">Terakhir Diperbarui</span>
                        <span class="font-bold text-slate-800">{{ date('d F Y') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-600 block text-[11px] font-semibold">Penyedia Jasa Resmi</span>
                        <span class="font-bold text-slate-800">{{ $companyName }}</span>
                    </div>
                    <div>
                        <span class="text-slate-600 block text-[11px] font-semibold">Yurisdiksi Operasional</span>
                        <span class="font-bold text-slate-800">Kabupaten Pangandaran, RI</span>
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
                            <span>Daftar Isi Ketentuan</span>
                        </div>
                        <nav class="space-y-1.5 text-xs text-slate-600">
                            <a href="#pasal-1" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">01</span>
                                <span class="truncate">Definisi Istilah & Ruang Lingkup</span>
                            </a>
                            <a href="#pasal-2" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">02</span>
                                <span class="truncate">Reservasi & Uang Muka (DP)</span>
                            </a>
                            <a href="#pasal-3" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">03</span>
                                <span class="truncate">Skema Pelunasan & Rekening Sah</span>
                            </a>
                            <a href="#pasal-4" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">04</span>
                                <span class="truncate">Inklusi & Eksklusi Fasilitas</span>
                            </a>
                            <a href="#pasal-5" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">05</span>
                                <span class="truncate">SOP Keselamatan di Alam Bebas</span>
                            </a>
                            <a href="#pasal-6" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">06</span>
                                <span class="truncate">Asuransi & Pembatasan Tanggung Jawab</span>
                            </a>
                            <a href="#pasal-7" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">07</span>
                                <span class="truncate">Kelestarian Alam & Norma Lokal</span>
                            </a>
                            <a href="#pasal-8" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">08</span>
                                <span class="truncate">Perubahan Jadwal (Reschedule)</span>
                            </a>
                            <a href="#pasal-9" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">09</span>
                                <span class="truncate">Kondisi Kahar (Force Majeure)</span>
                            </a>
                            <a href="#pasal-10" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">10</span>
                                <span class="truncate">Dokumentasi & Privasi Visual</span>
                            </a>
                            <a href="#pasal-11" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">11</span>
                                <span class="truncate">Hukum Berlaku & Sengketa</span>
                            </a>
                            <a href="#pasal-12" class="flex items-center gap-2.5 py-2 px-3 rounded-xl hover:bg-slate-50 hover:text-emerald-700 transition">
                                <span class="text-slate-600 font-mono font-semibold">12</span>
                                <span class="truncate">Kontak Resmi & Pengesahan</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Trust Highlights Box -->
                    <div class="bg-emerald-50/70 rounded-3xl p-6 border border-emerald-200/80 text-xs space-y-3.5">
                        <div class="flex items-center gap-2 text-emerald-900 font-bold">
                            <i data-lucide="shield-check" class="w-4 h-4 text-emerald-700"></i>
                            <span>Jaminan Kepuasan & Legalitas</span>
                        </div>
                        <ul class="space-y-2 text-emerald-950/80 leading-relaxed">
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Pemandu sungai bersertifikat resmi HPI & standar rescue air.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Seluruh peserta tercover asuransi kecelakaan pariwisata resmi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span>Perlindungan kondisi kahar: bebas reschedule jika cuaca buruk.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Support Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 text-xs space-y-3">
                        <h4 class="font-display font-bold text-slate-900 text-sm">Konsultasi Syarat Trip?</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Punya pertanyaan seputar kustom paket rombongan, invoice kedinasan, atau aturan usia peserta?
                        </p>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20syarat%20dan%20ketentuan%20paket" target="_blank" class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold flex items-center justify-center gap-2 transition shadow-xs">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Chat WhatsApp Hotline</span>
                        </a>
                    </div>
                </aside>

                <!-- Right Column: Detailed Clauses (Pasal-Pasal Lengkap & Rinci) -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- PASAL 1 -->
                    <article id="pasal-1" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                01
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 1</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Definisi Istilah & Ruang Lingkup Perjanjian</h2>
                            </div>
                        </header>
                        <p>
                            Dokumen Syarat dan Ketentuan ini merupakan perjanjian hukum yang sah dan mengikat antara <strong>{{ $companyName }}</strong> (selanjutnya disebut "Perusahaan", "Kami", atau "Puja Tour") dengan setiap individu, korporasi, atau penanggung jawab rombongan (selanjutnya disebut "Peserta", "Pelanggan", atau "Pemesan") yang memesan layanan perjalanan wisata, baik melalui website resmi, aplikasi WhatsApp, email resmi, maupun transaksi langsung di kantor operasional Pangandaran.
                        </p>
                        <div class="space-y-2 pt-1 text-xs sm:text-sm text-slate-600">
                            <p><strong>Definisi Operasional:</strong></p>
                            <ul class="list-disc pl-5 space-y-1.5">
                                <li><strong>Paket Wisata:</strong> Seluruh susunan jadwal kegiatan, akomodasi, transportasi lokal, konsumsi, tiket masuk, dan pemanduan yang disepakati bersama.</li>
                                <li><strong>Tour Leader / PIC:</strong> Penanggung jawab utama yang mewakili rombongan pemesan dalam korespondensi, manifest, dan pembayaran.</li>
                                <li><strong>Pemandu Wisata (Guide / River Guide):</strong> Petugas kepemanduan lokal resmi bersertifikat Himpunan Pramuwisata Indonesia (HPI) yang ditugaskan memimpin perjalanan alam.</li>
                                <li><strong>Mitra Rekanan:</strong> Pihak ketiga independen penyedia hotel/resort, perahu nelayan pesisir, penyedia bus pariwisata, dan restoran rekanan.</li>
                            </ul>
                        </div>
                    </article>

                    <!-- PASAL 2 -->
                    <article id="pasal-2" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                02
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 2</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Prosedur Reservasi & Uang Muka (Down Payment)</h2>
                            </div>
                        </header>
                        <p>
                            Untuk menjamin ketersediaan kuota tiket konservasi alam, perahu penjemputan, pemandu sungai khusus, dan reservasi hotel rekanan, seluruh pemesanan mengikuti ketentuan berikut:
                        </p>
                        <ul class="space-y-2.5 text-slate-600 pl-2 text-xs sm:text-sm">
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Besaran Uang Muka (DP):</strong> Pemesanan paket wisata dinyatakan sah dan mengikat <em>(confirmed booking)</em> setelah Pemesan membayarkan uang muka minimal sebesar <strong>30%</strong> dari total nilai tagihan paket yang disepakati.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Penerbitan Surat Konfirmasi / Invoice:</strong> Setelah DP diterima dan diverifikasi, tim Puja Tour akan menerbitkan dokumen resmi berupa <em>E-Invoice</em> atau Surat Perintah Kerja (SPK) berstempel resmi perusahaan.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Batas Waktu Hold Reservasi:</strong> Penawaran harga dan ketersediaan kuota tanpa pembayaran DP hanya berlaku selama 1 x 24 jam. Jika dalam batas waktu tersebut DP belum dibayarkan, slot dapat dialihkan kepada pelanggan lain.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 3 -->
                    <article id="pasal-3" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                03
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 3</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Skema Pelunasan Tagihan & Rekening Pembayaran Sah</h2>
                            </div>
                        </header>
                        <p>
                            Pelunasan sisa pembayaran dan tata cara transaksi diatur secara ketat demi keamanan finansial wisatawan:
                        </p>
                        <div class="grid sm:grid-cols-2 gap-3.5 pt-1 text-xs">
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block text-xs">Jadwal Pelunasan Sisa 70%</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Sisa tagihan (70%) wajib dilunasi paling lambat saat kedatangan di titik kumpul / kantor operasional Puja Tour di Pangandaran sebelum rombongan diberangkatkan menuju lokasi sungai/pantai.
                                </p>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block text-xs">Ketentuan Rombongan Korporat / Instansi</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Bagi rombongan instansi atau perusahaan yang menggunakan mekanisme <em>Term of Payment (TOP)</em> kedinasan, wajib menyertakan Surat Perintah Kerja (SPK) resmi bermeterai sebelum trip berlangsung.
                                </p>
                            </div>
                        </div>
                        <div class="p-4 rounded-2xl bg-amber-50/80 border border-amber-200 text-amber-950 text-xs sm:text-sm leading-relaxed">
                            <strong>Peringatan Keamanan Transaksi:</strong> Seluruh pembayaran transfer bank hanya sah jika ditujukan ke rekening resmi atas nama <strong>{{ $companyName }}</strong> atau kode QRIS resmi perusahaan yang tertera pada invoice. Kami tidak bertanggung jawab atas transaksi yang ditransfer ke rekening pribadi perorangan kru/pemandu.
                        </div>
                    </article>

                    <!-- PASAL 4 -->
                    <article id="pasal-4" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                04
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 4</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Inklusi & Eksklusi Fasilitas Paket Wisata</h2>
                            </div>
                        </header>
                        <p>
                            Rincian fasilitas paket wisata yang tercakup dan tidak tercakup tercantum secara transparan pada penawaran:
                        </p>
                        <div class="space-y-3 text-xs sm:text-sm">
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                                <strong class="text-slate-900 flex items-center gap-2">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-700"></i>
                                    Fasilitas Termasuk (Inklusi Standar):
                                </strong>
                                <ul class="list-disc pl-5 space-y-1 text-slate-600">
                                    <li>Tiket retribusi resmi objek wisata (Pangandaran, Green Canyon, Batu Hiu, Citumang, dll).</li>
                                    <li>Peralatan keselamatan standar SNI (pelampung/life jacket khusus sungai, helm air, dry bag).</li>
                                    <li>Pemandu lokal bersertifikat HPI dan kru rescue air berpengalaman.</li>
                                    <li>Perahu penjemputan / perahu pesisir resmi.</li>
                                    <li>Konsumsi makan siang (prasmanan Sunda / seafood bakar) sesuai paket yang dipilih.</li>
                                    <li>Asuransi jiwa keselamatan wisata dari pengelola resmi objek wisata.</li>
                                    <li>Dokumentasi foto dan video trip <em>(softcopy)</em>.</li>
                                </ul>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                                <strong class="text-slate-900 flex items-center gap-2">
                                    <i data-lucide="x-circle" class="w-4 h-4 text-slate-500"></i>
                                    Fasilitas Tidak Termasuk (Eksklusi):
                                </strong>
                                <ul class="list-disc pl-5 space-y-1 text-slate-600">
                                    <li>Biaya transportasi antar-jemput dari kota asal menuju Pangandaran (kecuali paket <em>All-In Transport</em>).</li>
                                    <li>Pengeluaran pribadi di luar menu paket (camilan, kelapa muda pribadi, suvenir).</li>
                                    <li>Tips sukarela untuk pemandu lokal dan kru pengemudi perahu <em>(tipping sifatnya sukarela)</em>.</li>
                                    <li>Sewa wahana tambahan di luar kesepakatan paket (seperti banana boat, jetski, ATV pantai).</li>
                                </ul>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 5 -->
                    <article id="pasal-5" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                05
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 5</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Standar Operasional Prosedur (SOP) Keselamatan Alam Bebas</h2>
                            </div>
                        </header>
                        <p>
                            Keselamatan jiwa peserta adalah prioritas nomor satu. Dalam seluruh aktivitas alam bebas <em>(body rafting, river tubing, snorkeling, dan penjelajahan gua)</em>, peserta wajib mematuhi SOP berikut:
                        </p>
                        <ul class="space-y-2.5 text-slate-600 pl-2 text-xs sm:text-sm">
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="shield-alert" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Kewajiban Penggunaan Alat Pelindung Diri (APD):</strong> Setiap peserta wajib memakai <em>life jacket</em> yang terpasang erat dan helm pelindung selama berada di badan sungai atau laut. Dilarang melepas pelampung tanpa instruksi langsung dari pemandu.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="shield-alert" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Kepatuhan Instruksi Pemandu HPI:</strong> Pemandu memiliki wewenang penuh mengatur rute lintasan air, titik lompat tebing <em>(cliff jumping)</em>, dan titik peristirahatan. Peserta dilarang memisahkan diri dari rombongan utama.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="shield-alert" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Deklarasi Kondisi Kesehatan Khusus:</strong> Peserta wajib menyatakan secara jujur apabila memiliki riwayat penyakit jantung berat, asma akut, epilepsi, kehamilan, fobia air berlebihan, atau baru menjalani operasi cedera tulang. Peserta yang menyembunyikan kondisi medis menanggung risiko sepenuhnya.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i data-lucide="shield-alert" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <span><strong>Batasan Usia & Kemampuan:</strong> Usia peserta body rafting Green Canyon full track direkomendasikan minimal 6 tahun dan maksimal 60 tahun dalam kondisi fisik prima. Untuk anak-anak dan lansia, disiapkan opsi semi-body rafting atau berperahu santai dengan pendampingan ekstra.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 6 -->
                    <article id="pasal-6" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                06
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 6</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Perlindungan Asuransi & Pembatasan Tanggung Jawab</h2>
                            </div>
                        </header>
                        <p>
                            Ketentuan pertanggungan asuransi dan batasan tanggung jawab hukum Perusahaan diatur sebagai berikut:
                        </p>
                        <div class="space-y-3 pt-1 text-xs sm:text-sm">
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block mb-1">A. Asuransi Jiwa & Kecelakaan Resmi</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Setiap peserta yang terdaftar sah dalam manifest dilindungi asuransi kecelakaan pariwisata resmi (Bumida / Jiwasraya / Asuransi Resmi Objek Wisata Pemkab Pangandaran). Klaim biaya pengobatan dan santunan diproses sesuai syarat dan plafon pertanggungan resmi perusahaan asuransi terkait.
                                </p>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block mb-1">B. Batasan Tanggung Jawab atas Barang Pribadi</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Puja Tour <strong>tidak bertanggung jawab</strong> atas kehilangan, kerusakan akibat air, atau jatuhnya barang berharga pribadi (seperti smartphone, action camera, kacamata hitam, perhiasan emas, dompet) yang dibawa peserta ke dalam sungai/laut tanpa wadah kedap air <em>(waterproof pouch)</em>. Kami menyediakan loker penyimpanan aman di kantor transit sebelum berangkat.
                                </p>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                                <strong class="text-slate-900 block mb-1">C. Tindakan Ceroboh & Pelanggaran SOP</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Perusahaan dibebaskan dari segala tuntutan hukum atas insiden yang disebabkan secara langsung oleh kecerobohan disengaja, pengaruh minuman beralkohol/narkotika, atau penolakan mematuhi instruksi keselamatan pemandu resmi.
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 7 -->
                    <article id="pasal-7" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                07
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 7</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Kelestarian Alam, Lingkungan & Norma Sosial Pangandaran</h2>
                            </div>
                        </header>
                        <p>
                            Sebagai penggiat ekowisata berkelanjutan, seluruh wisatawan wajib menjaga etika lingkungan dan kearifan lokal:
                        </p>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 pl-2">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Larangan Perusakan Ekosistem (No Vandalism):</strong> Dilarang mematahkan, mengambil, atau mencoret-coret stalaktit/stalagmit di gua Green Canyon, merusak terumbu karang di Pasir Putih, serta mengganggu habitat satwa liar di Cagar Alam Pananjung.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Bebas Sampah Plastik (Zero Littering):</strong> Seluruh sampah bungkus makanan, botol air, atau rokok wajib disimpan dalam tas sampah dan dibuang di tempat sampah basecamp darat.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Penghormatan Nilai Budaya Lokal:</strong> Menjaga kesopanan berpakaian dan bertutur kata saat berinteraksi dengan masyarakat pesisir serta nelayan tradisional Pangandaran.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 8 -->
                    <article id="pasal-8" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                08
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 8</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Perubahan Jadwal (Reschedule) & Pengurangan Peserta</h2>
                            </div>
                        </header>
                        <p>
                            Kami memahami bahwa agenda perjalanan dapat berubah karena keperluan mendesak:
                        </p>
                        <div class="grid sm:grid-cols-2 gap-3 text-xs pt-1">
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">A. Ketentuan Reschedule Trip</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Permohonan perubahan tanggal trip dapat diajukan selambat-lambatnya <strong>H-3 (tiga hari kalender)</strong> sebelum tanggal keberangkatan tanpa dikenakan denda administratif, dengan catatan menyesuaikan ketersediaan slot pemandu dan penginapan rekanan.
                                </p>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-1">
                                <strong class="text-slate-900 block">B. Pengurangan Jumlah Peserta Rombongan</strong>
                                <p class="text-slate-600 leading-relaxed">
                                    Jika terjadi pengurangan peserta rombongan secara mendadak pada hari H pelaksanaan, penyesuaian harga per orang akan dihitung ulang berdasarkan batas minimal tier paket yang berlaku (karena biaya sewa perahu dan pemandu bersifat fix per perahu).
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- PASAL 9 -->
                    <article id="pasal-9" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                09
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 9</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Penanganan Kondisi Kahar (Force Majeure) & Cuaca Ekstrem</h2>
                            </div>
                        </header>
                        <p>
                            Kondisi kahar <em>(Force Majeure)</em> mencakup kejadian di luar kuasa manusia dan Perusahaan, seperti banjir bandang debit air meluap di Green Canyon, gelombang pasang ekstrem peringatan BMKG di Pantai Selatan, gempa bumi, tanah longsor, atau instruksi penutupan mendadak oleh Posko Bencana / Pemkab Pangandaran demi keselamatan jiwa:
                        </p>
                        <div class="bg-emerald-50/70 p-4 rounded-2xl border border-emerald-200 text-xs sm:text-sm text-emerald-950 space-y-2">
                            <strong class="block font-bold">Protokol Keselamatan Saat Force Majeure:</strong>
                            <ol class="list-decimal pl-5 space-y-1.5 text-slate-700">
                                <li><strong>Pengalihan Rute Aman (Re-routing):</strong> Trip akan dialihkan ke destinasi wisata alternatif yang dinyatakan aman oleh otoritas terkait (seperti dialihkan dari Green Canyon ke Citumang, Santirah, atau Jelajah Gua Cagar Alam) atas kesepakatan bersama peserta.</li>
                                <li><strong>Opsi Reschedule Gratis:</strong> Peserta berhak menjadwalkan ulang trip ke tanggal lain yang disepakati tanpa biaya penalti.</li>
                                <li><strong>Pengembalian Dana (Refund):</strong> Jika pengalihan rute tidak disepakati, pengembalian dana biaya tiket destinasi yang terdampak akan diproses sesuai rincian pada <a href="{{ route('refund-policy') }}" class="text-emerald-700 font-bold underline">Kebijakan Pengembalian Dana</a> kami.</li>
                            </ol>
                        </div>
                    </article>

                    <!-- PASAL 10 -->
                    <article id="pasal-10" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                10
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 10</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Dokumentasi Foto, Video & Privasi Visual</h2>
                            </div>
                        </header>
                        <p>
                            Dokumentasi foto dan rekaman video aktivitas peserta yang diambil oleh tim fotografer atau pemandu Puja Tour diatur dengan ketentuan:
                        </p>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 pl-2">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Seluruh file dokumentasi asli diserahkan kepada peserta melalui tautan Google Drive tanpa biaya tambahan sebagai cinderamata trip.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span>Perusahaan berhak menggunakan foto dokumentasi suasana wisata secara wajar untuk materi promosi website dan media sosial resmi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2 shrink-0"></span>
                                <span><strong>Hak Privasi Visual (Opt-Out):</strong> Jika peserta atau anggota keluarga berkeberatan fotonya dipublikasikan di media publik, silakan beri tahu kami melalui WhatsApp atau email. Kami akan segera menghapus materi terkait dalam 1 x 24 jam kerja sesuai <a href="{{ route('privacy-policy') }}" class="text-emerald-700 font-bold underline">Kebijakan Privasi</a>.</span>
                            </li>
                        </ul>
                    </article>

                    <!-- PASAL 11 -->
                    <article id="pasal-11" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                11
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 11</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Hukum yang Berlaku & Mekanisme Penyelesaian Sengketa</h2>
                            </div>
                        </header>
                        <p>
                            Syarat dan Ketentuan ini tunduk, diatur, dan ditafsirkan semata-mata berdasarkan hukum dan peraturan perundang-undangan yang berlaku di Negara Kesatuan Republik Indonesia.
                        </p>
                        <p class="text-slate-600 text-xs sm:text-sm">
                            Apabila timbul perselisihan atau perbedaan penafsiran sehubungan dengan pelaksanaan layanan paket wisata ini, Para Pihak sepakat untuk menyelesaikannya terlebih dahulu melalui <strong>musyawarah untuk mufakat secara kekeluargaan</strong>. Apabila musyawarah mufakat tidak tercapai dalam waktu 30 (tiga puluh) hari kalender, Para Pihak sepakat menyelesaikan sengketa melalui Pengadilan Negeri yang berwenang di wilayah hukum Kabupaten Ciamis / Pangandaran, Jawa Barat.
                        </p>
                    </article>

                    <!-- PASAL 12 -->
                    <article id="pasal-12" class="scroll-mt-24 sm:scroll-mt-28 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-5 text-sm leading-relaxed text-slate-700">
                        <header class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-800 font-display font-extrabold text-xs flex items-center justify-center shrink-0">
                                12
                            </div>
                            <div>
                                <span class="text-[11px] font-semibold text-slate-600 block uppercase tracking-wider">Pasal 12</span>
                                <h2 class="font-display font-bold text-lg sm:text-xl text-slate-900">Kontak Resmi, Pengesahan & Layanan Konsultasi</h2>
                            </div>
                        </header>
                        <p>
                            Untuk pertanyaan lebih lanjut mengenai isi Syarat dan Ketentuan ini atau keperluan penyesuaian SPK gathering perusahaan, Anda dapat menghubungi kantor kami:
                        </p>

                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-xs sm:text-sm space-y-3">
                            <div class="flex items-start gap-3">
                                <i data-lucide="building-2" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">Badan Usaha Resmi:</strong>
                                    <span class="text-slate-600">{{ $companyName }}</span>
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
                                    <strong class="text-slate-900 block">WhatsApp Hotline Resmi:</strong>
                                    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20syarat%20dan%20ketentuan" target="_blank" class="text-emerald-700 font-bold hover:underline">
                                        {{ $phoneNum }} (Respon Cepat)
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="mail" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="text-slate-900 block">Email Layanan Pelanggan:</strong>
                                    <a href="mailto:{{ $emailAddr }}" class="text-emerald-700 font-bold hover:underline">
                                        {{ $emailAddr }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 italic">
                            Catatan: Dokumen Syarat & Ketentuan ini disahkan oleh manajemen {{ $companyName }} dan dapat ditinjau secara berkala mengikuti regulasi keselamatan pariwisata Pangandaran.
                        </p>
                    </article>
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
                <p>© {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
                <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2">
                    <a href="{{ route('privacy-policy') }}" class="hover:text-emerald-400 transition">Kebijakan Privasi</a>
                    <span>•</span>
                    <a href="{{ route('terms-conditions') }}" class="text-emerald-400 font-semibold transition">Syarat & Ketentuan</a>
                    <span>•</span>
                    <a href="{{ route('refund-policy') }}" class="hover:text-emerald-400 transition">Kebijakan Pengembalian</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20syarat%20ketentuan%20paket" 
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
