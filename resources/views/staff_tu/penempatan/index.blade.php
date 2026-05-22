@extends('layouts.staff_tu')

@section('title', 'Penempatan Siswa')

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
    --purple:   #7e22ce;
    --purple-lt:#fdf4ff;
    --purple-bd:#e9d5ff;
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
.title-text p.warn-ta { color: #d97706; font-weight: 600; }

/* ── FLASH ── */
.flash-success {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--green-lt); border: 1px solid var(--green-bd);
    border-radius: 8px; font-size: 13px; font-weight: 600; color: var(--green);
    margin-bottom: 1.25rem;
}
.flash-error {
    display: flex; align-items: center; gap: 8px;
    padding: .75rem 1rem;
    background: var(--red-lt); border: 1px solid var(--red-bd);
    border-radius: 8px; font-size: 13px; font-weight: 600; color: var(--red);
    margin-bottom: 1.25rem;
}

/* ── INFO BANNER ── */
.info-banner {
    display: flex; gap: 12px; align-items: flex-start;
    padding: .875rem 1rem;
    background: var(--navy-lt); border: 1px solid #bfdbfe;
    border-radius: 10px; margin-bottom: 1.5rem;
}
.info-banner-body { font-size: 13px; color: #1e40af; line-height: 1.7; }
.info-banner-body strong { font-weight: 600; }
.info-banner-body ul { padding-left: 1.25rem; margin-top: .375rem; }
.info-banner-body li { list-style: disc; margin-bottom: 2px; }
.kbd {
    display: inline-flex; align-items: center;
    background: #fff; border: 1px solid #bfdbfe;
    border-radius: 4px; padding: 0 5px;
    font-size: 11px; font-weight: 600; color: var(--navy-md);
    font-family: 'Courier New', monospace;
}

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
.stat-val.blue   { color: var(--navy-md); }
.stat-val.green  { color: #15803d; }
.stat-val.amber  { color: var(--amber); }
.stat-val.purple { color: var(--purple); font-size: 15px; line-height: 1.6; }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

/* ── FORM CARD ── */
.form-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow);
    overflow: hidden; margin-bottom: 1.75rem;
}
.form-card-header {
    display: flex; align-items: center; gap: 12px;
    padding: .75rem 1.25rem; border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.form-card-title {
    font-size: 14px; font-weight: 600; color: var(--text);
    margin: 0 0 2px; letter-spacing: -.01em;
}
.form-card-sub { font-size: 12px; color: var(--muted); }
.form-body { padding: 1.25rem; display: flex; flex-direction: column; gap: 1.125rem; }

.form-label {
    display: block; font-size: 11px; font-weight: 700;
    color: var(--muted); text-transform: uppercase;
    letter-spacing: .05em; margin-bottom: 6px;
}
.form-label span { font-weight: 400; color: var(--hint); text-transform: none; margin-left: 4px; }
.form-control {
    width: 100%; padding: .575rem .875rem; font-size: 13px;
    font-family: 'IBM Plex Sans', sans-serif;
    border: 1px solid var(--border); border-radius: 8px;
    background: #fff; color: var(--text); outline: none;
    transition: border-color .15s, box-shadow .15s; appearance: none;
}
.form-control:focus { border-color: var(--navy-md); box-shadow: 0 0 0 3px rgba(29,78,216,.1); }
.form-control[multiple] { height: 200px; padding: .5rem; }
.select-wrap { position: relative; }
.select-wrap::after {
    content: ''; position: absolute; right: 12px; top: 50%;
    transform: translateY(-50%);
    border: 5px solid transparent; border-top-color: var(--hint);
    pointer-events: none; margin-top: 3px;
}
.form-hint { font-size: 11px; color: var(--hint); margin-top: 5px; display: flex; align-items: center; gap: 5px; }

.btn-submit {
    display: inline-flex; align-items: center; justify-content: center; gap: 7px;
    padding: .575rem 1.25rem;
    background: var(--navy); color: #fff; border: none; border-radius: 8px;
    font-size: 13px; font-weight: 600; font-family: 'IBM Plex Sans', sans-serif;
    cursor: pointer; transition: background .15s, transform .12s;
}
.btn-submit:hover { background: var(--navy-md); }
.btn-submit:active { transform: scale(.97); }

/* ── ALL PLACED ── */
.all-placed {
    background: var(--green-lt); border: 1px solid var(--green-bd);
    border-radius: var(--radius); padding: 2.25rem 1.5rem;
    text-align: center; margin-bottom: 1.75rem;
    box-shadow: var(--shadow);
}
.all-placed-icon {
    width: 52px; height: 52px; background: #dcfce7;
    border-radius: 14px; display: inline-flex;
    align-items: center; justify-content: center; margin-bottom: .875rem;
}
.all-placed strong { display: block; font-size: 15px; font-weight: 600; color: #15803d; margin-bottom: 4px; }
.all-placed p { font-size: 13px; color: var(--green); }

/* ── TINGKAT SECTION ── */
.tingkat-section { margin-bottom: 1.75rem; }
.tingkat-header {
    display: flex; align-items: center; justify-content: space-between;
    gap: .75rem; margin-bottom: .875rem;
}
.tingkat-title-wrap { display: flex; align-items: center; gap: 10px; }
.tingkat-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
.tingkat-title { font-size: 15px; font-weight: 600; color: var(--text); letter-spacing: -.01em; }
.tingkat-badge {
    font-size: 12px; font-weight: 600; padding: 3px 11px;
    border-radius: 99px; border: 1px solid; white-space: nowrap;
}

.t7 .tingkat-dot  { background: #3b82f6; }
.t7 .tingkat-badge { background: #eff6ff; border-color: #bfdbfe; color: #1d4ed8; }
.t8 .tingkat-dot  { background: #22c55e; }
.t8 .tingkat-badge { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; }
.t9 .tingkat-dot  { background: #a855f7; }
.t9 .tingkat-badge { background: #fdf4ff; border-color: #e9d5ff; color: #7e22ce; }

/* ── ROMBEL GRID ── */
.rombel-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
}

/* ── ROMBEL CARD ── */
.rombel-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow);
    overflow: hidden; display: flex; flex-direction: column;
    transition: box-shadow .2s, transform .2s;
}
.rombel-card:hover { box-shadow: 0 6px 20px rgba(30,58,138,.1); transform: translateY(-2px); }

.rombel-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: .75rem 1rem; border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.rombel-name-link {
    font-size: 14px; font-weight: 600; color: var(--text);
    text-decoration: none; letter-spacing: -.01em;
    transition: color .15s;
}
.rombel-name-link:hover { color: var(--navy-md); }

.rombel-meta { display: flex; flex-direction: column; gap: 3px; margin-top: 4px; }
.rombel-meta-item {
    display: flex; align-items: center; gap: 5px;
    font-size: 12px; color: var(--muted);
}

.rombel-count-badge {
    font-size: 12px; font-weight: 600; color: var(--hint);
    background: var(--gray-bg); border: 1px solid var(--border);
    border-radius: 99px; padding: 2px 9px; white-space: nowrap; flex-shrink: 0;
}

.rombel-card-body { padding: .875rem 1rem; flex: 1; }

/* ── SISWA ITEM ── */
.siswa-item {
    display: flex; align-items: center; gap: 8px;
    padding: .4rem .5rem; border-radius: 7px; transition: background .12s;
}
.siswa-item:hover { background: var(--gray-bg); }
.siswa-initial {
    width: 28px; height: 28px; border-radius: 7px;
    background: var(--navy-lt); color: var(--navy-md);
    font-size: 12px; font-weight: 600;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.siswa-item-name { font-size: 13px; font-weight: 500; color: var(--text); }
.siswa-item-nisn { font-size: 11px; color: var(--hint); font-family: 'Courier New', monospace; }

.lihat-semua {
    display: block; text-align: center; font-size: 12px; font-weight: 600;
    color: var(--navy-md); padding: .4rem .75rem; border-radius: 7px;
    text-decoration: none; background: var(--navy-lt); margin-top: .5rem;
    transition: background .15s;
}
.lihat-semua:hover { background: #bfdbfe; }

.rombel-empty { text-align: center; padding: 1.5rem 1rem; }
.rombel-empty strong { display: block; font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 3px; }
.rombel-empty p { font-size: 12px; color: var(--muted); }

.rombel-card-footer {
    border-top: 1px solid var(--border); padding: .625rem 1rem;
    background: #fdfdfd;
}
.footer-link {
    display: block; text-align: center;
    font-size: 12.5px; font-weight: 600; color: var(--navy-md);
    text-decoration: none; transition: color .15s;
}
.footer-link:hover { color: var(--navy); text-decoration: underline; }
</style>

<div class="rb-page">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Penempatan Siswa</h1>
                @if($tahunAjaranAktif)
                    <p>Tahun Ajaran Aktif: <strong>{{ $tahunAjaranAktif->tahun_ajaran }}</strong></p>
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

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Rombel</div>
            <div class="stat-val blue">{{ $rombels->count() }}</div>
            <div class="stat-sub">rombongan belajar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Sudah Ditempatkan</div>
            <div class="stat-val green">{{ $rombels->sum('siswas_count') }}</div>
            <div class="stat-sub">siswa aktif di rombel</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Belum Ditempatkan</div>
            <div class="stat-val amber">{{ $siswasBelumDitempatkan->count() }}</div>
            <div class="stat-sub">perlu ditempatkan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Tahun Ajaran</div>
            <div class="stat-val purple">{{ $tahunAjaranAktif?->tahun_ajaran ?? 'Belum Aktif' }}</div>
            <div class="stat-sub">sedang berjalan</div>
        </div>
    </div>

    {{-- ═══ INFO BANNER ═══ --}}
    <div class="info-banner">
        <div style="flex-shrink:0;margin-top:1px;">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div class="info-banner-body">
            <strong>Cara Penempatan Siswa:</strong>
            <ul>
                <li>Pilih satu atau beberapa siswa dari daftar di bawah</li>
                <li>Tekan <span class="kbd">Ctrl</span> untuk memilih beberapa siswa (tidak berurutan)</li>
                <li>Tekan <span class="kbd">Shift</span> untuk memilih siswa secara berurutan</li>
                <li>Pilih rombel tujuan, lalu klik <strong>Tempatkan Siswa</strong></li>
            </ul>
        </div>
    </div>

    {{-- ═══ FORM PENEMPATAN ═══ --}}
    @if($siswasBelumDitempatkan->count())
    <div class="form-card">
        <div class="form-card-header">
            <div class="title-icon" style="width:36px;height:36px;border-radius:8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
                </svg>
            </div>
            <div>
                <div class="form-card-title">Tempatkan Siswa ke Rombel</div>
                <div class="form-card-sub">Pilih satu atau beberapa siswa lalu tentukan rombel tujuan</div>
            </div>
        </div>

        <div class="form-body">
            <form action="{{ route('staff_tu.penempatan.tempatkan') }}" method="POST">
                @csrf

                <div>
                    <label class="form-label">
                        Siswa Belum Ditempatkan
                        <span>({{ $siswasBelumDitempatkan->count() }} siswa)</span>
                    </label>
                    <select name="siswa_id[]" multiple required class="form-control">
                        @foreach($siswasBelumDitempatkan as $siswa)
                            <option value="{{ $siswa?->id }}">
                                {{ $siswa->nama_siswa }} — {{ $siswa->nisn }}
                                ({{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }})
                            </option>
                        @endforeach
                    </select>
                    <div class="form-hint">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Tekan <span class="kbd">Ctrl</span> atau <span class="kbd">Shift</span> untuk memilih lebih dari satu siswa
                    </div>
                </div>

                <div>
                    <label class="form-label">Rombel Tujuan</label>
                    <div class="select-wrap">
                        <select name="rombel_id" required class="form-control">
                            <option value="">-- Pilih Rombel Tujuan --</option>
                            @foreach($rombels->groupBy('tingkat') as $tingkat => $rombelGroup)
                                <optgroup label="Kelas {{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}">
                                    @foreach($rombelGroup as $rombel)
                                        <option value="{{ $rombel?->id }}">
                                            {{ $rombel->nama_lengkap }} ({{ $rombel->siswas_count }} siswa)
                                            — {{ $rombel->walikelas ? $rombel->walikelas->nama : 'Belum ada wali kelas' }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;">
                    <button type="submit" class="btn-submit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                        Tempatkan Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>

    @else
    <div class="all-placed" style="margin-bottom:1.75rem;">
        <div class="all-placed-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2" stroke-linecap="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <strong>Semua Siswa Sudah Ditempatkan!</strong>
        <p>Tidak ada siswa yang perlu ditempatkan ke rombel saat ini.</p>
    </div>
    @endif

    {{-- ═══ LOOP PER TINGKAT ═══ --}}
    @php $rombelsPerTingkat = $rombels->groupBy('tingkat'); @endphp

    @foreach($rombelsPerTingkat as $tingkat => $rombelsTingkat)
    @php $tClass = 't' . $tingkat; @endphp

    <div class="tingkat-section {{ $tClass }}">
        <div class="tingkat-header">
            <div class="tingkat-title-wrap">
                <span class="tingkat-dot"></span>
                <span class="tingkat-title">Kelas {{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}</span>
            </div>
            <span class="tingkat-badge">{{ $rombelsTingkat->count() }} Rombel</span>
        </div>

        <div class="rombel-grid">
            @foreach($rombelsTingkat as $rombel)
            <div class="rombel-card">

                <div class="rombel-card-header">
                    <div>
                        <a href="{{ route('staff_tu.penempatan.show', $rombel?->id) }}" class="rombel-name-link">
                            {{ $rombel->nama_lengkap }}
                        </a>
                        <div class="rombel-meta">
                            <div class="rombel-meta-item">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                {{ $rombel->walikelas ? $rombel->walikelas->nama : 'Belum ada wali kelas' }}
                            </div>
                        </div>
                    </div>
                    <span class="rombel-count-badge">{{ $rombel->siswas_count }} siswa</span>
                </div>

                <div class="rombel-card-body">
                    @if($rombel->siswas->count())
                        @foreach($rombel->siswas->take(5) as $siswa)
                        <div class="siswa-item">
                            <div class="siswa-initial">{{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}</div>
                            <div>
                                <div class="siswa-item-name">{{ $siswa->nama_siswa }}</div>
                                <div class="siswa-item-nisn">{{ $siswa->nisn }}</div>
                            </div>
                        </div>
                        @endforeach
                        @if($rombel->siswas->count() > 5)
                        <a href="{{ route('staff_tu.penempatan.show', $rombel?->id) }}" class="lihat-semua">
                            +{{ $rombel->siswas->count() - 5 }} siswa lainnya &rarr;
                        </a>
                        @endif
                    @else
                        <div class="rombel-empty">
                            <div class="empty-icon" style="margin:0 auto .625rem;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                </svg>
                            </div>
                            <strong>Belum ada siswa</strong>
                            <p>Belum ada siswa di kelas ini</p>
                        </div>
                    @endif
                </div>

                <div class="rombel-card-footer">
                    <a href="{{ route('staff_tu.penempatan.show', $rombel?->id) }}" class="footer-link">
                        Lihat Detail &amp; Kelola Siswa &rarr;
                    </a>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    @endforeach

</div>

@endsection