@extends('layouts.staff_tu')

@section('title', 'Kategori Rombel')

@section('content')
@php
$grouped  = $rombels->groupBy('tingkat')->sortKeys();
$total    = $rombels->count();
$pondok   = $rombels->filter(fn($r) => ($r->kategori->kategori ?? null) === 'pondok')->count();
$reguler  = $rombels->filter(fn($r) => ($r->kategori->kategori ?? null) === 'reguler')->count();
$belumSet = $total - $pondok - $reguler;
@endphp

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
    --gray-bg:  #f8fafc;
    --border:   #e2e8f0;
    --text:     #1e293b;
    --muted:    #64748b;
    --hint:     #94a3b8;
    --radius:   12px;
    --shadow:   0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.04);
}

body { font-family: 'IBM Plex Sans', sans-serif; }

.kr-page {
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
}
.page-title { display: flex; align-items: center; gap: 12px; }
.title-icon {
    width: 44px; height: 44px; background: var(--navy-lt);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.title-text h1 {
    font-size: 20px; font-weight: 600; color: var(--text);
    margin: 0 0 3px; letter-spacing: -.02em;
}
.title-text p { font-size: 13px; color: var(--muted); margin: 0; }

/* ── FLASH ── */
.flash-success {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--green-lt); border: 1px solid var(--green-bd);
    border-radius: 8px; font-size: 13px; font-weight: 600;
    color: var(--green); margin-bottom: 1.25rem;
}

