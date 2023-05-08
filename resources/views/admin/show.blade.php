@extends('layouts.app')

@section('content')
 <head>
  <link rel="stylesheet" href="/css/style.css">
 </head>
<main class="main">
  <div class="container-fluid">
      <main role="main">
              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
        <div>
          <h1 class="h2">アイテム詳細</h1>
        </div>
<div class="table-responsive container">
<ul class="list-group m-2">
  <li class="list-group-item active" aria-current="true">商品コード</li>
  <li class="list-group-item">{{$item->id}}</li>
</ul>
<ul class="list-group m-2">
  <li class="list-group-item active" aria-current="true">名前</li>
  <li class="list-group-item">{{$item->name}}</li>
</ul>
<ul class="list-group m-2">
  <li class="list-group-item active" aria-current="true">URL</li>
  <li class="list-group-item">{{$item->url}}</li>
</ul>
<ul class="list-group m-2">
  <li class="list-group-item active" aria-current="true">種別</li>
  <li class="list-group-item">
    @if ($item->type == 1)
    レジャー施設
    @elseif($item->type == 2)
    娯楽・サービス施設
    @elseif($item->type == 3)
    絶景
    @endif
  </li>
</ul>
<ul class="list-group m-2">
  <li class="list-group-item active" aria-current="true">作成日</li>
  <li class="list-group-item">{{$item->created_at}}</li>
</ul>
<ul class="list-group m-2">
  <li class="list-group-item active" aria-current="true">更新日</li>
  <li class="list-group-item">{{$item->updated_at}}</li>
</ul>

<div class="image-size" style="width:200px">
  @if(isset($item->image_pass))
  <img class="image" src="{{ asset($item->image_pass) }}" style="width:100%">
  @else
  <img src="/images/no_image.jpeg">
  @endif
</div>

  <td><a class="btn btn-dark" href="{{route('admin.index')}}">戻る</a></td>
</div>
      </main>
</div>
  </main>


  @endsection