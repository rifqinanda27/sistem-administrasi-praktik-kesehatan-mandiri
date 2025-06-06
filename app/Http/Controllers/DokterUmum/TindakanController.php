<?php

namespace App\Http\Controllers\DokterUmum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TindakanController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('services.api.base_url');
    }

    public function index(Request $request)
    {
        $token = session('api_token');
        $searchTerjadwal = $request->input('search_terjadwal');
        $searchSelesai = $request->input('search_selesai');
        $perPage = 10;

        // Ambil data user login
        $userResponse = Http::withToken($token)->get("$this->apiBaseUrl/user");
        if (!$userResponse->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }

        $user = $userResponse->json();
        $idDokterLogin = $user['id'];

        // Ambil semua data kunjungan
        $response = Http::withToken($token)->get("$this->apiBaseUrl/kunjungan");
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data kunjungan']);
        }

        $data = collect($response->json('data'))->filter(function ($item) use ($idDokterLogin) {
            return isset($item['dokter']['id']) && $item['dokter']['id'] == $idDokterLogin;
        });

        // Filter dan paginasi
        $terjadwalData = $data->filter(fn($d) => $d['status_kunjungan'] === 'terjadwal' &&
            (!$searchTerjadwal || str_contains(strtolower($d['pasien']['nama_lengkap'] ?? ''), strtolower($searchTerjadwal)))
        )->values();

        $selesaiData = $data->filter(fn($d) => $d['status_kunjungan'] === 'selesai' &&
            (!$searchSelesai || str_contains(strtolower($d['pasien']['nama_lengkap'] ?? ''), strtolower($searchSelesai)))
        )->values();

        // Buat paginator
        $terjadwalPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $terjadwalData->forPage($request->input('page_terjadwal', 1), $perPage),
            $terjadwalData->count(),
            $perPage,
            $request->input('page_terjadwal', 1),
            ['pageName' => 'page_terjadwal']
        );

        $selesaiPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $selesaiData->forPage($request->input('page_selesai', 1), $perPage),
            $selesaiData->count(),
            $perPage,
            $request->input('page_selesai', 1),
            ['pageName' => 'page_selesai']
        );

        return view('dokterumum.tindakan.index', [
            'terjadwal' => $terjadwalPaginator,
            'selesai' => $selesaiPaginator,
            'searchTerjadwal' => $searchTerjadwal,
            'searchSelesai' => $searchSelesai,
        ]);
    }

    // public function index()
    // {
    //     $token = session('api_token');

    //     // Ambil data user login
    //     $userResponse = Http::withToken($token)->get("$this->apiBaseUrl/user");
    //     if (!$userResponse->successful()) {
    //         return back()->withErrors(['message' => 'Gagal mengambil data user']);
    //     }

    //     $user = $userResponse->json();
    //     $idDokterLogin = $user['id'];

    //     // Ambil data tindakan
    //     $response = Http::withToken($token)->get("$this->apiBaseUrl/kunjungan");
    //     if (!$response->successful()) {
    //         return back()->withErrors(['message' => 'Gagal mengambil data tindakan']);
    //     }

    //     $allTindakan = $response->json('data');

    //     // Filter tindakan berdasarkan id_dokter yang sesuai
    //     $pasien = collect($allTindakan)->filter(function ($item) use ($idDokterLogin) {
    //         return isset($item['dokter']['id']) && $item['dokter']['id'] == $idDokterLogin;
    //     });

    //     return view('dokterumum.tindakan.index', compact('pasien'));
    // }


    public function perlu_tindakan($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/catatan-medis/{$id}");
        
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $tindakan = $response->json('data');

        return view('dokterumum.tindakan.perlu-tindakan', compact('tindakan'));
    }


    public function update_catatan_medis(Request $request, $id)
    {
        // Validasi request
        $validated = $request->validate([
            'diagnosa_sementara' => 'required|string',
            'diagnosa_tambahan' => 'required|string',
            'id_obat' => 'required|array',
            'id_instruksi' => 'required|array',
            'id_obat.*' => 'required|integer',
            'id_instruksi.*' => 'required|integer',
            'dosis' => 'required|array',
            'frekuensi' => 'required|array',
            'id_kunjungan' => 'required|integer',
            'id_dokter' => 'nullable|integer',
        ]);

        $token = session('api_token');

        // Update catatan medis
        $response = Http::withToken($token)->put("$this->apiBaseUrl/catatan-medis/{$id}", [
            'diagnosa_sementara' => $request->diagnosa_sementara,
            'diagnosa_tambahan' => $request->diagnosa_tambahan,
        ]);

        if ($response->failed()) {
            return back()->withErrors([
                'message' => $response->json('message') ?? 'Gagal memperbarui catatan medis.'
            ])->withInput();
        }

        // Buat resep
        $resep = Http::withToken($token)
            ->asForm()
            ->post("$this->apiBaseUrl/resep", [
                'id_kunjungan' => $request->id_kunjungan,
                'status' => 'aktif',
            ]);

        if ($resep->failed()) {
            return back()->withErrors([
                'message' => $resep->json('message') ?? 'Gagal membuat resep.'
            ])->withInput();
        }

        $data = $resep->json();
        $id_resep = $data['data']['id_resep'];

        // Simpan detail resep
        $detailResep = Http::withToken($token)
            ->asForm()
            ->post("$this->apiBaseUrl/detail-resep", [
                'id_instruksi' => $request->id_instruksi,
                'id_obat' => $request->id_obat,
                'dosis' => $request->dosis,
                'frekuensi' => $request->frekuensi,
                'id_resep' => $id_resep,
            ]);

        if ($detailResep->failed()) {
            return back()->withErrors([
                'message' => $detailResep->json('message') ?? 'Gagal menyimpan detail resep.'
            ])->withInput();
        }

        // Update status kunjungan
        $tindakan = Http::withToken($token)->put("$this->apiBaseUrl/kunjungan/{$request->id_kunjungan}", [
            'status_kunjungan' => 'selesai',
        ]);

        if ($tindakan->failed()) {
            return back()->withErrors(['message' => 'Gagal memperbarui status kunjungan'])->withInput();
        }

        // Ambil data penjamin
        $penjaminRes = Http::withToken($token)->get("$this->apiBaseUrl/catatan-medis/{$id}");
        $penjamin = $penjaminRes->json('data');

        // Cek jika penjamin = umum
        if (Str::lower($penjamin['kunjungan']['penjamin']['nama']) === 'umum') {
            $biaya_admin = Http::withToken($token)->get("$this->apiBaseUrl/tarif");

            $biaya_admin = $biaya_admin->json('data');

            $biayaAdmin  = $biaya_admin['biaya_admin'];
            $biayaDokter = $penjamin['kunjungan']['dokter']['dokter_detail']['tarif_konsultasi'] ?? 0;
            $totalBiaya  = $biayaAdmin + $biayaDokter;

            // Buat pembayaran
            $resPembayaran = Http::withToken($token)->post("$this->apiBaseUrl/pembayaran", [
                'id_kunjungan' => $penjamin['id_kunjungan'],
                'total_biaya' => $totalBiaya,
                'metode_pembayaran' => 'tunai',
                'status' => 'belum_dibayar',
            ]);

            if ($resPembayaran->failed()) {
                return back()->withErrors([
                    'message' => 'Gagal membuat pembayaran: ' . $resPembayaran->json('message') ?? '',
                ])->withInput();
            }

            $pembayaran = $resPembayaran->json('data');

            // Buat detail pembayaran
            $detailPayload = [
                [
                    'id_pembayaran' => $pembayaran['id_pembayaran'],
                    'jenis_biaya' => 'admin',
                    'jumlah' => $biayaAdmin,
                    'keterangan' => 'Biaya administrasi',
                ],
                [
                    'id_pembayaran' => $pembayaran['id_pembayaran'],
                    'jenis_biaya' => 'dokter',
                    'jumlah' => $biayaDokter,
                    'keterangan' => 'Biaya konsultasi dokter',
                ]
            ];

            foreach ($detailPayload as $detail) {
                $resDetail = Http::withToken($token)->post("$this->apiBaseUrl/detail-pembayaran", $detail);

                if ($resDetail->failed()) {
                    return back()->withErrors([
                        'message' => 'Gagal menambahkan detail pembayaran.'
                    ])->withInput();
                }
            }
        }

        return redirect()->route('tindakan-complete', ['id' => $id]);
    }


    public function tidak_perlu_rujukan($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/catatan-medis/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }
        
        $tindakan = $response->json('data');

        return view('dokterumum.tindakan.tidak-perlu-rujukan', compact('tindakan'));
    }

    public function perlu_rujukan($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/catatan-medis/{$id}");

        
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }
        
        $tindakan = $response->json('data');

        $jenis_laboratorium = Http::withToken($token)->get("$this->apiBaseUrl/jenis-pemeriksaan-lab")->json('data');

        $laboratorium = Http::withToken($token)->get("$this->apiBaseUrl/laboratorium")->json('data');
        // dd($tindakan);

        return view('dokterumum.tindakan.perlu-rujukan', compact('tindakan', 'jenis_laboratorium', 'laboratorium'));
    }

    public function perlu_rujukan_store(Request $request, $id)
    {
        $validated = $request->validate([
            'diagnosa_sementara' => 'required|string',
            'id_laboratorium' => 'required|integer',
            'id_jenis_pemeriksaan' => 'required|integer',
            'id_kunjungan' => 'required|integer',
            'diminta_oleh' => 'nullable|integer',
        ]);

        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/permintaan-lab", [
            'id_laboratorium' => $request->id_laboratorium,
            'id_jenis_pemeriksaan' => $request->id_jenis_pemeriksaan,
            'id_kunjungan' => $request->id_kunjungan,
            'diminta_oleh' => $request->diminta_oleh,
            'status_permintaan' => 'selesai',
        ]);

        // dd($response);

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui catatan medis']);
        }

        $diagnosa = Http::withToken($token)->put("$this->apiBaseUrl/catatan-medis/{$id}", [
            'diagnosa_sementara' => $request->diagnosa_sementara,
        ]);

        $tindakan = Http::withToken($token)->put("$this->apiBaseUrl/kunjungan/{$request->id_kunjungan}", [
            'status_kunjungan' => 'selesai',
        ]);

        if (!$tindakan->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui data kunjungan']);
        }

        $penjamin = Http::withToken($token)->get("$this->apiBaseUrl/catatan-medis/{$id}");
        // dd($pinjamin);
        $penjamin = $penjamin->json('data');

        if (Str::lower($penjamin['kunjungan']['penjamin']['nama']) === "umum")
        {
            $biaya_admin = Http::withToken($token)->get("$this->apiBaseUrl/tarif");

            $biaya_admin = $biaya_admin->json('data');

            $biayaAdmin  = $biaya_admin['biaya_admin'];
            $biayaLab = $biaya_admin['biaya_rujukan_lab'];
            $biayaDokter = $penjamin['kunjungan']['dokter']['dokter_detail']['tarif_konsultasi'] ?? 0;
            $totalBiaya  = $biayaAdmin + $biayaDokter;
            // dd($penjamin['id_kunjungan']);

            $resPembayaran = Http::withToken($token)->post("$this->apiBaseUrl/pembayaran", [
                'id_kunjungan' => $penjamin['id_kunjungan'],
                'total_biaya' => $totalBiaya,
                'metode_pembayaran' => 'tunai',
                'status' => 'belum_dibayar',
            ]);

            // dd($resPembayaran);

            if ($resPembayaran->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membuat pembayaran',
                    'status' => $resPembayaran->status(),
                    'error_body' => $resPembayaran->body(), // tampilkan isi respon
                ], 500);
            }


            $pembayaran = $resPembayaran->json('data');

            // 2. Kirim ke /detail-pembayaran (2x)
            $detailPayload = [
                [
                    'id_pembayaran' => $pembayaran['id_pembayaran'],
                    'jenis_biaya' => 'admin',
                    'jumlah' => $biayaAdmin,
                    'keterangan' => 'Biaya administrasi',
                ],
                [
                    'id_pembayaran' => $pembayaran['id_pembayaran'],
                    'jenis_biaya' => 'dokter',
                    'jumlah' => $biayaDokter,
                    'keterangan' => 'Biaya konsultasi dokter',
                ],
                [
                    'id_pembayaran' => $pembayaran['id_pembayaran'],
                    'jenis_biaya' => 'lab',
                    'jumlah' => $biayaLab,
                    'keterangan' => 'Biaya surat rujukan laboratorium',
                ]
            ];

            foreach ($detailPayload as $detail) {
                $resDetail = Http::withToken($token)->post("$this->apiBaseUrl/detail-pembayaran", $detail);

                if ($resDetail->failed()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal menambahkan detail pembayaran',
                    ], 500);
                }
            }
        }

        return redirect()->route('tindakan-complete', ['id' => $id]);
    }

    public function resep_obat_dokter(Request $request)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/resep", [
            'resep_obat' => $request->resep_obat,
            'id_kunjungan' => $request->id_kunjungan,
            'diresepkan_oleh' => $request->id_dokter,
        ]);
        // dd($response);
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            toastr()->error('Gagal membuat resep: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat resep']);
        }

        

        return redirect()->route('tindakan-complete', ['id' => $request->id_kunjungan]);
    }

    public function tindakan_complete($id)
    {
        return view('dokterumum.tindakan.complete');
    }

    public function cari_obat(Request $request)
    {
        $token = session('api_token');
        $search = strtolower($request->input('term'));

        $response = Http::withToken($token)->get(config('services.api.base_url') . '/obat-all');

        if (!$response->successful()) {
            return response()->json([]);
        }

        $allObat = $response->json('data');

        // Filter manual berdasarkan nama_lengkap
        $filtered = collect($allObat)->filter(function ($obat) use ($search) {
            return str_contains(strtolower($obat['nama_obat']), $search);
        });

        $result = $filtered->map(function ($obat) {
            return [
                'id' => $obat['id_obat'],
                'text' => $obat['nama_obat']
            ];
        })->values();

        return response()->json($result);
    }

    public function cari_instruksi(Request $request)
    {
        $token = session('api_token');
        $search = strtolower($request->input('term'));

        $response = Http::withToken($token)->get(config('services.api.base_url') . '/instruksi-all');

        if (!$response->successful()) {
            return response()->json([]);
        }

        $allInstruksi = $response->json('data');

        // Filter manual berdasarkan nama_lengkap
        $filtered = collect($allInstruksi)->filter(function ($instruksi) use ($search) {
            return str_contains(strtolower($instruksi['nama_instruksi']), $search);
        });

        $result = $filtered->map(function ($instruksi) {
            return [
                'id' => $instruksi['id_instruksi'],
                'text' => $instruksi['nama_instruksi']
            ];
        })->values();

        return response()->json($result);
    }
}
