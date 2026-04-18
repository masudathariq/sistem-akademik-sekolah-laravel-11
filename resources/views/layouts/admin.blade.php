<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('partials.sidebar.sidebar-admin')
        
        {{-- Content --}}
        <div class="flex-1 flex flex-col">

            {{-- Headbar --}}
            @include('layouts.headbar')

            <main class="p-6 flex-1 overflow-auto">
                @yield('content')
            </main>

        </div>
    </div>
</body>
</html>