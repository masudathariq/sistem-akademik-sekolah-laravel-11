<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guru;
use App\Models\Tatausaha\Siswa;
use App\Models\AbsensiGuru;
use App\Models\Tatausaha\TahunAjaran;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\MataPelajaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /* ══════════════════════════════════════
           KPI CARDS
        ══════════════════════════════════════ */

        $totalUser      = User::count();
        $totalGuru      = Guru::count();
        $totalSiswa     = Siswa::count();
        $jumlahSiswaLakiLaki = Siswa::where('jenis_kelamin', 'L')->count();
        $jumlahSiswaPerempuan = Siswa::where('jenis_kelamin', 'P')->count();
        $absensiHariIni = AbsensiGuru::whereDate('tanggal', today())->count();

        /* ══════════════════════════════════════
           DISTRIBUSI USER PER ROLE
        ══════════════════════════════════════ */

        $roleCounts = User::select('role', DB::raw('count(*) as jumlah'))
            ->groupBy('role')
            ->pluck('jumlah', 'role');

        $jumlahAdmin     = $roleCounts['admin']     ?? 0;
        $jumlahKepsek    = $roleCounts['kepsek']    ?? 0;
        $jumlahStaffTu   = $roleCounts['staff_tu']  ?? 0;
        $jumlahBendahara = $roleCounts['bendahara'] ?? 0;
        $jumlahGuru      = $roleCounts['guru']      ?? 0;
        $jumlahSiswa     = $roleCounts['siswa']     ?? 0;

        $base         = $totalUser ?: 1;
        $pctAdmin     = round($jumlahAdmin     / $base * 100);
        $pctKepsek    = round($jumlahKepsek    / $base * 100);
        $pctStaffTu   = round($jumlahStaffTu   / $base * 100);
        $pctBendahara = round($jumlahBendahara / $base * 100);
        $pctGuru      = round($jumlahGuru      / $base * 100);
        $pctSiswa     = round($jumlahSiswa     / $base * 100);

        /* ══════════════════════════════════════
           STATUS SISTEM
        ══════════════════════════════════════ */

        $tahunAktif  = TahunAjaran::where('is_active', 1)->first();
        $totalRombel = Rombel::count();
        $totalMapel  = MataPelajaran::count();

        /*
           REKAP DATA SISWA
        */

        $rombelsRekap = Rombel::with('kategori')
            ->withCount([
                'siswas as total_siswa',
                'siswas as total_laki_laki' => fn ($query) => $query->where('jenis_kelamin', 'L'),
                'siswas as total_perempuan' => fn ($query) => $query->where('jenis_kelamin', 'P'),
            ])
            ->orderBy('tingkat')
            ->orderBy('kode_rombel')
            ->get();

        $rekapKategoriSiswa = [
            'reguler' => ['total' => 0, 'L' => 0, 'P' => 0],
            'pondok' => ['total' => 0, 'L' => 0, 'P' => 0],
        ];
        $rekapTingkatSiswa = [];
        $rekapTingkatKategoriSiswa = [];
        $rekapRombelSiswa = [];

        foreach ($rombelsRekap as $rombel) {
            $kategori = $rombel->kategori->kategori ?? null;
            $total = (int) $rombel->total_siswa;
            $lakiLaki = (int) $rombel->total_laki_laki;
            $perempuan = (int) $rombel->total_perempuan;

            if ($kategori && isset($rekapKategoriSiswa[$kategori])) {
                $rekapKategoriSiswa[$kategori]['total'] += $total;
                $rekapKategoriSiswa[$kategori]['L'] += $lakiLaki;
                $rekapKategoriSiswa[$kategori]['P'] += $perempuan;

                $rekapTingkatKategoriSiswa[$rombel->tingkat][$kategori]['total'] =
                    ($rekapTingkatKategoriSiswa[$rombel->tingkat][$kategori]['total'] ?? 0) + $total;
                $rekapTingkatKategoriSiswa[$rombel->tingkat][$kategori]['L'] =
                    ($rekapTingkatKategoriSiswa[$rombel->tingkat][$kategori]['L'] ?? 0) + $lakiLaki;
                $rekapTingkatKategoriSiswa[$rombel->tingkat][$kategori]['P'] =
                    ($rekapTingkatKategoriSiswa[$rombel->tingkat][$kategori]['P'] ?? 0) + $perempuan;
            }

            $rekapTingkatSiswa[$rombel->tingkat]['total'] =
                ($rekapTingkatSiswa[$rombel->tingkat]['total'] ?? 0) + $total;
            $rekapTingkatSiswa[$rombel->tingkat]['L'] =
                ($rekapTingkatSiswa[$rombel->tingkat]['L'] ?? 0) + $lakiLaki;
            $rekapTingkatSiswa[$rombel->tingkat]['P'] =
                ($rekapTingkatSiswa[$rombel->tingkat]['P'] ?? 0) + $perempuan;

            $rekapRombelSiswa[] = [
                'tingkat' => $rombel->tingkat,
                'tingkat_label' => $rombel->tingkat_romawi,
                'rombel' => $rombel->kode_rombel . ' - ' . $rombel->nama_rombel,
                'kategori' => $kategori,
                'total' => $total,
                'L' => $lakiLaki,
                'P' => $perempuan,
            ];
        }

        ksort($rekapTingkatSiswa);
        ksort($rekapTingkatKategoriSiswa);

        /* ══════════════════════════════════════
           AKTIVITAS TERBARU
        ══════════════════════════════════════ */

        $aktivitasTerbaru = User::orderBy('updated_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($user) {
                $isNew = $user->created_at->eq($user->updated_at);
                return (object) [
                    'deskripsi' => $isNew
                        ? "User baru didaftarkan: {$user->name}"
                        : "Data user diperbarui: {$user->name}",
                    'user'      => $user,
                    'waktu'     => $user->updated_at,
                ];
            });

        /* ══════════════════════════════════════
           USER TERBARU
        ══════════════════════════════════════ */

        $userTerbaru = User::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        /* ══════════════════════════════════════
           RETURN VIEW
        ══════════════════════════════════════ */

        return view('admin.dashboard', compact(
            'totalUser',
            'totalGuru',
            'totalSiswa',
            'jumlahSiswaLakiLaki',
            'jumlahSiswaPerempuan',
            'absensiHariIni',

            'jumlahAdmin',
            'jumlahKepsek',
            'jumlahStaffTu',
            'jumlahBendahara',
            'jumlahGuru',
            'jumlahSiswa',
            'pctAdmin',
            'pctKepsek',
            'pctStaffTu',
            'pctBendahara',
            'pctGuru',
            'pctSiswa',

            'tahunAktif',
            'totalRombel',
            'totalMapel',

            'rekapKategoriSiswa',
            'rekapTingkatSiswa',
            'rekapTingkatKategoriSiswa',
            'rekapRombelSiswa',

            'aktivitasTerbaru',
            'userTerbaru',
        ));
    }
}
