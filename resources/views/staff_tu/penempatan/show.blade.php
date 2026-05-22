@extends('layouts.staff_tu')

@section('title', 'Detail Rombel - ' . $rombel->nama_lengkap)

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{
    --navy:#1e3a8a;
    --navy-md:#1d4ed8;
    --navy-lt:#dbeafe;

    --green:#16a34a;
    --green-lt:#f0fdf4;
    --green-bd:#86efac;

    --amber:#d97706;
    --amber-lt:#fffbeb;
    --amber-bd:#fcd34d;

    --red:#dc2626;
    --red-lt:#fff1f2;
    --red-bd:#fecdd3;

    --gray-bg:#f8fafc;
    --border:#e2e8f0;

    --text:#1e293b;
    --muted:#64748b;
    --hint:#94a3b8;

    --radius:12px;

    --shadow:
        0 1px 3px rgba(0,0,0,.06),
        0 4px 12px rgba(0,0,0,.04);
}

body{
    font-family:'IBM Plex Sans',sans-serif;
}

.rb-page{
    min-height:100vh;
    background:var(--gray-bg);
    padding:2rem;
    padding-bottom:4rem;
    color:var(--text);
}

/* ───────── HEADER ───────── */
.top-bar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    margin-bottom:1.5rem;
}

.page-title{
    display:flex;
    align-items:center;
    gap:12px;
}

.title-icon{
    width:44px;
    height:44px;
    border-radius:10px;
    background:var(--navy-lt);
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.title-text h1{
    font-size:20px;
    font-weight:700;
    letter-spacing:-.02em;
    color:var(--text);
    margin-bottom:2px;
}

.title-text p{
    font-size:13px;
    color:var(--muted);
}

.back-btn{
    display:inline-flex;
    align-items:center;
    gap:7px;
    padding:.65rem 1rem;
    border-radius:8px;
    border:1px solid var(--border);
    background:#fff;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    color:var(--text);
    transition:.15s;
}

.back-btn:hover{
    border-color:#bfdbfe;
    background:#eff6ff;
    color:var(--navy-md);
}

/* ───────── ALERT ───────── */
.alert{
    display:flex;
    align-items:flex-start;
    gap:10px;
    padding:.875rem 1rem;
    border-radius:10px;
    font-size:13px;
    font-weight:500;
    margin-bottom:1.25rem;
}

.alert-success{
    background:var(--green-lt);
    border:1px solid var(--green-bd);
    color:var(--green);
}

.alert-error{
    background:var(--red-lt);
    border:1px solid var(--red-bd);
    color:var(--red);
}

/* ───────── INFO CARD ───────── */
.info-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    overflow:hidden;
    margin-bottom:1.5rem;
}

.info-header{
    padding:1rem 1.25rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
}

.rombel-title{
    font-size:18px;
    font-weight:700;
    letter-spacing:-.02em;
    color:var(--text);
}

.rombel-sub{
    font-size:12px;
    color:var(--muted);
    margin-top:2px;
}

.badge{
    padding:4px 12px;
    border-radius:999px;
    background:var(--navy-lt);
    color:var(--navy-md);
    font-size:12px;
    font-weight:700;
    white-space:nowrap;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    padding:1.25rem;
}

.info-box{
    border:1px solid var(--border);
    border-radius:10px;
    background:#fff;
    padding:1rem;
}

.info-label{
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:var(--hint);
    margin-bottom:6px;
}

.info-value{
    font-size:14px;
    font-weight:600;
    color:var(--text);
}

/* ───────── EXPORT ───────── */
.export-row{
    display:flex;
    gap:10px;
    padding:1rem 1.25rem;
    border-top:1px solid var(--border);
    background:#fafafa;
}

.btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:7px;
    padding:.6rem 1rem;
    border-radius:8px;
    border:none;
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    cursor:pointer;
    transition:.15s;
}

.btn svg{
    width:14px;
    height:14px;
}

.btn-green{
    background:var(--green);
    color:#fff;
}

.btn-green:hover{
    background:#15803d;
    color:#fff;
}

.btn-red{
    background:var(--red);
    color:#fff;
}

.btn-red:hover{
    background:#b91c1c;
    color:#fff;
}

/* ───────── FORM CARD ───────── */
.form-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
    margin-bottom:1.5rem;
}

.form-header{
    display:flex;
    align-items:center;
    gap:10px;
    padding:.9rem 1.25rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
}

.form-title{
    font-size:14px;
    font-weight:700;
    color:var(--text);
}

.form-sub{
    font-size:12px;
    color:var(--muted);
}

.form-body{
    padding:1.25rem;
}

.form-label{
    display:block;
    margin-bottom:6px;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:var(--muted);
}

.form-control{
    width:100%;
    padding:.7rem .9rem;
    border:1px solid var(--border);
    border-radius:8px;
    background:#fff;
    font-size:13px;
    font-family:'IBM Plex Sans',sans-serif;
    color:var(--text);
    outline:none;
    transition:.15s;
}

