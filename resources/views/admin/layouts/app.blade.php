<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Puja Tour & Travel</title>
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicons for Google Search & Browsers -->
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

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

    <!-- Admin Mobile Navigation Drawer Overlay -->
    <div id="admin-mobile-overlay" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs z-40 transition-opacity duration-300 opacity-0 pointer-events-none md:hidden"></div>

    <!-- Admin Mobile Navigation Drawer -->
    <aside id="admin-mobile-drawer" class="fixed inset-y-0 left-0 z-50 w-72 max-w-[85vw] bg-white text-slate-700 flex flex-col justify-between transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden shadow-2xl overflow-y-auto border-r border-neutral-200">
        <div>
            <!-- Mobile Drawer Brand Header & Close Button -->
            <div class="p-5 border-b border-neutral-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-display font-bold text-slate-900 text-base leading-tight block">PUJA ADMIN</span>
                        <span class="text-[10px] text-emerald-400 font-bold tracking-wider uppercase">CMS Panel</span>
                    </div>
                </div>
                <button type="button" id="admin-close-mobile-btn" class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition" aria-label="Tutup Menu">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Mobile Navigation Links -->
            <nav class="p-4 space-y-1.5 text-sm font-medium">
                <a href="{{ route('admin.dashboard') }}" class="admin-mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                    Katalog & Produk
                </div>
                <a href="{{ route('admin.packages.index') }}" class="admin-mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.packages.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                    <i data-lucide="palmtree" class="w-5 h-5 shrink-0"></i>
                    <span>Paket Wisata</span>
                </a>

                <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                    Operasional
                </div>
                <a href="{{ route('admin.reservations.index') }}" class="admin-mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.reservations.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
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
                <a href="{{ route('admin.galleries.index') }}" class="admin-mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.galleries.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                    <i data-lucide="image" class="w-5 h-5 shrink-0"></i>
                    <span>Galeri Foto</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="admin-mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                    <i data-lucide="message-square-quote" class="w-5 h-5 shrink-0"></i>
                    <span>Ulasan Testimoni</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="admin-mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.faqs.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                    <i data-lucide="help-circle" class="w-5 h-5 shrink-0"></i>
                    <span>Tanya Jawab (FAQ)</span>
                </a>

                <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                    Pengaturan
                </div>
                <a href="{{ route('admin.settings.index') }}" class="admin-mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                    <i data-lucide="settings" class="w-5 h-5 shrink-0"></i>
                    <span>Kontak & CMS</span>
                </a>
            </nav>
        </div>

        <!-- User Info & Logout -->
        <div class="p-4 border-t border-neutral-200 bg-neutral-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-xl bg-emerald-700 text-white flex items-center justify-center font-bold text-sm shrink-0">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="truncate">
                        <span class="text-xs font-bold text-slate-900 block truncate">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="text-[10px] text-slate-500 block">{{ auth()->user()->username ?? 'admin' }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.logout') }}" title="Keluar" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex overflow-hidden">
        <!-- Desktop Sidebar Navigation (Solid Slate 900) -->
        <aside id="admin-sidebar" class="w-64 bg-white text-slate-700 shrink-0 flex-col justify-between hidden md:flex border-r border-neutral-200">
            <div>
                <!-- Brand Header -->
                <div class="p-5 border-b border-neutral-200 flex items-center gap-3">
                    <div class="w-11 h-11 shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-display font-bold text-slate-900 text-base leading-tight block">PUJA ADMIN</span>
                        <span class="text-[10px] text-emerald-400 font-bold tracking-wider uppercase">CMS Panel</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>
                        <span>Dashboard</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Katalog & Produk
                    </div>
                    <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.packages.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <i data-lucide="palmtree" class="w-5 h-5 shrink-0"></i>
                        <span>Paket Wisata</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Operasional
                    </div>
                    <a href="{{ route('admin.reservations.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.reservations.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
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
                    <a href="{{ route('admin.galleries.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.galleries.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <i data-lucide="image" class="w-5 h-5 shrink-0"></i>
                        <span>Galeri Foto</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <i data-lucide="message-square-quote" class="w-5 h-5 shrink-0"></i>
                        <span>Ulasan Testimoni</span>
                    </a>
                    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.faqs.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <i data-lucide="help-circle" class="w-5 h-5 shrink-0"></i>
                        <span>Tanya Jawab (FAQ)</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        Pengaturan
                    </div>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-emerald-700 text-white font-bold shadow-sm' : 'hover:bg-emerald-50 hover:text-emerald-700' }}">
                        <i data-lucide="settings" class="w-5 h-5 shrink-0"></i>
                        <span>Kontak & CMS</span>
                    </a>
                </nav>
            </div>

            <!-- User Info & Logout -->
            <div class="p-4 border-t border-neutral-200 bg-neutral-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-xl bg-emerald-700 text-white flex items-center justify-center font-bold text-sm shrink-0">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="truncate">
                            <span class="text-xs font-bold text-slate-900 block truncate">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <span class="text-[10px] text-slate-500 block">{{ auth()->user()->username ?? 'admin' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.logout') }}" title="Keluar" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <!-- Topbar Header -->
            <header class="bg-surface-soft border-b border-neutral-200 px-4 sm:px-6 py-3.5 sm:py-4 flex items-center justify-between sticky top-0 z-30 shadow-2xs">
                <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                    <!-- Mobile Hamburger Menu Button -->
                    <button type="button" id="admin-open-mobile-btn" class="p-2.5 rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition md:hidden shrink-0 flex items-center justify-center shadow-sm" aria-label="Buka Menu Admin">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                    <h1 class="font-display font-bold text-base sm:text-xl text-slate-800 truncate">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3.5 py-1.5 sm:py-2 rounded-xl text-xs font-bold text-emerald-800 bg-emerald-50 hover:bg-emerald-100 transition border border-emerald-200">
                        <i data-lucide="external-link" class="w-3.5 h-3.5 shrink-0"></i>
                        <span class="hidden sm:inline">Lihat Website Publik</span>
                        <span class="sm:hidden">Web</span>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-4 sm:p-6 lg:p-8 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Reusable Modern Delete Confirmation Modal -->
    <div id="admin-delete-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs transition-all duration-300 opacity-0 pointer-events-none">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 transform scale-95 transition-all duration-300 space-y-5 text-left">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center shrink-0 shadow-xs">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1 min-w-0 flex-1">
                    <h3 id="admin-delete-modal-title" class="font-display font-bold text-lg text-slate-900 leading-tight">Konfirmasi Hapus Data</h3>
                    <p id="admin-delete-modal-message" class="text-xs text-slate-500 leading-relaxed">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" id="admin-delete-modal-cancel" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs transition cursor-pointer">
                    Batal
                </button>
                <button type="button" id="admin-delete-modal-confirm" class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    <span>Ya, Hapus Sekarang</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Chart.js for Admin Analytics Dashboard -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var openBtn = document.getElementById('admin-open-mobile-btn');
        var closeBtn = document.getElementById('admin-close-mobile-btn');
        var drawer = document.getElementById('admin-mobile-drawer');
        var overlay = document.getElementById('admin-mobile-overlay');

        function openAdminMobileMenu() {
            if (!drawer || !overlay) return;
            overlay.classList.remove('pointer-events-none', 'opacity-0');
            overlay.classList.add('opacity-100');
            drawer.classList.remove('-translate-x-full');
            document.body.style.overflow = 'hidden';
            if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
        }

        function closeAdminMobileMenu() {
            if (!drawer || !overlay) return;
            drawer.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        }

        if (openBtn) openBtn.addEventListener('click', openAdminMobileMenu);
        if (closeBtn) closeBtn.addEventListener('click', closeAdminMobileMenu);
        if (overlay) overlay.addEventListener('click', closeAdminMobileMenu);

        var navLinks = document.querySelectorAll('.admin-mobile-nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', closeAdminMobileMenu);
        });

        window.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAdminMobileMenu();
        });
    });

    window.confirmDelete = function(event, message, title) {
        if (event) event.preventDefault();
        var targetForm = event ? (event.target.tagName === 'FORM' ? event.target : event.target.closest('form')) : null;

        var modal = document.getElementById('admin-delete-modal');
        var modalTitle = document.getElementById('admin-delete-modal-title');
        var modalMsg = document.getElementById('admin-delete-modal-message');
        var confirmBtn = document.getElementById('admin-delete-modal-confirm');
        var cancelBtn = document.getElementById('admin-delete-modal-cancel');
        var dialog = modal ? modal.querySelector('div') : null;

        if (!modal || !targetForm) {
            if (targetForm) targetForm.submit();
            return;
        }

        if (modalTitle) modalTitle.textContent = title || 'Konfirmasi Hapus Data';
        if (modalMsg) modalMsg.textContent = message || 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';

        modal.classList.remove('pointer-events-none', 'opacity-0');
        modal.classList.add('opacity-100');
        if (dialog) {
            dialog.classList.remove('scale-95');
            dialog.classList.add('scale-100');
        }
        if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();

        function closeModal() {
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0', 'pointer-events-none');
            if (dialog) {
                dialog.classList.remove('scale-100');
                dialog.classList.add('scale-95');
            }
            cleanup();
        }

        function handleConfirm() {
            closeModal();
            targetForm.submit();
        }

        function handleKeyDown(e) {
            if (e.key === 'Escape') closeModal();
        }

        function handleOverlayClick(e) {
            if (e.target === modal) closeModal();
        }

        function cleanup() {
            if (confirmBtn) confirmBtn.removeEventListener('click', handleConfirm);
            if (cancelBtn) cancelBtn.removeEventListener('click', closeModal);
            if (modal) modal.removeEventListener('click', handleOverlayClick);
            window.removeEventListener('keydown', handleKeyDown);
        }

        if (confirmBtn) confirmBtn.addEventListener('click', handleConfirm);
        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        if (modal) modal.addEventListener('click', handleOverlayClick);
        window.addEventListener('keydown', handleKeyDown);
    };

    // Automatic interceptor for forms using standard confirm()
    document.addEventListener('submit', function(e) {
        var form = e.target;
        var onsubmitAttr = form.getAttribute('onsubmit') || '';
        if (onsubmitAttr.includes('confirm(') && !form.dataset.customConfirming) {
            e.preventDefault();
            e.stopImmediatePropagation();
            form.dataset.customConfirming = 'true';

            var match = onsubmitAttr.match(/confirm\((['"])(.*?)\1\)/);
            var customMsg = match ? match[2] : 'Apakah Anda yakin ingin menghapus data ini?';

            window.confirmDelete(e, customMsg);
            setTimeout(function() { delete form.dataset.customConfirming; }, 500);
        }
    }, true);
    </script>
    @stack('scripts')
</body>
</html>
