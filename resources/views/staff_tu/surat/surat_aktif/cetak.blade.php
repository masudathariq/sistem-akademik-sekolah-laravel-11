<div style="width: 100%; font-family: 'Times New Roman', serif; font-size: 12pt; line-height: 1.6;">

    <h3 style="text-align: center; margin-bottom: 0;">
        <u>SURAT KETERANGAN AKTIF</u>
    </h3>

    <p style="text-align: center; margin-top: 5px;">
        Nomor : {{ $surat->nomor_surat }}
    </p>

    <br>

    <p>
        Yang bertanda tangan di bawah ini:
    </p>

    <table style="margin-left: 40px;">
        <tr>
            <td style="width:120px;">Nama</td>
            <td>: IMROATUN ROFIQOH, S.Pd.</td>
        </tr>
        <tr>
            <td>NUPTK</td>
            <td>: 8446 7596 6221 0013</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: Kepala Madrasah</td>
        </tr>
    </table>

    <br>

    <p>
        Dengan ini menerangkan bahwa:
    </p>

    <table style="margin-left: 40px;">
        <tr>
            <td style="width:120px;">Nama</td>
            <td>: {{ $surat->nama_siswa ?? $surat->siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>: {{ $surat->nisn ?? $surat->siswa->nisn }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>: Siswa Aktif</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:
                {{ $surat->kelas ?? $surat->siswa->rombel->tingkat }}
            </td>
        </tr>
        <tr>
            <td>Tahun Pelajaran</td>
            <td>:
                {{ $surat->tahun_pelajaran ?? $surat->siswa->rombel->tahunAjaran->tahun_ajaran ?? '-' }}
            </td>
        </tr>
    </table>

    <br>

    <p style="text-align: justify;">
        Bahwa nama tersebut di atas benar merupakan siswa aktif
        MTs Muhammadiyah 1 Natar dan sampai dengan surat ini diterbitkan
        masih terdaftar serta mengikuti kegiatan pembelajaran
        sebagaimana mestinya.
    </p>

    <p style="text-align: justify;">
        Demikian surat keterangan ini dibuat untuk dapat dipergunakan
        sebagaimana mestinya.
    </p>

    <br><br>

    <div style="width: 100%; text-align: right;">
        <p>
            Natar, {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}<br>
            Kepala MTs Muhammadiyah 1 Natar
        </p>

        <br><br><br>

        <p style="font-weight: bold; text-decoration: underline;">
            IMROATUN ROFIQOH, S.Pd.
        </p>
        <p>
            NUPTK. 8446 7596 6221 0013
        </p>
    </div>

</div>
