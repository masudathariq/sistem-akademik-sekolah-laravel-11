@extends('layouts.staff_tu')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .jadwal-page { font-family: 'Plus Jakarta Sans', sans-serif; }

    .card-guru {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-guru:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
    }

    .sesi-item {
        transition: background 0.15s ease, border-color 0.15s ease;
    }
    .sesi-item:hover { background: #eff6ff; border-color: #bfdbfe; }

    .btn-action {
        transition: all 0.15s ease;
    }
    .btn-action:hover { transform: scale(1.08); }

    .modal-overlay {
        backdrop-filter: blur(4px);
        background: rgba(15, 23, 42, 0.45);
    }

    .modal-panel {
        animation: slideUp 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(24px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 600;
    }
</style>

@php
    $tahunAktif = $tahunAktif ?? \App\Models\Tatausaha\TahunAjaran::where('is_active', true)->first();

$rombelAktif = $tahunAktif
    ? \App\Models\Tatausaha\Rombel::where('tahun_ajaran_id', $tahunAktif->id)
        ->orderBy('tingkat', 'asc')
        ->orderBy('kode_rombel', 'asc')
        ->get()
    : collect();
@endphp

<div class="jadwal-page min-h-screen bg-slate-50 px-4 py-6 md:px-8">

    {{-- BREADCRUMB --}}
    <nav class="flex items-center gap-1.5 text-xs text-slate-400 mb-5">
        <a href="{{ route('staff_tu.jadwal_pelajaran.index') }}" class="hover:text-blue-600 transition">Jadwal & Kurikulum</a>
        <span>›</span>
        <a href="{{ route('staff_tu.jadwal_pelajaran.index') }}" class="hover:text-blue-600 transition">Jadwal Mengajar</a>
        <span>›</span>
        <span class="text-blue-600 font-semibold">{{ ucfirst($hari) }}</span>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div id="flash-msg" class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-4 h-4 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
            <button onclick="document.getElementById('flash-msg').remove()" class="ml-auto text-emerald-400 hover:text-emerald-700">✕</button>
        </div>
    @endif

    @if(session('error'))
        <div id="flash-err" class="mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-4 h-4 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 3a9 9 0 100 18A9 9 0 0012 3z"/>
            </svg>
            {{ session('error') }}
            <button onclick="document.getElementById('flash-err').remove()" class="ml-auto text-red-400 hover:text-red-700">✕</button>
        </div>
    @endif

    {{-- PAGE HEADER --}}
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-7">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white text-base">📅</div>
                <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Jadwal Hari {{ ucfirst($hari) }}</h1>
            </div>
            <p class="text-sm text-slate-500 ml-10">
                Kelola jadwal mengajar seluruh guru — tambah, ubah, atau hapus sesi.
                @if($tahunAktif)
                    <span class="inline-flex items-center gap-1 ml-1 text-xs text-blue-600 font-semibold bg-blue-50 px-2 py-0.5 rounded-full">
                        📆 {{ $tahunAktif->tahun_ajaran }} / Semester. {{ $tahunAktif->semester }}
                    </span>
                @endif
            </p>
        </div>

        @php
            $sudahJadwal = collect($gurus)->filter(fn($g) => isset($jadwals[$g->id]) && count($jadwals[$g->id]) > 0)->count();
        @endphp

        <div class="flex gap-3">
            <div class="bg-white border border-slate-200 rounded-2xl px-5 py-3 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-slate-700">{{ count($gurus) }}</p>
                <p class="text-[11px] text-slate-400 font-medium mt-0.5">Total Guru</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl px-5 py-3 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-emerald-600">{{ $sudahJadwal }}</p>
                <p class="text-[11px] text-slate-400 font-medium mt-0.5">Terjadwal</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl px-5 py-3 text-center shadow-sm">
                <p class="text-2xl font-extrabold text-amber-500">{{ count($gurus) - $sudahJadwal }}</p>
                <p class="text-[11px] text-slate-400 font-medium mt-0.5">Belum</p>
            </div>
        </div>
    </div>

    {{-- GURU GRID --}}
    @if($gurus->isEmpty())
        <div class="bg-white border-2 border-dashed border-slate-200 rounded-2xl p-14 text-center">
            <div class="text-5xl mb-3">👨‍🏫</div>
            <p class="font-semibold text-slate-500">Belum ada data guru.</p>
            <p class="text-sm text-slate-400 mt-1">Tambahkan data guru melalui menu Manajemen Guru.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($gurus as $guru)
                @php
                    $hasJadwal    = isset($jadwals[$guru->id]) && count($jadwals[$guru->id]) > 0;
                    $totalSesi    = $hasJadwal ? count($jadwals[$guru->id]) : 0;
                    $avatarColors = [
                        'from-blue-500 to-indigo-600',
                        'from-violet-500 to-purple-600',
                        'from-rose-500 to-pink-600',
                        'from-teal-500 to-cyan-600',
                        'from-amber-500 to-orange-500',
                    ];
                    $avatarClass = $avatarColors[abs(crc32($guru->nama)) % count($avatarColors)];
                @endphp

                <div class="card-guru bg-white border {{ $hasJadwal ? 'border-slate-200' : 'border-dashed border-amber-300' }} rounded-2xl overflow-hidden">

                    {{-- Card Header --}}
                    <div class="flex items-center justify-between px-5 py-4 border-b {{ $hasJadwal ? 'border-slate-100' : 'border-amber-100 bg-amber-50/40' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $avatarClass }} flex items-center justify-center text-white font-bold text-sm flex-shrink-0 shadow-sm">
                                {{ strtoupper(substr($guru->nama, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate leading-tight">{{ $guru->nama }}</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">NBM. {{ $guru->nbm ?? 'tidak tersedia' }}</p>
                            </div>
                        </div>
                        @if($hasJadwal)
                            <span class="pill bg-emerald-100 text-emerald-700 flex-shrink-0">✓ {{ $totalSesi }} sesi</span>
                        @else
                            <span class="pill bg-amber-100 text-amber-600 flex-shrink-0">⚬ Kosong</span>
                        @endif
                    </div>

                    {{-- Sesi List --}}
                    <div class="px-4 py-3 space-y-2 max-h-72 overflow-y-auto">
                        @if($hasJadwal)
                            @foreach($jadwals[$guru->id] as $jadwal)
                                <div class="sesi-item flex items-center gap-3 bg-slate-50 border border-slate-100 rounded-xl px-3 py-2.5">

                                    {{-- Jam --}}
                                    <div class="flex-shrink-0 text-center bg-white border border-slate-200 rounded-lg px-2.5 py-1.5 min-w-[64px]">
                                        <p class="text-[11px] font-bold text-blue-600 tabular-nums">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                        </p>
                                        <div class="w-full h-px bg-slate-200 my-1"></div>
                                        <p class="text-[11px] font-bold text-slate-500 tabular-nums">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                        </p>
                                    </div>

                                    {{-- Info --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-slate-800 truncate leading-snug">
                                            {{ $jadwal->mataPelajaran->nama_mapel }}
                                        </p>
                                        <span class="pill bg-indigo-100 text-indigo-700 mt-1">
                                            🏫 {{ $jadwal->rombel->tingkat }} {{ $jadwal->rombel->nama_rombel }}
                                        </span>
                                    </div>

                                    {{-- Tombol Aksi --}}
                                    <div class="flex-shrink-0 flex items-center gap-1.5">

                                        <button
                                            type="button"
                                            class="btn-edit btn-action w-7 h-7 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 flex items-center justify-center"
                                            data-id="{{ $jadwal->id }}"
                                            data-mapel="{{ $jadwal->mataPelajaran->nama_mapel }}"
                                            data-rombel="{{ $jadwal->rombel->tingkat }} {{ $jadwal->rombel->nama_rombel }}"
                                            data-mapel-id="{{ $jadwal->mata_pelajaran_id }}"
                                            data-rombel-id="{{ $jadwal->rombel_id }}"
                                            data-jam-mulai="{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}"
                                            data-jam-selesai="{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}"
                                            title="Edit Jadwal">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>

                                        <button
                                            type="button"
                                            class="btn-delete btn-action w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 flex items-center justify-center"
                                            data-id="{{ $jadwal->id }}"
                                            data-mapel="{{ $jadwal->mataPelajaran->nama_mapel }}"
                                            data-rombel="{{ $jadwal->rombel->tingkat }} {{ $jadwal->rombel->nama_rombel }}"
                                            title="Hapus Jadwal">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <p class="text-3xl mb-1.5">📭</p>
                                <p class="text-sm text-slate-400">Belum ada jadwal hari ini.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Card Footer --}}
                    <div class="px-4 py-3 border-t {{ $hasJadwal ? 'border-slate-100 bg-slate-50/60' : 'border-amber-100 bg-amber-50/40' }}">
                        <a href="{{ route('staff_tu.jadwal_pelajaran.form', [$hari, $guru->id]) }}"
                           class="flex items-center justify-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Sesi Jadwal
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

    {{-- BACK --}}
    <div class="mt-8">
        <a href="{{ route('staff_tu.jadwal_pelajaran.index') }}"
           class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-blue-600 transition-colors font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Pilihan Hari
        </a>
    </div>
</div>

{{-- ================================================================ --}}
{{-- EDIT MODAL                                                         --}}
{{-- ================================================================ --}}
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 modal-overlay">
    <div class="modal-panel bg-white rounded-2xl shadow-2xl w-full max-w-md">

        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Edit Jadwal</h3>
                    <p class="text-xs text-slate-400" id="editSubtitle">Perbarui detail sesi mengajar</p>
                </div>
            </div>
            <button id="btnCloseEdit" type="button"
                class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-slate-700 transition">✕</button>
        </div>

        <form id="editForm" method="POST" action="#">
            @csrf
            @method('PUT')
            <div class="px-6 py-5 space-y-4">

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" id="editMapel"
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition">
                        @foreach(\App\Models\Tatausaha\MataPelajaran::orderBy('nama_mapel')->get() as $mp)
                            <option value="{{ $mp->id }}">{{ $mp->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">
                        Kelas (Rombel)
                        @if($tahunAktif)
                            <span class="text-blue-500 font-normal ml-1">— {{ $tahunAktif->tahun_ajaran }} Semester. {{ $tahunAktif->semester }}</span>
                        @endif
                    </label>
                    <select name="rombel_id" id="editRombel"
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition">
                        @if($rombelAktif->isEmpty())
                            <option value="" disabled>Tidak ada rombel aktif</option>
                        @else
                            @foreach($rombelAktif as $rb)
                                <option value="{{ $rb->id }}"> {{ $rb->tingkat }} -  {{ $rb->kode_rombel }} ( {{ $rb->nama_rombel }})</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="editJamMulai"
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="editJamSelesai"
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition">
                    </div>
                </div>

            </div>

            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/60 rounded-b-2xl flex items-center justify-end gap-2.5">
                <button type="button" id="btnCancelEdit"
                    class="px-4 py-2 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition shadow-sm shadow-blue-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ================================================================ --}}
{{-- DELETE MODAL                                                        --}}
{{-- ================================================================ --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 modal-overlay">
    <div class="modal-panel bg-white rounded-2xl shadow-2xl w-full max-w-sm">

        <div class="px-6 pt-6 pb-4 text-center">
            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 class="text-base font-bold text-slate-800 mb-1">Hapus Jadwal?</h3>
            <p class="text-sm text-slate-500">Jadwal ini akan dihapus permanen dan tidak bisa dipulihkan.</p>
        </div>

        <div class="mx-6 mb-5 bg-red-50 border border-red-200 rounded-xl px-4 py-3">
            <p class="text-xs font-semibold text-red-700 mb-1">Jadwal yang akan dihapus:</p>
            <p class="text-sm font-bold text-red-800" id="deleteMapelName">-</p>
            <p class="text-xs text-red-600 mt-0.5" id="deleteRombelName">-</p>
        </div>

        <div class="px-6 pb-6 flex items-center gap-2.5">
            <button type="button" id="btnCancelDelete"
                class="flex-1 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
                Batal
            </button>
            <form id="deleteForm" method="POST" action="#" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition shadow-sm shadow-red-200">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- URL di-render Blade di luar script block --}}
<div
    id="js-config"
    data-update-base="{{ rtrim(route('staff_tu.jadwal_pelajaran.update', ['jadwal' => 'REPLACE']), '/') }}"
    data-delete-base="{{ rtrim(route('staff_tu.jadwal_pelajaran.destroy', ['jadwal' => 'REPLACE']), '/') }}"
    style="display:none">
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var cfg        = document.getElementById('js-config');
    var updateBase = cfg.getAttribute('data-update-base').replace('/REPLACE', '/');
    var deleteBase = cfg.getAttribute('data-delete-base').replace('/REPLACE', '/');

    function showModal(id) {
        var el = document.getElementById(id);
        el.classList.remove('hidden');
        el.classList.add('flex');
    }

    function hideModal(id) {
        var el = document.getElementById(id);
        el.classList.add('hidden');
        el.classList.remove('flex');
    }

    /* tombol EDIT */
    document.querySelectorAll('.btn-edit').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var id         = this.getAttribute('data-id');
            var mapel      = this.getAttribute('data-mapel');
            var rombel     = this.getAttribute('data-rombel');
            var mapelId    = this.getAttribute('data-mapel-id');
            var rombelId   = this.getAttribute('data-rombel-id');
            var jamMulai   = this.getAttribute('data-jam-mulai');
            var jamSelesai = this.getAttribute('data-jam-selesai');

            document.getElementById('editSubtitle').textContent = mapel + ' · ' + rombel;
            document.getElementById('editForm').setAttribute('action', updateBase + id);
            document.getElementById('editMapel').value          = mapelId;
            document.getElementById('editRombel').value         = rombelId;
            document.getElementById('editJamMulai').value       = jamMulai;
            document.getElementById('editJamSelesai').value     = jamSelesai;

            showModal('editModal');
        });
    });

    /* tombol HAPUS */
    document.querySelectorAll('.btn-delete').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var id     = this.getAttribute('data-id');
            var mapel  = this.getAttribute('data-mapel');
            var rombel = this.getAttribute('data-rombel');

            document.getElementById('deleteMapelName').textContent  = mapel;
            document.getElementById('deleteRombelName').textContent = 'Kelas: ' + rombel;
            document.getElementById('deleteForm').setAttribute('action', deleteBase + id);

            showModal('deleteModal');
        });
    });

    /* tutup modal */
    document.getElementById('btnCloseEdit').addEventListener('click',    function () { hideModal('editModal');   });
    document.getElementById('btnCancelEdit').addEventListener('click',   function () { hideModal('editModal');   });
    document.getElementById('btnCancelDelete').addEventListener('click', function () { hideModal('deleteModal'); });

    document.getElementById('editModal').addEventListener('click', function (e) {
        if (e.target === this) hideModal('editModal');
    });
    document.getElementById('deleteModal').addEventListener('click', function (e) {
        if (e.target === this) hideModal('deleteModal');
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            hideModal('editModal');
            hideModal('deleteModal');
        }
    });

});
</script>

@endsection