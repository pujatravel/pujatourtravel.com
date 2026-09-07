<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="@yield('description', 'Penyedia paket wisata resmi dan terpercaya di Pangandaran.')">
    <meta name="robots" content="noindex, follow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/puja_logo.png') }}">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white flex flex-col min-h-screen">

    @php
        $waNum = $waNum ?? '6281234567890';
        $phoneNum = $phoneNum ?? '+62 812-3456-7890';
        $emailAddr = $emailAddr ?? 'info@pujatourtravel.com';
        $officeAddr = $officeAddr ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
    @endphp

    <!-- HEADER / NAVBAR -->
    <header class="w-full bg-surface-soft/95 backdrop-blur-md border-b border-neutral-200 py-3.5 shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 shrink-0 flex items-center justify-center">
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

            <!-- Quick Navigation Links -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="hover:text-emerald-700 transition">Paket Wisata</a>
                <a href="{{ route('calculator') }}" class="hover:text-emerald-700 transition">Estimasi Biaya</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak CS</a>
            </nav>

            <!-- Emergency WhatsApp Button -->
            <div class="flex items-center gap-3">
                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20butuh%20bantuan%20di%20website" 
                   target="_blank"
                   class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Bantuan CS</span>
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN ERROR CONTENT -->
    <main class="flex-1 flex items-center justify-center py-12 sm:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full text-center">
            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white py-8 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <div class="flex items-center gap-2">
                <span class="font-bold text-white">PUJA TOUR & TRAVEL</span>
                <span>—</span>
                <span>Hotline: {{ $phoneNum }}</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="hover:text-emerald-400 transition">Beranda</a>
                <span>•</span>
                <a href="{{ route('packages.index') }}" class="hover:text-emerald-400 transition">Semua Paket</a>
                <span>•</span>
                <a href="{{ route('contact') }}" class="hover:text-emerald-400 transition">Bantuan Kontak</a>
            </div>
            <p>© {{ date('Y') }} Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>
</html>
