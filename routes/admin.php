<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\JadwalGuruController;
use App\Http\Controllers\Admin\JadwalHarianController;
use App\Http\Controllers\Admin\PengaturanAbsensiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RombelKategoriController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD User
    Route::resource('users', UserController::class);

    // CRUD Guru (hanya index, show, edit, update)
    Route::resource('guru', GuruController::class)->only(['index', 'show', 'edit', 'update']);


    // Jadwal Guru
    Route::prefix('jadwal-guru')->group(function () {
        Route::get('/', [JadwalGuruController::class, 'index'])->name('jadwal.index');
        Route::get('/{hari}', [JadwalGuruController::class, 'show'])->name('jadwal.show');
        Route::post('/store', [JadwalGuruController::class, 'store'])->name('jadwal.store');
        Route::delete('/{id}', [JadwalGuruController::class, 'destroy'])->name('jadwal.destroy');
    });

    // Jadwal Harian Guru
    Route::resource('jadwal-harian', JadwalHarianController::class);

    // Pengaturan Absensi
    Route::get('/pengaturan-absensi', [PengaturanAbsensiController::class, 'index'])->name('absensi.setting');
    Route::post('/pengaturan-absensi', [PengaturanAbsensiController::class, 'store'])->name('absensi.setting.store');

    // Rekap Absensi
    Route::get('/rekap-absensi', [AbsensiController::class, 'rekapsemua'])->name('absensi.rekap');
    Route::get('/rekap-per-guru', [AbsensiController::class, 'perGuru'])->name('absensi.rekap.per-guru');

    // Hapus Absensi
    Route::delete('/absensi/hapus-bulan', [AbsensiController::class, 'hapusBulan'])->name('absensi.hapus-bulan');
    Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');

    // Cetak PDF Absensi
    Route::get('absensi/cetak-pdf', [AbsensiController::class, 'cetakPdf'])->name('absensi.cetak-pdf');

    Route::get('rombel-kategori', [RombelKategoriController::class, 'index'])->name('rombel-kategori.index');

    Route::get('rombel-kategori/{rombel}', [RombelKategoriController::class, 'show'])->name('rombel-kategori.show');
});
