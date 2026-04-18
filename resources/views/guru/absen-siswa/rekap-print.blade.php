<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Absensi Siswa</title>
    <style>
        body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; padding: 20px; color: #333; background: #f9f9f9; }
        h2 { margin: 0 0 5px 0; font-size: 22px; }
        p { margin: 2px 0 6px 0; font-size: 14px; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 10px; margin-bottom: 15px; }
        .info-card { background: #fff; padding: 10px 12px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); text-align: center; }
        .info-card p { margin: 0; font-size: 12px; color: #555; }
        .info-card span { font-weight: bold; font-size: 16px; display: block; margin-top: 3px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 5px rgba(0,0,0,0.1); }
        th, td { padding: 10px 8px; font-size: 13px; text-align: center; }
        th { background: #4CAF50; color: #fff; text-transform: uppercase; font-size: 12px; }
        td.status-h { color: #2d7a2d; font-weight: bold; }
        td.status-i { color: #1d4ed8; font-weight: bold; }
        td.status-s { color: #f59e0b; font-weight: bold; }
        td.status-a { color: #dc2626; font-weight: bold; }
        td.status-b { color: #7c3aed; font-weight: bold; }
        tr.total-row { background: #f3f4f6; font-weight: bold; }
        @media print {
            body { background: #fff; }
            .info-grid { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <h2>Rekap Absensi Siswa</h2>
    <p>Periode: {{ \Carbon\Carbon::parse($bulan)->translatedFormat('F Y') }}</p>
    @if(request('rombel_id'))
        <p>Kelas: {{ $rombels->find(request('rombel_id'))->nama_lengkap ?? '-' }}</p>
    @endif

    @php
        $totalHari = $rekap->sum(fn($row) => $row->hadir + $row->izin + $row->sakit + $row->alpha + $row->bolos);
        $totalSiswa = $rekap->count();
        $grandHadir = $rekap->sum('hadir');
        $grandIzin = $rekap->sum('izin');
        $grandSakit = $rekap->sum('sakit');
        $grandAlpha = $rekap->sum('alpha');
        $grandBolos = $rekap->sum('bolos');
    @endphp

    <!-- Summary Cards -->
    <div class="info-grid">
        <div class="info-card">
            <p>Total Siswa</p>
            <span>{{ $totalSiswa }}</span>
        </div>
        <div class="info-card">
            <p>Total Hari</p>
            <span>{{ $totalHari }}</span>
        </div>
        <div class="info-card" style="color:#2d7a2d;">
            <p>Hadir</p>
            <span>{{ $grandHadir }} ({{ $totalHari ? round($grandHadir/$totalHari*100,2) : 0 }}%)</span>
        </div>
        <div class="info-card" style="color:#1d4ed8;">
            <p>Izin</p>
            <span>{{ $grandIzin }} ({{ $totalHari ? round($grandIzin/$totalHari*100,2) : 0 }}%)</span>
        </div>
        <div class="info-card" style="color:#f59e0b;">
            <p>Sakit</p>
            <span>{{ $grandSakit }} ({{ $totalHari ? round($grandSakit/$totalHari*100,2) : 0 }}%)</span>
        </div>
        <div class="info-card" style="color:#dc2626;">
            <p>Alpha</p>
            <span>{{ $grandAlpha }} ({{ $totalHari ? round($grandAlpha/$totalHari*100,2) : 0 }}%)</span>
        </div>
        <div class="info-card" style="color:#7c3aed;">
            <p>Bolos</p>
            <span>{{ $grandBolos }} ({{ $totalHari ? round($grandBolos/$totalHari*100,2) : 0 }}%)</span>
        </div>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpha</th>
                <th>Bolos</th>
                <th>% Hadir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekap as $row)
                @php
                    $totalAbsensi = $row->hadir + $row->izin + $row->sakit + $row->alpha + $row->bolos;
                    $presentase = $totalAbsensi ? round($row->hadir / $totalAbsensi * 100, 2) : 0;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left;">{{ $row->siswa->nama_siswa }}</td>
                    <td class="status-h">{{ $row->hadir }}</td>
                    <td class="status-i">{{ $row->izin }}</td>
                    <td class="status-s">{{ $row->sakit }}</td>
                    <td class="status-a">{{ $row->alpha }}</td>
                    <td class="status-b">{{ $row->bolos }}</td>
                    <td>{{ $presentase }}%</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="2">Total</td>
                <td class="status-h">{{ $grandHadir }}</td>
                <td class="status-i">{{ $grandIzin }}</td>
                <td class="status-s">{{ $grandSakit }}</td>
                <td class="status-a">{{ $grandAlpha }}</td>
                <td class="status-b">{{ $grandBolos }}</td>
                <td>{{ $totalHari ? round($grandHadir/$totalHari*100,2) : 0 }}%</td>
            </tr>
        </tbody>
    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
