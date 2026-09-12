<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="@yield('description', 'Penyedia paket wisata resmi dan terpercaya di Pangandaran.')">
    <meta name="robots" content="noindex, nofollow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
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
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white flex flex-col min-h-screen relative overflow-x-hidden">

    @php
        try {
            $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            $settings = [];
        }

        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
        $companyName = $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN';
        $igUrl = $settings['instagram_url'] ?? 'https://www.instagram.com/puja_tourtravel/';
        $tiktokUrl = $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel';
    @endphp

    <!-- Background Ambient Glow Effects (Identik dengan Beranda) -->
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 -left-32 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 right-1/4 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl"></div>
    </div>

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

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-7 font-medium text-slate-600 text-sm">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="hover:text-emerald-700 transition">Paket Wisata</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-700 transition">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="hover:text-emerald-700 transition">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="hover:text-emerald-700 transition">FAQ</a>
                <a href="{{ route('gallery') }}" class="hover:text-emerald-700 transition">Galeri</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition">Kontak</a>
            </nav>

            <!-- Quick Action CTA -->
            <div class="hidden lg:flex items-center gap-3">
                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20butuh%20bantuan%20di%20website" 
                   target="_blank" 
                   class="px-4.5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm hover:shadow transition flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Tanya Admin</span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" aria-label="Buka Menu" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Drawer & Backdrop -->
    <div id="drawer-overlay" class="fixed inset-0 bg-slate-900/60 z-50 hidden opacity-0 transition-opacity duration-300"></div>
    <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-4/5 max-w-sm bg-surface-soft border-l border-neutral-200 z-50 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col justify-between p-6">
        <div>
            <div class="flex items-center justify-between pb-6 border-b border-neutral-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-display font-extrabold text-base text-slate-900">PUJA TOUR</span>
                        <span class="text-[10px] text-slate-500 block uppercase font-bold">Pangandaran</span>
                    </div>
                </div>
                <button id="close-menu-btn" aria-label="Tutup Menu" class="p-2 rounded-xl text-slate-500 hover:bg-neutral-100 transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <nav class="py-6 space-y-1 text-sm font-medium">
                <a href="{{ route('home') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">Paket Wisata</a>
                <a href="{{ route('about') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">Tentang Kami</a>
                <a href="{{ route('calculator') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">Estimasi Biaya</a>
                <a href="{{ route('faq') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">FAQ</a>
                <a href="{{ route('gallery') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">Galeri</a>
                <a href="{{ route('contact') }}" class="drawer-link block px-3.5 py-2.5 rounded-xl hover:bg-neutral-100 transition">Kontak</a>
            </nav>
        </div>

        <div class="pt-6 border-t border-neutral-200 space-y-3">
            <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20butuh%20bantuan%20di%20website" target="_blank" class="w-full py-3 rounded-xl bg-emerald-700 text-white font-semibold text-xs flex items-center justify-center gap-2 hover:bg-emerald-800 transition shadow-sm">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Chat WhatsApp Resmi</span>
            </a>
            <a href="{{ route('home') }}" class="drawer-link w-full py-3 rounded-xl bg-slate-100 text-slate-700 font-semibold text-xs flex items-center justify-center gap-2 hover:bg-slate-200 transition">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>

    <!-- MAIN ERROR CONTENT -->
    <main class="relative z-10 flex-1 flex items-center justify-center py-10 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full text-center">
            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer data-nav-color="dark" class="relative z-10 bg-slate-950 text-slate-400 text-xs py-14 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: Brand & Profil -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 shrink-0 flex items-center justify-center">
                            <img src="{{ asset('images/puja_logo.png') }}" alt="Puja Tour Travel" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <span class="font-display font-extrabold text-xl text-white block">{{ $companyName }}</span>
                            <span class="text-[10px] text-emerald-400 tracking-widest uppercase font-bold">Pangandaran Destination Specialist</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                        Penyedia paket wisata resmi Pangandaran, body rafting Green Canyon, snorkeling Pasir Putih, dan gathering perusahaan terpercaya.
                    </p>
                    <div class="flex items-center gap-2.5 pt-2 text-slate-300">
                        <a href="{{ $igUrl }}" target="_blank" aria-label="Instagram" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                            </svg>
                        </a>
                        <a href="{{ $tiktokUrl }}" target="_blank" aria-label="TikTok" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.298-.002.595.042.88.13V9.4a6.33 6.33 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.66a6.34 6.34 0 0 0 10.82 4.49 6.27 6.27 0 0 0 1.89-4.49V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-.9-.07z"/>
                            </svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" aria-label="Facebook" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigasi Utama -->
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-emerald-400 mb-4">Navigasi Utama</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
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
                            <li><a href="{{ route('gallery') }}" class="hover:text-white transition">Galeri Wisata</a></li>
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

                <!-- Col 3: Destinasi Populer -->
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-emerald-400 mb-4">Destinasi Populer</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Body Rafting Green Canyon</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">River Tubing Santirah</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Body Rafting Citumang</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Snorkeling Pasir Putih</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Jelajah Gua Cagar Alam</a></li>
                    </ul>
                </div>

                <!-- Col 4: Kantor Operasional -->
                <div>
                    <h4 class="font-bold text-xs uppercase tracking-wider text-emerald-400 mb-4">Kantor Operasional</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">{{ $officeAddr }}</p>
                    <p class="text-xs text-emerald-400 font-bold mt-2">Hotline: {{ $phoneNum }}</p>
                    <p class="text-xs text-slate-400 mt-1">Email: {{ $emailAddr }}</p>
                    <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-900 border border-slate-800 text-[11px] text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        <span>Buka Setiap Hari (06.00 - 21.00)</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Row: Copyright & Links -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-500">
                <p>© {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
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

    <!-- FLOATING WHATSAPP BUTTON -->
    <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20paket%20wisata" 
       target="_blank" 
       aria-label="Hubungi WhatsApp Puja Tour"
       class="fixed bottom-6 right-6 z-40 bg-emerald-700 hover:bg-emerald-800 text-white p-3.5 sm:p-4 rounded-full shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center group">
        <span class="absolute -top-10 right-0 bg-slate-900 text-white text-[11px] font-bold px-3 py-1 rounded-xl shadow-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition duration-200 pointer-events-none flex items-center gap-1">
            <i data-lucide="message-circle" class="w-3 h-3 text-emerald-400"></i>
            <span>Tanya Admin Langsung</span>
        </span>
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
        });
    </script>
</body>
</html>
