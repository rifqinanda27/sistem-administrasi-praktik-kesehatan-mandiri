<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DokterController extends Controller
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

        // Kirim permintaan ke API eksternal
        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/dokter", [
            'page' => $page,
            'per_page' => $perPage,
            'search' => $search,
        ]);

        // Tangani error dari API
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data dokter']);
        }

        // Ambil dan siapkan data JSON dari API
        $json = $response->json();
        $data = $json['data'] ?? [];
        $meta = $json['meta'] ?? [];

        // Buat paginator agar bisa digunakan di Blade
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data,
            $meta['total'] ?? count($data),
            $meta['per_page'] ?? $perPage,
            $meta['current_page'] ?? $page,
            ['path' => url()->current(), 'query' => $request->query()]
        );

        // Cek apakah request dari AJAX
        if ($request->ajax()) {
            // Kirim hanya bagian tabel jika AJAX (optional, kalau pakai AJAX)
            return view('admin.dokter.index', [
                'dokter' => $paginator,
                'search' => $search
            ])->renderSections()['table'];
        }

        // Kirim ke view utama
        return view('admin.dokter.index', [
            'dokter' => $paginator,
            'search' => $search
        ]);
    }

    // public function index()
    // {
    //     $token = session('api_token');

    //     $response = Http::withToken($token)->get("$this->apiBaseUrl/dokter");

    //     if (!$response->successful()) {
    //         return back()->withErrors(['message' => 'Gagal mengambil data users']);
    //     }

    //     $dokter = $response->json('data');

    //     return view('admin.dokter.index', compact('dokter'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $token = session('api_token');
        
        $response = Http::withToken($token)->get("$this->apiBaseUrl/dokter/{$id}");
        
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }
        
        // dd($response);
        $dokter_edit = $response->json('data');

        return view('admin.dokter.edit', compact('dokter_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $token = session('api_token');

        $request->validate([
            'nomor_sip' => 'required',
            'pengalaman_tahun' => 'required|integer',
            'tarif_konsultasi' => 'required|integer',
            'dokter_nip' => 'required',
        ]);

        $response = Http::withToken($token)->put("$this->apiBaseUrl/dokter/{$id}", [
            'nomor_sip' => $request->nomor_sip,
            'spesialisasi' => $request->spesialisasi,
            'pengalaman_tahun' => $request->pengalaman_tahun,
            'status_praktik' => $request->status_praktik,
            'tarif_konsultasi' => $request->tarif_konsultasi,
            'dokter_nip' => $request->dokter_nip,
        ]);

        // dd($response);

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui user']);
        }

        // toastr()->success('User berhasil diperbarui');
        return redirect()->route('dokter.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
