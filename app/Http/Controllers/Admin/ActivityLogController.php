<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    /**
     * Cek apakah sesi otorisasi penghapusan log masih aktif (berlaku 30 menit).
     */
    private function isDeleteAuthorized(): bool
    {
        $authUntil = session('log_delete_auth_until');

        return $authUntil && time() < (int) $authUntil;
    }

    /**
     * Hitung sisa menit otorisasi penghapusan log.
     */
    private function getDeleteAuthRemainingMinutes(): int
    {
        $authUntil = session('log_delete_auth_until');
        if ($authUntil && time() < (int) $authUntil) {
            return (int) ceil(((int) $authUntil - time()) / 60);
        }

        return 0;
    }

    /**
     * Tampilkan daftar rekam jejak aktivitas admin dengan filter dan pencarian.
     */
    public function index(Request $request): View
    {
        $query = ActivityLog::with('user')->latest();

        // 1. Filter Pencarian Kata Kunci
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('user_name', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // 2. Filter Modul
        if ($request->filled('module') && $request->module !== 'all') {
            $query->where('module', $request->module);
        }

        // 3. Filter Tipe Aksi
        if ($request->filled('action') && $request->action !== 'all') {
            $query->where('action', strtoupper($request->action));
        }

        // 4. Filter Periode Waktu
        if ($request->filled('period')) {
            match ($request->period) {
                'today' => $query->whereDate('created_at', today()),
                'week' => $query->where('created_at', '>=', now()->subDays(7)),
                'month' => $query->where('created_at', '>=', now()->subDays(30)),
                default => null,
            };
        }

        // Statistik Cepat untuk Widget
        $totalLogs = ActivityLog::count();
        $todayLogs = ActivityLog::whereDate('created_at', today())->count();
        $approveLogs = ActivityLog::whereIn('action', ['APPROVE', 'ACC_TESTIMONI'])->count();
        $authLogs = ActivityLog::whereIn('action', ['LOGIN', 'LOGOUT'])->count();

        // List unik untuk dropdown filter
        $availableModules = ActivityLog::select('module')->distinct()->orderBy('module')->pluck('module');
        $availableActions = ActivityLog::select('action')->distinct()->orderBy('action')->pluck('action');

        $logs = $query->paginate(20)->withQueryString();

        // Status otorisasi hapus 30 menit
        $isDeleteAuthorized = $this->isDeleteAuthorized();
        $authRemainingMinutes = $this->getDeleteAuthRemainingMinutes();

        return view('admin.logs.index', compact(
            'logs',
            'totalLogs',
            'todayLogs',
            'approveLogs',
            'authLogs',
            'availableModules',
            'availableActions',
            'isDeleteAuthorized',
            'authRemainingMinutes'
        ));
    }

    /**
     * Hapus log individual (memerlukan verifikasi password jika sesi 30 menit tidak aktif).
     */
    public function destroy(Request $request, ActivityLog $log): RedirectResponse
    {
        if (! $this->isDeleteAuthorized()) {
            $request->validate([
                'admin_password' => ['required', 'string'],
            ], [
                'admin_password.required' => 'Password admin wajib diisi untuk otorisasi penghapusan log.',
            ]);

            $user = Auth::user();
            if (! $user || ! Hash::check($request->admin_password, $user->password)) {
                return back()->with('error', 'Password admin salah! Penghapusan log dibatalkan demi keamanan.');
            }

            // Aktifkan sesi otorisasi penghapusan selama 30 menit (1800 detik)
            session(['log_delete_auth_until' => time() + (30 * 60)]);
        }

        $id = $log->id;
        $desc = $log->description;
        $log->delete();

        ActivityLogger::log('DELETE', 'Log Sistem', "Menghapus catatan log #{$id}: {$desc}");

        $remaining = $this->getDeleteAuthRemainingMinutes();

        return back()->with('success', "Catatan log berhasil dihapus. Sesi otorisasi hapus aktif ({$remaining} menit tersisa).");
    }

    /**
     * Pembersihan log lama secara massal (memerlukan verifikasi password jika sesi 30 menit tidak aktif).
     */
    public function clear(Request $request): RedirectResponse
    {
        if (! $this->isDeleteAuthorized()) {
            $request->validate([
                'admin_password' => ['required', 'string'],
            ], [
                'admin_password.required' => 'Password admin wajib diisi untuk otorisasi pembersihan log.',
            ]);

            $user = Auth::user();
            if (! $user || ! Hash::check($request->admin_password, $user->password)) {
                return back()->with('error', 'Password admin salah! Pembersihan log dibatalkan demi keamanan.');
            }

            // Aktifkan sesi otorisasi penghapusan selama 30 menit (1800 detik)
            session(['log_delete_auth_until' => time() + (30 * 60)]);
        }

        $mode = $request->input('mode', 'older_than_30_days');

        if ($mode === 'all') {
            $count = ActivityLog::count();
            ActivityLog::truncate();
            ActivityLogger::log('DELETE', 'Log Sistem', "Membersihkan seluruh data riwayat log ({$count} data dihapus)");
            $message = "Seluruh catatan log ({$count} data) berhasil dibersihkan.";
        } else {
            $deleted = ActivityLog::where('created_at', '<', now()->subDays(30))->delete();
            ActivityLogger::log('DELETE', 'Log Sistem', "Membersihkan log lama lebih dari 30 hari ({$deleted} data dihapus)");
            $message = "Catatan log lebih dari 30 hari yang lalu ({$deleted} data) berhasil dibersihkan.";
        }

        $remaining = $this->getDeleteAuthRemainingMinutes();

        return back()->with('success', "{$message} Sesi otorisasi hapus aktif ({$remaining} menit tersisa).");
    }

    /**
     * Kunci kembali sesi otorisasi penghapusan log sebelum 30 menit berakhir.
     */
    public function lock(Request $request): RedirectResponse
    {
        session()->forget('log_delete_auth_until');

        return back()->with('success', 'Sesi otorisasi penghapusan log berhasil dikunci kembali.');
    }
}
