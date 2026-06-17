<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPanitiaController;
use App\Http\Controllers\AmilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Admin Panitia Routes
Route::middleware(['auth', 'role:admin_panitia'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminPanitiaController::class, 'dashboard'])->name('dashboard');
    Route::resource('muzakki', \App\Http\Controllers\MuzakkiController::class);
    Route::resource('transaksi', \App\Http\Controllers\TransaksiZakatController::class);
    Route::get('/laporan', [AdminPanitiaController::class, 'laporan'])->name('laporan');
    Route::get('/profil', [AdminPanitiaController::class, 'profil'])->name('profil');
});

// Amil Routes
Route::middleware(['auth', 'role:amil'])->prefix('amil')->name('amil.')->group(function () {
    Route::get('/dashboard', [AmilController::class, 'dashboard'])->name('dashboard');
    Route::resource('mustahik', \App\Http\Controllers\MustahikController::class);
    Route::resource('distribusi', \App\Http\Controllers\DistribusiZakatController::class);
    Route::get('/laporan', [AmilController::class, 'laporan'])->name('laporan');
    Route::get('/profil', [AmilController::class, 'profil'])->name('profil');
});

require __DIR__.'/auth.php';
