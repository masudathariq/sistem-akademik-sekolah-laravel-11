<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportIqroAspek;
use App\Models\Guru\RaportIqroNilai;
use App\Models\Guru\RaportIqroBacaan;
use App\Models\Guru\RaportIqroUjian;
use App\Models\Guru\RaportIqroSiswaGuru;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RaportIqroController extends Controller
{
    public function index()
    {
        $guru_id = Auth::id();
        $siswas = RaportIqroSiswaGuru::with('siswa')
            ->where('guru_id', $guru_id)
            ->get()
            ->pluck('siswa');

        if ($siswas->isEmpty()) {
            return view('guru.raport_iqro.index', [
                'siswas'     => collect(),
                'aspeks'     => collect(),
                'nilai'      => [],
                'keterangan' => [],
                'bacaan'     => [],
                'ujian'      => [],
            ]);
        }

        $aspeks    = RaportIqroAspek::orderBy('id')->get();
        $siswa_ids = $siswas->pluck('id')->toArray();
        $nilai_raw = RaportIqroNilai::whereIn('siswa_id', $siswa_ids)->get();

        $keterangan_map = [
            1 => 'Belum baik / Belum berkembang',
            2 => 'Cukup baik / Mulai berkembang',
            3 => 'Baik / Berkembang sesuai harapan',
            4 => 'Sangat baik / Berkembang sangat baik',
        ];

        $nilai      = [];
        $keterangan = [];

        foreach ($nilai_raw as $n) {
            $nilai[$n->siswa_id][$n->aspek_id]      = $n->nilai;
            $keterangan[$n->siswa_id][$n->aspek_id] = $keterangan_map[$n->nilai] ?? '-';
        }

        $bacaan = RaportIqroBacaan::whereIn('siswa_id', $siswa_ids)
            ->get()
            ->keyBy('siswa_id');

        $ujian = RaportIqroUjian::whereIn('siswa_id', $siswa_ids)
            ->get()
            ->groupBy('siswa_id');

        foreach ($ujian as $siswa_id => $ujian_siswa) {
            foreach ($ujian_siswa as $key => $n) {
                $ujian[$siswa_id][$key]->keterangan = $this->keteranganUjian($n->nilai_ujian);
            }
        }

        return view('guru.raport_iqro.index', compact(
            'siswas',
            'aspeks',
            'nilai',
            'keterangan',
            'bacaan',
            'ujian'
        ));
    }

    public function show($siswa_id)
    {
        $data = $this->buildRaportData($siswa_id);
        return view('guru.raport_iqro.show', $data);
    }

    public function cetakRaport($siswa_id)
    {
        $data = $this->buildRaportData($siswa_id);
        return view('guru.raport_iqro.cetak', $data);
    }

    public function downloadPdf($siswa_id)
    {
        $data = $this->buildRaportData($siswa_id);

        $pdf = Pdf::loadView('guru.raport_iqro.cetak_pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont'          => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false,
                'dpi'                  => 150,
                'enable_css_float'     => true,
            ]);

        $namaFile = 'Raport_Iqro_' . str_replace(' ', '_', $data['siswa']->nama_siswa) . '.pdf';

        return $pdf->stream($namaFile);
    }

    private function buildRaportData($siswa_id): array
    {
        $guru_id = Auth::id();

        $siswa = RaportIqroSiswaGuru::with('siswa.rombel')
            ->where('guru_id', $guru_id)
            ->where('siswa_id', $siswa_id)
            ->firstOrFail()
            ->siswa;

        $aspeks = RaportIqroAspek::all();

        $keterangan_map = [
            1 => 'Belum baik',
            2 => 'Cukup baik',
            3 => 'Baik',
            4 => 'Sangat baik',
        ];

        $nilai      = [];
        $keterangan = [];

        foreach ($aspeks as $aspek) {
            $record = RaportIqroNilai::where('siswa_id', $siswa->id)
                ->where('aspek_id', $aspek->id)
                ->first();

            $nilai[$aspek->id]      = $record->nilai ?? 0;
            $keterangan[$aspek->id] = $keterangan_map[$nilai[$aspek->id]] ?? '-';
        }

        $bacaan = RaportIqroBacaan::where('siswa_id', $siswa->id)->first();

        $nilaiValues = array_filter($nilai, fn ($v) => $v > 0);
        $rataRata    = count($nilaiValues) > 0
            ? array_sum($nilaiValues) / count($nilaiValues)
            : 0;

        $pencapaian = round(($rataRata / 4) * 100);

        $status = match (true) {
            $rataRata >= 3.5 => 'Berkembang Sangat Baik',
            $rataRata >= 2.5 => 'Berkembang Sesuai Harapan',
            $rataRata >= 1.5 => 'Mulai Berkembang',
            $rataRata > 0    => 'Belum Berkembang',
            default          => '-',
        };

        $ujian = RaportIqroUjian::where('siswa_id', $siswa->id)->get();
        foreach ($ujian as $u) {
            $u->keterangan = $this->keteranganUjian($u->nilai_ujian);
        }

        $kalimatAspek = '';
        foreach ($aspeks as $aspek) {
            $ket = $keterangan[$aspek->id] ?? '-';
            $kalimatAspek .= "Pada aspek {$aspek->nama_aspek}, Ananda berada pada kategori \"{$ket}\". ";
        }

        $catatan = $bacaan
            ? "Ananda {$siswa->nama_siswa} menunjukkan perkembangan yang menggembirakan dalam program Iqro dengan pencapaian pada kategori \"{$status}\". {$kalimatAspek}Saat ini, Ananda telah berhasil menyelesaikan hingga Iqro {$bacaan->iqro_terakhir} halaman {$bacaan->halaman_terakhir} dan diharapkan dapat melanjutkan ke Iqro {$bacaan->iqro_lanjut} halaman {$bacaan->halaman_lanjut} pada periode berikutnya. Dukungan orang tua/wali sangat penting agar Ananda konsisten belajar dan mengulang setiap hari, sehingga keberhasilan program Iqro dapat tercapai dengan lancar dan berkualitas." : null;

        $namaGuru = Auth::user()->name ?? '-';
        $nuptk    = Auth::user()->guru->nuptk ?? '-';

        return compact(
            'siswa',
            'aspeks',
            'nilai',
            'keterangan',
            'bacaan',
            'pencapaian',
            'status',
            'ujian',
            'catatan',
            'namaGuru',
            'nuptk'
        );
    }

    private function keteranganUjian($nilai): string
    {
        if ($nilai >= 1 && $nilai <= 75) return 'Cukup';
        if ($nilai >= 76 && $nilai <= 80) return 'Baik';
        if ($nilai >= 81 && $nilai <= 100) return 'Sangat Baik';
        return '-';
    }
}
