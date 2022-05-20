<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('product', [ProductController::class, 'index'])->name('listbuku');
    Route::get('product/buat', [ProductController::class, 'create'])->name('buatbuku');
    Route::post('product/buat', [ProductController::class, 'simpan'])->name('simpanbuku');
});

// cart
Route::get('/cart', [CartController::class, 'index'])->name('lihatcart');
Route::post('/cart', [CartController::class, 'simpan'])->name('simpancart');
Route::get('/cart/{id}/hapus', [CartController::class, 'destroy'])->name('hapuscart');


Auth::routes();

