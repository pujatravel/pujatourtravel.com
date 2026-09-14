<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ActivityLogger
{
    /**
     * Catat aktivitas admin ke dalam tabel activity_logs secara aman.
     */
    public static function log(
        string $action,
        string $module,
        string $description,
        ?array $properties = null,
        ?User $user = null
    ): ?ActivityLog {
        try {
            $currentUser = $user ?? Auth::user();
            $request = request();

            $ip = $request ? $request->ip() : '127.0.0.1';
            $userAgent = $request ? $request->userAgent() : null;

            $location = self::resolveLocation($ip);
            $device = self::parseDevice($userAgent);

            return ActivityLog::create([
                'user_id' => $currentUser?->id,
                'user_name' => $currentUser?->name ?? 'Administrator',
                'action' => strtoupper($action),
                'module' => $module,
                'description' => $description,
                'ip_address' => $ip,
                'location' => $location,
                'device' => $device,
                'user_agent' => $userAgent ? mb_substr($userAgent, 0, 500) : null,
                'properties' => $properties,
            ]);
        } catch (Throwable $e) {
            Log::warning('Gagal mencatat ActivityLog: ' . $e->getMessage(), [
                'action' => $action,
                'module' => $module,
            ]);
            return null;
        }
    }

    /**
     * Deteksi lokasi geografis berdasarkan IP Address (dengan caching & timeout aman).
     */
    public static function resolveLocation(?string $ip): string
    {
        if (empty($ip)) {
            return 'Lokasi Tidak Diketahui';
        }

        // Penanganan alamat IP lokal / loopback / subnet private
        if (
            in_array($ip, ['127.0.0.1', '::1']) ||
            str_starts_with($ip, '192.168.') ||
            str_starts_with($ip, '10.') ||
            str_starts_with($ip, '172.16.')
        ) {
            return 'Jaringan Lokal (Development • Pangandaran, ID)';
        }

        // Cache hasil query geolokasi IP selama 7 hari
        return Cache::remember('ip_geo_' . $ip, now()->addDays(7), function () use ($ip) {
            try {
                $response = Http::timeout(1.5)->get("http://ip-api.com/json/{$ip}?fields=status,country,countryCode,regionName,city");
                if ($response->successful() && $response->json('status') === 'success') {
                    $city = $response->json('city');
                    $region = $response->json('regionName');
                    $countryCode = $response->json('countryCode');

                    $parts = array_filter([$city, $region, $countryCode]);
                    if (!empty($parts)) {
                        return implode(', ', $parts);
                    }
                    return $response->json('country') ?? 'Indonesia';
                }
            } catch (Throwable) {
                // Jangan lempar error jika koneksi eksternal lambat/offline
            }

            return 'Indonesia (IP Terdeteksi)';
        });
    }

    /**
     * Parse User-Agent menjadi string ringkas OS & Browser.
     */
    public static function parseDevice(?string $userAgent): string
    {
        if (empty($userAgent)) {
            return 'Perangkat Tidak Diketahui';
        }

        // Deteksi Sistem Operasi
        $os = 'Lainnya';
        if (preg_match('/windows|win32/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iphone|ipad|ipod/i', $userAgent)) {
            $os = 'iOS';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/linux/i', $userAgent)) {
            $os = 'Linux';
        }

        // Deteksi Peramban (Browser)
        $browser = 'Browser';
        if (preg_match('/edg/i', $userAgent)) {
            $browser = 'Edge';
        } elseif (preg_match('/chrome|crios/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/firefox|fxios/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome|crios/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/opera|opr/i', $userAgent)) {
            $browser = 'Opera';
        }

        return "{$os} • {$browser}";
    }
}
