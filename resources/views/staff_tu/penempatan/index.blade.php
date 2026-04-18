@extends('layouts.staff_tu')

@section('title', 'Penempatan Siswa')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');

:root {
    --navy: #020659; --navy-mid: #0A0F7A; --navy-light: #E8EAFF;
    --gray-50: #F8FAFC; --gray-100: #F1F5F9; --gray-200: #E2E8F0;
    --gray-400: #94A3B8; --gray-500: #64748B; --gray-700: #334155; --gray-900: #0F172A;
    --success: #059669; --success-light: #ECFDF5;
    --warning: #D97706; --warning-light: #FFFBEB;
    --danger: #DC2626; --danger-light: #FEF2F2;
    --purple: #7C3AED; --purple-light: #F5F3FF;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

.page-wrap {
    font-family: 'Nunito', sans-serif;
    background: var(--gray-50);
    min-height: 100vh;
    padding-bottom: 40px;
}

/* ===== HEADER ===== */
.page-header {
    background: var(--navy);
    padding: 12px 14px 20px;
    border-radius: 0 0 22px 22px;
    position: sticky; top: 0; z-index: 20;
    box-shadow: 0 4px 24px rgba(2,6,89,0.25);
}
.header-top { display: flex; align-items: center; gap: 8px; margin-bottom: 2px; }
.header-icon {
    width: 28px; height: 28px; background: rgba(255,255,255,0.15);
    border-radius: 7px; display: flex; align-items: center; justify-content: center;
    font-size: 13px; flex-shrink: 0;
}
.header-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; font-weight: 800; color: white; }
.header-subtitle { color: rgba(255,255,255,0.65); font-size: 10px; margin-bottom: 8px; padding-left: 36px; }
.header-chip {
    display: inline-flex; align-items: center; gap: 4px;
    background: rgba(255,255,255,0.13); border: 1px solid rgba(255,255,255,0.2);
    border-radius: 20px; padding: 3px 10px;
    font-size: 10px; font-weight: 600; color: white; margin-left: 36px;
}

/* ===== CONTENT ===== */
.content-area {
    max-width: 1100px; margin: 0 auto;
    padding: 12px 12px 0;
    display: flex; flex-direction: column; gap: 12px;
}

/* ===== SECTION LABEL ===== */
.section-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: var(--gray-400); padding: 0 2px;
}

/* ===== NOTIFIKASI ===== */
.notif {
    border-radius: 11px; padding: 10px 12px;
    display: flex; align-items: flex-start; gap: 8px;
    font-size: 12px; line-height: 1.5;
    animation: slideUp 0.3s ease both;
}
.notif.success { background: var(--success-light); border-left: 4px solid var(--success); color: #065F46; }
.notif.error   { background: var(--danger-light);  border-left: 4px solid var(--danger);  color: #7F1D1D; }
.notif svg { width: 15px; height: 15px; flex-shrink: 0; margin-top: 1px; }
.notif strong { display: block; font-weight: 700; font-size: 12px; margin-bottom: 1px; }

/* ===== STAT CARDS ===== */
.stats-grid {
    display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;
}
.stat-card {
    background: white; border: 1.5px solid var(--gray-200);
    border-radius: 12px; padding: 10px 12px;
    display: flex; align-items: center; gap: 9px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    animation: slideUp 0.35s ease both;
}
.stat-icon {
    width: 34px; height: 34px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 15px;
}
.si-navy   { background: var(--navy-light); }
.si-green  { background: var(--success-light); }
.si-yellow { background: var(--warning-light); }
.si-purple { background: var(--purple-light); }
.stat-label { font-size: 9px; font-weight: 600; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 2px; }
.stat-value { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 18px; font-weight: 800; }
.sv-navy   { color: var(--navy); }
.sv-green  { color: var(--success); }
.sv-yellow { color: var(--warning); }
.sv-purple { color: var(--purple); font-size: 12px; }

/* ===== FORM CARD ===== */
.form-card {
    background: white; border: 1.5px solid var(--gray-200);
    border-radius: 14px; overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    animation: slideUp 0.4s ease both;
}
.form-card-header {
    background: var(--navy-light); border-bottom: 1px solid #C7D2FE;
    padding: 12px 14px; display: flex; align-items: center; gap: 10px;
}
.form-header-icon {
    width: 32px; height: 32px; background: var(--navy);
    border-radius: 9px; display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.form-header-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 800; color: var(--navy); margin-bottom: 1px; }
.form-header-sub   { font-size: 10px; color: var(--navy-mid); }
.form-body { padding: 13px; display: flex; flex-direction: column; gap: 12px; }

.petunjuk-box {
    background: var(--navy-light); border: 1.5px solid #C7D2FE;
    border-radius: 10px; padding: 10px 12px;
    display: flex; align-items: flex-start; gap: 8px;
    font-size: 11px; color: var(--navy-mid); line-height: 1.6;
}
.petunjuk-box .pb-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; color: var(--navy); font-size: 11px; margin-bottom: 4px; }
.petunjuk-box ul { padding-left: 12px; display: flex; flex-direction: column; gap: 2px; }
.petunjuk-box li { list-style: disc; }
.kbd {
    display: inline-flex; align-items: center;
    background: white; border: 1px solid #C7D2FE;
    border-radius: 4px; padding: 0px 4px;
    font-size: 9px; font-weight: 700; color: var(--navy); font-family: monospace;
}

.form-label {
    display: block; font-size: 9.5px; font-weight: 700;
    color: var(--gray-500); text-transform: uppercase;
    letter-spacing: 0.4px; margin-bottom: 5px;
}
.form-label span { font-weight: 400; color: var(--gray-400); text-transform: none; margin-left: 4px; }
.form-control {
    width: 100%; padding: 9px 11px; font-size: 12.5px;
    font-family: 'Nunito', sans-serif;
    border: 1.5px solid var(--gray-200); border-radius: 9px;
    background: white; color: var(--gray-900); outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    appearance: none;
}
.form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px rgba(2,6,89,0.1); }
.form-control[multiple] { height: 190px; padding: 7px; }
.select-wrap { position: relative; }
.select-wrap::after {
    content: ''; position: absolute; right: 12px; top: 50%;
    transform: translateY(-50%);
    border: 5px solid transparent; border-top-color: var(--gray-400);
    pointer-events: none; margin-top: 3px;
}
.form-hint { font-size: 10px; color: var(--gray-400); margin-top: 4px; display: flex; align-items: center; gap: 4px; }

