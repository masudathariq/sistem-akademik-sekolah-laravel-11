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
            font-style: italic;
            text-decoration: underline;
        ">
            SURAT KETERANGAN AKTIF
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
        Yang bertanda tangan di bawah ini, Kepala Madrasah Tsanawiyah
        Muhammadiyah 1 Natar, menerangkan dengan sebenarnya bahwa:
    </p>

    {{-- DATA KEPALA MADRASAH --}}
    <table style="
        width: 100%;
        margin-left: 25px;
        margin-bottom: 14px;
        border-collapse: collapse;
        line-height: 1.5;
    ">
        <tr>
            <td style="width: 170px; padding: 1px 0;">Nama</td>
            <td>: IMROATUN ROFIQOH, S.Pd.</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">NUPTK</td>
            <td>: 8446 7596 6221 0013</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Jabatan</td>
            <td>: Kepala Madrasah</td>
        </tr>
    </table>

    {{-- KETERANGAN SISWA --}}
    <p style="
        text-align: justify;
        margin-bottom: 8px;
    ">
        Dengan ini menerangkan bahwa:
    </p>

    <table style="
        width: 100%;
        margin-left: 25px;
        margin-bottom: 14px;
        border-collapse: collapse;
        line-height: 1.5;
    ">
        <tr>
            <td style="width: 170px; padding: 1px 0;">Nama Lengkap</td>
            <td>: <strong>{{ $surat->nama_siswa ?? $surat->siswa->nama_siswa }}</strong></td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">NISN</td>
            <td>: {{ $surat->nisn ?? $surat->siswa->nisn }}</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Status</td>
            <td>: Siswa Aktif</td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Kelas / Rombel</td>
            <td>:
                {{ $surat->kelas ?? $surat->siswa->rombel->tingkat_romawi }}
            </td>
        </tr>

        <tr>
            <td style="padding: 1px 0;">Tahun Pelajaran</td>
            <td>:
                {{ $surat->tahun_pelajaran ?? $surat->siswa->rombel->tahunAjaran->tahun_ajaran ?? '-' }}
            </td>
        </tr>
    </table>

    {{-- ISI SURAT --}}
    <p style="
        text-align: justify;
        margin-bottom: 10px;
    ">
        Bahwa nama tersebut di atas benar merupakan siswa aktif
        MTs Muhammadiyah 1 Natar dan sampai dengan surat ini diterbitkan,
        yang bersangkutan masih terdaftar secara resmi serta aktif
        mengikuti kegiatan pembelajaran dan tata tertib sekolah
        sebagaimana mestinya.
    </p>

    <p style="
        text-align: justify;
        margin-bottom: 0;
    ">
        Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat
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
            <br>
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
