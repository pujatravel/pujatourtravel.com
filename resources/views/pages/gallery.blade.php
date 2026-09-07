<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Dokumentasi Wisata Pangandaran — Puja Tour & Travel</title>
    <meta name="description" content="Koleksi foto dan dokumentasi kegiatan body rafting Green Canyon, snorkeling Pasir Putih, pantai Batu Karas, dan keindahan alam Pangandaran.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/puja_logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>
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
                <a href="{{ route('gallery') }}" class="text-emerald-700 font-semibold hover:text-emerald-800 transition">Galeri</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak</a>
            </nav>

            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20info%20paket%20wisata" target="_blank" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Tanya Trip CS</span>
                </a>
            </div>

            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Drawer -->
    <div id="drawer-overlay" class="fixed inset-0 bg-slate-900/60 z-50 hidden opacity-0 transition-opacity duration-300"></div>
    <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-4/5 max-w-sm bg-surface-soft border-l border-neutral-200 z-50 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col justify-between p-6">
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
                <a href="{{ route('gallery') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl bg-emerald-50 text-emerald-700 font-bold">Galeri</a>
                <a href="{{ route('contact') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100">Kontak</a>
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
            <span class="text-slate-900 font-semibold">Galeri Dokumentasi</span>
        </nav>
    </div>

    <!-- MAIN GALLERY CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-20">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                Dokumentasi Lapangan
            </span>
            <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 mt-3 tracking-tight">
                Galeri Petualangan Pangandaran
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Setiap momen petualangan Anda bersama pemandu kami diabadikan dengan hasil foto jernih & video berkesan. Klik foto untuk melihat tampilan penuh.
            </p>

            <!-- Social Channel Buttons -->
            <div class="flex items-center justify-center gap-3 mt-6">
                <a href="{{ $igUrl }}" target="_blank" class="px-4 py-2 rounded-xl bg-white border border-neutral-200 text-slate-700 hover:text-pink-600 hover:border-pink-300 text-xs font-semibold transition flex items-center gap-2 shadow-xs">
                    <i data-lucide="instagram" class="w-4 h-4 text-pink-600"></i>
                    <span>Instagram @pujatourtravel</span>
                </a>
                <a href="{{ $tiktokUrl }}" target="_blank" class="px-4 py-2 rounded-xl bg-white border border-neutral-200 text-slate-700 hover:text-slate-900 hover:border-slate-400 text-xs font-semibold transition flex items-center gap-2 shadow-xs">
                    <i data-lucide="video" class="w-4 h-4"></i>
                    <span>TikTok Resmi</span>
                </a>
            </div>
        </div>

        <!-- Dynamic Photo Bento Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($galleries as $gal)
                <div class="gallery-item group relative h-72 rounded-3xl overflow-hidden cursor-pointer shadow-soft border border-neutral-200 bg-slate-900"
                     data-img="{{ $gal->image_url }}"
                     data-caption="{{ $gal->caption ?? $gal->title }}">
                    <img src="{{ $gal->image_url }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-linear-to-t from-slate-950/80 via-transparent to-transparent opacity-80 group-hover:opacity-100 transition"></div>
                    
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-900/80 backdrop-blur-md text-emerald-400 border border-white/10">
                            {{ $gal->category ?? 'Wisata' }}
                        </span>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h3 class="font-display font-bold text-sm leading-snug">{{ $gal->title }}</h3>
                        @if($gal->caption)
                            <p class="text-[11px] text-slate-300 mt-1 line-clamp-1">{{ $gal->caption }}</p>
                        @endif
                    </div>

                    <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-emerald-700/80 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i data-lucide="zoom-in" class="w-4 h-4"></i>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-16 bg-surface-soft rounded-3xl border border-neutral-200 text-slate-500">
                    Belum ada foto galeri yang dipublikasikan.
                </div>
            @endforelse
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
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Paket Wisata</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('calculator') }}" class="hover:text-white transition">Estimasi Biaya</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-white transition">Galeri</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Kontak</a></li>
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
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.login') }}" class="hover:text-emerald-400 font-bold text-slate-400 flex items-center gap-1">
                        <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                        <span>Login Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- LIGHTBOX MODAL -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-slate-950/90 hidden items-center justify-center p-4">
        <button id="lightbox-close" aria-label="Tutup Galeri" class="absolute top-6 right-6 text-white/80 hover:text-white p-2 rounded-full bg-slate-800 hover:bg-slate-700 transition">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        <div class="max-w-4xl max-h-[85vh] flex flex-col items-center">
            <img id="lightbox-image" src="" alt="Galeri Preview" class="max-w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl">
            <p id="lightbox-caption" class="text-slate-200 text-sm mt-4 font-medium text-center"></p>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20tertarik%20dengan%20foto%20wisatanya" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <i data-lucide="message-circle" class="w-6 h-6"></i>
    </a>

</body>
</html>
