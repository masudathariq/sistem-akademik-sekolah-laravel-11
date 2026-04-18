<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;

class RekapController extends Controller
{
    // Daftar semua guru
public function index(Request $request)
{
    $bulan = $request->get('bulan', now()->month);
    $tahun = $request->get('tahun', now()->year);

    $rekapGuru = Guru::with(['absensi' => fn($q) => $q->whereMonth('tanggal', $bulan)
                                                        ->whereYear('tanggal', $tahun)])
                     ->get()
                     ->map(function($guru){
                         $hadir = $guru->absensi->where('status','hadir')->count();
                         $izin = $guru->absensi->where('status','izin')->count();
                         $sakit = $guru->absensi->where('status','sakit')->count();

                         $total = $hadir + $izin + $sakit;
                         $persenHadir = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;

                         return [
                             'guru' => $guru,
                             'hadir' => $hadir,
                             'izin' => $izin,
                             'sakit' => $sakit,
                             'jumlahHari' => $total,        // total kehadiran + izin + sakit
                             'persenHadir' => $persenHadir, // persentase hadir
                         ];
                     });

    $guruList = Guru::all();

    return view('bendahara.absensi.rekap', compact('rekapGuru','guruList','bulan','tahun'));
}


    // Tampilkan absensi guru tertentu
    public function show(Request $request, $guruId)
    {
        $guru = Guru::findOrFail($guruId);

        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        $absensi = $guru->absensi()
                        ->whereMonth('tanggal', $bulan)
                        ->whereYear('tanggal', $tahun)
                        ->get();

        $jumlahHari = \Carbon\Carbon::create($tahun, $bulan)->daysInMonth;

        $hadir = $absensi->where('status', 'hadir')->count();
        $izin  = $absensi->where('status', 'izin')->count();
        $sakit = $absensi->where('status', 'sakit')->count();
        $persenHadir = $jumlahHari > 0 ? round(($hadir / $jumlahHari) * 100, 1) : 0;

        return view('bendahara.absensi.show', compact(
            'guru', 'absensi', 'bulan', 'tahun',
            'jumlahHari', 'hadir', 'izin', 'sakit', 'persenHadir'
        ));
    }
}
