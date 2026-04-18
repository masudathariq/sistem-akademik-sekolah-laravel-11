<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekap Absensi Guru</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #111827;
            padding: 30px;
            line-height: 1.5;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .header h1 {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .header .subtitle {
            font-size: 10px;
            color: #4b5563;
        }

        hr.divider {
            border: none;
            border-top: 2px solid #1f2937;
            margin: 14px 0 18px;
        }

        /* Identitas */
        .identity {
            width: 100%;
            margin-bottom: 14px;
        }

        .identity td {
            padding: 4px 6px;
            font-size: 9px;
        }

        .identity .label {
            width: 18%;
            color: #374151;
            font-weight: 600;
        }

        .identity .value {
            width: 32%;
            color: #111827;
        }

        /* Table */
        table.absensi {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        table.absensi th {
            border: 1px solid #374151;
            padding: 6px 5px;
            background: #f3f4f6;
            font-weight: 700;
            text-align: center;
        }

        table.absensi td {
            border: 1px solid #d1d5db;
            padding: 5px 5px;
            text-align: center;
        }

        table.absensi td.left {
            text-align: left;
        }

        /* Status */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: 700;
        }

        .hadir { background: #dcfce7; color: #166534; }
        .izin { background: #fef9c3; color: #854d0e; }
        .sakit { background: #fee2e2; color: #991b1b; }
        .alpha { background: #e5e7eb; color: #374151; }

        /* Ringkasan */
        .summary {
            margin-top: 14px;
            width: 100%;
            border-collapse: collapse;
        }

        .summary td {
            border: 1px solid #d1d5db;
            padding: 6px;
            text-align: center;
            font-size: 9px;
        }

        .summary .label {
            background: #f9fafb;
            font-weight: 600;
            color: #374151;
        }

        .summary .value {
            font-size: 11px;
            font-weight: 700;
        }

        /* Footer */
        .footer {
            margin-top: 18px;
            font-size: 8px;
            color: #6b7280;
            text-align: right;
        }

        .empty {
            padding: 12px;
            text-align: center;
            font-style: italic;
            color: #6b7280;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>REKAP ABSENSI GURU</h1>
        <div class="subtitle">
            Periode {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM YYYY') }}
        </div>
    </div>

    <hr class="divider">

    <!-- Identitas Guru -->
    <table class="identity">
        <tr>
            <td class="label">Nama Guru</td>
            <td class="value">: {{ $guru->nama }}</td>
            <td class="label">NUPTK</td>
            <td class="value">: {{ $guru->nuptk ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">NBM</td>
            <td class="value">: {{ $guru->nbm ?? '-' }}</td>
            <td class="label">Jenis Kelamin</td>
            <td class="value">
                : {{ $guru->jenis_kelamin === 'L' ? 'Laki-laki' : ($guru->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}
            </td>
        </tr>
    </table>

    <!-- Tabel Absensi -->
    <table class="absensi">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="12%">Tanggal</th>
                <th width="12%">Hari</th>
                <th width="12%">Masuk</th>
                <th width="12%">Pulang</th>
                <th width="12%">Status</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absensi as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('dddd') }}</td>
                    <td>{{ $a->jam_masuk ?? '-' }}</td>
                    <td>{{ $a->jam_pulang ?? '-' }}</td>
                    <td>
                        <span class="badge {{ strtolower($a->status) }}">
                            {{ strtoupper($a->status) }}
                        </span>
                    </td>
                    <td class="left">{{ $a->lokasi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">Tidak ada data absensi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Ringkasan -->
    <table class="summary">
        <tr>
            <td class="label">Hadir</td>
            <td class="label">Izin</td>
            <td class="label">Sakit</td>
            <td class="label">Total Hari</td>
            <td class="label">Kehadiran</td>
        </tr>
        <tr>
            <td class="value">{{ $hadir }}</td>
            <td class="value">{{ $izin }}</td>
            <td class="value">{{ $sakit }}</td>
            <td class="value">{{ $jumlahHari }}</td>
            <td class="value">{{ $persenHadir }}%</td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="footer">
        Dicetak pada {{ \Carbon\Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY HH:mm') }} WIB
    </div>

</body>
</html>
