@extends('layouts.app')

@section('content')

<head>
{{-- <script src="{{ asset('js/form.js') }}"></script>

</head> --}}

<form class="container mt-3" action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
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
      <input type="text" class="form-control"  name="name[]" id="name">
    </div>
    <div class="form-group mt-2">
      <label class="label" for="address">住所</label>
      <input type="text" class="form-control"  name="address[]" id="address">
    </div>
    <div class="form-group mt-2">
      <label class="label" for="url">URL</label>
      <input type="text" class="form-control"  name="url[]" id="url">
    </div>
    <div class="form-group mt-2">
      <label class="label" for="type">ジャンル</label></label>
      <select class="form-select" id="type" name="type[]">
        <option value="">選択してください</option>
        <option value="1">レジャー施設</option>
        <option value="2">サービス施設</option>
        <option value="3">飲食店</option>
      </select>
    </div>
    <div class="form-group mt-2">
      <label for="detail">詳細</label>
      <textarea class="form-control" id="detail" name="detail[]" placeholder="詳細を入力してください" rows="3"></textarea>
    </div>

    <div class="mt-2">
      <label for="formFile" class="form-label">写真を入れてください（任意）</label>
      <input class="form-control" type="file" name="image[]" id="formFile">
    </div>
  </div>
</div>

<button type="button"  id="addbutton" class="btn btn-primary mt-2">複製</button>
<button type="submit" class="btn btn-primary mt-2">登録</button>
<a class="btn btn-dark mt-2" href="{{route('admin.index')}}">戻る</a>
</form>


@endsection

@push('scripts')
<script src="{{ asset('js/form.js') }}" defer></script>
@endpush
<style>
  .form-content{
    background-color:#bcf4ff ;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
  }
</style>