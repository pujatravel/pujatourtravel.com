@extends('admin.layouts.app')

@section('title', 'Dashboard Utama')
@section('page-title', 'Ringkasan & Analisis Website')

@section('content')
<div class="space-y-8">
    <!-- 1. KPI Metric Cards Grid (Soft Surface Cards - 2 Columns on Mobile) -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <!-- KPI 1: Paket Wisata Aktif -->
        <div class="bg-surface-soft rounded-2xl sm:rounded-3xl p-3.5 sm:p-6 shadow-soft border border-neutral-200 flex items-center justify-between min-w-0">
            <div class="min-w-0 flex-1 pr-1">
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block mb-0.5 sm:mb-1 truncate">Paket Wisata</span>
                <span class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 block leading-tight">{{ $publishedPackages }}</span>
                <span class="text-[10px] sm:text-[11px] text-emerald-700 font-bold mt-0.5 sm:mt-1 flex items-center gap-1 truncate">
                    <i data-lucide="check-circle" class="w-3 h-3 sm:w-3.5 sm:h-3.5 shrink-0"></i>
                    <span class="truncate">{{ $totalPackages }} Total</span>
                </span>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                <i data-lucide="palmtree" class="w-5 h-5 sm:w-7 sm:h-7"></i>
            </div>
        </div>

        <!-- KPI 2: Paket Unggulan -->
        <div class="bg-surface-soft rounded-2xl sm:rounded-3xl p-3.5 sm:p-6 shadow-soft border border-neutral-200 flex items-center justify-between min-w-0">
            <div class="min-w-0 flex-1 pr-1">
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block mb-0.5 sm:mb-1 truncate">Paket Unggulan</span>
                <span class="font-display font-extrabold text-2xl sm:text-3xl text-amber-600 block leading-tight">{{ $featuredPackages->count() }}</span>
                <span class="text-[10px] sm:text-[11px] text-slate-500 font-medium mt-0.5 sm:mt-1 flex items-center gap-1 truncate">
                    <i data-lucide="star" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-amber-500 shrink-0"></i>
                    <span class="truncate">Di Beranda</span>
                </span>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <i data-lucide="sparkles" class="w-5 h-5 sm:w-7 sm:h-7"></i>
            </div>
        </div>

        <!-- KPI 3: Galeri Foto -->
        <div class="bg-surface-soft rounded-2xl sm:rounded-3xl p-3.5 sm:p-6 shadow-soft border border-neutral-200 flex items-center justify-between min-w-0">
            <div class="min-w-0 flex-1 pr-1">
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block mb-0.5 sm:mb-1 truncate">Galeri Foto</span>
                <span class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 block leading-tight">{{ $galleryCount }}</span>
                <span class="text-[10px] sm:text-[11px] text-slate-500 font-medium mt-0.5 sm:mt-1 flex items-center gap-1 truncate">
                    <i data-lucide="image" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-slate-400 shrink-0"></i>
                    <span class="truncate">Dokumentasi</span>
                </span>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-neutral-100 text-slate-700 flex items-center justify-center shrink-0">
                <i data-lucide="image" class="w-5 h-5 sm:w-7 sm:h-7"></i>
            </div>
        </div>

        <!-- KPI 4: Ulasan Testimoni -->
        <div class="bg-surface-soft rounded-2xl sm:rounded-3xl p-3.5 sm:p-6 shadow-soft border border-neutral-200 flex items-center justify-between min-w-0">
            <div class="min-w-0 flex-1 pr-1">
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block mb-0.5 sm:mb-1 truncate">Testimoni</span>
                <span class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 block leading-tight">{{ $testimonialCount }}</span>
                <span class="text-[10px] sm:text-[11px] text-emerald-700 font-bold mt-0.5 sm:mt-1 flex items-center gap-1 truncate">
                    <i data-lucide="message-square-quote" class="w-3 h-3 sm:w-3.5 sm:h-3.5 shrink-0"></i>
                    <span class="truncate">Ulasan</span>
                </span>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                <i data-lucide="message-square-quote" class="w-5 h-5 sm:w-7 sm:h-7"></i>
            </div>
        </div>
    </div>

    <!-- 2. Realtime Active Website Visitors & Traffic Chart (Live Analytics) -->
    <div class="bg-surface-soft rounded-3xl p-6 sm:p-7 shadow-soft border border-neutral-200">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-neutral-200">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-600"></span>
                        </span>
                        <span>LIVE MONITORING</span>
                    </span>
                    <span id="live-refresh-badge" class="text-[11px] font-semibold text-slate-500 flex items-center gap-1">
                        <i id="live-spin-icon" data-lucide="refresh-cw" class="w-3.5 h-3.5 text-emerald-700 animate-spin"></i>
                        <span>Auto-refresh tiap 3 detik</span>
                    </span>
                </div>
                <h3 class="font-display font-black text-xl sm:text-2xl text-slate-900 tracking-tight">Pengunjung yang Sedang Melihat Web</h3>
                <p class="text-xs text-slate-500 mt-0.5">Pantauan grafik pengguna yang sedang aktif membuka website Puja Tour & Travel secara real-time</p>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <!-- Big Live Counter -->
                <div class="flex items-baseline gap-2 bg-canvas px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                    <span id="live-counter" class="font-display font-black text-3xl sm:text-4xl text-emerald-700 leading-none transition-transform duration-300">
                        {{ $realtimeStats['active_count'] ?? 0 }}
                    </span>
                    <div class="text-left">
                        <span class="text-[11px] font-extrabold text-slate-800 uppercase tracking-wider block leading-tight">Pengguna</span>
                        <span class="text-[10px] text-slate-400 font-medium block">Sedang Online</span>
                    </div>
                </div>

                <!-- Action Controls -->
                <div class="flex items-center gap-1.5">
                    <button type="button" id="btn-toggle-polling" class="p-2.5 rounded-xl bg-canvas hover:bg-neutral-200 border border-neutral-200 text-slate-700 transition" title="Jeda / Lanjutkan Auto Refresh">
                        <i id="icon-toggle-polling" data-lucide="pause" class="w-4 h-4"></i>
                    </button>
                    <button type="button" id="btn-manual-refresh" class="p-2.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 transition" title="Refresh Sekarang">
                        <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Grid: Chart (Left) & Live Insights (Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pt-6">
            <!-- Left: Realtime Line/Area Chart -->
            <div class="lg:col-span-8 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3 text-xs">
                    <span class="font-bold text-slate-700 flex items-center gap-1.5">
                        <i data-lucide="activity" class="w-4 h-4 text-emerald-700"></i>
                        <span>Tren Pengguna Aktif (Time-Series)</span>
                    </span>
                    <span class="text-[11px] text-slate-400">
                        Terakhir diperbarui: <strong id="live-last-time" class="text-slate-600 font-mono">{{ $realtimeStats['server_time'] ?? now('Asia/Jakarta')->format('H:i:s') }}</strong>
                    </span>
                </div>

                <!-- Canvas Wrapper -->
                <div class="relative w-full h-64 sm:h-72 bg-canvas/60 rounded-2xl p-3 sm:p-4 border border-neutral-200">
                    <canvas id="realtimeVisitorsChart"></canvas>
                </div>

                <!-- Quick Legend / Metric Bar -->
                <div class="grid grid-cols-3 gap-3 mt-4 pt-3 border-t border-neutral-200/80 text-center">
                    <div class="p-2 rounded-xl bg-canvas border border-neutral-200/60">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Desktop</span>
                        <span id="live-device-desktop" class="font-display font-extrabold text-sm sm:text-base text-slate-900">
                            {{ $realtimeStats['devices']['desktop'] ?? 0 }}
                        </span>
                    </div>
                    <div class="p-2 rounded-xl bg-canvas border border-neutral-200/60">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Mobile HP</span>
                        <span id="live-device-mobile" class="font-display font-extrabold text-sm sm:text-base text-slate-900">
                            {{ $realtimeStats['devices']['mobile'] ?? 0 }}
                        </span>
                    </div>
                    <div class="p-2 rounded-xl bg-canvas border border-neutral-200/60">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Tablet</span>
                        <span id="live-device-tablet" class="font-display font-extrabold text-sm sm:text-base text-slate-900">
                            {{ $realtimeStats['devices']['tablet'] ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right: Active Pages Breakdown -->
            <div class="lg:col-span-4 flex flex-col">
                <div class="flex items-center justify-between mb-3 text-xs">
                    <span class="font-bold text-slate-700 flex items-center gap-1.5">
                        <i data-lucide="compass" class="w-4 h-4 text-emerald-700"></i>
                        <span>Halaman yang Sedang Dilihat</span>
                    </span>
                    <span id="live-active-pages-count" class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                        {{ count($realtimeStats['pages'] ?? []) }} Halaman
                    </span>
                </div>

                <div class="bg-canvas rounded-2xl p-4 border border-neutral-200 flex-1 flex flex-col justify-between">
                    <div id="live-active-pages-list" class="space-y-2.5">
                        @forelse($realtimeStats['pages'] ?? [] as $p)
                            <div class="p-3 rounded-xl bg-white border border-neutral-200 hover:border-emerald-500/40 transition flex items-center justify-between gap-3 shadow-2xs">
                                <div class="min-w-0 flex-1">
                                    <span class="text-xs font-bold text-slate-900 truncate block">{{ $p['title'] }}</span>
                                    <span class="text-[10px] text-slate-400 font-mono truncate block">{{ $p['url'] }}</span>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-emerald-100 text-emerald-800 shrink-0 border border-emerald-200">
                                    {{ $p['count'] }} Online
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-10 px-4 text-slate-400">
                                <i data-lucide="radar" class="w-8 h-8 mx-auto mb-2 text-slate-300 animate-pulse"></i>
                                <p class="text-xs font-semibold text-slate-500">Menunggu kunjungan pengguna...</p>
                                <p class="text-[11px] text-slate-400 mt-1">Buka halaman publik di tab baru untuk melihat data langsung bertambah secara real-time.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4 pt-3 border-t border-neutral-200/80 flex items-center justify-between text-[11px] text-slate-400">
                        <span class="flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-700"></i>
                            <span>Zero PII (Privasi Aman)</span>
                        </span>
                        <a href="{{ route('home') }}" target="_blank" class="font-bold text-emerald-700 hover:underline flex items-center gap-0.5">
                            <span>Buka Web</span>
                            <i data-lucide="external-link" class="w-3 h-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Featured Packages & Quick Actions Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Featured Packages List -->
        <div class="lg:col-span-8 bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200">
            <div class="flex items-center justify-between pb-5 border-b border-neutral-200 mb-5">
                <div>
                    <h3 class="font-display font-bold text-lg text-slate-900">Paket Wisata Unggulan</h3>
                    <p class="text-xs text-slate-400">Paket pilihan yang ditampilkan di halaman beranda</p>
                </div>
                <a href="{{ route('admin.packages.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition flex items-center gap-1">
                    <span>Lihat Semua ({{ $totalPackages }})</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                @forelse($featuredPackages as $pkg)
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-canvas border border-neutral-200/90 hover:border-emerald-700/40 hover:shadow-xs transition group">
                        <!-- Package Thumbnail -->
                        <div class="relative shrink-0">
                            <img src="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $pkg->name }}" class="w-16 h-16 sm:w-18 sm:h-18 rounded-2xl object-cover border border-neutral-200/80 shadow-2xs group-hover:scale-105 transition duration-300">
                        </div>

                        <!-- Text Details with ample spacing -->
                        <div class="flex-1 min-w-0 pl-1 space-y-1">
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900 truncate group-hover:text-emerald-700 transition leading-snug">
                                {{ $pkg->name }}
                            </h4>
                            <div class="flex items-center gap-1.5">
                                <span class="text-xs sm:text-sm text-emerald-700 font-extrabold">{{ $pkg->formatted_price }}</span>
                                <span class="text-[10px] text-slate-400 font-medium">/ {{ $pkg->price_unit }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-[10px] text-slate-400 truncate">
                                @if($pkg->duration)
                                    <span class="inline-flex items-center gap-0.5">
                                        <i data-lucide="clock" class="w-2.5 h-2.5"></i>
                                        <span>{{ $pkg->duration }}</span>
                                    </span>
                                    <span>&bull;</span>
                                @endif
                                <span class="inline-flex items-center gap-0.5 truncate">
                                    <i data-lucide="map-pin" class="w-2.5 h-2.5"></i>
                                    <span>{{ $pkg->location ?? 'Pangandaran' }}</span>
                                </span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-1.5 shrink-0 pl-2 border-l border-neutral-200/60">
                            <a href="{{ route('packages.show', $pkg->slug) }}" target="_blank" class="p-1.5 rounded-lg text-slate-400 hover:text-emerald-700 hover:bg-emerald-50 transition" title="Lihat Halaman Publik">
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                            </a>
                            <a href="{{ route('admin.packages.edit', $pkg->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-900 hover:bg-neutral-200 transition" title="Edit Paket">
                                <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="sm:col-span-2 text-center py-10 text-slate-400">
                        <i data-lucide="palmtree" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
                        <p class="text-xs font-semibold">Belum ada paket yang ditandai sebagai unggulan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions & CMS Shortcuts -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200">
                <h3 class="font-display font-bold text-lg text-slate-900 mb-4">Aksi Cepat & Navigasi</h3>
                <div class="space-y-2.5">
                    <a href="{{ route('admin.invoices.create') }}" class="w-full py-3 px-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition flex items-center justify-between shadow-sm">
                        <span>+ Generate Invoice Baru</span>
                        <i data-lucide="receipt" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ route('admin.packages.create') }}" class="w-full py-3 px-4 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>+ Tambah Paket Wisata</span>
                        <i data-lucide="palmtree" class="w-4 h-4 text-slate-600"></i>
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="w-full py-3 px-4 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>+ Unggah Foto Galeri</span>
                        <i data-lucide="image" class="w-4 h-4 text-slate-600"></i>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="w-full py-3 px-4 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>+ Kelola Testimoni</span>
                        <i data-lucide="message-square-quote" class="w-4 h-4 text-slate-600"></i>
                    </a>
                    <a href="{{ route('admin.faqs.index') }}" class="w-full py-3 px-4 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>Kelola Tanya Jawab (FAQ)</span>
                        <i data-lucide="help-circle" class="w-4 h-4 text-slate-600"></i>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="w-full py-3 px-4 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>Pengaturan Kontak & Media Sosial</span>
                        <i data-lucide="settings" class="w-4 h-4 text-slate-600"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Recent Invoices / Transaksi Section -->
    <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-5 border-b border-neutral-200 mb-5">
            <div>
                <h3 class="font-display font-bold text-lg text-slate-900 flex items-center gap-2">
                    <i data-lucide="receipt" class="w-5 h-5 text-emerald-700"></i>
                    <span>Transaksi & Invoice Terbaru</span>
                </h3>
                <p class="text-xs text-slate-400">Daftar tagihan dan status pembayaran paket wisata</p>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.invoices.create') }}" class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition flex items-center gap-1.5 shadow-xs">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                    <span>Buat Invoice</span>
                </a>
                <a href="{{ route('admin.invoices.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900 px-3 py-2 rounded-xl border border-neutral-200 bg-white transition flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-canvas text-slate-500 font-bold uppercase tracking-wider border-b border-neutral-200">
                        <th class="p-3">No. Invoice</th>
                        <th class="p-3">Nama Pelanggan</th>
                        <th class="p-3">Layanan / Paket</th>
                        <th class="p-3">Total Tagihan</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 text-slate-700">
                    @forelse($recentInvoices as $inv)
                        <tr class="hover:bg-canvas transition">
                            <td class="p-3 font-mono font-bold text-slate-900">
                                <a href="{{ route('admin.invoices.show', $inv->id) }}" class="hover:text-emerald-700">
                                    {{ $inv->invoice_number }}
                                </a>
                            </td>
                            <td class="p-3">
                                <span class="font-bold text-slate-900 block">{{ $inv->customer_name }}</span>
                                <span class="text-[11px] text-slate-400">{{ $inv->customer_phone }}</span>
                            </td>
                            <td class="p-3 text-slate-600">
                                {{ $inv->package_name ?? ($inv->items->first()->item_name ?? 'Layanan Wisata') }} ({{ $inv->pax_count }} Pax)
                            </td>
                            <td class="p-3 font-bold text-slate-900">
                                {{ $inv->formatted_total }}
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $inv->status_badge_class }}">
                                    {{ $inv->status_label }}
                                </span>
                            </td>
                            <td class="p-3 text-right whitespace-nowrap">
                                <a href="{{ route('admin.invoices.show', $inv->id) }}" class="inline-flex items-center gap-1 text-emerald-700 font-bold hover:underline">
                                    <span>Detail</span>
                                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400">
                                Belum ada invoice yang dibuat. Klik tombol "Buat Invoice" untuk membuat tagihan baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var initialData = @json($realtimeStats ?? []);
    var pollUrl = "{{ route('admin.realtime-visitors') }}";
    var isPolling = true;
    var pollTimer = null;
    var chartInstance = null;

    function initChart(labels, data) {
        var ctx = document.getElementById('realtimeVisitorsChart');
        if (!ctx) return;

        if (typeof Chart === 'undefined') {
            setTimeout(function() { initChart(labels, data); }, 250);
            return;
        }

        var canvas = ctx.getContext('2d');
        var gradient = canvas.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.32)');
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0.00)');

        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengguna Online',
                    data: data,
                    borderColor: '#059669',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#059669',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 600,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleFont: { family: 'Outfit, sans-serif', size: 12 },
                        bodyFont: { family: 'Plus Jakarta Sans, sans-serif', size: 12 },
                        padding: 10,
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.y + ' Pengguna Sedang Melihat Web';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 5,
                        grid: {
                            color: 'rgba(226, 232, 240, 0.8)',
                            drawBorder: false
                        },
                        ticks: {
                            precision: 0,
                            font: { family: 'Plus Jakarta Sans', size: 11 },
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 10 },
                            color: '#94a3b8',
                            maxRotation: 0
                        }
                    }
                }
            }
        });
    }

    function renderActivePages(pages) {
        var container = document.getElementById('live-active-pages-list');
        var countBadge = document.getElementById('live-active-pages-count');
        if (!container) return;

        if (countBadge) {
            countBadge.textContent = (pages ? pages.length : 0) + ' Halaman';
        }

        if (!pages || pages.length === 0) {
            container.innerHTML = `
                <div class="text-center py-10 px-4 text-slate-400">
                    <i data-lucide="radar" class="w-8 h-8 mx-auto mb-2 text-slate-300 animate-pulse"></i>
                    <p class="text-xs font-semibold text-slate-500">Menunggu kunjungan pengguna...</p>
                    <p class="text-[11px] text-slate-400 mt-1">Buka halaman publik di tab baru untuk melihat data langsung bertambah secara real-time.</p>
                </div>
            `;
            if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
            return;
        }

        var html = '';
        pages.forEach(function(p) {
            html += `
                <div class="p-3 rounded-xl bg-white border border-neutral-200 hover:border-emerald-500/40 transition flex items-center justify-between gap-3 shadow-2xs">
                    <div class="min-w-0 flex-1">
                        <span class="text-xs font-bold text-slate-900 truncate block">${escapeHtml(p.title)}</span>
                        <span class="text-[10px] text-slate-400 font-mono truncate block">${escapeHtml(p.url)}</span>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-emerald-100 text-emerald-800 shrink-0 border border-emerald-200">
                        ${p.count} Online
                    </span>
                </div>
            `;
        });
        container.innerHTML = html;
        if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
    }

    function escapeHtml(str) {
        return (str || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function updateStatsUI(res) {
        if (!res) return;

        // 1. Update Counter
        var counterEl = document.getElementById('live-counter');
        if (counterEl) {
            var currentVal = parseInt(counterEl.textContent.trim()) || 0;
            if (currentVal !== res.active_count) {
                counterEl.classList.add('scale-125', 'text-emerald-500');
                setTimeout(function() {
                    counterEl.textContent = res.active_count;
                    counterEl.classList.remove('scale-125', 'text-emerald-500');
                }, 180);
            } else {
                counterEl.textContent = res.active_count;
            }
        }

        // 2. Update Timestamp
        var lastTimeEl = document.getElementById('live-last-time');
        if (lastTimeEl && res.server_time) {
            lastTimeEl.textContent = res.server_time;
        }

        // 3. Update Devices
        if (res.devices) {
            var elDesk = document.getElementById('live-device-desktop');
            var elMob = document.getElementById('live-device-mobile');
            var elTab = document.getElementById('live-device-tablet');
            if (elDesk) elDesk.textContent = res.devices.desktop || 0;
            if (elMob) elMob.textContent = res.devices.mobile || 0;
            if (elTab) elTab.textContent = res.devices.tablet || 0;
        }

        // 4. Update Pages
        renderActivePages(res.pages);

        // 5. Update Chart
        if (chartInstance && res.history) {
            chartInstance.data.labels = res.history.labels;
            chartInstance.data.datasets[0].data = res.history.data;
            chartInstance.update('none');
        }
    }

    function fetchRealtimeData() {
        if (!isPolling) return;

        fetch(pollUrl, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function(resp) {
            if (!resp.ok) throw new Error('HTTP error ' + resp.status);
            return resp.json();
        })
        .then(function(data) {
            updateStatsUI(data);
        })
        .catch(function(err) {
            console.warn('Realtime visitors polling notice:', err);
        });
    }

    // Inisialisasi awal chart
    if (initialData && initialData.history) {
        initChart(initialData.history.labels || [], initialData.history.data || []);
    } else {
        initChart([], []);
    }

    // Mulai polling otomatis tiap 3 detik
    pollTimer = setInterval(fetchRealtimeData, 3000);

    // Tombol Toggle Polling
    var toggleBtn = document.getElementById('btn-toggle-polling');
    var toggleIcon = document.getElementById('icon-toggle-polling');
    var spinIcon = document.getElementById('live-spin-icon');
    var refreshBadge = document.getElementById('live-refresh-badge');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            isPolling = !isPolling;
            if (isPolling) {
                if (toggleIcon) toggleIcon.setAttribute('data-lucide', 'pause');
                if (spinIcon) spinIcon.classList.add('animate-spin');
                if (refreshBadge) refreshBadge.querySelector('span').textContent = 'Auto-refresh tiap 3 detik';
                fetchRealtimeData();
            } else {
                if (toggleIcon) toggleIcon.setAttribute('data-lucide', 'play');
                if (spinIcon) spinIcon.classList.remove('animate-spin');
                if (refreshBadge) refreshBadge.querySelector('span').textContent = 'Pemantauan dijeda';
            }
            if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
        });
    }

    // Tombol Manual Refresh
    var manualBtn = document.getElementById('btn-manual-refresh');
    if (manualBtn) {
        manualBtn.addEventListener('click', function() {
            fetchRealtimeData();
        });
    }

    // Hemat bandwidth jika tab admin sedang diminimalkan/di background
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'visible' && isPolling) {
            fetchRealtimeData();
        }
    });
});
</script>
@endpush
