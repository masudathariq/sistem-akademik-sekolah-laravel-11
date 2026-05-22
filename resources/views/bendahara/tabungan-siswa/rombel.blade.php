@extends('layouts.bendahara')

@section('title', 'Pilih Rombel - Kelas ' . $tingkat)

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

/* ── ROMBEL GRID ── */
.rombel-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.25rem;
    margin-top: 0.5rem;
}
.rombel-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: all .2s ease;
}
.rombel-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(0,0,0,.1);
}
.rombel-header {
    padding: 1rem 1.25rem;
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-md) 100%);
    color: white;
}
.rombel-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
}
.rombel-header p {
    margin: 4px 0 0;
    font-size: 11px;
    opacity: 0.8;
}
.rombel-body {
    padding: 1.25rem;
}
.rombel-info {
    margin-bottom: 1rem;
}
.info-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid var(--border);
}
.info-row:last-child {
    border-bottom: none;
}
.info-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--muted);
}
.info-value {
    font-size: 13px;
    font-weight: 500;
    color: var(--text);
}
.info-value.empty {
    color: var(--hint);
    font-style: italic;
}
.rombel-footer {
    padding: 1rem 1.25rem;
    border-top: 1px solid var(--border);
    background: var(--gray-bg);
}
.btn-view {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 8px 16px;
    background: var(--green);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .15s;
}
.btn-view:hover {
    background: #15803d;
    transform: translateY(-1px);
}

/* ── INFO CARD ── */
.info-card {
    background: var(--navy-lt);
    border: 1px solid #bfdbfe;
    border-radius: var(--radius);
    padding: 1rem;
    margin-bottom: 1.75rem;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}
.info-icon {
    width: 36px;
    height: 36px;
    background: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.info-content p {
    margin: 0;
    font-size: 13px;
    color: var(--navy);
    line-height: 1.5;
}
.info-content strong {
    color: var(--navy-md);
}

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
}
.empty-icon {
    width: 64px;
    height: 64px;
    background: var(--gray-bg);
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}
.empty-state h3 {
    font-size: 16px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.5rem;
}
.empty-state p {
    font-size: 13px;
    color: var(--muted);
}

@media (max-width: 768px) {
    .page-wrapper {
        padding: 1rem;
    }
    .stats-row {
        grid-template-columns: repeat(2, 1fr);
    }
    .stat-val {
        font-size: 22px;
    }
    .rombel-grid {
        grid-template-columns: 1fr;
    }
    .top-bar {
        flex-direction: column;
        align-items: flex-start;
    }
    .btn-back {
        width: 100%;
        justify-content: center;
    }
}
</style>

@php
    $tingkatRomawi = match($tingkat) {
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        default => $tingkat
    };
    $totalRombel = $rombels->count();
    $totalSiswa = $rombels->sum('jumlah_siswa');
    $totalWaliTerisi = $rombels->filter(fn($r) => $r->walikelas && $r->walikelas->nama)->count();
    $totalSiswaAktif = $rombels->sum(fn($r) => $r->jumlah_siswa ?? 0);
@endphp

<div class="page-wrapper">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Pilih Rombel</h1>
                <p>Pilih rombongan belajar untuk kelas <strong>Kelas {{ $tingkatRomawi }}</strong></p>
            </div>
        </div>
        <a href="{{ route('bendahara.tabungan-siswa.index') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali ke Pilih Tingkat
        </a>
    </div>

    {{-- ═══ INFO CARD ═══ --}}
    <div class="info-card">
        <div class="info-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="info-content">
            <p><strong>Informasi:</strong> Pilih rombongan belajar di bawah untuk melihat daftar siswa dan mengelola tabungan mereka. Setiap rombel memiliki data siswa yang dapat diatur tabungannya secara terpisah.</p>
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Rombel</div>
            <div class="stat-val blue">{{ $totalRombel }}</div>
            <div class="stat-sub">rombongan belajar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Siswa</div>
            <div class="stat-val green">{{ number_format($totalSiswa) }}</div>
            <div class="stat-sub">siswa terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Wali Kelas Terisi</div>
            <div class="stat-val amber">{{ $totalWaliTerisi }}</div>
            <div class="stat-sub">dari {{ $totalRombel }} rombel</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Laki-laki</div>
            <div class="stat-val blue">{{ number_format($rombels->sum('laki_count')) }}</div>
            <div class="stat-sub">siswa</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Perempuan</div>
            <div class="stat-val pink">{{ number_format($rombels->sum('perempuan_count')) }}</div>
            <div class="stat-sub">siswi</div>
        </div>
    </div>

    {{-- ═══ ROMBEL GRID ═══ --}}
    @if($rombels->count() > 0)
    <div class="rombel-grid">
        @foreach($rombels as $rombel)
        @php
            $hasWali = $rombel->walikelas && $rombel->walikelas->nama;
            $waliName = $hasWali ? $rombel->walikelas->nama : 'Belum ditentukan';
        @endphp
        <div class="rombel-card">
            <div class="rombel-header">
                <h3>{{ $rombel->nama_rombel }}</h3>
                <p>Kode: {{ $rombel->kode_rombel }}</p>
            </div>
            <div class="rombel-body">
                <div class="rombel-info">
                    <div class="info-row">
                        <span class="info-label">🏫 Wali Kelas</span>
                        <span class="info-value {{ !$hasWali ? 'empty' : '' }}">
                            {{ $waliName }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">👨‍🎓 Jumlah Siswa</span>
                        <span class="info-value">{{ $rombel->siswas_count ?? $rombel->jumlah_siswa ?? 0 }} siswa</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">💰 Total Tabungan</span>
                        <span class="info-value">Rp {{ number_format($rombel->total_tabungan ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="rombel-footer">
                <a href="{{ route('bendahara.tabungan-siswa.siswa', $rombel->id) }}" class="btn-view">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Lihat Siswa
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    {{-- ═══ EMPTY STATE ═══ --}}
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <h3>Tidak Ada Rombel</h3>
        <p>Tidak ada rombongan belajar untuk kelas {{ $tingkatRomawi }}. Silakan tambahkan data rombel terlebih dahulu.</p>
        <a href="{{ route('bendahara.tabungan-siswa.index') }}" class="btn-back" style="margin-top: 1rem; display: inline-flex;">
            Kembali ke Pilih Tingkat
        </a>
    </div>
    @endif

</div>

@endsection