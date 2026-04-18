@extends('layouts.staff_tu')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .sw-page, .sw-page *, .sw-page *::before, .sw-page *::after { box-sizing: border-box; }
    .sw-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f8fafc; min-height: 100vh;
        width: 100%; max-width: 100%; overflow-x: hidden;
        padding: .875rem; padding-bottom: 5rem;
        display: flex; flex-direction: column; gap: .875rem;
    }

    /* ── HERO ── */
    .sw-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        border-radius: 12px; padding: 1rem;
        color: #fff; position: relative; overflow: hidden; width: 100%;
    }
    .sw-hero::before {
        content: ''; position: absolute; top: -40px; right: -40px;
        width: 120px; height: 120px; border-radius: 50%;
        background: rgba(255,255,255,.06); pointer-events: none;
    }
    .sw-hero-top {
        position: relative;
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: .75rem; flex-wrap: wrap;
    }
    .sw-hero-icon {
        width: 36px; height: 36px; background: rgba(255,255,255,.15);
        border-radius: 8px; display: flex; align-items: center; justify-content: center;
        margin-bottom: .5rem;
    }
    .sw-hero h1 { font-size: 1.0625rem; font-weight: 800; margin: 0 0 .175rem; letter-spacing: -.02em; }
    .sw-hero p  { font-size: .7125rem; color: rgba(255,255,255,.72); margin: 0; line-height: 1.5; }

    .hero-stats { display: flex; gap: .35rem; flex-wrap: wrap; margin-top: .5rem; }
    .hero-stat-chip {
        display: inline-flex; align-items: center; gap: 4px;
        background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
        border-radius: 99px; padding: 3px 8px;
        font-size: .65rem; font-weight: 700; color: #fff; white-space: nowrap;
    }
    .chip-dot { width: 6px; height: 6px; border-radius: 50%; }

    /* ── SEARCH ── */
    .sw-search { position: relative; width: 100%; }
    .sw-search-icon { position: absolute; left: .7rem; top: 50%; transform: translateY(-50%); pointer-events: none; }
    .sw-search input {
        width: 100%; padding: .575rem .7rem .575rem 2.1rem;
        border: 1px solid #e2e8f0; border-radius: 9px;
        font-size: .8125rem; font-family: inherit; color: #1e293b;
        background: #fff; transition: border-color .15s, box-shadow .15s;
    }
    .sw-search input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.15); }

    /* ── QUICK ACTIONS ── */
    .quick-actions {
        background: #fff; border: 1px solid #e2e8f0;
        border-radius: 11px; padding: .875rem; width: 100%;
    }
    .qa-title {
        font-size: .675rem; font-weight: 700; color: #64748b;
        text-transform: uppercase; letter-spacing: .06em; margin-bottom: .625rem;
    }
    .qa-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .45rem; }
    @media (min-width: 480px) { .qa-grid { grid-template-columns: repeat(3, 1fr); } }

    .qa-btn {
        display: flex; align-items: center; gap: .4rem;
        padding: .55rem .65rem;
        border-radius: 8px; font-size: .72rem; font-weight: 700;
        text-decoration: none; transition: background .15s, transform .1s; border: 1px solid;
    }
    .qa-btn:active { transform: scale(.97); }
    .qa-btn-icon {
        width: 26px; height: 26px; border-radius: 6px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .qa-blue  { background: #eff6ff; border-color: #bfdbfe; color: #1d4ed8; }
    .qa-blue .qa-btn-icon  { background: #3b82f6; }
    .qa-green { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; }
    .qa-green .qa-btn-icon { background: #16a34a; }
    .qa-indigo{ background: #eef2ff; border-color: #c7d2fe; color: #4338ca; }
    .qa-indigo .qa-btn-icon{ background: #6366f1; }

    .qa-import-form { display: contents; }
    .qa-import-label {
        display: flex; align-items: center; gap: .4rem;
        padding: .55rem .65rem; border-radius: 8px;
        font-size: .72rem; font-weight: 700; cursor: pointer;
        transition: background .15s, transform .1s; border: 1px solid;
        background: #eef2ff; border-color: #c7d2fe; color: #4338ca;
    }
    .qa-import-label:active { transform: scale(.97); }

    .tips-box {
        margin-top: .625rem; background: #f0f9ff; border: 1px solid #bae6fd;
        border-radius: 8px; padding: .55rem .75rem;
        display: flex; gap: .45rem; align-items: flex-start;
        font-size: .685rem; color: #0369a1; line-height: 1.6;
    }

    /* ── PAGINATION INFO ── */
    .pag-info {
        background: #fff; border: 1px solid #e2e8f0; border-radius: 9px;
        padding: .6rem .875rem;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: .4rem;
        font-size: .72rem; color: #64748b;
    }
    .pag-info strong { color: #1e293b; }

    /* ── FLASH ── */
    .flash-ok {
        display: flex; align-items: flex-start; gap: .5rem;
        padding: .75rem .875rem;
        background: #f0fdf4; border: 1px solid #86efac; border-left: 4px solid #16a34a;
        border-radius: 10px; font-size: .76rem; color: #15803d;
    }
    .flash-ok strong { font-weight: 700; display: block; margin-bottom: 1px; }

    /* ── SECTION LABEL ── */
    .section-label {
        font-size: .675rem; font-weight: 700; color: #64748b;
        text-transform: uppercase; letter-spacing: .06em; margin-bottom: .4rem;
    }

    /* ════════════════
       MOBILE CARDS
    ════════════════ */
    .sw-cards { display: flex; flex-direction: column; gap: .625rem; width: 100%; }

    .sw-card {
        background: #fff; border: 1px solid #e2e8f0;
        border-left: 4px solid #3b82f6;
        border-radius: 11px; padding: .875rem;
        box-shadow: 0 1px 3px rgba(0,0,0,.05);
        width: 100%; min-width: 0; overflow: hidden; transition: box-shadow .2s;
    }
    .sw-card:hover { box-shadow: 0 3px 12px rgba(0,0,0,.08); }
    .sw-card.jk-p { border-left-color: #ec4899; }

    .sw-card-top {
        display: flex; align-items: center;
        justify-content: space-between; gap: .45rem;
        margin-bottom: .625rem; min-width: 0;
    }
    .sw-card-avatar-wrap { display: flex; align-items: center; gap: .5rem; min-width: 0; flex: 1; }
    .sw-avatar {
        width: 34px; height: 34px; border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: .8rem; font-weight: 800; flex-shrink: 0;
    }
    .sw-avatar.av-l { background: #eff6ff; color: #1d4ed8; }
    .sw-avatar.av-p { background: #fdf2f8; color: #be185d; }
    .sw-card-name { font-size: .8375rem; font-weight: 800; color: #1e293b; word-break: break-word; overflow-wrap: break-word; }
    .sw-card-nisn { font-size: .675rem; color: #64748b; margin-top: 1px; }

    .jk-badge {
        flex-shrink: 0; display: inline-flex; align-items: center; gap: 3px;
        padding: 2px 7px; border-radius: 99px;
        font-size: .63rem; font-weight: 700; white-space: nowrap;
    }
    .jk-l { background: #eff6ff; border: 1px solid #bfdbfe; color: #1d4ed8; }
    .jk-p { background: #fdf2f8; border: 1px solid #f9a8d4; color: #be185d; }

    .sw-divider { border: none; border-top: 1px solid #f1f5f9; margin: .5rem 0; }

    .rombel-row { display: flex; align-items: center; gap: .4rem; font-size: .72rem; margin-bottom: .5rem; }
    .rombel-label { font-size: .6rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; }
    .rombel-val   { font-weight: 600; color: #1e293b; }
    .rombel-empty {
        display: inline-flex; align-items: center; gap: 3px;
        padding: 2px 7px; border-radius: 99px;
        background: #fefce8; border: 1px solid #fde047;
        color: #a16207; font-size: .63rem; font-weight: 700;
    }

    .sw-btn-row { display: flex; gap: .35rem; }
    .sw-btn {
        flex: 1; display: flex; align-items: center; justify-content: center; gap: 3px;
        padding: .5rem .2rem; border-radius: 7px;
        font-size: .7rem; font-weight: 700;
        text-decoration: none; border: 1px solid; cursor: pointer;
        transition: background .15s; min-width: 0; white-space: nowrap;
    }
    .sw-btn-view  { background: #f8fafc; border-color: #e2e8f0; color: #475569; }
    .sw-btn-view:hover  { background: #f1f5f9; }
    .sw-btn-edit  { background: #fffbeb; border-color: #fcd34d; color: #d97706; }
    .sw-btn-edit:hover  { background: #fef3c7; }
    .sw-btn-del   { background: #fff1f2; border-color: #fecdd3; color: #dc2626; }
    .sw-btn-del:hover   { background: #fee2e2; }

    .empty-card {
        background: #fff; border: 1.5px dashed #cbd5e1;
        border-radius: 11px; padding: 2.5rem 1rem; text-align: center; width: 100%;
    }
    .empty-icon {
        width: 46px; height: 46px; background: #f1f5f9; border-radius: 11px;
        display: inline-flex; align-items: center; justify-content: center; margin-bottom: .625rem;
    }
    .empty-title { font-size: .8375rem; font-weight: 700; color: #1e293b; margin-bottom: .2rem; }
    .empty-sub   { font-size: .72rem; color: #64748b; }

    /* ════════════════
       DESKTOP TABLE
    ════════════════ */
    .ta-wrap {
        background: #fff; border: 1px solid #e2e8f0; border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.04);
        overflow: hidden; width: 100%;
    }
    .ta-scroll { overflow-x: auto; width: 100%; -webkit-overflow-scrolling: touch; }
    .ta-table  { width: 100%; border-collapse: collapse; font-size: .8rem; }

    .ta-table thead tr { background: linear-gradient(90deg, #1e3a8a 0%, #1d4ed8 100%); }
    .ta-table thead th {
        padding: .75rem 1rem; text-align: left;
        font-size: .67rem; font-weight: 700; color: rgba(255,255,255,.85);
        text-transform: uppercase; letter-spacing: .07em; white-space: nowrap;
    }
    .ta-table thead th.th-center { text-align: center; }
    .ta-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .15s; }
    .ta-table tbody tr:last-child { border-bottom: none; }
    .ta-table tbody tr:hover { background: #f8fafc; }
    .ta-table td { padding: .7rem 1rem; color: #1e293b; vertical-align: middle; }
    .ta-table td.td-center { text-align: center; }

    .td-no   { color: #94a3b8; font-size: .72rem; text-align: center; width: 40px; }
    .td-mono { font-family: 'Courier New', monospace; font-size: .77rem; color: #475569; }
    .td-nama { font-weight: 700; font-size: .85rem; }
    .td-nama-wrap { display: flex; align-items: center; gap: .5rem; }
    .tbl-avatar {
        width: 30px; height: 30px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: .72rem; font-weight: 800; flex-shrink: 0;
    }
    .tbl-av-l { background: #eff6ff; color: #1d4ed8; }
    .tbl-av-p { background: #fdf2f8; color: #be185d; }
    .tbl-jk {
        display: inline-flex; align-items: center; padding: 2px 8px;
        border-radius: 99px; font-size: .68rem; font-weight: 700; white-space: nowrap;
    }
    .tbl-jk-l { background: #eff6ff; border: 1px solid #bfdbfe; color: #1d4ed8; }
    .tbl-jk-p { background: #fdf2f8; border: 1px solid #f9a8d4; color: #be185d; }
    .rombel-tag { font-size: .78rem; font-weight: 600; color: #1e293b; }
    .rombel-tag-empty {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 2px 8px; border-radius: 99px;
        background: #fefce8; border: 1px solid #fde047;
        color: #a16207; font-size: .68rem; font-weight: 700;
    }
    .tbl-actions { display: inline-flex; gap: .35rem; }
    .tbl-btn {
        display: inline-flex; align-items: center; gap: 3px;
        padding: .3rem .65rem; border-radius: 6px;
        font-size: .72rem; font-weight: 700;
        text-decoration: none; cursor: pointer; border: 1px solid;
        transition: background .15s; white-space: nowrap; font-family: inherit;
    }
    .tbl-btn-view { background: #f8fafc; border-color: #e2e8f0; color: #475569; }
    .tbl-btn-view:hover { background: #f1f5f9; }
    .tbl-btn-edit { background: #fffbeb; border-color: #fcd34d; color: #d97706; }
    .tbl-btn-edit:hover { background: #fef3c7; }
    .tbl-btn-del  { background: #fff1f2; border-color: #fecdd3; color: #dc2626; }
    .tbl-btn-del:hover  { background: #fee2e2; }

    .pag-wrap {
        background: #fff; border: 1px solid #e2e8f0;
        border-radius: 10px; padding: .875rem 1rem; width: 100%;
    }

    /* ── RESPONSIVE ── */
    .mobile-only  { display: block; }
    .desktop-only { display: none; }

    @media (min-width: 768px) {
        .mobile-only  { display: none; }
        .desktop-only { display: block; }

        .sw-page { padding: 1.5rem; gap: 1.25rem; }
        .sw-hero { padding: 1.75rem 2rem; }
        .sw-hero h1 { font-size: 1.5rem; }
        .sw-hero p  { font-size: .78rem; }
        .sw-hero-icon { width: 40px; height: 40px; border-radius: 9px; margin-bottom: .625rem; }

        .hero-stats { gap: .5rem; margin-top: .75rem; }
        .hero-stat-chip { font-size: .72rem; padding: 4px 10px; gap: 5px; }
        .chip-dot { width: 7px; height: 7px; }

        .sw-search input { padding: .65rem .75rem .65rem 2.25rem; font-size: .875rem; border-radius: 10px; }

        .quick-actions { padding: 1rem; border-radius: 12px; }
        .qa-title { font-size: .75rem; margin-bottom: .75rem; }
        .qa-btn, .qa-import-label { font-size: .78rem; padding: .625rem .75rem; border-radius: 9px; gap: .5rem; }
        .qa-btn-icon { width: 28px; height: 28px; border-radius: 7px; }
        .tips-box { font-size: .73rem; padding: .625rem .875rem; margin-top: .75rem; }

        .pag-info { font-size: .78rem; padding: .75rem 1rem; border-radius: 10px; }
        .flash-ok { font-size: .82rem; padding: .875rem 1rem; }

        .section-label { font-size: .7rem; margin-bottom: .5rem; }

        .sw-cards { gap: .75rem; }
        .sw-card  { padding: 1rem; border-radius: 12px; }
        .sw-avatar { width: 38px; height: 38px; font-size: .875rem; border-radius: 10px; }
        .sw-card-name { font-size: .9rem; }
        .sw-card-nisn { font-size: .72rem; }
        .jk-badge { font-size: .68rem; padding: 3px 8px; }
        .rombel-row { font-size: .78rem; gap: .5rem; margin-bottom: .625rem; }
        .rombel-label { font-size: .65rem; }
        .sw-btn { font-size: .75rem; padding: .55rem .25rem; border-radius: 8px; }

        .sw-search { max-width: 360px; }
    }

    @media (min-width: 1024px) { .sw-page { padding: 2rem; } }
</style>

<div class="sw-page">

    {{-- ═══ HERO ═══ --}}
    <div class="sw-hero">
        <div class="sw-hero-top">
            <div>
                <div class="sw-hero-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h1>Data Siswa</h1>
                <p>MTs Muhammadiyah 1 Natar &mdash; TA {{ $tahunAjaranAktif->tahun_ajaran }}</p>
                <div class="hero-stats">
                    <span class="hero-stat-chip">
                        <span class="chip-dot" style="background:#60a5fa;"></span>
                        Total: {{ $siswas->total() }}
                    </span>
                    <span class="hero-stat-chip">
                        <span class="chip-dot" style="background:#93c5fd;"></span>
                        L: {{ \App\Models\Tatausaha\Siswa::where('jenis_kelamin','L')->count() }}
                    </span>
                    <span class="hero-stat-chip">
                        <span class="chip-dot" style="background:#f9a8d4;"></span>
                        P: {{ \App\Models\Tatausaha\Siswa::where('jenis_kelamin','P')->count() }}
                    </span>
                    <span class="hero-stat-chip">
                        <span class="chip-dot" style="background:#fde68a;"></span>
                        Belum: {{ \App\Models\Tatausaha\Siswa::whereNull('rombel_id')->count() }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ FLASH ═══ --}}
    @if(session('success'))
    <div class="flash-ok">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:1px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <div>
            <strong>Berhasil!</strong>
            {{ session('success') }}
        </div>
    </div>
    @endif

    {{-- ═══ QUICK ACTIONS ═══ --}}
    <div class="quick-actions">
        <div class="qa-title">Aksi Cepat</div>
        <div class="qa-grid">
            <a href="{{ url('/staff_tu/siswa/create') }}" class="qa-btn qa-blue">
                <span class="qa-btn-icon">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </span>
                <span>Tambah Siswa</span>
            </a>
            <a href="{{ route('staff_tu.siswa.export') }}" class="qa-btn qa-green">
                <span class="qa-btn-icon">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </span>
                <span>Export Excel</span>
            </a>
            <form action="{{ route('staff_tu.siswa.import') }}" method="POST"
                  enctype="multipart/form-data" class="qa-import-form">
                @csrf
                <label class="qa-import-label">
                    <span class="qa-btn-icon" style="background:#6366f1;border-radius:6px;width:26px;height:26px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    </span>
                    <span>Import Excel</span>
                    <input type="file" name="file" required class="hidden" onchange="this.form.submit()">
                </label>
            </form>
        </div>
        <div class="tips-box">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#0369a1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span><strong>Tips:</strong> Export dulu templatenya, isi data, lalu Import kembali. Format tanggal: <strong>YYYY-MM-DD</strong></span>
        </div>
    </div>

    {{-- ═══ SEARCH + PAGINASI INFO ═══ --}}
    <div style="display:flex;flex-direction:column;gap:.5rem;width:100%;">
        <div class="sw-search">
            <span class="sw-search-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </span>
            <input type="text" id="searchSiswa" placeholder="Cari nama, NISN, atau NIS...">
        </div>
        <div class="pag-info">
            <span>
                Menampilkan <strong>{{ $siswas->firstItem() ?? 0 }}</strong>–<strong>{{ $siswas->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $siswas->total() }}</strong> siswa
            </span>
            <span>Hal. {{ $siswas->currentPage() }}/{{ $siswas->lastPage() }}</span>
        </div>
    </div>

    {{-- ═══ MOBILE CARDS ═══ --}}
    <div class="mobile-only">
        <div class="section-label">Daftar Siswa</div>
        <div class="sw-cards" id="mobileCards">
            @forelse($siswas as $siswa)
            <div class="sw-card {{ $siswa->jenis_kelamin == 'P' ? 'jk-p' : '' }}"
                 data-nama="{{ strtolower($siswa->nama_siswa) }}"
                 data-nisn="{{ $siswa->nisn }}"
                 data-nis="{{ $siswa->nis }}">

                <div class="sw-card-top">
                    <div class="sw-card-avatar-wrap">
                        <div class="sw-avatar {{ $siswa->jenis_kelamin == 'L' ? 'av-l' : 'av-p' }}">
                            {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                        </div>
                        <div style="min-width:0;">
                            <div class="sw-card-name">{{ $siswa->nama_siswa }}</div>
                            <div class="sw-card-nisn">{{ $siswa->nisn }} · {{ $siswa->nis }}</div>
                        </div>
                    </div>
                    <span class="jk-badge {{ $siswa->jenis_kelamin == 'L' ? 'jk-l' : 'jk-p' }}">
                        {{ $siswa->jenis_kelamin == 'L' ? '♂ L' : '♀ P' }}
                    </span>
                </div>

                <div class="rombel-row">
                    <span class="rombel-label">Rombel</span>
                    @if($siswa->rombelAktif)
                        <span class="rombel-val">{{ $siswa->rombelAktif->tingkat }} {{ $siswa->rombelAktif->kode_rombel }} – {{ $siswa->rombelAktif->nama_rombel }}</span>
                    @else
                        <span class="rombel-empty">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v2m0 4h.01"/><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                            Belum ditempatkan
                        </span>
                    @endif
                </div>

                <hr class="sw-divider">

                <div class="sw-btn-row">
                    <a href="{{ route('staff_tu.siswa.show', $siswa->id) }}" class="sw-btn sw-btn-view">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        Lihat
                    </a>
                    <a href="{{ url('/staff_tu/siswa/'.$siswa->id.'/edit') }}" class="sw-btn sw-btn-edit">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit
                    </a>
                    <form action="{{ url('/staff_tu/siswa/'.$siswa->id) }}" method="POST"
                          style="flex:1;display:flex;"
                          onsubmit="return confirm('Yakin hapus data {{ $siswa->nama_siswa }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="sw-btn sw-btn-del">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="empty-card">
                <div class="empty-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <div class="empty-title">Belum ada data siswa</div>
                <div class="empty-sub">Klik "Tambah Siswa" untuk menambahkan data</div>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ═══ DESKTOP TABLE ═══ --}}
    <div class="desktop-only">
        <div class="section-label">Daftar Siswa</div>
        <div class="ta-wrap">
            <div class="ta-scroll">
                <table class="ta-table" id="desktopTable">
                    <thead>
                        <tr>
                            <th class="th-center">No</th>
                            <th>NISN / NIS</th>
                            <th>Nama Siswa</th>
                            <th class="th-center">JK</th>
                            <th>Rombel</th>
                            <th class="th-center" style="width:180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $index => $siswa)
                        <tr data-nama="{{ strtolower($siswa->nama_siswa) }}"
                            data-nisn="{{ $siswa->nisn }}"
                            data-nis="{{ $siswa->nis }}">
                            <td class="td-no">{{ $siswas->firstItem() + $index }}</td>
                            <td>
                                <div class="td-mono">{{ $siswa->nisn }}</div>
                                <div style="font-size:.7rem;color:#94a3b8;">{{ $siswa->nis }}</div>
                            </td>
                            <td>
                                <div class="td-nama-wrap">
                                    <div class="tbl-avatar {{ $siswa->jenis_kelamin == 'L' ? 'tbl-av-l' : 'tbl-av-p' }}">
                                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                    </div>
                                    <span class="td-nama">{{ $siswa->nama_siswa }}</span>
                                </div>
                            </td>
                            <td class="td-center">
                                <span class="tbl-jk {{ $siswa->jenis_kelamin == 'L' ? 'tbl-jk-l' : 'tbl-jk-p' }}">
                                    {{ $siswa->jenis_kelamin == 'L' ? 'L' : 'P' }}
                                </span>
                            </td>
                            <td>
                                @if($siswa->rombelAktif)
                                    <span class="rombel-tag">{{ $siswa->rombelAktif->tingkat }} {{ $siswa->rombelAktif->kode_rombel }} – {{ $siswa->rombelAktif->nama_rombel }}</span>
                                @else
                                    <span class="rombel-tag-empty">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v2m0 4h.01"/><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                                        Belum ditempatkan
                                    </span>
                                @endif
                            </td>
                            <td class="td-center">
                                <div class="tbl-actions">
                                    <a href="{{ route('staff_tu.siswa.show', $siswa->id) }}" class="tbl-btn tbl-btn-view">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        Lihat
                                    </a>
                                    <a href="{{ url('/staff_tu/siswa/'.$siswa->id.'/edit') }}" class="tbl-btn tbl-btn-edit">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Edit
                                    </a>
                                    <form action="{{ url('/staff_tu/siswa/'.$siswa->id) }}" method="POST"
                                          style="margin:0;"
                                          onsubmit="return confirm('Yakin hapus data {{ $siswa->nama_siswa }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="tbl-btn tbl-btn-del">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:3rem;color:#94a3b8;font-size:.875rem;">
                                Belum ada data siswa
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ═══ PAGINATION ═══ --}}
    <div class="pag-wrap">
        {{ $siswas->links() }}
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchSiswa');
    if (!input) return;
    input.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();
        document.querySelectorAll('#desktopTable tbody tr').forEach(row => {
            const match = (row.dataset.nama || '').includes(q)
                       || (row.dataset.nisn || '').includes(q)
                       || (row.dataset.nis  || '').includes(q);
            row.style.display = match ? '' : 'none';
        });
        document.querySelectorAll('#mobileCards .sw-card').forEach(card => {
            const match = (card.dataset.nama || '').includes(q)
                       || (card.dataset.nisn || '').includes(q)
                       || (card.dataset.nis  || '').includes(q);
            card.style.display = match ? '' : 'none';
        });
    });
});
</script>

@endsection