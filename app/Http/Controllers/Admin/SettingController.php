<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => ['nullable', 'string', 'max:150'],
            'phone_number' => ['nullable', 'string', 'max:50'],
            'whatsapp_number' => ['nullable', 'string', 'max:50'],
            'email_address' => ['nullable', 'email', 'max:100'],
            'office_address' => ['nullable', 'string'],
            'operational_hours' => ['nullable', 'string', 'max:100'],
            'instagram_url' => ['nullable', 'url', 'max:200'],
            'tiktok_url' => ['nullable', 'url', 'max:200'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan sistem & kontak berhasil diperbarui!');
    }
}
