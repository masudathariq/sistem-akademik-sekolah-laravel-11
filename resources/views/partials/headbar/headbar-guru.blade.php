<header class="fixed top-0 left-0 right-0 h-16 bg-white/95 backdrop-blur-xl border-b border-slate-200/60 z-50 shadow-sm">
    <div class="flex items-center px-4 md:px-6 h-full">

        {{-- TOGGLE SIDEBAR (MOBILE) --}}
        <button id="toggleSidebar" class="md:hidden mr-3 p-2.5 rounded-xl hover:bg-slate-100 active:scale-95 transition-all duration-200 text-[#020659] group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- BRAND/LOGO --}}
        <div class="flex items-center gap-3">
            <div class="hidden md:flex w-10 h-10 bg-gradient-to-br from-[#020659] to-blue-700 rounded-xl items-center justify-center shadow-lg shadow-blue-900/30 ring-2 ring-blue-100">
                <span class="text-white text-xs font-black italic tracking-tighter">M1</span>
            </div>
            <div class="flex flex-col leading-none">
                <span class="font-black text-[#020659] uppercase tracking-tight text-xl italic">
                    Siakad<span class="text-blue-600 font-extrabold">Musata</span>
                </span>
                <span class="text-[9px] font-semibold text-slate-400 uppercase tracking-[0.15em] mt-1">SIAKAD v3.0</span>
            </div>
        </div>

        {{-- SPACER --}}
        <div class="flex-1"></div>

        {{-- ACTIONS & PROFILE --}}
        <div class="flex items-center gap-2 md:gap-3">


            {{-- NOTIFICATIONS --}}
@php
    $jumlahNotif = auth()->user()->unreadNotifications->count();
@endphp


<div class="relative">
    <button id="btnNotif"
        class="relative p-2.5 text-slate-400 hover:text-[#020659] hover:bg-slate-100 rounded-xl transition-all duration-200 group">

        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 group-hover:rotate-12 transition-transform"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2.5"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if($jumlahNotif > 0)
        <span class="absolute top-1.5 right-1.5 flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span
                class="relative inline-flex rounded-full h-4 w-4 bg-gradient-to-br from-red-500 to-pink-500 items-center justify-center text-[8px] font-black text-white shadow-lg">
                {{ $jumlahNotif }}
            </span>
        </span>
        @endif
    </button>

    {{-- DROPDOWN NOTIF --}}
<div id="notifMenu"
    class="hidden
           fixed md:absolute
           inset-x-0 md:inset-auto
           top-16 md:top-auto
           md:right-0
           w-full md:w-80
           bg-white
           md:rounded-2xl
           shadow-2xl shadow-slate-900/10
           border-t md:border border-slate-200/80
           overflow-hidden
           z-[999]">


        <div class="px-5 py-4 border-b bg-gradient-to-br from-slate-50 to-blue-50/30">
            <p class="text-sm font-black text-slate-800">Notifikasi</p>
        </div>

        <div class="max-h-80 overflow-y-auto">
            @forelse(auth()->user()->unreadNotifications as $notif)
                <a href="{{ route('guru.notif.read', $notif->id) }}"
                   class="block px-5 py-3 text-sm hover:bg-blue-50 transition-all duration-200 border-b last:border-0">
                    <p class="font-semibold text-slate-700">
                        {{ $notif->data['pesan'] ?? 'Slip gaji baru tersedia' }}
                    </p>
                    <p class="text-[10px] text-slate-400 mt-1">
                        {{ $notif->created_at->diffForHumans() }}
                    </p>
                </a>
            @empty
                <div class="px-5 py-6 text-center text-sm text-slate-400">
                    Tidak ada notifikasi
                </div>
            @endforelse
        </div>
    </div>
