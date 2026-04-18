@extends('layouts.guru')

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
    --green: #059669;
    --green-light: #ECFDF5;
    --blue: #2563EB;
    --blue-light: #EFF6FF;
    --yellow: #D97706;
    --yellow-light: #FFFBEB;
    --red: #DC2626;
    --red-light: #FEF2F2;
    --purple: #7C3AED;
    --purple-light: #F5F3FF;
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
    padding: 14px 16px 22px;
    border-radius: 0 0 28px 28px;
    position: sticky;
    top: 0;
    z-index: 20;
    box-shadow: 0 4px 24px rgba(2,6,89,0.25);
}
.back-link {
    display: inline-flex; align-items: center; gap: 6px;
    color: rgba(255,255,255,0.7); font-size: 12px; font-weight: 600;
    text-decoration: none; margin-bottom: 10px;
    transition: color 0.15s;
}
.back-link:hover { color: white; text-decoration: none; }
.back-link svg { width: 14px; height: 14px; }

.header-top { display: flex; align-items: center; gap: 10px; margin-bottom: 3px; }
.header-icon {
    width: 30px; height: 30px;
    background: rgba(255,255,255,0.15);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px; font-weight: 800; color: white;
}
.header-subtitle {
    color: rgba(255,255,255,0.65);
    font-size: 11px; padding-left: 40px;
}

/* ===== CONTENT ===== */
.content-area {
    padding: 14px 14px 0;
    display: flex; flex-direction: column; gap: 12px;
    animation: slideUp 0.4s ease both;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ===== STUDENT INFO CARD ===== */
.student-info-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: 16px;
    padding: 14px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    display: flex; align-items: center; gap: 14px;
}
.student-avatar-lg {
    width: 52px; height: 52px;
    background: var(--navy-light);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px; flex-shrink: 0;
}
.student-detail-label {
    font-size: 10px; font-weight: 600;
    color: var(--gray-400); text-transform: uppercase;
    letter-spacing: 0.3px; margin-bottom: 3px;
}
.student-detail-name {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 15px; font-weight: 800; color: var(--gray-900);
    margin-bottom: 2px;
}
.student-detail-nis {
    font-size: 11px; color: var(--gray-400);
}

/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}
@media (min-width: 480px) {
    .stats-grid { grid-template-columns: repeat(5, 1fr); }
}
.stat-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: 12px;
    padding: 10px 10px 8px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    text-align: center;
}
.stat-label {
    font-size: 10px; font-weight: 600;
    color: var(--gray-500); text-transform: uppercase;
    letter-spacing: 0.2px; margin-bottom: 5px;
}
.stat-value {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 22px; font-weight: 800;
}
.stat-green  { border-top: 3px solid var(--green); }
.stat-blue   { border-top: 3px solid var(--blue); }
.stat-yellow { border-top: 3px solid var(--yellow); }
.stat-red    { border-top: 3px solid var(--red); }
.stat-purple { border-top: 3px solid var(--purple); }
.stat-green  .stat-value { color: var(--green); }
.stat-blue   .stat-value { color: var(--blue); }
.stat-yellow .stat-value { color: var(--yellow); }
.stat-red    .stat-value { color: var(--red); }
.stat-purple .stat-value { color: var(--purple); }

/* ===== RIWAYAT HEADER ===== */
.riwayat-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 2px;
}
.riwayat-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 800; color: var(--gray-900);
    display: flex; align-items: center; gap: 6px;
}
.riwayat-count {
    font-size: 11px; font-weight: 700;
    background: var(--navy-light); color: var(--navy);
    padding: 2px 8px; border-radius: 20px;
}

/* ===== ABSENSI ENTRY CARD ===== */
.absen-list { display: flex; flex-direction: column; gap: 10px; }

.absen-card {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}

.absen-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 14px;
    border-bottom: 1px solid var(--gray-100);
    background: var(--gray-50);
}
.absen-date-main {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700; color: var(--gray-900);
    margin-bottom: 1px;
}
.absen-date-day {
    font-size: 11px; color: var(--gray-400);
}

/* Status pill warna per status */
.status-pill {
    font-size: 11px; font-weight: 700;
    padding: 3px 10px; border-radius: 20px;
}
.sp-H { background: var(--green-light);  color: var(--green); }
.sp-I { background: var(--blue-light);   color: var(--blue); }
.sp-S { background: var(--yellow-light); color: var(--yellow); }
.sp-A { background: var(--red-light);    color: var(--red); }
.sp-B { background: var(--purple-light); color: var(--purple); }

/* Form bagian dalam */
.absen-form-body { padding: 12px 14px; display: flex; flex-direction: column; gap: 10px; }

