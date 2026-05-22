@extends('layouts.bendahara')

@section('title', 'Rekap Gaji Bulanan')

@section('content')

@php
    $namaBulan = \Carbon\Carbon::create(null, $bulan, 1)->translatedFormat('F');
@endphp

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
    --green-bd:#86efac;

    --amber:#d97706;
    --amber-lt:#fffbeb;
    --amber-bd:#fcd34d;

    --red:#dc2626;
    --red-lt:#fff1f2;
    --red-bd:#fecdd3;

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
   ALERT
───────────────────────── */
.alert{
    display:flex;
    align-items:flex-start;
    gap:12px;
    padding:1rem;
    border-radius:10px;
    margin-bottom:1.5rem;
}

.alert-success{
    background:var(--green-lt);
    border:1px solid var(--green-bd);
}

.alert-error{
    background:var(--red-lt);
    border:1px solid var(--red-bd);
}

.alert-icon{
    width:20px;
    height:20px;
    flex-shrink:0;
}

.alert-success .alert-icon{
    color:var(--green);
}

.alert-error .alert-icon{
    color:var(--red);
}

.alert-content{
    flex:1;
}

.alert-title{
    font-size:13px;
    font-weight:700;
    margin-bottom:4px;
}

.alert-success .alert-title{
    color:var(--green);
}

.alert-error .alert-title{
    color:var(--red);
}

.alert-text{
    font-size:12px;
    line-height:1.6;
}

.alert-success .alert-text{
    color:#166534;
}

.alert-error .alert-text{
    color:#991b1b;
}

/* ─────────────────────────
   INFO BANNER
───────────────────────── */
.info-banner{
    background:var(--navy-lt);
    border:1px solid #bfdbfe;
    border-radius:12px;
    padding:1rem 1.25rem;
    margin-bottom:1.5rem;
    display:flex;
    align-items:flex-start;
    gap:12px;
}

.info-banner-icon{
    width:22px;
    height:22px;
    color:var(--navy-md);
    flex-shrink:0;
    margin-top:1px;
}

.info-banner-content{
    flex:1;
}

.info-banner-title{
    font-size:13px;
    font-weight:700;
    color:var(--navy);
    margin-bottom:6px;
}

.info-banner-text{
    font-size:12px;
    line-height:1.7;
    color:#1d4ed8;
}

.info-banner-list{
    margin-top:10px;
    display:grid;
    gap:8px;
}

.info-item{
    display:flex;
    align-items:flex-start;
    gap:8px;
    font-size:12px;
    color:#1d4ed8;
    line-height:1.6;
}

.info-dot{
    width:6px;
    height:6px;
    background:var(--navy-md);
    border-radius:999px;
    margin-top:7px;
    flex-shrink:0;
}

/* ─────────────────────────
   FILTER CARD
───────────────────────── */
.filter-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    overflow:hidden;
    margin-bottom:1.5rem;
}

.filter-header{
    padding:1rem 1.5rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
}

.filter-header h2{
    font-size:14px;
    font-weight:600;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    margin:0;
}

.filter-body{
    padding:1.5rem;
}

.filter-form{
    display:flex;
    align-items:end;
    gap:1rem;
    flex-wrap:wrap;
}

.form-group{
    display:flex;
    flex-direction:column;
    gap:6px;
    min-width:180px;
}

.form-group label{
    font-size:12px;
    font-weight:600;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
}

.form-input,
.form-select{
    width:100%;
    padding:10px 14px;
    border:1px solid var(--border);
    border-radius:10px;
    font-size:14px;
    background:white;
    transition:all .15s ease;
}

.form-input:focus,
.form-select:focus{
    outline:none;
    border-color:var(--navy-md);
    box-shadow:0 0 0 3px rgba(29,78,216,.1);
}

/* ─────────────────────────
   BUTTONS
───────────────────────── */
.action-group{
    display:flex;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
}

.btn-primary,
.btn-outline,
.btn-success,
.btn-emerald{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 18px;
    border:none;
    border-radius:10px;
    color:white;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:all .15s ease;
}

.btn-outline{
    background:#fff;
    color:var(--navy-md);
    border:1px solid #bfdbfe;
}

.btn-outline:hover{
    background:var(--navy-lt);
    color:var(--navy);
}

.btn-primary{
    background:var(--navy-md);
}

.btn-primary:hover{
    background:var(--navy);
}

.btn-success{
    background:var(--green);
}

.btn-success:hover{
    background:#15803d;
}

.btn-emerald{
    background:#059669;
}

.btn-emerald:hover{
    background:#047857;
}

/* ─────────────────────────
   STATS
───────────────────────── */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
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
    font-size:22px;
    font-weight:700;
    line-height:1.3;
}

.stat-blue{ color:var(--navy-md); }
.stat-green{ color:var(--green); }
.stat-amber{ color:var(--amber); }

