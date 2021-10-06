<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function(){

});

Route::get('/home', [App\Http\Controllers\Api\HomeController::class, 'index']);
Route::get('/home/kategori', [App\Http\Controllers\Api\HomeController::class, 'kategori']);

//program
Route::get('/program/{id}', [App\Http\Controllers\Api\ProgramController::class, 'index']);
Route::get('/program/show/{id}', [App\Http\Controllers\Api\ProgramController::class, 'show']);
Route::get('/program/jumlah/{id}', [App\Http\Controllers\Api\ProgramController::class, 'jumlah']);
Route::get('/program/indextrans/{id}', [App\Http\Controllers\Api\ProgramController::class, 'indextrans']);

//transaksi
Route::post('/transaksi/donasi',[App\Http\Controllers\Api\TransaksiController::class, 'store']);
Route::post('/transaksi/donasi/finish',[App\Http\Controllers\Api\TransaksiController::class, 'finish']);

//gallery
Route::get('/gallery', [App\Http\Controllers\Api\GalleryController::class, 'index']);
Route::get('/gallery/{id}', [App\Http\Controllers\Api\GalleryController::class, 'indexgallery']);

//artikel
Route::get('/artikel', [App\Http\Controllers\Api\ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [App\Http\Controllers\Api\ArtikelController::class, 'indexartikel']);
Route::get('/artikel/show/{id}', [App\Http\Controllers\Api\ArtikelController::class, 'show']);

//event
Route::get('/event/show/{id}', [App\Http\Controllers\Api\EventController::class, 'show']);
Route::get('/event', [App\Http\Controllers\Api\EventController::class, 'index']);

//profil
Route::get('/profil', [App\Http\Controllers\Api\ProfilController::class, 'index']);

Route::post('/register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Api\UserController::class, 'logout'])->middleware('auth:api');
