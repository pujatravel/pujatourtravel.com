<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Testimonial;
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
            'recentReservations',
            'featuredPackages',
            'galleryCount',
            'testimonialCount'
        ));
    }
}
