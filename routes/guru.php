<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\GuruSlipGajiController;
use App\Http\Controllers\Guru\GuruProfileController;
use App\Http\Controllers\Guru\AbsensiGuruController;
use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\Guru\GuruSiswaController;
use App\Http\Controllers\Guru\AbsenSiswaController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Guru\RaportTahfidzAspekController;
use App\Http\Controllers\Guru\RaportTahfidzNilaiController;
use App\Http\Controllers\Guru\RaportTahfidzHafalanController;
use App\Http\Controllers\Guru\RaportTahfidzUjianController;
use App\Http\Controllers\Guru\RaportTahfidzSiswaController;
use App\Http\Controllers\Guru\RaportTahfidzController;
use App\Http\Controllers\Guru\RaportIqroAspekController;
use App\Http\Controllers\Guru\RaportIqroNilaiController;
use App\Http\Controllers\Guru\RaportIqroBacaanController;
use App\Http\Controllers\Guru\RaportIqroUjianController;
use App\Http\Controllers\Guru\RaportIqroSiswaController;
use App\Http\Controllers\Guru\RaportIqroController;


/*
|--------------------------------------------------------------------------
| Guru Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Profil Guru
        Route::get('/profile', [GuruProfileController::class, 'index'])
            ->name('profile.index');
        Route::get('/profile/edit', [GuruProfileController::class, 'edit'])
            ->name('profile.edit');
        Route::patch('/profile', [GuruProfileController::class, 'update'])
            ->name('profile.update');

        // Absensi Guru
        Route::get('/absensi', [AbsensiGuruController::class, 'index'])
            ->name('absensi.index');
        Route::post('/absen-masuk', [AbsensiGuruController::class, 'absenMasuk'])
            ->name('absen.masuk');
        Route::post('/absen-pulang', [AbsensiGuruController::class, 'absenPulang'])
            ->name('absen.pulang');
        Route::post('/keterangan', [AbsensiGuruController::class, 'submitKeterangan'])
            ->name('absen.keterangan');

        // Rekap Absensi Guru
        Route::get('/rekap', [AbsensiGuruController::class, 'rekap'])
            ->name('absen.rekap');

        // Slip Gaji Guru
        Route::get('/slip-gaji', [GuruSlipGajiController::class, 'index'])
            ->name('slip-gaji.index');


        Route::get('/slip-gaji/{id}', [GuruSlipGajiController::class, 'show'])
            ->name('slip-gaji.show');

        Route::get(
            '/slip-gaji/{id}/print',
            [GuruSlipGajiController::class, 'print']
        )->name('slip-gaji.print');

        Route::get('/siswa', [GuruSiswaController::class, 'index'])->name('siswa.index');





        // ================= ABSEN SISWA =================
        Route::prefix('absen-siswa')->name('absen-siswa.')->group(function () {

            // Absen Hari Ini (HARUS DIATAS / NON-CONFLICT)
            Route::get('/hari-ini', [AbsenSiswaController::class, 'hariIni'])
                ->name('hari-ini');

            // INDEX ABSEN SISWA
            Route::get('/', [AbsenSiswaController::class, 'index'])
                ->name('index');

            // REKAP
            Route::get('/rekap', [AbsenSiswaController::class, 'rekap'])
                ->name('rekap');

            // DETAIL SISWA PER BULAN
            Route::get('/rekap/{siswa}/{rombel}/{bulan}', [AbsenSiswaController::class, 'detail'])
                ->name('rekap.detail');

            // FORM ABSENSI PER ROMBEL
            Route::get('/form/{rombel}', [AbsenSiswaController::class, 'form'])
                ->name('form');

            // SIMPAN ABSENSI
            Route::post('/store', [AbsenSiswaController::class, 'store'])
                ->name('store');

            // UPDATE ABSENSI (PUT)
            Route::put('/{absen}', [AbsenSiswaController::class, 'update'])
                ->name('update');

            // PRINT REKAP
            Route::get('/rekap/print', [AbsenSiswaController::class, 'printRekap'])
                ->name('rekap.print');
        });


         // ================= ABSEN SISWA =================
 
        // BARU - ganti dengan ini
Route::get('raport-tahfidz', [RaportTahfidzController::class, 'index'])->name('raport-tahfidz.index');
Route::get('raport-tahfidz/{siswa_id}', [RaportTahfidzController::class, 'show'])->name('raport-tahfidz.show');
Route::get('raport-tahfidz/{siswa_id}/cetak', [RaportTahfidzController::class, 'cetakRaport'])->name('raport-tahfidz.cetak');
Route::get('raport-tahfidz/{siswa_id}/download-pdf', [RaportTahfidzController::class, 'downloadPdf'])->name('raport_tahfidz.download_pdf');
        Route::get('raport-tahfidz-siswa', [\App\Http\Controllers\Guru\RaportTahfidzSiswaController::class, 'create'])->name('raport-tahfidz-siswa.create');
        Route::post('raport-tahfidz-siswa/store', [\App\Http\Controllers\Guru\RaportTahfidzSiswaController::class, 'store'])->name('raport-tahfidz-siswa.store');
        Route::resource('raport-aspeks', RaportTahfidzAspekController::class);

        // Index daftar aspek (dikelompokkan per jenis) untuk input nilai
        Route::get('raport-nilai', [RaportTahfidzNilaiController::class, 'index'])
            ->name('raport-nilai.index');

        // Form input nilai per aspek
        Route::get('raport-aspeks/{aspek}/nilai/create', [\App\Http\Controllers\Guru\RaportTahfidzNilaiController::class, 'create'])->name('raport-nilai.create');
        Route::post('raport-aspeks/{aspek}/nilai/store', [\App\Http\Controllers\Guru\RaportTahfidzNilaiController::class, 'store'])->name('raport-nilai.store');

        // Form edit nilai per aspek
        Route::get('raport-aspeks/{aspek}/nilai/edit', [\App\Http\Controllers\Guru\RaportTahfidzNilaiController::class, 'edit'])->name('raport-nilai.edit');
        Route::post('raport-aspeks/{aspek}/nilai/update', [\App\Http\Controllers\Guru\RaportTahfidzNilaiController::class, 'update'])->name('raport-nilai.update');

        // Hafalan
        Route::get('raport-hafalan', [\App\Http\Controllers\Guru\RaportTahfidzHafalanController::class, 'index'])->name('raport-hafalan.index');
        Route::get('raport-hafalan/cetak-pdf', [\App\Http\Controllers\Guru\RaportTahfidzHafalanController::class, 'cetakPdf'])->name('raport-hafalan.cetak-pdf');
        Route::get('raport-hafalan/create', [\App\Http\Controllers\Guru\RaportTahfidzHafalanController::class, 'create'])->name('raport-hafalan.create');
        Route::post('raport-hafalan/store', [\App\Http\Controllers\Guru\RaportTahfidzHafalanController::class, 'store'])->name('raport-hafalan.store');

        // Nilai Ujian
        Route::get('raport-ujian/create', [\App\Http\Controllers\Guru\RaportTahfidzUjianController::class, 'create'])->name('raport-ujian.create');
        Route::post('raport-ujian/store', [\App\Http\Controllers\Guru\RaportTahfidzUjianController::class, 'store'])->name('raport-ujian.store');

        // Raport Iqro
        Route::get('raport-iqro', [RaportIqroController::class, 'index'])->name('raport-iqro.index');
        Route::get('raport-iqro/{siswa_id}', [RaportIqroController::class, 'show'])->name('raport-iqro.show');
        Route::get('raport-iqro/{siswa_id}/cetak', [RaportIqroController::class, 'cetakRaport'])->name('raport-iqro.cetak');
        Route::get('raport-iqro/{siswa_id}/download-pdf', [RaportIqroController::class, 'downloadPdf'])->name('raport_iqro.download_pdf');
        Route::get('raport-iqro-siswa', [RaportIqroSiswaController::class, 'create'])->name('raport-iqro-siswa.create');
        Route::post('raport-iqro-siswa/store', [RaportIqroSiswaController::class, 'store'])->name('raport-iqro-siswa.store');
        Route::resource('raport-iqro-aspeks', RaportIqroAspekController::class);
        Route::get('raport-iqro-nilai', [RaportIqroNilaiController::class, 'index'])->name('raport-iqro-nilai.index');
        Route::get('raport-iqro-aspeks/{aspek}/nilai/create', [RaportIqroNilaiController::class, 'create'])->name('raport-iqro-nilai.create');
        Route::post('raport-iqro-aspeks/{aspek}/nilai/store', [RaportIqroNilaiController::class, 'store'])->name('raport-iqro-nilai.store');
        Route::get('raport-iqro-aspeks/{aspek}/nilai/edit', [RaportIqroNilaiController::class, 'edit'])->name('raport-iqro-nilai.edit');
        Route::post('raport-iqro-aspeks/{aspek}/nilai/update', [RaportIqroNilaiController::class, 'update'])->name('raport-iqro-nilai.update');
        Route::get('raport-iqro-bacaan', [RaportIqroBacaanController::class, 'index'])->name('raport-iqro-bacaan.index');
        Route::get('raport-iqro-bacaan/cetak-pdf', [RaportIqroBacaanController::class, 'cetakPdf'])->name('raport-iqro-bacaan.cetak-pdf');
        Route::get('raport-iqro-bacaan/create', [RaportIqroBacaanController::class, 'create'])->name('raport-iqro-bacaan.create');
        Route::post('raport-iqro-bacaan/store', [RaportIqroBacaanController::class, 'store'])->name('raport-iqro-bacaan.store');
        Route::get('raport-iqro-ujian/create', [RaportIqroUjianController::class, 'create'])->name('raport-iqro-ujian.create');
        Route::post('raport-iqro-ujian/store', [RaportIqroUjianController::class, 'store'])->name('raport-iqro-ujian.store');


        Route::get('/jadwal', 
            [\App\Http\Controllers\Guru\JadwalPelajaranController::class, 'index']
        )->name('jadwal_pelajaran.index');

        Route::get('/jadwal-hari-ini', 
    [\App\Http\Controllers\Guru\JadwalPelajaranController::class, 'hariIni']
)->name('jadwal_pelajaran.hari_ini');

        Route::get('/notif/{id}', function ($id) {/** @var User $user */ $user = Auth::user();

            if (!$user) {abort(403);}

            $notif = $user->notifications()->findOrFail($id);

            $notif->markAsRead();

            return redirect()->route('guru.slip-gaji.index');
        })->name('notif.read');
    });
