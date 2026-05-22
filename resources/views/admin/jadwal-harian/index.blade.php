@extends('layouts.admin')

@section('title', 'Jadwal Harian')
@section('header', 'Jadwal Harian')

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

.jadwal-page{
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
    max-width:620px;
}

.top-actions{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;
}

.search-box{
    display:flex;
    align-items:center;
    gap:8px;
    background:#fff;
    border:1px solid var(--border);
    border-radius:10px;
    padding:.65rem .85rem;
    width:270px;
    transition:.15s;
    box-shadow:var(--shadow);
}

.search-box:focus-within{
    border-color:var(--navy-md);
    box-shadow:0 0 0 3px rgba(29,78,216,.08);
}

.search-box svg{
    width:14px;
    height:14px;
    color:var(--hint);
    flex-shrink:0;
}

.search-box input{
    border:none;
    outline:none;
    background:transparent;
    width:100%;
    font-size:13px;
    color:var(--text);
    font-family:'IBM Plex Sans',sans-serif;
}

.search-box input::placeholder{
    color:var(--hint);
}

.btn-primary{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:7px;
    padding:.7rem 1rem;
    border:none;
    border-radius:10px;
    background:var(--navy);
    color:#fff;
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    transition:.15s;
    white-space:nowrap;
}

.btn-primary:hover{
    background:var(--navy-md);
    color:#fff;
    text-decoration:none;
}

/* ───────── TABLE CARD ───────── */
.table-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
    margin-bottom:1.5rem;
}

.table-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:1rem 1.25rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
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
.jadwal-table{
    width:100%;
    border-collapse:collapse;
}

.jadwal-table thead{
    background:var(--navy);
}

.jadwal-table th{
    padding:.85rem 1rem;
    text-align:left;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:rgba(255,255,255,.9);
    white-space:nowrap;
}

.jadwal-table td{
    padding:.95rem 1rem;
    border-bottom:1px solid var(--border);
    font-size:13px;
    color:var(--text);
    vertical-align:middle;
}

.jadwal-table tbody tr{
    transition:.12s;
}

.jadwal-table tbody tr:hover{
    background:#f8fbff;
}

.jadwal-table tbody tr:last-child td{
    border-bottom:none;
}

.td-date{
    font-weight:600;
    color:var(--text);
}

.td-muted{
    color:var(--muted);
}

.td-ket{
    max-width:260px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

/* ───────── BADGE ───────── */
.badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:5px 11px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
}

.badge-semua{
    background:var(--green-lt);
    color:var(--green);
}

.badge-khusus{
    background:var(--amber-lt);
    color:var(--amber);
}

/* ───────── ACTIONS ───────── */
.action-cell{
    display:flex;
    align-items:center;
    justify-content:flex-end;
    gap:8px;
}

.btn-action{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:34px;
    height:34px;
    border-radius:8px;
    border:1px solid var(--border);
    background:#fff;
    text-decoration:none;
    transition:.15s;
    font-size:14px;
    cursor:pointer;
}

.btn-edit{
    background:var(--navy-lt);
    color:var(--navy-md);
    border-color:#93c5fd;
}

.btn-delete{
    background:var(--red-lt);
    color:var(--red);
    border-color:var(--red-bd);
}

.btn-action:hover{
    transform:translateY(-1px);
}

/* ───────── EMPTY ───────── */
.empty-state{
    padding:4rem 1.5rem;
    text-align:center;
}

.empty-icon{
    width:54px;
    height:54px;
    border-radius:14px;
    background:#f1f5f9;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 1rem;
    font-size:24px;
}

.empty-title{
    font-size:15px;
    font-weight:700;
    color:var(--text);
    margin-bottom:4px;
}

.empty-desc{
    font-size:13px;
    color:var(--muted);
    margin-bottom:1rem;
}

.empty-link{
    display:inline-block;
    color:var(--navy-md);
    font-size:13px;
    font-weight:600;
    text-decoration:none;
}

/* ───────── INFO ───────── */
.info-banner{
    display:flex;
    align-items:flex-start;
    gap:12px;
    padding:1rem 1.1rem;
    background:#eff6ff;
    border:1px solid #bfdbfe;
    border-radius:12px;
}

