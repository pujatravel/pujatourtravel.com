@extends('errors.layout')

@section('title', '503 - Sedang Dalam Pemeliharaan')
@section('description', 'Website Puja Tour & Travel sedang dalam peningkatan performa berkala.')

@section('content')
<div class="bg-surface-soft rounded-3xl p-8 sm:p-12 shadow-soft border border-neutral-200">
    <!-- Status Badge -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200 text-amber-900 text-xs font-bold uppercase tracking-wider mb-6">
        <span class="w-2 h-2 rounded-full bg-amber-600 animate-pulse"></span>
        <span>Error 503 • Pemeliharaan Sistem</span>
    </div>

    <!-- Visual Icon -->
    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-amber-50 text-amber-700 mx-auto flex items-center justify-center mb-6 shadow-inner">
        <i data-lucide="wrench" class="w-12 h-12 sm:w-14 sm:h-14 stroke-[1.5]"></i>
    </div>

    <!-- Main Message -->
    <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 tracking-tight">
        Sedang Peningkatan Sistem
    </h1>
    <p class="text-slate-600 text-sm sm:text-base mt-3 max-w-lg mx-auto leading-relaxed">
        Website Puja Tour & Travel sedang menjalani pemeliharaan berkala untuk meningkatkan kecepatan dan kenyamanan reservasi Anda. Kami akan segera kembali online!
    </p>

    <!-- Emergency WhatsApp Notice Box -->
    <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm max-w-md mx-auto text-left flex items-start gap-3">
        <i data-lucide="message-circle" class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5"></i>
        <div>
            <span class="font-bold block">Butuh Booking Cepat?</span>
            <p class="text-emerald-800 text-xs mt-0.5">Layanan konsultasi jadwal dan reservasi paket wisata Pangandaran tetap melayani Anda secara offline dan melalui WhatsApp.</p>
        </div>
    </div>

    <!-- Quick Action Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
        <a href="https://wa.me/{{ $waNum ?? '6281234567890' }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20tanya%20paket%20wisata%20Pangandaran%20saat%20website%20maintenance" 
           target="_blank" 
           class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm transition flex items-center gap-2 shadow-sm">
            <i data-lucide="message-circle" class="w-4 h-4"></i>
            <span>Chat CS WhatsApp Langsung</span>
        </a>
        <button onclick="window.location.reload()" class="px-6 py-3 rounded-xl bg-white hover:bg-neutral-100 text-slate-800 font-bold text-xs sm:text-sm border border-neutral-200 transition flex items-center gap-2 cursor-pointer">
            <i data-lucide="refresh-cw" class="w-4 h-4 text-slate-600"></i>
            <span>Cek Status / Muat Ulang</span>
        </button>
    </div>

    <div class="mt-10 pt-8 border-t border-neutral-200 text-xs text-slate-500">
        <p>Estimasi pemeliharaan berkala: beberapa menit. Terima kasih atas pengertian Anda.</p>
    </div>
</div>
@endsection
