<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPackages = Package::count();
        $publishedPackages = Package::where('status', 'PUBLISHED')->count();
        $totalReservations = Reservation::count();
        $pendingReservations = Reservation::where('status', 'PENDING')->count();
        $confirmedReservations = Reservation::where('status', 'DIKONFIRMASI')->count();
        $completedReservations = Reservation::where('status', 'SELESAI')->count();
        $totalPax = Reservation::whereIn('status', ['DIKONFIRMASI', 'SELESAI'])->sum('pax_count');
        $totalRevenue = Reservation::whereIn('status', ['DIKONFIRMASI', 'SELESAI'])->sum('total_price');
        $totalCustomers = Reservation::whereNotNull('customer_phone')->distinct('customer_phone')->count('customer_phone');
        $repeatCustomers = Reservation::whereNotNull('customer_phone')
            ->select('customer_phone')
            ->groupBy('customer_phone')
            ->havingRaw('count(*) > 1')
            ->get()
            ->count();

        $sourcesBreakdown = Reservation::select('source', DB::raw('count(*) as total'))
            ->groupBy('source')
            ->orderByDesc('total')
            ->get();

        $recentReservations = Reservation::with('package')
            ->latest()
            ->take(6)
            ->get();

        $featuredPackages = Package::where('featured', true)->take(4)->get();
        $galleryCount = Gallery::count();
        $testimonialCount = Testimonial::count();

        return view('admin.dashboard', compact(
            'totalPackages',
            'publishedPackages',
            'totalReservations',
            'pendingReservations',
            'confirmedReservations',
            'completedReservations',
            'totalPax',
            'totalRevenue',
            'totalCustomers',
            'repeatCustomers',
            'sourcesBreakdown',
            'recentReservations',
            'featuredPackages',
            'galleryCount',
            'testimonialCount'
        ));
    }
}
