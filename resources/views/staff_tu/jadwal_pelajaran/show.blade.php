@extends('layouts.staff_tu')

@section('title', 'Jadwal Mengajar - Hari ' . ucfirst($hari))

@section('content')

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
    --red:      #dc2626;
    --red-lt:   #fff1f2;
    --red-bd:   #fecdd3;
    --pink:     #be185d;
    --pink-lt:  #fdf2f8;
    --pink-bd:  #f9a8d4;
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

.rb-page {
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
    margin-bottom: 1rem;
}
.page-title { display: flex; align-items: center; gap: 12px; }
.title-icon {
    width: 44px; height: 44px; background: var(--navy-lt);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.title-text h1 {
    font-size: 20px; font-weight: 600; color: var(--text);
    margin: 0 0 3px; letter-spacing: -.02em;
}
.title-text p { font-size: 13px; color: var(--muted); margin: 0; }
.title-text p strong { color: var(--navy-md); font-weight: 600; }

/* ── BREADCRUMB ── */
.breadcrumb {
    display: flex; align-items: center; gap: 6px;
    font-size: 12px; color: var(--hint);
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}
.breadcrumb a {
    color: var(--muted); text-decoration: none;
    transition: color .15s;
}
.breadcrumb a:hover { color: var(--navy-md); }
.breadcrumb span { color: var(--hint); }
.breadcrumb .active { color: var(--navy-md); font-weight: 600; }

/* ── STAT BADGES ROW ── */
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
.stat-val { font-size: 26px; font-weight: 600; letter-spacing: -.03em; }
.stat-val.blue  { color: var(--navy-md); }
.stat-val.green { color: #15803d; }
.stat-val.amber { color: var(--amber); }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

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

/* ── TABLE STYLE ── */
.ta-table { width: 100%; border-collapse: collapse; }
.ta-table thead th {
    padding: .7rem 1.25rem; text-align: left;
    font-size: 11px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .06em;
    background: var(--gray-bg); border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.ta-table thead th.th-center { text-align: center; }
.ta-table tbody tr {
    border-bottom: 1px solid #f1f5f9; transition: background .12s;
}
.ta-table tbody tr:last-child { border-bottom: none; }
.ta-table tbody tr:hover { background: #f8fafc; }
.ta-table td {
    padding: .875rem 1.25rem; vertical-align: middle;
    font-size: 13px; color: var(--text);
}
.td-no {
    font-size: 12px; color: var(--hint);
    font-weight: 500; width: 50px; text-align: center;
}

/* ── BADGE STYLES ── */
.badge-time {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px; border-radius: 99px;
    font-size: 12px; font-weight: 600;
    background: var(--navy-lt); color: var(--navy-md);
    white-space: nowrap;
}
.badge-kelas {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px; border-radius: 99px;
    font-size: 12px; font-weight: 600;
    background: #f3e8ff; color: #9333ea;
    white-space: nowrap;
}
.badge-mapel {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px; border-radius: 99px;
    font-size: 12px; font-weight: 600;
    background: var(--green-lt); color: var(--green);
    white-space: nowrap;
}

/* ── GURU AVATAR ── */
.guru-cell {
    display: flex; align-items: center; gap: 10px;
}
.guru-avatar {
    width: 32px; height: 32px; border-radius: 8px;
    background: var(--navy-lt); color: var(--navy-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700;
    flex-shrink: 0;
}
.guru-name { font-weight: 600; color: var(--text); }

/* ── EMPTY STATE ── */
.empty-state { text-align: center; padding: 2.5rem 1rem; }
.empty-icon {
    width: 48px; height: 48px; background: var(--gray-bg);
    border-radius: 12px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.empty-state strong { display: block; font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.empty-state p { font-size: 13px; color: var(--muted); }

/* ── BACK BUTTON ── */
.btn-back {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 8px 0; margin-top: 1.25rem;
    font-size: 13px; font-weight: 600;
    color: var(--muted); text-decoration: none;
    transition: color .15s;
}
.btn-back:hover { color: var(--navy-md); }
.btn-back svg { transition: transform .15s; }
.btn-back:hover svg { transform: translateX(-3px); }

/* ── MOBILE CARD LIST ── */
.mobile-list { display: none; }
.mobile-item {
    padding: 1rem; border-bottom: 1px solid var(--border);
}
.mobile-item:last-child { border-bottom: none; }
.mobile-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 10px;
}
.mobile-guru {
    display: flex; align-items: center; gap: 10px;
}
.mobile-guru-avatar {
    width: 36px; height: 36px; border-radius: 10px;
    background: var(--navy-lt); color: var(--navy-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700;
}
.mobile-guru-name { font-weight: 700; font-size: 14px; color: var(--text); }
.mobile-guru-role { font-size: 11px; color: var(--hint); }
.mobile-no {
    width: 28px; height: 28px; background: var(--gray-bg);
    border-radius: 99px; display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 600; color: var(--muted);
}
.mobile-badges {
    display: flex; flex-wrap: wrap; gap: 8px; margin-top: 4px;
}
.mobile-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 10px; border-radius: 99px;
    font-size: 11px; font-weight: 600;
}

@media (max-width: 768px) {
    .rb-page { padding: 1rem; }
    .desktop-table { display: none; }
    .mobile-list { display: block; }
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .stat-val { font-size: 22px; }
}
</style>

<div class="rb-page">

    {{-- ═══ BREADCRUMB ═══ --}}
    <div class="breadcrumb">
        <a href="{{ route('staff_tu.jadwal_pelajaran.index') }}">Jadwal & Kurikulum</a>
        <span>›</span>
        <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}">Hari {{ ucfirst($hari) }}</a>
        <span>›</span>
        <span class="active">Daftar Jadwal</span>
    </div>

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>
            <div class="title-text">
                <h1>Jadwal Mengajar &mdash; <span style="color: var(--navy-md);">{{ ucfirst($hari) }}</span></h1>
                <p>Seluruh jadwal mengajar pada hari <strong>{{ ucfirst($hari) }}</strong></p>
            </div>
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Tahun Ajaran</div>
            <div class="stat-val blue">{{ $tahunAktif->tahun_ajaran ?? '-' }}</div>
            <div class="stat-sub">tahun akademik</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Semester</div>
            <div class="stat-val blue">{{ $tahunAktif->semester ?? '-' }}</div>
            <div class="stat-sub">periode berjalan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Hari</div>
            <div class="stat-val amber">{{ ucfirst($hari) }}</div>
            <div class="stat-sub">jadwal mengajar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Sesi</div>
            <div class="stat-val green">{{ $jadwals->count() }}</div>
            <div class="stat-sub">sesi pembelajaran</div>
        </div>
    </div>

    {{-- ═══ TABLE CARD ═══ --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">Daftar Jadwal Mengajar</span>
            <span class="table-count">{{ $jadwals->count() }} sesi</span>
        </div>

        {{-- DESKTOP TABLE --}}
        <div class="desktop-table" style="overflow-x: auto;">
            <table class="ta-table">
                <thead>
                    <tr>
                        <th style="width:60px;text-align:center">No</th>
                        <th>Jam Pelajaran</th>
                        <th>Guru Pengampu</th>
                        <th>Kelas / Rombel</th>
                        <th>Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $index => $jadwal)
                    <tr>
                        <td class="td-no">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <span class="badge-time">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </span>
                        </td>
                        <td>
                            <div class="guru-cell">
                                <div class="guru-avatar">
                                    {{ strtoupper(substr($jadwal->guru->nama ?? '?', 0, 1)) }}
                                </div>
                                <span class="guru-name">{{ $jadwal->guru->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge-kelas">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 20h16a2 2 0 002-2V8a2 2 0 00-2-2h-7l-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $jadwal->rombel->tingkat_romawi ?? '-' }} {{ $jadwal->rombel->kode_rombel ?? '-' }} {{ $jadwal->rombel->nama_rombel ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-mapel">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                {{ $jadwal->mataPelajaran->nama_mapel ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <strong>Belum Ada Jadwal</strong>
                                <p>Belum ada jadwal mengajar pada hari {{ ucfirst($hari) }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MOBILE CARD LIST --}}
        <div class="mobile-list">
            @forelse($jadwals as $index => $jadwal)
            <div class="mobile-item">
                <div class="mobile-header">
                    <div class="mobile-guru">
                        <div class="mobile-guru-avatar">
                            {{ strtoupper(substr($jadwal->guru->nama ?? '?', 0, 1)) }}
                        </div>
                        <div>
                            <div class="mobile-guru-name">{{ $jadwal->guru->nama ?? '-' }}</div>
                            <div class="mobile-guru-role">Guru Pengampu</div>
                        </div>
                    </div>
                    <div class="mobile-no">{{ $index + 1 }}</div>
                </div>
                <div class="mobile-badges">
                    <span class="mobile-badge" style="background: var(--navy-lt); color: var(--navy-md);">
                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                    </span>
                    <span class="mobile-badge" style="background: #f3e8ff; color: #9333ea;">
                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 20h16a2 2 0 002-2V8a2 2 0 00-2-2h-7l-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ $jadwal->rombel->tingkat_romawi ?? '-' }} {{ $jadwal->rombel->kode_rombel ?? '-' }}
                    </span>
                    <span class="mobile-badge" style="background: var(--green-lt); color: var(--green);">
                        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                        </svg>
                        {{ $jadwal->mataPelajaran->nama_mapel ?? '-' }}
                    </span>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                    </svg>
                </div>
                <strong>Belum Ada Jadwal</strong>
                <p>Belum ada jadwal mengajar pada hari {{ ucfirst($hari) }}</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ═══ BACK BUTTON ═══ --}}
    <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}" class="btn-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Kembali ke Daftar Guru
    </a>

</div>

@endsection