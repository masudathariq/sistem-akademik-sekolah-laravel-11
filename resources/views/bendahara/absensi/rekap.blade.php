@extends('layouts.bendahara')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap');

    :root {
        --primary: #1e40af;
        --primary-light: #3b82f6;
        --primary-surface: #eff6ff;
        --accent: #0ea5e9;
        --success: #059669;
        --success-surface: #ecfdf5;
        --warning: #d97706;
        --warning-surface: #fffbeb;
        --danger: #dc2626;
        --danger-surface: #fef2f2;
        --surface: #f8fafc;
        --border: #e2e8f0;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --card-shadow: 0 1px 3px 0 rgba(0,0,0,.06), 0 1px 2px -1px rgba(0,0,0,.04);
        --card-shadow-hover: 0 10px 15px -3px rgba(0,0,0,.08), 0 4px 6px -4px rgba(0,0,0,.05);
    }

    * { font-family: 'Plus Jakarta Sans', sans-serif; }

    .page-wrapper {
        background: var(--surface);
        min-height: 100vh;
        padding: 2rem 1.5rem 3rem;
    }

    /* ── PAGE HEADER ─────────────────────────────── */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    .page-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .page-icon {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(30,64,175,.25);
    }
    .page-icon svg { color: #fff; }
    .page-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -0.03em;
        line-height: 1.2;
    }
    .page-subtitle {
        font-size: 0.8125rem;
        color: var(--text-muted);
        margin-top: 3px;
    }

    /* ── INFO BANNER ─────────────────────────────── */
    .info-banner {
        background: var(--primary-surface);
        border: 1px solid #bfdbfe;
        border-radius: 12px;
        padding: 0.875rem 1.125rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1.75rem;
    }
    .info-banner-icon {
        width: 20px;
        height: 20px;
        color: var(--primary-light);
        flex-shrink: 0;
        margin-top: 1px;
    }
    .info-banner-text {
        font-size: 0.8125rem;
        color: #1e40af;
        line-height: 1.6;
    }
    .info-banner-text strong { font-weight: 700; }

    /* ── CARD ─────────────────────────────────────── */
    .card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: var(--card-shadow);
        overflow: hidden;
        margin-bottom: 1.75rem;
        transition: box-shadow .2s;
    }
    .card:hover { box-shadow: var(--card-shadow-hover); }
    .card-header {
        padding: 1.125rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        background: #fafafa;
    }
    .card-header-left {
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }
    .card-header-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card-title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-primary);
    }
    .card-body { padding: 1.5rem; }

    /* ── FILTER FORM ─────────────────────────────── */
    .filter-form {
        background: #fff;
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: var(--card-shadow);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.75rem;
        display: flex;
        align-items: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
        min-width: 140px;
    }
    .filter-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: .05em;
    }
    .filter-control {
        border: 1.5px solid var(--border);
        background: var(--surface);
        color: var(--text-primary);
        padding: 0.5625rem 0.75rem;
        border-radius: 9px;
        font-size: 0.875rem;
        font-weight: 500;
        outline: none;
        transition: border-color .18s, box-shadow .18s;
        appearance: none;
        -webkit-appearance: none;
    }
    .filter-control:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(59,130,246,.12);
    }
    .filter-select-wrapper {
        position: relative;
    }
    .filter-select-wrapper::after {
        content: '';
        pointer-events: none;
        position: absolute;
        right: 0.625rem;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 4.5px solid transparent;
        border-right: 4.5px solid transparent;
        border-top: 5px solid var(--text-secondary);
    }
    .filter-select-wrapper select.filter-control {
        padding-right: 2rem;
        cursor: pointer;
    }
    .btn-filter {
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        color: #fff;
        font-size: 0.875rem;
        font-weight: 700;
        padding: 0.5625rem 1.25rem;
        border-radius: 9px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .18s, transform .12s, box-shadow .18s;
        box-shadow: 0 2px 8px rgba(30,64,175,.2);
        white-space: nowrap;
    }
    .btn-filter:hover { opacity: .9; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30,64,175,.3); }
    .btn-filter:active { transform: translateY(0); }

    /* ── STAT CARDS ──────────────────────────────── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(155px, 1fr));
        gap: 1rem;
        margin-bottom: 1.75rem;
    }
    .stat-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 1.125rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        box-shadow: var(--card-shadow);
        transition: box-shadow .2s, transform .2s;
    }
    .stat-card:hover { box-shadow: var(--card-shadow-hover); transform: translateY(-2px); }
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-icon svg { width: 20px; height: 20px; }
    .stat-value {
        font-size: 1.625rem;
        font-weight: 800;
        letter-spacing: -0.04em;
        line-height: 1;
        font-family: 'DM Mono', monospace;
    }
    .stat-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 500;
        margin-top: 3px;
    }

    /* ── TABLE ───────────────────────────────────── */
    .table-wrapper { overflow-x: auto; }
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.8125rem;
    }
    .data-table thead th {
        background: #f1f5f9;
        color: var(--text-secondary);
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        padding: 0.6875rem 1rem;
        white-space: nowrap;
        border-bottom: 1px solid var(--border);
    }
    .data-table thead th:first-child { border-radius: 0; }
    .data-table tbody tr {
        transition: background .12s;
    }
    .data-table tbody tr:hover { background: #f8fafc; }
    .data-table tbody td {
        padding: 0.8125rem 1rem;
        color: var(--text-primary);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .data-table tbody tr:last-child td { border-bottom: none; }

    /* Name cell */
    .teacher-name {
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }
    .teacher-avatar {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary-surface) 0%, #dbeafe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6875rem;
        font-weight: 800;
        color: var(--primary);
        flex-shrink: 0;
        letter-spacing: -0.03em;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        font-family: 'DM Mono', monospace;
    }
    .badge-hadir { background: var(--success-surface); color: var(--success); }
    .badge-izin  { background: var(--warning-surface); color: var(--warning); }
    .badge-sakit { background: var(--danger-surface);  color: var(--danger);  }

    /* Progress bar */
    .progress-cell { min-width: 120px; }
    .progress-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .progress-bar-track {
        flex: 1;
        height: 6px;
        background: #e2e8f0;
        border-radius: 99px;
        overflow: hidden;
    }
    .progress-bar-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--success) 0%, #34d399 100%);
        transition: width .4s ease;
    }
    .progress-bar-fill.medium { background: linear-gradient(90deg, var(--warning) 0%, #fbbf24 100%); }
    .progress-bar-fill.low    { background: linear-gradient(90deg, var(--danger)  0%, #f87171 100%); }
    .progress-pct {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-secondary);
        min-width: 36px;
        text-align: right;
        font-family: 'DM Mono', monospace;
    }

    /* ── GURU LIST ───────────────────────────────── */
    .guru-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 0.625rem;
        padding: 1rem 1.25rem;
    }
    .guru-card-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 11px;
        border: 1.5px solid var(--border);
        background: #fff;
        transition: border-color .18s, background .18s, box-shadow .18s, transform .15s;
        text-decoration: none;
    }
    .guru-card-link:hover {
        border-color: var(--primary-light);
        background: var(--primary-surface);
        box-shadow: 0 0 0 3px rgba(59,130,246,.08);
        transform: translateY(-1px);
    }
    .guru-card-link:hover .guru-link-name { color: var(--primary); }
    .guru-link-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--primary);
        flex-shrink: 0;
    }
