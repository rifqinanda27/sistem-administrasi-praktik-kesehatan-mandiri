<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Tindakan;

class TindakanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:dokterumum');
    }

    public function index()
    {
        $tindakan = Tindakan::with('visit.pasien')->get(); // load relasi visit

        return response()->json([
            'success' => true,
            'data' => $tindakan
        ]);
    }

    public function show($id)
    {
        $tindakan = Tindakan::with('visit.pasien')->find($id);

        if (!$tindakan) {
            return response()->json([
                'success' => false,
                'message' => 'Tindakan tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tindakan
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kunjungan' => 'required|exists:visits,id_kunjungan',
            'tindakan_lanjut' => 'required|string',
            'status' => 'required|in:terjadwal,selesai',
        ]);

        $tindakan = Tindakan::create($data);

        return response()->json($tindakan, 201);
    }

    public function update(Request $request, $id)
    {
        $tindakan = Tindakan::findOrFail($id);

        $data = $request->validate([
            'id_kunjungan' => 'sometimes|exists:visits,id_kunjungan',
            'tindakan_lanjut' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:terjadwal,selesai',
        ]);

        $tindakan->update($data);

        return response()->json($tindakan);
    }

    public function destroy($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        $tindakan->delete();

        return response()->json(['message' => 'Tindakan berhasil dihapus.']);
    }
}
