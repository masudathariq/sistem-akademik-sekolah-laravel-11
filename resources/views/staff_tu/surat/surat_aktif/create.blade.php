@extends('layouts.staff_tu')

@section('title', 'Buat Surat Keterangan Aktif')

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

body { font-family: 'IBM Plex Sans', sans-serif; background: var(--gray-bg); }

.rb-page {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    padding-bottom: 4rem;
    color: var(--text);
}

/* ── BACK BUTTON ── */
.btn-back {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 500; color: var(--muted);
    text-decoration: none; margin-bottom: 1.5rem;
    transition: all .15s;
}
.btn-back:hover { color: var(--navy-md); gap: 10px; }

/* ── TOP BAR ── */
.top-bar {
    margin-bottom: 1.75rem;
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
    width: 32px; height: 32px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.form-header h3 {
    font-size: 14px; font-weight: 600; color: var(--text);
    margin: 0;
}
.form-header p {
    font-size: 11px; color: var(--hint);
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
.form-select {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 13px;
    font-family: 'IBM Plex Sans', sans-serif;
    background: white;
    cursor: pointer;
    transition: all .15s ease;
}
.form-select:focus {
    outline: none;
    border-color: var(--navy-md);
    box-shadow: 0 0 0 3px rgba(29,78,216,.1);
}
.form-select:disabled {
    background: var(--gray-bg);
    color: var(--hint);
    cursor: not-allowed;
}
.form-hint {
    font-size: 10px;
    color: var(--hint);
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.step-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    background: var(--navy-lt);
    color: var(--navy-md);
    border-radius: 99px;
    font-size: 10px;
    font-weight: 700;
    margin-right: 6px;
}
.loading-spinner {
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 2px solid var(--border);
    border-top-color: var(--navy-md);
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
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

/* ── FORM ACTIONS ── */
.form-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 0.5rem;
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
.text-hint {
    font-size: 11px;
    color: var(--hint);
}
.text-hint .required-star {
    color: var(--red);
    font-weight: bold;
}

@media (max-width: 640px) {
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
        gap: 12px;
    }
    .btn-submit, .btn-cancel {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="rb-page">

    {{-- ═══ BACK BUTTON ═══ --}}
    <a href="{{ route('staff_tu.surat-aktif.index') }}" class="btn-back">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Kembali ke Daftar Surat
    </a>

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                    <path d="M4 4v16h16V4H4z"/>
                    <path d="M8 8h8M8 12h6M8 16h4"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Buat Surat Keterangan Aktif</h1>
                <p>Buat surat keterangan aktif untuk siswa &mdash; <strong>Formulir Pendaftaran</strong></p>
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
    <form action="{{ route('staff_tu.surat-aktif.store') }}" method="POST" id="suratForm">
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
                        <div class="form-hint">Nomor surat harus unik</div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Surat <span class="required">*</span></label>
                        <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat') }}"
                               class="form-input" required>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 2: Pilih Siswa --}}
        <div class="form-card">
            <div class="form-header">
                <div class="form-header-icon" style="background: #e0e7ff;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4338ca" stroke-width="2">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h3>Pilih Siswa</h3>
                    <p>Pilih rombel terlebih dahulu, lalu pilih nama siswa</p>
                </div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    {{-- Step 1: Pilih Rombel --}}
                    <div class="form-group form-group-full">
                        <label><span class="step-badge">1</span> Pilih Rombel</label>
                        <select id="rombel" class="form-select" required>
                            <option value="">-- Pilih Rombel --</option>
                            @foreach($rombels as $rombel)
                                <option value="{{ $rombel->id }}">
                                    {{ $rombel->tingkat_romawi }} - {{ $rombel->nama_rombel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Step 2: Pilih Siswa --}}
                    <div class="form-group form-group-full">
                        <label><span class="step-badge">2</span> Pilih Siswa <span class="required">*</span></label>
                        <select name="siswa_id" id="siswa" class="form-select" required disabled>
                            <option value="">-- Pilih rombel dulu --</option>
                        </select>
                        <div class="form-hint" id="siswaHint">
                            <span>🏫 Pilih rombel terlebih dahulu untuk menampilkan daftar siswa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ FORM ACTIONS ═══ --}}
        <div class="form-actions">
            <div class="text-hint">
                <span class="required-star">*</span> Wajib diisi
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('staff_tu.surat-aktif.index') }}" class="btn-cancel">
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

<script>
document.getElementById('rombel').addEventListener('change', function () {
    const rombelId = this.value;
    const siswaSelect = document.getElementById('siswa');
    const siswaHint = document.getElementById('siswaHint');

    if (!rombelId) {
        siswaSelect.innerHTML = '<option value="">-- Pilih rombel dulu --</option>';
        siswaSelect.disabled = true;
        siswaHint.innerHTML = '<span>🏫 Pilih rombel terlebih dahulu untuk menampilkan daftar siswa</span>';
        return;
    }

    // Show loading state
    siswaSelect.innerHTML = '<option value="" disabled>⏳ Memuat data siswa...</option>';
    siswaSelect.disabled = true;
    siswaHint.innerHTML = '<div class="loading-spinner"></div> <span>Memuat daftar siswa...</span>';

    fetch("{{ route('staff_tu.get-siswa', '') }}/" + rombelId)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            siswaSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>';

            if (data.length === 0) {
                siswaSelect.innerHTML += '<option value="" disabled>📭 Tidak ada siswa di rombel ini</option>';
                siswaHint.innerHTML = '<span>📭 Tidak ada siswa yang terdaftar di rombel ini.</span>';
                siswaSelect.disabled = true;
            } else {
                data.forEach(function (siswa) {
                    siswaSelect.innerHTML += `<option value="${siswa.id}">${siswa.nama_siswa}</option>`;
                });
                siswaSelect.disabled = false;
                siswaHint.innerHTML = `<span>✅ ${data.length} siswa ditemukan. Silakan pilih salah satu.</span>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            siswaSelect.innerHTML = '<option value="" disabled>❌ Gagal memuat data</option>';
            siswaSelect.disabled = true;
            siswaHint.innerHTML = '<span>❌ Gagal memuat data siswa. Silakan coba lagi.</span>';
        });
});
</script>

@endsection