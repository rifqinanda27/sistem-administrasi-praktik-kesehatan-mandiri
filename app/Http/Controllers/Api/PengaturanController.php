<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Storage;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaturan = Pengaturan::first();

        return response()->json([
            'success' => true,
            'data' => $pengaturan,
        ]);
    }

    public function upsert(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // optional tapi harus gambar
            'nama_aplikasi' => 'required',
            'kop_surat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required|email',
            'kode_pos' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
        ]);

        // Ambil data pertama
        $pengaturan = Pengaturan::first();

        // Jika ada file logo yang di-upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('logo', $filename, 'public');

            $validated['logo'] = $filename;

            // Hapus logo lama jika ada dan berbeda
            if ($pengaturan && $pengaturan->logo && $pengaturan->logo !== $filename) {
                // Storage::delete('public/logo/' . $pengaturan->logo);
                Storage::disk('public')->delete('logo/' . $pengaturan->logo);
            }
        } else {
            // Jika tidak upload logo baru, jangan ubah field logo saat update
            if ($pengaturan) {
                unset($validated['logo']);
            }
        }

        $validated['kota'] = strtoupper($validated['kota']);
        $validated['kop_surat'] = strtoupper($validated['kop_surat']);

        if ($pengaturan) {
            $pengaturan->update($validated);
        } else {
            $pengaturan = Pengaturan::create($validated);
        }

        return response()->json([
            'message' => 'Pengaturan berhasil disimpan.',
            'data' => $pengaturan
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
