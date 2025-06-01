<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApotekerController extends Controller
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

        // Ambil data user login
        $obat = Http::withToken($token)->get("$this->apiBaseUrl/obat");
        
        if (!$obat->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data obat']);
        }

        $obat = $obat->json('data');

        return view('apoteker.obat.index', compact('obat'));
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

    public function intruksi_apoteker()
    {
        $token = session('api_token');

        // Ambil data user login
        $response = Http::withToken($token)->get("$this->apiBaseUrl/instruksi");
        
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data instruksi']);
        }

        $instruksi = $response->json('data');

        return view('apoteker.instruksi.intruksi_resep', compact('instruksi'));
    }
}
