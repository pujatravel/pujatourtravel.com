<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman pengelolaan profil admin.
     */
    public function edit(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }

    /**
     * Perbarui informasi profil (Nama, Username, Email).
     */
    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z0-9_\-\.]+$/',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ], [
            'name.required' => 'Nama lengkap administrator wajib diisi.',
            'username.required' => 'Username login wajib diisi.',
            'username.min' => 'Username minimal terdiri dari 3 karakter.',
            'username.regex' => 'Username hanya boleh memuat huruf, angka, titik, strip (-), dan garis bawah (_).',
            'username.unique' => 'Username ini sudah digunakan oleh akun lain. Silakan pilih username lain.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar pada akun lain.',
        ]);

        $oldData = [
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
        ];

        $user->update([
            'name' => trim($validated['name']),
            'username' => strtolower(trim($validated['username'])),
            'email' => strtolower(trim($validated['email'])),
        ]);

        ActivityLogger::log('UPDATE', 'Pengaturan', "Admin {$user->name} memperbarui profil akun (Username: {$user->username})", [
            'before' => $oldData,
            'after' => [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
            ],
        ], $user);

        return back()->with('success', 'Informasi profil dan username login berhasil diperbarui!');
    }

    /**
     * Perbarui kata sandi (Password).
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Kata sandi saat ini yang Anda masukkan salah.',
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        ActivityLogger::log('UPDATE', 'Autentikasi', "Admin {$user->name} berhasil memperbarui kata sandi akun", null, $user);

        return back()->with('success_password', 'Kata sandi berhasil diperbarui! Silakan gunakan kata sandi baru untuk login berikutnya.');
    }
}
