@extends('layouts.bendahara')

@section('title', 'Tabungan Siswa')

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

body { font-family: 'IBM Plex Sans', sans-serif; background: var(--gray-bg); }

.page-wrapper {
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
    flex-wrap: wrap;
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

/* ── STAT CARDS ── */
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
.stat-val.amber { color: var(--amber); }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

/* ── TINGKAT GRID ── */
.tingkat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.25rem;
    margin-top: 0.5rem;
}
.tingkat-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    text-decoration: none;
    transition: all .2s ease;
    display: block;
}
.tingkat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,.1);
    border-color: var(--navy-lt);
}
.tingkat-card-body {
    padding: 1.5rem;
    text-align: center;
}
.tingkat-icon {
    width: 64px;
    height: 64px;
    background: var(--navy-lt);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}
.tingkat-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--navy-md);
    margin-bottom: 0.5rem;
}
.tingkat-desc {
    font-size: 13px;
    color: var(--muted);
    margin-bottom: 1rem;
}
.tingkat-badge {
    display: inline-block;
    padding: 4px 12px;
    background: var(--gray-bg);
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    color: var(--hint);
}
.tingkat-card-footer {
    padding: 0.75rem 1rem;
    background: var(--gray-bg);
    border-top: 1px solid var(--border);
    text-align: center;
}
.tingkat-card-footer span {
    font-size: 12px;
    font-weight: 600;
    color: var(--navy-md);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

/* ── INFO CARD ── */
.info-card {
    background: var(--navy-lt);
    border: 1px solid #bfdbfe;
    border-radius: var(--radius);
    padding: 1rem;
    margin-bottom: 1.75rem;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}
.info-icon {
    width: 36px;
    height: 36px;
    background: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.info-content p {
    margin: 0;
    font-size: 13px;
    color: var(--navy);
    line-height: 1.5;
}
.info-content strong {
    color: var(--navy-md);
}

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
}
.empty-icon {
    width: 64px;
    height: 64px;
    background: var(--gray-bg);
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}
.empty-state h3 {
    font-size: 16px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.5rem;
}
.empty-state p {
    font-size: 13px;
    color: var(--muted);
}

@media (max-width: 768px) {
    .page-wrapper {
        padding: 1rem;
    }
    .stats-row {
        grid-template-columns: repeat(2, 1fr);
    }
    .stat-val {
        font-size: 22px;
    }
    .tingkat-grid {
        grid-template-columns: 1fr;
    }
    .top-bar {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<div class="page-wrapper">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    <path d="M12 8h.01"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Tabungan Siswa</h1>
                <p>Kelola tabungan siswa per tingkat kelas &mdash; <strong>Pilih Tingkat</strong></p>
            </div>
        </div>
    </div>

    {{-- ═══ INFO CARD ═══ --}}
    <div class="info-card">
        <div class="info-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="info-content">
            <p><strong>Informasi:</strong> Pilih tingkat kelas di bawah untuk melihat dan mengelola tabungan siswa. Anda dapat melihat riwayat setoran, penarikan, dan saldo tabungan masing-masing siswa.</p>
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Tingkat Kelas</div>
            <div class="stat-val blue">{{ $totalTingkat }}</div>
            <div class="stat-sub">kelas tersedia</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Rombel</div>
            <div class="stat-val green">{{ $totalRombel }}</div>
            <div class="stat-sub">rombongan belajar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Siswa</div>
            <div class="stat-val green">{{ number_format($totalSiswa) }}</div>
            <div class="stat-sub">siswa terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Tabungan</div>
            <div class="stat-val amber">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</div>
            <div class="stat-sub">saldo keseluruhan</div>
        </div>
    </div>
    <div class="stats-row" style="margin-top: 1rem;">
        <div class="stat-card">
            <div class="stat-label">Total Laki-laki</div>
            <div class="stat-val blue">{{ number_format($totalMale) }}</div>
            <div class="stat-sub">siswa</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Perempuan</div>
            <div class="stat-val pink">{{ number_format($totalFemale) }}</div>
            <div class="stat-sub">siswi</div>
        </div>
    </div>

    {{-- ═══ TINGKAT GRID ═══ --}}
    @if($tingkats->count() > 0)
    <div class="tingkat-grid">
        @foreach($tingkats as $tingkat)
        @php
            $tingkatAngka = $tingkat;
            $tingkatRomawi = match($tingkatAngka) {
                7 => 'VII',
                8 => 'VIII',
                9 => 'IX',
                default => $tingkatAngka
            };
            $icon = match($tingkatAngka) {
                7 => '🎓',
                8 => '📚',
                9 => '🏆',
                default => '📖'
            };
            $colors = match($tingkatAngka) {
                7 => ['bg' => '#e0f2fe', 'color' => '#0369a1'],
                8 => ['bg' => '#dcfce7', 'color' => '#15803d'],
                9 => ['bg' => '#fef3c7', 'color' => '#b45309'],
                default => ['bg' => '#e0e7ff', 'color' => '#4338ca']
            };
        @endphp
        <a href="{{ route('bendahara.tabungan-siswa.rombel', $tingkat) }}" class="tingkat-card">
            <div class="tingkat-card-body">
                <div class="tingkat-icon" style="background: {{ $colors['bg'] }};">
                    <span style="font-size: 32px;">{{ $icon }}</span>
                </div>
                <div class="tingkat-title">Kelas {{ $tingkatRomawi }}</div>
                <div class="tingkat-desc">
                    Kelas {{ $tingkatRomawi }} - Tingkat {{ $tingkatAngka }}
                </div>
                <div class="tingkat-badge">
                    Lihat Tabungan →
                </div>
            </div>
            <div class="tingkat-card-footer">
                <span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 6v12m-6-6h12"/>
                    </svg>
                    Kelola Tabungan
                </span>
            </div>
        </a>
        @endforeach
    </div>
    @else
    {{-- ═══ EMPTY STATE ═══ --}}
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <h3>Belum Ada Data Tingkat Kelas</h3>
        <p>Tidak ada data tingkat kelas yang tersedia saat ini. Silakan tambahkan data rombel terlebih dahulu.</p>
    </div>
    @endif

</div>

@endsection