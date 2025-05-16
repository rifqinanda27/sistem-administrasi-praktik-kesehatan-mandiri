<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\CatatanMedis;
use Illuminate\Support\Str;

class CatatanMedisController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:dokterumum');
    }

    public function index()
    {
        $catatan = CatatanMedis::all();
        return response()->json($catatan);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kunjungan' => 'required|exists:visits,id_kunjungan',
            'keluhan_utama' => 'nullable|string',
            'keluhan_tambahan' => 'nullable|string',
            'riwayat_penyakit_pribadi' => 'nullable|string',
            'riwayat_penyakit_keluarga' => 'nullable|string',
            'kebiasaan_pasien' => 'nullable|string',
            'berat_badan' => 'nullable|numeric',
            'frekuensi_nafas' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'suhu_tubuh' => 'nullable|numeric',
            'tekanan_darah' => 'nullable|string',
            'keadaan_umum' => 'nullable|string',
            'neurologi' => 'nullable|string',
            'diagnosa_sementara' => 'nullable|string',
            'diagnosa_tambahan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        // Generate unique no_rekam_medis
        do {
            $noRekamMedis = 'RM-' . now()->format('Ymd') . '-' . Str::random(5);
        } while (CatatanMedis::where('no_rekam_medis', $noRekamMedis)->exists());

        // Tambahkan ke data
        $data['no_rekam_medis'] = $noRekamMedis;

        // Simpan
        $catatan = CatatanMedis::create($data);

        return response()->json($catatan, 201);
    }


    
    public function update(Request $request, $id)
    {
        $catatan = CatatanMedis::findOrFail($id);

        $data = $request->validate([
            'id_kunjungan' => 'sometimes|exists:visits,id_kunjungan',
            'keluhan_utama' => 'nullable|string',
            'keluhan_tambahan' => 'nullable|string',
            'riwayat_penyakit_pribadi' => 'nullable|string',
            'riwayat_penyakit_keluarga' => 'nullable|string',
            'kebiasaan_pasien' => 'nullable|string',
            'berat_badan' => 'nullable|numeric',
            'frekuensi_nafas' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'suhu_tubuh' => 'nullable|numeric',
            'tekanan_darah' => 'nullable|string',
            'keadaan_umum' => 'nullable|string',
            'neurologi' => 'nullable|string',
            'diagnosa_sementara' => 'nullable|string',
            'diagnosa_tambahan' => 'nullable|string',
            'tanggal' => 'nullable|date',
        ]);

        $catatan->update($data);

        return response()->json($catatan);
    }

    public function destroy($id)
    {
        $catatan = CatatanMedis::findOrFail($id);
        $catatan->delete();

        return response()->json(['message' => 'Catatan medis berhasil dihapus.']);
    }
}
