@extends('layouts.bendahara')

@section('title', 'Detail Gaji - ' . $guru->nama)

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
   BUTTONS
───────────────────────── */
.btn-secondary,
.btn-primary,
.btn-success{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 18px;
    border-radius:10px;
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    border:none;
    cursor:pointer;
    transition:.15s ease;
}

.btn-secondary{
    background:#fff;
    color:var(--muted);
    border:1px solid var(--border);
}

.btn-secondary:hover{
    background:#f8fafc;
    color:var(--text);
}

.btn-primary{
    background:var(--navy-md);
    color:white;
}

.btn-primary:hover{
    background:var(--navy);
}

.btn-success{
    background:var(--green);
    color:white;
}

.btn-success:hover{
    background:#15803d;
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
}

.stat-blue{ color:var(--navy-md); }
.stat-green{ color:var(--green); }
.stat-red{ color:var(--red); }

/* ─────────────────────────
   CARD
───────────────────────── */
.content-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
    margin-bottom:1.5rem;
}

.card-header{
    padding:1rem 1.5rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
}

.card-header h2{
    font-size:14px;
    font-weight:600;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    margin:0;
}

.card-body{
    padding:1.5rem;
}

/* ─────────────────────────
   GRID
───────────────────────── */
.info-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:1rem;
}

.info-item-card{
    padding:1rem;
    border:1px solid var(--border);
    border-radius:10px;
    background:#fafafa;
}

.info-label{
    font-size:11px;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.05em;
    margin-bottom:6px;
    font-weight:600;
}

.info-value{
    font-size:15px;
    font-weight:700;
    color:var(--text);
}

/* ─────────────────────────
   LIST
───────────────────────── */
.detail-list{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.detail-row{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding-bottom:12px;
    border-bottom:1px solid #f1f5f9;
}

.detail-row:last-child{
    border-bottom:none;
    padding-bottom:0;
}

.detail-label{
    font-size:13px;
    color:var(--muted);
}

.detail-value{
    font-size:13px;
    font-weight:600;
    color:var(--text);
}

.value-green{
    color:var(--green);
}

.value-red{
    color:var(--red);
}

.value-blue{
    color:var(--navy-md);
}

.value-bold{
    font-size:18px;
    font-weight:700;
}

.total-box{
    margin-top:1.5rem;
    background:var(--navy-lt);
    border:1px solid #bfdbfe;
    border-radius:12px;
    padding:1rem 1.25rem;
}

.total-box .detail-label{
    font-size:14px;
    font-weight:700;
    color:var(--navy);
}

.total-box .detail-value{
    font-size:22px;
    font-weight:700;
    color:var(--navy-md);
}

/* ─────────────────────────
   SUB LIST
───────────────────────── */
.sub-list{
    margin-top:10px;
    display:grid;
    gap:10px;
}

.sub-item{
    background:#fafafa;
    border:1px solid var(--border);
    border-radius:10px;
    padding:12px;
}

.sub-item-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
}

.sub-item-title{
    font-size:13px;
    font-weight:600;
    color:var(--text);
}

.sub-item-type{
    font-size:11px;
    color:var(--hint);
    margin-top:2px;
}

.sub-item-value{
    font-size:13px;
    font-weight:700;
}

.subtotal{
    margin-top:12px;
    padding:12px;
    border-radius:10px;
    font-size:13px;
    font-weight:700;
    display:flex;
    justify-content:space-between;
}

.subtotal-green{
    background:var(--green-lt);
    color:var(--green);
}

.subtotal-red{
    background:var(--red-lt);
    color:var(--red);
}

