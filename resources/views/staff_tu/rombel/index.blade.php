@extends('layouts.staff_tu')

@section('content')
@php
$roman = [7 => 'VII', 8 => 'VIII', 9 => 'IX'];
$grouped = $rombels->groupBy('tingkat');
@endphp

<style>
    .tingkat-7 { --t-bg: #eff6ff; --t-border: #bfdbfe; --t-text: #1d4ed8; --t-dot: #3b82f6; }
    .tingkat-8 { --t-bg: #f0fdf4; --t-border: #bbf7d0; --t-text: #15803d; --t-dot: #22c55e; }
    .tingkat-9 { --t-bg: #fdf4ff; --t-border: #e9d5ff; --t-text: #7e22ce; --t-dot: #a855f7; }
</style>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .rb-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f8fafc;
        min-height: 100vh;
        padding: .875rem;
        padding-bottom: 5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        box-sizing: border-box;
    }
    .rb-page *, .rb-page *::before, .rb-page *::after { box-sizing: border-box; }

    /* ── HERO ── */
    .rb-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        border-radius: 14px;
        padding: 1.125rem;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .rb-hero::before {
        content: '';
        position: absolute;
        top: -45px; right: -45px;
        width: 140px; height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        pointer-events: none;
    }
    .rb-hero::after {
        content: '';
        position: absolute;
        bottom: -55px; right: 70px;
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,.04);
        pointer-events: none;
    }
    .rb-hero-inner {
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: .875rem;
        flex-wrap: wrap;
    }
    .rb-hero-icon {
        width: 38px; height: 38px;
        background: rgba(255,255,255,.15);
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: .625rem;
    }
    .rb-hero h1 {
        font-size: 1.125rem;
        font-weight: 800;
        margin: 0 0 .25rem;
        letter-spacing: -.02em;
    }
    .rb-hero p {
        font-size: .75rem;
        color: rgba(255,255,255,.72);
        margin: 0;
        line-height: 1.55;
    }
    .rb-hero p strong { color: #fff; }
    .rb-hero-btn {
        flex-shrink: 0;
        align-self: flex-start;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: .45rem .875rem;
        background: #fff;
        color: #1e3a8a;
        border-radius: 8px;
        font-size: .75rem;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(0,0,0,.15);
        transition: transform .15s, box-shadow .15s;
        white-space: nowrap;
    }
    .rb-hero-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(0,0,0,.2); }
    .rb-hero-btn:active { transform: scale(.97); }

    /* ── INFO BOX ── */
    .info-box {
        background: #fffbeb;
        border: 1px solid #fcd34d;
        border-radius: 10px;
        padding: .75rem .875rem;
        display: flex;
        gap: .625rem;
        align-items: flex-start;
    }
    .info-box-title { font-size: .75rem; font-weight: 700; color: #92400e; margin-bottom: .2rem; }
    .info-box-list { margin: 0; padding-left: .875rem; font-size: .7125rem; color: #78350f; line-height: 1.85; }

    /* ── FLASH ── */
    .flash-success {
        display: flex; align-items: center; gap: .5rem;
        padding: .75rem .875rem;
        background: #f0fdf4;
        border: 1px solid #86efac;
        border-radius: 10px;
        font-size: .75rem;
        color: #16a34a;
        font-weight: 600;
    }

    /* ── TINGKAT SECTION ── */
    .tingkat-section { display: flex; flex-direction: column; gap: .75rem; }
    .tingkat-header {
        display: flex; align-items: center;
        justify-content: space-between; gap: .625rem;
    }
    .tingkat-title-wrap { display: flex; align-items: center; gap: .5rem; }
    .tingkat-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
        background: var(--t-dot);
    }
    .tingkat-title { font-size: .9rem; font-weight: 800; color: #1e293b; letter-spacing: -.01em; }
    .tingkat-badge {
        font-size: .65rem; font-weight: 700;
        padding: 3px 9px;
        border-radius: 99px;
        border: 1px solid var(--t-border);
        background: var(--t-bg);
        color: var(--t-text);
        white-space: nowrap;
    }

    /* ── MOBILE CARDS ── */
    .rb-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: .875rem;
        box-shadow: 0 1px 4px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.04);
        transition: box-shadow .2s;
        margin-bottom: .5rem;
    }
    .rb-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,.1); }

    .rb-card-top {
        display: flex; align-items: center;
        gap: .625rem; margin-bottom: .75rem;
    }
    .rb-card-avatar {
        width: 38px; height: 38px;
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: .65rem; font-weight: 800;
        flex-shrink: 0; line-height: 1.2; text-align: center;
        border: 1.5px solid var(--t-border);
        background: var(--t-bg); color: var(--t-text);
    }
    .rb-card-name { font-size: .9rem; font-weight: 800; color: #1e293b; letter-spacing: -.01em; margin-bottom: .125rem; }
    .rb-card-sub  { font-size: .7125rem; color: #64748b; }

    .rb-divider { border: none; border-top: 1px solid #f1f5f9; margin: .625rem 0; }

    .rb-actions { display: flex; gap: .5rem; }

    .btn-edit {
        flex: 1; display: flex; align-items: center; justify-content: center; gap: 4px;
        padding: .525rem; background: #fffbeb;
        border: 1px solid #fcd34d; color: #d97706;
        border-radius: 8px; font-size: .75rem; font-weight: 700;
        text-decoration: none; transition: background .15s;
    }
    .btn-edit:hover { background: #fef3c7; }

    .btn-hapus-wrap { flex: 1; display: flex; }
    .btn-hapus {
        flex: 1; width: 100%; display: flex; align-items: center; justify-content: center; gap: 4px;
        padding: .525rem; background: #fff1f2;
        border: 1px solid #fecdd3; color: #dc2626;
        border-radius: 8px; font-size: .75rem; font-weight: 700;
        cursor: pointer; transition: background .15s;
    }
    .btn-hapus:hover { background: #fee2e2; }

    /* ── EMPTY STATE ── */
    .empty-card {
        background: #fff; border: 1.5px dashed #cbd5e1;
        border-radius: 12px; padding: 1.5rem 1rem; text-align: center;
    }
    .empty-icon {
        width: 42px; height: 42px; background: #f1f5f9;
        border-radius: 10px; display: inline-flex;
        align-items: center; justify-content: center; margin-bottom: .625rem;
    }
    .empty-title { font-size: .8375rem; font-weight: 700; color: #1e293b; margin-bottom: .2rem; }
    .empty-sub   { font-size: .75rem; color: #64748b; }

    /* ── DESKTOP TABLE ── */
    .ta-table-wrap {
        background: #fff; border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.04);
        overflow: hidden;
    }
    .ta-table { width: 100%; border-collapse: collapse; font-size: .875rem; }
    .ta-table thead tr { background: linear-gradient(90deg, #1e3a8a 0%, #1d4ed8 100%); }
    .ta-table thead th {
        padding: .875rem 1.125rem; text-align: left;
        font-size: .7rem; font-weight: 700;
        color: rgba(255,255,255,.85);
        text-transform: uppercase; letter-spacing: .07em; white-space: nowrap;
    }
    .ta-table thead th.th-center { text-align: center; }
    .ta-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .15s; }
    .ta-table tbody tr:last-child { border-bottom: none; }
    .ta-table tbody tr:hover { background: #f8fafc; }
    .ta-table td { padding: .9rem 1.125rem; color: #1e293b; vertical-align: middle; }
    .ta-table td.td-center { text-align: center; }
    .ta-table td.td-no { color: #64748b; font-size: .8125rem; text-align: center; width: 50px; }
    .td-rombel { font-weight: 700; font-size: .9375rem; }
    .td-nama   { color: #64748b; font-size: .8125rem; }

    .tbl-avatar {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px; border-radius: 8px;
        font-size: .65rem; font-weight: 800;
        flex-shrink: 0; line-height: 1.2; text-align: center;
        border: 1px solid var(--t-border);
        background: var(--t-bg); color: var(--t-text);
    }
    .tbl-actions { display: inline-flex; gap: .5rem; }
    .tbl-btn-edit {
        display: inline-flex; align-items: center; gap: 4px;
        padding: .375rem .8rem; background: #fffbeb;
        border: 1px solid #fcd34d; color: #d97706;
        border-radius: 7px; font-size: .75rem; font-weight: 700;
        text-decoration: none; transition: background .15s;
    }
    .tbl-btn-edit:hover { background: #fef3c7; }
    .tbl-btn-hapus {
        display: inline-flex; align-items: center; gap: 4px;
        padding: .375rem .8rem; background: #fff1f2;
        border: 1px solid #fecdd3; color: #dc2626;
        border-radius: 7px; font-size: .75rem; font-weight: 700;
        cursor: pointer; transition: background .15s;
    }
    .tbl-btn-hapus:hover { background: #fee2e2; }

    /* ── RESPONSIVE ── */
    .mobile-only  { display: block; }
    .desktop-only { display: none; }

    @media (min-width: 768px) {
        .mobile-only  { display: none; }
        .desktop-only { display: block; }

        .rb-page  { padding: 1.5rem; gap: 1.25rem; }
        .rb-hero  { padding: 1.75rem 2rem; }
        .rb-hero h1 { font-size: 1.5rem; }
        .rb-hero p  { font-size: .8125rem; }
        .rb-hero-icon { width: 44px; height: 44px; border-radius: 10px; margin-bottom: .875rem; }
        .rb-hero-btn  { font-size: .8125rem; padding: .55rem 1.1rem; border-radius: 9px; }

        .info-box     { padding: .875rem 1rem; }
        .info-box-title { font-size: .8125rem; }
        .info-box-list  { font-size: .775rem; padding-left: 1rem; }

        .flash-success { font-size: .8125rem; padding: .875rem 1rem; }

        .tingkat-dot   { width: 10px; height: 10px; }
        .tingkat-title { font-size: 1rem; }
        .tingkat-badge { font-size: .7rem; padding: 3px 10px; }

        .rb-card        { padding: 1rem; border-radius: 14px; }
        .rb-card-avatar { width: 42px; height: 42px; border-radius: 10px; font-size: .75rem; }
        .rb-card-name   { font-size: 1rem; }
        .rb-card-sub    { font-size: .775rem; }
        .btn-edit, .btn-hapus { font-size: .8125rem; padding: .6rem; border-radius: 9px; }
    }

    @media (min-width: 1024px) {
        .rb-page { padding: 2rem; }
    }
</style>

<div class="rb-page">

    {{-- ═══ HERO ═══ --}}
    <div class="rb-hero">
        <div class="rb-hero-inner">
            <div>
                <div class="rb-hero-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h1>Data Rombel</h1>
                <p>Tahun Ajaran Aktif: <strong>{{ $tahunAjaranAktif->tahun_ajaran }} ({{ $tahunAjaranAktif->semester }})</strong></p>
            </div>
            <a href="{{ url('/staff_tu/rombel/create') }}" class="rb-hero-btn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Rombel
            </a>
        </div>
    </div>

    {{-- ═══ FLASH ═══ --}}
    @if(session('success'))
    <div class="flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ═══ INFO BOX ═══ --}}
    <div class="info-box">
        <div style="flex-shrink:0;margin-top:1px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div>
            <div class="info-box-title">Panduan Rombel</div>
            <ul class="info-box-list">
                <li>Rombel (Rombongan Belajar) adalah kelompok kelas siswa per tingkat.</li>
                <li>Setiap rombel memiliki <strong>kode</strong> (mis. A, B) dan <strong>nama rombel</strong> lengkap.</li>
                <li>Data rombel berlaku untuk tahun ajaran yang sedang aktif.</li>
                <li>Gunakan <strong>Edit</strong> untuk memperbaiki data, dan <strong>Hapus</strong> jika rombel sudah tidak digunakan.</li>
            </ul>
        </div>
    </div>

    {{-- ═══ LOOP PER TINGKAT ═══ --}}
    @foreach([7, 8, 9] as $tingkat)
    @php $total = isset($grouped[$tingkat]) ? $grouped[$tingkat]->count() : 0; @endphp

    <div class="tingkat-section tingkat-{{ $tingkat }}">

        <div class="tingkat-header">
            <div class="tingkat-title-wrap">
                <span class="tingkat-dot"></span>
                <span class="tingkat-title">Tingkat {{ $roman[$tingkat] }}</span>
            </div>
            <span class="tingkat-badge">{{ $total }} Rombel</span>
        </div>

        {{-- ── MOBILE ── --}}
        <div class="mobile-only">
            @forelse($grouped[$tingkat] ?? [] as $item)
            <div class="rb-card">
                <div class="rb-card-top">
                    <div class="rb-card-avatar">
                        {{ $roman[$item->tingkat] }}<br>{{ $item->kode_rombel }}
                    </div>
                    <div>
                        <div class="rb-card-name">{{ $roman[$item->tingkat] }} {{ $item->kode_rombel }}</div>
                        <div class="rb-card-sub">{{ $item->nama_rombel }}</div>
                    </div>
                </div>

                <hr class="rb-divider">

                <div class="rb-actions">
                    <a href="{{ url('/staff_tu/rombel/'.$item->id.'/edit') }}" class="btn-edit">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit
                    </a>
                    <div class="btn-hapus-wrap">
                        <form action="{{ url('/staff_tu/rombel/'.$item->id) }}"
                            method="POST"
                            style="flex:1;display:flex;"
                            onsubmit="return confirm('Yakin hapus rombel {{ $roman[$item->tingkat] }} {{ $item->kode_rombel }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                    <path d="M10 11v6"/><path d="M14 11v6"/>
                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-card">
                <div class="empty-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                    </svg>
                </div>
                <div class="empty-title">Belum ada rombel</div>
                <div class="empty-sub">Belum ada rombel untuk Tingkat {{ $roman[$tingkat] }}</div>
            </div>
            @endforelse
        </div>

        {{-- ── DESKTOP TABLE ── --}}
        <div class="desktop-only">
            <div class="ta-table-wrap">
                <table class="ta-table">
                    <thead>
                        <tr>
                            <th class="th-center" style="width:50px;">No</th>
                            <th>Rombel</th>
                            <th>Nama Rombel</th>
                            <th class="th-center" style="width:160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grouped[$tingkat] ?? [] as $item)
                        <tr>
                            <td class="td-no">{{ $loop->iteration }}</td>
                            <td>
                                <div style="display:flex;align-items:center;gap:.625rem;">
                                    <span class="tbl-avatar">
                                        {{ $roman[$item->tingkat] }}<br>{{ $item->kode_rombel }}
                                    </span>
                                    <span class="td-rombel">{{ $roman[$item->tingkat] }} {{ $item->kode_rombel }}</span>
                                </div>
                            </td>
                            <td class="td-nama">{{ $item->nama_rombel }}</td>
                            <td class="td-center">
                                <div class="tbl-actions">
                                    <a href="{{ url('/staff_tu/rombel/'.$item->id.'/edit') }}" class="tbl-btn-edit">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ url('/staff_tu/rombel/'.$item->id) }}"
                                        method="POST" style="margin:0;"
                                        onsubmit="return confirm('Yakin hapus rombel {{ $roman[$item->tingkat] }} {{ $item->kode_rombel }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="tbl-btn-hapus">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                <path d="M10 11v6"/><path d="M14 11v6"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center;padding:2rem;color:#94a3b8;font-size:.875rem;">
                                Belum ada rombel untuk Tingkat {{ $roman[$tingkat] }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @endforeach

</div>

@endsection