<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin'      => redirect('/admin'),
            'kepsek'     => redirect('/kepala-sekolah'),
            'guru'       => redirect('/guru'),
            'bendahara'  => redirect('/bendahara'),
            'staff_tu'   => redirect('/staff_tu'),
            default      => abort(403),
        };
    }
}
