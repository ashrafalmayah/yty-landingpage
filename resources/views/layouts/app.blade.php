<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YTY — Yemen Tech Youth | حاضنة ومساحات عمل احترافية</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(config('services.meta.pixel_id'))
        @php
            $pageViewEventId = \App\Helpers\MetaHelper::getEventId();
            \App\Jobs\SendMetaEventJob::dispatch(
                'PageView',
                $pageViewEventId,
                time(),
                request()->url(),
                \App\Helpers\MetaHelper::getUserData(request())
            );
            $queuedMetaEvents = \App\Helpers\MetaHelper::getAllEvents();
            $advancedMatching = \App\Helpers\MetaHelper::getAdvancedMatchingData();
        @endphp
        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        @if(!empty($advancedMatching))
        fbq('init', '{{ config("services.meta.pixel_id") }}', @json($advancedMatching));
        @else
        fbq('init', '{{ config("services.meta.pixel_id") }}');
        @endif
        fbq('track', 'PageView', {}, { eventID: '{{ $pageViewEventId }}' });

        @foreach($queuedMetaEvents as $metaEvent)
            fbq('track', '{{ $metaEvent["name"] }}', @json($metaEvent["data"]), { eventID: '{{ $metaEvent["id"] }}' });
        @endforeach

        window.trackMetaContact = function(channel, url) {
            var eventId = 'contact_' + Date.now() + '_' + Math.random().toString(36).substr(2, 7);
            if (window.fbq) {
                fbq('track', 'Contact', { content_name: channel }, { eventID: eventId });
            }
            fetch('{{ route("meta.contact") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Event-ID': eventId
                },
                body: JSON.stringify({ channel: channel })
            }).catch(function() {});

            if (url && url !== '#') {
                setTimeout(function() {
                    window.open(url, '_blank');
                }, 150);
            }
        };
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                 src="https://www.facebook.com/tr?id={{ config('services.meta.pixel_id') }}&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Meta Pixel Code -->
    @endif
</head>
<body style="font-family: 'Cairo', 'Tajawal', sans-serif; background-color: #f0f4f8;" class="min-h-screen text-slate-800 antialiased">
    @yield('content')
</body>
</html>
