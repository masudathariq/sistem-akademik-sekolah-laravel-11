@extends('layouts.guru')

@section('content')

<style>
    :root {
        --primary: #047857;
        --primary-dark: #065f46;
        --primary-light: #bbf7d0;
        --primary-bg: #ecfdf5;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --radius: 1rem;
        --shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
    }

    body {
        background: var(--gray-50);
        font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        color: var(--gray-800);
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .welcome-card,
    .guide-banner,
    .table-section,
    .action-bar,
    .empty-card,
    .stats-grid {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow);
    }

    .welcome-card {
        padding: 1.75rem 2rem;
        margin-bottom: 1.75rem;
    }

    .welcome-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--gray-900);
    }

    .welcome-desc {
        margin-top: 0.75rem;
        color: var(--gray-500);
        line-height: 1.75;
    }

    .guide-banner {
        padding: 1.5rem 2rem;
        margin-bottom: 1.75rem;
        border-left: 4px solid var(--primary);
    }

    .guide-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .guide-steps {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: space-between;
    }

    .step-item {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--gray-50);
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--gray-700);
    }

    .step-number {
        width: 28px;
        height: 28px;
        background: var(--primary);
        color: white;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .step-text {
        line-height: 1.4;
    }

    .step-text strong {
        color: var(--gray-800);
    }

    @media (max-width: 900px) {
        .guide-steps {
            flex-direction: column;
            gap: 0.5rem;
        }
    }

    /* Action Grid */
    .action-buttons-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .action-btn {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }

    .action-btn:hover {
        transform: translateY(-2px);
        border-color: var(--primary);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    }

    .action-emoji {
        font-size: 1.75rem;
        width: 48px;
        height: 48px;
        background: var(--primary-bg);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .action-info h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.25rem;
    }

    .action-info p {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    .step-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--primary);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        width: 22px;
        height: 22px;
        border-radius: 999px;
        margin-left: 0.35rem;
    }

    /* Stats Row (konsisten dengan raport Tahfidz) */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1.25rem;
    }

    .stat-box {
        background: white;
        border-radius: 0.75rem;
        padding: 0.5rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1.2;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-hint {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 0.5rem;
    }

    @media (max-width: 1000px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Tabel */
    .table-section {
        overflow: hidden;
        border-radius: 1rem;
    }

    .section-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        background: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--gray-800);
    }

    .total-badge {
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .siswa-table {
        width: 100%;
        border-collapse: collapse;
    }

    .siswa-table th,
    .siswa-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
        font-size: 0.9rem;
        vertical-align: middle;
    }

    .siswa-table th {
        text-align: left;
        background: var(--gray-50);
        color: var(--gray-600);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }

    .siswa-table tr:hover td {
        background: var(--gray-50);
    }

    .profil-siswa {
        display: flex;
        align-items: center;
        gap: 0.875rem;
    }

    .avatar-siswa {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        color: white;
        flex-shrink: 0;
    }

    .info-siswa .nama {
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.125rem;
    }

    .info-siswa .detail {
        font-size: 0.78rem;
        color: var(--gray-500);
    }

    .label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .label-bacaan {
        background: #d1fae5;
        color: #065f46;
    }

    .label-nilai {
        background: #dbeafe;
        color: #4338ca;
    }

    .label-ujian {
        background: #fef3c7;
        color: #92400e;
    }

    .label-kosong {
        background: var(--gray-100);
        color: var(--gray-500);
    }

    .tombol-group {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .tombol {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .tombol-detail {
        background: white;
        border: 1px solid var(--gray-300);
        color: var(--gray-700);
    }

    .tombol-detail:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .tombol-cetak {
        background: var(--primary);
        color: white;
        border: none;
    }

    .tombol-cetak:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .empty-card {
        text-align: center;
        padding: 3rem 2rem;
    }

    .empty-illustration {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.5rem;
    }

    .empty-desc {
        color: var(--gray-500);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .btn-pilih-siswa {
        background: var(--primary);
        color: white;
        padding: 0.85rem 1.5rem;
        border-radius: 0.95rem;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }
        .action-buttons-grid {
            grid-template-columns: 1fr;
        }
        .tombol-group {
            justify-content: flex-start;
            margin-top: 0.5rem;
        }
        .siswa-table th,
        .siswa-table td {
            padding: 0.75rem 1rem;
        }
    }
</style>

<div class="dashboard-container">

    {{-- HEADER SELAMAT DATANG --}}
    <div class="welcome-card">
        <div class="welcome-title">
            📖 Raport Iqro
        </div>
        <div class="welcome-desc">
            Kelola perkembangan bacaan Iqro, catat progres membaca, dan cetak raport siswa dengan tampilan profesional.
        </div>
    </div>

    {{-- BANNER PANDUAN MENGISI (LANGKAH-LANGKAH) --}}
    <div class="guide-banner">
        <div class="guide-title">
            📌 Panduan Mengisi Raport Iqro
        </div>
        <div class="guide-steps">
            <div class="step-item">
                <span class="step-number">1</span>
                <span class="step-text"><strong>Pilih Siswa</strong> — pilih siswa yang akan dimasukkan ke dalam raport Iqro.</span>
            </div>
            <div class="step-item">
                <span class="step-number">2</span>
                <span class="step-text"><strong>Input Nilai Aspek</strong> — beri nilai tiap aspek penilaian Iqro sesuai kemajuan membaca.</span>
            </div>
            <div class="step-item">
                <span class="step-number">3</span>
                <span class="step-text"><strong>Catatan Bacaan</strong> — rekam target halaman dan Iqro terakhir yang dibaca.</span>
            </div>
            <div class="step-item">
                <span class="step-number">4</span>
                <span class="step-text"><strong>Data Ujian</strong> — input nilai ujian Iqro siswa.</span>
            </div>
        </div>
    </div>

    {{-- TOMBOL AKSI UTAMA DENGAN NOMOR URUT --}}
    <div class="action-buttons-grid">
        <a href="{{ route('guru.raport-iqro-siswa.create') }}" class="action-btn">
            <div class="action-emoji">👤</div>
            <div class="action-info">
                <h4>Pilih Siswa <span class="step-badge">1</span></h4>
                <p>Mulai kelola raport Iqro</p>
            </div>
        </a>

        <a href="{{ route('guru.raport-iqro-nilai.index') }}" class="action-btn">
            <div class="action-emoji">✏️</div>
            <div class="action-info">
                <h4>Input Nilai Aspek <span class="step-badge">2</span></h4>
                <p>Beri nilai tiap aspek</p>
            </div>
        </a>

        <a href="{{ route('guru.raport-iqro-bacaan.index') }}" class="action-btn">
            <div class="action-emoji">📝</div>
            <div class="action-info">
                <h4>Catatan Bacaan <span class="step-badge">3</span></h4>
                <p>Rekam progres Iqro</p>
            </div>
        </a>

        <a href="{{ route('guru.raport-iqro-ujian.create') }}" class="action-btn">
            <div class="action-emoji">🎓</div>
            <div class="action-info">
                <h4>Data Ujian <span class="step-badge">4</span></h4>
                <p>Input hasil ujian</p>
            </div>
        </a>

        <a href="{{ route('guru.raport-iqro-aspeks.index') }}" class="action-btn">
            <div class="action-emoji">📋</div>
            <div class="action-info">
                <h4>Aspek Penilaian</h4>
                <p>Atur kriteria nilai</p>
            </div>
        </a>
    </div>

    @if ($siswas->isEmpty())
        <div class="empty-card">
            <div class="empty-illustration">📂</div>
            <div class="empty-title">Belum Ada Data Siswa</div>
            <div class="empty-desc">
                Klik tombol di bawah untuk memilih siswa dan mulai mengelola raport Iqro.
            </div>
            <a href="{{ route('guru.raport-iqro-siswa.create') }}" class="btn-pilih-siswa">
                👤 Pilih Siswa Sekarang
            </a>
        </div>
    @else
        {{-- STATISTIK RINGKAS (konsisten dengan raport Tahfidz) --}}
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-number">{{ $siswas->count() }}</div>
                <div class="stat-label">Total Siswa</div>
                <div class="stat-hint">Terdaftar di kelas Iqro</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ $aspeks->count() }}</div>
                <div class="stat-label">Aspek Penilaian</div>
                <div class="stat-hint">Kriteria nilai yang dinilai</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ collect($bacaan)->count() }}</div>
                <div class="stat-label">Catatan Bacaan</div>
                <div class="stat-hint">Data bacaan yang sudah dicatat</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ collect($ujian)->count() }}</div>
                <div class="stat-label">Riwayat Ujian</div>
                <div class="stat-hint">Hasil ujian Iqro</div>
            </div>
        </div>

        {{-- TABEL DAFTAR SISWA --}}
        <div class="table-section">
            <div class="section-header">
                <div class="section-title">
                    👨‍🎓 Daftar Siswa
                    <span class="total-badge">{{ $siswas->count() }} orang</span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="siswa-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Bacaan Terakhir</th>
                            <th>Nilai Aspek</th>
                            <th>Ujian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $i => $siswa)
                            @php
                                $aspekDinilai = collect($nilai[$siswa->id] ?? [])->filter(fn($v) => $v > 0)->count();
                                $totalAspek = $aspeks->count();
                                $bacaanSiswa = $bacaan[$siswa->id] ?? null;
                                $ujianSiswa = $ujian[$siswa->id] ?? collect();
                                $inisial = mb_strtoupper(mb_substr($siswa->nama_siswa, 0, 1));
                                $kelas = $siswa->rombel->tingkat_romawi ?? '';
                                $rombel = $siswa->rombel->nama_rombel ?? '';
                            @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    <div class="profil-siswa">
                                        <div class="avatar-siswa">{{ $inisial }}</div>
                                        <div class="info-siswa">
                                            <div class="nama">{{ $siswa->nama_siswa }}</div>
                                            <div class="detail">NIS: {{ $siswa->nis ?? '-' }} · Kelas: {{ $kelas }} {{ $rombel }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($bacaanSiswa)
                                        <span class="label label-bacaan">
                                            📘 Iqro {{ $bacaanSiswa->iqro_terakhir }} · Halaman {{ $bacaanSiswa->halaman_terakhir }}
                                        </span>
                                    @else
                                        <span class="label label-kosong">Belum ada bacaan</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="label label-nilai">
                                        ⭐ {{ $aspekDinilai }} dari {{ $totalAspek }}
                                    </span>
                                </td>
                                <td>
                                    @if ($ujianSiswa->count() > 0)
                                        <span class="label label-ujian">
                                            🎓 {{ $ujianSiswa->count() }} kali ujian
                                        </span>
                                    @else
                                        <span class="label label-kosong">Belum ada ujian</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="tombol-group">
                                        <a href="{{ route('guru.raport-iqro.show', $siswa->id) }}" class="tombol tombol-detail">
                                            👁 Detail
                                        </a>
                                        <a href="{{ route('guru.raport_iqro.download_pdf', $siswa->id) }}" target="_blank" class="tombol tombol-cetak">
                                            🖨️ Cetak Raport
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-top: 1rem; text-align: center; font-size: 0.75rem; color: var(--gray-400);">
            💡 Tips: Isi catatan bacaan, aspek, dan nilai ujian terlebih dahulu sebelum mencetak raport.
        </div>
    @endif
</div>

@endsection