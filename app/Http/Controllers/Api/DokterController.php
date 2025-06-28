<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,resepsionis'); // Pastikan hanya admin yang bisa mengakses
    }
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = Dokter::with(['user']);

        // Optional: cari berdasarkan nama
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('spesialisasi', 'like', "%{$search}%")
                ->where('status_praktik', 'like', "%{$search}%")
                ->where('pengalaman_tahun', 'like', "%{$search}%")
                ->where('nomor_sip', 'like', "%{$search}%")
                ->where('tarif_konsultasi', 'like', "%{$search}%")
                ->where('dokter_nip', 'like', "%{$search}%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                    });
                });
        }


        $dokters = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $dokters->items(),
            'meta' => [
                'current_page' => $dokters->currentPage(),
                'last_page' => $dokters->lastPage(),
                'per_page' => $dokters->perPage(),
                'total' => $dokters->total(),
            ],
        ]);
    }
    
    // public function index()
    // {
    //     $dokters = Dokter::with('user')->get();
    //     return response()->json([
    //         'success' => 'true',
    //         'data' => $dokters,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pengguna' => 'required|exists:users,id|unique:dokter,id_pengguna',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $dokter = Dokter::create($request->all());
        return response()->json(['success' => 'true', 'data' => $dokter, 201]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dokter = Dokter::with('user')->find($id);
        if (!$dokter) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }
        return response()->json([
            'success' => 'true',
            'data' => $dokter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dokter = Dokter::find($id);
        if (!$dokter) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nomor_sip' => 'sometimes|required|unique:dokter,nomor_sip,' . $id . ',id_dokter',
            'spesialisasi' => 'nullable|string',
            'pengalaman_tahun' => 'sometimes|required|integer|min:0',
            'status_praktik' => 'sometimes|required|in:aktif,tidak_aktif',
            'dokter_nip' => 'sometimes'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $dokter->update($request->all());
        return response()->json(['success' => 'true', 'data' => $dokter,]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokter = Dokter::find($id);
        if (!$dokter) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }

        $dokter->delete();
        return response()->json(['message' => 'Dokter berhasil dihapus']);
    }
}
