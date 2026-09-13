@php
    $navSettings = $settings ?? [];
    if (!is_array($navSettings) && !($navSettings instanceof \ArrayAccess)) {
        $navSettings = [];
    }
    $navWaNum = $navSettings['whatsapp_number'] ?? '6281234567890';
    $isHome = request()->routeIs('home');

    $navLinks = [
        [
            'name' => 'Beranda',
            'url' => $isHome ? '#beranda' : route('home'),
            'active' => request()->routeIs('home'),
        ],
        [
            'name' => 'Paket Wisata',
            'url' => route('packages.index'),
            'active' => request()->routeIs('packages.*'),
        ],
        [
            'name' => 'Tentang Kami',
            'url' => route('about'),
            'active' => request()->routeIs('about'),
        ],
        [
            'name' => 'Estimasi Biaya',
            'url' => route('calculator'),
            'active' => request()->routeIs('calculator'),
        ],
        [
            'name' => 'FAQ',
            'url' => route('faq'),
            'active' => request()->routeIs('faq'),
        ],
        [
            'name' => 'Galeri',
            'url' => route('gallery'),
            'active' => request()->routeIs('gallery'),
        ],
        [
            'name' => 'Testimonial',
            'url' => route('testimonial'),
            'active' => request()->routeIs('testimonial*'),
        ],
        [
            'name' => 'Kontak',
            'url' => route('contact'),
            'active' => request()->routeIs('contact'),
        ],
    ];
@endphp

<!-- GLOBAL NAVBAR HEADER -->
<header id="main-header" class="{{ $isHome ? 'fixed top-0 left-0 right-0 z-40 w-full py-3 sm:py-3.5 is-transparent-nav' : 'sticky top-0 z-40 w-full bg-surface-soft/95 backdrop-blur-md transition-all duration-300 py-3.5 shadow-xs is-white-nav' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-3">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
            <div class="w-9 h-9 sm:w-11 sm:h-11 shrink-0 flex items-center justify-center">
                <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja Tour & Travel" class="w-full h-full object-contain drop-shadow-xs">
            </div>
            <div class="flex flex-col">
                <span class="nav-brand-title font-display font-extrabold text-base sm:text-lg lg:text-xl leading-tight tracking-tight text-slate-900 group-hover:text-emerald-700 transition-colors duration-300">
                    PUJA<span class="nav-brand-accent text-emerald-600 transition-colors duration-300 ml-1">TOUR</span>
                </span>
                <span class="nav-brand-subtitle text-[9px] sm:text-[10px] tracking-widest font-bold text-slate-500 uppercase transition-colors duration-300 hidden sm:block">
                    & Travel Pangandaran
                </span>
            </div>
        </a>

        <!-- Desktop Navigation (All 8 Items Consistently Available) -->
        <nav class="hidden lg:flex items-center gap-4.5 xl:gap-6 font-medium text-xs xl:text-sm">
            @foreach($navLinks as $item)
                <a href="{{ $item['url'] }}" 
                   class="nav-link-item {{ $item['active'] ? 'active font-bold' : '' }} transition-colors duration-200">
                    {{ $item['name'] }}
                </a>
            @endforeach
        </nav>

        <!-- Quick Action CTA Button (Desktop XL) -->
        <div class="hidden xl:flex items-center gap-3 shrink-0">
            <a href="https://wa.me/{{ $navWaNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20info%20paket%20wisata" 
               target="_blank" 
               class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-xs hover:shadow transition-all duration-200 flex items-center gap-1.5 hover:-translate-y-0.5">
                <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                <span>Tanya Admin</span>
            </a>
        </div>

        <!-- Mobile Hamburger Button -->
        <button id="mobile-menu-btn" aria-label="Buka Menu" class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-neutral-100 transition">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>
</header>

<!-- GLOBAL MOBILE DRAWER & BACKDROP -->
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
            <button id="close-menu-btn" class="close-drawer-btn p-2 rounded-xl text-slate-500 hover:bg-neutral-100 transition" aria-label="Tutup Menu">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <nav class="py-5 space-y-1 text-sm font-medium text-slate-700">
            @foreach($navLinks as $item)
                <a href="{{ $item['url'] }}" 
                   class="drawer-link flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ $item['active'] ? 'bg-emerald-50 text-emerald-700 font-bold' : 'hover:bg-neutral-100' }}">
                    <span>{{ $item['name'] }}</span>
                    @if($item['active'])
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                    @endif
                </a>
            @endforeach
        </nav>
    </div>

    <div class="pt-5 border-t border-neutral-200 space-y-2.5">
        <a href="https://wa.me/{{ $navWaNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20info%20paket%20wisata" 
           target="_blank" 
           class="w-full py-3 rounded-xl bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-2 hover:bg-emerald-800 transition shadow-xs">
            <i data-lucide="message-circle" class="w-4 h-4"></i>
            <span>Chat WhatsApp Resmi</span>
        </a>
    </div>
</div>
