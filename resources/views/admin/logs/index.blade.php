@extends('admin.layouts.app')

@section('page-title', 'Log Aktivitas & Audit Keamanan')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto pb-12">

    <!-- Top Header Banner -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-surface-soft p-6 rounded-3xl border border-neutral-200 shadow-soft">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-emerald-800">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
                <span>AUDIT TRAIL & KEAMANAN SISTEM</span>
            </div>
            <h2 class="font-display font-extrabold text-xl text-slate-900">
                Log Aktivitas Administrator
            </h2>
            <p class="text-xs text-slate-500">
                Pantau seluruh rekam jejak tindakan admin, otorisasi login, persetujuan (ACC), penambahan media, serta pelacakan IP dan lokasi secara real-time.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2.5 shrink-0">
            @if($isDeleteAuthorized)
                <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-bold shadow-2xs">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span>Sesi Hapus Terbuka ({{ $authRemainingMinutes }} Menit)</span>
                </div>
                <form method="POST" action="{{ route('admin.logs.lock') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-3.5 py-2 rounded-xl border border-neutral-200 bg-white hover:bg-neutral-100 text-slate-700 font-bold text-xs shadow-2xs transition flex items-center gap-1.5 cursor-pointer" title="Kunci kembali sesi otorisasi sekarang">
                        <i data-lucide="lock" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span>Kunci Sesi</span>
                    </button>
                </form>
            @else
                <div class="flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 border border-slate-200 text-slate-600 text-xs font-semibold shadow-2xs">
                    <i data-lucide="shield-alert" class="w-3.5 h-3.5 text-amber-600"></i>
                    <span>Proteksi Hapus (Perlu Password)</span>
                </div>
            @endif

            <button type="button" onclick="openClearLogsModal()"
                class="px-4 py-2.5 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs shadow-2xs transition flex items-center gap-2 cursor-pointer">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
                <span>Bersihkan Log</span>
            </button>
        </div>
    </div>

    <!-- Stat Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-surface-soft p-5 rounded-2xl border border-neutral-200 shadow-soft flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 border border-blue-100 flex items-center justify-center shrink-0">
                <i data-lucide="history" class="w-6 h-6"></i>
            </div>
            <div class="min-w-0">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Aktivitas</span>
                <span class="text-xl font-extrabold text-slate-900">{{ number_format($totalLogs) }}</span>
            </div>
        </div>

        <div class="bg-surface-soft p-5 rounded-2xl border border-neutral-200 shadow-soft flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center shrink-0">
                <i data-lucide="calendar" class="w-6 h-6"></i>
            </div>
            <div class="min-w-0">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Hari Ini</span>
                <span class="text-xl font-extrabold text-slate-900">{{ number_format($todayLogs) }}</span>
            </div>
        </div>

        <div class="bg-surface-soft p-5 rounded-2xl border border-neutral-200 shadow-soft flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-700 border border-teal-100 flex items-center justify-center shrink-0">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
            <div class="min-w-0">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Persetujuan (ACC)</span>
                <span class="text-xl font-extrabold text-slate-900">{{ number_format($approveLogs) }}</span>
            </div>
        </div>

        <div class="bg-surface-soft p-5 rounded-2xl border border-neutral-200 shadow-soft flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-700 border border-purple-100 flex items-center justify-center shrink-0">
                <i data-lucide="key" class="w-6 h-6"></i>
            </div>
            <div class="min-w-0">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Sesi Autentikasi</span>
                <span class="text-xl font-extrabold text-slate-900">{{ number_format($authLogs) }}</span>
            </div>
        </div>
    </div>

    <!-- Filter & Search Controls -->
    <div class="bg-surface-soft p-5 rounded-3xl border border-neutral-200 shadow-soft">
        <form method="GET" action="{{ route('admin.logs.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3.5 items-end">
            <!-- Search Keyword -->
            <div class="lg:col-span-4">
                <label for="filter-search" class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Pencarian</label>
                <div class="relative">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="search" id="filter-search" value="{{ request('search') }}"
                        placeholder="Cari deskripsi, admin, IP, atau kota..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none transition">
                </div>
            </div>

            <!-- Filter Modul -->
            <div class="lg:col-span-3">
                <label for="filter-module" class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Modul</label>
                <select name="module" id="filter-module"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none transition">
                    <option value="all">Semua Modul</option>
                    @foreach($availableModules as $mod)
                        <option value="{{ $mod }}" {{ request('module') === $mod ? 'selected' : '' }}>{{ $mod }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Aksi -->
            <div class="lg:col-span-2">
                <label for="filter-action" class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Aksi</label>
                <select name="action" id="filter-action"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none transition">
                    <option value="all">Semua Aksi</option>
                    @foreach($availableActions as $act)
                        <option value="{{ $act }}" {{ strtoupper(request('action', '')) === strtoupper($act) ? 'selected' : '' }}>{{ $act }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Periode -->
            <div class="lg:col-span-2">
                <label for="filter-period" class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Periode</label>
                <select name="period" id="filter-period"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 outline-none transition">
                    <option value="">Semua Waktu</option>
                    <option value="today" {{ request('period') === 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="week" {{ request('period') === 'week' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="month" {{ request('period') === 'month' ? 'selected' : '' }}>30 Hari Terakhir</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="lg:col-span-1 flex items-center gap-2">
                <button type="submit"
                    class="w-full py-2.5 px-3.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs rounded-xl shadow-xs transition flex items-center justify-center gap-1 cursor-pointer"
                    title="Terapkan Filter">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                    <span>Cari</span>
                </button>
                @if(request()->anyFilled(['search', 'module', 'action', 'period']))
                    <a href="{{ route('admin.logs.index') }}"
                        class="p-2.5 rounded-xl border border-neutral-200 bg-white hover:bg-neutral-100 text-slate-500 hover:text-slate-800 transition shrink-0"
                        title="Reset Filter">
                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Logs Table Container -->
    <div class="bg-surface-soft rounded-3xl border border-neutral-200 shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700 border-collapse">
                <thead>
                    <tr class="bg-neutral-100/70 border-b border-neutral-200 text-slate-600 font-bold uppercase tracking-wider text-[10px]">
                        <th class="py-3.5 px-4 sm:px-6 w-44">Waktu</th>
                        <th class="py-3.5 px-4 w-44">Administrator</th>
                        <th class="py-3.5 px-4 w-40">Modul & Aksi</th>
                        <th class="py-3.5 px-4 min-w-60">Keterangan Aktivitas</th>
                        <th class="py-3.5 px-4 w-52">IP & Lokasi</th>
                        <th class="py-3.5 px-4 w-16 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200">
                    @forelse($logs as $log)
                        <tr class="hover:bg-neutral-50/80 transition group">
                            <!-- Waktu -->
                            <td class="py-4 px-4 sm:px-6 whitespace-nowrap">
                                <span class="font-bold text-slate-900 block">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                <span class="text-[10px] text-slate-400 block">{{ $log->created_at->diffForHumans() }}</span>
                            </td>

                            <!-- Administrator -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-emerald-700 text-white font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ substr($log->user_name ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="truncate max-w-32.5">
                                        <span class="font-bold text-slate-900 block truncate">{{ $log->user_name ?? 'Administrator' }}</span>
                                        <span class="text-[10px] text-slate-400 block truncate">{{ $log->user?->email ?? ($log->user?->username ?? 'ID: ' . ($log->user_id ?? '-')) }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Modul & Aksi -->
                            <td class="py-4 px-4 whitespace-nowrap space-y-1">
                                <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-bold bg-neutral-100 text-slate-700 border border-neutral-200">
                                    {{ $log->module }}
                                </span>
                                <div>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold border {{ $log->action_badge_class }}">
                                        <i data-lucide="{{ $log->action_icon }}" class="w-3 h-3"></i>
                                        <span>{{ $log->action }}</span>
                                    </span>
                                </div>
                            </td>

                            <!-- Keterangan Aktivitas -->
                            <td class="py-4 px-4">
                                <p class="text-xs text-slate-800 font-medium leading-relaxed">{{ $log->description }}</p>
                                @if(!empty($log->properties))
                                    <div class="mt-1">
                                        <button type="button" onclick="showLogDetails({{ json_encode($log->properties) }}, '{{ addslashes($log->description) }}')"
                                            class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 hover:text-emerald-800 hover:underline cursor-pointer">
                                            <i data-lucide="code" class="w-3 h-3"></i>
                                            <span>Rincian Payload Data</span>
                                        </button>
                                    </div>
                                @endif
                            </td>

                            <!-- IP & Lokasi -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-1.5">
                                        <code class="px-1.5 py-0.5 rounded bg-slate-100 border border-slate-200 text-[11px] font-mono text-slate-800 font-bold select-all">
                                            {{ $log->ip_address ?? '127.0.0.1' }}
                                        </code>
                                    </div>
                                    <div class="flex items-center gap-1 text-[10px] text-slate-500" title="{{ $log->location }}">
                                        <i data-lucide="map-pin" class="w-3 h-3 text-emerald-600 shrink-0"></i>
                                        <span class="truncate max-w-37.5 font-medium">{{ $log->location ?? 'Lokasi Lokal' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1 text-[10px] text-slate-400" title="{{ $log->device }}">
                                        <i data-lucide="monitor" class="w-3 h-3 shrink-0"></i>
                                        <span class="truncate max-w-37.5">{{ $log->device ?? 'Browser' }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Opsi Hapus Log Individual -->
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                @if($isDeleteAuthorized)
                                    <form method="POST" action="{{ route('admin.logs.destroy', $log) }}" onsubmit="return confirm('Hapus catatan log aktivitas ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus catatan ini (Sesi aktif {{ $authRemainingMinutes }} mnt)"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition cursor-pointer">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                @else
                                    <button type="button" 
                                        onclick="openSingleDeleteModal('{{ route('admin.logs.destroy', $log) }}', '{{ $log->id }}', '{{ addslashes($log->description) }}')"
                                        title="Hapus catatan ini (Perlu password admin)"
                                        class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition cursor-pointer">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <div class="w-12 h-12 mx-auto rounded-2xl bg-neutral-100 flex items-center justify-center text-slate-400 mb-3">
                                    <i data-lucide="inbox" class="w-6 h-6"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-700">Belum ada riwayat aktivitas yang tercatat.</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Seluruh tindakan administratif akan muncul di sini secara otomatis.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
            <div class="p-4 border-t border-neutral-200 bg-white">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Reusable Payload Detail Modal -->
<div id="log-payload-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs transition-all duration-300 opacity-0 pointer-events-none">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 transform scale-95 transition-all duration-300 space-y-4 text-left">
        <div class="flex items-center justify-between border-b border-neutral-200 pb-3">
            <h3 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                <i data-lucide="file-json" class="w-5 h-5 text-emerald-700"></i>
                <span>Rincian Payload Log</span>
            </h3>
            <button type="button" onclick="closeLogDetailsModal()" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <p id="modal-log-desc" class="text-xs text-slate-600 font-medium"></p>
        <pre id="modal-log-json" class="p-3.5 bg-slate-900 text-emerald-400 rounded-xl text-xs font-mono overflow-x-auto max-h-72 border border-slate-800"></pre>
        <div class="flex justify-end pt-2">
            <button type="button" onclick="closeLogDetailsModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition cursor-pointer">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Modal Verifikasi Hapus Log Individual (Jika Sesi 30 Menit Belum Terbuka) -->
<div id="single-delete-log-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs transition-all duration-300 opacity-0 pointer-events-none">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform scale-95 transition-all duration-300 space-y-4 text-left">
        <div class="flex items-start gap-3.5 border-b border-neutral-200 pb-3.5">
            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 flex items-center justify-center shrink-0">
                <i data-lucide="shield-alert" class="w-5 h-5"></i>
            </div>
            <div class="min-w-0 flex-1">
                <h3 class="font-display font-bold text-base text-slate-900">Verifikasi Keamanan Hapus Log</h3>
                <p class="text-xs text-slate-500 mt-0.5">Masukkan password akun admin Anda untuk mengonfirmasi penghapusan.</p>
            </div>
            <button type="button" onclick="closeSingleDeleteModal()" class="p-1 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <form id="single-delete-form" method="POST" action="" class="space-y-4">
            @csrf
            @method('DELETE')

            <div class="p-3.5 bg-neutral-50 rounded-2xl border border-neutral-200 space-y-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Catatan yang akan dihapus:</span>
                <p id="single-delete-desc" class="text-xs font-semibold text-slate-800 line-clamp-2 leading-relaxed"></p>
                <span id="single-delete-id" class="text-[10px] text-slate-500 font-mono block"></span>
            </div>

            <div class="p-3 bg-emerald-50/70 border border-emerald-200 rounded-xl flex items-start gap-2.5 text-emerald-800">
                <i data-lucide="clock-4" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                <p class="text-[11px] leading-relaxed text-emerald-800 font-medium">
                    Setelah diverifikasi, sesi otorisasi akan otomatis aktif selama <strong>30 menit</strong> ke depan sehingga Anda tidak perlu memasukkan password lagi untuk menghapus log berikutnya.
                </p>
            </div>

            <div class="space-y-1.5">
                <label for="single-admin-password" class="block text-xs font-bold text-slate-700">
                    Password Administrator <span class="text-rose-600">*</span>
                </label>
                <div class="relative">
                    <i data-lucide="key" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input type="password" name="admin_password" id="single-admin-password" required
                        placeholder="Masukkan password akun admin Anda..."
                        class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition">
                    <button type="button" onclick="togglePasswordVisibility('single-admin-password', 'single-pwd-icon')"
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 p-1 cursor-pointer"
                        title="Lihat / Sembunyikan Password">
                        <i data-lucide="eye" id="single-pwd-icon" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-2 border-t border-neutral-200">
                <button type="button" onclick="closeSingleDeleteModal()" class="px-4 py-2.5 rounded-xl border border-neutral-200 bg-white hover:bg-neutral-50 text-slate-700 font-bold text-xs transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    <span>Verifikasi & Hapus</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Bersihkan Log -->
<div id="clear-logs-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs transition-all duration-300 opacity-0 pointer-events-none">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform scale-95 transition-all duration-300 space-y-5 text-left">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                <i data-lucide="trash-2" class="w-6 h-6"></i>
            </div>
            <div class="space-y-1 min-w-0 flex-1">
                <h3 class="font-display font-bold text-base text-slate-900">Bersihkan Riwayat Log</h3>
                <p class="text-xs text-slate-500">Pilih rentang data log yang ingin dihapus untuk mengoptimalkan ruang penyimpanan:</p>
            </div>
            <button type="button" onclick="closeClearLogsModal()" class="p-1 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('admin.logs.clear') }}" class="space-y-4">
            @csrf
            @method('DELETE')

            @if($isDeleteAuthorized)
                <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-2.5 text-emerald-800">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                    <div class="text-xs">
                        <span class="font-bold block">Sesi Otorisasi Aktif ({{ $authRemainingMinutes }} Menit Tersisa)</span>
                        <span class="text-[11px] text-emerald-700 leading-snug block mt-0.5">
                            Pembersihan log dapat dieksekusi langsung tanpa verifikasi password ulang selama durasi sesi aktif.
                        </span>
                    </div>
                </div>
            @else
                <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-2.5 text-amber-900">
                    <i data-lucide="shield-alert" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                    <div class="text-xs">
                        <span class="font-bold block">Proteksi Password Keamanan</span>
                        <span class="text-[11px] text-amber-700 leading-snug block mt-0.5">
                            Masukkan password admin Anda untuk otorisasi. Setelah berhasil, sesi akan dibuka selama <strong>30 menit</strong> ke depan.
                        </span>
                    </div>
                </div>
            @endif

            <div class="space-y-2">
                <label class="flex items-center gap-3 p-3 rounded-xl border border-neutral-200 hover:bg-neutral-50 cursor-pointer transition">
                    <input type="radio" name="mode" value="older_than_30_days" checked class="text-emerald-700 focus:ring-emerald-700">
                    <div>
                        <span class="text-xs font-bold text-slate-800 block">Hapus log lebih dari 30 hari</span>
                        <span class="text-[10px] text-slate-400">Rekomendasi: mempertahankan catatan riwayat bulan ini</span>
                    </div>
                </label>

                <label class="flex items-center gap-3 p-3 rounded-xl border border-rose-200 bg-rose-50/50 hover:bg-rose-50 cursor-pointer transition">
                    <input type="radio" name="mode" value="all" class="text-rose-600 focus:ring-rose-500">
                    <div>
                        <span class="text-xs font-bold text-rose-800 block">Hapus seluruh riwayat log</span>
                        <span class="text-[10px] text-rose-500">Semua catatan audit akan dibersihkan tanpa sisa</span>
                    </div>
                </label>
            </div>

            @if(!$isDeleteAuthorized)
                <div class="space-y-1.5">
                    <label for="clear-admin-password" class="block text-xs font-bold text-slate-700">
                        Password Administrator <span class="text-rose-600">*</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="key" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input type="password" name="admin_password" id="clear-admin-password" required
                            placeholder="Masukkan password akun admin Anda..."
                            class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition">
                        <button type="button" onclick="togglePasswordVisibility('clear-admin-password', 'clear-pwd-icon')"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 p-1 cursor-pointer"
                            title="Lihat / Sembunyikan Password">
                            <i data-lucide="eye" id="clear-pwd-icon" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            @endif

            <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-neutral-200">
                <button type="button" onclick="closeClearLogsModal()" class="px-4 py-2.5 rounded-xl border border-neutral-200 bg-white hover:bg-neutral-50 text-slate-700 font-bold text-xs transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                    <span>Eksekusi Pembersihan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showLogDetails(properties, desc) {
        document.getElementById('modal-log-desc').textContent = desc;
        document.getElementById('modal-log-json').textContent = JSON.stringify(properties, null, 2);
        const modal = document.getElementById('log-payload-modal');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');
        if (window.lucide) lucide.createIcons();
    }

    function closeLogDetailsModal() {
        const modal = document.getElementById('log-payload-modal');
        if (modal) {
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.querySelector('.transform').classList.remove('scale-100');
            modal.querySelector('.transform').classList.add('scale-95');
        }
    }

    function openSingleDeleteModal(actionUrl, logId, logDesc) {
        const form = document.getElementById('single-delete-form');
        const descEl = document.getElementById('single-delete-desc');
        const idEl = document.getElementById('single-delete-id');
        const passInput = document.getElementById('single-admin-password');

        if (form) form.action = actionUrl;
        if (descEl) descEl.textContent = logDesc;
        if (idEl) idEl.textContent = 'ID Log: #' + logId;
        if (passInput) {
            passInput.value = '';
            setTimeout(() => passInput.focus(), 150);
        }

        const modal = document.getElementById('single-delete-log-modal');
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
        }
        if (window.lucide) lucide.createIcons();
    }

    function closeSingleDeleteModal() {
        const modal = document.getElementById('single-delete-log-modal');
        if (modal) {
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.querySelector('.transform').classList.remove('scale-100');
            modal.querySelector('.transform').classList.add('scale-95');
        }
    }

    function openClearLogsModal() {
        const modal = document.getElementById('clear-logs-modal');
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
            const passInput = document.getElementById('clear-admin-password');
            if (passInput) {
                passInput.value = '';
                setTimeout(() => passInput.focus(), 150);
            }
        }
        if (window.lucide) lucide.createIcons();
    }

    function closeClearLogsModal() {
        const modal = document.getElementById('clear-logs-modal');
        if (modal) {
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.querySelector('.transform').classList.remove('scale-100');
            modal.querySelector('.transform').classList.add('scale-95');
        }
    }

    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input) return;

        if (input.type === 'password') {
            input.type = 'text';
            if (icon) icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            if (icon) icon.setAttribute('data-lucide', 'eye');
        }
        if (window.lucide) lucide.createIcons();
    }

    // Tutup modal jika klik di luar area dialog
    ['log-payload-modal', 'single-delete-log-modal', 'clear-logs-modal'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('click', function(e) {
                if (e.target === this) {
                    if (id === 'log-payload-modal') closeLogDetailsModal();
                    if (id === 'single-delete-log-modal') closeSingleDeleteModal();
                    if (id === 'clear-logs-modal') closeClearLogsModal();
                }
            });
        }
    });
</script>
@endsection
