@extends('layouts.admin')

@section('title', 'Data User')
@section('header', 'Data User')

@section('content')

{{-- Google Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
    body, .content-area { font-family: 'DM Sans', sans-serif; }

    :root {
        --accent: #4F46E5;
        --accent-light: #EEF2FF;
        --accent-hover: #4338CA;
        --surface: #FFFFFF;
        --bg: #F7F8FA;
        --border: rgba(0,0,0,0.07);
        --border-strong: rgba(0,0,0,0.12);
        --text-primary: #1A1C22;
        --text-secondary: #6B7280;
        --text-muted: #9CA3AF;
        --success: #059669;
        --success-bg: #ECFDF5;
        --success-text: #065F46;
        --amber: #D97706;
        --amber-bg: #FFFBEB;
        --red: #DC2626;
        --red-bg: #FEF2F2;
        --red-text: #991B1B;
    }

    /* ── Page Header ── */
    .page-title {
        font-size: 20px;
        font-weight: 500;
        color: var(--text-primary);
        letter-spacing: -0.4px;
        margin-bottom: 4px;
    }
    .page-desc {
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.6;
        max-width: 520px;
    }

    /* ── Topbar Actions ── */
    .topbar-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .search-bar {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--bg);
        border: 1px solid var(--border-strong);
        border-radius: 8px;
        padding: 7px 12px;
        width: 260px;
        transition: border 0.15s;
    }
    .search-bar:focus-within { border-color: var(--accent); }
    .search-bar svg { width: 14px; height: 14px; color: var(--text-muted); flex-shrink: 0; }
    .search-bar input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 13px;
        font-family: 'DM Sans', sans-serif;
        color: var(--text-primary);
        width: 100%;
    }
    .search-bar input::placeholder { color: var(--text-muted); }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.15s;
        white-space: nowrap;
    }
    .btn-primary:hover { background: var(--accent-hover); color: white; text-decoration: none; }
    .btn-primary svg { width: 14px; height: 14px; }

    /* ── Stats Grid ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }
    @media (max-width: 768px) { .stats-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border-strong);
        border-radius: 12px;
        padding: 18px 20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .stat-label {
        font-size: 11px;
        font-weight: 500;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.07em;
    }
    .stat-icon {
        width: 32px; height: 32px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .stat-icon svg { width: 15px; height: 15px; }
    .stat-icon.indigo { background: var(--accent-light); color: var(--accent); }
    .stat-icon.green  { background: var(--success-bg);   color: var(--success); }
    .stat-icon.purple { background: #F5F3FF; color: #7C3AED; }

    .stat-value {
        font-size: 28px;
        font-weight: 500;
        color: var(--text-primary);
        letter-spacing: -0.8px;
        line-height: 1;
        font-family: 'DM Mono', monospace;
    }
    .stat-footer { font-size: 11.5px; color: var(--text-muted); }

    /* ── Alert ── */
    .alert-success {
        display: flex;
        align-items: center;
        gap: 10px;
        background: var(--success-bg);
        border: 1px solid rgba(5,150,105,0.2);
        border-radius: 8px;
        padding: 11px 14px;
        font-size: 13px;
        color: var(--success-text);
        margin-bottom: 20px;
    }
    .alert-success svg { width: 15px; height: 15px; flex-shrink: 0; }

    /* ── Table Card ── */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border-strong);
        border-radius: 12px;
        overflow: hidden;
    }
    .table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-strong);
    }
    .table-title { font-size: 14px; font-weight: 500; color: var(--text-primary); }
    .table-meta  { font-size: 12px; color: var(--text-muted); }

    .user-table { width: 100%; border-collapse: collapse; }

    .user-table thead tr { background: #FAFAFA; }
    .user-table th {
        padding: 10px 20px;
        text-align: left;
        font-size: 11px;
        font-weight: 500;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.07em;
        border-bottom: 1px solid var(--border-strong);
        white-space: nowrap;
    }
    .user-table th:last-child { text-align: right; }

    .user-table td {
        padding: 13px 20px;
        font-size: 13px;
        color: var(--text-secondary);
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }
    .user-table tbody tr:last-child td { border-bottom: none; }
    .user-table tbody tr { transition: background 0.1s; }
    .user-table tbody tr:hover { background: #FAFBFC; }

    .td-num  { font-family: 'DM Mono', monospace; font-size: 12px; color: var(--text-muted); }
    .td-name { font-weight: 500; color: var(--text-primary); }
    .td-email { font-family: 'DM Mono', monospace; font-size: 12px; }
    .td-date  { font-size: 12px; color: var(--text-muted); }

    /* ── Avatar ── */
    .user-cell { display: flex; align-items: center; gap: 10px; }
    .avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 500;
        flex-shrink: 0;
    }
    /* Cycle through 4 colours by index */
    .av-0 { background: var(--accent-light); color: var(--accent); }
    .av-1 { background: var(--success-bg);   color: var(--success); }
    .av-2 { background: #F5F3FF; color: #7C3AED; }
    .av-3 { background: #FFF7ED; color: #C2410C; }

    /* ── Badge ── */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 500;
        white-space: nowrap;
    }
    .badge-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
    .badge-admin { background: var(--accent-light); color: var(--accent); }
    .badge-admin .badge-dot { background: var(--accent); }
    .badge-staff { background: var(--bg); color: var(--text-secondary); border: 1px solid var(--border-strong); }
    .badge-staff .badge-dot { background: var(--text-muted); }

    /* ── Action Buttons ── */
    .action-cell { display: flex; align-items: center; justify-content: flex-end; gap: 6px; }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        border: 1px solid var(--border-strong);
        background: var(--surface);
        color: var(--text-secondary);
        transition: all 0.15s;
        text-decoration: none;
    }
    .btn-action svg { width: 12px; height: 12px; }
    .btn-action:hover { text-decoration: none; }

    .btn-edit:hover  { border-color: var(--amber); color: var(--amber);  background: var(--amber-bg); }
    .btn-delete:hover{ border-color: var(--red);   color: var(--red);    background: var(--red-bg); }

    /* ── Empty State ── */
    .empty-state { padding: 64px 20px; text-align: center; }
    .empty-icon {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: var(--bg);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px;
    }
    .empty-icon svg { width: 20px; height: 20px; color: var(--text-muted); }
    .empty-title { font-size: 14px; font-weight: 500; color: var(--text-primary); margin-bottom: 4px; }
    .empty-desc  { font-size: 13px; color: var(--text-muted); }
    .empty-link  {
        display: inline-block;
        margin-top: 14px;
        font-size: 13px;
        color: var(--accent);
        font-weight: 500;
        text-decoration: none;
    }
    .empty-link:hover { text-decoration: underline; }
</style>

<div style="font-family:'DM Sans',sans-serif;">

    {{-- ═══════════════════════════════════════════
         TOPBAR: Title + Search + Add Button
    ═══════════════════════════════════════════ --}}
    <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:16px; flex-wrap:wrap; margin-bottom:24px;">

        <div>
            <h1 class="page-title">Manajemen User Sistem</h1>
            <p class="page-desc">
                Kelola seluruh akun pengguna yang memiliki akses ke sistem akademik —
                tambah, perbarui, atau hapus akun dan atur hak akses sesuai peran.
            </p>
        </div>

        <div class="topbar-actions">
            {{-- Search --}}
            <div class="search-bar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari nama atau email...">
            </div>

            {{-- Tambah User --}}
            <a href="{{ route('admin.users.create') }}" class="btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah User
            </a>
        </div>

    </div>


    {{-- ═══════════════════════════════════════════
         STATISTIK
    ═══════════════════════════════════════════ --}}
    <div class="stats-grid">

        {{-- Total --}}
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Total Pengguna</span>
                <div class="stat-icon indigo">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $users->count() }}</div>
            <div class="stat-footer">Seluruh akun terdaftar dalam sistem</div>
        </div>

        {{-- Admin --}}
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Administrator</span>
                <div class="stat-icon green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $users->where('role','admin')->count() }}</div>
            <div class="stat-footer">Akses penuh ke seluruh fitur sistem</div>
        </div>

        {{-- Staff --}}
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Staff & User</span>
                <div class="stat-icon purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $users->where('role','!=','admin')->count() }}</div>
            <div class="stat-footer">Hak akses terbatas sesuai role</div>
        </div>

    </div>


    {{-- ═══════════════════════════════════════════
         ALERT
    ═══════════════════════════════════════════ --}}
    @if(session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif


    {{-- ═══════════════════════════════════════════
         TABLE
    ═══════════════════════════════════════════ --}}
    <div class="table-card">

        <div class="table-header">
            <span class="table-title">Daftar Pengguna</span>
            <span class="table-meta">Total {{ $users->count() }} pengguna</span>
        </div>

        <div style="overflow-x:auto;">

            @if($users->count() > 0)

            <table class="user-table" id="userTable">
                <thead>
                    <tr>
                        <th style="width:44px;">#</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Bergabung</th>
                        <th style="text-align:right;">Aksi</th>
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

                        <td class="td-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>

                        <td>
                            <div class="user-cell">
                                <div class="avatar {{ $avClass }}">{{ $initials }}</div>
                                <span class="td-name">{{ $user->name }}</span>
                            </div>
                        </td>

                        <td class="td-email">{{ $user->email }}</td>

                        <td>
                            @if($user->role === 'admin')
                                <span class="badge badge-admin">
                                    <span class="badge-dot"></span>Admin
                                </span>
                            @else
                                <span class="badge badge-staff">
                                    <span class="badge-dot"></span>{{ ucfirst($user->role) }}
                                </span>
                            @endif
                        </td>

                        <td class="td-date">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}
                        </td>

                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="btn-action btn-edit">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirmDelete(event, '{{ $user->name }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14H6L5 6"/>
                                            <path d="M10 11v6M14 11v6M9 6V4h6v2"/>
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

            {{-- No search result row --}}
            <div id="emptySearch" style="display:none; padding:40px 20px; text-align:center;">
                <p style="font-size:13px; color:var(--text-muted);">Tidak ada pengguna yang cocok dengan pencarian.</p>
            </div>

            @else

            {{-- EMPTY STATE --}}
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <p class="empty-title">Belum ada pengguna terdaftar</p>
                <p class="empty-desc">Mulai dengan menambahkan akun pertama ke sistem.</p>
                <a href="{{ route('admin.users.create') }}" class="empty-link">
                    Tambah User Pertama →
                </a>
            </div>

            @endif

        </div>
    </div>

</div>


{{-- ═══════════════════════════════════════════
     JAVASCRIPT
═══════════════════════════════════════════ --}}
<script>
    /* ── Live Search ── */
    const searchInput = document.getElementById('searchInput');
    const emptySearch = document.getElementById('emptySearch');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.user-row');
            let visible = 0;

            rows.forEach(row => {
                const match = row.dataset.name.includes(q) || row.dataset.email.includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            if (emptySearch) {
                emptySearch.style.display = visible === 0 ? 'block' : 'none';
            }
        });
    }

    /* ── Delete Confirmation ── */
    function confirmDelete(e, name) {
        if (!confirm(`Yakin ingin menghapus user "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            e.preventDefault();
            return false;
        }
        return true;
    }
</script>

@endsection