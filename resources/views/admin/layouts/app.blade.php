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

    <link rel="icon" type="image/png" href="{{ asset('images/puja_logo.png') }}">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-canvas text-slate-700 antialiased min-h-screen flex flex-col">

    <!-- Flash Message Toast -->
    @if(session('success'))
        <div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center gap-3 px-5 py-4 rounded-2xl bg-emerald-700 text-white shadow-lg transition-all transform duration-300">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-white"></i>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
            <button onclick="document.getElementById('toast-success').remove()" class="ml-2 text-white/80 hover:text-white">&times;</button>
        </div>
        <script>setTimeout(() => { const t = document.getElementById('toast-success'); if (t) t.remove(); }, 4000);</script>
    @endif

    @if(session('error'))
        <div id="toast-error" class="fixed top-5 right-5 z-50 flex items-center gap-3 px-5 py-4 rounded-2xl bg-rose-600 text-white shadow-lg transition-all transform duration-300">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-white"></i>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
            <button onclick="document.getElementById('toast-error').remove()" class="ml-2 text-white/80 hover:text-white">&times;</button>
        </div>
        <script>setTimeout(() => { const t = document.getElementById('toast-error'); if (t) t.remove(); }, 4000);</script>
    @endif

    <div class="flex-1 flex overflow-hidden">
        <!-- Sidebar Navigation (Solid Slate 900) -->
        <aside id="admin-sidebar" class="w-64 bg-slate-900 text-slate-300 shrink-0 flex-col justify-between hidden md:flex border-r border-slate-800">
            <div>
                <!-- Brand Header -->
                <div class="p-5 border-b border-slate-800 flex items-center gap-3">
                    <div class="w-11 h-11 shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-display font-bold text-white text-base leading-tight block">PUJA ADMIN</span>
                        <span class="text-[10px] text-emerald-400 font-bold tracking-wider uppercase">CMS Panel</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>
                        <span>Dashboard</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Katalog & Produk
                    </div>
                    <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.packages.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="palmtree" class="w-5 h-5 shrink-0"></i>
                        <span>Paket Wisata</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Operasional
                    </div>
                    <a href="{{ route('admin.reservations.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.reservations.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <i data-lucide="clipboard-list" class="w-5 h-5 shrink-0"></i>
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
                    <a href="{{ route('admin.galleries.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.galleries.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="image" class="w-5 h-5 shrink-0"></i>
                        <span>Galeri Foto</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="message-square-quote" class="w-5 h-5 shrink-0"></i>
                        <span>Ulasan Testimoni</span>
                    </a>
                    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.faqs.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="help-circle" class="w-5 h-5 shrink-0"></i>
                        <span>Tanya Jawab (FAQ)</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Pengaturan
                    </div>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="settings" class="w-5 h-5 shrink-0"></i>
                        <span>Kontak & CMS</span>
                    </a>
                </nav>
            </div>

            <!-- User Info & Logout -->
            <div class="p-4 border-t border-slate-800 bg-slate-950">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-xl bg-emerald-700 text-white flex items-center justify-center font-bold text-sm">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="truncate">
                            <span class="text-xs font-bold text-white block truncate">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <span class="text-[10px] text-slate-400 block">{{ auth()->user()->username ?? 'admin' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.logout') }}" title="Keluar" class="p-2 text-slate-400 hover:text-rose-400 hover:bg-slate-800 rounded-lg transition">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <!-- Topbar -->
            <header class="bg-surface-soft border-b border-neutral-200 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <h1 class="font-display font-bold text-xl text-slate-800">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold text-emerald-800 bg-emerald-50 hover:bg-emerald-100 transition border border-emerald-200">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span>Lihat Website Publik</span>
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