</div>


            {{-- SEPARATOR (Desktop Only) --}}
            <div class="hidden md:block w-px h-8 bg-slate-200"></div>

            {{-- PROFILE DROPDOWN --}}
            <div class="relative">
                <button id="btnProfile" class="flex items-center gap-2.5 p-1.5 pr-3 rounded-xl hover:bg-slate-50 transition-all duration-200 border-2 border-transparent hover:border-slate-100 active:scale-95 group">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guru') }}&background=020659&color=fff&bold=true&size=128"
                             class="w-9 h-9 rounded-xl object-cover shadow-md border-2 border-white ring-2 ring-slate-100 group-hover:ring-blue-200 transition-all">
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-gradient-to-br from-green-400 to-emerald-500 border-2 border-white rounded-full shadow-sm"></div>
                    </div>
                    <div class="hidden md:flex flex-col items-start leading-tight max-w-[120px]">
                        <span class="text-xs font-black text-slate-800 uppercase italic truncate w-full">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                        <span class="text-[10px] font-semibold text-slate-400 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                            Online
                        </span>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 group-hover:translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- DROPDOWN MENU --}}
                <div id="profileMenu"
                     class="hidden absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-2xl shadow-slate-900/10 border border-slate-200/80 overflow-hidden">
                    
                    {{-- USER INFO HEADER --}}
                    <div class="px-5 py-4 bg-gradient-to-br from-slate-50 to-blue-50/30 border-b border-slate-100">
                        <div class="flex items-center gap-3 mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guru') }}&background=020659&color=fff&bold=true&size=128"
                                 class="w-12 h-12 rounded-xl object-cover shadow-md border-2 border-white">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-black text-slate-800 truncate">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                                <p class="text-xs font-semibold text-slate-500">Guru Aktif</p>
                            </div>
                        </div>
                        <p class="text-[11px] font-medium text-slate-500 truncate bg-white/60 px-3 py-1.5 rounded-lg border border-slate-200/50">
                            📧 {{ Auth::user()->email ?? 'guru@sekolah.com' }}
                        </p>
                    </div>

                    {{-- MENU ITEMS --}}
                    <div class="py-2">
                        <a href="{{ route('guru.profile.index') }}"
                           class="flex items-center gap-3 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent hover:text-[#020659] transition-all duration-200 group">
                            <span class="flex items-center justify-center w-9 h-9 bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600 rounded-xl group-hover:scale-110 group-hover:shadow-md transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <div class="flex-1">
                                <p class="font-bold">Profil Saya</p>
                                <p class="text-[10px] text-slate-400 font-medium">Kelola akun Anda</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                    </div>

                    {{-- DIVIDER --}}
                    <div class="border-t border-slate-100"></div>

                    {{-- LOGOUT BUTTON --}}
                    <div class="p-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center gap-3 px-5 py-3 text-sm font-bold text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent rounded-xl transition-all duration-200 group">
                                <span class="flex items-center justify-center w-9 h-9 bg-gradient-to-br from-red-100 to-red-50 text-red-600 rounded-xl group-hover:scale-110 group-hover:shadow-md transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </span>
                                <span>Keluar Sistem</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Profile Menu Toggle - Mengikuti kode yang sudah berhasil
    const btnProfile = document.getElementById('btnProfile');
    const profileMenu = document.getElementById('profileMenu');

    // Toggle menu
    btnProfile?.addEventListener('click', (e) => {
        e.stopPropagation();
        profileMenu.classList.toggle('hidden');
    });

    // Close menu saat klik di luar
    document.addEventListener('click', () => {
        profileMenu?.classList.add('hidden');
    });

    // Keyboard shortcut untuk search (Cmd/Ctrl + K)
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            // Tambahkan logika search modal di sini
            console.log('Search triggered');
        }
    });

    // Notif Toggle
const btnNotif = document.getElementById('btnNotif');
const notifMenu = document.getElementById('notifMenu');

btnNotif?.addEventListener('click', (e) => {
    e.stopPropagation();
    notifMenu.classList.toggle('hidden');
});

document.addEventListener('click', () => {
    notifMenu?.classList.add('hidden');
});

</script>