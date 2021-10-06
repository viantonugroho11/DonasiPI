<?php

use Illuminate\Support\Facades\Route;

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


//admin
Route::middleware('auth:admin')->group(function(){
    Route::resource('/adminis/gallery',   App\Http\Controllers\Admin\GalleryController::class);
    Route::resource('/adminis/kategori',  App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('/adminis/program',   App\Http\Controllers\Admin\ProgramController::class);
    Route::resource('/adminis/artikel',   App\Http\Controllers\Admin\ArtikelController::class);
    Route::resource('/adminis/transaksi', App\Http\Controllers\Admin\TransaksiController::class);
    Route::resource('/adminis/event',     App\Http\Controllers\Admin\EventController::class);
    Route::resource('/adminis/profiladmin',     App\Http\Controllers\Admin\ProfilController::class);
    Route::get('/adminis/laporan/transaksi', [App\Http\Controllers\Admin\LaporanController::class,'indextransaksi'])->name('laporan.transaksi');
    Route::get('/adminis/laporan/user', [App\Http\Controllers\Admin\LaporanController::class,'indexuser'])->name('laporan.user');
    Route::get('/adminis/laporan/program', [App\Http\Controllers\Admin\LaporanController::class,'indexprogram'])->name('laporan.program');
    Route::get('/adminis', [App\Http\Controllers\Admin\HomeController::class,'index'])->name('administrator');
});
//login user
Auth::routes(['verify' => true]);

//login admin
Route::get('loginadmin', [App\Http\Controllers\Auth\AdminLoginController::class,'getLogin'])->name('adminlogin');
Route::post('loginadmin', [App\Http\Controllers\Auth\AdminLoginController::class,'postLogin']);
Route::get('logoutadmin', [App\Http\Controllers\Auth\AdminLoginController::class,'postLogout'])->name('adminlogout');

//Transaksi
Route::get('/Transaksi/Finish', [App\Http\Controllers\User\TransaksiController::class,'finish']);
Route::post('/notification-handler', [App\Http\Controllers\User\TransaksiController::class,'notifikasi']);

// Route::post('/Transaksi/UnFinish', [App\Http\Controllers\User\TransaksiLoginController::class,'store']);
Route::middleware(['auth','verified'])->group(function(){
    Route::post('/Transaksi/Pay', [App\Http\Controllers\User\TransaksiController::class,'store'])->name('PayDonasi');
    //Riwayat
    Route::get('/Riwayat', [App\Http\Controllers\User\ProfilController::class, 'riwayat'])->name('riwayatuser');

    //topup
    Route::get('/Topup', [App\Http\Controllers\User\SaldoController::class,'index'])->name('saldouser');
    Route::post('/Topup/Pay', [App\Http\Controllers\User\SaldoController::class,'store'])->name('SaldoPay');
});
Route::middleware('auth')->group(function(){
    //Profil
    Route::get('/Profil', [App\Http\Controllers\User\ProfilController::class, 'index'])->name('profiluser');
    //Profil
    Route::post('/Profil/ganti', [App\Http\Controllers\User\ProfilController::class, 'ganti'])->name('profiluser.ganti');
});

Route::get('/Event/{id}', [App\Http\Controllers\User\EventController::class, 'show'])->name('eventuser.show');
Route::POST('/Event/store', [App\Http\Controllers\User\EventController::class, 'store'])->name('eventuser.store');
// route::middleware('verified')->group(function(){

Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');

//program
Route::get('/Kategori', [App\Http\Controllers\User\HomeController::class, 'indexkategori'])->name('kategoriuser');
Route::get('/Kategori/{id}', [App\Http\Controllers\User\ProgramController::class, 'index'])->name('programuser');
Route::get('/Donasi/{id}', [App\Http\Controllers\User\ProgramController::class, 'show'])->name('programuser.show');

//newsletter
Route::post('/Newsletter', [App\Http\Controllers\User\ProfilController::class, 'emailnotif'])->name('newsuser');
//artikel
Route::get('/Artikels', [App\Http\Controllers\User\ArtikelController::class, 'index'])->name('artikeluser');
Route::get('/Artikels/Show/{id}', [App\Http\Controllers\User\ArtikelController::class, 'show'])->name('artikeluser.show');
Route::post('/Artikels/Kategori/', [App\Http\Controllers\User\ArtikelController::class, 'artikelkategori'])->name('artikeluser.kategori');

//Gallery
Route::get('/Gallery', [App\Http\Controllers\User\GalleryController::class, 'index'])->name('galleryuser');

//Events
Route::get('/Event', [App\Http\Controllers\User\EventController::class, 'index'])->name('eventuser');

//Daftar Akun Via Luar
Route::get('/auth/{provider}', [App\Http\Controllers\Auth\SocialiteController::class,'redirectToProvider']);
Route::get('/auth/{provider}/callback', [App\Http\Controllers\Auth\SocialiteController::class,'handleProvideCallback']);

