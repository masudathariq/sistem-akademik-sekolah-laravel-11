<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Surat Pindah</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 16px;
            margin: 40px;
            line-height: 1.6;
        }

        .kop img {
            width: 100%;
            height: auto;
        }

        .judul {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .nomor {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
        }

        .table-data td {
            padding: 3px 0;
            vertical-align: top;
        }

        .content {
            text-align: justify;
        }

        .ttd {
            margin-top: 60px;
            width: 100%;
        }

        .ttd-kanan {
            width: 300px;
            float: right;
            text-align: center;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="kop" style="text-align:center; margin-bottom:20px;">
    <img src="{{ asset('images/kop.jpg') }}" 
         style="width:100%; max-height:150px;" alt="Kop Surat">
</div>



    {{-- JUDUL --}}
    <div class="judul">
        SURAT KETERANGAN PINDAH SEKOLAH
    </div>

    <div class="nomor">
        Nomor : {{ $surat->nomor_surat }}
    </div>

    <div class="content">
        Yang bertanda tangan di bawah ini Kepala Madrasah Tsanawiyah Muhammadiyah 1 Natar,
        Desa Muara Putih, Kecamatan Natar, Kabupaten Lampung Selatan, Provinsi Lampung
        menerangkan bahwa siswa:
    </div>

    <br>

    {{-- DATA SISWA --}}
    <table class="table-data">
        <tr>
            <td width="200">Nama</td>
            <td width="10">:</td>
            <td>{{ $surat->nama_siswa }}</td>
        </tr>
        <tr>
            <td>Tempat / Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>NIS / NISN</td>
            <td>:</td>
            <td>{{ $surat->nisn }}</td>
        </tr>
        <tr>
            <td>Kelas saat ini</td>
            <td>:</td>
            <td>{{ $surat->kelas }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $surat->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $surat->alamat_siswa }}</td>
        </tr>
    </table>

    <br>

    <div class="content">
        Sesuai surat permohonan pindah sekolah yang diajukan oleh orang tua / wali murid
        tersebut di bawah ini:
    </div>

    <br>

    {{-- DATA ORANG TUA --}}
    <table class="table-data">
        <tr>
            <td width="200">Nama</td>
            <td width="10">:</td>
            <td>{{ $surat->nama_ortu }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $surat->pekerjaan_ortu }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $surat->alamat_ortu }}</td>
        </tr>
    </table>

    <br>

    <div class="content">
        Untuk pindah sekolah ke {{ $surat->tujuan_sekolah }}, dengan alasan permintaan orang tua / wali.

        <br><br>

        Segala ketentuan yang menyangkut administrasi sekolah telah diselesaikan sampai dengan bulan
        {{ \Carbon\Carbon::now()->translatedFormat('F Y') }},
        dan setelah menerima surat pindah ini maka yang bersangkutan tidak diperkenankan kembali
        sekolah di MTs Muhammadiyah 1 Natar.

        <br><br>

        Demikian surat keterangan pindah sekolah ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <div class="ttd-kanan">
            Natar, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            <br><br>
            Kepala MTs M 1 Natar
            <br><br><br><br>
            <b>Imroatun Rofiqoh, S.Pd</b>
            <br>
            NUPTK. 8446 7596 6221 0013
        </div>
    </div>

    <br style="clear: both;">

    <br><br>
    <button onclick="window.print()">Cetak</button>

</body>
</html>
