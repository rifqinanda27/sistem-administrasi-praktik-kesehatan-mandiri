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
        $data = $request->validate([
            'id_dokter' => 'required',
            'id_obat' => 'required',
            'id_instruksi' => 'required',
        ]);

        $detail_resep = detail_resep::create($data);

        return response()->json([
           'success'  => true,
           'data' => $detail_resep
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
