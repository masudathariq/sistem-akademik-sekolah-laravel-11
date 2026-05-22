<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\TabunganSiswa;
use App\Models\TabunganTransaksi;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class TabunganSiswaController extends Controller
{
    /**
     * Display a listing of grades (tingkat).
     */
    public function index()
    {
        $rombels = Rombel::withCount([
                'siswas',
                'siswas as laki_count' => function ($query) {
                    $query->where('jenis_kelamin', 'L');
                },
                'siswas as perempuan_count' => function ($query) {
                    $query->where('jenis_kelamin', 'P');
                },
            ])
            ->whereHas('tahunAjaran', function ($q) {
                $q->where('is_active', true);
            })
            ->get();

        $tingkats = $rombels->pluck('tingkat')->unique()->sort()->values();

        $totalTingkat = $tingkats->count();
        $totalRombel = $rombels->count();
        $totalSiswa = $rombels->sum('siswas_count');
        $totalMale = $rombels->sum('laki_count');
        $totalFemale = $rombels->sum('perempuan_count');
        $totalSaldo = TabunganSiswa::whereHas('siswa.rombel.tahunAjaran', function ($q) {
                $q->where('is_active', true);
            })->sum('saldo');

        return view('bendahara.tabungan-siswa.index', compact(
            'tingkats', 'totalTingkat', 'totalRombel', 'totalSiswa',
            'totalMale', 'totalFemale', 'totalSaldo'
        ));
    }

    /**
     * Display rombels for selected grade.
     */
    public function rombel($tingkat)
    {
        $rombels = Rombel::with(['walikelas', 'siswas.tabungan'])
            ->withCount([
                'siswas',
                'siswas as laki_count' => function ($query) {
                    $query->where('jenis_kelamin', 'L');
                },
                'siswas as perempuan_count' => function ($query) {
                    $query->where('jenis_kelamin', 'P');
                },
            ])
            ->where('tingkat', $tingkat)
            ->whereHas('tahunAjaran', function ($q) {
                $q->where('is_active', true);
            })
            ->orderBy('kode_rombel')
            ->get();

        $rombels->each(function ($rombel) {
            $rombel->total_tabungan = $rombel->siswas->sum(function ($siswa) {
                return $siswa->tabungan->saldo ?? 0;
            });
        });

        return view('bendahara.tabungan-siswa.rombel', compact('rombels', 'tingkat'));
    }

    /**
     * Display students in selected rombel.
     */
    public function siswa($rombel_id)
    {
        $rombel = Rombel::with(['siswas.tabungan', 'walikelas'])->findOrFail($rombel_id);
        $siswas = $rombel->siswas->sortBy('nama_siswa')->values();

        return view('bendahara.tabungan-siswa.siswa', compact('rombel', 'siswas'));
    }

    /**
     * Display the specified student's savings.
     */
    public function show($siswa_id)
    {
        $siswa = Siswa::with('rombel.walikelas')->findOrFail($siswa_id);
        
        // Get or create tabungan siswa
        $tabungan = TabunganSiswa::firstOrCreate(
            ['siswa_id' => $siswa_id],
            ['saldo' => 0]
        );

        $transaksi = $tabungan->transaksi()
            ->with('petugas')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('bendahara.tabungan-siswa.show', compact('siswa', 'tabungan', 'transaksi'));
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request, $siswa_id)
    {
        $request->validate([
            'jenis' => ['required', Rule::in(['setor', 'tarik'])],
            'nominal' => 'required|numeric|min:0.01',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $tabungan = TabunganSiswa::firstOrCreate(
            ['siswa_id' => $siswa_id],
            ['saldo' => 0]
        );

        DB::transaction(function () use ($request, $tabungan) {
            $nominal = $request->nominal;
            
            if ($request->jenis === 'tarik') {
                if ($tabungan->saldo < $nominal) {
                    throw new \Exception('Saldo tidak mencukupi untuk penarikan.');
                }
                $nominal = -$nominal;
            }

            // Create transaction
            TabunganTransaksi::create([
                'tabungan_siswa_id' => $tabungan->id,
                'tanggal' => $request->tanggal,
                'jenis' => $request->jenis,
                'nominal' => abs($nominal),
                'keterangan' => $request->keterangan,
                'petugas_id' => Auth::id(),
            ]);

            // Update balance
            $tabungan->increment('saldo', $nominal);
        });

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy($siswa_id, $transaksi_id)
    {
        $tabungan = TabunganSiswa::where('siswa_id', $siswa_id)->firstOrFail();
        $transaksi = $tabungan->transaksi()->findOrFail($transaksi_id);

        DB::transaction(function () use ($tabungan, $transaksi) {
            $nominal = $transaksi->jenis === 'setor' ? -$transaksi->nominal : $transaksi->nominal;
            $tabungan->increment('saldo', $nominal);
            $transaksi->delete();
        });

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

public function pdf($siswaId)
{
    $siswa = Siswa::with('rombel')->findOrFail($siswaId);

    $tabungan = TabunganSiswa::where('siswa_id', $siswa->id)->first();

    $transaksi = TabunganTransaksi::with('petugas')
        ->where('tabungan_siswa_id', $tabungan->id)
        ->orderBy('tanggal', 'desc')
        ->get();

    $totalSetor = $transaksi->where('jenis', 'setor')->sum('nominal');
    $totalTarik = $transaksi->where('jenis', 'tarik')->sum('nominal');
    $saldo = $tabungan->saldo ?? 0;

    $pdf = Pdf::loadView('bendahara.tabungan-siswa.pdf', compact(
        'siswa',
        'transaksi',
        'totalSetor',
        'totalTarik',
        'saldo'
    ))->setPaper('A4', 'portrait');

    return $pdf->stream('tabungan-'.$siswa->nama_siswa.'.pdf');
}
}
