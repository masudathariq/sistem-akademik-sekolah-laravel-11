@extends('layouts.staff_tu')

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
    padding: 16px 16px 24px;
    border-radius: 0 0 28px 28px;
    position: sticky; top: 0; z-index: 20;
    box-shadow: 0 4px 24px rgba(2,6,89,0.25);
}
.header-top { display: flex; align-items: center; gap: 10px; margin-bottom: 3px; }
.header-icon {
    width: 30px; height: 30px; background: rgba(255,255,255,0.15);
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.header-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 16px; font-weight: 800; color: white; }
.header-subtitle { color: rgba(255,255,255,0.65); font-size: 11px; margin-bottom: 10px; padding-left: 40px; }
.header-chip {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,0.13); border: 1px solid rgba(255,255,255,0.2);
    border-radius: 20px; padding: 4px 11px;
    font-size: 11px; font-weight: 600; color: white; margin-left: 40px;
}

/* ===== CONTENT ===== */
.content-area {
    max-width: 700px; margin: 0 auto;
    padding: 14px 14px 0;
    display: flex; flex-direction: column; gap: 12px;
}

/* ===== SECTION LABEL ===== */
.section-label {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: var(--gray-400); padding: 0 2px;
}

/* ===== NOTIFIKASI ===== */
.notif {
    border-radius: 12px; padding: 12px 14px;
    display: flex; align-items: flex-start; gap: 10px;
    font-size: 13px; line-height: 1.5;
    animation: slideUp 0.3s ease both;
}
.notif.success { background: var(--success-light); border-left: 4px solid var(--success); color: #065F46; }
.notif.error   { background: var(--danger-light);  border-left: 4px solid var(--danger);  color: #7F1D1D; }
.notif svg { width: 17px; height: 17px; flex-shrink: 0; margin-top: 1px; }
.notif strong { display: block; font-weight: 700; margin-bottom: 1px; }

/* ===== TAHUN AKTIF CARD ===== */
.tahun-card {
    background: var(--navy-light);
    border: 1.5px solid #C7D2FE;
    border-radius: 14px; padding: 14px 16px;
    display: flex; align-items: center; gap: 13px;
    animation: slideUp 0.35s ease both;
}
.tahun-icon {
    width: 40px; height: 40px; background: var(--navy);
    border-radius: 11px; display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
}
.tahun-label {
    font-size: 10px; font-weight: 600; color: var(--navy-mid);
    text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 3px;
}
.tahun-value {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px; font-weight: 800; color: var(--navy);
}

/* ===== FORM CARD ===== */
.form-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: 16px; overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    animation: slideUp 0.4s ease both;
}
.form-card-header {
    background: var(--navy-light); border-bottom: 1px solid #C7D2FE;
    padding: 14px 16px; display: flex; align-items: center; gap: 12px;
}
.form-header-icon {
    width: 36px; height: 36px; background: var(--navy);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}
.form-header-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; font-weight: 800; color: var(--navy); margin-bottom: 2px; }
.form-header-sub   { font-size: 11px; color: var(--navy-mid); }
.form-body { padding: 16px; display: flex; flex-direction: column; gap: 14px; }

/* Form controls */
.form-label {
    display: block; font-size: 10px; font-weight: 700;
    color: var(--gray-500); text-transform: uppercase;
    letter-spacing: 0.4px; margin-bottom: 6px;
}
.form-control {
    width: 100%; padding: 10px 12px; font-size: 13px;
    font-family: 'Nunito', sans-serif;
    border: 1.5px solid var(--gray-200); border-radius: 10px;
    background: white; color: var(--gray-900); outline: none;
    transition: border-color 0.2s, box-shadow 0.2s; appearance: none;
}
.form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px rgba(2,6,89,0.1); }
.select-wrap { position: relative; }
.select-wrap::after {
    content: ''; position: absolute; right: 12px; top: 50%;
    transform: translateY(-50%);
    border: 5px solid transparent; border-top-color: var(--gray-400);
    pointer-events: none; margin-top: 3px;
}
.form-hint { font-size: 11px; color: var(--gray-400); margin-top: 5px; }

