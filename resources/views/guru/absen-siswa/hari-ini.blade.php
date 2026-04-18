@extends('layouts.guru')

@section('title', 'Absensi Hari Ini')

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
    --slate: #475569;
    --slate-light: #F1F5F9;
    --radius-sm: 10px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04);
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

.hero-desc {
    font-size: 12px;
    opacity: 0.8;
    position: relative; z-index: 1;
    margin-bottom: 14px;
}

.hero-date-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.13);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 99px;
    padding: 5px 12px;
    font-size: 11px;
    font-weight: 700;
    color: white;
    position: relative; z-index: 1;
    backdrop-filter: blur(4px);
}

/* ---- BODY ---- */
.page-body {
    padding: 14px 12px;
    display: flex;
    flex-direction: column;
    gap: 12px;
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

/* ---- FILTER CARD ---- */
.filter-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 14px;
    box-shadow: var(--shadow-sm);
    animation: slideUp 0.35s ease both;
    animation-delay: 0.05s;
}

.filter-label {
    font-size: 11px;
    font-weight: 700;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
}

.filter-row {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.select-wrap {
    position: relative;
    flex: 1;
}

.filter-select {
    width: 100%;
    appearance: none;
    padding: 10px 36px 10px 12px;
    font-size: 13px;
    font-family: 'Nunito', sans-serif;
    color: var(--gray-800);
    background: var(--gray-50);
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-sm);
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
}

.filter-select:focus {
    border-color: var(--navy);
    background: white;
    box-shadow: 0 0 0 3px rgba(2,6,89,0.08);
}

.select-arrow {
    pointer-events: none;
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
}

.select-arrow svg { width: 14px; height: 14px; }

