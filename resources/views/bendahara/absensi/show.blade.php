@extends('layouts.bendahara')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap');

*{
    box-sizing:border-box;
    font-family:'IBM Plex Sans',sans-serif;
}

:root{
    --navy:#1e3a8a;
    --navy-md:#1d4ed8;
    --navy-lt:#dbeafe;

    --green:#16a34a;
    --green-lt:#f0fdf4;

    --amber:#d97706;
    --amber-lt:#fffbeb;

    --red:#dc2626;
    --red-lt:#fff1f2;

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
    background:var(--gray-bg);
}

.rb-page{
    min-height:100vh;
    padding:2rem;
    padding-bottom:4rem;
    color:var(--text);
}

/* ─────────────────────────
   TOP BAR
───────────────────────── */
.top-bar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    margin-bottom:1.75rem;
    flex-wrap:wrap;
}

.page-title{
    display:flex;
    align-items:center;
    gap:12px;
}

.title-icon{
    width:44px;
    height:44px;
    background:var(--navy-lt);
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.title-text h1{
    font-size:20px;
    font-weight:600;
    color:var(--text);
    margin:0 0 3px;
    letter-spacing:-.02em;
}

.title-text p{
    font-size:13px;
    color:var(--muted);
    margin:0;
}

.title-text p strong{
    color:var(--navy-md);
    font-weight:600;
}

/* ─────────────────────────
   STATS
───────────────────────── */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:1rem;
    margin-bottom:1.5rem;
}

.stat-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1rem 1.25rem;
    box-shadow:var(--shadow);
}

.stat-label{
    font-size:11px;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    margin-bottom:10px;
    font-weight:600;
}

.stat-value{
    font-size:28px;
    font-weight:700;
    line-height:1;
}

.stat-green{ color:var(--green); }
.stat-amber{ color:var(--amber); }
.stat-red{ color:var(--red); }
.stat-blue{ color:var(--navy-md); }

/* ─────────────────────────
   TABLE CARD
───────────────────────── */
.table-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
}

.table-header{
    padding:1rem 1.5rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    flex-wrap:wrap;
}

.table-header h2{
    font-size:14px;
    font-weight:600;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    margin:0;
}

.table-header span{
    font-size:12px;
    color:var(--hint);
}

.table-wrap{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:1000px;
}

thead th{
    background:#f8fafc;
    padding:12px 14px;
    border-bottom:1px solid var(--border);
    font-size:11px;
    font-weight:700;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    white-space:nowrap;
    text-align:left;
}

tbody td{
    padding:14px;
    border-bottom:1px solid #f1f5f9;
    vertical-align:middle;
    font-size:13px;
    color:var(--text);
}

tbody tr:last-child td{
    border-bottom:none;
}

tbody tr:hover{
    background:#fafafa;
}

/* ─────────────────────────
   TABLE STYLE
───────────────────────── */
.tc{
    text-align:center;
}

.mono{
    font-variant-numeric:tabular-nums;
}

.muted{
    color:#cbd5e1;
}

.date-main{
    font-weight:600;
    margin-bottom:2px;
}

.date-sub{
    font-size:11px;
    color:var(--hint);
}

.badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:4px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:600;
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

.badge-other{
    background:#f1f5f9;
    color:var(--muted);
}

.maps-link{
    display:inline-flex;
    align-items:center;
    gap:4px;
    font-size:12px;
    color:var(--navy-md);
    text-decoration:none;
    font-weight:500;
}

.maps-link:hover{
    text-decoration:underline;
}

.foto{
    width:42px;
    height:42px;
    border-radius:10px;
    object-fit:cover;
    border:1px solid var(--border);
}

.empty{
    text-align:center;
    padding:3rem 1rem !important;
    color:var(--hint);
    font-size:13px;
}

/* ─────────────────────────
   BACK BUTTON
───────────────────────── */
.back-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 16px;
    background:#fff;
    color:var(--muted);
    border:1px solid var(--border);
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    transition:.15s ease;
}

.back-btn:hover{
    background:#f8fafc;
    color:var(--text);
}

