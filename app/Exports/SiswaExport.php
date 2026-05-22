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

class SiswaExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    ShouldAutoSize,
    WithColumnWidths
{
    public function collection()
    {
        // Template kosong
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'NISN',
            'NIS',
            'Nama Siswa',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Ayah',
            'Ibu',
            'Wali',
            'Rombel ID'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18, // NISN
            'B' => 14, // NIS
            'C' => 30, // Nama
            'D' => 22, // Tempat Lahir
            'E' => 18, // Tanggal Lahir
            'F' => 18, // JK
            'G' => 40, // Alamat
            'H' => 25, // Ayah
            'I' => 25, // Ibu
            'J' => 25, // Wali
            'K' => 14, // Rombel ID
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Tinggi header
        $sheet->getRowDimension(1)->setRowHeight(28);

        // Freeze header
        $sheet->freezePane('A2');

        // Style header
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => [
                    'rgb' => 'FFFFFF'
                ],
            ],

            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '1E40AF'
                ],
            ],

            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],

            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => [
                        'rgb' => 'D1D5DB'
                    ],
                ],
            ],
        ]);

        // Style seluruh kolom
        $sheet->getStyle('A:K')->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],

            'font' => [
                'size' => 11,
            ],
        ]);

        // Wrap text untuk alamat
        $sheet->getStyle('G')->getAlignment()->setWrapText(true);

        // Center kolom tertentu
        $sheet->getStyle('A:B')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('E:F')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('K')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}