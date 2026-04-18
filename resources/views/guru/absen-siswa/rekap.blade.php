@extends('layouts.guru')

@section('title', 'Rekap Absensi Siswa')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');

:root {
    --navy: #020659;
    --navy-light: #1a237e;
    --gray-50: #F8FAFC;
    --gray-100: #F1F5F9;
    --gray-200: #E2E8F0;
    --gray-400: #94A3B8;
    --gray-500: #64748B;
    --gray-700: #334155;
    --gray-800: #1E293B;
    --gray-900: #0F172A;
    --green: #059669;
    --green-light: #ECFDF5;
    --blue: #2563EB;
    --blue-light: #EFF6FF;
    --yellow: #D97706;
    --yellow-light: #FFFBEB;
    --red: #DC2626;
    --red-light: #FEF2F2;
    --purple: #7C3AED;
    --purple-light: #F5F3FF;
    --slate: #475569;
    --slate-light: #F1F5F9;
    --radius-sm: 10px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04);
    --shadow-lg: 0 10px 30px rgba(0,0,0,0.08);
}

* { box-sizing: border-box; }
body { margin: 0; padding: 0; font-family: 'Nunito', sans-serif; background: var(--gray-50); }

@keyframes slideUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ======================================================
   MOBILE FIRST
   ====================================================== */

.page-wrap {
    padding: 0;
    max-width: 100%;
    padding-bottom: 40px;
}

/* ---- HERO ---- */
.hero-card {
    background: linear-gradient(135deg, var(--navy) 0%, #1a237e 60%, #283593 100%);
    padding: 20px 16px 28px;
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-card::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}

.hero-card::after {
    content: '';
    position: absolute;
    bottom: -30px; left: -20px;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
}

.hero-sub   { font-size: 11px; opacity: 0.7; position: relative; z-index: 1; }
.hero-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 20px; font-weight: 800;
    margin: 2px 0 4px; position: relative; z-index: 1;
}
.hero-desc  { font-size: 12px; opacity: 0.8; position: relative; z-index: 1; margin-bottom: 14px; }

.hero-date-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.13);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 99px; padding: 5px 12px;
    font-size: 11px; font-weight: 700; color: white;
    position: relative; z-index: 1;
    backdrop-filter: blur(4px);
}

/* ---- BODY ---- */
.page-body {
    padding: 14px 12px;
    display: flex; flex-direction: column; gap: 12px;
}

/* ---- SECTION TITLE ---- */
.section-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700;
    color: var(--gray-700);
    margin: 0 0 10px 2px;
    display: flex; align-items: center; gap: 6px;
}

/* ---- FILTER CARD ---- */
.filter-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 14px;
    box-shadow: var(--shadow-sm);
    animation: slideUp 0.35s ease both;
}

.filter-title {
    font-size: 11px; font-weight: 700;
    color: var(--gray-500); text-transform: uppercase;
    letter-spacing: 0.5px; margin-bottom: 10px;
    display: flex; align-items: center; gap: 6px;
}

.filter-grid {
    display: flex; flex-direction: column; gap: 10px;
}

.form-label {
    display: block;
    font-size: 11px; font-weight: 700;
    color: var(--gray-700); text-transform: uppercase;
    letter-spacing: 0.3px; margin-bottom: 5px;
}

.form-label-ghost { display: none; } /* hidden on mobile */

.select-wrap { position: relative; }

.form-control {
    width: 100%;
    padding: 10px 36px 10px 12px;
    font-size: 13px; font-family: 'Nunito', sans-serif;
    color: var(--gray-800); background: var(--gray-50);
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-sm);
    appearance: none; outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
}

.form-control:focus {
    border-color: var(--navy); background: white;
    box-shadow: 0 0 0 3px rgba(2,6,89,0.08);
}

.select-arrow {
    pointer-events: none;
    position: absolute; right: 12px; top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
}

.select-arrow svg { width: 14px; height: 14px; }

