@extends('layouts.app')

@section('content')

<table class="table table-striped container">
  <div class="container mb-2">
    <a class="btn btn-primary btn-lg" href="{{route('admin.create')}}">追加</a>
  </div>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">施設名</th>
      <th scope="col">住所</th>
      <th scope="col">説明</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($items as $item )
    <tr>
      <th scope="row">{{$item->id}}</th>
      <td>{{$item->name}}</td>
      <td>{{$item->address}}</td>
      <td>{{ Str::limit($item->detail, 15, '...') }}</td>
      <td><a href="{{route('admin.show',$item->id)}}" class="btn btn-success">詳細</a></td>
      <td><a href="{{route('admin.edit',$item->id)}}" class="btn btn-outline-success">編集</a></td>
      <td><form action="{{route('admin.destroy',$item->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="削除" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか??')">
       </form></td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
