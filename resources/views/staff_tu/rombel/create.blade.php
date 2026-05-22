@extends('layouts.staff_tu')

@section('title', 'Tambah Rombel')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap');

*{
    box-sizing:border-box;
}

:root {
    --navy:     #1e3a8a;
    --navy-md:  #1d4ed8;
    --navy-lt:  #dbeafe;
    --green:    #16a34a;
    --green-lt: #f0fdf4;
    --green-bd: #86efac;
    --red:      #dc2626;
    --red-lt:   #fff1f2;
    --red-bd:   #fecdd3;
    --gray-bg:  #f8fafc;
    --border:   #e2e8f0;
    --text:     #0f172a;
    --muted:    #64748b;
    --hint:     #94a3b8;
    --radius:   18px;
    --shadow:   0 10px 35px rgba(15, 23, 42, .06);
}

body{
    font-family: 'IBM Plex Sans', sans-serif;
    background: var(--gray-bg);
}

/* ================================
   PAGE
================================ */

.rb-page{
    width:100%;
    min-height:100vh;
    padding:2rem 3rem 4rem;
    background:var(--gray-bg);
}

/* ================================
   TOP HEADER
================================ */

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:2rem;
    gap:1rem;
    flex-wrap:wrap;
}

.page-title{
    display:flex;
    align-items:center;
    gap:16px;
}

.title-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 10px 25px rgba(37,99,235,.25);
}

.title-text h1{
    margin:0;
    font-size:30px;
    font-weight:700;
    color:var(--text);
    letter-spacing:-.03em;
}

.title-text p{
    margin-top:6px;
    color:var(--muted);
    font-size:14px;
}

/* ================================
   MAIN CARD
================================ */

.form-card{
    width:100%;
    background:#fff;
    border-radius:24px;
    border:1px solid var(--border);
    overflow:hidden;
    box-shadow:var(--shadow);
}

/* ================================
   HEADER CARD
================================ */

.form-header{
    padding:1.5rem 2rem;
    border-bottom:1px solid var(--border);
    background:
        linear-gradient(
            135deg,
            #eff6ff 0%,
            #ffffff 100%
        );
}

.form-header h2{
    margin:0;
    font-size:15px;
    font-weight:700;
    color:var(--navy);
    letter-spacing:.05em;
    text-transform:uppercase;
}

/* ================================
   BODY
================================ */

.form-body{
    padding:2rem;
}

/* ================================
   PREVIEW
================================ */

.info-preview{
    display:flex;
    align-items:center;
    gap:16px;
    background:linear-gradient(135deg,#eff6ff,#ffffff);
    border:1px solid #bfdbfe;
    border-radius:18px;
    padding:1rem 1.25rem;
    margin-bottom:2rem;
}

.info-preview-icon{
    width:52px;
    height:52px;
    border-radius:14px;
    background:white;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 5px 20px rgba(37,99,235,.10);
}

.info-preview-text p{
    margin:0;
}

.info-preview-text .label{
    font-size:12px;
    color:var(--muted);
    margin-bottom:4px;
}

.preview-value{
    font-size:18px;
    font-weight:700;
    color:var(--navy);
}

/* ================================
   FORM GRID
================================ */

.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:1.5rem;
}

/* ================================
   FORM GROUP
================================ */

.form-group{
    display:flex;
    flex-direction:column;
}

.full-width{
    grid-column:span 2;
}

.form-group label{
    font-size:12px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.06em;
    color:var(--muted);
    margin-bottom:10px;
}

.required{
    color:var(--red);
}

.info-badge{
    display:inline-flex;
    align-items:center;
    padding:4px 8px;
    border-radius:999px;
    background:#f1f5f9;
    color:#64748b;
    font-size:10px;
    font-weight:600;
    margin-left:6px;
    text-transform:none;
}

/* ================================
   INPUT
================================ */

.form-input,
.form-select{
    width:100%;
    height:54px;
    border:1px solid var(--border);
    border-radius:14px;
    padding:0 16px;
    font-size:14px;
    font-family:'IBM Plex Sans', sans-serif;
    color:var(--text);
    background:white;
    transition:.2s ease;
}

.form-input:focus,
.form-select:focus{
    outline:none;
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,.10);
}

.form-input::placeholder{
    color:var(--hint);
}

.form-input[readonly]{
    background:#f8fafc;
    cursor:not-allowed;
}

.form-hint{
    margin-top:8px;
    font-size:12px;
    color:var(--hint);
    line-height:1.5;
}

/* ================================
   BUTTONS
================================ */

.form-actions{
    margin-top:2rem;
    display:flex;
    gap:14px;
}

.btn-primary{
    height:52px;
    padding:0 24px;
    border:none;
    border-radius:14px;
    background:linear-gradient(135deg,#16a34a,#15803d);
    color:white;
    font-size:14px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:10px;
    cursor:pointer;
    transition:.2s ease;
    text-decoration:none;
}

.btn-primary:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 24px rgba(22,163,74,.18);
}

.btn-secondary{
    height:52px;
    padding:0 24px;
    border-radius:14px;
    border:1px solid var(--border);
    background:white;
    color:var(--muted);
    font-size:14px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:10px;
    text-decoration:none;
    transition:.2s ease;
}

.btn-secondary:hover{
    background:#f8fafc;
}

/* ================================
   ERROR ALERT
================================ */

.error-alert{
    display:flex;
    align-items:flex-start;
    gap:14px;
    background:#fff1f2;
    border:1px solid #fecdd3;
    border-radius:18px;
    padding:1rem 1.25rem;
    margin-bottom:1.5rem;
}

.error-title{
    font-size:14px;
    font-weight:700;
    color:#b91c1c;
    margin-bottom:6px;
}

.error-list{
    margin:0;
    padding-left:18px;
    color:#be123c;
    font-size:13px;
}

/* ================================
   RESPONSIVE
================================ */

