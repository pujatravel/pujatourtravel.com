@extends('admin.layouts.app')

@section('title', 'Manajemen Banner Hero')
@section('page-title', 'Manajemen Banner Hero Beranda')

@section('content')
<div class="space-y-8">
    <!-- Top Summary Banner -->
    <div class="bg-slate-900 bg-gradient-to-r from-slate-900 via-slate-800 to-emerald-950 rounded-3xl p-6 sm:p-8 text-white shadow-md border border-slate-700/50 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-xs font-semibold">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-400"></i>
                <span>Pengaturan Banner Utama Public Website</span>
            </div>
            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-white tracking-tight">Kelola Konten & Slide Banner Beranda</h2>
            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                Atur teks tagline, judul H1, kata highlight, deskripsi singkat, 3 statistik utama, serta gambar slide cinematic beranda dalam satu panel terpadu.
            </p>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('home') }}" target="_blank" class="px-5 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                <i data-lucide="external-link" class="w-4 h-4"></i>
                <span>Lihat Hasil di Beranda</span>
            </a>
        </div>
    </div>

    <!-- Section 1: Edit Teks & Benchmark Stats Banner -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h3 class="font-display font-bold text-lg text-slate-900">1. Teks & Statistik Banner Hero</h3>
                <p class="text-xs text-slate-500">Sesuaikan badge promo, judul utama, highlight kata, deskripsi, dan 3 angka benchmark.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                Tersimpan di Database
            </span>
        </div>

        <form action="{{ route('admin.banners.update-text') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Badge Teks Atas (Header Tagline)</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge'] ?? 'Partner Resmi Wisata & Petualangan Pangandaran') }}" placeholder="Contoh: Partner Resmi Wisata & Petualangan Pangandaran" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                    @error('hero_badge') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Judul Utama Banner (H1)</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Jelajahi Pesona Bahari & Petualangan Pangandaran Tak Terlupakan') }}" placeholder="Contoh: Jelajahi Pesona Bahari & Petualangan Pangandaran..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none" required>
                        @error('hero_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Kata Highlight (Warna Hijau)</label>
                        <input type="text" name="hero_title_highlight" value="{{ old('hero_title_highlight', $settings['hero_title_highlight'] ?? 'Pangandaran') }}" placeholder="Contoh: Pangandaran" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                        @error('hero_title_highlight') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Deskripsi / Subjudul Hero Banner</label>
                    <textarea name="hero_subtitle" rows="3" placeholder="Contoh: Nikmati sensasi seru Body Rafting Green Canyon..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Nikmati sensasi seru Body Rafting Green Canyon, panorama eksotis Pasir Putih, dan pesona bahari terbaik bersama pemandu lokal profesional tersertifikasi HPI. Liburan aman, nyaman, dan berkesan.') }}</textarea>
                    @error('hero_subtitle') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wider">Keunggulan & Angka Benchmark (3 Stats Block)</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Statistik #1</span>
                            <input type="text" name="hero_stat_1_val" value="{{ old('hero_stat_1_val', $settings['hero_stat_1_val'] ?? '5.000+') }}" placeholder="Val: 5.000+" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                            <input type="text" name="hero_stat_1_lbl" value="{{ old('hero_stat_1_lbl', $settings['hero_stat_1_lbl'] ?? 'Wisatawan Puas') }}" placeholder="Label: Wisatawan Puas" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Statistik #2</span>
                            <input type="text" name="hero_stat_2_val" value="{{ old('hero_stat_2_val', $settings['hero_stat_2_val'] ?? '100%') }}" placeholder="Val: 100%" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                            <input type="text" name="hero_stat_2_lbl" value="{{ old('hero_stat_2_lbl', $settings['hero_stat_2_lbl'] ?? 'Pemandu Berlisensi') }}" placeholder="Label: Pemandu Berlisensi" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Statistik #3</span>
                            <input type="text" name="hero_stat_3_val" value="{{ old('hero_stat_3_val', $settings['hero_stat_3_val'] ?? '4.9/5') }}" placeholder="Val: 4.9/5" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                            <input type="text" name="hero_stat_3_lbl" value="{{ old('hero_stat_3_lbl', $settings['hero_stat_3_lbl'] ?? 'Ulasan Google') }}" placeholder="Label: Ulasan Google" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
                <button type="submit" class="px-7 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan Perubahan Teks Banner</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Section 2: Upload Gambar Slide Banner Baru & Tambah dari Galeri -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Upload Form -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-5">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="font-display font-bold text-lg text-slate-900">2. Unggah Gambar Slide Banner Baru</h3>
                <p class="text-xs text-slate-500">Tambahkan gambar slider resolusi tinggi untuk latar belakang Hero Banner.</p>
            </div>

            <form action="{{ route('admin.banners.store-slider') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Judul Slide / Destinasi</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Green Canyon Cukang Taneuh" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none" required>
                        @error('title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Tagline / Lokasi Subtitle</label>
                        <input type="text" name="caption" value="{{ old('caption') }}" placeholder="Contoh: Ngarai Stalaktit Air Zamrud • Body Rafting" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                        @error('caption') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">File Foto Landscape (JPG, PNG, WEBP max 5MB)</label>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none" required>
                    @error('image') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2 flex items-center justify-end">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                        <i data-lucide="upload-cloud" class="w-4 h-4 text-emerald-400"></i>
                        <span>Unggah Slide Banner</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Add From Existing Gallery -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-5 flex flex-col justify-between">
            <div>
                <div class="border-b border-slate-100 pb-3 mb-4">
                    <h3 class="font-display font-bold text-base text-slate-900">Pilih Dari Galeri Terpublikasi</h3>
                    <p class="text-xs text-slate-500">Jadikan foto galeri yang sudah ada sebagai slide banner.</p>
                </div>

                @if($allGalleries->count() > 0)
                    <form action="{{ route('admin.banners.add-from-gallery') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Pilih Foto Galeri</label>
                            <select name="gallery_id" class="w-full px-3.5 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 outline-none">
                                @foreach($allGalleries as $gal)
                                    <option value="{{ $gal->id }}">{{ $gal->title }} ({{ $gal->category }})</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="w-full py-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold text-xs border border-emerald-200 transition flex items-center justify-center gap-2">
                            <i data-lucide="plus-circle" class="w-4 h-4"></i>
                            <span>Tambahkan ke Slider Banner</span>
                        </button>
                    </form>
                @else
                    <div class="p-4 rounded-2xl bg-slate-50 text-center text-slate-500 text-xs">
                        Tidak ada foto galeri non-slider lainnya yang tersedia.
                    </div>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-100 text-[11px] text-slate-400">
                <i data-lucide="info" class="w-3.5 h-3.5 inline mr-1 text-slate-400"></i>
                Gambar slider diputar secara otomatis di beranda utama setiap 5 detik.
            </div>
        </div>
    </div>

    <!-- Section 3: List of Active Hero Banner Slides -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h3 class="font-display font-bold text-lg text-slate-900">3. Daftar Gambar Slide Banner Beranda ({{ $heroSliders->count() }})</h3>
                <p class="text-xs text-slate-500">Kelola status aktif/nonaktif dan urutan slide latar beranda.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                Total: {{ $heroSliders->count() }} Slide
            </span>
        </div>

        @if($heroSliders->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($heroSliders as $slide)
                    <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-white shadow-2xs group flex flex-col justify-between">
                        <div>
                            <!-- Slide Image Preview -->
                            <div class="relative h-44 w-full bg-slate-900 overflow-hidden">
                                <img src="{{ asset($slide->image_url ?? $slide->image_path) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-900/80 text-white backdrop-blur-xs border border-white/20">
                                        #{{ $loop->iteration }} Slide
                                    </span>
                                </div>
                                <div class="absolute bottom-3 left-3 right-3 text-white">
                                    <h4 class="font-display font-bold text-sm truncate">{{ $slide->title }}</h4>
                                    <p class="text-[11px] text-slate-300 truncate">{{ $slide->caption ?? 'Destinasi Wisata' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action Controls -->
                        <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-2">
                            <!-- Toggle Active Button -->
                            <form action="{{ route('admin.banners.toggle-slider', $slide->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 rounded-xl text-xs font-semibold transition flex items-center gap-1.5 {{ $slide->is_slider ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-200 text-slate-700 hover:bg-slate-300' }}">
                                    <i data-lucide="{{ $slide->is_slider ? 'check-circle' : 'circle' }}" class="w-3.5 h-3.5"></i>
                                    <span>{{ $slide->is_slider ? 'Aktif di Banner' : 'Non-aktif' }}</span>
                                </button>
                            </form>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.banners.destroy-slider', $slide->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slide banner ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus Slide">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center mx-auto">
                    <i data-lucide="image" class="w-6 h-6"></i>
                </div>
                <h4 class="font-display font-bold text-base text-slate-800">Belum Ada Slide Banner Khusus</h4>
                <p class="text-xs text-slate-500 max-w-md mx-auto">
                    Unggah gambar slide baru di atas atau aktifkan dari Galeri Foto agar latar belakang Hero Banner beranda tampil memukau.
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
