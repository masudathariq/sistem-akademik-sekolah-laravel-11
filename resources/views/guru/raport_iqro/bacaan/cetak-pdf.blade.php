<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bacaan Iqro</title>
    <style>
        @page { margin: 15mm; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 10pt; color: #111; margin: 0; }
        .header { text-align: center; margin-bottom: 18px; }
        .header h1 { font-size: 16pt; margin-bottom: 4px; }
        .header p { font-size: 10pt; color: #555; }
        table { width: 100%; border-collapse: collapse; font-size: 9.5pt; }
        table th, table td { border: 1px solid #333; padding: 8px 10px; }
        table th { background: #d1fae5; color: #0f5132; text-align: left; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        .footer { margin-top: 24px; font-size: 9pt; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Daftar Bacaan Iqro Siswa</h1>
        <p>Ringkasan perkembangan bacaan Iqro siswa yang dikelola.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Siswa</th>
                <th style="width: 17%;">Iqro Terakhir</th>
                <th style="width: 17%;">Halaman Terakhir</th>
                <th style="width: 18%;">Iqro Target</th>
                <th style="width: 18%;">Halaman Target</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswas as $index => $siswa)
                @php $bacaanSiswa = $bacaan[$siswa->id] ?? null; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $bacaanSiswa->iqro_terakhir ?? '-' }}</td>
                    <td>{{ $bacaanSiswa->halaman_terakhir ?? '-' }}</td>
                    <td>{{ $bacaanSiswa->iqro_lanjut ?? '-' }}</td>
                    <td>{{ $bacaanSiswa->halaman_lanjut ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding: 18px; color: #555;">Belum ada data bacaan Iqro.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->translatedFormat('d F Y') }}</p>
    </div>
</body>
</html>