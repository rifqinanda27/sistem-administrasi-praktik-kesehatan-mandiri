<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\detail_resep;
use App\Models\Instruksi;

class ApotekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:apoteker,dokterumum');
    }

    public function detail_resep_index()
    {
        $detail_resep = detail_resep::all();

        return response()->json([
            'success' => true,
            'data' => $detail_resep,
        ]);
    }

    public function detail_resep_store(Request $request)
    {
        $validated = $request->validate([
            'id_dokter' => 'required|integer',
            'id_obat' => 'required|array',
            'id_obat.*' => 'required|integer',
            'id_instruksi' => 'required|array',
            'id_instruksi.*' => 'required|integer',
        ]);

        $results = [];

        foreach ($validated['id_obat'] as $index => $id_obat) {
            $id_instruksi = $validated['id_instruksi'][$index] ?? null;

            $detail_resep = detail_resep::create([
                'id_dokter' => $validated['id_dokter'],
                'id_obat' => $id_obat,
                'id_instruksi' => $id_instruksi,
            ]);

            $results[] = $detail_resep;
        }

        return response()->json([
        'success' => true,
        'data' => $results,
        ]);
    }


    public function instruksi_index()
    {
        $instruksi = Instruksi::all();
        return response()->json([
            'success' => true,
            'data' => $instruksi
        ]);
    }
}
