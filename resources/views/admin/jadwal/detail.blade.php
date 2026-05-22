@extends('layouts.admin')

@section('title', 'Jadwal Guru')
@section('header', 'Jadwal Guru')

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

.jadwal-detail-page{
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

.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:7px;
    padding:.7rem 1rem;
    border:1px solid var(--border);
    border-radius:10px;
    background:#fff;
    color:var(--text);
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    transition:.15s;
    box-shadow:var(--shadow);
}

.btn-back:hover{
    background:#f8fafc;
    text-decoration:none;
    color:var(--text);
}

/* ───────── ALERT ───────── */
.alert-success{
    display:flex;
    align-items:center;
    gap:8px;
    padding:.85rem 1rem;
    background:var(--green-lt);
    border:1px solid var(--green-bd);
    border-radius:10px;
    font-size:13px;
    font-weight:600;
    color:var(--green);
    margin-bottom:1.5rem;
}

/* ───────── GRID ───────── */
.content-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:20px;
}

/* ───────── CARD ───────── */
.card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:var(--shadow);
}

.card-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    padding:1rem 1.25rem;
    border-bottom:1px solid var(--border);
    background:#fdfdfd;
    flex-wrap:wrap;
}

.card-title{
    font-size:15px;
    font-weight:700;
    color:var(--text);
    margin-bottom:3px;
}

.card-subtitle{
    font-size:12px;
    color:var(--muted);
}

/* ───────── GURU TERJADWAL ───────── */
.guru-list{
    display:flex;
    flex-direction:column;
}

.guru-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:1rem 1.25rem;
    border-bottom:1px solid var(--border);
    transition:.15s;
}

.guru-item:last-child{
    border-bottom:none;
}

.guru-item:hover{
    background:#f8fbff;
}

.guru-left{
    display:flex;
    align-items:center;
    gap:12px;
}

.guru-avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:var(--navy-lt);
    color:var(--navy-md);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
    font-weight:700;
    flex-shrink:0;
}

.guru-name{
    font-size:14px;
    font-weight:600;
    color:var(--text);
}

.btn-delete{
    border:none;
    background:var(--red-lt);
    color:var(--red);
    border:1px solid #fecdd3;
    padding:7px 12px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
    cursor:pointer;
    transition:.15s;
}

.btn-delete:hover{
    transform:translateY(-1px);
}

/* ───────── EMPTY ───────── */
.empty-state{
    padding:3rem 1.5rem;
    text-align:center;
}

.empty-icon{
    width:52px;
    height:52px;
    border-radius:14px;
    background:#f1f5f9;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 1rem;
    font-size:22px;
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
}

/* ───────── ACTION BUTTON ───────── */
.action-buttons{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:1rem;
    flex-wrap:wrap;
}

.btn-secondary{
    padding:.65rem 1rem;
    border:1px solid var(--border);
    border-radius:10px;
    background:#fff;
    color:var(--text);
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:.15s;
}

.btn-secondary:hover{
    background:#f8fafc;
}

.selected-badge{
    display:inline-flex;
    align-items:center;
    padding:6px 12px;
    border-radius:999px;
    background:var(--navy-lt);
    color:var(--navy-md);
    font-size:12px;
    font-weight:700;
}

/* ───────── CHECKBOX GRID ───────── */
.checkbox-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:10px;
    max-height:340px;
    overflow-y:auto;
    margin-bottom:1rem;
    padding-right:4px;
}

.checkbox-item{
    display:flex;
    align-items:center;
    gap:10px;
    padding:.9rem 1rem;
    border:1px solid var(--border);
    border-radius:10px;
    cursor:pointer;
    transition:.15s;
}

.checkbox-item:hover{
    background:#f8fbff;
    border-color:#bfdbfe;
}

.checkbox-item input{
    width:16px;
    height:16px;
    accent-color:var(--navy-md);
    flex-shrink:0;
}

.checkbox-name{
    font-size:13px;
    color:var(--text);
    font-weight:500;
}

.error-text{
    color:var(--red);
    font-size:12px;
    margin-bottom:1rem;
}

.btn-submit{
    width:100%;
    padding:.9rem 1rem;
    border:none;
    border-radius:10px;
    background:var(--navy);
    color:#fff;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
    transition:.15s;
}

.btn-submit:hover{
    background:var(--navy-md);
}

/* ───────── SIDEBAR ───────── */
.sidebar{
    display:flex;
    flex-direction:column;
    gap:16px;
}

.info-box{
    background:#fff;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:1rem 1.1rem;
    box-shadow:var(--shadow);
}

.info-title{
    font-size:14px;
    font-weight:700;
    color:var(--text);
    margin-bottom:8px;
}

.info-list{
    display:flex;
    flex-direction:column;
    gap:10px;
}

.info-item{
    display:flex;
    align-items:flex-start;
    gap:8px;
    font-size:13px;
    color:var(--muted);
    line-height:1.6;
}

.info-dot{
    width:8px;
    height:8px;
    border-radius:50%;
    background:var(--navy-md);
    margin-top:6px;
    flex-shrink:0;
}

/* ───────── RESPONSIVE ───────── */
@media(max-width:1000px){

    .content-grid{
        grid-template-columns:1fr;
    }

}

@media(max-width:900px){

    .jadwal-detail-page{
        padding:1rem;
    }

    .top-bar{
        flex-direction:column;
        align-items:stretch;
    }

}

