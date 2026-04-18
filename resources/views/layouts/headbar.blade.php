<header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">

    <!-- Left: Title -->
    <div>
        <h1 class="text-xl font-semibold text-gray-800 tracking-tight">
            @yield('header', 'Dashboard')
        </h1>
        <p class="text-sm text-gray-500">
            Selamat datang kembali di sistem
        </p>
    </div>

    <!-- Right: User Info -->
    <div class="flex items-center gap-4">

        <!-- User Badge -->
        <div class="flex items-center gap-3 bg-gray-100 px-3 py-2 rounded-lg">
            <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-semibold">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
            <div class="text-sm">
                <p class="font-medium text-gray-800 leading-none">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-500">
                    Administrator
                </p>
            </div>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-red-600 
                       border border-red-200 rounded-lg
                       hover:bg-red-50 hover:border-red-300
                       transition duration-200">
                Logout
            </button>
        </form>

    </div>
</header>