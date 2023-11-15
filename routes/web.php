<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stok_barang_controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\akun_controller;




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

Route::get('/', function () {
    return view('login');
});
Route::get('/master', function () {
    return view('layout.master');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/order', function () {
    return view('lapangan.order');
});
Route::get('/mutasi', function () {
    return view('lapangan.mutasi');
});
Route::get('/login', function () {
    return view('login');
});


//stok_barang
Route::resource('/stok_barang', stok_barang_controller::class);

//login
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout']);

//stok_barang
Route::resource('/akun', akun_controller::class);







