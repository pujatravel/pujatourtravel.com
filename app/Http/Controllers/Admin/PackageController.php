<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(Request $request): View
    {
        $query = Package::with('category')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $packages = $query->paginate(10)->withQueryString();
        $categories = PackageCategory::where('is_active', true)->get();

        return view('admin.packages.index', compact('packages', 'categories'));
    }

    public function create(): View
    {
        $categories = PackageCategory::where('is_active', true)->get();

        return view('admin.packages.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:package_categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:150'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'], // 3MB max
            'status' => ['required', 'in:DRAFT,PUBLISHED,ARCHIVED'],
            'featured' => ['nullable', 'boolean'],
            'inclusions_text' => ['nullable', 'string'],
            'exclusions_text' => ['nullable', 'string'],
        ]);

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $count = 1;
        while (Package::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $imageUrl = '/images/greencanyon.jpg'; // default fallback
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->guessExtension() ?: 'jpg';
            $filename = 'pkg_'.time().'_'.Str::slug($validated['name']).'_'.Str::random(6).'.'.$ext;
            $file->move(public_path('images/uploads'), $filename);
            $imageUrl = '/images/uploads/'.$filename;
        }

        // Parse facilities array
        $inclusions = [];
        if (! empty($validated['inclusions_text'])) {
            $inclusions = array_filter(array_map('trim', explode("\n", $validated['inclusions_text'])));
        }

        $exclusions = [];
        if (! empty($validated['exclusions_text'])) {
            $exclusions = array_filter(array_map('trim', explode("\n", $validated['exclusions_text'])));
        }

        Package::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'location' => $validated['location'],
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'image_url' => $imageUrl,
            'status' => $validated['status'],
            'featured' => $request->boolean('featured'),
            'inclusions' => $inclusions,
            'exclusions' => $exclusions,
            'itinerary' => [],
        ]);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket wisata "'.$validated['name'].'" berhasil ditambahkan!');
    }

    public function edit(Package $package): View
    {
        $categories = PackageCategory::where('is_active', true)->get();

        return view('admin.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:package_categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:150'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'status' => ['required', 'in:DRAFT,PUBLISHED,ARCHIVED'],
            'featured' => ['nullable', 'boolean'],
            'inclusions_text' => ['nullable', 'string'],
            'exclusions_text' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->guessExtension() ?: 'jpg';
            $filename = 'pkg_'.time().'_'.Str::slug($validated['name']).'_'.Str::random(6).'.'.$ext;
            $file->move(public_path('images/uploads'), $filename);
            $package->image_url = '/images/uploads/'.$filename;
        }

        $inclusions = [];
        if (! empty($validated['inclusions_text'])) {
            $inclusions = array_filter(array_map('trim', explode("\n", $validated['inclusions_text'])));
        }

        $exclusions = [];
        if (! empty($validated['exclusions_text'])) {
            $exclusions = array_filter(array_map('trim', explode("\n", $validated['exclusions_text'])));
        }

        $package->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'location' => $validated['location'],
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'featured' => $request->boolean('featured'),
            'inclusions' => $inclusions,
            'exclusions' => $exclusions,
        ]);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket wisata "'.$package->name.'" berhasil diperbarui!');
    }

    public function destroy(Package $package): RedirectResponse
    {
        $hasReservations = Reservation::where('package_id', $package->id)->exists();
        if ($hasReservations) {
            $package->status = 'ARCHIVED';
            $package->save();

            return redirect()->route('admin.packages.index')
                ->with('success', 'Paket wisata "'.$package->name.'" memiliki riwayat transaksi reservasi sehingga otomatis dialihkan ke status Diarsipkan (Archived).');
        }

        $name = $package->name;
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket wisata "'.$name.'" berhasil dihapus.');
    }

    public function toggleFeatured(Package $package): RedirectResponse
    {
        $package->featured = ! $package->featured;
        $package->save();

        $statusText = $package->featured ? 'ditandai sebagai unggulan' : 'dihapus dari unggulan';

        return back()->with('success', "Paket {$package->name} berhasil {$statusText}.");
    }
}
