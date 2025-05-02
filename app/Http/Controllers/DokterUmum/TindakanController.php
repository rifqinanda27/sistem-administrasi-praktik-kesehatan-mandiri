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

        $response = Http::withToken($token)->get("$this->apiBaseUrl/tindakan");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $pasien = $response->json('data');

        return view('dokterumum.tindakan.index', compact('pasien'));
    }

    public function perlu_tindakan($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/tindakan/{$id}");

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

        // dd($response);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            toastr()->error('Gagal membuat tindakan: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat tindakan']);
        }
        return redirect()->route('tindakan.index');
    }

    public function tidak_perlu_rujukan($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/tindakan/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $tindakan = $response->json('data');

        return view('dokterumum.tindakan.tidak-perlu-rujukan', compact('tindakan'));
    }

    public function tindakan_complete($id)
    {
        return view('dokterumum.tindakan.complete');
    }
}
