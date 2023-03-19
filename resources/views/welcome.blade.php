<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Google Maps JavaScript API</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="antialiased">
  @extends('layouts.header')
  @section('content')
    <div id="map"></div>
    <script>

    </script>
    <script>
        function initMap() {
          var target = document.getElementById('map'); //マップを表示する要素を指定
          var geocoder = new google.maps.Geocoder();
          var map = new google.maps.Map(target, {
                 center: { lat: 35.250307, lng: 136.100611} ,
                 zoom: 10
               });
                 // 各マーカーのインスタンスとInfoWindowのインスタンスを配列で保持する
        var markers = [];
        var infoWindows = [];
        @foreach ($items as $item )
        console.log(name);
        var address = "{{ htmlspecialchars($item->address) }}";
        geocoder.geocode({ address: address }, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                var addressname = "{{ htmlspecialchars($item->address) }}";
                var name = "{{ htmlspecialchars($item->name) }}";
                var type = "{{ htmlspecialchars($item->type) }}";

            var iconUrl;

            if (type == 1) {
              iconUrl = '/images/icon1.png';
            } else {
              iconUrl = '/images/icon2.png';
            }
            var marker = new google.maps.Marker({
              position: results[0].geometry.location,
              map: map,
              icon: iconUrl,
              animation: google.maps.Animation.DROP
            });

            var infoWindow = new google.maps.InfoWindow({
              content: '<h2><p>' + name + '</p></h2><div><p>' + addressname + '</p></div><a href="' + getAddressUrl({{ $item->id }}) + '">詳細を見る</a>'
            });

            function getAddressUrl(id) {
              return '{{ route('address.show',$item->id) }}';
            }

                marker.addListener('click', function() {
              // 他のInfoWindowを閉じる
              infoWindows.forEach(function(infoWindow) {
                infoWindow.close();
              });
              
              // このマーカーに紐づくInfoWindowを開く
              infoWindow.open(map, marker);
            });
            
            markers.push(marker);
            infoWindows.push(infoWindow);
          } else {
            console.log('Geocode was not successful for the following reason: ' + status);
          }
        });
        @endforeach

        }
        </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUO3LyylA7NTT5Pzq9ROi2B1e94OAgF6E&callback=initMap" async defer></script>
    @endsection
</body>
</html>

