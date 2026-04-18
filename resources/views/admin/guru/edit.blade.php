@extends('layouts.admin')

@section('title', 'Edit Guru - ' . $guru->nama)

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap');

    :root {
        --bg-base: #f4f6fb;
        --bg-card: #ffffff;
        --bg-elevated: #f8f9fc;
        --bg-hover: #f0f3fb;
        --border: #e4e9f5;
        --border-active: #b8c5f0;
        --border-focus: #3b5bdb;
        --accent-primary: #3b5bdb;
        --accent-secondary: #6741d9;
        --accent-glow: rgba(59,91,219,0.12);
        --text-primary: #1a2151;
        --text-secondary: #5c6f9e;
        --text-muted: #a8b4d0;
        --success: #0c9e6e;
        --success-bg: #ecfdf5;
        --success-border: #a7f3d0;
        --danger: #dc2626;
        --danger-bg: #fef2f2;
        --danger-border: #fca5a5;
        --cyan-bg: #ecfeff;
        --cyan-border: #a5f3fc;
        --cyan: #0891b2;
        --pink-bg: #fdf2f8;
        --pink-border: #fbcfe8;
        --pink: #db2777;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .eg-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg-base);
        min-height: 100vh;
        padding: 2rem 1.5rem;
        color: var(--text-primary);
        background-image:
            radial-gradient(ellipse 80% 40% at 50% -10%, rgba(59,91,219,0.06) 0%, transparent 60%),
            radial-gradient(ellipse 40% 30% at 90% 5%, rgba(124,58,237,0.04) 0%, transparent 50%);
    }

    /* ── Breadcrumb ── */
    .eg-breadcrumb {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 0.4rem !important;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }
    .eg-breadcrumb a { color: var(--text-secondary); text-decoration: none; font-weight: 500; transition: color 0.15s; }
    .eg-breadcrumb a:hover { color: var(--accent-primary); }
    .eg-breadcrumb-sep { color: var(--text-muted); font-size: 0.65rem; }
    .eg-breadcrumb-current { color: var(--text-primary); font-weight: 600; }

    /* ── Page header ── */
    .eg-page-header {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 1rem !important;
        margin-bottom: 2rem !important;
    }
    .eg-title-group { display: flex !important; align-items: center !important; gap: 1rem !important; }
    .eg-avatar {
        width: 52px; height: 52px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 15px;
        display: grid; place-items: center;
        font-size: 1.3rem;
        font-weight: 800;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 4px 16px var(--accent-glow);
    }
    .eg-page-title    { font-size: 1.35rem; font-weight: 800; letter-spacing: -0.025em; color: var(--text-primary); }
    .eg-page-subtitle { font-size: 0.75rem; color: var(--text-secondary); margin-top: 3px; }

    .eg-btn-back {
        display: inline-flex !important; align-items: center !important; gap: 0.4rem !important;
        background: var(--bg-card);
        color: var(--text-secondary);
        border: 1.5px solid var(--border);
        padding: 0.575rem 1.1rem;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 1px 3px rgba(59,91,219,0.04);
    }
    .eg-btn-back:hover { border-color: var(--border-active); color: var(--text-primary); transform: translateY(-1px); }

    /* ── Section title ── */
    .eg-section-title {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-muted);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 0.875rem;
        display: flex; align-items: center; gap: 0.625rem;
    }
    .eg-section-title::after { content: ''; flex: 1; height: 1.5px; background: var(--border); border-radius: 2px; }

    /* ── Layout: form left + sidebar right ── */
    .eg-layout {
        display: grid !important;
        grid-template-columns: 1fr 260px !important;
        gap: 1.25rem !important;
        align-items: start !important;
    }
    @media (max-width: 860px) { .eg-layout { grid-template-columns: 1fr !important; } }

    /* ── Card ── */
    .eg-card {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(59,91,219,0.05);
        margin-bottom: 1.25rem;
    }
    .eg-card:last-child { margin-bottom: 0; }
    .eg-card-header {
        display: flex !important; align-items: center !important; gap: 0.625rem !important;
        padding: 0.9rem 1.25rem;
        border-bottom: 1.5px solid var(--border);
        background: var(--bg-elevated);
    }
    .eg-card-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        display: grid; place-items: center;
        flex-shrink: 0;
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        color: var(--accent-primary);
    }
    .eg-card-title { font-size: 0.82rem; font-weight: 700; color: var(--text-primary); }
    .eg-card-body  { padding: 1.25rem; }

    /* ── Form grid ── */
    .eg-form-grid {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1rem !important;
    }
    @media (max-width: 580px) { .eg-form-grid { grid-template-columns: 1fr !important; } }
    .eg-field-full { grid-column: 1 / -1 !important; }

    /* ── Form field ── */
    .eg-field { display: flex; flex-direction: column; gap: 0.35rem; }
    .eg-label {
        font-size: 0.68rem;
        font-weight: 700;
        color: var(--text-secondary);
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    .eg-label .eg-required { color: var(--danger); margin-left: 2px; }

    .eg-input, .eg-select, .eg-textarea {
        width: 100% !important;
        background: var(--bg-elevated) !important;
        border: 1.5px solid var(--border) !important;
        border-radius: 10px !important;
        padding: 0.6rem 0.875rem !important;
        font-size: 0.875rem !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        color: var(--text-primary) !important;
        outline: none !important;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s !important;
        -webkit-appearance: none !important;
        appearance: none !important;
    }
    .eg-input:focus, .eg-select:focus, .eg-textarea:focus {
        border-color: var(--border-focus) !important;
        box-shadow: 0 0 0 3px var(--accent-glow) !important;
        background: #ffffff !important;
    }
    .eg-input:hover, .eg-select:hover, .eg-textarea:hover {
        border-color: var(--border-active) !important;
    }
    .eg-input.mono { font-family: 'JetBrains Mono', monospace !important; font-size: 0.83rem !important; }
    .eg-textarea {
        resize: vertical !important;
        min-height: 90px !important;
        line-height: 1.6 !important;
    }
    .eg-select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%235c6f9e' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 0.875rem center !important;
        padding-right: 2.5rem !important;
        cursor: pointer !important;
    }
    .eg-select option { background: #fff; color: var(--text-primary); }

    /* Error state */
    .eg-input.is-error, .eg-select.is-error, .eg-textarea.is-error {
        border-color: var(--danger) !important;
        background: var(--danger-bg) !important;
    }
    .eg-error-msg {
        font-size: 0.7rem;
        color: var(--danger);
        font-weight: 600;
        margin-top: 0.1rem;
        display: flex; align-items: center; gap: 0.25rem;
    }

    /* ── Submit area ── */
    .eg-submit-row {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 0.75rem !important;
        flex-wrap: wrap !important;
        padding-top: 1.1rem;
        border-top: 1.5px solid var(--border);
        margin-top: 0.25rem;
    }
    .eg-btn-submit {
        display: inline-flex !important; align-items: center !important; gap: 0.45rem !important;
        background: linear-gradient(135deg, var(--success), #059669) !important;
        color: #fff !important;
        border: none !important;
        padding: 0.65rem 1.5rem !important;
        border-radius: 10px !important;
        font-size: 0.875rem !important;
        font-weight: 700 !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        cursor: pointer !important;
        transition: all 0.2s !important;
        box-shadow: 0 3px 12px rgba(12,158,110,0.25) !important;
    }
    .eg-btn-submit:hover { transform: translateY(-1px) !important; box-shadow: 0 6px 20px rgba(12,158,110,0.3) !important; }

    .eg-btn-cancel {
        display: inline-flex !important; align-items: center !important; gap: 0.4rem !important;
        background: var(--bg-elevated) !important;
        color: var(--text-secondary) !important;
        border: 1.5px solid var(--border) !important;
        padding: 0.65rem 1.1rem !important;
        border-radius: 10px !important;
        font-size: 0.82rem !important;
        font-weight: 600 !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        text-decoration: none !important;
        transition: all 0.2s !important;
    }
    .eg-btn-cancel:hover { border-color: var(--border-active) !important; color: var(--text-primary) !important; }

    /* ── Validation alert ── */
    .eg-alert-error {
        background: var(--danger-bg);
        border: 1.5px solid var(--danger-border);
        border-radius: 12px;
        padding: 0.875rem 1.1rem;
        margin-bottom: 1.5rem;
        display: flex; align-items: flex-start; gap: 0.75rem;
        animation: slideDown 0.3s ease;
    }
    .eg-alert-error-icon { color: var(--danger); flex-shrink: 0; margin-top: 1px; }
    .eg-alert-error-title { font-size: 0.82rem; font-weight: 700; color: var(--danger); margin-bottom: 0.35rem; }
    .eg-alert-error-list  { font-size: 0.78rem; color: var(--danger); list-style: disc; padding-left: 1.1rem; display: flex; flex-direction: column; gap: 0.2rem; }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }

    /* ── Sidebar info card ── */
    .eg-info-card {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(59,91,219,0.05);
        margin-bottom: 1.25rem;
    }
    .eg-info-card:last-child { margin-bottom: 0; }
    .eg-info-card-header {
        display: flex !important; align-items: center !important; gap: 0.625rem !important;
        padding: 0.9rem 1.1rem;
        border-bottom: 1.5px solid var(--border);
        background: var(--bg-elevated);
    }
    .eg-info-card-title { font-size: 0.82rem; font-weight: 700; color: var(--text-primary); }

    /* Current data preview */
    .eg-preview-hero {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        padding: 1.25rem;
        text-align: center;
    }
    .eg-preview-avatar {
        width: 54px; height: 54px;
        background: rgba(255,255,255,0.2);
        border: 2.5px solid rgba(255,255,255,0.4);
        border-radius: 15px;
        display: grid; place-items: center;
        font-size: 1.4rem;
        font-weight: 800;
        color: white;
        margin: 0 auto 0.625rem;
    }
    .eg-preview-name  { font-size: 0.9rem; font-weight: 800; color: white; margin-bottom: 2px; }
    .eg-preview-sub   { font-size: 0.7rem; color: rgba(255,255,255,0.7); }

    .eg-preview-list { padding: 0.75rem; display: flex; flex-direction: column; gap: 0.4rem; }
    .eg-preview-item {
        display: flex !important; align-items: center !important; justify-content: space-between !important;
        padding: 0.5rem 0.7rem;
        background: var(--bg-elevated);
        border: 1.5px solid var(--border);
        border-radius: 8px;
        gap: 0.5rem;
    }
    .eg-preview-label { font-size: 0.7rem; font-weight: 600; color: var(--text-secondary); white-space: nowrap; }
    .eg-preview-val   { font-size: 0.75rem; font-weight: 700; color: var(--text-primary); font-family: 'JetBrains Mono', monospace; text-align: right; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 110px; }

    /* Tips card */
    .eg-tips-card {
        background: #eff6ff;
        border: 1.5px solid #bfdbfe;
        border-radius: 14px;
        padding: 1rem 1.1rem;
    }
    .eg-tips-title { font-size: 0.75rem; font-weight: 700; color: #2563eb; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem; }
    .eg-tips-list  { font-size: 0.73rem; color: #3b82f6; list-style: disc; padding-left: 1rem; display: flex; flex-direction: column; gap: 0.3rem; line-height: 1.5; }

    @media (max-width: 640px) { .eg-wrapper { padding: 1.25rem 1rem; } .eg-page-title { font-size: 1.1rem; } }
</style>

<div class="eg-wrapper">

    {{-- ── Breadcrumb ── --}}
    <nav class="eg-breadcrumb">
        <a href="{{ route('admin.dashboard') }}">
            <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor" style="display:inline;vertical-align:middle;margin-right:2px;">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Dashboard
        </a>
        <span class="eg-breadcrumb-sep">›</span>
        <a href="{{ route('admin.guru.index') }}">Daftar Guru</a>
        <span class="eg-breadcrumb-sep">›</span>
        <a href="{{ route('admin.guru.show', $guru->id) }}">{{ $guru->nama }}</a>
        <span class="eg-breadcrumb-sep">›</span>
        <span class="eg-breadcrumb-current">Edit</span>
    </nav>

    {{-- ── Page Header ── --}}
    <div class="eg-page-header">
        <div class="eg-title-group">
            <div class="eg-avatar">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
            <div>
                <div class="eg-page-title">Edit Data Guru</div>
                <div class="eg-page-subtitle">{{ $guru->nama }}</div>
            </div>
        </div>
        <a href="{{ route('admin.guru.show', $guru->id) }}" class="eg-btn-back">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- ── Validation errors ── --}}
    @if($errors->any())
        <div class="eg-alert-error">
            <div class="eg-alert-error-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div>
                <div class="eg-alert-error-title">Terdapat {{ $errors->count() }} kesalahan pada form</div>
                <ul class="eg-alert-error-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- ── Main layout ── --}}
    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="eg-layout">

        {{-- ── LEFT: Form fields ── --}}
        <div>

            {{-- Identitas Pribadi --}}
            <div class="eg-section-title">Identitas Pribadi</div>
            <div class="eg-card" style="margin-bottom:1.5rem;">
                <div class="eg-card-header">
                    <div class="eg-card-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <span class="eg-card-title">Data Pribadi</span>
                </div>
                <div class="eg-card-body">
                    <div class="eg-form-grid">
                        {{-- Nama --}}
                        <div class="eg-field eg-field-full">
                            <label class="eg-label" for="nama">Nama Lengkap <span class="eg-required">*</span></label>
                            <input type="text" id="nama" name="nama"
                                   value="{{ old('nama', $guru->nama) }}"
                                   class="eg-input {{ $errors->has('nama') ? 'is-error' : '' }}"
                                   placeholder="Masukkan nama lengkap">
                            @error('nama')<div class="eg-error-msg"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>{{ $message }}</div>@enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="eg-field">
                            <label class="eg-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="eg-select {{ $errors->has('jenis_kelamin') ? 'is-error' : '' }}">
                                <option value="">— Pilih —</option>
                                <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="eg-field">
                            <label class="eg-label" for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir"
                                   value="{{ old('tempat_lahir', $guru->tempat_lahir) }}"
                                   class="eg-input {{ $errors->has('tempat_lahir') ? 'is-error' : '' }}"
                                   placeholder="Kota/kabupaten">
                            @error('tempat_lahir')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="eg-field">
                            <label class="eg-label" for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                   value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}"
                                   class="eg-input {{ $errors->has('tanggal_lahir') ? 'is-error' : '' }}">
                            @error('tanggal_lahir')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="eg-field eg-field-full">
                            <label class="eg-label" for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat"
                                      class="eg-textarea {{ $errors->has('alamat') ? 'is-error' : '' }}"
                                      placeholder="Alamat lengkap tempat tinggal">{{ old('alamat', $guru->alamat) }}</textarea>
                            @error('alamat')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kepegawaian --}}
            <div class="eg-section-title">Data Kepegawaian</div>
            <div class="eg-card">
                <div class="eg-card-header">
                    <div class="eg-card-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
                    </div>
                    <span class="eg-card-title">Informasi Kepegawaian</span>
                </div>
                <div class="eg-card-body">
                    <div class="eg-form-grid">

                        {{-- NUPTK --}}
                        <div class="eg-field">
                            <label class="eg-label" for="nuptk">NUPTK</label>
                            <input type="text" id="nuptk" name="nuptk"
                                   value="{{ old('nuptk', $guru->nuptk) }}"
                                   class="eg-input mono {{ $errors->has('nuptk') ? 'is-error' : '' }}"
                                   placeholder="16 digit NUPTK">
                            @error('nuptk')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>

                        {{-- NBM --}}
                        <div class="eg-field">
                            <label class="eg-label" for="nbm">NBM</label>
                            <input type="text" id="nbm" name="nbm"
                                   value="{{ old('nbm', $guru->nbm) }}"
                                   class="eg-input mono {{ $errors->has('nbm') ? 'is-error' : '' }}"
                                   placeholder="Nomor Buku Muhammadiyah">
                            @error('nbm')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>

                        {{-- Jabatan --}}
                        <div class="eg-field">
                            <label class="eg-label" for="jabatan">Jabatan</label>
                            <input type="text" id="jabatan" name="jabatan"
                                   value="{{ old('jabatan', $guru->jabatan) }}"
                                   class="eg-input {{ $errors->has('jabatan') ? 'is-error' : '' }}"
                                   placeholder="Guru Mata Pelajaran, dsb.">
                            @error('jabatan')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>

                        {{-- Pendidikan Terakhir --}}
                        <div class="eg-field">
                            <label class="eg-label" for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir"
                                   value="{{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) }}"
                                   class="eg-input {{ $errors->has('pendidikan_terakhir') ? 'is-error' : '' }}"
                                   placeholder="S1, S2, dsb.">
                            @error('pendidikan_terakhir')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>

                        {{-- TMT --}}
                        <div class="eg-field eg-field-full">
                            <label class="eg-label" for="tmt">TMT (Tanggal Mulai Tugas)</label>
                            <input type="date" id="tmt" name="tmt"
                                   value="{{ old('tmt', $guru->tmt) }}"
                                   class="eg-input {{ $errors->has('tmt') ? 'is-error' : '' }}"
                                   style="max-width:260px;">
                            @error('tmt')<div class="eg-error-msg">{{ $message }}</div>@enderror
                        </div>

                    </div>

                    {{-- Submit --}}
                    <div class="eg-submit-row">
                        <a href="{{ route('admin.guru.show', $guru->id) }}" class="eg-btn-cancel">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            Batal
                        </a>
                        <button type="submit" class="eg-btn-submit">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

        </div>{{-- end left --}}

        {{-- ── RIGHT: Sidebar ── --}}
        <div>

            {{-- Current data preview --}}
            <div class="eg-info-card">
                <div class="eg-preview-hero">
                    <div class="eg-preview-avatar">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
                    <div class="eg-preview-name">{{ $guru->nama }}</div>
                    <div class="eg-preview-sub">{{ $guru->jabatan ?? 'Tenaga Pengajar' }}</div>
                </div>
                <div class="eg-preview-list">
                    <div class="eg-preview-item">
                        <span class="eg-preview-label">NUPTK</span>
                        <span class="eg-preview-val">{{ $guru->nuptk ?? '—' }}</span>
                    </div>
                    <div class="eg-preview-item">
                        <span class="eg-preview-label">NBM</span>
                        <span class="eg-preview-val">{{ $guru->nbm ?? '—' }}</span>
                    </div>
                    <div class="eg-preview-item">
                        <span class="eg-preview-label">TMT</span>
                        <span class="eg-preview-val">{{ $guru->tmt ? \Carbon\Carbon::parse($guru->tmt)->format('d/m/Y') : '—' }}</span>
                    </div>
                    <div class="eg-preview-item">
                        <span class="eg-preview-label">Pendidikan</span>
                        <span class="eg-preview-val">{{ $guru->pendidikan_terakhir ?? '—' }}</span>
                    </div>
                </div>
            </div>

            {{-- Tips --}}
            <div class="eg-tips-card">
                <div class="eg-tips-title">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Catatan Pengisian
                </div>
                <ul class="eg-tips-list">
                    <li>NUPTK terdiri dari 16 digit angka</li>
                    <li>Format tanggal: YYYY-MM-DD</li>
                    <li>TMT adalah tanggal resmi mulai bertugas</li>
                    <li>Pastikan nama sesuai dokumen resmi</li>
                </ul>
            </div>

        </div>{{-- end right --}}
    </div>{{-- end layout --}}

    </form>

</div>
@endsection