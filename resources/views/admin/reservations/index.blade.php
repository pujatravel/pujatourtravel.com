@extends('admin.layouts.app')

@section('title', 'Daftar Reservasi')
@section('page-title', 'Manajemen Reservasi & Permintaan Trip')

@section('content')
<div class="space-y-6">
    <!-- Filter Status Tabs -->
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.reservations.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('status') ? 'bg-slate-900 text-white shadow-sm' : 'bg-surface-soft text-slate-600 hover:bg-neutral-100 border border-neutral-200' }}">
            Semua ({{ \App\Models\Reservation::count() }})
        </a>
        <a href="{{ route('admin.reservations.index', ['status' => 'PENDING']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('status') === 'PENDING' ? 'bg-amber-500 text-slate-950 shadow-sm font-extrabold' : 'bg-surface-soft text-amber-800 hover:bg-amber-50 border border-amber-200' }}">
            Menunggu ({{ $pendingCount }})
        </a>
        <a href="{{ route('admin.reservations.index', ['status' => 'DIPROSES']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('status') === 'DIPROSES' ? 'bg-slate-700 text-white shadow-sm' : 'bg-surface-soft text-slate-700 hover:bg-canvas border border-neutral-200' }}">
            Diproses ({{ $processCount }})
        </a>
        <a href="{{ route('admin.reservations.index', ['status' => 'DIKONFIRMASI']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('status') === 'DIKONFIRMASI' ? 'bg-emerald-700 text-white shadow-sm' : 'bg-surface-soft text-emerald-800 hover:bg-emerald-50 border border-emerald-200' }}">
            Dikonfirmasi ({{ $confirmedCount }})
        </a>
        <a href="{{ route('admin.reservations.index', ['status' => 'SELESAI']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('status') === 'SELESAI' ? 'bg-slate-900 text-white shadow-sm' : 'bg-surface-soft text-slate-700 hover:bg-canvas border border-neutral-200' }}">
            Selesai ({{ $completedCount }})
        </a>
        <a href="{{ route('admin.reservations.index', ['status' => 'DIBATALKAN']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('status') === 'DIBATALKAN' ? 'bg-rose-600 text-white shadow-sm' : 'bg-surface-soft text-rose-800 hover:bg-rose-50 border border-rose-200' }}">
            Dibatalkan ({{ $cancelledCount }})
        </a>
    </div>

    <!-- Search & Source Filter Form -->
    <div class="bg-surface-soft p-4 rounded-3xl border border-neutral-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
        <form action="{{ route('admin.reservations.index') }}" method="GET" class="flex flex-wrap items-center gap-3 w-full">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="flex-1 min-w-48">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, no WA, kode reservasi..." class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
            </div>

            @if(isset($availableSources) && $availableSources->isNotEmpty())
                <div class="min-w-36">
                    <select name="source" onchange="this.form.submit()" class="w-full px-3 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas font-bold text-slate-700 outline-none">
                        <option value="">Semua Saluran Sumber</option>
                        @foreach($availableSources as $src)
                            <option value="{{ $src }}" {{ request('source') === $src ? 'selected' : '' }}>{{ $src }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <button type="submit" class="px-4 py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition">
                Filter
            </button>
            @if(request('search') || request('source') || request('status'))
                <a href="{{ route('admin.reservations.index') }}" class="px-3 py-2.5 bg-neutral-100 hover:bg-neutral-200 text-slate-700 rounded-xl text-xs font-bold transition">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Reservations Table -->
    <div class="bg-surface-soft rounded-3xl shadow-sm border border-neutral-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-canvas text-slate-500 font-bold uppercase tracking-wider border-b border-neutral-200">
                        <th class="p-4">Kode & Pemesan</th>
                        <th class="p-4">Kontak WhatsApp</th>
                        <th class="p-4">Paket Wisata</th>
                        <th class="p-4">Tgl Perjalanan</th>
                        <th class="p-4">Peserta</th>
                        <th class="p-4">Total Biaya</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 text-slate-700 font-medium">
                    @forelse($reservations as $res)
                        <tr class="hover:bg-canvas transition">
                            <td class="p-4">
                                <span class="font-bold text-slate-900 text-sm block">{{ $res->customer_name }}</span>
                                <span class="text-[11px] font-mono text-emerald-700 font-bold block">{{ $res->code }}</span>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $res->customer_phone) }}?text=Halo%20{{ urlencode($res->customer_name) }},%20kami%20dari%20Puja%20Tour%20%26%20Travel%20terkait%20reservasi%20{{ $res->code }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-800 hover:bg-emerald-100 font-bold transition">
                                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                    <span>{{ $res->customer_phone }}</span>
                                </a>
                            </td>
                            <td class="p-4">
                                <span class="font-semibold text-slate-800 block max-w-50">{{ $res->package_name }}</span>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 text-slate-600">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span>{{ $res->travel_date ? $res->travel_date->format('d M Y') : 'Fleksibel' }}</span>
                                </span>
                            </td>
                            <td class="p-4 font-bold text-slate-900">
                                {{ $res->pax_count }} Orang
                            </td>
                            <td class="p-4 font-bold text-emerald-700">
                                {{ $res->formatted_total }}
                            </td>
                            <td class="p-4">
                                <form action="{{ route('admin.reservations.update-status', $res->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="px-2.5 py-1 rounded-full text-[11px] font-bold border outline-none cursor-pointer {{ $res->status_badge }}">
                                        <option value="PENDING" {{ $res->status === 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                        <option value="DIPROSES" {{ $res->status === 'DIPROSES' ? 'selected' : '' }}>DIPROSES</option>
                                        <option value="DIKONFIRMASI" {{ $res->status === 'DIKONFIRMASI' ? 'selected' : '' }}>DIKONFIRMASI</option>
                                        <option value="SELESAI" {{ $res->status === 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                                        <option value="DIBATALKAN" {{ $res->status === 'DIBATALKAN' ? 'selected' : '' }}>DIBATALKAN</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-4 text-right whitespace-nowrap">
                                <a href="{{ route('admin.reservations.show', $res->id) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 font-bold transition inline-block mr-1">
                                    Rincian
                                </a>
                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST" class="inline-block" onsubmit="confirmDelete(event, 'Apakah Anda yakin ingin menghapus data reservasi {{ $res->code }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 transition" title="Hapus reservasi">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-10 text-slate-400">Tidak ada data reservasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reservations->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