.btn-submit {
    display: inline-flex; align-items: center; justify-content: center; gap: 7px;
    padding: 9px 18px; border-radius: 9px;
    background: var(--navy); color: white; border: none;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12px; font-weight: 700;
    cursor: pointer; transition: all 0.2s;
    box-shadow: 0 3px 10px rgba(2,6,89,0.25);
}
.btn-submit:hover { background: var(--navy-mid); transform: translateY(-1px); }
.btn-submit:active { transform: scale(0.97); }

/* ===== SEMUA SUDAH DITEMPATKAN ===== */
.all-placed {
    background: var(--success-light); border: 1.5px solid #A7F3D0;
    border-radius: 13px; padding: 22px 16px; text-align: center;
    animation: slideUp 0.35s ease both;
}
.all-placed-icon { font-size: 30px; margin-bottom: 8px; }
.all-placed-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 800; color: var(--success); margin-bottom: 3px; }
.all-placed-desc  { font-size: 11px; color: #065F46; }

/* ===== TINGKAT ===== */
.tingkat-section { display: flex; flex-direction: column; gap: 8px; animation: slideUp 0.4s ease both; }
.tingkat-header {
    display: flex; align-items: center; justify-content: space-between;
    background: white; border: 1.5px solid var(--gray-200);
    border-radius: 10px; padding: 8px 12px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.tingkat-label {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12px; font-weight: 800;
    color: var(--gray-900); display: flex; align-items: center; gap: 6px;
}
.tingkat-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--navy); flex-shrink: 0; }
.tingkat-count { font-size: 10px; font-weight: 700; background: var(--navy-light); color: var(--navy); padding: 2px 8px; border-radius: 20px; }

/* ===== ROMBEL GRID ===== */
.rombel-grid { display: grid; grid-template-columns: 1fr; gap: 8px; }

.rombel-card {
    background: white; border: 1.5px solid var(--gray-200);
    border-radius: 14px; overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    display: flex; flex-direction: column;
    transition: box-shadow 0.2s, transform 0.2s;
}
.rombel-card:hover { box-shadow: 0 6px 20px rgba(2,6,89,0.1); transform: translateY(-2px); }

.rombel-card-header {
    background: var(--navy-light); border-bottom: 1px solid #C7D2FE;
    padding: 10px 12px;
}
.rombel-name-link {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 800;
    color: var(--navy); text-decoration: none;
    display: flex; align-items: center; gap: 6px; margin-bottom: 6px;
}
.rombel-name-link:hover { color: var(--navy-mid); text-decoration: underline; }
.rombel-meta { display: flex; flex-wrap: wrap; gap: 8px; }
.rombel-meta-item { display: flex; align-items: center; gap: 4px; font-size: 10px; color: var(--gray-500); }
.rombel-meta-item svg { width: 11px; height: 11px; flex-shrink: 0; }

