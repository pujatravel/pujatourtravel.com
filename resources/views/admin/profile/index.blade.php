@extends('admin.layouts.app')

@section('title', 'Manajemen Profil & Kredensial Login')
@section('page-title', 'Manajemen Akun Administrator')

@section('content')
@php $errors = $errors ?? new \Illuminate\Support\ViewErrorBag; @endphp
<div class="max-w-6xl mx-auto space-y-6">

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-xs">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0"></i>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('success_password'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-xs">
            <i data-lucide="key-round" class="w-5 h-5 text-emerald-600 shrink-0"></i>
            <span class="text-sm font-semibold">{{ session('success_password') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 space-y-1.5 shadow-xs">
            <div class="flex items-center gap-2 font-bold text-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0"></i>
                <span>Terdapat kesalahan pada formulir:</span>
            </div>
            <ul class="list-disc list-inside text-xs space-y-1 pl-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile Overview Header Card --}}
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 relative overflow-hidden">
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 relative">
            <div class="flex items-center gap-5">
                <div class="w-20 h-20 rounded-2xl bg-linear-to-tr from-emerald-800 to-emerald-600 text-white flex items-center justify-center font-extrabold text-3xl shadow-md ring-4 ring-emerald-100 shrink-0">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h2 class="font-display font-extrabold text-xl sm:text-2xl text-slate-900 leading-tight">{{ $user->name }}</h2>
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                            {{ ucfirst($user->role ?? 'Administrator') }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Aktif
                        </span>
                    </div>
                    <div class="flex items-center gap-4 mt-1.5 text-xs text-slate-500 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 font-medium text-slate-700">
                            <i data-lucide="at-sign" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span class="font-bold text-emerald-700">{{ $user->username ?? 'admin' }}</span>
                        </span>
                        <span>•</span>
                        <span class="inline-flex items-center gap-1.5">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span>{{ $user->email }}</span>
                        </span>
                        @if($user->created_at)
                            <span>•</span>
                            <span class="inline-flex items-center gap-1.5 text-slate-400">
                                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                <span>Bergabung {{ $user->created_at->translatedFormat('d M Y') }}</span>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2 self-stretch sm:self-auto justify-end">
                <a href="{{ route('admin.logs.index', ['q' => $user->username]) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition border border-slate-200">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-700"></i>
                    <span>Log Aktivitas Saya</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Main Grid: 2 Columns for Profile Settings & Password Settings --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- FORM 1: Pengaturan Profil & Username Login --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                            <i data-lucide="user-cog" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-slate-900">Informasi Profil & Login</h3>
                            <p class="text-xs text-slate-500">Atur nama lengkap, username untuk masuk, dan email akun.</p>
                        </div>
                    </div>
                </div>

                <form id="form-profile-info" action="{{ route('admin.profile.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">
                            Nama Lengkap Administrator <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="user" class="w-4 h-4"></i>
                            </span>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border text-sm focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-hidden transition {{ $errors->has('name') ? 'border-rose-500 bg-rose-50/30' : 'border-slate-200 bg-slate-50' }}">
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">Nama ini akan tercantum pada nota invoice dan log aktivitas sistem.</p>
                    </div>

                    {{-- Username Login --}}
                    <div>
                        <label for="username" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">
                            Username Login <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none font-bold text-emerald-700 text-sm">
                                @
                            </span>
                            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required
                                placeholder="contoh: admin_puja"
                                class="w-full pl-9 pr-4 py-2.5 rounded-xl border text-sm font-semibold text-slate-800 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-hidden transition {{ $errors->has('username') ? 'border-rose-500 bg-rose-50/30' : 'border-slate-200 bg-slate-50' }}">
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">Gunakan huruf, angka, underscore (_), atau strip (-). Username ini digunakan saat masuk di halaman login admin.</p>
                    </div>

                    {{-- Alamat Email --}}
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">
                            Alamat Email Resmi <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border text-sm focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-hidden transition {{ $errors->has('email') ? 'border-rose-500 bg-rose-50/30' : 'border-slate-200 bg-slate-50' }}">
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">Dapat juga digunakan sebagai ID login alternatif.</p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-xs hover:shadow-md transition duration-150 cursor-pointer">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Perubahan Profil</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- FORM 2: Perubahan Kata Sandi (Password) --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                            <i data-lucide="key-round" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-slate-900">Keamanan & Ganti Password</h3>
                            <p class="text-xs text-slate-500">Perbarui kata sandi untuk menjaga keamanan akun administrator.</p>
                        </div>
                    </div>
                </div>

                <form id="form-profile-password" action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Kata Sandi Saat Ini --}}
                    <div>
                        <label for="current_password" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">
                            Kata Sandi Saat Ini <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="lock" class="w-4 h-4"></i>
                            </span>
                            <input type="password" id="current_password" name="current_password" required
                                placeholder="Masukkan password yang sekarang aktif"
                                class="w-full pl-10 pr-11 py-2.5 rounded-xl border text-sm focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-hidden transition {{ $errors->has('current_password') ? 'border-rose-500 bg-rose-50/30' : 'border-slate-200 bg-slate-50' }}">
                            <button type="button" onclick="togglePasswordVisibility('current_password', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition cursor-pointer" title="Lihat password">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-xs text-rose-600 mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kata Sandi Baru --}}
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">
                            Kata Sandi Baru <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                            </span>
                            <input type="password" id="password" name="password" required minlength="6"
                                placeholder="Minimal 6 karakter"
                                class="w-full pl-10 pr-11 py-2.5 rounded-xl border text-sm focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-hidden transition {{ $errors->has('password') ? 'border-rose-500 bg-rose-50/30' : 'border-slate-200 bg-slate-50' }}">
                            <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition cursor-pointer" title="Lihat password">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">Disarankan kombinasi huruf kapital, huruf kecil, dan angka.</p>
                    </div>

                    {{-- Konfirmasi Kata Sandi Baru --}}
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">
                            Ulangi Kata Sandi Baru <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6"
                                placeholder="Ketik ulang password baru di atas"
                                class="w-full pl-10 pr-11 py-2.5 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-hidden transition">
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition cursor-pointer" title="Lihat password">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-xs hover:shadow-md transition duration-150 cursor-pointer">
                            <i data-lucide="key" class="w-4 h-4"></i>
                            <span>Perbarui Kata Sandi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Security Tips & Session Notice Card --}}
    <div class="p-5 rounded-2xl bg-slate-100/80 border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="w-9 h-9 rounded-xl bg-slate-200 text-slate-700 flex items-center justify-center shrink-0">
                <i data-lucide="shield-alert" class="w-5 h-5 text-emerald-700"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-slate-900">Perlindungan Kredensial Admin</h4>
                <p class="text-[11px] text-slate-500">Setelah mengubah username atau password, pastikan Anda mengingat kredensial baru tersebut untuk sesi login selanjutnya.</p>
            </div>
        </div>
        <div class="text-xs font-medium text-slate-500 shrink-0">
            IP Anda: <span class="font-bold text-slate-700">{{ request()->ip() }}</span>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;

    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        if (icon) {
            icon.setAttribute('data-lucide', 'eye-off');
            lucide.createIcons();
        }
    } else {
        input.type = 'password';
        if (icon) {
            icon.setAttribute('data-lucide', 'eye');
            lucide.createIcons();
        }
    }
}

// Auto-focus on password field if navigated with #form-profile-password hash
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#form-profile-password') {
        var curPass = document.getElementById('current_password');
        if (curPass) {
            setTimeout(function() {
                curPass.focus();
                var card = curPass.closest('.bg-white');
                if (card) {
                    card.classList.add('ring-2', 'ring-amber-500');
                    setTimeout(function() {
                        card.classList.remove('ring-2', 'ring-amber-500');
                    }, 1500);
                }
            }, 300);
        }
    }
});
</script>
@endpush
