<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
      <body>

        @extends('layouts.header')
        @section('content')
        <div class="container">
          <div class="header">
          </div>
          <div class="main">
            <div class="title">
              <h2>{{$item->name}}</h2>
            </div>
            <div class="content">
              <!-- 内容部分 -->
              <p>{{$item->detail}}</p>
            </div>
            <div class="related">
              <!-- 関連情報部分 -->
            </div>
          </div>
          <div class="footer">
            <!-- フッター部分 -->
          </div>
        </div>
        @endsection
      </body>
</html>