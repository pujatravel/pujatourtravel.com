<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SignatureController extends Controller
{
    public function index(): View
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.signature.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'signature_header' => ['nullable', 'string', 'max:100'],
            'signature_name' => ['nullable', 'string', 'max:150'],
            'signature_position' => ['nullable', 'string', 'max:150'],
            'signature_city' => ['nullable', 'string', 'max:100'],
            'signature_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'signature_pad_data' => ['nullable', 'string'],
            'remove_signature_image' => ['nullable', 'boolean'],
        ]);

        // Handle Image Removal
        if ($request->boolean('remove_signature_image')) {
            $oldImage = Setting::get('signature_image');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            Setting::set('signature_image', null);
        }

        // Handle Signature from Canvas Pad (Mouse/Touch drawing)
        if ($request->filled('signature_pad_data') && str_starts_with($request->input('signature_pad_data'), 'data:image/')) {
            $oldImage = Setting::get('signature_image');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $imageData = $request->input('signature_pad_data');
            // Remove data URI scheme prefix
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $decoded = base64_decode($imageData);

            if ($decoded !== false) {
                $imageName = 'signatures/sig_' . uniqid() . '.png';
                Storage::disk('public')->put($imageName, $decoded);
                Setting::set('signature_image', $imageName);
            }
        }
        // Handle File Upload if provided (takes priority or alternative)
        elseif ($request->hasFile('signature_image')) {
            $oldImage = Setting::get('signature_image');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $request->file('signature_image')->store('signatures', 'public');
            Setting::set('signature_image', $path);
        }

        // Save Text Settings
        Setting::set('signature_header', $validated['signature_header'] ?? 'Hormat Kami,');
        Setting::set('signature_name', $validated['signature_name'] ?? 'Puja Tour & Travel');
        Setting::set('signature_position', $validated['signature_position'] ?? 'Finance & Reservation');
        Setting::set('signature_city', $validated['signature_city'] ?? 'Pangandaran');

        ActivityLogger::log('UPDATE', 'Tanda Tangan', 'Memperbarui pengaturan tanda tangan digital dan otorisasi invoice', [
            'signer_name' => $validated['signature_name'] ?? 'Puja Tour & Travel',
            'position' => $validated['signature_position'] ?? 'Finance & Reservation',
        ]);

        return back()->with('success', 'Pengaturan tanda tangan invoice berhasil disimpan!');
    }
}
