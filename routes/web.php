<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\PackageCategoryController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SignatureController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\InvoicePublicController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PageController;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Invoice;
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
    // Display 4 packages on homepage grid (2 rows × 2 columns)
    $packages = Package::with('category')->where('status', 'PUBLISHED')->where('featured', true)->take(4)->get();
    if ($packages->count() < 4) {
        $packages = Package::with('category')->where('status', 'PUBLISHED')->latest()->take(4)->get();
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
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/testimonial', [PageController::class, 'testimonial'])->name('testimonial');
Route::post('/testimonial', [PageController::class, 'storeTestimonial'])->name('testimonial.store');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::get('/kebijakan-privasi', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/syarat-ketentuan', [PageController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/kebijakan-pengembalian', [PageController::class, 'refundPolicy'])->name('refund-policy');
Route::get('/tim-pengembang', [PageController::class, 'developers'])->name('developers');
Route::get('/developers', [PageController::class, 'developers'])->name('developers-alt');
Route::get('/invoice/{invoice_number}', [InvoicePublicController::class, 'show'])->name('invoice.public');

Route::get('/sitemap.xml', function () {
    $packages = Package::where('status', 'PUBLISHED')->latest()->get();
    $latestPkgDate = $packages->max('updated_at') ?: now();

    // Timestamp statis berdasarkan file view aktual agar stabil di crawler Google
    $getViewDate = function ($viewRelPath) use ($latestPkgDate) {
        $fullPath = resource_path('views/' . $viewRelPath);
        return file_exists($fullPath) ? date('c', filemtime($fullPath)) : $latestPkgDate->toAtomString();
    };

    $urls = [
        [
            'loc' => route('home'),
            'priority' => '1.0',
            'changefreq' => 'daily',
            'lastmod' => $latestPkgDate->toAtomString(),
            'images' => [
                ['loc' => asset('images/hero_pangandaran.jpg'), 'title' => 'Wisata Pangandaran - Puja Tour & Travel', 'caption' => 'Pesona Bahari dan Wisata Pantai Pangandaran'],
                ['loc' => asset('images/greencanyon.jpg'), 'title' => 'Green Canyon Pangandaran', 'caption' => 'Petualangan Body Rafting Green Canyon Cukang Taneuh'],
                ['loc' => asset('images/pasir_putih.jpg'), 'title' => 'Pantai Pasir Putih Pangandaran', 'caption' => 'Snorkeling dan Terumbu Karang Pasir Putih'],
            ],
        ],
        [
            'loc' => route('packages.index'),
            'priority' => '0.9',
            'changefreq' => 'daily',
            'lastmod' => $latestPkgDate->toAtomString(),
            'images' => [
                ['loc' => asset('images/greencanyon.jpg'), 'title' => 'Katalog Paket Wisata Pangandaran', 'caption' => 'Pilihan Paket Wisata Terbaik di Pangandaran'],
            ],
        ],
        [
            'loc' => route('about'),
            'priority' => '0.8',
            'changefreq' => 'monthly',
            'lastmod' => $getViewDate('pages/about.blade.php'),
            'images' => [
                ['loc' => asset('images/puja_logo.png'), 'title' => 'CV Puja Tour & Travel Pangandaran', 'caption' => 'Biro Perjalanan Wisata Resmi Pangandaran'],
            ],
        ],
        [
            'loc' => route('calculator'),
            'priority' => '0.8',
            'changefreq' => 'weekly',
            'lastmod' => $getViewDate('pages/calculator.blade.php'),
        ],
        [
            'loc' => route('gallery'),
            'priority' => '0.8',
            'changefreq' => 'weekly',
            'lastmod' => $getViewDate('pages/gallery.blade.php'),
            'images' => [
                ['loc' => asset('images/cagar_alam.jpg'), 'title' => 'Dokumentasi Galeri Wisata Pangandaran', 'caption' => 'Koleksi Foto Petualangan Pangandaran'],
            ],
        ],
        [
            'loc' => route('testimonial'),
            'priority' => '0.8',
            'changefreq' => 'weekly',
            'lastmod' => $getViewDate('pages/testimonial.blade.php'),
        ],
        [
            'loc' => route('faq'),
            'priority' => '0.7',
            'changefreq' => 'monthly',
            'lastmod' => $getViewDate('pages/faq.blade.php'),
        ],
        [
            'loc' => route('contact'),
            'priority' => '0.8',
            'changefreq' => 'monthly',
            'lastmod' => $getViewDate('pages/contact.blade.php'),
        ],
        [
            'loc' => route('privacy-policy'),
            'priority' => '0.5',
            'changefreq' => 'monthly',
            'lastmod' => $getViewDate('pages/privacy-policy.blade.php'),
        ],
        [
            'loc' => route('terms-conditions'),
            'priority' => '0.5',
            'changefreq' => 'monthly',
            'lastmod' => $getViewDate('pages/terms-conditions.blade.php'),
        ],
        [
            'loc' => route('refund-policy'),
            'priority' => '0.5',
            'changefreq' => 'monthly',
            'lastmod' => $getViewDate('pages/refund-policy.blade.php'),
        ],
        [
            'loc' => route('developers'),
            'priority' => '0.5',
            'changefreq' => 'monthly',
            'lastmod' => $getViewDate('pages/developers.blade.php'),
        ],
    ];

    foreach ($packages as $pkg) {
        $pkgImages = [];
        $imgUrl = $pkg->image_url ? asset($pkg->image_url) : asset('images/greencanyon.jpg');
        $pkgImages[] = [
            'loc' => $imgUrl,
            'title' => 'Paket Wisata ' . $pkg->name,
            'caption' => $pkg->short_description ?: ('Paket wisata ' . $pkg->name . ' Pangandaran bersama Puja Tour'),
        ];

        $urls[] = [
            'loc' => route('packages.show', $pkg->slug),
            'priority' => '0.9',
            'changefreq' => 'weekly',
            'lastmod' => $pkg->updated_at ? $pkg->updated_at->toAtomString() : $latestPkgDate->toAtomString(),
            'images' => $pkgImages,
        ];
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . PHP_EOL;

    foreach ($urls as $item) {
        $xml .= '  <url>' . PHP_EOL;
        $xml .= '    <loc>' . htmlspecialchars($item['loc'], ENT_XML1, 'UTF-8') . '</loc>' . PHP_EOL;
        $xml .= '    <lastmod>' . $item['lastmod'] . '</lastmod>' . PHP_EOL;
        $xml .= '    <changefreq>' . $item['changefreq'] . '</changefreq>' . PHP_EOL;
        $xml .= '    <priority>' . $item['priority'] . '</priority>' . PHP_EOL;
        if (!empty($item['images'])) {
            foreach ($item['images'] as $img) {
                $xml .= '    <image:image>' . PHP_EOL;
                $xml .= '      <image:loc>' . htmlspecialchars($img['loc'], ENT_XML1, 'UTF-8') . '</image:loc>' . PHP_EOL;
                if (!empty($img['title'])) {
                    $xml .= '      <image:title>' . htmlspecialchars($img['title'], ENT_XML1, 'UTF-8') . '</image:title>' . PHP_EOL;
                }
                if (!empty($img['caption'])) {
                    $xml .= '      <image:caption>' . htmlspecialchars($img['caption'], ENT_XML1, 'UTF-8') . '</image:caption>' . PHP_EOL;
                }
                $xml .= '    </image:image>' . PHP_EOL;
            }
        }
        $xml .= '  </url>' . PHP_EOL;
    }

    $xml .= '</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml; charset=utf-8',
    ]);
})->name('sitemap');