/* ─────────────────────────
   ACTIONS
───────────────────────── */
.action-wrap{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.action-wrap .btn-primary{
    font-size:0;
}

.action-wrap .btn-primary::after{
    content:'Preview PDF';
    font-size:13px;
}

/* ─────────────────────────
   RESPONSIVE
───────────────────────── */
@media (max-width:768px){

    .rb-page{
        padding:1rem;
    }

    .action-wrap{
        flex-direction:column;
    }

    .btn-secondary,
    .btn-primary,
    .btn-success{
        justify-content:center;
    }

}

@media print{

    body *{
        visibility:hidden;
    }

    .rb-page,
    .rb-page *{
        visibility:visible;
    }

    .rb-page{
        position:absolute;
        left:0;
        top:0;
        width:100%;
        background:white;
    }

    .btn-secondary,
    .btn-primary,
    .btn-success{
        display:none !important;
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
                     stroke-width="2">

                    <path d="M12 1v22"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14.5a3.5 3.5 0 0 1 0 7H6"/>

                </svg>

            </div>

            <div class="title-text">

                <h1>Detail Gaji Guru</h1>

                <p>
                    Detail perhitungan gaji
                    &mdash;
                    <strong>
                        {{ \Carbon\Carbon::create(null, $bulan, 1)->translatedFormat('F') }}
                        {{ $tahun }}
                    </strong>
                </p>

            </div>

        </div>

        <a href="{{ route('bendahara.rekap-gaji.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
           class="btn-secondary">

            ← Kembali

        </a>

    </div>

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
                Informasi Detail Gaji Guru
            </div>

            <div class="info-banner-text">
                Halaman ini menampilkan rincian lengkap perhitungan gaji guru berdasarkan periode yang dipilih.
                Semua komponen gaji dihitung otomatis berdasarkan data absensi, transport, bonus tambahan,
                tahfidz, serta pengurangan atau potongan yang berlaku.
            </div>

            <div class="info-banner-list">

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        <strong>Hadir Final</strong> adalah total kehadiran setelah koreksi manual diterapkan.
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        <strong>Transport</strong> dihitung otomatis berdasarkan jumlah hadir final × tarif transport per hari.
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        <strong>Penambahan</strong> berisi bonus, tunjangan, atau insentif tambahan.
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        <strong>Pengurangan</strong> berisi potongan gaji, kas, atau pengurangan lainnya.
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot"></div>
                    <div>
                        Gunakan tombol <strong>Preview PDF</strong> atau <strong>Download PDF</strong> untuk mencetak slip gaji resmi.
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- ═════════ STATS ═════════ --}}
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Hadir Final</div>
            <div class="stat-value stat-blue">
                {{ $hadirFinal }} Hari
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Transport</div>
            <div class="stat-value stat-green">
                Rp {{ number_format($transport,0,',','.') }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Gaji</div>
            <div class="stat-value stat-blue">
                Rp {{ number_format($totalGaji,0,',','.') }}
            </div>
        </div>

    </div>

    {{-- ═════════ INFO GURU ═════════ --}}
    <div class="content-card">

        <div class="card-header">
            <h2>👨‍🏫 Informasi Guru</h2>
        </div>

        <div class="card-body">

            <div class="info-grid">

                <div class="info-item-card">

                    <div class="info-label">
                        Nama Lengkap
                    </div>

                    <div class="info-value">
                        {{ $guru->nama }}
                    </div>

                </div>

                @if(isset($guru->nip))

                <div class="info-item-card">

                    <div class="info-label">
                        NIP
                    </div>

                    <div class="info-value">
                        {{ $guru->nip }}
                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

    {{-- ═════════ KEHADIRAN ═════════ --}}
    <div class="content-card">

        <div class="card-header">
            <h2>📅 Detail Kehadiran</h2>
        </div>

        <div class="card-body">

            <div class="detail-list">

                <div class="detail-row">

                    <div class="detail-label">
                        Hadir Asli (dari absensi)
                    </div>

                    <div class="detail-value">
                        {{ $hadirAsli }} hari
                    </div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">
                        Koreksi Kehadiran
                    </div>

                    <div class="detail-value
                        {{ $koreksi > 0 ? 'value-green' : ($koreksi < 0 ? 'value-red' : '') }}">

                        {{ $koreksi > 0 ? '+' : '' }}{{ $koreksi }} hari

                    </div>

                </div>

                @if($keteranganKoreksi != '-')

                <div class="detail-row">

                    <div class="detail-label">
                        Keterangan Koreksi
                    </div>

                    <div class="detail-value">
                        {{ $keteranganKoreksi }}
                    </div>

                </div>

                @endif

                <div class="total-box">

                    <div class="detail-row">

                        <div class="detail-label">
                            Hadir Final
                        </div>

                        <div class="detail-value value-blue value-bold">
                            {{ $hadirFinal }} hari
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ═════════ RINCIAN GAJI ═════════ --}}
    <div class="content-card">

        <div class="card-header">
            <h2>💰 Rincian Gaji</h2>
        </div>

        <div class="card-body">

            <div class="detail-list">

                <div class="detail-row">

                    <div class="detail-label">
                        Gaji Pokok
                    </div>

                    <div class="detail-value">
                        Rp {{ number_format($gajiPokok,0,',','.') }}
                    </div>

                </div>

                @if($tahfidz > 0)

                <div class="detail-row">

                    <div>

                        <div class="detail-label">
                            Insentif Tahfidz
                        </div>

                        @if($hadirTahfidz > 0)

                        <div style="font-size:11px;color:var(--hint);margin-top:4px;">
                            {{ $hadirTahfidz }} hari ×
                            Rp {{ number_format($tarifTahfidz,0,',','.') }}
                        </div>

                        @endif

                    </div>

                    <div class="detail-value value-green">
                        Rp {{ number_format($tahfidz,0,',','.') }}
                    </div>

                </div>

                @endif

                <div class="detail-row">

                    <div>

                        <div class="detail-label">
                            Transport
                        </div>

                        <div style="font-size:11px;color:var(--hint);margin-top:4px;">
                            {{ $hadirFinal }} hari ×
                            Rp {{ number_format($transportPerHari,0,',','.') }}
                        </div>

                    </div>

                    <div class="detail-value value-green">
                        Rp {{ number_format($transport,0,',','.') }}
                    </div>

                </div>

            </div>

            {{-- PENAMBAHAN --}}
            @if($penambahanList->count() > 0)

            <div style="margin-top:1.5rem;">

                <div class="info-label"
                     style="margin-bottom:10px;">
                    Penambahan
                </div>

                <div class="sub-list">

                    @foreach($penambahanList as $item)

                    <div class="sub-item">

                        <div class="sub-item-top">

                            <div>

                                <div class="sub-item-title">
                                    {{ $item->judul }}
                                </div>

                                <div class="sub-item-type">
                                    {{ $item->tipe }}
                                </div>

                            </div>

                            <div class="sub-item-value value-green">

                                + Rp {{ number_format($item->jumlah,0,',','.') }}

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                <div class="subtotal subtotal-green">

                    <span>Subtotal Penambahan</span>

                    <span>
                        Rp {{ number_format($totalPenambahan,0,',','.') }}
                    </span>

                </div>

            </div>

            @endif

            {{-- PENGURANGAN --}}
            @if($penguranganList->count() > 0)

            <div style="margin-top:1.5rem;">

                <div class="info-label"
                     style="margin-bottom:10px;">
                    Pengurangan
                </div>

                <div class="sub-list">

                    @foreach($penguranganList as $item)

                    <div class="sub-item">

                        <div class="sub-item-top">

                            <div>

                                <div class="sub-item-title">
                                    {{ $item->judul }}
                                </div>

                                <div class="sub-item-type">
                                    {{ $item->tipe }}
                                </div>

                            </div>

                            <div class="sub-item-value value-red">

                                - Rp {{ number_format($item->jumlah,0,',','.') }}

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                <div class="subtotal subtotal-red">

                    <span>Subtotal Pengurangan</span>

                    <span>
                        Rp {{ number_format($totalPengurangan,0,',','.') }}
                    </span>

                </div>

            </div>

            @endif

            {{-- TOTAL --}}
            <div class="total-box">

                <div class="detail-row">

                    <div class="detail-label">
                        TOTAL GAJI
                    </div>

                    <div class="detail-value value-blue value-bold">

                        Rp {{ number_format($totalGaji,0,',','.') }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ═════════ ACTIONS ═════════ --}}
    <div class="action-wrap">

        <a href="{{ route('bendahara.rekap-gaji.cetak-pdf', ['guruId' => $guru->id, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
           target="_blank"
           rel="noopener"
           class="btn-primary">

            🖨️ Cetak Slip Gaji

        </a>

        <a href="{{ route('bendahara.rekap-gaji.download-pdf', ['guruId' => $guru->id, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
           class="btn-success">

            Download PDF

        </a>

        <a href="{{ route('bendahara.rekap-gaji.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
           class="btn-secondary">

            Kembali ke Daftar

        </a>

    </div>

</div>

@endsection
