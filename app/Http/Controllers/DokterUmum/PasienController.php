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

    public function index(Request $request)
    {
        $token = session('api_token');

        // Ambil parameter dari request
        $page = $request->input('page', 1);
        $perPage = 10;
        $search = $request->input('search');

        // Ambil data user dari API
        $userResponse = Http::withToken($token)->get(config('services.api.base_url') . '/user');

        if (!$userResponse->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }

        $user = $userResponse->json();
        $idDokterLogin = $user['id'];

        // Ambil data pasien dengan parameter paginasi dan pencarian
        $response = Http::withToken($token)->get(config('services.api.base_url') . '/pasien', [
            'page' => $page,
            'per_page' => $perPage,
            'search' => $search, // Pastikan API mendukung pencarian
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data pasien']);
        }

        $json = $response->json();
        $semuaPasien = collect($json['data'] ?? []);

        // Filter pasien berdasarkan kunjungan yang sesuai dengan dokter login
        $filteredPasien = $semuaPasien->filter(function ($pasien) use ($idDokterLogin) {
            return collect($pasien['kunjungan'])->contains(fn($kunjungan) => $kunjungan['id_dokter'] == $idDokterLogin);
        });

        // Buat paginator agar bisa digunakan di Blade
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $filteredPasien->values(),
            $json['meta']['total'] ?? $filteredPasien->count(),
            $json['meta']['per_page'] ?? $perPage,
            $json['meta']['current_page'] ?? $page,
            ['path' => url()->current(), 'query' => $request->query()]
        );

        // Cek apakah request dari AJAX
        if ($request->ajax()) {
            return view('dokterumum.pasien.index', ['pasien' => $paginator, 'search' => $search])
                ->renderSections()['table'];
        }

        // Kirim ke view utama
        return view('dokterumum.pasien.index', ['pasien' => $paginator, 'search' => $search]);
    }

    // public function index()
    // {
    //     $token = session('api_token');

        
    //     // Ambil data user dari token
    //     $userResponse = Http::withToken($token)->get(config('services.api.base_url') . '/user');
    //     // dd($userResponse);

    //     if (!$userResponse->successful()) {
    //         return back()->withErrors(['message' => 'Gagal mengambil data user']);
    //     }

    //     $user = $userResponse->json();
    //     $idDokterLogin = $user['id'];

    //     // Ambil semua pasien
    //     $response = Http::withToken($token)->get(config('services.api.base_url') . '/pasien');

    //     if (!$response->successful()) {
    //         return back()->withErrors(['message' => 'Gagal mengambil data pasien']);
    //     }

    //     $semuaPasien = $response->json('data');

    //     // dd($semuaPasien);

    //     // Filter pasien yang memiliki kunjungan dengan id_dokter yang sesuai
    //     $filteredPasien = collect($semuaPasien)->filter(function ($pasien) use ($idDokterLogin) {
    //         // Cek apakah ada kunjungan dengan id_dokter sesuai
    //         $hasKunjunganDokterIni = collect($pasien['kunjungan'])->contains(function ($kunjungan) use ($idDokterLogin) {
    //             return $kunjungan['id_dokter'] == $idDokterLogin;
    //         });

    //         return $hasKunjunganDokterIni;
    //     });

    //     return view('dokterumum.pasien.index', ['pasien' => $filteredPasien->values()]);
    // }


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
