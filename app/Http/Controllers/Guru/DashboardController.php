<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\AbsensiGuru;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek apakah user sudah punya data guru
        if (!$user->guru) {
            return redirect()->route('guru.profile.edit')
                ->with('warning', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        $guruId = $user->guru->id;
        $today = Carbon::today();

        // Ambil absensi hari ini
        $absensiHariIni = AbsensiGuru::where('guru_id', $guruId)
            ->whereDate('tanggal', $today)
            ->first();

        // Default status
        $absenStatus = [
            'label' => 'Belum Absen',
            'color' => 'red'
        ];

        // Jika sudah ada data absensi
        if ($absensiHariIni) {

            switch ($absensiHariIni->status) {

                case 'hadir':
                    $absenStatus = [
                        'label' => 'Sudah Hadir',
                        'color' => 'green'
                    ];
                    break;

                case 'izin':
                    $absenStatus = [
                        'label' => 'Izin',
                        'color' => 'yellow'
                    ];
                    break;

                case 'sakit':
                    $absenStatus = [
                        'label' => 'Sakit',
                        'color' => 'red'
                    ];
                    break;
            }
        }

        return view('guru.dashboard', compact('absenStatus', 'absensiHariIni'));
    }
}