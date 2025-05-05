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

    public function index()
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/dokter");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $dokter = $response->json('data');

        return view('admin.dokter.index', compact('dokter'));
    }

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

        $response = Http::withToken($token)->put("$this->apiBaseUrl/dokter/{$id}", [
            'nomor_sip' => $request->nomor_sip,
            'spesialisasi' => $request->spesialisasi,
            'pengalaman_tahun' => $request->pengalaman_tahun,
            'status_praktik' => $request->status_praktik,
        ]);

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
