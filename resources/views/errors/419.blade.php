@extends('errors.layout')

@section('title', '419 - Sesi Keamanan Berakhir')
@section('description', 'Sesi keamanan halaman Anda telah berakhir. Silakan muat ulang untuk memperbarui token keamanan.')

@section('content')
<div class="relative bg-white rounded-3xl p-7 sm:p-12 shadow-soft border border-neutral-200 overflow-hidden text-center">
    <!-- Big Decorative Watermark -->
    <span class="font-display font-black text-8xl sm:text-9xl text-slate-100 select-none absolute -top-8 left-1/2 -translate-x-1/2 pointer-events-none tracking-tighter opacity-80 z-0">
        419
    </span>

    <div class="relative z-10">
        <!-- Status Pill Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200/80 text-blue-900 text-xs font-bold uppercase tracking-wider mb-6 shadow-2xs">
            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            <span>Error 419 • Sesi Kedaluwarsa</span>
        </div>

        <!-- Visual Icon Box -->
        <div class="relative w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 flex items-center justify-center">
            <div class="absolute inset-0 rounded-3xl bg-blue-500/10 animate-ping opacity-30"></div>
            <div class="w-full h-full rounded-3xl bg-blue-50 border border-blue-200 text-blue-700 flex items-center justify-center shadow-xs">
                <i data-lucide="history" class="w-10 h-10 sm:w-12 sm:h-12 stroke-[1.5]"></i>
            </div>
        </div>

        <!-- Headline & Description -->
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
            Sesi Keamanan Telah Berakhir
        </h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-lg mx-auto leading-relaxed">
            Halaman dibiarkan terbuka terlalu lama tanpa aktivitas sehingga token enkripsi sesi (CSRF) ditutup otomatis demi menjaga kerahasiaan data reservasi Anda.
        </p>

        <!-- Action CTA Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-3 mt-7">
            <button onclick="window.location.reload()" class="px-5 sm:px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center gap-2 shadow-xs hover:-translate-y-0.5 cursor-pointer">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                <span>Muat Ulang Halaman</span>
            </button>
            <a href="{{ route('home') }}" class="px-5 sm:px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Kembali ke Beranda</span>
            </a>
            <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20sesi%20formulir%20saya%20kedaluwarsa" 
               target="_blank" 
               class="px-5 sm:px-6 py-3 rounded-xl bg-white hover:bg-slate-50 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 shadow-2xs hover:shadow-xs transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                <i data-lucide="message-circle" class="w-4 h-4 text-emerald-700"></i>
                <span>Bantuan CS</span>
            </a>
        </div>

        <!-- Security Notice Info -->
        <div class="mt-8 pt-7 border-t border-neutral-100 text-xs text-slate-500">
            <div class="inline-flex items-center gap-2 bg-slate-50 px-3.5 py-2 rounded-xl border border-neutral-200 text-slate-600 text-[11px] sm:text-xs">
                <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                <span>Sistem Puja Tour menerapkan proteksi CSRF untuk menjamin transaksi & data pribadi Anda tetap aman.</span>
            </div>
        </div>
    </div>
</div>
@endsection
