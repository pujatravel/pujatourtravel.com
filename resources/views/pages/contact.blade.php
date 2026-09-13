<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Puja Tour & Travel Pangandaran">
    <title>Kontak & Lokasi Kantor — Puja Tour & Travel Pangandaran</title>
    <meta name="description" content="Hubungi kantor resmi Puja Tour & Travel Pangandaran. WhatsApp hotline 24 jam, alamat kantor operasional, dan petunjuk arah lokasi.">
    <meta name="keywords" content="kontak Puja Tour Travel, WhatsApp Puja Tour, alamat kantor wisata Pangandaran, lokasi biro travel Pangandaran, hubungi tour guide Pangandaran">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Puja Tour Travel">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Kontak & Lokasi Kantor — Puja Tour & Travel Pangandaran">
    <meta property="og:description" content="Hubungi kantor resmi Puja Tour & Travel Pangandaran. WhatsApp hotline 24 jam, alamat kantor operasional, dan petunjuk arah lokasi.">
    <meta property="og:image" content="{{ asset('images/hero_pangandaran.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Kontak & Lokasi Kantor — Puja Tour & Travel Pangandaran">
    <meta name="twitter:description" content="Hubungi kantor resmi Puja Tour & Travel Pangandaran. WhatsApp hotline 24 jam, alamat kantor operasional, dan petunjuk arah lokasi.">
    <meta name="twitter:image" content="{{ asset('images/hero_pangandaran.jpg') }}">

    <!-- Structured Data (JSON-LD): TravelAgency -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'TravelAgency',
        'name' => 'Puja Tour Travel',
        'description' => 'Biro perjalanan wisata resmi di Pangandaran yang menyediakan paket tur Green Canyon, body rafting, dan wisata bahari.',
        'url' => url('/'),
        'telephone' => $settings['phone_number'] ?? '+6281234567890',
        'email' => $settings['email_address'] ?? 'info@pujatourtravel.com',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $settings['office_address'] ?? 'Jl. Pantai Barat No. 88',
            'addressLocality' => 'Pangandaran',
            'addressRegion' => 'Jawa Barat',
            'postalCode' => '46396',
            'addressCountry' => 'ID',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '-7.697500',
            'longitude' => '108.652500',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Structured Data (JSON-LD): BreadcrumbList -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Beranda',
                'item' => url('/'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Kontak',
                'item' => url()->current(),
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicons for Browsers & Google Search -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}?v=3">
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Outfit', sans-serif; }
    </style>

    @include('partials.analytics')
