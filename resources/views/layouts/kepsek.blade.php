<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kepala Sekolah')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            margin: 0;
        }

        /* ===== HEADER ===== */
        .ks-header {
            height: 64px;
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.12);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .ks-title {
            font-size: .95rem;
            font-weight: 700;
        }

        /* ===== WRAPPER ===== */
        .ks-layout {
            display: flex;
            min-height: calc(100vh - 64px);
        }

        /* ===== SIDEBAR ===== */
        .ks-sidebar {
            width: 230px;
            background: #fff;
            border-right: 1px solid #e2e8f0;
            padding: 1rem;
            display: none;
        }

        .ks-sidebar a {
            display: block;
            padding: .7rem .8rem;
            border-radius: 10px;
            font-size: .85rem;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            margin-bottom: .35rem;
            transition: .15s;
        }

        .ks-sidebar a:hover {
            background: #eff6ff;
            color: #1e3a8a;
        }

        .ks-sidebar a.active {
            background: #dbeafe;
            color: #1e3a8a;
        }

        /* ===== CONTENT ===== */
        .ks-content {
            flex: 1;
            min-width: 0;
        }

        /* MOBILE MENU BUTTON */
        .menu-btn {
            background: rgba(255,255,255,.15);
            border: none;
            color: white;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* MOBILE SIDEBAR */
        .mobile-sidebar {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 50;
            display: none;
        }

        .mobile-sidebar.show {
            display: block;
        }

        .mobile-panel {
            width: 240px;
            height: 100%;
            background: #fff;
            padding: 1rem;
        }

        .mobile-panel a {
            display: block;
            padding: .7rem .8rem;
            border-radius: 10px;
            font-size: .85rem;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            margin-bottom: .35rem;
        }

        .mobile-panel a:hover {
            background: #eff6ff;
            color: #1e3a8a;
        }

        /* DESKTOP */
        @media (min-width: 1024px) {
            .ks-sidebar {
                display: block;
            }
            .menu-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <header class="ks-header">
        <div class="flex items-center gap-3">
            <button class="menu-btn" onclick="openSidebar()">
                ☰
            </button>
            <div class="ks-title">
                Dashboard Kepala Sekolah
            </div>
        </div>

        <div class="text-sm font-medium">
            {{ auth()->user()->name }}
        </div>
    </header>

    {{-- MOBILE SIDEBAR --}}
    <div id="mobileSidebar" class="mobile-sidebar" onclick="closeSidebar()">
        <div class="mobile-panel" onclick="event.stopPropagation()">
            <a href="{{ route('kepsek.dashboard') }}">🏠 Dashboard</a>
            <a href="#">📊 Laporan</a>
            <a href="#">👨‍🏫 Data Guru</a>
            <a href="#">🎓 Data Siswa</a>

            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full text-left px-3 py-2 rounded-lg bg-red-50 text-red-600 font-semibold">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>

    <div class="ks-layout">

        {{-- DESKTOP SIDEBAR --}}
        <aside class="ks-sidebar">
            <a href="{{ route('kepsek.dashboard') }}" class="active">🏠 Dashboard</a>
            <a href="#">📊 Laporan</a>
            <a href="#">👨‍🏫 Data Guru</a>
            <a href="#">🎓 Data Siswa</a>

            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full text-left px-3 py-2 rounded-lg bg-red-50 text-red-600 font-semibold">
                    🚪 Logout
                </button>
            </form>
        </aside>

        {{-- CONTENT --}}
        <main class="ks-content">
            @yield('content')
        </main>

    </div>

    <script>
        function openSidebar() {
            document.getElementById('mobileSidebar').classList.add('show');
        }

        function closeSidebar() {
            document.getElementById('mobileSidebar').classList.remove('show');
        }
    </script>

</body>
</html>
