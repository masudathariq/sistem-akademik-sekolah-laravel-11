@extends('layouts.admin')

@section('title', 'Rekap Absensi Per Guru')
@section('header', 'Rekap Absensi Per Guru')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{
    --navy:#1e3a8a;
    --navy-md:#1d4ed8;
    --navy-lt:#dbeafe;

    --green:#16a34a;
    --green-lt:#f0fdf4;
    --green-bd:#86efac;

    --amber:#d97706;
    --amber-lt:#fffbeb;
    --amber-bd:#fcd34d;

    --red:#dc2626;
    --red-lt:#fff1f2;
    --red-bd:#fecdd3;

    --purple:#7e22ce;
    --purple-lt:#fdf4ff;

    --gray-bg:#f8fafc;
    --border:#e2e8f0;

    --text:#1e293b;
    --muted:#64748b;
    --hint:#94a3b8;

    --radius:12px;

    --shadow:
        0 1px 3px rgba(0,0,0,.06),
        0 4px 12px rgba(0,0,0,.04);
}

body{
    font-family:'IBM Plex Sans',sans-serif;
}

.absensi-page{
    min-height:100vh;
    background:var(--gray-bg);
    padding:2rem;
    padding-bottom:4rem;
    color:var(--text);
}

/* ───────── TOPBAR ───────── */
.top-bar{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:1rem;
    flex-wrap:wrap;
    margin-bottom:1.75rem;
}

.page-title{
    display:flex;
    align-items:center;
    gap:12px;
}

.title-icon{
    width:44px;
    height:44px;
    border-radius:10px;
    background:var(--navy-lt);
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    font-size:20px;
}

.title-text h1{
    font-size:20px;
    font-weight:700;
    letter-spacing:-.02em;
    color:var(--text);
    margin-bottom:3px;
}

.title-text p{
    font-size:13px;
    color:var(--muted);
    line-height:1.6;
}

/* ───────── BUTTON ───────── */
.btn-primary{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:7px;
    padding:.75rem 1rem;
    border:none;
    border-radius:10px;
    background:var(--navy);
    color:#fff;
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    transition:.15s;
    white-space:nowrap;
    box-shadow:var(--shadow);
}

.btn-primary:hover{
    background:var(--navy-md);
    color:#fff;
    text-decoration:none;
}

/* ───────── FILTER ───────── */
.filter-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1rem;
    margin-bottom:1.5rem;
    box-shadow:var(--shadow);
}

.filter-form{
    display:flex;
    align-items:end;
    gap:12px;
    flex-wrap:wrap;
}

.filter-group{
    display:flex;
    flex-direction:column;
    gap:6px;
}

.filter-label{
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:var(--muted);
}

.filter-input{
    min-width:180px;
    border:1px solid var(--border);
    border-radius:10px;
    padding:.75rem .9rem;
    font-size:13px;
    color:var(--text);
    background:#fff;
    outline:none;
    transition:.15s;
    font-family:'IBM Plex Sans',sans-serif;
}

.filter-input:focus{
    border-color:var(--navy-md);
    box-shadow:0 0 0 3px rgba(29,78,216,.08);
}

/* ───────── SECTION TITLE ───────── */
.section-title{
    font-size:12px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.06em;
    color:var(--muted);
    margin-bottom:12px;
}

/* ───────── STATS ───────── */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:1.5rem;
}

.stat-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1.1rem 1.2rem;
    box-shadow:var(--shadow);
}

.stat-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:14px;
}

.stat-label{
    font-size:11px;
    font-weight:700;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
}

.stat-icon{
    width:34px;
    height:34px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
}

.icon-green{
    background:var(--green-lt);
    color:var(--green);
}

.icon-amber{
    background:var(--amber-lt);
    color:var(--amber);
}

.icon-red{
    background:var(--red-lt);
    color:var(--red);
}

.icon-blue{
    background:var(--navy-lt);
    color:var(--navy-md);
}

.stat-value{
    font-size:28px;
    font-weight:700;
    letter-spacing:-.04em;
    color:var(--text);
    line-height:1;
    margin-bottom:6px;
}

.stat-sub{
    font-size:12px;
    color:var(--muted);
}

.progress{
    width:100%;
    height:8px;
    background:#e2e8f0;
    border-radius:999px;
    overflow:hidden;
    margin-top:10px;
}

.progress-bar{
    height:100%;
    border-radius:999px;
    background:linear-gradient(90deg,var(--navy),var(--green));
}

/* ───────── TABLE CARD ───────── */
.table-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
}

.table-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:1rem 1.25rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
    flex-wrap:wrap;
}

