<?php

namespace App\Http\Controllers\Api;


use App\Models\PermintaanLab;
use App\Models\CatatanMedis;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mpdf\Mpdf;

class PermintaanLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:laboran,resepsionis,dokterumum');
    }

    public function index()
    {
        $permintaan = PermintaanLab::with('kunjungan.catatan_medis', 'kunjungan', 'kunjungan.pasien', 'laboratorium', 'jenis_pemeriksaan_lab', 'dokter', 'dokter.dokter_detail')->get();
        return response()->json([
            'success' => true,
            'data' => $permintaan
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kunjungan' => 'required|exists:visits,id_kunjungan',
            'id_laboratorium' => 'required|exists:laboratorium,id_laboratorium',
            'id_jenis_pemeriksaan' => 'required',
            'diminta_oleh' => 'required|exists:users,id',
            'status_permintaan' => 'required|in:menunggu,dalam_proses,selesai',
            'tanggal_permintaan' => 'nullable|date',
        ]);

        $permintaan = PermintaanLab::create($data);

        return response()->json([
            'success' => true,
            'data' => $permintaan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $permintaan = PermintaanLab::findOrFail($id);

        $data = $request->validate([
            'status_permintaan' => 'required|in:menunggu,dalam_proses,selesai',
        ]);

        $permintaan->update($data);

        return response()->json([
            'success' => true,
            'data' => $permintaan,
        ]);
    }

    public function destroy($id)
    {
        $permintaan = PermintaanLab::findOrFail($id);
        $permintaan->delete();

        return response()->json(['message' => 'Permintaan lab dihapus.']);
    }

    public function cetak_permintaan($id)
    {
        // Ambil data pasien dari database
        $pasien = CatatanMedis::with('kunjungan', 'kunjungan.pasien', 'kunjungan.dokter', 'kunjungan.dokter.dokter_detail', 'kunjungan.catatan_medis:id_catatan,id_kunjungan,no_rekam_medis')->findOrFail($id);

        $idKunjungan = $pasien->kunjungan->id_kunjungan;
        
        // dd($idKunjungan);
        $permintaan_lab = PermintaanLab::where('id_kunjungan', $idKunjungan)->firstOrFail();
        // dd($permintaan_lab);

        // Kirim ke view
        $html = view('resepsionis.lab.cetak_rujukan_lab', compact('pasien', 'permintaan_lab'))->render();
        // dd($html);

        // Buat PDF pakai mPDF
        $mpdf = new Mpdf([
            'format' => 'A4',
            'orientation' => 'P',
        ]);

        $mpdf->WriteHTML($html);
        return response($mpdf->Output('surat_rujukan_lab.pdf', 'I'), 200)
            ->header('Content-Type', 'application/pdf');

        // return view('resepsionis.lab.cetak_rujukan_lab');
    }
}
