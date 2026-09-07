<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
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
    $packages = Package::where('status', 'PUBLISHED')->latest()->get();
    $featuredPackages = Package::where('status', 'PUBLISHED')->where('featured', true)->get();
    $categories = PackageCategory::where('is_active', true)->orderBy('display_order')->get();
    $galleries = Gallery::where('is_published', true)->orderBy('display_order')->take(8)->get();
    $testimonials = Testimonial::where('is_published', true)->latest()->take(6)->get();
    $settings = Setting::all()->pluck('value', 'key');

    return view('landingpage', compact(
        'packages',
        'featuredPackages',
        'categories',
        'galleries',
        'testimonials',
        'settings'
    ));
})->name('home');

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
        Route::resource('packages', PackageController::class);
        Route::post('packages/{package}/toggle-featured', [PackageController::class, 'toggleFeatured'])->name('packages.toggle-featured');

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

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
