@extends('layouts.bendahara')

@section('title', 'Siswa Rombel ' . $rombel->nama_rombel)

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

body { font-family: 'IBM Plex Sans', sans-serif; background: var(--gray-bg); }

.page-wrapper {
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
    margin-bottom: 1.75rem;
    flex-wrap: wrap;
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

/* ── BUTTON BACK ── */
.btn-back {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 8px 18px;
    background: #fff;
    color: var(--muted);
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .15s;
}
.btn-back:hover {
    background: var(--gray-bg);
    color: var(--text);
}

/* ── STAT CARDS ── */
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

/* ── INFO CARD ── */
.info-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.info-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
    display: flex;
    align-items: center;
    gap: 12px;
}
.info-header-icon {
    width: 36px; height: 36px;
    background: var(--navy-lt);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
}
.info-header h3 {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
    margin: 0;
}
.info-body {
    padding: 1.5rem;
}
.info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}
.info-item {
    padding: 0.75rem;
    background: var(--gray-bg);
    border-radius: 10px;
}
.info-item .label {
    font-size: 10px;
    font-weight: 600;
    color: var(--hint);
    text-transform: uppercase;
    margin-bottom: 6px;
}
.info-item .value {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
}
.info-item .value.blue { color: var(--navy-md); }

/* ── TABLE CARD ── */
.table-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}
.table-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: .75rem 1.25rem;
    border-bottom: 1px solid var(--border);
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
.ta-table { width: 100%; border-collapse: collapse; }
.ta-table thead th {
    padding: .7rem 1rem; text-align: left;
    font-size: 11px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .06em;
    background: var(--gray-bg); border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.ta-table thead th:last-child { text-align: center; }
.ta-table tbody tr {
    border-bottom: 1px solid #f1f5f9; transition: background .12s;
}
.ta-table tbody tr:hover { background: #f8fafc; }
.ta-table td {
    padding: .875rem 1rem; vertical-align: middle;
    font-size: 13px; color: var(--text);
}
.ta-table td:last-child { text-align: center; }
.td-nama {
    font-weight: 600;
    color: var(--text);
}
.badge-l {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 12px; border-radius: 99px;
    font-size: 11px; font-weight: 600;
    background: var(--navy-lt); color: var(--navy-md);
}
.badge-p {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 12px; border-radius: 99px;
    font-size: 11px; font-weight: 600;
    background: var(--pink-lt); color: var(--pink);
}
.btn-view {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px;
    background: var(--green-lt);
    color: var(--green);
    border: 1px solid var(--green-bd);
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all .15s;
}
.btn-view:hover {
    background: #dcfce7;
    transform: translateY(-1px);
}
.empty-state {
    text-align: center;
    padding: 2.5rem 1rem;
}
.empty-icon {
    width: 48px; height: 48px;
    background: var(--gray-bg);
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: .875rem;
}
.empty-state strong {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 4px;
}
.empty-state p {
    font-size: 13px;
    color: var(--muted);
}

@media (max-width: 768px) {
    .page-wrapper { padding: 1rem; }
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .info-grid { grid-template-columns: 1fr; }
    .top-bar { flex-direction: column; align-items: flex-start; }
    .btn-back { width: 100%; justify-content: center; }
    .ta-table { min-width: 500px; }
}
</style>

@php
    $totalSiswa = $siswas->count();
    $siswaL = $siswas->where('jenis_kelamin', 'L')->count();
    $siswaP = $siswas->where('jenis_kelamin', 'P')->count();
    $totalSaldo = $siswas->sum(function($s) {
        return $s->tabungan->saldo ?? 0;
    });
    $tingkatRomawi = match($rombel->tingkat) {
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        default => $rombel->tingkat
    };
@endphp

<div class="page-wrapper">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Daftar Siswa</h1>
                <p>Rombongan belajar <strong>{{ $rombel->nama_rombel }} (Kelas {{ $tingkatRomawi }})</strong></p>
            </div>
        </div>
        <a href="{{ route('bendahara.tabungan-siswa.rombel', $rombel->tingkat) }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali ke Pilih Rombel
        </a>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Siswa</div>
            <div class="stat-val blue">{{ $totalSiswa }}</div>
            <div class="stat-sub">siswa terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Laki-laki</div>
            <div class="stat-val blue">{{ $siswaL }}</div>
            <div class="stat-sub">siswa</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Perempuan</div>
            <div class="stat-val pink">{{ $siswaP }}</div>
            <div class="stat-sub">siswi</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Tabungan</div>
            <div class="stat-val green">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</div>
            <div class="stat-sub">keseluruhan saldo</div>
        </div>
    </div>

    {{-- ═══ INFO ROMBEL ═══ --}}
    <div class="info-card">
        <div class="info-header">
            <div class="info-header-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                    <path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5m-4 0h4"/>
                </svg>
            </div>
            <h3>Informasi Rombel</h3>
        </div>
        <div class="info-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="label">Nama Rombel</div>
                    <div class="value blue">{{ $rombel->nama_rombel }}</div>
                </div>
                <div class="info-item">
                    <div class="label">Kode Rombel</div>
                    <div class="value">{{ $rombel->kode_rombel }}</div>
                </div>
                <div class="info-item">
                    <div class="label">Wali Kelas</div>
                    <div class="value">{{ $rombel->walikelas->nama ?? 'Belum ditentukan' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ TABLE SISWA ═══ --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">Daftar Siswa</span>
            <span class="table-count">{{ $totalSiswa }} siswa</span>
        </div>
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="ta-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>JK</th>
                        <th style="width:140px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $index => $siswa)
                    <tr>
                        <td class="td-no" style="width:50px; text-align:center;">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="td-mono" style="font-family: monospace;">{{ $siswa->nisn ?? '-' }}</td>
                        <td class="td-mono" style="font-family: monospace;">{{ $siswa->nis ?? '-' }}</td>
                        <td class="td-nama">{{ $siswa->nama_siswa }}</td>
                        <td>
                            @if($siswa->jenis_kelamin === 'L')
                                <span class="badge-l">👨 Laki-laki</span>
                            @else
                                <span class="badge-p">👩 Perempuan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('bendahara.tabungan-siswa.show', $siswa->id) }}" class="btn-view">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                Lihat Tabungan
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <strong>Belum Ada Siswa</strong>
                                    <p>Tidak ada siswa yang terdaftar dalam rombel ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection