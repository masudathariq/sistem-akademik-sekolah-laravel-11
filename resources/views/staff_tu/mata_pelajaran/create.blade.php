@extends('layouts.staff_tu')

@section('title', 'Tambah Mata Pelajaran')

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

/* ── MAIN CONTENT 2 KOLOM (DESKTOP) ── */
.content-wrapper {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
    flex-wrap: wrap;
}

/* ── FORM CARD (KIRI) ── */
.form-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    flex: 2;
    min-width: 300px;
}
.form-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.form-header h2 {
    font-size: 14px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin: 0;
}
.form-body {
    padding: 1.5rem;
}
.form-group {
    margin-bottom: 1.25rem;
}
.form-group label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 8px;
}
.form-group label .required {
    color: var(--red);
    margin-left: 2px;
}
.form-group label .optional {
    font-size: 10px;
    font-weight: 400;
    color: var(--hint);
    margin-left: 6px;
    text-transform: none;
}
.form-input {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 14px;
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
    font-size: 13px;
}
.form-hint {
    font-size: 11px;
    color: var(--hint);
    margin-top: 6px;
}
.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 1.5rem;
    padding-top: 0.5rem;
}
.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    background: var(--green);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all .15s ease;
    text-decoration: none;
}
.btn-primary:hover {
    background: #15803d;
    transform: translateY(-1px);
}
.btn-primary:active {
    transform: translateY(0);
}
.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    background: white;
    color: var(--muted);
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all .15s ease;
    text-decoration: none;
}
.btn-secondary:hover {
    background: var(--gray-bg);
    color: var(--text);
}

