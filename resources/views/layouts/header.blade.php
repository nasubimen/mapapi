<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="icon-size">
        <a href=""><img src="/images/lakemap.png" alt=""></a>
      </div>
      <a class="navbar-brand" href="{{route('map')}}"><img src="/images/headerlogo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">ホーム画面</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">このサイトについて</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">登録画面</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div>
    @yield('title')
  </div>
</header>

<style>
  .bg-light{
    background-color: #afeeee !important;
  }
.icon-size{
  width: 52px;
}
.icon-size a img{
  width: 100%
}

</style>

@yield('content')
