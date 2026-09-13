@php
    $footerSettings = $settings ?? [];
    if (empty($footerSettings)) {
        try {
            $footerSettings = \App\Models\Setting::all()->pluck('value', 'key');
        } catch (\Throwable $e) {
            $footerSettings = collect();
        }
    }
    if (!is_array($footerSettings) && !($footerSettings instanceof \ArrayAccess)) {
        $footerSettings = [];
    }
    $footerCompanyName = $footerSettings['company_name'] ?? ($companyName ?? 'PUJA TOUR & TRAVEL PANGANDARAN');
    $footerWaNum = $footerSettings['whatsapp_number'] ?? ($waNum ?? '6281234567890');
    $footerPhoneNum = $footerSettings['phone_number'] ?? ($phoneNum ?? '+62 812-3456-7890');
    $footerEmailAddr = $footerSettings['email_address'] ?? ($emailAddr ?? 'info@pujatourtravel.com');
    $footerOfficeAddr = $footerSettings['office_address'] ?? ($officeAddr ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396');
    $footerIg = $footerSettings['instagram_url'] ?? ($igUrl ?? 'https://www.instagram.com/puja_tourtravel/');
    $footerTiktok = $footerSettings['tiktok_url'] ?? ($tiktokUrl ?? 'https://tiktok.com/@pujatourtravel');
    $footerFb = $footerSettings['facebook_url'] ?? 'https://facebook.com';
    $footerYt = $footerSettings['youtube_url'] ?? 'https://youtube.com';

    // Ambil paket favorit untuk footer secara aman
    if (isset($packages) && ($packages instanceof \Illuminate\Support\Collection || is_array($packages)) && count($packages) > 0) {
        $footerPackages = collect($packages)->take(5);
    } else {
        try {
            $footerPackages = \App\Models\Package::where('status', 'PUBLISHED')
                ->orderByDesc('featured')
                ->latest()
                ->take(5)
                ->get();
        } catch (\Throwable $e) {
            $footerPackages = collect();
        }
    }
@endphp

<!-- GLOBAL FOOTER (Solid Slate 950) -->
<footer data-nav-color="dark" class="bg-slate-950 text-slate-400 text-xs pt-14 pb-20 sm:pb-14 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-5 gap-8 sm:gap-10 pb-12 border-b border-slate-800">
            <!-- Col 1: Brand Info -->
            <div class="col-span-2 lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Puja Tour Travel" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-display font-extrabold text-xl text-white block">{{ $footerCompanyName }}</span>
                        <span class="text-[10px] text-emerald-400 tracking-widest uppercase font-bold">Pangandaran Destination Specialist</span>
                    </div>
                </div>
                <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                    Mitra terpercaya liburan dan petualangan di Pangandaran. Berbadan hukum resmi CV dengan pemandu lokal bersertifikat HPI dan standar keselamatan teruji.
                </p>
                <div class="flex items-center gap-2.5 pt-2 text-slate-300">
                    <a href="{{ $footerIg }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="{{ $footerTiktok }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.298-.002.595.042.88.13V9.4a6.33 6.33 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.66a6.34 6.34 0 0 0 10.82 4.49 6.27 6.27 0 0 0 1.89-4.49V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-.9-.07z"/>
                        </svg>
                    </a>
                    <a href="{{ $footerFb }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <a href="{{ $footerYt }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-emerald-700 hover:text-white transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33zM9.75 15.02V8.5l5.75 3.26-5.75 3.26z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Col 2: Navigasi Cepat (Kiri di Mobile) -->
            <div class="col-span-1 lg:col-span-1">
                <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-4">Navigasi</h4>
                <ul class="space-y-2.5">
                    @if(!request()->routeIs('home'))
                        <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition">Beranda</a></li>
                    @endif
                    @if(!request()->routeIs('packages.index'))
                        <li><a href="{{ route('packages.index') }}" class="hover:text-emerald-400 transition">Paket Wisata</a></li>
                    @endif
                    @if(!request()->routeIs('about'))
                        <li><a href="{{ route('about') }}" class="hover:text-emerald-400 transition">Tentang Kami</a></li>
                    @endif
                    @if(!request()->routeIs('calculator'))
                        <li><a href="{{ route('calculator') }}" class="hover:text-emerald-400 transition">Estimasi Biaya</a></li>
                    @endif
                    @if(!request()->routeIs('gallery'))
                        <li><a href="{{ route('gallery') }}" class="hover:text-emerald-400 transition">Galeri Foto</a></li>
                    @endif
                    @if(!request()->routeIs('testimonial'))
                        <li><a href="{{ route('testimonial') }}" class="hover:text-emerald-400 transition">Ulasan Wisatawan</a></li>
                    @endif
                    @if(!request()->routeIs('faq'))
                        <li><a href="{{ route('faq') }}" class="hover:text-emerald-400 transition">Tanya Jawab (FAQ)</a></li>
                    @endif
                    @if(!request()->routeIs('contact'))
                        <li><a href="{{ route('contact') }}" class="hover:text-emerald-400 transition">Kontak & Lokasi</a></li>
                    @endif
                </ul>
            </div>

            <!-- Col 3: Paket Favorit (Kanan di Mobile) -->
            <div class="col-span-1 lg:col-span-1">
                <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-4">Paket Favorit</h4>
                <ul class="space-y-2.5">
                    @if(isset($footerPackages) && $footerPackages->isNotEmpty())
                        @foreach($footerPackages as $fp)
                            <li>
                                <a href="{{ route('packages.show', $fp->slug) }}" class="hover:text-emerald-400 transition line-clamp-1 block" title="{{ $fp->name }}">
                                    {{ $fp->name }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="{{ route('packages.index') }}" class="hover:text-emerald-400 transition">Body Rafting Green Canyon</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-emerald-400 transition">River Tubing Santirah</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-emerald-400 transition">Body Rafting Citumang</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-emerald-400 transition">Snorkeling Pasir Putih</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-emerald-400 transition">Jelajah Gua Cagar Alam</a></li>
                    @endif
                </ul>
            </div>

            <!-- Col 4: Metode Pembayaran (Full-width di Mobile) -->
            <div class="col-span-2 md:col-span-2 lg:col-span-1">
                <h4 class="font-display font-bold text-white text-sm uppercase tracking-wider mb-2.5">Pembayaran Aman</h4>
                <p class="text-[11px] text-slate-400 mb-3">Menerima transfer bank resmi CV & pembayaran digital:</p>
                <div class="grid grid-cols-4 sm:grid-cols-2 lg:grid-cols-2 gap-2 text-center text-[10px] font-bold text-slate-200">
                    <div class="bg-slate-900 py-1.5 px-2 rounded-md border border-slate-800">BCA</div>
                    <div class="bg-slate-900 py-1.5 px-2 rounded-md border border-slate-800">MANDIRI</div>
                    <div class="bg-slate-900 py-1.5 px-2 rounded-md border border-slate-800">BRI</div>
                    <div class="bg-slate-900 py-1.5 px-2 rounded-md border border-slate-800">QRIS</div>
                </div>
            </div>
        </div>

        <!-- Bottom Row: Copyright & Legal Links -->
        <div class="pt-8 flex flex-col-reverse sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-500">
            <p class="text-center sm:text-left">
                <a href="{{ route('developers') }}" class="text-slate-500 hover:text-slate-500 no-underline cursor-default select-none focus:outline-hidden inline-block" title="© {{ date('Y') }} {{ $footerCompanyName }}">
                    © {{ date('Y') }} {{ $footerCompanyName }}. Hak Cipta Dilindungi Undang-Undang.
                </a>
            </p>
            <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2">
                <a href="{{ route('privacy-policy') }}" class="{{ request()->routeIs('privacy-policy') ? 'text-emerald-400 font-semibold' : 'hover:text-emerald-400' }} transition">Kebijakan Privasi</a>
                <span>•</span>
                <a href="{{ route('terms-conditions') }}" class="{{ request()->routeIs('terms-conditions') ? 'text-emerald-400 font-semibold' : 'hover:text-emerald-400' }} transition">Syarat & Ketentuan</a>
                <span>•</span>
                <a href="{{ route('refund-policy') }}" class="{{ request()->routeIs('refund-policy') ? 'text-emerald-400 font-semibold' : 'hover:text-emerald-400' }} transition">Kebijakan Pengembalian</a>
            </div>
        </div>
    </div>
</footer>
