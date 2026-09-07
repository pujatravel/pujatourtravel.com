@extends('admin.layouts.app')

@section('title', 'Dashboard Operasional')
@section('page-title', 'Ringkasan & Operasional Trip')

@section('content')
<div class="space-y-8">
    <!-- Top Actionable Alert if Pending Reservations exist -->
    @if($pendingReservations > 0)
        <div class="p-5 rounded-2xl bg-amber-500 text-slate-950 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="p-2 rounded-xl bg-amber-600/30">
                    <i data-lucide="bell" class="w-6 h-6 text-slate-950"></i>
                </span>
                <div>
                    <h2 class="font-display font-bold text-base">Ada {{ $pendingReservations }} Permintaan Reservasi Baru!</h2>
                    <p class="text-xs text-slate-900 mt-0.5">Segera tindak lanjuti permintaan calon wisatawan untuk konfirmasi jadwal dan pembayaran.</p>
                </div>
            </div>
            <a href="{{ route('admin.reservations.index', ['status' => 'PENDING']) }}" class="px-4 py-2 rounded-xl bg-slate-900 text-white font-bold text-xs shadow hover:bg-slate-800 transition whitespace-nowrap flex items-center gap-1.5">
                <span>Periksa Reservasi</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    @endif

    <!-- 1. KPI Metric Cards Grid (Soft Surface Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- KPI 1: Total Reservasi -->
        <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Reservasi</span>
                <span class="font-display font-extrabold text-3xl text-slate-900">{{ $totalReservations }}</span>
                <span class="text-[11px] text-emerald-700 font-bold mt-1 flex items-center gap-1">
                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                    <span>{{ $completedReservations }} Trip Selesai</span>
                </span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                <i data-lucide="clipboard-list" class="w-7 h-7"></i>
            </div>
        </div>

        <!-- KPI 2: Reservasi Menunggu -->
        <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Menunggu Konfirmasi</span>
                <span class="font-display font-extrabold text-3xl text-amber-600">{{ $pendingReservations }}</span>
                <span class="text-[11px] text-slate-500 font-medium mt-1 flex items-center gap-1">
                    <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-600"></i>
                    <span>{{ $confirmedReservations }} Terjadwal</span>
                </span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <i data-lucide="clock" class="w-7 h-7"></i>
            </div>
        </div>

        <!-- KPI 3: Total Wisatawan Terlayani -->
        <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Wisatawan Terlayani</span>
                <span class="font-display font-extrabold text-3xl text-slate-900">{{ number_format($totalPax) }}</span>
                <span class="text-[11px] text-slate-400 block mt-1">Orang / Pax</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-neutral-100 text-slate-700 flex items-center justify-center">
                <i data-lucide="users" class="w-7 h-7"></i>
            </div>
        </div>

        <!-- KPI 4: Paket Wisata Aktif -->
        <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Paket Wisata Aktif</span>
                <span class="font-display font-extrabold text-3xl text-slate-900">{{ $publishedPackages }}</span>
                <span class="text-[11px] text-slate-400 block mt-1">Dari total {{ $totalPackages }} paket</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                <i data-lucide="palmtree" class="w-7 h-7"></i>
            </div>
        </div>
    </div>

    <!-- 2. Recent Reservations Table & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Recent Reservations -->
        <div class="lg:col-span-8 bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200">
            <div class="flex items-center justify-between pb-5 border-b border-neutral-200 mb-5">
                <div>
                    <h3 class="font-display font-bold text-lg text-slate-900">Reservasi Terbaru</h3>
                    <p class="text-xs text-slate-400">Daftar pemesanan terakhir yang masuk ke sistem</p>
                </div>
                <a href="{{ route('admin.reservations.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 font-bold uppercase tracking-wider border-b border-neutral-200">
                            <th class="pb-3">Kode & Pemesan</th>
                            <th class="pb-3">Paket</th>
                            <th class="pb-3">Tgl Trip</th>
                            <th class="pb-3">Pax</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 text-slate-700 font-medium">
                        @forelse($recentReservations as $res)
                            <tr class="hover:bg-canvas transition">
                                <td class="py-3.5">
                                    <span class="font-bold text-slate-900 block">{{ $res->customer_name }}</span>
                                    <span class="text-[11px] text-slate-400 font-mono">{{ $res->code }}</span>
                                </td>
                                <td class="py-3.5">
                                    <span class="block font-semibold text-slate-800 line-clamp-1 max-w-45">{{ $res->package_name }}</span>
                                </td>
                                <td class="py-3.5 whitespace-nowrap">
                                    {{ $res->travel_date ? $res->travel_date->format('d M Y') : '-' }}
                                </td>
                                <td class="py-3.5 font-bold text-slate-900">
                                    {{ $res->pax_count }} Org
                                </td>
                                <td class="py-3.5">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $res->status_badge }}">
                                        {{ $res->status }}
                                    </span>
                                </td>
                                <td class="py-3.5 text-right whitespace-nowrap">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $res->customer_phone) }}" target="_blank" class="p-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition inline-block mr-1" title="Chat WhatsApp">
                                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    </a>
                                    <a href="{{ route('admin.reservations.show', $res->id) }}" class="px-3 py-1.5 rounded-lg bg-neutral-100 text-slate-700 hover:bg-neutral-200 transition inline-block font-bold">
                                        Rincian
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-slate-400">Belum ada data reservasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Packages Overview -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Quick Actions -->
            <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200">
                <h3 class="font-display font-bold text-lg text-slate-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-2.5">
                    <a href="{{ route('admin.packages.create') }}" class="w-full py-3 px-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition flex items-center justify-between shadow-sm">
                        <span>+ Tambah Paket Wisata Baru</span>
                        <i data-lucide="palmtree" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="w-full py-3 px-4 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>+ Unggah Foto Galeri</span>
                        <i data-lucide="image" class="w-4 h-4 text-slate-600"></i>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="w-full py-3 px-4 rounded-xl bg-neutral-100 hover:bg-neutral-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>Edit Kontak & Pengaturan</span>
                        <i data-lucide="settings" class="w-4 h-4 text-slate-600"></i>
                    </a>
                </div>
            </div>

            <!-- Featured Packages List -->
            <div class="bg-surface-soft rounded-3xl p-6 shadow-soft border border-neutral-200">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-display font-bold text-base text-slate-900">Paket Unggulan</h3>
                        <p class="text-[11px] text-slate-400">Tampil di beranda utama</p>
                    </div>
                    <a href="{{ route('admin.packages.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition flex items-center gap-1">
                        <span>Semua ({{ $totalPackages }})</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
                <div class="space-y-3">
                    @forelse($featuredPackages as $pkg)
                        <div class="flex items-center gap-3 p-2.5 rounded-2xl bg-canvas border border-neutral-200 hover:border-emerald-700/40 transition group">
                            <img src="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $pkg->name }}" class="w-12 h-12 rounded-xl object-cover shrink-0">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold text-slate-900 truncate group-hover:text-emerald-700 transition">{{ $pkg->name }}</h4>
                                <span class="text-[11px] text-emerald-700 font-bold block">{{ $pkg->formatted_price }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <a href="{{ route('packages.show', $pkg->slug) }}" target="_blank" class="p-1.5 rounded-lg text-slate-400 hover:text-emerald-700 hover:bg-emerald-50 transition" title="Lihat Halaman Publik">
                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                </a>
                                <a href="{{ route('admin.packages.edit', $pkg->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-900 hover:bg-neutral-200 transition" title="Edit Paket">
                                    <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 text-center py-4">Belum ada paket unggulan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