.banner-icon{
    width:40px;
    height:40px;
    border-radius:10px;
    background:var(--navy);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    font-size:18px;
}

.banner-title{
    font-size:14px;
    font-weight:700;
    margin-bottom:4px;
    color:var(--text);
}

.banner-desc{
    font-size:13px;
    line-height:1.7;
    color:var(--muted);
}

/* ───────── RESPONSIVE ───────── */
@media(max-width:900px){

    .jadwal-page{
        padding:1rem;
    }

    .top-bar{
        flex-direction:column;
        align-items:stretch;
    }

    .top-actions{
        width:100%;
    }

    .search-box{
        width:100%;
    }

}
</style>

<div class="jadwal-page">

    {{-- TOPBAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                📅
            </div>

            <div class="title-text">

                <h1>Jadwal Harian</h1>

                <p>
                    Kelola jadwal operasional sekolah berdasarkan tanggal,
                    mode kegiatan, dan informasi tambahan lainnya.
                </p>

            </div>

        </div>

        <div class="top-actions">

            {{-- SEARCH --}}
            <div class="search-box">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2">

                    <circle cx="11"
                            cy="11"
                            r="8"/>

                    <path d="M21 21l-4.35-4.35"/>

                </svg>

                <input type="text"
                       id="searchInput"
                       placeholder="Cari tanggal / keterangan...">

            </div>

            {{-- BUTTON --}}
            <a href="{{ route('admin.jadwal-harian.create') }}"
               class="btn-primary">

                + Tambah Jadwal

            </a>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">

            <div class="table-title">
                Data Jadwal Harian
            </div>

            <div class="table-meta">
                Total {{ $jadwal->count() }} data
            </div>

        </div>

        <div class="table-wrap">

            <table class="jadwal-table"
                   id="jadwalTable">

                <thead>

                    <tr>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Mode</th>
                        <th>Keterangan</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($jadwal as $item)

                    <tr class="jadwal-row"
                        data-search="{{ strtolower($item->tanggal . ' ' . $item->hari . ' ' . $item->keterangan) }}">

                        <td class="td-date">
                            {{ $item->tanggal }}
                        </td>

                        <td class="td-muted">
                            {{ $item->hari }}
                        </td>

                        <td>

                            @if($item->mode === 'SEMUA')

                            <span class="badge badge-semua">
                                {{ $item->mode }}
                            </span>

                            @else

                            <span class="badge badge-khusus">
                                {{ $item->mode }}
                            </span>

                            @endif

                        </td>

                        <td class="td-muted td-ket">
                            {{ $item->keterangan }}
                        </td>

                        <td>

                            <div class="action-cell">

                                {{-- EDIT --}}
                                <a href="{{ route('admin.jadwal-harian.edit', $item->id) }}"
                                   class="btn-action btn-edit">

                                    ✏️

                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('admin.jadwal-harian.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus jadwal ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-action btn-delete">

                                        🗑️

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    📅
                                </div>

                                <div class="empty-title">
                                    Belum Ada Jadwal
                                </div>

                                <div class="empty-desc">
                                    Mulai tambahkan jadwal harian pertama untuk sistem operasional sekolah.
                                </div>

                                <a href="{{ route('admin.jadwal-harian.create') }}"
                                   class="empty-link">

                                    Tambah Jadwal →

                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- INFO --}}
    <div class="info-banner">

        <div class="banner-icon">
            ℹ️
        </div>

        <div>

            <div class="banner-title">
                Informasi Jadwal
            </div>

            <div class="banner-desc">
                Mode <strong>SEMUA</strong> berlaku untuk seluruh kegiatan sekolah.
                Gunakan kolom keterangan untuk memberikan informasi tambahan
                terkait jadwal operasional harian.
            </div>

        </div>

    </div>

</div>

<script>
const searchInput = document.getElementById('searchInput');

if(searchInput){

    searchInput.addEventListener('input', function(){

        const q = this.value.toLowerCase().trim();

        document.querySelectorAll('.jadwal-row')
            .forEach(row => {

                const match =
                    row.dataset.search.includes(q);

                row.style.display =
                    match ? '' : 'none';

            });

    });

}
</script>

@endsection