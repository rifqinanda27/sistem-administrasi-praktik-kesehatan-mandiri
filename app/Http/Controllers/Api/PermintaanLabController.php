<?php

namespace App\Http\Controllers\Api;


use App\Models\PermintaanLab;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PermintaanLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:laboran,resepsionis,dokterumum');
    }

    public function index()
    {
        $permintaan = PermintaanLab::all();
        return response()->json([
            'success' => true,
            'data' => $permintaan
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kunjungan' => 'required|exists:visits,id_kunjungan',
            'id_laboratorium' => 'required|exists:laboratorium,id_laboratorium',
            'diminta_oleh' => 'required|exists:users,id',
            'status_permintaan' => 'required|in:menunggu,dalam_proses,selesai',
            'tanggal_permintaan' => 'nullable|date',
        ]);

        $permintaan = PermintaanLab::create($data);

        return response()->json([
            'success' => true,
            'data' => $permintaan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $permintaan = PermintaanLab::findOrFail($id);

        $data = $request->validate([
            'status_permintaan' => 'required|in:menunggu,dalam_proses,selesai',
        ]);

        $permintaan->update($data);

        return response()->json([
            'success' => true,
            'data' => $permintaan,
        ]);
    }

    public function destroy($id)
    {
        $permintaan = PermintaanLab::findOrFail($id);
        $permintaan->delete();

        return response()->json(['message' => 'Permintaan lab dihapus.']);
    }

    public function cetak_permintaan()
    {
        return view('resepsionis.lab.cetak_rujukan_lab');
    }
}
