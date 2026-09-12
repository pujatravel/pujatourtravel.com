<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BannerController extends Controller
{
    /**
     * Tampilkan halaman manajemen Banner Hero (Teks, Statistik, & Slide Gambar).
     */
    public function index(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $heroSliders = Gallery::where('is_slider', true)->orderBy('display_order')->get();
        $allGalleries = Gallery::where('is_slider', false)->where('is_published', true)->latest()->get();

        return view('admin.banners.index', compact('settings', 'heroSliders', 'allGalleries'));
    }

    /**
     * Update Teks & Statistik Banner Hero.
     */
    public function updateText(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_badge' => ['nullable', 'string', 'max:150'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_title_highlight' => ['nullable', 'string', 'max:100'],
            'hero_subtitle' => ['nullable', 'string'],
            'hero_stat_1_val' => ['nullable', 'string', 'max:50'],
            'hero_stat_1_lbl' => ['nullable', 'string', 'max:50'],
            'hero_stat_2_val' => ['nullable', 'string', 'max:50'],
            'hero_stat_2_lbl' => ['nullable', 'string', 'max:50'],
            'hero_stat_3_val' => ['nullable', 'string', 'max:50'],
            'hero_stat_3_lbl' => ['nullable', 'string', 'max:50'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value, 'hero_banner');
        }

        return back()->with('success', 'Teks dan statistik Banner Hero beranda berhasil diperbarui!');
    }

    /**
     * Unggah Gambar Slide Baru untuk Hero Banner.
     */
    public function storeSlider(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'caption' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $file = $request->file('image');
        $ext = $file->guessExtension() ?: 'jpg';
        $filename = 'hero_slide_'.time().'_'.Str::slug($validated['title']).'_'.Str::random(6).'.'.$ext;
        $file->move(public_path('images/uploads'), $filename);

        Gallery::create([
            'title' => $validated['title'],
            'category' => 'Hero Banner',
            'caption' => $validated['caption'] ?? 'Destinasi Wisata Pangandaran',
            'image_url' => '/images/uploads/'.$filename,
            'is_slider' => true,
            'is_published' => true,
            'display_order' => Gallery::where('is_slider', true)->count() + 1,
        ]);

        return back()->with('success', 'Gambar slide banner hero baru berhasil diunggah!');
    }

    /**
     * Tambahkan Foto dari Galeri yang Ada ke Slide Hero Banner.
     */
    public function addFromGallery(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_id' => ['required', 'exists:galleries,id'],
        ]);

        $gallery = Gallery::findOrFail($validated['gallery_id']);
        $gallery->update(['is_slider' => true]);

        return back()->with('success', "Foto \"{$gallery->title}\" berhasil ditambahkan ke Slider Banner Hero.");
    }

    /**
     * Toggle status aktif slide di Hero Banner.
     */
    public function toggleSlider(Gallery $gallery): RedirectResponse
    {
        $gallery->update([
            'is_slider' => ! $gallery->is_slider,
        ]);

        $status = $gallery->is_slider ? 'diaktifkan di' : 'dilepas dari';

        return back()->with('success', "Foto slide \"{$gallery->title}\" berhasil {$status} Slider Banner Hero.");
    }

    /**
     * Hapus gambar slide banner.
     */
    public function destroySlider(Gallery $gallery): RedirectResponse
    {
        $title = $gallery->title;
        $gallery->delete();

        return back()->with('success', "Slide banner \"{$title}\" berhasil dihapus.");
    }
}
