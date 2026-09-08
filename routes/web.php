<?php

use App\Http\Controllers\Admin\AuthController;
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
    $testimonials = Testimonial::where('is_published', true)->latest()->take(6)->get();
    $faqs = Faq::where('is_published', true)->orderBy('display_order')->get();
    $settings = Setting::all()->pluck('value', 'key');

    return view('landingpage', compact(
        'packages',
        'allPackages',
        'totalPackagesCount',
        'featuredPackages',
        'categories',
        'galleries',
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
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

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
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Packages CRUD & Featured Toggle
        Route::resource('packages', AdminPackageController::class);
        Route::post('packages/{package}/toggle-featured', [AdminPackageController::class, 'toggleFeatured'])->name('packages.toggle-featured');

        // Reservations
        Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
        Route::patch('reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.update-status');
        Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

        // Galleries
        Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
        Route::post('galleries', [GalleryController::class, 'store'])->name('galleries.store');
        Route::delete('galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

        // Testimonials
        Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::post('testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

        // FAQs
        Route::resource('faqs', FaqController::class);
        Route::post('faqs/reorder', [FaqController::class, 'reorder'])->name('faqs.reorder');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
