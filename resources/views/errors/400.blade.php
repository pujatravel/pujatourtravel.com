@extends('errors.layout')

@section('title', '400 - Permintaan Tidak Valid')
@section('description', 'Format permintaan atau parameter URL tidak dikenali oleh sistem server.')

@section('content')
<div class="relative bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-10 lg:p-12 shadow-soft border border-neutral-200 overflow-hidden text-center">
    <!-- Big Decorative Watermark -->
    <span class="font-display font-black text-7xl xs:text-8xl sm:text-9xl text-slate-100 select-none absolute -top-8 left-1/2 -translate-x-1/2 pointer-events-none tracking-tighter opacity-80 z-0">
        400
    </span>

    <div class="relative z-10">
        <!-- Status Pill Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-100 border border-slate-200 text-slate-800 text-xs font-bold uppercase tracking-wider mb-5 sm:mb-6 shadow-2xs">
            <span class="w-2 h-2 rounded-full bg-slate-500 animate-pulse"></span>
            <span>Error 400 • Permintaan Tidak Valid</span>
        </div>

        <!-- Visual Icon Box -->
        <div class="relative w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 mx-auto mb-5 sm:mb-6 flex items-center justify-center">
            <div class="absolute inset-0 rounded-2xl sm:rounded-3xl bg-slate-500/10 animate-ping opacity-30"></div>
            <div class="w-full h-full rounded-2xl sm:rounded-3xl bg-slate-100 border border-slate-200 text-slate-700 flex items-center justify-center shadow-xs">
                <i data-lucide="alert-circle" class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 stroke-[1.5]"></i>
            </div>
        </div>

        <!-- Headline & Description -->
        <h1 class="font-display font-extrabold text-xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
            Arah Kompas Kurang Tepat
        </h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-2.5 sm:mt-3 max-w-lg mx-auto leading-relaxed">
            Sistem mendeteksi adanya format data atau tautan parameter yang tidak dikenali oleh server. Silakan kembali ke beranda untuk memulai eksplorasi destinasi dari awal.
        </p>

        <!-- Action CTA Buttons -->
        <div class="flex flex-col xs:flex-row flex-wrap items-stretch xs:items-center justify-center gap-2.5 sm:gap-3 mt-6 sm:mt-7">
            <a href="{{ route('home') }}" class="w-full xs:w-auto px-5 sm:px-6 py-2.5 sm:py-3 min-h-11 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center justify-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Kembali ke Beranda</span>
            </a>
            <a href="{{ route('packages.index') }}" class="w-full xs:w-auto px-5 sm:px-6 py-2.5 sm:py-3 min-h-11 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center justify-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="map" class="w-4 h-4"></i>
                <span>Jelajah Paket Wisata</span>
            </a>
            <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20mengalami%20error%20400%20di%20website" 
               target="_blank" 
               class="w-full xs:w-auto px-5 sm:px-6 py-2.5 sm:py-3 min-h-11 rounded-xl bg-white hover:bg-slate-50 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 shadow-2xs hover:shadow-xs transition-all duration-300 flex items-center justify-center gap-2 hover:-translate-y-0.5">
                <i data-lucide="message-circle" class="w-4 h-4 text-emerald-700"></i>
                <span>Bantuan Admin</span>
            </a>
        </div>

        <div class="mt-8 pt-7 border-t border-neutral-100 text-[11px] text-slate-400">
            <p>Jika masalah ini berulang secara terus-menerus, coba bersihkan cache peramban Anda atau gunakan mode privat.</p>
        </div>
    </div>
</div>
@endsection