@media (max-width: 992px){

    .rb-page{
        padding:1.25rem;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .full-width{
        grid-column:span 1;
    }

    .form-actions{
        flex-direction:column;
    }

    .btn-primary,
    .btn-secondary{
        width:100%;
        justify-content:center;
    }

    .title-text h1{
        font-size:24px;
    }

}
</style>

<div class="rb-page">

    {{-- TOP BAR --}}
    <div class="top-bar">

        <div class="page-title">

            <div class="title-icon">
                <svg width="28"
                     height="28"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="white"
                     stroke-width="2.2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7l-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"/>
                </svg>
            </div>

            <div class="title-text">
                <h1>Tambah Rombel</h1>
                <p>
                    Kelola data rombongan belajar secara modern dan profesional
                </p>
            </div>

        </div>

    </div>

    {{-- ERROR --}}
    @if ($errors->any())
    <div class="error-alert">

        <div>
            <svg width="22"
                 height="22"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="#dc2626"
                 stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>

        <div>
            <div class="error-title">
                Terjadi kesalahan pada pengisian form
            </div>

            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    </div>
    @endif

    {{-- FORM CARD --}}
    <div class="form-card">

        <div class="form-header">
            <h2>Formulir Data Rombel</h2>
        </div>

        <div class="form-body">

            {{-- PREVIEW --}}
            <div class="info-preview"
                 id="previewCard"
                 style="display:none;">

                <div class="info-preview-icon">
                    <svg width="22"
                         height="22"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="#2563eb"
                         stroke-width="2">
                        <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7l-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"/>
                    </svg>
                </div>

                <div class="info-preview-text">
                    <p class="label">Preview Rombel</p>
                    <p class="preview-value" id="previewText">-</p>
                </div>

            </div>

            <form action="{{ url('/staff_tu/rombel') }}"
                  method="POST">

                @csrf

                <div class="form-grid">

                    {{-- TAHUN AJARAN --}}
                    <div class="form-group full-width">

                        <label>
                            Tahun Ajaran Aktif
                            <span class="info-badge">
                                Tidak dapat diubah
                            </span>
                        </label>

                        <input type="text"
                               class="form-input"
                               value="{{ $tahunAjaranAktif?->tahun_ajaran }} ({{ $tahunAjaranAktif?->semester }})"
                               readonly>

                        <div class="form-hint">
                            Data rombel akan otomatis terhubung dengan tahun ajaran aktif.
                        </div>

                    </div>

                    {{-- TINGKAT --}}
                    <div class="form-group">

                        <label>
                            Tingkat
                            <span class="required">*</span>
                        </label>

                        <select name="tingkat"
                                id="tingkat"
                                class="form-select"
                                required>

                            <option value="" disabled selected>
                                -- Pilih Tingkat --
                            </option>

                            <option value="7" {{ old('tingkat') == 7 ? 'selected' : '' }}>
                                VII (Tujuh)
                            </option>

                            <option value="8" {{ old('tingkat') == 8 ? 'selected' : '' }}>
                                VIII (Delapan)
                            </option>

                            <option value="9" {{ old('tingkat') == 9 ? 'selected' : '' }}>
                                IX (Sembilan)
                            </option>

                        </select>

                        <div class="form-hint">
                            Pilih tingkat kelas rombel.
                        </div>

                    </div>

                    {{-- KODE ROMBEL --}}
                    <div class="form-group">

                        <label>
                            Kode Rombel
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="kode_rombel"
                               id="kode_rombel"
                               class="form-input"
                               placeholder="Contoh: A, B, C"
                               value="{{ old('kode_rombel') }}"
                               autocomplete="off"
                               required>

                        <div class="form-hint">
                            Gunakan kode unik untuk identifikasi.
                        </div>

                    </div>

                    {{-- NAMA ROMBEL --}}
                    <div class="form-group full-width">

                        <label>
                            Nama Rombel
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="nama_rombel"
                               id="nama_rombel"
                               class="form-input"
                               placeholder="Contoh: Tahfidz, Al-Hakim"
                               value="{{ old('nama_rombel') }}"
                               autocomplete="off"
                               required>

                        <div class="form-hint">
                            Nama lengkap atau nama khusus rombel.
                        </div>

                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-actions">

                    <button type="submit"
                            class="btn-primary">

                        <svg width="16"
                             height="16"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2.5">
                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                        </svg>

                        Simpan Rombel

                    </button>

                    <a href="{{ url('/staff_tu/rombel') }}"
                       class="btn-secondary">

                        <svg width="16"
                             height="16"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const tingkat      = document.getElementById('tingkat');
    const kodeRombel   = document.getElementById('kode_rombel');
    const namaRombel   = document.getElementById('nama_rombel');

    const previewCard  = document.getElementById('previewCard');
    const previewText  = document.getElementById('previewText');

    function getTingkatLabel(value) {
        if (value === '7') return 'VII';
        if (value === '8') return 'VIII';
        if (value === '9') return 'IX';
        return '';
    }

    function updatePreview() {

        const tingkatValue = tingkat.value;
        const kodeValue    = kodeRombel.value.trim();
        const namaValue    = namaRombel.value.trim();

        if (tingkatValue || kodeValue || namaValue) {

            let result = `Kelas ${getTingkatLabel(tingkatValue)}`;

            if (kodeValue) {
                result += ` - ${kodeValue}`;
            }

            if (namaValue) {
                result += ` (${namaValue})`;
            }

            previewText.textContent = result;
            previewCard.style.display = 'flex';

        } else {

            previewCard.style.display = 'none';

        }

    }

    tingkat.addEventListener('change', updatePreview);
    kodeRombel.addEventListener('input', updatePreview);
    namaRombel.addEventListener('input', updatePreview);

    updatePreview();

});
</script>

@endsection