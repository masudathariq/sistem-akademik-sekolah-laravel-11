@extends('layouts.staff_tu')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="mb-7">
        <a href="{{ route('staff_tu.surat-aktif.index') }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-400 hover:text-gray-700 mb-4 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <p class="text-xs font-bold text-blue-700 uppercase tracking-widest mb-1">Tata Usaha</p>
        <h1 class="text-2xl font-bold text-gray-900">Buat Surat Keterangan Aktif</h1>
        <p class="text-sm text-gray-400 mt-1">Pilih rombel dan siswa, lalu isi data surat.</p>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
        <div class="flex items-center gap-2 text-sm font-bold text-red-700 mb-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Mohon periksa kembali isian berikut:
        </div>
        <ul class="text-sm text-red-600 space-y-1 pl-6 list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('staff_tu.surat-aktif.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- SECTION 1: Data Surat --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800">Data Surat</p>
                    <p class="text-xs text-gray-400">Nomor dan tanggal penerbitan surat</p>
                </div>
            </div>
            <div class="px-6 py-5 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nomor Surat <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}"
                           placeholder="Contoh: 001/MTs/2025"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tanggal Surat <span class="text-red-400">*</span>
                    </label>
                    <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition" required>
                </div>
            </div>
        </div>

        {{-- SECTION 2: Pilih Siswa --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800">Pilih Siswa</p>
                    <p class="text-xs text-gray-400">Pilih rombel terlebih dahulu, lalu pilih nama siswa</p>
                </div>
            </div>
            <div class="px-6 py-5 space-y-4">

                {{-- Step 1: Pilih Rombel --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold mr-1">1</span>
                        Pilih Rombel
                    </label>
                    <select id="rombel"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition bg-white">
                        <option value="">-- Pilih Rombel --</option>
                        @foreach($rombels as $rombel)
                            <option value="{{ $rombel->id }}">
                                {{ $rombel->tingkat }} - {{ $rombel->nama_rombel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Step 2: Pilih Siswa --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold mr-1">2</span>
                        Pilih Siswa <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <select name="siswa_id" id="siswa" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition bg-white disabled:bg-gray-50 disabled:text-gray-400"
                                disabled>
                            <option value="">-- Pilih rombel dulu --</option>
                        </select>
                        <div id="siswa-loading" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
                            <svg class="w-4 h-4 text-indigo-400 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                            </svg>
                        </div>
                    </div>
                    <p id="siswa-hint" class="text-xs text-gray-400 mt-1.5">Pilih rombel terlebih dahulu untuk menampilkan daftar siswa.</p>
                </div>

            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between pt-1 pb-6">
            <p class="text-xs text-gray-400"><span class="text-red-400 font-bold">*</span> Wajib diisi</p>
            <div class="flex items-center gap-3">
                <a href="{{ route('staff_tu.surat-aktif.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-gray-500 hover:text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                    Batal
                </a>
                <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white text-sm font-semibold rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Surat
                </button>
            </div>
        </div>

    </form>
</div>
</div>

<script>
document.getElementById('rombel').addEventListener('change', function () {
    const rombelId = this.value;
    const siswaSelect = document.getElementById('siswa');
    const loading = document.getElementById('siswa-loading');
    const hint = document.getElementById('siswa-hint');

    if (!rombelId) {
        siswaSelect.innerHTML = '<option value="">-- Pilih rombel dulu --</option>';
        siswaSelect.disabled = true;
        hint.textContent = 'Pilih rombel terlebih dahulu untuk menampilkan daftar siswa.';
        return;
    }

    loading.classList.remove('hidden');
    siswaSelect.disabled = true;
    hint.textContent = 'Memuat daftar siswa...';

    fetch("{{ route('staff_tu.get-siswa', ':id') }}".replace(':id', rombelId))
        .then(response => response.json())
        .then(data => {
            siswaSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>';

            if (data.length === 0) {
                siswaSelect.innerHTML += '<option value="" disabled>Tidak ada siswa di rombel ini</option>';
                hint.textContent = 'Tidak ada siswa yang terdaftar di rombel ini.';
            } else {
                data.forEach(function (siswa) {
                    siswaSelect.innerHTML += `<option value="${siswa.id}">${siswa.nama_siswa}</option>`;
                });
                siswaSelect.disabled = false;
                hint.textContent = data.length + ' siswa ditemukan. Silakan pilih salah satu.';
            }
        })
        .catch(() => {
            hint.textContent = 'Gagal memuat data siswa. Coba lagi.';
        })
        .finally(() => {
            loading.classList.add('hidden');
        });
});
</script>

@endsection