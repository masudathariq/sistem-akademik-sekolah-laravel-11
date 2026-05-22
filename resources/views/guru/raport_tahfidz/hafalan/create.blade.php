@extends('layouts.guru')

@section('title', 'Input Hafalan Siswa | Raport Tahfidz')

@section('content')

{{-- Font modern & professional --}}
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

    .hafalan-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 2rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .hero::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -15%;
        width: 320px;
        height: 320px;
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
        gap: 1.5rem;
    }

    .hero-text h1 {
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: white;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .hero-text p {
        color: rgba(255,255,255,0.85);
        font-size: 0.875rem;
        line-height: 1.6;
        max-width: 600px;
    }

    .hero-badge {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        padding: 0.75rem 1.25rem;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: white;
        border: 1px solid rgba(255,255,255,0.2);
    }

    /* Tombol Kembali */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.25rem;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        color: var(--gray-700);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1.25rem;
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }

    .back-link:hover {
        background: var(--gray-50);
        border-color: var(--gray-300);
        text-decoration: none;
    }

    /* Alert Sukses */
    .alert-success {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--success-light);
        border-left: 4px solid var(--success);
        color: var(--success);
        padding: 1rem 1.25rem;
        border-radius: var(--radius-md);
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Tabel Modern */
    .table-card {
        background: white;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
    }

    .table-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--gray-100);
        background: white;
    }

    .table-header h3 {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.25rem;
    }

    .table-header p {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .hafalan-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .hafalan-table th {
        text-align: left;
        padding: 1rem 1.25rem;
        background: var(--gray-50);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        border-bottom: 1px solid var(--gray-200);
    }

    .hafalan-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
        font-size: 0.875rem;
    }

    .hafalan-table tr:hover td {
        background: var(--gray-50);
    }

    /* Nomor urut */
    .number-badge {
        width: 36px;
        height: 36px;
        background: var(--primary-bg);
        color: var(--primary);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
    }

    /* Info siswa */
    .student-name {
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.125rem;
    }

    .student-desc {
        font-size: 0.7rem;
        color: var(--gray-500);
    }

    /* Input form */
    .form-input {
        width: 100%;
        padding: 0.65rem 0.75rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        font-family: 'Inter', sans-serif;
        transition: all 0.2s;
        background: white;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13,148,136,0.1);
    }

    select.form-input {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.25rem;
    }

    /* Label badge pada header kolom */
    .badge-label {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-terakhir {
        background: var(--warning-light);
        color: var(--warning);
    }

    .badge-lanjut {
        background: #e0e7ff;
        color: #4338ca;
    }

    /* Footer */
    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
    }

    .footer-meta {
        font-size: 0.875rem;
        color: var(--gray-500);
        background: white;
        padding: 0.5rem 1rem;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
    }

    .footer-meta strong {
        color: var(--gray-800);
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hafalan-container {
            padding: 1.5rem;
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
        .hero-text h1 {
            font-size: 1.5rem;
        }
        .form-footer {
            flex-direction: column;
            align-items: stretch;
        }
        .btn-submit {
            justify-content: center;
        }
        .table-header {
            padding: 1rem;
        }
    }
</style>

<div class="hafalan-container">

    {{-- Tombol Kembali --}}
    <a href="{{ route('guru.raport-hafalan.index') }}" class="back-link">
        ← Kembali ke Daftar Hafalan
    </a>

    {{-- Hero Section --}}
    <div class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>📖 Input Hafalan Siswa</h1>
                <p>Isi hafalan terakhir dan target hafalan lanjutan untuk semua siswa dalam satu tampilan tabel yang rapi. Setiap siswa dapat langsung diperbarui tanpa perlu membuka halaman terpisah.</p>
            </div>
            <div class="hero-badge">
                👨‍🎓 {{ $siswas->count() }} Siswa
            </div>
        </div>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
    <div class="alert-success">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 6L9 17l-5-5" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('guru.raport-hafalan.store') }}" method="POST">
        @csrf

        <div class="table-card">
            <div class="table-header">
                <h3>📋 Data Hafalan Siswa</h3>
                <p>Isi surah dan ayat hafalan terakhir serta target hafalan selanjutnya. Semua field wajib diisi.</p>
            </div>
            <div class="table-responsive">
                <table class="hafalan-table">
                    <thead>
                        <tr>
                            <th style="width: 70px;">No</th>
                            <th style="width: 240px;">Nama Siswa</th>
                            <th style="min-width: 220px;">
                                <span class="badge-label badge-terakhir">📖 Hafalan Terakhir (Surah)</span>
                            </th>
                            <th style="width: 140px;">
                                <span class="badge-label badge-terakhir">Ayat Terakhir</span>
                            </th>
                            <th style="min-width: 220px;">
                                <span class="badge-label badge-lanjut">🎯 Hafalan Lanjutan (Surah)</span>
                            </th>
                            <th style="width: 140px;">
                                <span class="badge-label badge-lanjut">Ayat Lanjutan</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $index => $siswa)
                        <tr>
                            <td>
                                <div class="number-badge">{{ $index + 1 }}</div>
                            </td>
                            <td>
                                <div class="student-name">{{ $siswa->nama_siswa }}</div>
                                <div class="student-desc">Kelas: {{ $siswa->rombel->tingkat_romawi ?? '-' }} {{ $siswa->rombel->nama_rombel ?? '' }}</div>
                                <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                            </td>

                            {{-- Surah Terakhir (dropdown per juz) --}}
                            <td>
                                @php
                                $surahByJuz = [
                                    'Juz 1' => ['Al-Fatihah', 'Al-Baqarah'],
                                    'Juz 2' => ['Al-Baqarah'],
                                    'Juz 3' => ['Al-Baqarah', 'Ali Imran'],
                                    'Juz 4' => ['Ali Imran', 'An-Nisa'],
                                    'Juz 5' => ['An-Nisa'],
                                    'Juz 6' => ['An-Nisa', 'Al-Maidah', 'Al-Anam'],
                                    'Juz 7' => ['Al-Anam', 'Al-Araf'],
                                    'Juz 8' => ['Al-Araf'],
                                    'Juz 9' => ['Al-Araf', 'Al-Anfal', 'At-Taubah'],
                                    'Juz 10' => ['At-Taubah', 'Yunus', 'Hud'],
                                    'Juz 11' => ['Hud', 'Yusuf'],
                                    'Juz 12' => ['Yusuf', 'Ar-Rad', 'Ibrahim'],
                                    'Juz 13' => ['Ibrahim', 'Al-Hijr', 'An-Nahl'],
                                    'Juz 14' => ['An-Nahl'],
                                    'Juz 15' => ['Al-Isra', 'Al-Kahfi'],
                                    'Juz 16' => ['Al-Kahfi', 'Maryam', 'Ta-Ha'],
                                    'Juz 17' => ['Al-Anbiya', 'Al-Hajj'],
                                    'Juz 18' => ['Al-Muminun', 'An-Nur', 'Al-Furqan'],
                                    'Juz 19' => ['Al-Furqan', 'Asy-Syuara', 'An-Naml'],
                                    'Juz 20' => ['An-Naml', 'Al-Qasas', 'Al-Ankabut'],
                                    'Juz 21' => ['Al-Ankabut', 'Ar-Rum', 'Luqman', 'As-Sajdah', 'Al-Ahzab'],
                                    'Juz 22' => ['Al-Ahzab', 'Saba', 'Fatir', 'Yasin'],
                                    'Juz 23' => ['Yasin', 'As-Saffat', 'Sad', 'Az-Zumar'],
                                    'Juz 24' => ['Az-Zumar', 'Ghafir', 'Fussilat'],
                                    'Juz 25' => ['Fussilat', 'Asy-Syura', 'Az-Zukhruf', 'Ad-Dukhan', 'Al-Jasiyah'],
                                    'Juz 26' => ['Al-Ahqaf', 'Muhammad', 'Al-Fath', 'Al-Hujurat', 'Qaf', 'Az-Zariyat'],
                                    'Juz 27' => ['Az-Zariyat', 'At-Tur', 'An-Najm', 'Al-Qamar', 'Ar-Rahman', 'Al-Waqiah', 'Al-Hadid'],
                                    'Juz 28' => ['Al-Mujadilah', 'Al-Hasyr', 'Al-Mumtahanah', 'As-Saff', 'Al-Jumuah', 'Al-Munafiqun', 'At-Tagabun', 'At-Talaq', 'At-Tahrim'],
                                    'Juz 29' => ['Al-Mulk', 'Al-Qalam', 'Al-Haqqah', 'Al-Maarij', 'Nuh', 'Al-Jinn', 'Al-Muzzammil', 'Al-Muddassir', 'Al-Qiyamah', 'Al-Insan', 'Al-Mursalat'],
                                    'Juz 30' => ['An-Naba', 'An-Naziat', 'Abasa', 'At-Takwir', 'Al-Infitar', 'Al-Mutaffifin', 'Al-Insyiqaq', 'Al-Buruj', 'At-Tariq', 'Al-Ala', 'Al-Gasyiyah', 'Al-Fajr', 'Al-Balad', 'Asy-Syams', 'Al-Lail', 'Ad-Duha', 'Asy-Syarh', 'At-Tin', 'Al-Alaq', 'Al-Qadr', 'Al-Bayyinah', 'Az-Zalzalah', 'Al-Adiyat', 'Al-Qariah', 'At-Takasur', 'Al-Asr', 'Al-Humazah', 'Al-Fil', 'Quraisy', 'Al-Maun', 'Al-Kausar', 'Al-Kafirun', 'An-Nasr', 'Al-Lahab', 'Al-Ikhlas', 'Al-Falaq', 'An-Nas']
                                ];
                                @endphp
                                <select name="surah_terakhir[]" class="form-input" required>
                                    <option value="">-- Pilih Surah --</option>
                                    @foreach($surahByJuz as $juz => $surahs)
                                        <optgroup label="{{ $juz }}">
                                            @foreach($surahs as $surah)
                                                <option value="{{ $surah }}" {{ ($hafalan[$siswa->id]->surah_terakhir ?? '') == $surah ? 'selected' : '' }}>
                                                    {{ $surah }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </td>

                            {{-- Ayat Terakhir --}}
                            <td>
                                <input type="text" name="ayat_terakhir[]" value="{{ $hafalan[$siswa->id]->ayat_terakhir ?? '' }}"
                                       placeholder="Contoh: 255" class="form-input" required>
                            </td>

                            {{-- Surah Lanjutan --}}
                            <td>
                                <select name="surah_lanjut[]" class="form-input" required>
                                    <option value="">-- Pilih Surah --</option>
                                    @foreach($surahByJuz as $juz => $surahs)
                                        <optgroup label="{{ $juz }}">
                                            @foreach($surahs as $surah)
                                                <option value="{{ $surah }}" {{ ($hafalan[$siswa->id]->surah_lanjut ?? '') == $surah ? 'selected' : '' }}>
                                                    {{ $surah }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </td>

                            {{-- Ayat Lanjutan --}}
                            <td>
                                <input type="text" name="ayat_lanjut[]" value="{{ $hafalan[$siswa->id]->ayat_lanjut ?? '' }}"
                                       placeholder="Contoh: 256" class="form-input" required>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-footer">
            <div class="footer-meta">
                📌 Total <strong>{{ $siswas->count() }}</strong> siswa akan diperbarui
            </div>
            <button type="submit" class="btn-submit">
                💾 Simpan Semua Hafalan
            </button>
        </div>
    </form>
</div>

@endsection