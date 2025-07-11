<?php

namespace App\Http\Controllers\Api;

use App\Models\Visit;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:resepsionis,dokterumum');
    }

    // Menampilkan semua kunjungan
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = Visit::with([
            'penjamin',
            'pasien',
            'dokter',
            'dokter.dokter_detail',
            'catatan_medis:id_catatan,id_kunjungan,no_rekam_medis'
        ]);

        // ✅ Filter berdasarkan ID dari relasi dokter (users.id)
        if ($request->has('dokter_id')) {
            $query->whereHas('dokter', function ($q) use ($request) {
                $q->where('id', $request->input('dokter_id'));
            });
        }

        // 🔍 Optional: pencarian
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('tanggal_kunjungan', 'like', "%{$search}%")
                    ->orWhere('status_kunjungan', 'like', "%{$search}%")
                    ->orWhereHas('pasien', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'like', "%{$search}%");
                    })
                    ->orWhereHas('penjamin', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        $kunjungan = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $kunjungan->items(),
            'meta' => [
                'current_page' => $kunjungan->currentPage(),
                'last_page' => $kunjungan->lastPage(),
                'per_page' => $kunjungan->perPage(),
                'total' => $kunjungan->total(),
            ],
        ]);
    }



    // public function index()
    // {
    //     $kunjungan = Visit::with('penjamin', 'pasien', 'dokter', 'dokter.dokter_detail', 'catatan_medis:id_catatan,id_kunjungan,no_rekam_medis')->get();
    //     return response()->json([
    //         'success' => true,
    //         'data' => $kunjungan
    //     ]);
    // }

    // Menambahkan kunjungan baru
    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:patients,id_pasien',
            'id_dokter' => 'required|exists:users,id',
            'tanggal_kunjungan' => 'required|date',
            'tipe_kunjungan' => 'required|in:awal,lanjutan,prenatal,postnatal,darurat',
            'status_kunjungan' => 'required|in:terjadwal,dalam_proses,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $kunjungan = Visit::create($request->all());

        return response()->json($kunjungan, 201);
    }

    // Menampilkan kunjungan berdasarkan ID
    public function show($id)
    {
        $kunjungan = Visit::with(['penjamin', 'pasien', 'dokter', 'dokter.dokter_detail', 'catatan_medis:id_catatan,id_kunjungan,no_rekam_medis'])->findOrFail($id);
        return response()->json([
            'sucsess' => true,
            'data' => $kunjungan
        ]);
    }

    // Mengupdate kunjungan
    public function update(Request $request, $id)
    {
        $kunjungan = Visit::findOrFail($id);
        $kunjungan->update($request->all());

        return response()->json($kunjungan);
    }

    // Menghapus kunjungan
    public function destroy($id)
    {
        $kunjungan = Visit::findOrFail($id);
        $kunjungan->delete();

        return response()->json(['message' => 'Kunjungan deleted successfully']);
    }

    public function tipe_kunjungan()
    {
        $columns = \DB::select("SHOW COLUMNS FROM visits WHERE Field = 'tipe_kunjungan'");
        $columnType = $columns[0]->Type;

        preg_match_all("/'([^']+)'/", $columnType, $matches);
        $enumValues = $matches[1];

        return response()->json([
            'status' => 'success',
            'data' => $enumValues,
        ]);
    }

    public function status_kunjungan()
    {
        $columns = \DB::select("SHOW COLUMNS FROM visits WHERE Field = 'status_kunjungan'");
        $columnType = $columns[0]->Type;

        preg_match_all("/'([^']+)'/", $columnType, $matches);
        $enumValues = $matches[1];

        return response()->json([
            'status' => 'success',
            'data' => $enumValues,
        ]);
    }
}
