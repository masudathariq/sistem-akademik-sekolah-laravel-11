@extends('layouts.guru')

@section('content')

<style>
    /* ===== SCREEN PREVIEW ===== */
    body { background: #e5e7eb; }

    .a4-wrapper {
        width: 210mm;
        min-height: 297mm;
        margin: 20px auto;
        padding: 18mm 20mm;
        background: white;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        font-size: 11pt;
        font-family: 'Times New Roman', Times, serif;
        line-height: 1.5;
        box-sizing: border-box;
        color: #111;
    }

    .a4-wrapper table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10pt;
    }
    .a4-wrapper th, .a4-wrapper td {
        border: 1px solid #333;
        padding: 5px 7px;
    }
    .a4-wrapper thead th {
        background-color: #c8e6c9 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        font-weight: bold;
        text-align: center;
    }

    .section-title {
        font-weight: bold;
        font-size: 11.5pt;
        margin: 12px 0 5px 0;
    }

    .badge {
        display: inline-block;
        padding: 1px 7px;
        border-radius: 3px;
        font-size: 8.5pt;
        font-weight: bold;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .badge-green  { background-color: #28a745; color: #fff; }
    .badge-yellow { background-color: #ffc107; color: #333; }
    .badge-blue   { background-color: #007bff; color: #fff; }
    .badge-gray   { background-color: #6c757d; color: #fff; }

    .star-filled { color: #f59e0b; }
    .star-empty  { color: #ddd; }

    .info-table td { border: none !important; padding: 3px 4px; font-size: 10.5pt; }

    .catatan-box {
        border: 1px solid #aaa;
        background-color: #f0fdf4;
        padding: 10px 14px;
        text-align: justify;
        font-size: 10pt;
        line-height: 1.75;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        margin-bottom: 14px;
    }
    .catatan-box p { margin: 0 0 7px 0; }

    .ttd-wrapper {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        font-size: 10.5pt;
    }
    .ttd-box { text-align: center; width: 44%; }
    .ttd-space { height: 54px; }
    .ttd-line { border-top: 1px solid #333; padding-top: 4px; }

    .row-even { background-color: #fff; }
    .row-odd  { background-color: #f9f9f9; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    .keterangan-bintang {
        font-size: 9pt;
        color: #444;
        margin-bottom: 8px;
        padding: 5px 8px;
        background: #fffde7;
        border-left: 3px solid #f59e0b;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    /* ===== TOOLBAR (tidak ikut cetak) ===== */
    .toolbar {
        width: 210mm;
        margin: 0 auto 12px auto;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .toolbar a, .toolbar button {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 16px;
        border-radius: 7px;
        font-size: 13px;
        font-family: sans-serif;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-weight: 500;
    }
    .btn-back    { background: #f3f4f6; color: #374151; }
    .btn-back:hover    { background: #e5e7eb; }
    .btn-print   { background: #2563eb; color: #fff; }
    .btn-print:hover   { background: #1d4ed8; }
    .btn-pdf     { background: #16a34a; color: #fff; }
    .btn-pdf:hover     { background: #15803d; }

    /* ===== PRINT ===== */
    @media print {
        @page {
            size: A4 portrait;
            margin: 14mm 18mm;
        }

        body { background: white !important; }

        .toolbar, .no-print { display: none !important; }

        .a4-wrapper {
            width: 100%;
            min-height: auto;
            margin: 0;
            padding: 0;
            box-shadow: none;
        }

        .a4-wrapper thead th      { background-color: #c8e6c9 !important; }
        .catatan-box               { background-color: #f0fdf4 !important; }
        .keterangan-bintang        { background-color: #fffde7 !important; }
        .row-odd                   { background-color: #f9f9f9 !important; }
        .badge-green  { background-color: #28a745 !important; color: #fff !important; }
        .badge-yellow { background-color: #ffc107 !important; color: #333 !important; }
        .badge-blue   { background-color: #007bff !important; color: #fff !important; }
        .badge-gray   { background-color: #6c757d !important; color: #fff !important; }
    }
</style>

{{-- Toolbar --}}
<div class="toolbar no-print" style="padding-top:16px;">
    <a href="{{ route('guru.raport-tahfidz.show', $siswa->id) }}" class="btn-back">← Kembali</a>
    <button onclick="window.print()" class="btn-print">🖨️ Cetak (Browser)</button>
    <a href="{{ route('guru.raport_tahfidz.download_pdf', $siswa->id) }}" class="btn-pdf">⬇️ Download PDF</a>
</div>

{{-- Area A4 --}}
<div id="print-area">
<div class="a4-wrapper">

    {{-- Header --}}
    <div style="text-align:center; margin-bottom:12px;">
        <div style="font-size:16pt; font-weight:bold; letter-spacing:0.5px;">RAPORT TAHFIDZ AL-QUR'AN</div>
        <div style="font-size:9.5pt; color:#555; margin-top:2px;">Laporan Perkembangan Hafalan Siswa</div>
        <hr style="border:none; border-top:2px solid #2d6a4f; margin-top:8px;">
    </div>

    {{-- Info Siswa --}}
    <table class="info-table" style="margin-bottom:10px; border:1px solid #ccc !important; background:#f8fffe;">
        <tr>
            <td style="width:36%; font-weight:bold;">Nama Siswa</td>
            <td style="width:3%;">:</td>
            <td><strong>{{ $siswa->nama_siswa }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Kelas / Rombel</td>
            <td>:</td>
            <td>{{ $siswa->rombel->tingkat ?? '-' }} / {{ $siswa->rombel->nama_rombel ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;">NIS</td>
            <td>:</td>
            <td>{{ $siswa->nis ?? '-' }}</td>
        </tr>
    </table>

    {{-- Keterangan Bintang --}}
    <div class="keterangan-bintang">
        <strong>Keterangan Nilai:</strong>
        &nbsp;★ = Belum baik
        &nbsp;&nbsp;★★ = Cukup baik
        &nbsp;&nbsp;★★★ = Baik
        &nbsp;&nbsp;★★★★ = Sangat baik
    </div>

    {{-- A. Penilaian Aspek --}}
    <div class="section-title">A. Penilaian Aspek Tahfidz</div>
    <table style="margin-bottom:12px;">
        <thead>
            <tr>
                <th style="width:6%; text-align:center;">No</th>
                <th style="text-align:left;">Aspek Penilaian</th>
                <th style="width:20%; text-align:center;">Nilai</th>
                <th style="width:34%; text-align:center;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aspeks as $index => $aspek)
            @php $nilaiAngka = $nilai[$aspek->id] ?? 0; @endphp
            <tr class="{{ $index % 2 == 0 ? 'row-even' : 'row-odd' }}">
                <td style="text-align:center;">{{ $index + 1 }}</td>
                <td>{{ $aspek->nama_aspek }}</td>
                <td style="text-align:center; font-size:12pt;">
                    @if($nilaiAngka > 0)
                        <span class="star-filled">{!! str_repeat('★', $nilaiAngka) !!}</span><span class="star-empty">{!! str_repeat('★', 4 - $nilaiAngka) !!}</span>
                    @else
                        <span style="color:#bbb; font-size:9pt; font-style:italic;">Belum dinilai</span>
                    @endif
                </td>
                <td style="text-align:center; font-size:9.5pt;">{{ $keterangan[$aspek->id] ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:#aaa; font-style:italic; padding:10px;">Belum ada aspek penilaian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- B. Ringkasan Hafalan --}}
    <div class="section-title">B. Ringkasan Hafalan</div>
    <table class="info-table" style="margin-bottom:12px; border:1px solid #ccc !important; background:#f8fffe;">
        <tr>
            <td style="width:36%; font-weight:bold;">Pencapaian Munaqosah</td>
            <td style="width:3%;">:</td>
            <td>
                {{ $pencapaian ?? 0 }}%
                <span class="badge {{ ($pencapaian ?? 0) >= 75 ? 'badge-green' : 'badge-yellow' }}" style="margin-left:6px;">
                    {{ $status ?? 'Belum Dinilai' }}
                </span>
            </td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Hafalan Terakhir</td>
            <td>:</td>
            <td>Surah <strong>{{ $hafalan->surah_terakhir ?? '-' }}</strong> &nbsp; Ayat <strong>{{ $hafalan->ayat_terakhir ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Target Hafalan Lanjutan</td>
            <td>:</td>
            <td>Surah <strong>{{ $hafalan->surah_lanjut ?? '-' }}</strong> &nbsp; Ayat <strong>{{ $hafalan->ayat_lanjut ?? '-' }}</strong></td>
        </tr>
    </table>

    {{-- C. Nilai Ujian --}}
    <div class="section-title">C. Nilai Ujian Tahfidz</div>
    <table style="margin-bottom:12px;">
        <thead>
            <tr>
                <th style="width:6%; text-align:center;">No</th>
                <th style="text-align:left;">Nama Ujian</th>
                <th style="width:22%; text-align:center;">Nilai Angka</th>
                <th style="width:26%; text-align:center;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ujian as $index => $u)
            @php $ket = $u->keterangan ?? '-'; @endphp
            <tr class="{{ $index % 2 == 0 ? 'row-even' : 'row-odd' }}">
                <td style="text-align:center;">{{ $index + 1 }}</td>
                <td>{{ $u->nama_ujian }}</td>
                <td style="text-align:center; font-weight:bold; font-size:11pt;">{{ $u->nilai_ujian }}</td>
                <td style="text-align:center;">
                    <span class="badge {{ $ket === 'Sangat Baik' ? 'badge-green' : ($ket === 'Baik' ? 'badge-blue' : ($ket === 'Cukup' ? 'badge-yellow' : 'badge-gray')) }}">
                        {{ $ket }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:#aaa; font-style:italic; padding:10px;">Belum ada nilai ujian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- D. Catatan Guru --}}
    <div class="section-title">D. Catatan Guru</div>
    <div class="catatan-box">
        @if($catatan)
            @php
                $sentences  = explode('. ', $catatan);
                $paragraphs = array_chunk($sentences, 3);
            @endphp
            @foreach($paragraphs as $para)
                <p>{{ implode('. ', $para) }}{{ !str_ends_with(trim(end($para)), '.') ? '.' : '' }}</p>
            @endforeach
        @else
            <p style="color:#aaa; font-style:italic;">Tidak ada keterangan tambahan.</p>
        @endif
    </div>

    {{-- Tanda Tangan --}}
    <div class="ttd-wrapper">
        <div class="ttd-box">
            <div>Mengetahui,</div>
            <div>Orang Tua / Wali</div>
            <div class="ttd-space"></div>
            <div class="ttd-line">
                <div>( ________________________ )</div>
            </div>
        </div>
        <div class="ttd-box">
            <div>Guru Tahfidz,</div>
            <div class="ttd-space"></div>
            <div class="ttd-line">
                <strong>{{ $namaGuru }}</strong><br>
                <span style="font-size:9pt;">NUPTK: {{ $nuptk }}</span>
            </div>
        </div>
    </div>

</div>{{-- end .a4-wrapper --}}
</div>{{-- end #print-area --}}

<div style="height:32px;"></div>

@endsection