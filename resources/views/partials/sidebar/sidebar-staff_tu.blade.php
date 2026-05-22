{{-- SIDEBAR + OVERLAY RESPONSIVE --}}

{{-- OVERLAY (MOBILE) --}}
<div id="sidebarOverlay"
     class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"
     onclick="toggleSidebar()"></div>

{{-- SIDEBAR --}}
<aside id="sidebar"
       class="fixed md:static z-50
              bg-blue-900 text-white
              min-h-screen flex-shrink-0
              flex flex-col
              transform -translate-x-full md:translate-x-0
              transition-transform duration-300
              w-56 md:w-64">

    {{-- LOGO / HEADER --}}
    <div class="px-4 py-3 md:py-4 text-base md:text-xl font-bold border-b border-blue-700 flex items-center gap-2">
        <span>🏫</span>
        <span>Tata Usaha</span>
    </div>

    {{-- NAVIGASI --}}
    <nav class="flex-1 px-3 py-3 md:p-4 space-y-1 text-xs md:text-sm overflow-y-auto">

        {{-- DASHBOARD --}}
        <a href="{{ route('staff_tu.dashboard') }}"
           class="flex items-center gap-2 px-3 py-2 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition
                  {{ request()->routeIs('staff_tu.dashboard') ? 'bg-blue-800 font-semibold' : 'text-blue-100' }}">
            📊 <span>Beranda</span>
        </a>

        {{-- DROPDOWN MASTER DATA --}}
        <div class="dropdown-menu">
            <button onclick="toggleDropdown('masterData')"
                    class="w-full flex items-center justify-between px-3 py-2 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-left">
                <span class="flex items-center gap-2">🗂️ <span>Data Referensi</span></span>
                <svg id="masterData-icon" class="w-3.5 h-3.5 md:w-4 md:h-4 transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="masterData" class="hidden ml-3 md:ml-4 mt-1 space-y-0.5">
                <a href="{{ route('staff_tu.tahun-ajaran.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.tahun-ajaran.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Tahun Ajaran
                </a>
                <a href="{{ route('staff_tu.rombel.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.rombel.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Rombongan Belajar
                </a>
                <a href="{{ route('staff_tu.wali-kelas.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.wali-kelas.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Data Wali Kelas
                </a>
                <a href="{{ route('staff_tu.rombel-kategori.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.rombel-kategori.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Kategori Rombel
                </a>
            </div>
        </div>

        {{-- DROPDOWN MANAJEMEN SISWA --}}
        <div class="dropdown-menu">
            <button onclick="toggleDropdown('siswaMenu')"
                    class="w-full flex items-center justify-between px-3 py-2 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-left">
                <span class="flex items-center gap-2">👥 <span>Kesiswaan</span></span>
                <svg id="siswaMenu-icon" class="w-3.5 h-3.5 md:w-4 md:h-4 transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="siswaMenu" class="hidden ml-3 md:ml-4 mt-1 space-y-0.5">
                <a href="{{ route('staff_tu.siswa.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.siswa.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Data Peserta Didik
                </a>
                <a href="{{ route('staff_tu.penempatan.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.penempatan.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Penempatan Kelas
                </a>
                <a href="{{ route('staff_tu.kenaikan.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.kenaikan.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Kenaikan Kelas
                </a>
                <a href="{{ route('staff_tu.alumni.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.alumni.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Data Alumni
                </a>
            </div>
        </div>

        {{-- JADWAL PELAJARAN --}}
        <div class="dropdown-menu">
            <button onclick="toggleDropdown('jadwalMenu')"
                    class="w-full flex items-center justify-between px-3 py-2 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-left">
                <span class="flex items-center gap-2">📅 <span>Jadwal & Kurikulum</span></span>
                <svg id="jadwalMenu-icon" class="w-3.5 h-3.5 md:w-4 md:h-4 transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="jadwalMenu" class="hidden ml-3 md:ml-4 mt-1 space-y-0.5">
                <a href="{{ route('staff_tu.jadwal_pelajaran.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.jadwal_pelajaran.index') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Jadwal Mengajar
                </a>
                <a href="{{ route('staff_tu.mata_pelajaran.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.mata_pelajaran.index') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Mata Pelajaran
                </a>
            </div>
        </div>

        {{-- DROPDOWN MANAJEMEN SURAT --}}
        <div class="dropdown-menu">
            <button onclick="toggleDropdown('suratMenu')"
                    class="w-full flex items-center justify-between px-3 py-2 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-left">
                <span class="flex items-center gap-2">✉️ <span>Administrasi Surat</span></span>
                <svg id="suratMenu-icon" class="w-3.5 h-3.5 md:w-4 md:h-4 transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="suratMenu" class="hidden ml-3 md:ml-4 mt-1 space-y-0.5">
                <a href="{{ route('staff_tu.surat-pindah.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.surat-pindah.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Surat Keterangan Pindah
                </a>
                <a href="{{ route('staff_tu.surat-aktif.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.surat-aktif.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Surat Keterangan Aktif
                </a>
                <a href="{{ route('staff_tu.surat_keluar.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.surat_keluar.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Surat Keluar
                </a>
                <a href="{{ route('staff_tu.surat_masuk.index') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition text-blue-200
                          {{ request()->routeIs('staff_tu.surat_masuk.*') ? 'bg-blue-800 text-white font-medium' : '' }}">
                    <span class="text-blue-400 text-[10px]">▸</span> Surat Masuk
                </a>
            </div>
        </div>

        {{-- REKAP ABSENSI --}}
        <a href="{{ route('staff_tu.absen-siswa.rekap') }}"
           class="flex items-center gap-2 px-3 py-2 md:px-4 md:py-2 rounded-lg hover:bg-blue-700 transition
                  {{ request()->routeIs('staff_tu.absen-siswa.*') ? 'bg-blue-800 font-semibold' : 'text-blue-100' }}">
            📋 <span>Rekap Kehadiran</span>
        </a>

    </nav>

    {{-- FOOTER USER INFO --}}
    <div class="px-4 py-3 border-t border-blue-700 text-[10px] md:text-xs text-blue-300">
        {{ auth()->user()->name ?? 'Staff TU' }}
    </div>

</aside>

{{-- JS SIDEBAR --}}
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

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
    const dropdowns = ['masterData', 'siswaMenu', 'suratMenu', 'jadwalMenu'];

    dropdowns.forEach(menuId => {
        const menu = document.getElementById(menuId);
        const icon = document.getElementById(menuId + '-icon');
        const savedState = localStorage.getItem('dropdown_' + menuId);

        if (savedState === 'open') {
            menu.classList.remove('hidden');
            icon.classList.add('rotate-180');
        }
    });

    // Auto-expand dropdown jika ada submenu aktif
    document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
        const links = dropdown.querySelectorAll('a');
        let hasActiveLink = false;

        links.forEach(link => {
            if (link.classList.contains('bg-blue-800')) hasActiveLink = true;
        });

        if (hasActiveLink) {
            const button = dropdown.querySelector('button');
            const menuId = button.getAttribute('onclick').match(/'([^']+)'/)[1];
            const menu = document.getElementById(menuId);
            const icon = document.getElementById(menuId + '-icon');

            menu.classList.remove('hidden');
            icon.classList.add('rotate-180');
            localStorage.setItem('dropdown_' + menuId, 'open');
        }
    });
});
</script>

<style>
.dropdown-menu > div {
    transition: max-height 0.25s ease, opacity 0.25s ease;
    max-height: 500px;
    opacity: 1;
}
.dropdown-menu > div.hidden {
    max-height: 0 !important;
    opacity: 0;
    overflow: hidden;
}
</style>