@extends('layouts.staff_tu')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-6">Edit Surat Pindah</h2>

    <form action="{{ route('staff_tu.surat-pindah.update', $surat->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label>Nomor Surat</label>
                <input type="text" name="nomor_surat"
                       value="{{ $surat->nomor_surat }}"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Nama Siswa</label>
                <input type="text" name="nama_siswa"
                       value="{{ $surat->nama_siswa }}"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir"
                       value="{{ $surat->tempat_lahir }}"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                       value="{{ $surat->tanggal_lahir }}"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>NISN</label>
                <input type="text" name="nisn"
                       value="{{ $surat->nisn }}"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Kelas</label>
                <input type="text" name="kelas"
                       value="{{ $surat->kelas }}"
                       class="w-full border p-2 rounded">
            </div>

        </div>

        <div class="mt-4">
            <label>Alamat Siswa</label>
            <textarea name="alamat_siswa"
                      class="w-full border p-2 rounded">{{ $surat->alamat_siswa }}</textarea>
        </div>

        <div class="mt-4">
            <label>Nama Orang Tua</label>
            <input type="text" name="nama_ortu"
                   value="{{ $surat->nama_ortu }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mt-4">
            <label>Pekerjaan Orang Tua</label>
            <input type="text" name="pekerjaan_ortu"
                   value="{{ $surat->pekerjaan_ortu }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mt-4">
            <label>Alamat Orang Tua</label>
            <textarea name="alamat_ortu"
                      class="w-full border p-2 rounded">{{ $surat->alamat_ortu }}</textarea>
        </div>

        <div class="mt-4">
            <label>Tujuan Sekolah</label>
            <input type="text" name="tujuan_sekolah"
                   value="{{ $surat->tujuan_sekolah }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mt-6 flex justify-end space-x-2">
            <a href="{{ route('staff_tu.surat-pindah.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Kembali
            </a>

            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>

    </form>

</div>

@endsection
