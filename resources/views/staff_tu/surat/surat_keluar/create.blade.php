@extends('layouts.staff_tu')

@section('title', 'Tambah Surat Keluar')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
    body { background: #f9fafb; }

    .wrap { max-width: 760px; margin: 0 auto; padding: 2rem 1.25rem 3rem; }

    /* back */
    .back {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: .8125rem; font-weight: 500; color: #6b7280;
        text-decoration: none; margin-bottom: 1.5rem;
    }
    .back:hover { color: #111827; }

    /* header */
    .header { margin-bottom: 1.75rem; }
    .header h1 { font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0 0 4px; }
    .header p  { font-size: .875rem; color: #6b7280; margin: 0; }

    /* card */
    .card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }

    /* section inside card */
    .section {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .section:last-of-type { border-bottom: none; }
    .section-title {
        font-size: .6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #9ca3af;
        margin-bottom: 1rem;
    }

    /* grid */
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .col-span-2 { grid-column: span 2; }

    /* field */
    .field { display: flex; flex-direction: column; gap: 5px; }

    label {
        font-size: .8125rem;
        font-weight: 600;
        color: #374151;
    }
    label .req { color: #ef4444; margin-left: 2px; }

    .input, select.input, textarea.input {
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
        resize: vertical;
    }
    .input:focus, select.input:focus, textarea.input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    }
    .input.error { border-color: #ef4444; }

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

    .hint { font-size: .75rem; color: #9ca3af; }
    .err-msg { font-size: .75rem; color: #ef4444; }

    /* file input */
    .file-input {
        width: 100%;
        font-size: .8125rem;
        color: #374151;
        cursor: pointer;
    }
    .file-input::file-selector-button {
        background: #f3f4f6;
        border: 1.5px solid #e5e7eb;
        border-radius: 6px;
        padding: 5px 12px;
        font-size: .8125rem;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
        margin-right: 10px;
        transition: background .15s;
    }
    .file-input::file-selector-button:hover { background: #e5e7eb; }

    /* footer actions */
    .form-footer {
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: .75rem;
        background: #fafafa;
        border-top: 1px solid #f3f4f6;
    }
    .btn-cancel {
        background: #fff;
        border: 1.5px solid #e5e7eb;
        color: #374151;
        font-size: .875rem;
        font-weight: 600;
        padding: .5625rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        transition: background .15s;
    }
    .btn-cancel:hover { background: #f9fafb; }
    .btn-submit {
        background: #1d4ed8;
        color: #fff;
        font-size: .875rem;
        font-weight: 600;
        padding: .5625rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background .15s;
    }
    .btn-submit:hover { background: #1e40af; }

    @media (max-width: 560px) {
        .grid-2 { grid-template-columns: 1fr; }
        .col-span-2 { grid-column: span 1; }
    }
</style>

<div class="wrap">

    <a href="{{ route('staff_tu.surat_keluar.index') }}" class="back">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>

    <div class="header">
        <h1>Tambah Surat Keluar</h1>
        <p>Buat entri surat keluar baru</p>
    </div>

    <div class="card">
        <form action="{{ route('staff_tu.surat_keluar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Identitas Surat --}}
            <div class="section">
                <div class="section-title">Identitas Surat</div>
                <div class="grid-2">

                    <div class="field">
                        <label>Nomor Surat <span class="req">*</span></label>
                        <input type="text" name="nomor_surat"
                               value="{{ old('nomor_surat') }}"
                               placeholder="001/SK/TU/II/2026"
                               class="input {{ $errors->has('nomor_surat') ? 'error' : '' }}"
                               required>
                        @error('nomor_surat')
                            <span class="err-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label>Jenis Surat</label>
                        <div class="select-wrap">
                            <select name="jenis" class="input">
                                <option value="">— Pilih Jenis —</option>
                                @foreach(['Surat Undangan','Surat Edaran','Surat Keterangan','Surat Tugas','Surat Keputusan','Surat Pemberitahuan','Surat Permohonan','Surat Pengantar','Lainnya'] as $jenis)
                                    <option value="{{ $jenis }}" {{ old('jenis') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label>Tanggal Surat <span class="req">*</span></label>
                        <input type="date" name="tanggal_surat"
                               value="{{ old('tanggal_surat', date('Y-m-d')) }}"
                               class="input" required>
                    </div>

                    <div class="field">
                        <label>Tanggal Keluar <span class="req">*</span></label>
                        <input type="date" name="tanggal_keluar"
                               value="{{ old('tanggal_keluar', date('Y-m-d')) }}"
                               class="input" required>
                    </div>

                    <div class="field">
                        <label>Tujuan <span class="req">*</span></label>
                        <input type="text" name="tujuan"
                               value="{{ old('tujuan') }}"
                               placeholder="Nama instansi / penerima"
                               class="input" required>
                    </div>

                    <div class="field">
                        <label>Penandatangan</label>
                        <div class="select-wrap">
                            <select name="penandatangan" class="input">
                                <option value="">— Pilih Penandatangan —</option>
                                @foreach(['Kepala Sekolah','Wakil Kepala Sekolah','Kepala Tata Usaha','Lainnya'] as $ttd)
                                    <option value="{{ $ttd }}" {{ old('penandatangan') == $ttd ? 'selected' : '' }}>{{ $ttd }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="field col-span-2">
                        <label>Perihal <span class="req">*</span></label>
                        <input type="text" name="perihal"
                               value="{{ old('perihal') }}"
                               placeholder="Perihal surat"
                               class="input" required>
                    </div>

                </div>
            </div>

            {{-- Isi & Keterangan --}}
            <div class="section">
                <div class="section-title">Isi & Keterangan</div>
                <div class="grid-2">

                    <div class="field col-span-2">
                        <label>Isi Surat</label>
                        <textarea name="isi" rows="4" class="input"
                                  placeholder="Ringkasan isi surat...">{{ old('isi') }}</textarea>
                    </div>

                    <div class="field col-span-2">
                        <label>Keterangan</label>
                        <textarea name="keterangan" rows="3" class="input"
                                  placeholder="Keterangan tambahan...">{{ old('keterangan') }}</textarea>
                    </div>

                </div>
            </div>

            {{-- Lampiran & Status --}}
            <div class="section">
                <div class="section-title">Lampiran & Status</div>
                <div class="grid-2">

                    <div class="field">
                        <label>Lampiran</label>
                        <input type="file" name="lampiran"
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                               class="file-input">
                        <span class="hint">PDF, DOC, DOCX, JPG, PNG · Maks. 5MB</span>
                    </div>

                    <div class="field">
                        <label>Status <span class="req">*</span></label>
                        <div class="select-wrap">
                            <select name="status" class="input" required>
                                <option value="Draf"     {{ old('status','Draf') == 'Draf'     ? 'selected' : '' }}>Draf</option>
                                <option value="Terkirim" {{ old('status')         == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Actions --}}
            <div class="form-footer">
                <a href="{{ route('staff_tu.surat_keluar.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">Simpan Surat</button>
            </div>

        </form>
    </div>

</div>
@endsection