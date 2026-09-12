@extends('errors.layout')

@section('title', '500 - Terjadi Kendala Server')
@section('description', 'Mohon maaf, sistem sedang mengalami kendala teknis sementara. Anda tetap dapat memesan via WhatsApp.')

@section('content')
<div class="relative bg-white rounded-3xl p-7 sm:p-12 shadow-soft border border-neutral-200 overflow-hidden text-center">
    <!-- Big Decorative Watermark -->
    <span class="font-display font-black text-8xl sm:text-9xl text-slate-100 select-none absolute -top-8 left-1/2 -translate-x-1/2 pointer-events-none tracking-tighter opacity-80 z-0">
        500
    </span>

    <div class="relative z-10">
        <!-- Status Pill Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose-50 border border-rose-200/80 text-rose-800 text-xs font-bold uppercase tracking-wider mb-6 shadow-2xs">
            <span class="w-2 h-2 rounded-full bg-rose-600 animate-pulse"></span>
            <span>Error 500 • Kendala Server Internal</span>
        </div>

        <!-- Visual Icon Box -->
        <div class="relative w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 flex items-center justify-center">
            <div class="absolute inset-0 rounded-3xl bg-rose-500/10 animate-ping opacity-30"></div>
            <div class="w-full h-full rounded-3xl bg-rose-50 border border-rose-200 text-rose-600 flex items-center justify-center shadow-xs">
                <i data-lucide="server-crash" class="w-10 h-10 sm:w-12 sm:h-12 stroke-[1.5]"></i>
            </div>
        </div>

        <!-- Headline & Description -->
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
            Sistem Sedang Mengalami Kendala Teknis
        </h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-lg mx-auto leading-relaxed">
            Mohon maaf atas ketidaknyamanan ini. Tim teknis kami sedang bekerja memperbaiki sistem agar Anda dapat kembali merencanakan agenda liburan dengan lancar.
        </p>

        <!-- Emergency WhatsApp Notice Box -->
        <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-950 text-xs sm:text-sm max-w-md mx-auto text-left flex items-start gap-3 shadow-2xs">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
            </div>
            <div>
                <span class="font-bold text-slate-900 block">Pemesanan & Konsultasi Tetap Aktif!</span>
                <p class="text-slate-600 text-xs mt-0.5 leading-relaxed">
                    Layanan reservasi dan booking trip tetap dapat Anda proses langsung via WhatsApp resmi Admin CS kami 24 jam.
                </p>
            </div>
        </div>

        <!-- Action CTA Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-3 mt-7">
            <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20mendapati%20error%20500%20di%20website%20dan%20ingin%20booking%20langsung%20via%20WA" 
               target="_blank" 
               class="px-5 sm:px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Chat Admin WhatsApp</span>
            </a>
            <button onclick="window.location.reload()" 
                    class="px-5 sm:px-6 py-3 rounded-xl bg-white hover:bg-slate-50 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 shadow-2xs hover:shadow-xs transition-all duration-300 flex items-center gap-2 cursor-pointer hover:-translate-y-0.5">
                <i data-lucide="refresh-cw" class="w-4 h-4 text-slate-600"></i>
                <span>Coba Lagi</span>
            </button>
            <a href="{{ route('home') }}" class="px-5 sm:px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

        <div class="mt-8 pt-7 border-t border-neutral-100 text-[11px] text-slate-400">
            <p>Kode insiden tercatat secara otomatis pada log pemeliharaan server kami.</p>
        </div>
    </div>
</div>
@endsection
