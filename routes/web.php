<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 一般ユーザーのみアクセスできるルーティング
Route::middleware('auth')->group(function(){
  // アイテム画面
  Route::prefix('item')->group(function () {
  });
});





Route::get('/', [MapController::class, 'index'])->name('map');

Route::prefix('address')->group(function () {
  Route::get('/', [App\Http\Controllers\AddressController::class, 'index'])->name('address.index');
  Route::get('/log', [App\Http\Controllers\AddressController::class, 'index']);
  Route::get('/add', [App\Http\Controllers\AddressController::class, 'add']);
  Route::post('/add', [App\Http\Controllers\AddressController::class, 'add']);
  // 以下新機能のRoute
  Route::get('/{id}', [App\Http\Controllers\AddressController::class, 'show'])->name('address.show');
});

