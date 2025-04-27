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

    // Menampilkan semua role
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
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

    // Menghapus role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }
}