@extends('layouts.staff_tu')

@section('title', 'Data Alumni')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');

:root {
    --navy: #020659;
    --navy-mid: #0A0F7A;
    --navy-light: #E8EAFF;
    --gray-50: #F8FAFC;
    --gray-100: #F1F5F9;
    --gray-200: #E2E8F0;
    --gray-400: #94A3B8;
    --gray-500: #64748B;
    --gray-700: #334155;
    --gray-900: #0F172A;
    --success: #059669;
    --success-light: #ECFDF5;
    --danger: #DC2626;
    --danger-light: #FEF2F2;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

.page-wrap {
    font-family: 'Nunito', sans-serif;
    background: var(--gray-50);
    min-height: 100vh;
    padding-bottom: 40px;
}

/* ===== HEADER ===== */
.page-header {
    background: var(--navy);
    padding: 16px 16px 24px;
    border-radius: 0 0 28px 28px;
    position: sticky; top: 0; z-index: 20;
    box-shadow: 0 4px 24px rgba(2,6,89,0.25);
}
.header-top { display: flex; align-items: center; gap: 10px; margin-bottom: 3px; }
.header-icon {
    width: 30px; height: 30px; background: rgba(255,255,255,0.15);
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.header-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 16px; font-weight: 800; color: white; }
.header-subtitle { color: rgba(255,255,255,0.65); font-size: 11px; margin-bottom: 10px; padding-left: 40px; }
.header-chip {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,0.13); border: 1px solid rgba(255,255,255,0.2);
    border-radius: 20px; padding: 4px 11px;
    font-size: 11px; font-weight: 600; color: white; margin-left: 40px;
}

/* ===== CONTENT ===== */
.content-area {
    max-width: 1100px; margin: 0 auto;
    padding: 14px 14px 0;
    display: flex; flex-direction: column; gap: 12px;
}

/* ===== SECTION LABEL ===== */
.section-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: var(--gray-400); padding: 0 2px;
}

/* ===== NOTIFIKASI ===== */
.notif {
    border-radius: 12px; padding: 12px 14px;
    display: flex; align-items: flex-start; gap: 10px;
    font-size: 13px; line-height: 1.5;
    animation: slideUp 0.3s ease both;
}
.notif.success { background: var(--success-light); border-left: 4px solid var(--success); color: #065F46; }
.notif svg { width: 17px; height: 17px; flex-shrink: 0; margin-top: 1px; }
.notif strong { display: block; font-weight: 700; margin-bottom: 1px; }

/* ════════════════════════
   MOBILE: CARD LIST
════════════════════════ */
.mobile-only  { display: block; }
.desktop-only { display: none; }
@media (min-width: 768px) {
    .mobile-only  { display: none; }
    .desktop-only { display: block; }
}

.card-list { display: flex; flex-direction: column; gap: 10px; }

.alumni-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-left: 4px solid var(--navy);
    border-radius: 14px;
    padding: 13px 14px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    transition: box-shadow 0.2s;
    animation: slideUp 0.35s ease both;
}
.alumni-card:hover { box-shadow: 0 4px 16px rgba(2,6,89,0.1); }

.card-top {
    display: flex; align-items: flex-start;
    justify-content: space-between; gap: 8px;
    margin-bottom: 10px;
}
.card-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 800; color: var(--gray-900);
    word-break: break-word; margin-bottom: 3px;
}
.card-nisn { font-size: 11px; color: var(--gray-400); }

.gender-badge {
    flex-shrink: 0;
    display: inline-flex; align-items: center;
    padding: 2px 9px; border-radius: 20px;
    font-size: 10px; font-weight: 700; white-space: nowrap;
}
.gb-l { background: #EFF6FF; border: 1px solid #BFDBFE; color: #1D4ED8; }
.gb-p { background: #FDF2F8; border: 1px solid #F9A8D4; color: #BE185D; }

.card-info-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 7px 10px;
    margin-bottom: 10px;
}
.card-info-full { grid-column: span 2; }
.info-label {
    font-size: 9px; font-weight: 700; color: var(--gray-400);
    text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 2px;
}
.info-value {
    font-size: 12px; color: var(--gray-900); font-weight: 500;
    word-break: break-word; line-height: 1.4;
}
.info-value.muted { color: var(--gray-500); }

.card-divider { border: none; border-top: 1px solid var(--gray-100); margin: 10px 0; }

.card-btn-row { display: flex; gap: 7px; }
.btn-lihat {
    flex: 1;
    display: flex; align-items: center; justify-content: center; gap: 5px;
    padding: 8px 10px;
    background: var(--navy-light); border: 1.5px solid #C7D2FE; color: var(--navy);
    border-radius: 9px; font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px; font-weight: 700; text-decoration: none;
    transition: background 0.15s;
}
.btn-lihat:hover { background: #D1D5FF; text-decoration: none; color: var(--navy); }
.btn-hapus-wrap { flex: 1; display: flex; }
.btn-hapus {
    flex: 1; width: 100%;
    display: flex; align-items: center; justify-content: center; gap: 5px;
    padding: 8px 10px;
    background: var(--danger-light); border: 1.5px solid #FECACA; color: var(--danger);
    border-radius: 9px; font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px; font-weight: 700; cursor: pointer;
    transition: background 0.15s;
}
.btn-hapus:hover { background: #FEE2E2; }

/* ===== EMPTY STATE ===== */
.empty-card {
    background: white; border: 1.5px dashed var(--gray-200);
    border-radius: 14px; padding: 40px 20px; text-align: center;
    animation: slideUp 0.35s ease both;
}
.empty-icon { font-size: 32px; margin-bottom: 10px; }
.empty-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; font-weight: 800; color: var(--gray-900); margin-bottom: 4px; }
.empty-sub   { font-size: 12px; color: var(--gray-400); }

/* ════════════════════════
   DESKTOP: TABLE
════════════════════════ */
.table-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: 16px; overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    animation: slideUp 0.35s ease both;
}
.table-scroll { overflow-x: auto; width: 100%; -webkit-overflow-scrolling: touch; }

.data-table { width: 100%; border-collapse: collapse; font-size: 12px; }

.data-table thead tr { background: var(--navy); }
.data-table thead th {
    padding: 11px 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 10px; font-weight: 700;
    color: rgba(255,255,255,0.88);
    text-transform: uppercase; letter-spacing: 0.5px;
    text-align: left; white-space: nowrap;
}
.data-table thead th.center { text-align: center; }

.data-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.15s; }
.data-table tbody tr:last-child { border-bottom: none; }
.data-table tbody tr:hover { background: var(--navy-light); }

.data-table td { padding: 10px 12px; color: var(--gray-700); vertical-align: middle; }
.data-table td.center { text-align: center; }

.td-no { color: var(--gray-400); font-size: 11px; text-align: center; }
.td-num-badge {
    width: 26px; height: 26px; border-radius: 7px;
    background: var(--navy-light); color: var(--navy);
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 10px; font-weight: 800;
    display: inline-flex; align-items: center; justify-content: center;
}
.td-name { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 700; color: var(--gray-900); }
.td-mono { font-family: 'Courier New', monospace; font-size: 11px; color: var(--gray-500); }
.td-sub  { font-size: 10px; color: var(--gray-400); margin-top: 1px; }
.td-wrap { max-width: 140px; word-break: break-word; font-size: 11px; color: var(--gray-500); }
.td-muted { font-size: 11px; color: var(--gray-500); white-space: nowrap; }

/* ortu stack */
.ortu-label { font-size: 10px; color: var(--gray-400); margin-bottom: 1px; }
.ortu-value { font-size: 11px; color: var(--gray-700); margin-bottom: 4px; }
.ortu-value:last-child { margin-bottom: 0; }

.tbl-actions { display: inline-flex; gap: 5px; }
.tbl-btn {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 5px 10px; border-radius: 7px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 10px; font-weight: 700;
    white-space: nowrap; cursor: pointer; border: none;
    text-decoration: none; transition: background 0.15s;
}
.tbl-btn-lihat {
    background: var(--navy-light); border: 1.5px solid #C7D2FE; color: var(--navy);
}
.tbl-btn-lihat:hover { background: #D1D5FF; text-decoration: none; color: var(--navy); }
.tbl-btn-hapus {
    background: var(--danger-light); border: 1.5px solid #FECACA; color: var(--danger);
}
.tbl-btn-hapus:hover { background: #FEE2E2; }

/* ===== ANIMATIONS ===== */
@keyframes slideUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
html { scroll-behavior: smooth; }
body { overscroll-behavior-y: none; }
a { -webkit-tap-highlight-color: transparent; }
</style>

<div class="page-wrap">

    {{-- ===== HEADER ===== --}}
    <div class="page-header">
        <div class="header-top">
            <div class="header-icon">🎓</div>
            <div class="header-title">Data Alumni</div>
        </div>
        <div class="header-subtitle">Daftar seluruh alumni yang telah lulus dari sekolah</div>
        <div class="header-chip">
            🎓 Total: <strong>{{ $alumnis->count() }} Alumni</strong>
        </div>
    </div>

    <div class="content-area">

        {{-- ===== NOTIFIKASI ===== --}}
        @if(session('success'))
        <div class="notif success">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
        </div>
        @endif

        <div class="section-label">🎓 Daftar Alumni</div>

        {{-- ════════════════════════
             MOBILE: CARD LIST
        ════════════════════════ --}}
        <div class="mobile-only">
            @if($alumnis->count())
            <div class="card-list">
                @foreach($alumnis as $alumni)
                <div class="alumni-card">
                    <div class="card-top">
                        <div>
                            <div class="card-name">{{ $alumni->nama_siswa }}</div>
                            <div class="card-nisn">NISN: {{ $alumni->nisn }} &bull; NIS: {{ $alumni->nis }}</div>
                        </div>
                        <span class="gender-badge {{ $alumni->jenis_kelamin == 'L' ? 'gb-l' : 'gb-p' }}">
                            {{ $alumni->jenis_kelamin == 'L' ? '♂ L' : '♀ P' }}
                        </span>
                    </div>

                    <div class="card-info-grid">
                        <div>
                            <div class="info-label">Tempat, Tgl Lahir</div>
                            <div class="info-value">{{ $alumni->tempat_lahir }}, {{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d/m/Y') }}</div>
                        </div>
                        <div>
                            <div class="info-label">Tahun Lulus</div>
                            <div class="info-value">{{ $alumni->tahun_lulus }}</div>
                        </div>
                        <div>
                            <div class="info-label">Ayah</div>
                            <div class="info-value">{{ $alumni->ayah ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="info-label">Ibu</div>
                            <div class="info-value">{{ $alumni->ibu ?? '-' }}</div>
                        </div>
                        @if($alumni->wali)
                        <div class="card-info-full">
                            <div class="info-label">Wali</div>
                            <div class="info-value">{{ $alumni->wali }}</div>
                        </div>
                        @endif
                        <div class="card-info-full">
                            <div class="info-label">Alamat</div>
                            <div class="info-value muted">{{ $alumni->alamat ?? '-' }}</div>
                        </div>
                    </div>

                    <hr class="card-divider">

                    <div class="card-btn-row">
                        <a href="{{ route('staff_tu.alumni.show', $alumni->id) }}" class="btn-lihat">
                            <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            Lihat Detail
                        </a>
                        <div class="btn-hapus-wrap">
                            <form action="{{ route('staff_tu.alumni.destroy', $alumni->id) }}"
                                  method="POST" style="flex:1;display:flex;"
                                  onsubmit="return confirm('Yakin ingin menghapus {{ $alumni->nama_siswa }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">
                                    <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <polyline points="3 6 5 6 21 6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-card">
                <div class="empty-icon">🎓</div>
                <div class="empty-title">Belum Ada Data Alumni</div>
                <div class="empty-sub">Alumni yang lulus akan muncul di sini</div>
            </div>
            @endif
        </div>

        {{-- ════════════════════════
             DESKTOP: TABLE
        ════════════════════════ --}}
        <div class="desktop-only">
            @if($alumnis->count())
            <div class="table-card">
                <div class="table-scroll">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="center" style="width:46px;">No</th>
                                <th>NISN / NIS</th>
                                <th>Nama Siswa</th>
                                <th>Tgl Lahir</th>
                                <th class="center">JK</th>
                                <th>Alamat</th>
                                <th>Orang Tua / Wali</th>
                                <th class="center">Th. Lulus</th>
                                <th class="center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumnis as $alumni)
                            <tr>
                                <td class="center">
                                    <span class="td-num-badge">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="td-mono">{{ $alumni->nisn }}</div>
                                    <div class="td-sub">{{ $alumni->nis }}</div>
                                </td>
                                <td>
                                    <div class="td-name">{{ $alumni->nama_siswa }}</div>
                                </td>
                                <td class="td-muted">
                                    {{ $alumni->tempat_lahir }},<br>
                                    <span>{{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d/m/Y') }}</span>
                                </td>
                                <td class="center">
                                    <span class="gender-badge {{ $alumni->jenis_kelamin == 'L' ? 'gb-l' : 'gb-p' }}">
                                        {{ $alumni->jenis_kelamin == 'L' ? 'L' : 'P' }}
                                    </span>
                                </td>
                                <td class="td-wrap">{{ $alumni->alamat ?? '-' }}</td>
                                <td style="min-width:140px;">
                                    <div class="ortu-label">Ayah</div>
                                    <div class="ortu-value">{{ $alumni->ayah ?? '-' }}</div>
                                    <div class="ortu-label">Ibu</div>
                                    <div class="ortu-value">{{ $alumni->ibu ?? '-' }}</div>
                                    @if($alumni->wali)
                                    <div class="ortu-label">Wali</div>
                                    <div class="ortu-value">{{ $alumni->wali }}</div>
                                    @endif
                                </td>
                                <td class="center td-muted">{{ $alumni->tahun_lulus }}</td>
                                <td class="center">
                                    <div class="tbl-actions">
                                        <a href="{{ route('staff_tu.alumni.show', $alumni->id) }}" class="tbl-btn tbl-btn-lihat">
                                            <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                            Lihat
                                        </a>
                                        <form action="{{ route('staff_tu.alumni.destroy', $alumni->id) }}"
                                              method="POST" style="margin:0;"
                                              onsubmit="return confirm('Yakin ingin menghapus {{ $alumni->nama_siswa }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="tbl-btn tbl-btn-hapus">
                                                <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <polyline points="3 6 5 6 21 6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="empty-card">
                <div class="empty-icon">🎓</div>
                <div class="empty-title">Belum Ada Data Alumni</div>
                <div class="empty-sub">Alumni yang lulus akan muncul di sini</div>
            </div>
            @endif
        </div>

    </div>
</div>

@endsection