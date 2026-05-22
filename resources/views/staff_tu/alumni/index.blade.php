@extends('layouts.staff_tu')

@section('title', 'Data Alumni')

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

/* ── FLASH ── */
.flash-success {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--green-lt); border: 1px solid var(--green-bd);
    border-radius: 8px; font-size: 13px; font-weight: 600; color: var(--green);
    margin-bottom: 1.25rem;
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
.stat-val.pink  { color: var(--pink); }
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

/* ── TABLE ── */
.ta-table { width: 100%; border-collapse: collapse; }
.ta-table thead th {
    padding: .7rem 1.25rem; text-align: left;
    font-size: 11px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .06em;
    background: var(--gray-bg); border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.ta-table thead th.th-center { text-align: center; }
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
.ta-table td.td-center { text-align: center; }

.td-no {
    font-size: 12px; color: var(--hint);
    font-weight: 500; width: 50px; text-align: center;
}
.td-mono { font-family: 'Courier New', monospace; font-size: 12.5px; color: var(--muted); }
.td-mono-sub { font-size: 11px; color: var(--hint); margin-top: 2px; font-family: 'Courier New', monospace; }
.td-nama { font-size: 14px; font-weight: 600; color: var(--text); }

/* ── AVATAR ── */
.tbl-avatar {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 8px;
    font-size: 12px; font-weight: 600; flex-shrink: 0;
}
.av-l { background: var(--navy-lt); border: 1px solid #bfdbfe; color: var(--navy-md); }
.av-p { background: var(--pink-lt); border: 1px solid var(--pink-bd); color: var(--pink); }

/* ── JK BADGE ── */
.jk-badge {
    display: inline-flex; align-items: center;
    padding: 2px 10px; border-radius: 99px;
    font-size: 12px; font-weight: 600; white-space: nowrap;
}
.jk-l { background: var(--navy-lt); border: 1px solid #bfdbfe; color: var(--navy-md); }
.jk-p { background: var(--pink-lt); border: 1px solid var(--pink-bd); color: var(--pink); }

/* ── ORTU STACK ── */
.ortu-label { font-size: 10px; color: var(--hint); margin-bottom: 1px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; }
.ortu-value { font-size: 12.5px; color: var(--text); margin-bottom: 5px; }
.ortu-value:last-child { margin-bottom: 0; }

.td-wrap { max-width: 160px; font-size: 12.5px; color: var(--muted); word-break: break-word; line-height: 1.5; }
.td-muted { font-size: 12.5px; color: var(--muted); white-space: nowrap; line-height: 1.6; }

/* ── YEAR BADGE ── */
.year-badge {
    display: inline-flex; align-items: center;
    padding: 3px 10px; border-radius: 99px;
    font-size: 12px; font-weight: 600;
    background: var(--amber-lt); border: 1px solid var(--amber-bd); color: var(--amber);
    white-space: nowrap;
}

/* ── ACTION BUTTONS ── */
.tbl-actions { display: inline-flex; align-items: center; gap: 6px; }
.btn-sm {
    display: inline-flex; align-items: center; gap: 5px;
    padding: .375rem .8rem; border-radius: 7px;
    font-size: 12.5px; font-weight: 600; cursor: pointer;
    text-decoration: none; transition: background .15s, transform .1s;
    border: 1px solid; background: none;
    font-family: 'IBM Plex Sans', sans-serif;
}
.btn-sm:active { transform: scale(.96); }
.btn-view  { color: var(--muted); border-color: var(--border); background: var(--gray-bg); }
.btn-view:hover  { background: #f1f5f9; }
.btn-hapus { color: var(--red); border-color: var(--red-bd); background: var(--red-lt); }
.btn-hapus:hover { background: #fee2e2; }

/* ── EMPTY ── */
.empty-state { text-align: center; padding: 2.5rem 1rem; }
.empty-icon {
    width: 48px; height: 48px; background: var(--gray-bg);
    border-radius: 12px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.empty-state strong { display: block; font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.empty-state p { font-size: 13px; color: var(--muted); }
</style>

<div class="rb-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Data Alumni</h1>
                <p>Daftar seluruh alumni yang telah lulus dari sekolah &mdash; <strong>{{ $alumnis->count() }} Alumni</strong></p>
            </div>
        </div>
    </div>

    {{-- ═══ FLASH ═══ --}}
    @if(session('success'))
    <div class="flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ═══ STAT CARDS ═══ --}}
    @php
        $totalAlumni = $alumnis->count();
        $totalL      = $alumnis->where('jenis_kelamin', 'L')->count();
        $totalP      = $alumnis->where('jenis_kelamin', 'P')->count();
        $tahunList   = $alumnis->pluck('tahun_lulus')->unique()->filter()->sort();
        $tahunTerakhir = $tahunList->last() ?? '-';
    @endphp
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Alumni</div>
            <div class="stat-val blue">{{ $totalAlumni }}</div>
            <div class="stat-sub">semua angkatan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Laki-laki</div>
            <div class="stat-val blue">{{ $totalL }}</div>
            <div class="stat-sub">alumni laki-laki</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Perempuan</div>
            <div class="stat-val pink">{{ $totalP }}</div>
            <div class="stat-sub">alumni perempuan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Lulus Terakhir</div>
            <div class="stat-val amber">{{ $tahunTerakhir }}</div>
            <div class="stat-sub">tahun kelulusan</div>
        </div>
    </div>

    {{-- ═══ TABLE CARD ═══ --}}
    <div class="table-card">
        <div class="table-card-header">
            <span class="table-card-title">Daftar Alumni</span>
            <span class="table-count">{{ $totalAlumni }} data</span>
        </div>

        <table class="ta-table">
            <thead>
                <tr>
                    <th style="width:52px;text-align:center">No</th>
                    <th>NISN / NIS</th>
                    <th>Nama Siswa</th>
                    <th>Tempat, Tgl Lahir</th>
                    <th class="th-center">JK</th>
                    <th>Alamat</th>
                    <th>Orang Tua / Wali</th>
                    <th class="th-center">Th. Lulus</th>
                    <th style="width:160px;text-align:right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumnis as $alumni)
                <tr>
                    <td class="td-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="td-mono">{{ $alumni->nisn }}</div>
                        <div class="td-mono-sub">{{ $alumni->nis }}</div>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span class="tbl-avatar {{ $alumni->jenis_kelamin == 'L' ? 'av-l' : 'av-p' }}">
                                {{ strtoupper(substr($alumni->nama_siswa, 0, 1)) }}
                            </span>
                            <span class="td-nama">{{ $alumni->nama_siswa }}</span>
                        </div>
                    </td>
                    <td class="td-muted">
                        {{ $alumni->tempat_lahir }},<br>
                        {{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d/m/Y') }}
                    </td>
                    <td class="td-center">
                        <span class="jk-badge {{ $alumni->jenis_kelamin == 'L' ? 'jk-l' : 'jk-p' }}">
                            {{ $alumni->jenis_kelamin == 'L' ? 'L' : 'P' }}
                        </span>
                    </td>
                    <td class="td-wrap">{{ $alumni->alamat ?? '-' }}</td>
                    <td style="min-width:150px;">
                        <div class="ortu-label">Ayah</div>
                        <div class="ortu-value">{{ $alumni->ayah ?? '-' }}</div>
                        <div class="ortu-label">Ibu</div>
                        <div class="ortu-value">{{ $alumni->ibu ?? '-' }}</div>
                        @if($alumni->wali)
                        <div class="ortu-label">Wali</div>
                        <div class="ortu-value">{{ $alumni->wali }}</div>
                        @endif
                    </td>
                    <td class="td-center">
                        <span class="year-badge">{{ $alumni->tahun_lulus }}</span>
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('staff_tu.alumni.show', $alumni->id) }}" class="btn-sm btn-view">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                </svg>
                                Lihat
                            </a>
                            <form action="{{ route('staff_tu.alumni.destroy', $alumni->id) }}"
                                  method="POST" style="margin:0;"
                                  onsubmit="return confirm('Yakin ingin menghapus {{ $alumni->nama_siswa }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-hapus">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6"/><path d="M14 11v6"/>
                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round">
                                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                                </svg>
                            </div>
                            <strong>Belum Ada Data Alumni</strong>
                            <p>Alumni yang lulus akan muncul di sini secara otomatis.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection