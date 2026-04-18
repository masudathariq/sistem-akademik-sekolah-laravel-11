<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Bendahara')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    {{-- Alpine.js (pastikan sudah include via Vite atau CDN) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">

{{-- 
    x-data di sini sebagai "root" state untuk sidebar mobile.
    sidebarOpen: false → sidebar tertutup by default di mobile.
    Listen event 'toggle-sidebar' yang di-dispatch dari tombol hamburger di header.
--}}
<div 
    class="flex min-h-screen"
    x-data="{ sidebarOpen: false }"
    @toggle-sidebar.window="sidebarOpen = !sidebarOpen">

    {{-- ===================== SIDEBAR ===================== --}}
    @include('partials.sidebar.sidebar-bendahara')

    {{-- ===================== CONTENT AREA ===================== --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Topbar / Header --}}
        @include('partials.headbar.headbar-bendahara')

        {{-- Main Content --}}
        <main class="p-4 sm:p-6 flex-1">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>