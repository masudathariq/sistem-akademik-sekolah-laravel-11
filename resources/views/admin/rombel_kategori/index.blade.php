{{-- resources/views/tatausaha/rombel_kategori/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kategori Rombel')

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
        --purple: #7c3aed;
        --purple-bg: #f5f3ff;
        --purple-border: #ddd6fe;
        --blue: #2563eb;
        --blue-bg: #eff6ff;
        --blue-border: #bfdbfe;
        --gray-bg: #f3f4f6;
        --gray-border: #d1d5db;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .rk-wrapper {
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
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
    }
    .breadcrumb a {
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.15s;
    }
    .breadcrumb a:hover { color: var(--accent-primary); }
    .breadcrumb-sep { color: var(--text-muted); font-size: 0.65rem; }
    .breadcrumb-current { color: var(--text-primary); font-weight: 600; }

    /* ── Header ── */
    .page-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .page-title-group { display: flex; align-items: center; gap: 0.875rem; }
    .title-icon {
        width: 46px; height: 46px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 14px;
        display: grid; place-items: center;
        font-size: 1.25rem;
        box-shadow: 0 4px 16px var(--accent-glow), 0 1px 3px rgba(59,91,219,0.2);
        flex-shrink: 0;
    }
    .page-title {
        font-size: 1.4rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: var(--text-primary);
    }
    .page-subtitle {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-top: 2px;
    }
    .count-badge {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: var(--blue-bg);
        color: var(--blue);
        border: 1.5px solid var(--blue-border);
        padding: 0.45rem 0.9rem;
        border-radius: 99px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    /* ── Section title ── */
    .section-title {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-muted);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 0.875rem;
        display: flex; align-items: center; gap: 0.625rem;
    }
    .section-title::after {
        content: '';
        flex: 1;
        height: 1.5px;
        background: var(--border);
        border-radius: 2px;
    }

    /* ── Stat Cards ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.875rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 14px;
        padding: 1.25rem 1.35rem;
        display: flex; align-items: center; gap: 1rem;
        transition: all 0.2s;
        box-shadow: 0 1px 3px rgba(59,91,219,0.04);
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 14px 14px 0 0;
    }
    .stat-card.purple::before { background: linear-gradient(90deg, #7c3aed, #a78bfa); }
    .stat-card.blue::before   { background: linear-gradient(90deg, #2563eb, #60a5fa); }
    .stat-card.gray::before   { background: linear-gradient(90deg, #6b7280, #9ca3af); }
    .stat-card:hover {
        border-color: var(--border-active);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59,91,219,0.08);
    }
    .stat-icon-wrap {
        width: 44px; height: 44px;
        border-radius: 12px;
        display: grid; place-items: center;
        flex-shrink: 0;
    }
    .stat-icon-wrap.purple { background: var(--purple-bg); }
    .stat-icon-wrap.blue   { background: var(--blue-bg); }
    .stat-icon-wrap.gray   { background: var(--gray-bg); }
    .stat-icon-wrap svg { width: 22px; height: 22px; }
    .stat-icon-wrap.purple svg { color: var(--purple); stroke: var(--purple); }
    .stat-icon-wrap.blue   svg { color: var(--blue);   stroke: var(--blue); }
    .stat-icon-wrap.gray   svg { color: #6b7280; stroke: #6b7280; }
    .stat-info {}
    .stat-value {
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -0.04em;
        line-height: 1;
    }
    .stat-card.purple .stat-value { color: var(--purple); }
    .stat-card.blue   .stat-value { color: var(--blue); }
    .stat-card.gray   .stat-value { color: #6b7280; }
    .stat-label {
        font-size: 0.72rem;
        color: var(--text-secondary);
        margin-top: 0.3rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    /* ── Table Card ── */
    .table-card {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(59,91,219,0.05);
        margin-bottom: 1.5rem;
    }
    .table-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1rem 1.25rem;
        border-bottom: 1.5px solid var(--border);
    }
    .table-card-title {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex; align-items: center; gap: 0.5rem;
    }
    .table-wrap { overflow-x: auto; }

    table { width: 100%; border-collapse: collapse; font-size: 0.84rem; }

    thead th {
        background: var(--bg-elevated);
        color: var(--text-secondary);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.8rem 1.25rem;
        text-align: left;
        white-space: nowrap;
        border-bottom: 1.5px solid var(--border);
    }
    tbody tr {
        border-bottom: 1px solid #f0f2f9;
        transition: background 0.15s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--bg-hover); }
    td { padding: 0.9rem 1.25rem; vertical-align: middle; }

    /* ── Rombel name cell ── */
    .rombel-cell { display: flex; align-items: center; gap: 0.875rem; }
    .rombel-avatar {
        width: 38px; height: 38px;
        background: var(--bg-elevated);
        border: 1.5px solid var(--border);
        border-radius: 10px;
        display: grid; place-items: center;
        flex-shrink: 0;
        color: var(--text-secondary);
    }
    .rombel-avatar svg { width: 18px; height: 18px; }
    .rombel-name { font-weight: 600; font-size: 0.875rem; color: var(--text-primary); }
    .rombel-sub  { font-size: 0.72rem; color: var(--text-secondary); margin-top: 1px; }

    /* ── Category badges ── */
    .badge {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.3rem 0.75rem;
        border-radius: 7px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .badge-pondok  { background: var(--purple-bg); color: var(--purple); border: 1px solid var(--purple-border); }
    .badge-reguler { background: var(--blue-bg);   color: var(--blue);   border: 1px solid var(--blue-border); }
    .badge-none    { background: var(--gray-bg);   color: #6b7280;       border: 1px solid var(--gray-border); }

    /* ── Split layout ── */
    .rk-split-row {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 1.25rem !important;
        margin-bottom: 1.5rem !important;
        align-items: start !important;
    }
    @media (max-width: 768px) {
        .rk-split-row { grid-template-columns: 1fr !important; }
    }

    .rk-split-col {
        background: #ffffff !important;
        border: 1.5px solid #e4e9f5 !important;
        border-radius: 16px !important;
        overflow: hidden !important;
        box-shadow: 0 1px 4px rgba(59,91,219,0.05) !important;
    }

    /* Split header */
    .rk-split-header {
        display: flex !important;
        align-items: center !important;
        gap: 0.625rem !important;
        padding: 0.9rem 1.1rem !important;
        border-bottom: 1.5px solid !important;
    }
    .rk-split-header.is-purple { background: #f5f3ff !important; border-bottom-color: #ddd6fe !important; }
    .rk-split-header.is-blue   { background: #eff6ff !important; border-bottom-color: #bfdbfe !important; }

    .rk-split-icon {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 28px !important; height: 28px !important;
        border-radius: 8px !important;
        flex-shrink: 0 !important;
    }
    .rk-split-icon.is-purple { background: #ddd6fe !important; color: #7c3aed !important; }
    .rk-split-icon.is-blue   { background: #bfdbfe !important; color: #2563eb !important; }

    .rk-split-title {
        font-size: 0.875rem !important;
        font-weight: 800 !important;
        flex: 1 !important;
        letter-spacing: -0.01em !important;
        margin: 0 !important; padding: 0 !important;
    }
    .rk-split-title.is-purple { color: #7c3aed !important; }
    .rk-split-title.is-blue   { color: #2563eb !important; }

    .rk-split-badge {
        font-size: 0.7rem !important;
        font-weight: 700 !important;
        padding: 0.18rem 0.55rem !important;
        border-radius: 99px !important;
        line-height: 1.4 !important;
    }
    .rk-split-badge.is-purple { background: #ddd6fe !important; color: #7c3aed !important; }
    .rk-split-badge.is-blue   { background: #bfdbfe !important; color: #2563eb !important; }

    /* Tingkat group */
    .rk-tingkat-group {
        border-bottom: 1px solid #e4e9f5 !important;
    }
    .rk-tingkat-group:last-child { border-bottom: none !important; }

    .rk-tingkat-label {
        display: block !important;
        font-size: 0.67rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.1em !important;
        text-transform: uppercase !important;
        padding: 0.5rem 1.1rem !important;
        border-bottom: 1px solid #e4e9f5 !important;
        margin: 0 !important;
    }
    .rk-tingkat-label.is-purple { color: #7c3aed !important; background: #faf8ff !important; }
    .rk-tingkat-label.is-blue   { color: #2563eb !important; background: #f8fbff !important; }

    /* Rombel row — THE KEY FIX */
    .rk-rombel-row {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 0.75rem !important;
        padding: 0.65rem 1.1rem !important;
        border-bottom: 1px solid #f4f5fb !important;
        transition: background 0.15s !important;
    }
    .rk-rombel-row:last-child { border-bottom: none !important; }
    .rk-rombel-row:hover { background: #f0f3fb !important; }

    .rk-rombel-left {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 0.65rem !important;
        min-width: 0 !important;
        flex: 1 !important;
    }

    .rk-rombel-icon {
        width: 32px !important; height: 32px !important;
        border-radius: 9px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
        border: 1.5px solid !important;
    }
    .rk-rombel-icon.is-purple { background: #f5f3ff !important; border-color: #ddd6fe !important; color: #7c3aed !important; }
    .rk-rombel-icon.is-blue   { background: #eff6ff !important; border-color: #bfdbfe !important; color: #2563eb !important; }

    .rk-rombel-name {
        font-weight: 600 !important;
        font-size: 0.83rem !important;
        color: #1a2151 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        margin: 0 !important; padding: 0 !important;
    }

    /* View button */
    .rk-btn-view {
        display: inline-flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 0.3rem !important;
        padding: 0.35rem 0.75rem !important;
        border-radius: 7px !important;
        font-size: 0.72rem !important;
        font-weight: 700 !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        text-decoration: none !important;
        white-space: nowrap !important;
        flex-shrink: 0 !important;
        border: 1.5px solid !important;
        transition: all 0.2s !important;
        cursor: pointer !important;
        line-height: 1 !important;
    }
    .rk-btn-view.is-purple { background: #f5f3ff !important; color: #7c3aed !important; border-color: #ddd6fe !important; }
    .rk-btn-view.is-purple:hover { background: #ddd6fe !important; transform: translateY(-1px) !important; }
    .rk-btn-view.is-blue   { background: #eff6ff !important; color: #2563eb !important; border-color: #bfdbfe !important; }
    .rk-btn-view.is-blue:hover   { background: #bfdbfe !important; transform: translateY(-1px) !important; }

    /* ── Action button (old, keep for compatibility) ── */
    .btn-view-default {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: var(--bg-elevated);
        color: var(--accent-primary);
        border: 1.5px solid var(--border);
        padding: 0.4rem 0.875rem;
        border-radius: 8px;
        font-size: 0.77rem;
        font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-decoration: none;
        transition: all 0.2s;
    }

    /* ── Empty state ── */
    .empty-state {
        padding: 3.5rem 2rem;
        text-align: center;
    }
    .empty-state-icon {
        width: 64px; height: 64px;
        background: var(--bg-elevated);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        display: grid; place-items: center;
        margin: 0 auto 1rem;
        color: var(--text-muted);
    }
    .empty-state-icon svg { width: 28px; height: 28px; }
    .empty-state-title { font-size: 0.95rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.4rem; }
    .empty-state-sub   { font-size: 0.8rem; color: var(--text-secondary); }

    /* ── Info card ── */
    .info-card {
        background: var(--blue-bg);
        border: 1.5px solid var(--blue-border);
        border-radius: 14px;
        padding: 1.1rem 1.25rem;
        display: flex; align-items: flex-start; gap: 0.875rem;
    }
    .info-card-icon { color: var(--blue); flex-shrink: 0; margin-top: 1px; }
    .info-card-icon svg { width: 18px; height: 18px; }
    .info-card-title { font-size: 0.82rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.3rem; }
    .info-card-text  { font-size: 0.78rem; color: var(--text-secondary); line-height: 1.6; }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .rk-wrapper { padding: 1.25rem 1rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .page-title { font-size: 1.15rem; }
    }
</style>

<div class="rk-wrapper">

    {{-- ── Breadcrumb ── --}}
    <nav class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" style="display:inline;vertical-align:middle;margin-right:3px;">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Dashboard
        </a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">Kategori Rombel</span>
    </nav>

    {{-- ── Header ── --}}
    <div class="page-header">
        <div class="page-title-group">
            <div class="title-icon">🏫</div>
            <div>
                <div class="page-title">Kategori Rombel</div>
                <div class="page-subtitle">Daftar rombongan belajar berdasarkan kategori</div>
            </div>
        </div>
        <div class="count-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            {{ $rombels->count() }} Rombel
        </div>
    </div>

    {{-- ── Stats ── --}}
    @php
        $pondokCount  = $rombels->filter(fn($r) => ($r->kategori->kategori ?? null) == 'pondok')->count();
        $regulerCount = $rombels->filter(fn($r) => ($r->kategori->kategori ?? null) == 'reguler')->count();
        $lainnyaCount = $rombels->count() - $pondokCount - $regulerCount;
    @endphp

    <div class="section-title">Ringkasan Kategori</div>
    <div class="stats-grid">
        <div class="stat-card purple">
            <div class="stat-icon-wrap purple">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $pondokCount }}</div>
                <div class="stat-label">Pondok</div>
            </div>
        </div>
        <div class="stat-card blue">
            <div class="stat-icon-wrap blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $regulerCount }}</div>
                <div class="stat-label">Reguler</div>
            </div>
        </div>
        <div class="stat-card gray">
            <div class="stat-icon-wrap gray">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $lainnyaCount }}</div>
                <div class="stat-label">Belum Ditetapkan</div>
            </div>
        </div>
    </div>

    {{-- ── Split Pondok / Reguler ── --}}
    @php
        $pondokRombels  = $rombels->filter(fn($r) => ($r->kategori->kategori ?? null) == 'pondok')->sortBy('tingkat');
        $regulerRombels = $rombels->filter(fn($r) => ($r->kategori->kategori ?? null) == 'reguler')->sortBy('tingkat');

        $pondokByTingkat  = $pondokRombels->groupBy('tingkat');
        $regulerByTingkat = $regulerRombels->groupBy('tingkat');
    @endphp

    <div class="section-title">Daftar Rombel</div>
    <div class="rk-split-row">

        {{-- ── Kolom Pondok ── --}}
        <div class="rk-split-col">
            <div class="rk-split-header is-purple">
                <span class="rk-split-icon is-purple">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </span>
                <span class="rk-split-title is-purple">Pondok</span>
                <span class="rk-split-badge is-purple">{{ $pondokRombels->count() }}</span>
            </div>

            @if($pondokByTingkat->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div class="empty-state-title">Belum ada rombel pondok</div>
                </div>
            @else
                @foreach($pondokByTingkat as $tingkat => $items)
                    <div class="rk-tingkat-group">
                        <span class="rk-tingkat-label is-purple">Tingkat {{ $tingkat ?? '—' }}</span>
                        @foreach($items as $rombel)
                            <div class="rk-rombel-row">
                                <div class="rk-rombel-left">
                                    <span class="rk-rombel-icon is-purple">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" width="16" height="16">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </span>
                                    <span class="rk-rombel-name">{{ $rombel->nama_lengkap ?? $rombel->nama_rombel }}</span>
                                </div>
                                <a href="{{ route('admin.rombel-kategori.show', $rombel->id) }}" class="rk-btn-view is-purple">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>

        {{-- ── Kolom Reguler ── --}}
        <div class="rk-split-col">
            <div class="rk-split-header is-blue">
                <span class="rk-split-icon is-blue">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                </span>
                <span class="rk-split-title is-blue">Reguler</span>
                <span class="rk-split-badge is-blue">{{ $regulerRombels->count() }}</span>
            </div>

            @if($regulerByTingkat->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div class="empty-state-title">Belum ada rombel reguler</div>
                </div>
            @else
                @foreach($regulerByTingkat as $tingkat => $items)
                    <div class="rk-tingkat-group">
                        <span class="rk-tingkat-label is-blue">Tingkat {{ $tingkat ?? '—' }}</span>
                        @foreach($items as $rombel)
                            <div class="rk-rombel-row">
                                <div class="rk-rombel-left">
                                    <span class="rk-rombel-icon is-blue">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" width="16" height="16">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </span>
                                    <span class="rk-rombel-name">{{ $rombel->nama_lengkap ?? $rombel->nama_rombel }}</span>
                                </div>
                                <a href="{{ route('admin.rombel-kategori.show', $rombel->id) }}" class="rk-btn-view is-blue">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>

    </div>{{-- end rk-split-row --}}

    {{-- ── Info Card ── --}}
    <div class="info-card">
        <div class="info-card-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <div class="info-card-title">Informasi Kategori</div>
            <div class="info-card-text">
                Halaman ini menampilkan daftar rombongan belajar beserta kategorinya. Klik tombol <strong>Lihat Detail</strong> untuk melihat daftar siswa dalam rombel tersebut.
            </div>
        </div>
    </div>

</div>
@endsection