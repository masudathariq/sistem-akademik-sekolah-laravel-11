@extends('layouts.staff_tu')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&display=swap');

*{box-sizing:border-box;}

:root {
    --navy:     #1e3a8a;
    --navy-md:  #1d4ed8;
    --navy-lt:  #dbeafe;
    --accent:   #2563eb;
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

.ta-page {
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
.page-title {
    display: flex;
    align-items: center;
    gap: 12px;
}
.title-icon {
    width: 44px; height: 44px;
    background: var(--navy-lt);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.title-text h1 {
    font-size: 20px;
    font-weight: 600;
    color: var(--text);
    margin: 0 0 3px;
    letter-spacing: -.02em;
}
.title-text p {
    font-size: 13px;
    color: var(--muted);
    margin: 0;
}
.btn-add {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: .575rem 1.1rem;
    background: var(--navy);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: background .15s, transform .12s;
    white-space: nowrap;
    font-family: 'IBM Plex Sans', sans-serif;
}
.btn-add:hover { background: var(--navy-md); }
.btn-add:active { transform: scale(.97); }

/* ── FLASH ── */
.flash-success {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: .75rem 1rem;
    background: var(--green-lt);
    border: 1px solid var(--green-bd);
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--green);
    margin-bottom: 1.25rem;
}

/* ── INFO BANNER ── */
.info-banner {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: .875rem 1rem;
    background: var(--amber-lt);
    border: 1px solid var(--amber-bd);
    border-radius: 10px;
    margin-bottom: 1.5rem;
}
.info-banner-icon { flex-shrink: 0; margin-top: 1px; }
.info-banner-body {
    font-size: 13px;
    color: #78350f;
    line-height: 1.7;
}
.info-banner-body strong { font-weight: 600; color: #92400e; }

/* ── STAT CARDS ── */
.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 1.5rem;
}
.stat-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 1rem 1.125rem;
    box-shadow: var(--shadow);
}
.stat-label {
    font-size: 11.5px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .05em;
    font-weight: 600;
    margin-bottom: 6px;
}
.stat-val {
    font-size: 26px;
    font-weight: 600;
    color: var(--text);
    letter-spacing: -.03em;
}
.stat-val.green { color: var(--green); }
.stat-sub {
    font-size: 12px;
    color: var(--muted);
    margin-top: 2px;
}

/* ── TABLE CARD ── */
.table-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}
.table-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .875rem 1.25rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.table-card-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .05em;
}
.table-count {
    font-size: 12px;
    color: var(--hint);
    background: var(--gray-bg);
    border: 1px solid var(--border);
    border-radius: 99px;
    padding: 2px 10px;
    font-weight: 600;
}

