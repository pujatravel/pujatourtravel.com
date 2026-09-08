<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin — Puja Tour & Travel</title>
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/puja_logo.png') }}">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden selection:bg-emerald-600 selection:text-white">

    <!-- Background Pattern -->
    <div class="absolute inset-0 z-0 opacity-15">
        <img src="{{ asset('images/hero_pangandaran.jpg') }}" alt="Pangandaran Ocean" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center p-1.5 rounded-2xl border-2 border-amber-500 bg-surface-soft shadow-soft mb-3 w-20 h-20">
                <img src="{{ asset('images/puja_logo.png') }}" alt="Logo Puja Tour" class="w-full h-full object-contain">
            </div>
            <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-white tracking-tight">PUJA TOUR & TRAVEL</h1>
            <p class="text-xs text-emerald-400 font-semibold tracking-wider uppercase mt-1">Admin Operations & CMS Panel</p>
        </div>

        <!-- Login Card -->
        <div class="bg-surface-soft rounded-3xl p-8 shadow-soft border border-neutral-200">
            <h2 class="font-display font-bold text-xl text-slate-900 mb-1">Masuk ke Sistem</h2>
            <p class="text-xs text-slate-500 mb-6">Silakan masukkan username/email dan kata sandi Anda.</p>

            @if($errors->any())
                <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">ID Pengguna / Email</label>
                    <input type="text" name="login" value="{{ old('login', 'admin') }}" required autofocus placeholder="Masukkan username atau email" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-canvas text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 transition outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Kata Sandi</label>
                    <input type="password" name="password" value="admin" required placeholder="Masukkan kata sandi" class="w-full px-4 py-3 rounded-xl border border-neutral-200 bg-canvas text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-700 focus:border-emerald-700 transition outline-none">
                </div>

                <div class="flex items-center justify-between text-xs text-slate-600 pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded text-emerald-700 focus:ring-emerald-600">
                        <span>Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm shadow-sm hover:shadow transition">
                    Masuk Sekarang
                </button>
            </form>

            <!-- Temporary Credentials Hint -->
            <div class="mt-6 p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-start gap-2.5">
                <i data-lucide="key-round" class="w-4 h-4 text-amber-700 mt-0.5 shrink-0"></i>
                <div>
                    <strong class="block font-bold">Akun Sementara Seeder:</strong>
                    <span class="text-[11px] block mt-0.5">ID: <code class="font-mono bg-white px-1.5 py-0.5 rounded border border-amber-200 font-bold">admin</code> &bull; Password: <code class="font-mono bg-white px-1.5 py-0.5 rounded border border-amber-200 font-bold">admin</code></span>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-white transition inline-flex items-center gap-1.5">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Website Publik</span>
            </a>
        </div>
    </div>

</body>
</html>
