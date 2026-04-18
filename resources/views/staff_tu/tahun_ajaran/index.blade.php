@extends('layouts.staff_tu')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --navy:     #1e3a8a;
    --navy-md:  #1d4ed8;
    --navy-lt:  #dbeafe;
    --accent:   #2563eb;
    --green:    #16a34a;
    --green-lt: #f0fdf4;
    --amber:    #d97706;
    --amber-lt: #fffbeb;
    --gray-bg:  #f8fafc;
    --border:   #e2e8f0;
    --text:     #1e293b;
    --muted:    #64748b;
    --radius:   14px;
    --shadow:   0 1px 4px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.04);
}

* { box-sizing: border-box; }

.ta-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--gray-bg);
    min-height: 100vh;
    padding: .875rem;
    padding-bottom: 5rem;
}

/* ── HERO HEADER ── */
.ta-hero {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-md) 100%);
    border-radius: var(--radius);
    padding: 1.125rem;
    color: #fff;
    margin-bottom: 1rem;
    position: relative;
    overflow: hidden;
}
.ta-hero::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 140px; height: 140px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    pointer-events: none;
}
.ta-hero::after {
    content: '';
    position: absolute;
    bottom: -50px; right: 60px;
    width: 100px; height: 100px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
    pointer-events: none;
}
.ta-hero-inner {
    position: relative;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: .875rem;
    flex-wrap: wrap;
}
.ta-hero-icon {
    width: 38px; height: 38px;
    background: rgba(255,255,255,.15);
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    margin-bottom: .625rem;
}
.ta-hero h1 {
    font-size: 1.125rem;
    font-weight: 800;
    margin: 0 0 .25rem;
    letter-spacing: -.02em;
}
.ta-hero p {
    font-size: .75rem;
    color: rgba(255,255,255,.72);
    margin: 0;
    line-height: 1.55;
}
.ta-hero-btn {
    flex-shrink: 0;
    align-self: flex-start;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: .45rem .875rem;
    background: #fff;
    color: var(--navy);
    border-radius: 8px;
    font-size: .75rem;
    font-weight: 700;
    text-decoration: none;
    transition: transform .15s, box-shadow .15s;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0,0,0,.15);
}
.ta-hero-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(0,0,0,.2); }
.ta-hero-btn:active { transform: scale(.97); }

/* ── INFO BOX ── */
.info-box {
    background: var(--amber-lt);
    border: 1px solid #fcd34d;
    border-radius: 10px;
    padding: .75rem .875rem;
    display: flex;
    gap: .625rem;
    align-items: flex-start;
    margin-bottom: 1rem;
}
.info-box-icon { flex-shrink: 0; margin-top: 1px; }
.info-box-title {
    font-size: .75rem;
    font-weight: 700;
    color: #92400e;
    margin-bottom: .2rem;
}
.info-box-list {
    margin: 0;
    padding-left: .875rem;
    font-size: .7125rem;
    color: #78350f;
    line-height: 1.85;
}

/* ── FLASH ── */
.flash-success {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .75rem .875rem;
    background: var(--green-lt);
    border: 1px solid #86efac;
    border-radius: 10px;
    font-size: .75rem;
    color: var(--green);
    font-weight: 600;
    margin-bottom: 1rem;
}

/* ── SECTION LABEL ── */
.section-label {
    font-size: .7rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: .5rem;
}

/* ════════════════
   MOBILE CARDS
════════════════ */
.mobile-list { display: flex; flex-direction: column; gap: .625rem; }

.ta-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: .875rem;
    box-shadow: var(--shadow);
    transition: box-shadow .2s;
}
.ta-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,.1); }

.ta-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: .625rem;
    margin-bottom: .75rem;
}
.ta-card-year {
    font-size: .9375rem;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -.01em;
    margin-bottom: .175rem;
}
.ta-card-sem {
    font-size: .7125rem;
    color: var(--muted);
}

.badge-active {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    background: var(--green-lt);
    border: 1px solid #86efac;
    color: var(--green);
    font-size: .65rem;
    font-weight: 700;
    border-radius: 99px;
    white-space: nowrap;
    flex-shrink: 0;
}
.badge-active-dot {
    width: 5px; height: 5px;
    background: var(--green);
    border-radius: 50%;
    animation: blink 2s infinite;
}
.badge-inactive {
    display: inline-flex;
    align-items: center;
    padding: 3px 9px;
    background: #f1f5f9;
    color: #032CA6;
    font-size: .65rem;
    font-weight: 600;
    border-radius: 99px;
    white-space: nowrap;
    flex-shrink: 0;
}
@keyframes blink {
    0%,100% { opacity:1; } 50% { opacity:.35; }
}

.ta-card.is-active {
    border-color: #86efac;
    background: linear-gradient(to bottom right, #fff, #f0fdf4);
}

.ta-card-divider { border: none; border-top: 1px solid var(--border); margin: .625rem 0; }

.ta-card-actions { display: flex; gap: .5rem; }

.btn-edit {
    flex: 1;
    display: flex; align-items: center; justify-content: center; gap: 4px;
    padding: .525rem;
    background: var(--amber-lt);
    border: 1px solid #fcd34d;
    color: var(--amber);
    border-radius: 8px;
    font-size: .75rem;
    font-weight: 700;
    text-decoration: none;
    transition: background .15s;
}
.btn-edit:hover { background: #fef3c7; }

.btn-setaktif {
    flex: 1;
    display: flex; align-items: center; justify-content: center; gap: 4px;
    padding: .525rem;
    background: var(--green-lt);
    border: 1px solid #86efac;
    color: var(--green);
    border-radius: 8px;
    font-size: .75rem;
    font-weight: 700;
    cursor: pointer;
    transition: background .15s;
    width: 100%;
}
.btn-setaktif:hover { background: #dcfce7; }

/* ════════════════
   DESKTOP TABLE
════════════════ */
.ta-table-wrap {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}
.ta-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .875rem;
}
.ta-table thead tr {
    background: linear-gradient(90deg, var(--navy) 0%, var(--navy-md) 100%);
}
.ta-table thead th {
    padding: .9rem 1.25rem;
    text-align: left;
    font-size: .7rem;
    font-weight: 700;
    color: rgba(255,255,255,.85);
    text-transform: uppercase;
    letter-spacing: .07em;
    white-space: nowrap;
}
.ta-table thead th:last-child { text-align: center; }

.ta-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background .15s;
}
.ta-table tbody tr:last-child { border-bottom: none; }
.ta-table tbody tr:hover { background: #f8fafc; }
.ta-table tbody tr.row-active { background: #f0fdf4; }
.ta-table tbody tr.row-active:hover { background: #dcfce7; }

.ta-table td {
    padding: 1rem 1.25rem;
    color: var(--text);
    vertical-align: middle;
}
.ta-table td:last-child { text-align: center; }

.td-year { font-weight: 700; font-size: .9375rem; letter-spacing: -.01em; }
.td-sem  { color: var(--muted); font-size: .8125rem; }

.tbl-actions { display: inline-flex; gap: .5rem; align-items: center; }
.tbl-btn-edit {
    display: inline-flex; align-items: center; gap: 4px;
    padding: .4rem .875rem;
    background: var(--amber-lt);
    border: 1px solid #fcd34d;
    color: var(--amber);
    border-radius: 7px;
    font-size: .75rem;
    font-weight: 700;
    text-decoration: none;
    transition: background .15s;
}
.tbl-btn-edit:hover { background: #fef3c7; }

.tbl-btn-aktif {
    display: inline-flex; align-items: center; gap: 4px;
    padding: .4rem .875rem;
    background: var(--green-lt);
    border: 1px solid #86efac;
    color: var(--green);
    border-radius: 7px;
    font-size: .75rem;
    font-weight: 700;
    cursor: pointer;
    transition: background .15s;
}
.tbl-btn-aktif:hover { background: #dcfce7; }

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}
.empty-state-icon {
    width: 52px; height: 52px;
    background: var(--navy-lt);
    border-radius: 14px;
    display: inline-flex; align-items: center; justify-content: center;
    margin-bottom: .875rem;
}
.empty-state p { color: var(--muted); font-size: .8125rem; margin: .25rem 0 0; }
.empty-state strong { color: var(--text); display: block; font-size: .875rem; margin-bottom: .2rem; }

/* ── RESPONSIVE VISIBILITY ── */
.mobile-only  { display: block; }
.desktop-only { display: none; }

@media (min-width: 640px) {
    .mobile-only  { display: none; }
    .desktop-only { display: block; }

    .ta-page   { padding: 1.5rem; }
    .ta-hero   { padding: 1.75rem 2rem; margin-bottom: 1.25rem; }
    .ta-hero h1 { font-size: 1.5rem; }
    .ta-hero p  { font-size: .8125rem; }
    .ta-hero-btn { font-size: .8125rem; padding: .55rem 1.1rem; border-radius: 9px; }
    .ta-hero-icon { width: 44px; height: 44px; border-radius: 10px; margin-bottom: .875rem; }

    .info-box { padding: .875rem 1rem; margin-bottom: 1.25rem; }
    .info-box-title { font-size: .8125rem; }
    .info-box-list  { font-size: .775rem; padding-left: 1rem; }

    .flash-success { font-size: .8125rem; padding: .875rem 1rem; margin-bottom: 1.25rem; }

    .section-label { font-size: .75rem; margin-bottom: .625rem; }

    .badge-active  { font-size: .7rem; padding: 4px 10px; }
    .badge-inactive { font-size: .7rem; padding: 4px 10px; }
    .badge-active-dot { width: 6px; height: 6px; }
}

@media (min-width: 1024px) {
    .ta-page { padding: 2rem; }
}
</style>

<div class="ta-page">

    {{-- ═══════ HERO HEADER ═══════ --}}
    <div class="ta-hero">
        <div class="ta-hero-inner">
            <div>
                <div class="ta-hero-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
                    </svg>
                </div>
                <h1>Tahun Ajaran</h1>
                <p>Kelola periode dan semester aktif sekolah.<br>Hanya satu tahun ajaran yang dapat aktif pada satu waktu.</p>
            </div>
            <a href="{{ url('/staff_tu/tahun-ajaran/create') }}" class="ta-hero-btn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah
            </a>
        </div>
    </div>

    {{-- ═══════ FLASH ═══════ --}}
    @if(session('success'))
    <div class="flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ═══════ INFO BOX ═══════ --}}
    <div class="info-box">
        <div class="info-box-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div>
            <div class="info-box-title">Cara kerja Tahun Ajaran</div>
            <ul class="info-box-list">
                <li>Tambahkan tahun ajaran beserta semesternya (Ganjil / Genap).</li>
                <li>Klik <strong>Set Aktif</strong> untuk menjadikan periode tersebut sebagai acuan seluruh data siswa, absensi, dan gaji.</li>
                <li>Hanya <strong>satu</strong> periode yang boleh aktif; periode lain akan otomatis dinonaktifkan.</li>
                <li>Gunakan <strong>Edit</strong> untuk memperbaiki nama atau semester jika terjadi kesalahan input.</li>
            </ul>
        </div>
    </div>

    {{-- ═══════ MOBILE CARDS ═══════ --}}
    <div class="mobile-only">
        <div class="section-label">Daftar Tahun Ajaran</div>
        <div class="mobile-list">
            @forelse($data as $item)
            <div class="ta-card {{ $item->is_active ? 'is-active' : '' }}">
                <div class="ta-card-top">
                    <div>
                        <div class="ta-card-year">{{ $item->tahun_ajaran }}</div>
                        <div class="ta-card-sem">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:3px;"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Semester {{ $item->semester }}
                        </div>
                    </div>
                    @if($item->is_active)
                        <span class="badge-active">
                            <span class="badge-active-dot"></span>
                            Aktif
                        </span>
                    @else
                        <span class="badge-inactive">Tidak Aktif</span>
                    @endif
                </div>

                <hr class="ta-card-divider">

                <div class="ta-card-actions">
                    <a href="{{ url('/staff_tu/tahun-ajaran/'.$item->id.'/edit') }}" class="btn-edit">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit
                    </a>

                    @if(!$item->is_active)
                    <form action="{{ url('/staff_tu/tahun-ajaran/'.$item->id.'/aktif') }}" method="POST" style="flex:1;display:flex;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn-setaktif">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Set Aktif
                        </button>
                    </form>
                    @else
                    <div style="flex:1;display:flex;align-items:center;justify-content:center;
                                font-size:.7rem;color:var(--green);font-weight:700;gap:3px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        Periode Aktif
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="ta-card">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <strong>Belum ada data</strong>
                    <p>Tambahkan tahun ajaran pertama untuk memulai.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ═══════ DESKTOP TABLE ═══════ --}}
    <div class="desktop-only">
        <div class="section-label">Daftar Tahun Ajaran</div>
        <div class="ta-table-wrap">
            <table class="ta-table">
                <thead>
                    <tr>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr class="{{ $item->is_active ? 'row-active' : '' }}">
                        <td class="td-year">{{ $item->tahun_ajaran }}</td>
                        <td class="td-sem">Semester {{ $item->semester }}</td>
                        <td>
                            @if($item->is_active)
                                <span class="badge-active">
                                    <span class="badge-active-dot"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="badge-inactive">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="tbl-actions">
                                <a href="{{ url('/staff_tu/tahun-ajaran/'.$item->id.'/edit') }}" class="tbl-btn-edit">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                @if(!$item->is_active)
                                <form action="{{ url('/staff_tu/tahun-ajaran/'.$item->id.'/aktif') }}" method="POST" style="margin:0;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="tbl-btn-aktif">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                        Set Aktif
                                    </button>
                                </form>
                                @else
                                <span style="font-size:.75rem;color:var(--green);font-weight:600;padding:.4rem .5rem;">
                                    ✓ Periode Aktif
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </div>
                                <strong>Belum ada data tahun ajaran</strong>
                                <p>Klik tombol "Tambah" di atas untuk menambahkan periode pertama.</p>
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