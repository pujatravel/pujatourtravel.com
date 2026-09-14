<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Services\ActivityLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UnitController extends Controller
{
    /**
     * Display a listing of units.
     */
    public function index(): View
    {
        $units = Unit::withCount('packages')
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view('admin.units.index', compact('units'));
    }

    /**
     * Store a newly created unit in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:100|unique:units,name',
            'description'   => 'nullable|string|max:500',
            'display_order' => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        $validated['slug']          = Str::slug($validated['name']);
        $validated['is_active']     = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        // Ensure slug uniqueness
        $baseSlug = $validated['slug'];
        $count    = 1;
        while (Unit::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $baseSlug . '-' . $count++;
        }

        Unit::create($validated);

        ActivityLogger::log('CREATE', 'Satuan Paket', "Menambahkan satuan paket baru: \"{$validated['name']}\"");

        return redirect()->route('admin.units.index')
            ->with('success', 'Satuan "' . $validated['name'] . '" berhasil ditambahkan.');
    }

    /**
     * Update the specified unit in storage.
     */
    public function update(Request $request, Unit $unit): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:100|unique:units,name,' . $unit->id,
            'description'   => 'nullable|string|max:500',
            'display_order' => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        // Regenerate slug if name changed
        if ($validated['name'] !== $unit->name) {
            $baseSlug = Str::slug($validated['name']);
            $slug     = $baseSlug;
            $count    = 1;
            while (Unit::where('slug', $slug)->where('id', '!=', $unit->id)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_active']     = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $unit->update($validated);

        ActivityLogger::log('UPDATE', 'Satuan Paket', "Memperbarui satuan paket: \"{$unit->name}\"");

        return redirect()->route('admin.units.index')
            ->with('success', 'Satuan "' . $unit->name . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified unit from storage.
     */
    public function destroy(Unit $unit): RedirectResponse
    {
        // Check if there are packages using this unit
        $packageCount = $unit->packages()->count();
        if ($packageCount > 0) {
            return redirect()->route('admin.units.index')
                ->with('error', 'Satuan "' . $unit->name . '" tidak dapat dihapus karena masih digunakan oleh ' . $packageCount . ' paket wisata.');
        }

        $name = $unit->name;
        $unit->delete();

        ActivityLogger::log('DELETE', 'Satuan Paket', "Menghapus satuan paket: \"{$name}\"");

        return redirect()->route('admin.units.index')
            ->with('success', 'Satuan "' . $name . '" berhasil dihapus.');
    }

    /**
     * Toggle the active status of a unit.
     */
    public function toggleActive(Unit $unit): RedirectResponse
    {
        $unit->update(['is_active' => !$unit->is_active]);

        $statusLabel = $unit->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.units.index')
            ->with('success', 'Satuan "' . $unit->name . '" berhasil ' . $statusLabel . '.');
    }

    /**
     * Reorder units via drag & drop (JSON).
     */
    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:units,id',
        ]);

        foreach ($request->order as $index => $id) {
            Unit::where('id', $id)->update(['display_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
