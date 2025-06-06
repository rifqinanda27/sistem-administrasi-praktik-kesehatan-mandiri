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

    public function index(Request $request)
    {
        $token = session('api_token');

        // Ambil parameter dari request
        $page = $request->input('page', 1);
        $perPage = 10;
        $search = $request->input('search');

        // Kirim permintaan ke API eksternal
        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/pembayaran", [
            'page' => $page,
            'per_page' => $perPage,
            'search' => $search,
        ]);

        // Tangani error dari API
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data pembayaran']);
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
            return view('kasir.index', [
                'pembayaran' => $paginator,
                'search' => $search
            ])->renderSections()['table'];
        }

        // Kirim ke view utama
        return view('kasir.index', [
            'pembayaran' => $paginator,
            'search' => $search
        ]);
    }

    // public function index()
    // {
    //     $token = session('api_token');
    //     // dd($token);

    //     // Ambil data user login
    //     $pembayaran = Http::withToken($token)->get("$this->apiBaseUrl/pembayaran");
        
    //     if (!$pembayaran->successful()) {
    //         return back()->withErrors(['message' => 'Gagal mengambil data pembayaran']);
    //     }

    //     $pembayaran = $pembayaran->json('data');

    //     return view('kasir.index', compact('pembayaran'));
    // }

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

    public function tarif_index()
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/tarif");

        $tarif = $response->json('data');

        return view('kasir.tarif.index', compact('tarif'));
    }

    public function tarif_upsert(Request $request)
    {
        $token = session('api_token');

        $validated = $request->validate([
            'biaya_admin' => 'required',
            'biaya_rujukan_lab' => 'required',
        ]);
        
        $response = Http::withToken($token)->post("$this->apiBaseUrl/tarif", [
            'biaya_admin' => $request->biaya_admin,
            'biaya_rujukan_lab' => $request->biaya_rujukan_lab,
        ]);

        if ($response->failed()) {
            return back()->withErrors([
                'message' => $response->json('message') ?? 'Gagal memperbarui tarif.'
            ])->withInput();
        }

        return redirect()->route('tarif.index');
    }
}
