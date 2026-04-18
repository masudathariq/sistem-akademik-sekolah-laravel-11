@extends('layouts.guru')

@section('title', 'Slip Gaji Saya')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');

    :root {
        --navy: #020659;
        --navy-light: #1a237e;
        --gray-50: #F8FAFC;
        --gray-100: #F1F5F9;
        --gray-200: #E2E8F0;
        --gray-400: #94A3B8;
        --gray-500: #64748B;
        --gray-700: #334155;
        --gray-800: #1E293B;
        --gray-900: #0F172A;
        --blue: #2563EB;
        --blue-light: #EFF6FF;
        --green: #059669;
        --green-light: #ECFDF5;
        --red: #DC2626;
        --red-light: #FEF2F2;
        --radius-sm: 10px;
        --radius-md: 14px;
        --radius-lg: 20px;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.06), 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Nunito', sans-serif;
        background: var(--gray-50);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ======================================================
   MOBILE FIRST
   ====================================================== */

    .page-wrap {
        padding: 0;
        max-width: 100%;
        padding-bottom: 40px;
    }

    /* ---- HERO ---- */
    .hero-card {
        background: linear-gradient(135deg, var(--navy) 0%, #1a237e 60%, #283593 100%);
        padding: 20px 16px 28px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-card::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
    }

    .hero-card::after {
        content: '';
        position: absolute;
        bottom: -30px;
        left: -20px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
    }

    .hero-sub {
        font-size: 11px;
        opacity: 0.7;
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 20px;
        font-weight: 800;
        margin: 2px 0 4px;
        position: relative;
        z-index: 1;
    }

    .hero-desc {
        font-size: 12px;
        opacity: 0.8;
        position: relative;
        z-index: 1;
    }

    /* ---- BODY ---- */
    .page-body {
        padding: 14px 12px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* ---- SECTION TITLE ---- */
    .section-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--gray-700);
        margin: 0 0 10px 2px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ---- STAT CARDS ---- */
    .stat-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        animation: slideUp 0.4s ease 0.05s both;
    }

    .stat-card {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 14px 12px;
        box-shadow: var(--shadow-sm);
    }

    .stat-label {
        font-size: 10px;
        font-weight: 700;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 4px;
    }

    .stat-val {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 22px;
        font-weight: 800;
        color: var(--navy);
    }

    .stat-val.small {
        font-size: 14px;
    }

    /* ---- INFO BANNER ---- */
    .info-banner {
        background: var(--blue-light);
        border: 1.5px solid #BFDBFE;
        border-left: 4px solid var(--blue);
        border-radius: var(--radius-md);
        padding: 14px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        animation: slideUp 0.4s ease 0.08s both;
    }

    .info-banner svg {
        width: 18px;
        height: 18px;
        color: var(--blue);
        flex-shrink: 0;
        margin-top: 1px;
    }

    .info-banner-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: #1e40af;
        margin-bottom: 6px;
    }

    .info-banner ul {
        padding-left: 0;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .info-banner li {
        font-size: 12px;
        color: #1d4ed8;
        display: flex;
        align-items: flex-start;
        gap: 6px;
    }

    .info-banner li::before {
        content: '•';
        flex-shrink: 0;
    }

    /* ---- PAGINATION INFO ---- */
    .pagination-info {
        background: white;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-sm);
        padding: 10px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        color: var(--gray-500);
        box-shadow: var(--shadow-sm);
    }

    .pagination-info strong {
        color: var(--gray-800);
        font-weight: 700;
    }

    /* ---- SLIP CARDS ---- */
    .slip-grid {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .slip-card {
        background: white;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        border: 2px solid var(--gray-200);
        animation: slideUp 0.4s ease both;
        transition: transform 0.18s, box-shadow 0.18s;
    }

    .slip-card.unread {
        border-color: var(--green);
    }

    .slip-card:nth-child(1) {
        animation-delay: 0.03s;
    }

    .slip-card:nth-child(2) {
        animation-delay: 0.06s;
    }

    .slip-card:nth-child(3) {
        animation-delay: 0.09s;
    }

    .slip-card:nth-child(n+4) {
        animation-delay: 0.12s;
    }

    /* Card header */
    .slip-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        padding: 14px 14px 12px;
        border-bottom: 1px solid var(--gray-100);
        background: var(--gray-50);
    }

    .slip-period-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .slip-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        background: var(--blue-light);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .slip-icon svg {
        width: 20px;
        height: 20px;
        color: var(--blue);
    }

    .slip-period {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 15px;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 2px;
    }

    .slip-date {
        font-size: 11px;
        color: var(--gray-400);
    }

    .badge-baru {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--green-light);
        color: var(--green);
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 99px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .badge-baru svg {
        width: 12px;
        height: 12px;
    }

    /* Card body: ringkasan */
    .slip-ringkasan {
        padding: 12px 14px;
        background: var(--gray-50);
        display: flex;
        flex-direction: column;
        gap: 6px;
        border-bottom: 1px solid var(--gray-100);
        margin: 0 14px 0;
    }

    .ringkasan-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .ringkasan-label {
        font-size: 12px;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ringkasan-label svg {
        width: 13px;
        height: 13px;
        color: var(--gray-400);
        flex-shrink: 0;
    }

    .ringkasan-val {
        font-size: 12px;
        font-weight: 700;
        color: var(--gray-800);
    }

    .ringkasan-val.plus {
        color: var(--green);
    }

    .ringkasan-val.minus {
        color: var(--red);
    }

    /* Card body: total */
    .slip-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 14px;
        border-top: 2px solid var(--gray-200);
        margin: 12px 14px 0;
    }

    .slip-total-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 800;
        color: var(--gray-800);
    }

    .slip-total-val {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 17px;
        font-weight: 800;
        color: var(--blue);
    }

    /* Card footer: action */
    .slip-action {
        padding: 12px 14px;
    }

    .btn-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 11px;
        background: linear-gradient(135deg, var(--navy), #1a237e);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: opacity 0.15s;
        box-shadow: 0 3px 10px rgba(2, 6, 89, 0.25);
    }

    .btn-detail:hover {
        opacity: 0.9;
        color: white;
        text-decoration: none;
    }

    .btn-detail svg {
        width: 16px;
        height: 16px;
    }

    /* ---- EMPTY STATE ---- */
    .empty-state {
        background: white;
        border: 2px dashed var(--gray-200);
        border-radius: var(--radius-md);
        padding: 60px 24px;
        text-align: center;
        animation: slideUp 0.35s ease both;
    }

    .empty-icon-wrap {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .empty-icon-wrap svg {
        width: 32px;
        height: 32px;
        color: var(--gray-400);
    }

    .empty-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: var(--gray-700);
        margin-bottom: 8px;
    }

    .empty-desc {
        font-size: 13px;
        color: var(--gray-500);
        line-height: 1.65;
    }

    /* ======================================================
   DESKTOP ≥768px
   ====================================================== */
    @media (min-width: 768px) {

        .page-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px 48px;
        }

        /* Hero */
        .hero-card {
            border-radius: var(--radius-lg);
            margin: 24px 0 0;
            padding: 32px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .hero-card::before {
            width: 260px;
            height: 260px;
            top: -80px;
            right: -60px;
        }

        .hero-sub {
            font-size: 13px;
        }

        .hero-title {
            font-size: 28px;
        }

        .hero-desc {
            font-size: 14px;
        }

        /* Body */
        .page-body {
            padding: 24px 0;
            gap: 16px;
        }

        .section-title {
            font-size: 15px;
        }

        /* Stats: 4 cols */
        .stat-row {
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .stat-card {
            padding: 18px 16px;
            border-radius: var(--radius-lg);
        }

        .stat-val {
            font-size: 28px;
        }

        .stat-val.small {
            font-size: 16px;
        }

        /* Info banner */
        .info-banner {
            padding: 16px 20px;
            border-radius: var(--radius-lg);
        }

        .info-banner svg {
            width: 20px;
            height: 20px;
        }

        .info-banner li {
            font-size: 13px;
        }

        /* Slip grid: 2–3 cols */
        .slip-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .slip-card {
            border-radius: var(--radius-lg);
        }

        .slip-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .slip-card-header {
            padding: 16px 18px 14px;
        }

        .slip-icon {
            width: 44px;
            height: 44px;
        }

        .slip-icon svg {
            width: 22px;
            height: 22px;
        }

        .slip-period {
            font-size: 16px;
        }

        .slip-ringkasan {
            padding: 12px 18px;
            margin: 0 18px;
            gap: 8px;
        }

        .ringkasan-label {
            font-size: 13px;
        }

        .ringkasan-val {
            font-size: 13px;
        }

        .slip-total {
            padding: 14px 18px;
            margin: 12px 18px 0;
        }

        .slip-total-val {
            font-size: 19px;
        }

        .slip-action {
            padding: 12px 18px;
        }

        .btn-detail {
            font-size: 14px;
            padding: 12px;
        }

        /* Empty: span full */
        .empty-state {
            grid-column: 1 / -1;
            border-radius: var(--radius-lg);
            padding: 80px 40px;
        }
    }

    @media (min-width: 1024px) {
        .slip-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        overscroll-behavior-y: none;
    }
</style>

<div class="page-wrap">

    {{-- ===== HERO ===== --}}
    <div class="hero-card">
        <div>
            <div class="hero-sub">Dashboard Guru</div>
            <div class="hero-title">💰 Slip Gaji Saya</div>
            <div class="hero-desc">Riwayat pembayaran gaji bulanan Anda</div>
        </div>
    </div>

    <div class="page-body">

        {{-- ===== STATISTIK ===== --}}
        @if($slipGaji->total() > 0)
        @php
        $guruId = auth()->user()->guru->id;
        $sudahDibaca = \App\Models\Bendahara\SlipGajiTerkirim::where('guru_id',$guruId)->where('sudah_dibaca',true)->count();
        $belumDibaca = \App\Models\Bendahara\SlipGajiTerkirim::where('guru_id',$guruId)->where('sudah_dibaca',false)->count();
        $rataGaji = \App\Models\Bendahara\SlipGajiTerkirim::where('guru_id',$guruId)->avg('total_gaji') ?? 0;
        @endphp
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-label">Total Slip</div>
                <div class="stat-val">{{ $slipGaji->total() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Sudah Dibaca</div>
                <div class="stat-val">{{ $sudahDibaca }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Belum Dibaca</div>
                <div class="stat-val {{ $belumDibaca > 0 ? 'text-green' : 'text-navy' }}">
                    {{ $belumDibaca }}
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Rata-rata Gaji</div>
                <div class="stat-val small">Rp {{ number_format($rataGaji, 0, ',', '.') }}</div>
            </div>
        </div>
        @endif

        {{-- ===== INFO BANNER ===== --}}
        <div class="info-banner">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <div class="info-banner-title">Tentang Slip Gaji</div>
                <ul>
                    <li>Slip gaji dikirim setiap bulan oleh bendahara sekolah</li>
                    <li>Klik "Lihat Detail" untuk melihat rincian lengkap gaji Anda</li>
                    <li>Slip baru akan ditandai dengan badge hijau "Baru"</li>
                    <li>Anda dapat mengunduh slip gaji dalam format PDF</li>
                </ul>
            </div>
        </div>

        {{-- ===== PAGINATION INFO ===== --}}
        @if($slipGaji->hasPages())
        <div class="pagination-info">
            <span>
                Menampilkan <strong>{{ $slipGaji->firstItem() ?? 0 }}</strong>
                – <strong>{{ $slipGaji->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $slipGaji->total() }}</strong> slip
            </span>
            <span>Hal. {{ $slipGaji->currentPage() }} / {{ $slipGaji->lastPage() }}</span>
        </div>
        @endif

        {{-- ===== DAFTAR SLIP ===== --}}
        <div class="slip-grid">
            @forelse($slipGaji as $slip)

            <div class="slip-card {{ $slip->sudah_dibaca ? '' : 'unread' }}">

                {{-- Header --}}
                <div class="slip-card-header">
                    <div class="slip-period-wrap">
                        <div class="slip-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="slip-period">
                                {{ \Carbon\Carbon::create(null, $slip->bulan, 1)->translatedFormat('F') }} {{ $slip->tahun }}
                            </div>
                            <div class="slip-date">
                                {{ $slip->created_at->translatedFormat('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>

                    @if(!$slip->sudah_dibaca)
                    <span class="badge-baru">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                        </svg>
                        Baru
                    </span>
                    @endif
                </div>

                {{-- Ringkasan --}}
                <div style="padding: 12px 14px 0;">
                    <div style="background:var(--gray-50); border-radius:var(--radius-sm); padding:12px; display:flex; flex-direction:column; gap:7px;">
                        <div class="ringkasan-row">
                            <span class="ringkasan-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Gaji Pokok
                            </span>
                            <span class="ringkasan-val">Rp {{ number_format($slip->gaji_pokok, 0, ',', '.') }}</span>
                        </div>

                        <div class="ringkasan-row">
                            <span class="ringkasan-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                                Transport
                            </span>
                            <span class="ringkasan-val plus">+ Rp {{ number_format($slip->transport, 0, ',', '.') }}</span>
                        </div>

                        @if($slip->total_penambahan > 0)
                        <div class="ringkasan-row">
                            <span class="ringkasan-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tunjangan
                            </span>
                            <span class="ringkasan-val plus">+ Rp {{ number_format($slip->total_penambahan, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        @if($slip->total_pengurangan > 0)
                        <div class="ringkasan-row">
                            <span class="ringkasan-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                                Potongan
                            </span>
                            <span class="ringkasan-val minus">- Rp {{ number_format($slip->total_pengurangan, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Total --}}
                <div class="slip-total">
                    <span class="slip-total-label">Total Gaji</span>
                    <span class="slip-total-val">Rp {{ number_format($slip->total_gaji, 0, ',', '.') }}</span>
                </div>

                {{-- Action --}}
                <div class="slip-action">
                    <a href="{{ route('guru.slip-gaji.show', $slip->id) }}" class="btn-detail">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Detail
                    </a>
                </div>

            </div>

            @empty
            <div class="empty-state">
                <div class="empty-icon-wrap">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="empty-title">Belum Ada Slip Gaji</div>
                <div class="empty-desc">
                    Slip gaji akan muncul di sini setelah<br>
                    bendahara sekolah mengirimkannya setiap bulan.
                </div>
            </div>
            @endforelse
        </div>

        {{-- ===== PAGINATION ===== --}}
        @if($slipGaji->hasPages())
        <div style="margin-top:4px;">
            {{ $slipGaji->links() }}
        </div>
        @endif

    </div>
</div>

@endsection