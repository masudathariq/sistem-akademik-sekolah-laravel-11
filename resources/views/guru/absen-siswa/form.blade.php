@extends('layouts.guru')

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
    --green: #059669;
    --green-light: #ECFDF5;
    --blue: #2563EB;
    --blue-light: #EFF6FF;
    --yellow: #D97706;
    --yellow-light: #FFFBEB;
    --red: #DC2626;
    --red-light: #FEF2F2;
    --slate: #475569;
    --slate-light: #F1F5F9;
    --radius-sm: 10px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04);
    --shadow-lg: 0 10px 30px rgba(0,0,0,0.08);
}

* { box-sizing: border-box; }
body { margin: 0; padding: 0; font-family: 'Nunito', sans-serif; background: var(--gray-50); }

/* ======================================================
   MOBILE FIRST
   ====================================================== */

.page-wrap {
    padding: 0;
    max-width: 100%;
}

/* ---- HERO ---- */
.hero-card {
    background: linear-gradient(135deg, var(--navy) 0%, #1a237e 60%, #283593 100%);
    padding: 20px 16px 28px;
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-card::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}

.hero-card::after {
    content: '';
    position: absolute;
    bottom: -30px; left: -20px;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
}

.hero-sub {
    font-size: 11px;
    opacity: 0.7;
    position: relative; z-index: 1;
}

.hero-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    margin: 2px 0 4px;
    position: relative; z-index: 1;
}

.hero-desc {
    font-size: 12px;
    opacity: 0.8;
    position: relative; z-index: 1;
    margin-bottom: 14px;
}

.hero-date-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.13);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 99px;
    padding: 5px 12px;
    font-size: 11px;
    font-weight: 700;
    color: white;
    position: relative; z-index: 1;
    backdrop-filter: blur(4px);
}

/* ---- BODY ---- */
.page-body {
    padding: 14px 12px 110px; /* padding-bottom harus melebihi tinggi save-bar agar kartu terakhir tidak tertutup */
    display: flex;
    flex-direction: column;
    gap: 12px;
    animation: slideUp 0.35s ease both;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ---- SECTION TITLE ---- */
.section-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: var(--gray-700);
    margin: 20px 0 12px 2px;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ---- LOCKED ALERT ---- */
.locked-alert {
    background: var(--red-light);
    border: 1.5px solid #FECACA;
    border-left: 4px solid var(--red);
    border-radius: var(--radius-md);
    padding: 14px 16px;
    font-size: 13px;
    color: #7F1D1D;
    line-height: 1.6;
}

.locked-alert-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 800;
    color: var(--red);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 7px;
}

.locked-steps {
    background: white;
    border: 1px solid #FECACA;
    border-radius: var(--radius-sm);
    padding: 12px 14px;
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.locked-step {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 12px;
    color: #7F1D1D;
}

.locked-step-num {
    width: 20px; height: 20px;
    background: var(--red);
    color: white;
    border-radius: 50%;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
}

.btn-rekap {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 12px;
    padding: 10px 20px;
    background: var(--navy);
    color: white;
    border: none;
    border-radius: var(--radius-sm);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: opacity 0.15s;
}

.btn-rekap:hover { opacity: 0.9; }

/* ---- LEGEND CARD ---- */
.legend-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 12px 14px;
    box-shadow: var(--shadow-sm);
}

.legend-title {
    font-size: 10px;
    font-weight: 700;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.legend-row {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}

.legend-item {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
}

.li-green  { background: var(--green-light);  color: var(--green); }
.li-blue   { background: var(--blue-light);   color: var(--blue); }
.li-yellow { background: var(--yellow-light); color: var(--yellow); }
.li-red    { background: var(--red-light);    color: var(--red); }
.li-slate  { background: var(--slate-light);  color: var(--slate); }

/* ---- SISWA CARDS ---- */
.siswa-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.siswa-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    animation: slideUp 0.4s ease both;
}

.siswa-card:nth-child(1)  { animation-delay: 0.03s; }
.siswa-card:nth-child(2)  { animation-delay: 0.06s; }
.siswa-card:nth-child(3)  { animation-delay: 0.09s; }
.siswa-card:nth-child(4)  { animation-delay: 0.12s; }
.siswa-card:nth-child(5)  { animation-delay: 0.15s; }
.siswa-card:nth-child(n+6){ animation-delay: 0.18s; }

.siswa-name-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    background: var(--gray-50);
    border-bottom: 1px solid var(--gray-100);
}

.siswa-num-badge {
    width: 26px; height: 26px;
    background: #EEF2FF;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px;
    font-weight: 800;
    color: var(--navy);
    flex-shrink: 0;
}

.siswa-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: var(--gray-900);
}

.siswa-form-body {
    padding: 12px 14px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.status-label-row {
    font-size: 10px;
    font-weight: 700;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-bottom: 6px;
}

/* Radio group */
.status-radio-group {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 5px;
}

.radio-label { cursor: pointer; user-select: none; }
.radio-label input[type="radio"] { display: none; }

.radio-btn {
    text-align: center;
    padding: 7px 4px;
    border-radius: var(--radius-sm);
    border: 1.5px solid var(--gray-200);
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--gray-500);
    background: white;
    transition: all 0.15s;
    line-height: 1;
}

.radio-btn .rb-code  { display: block; font-size: 14px; font-weight: 800; margin-bottom: 2px; }
.radio-btn .rb-label { display: block; font-size: 9px; font-weight: 600; opacity: 0.8; }

.radio-label input[value="H"]:checked ~ .radio-btn { background: var(--green);  border-color: var(--green);  color: white; box-shadow: 0 2px 8px rgba(5,150,105,0.3); }
.radio-label input[value="I"]:checked ~ .radio-btn { background: var(--blue);   border-color: var(--blue);   color: white; box-shadow: 0 2px 8px rgba(37,99,235,0.3); }
.radio-label input[value="S"]:checked ~ .radio-btn { background: var(--yellow); border-color: var(--yellow); color: white; box-shadow: 0 2px 8px rgba(217,119,6,0.3); }
.radio-label input[value="A"]:checked ~ .radio-btn { background: var(--red);    border-color: var(--red);    color: white; box-shadow: 0 2px 8px rgba(220,38,38,0.3); }
.radio-label input[value="B"]:checked ~ .radio-btn { background: var(--slate);  border-color: var(--slate);  color: white; box-shadow: 0 2px 8px rgba(71,85,105,0.3); }

.form-control {
    width: 100%;
    padding: 9px 12px;
    font-size: 12px;
    font-family: 'Nunito', sans-serif;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-sm);
    background: var(--gray-50);
    color: var(--gray-900);
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
}

.form-control:focus {
    border-color: var(--navy);
    background: white;
    box-shadow: 0 0 0 3px rgba(2,6,89,0.08);
}

.form-control::placeholder { color: var(--gray-400); }

/* ---- FIXED SAVE BAR ---- */
.save-bar {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    background: white;
    border-top: 1px solid var(--gray-200);
    padding: 12px 14px;
    box-shadow: 0 -4px 16px rgba(0,0,0,0.08);
    z-index: 30;
}

.btn-save {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, var(--navy), #1a237e);
    color: white;
    border: none;
    border-radius: var(--radius-md);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    transition: opacity 0.15s, transform 0.15s;
    box-shadow: 0 4px 14px rgba(2,6,89,0.3);
}

.btn-save:hover    { opacity: 0.92; }
.btn-save:active   { transform: scale(0.98); }
.btn-save:disabled { opacity: 0.65; cursor: not-allowed; transform: none; }

/* ---- LOADING OVERLAY ---- */
.loading-overlay {
    position: fixed;
    inset: 0;
    background: rgba(2,6,89,0.55);
    backdrop-filter: blur(3px);
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s ease;
}

.loading-overlay.show {
    opacity: 1;
    pointer-events: all;
}

.loading-box {
    background: white;
    border-radius: var(--radius-lg);
    padding: 28px 32px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
    box-shadow: var(--shadow-lg);
    transform: scale(0.88);
    transition: transform 0.25s cubic-bezier(0.34,1.56,0.64,1);
}

.loading-overlay.show .loading-box { transform: scale(1); }

.spinner {
    width: 44px; height: 44px;
    border: 4px solid #EEF2FF;
    border-top-color: var(--navy);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

.loading-text {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: var(--navy);
}

.loading-sub {
    font-size: 12px;
    color: var(--gray-400);
    margin-top: -8px;
}

/* ---- SUCCESS POPUP ---- */
.popup-overlay {
    position: fixed;
    inset: 0;
    background: rgba(2,6,89,0.50);
    backdrop-filter: blur(3px);
    z-index: 110;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

.popup-overlay.show {
    opacity: 1;
    pointer-events: all;
}

.popup-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 32px 28px 28px;
    width: 100%;
    max-width: 320px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    box-shadow: var(--shadow-lg);
    transform: scale(0.82) translateY(16px);
    transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
    text-align: center;
}

.popup-overlay.show .popup-card { transform: scale(1) translateY(0); }

.popup-icon {
    width: 72px; height: 72px;
    background: var(--green-light);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 6px;
    position: relative;
}

.popup-icon svg {
    width: 36px; height: 36px;
    stroke: var(--green);
    stroke-width: 3;
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.popup-icon svg .check-path {
    stroke-dasharray: 50;
    stroke-dashoffset: 50;
    transition: stroke-dashoffset 0.5s ease 0.25s;
}

.popup-overlay.show .popup-icon svg .check-path { stroke-dashoffset: 0; }

.popup-icon::after {
    content: '';
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 2px solid var(--green);
    opacity: 0;
}

.popup-overlay.show .popup-icon::after {
    animation: ripple-ring 0.6s ease 0.3s forwards;
}

@keyframes ripple-ring {
    0%   { inset: -6px; opacity: 0.7; }
    100% { inset: -18px; opacity: 0; }
}

.popup-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    color: var(--gray-900);
}

.popup-desc {
    font-size: 13px;
    color: var(--gray-500);
    line-height: 1.6;
}

.popup-date-badge {
    background: var(--green-light);
    color: var(--green);
    border-radius: 99px;
    padding: 5px 14px;
    font-size: 12px;
    font-weight: 700;
    margin-top: 2px;
}

.popup-count {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 28px;
    font-weight: 800;
    color: var(--navy);
    line-height: 1;
}

.popup-count-label {
    font-size: 11px;
    color: var(--gray-400);
    margin-top: -4px;
}

.btn-popup-close {
    margin-top: 8px;
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, var(--navy), #1a237e);
    color: white;
    border: none;
    border-radius: var(--radius-md);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    transition: opacity 0.15s;
    box-shadow: 0 4px 14px rgba(2,6,89,0.25);
}

.btn-popup-close:hover  { opacity: 0.9; }
.btn-popup-close:active { transform: scale(0.97); }

/* ======================================================
   DESKTOP ≥768px
   ====================================================== */
@media (min-width: 768px) {

    .page-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 24px;
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

    .hero-card::before { width: 260px; height: 260px; top: -80px; right: -60px; }

    .hero-sub    { font-size: 13px; }
    .hero-title  { font-size: 26px; }
    .hero-desc   { font-size: 14px; margin-bottom: 0; }

    .hero-date-chip {
        font-size: 13px;
        padding: 8px 16px;
        flex-shrink: 0;
        align-self: flex-end;
    }

    /* Body */
    .page-body { padding: 24px 0 130px; gap: 16px; }

    .section-title { font-size: 15px; }

    /* Locked alert */
    .locked-alert { font-size: 14px; padding: 20px 24px; }
    .locked-alert-title { font-size: 15px; }

    /* Legend */
    .legend-card { padding: 16px 20px; border-radius: var(--radius-lg); }
    .legend-title { font-size: 11px; }
    .legend-item  { font-size: 12px; padding: 5px 14px; }

    /* Siswa grid: 2 cols */
    .siswa-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .siswa-card { border-radius: var(--radius-lg); }

    .siswa-name-bar { padding: 12px 18px; }
    .siswa-num-badge { width: 30px; height: 30px; font-size: 12px; }
    .siswa-name { font-size: 14px; }

    .siswa-form-body { padding: 14px 18px; gap: 12px; }

    .radio-btn { padding: 10px 4px; }
    .radio-btn .rb-code  { font-size: 16px; }
    .radio-btn .rb-label { font-size: 10px; }

    .form-control { font-size: 13px; padding: 10px 14px; }

    /* Save bar desktop: centered */
    .save-bar {
        padding: 14px 24px;
    }

    .save-bar .inner {
        max-width: 1100px;
        margin: 0 auto;
    }

    .btn-save { font-size: 15px; padding: 14px; }

    /* Popup desktop: larger */
    .popup-card { max-width: 380px; padding: 40px 36px 32px; }
}

html { scroll-behavior: smooth; }
body { overscroll-behavior-y: none; }
</style>

{{-- ===== LOADING OVERLAY ===== --}}
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-box">
        <div class="spinner"></div>
        <div class="loading-text">Menyimpan Absensi...</div>
        <div class="loading-sub">Mohon tunggu sebentar</div>
    </div>
</div>

{{-- ===== SUCCESS POPUP ===== --}}
<div class="popup-overlay" id="successPopup">
    <div class="popup-card">
        <div class="popup-icon">
            <svg viewBox="0 0 24 24">
                <polyline class="check-path" points="4 12 9 17 20 7"/>
            </svg>
        </div>
        <div class="popup-title">Absensi Tersimpan!</div>
        <div class="popup-desc">Data kehadiran siswa berhasil dicatat.</div>
        <div class="popup-date-badge" id="popupDate">📅 –</div>
        <div class="popup-count" id="popupCount">–</div>
        <div class="popup-count-label">siswa tercatat</div>
        <button class="btn-popup-close" onclick="closePopup()">✔ Oke, Selesai</button>
    </div>
</div>

<div class="page-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div>
            <div class="hero-sub">Absensi Siswa</div>
            <div class="hero-title">📝 {{ $rombel->nama_lengkap }}</div>
            <div class="hero-desc">Isi kehadiran siswa satu per satu</div>
            <div class="hero-date-chip">
                📅 {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>

    <div class="page-body">

        @if($sudahAbsen)

        {{-- ===== LOCKED ALERT ===== --}}
        <div class="locked-alert">
            <div class="locked-alert-title">🔒 Absensi Hari Ini Sudah Dikunci</div>
            <div>
                Absensi hari <strong>{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</strong>
                sudah tercatat dan tidak dapat diubah langsung. Jika perlu mengubah status
                <strong>Hadir, Izin, Sakit, Alpha, atau Bolos</strong>,
                silakan hubungi <strong>Tata Usaha</strong> atau ikuti langkah berikut:
            </div>
            <div class="locked-steps">
                <div class="locked-step">
                    <div class="locked-step-num">1</div>
                    <span>Buka menu <strong>Rekap Absensi Siswa</strong></span>
                </div>
                <div class="locked-step">
                    <div class="locked-step-num">2</div>
                    <span>Pilih <strong>Rombongan Belajar</strong> yang ingin diubah</span>
                </div>
                <div class="locked-step">
                    <div class="locked-step-num">3</div>
                    <span>Pilih <strong>Bulan</strong> periode absensi</span>
                </div>
                <div class="locked-step">
                    <div class="locked-step-num">4</div>
                    <span>Klik <strong>Tampilkan</strong> lalu ubah dan simpan data</span>
                </div>
            </div>
            <div style="margin-top:14px;">
                <a href="{{ route('guru.absen-siswa.hari-ini') }}" class="btn-rekap">
                    📊 Lihat Rekap Absensi Hari Ini
                </a>
            </div>
        </div>

        @else

        <form method="POST" action="{{ route('guru.absen-siswa.store') }}" id="absenForm">
            @csrf
            <input type="hidden" name="rombel_id" value="{{ $rombel->id }}">
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">

            {{-- Legend --}}
            <div class="legend-card">
                <div class="legend-title">Keterangan Status</div>
                <div class="legend-row">
                    <span class="legend-item li-green">H &nbsp;Hadir</span>
                    <span class="legend-item li-blue">I &nbsp;Izin</span>
                    <span class="legend-item li-yellow">S &nbsp;Sakit</span>
                    <span class="legend-item li-red">A &nbsp;Alpha</span>
                    <span class="legend-item li-slate">B &nbsp;Bolos</span>
                </div>
            </div>

            <div class="section-title">👥 Daftar Siswa</div>

            {{-- Siswa List --}}
            <div class="siswa-list">
                @foreach($siswas as $siswa)
                <div class="siswa-card">
                    <div class="siswa-name-bar">
                        <div class="siswa-num-badge">{{ $loop->iteration }}</div>
                        <div class="siswa-name">{{ $siswa->nama_siswa }}</div>
                    </div>
                    <div class="siswa-form-body">
                        <div>
                            <div class="status-label-row">Status Kehadiran</div>
                            <div class="status-radio-group">
                                @foreach([['H','Hadir'],['I','Izin'],['S','Sakit'],['A','Alpha'],['B','Bolos']] as [$val, $lab])
                                <label class="radio-label">
                                    <input type="radio" name="absen[{{ $siswa->id }}]" value="{{ $val }}" {{ $val === 'H' ? 'checked' : '' }}>
                                    <div class="radio-btn">
                                        <span class="rb-code">{{ $val }}</span>
                                        <span class="rb-label">{{ $lab }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <input type="text"
                               name="keterangan[{{ $siswa->id }}]"
                               placeholder="Keterangan (opsional)"
                               class="form-control">
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Fixed Save Bar --}}
            <div class="save-bar">
                <div class="inner">
                    <button type="submit" class="btn-save" id="btnSave">
                        💾 Simpan Absensi
                    </button>
                </div>
            </div>

        </form>

        @endif

    </div>
</div>

{{-- JS Data --}}
<div id="jsData"
    data-total="{{ isset($siswas) ? count($siswas) : 0 }}"
    data-tanggal="{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}"
    data-flash-success="{{ session('success') ? '1' : '0' }}"
    style="display:none">
</div>

<script>
    var _jsData     = document.getElementById('jsData');
    var totalSiswa  = parseInt(_jsData.getAttribute('data-total'));
    var tanggalStr  = _jsData.getAttribute('data-tanggal');
    var flashOk     = _jsData.getAttribute('data-flash-success') === '1';

    var form       = document.getElementById('absenForm');
    var btnSave    = document.getElementById('btnSave');
    var loadingEl  = document.getElementById('loadingOverlay');
    var popupEl    = document.getElementById('successPopup');
    var popupDate  = document.getElementById('popupDate');
    var popupCount = document.getElementById('popupCount');

    function showLoading() { loadingEl.classList.add('show'); }
    function hideLoading() { loadingEl.classList.remove('show'); }

    function showSuccess(dateStr, count) {
        hideLoading();
        popupDate.textContent  = '📅 ' + dateStr;
        popupCount.textContent = count;
        popupEl.classList.add('show');
    }

    window.closePopup = function () { popupEl.classList.remove('show'); };

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            btnSave.disabled = true;
            btnSave.innerHTML = '⏳ Menyimpan...';
            showLoading();
            setTimeout(function () {
                sessionStorage.setItem('absenBerhasil', '1');
                sessionStorage.setItem('absenDate', tanggalStr);
                sessionStorage.setItem('absenCount', totalSiswa);
                form.submit();
            }, 600);
        });
    }

    if (sessionStorage.getItem('absenBerhasil') === '1') {
        var d = sessionStorage.getItem('absenDate') || tanggalStr;
        var c = sessionStorage.getItem('absenCount') || totalSiswa;
        sessionStorage.removeItem('absenBerhasil');
        sessionStorage.removeItem('absenDate');
        sessionStorage.removeItem('absenCount');
        showSuccess(d, c);
    }

    if (flashOk) { showSuccess(tanggalStr, totalSiswa); }

    if (popupEl) {
        popupEl.addEventListener('click', function (e) {
            if (e.target === popupEl) window.closePopup();
        });
    }
</script>

@endsection