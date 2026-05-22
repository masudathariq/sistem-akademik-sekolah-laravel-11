@extends('layouts.bendahara')

@section('title', 'Tabungan ' . $siswa->nama_siswa)

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

/* ── BUTTON BACK ── */
.btn-back {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 8px 18px;
    background: #fff;
    color: var(--muted);
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .15s;
}
.btn-back:hover {
    background: var(--gray-bg);
    color: var(--text);
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
.stat-val.blue  { color: var(--navy-md); }
.stat-val.green { color: #15803d; }
.stat-val.red   { color: var(--red); }
.stat-val.amber { color: var(--amber); }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

/* ── INFO CARD ── */
.info-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.info-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
    display: flex;
    align-items: center;
    gap: 12px;
}
.info-header-icon {
    width: 36px; height: 36px;
    background: var(--navy-lt);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
}
.info-header h3 {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
    margin: 0;
}
.info-body {
    padding: 1.5rem;
}
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}
.info-item {
    padding: 0.75rem;
    background: var(--gray-bg);
    border-radius: 10px;
}
.info-item .label {
    font-size: 10px;
    font-weight: 600;
    color: var(--hint);
    text-transform: uppercase;
    margin-bottom: 6px;
}
.info-item .value {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
}
.info-item .value.blue { color: var(--navy-md); }
.info-item .value.green { color: var(--green); }
.info-item .value.amber { color: var(--amber); }

/* ── FORM CARD ── */
.form-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.form-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
    display: flex;
    align-items: center;
    gap: 12px;
}
.form-header-icon {
    width: 36px; height: 36px;
    background: var(--green-lt);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
}
.form-header h3 {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
    margin: 0;
}
.form-body {
    padding: 1.5rem;
}
.form-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
}
.form-group {
    margin-bottom: 0;
}
.form-group label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 6px;
}
.form-group label .required {
    color: var(--red);
    margin-left: 2px;
}
.form-input, .form-select {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 13px;
    font-family: 'IBM Plex Sans', sans-serif;
    background: white;
    transition: all .15s ease;
}
.form-input:focus, .form-select:focus {
    outline: none;
    border-color: var(--navy-md);
    box-shadow: 0 0 0 3px rgba(29,78,216,.1);
}
.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    background: var(--green);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all .15s;
}
.btn-submit:hover {
    background: #15803d;
    transform: translateY(-1px);
}

/* ── TABLE CARD ── */
.table-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}
.table-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: .75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    background: #fdfdfd;
}
.table-card-title {
    font-size: 12px; font-weight: 600; color: var(--muted);
    text-transform: uppercase; letter-spacing: .05em;
}
.table-count {
    font-size: 12px; color: var(--hint);
    background: var(--gray-bg); border: 1px solid var(--border);
    border-radius: 99px; padding: 2px 10px; font-weight: 600;
}
.ta-table { width: 100%; border-collapse: collapse; }
.ta-table thead th {
    padding: .7rem 1rem; text-align: left;
    font-size: 11px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .06em;
    background: var(--gray-bg); border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.ta-table thead th:last-child { text-align: center; }
.ta-table tbody tr {
    border-bottom: 1px solid #f1f5f9; transition: background .12s;
}
.ta-table tbody tr:hover { background: #f8fafc; }
.ta-table td {
    padding: .875rem 1rem; vertical-align: middle;
    font-size: 13px; color: var(--text);
}
.ta-table td:last-child { text-align: center; }
.badge-setor {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px; border-radius: 99px;
    font-size: 11px; font-weight: 600;
    background: var(--green-lt); color: var(--green);
}
.badge-tarik {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px; border-radius: 99px;
    font-size: 11px; font-weight: 600;
    background: var(--red-lt); color: var(--red);
}
.btn-delete {
    padding: 4px 8px;
    background: var(--red-lt);
    color: var(--red);
    border: 1px solid var(--red-bd);
    border-radius: 6px;
    cursor: pointer;
    transition: all .15s;
}
.btn-delete:hover {
    background: #fee2e2;
}
.pagination-wrapper {
    padding: 1rem 1.25rem;
    border-top: 1px solid var(--border);
    background: #fdfdfd;
}

@media (max-width: 900px) {
    .page-wrapper { padding: 1rem; }
    .form-grid { grid-template-columns: 1fr; gap: 0.75rem; }
    .info-grid { grid-template-columns: 1fr; }
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .top-bar { flex-direction: column; align-items: flex-start; }
    .btn-back { width: 100%; justify-content: center; }
    .ta-table { min-width: 600px; }
}
</style>

@php
    $totalSetor = $transaksi->where('jenis', 'setor')->sum('nominal');
    $totalTarik = $transaksi->where('jenis', 'tarik')->sum('nominal');
    $saldo = $tabungan->saldo ?? 0;
    $totalTransaksi = $transaksi->count();
@endphp

<div class="page-wrapper">

    {{-- ═══ TOP BAR ═══ --}}
    <div class="top-bar">
        <div class="page-title">
            <div class="title-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="title-text">
                <h1>Tabungan {{ $siswa->nama_siswa }}</h1>
                <p>Kelola tabungan siswa &mdash; <strong>{{ $siswa->nama_siswa }}</strong></p>
            </div>
        </div>
        <a href="{{ route('bendahara.tabungan-siswa.siswa', $siswa->rombel_id) }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali ke Daftar Siswa
        </a>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Saldo Tabungan</div>
            <div class="stat-val green">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
            <div class="stat-sub">saldo saat ini</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Setoran</div>
            <div class="stat-val blue">Rp {{ number_format($totalSetor, 0, ',', '.') }}</div>
            <div class="stat-sub">seluruh setoran</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Penarikan</div>
            <div class="stat-val red">Rp {{ number_format($totalTarik, 0, ',', '.') }}</div>
            <div class="stat-sub">seluruh penarikan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-val amber">{{ $totalTransaksi }}</div>
            <div class="stat-sub">kali transaksi</div>
        </div>
    </div>

    {{-- ═══ INFO SISWA ═══ --}}
    <div class="info-card">
        <div class="info-header">
            <div class="info-header-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h3>Informasi Siswa</h3>
        </div>
        <div class="info-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="label">NISN</div>
                    <div class="value">{{ $siswa->nisn ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">NIS</div>
                    <div class="value">{{ $siswa->nis ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">Nama Lengkap</div>
                    <div class="value blue">{{ $siswa->nama_siswa }}</div>
                </div>
                <div class="info-item">
                    <div class="label">Jenis Kelamin</div>
                    <div class="value">{{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                </div>
                <div class="info-item">
                    <div class="label">Rombel</div>
                    <div class="value">{{ $siswa->rombel->nama_rombel ?? '-' }} ({{ $siswa->rombel->kode_rombel ?? '-' }})</div>
                </div>
                <div class="info-item">
                    <div class="label">Wali Kelas</div>
                    <div class="value">{{ $siswa->rombel->walikelas->nama ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ FORM TAMBAH TRANSAKSI ═══ --}}
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                    <path d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <h3>Tambah Transaksi Baru</h3>
        </div>
        <div class="form-body">
            <form action="{{ route('bendahara.tabungan-siswa.store', $siswa->id) }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>Jenis Transaksi <span class="required">*</span></label>
                        <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                            <option value="">Pilih Jenis</option>
                            <option value="setor" {{ old('jenis') === 'setor' ? 'selected' : '' }}>💰 Setor</option>
                            <option value="tarik" {{ old('jenis') === 'tarik' ? 'selected' : '' }}>💸 Tarik</option>
                        </select>
                        @error('jenis') <div class="text-red" style="font-size: 10px; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Nominal <span class="required">*</span></label>
                        <input type="number" name="nominal" class="form-input @error('nominal') is-invalid @enderror"
                               value="{{ old('nominal') }}" min="500" step="500" placeholder="Minimal Rp 500" required>
                        @error('nominal') <div class="text-red" style="font-size: 10px; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Tanggal <span class="required">*</span></label>
                        <input type="date" name="tanggal" class="form-input @error('tanggal') is-invalid @enderror"
                               value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        @error('tanggal') <div class="text-red" style="font-size: 10px; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-input @error('keterangan') is-invalid @enderror"
                               value="{{ old('keterangan') }}" placeholder="Opsional">
                        @error('keterangan') <div class="text-red" style="font-size: 10px; margin-top: 4px;">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn-submit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                        </svg>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══ RIWAYAT TRANSAKSI ═══ --}}
    <div class="table-card">
<div class="table-card-header">
    <div style="display:flex; align-items:center; gap:10px;">
        <span class="table-card-title">Riwayat Transaksi</span>
        <span class="table-count">{{ $totalTransaksi }} transaksi</span>
    </div>

    <a href="{{ route('bendahara.tabungan-siswa.pdf', $siswa->id) }}"
       target="_blank"
       style="
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:8px 14px;
            background:#dc2626;
            color:white;
            border-radius:8px;
            text-decoration:none;
            font-size:12px;
            font-weight:600;
       ">
        📄 Cetak PDF
    </a>
</div>
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="ta-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th>Petugas</th>
                        <th style="width:60px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $trx)
                    <tr>
                        <td>{{ $trx->tanggal->format('d/m/Y') }}</td>
                        <td>
                            @if($trx->jenis === 'setor')
                                <span class="badge-setor">💰 Setor</span>
                            @else
                                <span class="badge-tarik">💸 Tarik</span>
                            @endif
                        </td>
                        <td class="{{ $trx->jenis === 'setor' ? 'text-green' : 'text-red' }}" style="font-weight: 600;">
                            {{ $trx->jenis === 'setor' ? '+' : '-' }} Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                        </td>
                        <td>{{ $trx->keterangan ?? '-' }}</td>
                        <td>{{ $trx->petugas->name ?? '-' }}</td>
                        <td>
                            <form action="{{ route('bendahara.tabungan-siswa.destroy', [$siswa->id, $trx->id]) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus Transaksi">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6"/><path d="M14 11v6"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 2rem; text-align: center; color: var(--hint);">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 8px;">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                <p>Belum ada transaksi tabungan.</p>
                                <p style="font-size: 12px;">Silakan tambahkan transaksi pertama melalui form di atas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transaksi->hasPages())
        <div class="pagination-wrapper">
            {{ $transaksi->links() }}
        </div>
        @endif
    </div>

</div>

@endsection