.btn-filter {
    display: inline-flex; align-items: center; justify-content: center; gap: 7px;
    width: 100%; padding: 11px 16px;
    background: linear-gradient(135deg, var(--navy), #1a237e);
    color: white; border: none; border-radius: var(--radius-sm);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700;
    cursor: pointer; transition: opacity 0.15s, transform 0.15s;
    box-shadow: 0 3px 10px rgba(2,6,89,0.25);
}
.btn-filter:hover  { opacity: 0.9; }
.btn-filter:active { transform: scale(0.97); }
.btn-filter svg    { width: 14px; height: 14px; }

/* ---- CETAK BUTTON ---- */
.cetak-wrap { display: flex; justify-content: flex-end; }

.btn-cetak {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--red); color: white;
    padding: 9px 16px; border-radius: var(--radius-sm);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px; font-weight: 700;
    text-decoration: none;
    box-shadow: 0 3px 10px rgba(220,38,38,0.25);
    transition: opacity 0.15s, transform 0.15s;
}
.btn-cetak:hover  { opacity: 0.9; color: white; text-decoration: none; }
.btn-cetak:active { transform: scale(0.97); }
.btn-cetak svg    { width: 13px; height: 13px; }

/* ---- SUMMARY GRID ---- */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}

.summary-card {
    background: white;
    border-radius: var(--radius-sm);
    padding: 12px 10px 10px;
    border-left: 3px solid;
    box-shadow: var(--shadow-sm);
}

.summary-label {
    font-size: 10px; font-weight: 700; color: var(--gray-500);
    text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px;
}

.summary-val {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 22px; font-weight: 800;
}

.sc-gray   { border-color: var(--gray-400); } .sc-gray   .summary-val { color: var(--gray-700); }
.sc-green  { border-color: var(--green); }    .sc-green  .summary-val { color: var(--green); }
.sc-blue   { border-color: var(--blue); }     .sc-blue   .summary-val { color: var(--blue); }
.sc-yellow { border-color: var(--yellow); }   .sc-yellow .summary-val { color: var(--yellow); }
.sc-red    { border-color: var(--red); }      .sc-red    .summary-val { color: var(--red); }
.sc-purple { border-color: var(--purple); }   .sc-purple .summary-val { color: var(--purple); }

/* ---- INFO BANNER ---- */
.info-banner {
    background: #EEF2FF;
    border: 1.5px solid #C7D2FE;
    border-radius: var(--radius-md);
    padding: 12px 14px;
    display: flex; align-items: flex-start; gap: 10px;
    font-size: 12px; color: #3730A3; line-height: 1.55;
}

/* ---- STUDENT CARDS (mobile) ---- */
.student-list { display: flex; flex-direction: column; gap: 10px; }

.student-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 14px;
    box-shadow: var(--shadow-sm);
    text-decoration: none; color: inherit;
    display: block;
    transition: transform 0.18s, box-shadow 0.18s, border-color 0.18s;
    -webkit-tap-highlight-color: transparent;
    animation: slideUp 0.4s ease both;
}

.student-card:nth-child(1)  { animation-delay: 0.03s; }
.student-card:nth-child(2)  { animation-delay: 0.06s; }
.student-card:nth-child(3)  { animation-delay: 0.09s; }
.student-card:nth-child(4)  { animation-delay: 0.12s; }
.student-card:nth-child(n+5){ animation-delay: 0.15s; }
.student-card:active { transform: scale(0.97); }

.student-header {
    display: flex; align-items: center; gap: 10px;
    padding-bottom: 12px; margin-bottom: 12px;
    border-bottom: 1px solid var(--gray-100);
}

.student-avatar {
    width: 36px; height: 36px;
    background: #EEF2FF;
    border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

.student-avatar svg { width: 18px; height: 18px; color: var(--navy); }

.student-num  { font-size: 10px; font-weight: 600; color: var(--gray-400); margin-bottom: 2px; }
.student-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 700; color: var(--gray-900);
}

.student-arrow {
    margin-left: auto; flex-shrink: 0;
    width: 30px; height: 30px;
    background: var(--navy); border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(2,6,89,0.25);
}

.student-arrow svg { width: 14px; height: 14px; color: white; }

/* Status row inside student card */
.status-grid {
    display: grid; grid-template-columns: repeat(5, 1fr); gap: 6px;
}

.status-box { text-align: center; }

.status-box-inner {
    border-radius: 8px;
    aspect-ratio: 1;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 3px;
}

.status-box-inner span {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 800;
}

