<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tatausaha\TahunAjaranController;
use App\Http\Controllers\Tatausaha\RombelController;
use App\Http\Controllers\Tatausaha\SiswaController;
use App\Http\Controllers\Tatausaha\PenempatanSiswaController;
use App\Http\Controllers\Tatausaha\KenaikanKelasController;
use App\Http\Controllers\Tatausaha\AlumniController;
use App\Http\Controllers\Tatausaha\DashboardController;
use App\Http\Controllers\Tatausaha\RombelKategoriController;
use App\Http\Controllers\Tatausaha\RekapAbsenSiswaController;
use App\Http\Controllers\Tatausaha\SuratAktifController;
use App\Http\Controllers\Tatausaha\SuratPindahController;
use App\Http\Controllers\Tatausaha\SuratMasukController;
use App\Http\Controllers\Tatausaha\SuratKeluarController;
use App\Http\Controllers\Tatausaha\JadwalPelajaranController;

Route::middleware(['auth', 'role:staff_tu'])
    ->prefix('staff_tu')
    ->name('staff_tu.')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Tahun Ajaran
        Route::prefix('tahun-ajaran')->name('tahun-ajaran.')->group(function () {
            Route::get('/', [TahunAjaranController::class, 'index'])->name('index');
            Route::get('/create', [TahunAjaranController::class, 'create'])->name('create');
            Route::post('/', [TahunAjaranController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [TahunAjaranController::class, 'edit'])->name('edit');
            Route::put('/{id}', [TahunAjaranController::class, 'update'])->name('update');
            Route::put('/{id}/aktif', [TahunAjaranController::class, 'setAktif'])->name('setAktif');
        });

        // Rombel
        Route::resource('rombel', RombelController::class);

        Route::prefix('siswa')->name('siswa.')->group(function () {
            // Resource CRUD
            Route::get('/', [SiswaController::class, 'index'])->name('index');
            Route::get('/create', [SiswaController::class, 'create'])->name('create');
            Route::post('/', [SiswaController::class, 'store'])->name('store');
            // Import & Export
            Route::get('export', [SiswaController::class, 'export'])->name('export');
            Route::post('import', [SiswaController::class, 'import'])->name('import');
            Route::get('/{siswa}', [SiswaController::class, 'show'])->name('show');
            Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('edit');
            Route::put('/{siswa}', [SiswaController::class, 'update'])->name('update');
            Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('destroy');
        });


        // Penempatan Siswa
        Route::prefix('penempatan')->name('penempatan.')->group(function () {
            Route::get('/', [PenempatanSiswaController::class, 'index'])->name('index');
            Route::post('/tempatkan', [PenempatanSiswaController::class, 'tempatkan'])->name('tempatkan');
            Route::post('/pindahkan', [PenempatanSiswaController::class, 'pindahkan'])->name('pindahkan');
            Route::get('/{rombel}', [PenempatanSiswaController::class, 'show'])->name('show');
            // Lihat jadwal per rombel → PERHATIKAN: HAPUS "penempatan/" di awal path
            Route::get('{rombel}/jadwal', [PenempatanSiswaController::class, 'jadwalRombel'])
                ->name('show_jadwal');


            // ✅ Tambahkan ini
            Route::get('/{rombel}/export', [PenempatanSiswaController::class, 'exportSiswa'])->name('exportSiswa');
            Route::get('/pdf/{rombel}', [PenempatanSiswaController::class, 'exportPdf'])->name('exportPdf'); // ✅ Tambahkan ini
            Route::post('/{rombel}/set-walikelas', [PenempatanSiswaController::class, 'setWalikelas'])->name('setWalikelas');
            Route::delete('/keluarkan/{siswa}', [PenempatanSiswaController::class, 'keluarkan'])->name('keluarkan');
        });

        // Kenaikan Kelas
        Route::get('/kenaikan-kelas', [KenaikanKelasController::class, 'index'])->name('kenaikan.index');
        Route::post('/kenaikan-kelas', [KenaikanKelasController::class, 'proses'])->name('kenaikan.proses');
        Route::post('/rombel/{rombel}/lulus-semua', [RombelController::class, 'lulusSemua'])->name('rombel.lulusSemua');

        // Alumni
        Route::prefix('alumni')->name('alumni.')->group(function () {
            Route::get('/', [AlumniController::class, 'index'])->name('index');
            Route::get('/{id}', [AlumniController::class, 'show'])->name('show');
            Route::delete('/{id}', [AlumniController::class, 'destroy'])->name('destroy');
        });


        Route::get('rombel-kategori', [RombelKategoriController::class, 'index'])->name('rombel-kategori.index');

        Route::post('rombel-kategori', [RombelKategoriController::class, 'store'])->name('rombel-kategori.store');

        Route::get('rombel-kategori/{rombel}', [RombelKategoriController::class, 'show'])->name('rombel-kategori.show');

        // Route rekap absensi siswa
        Route::get('/absen-siswa/rekap', [RekapAbsenSiswaController::class, 'rekap'])
            ->name('absen-siswa.rekap');

        Route::get('/absen-siswa/rekap/{siswa}/{rombel}/{bulan}', [RekapAbsenSiswaController::class, 'detail'])
            ->name('absen-siswa.rekap.detail');


        Route::get('/absen-siswa/cetak', [RekapAbsenSiswaController::class, 'cetak'])
            ->name('rekap_absen.rekap_absen_siswa_cetak');


        // Surat Aktif
        Route::resource('surat-aktif', SuratAktifController::class);

        Route::get(
            'get-siswa/{rombel}',
            [SuratAktifController::class, 'getSiswa']
        )->name('get-siswa');

        Route::get(
            'staff_tu/get-siswa/{rombelId}',
            [SuratAktifController::class, 'getSiswa']
        )->name('staff_tu.get-siswa');

        Route::get(
            'surat-aktif/{id}/cetak',
            [SuratAktifController::class, 'cetak']
        )->name('surat-aktif.cetak');

        Route::resource(
            'surat-pindah',
            SuratPindahController::class
        );

        Route::get(
            'surat-pindah/{id}/cetak',
            [SuratPindahController::class, 'cetak']
        )->name('surat-pindah.cetak');


        // ✅ DOWNLOAD HARUS DI ATAS
        Route::get(
            'surat_masuk/{surat_masuk}/download',
            [SuratMasukController::class, 'downloadLampiran']
        )->name('surat_masuk.download');


        // ✅ BARU RESOURCE
        Route::resource('surat_masuk', SuratMasukController::class);





        // Download & Status (harus sebelum resource)
        Route::get('surat-keluar/{suratKeluar}/download', [SuratKeluarController::class, 'downloadLampiran'])
            ->name('surat_keluar.download');

        Route::patch('surat-keluar/{suratKeluar}/kirim', [SuratKeluarController::class, 'kirim'])
            ->name('surat_keluar.kirim');

        Route::patch('surat-keluar/{suratKeluar}/arsip', [SuratKeluarController::class, 'arsip'])
            ->name('surat_keluar.arsip');

        // CRUD Resource
        Route::resource('surat-keluar', SuratKeluarController::class)
            ->names('surat_keluar');

        Route::resource(
            'mata_pelajaran',
            \App\Http\Controllers\Tatausaha\MataPelajaranController::class
        );

        Route::get(
            'jadwal-mengajar',
            [\App\Http\Controllers\Tatausaha\JadwalPelajaranController::class, 'index']
        )->name('jadwal_pelajaran.index');

        Route::get(
            'jadwal-mengajar/jadwal-lengkap',
            [App\Http\Controllers\Tatausaha\JadwalPelajaranController::class, 'jadwalLengkap']
        )->name('jadwal_pelajaran.jadwalLengkap');

        Route::get(
            'jadwal-mengajar/{hari}',
            [\App\Http\Controllers\Tatausaha\JadwalPelajaranController::class, 'showGuru']
        )->name('jadwal_pelajaran.showGuru');

        Route::get(
            'jadwal-mengajar/{hari}/guru/{guru}',
            [\App\Http\Controllers\Tatausaha\JadwalPelajaranController::class, 'form']
        )->name('jadwal_pelajaran.form');

        Route::post(
            'jadwal-mengajar/store',
            [\App\Http\Controllers\Tatausaha\JadwalPelajaranController::class, 'store']
        )->name('jadwal_pelajaran.store');


        Route::get(
            '/jadwal-mengajar/list/{hari}',
            [JadwalPelajaranController::class, 'listByHari']
        )->name('jadwal_pelajaran.list');

        // Jadi ini (nama tanpa prefix 'staff_tu.' karena group sudah handle):
        Route::put('jadwal-pelajaran/{jadwal}', [JadwalPelajaranController::class, 'update'])->name('jadwal_pelajaran.update');
        Route::delete('jadwal-pelajaran/{jadwal}', [JadwalPelajaranController::class, 'destroy'])->name('jadwal_pelajaran.destroy');
    });
