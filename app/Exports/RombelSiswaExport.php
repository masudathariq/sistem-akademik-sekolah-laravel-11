<?php

namespace App\Exports;

use App\Models\Tatausaha\Rombel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RombelSiswaExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithTitle,
    WithColumnWidths
{
    // ── Palette ────────────────────────────────────────────────
    private const NAVY        = '0F2D6B';   // banner background
    private const ACCENT      = '2563EB';   // table header
    private const ACCENT_DIM  = 'A8C7FA';   // subtitle text on navy
    private const LIGHT_BG    = 'F0F4FF';   // info label background
    private const STRIPE      = 'F8FAFC';   // zebra row
    private const WHITE       = 'FFFFFF';
    private const DARK_TEXT   = '0F172A';
    private const MID_TEXT    = '334155';
    private const SOFT        = 'E2E8F0';   // info cell border
    private const TBL_BORDER  = 'CBD5E1';   // data table border
    private const HDR_BORDER  = '93C5FD';   // header cell border

    protected $rombel;

    public function __construct($rombelId)
    {
        $this->rombel = Rombel::with(['siswas', 'walikelas', 'tahunAjaran'])->findOrFail($rombelId);
    }

    // ── Data ───────────────────────────────────────────────────

    public function collection()
    {
        return $this->rombel->siswas->map(function ($siswa, $index) {
            return [
                $index + 1,
                $siswa->nisn,
                $siswa->nis,
                $siswa->nama_siswa,
                $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                $siswa->tempat_lahir,
                \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y'),
                $siswa->alamat,
                $siswa->ayah,
                $siswa->ibu,
                $siswa->wali ?? '–',
            ];
        });
    }

    /**
     * Headings are used as the rows BEFORE the data collection.
     * Layout (10 rows total before data):
     *   1  – School name banner
     *   2  – Sub-title
     *   3  – Accent separator  (empty string)
     *   4  – Blank spacer      (empty string)
     *   5  – Info row 1: Rombel / Wali Kelas
     *   6  – Info row 2: Tahun Ajaran / Jumlah Siswa
     *   7  – Blank spacer
     *   8  – Table column headers
     *
     * Note: all layout is controlled in styles(); headings() just
     * supplies the raw cell values so the rows exist in the sheet.
     */
    public function headings(): array
    {
        return [
            /* 1 */ ['MTs MUHAMMADIYAH 1 NATAR'],
            /* 2 */ ['DAFTAR SISWA'],
            /* 3 */ [''],   // accent separator
            /* 4 */ [''],   // spacer
            /* 5 */ [''],   // info row 1 – values written in styles()
            /* 6 */ [''],   // info row 2 – values written in styles()
            /* 7 */ [''],   // spacer
            /* 8 */ [       // table header
                        'No', 'NISN', 'NIS', 'Nama Siswa',
                        'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir',
                        'Alamat', 'Nama Ayah', 'Nama Ibu', 'Nama Wali',
                    ],
        ];
    }

    // ── Styles ─────────────────────────────────────────────────

    public function styles(Worksheet $sheet)
    {
        $dataRows  = $this->rombel->siswas->count();
        $lastData  = 8 + $dataRows;   // header ends at row 8; data starts row 9
        $summaryRow = $lastData + 1;

        // ── Helpers ──────────────────────────────────────────────
        $thinBorder = fn($rgb) => [
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => $rgb]]],
        ];
        $solidFill  = fn($rgb) => ['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $rgb]]];

        // ── Row heights ──────────────────────────────────────────
        $sheet->getRowDimension(1)->setRowHeight(36);   // banner
        $sheet->getRowDimension(2)->setRowHeight(22);   // sub-title
        $sheet->getRowDimension(3)->setRowHeight(4);    // accent line
        $sheet->getRowDimension(4)->setRowHeight(8);    // spacer
        $sheet->getRowDimension(5)->setRowHeight(22);   // info
        $sheet->getRowDimension(6)->setRowHeight(22);   // info
        $sheet->getRowDimension(7)->setRowHeight(8);    // spacer
        $sheet->getRowDimension(8)->setRowHeight(28);   // table header

        // ── ROW 1: Banner ────────────────────────────────────────
        $sheet->mergeCells('A1:K1');
        $sheet->getStyle('A1:K1')->applyFromArray(array_merge(
            $solidFill(self::NAVY),
            [
                'font'      => ['bold' => true, 'size' => 18, 'color' => ['rgb' => self::WHITE], 'name' => 'Arial'],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            ]
        ));

        // ── ROW 2: Sub-title ─────────────────────────────────────
        $sheet->mergeCells('A2:K2');
        $sheet->getStyle('A2:K2')->applyFromArray(array_merge(
            $solidFill(self::NAVY),
            [
                'font'      => ['bold' => true, 'italic' => true, 'size' => 12, 'color' => ['rgb' => self::ACCENT_DIM], 'name' => 'Arial'],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            ]
        ));

        // ── ROW 3: Accent separator ──────────────────────────────
        $sheet->mergeCells('A3:K3');
        $sheet->getStyle('A3:K3')->applyFromArray($solidFill(self::ACCENT));

        // ── ROW 4: Spacer ────────────────────────────────────────
        $sheet->mergeCells('A4:K4');

        // ── ROWS 5-6: Info grid ──────────────────────────────────
        // Structure per row:  [A:B]=label  [C:E]=value  [F:G]=label  [H:K]=value
        // Write info values BEFORE merging (merge clears non-top-left cells)
        $siswaCount = $this->rombel->siswas->count();
        $walikelas  = $this->rombel->walikelas?->nama ?? '-';

        $sheet->setCellValue('A5', 'Rombel');
        $sheet->setCellValue('C5', $this->rombel->nama_lengkap);
        $sheet->setCellValue('F5', 'Wali Kelas');
        $sheet->setCellValue('H5', $walikelas);

        $sheet->setCellValue('A6', 'Tahun Ajaran');
        $sheet->setCellValue('C6', $this->rombel->tahunAjaran->tahun_ajaran);
        $sheet->setCellValue('F6', 'Jumlah Siswa');
        $sheet->setCellValue('H6', $siswaCount . ' Siswa');

        foreach ([5, 6] as $r) {
            // Left label
            $sheet->mergeCells("A{$r}:B{$r}");
            $sheet->getStyle("A{$r}:B{$r}")->applyFromArray(array_merge(
                $solidFill(self::LIGHT_BG),
                $thinBorder(self::SOFT),
                [
                    'font'      => ['bold' => true, 'size' => 10, 'color' => ['rgb' => self::MID_TEXT], 'name' => 'Arial'],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
                ]
            ));

            // Left value
            $sheet->mergeCells("C{$r}:E{$r}");
            $sheet->getStyle("C{$r}:E{$r}")->applyFromArray(array_merge(
                $solidFill(self::WHITE),
                $thinBorder(self::SOFT),
                [
                    'font'      => ['size' => 10, 'color' => ['rgb' => self::DARK_TEXT], 'name' => 'Arial'],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
                ]
            ));

            // Right label
            $sheet->mergeCells("F{$r}:G{$r}");
            $sheet->getStyle("F{$r}:G{$r}")->applyFromArray(array_merge(
                $solidFill(self::LIGHT_BG),
                $thinBorder(self::SOFT),
                [
                    'font'      => ['bold' => true, 'size' => 10, 'color' => ['rgb' => self::MID_TEXT], 'name' => 'Arial'],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
                ]
            ));

            // Right value
            $sheet->mergeCells("H{$r}:K{$r}");
            $sheet->getStyle("H{$r}:K{$r}")->applyFromArray(array_merge(
                $solidFill(self::WHITE),
                $thinBorder(self::SOFT),
                [
                    'font'      => ['size' => 10, 'color' => ['rgb' => self::DARK_TEXT], 'name' => 'Arial'],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
                ]
            ));
        }

        // ── ROW 7: Spacer ────────────────────────────────────────
        $sheet->mergeCells('A7:K7');

        // ── ROW 8: Table header ───────────────────────────────────
        $hdrSide = new \PhpOffice\PhpSpreadsheet\Style\Color(self::HDR_BORDER);
        $sheet->getStyle('A8:K8')->applyFromArray(array_merge(
            $solidFill(self::ACCENT),
            $thinBorder(self::HDR_BORDER),
            [
                'font'      => ['bold' => true, 'size' => 10, 'color' => ['rgb' => self::WHITE], 'name' => 'Arial'],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            ]
        ));

        // ── ROWS 9 … lastData: Data rows ─────────────────────────
        $sheet->getStyle("A9:K{$lastData}")->applyFromArray(array_merge(
            $thinBorder(self::TBL_BORDER),
            [
                'font'      => ['size' => 10, 'color' => ['rgb' => self::DARK_TEXT], 'name' => 'Arial'],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]
        ));

        // Center: No, NISN, NIS, Jenis Kelamin, Tanggal Lahir
        foreach (['A', 'B', 'C', 'E', 'G'] as $col) {
            $sheet->getStyle("{$col}9:{$col}{$lastData}")
                  ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Wrap address
        $sheet->getStyle("H9:H{$lastData}")
              ->getAlignment()->setWrapText(true);

        // Zebra striping
        for ($row = 9; $row <= $lastData; $row++) {
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:K{$row}")
                      ->applyFromArray($solidFill(self::STRIPE));
            }
        }

        // ── Summary row ───────────────────────────────────────────
        if ($dataRows > 0) {
            $sheet->getRowDimension($summaryRow)->setRowHeight(22);
            $sheet->mergeCells("A{$summaryRow}:C{$summaryRow}");
            $sheet->getStyle("A{$summaryRow}:C{$summaryRow}")->applyFromArray(array_merge(
                $solidFill(self::NAVY),
                [
                    'font'      => ['bold' => true, 'size' => 10, 'color' => ['rgb' => self::WHITE], 'name' => 'Arial'],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]
            ));
            $sheet->getCell("A{$summaryRow}")->setValue("Total: {$dataRows} Siswa");

            foreach (['D','E','F','G','H','I','J','K'] as $col) {
                $sheet->getStyle("{$col}{$summaryRow}")->applyFromArray($solidFill(self::NAVY));
            }
        }

        // ── Print setup ───────────────────────────────────────────
        $sheet->getPageSetup()
              ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
              ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4)
              ->setFitToPage(true)
              ->setFitToWidth(1)
              ->setFitToHeight(0);

        $sheet->getHeaderFooter()
              ->setOddHeader('&C&B&14MTs MUHAMMADIYAH 1 NATAR');
        $sheet->getHeaderFooter()
              ->setOddFooter('&LDicetak: &D &T&RHalaman &P dari &N');

        return [];
    }

    // ── Column widths ──────────────────────────────────────────

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 16,  // NISN
            'C' => 13,  // NIS
            'D' => 26,  // Nama Siswa
            'E' => 14,  // Jenis Kelamin
            'F' => 18,  // Tempat Lahir
            'G' => 14,  // Tanggal Lahir
            'H' => 32,  // Alamat
            'I' => 20,  // Nama Ayah
            'J' => 20,  // Nama Ibu
            'K' => 20,  // Nama Wali
        ];
    }

    public function title(): string
    {
        return substr($this->rombel->kode_rombel, 0, 31);
    }
}