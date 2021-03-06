<?php

use App\Http\Livewire\Homepage;
use App\Http\Livewire\KeranjangUser;
use App\Http\Livewire\OngkosKirim;
use App\Http\Livewire\Pembayaran;
use App\Http\Livewire\TambahProduk;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', Homepage::class);
Route::middleware('auth')->group(function () {
    Route::get('/tambah-produk', TambahProduk::class);
    Route::get('/keranjang', KeranjangUser::class);
    Route::get('/ongkos-kirim/{id}', OngkosKirim::class);
    Route::get('/pembayaran/{id}', Pembayaran::class);
});
