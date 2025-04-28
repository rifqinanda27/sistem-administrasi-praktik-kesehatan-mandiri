<?php

namespace App\Http\Controllers\Api;


use App\Models\HasilLab;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HasilLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:laboran');
    }

    public function index()
    {
        return response()->json(HasilLab::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_permintaan' => 'required|exists:permintaan_lab,id_permintaan',
            'id_jenis_pemeriksaan' => 'required|exists:jenis_pemeriksaan_lab,id_jenis_pemeriksaan',
            'nilai_hasil' => 'nullable|string|max:255',
            'interpretasi' => 'nullable|string',
            'id_laboratorium' => 'required|exists:laboratorium,id_laboratorium',
            'dilakukan_oleh' => 'required|exists:users,id',
            'status_hasil' => 'required|in:normal,abnormal,kritis',
            'tanggal_pemeriksaan' => 'nullable|date',
        ]);

        $hasil = HasilLab::create($data);

        return response()->json($hasil, 201);
    }

    public function update(Request $request, $id)
    {
        $hasil = HasilLab::findOrFail($id);

        $data = $request->validate([
            'nilai_hasil' => 'nullable|string|max:255',
            'interpretasi' => 'nullable|string',
            'status_hasil' => 'required|in:normal,abnormal,kritis',
        ]);

        $hasil->update($data);

        return response()->json($hasil);
    }

    public function destroy($id)
    {
        $hasil = HasilLab::findOrFail($id);
        $hasil->delete();

        return response()->json(['message' => 'Hasil lab dihapus.']);
    }
}
