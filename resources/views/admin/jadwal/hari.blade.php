@extends('layouts.admin')

@section('title', 'Pengaturan Jadwal Guru')
@section('header', 'Pengaturan Jadwal Guru')

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

    --amber:#d97706;
    --amber-lt:#fffbeb;

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

.jadwal-page{
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

.top-actions{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;
}

.search-box{
    display:flex;
    align-items:center;
    gap:8px;
    background:#fff;
    border:1px solid var(--border);
    border-radius:10px;
    padding:.65rem .85rem;
    width:250px;
    transition:.15s;
    box-shadow:var(--shadow);
}

.search-box:focus-within{
    border-color:var(--navy-md);
    box-shadow:0 0 0 3px rgba(29,78,216,.08);
}

.search-box svg{
    width:14px;
    height:14px;
    color:var(--hint);
    flex-shrink:0;
}

.search-box input{
    border:none;
    outline:none;
    background:transparent;
    width:100%;
    font-size:13px;
    color:var(--text);
    font-family:'IBM Plex Sans',sans-serif;
}

.search-box input::placeholder{
    color:var(--hint);
}

.btn-primary{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:7px;
    padding:.7rem 1rem;
    border:none;
    border-radius:10px;
    background:var(--navy);
    color:#fff;
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    transition:.15s;
    white-space:nowrap;
}

.btn-primary:hover{
    background:var(--navy-md);
    color:#fff;
    text-decoration:none;
}

/* ───────── STATS ───────── */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:14px;
    margin-bottom:1.75rem;
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

/* ───────── GRID ───────── */
.content-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:20px;
}

/* ───────── CARD ───────── */
.card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
}

.card-header{
    padding:1rem 1.25rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
}

.card-title{
    font-size:15px;
    font-weight:700;
    color:var(--text);
    margin-bottom:4px;
}

.card-subtitle{
    font-size:12px;
    color:var(--muted);
}

/* ───────── LIST HARI ───────── */
.hari-list{
    display:flex;
    flex-direction:column;
}

.hari-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:1rem 1.25rem;
    text-decoration:none;
    border-bottom:1px solid var(--border);
    transition:.15s;
}

.hari-item:last-child{
    border-bottom:none;
}

.hari-item:hover{
    background:#f8fbff;
    text-decoration:none;
}

.hari-left{
    display:flex;
    align-items:center;
    gap:12px;
}

.hari-icon{
    width:42px;
    height:42px;
    border-radius:10px;
    background:var(--navy-lt);
    color:var(--navy-md);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:15px;
    font-weight:700;
    flex-shrink:0;
}

.hari-name{
    font-size:14px;
    font-weight:600;
    color:var(--text);
    margin-bottom:3px;
}

.hari-count{
    font-size:12px;
    color:var(--muted);
}

.hari-arrow{
    color:var(--hint);
    font-size:18px;
    transition:.15s;
}

.hari-item:hover .hari-arrow{
    transform:translateX(3px);
}

/* ───────── SIDEBAR ───────── */
.sidebar{
    display:flex;
    flex-direction:column;
    gap:16px;
}

.info-box{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1rem 1.1rem;
    box-shadow:var(--shadow);
}

.info-title{
    font-size:14px;
    font-weight:700;
    color:var(--text);
    margin-bottom:8px;
}

.info-desc{
    font-size:13px;
    line-height:1.7;
    color:var(--muted);
}

.tip-list{
    display:flex;
    flex-direction:column;
    gap:10px;
    margin-top:6px;
}

.tip-item{
    display:flex;
    align-items:flex-start;
    gap:8px;
    font-size:13px;
    color:var(--muted);
    line-height:1.6;
}

.tip-dot{
    width:8px;
    height:8px;
    border-radius:50%;
    background:var(--navy-md);
    margin-top:6px;
    flex-shrink:0;
}

/* ───────── RESPONSIVE ───────── */
@media(max-width:1000px){

    .content-grid{
        grid-template-columns:1fr;
    }

}

