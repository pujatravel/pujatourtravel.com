@extends('admin.layouts.app')

@section('title', 'Pengaturan Website & Kontak')
@section('page-title', 'Pengaturan Profil Brand & Informasi Kontak')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="font-display font-bold text-lg text-slate-900 border-b border-slate-100 pb-3">Informasi Brand & Kontak Resmi</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Perusahaan / Brand</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}" placeholder="Contoh: PUJA TOUR & TRAVEL PANGANDARAN" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor WhatsApp CS (Tanpa +/Spasi)</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" placeholder="Contoh: 6281234567890" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor Telepon Hotline</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $settings['phone_number'] ?? '') }}" placeholder="Contoh: +62 812-3456-7890" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Alamat Email Resmi</label>
                    <input type="email" name="email_address" value="{{ old('email_address', $settings['email_address'] ?? '') }}" placeholder="Contoh: info@pujatourtravel.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Alamat Kantor Fisik di Pangandaran</label>
                <textarea name="office_address" rows="2" placeholder="Contoh: Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('office_address', $settings['office_address'] ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jam Operasional Pelayanan</label>
                <input type="text" name="operational_hours" value="{{ old('operational_hours', $settings['operational_hours'] ?? '') }}" placeholder="Contoh: Setiap Hari: 06.00 - 21.00 WIB" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
            </div>

            <!-- Google Maps Embed Section -->
            <div class="pt-6 border-t border-slate-100 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-display font-bold text-lg text-slate-900">Peta Lokasi Kantor (Google Maps)</h3>
                        <p class="text-xs text-slate-500">Tempelkan link Sematkan Peta (Embed Map) atau kode &lt;iframe&gt; dari Google Maps.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                        <span>Dinamis</span>
                    </span>
                </div>

                <div class="p-4 rounded-2xl bg-amber-50/80 border border-amber-200/80 text-amber-900 text-xs space-y-1">
                    <p class="font-bold flex items-center gap-1.5">
                        <i data-lucide="info" class="w-4 h-4 text-amber-600 shrink-0"></i>
                        <span>Cara Mendapatkan Link Sematan Google Maps:</span>
                    </p>
                    <ol class="list-decimal list-inside pl-1 space-y-0.5 text-[11px] text-amber-800 leading-relaxed">
                        <li>Buka Google Maps, lalu cari titik lokasi kantor / destinasi Anda.</li>
                        <li>Klik tombol <strong>Bagikan (Share)</strong> ➔ Pilih tab <strong>Sematkan Peta (Embed a map)</strong>.</li>
                        <li>Klik <strong>Salin HTML (Copy HTML)</strong>, lalu langsung tempelkan (paste) pada kotak input di bawah.</li>
                    </ol>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Link Embed Google Maps / Kode &lt;iframe&gt;</label>
                    <textarea id="maps-input" name="google_maps_embed_url" rows="3" placeholder="Contoh: https://www.google.com/maps/embed?pb=... atau tempel <iframe src='...'></iframe>" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs font-mono bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('google_maps_embed_url', $settings['google_maps_embed_url'] ?? '') }}</textarea>
                </div>

                <!-- Live Interactive Preview -->
                @php
                    $currentMapUrl = old('google_maps_embed_url', $settings['google_maps_embed_url'] ?? '');
                @endphp
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold text-slate-500 uppercase">Pratinjau Langsung Peta:</label>
                        <span id="map-status-label" class="text-[11px] {{ $currentMapUrl ? 'text-emerald-700 font-semibold' : 'text-slate-400' }}">
                            {{ $currentMapUrl ? 'Peta khusus aktif' : 'Belum diisi (Menggunakan default di web publik)' }}
                        </span>
                    </div>
                    <div class="w-full h-64 sm:h-72 rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 shadow-inner relative flex items-center justify-center">
                        <iframe id="maps-preview"
                                src="{{ $currentMapUrl ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.739775073105!2d108.6477546!3d-7.6974127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6598c19958348b%3A0x6b45f949c256ca61!2sPantai%20Pangandaran!5e0!3m2!1sid!2sid!4v1709800000000!5m2!1sid!2sid' }}"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="w-full h-full">
                        </iframe>
                    </div>
                </div>
            </div>

            <h3 class="font-display font-bold text-lg text-slate-900 border-t border-b border-slate-100 py-3 mt-8">Tautan Media Sosial Resmi</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" placeholder="https://www.instagram.com/puja_tourtravel/" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">TikTok URL</label>
                    <input type="url" name="tiktok_url" value="{{ old('tiktok_url', $settings['tiktok_url'] ?? '') }}" placeholder="https://tiktok.com/@pujatourtravel" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>
            </div>

            <!-- Hero Banner Content Customization Section -->
            <h3 class="font-display font-bold text-lg text-slate-900 border-t border-b border-slate-100 py-3 mt-8 flex items-center justify-between">
                <span>Konten Banner Utama (Hero Section)</span>
                <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">Dinamis Landing Page</span>
            </h3>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Badge Teks Atas (Header Tagline)</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge'] ?? 'Partner Resmi Wisata & Petualangan Pangandaran') }}" placeholder="Contoh: Partner Resmi Wisata & Petualangan Pangandaran" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Judul Utama Hero Banner (H1)</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Jelajahi Pesona Bahari & Petualangan Pangandaran Tak Terlupakan') }}" placeholder="Contoh: Jelajahi Pesona Bahari & Petualangan Pangandaran Tak Terlupakan" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Kata Highlight (Warna Hijau)</label>
                        <input type="text" name="hero_title_highlight" value="{{ old('hero_title_highlight', $settings['hero_title_highlight'] ?? 'Pangandaran') }}" placeholder="Contoh: Pangandaran" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Deskripsi / Subjudul Hero Banner</label>
                    <textarea name="hero_subtitle" rows="3" placeholder="Contoh: Nikmati sensasi seru Body Rafting Green Canyon..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Nikmati sensasi seru Body Rafting Green Canyon, panorama eksotis Pasir Putih, dan pesona bahari terbaik bersama pemandu lokal profesional tersertifikasi HPI. Liburan aman, nyaman, dan berkesan.') }}</textarea>
                </div>

                <div class="pt-2">
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Angka Benchmark / Keunggulan (3 Kolom Stats Counter)</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Statistik #1</span>
                            <input type="text" name="hero_stat_1_val" value="{{ old('hero_stat_1_val', $settings['hero_stat_1_val'] ?? '5.000+') }}" placeholder="Val: 5.000+" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                            <input type="text" name="hero_stat_1_lbl" value="{{ old('hero_stat_1_lbl', $settings['hero_stat_1_lbl'] ?? 'Wisatawan Puas') }}" placeholder="Label: Wisatawan Puas" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Statistik #2</span>
                            <input type="text" name="hero_stat_2_val" value="{{ old('hero_stat_2_val', $settings['hero_stat_2_val'] ?? '100%') }}" placeholder="Val: 100%" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                            <input type="text" name="hero_stat_2_lbl" value="{{ old('hero_stat_2_lbl', $settings['hero_stat_2_lbl'] ?? 'Pemandu Berlisensi') }}" placeholder="Label: Pemandu Berlisensi" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Statistik #3</span>
                            <input type="text" name="hero_stat_3_val" value="{{ old('hero_stat_3_val', $settings['hero_stat_3_val'] ?? '4.9/5') }}" placeholder="Val: 4.9/5" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs font-bold bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                            <input type="text" name="hero_stat_3_lbl" value="{{ old('hero_stat_3_lbl', $settings['hero_stat_3_lbl'] ?? 'Ulasan Google') }}" placeholder="Label: Ulasan Google" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs bg-white outline-none focus:ring-2 focus:ring-emerald-600">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end">
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition">
                    Simpan Perubahan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mapsInput = document.getElementById('maps-input');
        const mapsPreview = document.getElementById('maps-preview');
        const statusLabel = document.getElementById('map-status-label');
        const defaultMap = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.739775073105!2d108.6477546!3d-7.6974127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6598c19958348b%3A0x6b45f949c256ca61!2sPantai%20Pangandaran!5e0!3m2!1sid!2sid!4v1709800000000!5m2!1sid!2sid';

        function updateMapPreview() {
            if (!mapsInput || !mapsPreview) return;
            let val = mapsInput.value.trim();

            if (!val) {
                mapsPreview.src = defaultMap;
                if (statusLabel) {
                    statusLabel.textContent = 'Kosong (Menggunakan peta default Pangandaran)';
                    statusLabel.className = 'text-[11px] text-slate-400';
                }
                return;
            }

            // If user pasted <iframe>, extract src
            const match = val.match(/src=["']([^"']+)["']/);
            if (match && match[1]) {
                val = match[1];
            }

            if (val.startsWith('http://') || val.startsWith('https://')) {
                mapsPreview.src = val;
                if (statusLabel) {
                    statusLabel.textContent = 'Peta khusus aktif';
                    statusLabel.className = 'text-[11px] text-emerald-700 font-semibold';
                }
            }
        }

        if (mapsInput) {
            mapsInput.addEventListener('input', updateMapPreview);
            mapsInput.addEventListener('paste', () => setTimeout(updateMapPreview, 100));
        }
    });
</script>
@endsection
