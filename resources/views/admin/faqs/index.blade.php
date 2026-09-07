@extends('admin.layouts.app')

@section('title', 'Tanya Jawab (FAQ)')
@section('page-title', 'Manajemen Tanya Jawab (FAQ)')

@section('content')
{{-- SortableJS CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left: FAQ List -->
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="font-display font-bold text-lg text-slate-900">Daftar Pertanyaan & Jawaban</h3>
                    <p class="text-xs text-slate-400">Pertanyaan ini tampil otomatis pada accordion landing page beranda.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-ocean-100 text-ocean-700">
                    Total: {{ $faqs->count() }} FAQ
                </span>
            </div>

            {{-- Drag hint --}}
            <div id="drag-hint" class="flex items-center gap-2 mb-5 mt-1 px-3 py-2 rounded-xl bg-ocean-50 border border-ocean-200/60 text-xs text-ocean-700 font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <span>Seret item untuk mengubah urutan tampil. Perubahan tersimpan otomatis.</span>
                <span id="save-status" class="ml-auto font-bold hidden"></span>
            </div>

            <div id="faq-sortable" class="space-y-3">
                @forelse($faqs as $faq)
                    <div class="faq-item p-5 rounded-2xl bg-slate-50 border border-slate-200/70 hover:border-ocean-300 transition duration-200 cursor-grab active:cursor-grabbing"
                         data-id="{{ $faq->id }}">
                        <div class="flex items-start gap-3">
                            {{-- Drag Handle --}}
                            <div class="drag-handle flex flex-col gap-1 pt-1 shrink-0 text-slate-300 hover:text-ocean-400 transition select-none" title="Seret untuk ubah urutan">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="9" cy="5" r="1.5"/><circle cx="15" cy="5" r="1.5"/>
                                    <circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/>
                                    <circle cx="9" cy="19" r="1.5"/><circle cx="15" cy="19" r="1.5"/>
                                </svg>
                            </div>

                            {{-- Order Badge + Content --}}
                            <div class="flex items-start gap-3 flex-1 min-w-0">
                                <span class="order-badge w-6 h-6 rounded-lg bg-ocean-600 text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
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
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-1 shrink-0">
                                <button type="button"
                                    onclick="openEditModal({{ $faq->id }}, '{{ addslashes($faq->question) }}', `{{ addslashes($faq->answer) }}`, {{ $faq->display_order }}, {{ $faq->is_published ? 'true' : 'false' }})"
                                    class="p-2 rounded-xl bg-slate-200 hover:bg-ocean-100 text-slate-700 hover:text-ocean-700 text-xs font-bold transition"
                                    title="Edit FAQ">
                                    ✏️
                                </button>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Hapus pertanyaan FAQ ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold transition" title="Hapus FAQ">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-slate-400">
                        <span class="text-3xl block mb-2">❓</span>
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
                <div class="w-10 h-10 rounded-xl bg-ocean-100 text-ocean-600 flex items-center justify-center font-bold text-lg">
                    ➕
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
                    <input type="text" name="question" required placeholder="Contoh: Apakah ada batas minimal usia?" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-ocean-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jawaban Lengkap *</label>
                    <textarea name="answer" rows="5" required placeholder="Tuliskan jawaban yang ramah dan jelas..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-ocean-500 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor Urutan Tampil</label>
                    <input type="number" name="display_order" value="{{ ($faqs->max('display_order') ?? 0) + 1 }}" min="1" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-ocean-500 outline-none">
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-ocean-600 hover:bg-ocean-700 text-white font-bold text-xs shadow-md transition">
                    Simpan Pertanyaan FAQ
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Edit FAQ Modal -->
<div id="edit-faq-modal" class="fixed inset-0 z-50 bg-slate-950/70 hidden items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-white/60">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="font-display font-bold text-lg text-slate-900">Edit Pertanyaan FAQ</h3>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-700 text-lg font-bold">&times;</button>
        </div>

        <form id="edit-faq-form" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Pertanyaan *</label>
                <input type="text" id="edit-question" name="question" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-ocean-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jawaban *</label>
                <textarea id="edit-answer" name="answer" rows="5" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white focus:ring-2 focus:ring-ocean-500 outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor Urutan</label>
                <input type="number" id="edit-order" name="display_order" min="1" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs bg-slate-50 focus:bg-white outline-none">
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 font-bold text-xs transition">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-ocean-600 hover:bg-ocean-700 text-white font-bold text-xs shadow-md transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // ── Edit Modal ──────────────────────────────────────────────────────────────
    function openEditModal(id, question, answer, order, isPublished) {
        document.getElementById('edit-faq-form').action = `/admin/faqs/${id}`;
        document.getElementById('edit-question').value = question;
        document.getElementById('edit-answer').value = answer;
        document.getElementById('edit-order').value = order;

        const modal = document.getElementById('edit-faq-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('edit-faq-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ── Drag & Drop Reorder (SortableJS) ───────────────────────────────────────
    const sortable = Sortable.create(document.getElementById('faq-sortable'), {
        handle: '.drag-handle',
        animation: 180,
        ghostClass: 'opacity-40',
        chosenClass: 'ring-2 ring-ocean-400 shadow-lg scale-[1.01]',
        dragClass: 'rotate-1',

        onEnd: function () {
            // Collect new order of IDs
            const items = document.querySelectorAll('#faq-sortable .faq-item');
            const order = Array.from(items).map(el => parseInt(el.dataset.id));

            // Update visible order badges
            items.forEach((el, index) => {
                const badge = el.querySelector('.order-badge');
                if (badge) badge.textContent = index + 1;
            });

            // Show saving indicator
            const status = document.getElementById('save-status');
            status.textContent = '⏳ Menyimpan...';
            status.className = 'ml-auto font-bold text-ocean-600';
            status.classList.remove('hidden');

            // POST new order to backend
            fetch('{{ route('admin.faqs.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ order }),
            })
            .then(res => {
                if (!res.ok) throw new Error('Server error');
                return res.json();
            })
            .then(() => {
                status.textContent = '✅ Tersimpan!';
                status.className = 'ml-auto font-bold text-emerald-600';
                setTimeout(() => status.classList.add('hidden'), 2500);
            })
            .catch(() => {
                status.textContent = '❌ Gagal menyimpan';
                status.className = 'ml-auto font-bold text-rose-600';
            });
        },
    });
</script>
@endsection
