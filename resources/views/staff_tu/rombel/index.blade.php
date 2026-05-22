@extends('layouts.staff_tu')

@section('content')
@php
$roman   = [7 => 'VII', 8 => 'VIII', 9 => 'IX'];
$grouped = $rombels->groupBy('tingkat');
$total   = $rombels->count();
$t7      = isset($grouped[7]) ? $grouped[7]->count() : 0;
$t8      = isset($grouped[8]) ? $grouped[8]->count() : 0;
$t9      = isset($grouped[9]) ? $grouped[9]->count() : 0;
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
    --red:      #dc2626;
    --red-lt:   #fff1f2;
    --red-bd:   #fecdd3;
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

/* ── INFO BANNER ── */
.info-banner {
    display: flex; gap: 12px; align-items: flex-start;
    padding: .875rem 1rem;
    background: var(--amber-lt);
    border: 1px solid var(--amber-bd);
    border-radius: 10px; margin-bottom: 1.5rem;
}
.info-banner-body { font-size: 13px; color: #78350f; line-height: 1.7; }
.info-banner-body strong { font-weight: 600; color: #92400e; }

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
.stat-val.purple { color: #7e22ce; }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

/* ── TINGKAT SECTION ── */
.tingkat-section { margin-bottom: 1.75rem; }
.tingkat-header {
    display: flex; align-items: center;
    justify-content: space-between; gap: .75rem;
    margin-bottom: .875rem;
}
.tingkat-title-wrap { display: flex; align-items: center; gap: 10px; }
.tingkat-dot {
    width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0;
}
.tingkat-title {
    font-size: 15px; font-weight: 600;
    color: var(--text); letter-spacing: -.01em;
}
.tingkat-badge {
    font-size: 12px; font-weight: 600;
    padding: 3px 11px; border-radius: 99px;
    border: 1px solid; white-space: nowrap;
}

/* tingkat warna */
.t7 .tingkat-dot  { background: #3b82f6; }
.t7 .tingkat-badge { background: #eff6ff; border-color: #bfdbfe; color: #1d4ed8; }
.t8 .tingkat-dot  { background: #22c55e; }
.t8 .tingkat-badge { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; }
.t9 .tingkat-dot  { background: #a855f7; }
.t9 .tingkat-badge { background: #fdf4ff; border-color: #e9d5ff; color: #7e22ce; }

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

/* ── AVATAR ── */
.tbl-avatar {
    display: inline-flex; align-items: center; justify-content: center;
    width: 34px; height: 34px; border-radius: 8px;
    font-size: 10px; font-weight: 600; line-height: 1.2; text-align: center;
    flex-shrink: 0; 
}
.t7 .tbl-avatar { background: #eff6ff; border: 1px solid #bfdbfe; color: #1d4ed8; }
.t8 .tbl-avatar { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
.t9 .tbl-avatar { background: #fdf4ff; border: 1px solid #e9d5ff; color: #7e22ce; }

.td-rombel {
    
    font-size: 14px; font-weight: 500; color: var(--text);
}
.td-nama { font-size: 13px; color: var(--muted); }

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
.btn-edit  { color: var(--amber); border-color: var(--amber-bd); background: var(--amber-lt); }
.btn-edit:hover  { background: #fef3c7; }
.btn-hapus { color: var(--red); border-color: var(--red-bd); background: var(--red-lt); }
.btn-hapus:hover { background: #fee2e2; }

/* ── EMPTY ── */
.empty-state {
    text-align: center; padding: 2.5rem 1rem;
}
.empty-icon {
    width: 48px; height: 48px; background: var(--gray-bg);
    border-radius: 12px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.empty-state strong { display: block; font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.empty-state p { font-size: 13px; color: var(--muted); }
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
                <h1>Data Rombel</h1>
                @if($tahunAjaranAktif)
                    <p>Tahun Ajaran Aktif: <strong>{{ $tahunAjaranAktif->tahun_ajaran }} &mdash; Semester {{ $tahunAjaranAktif->semester }}</strong></p>
                @else
                    <p class="warn-ta">⚠ Belum ada tahun ajaran aktif</p>
                @endif
            </div>
        </div>
        <a href="{{ url('/staff_tu/rombel/create') }}" class="btn-add">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Rombel
        </a>
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
            <strong>Panduan Rombel &mdash;</strong>
            Rombel (Rombongan Belajar) adalah kelompok kelas siswa per tingkat. Setiap rombel memiliki <strong>kode</strong> (mis. A, B) dan <strong>nama rombel</strong> lengkap.
            Data rombel berlaku untuk tahun ajaran yang sedang aktif. Gunakan <strong>Edit</strong> untuk memperbaiki data, dan <strong>Hapus</strong> jika rombel sudah tidak digunakan.
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
            <div class="stat-label">Tingkat VII</div>
            <div class="stat-val blue">{{ $t7 }}</div>
            <div class="stat-sub">rombel kelas 7</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Tingkat VIII</div>
            <div class="stat-val green">{{ $t8 }}</div>
            <div class="stat-sub">rombel kelas 8</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Tingkat IX</div>
            <div class="stat-val purple">{{ $t9 }}</div>
            <div class="stat-sub">rombel kelas 9</div>
        </div>
    </div>

    {{-- ═══ LOOP PER TINGKAT ═══ --}}
    @foreach([7, 8, 9] as $tingkat)
    @php
        $items = $grouped[$tingkat] ?? collect();
        $tClass = 't' . $tingkat;
    @endphp

    <div class="tingkat-section {{ $tClass }}">

        <div class="tingkat-header">
            <div class="tingkat-title-wrap">
                <span class="tingkat-dot"></span>
                <span class="tingkat-title">Tingkat {{ $roman[$tingkat] }}</span>
            </div>
            <span class="tingkat-badge">{{ $items->count() }} Rombel</span>
        </div>

        <div class="table-card">
            <div class="table-card-header">
                <span class="table-card-title">Daftar Rombel Tingkat {{ $roman[$tingkat] }}</span>
                <span class="table-count">{{ $items->count() }} data</span>
            </div>
            <table class="ta-table">
                <thead>
                    <tr>
                        <th style="width:52px;text-align:center">No</th>
                        <th>Rombel</th>
                        <th>Nama Rombel</th>
                        <th style="width:200px;text-align:right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td class="td-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <span class="tbl-avatar">
                                    {{ $roman[$item->tingkat] }}<br>{{ $item->kode_rombel }}
                                </span>
                                <span class="td-rombel">{{ $roman[$item->tingkat] }} {{ $item->kode_rombel }}</span>
                            </div>
                        </td>
                        <td class="td-nama">{{ $item->nama_rombel }}</td>
                        <td>
                            <div class="tbl-actions">
                                <a href="{{ url('/staff_tu/rombel/'.$item->id.'/edit') }}" class="btn-sm btn-edit">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ url('/staff_tu/rombel/'.$item->id) }}" method="POST" style="margin:0;"
                                    onsubmit="return confirm('Yakin hapus rombel {{ $roman[$item->tingkat] }} {{ $item->kode_rombel }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-hapus">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6"/><path d="M14 11v6"/>
                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                    </svg>
                                </div>
                                <strong>Belum ada rombel</strong>
                                <p>Belum ada rombel untuk Tingkat {{ $roman[$tingkat] }}. Klik "Tambah Rombel" untuk menambahkan.</p>
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