.rombel-card-body { padding: 8px 10px; flex: 1; }

.siswa-item {
    display: flex; align-items: center; gap: 7px;
    padding: 5px 6px; border-radius: 7px; transition: background 0.15s;
}
.siswa-item:hover { background: var(--gray-50); }
.siswa-initial {
    width: 25px; height: 25px; border-radius: 7px;
    background: var(--navy-light); color: var(--navy);
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; font-weight: 800;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.siswa-item-name { font-size: 11px; font-weight: 600; color: var(--gray-900); line-height: 1.2; }
.siswa-item-nisn { font-size: 9.5px; color: var(--gray-400); }

.lihat-semua {
    display: block; text-align: center; font-size: 10.5px; font-weight: 700;
    color: var(--navy); padding: 5px 10px; border-radius: 7px;
    text-decoration: none; background: var(--navy-light); margin-top: 5px;
    transition: background 0.15s;
}
.lihat-semua:hover { background: #D1D5FF; color: var(--navy); }

.rombel-empty { text-align: center; padding: 18px 10px; }
.rombel-empty-icon { font-size: 22px; margin-bottom: 5px; }
.rombel-empty-text { font-size: 11px; color: var(--gray-400); }

.rombel-card-footer {
    border-top: 1px solid var(--gray-100); padding: 7px 12px; background: var(--gray-50);
}
.footer-link {
    display: block; text-align: center; font-size: 11px; font-weight: 700;
    color: var(--navy); text-decoration: none; transition: color 0.15s;
}
.footer-link:hover { color: var(--navy-mid); text-decoration: underline; }

@keyframes slideUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
html { scroll-behavior: smooth; }
body { overscroll-behavior-y: none; }
a { -webkit-tap-highlight-color: transparent; }

/* ===== DESKTOP OVERRIDES ===== */
@media (min-width: 640px) {
    .stats-grid { grid-template-columns: repeat(4, 1fr); gap: 10px; }
    .rombel-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }

    .page-header { padding: 16px 16px 24px; border-radius: 0 0 28px 28px; }
    .header-icon { width: 30px; height: 30px; border-radius: 8px; font-size: 15px; }
    .header-title { font-size: 16px; }
    .header-subtitle { font-size: 11px; margin-bottom: 10px; padding-left: 40px; }
    .header-chip { font-size: 11px; padding: 4px 11px; margin-left: 40px; }

    .content-area { padding: 14px 14px 0; gap: 14px; }
    .section-label { font-size: 11px; }

    .notif { font-size: 13px; padding: 12px 14px; border-radius: 12px; }
    .notif svg { width: 17px; height: 17px; }
    .notif strong { font-size: 13px; }

    .stat-card { padding: 13px 14px; border-radius: 14px; gap: 11px; }
    .stat-icon { width: 38px; height: 38px; border-radius: 10px; font-size: 17px; }
    .stat-label { font-size: 10px; }
    .stat-value { font-size: 20px; }
    .sv-purple { font-size: 14px; }

    .form-card { border-radius: 16px; }
    .form-card-header { padding: 14px 16px; gap: 12px; }
    .form-header-icon { width: 36px; height: 36px; border-radius: 10px; font-size: 17px; }
    .form-header-title { font-size: 14px; }
    .form-header-sub   { font-size: 11px; }
    .form-body { padding: 16px; gap: 14px; }

    .petunjuk-box { padding: 12px 14px; font-size: 12px; gap: 10px; border-radius: 12px; }
    .petunjuk-box .pb-title { font-size: 12px; margin-bottom: 5px; }

    .form-label { font-size: 10px; margin-bottom: 6px; }
    .form-control { padding: 10px 12px; font-size: 13px; border-radius: 10px; }
    .form-control[multiple] { height: 210px; }
    .form-hint { font-size: 11px; gap: 5px; }

    .btn-submit { padding: 11px 22px; font-size: 13px; border-radius: 10px; gap: 8px; }

    .all-placed { padding: 28px 20px; border-radius: 14px; }
    .all-placed-icon { font-size: 36px; }
    .all-placed-title { font-size: 15px; }
    .all-placed-desc  { font-size: 12px; }

    .tingkat-header { padding: 10px 14px; border-radius: 12px; }
    .tingkat-label  { font-size: 13px; gap: 8px; }
    .tingkat-dot    { width: 8px; height: 8px; }
    .tingkat-count  { font-size: 11px; }

    .rombel-card { border-radius: 16px; }
    .rombel-card-header { padding: 12px 14px; }
    .rombel-name-link { font-size: 15px; gap: 7px; margin-bottom: 7px; }
    .rombel-meta-item { font-size: 11px; gap: 5px; }
    .rombel-meta-item svg { width: 12px; height: 12px; }
    .rombel-card-body { padding: 10px 12px; }

    .siswa-item { padding: 6px 7px; gap: 8px; border-radius: 8px; }
    .siswa-initial { width: 27px; height: 27px; border-radius: 8px; font-size: 12px; }
    .siswa-item-name { font-size: 12px; }
    .siswa-item-nisn { font-size: 10px; }

    .lihat-semua { font-size: 11px; padding: 6px 10px; border-radius: 8px; margin-top: 6px; }
    .rombel-empty { padding: 22px 10px; }
    .rombel-empty-icon { font-size: 26px; margin-bottom: 7px; }
    .rombel-empty-text { font-size: 12px; }
    .rombel-card-footer { padding: 9px 14px; }
    .footer-link { font-size: 12px; }
}

@media (min-width: 1024px) {
    .rombel-grid { grid-template-columns: repeat(3, 1fr); }
    .content-area { padding: 16px 20px 0; }
}
</style>

<div class="page-wrap">

    {{-- ===== HEADER ===== --}}
    <div class="page-header">
        <div class="header-top">
            <div class="header-icon">🏫</div>
            <div class="header-title">Penempatan Siswa ke Rombel</div>
        </div>
        <div class="header-subtitle">Kelola dan distribusikan siswa ke dalam rombongan belajar</div>
        <div class="header-chip">
            📆 TA: <strong>{{ $tahunAjaranAktif->tahun_ajaran }}</strong>
        </div>
    </div>

    <div class="content-area">

        {{-- ===== NOTIFIKASI ===== --}}
        @if(session('success'))
        <div class="notif success">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
        </div>
        @endif
        @if(session('error'))
        <div class="notif error">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div><strong>Terjadi Kesalahan!</strong> {{ session('error') }}</div>
        </div>
        @endif

        {{-- ===== STATISTIK ===== --}}
        <div class="section-label">📊 Ringkasan</div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon si-navy">🏫</div>
                <div>
                    <div class="stat-label">Total Rombel</div>
                    <div class="stat-value sv-navy">{{ $rombels->count() }}</div>
                </div>
            </div>
            <div class="stat-card" style="animation-delay:0.05s;">
                <div class="stat-icon si-green">✅</div>
                <div>
                    <div class="stat-label">Sudah Ditempatkan</div>
                    <div class="stat-value sv-green">{{ $rombels->sum('siswas_count') }}</div>
                </div>
            </div>
            <div class="stat-card" style="animation-delay:0.10s;">
                <div class="stat-icon si-yellow">⏳</div>
                <div>
                    <div class="stat-label">Belum Ditempatkan</div>
                    <div class="stat-value sv-yellow">{{ $siswasBelumDitempatkan->count() }}</div>
                </div>
            </div>
            <div class="stat-card" style="animation-delay:0.15s;">
                <div class="stat-icon si-purple">📆</div>
                <div>
                    <div class="stat-label">Tahun Ajaran</div>
                    <div class="stat-value sv-purple">{{ $tahunAjaranAktif->tahun_ajaran }}</div>
                </div>
            </div>
        </div>

        {{-- ===== FORM PENEMPATAN ===== --}}
        <div class="section-label">➕ Tempatkan Siswa</div>

        @if($siswasBelumDitempatkan->count())
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-header-icon">📋</div>
                <div>
                    <div class="form-header-title">Tempatkan Siswa ke Rombel</div>
                    <div class="form-header-sub">Pilih satu atau beberapa siswa lalu tentukan rombel tujuan</div>
                </div>
            </div>

            <div class="form-body">
                <div class="petunjuk-box">
                    <span style="font-size:16px; flex-shrink:0; margin-top:1px;">💡</span>
                    <div>
                        <div class="pb-title">Cara Penempatan Siswa:</div>
                        <ul>
                            <li>Pilih satu atau beberapa siswa dari daftar di bawah</li>
                            <li>Tekan <span class="kbd">Ctrl</span> untuk memilih beberapa siswa (tidak berurutan)</li>
                            <li>Tekan <span class="kbd">Shift</span> untuk memilih siswa secara berurutan</li>
                            <li>Pilih rombel tujuan, lalu klik <strong>Tempatkan Siswa</strong></li>
                        </ul>
                    </div>
                </div>

                <form action="{{ route('staff_tu.penempatan.tempatkan') }}" method="POST">
                    @csrf
                    <div style="margin-bottom:11px;">
                        <label class="form-label">
                            👥 Siswa Belum Ditempatkan
                            <span>({{ $siswasBelumDitempatkan->count() }} siswa)</span>
                        </label>
                        <select name="siswa_id[]" multiple required class="form-control">
                            @foreach($siswasBelumDitempatkan as $siswa)
                                <option value="{{ $siswa->id }}">
                                    {{ $siswa->nama_siswa }} — {{ $siswa->nisn }}
                                    ({{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }})
                                </option>
                            @endforeach
                        </select>
                        <div class="form-hint">
                            ℹ️ Tekan <span class="kbd">Ctrl</span> atau <span class="kbd">Shift</span> untuk pilih lebih dari satu siswa
                        </div>
                    </div>

                    <div style="margin-bottom:14px;">
                        <label class="form-label">🏫 Rombel Tujuan</label>
                        <div class="select-wrap">
                            <select name="rombel_id" required class="form-control">
                                <option value="">-- Pilih Rombel Tujuan --</option>
                                @foreach($rombels->groupBy('tingkat') as $tingkat => $rombelGroup)
                                    <optgroup label="Kelas {{ $tingkat }}">
                                        @foreach($rombelGroup as $rombel)
                                            <option value="{{ $rombel->id }}">
                                                {{ $rombel->nama_lengkap }} ({{ $rombel->siswas_count }} siswa)
                                                — {{ $rombel->walikelas ? $rombel->walikelas->nama : 'Belum ada wali kelas' }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:flex-end;">
                        <button type="submit" class="btn-submit">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            Tempatkan Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @else
        <div class="all-placed">
            <div class="all-placed-icon">🎉</div>
            <div class="all-placed-title">Semua Siswa Sudah Ditempatkan!</div>
            <div class="all-placed-desc">Tidak ada siswa yang perlu ditempatkan ke rombel saat ini.</div>
        </div>
        @endif

        {{-- ===== DAFTAR ROMBEL ===== --}}
        <div class="section-label">🏫 Daftar Rombel — {{ $tahunAjaranAktif->tahun_ajaran }}</div>

        @php $rombelsPerTingkat = $rombels->groupBy('tingkat'); @endphp

        @foreach($rombelsPerTingkat as $tingkat => $rombelsTingkat)
        <div class="tingkat-section">

            <div class="tingkat-header">
                <div class="tingkat-label">
                    <span class="tingkat-dot"></span>
                    📘 Kelas {{ $tingkat }}
                </div>
                <span class="tingkat-count">{{ $rombelsTingkat->count() }} Rombel</span>
            </div>

            <div class="rombel-grid">
                @foreach($rombelsTingkat as $rombel)
                <div class="rombel-card">

                    <div class="rombel-card-header">
                        <a href="{{ route('staff_tu.penempatan.show', $rombel->id) }}" class="rombel-name-link">
                            🏫 {{ $rombel->nama_lengkap }}
                        </a>
                        <div class="rombel-meta">
                            <div class="rombel-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $rombel->siswas_count }} siswa
                            </div>
                            <div class="rombel-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $rombel->walikelas ? $rombel->walikelas->nama : 'Belum ada wali kelas' }}
                            </div>
                        </div>
                    </div>

                    <div class="rombel-card-body">
                        @if($rombel->siswas->count())
                            @foreach($rombel->siswas->take(5) as $siswa)
                            <div class="siswa-item">
                                <div class="siswa-initial">{{ substr($siswa->nama_siswa, 0, 1) }}</div>
                                <div>
                                    <div class="siswa-item-name">{{ $siswa->nama_siswa }}</div>
                                    <div class="siswa-item-nisn">{{ $siswa->nisn }}</div>
                                </div>
                            </div>
                            @endforeach
                            @if($rombel->siswas->count() > 5)
                            <a href="{{ route('staff_tu.penempatan.show', $rombel->id) }}" class="lihat-semua">
                                +{{ $rombel->siswas->count() - 5 }} siswa lainnya →
                            </a>
                            @endif
                        @else
                            <div class="rombel-empty">
                                <div class="rombel-empty-icon">👤</div>
                                <div class="rombel-empty-text">Belum ada siswa di kelas ini</div>
                            </div>
                        @endif
                    </div>

                    <div class="rombel-card-footer">
                        <a href="{{ route('staff_tu.penempatan.show', $rombel->id) }}" class="footer-link">
                            Lihat Detail &amp; Kelola Siswa →
                        </a>
                    </div>

                </div>
                @endforeach
            </div>

        </div>
        @endforeach

    </div>
</div>

@endsection