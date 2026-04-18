@extends('layouts.admin')

@section('content')
<style>
:root{
    --bg: #f6f8fc;
    --card: #ffffff;
    --border: #e9edf5;
    --text: #1e293b;
    --sub: #64748b;
    --primary: #4f46e5;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
}

/* Base */
.rekap-wrapper{
    background: var(--bg);
    min-height: 100vh;
    padding: 32px;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

/* Header */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
}

.title{
    font-size:20px;
    font-weight:700;
    color:var(--text);
}

.subtitle{
    font-size:13px;
    color:var(--sub);
}

/* Button */
.btn-danger{
    background:#fff;
    border:1px solid var(--border);
    color:var(--danger);
    padding:8px 14px;
    border-radius:10px;
    font-size:13px;
    transition:.2s;
}
.btn-danger:hover{
    background:#fee2e2;
}

/* Filter */
.filter{
    display:flex;
    gap:12px;
    background:var(--card);
    border:1px solid var(--border);
    padding:14px;
    border-radius:14px;
    margin-bottom:20px;
}

.filter input,
.filter select{
    border:1px solid var(--border);
    border-radius:8px;
    padding:8px 10px;
    font-size:13px;
}

.filter button{
    background:var(--primary);
    color:white;
    padding:8px 14px;
    border-radius:8px;
}

/* Cards */
.stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:12px;
    margin-bottom:20px;
}

.stat{
    background:var(--card);
    border:1px solid var(--border);
    padding:16px;
    border-radius:14px;
}

.stat h3{
    font-size:22px;
    margin-bottom:4px;
}

.stat p{
    font-size:12px;
    color:var(--sub);
}

/* Table */
.card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:14px;
    overflow:hidden;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#f9fafb;
}

th{
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:var(--sub);
    padding:12px;
    text-align:left;
}

td{
    padding:12px;
    font-size:13px;
}

tr{
    border-bottom:1px solid var(--border);
}

tr:hover{
    background:#f9fafb;
}

/* Badge */
.badge{
    padding:4px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:600;
}

.hadir{background:#ecfdf5;color:var(--success);}
.izin{background:#fffbeb;color:var(--warning);}
.sakit{background:#eff6ff;color:#3b82f6;}
.alpha{background:#fef2f2;color:var(--danger);}

/* Progress */
.progress{
    height:6px;
    background:#e5e7eb;
    border-radius:999px;
    overflow:hidden;
}
.progress div{
    height:100%;
    background:var(--primary);
}
</style>

<div class="rekap-wrapper">

    {{-- HEADER --}}
    <div class="header">
        <div>
            <div class="title">Rekap Absensi Guru</div>
            <div class="subtitle">Monitoring kehadiran tenaga pengajar</div>
        </div>

        <form method="POST" action="{{ route('admin.absensi.hapus-bulan') }}">
            @csrf @method('DELETE')
            <input type="hidden" name="bulan" value="{{ $bulan }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <button class="btn-danger">Hapus Bulan Ini</button>
        </form>
    </div>

    {{-- FILTER --}}
    <form class="filter">
        <select name="bulan">
            @for($m=1;$m<=12;$m++)
                <option value="{{ $m }}" {{ $bulan==$m?'selected':'' }}>
                    {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                </option>
            @endfor
        </select>

        <input type="number" name="tahun" value="{{ $tahun }}">
        <button>Tampilkan</button>
    </form>

    {{-- STATS --}}
    @php
        $totalHadir = collect($rekapGuru)->sum('hadir');
        $totalIzin = collect($rekapGuru)->sum('izin');
        $totalSakit = collect($rekapGuru)->sum('sakit');
    @endphp

    <div class="stats">
        <div class="stat">
            <h3>{{ count($rekapGuru) }}</h3>
            <p>Total Guru</p>
        </div>
        <div class="stat">
            <h3>{{ $totalHadir }}</h3>
            <p>Hadir</p>
        </div>
        <div class="stat">
            <h3>{{ $totalIzin }}</h3>
            <p>Izin</p>
        </div>
        <div class="stat">
            <h3>{{ $totalSakit }}</h3>
            <p>Sakit</p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Guru</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekapGuru as $rg)
                @php
                    $jumlahHari = \Carbon\Carbon::create($tahun,$bulan)->daysInMonth;
                    $persen = $jumlahHari ? round(($rg['hadir']/$jumlahHari)*100) : 0;
                @endphp
                <tr>
                    <td>{{ $rg['guru']->nama }}</td>
                    <td><span class="badge hadir">{{ $rg['hadir'] }}</span></td>
                    <td><span class="badge izin">{{ $rg['izin'] }}</span></td>
                    <td><span class="badge sakit">{{ $rg['sakit'] }}</span></td>
                    <td>
                        <div class="progress">
                            <div style="width:{{ $persen }}%"></div>
                        </div>
                        <small>{{ $persen }}%</small>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection