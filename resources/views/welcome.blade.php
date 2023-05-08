<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>琵琶湖マップ</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/a4cea4eec9.js" crossorigin="anonymous"></script>
</head>
<body class="antialiased">
  @extends('layouts.header')
  @section('content')

  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/images/lake1.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="/images/lake2.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="/images/lake3.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="main-map">

    <div class="search">
      <h2>検索</h2>
    <form action="{{route('map')}}" method="get" class="mb-4">
      <div class="mb-3">
        <label for="name" class="form-label">施設検索</label>
        <input type="text" class="form-control" id="name" name="search1" placeholder="施設名前検索" value="{{request()->search1}}" >
      </div>
      <div class="mb-3">
        <label for="type" class="form-label">カテゴリー</label>
        <select name="search2" class="form-select" id='type'>
          <option value="">選択してください</option>
          <option value="1" {{request()->search2 =='1'? "selected" : "";}}>レジャー施設</option>
          <option value="2" {{request()->search2 =='2'? "selected" : "";}}>娯楽・サービス施設</option>
          <option value="3" {{request()->search2 =='3'? "selected" : "";}}>飲食店</option>
      </select>
      </div>
      <button type="submit" class="btn btn-primary">検索</button>
      <a href="{{route('map')}}"><img src="/images/reload.png" alt="" style="width: 20px;margin-left:20px;"></a>
    </form>
  </div>

    <div id="map"></div>
  </div>
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
      } else if(type == 2) {
        iconUrl = '/images/icon2.png';
      }else if(type == 3){
        iconUrl = '/images/icon3.png';
      }
      var marker = new google.maps.Marker({
        position: results[0].geometry.location,
        map: map,
        icon: iconUrl,
        animation: google.maps.Animation.DROP
      });
  
      var infoWindow = new google.maps.InfoWindow({
        content: '<h3><p>' + name + '</p></h3><div><p>' + addressname + '</p></div><a href="' + getAddressUrl({{ $item->id }}) + '">詳細を見る</a>'
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


    {{-- カルーセル --}}
  <div class="cards">
    <div class="top-section">
      <h2 class="new_info_head"><i class="far fa-lightbulb new-menu"></i><span>最新情報</span></h2>
    </div>
    <div class="card_wrapper container">
      @foreach ($items as $index => $item )
      @if($index < 6)
      <div class="col-md-3 card_content">
        <div class="card">
          @if(isset($item->image_pass))
          <img src="{{asset($item->image_pass)}}" class="card-img-top" alt="...">
          @else
          <img src="/images/no_image.jpeg" class="card-img-top">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{$item->name}}</h5>
            <p class="card-text">{{Str::limit($item->detail, 30, '...')}}</p>
            <a href="{{route('address.show',$item->id)}}" class="btn btn-primary">詳しく見る</a>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>

    @endsection
</body>
</html>





