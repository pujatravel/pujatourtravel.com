@extends('errors.layout')

@section('title', '503 - Pemeliharaan Sistem Berkala')
@section('description', 'Website Puja Tour & Travel sedang dalam peningkatan performa sistem. Reservasi tetap melayani Anda 24/7 via WhatsApp.')

@section('content')
<div class="relative bg-white rounded-3xl p-7 sm:p-12 shadow-soft border border-neutral-200 overflow-hidden text-center">
    <!-- Big Decorative Watermark -->
    <span class="font-display font-black text-8xl sm:text-9xl text-slate-100 select-none absolute -top-8 left-1/2 -translate-x-1/2 pointer-events-none tracking-tighter opacity-80 z-0">
        503
    </span>

    <div class="relative z-10">
        <!-- Status Pill Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200/80 text-amber-900 text-xs font-bold uppercase tracking-wider mb-6 shadow-2xs">
            <span class="w-2 h-2 rounded-full bg-amber-600 animate-pulse"></span>
            <span>Error 503 • Sedang Pemeliharaan Sistem</span>
        </div>

        <!-- Visual Icon Box -->
        <div class="relative w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 flex items-center justify-center">
            <div class="absolute inset-0 rounded-3xl bg-amber-500/10 animate-ping opacity-30"></div>
            <div class="w-full h-full rounded-3xl bg-amber-50 border border-amber-200 text-amber-700 flex items-center justify-center shadow-xs">
                <i data-lucide="wrench" class="w-10 h-10 sm:w-12 sm:h-12 stroke-[1.5]"></i>
            </div>
        </div>

        <!-- Headline & Description -->
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
            Peningkatan Kualitas Jalur Wisata
        </h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-lg mx-auto leading-relaxed">
            Website Puja Tour & Travel sedang menjalani pemeliharaan berkala untuk mempercepat loading dan mengoptimalkan sistem booking online paket wisata Pangandaran.
        </p>

        <!-- Emergency Booking Alert Box -->
        <div class="mt-6 p-4 sm:p-5 rounded-2xl bg-emerald-50/80 border border-emerald-200/90 text-left max-w-md mx-auto shadow-2xs">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-2xs">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-xs sm:text-sm font-bold text-slate-900">Butuh Booking Cepat Hari Ini?</h2>
                    <p class="text-slate-600 text-[11px] sm:text-xs mt-0.5 leading-relaxed">
                        Layanan konsultasi jadwal keberangkatan, info hotel, dan booking Green Canyon tetap aktif 24/7 melalui WhatsApp Customer Service kami.
                    </p>
                </div>
            </div>
        </div>

        <!-- Action CTA Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-3 mt-7">
            <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20paket%20wisata%20saat%20website%20maintenance" 
               target="_blank" 
               class="px-5 sm:px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center gap-2 shadow-xs hover:-translate-y-0.5">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Chat Admin WhatsApp</span>
            </a>
            <button onclick="window.location.reload()" class="px-5 sm:px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm transition-all duration-300 flex items-center gap-2 shadow-xs hover:-translate-y-0.5 cursor-pointer">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                <span>Cek Status / Muat Ulang</span>
            </button>
        </div>

        <div class="mt-8 pt-7 border-t border-neutral-100 text-[11px] text-slate-400">
            <p>Estimasi waktu pemeliharaan server berkisar antara 5 - 15 menit. Mohon maaf atas ketidaknyamanan sementara ini.</p>
        </div>
    </div>
</div>
@endsection
