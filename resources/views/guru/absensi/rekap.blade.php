@extends('layouts.guru')

@section('content')

@php
$guru = Auth::user()->guru;
$bulanText = \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM');
@endphp

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
    --radius-sm: 10px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04);
    --shadow-lg: 0 10px 30px rgba(0,0,0,0.08);
}

* { box-sizing: border-box; }
body { margin: 0; padding: 0; font-family: 'Nunito', sans-serif; background: var(--gray-50); }

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

.hero-sub {
    font-size: 11px;
    opacity: 0.7;
    position: relative; z-index: 1;
}

.hero-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 20px;
    font-weight: 800;
    margin: 2px 0 4px;
    position: relative; z-index: 1;
}

.hero-period {
    font-size: 12px;
    opacity: 0.8;
    position: relative; z-index: 1;
}

/* ---- BODY ---- */
.page-body {
    padding: 14px 12px;
}

/* ---- SECTION TITLE ---- */
.section-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: var(--gray-700);
    margin: 0 0 10px 2px;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ---- PROFILE CARD ---- */
.profile-card {
    background: white;
    border-radius: var(--radius-md);
    padding: 14px;
    box-shadow: var(--shadow-sm);
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 14px;
    border: 1.5px solid var(--gray-200);
}

.profile-avatar {
    width: 48px; height: 48px;
    border-radius: 14px;
    background: rgba(2,6,89,0.08);
    color: var(--navy);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.profile-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 2px;
}

.profile-meta {
    font-size: 11px;
    color: var(--gray-400);
}

/* ---- FILTER CARD ---- */
.filter-card {
    background: white;
    border-radius: var(--radius-md);
    padding: 14px;
    box-shadow: var(--shadow-sm);
    border: 1.5px solid var(--gray-200);
    margin-bottom: 14px;
}

.filter-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 10px;
}

.filter-label {
    font-size: 11px;
    color: var(--gray-500);
    font-weight: 600;
    margin-bottom: 4px;
}

.filter-input {
    width: 100%;
    padding: 9px 12px;
    font-size: 13px;
    font-family: 'Nunito', sans-serif;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-sm);
    background: var(--gray-50);
    color: var(--gray-800);
    outline: none;
    transition: border-color 0.15s;
}

.filter-input:focus {
    border-color: var(--navy);
    background: white;
}

