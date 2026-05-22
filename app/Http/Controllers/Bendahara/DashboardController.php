<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Bendahara\SlipGajiTerkirim;
use App\Models\TabunganSiswa;
use App\Models\TabunganTransaksi;
use App\Models\Tatausaha\Siswa;
use App\Models\Tatausaha\TahunAjaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $startOfYear = $today->copy()->startOfYear();

        $totalSetoran = (float) TabunganTransaksi::where('jenis', 'setor')->sum('nominal');
        $totalPenarikan = (float) TabunganTransaksi::where('jenis', 'tarik')->sum('nominal');
        $totalTabungan = (float) TabunganSiswa::sum('saldo');
        $jumlahTransaksi = TabunganTransaksi::count();
        $siswaPunyaTabungan = TabunganSiswa::where('saldo', '>', 0)->count();
        $jumlahSiswa = Siswa::count();

        $setoranHariIni = (float) TabunganTransaksi::where('jenis', 'setor')
            ->whereDate('tanggal', $today)
            ->sum('nominal');
        $penarikanHariIni = (float) TabunganTransaksi::where('jenis', 'tarik')
            ->whereDate('tanggal', $today)
            ->sum('nominal');

        $setoranBulanIni = (float) TabunganTransaksi::where('jenis', 'setor')
            ->whereBetween('tanggal', [$startOfMonth, $today])
            ->sum('nominal');
        $penarikanBulanIni = (float) TabunganTransaksi::where('jenis', 'tarik')
            ->whereBetween('tanggal', [$startOfMonth, $today])
            ->sum('nominal');

        $setoranTahunIni = (float) TabunganTransaksi::where('jenis', 'setor')
            ->whereBetween('tanggal', [$startOfYear, $today])
            ->sum('nominal');
        $penarikanTahunIni = (float) TabunganTransaksi::where('jenis', 'tarik')
            ->whereBetween('tanggal', [$startOfYear, $today])
            ->sum('nominal');

        $rekapPeriode = [
            [
                'label' => 'Hari Ini',
                'setor' => $setoranHariIni,
                'tarik' => $penarikanHariIni,
                'transaksi' => TabunganTransaksi::whereDate('tanggal', $today)->count(),
            ],
            [
                'label' => 'Bulan Ini',
                'setor' => $setoranBulanIni,
                'tarik' => $penarikanBulanIni,
                'transaksi' => TabunganTransaksi::whereBetween('tanggal', [$startOfMonth, $today])->count(),
            ],
            [
                'label' => 'Tahun Ini',
                'setor' => $setoranTahunIni,
                'tarik' => $penarikanTahunIni,
                'transaksi' => TabunganTransaksi::whereBetween('tanggal', [$startOfYear, $today])->count(),
            ],
        ];

        $transaksiTerbaru = TabunganTransaksi::with(['tabunganSiswa.siswa', 'petugas'])
            ->latest('tanggal')
            ->latest('id')
            ->limit(8)
            ->get();

        $rekapHarian = collect(range(6, 0))->map(function ($daysAgo) use ($today) {
            $date = $today->copy()->subDays($daysAgo);

            return [
                'label' => $date->translatedFormat('d M'),
                'setor' => (float) TabunganTransaksi::where('jenis', 'setor')->whereDate('tanggal', $date)->sum('nominal'),
                'tarik' => (float) TabunganTransaksi::where('jenis', 'tarik')->whereDate('tanggal', $date)->sum('nominal'),
            ];
        });

        $rekapBulanan = collect(range(1, 12))->map(function ($month) use ($today) {
            return [
                'label' => Carbon::create($today->year, $month, 1)->translatedFormat('M'),
                'setor' => (float) TabunganTransaksi::where('jenis', 'setor')
                    ->whereYear('tanggal', $today->year)
                    ->whereMonth('tanggal', $month)
                    ->sum('nominal'),
                'tarik' => (float) TabunganTransaksi::where('jenis', 'tarik')
                    ->whereYear('tanggal', $today->year)
                    ->whereMonth('tanggal', $month)
                    ->sum('nominal'),
            ];
        });

        $saldoTerbesar = TabunganSiswa::with('siswa')
            ->orderByDesc('saldo')
            ->limit(5)
            ->get();

        $gajiBulanIni = SlipGajiTerkirim::where('bulan', $today->month)
            ->where('tahun', $today->year);

        $ringkasanGaji = [
            'slip_bulan_ini' => (clone $gajiBulanIni)->count(),
            'total_gaji_bulan_ini' => (float) (clone $gajiBulanIni)->sum('total_gaji'),
            'total_penambahan_bulan_ini' => (float) (clone $gajiBulanIni)->sum('total_penambahan'),
            'total_pengurangan_bulan_ini' => (float) (clone $gajiBulanIni)->sum('total_pengurangan'),
        ];

        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        return view('bendahara.dashboard', compact(
            'totalSetoran',
            'totalPenarikan',
            'totalTabungan',
            'jumlahTransaksi',
            'siswaPunyaTabungan',
            'jumlahSiswa',
            'rekapPeriode',
            'transaksiTerbaru',
            'rekapHarian',
            'rekapBulanan',
            'saldoTerbesar',
            'ringkasanGaji',
            'tahunAktif'
        ));
    }
}
