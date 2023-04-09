<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="/css/style.css">
  <title>Document</title>
</head>
      <body>

        @extends('layouts.header')
        @section('content')

        <div class="title" style="background-color:#4484db;margin-top:40px;">
          <h2 style="color:white;text-align:center;padding:40px 0px;">{{$item->name}}</h2>
        </div>

        <div class="container" style="margin-top: 50px">
          <div class="header">
            <p>更新日:{{$item->updated_at}}</p>
          </div>
          <div class="main" style="display:flex;flex-wrap:wrap;">
            <div class="image-size" style="width:40%">
              <img class="image" src="{{ asset($item->image_pass) }}" style="width:100%">
            </div>
            <div class="content" style="margin-left: 50px;width:40%;">
              <!-- 内容部分 -->
              <p>{{$item->detail}}</p>
              <div class="related">

                @if (!empty($item->url))
                <a class="btn btn-outline-primary" href="{{$item->url}}">詳しくはこちら</a>
                @endif

              </div>
            </div>
            
          </div>


          <div id="mapShow"></div>

          <script>
            function initMap() {
                var target = document.getElementById('mapShow'); // マップを表示する要素を指定
                var geocoder = new google.maps.Geocoder();
                var address = "{{ htmlspecialchars($item->address) }}";
                geocoder.geocode({ address: address }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        var name = "{{ htmlspecialchars($item->name) }}";
                        var type = "{{ htmlspecialchars($item->type) }}";
                        var iconUrl;
        
                        if (type == 1) {
                            iconUrl = '/images/icon1.png';
                        } else if(type == 2) {
                            iconUrl = '/images/icon2.png';
                        }else if(type == 3){
                            iconUrl = '/images/icon3.png';
                        }
        
                        var map = new google.maps.Map(target, {
                            center: results[0].geometry.location,
                            zoom: 15
                        });
        
                        var marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            icon: iconUrl,
                            animation: google.maps.Animation.DROP
                        });
        
                        var infoWindow = new google.maps.InfoWindow({
                            content: '<h3><p>' + name + '</p></h3><div><p>' + address + '</p></div><a href="' + getAddressUrl({{ $item->id }}) + '">詳細を見る</a>'
                        });
        
                        function getAddressUrl(id) {
                            return '{{ route('address.show',$item->id) }}';
                        }
        
                        marker.addListener('click', function() {
                            infoWindow.open(map, marker);
                        });
                    } else {
                        console.log('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
        </script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUO3LyylA7NTT5Pzq9ROi2B1e94OAgF6E&callback=initMap" async defer></script>



        </div>
        <div class="footer">
          <!-- フッター部分 -->
        </div>
        @endsection
      </body>
</html>