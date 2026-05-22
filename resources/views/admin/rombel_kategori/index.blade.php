@extends('layouts.admin')

@section('title', 'Kategori Rombel')
@section('header', 'Kategori Rombel')

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

    --red:#dc2626;
    --red-lt:#fff1f2;

    --gray-bg:#f8fafc;
    --border:#e2e8f0;

    --text:#1e293b;
    --muted:#64748b;
    --hint:#94a3b8;

    --radius:14px;

    --shadow:
        0 1px 3px rgba(0,0,0,.06),
        0 4px 12px rgba(0,0,0,.04);
}

body{
    font-family:'IBM Plex Sans',sans-serif;
}

.rombel-page{
    min-height:100vh;
    background:var(--gray-bg);
    padding:2rem;
    padding-bottom:4rem;
    color:var(--text);
}

/* ───────── BREADCRUMB ───────── */
.breadcrumb{
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom:1.25rem;
    font-size:12px;
    color:var(--muted);
}

.breadcrumb a{
    color:var(--muted);
    text-decoration:none;
    transition:.15s;
}

.breadcrumb a:hover{
    color:var(--navy-md);
}

.breadcrumb-sep{
    color:var(--hint);
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
    width:46px;
    height:46px;
    border-radius:12px;
    background:var(--navy-lt);
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    font-size:20px;
}

.title-text h1{
    font-size:22px;
    font-weight:700;
    letter-spacing:-.03em;
    color:var(--text);
    margin-bottom:4px;
}

.title-text p{
    font-size:13px;
    color:var(--muted);
    line-height:1.6;
}

.count-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:.7rem 1rem;
    border-radius:999px;
    background:var(--navy-lt);
    color:var(--navy-md);
    font-size:13px;
    font-weight:700;
    border:1px solid #bfdbfe;
    box-shadow:var(--shadow);
}

/* ───────── SECTION ───────── */
.section-title{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:12px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.08em;
    color:var(--muted);
    margin-bottom:1rem;
}

.section-title::after{
    content:'';
    flex:1;
    height:1px;
    background:var(--border);
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
    padding:1.2rem;
    display:flex;
    align-items:center;
    gap:1rem;
    box-shadow:var(--shadow);
    position:relative;
    overflow:hidden;
}

.stat-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:4px;
}

.stat-card.purple::before{
    background:linear-gradient(90deg,#7e22ce,#c084fc);
}

.stat-card.blue::before{
    background:linear-gradient(90deg,#2563eb,#60a5fa);
}

.stat-card.gray::before{
    background:linear-gradient(90deg,#64748b,#cbd5e1);
}

.stat-icon{
    width:48px;
    height:48px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    flex-shrink:0;
}

.stat-icon.purple{
    background:var(--purple-lt);
    color:var(--purple);
}

.stat-icon.blue{
    background:#eff6ff;
    color:#2563eb;
}

.stat-icon.gray{
    background:#f1f5f9;
    color:#64748b;
}

.stat-value{
    font-size:30px;
    font-weight:700;
    letter-spacing:-.04em;
    line-height:1;
    margin-bottom:4px;
}

.stat-label{
    font-size:12px;
    color:var(--muted);
    font-weight:600;
}

/* ───────── SPLIT GRID ───────── */
.split-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
    margin-bottom:1.5rem;
}

.split-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:16px;
    overflow:hidden;
    box-shadow:var(--shadow);
}

.split-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:1rem 1.2rem;
    border-bottom:1px solid var(--border);
}

.split-left{
    display:flex;
    align-items:center;
    gap:10px;
}

.split-icon{
    width:36px;
    height:36px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
}

.split-purple .split-icon{
    background:var(--purple-lt);
    color:var(--purple);
}

.split-blue .split-icon{
    background:#eff6ff;
    color:#2563eb;
}

.split-title{
    font-size:15px;
    font-weight:700;
}

.split-badge{
    padding:5px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
}

.split-purple .split-badge{
    background:var(--purple-lt);
    color:var(--purple);
}

.split-blue .split-badge{
    background:#eff6ff;
    color:#2563eb;
}

/* ───────── TINGKAT ───────── */
.tingkat-group{
    border-bottom:1px solid var(--border);
}

.tingkat-group:last-child{
    border-bottom:none;
}

.tingkat-label{
    padding:.7rem 1.2rem;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.08em;
}

.tingkat-purple{
    background:#faf5ff;
    color:var(--purple);
}

