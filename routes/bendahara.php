<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bendahara\RekapController;
use App\Http\Controllers\Bendahara\GajiPokokController;
use App\Http\Controllers\Bendahara\KoreksiHadirController;
use App\Http\Controllers\Bendahara\SettingGajiTransportController;
use App\Http\Controllers\Bendahara\PenambahanController;
use App\Http\Controllers\Bendahara\PenguranganController;
use App\Http\Controllers\Bendahara\RekapGajiBulananController;
use App\Http\Controllers\Bendahara\DashboardController;
use App\Http\Controllers\Bendahara\TahfidzController;

/*
|--------------------------------------------------------------------------
| Bendahara Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:bendahara'])->prefix('bendahara')->name('bendahara.')->group(function () {

    // Dashboard Bendahara
     // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Rekap Absensi Bendahara (Blade berbeda dari Admin)
    Route::get('rekap', [RekapController::class, 'index'])->name('rekap');

    Route::get('/rekap-gaji/cetak-semua', [RekapGajiBulananController::class, 'cetakSemua'])
        ->name('rekap-gaji.cetak-semua');
    Route::post('/rekap-gaji/kirim-slip', [RekapGajiBulananController::class, 'kirimSlipGaji'])
        ->name('rekap-gaji.kirim-slip');

    Route::get('rekap/{guru}', [RekapController::class, 'show'])->name('rekap.show');

    Route::resource('gaji-pokok', GajiPokokController::class);

    Route::resource('penambahan', PenambahanController::class);
    Route::resource('pengurangan', PenguranganController::class);

    Route::get('rekap-gaji', [RekapGajiBulananController::class, 'index'])->name('rekap-gaji.index');
    Route::get('/rekap-gaji', [RekapGajiBulananController::class, 'index'])
        ->name('rekap-gaji.index');

    Route::get('/rekap-gaji/{guru}', [RekapGajiBulananController::class, 'show'])
        ->name('rekap-gaji.show');

    // Koreksi Hadir
    Route::get('koreksi-hadir', [KoreksiHadirController::class, 'index'])->name('koreksi-hadir.index');
    Route::get('koreksi-hadir/create', [KoreksiHadirController::class, 'create'])->name('koreksi-hadir.create');
    Route::post('koreksi-hadir', [KoreksiHadirController::class, 'store'])->name('koreksi-hadir.store');
    Route::get('koreksi-hadir/{koreksi}/edit', [KoreksiHadirController::class, 'edit'])->name('koreksi-hadir.edit');
    Route::put('koreksi-hadir/{koreksi}', [KoreksiHadirController::class, 'update'])->name('koreksi-hadir.update');
    Route::delete('koreksi-hadir/{koreksi}', [KoreksiHadirController::class, 'destroy'])->name('koreksi-hadir.destroy');

    // setting gaji transport
    Route::get('setting-transport', [SettingGajiTransportController::class, 'index'])->name('setting-transport.index');
    Route::get('setting-transport/edit', [SettingGajiTransportController::class, 'edit'])->name('setting-transport.edit');
    Route::put('setting-transport', [SettingGajiTransportController::class, 'update'])->name('setting-transport.update');

            Route::get('/tahfidz', [TahfidzController::class, 'index'])
            ->name('tahfidz.index');

        Route::post('/tahfidz', [TahfidzController::class, 'store'])
            ->name('tahfidz.store');
});