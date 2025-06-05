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
        $detail_resep = detail_resep::with('resep','kunjungan', 'kunjungan.penjamin', 'kunjungan.pembayaran', 'obat', 'instruksi', 'dokter', 'dokter.user')->get();

        return response()->json([
            'success' => true,
            'data' => $detail_resep,
        ]);
    }

    public function detail_resep_show($id)
    {
        $detail_resep = detail_resep::with('resep', 'kunjungan', 'kunjungan.penjamin', 'kunjungan.pembayaran', 'obat', 'instruksi', 'dokter', 'dokter.user')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $detail_resep,
        ]);
    }

    public function detail_resep_store(Request $request)
    {
        $validated = $request->validate([
            'dosis' => 'required|array',
            'dosis.*' => 'required|integer',
            'frekuensi' => 'required|array',
            'frekuensi.*' => 'required|integer',
            // 'id_kunjungan' => 'required|integer',
            'id_obat' => 'required|array',
            'id_obat.*' => 'required|integer',
            'id_instruksi' => 'required|array',
            'id_instruksi.*' => 'required|integer',
            'id_resep' => 'required|integer'
        ]);

        $results = [];

        foreach ($validated['id_obat'] as $index => $id_obat) {
            $id_instruksi = $validated['id_instruksi'][$index] ?? null;
            $dosis = $validated['dosis'][$index] ?? null;
            $frekuensi = $validated['frekuensi'][$index] ?? null;

            $detail_resep = detail_resep::create([
                // 'id_dokter' => $validated['id_dokter'],
                'id_obat' => $id_obat,
                'id_instruksi' => $id_instruksi,
                // 'id_kunjungan' => $validated['id_kunjungan'],
                'dosis' => $dosis,
                'frekuensi' => $frekuensi,
                'id_resep' => $validated['id_resep'],
            ]);

            $results[] = $detail_resep;
        }

        return response()->json([
        'success' => true,
        'data' => $results,
        ]);
    }


    // public function instruksi_index()
    // {
    //     $instruksi = Instruksi::all();
    //     return response()->json([
    //         'success' => true,
    //         'data' => $instruksi
    //     ]);
    // }

    public function instruksi_index(Request $request)
    {
        // Misal model Obat langsung dari database
        $perPage = $request->input('per_page', 10); // default 10 item per halaman

        $query = Instruksi::query();

        // Optional: cari berdasarkan nama
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('nama_instruksi', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%")
                ->orWhere('arti_latin', 'like', "%{$search}%");
            });
        }

        // Pagination
        $instruksi = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $instruksi->items(),
            'meta' => [
                'current_page' => $instruksi->currentPage(),
                'last_page' => $instruksi->lastPage(),
                'per_page' => $instruksi->perPage(),
                'total' => $instruksi->total(),
            ],
        ]);
    }

    public function instruksi_store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_instruksi' => 'required|string|max:255',
            'arti_latin' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        $instruksi = Instruksi::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Instruksi berhasil ditambahkan',
            'data' => $instruksi
        ]);
    }

    public function instruksi_update(Request $request, $id)
    {
        $instruksi = Instruksi::findOrFail($id);

        $validatedData = $request->validate([
            'nama_instruksi' => 'required|string|max:255',
            'arti_latin' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        $instruksi->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Instruksi berhasil diperbarui',
            'data' => $instruksi
        ]);
    }

    public function instruksi_show($id)
    {
        $instruksi = Instruksi::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $instruksi
        ]);
    }

    public function instruksi_destroy($id)
    {
        $instruksi = Instruksi::findOrFail($id);
        $instruksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Instruksi berhasil dihapus'
        ]);
    }
}
