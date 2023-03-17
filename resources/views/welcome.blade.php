<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Google Maps JavaScript API</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body class="antialiased">
    <div id="map"></div>
@php
        // $address =array(
        //     '滋賀県彦根市長曽根南町４７２−２',
        //     '滋賀県長浜市南呉服町１１−２８',
        // );
        foreach ($items as $item) {
            $address[] = "{{$item->address}}";
        }
        print_r($address);
        $param_json = json_encode($address); //JSONエンコード
        
    @endphp
    <script>
        function initMap() {
         
          var target = document.getElementById('map'); //マップを表示する要素を指定
          var addresses = JSON.parse('<?php echo $param_json; ?>'); //住所を指定
          var geocoder = new google.maps.Geocoder();
          var map = new google.maps.Map(target, {
                 center: { lat: 35.300250, lng: 136.122680 } ,
                 zoom: 10
               });
                 // 各マーカーのインスタンスとInfoWindowのインスタンスを配列で保持する
        var markers = [];
        var infoWindows = [];
               addresses.forEach(function(address) {
        geocoder.geocode({ address: address }, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            var marker = new google.maps.Marker({
              position: results[0].geometry.location,
              map: map,
              animation: google.maps.Animation.DROP
            });

                // 情報ウィンドウを表示するための内容を指定する
                var infoWindow = new google.maps.InfoWindow({
                    content: '<div><p>' + address + '</p></div>'

            });
            
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
      });

        }
        </script>




    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUO3LyylA7NTT5Pzq9ROi2B1e94OAgF6E&callback=initMap" async defer></script>
</body>
</html>

