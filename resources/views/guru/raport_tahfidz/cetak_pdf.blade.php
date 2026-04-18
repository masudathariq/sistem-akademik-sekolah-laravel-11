<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Raport Tahfidz</title>
<style>
/* Margins 1,5cm = 15mm */
@page {
    margin: 15mm;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    font-family: 'DejaVu Sans', Arial, sans-serif;
    font-size: 10pt;
    color: #111;
    line-height: 1.4;
}
.page { width: 100%; padding: 0; margin: 0; }

/* Header */
.header { text-align:center; margin-bottom:10px; border-bottom:2px solid #1a5c38; padding-bottom:6px; }
.header h1 { font-size:14pt; font-weight:bold; text-transform:uppercase; margin-bottom:2px; }
.header p { font-size:8pt; color:#444; }

/* Info siswa */
.info-box { border:1px solid #bbb; padding:5px 10px; margin-bottom:8px; background:#f9f9f9; }
.info-box table { width:100%; border-collapse:collapse; font-size:9pt; }
.info-box td { padding:2px 4px; vertical-align:top; }

/* Section titles */
.section-title { font-weight:bold; font-size:10pt; margin:8px 0 4px 0; padding:2px 6px; background:#e8f5e9; border-left:4px solid #2e7d32; }

/* Main tables */
table.main { width:100%; border-collapse:collapse; margin-bottom:6px; font-size:9pt; }
table.main th, table.main td { border:1px solid #555; padding:3px 5px; vertical-align:middle; }
table.main th { background:#c8e6c9; font-weight:bold; font-size:8.5pt; text-align:center; }
table.main td { font-size:8.5pt; }
table.main tr.odd td { background:#f6f6f6; }
table.main tr.even td { background:#fff; }

/* Badges */
.badge { display:inline-block; padding:1px 4px; font-size:7.5pt; font-weight:bold; }
.badge-green{background:#28a745;color:#fff;}
.badge-yellow{background:#e6a817;color:#222;}
.badge-blue{background:#1a73e8;color:#fff;}
.badge-gray{background:#777;color:#fff;}
.star-f{color:#e6a817;}
.star-e{color:#ccc;}

/* Catatan guru */
.catatan-box { background:#f6fef8; border:1px solid #aaa; border-left:4px solid #2e7d32; padding:6px 10px; font-size:8.5pt; line-height:1.5; margin-bottom:10px; text-align:justify; }

/* Tanda tangan */
/* ================= TANDA TANGAN ================= */
.ttd-wrapper {
    width: 100%;
    margin-top: 30px;
    text-align: center;
}

.ttd-box {
    width: 40%;
    display: inline-block;
    vertical-align: top;
    font-size: 9pt;
}

.ttd-box.left {
    float: left;
}

.ttd-box.right {
    float: right;
}

.ttd-title {
    margin-bottom: 100px; /* ruang tanda tangan */
}

.ttd-name {
    padding-top: 4px;
    font-weight: bold;
}

.ttd-sub {
    font-size: 8pt;
    font-weight: normal;
}

.ttd-center {
    clear: both;
    text-align: center;
    margin-top: 50px;
    font-size: 9pt;
}

/* Print tweaks */
@media print {
    body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
}
</style>
</head>
<body>
<div class="page">

<!-- Header -->
<div class="header">
    <h1>Raport Tahfidz</h1>
    <h2>MTs Muhammadiyah 1 Natar</h2>
    <p>Laporan Perkembangan Hafalan Siswa</p>
</div>

<!-- Info Siswa -->
<div class="info-box">
    <table>
        <tr><td style="width:35%; font-weight:bold;">Nama Siswa</td><td style="width:3%;">:</td><td><strong>{{ $siswa->nama_siswa }}</strong></td></tr>
        <tr><td style="font-weight:bold;">Kelas / Rombel</td><td>:</td><td>{{ $siswa->rombel->tingkat ?? '-' }} / {{ $siswa->rombel->nama_rombel ?? '-' }}</td></tr>
        <tr><td style="font-weight:bold;">NIS</td><td>:</td><td>{{ $siswa->nis ?? '-' }}</td></tr>
    </table>
</div>

<!-- Penilaian Aspek -->
<div class="section-title">A. Penilaian Aspek Tahfidz</div>
<table class="main">
<thead>
<tr><th style="width:6%;">No</th><th style="text-align:left; width:40%;">Aspek Penilaian</th><th style="width:20%;">Nilai</th><th style="width:34%;">Keterangan</th></tr>
</thead>
<tbody>
@forelse($aspeks as $index=>$aspek)
@php $nilaiAngka = $nilai[$aspek->id] ?? 0; @endphp
<tr class="{{ $index%2==0?'even':'odd' }}">
<td style="text-align:center;">{{ $index+1 }}</td>
<td>{{ $aspek->nama_aspek }}</td>
<td style="text-align:center; font-size:10pt;">
@if($nilaiAngka>0)<span class="star-f">{{ str_repeat('★',$nilaiAngka) }}</span><span class="star-e">{{ str_repeat('★',4-$nilaiAngka) }}</span>@else<span style="color:#bbb; font-size:8pt; font-style:italic;">Belum dinilai</span>@endif
</td>
<td style="text-align:center; font-size:8.5pt;">{{ $keterangan[$aspek->id] ?? '-' }}</td>
</tr>
@empty
<tr><td colspan="4" style="text-align:center; color:#aaa; font-style:italic; padding:6px;">Belum ada aspek penilaian.</td></tr>
@endforelse
</tbody>
</table>

<!-- Ringkasan Hafalan -->
<div class="section-title">B. Ringkasan Hafalan</div>
<div class="info-box">
<table>
<tr><td style="width:35%; font-weight:bold;">Pencapaian Munaqosah</td><td style="width:3%;">:</td>
<td>{{ $pencapaian ?? 0 }}% <span class="badge {{ ($pencapaian ?? 0)>=75?'badge-green':'badge-yellow' }}" style="margin-left:4px;">{{ $status ?? 'Belum Dinilai' }}</span></td></tr>
<tr><td style="font-weight:bold;">Hafalan Terakhir</td><td>:</td>
<td>Surah <strong>{{ $hafalan->surah_terakhir ?? '-' }}</strong> Ayat <strong>{{ $hafalan->ayat_terakhir ?? '-' }}</strong></td></tr>
<tr><td style="font-weight:bold;">Target Hafalan Lanjutan</td><td>:</td>
<td>Surah <strong>{{ $hafalan->surah_lanjut ?? '-' }}</strong> Ayat <strong>{{ $hafalan->ayat_lanjut ?? '-' }}</strong></td></tr>
</table>
</div>

<!-- Nilai Ujian -->
<div class="section-title">C. Nilai Ujian Tahfidz</div>
<table class="main">
<thead>
<tr><th style="width:6%;">No</th><th style="text-align:left;">Nama Ujian</th><th style="width:22%;">Nilai Angka</th><th style="width:26%;">Keterangan</th></tr>
</thead>
<tbody>
@forelse($ujian as $index=>$u)
@php $ket = $u->keterangan ?? '-'; @endphp
<tr class="{{ $index%2==0?'even':'odd' }}">
<td style="text-align:center;">{{ $index+1 }}</td>
<td>{{ $u->nama_ujian }}</td>
<td style="text-align:center; font-weight:bold; font-size:10pt;">{{ $u->nilai_ujian }}</td>
<td style="text-align:center;">
<span class="badge {{ $ket==='Sangat Baik'?'badge-green':($ket==='Baik'?'badge-blue':($ket==='Cukup'?'badge-yellow':'badge-gray')) }}">{{ $ket }}</span>
</td>
</tr>
@empty
<tr><td colspan="4" style="text-align:center; color:#aaa; font-style:italic; padding:6px;">Belum ada nilai ujian.</td></tr>
@endforelse
</tbody>
</table>

<!-- Catatan Guru -->
<div class="section-title">D. Catatan Guru</div>
<div class="catatan-box">
@if($catatan)<p>{{ $catatan }}</p>@else<p style="color:#aaa; font-style:italic;">Tidak ada keterangan tambahan.</p>@endif
</div>

<!-- ================= TANDA TANGAN ================= -->
<div class="ttd-wrapper">

    <div class="ttd-box left">
        <div class="ttd-title">
            Mengetahui,<br>
            Orang Tua / Wali
        </div>
        <div class="ttd-name">
            ( ________________________ )
        </div>
    </div>

    <div class="ttd-box right">
        <div class="ttd-title">
            Guru Tahfidz
        </div>
        <div class="ttd-name">
            {{ $namaGuru }}<br>
            <span class="ttd-sub">NUPTK: {{ $nuptk }}</span>
        </div>
    </div>

</div>

<div class="ttd-center">
    Mengetahui,<br>
    Kepala Madrasah
    <div style="height:70px;"></div>
    <div class="ttd-name" style="display:inline-block; width:250px;">
        Imroatun Rofiqoh, S.Pd.
    </div>
</div>

</div>
</body>
</html>
