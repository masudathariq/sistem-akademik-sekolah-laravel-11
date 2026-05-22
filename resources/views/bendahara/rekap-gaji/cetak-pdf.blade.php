<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Slip Gaji - {{ $guru->nama }} - {{ $namaBulan }} {{ $tahun }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 14mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #ffffff;
            color: #111827;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10.5px;
            line-height: 1.45;
        }

        .sheet {
            width: 100%;
        }

        .slip {
            width: 98mm;
            margin: 0 auto;
            border: 1px solid #111827;
            background: #ffffff;
        }

        .slip-pad {
            padding: 14px 16px;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #111827;
            padding: 16px 16px 12px;
        }

        .doc-title {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .doc-subtitle {
            margin-top: 4px;
            font-size: 10px;
            color: #4b5563;
        }

        .period {
            display: inline-block;
            margin-top: 9px;
            padding: 4px 10px;
            border: 1px solid #111827;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .meta {
            border-bottom: 1px dashed #9ca3af;
        }

        .meta-table,
        .line-table,
        .summary-table,
        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .label {
            width: 88px;
            color: #4b5563;
        }

        .separator {
            width: 10px;
            color: #6b7280;
        }

        .value {
            font-weight: 700;
            color: #111827;
        }

        .section {
            padding: 10px 16px 6px;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #111827;
        }

        .section-note {
            margin-top: 2px;
            font-size: 9px;
            color: #6b7280;
        }

        .line-table td {
            padding: 6px 0;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: top;
        }

        .line-table tr:last-child td {
            border-bottom: none;
        }

        .line-name {
            color: #111827;
        }

        .line-sub {
            margin-top: 1px;
            font-size: 9px;
            color: #6b7280;
        }

        .amount {
            width: 118px;
            text-align: right;
            white-space: nowrap;
            font-weight: 700;
        }

        .plus {
            color: #047857;
        }

        .minus {
            color: #b91c1c;
        }

        .summary {
            border-top: 1px dashed #9ca3af;
            border-bottom: 1px dashed #9ca3af;
            background: #f9fafb;
        }

        .summary-table td {
            padding: 4px 0;
        }

        .summary-label {
            color: #374151;
        }

        .summary-value {
            text-align: right;
            font-weight: 700;
            white-space: nowrap;
        }

        .grand-total {
            padding: 12px 16px;
            border-bottom: 1px solid #111827;
            background: #111827;
            color: #ffffff;
        }

        .grand-total table {
            width: 100%;
            border-collapse: collapse;
        }

        .grand-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .grand-value {
            text-align: right;
            font-size: 15px;
            font-weight: 700;
            white-space: nowrap;
        }

        .footer {
            padding: 12px 16px 14px;
        }

        .footer-note {
            margin-bottom: 14px;
            font-size: 8.8px;
            color: #6b7280;
            text-align: center;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: bottom;
            font-size: 9.5px;
        }

        .signature-space {
            height: 42px;
        }

        .signature-line {
            width: 92px;
            margin: 0 auto 3px;
            border-top: 1px solid #111827;
        }

        .signature-role {
            color: #4b5563;
        }

        .cut-line {
            margin: 9mm auto 0;
            width: 98mm;
            border-top: 1px dashed #9ca3af;
            text-align: center;
            color: #9ca3af;
            font-size: 8px;
            padding-top: 3px;
        }
    </style>
</head>
<body>
@php
    $formatRupiah = fn ($value) => 'Rp ' . number_format((float) $value, 0, ',', '.');
@endphp

<div class="sheet">
    <div class="slip">
        <div class="header">
            <div class="doc-title">Slip Gaji Guru</div>
            <div class="doc-subtitle">MTs Muhammadiyah 1 Natar</div>
            <div class="period">{{ $namaBulan }} {{ $tahun }}</div>
        </div>

        <div class="slip-pad meta">
            <table class="meta-table">
                <tr>
                    <td class="label">Nama</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $guru->nama }}</td>
                </tr>
                @if(isset($guru->nip) && $guru->nip)
                    <tr>
                        <td class="label">NIP</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $guru->nip }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="label">Periode</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $namaBulan }} {{ $tahun }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Cetak</td>
                    <td class="separator">:</td>
                    <td class="value">{{ now()->translatedFormat('d F Y') }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Kehadiran</div>
            <div class="section-note">Dasar perhitungan transport dan koreksi kehadiran.</div>
        </div>
        <div class="slip-pad">
            <table class="summary-table">
                <tr>
                    <td class="summary-label">Hadir Asli</td>
                    <td class="summary-value">{{ $hadirAsli }} hari</td>
                </tr>
                <tr>
                    <td class="summary-label">Koreksi Kehadiran</td>
                    <td class="summary-value {{ $koreksi < 0 ? 'minus' : ($koreksi > 0 ? 'plus' : '') }}">
                        {{ $koreksi > 0 ? '+' : '' }}{{ $koreksi }} hari
                    </td>
                </tr>
                <tr>
                    <td class="summary-label">Hadir Final</td>
                    <td class="summary-value">{{ $hadirFinal }} hari</td>
                </tr>
                @if($keteranganKoreksi && $keteranganKoreksi !== '-')
                    <tr>
                        <td class="summary-label">Keterangan</td>
                        <td class="summary-value">{{ $keteranganKoreksi }}</td>
                    </tr>
                @endif
            </table>
        </div>

        <div class="section">
            <div class="section-title">Pendapatan</div>
        </div>
        <div class="slip-pad">
            <table class="line-table">
                <tr>
                    <td>
                        <div class="line-name">Gaji Pokok</div>
                    </td>
                    <td class="amount">{{ $formatRupiah($gajiPokok) }}</td>
                </tr>
                <tr>
                    <td>
                        <div class="line-name">Transport</div>
                        <div class="line-sub">{{ $hadirFinal }} hari x {{ $formatRupiah($transportPerHari) }}</div>
                    </td>
                    <td class="amount plus">+ {{ $formatRupiah($transport) }}</td>
                </tr>
                @if($tahfidz > 0)
                    <tr>
                        <td>
                            <div class="line-name">Insentif Tahfidz</div>
                            @if($hadirTahfidz > 0)
                                <div class="line-sub">{{ $hadirTahfidz }} hari x {{ $formatRupiah($tarifTahfidz) }}</div>
                            @endif
                        </td>
                        <td class="amount plus">+ {{ $formatRupiah($tahfidz) }}</td>
                    </tr>
                @endif
                @foreach($penambahanList as $item)
                    <tr>
                        <td>
                            <div class="line-name">{{ $item->judul }}</div>
                            <div class="line-sub">{{ ucfirst($item->tipe) }}</div>
                        </td>
                        <td class="amount plus">+ {{ $formatRupiah($item->jumlah) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if($penguranganList->count() > 0)
            <div class="section">
                <div class="section-title">Potongan</div>
            </div>
            <div class="slip-pad">
                <table class="line-table">
                    @foreach($penguranganList as $item)
                        <tr>
                            <td>
                                <div class="line-name">{{ $item->judul }}</div>
                                <div class="line-sub">{{ ucfirst($item->tipe) }}</div>
                            </td>
                            <td class="amount minus">- {{ $formatRupiah($item->jumlah) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif

        <div class="slip-pad summary">
            <table class="summary-table">
                <tr>
                    <td class="summary-label">Subtotal Pendapatan</td>
                    <td class="summary-value plus">{{ $formatRupiah($gajiPokok + $transport + $tahfidz + $totalPenambahan) }}</td>
                </tr>
                <tr>
                    <td class="summary-label">Subtotal Potongan</td>
                    <td class="summary-value minus">{{ $formatRupiah($totalPengurangan) }}</td>
                </tr>
            </table>
        </div>

        <div class="grand-total">
            <table>
                <tr>
                    <td class="grand-label">Total Diterima</td>
                    <td class="grand-value">{{ $formatRupiah($totalGaji) }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <div class="footer-note">
                Slip ini dicetak otomatis oleh sistem dan digunakan sebagai bukti pembayaran gaji.
            </div>
            <table class="signature-table">
                <tr>
                    <td>
                        <div class="signature-space"></div>
                        <div class="signature-line"></div>
                        <div>Guru</div>
                    </td>
                    <td>
                        <div class="signature-space"></div>
                        <div class="signature-line"></div>
                        <div>Bendahara</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="cut-line">potong di sini</div>
</div>
</body>
</html>
