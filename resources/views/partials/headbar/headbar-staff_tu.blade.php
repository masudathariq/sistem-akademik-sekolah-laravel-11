<header class="sticky top-0 z-40 h-16 bg-white/80 backdrop-blur-md border-b
               flex items-center justify-between
               px-4 sm:px-6">

    {{-- LEFT --}}
    <div class="flex items-center gap-4">

        {{-- BUTTON SIDEBAR (MOBILE) --}}
        <button onclick="toggleSidebar()"
                class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 text-gray-700"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- PAGE TITLE --}}
        <h1 class="text-lg font-semibold text-gray-800 tracking-tight">
            @yield('page-title', 'Dashboard')
        </h1>

    </div>

    {{-- RIGHT --}}
    <div class="flex items-center gap-4">

        {{-- USER INFO --}}
        <div class="hidden sm:flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-blue-600
                        flex items-center justify-center
                        text-white font-semibold text-sm shadow">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="leading-tight">
                <p class="text-sm font-medium text-gray-800">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-500">
                    Staff Tata Usaha
                </p>
            </div>
        </div>

        {{-- LOGOUT BUTTON --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="px-4 py-2 text-sm font-medium
                       text-red-600 bg-red-50
                       rounded-lg hover:bg-red-100
                       transition">
                Keluar
            </button>
        </form>

    </div>

</header>