/* ── INFO BANNER ── */
.info-banner {
    display: flex; gap: 12px; align-items: flex-start;
    padding: .875rem 1rem;
    background: var(--amber-lt); border: 1px solid var(--amber-bd);
    border-radius: 10px; margin-bottom: 1.5rem;
}
.info-banner-body { font-size: 13px; color: #78350f; line-height: 1.7; }
.info-banner-body strong { font-weight: 600; color: #92400e; }

/* ── STAT CARDS ── */
.stats-row {
    display: grid; grid-template-columns: repeat(4, 1fr);
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
.stat-val.purple { color: #7e22ce; }
.stat-val.gray   { color: var(--hint); }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

/* ── TINGKAT SECTION ── */
.tingkat-section { margin-bottom: 1.75rem; }
.tingkat-header {
    display: flex; align-items: center;
    justify-content: space-between; gap: .75rem;
    margin-bottom: .875rem;
}
.tingkat-title-wrap { display: flex; align-items: center; gap: 10px; }
.tingkat-badge-pill {
    display: inline-flex; align-items: center; justify-content: center;
    padding: 3px 13px; border-radius: 99px;
    font-size: 12px; font-weight: 600;
    background: var(--navy); color: #fff;
    letter-spacing: .02em; white-space: nowrap;
}
.tingkat-count-pill {
    font-size: 12px; color: var(--hint);
    background: var(--gray-bg); border: 1px solid var(--border);
    border-radius: 99px; padding: 2px 10px; font-weight: 600;
}

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
.td-rombel-name { font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 2px; }
.td-rombel-sub  { font-size: 12px; color: var(--muted); }

/* ── KATEGORI BADGES ── */
.kat-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 11px; border-radius: 99px;
    font-size: 12px; font-weight: 600; border: 1px solid;
    white-space: nowrap;
}
.kat-pondok  .kat-badge { background: #fdf4ff; border-color: #e9d5ff; color: #7e22ce; }
.kat-reguler .kat-badge { background: var(--navy-lt); border-color: #bfdbfe; color: var(--navy-md); }
.kat-none    .kat-badge { background: var(--gray-bg); border-color: var(--border); color: var(--hint); }
.kat-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
.kat-pondok  .kat-dot { background: #a855f7; }
.kat-reguler .kat-dot { background: #3b82f6; }
.kat-none    .kat-dot { background: var(--hint); }

/* ── FORM DALAM TABEL ── */
.tbl-form-row {
    display: inline-flex; align-items: center; gap: 6px;
}
.tbl-select {
    border: 1px solid var(--border); border-radius: 7px;
    padding: .375rem .65rem; font-size: 13px;
    font-family: 'IBM Plex Sans', sans-serif;
    color: var(--text); background: #fff;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right .5rem center;
    padding-right: 1.75rem; cursor: pointer;
    transition: border-color .15s, box-shadow .15s;
}
.tbl-select:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.15); }

.btn-sm {
    display: inline-flex; align-items: center; gap: 5px;
    padding: .375rem .8rem; border-radius: 7px;
    font-size: 12.5px; font-weight: 600; cursor: pointer;
    text-decoration: none; transition: background .15s, transform .1s;
    border: 1px solid; background: none;
    font-family: 'IBM Plex Sans', sans-serif;
    white-space: nowrap;
}
.btn-sm:active { transform: scale(.96); }
.btn-simpan { color: #fff; border-color: var(--navy); background: var(--navy); }
.btn-simpan:hover { background: var(--navy-md); border-color: var(--navy-md); }
.btn-lihat  { color: var(--muted); border-color: var(--border); background: var(--gray-bg); }
.btn-lihat:hover  { background: var(--border); }

/* ── EMPTY ── */
.empty-state { text-align: center; padding: 2.5rem 1rem; }
.empty-icon {
    width: 48px; height: 48px; background: var(--gray-bg);
    border-radius: 12px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.empty-state strong { display: block; font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.empty-state p { font-size: 13px; color: var(--muted); }
</style>

<div class="kr-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3h7v7H3z"/><path d="M14 3h7v7h-7z"/>
                    <path d="M14 14h7v7h-7z"/><path d="M3 14h7v7H3z"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Kategori Rombel</h1>
                <p>Atur kategori setiap rombel — Reguler atau Pondok</p>
            </div>
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
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="info-banner-body">
            <strong>Panduan Kategori Rombel &mdash;</strong>
            <strong>Reguler</strong> untuk siswa umum yang tidak tinggal di pondok.
            <strong>Pondok</strong> untuk siswa yang tinggal di pondok pesantren.
            Pilih kategori lalu klik <strong>Simpan</strong> untuk memperbarui, atau klik <strong>Lihat</strong> untuk melihat daftar siswa rombel.
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Rombel</div>
            <div class="stat-val">{{ $total }}</div>
            <div class="stat-sub">semua tingkat</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Reguler</div>
            <div class="stat-val blue">{{ $reguler }}</div>
            <div class="stat-sub">rombel reguler</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Pondok</div>
            <div class="stat-val purple">{{ $pondok }}</div>
            <div class="stat-sub">rombel pondok</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Belum Diset</div>
            <div class="stat-val gray">{{ $belumSet }}</div>
            <div class="stat-sub">perlu dikategorikan</div>
        </div>
    </div>

    {{-- ═══ LOOP PER TINGKAT ═══ --}}
    @foreach($grouped as $tingkat => $rombelGroup)
    <div class="tingkat-section">

        <div class="tingkat-header">
            <div class="tingkat-title-wrap">
                <span class="tingkat-badge-pill">Kelas {{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}</span>
            </div>
            <span class="tingkat-count-pill">{{ $rombelGroup->count() }} rombel</span>
        </div>

        <div class="table-card">
            <div class="table-card-header">
                <span class="table-card-title">Daftar Rombel Kelas {{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}</span>
                <span style="font-size:12px;color:var(--hint);font-weight:600;">{{ $rombelGroup->count() }} data</span>
            </div>
            <table class="ta-table">
                <thead>
                    <tr>
                        <th style="width:52px;text-align:center">No</th>
                        <th>Rombel</th>
                        <th style="width:160px">Kategori</th>
                        <th style="width:300px;text-align:right">Ubah Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rombelGroup as $i => $rombel)
                    @php
                        $kategori = $rombel->kategori->kategori ?? null;
                        $katClass = $kategori === 'pondok'  ? 'kat-pondok'
                                  : ($kategori === 'reguler' ? 'kat-reguler' : 'kat-none');
                        $katLabel = $kategori ? ucfirst($kategori) : 'Belum diset';
                    @endphp
                    <tr class="{{ $katClass }}">
                        <td class="td-no">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="td-rombel-name">{{ $rombel->nama_rombel }}</div>
                            <div class="td-rombel-sub">Kode: {{ $rombel->kode_rombel ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="kat-badge">
                                <span class="kat-dot"></span>
                                {{ $katLabel }}
                            </span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('staff_tu.rombel-kategori.store') }}" style="margin:0;">
                                @csrf
                                <input type="hidden" name="rombel_id" value="{{ $rombel->id }}">
                                <div class="tbl-form-row">
                                    <select name="kategori" class="tbl-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="reguler" {{ $kategori === 'reguler' ? 'selected' : '' }}>Reguler</option>
                                        <option value="pondok"  {{ $kategori === 'pondok'  ? 'selected' : '' }}>Pondok</option>
                                    </select>
                                    <button type="submit" class="btn-sm btn-simpan">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
                                            <polyline points="17 21 17 13 7 13 7 21"/>
                                            <polyline points="7 3 7 8 15 8"/>
                                        </svg>
                                        Simpan
                                    </button>
                                    <a href="{{ route('staff_tu.rombel-kategori.show', $rombel->id) }}" class="btn-sm btn-lihat">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                        Lihat
                                    </a>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round">
                                        <path d="M3 3h7v7H3z"/><path d="M14 3h7v7h-7z"/>
                                        <path d="M14 14h7v7h-7z"/><path d="M3 14h7v7H3z"/>
                                    </svg>
                                </div>
                                <strong>Belum ada rombel</strong>
                                <p>Belum ada rombel untuk kelas ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
    @endforeach

</div>

@endsection