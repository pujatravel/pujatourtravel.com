@extends('admin.layouts.app')

@section('title', 'Rincian Reservasi #' . $reservation->code)
@section('page-title', 'Rincian Reservasi #' . $reservation->code)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.reservations.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 transition inline-flex items-center gap-1.5">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
            <span>Kembali ke Daftar Reservasi</span>
        </a>
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-slate-400">Status Saat Ini:</span>
            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $reservation->status_badge }}">
                {{ $reservation->status }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Details -->
        <div class="md:col-span-2 space-y-6">
            <!-- Customer & Trip Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-5">
                <h3 class="font-display font-bold text-lg text-slate-900 border-b border-slate-100 pb-3">Informasi Pemesanan</h3>

                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-400 block mb-0.5">Nama Pemesan</span>
                        <strong class="text-slate-900 text-sm block">{{ $reservation->customer_name }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-0.5">Nomor WhatsApp</span>
                        <strong class="text-slate-900 text-sm block">{{ $reservation->customer_phone }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-0.5">Email</span>
                        <span class="text-slate-700 font-medium block">{{ $reservation->customer_email ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-0.5">Saluran Sumber</span>
                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-bold inline-block">{{ $reservation->source }}</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-400 block mb-0.5">Paket Wisata Pilihan</span>
                        <strong class="text-emerald-700 text-sm block">{{ $reservation->package_name }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-0.5">Tanggal Perjalanan</span>
                        <strong class="text-slate-900 text-sm block">{{ $reservation->travel_date ? $reservation->travel_date->format('d F Y') : 'Fleksibel' }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-0.5">Jumlah Peserta</span>
                        <strong class="text-slate-900 text-sm block">{{ $reservation->pax_count }} Orang (Pax)</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-0.5">Estimasi Total Biaya</span>
                        <strong class="text-emerald-700 font-display text-lg block">{{ $reservation->formatted_total }}</strong>
                    </div>
                </div>

                @if($reservation->notes)
                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-xs font-bold text-slate-700 block mb-1">Catatan Tambahan dari Pelanggan:</span>
                        <p class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-700 italic leading-relaxed">
                            "{{ $reservation->notes }}"
                        </p>
                    </div>
                @endif
            </div>

            @if(isset($relatedReservations) && $relatedReservations->isNotEmpty())
                <!-- Repeat Customer History Card -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-emerald-100 space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="p-2 rounded-xl bg-emerald-50 text-emerald-700">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                            </span>
                            <div>
                                <h3 class="font-display font-bold text-base text-slate-900">Riwayat Reservasi Pelanggan Ini</h3>
                                <p class="text-[11px] text-emerald-700 font-bold">Pelanggan Berulang (Repeat Customer) — {{ $relatedReservations->count() }} transaksi lain terdeteksi</p>
                            </div>
                        </div>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach($relatedReservations as $prevRes)
                            <div class="py-3 flex items-center justify-between gap-3 text-xs">
                                <div>
                                    <span class="font-bold text-slate-800">#{{ $prevRes->code }} — {{ $prevRes->package_name }}</span>
                                    <span class="text-slate-400 block text-[11px]">{{ $prevRes->travel_date ? $prevRes->travel_date->format('d M Y') : 'Fleksibel' }} • {{ $prevRes->pax_count }} Pax • {{ $prevRes->formatted_total }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $prevRes->status_badge }}">
                                        {{ $prevRes->status }}
                                    </span>
                                    <a href="{{ route('admin.reservations.show', $prevRes->id) }}" class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="Lihat Reservasi Ini">
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Admin Internal Notes -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80">
                <h3 class="font-display font-bold text-base text-slate-900 mb-3">Catatan Internal Staf Admin</h3>
                <form action="{{ route('admin.reservations.update-status', $reservation->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="{{ $reservation->status }}">
                    <textarea name="admin_notes" rows="3" placeholder="Tuliskan catatan internal di sini (misal: DP 30% diterima via BCA, guide ditugaskan: Kang Asep)..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">{{ old('admin_notes', $reservation->admin_notes) }}</textarea>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-emerald-700 transition">
                        Simpan Catatan Internal
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-6">
            <!-- Fast WhatsApp Contact -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
                <h3 class="font-display font-bold text-base text-slate-900">Aksi Komunikasi</h3>
                @php
                    $waMsg = urlencode("Halo {$reservation->customer_name}! Kami dari tim Puja Tour & Travel Pangandaran menindaklanjuti reservasi Anda (#{$reservation->code}) untuk paket {$reservation->package_name}. Apakah tanggal {$reservation->travel_date?->format('d/m/Y')} sudah sesuai?");
                    $phoneClean = preg_replace('/[^0-9]/', '', $reservation->customer_phone);
                @endphp
                <a href="https://wa.me/{{ $phoneClean }}?text={{ $waMsg }}" target="_blank" class="w-full py-3.5 px-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition flex items-center justify-center gap-2 shadow-sm">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Hubungi via WhatsApp</span>
                </a>
            </div>

            <!-- Update Status Box -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
                <h3 class="font-display font-bold text-base text-slate-900">Ubah Tahapan Status</h3>
                <form action="{{ route('admin.reservations.update-status', $reservation->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <div>
                        <select name="status" class="w-full px-3.5 py-3 rounded-xl border border-slate-200 text-xs font-bold bg-slate-50 focus:bg-white outline-none">
                            <option value="PENDING" {{ $reservation->status === 'PENDING' ? 'selected' : '' }}>PENDING (Menunggu)</option>
                            <option value="DIPROSES" {{ $reservation->status === 'DIPROSES' ? 'selected' : '' }}>DIPROSES (Follow Up)</option>
                            <option value="DIKONFIRMASI" {{ $reservation->status === 'DIKONFIRMASI' ? 'selected' : '' }}>DIKONFIRMASI (DP Masuk)</option>
                            <option value="SELESAI" {{ $reservation->status === 'SELESAI' ? 'selected' : '' }}>SELESAI (Trip Tuntas)</option>
                            <option value="DIBATALKAN" {{ $reservation->status === 'DIBATALKAN' ? 'selected' : '' }}>DIBATALKAN</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition">
                        Perbarui Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
