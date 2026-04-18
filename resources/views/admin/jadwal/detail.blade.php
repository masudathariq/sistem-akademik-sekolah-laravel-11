@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">

    <div class="max-w-7xl mx-auto px-6 py-6 space-y-6">

        {{-- TOP BAR --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-xl font-semibold text-slate-900">
                    Jadwal Guru - {{ $hari->nama_hari }}
                </h1>
                <p class="text-sm text-slate-500">
                    Atur distribusi guru mengajar
                </p>
            </div>

            <a href="{{ url()->previous() }}"
               class="px-4 py-2 text-sm border rounded-lg bg-white hover:bg-slate-50 transition">
                ← Kembali
            </a>

        </div>

        {{-- FLASH --}}
        @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT CONTENT --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- GURU TERJADWAL --}}
                <div class="bg-white border rounded-xl">

                    <div class="p-5 border-b flex justify-between items-center">
                        <div>
                            <h2 class="font-semibold text-slate-800">
                                Guru Terjadwal
                            </h2>
                            <p class="text-sm text-slate-500">
                                {{ $guruTerjadwal->count() }} guru aktif
                            </p>
                        </div>
                    </div>

                    @if ($guruTerjadwal->isEmpty())
                        <div class="p-5 text-sm text-slate-500">
                            Belum ada guru di hari ini
                        </div>
                    @else
                        <div class="divide-y">
                            @foreach ($guruTerjadwal as $jg)
                            <div class="flex items-center justify-between px-5 py-4 hover:bg-slate-50">

                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 flex items-center justify-center 
                                                rounded-lg bg-blue-50 text-blue-600 font-semibold">
                                        {{ substr($jg->guru->nama, 0, 1) }}
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-slate-800">
                                            {{ $jg->guru->nama }}
                                        </p>
                                    </div>
                                </div>

                                <form action="{{ route('admin.jadwal.destroy', $jg->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus dari {{ $hari->nama_hari }}?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-sm text-red-500 hover:text-red-600">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                            @endforeach
                        </div>
                    @endif

                </div>

                {{-- TAMBAH GURU --}}
                <div class="bg-white border rounded-xl">

                    <div class="p-5 border-b flex justify-between items-center">
                        <div>
                            <h2 class="font-semibold text-slate-800">
                                Tambah Guru
                            </h2>
                            <p class="text-sm text-slate-500">
                                Pilih guru untuk ditambahkan
                            </p>
                        </div>

                        <span id="selectedCount"
                              class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                            0 dipilih
                        </span>
                    </div>

                    <div class="p-5">

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

                        <form action="{{ route('admin.jadwal.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hari_id" value="{{ $hari->id }}">

                            {{-- LIST GURU --}}
                            <div class="grid sm:grid-cols-2 gap-2 max-h-80 overflow-y-auto pr-1 mb-4">

                                @foreach ($guru as $g)
                                <label class="flex items-center gap-3 p-3 border rounded-lg 
                                              hover:bg-slate-50 cursor-pointer">

                                    <input type="checkbox"
                                           name="guru_id[]"
                                           value="{{ $g->id }}"
                                           class="guru-checkbox w-4 h-4"
                                           onchange="updateSelectedCount()">

                                    <span class="text-sm text-slate-700">
                                        {{ $g->nama }}
                                    </span>

                                </label>
                                @endforeach

                            </div>

                            @error('guru_id')
                                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
                            @enderror

                            <button class="w-full py-2.5 bg-blue-600 text-white text-sm 
                                           rounded-lg hover:bg-blue-700 transition">
                                Simpan Perubahan
                            </button>

                        </form>

                    </div>
                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-4">

                <div class="bg-white border rounded-xl p-5">
                    <h3 class="font-semibold text-slate-800 mb-2">
                        Panduan
                    </h3>
                    <ul class="text-sm text-slate-500 space-y-1">
                        <li>• Lihat guru di atas</li>
                        <li>• Centang untuk tambah</li>
                        <li>• Klik simpan</li>
                    </ul>
                </div>

                <div class="bg-white border rounded-xl p-5">
                    <h3 class="font-semibold text-slate-800 mb-2">
                        Tips
                    </h3>
                    <ul class="text-sm text-slate-500 space-y-1">
                        <li>• Hindari jadwal bentrok</li>
                        <li>• Distribusi merata</li>
                        <li>• Prioritas mapel utama</li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
</div>

{{-- SCRIPT --}}
<script>
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