@extends('layouts.staff_tu')

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
    --amber:    #d97706;
    --amber-lt: #fffbeb;
    --amber-bd: #fcd34d;
    --red:      #dc2626;
    --red-lt:   #fff1f2;
    --red-bd:   #fecdd3;
    --pink:     #be185d;
    --pink-lt:  #fdf2f8;
    --pink-bd:  #f9a8d4;
    --indigo:   #4338ca;
    --indigo-lt:#eef2ff;
    --indigo-bd:#c7d2fe;
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
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.75rem;
}
.page-title { display: flex; align-items: center; gap: 12px; }
.title-icon {
    width: 44px; height: 44px;
    background: var(--navy-lt);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.title-text h1 {
    font-size: 20px; font-weight: 600;
    color: var(--text); margin: 0 0 3px;
    letter-spacing: -.02em;
}
.title-text p { font-size: 13px; color: var(--muted); margin: 0; }
.title-text p strong { color: var(--navy-md); font-weight: 600; }
.title-text p.warn-ta { color: #d97706; font-weight: 600; }

.top-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

.btn-add {
    display: inline-flex; align-items: center; gap: 7px;
    padding: .575rem 1.1rem;
    background: var(--navy); color: #fff;
    border: none; border-radius: 8px;
    font-size: 13px; font-weight: 600;
    text-decoration: none; cursor: pointer;
    transition: background .15s, transform .12s;
    white-space: nowrap; font-family: 'IBM Plex Sans', sans-serif;
}
.btn-add:hover { background: var(--navy-md); }
.btn-add:active { transform: scale(.97); }

.btn-secondary {
    display: inline-flex; align-items: center; gap: 7px;
    padding: .575rem 1rem;
    background: #fff; color: var(--muted);
    border: 1px solid var(--border); border-radius: 8px;
    font-size: 13px; font-weight: 600;
    text-decoration: none; cursor: pointer;
    transition: background .15s, transform .12s;
    white-space: nowrap; font-family: 'IBM Plex Sans', sans-serif;
}
.btn-secondary:hover { background: var(--gray-bg); color: var(--text); }
.btn-secondary:active { transform: scale(.97); }

.btn-green {
    display: inline-flex; align-items: center; gap: 7px;
    padding: .575rem 1rem;
    background: var(--green-lt); color: var(--green);
    border: 1px solid var(--green-bd); border-radius: 8px;
    font-size: 13px; font-weight: 600;
    text-decoration: none; cursor: pointer;
    transition: background .15s, transform .12s;
    white-space: nowrap; font-family: 'IBM Plex Sans', sans-serif;
}
.btn-green:hover { background: #dcfce7; }
.btn-green:active { transform: scale(.97); }

.btn-indigo {
    display: inline-flex; align-items: center; gap: 7px;
    padding: .575rem 1rem;
    background: var(--indigo-lt); color: var(--indigo);
    border: 1px solid var(--indigo-bd); border-radius: 8px;
    font-size: 13px; font-weight: 600;
    text-decoration: none; cursor: pointer;
    transition: background .15s, transform .12s;
    white-space: nowrap; font-family: 'IBM Plex Sans', sans-serif;
}
.btn-indigo:hover { background: #e0e7ff; }
.btn-indigo:active { transform: scale(.97); }

/* ── FLASH ── */
.flash-success {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--green-lt);
    border: 1px solid var(--green-bd);
    border-radius: 8px;
    font-size: 13px; font-weight: 600; color: var(--green);
    margin-bottom: 1.25rem;
}

/* ── INFO BANNER (tips) ── */
.info-banner {
    display: flex; gap: 12px; align-items: flex-start;
    padding: .875rem 1rem;
    background: #f0f9ff;
    border: 1px solid #bae6fd;
    border-radius: 10px; margin-bottom: 1.5rem;
}
.info-banner-body { font-size: 13px; color: #0369a1; line-height: 1.7; }
.info-banner-body strong { font-weight: 600; }

/* ── STAT CARDS ── */
.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px; margin-bottom: 1.75rem;
}
.stat-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; padding: 1rem 1.125rem;
    box-shadow: var(--shadow);
}
.stat-label {
    font-size: 11px; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
    font-weight: 600; margin-bottom: 6px;
}
.stat-val { font-size: 26px; font-weight: 600; color: var(--text); letter-spacing: -.03em; }
.stat-val.blue   { color: var(--navy-md); }
.stat-val.green  { color: #15803d; }
.stat-val.pink   { color: var(--pink); }
.stat-val.amber  { color: var(--amber); }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

/* ── FILTER + SEARCH BAR ── */
.filter-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow);
    padding: 1rem 1.25rem; margin-bottom: 1.25rem;
}
.filter-row {
    display: grid; grid-template-columns: 1fr 1fr auto; gap: 12px; align-items: end;
}
.filter-field { display: flex; flex-direction: column; gap: 5px; }
.filter-field label {
    font-size: 11px; font-weight: 600; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
}
.filter-field select {
    padding: .525rem .875rem; font-size: 13px;
    font-family: 'IBM Plex Sans', sans-serif;
    border: 1px solid var(--border); border-radius: 8px;
    background: #fff; color: var(--text); outline: none;
    transition: border-color .15s, box-shadow .15s; appearance: none;
}
.filter-field select:focus { border-color: var(--navy-md); box-shadow: 0 0 0 3px rgba(29,78,216,.1); }
.filter-actions { display: flex; gap: 8px; align-items: center; padding-top: 2px; }

.filter-divider { border: none; border-top: 1px solid var(--border); margin: .875rem 0; }

.search-row { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
.search-wrap { position: relative; flex: 1; max-width: 380px; }
.search-icon { position: absolute; left: .75rem; top: 50%; transform: translateY(-50%); pointer-events: none; }
.search-input {
    width: 100%; padding: .525rem .75rem .525rem 2.25rem;
    font-size: 13px; font-family: 'IBM Plex Sans', sans-serif;
    border: 1px solid var(--border); border-radius: 8px;
    background: #fff; color: var(--text); outline: none;
    transition: border-color .15s, box-shadow .15s;
}
.search-input:focus { border-color: var(--navy-md); box-shadow: 0 0 0 3px rgba(29,78,216,.1); }
.pag-info {
    font-size: 12.5px; color: var(--muted);
}
.pag-info strong { color: var(--text); font-weight: 600; }

/* ── TABLE CARD ── */
.table-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow);
    overflow: hidden; margin-bottom: 1.25rem;
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

/* ── TABLE ── */
.ta-table { width: 100%; border-collapse: collapse; }
.ta-table thead th {
    padding: .7rem 1.25rem; text-align: left;
    font-size: 11px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .06em;
    background: var(--gray-bg); border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.ta-table thead th.th-center { text-align: center; }
.ta-table thead th:last-child { text-align: right; }

.ta-table tbody tr {
    border-bottom: 1px solid #f1f5f9; transition: background .12s;
}
.ta-table tbody tr:last-child { border-bottom: none; }
.ta-table tbody tr:hover { background: #f8fafc; }

.ta-table td {
    padding: .875rem 1.25rem; vertical-align: middle;
    font-size: 13.5px; color: var(--text);
}
.ta-table td:last-child { text-align: right; }

.td-no {
    font-size: 12px; color: var(--hint);
    font-weight: 500; width: 50px; text-align: center;
}
.td-mono { font-family: 'Courier New', monospace; font-size: 12.5px; color: var(--muted); }
.td-mono-sub { font-size: 11px; color: var(--hint); margin-top: 2px; font-family: 'Courier New', monospace; }

/* ── AVATAR ── */
.tbl-avatar {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 8px;
    font-size: 12px; font-weight: 600; flex-shrink: 0;
}
.av-l { background: var(--navy-lt); border: 1px solid #bfdbfe; color: var(--navy-md); }
.av-p { background: var(--pink-lt); border: 1px solid var(--pink-bd); color: var(--pink); }

.td-nama { font-size: 14px; font-weight: 600; color: var(--text); }
.td-sub  { font-size: 12px; color: var(--muted); }

/* ── BADGES ── */
.jk-badge {
    display: inline-flex; align-items: center;
    padding: 2px 10px; border-radius: 99px;
    font-size: 12px; font-weight: 600; white-space: nowrap;
}
.jk-l { background: var(--navy-lt); border: 1px solid #bfdbfe; color: var(--navy-md); }
.jk-p { background: var(--pink-lt); border: 1px solid var(--pink-bd); color: var(--pink); }

.rombel-tag { font-size: 13px; font-weight: 500; color: var(--text); }
.rombel-empty {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 2px 9px; border-radius: 99px;
    background: var(--amber-lt); border: 1px solid var(--amber-bd);
    color: var(--amber); font-size: 12px; font-weight: 600;
}

/* ── ACTION BUTTONS ── */
.tbl-actions { display: inline-flex; align-items: center; gap: 6px; }
.btn-sm {
    display: inline-flex; align-items: center; gap: 5px;
    padding: .375rem .8rem; border-radius: 7px;
    font-size: 12.5px; font-weight: 600; cursor: pointer;
    text-decoration: none; transition: background .15s, transform .1s;
    border: 1px solid; background: none;
    font-family: 'IBM Plex Sans', sans-serif;
}
.btn-sm:active { transform: scale(.96); }
.btn-view  { color: var(--muted); border-color: var(--border); background: var(--gray-bg); }
.btn-view:hover  { background: #f1f5f9; }
.btn-edit  { color: var(--amber); border-color: var(--amber-bd); background: var(--amber-lt); }
.btn-edit:hover  { background: #fef3c7; }
.btn-hapus { color: var(--red); border-color: var(--red-bd); background: var(--red-lt); }
.btn-hapus:hover { background: #fee2e2; }

/* ── EMPTY ── */
.empty-state { text-align: center; padding: 2.5rem 1rem; }
.empty-icon {
    width: 48px; height: 48px; background: var(--gray-bg);
    border-radius: 12px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.empty-state strong { display: block; font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.empty-state p { font-size: 13px; color: var(--muted); }

/* ── PAGINATION ── */
.pag-wrap {
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; padding: .875rem 1rem;
    box-shadow: var(--shadow);
}

/* ── IMPORT LABEL ── */
.btn-import {
    display: inline-flex; align-items: center; gap: 7px;
    padding: .575rem 1rem;
    background: var(--indigo-lt); color: var(--indigo);
    border: 1px solid var(--indigo-bd); border-radius: 8px;
    font-size: 13px; font-weight: 600;
    cursor: pointer; transition: background .15s, transform .12s;
    white-space: nowrap; font-family: 'IBM Plex Sans', sans-serif;
}
.btn-import:hover { background: #e0e7ff; }
.btn-import:active { transform: scale(.97); }
</style>

<div class="rb-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Data Siswa</h1>
                @if($tahunAjaranAktif)
                    <p>Tahun Ajaran Aktif: <strong>{{ $tahunAjaranAktif->tahun_ajaran }} &mdash; Semester {{ $tahunAjaranAktif->semester }}</strong></p>
                @else
                    <p class="warn-ta">⚠ Belum ada tahun ajaran aktif</p>
                @endif
            </div>
        </div>
        <div class="top-actions">
            <a href="{{ route('staff_tu.siswa.exportData', request()->except('page')) }}" class="btn-green">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Export Excel
            </a>
            <a href="{{ route('staff_tu.siswa.exportPdf', request()->except('page')) }}" class="btn-secondary">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16v16H4V4z"/><path d="M8 16h8"/><path d="M8 12h6"/><path d="M8 8h4"/>
                </svg>
                Export PDF
            </a>
            <a href="{{ route('staff_tu.siswa.export') }}" class="btn-indigo">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Template
            </a>
            <form action="{{ route('staff_tu.siswa.import') }}" method="POST" enctype="multipart/form-data" style="margin:0;">
                @csrf
                <label class="btn-import">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    Import Excel
                    <input type="file" name="file" required style="display:none;" onchange="this.form.submit()">
                </label>
            </form>
            <a href="{{ url('/staff_tu/siswa/create') }}" class="btn-add">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Siswa
            </a>
        </div>
    </div>

    {{-- ═══ FLASH ═══ --}}
    @if(session('success'))
    <div class="flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ═══ INFO BANNER ═══ --}}
    <div class="info-banner">
        <div style="flex-shrink:0;margin-top:1px;">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#0369a1" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="info-banner-body">
            <strong>Tips:</strong> Export template dapat digunakan untuk input data baru.
            Gunakan <strong>Export Data</strong> untuk mengambil data siswa sesuai filter yang dipilih.
            Gunakan <strong>Import Excel</strong> untuk menambahkan banyak siswa sekaligus.
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Siswa</div>
            <div class="stat-val">{{ $siswas->total() }}</div>
            <div class="stat-sub">semua tingkat</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Laki-laki</div>
            <div class="stat-val blue">{{ \App\Models\Tatausaha\Siswa::where('jenis_kelamin','L')->count() }}</div>
            <div class="stat-sub">siswa laki-laki</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Perempuan</div>
            <div class="stat-val pink">{{ \App\Models\Tatausaha\Siswa::where('jenis_kelamin','P')->count() }}</div>
            <div class="stat-sub">siswa perempuan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Belum Rombel</div>
            <div class="stat-val amber">{{ \App\Models\Tatausaha\Siswa::whereNull('rombel_id')->count() }}</div>
            <div class="stat-sub">belum ditempatkan</div>
        </div>
    </div>

    {{-- ═══ FILTER CARD ═══ --}}
    <div class="filter-card">
        <form method="GET" action="{{ route('staff_tu.siswa.index') }}">
            <div class="filter-row">
                <div class="filter-field">
                    <label for="filterTingkat">Tingkat Kelas</label>
                    <select name="tingkat" id="filterTingkat">
                        <option value="">Semua Tingkat</option>
                        <option value="7" {{ request('tingkat') == '7' ? 'selected' : '' }}>VII</option>
                        <option value="8" {{ request('tingkat') == '8' ? 'selected' : '' }}>VIII</option>
                        <option value="9" {{ request('tingkat') == '9' ? 'selected' : '' }}>IX</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label for="filterRombel">Kode Rombel</label>
                    <select name="kode_rombel" id="filterRombel">
                        <option value="">Semua Rombel</option>
                        @foreach($rombels as $rombel)
                            <option value="{{ $rombel->kode_rombel }}"
                                    data-tingkat="{{ $rombel->tingkat }}"
                                    {{ request('kode_rombel') == $rombel->kode_rombel ? 'selected' : '' }}>
                                {{ $rombel->tingkat_romawi }} {{ $rombel->kode_rombel }} – {{ $rombel->nama_rombel }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn-add" style="padding:.525rem 1rem;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('staff_tu.siswa.index') }}" class="btn-secondary" style="padding:.525rem 1rem;">Reset</a>
                </div>
            </div>
        </form>

        <div class="filter-divider"></div>

        <div class="search-row">
            <div class="search-wrap">
                <span class="search-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </span>
                <input type="text" id="searchSiswa" class="search-input" placeholder="Cari nama, NISN, atau NIS...">
            </div>
            <div class="pag-info">
                Menampilkan <strong>{{ $siswas->firstItem() ?? 0 }}</strong>–<strong>{{ $siswas->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $siswas->total() }}</strong> siswa
                &nbsp;·&nbsp; Hal. {{ $siswas->currentPage() }}/{{ $siswas->lastPage() }}
            </div>
        </div>
    </div>

    {{-- ═══ TABLE CARD ═══ --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">Daftar Siswa</span>
            <span class="table-count">{{ $siswas->total() }} data</span>
        </div>
        <table class="ta-table" id="siswaTabel">
            <thead>
                <tr>
                    <th style="width:52px;text-align:center">No</th>
                    <th>NISN / NIS</th>
                    <th>Nama Siswa</th>
                    <th class="th-center">JK</th>
                    <th>Rombel</th>
                    <th style="width:220px;text-align:right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $index => $siswa)
                <tr data-nama="{{ strtolower($siswa->nama_siswa) }}"
                    data-nisn="{{ $siswa->nisn }}"
                    data-nis="{{ $siswa->nis }}">
                    <td class="td-no">{{ str_pad($siswas->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="td-mono">{{ $siswa->nisn }}</div>
                        <div class="td-mono-sub">{{ $siswa->nis }}</div>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span class="tbl-avatar {{ $siswa->jenis_kelamin == 'L' ? 'av-l' : 'av-p' }}">
                                {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                            </span>
                            <div>
                                <div class="td-nama">{{ $siswa->nama_siswa }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="th-center">
                        <span class="jk-badge {{ $siswa->jenis_kelamin == 'L' ? 'jk-l' : 'jk-p' }}">
                            {{ $siswa->jenis_kelamin == 'L' ? 'L' : 'P' }}
                        </span>
                    </td>
                    <td>
                        @if($siswa->rombelAktif)
                            <span class="rombel-tag">{{ $siswa->rombelAktif->tingkat_romawi }} {{ $siswa->rombelAktif->kode_rombel }} – {{ $siswa->rombelAktif->nama_rombel }}</span>
                        @else
                            <span class="rombel-empty">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 9v2m0 4h.01"/><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                                Belum ditempatkan
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('staff_tu.siswa.show', $siswa->id) }}" class="btn-sm btn-view">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Lihat
                            </a>
                            <a href="{{ url('/staff_tu/siswa/'.$siswa->id.'/edit') }}" class="btn-sm btn-edit">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <form action="{{ url('/staff_tu/siswa/'.$siswa->id) }}" method="POST" style="margin:0;"
                                  onsubmit="return confirm('Yakin hapus data {{ $siswa->nama_siswa }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-hapus">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                </svg>
                            </div>
                            <strong>Belum ada data siswa</strong>
                            <p>Klik "Tambah Siswa" untuk menambahkan data siswa baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ═══ PAGINATION ═══ --}}
    <div class="pag-wrap">
        {{ $siswas->links() }}
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchSiswa');
    if (input) {
        input.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            document.querySelectorAll('#siswaTabel tbody tr').forEach(row => {
                const match = (row.dataset.nama || '').includes(q)
                           || (row.dataset.nisn || '').includes(q)
                           || (row.dataset.nis  || '').includes(q);
                row.style.display = match ? '' : 'none';
            });
        });
    }

    const tingkatSelect = document.getElementById('filterTingkat');
    const rombelSelect  = document.getElementById('filterRombel');
    if (tingkatSelect && rombelSelect) {
        const rombelOptions = Array.from(rombelSelect.querySelectorAll('option[data-tingkat]'));
        const updateRombel = () => {
            const sel = tingkatSelect.value;
            rombelOptions.forEach(opt => {
                const visible = !sel || opt.dataset.tingkat === sel;
                opt.style.display = visible ? '' : 'none';
                opt.disabled = !visible;
            });
            const cur = rombelSelect.querySelector('option:checked');
            if (cur && cur.disabled) rombelSelect.value = '';
        };
        tingkatSelect.addEventListener('change', updateRombel);
        updateRombel();
    }
});
</script>

@endsection