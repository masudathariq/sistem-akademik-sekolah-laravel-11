@extends('layouts.guru')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">👤 Pilih Siswa</h2>
        <p class="text-sm text-gray-500 mt-1">Pilih siswa yang akan dikelola raport tahfidznya.</p>
    </div>

    <form action="{{ route('guru.raport-tahfidz-siswa.store') }}" method="POST">
        @csrf

        {{-- Search / Filter --}}
        <div class="mb-4">
            <input type="text" id="searchSiswa" placeholder="🔍 Cari nama siswa..."
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        {{-- Pilih Semua --}}
        <div class="flex items-center justify-between mb-3">
            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer select-none">
                <input type="checkbox" id="selectAll"
                       class="w-4 h-4 accent-green-600">
                <span>Pilih Semua</span>
            </label>
            <span class="text-xs text-gray-400" id="countLabel">
                0 siswa dipilih
            </span>
        </div>

        {{-- Daftar Siswa --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">
            @if($siswas->isEmpty())
                <div class="py-12 text-center text-gray-400">
                    <div class="text-4xl mb-2">📭</div>
                    <p class="text-sm">Tidak ada data siswa.</p>
                </div>
            @else
                <ul class="divide-y divide-gray-100" id="siswaList">
                    @foreach($siswas as $siswa)
                    @php $checked = in_array($siswa->id, $selected_siswa); @endphp
                    <li class="siswa-item flex items-center gap-4 px-4 py-3 hover:bg-green-50 transition cursor-pointer
                                {{ $checked ? 'bg-green-50' : '' }}"
                        onclick="toggleCheck(this)">

                        {{-- Checkbox --}}
                        <input type="checkbox" name="siswa_id[]" value="{{ $siswa->id }}"
                               class="siswa-checkbox w-4 h-4 accent-green-600 flex-shrink-0 pointer-events-none"
                               {{ $checked ? 'checked' : '' }}>

                        {{-- Avatar --}}
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold uppercase flex-shrink-0
                                    {{ $checked ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600' }}"
                             id="avatar-{{ $siswa->id }}">
                            {{ strtoupper(substr($siswa->nama_siswa, 0, 2)) }}
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate siswa-nama">
                                {{ $siswa->nama_siswa }}
                            </p>
                            <p class="text-xs text-gray-400">{{ $siswa->rombel->tingkat ?? '-' }}( {{ $siswa->rombel->nama_rombel ?? '-' }} )</p>
                        </div>

                        {{-- Badge Sudah Dipilih --}}
                        <span class="selected-badge text-xs px-2 py-0.5 rounded-full font-medium
                                     {{ $checked ? 'bg-green-100 text-green-700' : 'hidden' }}">
                            ✓ Dipilih
                        </span>

                    </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-wrap gap-3 justify-end">
            <a href="{{ route('guru.raport-tahfidz.index') }}"
               class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <button type="submit"
                    class="px-6 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 shadow-sm transition">
                💾 Simpan Pilihan
            </button>
        </div>

    </form>
</div>

{{-- Script --}}
<script>
    // Toggle checkbox saat row diklik
    function toggleCheck(row) {
        const cb     = row.querySelector('.siswa-checkbox');
        const badge  = row.querySelector('.selected-badge');
        const avatar = row.querySelector('[id^="avatar-"]');

        cb.checked = !cb.checked;

        if (cb.checked) {
            row.classList.add('bg-green-50');
            badge.classList.remove('hidden');
            avatar.classList.remove('bg-gray-100', 'text-gray-600');
            avatar.classList.add('bg-green-600', 'text-white');
        } else {
            row.classList.remove('bg-green-50');
            badge.classList.add('hidden');
            avatar.classList.remove('bg-green-600', 'text-white');
            avatar.classList.add('bg-gray-100', 'text-gray-600');
        }
        updateCount();
    }

    // Pilih semua
    document.getElementById('selectAll').addEventListener('change', function () {
        const visibleItems = document.querySelectorAll('.siswa-item:not([style*="display: none"])');
        visibleItems.forEach(row => {
            const cb     = row.querySelector('.siswa-checkbox');
            const badge  = row.querySelector('.selected-badge');
            const avatar = row.querySelector('[id^="avatar-"]');

            cb.checked = this.checked;

            if (this.checked) {
                row.classList.add('bg-green-50');
                badge.classList.remove('hidden');
                avatar.classList.remove('bg-gray-100', 'text-gray-600');
                avatar.classList.add('bg-green-600', 'text-white');
            } else {
                row.classList.remove('bg-green-50');
                badge.classList.add('hidden');
                avatar.classList.remove('bg-green-600', 'text-white');
                avatar.classList.add('bg-gray-100', 'text-gray-600');
            }
        });
        updateCount();
    });

    // Hitung jumlah dipilih
    function updateCount() {
        const total = document.querySelectorAll('.siswa-checkbox:checked').length;
        document.getElementById('countLabel').textContent = total + ' siswa dipilih';
    }

    // Search / filter nama siswa
    document.getElementById('searchSiswa').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('.siswa-item').forEach(row => {
            const nama = row.querySelector('.siswa-nama').textContent.toLowerCase();
            row.style.display = nama.includes(keyword) ? '' : 'none';
        });
    });

    // Init count saat halaman load
    updateCount();
</script>
@endsection