<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengaturanController extends Controller
{
    public function __construct()
    {
        $this->apiBaseUrl = config('services.api.base_url');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = session('api_token');

        $pengaturan = Http::withToken($token)->get("$this->apiBaseUrl/pengaturan")->json('data');

        $tarif = Http::withToken($token)->get("$this->apiBaseUrl/tarif")->json('data');

        return view('admin.pengaturan.index', compact('pengaturan', 'tarif'));

    }

    public function upsert(Request $request)
    {
        $token = session('api_token');
        // dd($token);
        try {
            $validated = $request->validate([
                'biaya_admin' => 'required',
                'biaya_rujukan_lab' => 'required',
                'nama_aplikasi' => 'required',
                'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'alamat' => 'required',
                'no_telpon' => 'required',
                'kop_surat' => 'required',
                'kode_pos' => 'required',
                'email' => 'required|email',
                'kota' => 'required',
            ]);
        } catch (ValidationException $e) {
            dd($e->errors()); // lihat field mana yang error
        }

        // Kirim tarif ke API
        $response = Http::withToken($token)->post("$this->apiBaseUrl/tarif", [
            'biaya_admin' => $request->biaya_admin,
            'biaya_rujukan_lab' => $request->biaya_rujukan_lab,
        ]);

        // dd($response);

        if ($response->failed()) {
            return back()->withErrors([
                'message' => $response->json('message') ?? 'Gagal memperbarui tarif.'
            ])->withInput();
        }

        $pengaturanRequest = Http::withToken($token);

        // dd($pengaturanRequest);

        if ($request->hasFile('logo')) {
            $pengaturanRequest = $pengaturanRequest->attach(
                'logo',
                fopen($request->file('logo')->getRealPath(), 'r'),
                $request->file('logo')->getClientOriginalName()
            );
        }

        $response = $pengaturanRequest->post("$this->apiBaseUrl/pengaturan", [
            'nama_aplikasi' => $request->nama_aplikasi,
            'email' => $request->email,
            'no_telpon' => $request->no_telpon,
            'kop_surat' => $request->kop_surat,
            'kode_surat' => $request->kode_surat,
            'kode_pos' => $request->kode_pos,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
        ]);

        // dd($response);

        return redirect()->route('pengaturan.index');
    }
}
