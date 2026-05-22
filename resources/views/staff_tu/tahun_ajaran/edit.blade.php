@extends('layouts.staff_tu')

@section('title', 'Edit Tahun Ajaran')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&display=swap');
@import url('https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.19.0/dist/tabler-icons.min.css');

*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

:root {
    --navy:       #1e3a8a;
    --navy-md:    #1d4ed8;
    --navy-lt:    #dbeafe;
    --navy-xlt:   #eff6ff;
    --green:      #065f46;
    --green-lt:   #d1fae5;
    --amber:      #d97706;
    --amber-lt:   #fffbeb;
    --red:        #dc2626;
    --red-lt:     #fff1f2;
    --red-bd:     #fecdd3;
    --gray-bg:    #f1f5f9;
    --surface:    #ffffff;
    --border:     #e2e8f0;
    --border-md:  #cbd5e1;
    --text:       #0f172a;
    --muted:      #64748b;
    --hint:       #94a3b8;
    --radius-md:  8px;
    --radius-lg:  12px;
    --shadow-sm:  0 1px 2px rgba(0,0,0,.04);
    --shadow:     0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.04);
}

body {
    font-family: 'IBM Plex Sans', sans-serif;
    background: var(--gray-bg);
    color: var(--text);
}

/* PAGE */
.ta-page {
    padding: 2rem;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* BREADCRUMB */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--hint);
}

.breadcrumb i {
    font-size: 14px;
}

.breadcrumb a {
    color: var(--hint);
    text-decoration: none;
    transition: .15s;
}

.breadcrumb a:hover {
    color: var(--navy-md);
}

.breadcrumb .sep {
    color: var(--border-md);
}

.breadcrumb .current {
    color: var(--text);
    font-weight: 500;
}

/* HERO */
.page-hero {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    box-shadow: var(--shadow-sm);
}

.hero-icon {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: var(--navy-lt);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.hero-icon i {
    font-size: 26px;
    color: var(--navy-md);
}

.hero-content h1 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 4px;
}

.hero-content p {
    font-size: 13px;
    color: var(--muted);
    line-height: 1.5;
}

/* GRID */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 1.5rem;
    align-items: start;
}

/* FORM CARD */
.form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.form-card-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    background: #fafafa;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-card-header i {
    font-size: 16px;
    color: var(--muted);
}

.form-card-header span {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: var(--muted);
}

.form-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* ERROR */
.error-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 1rem;
    background: var(--red-lt);
    border: 1px solid var(--red-bd);
    border-radius: var(--radius-md);
}

.error-alert i {
    font-size: 18px;
    color: var(--red);
    flex-shrink: 0;
}

.error-title {
    font-size: 13px;
    font-weight: 600;
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

/* FIELD */
.field-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.field-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.field-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: var(--muted);
}

.field-label .req {
    color: var(--red);
}

.field-counter {
    font-size: 11px;
    color: var(--hint);
}

.field-input {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--border-md);
    border-radius: var(--radius-md);
    font-size: 14px;
    font-family: 'IBM Plex Sans', sans-serif;
    transition: .15s;
}

.field-input:focus {
    outline: none;
    border-color: var(--navy-md);
    box-shadow: 0 0 0 3px rgba(29,78,216,.1);
}

.field-input.is-error {
    border-color: var(--red);
}

.progress-bar {
    height: 3px;
    background: var(--border);
    border-radius: 999px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: var(--navy-md);
    transition: .2s;
}

.field-hint {
    font-size: 11px;
    color: var(--hint);
    display: flex;
    align-items: center;
    gap: 5px;
}

/* SEMESTER */
.semester-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.sem-card {
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    padding: 14px;
    cursor: pointer;
    transition: .15s;
    background: white;
    position: relative;
}

.sem-card:hover {
    border-color: var(--navy-md);
    background: var(--navy-xlt);
}

.sem-card.selected {
    border-color: var(--navy-md);
    background: var(--navy-xlt);
    border-width: 2px;
}

.sem-card.selected::after {
    content: '\ea5e';
    font-family: 'tabler-icons';
    position: absolute;
    top: 10px;
    right: 12px;
    font-size: 14px;
    color: var(--navy-md);
}

.sem-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
}

.sem-card.ganjil .sem-icon {
    background: var(--navy-lt);
}

.sem-card.ganjil .sem-icon i {
    color: var(--navy-md);
}

.sem-card.genap .sem-icon {
    background: var(--green-lt);
}

.sem-card.genap .sem-icon i {
    color: var(--green);
}

.sem-name {
    font-size: 14px;
    font-weight: 600;
}

.sem-period {
    font-size: 11px;
    color: var(--muted);
}

