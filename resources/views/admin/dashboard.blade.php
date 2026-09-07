@extends('admin.layouts.app')

@section('title', 'Dashboard Operasional')
@section('page-title', 'Ringkasan & Operasional Trip')

@section('content')
<div class="space-y-8">
    <!-- Top Actionable Alert if Pending Reservations exist -->
    @if($pendingReservations > 0)
        <div class="p-5 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="text-2xl p-2 rounded-xl bg-white/20">🔔</span>
                <div>
                    <h2 class="font-display font-bold text-base">Ada {{ $pendingReservations }} Permintaan Reservasi Baru!</h2>
                    <p class="text-xs text-amber-100 mt-0.5">Segera tindak lanjuti permintaan calon wisatawan untuk konfirmasi jadwal dan pembayaran.</p>
                </div>
            </div>
            <a href="{{ route('admin.reservations.index', ['status' => 'PENDING']) }}" class="px-4 py-2 rounded-xl bg-white text-slate-900 font-bold text-xs shadow hover:bg-amber-50 transition whitespace-nowrap">
                Periksa Reservasi &rarr;
            </a>
        </div>
    @endif

    <!-- 1. KPI Metric Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- KPI 1: Total Reservasi -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Total Reservasi</span>
                <span class="font-display font-extrabold text-3xl text-slate-900">{{ $totalReservations }}</span>
                <span class="text-[11px] text-emerald-600 font-bold block mt-1">✓ {{ $completedReservations }} Trip Selesai</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-ocean-50 text-ocean-600 flex items-center justify-center text-2xl font-bold">
                📋
            </div>
        </div>

        <!-- KPI 2: Reservasi Menunggu -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Menunggu Konfirmasi</span>
                <span class="font-display font-extrabold text-3xl text-amber-600">{{ $pendingReservations }}</span>
                <span class="text-[11px] text-cyan-600 font-bold block mt-1">⏳ {{ $confirmedReservations }} Terjadwal</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-bold">
                ⏳
            </div>
        </div>

        <!-- KPI 3: Total Wisatawan Terlayani -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Wisatawan Terlayani</span>
                <span class="font-display font-extrabold text-3xl text-slate-900">{{ number_format($totalPax) }}</span>
                <span class="text-[11px] text-slate-400 block mt-1">Orang / Pax</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-lagoon-50 text-lagoon-600 flex items-center justify-center text-2xl font-bold">
                👥
            </div>
        </div>

        <!-- KPI 4: Paket Wisata Aktif -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Paket Wisata Aktif</span>
                <span class="font-display font-extrabold text-3xl text-slate-900">{{ $publishedPackages }}</span>
                <span class="text-[11px] text-slate-400 block mt-1">Dari total {{ $totalPackages }} paket</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-teak-50 text-teak-600 flex items-center justify-center text-2xl font-bold">
                🌴
            </div>
        </div>
    </div>

    <!-- 2. Recent Reservations Table & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Recent Reservations -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
            <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-5">
                <div>
                    <h3 class="font-display font-bold text-lg text-slate-900">Reservasi Terbaru</h3>
                    <p class="text-xs text-slate-400">Daftar pemesanan terakhir yang masuk ke sistem</p>
                </div>
                <a href="{{ route('admin.reservations.index') }}" class="text-xs font-bold text-ocean-600 hover:text-ocean-700 transition">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="pb-3">Kode & Pemesan</th>
                            <th class="pb-3">Paket</th>
                            <th class="pb-3">Tgl Trip</th>
                            <th class="pb-3">Pax</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @forelse($recentReservations as $res)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5">
                                    <span class="font-bold text-slate-900 block">{{ $res->customer_name }}</span>
                                    <span class="text-[11px] text-slate-400 font-mono">{{ $res->code }}</span>
                                </td>
                                <td class="py-3.5">
                                    <span class="block font-semibold text-slate-800 line-clamp-1 max-w-[180px]">{{ $res->package_name }}</span>
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
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $res->customer_phone) }}" target="_blank" class="p-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition inline-block mr-1" title="Chat WhatsApp">
                                        💬
                                    </a>
                                    <a href="{{ route('admin.reservations.show', $res->id) }}" class="p-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-ocean-100 hover:text-ocean-700 transition inline-block font-bold">
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
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
                <h3 class="font-display font-bold text-lg text-slate-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-2.5">
                    <a href="{{ route('admin.packages.create') }}" class="w-full py-3 px-4 rounded-xl bg-ocean-600 hover:bg-ocean-700 text-white font-bold text-xs transition flex items-center justify-between shadow-sm">
                        <span>+ Tambah Paket Wisata Baru</span>
                        <span>🌴</span>
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="w-full py-3 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>+ Unggah Foto Galeri</span>
                        <span>📸</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="w-full py-3 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs transition flex items-center justify-between">
                        <span>Edit Kontak & Pengaturan</span>
                        <span>⚙️</span>
                    </a>
                </div>
            </div>

            <!-- Featured Packages List -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display font-bold text-base text-slate-900">Paket Unggulan</h3>
                    <span class="text-xs text-teak-600 font-bold">⭐ Beranda</span>
                </div>
                <div class="space-y-3">
                    @forelse($featuredPackages as $pkg)
                        <div class="flex items-center gap-3 p-2.5 rounded-2xl bg-slate-50 border border-slate-100">
                            <img src="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $pkg->name }}" class="w-12 h-12 rounded-xl object-cover">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold text-slate-900 truncate">{{ $pkg->name }}</h4>
                                <span class="text-[11px] text-ocean-600 font-bold">{{ $pkg->formatted_price }}</span>
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
