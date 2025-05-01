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
            'kunjungan',  // Relasi ke kunjungan
            'resep' => function ($query) {  // Relasi ke resep melalui kunjungan
                $query->with('obat');  // Dapatkan obat yang terkait dengan resep
            }
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
            'no_rekam_medis' => 'required|unique:patients',
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
            'kunjungan' => function ($query) use ($id) {
                $query->where('id_pasien', $id);
            },
            'resep' => function ($query) use ($id) {
                $query->whereHas('kunjungan', function ($query) use ($id) {
                    $query->where('id_pasien', $id);
                });
            },
            'resep.obat' // Obat terkait dengan resep
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
