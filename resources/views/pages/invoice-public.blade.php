<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->invoice_number }} — {{ $settings['company_name'] ?? 'Puja Tour & Travel' }}</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}?v=3">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind / App Assets -->
    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen py-6 sm:py-10 px-3 sm:px-6 flex flex-col justify-between">

    <div class="max-w-4xl mx-auto w-full space-y-6">
        <!-- Top Public Header Bar -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white/90 backdrop-blur-md p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 shrink-0 flex items-center justify-center p-1 rounded-xl bg-slate-50 border border-slate-200">
                    <img src="{{ asset('images/puja_logo.png') }}" alt="Puja Tour Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <h2 class="font-display font-bold text-sm text-slate-900 leading-tight">
                        {{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL' }}
                    </h2>
                    <span class="text-[11px] text-emerald-700 font-semibold flex items-center gap-1">
                        <i data-lucide="check-circle" class="w-3 h-3"></i>
                        <span>Dokumen Invoice Resmi Terverifikasi</span>
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <button type="button" onclick="window.print()" class="flex-1 sm:flex-none px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-xs transition flex items-center justify-center gap-2">
                    <i data-lucide="printer" class="w-4 h-4 text-slate-500"></i>
                    <span>Cetak / PDF</span>
                </button>

                @php
                    $waCompany = $settings['whatsapp_number'] ?? '6281234567890';
                    $waText = "Halo Admin Puja Tour, saya ingin konfirmasi mengenai Invoice *" . $invoice->invoice_number . "* atas nama *" . $invoice->customer_name . "* sebesar *" . $invoice->formatted_total . "*.";
                    $waUrl = "https://api.whatsapp.com/send?phone=" . preg_replace('/[^0-9]/', '', $waCompany) . "&text=" . urlencode($waText);
                @endphp
                <a href="{{ $waUrl }}" target="_blank" class="flex-1 sm:flex-none px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Konfirmasi via WhatsApp</span>
                </a>
            </div>
        </div>

        <!-- Main Invoice Sheet -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-xl space-y-8 relative overflow-hidden" id="printable-area">
            <!-- Stamp Badge -->
            <div class="absolute right-6 top-6 sm:right-10 sm:top-10 opacity-90 pointer-events-none rotate-[-12deg] z-10">
                @if($invoice->status === 'PAID')
                    <div class="border-4 border-emerald-600 text-emerald-600 font-display font-black text-lg sm:text-2xl tracking-widest px-4 sm:px-5 py-1.5 sm:py-2 rounded-2xl uppercase">
                        LUNAS (PAID)
                    </div>
                @elseif($invoice->status === 'PARTIAL')
                    <div class="border-4 border-amber-600 text-amber-600 font-display font-black text-lg sm:text-2xl tracking-widest px-4 sm:px-5 py-1.5 sm:py-2 rounded-2xl uppercase">
                        DP (UANG MUKA)
                    </div>
                @elseif($invoice->status === 'CANCELLED')
                    <div class="border-4 border-slate-400 text-slate-400 font-display font-black text-lg sm:text-2xl tracking-widest px-4 sm:px-5 py-1.5 sm:py-2 rounded-2xl uppercase">
                        DIBATALKAN
                    </div>
                @else
                    <div class="border-4 border-rose-600 text-rose-600 font-display font-black text-lg sm:text-2xl tracking-widest px-4 sm:px-5 py-1.5 sm:py-2 rounded-2xl uppercase">
                        BELUM LUNAS
                    </div>
                @endif
            </div>

            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start gap-6 border-b border-slate-200 pb-8">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 shrink-0 flex items-center justify-center p-1 rounded-2xl bg-slate-50 border border-slate-200">
                        <img src="{{ asset('images/puja_logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div class="space-y-1 max-w-md">
                        <h1 class="font-display font-extrabold text-xl text-slate-900 leading-tight">
                            {{ $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN' }}
                        </h1>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat' }}
                        </p>
                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-600 font-medium pt-1">
                            <span>📞 {{ $settings['phone_number'] ?? '+62 812-3456-7890' }}</span>
                            <span>•</span>
                            <span>✉️ {{ $settings['email_address'] ?? 'info@pujatourtravel.com' }}</span>
                        </div>
                    </div>
                </div>

                <div class="text-left sm:text-right space-y-1.5 sm:min-w-[200px]">
                    <span class="text-[11px] font-extrabold tracking-widest uppercase text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200 inline-block">
                        TAGIHAN / INVOICE
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

            <!-- Customer & Trip Details -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-200 text-xs">
                <div class="space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Ditujukan Kepada (Customer):</span>
                    <h3 class="font-display font-bold text-base text-slate-900">{{ $invoice->customer_name }}</h3>
                    <div class="space-y-1 text-slate-600 font-medium">
                        <p>📱 {{ $invoice->customer_phone }}</p>
                        @if($invoice->customer_email)
                            <p>✉️ {{ $invoice->customer_email }}</p>
                        @endif
                        @if($invoice->customer_address)
                            <p>📍 {{ $invoice->customer_address }}</p>
                        @endif
                    </div>
                </div>

                <div class="space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Detail Keberangkatan:</span>
                    <div class="space-y-1.5 text-slate-700">
                        @if($invoice->package_name || $invoice->package)
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Paket:</span>
                                <span class="font-bold text-slate-900">{{ $invoice->package_name ?? $invoice->package->name }}</span>
                            </div>
                        @endif
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Tanggal Trip:</span>
                            <span class="font-bold text-slate-900">{{ $invoice->travel_date ? $invoice->travel_date->translatedFormat('d F Y') : 'Fleksibel' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Jumlah Peserta:</span>
                            <span class="font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-lg border border-emerald-200">{{ $invoice->pax_count }} Orang</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b-2 border-slate-200 text-slate-600 font-bold uppercase tracking-wider">
                            <th class="py-3 px-2 w-12 text-center">No</th>
                            <th class="py-3 px-4">Deskripsi Layanan</th>
                            <th class="py-3 px-3 text-center">Jumlah</th>
                            <th class="py-3 px-4 text-right">Harga Satuan</th>
                            <th class="py-3 px-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($invoice->items as $index => $item)
                            <tr>
                                <td class="py-4 px-2 text-center font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-4 px-4">
                                    <span class="font-bold text-slate-900 text-sm block">{{ $item->item_name }}</span>
                                    @if($item->description)
                                        <span class="text-slate-500 text-[11px] block mt-0.5">{{ $item->description }}</span>
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

            <!-- Bottom Financial & Bank Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-200">
                <!-- Payment Instructions -->
                <div class="space-y-3 text-xs">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Rekening Pembayaran Resmi:</span>
                    @if($invoice->bank_details)
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 font-mono text-xs text-slate-700 whitespace-pre-line leading-relaxed">
                            {{ $invoice->bank_details }}
                        </div>
                    @endif

                    @if($invoice->notes)
                        <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200 text-amber-900 text-xs space-y-1">
                            <span class="font-bold block uppercase text-[10px] text-amber-700">Syarat & Ketentuan:</span>
                            <p class="whitespace-pre-line leading-relaxed text-[11px]">{{ $invoice->notes }}</p>
                        </div>
                    @endif
                </div>

                <!-- Summary Box -->
                <div class="space-y-3 text-xs">
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2.5">
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Subtotal Layanan:</span>
                            <span class="font-bold text-slate-800 text-sm">{{ $invoice->formatted_subtotal }}</span>
                        </div>

                        @if($invoice->discount > 0)
                            <div class="flex items-center justify-between text-rose-600 font-medium">
                                <span>Potongan Diskon:</span>
                                <span>- {{ $invoice->formatted_discount }}</span>
                            </div>
                        @endif

                        @if($invoice->tax_amount > 0)
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Pajak / PPN ({{ (float)$invoice->tax_percent }}%):</span>
                                <span class="font-semibold text-slate-800">{{ $invoice->formatted_tax }}</span>
                            </div>
                        @endif

                        <div class="border-t border-slate-300 pt-2.5"></div>

                        <div class="flex items-center justify-between font-display font-extrabold text-base text-slate-900">
                            <span>Total Tagihan:</span>
                            <span class="text-xl text-emerald-800">{{ $invoice->formatted_total }}</span>
                        </div>

                        <div class="flex items-center justify-between text-emerald-800 font-semibold pt-1">
                            <span>Jumlah Terbayar (DP):</span>
                            <span>{{ $invoice->formatted_paid }}</span>
                        </div>

                        <div class="flex items-center justify-between font-bold text-sm text-rose-600 border-t border-dashed border-slate-200 pt-2">
                            <span>Sisa Pelunasan:</span>
                            <span class="text-base">{{ $invoice->formatted_remaining }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center pt-6 border-t border-slate-100 text-slate-400 text-xs">
                <p>Terima kasih telah mempercayakan liburan dan petualangan Anda bersama <strong>{{ $settings['company_name'] ?? 'Puja Tour & Travel' }}</strong>.</p>
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
