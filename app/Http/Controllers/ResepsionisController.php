<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ResepsionisController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('services.api.base_url');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = session('api_token');

        // Ambil data user dari token
        $userResponse = Http::withToken($token)->get(config('services.api.base_url') . '/user');

        if (!$userResponse->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }

        $user = $userResponse->json();
        $idDokterLogin = $user['id'];

        // Ambil semua pasien
        $response = Http::withToken($token)->get(config('services.api.base_url') . '/pasien');

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data pasien']);
        }

        $pasien = $response->json('data');

        return view('resepsionis.pasien.index', compact('pasien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resepsionis.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token = session('api_token');

        // ✅ Validasi input sebelum kirim ke API
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:laki-laki,perempuan',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
            'no_ktp'         => 'required|string|max:20',
            'telepon'        => 'required|string|max:20',
        ]);

        // 🔐 Kirim data ke API
        $response = Http::withToken($token)->post("$this->apiBaseUrl/pasien", [
            'nama_lengkap'   => $request->nama_lengkap,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'no_ktp'         => $request->no_ktp,
            'telepon'        => $request->telepon,
        ]);

        // ❌ Jika gagal, tampilkan error dari API
        if ($response->failed()) {
            $errorMessage = $response->json('message') ?? 'Gagal membuat pasien. Silakan coba lagi.';
            return back()->withErrors(['message' => $errorMessage])->withInput();
        }

        // ✅ Jika sukses, redirect ke halaman index
        return redirect()->route('pasien-resepsionis.index')->with('success', 'Pasien berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function kunjungan_index()
    {
        $token = session('api_token');

        // Ambil semua pasien
        $response = Http::withToken($token)->get(config('services.api.base_url') . '/kunjungan');

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data pasien']);
        }

        $kunjungan = $response->json('data');

        return view('resepsionis.kunjungan.index', compact('kunjungan'));
    }

    public function kunjungan_create()
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get(config('services.api.base_url') . '/tipe-kunjungan');

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil opsi status']);
        }

        $tipe_kunjungan = $response->json('data');

        $response = Http::withToken($token)->get(config('services.api.base_url') . '/status-kunjungan');

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil opsi status']);
        }

        $status_kunjungan = $response->json('data');

        
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/penjamin");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data penjamin']);
        }

        $penjamin = $response->json('data');

        return view('resepsionis.kunjungan.create', compact('tipe_kunjungan', 'status_kunjungan', 'penjamin'));
    }    

    public function cari_pasien(Request $request)
    {
        $token = session('api_token');
        $search = strtolower($request->input('term'));

        $response = Http::withToken($token)->get(config('services.api.base_url') . '/pasien');

        if (!$response->successful()) {
            return response()->json([]);
        }

        $allPasien = $response->json('data');

        // Filter manual berdasarkan nama_lengkap
        $filtered = collect($allPasien)->filter(function ($pasien) use ($search) {
            return str_contains(strtolower($pasien['nama_lengkap']), $search);
        });

        $result = $filtered->map(function ($pasien) {
            return [
                'id' => $pasien['id_pasien'],
                'text' => $pasien['nama_lengkap']
            ];
        })->values();

        return response()->json($result);
    }

    public function cari_dokter(Request $request)
    {
        $token = session('api_token');
        $search = strtolower($request->input('term'));

        $response = Http::withToken($token)->get(config('services.api.base_url') . '/cari-dokter');

        if (!$response->successful()) {
            return response()->json([]);
        }

        $allDokter = $response->json('data');

        // Filter manual berdasarkan nama_lengkap
        $filtered = collect($allDokter)->filter(function ($dokter) use ($search) {
            return str_contains(strtolower($dokter['user']['name']), $search);
        });

        $result = $filtered->map(function ($dokter) {
            return [
                'id' => $dokter['user']['id'],
                'text' => $dokter['user']['name']
            ];
        })->values();

        return response()->json($result);
    }

    public function kunjungan_store(Request $request)
    {
        $token = session('api_token');

        // ✅ Validasi input dulu
        $request->validate([
            'id_pasien'         => 'required|integer',
            'id_dokter'         => 'required|integer',
            'id_penjamin'       => 'required|integer',
            'tanggal_kunjungan' => 'required|date',
            'tipe_kunjungan'    => 'required|string',
            'status_kunjungan'  => 'required|string',
        ]);

        // 🔐 Kirim data ke API
        $response = Http::withToken($token)->post("$this->apiBaseUrl/kunjungan", [
            'id_pasien'         => $request->id_pasien,
            'id_dokter'         => $request->id_dokter,
            'id_penjamin'       => $request->id_penjamin,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'tipe_kunjungan'    => $request->tipe_kunjungan,
            'status_kunjungan'  => $request->status_kunjungan,
        ]);

        // ❌ Cek kalau API gagal merespons
        if ($response->failed()) {
            $message = $response->json('message') ?? 'Gagal membuat kunjungan.';
            return back()->withErrors(['message' => $message])->withInput();
        }

        // ✅ Ambil ID kunjungan dari response yang benar
        $id_kunjungan = $response->json('id_kunjungan');

        if (!$id_kunjungan) {
            return back()->withErrors(['message' => 'ID kunjungan tidak ditemukan dalam response API.'])->withInput();
        }

        // ✅ Redirect ke form anamnesa dengan ID kunjungan
        return redirect()->route('anamnesa', ['id_kunjungan' => $id_kunjungan]);
    }


    public function anamnesa_create($id_kunjungan)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/kunjungan/{$id_kunjungan}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }
        
        $tindakan = $response->json('data');

        return view('resepsionis.kunjungan.anamnesa', compact('tindakan'));
    }

    public function anamnesa_store(Request $request)
    {
        $validated = $request->validate([
            'id_kunjungan' => 'required|integer',
            'keluhan_utama' => 'required|string',
            'keluhan_tambahan' => 'nullable|string',
            'riwayat_penyakit_pribadi' => 'required|string',
            'riwayat_penyakit_keluarga' => 'required|string',
            'kebiasaan_pasien' => 'required|string',
            'berat_badan' => 'required|string',
            'frekuensi_nafas' => 'required|string',
            'tinggi_badan' => 'required|string',
            'suhu_tubuh' => 'required|string',
            'tekanan_darah' => 'required|string',
            'keadaan_umum' => 'required|string',
            'neurologi' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/catatan-medis", [
            'id_kunjungan' => $request->id_kunjungan,
            'keluhan_utama' => $request->keluhan_utama,
            'keluhan_tambahan' => $request->keluhan_tambahan,
            'riwayat_penyakit_pribadi' => $request->riwayat_penyakit_pribadi,
            'riwayat_penyakit_keluarga' => $request->riwayat_penyakit_keluarga,
            'kebiasaan_pasien' => $request->kebiasaan_pasien,
            'berat_badan' => $request->berat_badan,
            'frekuensi_nafas' => $request->frekuensi_nafas,
            'tinggi_badan' => $request->tinggi_badan,
            'suhu_tubuh' => $request->suhu_tubuh,
            'tekanan_darah' => $request->tekanan_darah,
            'keadaan_umum' => $request->keadaan_umum,
            'neurologi' => $request->neurologi,
            'tanggal' => $request->tanggal,
        ]);
        
        // dd($response);

        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat tindakan']);
        }


        return redirect()->route('kunjungan.index');
    }

    public function lab_resepsionis()
    {
        $token = session('api_token');

        // Ambil data user dari token
        $permintaan_lab = Http::withToken($token)->get(config('services.api.base_url') . '/permintaan-lab');

        if (!$permintaan_lab->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }

        $permintaan_lab = $permintaan_lab->json('data');

        return view('resepsionis.lab.daftar_lab_pasien', compact('permintaan_lab'));
    }

    public function getPermintaanLab($id)
    {
        $token = session('api_token');

        // Ambil data PDF dari API
        $response = Http::withToken($token)->get(config('services.api.base_url') . '/cetak-permintaan/' . $id);

        if ($response->successful()) {
            return response($response->body(), 200)
                ->header('Content-Type', 'application/pdf');
        }

        return response()->json(['error' => 'Gagal mengambil data'], 500);
    }
}
