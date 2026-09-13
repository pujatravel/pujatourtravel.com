@extends('admin.layouts.app')

@section('title', 'Detail Invoice ' . $invoice->invoice_number)
@section('page-title', 'Invoice #' . $invoice->invoice_number)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Action Toolbar -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 bg-surface-soft p-5 rounded-3xl border border-neutral-200 shadow-soft">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.invoices.index') }}" class="p-2.5 rounded-xl bg-canvas text-slate-500 hover:text-slate-900 border border-neutral-200 transition" title="Kembali ke Daftar">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <span class="font-display font-extrabold text-lg text-slate-900">{{ $invoice->invoice_number }}</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold border {{ $invoice->status_badge_class }}">
                        {{ $invoice->status_label }}
                    </span>
                </div>
                <p class="text-xs text-slate-400">Dibuat pada {{ $invoice->created_at ? $invoice->created_at->translatedFormat('d F Y, H:i') : '-' }}</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Print / PDF -->
            <a href="{{ route('admin.invoices.print', $invoice->id) }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                <i data-lucide="printer" class="w-4 h-4"></i>
                <span>Cetak / PDF</span>
            </a>

            <!-- WhatsApp Share -->
            <a href="{{ $invoice->whatsapp_share_url }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center gap-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Kirim WhatsApp</span>
            </a>

            <!-- Copy Link -->
            <button type="button" onclick="copyInvoiceLink('{{ route('invoice.public', $invoice->invoice_number) }}')" class="px-3.5 py-2.5 rounded-xl border border-neutral-200 bg-white hover:bg-canvas text-slate-700 font-bold text-xs transition flex items-center gap-1.5" title="Salin link invoice publik untuk pelanggan">
                <i data-lucide="copy" class="w-4 h-4"></i>
                <span>Salin Link</span>
            </button>

            <!-- Edit -->
            <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="px-3.5 py-2.5 rounded-xl border border-neutral-200 bg-white hover:bg-canvas text-slate-700 font-bold text-xs transition flex items-center gap-1.5">
                <i data-lucide="pencil" class="w-4 h-4"></i>
                <span>Edit</span>
            </a>

            <!-- Quick Status Modal Trigger -->
            <button type="button" onclick="toggleStatusModal()" class="px-3.5 py-2.5 rounded-xl border border-emerald-300 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold text-xs transition flex items-center gap-1.5">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                <span>Ubah Status</span>
            </button>
        </div>
    </div>

    <!-- Official Invoice Document Sheet -->
    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-neutral-200 shadow-xl space-y-8 relative overflow-hidden" id="printable-invoice">
        <!-- Watermark / Stamp Badge for PAID / UNPAID -->
        <div class="absolute right-6 top-6 sm:right-12 sm:top-10 opacity-90 pointer-events-none rotate-[-12deg] z-10">
            @if($invoice->status === 'PAID')
                <div class="border-4 border-emerald-600 text-emerald-600 font-display font-black text-xl sm:text-2xl tracking-widest px-5 py-2 rounded-2xl uppercase shadow-xs">
                    LUNAS (PAID)
                </div>
            @elseif($invoice->status === 'PARTIAL')
                <div class="border-4 border-amber-600 text-amber-600 font-display font-black text-xl sm:text-2xl tracking-widest px-5 py-2 rounded-2xl uppercase shadow-xs">
                    DP (UANG MUKA)
                </div>
            @elseif($invoice->status === 'CANCELLED')
                <div class="border-4 border-slate-400 text-slate-400 font-display font-black text-xl sm:text-2xl tracking-widest px-5 py-2 rounded-2xl uppercase shadow-xs">
                    DIBATALKAN
                </div>
            @else
                <div class="border-4 border-rose-600 text-rose-600 font-display font-black text-xl sm:text-2xl tracking-widest px-5 py-2 rounded-2xl uppercase shadow-xs">
                    BELUM LUNAS
                </div>
            @endif
        </div>

        <!-- Document Header: Company Info & Invoice Title -->
        <div class="flex flex-col sm:flex-row justify-between items-start gap-6 border-b border-neutral-200 pb-8">
            <div class="flex items-start gap-4">
                <div class="w-16 h-16 shrink-0 flex items-center justify-center p-1 rounded-2xl bg-neutral-50 border border-neutral-200">
                    <img src="{{ asset('images/puja_logo.png') }}" alt="Puja Tour Logo" class="w-full h-full object-contain">
                </div>
                <div class="space-y-1 max-w-md">
                    <h1 class="font-display font-extrabold text-xl text-slate-900 leading-tight">
                        {{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN' }}
                    </h1>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        {{ $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat' }}
                    </p>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-slate-600 font-medium pt-1">
                        <span class="inline-flex items-center gap-1">
                            <i data-lucide="phone" class="w-3.5 h-3.5 text-emerald-700"></i>
                            <span>{{ $settings['phone_number'] ?? '+62 812-3456-7890' }}</span>
                        </span>
                        <span>•</span>
                        <span class="inline-flex items-center gap-1">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-emerald-700"></i>
                            <span>{{ $settings['email_address'] ?? 'info@pujatourtravel.com' }}</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-left sm:text-right space-y-1.5 sm:min-w-[200px]">
                <span class="text-[11px] font-extrabold tracking-widest uppercase text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200 inline-block">
                    INVOICE RESMI
                </span>
                <h2 class="font-display font-extrabold text-2xl text-slate-900 font-mono">{{ $invoice->invoice_number }}</h2>
                <div class="text-xs text-slate-500 space-y-0.5">
                    <p>Tgl Terbit: <strong class="text-slate-800">{{ $invoice->invoice_date ? $invoice->invoice_date->translatedFormat('d F Y') : '-' }}</strong></p>
                    @if($invoice->due_date)
                        <p>Jatuh Tempo: <strong class="text-rose-600">{{ $invoice->due_date->translatedFormat('d F Y') }}</strong></p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer & Trip Details Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-neutral-50 p-6 rounded-2xl border border-neutral-200 text-xs">
            <!-- Customer Block -->
            <div class="space-y-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Ditujukan Kepada (Customer):</span>
                <h3 class="font-display font-bold text-base text-slate-900">{{ $invoice->customer_name }}</h3>
                <div class="space-y-1 text-slate-600">
                    <p class="flex items-center gap-1.5 font-medium">
                        <i data-lucide="phone" class="w-3.5 h-3.5 text-emerald-700"></i>
                        <span>{{ $invoice->customer_phone }}</span>
                    </p>
                    @if($invoice->customer_email)
                        <p class="flex items-center gap-1.5 font-medium">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span>{{ $invoice->customer_email }}</span>
                        </p>
                    @endif
                    @if($invoice->customer_address)
                        <p class="flex items-center gap-1.5 font-medium">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span>{{ $invoice->customer_address }}</span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Booking / Trip Details Block -->
            <div class="space-y-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Detail Keberangkatan & Reservasi:</span>
                <div class="space-y-1.5 text-slate-700">
                    @if($invoice->package_name || $invoice->package)
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Paket Wisata:</span>
                            <span class="font-bold text-slate-900">{{ $invoice->package_name ?? $invoice->package->name }}</span>
                        </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Tanggal Trip / Wisata:</span>
                        <span class="font-bold text-slate-900">{{ $invoice->travel_date ? $invoice->travel_date->translatedFormat('d F Y') : 'Fleksibel / Sesuai Kesepakatan' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Jumlah Peserta:</span>
                        <span class="font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-lg border border-emerald-200">{{ $invoice->pax_count }} Orang</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Metode Pembayaran:</span>
                        <span class="font-semibold text-slate-800">{{ $invoice->payment_method ?? 'Transfer Bank / QRIS' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Line Items Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b-2 border-neutral-300 text-slate-600 font-bold uppercase tracking-wider">
                        <th class="py-3 px-2 w-12 text-center">No</th>
                        <th class="py-3 px-4">Deskripsi Layanan & Fasilitas</th>
                        <th class="py-3 px-3 text-center">Jumlah (Qty)</th>
                        <th class="py-3 px-4 text-right">Harga Satuan</th>
                        <th class="py-3 px-4 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 text-slate-700">
                    @foreach($invoice->items as $index => $item)
                        <tr>
                            <td class="py-4 px-2 text-center font-bold text-slate-400">{{ $index + 1 }}</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-slate-900 text-sm block">{{ $item->item_name }}</span>
                                @if($item->description)
                                    <span class="text-slate-500 text-[11px] block mt-0.5 leading-relaxed">{{ $item->description }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-3 text-center font-semibold text-slate-800 whitespace-nowrap">
                                {{ $item->formatted_qty }} {{ $item->unit }}
                            </td>
                            <td class="py-4 px-4 text-right font-medium whitespace-nowrap">
                                {{ $item->formatted_price }}
                            </td>
                            <td class="py-4 px-4 text-right font-bold text-slate-900 whitespace-nowrap">
                                {{ $item->formatted_subtotal }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Financial Summary Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-neutral-200">
            <!-- Payment Instructions & Bank Details -->
            <div class="space-y-3 text-xs">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Informasi Pembayaran & Rekening Resmi:</span>
                @if($invoice->bank_details)
                    <div class="p-4 rounded-2xl bg-slate-50 border border-neutral-200 font-mono text-xs text-slate-700 whitespace-pre-line leading-relaxed">
                        {{ $invoice->bank_details }}
                    </div>
                @else
                    <div class="p-4 rounded-2xl bg-slate-50 border border-neutral-200 text-xs text-slate-500">
                        Silakan hubungi WhatsApp kami untuk informasi pembayaran resmi.
                    </div>
                @endif

                @if($invoice->notes)
                    <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200 text-amber-900 text-xs space-y-1">
                        <span class="font-bold block uppercase text-[10px] text-amber-700">Syarat & Ketentuan:</span>
                        <p class="whitespace-pre-line leading-relaxed text-[11px]">{{ $invoice->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Totals Box -->
            <div class="space-y-3 text-xs">
                <div class="p-5 rounded-2xl bg-neutral-50 border border-neutral-200 space-y-2.5">
                    <div class="flex items-center justify-between text-slate-600">
                        <span>Subtotal Layanan:</span>
                        <span class="font-bold text-slate-800 text-sm">{{ $invoice->formatted_subtotal }}</span>
                    </div>

                    @if($invoice->discount > 0)
                        <div class="flex items-center justify-between text-rose-600">
                            <span>Potongan Diskon:</span>
                            <span class="font-bold">- {{ $invoice->formatted_discount }}</span>
                        </div>
                    @endif

                    @if($invoice->tax_amount > 0)
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Pajak / PPN ({{ (float)$invoice->tax_percent }}%):</span>
                            <span class="font-semibold text-slate-800">{{ $invoice->formatted_tax }}</span>
                        </div>
                    @endif

                    <div class="border-t border-neutral-300 pt-2.5"></div>

                    <div class="flex items-center justify-between font-display font-extrabold text-base text-slate-900">
                        <span>Total Tagihan:</span>
                        <span class="text-xl text-emerald-800">{{ $invoice->formatted_total }}</span>
                    </div>

                    <div class="flex items-center justify-between text-emerald-800 font-semibold pt-1">
                        <span>Jumlah Terbayar (DP):</span>
                        <span>{{ $invoice->formatted_paid }}</span>
                    </div>

                    <div class="flex items-center justify-between font-bold text-sm text-rose-600 border-t border-dashed border-neutral-200 pt-2">
                        <span>Sisa Pelunasan:</span>
                        <span class="text-base">{{ $invoice->formatted_remaining }}</span>
                    </div>
                </div>

                <!-- Authorized Signature Box -->
                <div class="pt-4 flex justify-end">
                    <div class="text-center space-y-12 min-w-[200px]">
                        <span class="text-xs text-slate-500 block">Hormat Kami,</span>
                        <div class="space-y-0.5 border-t border-slate-300 pt-2">
                            <span class="font-bold text-slate-900 text-xs block">Puja Tour & Travel</span>
                            <span class="text-[10px] text-slate-400 block">Finance & Reservation Dept.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($invoice->admin_notes)
            <div class="p-3.5 rounded-xl bg-slate-100 border border-slate-200 text-slate-600 text-xs flex items-center gap-2">
                <i data-lucide="lock" class="w-4 h-4 text-slate-400 shrink-0"></i>
                <span><strong>Catatan Internal Admin:</strong> {{ $invoice->admin_notes }}</span>
            </div>
        @endif
    </div>
</div>

<!-- Quick Status Modal -->
<div id="status-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs transition-all duration-300 opacity-0 pointer-events-none">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-neutral-200 transform scale-95 transition-all duration-300 space-y-5 text-left">
        <div class="flex items-center justify-between border-b border-neutral-200 pb-3">
            <h3 class="font-display font-bold text-lg text-slate-900">Ubah Status Pembayaran</h3>
            <button type="button" onclick="toggleStatusModal()" class="p-2 text-slate-400 hover:text-slate-700 rounded-xl">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('admin.invoices.update-status', $invoice->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Status Pembayaran</label>
                <select name="status" id="quick-status-select" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white outline-none">
                    <option value="PAID" {{ $invoice->status === 'PAID' ? 'selected' : '' }}>🟢 Lunas (PAID)</option>
                    <option value="PARTIAL" {{ $invoice->status === 'PARTIAL' ? 'selected' : '' }}>🟡 Uang Muka / DP (PARTIAL)</option>
                    <option value="UNPAID" {{ $invoice->status === 'UNPAID' ? 'selected' : '' }}>🔴 Belum Bayar (UNPAID)</option>
                    <option value="CANCELLED" {{ $invoice->status === 'CANCELLED' ? 'selected' : '' }}>⚪ Dibatalkan (CANCELLED)</option>
                </select>
            </div>

            <div id="quick-paid-group">
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nominal Terbayar (Rp)</label>
                <input type="number" step="any" name="paid_amount" value="{{ (float)$invoice->paid_amount }}" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white outline-none">
                <span class="text-[11px] text-slate-400 block mt-1">Total tagihan invoice: {{ $invoice->formatted_total }}</span>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-neutral-200">
                <button type="button" onclick="toggleStatusModal()" class="px-4 py-2.5 rounded-xl border border-neutral-200 text-slate-700 font-bold text-xs hover:bg-canvas transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function toggleStatusModal() {
    const modal = document.getElementById('status-modal');
    if (!modal) return;
    const isHidden = modal.classList.contains('pointer-events-none');
    if (isHidden) {
        modal.classList.remove('pointer-events-none', 'opacity-0');
        modal.classList.add('opacity-100');
    } else {
        modal.classList.remove('opacity-100');
        modal.classList.add('pointer-events-none', 'opacity-0');
    }
}

function copyInvoiceLink(url) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            showToast('Link invoice berhasil disalin ke clipboard!');
        });
    } else {
        const temp = document.createElement('input');
        temp.value = url;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand('copy');
        document.body.removeChild(temp);
        showToast('Link invoice berhasil disalin ke clipboard!');
    }
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-5 right-5 z-50 px-5 py-3 rounded-2xl bg-slate-900 text-white font-bold text-xs shadow-2xl flex items-center gap-2 transition-all transform duration-300';
    toast.innerHTML = `<i data-lucide="check" class="w-4 h-4 text-emerald-400"></i> <span>${message}</span>`;
    document.body.appendChild(toast);
    if (window.lucide && window.lucide.createIcons) {
        window.lucide.createIcons();
    }
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>
@endpush
@endsection
