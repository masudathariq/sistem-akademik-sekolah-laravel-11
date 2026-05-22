<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Kepala Sekolah Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kepsek'])
    ->prefix('kepala-sekolah')
    ->name('kepsek.')
    ->group(function () {

    Route::get('/', fn() => view('kepsek.dashboard'))
        ->name('dashboard');
});
