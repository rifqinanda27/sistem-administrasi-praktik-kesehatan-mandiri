<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_menu')->only('index', 'show');
        $this->middleware('permission:create_menu')->only('store');
        $this->middleware('permission:update_menu')->only('update');
        $this->middleware('permission:delete_menu')->only('destroy');
    }

    public function index()
    {
        $menus = Menu::all();
        return response()->json(['status' => 'success', 'data' => $menus]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $menu = Menu::create([
                'nama_menu' => $request->nama_menu,
                'url' => $request->url,
                'parent_id' => $request->parent_id,
                'icon' => $request->icon,
                'urutan' => 1,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Menu berhasil disimpan', 'data' => $menu], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi masalah pada server', 'debug' => $th->getMessage(),],  500);
        }
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['status' => 'error', 'message' => 'Menu tidak ditemukan'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $menu]);
    }

    public function update(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->update([
                'nama_menu' => $request->nama_menu,
                'url' => $request->url,
                'icon' => $request->icon,
                'parent_id' => $request->parent_id,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Menu berhasil diperbarui', 'data' => $menu]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi masalah pada server'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();

            return response()->json(['status' => 'success', 'message' => 'Menu berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi masalah pada server'], 500);
        }
    }
}
