<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\TahunAjaran;
use App\Models\Tatausaha\Alumni;
use Illuminate\Support\Facades\DB;


class RombelController extends Controller
{
    /**
     * Menampilkan rombel berdasarkan tahun ajaran aktif
     */
    public function index()
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect('/staff_tu')
                ->with('error', 'Belum ada tahun ajaran aktif');
        }

        $rombels = Rombel::with('tahunAjaran')
            ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->orderBy('tingkat')
            ->orderBy('kode_rombel')
            ->get();

        return view('staff_tu.rombel.index', compact('rombels', 'tahunAjaranAktif'));
    }

    /**
     * Form tambah rombel
     */
    public function create()
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect('/staff_tu')
                ->with('error', 'Belum ada tahun ajaran aktif');
        }

        return view('staff_tu.rombel.create', compact('tahunAjaranAktif'));
    }

    /**
     * Simpan rombel baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'tingkat'     => 'required|in:7,8,9',
            'kode_rombel' => 'required|string|max:5',
            'nama_rombel' => 'required|string|max:100',
        ]);

        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return back()->with('error', 'Tidak ada tahun ajaran aktif');
        }

        // cegah rombel dobel (VII A di TA yang sama)
        $exists = Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->where('tingkat', $request->tingkat)
            ->where('kode_rombel', strtoupper($request->kode_rombel))
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['kode_rombel' => 'Rombel sudah ada pada tahun ajaran ini']);
        }

        Rombel::create([
            'tahun_ajaran_id' => $tahunAjaranAktif->id,
            'tingkat'         => $request->tingkat,
            'kode_rombel'     => strtoupper($request->kode_rombel),
            'nama_rombel'     => $request->nama_rombel,
        ]);

        return redirect('/staff_tu/rombel')
            ->with('success', 'Rombel berhasil ditambahkan');
    }

    /**
     * Form edit rombel
     */
    public function edit($id)
    {
        $rombel = Rombel::with('tahunAjaran')->findOrFail($id);

        return view('staff_tu.rombel.edit', compact('rombel'));
    }

    /**
     * Update rombel
     */
    public function update(Request $request, $id)
    {
        $request->validate([
    'tingkat'     => 'required|in:7,8,9',
    'kode_rombel' => 'required|string|max:5',
    'nama_rombel' => 'required|string|max:100',
]);


        $rombel = Rombel::findOrFail($id);

        // cegah duplikasi saat update
        $exists = Rombel::where('tahun_ajaran_id', $rombel->tahun_ajaran_id)
            ->where('tingkat', $request->tingkat)
            ->where('kode_rombel', strtoupper($request->kode_rombel))
            ->where('id', '!=', $rombel->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['kode_rombel' => 'Rombel sudah ada pada tahun ajaran ini']);
        }

        $rombel->update([
            'tingkat'     => $request->tingkat,
            'kode_rombel' => strtoupper($request->kode_rombel),
            'nama_rombel' => $request->nama_rombel,
        ]);

        return redirect('/staff_tu/rombel')
            ->with('success', 'Rombel berhasil diupdate');
    }

    /**
     * Hapus rombel
     */
    public function destroy($id)
    {
        $rombel = Rombel::findOrFail($id);
        $rombel->delete();

        return back()->with('success', 'Rombel berhasil dihapus');
    }

public function lulusSemua($rombelId)
    {
        $rombel = Rombel::findOrFail($rombelId);

        $siswas = $rombel->siswas;

        if ($siswas->isEmpty()) {
            return back()->with('error', 'Tidak ada siswa di rombel ini.');
        }

        $tahunLulus = date('Y');

        foreach ($siswas as $siswa) {
            DB::table('alumnis')->insert([
                'nisn'          => $siswa->nisn,
                'nis'           => $siswa->nis,
                'nama_siswa'    => $siswa->nama_siswa,
                'tempat_lahir'  => $siswa->tempat_lahir,
                'tanggal_lahir' => $siswa->tanggal_lahir,
                'jenis_kelamin' => $siswa->jenis_kelamin,
                'alamat'        => $siswa->alamat,
                'ayah'          => $siswa->ayah,
                'ibu'           => $siswa->ibu,
                'wali'          => $siswa->wali,
                'tahun_lulus'   => $tahunLulus,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            $siswa->delete(); // opsional
        }

        return back()->with('success', 'Semua siswa berhasil dimasukkan ke alumni.');
    }



}
