@extends('layouts.kepsek')

@section('title', 'Dashboard Kepala Sekolah')

@section('content')

<style>
    .ks-page {
        padding: 1rem;
        background: #f8fafc;
        min-height: 100vh;
    }

    .ks-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        color: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 10px 25px rgba(30,58,138,.2);
    }

    .ks-hero h1 {
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: .3rem;
    }

    .ks-hero p {
        font-size: .85rem;
        opacity: .85;
        margin: 0;
    }

    .ks-box {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .ks-box h2 {
        font-size: .95rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: .7rem;
    }

    .ks-info {
        font-size: .85rem;
        color: #64748b;
        line-height: 1.7;
        margin: 0;
    }

    .ks-menu {
        display: grid;
        gap: .75rem;
        grid-template-columns: repeat(auto-fit,minmax(180px,1fr));
    }

    .ks-menu a {
        display: block;
        padding: .75rem .9rem;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        text-decoration: none;
        font-size: .82rem;
        font-weight: 600;
        color: #334155;
        transition: .15s;
    }

    .ks-menu a:hover {
        background: #e2e8f0;
    }

    @media (min-width:768px){
        .ks-page { padding: 1.5rem; }
        .ks-hero { padding: 1.75rem 2rem; }
    }
</style>

<div class="ks-page">

    {{-- HERO --}}
    <div class="ks-hero">
        <h1>Dashboard Kepala Sekolah</h1>
        <p>
            Selamat datang, {{ auth()->user()->name }} 👋 <br>
            Gunakan halaman ini untuk mengakses informasi penting sekolah.
        </p>
    </div>

    {{-- INFORMASI --}}
    <div class="ks-box">
        <h2>Informasi</h2>
        <p class="ks-info">
            Dashboard Kepala Sekolah berfungsi sebagai pusat informasi dan kontrol.
            Anda dapat melihat laporan akademik, data guru, data siswa, serta perkembangan sekolah
            melalui menu yang tersedia.
        </p>
    </div>

    {{-- MENU CEPAT --}}
    <div class="ks-box">
        <h2>Menu Cepat</h2>

        <div class="ks-menu">
            <a href="#">📊 Laporan Akademik</a>
            <a href="#">👨‍🏫 Data Guru</a>
            <a href="#">🎓 Data Siswa</a>
            <a href="#">🏫 Data Rombel</a>
        </div>
    </div>

    {{-- CATATAN --}}
    <div class="ks-box">
        <h2>Catatan</h2>
        <p class="ks-info">
            Sistem ini dirancang untuk membantu Kepala Sekolah memantau aktivitas sekolah secara lebih mudah.
            Fitur tambahan seperti grafik, absensi, dan laporan keuangan dapat ditambahkan secara bertahap.
        </p>
    </div>

</div>

@endsection
