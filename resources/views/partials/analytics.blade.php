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
