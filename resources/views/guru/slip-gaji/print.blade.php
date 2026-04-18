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
            width: 100%;
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header h3 {
            margin: 4px 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .header p {
            margin: 6px 0 0;
            font-weight: bold;
        }

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

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .total {
            font-size: 15px;
            font-weight: bold;
        }

        @media print {
            button { display: none; }
        }
    </style>
</head>
<body>

<div class="container">

    {{-- ================= HEADER ================= --}}
    <div class="header">
        <h2>Slip Gaji</h2>
        <h3>MTs Muhammadiyah 1 Natar</h3>
        <p>
            Bulan
            {{ \Carbon\Carbon::create(null, $slip->bulan, 1)->translatedFormat('F') }}
            {{ $slip->tahun }}
        </p>
    </div>

    {{-- ================= DATA GURU ================= --}}
    <table>
        <tr>
            <td width="25%">Nama</td>
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
    </table>

    <br>

    {{-- ================= REKAP KEHADIRAN ================= --}}
    <table class="border">
        <tr class="bold">
            <td colspan="3">REKAP KEHADIRAN</td>
        </tr>
        <tr>
            <td>Hadir Sistem</td>
            <td>:</td>
            <td>{{ $slip->hadir_asli }} Hari</td>
        </tr>
        <tr>
            <td>Koreksi</td>
            <td>:</td>
            <td>{{ $slip->koreksi }} Hari</td>
        </tr>
        <tr class="bold">
            <td>Total Hadir</td>
            <td>:</td>
            <td>{{ $slip->hadir_final }} Hari</td>
        </tr>
    </table>

    <br>

    {{-- ================= RINCIAN GAJI ================= --}}
    <table class="border">
        <tr class="bold">
            <td>Keterangan</td>
            <td class="right">Jumlah (Rp)</td>
        </tr>

        <tr>
            <td>Gaji Pokok</td>
            <td class="right">
                {{ number_format($slip->gaji_pokok, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td>
                Transport
                ({{ $slip->hadir_final }} hari ×
                {{ number_format($transportPerHari, 0, ',', '.') }})
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
        @foreach($slip->detail_penambahan ?? [] as $item)
        <tr>
            <td>{{ $item['judul'] }}</td>
            <td class="right">
                {{ number_format($item['jumlah'], 0, ',', '.') }}
            </td>
        </tr>
        @endforeach

        {{-- PENGURANGAN --}}
        @foreach($slip->detail_pengurangan ?? [] as $item)
        <tr>
            <td>{{ $item['judul'] }}</td>
            <td class="right">
                - {{ number_format($item['jumlah'], 0, ',', '.') }}
            </td>
        </tr>
        @endforeach

        <tr class="total">
            <td>TOTAL GAJI DITERIMA</td>
            <td class="right">
                {{ number_format($slip->total_gaji, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <br><br>

    {{-- ================= TANDA TANGAN ================= --}}
    <table width="100%">
        <tr>
            <td width="60%"></td>
            <td style="text-align:center;">
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
