<?php

namespace App\Http\Controllers\Api;


use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    // Konstruktor untuk memastikan hanya admin yang bisa mengakses
    public function __construct()
    {
        $this->middleware('role:admin'); // Pastikan hanya admin yang bisa mengakses
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = Role::query();

        // Optional: cari berdasarkan nama
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
                });
        }


        $roles = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $roles->items(),
            'meta' => [
                'current_page' => $roles->currentPage(),
                'last_page' => $roles->lastPage(),
                'per_page' => $roles->perPage(),
                'total' => $roles->total(),
            ],
        ]);
    }

    // // Menampilkan semua role
    // public function index()
    // {
    //     $roles = Role::all();
    //     return response()->json([
    //         'data' => $roles, // role name
    //     ]);
    // }

    // Mengupdate role
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $role->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Role updated successfully', 'role' => $role]);
    }


    // Menambah role baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Role created successfully', 'role' => $role], 201);
    }

    // Menampilkan satu role berdasarkan ID
    public function show($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $role
        ]);
    }


    // Menghapus role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }
}