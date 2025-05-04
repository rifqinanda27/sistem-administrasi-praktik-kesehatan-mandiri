<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:apoteker,dokterumum');
    }

    public function index()
    {
        $resep = Resep::with(['obat', 'kunjungan'])->get();
        return response()->json($resep);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kunjungan' => 'required|exists:visits,id_kunjungan',
            // 'id_obat' => 'required|exists:obat,id_obat',
            // 'dosis' => 'required|string',
            // 'frekuensi' => 'required|string',
            // 'petunjuk' => 'nullable|string',
            'diresepkan_oleh' => 'required|exists:users,id',
            // 'status' => 'required|in:aktif,diberikan',
            'resep_obat' => 'required',
        ]);

        $resep = Resep::create($data);

        return response()->json($resep, 201);
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

        $data = $request->validate([
            'id_kunjungan' => 'sometimes|required|exists:visits,id_kunjungan',
            // 'id_obat' => 'sometimes|required|exists:obat,id_obat',
            // 'dosis' => 'sometimes|required|string',
            // 'frekuensi' => 'sometimes|required|string',
            // 'petunjuk' => 'nullable|string',
            'diresepkan_oleh' => 'sometimes|required|exists:users,id',
            // 'status' => 'sometimes|required|in:aktif,diberikan',
            'resep_obat' => 'required',
        ]);

        $resep->update($data);

        return response()->json($resep);
    }

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();

        return response()->json(['message' => 'Resep berhasil dihapus.']);
    }
}
