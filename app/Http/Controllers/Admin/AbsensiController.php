<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuru;
use App\Models\Guru;
use App\Models\JadwalGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // jangan lupa import



class AbsensiController extends Controller
{

  // Tampilkan rekap absensi semua guru
    public function rekapsemua(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        // Ambil semua absensi guru untuk bulan & tahun tertentu
        $absensi = AbsensiGuru::with('guru')
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('guru_id')
            ->orderBy('tanggal')
            ->get();

        // =========================
        // Buat rekap per guru
        // =========================
        $rekapGuru = [];
        $guruList = Guru::orderBy('nama')->get();

        foreach ($guruList as $guru) {
            $absGuru = $absensi->where('guru_id', $guru->id);
            $rekapGuru[] = [
                'guru'  => $guru,
                'hadir' => $absGuru->where('status', 'hadir')->count(),
                'izin'  => $absGuru->where('status', 'izin')->count(),
                'sakit' => $absGuru->where('status', 'sakit')->count(),
                'alpha' => $absGuru->where('status', 'alpha')->count(),
            ];
        }

        return view('admin.absensi.rekap', compact('absensi', 'rekapGuru', 'bulan', 'tahun'));
    }

    public function rekapPerGuruTerjadwal(Request $request)
{
    $bulan = $request->bulan ?? now()->month;
    $tahun = $request->tahun ?? now()->year;

    $guruList = Guru::orderBy('nama')->get();
    $rekapGuru = [];

    // Ambil semua tanggal dalam bulan
    $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
    $tanggalBulan = [];
    for ($i = 1; $i <= $jumlahHari; $i++) {
        $tanggalBulan[] = Carbon::createFromDate($tahun, $bulan, $i);
    }

    foreach ($guruList as $guru) {

        // Ambil jadwal guru (hari_id)
        $jadwalGuru = JadwalGuru::where('guru_id', $guru->id)->pluck('hari_id')->toArray();

        // Hitung hari terjadwal di bulan ini
        $hariTerjadwal = collect($tanggalBulan)->filter(function($tanggal) use ($jadwalGuru) {
            $dayIndex = $tanggal->dayOfWeek; // 0=Sun, 1=Mon, ..., 6=Sat
            return in_array($dayIndex, $jadwalGuru);
        });

        // Ambil absensi guru di bulan ini
        $absensi = AbsensiGuru::where('guru_id', $guru->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $rekapGuru[] = [
            'guru' => $guru,
            'hariTerjadwal' => $hariTerjadwal->count(),
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'izin' => $absensi->where('status', 'izin')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
        ];
    }

    return view('admin.absensi.rekap-per-guru-terjadwal', compact('rekapGuru', 'bulan', 'tahun'));
}


public function perGuru(Request $request)
{
    $guru = Guru::orderBy('nama')->get();

    $bulan = $request->bulan ?? now()->month;
    $tahun = $request->tahun ?? now()->year;

    $absensi = collect();
    $rekap = null;

    if ($request->guru_id) {

        $absensi = AbsensiGuru::where('guru_id', $request->guru_id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        // =====================
        // REKAP SEDERHANA
        // =====================
        $rekap = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'izin'  => $absensi->where('status', 'izin')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
        ];
    }

    return view('admin.absensi.rekap-per-guru', compact(
        'guru',
        'absensi',
        'rekap',
        'bulan',
        'tahun'
    ));
}




public function destroy($id)
{
    $absensi = AbsensiGuru::findOrFail($id);

    // hapus foto jika ada
    if ($absensi->foto && Storage::disk('public')->exists($absensi->foto)) {
        Storage::disk('public')->delete($absensi->foto);
    }

    $absensi->delete();

    return back()->with('success', 'Data absensi berhasil dihapus');
}


public function hapusBulan(Request $request)
{
    $request->validate([
        'bulan' => 'required',
        'tahun' => 'required',
    ]);

    $absensi = AbsensiGuru::whereMonth('tanggal', $request->bulan)
        ->whereYear('tanggal', $request->tahun)
        ->get();

    // hapus foto satu-satu (penting!)
    foreach ($absensi as $item) {
        if ($item->foto && Storage::disk('public')->exists($item->foto)) {
            Storage::disk('public')->delete($item->foto);
        }
    }

    // HAPUS SEMUA DATA BULAN TERPILIH
    AbsensiGuru::whereMonth('tanggal', $request->bulan)
        ->whereYear('tanggal', $request->tahun)
        ->delete();

    return back()->with(
        'success',
        'Semua absensi bulan berhasil dihapus'
    );
}

public function cetakPdf(Request $request)
{
    $guruId = $request->guru_id;
    $bulan   = $request->bulan ?? now()->month;
    $tahun   = $request->tahun ?? now()->year;

    if (!$guruId) {
        return back()->with('error', 'Silakan pilih guru terlebih dahulu.');
    }

    $guru = Guru::findOrFail($guruId);

    $absensi = AbsensiGuru::where('guru_id', $guruId)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->get();

    $jumlahHari = \Carbon\Carbon::create($tahun, $bulan, 1)->daysInMonth;
    $hadir = $absensi->where('status', 'hadir')->count();
    $izin  = $absensi->where('status', 'izin')->count();
    $sakit = $absensi->where('status', 'sakit')->count();
    $persenHadir = $jumlahHari > 0 ? round(($hadir / $jumlahHari) * 100, 1) : 0;

    $pdf = Pdf::loadView('admin.absensi.pdf-rekap', [
        'guru' => $guru,
        'absensi' => $absensi,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'jumlahHari' => $jumlahHari,
        'hadir' => $hadir,
        'izin' => $izin,
        'sakit' => $sakit,
        'persenHadir' => $persenHadir,
    ]);

    return $pdf->stream("Rekap_Absensi_{$guru->nama}_{$bulan}_{$tahun}.pdf");
}
}

