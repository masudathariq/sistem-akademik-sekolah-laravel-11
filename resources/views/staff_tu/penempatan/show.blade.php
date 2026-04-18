@extends('layouts.staff_tu')

@section('title', 'Detail Rombel - ' . $rombel->nama_lengkap)

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');

    :root {
        --navy: #020659;
        --navy-mid: #0A0F7A;
        --navy-light: #E8EAFF;
        --gray-50: #F8FAFC;
        --gray-100: #F1F5F9;
        --gray-200: #E2E8F0;
        --gray-400: #94A3B8;
        --gray-500: #64748B;
        --gray-700: #334155;
        --gray-900: #0F172A;
        --success: #059669;
        --success-light: #ECFDF5;
        --warning: #D97706;
        --warning-light: #FFFBEB;
        --danger: #DC2626;
        --danger-light: #FEF2F2;
        --yellow: #CA8A04;
        --yellow-light: #FEF9C3;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .page-wrap {
        font-family: 'Nunito', sans-serif;
        background: var(--gray-50);
        min-height: 100vh;
        padding-bottom: 40px;
    }

    /* ===== HEADER ===== */
    .page-header {
        background: var(--navy);
        padding: 14px 16px 22px;
        border-radius: 0 0 28px 28px;
        position: sticky;
        top: 0;
        z-index: 20;
        box-shadow: 0 4px 24px rgba(2, 6, 89, 0.25);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 10px;
        transition: color 0.15s;
    }

    .back-link:hover {
        color: white;
        text-decoration: none;
    }

    .back-link svg {
        width: 14px;
        height: 14px;
    }

    .header-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 3px;
    }

    .header-icon {
        width: 30px;
        height: 30px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .header-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: white;
    }

    .header-subtitle {
        color: rgba(255, 255, 255, 0.65);
        font-size: 11px;
        padding-left: 40px;
    }

    /* ===== CONTENT ===== */
    .content-area {
        max-width: 1100px;
        margin: 0 auto;
        padding: 14px 14px 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* ===== SECTION LABEL ===== */
    .section-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: var(--gray-400);
        padding: 0 2px;
    }

    /* ===== NOTIFIKASI ===== */
    .notif {
        border-radius: 12px;
        padding: 12px 14px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 13px;
        line-height: 1.5;
        animation: slideUp 0.3s ease both;
    }

    .notif.success {
        background: var(--success-light);
        border-left: 4px solid var(--success);
        color: #065F46;
    }

    .notif.error {
        background: var(--danger-light);
        border-left: 4px solid var(--danger);
        color: #7F1D1D;
    }

    .notif svg {
        width: 17px;
        height: 17px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .notif strong {
        display: block;
        font-weight: 700;
        margin-bottom: 1px;
    }

    /* ===== ROMBEL INFO CARD ===== */
    .info-card {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        animation: slideUp 0.35s ease both;
    }

    .info-card-header {
        background: var(--navy-light);
        border-bottom: 1px solid #C7D2FE;
        padding: 14px 16px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .rombel-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 17px;
        font-weight: 800;
        color: var(--navy);
        margin-bottom: 4px;
    }

    .rombel-ta {
        font-size: 11px;
        color: var(--navy-mid);
    }

    .info-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        padding: 14px 16px;
    }

    @media (min-width: 640px) {
        .info-meta-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .info-meta-item-label {
        font-size: 10px;
        font-weight: 600;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 3px;
    }

    .info-meta-item-value {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .siswa-count-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 9px;
        background: var(--navy-light);
        color: var(--navy);
        border-radius: 20px;
    }

    /* Export buttons */
    .export-row {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        padding: 12px 16px;
        border-top: 1px solid var(--gray-100);
        background: var(--gray-50);
    }

    .btn-export {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 9px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-excel {
        background: var(--success);
        color: white;
        box-shadow: 0 2px 8px rgba(5, 150, 105, 0.25);
    }

    .btn-excel:hover {
        background: #047857;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .btn-pdf {
        background: var(--danger);
        color: white;
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.25);
    }

    .btn-pdf:hover {
        background: #B91C1C;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    .btn-export svg {
        width: 14px;
        height: 14px;
    }

    /* ===== FORM CARD (Wali Kelas & Lulusan) ===== */
    .form-card {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        animation: slideUp 0.4s ease both;
    }

    .form-card-header {
        background: var(--navy-light);
        border-bottom: 1px solid #C7D2FE;
        padding: 13px 16px;
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .form-header-icon {
        width: 34px;
        height: 34px;
        background: var(--navy);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .form-header-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 800;
        color: var(--navy);
        margin-bottom: 1px;
    }

    .form-header-sub {
        font-size: 11px;
        color: var(--navy-mid);
    }

    .form-body {
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .form-label {
        display: block;
        font-size: 10px;
        font-weight: 700;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        font-size: 13px;
        font-family: 'Nunito', sans-serif;
        border: 1.5px solid var(--gray-200);
        border-radius: 10px;
        background: white;
        color: var(--gray-900);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        appearance: none;
    }

    .form-control:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(2, 6, 89, 0.1);
    }

    .select-wrap {
        position: relative;
    }

    .select-wrap::after {
        content: '';
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-top-color: var(--gray-400);
        pointer-events: none;
        margin-top: 3px;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 18px;
        border-radius: 10px;
        background: var(--navy);
        color: white;
        border: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 3px 10px rgba(2, 6, 89, 0.25);
    }

    .btn-save:hover {
        background: var(--navy-mid);
        transform: translateY(-1px);
    }

    .btn-save:active {
        transform: scale(0.97);
    }

    /* ===== LULUSKAN CARD ===== */
    .lulus-card {
        background: var(--success-light);
        border: 1.5px solid #A7F3D0;
        border-radius: 16px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        animation: slideUp 0.4s ease both;
    }

    @media (min-width: 640px) {
        .lulus-card {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    .lulus-info {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .lulus-icon {
        width: 38px;
        height: 38px;
        background: #D1FAE5;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .lulus-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 800;
        color: var(--success);
        margin-bottom: 2px;
    }

    .lulus-desc {
        font-size: 12px;
        color: #065F46;
    }

    .btn-lulus {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 18px;
        border-radius: 10px;
        background: var(--success);
        color: white;
        border: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
        box-shadow: 0 3px 10px rgba(5, 150, 105, 0.25);
    }

    .btn-lulus:hover {
        background: #047857;
        transform: translateY(-1px);
    }

    .btn-lulus:active {
        transform: scale(0.97);
    }

    /* ===== DAFTAR SISWA CARD ===== */
    .siswa-card {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        animation: slideUp 0.45s ease both;
    }

    .siswa-card-header {
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-200);
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .siswa-card-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 800;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .siswa-card-count {
        font-size: 11px;
        font-weight: 700;
        background: var(--navy-light);
        color: var(--navy);
        padding: 2px 9px;
        border-radius: 20px;
    }

    /* ===== MOBILE: CARD LIST ===== */
    .mobile-list {
        display: block;
    }

    .desktop-table {
        display: none;
    }

    @media (min-width: 768px) {
        .mobile-list {
            display: none;
        }

        .desktop-table {
            display: block;
        }
    }

    .siswa-mobile-item {
        padding: 12px 14px;
        border-bottom: 1px solid var(--gray-100);
    }

    .siswa-mobile-item:last-child {
        border-bottom: none;
    }

    .siswa-mobile-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
    }

    .siswa-num-badge {
        width: 24px;
        height: 24px;
        background: var(--navy-light);
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 10px;
        font-weight: 800;
        color: var(--navy);
        flex-shrink: 0;
    }

    .siswa-mobile-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 2px;
    }

    .siswa-mobile-sub {
        font-size: 10px;
        color: var(--gray-400);
    }

    .gender-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .gb-l {
        background: #EFF6FF;
        color: #2563EB;
    }

    .gb-p {
        background: #FDF2F8;
        color: #DB2777;
    }

    .siswa-aksi {
        display: flex;
        flex-direction: column;
        gap: 7px;
        padding-top: 10px;
        border-top: 1px solid var(--gray-100);
    }

    .form-pindah {
        display: flex;
        gap: 7px;
    }

    .select-pindah {
        flex: 1;
        padding: 8px 10px;
        font-size: 12px;
        font-family: 'Nunito', sans-serif;
        border: 1.5px solid var(--gray-200);
        border-radius: 9px;
        background: white;
        color: var(--gray-900);
        outline: none;
        appearance: none;
        transition: border-color 0.2s;
    }

    .select-pindah:focus {
        border-color: var(--warning);
    }

    .btn-pindah {
        padding: 8px 12px;
        border-radius: 9px;
        background: var(--warning-light);
        color: var(--warning);
        border: 1.5px solid #FDE68A;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .btn-pindah:hover {
        background: #FEF3C7;
    }

    .btn-keluarkan {
        width: 100%;
        padding: 8px;
        border-radius: 9px;
        background: var(--danger-light);
        color: var(--danger);
        border: 1.5px solid #FECACA;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-keluarkan:hover {
        background: #FEE2E2;
    }

    /* ===== DESKTOP TABLE ===== */
    .desktop-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .desktop-table thead tr {
        background: var(--navy);
    }

    .desktop-table thead th {
        padding: 11px 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 10px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.9);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
    }

    .desktop-table thead th.center {
        text-align: center;
    }

    .desktop-table tbody tr {
        border-bottom: 1px solid var(--gray-100);
        transition: background 0.15s;
    }

    .desktop-table tbody tr:last-child {
        border-bottom: none;
    }

    .desktop-table tbody tr:hover {
        background: var(--navy-light);
    }

    .desktop-table tbody td {
        padding: 10px 14px;
        font-size: 12px;
        color: var(--gray-700);
    }

    .desktop-table tbody td.center {
        text-align: center;
    }

    .td-num {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: var(--navy-light);
        color: var(--navy);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .td-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--gray-900);
    }

    .td-sub {
        font-size: 10px;
        color: var(--gray-400);
    }

    .aksi-row {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .select-pindah-td {
        padding: 7px 10px;
        font-size: 11px;
        font-family: 'Nunito', sans-serif;
        border: 1.5px solid var(--gray-200);
        border-radius: 8px;
        background: white;
        color: var(--gray-900);
        outline: none;
        appearance: none;
        transition: border-color 0.2s;
        min-width: 140px;
    }

    .select-pindah-td:focus {
        border-color: var(--warning);
    }

    .btn-pindah-sm {
        padding: 7px 10px;
        border-radius: 8px;
        background: var(--warning-light);
        color: var(--warning);
        border: 1.5px solid #FDE68A;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .btn-pindah-sm:hover {
        background: #FEF3C7;
    }

    .btn-keluarkan-sm {
        padding: 7px 10px;
        border-radius: 8px;
        background: var(--danger-light);
        color: var(--danger);
        border: 1.5px solid #FECACA;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-keluarkan-sm:hover {
        background: #FEE2E2;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        padding: 40px 20px;
        text-align: center;
    }

    .empty-icon {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .empty-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 15px;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 5px;
    }

    .empty-desc {
        font-size: 12px;
        color: var(--gray-500);
        margin-bottom: 14px;
    }

    .btn-to-placement {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 18px;
        border-radius: 10px;
        background: var(--navy);
        color: white;
        text-decoration: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 3px 10px rgba(2, 6, 89, 0.25);
        transition: all 0.2s;
    }

    .btn-to-placement:hover {
        background: var(--navy-mid);
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    /* ===== ANIMATIONS ===== */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
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

    {{-- ===== HEADER ===== --}}
    <div class="page-header">
        <a href="{{ route('staff_tu.penempatan.index') }}" class="back-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Rombel
        </a>
        <div class="header-top">
            <div class="header-icon">🏫</div>
            <div class="header-title">{{ $rombel->nama_lengkap }}</div>
        </div>
        <div class="header-subtitle">
            Tahun Ajaran {{ $tahunAjaranAktif->tahun_ajaran }}
        </div>
    </div>

    <div class="content-area">

        {{-- ===== NOTIFIKASI ===== --}}
        @if(session('success'))
        <div class="notif success">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
        </div>
        @endif
        @if(session('error'))
        <div class="notif error">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div><strong>Terjadi Kesalahan!</strong> {{ session('error') }}</div>
        </div>
        @endif

        {{-- ===== INFO ROMBEL ===== --}}
        <div class="section-label">📋 Informasi Rombel</div>

        <div class="info-card">
            <div class="info-card-header">
                <div>
                    <div class="rombel-name">🏫 {{ $rombel->nama_lengkap }}</div>
                    <div class="rombel-ta">Tahun Ajaran {{ $tahunAjaranAktif->tahun_ajaran }}</div>
                </div>
            </div>

            <div class="info-meta-grid">
                <div>
                    <div class="info-meta-item-label">Wali Kelas</div>
                    <div class="info-meta-item-value">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ $rombel->walikelas ? $rombel->walikelas->nama : 'Belum ditentukan' }}
                    </div>
                </div>
                <div>
                    <div class="info-meta-item-label">Jumlah Siswa</div>
                    <div class="info-meta-item-value">
                        <span class="siswa-count-badge">{{ $rombel->siswas->count() }} siswa</span>
                    </div>
                </div>
                <div>
                    <div class="info-meta-item-label">Tingkat</div>
                    <div class="info-meta-item-value">Kelas {{ $rombel->tingkat }}</div>
                </div>
            </div>



            {{-- Export --}}
            @if($rombel->siswas->count())
            <div class="export-row">
                <a href="{{ route('staff_tu.penempatan.exportSiswa', $rombel->id) }}" class="btn-export btn-excel">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export Excel
                </a>
                <a href="{{ route('staff_tu.penempatan.exportPdf', $rombel->id) }}" class="btn-export btn-pdf">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Export PDF
                </a>
            </div>
            @endif
        </div>

        {{-- ===== ATUR WALI KELAS ===== --}}
        <div class="section-label">⚙️ Atur Wali Kelas</div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-header-icon">⚙️</div>
                <div>
                    <div class="form-header-title">Atur Wali Kelas</div>
                    <div class="form-header-sub">Tentukan guru sebagai wali kelas rombel ini</div>
                </div>
            </div>
            <div class="form-body">
                <form action="{{ route('staff_tu.penempatan.setWalikelas', $rombel->id) }}" method="POST">
                    @csrf
                    <div style="margin-bottom:12px;">
                        <label class="form-label">👨‍🏫 Pilih Guru</label>
                        <div class="select-wrap">
                            <select name="guru_id" class="form-control">
                                <option value="">-- Pilih Wali Kelas --</option>
                                @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}"
                                    {{ $rombel->guru_id == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="display:flex; justify-content:flex-end;">
                        <button type="submit" class="btn-save">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Wali Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===== LULUSKAN SEMUA (Kelas 9 saja) ===== --}}
        @if($rombel->tingkat == 9 && $rombel->siswas->count())
        <div class="section-label">🎓 Kelulusan</div>
        <div class="lulus-card">
            <div class="lulus-info">
                <div class="lulus-icon">🎓</div>
                <div>
                    <div class="lulus-title">Luluskan Semua Siswa Kelas 9</div>
                    <div class="lulus-desc">Pindahkan semua {{ $rombel->siswas->count() }} siswa ke data Alumni</div>
                </div>
            </div>
            <form action="{{ route('staff_tu.rombel.lulusSemua', $rombel->id) }}" method="POST"
                onsubmit="return confirm('⚠️ Yakin ingin meluluskan semua {{ $rombel->siswas->count() }} siswa?\n\nSiswa akan dipindahkan ke data Alumni.')">
                @csrf
                <button type="submit" class="btn-lulus">
                    🎓 Luluskan Semua Siswa
                </button>
            </form>
        </div>
        @endif

        {{-- ===== DAFTAR SISWA ===== --}}
        <div class="section-label">👥 Daftar Siswa</div>

        <div class="siswa-card">
            <div class="siswa-card-header">
                <div class="siswa-card-title">
                    <span style="width:7px;height:7px;background:var(--navy);border-radius:50%;display:inline-block;"></span>
                    Daftar Siswa Terdaftar
                </div>
                <span class="siswa-card-count">{{ $rombel->siswas->count() }} siswa</span>
            </div>

            @if($rombel->siswas->count())

            {{-- ===== MOBILE: CARD LIST ===== --}}
            <div class="mobile-list">
                @foreach($rombel->siswas as $index => $siswa)
                <div class="siswa-mobile-item">
                    <div class="siswa-mobile-top">
                        <div style="display:flex; align-items:flex-start; gap:9px;">
                            <div class="siswa-num-badge">{{ $index + 1 }}</div>
                            <div>
                                <div class="siswa-mobile-name">{{ $siswa->nama_siswa }}</div>
                                <div class="siswa-mobile-sub">NISN: {{ $siswa->nisn }} &bull; NIS: {{ $siswa->nis }}</div>
                            </div>
                        </div>
                        <span class="gender-badge {{ $siswa->jenis_kelamin == 'L' ? 'gb-l' : 'gb-p' }}">
                            {{ $siswa->jenis_kelamin == 'L' ? 'L' : 'P' }}
                        </span>
                    </div>

                    <div class="siswa-aksi">
                        {{-- Pindahkan --}}
                        <form action="{{ route('staff_tu.penempatan.pindahkan') }}" method="POST" class="form-pindah">
                            @csrf
                            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                            <select name="rombel_tujuan_id" class="select-pindah">
                                <option value="">-- Pindahkan ke Rombel --</option>
                                @foreach(App\Models\Tatausaha\Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)->orderBy('tingkat')->orderBy('kode_rombel')->get() as $r)
                                @if($r->id !== $rombel->id)
                                <option value="{{ $r->id }}">{{ $r->nama_lengkap }}</option>
                                @endif
                                @endforeach
                            </select>
                            <button type="submit" class="btn-pindah">↔️ Pindah</button>
                        </form>

                        {{-- Keluarkan --}}
                        <form action="{{ route('staff_tu.penempatan.keluarkan', $siswa->id) }}" method="POST"
                            onsubmit="return confirm('⚠️ Yakin mengeluarkan {{ $siswa->nama_siswa }} dari rombel ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-keluarkan">🗑️ Keluarkan dari Rombel</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- ===== DESKTOP: TABLE ===== --}}
            <div class="desktop-table" style="overflow-x:auto; max-height:520px; overflow-y:auto;">
                <table>
                    <thead>
                        <tr>
                            <th class="center" style="width:60px;">No</th>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th class="center" style="width:110px;">Jenis Kelamin</th>
                            <th class="center" style="width:340px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rombel->siswas as $index => $siswa)
                        <tr>
                            <td class="center">
                                <span class="td-num">{{ $index + 1 }}</span>
                            </td>
                            <td style="font-size:12px; color:var(--gray-700);">{{ $siswa->nisn }}</td>
                            <td style="font-size:12px; color:var(--gray-700);">{{ $siswa->nis }}</td>
                            <td>
                                <div class="td-name">{{ $siswa->nama_siswa }}</div>
                            </td>
                            <td class="center">
                                <span class="gender-badge {{ $siswa->jenis_kelamin == 'L' ? 'gb-l' : 'gb-p' }}">
                                    {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                            <td>
                                <div class="aksi-row">
                                    {{-- Pindahkan --}}
                                    <form action="{{ route('staff_tu.penempatan.pindahkan') }}" method="POST" style="display:flex; align-items:center; gap:5px;">
                                        @csrf
                                        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                                        <select name="rombel_tujuan_id" class="select-pindah-td">
                                            <option value="">-- Pindah ke --</option>
                                            @foreach(App\Models\Tatausaha\Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)->orderBy('tingkat')->orderBy('kode_rombel')->get() as $r)
                                            @if($r->id !== $rombel->id)
                                            <option value="{{ $r->id }}">{{ $r->nama_lengkap }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn-pindah-sm">↔️</button>
                                    </form>

                                    {{-- Keluarkan --}}
                                    <form action="{{ route('staff_tu.penempatan.keluarkan', $siswa->id) }}" method="POST"
                                        onsubmit="return confirm('⚠️ Yakin mengeluarkan {{ $siswa->nama_siswa }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-keluarkan-sm">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
            <div class="empty-state">
                <div class="empty-icon">👤</div>
                <div class="empty-title">Belum Ada Siswa</div>
                <div class="empty-desc">Silakan tempatkan siswa ke rombel ini dari halaman penempatan.</div>
                <a href="{{ route('staff_tu.penempatan.index') }}" class="btn-to-placement">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Ke Halaman Penempatan
                </a>
            </div>
            @endif
        </div>

    </div>
</div>

@endsection