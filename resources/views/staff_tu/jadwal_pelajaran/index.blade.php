@extends('layouts.staff_tu')

@section('title', 'Jadwal Mengajar')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&display=swap');

*{box-sizing:border-box;}

:root {
    --navy:     #1e3a8a;
    --navy-md:  #1d4ed8;
    --navy-lt:  #dbeafe;
    --green:    #16a34a;
    --green-lt: #f0fdf4;
    --green-bd: #86efac;
    --red:      #dc2626;
    --red-lt:   #fff1f2;
    --red-bd:   #fecdd3;
    --pink:     #be185d;
    --pink-lt:  #fdf2f8;
    --pink-bd:  #f9a8d4;
    --amber:    #d97706;
    --amber-lt: #fffbeb;
    --amber-bd: #fcd34d;
    --gray-bg:  #f8fafc;
    --border:   #e2e8f0;
    --text:     #1e293b;
    --muted:    #64748b;
    --hint:     #94a3b8;
    --radius:   12px;
    --shadow:   0 1px 3px rgba(0,0,0,.06), 0 4px 12px rgba(0,0,0,.04);
}

body { font-family: 'IBM Plex Sans', sans-serif; }

.rb-page {
    background: var(--gray-bg);
    min-height: 100vh;
    padding: 2rem;
    padding-bottom: 4rem;
    color: var(--text);
}

/* ── TOP BAR ── */
.top-bar {
    display: flex; align-items: center;
    justify-content: space-between; gap: 1rem;
    margin-bottom: 1.75rem;
}
.page-title { display: flex; align-items: center; gap: 12px; }
.title-icon {
    width: 44px; height: 44px; background: var(--navy-lt);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.title-text h1 {
    font-size: 20px; font-weight: 600; color: var(--text);
    margin: 0 0 3px; letter-spacing: -.02em;
}
.title-text p { font-size: 13px; color: var(--muted); margin: 0; }
.title-text p strong { color: var(--navy-md); font-weight: 600; }

/* ── FLASH / INFO CARD STYLE ── */
.info-card {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 1rem 1.25rem;
    background: var(--amber-lt); border: 1px solid var(--amber-bd);
    border-radius: var(--radius); margin-bottom: 1.75rem;
}
.info-icon {
    width: 36px; height: 36px; background: #fffbeb;
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.info-content h4 {
    font-size: 13px; font-weight: 600; color: var(--amber);
    margin: 0 0 4px;
}
.info-content p {
    font-size: 13px; color: var(--muted); margin: 0;
    line-height: 1.5;
}

/* ── STAT CARD (untuk total hari) ── */
.stats-row {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 12px; margin-bottom: 1.75rem;
}
.stat-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 10px; padding: 1rem 1.125rem;
    box-shadow: var(--shadow);
}
.stat-label {
    font-size: 11px; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
    font-weight: 600; margin-bottom: 6px;
}
.stat-val { font-size: 26px; font-weight: 600; letter-spacing: -.03em; }
.stat-val.blue  { color: var(--navy-md); }
.stat-val.green { color: #15803d; }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

/* ── GRID CARD (untuk hari) ── */
.day-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 2rem;
}
.day-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.25rem;
    text-decoration: none;
    transition: all .2s ease;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.day-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,.08);
    border-color: var(--navy-lt);
}
.day-icon {
    width: 56px; height: 56px;
    background: var(--gray-bg);
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 28px;
    margin-bottom: 12px;
}
.day-name {
    font-size: 16px; font-weight: 700; color: var(--text);
    margin-bottom: 4px;
}
.day-label {
    font-size: 11px; color: var(--hint);
    margin-bottom: 12px;
}
.day-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px; border-radius: 20px;
    font-size: 11px; font-weight: 600;
    background: var(--navy-lt); color: var(--navy-md);
    transition: all .15s;
}
.day-card:hover .day-btn {
    background: var(--navy-md); color: white;
}
.day-number {
    position: absolute; top: 10px; left: 12px;
    font-size: 10px; font-weight: 700;
    background: var(--gray-bg); color: var(--muted);
    padding: 2px 8px; border-radius: 20px;
}

/* ── LEGEND CARD ── */
.legend-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow);
    padding: 1.25rem;
}
.legend-title {
    display: flex; align-items: center; gap: 8px;
    font-size: 12px; font-weight: 600; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
    margin-bottom: 1rem;
}
.legend-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 12px;
}
.legend-item {
    display: flex; align-items: center; gap: 10px;
    font-size: 13px; color: var(--text);
}
.legend-badge {
    width: 32px; height: 32px;
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    font-size: 14px;
}
.badge-blue { background: var(--navy-lt); color: var(--navy-md); }
.badge-green { background: var(--green-lt); color: var(--green); }
.badge-purple { background: #f3e8ff; color: #9333ea; }
.badge-amber { background: var(--amber-lt); color: var(--amber); }

</style>

<div class="rb-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                    <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01M16 18h.01"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Jadwal Mengajar</h1>
                <p>Pilih hari untuk melihat daftar jadwal mengajar guru &mdash; <strong>{{ count($haris) }} Hari Tersedia</strong></p>
            </div>
        </div>
        <div>
            <a href="{{ route('staff_tu.jadwal_pelajaran.jadwalLengkap') }}" 
               style="display: inline-flex; align-items: center; gap: 6px; background: var(--navy-md); color: white; padding: 8px 16px; border-radius: 8px; font-size: 12px; font-weight: 600; text-decoration: none;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
                Jadwal Lengkap
            </a>
        </div>
    </div>

    {{-- ═══ INFO CARD ═══ --}}
    <div class="info-card">
        <div class="info-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="info-content">
            <h4>Cara Menggunakan Fitur Ini</h4>
            <p>Klik salah satu kartu hari di bawah untuk melihat jadwal lengkap mengajar guru pada hari tersebut, termasuk jam pelajaran, nama guru, mata pelajaran, dan kelas yang diajar.</p>
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Hari</div>
            <div class="stat-val blue">{{ count($haris) }}</div>
            <div class="stat-sub">hari aktif belajar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Senin - Sabtu</div>
            <div class="stat-val blue">6</div>
            <div class="stat-sub">hari kerja</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Minggu</div>
            <div class="stat-val blue">1</div>
            <div class="stat-sub">akhir pekan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Jadwal Tersedia</div>
            <div class="stat-val green">Lengkap</div>
            <div class="stat-sub">semua hari</div>
        </div>
    </div>

    {{-- ═══ DAY CARDS GRID ═══ --}}
    <div class="day-grid">
        @php
        $dayConfig = [
            'senin'   => ['icon' => '🌅', 'label' => 'Hari pertama dalam sepekan'],
            'selasa'  => ['icon' => '☀️', 'label' => 'Hari kedua dalam sepekan'],
            'rabu'    => ['icon' => '🌤️', 'label' => 'Tengah pekan'],
            'kamis'   => ['icon' => '🌥️', 'label' => 'Menuju akhir pekan'],
            'jumat'   => ['icon' => '✨', 'label' => 'Hari jumat berkah'],
            'sabtu'   => ['icon' => '🌙', 'label' => 'Akhir pekan pertama'],
            'minggu'  => ['icon' => '🎯', 'label' => 'Akhir pekan'],
        ];
        @endphp

        @foreach($haris as $index => $hari)
        @php
            $key = strtolower($hari);
            $config = $dayConfig[$key] ?? ['icon' => '📅', 'label' => 'Lihat jadwal hari ini'];
        @endphp

        <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}" class="day-card">
            <span class="day-number">H{{ $index + 1 }}</span>
            <div class="day-icon">{{ $config['icon'] }}</div>
            <div class="day-name">{{ ucfirst($hari) }}</div>
            <div class="day-label">{{ $config['label'] }}</div>
            <span class="day-btn">
                Lihat Jadwal
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </span>
        </a>
        @endforeach
    </div>

    {{-- ═══ LEGEND CARD ═══ --}}
    <div class="legend-card">
        <div class="legend-title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Informasi yang Tersedia di Setiap Jadwal Harian
        </div>
        <div class="legend-grid">
            <div class="legend-item">
                <span class="legend-badge badge-blue">👨‍🏫</span>
                <span>Nama Guru</span>
            </div>
            <div class="legend-item">
                <span class="legend-badge badge-green">📚</span>
                <span>Mata Pelajaran</span>
            </div>
            <div class="legend-item">
                <span class="legend-badge badge-purple">🏫</span>
                <span>Kelas / Rombel</span>
            </div>
            <div class="legend-item">
                <span class="legend-badge badge-amber">⏰</span>
                <span>Jam Pelajaran</span>
            </div>
        </div>
    </div>

</div>

@endsection