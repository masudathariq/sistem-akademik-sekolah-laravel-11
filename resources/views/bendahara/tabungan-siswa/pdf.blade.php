<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tabungan Siswa</title>

    <style>
        body{
            font-family:"Times New Roman", serif;
            font-size:12px;
            color:#000;
            line-height:1.5;
            margin:28px;
        }

        /* =========================
           KOP SURAT
        ========================== */
        .kop-wrapper{
            width:100%;
            margin-bottom:20px;
        }

        .kop-image{
            width:100%;
            height:auto;
            display:block;
        }

        /* =========================
           JUDUL DOKUMEN
        ========================== */
        .document-title{
            text-align:center;
            margin-top:10px;
            margin-bottom:25px;
        }

        .document-title h4{
            margin:0;
            font-size:16px;
            text-transform:uppercase;
            text-decoration:underline;
            font-weight:bold;
        }

        .document-title p{
            margin-top:4px;
            font-size:12px;
        }

        /* =========================
           DATA SISWA
        ========================== */
        .info-table{
            width:100%;
            margin-bottom:20px;
            border-collapse:collapse;
        }

        .info-table td{
            padding:4px 0;
            font-size:12px;
            vertical-align:top;
        }

        .info-label{
            width:150px;
        }

        /* =========================
           RINGKASAN
        ========================== */
        .summary{
            margin-bottom:25px;
        }

        .summary table{
            width:100%;
            border-collapse:collapse;
        }

        .summary th,
        .summary td{
            border:1px solid #000;
            padding:8px;
            font-size:12px;
        }

        .summary th{
            background:#e5e5e5;
            text-align:center;
            font-weight:bold;
        }

        .summary td{
            text-align:center;
        }

        /* =========================
           TABEL TRANSAKSI
        ========================== */
        .table-title{
            font-weight:bold;
            margin-bottom:8px;
            font-size:13px;
        }

        .transaksi-table{
            width:100%;
            border-collapse:collapse;
        }

        .transaksi-table th,
        .transaksi-table td{
            border:1px solid #000;
            padding:7px;
            font-size:11px;
        }

        .transaksi-table th{
            background:#d9d9d9;
            text-align:center;
            font-weight:bold;
        }

        .text-center{
            text-align:center;
        }

        .text-right{
            text-align:right;
        }

        .text-left{
            text-align:left;
        }

        /* =========================
           FOOTER / TTD
        ========================== */
        .footer{
            margin-top:45px;
            width:100%;
        }

        .signature{
            width:250px;
            float:right;
            text-align:center;
        }

        .signature-space{
            height:70px;
        }

        .footer-note{
            margin-top:80px;
            font-size:11px;
            text-align:center;
            color:#555;
        }
    </style>
</head>

<body>

    {{-- =========================
         KOP SURAT
    ========================== --}}
    <div class="kop-wrapper">
        <img src="{{ public_path('images/kop.jpg') }}"
             alt="Kop Sekolah"
             class="kop-image">
    </div>

    {{-- =========================
         JUDUL
    ========================== --}}
    <div class="document-title">
        <h4>Laporan Rekap Tabungan Siswa</h4>
        <p>
            Tahun Ajaran {{ date('Y') }}
        </p>
    </div>

    {{-- =========================
         DATA SISWA
    ========================== --}}
    <table class="info-table">
        <tr>
            <td class="info-label">Nama Siswa</td>
            <td>: {{ $siswa->nama_siswa }}</td>
        </tr>

        <tr>
            <td class="info-label">NIS</td>
            <td>: {{ $siswa->nis ?? '-' }}</td>
        </tr>

        <tr>
            <td class="info-label">NISN</td>
            <td>: {{ $siswa->nisn ?? '-' }}</td>
        </tr>

        <tr>
            <td class="info-label">Kelas / Rombel</td>
            <td>
                : {{ $siswa->rombel->nama_rombel ?? '-' }}
                ({{ $siswa->rombel->kode_rombel ?? '-' }})
            </td>
        </tr>

        <tr>
            <td class="info-label">Tanggal Cetak</td>
            <td>
                : {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </td>
        </tr>
    </table>

    {{-- =========================
         RINGKASAN SALDO
    ========================== --}}
    <div class="summary">
        <table>
            <tr>
                <th>Total Setoran</th>
                <th>Total Penarikan</th>
                <th>Saldo Akhir</th>
            </tr>

            <tr>
                <td>
                    Rp {{ number_format($totalSetor,0,',','.') }}
                </td>

                <td>
                    Rp {{ number_format($totalTarik,0,',','.') }}
                </td>

                <td>
                    <strong>
                        Rp {{ number_format($saldo,0,',','.') }}
                    </strong>
                </td>
            </tr>
        </table>
    </div>

    {{-- =========================
         TABEL TRANSAKSI
    ========================== --}}
    <div class="table-title">
        Riwayat Transaksi Tabungan
    </div>

    <table class="transaksi-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Jenis</th>
                <th width="20%">Nominal</th>
                <th>Keterangan</th>
                <th width="20%">Petugas</th>
            </tr>
        </thead>

        <tbody>
            @forelse($transaksi as $index => $trx)
            <tr>
                <td class="text-center">
                    {{ $index + 1 }}
                </td>

                <td class="text-center">
                    {{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}
                </td>

                <td class="text-center">
                    {{ strtoupper($trx->jenis) }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($trx->nominal,0,',','.') }}
                </td>

                <td class="text-left">
                    {{ $trx->keterangan ?? '-' }}
                </td>

                <td class="text-center">
                    {{ $trx->petugas->name ?? '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    Tidak ada transaksi tabungan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- =========================
         TANDA TANGAN
    ========================== --}}
    <div class="footer">

        <div class="signature">
            <div>
                Tangkitbatu,
                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </div>

            <div>
                Bendahara
            </div>

            <div class="signature-space"></div>

            <div>
                <strong>
                    ______________________
                </strong>
            </div>
        </div>

    </div>

    {{-- =========================
         FOOTER NOTE
    ========================== --}}
    <div class="footer-note">
        Dokumen ini dicetak melalui Sistem Informasi Sekolah
    </div>

</body>
</html>