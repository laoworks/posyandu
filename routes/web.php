<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BalitaController;
use App\Http\Controllers\Admin\ImunisasiController;
use App\Http\Controllers\Admin\JadwalPosyanduController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenimbanganController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Bidan\BalitaController as BidanBalitaController;
use App\Http\Controllers\Bidan\DashboardController as BidanDashboardController;
use App\Http\Controllers\Bidan\ImunisasiController as BidanImunisasiController;
use App\Http\Controllers\Bidan\JadwalPosyanduController as BidanJadwalPosyanduController;
use App\Http\Controllers\Bidan\PenimbanganController as BidanPenimbanganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrangTua\AnakController as OrangTuaAnakController;
use App\Http\Controllers\OrangTua\DashboardController as OrangTuaDashboardController;
use App\Http\Controllers\OrangTua\ImunisasiController as OrangTuaImunisasiController;
use App\Http\Controllers\OrangTua\JadwalPosyanduController as OrangTuaJadwalPosyanduController;
use App\Http\Controllers\OrangTua\PenimbanganController as OrangTuaPenimbanganController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware([
    'auth',
    'role:bidan_desa'
])->prefix('bidan')
    ->name('bidan.')
    ->group(function () {
        Route::get('/dashboard', [BidanDashboardController::class, 'index'])->name('dashboard');
        Route::resource('balita', BidanBalitaController::class);
        Route::resource('penimbangan', BidanPenimbanganController::class);
        Route::resource('imunisasi', BidanImunisasiController::class);
        Route::resource('jadwal-posyandu', BidanJadwalPosyanduController::class)
            ->parameters(['jadwal-posyandu' => 'jadwalPosyandu']);
    });

Route::middleware([
    'auth',
    'role:orang_tua'
])->prefix('orang-tua')
    ->name('orangtua.')
    ->group(function () {
        Route::get('/dashboard', [OrangTuaDashboardController::class, 'index'])->name('dashboard');
        Route::get('data-anak', [OrangTuaAnakController::class, 'index'])->name('anak.index');
        Route::get('data-anak/{anak}', [OrangTuaAnakController::class, 'show'])->name('anak.show');
        Route::get('riwayat-penimbangan', [OrangTuaPenimbanganController::class, 'index'])->name('penimbangan.index');
        Route::get('riwayat-penimbangan/{penimbangan}', [OrangTuaPenimbanganController::class, 'show'])->name('penimbangan.show');
        Route::get('riwayat-imunisasi', [OrangTuaImunisasiController::class, 'index'])->name('imunisasi.index');
        Route::get('riwayat-imunisasi/{imunisasi}', [OrangTuaImunisasiController::class, 'show'])->name('imunisasi.show');
        Route::get('jadwal-posyandu', [OrangTuaJadwalPosyanduController::class, 'index'])->name('jadwal.index');
        Route::get('jadwal-posyandu/{jadwalPosyandu}', [OrangTuaJadwalPosyanduController::class, 'show'])->name('jadwal.show');
    });


Route::middleware([
    'auth',
    'role:kader'
])->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('balita', BalitaController::class);
        Route::resource('users', UserController::class);
        Route::resource('penimbangan', PenimbanganController::class);
        Route::resource('imunisasi', ImunisasiController::class);
        Route::resource('jadwal-posyandu', JadwalPosyanduController::class)
            ->parameters(['jadwal-posyandu' => 'jadwalPosyandu']);
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
    });
require __DIR__ . '/auth.php';
