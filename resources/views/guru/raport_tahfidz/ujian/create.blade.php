@extends('layouts.guru')

@section('title', 'Input Nilai Ujian')

@section('content')

<style>
:root {
    --ink:          #0D1117;
    --ink-soft:     #3D4A5C;
    --ink-muted:    #6B7A8E;
    --ink-faint:    #A8B3BF;
    --surface:      #FFFFFF;
    --surface-alt:  #F6F8FA;
    --border:       #E1E6EC;
    --border-soft:  #EDF0F4;
    --accent:       #1A56DB;
    --accent-tint:  #EBF1FF;
    --emerald:      #047857;
    --emerald-tint: #D1FAE5;
    --rose:         #BE123C;
    --rose-tint:    #FFE4E6;
    --shadow-sm:    0 1px 4px rgba(0,0,0,0.06);
    --shadow-md:    0 4px 16px rgba(0,0,0,0.08);
    --r-sm: 6px;
    --r-md: 10px;
    --r-lg: 14px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.rt-wrap {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: var(--surface-alt);
    min-height: 100vh;
    padding: 28px 32px 48px;
    color: var(--ink);
}

/* ═══════════════════════════
   PAGE HEADER
═══════════════════════════ */
.rt-page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 24px;
    gap: 16px;
}

.rt-breadcrumb {
    font-size: 12px;
    color: var(--ink-muted);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.rt-breadcrumb-sep { color: var(--ink-faint); }

.rt-page-title {
    font-size: 22px;
    font-weight: 700;
    color: var(--ink);
    letter-spacing: -0.3px;
    margin-bottom: 3px;
}

.rt-page-sub {
    font-size: 13px;
    color: var(--ink-muted);
}

.rt-header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
    padding-top: 4px;
}

/* ═══════════════════════════
   BUTTONS
═══════════════════════════ */
.rt-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: var(--r-sm);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.14s ease;
    white-space: nowrap;
    font-family: inherit;
}

.rt-btn-primary {
    background: var(--emerald);
    color: white;
    border-color: var(--emerald);
}
.rt-btn-primary:hover { background: #036644; }

.rt-btn-ghost {
    background: var(--surface);
    color: var(--ink-soft);
    border-color: var(--border);
    text-decoration: none;
}
.rt-btn-ghost:hover {
    border-color: var(--accent);
    color: var(--accent);
}

/* ═══════════════════════════
   FORM CARD
═══════════════════════════ */
.rt-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 16px;
}

.rt-card-header {
    padding: 14px 20px;
    border-bottom: 1px solid var(--border-soft);
    background: var(--surface-alt);
    display: flex;
    align-items: center;
    gap: 10px;
}

.rt-card-header-icon {
    width: 32px;
    height: 32px;
    border-radius: var(--r-sm);
    background: var(--emerald-tint);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
}

.rt-card-header-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
}

.rt-card-header-sub {
    font-size: 12px;
    color: var(--ink-muted);
    margin-top: 1px;
}

.rt-card-body {
    padding: 20px;
}

/* ═══════════════════════════
   FORM ELEMENTS
═══════════════════════════ */
.rt-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 7px;
}

.rt-input {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid var(--border);
    border-radius: var(--r-sm);
    font-size: 13px;
    font-family: inherit;
    color: var(--ink);
    background: var(--surface);
    transition: all 0.14s;
    outline: none;
}

.rt-input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
}

.rt-input::placeholder { color: var(--ink-faint); }

