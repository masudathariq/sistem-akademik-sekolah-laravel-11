@extends('layouts.staff_tu')

@section('title', 'Data Wali Kelas')

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

/* ── TABLE STYLE ── */
.ta-table { width: 100%; border-collapse: collapse; }
.ta-table thead th {
    padding: .7rem 1.25rem; text-align: left;
    font-size: 11px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .06em;
    background: var(--gray-bg); border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.ta-table thead th:last-child { text-align: left; }
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
    font-weight: 500; width: 50px;
}
.td-wali {
    font-weight: 600; color: var(--navy-md);
}
.td-wali-empty {
    color: var(--hint);
    font-style: italic;
}

/* ── BADGE ── */
.tingkat-badge {
    display: inline-flex; align-items: center;
    padding: 4px 12px; border-radius: 99px;
    font-size: 11px; font-weight: 600;
}
.tingkat-7 { background: #e0f2fe; color: #0369a1; }
.tingkat-8 { background: #dcfce7; color: #15803d; }
.tingkat-9 { background: #fef3c7; color: #b45309; }
.rombel-code {
    font-family: 'Courier New', monospace;
    background: var(--gray-bg);
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    color: var(--navy-md);
}

/* ── EMPTY STATE ── */
.empty-state { text-align: center; padding: 2.5rem 1rem; }
.empty-icon {
    width: 48px; height: 48px; background: var(--gray-bg);
    border-radius: 12px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.empty-state strong { display: block; font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.empty-state p { font-size: 13px; color: var(--muted); }

@media (max-width: 768px) {
    .rb-page {
        padding: 1rem;
    }
    .stats-row {
        grid-template-columns: repeat(2, 1fr);
    }
    .stat-val {
        font-size: 22px;
    }
    .top-bar {
        flex-direction: column;
        align-items: flex-start;
    }
    .btn-back {
        width: 100%;
        justify-content: center;
    }
    .ta-table {
        min-width: 600px;
    }
}
</style>

@php
    $roman = [7 => 'VII', 8 => 'VIII', 9 => 'IX'];
    $totalRombel = $rombels->count();
    $totalWaliTerisi = $rombels->filter(fn($r) => $r->walikelas && $r->walikelas->nama)->count();
    $totalWaliKosong = $totalRombel - $totalWaliTerisi;
    
    $tingkatCount = [
        7 => $rombels->filter(fn($r) => $r->tingkat == 7)->count(),
        8 => $rombels->filter(fn($r) => $r->tingkat == 8)->count(),
        9 => $rombels->filter(fn($r) => $r->tingkat == 9)->count(),
    ];
@endphp

<div class="rb-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Data Wali Kelas</h1>
                <p>Daftar wali kelas untuk setiap rombongan belajar &mdash; <strong>{{ $totalRombel }} Rombel</strong></p>
            </div>
        </div>
        <a href="{{ route('staff_tu.rombel.index') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali ke Rombel
        </a>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Rombel</div>
            <div class="stat-val blue">{{ $totalRombel }}</div>
            <div class="stat-sub">rombongan belajar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Wali Kelas Terisi</div>
            <div class="stat-val green">{{ $totalWaliTerisi }}</div>
            <div class="stat-sub">sudah ditetapkan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Belum Terisi</div>
            <div class="stat-val amber">{{ $totalWaliKosong }}</div>
            <div class="stat-sub">perlu ditetapkan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Tingkat VII</div>
            <div class="stat-val blue">{{ $tingkatCount[7] }}</div>
            <div class="stat-sub">kelas VII</div>
        </div>
    </div>

    {{-- ═══ TABLE CARD ═══ --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">Daftar Wali Kelas</span>
            <span class="table-count">{{ $totalRombel }} rombel</span>
        </div>

        <div class="table-responsive" style="overflow-x: auto;">
            <table class="ta-table">
                <thead>
                    <tr>
                        <th style="width:60px">No</th>
                        <th>Tingkat</th>
                        <th>Kode Rombel</th>
                        <th>Nama Rombel</th>
                        <th>Wali Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rombels as $index => $rombel)
                        @php
                            $tingkatLabel = $roman[$rombel->tingkat] ?? $rombel->tingkat;
                            $tingkatClass = match($rombel->tingkat) {
                                7 => 'tingkat-7',
                                8 => 'tingkat-8',
                                9 => 'tingkat-9',
                                default => 'tingkat-7'
                            };
                            $hasWali = $rombel->walikelas && $rombel->walikelas->nama;
                        @endphp
                        <tr>
                            <td class="td-no">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <span class="tingkat-badge {{ $tingkatClass }}">
                                    Kelas {{ $tingkatLabel }}
                                </span>
                            </td>
                            <td><span class="rombel-code">{{ $rombel->kode_rombel }}</span></td>
                            <td style="font-weight: 600;">{{ $rombel->nama_rombel }}</td>
                            <td>
                                @if($hasWali)
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 28px; height: 28px; background: var(--navy-lt); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                                <circle cx="12" cy="7" r="4"/>
                                            </svg>
                                        </div>
                                        <span class="td-wali">{{ $rombel->walikelas->nama }}</span>
                                    </div>
                                @else
                                    <span class="td-wali-empty">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="12" y1="8" x2="12" y2="12"/>
                                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                                        </svg>
                                        Belum ditetapkan
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <strong>Belum Ada Data Rombel</strong>
                                    <p>Belum ada rombongan belajar yang terdaftar untuk tahun ajaran aktif.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($totalWaliKosong > 0)
        <div style="padding: 0.75rem 1.25rem; border-top: 1px solid var(--border); background: #fffbeb; display: flex; align-items: center; gap: 10px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span style="font-size: 12px; color: #b45309;">
                <strong>Informasi:</strong> Terdapat {{ $totalWaliKosong }} rombel yang belum memiliki wali kelas. Silakan tetapkan wali kelas melalui menu Edit Rombel.
            </span>
        </div>
        @endif
    </div>

</div>

@endsection