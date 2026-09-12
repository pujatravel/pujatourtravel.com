@extends('admin.layouts.app')

@section('title', 'Tambah Paket Wisata')
@section('page-title', 'Tambah Paket Wisata Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Paket Wisata *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Body Rafting Green Canyon Full Track" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Kategori Paket *</label>
                    <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Harga Satuan (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price') }}" required placeholder="225000" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Durasi Trip</label>
                    <input type="text" name="duration" value="{{ old('duration') }}" placeholder="Contoh: 4 - 5 Jam / 2D1N" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Lokasi Destinasi</label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Contoh: Green Canyon Pangandaran" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Deskripsi Singkat (Preview Kartu)</label>
                <textarea name="short_description" rows="2" placeholder="Tuliskan 2-3 kalimat ringkas untuk kartu paket..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('short_description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" placeholder="Penjelasan lengkap mengenai aktivitas, pengalaman, dan keistimewaan tur..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Fasilitas Termasuk (Inclusions)</label>
                    <p class="text-[11px] text-slate-400 mb-1">Tuliskan 1 item per baris:</p>
                    <textarea name="inclusions_text" rows="4" placeholder="Pemandu Lisensi HPI&#10;Helm & Rompi Pelampung&#10;Makan Siang Prasmanan&#10;Asuransi" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('inclusions_text') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Tidak Termasuk (Exclusions)</label>
                    <p class="text-[11px] text-slate-400 mb-1">Tuliskan 1 item per baris:</p>
                    <textarea name="exclusions_text" rows="4" placeholder="Transportasi dari kota asal&#10;Pengeluaran pribadi" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('exclusions_text') }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Upload Foto Sampul</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Status Publikasi</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white outline-none">
                        <option value="PUBLISHED" {{ old('status') === 'PUBLISHED' ? 'selected' : '' }}>Published (Tayang)</option>
                        <option value="DRAFT" {{ old('status') === 'DRAFT' ? 'selected' : '' }}>Draft</option>
                        <option value="ARCHIVED" {{ old('status') === 'ARCHIVED' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="rounded text-emerald-700 focus:ring-emerald-600 w-4 h-4">
                        <span class="text-xs font-bold text-slate-700">Tampilkan di Rekomendasi Beranda</span>
                    </label>
                </div>
            </div>

            {{-- ===================== SECTION: RENCANA PERJALANAN ===================== --}}
            <div class="pt-6 border-t border-slate-100">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 text-xs">📅</span>
                            Rencana Perjalanan (Itinerary)
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Tambahkan langkah-langkah perjalanan beserta waktu pelaksanaannya.</p>
                    </div>
                    <button type="button" id="btn-add-itinerary"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Tambah Langkah
                    </button>
                </div>

                {{-- Hidden input yang akan diisi JSON saat submit --}}
                <input type="hidden" name="itinerary_json" id="itinerary_json_input">

                {{-- Container list itinerary --}}
                <div id="itinerary-list" class="space-y-3">
                    {{-- Diisi oleh JavaScript --}}
                </div>

                <p id="itinerary-empty-msg" class="text-center text-xs text-slate-400 py-6 border-2 border-dashed border-slate-200 rounded-2xl">
                    Belum ada rencana perjalanan. Klik <strong>+ Tambah Langkah</strong> untuk mulai menambahkan.
                </p>
            </div>
            {{-- ===================================================================== --}}

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.packages.index') }}" class="px-5 py-3 rounded-xl text-slate-600 hover:bg-slate-100 font-bold text-xs transition">
                    Batal
                </a>
                <button type="submit" class="px-7 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition">
                    Simpan Paket Wisata
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function () {
    // Untuk form create, mulai dengan array kosong
    let itinerary = [];

    const list      = document.getElementById('itinerary-list');
    const emptyMsg  = document.getElementById('itinerary-empty-msg');
    const jsonInput = document.getElementById('itinerary_json_input');

    function renderAll() {
        list.innerHTML = '';
        if (itinerary.length === 0) {
            emptyMsg.classList.remove('hidden');
        } else {
            emptyMsg.classList.add('hidden');
            itinerary.forEach((item, idx) => renderItem(item, idx));
        }
        syncJson();
    }

    function renderItem(item, idx) {
        const div = document.createElement('div');
        div.className = 'flex gap-3 items-start bg-slate-50 border border-slate-200 rounded-2xl p-4 group';
        div.dataset.idx = idx;

        div.innerHTML = `
            <div class="flex flex-col gap-1 pt-1 shrink-0">
                <button type="button" onclick="itineraryMoveUp(${idx})" title="Pindah ke atas"
                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-white border border-slate-200 hover:bg-emerald-50 hover:border-emerald-400 text-slate-400 hover:text-emerald-700 transition text-xs ${idx === 0 ? 'opacity-30 pointer-events-none' : ''}">▲</button>
                <button type="button" onclick="itineraryMoveDown(${idx})" title="Pindah ke bawah"
                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-white border border-slate-200 hover:bg-emerald-50 hover:border-emerald-400 text-slate-400 hover:text-emerald-700 transition text-xs ${idx === itinerary.length - 1 ? 'opacity-30 pointer-events-none' : ''}">▼</button>
            </div>
            <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Judul Langkah *</label>
                    <input type="text" value="${escHtml(item.title || '')}" placeholder="Contoh: Briefing & Pemasangan Alat"
                        onchange="itineraryUpdate(${idx}, 'title', this.value)"
                        oninput="itineraryUpdate(${idx}, 'title', this.value)"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Waktu</label>
                    <input type="text" value="${escHtml(item.time || '')}" placeholder="08:30" maxlength="5" pattern="[0-9]{2}:[0-9]{2}"
                        onchange="itineraryUpdate(${idx}, 'time', this.value)"
                        oninput="itineraryFormatTime(this)"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none font-mono tracking-widest">
                </div>
                <div class="sm:col-span-3">
                    <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Deskripsi Singkat</label>
                    <textarea rows="2" placeholder="Penjelasan singkat aktivitas pada langkah ini..."
                        onchange="itineraryUpdate(${idx}, 'description', this.value)"
                        oninput="itineraryUpdate(${idx}, 'description', this.value)"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none">${escHtml(item.description || '')}</textarea>
                </div>
            </div>
            <button type="button" onclick="itineraryRemove(${idx})" title="Hapus langkah ini"
                class="mt-1 shrink-0 w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 border border-red-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        `;
        list.appendChild(div);
    }

    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
    }

    function syncJson() {
        jsonInput.value = JSON.stringify(itinerary);
    }

    window.itineraryUpdate = function(idx, field, val) {
        if (itinerary[idx] !== undefined) {
            itinerary[idx][field] = val;
            syncJson();
        }
    };

    window.itineraryFormatTime = function(input) {
        // Hapus karakter non-digit
        let raw = input.value.replace(/[^0-9]/g, '');

        let hours = raw.slice(0, 2);
        let mins  = raw.slice(2, 4);

        // Clamp jam: max 23
        if (hours.length === 2 && parseInt(hours, 10) > 23) hours = '23';
        // Clamp menit: max 59
        if (mins.length === 2 && parseInt(mins, 10) > 59) mins = '59';

        let val = hours;
        if (raw.length > 2) val = hours + ':' + mins;

        input.value = val;

        const idx = input.closest('[data-idx]')?.dataset.idx;
        if (idx !== undefined && itinerary[idx] !== undefined) {
            itinerary[idx].time = val;
            syncJson();
        }
    };

    window.itineraryRemove = function(idx) {
        itinerary.splice(idx, 1);
        renderAll();
    };

    window.itineraryMoveUp = function(idx) {
        if (idx === 0) return;
        [itinerary[idx - 1], itinerary[idx]] = [itinerary[idx], itinerary[idx - 1]];
        renderAll();
    };

    window.itineraryMoveDown = function(idx) {
        if (idx >= itinerary.length - 1) return;
        [itinerary[idx], itinerary[idx + 1]] = [itinerary[idx + 1], itinerary[idx]];
        renderAll();
    };

    document.getElementById('btn-add-itinerary').addEventListener('click', function () {
        itinerary.push({ title: '', time: '', description: '' });
        renderAll();
        const inputs = list.querySelectorAll('input[type="text"]');
        if (inputs.length > 0) {
            inputs[inputs.length - 1].focus();
            inputs[inputs.length - 1].scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    document.querySelector('form').addEventListener('submit', function () {
        syncJson();
    });

    renderAll();
})();
</script>
@endpush
@endsection
