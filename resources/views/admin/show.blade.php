@extends('layouts.app')

@section('content')

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
  <li class="list-group-item active" aria-current="true">種別</li>
  <li class="list-group-item">{{$item->detail}}</li>
</ul>
<ul class="list-group m-2">
  <li class="list-group-item active" aria-current="true">作成日</li>
  <li class="list-group-item">{{$item->created_at}}</li>
</ul>
<ul class="list-group m-2">
  <li class="list-group-item active" aria-current="true">更新日</li>
  <li class="list-group-item">{{$item->updated_at}}</li>
</ul>
  <td><a class="btn btn-dark" href="{{route('admin.index')}}">戻る</a></td>
</div>
      </main>
</div>
  </main>

  @endsection