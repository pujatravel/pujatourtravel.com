@extends('admin.layouts.app')

@section('title', 'Edit Invoice ' . $invoice->invoice_number)
@section('page-title', 'Edit Invoice Wisata')

@section('content')
<div class="max-w-6xl mx-auto">
    <form action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST" id="invoice-form" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Top Header & Actions -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-surface-soft p-5 rounded-3xl border border-neutral-200 shadow-soft">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="p-2.5 rounded-xl bg-canvas text-slate-500 hover:text-slate-900 border border-neutral-200 transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </a>
                <div>
                    <h2 class="font-display font-extrabold text-lg text-slate-900">Edit Invoice {{ $invoice->invoice_number }}</h2>
                    <p class="text-xs text-slate-400">Perbarui rincian transaksi atau status pembayaran</p>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="flex-1 sm:flex-none px-4 py-2.5 rounded-xl border border-neutral-200 text-slate-600 font-bold text-xs hover:bg-canvas text-center transition">
                    Batal
                </a>
                <button type="submit" class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Main Form (2 cols) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Section 1: Nomor & Tanggal -->
                <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4">
                    <div class="flex items-center justify-between border-b border-neutral-200 pb-3">
                        <h3 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-4 h-4 text-emerald-700"></i>
                            <span>Nomor & Tanggal Transaksi</span>
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">No. Invoice <span class="text-rose-500">*</span></label>
                            <input type="text" name="invoice_number" value="{{ old('invoice_number', $invoice->invoice_number) }}" required class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs font-mono font-bold bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                            @error('invoice_number') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Tanggal Terbit <span class="text-rose-500">*</span></label>
                            <input type="date" name="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date ? $invoice->invoice_date->format('Y-m-d') : '') }}" required class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                            @error('invoice_date') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jatuh Tempo (Due Date)</label>
                            <input type="date" name="due_date" value="{{ old('due_date', $invoice->due_date ? $invoice->due_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                            @error('due_date') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Data Pelanggan & Trip -->
                <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4">
                    <h3 class="font-display font-bold text-base text-slate-900 border-b border-neutral-200 pb-3 flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4 text-emerald-700"></i>
                        <span>Informasi Pelanggan & Trip Wisata</span>
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Pemesan / Instansi <span class="text-rose-500">*</span></label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', $invoice->customer_name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                            @error('customer_name') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor WhatsApp / HP <span class="text-rose-500">*</span></label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone', $invoice->customer_phone) }}" required class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                            @error('customer_phone') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Email Pelanggan (Opsional)</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email', $invoice->customer_email) }}" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Kota Asal / Alamat</label>
                            <input type="text" name="customer_address" value="{{ old('customer_address', $invoice->customer_address) }}" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                        </div>
                    </div>

                    <!-- Package Selector & Booking Details -->
                    <div class="p-4 rounded-2xl bg-canvas border border-neutral-200 space-y-4 mt-2">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Katalog Paket Terkait</label>
                                <select id="package-selector" name="package_id" class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                                    <option value="">-- Kustom / Non-Katalog --</option>
                                    @foreach($packages as $pkg)
                                        <option value="{{ $pkg->id }}" 
                                                data-name="{{ $pkg->name }}" 
                                                data-price="{{ $pkg->price }}" 
                                                data-unit="{{ $pkg->price_unit }}"
                                                data-desc="{{ $pkg->short_description }}"
                                                {{ (old('package_id', $invoice->package_id) == $pkg->id) ? 'selected' : '' }}>
                                            {{ $pkg->name }} — Rp {{ number_format($pkg->price, 0, ',', '.') }} / {{ $pkg->price_unit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Paket di Invoice</label>
                                <input type="text" id="package-name-input" name="package_name" value="{{ old('package_name', $invoice->package_name) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Tanggal Trip / Wisata</label>
                                <input type="date" name="travel_date" value="{{ old('travel_date', $invoice->travel_date ? $invoice->travel_date->format('Y-m-d') : '') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jumlah Peserta (Pax) <span class="text-rose-500">*</span></label>
                                <div class="flex items-center gap-2">
                                    <input type="number" id="pax-count-input" name="pax_count" value="{{ old('pax_count', $invoice->pax_count) }}" min="1" required class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs font-bold bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                                    <span class="text-xs font-bold text-slate-500 px-3 py-2.5 bg-neutral-100 rounded-xl">Orang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Line Items Repeater -->
                <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4">
                    <div class="flex items-center justify-between border-b border-neutral-200 pb-3">
                        <div class="space-y-0.5">
                            <h3 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                                <i data-lucide="layers" class="w-4 h-4 text-emerald-700"></i>
                                <span>Rincian Item / Layanan Wisata</span>
                            </h3>
                            <p class="text-xs text-slate-400">Kelola baris item yang tercantum dalam tagihan</p>
                        </div>

                        <button type="button" id="add-item-btn" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-800 hover:bg-emerald-100 font-bold text-xs border border-emerald-200 transition">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Tambah Baris</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs min-w-[600px]" id="items-table">
                            <thead>
                                <tr class="bg-canvas text-slate-500 font-bold uppercase tracking-wider border-b border-neutral-200">
                                    <th class="p-3 w-[40%]">Nama Layanan & Deskripsi</th>
                                    <th class="p-3 w-[15%]">Qty (Jumlah)</th>
                                    <th class="p-3 w-[15%]">Satuan</th>
                                    <th class="p-3 w-[18%]">Harga Satuan (Rp)</th>
                                    <th class="p-3 w-[12%] text-right">Subtotal</th>
                                    <th class="p-3 w-10 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 text-slate-700" id="items-tbody">
                                @foreach($invoice->items as $index => $item)
                                    <tr class="item-row">
                                        <td class="p-3">
                                            <input type="text" name="items[{{ $index }}][item_name]" value="{{ old('items.'.$index.'.item_name', $item->item_name) }}" placeholder="Nama layanan / paket" required class="item-name w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-semibold bg-canvas focus:bg-white outline-none">
                                            <input type="text" name="items[{{ $index }}][description]" value="{{ old('items.'.$index.'.description', $item->description) }}" placeholder="Keterangan tambahan (opsional)" class="w-full px-3 py-1.5 rounded-lg border border-neutral-200 text-[11px] bg-canvas focus:bg-white outline-none mt-1 text-slate-500">
                                        </td>
                                        <td class="p-3">
                                            <input type="number" step="any" name="items[{{ $index }}][quantity]" value="{{ old('items.'.$index.'.quantity', (float)$item->quantity) }}" min="0.01" required class="item-qty w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white outline-none">
                                        </td>
                                        <td class="p-3">
                                            <input type="text" name="items[{{ $index }}][unit]" value="{{ old('items.'.$index.'.unit', $item->unit) }}" placeholder="pax / unit" required class="item-unit w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs bg-canvas focus:bg-white outline-none">
                                        </td>
                                        <td class="p-3">
                                            <input type="number" step="any" name="items[{{ $index }}][price]" value="{{ old('items.'.$index.'.price', (float)$item->price) }}" min="0" required class="item-price w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white outline-none">
                                        </td>
                                        <td class="p-3 text-right">
                                            <span class="item-subtotal-text font-bold text-slate-900 text-xs block">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="p-3 text-center">
                                            <button type="button" class="remove-row-btn p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="Hapus baris">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section 4: Catatan & Terms -->
                <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4">
                    <h3 class="font-display font-bold text-base text-slate-900 border-b border-neutral-200 pb-3 flex items-center gap-2">
                        <i data-lucide="info" class="w-4 h-4 text-emerald-700"></i>
                        <span>Ketentuan Pembayaran & Catatan</span>
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Catatan / Ketentuan untuk Pelanggan (Tercetak di Invoice)</label>
                            <textarea name="notes" rows="3" class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none leading-relaxed">{{ old('notes', $invoice->notes) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Catatan Internal Admin (Rahasia, Tidak Tercetak)</label>
                            <input type="text" name="admin_notes" value="{{ old('admin_notes', $invoice->admin_notes) }}" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Financial Calculations & Payment (1 col) -->
            <div class="space-y-6">
                <!-- Calculation Summary Card -->
                <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-5 sticky top-20">
                    <h3 class="font-display font-bold text-base text-slate-900 border-b border-neutral-200 pb-3 flex items-center justify-between">
                        <span>Ringkasan Keuangan</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    </h3>

                    <div class="space-y-3.5 text-xs">
                        <!-- Subtotal -->
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Subtotal Layanan</span>
                            <span id="display-subtotal" class="font-bold text-slate-900 text-sm">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                        </div>

                        <!-- Diskon -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Potongan Diskon (Rp)</span>
                                <input type="number" step="any" id="discount-input" name="discount" value="{{ old('discount', (float)$invoice->discount) }}" min="0" class="w-32 px-3 py-1.5 text-right font-bold text-rose-600 rounded-lg border border-neutral-200 bg-canvas focus:bg-white outline-none">
                            </div>
                        </div>

                        <!-- PPN / Tax -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Pajak / PPN (%)</span>
                                <div class="flex items-center gap-1">
                                    <input type="number" step="any" id="tax-input" name="tax_percent" value="{{ old('tax_percent', (float)$invoice->tax_percent) }}" min="0" max="100" class="w-20 px-2 py-1.5 text-right font-bold rounded-lg border border-neutral-200 bg-canvas focus:bg-white outline-none">
                                    <span class="text-xs font-bold text-slate-400">%</span>
                                </div>
                            </div>
                            <div class="flex justify-end text-[11px] text-slate-400">
                                <span>Pajak: <strong id="display-tax-amount" class="text-slate-700">Rp {{ number_format($invoice->tax_amount, 0, ',', '.') }}</strong></span>
                            </div>
                        </div>

                        <div class="border-t border-dashed border-neutral-300 pt-3"></div>

                        <!-- Grand Total -->
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200">
                            <div>
                                <span class="text-[10px] font-bold uppercase text-emerald-800 tracking-wider block">Total Tagihan</span>
                                <span class="text-[11px] text-emerald-800">Grand Total</span>
                            </div>
                            <span id="display-grand-total" class="font-display font-extrabold text-lg text-emerald-800">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
                        </div>

                        <!-- Uang Muka / Terbayar -->
                        <div class="space-y-1.5 pt-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase">Jumlah Terbayar / DP (Rp)</label>
                            <input type="number" step="any" id="paid-input" name="paid_amount" value="{{ old('paid_amount', (float)$invoice->paid_amount) }}" min="0" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-sm font-bold text-emerald-700 bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                            <div class="flex items-center gap-1.5 pt-1">
                                <button type="button" id="btn-dp-30" class="px-2 py-1 text-[10px] font-bold rounded-md bg-neutral-100 hover:bg-neutral-200 text-slate-600 transition">DP 30%</button>
                                <button type="button" id="btn-dp-50" class="px-2 py-1 text-[10px] font-bold rounded-md bg-neutral-100 hover:bg-neutral-200 text-slate-600 transition">DP 50%</button>
                                <button type="button" id="btn-pay-full" class="px-2 py-1 text-[10px] font-bold rounded-md bg-emerald-100 hover:bg-emerald-200 text-emerald-800 transition">Lunas 100%</button>
                            </div>
                        </div>

                        <!-- Sisa Pelunasan -->
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-canvas border border-neutral-200">
                            <div>
                                <span class="text-[10px] font-bold uppercase text-slate-500 tracking-wider block">Sisa Pelunasan</span>
                                <span class="text-[11px] text-slate-400">Piutang Klien</span>
                            </div>
                            <span id="display-remaining" class="font-display font-extrabold text-base text-rose-600">Rp {{ number_format($invoice->remaining_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Payment Status & Account Info -->
                    <div class="pt-4 border-t border-neutral-200 space-y-4 text-xs">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Status Pembayaran <span class="text-rose-500">*</span></label>
                            <select id="status-select" name="status" required class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                                <option value="UNPAID" {{ old('status', $invoice->status) === 'UNPAID' ? 'selected' : '' }}>🔴 Belum Bayar (Unpaid)</option>
                                <option value="PARTIAL" {{ old('status', $invoice->status) === 'PARTIAL' ? 'selected' : '' }}>🟡 Uang Muka / DP (Partial)</option>
                                <option value="PAID" {{ old('status', $invoice->status) === 'PAID' ? 'selected' : '' }}>🟢 Lunas (Paid)</option>
                                <option value="CANCELLED" {{ old('status', $invoice->status) === 'CANCELLED' ? 'selected' : '' }}>⚪ Dibatalkan (Cancelled)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Metode Pembayaran</label>
                            <input type="text" name="payment_method" value="{{ old('payment_method', $invoice->payment_method) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Rincian Rekening Bank (Tercetak di Invoice)</label>
                            <textarea name="bank_details" rows="4" class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-[11px] font-mono bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none leading-relaxed">{{ old('bank_details', $invoice->bank_details) }}</textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-xs shadow-lg transition flex items-center justify-center gap-2">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Pembaruan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let rowIndex = {{ $invoice->items->count() }};
    const tbody = document.getElementById('items-tbody');
    const addItemBtn = document.getElementById('add-item-btn');
    const packageSelector = document.getElementById('package-selector');
    const packageNameInput = document.getElementById('package-name-input');
    const paxCountInput = document.getElementById('pax-count-input');

    const discountInput = document.getElementById('discount-input');
    const taxInput = document.getElementById('tax-input');
    const paidInput = document.getElementById('paid-input');
    const statusSelect = document.getElementById('status-select');

    const displaySubtotal = document.getElementById('display-subtotal');
    const displayTaxAmount = document.getElementById('display-tax-amount');
    const displayGrandTotal = document.getElementById('display-grand-total');
    const displayRemaining = document.getElementById('display-remaining');

    const btnDp30 = document.getElementById('btn-dp-30');
    const btnDp50 = document.getElementById('btn-dp-50');
    const btnPayFull = document.getElementById('btn-pay-full');

    function formatRupiah(num) {
        return 'Rp ' + Math.round(num).toLocaleString('id-ID');
    }

    function calculateTotals() {
        let subtotal = 0;
        const rows = tbody.querySelectorAll('.item-row');

        rows.forEach(row => {
            const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
            const price = parseFloat(row.querySelector('.item-price').value) || 0;
            const rowSubtotal = qty * price;
            subtotal += rowSubtotal;

            const textSpan = row.querySelector('.item-subtotal-text');
            if (textSpan) {
                textSpan.textContent = formatRupiah(rowSubtotal);
            }
        });

        const discount = parseFloat(discountInput.value) || 0;
        const afterDiscount = Math.max(0, subtotal - discount);

        const taxPercent = parseFloat(taxInput.value) || 0;
        const taxAmount = (afterDiscount * taxPercent) / 100;

        const grandTotal = Math.round(afterDiscount + taxAmount);
        let paid = parseFloat(paidInput.value) || 0;

        if (paid > grandTotal && grandTotal > 0) {
            paid = grandTotal;
            paidInput.value = paid;
        }

        const remaining = Math.max(0, grandTotal - paid);

        displaySubtotal.textContent = formatRupiah(subtotal);
        displayTaxAmount.textContent = formatRupiah(taxAmount);
        displayGrandTotal.textContent = formatRupiah(grandTotal);
        displayRemaining.textContent = formatRupiah(remaining);

        if (statusSelect.value !== 'CANCELLED') {
            if (paid >= grandTotal && grandTotal > 0) {
                statusSelect.value = 'PAID';
            } else if (paid > 0) {
                statusSelect.value = 'PARTIAL';
            } else {
                statusSelect.value = 'UNPAID';
            }
        }

        return { subtotal, grandTotal, remaining };
    }

    function addNewRow(itemName = '', desc = '', qty = 1, unit = 'pax', price = 0) {
        const tr = document.createElement('tr');
        tr.className = 'item-row';
        tr.innerHTML = `
            <td class="p-3">
                <input type="text" name="items[${rowIndex}][item_name]" value="${itemName}" placeholder="Nama layanan / paket" required class="item-name w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-semibold bg-canvas focus:bg-white outline-none">
                <input type="text" name="items[${rowIndex}][description]" value="${desc}" placeholder="Keterangan tambahan (opsional)" class="w-full px-3 py-1.5 rounded-lg border border-neutral-200 text-[11px] bg-canvas focus:bg-white outline-none mt-1 text-slate-500">
            </td>
            <td class="p-3">
                <input type="number" step="any" name="items[${rowIndex}][quantity]" value="${qty}" min="0.01" required class="item-qty w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white outline-none">
            </td>
            <td class="p-3">
                <input type="text" name="items[${rowIndex}][unit]" value="${unit}" placeholder="pax / unit" required class="item-unit w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs bg-canvas focus:bg-white outline-none">
            </td>
            <td class="p-3">
                <input type="number" step="any" name="items[${rowIndex}][price]" value="${price}" min="0" required class="item-price w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white outline-none">
            </td>
            <td class="p-3 text-right">
                <span class="item-subtotal-text font-bold text-slate-900 text-xs block">Rp 0</span>
            </td>
            <td class="p-3 text-center">
                <button type="button" class="remove-row-btn p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="Hapus baris">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
        rowIndex++;
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons();
        }
        calculateTotals();
    }

    if (addItemBtn) {
        addItemBtn.addEventListener('click', function() {
            addNewRow();
        });
    }

    tbody.addEventListener('input', function(e) {
        if (e.target.classList.contains('item-qty') || e.target.classList.contains('item-price')) {
            calculateTotals();
        }
    });

    tbody.addEventListener('click', function(e) {
        const removeBtn = e.target.closest('.remove-row-btn');
        if (removeBtn) {
            const rows = tbody.querySelectorAll('.item-row');
            if (rows.length > 1) {
                removeBtn.closest('.item-row').remove();
                calculateTotals();
            } else {
                alert('Invoice minimal harus memiliki 1 item layanan!');
            }
        }
    });

    if (packageSelector) {
        packageSelector.addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            if (!opt.value) return;

            const name = opt.dataset.name || '';
            const price = parseFloat(opt.dataset.price) || 0;
            const unit = opt.dataset.unit || 'pax';
            const pax = parseInt(paxCountInput.value) || 1;

            if (packageNameInput) {
                packageNameInput.value = name;
            }
        });
    }

    [discountInput, taxInput, paidInput].forEach(inp => {
        if (inp) {
            inp.addEventListener('input', calculateTotals);
        }
    });

    if (btnDp30) {
        btnDp30.addEventListener('click', function() {
            const { grandTotal } = calculateTotals();
            const dp = Math.round(grandTotal * 0.3);
            paidInput.value = dp;
            calculateTotals();
        });
    }

    if (btnDp50) {
        btnDp50.addEventListener('click', function() {
            const { grandTotal } = calculateTotals();
            const dp = Math.round(grandTotal * 0.5);
            paidInput.value = dp;
            calculateTotals();
        });
    }

    if (btnPayFull) {
        btnPayFull.addEventListener('click', function() {
            const { grandTotal } = calculateTotals();
            paidInput.value = grandTotal;
            calculateTotals();
        });
    }
});
</script>
@endpush
@endsection
