@extends('admin.layouts.app')

@section('title', 'Kategori Paket Wisata')
@section('page-title', 'Manajemen Kategori Paket Wisata')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm text-slate-500 mt-0.5">Kelola kategori untuk mengelompokkan paket wisata. Urutan tampil dapat diatur dengan drag & drop.</p>
        </div>
        <button type="button" onclick="toggleAddForm()"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow transition shrink-0">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Kategori Baru
        </button>
    </div>

    {{-- Add Category Form (hidden by default) --}}
    <div id="add-category-form" class="hidden">
        <div class="bg-white rounded-3xl border border-emerald-200 shadow-sm p-6 sm:p-7">
            <h3 class="font-display font-bold text-base text-slate-900 mb-5 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="folder-plus" class="w-4 h-4"></i>
                </div>
                Tambah Kategori Baru
            </h3>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Nama Kategori <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="new_name" value="{{ old('name') }}"
                            placeholder="Contoh: Wisata Alam, Wisata Religi..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition"
                            required>
                        @error('name')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Deskripsi Singkat</label>
                        <textarea name="description" rows="2"
                            placeholder="Deskripsi singkat kategori (opsional)..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition resize-none">{{ old('description') }}</textarea>
                    </div>

                    <div class="sm:col-span-2 flex items-center gap-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:bg-emerald-600 transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5"></div>
                        </label>
                        <span class="text-sm font-medium text-slate-700">Tampilkan di Website</span>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-5 pt-5 border-t border-slate-100">
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow transition flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Kategori
                    </button>
                    <button type="button" onclick="toggleAddForm()"
                        class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Categories List --}}
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        {{-- Table Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-sm text-slate-900">Daftar Kategori</h3>
                    <p class="text-xs text-slate-400">{{ $categories->count() }} kategori terdaftar</p>
                </div>
            </div>
            <span class="text-xs text-slate-400 hidden sm:block">Drag baris untuk mengubah urutan</span>
        </div>

        @if($categories->isEmpty())
            <div class="py-16 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="folder-open" class="w-7 h-7"></i>
                </div>
                <h4 class="font-display font-bold text-slate-700 mb-1">Belum Ada Kategori</h4>
                <p class="text-sm text-slate-400 mb-5">Tambahkan kategori pertama Anda untuk mengelompokkan paket wisata.</p>
                <button type="button" onclick="toggleAddForm()"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-700 text-white font-bold text-sm shadow transition hover:bg-emerald-800">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kategori Pertama
                </button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50/80 border-b border-slate-100">
                        <tr>
                            <th class="px-4 py-3 text-left w-8"></th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Kategori</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-slate-500 uppercase tracking-wide whitespace-nowrap min-w-25">Paket</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-slate-500 uppercase tracking-wide w-24">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-bold text-slate-500 uppercase tracking-wide w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="categories-sortable" class="divide-y divide-slate-100">
                        @foreach($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition group category-row" data-id="{{ $category->id }}">
                            {{-- Drag Handle --}}
                            <td class="px-4 py-4">
                                <div class="cursor-grab active:cursor-grabbing text-slate-300 hover:text-slate-500 transition drag-handle">
                                    <i data-lucide="grip-vertical" class="w-4 h-4"></i>
                                </div>
                            </td>

                            {{-- Category Info --}}
                            <td class="px-4 py-4">
                                <div id="view-{{ $category->id }}">
                                    <span class="font-semibold text-slate-800">{{ $category->name }}</span>
                                    @if($category->description)
                                        <p class="text-xs text-slate-400 mt-0.5 truncate max-w-xs">{{ $category->description }}</p>
                                    @endif
                                    <span class="text-[10px] font-mono text-slate-400">{{ $category->slug }}</span>
                                </div>

                                {{-- Inline Edit Form --}}
                                <div id="edit-{{ $category->id }}" class="hidden">
                                    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="space-y-2">
                                            <input type="text" name="name" value="{{ $category->name }}"
                                                class="w-full px-3 py-2 rounded-lg border border-emerald-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none"
                                                required>
                                            <textarea name="description" rows="1"
                                                placeholder="Deskripsi (opsional)"
                                                class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-emerald-500 outline-none resize-none">{{ $category->description }}</textarea>
                                            <label class="flex items-center gap-1.5 text-xs text-slate-600 cursor-pointer">
                                                <input type="hidden" name="is_active" value="0">
                                                <input type="checkbox" name="is_active" value="1" class="rounded" {{ $category->is_active ? 'checked' : '' }}>
                                                Aktif
                                            </label>
                                            <div class="flex gap-2">
                                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-emerald-700 text-white text-xs font-bold flex items-center gap-1">
                                                    <i data-lucide="check" class="w-3 h-3"></i> Simpan
                                                </button>
                                                <button type="button" onclick="cancelEdit({{ $category->id }})" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 text-xs font-bold">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>



                            {{-- Package Count --}}
                            <td class="px-4 py-4 text-center whitespace-nowrap">
                                <a href="{{ route('admin.packages.index', ['category' => $category->id]) }}"
                                    class="inline-flex items-center justify-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap shrink-0
                                    {{ $category->packages_count > 0 ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-slate-100 text-slate-400' }} transition">
                                    <i data-lucide="package" class="w-3.5 h-3.5 shrink-0"></i>
                                    <span class="whitespace-nowrap">{{ $category->packages_count }} paket</span>
                                </a>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-4 text-center">
                                <form action="{{ route('admin.categories.toggle-active', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold transition cursor-pointer
                                        {{ $category->is_active ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}"
                                        title="{{ $category->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                                        <i data-lucide="{{ $category->is_active ? 'eye' : 'eye-off' }}" class="w-3 h-3"></i>
                                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-4 text-right">
                                <div class="relative inline-block text-left dropdown-container">
                                    <button type="button" onclick="toggleDropdown(event, {{ $category->id }})"
                                        class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition focus:outline-none"
                                        title="Menu Aksi">
                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                    </button>

                                    <div id="dropdown-{{ $category->id }}"
                                        class="category-dropdown hidden absolute right-0 mt-1 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-1.5 z-30 text-left divide-y divide-slate-100">
                                        
                                        <div class="py-1">
                                            <button type="button" onclick="startEdit({{ $category->id }}); closeAllDropdowns();"
                                                class="w-full px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 flex items-center gap-2 transition">
                                                <i data-lucide="pencil" class="w-3.5 h-3.5 text-emerald-600"></i>
                                                Edit Kategori
                                            </button>
                                        </div>

                                        <div class="py-1">
                                            <form action="{{ route('admin.categories.toggle-active', $category) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="w-full px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 flex items-center gap-2 transition">
                                                    <i data-lucide="{{ $category->is_active ? 'eye-off' : 'eye' }}" class="w-3.5 h-3.5 text-amber-500"></i>
                                                    {{ $category->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                        </div>

                                        <div class="py-1">
                                            @if($category->packages_count > 0)
                                                <button type="button" disabled
                                                    title="Tidak dapat dihapus – masih memiliki {{ $category->packages_count }} paket"
                                                    class="w-full px-4 py-2 text-xs font-semibold text-slate-300 flex items-center gap-2 cursor-not-allowed">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5 text-slate-300"></i>
                                                    Hapus Kategori
                                                </button>
                                            @else
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                                    onsubmit="return confirmDelete(event, 'Hapus kategori \'{{ addslashes($category->name) }}\'? Tindakan ini tidak dapat dibatalkan.', 'Hapus Kategori')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 flex items-center gap-2 transition">
                                                        <i data-lucide="trash-2" class="w-3.5 h-3.5 text-rose-500"></i>
                                                        Hapus Kategori
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
                <p class="text-xs text-slate-400">Seret dan lepas baris untuk mengubah urutan tampil kategori. Perubahan urutan disimpan otomatis.</p>
            </div>
        @endif
    </div>

    {{-- Quick Tips --}}
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex gap-3">
        <i data-lucide="lightbulb" class="w-4 h-4 text-amber-500 shrink-0 mt-0.5"></i>
        <div class="text-xs text-amber-700 space-y-1">
            <p class="font-bold">Tips Kategori Paket Wisata:</p>
            <ul class="list-disc pl-4 space-y-0.5 text-amber-600">
                <li>Kategori yang dinonaktifkan tidak akan muncul di halaman publik tetapi masih bisa digunakan di admin.</li>
                <li>Kategori dengan paket tidak dapat dihapus. Pindahkan paket ke kategori lain terlebih dahulu.</li>
                <li>Urutan tampil menentukan urutan kategori di halaman paket wisata.</li>
            </ul>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
// Toggle add form visibility
function toggleAddForm() {
    const form = document.getElementById('add-category-form');
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
    document.querySelectorAll('.category-dropdown').forEach(el => el.classList.add('hidden'));
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-container')) {
        closeAllDropdowns();
    }
});

// Drag & Drop reorder using SortableJS (loaded via CDN)
document.addEventListener('DOMContentLoaded', function() {
    const sortable = document.getElementById('categories-sortable');
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
                const rows = sortable.querySelectorAll('.category-row');
                const order = Array.from(rows).map(row => row.dataset.id);

                fetch('{{ route("admin.categories.reorder") }}', {
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
                        // Update the order number badges
                        rows.forEach((row, index) => {
                            const badge = row.querySelector('.w-8.h-8.rounded-lg.bg-slate-100');
                            if (badge) badge.textContent = index + 1;
                        });
                        showToast('Urutan kategori berhasil diperbarui.', 'success');
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
