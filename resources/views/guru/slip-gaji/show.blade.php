<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>
        Slip Gaji MTs Muhammadiyah 1 Natar
        {{ \Carbon\Carbon::create(null, $slip->bulan, 1)->translatedFormat('F Y') }}
    </title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 13px;
            color: #000;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        h2, h3 {
            margin: 0;
            text-transform: uppercase;
        }

        h2 { font-size: 18px; }
        h3 { font-size: 16px; margin-top: 4px; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px;
            vertical-align: top;
        }

        .border td {
            border: 1px solid #000;
        }

        .right { text-align: right; }
        .center { text-align: center; }
        .bold { font-weight: bold; }

        .section-title {
            font-weight: bold;
            background: #f0f0f0;
        }

        .total {
            font-size: 15px;
            font-weight: bold;
        }

        @media print {
            a, button { display: none !important; }
        }
    </style>
</head>
<body>

<div class="container">

    {{-- ================= HEADER ================= --}}
    <div class="header">
        <h2>Slip Gaji</h2>
        <h3>MTs Muhammadiyah 1 Natar</h3>
        <p class="bold">
            Bulan {{ \Carbon\Carbon::create(null, $slip->bulan, 1)->translatedFormat('F') }}
            {{ $slip->tahun }}
        </p>
    </div>

    {{-- ================= INFORMASI GURU ================= --}}
    <table class="border">
        <tr class="section-title">
            <td colspan="3">INFORMASI PENERIMA</td>
        </tr>
        <tr>
            <td width="30%">Nama Lengkap</td>
            <td width="5%">:</td>
            <td>{{ $slip->guru->nama }}</td>
        </tr>

        @if($slip->guru->nip)
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $slip->guru->nip }}</td>
        </tr>
        @endif

        <tr>
            <td>Periode Pembayaran</td>
            <td>:</td>
            <td>
                {{ \Carbon\Carbon::create(null, $slip->bulan, 1)->translatedFormat('F Y') }}
            </td>
        </tr>

        <tr>
            <td>Tanggal Diterbitkan</td>
            <td>:</td>
            <td>{{ $slip->created_at->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <br>

    {{-- ================= KEHADIRAN ================= --}}
    <table class="border">
        <tr class="section-title">
            <td colspan="3">REKAPITULASI KEHADIRAN</td>
        </tr>
        <tr>
            <td>Jumlah Hari Hadir (Sistem)</td>
            <td>:</td>
            <td>{{ $slip->hadir_asli }} Hari</td>
        </tr>

        @if($slip->koreksi != 0)
        <tr>
            <td>Penyesuaian / Koreksi</td>
            <td>:</td>
            <td>
                {{ $slip->koreksi > 0 ? '+' : '' }}{{ $slip->koreksi }} Hari
            </td>
        </tr>
        @endif

        <tr class="bold">
            <td>Total Hari Hadir</td>
            <td>:</td>
            <td>{{ $slip->hadir_final }} Hari</td>
        </tr>
    </table>

    <br>

    {{-- ================= RINCIAN GAJI ================= --}}
    <table class="border">
        <tr class="section-title">
            <td>KETERANGAN</td>
            <td class="right">JUMLAH (Rp)</td>
        </tr>

        {{-- GAJI POKOK --}}
        <tr>
            <td>Gaji Pokok</td>
            <td class="right">
                {{ number_format($slip->gaji_pokok, 0, ',', '.') }}
            </td>
        </tr>

        {{-- TRANSPORT --}}
        <tr>
            <td>
                Tunjangan Transport<br>
                <small>
                    ({{ $slip->hadir_final }} hari ×
                    Rp {{ number_format($transportPerHari, 0, ',', '.') }})
                </small>
            </td>
            <td class="right">
                {{ number_format($slip->transport, 0, ',', '.') }}
            </td>
        </tr>

        {{-- TAHFIDZ --}}
@if($slip->tahfidz > 0)
<tr>
    <td>
        Insentif Tahfidz<br>
        <small>
            ({{ $slip->hadir_tahfidz }} hari ×
            Rp {{ number_format($slip->tarif_tahfidz, 0, ',', '.') }})
        </small>
    </td>
    <td class="right">
        {{ number_format($slip->tahfidz, 0, ',', '.') }}
    </td>
</tr>
@endif


        {{-- PENAMBAHAN --}}
        @if(!empty($slip->detail_penambahan))
        <tr class="section-title">
            <td colspan="2">TUNJANGAN & INSENTIF</td>
        </tr>
        @foreach($slip->detail_penambahan as $item)
        <tr>
            <td>+ {{ $item['judul'] }}</td>
            <td class="right">
                {{ number_format($item['jumlah'], 0, ',', '.') }}
            </td>
        </tr>
        @endforeach
        <tr class="bold">
            <td>Total Penambahan</td>
            <td class="right">
                {{ number_format($slip->total_penambahan, 0, ',', '.') }}
            </td>
        </tr>
        @endif

        {{-- PENGURANGAN --}}
        @if(!empty($slip->detail_pengurangan))
        <tr class="section-title">
            <td colspan="2">POTONGAN</td>
        </tr>
        @foreach($slip->detail_pengurangan as $item)
        <tr>
            <td>- {{ $item['judul'] }}</td>
            <td class="right">
                {{ number_format($item['jumlah'], 0, ',', '.') }}
            </td>
        </tr>
        @endforeach
        <tr class="bold">
            <td>Total Potongan</td>
            <td class="right">
                {{ number_format($slip->total_pengurangan, 0, ',', '.') }}
            </td>
        </tr>
        @endif

        {{-- TOTAL --}}
        <tr class="total">
            <td>GAJI YANG DITERIMA</td>
            <td class="right">
                {{ number_format($slip->total_gaji, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <br><br>

    {{-- ================= TTD ================= --}}
    <table width="100%">
        <tr>
            <td width="60%"></td>
            <td class="center">
                Natar, {{ now()->translatedFormat('d F Y') }}<br>
                Bendahara<br><br><br>
                <strong>( _______________________ )</strong>
            </td>
        </tr>
    </table>

</div>

<script>
    window.print();
</script>

</body>
</html>
