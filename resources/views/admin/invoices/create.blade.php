@extends('admin.layouts.app')

@section('title', 'Buat Invoice Baru')
@section('page-title', 'Generate Invoice Wisata Baru')

@section('content')
    <div class="max-w-6xl mx-auto">
        <form action="{{ route('admin.invoices.store') }}" method="POST" id="invoice-form" class="space-y-6">
            @csrf

            <!-- Top Header & Actions -->
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-surface-soft p-5 rounded-3xl border border-neutral-200 shadow-soft">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.invoices.index') }}"
                        class="p-2.5 rounded-xl bg-canvas text-slate-500 hover:text-slate-900 border border-neutral-200 transition">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    </a>
                    <div>
                        <h2 class="font-display font-extrabold text-lg text-slate-900">Formulir Pembuatan Invoice</h2>
                        <p class="text-xs text-slate-400">Generate rincian tagihan wisata resmi Puja Tour & Travel</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('admin.invoices.index') }}"
                        class="flex-1 sm:flex-none px-4 py-2.5 rounded-xl border border-neutral-200 text-slate-600 font-bold text-xs hover:bg-canvas text-center transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        <span>Simpan & Terbitkan</span>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column: Main Form (2 cols) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Section 1: Informasi Dasar & Nomor Invoice -->
                    <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4">
                        <div class="flex items-center justify-between border-b border-neutral-200 pb-3">
                            <h3 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                                <i data-lucide="file-text" class="w-4 h-4 text-emerald-700"></i>
                                <span>Nomor & Tanggal Transaksi</span>
                            </h3>
                            <span
                                class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200">
                                Auto Generate
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">No. Invoice <span
                                        class="text-rose-500">*</span></label>
                                <input type="text" name="invoice_number"
                                    value="{{ old('invoice_number', $nextInvoiceNumber) }}" required
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs font-mono font-bold bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                                @error('invoice_number')
                                <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Tanggal Terbit <span
                                        class="text-rose-500">*</span></label>
                                <input type="date" name="invoice_date" value="{{ old('invoice_date', date('Y-m-d')) }}"
                                    required
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                                @error('invoice_date')
                                <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jatuh Tempo (Due
                                    Date)</label>
                                <input type="date" name="due_date"
                                    value="{{ old('due_date', date('Y-m-d', strtotime('+3 days'))) }}"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                                @error('due_date')
                                <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Data Pelanggan & Trip -->
                    <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4">
                        <h3
                            class="font-display font-bold text-base text-slate-900 border-b border-neutral-200 pb-3 flex items-center gap-2">
                            <i data-lucide="user" class="w-4 h-4 text-emerald-700"></i>
                            <span>Informasi Pelanggan & Trip Wisata</span>
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Pemesan /
                                    Instansi <span class="text-rose-500">*</span></label>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                                    placeholder="Contoh: Bpk. Hendra Gunawan / PT Sumber Berkah" required
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                                @error('customer_name')
                                <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor WhatsApp / HP
                                    <span class="text-rose-500">*</span></label>
                                <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"
                                    placeholder="Contoh: 081234567890" required
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                                @error('customer_phone')
                                <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Email Pelanggan
                                    (Opsional)</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                    placeholder="Contoh: customer@email.com"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Kota Asal /
                                    Alamat</label>
                                <input type="text" name="customer_address" value="{{ old('customer_address') }}"
                                    placeholder="Contoh: Bandung / Jakarta Selatan"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Tanggal Trip /
                                    Wisata</label>
                                <input type="date" name="travel_date"
                                    value="{{ old('travel_date', date('Y-m-d', strtotime('+7 days'))) }}"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Rincian Layanan / Line Items -->
                    <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4">
                        <div class="flex items-center justify-between border-b border-neutral-200 pb-3">
                            <div class="space-y-0.5">
                                <h3 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                                    <i data-lucide="layers" class="w-4 h-4 text-emerald-700"></i>
                                    <span>Rincian Item / Layanan Wisata</span>
                                </h3>
                                <p class="text-xs text-slate-400">Tambahkan paket, akomodasi, transportasi, makanan, atau
                                    tiket</p>
                            </div>

                            <button type="button" id="add-item-btn"
                                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-50 text-emerald-800 hover:bg-emerald-100 font-bold text-xs border border-emerald-200 transition">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                                <span>Tambah Baris</span>
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs min-w-[600px]" id="items-table">
                                <thead>
                                    <tr
                                        class="bg-canvas text-slate-500 font-bold uppercase tracking-wider border-b border-neutral-200">
                                        <th class="p-3 w-[40%]">Nama Layanan & Deskripsi</th>
                                        <th class="p-3 w-[15%]">Qty (Jumlah)</th>
                                        <th class="p-3 w-[15%]">Satuan</th>
                                        <th class="p-3 w-[18%]">Harga Satuan (Rp)</th>
                                        <th class="p-3 w-[12%] text-right">Subtotal</th>
                                        <th class="p-3 w-10 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200 text-slate-700" id="items-tbody">
                                    <!-- Row template rendered by JS or default first row -->
                                    <tr class="item-row">
                                        <td class="p-3">
                                            {{-- Searchable package dropdown (portal: dropdown di-render ke body via JS)
                                            --}}
                                            <div class="pkg-search-wrapper">
                                                <input type="text"
                                                    class="pkg-search-input w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-semibold bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-600 outline-none"
                                                    placeholder="Cari & pilih paket wisata..." autocomplete="off">
                                                <input type="hidden" name="items[0][item_name]" class="pkg-hidden-name"
                                                    required>
                                            </div>
                                            <input type="text" name="items[0][description]"
                                                value="{{ old('items.0.description', '') }}"
                                                placeholder="Deskripsi otomatis dari paket" readonly
                                                class="item-desc w-full px-3 py-1.5 rounded-lg border border-neutral-200 text-[11px] bg-neutral-100 text-slate-500 cursor-not-allowed outline-none mt-1">
                                        </td>
                                        <td class="p-3">
                                            <input type="number" step="any" name="items[0][quantity]"
                                                value="{{ old('items.0.quantity', 1) }}" min="0.01" required
                                                class="item-qty w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white outline-none">
                                        </td>
                                        <td class="p-3">
                                            <input type="text" name="items[0][unit]"
                                                value="{{ old('items.0.unit', '') }}" readonly
                                                class="item-unit w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs bg-neutral-100 text-slate-600 cursor-not-allowed outline-none">
                                        </td>
                                        <td class="p-3">
                                            <input type="number" step="any" name="items[0][price]"
                                                value="{{ old('items.0.price', 0) }}" min="0" readonly required
                                                class="item-price w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-bold bg-neutral-100 text-slate-700 cursor-not-allowed outline-none">
                                        </td>
                                        <td class="p-3 text-right">
                                            <span class="item-subtotal-text font-bold text-slate-900 text-xs block">Rp
                                                0</span>
                                        </td>
                                        <td class="p-3 text-center">
                                            <button type="button"
                                                class="remove-row-btn p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                                title="Hapus baris">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Section 4: Catatan & Terms -->
                    <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4">
                        <h3
                            class="font-display font-bold text-base text-slate-900 border-b border-neutral-200 pb-3 flex items-center gap-2">
                            <i data-lucide="info" class="w-4 h-4 text-emerald-700"></i>
                            <span>Ketentuan Pembayaran & Catatan</span>
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Catatan / Ketentuan
                                    untuk Pelanggan (Tercetak di Invoice)</label>
                                <textarea name="notes" rows="3"
                                    class="w-full px-4 py-3 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none leading-relaxed">{{ old('notes', $defaultNotes) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Catatan Internal
                                    Admin (Rahasia, Tidak Tercetak)</label>
                                <input type="text" name="admin_notes" value="{{ old('admin_notes') }}"
                                    placeholder="Contoh: Booking via Kak Rian, guide Kang Asep sudah dihubungi."
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Financial Calculations & Payment (1 col) -->
                <div class="space-y-6">
                    <!-- Calculation Summary Card -->
                    <div
                        class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-5 sticky top-20">
                        <h3
                            class="font-display font-bold text-base text-slate-900 border-b border-neutral-200 pb-3 flex items-center justify-between">
                            <span>Ringkasan Keuangan</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        </h3>

                        <div class="space-y-3.5 text-xs">
                            <!-- Subtotal -->
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Subtotal Layanan</span>
                                <span id="display-subtotal" class="font-bold text-slate-900 text-sm">Rp 0</span>
                            </div>

                            <!-- Diskon -->
                            <div class="space-y-1">
                                <div class="flex items-center justify-between text-slate-600">
                                    <span>Potongan Diskon (Rp)</span>
                                    <input type="number" step="any" id="discount-input" name="discount"
                                        value="{{ old('discount', 0) }}" min="0"
                                        class="w-32 px-3 py-1.5 text-right font-bold text-rose-600 rounded-lg border border-neutral-200 bg-canvas focus:bg-white outline-none">
                                </div>
                            </div>

                            <!-- PPN / Tax -->
                            <div class="space-y-1">
                                <div class="flex items-center justify-between text-slate-600">
                                    <span>Pajak / PPN (%)</span>
                                    <div class="flex items-center gap-1">
                                        <input type="number" step="any" id="tax-input" name="tax_percent"
                                            value="{{ old('tax_percent', 0) }}" min="0" max="100"
                                            class="w-20 px-2 py-1.5 text-right font-bold rounded-lg border border-neutral-200 bg-canvas focus:bg-white outline-none">
                                        <span class="text-xs font-bold text-slate-400">%</span>
                                    </div>
                                </div>
                                <div class="flex justify-end text-[11px] text-slate-400">
                                    <span>Pajak: <strong id="display-tax-amount" class="text-slate-700">Rp 0</strong></span>
                                </div>
                            </div>

                            <div class="border-t border-dashed border-neutral-300 pt-3"></div>

                            <!-- Grand Total -->
                            <div
                                class="flex items-center justify-between p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200">
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase text-emerald-800 tracking-wider block">Total
                                        Tagihan</span>
                                    <span class="text-[11px] text-emerald-800">Grand Total</span>
                                </div>
                                <span id="display-grand-total"
                                    class="font-display font-extrabold text-lg text-emerald-800">Rp 0</span>
                            </div>

                            <!-- Uang Muka / Terbayar -->
                            <div class="space-y-1.5 pt-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase">Jumlah Terbayar / DP
                                    (Rp)</label>
                                <input type="number" step="any" id="paid-input" name="paid_amount"
                                    value="{{ old('paid_amount', 0) }}" min="0"
                                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-sm font-bold text-emerald-700 bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                                <div class="flex items-center gap-1.5 pt-1">
                                    <button type="button" id="btn-dp-30"
                                        class="quick-pay-btn px-2 py-1 text-[10px] font-bold rounded-md bg-neutral-100 hover:bg-neutral-200 text-slate-600 transition">DP
                                        30%</button>
                                    <button type="button" id="btn-dp-50"
                                        class="quick-pay-btn px-2 py-1 text-[10px] font-bold rounded-md bg-neutral-100 hover:bg-neutral-200 text-slate-600 transition">DP
                                        50%</button>
                                    <button type="button" id="btn-pay-full"
                                        class="quick-pay-btn px-2 py-1 text-[10px] font-bold rounded-md bg-neutral-100 hover:bg-neutral-200 text-slate-600 transition">Lunas
                                        100%</button>
                                </div>
                            </div>

                            <!-- Sisa Pelunasan -->
                            <div
                                class="flex items-center justify-between p-3.5 rounded-2xl bg-canvas border border-neutral-200">
                                <div>
                                    <span class="text-[10px] font-bold uppercase text-slate-500 tracking-wider block">Sisa
                                        Pelunasan</span>
                                    <span class="text-[11px] text-slate-400">Piutang Klien</span>
                                </div>
                                <span id="display-remaining" class="font-display font-extrabold text-base text-rose-600">Rp
                                    0</span>
                            </div>
                        </div>

                        <!-- Payment Status & Account Info -->
                        <div class="pt-4 border-t border-neutral-200 space-y-4 text-xs">
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-xs font-bold text-slate-700 uppercase">Status Pembayaran <span
                                            class="text-rose-500">*</span></label>
                                    <span class="text-[10px] text-slate-400 italic">Otomatis dari nominal bayar</span>
                                </div>
                                <select id="status-select" name="status" required tabindex="-1"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs font-bold bg-neutral-100 text-slate-700 pointer-events-none cursor-not-allowed outline-none appearance-none"
                                    style="appearance: none; -webkit-appearance: none; -moz-appearance: none;">
                                    <option value="UNPAID" {{ old('status') === 'UNPAID' ? 'selected' : '' }}>🔴 Belum Bayar
                                        (Unpaid)</option>
                                    <option value="PARTIAL" {{ old('status') === 'PARTIAL' ? 'selected' : '' }}>🟡 Uang Muka /
                                        DP (Partial)</option>
                                    <option value="PAID" {{ old('status') === 'PAID' ? 'selected' : '' }}>🟢 Lunas (Paid)
                                    </option>
                                    <option value="CANCELLED" {{ old('status') === 'CANCELLED' ? 'selected' : '' }}>⚪
                                        Dibatalkan (Cancelled)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Metode
                                    Pembayaran</label>
                                <input type="text" name="payment_method"
                                    value="{{ old('payment_method', 'Transfer Bank (BCA / Mandiri / BRI / QRIS)') }}"
                                    placeholder="Contoh: Transfer Bank BCA / QRIS"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Rincian Rekening Bank
                                    (Tercetak di Invoice)</label>
                                <textarea name="bank_details" rows="4"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-[11px] font-mono bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none leading-relaxed">{{ old('bank_details', $defaultBankDetails) }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-3.5 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-xs shadow-lg transition flex items-center justify-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4"></i>
                                <span>Generate & Buat Invoice</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Package data from server
            const packagesData = [
                @foreach($packages as $pkg)
                    {
                            id: "{{ $pkg->id }}",
                            name: @json($pkg->name),
                            price: {{ (float) $pkg->price }},
                            unit: @json($pkg->unit->name ?? $pkg->price_unit),
                            desc: @json($pkg->short_description ?? '')
                        },
                @endforeach
        ];

            document.addEventListener('DOMContentLoaded', function () {
                let rowIndex = 1;
                const tbody = document.getElementById('items-tbody');
                const addItemBtn = document.getElementById('add-item-btn');
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

                // -------------------------------------------------------
                // PORTAL DROPDOWN — dirender ke <body>, posisi fixed
                // -------------------------------------------------------
                const portalDropdown = document.createElement('div');
                portalDropdown.id = 'pkg-portal-dropdown';
                portalDropdown.style.cssText = 'position:fixed;z-index:9999;background:#fff;border:1px solid #e5e7eb;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,.12);max-height:220px;overflow-y:auto;display:none;min-width:260px;';
                portalDropdown.innerHTML = `
                <div class="pkg-portal-list"></div>
                <div class="pkg-portal-empty" style="display:none;padding:10px 12px;font-size:11px;color:#94a3b8;text-align:center">Tidak ada paket ditemukan</div>
            `;
                document.body.appendChild(portalDropdown);

                const portalList = portalDropdown.querySelector('.pkg-portal-list');
                const portalEmpty = portalDropdown.querySelector('.pkg-portal-empty');

                // Build semua option items sekali
                function buildPortalItems() {
                    portalList.innerHTML = packagesData.map(pkg => {
                        const safeName = pkg.name.replace(/"/g, '&quot;').replace(/</g, '&lt;');
                        const safeUnit = (pkg.unit || '').replace(/"/g, '&quot;');
                        const safeDesc = (pkg.desc || '').replace(/"/g, '&quot;').replace(/</g, '&lt;');
                        const unitLabel = pkg.unit ? ` / ${pkg.unit}` : '';
                        return `<div class="pkg-portal-option"
                                data-name="${safeName}"
                                data-price="${pkg.price}"
                                data-unit="${safeUnit}"
                                data-desc="${safeDesc}"
                                style="padding:8px 12px;cursor:pointer;font-size:11px;color:#374151;border-bottom:1px solid #f3f4f6">
                                <span style="font-weight:600;display:block">${pkg.name}</span>
                                <span style="color:#94a3b8">Rp ${Math.round(pkg.price).toLocaleString('id-ID')}${unitLabel}</span>
                            </div>`;
                    }).join('');
                }
                buildPortalItems();

                // Hover style via delegation
                portalDropdown.addEventListener('mouseover', e => {
                    const opt = e.target.closest('.pkg-portal-option');
                    if (opt) opt.style.background = '#f0fdf4';
                });
                portalDropdown.addEventListener('mouseout', e => {
                    const opt = e.target.closest('.pkg-portal-option');
                    if (opt) opt.style.background = '';
                });

                let activeSearchInput = null;
                let activeRow = null;

                function positionPortal(input) {
                    const rect = input.getBoundingClientRect();
                    portalDropdown.style.top = (rect.bottom + 4) + 'px';
                    portalDropdown.style.left = rect.left + 'px';
                    portalDropdown.style.width = rect.width + 'px';
                }

                function openPortal(input, tr) {
                    activeSearchInput = input;
                    activeRow = tr;
                    positionPortal(input);
                    portalDropdown.style.display = 'block';
                    filterPortal(input.value);
                }

                function closePortal() {
                    portalDropdown.style.display = 'none';
                    activeSearchInput = null;
                    activeRow = null;
                }

                function filterPortal(query) {
                    const q = query.trim().toLowerCase();
                    let hasResult = false;
                    portalList.querySelectorAll('.pkg-portal-option').forEach(opt => {
                        const match = !q || (opt.dataset.name || '').toLowerCase().includes(q);
                        opt.style.display = match ? '' : 'none';
                        if (match) hasResult = true;
                    });
                    portalEmpty.style.display = hasResult ? 'none' : 'block';
                }

                // Click on portal option — fill row
                portalDropdown.addEventListener('mousedown', function (e) {
                    const opt = e.target.closest('.pkg-portal-option');
                    if (!opt || !activeRow) return;
                    e.preventDefault(); // prevent blur before click fires

                    const name = opt.dataset.name || '';
                    const price = parseFloat(opt.dataset.price) || 0;
                    const unit = opt.dataset.unit || '';
                    const desc = opt.dataset.desc || '';

                    if (activeSearchInput) {
                        activeSearchInput.value = name;
                        const hidden = activeSearchInput.closest('.pkg-search-wrapper').querySelector('.pkg-hidden-name');
                        if (hidden) hidden.value = name;
                    }

                    const descInput = activeRow.querySelector('.item-desc');
                    const unitInput = activeRow.querySelector('.item-unit');
                    const priceInput = activeRow.querySelector('.item-price');
                    const qtyInput = activeRow.querySelector('.item-qty');

                    if (descInput) descInput.value = desc;
                    if (unitInput) unitInput.value = unit;
                    if (priceInput) priceInput.value = price;
                    if (qtyInput) {
                        if (!qtyInput.value || parseFloat(qtyInput.value) <= 0) {
                            qtyInput.value = 1;
                        }
                    }

                    closePortal();
                    calculateTotals();
                });

                // Close portal on outside click
                document.addEventListener('click', function (e) {
                    if (!portalDropdown.contains(e.target) && e.target !== activeSearchInput) {
                        closePortal();
                    }
                });

                // Reposition on scroll/resize
                window.addEventListener('scroll', () => { if (activeSearchInput) positionPortal(activeSearchInput); }, true);
                window.addEventListener('resize', () => { if (activeSearchInput) positionPortal(activeSearchInput); });

                // -------------------------------------------------------
                // Per-row: wire search input to portal
                // -------------------------------------------------------
                function initSearchDropdown(tr) {
                    const wrapper = tr.querySelector('.pkg-search-wrapper');
                    if (!wrapper) return;
                    const searchInput = wrapper.querySelector('.pkg-search-input');
                    const hiddenName = wrapper.querySelector('.pkg-hidden-name');

                    searchInput.addEventListener('focus', () => openPortal(searchInput, tr));
                    searchInput.addEventListener('input', function () {
                        hiddenName.value = ''; // clear selection saat mengetik
                        if (portalDropdown.style.display === 'none') openPortal(searchInput, tr);
                        else positionPortal(searchInput);
                        filterPortal(this.value);
                    });
                    searchInput.addEventListener('blur', () => {
                        // delay supaya mousedown pada option sempat dieksekusi
                        setTimeout(() => {
                            if (activeSearchInput === searchInput) closePortal();
                        }, 150);
                    });
                }

                function calculateTotals() {
                    let subtotal = 0;
                    tbody.querySelectorAll('.item-row').forEach(row => {
                        const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
                        const price = parseFloat(row.querySelector('.item-price').value) || 0;
                        const rowSub = qty * price;
                        subtotal += rowSub;
                        const span = row.querySelector('.item-subtotal-text');
                        if (span) span.textContent = formatRupiah(rowSub);
                    });

                    const discount = parseFloat(discountInput.value) || 0;
                    const afterDiscount = Math.max(0, subtotal - discount);
                    const taxPercent = parseFloat(taxInput.value) || 0;
                    const taxAmount = (afterDiscount * taxPercent) / 100;
                    const grandTotal = Math.round(afterDiscount + taxAmount);
                    let paid = parseFloat(paidInput.value) || 0;
                    if (paid > grandTotal && grandTotal > 0) { paid = grandTotal; paidInput.value = paid; }
                    const remaining = Math.max(0, grandTotal - paid);

                    displaySubtotal.textContent = formatRupiah(subtotal);
                    displayTaxAmount.textContent = formatRupiah(taxAmount);
                    displayGrandTotal.textContent = formatRupiah(grandTotal);
                    displayRemaining.textContent = formatRupiah(remaining);

                    if (statusSelect.value !== 'CANCELLED') {
                        if (paid >= grandTotal && grandTotal > 0) statusSelect.value = 'PAID';
                        else if (paid > 0) statusSelect.value = 'PARTIAL';
                        else statusSelect.value = 'UNPAID';
                    }

                    syncQuickPayButtons(paid, grandTotal);

                    return { subtotal, grandTotal, remaining };
                }

                function setBtnActive(btn, isActive) {
                    if (!btn) return;
                    if (isActive) {
                        btn.className = 'quick-pay-btn px-2 py-1 text-[10px] font-bold rounded-md bg-emerald-100 hover:bg-emerald-200 text-emerald-800 transition';
                    } else {
                        btn.className = 'quick-pay-btn px-2 py-1 text-[10px] font-bold rounded-md bg-neutral-100 hover:bg-neutral-200 text-slate-600 transition';
                    }
                }

                function syncQuickPayButtons(paid, grandTotal) {
                    const is30 = grandTotal > 0 && paid > 0 && Math.abs(paid - Math.round(grandTotal * 0.3)) < 1;
                    const is50 = grandTotal > 0 && paid > 0 && Math.abs(paid - Math.round(grandTotal * 0.5)) < 1;
                    const isFull = grandTotal > 0 && paid > 0 && Math.abs(paid - grandTotal) < 1;

                    setBtnActive(btnDp30, is30);
                    setBtnActive(btnDp50, is50);
                    setBtnActive(btnPayFull, isFull);
                }


                // Add new row with searchable dropdown (portal pattern - no inline dropdown HTML)

                function addNewRow(desc = '', qty = 1, unit = '', price = 0) {
                    const tr = document.createElement('tr');
                    tr.className = 'item-row';
                    tr.innerHTML = `
                    <td class="p-3">
                        <div class="pkg-search-wrapper">
                            <input type="text"
                                class="pkg-search-input w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-semibold bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-600 outline-none"
                                placeholder="🔍 Cari & pilih paket wisata..."
                                autocomplete="off">
                            <input type="hidden" name="items[${rowIndex}][item_name]" class="pkg-hidden-name" required>
                        </div>
                        <input type="text" name="items[${rowIndex}][description]" value="${desc}" placeholder="Deskripsi otomatis dari paket" readonly class="item-desc w-full px-3 py-1.5 rounded-lg border border-neutral-200 text-[11px] bg-neutral-100 text-slate-500 cursor-not-allowed outline-none mt-1">
                    </td>
                    <td class="p-3">
                        <input type="number" step="any" name="items[${rowIndex}][quantity]" value="${qty}" min="0.01" required class="item-qty w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-bold bg-canvas focus:bg-white outline-none">
                    </td>
                    <td class="p-3">
                        <input type="text" name="items[${rowIndex}][unit]" value="${unit}" readonly class="item-unit w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs bg-neutral-100 text-slate-600 cursor-not-allowed outline-none">
                    </td>
                    <td class="p-3">
                        <input type="number" step="any" name="items[${rowIndex}][price]" value="${price}" min="0" readonly required class="item-price w-full px-3 py-2 rounded-lg border border-neutral-200 text-xs font-bold bg-neutral-100 text-slate-700 cursor-not-allowed outline-none">
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
                    initSearchDropdown(tr);
                    rowIndex++;
                    if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
                    calculateTotals();
                }

                // Init search on existing rows
                tbody.querySelectorAll('.item-row').forEach(tr => initSearchDropdown(tr));

                if (addItemBtn) addItemBtn.addEventListener('click', () => addNewRow());

                // Input delegation for qty → recalculate
                tbody.addEventListener('input', function (e) {
                    if (e.target.classList.contains('item-qty')) {
                        calculateTotals();
                    }
                });

                // Remove row
                tbody.addEventListener('click', function (e) {
                    const removeBtn = e.target.closest('.remove-row-btn');
                    if (removeBtn) {
                        if (tbody.querySelectorAll('.item-row').length > 1) {
                            removeBtn.closest('.item-row').remove();
                            calculateTotals();
                        } else {
                            alert('Invoice minimal harus memiliki 1 item layanan!');
                        }
                    }
                });

                [discountInput, taxInput, paidInput].forEach(inp => { if (inp) inp.addEventListener('input', calculateTotals); });
                if (btnDp30) btnDp30.addEventListener('click', () => { const { grandTotal } = calculateTotals(); paidInput.value = Math.round(grandTotal * 0.3); calculateTotals(); });
                if (btnDp50) btnDp50.addEventListener('click', () => { const { grandTotal } = calculateTotals(); paidInput.value = Math.round(grandTotal * 0.5); calculateTotals(); });
                if (btnPayFull) btnPayFull.addEventListener('click', () => { const { grandTotal } = calculateTotals(); paidInput.value = grandTotal; calculateTotals(); });

                calculateTotals();
            });
        </script>
    @endpush
@endsection