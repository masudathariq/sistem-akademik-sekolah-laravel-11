@extends('layouts.staff_tu')

@section('title', 'Tambah Siswa')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap');

*{
    box-sizing:border-box;
}

:root{
    --navy:#1e3a8a;
    --navy-md:#2563eb;
    --navy-soft:#dbeafe;

    --green:#16a34a;
    --green-dark:#15803d;

    --red:#dc2626;
    --red-soft:#fff1f2;

    --gray-bg:#f8fafc;
    --border:#e2e8f0;

    --text:#0f172a;
    --muted:#64748b;
    --hint:#94a3b8;

    --radius:24px;

    --shadow:
        0 10px 35px rgba(15,23,42,.06);
}

body{
    font-family:'IBM Plex Sans',sans-serif;
    background:var(--gray-bg);
}

/* ====================================
PAGE
==================================== */

.siswa-page{
    width:100%;
    min-height:100vh;
    padding:2rem 3rem 4rem;
    background:var(--gray-bg);
}

/* ====================================
HEADER
==================================== */

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:1rem;
    margin-bottom:2rem;
    flex-wrap:wrap;
}

.page-title{
    display:flex;
    align-items:center;
    gap:16px;
}

.title-icon{
    width:64px;
    height:64px;
    border-radius:22px;
    background:linear-gradient(135deg,#16a34a,#15803d);
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 14px 30px rgba(22,163,74,.22);
}

.title-text h1{
    margin:0;
    font-size:32px;
    font-weight:700;
    color:var(--text);
    letter-spacing:-.03em;
}

.title-text p{
    margin-top:6px;
    color:var(--muted);
    font-size:14px;
}

/* ====================================
ERROR
==================================== */

.error-alert{
    display:flex;
    align-items:flex-start;
    gap:14px;
    background:var(--red-soft);
    border:1px solid #fecdd3;
    border-radius:22px;
    padding:1rem 1.25rem;
    margin-bottom:1.5rem;
}

.error-title{
    font-size:14px;
    font-weight:700;
    color:#b91c1c;
    margin-bottom:6px;
}

.error-list{
    margin:0;
    padding-left:18px;
    color:#be123c;
    font-size:13px;
}

/* ====================================
CARD
==================================== */

.form-card{
    width:100%;
    background:white;
    border:1px solid var(--border);
    border-radius:30px;
    overflow:hidden;
    box-shadow:var(--shadow);
}

.form-header{
    padding:1.5rem 2rem;
    border-bottom:1px solid var(--border);
    background:
        linear-gradient(
            135deg,
            #f0fdf4 0%,
            #ffffff 100%
        );
}

.form-header h2{
    margin:0;
    font-size:15px;
    font-weight:700;
    color:var(--green-dark);
    text-transform:uppercase;
    letter-spacing:.06em;
}

.form-body{
    padding:2rem;
}

/* ====================================
SECTION
==================================== */

.section-title{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:1.5rem;
}

.section-icon{
    width:42px;
    height:42px;
    border-radius:14px;
    background:#f0fdf4;
    display:flex;
    align-items:center;
    justify-content:center;
}

.section-title h3{
    margin:0;
    font-size:20px;
    font-weight:700;
    color:var(--text);
}

.section-title p{
    margin:3px 0 0;
    font-size:13px;
    color:var(--muted);
}

/* ====================================
GRID
==================================== */

.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:1.5rem;
}

.full-width{
    grid-column:span 2;
}

/* ====================================
FORM
==================================== */

.form-group{
    display:flex;
    flex-direction:column;
}

.form-group label{
    margin-bottom:10px;
    font-size:12px;
    font-weight:700;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
}

.form-input,
.form-select,
.form-textarea{
    width:100%;
    border:1px solid var(--border);
    border-radius:16px;
    padding:14px 16px;
    font-size:14px;
    font-family:'IBM Plex Sans',sans-serif;
    color:var(--text);
    background:white;
    transition:.2s ease;
}

.form-input,
.form-select{
    height:56px;
}

