@extends('layouts.staff_tu')

@section('title', 'Edit Surat Keluar')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
    body { background: #f9fafb; }

    .wrap { max-width: 760px; margin: 0 auto; padding: 2rem 1.25rem 3rem; }

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

    .section-label {
        font-size: .6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #9ca3af;
        margin-bottom: 1rem;
    }

    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .col-2  { grid-column: span 2; }

    .field { margin-bottom: 0; }

    label {
        display: block;
        font-size: .8125rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 5px;
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
    }
    .input:focus, select.input:focus, textarea.input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    }
    .input.is-error { border-color: #ef4444; }
    textarea.input { resize: vertical; }

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

    .error-msg { font-size: .75rem; color: #ef4444; margin-top: 4px; }
    .hint      { font-size: .75rem; color: #9ca3af; margin-top: 4px; }

    .divider { border: none; border-top: 1px solid #f3f4f6; margin: 1.25rem 0; }

    /* lampiran box */
    .file-current {
        display: flex; align-items: center; gap: 8px;
        background: #eff6ff;
        border: 1.5px solid #bfdbfe;
        border-radius: 8px;
        padding: .625rem .875rem;
        margin-bottom: .625rem;
    }
    .file-current a {
        font-size: .8125rem; font-weight: 600;
        color: #2563eb; text-decoration: none;
    }
    .file-current a:hover { text-decoration: underline; }
    .file-current span { font-size: .75rem; color: #6b7280; }

    input[type="file"].input-file {
        width: 100%;
        font-size: .8125rem;
        color: #374151;
        border: 1.5px dashed #e5e7eb;
        border-radius: 8px;
        padding: .5rem .75rem;
        background: #fafafa;
        cursor: pointer;
        transition: border-color .15s;
    }
    input[type="file"].input-file:hover { border-color: #93c5fd; }

    /* footer */
    .form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: .75rem;
        padding-top: 1.25rem;
        border-top: 1px solid #f3f4f6;
        margin-top: 1.5rem;
    }
    .btn-cancel {
        background: #f3f4f6; color: #374151;
        font-size: .875rem; font-weight: 600;
        padding: .5625rem 1.125rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        text-decoration: none;
        transition: background .15s;
    }
    .btn-cancel:hover { background: #e5e7eb; }
    .btn-submit {
        background: #1d4ed8; color: #fff;
        font-size: .875rem; font-weight: 600;
        padding: .5625rem 1.375rem;
        border: none; border-radius: 8px;
        cursor: pointer;
        transition: background .15s;
    }
    .btn-submit:hover { background: #1e40af; }

    @media (max-width: 560px) {
        .grid-2 { grid-template-columns: 1fr; }
        .col-2  { grid-column: span 1; }
    }
</style>

<div class="wrap">

    <a href="{{ route('staff_tu.surat_keluar.index') }}" class="back">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>

    <div class="header">
        <h1>Edit Surat Keluar</h1>
        <p>Perbarui data surat keluar</p>
    </div>

    <div class="card">
        <form action="{{ route('staff_tu.surat_keluar.update', $suratKeluar) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Identitas Surat --}}
            <div class="section-label">Identitas Surat</div>
            <div class="grid-2">

                <div class="field">
                    <label>Nomor Surat <span class="req">*</span></label>
                    <input type="text" name="nomor_surat"
                           value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}"
                           class="input {{ $errors->has('nomor_surat') ? 'is-error' : '' }}"
                           required>
                    @error('nomor_surat')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Jenis Surat</label>
                    <div class="select-wrap">
                        <select name="jenis" class="input">
                            <option value="">— Pilih Jenis —</option>
                            @foreach(['Surat Undangan','Surat Edaran','Surat Keterangan','Surat Tugas','Surat Keputusan','Surat Pemberitahuan','Surat Permohonan','Surat Pengantar','Lainnya'] as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis', $suratKeluar->jenis) == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Tanggal Surat <span class="req">*</span></label>
                    <input type="date" name="tanggal_surat"
                           value="{{ old('tanggal_surat', $suratKeluar->tanggal_surat->format('Y-m-d')) }}"
                           class="input" required>
                </div>

                <div class="field">
                    <label>Tanggal Keluar <span class="req">*</span></label>
                    <input type="date" name="tanggal_keluar"
                           value="{{ old('tanggal_keluar', $suratKeluar->tanggal_keluar->format('Y-m-d')) }}"
                           class="input" required>
                </div>

                <div class="field">
                    <label>Tujuan <span class="req">*</span></label>
                    <input type="text" name="tujuan"
                           value="{{ old('tujuan', $suratKeluar->tujuan) }}"
                           class="input" required>
                </div>

                <div class="field">
                    <label>Penandatangan</label>
                    <div class="select-wrap">
                        <select name="penandatangan" class="input">
                            <option value="">— Pilih —</option>
                            @foreach(['Kepala Sekolah','Wakil Kepala Sekolah','Kepala Tata Usaha','Lainnya'] as $ttd)
                                <option value="{{ $ttd }}" {{ old('penandatangan', $suratKeluar->penandatangan) == $ttd ? 'selected' : '' }}>
                                    {{ $ttd }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="field col-2">
                    <label>Perihal <span class="req">*</span></label>
                    <input type="text" name="perihal"
                           value="{{ old('perihal', $suratKeluar->perihal) }}"
                           class="input" required>
                </div>

            </div>

            <hr class="divider">

            {{-- Isi & Keterangan --}}
            <div class="section-label">Isi & Keterangan</div>
            <div style="display:flex; flex-direction:column; gap:1rem;">

                <div class="field">
                    <label>Isi Surat</label>
                    <textarea name="isi" rows="4" class="input">{{ old('isi', $suratKeluar->isi) }}</textarea>
                </div>

                <div class="field">
                    <label>Keterangan</label>
                    <textarea name="keterangan" rows="3" class="input"
                              placeholder="Keterangan tambahan...">{{ old('keterangan', $suratKeluar->keterangan) }}</textarea>
                </div>

            </div>

            <hr class="divider">

            {{-- Lampiran & Status --}}
            <div class="section-label">Lampiran & Status</div>
            <div class="grid-2">

                <div class="field col-2">
                    <label>Lampiran</label>
                    @if($suratKeluar->lampiran)
                        <div class="file-current">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                            <a href="{{ route('staff_tu.surat_keluar.download', $suratKeluar) }}">
                                {{ $suratKeluar->lampiran_nama }}
                            </a>
                            <span>· File saat ini</span>
                        </div>
                    @endif
                    <input type="file" name="lampiran"
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                           class="input-file">
                    <div class="hint">
                        PDF, DOC, DOCX, JPG, PNG · Maks. 5MB
                        @if($suratKeluar->lampiran) · Kosongkan jika tidak ingin mengganti @endif
                    </div>
                </div>

                <div class="field col-2" style="max-width:240px;">
                    <label>Status <span class="req">*</span></label>
                    <div class="select-wrap">
                        <select name="status" class="input" required>
                            <option value="Draf"     {{ old('status', $suratKeluar->status) == 'Draf'     ? 'selected' : '' }}>Draf</option>
                            <option value="Terkirim" {{ old('status', $suratKeluar->status) == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-footer">
                <a href="{{ route('staff_tu.surat_keluar.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </div>

        </form>
    </div>

</div>
@endsection