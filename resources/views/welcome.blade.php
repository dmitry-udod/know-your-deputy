<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="{{ asset('js/ol.js') }}"></script>
        <script src="{{ asset('js/map.js') }}"></script>                

        <style type="text/css">
            #map{height: 100%;}

            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body>
        <div id="map"></div>
        <script>
        function initMap() {
            gmap = new google.maps.Map(document.getElementById('map'), {
                disableDefaultUI : false,
                keyboardShortcuts : false,
                draggable : true,
                disableDoubleClickZoom : true,
                scrollwheel : false,
                streetViewControl : false,
                zoom : 13,
                center : new google.maps.LatLng(46.787, 36.79)
            });
            drawDistricts('{!! base64_encode(\App\Models\District::with('deputy')->get()->toJson()) !!}');
        }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
    </body>
</html>

