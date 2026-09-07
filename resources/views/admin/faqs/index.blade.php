@extends('admin.layouts.app')

@section('title', 'Tanya Jawab (FAQ)')
@section('page-title', 'Manajemen Tanya Jawab (FAQ)')

@section('content')
<style>
    .faq-item { transition: box-shadow 0.15s, transform 0.15s; }
    .sortable-chosen { box-shadow: 0 8px 24px -4px rgba(4,120,87,0.2) !important; transform: scale(1.01); border-color: #047857 !important; background: #ecfdf5 !important; }
    .sortable-ghost  { opacity: 0.35; }
    .drag-handle     { cursor: grab; }
    .drag-handle:active { cursor: grabbing; }
</style>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left: FAQ List -->
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="font-display font-bold text-lg text-slate-900">Daftar Pertanyaan & Jawaban</h3>
                    <p class="text-xs text-slate-400">Pertanyaan ini tampil otomatis pada accordion landing page beranda.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                    Total: {{ $faqs->count() }} FAQ
                </span>
            </div>

            {{-- Drag hint --}}
            <div class="flex items-center gap-2 mb-5 mt-1 px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-600 font-medium">
                <i data-lucide="grip-vertical" class="w-4 h-4 text-slate-400 shrink-0"></i>
                <span>Seret baris item untuk mengubah urutan tampil. Tersimpan otomatis.</span>
                <span id="save-status" class="ml-auto font-bold" style="display:none;"></span>
            </div>

            <div id="faq-sortable" class="space-y-3">
                @forelse($faqs as $faq)
                    <div class="faq-item p-5 rounded-2xl bg-slate-50 border border-slate-200/70"
                         data-id="{{ $faq->id }}"
                         data-question="{{ $faq->question }}"
                         data-answer="{{ $faq->answer }}"
                         data-published="{{ $faq->is_published ? '1' : '0' }}">
                        <div class="flex items-start gap-3">
                            {{-- Drag Handle --}}
                            <div class="drag-handle flex items-center justify-center w-8 h-8 rounded-lg hover:bg-emerald-50 text-slate-400 hover:text-emerald-700 transition shrink-0 select-none mt-0.5"
                                 title="Seret untuk ubah urutan">
                                <i data-lucide="grip-vertical" class="w-4 h-4"></i>
                            </div>

                            {{-- Order Badge + Content --}}
                            <span class="order-badge w-6 h-6 rounded-lg bg-emerald-700 text-white text-xs font-bold flex items-center justify-center shrink-0 mt-1">
                                {{ $faq->display_order }}
                            </span>
                            <div class="space-y-1 flex-1 min-w-0">
                                <h4 class="font-display font-bold text-slate-900 text-sm sm:text-base leading-snug">
                                    {{ $faq->question }}
                                </h4>
                                <p class="text-xs text-slate-600 leading-relaxed line-clamp-2">
                                    {{ $faq->answer }}
                                </p>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-1.5 shrink-0">
                                <button type="button"
                                    onclick="openEditModal(this)"
                                    class="p-2 rounded-xl bg-white border border-slate-200 hover:bg-emerald-50 hover:text-emerald-700 text-slate-600 text-xs font-bold transition shadow-2xs"
                                    title="Edit FAQ">
                                    <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                </button>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus pertanyaan FAQ ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 rounded-xl bg-white border border-slate-200 hover:bg-rose-50 hover:text-rose-700 text-slate-600 text-xs font-bold transition shadow-2xs"
                                            title="Hapus FAQ">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-slate-400">
                        <i data-lucide="help-circle" class="w-10 h-10 mx-auto text-slate-300 mb-2"></i>
                        <p class="text-sm font-bold text-slate-600">Belum ada pertanyaan FAQ.</p>
                        <p class="text-xs mt-1">Tambahkan pertanyaan pertama Anda menggunakan formulir di samping.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right: Add FAQ Form -->
    <div class="lg:col-span-4">
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80 sticky top-24">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center font-bold">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-base text-slate-900 leading-snug">Tambah FAQ Baru</h3>
                    <p class="text-xs text-slate-400">Publikasi pertanyaan seputar trip</p>
                </div>
            </div>

            <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Pertanyaan *</label>
                    <input type="text" name="question" required
                           placeholder="Contoh: Apakah ada batas minimal usia?"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jawaban Lengkap *</label>
                    <textarea name="answer" rows="5" required
                              placeholder="Tuliskan jawaban yang ramah dan jelas..."
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor Urutan Tampil</label>
                    <input type="number" name="display_order"
                           value="{{ ($faqs->max('display_order') ?? 0) + 1 }}" min="1"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <button type="submit"
                        class="w-full py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition">
                    Simpan Pertanyaan FAQ
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Edit FAQ Modal -->
<div id="edit-faq-modal"
     class="fixed inset-0 z-50 bg-slate-950/70 hidden items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-white/60">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="font-display font-bold text-lg text-slate-900">Edit Pertanyaan FAQ</h3>
            <button onclick="closeEditModal()" class="p-1 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="edit-faq-form" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Pertanyaan *</label>
                <input type="text" id="edit-question" name="question" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jawaban *</label>
                <textarea id="edit-answer" name="answer" rows="5" required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor Urutan</label>
                <input type="number" id="edit-order" name="display_order" min="1"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()"
                        class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 font-bold text-xs transition">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SortableJS: loaded synchronously sebelum init code --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
(function () {
    // Tunggu DOM + SortableJS siap
    function initSortable() {
        var el = document.getElementById('faq-sortable');
        if (!el || typeof Sortable === 'undefined') {
            setTimeout(initSortable, 100);
            return;
        }

        Sortable.create(el, {
            handle: '.drag-handle',
            animation: 200,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',

            onEnd: function () {
                var items  = el.querySelectorAll('.faq-item');
                var order  = [];

                // Update badge numbers
                items.forEach(function (item, index) {
                    order.push(parseInt(item.dataset.id, 10));
                    var badge = item.querySelector('.order-badge');
                    if (badge) badge.textContent = index + 1;
                });

                // Show saving indicator
                var status = document.getElementById('save-status');
                status.textContent = 'Menyimpan urutan...';
                status.style.color = '#047857';
                status.style.display = 'inline';

                fetch('{{ route('admin.faqs.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ order: order }),
                })
                .then(function (res) {
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    return res.json();
                })
                .then(function () {
                    status.textContent = 'Urutan berhasil disimpan!';
                    status.style.color = '#047857';
                    setTimeout(function () { status.style.display = 'none'; }, 2500);
                })
                .catch(function (err) {
                    status.textContent = 'Gagal menyimpan: ' + err.message;
                    status.style.color = '#dc2626';
                });
            },
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSortable);
    } else {
        initSortable();
    }
}());

// ── Edit Modal ────────────────────────────────────────────────────────────────
function openEditModal(target, question, answer, order) {
    var id = target;
    if (target && typeof target === 'object' && target.closest) {
        var item = target.closest('.faq-item');
        if (item) {
            id = item.dataset.id;
            question = item.dataset.question;
            answer = item.dataset.answer;
            var badge = item.querySelector('.order-badge');
            order = badge ? badge.textContent.trim() : '1';
        }
    }

    document.getElementById('edit-faq-form').action = '/admin/faqs/' + id;
    document.getElementById('edit-question').value  = question || '';
    document.getElementById('edit-answer').value    = answer || '';
    document.getElementById('edit-order').value     = order || '1';

    var modal = document.getElementById('edit-faq-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    if (window.lucide && window.lucide.createIcons) {
        window.lucide.createIcons();
    }
}

function closeEditModal() {
    var modal = document.getElementById('edit-faq-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection
