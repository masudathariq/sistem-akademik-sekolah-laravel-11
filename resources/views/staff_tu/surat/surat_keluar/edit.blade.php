@extends('layouts.staff_tu')

@section('title', 'Edit Surat Keluar')

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
PREVIEW
==================================== */

.preview-card{
    display:flex;
    align-items:center;
    gap:18px;
    padding:1.25rem;
    border-radius:22px;
    background:linear-gradient(135deg,#f0fdf4,#ffffff);
    border:1px solid #bbf7d0;
    margin-bottom:2rem;
}

.preview-icon{
    width:70px;
    height:70px;
    border-radius:22px;
    background:linear-gradient(135deg,#16a34a,#15803d);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    flex-shrink:0;
    box-shadow:0 12px 24px rgba(22,163,74,.18);
}

.preview-content{
    flex:1;
}

.preview-label{
    font-size:12px;
    color:var(--muted);
    margin-bottom:5px;
}

.preview-title{
    font-size:22px;
    font-weight:700;
    color:var(--green-dark);
    margin-bottom:4px;
}

.preview-meta{
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

.input-error{
    border-color:#dc2626 !important;
}

/* ====================================
FILE CARD
==================================== */

.file-preview{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:1rem;
    padding:1rem;
    border-radius:18px;
    background:#f0fdf4;
    border:1px solid #bbf7d0;
    margin-bottom:1rem;
    flex-wrap:wrap;
}

.file-info small{
    display:block;
    color:var(--muted);
    margin-bottom:4px;
    font-size:11px;
}

.file-info strong{
    color:var(--green-dark);
    font-size:14px;
    word-break:break-word;
}

.file-btn{
    height:44px;
    padding:0 18px;
    border:none;
    border-radius:14px;
    background:#16a34a;
    color:white;
    font-size:13px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:8px;
    text-decoration:none;
    transition:.2s ease;
}

.file-btn:hover{
    background:#15803d;
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

    .preview-card{
        flex-direction:column;
        align-items:flex-start;
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
                    <path d="M12 18v-6"/>
                    <path d="M9 15l3 3 3-3"/>
                </svg>
            </div>

            <div class="title-text">
                <h1>Edit Surat Keluar</h1>
                <p>
                    Perbaharui dan kelola arsip surat keluar secara profesional
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
    <form action="{{ route('staff_tu.surat_keluar.update', $suratKeluar) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-card">

            <div class="form-header">
                <h2>Formulir Edit Surat Keluar</h2>
            </div>

            <div class="form-body">

                {{-- PREVIEW --}}
                <div class="preview-card">

                    <div class="preview-icon">
                        <svg width="32"
                             height="32"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="white"
                             stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                    </div>

                    <div class="preview-content">

                        <div class="preview-label">
                            Surat yang sedang diedit
                        </div>

                        <div class="preview-title">
                            {{ $suratKeluar->perihal }}
                        </div>

                        <div class="preview-meta">
                            Nomor Surat:
                            {{ $suratKeluar->nomor_surat }}
                            •
                            Tujuan:
                            {{ $suratKeluar->tujuan }}
                        </div>

                    </div>

                </div>

                {{-- IDENTITAS --}}
                <div class="section-title">

                    <div class="section-icon">
                        <svg width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="#16a34a"
                             stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Identitas Surat</h3>
                        <p>Informasi utama surat keluar</p>
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
                               value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}"
                               class="form-input {{ $errors->has('nomor_surat') ? 'input-error' : '' }}"
                               required>

                    </div>

                    {{-- JENIS --}}
                    <div class="form-group">

                        <label>Jenis Surat</label>

                        <select name="jenis"
                                class="form-select">

                            <option value="">-- Pilih Jenis --</option>

                            @foreach([
                                'Surat Undangan',
                                'Surat Edaran',
                                'Surat Keterangan',
                                'Surat Tugas',
                                'Surat Keputusan',
                                'Surat Pemberitahuan',
                                'Surat Permohonan',
                                'Surat Pengantar',
                                'Lainnya'
                            ] as $jenis)

                                <option value="{{ $jenis }}"
                                    {{ old('jenis', $suratKeluar->jenis) == $jenis ? 'selected' : '' }}>

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
                               value="{{ old('tanggal_surat', $suratKeluar->tanggal_surat->format('Y-m-d')) }}"
                               class="form-input"
                               required>

                    </div>

                    {{-- TANGGAL KELUAR --}}
                    <div class="form-group">

                        <label>
                            Tanggal Keluar
                            <span class="required">*</span>
                        </label>

                        <input type="date"
                               name="tanggal_keluar"
                               value="{{ old('tanggal_keluar', $suratKeluar->tanggal_keluar->format('Y-m-d')) }}"
                               class="form-input"
                               required>

                    </div>

                    {{-- TUJUAN --}}
                    <div class="form-group">

                        <label>
                            Tujuan
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="tujuan"
                               value="{{ old('tujuan', $suratKeluar->tujuan) }}"
                               class="form-input"
                               required>

                    </div>

                    {{-- PENANDATANGAN --}}
                    <div class="form-group">

                        <label>Penandatangan</label>

                        <select name="penandatangan"
                                class="form-select">

                            <option value="">-- Pilih --</option>

                            @foreach([
                                'Kepala Sekolah',
                                'Wakil Kepala Sekolah',
                                'Kepala Tata Usaha',
                                'Lainnya'
                            ] as $ttd)

                                <option value="{{ $ttd }}"
                                    {{ old('penandatangan', $suratKeluar->penandatangan) == $ttd ? 'selected' : '' }}>

                                    {{ $ttd }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- PERIHAL --}}
                    <div class="form-group full-width">

                        <label>
                            Perihal
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="perihal"
                               value="{{ old('perihal', $suratKeluar->perihal) }}"
                               class="form-input"
                               required>

                    </div>

                </div>

                <div class="section-divider"></div>

                {{-- ISI --}}
                <div class="section-title">

                    <div class="section-icon">
                        <svg width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="#16a34a"
                             stroke-width="2">
                            <line x1="8" y1="6" x2="21" y2="6"/>
                            <line x1="8" y1="12" x2="21" y2="12"/>
                            <line x1="8" y1="18" x2="21" y2="18"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Isi & Keterangan</h3>
                        <p>Ringkasan isi surat dan catatan tambahan</p>
                    </div>

                </div>

                <div class="form-grid">

                    {{-- ISI --}}
                    <div class="form-group full-width">

                        <label>Isi Surat</label>

                        <textarea name="isi"
                                  class="form-textarea">{{ old('isi', $suratKeluar->isi) }}</textarea>

                    </div>

                    {{-- KETERANGAN --}}
                    <div class="form-group full-width">

                        <label>Keterangan</label>

                        <textarea name="keterangan"
                                  class="form-textarea"
                                  placeholder="Keterangan tambahan...">{{ old('keterangan', $suratKeluar->keterangan) }}</textarea>

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
                             stroke="#16a34a"
                             stroke-width="2">
                            <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Lampiran & Status</h3>
                        <p>Kelola file dan status surat</p>
                    </div>

                </div>

                <div class="form-grid">

                    {{-- LAMPIRAN --}}
                    <div class="form-group full-width">

                        <label>Lampiran</label>

                        @if($suratKeluar->lampiran)

                        <div class="file-preview">

                            <div class="file-info">

                                <small>File Saat Ini</small>

                                <strong>
                                    {{ $suratKeluar->lampiran_nama }}
                                </strong>

                            </div>

                            <a href="{{ route('staff_tu.surat_keluar.download', $suratKeluar) }}"
                               class="file-btn">

                                <svg width="15"
                                     height="15"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="7 10 12 15 17 10"/>
                                    <line x1="12" y1="15" x2="12" y2="3"/>
                                </svg>

                                Download

                            </a>

                        </div>

                        @endif

                        <input type="file"
                               name="lampiran"
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                               class="form-file">

                        <div class="form-hint">
                            PDF, DOC, DOCX, JPG, PNG · Maks. 5MB
                            @if($suratKeluar->lampiran)
                                <br>Kosongkan jika tidak ingin mengganti file lampiran
                            @endif
                        </div>

                    </div>

                    {{-- STATUS --}}
                    <div class="form-group">

                        <label>
                            Status
                            <span class="required">*</span>
                        </label>

                        <select name="status"
                                class="form-select"
                                required>

                            <option value="Draf"
                                {{ old('status', $suratKeluar->status) == 'Draf' ? 'selected' : '' }}>
                                Draf
                            </option>

                            <option value="Terkirim"
                                {{ old('status', $suratKeluar->status) == 'Terkirim' ? 'selected' : '' }}>
                                Terkirim
                            </option>

                        </select>

                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-actions">

                    <a href="{{ route('staff_tu.surat_keluar.index') }}"
                       class="btn-secondary">

                        <svg width="16"
                             height="16"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>

                        Batal

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

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection