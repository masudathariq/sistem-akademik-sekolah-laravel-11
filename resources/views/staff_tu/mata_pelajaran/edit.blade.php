@extends('layouts.staff_tu')

@section('title', 'Edit Mata Pelajaran')

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
    background: var(--navy-md);
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
    background: var(--navy);
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
.current-data {
    background: var(--navy-lt);
    border: 1px solid #bfdbfe;
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1.25rem;
}
.current-item {
    margin-bottom: 12px;
}
.current-item:last-child {
    margin-bottom: 0;
}
.current-label {
    font-size: 10px;
    font-weight: 600;
    color: var(--navy-md);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 4px;
}
.current-value {
    font-size: 14px;
    font-weight: 700;
    color: var(--navy);
    word-break: break-word;
}
.preview-changes {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}
.preview-title {
    font-size: 11px;
    font-weight: 600;
    color: var(--muted);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.preview-box {
    background: var(--gray-bg);
    border-radius: 10px;
    padding: 12px;
}
.preview-item {
    margin-bottom: 8px;
}
.preview-item:last-child {
    margin-bottom: 0;
}
.preview-label {
    font-size: 9px;
    font-weight: 600;
    color: var(--hint);
    text-transform: uppercase;
    margin-bottom: 2px;
}
.preview-value {
    font-size: 13px;
    font-weight: 600;
    color: var(--text);
}
.preview-old {
    font-size: 11px;
    color: var(--hint);
    text-decoration: line-through;
    margin-left: 8px;
}
.changed {
    color: var(--amber);
}
.changed .preview-value {
    color: var(--amber);
}
.no-change {
    color: var(--green);
}
.no-change .preview-value {
    color: var(--green);
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
                <h1>Edit Mata Pelajaran</h1>
                <p>Perbaharui data mata pelajaran yang tersedia &mdash; <strong>Formulir Edit</strong></p>
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
                <h2>✏️ Edit Data Mata Pelajaran</h2>
            </div>

            <div class="form-body">
                <form action="{{ route('staff_tu.mata_pelajaran.update', $mata_pelajaran->id) }}" method="POST" id="editForm">
                    @csrf
                    @method('PUT')

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
                               value="{{ old('kode_mapel', $mata_pelajaran->kode_mapel) }}"
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
                               value="{{ old('nama_mapel', $mata_pelajaran->nama_mapel) }}"
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
                            Update Mapel
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
                    Preview Perubahan
                </h3>
            </div>
            <div class="info-body">
                {{-- Data Saat Ini --}}
                <div class="current-data">
                    <div class="current-item">
                        <div class="current-label">📌 Data Saat Ini</div>
                    </div>
                    <div class="current-item">
                        <div class="current-label">Kode Mapel</div>
                        <div class="current-value" id="currentKode">{{ $mata_pelajaran->kode_mapel }}</div>
                    </div>
                    <div class="current-item">
                        <div class="current-label">Nama Mapel</div>
                        <div class="current-value" id="currentNama">{{ $mata_pelajaran->nama_mapel }}</div>
                    </div>
                </div>

                {{-- Preview Perubahan --}}
                <div class="preview-changes">
                    <div class="preview-title">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                        </svg>
                        Yang akan diubah
                    </div>
                    <div class="preview-box">
                        <div class="preview-item" id="previewKodeItem">
                            <div class="preview-label">Kode Mapel</div>
                            <div class="preview-value" id="previewKode">{{ $mata_pelajaran->kode_mapel }}</div>
                        </div>
                        <div class="preview-item" id="previewNamaItem">
                            <div class="preview-label">Nama Mapel</div>
                            <div class="preview-value" id="previewNama">{{ $mata_pelajaran->nama_mapel }}</div>
                        </div>
                    </div>
                    <div class="preview-status" id="statusMessage" style="margin-top: 12px; font-size: 11px; text-align: center; padding: 6px; border-radius: 8px; background: var(--gray-bg);">
                        <span id="statusText">✅ Tidak ada perubahan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Script Preview dengan Indikator Perubahan --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kodeInput = document.getElementById('kode_mapel');
        const namaInput = document.getElementById('nama_mapel');
        
        const currentKode = "{{ $mata_pelajaran->kode_mapel }}";
        const currentNama = "{{ $mata_pelajaran->nama_mapel }}";
        
        const previewKode = document.getElementById('previewKode');
        const previewNama = document.getElementById('previewNama');
        const previewKodeItem = document.getElementById('previewKodeItem');
        const previewNamaItem = document.getElementById('previewNamaItem');
        const statusText = document.getElementById('statusText');
        
        function updatePreview() {
            const newKode = kodeInput.value.trim();
            const newNama = namaInput.value.trim();
            
            // Update preview values
            previewKode.textContent = newKode || '(kosong)';
            previewNama.textContent = newNama || '(kosong)';
            
            // Check changes for Kode
            const kodeChanged = newKode !== currentKode;
            if (kodeChanged) {
                previewKodeItem.classList.add('changed');
                previewKodeItem.classList.remove('no-change');
            } else {
                previewKodeItem.classList.add('no-change');
                previewKodeItem.classList.remove('changed');
            }
            
            // Check changes for Nama
            const namaChanged = newNama !== currentNama;
            if (namaChanged) {
                previewNamaItem.classList.add('changed');
                previewNamaItem.classList.remove('no-change');
            } else {
                previewNamaItem.classList.add('no-change');
                previewNamaItem.classList.remove('changed');
            }
            
            // Update status message
            if (kodeChanged || namaChanged) {
                let changes = [];
                if (kodeChanged) changes.push('Kode Mapel');
                if (namaChanged) changes.push('Nama Mapel');
                statusText.innerHTML = `⚠️ Akan mengubah: ${changes.join(' & ')}`;
                statusText.style.color = 'var(--amber)';
            } else {
                statusText.innerHTML = '✅ Tidak ada perubahan';
                statusText.style.color = 'var(--green)';
            }
        }
        
        kodeInput.addEventListener('input', updatePreview);
        namaInput.addEventListener('input', updatePreview);
        
        // Initial call
        updatePreview();
    });
</script>

@endsection