.rt-error {
    font-size: 12px;
    color: var(--rose);
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* ═══════════════════════════
   ALERT
═══════════════════════════ */
.rt-alert-success {
    background: var(--emerald-tint);
    border: 1px solid #a7f3d0;
    color: var(--emerald);
    border-radius: var(--r-md);
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* ═══════════════════════════
   STUDENT TABLE
═══════════════════════════ */
.rt-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 20px;
}

.rt-table {
    width: 100%;
    border-collapse: collapse;
}

.rt-table thead tr {
    background: var(--surface-alt);
    border-bottom: 1px solid var(--border);
}

.rt-table th {
    padding: 10px 16px;
    font-size: 11px;
    font-weight: 600;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.6px;
    text-align: left;
    white-space: nowrap;
}

.rt-table th.right { text-align: right; }
.rt-table th.center { text-align: center; }

.rt-table tbody tr {
    border-bottom: 1px solid var(--border-soft);
    transition: background 0.12s;
    animation: fadeRow 0.3s ease both;
}

.rt-table tbody tr:last-child { border-bottom: none; }
.rt-table tbody tr:hover { background: var(--surface-alt); }

.rt-table tbody tr:nth-child(1)   { animation-delay: 0.03s; }
.rt-table tbody tr:nth-child(2)   { animation-delay: 0.06s; }
.rt-table tbody tr:nth-child(3)   { animation-delay: 0.09s; }
.rt-table tbody tr:nth-child(4)   { animation-delay: 0.12s; }
.rt-table tbody tr:nth-child(5)   { animation-delay: 0.15s; }
.rt-table tbody tr:nth-child(n+6) { animation-delay: 0.17s; }

@keyframes fadeRow {
    from { opacity: 0; transform: translateY(5px); }
    to   { opacity: 1; transform: translateY(0); }
}

.rt-table td {
    padding: 12px 16px;
    font-size: 13px;
    vertical-align: middle;
}

.rt-table td.right  { text-align: right; }
.rt-table td.center { text-align: center; }

/* Row number */
.rt-num {
    width: 26px;
    height: 26px;
    background: var(--surface-alt);
    border: 1px solid var(--border);
    border-radius: var(--r-sm);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    color: var(--ink-muted);
}

/* Avatar */
.rt-avatar {
    width: 34px;
    height: 34px;
    border-radius: var(--r-sm);
    background: var(--accent-tint);
    border: 1px solid #bfdbfe;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: var(--accent);
    flex-shrink: 0;
}

.rt-student-cell {
    display: flex;
    align-items: center;
    gap: 11px;
}

.rt-student-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 1px;
}

.rt-student-meta {
    font-size: 11px;
    color: var(--ink-muted);
}

/* Nilai input in table */
.rt-nilai-input {
    width: 90px;
    padding: 7px 10px;
    border: 1px solid var(--border);
    border-radius: var(--r-sm);
    font-size: 14px;
    font-weight: 700;
    font-family: inherit;
    color: var(--ink);
    text-align: center;
    background: var(--surface);
    transition: all 0.14s;
    outline: none;
}

.rt-nilai-input:focus {
    border-color: var(--emerald);
    box-shadow: 0 0 0 3px rgba(4,120,87,0.1);
}

.rt-nilai-input::placeholder {
    color: var(--ink-faint);
    font-weight: 400;
}

/* Score badge shown when filled */
.rt-score-indicator {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    margin-left: 6px;
    vertical-align: middle;
    opacity: 0;
    transition: opacity 0.2s;
}

