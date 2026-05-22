@extends('layouts.staff_tu')

@section('title', 'Buat Surat Keterangan Pindah')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&display=swap');

*{box-sizing:border-box;}

:root {
    --navy:     #1e3a8a;
    --navy-md:  #1d4ed8;
    --navy-lt:  #dbeafe;
    --green:    #16a34a;
    --green-lt: #f0fdf4;
    --green-bd: #86efac;
    --red:      #dc2626;
    --red-lt:   #fff1f2;
    --red-bd:   #fecdd3;
    --pink:     #be185d;
    --pink-lt:  #fdf2f8;
    --pink-bd:  #f9a8d4;
    --amber:    #d97706;
    --amber-lt: #fffbeb;
    --amber-bd: #fcd34d;
    --gray-bg:  #f8fafc;
    --border:   #e2e8f0;
    --text:     #1e293b;
    --muted:    #64748b;
    --hint:     #94a3b8;
    --radius:   12px;
    --shadow:   0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.04);
}

body { font-family: 'IBM Plex Sans', sans-serif; }

.rb-page {
    background: var(--gray-bg);
    min-height: 100vh;
    padding: 2rem;
    padding-bottom: 4rem;
    color: var(--text);
}

/* ── TOP BAR ── */
.top-bar {
    display: flex; align-items: center;
    justify-content: space-between; gap: 1rem;
    margin-bottom: 1.75rem;
    flex-wrap: wrap;
}
.page-title { display: flex; align-items: center; gap: 12px; }
.title-icon {
    width: 44px; height: 44px; background: var(--navy-lt);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.title-text h1 {
    font-size: 20px; font-weight: 600; color: var(--text);
    margin: 0 0 3px; letter-spacing: -.02em;
}
.title-text p { font-size: 13px; color: var(--muted); margin: 0; }
.title-text p strong { color: var(--navy-md); font-weight: 600; }

/* ── BACK BUTTON ── */
.btn-back {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 500; color: var(--muted);
    text-decoration: none; margin-bottom: 1rem;
    transition: all .15s;
}
.btn-back:hover { color: var(--navy-md); gap: 10px; }

/* ── FORM CARD ── */
.form-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.form-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
    display: flex;
    align-items: center;
    gap: 12px;
}
.form-header-icon {
    width: 32px;
    height: 32px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.form-header h3 {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
    margin: 0;
}
.form-header p {
    font-size: 11px;
    color: var(--hint);
    margin: 2px 0 0;
}
.form-body {
    padding: 1.5rem;
}
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}
.form-group {
    margin-bottom: 0;
}
.form-group-full {
    grid-column: span 2;
}
.form-group label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 6px;
}
.form-group label .required {
    color: var(--red);
    margin-left: 2px;
}
.form-input {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 13px;
    font-family: 'IBM Plex Sans', sans-serif;
    background: white;
    transition: all .15s ease;
}
.form-input:focus {
    outline: none;
    border-color: var(--navy-md);
    box-shadow: 0 0 0 3px rgba(29,78,216,.1);
}
.form-input::placeholder {
    color: var(--hint);
    font-size: 12px;
}
textarea.form-input {
    resize: vertical;
    min-height: 80px;
}
.form-hint {
    font-size: 10px;
    color: var(--hint);
    margin-top: 4px;
}
.form-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}
.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 28px;
    background: var(--navy-md);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all .15s ease;
}
.btn-submit:hover {
    background: var(--navy);
    transform: translateY(-1px);
}
.btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    background: white;
    color: var(--muted);
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .15s ease;
}
.btn-cancel:hover {
    background: var(--gray-bg);
    color: var(--text);
}

