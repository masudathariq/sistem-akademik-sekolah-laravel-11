<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Siswa {{ $rombel->nama_lengkap }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }

        .container {
            padding: 20px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #2563EB;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            color: #1F2937;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 16px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 3px;
        }

        .header p {
            font-size: 10px;
            color: #6B7280;
        }

        /* Info Box */
        .info-box {
            background: #F3F4F6;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            border-left: 4px solid #2563EB;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            display: table-cell;
            width: 140px;
            font-weight: bold;
            color: #374151;
        }

        .info-value {
            display: table-cell;
            color: #1F2937;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background: #2563EB;
            color: white;
        }

        thead th {
            padding: 10px 8px;
            font-weight: bold;
            text-align: center;
            border: 1px solid #1E40AF;
            font-size: 10px;
        }

        tbody td {
            padding: 8px 6px;
            border: 1px solid #D1D5DB;
            font-size: 10px;
        }

        tbody tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        tbody tr:nth-child(odd) {
            background-color: #FFFFFF;
        }

        /* Column Alignment */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            width: 50%;
            font-size: 9px;
            color: #6B7280;
            vertical-align: bottom;
        }

        .footer-right {
            display: table-cell;
            width: 50%;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 200px;
        }

        .signature-label {
            font-size: 10px;
            margin-bottom: 60px;
        }

        .signature-name {
            font-size: 10px;
            font-weight: bold;
            border-top: 1px solid #333;
            padding-top: 5px;
            display: inline-block;
            min-width: 180px;
        }

        /* Summary */
        .summary {
            background: #DBEAFE;
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
            color: #1E40AF;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <h1>MTs Muhammadiyah 1 Natar</h1>
            <h2>Daftar Siswa</h2>
            <p>Dokumen dicetak pada: {{ $tanggalCetak }}</p>
        </div>

        <!-- INFO BOX -->
        <div class="info-box">
            <div class="info-row">
                <div class="info-label">Rombel</div>
                <div class="info-value">: {{ $rombel->nama_lengkap }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Wali Kelas</div>
                <div class="info-value">: {{ $walikelas ? $walikelas->nama : '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tahun Ajaran</div>
                <div class="info-value">: {{ $tahunAjaran->tahun_ajaran }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jumlah Siswa</div>
                <div class="info-value">: {{ $siswas->count() }} siswa</div>
            </div>
        </div>

        <!-- TABLE -->
        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th style="width: 90px;">NISN</th>
                    <th style="width: 70px;">NIS</th>
                    <th style="width: 150px;">Nama Siswa</th>
                    <th style="width: 60px;">JK</th>
                    <th style="width: 100px;">Tempat Lahir</th>
                    <th style="width: 80px;">Tgl Lahir</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $index => $siswa)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $siswa->nisn }}</td>
                    <td class="text-center">{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td class="text-center">{{ $siswa->jenis_kelamin == 'L' ? 'L' : 'P' }}</td>
                    <td>{{ $siswa->tempat_lahir }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $siswa->alamat }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data siswa</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- SUMMARY -->
        <div class="summary">
            Total: {{ $siswas->count() }} Siswa
            (Laki-laki: {{ $siswas->where('jenis_kelamin', 'L')->count() }} | 
            Perempuan: {{ $siswas->where('jenis_kelamin', 'P')->count() }})
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <div class="footer-left">
                <p>Dicetak oleh sistem pada {{ now()->format('d/m/Y H:i') }} WIB</p>
            </div>
            <div class="footer-right">
                <div class="signature-box">
                    <div class="signature-label">
                        Natar, {{ now()->format('d F Y') }}<br>
                        Wali Kelas
                    </div>
                    <div class="signature-name">
                        {{ $walikelas ? $walikelas->nama : '_______________' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>