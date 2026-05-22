<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Rekap Gaji Guru - {{ $namaBulan }} {{ $tahun }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #111827;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 8.5px;
            line-height: 1.35;
        }

        .header {
            margin-bottom: 10px;
            border-bottom: 2px solid #111827;
            padding-bottom: 8px;
        }

        .header-table,
        .summary-table,
        .rekap-table,
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .title {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .subtitle {
            margin-top: 2px;
            font-size: 9.5px;
            color: #4b5563;
        }

        .period-box {
            display: inline-block;
            border: 1px solid #111827;
            padding: 5px 10px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .summary {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
        }

        .summary-table td {
            padding: 2px 8px;
            vertical-align: top;
        }

        .summary-label {
            color: #4b5563;
            font-size: 8px;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 2px;
            font-size: 10px;
            font-weight: 700;
            color: #111827;
        }

        .rekap-table {
            table-layout: fixed;
        }

        .rekap-table thead {
            display: table-header-group;
        }

        .rekap-table tfoot {
            display: table-row-group;
        }

        .rekap-table th {
            padding: 6px 5px;
            border: 1px solid #111827;
            background: #e5e7eb;
            color: #111827;
            font-size: 7.8px;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            vertical-align: middle;
        }

        .rekap-table td {
            padding: 5px;
            border: 1px solid #9ca3af;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .rekap-table tbody tr:nth-child(even) td {
            background: #f9fafb;
        }

        .rekap-table tfoot td {
            background: #f3f4f6;
            font-weight: 700;
            border: 1px solid #111827;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
            white-space: nowrap;
        }

        .guru-name {
            font-weight: 700;
        }

        .signature-cell {
            height: 38px;
            background: #ffffff !important;
        }

        .empty {
            padding: 24px 8px;
            text-align: center;
            color: #6b7280;
        }

        .footer {
            margin-top: 10px;
            font-size: 8px;
            color: #6b7280;
        }

        .footer-table td {
            vertical-align: top;
        }
    </style>
</head>
<body>
@php
    $rupiah = fn ($value) => 'Rp ' . number_format((float) $value, 0, ',', '.');
@endphp

<div class="header">
    <table class="header-table">
        <tr>
            <td>
                <div class="title">Rekap Gaji Guru</div>
                <div class="subtitle">Sistem Informasi Akademik Sekolah</div>
            </td>
            <td style="text-align:right; width:210px;">
                <div class="period-box">{{ $namaBulan }} {{ $tahun }}</div>
            </td>
        </tr>
    </table>
</div>

<div class="summary">
    <table class="summary-table">
        <tr>
            <td>
                <div class="summary-label">Total Guru</div>
                <div class="summary-value">{{ number_format($summary['total_guru'], 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="summary-label">Total Gaji Pokok</div>
                <div class="summary-value">{{ $rupiah($summary['total_gaji_pokok']) }}</div>
            </td>
            <td>
                <div class="summary-label">Total Tunjangan</div>
                <div class="summary-value">{{ $rupiah($summary['total_penambahan']) }}</div>
            </td>
            <td>
                <div class="summary-label">Total Potongan</div>
                <div class="summary-value">{{ $rupiah($summary['total_pengurangan']) }}</div>
            </td>
            <td>
                <div class="summary-label">Total Dibayar</div>
                <div class="summary-value">{{ $rupiah($summary['total_dibayar']) }}</div>
            </td>
        </tr>
    </table>
</div>

<table class="rekap-table">
    <thead>
        <tr>
            <th style="width:28px;">No</th>
            <th style="width:145px;">Guru</th>
            <th style="width:82px;">Mengajar</th>
            <th style="width:82px;">Tunjangan</th>
            <th style="width:82px;">Potongan</th>
            <th style="width:48px;">Hadir</th>
            <th style="width:82px;">Transport</th>
            <th style="width:82px;">Tahfidz</th>
            <th style="width:90px;">Total</th>
            <th style="width:105px;">Tanda Tangan Guru</th>
        </tr>
    </thead>
    <tbody>
        @forelse($rekap as $i => $item)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>
                    <div class="guru-name">{{ $item['guru']->nama }}</div>
                </td>
                <td class="right">{{ $rupiah($item['gaji_pokok']) }}</td>
                <td class="right">{{ $rupiah($item['penambahan']) }}</td>
                <td class="right">{{ $rupiah($item['pengurangan']) }}</td>
                <td class="center">{{ $item['hadir_final'] }}</td>
                <td class="right">{{ $rupiah($item['transport']) }}</td>
                <td class="right">{{ $rupiah($item['tahfidz']) }}</td>
                <td class="right">{{ $rupiah($item['total']) }}</td>
                <td class="signature-cell"></td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="empty">Belum ada data rekap gaji untuk periode ini.</td>
            </tr>
        @endforelse
    </tbody>
    @if(count($rekap) > 0)
        <tfoot>
            <tr>
                <td colspan="2" class="center">Total</td>
                <td class="right">{{ $rupiah($summary['total_gaji_pokok']) }}</td>
                <td class="right">{{ $rupiah($summary['total_penambahan']) }}</td>
                <td class="right">{{ $rupiah($summary['total_pengurangan']) }}</td>
                <td class="center">-</td>
                <td class="right">{{ $rupiah($summary['total_transport']) }}</td>
                <td class="right">{{ $rupiah($summary['total_tahfidz']) }}</td>
                <td class="right">{{ $rupiah($summary['total_dibayar']) }}</td>
                <td></td>
            </tr>
        </tfoot>
    @endif
</table>

<div class="footer">
    <table class="footer-table">
        <tr>
            <td>
                Dicetak pada {{ now()->translatedFormat('d F Y H:i') }}.
                Dokumen ini digunakan sebagai rekap pembayaran gaji guru periode {{ $namaBulan }} {{ $tahun }}.
            </td>
            <td style="text-align:right; width:220px;">
                Bendahara Sekolah
            </td>
        </tr>
    </table>
</div>
</body>
</html>