.status-box-label {
    font-size: 9px; font-weight: 700;
    color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.2px;
}

.sb-green  { background: var(--green-light); }  .sb-green  span { color: var(--green); }
.sb-blue   { background: var(--blue-light); }   .sb-blue   span { color: var(--blue); }
.sb-yellow { background: var(--yellow-light); } .sb-yellow span { color: var(--yellow); }
.sb-red    { background: var(--red-light); }    .sb-red    span { color: var(--red); }
.sb-purple { background: var(--purple-light); } .sb-purple span { color: var(--purple); }

/* ---- TABLE CARD (desktop) ---- */
.table-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.table-header {
    padding: 12px 16px;
    background: var(--gray-50);
    border-bottom: 1.5px solid var(--gray-100);
}

.table-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 800; color: var(--gray-900);
}

table { width: 100%; border-collapse: collapse; }

thead tr { background: linear-gradient(135deg, var(--navy), #1a237e); }

th {
    padding: 11px 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 10px; font-weight: 700;
    color: rgba(255,255,255,0.85);
    text-transform: uppercase; letter-spacing: 0.5px;
    text-align: center;
}

th.left { text-align: left; }

tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.15s; }
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: #EEF2FF; }

td { padding: 11px 12px; font-size: 13px; color: var(--gray-700); text-align: center; }
td.left { text-align: left; }

.td-num { font-size: 11px; font-weight: 600; color: var(--gray-400); }

.td-name-link {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700; color: var(--navy);
    text-decoration: none; transition: color 0.15s;
}
.td-name-link:hover { color: var(--navy-light); text-decoration: underline; }
.td-name-link svg   { width: 14px; height: 14px; color: var(--gray-400); flex-shrink: 0; }

.badge-box {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px; border-radius: var(--radius-sm);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 800;
}

.bb-green  { background: var(--green-light);  color: var(--green); }
.bb-blue   { background: var(--blue-light);   color: var(--blue); }
.bb-yellow { background: var(--yellow-light); color: var(--yellow); }
.bb-red    { background: var(--red-light);    color: var(--red); }
.bb-purple { background: var(--purple-light); color: var(--purple); }

/* ---- EMPTY STATE ---- */
.empty-state {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 48px 24px;
    text-align: center;
    box-shadow: var(--shadow-sm);
    animation: slideUp 0.35s ease both;
}

.empty-icon-wrap {
    width: 64px; height: 64px;
    background: #EEF2FF; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
}

.empty-icon-wrap svg { width: 30px; height: 30px; color: var(--navy); }

.empty-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 15px; font-weight: 800; color: var(--gray-800); margin-bottom: 6px;
}

.empty-desc  { font-size: 12px; color: var(--gray-500); line-height: 1.65; margin-bottom: 16px; }

.empty-tip {
    display: inline-flex; align-items: center; gap: 6px;
    background: #EEF2FF; color: var(--navy);
    border-radius: var(--radius-sm); padding: 7px 14px;
    font-size: 12px; font-weight: 700;
}

/* ---- MOBILE / DESKTOP TOGGLE ---- */
.mobile-only  { display: block; }
.desktop-only { display: none; }

/* ======================================================
   DESKTOP ≥768px
   ====================================================== */
