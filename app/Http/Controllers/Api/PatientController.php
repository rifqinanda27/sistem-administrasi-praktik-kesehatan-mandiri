<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Patients;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:resepsionis,dokterumum');
    }

    // Menampilkan semua pasien
    public function index()
    {
        // Ambil semua pasien beserta kunjungan dan resep terkait
        $pasien = Patients::with([
            'kunjungan', 'kunjungan.dokter', 'kunjungan.penjamin'
        ])->get();  // Mengambil semua pasien

        return response()->json([
            'success' => true,
            'data' => $pasien,
        ]);
    }

    // Menambahkan pasien baru
    public function store(Request $request)
    {
        $request->validate([
            // 'no_rekam_medis' => 'required|unique:patients',
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,lainnya',
            'no_ktp' => 'required|unique:patients',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
        ]);

        $pasien = Patients::create($request->all());

        return response()->json($pasien, 201);
    }

    // Menampilkan pasien berdasarkan ID
    public function show($id)
    {
        $pasien = Patients::with([
            'kunjungan', 'kunjungan.dokter', 'kunjungan.penjamin', 'kunjungan.resep', 'kunjungan.resep.detail_resep', 'kunjungan.resep.detail_resep.obat', 'kunjungan.catatan_medis'
            // 'resep.obat' // Obat terkait dengan resep
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $pasien
        ]);
    }


    // Mengupdate data pasien
    public function update(Request $request, $id)
    {
        $pasien = Patients::findOrFail($id);

        $pasien->update($request->all());

        return response()->json($pasien);
    }

    // Menghapus pasien
    public function destroy($id)
    {
        $pasien = Patients::findOrFail($id);
        $pasien->delete();

        return response()->json(['message' => 'Pasien deleted successfully']);
    }
}
