<aside class="w-64 bg-gradient-to-b from-blue-900 to-indigo-900 text-white min-h-screen shadow-lg">

    <!-- Brand -->
    <div class="flex items-center justify-center h-16 border-b border-blue-800">
        <span class="text-lg font-bold tracking-wide">ADMIN SIAKAD MUSATA</span>
    </div>

    <nav class="px-4 py-4 text-sm">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-md font-medium transition
           {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/>
            </svg>
            Dashboard
        </a>

        <!-- Divider -->
        <div class="border-t border-blue-800 my-4"></div>

        <!-- Heading -->
        <p class="px-4 text-xs uppercase tracking-widest text-blue-300 mb-2">
            Master Data
        </p>

        <!-- User -->
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-md transition
           {{ request()->routeIs('admin.users.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.121 17.804A9 9 0 1118 21H6a1 1 0 01-.879-1.196z"/>
            </svg>
            Data User
        </a>

        <!-- Guru -->
        <a href="{{ route('admin.guru.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-md transition
           {{ request()->routeIs('admin.guru.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14l9-5-9-5-9 5 9 5z"/>
            </svg>
            Data Guru
        </a>

        <!-- Dropdown Absen Guru -->
        <div 
            x-data="{ 
                open: {{ request()->routeIs('admin.jadwal.*') 
                        || request()->routeIs('admin.jadwal-harian.*') 
                        || request()->routeIs('admin.absensi.*') 
                        ? 'true' : 'false' }} 
            }"
            class="mt-2"
        >
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-4 py-2 rounded-md transition
                hover:bg-white/10">

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8 7V3m8 4V3m-9 8h10"/>
                    </svg>
                    Absen Guru
                </div>

                <svg :class="{'rotate-180': open}"
                     class="w-4 h-4 transition-transform duration-300"
                     fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-transition class="mt-1 space-y-1 ml-8 text-sm">
                <a href="{{ route('admin.jadwal.index') }}"
                   class="block px-3 py-2 rounded-md transition
                   {{ request()->routeIs('admin.jadwal.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    Jadwal Guru
                </a>

                <a href="{{ route('admin.jadwal-harian.index') }}"
                   class="block px-3 py-2 rounded-md transition
                   {{ request()->routeIs('admin.jadwal-harian.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    Jadwal Harian
                </a>

                <a href="{{ route('admin.absensi.setting') }}"
                   class="block px-3 py-2 rounded-md transition
                   {{ request()->routeIs('admin.absensi.setting') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    Setting Waktu
                </a>

                <a href="{{ route('admin.absensi.rekap') }}"
                   class="block px-3 py-2 rounded-md transition
                   {{ request()->routeIs('admin.absensi.rekap') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    Rekap Absen
                </a>

                <a href="{{ route('admin.absensi.rekap.per-guru') }}"
                   class="block px-3 py-2 rounded-md transition
                   {{ request()->routeIs('admin.absensi.rekap.per-guru') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    Rekap Absen PerGuru
                </a>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-blue-800 my-4"></div>

        <!-- Rombel -->
        <a href="{{ route('admin.rombel-kategori.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-md transition
           {{ request()->routeIs('admin.rombel-kategori.*') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                 stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            Rombel Aktif
        </a>

    </nav>
</aside>