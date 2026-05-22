<?php

namespace App\Exports;

use App\Models\Tatausaha\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaDataPdf
{
    protected $tingkat;
    protected $kode_rombel;

    public function __construct($tingkat = null, $kode_rombel = null)
    {
        $this->tingkat = $tingkat;
        $this->kode_rombel = $kode_rombel;
    }

    protected function query()
    {
        $query = Siswa::with('rombelAktif')
            ->leftJoin('rombels', 'siswas.rombel_id', '=', 'rombels.id')
            ->select('siswas.*');

        if ($this->tingkat) {
            $query->where('rombels.tingkat', $this->tingkat);
        }

        if ($this->kode_rombel) {
            $query->where('rombels.kode_rombel', $this->kode_rombel);
        }

        return $query
            ->orderByRaw("CASE WHEN rombels.tingkat IN ('VII','7') THEN 1 WHEN rombels.tingkat IN ('VIII','8') THEN 2 WHEN rombels.tingkat IN ('IX','9') THEN 3 ELSE 4 END")
            ->orderBy('rombels.kode_rombel');
    }

    public function download()
    {
        $siswas = $this->query()->get();
        $filterLabel = 'Seluruh Data Siswa';
        if ($this->tingkat && $this->kode_rombel) {
            $filterLabel = "Kelas {$this->tingkat} {$this->kode_rombel}";
        } elseif ($this->tingkat) {
            $filterLabel = "Semua Kelas {$this->tingkat}";
        }

        $filename = 'DATA_SISWA_' . ($this->tingkat ? $this->tingkat : 'SEMUA');
        if ($this->kode_rombel) {
            $filename .= '_'.$this->kode_rombel;
        }
        $filename .= '_' . now()->format('Ymd_His') . '.pdf';

        $pdf = Pdf::loadView('exports.siswa-data-pdf', [
            'siswas' => $siswas,
            'filterLabel' => $filterLabel,
            'tanggalCetak' => now()->format('d F Y'),
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }
}