.si-good { background: var(--emerald-tint); color: var(--emerald); }
.si-mid  { background: #FEF3C7;              color: #B45309; }
.si-low  { background: var(--rose-tint);     color: var(--rose); }

/* ═══════════════════════════
   FORM FOOTER
═══════════════════════════ */
.rt-form-footer {
    display: flex;
    align-items: center;
    gap: 8px;
}
</style>

<div class="rt-wrap">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="rt-page-header">
        <div>
            <div class="rt-breadcrumb">
                <span>Guru</span>
                <span class="rt-breadcrumb-sep">›</span>
                <a href="{{ route('guru.raport-tahfidz.index') }}" style="color:var(--ink-muted);text-decoration:none;">Raport Tahfidz</a>
                <span class="rt-breadcrumb-sep">›</span>
                <span>Input Nilai Ujian</span>
            </div>
            <div class="rt-page-title">Input Nilai Ujian</div>
            <div class="rt-page-sub">Isi nilai masing-masing siswa (1 – 100)</div>
        </div>
        <div class="rt-header-actions">
            <a href="{{ route('guru.raport-tahfidz.index') }}" class="rt-btn rt-btn-ghost">
                ← Kembali
            </a>
        </div>
    </div>

    {{-- ===== ALERT ===== --}}
    @if(session('success'))
    <div class="rt-alert-success">
        ✅ {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('guru.raport-ujian.store') }}" method="POST">
        @csrf

        {{-- ===== NAMA UJIAN CARD ===== --}}
        <div class="rt-card">
            <div class="rt-card-header">
                <div class="rt-card-header-icon">📝</div>
                <div>
                    <div class="rt-card-header-title">Nama Ujian</div>
                    <div class="rt-card-header-sub">Identifikasi ujian yang akan dinilai</div>
                </div>
            </div>
            <div class="rt-card-body">
                <label class="rt-label">Nama Ujian</label>
                <input type="text"
                       name="nama_ujian"
                       class="rt-input"
                       value="{{ old('nama_ujian', $nama_ujian_terakhir ?? '') }}"
                       placeholder="Contoh: Ujian Akhir Semester">
                @error('nama_ujian')
                <div class="rt-error">⚠ {{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- ===== STUDENT TABLE ===== --}}
        <div class="rt-table-wrap">
            <table class="rt-table">
                <thead>
                    <tr>
                        <th style="width:48px;">#</th>
                        <th>Siswa</th>
                        <th class="center" style="width:160px;">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswas as $index => $siswa)
                    @php
                        $nama_ujian_input = old('nama_ujian', $nama_ujian_terakhir ?? '');
                        $nilai_lama = $nilai_ujian[$nama_ujian_input][$siswa->id]->nilai_ujian ?? '';
                        $initial = mb_strtoupper(mb_substr($siswa->nama_siswa, 0, 1));
                    @endphp
                    <tr>
                        <td><span class="rt-num">{{ $index + 1 }}</span></td>

                        <td>
                            <div class="rt-student-cell">
                                <div class="rt-avatar">{{ $initial }}</div>
                                <div>
                                    <div class="rt-student-name">{{ $siswa->nama_siswa }}</div>
                                    @if($siswa->nis || isset($siswa->rombel))
                                    <div class="rt-student-meta">
                                        @if($siswa->nis) NIS {{ $siswa->nis }} @endif
                                        @if(isset($siswa->rombel)) &nbsp;·&nbsp; {{ $siswa->rombel->tingkat ?? '' }} – {{ $siswa->rombel->nama_rombel ?? '' }} @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                        </td>

                        <td class="center">
                            <input type="number"
                                   name="nilai_ujian[]"
                                   min="1" max="100"
                                   class="rt-nilai-input"
                                   placeholder="—"
                                   data-index="{{ $index }}"
                                   value="{{ old('nilai_ujian.'.$index, $nilai_lama) }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ===== FOOTER ===== --}}
        <div class="rt-form-footer">
            <button type="submit" class="rt-btn rt-btn-primary">
                💾 Simpan Nilai
            </button>
            <a href="{{ route('guru.raport-tahfidz.index') }}" class="rt-btn rt-btn-ghost">
                Batal
            </a>
        </div>

    </form>

</div>

<script>
// Highlight input color based on value
document.querySelectorAll('.rt-nilai-input').forEach(input => {
    const update = () => {
        const v = parseInt(input.value);
        if (!input.value || isNaN(v)) {
            input.style.borderColor = '';
            input.style.color = '';
            return;
        }
        if (v >= 80) {
            input.style.borderColor = 'var(--emerald)';
            input.style.color = 'var(--emerald)';
        } else if (v >= 60) {
            input.style.borderColor = '#D97706';
            input.style.color = '#B45309';
        } else {
            input.style.borderColor = 'var(--rose)';
            input.style.color = 'var(--rose)';
        }
    };
    input.addEventListener('input', update);
    update(); // apply on load if value exists
});
</script>

@endsection