<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\Testimonial;
use App\Services\VisitorTracker;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPackages = Package::count();
        $publishedPackages = Package::where('status', 'PUBLISHED')->count();
        $featuredPackages = Package::where('featured', true)->take(4)->get();
        $galleryCount = Gallery::count();
        $testimonialCount = Testimonial::count();
        $realtimeStats = VisitorTracker::getRealtimeStats();

        return view('admin.dashboard', compact(
            'totalPackages',
            'publishedPackages',
            'featuredPackages',
            'galleryCount',
            'testimonialCount',
            'realtimeStats'
        ));
    }

    /**
     * Endpoint API JSON untuk polling realtime pengunjung aktif.
     */
    public function realtimeVisitors(): JsonResponse
    {
        return response()->json(VisitorTracker::getRealtimeStats());
    }
}
