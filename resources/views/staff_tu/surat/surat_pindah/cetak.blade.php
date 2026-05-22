<div style="
    width: 100%;
    font-family: 'Times New Roman', serif;
    font-size: 12pt;
    line-height: 1.5;
    color: #111827;
">

    {{-- KOP SURAT --}}
    <div style="
        width: 100%;
        margin-bottom: 24px;
    ">
        <img src="{{ public_path('images/kop.jpg') }}"
             style="
                width: 100%;
                height: auto;
             ">
    </div>

    {{-- HEADER --}}
    <div style="text-align:center; margin-bottom: 18px;">

        <div style="
            font-size: 14pt;
            font-weight: bold;
            letter-spacing: .5px;
            text-transform: uppercase;
            text-decoration: underline;
        ">
            SURAT KETERANGAN PINDAH SEKOLAH
        </div>

        <div style="
            margin-top: 5px;
            font-size: 10.5pt;
        ">
            Nomor : <strong>{{ $surat->nomor_surat }}</strong>
        </div>
    </div>

    {{-- PEMBUKA --}}
    <p style="
        text-align: justify;
        margin-bottom: 10px;
    ">
        Yang bertanda tangan di bawah ini Kepala Madrasah Tsanawiyah
        Muhammadiyah 1 Natar menerangkan bahwa:
    </p>

    {{-- DATA SISWA --}}
    <table style="
        width: 100%;
        margin-left: 25px;
        margin-bottom: 14px;
        border-collapse: collapse;
        line-height: 1.5;
    ">
        <tr>
            <td style="width: 180px; padding: 1px 0;">Nama Lengkap</td>
            <td>: <strong>{{ $surat->nama_siswa }}</strong></td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Tempat / Tanggal Lahir</td>
            <td>:
                {{ $surat->tempat_lahir }},
                {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') }}
            </td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">NISN</td>
            <td>: {{ $surat->nisn }}</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Kelas</td>
            <td>: {{ $surat->kelas }}</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Jenis Kelamin</td>
            <td>: {{ $surat->jenis_kelamin }}</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Alamat</td>
            <td>: {{ $surat->alamat_siswa }}</td>
        </tr>
    </table>

    {{-- ORANG TUA --}}
    <p style="
        text-align: justify;
        margin-bottom: 8px;
    ">
        Berdasarkan permohonan orang tua / wali siswa:
    </p>

    <table style="
        width: 100%;
        margin-left: 25px;
        margin-bottom: 14px;
        border-collapse: collapse;
        line-height: 1.5;
    ">
        <tr>
            <td style="width: 180px; padding: 1px 0;">Nama Orang Tua</td>
            <td>: {{ $surat->nama_wali }}</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Pekerjaan</td>
            <td>: {{ $surat->pekerjaan_wali }}</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Alamat</td>
            <td>: {{ $surat->alamat_wali }}</td>
        </tr>
    </table>

    {{-- ISI SURAT --}}
    <p style="
        text-align: justify;
        margin-bottom: 10px;
    ">
        Dengan ini menerangkan bahwa siswa tersebut mengajukan pindah
        sekolah ke <strong>{{ $surat->tujuan_sekolah }}</strong>
        atas permohonan orang tua / wali.
    </p>

    <p style="
        text-align: justify;
        margin-bottom: 10px;
    ">
        Seluruh administrasi sekolah telah diselesaikan sampai dengan
        bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}.
        Setelah diterbitkannya surat ini maka yang bersangkutan tidak lagi
        tercatat sebagai siswa aktif di MTs Muhammadiyah 1 Natar.
    </p>

    <p style="
        text-align: justify;
        margin-bottom: 0;
    ">
        Demikian surat keterangan pindah sekolah ini dibuat agar dapat
        dipergunakan sebagaimana mestinya.
    </p>

    {{-- TANDA TANGAN --}}
    <div style="
        width: 100%;
        margin-top: 34px;
        text-align: right;
    ">
        <div style="
            width: 280px;
            margin-left: auto;
            text-align: center;
            line-height: 1.5;
        ">
            <div>
                Natar,
                {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}
            </div>

            <div>
                Kepala MTs Muhammadiyah 1 Natar
            </div>

            <div style="height: 70px;"></div>

            <div style="
                font-weight: bold;
                text-decoration: underline;
                font-size: 12pt;
            ">
                IMROATUN ROFIQOH, S.Pd.
            </div>

            <div style="font-size: 10pt;">
                NUPTK. 8446 7596 6221 0013
            </div>
        </div>
    </div>

            {{-- FOOTNOTE SISTEM --}}
    <div style="
        margin-top: 45px;
        border-top: 1px solid #d1d5db;
        padding-top: 8px;
        font-size: 9pt;
        color: #6b7280;
        text-align: center;
        font-style: italic;
    ">
        Dokumen ini diterbitkan secara resmi oleh sistem administrasi
        MTs Muhammadiyah 1 Natar.
    </div>

</div>