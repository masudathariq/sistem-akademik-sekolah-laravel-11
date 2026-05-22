<?php

namespace App\Exports;

use App\Models\Tatausaha\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SiswaDataExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithColumnWidths
{
    protected $tingkat;
    protected $kode_rombel;

    public function __construct($tingkat = null, $kode_rombel = null)
    {
        $this->tingkat = $tingkat;
        $this->kode_rombel = $kode_rombel;
    }

    public function collection()
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

        $siswas = $query
            ->orderByRaw("CASE WHEN rombels.tingkat IN ('VII','7') THEN 1 WHEN rombels.tingkat IN ('VIII','8') THEN 2 WHEN rombels.tingkat IN ('IX','9') THEN 3 ELSE 4 END")
            ->orderBy('rombels.kode_rombel')
            ->get();

        return $siswas->map(function (Siswa $siswa) {
            return [
                'NISN' => $siswa->nisn,
                'NIS' => $siswa->nis,
                'Nama Siswa' => $siswa->nama_siswa,
                'Jenis Kelamin' => $siswa->jenis_kelamin,
                'Tingkat' => $siswa->rombelAktif?->tingkat_romawi ?? '-',
                'Kode Rombel' => $siswa->rombelAktif?->kode_rombel ?? '-',
                'Nama Rombel' => $siswa->rombelAktif?->nama_rombel ?? '-',
                'Tempat Lahir' => $siswa->tempat_lahir,
                'Tanggal Lahir' => $siswa->tanggal_lahir,
                'Alamat' => $siswa->alamat,
                'Ayah' => $siswa->ayah,
                'Ibu' => $siswa->ibu,
                'Wali' => $siswa->wali,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NISN',
            'NIS',
            'Nama Siswa',
            'Jenis Kelamin',
            'Tingkat',
            'Kode Rombel',
            'Nama Rombel',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Ayah',
            'Ibu',
            'Wali',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 16,
            'B' => 14,
            'C' => 30,
            'D' => 14,
            'E' => 10,
            'F' => 12,
            'G' => 28,
            'H' => 20,
            'I' => 16,
            'J' => 40,
            'K' => 24,
            'L' => 24,
            'M' => 24,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getRowDimension(1)->setRowHeight(28);
        $sheet->freezePane('A2');

        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E40AF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'D1D5DB'],
                ],
            ],
        ]);

        $sheet->getStyle('A:M')->applyFromArray([
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            'font' => ['size' => 11],
        ]);

        $sheet->getStyle('J')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A:B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E:G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}
