<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:apoteker');
    }

    public function detail_resep_index()
    {
        $detail_resep = detail_resep::all();

        return response()->json([
            'success' => true,
            'data' => $detail_resep,
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
