<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stok_barang_controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\akun_controller;
use App\Http\Controllers\mutasi_controller;





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

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/order', function () {
    return view('lapangan.order');
});

//stok_barang
Route::resource('/stok_barang', stok_barang_controller::class);

//mutasi
Route::resource('/mutasi', mutasi_controller::class);
Route::post('/updateMutasi', [mutasi_controller::class,'updateMutasiLapangan'])->name('updateMutasiLapangan');
Route::get('/terimaMutasi', [mutasi_controller::class,'terimaMutasi']);


//login
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/login', [AuthController::class, 'login']);

//stok_barang
Route::resource('/akun', akun_controller::class);







