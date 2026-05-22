<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #1f2937; margin: 0; padding: 0; }
        .header { margin-bottom: 16px; }
        .header h2 { margin: 0; font-size: 18px; }
        .header p { margin: 4px 0 0; font-size: 12px; color: #4b5563; }
        .info { margin-bottom: 12px; font-size: 12px; }
        .info span { display: inline-block; margin-right: 18px; }
        table { width: 100%; border-collapse: collapse; font-size: 10px; }
        th, td { border: 1px solid #d1d5db; padding: 6px 8px; vertical-align: top; }
        thead th { background: #1e40af; color: #fff; text-align: left; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        .small { font-size: 9px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Data Siswa</h2>
        <p class="small">Filter: {{ $filterLabel }} | Tanggal cetak: {{ $tanggalCetak }}</p>
    </div>

    <div class="info">
        <span><strong>Total:</strong> {{ $siswas->count() }}</span>
        <span><strong>Filter:</strong> {{ $filterLabel }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>JK</th>
                <th>Tingkat</th>
                <th>Kode Rombel</th>
                <th>Nama Rombel</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Ayah</th>
                <th>Ibu</th>
                <th>Wali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $index => $siswa)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>{{ $siswa->jenis_kelamin }}</td>
                <td>{{ $siswa->rombelAktif?->tingkat_romawi ?? '-' }}</td>
                <td>{{ $siswa->rombelAktif?->kode_rombel ?? '-' }}</td>
                <td>{{ $siswa->rombelAktif?->nama_rombel ?? '-' }}</td>
                <td>{{ $siswa->tempat_lahir }}</td>
                <td>{{ $siswa->tanggal_lahir }}</td>
                <td>{{ $siswa->alamat }}</td>
                <td>{{ $siswa->ayah }}</td>
                <td>{{ $siswa->ibu }}</td>
                <td>{{ $siswa->wali }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
