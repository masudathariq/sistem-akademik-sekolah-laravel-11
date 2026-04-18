<aside
    id="sidebar"
    class="fixed top-14 left-0 z-40 h-[calc(100vh-3.5rem)] w-64
           bg-[#020659] text-white
           transform -translate-x-full md:translate-x-0
           transition-transform duration-300
           overflow-y-auto shadow-lg">
    <nav class="p-4 space-y-1 text-sm">

        {{-- Dashboard --}}
        <a href="{{ route('guru.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-md
           hover:bg-white/10 transition
           {{ request()->routeIs('guru.dashboard') ? 'bg-white/20 font-semibold' : '' }}">

            <i class="fa-solid fa-house w-5 text-center"></i>
            <span>Dashboard</span>
        </a>

        {{-- Divider --}}
        <hr class="my-2 border-white/10">
        {{-- DROPDOWN: ABSENSI GURU --}}
        <div class="dropdown-menu">
            <button onclick="toggleDropdown('absensiGuru')"
                class="w-full flex items-center justify-between px-4 py-2 rounded-md hover:bg-white/10 transition">

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-user-pen w-5 text-center"></i>
                    <span>Absensi Guru</span>
                </div>

                <i id="absensiGuru-icon"
                    class="fa-solid fa-chevron-down w-4 h-4 transform transition-transform duration-300"></i>
            </button>

            <div id="absensiGuru" class="hidden ml-4 mt-1 space-y-1 overflow-hidden">

                <a href="{{ route('guru.absensi.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-white/10 transition text-blue-100
                  {{ request()->routeIs('guru.absensi.*') ? 'bg-white/20 font-semibold' : '' }}">

                    <i class="fa-solid fa-user-check w-4 text-center"></i>
                    <span>Absensi Saya</span>
                </a>

                <a href="{{ route('guru.absen.rekap') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-white/10 transition text-blue-100
                  {{ request()->routeIs('guru.absen.rekap') ? 'bg-white/20 font-semibold' : '' }}">

                    <i class="fa-solid fa-calendar-check w-4 text-center"></i>
                    <span>Rekap Absensi</span>
                </a>

            </div>
        </div>


        {{-- Divider --}}
        <hr class="my-2 border-white/10">

        {{-- DROPDOWN: ABSENSI SISWA --}}
        <div class="dropdown-menu">
            <button onclick="toggleDropdown('absensiSiswa')"
                class="w-full flex items-center justify-between px-4 py-2 rounded-md hover:bg-white/10 transition">

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-clipboard-check w-5 text-center"></i>
                    <span>Absensi Siswa</span>
                </div>

                <i id="absensiSiswa-icon"
                    class="fa-solid fa-chevron-down w-4 h-4 transform transition-transform duration-300"></i>
            </button>

            <div id="absensiSiswa" class="hidden ml-4 mt-1 space-y-1 overflow-hidden">

                <a href="{{ route('guru.absen-siswa.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-white/10 transition text-blue-100
                  {{ request()->routeIs('guru.absen-siswa.index') ? 'bg-white/20 font-semibold' : '' }}">

                    <i class="fa-solid fa-user-check w-4 text-center"></i>
                    <span>Absen Siswa</span>
                </a>

                <a href="{{ route('guru.absen-siswa.hari-ini') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-white/10 transition text-blue-100
                  {{ request()->routeIs('guru.absen-siswa.hari-ini*') ? 'bg-white/20 font-semibold' : '' }}">

                    <i class="fa-solid fa-calendar-day w-4 text-center"></i>
                    <span>Rekap Hari Ini</span>
                </a>

                <a href="{{ route('guru.absen-siswa.rekap') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-white/10 transition text-blue-100
                  {{ request()->routeIs('guru.absen-siswa.rekap*') ? 'bg-white/20 font-semibold' : '' }}">

                    <i class="fa-solid fa-chart-column w-4 text-center"></i>
                    <span>Rekap Bulanan</span>
                </a>

            </div>
        </div>

        {{-- Divider --}}
        <hr class="my-2 border-white/10">

        {{-- JADWAL MENGAJAR HARI INI --}}
        <a href="{{ route('guru.jadwal_pelajaran.hari_ini') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-md
    hover:bg-white/10 transition
    {{ request()->routeIs('guru.jadwal_pelajaran.hari_ini') ? 'bg-white/20 font-semibold' : '' }}">

            <i class="fa-solid fa-calendar-day w-5 text-center"></i>
            <span>Jadwal Hari Ini</span>
        </a>

        {{-- SEMUA JADWAL MENGAJAR --}}
        <a href="{{ route('guru.jadwal_pelajaran.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-md
    hover:bg-white/10 transition
    {{ request()->routeIs('guru.jadwal_pelajaran.index') ? 'bg-white/20 font-semibold' : '' }}">

            <i class="fa-solid fa-calendar-days w-5 text-center"></i>
            <span>Semua Jadwal</span>
        </a>


        {{-- Divider --}}
        <hr class="my-2 border-white/10">

        {{-- WALI KELAS --}}
        <a href="{{ route('guru.siswa.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-md
           hover:bg-white/10 transition
           {{ request()->routeIs('guru.siswa.*') ? 'bg-white/20 font-semibold' : '' }}">

            <i class="fa-solid fa-chalkboard-user w-5 text-center"></i>
            <span>Wali Kelas</span>
        </a>

        {{-- RAPORT TAHFIDZ --}}
        <a href="{{ route('guru.raport-tahfidz.index') }}"
            onclick="return konfirmasiLaptop(event)"
            class="flex items-center gap-3 px-4 py-2 rounded-md
   hover:bg-white/10 transition
   {{ request()->routeIs('guru.raport-tahfidz.*') ? 'bg-white/20 font-semibold' : '' }}">

            <i class="fa-solid fa-book-quran w-5 text-center"></i>
            <span>Rapor Tahfidz</span>
        </a>




        {{-- Divider --}}
        <hr class="my-2 border-white/10">

        {{-- GAJI --}}
        <a href="{{ route('guru.slip-gaji.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-md
           hover:bg-white/10 transition
           {{ request()->routeIs('guru.slip-gaji.*') ? 'bg-white/20 font-semibold' : '' }}">

            <i class="fa-solid fa-money-bill-wave w-5 text-center"></i>
            <span>Slip Gaji</span>
        </a>


    </nav>
</aside>

{{-- MODAL LAPTOP WARNING --}}
<div id="laptopModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="bg-white w-full max-w-md mx-4 rounded-2xl shadow-2xl p-6 animate-fadeIn">

        <div class="text-center">
            <div class="text-5xl mb-3">💻</div>

            <h3 class="text-xl font-bold text-gray-800 mb-2">
                Disarankan Menggunakan Laptop
            </h3>

            <p class="text-gray-600 text-sm leading-relaxed mb-6">
                Fitur <strong>Rapor Tahfidz</strong> memiliki tabel dan input data yang lebih nyaman
                digunakan melalui laptop atau komputer.
            </p>

            <div class="flex gap-3">
                <button onclick="tutupModal()"
                    class="flex-1 border border-gray-300 text-gray-600 py-2 rounded-lg hover:bg-gray-100 transition">
                    Batal
                </button>

                <button onclick="lanjutKeHalaman()"
                    class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                    Tetap Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleDropdown(menuId) {
        const menu = document.getElementById(menuId);
        const icon = document.getElementById(menuId + '-icon');

        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            icon.classList.add('rotate-180');
            localStorage.setItem('dropdown_' + menuId, 'open');
        } else {
            menu.classList.add('hidden');
            icon.classList.remove('rotate-180');
            localStorage.setItem('dropdown_' + menuId, 'closed');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = ['absensiGuru', 'absensiSiswa'];

        dropdowns.forEach(menuId => {
            const menu = document.getElementById(menuId);
            const icon = document.getElementById(menuId + '-icon');

            // 1. Cek dari LocalStorage
            const savedState = localStorage.getItem('dropdown_' + menuId);
            if (savedState === 'open') {
                menu.classList.remove('hidden');
                icon.classList.add('rotate-180');
            }

            // 2. Cek apakah ada submenu yang sedang aktif (bg-white/20)
            // Ini memastikan dropdown terbuka jika user refresh di halaman rekap
            const activeLink = menu.querySelector('.bg-white\\/20');
            if (activeLink) {
                menu.classList.remove('hidden');
                icon.classList.add('rotate-180');
            }
        });
    });
</script>

<script>
    function konfirmasiLaptop(event) {

        // Jika layar kecil (HP / tablet)
        if (window.innerWidth < 1024) {
            event.preventDefault();

            if (confirm("Fitur Rapor Tahfidz lebih nyaman digunakan melalui laptop atau komputer.\n\nApakah Anda tetap ingin melanjutkan?")) {
                window.location.href = event.currentTarget.href;
            }

            return false;
        }

        // Jika desktop, JANGAN lakukan apa-apa
        // Biarkan link berjalan normal
    }
</script>

<script>
    let targetUrl = null;

    function konfirmasiLaptop(event) {

        if (window.matchMedia("(max-width: 1023px)").matches) {
            event.preventDefault();

            targetUrl = event.currentTarget.href;

            const modal = document.getElementById('laptopModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            return false;
        }
    }

    function tutupModal() {
        const modal = document.getElementById('laptopModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function lanjutKeHalaman() {
        if (targetUrl) {
            window.location.href = targetUrl;
        }
    }
</script>



<style>
    /* Animasi smooth saat buka tutup */
    [id^="absensi"] {
        transition: all 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }
</style>