.form-label {
    display: block;
    font-size: 10px; font-weight: 700;
    color: var(--gray-500); text-transform: uppercase;
    letter-spacing: 0.3px; margin-bottom: 5px;
}
.form-control {
    width: 100%;
    padding: 9px 12px;
    font-size: 13px; font-family: 'Nunito', sans-serif;
    border: 1.5px solid var(--gray-200);
    border-radius: 10px; background: white;
    color: var(--gray-900); outline: none;
    appearance: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.form-control:focus {
    border-color: var(--navy);
    box-shadow: 0 0 0 3px rgba(2,6,89,0.1);
}
.select-wrap { position: relative; }
.select-wrap::after {
    content: '';
    position: absolute; right: 12px; top: 50%;
    transform: translateY(-50%);
    border: 5px solid transparent;
    border-top-color: var(--gray-500);
    pointer-events: none; margin-top: 3px;
}

.btn-save {
    display: flex; align-items: center; justify-content: center; gap: 7px;
    width: 100%; padding: 11px;
    background: var(--navy); color: white;
    border: none; border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700;
    cursor: pointer; transition: all 0.2s;
    box-shadow: 0 3px 10px rgba(2,6,89,0.25);
}
.btn-save:hover { background: var(--navy-mid); transform: translateY(-1px); }
.btn-save:active { transform: scale(0.97); }

/* ===== EMPTY STATE ===== */
.empty-state {
    background: white;
    border: 1.5px solid var(--gray-200);
    border-radius: 16px;
    padding: 36px 20px; text-align: center;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
.empty-icon {
    font-size: 40px; margin-bottom: 10px;
}
.empty-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 700;
    color: var(--gray-700); margin-bottom: 5px;
}
.empty-desc { font-size: 12px; color: var(--gray-500); }

/* ===== BACK BUTTON ===== */
.btn-back {
    display: flex; align-items: center; justify-content: center; gap: 7px;
    width: 100%; padding: 12px;
    background: white; color: var(--navy);
    border: 2px solid var(--navy);
    border-radius: 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 700;
    text-decoration: none; transition: all 0.2s;
}
.btn-back:hover { background: var(--navy-light); color: var(--navy); text-decoration: none; }
.btn-back svg { width: 14px; height: 14px; }

html { scroll-behavior: smooth; }
body { overscroll-behavior-y: none; }
a { -webkit-tap-highlight-color: transparent; }
</style>

<div class="page-wrap">

    {{-- ===== HEADER ===== --}}
    <div class="page-header">
        <a href="{{ url()->previous() }}" class="back-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
        <div class="header-top">
            <div class="header-icon">📋</div>
            <div class="header-title">Detail Absensi Siswa</div>
        </div>
        <div class="header-subtitle">
            Periode: {{ \Carbon\Carbon::parse($bulan)->translatedFormat('F Y') }}
        </div>
    </div>

    <div class="content-area">

        {{-- ===== INFO SISWA ===== --}}
        <div class="student-info-card">
            <div class="student-avatar-lg">👨‍🎓</div>
            <div>
                <div class="student-detail-label">Nama Siswa</div>
                <div class="student-detail-name">{{ $siswa->nama_siswa }}</div>
                <div class="student-detail-nis">{{ $siswa->nis ?? 'NIS: -' }}</div>
            </div>
        </div>

        {{-- ===== STATISTIK ===== --}}
        @php
            $stats  = [
                'H' => ['label' => 'Hadir',  'class' => 'stat-green'],
                'I' => ['label' => 'Izin',   'class' => 'stat-blue'],
                'S' => ['label' => 'Sakit',  'class' => 'stat-yellow'],
                'A' => ['label' => 'Alpha',  'class' => 'stat-red'],
                'B' => ['label' => 'Bolos',  'class' => 'stat-purple'],
            ];
            $counts = $absensis->countBy('status');
            $statusPillMap = ['H'=>'sp-H','I'=>'sp-I','S'=>'sp-S','A'=>'sp-A','B'=>'sp-B'];
            $statusLabel   = ['H'=>'Hadir','I'=>'Izin','S'=>'Sakit','A'=>'Alpha','B'=>'Bolos'];
        @endphp

        <div class="stats-grid">
            @foreach($stats as $key => $stat)
            <div class="stat-card {{ $stat['class'] }}">
                <div class="stat-label">{{ $stat['label'] }}</div>
                <div class="stat-value">{{ $counts[$key] ?? 0 }}</div>
            </div>
            @endforeach
        </div>

        {{-- ===== RIWAYAT HEADER ===== --}}
        <div class="riwayat-header">
            <div class="riwayat-title">
                <span style="width:8px;height:8px;background:var(--navy);border-radius:50%;display:inline-block;"></span>
                📅 Riwayat Absensi
            </div>
            <span class="riwayat-count">{{ $absensis->count() }} Hari</span>
        </div>

        {{-- ===== LIST ABSENSI ===== --}}
        <div class="absen-list">
            @forelse($absensis as $absen)
            <div class="absen-card">

                {{-- Header tanggal --}}
                <div class="absen-card-header">
                    <div>
                        <div class="absen-date-main">
                            {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}
                        </div>
                        <div class="absen-date-day">
                            {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('l') }}
                        </div>
                    </div>
                    <span class="status-pill {{ $statusPillMap[$absen->status] ?? '' }}">
                        {{ $statusLabel[$absen->status] ?? $absen->status }}
                    </span>
                </div>

                {{-- Form edit --}}
                <form method="POST" action="{{ route('guru.absen-siswa.update', $absen->id) }}" class="absen-form-body">
                    @csrf
                    @method('PUT')

                    {{-- Status --}}
                    <div>
                        <label class="form-label">Ubah Status</label>
                        <div class="select-wrap">
                            <select name="status" class="form-control">
                                @foreach(['H'=>'Hadir','I'=>'Izin','S'=>'Sakit','A'=>'Alpha','B'=>'Bolos'] as $k => $v)
                                    <option value="{{ $k }}" @selected($absen->status == $k)>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div>
                        <label class="form-label">Keterangan / Catatan</label>
                        <input type="text" name="keterangan"
                               value="{{ $absen->keterangan }}"
                               class="form-control"
                               placeholder="Tambahkan catatan (opsional)...">
                    </div>

                    {{-- Simpan --}}
                    <button type="submit" class="btn-save">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </form>

            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <div class="empty-title">Belum Ada Data Absensi</div>
                <div class="empty-desc">Tidak ada catatan absensi untuk periode ini.</div>
            </div>
            @endforelse
        </div>

        {{-- ===== TOMBOL KEMBALI ===== --}}
        <a href="{{ route('guru.absen-siswa.rekap') }}" class="btn-back">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Rekap
        </a>

    </div>
</div>

@endsection