<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Gaji;
use App\Models\Bendahara\Penambahan;
use App\Models\Bendahara\Pengurangan;
use App\Models\Bendahara\KoreksiHadir;
use Illuminate\Support\Facades\DB;
use App\Models\Bendahara\SlipGajiTerkirim;
use App\Notifications\SlipGajiNotification;
use App\Models\Bendahara\TahfidzGuru;
use App\Models\Bendahara\SettingTahfidz;
use Barryvdh\DomPDF\Facade\Pdf;




class RekapGajiBulananController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $rekap = $this->buildRekapGajiBulanan($bulan, $tahun);

        return view('bendahara.rekap-gaji.index', compact(
            'rekap',
            'bulan',
            'tahun'
        ));
    }

    private function buildRekapGajiBulanan($bulan, $tahun): array
    {
        $gurus = Guru::orderBy('nama')->get();
        $rekap = [];

        // Ambil setting transport per hari
        $transportPerHari = DB::table('setting_gaji_transports')
            ->latest()
            ->value('transport_per_hari') ?? 0;

        foreach ($gurus as $guru) {

            // ======================
            // GAJI POKOK
            // ======================
            $gaji = Gaji::where('guru_id', $guru->id)->first();
            $gajiPokok = $gaji->gaji_pokok ?? 0;

            // ======================
            // HADIR FINAL (HARI)
            // ======================
            $hadirFinal = KoreksiHadir::getHadirFinal($guru->id, $bulan, $tahun);

            // ======================
            // TRANSPORT (hadir * transport_per_hari)
            // ======================
            $transport = $hadirFinal * $transportPerHari;

            // ======================
            // PENAMBAHAN - PERBAIKAN
            // ======================
            // 1. Ambil penambahan untuk semua guru
            $penambahanSemua = Penambahan::where('tipe', 'semua')->sum('jumlah');

            // 2. Ambil penambahan pilihan dan filter manual
            $penambahanPilihan = Penambahan::where('tipe', 'pilihan')
                ->get()
                ->filter(function ($item) use ($guru) {
                    // Decode JSON jika masih string
                    $guruIds = is_array($item->guru_id)
                        ? $item->guru_id
                        : json_decode($item->guru_id, true);

                    // Cek apakah guru_id ada di array
                    // Support untuk integer dan string
                    return $guruIds && (
                        in_array($guru->id, $guruIds) ||
                        in_array((string)$guru->id, $guruIds)
                    );
                })
                ->sum('jumlah');

            $penambahan = $penambahanSemua + $penambahanPilihan;

            // ======================
            // PENGURANGAN - PERBAIKAN
            // ======================
            // 1. Ambil pengurangan untuk semua guru
            $penguranganSemua = Pengurangan::where('tipe', 'semua')->sum('jumlah');

            // 2. Ambil pengurangan pilihan dan filter manual
            $penguranganPilihan = Pengurangan::where('tipe', 'pilihan')
                ->get()
                ->filter(function ($item) use ($guru) {
                    // Decode JSON jika masih string
                    $guruIds = is_array($item->guru_id)
                        ? $item->guru_id
                        : json_decode($item->guru_id, true);

                    // Cek apakah guru_id ada di array
                    return $guruIds && (
                        in_array($guru->id, $guruIds) ||
                        in_array((string)$guru->id, $guruIds)
                    );
                })
                ->sum('jumlah');

            $pengurangan = $penguranganSemua + $penguranganPilihan;

            // ======================
            // TAHFIDZ
            // ======================
            $tahfidz = TahfidzGuru::where('guru_id', $guru->id)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->value('total') ?? 0;


            // ======================
            // TOTAL GAJI
            // ======================
            $total = $gajiPokok
                + $penambahan
                - $pengurangan
                + $transport
                + $tahfidz;

            $rekap[] = [
                'guru'          => $guru,
                'gaji_pokok'    => $gajiPokok,
                'penambahan'    => $penambahan,
                'pengurangan'   => $pengurangan,
                'hadir_final'   => $hadirFinal,
                'transport'     => $transport,
                'tahfidz' => $tahfidz,
                'total'         => $total,
            ];
        }

        return $rekap;
    }

    public function cetakRekapPdf(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;
        $rekap = $this->buildRekapGajiBulanan($bulan, $tahun);
        $namaBulan = \Carbon\Carbon::create(null, $bulan, 1)->translatedFormat('F');

        $summary = [
            'total_guru' => count($rekap),
            'total_gaji_pokok' => collect($rekap)->sum('gaji_pokok'),
            'total_penambahan' => collect($rekap)->sum('penambahan'),
            'total_pengurangan' => collect($rekap)->sum('pengurangan'),
            'total_transport' => collect($rekap)->sum('transport'),
            'total_tahfidz' => collect($rekap)->sum('tahfidz'),
            'total_dibayar' => collect($rekap)->sum('total'),
        ];

        $fileName = 'rekap-gaji-' . $bulan . '-' . $tahun . '.pdf';

        $pdf = Pdf::loadView('bendahara.rekap-gaji.cetak-rekap-pdf', compact(
            'rekap',
            'bulan',
            'tahun',
            'namaBulan',
            'summary'
        ))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ]);

        return $pdf->stream($fileName);
    }

    public function show(Request $request, $guruId)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $guru = Guru::findOrFail($guruId);

        // ======================
        // GAJI POKOK
        // ======================
        $gaji = Gaji::where('guru_id', $guru->id)->first();
        $gajiPokok = $gaji->gaji_pokok ?? 0;

        // ======================
        // KEHADIRAN
        // ======================
        $hadirAsli = DB::table('absensi_guru')
            ->where('guru_id', $guru->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'hadir')
            ->count();

        $koreksiData = KoreksiHadir::where('guru_id', $guru->id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        $koreksi = $koreksiData->jumlah ?? 0;
        $keteranganKoreksi = $koreksiData->keterangan ?? '-';
        $hadirFinal = max(0, $hadirAsli + $koreksi);

        // ======================
        // TRANSPORT
        // ======================
        $transportPerHari = DB::table('setting_gaji_transports')
            ->latest()
            ->value('transport_per_hari') ?? 0;
        $transport = $hadirFinal * $transportPerHari;

        // ======================
        // PENAMBAHAN (DETAIL) - PERBAIKAN
        // ======================
        $penambahanSemua = Penambahan::where('tipe', 'semua')->get();

        $penambahanPilihan = Penambahan::where('tipe', 'pilihan')
            ->get()
            ->filter(function ($item) use ($guru) {
                $guruIds = is_array($item->guru_id)
                    ? $item->guru_id
                    : json_decode($item->guru_id, true);

                return $guruIds && (
                    in_array($guru->id, $guruIds) ||
                    in_array((string)$guru->id, $guruIds)
                );
            });

        $penambahanList = $penambahanSemua->merge($penambahanPilihan);
        $totalPenambahan = $penambahanList->sum('jumlah');

        // ======================
        // PENGURANGAN (DETAIL) - PERBAIKAN
        // ======================
        $penguranganSemua = Pengurangan::where('tipe', 'semua')->get();

        $penguranganPilihan = Pengurangan::where('tipe', 'pilihan')
            ->get()
            ->filter(function ($item) use ($guru) {
                $guruIds = is_array($item->guru_id)
                    ? $item->guru_id
                    : json_decode($item->guru_id, true);

                return $guruIds && (
                    in_array($guru->id, $guruIds) ||
                    in_array((string)$guru->id, $guruIds)
                );
            });

        $penguranganList = $penguranganSemua->merge($penguranganPilihan);
        $totalPengurangan = $penguranganList->sum('jumlah');

        // =====================
        // TAHFIDZ
        // =====================

        // total yang sudah tersimpan
        $tahfidz = TahfidzGuru::where('guru_id', $guru->id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->value('total') ?? 0;

        // ambil tarif dari setting_tahfidz
        $tarifTahfidz = DB::table('setting_tahfidz')
            ->latest()
            ->value('harga_per_hadir') ?? 0;

        // hitung jumlah hadir (biar bisa tampil X × Y)
        $hadirTahfidz = $tarifTahfidz > 0
            ? $tahfidz / $tarifTahfidz
            : 0;




        // ======================
        // TOTAL GAJI
        // ======================
        $totalGaji = $gajiPokok
            + $totalPenambahan
            - $totalPengurangan
            + $transport
            + $tahfidz;

        return view('bendahara.rekap-gaji.show', compact(
            'guru',
            'bulan',
            'tahun',
            'gajiPokok',
            'hadirAsli',
            'koreksi',
            'keteranganKoreksi',
            'hadirFinal',
            'transportPerHari',
            'transport',
            'penambahanList',
            'totalPenambahan',
            'penguranganList',
            'totalPengurangan',
            'hadirTahfidz',
            'tarifTahfidz',
            'tahfidz',
            'totalGaji'
        ));
    }

    public function cetakPdf(Request $request, $guruId)
    {
        return $this->makePdfResponse($request, $guruId, false);
    }

    public function downloadPdf(Request $request, $guruId)
    {
        return $this->makePdfResponse($request, $guruId, true);
    }

    private function makePdfResponse(Request $request, $guruId, bool $download)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;
        $data = $this->buildSlipGajiData($guruId, $bulan, $tahun);

        $fileName = 'slip-gaji-' . str($data['guru']->nama)->slug('-') . '-' . $data['bulan'] . '-' . $data['tahun'] . '.pdf';

        $pdf = Pdf::loadView('bendahara.rekap-gaji.cetak-pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ]);

        return $download
            ? $pdf->download($fileName)
            : $pdf->stream($fileName);
    }

    private function buildSlipGajiData($guruId, $bulan, $tahun): array
    {
        $guru = Guru::findOrFail($guruId);

        $gaji = Gaji::where('guru_id', $guru->id)->first();
        $gajiPokok = $gaji->gaji_pokok ?? 0;

        $hadirAsli = DB::table('absensi_guru')
            ->where('guru_id', $guru->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'hadir')
            ->count();

        $koreksiData = KoreksiHadir::where('guru_id', $guru->id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        $koreksi = $koreksiData->jumlah ?? 0;
        $keteranganKoreksi = $koreksiData->keterangan ?? '-';
        $hadirFinal = max(0, $hadirAsli + $koreksi);

        $transportPerHari = DB::table('setting_gaji_transports')
            ->latest()
            ->value('transport_per_hari') ?? 0;
        $transport = $hadirFinal * $transportPerHari;

        $penambahanSemua = Penambahan::where('tipe', 'semua')->get();
        $penambahanPilihan = Penambahan::where('tipe', 'pilihan')
            ->get()
            ->filter(function ($item) use ($guru) {
                $guruIds = is_array($item->guru_id)
                    ? $item->guru_id
                    : json_decode($item->guru_id, true);

                return $guruIds && (
                    in_array($guru->id, $guruIds) ||
                    in_array((string) $guru->id, $guruIds)
                );
            });

        $penambahanList = $penambahanSemua->merge($penambahanPilihan);
        $totalPenambahan = $penambahanList->sum('jumlah');

        $penguranganSemua = Pengurangan::where('tipe', 'semua')->get();
        $penguranganPilihan = Pengurangan::where('tipe', 'pilihan')
            ->get()
            ->filter(function ($item) use ($guru) {
                $guruIds = is_array($item->guru_id)
                    ? $item->guru_id
                    : json_decode($item->guru_id, true);

                return $guruIds && (
                    in_array($guru->id, $guruIds) ||
                    in_array((string) $guru->id, $guruIds)
                );
            });

        $penguranganList = $penguranganSemua->merge($penguranganPilihan);
        $totalPengurangan = $penguranganList->sum('jumlah');

        $tahfidz = TahfidzGuru::where('guru_id', $guru->id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->value('total') ?? 0;

        $tarifTahfidz = DB::table('setting_tahfidz')
            ->latest()
            ->value('harga_per_hadir') ?? 0;

        $hadirTahfidz = $tarifTahfidz > 0
            ? $tahfidz / $tarifTahfidz
            : 0;

        $totalGaji = $gajiPokok
            + $totalPenambahan
            - $totalPengurangan
            + $transport
            + $tahfidz;

        $namaBulan = \Carbon\Carbon::create(null, $bulan, 1)->translatedFormat('F');

        return compact(
            'guru',
            'bulan',
            'tahun',
            'namaBulan',
            'gajiPokok',
            'hadirAsli',
            'koreksi',
            'keteranganKoreksi',
            'hadirFinal',
            'transportPerHari',
            'transport',
            'penambahanList',
            'totalPenambahan',
            'penguranganList',
            'totalPengurangan',
            'hadirTahfidz',
            'tarifTahfidz',
            'tahfidz',
            'totalGaji'
        );
    }

    public function cetakSemua(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $gurus = Guru::orderBy('nama')->get();
        $slips = [];

        // Ambil setting transport per hari
        $transportPerHari = DB::table('setting_gaji_transports')
            ->latest()
            ->value('transport_per_hari') ?? 0;

        foreach ($gurus as $guru) {
            // GAJI POKOK
            $gaji = Gaji::where('guru_id', $guru->id)->first();
            $gajiPokok = $gaji->gaji_pokok ?? 0;

            // KEHADIRAN
            $hadirAsli = DB::table('absensi_guru')
                ->where('guru_id', $guru->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'hadir')
                ->count();

            $koreksiData = KoreksiHadir::where('guru_id', $guru->id)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->first();

            $koreksi = $koreksiData->jumlah ?? 0;
            $hadirFinal = max(0, $hadirAsli + $koreksi);

            // TRANSPORT
            $transport = $hadirFinal * $transportPerHari;

            // TAHFIDZ
            $tahfidz = TahfidzGuru::where('guru_id', $guru->id)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->value('total') ?? 0;

            // ambil tarif
            $tarifTahfidz = DB::table('setting_tahfidz')
                ->latest()
                ->value('harga_per_hadir') ?? 0;

            // hitung jumlah hadir
            $hadirTahfidz = $tarifTahfidz > 0
                ? $tahfidz / $tarifTahfidz
                : 0;



            // PENAMBAHAN (DETAIL PER ITEM)
            $penambahanSemua = Penambahan::where('tipe', 'semua')->get();
            $penambahanPilihan = Penambahan::where('tipe', 'pilihan')
                ->get()
                ->filter(function ($item) use ($guru) {
                    $guruIds = is_array($item->guru_id)
                        ? $item->guru_id
                        : json_decode($item->guru_id, true);
                    return $guruIds && (
                        in_array($guru->id, $guruIds) ||
                        in_array((string)$guru->id, $guruIds)
                    );
                });
            $penambahanList = $penambahanSemua->merge($penambahanPilihan);
            $totalPenambahan = $penambahanList->sum('jumlah');

            // PENGURANGAN (DETAIL PER ITEM)
            $penguranganSemua = Pengurangan::where('tipe', 'semua')->get();
            $penguranganPilihan = Pengurangan::where('tipe', 'pilihan')
                ->get()
                ->filter(function ($item) use ($guru) {
                    $guruIds = is_array($item->guru_id)
                        ? $item->guru_id
                        : json_decode($item->guru_id, true);
                    return $guruIds && (
                        in_array($guru->id, $guruIds) ||
                        in_array((string)$guru->id, $guruIds)
                    );
                });
            $penguranganList = $penguranganSemua->merge($penguranganPilihan);
            $totalPengurangan = $penguranganList->sum('jumlah');

            // TOTAL
            $total = $gajiPokok + $totalPenambahan - $totalPengurangan + $transport + $tahfidz;


            $slips[] = [
                'guru' => $guru,
                'gaji_pokok' => $gajiPokok,
                'hadir_asli' => $hadirAsli,
                'koreksi' => $koreksi,
                'hadir_final' => $hadirFinal,
                'transport_per_hari' => $transportPerHari,
                'transport' => $transport,
                'tahfidz' => $tahfidz,
                'hadir_tahfidz' => $hadirTahfidz,
                'tarif_tahfidz' => $tarifTahfidz,
                'penambahan_list' => $penambahanList, // DETAIL
                'total_penambahan' => $totalPenambahan,
                'pengurangan_list' => $penguranganList, // DETAIL
                'total_pengurangan' => $totalPengurangan,
                'total' => $total,
            ];
        }

        // Kelompokkan 3 slip per halaman
        $pages = array_chunk($slips, 3);

        $namaBulan = \Carbon\Carbon::create(null, $bulan, 1)->translatedFormat('F');

        return view('bendahara.rekap-gaji.cetak-semua', compact(
            'pages',
            'bulan',
            'tahun',
            'namaBulan'
        ));
    }

    public function kirimSlipGaji(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $gurus = Guru::orderBy('nama')->get();
        $transportPerHari = DB::table('setting_gaji_transports')
            ->latest()
            ->value('transport_per_hari') ?? 0;

        $jumlahTerkirim = 0;

        DB::beginTransaction();
        try {
            foreach ($gurus as $guru) {
                // Hitung data slip gaji
                $gaji = Gaji::where('guru_id', $guru->id)->first();
                $gajiPokok = $gaji->gaji_pokok ?? 0;

                // Kehadiran
                $hadirAsli = DB::table('absensi_guru')
                    ->where('guru_id', $guru->id)
                    ->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun)
                    ->where('status', 'hadir')
                    ->count();

                $koreksiData = KoreksiHadir::where('guru_id', $guru->id)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->first();

                $koreksi = $koreksiData->jumlah ?? 0;
                $hadirFinal = max(0, $hadirAsli + $koreksi);
                $transport = $hadirFinal * $transportPerHari;

                // Penambahan
                $penambahanSemua = Penambahan::where('tipe', 'semua')->get();
                $penambahanPilihan = Penambahan::where('tipe', 'pilihan')
                    ->get()
                    ->filter(function ($item) use ($guru) {
                        $guruIds = is_array($item->guru_id)
                            ? $item->guru_id
                            : json_decode($item->guru_id, true);
                        return $guruIds && (
                            in_array($guru->id, $guruIds) ||
                            in_array((string)$guru->id, $guruIds)
                        );
                    });
                $penambahanList = $penambahanSemua->merge($penambahanPilihan);
                $totalPenambahan = $penambahanList->sum('jumlah');

                // Pengurangan
                $penguranganSemua = Pengurangan::where('tipe', 'semua')->get();
                $penguranganPilihan = Pengurangan::where('tipe', 'pilihan')
                    ->get()
                    ->filter(function ($item) use ($guru) {
                        $guruIds = is_array($item->guru_id)
                            ? $item->guru_id
                            : json_decode($item->guru_id, true);
                        return $guruIds && (
                            in_array($guru->id, $guruIds) ||
                            in_array((string)$guru->id, $guruIds)
                        );
                    });
                $penguranganList = $penguranganSemua->merge($penguranganPilihan);
                $totalPengurangan = $penguranganList->sum('jumlah');

                // ambil total tahfidz
                $tahfidz = TahfidzGuru::where('guru_id', $guru->id)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->value('total') ?? 0;

                // ambil tarif
                $tarifTahfidz = DB::table('setting_tahfidz')
                    ->latest()
                    ->value('harga_per_hadir') ?? 0;

                // hitung hadir
                $hadirTahfidz = $tarifTahfidz > 0
                    ? $tahfidz / $tarifTahfidz
                    : 0;



                // Total
                $totalGaji = $gajiPokok + $totalPenambahan - $totalPengurangan + $transport + $tahfidz;

                // Simpan atau update slip gaji
                $slip = SlipGajiTerkirim::updateOrCreate(

                    [
                        'guru_id' => $guru->id,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                    ],
                    [
                        'gaji_pokok' => $gajiPokok,
                        'hadir_asli' => $hadirAsli,
                        'koreksi' => $koreksi,
                        'hadir_final' => $hadirFinal,
                        'transport' => $transport,
                        'tahfidz' => $tahfidz,
                        'hadir_tahfidz' => $hadirTahfidz,
                        'tarif_tahfidz' => $tarifTahfidz,
                        'total_penambahan' => $totalPenambahan,
                        'total_pengurangan' => $totalPengurangan,
                        'total_gaji' => $totalGaji,
                        'detail_penambahan' => $penambahanList->map(function ($item) {
                            return [
                                'judul' => $item->judul,
                                'jumlah' => $item->jumlah,
                                'tipe' => $item->tipe,
                            ];
                        })->toArray(),
                        'detail_pengurangan' => $penguranganList->map(function ($item) {
                            return [
                                'judul' => $item->judul,
                                'jumlah' => $item->jumlah,
                                'tipe' => $item->tipe,
                            ];
                        })->toArray(),
                        'sudah_dibaca' => false,
                        'dibaca_pada' => null,
                    ]
                );

                // ============================
                // KIRIM NOTIFIKASI KE GURU
                // ============================

                $userGuru = \App\Models\User::where('role', 'guru')
                    ->where('id', $guru->user_id ?? null)
                    ->first();

                if ($userGuru) {
                    $userGuru->notify(new SlipGajiNotification($slip));
                }


                $jumlahTerkirim++;
            }

            DB::commit();

            return redirect()
                ->route('bendahara.rekap-gaji.index', ['bulan' => $bulan, 'tahun' => $tahun])
                ->with('success', "Slip gaji berhasil dikirim ke {$jumlahTerkirim} guru!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengirim slip gaji: ' . $e->getMessage());
        }
    }
}