.form-control:focus{
    border-color:var(--navy-md);
    box-shadow:0 0 0 3px rgba(29,78,216,.08);
}

.form-footer{
    display:flex;
    justify-content:flex-end;
    margin-top:1rem;
}

.btn-submit{
    display:inline-flex;
    align-items:center;
    gap:7px;
    padding:.65rem 1.2rem;
    border:none;
    border-radius:8px;
    background:var(--navy);
    color:#fff;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:.15s;
}

.btn-submit:hover{
    background:var(--navy-md);
}

/* ───────── LULUS ───────── */
.lulus-card{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    background:var(--green-lt);
    border:1px solid var(--green-bd);
    border-radius:var(--radius);
    padding:1rem 1.25rem;
    margin-bottom:1.5rem;
    box-shadow:var(--shadow);
}

.lulus-title{
    font-size:14px;
    font-weight:700;
    color:#15803d;
    margin-bottom:2px;
}

.lulus-sub{
    font-size:12px;
    color:var(--green);
}

.btn-lulus{
    display:inline-flex;
    align-items:center;
    gap:7px;
    padding:.65rem 1rem;
    border:none;
    border-radius:8px;
    background:var(--green);
    color:#fff;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
}

/* ───────── SISWA TABLE ───────── */
.table-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
}

.table-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:1rem 1.25rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
}

.table-title{
    font-size:14px;
    font-weight:700;
    color:var(--text);
}

.table-wrap{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:var(--navy);
}

thead th{
    padding:.85rem 1rem;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:rgba(255,255,255,.9);
    text-align:center;
}

tbody tr{
    border-bottom:1px solid var(--border);
    transition:.12s;
}

tbody tr:hover{
    background:#f8fbff;
}

tbody td{
    padding:.85rem 1rem;
    font-size:13px;
    color:var(--text);
    vertical-align:middle;
}

.no-badge{
    width:34px;
    height:34px;
    border-radius:8px;
    background:var(--navy-lt);
    color:var(--navy-md);
    font-size:12px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
}

.gender{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:4px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
}

.gender.l{
    background:#eff6ff;
    color:#2563eb;
}

.gender.p{
    background:#fdf2f8;
    color:#db2777;
}

.aksi-wrap{
    display:flex;
    align-items:center;
    gap:6px;
}

.select-mini{
    padding:.55rem .75rem;
    border:1px solid var(--border);
    border-radius:8px;
    font-size:12px;
    font-family:'IBM Plex Sans',sans-serif;
}

.btn-mini{
    padding:.55rem .75rem;
    border:none;
    border-radius:8px;
    font-size:12px;
    font-weight:700;
    cursor:pointer;
}

.btn-pindah{
    background:var(--amber-lt);
    color:var(--amber);
    border:1px solid var(--amber-bd);
}

.btn-keluar{
    background:var(--red-lt);
    color:var(--red);
    border:1px solid var(--red-bd);
}

/* ───────── EMPTY ───────── */
.empty{
    padding:3rem 1.5rem;
    text-align:center;
}

.empty strong{
    display:block;
    font-size:15px;
    font-weight:700;
    color:var(--text);
    margin-bottom:4px;
}

.empty p{
    font-size:13px;
    color:var(--muted);
    margin-bottom:1rem;
}

/* ───────── RESPONSIVE ───────── */
@media(max-width:900px){

    .rb-page{
        padding:1rem;
    }

    .info-grid{
        grid-template-columns:1fr;
    }

    .lulus-card{
        flex-direction:column;
        align-items:flex-start;
    }

    .aksi-wrap{
        flex-direction:column;
        align-items:stretch;
    }
}
</style>

