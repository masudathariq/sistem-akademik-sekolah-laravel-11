@extends('layouts.staff_tu')

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
    --amber:    #d97706;
    --amber-lt: #fffbeb;
    --amber-bd: #fcd34d;
    --red:      #dc2626;
    --red-lt:   #fff1f2;
    --red-bd:   #fecdd3;
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
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.75rem;
}
.page-title { display: flex; align-items: center; gap: 12px; }
.title-icon {
    width: 44px; height: 44px;
    background: var(--navy-lt);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.title-text h1 {
    font-size: 20px; font-weight: 600;
    color: var(--text); margin: 0 0 3px;
    letter-spacing: -.02em;
}
.title-text p { font-size: 13px; color: var(--muted); margin: 0; }
.title-text p strong { color: var(--navy-md); font-weight: 600; }
.title-text p.warn-ta { color: #d97706; font-weight: 600; }

/* ── FLASH ── */
.flash-success {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--green-lt);
    border: 1px solid var(--green-bd);
    border-radius: 8px;
    font-size: 13px; font-weight: 600; color: var(--green);
    margin-bottom: 1.25rem;
}
.flash-error {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--red-lt);
    border: 1px solid var(--red-bd);
    border-radius: 8px;
    font-size: 13px; font-weight: 600; color: var(--red);
    margin-bottom: 1.25rem;
}

/* ── INFO BANNER ── */
.info-banner {
    display: flex; gap: 12px; align-items: flex-start;
    padding: .875rem 1rem;
    background: var(--amber-lt);
    border: 1px solid var(--amber-bd);
    border-radius: 10px; margin-bottom: 1.5rem;
}
.info-banner-body { font-size: 13px; color: #78350f; line-height: 1.7; }
.info-banner-body strong { font-weight: 600; color: #92400e; }
.info-banner-body ul { padding-left: 1.25rem; margin-top: .375rem; }
.info-banner-body li { list-style: disc; margin-bottom: 3px; }

/* ── STAT CARD (tahun aktif) ── */
.stat-card-single {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 1rem 1.125rem;
    box-shadow: var(--shadow);
    display: flex; align-items: center; gap: 14px;
    margin-bottom: 1.75rem;
}
.stat-icon {
    width: 44px; height: 44px;
    background: var(--navy-lt);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.stat-label {
    font-size: 11px; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
    font-weight: 600; margin-bottom: 4px;
}
.stat-val {
    font-size: 18px; font-weight: 600;
    color: var(--navy-md); letter-spacing: -.02em;
}

/* ── FORM CARD ── */
.form-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}
.form-card-header {
    display: flex; align-items: center; gap: 12px;
    padding: .75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.form-card-header .title-icon { width: 36px; height: 36px; border-radius: 8px; }
.form-card-title {
    font-size: 14px; font-weight: 600;
    color: var(--text); margin: 0 0 2px;
    letter-spacing: -.01em;
}
.form-card-sub { font-size: 12px; color: var(--muted); }

.form-body { padding: 1.25rem; display: flex; flex-direction: column; gap: 1.125rem; }

/* ── FORM CONTROLS ── */
.form-label {
    display: block;
    font-size: 11px; font-weight: 700;
    color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
    margin-bottom: 6px;
}
.form-control {
    width: 100%; padding: .575rem .875rem;
    font-size: 13px; font-family: 'IBM Plex Sans', sans-serif;
    border: 1px solid var(--border); border-radius: 8px;
    background: #fff; color: var(--text); outline: none;
    transition: border-color .15s, box-shadow .15s;
    appearance: none;
}
.form-control:focus {
    border-color: var(--navy-md);
    box-shadow: 0 0 0 3px rgba(29,78,216,.1);
}
.select-wrap { position: relative; }
.select-wrap::after {
    content: ''; position: absolute; right: 12px; top: 50%;
    transform: translateY(-50%);
    border: 5px solid transparent; border-top-color: var(--hint);
    pointer-events: none; margin-top: 3px;
}
.form-hint { font-size: 11px; color: var(--hint); margin-top: 5px; }

/* ── SUBMIT BUTTON ── */
.btn-submit {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: .65rem 1.25rem;
    background: var(--navy); color: #fff;
    border: none; border-radius: 8px;
    font-size: 13px; font-weight: 600;
    font-family: 'IBM Plex Sans', sans-serif;
    cursor: pointer; transition: background .15s, transform .12s;
}
.btn-submit:hover { background: var(--navy-md); }
.btn-submit:active { transform: scale(.97); }
</style>

<div class="rb-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="17 1 21 5 17 9"/>
                    <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                    <polyline points="7 23 3 19 7 15"/>
                    <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Kenaikan Kelas</h1>
                @if($tahunAktif)
                    <p>Tahun Ajaran Aktif: <strong>{{ $tahunAktif->tahun_ajaran }}</strong></p>
                @else
                    <p class="warn-ta">⚠ Belum ada tahun ajaran aktif</p>
                @endif
            </div>
        </div>
    </div>

    {{-- ═══ FLASH ═══ --}}
    @if(session('success'))
    <div class="flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="flash-error">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- ═══ TAHUN AJARAN AKTIF ═══ --}}
    <div class="stat-card-single">
        <div class="stat-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
        <div>
            <div class="stat-label">Tahun Ajaran Saat Ini</div>
            <div class="stat-val">{{ $tahunAktif?->tahun_ajaran ?? 'Belum ada tahun aktif' }}</div>
        </div>
    </div>

    {{-- ═══ INFO BANNER ═══ --}}
    <div class="info-banner">
        <div style="flex-shrink:0;margin-top:1px;">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="info-banner-body">
            <strong>Perhatian Sebelum Melanjutkan &mdash;</strong>
            Pastikan semua kondisi berikut terpenuhi sebelum menjalankan proses kenaikan kelas:
            <ul>
                <li>Pastikan siswa kelas IX sudah lulus dan masuk ke dalam data Alumni</li>
                <li>Pastikan data rombel tahun tujuan sudah tersedia</li>
                <li>Proses ini <strong>tidak bisa dibatalkan</strong> secara otomatis</li>
            </ul>
        </div>
    </div>

    {{-- ═══ FORM CARD ═══ --}}
    <div class="form-card">
        <div class="form-card-header">
            <div class="title-icon" style="width:36px;height:36px;border-radius:8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="17 1 21 5 17 9"/>
                    <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                    <polyline points="7 23 3 19 7 15"/>
                    <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
                </svg>
            </div>
            <div>
                <div class="form-card-title">Proses Kenaikan Kelas</div>
                <div class="form-card-sub">Pilih tahun ajaran tujuan lalu jalankan proses kenaikan</div>
            </div>
        </div>

        <div class="form-body">
            <form method="POST"
                  action="{{ route('staff_tu.kenaikan.proses') }}"
                  onsubmit="return confirm('Proses ini akan menaikkan semua siswa ke tingkat berikutnya.\nPastikan data sudah benar.\n\nLanjutkan?')">
                @csrf

                {{-- Pilih Tahun Tujuan --}}
                <div>
                    <label class="form-label">Pilih Tahun Ajaran Tujuan</label>
                    <div class="select-wrap">
                        <select name="tahun_tujuan_id" class="form-control" required>
                            <option value="">-- Pilih Tahun Tujuan --</option>
                            @foreach($tahunTujuanList as $tahun)
                                <option value="{{ $tahun->id }}">
                                    {{ $tahunAktif?->tahun_ajaran ?? 'Belum ada tahun aktif' }} ({{ $tahun->semester }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-hint">Pilih tahun ajaran yang akan menjadi tujuan kenaikan kelas.</div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="17 1 21 5 17 9"/>
                        <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                        <polyline points="7 23 3 19 7 15"/>
                        <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
                    </svg>
                    Proses Kenaikan Kelas
                </button>

            </form>
        </div>
    </div>

</div>

@endsection