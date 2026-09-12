<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PageController;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Services\VisitorTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $allPackages = Package::with('category')->where('status', 'PUBLISHED')->latest()->get();
    // Display only 3 packages on homepage grid
    $packages = Package::with('category')->where('status', 'PUBLISHED')->where('featured', true)->take(3)->get();
    if ($packages->count() < 3) {
        $packages = Package::with('category')->where('status', 'PUBLISHED')->latest()->take(3)->get();
    }
    $totalPackagesCount = $allPackages->count();
    $featuredPackages = Package::where('status', 'PUBLISHED')->where('featured', true)->get();
    $categories = PackageCategory::where('is_active', true)->orderBy('display_order')->get();
    $galleries = Gallery::where('is_published', true)->orderBy('display_order')->take(8)->get();
    $heroSliders = Gallery::where('is_published', true)->where('is_slider', true)->orderBy('display_order')->get();
    $testimonials = Testimonial::where('is_published', true)->latest()->get();
    $faqs = Faq::where('is_published', true)->orderBy('display_order')->get();
    $settings = Setting::all()->pluck('value', 'key');

    return view('landingpage', compact(
        'packages',
        'allPackages',
        'totalPackagesCount',
        'featuredPackages',
        'categories',
        'galleries',
        'heroSliders',
        'testimonials',
        'faqs',
        'settings'
    ));
})->name('home');

Route::get('/paket', [PackageController::class, 'index'])->name('packages.index');
Route::get('/paket-wisata', [PackageController::class, 'index'])->name('packages.index-alt');
Route::get('/paket/{slug}', [PackageController::class, 'show'])->name('packages.show');
Route::get('/paket-wisata/{slug}', [PackageController::class, 'show'])->name('packages.show-alt');
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/estimasi-biaya', [PageController::class, 'calculator'])->name('calculator');
Route::get('/reservasi', [PageController::class, 'calculator'])->name('reservations.request');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/testimonial', [PageController::class, 'testimonial'])->name('testimonial');
Route::post('/testimonial', [PageController::class, 'storeTestimonial'])->name('testimonial.store');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::get('/kebijakan-privasi', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/syarat-ketentuan', [PageController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/kebijakan-pengembalian', [PageController::class, 'refundPolicy'])->name('refund-policy');

Route::get('/sitemap.xml', function () {
    $packages = Package::where('status', 'PUBLISHED')->latest()->get();

    $urls = [
        ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
        ['loc' => route('packages.index'), 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
        ['loc' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
        ['loc' => route('calculator'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => now()->toAtomString()],
        ['loc' => route('gallery'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => now()->toAtomString()],
        ['loc' => route('testimonial'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => now()->toAtomString()],
        ['loc' => route('faq'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
        ['loc' => route('contact'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
        ['loc' => route('privacy-policy'), 'priority' => '0.5', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
        ['loc' => route('terms-conditions'), 'priority' => '0.5', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
        ['loc' => route('refund-policy'), 'priority' => '0.5', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
    ];

    foreach ($packages as $pkg) {
        $urls[] = [
            'loc' => route('packages.show', $pkg->slug),
            'priority' => '0.9',
            'changefreq' => 'weekly',
            'lastmod' => $pkg->updated_at ? $pkg->updated_at->toAtomString() : now()->toAtomString(),
        ];
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;

    foreach ($urls as $item) {
        $xml .= '  <url>'.PHP_EOL;
        $xml .= '    <loc>'.htmlspecialchars($item['loc'], ENT_XML1, 'UTF-8').'</loc>'.PHP_EOL;
        $xml .= '    <lastmod>'.$item['lastmod'].'</lastmod>'.PHP_EOL;
        $xml .= '    <changefreq>'.$item['changefreq'].'</changefreq>'.PHP_EOL;
        $xml .= '    <priority>'.$item['priority'].'</priority>'.PHP_EOL;
        $xml .= '  </url>'.PHP_EOL;
    }

    $xml .= '</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml; charset=utf-8',
    ]);
})->name('sitemap');

// Heartbeat & Pelacakan Pengunjung Realtime (Zero PII, Aman Privasi)
Route::post('/visitor-ping', function (Request $request) {
    $visitorId = (string) $request->input('visitor_id', '');
    if (empty($visitorId)) {
        $visitorId = hash('sha256', $request->ip().$request->userAgent());
    }
    $url = (string) $request->input('url', '/');
    $title = (string) $request->input('title', 'Website');
    $device = (string) $request->input('device', 'desktop');
    $action = (string) $request->input('action', 'ping');

    $result = VisitorTracker::recordPing($visitorId, $url, $title, $device, $action);

    return response()->json($result);
})->name('visitor.ping');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Admin Protected Area
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        // Dashboard & Realtime Analytics
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/realtime-visitors', [DashboardController::class, 'realtimeVisitors'])->name('realtime-visitors');

        // Packages CRUD & Featured Toggle
        Route::resource('packages', AdminPackageController::class);
        Route::post('packages/{package}/toggle-featured', [AdminPackageController::class, 'toggleFeatured'])->name('packages.toggle-featured');

        // Reservations
        Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
        Route::patch('reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.update-status');
        Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

        // Banner Hero Section CRUD
        Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
        Route::put('banners/text', [BannerController::class, 'updateText'])->name('banners.update-text');
        Route::post('banners/slider', [BannerController::class, 'storeSlider'])->name('banners.store-slider');
        Route::post('banners/add-from-gallery', [BannerController::class, 'addFromGallery'])->name('banners.add-from-gallery');
        Route::post('banners/slider/{gallery}/toggle', [BannerController::class, 'toggleSlider'])->name('banners.toggle-slider');
        Route::delete('banners/slider/{gallery}', [BannerController::class, 'destroySlider'])->name('banners.destroy-slider');

        // Galleries
        Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
        Route::post('galleries', [GalleryController::class, 'store'])->name('galleries.store');
        Route::post('galleries/{gallery}/toggle-slider', [GalleryController::class, 'toggleSlider'])->name('galleries.toggle-slider');
        Route::delete('galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

        // Testimonials
        Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::post('testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::patch('testimonials/{testimonial}/toggle-publish', [TestimonialController::class, 'togglePublish'])->name('testimonials.toggle-publish');
        Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

        // FAQs
        Route::resource('faqs', FaqController::class);
        Route::post('faqs/reorder', [FaqController::class, 'reorder'])->name('faqs.reorder');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
