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

    public function index(Request $request)
    {
        $token = session('api_token');

        // Ambil parameter dari request
        $page = $request->input('page', 1);
        $perPage = 10;
        $search = $request->input('search');

        // Kirim permintaan ke API eksternal
        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/obat", [
            'page' => $page,
            'per_page' => $perPage,
            'search' => $search,
        ]);

        // Tangani error dari API
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data obat']);
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
            return view('apoteker.obat.index', [
                'obat' => $paginator,
                'search' => $search
            ])->renderSections()['table'];
        }

        // Kirim ke view utama
        return view('apoteker.obat.index', [
            'obat' => $paginator,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bentukOptions = [
            'tablet', 
            'kaplet', 
            'kapsul', 
            'sirup', 
            'suspensi', 
            'tetes', 
            'salep', 
            'krim', 
            'gel', 
            'inhaler', 
            'serbuk', 
            'botol'
        ];

        return view('apoteker.obat.create', compact('bentukOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token = session('api_token');

        $validated = $request->validate([
            'nama_obat' => 'required',
            'bentuk' => 'required',
            'dosis' => 'required',
            'jumlah_stok' => 'required|integer',
            'satuan' => 'required',
            'golongan' => 'required',
            'indikasi' => 'required',
            'tanggal_kadaluarsa' => 'required',
            'harga_satuan' => 'required',
        ]);

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

        $bentukOptions = [
            'tablet', 
            'kaplet', 
            'kapsul', 
            'sirup', 
            'suspensi', 
            'tetes', 
            'salep', 
            'krim', 
            'gel', 
            'inhaler', 
            'serbuk', 
            'botol'
        ];

        return view('apoteker.obat.edit', compact('obat', 'bentukOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $token = session('api_token');

        $validated = $request->validate([
            'nama_obat' => 'required',
            'bentuk' => 'required',
            'dosis' => 'required',
            'jumlah_stok' => 'required|integer',
            'satuan' => 'required',
            'golongan' => 'required',
            'indikasi' => 'required',
            'tanggal_kadaluarsa' => 'required',
            'harga_satuan' => 'required',
        ]);

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

    public function instruksi_index(Request $request)
    {
        $token = session('api_token');

        // Ambil parameter dari request
        $page = $request->input('page', 1);
        $perPage = 10;
        $search = $request->input('search');

        // Kirim permintaan ke API eksternal
        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/instruksi", [
            'page' => $page,
            'per_page' => $perPage,
            'search' => $search,
        ]);

        // Tangani error dari API
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data instruksi']);
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
            return view('apoteker.instruksi.index', [
                'instruksi' => $paginator,
                'search' => $search
            ])->renderSections()['table'];
        }

        // Kirim ke view utama
        return view('apoteker.instruksi.index', [
            'instruksi' => $paginator,
            'search' => $search
        ]);
    }

    public function instruksi_create()
    {
        return view('apoteker.instruksi.create');
    }

    public function instruksi_store(Request $request)
    {
        $token = session('api_token');

        $validated = $request->validate([
            'nama_instruksi' => 'required',
            'keterangan' => 'required',
            'arti_latin' => 'required',
        ]);

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

    public function instruksi_edit($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/instruksi/$id");

        if ($response->failed()) {
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal mengambil Instruksi']);
        }

        $instruksi = $response->json('data');

        return view('apoteker.instruksi.edit', compact('instruksi'));
    }

    public function instruksi_update(Request $request, $id)
    {
        $token = session('api_token');

        $validated = $request->validate([
            'nama_instruksi' => 'required',
            'keterangan' => 'required',
            'arti_latin' => 'required',
        ]);

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

    public function resep_index(Request $request)
    {
        $token = session('api_token');

        // Ambil parameter dari request
        $page = $request->input('page', 1);
        $perPage = 10;
        $search = $request->input('search');

        // Kirim permintaan ke API eksternal
        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/resep", [
            'page' => $page,
            'per_page' => $perPage,
            'search' => $search,
        ]);

        // Tangani error dari API
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data resep']);
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
            return view('apoteker.resep.index', [
                'resep' => $paginator,
                'search' => $search
            ])->renderSections()['table'];
        }

        // Kirim ke view utama
        return view('apoteker.resep.index', [
            'resep' => $paginator,
            'search' => $search
        ]);
    }

    // public function resep_index()
    // {
    //     $token = session('api_token');
    //     // dd($token);

    //     // Ambil data user login
    //     $resep = Http::withToken($token)->get("$this->apiBaseUrl/resep");
    //     // dd($resep);
    //     if (!$resep->successful()) {
    //         return back()->withErrors(['message' => 'Gagal mengambil data detail resep']);
    //     }

    //     $resep = $resep->json('data');
    //     // dd($resep);

    //     return view('apoteker.resep.index', compact('resep'));
    // }

    public function resep_create($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/resep/$id");

        if ($response->failed()) {
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal mengambil Detail Resep']);
        }

        $resep = $response->json('data');
        // dd($resep);

        return view('apoteker.resep.create', compact('resep'));
    }

    public function resep_store(Request $request, $id)
    {
        $token = session('api_token');

        foreach ($request->detail as $item) {
            $obatId = $item['obat_id'];
            $dosis = $item['dosis'];
            $frekuensi = $item['frekuensi'];

            $jumlahDikonsumsi = $dosis * $frekuensi;

            // Ambil data obat via API
            $response = Http::withToken($token)->get("$this->apiBaseUrl/obat/{$obatId}");
            $data = $response->json();
            $obat = $data['data'] ?? null;

            if (!$obat || !isset($obat['jumlah_stok'])) {
                throw new \Exception("Obat ID $obatId tidak ditemukan.");
            }

            if ($obat['jumlah_stok'] < $jumlahDikonsumsi) {
                return back()->withErrors([
                    'message' => "Stok obat {$obat['nama_obat']} tidak mencukupi.",
                ])->withInput();
            }

            $stokBaru = $obat['jumlah_stok'] - $jumlahDikonsumsi;

            // Update stok via API
            $updateResponse = Http::withToken($token)->put("$this->apiBaseUrl/obat/{$obatId}", [
                'jumlah_stok' => $stokBaru,
            ]);

            if (!$updateResponse->successful()) {
                throw new \Exception("Gagal mengupdate stok obat ID $obatId");
            }
        }
        
        // Resep Store
        $resep = Http::withToken($token)->put("$this->apiBaseUrl/resep/{$id}", [
            'status' => "diberikan",
        ]);

        // Tambahkan pengecekan statusnya
        if ($resep->failed()) {
            // toastr()->error('Gagal membuat user: ' . $resep->json('message'));
            return back()->withErrors(['message' => $resep->json('message') ?? 'Gagal membuat Obat']);
        }

        $response = Http::withToken($token)->get("$this->apiBaseUrl/resep/$id");

        if ($response->failed()) {
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal mengambil Detail Resep']);
        }

        
        $resep = $response->json('data');
        if($resep['kunjungan']['pembayaran'] != null)
        {
            $totals = $request->input('total', []); // total[] dalam bentuk array
            $grandTotal = array_sum($totals);
    
            $id_pembayaran = $resep['kunjungan']['pembayaran']['id_pembayaran'];
            $total_biaya = $resep['kunjungan']['pembayaran'];
    
            $pembayaran = Http::withToken($token)->put("$this->apiBaseUrl/pembayaran/$id_pembayaran", [
                'total_biaya' => $total_biaya['total_biaya'] + $grandTotal,
            ]);
    
            // dd($pembayaran);
            if ($pembayaran->failed()) {
                return back()->withErrors(['message' => $pembayaran->json('message') ?? 'Gagal update detail pembayaran']);
            }
    
            $detailPembayaran = Http::withToken($token)->post("$this->apiBaseUrl/detail-pembayaran", [
                'id_pembayaran' => $id_pembayaran,
                'jenis_biaya' => 'obat',
                'jumlah' => $grandTotal,
                'keterangan' => 'Biaya Obat',
            ]);
    
            // dd($detailPembayaran);
            if ($detailPembayaran->failed()) {
                return back()->withErrors(['message' => $pembayaran->json('message') ?? 'Gagal tambah detail pembayaran']);
            }
        }   

        return redirect()->route('resep.index');
    }
}