</head>
<body class="bg-[#f4f6f1] text-slate-700 antialiased selection:bg-emerald-700 selection:text-white pt-20 sm:pt-24">

    @php
        $waNum = $settings['whatsapp_number'] ?? '6281234567890';
        $phoneNum = $settings['phone_number'] ?? '+62 812-3456-7890';
        $emailAddr = $settings['email_address'] ?? 'info@pujatourtravel.com';
        $officeAddr = $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396';
        $opHours = $settings['operational_hours'] ?? 'Setiap Hari: 06.00 - 21.00 WIB';
    @endphp

    <!-- GLOBAL NAVBAR -->
    @include('partials.navbar')

    <!-- BREADCRUMBS -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition flex items-center gap-1">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                <span>Beranda</span>
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-semibold">Kontak & Lokasi Kantor</span>
        </nav>
    </div>

    <!-- MAIN CONTACT CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 sm:py-6 pb-12 sm:pb-16">
        <div class="text-center max-w-2xl mx-auto mb-5 sm:mb-8">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-1">
                Layanan Pelanggan
            </span>
            <h1 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight">
                Hubungi Kami & Kunjungi Kantor
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-1.5 max-w-xl mx-auto">
                Konsultasi rute, pemesanan paket wisata, penjemputan rombongan, atau kunjungi kantor kami di Pantai Barat Pangandaran.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 sm:gap-8 items-stretch">
            <!-- Contact Cards & Info (Simetris 50% Lebar & Sama Tinggi) -->
            <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 lg:p-10 shadow-soft border border-neutral-200 flex flex-col justify-between h-full">
                <div>
                    <!-- Header -->
                    <div class="pb-4 sm:pb-5 border-b border-neutral-100 mb-5 sm:mb-6">
                        <h2 class="font-display font-bold text-xl sm:text-2xl text-slate-900">Informasi Kontak & Kantor</h2>
                        <p class="text-xs text-slate-500 mt-1">Kanal komunikasi resmi Puja Tour & Travel Pangandaran.</p>
                    </div>

                    <!-- Contact Details List -->
                    <div class="space-y-3.5 text-xs">
                        <!-- 1. Alamat Kantor -->
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">Kantor Operasional</span>
                                <p class="font-semibold text-slate-800 text-xs sm:text-sm leading-snug mt-0.5">{{ $officeAddr }}</p>
                                <span class="text-[10px] text-emerald-700 font-semibold block mt-0.5">Dekat Pantai Barat Pangandaran</span>
                            </div>
                        </div>

                        <!-- 2. WhatsApp Hotline -->
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100">
                                <i data-lucide="phone-call" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">WhatsApp & Hotline</span>
                                <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" target="_blank" class="font-display font-bold text-sm sm:text-base text-emerald-700 hover:underline block mt-0.5 truncate">
                                    {{ $phoneNum }}
                                </a>
                                <span class="text-[10px] text-slate-500 block mt-0.5">Online 24 Jam • Respons Cepat</span>
                            </div>
                        </div>

                        <!-- 3. Jam Operasional -->
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">Jam Layanan Kantor</span>
                                <p class="font-semibold text-slate-800 text-xs sm:text-sm mt-0.5">{{ $opHours }}</p>
                                <span class="text-[10px] text-slate-500 block mt-0.5">Buka setiap hari termasuk hari libur</span>
                            </div>
                        </div>

                        <!-- 4. Email & Proposal -->
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">Email & Proposal Resmi</span>
                                <a href="mailto:{{ $emailAddr }}" class="font-semibold text-slate-800 hover:text-emerald-700 transition block mt-0.5 text-xs sm:text-sm truncate">
                                    {{ $emailAddr }}
                                </a>
                                <span class="text-[10px] text-slate-500 block mt-0.5">Surat penawaran & invoice dinas / corporate</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section: Trust Notice + Actions + Legalitas -->
                <div class="mt-6 pt-5 border-t border-neutral-100 space-y-4">
                    <!-- Quick Trust Notice -->
                    <div class="p-3.5 rounded-2xl bg-emerald-50/80 border border-emerald-200/80 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-2xs">
                            <i data-lucide="sparkles" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-emerald-950">Konsultasi Rute Bebas Biaya</h4>
                            <p class="text-[11px] text-emerald-800 leading-snug">Dapatkan estimasi biaya & custom rundown gratis dari tour planner kami.</p>
                        </div>
                    </div>

                    <!-- Clean Action Buttons -->
                    <div class="flex flex-row gap-2.5">
                        <a href="https://maps.google.com/?q={{ urlencode($officeAddr) }}" target="_blank" rel="noopener noreferrer" class="flex-1 py-3 px-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs text-center transition shadow-xs flex items-center justify-center gap-1.5">
                            <i data-lucide="map-pin" class="w-4 h-4 shrink-0"></i>
                            <span>Buka Maps</span>
                        </a>
                        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20Puja%20Tour,%20saya%20ingin%20konsultasi%20trip%20ke%20Pangandaran" target="_blank" rel="noopener noreferrer" class="flex-1 py-3 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs text-center transition flex items-center justify-center gap-1.5">
                            <i data-lucide="message-circle" class="w-4 h-4 shrink-0"></i>
                            <span>Chat WhatsApp</span>
                        </a>
                    </div>

                </div>
            </div>

            <!-- Interactive Direct Message to WA Form (Simetris 50% Lebar & Sama Tinggi) -->
            <div class="bg-surface-soft rounded-2xl sm:rounded-3xl p-5 sm:p-8 lg:p-10 shadow-soft border border-neutral-200 flex flex-col justify-between h-full">
                <div>
                    <div class="pb-4 sm:pb-5 border-b border-neutral-200 mb-5 sm:mb-6">
                        <h2 class="font-display font-bold text-xl sm:text-2xl text-slate-900">Kirim Pesan & Permintaan Khusus</h2>
                        <p class="text-xs text-slate-500 mt-1">Isi formulir di bawah ini untuk terhubung langsung ke WhatsApp Customer Support kami.</p>
                    </div>

                    <form id="contact-form" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Nama Lengkap *</label>
                                <input type="text" id="msg-name" required placeholder="Contoh: Hendra Wijaya" class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-xs sm:text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Jenis Permintaan *</label>
                                <select id="msg-topic" class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-xs sm:text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                                    <option value="Konsultasi Paket Wisata">Konsultasi Paket Wisata</option>
                                    <option value="Corporate / Family Gathering">Corporate / Family Gathering (Rombongan)</option>
                                    <option value="Body Rafting Green Canyon">Body Rafting Green Canyon</option>
                                    <option value="Snorkeling & Wisata Bahari">Snorkeling & Wisata Bahari</option>
                                    <option value="Kebutuhan Bus / Transport">Kebutuhan Bus / Transportasi</option>
                                    <option value="Custom Itinerary Pangandaran">Custom Itinerary Pangandaran</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5" for="msg-pax">Estimasi Jumlah Tamu (Orang)</label>
                                <input type="number" id="msg-pax" min="1" max="1000" step="1" inputmode="numeric" placeholder="Contoh: 10" class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-xs sm:text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Rencana Tanggal (Opsional)</label>
                                <input type="date" id="msg-date" min="{{ date('Y-m-d') }}" placeholder="Pilih tanggal trip (opsional)..." class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-xs sm:text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition custom-datepicker-input">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-1.5">Pesan atau Pertanyaan Anda *</label>
                            <textarea id="msg-content" rows="4" required placeholder="Tuliskan detail rencana liburan, kebutuhan khusus, atau pertanyaan Anda..." class="w-full px-4 py-2.5 sm:py-3 rounded-xl border border-neutral-200 bg-white text-slate-800 text-xs sm:text-sm focus:ring-2 focus:ring-emerald-700 outline-none transition"></textarea>
                        </div>

                        <!-- Auto-composed Notification Notice -->
                        <div class="flex items-center gap-2.5 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs">
                            <i data-lucide="sparkles" class="w-4 h-4 text-emerald-700 shrink-0"></i>
                            <span>Pesan Anda akan otomatis terformat rapi dan langsung terketik di WhatsApp Admin, tinggal Anda kirim!</span>
                        </div>

                        <button type="submit" class="w-full py-3.5 sm:py-4 min-h-12 rounded-xl sm:rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                            <i data-lucide="message-circle" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            <span>Kirim Pesan Otomatis ke WhatsApp CS</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Dynamic Google Maps Section (Kompak Sesuai Beranda) -->
        <div class="mt-6 sm:mt-8 bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-soft border border-neutral-200">
            <div class="mb-3 sm:mb-4">
                <h2 class="font-display font-bold text-base sm:text-xl text-slate-900">Peta Lokasi Kantor</h2>
                <p class="text-xs text-slate-500 mt-0.5">Panduan rute perjalanan menuju kantor operasional kami di Pantai Barat.</p>
            </div>

            <div class="rounded-xl sm:rounded-2xl overflow-hidden shadow-inner border border-neutral-200 bg-slate-100 h-48 sm:h-64 md:h-72 relative">
                <iframe 
                    title="Lokasi Kantor Puja Tour & Travel Pangandaran"
                    src="{{ $settings['google_maps_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.739775073105!2d108.6477546!3d-7.6974127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6598c19958348b%3A0x6b45f949c256ca61!2sPantai%20Pangandaran!5e0!3m2!1sid!2sid!4v1709800000000!5m2!1sid!2sid' }}" 
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
    </main>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Form WhatsApp Redirect Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const paxInput = document.getElementById('msg-pax');
            if (paxInput) {
                // Cegah pengetikan karakter bukan angka (e, E, +, -, .)
                paxInput.addEventListener('keydown', (e) => {
                    if (['e', 'E', '+', '-', '.'].includes(e.key)) {
                        e.preventDefault();
                    }
                });
                // Filter hanya angka saat paste atau input
                paxInput.addEventListener('input', () => {
                    paxInput.value = paxInput.value.replace(/[^0-9]/g, '');
                });
            }

            const form = document.getElementById('contact-form');
            if (form) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const name = document.getElementById('msg-name').value.trim();
                    const topic = document.getElementById('msg-topic').value;
                    const paxVal = document.getElementById('msg-pax').value.trim();
                    const dateInput = document.getElementById('msg-date');
                    const altDate = dateInput?.parentElement?.querySelector('.flatpickr-input[type="text"]');
                    const dateVal = altDate && altDate.value ? altDate.value : (dateInput && dateInput.value ? dateInput.value : '');
                    const content = document.getElementById('msg-content').value.trim();

                    if (!name || name.length < 2) {
                        alert('Mohon masukkan nama lengkap Anda terlebih dahulu.');
                        document.getElementById('msg-name').focus();
                        return;
                    }

                    let paxFormatted = 'Fleksibel / Belum Ditentukan';
                    if (paxVal) {
                        const paxNum = parseInt(paxVal, 10);
                        if (isNaN(paxNum) || paxNum < 1) {
                            alert('Mohon masukkan estimasi jumlah tamu berupa angka yang valid (minimal 1 orang).');
                            document.getElementById('msg-pax').focus();
                            return;
                        }
                        paxFormatted = `${paxNum} Orang`;
                    }

                    if (!content || content.length < 2) {
                        alert('Mohon tuliskan pesan atau pertanyaan Anda.');
                        document.getElementById('msg-content').focus();
                        return;
                    }

                    let text = `Halo Admin Puja Tour & Travel Pangandaran,\n\n`;
                    text += `Perkenalkan saya *${name}*, ingin konsultasi / kirim pesan melalui website:\n\n`;
                    text += `📋 *Detail Permintaan:*\n`;
                    text += `• *Nama Lengkap:* ${name}\n`;
                    text += `• *Jenis Permintaan:* ${topic}\n`;
                    text += `• *Estimasi Jumlah Tamu:* ${paxFormatted}\n`;
                    if (dateVal) {
                        text += `• *Rencana Tanggal Trip:* ${dateVal}\n`;
                    }
                    text += `\n💬 *Isi Pesan / Pertanyaan:*\n`;
                    text += `"${content}"\n\n`;
                    text += `Mohon info ketersediaan jadwal, penawaran harga, dan rekomendasi terbaiknya. Terima kasih!`;

                    const waNum = "{{ $waNum }}";
                    window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(text)}`, '_blank');
                });
            }
        });
    </script>
</body>
</html>
