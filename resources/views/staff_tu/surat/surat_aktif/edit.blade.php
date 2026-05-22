@extends('layouts.staff_tu')

@section('content')

<h2>Edit Surat Keterangan Aktif Siswa</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('staff_tu.surat-aktif.update', $surat->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nomor Surat</label><br>
        <input type="text" name="nomor_surat"
               value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
    </div>

    <br>

    <div>
        <label>Tanggal Surat</label><br>
        <input type="date" name="tanggal_surat"
               value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required>
    </div>

    <br>

    <div>
        <label>Rombel</label><br>
        <select id="rombel">
            <option value="">-- Pilih Rombel --</option>
            @foreach($rombels as $rombel)
                <option value="{{ $rombel->id }}"
                    {{ $surat->siswa->rombel_id == $rombel->id ? 'selected' : '' }}>
                    {{ $rombel->tingkat_romawi }} - {{ $rombel->nama_rombel }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Siswa</label><br>
        <select name="siswa_id" id="siswa" required>
            <option value="">-- Pilih Siswa --</option>
        </select>
    </div>

    <br>

    <button type="submit">Update</button>

    <a href="{{ route('staff_tu.surat-aktif.index') }}">
        <button type="button">Kembali</button>
    </a>

</form>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let rombelSelect = document.getElementById('rombel');
    let siswaSelect = document.getElementById('siswa');

    let selectedRombel = "{{ $surat->siswa->rombel_id }}";
    let selectedSiswa = "{{ $surat->siswa_id }}";

    function loadSiswa(rombelId, selectedSiswaId = null) {

        if (!rombelId) {
            siswaSelect.innerHTML =
                '<option value="">-- Pilih Siswa --</option>';
            return;
        }

        fetch("{{ route('staff_tu.get-siswa', ':id') }}"
                .replace(':id', rombelId))
            .then(response => response.json())
            .then(data => {

                siswaSelect.innerHTML =
                    '<option value="">-- Pilih Siswa --</option>';

                if (data.length === 0) {
                    siswaSelect.innerHTML +=
                        '<option value="">Tidak ada siswa</option>';
                } else {
                    data.forEach(function (siswa) {

                        let selected =
                            siswa.id == selectedSiswaId ? 'selected' : '';

                        siswaSelect.innerHTML +=
                            `<option value="${siswa.id}" ${selected}>
                                ${siswa.nama_siswa}
                            </option>`;
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Saat halaman load (auto isi siswa lama)
    if (selectedRombel) {
        rombelSelect.value = selectedRombel;
        loadSiswa(selectedRombel, selectedSiswa);
    }

    // Saat rombel diganti
    rombelSelect.addEventListener('change', function () {
        loadSiswa(this.value);
    });

});
</script>

@endsection