.btn-filter {
    width: 100%;
    padding: 11px;
    background: linear-gradient(135deg, var(--navy), #1a237e);
    color: white;
    font-size: 13px;
    font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    border: none;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: opacity 0.15s;
}

.btn-filter:hover { opacity: 0.9; }

/* ---- STAT CARDS ---- */
.stat-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

.stat-card {
    background: white;
    border-radius: var(--radius-md);
    padding: 14px 10px;
    box-shadow: var(--shadow-sm);
    text-align: center;
    border: 1.5px solid transparent;
}

.stat-card.green  { border-color: #BBF7D0; background: #F0FDF4; }
.stat-card.yellow { border-color: #FDE68A; background: #FFFBEB; }
.stat-card.red    { border-color: #FECACA; background: #FEF2F2; }

.stat-label {
    font-size: 10px;
    color: var(--gray-500);
    font-weight: 600;
    margin-bottom: 4px;
    letter-spacing: 0.5px;
}

.stat-num {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 26px;
    font-weight: 800;
    line-height: 1;
}

.stat-card.green  .stat-num { color: #16a34a; }
.stat-card.yellow .stat-num { color: #d97706; }
.stat-card.red    .stat-num { color: #dc2626; }

/* ---- ABSENSI ITEM CARDS ---- */
.absen-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.absen-card {
    background: white;
    border-radius: var(--radius-md);
    padding: 14px;
    box-shadow: var(--shadow-sm);
    border: 1.5px solid var(--gray-200);
    transition: transform 0.15s, box-shadow 0.15s;
}

.absen-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}

.absen-day {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: var(--gray-800);
}

.absen-date {
    font-size: 11px;
    color: var(--gray-400);
    margin-top: 2px;
}

.badge {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 99px;
}

.badge-hadir  { background: #DCFCE7; color: #16a34a; }
.badge-izin   { background: #FEF9C3; color: #ca8a04; }
.badge-sakit  { background: #FEE2E2; color: #dc2626; }
.badge-alpha  { background: #F1F5F9; color: #64748B; }

/* JAM ROW */
.jam-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    background: var(--gray-50);
    border-radius: var(--radius-sm);
    padding: 10px 14px;
}

.jam-block .jam-label {
    font-size: 10px;
    color: var(--gray-400);
    margin-bottom: 3px;
    font-weight: 600;
}

.jam-block .jam-val {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--gray-800);
}

/* DIVIDER */
.jam-divider {
    display: flex;
    align-items: center;
    color: var(--gray-300);
    font-size: 20px;
}

/* ACTION BUTTONS */
.action-row {
    display: flex;
    gap: 8px;
}

.btn-action {
    flex: 1;
    text-align: center;
    padding: 9px 8px;
    font-size: 12px;
    font-weight: 700;
    border-radius: var(--radius-sm);
    text-decoration: none;
    transition: opacity 0.15s;
}

.btn-action:hover { opacity: 0.88; }
.btn-action.loc { background: #DCFCE7; color: #16a34a; }
.btn-action.foto { background: #DBEAFE; color: #2563eb; }

/* EMPTY STATE */
.empty-state {
    text-align: center;
    padding: 50px 20px;
    color: var(--gray-400);
}

.empty-icon { font-size: 40px; margin-bottom: 10px; }
.empty-text { font-size: 14px; font-weight: 600; color: var(--gray-500); }
.empty-sub  { font-size: 12px; margin-top: 4px; }

/* ======================================================
   DESKTOP ≥768px
   ====================================================== */
@media (min-width: 768px) {

    .page-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 24px 48px;
    }

    .hero-card {
        border-radius: var(--radius-lg);
        margin: 24px 0 0;
        padding: 32px 40px;
    }

    .hero-sub    { font-size: 13px; }
    .hero-title  { font-size: 28px; }
    .hero-period { font-size: 14px; }

    .page-body { padding: 24px 0; }

    .section-title { font-size: 15px; }

    /* Profile + Filter side by side */
    .top-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }

    .profile-card,
    .filter-card { margin-bottom: 0; }

    .profile-card { padding: 20px; }
    .profile-avatar { width: 58px; height: 58px; font-size: 24px; }
    .profile-name { font-size: 16px; }
    .profile-meta { font-size: 12px; }

    .filter-card { padding: 20px; }

    /* Stats */
    .stat-row { gap: 16px; margin-bottom: 28px; }
    .stat-card { padding: 20px 14px; }
    .stat-label { font-size: 12px; }
    .stat-num { font-size: 36px; }

    /* Absen list: 2 cols */
    .absen-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .absen-card {
        padding: 18px;
        border-radius: var(--radius-lg);
    }

    .absen-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .absen-day  { font-size: 15px; }
    .absen-date { font-size: 12px; }

    .jam-block .jam-val { font-size: 17px; }

    .btn-action { font-size: 13px; padding: 10px; }
}
</style>

<div class="page-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div class="hero-sub">Rekap Absensi Guru</div>
        <div class="hero-title">📊 Rekap Kehadiran</div>
        <div class="hero-period">{{ $bulanText }} {{ $tahun }}</div>
    </div>

    <div class="page-body">

        {{-- ===== PROFILE + FILTER (wrapped for desktop side-by-side) ===== --}}
        <div class="section-title">👤 Info & Filter</div>

        <div class="top-row">

            {{-- Profile --}}
            <div class="profile-card">
                <div class="profile-avatar">👤</div>
                <div>
                    <div class="profile-name">{{ $guru->nama }}</div>
                    <div class="profile-meta">
                        {{ $guru->nuptk ?? '-' }} &bull; {{ $guru->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="filter-card">
                <form method="GET">
                    <div class="filter-grid">
                        <div>
                            <div class="filter-label">Bulan</div>
                            <select name="bulan" class="filter-input">
                                @for($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                                </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <div class="filter-label">Tahun</div>
                            <input type="number" name="tahun" value="{{ $tahun }}" class="filter-input">
                        </div>
                    </div>
                    <button type="submit" class="btn-filter">Terapkan Filter</button>
                </form>
            </div>

        </div>

        {{-- ===== STATISTIK ===== --}}
        <div class="section-title">📈 Ringkasan Bulan Ini</div>

        <div class="stat-row">
            <div class="stat-card green">
                <div class="stat-label">HADIR</div>
                <div class="stat-num">{{ $totalHadir ?? 0 }}</div>
            </div>
            <div class="stat-card yellow">
                <div class="stat-label">IZIN</div>
                <div class="stat-num">{{ $totalIzin ?? 0 }}</div>
            </div>
            <div class="stat-card red">
                <div class="stat-label">SAKIT</div>
                <div class="stat-num">{{ $totalSakit ?? 0 }}</div>
            </div>
        </div>

        {{-- ===== DETAIL ABSENSI ===== --}}
        <div class="section-title">🗓️ Detail Kehadiran</div>

        <div class="absen-list">
            @forelse($absensi as $a)
            <div class="absen-card">

                {{-- Top: Hari + Badge --}}
                <div class="absen-top">
                    <div>
                        <div class="absen-day">
                            {{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('dddd') }}
                        </div>
                        <div class="absen-date">
                            {{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                        </div>
                    </div>

                    @if($a->status == 'hadir')
                        <span class="badge badge-hadir">✓ Hadir</span>
                    @elseif($a->status == 'izin')
                        <span class="badge badge-izin">✉ Izin</span>
                    @elseif($a->status == 'sakit')
                        <span class="badge badge-sakit">🤒 Sakit</span>
                    @else
                        <span class="badge badge-alpha">— Alpha</span>
                    @endif
                </div>

                {{-- Jam Masuk & Pulang --}}
                <div class="jam-row">
                    <div class="jam-block">
                        <div class="jam-label">MASUK</div>
                        <div class="jam-val">{{ $a->jam_masuk ?? '—' }}</div>
                    </div>
                    <div class="jam-divider">→</div>
                    <div class="jam-block" style="text-align:right;">
                        <div class="jam-label">PULANG</div>
                        <div class="jam-val">{{ $a->jam_pulang ?? '—' }}</div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                @if($a->latitude && $a->longitude || $a->foto)
                <div class="action-row">
                    @if($a->latitude && $a->longitude)
                    <a href="https://www.google.com/maps?q={{ $a->latitude }},{{ $a->longitude }}"
                       target="_blank" class="btn-action loc">
                        📍 Lihat Lokasi
                    </a>
                    @endif

                    @if($a->foto)
                    <a href="{{ asset('storage/' . $a->foto) }}"
                       target="_blank" class="btn-action foto">
                        📷 Lihat Foto
                    </a>
                    @endif
                </div>
                @endif

            </div>
            @empty
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">📋</div>
                <div class="empty-text">Belum ada data absensi</div>
                <div class="empty-sub">{{ $bulanText }} {{ $tahun }}</div>
            </div>
            @endforelse
        </div>

    </div>
</div>

@endsection