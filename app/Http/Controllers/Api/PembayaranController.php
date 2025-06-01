<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:laboran, resepsionis ,dokterumum');
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Pembayaran::with('detailPembayaran')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'total_biaya' => 'required|numeric',
            'metode_pembayaran' => 'required|in:tunai,kartu,transfer,bpjs',
            'status' => 'required|in:belum_dibayar,lunas,dibatalkan',
        ]);

        $pembayaran = Pembayaran::create($validated);

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
        ], 201);
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with('detailPembayaran')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
        ]);
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'total_biaya' => 'nullable|numeric',
            'metode_pembayaran' => 'nullable|in:tunai,kartu,transfer,bpjs',
            'status' => 'nullable|in:belum_dibayar,lunas,dibatalkan',
        ]);

        $pembayaran->update($validated);

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
        ]);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Pembayaran berhasil dihapus.',
        ]);
    }
}
