<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice_{{ $invoice->invoice_number }}_{{ \Illuminate\Support\Str::slug($invoice->customer_name) }}</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}?v=3">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.5;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            min-height: 100vh;
            padding: 24px 16px;
        }
        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        .public-wrapper {
            max-width: 860px;
            margin: 0 auto;
        }

        /* Top Action Bar */
        .action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: #ffffff;
            padding: 16px 20px;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            margin-bottom: 24px;
        }
        .action-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .action-brand img {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }
        .action-brand-info h2 {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }
        .verified-tag {
            font-size: 11px;
            font-weight: 600;
            color: #059669;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-print {
            background: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-print:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }
        .btn-wa {
            background: #047857;
            color: #ffffff;
            border: none;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(4, 120, 87, 0.25);
        }
        .btn-wa:hover {
            background: #065f46;
        }

        /* Invoice Sheet (Matches Admin Print Template) */
        .invoice-page {
            background: #ffffff;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 24px;
            gap: 20px;
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
            flex-shrink: 0;
        }
        .brand-info h1 {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
            letter-spacing: -0.2px;
        }
        .brand-info p {
            color: #64748b;
            font-size: 11px;
            line-height: 1.4;
        }
        .invoice-meta {
            text-align: right;
            flex-shrink: 0;
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
            text-align: right;
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
            line-height: 1.4;
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
            font-size: 11px;
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
            color: #0f172a;
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

        @media (max-width: 640px) {
            body {
                padding: 12px 8px;
            }
            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }
            .action-buttons {
                flex-direction: column;
            }
            .btn-print, .btn-wa {
                justify-content: center;
            }
            .invoice-page {
                padding: 20px 16px;
            }
            .invoice-header {
                flex-direction: column;
            }
            .brand-block {
                max-width: 100%;
            }
            .invoice-meta {
                text-align: left;
            }
            .details-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
            }
            .action-bar {
                display: none !important;
            }
            .public-wrapper {
                max-width: 100% !important;
                margin: 0 !important;
            }
            .invoice-page {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                border: none !important;
            }
            @page {
                size: A4 portrait;
                margin: 15mm;
            }
        }
    </style>
</head>
<body>

    <div class="public-wrapper">
        <!-- Top Action Bar -->
        <div class="action-bar">
            <div class="action-brand">
                <img src="{{ asset('images/puja_logo.png') }}" alt="Logo">
                <div class="action-brand-info">
                    <h2>{{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL' }}</h2>
                    <span class="verified-tag">
                        <i data-lucide="check-circle" style="width: 13px; height: 13px;"></i>
                        <span>Dokumen Invoice Resmi Terverifikasi</span>
                    </span>
                </div>
            </div>

            <div class="action-buttons">
                <button type="button" onclick="window.print()" class="btn-print">
                    <i data-lucide="printer" style="width: 14px; height: 14px;"></i>
                    <span>Cetak / PDF</span>
                </button>

                @php
                    $waCompany = $settings['whatsapp_number'] ?? '6281234567890';
                    $waText = "Halo Admin Puja Tour, saya ingin konfirmasi mengenai Invoice *" . $invoice->invoice_number . "* atas nama *" . $invoice->customer_name . "* sebesar *" . $invoice->formatted_total . "*.";
                    $waUrl = "https://api.whatsapp.com/send?phone=" . preg_replace('/[^0-9]/', '', $waCompany) . "&text=" . urlencode($waText);
                @endphp
                <a href="{{ $waUrl }}" target="_blank" class="btn-wa">
                    <i data-lucide="message-circle" style="width: 14px; height: 14px;"></i>
                    <span>Konfirmasi via WhatsApp</span>
                </a>
            </div>
        </div>

        <!-- Invoice Sheet (Identical to Admin Print Layout) -->
        <div class="invoice-page">
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
                        @if($invoice->status !== 'PAID' && $invoice->remaining_amount > 0)
                            <div class="summary-row" style="color: #64748b; margin-top: 6px;">
                                <span>Jumlah Terbayar (DP):</span>
                                <strong>{{ $invoice->formatted_paid }}</strong>
                            </div>
                            <div class="summary-row remaining">
                                <span>Sisa Pelunasan:</span>
                                <strong style="font-size: 13px;">{{ $invoice->formatted_remaining }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="signature-box">
                        <div class="sig-container">
                            <span style="font-size: 11px; color: #64748b;">{{ $settings['signature_header'] ?? 'Hormat Kami,' }}</span>
                            <div class="sig-space" style="height: 50px; display: flex; align-items: center; justify-content: center;">
                                @if(!empty($settings['signature_image']))
                                    <img src="{{ asset('storage/' . $settings['signature_image']) }}" alt="Tanda Tangan" style="max-height: 48px; max-width: 140px; object-fit: contain; margin: 0 auto; display: block;">
                                @endif
                            </div>
                            <div class="sig-name">
                                <div>{{ $settings['signature_name'] ?? 'Puja Tour & Travel' }}</div>
                                <span style="font-size: 9px; color: #94a3b8; font-weight: normal;">{{ $settings['signature_position'] ?? 'Finance & Reservation' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-note">
                Dokumen invoice ini sah dan diterbitkan secara digital oleh {{ $settings['company_name'] ?? 'Puja Tour & Travel Pangandaran' }}. Terima kasih atas kepercayaan Anda!
            </div>
        </div>
    </div>

    <script>
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons();
        }
    </script>
</body>
</html>
