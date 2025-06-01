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

    public function index()
    {
        $token = session('api_token');

        // Ambil data user login
        $userResponse = Http::withToken($token)->get("$this->apiBaseUrl/user");
        if (!$userResponse->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }

        $user = $userResponse->json();
        $idDokterLogin = $user['id'];

        // Ambil data tindakan
        $response = Http::withToken($token)->get("$this->apiBaseUrl/kunjungan");
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data tindakan']);
        }

        $allTindakan = $response->json('data');

        // Filter tindakan berdasarkan id_dokter yang sesuai
        $pasien = collect($allTindakan)->filter(function ($item) use ($idDokterLogin) {
            return isset($item['dokter']['id']) && $item['dokter']['id'] == $idDokterLogin;
        });

        return view('dokterumum.tindakan.index', compact('pasien'));
    }


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
        $validated = $request->validate([
            'diagnosa_sementara' => 'required|string',
            'diagnosa_tambahan' => 'nullable|string',
            'id_obat' => 'required|array',
            'id_instruksi' => 'required|array',
            'id_obat.*' => 'required|integer',
            'id_instruksi.*' => 'required|integer',
            'id_kunjungan' => 'required|integer',
            'id_dokter' => 'nullable|integer',
        ]);

        $token = session('api_token');

        $response = Http::withToken($token)->put("$this->apiBaseUrl/catatan-medis/{$id}", [
            'diagnosa_sementara' => $request->diagnosa_sementara,
            'diagnosa_tambahan' => $request->diagnosa_tambahan,
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui catatan medis']);
        }

        $catatanMedisData = $response->json();

        $response = Http::withToken($token)
            ->asForm()
            ->post("$this->apiBaseUrl/detail-resep", [
                'id_dokter' => $request->id_dokter,
                'id_instruksi' => $request->id_instruksi,
                'id_obat' => $request->id_obat,
                'id_kunjungan' => $request->id_kunjungan,
            ]);
        
        $tindakan = Http::withToken($token)->put("$this->apiBaseUrl/kunjungan/{$request->id_kunjungan}", [
            'status_kunjungan' => 'selesai',
        ]);

        if (!$tindakan->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui data kunjungan']);
        }
        // dd($request->all());

        $penjamin = Http::withToken($token)->get("$this->apiBaseUrl/catatan-medis/{$id}");
        // dd($pinjamin);
        $penjamin = $penjamin->json('data');

        if (Str::lower($penjamin['kunjungan']['penjamin']['nama']) === "umum")
        {
            $biayaAdmin  = 25000;
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

        $response = Http::withToken($token)->get(config('services.api.base_url') . '/obat');

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

        $response = Http::withToken($token)->get(config('services.api.base_url') . '/instruksi');

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
