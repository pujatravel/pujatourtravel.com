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
@endsection
