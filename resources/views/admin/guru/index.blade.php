@extends('layouts.admin')

@section('title', 'Data Guru')
@section('header', 'Data Guru')

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

    --cyan:#0891b2;
    --cyan-lt:#ecfeff;

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

.guru-page{
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
    max-width:650px;
}

/* ───────── STATS ───────── */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:14px;
    margin-bottom:1rem;
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

/* ───────── BREAKDOWN ───────── */
.breakdown-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:1.5rem;
}

.break-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:12px;
    padding:1rem;
    display:flex;
    align-items:center;
    gap:12px;
    box-shadow:var(--shadow);
}

.break-icon{
    width:42px;
    height:42px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    flex-shrink:0;
}

.break-cyan .break-icon{
    background:var(--cyan-lt);
    color:var(--cyan);
}

.break-pink .break-icon{
    background:#fff1f2;
    color:#e11d48;
}

.break-amber .break-icon{
    background:var(--amber-lt);
    color:var(--amber);
}

.break-red .break-icon{
    background:var(--red-lt);
    color:var(--red);
}

.break-value{
    font-size:22px;
    font-weight:700;
    line-height:1;
    margin-bottom:3px;
}

.break-label{
    font-size:12px;
    color:var(--muted);
}

/* ───────── BANNER ───────── */
.info-banner{
    display:flex;
    align-items:flex-start;
    gap:12px;
    padding:1rem 1.1rem;
    background:#eff6ff;
    border:1px solid #bfdbfe;
    border-radius:12px;
    margin-bottom:1.5rem;
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

/* ───────── TABLE ───────── */
.table-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
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

.guru-table{
    width:100%;
    border-collapse:collapse;
}

.guru-table thead{
    background:var(--navy);
}

.guru-table th{
    padding:.85rem 1rem;
    text-align:center;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:rgba(255,255,255,.9);
    white-space:nowrap;
}

.guru-table td{
    padding:.9rem 1rem;
    border-bottom:1px solid var(--border);
    font-size:13px;
    color:var(--text);
    vertical-align:middle;
}

.guru-table tbody tr:hover{
    background:#f8fbff;
}

/* ───────── GURU CELL ───────── */
.guru-cell{
    display:flex;
    align-items:center;
    gap:10px;
}

.avatar{
    width:36px;
    height:36px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:12px;
    font-weight:700;
    color:#fff;
    flex-shrink:0;
}

.av-0{
    background:linear-gradient(135deg,#1e3a8a,#2563eb);
}

.av-1{
    background:linear-gradient(135deg,#059669,#10b981);
}

.av-2{
    background:linear-gradient(135deg,#7e22ce,#a855f7);
}

.av-3{
    background:linear-gradient(135deg,#d97706,#f59e0b);
}

.td-name{
    font-weight:600;
    margin-bottom:2px;
}

.td-email{
    font-size:12px;
    color:var(--muted);
}

.td-nuptk{
    color:var(--muted);
    font-size:12px;
}

/* ───────── BADGE ───────── */
.badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:5px 11px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
}

.badge-jabatan{
    background:var(--navy-lt);
    color:var(--navy-md);
}

.badge-nuptk{
    background:var(--green-lt);
    color:var(--green);
}

.badge-no{
    background:var(--amber-lt);
    color:var(--amber);
}

.badge-active{
    background:var(--purple-lt);
    color:var(--purple);
}

.badge-belum{
    background:#f1f5f9;
    color:#64748b;
}

/* ───────── ACTION ───────── */
.action-cell{
    display:flex;
    align-items:center;
    justify-content:flex-end;
    gap:8px;
}

.btn-action{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-height:34px;
    padding:6px 12px;
    border-radius:8px;
    border:1px solid var(--border);
    background:#fff;
    font-size:12px;
    font-weight:600;
    text-decoration:none;
    transition:.15s;
}

.btn-view{
    color:var(--amber);
    background:var(--amber-lt);
    border-color:var(--amber-bd);
}

.btn-edit{
    color:var(--navy-md);
    background:var(--navy-lt);
    border-color:#93c5fd;
}

.btn-action:hover{
    transform:translateY(-1px);
    text-decoration:none;
}

/* ───────── EMPTY ───────── */
.empty-state{
    padding:4rem 1.5rem;
    text-align:center;
}

.empty-icon{
    width:54px;
    height:54px;
    border-radius:14px;
    background:#f1f5f9;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 1rem;
    font-size:22px;
}

.empty-title{
    font-size:15px;
    font-weight:700;
    color:var(--text);
    margin-bottom:4px;
}

.empty-desc{
    font-size:13px;
    color:var(--muted);
}

/* ───────── RESPONSIVE ───────── */
@media(max-width:1000px){

    .breakdown-grid{
        grid-template-columns:repeat(2,1fr);
    }

}

@media(max-width:900px){

    .guru-page{
        padding:1rem;
    }

    .stats-grid{
        grid-template-columns:1fr;
    }

    .top-bar{
        flex-direction:column;
        align-items:stretch;
    }

}

@media(max-width:640px){

    .breakdown-grid{
        grid-template-columns:1fr;
    }

}
</style>

@php
    $totalGuru  = $gurus->count();
    $punyaNuptk = $gurus->whereNotNull('nuptk')->count();
    $punyaAkun  = $gurus->whereNotNull('user_id')->count();
    $pctNuptk   = $totalGuru > 0 ? round(($punyaNuptk / $totalGuru) * 100) : 0;
    $pctAkun    = $totalGuru > 0 ? round(($punyaAkun  / $totalGuru) * 100) : 0;
    $lakiLaki   = $gurus->where('jenis_kelamin', 'L')->count();
    $perempuan  = $gurus->where('jenis_kelamin', 'P')->count();
    $tidakNuptk = $totalGuru - $punyaNuptk;
    $tidakAkun  = $totalGuru - $punyaAkun;
@endphp

<div class="guru-page">

    {{-- TOPBAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                👨‍🏫
            </div>

            <div class="title-text">
                <h1>Manajemen Data Guru</h1>

                <p>
                    Informasi lengkap seluruh tenaga pendidik yang terdaftar dalam sistem akademik sekolah.
                </p>
            </div>

        </div>

    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-header">
                <span class="stat-label">Total Guru</span>

                <div class="stat-icon icon-blue">
                    👥
                </div>
            </div>

            <div class="stat-value">
                {{ $totalGuru }}
            </div>

            <div class="stat-sub">
                Seluruh tenaga pendidik aktif
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">
                <span class="stat-label">Memiliki NUPTK</span>

                <div class="stat-icon icon-green">
                    🛡️
                </div>
            </div>

            <div class="stat-value">
                {{ $punyaNuptk }}
            </div>

            <div class="stat-sub">
                {{ $pctNuptk }}% dari total guru
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">
                <span class="stat-label">Memiliki Akun</span>

                <div class="stat-icon icon-purple">
                    🔐
                </div>
            </div>

            <div class="stat-value">
                {{ $punyaAkun }}
            </div>

            <div class="stat-sub">
                {{ $pctAkun }}% dapat akses sistem
            </div>

        </div>

    </div>

    {{-- BREAKDOWN --}}
    <div class="breakdown-grid">

        <div class="break-card break-cyan">

            <div class="break-icon">
                👨
            </div>

            <div>
                <div class="break-value">
                    {{ $lakiLaki }}
                </div>

                <div class="break-label">
                    Guru Laki-laki
                </div>
            </div>

        </div>

        <div class="break-card break-pink">

            <div class="break-icon">
                👩
            </div>

            <div>
                <div class="break-value">
                    {{ $perempuan }}
                </div>

                <div class="break-label">
                    Guru Perempuan
                </div>
            </div>

        </div>

        <div class="break-card break-amber">

            <div class="break-icon">
                ⚠️
            </div>

            <div>
                <div class="break-value">
                    {{ $tidakNuptk }}
                </div>

                <div class="break-label">
                    Belum Punya NUPTK
                </div>
            </div>

        </div>

        <div class="break-card break-red">

            <div class="break-icon">
                🔒
            </div>

            <div>
                <div class="break-value">
                    {{ $tidakAkun }}
                </div>

                <div class="break-label">
                    Belum Punya Akun
                </div>
            </div>

        </div>

    </div>

    {{-- INFO --}}
    @if($tidakNuptk > 0 || $tidakAkun > 0)

    <div class="info-banner">

        <div class="banner-icon">
            ℹ️
        </div>

        <div>

            <div class="banner-title">
                Informasi Kelengkapan Data
            </div>

            <div class="banner-desc">
                Terdapat
                <strong>{{ $tidakNuptk }} guru</strong>
                belum memiliki NUPTK dan
                <strong>{{ $tidakAkun }} guru</strong>
                belum mempunyai akun login sistem akademik.
            </div>

        </div>

    </div>

    @endif

    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">

            <div class="table-title">
                Daftar Guru
            </div>

            <div class="table-meta">
                Total {{ $totalGuru }} data guru
            </div>

        </div>

        <div class="table-wrap">

            @if($totalGuru > 0)

            <table class="guru-table">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Guru</th>
                        <th>NUPTK</th>
                        <th>Jabatan</th>
                        <th>Status Akun</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($gurus as $index => $guru)

                    @php
                        $avClass = 'av-' . ($index % 4);
                    @endphp

                    <tr>

                        <td style="text-align:center;">
                            {{ str_pad($index + 1,2,'0',STR_PAD_LEFT) }}
                        </td>

                        <td>

                            <div class="guru-cell">

                                <div class="avatar {{ $avClass }}">
                                    {{ strtoupper(substr($guru->nama, 0, 1)) }}
                                </div>

                                <div>

                                    <div class="td-name">
                                        {{ $guru->nama }}
                                    </div>

                                    @if($guru->user->email ?? null)

                                    <div class="td-email">
                                        {{ $guru->user->email }}
                                    </div>

                                    @endif

                                </div>

                            </div>

                        </td>

                        <td>

                            @if($guru->nuptk)

                            <span class="badge badge-nuptk">
                                {{ $guru->nuptk }}
                            </span>

                            @else

                            <span class="badge badge-no">
                                Belum Ada
                            </span>

                            @endif

                        </td>

                        <td>

                            @if($guru->jabatan)

                            <span class="badge badge-jabatan">
                                {{ $guru->jabatan }}
                            </span>

                            @else

                            <span style="color:#94a3b8;">
                                —
                            </span>

                            @endif

                        </td>

                        <td>

                            @if($guru->user_id)

                            <span class="badge badge-active">
                                Aktif
                            </span>

                            @else

                            <span class="badge badge-belum">
                                Belum
                            </span>

                            @endif

                        </td>

                        <td>

                            <div class="action-cell">

                                <a href="{{ route('admin.guru.show', $guru->id) }}"
                                   class="btn-action btn-view">

                                    Lihat

                                </a>

                                <a href="{{ route('admin.guru.edit', $guru->id) }}"
                                   class="btn-action btn-edit">

                                    Edit

                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            @else

            <div class="empty-state">

                <div class="empty-icon">
                    👨‍🏫
                </div>

                <div class="empty-title">
                    Belum Ada Data Guru
                </div>

                <div class="empty-desc">
                    Data guru yang ditambahkan akan tampil di sini.
                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection