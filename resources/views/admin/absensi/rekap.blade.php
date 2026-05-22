@extends('layouts.admin')

@section('title', 'Rekap Absensi Guru')
@section('header', 'Rekap Absensi Guru')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
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

    --purple:#7e22ce;
    --purple-lt:#fdf4ff;

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
    font-family:'IBM Plex Sans',sans-serif;
}

.rekap-page{
    min-height:100vh;
    background:var(--gray-bg);
    padding:2rem;
    padding-bottom:4rem;
    color:var(--text);
}

/* ───────── TOPBAR ───────── */
.top-bar{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:1rem;
    flex-wrap:wrap;
    margin-bottom:1.75rem;
}

.page-title{
    display:flex;
    align-items:center;
    gap:12px;
}

.title-icon{
    width:44px;
    height:44px;
    border-radius:10px;
    background:var(--navy-lt);
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    font-size:20px;
}

.title-text h1{
    font-size:20px;
    font-weight:700;
    letter-spacing:-.02em;
    color:var(--text);
    margin-bottom:3px;
}

.title-text p{
    font-size:13px;
    color:var(--muted);
    line-height:1.6;
    max-width:620px;
}

/* ───────── BUTTON ───────── */
.btn-danger{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:7px;
    padding:.7rem 1rem;
    border:1px solid var(--red-bd);
    border-radius:10px;
    background:var(--red-lt);
    color:var(--red);
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:.15s;
    box-shadow:var(--shadow);
}

.btn-danger:hover{
    transform:translateY(-1px);
}

/* ───────── FILTER ───────── */
.filter-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1rem;
    margin-bottom:1.5rem;
    box-shadow:var(--shadow);
}

.filter-form{
    display:flex;
    align-items:end;
    gap:12px;
    flex-wrap:wrap;
}

.filter-group{
    display:flex;
    flex-direction:column;
    gap:6px;
}

.filter-label{
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:var(--muted);
}

.filter-input{
    min-width:160px;
    border:1px solid var(--border);
    border-radius:10px;
    padding:.7rem .9rem;
    font-size:13px;
    color:var(--text);
    background:#fff;
    outline:none;
    transition:.15s;
    font-family:'IBM Plex Sans',sans-serif;
}

.filter-input:focus{
    border-color:var(--navy-md);
    box-shadow:0 0 0 3px rgba(29,78,216,.08);
}

.btn-primary{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:7px;
    padding:.75rem 1.2rem;
    border:none;
    border-radius:10px;
    background:var(--navy);
    color:#fff;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:.15s;
}

.btn-primary:hover{
    background:var(--navy-md);
}

/* ───────── STATS ───────── */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:1.5rem;
}

.stat-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1.1rem 1.2rem;
    box-shadow:var(--shadow);
}

.stat-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:14px;
}

.stat-label{
    font-size:11px;
    font-weight:700;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
}

.stat-icon{
    width:34px;
    height:34px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
}

.icon-blue{
    background:var(--navy-lt);
    color:var(--navy-md);
}

.icon-green{
    background:var(--green-lt);
    color:var(--green);
}

.icon-amber{
    background:var(--amber-lt);
    color:var(--amber);
}

.icon-purple{
    background:var(--purple-lt);
    color:var(--purple);
}

.stat-value{
    font-size:28px;
    font-weight:700;
    letter-spacing:-.04em;
    color:var(--text);
    line-height:1;
    margin-bottom:6px;
}

.stat-sub{
    font-size:12px;
    color:var(--muted);
}

/* ───────── TABLE CARD ───────── */
.table-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
    margin-bottom:1.5rem;
}

.table-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:1rem 1.25rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
}

.table-title{
    font-size:14px;
    font-weight:700;
    color:var(--text);
}

.table-meta{
    font-size:12px;
    color:var(--muted);
}

.table-wrap{
    overflow-x:auto;
}

/* ───────── TABLE ───────── */
.rekap-table{
    width:100%;
    border-collapse:collapse;
}

.rekap-table thead{
    background:var(--navy);
}

.rekap-table th{
    padding:.85rem 1rem;
    text-align:left;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:rgba(255,255,255,.9);
    white-space:nowrap;
}

.rekap-table td{
    padding:1rem;
    border-bottom:1px solid var(--border);
    font-size:13px;
    vertical-align:middle;
}

.rekap-table tbody tr:hover{
    background:#f8fbff;
}

.rekap-table tbody tr:last-child td{
    border-bottom:none;
}

.guru-name{
    font-weight:600;
    color:var(--text);
}

/* ───────── BADGE ───────── */
.badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:42px;
    padding:5px 12px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
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
    background:#eff6ff;
    color:#2563eb;
}

/* ───────── PROGRESS ───────── */
.progress-wrap{
    min-width:170px;
}

.progress{
    width:100%;
    height:8px;
    background:#e2e8f0;
    border-radius:999px;
    overflow:hidden;
    margin-bottom:6px;
}

.progress-bar{
    height:100%;
    background:linear-gradient(90deg,var(--navy),var(--navy-md));
    border-radius:999px;
}

.progress-text{
    font-size:12px;
    color:var(--muted);
    font-weight:600;
}

/* ───────── INFO ───────── */
.info-banner{
    display:flex;
    align-items:flex-start;
    gap:12px;
    padding:1rem 1.1rem;
    background:#eff6ff;
    border:1px solid #bfdbfe;
    border-radius:12px;
}

