@extends('admin.layouts.app')

@section('title', 'Manajemen Invoice & Tagihan')
@section('page-title', 'Manajemen Invoice & Tagihan Wisata')

@section('content')
<div class="space-y-6">
    <!-- Top Statistics Cards (2 Columns on Mobile) -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <!-- Card 1: Total Invoices -->
        <div class="bg-surface-soft p-3.5 sm:p-5 rounded-2xl sm:rounded-3xl border border-neutral-200 shadow-soft flex items-center justify-between min-w-0">
            <div class="min-w-0 flex-1 pr-1">
                <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400 block truncate">Total Invoice</span>
                <h3 class="font-display font-extrabold text-xl sm:text-2xl text-slate-900 leading-tight">{{ number_format($stats['total_count']) }}</h3>
                <div class="flex items-center gap-1.5 text-[9px] sm:text-[10px] font-semibold text-slate-500 mt-0.5 sm:mt-1 truncate">
                    <span class="text-emerald-700 font-bold">{{ $stats['paid_count'] }} Lunas</span> •
                    <span class="text-amber-700 font-bold">{{ $stats['partial_count'] }} DP</span>
                </div>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100">
                <i data-lucide="receipt" class="w-5 h-5 sm:w-6 sm:h-6"></i>
            </div>
        </div>

        <!-- Card 2: Total Nilai Tagihan -->
        <div class="bg-surface-soft p-3.5 sm:p-5 rounded-2xl sm:rounded-3xl border border-neutral-200 shadow-soft flex items-center justify-between min-w-0">
            <div class="min-w-0 flex-1 pr-1">
                <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400 block truncate">Total Tagihan</span>
                <h3 class="font-display font-extrabold text-lg sm:text-2xl text-slate-900 leading-tight truncate">Rp {{ number_format($stats['total_amount'], 0, ',', '.') }}</h3>
                <span class="text-[9px] sm:text-[10px] text-slate-500 font-medium mt-0.5 block truncate">Akumulasi transaksi</span>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0 border border-blue-100">
                <i data-lucide="credit-card" class="w-5 h-5 sm:w-6 sm:h-6"></i>
            </div>
        </div>

        <!-- Card 3: Total Terbayar -->
        <div class="bg-surface-soft p-3.5 sm:p-5 rounded-2xl sm:rounded-3xl border border-neutral-200 shadow-soft flex items-center justify-between min-w-0">
            <div class="min-w-0 flex-1 pr-1">
                <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400 block truncate">Terbayar</span>
                <h3 class="font-display font-extrabold text-lg sm:text-2xl text-emerald-700 leading-tight truncate">Rp {{ number_format($stats['total_paid'], 0, ',', '.') }}</h3>
                <span class="text-[9px] sm:text-[10px] text-emerald-800 font-medium mt-0.5 block truncate">DP + Pelunasan</span>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100">
                <i data-lucide="check-circle" class="w-5 h-5 sm:w-6 sm:h-6"></i>
            </div>
        </div>

        <!-- Card 4: Sisa Piutang -->
        <div class="bg-surface-soft p-3.5 sm:p-5 rounded-2xl sm:rounded-3xl border border-neutral-200 shadow-soft flex items-center justify-between min-w-0">
            <div class="min-w-0 flex-1 pr-1">
                <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400 block truncate">Sisa Piutang</span>
                <h3 class="font-display font-extrabold text-lg sm:text-2xl text-rose-600 leading-tight truncate">Rp {{ number_format($stats['total_remaining'], 0, ',', '.') }}</h3>
                <span class="text-[9px] sm:text-[10px] text-rose-700 font-medium mt-0.5 block truncate">Belum lunas</span>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 border border-rose-100">
                <i data-lucide="clock" class="w-5 h-5 sm:w-6 sm:h-6"></i>
            </div>
        </div>
    </div>

    <!-- Header Actions & Search Filter -->
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3.5 bg-surface-soft p-4 sm:p-5 rounded-3xl border border-neutral-200 shadow-soft">
        <!-- Search & Filter Form -->
        <form action="{{ route('admin.invoices.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 flex-1">
            <div class="relative flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no. invoice, nama, HP, paket..." class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 outline-none">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute right-3 top-3 pointer-events-none"></i>
            </div>

            <div class="flex items-center gap-2">
                <select name="status" onchange="this.form.submit()" class="flex-1 sm:flex-none px-3 py-2.5 rounded-xl border border-neutral-200 text-xs bg-canvas focus:bg-white outline-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="PAID" {{ request('status') === 'PAID' ? 'selected' : '' }}>🟢 Lunas</option>
                    <option value="PARTIAL" {{ request('status') === 'PARTIAL' ? 'selected' : '' }}>🟡 DP (Uang Muka)</option>
                    <option value="UNPAID" {{ request('status') === 'UNPAID' ? 'selected' : '' }}>🔴 Belum Bayar</option>
                    <option value="CANCELLED" {{ request('status') === 'CANCELLED' ? 'selected' : '' }}>⚪ Dibatalkan</option>
                </select>

                <button type="submit" class="px-4 py-2.5 bg-slate-900 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition shrink-0">
                    Filter
                </button>

                @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                    <a href="{{ route('admin.invoices.index') }}" class="px-3 py-2.5 text-xs font-semibold text-slate-500 hover:text-slate-900 transition shrink-0">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <!-- Create Button -->
        <a href="{{ route('admin.invoices.create') }}" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition flex items-center justify-center gap-2 whitespace-nowrap">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Buat Invoice Baru</span>
        </a>
    </div>

    <!-- Invoice Table & Mobile Card View -->
    <div class="bg-surface-soft rounded-3xl shadow-soft border border-neutral-200 overflow-hidden">
        <!-- Mobile Cards View (< md) -->
        <div class="block md:hidden divide-y divide-neutral-200">
            @forelse($invoices as $inv)
                <div class="p-4 bg-white space-y-3">
                    <!-- Top: Invoice No, Status & Actions -->
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.invoices.show', $inv->id) }}" class="font-bold text-slate-900 hover:text-emerald-700 font-mono text-sm block truncate">
                                    {{ $inv->invoice_number }}
                                </a>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold border shrink-0 {{ $inv->status_badge_class }}">
                                    <span>{{ $inv->status_label }}</span>
                                </span>
                            </div>
                            <div class="flex items-center gap-1 text-[11px] text-slate-400 mt-0.5">
                                <i data-lucide="calendar" class="w-3 h-3 text-slate-400"></i>
                                <span>{{ $inv->invoice_date ? $inv->invoice_date->format('d M Y') : '-' }}</span>
                            </div>
                        </div>

                        <!-- Action Dropdown Menu -->
                        <div class="relative shrink-0 dropdown-action-menu">
                            <button type="button" 
                                    onclick="toggleActionDropdown(event, this)" 
                                    class="p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition border border-slate-200/80 cursor-pointer focus:outline-none" 
                                    title="Opsi Aksi">
                                <i data-lucide="more-vertical" class="w-4 h-4"></i>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 mt-1 w-44 bg-white rounded-2xl shadow-xl border border-neutral-200 py-1.5 z-40 text-left">
                                <a href="{{ route('admin.invoices.show', $inv->id) }}" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                    <i data-lucide="eye" class="w-4 h-4 text-slate-400"></i>
                                    <span>Lihat Detail</span>
                                </a>
                                <a href="{{ route('admin.invoices.print', $inv->id) }}" target="_blank" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                    <i data-lucide="printer" class="w-4 h-4 text-slate-400"></i>
                                    <span>Cetak / Unduh PDF</span>
                                </a>
                                <a href="{{ $inv->whatsapp_share_url }}" target="_blank" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-emerald-700 hover:bg-emerald-50 transition">
                                    <i data-lucide="send" class="w-4 h-4 text-emerald-600"></i>
                                    <span>Kirim ke WhatsApp</span>
                                </a>
                                <a href="{{ route('admin.invoices.edit', $inv->id) }}" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                    <i data-lucide="pencil" class="w-4 h-4 text-slate-400"></i>
                                    <span>Edit Invoice</span>
                                </a>
                                <div class="my-1 border-t border-slate-100"></div>
                                <form action="{{ route('admin.invoices.destroy', $inv->id) }}" method="POST" onsubmit="confirmDelete(event, 'Apakah Anda yakin ingin menghapus invoice {{ $inv->invoice_number }} atas nama {{ addslashes($inv->customer_name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition text-left cursor-pointer">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-rose-500"></i>
                                        <span>Hapus Invoice</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Customer & Package Info -->
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/60 space-y-1">
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-bold text-slate-900 text-xs truncate">{{ $inv->customer_name }}</span>
                            <a href="https://wa.me/{{ $inv->clean_phone }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] text-emerald-700 hover:underline shrink-0 font-medium">
                                <i data-lucide="message-circle" class="w-3 h-3"></i>
                                <span>{{ $inv->customer_phone }}</span>
                            </a>
                        </div>
                        <p class="text-xs text-slate-600 font-medium truncate">
                            {{ $inv->package_name ?? ($inv->package->name ?? ($inv->items->first()->item_name ?? 'Layanan Wisata')) }}
                        </p>
                        <div class="flex items-center gap-2 text-[10px] text-slate-500 pt-0.5">
                            <span>👥 {{ $inv->pax_count }} Pax</span>
                            @if($inv->travel_date)
                                <span>• 🌴 {{ $inv->travel_date->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Financial Summary Row -->
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2 text-xs">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-medium">Total Tagihan</span>
                            <span class="font-extrabold text-slate-900 text-sm block">{{ $inv->formatted_total }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] text-slate-400 block font-medium">Terbayar / Sisa</span>
                            <div class="flex items-center gap-1.5 justify-end">
                                <span class="font-bold text-emerald-700 text-xs">Masuk: {{ $inv->formatted_paid }}</span>
                                @if($inv->remaining_amount > 0 && $inv->status !== 'CANCELLED')
                                    <span class="text-slate-300">•</span>
                                    <span class="font-extrabold text-rose-600 text-xs">Sisa: {{ $inv->formatted_remaining }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400 text-xs">
                    <div class="max-w-sm mx-auto space-y-3">
                        <div class="w-12 h-12 rounded-2xl bg-neutral-100 text-slate-400 flex items-center justify-center mx-auto">
                            <i data-lucide="file-x" class="w-6 h-6"></i>
                        </div>
                        <p class="font-bold text-slate-700 text-sm">Belum Ada Invoice</p>
                        <p class="text-xs text-slate-400">Mulai buat invoice baru untuk pelanggan tour & travel Anda.</p>
                        <a href="{{ route('admin.invoices.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-700 text-white font-bold text-xs hover:bg-emerald-800 transition">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Buat Invoice Pertama</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Desktop Table View (>= md) -->
        <div class="hidden md:block overflow-x-auto min-h-[380px]">
            <table class="w-full text-left text-xs min-w-[750px]">
                <thead>
                    <tr class="bg-canvas text-slate-500 font-bold uppercase tracking-wider border-b border-neutral-200">
                        <th class="p-4">No. Invoice & Tanggal</th>
                        <th class="p-4">Pelanggan / Kontak</th>
                        <th class="p-4">Paket / Layanan Wisata</th>
                        <th class="p-4">Total Tagihan</th>
                        <th class="p-4">Terbayar / Sisa</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 text-slate-700 font-medium">
                    @forelse($invoices as $inv)
                        <tr class="hover:bg-canvas transition">
                            <!-- No. Invoice & Date -->
                            <td class="p-4">
                                <div class="space-y-0.5">
                                    <a href="{{ route('admin.invoices.show', $inv->id) }}" class="font-bold text-slate-900 hover:text-emerald-700 font-mono text-sm block">
                                        {{ $inv->invoice_number }}
                                    </a>
                                    <div class="flex items-center gap-1.5 text-[11px] text-slate-400">
                                        <i data-lucide="calendar" class="w-3 h-3 text-slate-400"></i>
                                        <span>{{ $inv->invoice_date ? $inv->invoice_date->format('d M Y') : '-' }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Customer Info -->
                            <td class="p-4">
                                <div class="space-y-0.5">
                                    <span class="font-bold text-slate-900 text-sm block">{{ $inv->customer_name }}</span>
                                    <a href="https://wa.me/{{ $inv->clean_phone }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] text-emerald-700 hover:underline">
                                        <i data-lucide="message-circle" class="w-3 h-3"></i>
                                        <span>{{ $inv->customer_phone }}</span>
                                    </a>
                                </div>
                            </td>

                            <!-- Package / Details -->
                            <td class="p-4">
                                <div class="space-y-0.5 max-w-[200px]">
                                    <span class="font-semibold text-slate-800 text-xs line-clamp-1">
                                        {{ $inv->package_name ?? ($inv->package->name ?? ($inv->items->first()->item_name ?? 'Layanan Wisata')) }}
                                    </span>
                                    <div class="flex items-center gap-2 text-[11px] text-slate-500">
                                        <span>👥 {{ $inv->pax_count }} Pax</span>
                                        @if($inv->travel_date)
                                            <span>• 🌴 {{ $inv->travel_date->format('d/m/Y') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Total Amount -->
                            <td class="p-4 whitespace-nowrap">
                                <span class="font-bold text-slate-900 text-sm block">{{ $inv->formatted_total }}</span>
                                @if($inv->discount > 0)
                                    <span class="text-[10px] text-rose-600 font-medium">Diskon: {{ $inv->formatted_discount }}</span>
                                @endif
                            </td>

                            <!-- Paid & Remaining -->
                            <td class="p-4 whitespace-nowrap">
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-1.5 text-xs">
                                        <span class="text-slate-400">Masuk:</span>
                                        <span class="font-semibold text-emerald-700">{{ $inv->formatted_paid }}</span>
                                    </div>
                                    @if($inv->remaining_amount > 0 && $inv->status !== 'CANCELLED')
                                        <div class="flex items-center gap-1.5 text-[11px]">
                                            <span class="text-slate-400">Sisa:</span>
                                            <span class="font-bold text-rose-600">{{ $inv->formatted_remaining }}</span>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="p-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $inv->status_badge_class }}">
                                    @if($inv->status === 'PAID')
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    @elseif($inv->status === 'PARTIAL')
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    @elseif($inv->status === 'CANCELLED')
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    @else
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    @endif
                                    <span>{{ $inv->status_label }}</span>
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="p-4 text-right whitespace-nowrap">
                                <div class="relative inline-block text-left dropdown-action-menu">
                                    <button type="button" 
                                            onclick="toggleActionDropdown(event, this)" 
                                            class="p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-200/60 transition border border-transparent hover:border-slate-300/60 cursor-pointer focus:outline-none" 
                                            title="Opsi Aksi">
                                        <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                    </button>
                                    <div class="dropdown-menu hidden absolute right-0 mt-1 w-44 bg-white rounded-2xl shadow-xl border border-neutral-200/90 py-1.5 z-40 text-left">
                                        <a href="{{ route('admin.invoices.show', $inv->id) }}" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                            <i data-lucide="eye" class="w-4 h-4 text-slate-400"></i>
                                            <span>Lihat Detail</span>
                                        </a>
                                        <a href="{{ route('admin.invoices.print', $inv->id) }}" target="_blank" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                            <i data-lucide="printer" class="w-4 h-4 text-slate-400"></i>
                                            <span>Cetak / Unduh PDF</span>
                                        </a>
                                        <a href="{{ $inv->whatsapp_share_url }}" target="_blank" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-emerald-700 hover:bg-emerald-50 transition">
                                            <i data-lucide="send" class="w-4 h-4 text-emerald-600"></i>
                                            <span>Kirim ke WhatsApp</span>
                                        </a>
                                        <a href="{{ route('admin.invoices.edit', $inv->id) }}" class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                            <i data-lucide="pencil" class="w-4 h-4 text-slate-400"></i>
                                            <span>Edit Invoice</span>
                                        </a>
                                        <div class="my-1 border-t border-slate-100"></div>
                                        <form action="{{ route('admin.invoices.destroy', $inv->id) }}" method="POST" onsubmit="confirmDelete(event, 'Apakah Anda yakin ingin menghapus invoice {{ $inv->invoice_number }} atas nama {{ addslashes($inv->customer_name) }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition text-left cursor-pointer">
                                                <i data-lucide="trash-2" class="w-4 h-4 text-rose-500"></i>
                                                <span>Hapus Invoice</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12 text-slate-400">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="w-14 h-14 rounded-3xl bg-neutral-100 text-slate-400 flex items-center justify-center mx-auto">
                                        <i data-lucide="file-x" class="w-7 h-7"></i>
                                    </div>
                                    <p class="font-bold text-slate-700 text-sm">Belum Ada Invoice</p>
                                    <p class="text-xs text-slate-400">Mulai buat invoice baru untuk pelanggan tour & travel Anda.</p>
                                    <a href="{{ route('admin.invoices.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-700 text-white font-bold text-xs hover:bg-emerald-800 transition">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                        <span>Buat Invoice Pertama</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($invoices->hasPages())
            <div class="p-4 border-t border-neutral-200">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function toggleActionDropdown(event, button) {
    event.stopPropagation();
    const dropdown = button.nextElementSibling;
    const allMenus = document.querySelectorAll('.dropdown-action-menu .dropdown-menu');
    allMenus.forEach(menu => {
        if (menu !== dropdown) {
            menu.classList.add('hidden');
        }
    });
    if (dropdown) {
        dropdown.classList.toggle('hidden');
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons();
        }
    }
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-action-menu')) {
        document.querySelectorAll('.dropdown-action-menu .dropdown-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    }
});
</script>
@endpush
@endsection
