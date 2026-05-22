<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekap Absensi Guru</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #1f2937;
            margin: 0;
            padding: 28px;
            line-height: 1.5;
            background: #ffffff;
        }

        /* ================= HEADER ================= */

        .header {
            width: 100%;
            margin-bottom: 18px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo {
            width: 70px;
        }

        .logo img {
            width: 62px;
        }

        .school-info {
            text-align: center;
        }

        .school-info h1 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .school-info h2 {
            margin: 2px 0;
            font-size: 13px;
            font-weight: 700;
        }

        .school-info p {
            margin: 1px 0;
            font-size: 10px;
            color: #4b5563;
        }

        .divider {
            border: none;
            border-top: 2px solid #111827;
            margin-top: 14px;
            margin-bottom: 20px;
        }

        /* ================= TITLE ================= */

        .title {
            text-align: center;
            margin-bottom: 24px;
        }

        .title h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .title p {
            margin-top: 5px;
            font-size: 11px;
            color: #6b7280;
        }

        /* ================= INFO ================= */

        .info-box {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 12px 14px;
            margin-bottom: 18px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 4px 0;
            font-size: 10px;
        }

        .info-label {
            width: 18%;
            color: #6b7280;
            font-weight: 600;
        }

        .info-value {
            width: 32%;
            font-weight: 600;
            color: #111827;
        }

        /* ================= SUMMARY ================= */

        .summary-wrapper {
            width: 100%;
            margin-bottom: 18px;
        }

        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
        }

        .summary-card {
            border: 1px solid #dbe3ea;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background: #f9fafb;
        }

        .summary-card .label {
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .summary-card .value {
            font-size: 18px;
            font-weight: bold;
            color: #111827;
        }

        /* ================= TABLE ================= */

        table.absensi {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        table.absensi thead th {
            background: #1f2937;
            color: white;
            padding: 9px 6px;
            border: 1px solid #374151;
            font-weight: 700;
            text-align: center;
        }

        table.absensi tbody td {
            border: 1px solid #d1d5db;
            padding: 7px 6px;
            vertical-align: middle;
        }

        table.absensi tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        table.absensi td.center {
            text-align: center;
        }

        table.absensi td.left {
            text-align: left;
        }

        /* ================= STATUS ================= */

        .status {
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
        }

        .hadir {
            background: #dcfce7;
            color: #166534;
        }

        .izin {
            background: #fef3c7;
            color: #92400e;
        }

        .sakit {
            background: #fee2e2;
            color: #991b1b;
        }

        .alpha {
            background: #e5e7eb;
            color: #374151;
        }

        /* ================= EMPTY ================= */

        .empty {
            text-align: center;
            padding: 18px !important;
            color: #6b7280;
            font-style: italic;
        }

        /* ================= FOOTER ================= */

        .footer {
            margin-top: 28px;
            border-top: 1px solid #d1d5db;
            padding-top: 10px;
            font-size: 9px;
            color: #6b7280;
        }

        .footer-table {
            width: 100%;
        }

        .footer-left {
            text-align: left;
        }

        .footer-right {
            text-align: right;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
    {{-- KOP SURAT --}}
    <div style="
        width: 100%;
        margin-bottom: 24px;
    ">
        <img src="{{ public_path('images/kop.jpg') }}"
             style="
                width: 100%;
                height: auto;
             ">
    </div>

    </div>

    {{-- TITLE --}}
    <div class="title">

        <h3>Rekapitulasi Absensi Guru</h3>

        <p>
            Periode
            {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM YYYY') }}
        </p>

    </div>

    {{-- IDENTITAS --}}
    <div class="info-box">

        <table class="info-table">

            <tr>
                <td class="info-label">Nama Guru</td>
                <td class="info-value">: {{ $guru->nama }}</td>

                <td class="info-label">NUPTK</td>
                <td class="info-value">: {{ $guru->nuptk ?? '-' }}</td>
            </tr>

            <tr>
                <td class="info-label">NBM</td>
                <td class="info-value">: {{ $guru->nbm ?? '-' }}</td>

                <td class="info-label">Jenis Kelamin</td>
                <td class="info-value">
                    :
                    {{ $guru->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </td>
            </tr>

        </table>

    </div>

    {{-- SUMMARY --}}
    <div class="summary-wrapper">

        <table class="summary-table">
            <tr>

                <td>
                    <div class="summary-card">
                        <div class="label">Hadir</div>
                        <div class="value">{{ $hadir }}</div>
                    </div>
                </td>

                <td>
                    <div class="summary-card">
                        <div class="label">Izin</div>
                        <div class="value">{{ $izin }}</div>
                    </div>
                </td>

                <td>
                    <div class="summary-card">
                        <div class="label">Sakit</div>
                        <div class="value">{{ $sakit }}</div>
                    </div>
                </td>

                <td>
                    <div class="summary-card">
                        <div class="label">Total Hari</div>
                        <div class="value">{{ $jumlahHari }}</div>
                    </div>
                </td>

                <td>
                    <div class="summary-card">
                        <div class="label">Kehadiran</div>
                        <div class="value">{{ $persenHadir }}%</div>
                    </div>
                </td>

            </tr>
        </table>

    </div>

    {{-- TABLE --}}
    <table class="absensi">

        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="13%">Tanggal</th>
                <th width="14%">Hari</th>
                <th width="12%">Jam Masuk</th>
                <th width="12%">Jam Pulang</th>
                <th width="12%">Status</th>
                <th>Lokasi Presensi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($absensi as $i => $a)

                <tr>

                    <td class="center">
                        {{ $i + 1 }}
                    </td>

                    <td class="center">
                        {{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d M Y') }}
                    </td>

                    <td class="center">
                        {{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('dddd') }}
                    </td>

                    <td class="center">
                        {{ $a->jam_masuk ?? '-' }}
                    </td>

                    <td class="center">
                        {{ $a->jam_pulang ?? '-' }}
                    </td>

                    <td class="center">
                        <span class="status {{ strtolower($a->status) }}">
                            {{ strtoupper($a->status) }}
                        </span>
                    </td>

                    <td class="left">
                        {{ $a->lokasi ?? '-' }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="empty">
                        Tidak terdapat data absensi pada periode ini.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- FOOTER --}}
    <div class="footer">

        <table class="footer-table">
            <tr>

                <td class="footer-left">
                    Dokumen ini dicetak otomatis oleh Sistem Informasi Akademik.
                </td>

                <td class="footer-right">
                    Dicetak:
                    {{ now()->locale('id')->isoFormat('DD MMMM YYYY • HH:mm') }} WIB
                </td>

            </tr>
        </table>

    </div>

</body>
</html>