@media (min-width: 768px) {

    .page-wrap { max-width: 1100px; margin: 0 auto; padding: 0 24px 48px; }

    /* Hero */
    .hero-card {
        border-radius: var(--radius-lg);
        margin: 24px 0 0; padding: 32px 40px;
        display: flex; align-items: center;
        justify-content: space-between; gap: 24px;
    }

    .hero-card::before { width: 260px; height: 260px; top: -80px; right: -60px; }
    .hero-sub    { font-size: 13px; }
    .hero-title  { font-size: 28px; }
    .hero-desc   { font-size: 14px; margin-bottom: 0; }

    .hero-date-chip {
        font-size: 13px; padding: 8px 16px;
        flex-shrink: 0; align-self: flex-end;
    }

    /* Body */
    .page-body { padding: 24px 0; gap: 16px; }

    .section-title { font-size: 15px; }

    /* Filter: horizontal row */
    .filter-card   { padding: 20px 24px; border-radius: var(--radius-lg); }
    .filter-title  { font-size: 12px; }
    .filter-grid   { flex-direction: row; align-items: flex-end; }
    .filter-grid > div { flex: 1; }
    .form-label-ghost { display: block; } /* show ghost label for button alignment */
    .btn-filter { width: auto; padding: 11px 20px; white-space: nowrap; }

    /* Summary: 6 cols */
    .summary-grid { grid-template-columns: repeat(6, 1fr); gap: 12px; }
    .summary-card { padding: 14px 12px; border-radius: var(--radius-md); }
    .summary-val  { font-size: 28px; }

    /* Info banner */
    .info-banner { padding: 14px 18px; font-size: 13px; border-radius: var(--radius-md); }

    /* Toggle */
    .mobile-only  { display: none; }
    .desktop-only { display: block; }

    /* Table */
    .table-card { border-radius: var(--radius-lg); }

    .table-header { padding: 16px 20px; }
    .table-header-title { font-size: 15px; }

    th { padding: 13px 16px; font-size: 11px; }
    td { padding: 12px 16px; }

    .td-name-link { font-size: 14px; }
    .badge-box    { width: 40px; height: 40px; font-size: 15px; }

    /* Cetak */
    .btn-cetak { font-size: 13px; padding: 10px 18px; }

    /* Student cards on desktop (not shown, but kept consistent) */
    .student-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: #A5B4FC;
    }

    /* Empty */
    .empty-state { border-radius: var(--radius-lg); padding: 60px 40px; }

    /* ================= STATS GRID ================= */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 14px;
    margin-top: 14px;
}

/* Card */
.stat-card {
    background: #fff;
    border-radius: 14px;
    padding: 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    border: 1.5px solid var(--gray-200);
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    transition: all 0.18s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}

/* Icon */
.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

