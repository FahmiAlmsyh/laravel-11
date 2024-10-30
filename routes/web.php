<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenulisController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('backend.dashboard.index');
    });
    Route::get('/buku', [BukuController::class, 'index'])->name('buku');
    Route::get('/buku/create', [BukuController::class, 'create']);
    Route::get('/buku/{buku}/edit', [BukuController::class, 'edit'])->name('edit');
    Route::get('/buku/{buku}/show', [BukuController::class, 'show'])->name('show');
    Route::post('/buku/store', [BukuController::class, 'store']);
    Route::post('/buku/{buku}/update', [BukuController::class, 'update'])->name('update');
    Route::get('/buku/{buku}/destroy', [BukuController::class, 'destroy'])->name('destroy');

    Route::get('/penulis', [PenulisController::class, 'index'])->name('penulis');
    Route::get('/penulis/create', [PenulisController::class, 'create'])->name('penulis_create');
    Route::post('/penulis/store', [PenulisController::class, 'store'])->name('penulis_store');
    Route::get('/penulis/{penulis}/show', [PenulisController::class, 'show'])->name('penulis_show');
    Route::get('/penulis/{penulis}/edit', [PenulisController::class, 'edit'])->name('penulis_edit');
    Route::post('/penulis/{penulis}/update', [PenulisController::class, 'update'])->name('penulis_update');
    Route::get('/penulis/{penulis}/destroy', [PenulisController::class, 'destroy'])->name('penulis_destroy');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});
