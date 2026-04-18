<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Guru Panel')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    {{-- HEADBAR (FIXED ATAS) --}}
    @include('partials.headbar.headbar-guru')

    <div class="flex">

        {{-- SIDEBAR --}}
        @include('partials.sidebar.sidebar-guru')

        {{-- CONTENT --}}
        <div class="flex-1 min-h-screen
                    pt-14
                    ml-0 md:ml-64">

            <main class="p-4 md:p-6">
                @yield('content')
            </main>

        </div>
    </div>

    {{-- TOGGLE SIDEBAR MOBILE --}}
    <script>
        const btn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        btn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>

</body>
</html>
