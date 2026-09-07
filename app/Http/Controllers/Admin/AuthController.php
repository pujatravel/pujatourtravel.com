<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginInput = $credentials['login'];
        $password = $credentials['password'];
        $remember = $request->boolean('remember');

        // Check by username OR email
        $user = User::where(function ($query) use ($loginInput) {
            $query->where('username', $loginInput)
                ->orWhere('email', $loginInput);
        })->where('is_active', true)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, '.$user->name.'!');
        }

        return back()->withErrors([
            'login' => 'ID Admin/Email atau Password yang Anda masukkan tidak cocok.',
        ])->onlyInput('login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah berhasil keluar dari sistem admin.');
    }
}
