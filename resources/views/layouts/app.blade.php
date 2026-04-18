<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-gray-100 font-sans">

    {{-- Sidebar --}}
    @php
        $role = auth()->user()->role;
    @endphp
    @includeIf("layouts.sidebar.$role")

    {{-- Main content --}}
    <div class="flex-1 flex flex-col">

        {{-- Header --}}
        @include('layouts.headbar')

        {{-- Page content --}}
        <main class="p-6 flex-1 overflow-auto bg-gray-100">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('layouts.footer')

    </div>

</body>
</html>
