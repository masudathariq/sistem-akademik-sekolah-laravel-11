@extends('layouts.staff_tu')

@section('title', 'Data Mata Pelajaran')

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

/* ── BUTTON CREATE ── */
.btn-create {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--navy-md); color: white;
    padding: 8px 18px; border-radius: 8px;
    font-size: 13px; font-weight: 600; text-decoration: none;
    transition: all .15s;
}
.btn-create:hover {
    background: var(--navy);
    transform: translateY(-1px);
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
.ta-table thead th:last-child { text-align: right; }
.ta-table tbody tr {
    border-bottom: 1px solid #f1f5f9; transition: background .12s;
}
.ta-table tbody tr:last-child { border-bottom: none; }
.ta-table tbody tr:hover { background: #f8fafc; }
.ta-table td {
    padding: .875rem 1.25rem; vertical-align: middle;
    font-size: 13px; color: var(--text);
}
.ta-table td:last-child { text-align: right; }
.td-no {
    font-size: 12px; color: var(--hint);
    font-weight: 500; width: 50px; text-align: center;
}
.td-mono {
    font-family: 'Courier New', monospace;
    font-size: 12px; font-weight: 600;
    background: var(--gray-bg);
    padding: 4px 10px;
    border-radius: 6px;
    display: inline-block;
    color: var(--navy-md);
}

/* ── AVATAR ── */
.tbl-avatar {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 8px;
    font-size: 12px; font-weight: 600; flex-shrink: 0;
    background: var(--navy-lt); border: 1px solid #bfdbfe; color: var(--navy-md);
}
.td-nama {
    font-size: 14px; font-weight: 600; color: var(--text);
}

/* ── ACTION BUTTONS ── */
.tbl-actions { display: inline-flex; align-items: center; gap: 8px; }
.btn-sm {
    display: inline-flex; align-items: center; gap: 5px;
    padding: .375rem .8rem; border-radius: 7px;
    font-size: 12px; font-weight: 600; cursor: pointer;
    text-decoration: none; transition: background .15s, transform .1s;
    border: 1px solid; background: none;
    font-family: 'IBM Plex Sans', sans-serif;
}
.btn-sm:active { transform: scale(.96); }
.btn-edit  { color: var(--amber); border-color: var(--amber-bd); background: var(--amber-lt); }
.btn-edit:hover  { background: #fef3c7; }
.btn-hapus { color: var(--red); border-color: var(--red-bd); background: var(--red-lt); }
.btn-hapus:hover { background: #fee2e2; }

/* ── EMPTY STATE ── */
.empty-state { text-align: center; padding: 2.5rem 1rem; }
.empty-icon {
    width: 48px; height: 48px; background: var(--gray-bg);
    border-radius: 12px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.empty-state strong { display: block; font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.empty-state p { font-size: 13px; color: var(--muted); }

/* ── MOBILE VIEW (CARD STYLE) ── */
.mobile-list { display: none; }
.mobile-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 12px; padding: 1rem; margin-bottom: 12px;
    box-shadow: var(--shadow);
}
.mobile-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--border);
}
.mobile-avatar {
    width: 48px; height: 48px; border-radius: 12px;
    background: var(--navy-lt); display: flex;
    align-items: center; justify-content: center;
    font-size: 18px; font-weight: 700; color: var(--navy-md);
}
.mobile-info h4 {
    font-size: 14px; font-weight: 700; color: var(--text);
    margin: 0 0 4px;
}
.mobile-code {
    font-size: 10px; font-family: monospace;
    background: var(--gray-bg); padding: 2px 8px;
    border-radius: 20px; color: var(--navy-md);
}
.mobile-no {
    font-size: 11px; font-weight: 600;
    background: var(--gray-bg); padding: 2px 8px;
    border-radius: 20px; color: var(--hint);
}
.mobile-actions {
    display: flex; gap: 8px; margin-top: 12px;
    padding-top: 10px; border-top: 1px solid var(--border);
}
.mobile-actions .btn-sm { flex: 1; justify-content: center; }

@media (max-width: 768px) {
    .rb-page { padding: 1rem; }
    .desktop-table { display: none; }
    .mobile-list { display: block; }
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .stat-val { font-size: 22px; }
    .top-bar { flex-direction: column; align-items: flex-start; }
    .btn-create { width: 100%; justify-content: center; }
}
</style>

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
                <h1>Data Mata Pelajaran</h1>
                <p>Kelola seluruh mata pelajaran yang tersedia &mdash; <strong>{{ $mapels->count() }} Mata Pelajaran</strong></p>
            </div>
        </div>
        <a href="{{ route('staff_tu.mata_pelajaran.create') }}" class="btn-create">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Mapel
        </a>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    @php
        $totalMapel = $mapels->count();
        $prefixCounts = [
            'IPA' => $mapels->filter(fn($m) => str_contains($m->nama_mapel, 'IPA'))->count(),
            'IPS' => $mapels->filter(fn($m) => str_contains($m->nama_mapel, 'IPS'))->count(),
            'Matematika' => $mapels->filter(fn($m) => str_contains($m->nama_mapel, 'Matematika') || str_contains($m->nama_mapel, 'MTK'))->count(),
        ];
        $kelompokTerbanyak = array_keys($prefixCounts, max($prefixCounts))[0] ?? '-';
    @endphp
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Mapel</div>
            <div class="stat-val blue">{{ $totalMapel }}</div>
            <div class="stat-sub">mata pelajaran</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Kelompok IPA</div>
            <div class="stat-val green">{{ $prefixCounts['IPA'] }}</div>
            <div class="stat-sub">mata pelajaran</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Kelompok IPS</div>
            <div class="stat-val green">{{ $prefixCounts['IPS'] }}</div>
            <div class="stat-sub">mata pelajaran</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Mapel Terbanyak</div>
            <div class="stat-val amber">{{ $kelompokTerbanyak }}</div>
            <div class="stat-sub">kelompok terbanyak</div>
        </div>
    </div>

    {{-- ═══ TABLE CARD (DESKTOP) ═══ --}}
    <div class="table-card desktop-table">
        <div class="table-card-header">
            <span class="table-card-title">Daftar Mata Pelajaran</span>
            <span class="table-count">{{ $totalMapel }} mapel</span>
        </div>

        <table class="ta-table">
            <thead>
                <tr>
                    <th style="width:52px;text-align:center">No</th>
                    <th>Kode Mapel</th>
                    <th>Nama Mata Pelajaran</th>
                    <th style="width:160px;text-align:right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mapels as $mapel)
                <tr>
                    <td class="td-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                    <td><span class="td-mono">{{ $mapel->kode_mapel }}</span></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span class="tbl-avatar">
                                {{ strtoupper(substr($mapel->nama_mapel, 0, 1)) }}
                            </span>
                            <span class="td-nama">{{ $mapel->nama_mapel }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('staff_tu.mata_pelajaran.edit', $mapel->id) }}" class="btn-sm btn-edit">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('staff_tu.mata_pelajaran.destroy', $mapel->id) }}"
                                  method="POST" style="margin:0;"
                                  onsubmit="return confirm('Yakin ingin menghapus mata pelajaran {{ $mapel->nama_mapel }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-hapus">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6"/><path d="M14 11v6"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <strong>Belum Ada Data Mata Pelajaran</strong>
                            <p>Klik tombol "Tambah Mapel" untuk menambahkan mata pelajaran baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ═══ MOBILE VIEW (CARD STYLE) ═══ --}}
    <div class="mobile-list">
        @forelse($mapels as $mapel)
        <div class="mobile-card">
            <div class="mobile-header">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div class="mobile-avatar">
                        {{ strtoupper(substr($mapel->nama_mapel, 0, 1)) }}
                    </div>
                    <div class="mobile-info">
                        <h4>{{ $mapel->nama_mapel }}</h4>
                        <span class="mobile-code">{{ $mapel->kode_mapel }}</span>
                    </div>
                </div>
                <span class="mobile-no">#{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="mobile-actions">
                <a href="{{ route('staff_tu.mata_pelajaran.edit', $mapel->id) }}" class="btn-sm btn-edit" style="flex:1; justify-content: center;">
                    ✏️ Edit
                </a>
                <form action="{{ route('staff_tu.mata_pelajaran.destroy', $mapel->id) }}"
                      method="POST" style="margin:0; flex:1;"
                      onsubmit="return confirm('Yakin ingin menghapus mata pelajaran {{ $mapel->nama_mapel }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-sm btn-hapus" style="width:100%; justify-content: center;">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <strong>Belum Ada Data Mata Pelajaran</strong>
            <p>Klik tombol "Tambah Mapel" untuk menambahkan mata pelajaran baru.</p>
        </div>
        @endforelse
    </div>

</div>

@endsection