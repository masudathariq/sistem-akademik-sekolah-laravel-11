<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji {{ $namaBulan }} {{ $tahun }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4 landscape;
            margin: 8mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 8pt;
        }

        .page {
            width: 100%;
            height: 100%;
            page-break-after: always;
            display: flex;
            flex-direction: row;
            gap: 6mm;
            align-items: stretch;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .slip {
            flex: 1;
            border: 2px solid #000;
            padding: 8px;
            display: flex;
            flex-direction: column;
            width: calc(33.33% - 4mm);
        }

        .slip-header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 6px;
            margin-bottom: 8px;
            background: #f8f9fa;
        }

        .slip-header h2 {
            font-size: 12pt;
            margin-bottom: 2px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .slip-header h3 {
            font-size: 9pt;
            margin-bottom: 3px;
            font-weight: normal;
        }

        .slip-header p {
            font-size: 8pt;
            color: #555;
            font-style: italic;
        }

        .guru-info {
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 1px solid #ddd;
            background: #fafafa;
            padding: 6px;
        }

        .guru-info-row {
            display: flex;
            margin-bottom: 3px;
            font-size: 8pt;
        }

        .guru-info-row .label {
            font-weight: bold;
            width: 70px;
            flex-shrink: 0;
        }

        .guru-info-row .value {
            flex: 1;
        }

        /* SECTION KEHADIRAN */
        .section {
            margin-bottom: 8px;
            padding: 6px;
            background: #f8f9fa;
            border-radius: 3px;
        }

        .section-title {
            font-weight: bold;
            font-size: 8.5pt;
            margin-bottom: 4px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
            font-size: 7.5pt;
        }

        .detail-row.highlight {
            font-weight: bold;
            background: #fff;
            padding: 3px 4px;
            margin-top: 2px;
            border-radius: 2px;
        }

        /* RINCIAN GAJI */
        .rincian {
            flex: 1;
        }

        .rincian table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }

        .rincian td {
            padding: 3px 2px;
            border-bottom: 1px dotted #ddd;
        }

        .rincian td:first-child {
            width: 60%;
        }

        .rincian td:last-child {
            text-align: right;
            font-weight: 500;
        }

        .sub-item {
            font-size: 7pt;
            color: #666;
            padding-left: 12px !important;
            font-style: italic;
        }

        .sub-total {
            background: #f0f0f0;
            font-weight: bold;
            border-top: 1px solid #ccc !important;
            border-bottom: 1px solid #ccc !important;
        }

        .total-row {
            background: #e3f2fd;
            border-top: 2px solid #000 !important;
            border-bottom: 2px solid #000 !important;
        }

        .total-row td {
            font-size: 9.5pt;
            font-weight: bold;
            padding: 6px 2px !important;
            color: #1565c0;
        }

        .text-green {
            color: #059669;
        }

        .text-red {
            color: #dc2626;
        }

        .text-blue {
            color: #2563eb;
        }

        .footer {
            margin-top: auto;
            padding-top: 6px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 6.5pt;
            color: #666;
            font-style: italic;
        }

        .divider {
            border-top: 1px solid #333;
            margin: 4px 0;
        }

        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .no-print {
                display: none;
            }
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .print-button:hover {
            background: #1d4ed8;
        }

        .empty-slip {
            border: 2px dashed #ccc;
            opacity: 0.2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-button no-print">🖨️ Cetak Slip Gaji</button>

    @foreach($pages as $pageSlips)
    <div class="page">
        @foreach($pageSlips as $slip)
        <div class="slip">
            {{-- HEADER --}}
            <div class="slip-header">
                <h2>BUKTI PEMBAYARAN GAJI</h2>
                <h3>Tenaga Pendidik</h3>
                <p>Periode: {{ $namaBulan }} {{ $tahun }}</p>
            </div>

            {{-- INFO GURU --}}
            <div class="guru-info">
                <div class="guru-info-row">
                    <div class="label">Nama Lengkap</div>
                    <div class="value">: {{ $slip['guru']->nama }}</div>
                </div>
                @if(isset($slip['guru']->nip))
                <div class="guru-info-row">
                    <div class="label">NIP</div>
                    <div class="value">: {{ $slip['guru']->nip }}</div>
                </div>
                @endif
            </div>

            {{-- KEHADIRAN --}}
            <div class="section">
                <div class="section-title">Rekapitulasi Kehadiran</div>
                <div class="detail-row">
                    <span>Jumlah Hari Hadir (Sistem)</span>
                    <span>{{ $slip['hadir_asli'] }} hari</span>
                </div>
                @if($slip['koreksi'] != 0)
                <div class="detail-row">
                    <span>Penyesuaian/Koreksi</span>
                    <span class="{{ $slip['koreksi'] > 0 ? 'text-green' : 'text-red' }}">
                        {{ $slip['koreksi'] > 0 ? '+' : '' }}{{ $slip['koreksi'] }} hari
                    </span>
                </div>
                @endif
                <div class="divider"></div>
                <div class="detail-row highlight text-blue">
                    <span>Total Hari Hadir</span>
                    <span>{{ $slip['hadir_final'] }} hari</span>
                </div>
            </div>

            {{-- RINCIAN GAJI --}}
            <div class="rincian">
                <table>
                    {{-- GAJI POKOK --}}
                    <tr>
                        <td><strong>Gaji Pokok</strong></td>
                        <td><strong>Rp {{ number_format($slip['gaji_pokok'], 0, ',', '.') }}</strong></td>
                    </tr>

                    {{-- TAHFIDZ --}}
@if($slip['tahfidz'] > 0)
<tr>
    <td><strong>Insentif Tahfidz</strong></td>
    <td class="text-green">
        <strong>Rp {{ number_format($slip['tahfidz'], 0, ',', '.') }}</strong>
    </td>
</tr>
<tr>
    <td class="sub-item">
        ({{ $slip['hadir_tahfidz'] }} hari × 
        Rp {{ number_format($slip['tarif_tahfidz'], 0, ',', '.') }}/hari)
    </td>
    <td></td>
</tr>
@endif


                    {{-- TRANSPORT --}}
                    <tr>
                        <td><strong>Tunjangan Transport</strong></td>
                        <td class="text-green"><strong>Rp {{ number_format($slip['transport'], 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td class="sub-item">
                            ({{ $slip['hadir_final'] }} hari × Rp {{ number_format($slip['transport_per_hari'], 0, ',', '.') }}/hari)
                        </td>
                        <td></td>
                    </tr>

                    {{-- PENAMBAHAN --}}
                    @if($slip['penambahan_list']->count() > 0)
                    <tr>
                        <td colspan="2" style="padding-top: 6px; padding-bottom: 2px;">
                            <strong>Tunjangan & Insentif Lainnya:</strong>
                        </td>
                    </tr>
                    @foreach($slip['penambahan_list'] as $item)
                    <tr>
                        <td class="sub-item">
                            • {{ $item->judul }}
                        </td>
                        <td class="text-green">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr class="sub-total">
                        <td style="padding-left: 8px;">Jumlah Tunjangan & Insentif</td>
                        <td class="text-green">Rp {{ number_format($slip['total_penambahan'], 0, ',', '.') }}</td>
                    </tr>
                    @endif

                    {{-- PENGURANGAN --}}
                    @if($slip['pengurangan_list']->count() > 0)
                    <tr>
                        <td colspan="2" style="padding-top: 6px; padding-bottom: 2px;">
                            <strong>Potongan & Pengurangan:</strong>
                        </td>
                    </tr>
                    @foreach($slip['pengurangan_list'] as $item)
                    <tr>
                        <td class="sub-item">
                            • {{ $item->judul }}
                        </td>
                        <td class="text-red">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr class="sub-total">
                        <td style="padding-left: 8px;">Jumlah Potongan</td>
                        <td class="text-red">Rp {{ number_format($slip['total_pengurangan'], 0, ',', '.') }}</td>
                    </tr>
                    @endif

                    {{-- TOTAL --}}
                    <tr class="total-row">
                        <td>GAJI YANG DITERIMA (TAKE HOME PAY)</td>
                        <td>Rp {{ number_format($slip['total'], 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            {{-- FOOTER --}}
            <div class="footer">
                <p>Dokumen ini dicetak otomatis pada {{ now()->translatedFormat('d F Y') }} pukul {{ now()->format('H:i') }} WIB</p>
                <p style="margin-top: 2px;">Sah tanpa tanda tangan dan stempel</p>
            </div>
        </div>
        @endforeach

        {{-- FILL EMPTY SLOTS IF LESS THAN 3 --}}
        @for($i = count($pageSlips); $i < 3; $i++)
        <div class="slip empty-slip">
            <em>- Kosong -</em>
        </div>
        @endfor
    </div>
    @endforeach

    <script>
        // Auto print saat halaman dimuat (uncomment jika diperlukan)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 500);
        // };
    </script>
</body>
</html>