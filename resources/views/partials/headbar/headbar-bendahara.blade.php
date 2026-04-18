<header 
    class="sticky top-0 z-40 h-16
           bg-white/90 backdrop-blur
           border-b flex items-center justify-between
           px-4 sm:px-6">

    {{-- LEFT --}}
    <div class="flex items-center gap-4">

        {{-- BUTTON HAMBURGER (MOBILE) --}}
        {{-- Dispatch event 'toggle-sidebar' ke window, ditangkap oleh x-data di layout --}}
        <button 
            @click="$dispatch('toggle-sidebar')"
            class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition"
            aria-label="Toggle sidebar">
            
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
    <div class="flex items-center gap-3">

        {{-- USER NAME (hidden di mobile kecil) --}}
        <span class="hidden sm:inline text-sm text-gray-600">
            {{ auth()->user()->name ?? 'Bendahara' }}
        </span>

        {{-- LOGOUT BUTTON --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="px-3 sm:px-4 py-2 text-sm font-medium
                       text-red-600 bg-red-50
                       rounded-lg
                       hover:bg-red-100
                       transition duration-200">
                Logout
            </button>
        </form>

    </div>

</header>