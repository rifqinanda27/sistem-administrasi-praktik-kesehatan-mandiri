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
        return view('apoteker.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/obat", [
            'nama_obat' => $request->nama_obat,
            'bentuk' => $request->bentuk,
            'dosis' => $request->dosis,
            'jumlah_stok' => $request->jumlah_stok,
            'satuan' => $request->satuan,
            'golongan' => $request->golongan,
            'indikasi' => $request->indikasi,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'harga_satuan' => $request->harga_satuan,
        ]);

        // dd($response);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            // toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat Obat']);
        }
        return redirect()->route('obat.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/obat/$id");

        // dd($response);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            // toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat Obat']);
        }

        $obat = $response->json('data');

        return view('apoteker.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->put("$this->apiBaseUrl/obat/$id", [
            'nama_obat' => $request->nama_obat,
            'bentuk' => $request->bentuk,
            'dosis' => $request->dosis,
            'jumlah_stok' => $request->jumlah_stok,
            'satuan' => $request->satuan,
            'golongan' => $request->golongan,
            'indikasi' => $request->indikasi,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'harga_satuan' => $request->harga_satuan,
        ]);

        // dd($response);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            // toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat Obat']);
        }
        return redirect()->route('obat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->delete("$this->apiBaseUrl/obat/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal menghapus obat']);
        }

        return redirect()->route('obat.index');
    }

    public function intruksi_index()
    {
        $token = session('api_token');

        // Ambil data user login
        $response = Http::withToken($token)->get("$this->apiBaseUrl/instruksi");
        
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data instruksi']);
        }

        $instruksi = $response->json('data');

        return view('apoteker.instruksi.index', compact('instruksi'));
    }

    public function intruksi_create()
    {
        return view('apoteker.instruksi.create');
    }

    public function intruksi_store(Request $request)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/instruksi", [
            'nama_instruksi' => $request->nama_instruksi,
            'keterangan' => $request->keterangan,
            'arti_latin' => $request->arti_latin,
        ]);

        // dd($response);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            // toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat Obat']);
        }
        return redirect()->route('instruksi.index');
    }

    public function intruksi_edit($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/instruksi/$id");

        if ($response->failed()) {
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal mengambil Instruksi']);
        }

        $instruksi = $response->json('data');

        return view('apoteker.instruksi.edit', compact('instruksi'));
    }

    public function intruksi_update(Request $request, $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->put("$this->apiBaseUrl/instruksi/$id", [
            'nama_instruksi' => $request->nama_instruksi,
            'keterangan' => $request->keterangan,
            'arti_latin' => $request->arti_latin,
        ]);

        // dd($response);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            // toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat Obat']);
        }
        return redirect()->route('instruksi.index');
    }

    public function instruksi_destroy($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->delete("$this->apiBaseUrl/instruksi/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal menghapus obat']);
        }

        return redirect()->route('instruksi.index');
    }

    public function resep_index()
    {
        $token = session('api_token');

        // Ambil data user login
        $detail_resep = Http::withToken($token)->get("$this->apiBaseUrl/detail-resep");
        
        if (!$detail_resep->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data detail resep']);
        }

        $detail_resep = $detail_resep->json('data');

        return view('apoteker.resep.index', compact('detail_resep'));
    }
}
