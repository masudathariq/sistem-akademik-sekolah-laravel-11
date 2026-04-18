<?php
// app/Http/Controllers/TataUsaha/RombelKategoriController.php
namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\RombelKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tatausaha\TahunAjaran;

class RombelKategoriController extends Controller
{


public function index()
{
    $tahunAktif = TahunAjaran::where('is_active', 1)->first();

    $rombels = Rombel::with('kategori')
        ->where('tahun_ajaran_id', $tahunAktif->id)
        ->orderBy('tingkat')
        ->orderBy('kode_rombel')
        ->get();

    return view('staff_tu.rombel_kategori.index', compact('rombels'));
}

    public function store(Request $request)
    {
        $request->validate([
            'rombel_id' => 'required|exists:rombels,id',
            'kategori'  => 'required|in:reguler,pondok',
        ]);

        RombelKategori::updateOrCreate(
            ['rombel_id' => $request->rombel_id],
            ['kategori' => $request->kategori]
        );

        return back()->with('success', 'Kategori rombel berhasil disimpan');
    }

public function show($rombelId)
{
    $rombel = Rombel::with(['siswas', 'kategori'])->findOrFail($rombelId);

    $siswas = $rombel->siswas->sortBy('nama_siswa'); // urutkan
    $kategori = $rombel->kategori->kategori ?? null;

    return view('staff_tu.rombel_kategori.show', compact('rombel', 'siswas', 'kategori'));
}


}
