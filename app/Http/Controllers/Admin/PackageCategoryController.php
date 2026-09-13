<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PackageCategoryController extends Controller
{
    /**
     * Display a listing of package categories.
     */
    public function index(): View
    {
        $categories = PackageCategory::withCount('packages')
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:100|unique:package_categories,name',
            'description'   => 'nullable|string|max:500',
            'display_order' => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        $validated['slug']        = Str::slug($validated['name']);
        $validated['is_active']   = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        // Ensure slug uniqueness
        $baseSlug = $validated['slug'];
        $count    = 1;
        while (PackageCategory::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $baseSlug.'-'.$count++;
        }

        PackageCategory::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $validated['name'] . '" berhasil ditambahkan.');
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, PackageCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:100|unique:package_categories,name,' . $category->id,
            'description'   => 'nullable|string|max:500',
            'display_order' => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        // Regenerate slug if name changed
        if ($validated['name'] !== $category->name) {
            $baseSlug = Str::slug($validated['name']);
            $slug     = $baseSlug;
            $count    = 1;
            while (PackageCategory::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $baseSlug.'-'.$count++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_active']     = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $category->name . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(PackageCategory $category): RedirectResponse
    {
        // Check if there are packages using this category
        $packageCount = $category->packages()->count();
        if ($packageCount > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori "' . $category->name . '" tidak dapat dihapus karena masih digunakan oleh ' . $packageCount . ' paket wisata.');
        }

        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $name . '" berhasil dihapus.');
    }

    /**
     * Toggle the active status of a category.
     */
    public function toggleActive(PackageCategory $category): RedirectResponse
    {
        $category->update(['is_active' => !$category->is_active]);

        $statusLabel = $category->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $category->name . '" berhasil ' . $statusLabel . '.');
    }

    /**
     * Reorder categories via drag & drop (JSON).
     */
    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:package_categories,id',
        ]);

        foreach ($request->order as $index => $id) {
            PackageCategory::where('id', $id)->update(['display_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
