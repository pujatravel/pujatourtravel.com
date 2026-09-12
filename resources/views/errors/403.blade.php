@extends('errors.layout')

@section('title', '403 - Akses Dibatasi')
@section('description', 'Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.')

@section('content')
<div class="relative bg-white rounded-3xl p-7 sm:p-12 shadow-soft border border-neutral-200 overflow-hidden text-center">
    <!-- Big Decorative Watermark -->
    <span class="font-display font-black text-8xl sm:text-9xl text-slate-100 select-none absolute -top-8 left-1/2 -translate-x-1/2 pointer-events-none tracking-tighter opacity-80 z-0">
        403
    </span>

    <div class="relative z-10">
        <!-- Status Pill Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200/80 text-amber-900 text-xs font-bold uppercase tracking-wider mb-6 shadow-2xs">
            <span class="w-2 h-2 rounded-full bg-amber-600 animate-pulse"></span>
            <span>Error 403 • Akses Dibatasi</span>
        </div>

        <!-- Visual Icon Box -->
        <div class="relative w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 flex items-center justify-center">
            <div class="absolute inset-0 rounded-3xl bg-amber-500/10 animate-ping opacity-30"></div>
            <div class="w-full h-full rounded-3xl bg-amber-50 border border-amber-200 text-amber-700 flex items-center justify-center shadow-xs">
                <i data-lucide="shield-alert" class="w-10 h-10 sm:w-12 sm:h-12 stroke-[1.5]"></i>
            </div>
        </div>

        <!-- Headline & Description -->
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
            Wilayah Akses Terbatas
        </h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-lg mx-auto leading-relaxed">
            Maaf, Anda tidak memiliki kredensial atau izin yang sah untuk membuka direktori ini. Pastikan Anda telah masuk dengan akun yang memiliki hak otorisasi.
        </p>

        <!-- Action CTA Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-3 mt-7">
            <a href="{{ route('home') }}" class="px-5 sm:px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Kembali ke Beranda</span>
            </a>
            <a href="{{ route('admin.login') }}" class="px-5 sm:px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="lock" class="w-4 h-4"></i>
                <span>Login Administrator</span>
            </a>
            <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20mengalami%20kendala%20akses%20di%20website" 
               target="_blank" 
               class="px-5 sm:px-6 py-3 rounded-xl bg-white hover:bg-slate-50 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 shadow-2xs hover:shadow-xs transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                <i data-lucide="message-circle" class="w-4 h-4 text-emerald-700"></i>
                <span>Bantuan CS</span>
            </a>
        </div>

        <div class="mt-8 pt-7 border-t border-neutral-100 text-[11px] text-slate-400">
            <p>Percobaan akses tanpa izin ke sistem administrasi internal dicatat otomatis demi keamanan data perusahaan.</p>
        </div>
    </div>
</div>
@endsection
