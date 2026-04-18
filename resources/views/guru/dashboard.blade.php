@extends('layouts.guru')
@section('title','Dashboard Guru')
@section('header','Dashboard Guru')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');

:root {
    --navy: #020659;
    --navy-light: #1a237e;
    --blue-soft: #EFF6FF;
    --green-soft: #F0FDF4;
    --purple-soft: #F5F3FF;
    --orange-soft: #FFF7ED;
    --indigo-soft: #EEF2FF;
    --emerald-soft: #ECFDF5;
    --gray-50: #F8FAFC;
    --gray-100: #F1F5F9;
    --gray-200: #E2E8F0;
    --gray-400: #94A3B8;
    --gray-500: #64748B;
    --gray-700: #334155;
    --gray-800: #1E293B;
    --gray-900: #0F172A;
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
   MOBILE FIRST — semua base style untuk layar kecil
   ====================================================== */

/* WRAPPER */
.dash-wrap {
    padding: 0;
    max-width: 100%;
}

/* ---- HERO / GREETING CARD ---- */
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

.hero-greeting {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 4px;
    position: relative; z-index: 1;
}

.hero-role {
    font-size: 12px;
    opacity: 0.8;
    margin-bottom: 2px;
    position: relative; z-index: 1;
}

.hero-date {
    font-size: 11px;
    opacity: 0.65;
    position: relative; z-index: 1;
}

.hero-status {
    margin-top: 14px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.18);
    border-radius: var(--radius-sm);
    padding: 10px 14px;
    font-size: 12px;
    position: relative; z-index: 1;
    backdrop-filter: blur(4px);
}

.hero-status .status-dot {
    display: inline-block;
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #4ade80;
    margin-right: 6px;
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}

/* ---- CONTENT BODY ---- */
.dash-body {
    padding: 16px 12px;
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

/* ---- ACTION CARDS (Absen Masuk & Absen Siswa) ---- */
.action-row {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
    margin-bottom: 20px;
}

.action-card {
    border-radius: var(--radius-md);
    padding: 16px;
    box-shadow: var(--shadow-sm);
    display: flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
    transition: transform 0.18s ease, box-shadow 0.18s ease;
    position: relative;
    overflow: hidden;
}

.action-card:active {
    transform: scale(0.98);
}

.action-card.blue {
    background: linear-gradient(135deg, #2563EB, #3B82F6);
    color: white;
}

.action-card.green {
    background: linear-gradient(135deg, #059669, #10B981);
    color: white;
}

.action-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    background: rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.action-text .action-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 2px;
}

.action-text .action-desc {
    font-size: 11px;
    opacity: 0.85;
}

.action-arrow {
    margin-left: auto;
    font-size: 18px;
    opacity: 0.7;
    flex-shrink: 0;
}

/* ---- MENU GRID ---- */
.menu-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 20px;
}

.menu-card {
    border-radius: var(--radius-md);
    padding: 14px 12px;
    box-shadow: var(--shadow-sm);
    text-decoration: none;
    display: block;
    transition: transform 0.18s ease, box-shadow 0.18s ease;
    border: 1.5px solid transparent;
}

.menu-card:active { transform: scale(0.97); }

.menu-card.purple  { background: var(--purple-soft);  border-color: #DDD6FE; }
.menu-card.orange  { background: var(--orange-soft);  border-color: #FED7AA; }
.menu-card.green  { background: var(--green-soft);  border-color: #F0fDf4; }
.menu-card.emerald  { background: var(--emerald-soft);  border-color: #ECFDF5; }
.menu-card.gray    { background: var(--gray-100);     border-color: var(--gray-200); }

.menu-card .mc-icon {
    font-size: 22px;
    margin-bottom: 8px;
}

.menu-card .mc-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 4px;
}

.menu-card .mc-desc {
    font-size: 11px;
    color: var(--gray-500);
    line-height: 1.4;
}

/* Profil card full width mobile */
.menu-card.full { grid-column: 1 / -1; }

/* ---- INFO PANELS (Panduan & Tips) ---- */
.info-row {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
    margin-bottom: 20px;
}

.info-panel {
    border-radius: var(--radius-md);
    padding: 16px;
    box-shadow: var(--shadow-sm);
    border: 1.5px solid transparent;
}

.info-panel.indigo  { background: var(--indigo-soft);  border-color: #C7D2FE; }
.info-panel.emerald { background: var(--emerald-soft); border-color: #6EE7B7; }

.info-panel .panel-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 10px;
}

.info-panel ol,
.info-panel ul {
    margin: 0;
    padding-left: 18px;
    color: var(--gray-700);
    font-size: 12px;
    line-height: 1.7;
}

/* ======================================================
   DESKTOP — override mulai ≥768px
   ====================================================== */
@media (min-width: 768px) {

    .dash-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 24px 40px;
    }

    /* Hero desktop */
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
        width: 260px; height: 260px;
        top: -80px; right: -60px;
    }

    .hero-greeting {
        font-size: 26px;
    }

    .hero-role { font-size: 14px; }
    .hero-date { font-size: 13px; }

    .hero-status {
        margin-top: 0;
        flex-shrink: 0;
        min-width: 200px;
        font-size: 13px;
        padding: 14px 18px;
    }

    /* Body */
    .dash-body {
        padding: 28px 0;
    }

    .section-title {
        font-size: 15px;
    }

    /* Action cards desktop: side by side */
    .action-row {
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 28px;
    }

    .action-card {
        padding: 22px 24px;
        border-radius: var(--radius-lg);
    }

    .action-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .action-icon {
        width: 56px; height: 56px;
        border-radius: 16px;
        font-size: 26px;
    }

    .action-text .action-title { font-size: 17px; }
    .action-text .action-desc  { font-size: 13px; }

    /* Menu grid desktop: 3 columns */
    .menu-grid {
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
        margin-bottom: 28px;
    }

    .menu-card.full {
        grid-column: auto; /* reset ke 1 col di desktop */
    }

    .menu-card {
        padding: 22px 20px;
        border-radius: var(--radius-lg);
    }

    .menu-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .menu-card .mc-icon { font-size: 28px; margin-bottom: 12px; }
    .menu-card .mc-title { font-size: 15px; }
    .menu-card .mc-desc  { font-size: 12px; }

    /* Info panels: side by side */
    .info-row {
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 28px;
    }

    .info-panel {
        padding: 24px;
        border-radius: var(--radius-lg);
    }

    .info-panel .panel-title { font-size: 15px; }

    .info-panel ol,
    .info-panel ul {
        font-size: 13px;
    }
}
</style>

<div class="dash-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div>
            <div class="hero-greeting">
                👋 Assalamu'alaikum, {{ auth()->user()->name }}
            </div>
            <div class="hero-role">
                Login sebagai
                <strong>{{ ucfirst(str_replace('_',' ', auth()->user()->role)) }}</strong>
            </div>
            <div class="hero-date">
                📅 {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>

        <div class="hero-status">
            <div style="font-weight:700; margin-bottom:4px;">
                <span class="status-dot"></span>Sistem Normal
            </div>
            <div style="opacity:0.85;">Semua fitur berjalan baik dan siap digunakan.</div>
        </div>
    </div>

    <div class="dash-body">

        {{-- ===== ABSENSI ===== --}}
        <div class="section-title">🕘 Langkah Pertama Hari Ini</div>

        <div class="action-row">
            <a href="{{ url('/guru/absensi') }}" class="action-card blue">
                <div class="action-icon">📋</div>
                <div class="action-text">
                    <div class="action-title">Absensi Guru</div>
                    <div class="action-desc">Absen masuk & pulang harian</div>
                </div>
                <div class="action-arrow">›</div>
            </a>

            <a href="{{ url('/guru/absen-siswa') }}" class="action-card green">
                <div class="action-icon">📝</div>
                <div class="action-text">
                    <div class="action-title">Absensi Siswa</div>
                    <div class="action-desc">Catat kehadiran siswa di kelas</div>
                </div>
                <div class="action-arrow">›</div>
            </a>
        </div>

        {{-- ===== MENU ===== --}}
        <div class="section-title">📌 Menu Penting</div>

        <div class="menu-grid">
            <a href="{{ url('/guru/jadwal-hari-ini') }}" class="menu-card purple">
                <div class="mc-icon">📅</div>
                <div class="mc-title">Jadwal Mengajar</div>
                <div class="mc-desc">Lihat jadwal kelas anda hari ini</div>
            </a>

            <a href="{{ url('/guru/absen-siswa/hari-ini') }}" class="menu-card orange">
                <div class="mc-icon">📊</div>
                <div class="mc-title">Rekap Kehadiran</div>
                <div class="mc-desc">Laporan absensi siswa</div>
            </a>

            <a href="{{ url('/guru/profile') }}" class="menu-card emerald">
                <div class="mc-icon">👤</div>
                <div class="mc-title">Profil Saya</div>
                <div class="mc-desc">Perbarui data diri Anda jika ada perubahan</div>
            </a>

                <a href="{{ url('/guru/rekap-absensi') }}" class="menu-card green">
                <div class="mc-icon">👤</div>
                <div class="mc-title">Rekap Absen Saya</div>
                <div class="mc-desc">Lihat rekapan absen anda setiap bulan</div>
            </a>
        </div>

        {{-- ===== PANDUAN & TIPS ===== --}}
        <div class="section-title">📖 Panduan & Tips</div>

        <div class="info-row">
            <div class="info-panel indigo">
                <div class="panel-title">📖 Panduan Singkat</div>
                <ol>
                    <li>Absen masuk saat tiba di sekolah.</li>
                    <li>Cek jadwal sebelum mulai mengajar.</li>
                    <li>Isi absensi siswa di setiap kelas.</li>
                    <li>Absen pulang sebelum meninggalkan sekolah.</li>
                </ol>
            </div>

            <div class="info-panel emerald">
                <div class="panel-title">💡 Tips Penting</div>
                <ul>
                    <li>Pastikan absensi lengkap setiap hari.</li>
                    <li>Periksa jadwal agar tidak ada kelas terlewat.</li>
                    <li>Hubungi admin jika ada kendala sistem.</li>
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection