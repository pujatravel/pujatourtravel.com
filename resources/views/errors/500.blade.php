@extends('errors.layout')

@section('title', '500 - Terjadi Kendala Server')
@section('description', 'Mohon maaf, sistem sedang mengalami kendala teknis sementara. Anda tetap dapat memesan via WhatsApp.')

@section('content')
<div class="bg-surface-soft rounded-3xl p-8 sm:p-12 shadow-soft border border-neutral-200">
    <!-- Status Badge -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 border border-red-200 text-red-800 text-xs font-bold uppercase tracking-wider mb-6">
        <span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
        <span>Error 500 • Kendala Server Internal</span>
    </div>

    <!-- Visual Icon -->
    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-red-50 text-red-600 mx-auto flex items-center justify-center mb-6 shadow-inner">
        <i data-lucide="server-crash" class="w-12 h-12 sm:w-14 sm:h-14 stroke-[1.5]"></i>
    </div>

    <!-- Main Message -->
    <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
        Sistem Sedang Mengalami Kendala
    </h1>
    <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-lg mx-auto leading-relaxed">
        Mohon maaf, sistem server kami sedang mengalami gangguan teknis sementara. Tim kami sedang bekerja memperbaikinya agar Anda dapat kembali merencanakan liburan dengan lancar.
    </p>

    <!-- Emergency WhatsApp Notice Box -->
    <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm max-w-md mx-auto text-left flex items-start gap-3">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5"></i>
        <div>
            <span class="font-bold block">Pemesanan & Konsultasi Tetap Buka!</span>
            <p class="text-emerald-800 text-xs mt-0.5">Layanan reservasi tetap aktif langsung melalui WhatsApp resmi admin kami.</p>
        </div>
    </div>

    <!-- Quick Action Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
        <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20mendapati%20error%20500%20di%20website%20dan%20ingin%20booking%20langsung%20via%20WA" 
           target="_blank" 
           class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="message-circle" class="w-4 h-4"></i>
            <span>Pesan Langsung via WhatsApp</span>
        </a>
        <button onclick="window.location.reload()" class="px-6 py-3 rounded-xl bg-white hover:bg-neutral-100 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 transition flex items-center gap-2 cursor-pointer">
            <i data-lucide="refresh-cw" class="w-4 h-4 text-slate-600"></i>
            <span>Coba Lagi</span>
        </button>
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="home" class="w-4 h-4"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <div class="mt-10 pt-8 border-t border-neutral-200 text-xs text-slate-500">
        <p>Kode Insiden Otomatis tercatat di log pemeliharaan sistem.</p>
    </div>
</div>
@endsection
