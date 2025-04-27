<?php

namespace App\Http\Controllers\Api;

use App\Models\Visit;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:resepsionis');
    }

    // Menampilkan semua kunjungan
    public function index()
    {
        $kunjungan = Visit::with(['pasien', 'dokter'])->get();
        return response()->json($kunjungan);
    }

    // Menambahkan kunjungan baru
    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_dokter' => 'required|exists:pengguna,id_pengguna',
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
        $kunjungan = Visit::with(['pasien', 'dokter'])->findOrFail($id);
        return response()->json($kunjungan);
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
}
