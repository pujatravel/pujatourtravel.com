@extends('errors.layout')

@section('title', '419 - Sesi Halaman Kedaluwarsa')
@section('description', 'Sesi keamanan halaman Anda telah berakhir. Silakan muat ulang untuk memperbarui.')

@section('content')
<div class="bg-surface-soft rounded-3xl p-8 sm:p-12 shadow-soft border border-neutral-200">
    <!-- Status Badge -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-blue-800 text-xs font-bold uppercase tracking-wider mb-6">
        <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
        <span>Error 419 • Sesi Kedaluwarsa</span>
    </div>

    <!-- Visual Icon -->
    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-blue-50 text-blue-700 mx-auto flex items-center justify-center mb-6 shadow-inner">
        <i data-lucide="history" class="w-12 h-12 sm:w-14 sm:h-14 stroke-[1.5]"></i>
    </div>

    <!-- Main Message -->
    <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
        Sesi Keamanan Telah Berakhir
    </h1>
    <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-lg mx-auto leading-relaxed">
        Halaman dibiarkan terbuka terlalu lama tanpa aktivitas sehingga token keamanan (CSRF) kedaluwarsa. Muat ulang halaman untuk memperbarui token dan melanjutkan pengisian.
    </p>

    <!-- Quick Action Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
        <button onclick="window.location.reload()" class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm cursor-pointer">
            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
            <span>Muat Ulang Halaman</span>
        </button>
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="home" class="w-4 h-4"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Helpful Tip -->
    <div class="mt-10 pt-8 border-t border-neutral-200 text-xs text-slate-500">
        <p>Tips: Jangan biarkan tab formulir terbuka terlalu lama tanpa pengiriman untuk menjaga integritas data pemesanan Anda.</p>
    </div>
</div>
@endsection
