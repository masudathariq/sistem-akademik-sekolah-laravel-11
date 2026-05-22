@extends('layouts.bendahara')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap');

*{
    box-sizing:border-box;
    font-family:'IBM Plex Sans',sans-serif;
}

:root{
    --navy:#1e3a8a;
    --navy-md:#1d4ed8;
    --navy-lt:#dbeafe;

    --green:#16a34a;
    --green-lt:#f0fdf4;
    --green-bd:#86efac;

    --amber:#d97706;
    --amber-lt:#fffbeb;
    --amber-bd:#fcd34d;

    --red:#dc2626;
    --red-lt:#fff1f2;
    --red-bd:#fecdd3;

    --gray-bg:#f8fafc;
    --border:#e2e8f0;

    --text:#1e293b;
    --muted:#64748b;
    --hint:#94a3b8;

    --radius:12px;

    --shadow:
        0 1px 3px rgba(0,0,0,.06),
        0 4px 12px rgba(0,0,0,.04);
}

body{
    background:var(--gray-bg);
}

.rb-page{
    min-height:100vh;
    padding:2rem;
    padding-bottom:4rem;
    color:var(--text);
}

/* ─────────────────────────
   TOP BAR
───────────────────────── */
.top-bar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    margin-bottom:1.75rem;
    flex-wrap:wrap;
}

.page-title{
    display:flex;
    align-items:center;
    gap:12px;
}

.title-icon{
    width:44px;
    height:44px;
    background:var(--navy-lt);
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.title-text h1{
    font-size:20px;
    font-weight:600;
    color:var(--text);
    margin:0 0 3px;
    letter-spacing:-.02em;
}

.title-text p{
    font-size:13px;
    color:var(--muted);
    margin:0;
}

.title-text p strong{
    color:var(--navy-md);
    font-weight:600;
}

/* ─────────────────────────
   FILTER CARD
───────────────────────── */
.filter-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    overflow:hidden;
    margin-bottom:1.5rem;
}

.filter-header{
    padding:1rem 1.5rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
}

.filter-header h2{
    font-size:14px;
    font-weight:600;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    margin:0;
}

.filter-body{
    padding:1.5rem;
}

.filter-form{
    display:flex;
    align-items:end;
    gap:1rem;
    flex-wrap:wrap;
}

.form-group{
    display:flex;
    flex-direction:column;
    gap:6px;
    min-width:180px;
}

.form-group label{
    font-size:12px;
    font-weight:600;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
}

.form-input,
.form-select{
    width:100%;
    padding:10px 14px;
    border:1px solid var(--border);
    border-radius:10px;
    font-size:14px;
    background:white;
    transition:all .15s ease;
}

.form-input:focus,
.form-select:focus{
    outline:none;
    border-color:var(--navy-md);
    box-shadow:0 0 0 3px rgba(29,78,216,.1);
}

/* ─────────────────────────
   BUTTON
───────────────────────── */
.btn-primary{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 20px;
    background:var(--navy-md);
    color:white;
    border:none;
    border-radius:10px;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:all .15s ease;
    text-decoration:none;
}

.btn-primary:hover{
    background:var(--navy);
    transform:translateY(-1px);
}

/* ─────────────────────────
   INFO PREVIEW
───────────────────────── */
.info-preview{
    background:var(--navy-lt);
    border:1px solid #bfdbfe;
    border-radius:10px;
    padding:1rem;
    margin-bottom:1.5rem;
    display:flex;
    align-items:center;
    gap:12px;
}

.info-preview-icon{
    width:36px;
    height:36px;
    background:white;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.info-preview-text{
    flex:1;
}

.info-preview-text p{
    margin:0;
    font-size:12px;
    color:var(--navy-md);
}

.preview-value{
    font-size:14px;
    font-weight:700;
    color:var(--navy);
    margin-top:2px;
}

/* ─────────────────────────
   STATS
───────────────────────── */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:1rem;
    margin-bottom:1.5rem;
}

.stat-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1rem 1.25rem;
    box-shadow:var(--shadow);
}

.stat-label{
    font-size:11px;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    margin-bottom:10px;
    font-weight:600;
}

.stat-value{
    font-size:28px;
    font-weight:700;
    line-height:1;
}

.stat-blue{ color:var(--navy-md); }
.stat-green{ color:var(--green); }
.stat-amber{ color:var(--amber); }
.stat-red{ color:var(--red); }

.stat-sub{
    font-size:11px;
    color:var(--hint);
    margin-top:6px;
}

/* ─────────────────────────
   TABLE CARD
───────────────────────── */
.table-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
    margin-bottom:1.5rem;
}

.table-header{
    padding:1rem 1.5rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    flex-wrap:wrap;
}

.table-header h2{
    font-size:14px;
    font-weight:600;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    margin:0;
}

.table-header span{
    font-size:12px;
    color:var(--hint);
}

.table-wrap{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:800px;
}

