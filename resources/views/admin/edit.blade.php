@extends('layouts.app')

@section('content')

<head>
{{-- <script src="{{ asset('js/form.js') }}"></script>

</head> --}}

<form class="container mt-3" action="{{route('admin.update',$item->id)}}" method="post">
  @method('PUT')
  @if ($errors->any())
  <ul>
      @foreach ($errors->all() as $error)
          <li  class="alert alert-warning">{{ $error }}</li>
      @endforeach
  </ul>
@endif
@csrf

<div id="form-clone">
  <div class="form-content">
    <div class="form-group">
      <label class="label" for="name">名前</label>
      <input type="text" class="form-control"  name="name" id="name" value="{{$item->name}}">
    </div>
    <div class="form-group mt-2">
      <label class="label" for="address">住所</label>
      <input type="text" class="form-control"  name="address" id="address" value="{{$item->address}}">
    </div>
    <div class="form-group mt-2">
      <label class="label" for="url">URL</label>
      <input type="text" class="form-control"  name="url" id="url" value="{{$item->url}}">
    </div>
    <div class="form-group mt-2">
      <label class="label" for="type">ジャンル</label></label>
      <select class="form-select" id="type" name="type">
        <option value="">選択してください</option>
        <option value="1" {{"$item->type" === "1" ? "selected" : "";}}>レジャー施設</option>
        <option value="2" {{"$item->type" === "2" ? "selected" : "";}}>サービス施設</option>
        <option value="3" {{"$item->tyoe" === "3" ? "selected" : "";}}>飲食店</option>
      </select>
    </div>
    <div class="form-group mt-2">
      <label for="detail">詳細</label>
      <textarea class="form-control" id="detail" name="detail" placeholder="詳細を入力してください" rows="3">{{$item->detail}}</textarea>
    </div>
  </div>
</div>
<button type="submit" class="btn btn-primary mt-2">編集</button>
<a class="btn btn-dark mt-2" href="{{route('admin.index')}}">戻る</a>
</form>


@endsection

<style>
  .form-content{
    background-color:#bcf4ff ;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
  }
</style>