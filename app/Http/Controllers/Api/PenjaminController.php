<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Penjamin;
use Illuminate\Http\Request;

class PenjaminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:resepsionis,dokterumum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjamin = Penjamin::all();

        return response()->json([
            'success' => true,
            'data' => $penjamin,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|unique:penjamin,nama',
            'tipe' => 'required|in:gratis,bayar_sebagian,bayar_penuh',
            'catatan' => 'nullable|string',
        ]);

        $penjamin = Penjamin::create($validated);

        return response()->json([
            'success' => true,
            'data' => $penjamin,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penjamin = Penjamin::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $penjamin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penjamin = Penjamin::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|unique:penjamin,nama,' . $id . ',id_penjamin',
            'tipe' => 'required|in:gratis,bayar_sebagian,bayar_penuh',
            'catatan' => 'nullable|string',
        ]);

        $penjamin->update($validated);

        return response()->json([
            'success' => true,
            'data' => $penjamin,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjamin = Penjamin::findOrFail($id);
        $penjamin->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Data penjamin berhasil dihapus.',
        ]);
    }
}
