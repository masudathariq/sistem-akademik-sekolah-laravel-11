<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru\AbsenSiswa;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\Siswa;
use App\Models\Tatausaha\TahunAjaran;


class AbsenSiswaController extends Controller
{
    public function index()
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        $rombels = Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->orderBy('tingkat')
            ->orderBy('kode_rombel')
            ->get();

        return view('guru.absen-siswa.index', compact('rombels', 'tahunAjaranAktif'));
    }

public function form(Rombel $rombel)
{
    $tanggal = now()->toDateString();

    $siswas = Siswa::where('rombel_id', $rombel->id)
        ->orderBy('nama_siswa')
        ->get();

    $sudahAbsen = AbsenSiswa::where('rombel_id', $rombel->id)
        ->where('tanggal', $tanggal)
        ->exists();

    return view('guru.absen-siswa.form', compact(
        'rombel',
        'siswas',
        'tanggal',
        'sudahAbsen'
    ));
}



public function store(Request $request)
{
    $guru = Auth::user()->guru;
    $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

    // 🔒 CEK: apakah absensi rombel ini sudah diisi hari ini?
    $sudahAda = AbsenSiswa::where('rombel_id', $request->rombel_id)
        ->where('tanggal', $request->tanggal)
        ->exists();

    if ($sudahAda) {
        return redirect()
            ->route('guru.absen-siswa.rekap', [
                'rombel_id' => $request->rombel_id,
                'bulan' => $request->tanggal
            ])
            ->with('error', 'Absensi untuk tanggal ini sudah diisi dan tidak dapat diubah.');
    }

    // ✅ SIMPAN SEKALI SAJA
    foreach ($request->absen as $siswa_id => $status) {
        AbsenSiswa::create([
            'siswa_id' => $siswa_id,
            'rombel_id' => $request->rombel_id,
            'guru_id' => $guru->id,
            'tahun_ajaran_id' => $tahunAjaranAktif->id,
            'tanggal' => $request->tanggal,
            'status' => $status,
            'keterangan' => $request->keterangan[$siswa_id] ?? null,
        ]);
    }

return redirect()
    ->route('guru.absen-siswa.form', [
        'rombel' => $request->rombel_id
    ])
    ->with('success', 'Absensi berhasil disimpan');

}


public function rekap(Request $request)
{
    $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

    $rombels = Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)->get();

    $rekap = collect();

    $bulan = $request->bulan ?? now()->format('Y-m');

    // Set session hanya jika rombel dipilih
    if ($request->rombel_id) {
        session([
            'last_rekap_rombel_id' => $request->rombel_id,
            'last_rekap_bulan' => $bulan,
        ]);

        $rekap = AbsenSiswa::select('siswa_id')
            ->selectRaw("SUM(status = 'H') as hadir")
            ->selectRaw("SUM(status = 'I') as izin")
            ->selectRaw("SUM(status = 'S') as sakit")
            ->selectRaw("SUM(status = 'A') as alpha")
            ->selectRaw("SUM(status = 'B') as bolos")
            ->where('rombel_id', $request->rombel_id)
            ->where('tanggal', 'like', $bulan . '%')
            ->groupBy('siswa_id')
            ->with('siswa')
            ->get();
    }

    return view('guru.absen-siswa.rekap', compact(
        'rombels',
        'rekap',
        'tahunAjaranAktif',
        'bulan'
    ));
}

public function detail($siswaId, $rombelId, $bulan)
{
    $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

    $siswa = Siswa::findOrFail($siswaId);

    $absensis = AbsenSiswa::where('siswa_id', $siswaId)
        ->where('rombel_id', $rombelId)
        ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
        ->where('tanggal', 'like', $bulan . '%')
        ->orderBy('tanggal')
        ->get();

    return view('guru.absen-siswa.detail', compact(
        'siswa',
        'absensis',
        'bulan'
    ));
}

public function update(Request $request, AbsenSiswa $absen)
{
    $request->validate([
        'status' => 'required|in:H,I,S,A,B',
        'keterangan' => 'nullable|string|max:255',
    ]);

    $absen->update([
        'status' => $request->status,
        'keterangan' => $request->keterangan,
    ]);

    return back()->with('success', 'Absensi berhasil diperbarui');
}


public function printRekap(Request $request)
{
    $bulan = $request->bulan ?? now()->format('Y-m');
    
    $rekap = AbsenSiswa::select('siswa_id')
        ->selectRaw("SUM(status = 'H') as hadir")
        ->selectRaw("SUM(status = 'I') as izin")
        ->selectRaw("SUM(status = 'S') as sakit")
        ->selectRaw("SUM(status = 'A') as alpha")
        ->selectRaw("SUM(status = 'B') as bolos")
        ->when($request->rombel_id, fn($q) => $q->where('rombel_id', $request->rombel_id))
        ->where('tanggal', 'like', $bulan.'%')
        ->groupBy('siswa_id')
        ->with('siswa')
        ->get();

    $rombels = Rombel::all();

    return view('guru.absen-siswa.rekap-print', compact('rekap', 'bulan', 'rombels'));
}

public function hariIni(Request $request)
{
    $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();
    
    // Ambil semua rombel aktif
    $rombels = Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)
        ->orderBy('tingkat')
        ->orderBy('kode_rombel')
        ->get();

    // Pilihan rombel dari request
    $selectedRombelId = $request->rombel_id;

    $siswas = collect();
    if ($selectedRombelId) {
        $tanggalHariIni = now()->toDateString();
        $siswas = AbsenSiswa::with('siswa')
            ->where('rombel_id', $selectedRombelId)
            ->where('tanggal', $tanggalHariIni)
            ->get();
    }

    return view('guru.absen-siswa.hari-ini', compact(
        'rombels',
        'selectedRombelId',
        'siswas'
    ));
}



}

