<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:resepsionis,dokterumum,apoteker,kasir');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = Pembayaran::with(['detailPembayaran', 'kunjungan', 'kunjungan.pasien'])
        ->orderBy('status', 'asc')
        ->orderBy('created_at', 'desc');

        // Optional: cari berdasarkan nama
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('total_biaya', 'like', "%{$search}%")
                ->orWhere('metode_pembayaran', 'like', "%{$search}%")
                ->orWhereHas('kunjungan', function ($q) use ($search) {
                    $q->whereHas('pasien', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'like', "%{$search}%");
                    });
                });
            });
        }


        $pembayaran = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $pembayaran->items(),
            'meta' => [
                'current_page' => $pembayaran->currentPage(),
                'last_page' => $pembayaran->lastPage(),
                'per_page' => $pembayaran->perPage(),
                'total' => $pembayaran->total(),
            ],
        ]);
    }

    // public function index()
    // {
    //     return response()->json([
    //         'success' => true,
    //         'data' => Pembayaran::with('detailPembayaran', 'kunjungan', 'kunjungan.pasien')->get(),
    //     ]);
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kunjungan' => 'required|exists:visits,id_kunjungan',
            // 'total_biaya' => 'required|numeric',
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
        $pembayaran = Pembayaran::with('detailPembayaran', 'kunjungan', 'kunjungan.pasien')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
        ]);
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            // 'total_biaya' => 'nullable|numeric',
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
