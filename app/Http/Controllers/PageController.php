<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the About Us (Tentang Kami) page.
     */
    public function about(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $testimonials = Testimonial::where('is_published', true)->latest()->take(6)->get();
        $totalPackages = Package::where('status', 'PUBLISHED')->count();

        return view('pages.about', compact('settings', 'testimonials', 'totalPackages'));
    }

    /**
     * Display the Cost Estimation (Estimasi Biaya) page.
     */
    public function calculator(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $packages = Package::with('category')->where('status', 'PUBLISHED')->latest()->get();

        return view('pages.calculator', compact('settings', 'packages'));
    }

    /**
     * Display the Frequently Asked Questions (FAQ) page.
     */
    public function faq(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $faqs = Faq::where('is_published', true)->orderBy('display_order')->get();

        return view('pages.faq', compact('settings', 'faqs'));
    }

    /**
     * Display the Photo Gallery (Galeri) page.
     */
    public function gallery(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $galleries = Gallery::where('is_published', true)->orderBy('display_order')->get();
        $categories = Gallery::where('is_published', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('pages.gallery', compact('settings', 'galleries', 'categories'));
    }

    /**
     * Display the Contact & Location (Kontak) page.
     */
    public function contact(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $faqs = Faq::where('is_published', true)->orderBy('display_order')->take(3)->get();

        return view('pages.contact', compact('settings', 'faqs'));
    }
}
