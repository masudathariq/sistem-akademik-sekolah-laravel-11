@extends('layouts.admin')

@section('title', 'Detail Guru - ' . $guru->nama)

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
            --accent-primary: #3b5bdb;
            --accent-secondary: #6741d9;
            --accent-glow: rgba(59, 91, 219, 0.12);
            --text-primary: #1a2151;
            --text-secondary: #5c6f9e;
            --text-muted: #a8b4d0;
            --success: #0c9e6e;
            --success-bg: #ecfdf5;
            --success-border: #a7f3d0;
            --cyan: #0891b2;
            --cyan-bg: #ecfeff;
            --cyan-border: #a5f3fc;
            --pink: #db2777;
            --pink-bg: #fdf2f8;
            --pink-border: #fbcfe8;
            --warning: #d97706;
            --warning-bg: #fffbeb;
            --warning-border: #fcd34d;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .dg-wrapper {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-base);
            min-height: 100vh;
            padding: 2rem 1.5rem;
            color: var(--text-primary);
            background-image:
                radial-gradient(ellipse 80% 40% at 50% -10%, rgba(59, 91, 219, 0.06) 0%, transparent 60%),
                radial-gradient(ellipse 40% 30% at 90% 5%, rgba(124, 58, 237, 0.04) 0%, transparent 50%);
        }

        /* ── Breadcrumb ── */
        .dg-breadcrumb {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 0.4rem !important;
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
        }

        .dg-breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s;
        }

        .dg-breadcrumb a:hover {
            color: var(--accent-primary);
        }

        .dg-breadcrumb-sep {
            color: var(--text-muted);
            font-size: 0.65rem;
        }

        .dg-breadcrumb-current {
            color: var(--text-primary);
            font-weight: 600;
        }

        /* ── Page header ── */
        .dg-page-header {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: center !important;
            flex-wrap: wrap !important;
            gap: 1rem !important;
            margin-bottom: 2rem !important;
        }

        .dg-title-group {
            display: flex !important;
            align-items: center !important;
            gap: 1rem !important;
        }

        /* Avatar besar dari inisial */
        .dg-avatar-lg {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-size: 1.4rem;
            font-weight: 800;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 16px var(--accent-glow);
            letter-spacing: -0.02em;
        }

        .dg-page-title {
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: var(--text-primary);
        }

        .dg-page-subtitle {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 3px;
        }

        .dg-header-actions {
            display: flex !important;
            align-items: center !important;
            gap: 0.625rem !important;
            flex-wrap: wrap !important;
        }

        .dg-btn-back {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.4rem !important;
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
            box-shadow: 0 1px 3px rgba(59, 91, 219, 0.04);
        }

        .dg-btn-back:hover {
            border-color: var(--border-active);
            color: var(--text-primary);
            transform: translateY(-1px);
        }

        .dg-btn-edit {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.4rem !important;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: #fff;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 3px 12px var(--accent-glow);
        }

        .dg-btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59, 91, 219, 0.22);
        }

        /* ── Section title ── */
        .dg-section-title {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .dg-section-title::after {
            content: '';
            flex: 1;
            height: 1.5px;
            background: var(--border);
            border-radius: 2px;
        }

        /* ── Main layout: left col + right col ── */
        .dg-main-row {
            display: grid !important;
            grid-template-columns: 1fr 280px !important;
            gap: 1.25rem !important;
            align-items: start !important;
        }

        @media (max-width: 860px) {
            .dg-main-row {
                grid-template-columns: 1fr !important;
            }
        }

        /* ── Card base ── */
        .dg-card {
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(59, 91, 219, 0.05);
            margin-bottom: 1.25rem;
        }

        .dg-card:last-child {
            margin-bottom: 0;
        }

        .dg-card-header {
            display: flex !important;
            align-items: center !important;
            gap: 0.625rem !important;
            padding: 0.9rem 1.25rem;
            border-bottom: 1.5px solid var(--border);
            background: var(--bg-elevated);
        }

        .dg-card-header-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            color: var(--accent-primary);
        }

        .dg-card-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .dg-card-body {
            padding: 1.25rem;
        }

        /* ── Info grid ── */
        .dg-info-grid {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 1rem !important;
        }

        @media (max-width: 600px) {
            .dg-info-grid {
                grid-template-columns: 1fr !important;
            }
        }

        .dg-field {}

        .dg-field-label {
            font-size: 0.67rem;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 0.09em;
            text-transform: uppercase;
            margin-bottom: 0.35rem;
        }

        .dg-field-value {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            background: var(--bg-elevated);
            border: 1.5px solid var(--border);
            border-radius: 9px;
            padding: 0.5rem 0.875rem;
            min-height: 38px;
            display: flex;
            align-items: center;
        }

        .dg-field-value.mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.82rem;
        }

        .dg-field-value.empty {
            color: var(--text-muted);
            font-weight: 400;
            font-style: italic;
        }

        .dg-field.full {
            grid-column: 1 / -1;
        }

        /* ── Right sidebar cards ── */
        .dg-profile-card {
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(59, 91, 219, 0.05);
            margin-bottom: 1.25rem;
        }

        .dg-profile-card:last-child {
            margin-bottom: 0;
        }

        /* Profile hero */
        .dg-profile-hero {
            background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
            padding: 1.5rem 1.25rem 1rem;
            text-align: center;
            position: relative;
        }

        .dg-profile-avatar {
            width: 64px;
            height: 64px;
            background: rgba(255, 255, 255, 0.2);
            border: 3px solid rgba(255, 255, 255, 0.4);
            border-radius: 18px;
            display: grid;
            place-items: center;
            font-size: 1.6rem;
            font-weight: 800;
            color: white;
            margin: 0 auto 0.75rem;
            backdrop-filter: blur(4px);
        }

        .dg-profile-name {
            font-size: 0.95rem;
            font-weight: 800;
            color: white;
            letter-spacing: -0.01em;
            margin-bottom: 0.3rem;
        }

        .dg-profile-email {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.75);
            font-family: 'JetBrains Mono', monospace;
        }

        /* Sidebar info list */
        .dg-sidebar-list {
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .dg-sidebar-item {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 0.5rem !important;
            padding: 0.55rem 0.75rem;
            background: var(--bg-elevated);
            border: 1.5px solid var(--border);
            border-radius: 9px;
        }

        .dg-sidebar-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .dg-sidebar-val {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-primary);
            font-family: 'JetBrains Mono', monospace;
            text-align: right;
        }

        /* Badges */
        .dg-badge {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.3rem !important;
            padding: 0.28rem 0.7rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .dg-badge-L {
            background: var(--cyan-bg);
            color: var(--cyan);
            border: 1px solid var(--cyan-border);
        }

        .dg-badge-P {
            background: var(--pink-bg);
            color: var(--pink);
            border: 1px solid var(--pink-border);
        }

        .dg-badge-success {
            background: var(--success-bg);
            color: var(--success);
            border: 1px solid var(--success-border);
        }

        .dg-badge-warning {
            background: var(--warning-bg);
            color: var(--warning);
            border: 1px solid var(--warning-border);
        }

        /* Masa kerja highlight */
        .dg-masa-kerja-card {
            background: linear-gradient(135deg, var(--success-bg), #d1fae5);
            border: 1.5px solid var(--success-border);
            border-radius: 12px;
            padding: 1rem 1.1rem;
            display: flex !important;
            align-items: center !important;
            gap: 0.875rem !important;
        }

        .dg-masa-kerja-icon {
            width: 40px;
            height: 40px;
            background: var(--success);
            border-radius: 11px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(12, 158, 110, 0.25);
        }

        .dg-masa-kerja-val {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--success);
            letter-spacing: -0.02em;
        }

        .dg-masa-kerja-label {
            font-size: 0.7rem;
            color: var(--success);
            font-weight: 600;
            opacity: 0.8;
            margin-top: 1px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        @media (max-width: 640px) {
            .dg-wrapper {
                padding: 1.25rem 1rem;
            }

            .dg-page-title {
                font-size: 1.1rem;
            }
        }
    </style>

    <div class="dg-wrapper">

        {{-- ── Breadcrumb ── --}}
        <nav class="dg-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">
                <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor"
                    style="display:inline;vertical-align:middle;margin-right:2px;">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Dashboard
            </a>
            <span class="dg-breadcrumb-sep">›</span>
            <a href="{{ route('admin.guru.index') }}">Daftar Guru</a>
            <span class="dg-breadcrumb-sep">›</span>
            <span class="dg-breadcrumb-current">{{ $guru->nama }}</span>
        </nav>

        {{-- ── Page Header ── --}}
        <div class="dg-page-header">
            <div class="dg-title-group">
                <div class="dg-avatar-lg">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
                <div>
                    <div class="dg-page-title">{{ $guru->nama }}</div>
                    <div class="dg-page-subtitle">{{ $guru->jabatan ?? 'Tenaga Pengajar' }}</div>
                </div>
            </div>
            <div class="dg-header-actions">
                <a href="{{ route('admin.guru.index') }}" class="dg-btn-back">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('admin.guru.edit', $guru->id) }}" class="dg-btn-edit">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data
                </a>
            </div>
        </div>

        {{-- ── Main 2-col layout ── --}}
        <div class="dg-main-row">

            {{-- ── LEFT: Detail Fields ── --}}
            <div>

                {{-- Data Identitas --}}
                <div class="dg-section-title">Data Identitas</div>
                <div class="dg-card" style="margin-bottom:1.5rem;">
                    <div class="dg-card-header">
                        <div class="dg-card-header-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="dg-card-title">Identitas Pribadi</span>
                    </div>
                    <div class="dg-card-body">
                        <div class="dg-info-grid">
                            <div class="dg-field">
                                <div class="dg-field-label">Nama Lengkap</div>
                                <div class="dg-field-value">{{ $guru->nama ?? '—' }}</div>
                            </div>
                            <div class="dg-field">
                                <div class="dg-field-label">Jenis Kelamin</div>
                                <div class="dg-field-value">
                                    @if ($guru->jenis_kelamin == 'L')
                                        <span class="dg-badge dg-badge-L">
                                            <svg width="10" height="10" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Laki-laki
                                        </span>
                                    @elseif($guru->jenis_kelamin == 'P')
                                        <span class="dg-badge dg-badge-P">
                                            <svg width="10" height="10" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 005 10a6 6 0 0112 0c0 .459-.031.909-.086 1.333A5 5 0 0010 11z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Perempuan
                                        </span>
                                    @else
                                        <span
                                            style="color:var(--text-muted);font-style:italic;font-weight:400;font-size:0.82rem;">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="dg-field">
                                <div class="dg-field-label">Tempat Lahir</div>
                                <div class="dg-field-value {{ !$guru->tempat_lahir ? 'empty' : '' }}">
                                    {{ $guru->tempat_lahir ?? 'Tidak diisi' }}
                                </div>
                            </div>
                            <div class="dg-field">
                                <div class="dg-field-label">Tanggal Lahir</div>

                                <div class="dg-field-value mono {{ !$guru->tanggal_lahir ? 'empty' : '' }}">
                                    {{ $guru->tanggal_lahir
                                        ? \Carbon\Carbon::parse($guru->tanggal_lahir)->translatedFormat('d F Y')
                                        : 'Tidak diisi' }}
                                </div>
                            </div>
                            <div class="dg-field full">
                                <div class="dg-field-label">Alamat</div>
                                <div class="dg-field-value {{ !$guru->alamat ? 'empty' : '' }}"
                                    style="align-items:flex-start;padding-top:0.6rem;min-height:56px;white-space:normal;word-break:break-word;">
                                    {{ $guru->alamat ?? 'Tidak diisi' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data Kepegawaian --}}
                <div class="dg-section-title">Data Kepegawaian</div>
                <div class="dg-card">
                    <div class="dg-card-header">
                        <div class="dg-card-header-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="2" y="7" width="20" height="14" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2" />
                            </svg>
                        </div>
                        <span class="dg-card-title">Informasi Kepegawaian</span>
                    </div>
                    <div class="dg-card-body">
                        <div class="dg-info-grid">
                            <div class="dg-field">
                                <div class="dg-field-label">NUPTK</div>
                                <div class="dg-field-value mono {{ !$guru->nuptk ? 'empty' : '' }}">
                                    {{ $guru->nuptk ?? 'Tidak diisi' }}
                                </div>
                            </div>
                            <div class="dg-field">
                                <div class="dg-field-label">NBM</div>
                                <div class="dg-field-value mono {{ !$guru->nbm ? 'empty' : '' }}">
                                    {{ $guru->nbm ?? 'Tidak diisi' }}
                                </div>
                            </div>
                            <div class="dg-field">
                                <div class="dg-field-label">Jabatan</div>
                                <div class="dg-field-value {{ !$guru->jabatan ? 'empty' : '' }}">
                                    {{ $guru->jabatan ?? 'Tidak diisi' }}
                                </div>
                            </div>
                            <div class="dg-field">
                                <div class="dg-field-label">Pendidikan Terakhir</div>
                                <div class="dg-field-value {{ !$guru->pendidikan_terakhir ? 'empty' : '' }}">
                                    {{ $guru->pendidikan_terakhir ?? 'Tidak diisi' }}
                                </div>
                            </div>
                            <div class="dg-field">
                                <div class="dg-field-label">TMT (Tgl Mulai Tugas)</div>
                                <div class="dg-field-value mono {{ !$guru->tmt ? 'empty' : '' }}">
                                    {{ $guru->tmt ? \Carbon\Carbon::parse($guru->tmt)->format('d MMMM Y') : 'Tidak diisi' }}
                                </div>
                            </div>
                            <div class="dg-field">
                                <div class="dg-field-label">Email Akun</div>
                                <div class="dg-field-value mono {{ !($guru->user->email ?? null) ? 'empty' : '' }}">
                                    {{ $guru->user->email ?? 'Tidak diisi' }}
                                </div>
                            </div>
                        </div>

                        {{-- Masa Kerja highlight --}}
                        <div style="margin-top:1.1rem;">
                            <div class="dg-masa-kerja-card">
                                <div class="dg-masa-kerja-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="white" stroke-width="2.2">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="dg-masa-kerja-val">{{ $masaKerja }}</div>
                                    <div class="dg-masa-kerja-label">Masa Kerja</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>{{-- end left --}}

            {{-- ── RIGHT: Profile sidebar ── --}}
            <div>
                {{-- Profile card --}}
                <div class="dg-profile-card">
                    <div class="dg-profile-hero">
                        <div class="dg-profile-avatar">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
                        <div class="dg-profile-name">{{ $guru->nama }}</div>
                        <div class="dg-profile-email">{{ $guru->user->email ?? 'email@sekolah.id' }}</div>
                    </div>
                    <div class="dg-sidebar-list">
                        <div class="dg-sidebar-item">
                            <span class="dg-sidebar-label">Jabatan</span>
                            <span class="dg-sidebar-val"
                                style="font-family:'Plus Jakarta Sans',sans-serif;font-size:0.78rem;">{{ $guru->jabatan ?? '—' }}</span>
                        </div>
                        <div class="dg-sidebar-item">
                            <span class="dg-sidebar-label">Tingkat</span>
                            <span class="dg-sidebar-val"
                                style="font-family:'Plus Jakarta Sans',sans-serif;">{{ $guru->pendidikan_terakhir ?? '—' }}</span>
                        </div>
                        <div class="dg-sidebar-item">
                            <span class="dg-sidebar-label">Jenis Kelamin</span>
                            <span>
                                @if ($guru->jenis_kelamin == 'L')
                                    <span class="dg-badge dg-badge-L" style="font-size:0.68rem;">L</span>
                                @elseif($guru->jenis_kelamin == 'P')
                                    <span class="dg-badge dg-badge-P" style="font-size:0.68rem;">P</span>
                                @else
                                    <span class="dg-sidebar-val">—</span>
                                @endif
                            </span>
                        </div>
                        <div class="dg-sidebar-item">
                            <span class="dg-sidebar-label">NUPTK</span>
                            <span class="dg-sidebar-val">{{ $guru->nuptk ?? '—' }}</span>
                        </div>
                        <div class="dg-sidebar-item">
                            <span class="dg-sidebar-label">NBM</span>
                            <span class="dg-sidebar-val">{{ $guru->nbm ?? '—' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Quick actions card --}}
                <div class="dg-profile-card">
                    <div class="dg-card-header" style="background:var(--bg-elevated);">
                        <div class="dg-card-header-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="3" />
                                <path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14" />
                            </svg>
                        </div>
                        <span class="dg-card-title">Aksi Cepat</span>
                    </div>
                    <div style="padding:0.75rem; display:flex; flex-direction:column; gap:0.5rem;">
                        <a href="{{ route('admin.guru.edit', $guru->id) }}"
                            style="display:flex !important;align-items:center !important;gap:0.625rem !important;padding:0.65rem 0.875rem;background:var(--blue-bg, #eff6ff);border:1.5px solid var(--blue-border, #bfdbfe);border-radius:10px;text-decoration:none;transition:all 0.2s;color:#2563eb;font-size:0.82rem;font-weight:700;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Data Guru
                        </a>
                        <a href="{{ route('admin.guru.index') }}"
                            style="display:flex !important;align-items:center !important;gap:0.625rem !important;padding:0.65rem 0.875rem;background:var(--bg-elevated);border:1.5px solid var(--border);border-radius:10px;text-decoration:none;transition:all 0.2s;color:var(--text-secondary);font-size:0.82rem;font-weight:600;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Semua Guru
                        </a>
                    </div>
                </div>

            </div>{{-- end right --}}
        </div>{{-- end main row --}}

    </div>
@endsection
