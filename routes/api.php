<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// RUTE PUBLIK (Tanpa Token)
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

// RUTE TERPROTEKSI (Wajib Menggunakan Token JWT)
Route::middleware('jwt')->group(function () {
    
    // Auth Protected
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    // Product Routes (Semua Method CRUD Terproteksi)
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Kategori Routes (Semua Method CRUD Terproteksi)
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

});