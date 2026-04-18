<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Staff TU')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    @stack('scripts')
</head>
<body class="bg-slate-100 min-h-screen">


<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('partials.sidebar.sidebar-staff_tu')

    {{-- AREA KANAN --}}
    <div class="flex-1 flex flex-col min-h-screen">

        {{-- HEADER --}}
        @include('partials.headbar.headbar-staff_tu')

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto p-4 sm:p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