@media(max-width:900px){

    .jadwal-page{
        padding:1rem;
    }

    .stats-grid{
        grid-template-columns:1fr;
    }

    .top-bar{
        flex-direction:column;
        align-items:stretch;
    }

    .top-actions{
        width:100%;
    }

    .search-box{
        width:100%;
    }

}
</style>

@php
    $totalHari = count($hari);
    $totalTerjadwal = collect($hari)->sum('jadwal_guru_count');
@endphp

<div class="jadwal-page">

    {{-- TOPBAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                📅
            </div>

            <div class="title-text">

                <h1>Pengaturan Jadwal Guru</h1>

                <p>
                    Kelola dan distribusikan jadwal mengajar guru agar lebih terstruktur,
                    seimbang, dan efisien dalam sistem akademik sekolah.
                </p>

            </div>

        </div>

        <div class="top-actions">

            {{-- SEARCH --}}
            <div class="search-box">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2">

                    <circle cx="11"
                            cy="11"
                            r="8"/>

                    <path d="M21 21l-4.35-4.35"/>

                </svg>

                <input type="text"
                       placeholder="Cari hari...">

            </div>

            {{-- BUTTON --}}
            <a href="#"
               class="btn-primary">

                + Tambah Jadwal

            </a>

        </div>

    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Total Hari
                </span>

                <div class="stat-icon icon-blue">
                    📅
                </div>

            </div>

            <div class="stat-value">
                {{ $totalHari }}
            </div>

            <div class="stat-sub">
                Hari aktif pembelajaran
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Total Jadwal
                </span>

                <div class="stat-icon icon-green">
                    👨‍🏫
                </div>

            </div>

            <div class="stat-value">
                {{ $totalTerjadwal }}
            </div>

            <div class="stat-sub">
                Distribusi jadwal guru
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Rata-rata / Hari
                </span>

                <div class="stat-icon icon-purple">
                    📊
                </div>

            </div>

            <div class="stat-value">
                {{ $totalHari > 0 ? round($totalTerjadwal / $totalHari,1) : 0 }}
            </div>

            <div class="stat-sub">
                Beban mengajar per hari
            </div>

        </div>

    </div>

    {{-- CONTENT --}}
    <div class="content-grid">

        {{-- LIST HARI --}}
        <div class="card">

            <div class="card-header">

                <div class="card-title">
                    Daftar Hari
                </div>

                <div class="card-subtitle">
                    Klik salah satu hari untuk mengatur jadwal guru
                </div>

            </div>

            <div class="hari-list">

                @foreach ($hari as $h)

                <a href="{{ route('admin.jadwal.show', $h->id) }}"
                   class="hari-item">

                    <div class="hari-left">

                        <div class="hari-icon">
                            {{ substr($h->nama_hari, 0, 1) }}
                        </div>

                        <div>

                            <div class="hari-name">
                                {{ $h->nama_hari }}
                            </div>

                            <div class="hari-count">
                                {{ $h->jadwal_guru_count }} guru terjadwal
                            </div>

                        </div>

                    </div>

                    <div class="hari-arrow">
                        →
                    </div>

                </a>

                @endforeach

            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="sidebar">

            <div class="info-box">

                <div class="info-title">
                    Informasi Sistem
                </div>

                <div class="info-desc">
                    Setiap hari berisi daftar jadwal mengajar guru.
                    Pengaturan yang baik membantu distribusi jam
                    mengajar menjadi lebih efektif dan terorganisir.
                </div>

            </div>

            <div class="info-box">

                <div class="info-title">
                    Tips Pengelolaan
                </div>

                <div class="tip-list">

                    <div class="tip-item">
                        <span class="tip-dot"></span>
                        Hindari bentrok jadwal antar guru
                    </div>

                    <div class="tip-item">
                        <span class="tip-dot"></span>
                        Distribusikan jam mengajar secara merata
                    </div>

                    <div class="tip-item">
                        <span class="tip-dot"></span>
                        Prioritaskan mata pelajaran utama
                    </div>

                    <div class="tip-item">
                        <span class="tip-dot"></span>
                        Pastikan beban kerja guru tetap seimbang
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection