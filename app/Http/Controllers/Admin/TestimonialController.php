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
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');

        $query = Testimonial::latest();

        if ($status === 'pending') {
            $query->where('is_published', false);
        } elseif ($status === 'published') {
            $query->where('is_published', true);
        }

        $testimonials = $query->paginate(15)->withQueryString();
        $packages = Package::orderBy('name')->get();

        $countAll = Testimonial::count();
        $countPending = Testimonial::where('is_published', false)->count();
        $countPublished = Testimonial::where('is_published', true)->count();

        return view('admin.testimonials.index', compact(
            'testimonials',
            'packages',
            'status',
            'countAll',
            'countPending',
            'countPublished'
        ));
    }

    public function togglePublish(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update([
            'is_published' => !$testimonial->is_published,
        ]);

        $msg = $testimonial->is_published
            ? "Testimoni dari \"{$testimonial->customer_name}\" berhasil disetujui (ACC) dan kini tampil di website!"
            : "Testimoni dari \"{$testimonial->customer_name}\" telah ditarik / disembunyikan dari website.";

        return back()->with('success', $msg);
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
            'is_published' => ['nullable', 'boolean'],
        ]);

        Testimonial::create([
            'customer_name' => $validated['customer_name'],
            'customer_city' => $validated['customer_city'],
            'package_name' => $validated['package_name'],
            'rating' => $validated['rating'],
            'review_text' => $validated['review_text'],
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->has('is_published') ? $request->boolean('is_published') : true,
            'trip_date' => now()->format('Y-m-d'),
        ]);

        return back()->with('success', 'Ulasan testimonial berhasil ditambahkan!');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $name = $testimonial->customer_name;
        $testimonial->delete();

        return back()->with('success', "Ulasan testimonial dari {$name} berhasil dihapus.");
    }
}
