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
  Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
    Route::post('store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
    Route::get('/{id}', [App\Http\Controllers\AdminController::class, 'show'])->name('admin.show');
    Route::get('/{id}/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');
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

