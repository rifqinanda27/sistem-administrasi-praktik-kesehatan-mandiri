<?php

namespace App\Http\Controllers\Api;


use App\Models\JenisPemeriksaanLab;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JenisPemeriksaanLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:laboran');
    }

    public function index()
    {
        return response()->json(JenisPemeriksaanLab::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pemeriksaan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'biaya' => 'required|numeric|min:0',
        ]);

        $jenis = JenisPemeriksaanLab::create($data);

        return response()->json($jenis, 201);
    }

    public function update(Request $request, $id)
    {
        $jenis = JenisPemeriksaanLab::findOrFail($id);

        $data = $request->validate([
            'nama_pemeriksaan' => 'sometimes|required|string|max:255',
            'kategori' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'biaya' => 'sometimes|required|numeric|min:0',
        ]);

        $jenis->update($data);

        return response()->json($jenis);
    }

    public function destroy($id)
    {
        $jenis = JenisPemeriksaanLab::findOrFail($id);
        $jenis->delete();

        return response()->json(['message' => 'Jenis pemeriksaan dihapus.']);
    }
}
