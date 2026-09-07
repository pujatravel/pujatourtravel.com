@extends('admin.layouts.app')

@section('title', 'Tanya Jawab (FAQ)')
@section('page-title', 'Manajemen Tanya Jawab (FAQ)')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left: FAQ List -->
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-display font-bold text-lg text-slate-900">Daftar Pertanyaan & Jawaban</h3>
                    <p class="text-xs text-slate-400">Pertanyaan ini tampil otomatis pada accordion landing page beranda.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-ocean-100 text-ocean-700">
                    Total: {{ $faqs->count() }} FAQ
                </span>
            </div>

            <div class="space-y-4">
                @forelse($faqs as $faq)
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/70 hover:border-ocean-300 transition duration-200">
                        <div class="flex items-start justify-between gap-4">
                            <div class="space-y-2 flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-lg bg-ocean-600 text-white text-xs font-bold flex items-center justify-center shrink-0">
                                        {{ $faq->display_order }}
                                    </span>
                                    <h4 class="font-display font-bold text-slate-900 text-sm sm:text-base leading-snug">
                                        {{ $faq->question }}
                                    </h4>
                                </div>
                                <p class="text-xs text-slate-600 leading-relaxed pl-8">
                                    {{ $faq->answer }}
                                </p>
                            </div>
                            <div class="flex items-center gap-1 shrink-0">
                                <!-- Edit Button triggers modal -->
                                <button type="button" onclick="openEditModal({{ $faq->id }}, '{{ addslashes($faq->question) }}', `{{ addslashes($faq->answer) }}`, {{ $faq->display_order }}, {{ $faq->is_published ? 'true' : 'false' }})" class="p-2 rounded-xl bg-slate-200 hover:bg-ocean-100 text-slate-700 hover:text-ocean-700 text-xs font-bold transition" title="Edit FAQ">
                                    ✏️
                                </button>
                                <!-- Delete Button -->
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
    function openEditModal(id, question, answer, order, isPublished) {
        const modal = document.getElementById('edit-faq-modal');
        const form = document.getElementById('edit-faq-form');
        const qInput = document.getElementById('edit-question');
        const aInput = document.getElementById('edit-answer');
        const oInput = document.getElementById('edit-order');

        form.action = `/admin/faqs/${id}`;
        qInput.value = question;
        aInput.value = answer;
        oInput.value = order;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('edit-faq-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
