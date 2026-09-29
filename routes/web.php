<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublikasiController;
use Illuminate\Support\Facades\Route;

// ===== Area publik =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

// ===== Area admin (perlu login) =====
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('publikasi', PublikasiController::class);
    Route::get('/publikasi-hint', [PublikasiController::class, 'hint'])->name('publikasi.hint');
});

require __DIR__ . '/auth.php';