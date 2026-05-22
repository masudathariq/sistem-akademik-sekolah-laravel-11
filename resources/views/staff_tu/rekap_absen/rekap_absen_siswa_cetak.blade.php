<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>📄 Rekap Absensi Siswa - {{ $rombel->nama_lengkap ?? '-' }}</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            font-size: 14px;
            margin: 20px;
            color: #000;
        }

        /* HEADER SEKOLAH */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
            .header img.kop {
        width: 100%;
        max-height: 120px;
        object-fit: cover;
        margin-bottom: 10px;
    }
        .header h1 { margin: 0; font-size: 22px; font-weight: bold; }
        .header h2 { margin: 3px 0 0 0; font-size: 18px; font-weight: normal; }
        .header .info { margin-top: 5px; font-size: 13px; }

        /* CARD SUMMARY TERBANYAK */
        .card-summary {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        .card-summary .card {
            flex: 1 1 150px;
            background: #f3f3f3;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            font-size: 13px;
        }
        .card-summary .card h4 {
            margin: 0;
            font-size: 12px;
            color: #555;
        }
        .card-summary .card p {
            margin: 5px 0 0;
            font-weight: bold;
            color: #111;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px 4px; font-size: 13px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #e6f7ff; }
        td.left { text-align: left; }

        /* FOOTER */
        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        .footer .signature { text-align: center; }

        /* BUTTON CETAK */
        @media print {
            button { display: none; }
            body { margin: 0; }
        }








    </style>
</head>
<body>

<!-- HEADER -->
<!-- HEADER -->
<div class="header">
    {{-- KOP SURAT --}}
    <img src="{{ asset('images/kop.jpg') }}" alt="Kop Sekolah" class="kop" style="width:100%; max-height:120px; object-fit:cover; margin-bottom:10px;">

    <h1>📊 MTs Muhammadiyah 1 Natar</h1>
    <h2>Rekap Absensi Siswa</h2>
    <div class="info">
        <strong>Rombel:</strong> {{ $rombel->nama_lengkap ?? '-' }} |
        <strong>Tingkat:</strong> {{ $rombel->tingkat_romawi ?? '-' }} |
        <strong>Jumlah Siswa:</strong> {{ $rekap->count() }} |
        <strong>Bulan:</strong> {{ \Carbon\Carbon::parse($bulan.'-01')->isoFormat('MMMM YYYY') }}
    </div>
</div>



    <!-- CARD SUMMARY TERBANYAK -->
    <div class="card-summary">
        @php
            $maxHadir = $rekap->max('hadir');
            $maxIzin = $rekap->max('izin');
            $maxSakit = $rekap->max('sakit');
            $maxAlpha = $rekap->max('alpha');
            $maxBolos = $rekap->max('bolos');

            $namaHadir = $rekap->filter(fn($r) => $r->hadir == $maxHadir)->pluck('siswa.nama_siswa')->join(', ');
            $namaIzin = $rekap->filter(fn($r) => $r->izin == $maxIzin)->pluck('siswa.nama_siswa')->join(', ');
            $namaSakit = $rekap->filter(fn($r) => $r->sakit == $maxSakit)->pluck('siswa.nama_siswa')->join(', ');
            $namaAlpha = $rekap->filter(fn($r) => $r->alpha == $maxAlpha)->pluck('siswa.nama_siswa')->join(', ');
            $namaBolos = $rekap->filter(fn($r) => $r->bolos == $maxBolos)->pluck('siswa.nama_siswa')->join(', ');

            $jumlahHari = \Carbon\Carbon::parse($bulan.'-01')->daysInMonth;
        @endphp

        <div class="card">
            <h4>Hadir Terbanyak</h4>
            <p>{{ $namaHadir ?: '-' }} ({{ $maxHadir }})</p>
        </div>
        <div class="card">
            <h4>Izin Terbanyak</h4>
            <p>{{ $namaIzin ?: '-' }} ({{ $maxIzin }})</p>
        </div>
        <div class="card">
            <h4>Sakit Terbanyak</h4>
            <p>{{ $namaSakit ?: '-' }} ({{ $maxSakit }})</p>
        </div>
        <div class="card">
            <h4>Alpha Terbanyak</h4>
            <p>{{ $namaAlpha ?: '-' }} ({{ $maxAlpha }})</p>
        </div>
        <div class="card">
            <h4>Bolos Terbanyak</h4>
            <p>{{ $namaBolos ?: '-' }} ({{ $maxBolos }})</p>
        </div>
    </div>

    <!-- TABLE REKAP -->
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
                <th>% Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="left">{{ $row->siswa->nama_siswa }}</td>
                <td>{{ $row->hadir }}</td>
                <td>{{ $row->izin }}</td>
                <td>{{ $row->sakit }}</td>
                <td>{{ $row->alpha }}</td>
                <td>{{ $row->bolos }}</td>
                <td>
                    {{ $jumlahHari ? round(($row->hadir / $jumlahHari) * 100, 2) : 0 }}%
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Tidak ada data siswa</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <div>
            <p>Tanggal Cetak: {{ now()->isoFormat('D MMMM YYYY') }}</p>
        </div>
        <div class="signature">
            <p>Staff TU</p>
            <br><br>
            <p>______________________</p>
        </div>
    </div>

    <!-- BUTTON CETAK -->
    <div style="text-align:center; margin-top:20px;">
        <button onclick="window.print()" style="padding:10px 20px; background:#4CAF50; color:#fff; border:none; border-radius:5px; cursor:pointer;">
            🖨️ Cetak
        </button>
    </div>

</body>
</html>