/* ─────────────────────────
   TABLE
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

.table-wrap{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:1200px;
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
    font-size:12px;
    color:var(--text);
}

tbody tr:last-child td{
    border-bottom:none;
}

tbody tr:hover{
    background:#fafafa;
}

.tc{
    text-align:center;
}

.tr{
    text-align:right;
}

/* ─────────────────────────
   GURU CELL
───────────────────────── */
.guru-link{
    display:flex;
    align-items:center;
    gap:10px;
    color:var(--navy-md);
    text-decoration:none;
    font-weight:600;
}

.guru-link:hover{
    color:var(--navy);
}

.guru-avatar{
    width:32px;
    height:32px;
    border-radius:999px;
    background:var(--navy-lt);
    color:var(--navy-md);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:12px;
    font-weight:700;
    flex-shrink:0;
}

/* ─────────────────────────
   BADGE
───────────────────────── */
.badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:4px 8px;
    border-radius:999px;
    font-size:11px;
    font-weight:600;
    white-space:nowrap;
}

.badge-green{
    background:var(--green-lt);
    color:var(--green);
}

.badge-red{
    background:var(--red-lt);
    color:var(--red);
}

.badge-blue{
    background:var(--navy-lt);
    color:var(--navy-md);
}

.total-text{
    font-size:13px;
    font-weight:700;
    color:var(--text);
}

.empty{
    text-align:center;
    padding:3rem 1rem !important;
    color:var(--hint);
    font-size:13px;
}

