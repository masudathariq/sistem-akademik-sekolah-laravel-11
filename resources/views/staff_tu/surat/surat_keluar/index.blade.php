@extends('layouts.staff_tu')

@section('title', 'Surat Keluar')

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

/* ── BUTTON CREATE ── */
.btn-create {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--navy-md); color: white;
    padding: 8px 18px; border-radius: 8px;
    font-size: 13px; font-weight: 600; text-decoration: none;
    transition: all .15s;
}
.btn-create:hover {
    background: var(--navy);
    transform: translateY(-1px);
}

/* ── FLASH MESSAGES ── */
.flash-success {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--green-lt); border: 1px solid var(--green-bd);
    border-radius: 8px; font-size: 13px; font-weight: 600; color: var(--green);
    margin-bottom: 1.25rem;
}
.flash-error {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--red-lt); border: 1px solid var(--red-bd);
    border-radius: 8px; font-size: 13px; font-weight: 600; color: var(--red);
    margin-bottom: 1.25rem;
}
.flash-close {
    margin-left: auto; cursor: pointer;
    opacity: 0.6; transition: opacity .15s;
}
.flash-close:hover { opacity: 1; }

/* ── STAT CARDS (Status Cards) ── */
.stats-row {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 12px; margin-bottom: 1.75rem;
}
.stat-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; padding: 1rem 1.125rem;
    box-shadow: var(--shadow);
    text-decoration: none;
    transition: all .2s;
    display: flex; justify-content: space-between; align-items: center;
}
.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,.08);
}
.stat-left .stat-label {
    font-size: 11px; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
    font-weight: 600; margin-bottom: 4px;
}
.stat-left .stat-val {
    font-size: 26px; font-weight: 600; letter-spacing: -.03em;
}
.stat-right {
    font-size: 28px; opacity: 0.7;
}
.stat-yellow .stat-val { color: var(--amber); }
.stat-green .stat-val { color: var(--green); }
.stat-gray .stat-val { color: var(--muted); }

/* ── FILTER CARD ── */
.filter-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow);
    margin-bottom: 1.75rem;
    overflow: hidden;
}
.filter-header {
    padding: .75rem 1.25rem; border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.filter-title {
    font-size: 12px; font-weight: 600; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
}
.filter-body {
    padding: 1.25rem;
}
.filter-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
}
.filter-group label {
    display: block; font-size: 11px; font-weight: 600; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em; margin-bottom: 6px;
}
.filter-input {
    width: 100%; padding: 8px 12px;
    border: 1px solid var(--border); border-radius: 8px;
    font-size: 13px; font-family: inherit;
    background: white; transition: all .15s;
}
.filter-input:focus {
    outline: none; border-color: var(--navy-md); box-shadow: 0 0 0 3px rgba(29,78,216,.1);
}
.filter-select {
    width: 100%; padding: 8px 12px;
    border: 1px solid var(--border); border-radius: 8px;
    font-size: 13px; font-family: inherit;
    background: white;
}
.filter-actions {
    display: flex; gap: 10px; align-items: flex-end;
}
.btn-filter {
    padding: 8px 16px; border-radius: 8px;
    font-size: 12px; font-weight: 600;
    background: var(--navy-md); color: white;
    border: none; cursor: pointer;
}
.btn-filter:hover { background: var(--navy); }
.btn-reset {
    padding: 8px 16px; border-radius: 8px;
    font-size: 12px; font-weight: 600;
    background: var(--gray-bg); color: var(--muted);
    text-decoration: none; border: 1px solid var(--border);
}
.btn-reset:hover { background: var(--border); }

/* ── TABLE CARD ── */
.table-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow);
    overflow: hidden;
}
.table-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: .75rem 1.25rem; border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.table-card-title {
    font-size: 12px; font-weight: 600; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
}
.table-count {
    font-size: 12px; color: var(--hint);
    background: var(--gray-bg); border: 1px solid var(--border);
    border-radius: 99px; padding: 2px 10px; font-weight: 600;
}

