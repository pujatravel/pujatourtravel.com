@extends('admin.layouts.app')

@section('title', 'Katalog Paket Wisata')
@section('page-title', 'Manajemen Paket Wisata')

@section('content')
<div class="space-y-6">
    <!-- Header Actions & Search -->
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3.5 bg-surface-soft p-4 sm:p-5 rounded-3xl border border-neutral-200 shadow-soft">
        <!-- Search & Filter Form -->
        <form action="{{ route('admin.packages.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 flex-1">
            <div class="relative flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama paket atau lokasi..." class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
            </div>

            <div class="flex items-center gap-2">
                <select name="status" onchange="this.form.submit()" class="flex-1 sm:flex-none px-3 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white outline-none">
                    <option value="">Semua Status</option>
                    <option value="PUBLISHED" {{ request('status') === 'PUBLISHED' ? 'selected' : '' }}>Published</option>
                    <option value="DRAFT" {{ request('status') === 'DRAFT' ? 'selected' : '' }}>Draft</option>
                    <option value="ARCHIVED" {{ request('status') === 'ARCHIVED' ? 'selected' : '' }}>Archived</option>
                </select>

                <button type="submit" class="px-4 py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition shrink-0">
                    Filter
                </button>
            </div>
        </form>

        <a href="{{ route('admin.packages.create') }}" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center justify-center gap-2 whitespace-nowrap">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Paket Baru</span>
        </a>
    </div>

    <!-- Package Table & Mobile Card View -->
    <div class="bg-surface-soft rounded-3xl shadow-soft border border-neutral-200 overflow-hidden">
        <!-- Mobile Cards View (< md) -->
        <div class="block md:hidden divide-y divide-neutral-200">
            @forelse($packages as $pkg)
                <div class="p-4 bg-white space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-start gap-3 min-w-0">
                            <img src="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $pkg->name }}" class="w-16 h-16 rounded-xl object-cover border border-neutral-200 shrink-0">
                            <div class="min-w-0">
                                <h4 class="font-bold text-slate-900 text-sm leading-snug break-words">{{ $pkg->name }}</h4>
                                <div class="flex flex-wrap items-center gap-1.5 mt-1">
                                    <span class="inline-flex items-center gap-1 text-[11px] text-slate-500">
                                        <i data-lucide="map-pin" class="w-3 h-3 text-slate-400 shrink-0"></i>
                                        <span class="truncate">{{ $pkg->location ?? 'Pangandaran' }}</span>
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[10px] font-semibold">
                                        {{ $pkg->category->name ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Dropdown Menu -->
                        <div class="relative shrink-0 dropdown-action-menu">
                            <button type="button" 
                                    onclick="toggleActionDropdown(event, this)" 
                                    class="p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition border border-slate-200/80 cursor-pointer focus:outline-none" 
                                    title="Opsi Aksi">
                                <i data-lucide="more-vertical" class="w-4 h-4"></i>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 mt-1 w-36 bg-white rounded-2xl shadow-xl border border-neutral-200 py-1.5 z-40 text-left">
                                <a href="{{ route('admin.packages.edit', $pkg->id) }}" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                    <i data-lucide="pencil" class="w-4 h-4 text-slate-400"></i>
                                    <span>Edit</span>
                                </a>
                                <div class="my-1 border-t border-slate-100"></div>
                                <form action="{{ route('admin.packages.destroy', $pkg->id) }}" method="POST" onsubmit="confirmDelete(event, 'Apakah Anda yakin ingin menghapus paket wisata {{ addslashes($pkg->name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition text-left cursor-pointer">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-rose-500"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Details Row: Price, Duration, Status, Featured -->
                    <div class="pt-2.5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-xs">
                        <div>
                            <span class="font-extrabold text-emerald-700 text-sm block">{{ $pkg->formatted_price }}</span>
                            <span class="text-[10px] text-slate-400">/ {{ $pkg->price_unit }}</span>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <!-- Duration -->
                            <span class="inline-flex items-center gap-1 text-[11px] text-slate-600 bg-slate-50 px-2 py-1 rounded-lg border border-slate-200/80">
                                <i data-lucide="clock" class="w-3 h-3 text-slate-400"></i>
                                <span>{{ $pkg->duration ?? '-' }}</span>
                            </span>

                            <!-- Status Badge -->
                            @if($pkg->status === 'PUBLISHED')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Published</span>
                            @elseif($pkg->status === 'DRAFT')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">Draft</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">Archived</span>
                            @endif

                            <!-- Featured Star Toggle -->
                            <form action="{{ route('admin.packages.toggle-featured', $pkg->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1 p-1.5 rounded-lg border text-[11px] font-semibold {{ $pkg->featured ? 'bg-amber-50 border-amber-300 text-amber-800' : 'bg-slate-50 border-slate-200 text-slate-400' }}" title="Ubah status unggulan">
                                    <i data-lucide="star" class="w-3.5 h-3.5 {{ $pkg->featured ? 'fill-amber-500 text-amber-500' : '' }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400 text-xs">Tidak ada paket wisata yang ditemukan.</div>
            @endforelse
        </div>

        <!-- Desktop Table View (>= md) -->
        <div class="hidden md:block overflow-x-auto min-h-[380px]">
            <table class="w-full text-left text-xs min-w-[700px]">
                <thead>
                    <tr class="bg-canvas text-slate-500 font-bold uppercase tracking-wider border-b border-neutral-200">
                        <th class="p-4">Foto & Nama Paket</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga / Satuan</th>
                        <th class="p-4">Durasi</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Unggulan</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 text-slate-700 font-medium">
                    @forelse($packages as $pkg)
                        <tr class="hover:bg-canvas transition">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $pkg->image_url ?? asset('images/greencanyon.jpg') }}" alt="{{ $pkg->name }}" class="w-14 h-14 rounded-xl object-cover border border-neutral-200">
                                    <div>
                                        <span class="font-bold text-slate-900 text-sm block">{{ $pkg->name }}</span>
                                        <span class="inline-flex items-center gap-1 text-[11px] text-slate-400 font-normal">
                                            <i data-lucide="map-pin" class="w-3 h-3 text-slate-400"></i>
                                            <span>{{ $pkg->location ?? 'Pangandaran' }}</span>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[11px] font-semibold">
                                    {{ $pkg->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span class="font-bold text-emerald-700 text-sm block">{{ $pkg->formatted_price }}</span>
                                <span class="text-[10px] text-slate-400">/ {{ $pkg->price_unit }}</span>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 text-slate-600">
                                    <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span>{{ $pkg->duration ?? '-' }}</span>
                                </span>
                            </td>
                            <td class="p-4">
                                @if($pkg->status === 'PUBLISHED')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Published</span>
                                @elseif($pkg->status === 'DRAFT')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">Draft</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">Archived</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <form action="{{ route('admin.packages.toggle-featured', $pkg->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-semibold {{ $pkg->featured ? 'bg-amber-50 border-amber-300 text-amber-800' : 'bg-slate-50 border-slate-200 text-slate-400' }}" title="Klik untuk ubah status unggulan">
                                        <i data-lucide="star" class="w-3.5 h-3.5 {{ $pkg->featured ? 'fill-amber-500 text-amber-500' : '' }}"></i>
                                        <span>{{ $pkg->featured ? 'Unggulan' : 'Biasa' }}</span>
                                    </button>
                                </form>
                            </td>
                            <td class="p-4 text-right whitespace-nowrap">
                                <div class="relative inline-block text-left dropdown-action-menu">
                                    <button type="button" 
                                            onclick="toggleActionDropdown(event, this)" 
                                            class="p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-200/60 transition border border-transparent hover:border-slate-300/60 cursor-pointer focus:outline-none" 
                                            title="Opsi Aksi">
                                        <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                    </button>
                                    <div class="dropdown-menu hidden absolute right-0 mt-1 w-36 bg-white rounded-2xl shadow-xl border border-neutral-200/90 py-1.5 z-40 text-left">
                                        <a href="{{ route('admin.packages.edit', $pkg->id) }}" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                            <i data-lucide="pencil" class="w-4 h-4 text-slate-400"></i>
                                            <span>Edit</span>
                                        </a>
                                        <div class="my-1 border-t border-slate-100"></div>
                                        <form action="{{ route('admin.packages.destroy', $pkg->id) }}" method="POST" onsubmit="confirmDelete(event, 'Apakah Anda yakin ingin menghapus paket wisata {{ addslashes($pkg->name) }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition text-left cursor-pointer">
                                                <i data-lucide="trash-2" class="w-4 h-4 text-rose-500"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
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

@push('scripts')
<script>
function toggleActionDropdown(event, button) {
    event.stopPropagation();
    const dropdown = button.nextElementSibling;
    const allMenus = document.querySelectorAll('.dropdown-action-menu .dropdown-menu');
    allMenus.forEach(menu => {
        if (menu !== dropdown) {
            menu.classList.add('hidden');
        }
    });
    if (dropdown) {
        dropdown.classList.toggle('hidden');
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons();
        }
    }
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-action-menu')) {
        document.querySelectorAll('.dropdown-action-menu .dropdown-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    }
});
</script>
@endpush
@endsection