/* FOOTER */
.form-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border);
    background: #fafafa;
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn-save {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 20px;
    background: var(--amber);
    color: white;
    border: none;
    border-radius: var(--radius-md);
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: .15s;
}

.btn-save:hover {
    background: #b45309;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 11px 18px;
    background: transparent;
    color: var(--muted);
    border: 1px solid var(--border-md);
    border-radius: var(--radius-md);
    font-size: 13px;
    text-decoration: none;
}

.btn-back:hover {
    background: var(--gray-bg);
}

/* RIGHT PANEL */
.right-panel {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    position: sticky;
    top: 2rem;
}

/* PREVIEW */
.preview-card,
.info-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.preview-card-header {
    padding: .875rem 1.25rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 8px;
}

.preview-card-header span {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: var(--muted);
}

.preview-body {
    padding: 1.25rem;
}

.preview-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.preview-badge.ganjil {
    background: var(--navy-lt);
    color: var(--navy-md);
}

.preview-badge.genap {
    background: var(--green-lt);
    color: var(--green);
}

.preview-year {
    font-size: 30px;
    font-weight: 600;
    margin: .5rem 0 1rem;
}

.preview-rows {
    border-top: 1px solid var(--border);
}

.preview-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
    font-size: 13px;
}

.pr-label {
    color: var(--muted);
}

.pr-value {
    font-weight: 600;
}

.info-card {
    padding: 1.25rem;
}

.info-card-title {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: var(--hint);
    margin-bottom: 12px;
}

.info-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 12px;
    color: var(--muted);
    line-height: 1.6;
}

.info-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--navy-md);
    margin-top: 6px;
}

/* RESPONSIVE */
@media (max-width:1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }

    .right-panel {
        position: static;
    }
}

@media (max-width:640px) {
    .ta-page {
        padding: 1rem;
    }

    .semester-grid {
        grid-template-columns: 1fr;
    }

    .form-footer {
        flex-direction: column-reverse;
    }

    .btn-save,
    .btn-back {
        width: 100%;
    }
}
</style>