/* ── INFO PANEL (KANAN) ── */
.info-panel {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    flex: 1;
    min-width: 280px;
    position: sticky;
    top: 2rem;
}
.info-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.info-header h3 {
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.info-body {
    padding: 1.5rem;
}
.preview-card {
    background: var(--navy-lt);
    border: 1px solid #bfdbfe;
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1.25rem;
}
.preview-title {
    font-size: 10px;
    font-weight: 600;
    color: var(--navy-md);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.preview-value-large {
    font-size: 18px;
    font-weight: 700;
    color: var(--navy);
    word-break: break-word;
    line-height: 1.4;
}
.info-tips {
    margin-top: 1rem;
}
.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 8px 0;
    border-bottom: 1px solid var(--border);
}
.tip-item:last-child {
    border-bottom: none;
}
.tip-icon {
    width: 24px;
    height: 24px;
    background: var(--gray-bg);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.tip-text {
    font-size: 11px;
    color: var(--muted);
    line-height: 1.4;
}
.tip-text strong {
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

@media (max-width: 900px) {
    .rb-page {
        padding: 1rem;
    }
    .content-wrapper {
        flex-direction: column;
    }
    .info-panel {
        position: static;
        width: 100%;
    }
    .form-actions {
        flex-direction: column;
    }
    .btn-primary, .btn-secondary {
        justify-content: center;
    }
}
</style>

<div class="rb-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Tambah Mata Pelajaran</h1>
                <p>Tambahkan data mata pelajaran baru ke dalam sistem &mdash; <strong>Formulir Pendaftaran</strong></p>
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
            <div class="error-title">Terjadi kesalahan pada pengisian form</div>
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ═══ 2 KOLOM: FORM (KIRI) + INFO PANEL (KANAN) ═══ --}}
    <div class="content-wrapper">
        
        {{-- KOLOM KIRI: FORM CARD --}}
        <div class="form-card">
            <div class="form-header">
                <h2>📝 Formulir Mata Pelajaran Baru</h2>
            </div>

            <div class="form-body">
                <form action="{{ route('staff_tu.mata_pelajaran.store') }}" method="POST">
                    @csrf

                    {{-- Kode Mapel --}}
                    <div class="form-group">
                        <label>
                            Kode Mata Pelajaran
                            <span class="required">*</span>
                            <span class="optional">(unik)</span>
                        </label>
                        <input type="text"
                               name="kode_mapel"
                               id="kode_mapel"
                               class="form-input"
                               placeholder="Contoh: MTK-01, BHS-IND, IPA-7"
                               value="{{ old('kode_mapel') }}"
                               autocomplete="off"
                               required>
                        <div class="form-hint">
                            Kode unik untuk identifikasi mata pelajaran
                        </div>
                    </div>

                    {{-- Nama Mapel --}}
                    <div class="form-group">
                        <label>
                            Nama Mata Pelajaran
                            <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="nama_mapel"
                               id="nama_mapel"
                               class="form-input"
                               placeholder="Contoh: Matematika, Bahasa Indonesia, IPA"
                               value="{{ old('nama_mapel') }}"
                               autocomplete="off"
                               required>
                        <div class="form-hint">
                            Nama lengkap mata pelajaran yang akan diajarkan
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                                <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                            </svg>
                            Simpan Mapel
                        </button>
                        <a href="{{ route('staff_tu.mata_pelajaran.index') }}" class="btn-secondary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- KOLOM KANAN: INFO PANEL --}}
        <div class="info-panel">
            <div class="info-header">
                <h3>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                    Preview Data
                </h3>
            </div>
            <div class="info-body">
                {{-- Preview Card --}}
                <div class="preview-card">
                    <div class="preview-title">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                        </svg>
                        Akan Ditambahkan
                    </div>
                    <div class="preview-value-large" id="previewText">
                        <span style="color: var(--hint);">Belum diisi</span>
                    </div>
                </div>

                {{-- Tips & Informasi --}}
                <div class="info-tips">
                    <div class="tip-item">
                        <div class="tip-icon">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--navy-md)" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="16" x2="12" y2="12"/>
                                <line x1="12" y1="8" x2="12.01" y2="8"/>
                            </svg>
                        </div>
                        <div class="tip-text">
                            <strong>Kode Mapel</strong><br>
                            Gunakan kode yang unik dan mudah diingat, contoh: <code>MTK-01</code>, <code>BHS-ING</code>
                        </div>
                    </div>
                    <div class="tip-item">
                        <div class="tip-icon">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--navy-md)" stroke-width="2">
                                <path d="M4 4v16h16V4H4z"/>
                                <path d="M8 8h8M8 12h6M8 16h4"/>
                            </svg>
                        </div>
                        <div class="tip-text">
                            <strong>Nama Mapel</strong><br>
                            Tuliskan nama lengkap mata pelajaran sesuai kurikulum yang berlaku
                        </div>
                    </div>
                    <div class="tip-item">
                        <div class="tip-icon">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--navy-md)" stroke-width="2">
                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="tip-text">
                            <strong>Info</strong><br>
                            Mata pelajaran yang sudah ditambahkan dapat digunakan untuk menyusun jadwal mengajar
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Script Preview --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kodeMapel = document.getElementById('kode_mapel');
        const namaMapel = document.getElementById('nama_mapel');
        const previewText = document.getElementById('previewText');

        function updatePreview() {
            const kodeValue = kodeMapel.value.trim();
            const namaValue = namaMapel.value.trim();
            
            if (kodeValue && namaValue) {
                previewText.innerHTML = `<span style="color: var(--navy);">${escapeHtml(kodeValue)}</span><br><span style="font-size: 13px; color: var(--muted);">${escapeHtml(namaValue)}</span>`;
            } else if (kodeValue) {
                previewText.innerHTML = `<span style="color: var(--navy);">${escapeHtml(kodeValue)}</span><br><span style="font-size: 12px; color: var(--hint);">(nama mapel belum diisi)</span>`;
            } else if (namaValue) {
                previewText.innerHTML = `<span style="color: var(--navy);">${escapeHtml(namaValue)}</span><br><span style="font-size: 12px; color: var(--hint);">(kode mapel belum diisi)</span>`;
            } else {
                previewText.innerHTML = '<span style="color: var(--hint);">Belum diisi</span>';
            }
        }

        function escapeHtml(str) {
            return str.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        kodeMapel.addEventListener('input', updatePreview);
        namaMapel.addEventListener('input', updatePreview);

        // Panggil sekali untuk mengecek old values
        updatePreview();
    });
</script>

@endsection