Route::get('/sitemap', function () {
    return redirect()->route('sitemap', [], 301);
});

// Heartbeat & Pelacakan Pengunjung Realtime (Zero PII, Aman Privasi)
Route::post('/visitor-ping', function (Request $request) {
    $visitorId = (string) $request->input('visitor_id', '');
    if (empty($visitorId)) {
        $visitorId = hash('sha256', $request->ip() . $request->userAgent());
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

        // Invoices Management & Generator
        Route::resource('invoices', AdminInvoiceController::class);
        Route::get('invoices/{invoice}/print', [AdminInvoiceController::class, 'print'])->name('invoices.print');
        Route::patch('invoices/{invoice}/update-status', [AdminInvoiceController::class, 'updateStatus'])->name('invoices.update-status');

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

        // FAQs (Inline Modal CRUD & Reorder)
        Route::resource('faqs', FaqController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::post('faqs/reorder', [FaqController::class, 'reorder'])->name('faqs.reorder');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        // Invoice Signature Settings
        Route::get('signature', [SignatureController::class, 'index'])->name('signature.index');
        Route::put('signature', [SignatureController::class, 'update'])->name('signature.update');

        // Package Categories CRUD
        Route::get('categories', [PackageCategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [PackageCategoryController::class, 'store'])->name('categories.store');
        Route::patch('categories/{category}', [PackageCategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [PackageCategoryController::class, 'destroy'])->name('categories.destroy');
        Route::patch('categories/{category}/toggle-active', [PackageCategoryController::class, 'toggleActive'])->name('categories.toggle-active');
        Route::post('categories/reorder', [PackageCategoryController::class, 'reorder'])->name('categories.reorder');

        // Package Units CRUD
        Route::get('units', [UnitController::class, 'index'])->name('units.index');
        Route::post('units', [UnitController::class, 'store'])->name('units.store');
        Route::patch('units/{unit}', [UnitController::class, 'update'])->name('units.update');
        Route::delete('units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');
        Route::patch('units/{unit}/toggle-active', [UnitController::class, 'toggleActive'])->name('units.toggle-active');
        Route::post('units/reorder', [UnitController::class, 'reorder'])->name('units.reorder');

        // Activity & Security Audit Logs
        Route::get('logs', [ActivityLogController::class, 'index'])->name('logs.index');
        Route::post('logs/lock', [ActivityLogController::class, 'lock'])->name('logs.lock');
        Route::delete('logs/clear', [ActivityLogController::class, 'clear'])->name('logs.clear');
        Route::delete('logs/{log}', [ActivityLogController::class, 'destroy'])->name('logs.destroy');

        // Admin Profile & Password Management
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    });
});

// Fallback Route for public storage files (ensures signatures & uploads always serve seamlessly on local & production)
Route::get('/storage/{path}', function (string $path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath) || !is_readable($filePath)) {
        if (str_starts_with($path, 'signatures/')) {
            $activeSig = \App\Models\Setting::get('signature_image');
            if ($activeSig) {
                $activePath = storage_path('app/public/' . $activeSig);
                if (file_exists($activePath) && is_readable($activePath)) {
                    return response()->file($activePath);
                }
            }
        }
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*')->name('storage.file');