/* ── TABLE ── */
.ta-table { width: 100%; border-collapse: collapse; }
.ta-table thead th {
    padding: .75rem 1.25rem;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .06em;
    background: var(--gray-bg);
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.ta-table thead th:last-child { text-align: right; }

.ta-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background .12s;
}
.ta-table tbody tr:last-child { border-bottom: none; }
.ta-table tbody tr:hover { background: #f8fafc; }
.ta-table tbody tr.row-active { background: #f0fdf4; }
.ta-table tbody tr.row-active:hover { background: #dcfce7; }

.ta-table td {
    padding: 1rem 1.25rem;
    vertical-align: middle;
    font-size: 13.5px;
    color: var(--text);
}
.ta-table td:last-child { text-align: right; }

/* ── CELL STYLES ── */
.td-no {
    font-size: 12px;
    color: var(--hint);
    
    font-weight: 500;
    width: 50px;
}
.td-year {
    
    font-size: 14.5px;
    font-weight: 500;
    color: var(--text);
    letter-spacing: -.01em;
}
.sem-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}
.sem-odd  { background: var(--navy-lt); color: var(--navy); }
.sem-even { background: #f1f5f9; color: var(--muted); border: 1px solid var(--border); }

/* ── STATUS BADGES ── */
.badge-active {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 11px;
    background: var(--green-lt);
    border: 1px solid var(--green-bd);
    color: var(--green);
    font-size: 12px;
    font-weight: 700;
    border-radius: 99px;
}
.badge-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--green);
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%,100%{opacity:1} 50%{opacity:.25}
}
.badge-inactive {
    display: inline-flex;
    align-items: center;
    padding: 4px 11px;
    background: #f1f5f9;
    color: var(--hint);
    font-size: 12px;
    font-weight: 600;
    border-radius: 99px;
    border: 1px solid var(--border);
}

/* ── ACTION BUTTONS ── */
.tbl-actions {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-sm {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: .4rem .8rem;
    border-radius: 7px;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s, transform .1s;
    border: 1px solid;
    background: none;
    font-family: 'IBM Plex Sans', sans-serif;
}
.btn-sm:active { transform: scale(.96); }

.btn-edit {
    color: var(--amber);
    border-color: var(--amber-bd);
    background: var(--amber-lt);
}
.btn-edit:hover { background: #fef3c7; }

.btn-aktif {
    color: var(--green);
    border-color: var(--green-bd);
    background: var(--green-lt);
}
.btn-aktif:hover { background: #dcfce7; }

.btn-current {
    color: var(--hint);
    border-color: var(--border);
    background: #f8fafc;
    cursor: default;
    pointer-events: none;
}

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center;
    padding: 4rem 1rem;
}
.empty-icon {
    width: 54px; height: 54px;
    background: var(--navy-lt);
    border-radius: 14px;
    display: inline-flex; align-items: center; justify-content: center;
    margin-bottom: 1rem;
}
.empty-state strong {
    display: block;
    font-size: 15px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 4px;
}
.empty-state p {
    font-size: 13px;
    color: var(--muted);
}
</style>

<div class="ta-page">

    {{-- ═══════ TOP BAR ═══════ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Tahun Ajaran</h1>
                <p>Kelola periode dan semester aktif — hanya satu yang dapat aktif pada satu waktu</p>
            </div>
        </div>
        <a href="{{ url('/staff_tu/tahun-ajaran/create') }}" class="btn-add">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Tahun Ajaran
        </a>
    </div>

    {{-- ═══════ FLASH ═══════ --}}
    @if(session('success'))
    <div class="flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ═══════ INFO BANNER ═══════ --}}
    <div class="info-banner">
        <div class="info-banner-icon">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="info-banner-body">
            <strong>Cara kerja Tahun Ajaran &mdash;</strong>
            Tambahkan tahun ajaran beserta semesternya (Ganjil / Genap).
            Klik <strong>Set Aktif</strong> untuk menjadikan periode tersebut sebagai acuan seluruh data siswa, absensi, dan gaji &mdash; periode lain akan otomatis dinonaktifkan.
            Gunakan <strong>Edit</strong> untuk memperbaiki nama atau semester jika terjadi kesalahan input.
        </div>
    </div>

    {{-- ═══════ STAT CARDS ═══════ --}}
    @php
        $totalData   = $data->count();
        $activeCount = $data->where('is_active', true)->count();
        $ganjil      = $data->where('semester', 1)->count();
        $genap       = $data->where('semester', 2)->count();
    @endphp
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Periode</div>
            <div class="stat-val">{{ $totalData }}</div>
            <div class="stat-sub">tahun ajaran terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Periode Aktif</div>
            <div class="stat-val green">{{ $activeCount }}</div>
            <div class="stat-sub">sedang berjalan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Ganjil / Genap</div>
            <div class="stat-val">{{ $ganjil }} <span style="font-size:16px;color:var(--hint)">/</span> {{ $genap }}</div>
            <div class="stat-sub">distribusi semester</div>
        </div>
    </div>

    {{-- ═══════ TABLE ═══════ --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">Daftar Tahun Ajaran</span>
            <span class="table-count">{{ $totalData }} periode</span>
        </div>
        <table class="ta-table">
            <thead>
                <tr>
                    <th style="width:52px">No</th>
                    <th>Tahun Ajaran</th>
                    <th style="width:140px">Semester</th>
                    <th style="width:140px">Status</th>
                    <th style="width:220px;text-align:right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr class="{{ $item->is_active ? 'row-active' : '' }}">
                    <td class="td-no">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <span class="td-year">{{ $item->tahun_ajaran }}</span>
                    </td>
                    <td>
                        @if($item->semester == 1)
                            <span class="sem-badge sem-odd">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="4"/><line x1="12" y1="20" x2="12" y2="22"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="2" y1="12" x2="4" y2="12"/><line x1="20" y1="12" x2="22" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                                Ganjil
                            </span>
                        @else
                            <span class="sem-badge sem-even">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                                Genap
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($item->is_active)
                            <span class="badge-active">
                                <span class="badge-dot"></span>
                                Aktif
                            </span>
                        @else
                            <span class="badge-inactive">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ url('/staff_tu/tahun-ajaran/'.$item->id.'/edit') }}" class="btn-sm btn-edit">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>

                            @if(!$item->is_active)
                                <form action="{{ url('/staff_tu/tahun-ajaran/'.$item->id.'/aktif') }}" method="POST" style="margin:0">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-sm btn-aktif">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                        Set Aktif
                                    </button>
                                </form>
                            @else
                                <span class="btn-sm btn-current">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    Periode Aktif
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <strong>Belum ada data tahun ajaran</strong>
                            <p>Klik tombol "Tambah Tahun Ajaran" di atas untuk menambahkan periode pertama.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection