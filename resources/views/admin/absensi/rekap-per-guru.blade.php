@extends('layouts.admin')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap');

    :root {
        --bg-base: #f4f6fb;
        --bg-card: #ffffff;
        --bg-elevated: #f8f9fc;
        --bg-hover: #f0f3fb;
        --border: #e4e9f5;
        --border-active: #b8c5f0;
        --accent-primary: #3b5bdb;
        --accent-secondary: #6741d9;
        --accent-glow: rgba(59, 91, 219, 0.12);
        --text-primary: #1a2151;
        --text-secondary: #5c6f9e;
        --text-muted: #a8b4d0;
        --success: #0c9e6e;
        --success-bg: #ecfdf5;
        --success-border: #a7f3d0;
        --warning: #d97706;
        --warning-bg: #fffbeb;
        --warning-border: #fcd34d;
        --danger: #dc2626;
        --danger-bg: #fef2f2;
        --danger-border: #fca5a5;
        --info: #0284c7;
        --info-bg: #f0f9ff;
        --info-border: #bae6fd;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .pg-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg-base);
        min-height: 100vh;
        padding: 2rem 1.5rem;
        color: var(--text-primary);
        background-image:
            radial-gradient(ellipse 80% 40% at 50% -10%, rgba(59, 91, 219, 0.06) 0%, transparent 60%),
            radial-gradient(ellipse 40% 30% at 90% 5%, rgba(103, 65, 217, 0.04) 0%, transparent 50%);
    }

    /* ── Header ── */
    .page-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .page-title-group {
        display: flex;
        align-items: center;
        gap: 0.875rem;
    }

    .title-icon {
        width: 46px;
        height: 46px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 1.25rem;
        box-shadow: 0 4px 16px var(--accent-glow), 0 1px 3px rgba(59, 91, 219, 0.2);
        flex-shrink: 0;
    }

    .page-title {
        font-size: 1.4rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: var(--text-primary);
    }

    .page-subtitle {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-top: 2px;
    }

    /* ── PDF Button ── */
    .btn-pdf {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: #fff;
        border: none;
        padding: 0.6rem 1.15rem;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 3px 12px var(--accent-glow);
    }

    .btn-pdf:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(59, 91, 219, 0.22);
    }

    /* ── Filter Card ── */
    .filter-card {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.75rem;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 1rem;
        box-shadow: 0 1px 4px rgba(59, 91, 219, 0.05);
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .filter-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-secondary);
        letter-spacing: 0.07em;
        text-transform: uppercase;
    }

    .filter-select,
    .filter-input {
        background: var(--bg-elevated);
        border: 1.5px solid var(--border);
        color: var(--text-primary);
        padding: 0.55rem 0.875rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .filter-select.wide {
        min-width: 200px;
    }

    .filter-input {
        width: 110px;
    }

    .filter-select:focus,
    .filter-input:focus {
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px var(--accent-glow);
        background: #fff;
    }

    .btn-filter {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        color: #fff;
        border: none;
        padding: 0.6rem 1.25rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 3px 12px var(--accent-glow);
    }

    .btn-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(59, 91, 219, 0.22);
    }

    /* ── Section title ── */
    .section-title {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-muted);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1.5px;
        background: var(--border);
        border-radius: 2px;
    }

    /* ── Stats row ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.875rem;
        margin-bottom: 1.75rem;
    }

    .stat-card {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 14px;
        padding: 1.1rem 1.25rem;
        transition: all 0.2s;
        box-shadow: 0 1px 3px rgba(59, 91, 219, 0.04);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: 14px 14px 0 0;
    }

    .stat-card.hadir::before {
        background: linear-gradient(90deg, #10b981, #34d399);
    }

    .stat-card.izin::before {
        background: linear-gradient(90deg, #f59e0b, #fbbf24);
    }

    .stat-card.sakit::before {
        background: linear-gradient(90deg, #dc2626, #f87171);
    }

    .stat-card.persen::before {
        background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
    }

    .stat-card:hover {
        border-color: var(--border-active);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 91, 219, 0.08);
    }

    .stat-icon {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        letter-spacing: -0.04em;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.7rem;
        color: var(--text-secondary);
        margin-top: 0.35rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .stat-card.hadir .stat-value {
        color: var(--success);
    }

    .stat-card.izin .stat-value {
        color: var(--warning);
    }

    .stat-card.sakit .stat-value {
        color: var(--danger);
    }

    .stat-card.persen .stat-value {
        color: var(--accent-primary);
    }

    .stat-sub {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        color: var(--text-muted);
        margin-top: 0.2rem;
    }

    /* ── Progress bar inside persen card ── */
    .persen-bar-bg {
        margin-top: 0.6rem;
        height: 5px;
        background: #eef0f8;
        border-radius: 99px;
        overflow: hidden;
    }

    .persen-bar-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--accent-primary), var(--success));
        transition: width 0.8s cubic-bezier(.4, 0, .2, 1);
    }

    /* ── Empty state ── */
    .empty-state {
        background: var(--bg-card);
        border: 1.5px dashed var(--border);
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        color: var(--text-muted);
    }

    .empty-state-icon {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .empty-state-text {
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* ── Table Card ── */
    .table-card {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(59, 91, 219, 0.05);
    }

    .table-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        border-bottom: 1.5px solid var(--border);
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .table-card-title {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-wrap {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.82rem;
        table-layout: fixed;
        min-width: 700px;
    }

    /* column widths */
    .col-tanggal {
        width: 100px;
    }

    .col-hari {
        width: 90px;
    }

    .col-jam {
        width: 82px;
    }

    .col-status {
        width: 82px;
    }

    .col-lokasi {
        width: 140px;
    }

    .col-lat {
        width: 110px;
    }

    .col-lng {
        width: 110px;
    }

    .col-foto {
        width: 64px;
    }

    thead th {
        background: var(--bg-elevated);
        color: var(--text-secondary);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.8rem 0.875rem;
        text-align: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        border-bottom: 1.5px solid var(--border);
    }

    thead th.center {
        text-align: center;
    }

    tbody tr {
        border-bottom: 1px solid #f0f2f9;
        transition: background 0.15s;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    tbody tr:hover {
        background: var(--bg-hover);
    }

    td {
        padding: 0.82rem 0.875rem;
        color: var(--text-primary);
        vertical-align: middle;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    td.center {
        text-align: center;
    }

    td.mono {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    .empty-row td {
        text-align: center;
        color: var(--text-muted);
        padding: 2.5rem;
        font-size: 0.82rem;
        white-space: normal;
    }

    /* ── Badges ── */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.28rem 0.7rem;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        text-transform: capitalize;
    }

    .badge-hadir {
        background: var(--success-bg);
        color: var(--success);
        border: 1px solid var(--success-border);
    }

    .badge-izin {
        background: var(--warning-bg);
        color: var(--warning);
        border: 1px solid var(--warning-border);
    }

    .badge-sakit {
        background: var(--danger-bg);
        color: var(--danger);
        border: 1px solid var(--danger-border);
    }

    .badge-alpha {
        background: var(--info-bg);
        color: var(--info);
        border: 1px solid var(--info-border);
    }

    /* ── Photo ── */
    .foto-thumb {
        width: 36px;
        height: 36px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid var(--border);
        transition: transform 0.2s, border-color 0.2s;
        display: block;
        margin: auto;
    }

    .foto-thumb:hover {
        transform: scale(1.15);
        border-color: var(--accent-primary);
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .pg-wrapper {
            padding: 1.25rem 1rem;
        }

        .page-title {
            font-size: 1.15rem;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="pg-wrapper">

    {{-- ── Header ── --}}
    <div class="page-header">
        <div class="page-title-group">
            <div class="title-icon">👤</div>
            <div>
                <div class="page-title">Rekap Absensi Per Guru</div>
                <div class="page-subtitle">Detail kehadiran individu tenaga pengajar</div>
            </div>
        </div>

        @if(request('guru_id'))
        <a href="{{ route('admin.absensi.cetak-pdf', ['guru_id' => request('guru_id'), 'bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
            class="btn-pdf">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
                <line x1="12" y1="18" x2="12" y2="12" />
                <line x1="9" y1="15" x2="15" y2="15" />
            </svg>
            Cetak PDF
        </a>
        @endif
    </div>

    {{-- ── Filter ── --}}
    <form method="GET" class="filter-card">
        <div class="filter-group">
            <label class="filter-label">Guru</label>
            <select name="guru_id" class="filter-select wide">
                <option value="">— Pilih Guru —</option>
                @foreach($guru as $g)
                <option value="{{ $g->id }}" {{ request('guru_id') == $g->id ? 'selected' : '' }}>
                    {{ $g->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label class="filter-label">Bulan</label>
            <select name="bulan" class="filter-select">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('bulan', now()->month) == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::createFromDate(null, (int)$m, 1)->locale('id')->isoFormat('MMMM') }}
                    </option>
                    @endfor
            </select>
        </div>
        <div class="filter-group">
            <label class="filter-label">Tahun</label>
            <input type="number" name="tahun" value="{{ request('tahun', now()->year) }}" class="filter-input">
        </div>
        <button type="submit" class="btn-filter">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            Tampilkan
        </button>
    </form>

    @if(request('guru_id'))

    {{-- ── Stat Cards ── --}}
    @if($rekap)
    @php
    $jumlahHari = \Carbon\Carbon::create($tahun, $bulan, 1)->daysInMonth;
    $persenHadir = $jumlahHari > 0 ? round(($rekap['hadir'] / $jumlahHari) * 100, 1) : 0;
    @endphp
    <div class="section-title">Ringkasan Kehadiran</div>
    <div class="stats-grid">
        <div class="stat-card hadir">
            <span class="stat-icon">✅</span>
            <div class="stat-value">{{ $rekap['hadir'] }}</div>
            <div class="stat-label">Hadir</div>
            <div class="stat-sub">dari {{ $jumlahHari }} hari</div>
        </div>
        <div class="stat-card izin">
            <span class="stat-icon">📋</span>
            <div class="stat-value">{{ $rekap['izin'] }}</div>
            <div class="stat-label">Izin</div>
            <div class="stat-sub">hari absen izin</div>
        </div>
        <div class="stat-card sakit">
            <span class="stat-icon">🤒</span>
            <div class="stat-value">{{ $rekap['sakit'] }}</div>
            <div class="stat-label">Sakit</div>
            <div class="stat-sub">hari absen sakit</div>
        </div>
        <div class="stat-card persen">
            <span class="stat-icon">📊</span>
            <div class="stat-value">{{ $persenHadir }}%</div>
            <div class="stat-label">Kehadiran</div>
            <div class="persen-wrap">
                <div class="persen-bar-bg">
                    <div class="persen-bar-fill"
                        @style(['width: '.$persenHadir.' %'])>
                    </div>
                </div>
                <span class="persen-text">{{ $persenHadir }}%</span>
            </div>
        </div>
    </div>
    @endif

    {{-- ── Table ── --}}
    <div class="section-title">Detail Absensi</div>
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                Data Absensi Bulan Ini
            </div>
            <span style="font-size:0.75rem; color:var(--text-muted); font-family:'JetBrains Mono',monospace;">
                {{ $absensi->count() }} record
            </span>
        </div>
        <div class="table-wrap">
            <table>
                <colgroup>
                    <col class="col-tanggal">
                    <col class="col-hari">
                    <col class="col-jam">
                    <col class="col-jam">
                    <col class="col-status">
                    <col class="col-lokasi">
                    <col class="col-lat">
                    <col class="col-lng">
                    <col class="col-foto">
                </colgroup>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th class="center">Masuk</th>
                        <th class="center">Pulang</th>
                        <th class="center">Status</th>
                        <th>Lokasi</th>
                        <th class="center">Latitude</th>
                        <th class="center">Longitude</th>
                        <th class="center">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $a)
                    <tr>
                        <td class="mono">{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</td>
                        <td style="color:var(--text-secondary); font-size:0.8rem;">
                            {{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('dddd') }}
                        </td>
                        <td class="center mono">{{ $a->jam_masuk ?? '—' }}</td>
                        <td class="center mono">{{ $a->jam_pulang ?? '—' }}</td>
                        <td class="center">
                            @php
                            $sc = match($a->status) {
                            'hadir' => 'badge-hadir',
                            'izin' => 'badge-izin',
                            'sakit' => 'badge-sakit',
                            default => 'badge-alpha',
                            };
                            @endphp
                            <span class="badge {{ $sc }}">{{ $a->status }}</span>
                        </td>
                        <td style="color:var(--text-secondary);" title="{{ $a->lokasi ?? '' }}">
                            {{ $a->lokasi ?? '—' }}
                        </td>
                        <td class="center mono" style="font-size:0.7rem; color:var(--text-muted);">
                            {{ $a->latitude ?? '—' }}
                        </td>
                        <td class="center mono" style="font-size:0.7rem; color:var(--text-muted);">
                            {{ $a->longitude ?? '—' }}
                        </td>
                        <td class="center">
                            @if($a->foto)
                            <a href="{{ asset('storage/'.$a->foto) }}" target="_blank">
                                <img src="{{ asset('storage/'.$a->foto) }}" class="foto-thumb" alt="Foto">
                            </a>
                            @else
                            <span style="color:var(--text-muted); font-size:0.75rem;">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="9">Tidak ada data absensi untuk periode ini</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @else
    {{-- ── Empty State ── --}}
    <div class="empty-state">
        <span class="empty-state-icon">🔍</span>
        <div class="empty-state-text">Silakan pilih guru dan periode terlebih dahulu</div>
    </div>
    @endif

</div>
@endsection