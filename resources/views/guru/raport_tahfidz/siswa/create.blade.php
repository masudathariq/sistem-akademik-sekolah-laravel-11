@extends('layouts.guru')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header yang lebih informatif --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center text-2xl">👤</div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Pilih Siswa</h2>
                <p class="text-sm text-gray-500 mt-0.5">Pilih satu atau lebih siswa yang akan dikelola raport tahfidznya.</p>
            </div>
        </div>
        <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded-r-lg text-sm text-blue-700 mt-3">
            💡 <span class="font-medium">Tips:</span> Kamu bisa memilih banyak siswa sekaligus. Data raport akan tersimpan untuk masing-masing siswa.
        </div>
    </div>

    <form action="{{ route('guru.raport-tahfidz-siswa.store') }}" method="POST">
        @csrf

        {{-- Search dan tools bar --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6 flex flex-wrap items-center justify-between gap-3">
            <div class="relative flex-1 min-w-[200px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" id="searchSiswa" placeholder="Cari nama siswa..." 
                       class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition">
            </div>
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer select-none bg-gray-50 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition">
                    <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                    <span>Pilih Semua</span>
                </label>
                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full" id="countLabel">0 siswa dipilih</span>
            </div>
        </div>

        {{-- Daftar siswa dalam bentuk card grid yang rapi untuk desktop --}}
        @if($siswas->isEmpty())
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm py-16 text-center">
                <div class="text-5xl mb-3">📭</div>
                <p class="text-gray-500 text-sm">Belum ada data siswa.</p>
                <p class="text-gray-400 text-xs mt-1">Silakan tambah siswa terlebih dahulu melalui menu master data.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8" id="siswaGrid">
                @foreach($siswas as $siswa)
                @php 
                    $checked = in_array($siswa->id, $selected_siswa); 
                    $kelas = ($siswa->rombel->tingkat_romawi ?? '') . ' ' . ($siswa->rombel->nama_rombel ?? '');
                    $kelas = trim($kelas) ?: '-';
                @endphp
                <div class="siswa-card bg-white border rounded-xl shadow-sm hover:shadow-md transition-all duration-200 
                            {{ $checked ? 'border-teal-400 ring-1 ring-teal-400 bg-teal-50/30' : 'border-gray-200' }}"
                     onclick="toggleCard(this)">
                    
                    <div class="p-4 flex items-start gap-3">
                        {{-- Checkbox --}}
                        <input type="checkbox" name="siswa_id[]" value="{{ $siswa->id }}"
                               class="siswa-checkbox mt-1 w-5 h-5 rounded border-gray-300 text-teal-600 focus:ring-teal-500 pointer-events-none"
                               {{ $checked ? 'checked' : '' }}>
                        
                        {{-- Avatar --}}
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-base font-bold uppercase flex-shrink-0 transition-colors
                                    {{ $checked ? 'bg-teal-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600' }}">
                            {{ strtoupper(substr($siswa->nama_siswa, 0, 2)) }}
                        </div>
                        
                        {{-- Informasi --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-semibold text-gray-800 truncate siswa-nama">{{ $siswa->nama_siswa }}</p>
                            <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>{{ $kelas }}</span>
                            </p>
                            <p class="text-xs text-gray-400 mt-1">NIS: {{ $siswa->nis ?? '-' }}</p>
                        </div>
                        
                        {{-- Badge terpilih --}}
                        <div class="selected-badge {{ $checked ? '' : 'hidden' }}">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-700">
                                ✓ Terpilih
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        {{-- Tombol aksi --}}
        <div class="flex flex-wrap justify-end gap-3 sticky bottom-4 bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-sm border border-gray-200">
            <a href="{{ route('guru.raport-tahfidz.index') }}" 
               class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition flex items-center gap-2">
                ← Kembali
            </a>
            <button type="submit" 
                    class="px-6 py-2.5 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 shadow-sm transition flex items-center gap-2">
                💾 Simpan Pilihan
            </button>
        </div>
    </form>
</div>

<script>
    // Toggle card saat diklik
    function toggleCard(card) {
        const cb = card.querySelector('.siswa-checkbox');
        const badge = card.querySelector('.selected-badge');
        const avatar = card.querySelector('div[class*="w-12 h-12"]');
        
        cb.checked = !cb.checked;
        
        if (cb.checked) {
            card.classList.add('border-teal-400', 'ring-1', 'ring-teal-400', 'bg-teal-50/30');
            if (avatar) {
                avatar.classList.remove('bg-gray-100', 'text-gray-600');
                avatar.classList.add('bg-teal-600', 'text-white');
            }
            badge?.classList.remove('hidden');
        } else {
            card.classList.remove('border-teal-400', 'ring-1', 'ring-teal-400', 'bg-teal-50/30');
            if (avatar) {
                avatar.classList.remove('bg-teal-600', 'text-white');
                avatar.classList.add('bg-gray-100', 'text-gray-600');
            }
            badge?.classList.add('hidden');
        }
        updateCount();
    }
    
    // Select All
    document.getElementById('selectAll').addEventListener('change', function () {
        const visibleCards = document.querySelectorAll('.siswa-card:not([style*="display: none"])');
        visibleCards.forEach(card => {
            const cb = card.querySelector('.siswa-checkbox');
            const badge = card.querySelector('.selected-badge');
            const avatar = card.querySelector('div[class*="w-12 h-12"]');
            const isChecked = this.checked;
            
            cb.checked = isChecked;
            if (isChecked) {
                card.classList.add('border-teal-400', 'ring-1', 'ring-teal-400', 'bg-teal-50/30');
                if (avatar) {
                    avatar.classList.remove('bg-gray-100', 'text-gray-600');
                    avatar.classList.add('bg-teal-600', 'text-white');
                }
                badge?.classList.remove('hidden');
            } else {
                card.classList.remove('border-teal-400', 'ring-1', 'ring-teal-400', 'bg-teal-50/30');
                if (avatar) {
                    avatar.classList.remove('bg-teal-600', 'text-white');
                    avatar.classList.add('bg-gray-100', 'text-gray-600');
                }
                badge?.classList.add('hidden');
            }
        });
        updateCount();
    });
    
    // Hitung jumlah siswa terpilih
    function updateCount() {
        const total = document.querySelectorAll('.siswa-checkbox:checked').length;
        document.getElementById('countLabel').innerHTML = total + ' siswa dipilih';
    }
    
    // Filter pencarian (live search)
    document.getElementById('searchSiswa').addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.siswa-card');
        cards.forEach(card => {
            const nama = card.querySelector('.siswa-nama')?.textContent.toLowerCase() || '';
            if (keyword === '' || nama.includes(keyword)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
        // Reset "Pilih Semua" setelah filter berubah? Tidak otomatis, biarkan saja.
    });
    
    // Inisialisasi hitungan saat load
    updateCount();
</script>
@endsection