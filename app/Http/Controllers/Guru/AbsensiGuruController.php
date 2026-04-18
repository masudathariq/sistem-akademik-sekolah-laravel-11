<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuru;
use App\Models\PengaturanAbsensi;
use App\Models\JadwalGuru;
use App\Models\JadwalHarian;
use App\Models\JadwalHarianGuru;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AbsensiGuruController extends Controller
{
    // ==========================================
    // CONSTANTS
    // ==========================================
    
    private const HARI_MAPPING = [
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu'
    ];

    private const KOORDINAT_SEKOLAH = [
        'latitude' => -5.286945641596192,
        'longitude' => 105.23101107301207
    ];

    private const ZONA_JARAK_METER = 20;
    private const EARTH_RADIUS_METER = 6371000;

    private const ZONA_LOKASI_RADIUS = [
    ['max' => 25, 'nama' => 'Kantor'],
    ['max' => 50, 'nama' => 'Halaman Sekolah'],
    ['max' => 100, 'nama' => 'Gerbang Utama'],
    ['max' => 250, 'nama' => 'Area Sekitar'],
    ['max' => 500, 'nama' => 'Radius 500m'],
    ['max' => 1000, 'nama' => 'Radius 1km'],
    ['max' => PHP_INT_MAX, 'nama' => 'Di Luar Area']
];

    // ==========================================
    // VIEW METHODS
    // ==========================================

    /**
     * Halaman utama absensi
     */
    public function index()
    {
        $guru = $this->getAuthenticatedGuru();
        $tanggal = Carbon::today();
        
        $absensi = AbsensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', $tanggal)
            ->first();

        return view('guru.absensi.index', compact('absensi'));
    }

    /**
     * Rekap absensi bulanan
     */
    public function rekap(Request $request)
    {
        $guru = $this->getAuthenticatedGuru();
        
        [$bulan, $tahun] = $this->getValidatedMonthYear($request);

        $absensi = $this->getAbsensiByMonth($guru->id, $bulan, $tahun);
        $statistik = $this->getStatistikAbsensi($guru->id, $bulan, $tahun);

        return view('guru.absensi.rekap', array_merge(
            compact('absensi', 'bulan', 'tahun'),
            $statistik
        ));
    }

    /**
     * Halaman riwayat keterangan izin/sakit
     */
    public function riwayatKeterangan(Request $request)
    {
        $guru = $this->getAuthenticatedGuru();
        
        [$bulan, $tahun] = $this->getValidatedMonthYear($request);
        $status = $request->get('status', '');

        $keterangan = $this->getKeteranganByMonth($guru->id, $bulan, $tahun, $status);
        $statistik = $this->getStatistikKeterangan($guru->id, $bulan, $tahun);

        return view('guru.absensi.keterangan', array_merge(
            compact('keterangan', 'bulan', 'tahun'),
            $statistik
        ));
    }

    /**
     * Detail absensi per tanggal
     */
    public function detail($id)
    {
        $guru = $this->getAuthenticatedGuru();
        
        $absensi = AbsensiGuru::where('guru_id', $guru->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('guru.absensi.detail', compact('absensi'));
    }

    /**
 * Cek apakah status hari ini izin atau sakit
 */
private function isIzinAtauSakit($guruId, $tanggal)
{
    return AbsensiGuru::where('guru_id', $guruId)
        ->where('tanggal', $tanggal)
        ->whereIn('status', ['izin', 'sakit'])
        ->exists();
}

    // ==========================================
    // ABSENSI METHODS
    // ==========================================

    /**
     * Proses absen masuk
     */
    public function absenMasuk(Request $request)
    {
        Log::info('ABSEN MASUK', [
            'all' => $request->all(),
            'foto' => $request->hasFile('foto'),
        ]);

        try {
            $this->validateAbsensiRequest($request);

            $guru = $this->getAuthenticatedGuru();
            $now = Carbon::now();
            $tanggalIni = $now->toDateString();
            $hariIni = $this->getNamaHari($now);

            // ❌ Jika sudah izin atau sakit
            if ($this->isIzinAtauSakit($guru->id, $tanggalIni)) {
                return $this->errorResponse(
                    'Anda sudah izin atau sakit hari ini, tidak bisa absen masuk',
                    403
                );
            }

            // Validasi jadwal
            if (!$this->cekBolehAbsen($guru, $tanggalIni, $hariIni)) {
                return $this->errorResponse('Anda tidak memiliki jadwal hari ini', 403);
            }

            // Validasi waktu absen
            $setting = $this->getPengaturanAbsensi();
            if (!$this->isWaktuAbsenMasukValid($now, $tanggalIni, $setting)) {
                return $this->errorResponse('Absen masuk di luar jam yang ditentukan', 403);
            }

            // Ambil atau buat record absensi
            $absensi = $this->getOrCreateAbsensi($guru->id, $tanggalIni);

            // Validasi sudah absen
            if ($absensi->jam_masuk) {
                return $this->errorResponse('Anda sudah absen masuk', 403);
            }

            // Proses foto dan lokasi
            $fotoPath = $this->uploadFoto($request->file('foto'));
            $lokasiData = $this->processLokasiData($request->latitude, $request->longitude);

            // Update absensi
            $absensi->update([
                'jam_masuk' => $now->format('H:i:s'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'lokasi' => $lokasiData['nama'],
                'foto' => $fotoPath,
            ]);

            return response()->json([
                'success' => 'Absen masuk berhasil',
                'jam_masuk' => $absensi->jam_masuk,
                'lokasi' => $lokasiData['nama'],
                'jarak' => $lokasiData['jarak']
            ]);

        } catch (\Exception $e) {
            Log::error('Absen Masuk Error: ' . $e->getMessage());
            return $this->errorResponse('Terjadi kesalahan sistem', 500);
        }
    }

    /**
     * Proses absen pulang
     */
    public function absenPulang(Request $request)
    {
        try {
            $this->validateAbsensiRequest($request);

            $guru = $this->getAuthenticatedGuru();
            $now = Carbon::now();
            $tanggalIni = $now->toDateString();
            $hariIni = $this->getNamaHari($now);

                        // ❌ Jika sudah izin atau sakit
            if ($this->isIzinAtauSakit($guru->id, $tanggalIni)) {
                return $this->errorResponse(
                    'Anda sudah izin atau sakit hari ini, tidak bisa absen pulang',
                    403
                );
            }

            // Validasi jadwal
            if (!$this->cekBolehAbsen($guru, $tanggalIni, $hariIni)) {
                return $this->errorResponse('Anda tidak memiliki jadwal hari ini', 403);
            }

            // Validasi setting
            $setting = $this->getPengaturanAbsensi();

            // Ambil absensi
            $absensi = AbsensiGuru::where('guru_id', $guru->id)
                ->where('tanggal', $tanggalIni)
                ->first();

            // Validasi absen masuk
            if (!$absensi || !$absensi->jam_masuk) {
                return $this->errorResponse('Anda belum absen masuk', 403);
            }

            // Validasi sudah absen pulang
            if ($absensi->jam_pulang) {
                return $this->errorResponse('Anda sudah absen pulang', 403);
            }

            // Proses foto dan lokasi
            $fotoPath = $this->uploadFoto($request->file('foto'));
            $lokasiData = $this->processLokasiData($request->latitude, $request->longitude);

            // Update absensi
            $absensi->update([
                'jam_pulang' => $now->format('H:i:s'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'lokasi' => $lokasiData['nama'],
                'foto' => $fotoPath,
            ]);

            return response()->json([
                'success' => 'Absen pulang berhasil',
                'jam_pulang' => $absensi->jam_pulang,
                'lokasi' => $lokasiData['nama'],
                'jarak' => $lokasiData['jarak']
            ]);

        } catch (\Exception $e) {
            Log::error('Absen Pulang Error: ' . $e->getMessage());
            return $this->errorResponse('Terjadi kesalahan sistem', 500);
        }
    }

    /**
     * Submit izin atau sakit
     */
    public function submitKeterangan(Request $request)
    {
        try {
            $validated = $this->validateKeteranganRequest($request);
            
            $guru = $this->getAuthenticatedGuru();
            $tanggalIni = Carbon::now()->toDateString();

            // Cek apakah sudah ada absensi hari ini
            if ($this->hasAbsensiToday($guru->id, $tanggalIni)) {
                return $this->errorResponse('Anda sudah melakukan absensi hari ini', 403);
            }

            // Simpan absensi izin/sakit
            $absensi = AbsensiGuru::create([
                'guru_id' => $guru->id,
                'tanggal' => $tanggalIni,
                'status' => $validated['status'],
                'keterangan' => $validated['keterangan'],
            ]);

            Log::info('Submit ' . ucfirst($validated['status']), [
                'guru_id' => $guru->id,
                'tanggal' => $tanggalIni,
                'keterangan' => $validated['keterangan']
            ]);

            return response()->json([
                'success' => 'Pengajuan ' . $validated['status'] . ' berhasil dicatat',
                'status' => $absensi->status,
                'tanggal' => $tanggalIni
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validasi gagal',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error Submit Keterangan: ' . $e->getMessage());
            return $this->errorResponse('Terjadi kesalahan sistem: ' . $e->getMessage(), 500);
        }
    }

    // ==========================================
    // HELPER METHODS - VALIDATION
    // ==========================================

    /**
     * Validasi request absensi
     */
    private function validateAbsensiRequest(Request $request)
    {
        return $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);
    }

    /**
     * Validasi request keterangan
     */
    private function validateKeteranganRequest(Request $request)
    {
        return $request->validate([
            'status' => 'required|in:izin,sakit',
            'keterangan' => 'required|string|min:10|max:500',
        ], [
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status harus izin atau sakit',
            'keterangan.required' => 'Keterangan wajib diisi',
            'keterangan.min' => 'Keterangan minimal 10 karakter',
            'keterangan.max' => 'Keterangan maksimal 500 karakter',
        ]);
    }

    /**
     * Validasi bulan dan tahun
     */
    private function getValidatedMonthYear(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        if (!is_numeric($bulan) || $bulan < 1 || $bulan > 12) {
            $bulan = date('m');
        }

        if (!is_numeric($tahun) || $tahun < 2020 || $tahun > 2100) {
            $tahun = date('Y');
        }

        return [$bulan, $tahun];
    }

    // ==========================================
    // HELPER METHODS - AUTHORIZATION
    // ==========================================

    /**
     * Get authenticated guru atau abort
     */
    private function getAuthenticatedGuru()
    {
        $guru = Auth::user()->guru;
        
        if (!$guru) {
            abort(403, 'Akses ditolak. Anda tidak terdaftar sebagai guru.');
        }

        return $guru;
    }

    /**
     * Cek apakah guru boleh absen
     */
    private function cekBolehAbsen($guru, $tanggalIni, $hariIni)
    {
        // Cek jadwal harian (override)
        $jadwalHarian = JadwalHarian::where('tanggal', $tanggalIni)->first();

        if ($jadwalHarian) {
            if ($jadwalHarian->mode === 'SEMUA') {
                return true;
            }

            if ($jadwalHarian->mode === 'TERBATAS') {
                return JadwalHarianGuru::where('jadwal_harian_id', $jadwalHarian->id)
                    ->where('guru_id', $guru->id)
                    ->exists();
            }
        }

        // Fallback ke jadwal mingguan
        return JadwalGuru::where('guru_id', $guru->id)
            ->whereHas('hari', function ($q) use ($hariIni) {
                $q->where('nama_hari', $hariIni);
            })
            ->exists();
    }

    /**
     * Validasi waktu absen masuk
     */
    private function isWaktuAbsenMasukValid($now, $tanggalIni, $setting)
    {
        $jamMulai = $this->createCarbonFromTime($tanggalIni, $setting->jam_masuk_mulai);
        $jamSelesai = $this->createCarbonFromTime($tanggalIni, $setting->jam_masuk_selesai);

        return $now->gte($jamMulai) && $now->lte($jamSelesai);
    }

    // ==========================================
    // HELPER METHODS - DATA PROCESSING
    // ==========================================

    /**
     * Get pengaturan absensi atau error
     */
    private function getPengaturanAbsensi()
    {
        $setting = PengaturanAbsensi::first();
        
        if (!$setting) {
            throw new \Exception('Pengaturan absensi belum ada');
        }

        return $setting;
    }

    /**
     * Get atau create absensi hari ini
     */
    private function getOrCreateAbsensi($guruId, $tanggalIni)
    {
        $absensi = AbsensiGuru::where('guru_id', $guruId)
            ->where('tanggal', $tanggalIni)
            ->first();

        if (!$absensi) {
            $absensi = AbsensiGuru::create([
                'guru_id' => $guruId,
                'tanggal' => $tanggalIni,
                'status' => 'hadir',
            ]);
        }

        return $absensi;
    }

    /**
     * Cek apakah sudah ada absensi hari ini
     */
    private function hasAbsensiToday($guruId, $tanggalIni)
    {
        return AbsensiGuru::where('guru_id', $guruId)
            ->where('tanggal', $tanggalIni)
            ->exists();
    }

    /**
     * Get absensi by month
     */
    private function getAbsensiByMonth($guruId, $bulan, $tahun)
    {
        return AbsensiGuru::where('guru_id', $guruId)
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal', 'asc')
            ->get();
    }

    /**
     * Get keterangan by month
     */
    private function getKeteranganByMonth($guruId, $bulan, $tahun, $status = '')
    {
        $query = AbsensiGuru::where('guru_id', $guruId)
            ->whereIn('status', ['izin', 'sakit'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan);

        if ($status && in_array($status, ['izin', 'sakit'])) {
            $query->where('status', $status);
        }

        return $query->orderBy('tanggal', 'desc')->paginate(15);
    }

    /**
     * Get statistik absensi
     */
    private function getStatistikAbsensi($guruId, $bulan, $tahun)
    {
        $baseQuery = AbsensiGuru::where('guru_id', $guruId)
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan);

        return [
            'totalHadir' => (clone $baseQuery)->where('status', 'hadir')->count(),
            'totalIzin' => (clone $baseQuery)->where('status', 'izin')->count(),
            'totalSakit' => (clone $baseQuery)->where('status', 'sakit')->count(),
        ];
    }

    /**
     * Get statistik keterangan
     */
    private function getStatistikKeterangan($guruId, $bulan, $tahun)
    {
        $baseQuery = AbsensiGuru::where('guru_id', $guruId)
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan);

        return [
            'totalIzin' => (clone $baseQuery)->where('status', 'izin')->count(),
            'totalSakit' => (clone $baseQuery)->where('status', 'sakit')->count(),
        ];
    }

    // ==========================================
    // HELPER METHODS - FILE & LOCATION
    // ==========================================

    /**
     * Upload foto absensi
     */
    private function uploadFoto($foto)
    {
        return $foto->store('absensi/foto', 'public');
    }

private function processLokasiData($latitude, $longitude)
{
    $jarak = $this->hitungJarakMeter(
        self::KOORDINAT_SEKOLAH['latitude'],
        self::KOORDINAT_SEKOLAH['longitude'],
        $latitude,
        $longitude
    );

    $namaLokasi = $this->getNamaLokasi($jarak);

    return [
        'nama' => $namaLokasi,
        'jarak' => round($jarak, 2)
    ];
}

/**
 * Get nama lokasi berdasarkan jarak (Versi 1: Menggunakan array zona)
 */
private function getNamaLokasi($jarak)
{
    foreach (self::ZONA_LOKASI_RADIUS as $zona) {
        if ($jarak <= $zona['max']) {
            return $zona['nama'];
        }
    }
    
    return 'Lokasi Tidak Diketahui';
}
    /**
     * Hitung jarak dalam meter menggunakan Haversine formula
     */
    private function hitungJarakMeter($lat1, $lon1, $lat2, $lon2)
    {
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos($lat1) * cos($lat2) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return self::EARTH_RADIUS_METER * $c;
    }

    // ==========================================
    // HELPER METHODS - DATE & TIME
    // ==========================================

    /**
     * Get nama hari dalam bahasa Indonesia
     */
    private function getNamaHari($carbon)
    {
        return self::HARI_MAPPING[$carbon->format('l')];
    }

    /**
     * Create Carbon instance from time string
     */
    private function createCarbonFromTime($tanggal, $time)
    {
        $timeFormatted = strlen($time) == 5 ? $time . ':00' : $time;
        
        return Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $tanggal . ' ' . $timeFormatted
        );
    }

    // ==========================================
    // HELPER METHODS - RESPONSE
    // ==========================================

    /**
     * Return error response JSON
     */
    private function errorResponse($message, $statusCode = 400)
    {
        return response()->json(['error' => $message], $statusCode);
    }
}