/* ── ERROR ALERT ── */
.error-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 1rem;
    background: var(--red-lt);
    border: 1px solid var(--red-bd);
    border-radius: 10px;
    margin-bottom: 1.5rem;
}
.error-icon {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    color: var(--red);
}
.error-content {
    flex: 1;
}
.error-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--red);
    margin-bottom: 6px;
}
.error-list {
    margin: 0;
    padding-left: 1.25rem;
    font-size: 12px;
    color: #b91c1c;
}
.error-list li {
    margin-bottom: 2px;
}

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .rb-page {
        padding: 1rem;
    }
    .form-grid {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }
    .form-group-full {
        grid-column: span 1;
    }
    .form-actions {
        flex-direction: column-reverse;
        gap: 10px;
    }
    .btn-submit, .btn-cancel {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="rb-page">

    {{-- ═══ BACK BUTTON ═══ --}}
    <a href="{{ route('staff_tu.surat-pindah.index') }}" class="btn-back">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Kembali ke Daftar Surat
    </a>

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4v16h16V4H4z"/>
                    <path d="M8 8h8M8 12h6M8 16h4"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Buat Surat Keterangan Pindah</h1>
                <p>Lengkapi semua data di bawah ini untuk membuat surat pindah sekolah &mdash; <strong>Formulir Pendaftaran</strong></p>
            </div>
        </div>
    </div>

    {{-- ═══ ERROR VALIDASI ═══ --}}
    @if ($errors->any())
    <div class="error-alert">
        <div class="error-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="error-content">
            <div class="error-title">Mohon periksa kembali isian berikut:</div>
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ═══ FORM ═══ --}}
    <form action="{{ route('staff_tu.surat-pindah.store') }}" method="POST">
        @csrf

        {{-- SECTION 1: Data Surat --}}
        <div class="form-card">
            <div class="form-header">
                <div class="form-header-icon" style="background: var(--navy-lt);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h3>Data Surat</h3>
                    <p>Nomor dan tanggal penerbitan surat</p>
                </div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nomor Surat <span class="required">*</span></label>
                        <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}"
                               placeholder="Contoh: 001/MTs/2025"
                               class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Surat <span class="required">*</span></label>
                        <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat') }}"
                               class="form-input" required>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 2: Data Siswa --}}
        <div class="form-card">
            <div class="form-header">
                <div class="form-header-icon" style="background: #e0e7ff; color: #4338ca;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4338ca" stroke-width="2">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h3>Data Siswa</h3>
                    <p>Identitas lengkap siswa yang pindah</p>
                </div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Siswa <span class="required">*</span></label>
                        <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}"
                               placeholder="Nama lengkap siswa"
                               class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-input">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                               placeholder="Kota/Kabupaten"
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis" value="{{ old('nis') }}"
                               placeholder="Nomor Induk Siswa"
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" name="nisn" value="{{ old('nisn') }}"
                               placeholder="Nomor Induk Siswa Nasional"
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Kelas Saat Ini</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}"
                               placeholder="Contoh: IX A"
                               class="form-input">
                    </div>
                    <div class="form-group form-group-full">
                        <label>Alamat Siswa</label>
                        <textarea name="alamat_siswa" class="form-input" rows="3"
                                  placeholder="Alamat lengkap tempat tinggal siswa">{{ old('alamat_siswa') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 3: Data Orang Tua / Wali --}}
        <div class="form-card">
            <div class="form-header">
                <div class="form-header-icon" style="background: #d1fae5; color: #059669;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2">
                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3>Data Orang Tua / Wali</h3>
                    <p>Informasi wali yang bertanggung jawab</p>
                </div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Wali</label>
                        <input type="text" name="nama_wali" value="{{ old('nama_wali') }}"
                               placeholder="Nama lengkap orang tua/wali"
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan Wali</label>
                        <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}"
                               placeholder="Contoh: Wiraswasta"
                               class="form-input">
                    </div>
                    <div class="form-group form-group-full">
                        <label>Alamat Wali</label>
                        <textarea name="alamat_wali" class="form-input" rows="3"
                                  placeholder="Alamat lengkap orang tua/wali">{{ old('alamat_wali') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 4: Data Pindah Sekolah --}}
        <div class="form-card">
            <div class="form-header">
                <div class="form-header-icon" style="background: #fed7aa; color: #c2410c;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c2410c" stroke-width="2">
                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h3>Data Pindah Sekolah</h3>
                    <p>Tujuan dan alasan kepindahan</p>
                </div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Sekolah Tujuan</label>
                        <input type="text" name="sekolah_tujuan" value="{{ old('sekolah_tujuan') }}"
                               placeholder="Nama sekolah tujuan"
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Alasan Pindah</label>
                        <input type="text" name="alasan_pindah" value="{{ old('alasan_pindah') }}"
                               placeholder="Contoh: Ikut orang tua pindah domisili"
                               class="form-input">
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ FORM ACTIONS ═══ --}}
        <div class="form-actions">
            <div>
                <p class="text-xs text-hint"><span class="text-red">*</span> Wajib diisi</p>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('staff_tu.surat-pindah.index') }}" class="btn-cancel">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" class="btn-submit">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Surat
                </button>
            </div>
        </div>

    </form>

</div>

@endsection