.banner-icon{
    width:40px;
    height:40px;
    border-radius:10px;
    background:var(--navy);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    font-size:18px;
}

.banner-title{
    font-size:14px;
    font-weight:700;
    margin-bottom:4px;
    color:var(--text);
}

.banner-desc{
    font-size:13px;
    line-height:1.7;
    color:var(--muted);
}

/* ───────── RESPONSIVE ───────── */
@media(max-width:1100px){

    .stats-grid{
        grid-template-columns:repeat(2,1fr);
    }

}

@media(max-width:900px){

    .rekap-page{
        padding:1rem;
    }

    .top-bar{
        flex-direction:column;
        align-items:stretch;
    }

    .filter-form{
        flex-direction:column;
        align-items:stretch;
    }

    .filter-input{
        width:100%;
    }

}

@media(max-width:640px){

    .stats-grid{
        grid-template-columns:1fr;
    }

}
</style>

@php
    $totalHadir = collect($rekapGuru)->sum('hadir');
    $totalIzin = collect($rekapGuru)->sum('izin');
    $totalSakit = collect($rekapGuru)->sum('sakit');
@endphp

<div class="rekap-page">

    {{-- TOPBAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                📊
            </div>

            <div class="title-text">

                <h1>Rekap Absensi Guru</h1>

                <p>
                    Monitoring dan evaluasi kehadiran tenaga pengajar
                    berdasarkan periode bulan dan tahun tertentu.
                </p>

            </div>

        </div>

        <form method="POST"
              action="{{ route('admin.absensi.hapus-bulan') }}">

            @csrf
            @method('DELETE')

            <input type="hidden"
                   name="bulan"
                   value="{{ $bulan }}">

            <input type="hidden"
                   name="tahun"
                   value="{{ $tahun }}">

            <button class="btn-danger">

                Hapus Bulan Ini

            </button>

        </form>

    </div>

    {{-- FILTER --}}
    <div class="filter-card">

        <form class="filter-form">

            <div class="filter-group">

                <label class="filter-label">
                    Bulan
                </label>

                <select name="bulan"
                        class="filter-input">

                    @for($m=1;$m<=12;$m++)

                    <option value="{{ $m }}"
                        {{ $bulan==$m?'selected':'' }}>

                        {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}

                    </option>

                    @endfor

                </select>

            </div>

            <div class="filter-group">

                <label class="filter-label">
                    Tahun
                </label>

                <input type="number"
                       name="tahun"
                       value="{{ $tahun }}"
                       class="filter-input">

            </div>

            <button class="btn-primary">

                Tampilkan

            </button>

        </form>

    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Total Guru
                </span>

                <div class="stat-icon icon-blue">
                    👨‍🏫
                </div>

            </div>

            <div class="stat-value">
                {{ count($rekapGuru) }}
            </div>

            <div class="stat-sub">
                Guru terdata dalam rekap
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Total Hadir
                </span>

                <div class="stat-icon icon-green">
                    ✅
                </div>

            </div>

            <div class="stat-value">
                {{ $totalHadir }}
            </div>

            <div class="stat-sub">
                Kehadiran guru tercatat
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Total Izin
                </span>

                <div class="stat-icon icon-amber">
                    📄
                </div>

            </div>

            <div class="stat-value">
                {{ $totalIzin }}
            </div>

            <div class="stat-sub">
                Guru izin mengajar
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Total Sakit
                </span>

                <div class="stat-icon icon-purple">
                    🏥
                </div>

            </div>

            <div class="stat-value">
                {{ $totalSakit }}
            </div>

            <div class="stat-sub">
                Guru sakit tercatat
            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">

            <div class="table-title">
                Data Rekap Kehadiran Guru
            </div>

            <div class="table-meta">
                {{ count($rekapGuru) }} data guru
            </div>

        </div>

        <div class="table-wrap">

            <table class="rekap-table">

                <thead>

                    <tr>
                        <th>Guru</th>
                        <th>Hadir</th>
                        <th>Izin</th>
                        <th>Sakit</th>
                        <th>Persentase Kehadiran</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($rekapGuru as $rg)

                    @php
                        $jumlahHari = \Carbon\Carbon::create($tahun,$bulan)->daysInMonth;

                        $persen =
                            $jumlahHari
                            ? round(($rg['hadir']/$jumlahHari)*100)
                            : 0;
                    @endphp

                    <tr>

                        <td class="guru-name">
                            {{ $rg['guru']->nama }}
                        </td>

                        <td>

                            <span class="badge badge-hadir">
                                {{ $rg['hadir'] }}
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-izin">
                                {{ $rg['izin'] }}
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-sakit">
                                {{ $rg['sakit'] }}
                            </span>

                        </td>

                        <td>

                            <div class="progress-wrap">

                                <div class="progress">

                                    <div class="progress-bar"
                                         style="width:{{ $persen }}%">

                                    </div>

                                </div>

                                <div class="progress-text">
                                    {{ $persen }}%
                                </div>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    {{-- INFO --}}
    <div class="info-banner">

        <div class="banner-icon">
            ℹ️
        </div>

        <div>

            <div class="banner-title">
                Informasi Rekap
            </div>

            <div class="banner-desc">
                Persentase kehadiran dihitung berdasarkan jumlah hadir
                dibandingkan total hari dalam bulan yang dipilih.
                Data ini membantu monitoring disiplin dan kehadiran guru.
            </div>

        </div>

    </div>

</div>

@endsection