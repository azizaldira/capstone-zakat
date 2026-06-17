<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPanitiaController;
use App\Http\Controllers\AmilController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MuzakkiController;
use App\Http\Controllers\TransaksiZakatController;
use App\Http\Controllers\MustahikController;
use App\Http\Controllers\DistribusiZakatController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    
    // Profil (All users)
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Group for Admin Panitia
    Route::middleware(['role:admin_panitia'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminPanitiaController::class, 'dashboard'])->name('dashboard');
        
        // Kalkulator (Admin Only)
        Route::get('/kalkulator', [KalkulatorController::class, 'index'])->name('kalkulator.index');
        
        Route::resource('muzakki', MuzakkiController::class);
        Route::resource('transaksi', TransaksiZakatController::class);
        
        // Settings & Users
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::resource('users', UserController::class);

        // Laporan
        Route::get('/laporan/transaksi', [LaporanController::class, 'transaksi'])->name('laporan.transaksi');
        Route::get('/laporan/transaksi/cetak', [LaporanController::class, 'cetakTransaksi'])->name('laporan.transaksi.cetak');
        Route::get('/laporan/distribusi', [LaporanController::class, 'distribusi'])->name('laporan.distribusi');
        Route::get('/laporan/distribusi/cetak', [LaporanController::class, 'cetakDistribusi'])->name('laporan.distribusi.cetak');
    });

    // Group for Amil
    Route::middleware(['role:amil'])->prefix('amil')->name('amil.')->group(function () {
        Route::get('/dashboard', [AmilController::class, 'dashboard'])->name('dashboard');
        
        Route::resource('mustahik', MustahikController::class);
        Route::resource('distribusi', DistribusiZakatController::class);

        // Laporan Amil
        Route::get('/laporan/distribusi', [LaporanController::class, 'distribusi'])->name('laporan.distribusi');
        Route::get('/laporan/distribusi/cetak', [LaporanController::class, 'cetakDistribusi'])->name('laporan.distribusi.cetak');
    });
});

require __DIR__.'/auth.php';
