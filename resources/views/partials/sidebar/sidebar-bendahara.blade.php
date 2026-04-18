{{-- 
    SIDEBAR BENDAHARA - MOBILE FRIENDLY
    
    Di desktop (lg+): sidebar selalu tampil (translate-x-0), tidak bisa disembunyikan.
    Di mobile (<lg): sidebar awalnya tersembunyi (translate-x-full/-translate-x-full),
    muncul saat sidebarOpen = true (di-toggle dari tombol hamburger di header).
    
    State 'sidebarOpen' dikelola di parent layout via x-data.
--}}

{{-- OVERLAY (hanya mobile, muncul saat sidebar terbuka) --}}
<div 
    x-show="sidebarOpen"
    @click="sidebarOpen = false"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 bg-black/50 lg:hidden"
    style="display: none;"
    aria-hidden="true">
</div>

{{-- SIDEBAR PANEL --}}
<aside 
    class="
        {{-- Desktop: selalu tampil, ikut flow normal --}}
        lg:relative lg:translate-x-0 lg:flex lg:flex-shrink-0

        {{-- Mobile: posisi fixed, toggle dengan sidebarOpen --}}
        fixed inset-y-0 left-0 z-50
        
        w-64 bg-blue-700 text-white flex flex-col shadow-lg

        {{-- Transisi geser --}}
        transition-transform duration-300 ease-in-out
    "
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

    {{-- ===== HEADER SIDEBAR ===== --}}
    <div class="p-6 text-center border-b border-blue-600 bg-blue-800 relative flex-shrink-0">
        <h2 class="text-xl font-bold tracking-wide">Bendahara</h2>
        <p class="text-sm text-blue-200 mt-1">Panel Keuangan</p>

        {{-- Tombol CLOSE (mobile only) --}}
        <button 
            @click="sidebarOpen = false" 
            class="absolute top-4 right-4 p-1 rounded-lg hover:bg-blue-700 transition lg:hidden"
            aria-label="Tutup sidebar">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- ===== NAV ===== --}}
    <nav class="flex-1 px-3 py-5 space-y-1 text-sm overflow-y-auto">

        {{-- Dashboard --}}
        <a href="{{ route('bendahara.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition-all duration-200
                   {{ request()->routeIs('bendahara.dashboard') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
            <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Dashboard
        </a>

        {{-- DROPDOWN: TRANSAKSI --}}
        <div class="dropdown-menu">
            <button onclick="toggleDropdown('transaksi')" 
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition-all duration-200">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Transaksi</span>
                </div>
                <svg id="transaksi-icon" class="w-4 h-4 transform transition-transform duration-300 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="transaksi" class="hidden ml-6 mt-1 space-y-1 pl-2 border-l-2 border-blue-500">
                <a href="#" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.pemasukan.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Pemasukan
                </a>
                <a href="#" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.pengeluaran.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Pengeluaran
                </a>
            </div>
        </div>

        {{-- Laporan Absensi --}}
        <a href="{{ route('bendahara.rekap') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition-all duration-200
                   {{ request()->routeIs('bendahara.rekap.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
            <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Laporan Absensi
        </a>

        {{-- Divider --}}
        <div class="my-4 border-t border-blue-600"></div>

        {{-- DROPDOWN: MANAJEMEN PENGGAJIAN --}}
        <div class="dropdown-menu">
            <button onclick="toggleDropdown('penggajian')" 
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition-all duration-200">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0V8a2 2 0 01-2 2H8a2 2 0 01-2-2V6m8 0H8"/>
                    </svg>
                    <span>Manajemen Penggajian</span>
                </div>
                <svg id="penggajian-icon" class="w-4 h-4 transform transition-transform duration-300 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div id="penggajian" class="hidden ml-6 mt-1 space-y-1 pl-2 border-l-2 border-blue-500">
                <a href="{{ route('bendahara.gaji-pokok.index') }}" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.gaji-pokok.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Honor Mengajar
                </a>
                <a href="{{ route('bendahara.koreksi-hadir.index') }}" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.koreksi-hadir.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Koreksi Hadir
                </a>
                <a href="{{ route('bendahara.penambahan.index') }}" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.penambahan.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Tunjangan & Tambahan
                </a>
                <a href="{{ route('bendahara.pengurangan.index') }}" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.pengurangan.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Potongan Gaji
                </a>
                <a href="{{ route('bendahara.tahfidz.index') }}" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.tahfidz.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Tahfidz Guru
                </a>
                <a href="{{ route('bendahara.rekap-gaji.index') }}" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.rekap-gaji.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Rekap Gaji
                </a>
            
                <a href="{{ route('bendahara.setting-transport.index') }}" 
                   class="block px-4 py-2 rounded-lg hover:bg-blue-600 hover:bg-opacity-80 transition text-blue-100
                          {{ request()->routeIs('bendahara.setting-transport.*') ? 'bg-blue-600 bg-opacity-80 font-semibold' : '' }}">
                    → Setting Transport
                </a>
            </div>
        </div>

    </nav>

    {{-- ===== FOOTER ===== --}}
    <div class="p-4 border-t border-blue-600 text-xs text-center text-blue-200 bg-blue-800 flex-shrink-0">
        © {{ date('Y') }} MTs Muhammadiyah 1 Natar
    </div>

</aside>

{{-- ===== SCRIPTS DROPDOWN ===== --}}
<script>
function toggleDropdown(menuId) {
    const menu = document.getElementById(menuId);
    const icon = document.getElementById(menuId + '-icon');
    const isHidden = menu.classList.contains('hidden');

    if (isHidden) {
        menu.classList.remove('hidden');
        icon.classList.add('rotate-180');
        localStorage.setItem('dropdown_' + menuId, 'open');
    } else {
        menu.classList.add('hidden');
        icon.classList.remove('rotate-180');
        localStorage.setItem('dropdown_' + menuId, 'closed');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = ['transaksi', 'penggajian'];

    // Restore state dari localStorage
    dropdowns.forEach(menuId => {
        const menu = document.getElementById(menuId);
        const icon = document.getElementById(menuId + '-icon');
        const savedState = localStorage.getItem('dropdown_' + menuId);

        if (savedState === 'open') {
            menu.classList.remove('hidden');
            icon.classList.add('rotate-180');
        }
    });

    // Auto-expand dropdown jika ada submenu yang aktif (font-semibold)
    document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
        const hasActiveLink = [...dropdown.querySelectorAll('a')].some(link =>
            link.classList.contains('font-semibold')
        );

        if (hasActiveLink) {
            const button = dropdown.querySelector('button');
            const onclickAttr = button.getAttribute('onclick');
            const menuId = onclickAttr.match(/'([^']+)'/)?.[1];

            if (menuId) {
                const menu = document.getElementById(menuId);
                const icon = document.getElementById(menuId + '-icon');
                menu.classList.remove('hidden');
                icon.classList.add('rotate-180');
                localStorage.setItem('dropdown_' + menuId, 'open');
            }
        }
    });
});
</script>

<style>
/* Smooth dropdown animation */
.dropdown-menu [id^="transaksi"],
.dropdown-menu [id^="penggajian"] {
    transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
    overflow: hidden;
}
.dropdown-menu [id^="transaksi"].hidden,
.dropdown-menu [id^="penggajian"].hidden {
    max-height: 0;
    opacity: 0;
}
.dropdown-menu [id^="transaksi"]:not(.hidden),
.dropdown-menu [id^="penggajian"]:not(.hidden) {
    max-height: 800px;
    opacity: 1;
}
</style>