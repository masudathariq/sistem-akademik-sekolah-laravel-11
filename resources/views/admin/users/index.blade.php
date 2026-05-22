@extends('layouts.admin')

@section('title', 'Data User')
@section('header', 'Data User')

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

.user-page{
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
    max-width:560px;
}

/* ───────── ACTIONS ───────── */
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
    width:260px;
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

/* ───────── STATS ───────── */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:14px;
    margin-bottom:1.75rem;
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
}

.stat-icon svg{
    width:15px;
    height:15px;
}

.icon-blue{
    background:var(--navy-lt);
    color:var(--navy-md);
}

.icon-green{
    background:var(--green-lt);
    color:var(--green);
}

.icon-purple{
    background:var(--purple-lt);
    color:var(--purple);
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
.user-table{
    width:100%;
    border-collapse:collapse;
}

.user-table thead{
    background:var(--navy);
}

.user-table th{
    padding:.85rem 1rem;
    text-align:center;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:rgba(255,255,255,.9);
    white-space:nowrap;
}

.user-table td{
    padding:.9rem 1rem;
    border-bottom:1px solid var(--border);
    font-size:13px;
    color:var(--text);
    vertical-align:middle;
}

.user-table tbody tr{
    transition:.12s;
}

.user-table tbody tr:hover{
    background:#f8fbff;
}

.user-table tbody tr:last-child td{
    border-bottom:none;
}

/* ───────── USER CELL ───────── */
.user-cell{
    display:flex;
    align-items:center;
    gap:10px;
}

.avatar{
    width:34px;
    height:34px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:11px;
    font-weight:700;
    flex-shrink:0;
}

.av-0{
    background:var(--navy-lt);
    color:var(--navy-md);
}

.av-1{
    background:var(--green-lt);
    color:var(--green);
}

.av-2{
    background:var(--purple-lt);
    color:var(--purple);
}

.av-3{
    background:var(--amber-lt);
    color:var(--amber);
}

.td-name{
    font-weight:600;
    color:var(--text);
}

.td-email{
    color:var(--muted);
}

.td-date{
    color:var(--muted);
    font-size:12px;
}

/* ───────── BADGE ───────── */
.badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:4px 11px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
}

.badge-dot{
    width:6px;
    height:6px;
    border-radius:50%;
}

.badge-admin{
    background:var(--navy-lt);
    color:var(--navy-md);
}

.badge-admin .badge-dot{
    background:var(--navy-md);
}

.badge-staff{
    background:#f8fafc;
    border:1px solid var(--border);
    color:var(--muted);
}

.badge-staff .badge-dot{
    background:var(--hint);
}

/* ───────── ACTION ───────── */
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
    gap:6px;
    min-height:34px;
    padding:6px 12px;
    border-radius:8px;
    border:1px solid var(--border);
    background:#fff;
    font-size:12px;
    font-weight:600;
    text-decoration:none;
    transition:.15s;
    cursor:pointer;
}

.btn-edit{
    color:var(--amber);
    background:var(--amber-lt);
    border-color:var(--amber-bd);
}

