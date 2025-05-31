<?php

namespace App\Http\Controllers\Api;

use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaboratoriumController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:laboran,dokterumum');
    }

    public function index()
    {
        $laboratorium = Laboratorium::all();
        return response()->json([
            'success' => true,
            'data' => $laboratorium,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_laboratorium' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status_aktif' => 'boolean',
            'kapasitas_max' => 'required|integer|min:1',
            'jam_operasional' => 'required|string|max:50',
        ]);

        $lab = Laboratorium::create($data);

        return response()->json([
            'success' => true,
            'data' => $lab,
        ]);
    }

    public function update(Request $request, $id)
    {
        $lab = Laboratorium::findOrFail($id);

        $data = $request->validate([
            'nama_laboratorium' => 'sometimes|required|string|max:255',
            'lokasi' => 'sometimes|required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status_aktif' => 'boolean',
            'kapasitas_max' => 'sometimes|required|integer|min:1',
            'jam_operasional' => 'sometimes|required|string|max:50',
        ]);

        $lab->update($data);

        return response()->json([
            'success' => true,
            'data' => $lab,
        ]);
    }

    public function destroy($id)
    {
        $lab = Laboratorium::findOrFail($id);
        $lab->delete();

        return response()->json(['message' => 'Laboratorium dihapus.']);
    }

}
