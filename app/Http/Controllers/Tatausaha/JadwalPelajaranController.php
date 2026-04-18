<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\MataPelajaran;
use App\Models\Tatausaha\JadwalPelajaran;
use Illuminate\Http\Request;
use App\Models\Tatausaha\TahunAjaran;
use Illuminate\Validation\Rule;

class JadwalPelajaranController extends Controller
{
    public function index()
    {
        $haris = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        return view('staff_tu.jadwal_pelajaran.index', compact('haris'));
    }

    public function showGuru($hari)
    {
        $gurus      = Guru::orderBy('nama')->get();
        $tahunAktif = TahunAjaran::where('is_active', true)->first();
        $jadwals    = collect();

        if ($tahunAktif) {
            $jadwals = JadwalPelajaran::with(['rombel', 'mataPelajaran'])
                ->where('hari', $hari)
                ->where('tahun_ajaran', $tahunAktif->tahun_ajaran)
                ->where('semester', $tahunAktif->semester)
                ->orderBy('jam_mulai')
                ->get()
                ->groupBy('guru_id');
        }

        return view('staff_tu.jadwal_pelajaran.guru', compact(
            'gurus', 'hari', 'jadwals', 'tahunAktif'
        ));
    }

public function form($hari, $guruId)
{
    $guru        = Guru::findOrFail($guruId);
    $tahunAktif  = TahunAjaran::where('is_active', true)->first();

    if (!$tahunAktif) {
        return back()->with('error', 'Tidak ada tahun ajaran aktif.');
    }

    $rombels = Rombel::where('tahun_ajaran_id', $tahunAktif->id)
    ->orderBy('tingkat', 'asc')
    ->orderBy('kode_rombel', 'asc')
    ->get();

    $mapels = MataPelajaran::orderBy('nama_mapel')->get();

    return view('staff_tu.jadwal_pelajaran.form', compact(
        'guru', 'hari', 'rombels', 'mapels', 'tahunAktif'
    ));
}

    public function store(Request $request)
    {
        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAktif) {
            return back()->with('error', 'Tidak ada tahun ajaran aktif.');
        }

        $request->validate([
            'guru_id'          => 'required|exists:gurus,id',
            'rombel_id'        => 'required|exists:rombels,id',
            'mata_pelajaran_id'=> 'required|exists:mata_pelajarans,id',
            'hari'             => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai'        => 'required|date_format:H:i',
            'jam_selesai'      => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalPelajaran::create([
            'guru_id'          => $request->guru_id,
            'rombel_id'        => $request->rombel_id,
            'mata_pelajaran_id'=> $request->mata_pelajaran_id,
            'hari'             => $request->hari,
            'jam_mulai'        => $request->jam_mulai,
            'jam_selesai'      => $request->jam_selesai,
            'tahun_ajaran'     => $tahunAktif->tahun_ajaran,
            'semester'         => $tahunAktif->semester,
        ]);

        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Update an existing jadwal entry.
     * Route: PUT /jadwal-pelajaran/{jadwal}
     */
public function update(Request $request, JadwalPelajaran $jadwal)
{
    $tahunAktif = TahunAjaran::where('is_active', true)->first();

    if (!$tahunAktif) {
        return back()->with('error', 'Tidak ada tahun ajaran aktif.');
    }

    $request->validate([
        'rombel_id' => [
            'required',
            Rule::exists('rombels', 'id')->where(function ($query) use ($tahunAktif) {
                $query->where('tahun_ajaran_id', $tahunAktif->id);
            }),
        ],
        'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
        'jam_mulai'         => 'required|date_format:H:i',
        'jam_selesai'       => 'required|date_format:H:i|after:jam_mulai',
    ]);

    $jadwal->update([
        'rombel_id'         => $request->rombel_id,
        'mata_pelajaran_id' => $request->mata_pelajaran_id,
        'jam_mulai'         => $request->jam_mulai,
        'jam_selesai'       => $request->jam_selesai,
    ]);

    return redirect()
        ->route('staff_tu.jadwal_pelajaran.showGuru', $jadwal->hari)
        ->with('success', 'Jadwal berhasil diperbarui.');
}

    /**
     * Delete a jadwal entry.
     * Route: DELETE /jadwal-pelajaran/{jadwal}
     */
    public function destroy(JadwalPelajaran $jadwal)
    {
        $hari = $jadwal->hari;
        $jadwal->delete();

        return redirect()
            ->route('staff_tu.jadwal_pelajaran.showGuru', $hari)
            ->with('success', 'Jadwal berhasil dihapus.');
    }

public function listByHari($hari)
{
    $tahunAktif = TahunAjaran::where('is_active', true)->first();

    if (!$tahunAktif) {
        return back()->with('error', 'Tidak ada tahun ajaran aktif.');
    }

    $jadwals = JadwalPelajaran::with(['guru', 'rombel', 'mataPelajaran'])
        ->join('rombels', 'jadwal_pelajarans.rombel_id', '=', 'rombels.id')
        ->where('jadwal_pelajarans.hari', $hari)
        ->where('jadwal_pelajarans.tahun_ajaran', $tahunAktif->tahun_ajaran)
        ->where('jadwal_pelajarans.semester', $tahunAktif->semester)
        ->orderBy('rombels.tingkat', 'asc')
        ->orderBy('rombels.kode_rombel','asc')
        ->orderBy('rombels.nama_rombel', 'asc')
        ->orderBy('jadwal_pelajarans.jam_mulai', 'asc')
        ->select('jadwal_pelajarans.*')
        ->get();

    return view('staff_tu.jadwal_pelajaran.show', compact(
        'jadwals', 'hari', 'tahunAktif'
    ));
}

    public function jadwalLengkap()
{
    $tahunAktif = TahunAjaran::where('is_active', true)->first();

    if (!$tahunAktif) {
        return back()->with('error', 'Tidak ada tahun ajaran aktif.');
    }

    $jadwals = JadwalPelajaran::with(['guru', 'rombel', 'mataPelajaran'])
        ->where('tahun_ajaran', $tahunAktif->tahun_ajaran)
        ->where('semester', $tahunAktif->semester)
        ->join('rombels', 'jadwal_pelajarans.rombel_id', '=', 'rombels.id')
        ->orderByRaw("
            FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu')
        ")
        ->orderBy('jam_mulai')
        ->orderBy('rombels.tingkat')
        ->orderBy('rombels.kode_rombel')
        ->select('jadwal_pelajarans.*')
        ->get();

    return view('staff_tu.jadwal_pelajaran.jadwal_lengkap', compact(
        'jadwals', 'tahunAktif'
    ));
}
}