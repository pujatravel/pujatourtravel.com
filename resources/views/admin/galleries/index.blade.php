@extends('admin.layouts.app')

@section('title', 'Galeri Foto')
@section('page-title', 'Manajemen Galeri & Slider Beranda')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left: Gallery Grid & Slider Management -->
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="font-display font-bold text-lg text-slate-900">Foto Dokumentasi & Slider</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola koleksi galeri dan atur gambar yang tampil pada Hero Banner Slider di Halaman Utama (Beranda)</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('admin.galleries.index') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ !request('filter') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        Semua Foto
                    </a>
                    <a href="{{ route('admin.galleries.index', ['filter' => 'slider']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ request('filter') === 'slider' ? 'bg-amber-500 text-slate-950' : 'bg-amber-50 text-amber-900 border border-amber-200 hover:bg-amber-100' }}">
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                        <span>Slider Utama ({{ $heroSliderCount }})</span>
                    </a>
                </div>
            </div>

            <!-- Gallery Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($galleries as $gal)
                    <div class="group relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-950 h-52 flex flex-col justify-between p-3 transition shadow-xs hover:shadow-md">
                        <img src="{{ $gal->image_url }}" alt="{{ $gal->title }}" class="absolute inset-0 w-full h-full object-cover opacity-85 group-hover:opacity-100 transition-opacity">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-slate-950/20"></div>

                        <!-- Top Badges -->
                        <div class="relative z-10 flex items-center justify-between gap-2">
                            <span class="text-[10px] font-bold bg-emerald-700/90 backdrop-blur-xs text-white px-2.5 py-0.5 rounded-full shadow-xs">
                                {{ $gal->category }}
                            </span>
                            @if($gal->is_slider)
                                <span class="text-[10px] font-black bg-amber-400 text-slate-950 px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs" title="Tampil di Slider Beranda Utama">
                                    <i data-lucide="star" class="w-3 h-3 fill-slate-950"></i>
                                    <span>Slider Beranda</span>
                                </span>
                            @endif
                        </div>

                        <!-- Bottom Content & Action Controls -->
                        <div class="relative z-10">
                            <h4 class="text-xs font-bold text-white line-clamp-1 mb-1">{{ $gal->title }}</h4>
                            @if($gal->caption)
                                <p class="text-[11px] text-slate-300 line-clamp-1 mb-2.5">{{ $gal->caption }}</p>
                            @endif

                            <div class="flex items-center justify-between pt-2 border-t border-white/15">
                                <!-- Toggle Slider Button -->
                                <form action="{{ route('admin.galleries.toggle-slider', $gal->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-2.5 py-1 rounded-lg text-[11px] font-bold flex items-center gap-1.5 transition {{ $gal->is_slider ? 'bg-amber-400 text-slate-950 hover:bg-amber-300' : 'bg-slate-900/80 text-amber-300 border border-white/20 hover:bg-slate-900 hover:text-amber-200' }}" title="{{ $gal->is_slider ? 'Hapus dari Slider Beranda Utama' : 'Jadikan Slider Beranda Utama' }}">
                                        <i data-lucide="star" class="w-3.5 h-3.5 {{ $gal->is_slider ? 'fill-slate-950' : '' }}"></i>
                                        <span>{{ $gal->is_slider ? 'Slider Aktif' : '+ Set Slider' }}</span>
                                    </button>
                                </form>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.galleries.destroy', $gal->id) }}" method="POST" onsubmit="confirmDelete(event, 'Apakah Anda yakin ingin menghapus foto galeri ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg bg-rose-600/90 text-white hover:bg-rose-700 transition shadow-xs" title="Hapus Foto">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-400">
                        <i data-lucide="image-off" class="w-10 h-10 mx-auto mb-2 text-slate-300"></i>
                        <p class="text-xs font-semibold text-slate-600">Belum ada foto galeri.</p>
                        @if(request('filter') === 'slider')
                            <p class="text-[11px] text-slate-400 mt-1">Belum ada foto yang ditandai sebagai Slider Beranda Utama. Klik tombol "+ Set Slider" pada foto untuk menampilkannya di banner depan.</p>
                        @endif
                    </div>
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
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 sticky top-24">
            <h3 class="font-display font-bold text-lg text-slate-900 mb-4 inline-flex items-center gap-2">
                <i data-lucide="upload-cloud" class="w-5 h-5 text-emerald-700"></i>
                <span>Unggah Foto Baru</span>
            </h3>

            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Judul Foto *</label>
                    <input type="text" name="title" required placeholder="Contoh: Body Rafting Green Canyon" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Kategori *</label>
                    <select name="category" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 outline-none">
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
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Keterangan / Caption Slider</label>
                    <textarea name="caption" rows="2" placeholder="Catatan lokasi atau deskripsi singkat..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none"></textarea>
                </div>

                <!-- Checkbox Option for Hero Slider -->
                <div class="p-3.5 rounded-2xl bg-amber-50/90 border border-amber-200">
                    <label class="flex items-start gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_slider" value="1" class="mt-0.5 w-4 h-4 text-emerald-600 rounded focus:ring-emerald-500 border-amber-300">
                        <div>
                            <span class="text-xs font-bold text-amber-950 block">Tampilkan di Slider Beranda Utama</span>
                            <span class="text-[11px] text-amber-800 leading-snug block mt-0.5">Foto akan langsung digunakan sebagai banner slider cinematis pada halaman depan website.</span>
                        </div>
                    </label>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center justify-center gap-2">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    <span>Unggah ke Galeri</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
