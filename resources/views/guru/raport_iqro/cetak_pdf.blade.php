<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport Iqro - {{ $siswa->nama_siswa ?? 'Siswa' }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 14mm 18mm;
        }

        body {
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
            color: #111;
            background-color: #fff;
        }

        .page {
            width: 100%;
            min-height: 297mm;
            padding: 0;
            box-sizing: border-box;
        }

        h1, h2, h3, h4, h5 { margin: 0; }

        .header {
            text-align: center;
            margin-bottom: 12px;
        }
        .header h1 {
            font-size: 16pt;
            letter-spacing: 0.4px;
        }
        .header p {
            font-size: 10pt;
            color: #444;
            margin-top: 6px;
        }

        .table-border {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
        }
        .table-border th,
        .table-border td {
            border: 1px solid #333;
            padding: 6px 8px;
        }
        .table-border thead tr {
            background-color: #c8e6c9;
        }
        .table-border td.no-border {
            border: none;
            padding: 4px 4px;
        }
        .table-border .text-center { text-align: center; }
        .table-border .text-left { text-align: left; }

        .info-table { margin-bottom: 12px; }
        .info-table td { border: none; padding: 4px 6px; font-size: 10pt; }

        .note-box {
            border: 1px solid #bbb;
            background-color: #f0fdf4;
            padding: 10px 12px;
            font-size: 10pt;
            line-height: 1.6;
            margin-bottom: 14px;
            text-align: justify;
        }

        .signature {
            display: table;
            width: 100%;
            margin-top: 22px;
            font-size: 10pt;
        }
        .signature .cell {
            display: table-cell;
            width: 33%;
            vertical-align: top;
            text-align: center;
            padding-top: 10px;
        }
        .signature .space { height: 85px; }
        .signature .name { font-weight: bold; }
        .signature .sub { font-size: 9pt; color: #444; }

        .label {
            font-size: 9.5pt;
            font-weight: bold;
            margin-bottom: 4px;
            color: #222;
        }

        .rating-stars { font-size: 12pt; color: #c47f0b; }
        .rating-muted { color: #bbb; }

        .note-label {
            display: inline-block;
            font-size: 9pt;
            color: #555;
            margin-bottom: 10px;
        }

        .striped:nth-child(odd) { background-color: #f9f9f9; }
        .striped:nth-child(even) { background-color: #fff; }
    </style>
</head>
<body>
<div class="page">
    <div class="header">
        <h1>RAPORT IQRO</h1>
        <p>Laporan Perkembangan Bacaan Iqro Siswa</p>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Nama Siswa</strong></td>
            <td>:</td>
            <td>{{ $siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <td><strong>Kelas / Rombel</strong></td>
            <td>:</td>
            <td>{{ $siswa->rombel->tingkat_romawi ?? '-' }} / {{ $siswa->rombel->nama_rombel ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>NIS</strong></td>
            <td>:</td>
            <td>{{ $siswa->nis ?? '-' }}</td>
        </tr>
    </table>

    <div class="note-label">Keterangan:</div>
    <div class="note-box" style="margin-bottom: 18px;">
        ★ = Belum baik &nbsp;&nbsp; ★★ = Cukup baik &nbsp;&nbsp; ★★★ = Baik &nbsp;&nbsp; ★★★★ = Sangat baik
    </div>

    <div class="label">A. Penilaian Aspek Iqro</div>
    <table class="table-border" style="margin-bottom: 16px;">
        <thead>
            <tr>
                <th class="text-center" style="width: 8%;">No</th>
                <th class="text-left">Aspek Penilaian</th>
                <th class="text-center" style="width: 24%;">Nilai</th>
                <th class="text-center" style="width: 28%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aspeks as $index => $aspek)
            @php $nilaiAngka = $nilai[$aspek->id] ?? 0; @endphp
            <tr class="striped">
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $aspek->nama_aspek }}</td>
                <td class="text-center">
                    @if($nilaiAngka > 0)
                        <span class="rating-stars">{!! str_repeat('★', $nilaiAngka) !!}</span><span class="rating-muted">{!! str_repeat('★', 4 - $nilaiAngka) !!}</span>
                    @else
                        <span style="color:#777; font-style:italic;">Belum dinilai</span>
                    @endif
                </td>
                <td class="text-center">{{ $keterangan[$aspek->id] ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center" style="padding:14px 6px; color:#777;">Belum ada aspek penilaian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="label">B. Ringkasan Bacaan</div>
    <table class="table-border" style="margin-bottom: 16px;">
        <tbody>
            <tr>
                <td class="text-left" style="width: 35%;"><strong>Pencapaian Bacaan</strong></td>
                <td class="text-left" style="width: 3%;">:</td>
                <td>{{ $pencapaian ?? 0 }}% &nbsp; <strong>{{ $status ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td class="text-left"><strong>Iqro Terakhir</strong></td>
                <td>:</td>
                <td>Iqro <strong>{{ $bacaan->iqro_terakhir ?? '-' }}</strong> / Halaman <strong>{{ $bacaan->halaman_terakhir ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td class="text-left"><strong>Target Lanjutan</strong></td>
                <td>:</td>
                <td>Iqro <strong>{{ $bacaan->iqro_lanjut ?? '-' }}</strong> / Halaman <strong>{{ $bacaan->halaman_lanjut ?? '-' }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="label">C. Nilai Ujian Iqro</div>
    <table class="table-border" style="margin-bottom: 16px;">
        <thead>
            <tr>
                <th class="text-center" style="width: 8%;">No</th>
                <th class="text-left">Nama Ujian</th>
                <th class="text-center" style="width: 24%;">Nilai</th>
                <th class="text-center" style="width: 28%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ujian as $index => $u)
            <tr class="striped">
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $u->nama_ujian }}</td>
                <td class="text-center">{{ $u->nilai_ujian }}</td>
                <td class="text-center">{{ $u->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center" style="padding:14px 6px; color:#777;">Belum ada nilai ujian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="label">D. Catatan Guru</div>
    <div class="note-box">
        @if($catatan)
            {{ $catatan }}
        @else
            <span style="color:#777;">Tidak ada keterangan tambahan.</span>
        @endif
    </div>

    <div class="signature">
        <div class="cell">
            Orang Tua / Wali
            <div class="space"></div>
            <div class="name">( __________________________ )</div>
        </div>
        <div class="cell">
            Guru Iqro
            <div class="space"></div>
            <div class="name">{{ $namaGuru }}</div>
            <div class="sub">NUPTK: {{ $nuptk }}</div>
        </div>
        <div class="cell">
            Kepala Madrasah
            <div class="space"></div>
            <div class="name">Imroatun Rofiqoh, S.Pd.</div>
            <div class="sub">NUPTK: 1234567890123456</div>
        </div>
    </div>
</div>
</body>
</html>
