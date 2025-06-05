<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KasirController extends Controller
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
        // dd($token);

        // Ambil data user login
        $pembayaran = Http::withToken($token)->get("$this->apiBaseUrl/pembayaran");
        
        if (!$pembayaran->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data pembayaran']);
        }

        $pembayaran = $pembayaran->json('data');

        return view('kasir.index', compact('pembayaran'));
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
        $token = session('api_token');

        // Ambil data user login
        $pembayaran = Http::withToken($token)->get("$this->apiBaseUrl/pembayaran/{$id}");
        
        if (!$pembayaran->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data pembayaran']);
        }

        $pembayaran = $pembayaran->json('data');

        return view('kasir.show', compact('pembayaran'));
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
}
