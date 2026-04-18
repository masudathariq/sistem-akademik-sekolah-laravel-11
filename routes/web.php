<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Dashboard Redirect Berdasarkan Role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
/*
|--------------------------------------------------------------------------
| Profile Routes (semua role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/staff_tu.php';
require __DIR__ . '/guru.php';
require __DIR__ . '/bendahara.php';
require __DIR__ . '/kepsek.php';


