<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice_{{ $invoice->invoice_number }}_{{ \Illuminate\Support\Str::slug($invoice->customer_name) }}</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind / Custom Print Stylesheet -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.5;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        .screen-toolbar {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            gap: 10px;
            background: rgba(15, 23, 42, 0.9);
            padding: 10px 16px;
            border-radius: 9999px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(8px);
        }
        .screen-btn {
            background: #047857;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 9999px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
            text-decoration: none;
        }
        .screen-btn:hover {
            background: #065f46;
        }
        .screen-btn-secondary {
            background: #334155;
        }
        .screen-btn-secondary:hover {
            background: #475569;
        }

        .invoice-page {
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            background: #ffffff;
            padding: 20mm;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            position: relative;
        }

        .stamp-badge {
            position: absolute;
            top: 100px;
            right: 60px;
            transform: rotate(-12deg);
            padding: 8px 24px;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 2px;
            border-radius: 12px;
            text-transform: uppercase;
            border-width: 4px;
            border-style: solid;
            pointer-events: none;
            opacity: 0.85;
        }
        .stamp-paid {
            border-color: #059669;
            color: #059669;
        }
        .stamp-partial {
            border-color: #d97706;
            color: #d97706;
        }
        .stamp-unpaid {
            border-color: #e11d48;
            color: #e11d48;
        }
        .stamp-cancelled {
            border-color: #64748b;
            color: #64748b;
        }

        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 24px;
        }
        .brand-block {
            display: flex;
            gap: 16px;
            max-width: 60%;
        }
        .brand-logo {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }
        .brand-info h1 {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .brand-info p {
            color: #64748b;
            font-size: 11px;
            line-height: 1.4;
        }
        .invoice-meta {
            text-align: right;
        }
        .invoice-tag {
            display: inline-block;
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 3px 10px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 10px;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .invoice-meta h2 {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            font-family: monospace;
            margin-bottom: 4px;
        }
        .invoice-meta p {
            font-size: 11px;
            color: #64748b;
        }

        /* Client & Trip Info Box */
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
        }
        .detail-col h3 {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 8px;
        }
        .detail-col .name {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
            font-size: 11px;
        }
        .detail-row .label {
            color: #64748b;
        }
        .detail-row .val {
            font-weight: 600;
            color: #0f172a;
        }

        /* Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        .items-table th {
            background: #f1f5f9;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
            padding: 10px 12px;
            border-bottom: 2px solid #cbd5e1;
            text-align: left;
        }
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
            vertical-align: top;
        }
        .items-table .item-title {
            font-weight: 700;
            color: #0f172a;
            font-size: 12px;
            margin-bottom: 2px;
        }
        .items-table .item-desc {
            color: #64748b;
            font-size: 10px;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }

        /* Summary Bottom Grid */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 24px;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
        .bank-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 12px;
            font-size: 11px;
        }
        .bank-box h4 {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            color: #475569;
            margin-bottom: 6px;
        }
        .bank-box pre {
            font-family: inherit;
            white-space: pre-line;
            color: #1e293b;
            line-height: 1.5;
        }
        .terms-box {
            font-size: 10px;
            color: #64748b;
            line-height: 1.4;
        }

        .summary-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 11px;
        }
        .summary-row.grand-total {
            border-top: 2px solid #cbd5e1;
            padding-top: 8px;
            margin-top: 8px;
            font-size: 15px;
            font-weight: 800;
            color: #047857;
        }
        .summary-row.remaining {
            border-top: 1px dashed #cbd5e1;
            padding-top: 6px;
            margin-top: 6px;
            font-weight: 700;
            color: #e11d48;
        }

        .signature-box {
            text-align: right;
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }
        .sig-container {
            text-align: center;
            width: 180px;
        }
        .sig-space {
            height: 50px;
        }
        .sig-name {
            font-weight: 700;
            color: #0f172a;
            border-top: 1px solid #94a3b8;
            padding-top: 4px;
            font-size: 11px;
        }

        .footer-note {
            text-align: center;
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            font-size: 10px;
            color: #94a3b8;
        }

        @media print {
            body {
                background: #ffffff !important;
            }
            .screen-toolbar {
                display: none !important;
            }
            .invoice-page {
                width: 100% !important;
                min-height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }
            @page {
                size: A4 portrait;
                margin: 15mm;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Screen Toolbar -->
    <div class="screen-toolbar">
        <button onclick="window.print()" class="screen-btn">
            <span>🖨️ Cetak / Simpan PDF</span>
        </button>
        <button onclick="window.close()" class="screen-btn screen-btn-secondary">
            <span>✕ Tutup</span>
        </button>
    </div>

    <!-- Invoice Sheet -->
    <div class="invoice-page">
        <!-- Status Stamp Watermark -->
        @if($invoice->status === 'PAID')
            <div class="stamp-badge stamp-paid">LUNAS (PAID)</div>
        @elseif($invoice->status === 'PARTIAL')
            <div class="stamp-badge stamp-partial">DP (UANG MUKA)</div>
        @elseif($invoice->status === 'CANCELLED')
            <div class="stamp-badge stamp-cancelled">DIBATALKAN</div>
        @else
            <div class="stamp-badge stamp-unpaid">BELUM LUNAS</div>
        @endif

        <!-- Header -->
        <div class="invoice-header">
            <div class="brand-block">
                <img src="{{ asset('images/puja_logo.png') }}" alt="Logo" class="brand-logo">
                <div class="brand-info">
                    <h1>{{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN' }}</h1>
                    <p>{{ $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat' }}</p>
                    <p>Telp/WA: {{ $settings['phone_number'] ?? '+62 812-3456-7890' }} | Email: {{ $settings['email_address'] ?? 'info@pujatourtravel.com' }}</p>
                </div>
            </div>

            <div class="invoice-meta">
                <span class="invoice-tag">INVOICE RESMI</span>
                <h2>{{ $invoice->invoice_number }}</h2>
                <p>Tgl Terbit: <strong>{{ $invoice->invoice_date ? $invoice->invoice_date->format('d/m/Y') : '-' }}</strong></p>
                @if($invoice->due_date)
                    <p>Jatuh Tempo: <strong>{{ $invoice->due_date->format('d/m/Y') }}</strong></p>
                @endif
            </div>
        </div>

        <!-- Details Grid -->
        <div class="details-grid">
            <div class="detail-col">
                <h3>Ditujukan Kepada:</h3>
                <div class="name">{{ $invoice->customer_name }}</div>
                <div class="detail-row">
                    <span class="label">No. Telepon / WA:</span>
                    <span class="val">{{ $invoice->customer_phone }}</span>
                </div>
                @if($invoice->customer_email)
                    <div class="detail-row">
                        <span class="label">Email:</span>
                        <span class="val">{{ $invoice->customer_email }}</span>
                    </div>
                @endif
                @if($invoice->customer_address)
                    <div class="detail-row">
                        <span class="label">Alamat / Asal:</span>
                        <span class="val">{{ $invoice->customer_address }}</span>
                    </div>
                @endif
            </div>

            <div class="detail-col">
                <h3>Informasi Trip & Reservasi:</h3>
                @if($invoice->package_name || $invoice->package)
                    <div class="detail-row">
                        <span class="label">Paket Wisata:</span>
                        <span class="val">{{ $invoice->package_name ?? $invoice->package->name }}</span>
                    </div>
                @endif
                <div class="detail-row">
                    <span class="label">Tgl Keberangkatan:</span>
                    <span class="val">{{ $invoice->travel_date ? $invoice->travel_date->format('d F Y') : '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Jumlah Peserta:</span>
                    <span class="val">{{ $invoice->pax_count }} Orang (Pax)</span>
                </div>
                <div class="detail-row">
                    <span class="label">Metode Pembayaran:</span>
                    <span class="val">{{ $invoice->payment_method ?? 'Transfer Bank / QRIS' }}</span>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 35px;" class="text-center">No</th>
                    <th>Deskripsi Layanan & Fasilitas</th>
                    <th style="width: 80px;" class="text-center">Jumlah</th>
                    <th style="width: 110px;" class="text-right">Harga Satuan</th>
                    <th style="width: 120px;" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $index => $item)
                    <tr>
                        <td class="text-center" style="color: #94a3b8; font-weight: 700;">{{ $index + 1 }}</td>
                        <td>
                            <div class="item-title">{{ $item->item_name }}</div>
                            @if($item->description)
                                <div class="item-desc">{{ $item->description }}</div>
                            @endif
                        </td>
                        <td class="text-center" style="font-weight: 600;">
                            {{ $item->formatted_qty }} {{ $item->unit }}
                        </td>
                        <td class="text-right">
                            {{ $item->formatted_price }}
                        </td>
                        <td class="text-right" style="font-weight: 700;">
                            {{ $item->formatted_subtotal }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bottom Summary & Bank Details -->
        <div class="bottom-grid">
            <div>
                @if($invoice->bank_details)
                    <div class="bank-box">
                        <h4>Instruksi & Rekening Pembayaran:</h4>
                        <pre>{{ $invoice->bank_details }}</pre>
                    </div>
                @endif

                @if($invoice->notes)
                    <div class="terms-box">
                        <strong>Syarat & Ketentuan:</strong>
                        <p style="white-space: pre-line; margin-top: 4px;">{{ $invoice->notes }}</p>
                    </div>
                @endif
            </div>

            <div>
                <div class="summary-card">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <strong>{{ $invoice->formatted_subtotal }}</strong>
                    </div>
                    @if($invoice->discount > 0)
                        <div class="summary-row" style="color: #e11d48;">
                            <span>Diskon:</span>
                            <strong>- {{ $invoice->formatted_discount }}</strong>
                        </div>
                    @endif
                    @if($invoice->tax_amount > 0)
                        <div class="summary-row">
                            <span>Pajak / PPN ({{ (float)$invoice->tax_percent }}%):</span>
                            <span>{{ $invoice->formatted_tax }}</span>
                        </div>
                    @endif
                    <div class="summary-row grand-total">
                        <span>Total Tagihan:</span>
                        <span>{{ $invoice->formatted_total }}</span>
                    </div>
                    <div class="summary-row" style="color: #047857; margin-top: 6px;">
                        <span>Jumlah Terbayar (DP):</span>
                        <strong>{{ $invoice->formatted_paid }}</strong>
                    </div>
                    <div class="summary-row remaining">
                        <span>Sisa Pelunasan:</span>
                        <strong style="font-size: 13px;">{{ $invoice->formatted_remaining }}</strong>
                    </div>
                </div>

                <div class="signature-box">
                    <div class="sig-container">
                        <span style="font-size: 11px; color: #64748b;">Hormat Kami,</span>
                        <div class="sig-space"></div>
                        <div class="sig-name">
                            <div>Puja Tour & Travel</div>
                            <span style="font-size: 9px; color: #94a3b8; font-weight: normal;">Finance & Reservation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-note">
            Dokumen invoice ini sah dan diterbitkan secara digital oleh {{ $settings['company_name'] ?? 'Puja Tour & Travel Pangandaran' }}. Terima kasih atas kepercayaan Anda!
        </div>
    </div>

</body>
</html>
