@extends('layouts.guru')

@section('title', 'Raport Tahfidz Siswa')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');

    :root {
        --navy: #020659;
        --navy-light: #1a237e;
        --gray-50: #F8FAFC;
        --gray-100: #F1F5F9;
        --gray-200: #E2E8F0;
        --gray-400: #94A3B8;
        --gray-500: #64748B;
        --gray-700: #334155;
        --gray-800: #1E293B;
        --gray-900: #0F172A;
        --blue: #2563EB;
        --blue-light: #EFF6FF;
        --green: #047857;
        --green-light: #D1FAE5;
        --amber: #B45309;
        --amber-light: #FEF3C7;
        --purple: #5B21B6;
        --purple-light: #EDE9FE;
        --radius-sm: 10px;
        --radius-md: 14px;
        --radius-lg: 20px;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.06), 0 2px 4px rgba(0, 0, 0, 0.04);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Nunito', sans-serif;
        background: var(--gray-50);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeRow {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ======================================================
   MOBILE FIRST
   ====================================================== */

    .page-wrap {
        padding: 0;
        max-width: 100%;
        padding-bottom: 40px;
    }

    /* ---- HERO ---- */
    .hero-card {
        background: linear-gradient(135deg, var(--navy) 0%, #1a237e 60%, #283593 100%);
        padding: 40px 24px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    /* decorative circles tetap */
    .hero-card::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
    }

    .hero-card::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
    }

    /* wrapper */
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 24px;
    }

    /* text */
    .hero-sub {
        display: inline-block;
        font-size: 13px;
        letter-spacing: .5px;
        opacity: .85;
        margin-bottom: 8px;
    }

    .hero-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 8px 0;
    }

    .hero-desc {
        font-size: 15px;
        opacity: .9;
        max-width: 480px;
    }

    /* button area */
    .hero-actions {
        display: flex;
        align-items: center;
    }

    /* button refinement (tanpa ubah warna utama) */
    .btn-hero-primary {
        background: white;
        color: var(--navy);
        padding: 12px 22px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all .25s ease;
    }

    .btn-hero-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
    }

    .hero-sub {
        font-size: 11px;
        opacity: 0.7;
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 20px;
        font-weight: 800;
        margin: 2px 0 4px;
        position: relative;
        z-index: 1;
    }

    .hero-desc {
        font-size: 12px;
        opacity: 0.8;
        position: relative;
        z-index: 1;
        margin-bottom: 16px;
    }

    .hero-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .btn-hero-primary {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        border-radius: var(--radius-sm);
        background: white;
        color: var(--navy);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        transition: opacity 0.15s, transform 0.15s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-hero-primary:hover {
        opacity: 0.92;
        color: var(--navy);
        text-decoration: none;
    }

    .btn-hero-primary:active {
        transform: scale(0.97);
    }

    /* ---- BODY ---- */
    .page-body {
        padding: 14px 12px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* ---- SECTION TITLE ---- */
    .section-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--gray-700);
        margin: 0 0 10px 2px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ---- QUICK ACTIONS ---- */
    .actions-bar {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        animation: slideUp 0.35s ease both;
    }

    .action-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: var(--radius-sm);
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        background: white;
        color: var(--gray-700);
        border: 1.5px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        transition: border-color 0.15s, color 0.15s, background 0.15s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .action-chip:hover {
        border-color: var(--navy);
        color: var(--navy);
        background: #EEF2FF;
        text-decoration: none;
    }

    /* ---- STAT CARDS ---- */
    .stat-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        animation: slideUp 0.4s ease 0.05s both;
    }

    .stat-card {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 14px 12px;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .si-blue {
        background: var(--blue-light);
    }

    .si-green {
        background: var(--green-light);
    }

    .si-amber {
        background: var(--amber-light);
    }

    .si-purple {
        background: var(--purple-light);
    }

    .stat-num {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 24px;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 2px;
    }

    .sn-blue {
        color: var(--blue);
    }

    .sn-green {
        color: var(--green);
    }

    .sn-amber {
        color: var(--amber);
    }

    .sn-purple {
        color: var(--purple);
    }

    .stat-lbl {
        font-size: 11px;
        color: var(--gray-500);
        font-weight: 600;
    }

    /* ---- SECTION BAR ---- */
    .section-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .count-badge {
        background: #EEF2FF;
        color: var(--navy);
        border-radius: 99px;
        padding: 3px 10px;
        font-size: 11px;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ---- MOBILE: SISWA CARDS ---- */
    .siswa-list-mobile {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .siswa-card-mobile {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        animation: slideUp 0.4s ease both;
        transition: transform 0.18s, box-shadow 0.18s;
    }

    .siswa-card-mobile:nth-child(1) {
        animation-delay: 0.03s;
    }

    .siswa-card-mobile:nth-child(2) {
        animation-delay: 0.06s;
    }

    .siswa-card-mobile:nth-child(3) {
        animation-delay: 0.09s;
    }

    .siswa-card-mobile:nth-child(n+4) {
        animation-delay: 0.12s;
    }

    /* Card header */
    .card-name-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-100);
    }

    .card-avatar {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        background: #EEF2FF;
        border: 1px solid #C7D2FE;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 15px;
        font-weight: 800;
        color: var(--navy);
        flex-shrink: 0;
    }

    .card-num {
        font-size: 10px;
        font-weight: 700;
        color: var(--gray-400);
        margin-bottom: 2px;
    }

    .card-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-900);
    }

    .card-meta {
        font-size: 11px;
        color: var(--gray-400);
    }

    /* Card body */
    .card-body {
        padding: 10px 14px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .card-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
    }

    .card-row-label {
        font-size: 10px;
        font-weight: 700;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* Hafalan pill */
    .hafalan-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 700;
        background: var(--blue-light);
        color: var(--blue);
    }

    .hafalan-empty {
        font-size: 11px;
        color: var(--gray-400);
        font-style: italic;
    }

    .ujian-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 8px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 700;
        background: var(--purple-light);
        color: var(--purple);
    }

    /* Aspek progress */
    .aspek-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .progress-bar-wrap {
        width: 70px;
        height: 5px;
        background: var(--gray-200);
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 3px;
    }

    .pb-done {
        background: var(--green);
    }

    .pb-partial {
        background: var(--amber);
    }

    .aspek-chip {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 9px;
        border-radius: 99px;
    }

    .ac-done {
        background: var(--green-light);
        color: var(--green);
    }

    .ac-partial {
        background: var(--amber-light);
        color: var(--amber);
    }

    .ac-none {
        background: var(--gray-100);
        color: var(--gray-400);
        border: 1px solid var(--gray-200);
    }

    /* Card actions */
    .card-actions {
        display: flex;
        gap: 8px;
        padding: 10px 14px;
        border-top: 1px solid var(--gray-100);
    }

    .btn-sm {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 8px 10px;
        border-radius: var(--radius-sm);
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: opacity 0.15s;
        border: 1.5px solid transparent;
    }

    .btn-sm:hover {
        opacity: 0.85;
        text-decoration: none;
    }

    .btn-detail {
        background: var(--blue-light);
        color: var(--blue);
        border-color: #BFDBFE;
    }

    .btn-print {
        background: var(--green-light);
        color: var(--green);
        border-color: #A7F3D0;
    }

    /* ---- DESKTOP TABLE ---- */
    .table-card {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table-header {
        padding: 12px 16px;
        background: var(--gray-50);
        border-bottom: 1.5px solid var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .table-header-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 800;
        color: var(--gray-900);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead tr {
        background: linear-gradient(135deg, var(--navy), #1a237e);
    }

    th {
        padding: 11px 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 10px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.85);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
        white-space: nowrap;
    }

    th.right {
        text-align: right;
    }

    th.center {
        text-align: center;
    }

    tbody tr {
        border-bottom: 1px solid var(--gray-100);
        transition: background 0.12s;
        animation: fadeRow 0.3s ease both;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    tbody tr:hover {
        background: #EEF2FF;
    }

    tbody tr:nth-child(1) {
        animation-delay: 0.03s;
    }

    tbody tr:nth-child(2) {
        animation-delay: 0.06s;
    }

    tbody tr:nth-child(3) {
        animation-delay: 0.09s;
    }

    tbody tr:nth-child(n+4) {
        animation-delay: 0.12s;
    }

    td {
        padding: 13px 14px;
        font-size: 13px;
        vertical-align: middle;
    }

    td.right {
        text-align: right;
    }

    td.center {
        text-align: center;
    }

    .td-num {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: #EEF2FF;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11px;
        font-weight: 800;
        color: var(--navy);
    }

    .student-cell {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .tbl-avatar {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        background: #EEF2FF;
        border: 1px solid #C7D2FE;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 15px;
        font-weight: 800;
        color: var(--navy);
        flex-shrink: 0;
    }

    .student-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 2px;
    }

    .student-meta {
        font-size: 11px;
        color: var(--gray-400);
    }

    .row-actions {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        justify-content: flex-end;
    }

    /* ---- MOBILE / DESKTOP TOGGLE ---- */
    .mobile-only {
        display: block;
    }

    .desktop-only {
        display: none;
    }

    /* ---- EMPTY STATE ---- */
    .empty-state {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 60px 24px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        animation: slideUp 0.35s ease both;
    }

    .empty-icon-wrap {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #EEF2FF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 16px;
    }

    .empty-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: var(--gray-800);
        margin-bottom: 8px;
    }

    .empty-desc {
        font-size: 13px;
        color: var(--gray-500);
        line-height: 1.65;
        margin-bottom: 20px;
    }

    .btn-empty-cta {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, var(--navy), #1a237e);
        color: white;
        padding: 11px 22px;
        border-radius: var(--radius-sm);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(2, 6, 89, 0.25);
        transition: opacity 0.15s;
    }

    .btn-empty-cta:hover {
        opacity: 0.9;
        color: white;
        text-decoration: none;
    }

    /* ======================================================
   DESKTOP ≥768px
   ====================================================== */
    @media (min-width: 768px) {

        .page-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px 48px;
        }

        /* Hero */
        .hero-card {
            border-radius: var(--radius-lg);
            margin: 24px 0 0;
            padding: 32px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .hero-card::before {
            width: 260px;
            height: 260px;
            top: -80px;
            right: -60px;
        }

        .hero-sub {
            font-size: 13px;
        }

        .hero-title {
            font-size: 28px;
        }

        .hero-desc {
            font-size: 14px;
            margin-bottom: 0;
        }

        .hero-actions {
            flex-direction: column;
            align-items: flex-end;
            flex-shrink: 0;
        }

        /* Body */
        .page-body {
            padding: 24px 0;
            gap: 16px;
        }

        .section-title {
            font-size: 15px;
        }

        /* Quick actions */
        .action-chip {
            font-size: 13px;
            padding: 9px 16px;
        }

        /* Stats: 4 cols */
        .stat-row {
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .stat-card {
            padding: 18px 16px;
            border-radius: var(--radius-lg);
        }

        .stat-num {
            font-size: 30px;
        }

        .stat-lbl {
            font-size: 12px;
        }

        /* Toggle */
        .mobile-only {
            display: none;
        }

        .desktop-only {
            display: block;
        }

        /* Table */
        .table-card {
            border-radius: var(--radius-lg);
        }

        .table-header {
            padding: 16px 20px;
        }

        .table-header-title {
            font-size: 15px;
        }

        th {
            padding: 13px 16px;
            font-size: 11px;
        }

        td {
            padding: 14px 16px;
        }

        .tbl-avatar {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .student-name {
            font-size: 14px;
        }

        /* Empty */
        .empty-state {
            border-radius: var(--radius-lg);
            padding: 80px 40px;
        }
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        overscroll-behavior-y: none;
    }

    a {
        -webkit-tap-highlight-color: transparent;
    }
</style>

<div class="page-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div class="hero-content">

            <div class="hero-text">
                <span class="hero-sub">Dashboard Guru</span>
                <h1 class="hero-title">📖 Raport Tahfidz Siswa</h1>
                <p class="hero-desc">
                    Pantau perkembangan hafalan Al-Qur'an seluruh siswa
                </p>
            </div>

            <div class="hero-actions">
                <a href="{{ route('guru.raport-tahfidz-siswa.create') }}"
                    class="btn-hero-primary">
                    + Tambah Siswa
                </a>
            </div>

        </div>
    </div>

    <div class="page-body">

        {{-- ===== QUICK ACTIONS ===== --}}
        <div class="actions-bar">
            <a href="{{ route('guru.raport-tahfidz-siswa.create') }}" class="action-chip">👤 Pilih Siswa</a>
            <a href="{{ route('guru.raport-aspeks.index') }}" class="action-chip">📋 Aspek</a>
            <a href="{{ route('guru.raport-nilai.index') }}" class="action-chip">✏️ Nilai Aspek</a>
            <a href="{{ route('guru.raport-hafalan.index') }}" class="action-chip">📝 Hafalan</a>
            <a href="{{ route('guru.raport-ujian.create') }}" class="action-chip">🎓 Ujian</a>
        </div>

        @if($siswas->isEmpty())

        {{-- ===== EMPTY STATE ===== --}}
        <div class="empty-state">
            <div class="empty-icon-wrap">📂</div>
            <div class="empty-title">Belum Ada Siswa</div>
            <div class="empty-desc">
                Silakan pilih siswa terlebih dahulu<br>untuk mulai mengelola raport tahfidz.
            </div>
            <a href="{{ route('guru.raport-tahfidz-siswa.create') }}" class="btn-empty-cta">
                👤 Pilih Siswa Sekarang
            </a>
        </div>

        @else

        {{-- ===== STATS ===== --}}
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-icon si-blue">👤</div>
                <div>
                    <div class="stat-num sn-blue">{{ $siswas->count() }}</div>
                    <div class="stat-lbl">Total Siswa</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-green">📋</div>
                <div>
                    <div class="stat-num sn-green">{{ $aspeks->count() }}</div>
                    <div class="stat-lbl">Aspek Penilaian</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-amber">📝</div>
                <div>
                    <div class="stat-num sn-amber">{{ collect($hafalan)->count() }}</div>
                    <div class="stat-lbl">Data Hafalan</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-purple">🎓</div>
                <div>
                    <div class="stat-num sn-purple">{{ collect($ujian)->count() }}</div>
                    <div class="stat-lbl">Data Ujian</div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION BAR ===== --}}
        <div class="section-bar">
            <div class="section-title" style="margin:0;">📋 Daftar Siswa</div>
            <span class="count-badge">{{ $siswas->count() }} siswa</span>
        </div>

        {{-- ===== MOBILE: CARD LIST ===== --}}
        <div class="mobile-only siswa-list-mobile">
            @foreach($siswas as $i => $siswa)
            @php
            $aspekDinilai = collect($nilai[$siswa->id] ?? [])->filter(fn($v) => $v > 0)->count();
            $totalAspek = $aspeks->count();
            $hafalanSiswa = $hafalan[$siswa->id] ?? null;
            $ujianSiswa = $ujian[$siswa->id] ?? collect();
            $selesai = $totalAspek > 0 && $aspekDinilai == $totalAspek;
            $pct = $totalAspek > 0 ? round(($aspekDinilai / $totalAspek) * 100) : 0;
            $initial = mb_strtoupper(mb_substr($siswa->nama_siswa, 0, 1));
            @endphp

            <div class="siswa-card-mobile">

                <div class="card-name-bar">
                    <div class="card-avatar">{{ $initial }}</div>
                    <div>
                        <div class="card-num">{{ $i + 1 }}. Siswa</div>
                        <div class="card-name">{{ $siswa->nama_siswa }}</div>
                        <div class="card-meta">
                            NIS {{ $siswa->nis ?? '-' }} · {{ $siswa->rombel->tingkat ?? '-' }} – {{ $siswa->rombel->nama_rombel ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-row">
                        <span class="card-row-label">Hafalan</span>
                        @if($hafalanSiswa)
                        <span class="hafalan-pill">📖 {{ $hafalanSiswa->surah_terakhir }} : {{ $hafalanSiswa->ayat_terakhir }}</span>
                        @else
                        <span class="hafalan-empty">Belum ada data</span>
                        @endif
                    </div>

                    @if($ujianSiswa->count() > 0)
                    <div class="card-row">
                        <span class="card-row-label">Ujian</span>
                        <span class="ujian-pill">🎓 {{ $ujianSiswa->count() }}× ujian</span>
                    </div>
                    @endif

                    <div class="card-row">
                        <span class="card-row-label">Aspek</span>
                        @if($totalAspek > 0)
                        <div class="aspek-wrap">
                            <div class="progress-bar-wrap">
                                <div class="progress-bar-fill {{ $selesai ? 'pb-done' : 'pb-partial' }}"
                                    data-pct="{{ $pct }}"></div>
                            </div>
                            <span class="aspek-chip {{ $selesai ? 'ac-done' : ($aspekDinilai > 0 ? 'ac-partial' : 'ac-none') }}">
                                {{ $aspekDinilai }}/{{ $totalAspek }}
                            </span>
                        </div>
                        @else
                        <span class="aspek-chip ac-none">—</span>
                        @endif
                    </div>
                </div>

                <div class="card-actions">
                    <a href="{{ route('guru.raport-tahfidz.show', $siswa->id) }}" class="btn-sm btn-detail">👁 Detail</a>
                    <a href="{{ route('guru.raport-tahfidz.cetak', $siswa->id) }}" class="btn-sm btn-print">🖨 Cetak</a>
                </div>

            </div>
            @endforeach
        </div>

        {{-- ===== DESKTOP: TABLE ===== --}}
        <div class="desktop-only table-card">
            <div class="table-header">
                <div class="table-header-title">📋 Daftar Siswa Tahfidz</div>
            </div>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th style="width:52px;">#</th>
                            <th>Siswa</th>
                            <th>Hafalan Terakhir</th>
                            <th class="center" style="width:130px;">Aspek</th>
                            <th class="right" style="width:180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $i => $siswa)
                        @php
                        $aspekDinilai = collect($nilai[$siswa->id] ?? [])->filter(fn($v) => $v > 0)->count();
                        $totalAspek = $aspeks->count();
                        $hafalanSiswa = $hafalan[$siswa->id] ?? null;
                        $ujianSiswa = $ujian[$siswa->id] ?? collect();
                        $selesai = $totalAspek > 0 && $aspekDinilai == $totalAspek;
                        $pct = $totalAspek > 0 ? round(($aspekDinilai / $totalAspek) * 100) : 0;
                        $initial = mb_strtoupper(mb_substr($siswa->nama_siswa, 0, 1));
                        @endphp
                        <tr>
                            <td><span class="td-num">{{ $i + 1 }}</span></td>

                            <td>
                                <div class="student-cell">
                                    <div class="tbl-avatar">{{ $initial }}</div>
                                    <div>
                                        <div class="student-name">{{ $siswa->nama_siswa }}</div>
                                        <div class="student-meta">
                                            NIS {{ $siswa->nis ?? '-' }} &nbsp;·&nbsp;
                                            {{ $siswa->rombel->tingkat ?? '-' }} – {{ $siswa->rombel->nama_rombel ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if($hafalanSiswa)
                                <div class="hafalan-pill" style="display:inline-flex; margin-bottom:4px;">
                                    📖 {{ $hafalanSiswa->surah_terakhir }} : {{ $hafalanSiswa->ayat_terakhir }}
                                </div>
                                @else
                                <span class="hafalan-empty">Belum ada data</span>
                                @endif
                                @if($ujianSiswa->count() > 0)
                                <div style="margin-top:4px;">
                                    <span class="ujian-pill">🎓 {{ $ujianSiswa->count() }}× ujian</span>
                                </div>
                                @endif
                            </td>

                            <td class="center">
                                <div class="aspek-wrap" style="justify-content:center;">
                                    @if($totalAspek > 0)
                                    <div class="progress-bar-wrap">
                                        <div class="progress-bar-fill {{ $selesai ? 'pb-done' : 'pb-partial' }}"
                                            data-pct="{{ $pct }}"></div>
                                    </div>
                                    <span class="aspek-chip {{ $selesai ? 'ac-done' : ($aspekDinilai > 0 ? 'ac-partial' : 'ac-none') }}">
                                        {{ $aspekDinilai }}/{{ $totalAspek }}
                                    </span>
                                    @else
                                    <span class="aspek-chip ac-none">—</span>
                                    @endif
                                </div>
                            </td>

                            <td class="right">
                                <div class="row-actions">
                                    <a href="{{ route('guru.raport-tahfidz.show', $siswa->id) }}" class="btn-sm btn-detail">👁 Detail</a>
                                    <a href="{{ route('guru.raport-tahfidz.cetak', $siswa->id) }}" class="btn-sm btn-print">🖨 Cetak</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endif

    </div>
</div>

<script>
    document.querySelectorAll('.progress-bar-fill[data-pct]').forEach(el => {
        el.style.width = el.dataset.pct + '%';
    });
</script>

@endsection