@extends('errors.layout')

@section('title', '403 - Akses Dibatasi')
@section('description', 'Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.')

@section('content')
<div class="bg-surface-soft rounded-3xl p-8 sm:p-12 shadow-soft border border-neutral-200">
    <!-- Status Badge -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200 text-amber-900 text-xs font-bold uppercase tracking-wider mb-6">
        <span class="w-2 h-2 rounded-full bg-amber-600 animate-pulse"></span>
        <span>Error 403 • Akses Dibatasi</span>
    </div>

    <!-- Visual Icon -->
    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-amber-50 text-amber-700 mx-auto flex items-center justify-center mb-6 shadow-inner">
        <i data-lucide="shield-alert" class="w-12 h-12 sm:w-14 sm:h-14 stroke-[1.5]"></i>
    </div>

    <!-- Main Message -->
    <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
        Area Akses Terbatas
    </h1>
    <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-lg mx-auto leading-relaxed">
        Maaf, Anda tidak memiliki hak akses atau kredensial yang memadai untuk membuka direktori ini. Pastikan Anda telah masuk dengan akun yang sesuai.
    </p>

    <!-- Quick Action Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="home" class="w-4 h-4"></i>
            <span>Kembali ke Beranda</span>
        </a>
        <a href="{{ route('admin.login') }}" class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="lock" class="w-4 h-4"></i>
            <span>Login Administrator</span>
        </a>
        <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20mengalami%20kendala%20akses%20di%20website" 
           target="_blank" 
           class="px-6 py-3 rounded-xl bg-white hover:bg-neutral-100 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 transition flex items-center gap-2">
            <i data-lucide="message-circle" class="w-4 h-4 text-emerald-700"></i>
            <span>Bantuan CS</span>
        </a>
    </div>

    <!-- Security Note -->
    <div class="mt-10 pt-8 border-t border-neutral-200 text-xs text-slate-500">
        <p>Akses tanpa izin ke sistem manajemen internal dicatat demi keamanan data perusahaan.</p>
    </div>
</div>
@endsection
