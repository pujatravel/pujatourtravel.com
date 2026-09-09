@extends('admin.layouts.app')

@section('title', 'Ulasan Testimoni')
@section('page-title', 'Manajemen Ulasan & Kepuasan Pelanggan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left: Testimonials List -->
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
            <h3 class="font-display font-bold text-lg text-slate-900 mb-5">Daftar Testimoni Wisatawan</h3>
            <div class="space-y-4">
                @forelse($testimonials as $testi)
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row items-start justify-between gap-4">
                        <div class="space-y-2 flex-1">
                            <div class="flex items-center gap-2">
                                <span class="font-display font-bold text-slate-900 text-sm">{{ $testi->customer_name }}</span>
                                <span class="text-xs text-slate-400">({{ $testi->customer_city ?? 'Wisatawan' }})</span>
                                <div class="flex items-center gap-0.5 text-amber-500">
                                    @for($i = 0; $i < $testi->rating; $i++)
                                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-500 text-amber-500"></i>
                                    @endfor
                                </div>
                            </div>
                            <span class="text-[11px] font-semibold text-emerald-700 block">{{ $testi->package_name ?? 'Paket Wisata Pangandaran' }}</span>
                            <p class="text-xs text-slate-600 italic leading-relaxed">
                                "{{ $testi->review_text }}"
                            </p>
                        </div>
                        <form action="{{ route('admin.testimonials.destroy', $testi->id) }}" method="POST" onsubmit="confirmDelete(event, 'Apakah Anda yakin ingin menghapus testimoni dari {{ addslashes($testi->customer_name) }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-400 hover:text-rose-600 hover:border-rose-200 text-xs font-bold transition shadow-2xs" title="Hapus Testimoni">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-center py-10 text-slate-400">Belum ada testimoni.</p>
                @endforelse
            </div>

            @if($testimonials->hasPages())
                <div class="pt-6 border-t border-slate-100 mt-6">
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Right: Add Testimonial Form -->
    <div class="lg:col-span-4">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
            <h3 class="font-display font-bold text-lg text-slate-900 mb-4 inline-flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5 text-emerald-700"></i>
                <span>Tambah Testimoni</span>
            </h3>
            <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Wisatawan *</label>
                    <input type="text" name="customer_name" required placeholder="Contoh: Rian & Keluarga" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <!-- Asal Kota Field with Searchable Dropdown & Ketik Manual Toggle -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Asal Kota / Kabupaten</label>
                        <button type="button" id="btn-toggle-city-mode" class="text-[11px] font-bold text-emerald-700 hover:text-emerald-800 transition flex items-center gap-1">
                            <i data-lucide="edit-3" class="w-3 h-3"></i>
                            <span id="text-toggle-city-mode">Ketik Manual</span>
                        </button>
                    </div>

                    <!-- Mode 1: Searchable Dropdown Select -->
                    <div id="wrapper-city-select">
                        <select id="customer_city_select" name="customer_city" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">
                            <option value="">-- Pilih atau Cari Asal Kota / Kabupaten --</option>
                            <optgroup label="Jawa Barat & Priangan East">
                                <option value="Bandung">Bandung</option>
                                <option value="Kab. Bandung">Kab. Bandung</option>
                                <option value="Bandung Barat">Bandung Barat</option>
                                <option value="Cimahi">Cimahi</option>
                                <option value="Pangandaran">Pangandaran</option>
                                <option value="Ciamis">Ciamis</option>
                                <option value="Tasikmalaya">Tasikmalaya</option>
                                <option value="Kab. Tasikmalaya">Kab. Tasikmalaya</option>
                                <option value="Banjar">Banjar</option>
                                <option value="Garut">Garut</option>
                                <option value="Bogor">Bogor</option>
                                <option value="Kab. Bogor">Kab. Bogor</option>
                                <option value="Depok">Depok</option>
                                <option value="Bekasi">Bekasi</option>
                                <option value="Kab. Bekasi">Kab. Bekasi</option>
                                <option value="Cirebon">Cirebon</option>
                                <option value="Kab. Cirebon">Kab. Cirebon</option>
                                <option value="Kuningan">Kuningan</option>
                                <option value="Majalengka">Majalengka</option>
                                <option value="Indramayu">Indramayu</option>
                                <option value="Sukabumi">Sukabumi</option>
                                <option value="Kab. Sukabumi">Kab. Sukabumi</option>
                                <option value="Cianjur">Cianjur</option>
                                <option value="Subang">Subang</option>
                                <option value="Purwakarta">Purwakarta</option>
                                <option value="Karawang">Karawang</option>
                            </optgroup>
                            <optgroup label="DKI Jakarta & Banten">
                                <option value="Jakarta Pusat">Jakarta Pusat</option>
                                <option value="Jakarta Selatan">Jakarta Selatan</option>
                                <option value="Jakarta Barat">Jakarta Barat</option>
                                <option value="Jakarta Timur">Jakarta Timur</option>
                                <option value="Jakarta Utara">Jakarta Utara</option>
                                <option value="Tangerang">Tangerang</option>
                                <option value="Tangerang Selatan">Tangerang Selatan</option>
                                <option value="Kab. Tangerang">Kab. Tangerang</option>
                                <option value="Serang">Serang</option>
                                <option value="Kab. Serang">Kab. Serang</option>
                                <option value="Cilegon">Cilegon</option>
                                <option value="Pandeglang">Pandeglang</option>
                                <option value="Lebak">Lebak</option>
                            </optgroup>
                            <optgroup label="Jawa Tengah & DI Yogyakarta">
                                <option value="Yogyakarta">Yogyakarta</option>
                                <option value="Sleman">Sleman</option>
                                <option value="Bantul">Bantul</option>
                                <option value="Gunungkidul">Gunungkidul</option>
                                <option value="Kulon Progo">Kulon Progo</option>
                                <option value="Semarang">Semarang</option>
                                <option value="Kab. Semarang">Kab. Semarang</option>
                                <option value="Solo (Surakarta)">Solo (Surakarta)</option>
                                <option value="Magelang">Magelang</option>
                                <option value="Salatiga">Salatiga</option>
                                <option value="Purwokerto (Banyumas)">Purwokerto (Banyumas)</option>
                                <option value="Cilacap">Cilacap</option>
                                <option value="Tegal">Tegal</option>
                                <option value="Pekalongan">Pekalongan</option>
                                <option value="Brebes">Brebes</option>
                                <option value="Kudus">Kudus</option>
                                <option value="Jepara">Jepara</option>
                                <option value="Pati">Pati</option>
                                <option value="Klaten">Klaten</option>
                                <option value="Boyolali">Boyolali</option>
                                <option value="Sukoharjo">Sukoharjo</option>
                                <option value="Wonogiri">Wonogiri</option>
                                <option value="Sragen">Sragen</option>
                                <option value="Karanganyar">Karanganyar</option>
                                <option value="Kebumen">Kebumen</option>
                                <option value="Purworejo">Purworejo</option>
                                <option value="Wonosobo">Wonosobo</option>
                            </optgroup>
                            <optgroup label="Jawa Timur">
                                <option value="Surabaya">Surabaya</option>
                                <option value="Malang">Malang</option>
                                <option value="Kab. Malang">Kab. Malang</option>
                                <option value="Batu">Batu</option>
                                <option value="Sidoarjo">Sidoarjo</option>
                                <option value="Gresik">Gresik</option>
                                <option value="Pasuruan">Pasuruan</option>
                                <option value="Probolinggo">Probolinggo</option>
                                <option value="Kediri">Kediri</option>
                                <option value="Madiun">Madiun</option>
                                <option value="Blitar">Blitar</option>
                                <option value="Mojokerto">Mojokerto</option>
                                <option value="Jember">Jember</option>
                                <option value="Banyuwangi">Banyuwangi</option>
                                <option value="Tuban">Tuban</option>
                                <option value="Lamongan">Lamongan</option>
                                <option value="Bojonegoro">Bojonegoro</option>
                                <option value="Jombang">Jombang</option>
                                <option value="Tulungagung">Tulungagung</option>
                            </optgroup>
                            <optgroup label="Sumatera">
                                <option value="Medan">Medan</option>
                                <option value="Banda Aceh">Banda Aceh</option>
                                <option value="Padang">Padang</option>
                                <option value="Pekanbaru">Pekanbaru</option>
                                <option value="Batam">Batam</option>
                                <option value="Jambi">Jambi</option>
                                <option value="Palembang">Palembang</option>
                                <option value="Bengkulu">Bengkulu</option>
                                <option value="Bandar Lampung">Bandar Lampung</option>
                                <option value="Pangkalpinang">Pangkalpinang</option>
                            </optgroup>
                            <optgroup label="Kalimantan">
                                <option value="Pontianak">Pontianak</option>
                                <option value="Palangkaraya">Palangkaraya</option>
                                <option value="Banjarmasin">Banjarmasin</option>
                                <option value="Balikpapan">Balikpapan</option>
                                <option value="Samarinda">Samarinda</option>
                                <option value="Bontang">Bontang</option>
                                <option value="Nusantara (IKN)">Nusantara (IKN)</option>
                            </optgroup>
                            <optgroup label="Sulawesi">
                                <option value="Makassar">Makassar</option>
                                <option value="Manado">Manado</option>
                                <option value="Palu">Palu</option>
                                <option value="Kendari">Kendari</option>
                                <option value="Gorontalo">Gorontalo</option>
                                <option value="Mamuju">Mamuju</option>
                            </optgroup>
                            <optgroup label="Bali & Nusa Tenggara">
                                <option value="Denpasar">Denpasar</option>
                                <option value="Badung">Badung</option>
                                <option value="Gianyar">Gianyar</option>
                                <option value="Mataram">Mataram</option>
                                <option value="Kupang">Kupang</option>
                            </optgroup>
                            <optgroup label="Maluku & Papua">
                                <option value="Ambon">Ambon</option>
                                <option value="Ternate">Ternate</option>
                                <option value="Jayapura">Jayapura</option>
                                <option value="Sorong">Sorong</option>
                                <option value="Timika">Timika</option>
                            </optgroup>
                            <option value="Lainnya / Luar Negeri">Lainnya / Luar Negeri</option>
                        </select>
                    </div>

                    <!-- Mode 2: Free Text Input (Hidden by default) -->
                    <div id="wrapper-city-input" class="hidden">
                        <input type="text" id="customer_city_input" placeholder="Tuliskan nama kota/kabupaten secara bebas..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Paket Wisata yang Diambil</label>
                    <select id="package_name_select" name="package_name" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                        <option value="">-- Pilih Paket Wisata --</option>
                        @foreach($packages as $pkg)
                            <option value="{{ $pkg->name }}">{{ $pkg->name }}</option>
                        @endforeach
                        <option value="Paket Custom / Rombongan">Paket Custom / Rombongan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Rating Bintang *</label>
                    <select name="rating" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                        <option value="5">5 Bintang (Sangat Puas)</option>
                        <option value="4">4 Bintang (Puas)</option>
                        <option value="3">3 Bintang (Cukup)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Ulasan Pengalaman *</label>
                    <textarea name="review_text" rows="3" required placeholder="Tuliskan pengalaman wisata..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition">
                    Simpan Testimoni
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var toggleBtn = document.getElementById('btn-toggle-city-mode');
    var toggleText = document.getElementById('text-toggle-city-mode');
    var selectWrapper = document.getElementById('wrapper-city-select');
    var inputWrapper = document.getElementById('wrapper-city-input');
    var selectEl = document.getElementById('customer_city_select');
    var inputEl = document.getElementById('customer_city_input');
    var isManual = false;

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            isManual = !isManual;
            if (isManual) {
                selectWrapper.classList.add('hidden');
                inputWrapper.classList.remove('hidden');
                selectEl.name = '';
                inputEl.name = 'customer_city';
                inputEl.focus();
                toggleText.textContent = 'Pilih dari Daftar';
            } else {
                inputWrapper.classList.add('hidden');
                selectWrapper.classList.remove('hidden');
                inputEl.name = '';
                selectEl.name = 'customer_city';
                toggleText.textContent = 'Ketik Manual';
            }
        });
    }

    if (typeof Choices !== 'undefined') {
        if (selectEl) {
            new Choices(selectEl, {
                searchEnabled: true,
                searchPlaceholderValue: '🔍 Ketik nama kota untuk mencari...',
                itemSelectText: '',
                shouldSort: false,
                allowHTML: true,
            });
        }

        var pkgSelect = document.getElementById('package_name_select');
        if (pkgSelect) {
            new Choices(pkgSelect, {
                searchEnabled: true,
                searchPlaceholderValue: '🔍 Ketik nama paket wisata...',
                itemSelectText: '',
                shouldSort: false,
                allowHTML: true,
            });
        }
    }
});
</script>
@endpush
@endsection
