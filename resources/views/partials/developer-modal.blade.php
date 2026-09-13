<!-- MODAL TIM PENGEMBANG WEBSITE (DEVELOPERS POP-UP) -->
<div id="developer-team-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="modal-dev-title">
    <!-- Backdrop Gelap Halus -->
    <div id="developer-modal-backdrop" class="fixed inset-0 bg-slate-950/85 backdrop-blur-sm transition-opacity duration-300 opacity-0 cursor-pointer"></div>

    <!-- Box Konten Modal -->
    <div id="developer-modal-box" class="relative bg-slate-900 text-slate-100 rounded-3xl p-6 sm:p-8 max-w-2xl w-full border border-slate-800 shadow-2xl z-10 transform transition-all duration-300 scale-95 opacity-0 my-auto overflow-hidden">
        <!-- Glow Efek Dekoratif -->
        <div class="absolute -top-24 -right-24 w-60 h-60 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-60 h-60 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Tombol Tutup Silang (X) -->
        <button type="button" id="btn-close-dev-modal" class="absolute top-5 right-5 w-9 h-9 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center transition cursor-pointer" aria-label="Tutup Informasi Pengembang">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <!-- Header Modal -->
        <div class="relative z-10 pr-10">
            <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold text-emerald-400 bg-emerald-950/80 border border-emerald-800/60 px-3 py-1 rounded-full shadow-2xs">
                <i data-lucide="code-2" class="w-3.5 h-3.5 text-emerald-400"></i>
                <span>Tim Pengembang Website</span>
            </span>
            <h3 id="modal-dev-title" class="font-display font-extrabold text-xl sm:text-2xl text-white mt-2.5 tracking-tight">
                Dibuat & Dikembangkan Oleh
            </h3>
            <p class="text-xs sm:text-sm text-slate-400 mt-1 leading-relaxed">
                Website resmi <strong class="text-emerald-400">Puja Tour & Travel Pangandaran</strong> dirancang dan dibangun dengan dedikasi tinggi oleh:
            </p>
        </div>

        <!-- Grid 3 Developer Cards -->
        <div class="relative z-10 grid grid-cols-1 sm:grid-cols-3 gap-3.5 sm:gap-4 mt-6">
            <!-- 1. Muhammad Fikri Haikal -->
            <div class="bg-slate-950/70 border border-slate-800 hover:border-emerald-500/50 rounded-2xl p-4 sm:p-4.5 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-emerald-950/40 group">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-linear-to-br from-emerald-500 to-teal-700 text-white font-display font-bold text-base flex items-center justify-center shrink-0 shadow-md shadow-emerald-900/30">
                            FH
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-display font-bold text-white text-sm truncate group-hover:text-emerald-300 transition">
                                Muhammad Fikri Haikal
                            </h4>
                            <span class="text-[10px] text-emerald-400 font-semibold block uppercase tracking-wider">
                                PPLG Developer
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tautan Kontak & Portofolio -->
                <div class="pt-3.5 mt-3.5 border-t border-slate-800/80 flex items-center justify-center gap-2">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/fikrii_haikalll17/" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="Instagram Muhammad Fikri Haikal">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                    <!-- GitHub -->
                    <a href="https://github.com/fikrihaikal17" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="GitHub Muhammad Fikri Haikal">
                        <i data-lucide="github" class="w-4 h-4"></i>
                    </a>
                    <!-- Email -->
                    <a href="mailto:fikrihaikal170308@gmail.com" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="Kirim Email ke Muhammad Fikri Haikal">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- 2. Putra Galuh -->
            <div class="bg-slate-950/70 border border-slate-800 hover:border-emerald-500/50 rounded-2xl p-4 sm:p-4.5 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-emerald-950/40 group">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-linear-to-br from-teal-500 to-emerald-700 text-white font-display font-bold text-base flex items-center justify-center shrink-0 shadow-md shadow-teal-900/30">
                            PG
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-display font-bold text-white text-sm truncate group-hover:text-emerald-300 transition">
                                Putra Galuh
                            </h4>
                            <span class="text-[10px] text-teal-400 font-semibold block uppercase tracking-wider">
                                PPLG Developer
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tautan Kontak & Portofolio -->
                <div class="pt-3.5 mt-3.5 border-t border-slate-800/80 flex items-center justify-center gap-2">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/_luhptraa28?stkn=MXU1Z3B6dDkwOG9rcQ==" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="Instagram Putra Galuh">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                    <!-- GitHub -->
                    <a href="https://github.com/Ptragaluhhh28" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="GitHub Putra Galuh">
                        <i data-lucide="github" class="w-4 h-4"></i>
                    </a>
                    <!-- Email -->
                    <a href="mailto:putragaluh2812@gmail.com" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="Kirim Email ke Putra Galuh">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- 3. Nabil Cahyadi -->
            <div class="bg-slate-950/70 border border-slate-800 hover:border-emerald-500/50 rounded-2xl p-4 sm:p-4.5 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-emerald-950/40 group">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-linear-to-br from-emerald-600 to-green-700 text-white font-display font-bold text-base flex items-center justify-center shrink-0 shadow-md shadow-emerald-900/30">
                            NC
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-display font-bold text-white text-sm truncate group-hover:text-emerald-300 transition">
                                Nabil Cahyadi
                            </h4>
                            <span class="text-[10px] text-green-400 font-semibold block uppercase tracking-wider">
                                PPLG Developer
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tautan Kontak & Portofolio -->
                <div class="pt-3.5 mt-3.5 border-t border-slate-800/80 flex items-center justify-center gap-2">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/nbilc_?stkn=NW16dmgzMGUxZDd6" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="Instagram Nabil Cahyadi">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                    <!-- GitHub -->
                    <a href="https://github.com/NabilCahyadi" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="GitHub Nabil Cahyadi">
                        <i data-lucide="github" class="w-4 h-4"></i>
                    </a>
                    <!-- Email -->
                    <a href="mailto:nabilcahyadi155@gmail.com" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center border border-slate-800 transition shadow-2xs" title="Kirim Email ke Nabil Cahyadi">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Modal -->
        <div class="relative z-10 mt-6 pt-5 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
            <div class="flex items-center gap-2 text-[11px] text-slate-400">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-400 shrink-0"></i>
                <span>Dikembangkan dengan Laravel & Tailwind CSS</span>
            </div>
            <button type="button" id="btn-dismiss-dev-modal" class="w-full sm:w-auto px-5 py-2 min-h-10 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold transition cursor-pointer">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Script Interaktif Modal Developer -->
