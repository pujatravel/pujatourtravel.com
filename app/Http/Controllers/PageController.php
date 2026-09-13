<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
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
        $galleries = Gallery::where('is_published', true)->orderBy('display_order')->take(8)->get();

        return view('pages.about', compact('settings', 'testimonials', 'totalPackages', 'galleries'));
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

    /**
     * Display the Testimonials & Social Proof (Testimonial) page.
     */
    public function testimonial(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $testimonials = Testimonial::where('is_published', true)->latest()->get();
        $averageRating = Testimonial::where('is_published', true)->avg('rating') ?: 5.0;
        $packages = Package::where('status', 'PUBLISHED')->orderBy('name')->get();

        return view('pages.testimonial', compact('settings', 'testimonials', 'averageRating', 'packages'));
    }

    /**
     * Submit a customer review / testimonial (Requires Admin Approval / ACC).
     */
    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_city' => ['nullable', 'string', 'max:100'],
            'package_name' => ['nullable', 'string', 'max:150'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review_text' => ['required', 'string', 'min:5', 'max:1000'],
        ], [
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'rating.required' => 'Rating bintang wajib dipilih.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'review_text.required' => 'Ulasan pengalaman wajib diisi.',
            'review_text.min' => 'Ulasan minimal 5 karakter.',
        ]);

        Testimonial::create([
            'customer_name' => strip_tags(trim($validated['customer_name'])),
            'customer_city' => !empty($validated['customer_city']) ? strip_tags(trim($validated['customer_city'])) : null,
            'package_name' => !empty($validated['package_name']) ? strip_tags(trim($validated['package_name'])) : null,
            'rating' => (int) $validated['rating'],
            'review_text' => strip_tags(trim($validated['review_text'])),
            'is_featured' => false,
            'is_published' => false, // Menunggu persetujuan / ACC admin!
            'trip_date' => now()->format('Y-m-d'),
        ]);

        $successMsg = 'Terima kasih atas ulasan Anda! Testimoni telah dikirim ke panel admin untuk diverifikasi sebelum dipublikasikan.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
            ]);
        }

        return back()->with('testimonial_success', $successMsg);
    }

    /**
     * Display the Privacy Policy (Kebijakan Privasi) page.
     */
    public function privacyPolicy(): View
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('pages.privacy-policy', compact('settings'));
    }

    /**
     * Display the Terms and Conditions (Syarat & Ketentuan) page.
     */
    public function termsConditions(): View
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('pages.terms-conditions', compact('settings'));
    }

    /**
     * Display the Refund & Cancellation Policy (Kebijakan Pengembalian) page.
     */
    public function refundPolicy(): View
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('pages.refund-policy', compact('settings'));
    }

    /**
     * Display the Developer Team (Tim Pengembang) page.
     */
    public function developers(): View
    {
        $settings = Setting::all()->pluck('value', 'key');

        $developers = [
            [
                'name' => 'Muhammad Fikri Haikal',
                'role' => 'Full-Stack Developer & Server Engineer',
                'tagline' => 'Lead Developer & Server Deployment Specialist',
                'division' => 'PPLG • Pengembangan Sistem & Server Management',
                'bio' => 'Bertanggung jawab merancang arsitektur sistem secara menyeluruh (full-stack), integrasi backend Laravel 11, manajemen basis data MySQL, konfigurasi web server (Apache/Nginx), deployment aplikasi ke server produksi, pengelolaan domain & SSL, optimasi performa server, serta keamanan infrastruktur sistem.',
                'github_username' => 'fikrihaikal17',
                'github_url' => 'https://github.com/fikrihaikal17',
                'avatar_url' => 'https://github.com/fikrihaikal17.png',
                'instagram_handle' => '@fikrii_haikalll17',
                'instagram_url' => 'https://www.instagram.com/fikrii_haikalll17/',
                'email' => 'fikrihaikal170308@gmail.com',
                'skills' => ['Laravel 11', 'PHP 8.2+', 'MySQL', 'Apache/Nginx', 'Server Deployment', 'Linux Admin', 'SSL & Domain', 'SEO Optimization'],
                'color' => 'emerald',
            ],
            [
                'name' => 'Galuh Surya Putra',
                'role' => 'Frontend Developer & UI Specialist',
                'tagline' => 'Interface Design & Interactive Layout',
                'division' => 'PPLG • Pengembangan Antarmuka Web',
                'bio' => 'Berfokus pada implementasi desain antarmuka pengguna yang elegan, kenyamanan navigasi lintas perangkat mobile dan desktop, integrasi visual interaktif, micro-interaction responsif, serta penyempurnaan komponen tampilan landing page.',
                'github_username' => 'Ptragaluhhh28',
                'github_url' => 'https://github.com/Ptragaluhhh28',
                'avatar_url' => 'https://github.com/Ptragaluhhh28.png',
                'instagram_handle' => '@_luhptraa28',
                'instagram_url' => 'https://www.instagram.com/_luhptraa28?stkn=MXU1Z3B6dDkwOG9rcQ==',
                'email' => 'putragaluh2812@gmail.com',
                'skills' => ['Tailwind CSS', 'Responsive Layout', 'Blade Templates', 'Web Accessibility', 'Component Styling', 'Mobile First'],
                'color' => 'teal',
            ],
            [
                'name' => 'Nabil Cahyadi',
                'role' => 'Backend Engineer & Database Architect',
                'tagline' => 'Data Management & Logic Specialist',
                'division' => 'PPLG • Pengolahan Basis Data & API',
                'bio' => 'Berfokus pada pengelolaan dan normalisasi skema basis data relasional, pengoptimalan query SQL, sistem manajemen paket dan ulasan wisatawan, serta penanganan validasi formulir dan pengujian alur data aplikasi.',
                'github_username' => 'NabilCahyadi',
                'github_url' => 'https://github.com/NabilCahyadi',
                'avatar_url' => 'https://github.com/NabilCahyadi.png',
                'instagram_handle' => '@nbilc_',
                'instagram_url' => 'https://www.instagram.com/nbilc_?stkn=NW16dmgzMGUxZDd6',
                'email' => 'nabilcahyadi155@gmail.com',
                'skills' => ['Laravel Eloquent', 'MySQL Schema', 'Database Migration', 'Backend Logic', 'Input Validation', 'Security'],
                'color' => 'sky',
            ],
        ];

        return view('pages.developers', compact('settings', 'developers'));
    }
}
