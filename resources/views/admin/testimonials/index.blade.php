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
                        <form action="{{ route('admin.testimonials.destroy', $testi->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?');">
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

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Asal Kota</label>
                    <input type="text" name="customer_city" placeholder="Contoh: Bandung" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Paket yang Diambil</label>
                    <input type="text" name="package_name" placeholder="Contoh: Green Canyon Full Track" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
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
@endsection
