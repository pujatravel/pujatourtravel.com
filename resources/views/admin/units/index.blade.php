@extends('admin.layouts.app')

@section('title', 'Satuan Paket Wisata')
@section('page-title', 'Manajemen Satuan Paket Wisata')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm text-slate-500 mt-0.5">Kelola data satuan harga paket wisata (contoh: Pax, Orang, Rombongan, Paket). Urutan tampil dapat diatur dengan drag & drop.</p>
        </div>
        <button type="button" onclick="toggleAddForm()"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow transition shrink-0 cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Satuan Baru
        </button>
    </div>

    {{-- Add Unit Form (hidden by default) --}}
    <div id="add-unit-form" class="hidden">
        <div class="bg-white rounded-3xl border border-emerald-200 shadow-sm p-6 sm:p-7">
            <h3 class="font-display font-bold text-base text-slate-900 mb-5 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="scale" class="w-4 h-4"></i>
                </div>
                Tambah Satuan Baru
            </h3>

            <form action="{{ route('admin.units.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Nama Satuan <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="new_name" value="{{ old('name') }}"
                            placeholder="Contoh: Pax, Orang, Rombongan, Mobil, Grup..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition"
                            required>
                        @error('name')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Deskripsi Singkat</label>
                        <textarea name="description" rows="2"
                            placeholder="Deskripsi atau keterangan penggunaan satuan (opsional)..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition resize-none">{{ old('description') }}</textarea>
                    </div>

                    <div class="sm:col-span-2 flex items-center gap-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:bg-emerald-600 transition-all after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5"></div>
                        </label>
                        <span class="text-sm font-medium text-slate-700">Status Aktif (Tersedia untuk Paket Wisata)</span>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-5 pt-5 border-t border-slate-100">
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow transition flex items-center gap-2 cursor-pointer">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Satuan
                    </button>
                    <button type="button" onclick="toggleAddForm()"
                        class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm transition cursor-pointer">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Units List --}}
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        {{-- Table Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="scale" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-sm text-slate-900">Daftar Satuan</h3>
                    <p class="text-xs text-slate-400">{{ $units->count() }} satuan terdaftar</p>
                </div>
            </div>
            <span class="text-xs text-slate-400 hidden sm:block">Drag baris untuk mengubah urutan</span>
        </div>

        @if($units->isEmpty())
            <div class="py-16 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="scale" class="w-7 h-7"></i>
                </div>
                <h4 class="font-display font-bold text-slate-700 mb-1">Belum Ada Satuan</h4>
                <p class="text-sm text-slate-400 mb-5">Tambahkan satuan pertama Anda untuk tarif paket wisata.</p>
                <button type="button" onclick="toggleAddForm()"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-700 text-white font-bold text-sm shadow transition hover:bg-emerald-800 cursor-pointer">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Satuan Pertama
                </button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50/80 border-b border-slate-100">
                        <tr>
                            <th class="px-4 py-3 text-left w-8"></th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Satuan</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-slate-500 uppercase tracking-wide w-28">Paket Terkait</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-slate-500 uppercase tracking-wide w-24">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-bold text-slate-500 uppercase tracking-wide w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="units-sortable" class="divide-y divide-slate-100">
                        @foreach($units as $unit)
                        <tr class="hover:bg-slate-50/50 transition group unit-row" data-id="{{ $unit->id }}">
                            {{-- Drag Handle --}}
                            <td class="px-4 py-4">
                                <div class="cursor-grab active:cursor-grabbing text-slate-300 hover:text-slate-500 transition drag-handle">
                                    <i data-lucide="grip-vertical" class="w-4 h-4"></i>
                                </div>
                            </td>

                            {{-- Unit Info --}}
                            <td class="px-4 py-4">
                                <div id="view-{{ $unit->id }}">
                                    <span class="font-semibold text-slate-800">{{ $unit->name }}</span>
                                    @if($unit->description)
                                        <p class="text-xs text-slate-400 mt-0.5 truncate max-w-xs">{{ $unit->description }}</p>
                                    @endif
                                    <span class="text-[10px] font-mono text-slate-400">{{ $unit->slug }}</span>
                                </div>

                                {{-- Inline Edit Form --}}
                                <div id="edit-{{ $unit->id }}" class="hidden">
                                    <form action="{{ route('admin.units.update', $unit) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="space-y-2">
                                            <input type="text" name="name" value="{{ $unit->name }}"
                                                class="w-full px-3 py-2 rounded-lg border border-emerald-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none"
                                                required>
                                            <textarea name="description" rows="1"
                                                placeholder="Deskripsi (opsional)"
                                                class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 outline-none resize-none">{{ $unit->description }}</textarea>
                                            <label class="flex items-center gap-1.5 text-xs text-slate-600 cursor-pointer">
                                                <input type="hidden" name="is_active" value="0">
                                                <input type="checkbox" name="is_active" value="1" class="rounded" {{ $unit->is_active ? 'checked' : '' }}>
                                                Aktif
                                            </label>
                                            <div class="flex gap-2">
                                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-emerald-700 text-white text-xs font-bold flex items-center gap-1 cursor-pointer">
                                                    <i data-lucide="check" class="w-3 h-3"></i> Simpan
                                                </button>
                                                <button type="button" onclick="cancelEdit({{ $unit->id }})" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 text-xs font-bold cursor-pointer">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>

                            {{-- Package Count --}}
                            <td class="px-4 py-4 text-center">
                                <a href="{{ route('admin.packages.index') }}"
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold
                                    {{ $unit->packages_count > 0 ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-slate-100 text-slate-400' }} transition">
                                    <i data-lucide="package" class="w-3 h-3"></i>
                                    {{ $unit->packages_count }} paket
                                </a>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-4 text-center">
                                <form action="{{ route('admin.units.toggle-active', $unit) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold transition cursor-pointer
                                        {{ $unit->is_active ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}"
                                        title="{{ $unit->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                                        <i data-lucide="{{ $unit->is_active ? 'eye' : 'eye-off' }}" class="w-3 h-3"></i>
                                        {{ $unit->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-4 text-right">
                                <div class="relative inline-block text-left dropdown-container">
                                    <button type="button" onclick="toggleDropdown(event, {{ $unit->id }})"
                                        class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition focus:outline-none cursor-pointer"
                                        title="Menu Aksi">
                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                    </button>

                                    <div id="dropdown-{{ $unit->id }}"
                                        class="unit-dropdown hidden absolute right-0 mt-1 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-1.5 z-30 text-left divide-y divide-slate-100">
                                        
                                        <div class="py-1">
                                            <button type="button" onclick="startEdit({{ $unit->id }}); closeAllDropdowns();"
                                                class="w-full px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 flex items-center gap-2 transition cursor-pointer">
                                                <i data-lucide="pencil" class="w-3.5 h-3.5 text-emerald-600"></i>
                                                Edit Satuan
                                            </button>
                                        </div>

                                        <div class="py-1">
                                            <form action="{{ route('admin.units.toggle-active', $unit) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="w-full px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 flex items-center gap-2 transition cursor-pointer">
                                                    <i data-lucide="{{ $unit->is_active ? 'eye-off' : 'eye' }}" class="w-3.5 h-3.5 text-amber-500"></i>
                                                    {{ $unit->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                        </div>

                                        <div class="py-1">
                                            @if($unit->packages_count > 0)
                                                <button type="button" disabled
                                                    title="Tidak dapat dihapus – masih memiliki {{ $unit->packages_count }} paket"
                                                    class="w-full px-4 py-2 text-xs font-semibold text-slate-300 flex items-center gap-2 cursor-not-allowed">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5 text-slate-300"></i>
                                                    Hapus Satuan
                                                </button>
                                            @else
                                                <form action="{{ route('admin.units.destroy', $unit) }}" method="POST"
                                                    onsubmit="return confirmDelete(event, 'Hapus satuan \'{{ addslashes($unit->name) }}\'? Tindakan ini tidak dapat dibatalkan.', 'Hapus Satuan')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 flex items-center gap-2 transition cursor-pointer">
                                                        <i data-lucide="trash-2" class="w-3.5 h-3.5 text-rose-500"></i>
                                                        Hapus Satuan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Drag & Drop Info Footer --}}
            <div class="px-6 py-3 border-t border-slate-100 bg-slate-50/50 flex items-center gap-2">
                <i data-lucide="info" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                <p class="text-xs text-slate-400">Seret dan lepas baris untuk mengubah urutan tampil satuan pada pilihan paket. Perubahan urutan disimpan otomatis.</p>
            </div>
        @endif
    </div>

    {{-- Quick Tips --}}
    <div class="bg-emerald-50/60 border border-emerald-200 rounded-2xl p-4 flex gap-3">
        <i data-lucide="lightbulb" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
        <div class="text-xs text-emerald-800 space-y-1">
            <p class="font-bold">Tips Satuan Paket Wisata:</p>
            <ul class="list-disc pl-4 space-y-0.5 text-emerald-700">
                <li>Satuan ini digunakan sebagai unit penagihan/harga pada paket wisata (misal: "Rp 225.000 / pax" atau "Rp 1.500.000 / rombongan").</li>
                <li>Satuan yang dinonaktifkan tidak akan muncul pada dropdown saat menambah/mengedit paket wisata baru.</li>
                <li>Satuan yang masih memiliki paket terkait tidak dapat dihapus untuk menjaga konsistensi data.</li>
            </ul>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
// Toggle add form visibility
function toggleAddForm() {
    const form = document.getElementById('add-unit-form');
    form.classList.toggle('hidden');
    if (!form.classList.contains('hidden')) {
        document.getElementById('new_name').focus();
        if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
    }
}

// Start inline edit
function startEdit(id) {
    document.getElementById('view-' + id).classList.add('hidden');
    document.getElementById('edit-' + id).classList.remove('hidden');
    if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
}

// Cancel inline edit
function cancelEdit(id) {
    document.getElementById('view-' + id).classList.remove('hidden');
    document.getElementById('edit-' + id).classList.add('hidden');
}

// Dropdown menu toggle
function toggleDropdown(event, id) {
    event.stopPropagation();
    const dropdown = document.getElementById('dropdown-' + id);
    const isHidden = dropdown.classList.contains('hidden');
    closeAllDropdowns();
    if (isHidden) {
        dropdown.classList.remove('hidden');
        if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
    }
}

function closeAllDropdowns() {
    document.querySelectorAll('.unit-dropdown').forEach(el => el.classList.add('hidden'));
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-container')) {
        closeAllDropdowns();
    }
});

// Drag & Drop reorder using SortableJS (loaded via CDN)
document.addEventListener('DOMContentLoaded', function() {
    const sortable = document.getElementById('units-sortable');
    if (!sortable) return;

    // Dynamically load SortableJS if not already loaded
    if (typeof Sortable === 'undefined') {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js';
        script.onload = initSortable;
        document.head.appendChild(script);
    } else {
        initSortable();
    }

    function initSortable() {
        new Sortable(sortable, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'bg-emerald-50',
            chosenClass: 'shadow-lg',
            onEnd: function(evt) {
                const rows = sortable.querySelectorAll('.unit-row');
                const order = Array.from(rows).map(row => row.dataset.id);

                fetch('{{ route("admin.units.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ order }),
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToast('Urutan satuan berhasil diperbarui.', 'success');
                    }
                })
                .catch(() => showToast('Gagal menyimpan urutan. Coba lagi.', 'error'));
            }
        });
    }

    function showToast(message, type) {
        const existing = document.getElementById('sort-toast');
        if (existing) existing.remove();
        const color = type === 'success' ? 'bg-emerald-700' : 'bg-rose-600';
        const toast = document.createElement('div');
        toast.id = 'sort-toast';
        toast.className = `fixed top-5 right-5 z-50 flex items-center gap-3 px-5 py-3.5 rounded-2xl ${color} text-white shadow-lg text-sm font-semibold`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
});
</script>
@endpush
