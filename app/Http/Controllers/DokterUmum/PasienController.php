<?php

namespace App\Http\Controllers\DokterUmum;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('services.api.base_url');
    }

    public function index()
    {
        $token = session('api_token');

        
        // Ambil data user dari token
        $userResponse = Http::withToken($token)->get(config('services.api.base_url') . '/user');
        // dd($userResponse);

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

        $semuaPasien = $response->json('data');

        // dd($semuaPasien);

        // Filter pasien yang memiliki kunjungan dengan id_dokter yang sesuai
        $filteredPasien = collect($semuaPasien)->filter(function ($pasien) use ($idDokterLogin) {
            // Cek apakah ada kunjungan dengan id_dokter sesuai
            $hasKunjunganDokterIni = collect($pasien['kunjungan'])->contains(function ($kunjungan) use ($idDokterLogin) {
                return $kunjungan['id_dokter'] == $idDokterLogin;
            });

            return $hasKunjunganDokterIni;
        });

        return view('dokterumum.pasien.index', ['pasien' => $filteredPasien->values()]);
    }


    public function rekam_medis($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/pasien/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $pasien = $response->json('data');

        return view('dokterumum.pasien.rekammedis', compact('pasien'));
    }
}
