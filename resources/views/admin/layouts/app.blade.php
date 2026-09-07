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
                        <span class="w-5 h-5 shrink-0 relative">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="3" width="8" height="8" rx="1.5" fill="currentColor" opacity=".2"/>
                                <rect x="13" y="3" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                                <rect x="3" y="13" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                                <rect x="13" y="13" width="8" height="8" rx="1.5" fill="#22d3ee" opacity=".7"/>
                            </svg>
                        </span>
                        <span>Dashboard</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Katalog & Produk
                    </div>
                    <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.packages.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                <path d="M9 20h6M12 20V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M12 10C12 10 7 8 5 4c3 0 6 2 7 6z" fill="#22d3ee" opacity=".8"/>
                                <path d="M12 10C12 10 17 8 19 4c-3 0-6 2-7 6z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                                <path d="M7 14c0 0 2-4 5-4s5 4 5 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
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
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                    <rect x="4" y="3" width="16" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M8 7h8M8 11h8M8 15h5" stroke="#22d3ee" stroke-width="1.5" stroke-linecap="round"/>
                                    <rect x="4" y="3" width="16" height="4" rx="2" fill="currentColor" opacity=".15"/>
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
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.5"/>
                                <circle cx="8.5" cy="10.5" r="1.5" fill="#fbbf24"/>
                                <path d="M3 16l5-5 4 4 3-3 6 5" stroke="#22d3ee" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span>Galeri Foto</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2l2.9 5.8 6.4.9-4.6 4.5 1.1 6.4L12 16.8l-5.8 2.8 1.1-6.4-4.6-4.5 6.4-.9L12 2z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                                <path d="M12 2l2.9 5.8 6.4.9-4.6 4.5 1.1 6.4L12 16.8" fill="#fbbf24" opacity=".7"/>
                            </svg>
                        </span>
                        <span>Ulasan Testimoni</span>
                    </a>
                    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.faqs.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/>
                                <circle cx="12" cy="12" r="9" fill="currentColor" opacity=".08"/>
                                <path d="M9.5 9.5a2.5 2.5 0 0 1 5 .5c0 1.5-2.5 2-2.5 3.5" stroke="#22d3ee" stroke-width="1.5" stroke-linecap="round"/>
                                <circle cx="12" cy="17" r=".75" fill="#22d3ee"/>
                            </svg>
                        </span>
                        <span>Tanya Jawab (FAQ)</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Pengaturan
                    </div>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-ocean-600 text-white font-bold shadow-md' : 'hover:bg-slate-800/60 hover:text-white' }}">
                        <span class="w-5 h-5 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="3" fill="#22d3ee" opacity=".8"/>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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
