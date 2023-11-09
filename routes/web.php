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

Route::get('/', function () {
    return view('dashboard');
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
Route::get('/akun', function () {
    return view('akun');
});
Route::get('/stok', function () {
    return view('stok_barang');
});



