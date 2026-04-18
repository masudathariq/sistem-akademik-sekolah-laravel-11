@extends('layouts.staff_tu')

@section('title', 'Kategori Rombel')

@section('content')

<style>
    .kat-pondok  { --k-bg: #faf5ff; --k-border: #e9d5ff; --k-text: #7e22ce; --k-dot: #a855f7; }
    .kat-reguler { --k-bg: #eff6ff; --k-border: #bfdbfe; --k-text: #1d4ed8; --k-dot: #3b82f6; }
    .kat-none    { --k-bg: #f8fafc; --k-border: #e2e8f0; --k-text: #64748b; --k-dot: #94a3b8; }
</style>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .kr-page, .kr-page *, .kr-page *::before, .kr-page *::after { box-sizing: border-box; }

    .kr-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f8fafc;
        min-height: 100vh;
        width: 100%; max-width: 100%; overflow-x: hidden;
        padding: .875rem;
        padding-bottom: 5rem;
        display: flex; flex-direction: column; gap: .875rem;
    }

    /* ── HERO ── */
    .kr-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        border-radius: 12px; padding: 1rem;
        color: #fff; position: relative; overflow: hidden; width: 100%;
    }
    .kr-hero::before {
        content: ''; position: absolute; top: -40px; right: -40px;
        width: 120px; height: 120px; border-radius: 50%;
        background: rgba(255,255,255,.06); pointer-events: none;
    }
    .kr-hero-icon {
        width: 36px; height: 36px; background: rgba(255,255,255,.15);
        border-radius: 8px; display: flex; align-items: center; justify-content: center;
        margin-bottom: .625rem; flex-shrink: 0;
    }
    .kr-hero h1 { font-size: 1.0625rem; font-weight: 800; margin: 0 0 .2rem; letter-spacing: -.02em; word-break: break-word; }
    .kr-hero p  { font-size: .725rem; color: rgba(255,255,255,.72); margin: 0; line-height: 1.5; }
    .legend-wrap { display: flex; gap: .35rem; flex-wrap: wrap; margin-top: .625rem; }
    .legend-pill {
        display: inline-flex; align-items: center; gap: 3px;
        padding: 2px 7px; border-radius: 99px; font-size: .65rem; font-weight: 700;
        background: rgba(255,255,255,.12); color: #fff;
        border: 1px solid rgba(255,255,255,.2); white-space: nowrap;
    }
    .legend-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }

    /* ── INFO BOX ── */
    .info-box {
        background: #fffbeb; border: 1px solid #fcd34d;
        border-radius: 10px; padding: .7rem .875rem;
        display: flex; gap: .5rem; align-items: flex-start; width: 100%;
    }
    .info-box-icon { flex-shrink: 0; margin-top: 1px; }
    .info-box-title { font-size: .7375rem; font-weight: 700; color: #92400e; margin-bottom: .2rem; }
    .info-box-list  { margin: 0; padding-left: .875rem; font-size: .7rem; color: #78350f; line-height: 1.75; }

    /* ── FLASH ── */
    .flash-success {
        display: flex; align-items: center; gap: .5rem;
        padding: .65rem .875rem;
        background: #f0fdf4; border: 1px solid #86efac;
        border-radius: 10px; font-size: .75rem; color: #16a34a; font-weight: 600; width: 100%;
    }

    /* ── SECTION LABEL ── */
    .section-label {
        font-size: .675rem; font-weight: 700; color: #64748b;
        text-transform: uppercase; letter-spacing: .06em; margin-bottom: .4rem;
    }

    /* ── TINGKAT HEADER ── */
    .tingkat-header {
        display: flex; align-items: center; gap: .5rem;
        margin-bottom: .5rem; margin-top: .25rem;
    }
    .tingkat-badge {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 3px 12px; border-radius: 99px;
        font-size: .72rem; font-weight: 800;
        background: #1e3a8a; color: #fff;
        letter-spacing: .03em; white-space: nowrap;
    }
    .tingkat-line {
        flex: 1; height: 1px; background: #e2e8f0;
    }
    .tingkat-count {
        font-size: .67rem; font-weight: 600; color: #94a3b8; white-space: nowrap;
    }

    /* ════════════════
       MOBILE CARDS
    ════════════════ */
    .kr-cards { display: flex; flex-direction: column; gap: .625rem; width: 100%; }

    .kr-card {
        background: #fff; border: 1px solid #e2e8f0;
        border-radius: 11px; border-left: 4px solid var(--k-dot);
        padding: .875rem;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
        transition: box-shadow .2s;
        width: 100%; min-width: 0; overflow: hidden;
    }
    .kr-card:hover { box-shadow: 0 3px 12px rgba(0,0,0,.09); }

    .kr-card-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: .5rem;
        margin-bottom: .625rem; min-width: 0;
    }
    .kr-card-info { min-width: 0; flex: 1; }
    .kr-card-name {
        font-size: .875rem; font-weight: 800; color: #1e293b;
        letter-spacing: -.01em; word-break: break-word;
        overflow-wrap: break-word; margin-bottom: .1rem;
    }
    .kr-card-sub { font-size: .7rem; color: #64748b; }

    .kat-badge {
        display: inline-flex; align-items: center; gap: 3px;
        padding: 2px 8px; border-radius: 99px;
        font-size: .63rem; font-weight: 700;
        border: 1px solid var(--k-border);
        background: var(--k-bg); color: var(--k-text);
        white-space: nowrap; flex-shrink: 0;
    }
    .kat-badge-dot { width: 4px; height: 4px; border-radius: 50%; background: var(--k-dot); flex-shrink: 0; }

    .kr-divider { border: none; border-top: 1px solid #f1f5f9; margin: .625rem 0; }

    .kr-form { width: 100%; }
    .kr-select {
        width: 100%; border: 1px solid #e2e8f0; border-radius: 8px;
        padding: .5rem .75rem; font-size: .8125rem;
        font-family: inherit; color: #1e293b; background: #fff;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right .65rem center;
        padding-right: 2rem; cursor: pointer; margin-bottom: .45rem;
        transition: border-color .15s, box-shadow .15s;
    }
    .kr-select:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.15); }

    .kr-btn-row { display: flex; gap: .45rem; width: 100%; }
    .btn-simpan {
        flex: 1; display: flex; align-items: center; justify-content: center; gap: 4px;
        padding: .55rem; background: #1d4ed8; color: #fff;
        border: none; border-radius: 8px; font-size: .75rem;
        font-weight: 700; font-family: inherit; cursor: pointer;
        transition: background .15s; min-width: 0;
    }
    .btn-simpan:hover { background: #1e40af; }
    .btn-lihat {
        flex: 1; display: flex; align-items: center; justify-content: center; gap: 4px;
        padding: .55rem; background: #f1f5f9;
        border: 1px solid #e2e8f0; color: #475569;
        border-radius: 8px; font-size: .75rem; font-weight: 700;
        text-decoration: none; transition: background .15s; min-width: 0;
    }
    .btn-lihat:hover { background: #e2e8f0; }

    /* ════════════════
       DESKTOP TABLE
    ════════════════ */
    .ta-table-wrap {
        background: #fff; border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.04);
        overflow: hidden; width: 100%;
        margin-bottom: .25rem;
    }
    .ta-table { width: 100%; border-collapse: collapse; font-size: .875rem; }
    .ta-table thead tr { background: linear-gradient(90deg, #1e3a8a 0%, #1d4ed8 100%); }
    .ta-table thead th {
        padding: .75rem 1.25rem; text-align: left;
        font-size: .67rem; font-weight: 700;
        color: rgba(255,255,255,.85);
        text-transform: uppercase; letter-spacing: .07em; white-space: nowrap;
    }
    .ta-table thead th.th-center { text-align: center; }
    .ta-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .15s; }
    .ta-table tbody tr:last-child { border-bottom: none; }
    .ta-table tbody tr:hover { background: #f8fafc; }
    .ta-table td { padding: .85rem 1.25rem; color: #1e293b; vertical-align: middle; }
    .ta-table td.td-center { text-align: center; }
    .td-no { color: #94a3b8; font-size: .8rem; text-align: center; width: 48px; }
    .td-rombel-name { font-weight: 700; font-size: .875rem; margin-bottom: .1rem; }
    .td-rombel-sub  { font-size: .75rem; color: #64748b; }

    .tbl-form-row { display: flex; align-items: center; justify-content: center; gap: .5rem; }
    .tbl-select {
        border: 1px solid #e2e8f0; border-radius: 8px;
        padding: .4rem .65rem; font-size: .8125rem;
        font-family: inherit; color: #1e293b; background: #fff;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right .5rem center;
        padding-right: 1.75rem; cursor: pointer;
        transition: border-color .15s, box-shadow .15s;
    }
    .tbl-select:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.15); }
    .tbl-btn-simpan {
        display: inline-flex; align-items: center; gap: 4px;
        padding: .4rem .875rem; background: #1e3a8a; color: #fff;
        border: none; border-radius: 7px; font-size: .75rem;
        font-weight: 700; font-family: inherit; cursor: pointer;
        transition: background .15s; white-space: nowrap;
    }
    .tbl-btn-simpan:hover { background: #1e40af; }
    .tbl-btn-lihat {
        display: inline-flex; align-items: center; gap: 4px;
        padding: .4rem .75rem; background: #f1f5f9;
        border: 1px solid #e2e8f0; color: #475569;
        border-radius: 7px; font-size: .75rem; font-weight: 700;
        text-decoration: none; transition: background .15s; white-space: nowrap;
    }
    .tbl-btn-lihat:hover { background: #e2e8f0; }

    /* ── RESPONSIVE ── */
    .mobile-only  { display: block; }
    .desktop-only { display: none; }

    @media (min-width: 768px) {
        .mobile-only  { display: none; }
        .desktop-only { display: block; }

        .kr-page { padding: 1.5rem; gap: 1.25rem; }
        .kr-hero { padding: 1.75rem 2rem; }
        .kr-hero h1 { font-size: 1.5rem; }
        .kr-hero p  { font-size: .8rem; }
        .kr-hero-icon { width: 40px; height: 40px; border-radius: 9px; margin-bottom: .75rem; }
        .legend-pill { font-size: .7rem; padding: 3px 8px; }
        .legend-dot  { width: 6px; height: 6px; }
        .info-box { padding: .875rem 1rem; }
        .info-box-title { font-size: .8rem; }
        .info-box-list  { font-size: .75rem; }
        .flash-success { font-size: .8rem; padding: .75rem 1rem; }
        .section-label { font-size: .7rem; margin-bottom: .5rem; }
        .kr-card { padding: 1rem; border-radius: 12px; }
        .kr-card-name { font-size: .9375rem; }
        .kr-card-sub  { font-size: .75rem; }
        .kat-badge    { font-size: .68rem; padding: 3px 9px; }
        .kat-badge-dot { width: 5px; height: 5px; }
        .kr-select { padding: .6rem .875rem; font-size: .875rem; margin-bottom: .5rem; }
        .btn-simpan, .btn-lihat { font-size: .8125rem; padding: .625rem; border-radius: 9px; }
        .tingkat-badge { font-size: .78rem; padding: 4px 14px; }
    }

    @media (min-width: 1024px) { .kr-page { padding: 2rem; } }
</style>

<div class="kr-page">

    {{-- ═══ HERO ═══ --}}
    <div class="kr-hero">
        <div class="kr-hero-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 3h7v7H3z"/><path d="M14 3h7v7h-7z"/>
                <path d="M14 14h7v7h-7z"/><path d="M3 14h7v7H3z"/>
            </svg>
        </div>
        <h1>Kategori Rombel</h1>
        <p>Atur kategori setiap rombel — Reguler atau Pondok</p>
        <div class="legend-wrap">
            <span class="legend-pill"><span class="legend-dot" style="background:#3b82f6;"></span>Reguler</span>
            <span class="legend-pill"><span class="legend-dot" style="background:#a855f7;"></span>Pondok</span>
            <span class="legend-pill"><span class="legend-dot" style="background:#94a3b8;"></span>Belum Diset</span>
        </div>
    </div>

    {{-- ═══ FLASH ═══ --}}
    @if(session('success'))
    <div class="flash-success">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ═══ INFO BOX ═══ --}}
    <div class="info-box">
        <div class="info-box-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div>
            <div class="info-box-title">Panduan Kategori Rombel</div>
            <ul class="info-box-list">
                <li><strong>Reguler</strong> — siswa umum, tidak tinggal di pondok.</li>
                <li><strong>Pondok</strong> — siswa yang tinggal di pondok pesantren.</li>
                <li>Pilih kategori lalu klik <strong>Simpan</strong> untuk memperbarui.</li>
                <li>Klik <strong>Lihat</strong> untuk melihat daftar siswa rombel.</li>
            </ul>
        </div>
    </div>

    {{-- Group rombel by tingkat --}}
    @php
        $grouped = $rombels->groupBy('tingkat')->sortKeys();
    @endphp

    {{-- ═══ MOBILE CARDS (grouped) ═══ --}}
    <div class="mobile-only">
        <div class="section-label">Daftar Rombel</div>
        @foreach($grouped as $tingkat => $rombelGroup)
        <div style="margin-bottom:1rem;">
            <div class="tingkat-header">
                <span class="tingkat-badge">Kelas {{ $tingkat }}</span>
                <div class="tingkat-line"></div>
                <span class="tingkat-count">{{ $rombelGroup->count() }} rombel</span>
            </div>
            <div class="kr-cards">
                @foreach($rombelGroup as $rombel)
                @php
                    $kategori = $rombel->kategori->kategori ?? null;
                    $katClass = $kategori === 'pondok' ? 'kat-pondok'
                              : ($kategori === 'reguler' ? 'kat-reguler' : 'kat-none');
                    $katLabel = $kategori ? strtoupper($kategori) : 'BELUM SET';
                @endphp
                <div class="kr-card {{ $katClass }}">
                    <div class="kr-card-top">
                        <div class="kr-card-info">
                            <div class="kr-card-name">{{ $rombel->nama_rombel }}</div>
                            <div class="kr-card-sub">Kode: {{ $rombel->kode_rombel ?? '-' }}</div>
                        </div>
                        <span class="kat-badge">
                            <span class="kat-badge-dot"></span>
                            {{ $katLabel }}
                        </span>
                    </div>
                    <hr class="kr-divider">
                    <form method="POST" action="{{ route('staff_tu.rombel-kategori.store') }}" class="kr-form">
                        @csrf
                        <input type="hidden" name="rombel_id" value="{{ $rombel->id }}">
                        <select name="kategori" class="kr-select">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="reguler" {{ $kategori === 'reguler' ? 'selected' : '' }}>Reguler</option>
                            <option value="pondok"  {{ $kategori === 'pondok'  ? 'selected' : '' }}>Pondok</option>
                        </select>
                        <div class="kr-btn-row">
                            <button type="submit" class="btn-simpan">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
                                    <polyline points="17 21 17 13 7 13 7 21"/>
                                    <polyline points="7 3 7 8 15 8"/>
                                </svg>
                                Simpan
                            </button>
                            <a href="{{ route('staff_tu.rombel-kategori.show', $rombel->id) }}" class="btn-lihat">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                Lihat
                            </a>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    {{-- ═══ DESKTOP TABLE (grouped per tingkat) ═══ --}}
    <div class="desktop-only">
        <div class="section-label">Daftar Rombel</div>

        @foreach($grouped as $tingkat => $rombelGroup)
        <div style="margin-bottom:1.5rem;">

            {{-- Tingkat header --}}
            <div class="tingkat-header">
                <span class="tingkat-badge">Kelas {{ $tingkat }}</span>
                <div class="tingkat-line"></div>
                <span class="tingkat-count">{{ $rombelGroup->count() }} rombel</span>
            </div>

            <div class="ta-table-wrap">
                <table class="ta-table">
                    <thead>
                        <tr>
                            <th class="th-center" style="width:48px;">No</th>
                            <th>Rombel</th>
                            <th>Kategori Saat Ini</th>
                            <th class="th-center" style="width:320px;">Ubah Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rombelGroup as $i => $rombel)
                        @php
                            $kategori = $rombel->kategori->kategori ?? null;
                            $katClass = $kategori === 'pondok' ? 'kat-pondok'
                                      : ($kategori === 'reguler' ? 'kat-reguler' : 'kat-none');
                            $katLabel = $kategori ? strtoupper($kategori) : 'BELUM SET';
                        @endphp
                        <tr class="{{ $katClass }}">
                            <td class="td-no">{{ $i + 1 }}</td>
                            <td>
                                <div class="td-rombel-name">{{ $rombel->nama_rombel }}</div>
                                <div class="td-rombel-sub">Kode: {{ $rombel->kode_rombel ?? '-' }}</div>
                            </td>
                            <td>
                                <span class="kat-badge">
                                    <span class="kat-badge-dot"></span>
                                    {{ $katLabel }}
                                </span>
                            </td>
                            <td class="td-center">
                                <form method="POST" action="{{ route('staff_tu.rombel-kategori.store') }}" style="margin:0;">
                                    @csrf
                                    <input type="hidden" name="rombel_id" value="{{ $rombel->id }}">
                                    <div class="tbl-form-row">
                                        <select name="kategori" class="tbl-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="reguler" {{ $kategori === 'reguler' ? 'selected' : '' }}>Reguler</option>
                                            <option value="pondok"  {{ $kategori === 'pondok'  ? 'selected' : '' }}>Pondok</option>
                                        </select>
                                        <button type="submit" class="tbl-btn-simpan">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
                                                <polyline points="17 21 17 13 7 13 7 21"/>
                                                <polyline points="7 3 7 8 15 8"/>
                                            </svg>
                                            Simpan
                                        </button>
                                        <a href="{{ route('staff_tu.rombel-kategori.show', $rombel->id) }}" class="tbl-btn-lihat">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                            Lihat
                                        </a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        @endforeach
    </div>

</div>

@endsection