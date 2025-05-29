<?php

namespace App\Http\Controllers\Api;


use App\Models\PermintaanLab;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PermintaanLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:laboran');
    }

    public function index()
    {
        return response()->json(PermintaanLab::all());
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

        return response()->json($permintaan, 201);
    }

    public function update(Request $request, $id)
    {
        $permintaan = PermintaanLab::findOrFail($id);

        $data = $request->validate([
            'status_permintaan' => 'required|in:menunggu,dalam_proses,selesai',
        ]);

        $permintaan->update($data);

        return response()->json($permintaan);
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
