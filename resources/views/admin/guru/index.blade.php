@extends('layouts.admin')

@section('title', 'Data Guru')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.dg { font-family: 'DM Sans', sans-serif; color: #1A1C22; }

/* ── Topbar ── */
.dg-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 28px;
}
.dg-title   { font-size: 19px; font-weight: 500; letter-spacing: -0.3px; color: #1A1C22; margin-bottom: 3px; }
.dg-subtitle{ font-size: 13px; color: #6B7280; }

/* ── Section label ── */
.dg-label {
    font-size: 10px;
    font-weight: 500;
    color: #9CA3AF;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}
.dg-label::after { content: ''; flex: 1; height: 1px; background: rgba(0,0,0,0.07); }

/* ── 3 Stat Cards ── */
.dg-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 14px;
}
@media (max-width: 640px) { .dg-stats { grid-template-columns: 1fr; } }

.dg-stat {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.09);
    border-radius: 12px;
    padding: 18px 20px;
    position: relative;
    overflow: hidden;
    transition: box-shadow .18s, transform .18s;
}
.dg-stat:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.07); }

/* Top accent line */
.dg-stat::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 12px 12px 0 0;
}
.dg-stat.s-blue  ::before, .dg-stat.s-blue::before  { background: linear-gradient(90deg,#4F46E5,#818CF8); }
.dg-stat.s-green ::before, .dg-stat.s-green::before  { background: linear-gradient(90deg,#059669,#34D399); }
.dg-stat.s-violet::before, .dg-stat.s-violet::before { background: linear-gradient(90deg,#7C3AED,#A78BFA); }

.dg-stat-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }

.dg-stat-icon {
    width: 36px; height: 36px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.dg-stat-icon svg { width: 17px; height: 17px; }
.s-blue   .dg-stat-icon { background: #EEF2FF; color: #4F46E5; }
.s-green  .dg-stat-icon { background: #ECFDF5; color: #059669; }
.s-violet .dg-stat-icon { background: #F5F3FF; color: #7C3AED; }

.dg-stat-pct {
    font-family: 'DM Mono', monospace;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 20px;
}
.s-blue   .dg-stat-pct { background: #EEF2FF; color: #4F46E5; }
.s-green  .dg-stat-pct { background: #ECFDF5; color: #059669; }
.s-violet .dg-stat-pct { background: #F5F3FF; color: #7C3AED; }

.dg-stat-num {
    font-family: 'DM Mono', monospace;
    font-size: 30px;
    font-weight: 500;
    letter-spacing: -1px;
    line-height: 1;
    margin-bottom: 3px;
}
.s-blue   .dg-stat-num { color: #4F46E5; }
.s-green  .dg-stat-num { color: #059669; }
.s-violet .dg-stat-num { color: #7C3AED; }

.dg-stat-name { font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em; color: #9CA3AF; margin-bottom: 2px; }
.dg-stat-desc { font-size: 12px; color: #9CA3AF; }

.dg-bar { height: 3px; background: #F3F4F6; border-radius: 99px; margin-top: 14px; overflow: hidden; }
.dg-bar-fill { height: 100%; border-radius: 99px; }
.s-blue   .dg-bar-fill { background: linear-gradient(90deg,#4F46E5,#818CF8); }
.s-green  .dg-bar-fill { background: linear-gradient(90deg,#059669,#34D399); }
.s-violet .dg-bar-fill { background: linear-gradient(90deg,#7C3AED,#A78BFA); }

/* ── 4 Breakdown Cards ── */
.dg-breakdown {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 24px;
}
@media (max-width: 768px) { .dg-breakdown { grid-template-columns: repeat(2, 1fr); } }

.dg-bcard {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.09);
    border-radius: 11px;
    padding: 14px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: box-shadow .18s, transform .18s;
}
.dg-bcard:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.06); }

/* Left accent */
.dg-bcard.bc-cyan  { border-left: 3px solid #0891B2; }
.dg-bcard.bc-rose  { border-left: 3px solid #E11D48; }
.dg-bcard.bc-amber { border-left: 3px solid #D97706; }
.dg-bcard.bc-red   { border-left: 3px solid #DC2626; }

.dg-bcard-ico {
    width: 36px; height: 36px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.dg-bcard-ico svg { width: 16px; height: 16px; }
.bc-cyan  .dg-bcard-ico { background: #ECFEFF; color: #0891B2; }
.bc-rose  .dg-bcard-ico { background: #FFF1F2; color: #E11D48; }
.bc-amber .dg-bcard-ico { background: #FFFBEB; color: #D97706; }
.bc-red   .dg-bcard-ico { background: #FEF2F2; color: #DC2626; }

.dg-bcard-num   { font-family: 'DM Mono', monospace; font-size: 22px; font-weight: 500; letter-spacing: -0.5px; line-height: 1; }
.dg-bcard-label { font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em; color: #9CA3AF; margin-top: 2px; }
.bc-cyan  .dg-bcard-num { color: #0891B2; }
.bc-rose  .dg-bcard-num { color: #E11D48; }
.bc-amber .dg-bcard-num { color: #D97706; }
.bc-red   .dg-bcard-num { color: #DC2626; }

/* ── Info Banner ── */
.dg-banner {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: linear-gradient(135deg, #EEF2FF, #F5F3FF);
    border: 1px solid rgba(79,70,229,0.16);
    border-radius: 11px;
    padding: 14px 16px;
    margin-bottom: 24px;
}
.dg-banner-icon {
    width: 34px; height: 34px;
    background: #4F46E5;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.dg-banner-icon svg { width: 15px; height: 15px; color: #fff; }
.dg-banner-title { font-size: 13px; font-weight: 500; color: #1A1C22; margin-bottom: 3px; }
.dg-banner-text  { font-size: 12.5px; color: #6B7280; line-height: 1.6; }
.dg-banner-text strong { color: #4F46E5; font-weight: 500; }

/* ── Table Card ── */
.dg-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.09);
    border-radius: 13px;
    overflow: hidden;
}
.dg-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 20px;
    border-bottom: 1px solid rgba(0,0,0,0.07);
    flex-wrap: wrap;
    gap: 10px;
}
.dg-card-title {
    font-size: 14px;
    font-weight: 500;
    color: #1A1C22;
    display: flex;
    align-items: center;
    gap: 7px;
}
.dg-card-title svg { width: 15px; height: 15px; color: #9CA3AF; }
.dg-card-count {
    font-family: 'DM Mono', monospace;
    font-size: 11.5px;
    color: #9CA3AF;
    background: #F9FAFB;
    border: 1px solid rgba(0,0,0,0.07);
    border-radius: 20px;
    padding: 3px 10px;
}

/* Table */
.dg-scroll { overflow-x: auto; }
.dg-table  { width: 100%; border-collapse: collapse; }

.dg-table thead tr { background: #FAFAFA; }
.dg-table th {
    padding: 10px 16px;
    text-align: left;
    font-size: 10.5px;
    font-weight: 500;
    color: #9CA3AF;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    border-bottom: 1px solid rgba(0,0,0,0.07);
    white-space: nowrap;
}
.dg-table th:last-child { text-align: right; }

.dg-table tbody tr {
    border-bottom: 1px solid rgba(0,0,0,0.04);
    transition: background .1s;
}
.dg-table tbody tr:last-child { border-bottom: none; }
.dg-table tbody tr:hover { background: #FAFBFC; }
.dg-table td { padding: 12px 16px; vertical-align: middle; }

/* Row number */
.td-no {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 26px; height: 26px;
    border-radius: 6px;
    background: #F9FAFB;
    border: 1px solid rgba(0,0,0,0.08);
    font-family: 'DM Mono', monospace;
    font-size: 11px;
    color: #9CA3AF;
}

/* Guru cell */
.td-guru { display: flex; align-items: center; gap: 10px; }
.td-avatar {
    width: 34px; height: 34px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 500; color: #fff;
    flex-shrink: 0;
}
.av-0 { background: linear-gradient(135deg,#4F46E5,#818CF8); }
.av-1 { background: linear-gradient(135deg,#059669,#34D399); }
.av-2 { background: linear-gradient(135deg,#7C3AED,#A78BFA); }
.av-3 { background: linear-gradient(135deg,#0891B2,#67E8F9); }

.td-name  { font-size: 13.5px; font-weight: 500; color: #1A1C22; }
.td-email { font-family: 'DM Mono', monospace; font-size: 11px; color: #9CA3AF; margin-top: 1px; }
.td-nuptk { font-family: 'DM Mono', monospace; font-size: 12px; color: #6B7280; }

/* Badges */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 500;
    white-space: nowrap;
}
.badge svg { width: 9px; height: 9px; }

.badge-jabatan { background: #EEF2FF; color: #3730A3; border: 1px solid rgba(79,70,229,0.18); }
.badge-nuptk   { background: #ECFDF5; color: #065F46; border: 1px solid rgba(5,150,105,0.18); }
.badge-no-nuptk{ background: #FFFBEB; color: #92400E; border: 1px solid rgba(217,119,6,0.2); }
.badge-aktif   { background: #F5F3FF; color: #4C1D95; border: 1px solid rgba(124,58,237,0.18); }
.badge-belum   { background: #F9FAFB; color: #9CA3AF; border: 1px solid rgba(0,0,0,0.08); }

/* Action buttons */
.td-actions { display: flex; align-items: center; justify-content: flex-end; gap: 6px; }
.btn {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 5px 11px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 500;
    font-family: 'DM Sans', sans-serif;
    text-decoration: none;
    border: 1px solid;
    transition: all .15s;
    cursor: pointer;
}
.btn svg { width: 11px; height: 11px; }
.btn:hover { transform: translateY(-1px); text-decoration: none; }

.btn-lihat { background: #FFFBEB; color: #92400E; border-color: rgba(217,119,6,0.25); }
.btn-lihat:hover { background: #FEF3C7; border-color: #D97706; }

.btn-edit  { background: #EEF2FF; color: #3730A3; border-color: rgba(79,70,229,0.2); }
.btn-edit:hover  { background: #E0E7FF; border-color: #4F46E5; }

/* Empty */
.dg-empty { padding: 56px 20px; text-align: center; }
.dg-empty-icon {
    width: 44px; height: 44px; border-radius: 11px;
    background: #F9FAFB; border: 1px solid rgba(0,0,0,0.07);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
}
.dg-empty-icon svg { width: 20px; height: 20px; color: #9CA3AF; }
.dg-empty-title { font-size: 14px; font-weight: 500; color: #1A1C22; margin-bottom: 4px; }
.dg-empty-desc  { font-size: 13px; color: #9CA3AF; }
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

<div class="dg">

    {{-- ══════════════════════════════
         HEADER
    ══════════════════════════════ --}}
    <div class="dg-header">
        <div>
            <h1 class="dg-title">Data Guru</h1>
            <p class="dg-subtitle">Informasi lengkap seluruh tenaga pendidik yang terdaftar dalam sistem akademik.</p>
        </div>
    </div>


    {{-- ══════════════════════════════
         3 STAT CARDS
    ══════════════════════════════ --}}
    <div class="dg-label">Statistik</div>
    <div class="dg-stats">

        <div class="dg-stat s-blue">
            <div class="dg-stat-row">
                <div class="dg-stat-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <span class="dg-stat-pct">100%</span>
            </div>
            <div class="dg-stat-num">{{ $totalGuru }}</div>
            <div class="dg-stat-name">Total Guru</div>
            <div class="dg-stat-desc">Seluruh tenaga pendidik aktif</div>
            <div class="dg-bar"><div class="dg-bar-fill" style="width:100%"></div></div>
        </div>

        <div class="dg-stat s-green">
            <div class="dg-stat-row">
                <div class="dg-stat-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <polyline points="9 12 11 14 15 10"/>
                    </svg>
                </div>
                <span class="dg-stat-pct">{{ $pctNuptk }}%</span>
            </div>
            <div class="dg-stat-num">{{ $punyaNuptk }}</div>
            <div class="dg-stat-name">Memiliki NUPTK</div>
            <div class="dg-stat-desc">Terdaftar dalam database nasional</div>
            <div class="dg-bar"><div class="dg-bar-fill" style="width:100%"></div></div>
        </div>

        <div class="dg-stat s-violet">
            <div class="dg-stat-row">
                <div class="dg-stat-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <span class="dg-stat-pct">{{ $pctAkun }}%</span>
            </div>
            <div class="dg-stat-num">{{ $punyaAkun }}</div>
            <div class="dg-stat-name">Memiliki Akun</div>
            <div class="dg-stat-desc">Dapat mengakses sistem mandiri</div>
            <div class="dg-bar"><div class="dg-bar-fill" style="width:100%"></div></div>
        </div>

    </div>


    {{-- ══════════════════════════════
         4 BREAKDOWN CARDS
    ══════════════════════════════ --}}
    <div class="dg-label" style="margin-top:20px;">Rincian</div>
    <div class="dg-breakdown">

        <div class="dg-bcard bc-cyan">
            <div class="dg-bcard-ico">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <div>
                <div class="dg-bcard-num">{{ $lakiLaki }}</div>
                <div class="dg-bcard-label">Laki-laki</div>
            </div>
        </div>

        <div class="dg-bcard bc-rose">
            <div class="dg-bcard-ico">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <div>
                <div class="dg-bcard-num">{{ $perempuan }}</div>
                <div class="dg-bcard-label">Perempuan</div>
            </div>
        </div>

        <div class="dg-bcard bc-amber">
            <div class="dg-bcard-ico">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
            <div>
                <div class="dg-bcard-num">{{ $tidakNuptk }}</div>
                <div class="dg-bcard-label">Tanpa NUPTK</div>
            </div>
        </div>

        <div class="dg-bcard bc-red">
            <div class="dg-bcard-ico">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
            </div>
            <div>
                <div class="dg-bcard-num">{{ $tidakAkun }}</div>
                <div class="dg-bcard-label">Tanpa Akun</div>
            </div>
        </div>

    </div>


    {{-- ══════════════════════════════
         INFO BANNER
    ══════════════════════════════ --}}
    @if($tidakNuptk > 0 || $tidakAkun > 0)
    <div class="dg-banner">
        <div class="dg-banner-icon">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div>
            <div class="dg-banner-title">Perlu Perhatian</div>
            <div class="dg-banner-text">
                Terdapat <strong>{{ $tidakNuptk }} guru</strong> belum memiliki NUPTK
                dan <strong>{{ $tidakAkun }} guru</strong> belum memiliki akun login.
                Segera lengkapi agar pengelolaan akademik berjalan optimal.
            </div>
        </div>
    </div>
    @endif


    {{-- ══════════════════════════════
         TABLE
    ══════════════════════════════ --}}
    <div class="dg-label">Daftar Guru</div>
    <div class="dg-card">

        <div class="dg-card-top">
            <div class="dg-card-title">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
                Semua Guru
            </div>
            <span class="dg-card-count">{{ $totalGuru }} data</span>
        </div>

        <div class="dg-scroll">

            @if($totalGuru > 0)
            <table class="dg-table">
                <thead>
                    <tr>
                        <th style="width:46px;">#</th>
                        <th>Nama Guru</th>
                        <th>NUPTK</th>
                        <th>Jabatan</th>
                        <th>Akun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gurus as $index => $guru)
                    @php $av = 'av-' . ($index % 4); @endphp
                    <tr>

                        <td>
                            <span class="td-no">{{ $index + 1 }}</span>
                        </td>

                        <td>
                            <div class="td-guru">
                                <div class="td-avatar {{ $av }}">
                                    {{ strtoupper(substr($guru->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="td-name">{{ $guru->nama }}</div>
                                    @if($guru->user->email ?? null)
                                        <div class="td-email">{{ $guru->user->email }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($guru->nuptk)
                                <span class="badge badge-nuptk">
                                    <svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    <span class="td-nuptk">{{ $guru->nuptk }}</span>
                                </span>
                            @else
                                <span class="badge badge-no-nuptk">
                                    <svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                    Belum ada
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($guru->jabatan)
                                <span class="badge badge-jabatan">{{ $guru->jabatan }}</span>
                            @else
                                <span style="color:#D1D5DB;font-size:13px;">—</span>
                            @endif
                        </td>

                        <td>
                            @if($guru->user_id)
                                <span class="badge badge-aktif">
                                    <svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Aktif
                                </span>
                            @else
                                <span class="badge badge-belum">Belum</span>
                            @endif
                        </td>

                        <td>
                            <div class="td-actions">
                                <a href="{{ route('admin.guru.show', $guru->id) }}" class="btn btn-lihat">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    Lihat
                                </a>
                                <a href="{{ route('admin.guru.edit', $guru->id) }}" class="btn btn-edit">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
            <div class="dg-empty">
                <div class="dg-empty-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <p class="dg-empty-title">Belum ada data guru</p>
                <p class="dg-empty-desc">Data guru yang ditambahkan akan muncul di sini.</p>
            </div>
            @endif

        </div>
    </div>

</div>

@endsection