@extends('errors.layout')

@section('title', '429 - Terlalu Banyak Permintaan')
@section('description', 'Aktivitas pengiriman terlalu cepat. Mohon tunggu beberapa detik.')

@section('content')
<div class="bg-surface-soft rounded-3xl p-8 sm:p-12 shadow-soft border border-neutral-200">
    <!-- Status Badge -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-50 border border-purple-200 text-purple-900 text-xs font-bold uppercase tracking-wider mb-6">
        <span class="w-2 h-2 rounded-full bg-purple-600 animate-pulse"></span>
        <span>Error 429 • Batas Frekuensi Terlampaui</span>
    </div>

    <!-- Visual Icon -->
    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-purple-50 text-purple-700 mx-auto flex items-center justify-center mb-6 shadow-inner">
        <i data-lucide="gauge" class="w-12 h-12 sm:w-14 sm:h-14 stroke-[1.5]"></i>
    </div>

    <!-- Main Message -->
    <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
        Mohon Tunggu Sejenak
    </h1>
    <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-lg mx-auto leading-relaxed">
        Sistem mendeteksi terlalu banyak permintaan dalam waktu singkat. Demi menjaga performa dan stabilitas server untuk semua pengunjung, silakan tunggu beberapa saat.
    </p>

    <!-- Countdown / Action Area -->
    <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
        <button onclick="window.location.reload()" class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm cursor-pointer">
            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
            <span>Coba Lagi Sekarang</span>
        </button>
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="home" class="w-4 h-4"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <div class="mt-10 pt-8 border-t border-neutral-200 text-xs text-slate-500">
        <p>Batas kecepatan akan otomatis dipulihkan dalam beberapa detik.</p>
    </div>
</div>
@endsection