/* ─────────────────────────
   RESPONSIVE
───────────────────────── */
@media (max-width:768px){

    .rb-page{
        padding:1rem;
    }

    .stats-grid{
        grid-template-columns:1fr 1fr;
    }

}

@media (max-width:500px){

    .stats-grid{
        grid-template-columns:1fr;
    }

}
</style>

<div class="rb-page">

    {{-- ═════════ TOP BAR ═════════ --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">

                <svg width="22"
                     height="22"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="#1d4ed8"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <path d="M9 11l3 3L22 4"/>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>

                </svg>

            </div>

            <div class="title-text">

                <h1>{{ $guru->nama }}</h1>

                <p>
                    Detail absensi guru
                    &mdash;
                    <strong>
                        {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM') }}
                        {{ $tahun }}
                    </strong>
                </p>

            </div>

        </div>

        <a href="{{ route('bendahara.rekap') }}"
           class="back-btn">

            <svg width="14"
                 height="14"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <polyline points="15 18 9 12 15 6"/>

            </svg>

            Kembali

        </a>

    </div>

    {{-- ═════════ STATS ═════════ --}}
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Hadir</div>
            <div class="stat-value stat-green">{{ $hadir }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Izin</div>
            <div class="stat-value stat-amber">{{ $izin }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Sakit</div>
            <div class="stat-value stat-red">{{ $sakit }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Hari Aktif</div>
            <div class="stat-value stat-blue">{{ $jumlahHari }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Kehadiran</div>
            <div class="stat-value stat-blue">{{ $persenHadir }}%</div>
        </div>

    </div>

    {{-- ═════════ TABLE CARD ═════════ --}}
    <div class="table-card">

        <div class="table-header">

            <h2>Riwayat Absensi Harian</h2>

            <span>
                {{ $absensi->count() }} catatan absensi
            </span>

        </div>

        <div class="table-wrap">

            <table>

                <thead>

                    <tr>
                        <th>Tanggal</th>
                        <th class="tc">Masuk</th>
                        <th class="tc">Pulang</th>
                        <th class="tc">Status</th>
                        <th>Lokasi</th>
                        <th class="tc">Maps</th>
                        <th class="tc">Foto</th>
                        <th>Keterangan</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($absensi as $a)

                        @php
                            $s = strtolower($a->status ?? '');

                            $bc = match($s) {
                                'hadir' => 'badge-hadir',
                                'izin'  => 'badge-izin',
                                'sakit' => 'badge-sakit',
                                default => 'badge-other'
                            };
                        @endphp

                        <tr>

                            <td>

                                <div class="date-main">
                                    {{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->translatedFormat('d F Y') }}
                                </div>

                                <div class="date-sub">
                                    {{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('dddd') }}
                                </div>

                            </td>

                            <td class="tc mono">
                                {{ $a->jam_masuk ?? '—' }}
                            </td>

                            <td class="tc mono">
                                {{ $a->jam_pulang ?? '—' }}
                            </td>

                            <td class="tc">

                                <span class="badge {{ $bc }}">
                                    {{ ucfirst($a->status ?? '-') }}
                                </span>

                            </td>

                            <td style="color:var(--muted);">
                                {{ $a->lokasi ?? '—' }}
                            </td>

                            <td class="tc">

                                @if($a->latitude && $a->longitude)

                                    <a href="https://www.google.com/maps?q={{ $a->latitude }},{{ $a->longitude }}"
                                       target="_blank"
                                       class="maps-link">

                                        <svg width="12"
                                             height="12"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                            <circle cx="12" cy="10" r="3"/>

                                        </svg>

                                        Lihat

                                    </a>

                                @else

                                    <span class="muted">—</span>

                                @endif

                            </td>

                            <td class="tc">

                                @if($a->foto)

                                    <a href="{{ asset('storage/'.$a->foto) }}"
                                       target="_blank">

                                        <img src="{{ asset('storage/'.$a->foto) }}"
                                             class="foto"
                                             alt="foto">

                                    </a>

                                @else

                                    <span class="muted">—</span>

                                @endif

                            </td>

                            <td style="color:var(--muted);">
                                {{ $a->keterangan ?? '—' }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="empty">

                                Belum ada data absensi untuk periode ini.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection