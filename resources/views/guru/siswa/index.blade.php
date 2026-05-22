@extends('layouts.guru')

@section('title', 'Data Siswa Walikelas Saya')

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
    --pink: #DB2777;
    --pink-light: #FDF2F8;
    --radius-sm: 10px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04);
    --shadow-lg: 0 10px 30px rgba(0,0,0,0.08);
}

* { box-sizing: border-box; }
body { margin: 0; padding: 0; font-family: 'Nunito', sans-serif; background: var(--gray-50); }

@keyframes slideUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ======================================================
   MOBILE FIRST
   ====================================================== */

.page-wrap { padding: 0; max-width: 100%; padding-bottom: 40px; }

/* ---- HERO ---- */
.hero-card {
    background: linear-gradient(135deg, var(--navy) 0%, #1a237e 60%, #283593 100%);
    padding: 20px 16px 28px;
    color: white; position: relative; overflow: hidden;
}
.hero-card::before {
    content: ''; position: absolute;
    top: -40px; right: -40px; width: 160px; height: 160px;
    border-radius: 50%; background: rgba(255,255,255,0.05);
}
.hero-card::after {
    content: ''; position: absolute;
    bottom: -30px; left: -20px; width: 120px; height: 120px;
    border-radius: 50%; background: rgba(255,255,255,0.04);
}
.hero-sub   { font-size: 11px; opacity: 0.7; position: relative; z-index: 1; }
.hero-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 20px; font-weight: 800;
    margin: 2px 0 4px; position: relative; z-index: 1;
}
.hero-desc  { font-size: 12px; opacity: 0.8; position: relative; z-index: 1; }

/* ---- BODY ---- */
.page-body {
    padding: 14px 12px;
    display: flex; flex-direction: column; gap: 14px;
}

/* ---- SECTION TITLE ---- */
.section-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700;
    color: var(--gray-700);
    margin: 4px 0 10px 2px;
    display: flex; align-items: center; gap: 6px;
}

/* ---- ROMBEL INFO CARD ---- */
.rombel-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 16px; box-shadow: var(--shadow-sm);
    animation: slideUp 0.35s ease both;
}

.rombel-ta-label {
    font-size: 10px; font-weight: 700; color: var(--gray-400);
    text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 2px;
}
.rombel-ta-value {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 700; color: var(--gray-900); margin-bottom: 14px;
}

.rombel-meta-row {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 10px; margin-bottom: 14px;
}
.rombel-meta-label {
    font-size: 10px; color: var(--gray-400);
    text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 3px;
}
.rombel-meta-val {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 15px; font-weight: 700; color: var(--gray-900);
}

/* Stats row */
.stats-row {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    padding-top: 14px; border-top: 1px solid var(--gray-100);
}
.stat-box {
    background: var(--gray-50); border-radius: var(--radius-sm);
    padding: 10px 8px; text-align: center;
    border: 1.5px solid var(--gray-200);
}
.stat-box-label {
    font-size: 10px; font-weight: 700; color: var(--gray-500);
    text-transform: uppercase; letter-spacing: 0.2px; margin-bottom: 4px;
}
.stat-box-val {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 22px; font-weight: 800;
}
.sv-navy { color: var(--navy); }
.sv-blue { color: var(--blue); }
.sv-pink { color: var(--pink); }

/* ---- SISWA CARDS ---- */
.siswa-list { display: flex; flex-direction: column; gap: 10px; }

.siswa-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    overflow: hidden; box-shadow: var(--shadow-sm);
    animation: slideUp 0.4s ease both;
    transition: transform 0.18s, box-shadow 0.18s;
}
.siswa-card:nth-child(1)  { animation-delay: 0.03s; }
.siswa-card:nth-child(2)  { animation-delay: 0.06s; }
.siswa-card:nth-child(3)  { animation-delay: 0.09s; }
.siswa-card:nth-child(4)  { animation-delay: 0.12s; }
.siswa-card:nth-child(5)  { animation-delay: 0.15s; }
.siswa-card:nth-child(n+6){ animation-delay: 0.18s; }

/* Nama bar */
.siswa-name-bar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 14px; gap: 10px;
    background: var(--gray-50); border-bottom: 1px solid var(--gray-100);
}
.siswa-name-left { display: flex; align-items: center; gap: 10px; }

.siswa-num-badge {
    width: 30px; height: 30px; border-radius: 9px;
    background: #EEF2FF;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px; font-weight: 800; color: var(--navy); flex-shrink: 0;
}
.siswa-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700; color: var(--gray-900); margin-bottom: 1px;
}
.siswa-nis { font-size: 11px; color: var(--gray-400); }

.gender-badge {
    font-size: 11px; font-weight: 700;
    padding: 3px 10px; border-radius: 99px; white-space: nowrap; flex-shrink: 0;
}
.gb-laki      { background: var(--blue-light); color: var(--blue); }
.gb-perempuan { background: var(--pink-light);  color: var(--pink); }

/* Detail bawah */
.siswa-detail { padding: 10px 14px; display: flex; flex-direction: column; gap: 7px; }
.detail-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 8px; }
.detail-label {
    font-size: 10px; font-weight: 700; color: var(--gray-400);
    text-transform: uppercase; letter-spacing: 0.3px;
    flex-shrink: 0; padding-top: 1px;
}
.detail-value {
    font-size: 12px; font-weight: 600; color: var(--gray-700); text-align: right;
}
.detail-value.alamat { text-align: right; line-height: 1.4; max-width: 65%; }

/* ---- EMPTY STATES ---- */
.empty-siswa {
    background: white; border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md); padding: 30px 20px;
    text-align: center; box-shadow: var(--shadow-sm);
}
.empty-rombel {
    background: white; border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md); padding: 48px 24px;
    text-align: center; box-shadow: var(--shadow-sm);
    animation: slideUp 0.35s ease both;
}
.empty-icon-wrap {
    width: 60px; height: 60px; border-radius: 50%;
    background: #EEF2FF;
    display: flex; align-items: center; justify-content: center;
    font-size: 26px; margin: 0 auto 14px;
}
.empty-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 15px; font-weight: 800; color: var(--gray-800); margin-bottom: 6px;
}
.empty-desc  { font-size: 12px; color: var(--gray-500); line-height: 1.65; margin-bottom: 14px; }
.empty-tip {
    display: inline-flex; align-items: center; gap: 6px;
    background: #EEF2FF; color: var(--navy);
    border-radius: var(--radius-sm); padding: 7px 14px;
    font-size: 12px; font-weight: 700;
}

/* ======================================================
   DESKTOP ≥768px
   ====================================================== */
@media (min-width: 768px) {

    .page-wrap { max-width: 1100px; margin: 0 auto; padding: 0 24px 48px; }

    /* Hero */
    .hero-card {
        border-radius: var(--radius-lg);
        margin: 24px 0 0; padding: 32px 40px;
        display: flex; align-items: center;
        justify-content: space-between; gap: 24px;
    }
    .hero-card::before { width: 260px; height: 260px; top: -80px; right: -60px; }
    .hero-sub   { font-size: 13px; }
    .hero-title { font-size: 28px; }
    .hero-desc  { font-size: 14px; }

    /* Body */
    .page-body { padding: 24px 0; gap: 20px; }

    .section-title { font-size: 15px; }

    /* Rombel card: horizontal layout */
    .rombel-card {
        padding: 24px 28px; border-radius: var(--radius-lg);
        display: grid; grid-template-columns: 1fr auto;
        align-items: start; gap: 24px;
    }

    .rombel-card-left { flex: 1; }

    .rombel-ta-label { font-size: 11px; }
    .rombel-ta-value { font-size: 16px; }
    .rombel-meta-row { grid-template-columns: repeat(2, auto); gap: 32px; }
    .rombel-meta-val { font-size: 18px; }

    .stats-row {
        padding-top: 0; border-top: none; border-left: 1.5px solid var(--gray-100);
        padding-left: 24px; gap: 12px;
        grid-template-columns: 1fr;
        min-width: 160px;
    }

    .stat-box { padding: 12px 16px; border-radius: var(--radius-md); }
    .stat-box-val { font-size: 26px; }

    /* Siswa grid: 2 cols */
    .siswa-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .siswa-card { border-radius: var(--radius-lg); }

    .siswa-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: #A5B4FC;
    }

    .siswa-name-bar { padding: 12px 18px; }
    .siswa-num-badge { width: 34px; height: 34px; font-size: 13px; }
    .siswa-name { font-size: 14px; }
    .siswa-nis  { font-size: 12px; }

    .siswa-detail { padding: 12px 18px; gap: 9px; }
    .detail-label { font-size: 11px; }
    .detail-value { font-size: 13px; }

    /* Empty */
    .empty-rombel { border-radius: var(--radius-lg); padding: 60px 40px; }
    .empty-icon-wrap { width: 72px; height: 72px; font-size: 32px; }
    .empty-title { font-size: 18px; }
    .empty-desc  { font-size: 14px; }
}