.table-title{
    font-size:14px;
    font-weight:700;
    color:var(--text);
}

.table-meta{
    font-size:12px;
    color:var(--muted);
}

.table-wrap{
    overflow-x:auto;
}

/* ───────── TABLE ───────── */
.absensi-table{
    width:100%;
    border-collapse:collapse;
    min-width:1100px;
}

.absensi-table thead{
    background:var(--navy);
}

.absensi-table th{
    padding:.85rem 1rem;
    text-align:left;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:rgba(255,255,255,.9);
    white-space:nowrap;
}

.absensi-table th.center{
    text-align:center;
}

.absensi-table td{
    padding:.9rem 1rem;
    border-bottom:1px solid var(--border);
    font-size:13px;
    vertical-align:middle;
    white-space:nowrap;
}

.absensi-table tbody tr:hover{
    background:#f8fbff;
}

.absensi-table tbody tr:last-child td{
    border-bottom:none;
}

.center{
    text-align:center;
}

.mono{
    font-family:monospace;
    color:var(--muted);
    font-size:12px;
}

/* ───────── BADGE ───────── */
.badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:5px 12px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
    text-transform:capitalize;
}

.badge-hadir{
    background:var(--green-lt);
    color:var(--green);
}

.badge-izin{
    background:var(--amber-lt);
    color:var(--amber);
}

.badge-sakit{
    background:var(--red-lt);
    color:var(--red);
}

.badge-alpha{
    background:#eff6ff;
    color:#2563eb;
}

/* ───────── FOTO ───────── */
.foto-thumb{
    width:42px;
    height:42px;
    object-fit:cover;
    border-radius:10px;
    border:2px solid var(--border);
    transition:.15s;
}

.foto-thumb:hover{
    transform:scale(1.08);
    border-color:var(--navy-md);
}

/* ───────── EMPTY ───────── */
.empty-state{
    background:#fff;
    border:1px dashed var(--border);
    border-radius:16px;
    padding:4rem 2rem;
    text-align:center;
    box-shadow:var(--shadow);
}

.empty-icon{
    width:64px;
    height:64px;
    border-radius:18px;
    background:#f1f5f9;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 1rem;
    font-size:28px;
}

.empty-title{
    font-size:16px;
    font-weight:700;
    color:var(--text);
    margin-bottom:6px;
}

.empty-desc{
    font-size:13px;
    color:var(--muted);
}

/* ───────── RESPONSIVE ───────── */
@media(max-width:1100px){

    .stats-grid{
        grid-template-columns:repeat(2,1fr);
    }

}

@media(max-width:900px){

    .absensi-page{
        padding:1rem;
    }

    .top-bar{
        flex-direction:column;
        align-items:stretch;
    }

    .filter-form{
        flex-direction:column;
        align-items:stretch;
    }

    .filter-input{
        width:100%;
    }

}

@media(max-width:640px){

    .stats-grid{
        grid-template-columns:1fr;
    }

}
</style>

