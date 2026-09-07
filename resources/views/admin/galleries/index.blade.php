@extends('admin.layouts.app')

@section('title', 'Galeri Foto')
@section('page-title', 'Manajemen Galeri Dokumentasi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left: Gallery Grid -->
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
            <h3 class="font-display font-bold text-lg text-slate-900 mb-5">Foto Dokumentasi Aktif</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @forelse($galleries as $gal)
                    <div class="group relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 h-48 flex flex-col justify-end">
                        <img src="{{ $gal->image_url }}" alt="{{ $gal->title }}" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                        <div class="relative z-10 p-3 flex items-end justify-between">
                            <div>
                                <span class="text-[10px] font-bold bg-ocean-600 text-white px-2 py-0.5 rounded-full inline-block">{{ $gal->category }}</span>
                                <h4 class="text-xs font-bold text-white mt-1 line-clamp-1">{{ $gal->title }}</h4>
                            </div>
                            <form action="{{ route('admin.galleries.destroy', $gal->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg bg-rose-600 text-white hover:bg-rose-700 transition" title="Hapus Foto">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center py-10 text-slate-400">Belum ada foto galeri.</p>
                @endforelse
            </div>

            @if($galleries->hasPages())
                <div class="pt-6 border-t border-slate-100 mt-6">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Right: Upload Form -->
    <div class="lg:col-span-4">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
            <h3 class="font-display font-bold text-lg text-slate-900 mb-4">+ Unggah Foto Baru</h3>
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Judul Foto *</label>
                    <input type="text" name="title" required placeholder="Contoh: Keseruan Rafting Green Canyon" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Kategori *</label>
                    <select name="category" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">
                        <option value="Rafting">Body Rafting</option>
                        <option value="Bahari">Wisata Bahari & Snorkeling</option>
                        <option value="Alam">Cagar Alam & Edukasi</option>
                        <option value="Sunset">Sunset & Pantai</option>
                        <option value="Gathering">Rombongan & Gathering</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">File Foto (JPG/PNG/WEBP) *</label>
                    <input type="file" name="image" accept="image/*" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Keterangan / Caption</label>
                    <textarea name="caption" rows="2" placeholder="Catatan singkat foto..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-ocean-600 hover:bg-ocean-700 text-white font-bold text-xs shadow-md transition">
                    Unggah ke Galeri
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
