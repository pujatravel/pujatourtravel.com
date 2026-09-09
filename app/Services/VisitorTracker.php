<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class VisitorTracker
{
    private const CACHE_KEY_VISITORS = 'realtime_active_visitors';

    private const CACHE_KEY_HISTORY = 'realtime_visitor_history';

    private const ACTIVE_TIMEOUT_SECONDS = 60;

    private const MAX_HISTORY_POINTS = 20;

    /**
     * Catat heartbeat / ping dari pengunjung website publik.
     */
    public static function recordPing(string $visitorId, string $url, string $title, string $device = 'desktop', string $action = 'ping'): array
    {
        $now = now()->timestamp;
        $visitors = Cache::get(self::CACHE_KEY_VISITORS, []);

        // Bersihkan pengunjung yang sudah tidak aktif (melebihi 60 detik)
        $visitors = array_filter($visitors, function ($v) use ($now) {
            return isset($v['last_seen']) && ($now - $v['last_seen']) < self::ACTIVE_TIMEOUT_SECONDS;
        });

        if ($action === 'leave') {
            unset($visitors[$visitorId]);
        } else {
            // Normalisasi URL & Title yang aman
            $cleanUrl = parse_url($url, PHP_URL_PATH) ?: '/';
            $cleanTitle = mb_substr(strip_tags($title), 0, 80) ?: 'Halaman Website';
            $validDevice = in_array(strtolower($device), ['mobile', 'tablet', 'desktop']) ? strtolower($device) : 'desktop';

            $visitors[$visitorId] = [
                'url' => $cleanUrl,
                'title' => $cleanTitle,
                'device' => $validDevice,
                'last_seen' => $now,
            ];
        }

        Cache::put(self::CACHE_KEY_VISITORS, $visitors, now()->addMinutes(10));

        $activeCount = count($visitors);
        self::appendHistoryPoint($activeCount);

        return [
            'status' => 'success',
            'active_count' => $activeCount,
        ];
    }

    /**
     * Dapatkan ringkasan statistik pengunjung aktif untuk dashboard admin secara real-time.
     */
    public static function getRealtimeStats(): array
    {
        $now = now()->timestamp;
        $visitors = Cache::get(self::CACHE_KEY_VISITORS, []);

        // Filter aktif dalam 60 detik terakhir
        $activeVisitors = array_filter($visitors, function ($v) use ($now) {
            return isset($v['last_seen']) && ($now - $v['last_seen']) < self::ACTIVE_TIMEOUT_SECONDS;
        });

        $activeCount = count($activeVisitors);

        // Update history point saat dipolling
        $history = self::appendHistoryPoint($activeCount);

        // Agregasi halaman yang sedang dibuka
        $pages = [];
        $devices = ['desktop' => 0, 'mobile' => 0, 'tablet' => 0];

        foreach ($activeVisitors as $v) {
            $url = $v['url'] ?? '/';
            $title = $v['title'] ?? 'Beranda';
            $dev = $v['device'] ?? 'desktop';

            if (! isset($pages[$url])) {
                $pages[$url] = [
                    'url' => $url,
                    'title' => $title,
                    'count' => 0,
                ];
            }
            $pages[$url]['count']++;

            if (isset($devices[$dev])) {
                $devices[$dev]++;
            } else {
                $devices['desktop']++;
            }
        }

        // Urutkan halaman paling banyak pengunjung
        usort($pages, fn ($a, $b) => $b['count'] <=> $a['count']);
        $pages = array_slice($pages, 0, 5);

        // Siapkan data label dan counts untuk Chart.js
        $chartLabels = [];
        $chartData = [];

        foreach ($history as $point) {
            $chartLabels[] = $point['time'];
            $chartData[] = $point['count'];
        }

        return [
            'active_count' => $activeCount,
            'history' => [
                'labels' => $chartLabels,
                'data' => $chartData,
            ],
            'pages' => $pages,
            'devices' => $devices,
            'server_time' => now()->format('H:i:s'),
        ];
    }

    /**
     * Tambahkan titik data baru ke riwayat time-series realtime.
     */
    private static function appendHistoryPoint(int $activeCount): array
    {
        $nowTime = now()->format('H:i:s');
        $history = Cache::get(self::CACHE_KEY_HISTORY, []);

        // Buat titik awal jika history masih kosong agar grafik langsung terisi cantik
        if (empty($history)) {
            for ($i = self::MAX_HISTORY_POINTS - 1; $i >= 1; $i--) {
                $history[] = [
                    'time' => now()->subSeconds($i * 5)->format('H:i:s'),
                    'count' => 0,
                ];
            }
        }

        // Cek jika titik terakhir waktunya sama persis, update nilai terbarunya
        $lastIdx = count($history) - 1;
        if ($lastIdx >= 0 && $history[$lastIdx]['time'] === $nowTime) {
            $history[$lastIdx]['count'] = $activeCount;
        } else {
            $history[] = [
                'time' => $nowTime,
                'count' => $activeCount,
            ];
        }

        // Batasi panjang histori agar memory tetap hemat
        if (count($history) > self::MAX_HISTORY_POINTS) {
            $history = array_slice($history, -self::MAX_HISTORY_POINTS);
        }

        Cache::put(self::CACHE_KEY_HISTORY, $history, now()->addMinutes(15));

        return $history;
    }
}
