@extends('errors.layout')

@section('title', '404 - Halaman Tidak Ditemukan')
@section('description', 'Maaf, halaman wisata yang Anda cari tidak dapat ditemukan. Kembali ke katalog paket wisata Pangandaran kami.')

@section('content')
<div class="bg-surface-soft rounded-3xl p-8 sm:p-12 shadow-soft border border-neutral-200">
    <!-- Status Badge -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-6">
        <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
        <span>Error 404 • Halaman Tidak Ditemukan</span>
    </div>

    <!-- Visual Icon -->
    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-emerald-50 text-emerald-700 mx-auto flex items-center justify-center mb-6 shadow-inner">
        <i data-lucide="compass" class="w-12 h-12 sm:w-14 sm:h-14 stroke-[1.5]"></i>
    </div>

    <!-- Main Message -->
    <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
        Jalur Wisata Belum Terpetakan
    </h1>
    <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-lg mx-auto leading-relaxed">
        Maaf, halaman atau destinasi yang Anda tuju sepertinya telah dipindahkan, tidak aktif, atau terjadi kesalahan pengetikan alamat URL.
    </p>

    <!-- Search Input on 404 Page -->
    <div class="mt-8 max-w-md mx-auto">
        <form action="{{ route('packages.index') }}" method="GET" class="flex items-center gap-2 bg-white p-2 rounded-2xl border border-neutral-200 shadow-sm focus-within:ring-2 focus-within:ring-emerald-700 transition">
            <div class="flex-1 flex items-center gap-2 pl-3">
                <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                <input type="text" name="search" placeholder="Cari Green Canyon, Rafting, Snorkeling..." class="w-full text-xs sm:text-sm text-slate-800 placeholder-slate-400 outline-none bg-transparent">
            </div>
            <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Quick Action Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="home" class="w-4 h-4"></i>
            <span>Kembali ke Beranda</span>
        </a>
        <a href="{{ route('packages.index') }}" class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="map" class="w-4 h-4"></i>
            <span>Katalog Paket Wisata</span>
        </a>
        <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20tersesat%20di%20website%20dan%20ingin%20tanya%20paket%20wisata" 
           target="_blank" 
           class="px-6 py-3 rounded-xl bg-white hover:bg-neutral-100 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 transition flex items-center gap-2">
            <i data-lucide="message-circle" class="w-4 h-4 text-emerald-700"></i>
            <span>Bantuan CS WhatsApp</span>
        </a>
    </div>

    <!-- Helpful Recommendations -->
    <div class="mt-10 pt-8 border-t border-neutral-200 text-xs text-slate-500">
        <span class="font-semibold text-slate-700 block mb-2">Destinasi Populer yang Sering Dikunjungi:</span>
        <div class="flex flex-wrap items-center justify-center gap-2">
            <a href="{{ route('packages.index', ['search' => 'Green Canyon']) }}" class="px-3 py-1.5 rounded-lg bg-white border border-neutral-200 hover:border-emerald-700 hover:text-emerald-700 transition">
                Green Canyon Body Rafting
            </a>
            <a href="{{ route('packages.index', ['search' => 'Snorkeling']) }}" class="px-3 py-1.5 rounded-lg bg-white border border-neutral-200 hover:border-emerald-700 hover:text-emerald-700 transition">
                Snorkeling Pasir Putih
            </a>
            <a href="{{ route('packages.index', ['search' => 'Santirah']) }}" class="px-3 py-1.5 rounded-lg bg-white border border-neutral-200 hover:border-emerald-700 hover:text-emerald-700 transition">
                River Tubing Santirah
            </a>
        </div>
    </div>
</div>
@endsection