html { scroll-behavior: smooth; }
body { overscroll-behavior-y: none; }
</style>

<div class="page-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div>
            <div class="hero-sub">Dashboard Guru</div>
            <div class="hero-title">👥 Data Siswa Walikelas</div>
            <div class="hero-desc">Kelola dan pantau siswa kelas Anda</div>
        </div>
    </div>

    <div class="page-body">

        @forelse($rombels as $rombel)

        @php
            $siswasPerRombel = $siswas->where('rombel_id', $rombel->id);
            $totalSiswa      = $siswasPerRombel->count();
            $jumlahLaki      = $siswasPerRombel->where('jenis_kelamin', 'L')->count();
            $jumlahPerempuan = $siswasPerRombel->where('jenis_kelamin', 'P')->count();
        @endphp

        {{-- ===== ROMBEL INFO CARD ===== --}}
        <div class="rombel-card">
            <div class="rombel-card-left">
                <div class="rombel-ta-label">Tahun Ajaran</div>
                <div class="rombel-ta-value">{{ $tahunAjaranAktif->tahun_ajaran }}</div>

                <div class="rombel-meta-row">
                    <div>
                        <div class="rombel-meta-label">Tingkat</div>
                        <div class="rombel-meta-val">{{ $rombel->tingkat_romawi }}</div>
                    </div>
                    <div>
                        <div class="rombel-meta-label">Rombel</div>
                        <div class="rombel-meta-val">{{ $rombel->nama_rombel }}</div>
                    </div>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-box-label">Total</div>
                    <div class="stat-box-val sv-navy">{{ $totalSiswa }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-box-label">Laki</div>
                    <div class="stat-box-val sv-blue">{{ $jumlahLaki }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-box-label">Perempuan</div>
                    <div class="stat-box-val sv-pink">{{ $jumlahPerempuan }}</div>
                </div>
            </div>
        </div>

        {{-- ===== DAFTAR SISWA ===== --}}
        <div class="section-title">👨‍🎓 Daftar Siswa</div>

        <div class="siswa-list">
            @forelse($siswasPerRombel as $siswa)

            <div class="siswa-card">
                <div class="siswa-name-bar">
                    <div class="siswa-name-left">
                        <div class="siswa-num-badge">{{ $loop->iteration }}</div>
                        <div>
                            <div class="siswa-name">{{ $siswa->nama_siswa }}</div>
                            <div class="siswa-nis">NIS: {{ $siswa->nis }}</div>
                        </div>
                    </div>
                    @if($siswa->jenis_kelamin == 'L')
                        <span class="gender-badge gb-laki">Laki-laki</span>
                    @else
                        <span class="gender-badge gb-perempuan">Perempuan</span>
                    @endif
                </div>

                <div class="siswa-detail">
                    <div class="detail-row">
                        <span class="detail-label">NISN</span>
                        <span class="detail-value">{{ $siswa->nisn ?: '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Alamat</span>
                        <span class="detail-value alamat">{{ $siswa->alamat ?: '-' }}</span>
                    </div>
                </div>
            </div>

            @empty
            <div class="empty-siswa" style="grid-column: 1 / -1;">
                <div class="empty-icon-wrap">👤</div>
                <div class="empty-title">Belum Ada Siswa</div>
                <div class="empty-desc">
                    Rombel ini belum memiliki siswa yang terdaftar.<br>
                    Hubungi Tata Usaha untuk penempatan siswa.
                </div>
                <span class="empty-tip">💬 Hubungi Tata Usaha</span>
            </div>
            @endforelse
        </div>

        @empty

        {{-- ===== EMPTY: BELUM JADI WALIKELAS ===== --}}
        <div class="empty-rombel">
            <div class="empty-icon-wrap">📚</div>
            <div class="empty-title">Belum Ada Kelas yang Dipimpin</div>
            <div class="empty-desc">
                Anda belum ditetapkan sebagai wali kelas pada tahun ajaran aktif.<br>
                Setelah ditetapkan, data kelas dan siswa akan muncul di sini.
            </div>
            <span class="empty-tip">💬 Hubungi Tata Usaha untuk penunjukan</span>
        </div>

        @endforelse

    </div>
</div>

@endsection
