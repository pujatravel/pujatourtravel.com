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
            'google_maps_embed_url' => ['nullable', 'string'],
            'instagram_url' => ['nullable', 'url', 'max:200'],
            'tiktok_url' => ['nullable', 'url', 'max:200'],
        ]);

        if (array_key_exists('google_maps_embed_url', $validated)) {
            $rawMap = trim((string) $validated['google_maps_embed_url']);
            if (! empty($rawMap)) {
                if (preg_match('/src=["\']([^"\']+)["\']/', $rawMap, $matches)) {
                    $validated['google_maps_embed_url'] = $matches[1];
                } else {
                    $validated['google_maps_embed_url'] = $rawMap;
                }
            } else {
                $validated['google_maps_embed_url'] = null;
            }
        }

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan sistem, kontak & peta lokasi berhasil diperbarui!');
    }
}
