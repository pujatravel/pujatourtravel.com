<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    /**
     * Display a listing of published tour packages with defensive input handling.
     */
    public function index(Request $request): View
    {
        $query = Package::with('category')
            ->where('status', 'PUBLISHED');

        // 1. Defensively handle and sanitize search input
        $search = null;
        if ($request->filled('search')) {
            $rawSearch = trim(strip_tags((string) $request->input('search')));
            // Limit search term length to prevent memory abuse
            $cleanSearch = mb_substr($rawSearch, 0, 100);

            if ($cleanSearch !== '') {
                $search = $cleanSearch;
                // Escape SQL LIKE wildcard characters to prevent pattern abuse
                $escapedSearch = addcslashes($cleanSearch, '%_');
                $query->where(function ($q) use ($escapedSearch) {
                    $q->where('name', 'like', "%{$escapedSearch}%")
                        ->orWhere('location', 'like', "%{$escapedSearch}%")
                        ->orWhere('short_description', 'like', "%{$escapedSearch}%");
                });
            }
        }

        // 2. Defensively handle category filter
        $categorySlug = 'all';
        $categoryNotFound = false;
        if ($request->filled('category')) {
            $rawCategory = trim(strip_tags((string) $request->input('category')));
            $sanitizedCat = preg_replace('/[^a-z0-9\-]/', '', strtolower($rawCategory));

            if ($sanitizedCat !== '' && $sanitizedCat !== 'all') {
                $categorySlug = $sanitizedCat;
                $catExists = PackageCategory::where('slug', $sanitizedCat)->where('is_active', true)->exists();
                if ($catExists) {
                    $query->whereHas('category', function ($q) use ($sanitizedCat) {
                        $q->where('slug', $sanitizedCat);
                    });
                } else {
                    $categoryNotFound = true;
                    // Defensively query no results for invalid category
                    $query->whereRaw('1 = 0');
                }
            }
        }

        // 3. Defensively handle sorting with strict whitelist
        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'popular' => $query->orderBy('featured', 'desc')->latest(),
            default => $query->latest(),
        };

        $packages = $query->paginate(9)->withQueryString();
        $categories = PackageCategory::where('is_active', true)->orderBy('display_order')->get();
        $settings = Setting::all()->pluck('value', 'key');

        return view('packages.index', compact(
            'packages',
            'categories',
            'settings',
            'search',
            'categorySlug',
            'categoryNotFound',
            'sort'
        ));
    }

    /**
     * Display the specified tour package detail page.
     */
    public function show(string $slug): View
    {
        $sanitizedSlug = trim(strip_tags($slug));

        $package = Package::with('category')
            ->where('slug', $sanitizedSlug)
            ->where('status', 'PUBLISHED')
            ->firstOrFail();

        $relatedPackages = Package::with('category')
            ->where('status', 'PUBLISHED')
            ->where('id', '!=', $package->id)
            ->where('category_id', $package->category_id)
            ->take(3)
            ->get();

        if ($relatedPackages->count() < 3) {
            $morePackages = Package::with('category')
                ->where('status', 'PUBLISHED')
                ->where('id', '!=', $package->id)
                ->whereNotIn('id', $relatedPackages->pluck('id'))
                ->take(3 - $relatedPackages->count())
                ->get();
            $relatedPackages = $relatedPackages->merge($morePackages);
        }

        $settings = Setting::all()->pluck('value', 'key');

        return view('packages.show', compact('package', 'relatedPackages', 'settings'));
    }
}