<div class="ta-page">

    {{-- BREADCRUMB --}}
    <nav class="breadcrumb">
        <i class="ti ti-home"></i>
        <a href="{{ url('/staff_tu/dashboard') }}">Dashboard</a>
        <span class="sep">›</span>
        <a href="{{ url('/staff_tu/tahun-ajaran') }}">Tahun Ajaran</a>
        <span class="sep">›</span>
        <span class="current">Edit Data</span>
    </nav>

    {{-- HERO --}}
    <div class="page-hero">
        <div class="hero-icon">
            <i class="ti ti-edit-circle"></i>
        </div>

        <div class="hero-content">
            <h1>Edit Tahun Ajaran</h1>
            <p>Perbaharui data tahun ajaran dan semester yang sudah terdaftar di sistem akademik.</p>
        </div>
    </div>

    <div class="content-grid">

        {{-- LEFT --}}
        <div>

            <div class="form-card">

                <div class="form-card-header">
                    <i class="ti ti-edit"></i>
                    <span>Formulir Edit Data</span>
                </div>

                <div class="form-body">

                    {{-- ERROR --}}
                    @if ($errors->any())
                    <div class="error-alert">
                        <i class="ti ti-alert-circle"></i>

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

                    <form action="{{ url('/staff_tu/tahun-ajaran/'.$tahunAjaran->id) }}"
                          method="POST"
                          id="form-ta">

                        @csrf
                        @method('PUT')

                        {{-- Tahun Ajaran --}}
                        <div class="field-group" style="margin-bottom:1.5rem;">

                            <div class="field-row">
                                <label class="field-label">
                                    Tahun Ajaran <span class="req">*</span>
                                </label>

                                <span class="field-counter" id="char-counter">
                                    {{ strlen(old('tahun_ajaran', $tahunAjaran->tahun_ajaran)) }}/9
                                </span>
                            </div>

                            <input type="text"
                                   name="tahun_ajaran"
                                   id="tahun_ajaran"
                                   value="{{ old('tahun_ajaran', $tahunAjaran->tahun_ajaran) }}"
                                   class="field-input"
                                   maxlength="9"
                                   placeholder="Contoh: 2024/2025"
                                   autocomplete="off"
                                   required>

                            <div class="progress-bar">
                                <div class="progress-fill"
                                     id="progress-fill"></div>
                            </div>

                            <p class="field-hint">
                                <i class="ti ti-info-circle"></i>
                                Format penulisan: YYYY/YYYY
                            </p>

                        </div>

                        {{-- Semester --}}
                        <div class="field-group">

                            <label class="field-label">
                                Semester <span class="req">*</span>
                            </label>

                            <input type="hidden"
                                   name="semester"
                                   id="semester-input"
                                   value="{{ old('semester', $tahunAjaran->semester) }}">

                            <div class="semester-grid">

                                <div class="sem-card ganjil"
                                     id="sem-ganjil"
                                     onclick="selectSem('Ganjil')">

                                    <div class="sem-icon">
                                        <i class="ti ti-sun"></i>
                                    </div>

                                    <div class="sem-name">Ganjil</div>
                                    <div class="sem-period">
                                        Juli — Desember
                                    </div>
                                </div>

                                <div class="sem-card genap"
                                     id="sem-genap"
                                     onclick="selectSem('Genap')">

                                    <div class="sem-icon">
                                        <i class="ti ti-snowflake"></i>
                                    </div>

                                    <div class="sem-name">Genap</div>
                                    <div class="sem-period">
                                        Januari — Juni
                                    </div>
                                </div>

                            </div>

                        </div>

                    </form>

                </div>

                <div class="form-footer">

                    <a href="{{ url('/staff_tu/tahun-ajaran') }}"
                       class="btn-back">

                        <i class="ti ti-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit"
                            form="form-ta"
                            class="btn-save">

                        <i class="ti ti-device-floppy"></i>
                        Update Data
                    </button>

                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="right-panel">

            {{-- PREVIEW --}}
            <div class="preview-card">

                <div class="preview-card-header">
                    <i class="ti ti-eye"></i>
                    <span>Pratinjau Data</span>
                </div>

                <div class="preview-body">

                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span class="preview-badge" id="prev-badge"></span>

                        <span style="font-size:11px;color:var(--hint);">
                            Status Perubahan
                        </span>
                    </div>

                    <div class="preview-year" id="prev-year"></div>

                    <div class="preview-rows">

                        <div class="preview-row">
                            <span class="pr-label">Tahun Ajaran</span>
                            <span class="pr-value" id="prev-ta"></span>
                        </div>

                        <div class="preview-row">
                            <span class="pr-label">Semester</span>
                            <span class="pr-value" id="prev-sem"></span>
                        </div>

                        <div class="preview-row">
                            <span class="pr-label">Periode</span>
                            <span class="pr-value" id="prev-period"></span>
                        </div>

                    </div>

                </div>

            </div>

            {{-- INFO --}}
            <div class="info-card">

                <p class="info-card-title">
                    Informasi Edit
                </p>

                <div class="info-list">

                    <div class="info-item">
                        <div class="info-dot"></div>
                        <p>Pastikan data tahun ajaran yang diperbaharui sudah benar sebelum disimpan.</p>
                    </div>

                    <div class="info-item">
                        <div class="info-dot"></div>
                        <p>Semester ganjil berlaku Juli hingga Desember.</p>
                    </div>

                    <div class="info-item">
                        <div class="info-dot"></div>
                        <p>Semester genap berlaku Januari hingga Juni.</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
(function () {

    const taInput = document.getElementById('tahun_ajaran');
    const semInput = document.getElementById('semester-input');

    const semGanjil = document.getElementById('sem-ganjil');
    const semGenap  = document.getElementById('sem-genap');

    const counter = document.getElementById('char-counter');
    const fill = document.getElementById('progress-fill');

    const prevBadge = document.getElementById('prev-badge');
    const prevYear = document.getElementById('prev-year');
    const prevTa = document.getElementById('prev-ta');
    const prevSem = document.getElementById('prev-sem');
    const prevPeriod = document.getElementById('prev-period');

    const PERIOD = {
        Ganjil: 'Juli – Desember',
        Genap: 'Januari – Juni'
    };

    taInput.addEventListener('input', function () {

        const len = this.value.length;

        counter.textContent = len + '/9';

        fill.style.width = Math.round(len / 9 * 100) + '%';

        updatePreview();

    });

    window.selectSem = function(val) {

        semInput.value = val;

        semGanjil.classList.toggle('selected', val === 'Ganjil');
        semGenap.classList.toggle('selected', val === 'Genap');

        updatePreview();
    }

    function updatePreview() {

        const ta = taInput.value.trim();
        const sem = semInput.value;

        prevBadge.textContent = sem || '-';
        prevBadge.className = 'preview-badge ' + (sem ? sem.toLowerCase() : '');

        prevYear.textContent = ta || '-';

        prevTa.textContent = ta || '-';
        prevSem.textContent = sem || '-';
        prevPeriod.textContent = PERIOD[sem] || '-';
    }

    fill.style.width =
        Math.round(taInput.value.length / 9 * 100) + '%';

    updatePreview();

    if (semInput.value) {
        selectSem(semInput.value);
    }

})();
</script>

@endsection