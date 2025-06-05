<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:apoteker,dokterumum');
    }

    // public function index()
    // {
    //     $resep = Resep::with(['obat', 'kunjungan', 'kunjungan.dokter', 'kunjungan.pasien'])->get();
    //     return response()->json([
    //         'success' => true,
    //         'data' => $resep
    //     ]);
    // }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = Resep::with(['obat', 'kunjungan', 'kunjungan.dokter', 'kunjungan.pasien']);

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->whereHas('kunjungan', function ($q) use ($search) {
                    $q->whereHas('pasien', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'like', "%{$search}%");
                    });
                })
                ->orWhereHas('kunjungan', function ($q) use ($search) {
                    $q->whereHas('dokter', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
                });
            });
        }

        $resep = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $resep->items(),
            'meta' => [
                'current_page' => $resep->currentPage(),
                'last_page' => $resep->lastPage(),
                'per_page' => $resep->perPage(),
                'total' => $resep->total(),
            ],
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kunjungan' => 'required|exists:visits,id_kunjungan',
            // 'id_detail_resep' => 'required',
            // 'dosis' => 'required|string',
            // 'frekuensi' => 'required|string',
            // 'petunjuk' => 'nullable|string',
            // 'diresepkan_oleh' => 'required',
            'status' => 'required|in:aktif,diberikan',
        ]);

        $resep = Resep::create($data);

        return response()->json([
            'success' => true,
            'data' => $resep
        ]);
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

        $data = $request->validate([
            // 'id_kunjungan' => 'sometimes|required|exists:visits,id_kunjungan',
            // 'id_obat' => 'sometimes|required|exists:obat,id_obat',
            // 'dosis' => 'sometimes|required|string',
            // 'frekuensi' => 'sometimes|required|string',
            // // 'petunjuk' => 'nullable|string',
            // 'diresepkan_oleh' => 'sometimes|required|exists:users,id',
            'status' => 'sometimes|required|in:aktif,diberikan',
        ]);

        $resep->update($data);

        return response()->json([
            'success' => true,
            'data' => $resep
        ]);
    }

    public function show($id)
    {
        $resep = Resep::with(['obat', 'kunjungan', 'kunjungan.dokter', 'kunjungan.pasien', 'detail_resep', 'detail_resep.obat', 'detail_resep.instruksi', 'kunjungan.pembayaran'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $resep
        ]);
    }

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();

        return response()->json(['message' => 'Resep berhasil dihapus.']);
    }
}
