@extends('layouts.guru')

@section('title', 'Daftar Hafalan Siswa | Raport Tahfidz')

@section('content')

{{-- Professional Font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">

<style>
    /* ----- VARIABLES ----- */
    :root {
        --primary: #0d9488;
        --primary-dark: #0f766e;
        --primary-light: #ccfbf1;
        --primary-bg: #f0fdfa;
        --secondary: #6366f1;
        --secondary-light: #e0e7ff;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --radius-lg: 1rem;
        --radius-md: 0.75rem;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--gray-50);
        color: var(--gray-800);
    }

    /* Container Utama */
    .hafalan-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* ========== HERO SECTION ========== */
    .hero-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 2rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .hero-text h1 {
        font-size: 1.875rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: white;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .hero-text p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.875rem;
        line-height: 1.6;
        max-width: 600px;
    }

    .hero-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        padding: 0.75rem 1.25rem;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* ========== ACTION BAR ========== */
    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
        background: white;
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: var(--radius-md);
        background: var(--gray-100);
        color: var(--gray-700);
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: var(--gray-200);
        color: var(--gray-900);
    }

    .btn-group {
        display: flex;
        gap: 0.75rem;
    }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        border-radius: var(--radius-md);
        background: white;
        border: 1px solid var(--gray-300);
        color: var(--gray-700);
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-outline:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        border-radius: var(--radius-md);
        background: var(--primary);
        border: none;
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    /* ========== INFO COUNT ========== */
    .info-count {
        margin-bottom: 1rem;
        display: flex;
        justify-content: flex-end;
    }

    .count-badge {
        background: var(--primary-bg);
        color: var(--primary);
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* ========== TABLE MODERN ========== */
    .table-wrapper {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .data-table thead tr:first-child th {
        background: var(--gray-50);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--gray-500);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--gray-200);
    }

    .data-table thead tr:last-child th {
        background: white;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
    }

    .th-orange {
        background: #fff7ed !important;
        color: #c2410c !important;
    }

    .th-indigo {
        background: #eef2ff !important;
        color: #4338ca !important;
    }

    .data-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .data-table tbody tr:hover td {
        background: var(--gray-50);
    }

    /* Student Info */
    .student-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .avatar {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
        color: white;
        flex-shrink: 0;
    }

    .student-name {
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.125rem;
    }

    .student-meta {
        font-size: 0.7rem;
        color: var(--gray-500);
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .badge-orange {
        background: #fff7ed;
        color: #c2410c;
    }

    .badge-indigo {
        background: #eef2ff;
        color: #4338ca;
    }

    .empty-value {
        color: var(--gray-400);
        font-size: 0.75rem;
    }

    .orange-cell, .indigo-cell {
        background-color: transparent;
    }

    /* ========== EMPTY STATE ========== */
    .empty-state {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        padding: 3rem 2rem;
        text-align: center;
        box-shadow: var(--shadow-sm);
    }

    .empty-icon {
        width: 72px;
        height: 72px;
        background: var(--gray-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1rem;
    }

    .empty-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.5rem;
    }

    .empty-desc {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-bottom: 1.5rem;
    }

    .empty-link {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 1024px) {
        .hafalan-container {
            padding: 1.5rem;
        }
        .hero-text h1 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .hafalan-container {
            padding: 1rem;
        }
        .hero-content {
            flex-direction: column;
            align-items: flex-start;
        }
        .action-bar {
            flex-direction: column;
            align-items: stretch;
        }
        .btn-group {
            justify-content: flex-end;
        }
        .info-count {
            justify-content: flex-start;
        }
    }
</style>

<div class="hafalan-container">

    {{-- Hero Section --}}
    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>📖 Daftar Hafalan Siswa</h1>
                <p>Ringkasan hafalan terakhir dan target hafalan lanjutan seluruh siswa. Pantau perkembangan tahfidz secara lebih terstruktur.</p>
            </div>
            <div class="hero-badge">
                👨‍🎓 {{ $siswas->count() }} Siswa
            </div>
        </div>
    </div>

    {{-- Action Bar --}}
    <div class="action-bar">
        <a href="{{ route('guru.raport-tahfidz.index') }}" class="btn-back">
            ← Kembali ke Dashboard
        </a>
        <div class="btn-group">
            <a href="{{ route('guru.raport-hafalan.create') }}" class="btn-primary">
                ➕ Input Hafalan
            </a>
        </div>
    </div>

    @if($siswas->isEmpty())
        {{-- Empty State --}}
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <div class="empty-title">Belum Ada Data Siswa</div>
            <div class="empty-desc">Silakan pilih siswa terlebih dahulu untuk mulai mencatat hafalan.</div>
            <a href="{{ route('guru.raport-tahfidz-siswa.create') }}" class="empty-link">
                Pilih Siswa Sekarang →
            </a>
        </div>
    @else
        {{-- Info Jumlah --}}
        <div class="info-count">
            <span class="count-badge">📋 {{ $siswas->count() }} Siswa Ditampilkan</span>
        </div>

        {{-- Tabel Hafalan --}}
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th colspan="2" class="th-orange">📖 Hafalan Terakhir</th>
                            <th colspan="2" class="th-indigo">🎯 Hafalan Lanjutan</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Surah</th>
                            <th>Ayat</th>
                            <th>Surah</th>
                            <th>Ayat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $index => $siswa)
                            @php
                                $data = $hafalan[$siswa->id] ?? null;
                                $inisial = strtoupper(substr($siswa->nama_siswa, 0, 1));
                                $kelas = ($siswa->rombel->tingkat_romawi ?? '') . ' ' . ($siswa->rombel->nama_rombel ?? '');
                                $kelas = trim($kelas) ?: '-';
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar">{{ $inisial }}</div>
                                        <div>
                                            <div class="student-name">{{ $siswa->nama_siswa }}</div>
                                            <div class="student-meta">Kelas: {{ $kelas }} | NIS: {{ $siswa->nis ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($data?->surah_terakhir)
                                        <span class="badge badge-orange">📖 {{ $data->surah_terakhir }}</span>
                                    @else
                                        <span class="empty-value">-</span>
                                    @endif
                                </td>
                                <td>{{ $data?->ayat_terakhir ?? '-' }}</td>
                                <td>
                                    @if($data?->surah_lanjut)
                                        <span class="badge badge-indigo">➡️ {{ $data->surah_lanjut }}</span>
                                    @else
                                        <span class="empty-value">-</span>
                                    @endif
                                </td>
                                <td>{{ $data?->ayat_lanjut ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer catatan --}}
        <div class="info-count" style="margin-top: 1rem; justify-content: center;">
            <span class="count-badge" style="background: var(--gray-100); color: var(--gray-600);">
                💡 Klik "Input Hafalan" untuk mencatat atau memperbarui hafalan siswa
            </span>
        </div>
    @endif
</div>

@endsection