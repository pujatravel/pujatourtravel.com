@extends('errors.layout')

@section('title', '404 - Jalur Wisata Belum Terpetakan')
@section('description', 'Halaman atau rute wisata yang Anda tuju tidak ditemukan. Temukan pilihan paket wisata resmi Pangandaran lainnya bersama Puja Tour.')

@section('content')
<div class="relative bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-10 lg:p-12 shadow-soft border border-neutral-200 overflow-hidden text-center">
    <!-- Big Decorative Watermark -->
    <span class="font-display font-black text-7xl xs:text-8xl sm:text-9xl text-slate-100 select-none absolute -top-8 left-1/2 -translate-x-1/2 pointer-events-none tracking-tighter opacity-80 z-0">
        404
    </span>

    <div class="relative z-10">
        <!-- Status Pill Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-5 sm:mb-6 shadow-2xs">
            <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
            <span>Error 404 • Halaman Tidak Ditemukan</span>
        </div>

        <!-- Animated Compass Icon Box -->
        <div class="relative w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 mx-auto mb-5 sm:mb-6 flex items-center justify-center">
            <div class="absolute inset-0 rounded-2xl sm:rounded-3xl bg-emerald-500/10 animate-ping opacity-40"></div>
            <div class="w-full h-full rounded-2xl sm:rounded-3xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center shadow-xs">
                <i data-lucide="compass" class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 stroke-[1.5]"></i>
            </div>
        </div>

        <!-- Headline & Description -->
        <h1 class="font-display font-extrabold text-xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
            Jalur Petualangan Belum Terpetakan
        </h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-2.5 sm:mt-3 max-w-lg mx-auto leading-relaxed">
            Sepertinya halaman yang Anda cari telah berpindah rute, sedang diperbarui, atau terjadi kesalahan pengetikan alamat URL. Mari temukan rute liburan seru Anda di bawah ini:
        </p>

        <!-- Search Input Box -->
        <div class="mt-6 sm:mt-7 max-w-md mx-auto">
            <form action="{{ route('packages.index') }}" method="GET" class="flex items-center gap-2 bg-slate-50 p-1.5 sm:p-2 rounded-2xl border border-neutral-200 shadow-2xs focus-within:ring-2 focus-within:ring-emerald-700 focus-within:bg-white transition-all">
                <div class="flex-1 flex items-center gap-2 pl-2.5 sm:pl-3 min-w-0">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                    <input type="text" name="search" placeholder="Cari paket wisata..." class="w-full text-xs sm:text-sm text-slate-800 placeholder-slate-400 outline-none bg-transparent font-medium">
                </div>
                <button type="submit" class="px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition shadow-xs shrink-0">
                    Cari
                </button>
            </form>
        </div>

        <!-- Action CTA Buttons -->
        <div class="flex flex-col xs:flex-row flex-wrap items-stretch xs:items-center justify-center gap-2.5 sm:gap-3 mt-6 sm:mt-7">
            <a href="{{ route('home') }}" class="w-full xs:w-auto px-5 sm:px-6 py-2.5 sm:py-3 min-h-11 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center justify-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Kembali ke Beranda</span>
            </a>
            <a href="{{ route('packages.index') }}" class="w-full xs:w-auto px-5 sm:px-6 py-2.5 sm:py-3 min-h-11 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center justify-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="map" class="w-4 h-4"></i>
                <span>Lihat Semua Paket</span>
            </a>
            <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20tersesat%20di%20website%20dan%20ingin%20tanya%20paket%20wisata" 
               target="_blank" 
               class="w-full xs:w-auto px-5 sm:px-6 py-2.5 sm:py-3 min-h-11 rounded-xl bg-white hover:bg-slate-50 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 shadow-2xs hover:shadow-xs transition-all duration-300 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                <i data-lucide="message-circle" class="w-4 h-4 text-emerald-700"></i>
                <span>Bantuan WhatsApp</span>
            </a>
        </div>

        <!-- Popular Destination Shortcuts -->
        <div class="mt-8 pt-7 border-t border-neutral-100 text-xs text-slate-500">
            <span class="font-bold text-slate-700 block mb-2.5 uppercase tracking-wider text-[11px]">Destinasi Populer Pilihan Wisatawan:</span>
            <div class="flex flex-wrap items-center justify-center gap-2">
                <a href="{{ route('packages.index', ['search' => 'Green Canyon']) }}" class="px-3 py-1.5 rounded-xl bg-slate-50 border border-neutral-200 hover:border-emerald-600 hover:text-emerald-700 hover:bg-emerald-50/50 transition">
                    Green Canyon Body Rafting
                </a>
                <a href="{{ route('packages.index', ['search' => 'Snorkeling']) }}" class="px-3 py-1.5 rounded-xl bg-slate-50 border border-neutral-200 hover:border-emerald-600 hover:text-emerald-700 hover:bg-emerald-50/50 transition">
                    Snorkeling Pasir Putih
                </a>
                <a href="{{ route('packages.index', ['search' => 'Santirah']) }}" class="px-3 py-1.5 rounded-xl bg-slate-50 border border-neutral-200 hover:border-emerald-600 hover:text-emerald-700 hover:bg-emerald-50/50 transition">
                    River Tubing Santirah
                </a>
                <a href="{{ route('packages.index', ['search' => 'Cagar Alam']) }}" class="px-3 py-1.5 rounded-xl bg-slate-50 border border-neutral-200 hover:border-emerald-600 hover:text-emerald-700 hover:bg-emerald-50/50 transition">
                    Jelajah Cagar Alam
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
