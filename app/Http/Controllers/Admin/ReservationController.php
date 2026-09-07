<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Reservation::with('package')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhere('package_name', 'like', "%{$search}%");
            });
        }

        $reservations = $query->paginate(12)->withQueryString();

        $pendingCount = Reservation::where('status', 'PENDING')->count();
        $processCount = Reservation::where('status', 'DIPROSES')->count();
        $confirmedCount = Reservation::where('status', 'DIKONFIRMASI')->count();
        $completedCount = Reservation::where('status', 'SELESAI')->count();
        $cancelledCount = Reservation::where('status', 'DIBATALKAN')->count();

        return view('admin.reservations.index', compact(
            'reservations',
            'pendingCount',
            'processCount',
            'confirmedCount',
            'completedCount',
            'cancelledCount'
        ));
    }

    public function show(Reservation $reservation): View
    {
        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:PENDING,DIPROSES,DIKONFIRMASI,SELESAI,DIBATALKAN'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $reservation->status = $validated['status'];
        if ($request->filled('admin_notes')) {
            $reservation->admin_notes = $validated['admin_notes'];
        }
        $reservation->save();

        return back()->with('success', "Status reservasi #{$reservation->code} berhasil diubah menjadi {$reservation->status}.");
    }

    public function destroy(Reservation $reservation): RedirectResponse
    {
        $code = $reservation->code;
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', "Reservasi #{$code} berhasil dihapus.");
    }
}