/* Background Icon */
.bg-gray   { background: #f1f5f9; }
.bg-green  { background: #dcfce7; }
.bg-blue   { background: #dbeafe; }
.bg-yellow { background: #fef9c3; }
.bg-red    { background: #fee2e2; }

/* Value */
.stat-value {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--gray-900);
}

/* Label */
.stat-label {
    font-size: 12px;
    font-weight: 700;
    color: var(--gray-500);
    margin-top: 2px;
}

/* Sub text */
.stat-sub {
    font-size: 11px;
    color: var(--gray-400);
    margin-top: 4px;
}

/* Text Color */
.text-green  { color: #16a34a; }
.text-blue   { color: #2563eb; }
.text-yellow { color: #ca8a04; }
.text-red    { color: #dc2626; }
}

html { scroll-behavior: smooth; }
body { overscroll-behavior-y: none; }
a { -webkit-tap-highlight-color: transparent; }
</style>

<div class="page-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div>
            <div class="hero-sub">Dashboard Guru</div>
            <div class="hero-title">📊 Rekap Absensi Siswa</div>
            <div class="hero-desc">Monitor kehadiran siswa per kelas dan periode</div>
            <div class="hero-date-chip">📅 {{ now()->translatedFormat('d F Y') }}</div>
        </div>
    </div>

    <div class="page-body">

        {{-- ===== FILTER ===== --}}
        <div class="filter-card">
            <div class="filter-title">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filter Data
            </div>
            <form method="GET">
                <div class="filter-grid">

                    {{-- Rombel --}}
                    <div>
                        <label class="form-label">Pilih Kelas</label>
                        <div class="select-wrap">
                            <select name="rombel_id" class="form-control">
                                <option value="">-- Pilih Rombel --</option>
                                @foreach($rombels as $rombel)
                                    <option value="{{ $rombel->id }}" {{ request('rombel_id') == $rombel->id ? 'selected' : '' }}>
                                        {{ $rombel->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="select-arrow">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    {{-- Bulan --}}
                    <div>
                        <label class="form-label">Periode Bulan</label>
                        <input type="month" name="bulan" value="{{ request('bulan') }}"
                               class="form-control" required>
                    </div>

                    {{-- Submit --}}
                    <div>
                        <label class="form-label form-label-ghost" style="opacity:0;">-</label>
                        <button type="submit" class="btn-filter">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Tampilkan Data
                        </button>
                    </div>

                </div>
            </form>
        </div>


        @if(request('bulan') && $rekap->count())
{{-- ================== REKAP LOGIC ================== --}}
@php
    $col = collect($rekap);

    $totalSiswa = $col->count();

    $topHadir  = $col->sortByDesc('hadir')->first();
    $topIzin   = $col->sortByDesc('izin')->first();
    $topSakit  = $col->sortByDesc('sakit')->first();
    $topAlpha  = $col->sortByDesc('alpha')->first();
    $topBolos  = $col->sortByDesc('bolos')->first();
@endphp

        {{-- ===== CETAK ===== --}}
        <div class="cetak-wrap">
            <a href="{{ route('guru.absen-siswa.rekap.print', ['bulan' => request('bulan'), 'rombel_id' => request('rombel_id')]) }}"
               target="_blank" class="btn-cetak">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V3h12v6m2 0v12H4V9h16zM6 18h12"/>
                </svg>
                🖨️ Cetak Rekap
            </a>
        </div>

{{-- ================== STATS REKAP SISWA ================== --}}
{{-- ================== STATS REKAP SISWA ================== --}}
<div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4">

    {{-- Total Siswa --}}
    <div class="bg-white rounded-xl p-3 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-2">
            <span class="text-lg">👥</span>
            <span class="text-[10px] text-gray-400 font-medium">TOTAL</span>
        </div>
        <div class="text-xl font-bold text-gray-800 leading-none">
            {{ $totalSiswa }}
        </div>
        <div class="text-[11px] text-gray-500 mt-1">
            Total Siswa
        </div>
    </div>

    {{-- Hadir Terbanyak --}}
    <div class="bg-green-50 rounded-xl p-3 shadow-sm border border-green-100">
        <div class="flex items-center justify-between mb-2">
            <span class="text-lg">✅</span>
            <span class="text-[10px] text-green-600 font-semibold">HADIR</span>
        </div>
        <div class="text-xl font-bold text-green-700 leading-none">
            {{ $topHadir ? $topHadir->hadir : 0 }}
        </div>
        @if($topHadir)
            <div class="text-[11px] text-green-600 truncate mt-1">
                {{ $topHadir->siswa->nama_siswa }}
            </div>
        @endif
    </div>

    {{-- Izin Terbanyak --}}
    <div class="bg-blue-50 rounded-xl p-3 shadow-sm border border-blue-100">
        <div class="flex items-center justify-between mb-2">
            <span class="text-lg">📝</span>
            <span class="text-[10px] text-blue-600 font-semibold">IZIN</span>
        </div>
        <div class="text-xl font-bold text-blue-700 leading-none">
            {{ $topIzin ? $topIzin->izin : 0 }}
        </div>
        @if($topIzin)
            <div class="text-[11px] text-blue-600 truncate mt-1">
                {{ $topIzin->siswa->nama_siswa }}
            </div>
        @endif
    </div>

    {{-- Sakit Terbanyak --}}
    <div class="bg-yellow-50 rounded-xl p-3 shadow-sm border border-yellow-100">
        <div class="flex items-center justify-between mb-2">
            <span class="text-lg">🤒</span>
            <span class="text-[10px] text-yellow-600 font-semibold">SAKIT</span>
        </div>
        <div class="text-xl font-bold text-yellow-700 leading-none">
            {{ $topSakit ? $topSakit->sakit : 0 }}
        </div>
        @if($topSakit)
            <div class="text-[11px] text-yellow-600 truncate mt-1">
                {{ $topSakit->siswa->nama_siswa }}
            </div>
        @endif
    </div>

    {{-- Alpha Terbanyak --}}
    <div class="bg-red-50 rounded-xl p-3 shadow-sm border border-red-100">
        <div class="flex items-center justify-between mb-2">
            <span class="text-lg">❌</span>
            <span class="text-[10px] text-red-600 font-semibold">ALPHA</span>
        </div>
        <div class="text-xl font-bold text-red-700 leading-none">
            {{ $topAlpha ? $topAlpha->alpha : 0 }}
        </div>
        @if($topAlpha)
            <div class="text-[11px] text-red-600 truncate mt-1">
                {{ $topAlpha->siswa->nama_siswa }}
            </div>
        @endif
    </div>

</div>

        {{-- ===== INFO BANNER ===== --}}
        <div class="info-banner">
            <span style="font-size:16px; flex-shrink:0; margin-top:1px;">ℹ️</span>
            <div style="font-size:12px;">
                Menampilkan <strong>{{ $totalSiswa }} siswa</strong> periode
                <strong>{{ \Carbon\Carbon::parse(request('bulan'))->translatedFormat('F Y') }}</strong>
                @if(request('rombel_id'))
                    &mdash; Kelas: <strong>{{ $rombels->find(request('rombel_id'))->nama_lengkap ?? '-' }}</strong>
                @endif
            </div>
        </div>

        {{-- ===== MOBILE: CARD LIST ===== --}}
        <div class="mobile-only student-list">
            @foreach($rekap as $row)
            <a href="{{ route('guru.absen-siswa.rekap.detail', [
                    'siswa'  => $row->siswa_id,
                    'rombel' => request('rombel_id'),
                    'bulan'  => request('bulan')
                ]) }}" class="student-card">

                <div class="student-header">
                    <div class="student-avatar">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="student-num">{{ $loop->iteration }}. Siswa</div>
                        <div class="student-name">{{ $row->siswa->nama_siswa }}</div>
                    </div>
                    <div class="student-arrow">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                <div class="status-grid">
                    <div class="status-box">
                        <div class="status-box-inner sb-green"><span>{{ $row->hadir }}</span></div>
                        <div class="status-box-label">Hadir</div>
                    </div>
                    <div class="status-box">
                        <div class="status-box-inner sb-blue"><span>{{ $row->izin }}</span></div>
                        <div class="status-box-label">Izin</div>
                    </div>
                    <div class="status-box">
                        <div class="status-box-inner sb-yellow"><span>{{ $row->sakit }}</span></div>
                        <div class="status-box-label">Sakit</div>
                    </div>
                    <div class="status-box">
                        <div class="status-box-inner sb-red"><span>{{ $row->alpha }}</span></div>
                        <div class="status-box-label">Alpha</div>
                    </div>
                    <div class="status-box">
                        <div class="status-box-inner sb-purple"><span>{{ $row->bolos }}</span></div>
                        <div class="status-box-label">Bolos</div>
                    </div>
                </div>

            </a>
            @endforeach
        </div>

        {{-- ===== DESKTOP: TABLE ===== --}}
        <div class="desktop-only table-card">
            <div class="table-header">
                <div class="table-header-title">📋 Daftar Rekap Absensi</div>
            </div>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th style="width:48px;">No</th>
                            <th class="left">Nama Siswa</th>
                            <th>✅ Hadir</th>
                            <th>📝 Izin</th>
                            <th>🤒 Sakit</th>
                            <th>✗ Alpha</th>
                            <th>⚠ Bolos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekap as $row)
                        <tr>
                            <td class="td-num">{{ $loop->iteration }}</td>
                            <td class="left">
                                <a href="{{ route('guru.absen-siswa.rekap.detail', [
                                        'siswa'  => $row->siswa_id,
                                        'rombel' => request('rombel_id'),
                                        'bulan'  => request('bulan')
                                    ]) }}" class="td-name-link">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $row->siswa->nama_siswa }}
                                </a>
                            </td>
                            <td><span class="badge-box bb-green">{{ $row->hadir }}</span></td>
                            <td><span class="badge-box bb-blue">{{ $row->izin }}</span></td>
                            <td><span class="badge-box bb-yellow">{{ $row->sakit }}</span></td>
                            <td><span class="badge-box bb-red">{{ $row->alpha }}</span></td>
                            <td><span class="badge-box bb-purple">{{ $row->bolos }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @else

        {{-- ===== EMPTY STATE ===== --}}
        <div class="empty-state">
            <div class="empty-icon-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <div class="empty-title">Belum Ada Data</div>
            <div class="empty-desc">
                Silakan pilih <strong>Kelas</strong> dan <strong>Periode Bulan</strong><br>
                untuk melihat rekap absensi siswa.
            </div>
            <div class="empty-tip">💡 Gunakan filter di atas untuk menampilkan data</div>
        </div>

        @endif

    </div>
</div>

@endsection