.tingkat-blue{
    background:#f8fbff;
    color:#2563eb;
}

/* ───────── ROMBEL ITEM ───────── */
.rombel-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:.9rem 1.2rem;
    border-bottom:1px solid #f1f5f9;
    transition:.15s;
}

.rombel-item:last-child{
    border-bottom:none;
}

.rombel-item:hover{
    background:#f8fbff;
}

.rombel-left{
    display:flex;
    align-items:center;
    gap:12px;
    min-width:0;
}

.rombel-icon{
    width:38px;
    height:38px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
    flex-shrink:0;
}

.rombel-icon.purple{
    background:var(--purple-lt);
    color:var(--purple);
}

.rombel-icon.blue{
    background:#eff6ff;
    color:#2563eb;
}

.rombel-name{
    font-size:14px;
    font-weight:600;
    color:var(--text);
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

/* ───────── BUTTON ───────── */
.btn-view{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:.55rem .9rem;
    border-radius:10px;
    text-decoration:none;
    font-size:12px;
    font-weight:700;
    transition:.15s;
    flex-shrink:0;
}

.btn-view-purple{
    background:var(--purple-lt);
    color:var(--purple);
    border:1px solid #ddd6fe;
}

.btn-view-blue{
    background:#eff6ff;
    color:#2563eb;
    border:1px solid #bfdbfe;
}

.btn-view:hover{
    transform:translateY(-1px);
    text-decoration:none;
}

/* ───────── EMPTY ───────── */
.empty-state{
    padding:3rem 1.5rem;
    text-align:center;
}

.empty-icon{
    width:60px;
    height:60px;
    border-radius:16px;
    background:#f1f5f9;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 1rem;
    font-size:26px;
}

.empty-title{
    font-size:15px;
    font-weight:700;
    margin-bottom:4px;
    color:var(--text);
}

.empty-desc{
    font-size:13px;
    color:var(--muted);
}

/* ───────── INFO ───────── */
.info-card{
    display:flex;
    align-items:flex-start;
    gap:12px;
    padding:1.1rem 1.2rem;
    background:#eff6ff;
    border:1px solid #bfdbfe;
    border-radius:14px;
}

.info-icon{
    width:42px;
    height:42px;
    border-radius:10px;
    background:var(--navy);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    font-size:18px;
}

.info-title{
    font-size:14px;
    font-weight:700;
    margin-bottom:5px;
    color:var(--text);
}

.info-text{
    font-size:13px;
    color:var(--muted);
    line-height:1.7;
}

/* ───────── RESPONSIVE ───────── */
@media(max-width:900px){

    .rombel-page{
        padding:1rem;
    }

    .stats-grid{
        grid-template-columns:1fr;
    }

    .split-grid{
        grid-template-columns:1fr;
    }

    .top-bar{
        flex-direction:column;
        align-items:stretch;
    }

}

</style>

@php
    $pondokCount  = $rombels->filter(fn($r) => ($r->kategori->kategori ?? null) == 'pondok')->count();

    $regulerCount = $rombels->filter(fn($r) => ($r->kategori->kategori ?? null) == 'reguler')->count();

    $lainnyaCount = $rombels->count() - $pondokCount - $regulerCount;

    $pondokRombels = $rombels
        ->filter(fn($r) => ($r->kategori->kategori ?? null) == 'pondok')
        ->sortBy('tingkat');

    $regulerRombels = $rombels
        ->filter(fn($r) => ($r->kategori->kategori ?? null) == 'reguler')
        ->sortBy('tingkat');

    $pondokByTingkat  = $pondokRombels->groupBy('tingkat');

    $regulerByTingkat = $regulerRombels->groupBy('tingkat');
@endphp

<div class="rombel-page">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb">

        <a href="{{ route('admin.dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-sep">
            /
        </span>

        <span>
            Kategori Rombel
        </span>

    </div>

    {{-- TOPBAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                🏫
            </div>

            <div class="title-text">

                <h1>Kategori Rombel</h1>

                <p>
                    Daftar rombongan belajar berdasarkan kategori pondok dan reguler.
                </p>

            </div>

        </div>

        <div class="count-badge">

            👥 {{ $rombels->count() }} Rombel

        </div>

    </div>

    {{-- STATS --}}
    <div class="section-title">
        Ringkasan Kategori
    </div>

    <div class="stats-grid">

        <div class="stat-card purple">

            <div class="stat-icon purple">
                🕌
            </div>

            <div>

                <div class="stat-value"
                     style="color:var(--purple);">

                    {{ $pondokCount }}

                </div>

                <div class="stat-label">
                    Pondok
                </div>

            </div>

        </div>

        <div class="stat-card blue">

            <div class="stat-icon blue">
                🎓
            </div>

            <div>

                <div class="stat-value"
                     style="color:#2563eb;">

                    {{ $regulerCount }}

                </div>

                <div class="stat-label">
                    Reguler
                </div>

            </div>

        </div>

        <div class="stat-card gray">

            <div class="stat-icon gray">
                ❔
            </div>

            <div>

                <div class="stat-value"
                     style="color:#64748b;">

                    {{ $lainnyaCount }}

                </div>

                <div class="stat-label">
                    Belum Ditetapkan
                </div>

            </div>

        </div>

    </div>

    {{-- SPLIT --}}
    <div class="section-title">
        Daftar Rombel
    </div>

    <div class="split-grid">

        {{-- PONDOK --}}
        <div class="split-card split-purple">

            <div class="split-header">

                <div class="split-left">

                    <div class="split-icon">
                        🕌
                    </div>

                    <div class="split-title">
                        Pondok
                    </div>

                </div>

                <div class="split-badge">
                    {{ $pondokRombels->count() }}
                </div>

            </div>

            @if($pondokByTingkat->isEmpty())

            <div class="empty-state">

                <div class="empty-icon">
                    🏫
                </div>

                <div class="empty-title">
                    Belum Ada Rombel Pondok
                </div>

                <div class="empty-desc">
                    Data rombel pondok belum tersedia.
                </div>

            </div>

            @else

                @foreach($pondokByTingkat as $tingkat => $items)

                <div class="tingkat-group">

                    <div class="tingkat-label tingkat-purple">

                        Tingkat {{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}

                    </div>

                    @foreach($items as $rombel)

                    <div class="rombel-item">

                        <div class="rombel-left">

                            <div class="rombel-icon purple">
                                🏫
                            </div>

                            <div class="rombel-name">

                                {{ $rombel->nama_lengkap ?? $rombel->nama_rombel }}

                            </div>

                        </div>

                        <a href="{{ route('admin.rombel-kategori.show', $rombel?->id) }}"
                           class="btn-view btn-view-purple">

                            Lihat

                        </a>

                    </div>

                    @endforeach

                </div>

                @endforeach

            @endif

        </div>

        {{-- REGULER --}}
        <div class="split-card split-blue">

            <div class="split-header">

                <div class="split-left">

                    <div class="split-icon">
                        🎓
                    </div>

                    <div class="split-title">
                        Reguler
                    </div>

                </div>

                <div class="split-badge">
                    {{ $regulerRombels->count() }}
                </div>

            </div>

            @if($regulerByTingkat->isEmpty())

            <div class="empty-state">

                <div class="empty-icon">
                    🏫
                </div>

                <div class="empty-title">
                    Belum Ada Rombel Reguler
                </div>

                <div class="empty-desc">
                    Data rombel reguler belum tersedia.
                </div>

            </div>

            @else

                @foreach($regulerByTingkat as $tingkat => $items)

                <div class="tingkat-group">

                    <div class="tingkat-label tingkat-blue">

                        Tingkat {{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}

                    </div>

                    @foreach($items as $rombel)

                    <div class="rombel-item">

                        <div class="rombel-left">

                            <div class="rombel-icon blue">
                                🏫
                            </div>

                            <div class="rombel-name">

                                {{ $rombel->nama_lengkap ?? $rombel->nama_rombel }}

                            </div>

                        </div>

                        <a href="{{ route('admin.rombel-kategori.show', $rombel?->id) }}"
                           class="btn-view btn-view-blue">

                            Lihat

                        </a>

                    </div>

                    @endforeach

                </div>

                @endforeach

            @endif

        </div>

    </div>

    {{-- INFO --}}
    <div class="info-card">

        <div class="info-icon">
            ℹ️
        </div>

        <div>

            <div class="info-title">
                Informasi Kategori
            </div>

            <div class="info-text">
                Halaman ini menampilkan daftar rombongan belajar berdasarkan kategori.
                Klik tombol <strong>Lihat</strong> untuk melihat detail siswa
                pada masing-masing rombel.
            </div>

        </div>

    </div>

</div>

@endsection