thead th{
    background:#f8fafc;
    padding:12px 14px;
    border-bottom:1px solid var(--border);
    font-size:11px;
    font-weight:700;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    white-space:nowrap;
    text-align:left;
}

tbody td{
    padding:14px;
    border-bottom:1px solid #f1f5f9;
    vertical-align:middle;
    font-size:13px;
    color:var(--text);
}

tbody tr:last-child td{
    border-bottom:none;
}

tbody tr:hover{
    background:#fafafa;
}

/* ─────────────────────────
   TABLE STYLE
───────────────────────── */
.teacher-name{
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:600;
}

.teacher-avatar{
    width:34px;
    height:34px;
    border-radius:10px;
    background:var(--navy-lt);
    color:var(--navy-md);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:12px;
    font-weight:700;
    flex-shrink:0;
}

.tc{
    text-align:center;
}

.badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:4px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:600;
}

.badge-hadir{
    background:var(--green-lt);
    color:var(--green);
}

.badge-izin{
    background:var(--amber-lt);
    color:var(--amber);
}

.badge-sakit{
    background:var(--red-lt);
    color:var(--red);
}

.progress-wrap{
    display:flex;
    align-items:center;
    gap:8px;
    min-width:130px;
}

.progress-bar{
    flex:1;
    height:6px;
    background:#e2e8f0;
    border-radius:999px;
    overflow:hidden;
}

.progress-fill{
    height:100%;
    border-radius:999px;
}

.progress-high{
    background:var(--green);
}

.progress-medium{
    background:var(--amber);
}

.progress-low{
    background:var(--red);
}

.progress-text{
    font-size:11px;
    font-weight:700;
    color:var(--muted);
    min-width:40px;
    text-align:right;
}

/* ─────────────────────────
   GURU GRID
───────────────────────── */
.guru-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
    gap:12px;
    padding:1.5rem;
}

.guru-card{
    display:flex;
    align-items:center;
    gap:12px;
    padding:14px;
    border:1px solid var(--border);
    border-radius:10px;
    text-decoration:none;
    transition:all .15s ease;
    background:white;
}

.guru-card:hover{
    border-color:var(--navy-md);
    background:var(--navy-lt);
    transform:translateY(-1px);
}

.guru-avatar{
    width:40px;
    height:40px;
    border-radius:10px;
    background:var(--navy-lt);
    color:var(--navy-md);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    font-weight:700;
    flex-shrink:0;
}

.guru-info{
    flex:1;
}

.guru-name{
    font-size:13px;
    font-weight:600;
    color:var(--text);
}

.guru-hint{
    font-size:11px;
    color:var(--hint);
    margin-top:2px;
}

/* ─────────────────────────
   EMPTY
───────────────────────── */
.empty{
    text-align:center;
    padding:3rem 1rem !important;
    color:var(--hint);
    font-size:13px;
}

/* ─────────────────────────
   RESPONSIVE
───────────────────────── */
@media (max-width:768px){

    .rb-page{
        padding:1rem;
    }

    .filter-form{
        flex-direction:column;
        align-items:stretch;
    }

    .form-group{
        min-width:100%;
    }

    .stats-grid{
        grid-template-columns:1fr 1fr;
    }

    .guru-grid{
        grid-template-columns:1fr;
    }

}

@media (max-width:500px){

    .stats-grid{
        grid-template-columns:1fr;
    }

}
</style>

<div class="rb-page">

    {{-- ═════════ TOP BAR ═════════ --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">

                <svg width="22"
                     height="22"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="#1d4ed8"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                    <path d="m9 16 2 2 4-4"/>

                </svg>

            </div>

            <div class="title-text">

                <h1>Rekap Absensi Guru</h1>

                <p>
                    Rekap kehadiran seluruh guru
                    &mdash;
                    <strong>
                        {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM') }}
                        {{ $tahun }}
                    </strong>
                </p>

            </div>

        </div>

    </div>

    {{-- ═════════ FILTER ═════════ --}}
    <div class="filter-card">

        <div class="filter-header">
            <h2>📅 Filter Periode</h2>
        </div>

        <div class="filter-body">

            <div class="info-preview">

                <div class="info-preview-icon">

                    <svg width="18"
                         height="18"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="#1d4ed8"
                         stroke-width="2">

                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>

                    </svg>

                </div>

                <div class="info-preview-text">

                    <p>Periode aktif:</p>

                    <p class="preview-value">
                        {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM') }}
                        {{ $tahun }}
                    </p>

                </div>

            </div>

            <form method="GET"
                  action="{{ route('bendahara.rekap') }}"
                  class="filter-form">

                <div class="form-group">

                    <label>Bulan</label>

                    <select name="bulan"
                            class="form-select">

                        @for($m = 1; $m <= 12; $m++)

                            <option value="{{ $m }}"
                                {{ $bulan == $m ? 'selected' : '' }}>

                                {{ \Carbon\Carbon::createFromDate(null, $m, 1)->locale('id')->isoFormat('MMMM') }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="form-group">

                    <label>Tahun</label>

                    <input type="number"
                           name="tahun"
                           value="{{ $tahun }}"
                           min="2020"
                           max="2099"
                           class="form-input">

                </div>

                <button type="submit"
                        class="btn-primary">

                    <svg width="14"
                         height="14"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">

                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>

                    </svg>

                    Terapkan Filter

                </button>

            </form>

        </div>

    </div>

    {{-- ═════════ STATS ═════════ --}}
    @php
        $col       = collect($rekapGuru);
        $totalGuru = $col->count();
        $topHadir  = $col->sortByDesc('hadir')->first();
        $topIzin   = $col->sortByDesc('izin')->first();
        $topSakit  = $col->sortByDesc('sakit')->first();
    @endphp

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Total Guru</div>
            <div class="stat-value stat-blue">{{ $totalGuru }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Hadir Terbanyak</div>
            <div class="stat-value stat-green">
                {{ $topHadir ? $topHadir['hadir'] : 0 }}
            </div>

            @if($topHadir)
                <div class="stat-sub">
                    {{ $topHadir['guru']->nama }}
                </div>
            @endif
        </div>

        <div class="stat-card">
            <div class="stat-label">Izin Terbanyak</div>
            <div class="stat-value stat-amber">
                {{ $topIzin ? $topIzin['izin'] : 0 }}
            </div>

            @if($topIzin)
                <div class="stat-sub">
                    {{ $topIzin['guru']->nama }}
                </div>
            @endif
        </div>

        <div class="stat-card">
            <div class="stat-label">Sakit Terbanyak</div>
            <div class="stat-value stat-red">
                {{ $topSakit ? $topSakit['sakit'] : 0 }}
            </div>

            @if($topSakit)
                <div class="stat-sub">
                    {{ $topSakit['guru']->nama }}
                </div>
            @endif
        </div>

    </div>

    {{-- ═════════ TABLE ═════════ --}}
    <div class="table-card">

        <div class="table-header">

            <h2>📊 Ringkasan Kehadiran Guru</h2>

            <span>
                {{ count($rekapGuru) }} data guru
            </span>

        </div>

        <div class="table-wrap">

            <table>

                <thead>

                    <tr>
                        <th>Nama Guru</th>
                        <th class="tc">Hadir</th>
                        <th class="tc">Izin</th>
                        <th class="tc">Sakit</th>
                        <th class="tc">Hari Aktif</th>
                        <th>Kehadiran</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($rekapGuru as $rg)

                        @php
                            $pct = (float) $rg['persenHadir'];

                            $barClass =
                                $pct >= 80
                                    ? 'progress-high'
                                    : ($pct >= 50
                                        ? 'progress-medium'
                                        : 'progress-low');
                        @endphp

                        <tr>

                            <td>

                                <div class="teacher-name">

                                    <div class="teacher-avatar">

                                        {{ strtoupper(substr($rg['guru']->nama,0,2)) }}

                                    </div>

                                    {{ $rg['guru']->nama }}

                                </div>

                            </td>

                            <td class="tc">
                                <span class="badge badge-hadir">
                                    {{ $rg['hadir'] }}
                                </span>
                            </td>

                            <td class="tc">
                                <span class="badge badge-izin">
                                    {{ $rg['izin'] }}
                                </span>
                            </td>

                            <td class="tc">
                                <span class="badge badge-sakit">
                                    {{ $rg['sakit'] }}
                                </span>
                            </td>

                            <td class="tc">
                                {{ $rg['jumlahHari'] }}
                            </td>

                            <td>

                                <div class="progress-wrap">

                                    <div class="progress-bar">

                                        <div class="progress-fill {{ $barClass }}"
                                             style="width:{{ min($pct,100) }}%;">
                                        </div>

                                    </div>

                                    <span class="progress-text">
                                        {{ $pct }}%
                                    </span>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="empty">

                                Belum ada data rekap absensi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- ═════════ GURU LIST ═════════ --}}
    <div class="table-card">

        <div class="table-header">

            <h2>👨‍🏫 Daftar Guru</h2>

            <span>
                Klik nama guru untuk melihat detail absensi
            </span>

        </div>

        @if($guruList->isEmpty())

            <div class="empty">
                Belum ada data guru.
            </div>

        @else

            <div class="guru-grid">

                @foreach($guruList as $guru)

                    <a href="{{ route('bendahara.rekap.show', $guru->id) }}"
                       class="guru-card">

                        <div class="guru-avatar">

                            {{ strtoupper(substr($guru->nama,0,2)) }}

                        </div>

                        <div class="guru-info">

                            <div class="guru-name">
                                {{ $guru->nama }}
                            </div>

                            <div class="guru-hint">
                                Lihat detail absensi →
                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

        @endif

    </div>

</div>

@endsection