.btn-filter {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 16px;
    background: linear-gradient(135deg, var(--navy), #1a237e);
    color: white;
    border: none;
    border-radius: var(--radius-sm);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: opacity 0.15s, transform 0.15s;
    box-shadow: 0 3px 10px rgba(2,6,89,0.25);
    white-space: nowrap;
}

.btn-filter:hover   { opacity: 0.9; }
.btn-filter:active  { transform: scale(0.97); }

.btn-filter svg { width: 14px; height: 14px; }

/* ---- STAT CARDS ---- */
.stat-row {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 6px;
    margin-bottom: 2px;
}

.stat-card {
    border-radius: var(--radius-sm);
    padding: 10px 4px;
    text-align: center;
    border: 1.5px solid transparent;
}

.stat-card.green  { background: var(--green-light); border-color: #BBF7D0; }
.stat-card.blue   { background: var(--blue-light);  border-color: #BFDBFE; }
.stat-card.yellow { background: var(--yellow-light);border-color: #FDE68A; }
.stat-card.red    { background: var(--red-light);   border-color: #FECACA; }
.stat-card.gray   { background: var(--slate-light); border-color: var(--gray-200); }

.stat-num {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 20px;
    font-weight: 800;
    line-height: 1;
    display: block;
}

.stat-card.green  .stat-num { color: #16a34a; }
.stat-card.blue   .stat-num { color: #1d4ed8; }
.stat-card.yellow .stat-num { color: #b45309; }
.stat-card.red    .stat-num { color: var(--red); }
.stat-card.gray   .stat-num { color: var(--slate); }

.stat-lbl {
    font-size: 9px;
    font-weight: 700;
    margin-top: 4px;
    display: block;
}

.stat-card.green  .stat-lbl { color: #16a34a; }
.stat-card.blue   .stat-lbl { color: #1d4ed8; }
.stat-card.yellow .stat-lbl { color: #b45309; }
.stat-card.red    .stat-lbl { color: var(--red); }
.stat-card.gray   .stat-lbl { color: var(--slate); }

.stat-total {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--gray-50);
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-sm);
    padding: 8px 12px;
    margin-top: 8px;
}

.stat-total-label { font-size: 11px; font-weight: 600; color: var(--gray-500); }
.stat-total-val   { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 800; color: var(--gray-900); }

/* ---- LEGEND CARD ---- */
.legend-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 12px 14px;
    box-shadow: var(--shadow-sm);
}

.legend-title {
    font-size: 10px;
    font-weight: 700;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.legend-row {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}

.legend-item {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
}

.li-green  { background: var(--green-light); color: #16a34a; }
.li-blue   { background: var(--blue-light);  color: #1d4ed8; }
.li-yellow { background: var(--yellow-light);color: #b45309; }
.li-red    { background: var(--red-light);   color: var(--red); }
.li-slate  { background: var(--slate-light); color: var(--slate); }

/* ---- TABLE CARD ---- */
.table-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    animation: slideUp 0.4s ease 0.2s both;
}

.table-header {
    padding: 12px 16px;
    background: var(--gray-50);
    border-bottom: 1.5px solid var(--gray-100);
}

.table-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 800;
    color: var(--gray-900);
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead tr {
    background: linear-gradient(135deg, var(--navy), #1a237e);
}

th {
    padding: 10px 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 10px;
    font-weight: 700;
    color: rgba(255,255,255,0.85);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

th.left  { text-align: left; }
th.right { text-align: right; }
th.center{ text-align: center; }

tbody tr { border-bottom: 1px solid var(--gray-100); }
tbody tr:last-child { border-bottom: none; }
tbody tr:nth-child(even) { background: var(--gray-50); }

td {
    padding: 10px 12px;
    font-size: 12px;
    color: var(--gray-700);
}

.td-num {
    font-size: 10px;
    font-weight: 600;
    color: var(--gray-400);
    text-align: center;
    width: 36px;
}

.td-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: var(--gray-900);
}

.td-status { text-align: center; }

.badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
}

.badge-H { background: var(--green-light); color: #16a34a; }
.badge-I { background: var(--blue-light);  color: #1d4ed8; }
.badge-S { background: var(--yellow-light);color: #b45309; }
.badge-A { background: var(--red-light);   color: var(--red); }
.badge-B { background: var(--slate-light); color: var(--slate); }

.td-ket { color: var(--gray-500); font-size: 12px; }

.empty-td {
    padding: 40px 16px;
    text-align: center;
    color: var(--gray-400);
    font-size: 13px;
}

/* ---- EMPTY STATE ---- */
.empty-state {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 48px 24px;
    text-align: center;
    box-shadow: var(--shadow-sm);
    animation: slideUp 0.4s ease 0.1s both;
}

.empty-icon-wrap {
    width: 64px; height: 64px;
    border-radius: 50%;
    background: #EEF2FF;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
}

.empty-icon-wrap svg { width: 32px; height: 32px; color: var(--navy); }

.empty-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 15px;
    font-weight: 800;
    color: var(--gray-800);
    margin-bottom: 6px;
}

.empty-desc {
    font-size: 12px;
    color: var(--gray-500);
    line-height: 1.65;
    margin-bottom: 16px;
}

.empty-tip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #EEF2FF;
    color: var(--navy);
    border-radius: var(--radius-sm);
    padding: 7px 14px;
    font-size: 12px;
    font-weight: 700;
}

/* ======================================================
   DESKTOP ≥768px
   ====================================================== */
@media (min-width: 768px) {

    .page-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 24px 48px;
    }

    /* Hero */
    .hero-card {
        border-radius: var(--radius-lg);
        margin: 24px 0 0;
        padding: 32px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .hero-card::before { width: 260px; height: 260px; top: -80px; right: -60px; }

    .hero-sub    { font-size: 13px; }
    .hero-title  { font-size: 28px; }
    .hero-desc   { font-size: 14px; margin-bottom: 0; }

    .hero-date-chip {
        font-size: 13px;
        padding: 8px 16px;
        flex-shrink: 0;
        align-self: flex-end;
    }

    /* Body */
    .page-body { padding: 24px 0; gap: 16px; }

    .section-title { font-size: 15px; }

    /* Filter: horizontal */
    .filter-card { padding: 18px 20px; border-radius: var(--radius-lg); }

    .filter-row { flex-direction: row; align-items: center; }

    .btn-filter { padding: 11px 20px; font-size: 14px; }

    /* Stats */
    .stat-card { padding: 14px 8px; border-radius: var(--radius-md); }
    .stat-num  { font-size: 28px; }
    .stat-lbl  { font-size: 11px; }

    /* Legend */
    .legend-card { padding: 16px 20px; border-radius: var(--radius-lg); }
    .legend-item { font-size: 12px; padding: 5px 14px; }

    /* Table */
    .table-card { border-radius: var(--radius-lg); }
    .table-header { padding: 16px 20px; }
    .table-header-title { font-size: 15px; }

    th { padding: 12px 16px; font-size: 11px; }

    td { padding: 12px 16px; font-size: 13px; }
    .td-num  { font-size: 12px; }
    .td-name { font-size: 14px; }
    .badge   { font-size: 12px; padding: 4px 12px; }
}

html { scroll-behavior: smooth; }
body { overscroll-behavior-y: none; }
</style>

<div class="page-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div>
            <div class="hero-sub">Dashboard Guru</div>
            <div class="hero-title">📋 Absensi Hari Ini</div>
            <div class="hero-desc">Lihat rekap kehadiran siswa hari ini per kelas</div>
            <div class="hero-date-chip">📅 {{ now()->translatedFormat('d F Y') }}</div>
        </div>
    </div>

    <div class="page-body">

        {{-- ===== FILTER ===== --}}
        <div class="filter-card">
            <div class="filter-label">🔍 Pilih Kelas</div>
            <form action="{{ route('guru.absen-siswa.hari-ini') }}" method="GET">
                <div class="filter-row">
                    <div class="select-wrap">
                        <select name="rombel_id" class="filter-select">
                            <option value="">-- Pilih Rombel --</option>
                            @foreach($rombels as $rombel)
                                <option value="{{ $rombel->id }}"
                                    @if($selectedRombelId == $rombel->id) selected @endif>
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
                    <button type="submit" class="btn-filter">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>

        @if($selectedRombelId)

        @php
            $totalH   = $siswas->where('status','H')->count();
            $totalI   = $siswas->where('status','I')->count();
            $totalS   = $siswas->where('status','S')->count();
            $totalA   = $siswas->where('status','A')->count();
            $totalB   = $siswas->where('status','B')->count();
            $totalAll = $siswas->count();

            $statusMap = [
                'H' => ['label'=>'Hadir', 'badge'=>'badge-H'],
                'I' => ['label'=>'Izin',  'badge'=>'badge-I'],
                'S' => ['label'=>'Sakit', 'badge'=>'badge-S'],
                'A' => ['label'=>'Alpha', 'badge'=>'badge-A'],
                'B' => ['label'=>'Bolos', 'badge'=>'badge-B'],
            ];
        @endphp

        {{-- ===== SUMMARY ===== --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm" style="border-width:1.5px; animation: slideUp 0.4s ease 0.1s both;">
            <div class="section-title" style="margin-bottom:12px;">📊 Rekap Kehadiran</div>
            <div class="stat-row">
                <div class="stat-card green">
                    <span class="stat-num">{{ $totalH }}</span>
                    <span class="stat-lbl">Hadir</span>
                </div>
                <div class="stat-card blue">
                    <span class="stat-num">{{ $totalI }}</span>
                    <span class="stat-lbl">Izin</span>
                </div>
                <div class="stat-card yellow">
                    <span class="stat-num">{{ $totalS }}</span>
                    <span class="stat-lbl">Sakit</span>
                </div>
                <div class="stat-card red">
                    <span class="stat-num">{{ $totalA }}</span>
                    <span class="stat-lbl">Alpha</span>
                </div>
                <div class="stat-card gray">
                    <span class="stat-num">{{ $totalB }}</span>
                    <span class="stat-lbl">Bolos</span>
                </div>
            </div>
            <div class="stat-total">
                <span class="stat-total-label">Total Siswa</span>
                <span class="stat-total-val">{{ $totalAll }} siswa</span>
            </div>
        </div>

        {{-- ===== LEGEND ===== --}}
        <div class="legend-card" style="animation: slideUp 0.4s ease 0.15s both;">
            <div class="legend-title">Keterangan Status</div>
            <div class="legend-row">
                <span class="legend-item li-green">H &nbsp;Hadir</span>
                <span class="legend-item li-blue">I &nbsp;Izin</span>
                <span class="legend-item li-yellow">S &nbsp;Sakit</span>
                <span class="legend-item li-red">A &nbsp;Alpha</span>
                <span class="legend-item li-slate">B &nbsp;Bolos</span>
            </div>
        </div>

        {{-- ===== TABLE ===== --}}
        <div class="table-card">
            <div class="table-header">
                <div class="table-header-title">📋 Daftar Absensi Hari Ini</div>
            </div>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th class="center" style="width:44px;">No</th>
                            <th class="left">Nama Siswa</th>
                            <th class="center" style="width:110px;">Status</th>
                            {{-- Keterangan hanya tampil di desktop --}}
                            <th class="left hidden-mobile">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $index => $absen)
                        @php
                            $st = $statusMap[$absen->status] ?? ['label'=>'-','badge'=>'badge-B'];
                        @endphp
                        <tr>
                            <td class="td-num">{{ $index + 1 }}</td>
                            <td>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <div style="width:26px; height:26px; border-radius:8px; background:#EEF2FF; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                        <svg style="width:13px; height:13px; color:var(--navy);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span class="td-name">{{ $absen->siswa->nama_siswa ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="td-status">
                                <span class="badge {{ $st['badge'] }}">
                                    {{ $absen->status }} &nbsp;{{ $st['label'] }}
                                </span>
                            </td>
                            <td class="td-ket hidden-mobile">{{ $absen->keterangan ?: '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="empty-td">
                                Belum ada absensi hari ini untuk kelas ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @else

        {{-- ===== EMPTY STATE ===== --}}
        <div class="empty-state">
            <div class="empty-icon-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="empty-title">Pilih Kelas Terlebih Dahulu</div>
            <div class="empty-desc">
                Gunakan filter di atas untuk memilih kelas<br>dan melihat absensi hari ini.
            </div>
            <div class="empty-tip">💡 Pilih rombel lalu klik Tampilkan</div>
        </div>

        @endif

    </div>
</div>

<style>
/* Kolom keterangan hanya tampil di desktop */
.hidden-mobile { display: none; }
@media (min-width: 768px) {
    .hidden-mobile { display: table-cell; }
}
</style>

@endsection