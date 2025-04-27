<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read_role')->only('index', 'show');
        $this->middleware('permission:create_role')->only('store');
        $this->middleware('permission:update_role')->only('update');
        $this->middleware('permission:delete_role')->only('destroy');
    }

    public function index()
    {
        // dd(Permission::all());
        $roles = Role::all();
        return response()->json(['success' => true, 'data' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'menu_id' => 'required|array',
            'permission_id' => 'required|array',
        ]);

        try {
            $role = Role::create(['name' => strtolower($request->name)]);

            foreach ($request->menu_id as $value) {
                DB::table('role_has_menus')->insert([
                    'menu_id' => $value,
                    'role_id' => $role->id,
                ]);
            }

            $role->syncPermissions($request->permission_id);

            return response()->json(['success' => true, 'message' => 'Role berhasil disimpan']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Terdapat masalah di server', 'error' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role tidak ditemukan'], 404);
        }

        $menus = DB::table('role_has_menus')->where('role_id', $id)->pluck('menu_id');
        $permissions = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id');

        return response()->json([
            'success' => true,
            'data' => [
                'role' => $role,
                'menus' => $menus,
                'permissions' => $permissions,
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'menu_id' => 'required|array',
            'permission_id' => 'required|array',
        ]);

        try {
            DB::table('role_has_menus')->where('role_id', $id)->delete();

            $role = Role::findOrFail($id);

            foreach ($request->menu_id as $value) {
                DB::table('role_has_menus')->insert([
                    'menu_id' => $value,
                    'role_id' => $role->id,
                ]);
            }

            $role->update(['name' => strtolower($request->name)]);
            $role->syncPermissions($request->permission_id);

            return response()->json(['success' => true, 'message' => 'Role berhasil diperbarui']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Terdapat masalah di server', 'error' => $th->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('role_has_menus')->where('role_id', $id)->delete();
            Role::findOrFail($id)->delete();

            return response()->json(['success' => true, 'message' => 'Role berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Terdapat masalah di server'], 500);
        }
    }
}
