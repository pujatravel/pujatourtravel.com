<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::latest()->paginate(10);
        $packages = Package::orderBy('name')->get();

        return view('admin.testimonials.index', compact('testimonials', 'packages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_city' => ['nullable', 'string', 'max:100'],
            'package_name' => ['nullable', 'string', 'max:150'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review_text' => ['required', 'string'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        Testimonial::create([
            'customer_name' => $validated['customer_name'],
            'customer_city' => $validated['customer_city'],
            'package_name' => $validated['package_name'],
            'rating' => $validated['rating'],
            'review_text' => $validated['review_text'],
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => true,
            'trip_date' => now()->format('Y-m-d'),
        ]);

        return back()->with('success', 'Ulasan testimonial berhasil ditambahkan!');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return back()->with('success', 'Ulasan testimonial berhasil dihapus.');
    }
}
