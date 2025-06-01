<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\DetailPembayaran;
use Illuminate\Http\Request;

class DetailPembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:resepsionis,dokterumum,apoteker,kasir');
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => DetailPembayaran::with('pembayaran')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pembayaran' => 'required|exists:pembayaran,id_pembayaran',
            'jenis_biaya' => 'required|in:admin,dokter,obat,lab,lainnya',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required|numeric',
        ]);

        $detail = DetailPembayaran::create($validated);

        return response()->json([
            'success' => true,
            'data' => $detail,
        ], 201);
    }

    public function show($id)
    {
        $detail = DetailPembayaran::with('pembayaran')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $detail,
        ]);
    }

    public function update(Request $request, $id)
    {
        $detail = DetailPembayaran::findOrFail($id);

        $validated = $request->validate([
            'jenis_biaya' => 'nullable|in:admin,dokter,obat,lab,lainnya',
            'keterangan' => 'nullable|string',
            'jumlah' => 'nullable|numeric',
        ]);

        $detail->update($validated);

        return response()->json([
            'success' => true,
            'data' => $detail,
        ]);
    }

    public function destroy($id)
    {
        $detail = DetailPembayaran::findOrFail($id);
        $detail->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Detail pembayaran berhasil dihapus.',
        ]);
    }
}
