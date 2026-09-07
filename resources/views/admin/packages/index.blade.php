@extends('admin.layouts.app')

@section('title', 'Katalog Paket Wisata')
@section('page-title', 'Manajemen Paket Wisata')

@section('content')
<div class="space-y-6">
    <!-- Header Actions & Search -->
    <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 bg-white p-5 rounded-3xl border border-slate-200/80 shadow-sm">
        <!-- Search & Filter Form -->
        <form action="{{ route('admin.packages.index') }}" method="GET" class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama paket atau lokasi..." class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-ocean-500 outline-none">
            </div>

            <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">
                <option value="">Semua Status</option>
                <option value="PUBLISHED" {{ request('status') === 'PUBLISHED' ? 'selected' : '' }}>Published</option>
                <option value="DRAFT" {{ request('status') === 'DRAFT' ? 'selected' : '' }}>Draft</option>
                <option value="ARCHIVED" {{ request('status') === 'ARCHIVED' ? 'selected' : '' }}>Archived</option>
            </select>

            <button type="submit" class="px-4 py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-ocean-600 transition">
                Filter
            </button>
        </form>

        <a href="{{ route('admin.packages.create') }}" class="px-5 py-2.5 rounded-xl bg-ocean-600 hover:bg-ocean-700 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-2 whitespace-nowrap">
            <span>+ Tambah Paket Baru</span>
        </a>
    </div>

    <!-- Package Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200/80">
                        <th class="p-4">Foto & Nama Paket</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga / Satuan</th>
                        <th class="p-4">Durasi</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Unggulan</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                    @forelse($packages as $pkg)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $pkg->name }}" class="w-14 h-14 rounded-xl object-cover border border-slate-200">
                                    <div>
                                        <span class="font-bold text-slate-900 text-sm block">{{ $pkg->name }}</span>
                                        <span class="text-[11px] text-slate-400 font-normal">📍 {{ $pkg->location ?? 'Pangandaran' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[11px] font-semibold">
                                    {{ $pkg->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span class="font-bold text-ocean-700 text-sm block">{{ $pkg->formatted_price }}</span>
                                <span class="text-[10px] text-slate-400">/ {{ $pkg->price_unit }}</span>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                ⏱️ {{ $pkg->duration ?? '-' }}
                            </td>
                            <td class="p-4">
                                @if($pkg->status === 'PUBLISHED')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Published</span>
                                @elseif($pkg->status === 'DRAFT')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">Draft</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">Archived</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <form action="{{ route('admin.packages.toggle-featured', $pkg->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-1.5 rounded-lg border {{ $pkg->featured ? 'bg-amber-100 border-amber-300 text-amber-600' : 'bg-slate-50 border-slate-200 text-slate-400' }}" title="Klik untuk ubah status unggulan">
                                        {{ $pkg->featured ? '⭐ Ya' : '☆ Tidak' }}
                                    </button>
                                </form>
                            </td>
                            <td class="p-4 text-right whitespace-nowrap">
                                <a href="{{ route('admin.packages.edit', $pkg->id) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-ocean-100 hover:text-ocean-700 font-bold transition inline-block mr-1">
                                    Edit
                                </a>
                                <form action="{{ route('admin.packages.destroy', $pkg->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus paket wisata ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 font-bold transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-slate-400">Tidak ada paket wisata yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($packages->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
