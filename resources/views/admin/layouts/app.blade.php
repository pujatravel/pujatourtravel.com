<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Puja Tour & Travel</title>
    
    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Flash Message Toast -->
    @if(session('success'))
        <div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center gap-3 px-5 py-4 rounded-2xl bg-emerald-600 text-white shadow-2xl transition-all transform duration-300">
            <span class="text-xl">✅</span>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
            <button onclick="document.getElementById('toast-success').remove()" class="ml-2 text-white/80 hover:text-white">&times;</button>
        </div>
        <script>setTimeout(() => { const t = document.getElementById('toast-success'); if (t) t.remove(); }, 4000);</script>
    @endif

    @if(session('error'))
        <div id="toast-error" class="fixed top-5 right-5 z-50 flex items-center gap-3 px-5 py-4 rounded-2xl bg-rose-600 text-white shadow-2xl transition-all transform duration-300">
            <span class="text-xl">⚠️</span>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
            <button onclick="document.getElementById('toast-error').remove()" class="ml-2 text-white/80 hover:text-white">&times;</button>
        </div>
        <script>setTimeout(() => { const t = document.getElementById('toast-error'); if (t) t.remove(); }, 4000);</script>
    @endif

    <div class="flex-1 flex overflow-hidden">
        <!-- Sidebar Navigation -->
        <aside id="admin-sidebar" class="w-64 bg-ocean-950 text-slate-300 flex-shrink-0 flex flex-col justify-between hidden md:flex border-r border-slate-800">
            <div>
                <!-- Brand Header -->
                <div class="p-6 border-b border-slate-800/80 flex items-center gap-3">
                    <img src="{{ asset('images/puja_logo.jpg') }}" alt="Logo Puja" class="w-10 h-10 rounded-full border-2 border-teak-500">
                    <div>
                        <span class="font-display font-bold text-white text-base leading-tight block">PUJA ADMIN</span>
                        <span class="text-[10px] text-cyan-400 font-bold tracking-wider uppercase">CMS Panel</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7" rx="1.5" stroke="#ffffff"/>
                                <rect x="14" y="3" width="7" height="7" rx="1.5" stroke="#38bdf8"/>
                                <rect x="14" y="14" width="7" height="7" rx="1.5" stroke="#ffffff"/>
                                <rect x="3" y="14" width="7" height="7" rx="1.5" stroke="#ffffff"/>
                            </svg>
                        </span>
                        <span>Dashboard</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Katalog & Produk
                    </div>
                    <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.packages.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 21V10" stroke="#ffffff"/>
                                <path d="M8 21h8" stroke="#ffffff"/>
                                <path d="M12 10c-3-2-6-1-8-3 3-1 6 0 8 3z" stroke="#38bdf8"/>
                                <path d="M12 10c3-2 6-1 8-3-3-1-6 0-8 3z" stroke="#38bdf8"/>
                                <path d="M12 10c-2-4-1-7 1-9 1 3 0 6-1 9z" stroke="#38bdf8"/>
                                <path d="M12 10c-3 1-5 4-6 7 3-1 5-3 6-7z" stroke="#ffffff"/>
                                <path d="M12 10c3 1 5 4 6 7-3-1-5-3-6-7z" stroke="#ffffff"/>
                            </svg>
                        </span>
                        <span>Paket Wisata</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Operasional
                    </div>
                    <a href="{{ route('admin.reservations.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.reservations.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <span class="w-5 h-5 shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="5" y="4" width="14" height="17" rx="2" stroke="#ffffff"/>
                                    <path d="M9 2h6a1 1 0 0 1 1 1v2H8V3a1 1 0 0 1 1-1z" stroke="#38bdf8"/>
                                    <path d="M9 10h6" stroke="#38bdf8"/>
                                    <path d="M9 14h6" stroke="#ffffff"/>
                                    <path d="M9 18h4" stroke="#ffffff"/>
                                </svg>
                            </span>
                            <span>Reservasi Trip</span>
                        </div>
                        @php $pendingCount = \App\Models\Reservation::where('status', 'PENDING')->count(); @endphp
                        @if($pendingCount > 0)
                            <span class="px-2 py-0.5 text-[10px] font-extrabold bg-amber-500 text-slate-950 rounded-full animate-pulse">{{ $pendingCount }}</span>
                        @endif
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Manajemen Konten
                    </div>
                    <a href="{{ route('admin.galleries.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.galleries.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="16" rx="2.5" stroke="#ffffff"/>
                                <circle cx="8.5" cy="8.5" r="1.5" stroke="#38bdf8"/>
                                <path d="M21 15l-5-5L5 20" stroke="#38bdf8"/>
                                <path d="M3 17l4-4 4 4" stroke="#ffffff"/>
                            </svg>
                        </span>
                        <span>Galeri Foto</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" stroke="#ffffff"/>
                                <path d="M12 6.5l1.6 3.3 3.6.5-2.6 2.5.6 3.6-3.2-1.7" stroke="#38bdf8"/>
                            </svg>
                        </span>
                        <span>Ulasan Testimoni</span>
                    </a>
                    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.faqs.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9" stroke="#ffffff"/>
                                <path d="M9.5 9a2.5 2.5 0 0 1 5 .5c0 1.5-2.5 2-2.5 3.5" stroke="#38bdf8"/>
                                <circle cx="12" cy="17" r="1" fill="#38bdf8"/>
                            </svg>
                        </span>
                        <span>Tanya Jawab (FAQ)</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Pengaturan
                    </div>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" stroke="#ffffff"/>
                                <circle cx="12" cy="12" r="3" stroke="#38bdf8"/>
                            </svg>
                        </span>
                        <span>Kontak & CMS</span>
                    </a>
                </nav>
            </div>

            <!-- User Info & Logout -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-900/60">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-xl bg-ocean-600 text-white flex items-center justify-center font-bold text-sm">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="truncate">
                            <span class="text-xs font-bold text-white block truncate">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <span class="text-[10px] text-slate-400 block">{{ auth()->user()->username ?? 'admin' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.logout') }}" title="Keluar" class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <!-- Topbar -->
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between sticky top-0 z-30 shadow-xs">
                <div class="flex items-center gap-4">
                    <h1 class="font-display font-bold text-xl text-slate-800">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold text-ocean-700 bg-ocean-50 hover:bg-ocean-100 transition border border-ocean-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="1.5"/><path d="M12 3c-2 4-2 14 0 18M12 3c2 4 2 14 0 18M3 12h18" stroke-width="1.5" stroke-linecap="round"/></svg>
                        <span>Lihat Website Publik</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 sm:p-8 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