.form-textarea{
    min-height:120px;
    resize:vertical;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus{
    outline:none;
    border-color:#16a34a;
    box-shadow:0 0 0 4px rgba(22,163,74,.10);
}

.form-input::placeholder,
.form-textarea::placeholder{
    color:var(--hint);
}

.form-hint{
    margin-top:8px;
    font-size:12px;
    color:var(--hint);
}

/* ====================================
DIVIDER
==================================== */

.section-divider{
    height:1px;
    background:var(--border);
    margin:2.5rem 0;
}

/* ====================================
BUTTONS
==================================== */

.form-actions{
    display:flex;
    justify-content:flex-end;
    gap:14px;
    margin-top:2rem;
}

.btn-secondary{
    height:54px;
    padding:0 24px;
    border-radius:16px;
    border:1px solid var(--border);
    background:white;
    color:var(--muted);
    font-size:14px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:10px;
    text-decoration:none;
    transition:.2s ease;
}

.btn-secondary:hover{
    background:#f8fafc;
}

.btn-primary{
    height:54px;
    padding:0 26px;
    border:none;
    border-radius:16px;
    background:linear-gradient(135deg,#16a34a,#15803d);
    color:white;
    font-size:14px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:10px;
    cursor:pointer;
    transition:.2s ease;
}

.btn-primary:hover{
    transform:translateY(-2px);
    box-shadow:0 14px 28px rgba(22,163,74,.20);
}

/* ====================================
RESPONSIVE
==================================== */

@media(max-width:992px){

    .siswa-page{
        padding:1.25rem;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .full-width{
        grid-column:span 1;
    }

    .form-actions{
        flex-direction:column;
    }

    .btn-primary,
    .btn-secondary{
        width:100%;
        justify-content:center;
    }

    .title-text h1{
        font-size:25px;
    }

}
</style>

<div class="siswa-page">

    {{-- HEADER --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                <svg width="30"
                     height="30"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="white"
                     stroke-width="2.2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>

            <div class="title-text">
                <h1>Tambah Siswa</h1>
                <p>
                    Lengkapi data siswa secara lengkap dan benar
                </p>
            </div>

        </div>

    </div>

    {{-- ERROR --}}
    @if ($errors->any())

    <div class="error-alert">

        <div>
            <svg width="22"
                 height="22"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="#dc2626"
                 stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>

        <div>

            <div class="error-title">
                Terjadi kesalahan pada pengisian form
            </div>

            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    </div>

    @endif

    {{-- FORM --}}
    <form action="{{ url('/staff_tu/siswa') }}"
          method="POST">

        @csrf

        <div class="form-card">

            <div class="form-header">
                <h2>Formulir Tambah Siswa</h2>
            </div>

            <div class="form-body">

                {{-- DATA SISWA --}}
                <div class="section-title">

                    <div class="section-icon">
                        <svg width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="#16a34a"
                             stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Data Siswa</h3>
                        <p>Informasi utama identitas siswa</p>
                    </div>

                </div>

                <div class="form-grid">

                    {{-- NISN --}}
                    <div class="form-group">
                        <label>NISN</label>

                        <input type="text"
                               name="nisn"
                               value="{{ old('nisn') }}"
                               class="form-input"
                               placeholder="Masukkan NISN"
                               required>

                        <div class="form-hint">
                            Nomor Induk Siswa Nasional
                        </div>
                    </div>

                    {{-- NIS --}}
                    <div class="form-group">
                        <label>NIS</label>

                        <input type="text"
                               name="nis"
                               value="{{ old('nis') }}"
                               class="form-input"
                               placeholder="Masukkan NIS"
                               required>

                        <div class="form-hint">
                            Nomor induk siswa internal sekolah
                        </div>
                    </div>

                    {{-- NAMA --}}
                    <div class="form-group">
                        <label>Nama Siswa</label>

                        <input type="text"
                               name="nama_siswa"
                               value="{{ old('nama_siswa') }}"
                               class="form-input"
                               placeholder="Masukkan nama siswa"
                               required>
                    </div>

                    {{-- JK --}}
                    <div class="form-group">
                        <label>Jenis Kelamin</label>

                        <select name="jenis_kelamin"
                                class="form-select"
                                required>

                            <option value="">-- Pilih --</option>

                            <option value="L"
                                {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="P"
                                {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>
                    </div>

                    {{-- TEMPAT --}}
                    <div class="form-group">
                        <label>Tempat Lahir</label>

                        <input type="text"
                               name="tempat_lahir"
                               value="{{ old('tempat_lahir') }}"
                               class="form-input"
                               placeholder="Masukkan tempat lahir"
                               required>
                    </div>

                    {{-- TANGGAL --}}
                    <div class="form-group">
                        <label>Tanggal Lahir</label>

                        <input type="date"
                               name="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}"
                               class="form-input"
                               required>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="form-group full-width">
                        <label>Alamat</label>

                        <textarea name="alamat"
                                  class="form-textarea"
                                  placeholder="Masukkan alamat lengkap siswa"
                                  required>{{ old('alamat') }}</textarea>
                    </div>

                    {{-- ROMBEL --}}
                    <div class="form-group full-width">
                        <label>Rombel (Opsional)</label>

                        <select name="rombel_id"
                                class="form-select">

                            <option value="">-- Pilih Rombel --</option>

                            @foreach($rombels as $rombel)
                                <option value="{{ $rombel->id }}"
                                    {{ old('rombel_id') == $rombel->id ? 'selected' : '' }}>

                                    {{ $rombel->tingkat_romawi }}
                                    {{ $rombel->kode_rombel }}
                                    -
                                    {{ $rombel->nama_rombel }}

                                </option>
                            @endforeach

                        </select>

                        <div class="form-hint">
                            Kosongkan jika belum memiliki rombel
                        </div>
                    </div>

                </div>

                <div class="section-divider"></div>

                {{-- ORANG TUA --}}
                <div class="section-title">

                    <div class="section-icon">
                        <svg width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="#16a34a"
                             stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="8.5" cy="7" r="4"/>
                            <path d="M20 8v6"/>
                            <path d="M23 11h-6"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Data Orang Tua</h3>
                        <p>Informasi keluarga siswa</p>
                    </div>

                </div>

                <div class="form-grid">

                    {{-- AYAH --}}
                    <div class="form-group">

                        <label>Nama Ayah</label>

                        <input type="text"
                               name="ayah"
                               value="{{ old('ayah') }}"
                               class="form-input"
                               placeholder="Masukkan nama ayah"
                               required>

                    </div>

                    {{-- IBU --}}
                    <div class="form-group">

                        <label>Nama Ibu</label>

                        <input type="text"
                               name="ibu"
                               value="{{ old('ibu') }}"
                               class="form-input"
                               placeholder="Masukkan nama ibu"
                               required>

                    </div>

                    {{-- WALI --}}
                    <div class="form-group full-width">

                        <label>Wali (Opsional)</label>

                        <input type="text"
                               name="wali"
                               value="{{ old('wali') }}"
                               class="form-input"
                               placeholder="Masukkan nama wali jika ada">

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="form-actions">

                    <a href="{{ url('/staff_tu/siswa') }}"
                       class="btn-secondary">

                        <svg width="16"
                             height="16"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>

                        Kembali

                    </a>

                    <button type="submit"
                            class="btn-primary">

                        <svg width="16"
                             height="16"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2.4">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>

                        Simpan Siswa

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection