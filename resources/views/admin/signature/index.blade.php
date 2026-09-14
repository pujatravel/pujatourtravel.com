@extends('admin.layouts.app')

@section('title', 'Pengaturan Tanda Tangan Invoice')
@section('page_title', 'Tanda Tangan Invoice')

@section('content')
    <div class="space-y-6 max-w-6xl mx-auto pb-12">

        <!-- Top Header -->
        <div
            class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft">
            <div class="space-y-1">
                <h2 class="font-display font-extrabold text-xl text-slate-900 flex items-center gap-2.5">
                    <i data-lucide="pen-tool" class="w-6 h-6 text-emerald-700"></i>
                    <span>Tanda Tangan Digital & Otorisasi Invoice</span>
                </h2>
                <p class="text-xs text-slate-500">Buat coretan tanda tangan langsung menggunakan mouse / touchpad / layar
                    sentuh, atau unggah berkas gambar tanda tangan & stempel</p>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Form Column (7 cols) -->
            <div class="lg:col-span-7">
                <form action="{{ route('admin.signature.update') }}" method="POST" enctype="multipart/form-data"
                    id="signature-form"
                    class="bg-surface-soft p-6 sm:p-7 rounded-3xl border border-neutral-200 shadow-soft space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Input for Canvas Drawing Data -->
                    <input type="hidden" name="signature_pad_data" id="signature-pad-data">

                    <div class="border-b border-neutral-200 pb-4">
                        <h3 class="font-display font-bold text-base text-slate-900">Rincian Penandatangan</h3>
                        <p class="text-xs text-slate-400">Informasi ini akan tercetak pada bagian pojok kanan bawah dokumen
                            invoice resmi</p>
                    </div>

                    <!-- Salam / Header Tanda Tangan -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">
                            Teks Salam / Pembuka <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="signature_header" id="input-sig-header"
                            value="{{ old('signature_header', $settings['signature_header'] ?? 'Hormat Kami,') }}"
                            placeholder="Contoh: Hormat Kami," required
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                        @error('signature_header')
                        <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nama Penandatangan / Perusahaan -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">
                                Nama Penandatangan <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="signature_name" id="input-sig-name"
                                value="{{ old('signature_name', $settings['signature_name'] ?? 'Puja Tour & Travel') }}"
                                placeholder="Contoh: Hendra Gunawan, S.E." required
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs font-bold text-slate-900 bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                            @error('signature_name')
                            <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Jabatan / Bagian / Departemen -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">
                                Jabatan / Divisi <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="signature_position" id="input-sig-pos"
                                value="{{ old('signature_position', $settings['signature_position'] ?? 'Finance & Reservation') }}"
                                placeholder="Contoh: Finance & Reservation" required
                                class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                            @error('signature_position')
                            <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Kota Penerbitan (Opsional) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">
                            Kota Penerbitan (Opsional)
                        </label>
                        <input type="text" name="signature_city" id="input-sig-city"
                            value="{{ old('signature_city', $settings['signature_city'] ?? 'Pangandaran') }}"
                            placeholder="Contoh: Pangandaran"
                            class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                    </div>

                    <!-- Mode Input Tanda Tangan (Pad Coretan vs Unggah File) -->
                    <div class="pt-4 border-t border-neutral-200 space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 uppercase">
                                Bentuk Tanda Tangan
                            </label>
                            <span class="text-[11px] text-slate-400">Goreskan tanda tangan langsung menggunakan mouse /
                                touchpad / layar sentuh</span>
                        </div>

                        @php
                            $hasImage = !empty($settings['signature_image']);
                            $imageSrc = $hasImage ? asset('storage/' . $settings['signature_image']) : null;
                        @endphp

                        @if($hasImage)
                            <div class="p-3.5 bg-neutral-50 rounded-2xl border border-neutral-200 flex items-center justify-between gap-4"
                                id="current-img-wrapper">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-16 h-12 rounded-xl bg-white border border-neutral-200 p-1 flex items-center justify-center">
                                        <img src="{{ $imageSrc }}" alt="Signature" class="max-h-full max-w-full object-contain">
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-slate-800 block">Tanda Tangan Aktif Tersimpan</span>
                                        <span class="text-[10px] text-slate-400">Digunakan pada seluruh invoice saat ini</span>
                                    </div>
                                </div>

                                <label
                                    class="inline-flex items-center gap-1.5 text-xs text-rose-600 font-bold hover:text-rose-700 cursor-pointer bg-rose-50 px-3 py-1.5 rounded-xl border border-rose-200 transition">
                                    <input type="checkbox" name="remove_signature_image" value="1" id="checkbox-remove-img"
                                        class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                                    <span>Hapus</span>
                                </label>
                            </div>
                        @endif

                        <!-- TAB 1: DRAW CANVAS PAD -->
                        <div id="tab-content-draw" class="space-y-3">
                            <div class="flex items-center justify-between">
                                <!-- <span class="text-xs text-slate-600 font-semibold flex items-center gap-1.5">
                                                    <i data-lucide="mouse-pointer" class="w-3.5 h-3.5 text-emerald-700"></i>
                                                    Goreskan tanda tangan pada kotak di bawah ini:
                                                </span> -->

                                <div class="flex items-center gap-2">
                                    <button type="button" id="btn-undo-pad"
                                        class="px-2.5 py-1 text-[11px] font-bold text-slate-600 hover:text-slate-900 bg-white hover:bg-neutral-100 rounded-lg border border-neutral-200 shadow-xs transition flex items-center gap-1">
                                        <i data-lucide="undo" class="w-3 h-3"></i>
                                        <span>Urungkan</span>
                                    </button>
                                    <button type="button" id="btn-clear-pad"
                                        class="px-2.5 py-1 text-[11px] font-bold text-rose-600 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-lg border border-rose-200 transition flex items-center gap-1">
                                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                                        <span>Bersihkan Kanvas</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Canvas Box -->
                            <div
                                class="relative w-full rounded-2xl border-2 border-dashed border-emerald-300/80 bg-white overflow-hidden shadow-inner cursor-crosshair">
                                <canvas id="signature-canvas" width="600" height="220"
                                    class="w-full h-[200px] touch-none block"></canvas>
                                <div id="canvas-hint"
                                    class="absolute inset-0 flex items-center justify-center pointer-events-none text-slate-300 text-xs italic">
                                    Klik & tarik kursor mouse atau sentuh layar di sini untuk tanda tangan
                                </div>
                            </div>


                        </div>


                    </div>

                    <!-- Submit Button -->
                    <div class="pt-3">
                        <button type="submit" id="btn-submit-form"
                            class="w-full py-3.5 px-6 rounded-2xl bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Pengaturan Tanda Tangan</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Preview Column (5 cols) -->
            <div class="lg:col-span-5 space-y-4">
                <div class="bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft space-y-4 sticky top-24">
                    <div class="flex items-center justify-between border-b border-neutral-200 pb-3">
                        <h3 class="font-display font-bold text-sm text-slate-900 flex items-center gap-2">
                            <i data-lucide="eye" class="w-4 h-4 text-emerald-700"></i>
                            <span>Live Preview pada Invoice</span>
                        </h3>
                        <span
                            class="text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                            Real-time
                        </span>
                    </div>

                    <p class="text-[11px] text-slate-400">Simulasi visual bagaimana tanda tangan akan tercetak di lembar
                        dokumen tagihan:</p>

                    <!-- Document Signature Simulator Card -->
                    <div
                        class="bg-white p-6 rounded-2xl border border-neutral-200 shadow-sm flex items-center justify-center">
                        <div class="w-[180px] text-center" style="width: 180px;">
                            <!-- Header / Salam -->
                            <span id="preview-header" style="font-size: 11px; color: #64748b; display: block; margin-bottom: 2px;">
                                {{ $settings['signature_header'] ?? 'Hormat Kami,' }}
                            </span>

                            <!-- Space / Image Signature -->
                            <div id="preview-img-container" style="height: 50px; display: flex; align-items: center; justify-content: center;">
                                <img id="preview-img" src="{{ $hasImage ? $imageSrc : '' }}" alt="Signature"
                                    style="max-height: 48px; max-width: 140px; object-fit: contain; margin: 0 auto; display: block;"
                                    class="{{ $hasImage ? '' : 'hidden' }}">
                            </div>

                            <!-- Name & Position (sig-name: border-top: 1px solid #94a3b8; padding-top: 4px; font-size: 11px;) -->
                            <div style="font-weight: 700; color: #0f172a; border-top: 1px solid #94a3b8; padding-top: 4px; font-size: 11px; text-align: center;">
                                <div id="preview-name">{{ $settings['signature_name'] ?? 'Puja Tour & Travel' }}</div>
                                <span id="preview-pos" style="font-size: 9px; color: #94a3b8; font-weight: normal; display: block;">{{ $settings['signature_position'] ?? 'Finance & Reservation' }}</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-3.5 bg-emerald-50/60 rounded-2xl border border-emerald-100 flex items-start gap-2.5 text-[11px] text-emerald-900">
                        <i data-lucide="info" class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5"></i>
                        <span>Tanda tangan ini akan otomatis terpasang pada halaman cetak PDF, lembar tagihan admin, serta
                            link invoice publik pelanggan.</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // DOM Elements
                const inputHeader = document.getElementById('input-sig-header');
                const inputName = document.getElementById('input-sig-name');
                const inputPos = document.getElementById('input-sig-pos');
                const removeCheck = document.getElementById('checkbox-remove-img');
                const signatureForm = document.getElementById('signature-form');
                const signaturePadData = document.getElementById('signature-pad-data');

                const prevHeader = document.getElementById('preview-header');
                const prevName = document.getElementById('preview-name');
                const prevPos = document.getElementById('preview-pos');
                const prevImg = document.getElementById('preview-img');

                const originalSrc = @json($imageSrc);

                // Live Preview Text Handlers
                if (inputHeader) {
                    inputHeader.addEventListener('input', function () {
                        prevHeader.textContent = this.value || 'Hormat Kami,';
                    });
                }

                if (inputName) {
                    inputName.addEventListener('input', function () {
                        prevName.textContent = this.value || 'Puja Tour & Travel';
                    });
                }

                if (inputPos) {
                    inputPos.addEventListener('input', function () {
                        prevPos.textContent = this.value || 'Finance & Reservation';
                    });
                }


                // Checkbox Remove Image
                if (removeCheck) {
                    removeCheck.addEventListener('change', function () {
                        if (this.checked) {
                            if (prevImg) prevImg.classList.add('hidden');
                        } else {
                            if (originalSrc && prevImg) {
                                prevImg.src = originalSrc;
                                prevImg.classList.remove('hidden');
                            }
                        }
                    });
                }

                // -------------------------------------------------------------
                // CANVAS SIGNATURE PAD IMPLEMENTATION (Freehand Drawing)
                // -------------------------------------------------------------
                const canvas = document.getElementById('signature-canvas');
                const canvasHint = document.getElementById('canvas-hint');
                const btnClearPad = document.getElementById('btn-clear-pad');
                const btnUndoPad = document.getElementById('btn-undo-pad');

                if (canvas) {
                    const ctx = canvas.getContext('2d');
                    let isDrawing = false;
                    let strokeColor = '#0f172a';
                    let strokeWidth = 2.5;
                    let hasDrawn = false;
                    let history = [];

                    // Setup display size
                    function getPointerPos(evt) {
                        const rect = canvas.getBoundingClientRect();
                        const scaleX = canvas.width / rect.width;
                        const scaleY = canvas.height / rect.height;
                        const clientX = evt.touches ? evt.touches[0].clientX : evt.clientX;
                        const clientY = evt.touches ? evt.touches[0].clientY : evt.clientY;
                        return {
                            x: (clientX - rect.left) * scaleX,
                            y: (clientY - rect.top) * scaleY
                        };
                    }

                    let currentStroke = [];

                    function startDrawing(evt) {
                        evt.preventDefault();
                        isDrawing = true;
                        const pos = getPointerPos(evt);
                        currentStroke = [{ x: pos.x, y: pos.y, color: strokeColor, width: strokeWidth }];

                        ctx.beginPath();
                        ctx.moveTo(pos.x, pos.y);
                        ctx.strokeStyle = strokeColor;
                        ctx.lineWidth = strokeWidth;
                        ctx.lineCap = 'round';
                        ctx.lineJoin = 'round';

                        if (canvasHint) canvasHint.style.display = 'none';
                    }

                    function draw(evt) {
                        if (!isDrawing) return;
                        evt.preventDefault();
                        const pos = getPointerPos(evt);
                        currentStroke.push({ x: pos.x, y: pos.y, color: strokeColor, width: strokeWidth });

                        ctx.lineTo(pos.x, pos.y);
                        ctx.stroke();
                        hasDrawn = true;
                    }

                    function stopDrawing(evt) {
                        if (!isDrawing) return;
                        isDrawing = false;
                        if (currentStroke.length > 0) {
                            history.push(currentStroke);
                        }
                        updateLivePreviewFromCanvas();
                    }

                    function redrawHistory() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        if (history.length === 0) {
                            hasDrawn = false;
                            if (canvasHint) canvasHint.style.display = 'flex';
                            return;
                        }
                        if (canvasHint) canvasHint.style.display = 'none';
                        hasDrawn = true;

                        history.forEach(stroke => {
                            if (stroke.length === 0) return;
                            ctx.beginPath();
                            ctx.moveTo(stroke[0].x, stroke[0].y);
                            ctx.strokeStyle = stroke[0].color || '#0f172a';
                            ctx.lineWidth = stroke[0].width || 2.5;
                            ctx.lineCap = 'round';
                            ctx.lineJoin = 'round';

                            for (let i = 1; i < stroke.length; i++) {
                                ctx.lineTo(stroke[i].x, stroke[i].y);
                            }
                            ctx.stroke();
                        });
                    }

                    function clearCanvas() {
                        history = [];
                        hasDrawn = false;
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        if (canvasHint) canvasHint.style.display = 'flex';
                        signaturePadData.value = '';

                        if (originalSrc && !removeCheck?.checked) {
                            if (prevImg) {
                                prevImg.src = originalSrc;
                                prevImg.classList.remove('hidden');
                            }
                        } else {
                            if (prevImg) prevImg.classList.add('hidden');
                        }
                    }

                    function updateLivePreviewFromCanvas() {
                        if (!hasDrawn || history.length === 0) return;
                        const dataUrl = canvas.toDataURL('image/png');
                        signaturePadData.value = dataUrl;

                        if (prevImg) {
                            prevImg.src = dataUrl;
                            prevImg.classList.remove('hidden');
                        }
                        if (removeCheck) removeCheck.checked = false;
                    }


                    // Mouse Listeners
                    canvas.addEventListener('mousedown', startDrawing);
                    canvas.addEventListener('mousemove', draw);
                    window.addEventListener('mouseup', stopDrawing);

                    // Touch Listeners
                    canvas.addEventListener('touchstart', startDrawing, { passive: false });
                    canvas.addEventListener('touchmove', draw, { passive: false });
                    window.addEventListener('touchend', stopDrawing);

                    // Button Controls
                    btnClearPad.addEventListener('click', clearCanvas);
                    btnUndoPad.addEventListener('click', function () {
                        history.pop();
                        redrawHistory();
                        if (history.length > 0) {
                            updateLivePreviewFromCanvas();
                        } else {
                            clearCanvas();
                        }
                    });

                    // Form Submit Handler
                    signatureForm.addEventListener('submit', function () {
                        if (hasDrawn && history.length > 0) {
                            signaturePadData.value = canvas.toDataURL('image/png');
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection