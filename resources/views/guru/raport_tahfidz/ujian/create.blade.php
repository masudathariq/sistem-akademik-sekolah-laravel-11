@extends('layouts.guru')

@section('title', 'Input Nilai Ujian | Raport Tahfidz')

@section('content')

{{-- Font Modern --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #0d9488;
        --primary-dark: #0f766e;
        --primary-light: #ccfbf1;
        --primary-bg: #f0fdfa;
        --secondary: #6366f1;
        --success: #059669;
        --success-light: #d1fae5;
        --warning: #d97706;
        --warning-light: #fef3c7;
        --danger: #dc2626;
        --danger-light: #fee2e2;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
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

    .page-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 1.75rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .hero::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 280px;
        height: 280px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .hero-text h1 {
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: white;
        margin-bottom: 0.5rem;
    }

    .hero-text p {
        color: rgba(255,255,255,0.85);
        font-size: 0.875rem;
        max-width: 550px;
        line-height: 1.5;
    }

    .hero-badge {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        padding: 0.6rem 1.25rem;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: white;
        border: 1px solid rgba(255,255,255,0.2);
    }

    /* Alert */
    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        border-radius: var(--radius-md);
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .alert-success {
        background: var(--success-light);
        color: var(--success);
        border-left: 4px solid var(--success);
    }

    /* Card Form */
    .card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
        background: white;
    }

    .card-header h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.25rem;
    }

    .card-header p {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13,148,136,0.1);
    }

    .error-text {
        font-size: 0.7rem;
        color: var(--danger);
        margin-top: 0.375rem;
    }

    /* Tabel Siswa */
    .table-wrapper {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
    }

    .table-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        background: white;
    }

    .table-title {
        font-weight: 700;
        font-size: 0.875rem;
        color: var(--gray-700);
    }

    .table-count {
        font-size: 0.7rem;
        background: var(--gray-100);
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        color: var(--gray-600);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .data-table th {
        text-align: left;
        padding: 0.875rem 1.5rem;
        background: var(--gray-50);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        border-bottom: 1px solid var(--gray-200);
    }

    .data-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        background: var(--gray-50);
    }

    /* Student Cell */
    .student-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .avatar {
        width: 40px;
        height: 40px;
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

    /* Input Nilai */
    .nilai-input {
        width: 100px;
        padding: 0.6rem 0.5rem;
        text-align: center;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .nilai-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13,148,136,0.1);
    }

    /* Warna dinamis berdasarkan nilai (opsional) */
    .nilai-input[data-status="high"] {
        border-color: var(--success);
        color: var(--success);
    }
    .nilai-input[data-status="medium"] {
        border-color: var(--warning);
        color: var(--warning);
    }
    .nilai-input[data-status="low"] {
        border-color: var(--danger);
        color: var(--danger);
    }

    /* Tombol Aksi */
    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 0.5rem;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        background: white;
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-container {
            padding: 1rem;
        }
        .hero-content {
            flex-direction: column;
            align-items: flex-start;
        }
        .hero-text h1 {
            font-size: 1.5rem;
        }
        .table-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .form-footer {
            justify-content: stretch;
        }
        .btn-primary, .btn-secondary {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<div class="page-container">

    {{-- Hero --}}
    <div class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>📝 Input Nilai Ujian</h1>
                <p>Isi nilai ujian tahfidz untuk setiap siswa. Nilai akan tersimpan dan terintegrasi ke dalam raport.</p>
            </div>
            <div class="hero-badge">
                👨‍🎓 {{ $siswas->count() }} Siswa
            </div>
        </div>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
    <div class="alert alert-success">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 6L9 17l-5-5"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('guru.raport-ujian.store') }}" method="POST">
        @csrf

        {{-- Form Nama Ujian --}}
        <div class="card">
            <div class="card-header">
                <h3>📋 Informasi Ujian</h3>
                <p>Masukkan nama ujian yang akan dinilai (misal: UTS Tahfidz, UAS Genap, dll).</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Nama Ujian <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ujian" class="form-input"
                           value="{{ old('nama_ujian', $nama_ujian_terakhir ?? '') }}"
                           placeholder="Contoh: Ujian Akhir Semester Gasal">
                    @error('nama_ujian')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Tabel Nilai Siswa --}}
        <div class="table-wrapper">
            <div class="table-header">
                <div class="table-title">🎯 Daftar Nilai Siswa</div>
                <div class="table-count">{{ $siswas->count() }} Siswa</div>
            </div>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Siswa</th>
                            <th style="text-align: center; width: 180px;">Nilai (1-100)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $index => $siswa)
                            @php
                                $namaUjian = old('nama_ujian', $nama_ujian_terakhir ?? '');
                                $nilaiLama = $nilai_ujian[$namaUjian][$siswa->id]->nilai_ujian ?? '';
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
                                            <div class="student-meta">
                                                NIS: {{ $siswa->nis ?? '-' }} · Kelas: {{ $kelas }}
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                </td>
                                <td style="text-align: center;">
                                    <input type="number" name="nilai_ujian[]" min="0" max="100"
                                           class="nilai-input" placeholder="0"
                                           value="{{ old('nilai_ujian.'.$index, $nilaiLama) }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="form-footer">
            <a href="{{ route('guru.raport-tahfidz.index') }}" class="btn-secondary">
                ← Kembali ke Dashboard
            </a>
            <button type="submit" class="btn-primary">
                💾 Simpan Semua Nilai
            </button>
        </div>
    </form>
</div>

{{-- Script untuk memberikan feedback visual pada input nilai --}}
<script>
    document.querySelectorAll('.nilai-input').forEach(input => {
        function updateColor() {
            let val = parseInt(input.value);
            if (isNaN(val) || input.value === '') {
                input.style.borderColor = '#d1d5db';
                input.style.color = '#374151';
                return;
            }
            if (val >= 85) {
                input.style.borderColor = '#059669';
                input.style.color = '#059669';
            } else if (val >= 70) {
                input.style.borderColor = '#d97706';
                input.style.color = '#b45309';
            } else {
                input.style.borderColor = '#dc2626';
                input.style.color = '#dc2626';
            }
        }
        input.addEventListener('input', updateColor);
        updateColor();
    });
</script>

@endsection