@media(max-width:640px){

    .checkbox-grid{
        grid-template-columns:1fr;
    }

}
</style>

<div class="jadwal-detail-page">

    {{-- TOPBAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                📅
            </div>

            <div class="title-text">

                <h1>
                    Jadwal Guru - {{ $hari->nama_hari }}
                </h1>

                <p>
                    Atur distribusi guru mengajar dan kelola jadwal pembelajaran harian.
                </p>

            </div>

        </div>

        <a href="{{ url()->previous() }}"
           class="btn-back">

            ← Kembali

        </a>

    </div>

    {{-- ALERT --}}
    @if (session('success'))

    <div class="alert-success">
        ✅ {{ session('success') }}
    </div>

    @endif

    <div class="content-grid">

        {{-- LEFT --}}
        <div style="display:flex;flex-direction:column;gap:20px;">

            {{-- GURU TERJADWAL --}}
            <div class="card">

                <div class="card-header">

                    <div>

                        <div class="card-title">
                            Guru Terjadwal
                        </div>

                        <div class="card-subtitle">
                            {{ $guruTerjadwal->count() }} guru aktif di hari {{ $hari->nama_hari }}
                        </div>

                    </div>

                </div>

                @if ($guruTerjadwal->isEmpty())

                <div class="empty-state">

                    <div class="empty-icon">
                        👨‍🏫
                    </div>

                    <div class="empty-title">
                        Belum Ada Guru
                    </div>

                    <div class="empty-desc">
                        Belum ada guru yang dijadwalkan di hari ini.
                    </div>

                </div>

                @else

                <div class="guru-list">

                    @foreach ($guruTerjadwal as $jg)

                    <div class="guru-item">

                        <div class="guru-left">

                            <div class="guru-avatar">
                                {{ substr($jg->guru->nama, 0, 1) }}
                            </div>

                            <div class="guru-name">
                                {{ $jg->guru->nama }}
                            </div>

                        </div>

                        <form action="{{ route('admin.jadwal.destroy', $jg->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus dari {{ $hari->nama_hari }}?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn-delete">

                                Hapus

                            </button>

                        </form>

                    </div>

                    @endforeach

                </div>

                @endif

            </div>

            {{-- TAMBAH GURU --}}
            <div class="card">

                <div class="card-header">

                    <div>

                        <div class="card-title">
                            Tambah Guru
                        </div>

                        <div class="card-subtitle">
                            Pilih guru untuk ditambahkan ke jadwal
                        </div>

                    </div>

                    <span id="selectedCount"
                          class="selected-badge">

                        0 dipilih

                    </span>

                </div>

                <div style="padding:1.25rem;">

                    {{-- ACTION --}}
                    <div class="action-buttons">

                        <button type="button"
                                onclick="toggleAll(true)"
                                class="btn-secondary">

                            Pilih Semua

                        </button>

                        <button type="button"
                                onclick="toggleAll(false)"
                                class="btn-secondary">

                            Reset

                        </button>

                    </div>

                    <form action="{{ route('admin.jadwal.store') }}"
                          method="POST">

                        @csrf

                        <input type="hidden"
                               name="hari_id"
                               value="{{ $hari->id }}">

                        {{-- LIST GURU --}}
                        <div class="checkbox-grid">

                            @foreach ($guru as $g)

                            <label class="checkbox-item">

                                <input type="checkbox"
                                       name="guru_id[]"
                                       value="{{ $g->id }}"
                                       class="guru-checkbox"
                                       onchange="updateSelectedCount()">

                                <span class="checkbox-name">
                                    {{ $g->nama }}
                                </span>

                            </label>

                            @endforeach

                        </div>

                        @error('guru_id')

                        <p class="error-text">
                            {{ $message }}
                        </p>

                        @enderror

                        <button class="btn-submit">

                            Simpan Perubahan

                        </button>

                    </form>

                </div>

            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="sidebar">

            <div class="info-box">

                <div class="info-title">
                    Panduan Penggunaan
                </div>

                <div class="info-list">

                    <div class="info-item">
                        <span class="info-dot"></span>
                        Lihat daftar guru yang sudah terjadwal
                    </div>

                    <div class="info-item">
                        <span class="info-dot"></span>
                        Centang guru untuk menambahkan jadwal
                    </div>

                    <div class="info-item">
                        <span class="info-dot"></span>
                        Klik simpan untuk menyimpan perubahan
                    </div>

                </div>

            </div>

            <div class="info-box">

                <div class="info-title">
                    Tips Pengelolaan
                </div>

                <div class="info-list">

                    <div class="info-item">
                        <span class="info-dot"></span>
                        Hindari bentrok jadwal antar guru
                    </div>

                    <div class="info-item">
                        <span class="info-dot"></span>
                        Distribusikan jam mengajar secara merata
                    </div>

                    <div class="info-item">
                        <span class="info-dot"></span>
                        Prioritaskan mata pelajaran utama
                    </div>

                    <div class="info-item">
                        <span class="info-dot"></span>
                        Pastikan beban mengajar tetap seimbang
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- SCRIPT --}}
<script>
function toggleAll(status){

    document.querySelectorAll('.guru-checkbox')
        .forEach(cb => cb.checked = status);

    updateSelectedCount();
}

function updateSelectedCount(){

    const checked =
        document.querySelectorAll('.guru-checkbox:checked').length;

    document.getElementById('selectedCount').innerText =
        checked + " dipilih";
}
</script>

@endsection