.btn-delete{
    color:var(--red);
    background:var(--red-lt);
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

/* ───────── RESPONSIVE ───────── */
@media(max-width:900px){

    .user-page{
        padding:1rem;
    }

    .stats-grid{
        grid-template-columns:1fr;
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

<div class="user-page">

    {{-- TOPBAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                👤
            </div>

            <div class="title-text">
                <h1>Manajemen User Sistem</h1>

                <p>
                    Kelola seluruh akun pengguna yang memiliki akses ke sistem akademik sekolah.
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
                       placeholder="Cari nama atau email...">

            </div>

            {{-- BUTTON --}}
            <a href="{{ route('admin.users.create') }}"
               class="btn-primary">

                Tambah User

            </a>

        </div>

    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Total Pengguna
                </span>

                <div class="stat-icon icon-blue">
                    👥
                </div>

            </div>

            <div class="stat-value">
                {{ $users->count() }}
            </div>

            <div class="stat-sub">
                Seluruh akun terdaftar
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Administrator
                </span>

                <div class="stat-icon icon-green">
                    🛡️
                </div>

            </div>

            <div class="stat-value">
                {{ $users->where('role','admin')->count() }}
            </div>

            <div class="stat-sub">
                Memiliki akses penuh
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-header">

                <span class="stat-label">
                    Staff & User
                </span>

                <div class="stat-icon icon-purple">
                    👨‍💼
                </div>

            </div>

            <div class="stat-value">
                {{ $users->where('role','!=','admin')->count() }}
            </div>

            <div class="stat-sub">
                Akses terbatas sesuai role
            </div>

        </div>

    </div>

    {{-- ALERT --}}
    @if(session('success'))

    <div class="alert-success">
        ✅ {{ session('success') }}
    </div>

    @endif

    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">

            <div class="table-title">
                Daftar Pengguna
            </div>

            <div class="table-meta">
                Total {{ $users->count() }} pengguna
            </div>

        </div>

        <div class="table-wrap">

            @if($users->count())

            <table class="user-table"
                   id="userTable">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $user)

                    @php
                        $initials = collect(explode(' ', $user->name))
                            ->take(2)
                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                            ->implode('');

                        $avClass = 'av-' . ($loop->index % 4);
                    @endphp

                    <tr class="user-row"
                        data-name="{{ strtolower($user->name) }}"
                        data-email="{{ strtolower($user->email) }}">

                        <td style="text-align:center;">
                            {{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}
                        </td>

                        <td>

                            <div class="user-cell">

                                <div class="avatar {{ $avClass }}">
                                    {{ $initials }}
                                </div>

                                <span class="td-name">
                                    {{ $user->name }}
                                </span>

                            </div>

                        </td>

                        <td class="td-email">
                            {{ $user->email }}
                        </td>

                        <td style="text-align:center;">

                            @if($user->role === 'admin')

                            <span class="badge badge-admin">
                                <span class="badge-dot"></span>
                                Admin
                            </span>

                            @else

                            <span class="badge badge-staff">
                                <span class="badge-dot"></span>
                                {{ ucfirst($user->role) }}
                            </span>

                            @endif

                        </td>

                        <td class="td-date">
                            {{ $user->created_at ? $user->created_at->translatedFormat('d M Y') : '-' }}
                        </td>

                        <td>

                            <div class="action-cell">

                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="btn-action btn-edit">

                                    Edit

                                </a>

                                <form action="{{ route('admin.users.destroy', $user) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirmDelete(event, '{{ $user->name }}')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-action btn-delete">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            <div id="emptySearch"
                 style="display:none;padding:40px 20px;text-align:center;">

                <p style="font-size:13px;color:var(--muted);">
                    Tidak ada pengguna yang cocok dengan pencarian.
                </p>

            </div>

            @else

            {{-- EMPTY --}}
            <div class="empty-state">

                <div class="empty-icon">
                    👤
                </div>

                <div class="empty-title">
                    Belum Ada Pengguna
                </div>

                <div class="empty-desc">
                    Mulai dengan menambahkan akun pertama
                </div>

                <a href="{{ route('admin.users.create') }}"
                   class="empty-link">

                    Tambah User →

                </a>

            </div>

            @endif

        </div>

    </div>

</div>

<script>
const searchInput = document.getElementById('searchInput');
const emptySearch = document.getElementById('emptySearch');

if(searchInput){

    searchInput.addEventListener('input',function(){

        const q = this.value.toLowerCase().trim();

        const rows = document.querySelectorAll('.user-row');

        let visible = 0;

        rows.forEach(row => {

            const match =
                row.dataset.name.includes(q) ||
                row.dataset.email.includes(q);

            row.style.display = match ? '' : 'none';

            if(match) visible++;

        });

        if(emptySearch){
            emptySearch.style.display =
                visible === 0 ? 'block' : 'none';
        }

    });

}

function confirmDelete(e,name){

    if(!confirm(`Yakin ingin menghapus user "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)){

        e.preventDefault();

        return false;
    }

    return true;
}
</script>

@endsection