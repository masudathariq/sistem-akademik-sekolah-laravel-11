@extends('layouts.guru')

@section('content')

@php
    $status = $absensi->status ?? null;
    $sudahIzinAtauSakit = in_array($status, ['izin', 'sakit']);
    $sudahMasuk  = !empty($absensi->jam_masuk);
    $sudahPulang = !empty($absensi->jam_pulang);
@endphp

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');

:root {
    --navy: #020659;
    --navy-light: #1a237e;
    --gray-50: #F8FAFC;
    --gray-100: #F1F5F9;
    --gray-200: #E2E8F0;
    --gray-400: #94A3B8;
    --gray-500: #64748B;
    --gray-700: #334155;
    --gray-800: #1E293B;
    --gray-900: #0F172A;
    --blue: #2563EB;
    --green: #059669;
    --green-light: #ECFDF5;
    --amber: #D97706;
    --amber-light: #FFFBEB;
    --red: #DC2626;
    --red-light: #FEF2F2;
    --radius-sm: 10px;
    --radius-md: 14px;
    --radius-lg: 20px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-lg: 0 16px 40px rgba(0,0,0,0.14);
}

*, *::before, *::after { box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
body { margin: 0; padding: 0; font-family: 'Nunito', sans-serif; background: var(--gray-50); }

@keyframes slideUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
@keyframes spin    { to { transform: rotate(360deg); } }
@keyframes pulse-dot { 0%,100%{opacity:1;} 50%{opacity:.25;} }

/* ---- PAGE ---- */
.page-wrap { padding: 0 0 40px; }

/* ---- HERO ---- */
.hero-card {
    background: linear-gradient(135deg, var(--navy) 0%, #1a237e 60%, #283593 100%);
    padding: 20px 16px 28px; color: white; position: relative; overflow: hidden;
}
.hero-card::before { content:''; position:absolute; top:-40px; right:-40px; width:160px; height:160px; border-radius:50%; background:rgba(255,255,255,.05); }
.hero-card::after  { content:''; position:absolute; bottom:-30px; left:-20px; width:120px; height:120px; border-radius:50%; background:rgba(255,255,255,.04); }
.hero-sub   { font-size:11px; opacity:.7; position:relative; z-index:1; }
.hero-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:20px; font-weight:800; margin:2px 0 4px; position:relative; z-index:1; }
.hero-desc  { font-size:12px; opacity:.8; position:relative; z-index:1; }

/* ---- BODY ---- */
.page-body { padding:16px 12px; max-width:520px; margin:0 auto; display:flex; flex-direction:column; gap:12px; }

/* ---- JAM ---- */
.jam-row { display:grid; grid-template-columns:1fr 1fr; gap:10px; animation:slideUp .35s ease both; }
.jam-card { background:white; border:1.5px solid var(--gray-200); border-radius:var(--radius-md); padding:16px; box-shadow:var(--shadow-sm); text-align:center; }
.jam-label { font-size:10px; font-weight:700; color:var(--gray-500); text-transform:uppercase; letter-spacing:.5px; margin-bottom:8px; }
.jam-val { font-family:'Plus Jakarta Sans',sans-serif; font-size:28px; font-weight:800; color:var(--gray-400); font-variant-numeric:tabular-nums; }
.jam-val.filled { color:var(--navy); }

/* ---- STATUS ---- */
.status-card { background:white; border:1.5px solid var(--gray-200); border-radius:var(--radius-md); padding:14px; box-shadow:var(--shadow-sm); animation:slideUp .4s ease .04s both; }
.status-badge { display:inline-flex; align-items:center; gap:6px; padding:5px 12px; border-radius:99px; font-size:12px; font-weight:700; margin-bottom:8px; }
.sb-hadir { background:var(--green-light); color:var(--green); }
.sb-izin  { background:var(--amber-light); color:var(--amber); }
.sb-sakit { background:var(--red-light);   color:var(--red); }
.status-note { font-size:13px; color:var(--gray-700); line-height:1.5; }

/* ---- LOKASI ---- */
.lokasi-card { background:white; border:1.5px solid var(--gray-200); border-radius:var(--radius-md); padding:12px 14px; box-shadow:var(--shadow-sm); display:flex; align-items:center; gap:10px; font-size:13px; color:var(--gray-700); animation:slideUp .4s ease .07s both; }
.lokasi-card svg { width:18px; height:18px; color:var(--gray-400); flex-shrink:0; }

/* ---- CAMERA ---- */
.camera-card { background:white; border:1.5px solid var(--gray-200); border-radius:var(--radius-md); overflow:hidden; box-shadow:var(--shadow-sm); animation:slideUp .4s ease .10s both; }
.camera-topbar { display:flex; align-items:center; justify-content:space-between; padding:10px 14px; background:var(--gray-50); border-bottom:1px solid var(--gray-100); font-family:'Plus Jakarta Sans',sans-serif; font-size:12px; font-weight:700; color:var(--gray-800); }
.live-badge { display:flex; align-items:center; gap:5px; font-size:11px; font-weight:700; color:var(--red); }
.live-dot { width:7px; height:7px; border-radius:50%; background:var(--red); animation:pulse-dot 1.4s infinite; }
.camera-view { position:relative; aspect-ratio:4/3; background:#000; }
.camera-view video { width:100%; height:100%; object-fit:cover; display:block; }

/* ---- BUTTONS ---- */
.btn-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; animation:slideUp .4s ease .13s both; }
.btn-action { display:flex; align-items:center; justify-content:center; gap:8px; padding:14px 12px; border:none; border-radius:var(--radius-sm); font-family:'Plus Jakarta Sans',sans-serif; font-size:13px; font-weight:700; cursor:pointer; transition:opacity .15s,transform .15s; box-shadow:var(--shadow-sm); }
.btn-action svg { width:17px; height:17px; flex-shrink:0; }
.btn-action:active:not(:disabled) { transform:scale(.97); }
.btn-action:disabled { opacity:.42; cursor:not-allowed; }
.btn-action:not(:disabled):hover  { opacity:.88; }
.btn-masuk  { background:var(--blue);  color:white; }
.btn-pulang { background:var(--green); color:white; }
.btn-izin   { background:var(--amber); color:white; }
.btn-sakit  { background:var(--red);   color:white; }

/* ---- MODALS ---- */
.modal-overlay { position:fixed; inset:0; background:rgba(2,6,89,.52); backdrop-filter:blur(4px); display:none; align-items:center; justify-content:center; z-index:9999; padding:20px; }
.modal-overlay.show { display:flex; }
.modal-box { background:white; border-radius:var(--radius-lg); padding:28px 24px; max-width:400px; width:100%; box-shadow:var(--shadow-lg); text-align:center; transform:scale(.88); transition:transform .28s cubic-bezier(.34,1.56,.64,1); }
.modal-overlay.show .modal-box { transform:scale(1); }
.modal-box.form-box { text-align:left; }
.modal-emoji { font-size:44px; margin-bottom:10px; }
.modal-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:17px; font-weight:800; color:var(--gray-900); margin:0 0 6px; }
.modal-text  { font-size:13px; color:var(--gray-500); line-height:1.55; margin:0 0 20px; }
.detail-box { background:var(--gray-50); border:1.5px solid var(--gray-200); border-radius:var(--radius-sm); padding:12px; margin-bottom:18px; text-align:left; }
.detail-box p { font-size:12px; color:var(--gray-700); white-space:pre-line; margin:0; }
.spinner { width:42px; height:42px; border:4px solid #EEF2FF; border-top-color:var(--navy); border-radius:50%; animation:spin .75s linear infinite; margin:0 auto 14px; }
.form-field { margin-bottom:16px; }
.form-label { display:block; font-size:11px; font-weight:700; color:var(--gray-800); margin-bottom:6px; text-transform:uppercase; letter-spacing:.3px; }
.form-input { width:100%; padding:11px 13px; border:1.5px solid var(--gray-200); border-radius:var(--radius-sm); font-size:13px; font-family:'Nunito',sans-serif; color:var(--gray-900); resize:none; outline:none; background:var(--gray-50); transition:border-color .15s,box-shadow .15s; }
.form-input:focus { border-color:var(--navy); background:white; box-shadow:0 0 0 3px rgba(2,6,89,.08); }
.form-helper { display:flex; justify-content:space-between; margin-top:5px; font-size:11px; color:var(--gray-400); }
.form-actions { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
.btn-modal { display:inline-flex; align-items:center; justify-content:center; gap:6px; padding:11px 16px; border:none; border-radius:var(--radius-sm); font-family:'Plus Jakarta Sans',sans-serif; font-size:13px; font-weight:700; cursor:pointer; width:100%; transition:opacity .15s,transform .15s; }
.btn-modal:active { transform:scale(.97); }
.btn-modal:hover  { opacity:.9; }
.btn-modal-primary   { background:linear-gradient(135deg,var(--navy),#1a237e); color:white; box-shadow:0 3px 10px rgba(2,6,89,.25); }
.btn-modal-secondary { background:var(--gray-100); color:var(--gray-700); }
.hidden { display:none !important; }

@media (min-width:768px) {
    .hero-card { border-radius:var(--radius-lg); margin:24px 24px 0; padding:28px 40px; }
    .hero-card::before { width:260px; height:260px; top:-80px; right:-60px; }
    .hero-sub   { font-size:13px; }
    .hero-title { font-size:26px; }
    .hero-desc  { font-size:14px; }
    .page-body  { padding:24px; }
    .jam-val    { font-size:32px; }
    .btn-action { padding:16px 14px; font-size:14px; border-radius:var(--radius-md); }
}
</style>

{{-- LOADING MODAL --}}
<div id="loadingOverlay" class="modal-overlay">
    <div class="modal-box">
        <div class="spinner"></div>
        <div id="loadingIcon" class="modal-emoji">⏳</div>
        <h3 id="loadingTitle" class="modal-title">Memproses</h3>
        <p id="loadingMessage" class="modal-text">Mohon tunggu...</p>
    </div>
</div>

{{-- FORM MODAL --}}
<div id="modalKeterangan" class="modal-overlay">
    <div class="modal-box form-box">
        <div id="modalIcon" class="modal-emoji" style="text-align:center;">📝</div>
        <h3 id="modalTitle" class="modal-title" style="text-align:center;margin-bottom:16px;">Form Keterangan</h3>
        <form id="formKeterangan">
            <div class="form-field">
                <label class="form-label">Keterangan *</label>
                <textarea id="keterangan" rows="4" class="form-input" placeholder="Jelaskan alasan Anda (min. 10 karakter)" required></textarea>
                <div class="form-helper">
                    <span>Minimal 10 karakter</span>
                    <span id="charCount">0/500</span>
                </div>
            </div>
            <div class="form-actions">
                <button type="button" onclick="closeModalKeterangan()" class="btn-modal btn-modal-secondary">Batal</button>
                <button type="submit" class="btn-modal btn-modal-primary">Kirim</button>
            </div>
        </form>
    </div>
</div>

{{-- NOTIFIKASI MODAL --}}
<div id="modalNotif" class="modal-overlay">
    <div class="modal-box">
        <div id="notifIcon" class="modal-emoji">ℹ️</div>
        <h3 id="notifTitle" class="modal-title">Notifikasi</h3>
        <p id="notifMessage" class="modal-text"></p>
        <div id="notifDetail" class="detail-box hidden"><p></p></div>
        <button onclick="closeModalNotif()" class="btn-modal btn-modal-primary">Mengerti</button>
    </div>
</div>

<div class="page-wrap">

    <div class="hero-card">
        <div>
            <div class="hero-sub">Dashboard Guru</div>
            <div class="hero-title">🕘 Absensi Hari Ini</div>
            <div class="hero-desc">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</div>
        </div>
    </div>

    <div class="page-body">

        <div class="jam-row">
            <div class="jam-card">
                <div class="jam-label">Jam Masuk</div>
                <div id="jam-masuk" class="jam-val {{ $sudahMasuk ? 'filled' : '' }}">{{ $absensi->jam_masuk ?? '--:--' }}</div>
            </div>
            <div class="jam-card">
                <div class="jam-label">Jam Pulang</div>
                <div id="jam-pulang" class="jam-val {{ $sudahPulang ? 'filled' : '' }}">{{ $absensi->jam_pulang ?? '--:--' }}</div>
            </div>
        </div>

        @if($absensi && $absensi->status)
        <div class="status-card">
            <div class="status-badge sb-{{ $absensi->status }}">
                @if($absensi->status==='hadir') ✓ Hadir
                @elseif($absensi->status==='izin') 📄 Izin
                @elseif($absensi->status==='sakit') 🤒 Sakit
                @endif
            </div>
            @if($absensi->keterangan)
            <div class="status-note">{{ $absensi->keterangan }}</div>
            @endif
        </div>
        @endif

        @if($absensi && $absensi->lokasi)
        <div class="lokasi-card">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>{{ $absensi->lokasi }}</span>
        </div>
        @endif

        <div class="camera-card">
            <div class="camera-topbar">
                <span>📷 Kamera</span>
                <span class="live-badge"><span class="live-dot"></span> LIVE</span>
            </div>
            <div class="camera-view">
                <video id="video" autoplay playsinline></video>
                <canvas id="canvas" class="hidden"></canvas>
            </div>
        </div>

        <div class="btn-grid">
            <button id="btn-masuk"  {{ $sudahIzinAtauSakit||$sudahMasuk ? 'disabled' : '' }}              class="btn-action btn-masuk">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Absen Masuk
            </button>
            <button id="btn-pulang" {{ $sudahIzinAtauSakit||!$sudahMasuk||$sudahPulang ? 'disabled' : '' }} class="btn-action btn-pulang">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Absen Pulang
            </button>
            <button id="btn-izin"  {{ $status ? 'disabled' : '' }}                                          class="btn-action btn-izin">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Ajukan Izin
            </button>
            <button id="btn-sakit" {{ $status ? 'disabled' : '' }}                                          class="btn-action btn-sakit">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Lapor Sakit
            </button>
        </div>

    </div>
</div>

<script>
const ROUTE_KETERANGAN = "{{ route('guru.absen.keterangan') }}";
const ROUTE_MASUK      = "{{ route('guru.absen.masuk') }}";
const ROUTE_PULANG     = "{{ route('guru.absen.pulang') }}";
const CSRF_TOKEN       = "{{ csrf_token() }}";
</script>

<script>
const video  = document.getElementById('video');
const canvas = document.getElementById('canvas');
const ctx    = canvas.getContext('2d');
const allBtns = ['btn-masuk','btn-pulang','btn-izin','btn-sakit'].map(id => document.getElementById(id));

const loadingOverlay  = document.getElementById('loadingOverlay');
const loadingIcon     = document.getElementById('loadingIcon');
const loadingTitle    = document.getElementById('loadingTitle');
const loadingMessage  = document.getElementById('loadingMessage');
const modalKeterangan = document.getElementById('modalKeterangan');
const formKeterangan  = document.getElementById('formKeterangan');
const modalTitle      = document.getElementById('modalTitle');
const modalIcon       = document.getElementById('modalIcon');
const keteranganInput = document.getElementById('keterangan');
const charCount       = document.getElementById('charCount');
const modalNotif      = document.getElementById('modalNotif');
const notifIcon       = document.getElementById('notifIcon');
const notifTitle      = document.getElementById('notifTitle');
const notifMessage    = document.getElementById('notifMessage');
const notifDetail     = document.getElementById('notifDetail');

let currentType = '';

keteranganInput.addEventListener('input', function() { charCount.textContent = `${this.value.length}/500`; });

function showLoading(title='Memproses', msg='Mohon tunggu...', icon='⏳') {
    loadingIcon.textContent=icon; loadingTitle.textContent=title; loadingMessage.textContent=msg;
    loadingOverlay.classList.add('show');
}
function hideLoading() { loadingOverlay.classList.remove('show'); }

function showModalNotif(title, msg, icon='ℹ️', detail=null) {
    notifIcon.textContent=icon; notifTitle.textContent=title; notifMessage.textContent=msg;
    detail ? (notifDetail.querySelector('p').textContent=detail, notifDetail.classList.remove('hidden'))
           : notifDetail.classList.add('hidden');
    modalNotif.classList.add('show');
}
function closeModalNotif() { modalNotif.classList.remove('show'); }

function openModalKeterangan(type) {
    currentType=type;
    modalIcon.textContent  = type==='izin' ? '📄' : '🤒';
    modalTitle.textContent = type==='izin' ? 'Form Izin' : 'Form Sakit';
    keteranganInput.value=''; charCount.textContent='0/500';
    modalKeterangan.classList.add('show');
    setTimeout(()=>keteranganInput.focus(), 120);
}
function closeModalKeterangan() { modalKeterangan.classList.remove('show'); }

navigator.mediaDevices.getUserMedia({ video:{ facingMode:'user', width:{ideal:1280}, height:{ideal:720} } })
    .then(s => { video.srcObject=s; video.onloadedmetadata=()=>{ canvas.width=video.videoWidth; canvas.height=video.videoHeight; }; })
    .catch(e => showModalNotif('Error Kamera','Tidak dapat mengakses kamera: '+e.message,'📷'));

async function submitAbsen(url, type) {
    allBtns.forEach(b=>b&&(b.disabled=true));
    showLoading(`Memproses ${type==='masuk'?'Absen Masuk':'Absen Pulang'}`, 'Mengambil foto dan lokasi...', '📸');
    try {
        ctx.drawImage(video,0,0,canvas.width,canvas.height);
        const blob = await new Promise(r=>canvas.toBlob(r,'image/jpeg',.9));
        if(!blob) throw new Error('Gagal mengambil foto');
        loadingMessage.textContent='Mendapatkan lokasi Anda...';
        const coords = await new Promise((res,rej)=>{
            if(!navigator.geolocation) rej(new Error('Browser tidak mendukung geolocation'));
            navigator.geolocation.getCurrentPosition(p=>res(p.coords),()=>rej(new Error('Tidak dapat mendapatkan lokasi')),{timeout:10000,enableHighAccuracy:true});
        });
        loadingMessage.textContent='Mengirim data...';
        const fd=new FormData();
        fd.append('foto',blob,'selfie.jpg'); fd.append('latitude',coords.latitude); fd.append('longitude',coords.longitude); fd.append('_token',CSRF_TOKEN);
        const res=await fetch(url,{method:'POST',body:fd,headers:{'X-Requested-With':'XMLHttpRequest'}});
        const data=await res.json();
        hideLoading();
        if(res.ok&&data.success) {
            const det=[`Waktu: ${data.jam_masuk||data.jam_pulang}`,`Lokasi: ${data.lokasi}`,`Jarak: ${data.jarak}m dari sekolah`].join('\n');
            showModalNotif('Berhasil!',data.success,'✅',det);
            const el=document.getElementById(type==='masuk'?'jam-masuk':'jam-pulang');
            if(el){ el.textContent=type==='masuk'?data.jam_masuk:data.jam_pulang; el.classList.add('filled'); }
            setTimeout(()=>window.location.reload(),2200);
        } else showModalNotif('Gagal',data.error||'Terjadi kesalahan','❌');
    } catch(e) { hideLoading(); showModalNotif('Error',e.message,'⚠️'); }
    finally    { allBtns.forEach(b=>b&&(b.disabled=false)); }
}

async function submitKeterangan(type, ket) {
    showLoading('Mengirim','Menyimpan keterangan...','📝');
    try {
        const fd=new FormData();
        fd.append('status',type); fd.append('keterangan',ket); fd.append('_token',CSRF_TOKEN);
        const res=await fetch(ROUTE_KETERANGAN,{method:'POST',body:fd,headers:{'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}});
        const data=await res.json();
        hideLoading();
        if(res.ok&&data.success){ showModalNotif('Berhasil',data.success,'✅'); setTimeout(()=>window.location.reload(),1500); }
        else showModalNotif('Gagal',data.error||'Terjadi kesalahan','❌');
    } catch(e){ hideLoading(); showModalNotif('Error',e.message,'⚠️'); }
}

const btnM=document.getElementById('btn-masuk'),  btnP=document.getElementById('btn-pulang');
const btnI=document.getElementById('btn-izin'),   btnS=document.getElementById('btn-sakit');

btnM&&!btnM.disabled  &&btnM.addEventListener('click', ()=>submitAbsen(ROUTE_MASUK,'masuk'));
btnP&&!btnP.disabled  &&btnP.addEventListener('click', ()=>submitAbsen(ROUTE_PULANG,'pulang'));
btnI&&!btnI.disabled  &&btnI.addEventListener('click', ()=>openModalKeterangan('izin'));
btnS&&!btnS.disabled  &&btnS.addEventListener('click', ()=>openModalKeterangan('sakit'));

formKeterangan.addEventListener('submit',e=>{
    e.preventDefault();
    const ket=keteranganInput.value.trim();
    if(!currentType)    return showModalNotif('Error','Tipe tidak terdeteksi','⚠️');
    if(ket.length<10)   return showModalNotif('Error','Keterangan minimal 10 karakter','⚠️');
    if(ket.length>500)  return showModalNotif('Error','Keterangan maksimal 500 karakter','⚠️');
    closeModalKeterangan();
    submitKeterangan(currentType,ket);
});

document.addEventListener('keydown',e=>{ if(e.key==='Escape'){ closeModalKeterangan(); closeModalNotif(); } });
</script>

@endsection