<div class="rb-page">

    {{-- HEADER --}}
    <div class="top-bar">

        <div class="page-title">
            <div class="title-icon">
                🏫
            </div>

            <div class="title-text">
                <h1>{{ $rombel->nama_lengkap }}</h1>
                <p>
                    Tahun Ajaran {{ $tahunAjaranAktif->tahun_ajaran }}
                </p>
            </div>
        </div>

        <a href="{{ route('staff_tu.penempatan.index') }}" class="back-btn">
            ← Kembali
        </a>

    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
        ⚠️ {{ session('error') }}
    </div>
    @endif

    {{-- INFO --}}
    <div class="info-card">

        <div class="info-header">
            <div>
                <div class="rombel-title">
                    {{ $rombel->nama_lengkap }}
                </div>

                <div class="rombel-sub">
                    Detail Informasi Rombel
                </div>
            </div>

            <span class="badge">
                {{ $rombel->siswas->count() }} Siswa
            </span>
        </div>

        <div class="info-grid">

            <div class="info-box">
                <div class="info-label">Wali Kelas</div>
                <div class="info-value">
                    {{ $rombel->walikelas ? $rombel->walikelas->nama : 'Belum ditentukan' }}
                </div>
            </div>

            <div class="info-box">
                <div class="info-label">Jumlah Siswa</div>
                <div class="info-value">
                    {{ $rombel->siswas->count() }} siswa
                </div>
            </div>

            <div class="info-box">
                <div class="info-label">Tingkat</div>
                <div class="info-value">
                    Kelas {{ $rombel->tingkat_romawi }}
                </div>
            </div>

        </div>

        @if($rombel->siswas->count())
        <div class="export-row">

            <a href="{{ route('staff_tu.penempatan.exportSiswa', $rombel->id) }}"
               class="btn btn-green">
                Export Excel
            </a>

            <a href="{{ route('staff_tu.penempatan.exportPdf', $rombel->id) }}"
                target="_blank"
               class="btn btn-red">
                Export PDF
            </a>

        </div>
        @endif

    </div>

    {{-- WALI KELAS --}}
    <div class="form-card">

        <div class="form-header">
            <div>
                <div class="form-title">Atur Wali Kelas</div>
                <div class="form-sub">
                    Tentukan guru sebagai wali kelas rombel
                </div>
            </div>
        </div>

        <div class="form-body">

            <form action="{{ route('staff_tu.penempatan.setWalikelas', $rombel->id) }}"
                  method="POST">

                @csrf

                <div>
                    <label class="form-label">
                        Pilih Guru
                    </label>

                    <select name="guru_id" class="form-control">

                        <option value="">
                            -- Pilih Wali Kelas --
                        </option>

                        @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}"
                            {{ $rombel->guru_id == $guru->id ? 'selected' : '' }}>

                            {{ $guru->nama }}

                        </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit">
                        Simpan Wali Kelas
                    </button>
                </div>

            </form>

        </div>

    </div>

    {{-- LULUSKAN --}}
    @if($rombel->tingkat == 9 && $rombel->siswas->count())
    <div class="lulus-card">

        <div>
            <div class="lulus-title">
                Luluskan Semua Siswa
            </div>

            <div class="lulus-sub">
                Pindahkan semua siswa menjadi alumni
            </div>
        </div>

        <form action="{{ route('staff_tu.rombel.lulusSemua', $rombel->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin ingin meluluskan semua siswa?')">

            @csrf

            <button type="submit" class="btn-lulus">
                🎓 Luluskan
            </button>

        </form>

    </div>
    @endif

    {{-- TABLE SISWA --}}
    <div class="table-card">

        <div class="table-header">

            <div class="table-title">
                Daftar Siswa
            </div>

            <span class="badge">
                {{ $rombel->siswas->count() }} siswa
            </span>

        </div>

        @if($rombel->siswas->count())

        <div class="table-wrap">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>JK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($rombel->siswas as $index => $siswa)
                    <tr>

                        <td>
                            <div class="no-badge">
                                {{ $index + 1 }}
                            </div>
                        </td>

                        <td>{{ $siswa->nisn }}</td>

                        <td>{{ $siswa->nis }}</td>

                        <td>
                            <strong>
                                {{ $siswa->nama_siswa }}
                            </strong>
                        </td>

                        <td>
                            <span class="gender {{ $siswa->jenis_kelamin == 'L' ? 'l' : 'p' }}">
                                {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </td>

                        <td>

                            <div class="aksi-wrap">

                                {{-- PINDAH --}}
                                <form action="{{ route('staff_tu.penempatan.pindahkan') }}"
                                      method="POST"
                                      style="display:flex;gap:6px;">

                                    @csrf

                                    <input type="hidden"
                                           name="siswa_id"
                                           value="{{ $siswa->id }}">

                                    <select name="rombel_tujuan_id"
                                            class="select-mini">

                                        <option value="">
                                            -- Pindah --
                                        </option>

                                        @foreach(App\Models\Tatausaha\Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)->orderBy('tingkat')->orderBy('kode_rombel')->get() as $r)

                                            @if($r->id !== $rombel->id)

                                            <option value="{{ $r->id }}">
                                                {{ $r->nama_lengkap }}
                                            </option>

                                            @endif

                                        @endforeach

                                    </select>

                                    <button type="submit"
                                            class="btn-mini btn-pindah">

                                        Pindahkan

                                    </button>

                                </form>

                                {{-- KELUARKAN --}}
                                <form action="{{ route('staff_tu.penempatan.keluarkan', $siswa->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin mengeluarkan siswa?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-mini btn-keluar">

                                        Keluarkan

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        @else

        <div class="empty">

            <strong>
                Belum Ada Siswa
            </strong>

            <p>
                Belum ada siswa di rombel ini
            </p>

            <a href="{{ route('staff_tu.penempatan.index') }}"
               class="btn-submit"
               style="text-decoration:none;">

                Kembali ke Penempatan

            </a>

        </div>

        @endif

    </div>

</div>

@endsection