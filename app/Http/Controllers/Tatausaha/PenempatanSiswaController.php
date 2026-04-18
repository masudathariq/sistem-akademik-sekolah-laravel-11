<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tatausaha\Siswa;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\TahunAjaran;
use App\Models\Guru;
use App\Exports\RombelSiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RombelSiswaPdf;


/**
 * 🎯 CONTROLLER KHUSUS PENEMPATAN
 * 
 * Controller ini fokus untuk:
 * - Tempatkan siswa ke rombel (multiple select)
 * - Pindahkan siswa antar rombel
 * - Keluarkan siswa dari rombel
 */
class PenempatanSiswaController extends Controller
{
    /**
     * 📋 HALAMAN PENEMPATAN
     * 
     * Menampilkan:
     * 1. Siswa yang belum ditempatkan
     * 2. Rombel-rombel dengan daftar siswa di dalamnya
     */
// app/Http/Controllers/Tatausaha/PenempatanSiswaController.php

public function index()
{
    $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

    // SISWA YANG BELUM PUNYA ROMBEL
    $siswasBelumDitempatkan = Siswa::whereNull('rombel_id')
        ->orderBy('nama_siswa')
        ->get();

    // ROMBEL + SISWANYA
    $rombels = Rombel::with(['siswas' => function ($q) {
            $q->orderBy('nama_siswa');
        }])
        ->withCount('siswas')
        ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
        ->get();

    return view('staff_tu.penempatan.index', compact(
        'tahunAjaranAktif',
        'siswasBelumDitempatkan',
        'rombels'
    ));
}


    /**
     * 💾 TEMPATKAN SISWA KE ROMBEL
     * 
     * Input:
     * - siswa_id[] (array, bisa pilih banyak siswa)
     * - rombel_id (1 rombel tujuan)
     * 
     * Proses:
     * - Loop siswa yang dipilih
     * - Attach ke rombel tujuan
     */
public function tempatkan(Request $request)
{
    $request->validate([
        'siswa_id'   => 'required|array|min:1',
        'siswa_id.*' => 'exists:siswas,id',
        'rombel_id'  => 'required|exists:rombels,id',
    ]);

    $rombel = Rombel::findOrFail($request->rombel_id);

    Siswa::whereIn('id', $request->siswa_id)
        ->update([
            'rombel_id' => $rombel->id
        ]);

    return back()->with(
        'success',
        count($request->siswa_id) . " siswa berhasil ditempatkan ke {$rombel->nama_lengkap}"
    );
}


    /**
     * 🔄 PINDAHKAN SISWA DARI ROMBEL A KE ROMBEL B
     * 
     * Input:
     * - siswa_id
     * - rombel_tujuan_id
     */
public function pindahkan(Request $request)
{
    $request->validate([
        'siswa_id'         => 'required|exists:siswas,id',
        'rombel_tujuan_id' => 'required|exists:rombels,id',
    ]);

    $siswa = Siswa::findOrFail($request->siswa_id);
    $rombelTujuan = Rombel::findOrFail($request->rombel_tujuan_id);

    $siswa->update([
        'rombel_id' => $rombelTujuan->id
    ]);

    return back()->with(
        'success',
        "{$siswa->nama_siswa} berhasil dipindahkan ke {$rombelTujuan->nama_lengkap}"
    );
}


    /**
     * ❌ KELUARKAN SISWA DARI ROMBEL
     * 
     * (Di tahun ajaran aktif saja, history tetap ada)
     */
public function keluarkan($siswaId)
{
    $siswa = Siswa::findOrFail($siswaId);

    $siswa->update([
        'rombel_id' => null
    ]);

    return back()->with(
        'success',
        "{$siswa->nama_siswa} berhasil dikeluarkan dari rombel"
    );
}


public function show($rombelId)
{
    $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

    $rombel = Rombel::with([
        'siswas' => function ($query) {
            $query->orderBy('nama_siswa');
        },
        'waliKelas' // relasi wali kelas
    ])->findOrFail($rombelId);

    $gurus = Guru::orderBy('nama')->get();

    return view(
        'staff_tu.penempatan.show',
        compact('rombel', 'tahunAjaranAktif', 'gurus')
    );
}

public function setWalikelas(Request $request, $rombel)
{
    $request->validate([
        'guru_id' => 'required|exists:gurus,id'
    ]);

    $rombel = \App\Models\Tatausaha\Rombel::findOrFail($rombel);

    $rombel->update([
        'guru_id' => $request->guru_id
    ]);

    return back()->with('success', 'Wali kelas berhasil disimpan');
}

// 📦 EXPORT SISWA ROMBEL
public function exportSiswa(Rombel $rombel)
{
    $namaFile = 'Siswa_' . str_replace(' ', '_', $rombel->nama_lengkap) . '.xlsx';
    
    return Excel::download(new RombelSiswaExport($rombel->id), $namaFile);
}


// 📄 EXPORT PDF
public function exportPdf(Rombel $rombel)
{
    $pdf = new RombelSiswaPdf($rombel->id);
    return $pdf->download();
}


}
