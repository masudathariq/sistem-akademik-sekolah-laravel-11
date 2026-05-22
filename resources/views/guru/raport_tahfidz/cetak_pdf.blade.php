<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Raport Tahfidz</title>
<style>
    @page {
        margin: 15mm;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'DejaVu Sans', Arial, sans-serif;
        font-size: 9pt;
        color: #1f2937;
        line-height: 1.35;
        background: #fff;
    }

    .page {
        width: auto;
        max-width: calc(210mm - 30mm);
        margin: 0 auto;
    }

    /* ================= HEADER ================= */

    .header {
        border-bottom: 2px solid #166534;
        padding-bottom: 8px;
        margin-bottom: 10px;
        text-align: center;
    }

    .header h1 {
        font-size: 16pt;
        font-weight: bold;
        color: #166534;
        text-transform: uppercase;
        margin-bottom: 1px;
        letter-spacing: 1px;
    }

    .header h2 {
        font-size: 11pt;
        font-weight: bold;
        color: #111827;
        margin-bottom: 2px;
    }

    .header p {
        font-size: 7.5pt;
        color: #6b7280;
    }

    /* ================= CARD INFO ================= */

    .info-box {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 8px 10px;
        margin-bottom: 10px;
        background: #f9fafb;
    }

    .info-box table {
        width: 100%;
        border-collapse: collapse;
    }

    .info-box td {
        padding: 2px 4px;
        font-size: 8.3pt;
        vertical-align: top;
    }

    /* ================= SECTION ================= */

    .section-title {
        font-size: 8.7pt;
        font-weight: bold;
        color: #fff;
        background: #166534;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 10px 0 5px 0;
        letter-spacing: .3px;
    }

    /* ================= TABLE ================= */

    table.main {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 6px;
        font-size: 7.8pt;
        border-radius: 6px;
        overflow: hidden;
    }

    table.main th {
        background: #dcfce7;
        color: #14532d;
        border: 1px solid #cbd5e1;
        padding: 5px 4px;
        font-size: 7.8pt;
        font-weight: bold;
        text-align: center;
    }

    table.main td {
        border: 1px solid #d1d5db;
        padding: 4px 4px;
        vertical-align: middle;
    }

    table.main tr:nth-child(even) {
        background: #f9fafb;
    }

    /* ================= BADGE ================= */

    .badge {
        display: inline-block;
        padding: 2px 6px;
        border-radius: 20px;
        font-size: 6.8pt;
        font-weight: bold;
    }

    .badge-green {
        background: #dcfce7;
        color: #166534;
    }

    .badge-yellow {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-blue {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .badge-gray {
        background: #e5e7eb;
        color: #374151;
    }

    /* ================= STAR ================= */

    .star-f {
        color: #f59e0b;
        font-size: 8.5pt;
    }

    .star-e {
        color: #d1d5db;
        font-size: 8.5pt;
    }

    /* ================= CATATAN ================= */

    .catatan-box {
        background: #f0fdf4;
        border: 1px solid #d1fae5;
        border-left: 4px solid #166534;
        padding: 8px 10px;
        font-size: 7.8pt;
        line-height: 1.45;
        border-radius: 6px;
        text-align: justify;
    }

    /* ================= TANDA TANGAN ================= */

    .ttd-wrapper {
        width: 100%;
        margin-top: 18px;
    }

    .ttd-wrapper table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    .ttd-wrapper td {
        width: 33%;
        vertical-align: top;
        font-size: 8pt;
    }

    .ttd-space {
        height: 55px;
    }

    .ttd-name {
        padding-top: 2px;
        font-weight: bold;
        font-size: 8pt;
        line-height: 1.4;
    }

    .ttd-sub {
        font-size: 7pt;
        color: #6b7280;
        font-weight: normal;
    }

    /* ================= PDF OPTIMIZATION ================= */

    table,
    tr,
    td,
    th,
    .info-box,
    .catatan-box,
    .section-title,
    .ttd-wrapper {
        page-break-inside: avoid;
    }

    /* ================= PRINT ================= */

    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>
</head>


<body>
    
@php
    $path = public_path('images/kop.jpg');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp

<div style="width:100%; text-align:center; margin-bottom:10px;">
    <img src="{{ $base64 }}"
         style="width:90%; display:inline-block;">
</div>


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
                <tr>
                    <td style="width:35%; font-weight:bold;">Nama Siswa</td>
                    <td style="width:3%;">:</td>
                    <td><strong>{{ $siswa->nama_siswa }}</strong></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">Kelas / Rombel</td>
                    <td>:</td>
                    <td>{{ $siswa->rombel->tingkat_romawi ?? '-' }} / {{ $siswa->rombel->nama_rombel ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">NIS</td>
                    <td>:</td>
                    <td>{{ $siswa->nis ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <!-- Penilaian Aspek -->
        <div class="section-title">A. Penilaian Aspek Tahfidz</div>
        <table class="main">
            <thead>
                <tr>
                    <th style="width:6%;">No</th>
                    <th style="text-align:left; width:40%;">Aspek Penilaian</th>
                    <th style="width:20%;">Nilai</th>
                    <th style="width:34%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspeks as $index=>$aspek)
                    @php $nilaiAngka = $nilai[$aspek->id] ?? 0; @endphp
                    <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                        <td style="text-align:center;">{{ $index + 1 }}</td>
                        <td>{{ $aspek->nama_aspek }}</td>
                        <td style="text-align:center; font-size:10pt;">
                            @if ($nilaiAngka > 0)
                                <span class="star-f">{{ str_repeat('★', $nilaiAngka) }}</span><span
                                class="star-e">{{ str_repeat('★', 4 - $nilaiAngka) }}</span>@else<span
                                    style="color:#bbb; font-size:8pt; font-style:italic;">Belum dinilai</span>
                            @endif
                        </td>
                        <td style="text-align:center; font-size:8.5pt;">{{ $keterangan[$aspek->id] ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#aaa; font-style:italic; padding:6px;">Belum
                            ada aspek penilaian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Ringkasan Hafalan -->
        <div class="section-title">B. Ringkasan Hafalan</div>
        <div class="info-box">
            <table>
                <tr>
                    <td style="width:35%; font-weight:bold;">Pencapaian Munaqosah</td>
                    <td style="width:3%;">:</td>
                    <td>{{ $pencapaian ?? 0 }}% <span
                            class="badge {{ ($pencapaian ?? 0) >= 75 ? 'badge-green' : 'badge-yellow' }}"
                            style="margin-left:4px;">{{ $status ?? 'Belum Dinilai' }}</span></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">Hafalan Terakhir</td>
                    <td>:</td>
                    <td>Surah <strong>{{ $hafalan->surah_terakhir ?? '-' }}</strong> Ayat
                        <strong>{{ $hafalan->ayat_terakhir ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">Target Hafalan Lanjutan</td>
                    <td>:</td>
                    <td>Surah <strong>{{ $hafalan->surah_lanjut ?? '-' }}</strong> Ayat
                        <strong>{{ $hafalan->ayat_lanjut ?? '-' }}</strong></td>
                </tr>
            </table>
        </div>

        <!-- Nilai Ujian -->
        <div class="section-title">C. Nilai Ujian Tahfidz</div>
        <table class="main">
            <thead>
                <tr>
                    <th style="width:6%;">No</th>
                    <th style="text-align:left;">Nama Ujian</th>
                    <th style="width:22%;">Nilai Angka</th>
                    <th style="width:26%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ujian as $index=>$u)
                    @php $ket = $u->keterangan ?? '-'; @endphp
                    <tr class="{{ $index % 2 == 0 ? 'even' : 'odd' }}">
                        <td style="text-align:center;">{{ $index + 1 }}</td>
                        <td>{{ $u->nama_ujian }}</td>
                        <td style="text-align:center; font-weight:bold; font-size:10pt;">{{ $u->nilai_ujian }}</td>
                        <td style="text-align:center;">
                            <span
                                class="badge {{ $ket === 'Sangat Baik' ? 'badge-green' : ($ket === 'Baik' ? 'badge-blue' : ($ket === 'Cukup' ? 'badge-yellow' : 'badge-gray')) }}">{{ $ket }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#aaa; font-style:italic; padding:6px;">Belum
                            ada nilai ujian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Catatan Guru -->
        <div class="section-title">D. Catatan Guru</div>
        <div class="catatan-box">
            @if ($catatan)
            <p>{{ $catatan }}</p>@else<p style="color:#aaa; font-style:italic;">Tidak ada keterangan tambahan.
                </p>
            @endif
        </div>

        <!-- ================= TANDA TANGAN ================= -->
        <!-- ================= TANDA TANGAN ================= -->
        <div class="ttd-wrapper">

            <table style="width:100%; border-collapse:collapse; text-align:center;">

                <tr>

                    <!-- Orang Tua -->
                    <td style="width:33%; vertical-align:top; font-size:9pt;">

                        Mengetahui,<br>
                        Orang Tua / Wali

                        <div style="height:90px;"></div>

                        <div class="ttd-name">
                            ( ________________________ )
                        </div>

                    </td>

                    <!-- Guru Tahfidz -->
                    <td style="width:33%; vertical-align:top; font-size:9pt;">

                        Guru Tahfidz

                        <div style="height:90px;"></div>
                        <br>

                        <div class="ttd-name">
                            {{ $namaGuru }}<br>
                            <span class="ttd-sub">
                                NUPTK: {{ $nuptk }}
                            </span>
                        </div>

                    </td>

                    <!-- Kepala Madrasah -->
                    <td style="width:33%; vertical-align:top; font-size:9pt;">

                        Mengetahui,<br>
                        Kepala Madrasah

                        <div style="height:90px;"></div>

                        <div class="ttd-name">
                            Imroatun Rofiqoh, S.Pd.<br>

                            <span class="ttd-sub">
                                NUPTK: 1234567890123456
                            </span>
                        </div>

                    </td>

                </tr>

            </table>

        </div>

    </div>
</body>

</html>
