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

        $response = Http::withToken($token)->post("$this->apiBaseUrl/pasien", [
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'telepon' => $request->telepon,
        ]);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            // toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat pasien']);
        }
        return redirect()->route('pasien-resepsionis.index');
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

        return view('resepsionis.kunjungan.create', compact('tipe_kunjungan', 'status_kunjungan'));
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

        $response = Http::withToken($token)->post("$this->apiBaseUrl/kunjungan", [
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'tipe_kunjungan' => $request->tipe_kunjungan,
            'status_kunjungan' => $request->status_kunjungan,
            'catatan' => $request->catatan,
        ]);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            // toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat pasien']);
        }
        return redirect()->route('kunjungan.index');
    }
}
