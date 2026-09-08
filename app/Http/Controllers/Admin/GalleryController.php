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
    public function index(): View
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string', 'max:50'],
            'caption' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
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
            'is_published' => true,
            'display_order' => Gallery::count() + 1,
        ]);

        return back()->with('success', 'Foto galeri berhasil diunggah!');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}