<script>
(function() {
    function initDevModal() {
        var devModal = document.getElementById('developer-team-modal');
        var devBackdrop = document.getElementById('developer-modal-backdrop');
        var devBox = document.getElementById('developer-modal-box');
        var btnClose = document.getElementById('btn-close-dev-modal');
        var btnDismiss = document.getElementById('btn-dismiss-dev-modal');
        var triggers = document.querySelectorAll('.btn-open-dev-modal');

        if (!devModal) return;

        function openModal(e) {
            if (e) e.preventDefault();
            devModal.classList.remove('hidden');
            devModal.classList.add('flex');
            setTimeout(function() {
                if (devBackdrop) devBackdrop.classList.remove('opacity-0');
                if (devBox) {
                    devBox.classList.remove('scale-95', 'opacity-0');
                    devBox.classList.add('scale-100', 'opacity-100');
                }
            }, 20);
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }

        function closeModal() {
            if (devBackdrop) devBackdrop.classList.add('opacity-0');
            if (devBox) {
                devBox.classList.remove('scale-100', 'opacity-100');
                devBox.classList.add('scale-95', 'opacity-0');
            }
            setTimeout(function() {
                devModal.classList.remove('flex');
                devModal.classList.add('hidden');
            }, 300);
        }

        triggers.forEach(function(btn) {
            btn.addEventListener('click', openModal);
        });

        if (btnClose) btnClose.addEventListener('click', closeModal);
        if (btnDismiss) btnDismiss.addEventListener('click', closeModal);
        if (devBackdrop) devBackdrop.addEventListener('click', closeModal);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && devModal && !devModal.classList.contains('hidden')) {
                closeModal();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDevModal);
    } else {
        initDevModal();
    }
})();
</script>
