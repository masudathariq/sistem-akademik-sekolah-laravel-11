@extends('layouts.bendahara')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
    body { background: #f9fafb; }

    .wrap { max-width: 560px; margin: 0 auto; padding: 2rem 1.25rem; }

    .back {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: .8125rem; font-weight: 500; color: #6b7280;
        text-decoration: none; margin-bottom: 1.5rem;
    }
    .back:hover { color: #111827; }

    .header { margin-bottom: 1.75rem; }
    .header h1 { font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0 0 4px; }
    .header p  { font-size: .875rem; color: #6b7280; margin: 0; }

    .card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
    }

    .field { margin-bottom: 1.25rem; }
    .field:last-of-type { margin-bottom: 0; }

    label {
        display: block;
        font-size: .8125rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .input, select.input {
        width: 100%;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: .5625rem .75rem;
        font-size: .875rem;
        color: #111827;
        background: #fff;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        appearance: none;
    }
    .input:focus, select.input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    }
    .input:disabled {
        background: #f9fafb;
        color: #6b7280;
        cursor: not-allowed;
    }

    .select-wrap { position: relative; }
    .select-wrap::after {
        content: '';
        pointer-events: none;
        position: absolute;
        right: .75rem; top: 50%;
        transform: translateY(-50%);
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 5px solid #9ca3af;
    }

    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

    .hint { font-size: .75rem; color: #9ca3af; margin-top: 5px; }

    .divider { border: none; border-top: 1px solid #f3f4f6; margin: 1.25rem 0; }

    .result-box {
        background: #f0fdf4;
        border: 1.5px solid #bbf7d0;
        border-radius: 8px;
        padding: .75rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .result-label { font-size: .8125rem; font-weight: 600; color: #166534; }
    .result-value { font-size: 1.125rem; font-weight: 700; color: #15803d; }

    .btn-submit {
        width: 100%;
        margin-top: 1.5rem;
        background: #1d4ed8;
        color: #fff;
        font-size: .875rem;
        font-weight: 600;
        padding: .6875rem 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background .15s;
    }
    .btn-submit:hover { background: #1e40af; }

    @media (max-width: 480px) {
        .grid-2 { grid-template-columns: 1fr; }
    }
</style>

<div class="wrap">

    <a href="{{ route('bendahara.gaji-pokok.index') }}" class="back">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>

    <div class="header">
        <h1>Edit Gaji Pokok</h1>
        <p>Perbarui data jam dan tarif guru</p>
    </div>

    <div class="card">
        <form action="{{ route('bendahara.gaji-pokok.update', ['gaji_pokok' => $gaji_pokok->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="guru_id">Nama Guru</label>
                <div class="select-wrap">
                    <select name="guru_id" id="guru_id" class="input" required>
                        <option value="">— Pilih Guru —</option>
                        @foreach($guruList as $guru)
                            <option value="{{ $guru->id }}" {{ $gaji_pokok->guru_id == $guru->id ? 'selected' : '' }}>
                                {{ $guru->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="divider">

            <div class="grid-2">
                <div class="field">
                    <label for="jumlah_jam">Jumlah Jam</label>
                    <input type="number" step="0.01" min="0" id="jumlah_jam" name="jumlah_jam"
                           value="{{ $gaji_pokok->jumlah_jam }}"
                           class="input" required>
                    <div class="hint">Jam mengajar per bulan</div>
                </div>
                <div class="field">
                    <label for="tarif_per_jam">Tarif / Jam (Rp)</label>
                    <input type="number" step="0.01" min="0" id="tarif_per_jam" name="tarif_per_jam"
                           value="{{ $gaji_pokok->tarif_per_jam }}"
                           class="input" required>
                    <div class="hint">Nominal per jam</div>
                </div>
            </div>

            <hr class="divider">

            <div class="result-box">
                <span class="result-label">Gaji Pokok</span>
                <span class="result-value">Rp {{ number_format($gaji_pokok->gaji_pokok, 0, ',', '.') }}</span>
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>

</div>
@endsection