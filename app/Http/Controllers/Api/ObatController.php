<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:apoteker,dokterumum');
    }

    public function index()
    {
        $obat = Obat::all();
        return response()->json([
            'success' => true,
            'data' => $obat
        ]);
    }

    public function show($id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json([
                'success' => false,
                'message' => 'Obat tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $obat
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama_obat' => 'required|string|max:255',
                'bentuk' => 'required|string|max:255',
                'dosis' => 'required|string|max:255',
                'jumlah_stok' => 'required|numeric|min:0',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }

        $obat = Obat::create($data);

        return response()->json($obat, 201);
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $data = $request->validate([
            'nama_obat' => 'sometimes|required|string|max:255',
            'bentuk' => 'sometimes|required|string|max:255',
            'dosis' => 'sometimes|required|string|max:255',
            'jumlah_stok' => 'sometimes|required|numeric|min:0',
        ]);

        $obat->update($data);

        return response()->json($obat);
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return response()->json(['message' => 'Obat berhasil dihapus.']);
    }
}