/* ─────────────────────────
   RESPONSIVE
───────────────────────── */
@media (max-width:768px){

    .rb-page{
        padding:1rem;
    }

    .filter-form{
        flex-direction:column;
        align-items:stretch;
    }

    .form-group{
        min-width:100%;
    }

    .action-group{
        width:100%;
        flex-direction:column;
        align-items:stretch;
    }

    .btn-primary,
    .btn-outline,
    .btn-success,
    .btn-emerald{
        justify-content:center;
    }

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

                    <path d="M12 1v22"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14.5a3.5 3.5 0 0 1 0 7H6"/>

                </svg>

            </div>

            <div class="title-text">

                <h1>Rekap Gaji Bulanan</h1>

                <p>
                    Kelola rekap gaji guru
                    &mdash;
                    <strong>{{ $namaBulan }} {{ $tahun }}</strong>
                </p>

            </div>

        </div>

    </div>

    {{-- SUCCESS --}}
    @if(session('success'))

    <div class="alert alert-success">

        <div class="alert-icon">

            <svg width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <path d="M20 6 9 17l-5-5"/>

            </svg>

        </div>

        <div class="alert-content">

            <div class="alert-title">
                Berhasil
            </div>

            <div class="alert-text">
                {{ session('success') }}
            </div>

        </div>

    </div>

    @endif

    {{-- ERROR --}}
    @if(session('error'))

    <div class="alert alert-error">

        <div class="alert-icon">

            <svg width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>

            </svg>

        </div>

        <div class="alert-content">

            <div class="alert-title">
                Gagal
            </div>

            <div class="alert-text">
                {{ session('error') }}
            </div>

        </div>

    </div>

    @endif

    {{-- ═════════ INFO BANNER ═════════ --}}
    <div class="info-banner">

        <div class="info-banner-icon">

            <svg width="22"
                 height="22"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>

            </svg>

        </div>

        <div class="info-banner-content">

            <div class="info-banner-title">
                Informasi Rekap Gaji Guru
            </div>

            <div class="info-banner-text">
                Halaman ini digunakan untuk melihat total perhitungan gaji seluruh guru berdasarkan periode bulan tertentu.
                Sistem akan menghitung total gaji dari kombinasi gaji pokok, tunjangan tambahan, transport kehadiran,
                bonus tahfidz, serta pengurangan atau potongan gaji.
            </div>

            <div class="info-banner-list">

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        Klik <strong>nama guru</strong> untuk melihat detail slip gaji lengkap.
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        Tombol <strong>Cetak Semua Slip</strong> digunakan untuk mencetak seluruh slip gaji guru dalam satu periode.
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        Tombol <strong>Kirim Slip Gaji</strong> digunakan untuk mengirim slip gaji otomatis ke seluruh guru.
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        Total gaji akhir dihitung dari:
                        <strong>
                            Gaji Pokok + Tunjangan + Transport + Tahfidz - Potongan
                        </strong>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        Gunakan filter bulan dan tahun untuk melihat data rekap periode sebelumnya atau berikutnya.
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- ═════════ FILTER ═════════ --}}
    <div class="filter-card">

        <div class="filter-header">
            <h2>📅 Filter Periode & Aksi</h2>
        </div>

        <div class="filter-body">

            <form method="GET"
                  class="filter-form">

                <div class="form-group">

                    <label>Bulan</label>

                    <select name="bulan"
                            class="form-select">

                        @for ($i = 1; $i <= 12; $i++)

                            <option value="{{ $i }}"
                                {{ $bulan == $i ? 'selected' : '' }}>

                                {{ \Carbon\Carbon::create(null, $i, 1)->translatedFormat('F') }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="form-group">

                    <label>Tahun</label>

                    <select name="tahun"
                            class="form-select">

                        @for ($y = now()->year - 2; $y <= now()->year + 1; $y++)

                            <option value="{{ $y }}"
                                {{ $tahun == $y ? 'selected' : '' }}>

                                {{ $y }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="action-group">

                    <button type="submit"
                            class="btn-primary">

                        <svg width="14"
                             height="14"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>

                        </svg>

                        Tampilkan

                    </button>

                    <a href="{{ route('bendahara.rekap-gaji.cetak-rekap-pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                       target="_blank"
                       rel="noopener"
                       class="btn-outline">

                        <svg width="14"
                             height="14"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <path d="M14 2v6h6"/>
                            <path d="M16 13H8"/>
                            <path d="M16 17H8"/>
                            <path d="M10 9H8"/>

                        </svg>

                        Cetak PDF Rekap Gaji

                    </a>

                    <a href="{{ route('bendahara.rekap-gaji.cetak-semua', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                       target="_blank"
                       class="btn-success">

                        <svg width="14"
                             height="14"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M6 9V2h12v7"/>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                            <rect x="6" y="14" width="12" height="8"/>

                        </svg>

                        Cetak Semua Slip

                    </a>

                    <form method="POST"
                          action="{{ route('bendahara.rekap-gaji.kirim-slip') }}"
                          onsubmit="return confirm('Kirim slip gaji periode {{ $namaBulan }} {{ $tahun }} ke semua guru?')">

                        @csrf

                        <input type="hidden"
                               name="bulan"
                               value="{{ $bulan }}">

                        <input type="hidden"
                               name="tahun"
                               value="{{ $tahun }}">

                        <button type="submit"
                                class="btn-emerald">

                            <svg width="14"
                                 height="14"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path d="m22 2-7 20-4-9-9-4Z"/>
                                <path d="M22 2 11 13"/>

                            </svg>

                            Kirim Slip Gaji

                        </button>

                    </form>

                </div>

            </form>

        </div>

    </div>

    {{-- ═════════ STATS ═════════ --}}
    @if(count($rekap) > 0)

    @php
        $totalGajiPokok = collect($rekap)->sum('gaji_pokok');
        $totalDibayar = collect($rekap)->sum('total');
    @endphp

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Total Guru</div>
            <div class="stat-value stat-blue">
                {{ count($rekap) }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Periode</div>
            <div class="stat-value stat-blue">
                {{ $namaBulan }} {{ $tahun }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Gaji Pokok</div>
            <div class="stat-value stat-green">
                Rp {{ number_format($totalGajiPokok,0,',','.') }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Dibayar</div>
            <div class="stat-value stat-amber">
                Rp {{ number_format($totalDibayar,0,',','.') }}
            </div>
        </div>

    </div>

    @endif

    {{-- ═════════ TABLE ═════════ --}}
    <div class="table-card">

        <div class="table-header">

            <h2>💰 Rekap Gaji Guru</h2>

            <span>
                {{ count($rekap) }} data guru
            </span>

        </div>

        <div class="table-wrap">

            <table>

                <thead>

                    <tr>
                        <th class="tc">No</th>
                        <th>Guru</th>
                        <th class="tr">Mengajar</th>
                        <th class="tr">Tunjangan</th>
                        <th class="tr">Potongan</th>
                        <th class="tc">Hadir</th>
                        <th class="tr">Transport</th>
                        <th class="tr">Tahfidz</th>
                        <th class="tr">Total</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($rekap as $i => $item)

                    <tr>

                        <td class="tc">
                            {{ $i + 1 }}
                        </td>

                        <td>

                            <a href="{{ route('bendahara.rekap-gaji.show', [
                                    'guru' => $item['guru']->id,
                                    'bulan' => $bulan,
                                    'tahun' => $tahun
                                ]) }}"
                               class="guru-link">

                                <div class="guru-avatar">

                                    {{ substr($item['guru']->nama,0,1) }}

                                </div>

                                {{ $item['guru']->nama }}

                            </a>

                        </td>

                        <td class="tr">
                            Rp {{ number_format($item['gaji_pokok'],0,',','.') }}
                        </td>

                        <td class="tr">

                            <span class="badge badge-green">

                                +Rp {{ number_format($item['penambahan'],0,',','.') }}

                            </span>

                        </td>

                        <td class="tr">

                            <span class="badge badge-red">

                                -Rp {{ number_format($item['pengurangan'],0,',','.') }}

                            </span>

                        </td>

                        <td class="tc">

                            <span class="badge badge-blue">

                                {{ $item['hadir_final'] }} hari

                            </span>

                        </td>

                        <td class="tr">

                            <span class="badge badge-green">

                                +Rp {{ number_format($item['transport'],0,',','.') }}

                            </span>

                        </td>

                        <td class="tr">

                            <span class="badge badge-green">

                                +Rp {{ number_format($item['tahfidz'],0,',','.') }}

                            </span>

                        </td>

                        <td class="tr">

                            <span class="total-text">

                                Rp {{ number_format($item['total'],0,',','.') }}

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="9"
                            class="empty">

                            Belum ada data rekap gaji untuk periode ini.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
