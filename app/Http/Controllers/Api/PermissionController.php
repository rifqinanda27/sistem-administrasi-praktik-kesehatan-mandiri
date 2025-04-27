<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionController extends Controller
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
        $permissions = ModelsPermission::all();
        return response()->json([
            'status' => 'success',
            'data' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required|string',
            'menu_id' => 'nullable|integer',
        ]);

        try {
            $permission = ModelsPermission::create([
                'name' => $request->permission,
                'menu_id' => $request->menu_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Permission berhasil disimpan',
                'data' => $permission
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi masalah pada server'
            ], 500);
        }
    }

    public function show($id)
    {
        $permission = ModelsPermission::find($id);
        if (!$permission) {
            return response()->json([
                'status' => 'error',
                'message' => 'Permission tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $permission
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required|string',
            'menu_id' => 'nullable|integer',
        ]);

        try {
            $permission = ModelsPermission::findOrFail($id);
            $permission->update([
                'name' => $request->permission,
                'menu_id' => $request->menu_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Permission berhasil diperbarui',
                'data' => $permission
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi masalah pada server'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $permission = ModelsPermission::findOrFail($id);
            $permission->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Permission berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi masalah pada server'
            ], 500);
        }
    }
}
