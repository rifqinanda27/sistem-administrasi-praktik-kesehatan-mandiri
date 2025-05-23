<?php

namespace App\Http\Controllers\DokterUmum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function tambah_catatan_medis(Request $request)
    {
        $validated = $request->validate([
            'id_kunjungan' => 'required|integer',
            'keluhan_utama' => 'required|string',
            'keluhan_tambahan' => 'nullable|string',
            'riwayat_penyakit_pribadi' => 'required|string',
            'riwayat_penyakit_keluarga' => 'required|string',
            'kebiasaan_pasien' => 'required|string',
            'berat_badan' => 'required|string',
            'frekuensi_nafas' => 'required|string',
            'tinggi_badan' => 'required|string',
            'suhu_tubuh' => 'required|string',
            'tekanan_darah' => 'required|string',
            'keadaan_umum' => 'required|string',
            'neurologi' => 'required|string',
            'diagnosa_sementara' => 'required|string',
            'diagnosa_tambahan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/catatan-medis", [
            'id_kunjungan' => $request->id_kunjungan,
            'keluhan_utama' => $request->keluhan_utama,
            'keluhan_tambahan' => $request->keluhan_tambahan,
            'riwayat_penyakit_pribadi' => $request->riwayat_penyakit_pribadi,
            'riwayat_penyakit_keluarga' => $request->riwayat_penyakit_keluarga,
            'kebiasaan_pasien' => $request->kebiasaan_pasien,
            'berat_badan' => $request->berat_badan,
            'frekuensi_nafas' => $request->frekuensi_nafas,
            'tinggi_badan' => $request->tinggi_badan,
            'suhu_tubuh' => $request->suhu_tubuh,
            'tekanan_darah' => $request->tekanan_darah,
            'keadaan_umum' => $request->keadaan_umum,
            'neurologi' => $request->neurologi,
            'diagnosa_sementara' => $request->diagnosa_sementara,
            'diagnosa_tambahan' => $request->diagnosa_tambahan,
            'tanggal' => $request->tanggal,
        ]);

        if ($request->input('buat_rujukan') === 'ya') {
            // Redirect ke halaman buat surat rujukan
            return redirect()->route('perlu-rujukan', ['id' => $request->id_kunjungan]);
        } else {
            // Redirect ke halaman tindakan biasa
            return redirect()->route('tidak-perlu-rujukan', ['id' => $request->id_kunjungan]);
        }

        // dd($response);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            toastr()->error('Gagal membuat tindakan: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat tindakan']);
        }
        // return redirect()->route('tindakan.index');
    }

    public function tidak_perlu_rujukan($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/kunjungan/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }
        
        $tindakan = $response->json('data');

        return view('dokterumum.tindakan.tidak-perlu-rujukan', compact('tindakan'));
    }

    public function perlu_rujukan($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/kunjungan/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $tindakan = $response->json('data');

        return view('dokterumum.tindakan.perlu-rujukan', compact('tindakan'));
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

        $tindakan = Http::withToken($token)->put("$this->apiBaseUrl/kunjungan/{$request->id_kunjungan}", [
            'status_kunjungan' => 'selesai',
        ]);

        if (!$tindakan->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui user']);
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
}
