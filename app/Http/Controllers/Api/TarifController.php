<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarif;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarif = Tarif::first();

        return response()->json([
            'success' => 'true',
            'data' => $tarif,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function upsert(Request $request)
    {
        $validated = $request->validate([
            'biaya_admin' => 'required|numeric|min:0',
            'biaya_rujukan_lab' => 'required|numeric|min:0',
        ]);

        // Ambil data pertama, atau buat baru jika tidak ada
        $tarif = Tarif::first();

        if ($tarif) {
            // Update
            $tarif->update($validated);
        } else {
            // Create
            $tarif = Tarif::create($validated);
        }

        return response()->json([
            'message' => 'Tarif berhasil disimpan.',
            'data' => $tarif
        ]);
    }
    public function destroy()
    {
        $tarif = Tarif::first(); // karena hanya ada 1 data

        if (!$tarif) {
            return response()->json([
                'message' => 'Data tarif tidak ditemukan.'
            ], 404);
        }

        $tarif->delete();

        return response()->json([
            'message' => 'Data tarif berhasil dihapus.'
        ]);
    }
}
