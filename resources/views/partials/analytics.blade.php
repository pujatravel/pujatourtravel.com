@php
    $gaMeasurementId = config('services.ga.measurement_id');
@endphp

@if(!empty($gaMeasurementId))
    <!-- Google tag (gtag.js) GA4 Non-blocking -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaMeasurementId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaMeasurementId }}', {
            'anonymize_ip': true
        });

        // Client-side Custom Event Dispatcher (Zero PII, Ad-blocker safe)
        window.trackPujaEvent = function(eventName, params) {
            if (typeof window.gtag === 'function') {
                window.gtag('event', eventName, params || {});
            }
        };
    </script>
@else
    <script>
        // Fallback stub when GA4 is disabled or blocked
        window.trackPujaEvent = function(eventName, params) {
            // No-op stub ensures zero console errors
        };
    </script>
@endif

<!-- Lightweight Realtime Visitor Tracking Heartbeat (Zero PII, Safe) -->
<script>
    (function() {
        try {
            // Unik session id per tab
            var storageKey = 'puja_vis_id';
            var visitorId = sessionStorage.getItem(storageKey);
            if (!visitorId) {
                visitorId = 'v_' + Math.random().toString(36).substring(2, 12) + '_' + Date.now().toString(36);
                sessionStorage.setItem(storageKey, visitorId);
            }

            // Deteksi device
            var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var device = 'desktop';
            if (width < 768) {
                device = 'mobile';
            } else if (width < 1024) {
                device = 'tablet';
            }

            var pingUrl = '{{ route("visitor.ping") }}';

            function sendPing(action) {
                action = action || 'ping';
                var payload = JSON.stringify({
                    visitor_id: visitorId,
                    url: window.location.pathname,
                    title: document.title || 'Puja Tour & Travel',
                    device: device,
                    action: action
                });

                if (navigator.sendBeacon && action === 'leave') {
                    var blob = new Blob([payload], { type: 'application/json' });
                    navigator.sendBeacon(pingUrl, blob);
                } else {
                    fetch(pingUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: payload,
                        keepalive: true
                    }).catch(function() {});
                }
            }

            // Ping pertama kali halaman terbuka
            sendPing('ping');

            // Heartbeat berkala tiap 15 detik jika halaman sedang aktif dilihat
            var heartbeatInterval = setInterval(function() {
                if (document.visibilityState === 'visible') {
                    sendPing('ping');
                }
            }, 15000);

            // Tangani saat tab ditinggalkan atau ditutup
            window.addEventListener('pagehide', function() {
                sendPing('leave');
            });

            document.addEventListener('visibilitychange', function() {
                if (document.visibilityState === 'visible') {
                    sendPing('ping');
                }
            });
        } catch (err) {
            // Fail-safe: pastikan tidak mengganggu script lain
        }
    })();
</script>
