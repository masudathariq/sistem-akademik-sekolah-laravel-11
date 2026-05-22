@extends('layouts.admin')

@section('title', 'Detail Rombel - ' . $rombel->nama_lengkap)

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
        --accent-glow: rgba(59,91,219,0.12);
        --text-primary: #1a2151;
        --text-secondary: #5c6f9e;
        --text-muted: #a8b4d0;
        --cyan: #0891b2;
        --cyan-bg: #ecfeff;
        --cyan-border: #a5f3fc;
        --pink: #db2777;
        --pink-bg: #fdf2f8;
        --pink-border: #fbcfe8;
        --purple: #7c3aed;
        --purple-bg: #f5f3ff;
        --purple-border: #ddd6fe;
        --blue: #2563eb;
        --blue-bg: #eff6ff;
        --blue-border: #bfdbfe;
        --success: #0c9e6e;
        --success-bg: #ecfdf5;
        --success-border: #a7f3d0;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .dr-wrapper {
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
    .dr-breadcrumb {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 0.4rem !important;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }
    .dr-breadcrumb a { color: var(--text-secondary); text-decoration: none; font-weight: 500; transition: color 0.15s; }
    .dr-breadcrumb a:hover { color: var(--accent-primary); }
    .dr-breadcrumb-sep { color: var(--text-muted); font-size: 0.65rem; }
    .dr-breadcrumb-current { color: var(--text-primary); font-weight: 600; }

    /* ── Page header ── */
    .dr-page-header {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 1rem !important;
        margin-bottom: 2rem !important;
    }
    .dr-title-group { display: flex !important; align-items: center !important; gap: 0.875rem !important; }
    .dr-title-icon {
        width: 46px; height: 46px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 14px;
        display: grid; place-items: center;
        font-size: 1.25rem;
        box-shadow: 0 4px 16px var(--accent-glow);
        flex-shrink: 0;
    }
    .dr-page-title { font-size: 1.35rem; font-weight: 800; letter-spacing: -0.025em; color: var(--text-primary); }
    .dr-page-subtitle { font-size: 0.75rem; color: var(--text-secondary); margin-top: 2px; }

    .dr-btn-back {
        display: inline-flex !important; align-items: center !important; gap: 0.45rem !important;
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
    .dr-btn-back:hover { border-color: var(--border-active); color: var(--accent-primary); transform: translateY(-1px); }

    /* ── Section title ── */
    .dr-section-title {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-muted);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 0.875rem;
        display: flex; align-items: center; gap: 0.625rem;
    }
    .dr-section-title::after { content: ''; flex: 1; height: 1.5px; background: var(--border); border-radius: 2px; }

    /* ── Stat cards ── */
    .dr-stats-grid {
        display: grid !important;
        grid-template-columns: repeat(4, 1fr) !important;
        gap: 0.875rem !important;
        margin-bottom: 2rem !important;
    }
    @media (max-width: 900px) { .dr-stats-grid { grid-template-columns: repeat(2, 1fr) !important; } }
    @media (max-width: 480px) { .dr-stats-grid { grid-template-columns: repeat(2, 1fr) !important; } }

    .dr-stat-card {
        background: var(--bg-card) !important;
        border: 1.5px solid var(--border) !important;
        border-radius: 14px !important;
        padding: 1.1rem 1.25rem !important;
        position: relative !important;
        overflow: hidden !important;
        box-shadow: 0 1px 3px rgba(59,91,219,0.04) !important;
        transition: all 0.2s !important;
    }
    .dr-stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 14px 14px 0 0;
    }
    .dr-stat-card:hover { border-color: var(--border-active) !important; transform: translateY(-2px) !important; box-shadow: 0 6px 20px rgba(59,91,219,0.08) !important; }

    .dr-stat-card.is-blue::before   { background: linear-gradient(90deg, #3b5bdb, #60a5fa); }
    .dr-stat-card.is-cyan::before   { background: linear-gradient(90deg, #0891b2, #22d3ee); }
    .dr-stat-card.is-pink::before   { background: linear-gradient(90deg, #db2777, #f472b6); }
    .dr-stat-card.is-purple::before { background: linear-gradient(90deg, #7c3aed, #a78bfa); }

    .dr-stat-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        display: inline-flex; align-items: center; justify-content: center;
        margin-bottom: 0.75rem;
        flex-shrink: 0;
    }
    .dr-stat-icon.is-blue   { background: var(--blue-bg);   color: var(--blue); }
    .dr-stat-icon.is-cyan   { background: var(--cyan-bg);   color: var(--cyan); }
    .dr-stat-icon.is-pink   { background: var(--pink-bg);   color: var(--pink); }
    .dr-stat-icon.is-purple { background: var(--purple-bg); color: var(--purple); }
    .dr-stat-icon svg { width: 20px; height: 20px; }

    .dr-stat-value { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.04em; line-height: 1; }
    .dr-stat-card.is-blue   .dr-stat-value { color: var(--blue); }
    .dr-stat-card.is-cyan   .dr-stat-value { color: var(--cyan); }
    .dr-stat-card.is-pink   .dr-stat-value { color: var(--pink); }
    .dr-stat-card.is-purple .dr-stat-value { color: var(--purple); }

    .dr-stat-label { font-size: 0.7rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.06em; margin-top: 0.3rem; }
    .dr-stat-sub   { font-size: 0.72rem; color: var(--text-muted); margin-top: 0.2rem; }

    /* ── Middle row: info + chart ── */
    .dr-mid-row {
        display: grid !important;
        grid-template-columns: 1fr 320px !important;
        gap: 1.25rem !important;
        margin-bottom: 2rem !important;
        align-items: start !important;
    }
    @media (max-width: 900px) { .dr-mid-row { grid-template-columns: 1fr !important; } }

    /* ── Card base ── */
    .dr-card {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(59,91,219,0.05);
    }
    .dr-card-header {
        display: flex !important; align-items: center !important; justify-content: space-between !important;
        padding: 1rem 1.25rem;
        border-bottom: 1.5px solid var(--border);
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .dr-card-title { font-size: 0.875rem; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem; }
    .dr-card-body  { padding: 1.25rem; }

    /* ── Info grid ── */
    .dr-info-grid {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1.25rem !important;
    }
    @media (max-width: 600px) { .dr-info-grid { grid-template-columns: 1fr !important; } }
    .dr-info-item {}
    .dr-info-label {
        font-size: 0.68rem;
        font-weight: 700;
        color: var(--text-muted);
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 0.35rem;
    }
    .dr-info-value {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-primary);
        background: var(--bg-elevated);
        border: 1.5px solid var(--border);
        border-radius: 9px;
        padding: 0.5rem 0.875rem;
    }
    .dr-info-item.full { grid-column: 1 / -1; }

    /* ── Gender chart ── */
    .dr-chart-wrap {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 1.25rem !important;
    }
    .dr-donut-wrap {
        position: relative !important;
        width: 150px !important; height: 150px !important;
        flex-shrink: 0 !important;
    }
    .dr-donut-center {
        position: absolute !important;
        inset: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .dr-donut-total { font-size: 1.6rem; font-weight: 800; color: var(--text-primary); line-height: 1; }
    .dr-donut-sub   { font-size: 0.65rem; color: var(--text-secondary); font-weight: 500; margin-top: 2px; }

    .dr-legend { width: 100%; display: flex; flex-direction: column; gap: 0.6rem; }
    .dr-legend-row {
        display: flex !important; align-items: center !important; justify-content: space-between !important;
        padding: 0.5rem 0.75rem;
        background: var(--bg-elevated);
        border-radius: 9px;
        border: 1.5px solid var(--border);
    }
    .dr-legend-left  { display: flex !important; align-items: center !important; gap: 0.5rem !important; }
    .dr-legend-dot   { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .dr-legend-label { font-size: 0.8rem; font-weight: 600; color: var(--text-primary); }
    .dr-legend-val   { font-size: 0.78rem; font-weight: 700; color: var(--text-secondary); font-family: 'JetBrains Mono', monospace; }

    /* ── Print button ── */
    .dr-btn-print {
        display: inline-flex !important; align-items: center !important; gap: 0.4rem !important;
        background: var(--bg-elevated);
        color: var(--text-secondary);
        border: 1.5px solid var(--border);
        padding: 0.45rem 0.9rem;
        border-radius: 9px;
        font-size: 0.78rem;
        font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
    }
    .dr-btn-print:hover { border-color: var(--accent-primary); color: var(--accent-primary); background: var(--blue-bg); }

    /* ── Table ── */
    .dr-table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
    thead th {
        background: var(--bg-elevated);
        color: var(--text-secondary);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.8rem 1.1rem;
        text-align: left;
        white-space: nowrap;
        border-bottom: 1.5px solid var(--border);
    }
    tbody tr { border-bottom: 1px solid #f0f2f9; transition: background 0.15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--bg-hover); }
    td { padding: 0.85rem 1.1rem; vertical-align: middle; }

    /* ── No badge ── */
    .dr-no-badge {
        display: inline-flex !important; align-items: center !important; justify-content: center !important;
        width: 28px; height: 28px;
        background: var(--blue-bg);
        color: var(--blue);
        border: 1.5px solid var(--blue-border);
        border-radius: 7px;
        font-size: 0.72rem;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
    }

    /* ── Siswa name cell ── */
    .dr-siswa-cell { display: flex !important; align-items: center !important; gap: 0.75rem !important; }
    .dr-siswa-avatar {
        width: 34px; height: 34px;
        border-radius: 9px;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .dr-siswa-avatar.is-L { background: var(--cyan-bg); color: var(--cyan); border: 1.5px solid var(--cyan-border); }
    .dr-siswa-avatar.is-P { background: var(--pink-bg); color: var(--pink); border: 1.5px solid var(--pink-border); }
    .dr-siswa-name { font-weight: 600; font-size: 0.85rem; color: var(--text-primary); }

    /* ── Badges ── */
    .dr-badge {
        display: inline-flex !important; align-items: center !important; gap: 0.3rem !important;
        padding: 0.28rem 0.65rem;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.03em;
    }
    .dr-badge-L      { background: var(--cyan-bg);     color: var(--cyan);    border: 1px solid var(--cyan-border); }
    .dr-badge-P      { background: var(--pink-bg);     color: var(--pink);    border: 1px solid var(--pink-border); }
    .dr-badge-aktif  { background: var(--success-bg);  color: var(--success); border: 1px solid var(--success-border); }
    .dr-badge-pondok { background: var(--purple-bg);   color: var(--purple);  border: 1px solid var(--purple-border); }
    .dr-badge-reguler{ background: var(--blue-bg);     color: var(--blue);    border: 1px solid var(--blue-border); }

    /* ── Empty state ── */
    .dr-empty { padding: 3.5rem 2rem; text-align: center; }
    .dr-empty-icon { width: 60px; height: 60px; background: var(--bg-elevated); border: 1.5px solid var(--border); border-radius: 14px; display: grid; place-items: center; margin: 0 auto 1rem; color: var(--text-muted); }
    .dr-empty-title { font-size: 0.95rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.35rem; }
    .dr-empty-sub   { font-size: 0.8rem; color: var(--text-secondary); }

    @media (max-width: 640px) { .dr-wrapper { padding: 1.25rem 1rem; } .dr-page-title { font-size: 1.1rem; } }
</style>

<div class="dr-wrapper">

    {{-- ── Breadcrumb ── --}}
    <nav class="dr-breadcrumb">
        <a href="{{ route('admin.dashboard') }}">
            <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor" style="display:inline;vertical-align:middle;margin-right:2px;">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Dashboard
        </a>
        <span class="dr-breadcrumb-sep">›</span>
        <a href="{{ route('admin.rombel-kategori.index') }}">Rombel Kategori</a>
        <span class="dr-breadcrumb-sep">›</span>
        <span class="dr-breadcrumb-current">{{ $rombel->nama_lengkap }}</span>
    </nav>

    {{-- ── Page Header ── --}}
    <div class="dr-page-header">
        <div class="dr-title-group">
            <div class="dr-title-icon">🏫</div>
            <div>
                <div class="dr-page-title">{{ $rombel->nama_lengkap }}</div>
                <div class="dr-page-subtitle">Detail informasi rombongan belajar</div>
            </div>
        </div>
        <a href="{{ route('admin.rombel-kategori.index') }}" class="dr-btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- ── Stat Cards ── --}}
    @php
        $jumlahLaki       = $siswas->where('jenis_kelamin', 'L')->count();
        $jumlahPerempuan  = $siswas->where('jenis_kelamin', 'P')->count();
        $totalSiswa       = $siswas->count();
        $persentaseLaki   = $totalSiswa > 0 ? round(($jumlahLaki / $totalSiswa) * 100, 1) : 0;
        $persentasePerem  = $totalSiswa > 0 ? round(($jumlahPerempuan / $totalSiswa) * 100, 1) : 0;
    @endphp

    <div class="dr-section-title">Ringkasan</div>
    <div class="dr-stats-grid">
        <div class="dr-stat-card is-blue">
            <div class="dr-stat-icon is-blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="dr-stat-value">{{ $totalSiswa }}</div>
            <div class="dr-stat-label">Total Siswa</div>
        </div>
        <div class="dr-stat-card is-cyan">
            <div class="dr-stat-icon is-cyan">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div class="dr-stat-value">{{ $jumlahLaki }}</div>
            <div class="dr-stat-label">Laki-laki</div>
            <div class="dr-stat-sub">{{ $persentaseLaki }}% dari total</div>
        </div>
        <div class="dr-stat-card is-pink">
            <div class="dr-stat-icon is-pink">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/></svg>
            </div>
            <div class="dr-stat-value">{{ $jumlahPerempuan }}</div>
            <div class="dr-stat-label">Perempuan</div>
            <div class="dr-stat-sub">{{ $persentasePerem }}% dari total</div>
        </div>
        <div class="dr-stat-card is-purple">
            <div class="dr-stat-icon is-purple">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div style="margin-top:0.25rem;">
                @if(($kategori ?? null) == 'pondok')
                    <span class="dr-badge dr-badge-pondok" style="font-size:0.8rem; padding:0.35rem 0.8rem;">Pondok</span>
                @elseif(($kategori ?? null) == 'reguler')
                    <span class="dr-badge dr-badge-reguler" style="font-size:0.8rem; padding:0.35rem 0.8rem;">Reguler</span>
                @else
                    <span class="dr-badge" style="background:#f3f4f6;color:#6b7280;border:1px solid #d1d5db;font-size:0.8rem;">—</span>
                @endif
            </div>
            <div class="dr-stat-label" style="margin-top:0.5rem;">Kategori</div>
        </div>
    </div>

    {{-- ── Info + Chart row ── --}}
    <div class="dr-section-title">Informasi Rombel</div>
    <div class="dr-mid-row">

        {{-- Info card --}}
        <div class="dr-card">
            <div class="dr-card-header">
                <div class="dr-card-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    Data Rombel
                </div>
            </div>
            <div class="dr-card-body">
                <div class="dr-info-grid">
                    <div class="dr-info-item">
                        <div class="dr-info-label">Nama Lengkap</div>
                        <div class="dr-info-value">{{ $rombel->nama_lengkap ?? '—' }}</div>
                    </div>
                    <div class="dr-info-item">
                        <div class="dr-info-label">Kode Rombel</div>
                        <div class="dr-info-value" style="font-family:'JetBrains Mono',monospace; font-size:0.82rem;">{{ $rombel->kode ?? '—' }}</div>
                    </div>
                    <div class="dr-info-item">
                        <div class="dr-info-label">Tingkat</div>
                        <div class="dr-info-value">{{ $rombel->tingkat_romawi ?? '—' }}</div>
                    </div>
                    <div class="dr-info-item">
                        <div class="dr-info-label">Tahun Ajaran</div>
                        <div class="dr-info-value">{{ $rombel->tahun_ajaran ?? '—' }}</div>
                    </div>
                    <div class="dr-info-item full">
                        <div class="dr-info-label">Wali Kelas</div>
                        <div class="dr-info-value">{{ $rombel->wali_kelas ?? 'Belum ditentukan' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gender chart --}}
        <div class="dr-card">
            <div class="dr-card-header">
                <div class="dr-card-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    Distribusi Gender
                </div>
            </div>
            <div class="dr-card-body">
                @if($totalSiswa > 0)
                    <div class="dr-chart-wrap">
                        <div class="dr-donut-wrap">
                            <svg viewBox="0 0 100 100" style="width:100%;height:100%;transform:rotate(-90deg);">
                                <circle cx="50" cy="50" r="38" fill="transparent" stroke="#e4e9f5" stroke-width="18"/>
                                <circle cx="50" cy="50" r="38" fill="transparent"
                                    stroke="#0891b2" stroke-width="18"
                                    stroke-dasharray="{{ $persentaseLaki * 2.388 }} 238.76"
                                    stroke-dashoffset="0"/>
                                <circle cx="50" cy="50" r="38" fill="transparent"
                                    stroke="#db2777" stroke-width="18"
                                    stroke-dasharray="{{ $persentasePerem * 2.388 }} 238.76"
                                    stroke-dashoffset="-{{ $persentaseLaki * 2.388 }}"/>
                            </svg>
                            <div class="dr-donut-center">
                                <span class="dr-donut-total">{{ $totalSiswa }}</span>
                                <span class="dr-donut-sub">siswa</span>
                            </div>
                        </div>
                        <div class="dr-legend">
                            <div class="dr-legend-row">
                                <div class="dr-legend-left">
                                    <span class="dr-legend-dot" style="background:#0891b2;"></span>
                                    <span class="dr-legend-label">Laki-laki</span>
                                </div>
                                <span class="dr-legend-val">{{ $jumlahLaki }} &nbsp;·&nbsp; {{ $persentaseLaki }}%</span>
                            </div>
                            <div class="dr-legend-row">
                                <div class="dr-legend-left">
                                    <span class="dr-legend-dot" style="background:#db2777;"></span>
                                    <span class="dr-legend-label">Perempuan</span>
                                </div>
                                <span class="dr-legend-val">{{ $jumlahPerempuan }} &nbsp;·&nbsp; {{ $persentasePerem }}%</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="dr-empty">
                        <div class="dr-empty-icon" style="width:48px;height:48px;margin:0 auto 0.75rem;">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/></svg>
                        </div>
                        <div class="dr-empty-sub">Belum ada data siswa</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ── Siswa Table ── --}}
    <div class="dr-section-title">Daftar Siswa</div>
    <div class="dr-card">
        <div class="dr-card-header">
            <div class="dr-card-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Semua Siswa
            </div>
            <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
                <span style="font-size:0.75rem;color:var(--text-muted);font-family:'JetBrains Mono',monospace;">{{ $totalSiswa }} siswa</span>
                <button onclick="printTable()" class="dr-btn-print">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak
                </button>
            </div>
        </div>
        <div class="dr-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:52px;">No</th>
                        <th>Nama Siswa</th>
                        <th style="width:130px;">NISN</th>
                        <th style="width:120px;">Jenis Kelamin</th>
                        <th style="width:90px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $i => $siswa)
                        <tr>
                            <td><span class="dr-no-badge">{{ $i + 1 }}</span></td>
                            <td>
                                <div class="dr-siswa-cell">
                                    <span class="dr-siswa-avatar is-{{ $siswa->jenis_kelamin ?? 'L' }}">
                                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                    </span>
                                    <span class="dr-siswa-name">{{ $siswa->nama_siswa }}</span>
                                </div>
                            </td>
                            <td style="font-family:'JetBrains Mono',monospace;font-size:0.78rem;color:var(--text-secondary);">
                                {{ $siswa->nisn ?? '—' }}
                            </td>
                            <td>
                                <span class="dr-badge dr-badge-{{ $siswa->jenis_kelamin ?? 'L' }}">
                                    @if($siswa->jenis_kelamin == 'L')
                                        <svg width="10" height="10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                                        Laki-laki
                                    @else
                                        <svg width="10" height="10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 005 10a6 6 0 0112 0c0 .459-.031.909-.086 1.333A5 5 0 0010 11z" clip-rule="evenodd"/></svg>
                                        Perempuan
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="dr-badge dr-badge-aktif">
                                    <svg width="9" height="9" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    Aktif
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="dr-empty">
                                    <div class="dr-empty-icon">
                                        <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/></svg>
                                    </div>
                                    <div class="dr-empty-title">Belum ada siswa</div>
                                    <div class="dr-empty-sub">Siswa belum ditambahkan ke rombel ini</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function printTable() {
    const w = window.open('', '_blank');
    w.document.write(`<!DOCTYPE html><html><head>
        <title>Daftar Siswa - {{ $rombel->nama_lengkap }}</title>
        <style>
            body{font-family:Arial,sans-serif;margin:20px;color:#111;}
            h2{margin-bottom:4px;}p{color:#555;font-size:13px;margin-bottom:16px;}
            table{width:100%;border-collapse:collapse;font-size:13px;}
            th{background:#f1f5f9;padding:8px 10px;text-align:left;border-bottom:2px solid #cbd5e1;font-weight:700;text-transform:uppercase;font-size:11px;letter-spacing:.05em;}
            td{padding:8px 10px;border-bottom:1px solid #e2e8f0;}
            tr:last-child td{border-bottom:none;}
            .badge{display:inline-block;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:700;}
            .lk{background:#ecfeff;color:#0e7490;}.pr{background:#fdf2f8;color:#be185d;}
            .no{text-align:center;}
            .footer{margin-top:40px;text-align:right;font-size:12px;}
            @media print{@page{size:A4 portrait;margin:15mm;}body{margin:0;}}
        </style></head><body>
        <h2>{{ $rombel->nama_lengkap }}</h2>
        <p>Daftar Siswa &nbsp;·&nbsp; Dicetak: {{ now()->format('d/m/Y H:i') }} &nbsp;·&nbsp; Total: {{ $totalSiswa }} siswa (L: {{ $jumlahLaki }}, P: {{ $jumlahPerempuan }})</p>
        <table><thead><tr><th class="no">No</th><th>Nama Siswa</th><th>NISN</th><th>Jenis Kelamin</th><th>Status</th></tr></thead><tbody>
        @foreach($siswas as $i => $siswa)
        <tr>
            <td class="no">{{ $i + 1 }}</td>
            <td>{{ $siswa->nama_siswa }}</td>
            <td style="font-family:monospace;">{{ $siswa->nisn ?? '-' }}</td>
            <td><span class="badge {{ $siswa->jenis_kelamin == 'L' ? 'lk' : 'pr' }}">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></td>
            <td>Aktif</td>
        </tr>
        @endforeach
        </tbody></table>
        <div class="footer"><div style="border-top:1px solid #000;width:200px;margin-left:auto;padding-top:8px;">
            Mengetahui,<br>Staff Tata Usaha<br>MTs Muhammadiyah 1 Natar
        </div></div>
    </body></html>`);
    w.document.close(); w.focus();
    setTimeout(() => { w.print(); w.close(); }, 250);
}
</script>
@endsection