/* ── TABLE STYLE ── */
.ta-table { width: 100%; border-collapse: collapse; }
.ta-table thead th {
    padding: .7rem 1.25rem; text-align: left;
    font-size: 11px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .06em;
    background: var(--gray-bg); border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.ta-table thead th:last-child { text-align: right; }
.ta-table tbody tr {
    border-bottom: 1px solid #f1f5f9; transition: background .12s;
}
.ta-table tbody tr:last-child { border-bottom: none; }
.ta-table tbody tr:hover { background: #f8fafc; }
.ta-table td {
    padding: .875rem 1.25rem; vertical-align: middle;
    font-size: 13px; color: var(--text);
}
.ta-table td:last-child { text-align: right; }
.td-no {
    font-size: 12px; color: var(--hint);
    font-weight: 500; width: 50px; text-align: center;
}
.td-mono { font-family: 'Courier New', monospace; font-size: 12px; font-weight: 600; color: var(--navy-md); }

/* ── STATUS BADGES ── */
.status-badge {
    display: inline-flex; align-items: center;
    padding: 3px 12px; border-radius: 99px;
    font-size: 11px; font-weight: 600;
}
.status-draf { background: var(--amber-lt); color: var(--amber); border: 1px solid var(--amber-bd); }
.status-terkirim { background: var(--green-lt); color: var(--green); border: 1px solid var(--green-bd); }
.status-arsip { background: var(--gray-bg); color: var(--muted); border: 1px solid var(--border); }

/* ── ACTION BUTTONS ── */
.tbl-actions { display: inline-flex; align-items: center; gap: 8px; }
.btn-sm {
    display: inline-flex; align-items: center; gap: 5px;
    padding: .375rem .8rem; border-radius: 7px;
    font-size: 12px; font-weight: 600; cursor: pointer;
    text-decoration: none; transition: background .15s, transform .1s;
    border: 1px solid; background: none;
    font-family: 'IBM Plex Sans', sans-serif;
}
.btn-sm:active { transform: scale(.96); }
.btn-view  { color: var(--navy-md); border-color: #bfdbfe; background: var(--navy-lt); }
.btn-view:hover  { background: #bfdbfe; }
.btn-edit  { color: var(--amber); border-color: var(--amber-bd); background: var(--amber-lt); }
.btn-edit:hover  { background: #fef3c7; }

/* ── EMPTY STATE ── */
.empty-state { text-align: center; padding: 2.5rem 1rem; }
.empty-icon {
    width: 48px; height: 48px; background: var(--gray-bg);
    border-radius: 12px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.empty-state strong { display: block; font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.empty-state p { font-size: 13px; color: var(--muted); }

/* ── PAGINATION ── */
.pagination-container {
    padding: 1rem 1.25rem;
    border-top: 1px solid var(--border);
    background: #fdfdfd;
}
.pagination-container nav {
    display: flex; justify-content: center;
}
.pagination-container .pagination {
    display: flex; gap: 4px; margin: 0; padding: 0;
}
.pagination-container .page-item {
    list-style: none;
}
.pagination-container .page-link {
    display: flex; align-items: center; justify-content: center;
    min-width: 32px; height: 32px;
    padding: 0 8px; border-radius: 6px;
    font-size: 13px; color: var(--muted);
    text-decoration: none; transition: all .15s;
}
.pagination-container .page-link:hover {
    background: var(--gray-bg); color: var(--navy-md);
}
.pagination-container .active .page-link {
    background: var(--navy-md); color: white;
}
.pagination-container .disabled .page-link {
    opacity: 0.4; cursor: not-allowed;
}

/* ── MOBILE VIEW (CARD STYLE) ── */
.mobile-list { display: none; }
.mobile-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 12px; padding: 1rem; margin-bottom: 12px;
    box-shadow: var(--shadow);
}
.mobile-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--border);
}
.mobile-field {
    margin-bottom: 10px;
}
.mobile-label {
    font-size: 10px; color: var(--hint);
    text-transform: uppercase; letter-spacing: .05em;
    font-weight: 600; margin-bottom: 2px;
}
.mobile-value {
    font-size: 13px; font-weight: 500; color: var(--text);
}
.mobile-row {
    display: flex; gap: 12px; margin-bottom: 8px;
}
.mobile-row .mobile-field { flex: 1; margin-bottom: 0; }
.mobile-actions {
    display: flex; gap: 8px; margin-top: 12px;
    padding-top: 10px; border-top: 1px solid var(--border);
}
.mobile-actions .btn-sm { flex: 1; justify-content: center; }

@media (max-width: 768px) {
    .rb-page { padding: 1rem; }
    .desktop-table { display: none; }
    .mobile-list { display: block; }
    .stats-row { grid-template-columns: repeat(3, 1fr); }
    .stat-left .stat-val { font-size: 20px; }
    .top-bar { flex-direction: column; align-items: flex-start; }
    .btn-create { width: 100%; justify-content: center; }
    .filter-grid { grid-template-columns: 1fr; }
    .filter-actions { grid-column: span 1; }
}
</style>

<div class="rb-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Surat Keluar</h1>
                <p>Kelola seluruh surat keluar sekolah &mdash; <strong>{{ $suratKeluar->total() }} Surat</strong></p>
            </div>
        </div>
        <a href="{{ route('staff_tu.surat_keluar.create') }}" class="btn-create">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Surat
        </a>
    </div>

    {{-- ═══ FLASH MESSAGES ═══ --}}
    @if(session('success'))
    <div class="flash-success" id="flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
        <span class="flash-close" onclick="document.getElementById('flash-success')?.remove()">✕</span>
    </div>
    @endif

    @if(session('error'))
    <div class="flash-error" id="flash-error">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        {{ session('error') }}
        <span class="flash-close" onclick="document.getElementById('flash-error')?.remove()">✕</span>
    </div>
    @endif

    {{-- ═══ STATUS CARDS ═══ --}}
    <div class="stats-row">
        <a href="{{ route('staff_tu.surat_keluar.index', ['status' => 'Draf']) }}" class="stat-card stat-yellow">
            <div class="stat-left">
                <div class="stat-label">Draf</div>
                <div class="stat-val">{{ $countDraf }}</div>
            </div>
            <div class="stat-right">📄</div>
        </a>
        <a href="{{ route('staff_tu.surat_keluar.index', ['status' => 'Terkirim']) }}" class="stat-card stat-green">
            <div class="stat-left">
                <div class="stat-label">Terkirim</div>
                <div class="stat-val">{{ $countTerkirim }}</div>
            </div>
            <div class="stat-right">📤</div>
        </a>
        <a href="{{ route('staff_tu.surat_keluar.index', ['status' => 'Arsip']) }}" class="stat-card stat-gray">
            <div class="stat-left">
                <div class="stat-label">Arsip</div>
                <div class="stat-val">{{ $countArsip }}</div>
            </div>
            <div class="stat-right">🗂️</div>
        </a>
    </div>

    {{-- ═══ FILTER CARD ═══ --}}
    <div class="filter-card">
        <div class="filter-header">
            <span class="filter-title">🔍 Filter Pencarian</span>
        </div>
        <div class="filter-body">
            <form action="{{ route('staff_tu.surat_keluar.index') }}" method="GET">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label>Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari nomor / tujuan / perihal..."
                               class="filter-input">
                    </div>
                    <div class="filter-group">
                        <label>Status</label>
                        <select name="status" class="filter-select">
                            <option value="">Semua</option>
                            <option value="Draf" {{ request('status') == 'Draf' ? 'selected' : '' }}>Draf</option>
                            <option value="Terkirim" {{ request('status') == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                            <option value="Arsip" {{ request('status') == 'Arsip' ? 'selected' : '' }}>Arsip</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Jenis</label>
                        <input type="text" name="jenis" value="{{ request('jenis') }}"
                               placeholder="Jenis surat..."
                               class="filter-input">
                    </div>
                    <div class="filter-group filter-actions">
                        <button type="submit" class="btn-filter">Terapkan Filter</button>
                        <a href="{{ route('staff_tu.surat_keluar.index') }}" class="btn-reset">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══ TABLE CARD (DESKTOP) ═══ --}}
    <div class="table-card desktop-table">
        <div class="table-card-header">
            <span class="table-card-title">Daftar Surat Keluar</span>
            <span class="table-count">{{ $suratKeluar->total() }} surat</span>
        </div>

        <table class="ta-table">
            <thead>
                <tr>
                    <th style="width:52px;text-align:center">No</th>
                    <th>Nomor Surat</th>
                    <th>Tgl Surat</th>
                    <th>Tgl Keluar</th>
                    <th>Tujuan</th>
                    <th>Perihal</th>
                    <th>Status</th>
                    <th style="width:160px;text-align:right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suratKeluar as $index => $surat)
                <tr>
                    <td class="td-no">{{ str_pad($suratKeluar->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}</td>
                    <td class="td-mono">{{ $surat->nomor_surat }}</td>
                    <td class="td-muted">{{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                    <td class="td-muted">{{ $surat->tanggal_keluar->format('d/m/Y') }}</td>
                    <td class="td-wrap" style="max-width: 150px;">{{ Str::limit($surat->tujuan, 30) }}</td>
                    <td class="td-wrap" style="max-width: 180px;">{{ Str::limit($surat->perihal, 40) }}</td>
                    <td>
                        @if($surat->status == 'Draf')
                            <span class="status-badge status-draf">📄 Draf</span>
                        @elseif($surat->status == 'Terkirim')
                            <span class="status-badge status-terkirim">📤 Terkirim</span>
                        @else
                            <span class="status-badge status-arsip">🗂️ Arsip</span>
                        @endif
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('staff_tu.surat_keluar.show', $surat) }}" class="btn-sm btn-view">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                Lihat
                            </a>
                            @if(!$surat->isArsip())
                            <a href="{{ route('staff_tu.surat_keluar.edit', $surat) }}" class="btn-sm btn-edit">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                                    <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                                </svg>
                            </div>
                            <strong>Belum Ada Data Surat Keluar</strong>
                            <p>Klik tombol "Tambah Surat" untuk membuat surat keluar baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($suratKeluar->hasPages())
        <div class="pagination-container">
            {{ $suratKeluar->links() }}
        </div>
        @endif
    </div>

    {{-- ═══ MOBILE VIEW (CARD STYLE) ═══ --}}
    <div class="mobile-list">
        @forelse($suratKeluar as $index => $surat)
        <div class="mobile-card">
            <div class="mobile-header">
                <span class="td-mono" style="font-size: 11px;">{{ $surat->nomor_surat }}</span>
                @if($surat->status == 'Draf')
                    <span class="status-badge status-draf" style="font-size: 9px;">Draf</span>
                @elseif($surat->status == 'Terkirim')
                    <span class="status-badge status-terkirim" style="font-size: 9px;">Terkirim</span>
                @else
                    <span class="status-badge status-arsip" style="font-size: 9px;">Arsip</span>
                @endif
            </div>
            <div class="mobile-field">
                <div class="mobile-label">Perihal</div>
                <div class="mobile-value">{{ Str::limit($surat->perihal, 60) }}</div>
            </div>
            <div class="mobile-field">
                <div class="mobile-label">Tujuan</div>
                <div class="mobile-value">{{ $surat->tujuan }}</div>
            </div>
            <div class="mobile-row">
                <div class="mobile-field">
                    <div class="mobile-label">Tgl Surat</div>
                    <div class="mobile-value">{{ $surat->tanggal_surat->format('d/m/Y') }}</div>
                </div>
                <div class="mobile-field">
                    <div class="mobile-label">Tgl Keluar</div>
                    <div class="mobile-value">{{ $surat->tanggal_keluar->format('d/m/Y') }}</div>
                </div>
            </div>
            <div class="mobile-actions">
                <a href="{{ route('staff_tu.surat_keluar.show', $surat) }}" class="btn-sm btn-view">
                    👁️ Lihat
                </a>
                @if(!$surat->isArsip())
                <a href="{{ route('staff_tu.surat_keluar.edit', $surat) }}" class="btn-sm btn-edit">
                    ✏️ Edit
                </a>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                    <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                </svg>
            </div>
            <strong>Belum Ada Data Surat Keluar</strong>
            <p>Klik tombol "Tambah Surat" untuk membuat surat keluar baru.</p>
        </div>
        @endforelse
    </div>

    @if($suratKeluar->hasPages())
    <div class="mobile-list" style="margin-top: 1rem;">
        {{ $suratKeluar->links() }}
    </div>
    @endif

</div>

@endsection