.guru-link-info {
    color: #1f2937; /* contoh */
    font-weight: bold;
}

    .guru-link-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-primary);
        transition: color .18s;
    }
    .guru-link-hint {
        font-size: 0.6875rem;
        color: var(--text-muted);
        margin-top: 1px;
    }
    .guru-arrow {
        margin-left: auto;
        color: var(--text-muted);
        opacity: 0;
        transition: opacity .18s, transform .18s;
    }
    .guru-card-link:hover .guru-arrow { opacity: 1; transform: translateX(3px); }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
    }
    .empty-state-icon { font-size: 2.5rem; margin-bottom: .5rem; }
    .empty-state p { font-size: .875rem; }

    /* Month badge in header */
    .month-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--primary-surface);
        color: var(--primary);
        border: 1px solid #bfdbfe;
        border-radius: 99px;
        padding: 4px 12px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    /* Legend */
    .legend {
        display: flex;
        flex-wrap: wrap;
        gap: .625rem;
        font-size: 0.7125rem;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
        color: var(--text-secondary);
        font-weight: 500;
    }
    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    @media (max-width: 640px) {
        .page-wrapper { padding: 1rem; }
        .filter-form { padding: 1rem; }
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .guru-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page-wrapper">
    <div style="max-width:1140px; margin:0 auto;">

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header">
            <div class="page-header-left">
                <div class="page-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                </div>
                <div>
                    <div class="page-title">Rekap Absensi Guru</div>
                    <div class="page-subtitle">Pantau kehadiran seluruh guru secara bulanan</div>
                </div>
            </div>
            <div class="month-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM') }} {{ $tahun }}
            </div>
        </div>

        {{-- ── INFO BANNER ── --}}
        <div class="info-banner">
            <svg class="info-banner-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            <div class="info-banner-text">
                <strong>Cara menggunakan halaman ini:</strong>
                Pilih <strong>Bulan</strong> dan <strong>Tahun</strong> lalu klik <strong>Terapkan Filter</strong> untuk memuat rekap absensi.
                Tabel ringkasan menampilkan akumulasi kehadiran, izin, dan sakit setiap guru dalam satu bulan.
                Klik nama guru di bagian <em>Daftar Guru</em> untuk melihat detail absensi hariannya.
                Persentase kehadiran dihitung dari <strong>Hadir ÷ Jumlah Hari Aktif</strong> bulan yang dipilih.
            </div>
        </div>

        {{-- ── FILTER FORM ── --}}
        <form method="GET" action="{{ route('bendahara.rekap') }}" class="filter-form">
            <div style="display:flex;align-items:center;gap:6px;margin-right:auto;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                <span style="font-size:.8125rem;font-weight:700;color:var(--text-secondary);">Filter Periode</span>
            </div>

            <div class="filter-group">
                <label class="filter-label">Bulan</label>
                <div class="filter-select-wrapper">
                    <select name="bulan" class="filter-control">
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromDate(null, $m, 1)->locale('id')->isoFormat('MMMM') }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="filter-group" style="min-width:110px;">
                <label class="filter-label">Tahun</label>
                <input type="number" name="tahun" value="{{ $tahun }}"
                       min="2020" max="2099"
                       class="filter-control" style="width:100%;">
            </div>

            <button type="submit" class="btn-filter">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Terapkan Filter
            </button>
        </form>

        {{-- ── STAT CARDS ── --}}
        @php
            $col      = collect($rekapGuru);
            $totalGuru = $col->count();
            $topHadir  = $col->sortByDesc('hadir')->first();
            $topIzin   = $col->sortByDesc('izin')->first();
            $topSakit  = $col->sortByDesc('sakit')->first();
        @endphp
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background:#eff6ff;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <div class="stat-value" style="color:var(--primary);">{{ $totalGuru }}</div>
                    <div class="stat-label">Total Guru</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:var(--success-surface);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div>
                    <div class="stat-value" style="color:var(--success);">{{ $topHadir ? $topHadir['hadir'] : 0 }}</div>
                    <div class="stat-label">Hadir Terbanyak</div>
                    @if($topHadir)
                        <div style="font-size:.7rem; color:var(--text-muted); margin-top:2px;">{{ $topHadir['guru']->nama }}</div>
                    @endif
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:var(--warning-surface);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <div class="stat-value" style="color:var(--warning);">{{ $topIzin ? $topIzin['izin'] : 0 }}</div>
                    <div class="stat-label">Izin Terbanyak</div>
                    @if($topIzin)
                        <div style="font-size:.7rem; color:var(--text-muted); margin-top:2px;">{{ $topIzin['guru']->nama }}</div>
                    @endif
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:var(--danger-surface);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <div>
                    <div class="stat-value" style="color:var(--danger);">{{ $topSakit ? $topSakit['sakit'] : 0 }}</div>
                    <div class="stat-label">Sakit Terbanyak</div>
                    @if($topSakit)
                        <div style="font-size:.7rem; color:var(--text-muted); margin-top:2px;">{{ $topSakit['guru']->nama }}</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ── REKAP TABLE ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon" style="background:var(--primary-surface);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <div>
                        <div class="card-title">Ringkasan Kehadiran</div>
                        <div style="font-size:.75rem;color:var(--text-muted);margin-top:1px;">
                            {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM') }} {{ $tahun }}
                        </div>
                    </div>
                </div>
                <div class="legend">
                    <div class="legend-item"><div class="legend-dot" style="background:var(--success);"></div>Hadir</div>
                    <div class="legend-item"><div class="legend-dot" style="background:var(--warning);"></div>Izin</div>
                    <div class="legend-item"><div class="legend-dot" style="background:var(--danger);"></div>Sakit</div>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Nama Guru</th>
                            <th style="text-align:center;">Hadir</th>
                            <th style="text-align:center;">Izin</th>
                            <th style="text-align:center;">Sakit</th>
                            <th style="text-align:center;">Jml. Hari</th>
                            <th style="text-align:left; min-width:130px;">Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekapGuru as $rg)
                            @php
                                $pct = (float) $rg['persenHadir'];
                                $barClass = $pct >= 80 ? '' : ($pct >= 50 ? 'medium' : 'low');
                            @endphp
                            <tr>
                                <td>
                                    <div class="teacher-name">
                                        <div class="teacher-avatar">
                                            {{ strtoupper(substr($rg['guru']->nama, 0, 2)) }}
                                        </div>
                                        {{ $rg['guru']->nama }}
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge badge-hadir">{{ $rg['hadir'] }}</span>
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge badge-izin">{{ $rg['izin'] }}</span>
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge badge-sakit">{{ $rg['sakit'] }}</span>
                                </td>
                                <td style="text-align:center; font-family:'DM Mono',monospace; font-weight:600; color:var(--text-secondary);">
                                    {{ $rg['jumlahHari'] }}
                                </td>
                                <td class="progress-cell">
                                    <div class="progress-wrap">
                                        <div class="progress-bar-track">
                                            <div class="progress-bar-fill {{ $barClass }}" data-width="{{ min($pct, 100) }}"></div>
                                        </div>
                                        <span class="progress-pct">{{ $pct }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">📭</div>
                                        <p>Belum ada data rekap untuk periode ini.</p>
                                        <p style="font-size:.75rem;margin-top:4px;">Coba pilih bulan atau tahun yang berbeda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── GURU LIST ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon" style="background:#f0fdf4;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <div class="card-title">Daftar Guru</div>
                        <div style="font-size:.75rem;color:var(--text-muted);margin-top:1px;">
                            Klik nama untuk melihat detail absensi harian
                        </div>
                    </div>
                </div>
                <span style="font-size:.75rem;font-weight:600;color:var(--text-muted);background:#f1f5f9;padding:4px 10px;border-radius:99px;">
                    {{ count($guruList) }} guru
                </span>
            </div>

            @if($guruList->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">👤</div>
                    <p>Belum ada data guru terdaftar.</p>
                </div>
            @else
                <div class="guru-grid">
                    @foreach($guruList as $guru)
                        <a href="{{ route('bendahara.rekap.show', $guru->id) }}" class="guru-card-link">
                            <div class="guru-link-avatar">
                                {{ strtoupper(substr($guru->nama, 0, 2)) }}
                            </div>
                            <div class="guru-link-info">
                                <div class="guru-link-name">{{ $guru->nama }}</div>
                                <div class="guru-link-hint">Lihat detail absensi →</div>
                            </div>
                            <svg class="guru-arrow" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>{{-- /max-width wrapper --}}
</div>{{-- /page-wrapper --}}

@push('scripts')
<script>
    document.querySelectorAll('.progress-bar-fill[data-width]').forEach(el => {
        el.style.width = el.dataset.width + '%';
    });
</script>
@endpush
@endsection