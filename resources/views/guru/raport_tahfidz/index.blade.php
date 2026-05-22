@extends('layouts.guru')

@section('title', 'Raport Tahfidz - Kelola Nilai Hafalan Santri')

@section('content')

{{-- Font & Style Ramah Pengguna --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary: #0d9488;
        --primary-dark: #0f766e;
        --primary-light: #ccfbf1;
        --primary-bg: #f0fdfa;
        --success: #059669;
        --success-light: #d1fae5;
        --warning: #d97706;
        --warning-light: #fef3c7;
        --info: #0284c7;
        --info-light: #e0f2fe;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --radius: 1rem;
        --radius-sm: 0.75rem;
        --shadow: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.08);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--gray-50);
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    /* Welcome Card */
    .welcome-card {
        background: linear-gradient(135deg, var(--primary) 0%, #0f766e 100%);
        border-radius: var(--radius);
        padding: 1.75rem 2rem;
        margin-bottom: 1.75rem;
        color: white;
        box-shadow: var(--shadow-md);
    }

    .welcome-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .welcome-desc {
        font-size: 0.875rem;
        opacity: 0.9;
        line-height: 1.5;
        max-width: 600px;
    }

    /* Banner Panduan (Baru) */
    .guide-banner {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.75rem;
        box-shadow: var(--shadow);
    }

    .guide-title {
        font-size: 0.9rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 0.75rem;
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
        border-radius: var(--radius-sm);
        font-size: 0.8rem;
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
    }

    .step-text {
        flex: 1;
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
        box-shadow: var(--shadow);
        position: relative;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
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
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-info p {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    /* Badge nomor urut pada tombol */
    .step-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--primary);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        width: 20px;
        height: 20px;
        border-radius: 999px;
        margin-left: 0.25rem;
    }

    /* Statistik */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-box {
        background: white;
        border-radius: var(--radius-sm);
        padding: 1.25rem;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow);
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

    /* Table */
    .table-section {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        box-shadow: var(--shadow);
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
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-800);
    }

    .total-badge {
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.25rem 0.75rem;
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

    .siswa-table th {
        text-align: left;
        padding: 1rem 1.5rem;
        background: var(--gray-50);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        border-bottom: 1px solid var(--gray-200);
    }

    .siswa-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
        font-size: 0.875rem;
        vertical-align: middle;
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
        border-radius: var(--radius-sm);
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
        font-size: 0.7rem;
        color: var(--gray-500);
    }

    .label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.875rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .label-hafalan {
        background: var(--primary-light);
        color: var(--primary);
    }

    .label-nilai {
        background: var(--success-light);
        color: var(--success);
    }

    .label-ujian {
        background: var(--warning-light);
        color: var(--warning);
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
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
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
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-200);
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
        font-size: 0.875rem;
    }

    .btn-pilih-siswa {
        background: var(--primary);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    @media (max-width: 1000px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }
        .welcome-card {
            padding: 1.25rem;
        }
        .stats-row {
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
            📖 Raport Tahfidz
        </div>
        <div class="welcome-desc">
            Kelola nilai hafalan Al-Qur'an, catat perkembangan, dan cetak raport siswa dengan mudah.
        </div>
    </div>

    {{-- BANNER PANDUAN MENGISI (LANGKAH-LANGKAH) --}}
    <div class="guide-banner">
        <div class="guide-title">
            📌 Panduan Mengisi Raport Tahfidz
        </div>
        <div class="guide-steps">
            <div class="step-item">
                <span class="step-number">1</span>
                <span class="step-text"><strong>Pilih Siswa</strong> — klik tombol di bawah untuk memilih siswa yang akan diisi raportnya.</span>
            </div>
            <div class="step-item">
                <span class="step-number">2</span>
                <span class="step-text"><strong>Input Nilai Aspek</strong> — beri nilai untuk setiap aspek penilaian.</span>
            </div>
            <div class="step-item">
                <span class="step-number">3</span>
                <span class="step-text"><strong>Catatan Hafalan</strong> — rekam surah & ayat terakhir dan target hafalan.</span>
            </div>
            <div class="step-item">
                <span class="step-number">4</span>
                <span class="step-text"><strong>Data Ujian</strong> — input nilai ujian tahfidz siswa.</span>
            </div>
        </div>
    </div>

    {{-- TOMBOL AKSI UTAMA DENGAN NOMOR URUT --}}
    <div class="action-buttons-grid">
        <!-- Tombol Pilih Siswa (langkah 1, tanpa nomor badge karena paling awal) -->
        <a href="{{ route('guru.raport-tahfidz-siswa.create') }}" class="action-btn">
            <div class="action-emoji">👤</div>
            <div class="action-info">
                <h4>Pilih Siswa <span class="step-badge">1</span></h4>
                <p>Mulai isi raport</p>
            </div>
        </a>

        <!-- Input Nilai Aspek (langkah 2) -->
        <a href="{{ route('guru.raport-nilai.index') }}" class="action-btn">
            <div class="action-emoji">✏️</div>
            <div class="action-info">
                <h4>Input Nilai Aspek <span class="step-badge">2</span></h4>
                <p>Beri nilai tiap aspek</p>
            </div>
        </a>

        <!-- Catatan Hafalan (langkah 3) -->
        <a href="{{ route('guru.raport-hafalan.index') }}" class="action-btn">
            <div class="action-emoji">📝</div>
            <div class="action-info">
                <h4>Catatan Hafalan <span class="step-badge">3</span></h4>
                <p>Rekam progres hafalan</p>
            </div>
        </a>

        <!-- Data Ujian (langkah 4) -->
        <a href="{{ route('guru.raport-ujian.create') }}" class="action-btn">
            <div class="action-emoji">🎓</div>
            <div class="action-info">
                <h4>Data Ujian <span class="step-badge">4</span></h4>
                <p>Input hasil ujian</p>
            </div>
        </a>

        
        <!-- Tombol Aspek Penilaian (opsional, tidak wajib diisi setiap saat) -->
        <a href="{{ route('guru.raport-aspeks.index') }}" class="action-btn">
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
                Klik tombol di bawah untuk memilih siswa dan mulai mengelola raport tahfidz.
            </div>
            <a href="{{ route('guru.raport-tahfidz-siswa.create') }}" class="btn-pilih-siswa">
                👤 Pilih Siswa Sekarang
            </a>
        </div>
    @else


        {{-- Tabel Siswa --}}
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
                            <th>Hafalan Terakhir</th>
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
                                $hafalanSiswa = $hafalan[$siswa->id] ?? null;
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
                                    @if ($hafalanSiswa)
                                        <span class="label label-hafalan">
                                            📖 {{ $hafalanSiswa->surah_terakhir }} : {{ $hafalanSiswa->ayat_terakhir }}
                                        </span>
                                    @else
                                        <span class="label label-kosong">Belum ada hafalan</span>
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
                                        <a href="{{ route('guru.raport-tahfidz.show', $siswa->id) }}" class="tombol tombol-detail">
                                            👁 Detail
                                        </a>
                                        <a href="{{ route('guru.raport_tahfidz.download_pdf', $siswa->id) }}" target="_blank" class="tombol tombol-cetak">
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

        <div style="margin-top: 1rem; text-align: center; font-size: 0.7rem; color: var(--gray-400);">
            💡 Tips: Isi hafalan dan nilai aspek terlebih dahulu sebelum mencetak raport
        </div>
    @endif
</div>

@endsection