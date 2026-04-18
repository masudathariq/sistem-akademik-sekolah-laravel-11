@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">

    <div class="max-w-5xl mx-auto px-6 py-6 space-y-6">

        {{-- TOP BAR --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-xl font-semibold text-slate-900">
                    Edit Jadwal Harian
                </h1>
                <p class="text-sm text-slate-500">
                    Perbarui pengaturan jadwal operasional
                </p>
            </div>

            <a href="{{ route('admin.jadwal-harian.index') }}"
               class="px-4 py-2 text-sm border rounded-lg bg-white hover:bg-slate-50 transition">
                ← Kembali
            </a>

        </div>

        <form action="{{ route('admin.jadwal-harian.update', $jadwal->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- SECTION: DATA UTAMA --}}
            <div class="bg-white border rounded-xl p-6 space-y-5">

                <h3 class="font-semibold text-slate-800">
                    Informasi Jadwal
                </h3>

                <div class="grid sm:grid-cols-2 gap-4">

                    {{-- TANGGAL --}}
                    <div>
                        <label class="text-sm text-slate-600">Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               value="{{ $jadwal->tanggal }}"
                               required
                               class="mt-1 w-full px-3 py-2 text-sm border rounded-lg 
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    {{-- MODE --}}
                    <div>
                        <label class="text-sm text-slate-600">Mode Kehadiran</label>
                        <select name="mode" id="mode"
                            class="mt-1 w-full px-3 py-2 text-sm border rounded-lg 
                                   focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                            <option value="SEMUA"
                                {{ $jadwal->mode === 'SEMUA' ? 'selected' : '' }}>
                                Semua Guru
                            </option>
                            <option value="TERBATAS"
                                {{ $jadwal->mode === 'TERBATAS' ? 'selected' : '' }}>
                                Guru Tertentu
                            </option>
                        </select>
                    </div>

                    {{-- KETERANGAN --}}
                    <div class="sm:col-span-2">
                        <label class="text-sm text-slate-600">Keterangan</label>
                        <input type="text"
                               name="keterangan"
                               value="{{ $jadwal->keterangan }}"
                               placeholder="Contoh: Upacara, Rapat, KBM"
                               class="mt-1 w-full px-3 py-2 text-sm border rounded-lg 
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                </div>

            </div>

            {{-- SECTION: PILIH GURU --}}
            <div id="guru-section"
                 class="bg-white border rounded-xl p-6 {{ $jadwal->mode === 'TERBATAS' ? '' : 'hidden' }}">

                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Pilih Guru
                        </h3>
                        <p class="text-sm text-slate-500">
                            Update daftar guru yang masuk
                        </p>
                    </div>

                    <span id="selectedCount"
                          class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                        0 dipilih
                    </span>
                </div>

                {{-- ACTION --}}
                <div class="flex gap-2 mb-4">
                    <button type="button"
                            onclick="toggleAll(true)"
                            class="px-3 py-1.5 text-sm border rounded-lg hover:bg-slate-50">
                        Pilih Semua
                    </button>

                    <button type="button"
                            onclick="toggleAll(false)"
                            class="px-3 py-1.5 text-sm border rounded-lg hover:bg-slate-50">
                        Reset
                    </button>
                </div>

                {{-- LIST GURU --}}
                <div class="grid sm:grid-cols-2 gap-2 max-h-72 overflow-y-auto">

                    @foreach($gurus as $guru)
                    <label class="flex items-center gap-3 p-3 border rounded-lg 
                                  hover:bg-slate-50 cursor-pointer">

                        <input type="checkbox"
                               name="guru_id[]"
                               value="{{ $guru->id }}"
                               class="guru-checkbox w-4 h-4"
                               onchange="updateSelectedCount()"
                               {{ $jadwal->gurus->contains($guru->id) ? 'checked' : '' }}>

                        <span class="text-sm text-slate-700">
                            {{ $guru->nama }}
                        </span>

                    </label>
                    @endforeach

                </div>

            </div>

            {{-- ACTION --}}
            <div class="flex justify-end gap-3">

                <a href="{{ route('admin.jadwal-harian.index') }}"
                   class="px-4 py-2 text-sm border rounded-lg bg-white hover:bg-slate-50">
                    Batal
                </a>

                <button type="submit"
                    class="px-5 py-2 text-sm bg-blue-600 text-white rounded-lg 
                           hover:bg-blue-700 transition">
                    Update Jadwal
                </button>

            </div>

        </form>

    </div>
</div>

{{-- SCRIPT --}}
<script>
const modeSelect = document.getElementById('mode');
const guruSection = document.getElementById('guru-section');

modeSelect.addEventListener('change', function () {
    if (this.value === 'TERBATAS') {
        guruSection.classList.remove('hidden');
    } else {
        guruSection.classList.add('hidden');
    }
});

// INIT COUNT (penting untuk edit)
window.addEventListener('load', updateSelectedCount);

function toggleAll(status) {
    document.querySelectorAll('.guru-checkbox')
        .forEach(cb => cb.checked = status);
    updateSelectedCount();
}

function updateSelectedCount() {
    const checked = document.querySelectorAll('.guru-checkbox:checked').length;
    document.getElementById('selectedCount').innerText = checked + " dipilih";
}
</script>

@endsection