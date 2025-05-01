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

        $response = Http::withToken($token)->get("$this->apiBaseUrl/pasien");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $pasien = $response->json('data');

        return view('dokterumum.pasien.index', compact('pasien'));
    }

    public function rekam_medis($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/pasien/{$id}");
        $kunjungan = Http::withToken($token)->get("$this->apiBaseUrl/kunjungan/{$id}");
        $obat = Http::withToken($token)->get("$this->apiBaseUrl/obat/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $pasien = $response->json('data');
        $kunjungan = $response->json('data');
        $obat = $response->json('data');

        return view('dokterumum.pasien.rekammedis', compact('pasien', 'kunjungan', 'obat'));
    }
}
