<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Gallery::query();

        if ($request->get('filter') === 'slider') {
            $query->where('is_slider', true);
        }

        $galleries = $query->latest()->paginate(12);
        $heroSliderCount = Gallery::where('is_slider', true)->count();

        return view('admin.galleries.index', compact('galleries', 'heroSliderCount'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string', 'max:50'],
            'caption' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'is_slider' => ['nullable', 'boolean'],
        ]);

        $file = $request->file('image');
        $ext = $file->guessExtension() ?: 'jpg';
        $filename = 'gal_'.time().'_'.Str::slug($validated['title']).'_'.Str::random(6).'.'.$ext;
        $file->move(public_path('images/uploads'), $filename);

        Gallery::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'caption' => $validated['caption'],
            'image_url' => '/images/uploads/'.$filename,
            'is_slider' => $request->boolean('is_slider'),
            'is_published' => true,
            'display_order' => Gallery::count() + 1,
        ]);

        return back()->with('success', 'Foto galeri berhasil diunggah!');
    }

    public function toggleSlider(Gallery $gallery): RedirectResponse
    {
        $gallery->update([
            'is_slider' => ! $gallery->is_slider,
        ]);

        $status = $gallery->is_slider ? 'ditambahkan ke' : 'dihapus dari';

        return back()->with('success', "Foto \"{$gallery->title}\" berhasil {$status} Slider Beranda Utama.");
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}