<div class="absensi-page">

    {{-- TOPBAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                👤
            </div>

            <div class="title-text">

                <h1>Rekap Absensi Per Guru</h1>

                <p>
                    Detail kehadiran individu tenaga pengajar berdasarkan
                    periode bulan dan tahun tertentu.
                </p>

            </div>

        </div>

        @if(request('guru_id'))

        <a href="{{ route('admin.absensi.cetak-pdf', [
                'guru_id' => request('guru_id'),
                'bulan' => request('bulan'),
                'tahun' => request('tahun')
            ]) }}"
           target="blank-page"
           class="btn-primary">

            Cetak PDF

        </a>

        @endif

    </div>

    {{-- FILTER --}}
    <form method="GET"
          class="filter-card">

        <div class="filter-form">

            <div class="filter-group">

                <label class="filter-label">
                    Guru
                </label>

                <select name="guru_id"
                        class="filter-input">

                    <option value="">
                        — Pilih Guru —
                    </option>

                    @foreach($guru as $g)

                    <option value="{{ $g->id }}"
                        {{ request('guru_id') == $g->id ? 'selected' : '' }}>

                        {{ $g->nama }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="filter-group">

                <label class="filter-label">
                    Bulan
                </label>

                <select name="bulan"
                        class="filter-input">

                    @for($m = 1; $m <= 12; $m++)

                    <option value="{{ $m }}"
                        {{ request('bulan', now()->month) == $m ? 'selected' : '' }}>

                        {{ \Carbon\Carbon::createFromDate(null, (int)$m, 1)->locale('id')->isoFormat('MMMM') }}

                    </option>

                    @endfor

                </select>

            </div>

            <div class="filter-group">

                <label class="filter-label">
                    Tahun
                </label>

                <input type="number"
                       name="tahun"
                       value="{{ request('tahun', now()->year) }}"
                       class="filter-input">

            </div>

            <button type="submit"
                    class="btn-primary">

                Tampilkan

            </button>

        </div>

    </form>

    @if(request('guru_id'))

        @if($rekap)

        @php
            $jumlahHari = \Carbon\Carbon::create($tahun, $bulan, 1)->daysInMonth;

            $persenHadir =
                $jumlahHari > 0
                ? round(($rekap['hadir'] / $jumlahHari) * 100, 1)
                : 0;
        @endphp

        {{-- STATS --}}
        <div class="section-title">
            Ringkasan Kehadiran
        </div>

        <div class="stats-grid">

            <div class="stat-card">

                <div class="stat-header">

                    <span class="stat-label">
                        Hadir
                    </span>

                    <div class="stat-icon icon-green">
                        ✅
                    </div>

                </div>

                <div class="stat-value">
                    {{ $rekap['hadir'] }}
                </div>

                <div class="stat-sub">
                    dari {{ $jumlahHari }} hari
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-header">

                    <span class="stat-label">
                        Izin
                    </span>

                    <div class="stat-icon icon-amber">
                        📄
                    </div>

                </div>

                <div class="stat-value">
                    {{ $rekap['izin'] }}
                </div>

                <div class="stat-sub">
                    hari izin tercatat
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-header">

                    <span class="stat-label">
                        Sakit
                    </span>

                    <div class="stat-icon icon-red">
                        🏥
                    </div>

                </div>

                <div class="stat-value">
                    {{ $rekap['sakit'] }}
                </div>

                <div class="stat-sub">
                    hari sakit tercatat
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-header">

                    <span class="stat-label">
                        Persentase
                    </span>

                    <div class="stat-icon icon-blue">
                        📊
                    </div>

                </div>

                <div class="stat-value">
                    {{ $persenHadir }}%
                </div>

                <div class="stat-sub">
                    tingkat kehadiran
                </div>

                <div class="progress">

                    <div class="progress-bar"
                         style="width:{{ $persenHadir }}%">

                    </div>

                </div>

            </div>

        </div>

        @endif

        {{-- TABLE --}}
        <div class="section-title">
            Detail Absensi
        </div>

        <div class="table-card">

            <div class="table-header">

                <div class="table-title">
                    Data Absensi Bulan Ini
                </div>

                <div class="table-meta">
                    {{ $absensi->count() }} record
                </div>

            </div>

            <div class="table-wrap">

                <table class="absensi-table">

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

                            <td class="mono">
                                {{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}
                            </td>

                            <td style="color:var(--muted);">
                                {{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('dddd') }}
                            </td>

                            <td class="center mono">
                                {{ $a->jam_masuk ?? '—' }}
                            </td>

                            <td class="center mono">
                                {{ $a->jam_pulang ?? '—' }}
                            </td>

                            <td class="center">

                                @php
                                    $sc = match($a->status) {
                                        'hadir' => 'badge-hadir',
                                        'izin' => 'badge-izin',
                                        'sakit' => 'badge-sakit',
                                        default => 'badge-alpha',
                                    };
                                @endphp

                                <span class="badge {{ $sc }}">
                                    {{ $a->status }}
                                </span>

                            </td>

                            <td style="color:var(--muted);"
                                title="{{ $a->lokasi ?? '' }}">

                                {{ $a->lokasi ?? '—' }}

                            </td>

                            <td class="center mono">
                                {{ $a->latitude ?? '—' }}
                            </td>

                            <td class="center mono">
                                {{ $a->longitude ?? '—' }}
                            </td>

                            <td class="center">

                                @if($a->foto)

                                <a href="{{ asset('storage/'.$a->foto) }}"
                                   target="_blank">

                                    <img src="{{ asset('storage/'.$a->foto) }}"
                                         class="foto-thumb"
                                         alt="Foto">

                                </a>

                                @else

                                <span style="color:var(--hint);">
                                    —
                                </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="9"
                                style="text-align:center;padding:3rem;color:var(--muted);">

                                Tidak ada data absensi untuk periode ini

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    @else

    {{-- EMPTY --}}
    <div class="empty-state">

        <div class="empty-icon">
            🔍
        </div>

        <div class="empty-title">
            Pilih Guru Terlebih Dahulu
        </div>

        <div class="empty-desc">
            Silakan pilih guru dan periode untuk melihat detail absensi.
        </div>

    </div>

    @endif

</div>

@endsection