/* ===== WARNING BOX ===== */
.warning-box {
    background: var(--warning-light);
    border: 1.5px solid #FDE68A;
    border-left: 4px solid var(--warning);
    border-radius: 12px; padding: 13px 15px;
    font-size: 12px; color: #92400E; line-height: 1.6;
}
.warning-box-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 800; color: var(--warning);
    margin-bottom: 8px; display: flex; align-items: center; gap: 6px;
}
.warning-list {
    display: flex; flex-direction: column; gap: 5px;
    padding-left: 14px;
}
.warning-list li { list-style: disc; }

/* ===== SUBMIT BUTTON ===== */
.btn-submit {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 13px;
    background: var(--navy); color: white; border: none;
    border-radius: 12px;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; font-weight: 800;
    cursor: pointer; transition: all 0.2s;
    box-shadow: 0 4px 14px rgba(2,6,89,0.3);
}
.btn-submit:hover { background: var(--navy-mid); transform: translateY(-1px); }
.btn-submit:active { transform: scale(0.98); }

/* ===== ANIMATIONS ===== */
@keyframes slideUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
html { scroll-behavior: smooth; }
body { overscroll-behavior-y: none; }
</style>

<div class="page-wrap">

    {{-- ===== HEADER ===== --}}
    <div class="page-header">
        <div class="header-top">
            <div class="header-icon">🔁</div>
            <div class="header-title">Kenaikan Kelas</div>
        </div>
        <div class="header-subtitle">Proses kenaikan rombel siswa ke tahun ajaran berikutnya</div>
        <div class="header-chip">
            📆 Tahun Aktif: <strong>{{ $tahunAktif->tahun_ajaran }}</strong>
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

        {{-- ===== TAHUN AJARAN AKTIF ===== --}}
        <div class="section-label">📅 Tahun Ajaran Aktif</div>

        <div class="tahun-card">
            <div class="tahun-icon">📅</div>
            <div>
                <div class="tahun-label">Tahun Ajaran Saat Ini</div>
                <div class="tahun-value">{{ $tahunAktif->tahun_ajaran }}</div>
            </div>
        </div>

        {{-- ===== FORM PROSES ===== --}}
        <div class="section-label">⚙️ Proses Kenaikan</div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-header-icon">🔁</div>
                <div>
                    <div class="form-header-title">Proses Kenaikan Kelas</div>
                    <div class="form-header-sub">Pilih tahun ajaran tujuan lalu jalankan proses kenaikan</div>
                </div>
            </div>

            <div class="form-body">
                <form method="POST"
                      action="{{ route('staff_tu.kenaikan.proses') }}"
                      onsubmit="return confirm('⚠️ Proses ini akan menaikkan semua siswa ke tingkat berikutnya.\nPastikan data sudah benar.\n\nLanjutkan?')">
                    @csrf

                    {{-- Pilih Tahun Tujuan --}}
                    <div>
                        <label class="form-label">📆 Pilih Tahun Ajaran Tujuan</label>
                        <div class="select-wrap">
                            <select name="tahun_tujuan_id" class="form-control" required>
                                <option value="">-- Pilih Tahun Tujuan --</option>
                                @foreach($tahunTujuanList as $tahun)
                                    <option value="{{ $tahun->id }}">
                                        {{ $tahun->tahun_ajaran }} ({{ $tahun->semester }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-hint">
                            Pilih tahun ajaran yang akan menjadi tujuan kenaikan kelas.
                        </div>
                    </div>

                    {{-- Warning --}}
                    <div class="warning-box">
                        <div class="warning-box-title">⚠️ Perhatian Sebelum Melanjutkan</div>
                        <ul class="warning-list">
                            <li>Pastikan siswa kelas IX sudah lulus dan masuk ke dalam data Alumni</li>
                            <li>Pastikan data rombel tahun tujuan sudah tersedia</li>
                            <li>Proses ini <strong>tidak bisa dibatalkan</strong> secara otomatis</li>
                        </ul>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-submit">
                        🔁 Proses Kenaikan Kelas
                    </button>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection