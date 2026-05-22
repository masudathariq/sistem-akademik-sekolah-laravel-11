@extends('layouts.staff_tu')

@section('title', 'Tambah Surat Masuk')

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

.surat-page{
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
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 14px 30px rgba(37,99,235,.22);
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
            #eff6ff 0%,
            #ffffff 100%
        );
}

.form-header h2{
    margin:0;
    font-size:15px;
    font-weight:700;
    color:var(--navy);
    text-transform:uppercase;
    letter-spacing:.06em;
}

.form-body{
    padding:2rem;
}

/* ====================================
INFO BOX
==================================== */

.info-box{
    display:flex;
    align-items:center;
    gap:16px;
    padding:1.25rem;
    border-radius:22px;
    background:linear-gradient(135deg,#eff6ff,#ffffff);
    border:1px solid #bfdbfe;
    margin-bottom:2rem;
}

.info-icon{
    width:58px;
    height:58px;
    border-radius:18px;
    background:white;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 8px 24px rgba(37,99,235,.10);
    flex-shrink:0;
}

.info-content h3{
    margin:0;
    font-size:18px;
    font-weight:700;
    color:var(--navy);
}

.info-content p{
    margin-top:5px;
    font-size:13px;
    color:var(--muted);
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
    background:#eff6ff;
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

.required{
    color:var(--red);
}

.form-input,
.form-select,
.form-textarea,
.form-file{
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
.form-select,
.form-file{
    height:56px;
}

.form-textarea{
    min-height:130px;
    resize:vertical;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus,
.form-file:focus{
    outline:none;
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,.10);
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

.input-error{
    border-color:#dc2626 !important;
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
    justify-content:space-between;
    align-items:center;
    gap:14px;
    margin-top:2rem;
    flex-wrap:wrap;
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
    padding:0 28px;
    border:none;
    border-radius:16px;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
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
    box-shadow:0 14px 28px rgba(37,99,235,.20);
}

/* ====================================
RESPONSIVE
==================================== */

@media(max-width:992px){

    .surat-page{
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

<div class="surat-page">

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
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
            </div>

            <div class="title-text">
                <h1>Tambah Surat Masuk</h1>
                <p>
                    Kelola dan arsipkan surat masuk secara profesional
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
    <form action="{{ route('staff_tu.surat_masuk.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="form-card">

            <div class="form-header">
                <h2>Formulir Surat Masuk</h2>
            </div>

            <div class="form-body">

                {{-- INFO --}}
                <div class="info-box">

                    <div class="info-icon">
                        <svg width="24"
                             height="24"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="#2563eb"
                             stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                    </div>

                    <div class="info-content">
                        <h3>Tambah Arsip Surat Masuk</h3>
                        <p>
                            Lengkapi seluruh informasi surat masuk dengan benar.
                        </p>
                    </div>

                </div>

                {{-- DATA SURAT --}}
                <div class="section-title">

                    <div class="section-icon">
                        <svg width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="#2563eb"
                             stroke-width="2">
                            <path d="M21 15V6"/>
                            <path d="M18.5 18.5A2.5 2.5 0 0 1 16 21H8a2 2 0 0 1-2-2V5"/>
                            <path d="M8 5a2 2 0 0 1 2-2h8"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Data Surat</h3>
                        <p>Informasi utama surat masuk</p>
                    </div>

                </div>

                <div class="form-grid">

                    {{-- NOMOR --}}
                    <div class="form-group">

                        <label>
                            Nomor Surat
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="nomor_surat"
                               value="{{ old('nomor_surat') }}"
                               class="form-input @error('nomor_surat') input-error @enderror"
                               placeholder="Masukkan nomor surat"
                               required>

                        @error('nomor_surat')
                            <div class="form-hint" style="color:#dc2626;">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- JENIS --}}
                    <div class="form-group">

                        <label>Jenis Surat</label>

                        <select name="jenis"
                                class="form-select @error('jenis') input-error @enderror">

                            <option value="">-- Pilih Jenis --</option>

                            @foreach(['Surat Dinas','Surat Undangan','Surat Edaran','Surat Keterangan','Surat Pemberitahuan','Lainnya'] as $jenis)

                                <option value="{{ $jenis }}"
                                    {{ old('jenis') == $jenis ? 'selected' : '' }}>

                                    {{ $jenis }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- TANGGAL SURAT --}}
                    <div class="form-group">

                        <label>
                            Tanggal Surat
                            <span class="required">*</span>
                        </label>

                        <input type="date"
                               name="tanggal_surat"
                               value="{{ old('tanggal_surat') }}"
                               class="form-input @error('tanggal_surat') input-error @enderror"
                               required>

                    </div>

                    {{-- TANGGAL DITERIMA --}}
                    <div class="form-group">

                        <label>
                            Tanggal Diterima
                            <span class="required">*</span>
                        </label>

                        <input type="date"
                               name="tanggal_diterima"
                               value="{{ old('tanggal_diterima', date('Y-m-d')) }}"
                               class="form-input @error('tanggal_diterima') input-error @enderror"
                               required>

                    </div>

                    {{-- PENGIRIM --}}
                    <div class="form-group">

                        <label>
                            Pengirim
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="pengirim"
                               value="{{ old('pengirim') }}"
                               class="form-input @error('pengirim') input-error @enderror"
                               placeholder="Masukkan nama pengirim"
                               required>

                    </div>

                    {{-- DITERUSKAN --}}
                    <div class="form-group">

                        <label>Diteruskan Ke</label>

                        <input type="text"
                               name="diteruskan_ke"
                               value="{{ old('diteruskan_ke') }}"
                               class="form-input"
                               placeholder="Contoh: Kepala Sekolah">

                    </div>

                    {{-- PERIHAL --}}
                    <div class="form-group full-width">

                        <label>
                            Perihal
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="perihal"
                               value="{{ old('perihal') }}"
                               class="form-input @error('perihal') input-error @enderror"
                               placeholder="Masukkan perihal surat"
                               required>

                    </div>

                    {{-- ISI --}}
                    <div class="form-group full-width">

                        <label>Isi Surat</label>

                        <textarea name="isi"
                                  class="form-textarea"
                                  placeholder="Ringkasan isi surat...">{{ old('isi') }}</textarea>

                    </div>

                </div>

                <div class="section-divider"></div>

                {{-- LAMPIRAN --}}
                <div class="section-title">

                    <div class="section-icon">
                        <svg width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="#2563eb"
                             stroke-width="2">
                            <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.9-9.9a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.82-2.82l8.49-8.48"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Lampiran & Status</h3>
                        <p>Upload file dan pengaturan status surat</p>
                    </div>

                </div>

                <div class="form-grid">

                    {{-- LAMPIRAN --}}
                    <div class="form-group">

                        <label>Lampiran</label>

                        <input type="file"
                               name="lampiran"
                               class="form-file @error('lampiran') input-error @enderror"
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">

                        <div class="form-hint">
                            Format: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)
                        </div>

                    </div>

                    {{-- STATUS --}}
                    <div class="form-group">

                        <label>
                            Status
                            <span class="required">*</span>
                        </label>

                        <select name="status"
                                class="form-select @error('status') input-error @enderror"
                                required>

                            <option value="Belum Dibaca"
                                {{ old('status','Belum Dibaca') == 'Belum Dibaca' ? 'selected' : '' }}>
                                Belum Dibaca
                            </option>

                            <option value="Sudah Dibaca"
                                {{ old('status') == 'Sudah Dibaca' ? 'selected' : '' }}>
                                Sudah Dibaca
                            </option>

                        </select>

                    </div>

                    {{-- CATATAN --}}
                    <div class="form-group full-width">

                        <label>Catatan</label>

                        <textarea name="catatan"
                                  class="form-textarea"
                                  placeholder="Catatan tambahan...">{{ old('catatan') }}</textarea>

                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-actions">

                    <a href="{{ route('staff_tu.surat_masuk.index') }}"
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

                        Simpan Surat

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection