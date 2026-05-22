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
    padding-bottom: 40px;
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
    font-size: 20px;
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
    padding: 16px 12px;
}

/* ---- PETUNJUK BANNER ---- */
.petunjuk-banner {
    background: #EEF2FF;
    border: 1.5px solid #C7D2FE;
    border-radius: var(--radius-md);
    padding: 12px 14px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 20px;
}

.petunjuk-icon { font-size: 18px; flex-shrink: 0; margin-top: 1px; }

.petunjuk-text {
    font-size: 12px;
    color: #3730A3;
    line-height: 1.55;
}

.petunjuk-text strong {
    display: block;
    font-weight: 700;
    font-size: 12px;
    margin-bottom: 2px;
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

/* ---- TINGKAT SECTION ---- */
.tingkat-section {
    margin-bottom: 22px;
    animation: slideUp 0.35s ease both;
}

.tingkat-section:nth-child(1) { animation-delay: 0.05s; }
.tingkat-section:nth-child(2) { animation-delay: 0.12s; }
.tingkat-section:nth-child(3) { animation-delay: 0.19s; }

@keyframes slideUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Tingkat header */
.tingkat-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    padding: 0 2px;
}

.tingkat-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 800;
    color: var(--gray-900);
    display: flex;
    align-items: center;
    gap: 6px;
}

.tingkat-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--navy);
}

.tingkat-count {
    font-size: 11px;
    font-weight: 700;
    background: #EEF2FF;
    color: var(--navy);
    padding: 3px 10px;
    border-radius: 99px;
}

/* ---- KELAS CARD ---- */
.kelas-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.kelas-card {
    display: block;
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 14px 14px 0;
    box-shadow: var(--shadow-sm);
    text-decoration: none;
    color: inherit;
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s;
    -webkit-tap-highlight-color: transparent;
    user-select: none;
}

.kelas-card:active {
    transform: scale(0.97);
}

.kelas-card-body {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding-bottom: 12px;
}

.kelas-tingkat-tag {
    font-size: 10px;
    font-weight: 700;
    color: var(--gray-400);
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 3px;
}

.kelas-nama {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 15px;
    font-weight: 800;
    color: var(--gray-900);
    line-height: 1.2;
}

.kelas-arrow {
    width: 38px; height: 38px;
    border-radius: 12px;
    background: var(--navy);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(2,6,89,0.28);
    transition: transform 0.18s, background 0.18s;
}

.kelas-arrow svg {
    width: 16px; height: 16px;
    color: white;
}

.kelas-footer {
    border-top: 1px solid var(--gray-100);
    padding: 8px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.kelas-footer-hint {
    font-size: 10px;
    color: var(--gray-400);
}

.kelas-footer-cta {
    font-size: 10px;
    font-weight: 700;
    color: var(--navy);
}

/* ---- EMPTY STATE ---- */
.empty-state {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 48px 24px;
    text-align: center;
    box-shadow: var(--shadow-sm);
}

.empty-icon  { font-size: 42px; margin-bottom: 12px; }
.empty-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; font-weight: 700; color: var(--gray-800); margin-bottom: 6px; }
.empty-desc  { font-size: 12px; color: var(--gray-500); line-height: 1.65; }

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

    .hero-card::before { width: 260px; height: 260px; top: -80px; right: -60px; }

    .hero-sub    { font-size: 13px; }
    .hero-title  { font-size: 28px; }
    .hero-desc   { font-size: 14px; margin-bottom: 0; }

    .hero-date-chip {
        font-size: 13px;
        padding: 8px 16px;
        flex-shrink: 0;
        align-self: flex-end;
    }

    /* Body */
    .page-body { padding: 28px 0; }

    .section-title { font-size: 15px; }

    /* Petunjuk */
    .petunjuk-banner {
        padding: 16px 20px;
        border-radius: var(--radius-lg);
        font-size: 13px;
    }

    .petunjuk-icon { font-size: 22px; }
    .petunjuk-text { font-size: 13px; }
    .petunjuk-text strong { font-size: 14px; }

    /* Tingkat */
    .tingkat-label { font-size: 15px; }
    .tingkat-count { font-size: 12px; }

    /* Kelas grid: 2 cols desktop */
    .kelas-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .kelas-card {
        padding: 18px 18px 0;
        border-radius: var(--radius-lg);
    }

    .kelas-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        border-color: #A5B4FC;
        text-decoration: none;
        color: inherit;
    }

    .kelas-card:hover .kelas-arrow {
        background: var(--navy-light);
        transform: translateX(3px);
    }

    .kelas-card-body { padding-bottom: 16px; }

    .kelas-tingkat-tag { font-size: 11px; }
    .kelas-nama { font-size: 17px; }

    .kelas-arrow {
        width: 44px; height: 44px;
        border-radius: 14px;
    }

    .kelas-arrow svg { width: 18px; height: 18px; }

    .kelas-footer { padding: 10px 0; }
    .kelas-footer-hint { font-size: 11px; }
    .kelas-footer-cta  { font-size: 11px; }
}
</style>

<div class="page-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div>
            <div class="hero-sub">Dashboard Guru</div>
            <div class="hero-title">📝 Absensi Siswa</div>
            <div class="hero-desc">Pilih kelas untuk mengisi absensi hari ini</div>
            <div class="hero-date-chip">📅 {{ now()->translatedFormat('d F Y') }}</div>
        </div>
    </div>

    <div class="page-body">

        {{-- ===== PETUNJUK ===== --}}
        <div class="petunjuk-banner">
            <span class="petunjuk-icon">💡</span>
            <div class="petunjuk-text">
                <strong>Cara menggunakan</strong>
                Ketuk salah satu kelas di bawah untuk mulai mengisi absensi siswa. Pilih sesuai kelas yang Anda ajar hari ini.
            </div>
        </div>

        {{-- ===== DAFTAR KELAS ===== --}}
        @php
            $grouped = $rombels->groupBy(fn ($rombel) => 'Kelas ' . $rombel->tingkat_romawi);
        @endphp

        @forelse($grouped as $tingkat => $dataRombel)

            <div class="tingkat-section">

                <div class="tingkat-header">
                    <div class="tingkat-label">
                        <span class="tingkat-dot"></span>
                        📘 {{ $tingkat }}
                    </div>
                    <span class="tingkat-count">{{ $dataRombel->count() }} Kelas</span>
                </div>

                <div class="kelas-list">
                    @foreach($dataRombel as $rombel)
                    <a href="{{ route('guru.absen-siswa.form', $rombel) }}" class="kelas-card">

                        <div class="kelas-card-body">
                            <div>
                                <div class="kelas-tingkat-tag">{{ $tingkat }}</div>
                                <div class="kelas-nama">{{ $rombel->nama_lengkap }}</div>
                            </div>
                            <div class="kelas-arrow">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>

                        <div class="kelas-footer">
                            <span class="kelas-footer-hint">👆 Ketuk untuk isi absensi</span>
                            <span class="kelas-footer-cta">Masuk ke kelas →</span>
                        </div>

                    </a>
                    @endforeach
                </div>

            </div>

        @empty

            <div class="empty-state">
                <div class="empty-icon">📚</div>
                <div class="empty-title">Belum Ada Kelas</div>
                <div class="empty-desc">
                    Anda belum memiliki kelas untuk absensi siswa.<br>
                    Hubungi admin jika ini tidak seharusnya terjadi.
                </div>
            </div>

        @endforelse

    </div>
</div>

@endsection
