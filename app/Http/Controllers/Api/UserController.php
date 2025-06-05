<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Dokter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Konstruktor untuk memastikan hanya admin yang bisa mengakses
    public function __construct()
    {
        $this->middleware('role:admin'); // Pastikan hanya admin yang bisa mengakses
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = User::with(['role']);

        // Optional: cari berdasarkan nama
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhereHas('role', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                    });
                });
        }


        $users = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $users->items(),
            'meta' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Ambil role berdasarkan ID
        $role = Role::find($request->role_id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
        ]);

        // Jika role-nya adalah dokterumum, otomatis buat entry di tabel dokter
        if (strtolower($role->name) === 'dokterumum') {
            // Cek apakah dokter dengan id_pengguna ini sudah ada
            $exists = Dokter::where('id_pengguna', $user->id)->exists();

            if (!$exists) {
                Dokter::create([
                    'id_pengguna' => $user->id,
                ]);
            }
        }

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }


    public function show($id)
    {
        $user = User::with('role')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    // Edit user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id, // Cek email kecuali untuk user ini
            'role_id' => 'nullable|integer|exists:roles,id', // Validasi role_id yang dikirim
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update data user
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            // Cek apakah role_id ada di request dan update, jika tidak biarkan yang lama
            'role_id' => $request->role_id ? Role::find($request->role_id)->id : $user->role_id,
        ]);

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }


    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cek apakah user memiliki role dokterumum
        if (strtolower($user->role->name) === 'dokterumum') {
            // Hapus entri dokter yang terkait dengan user ini
            $dokter = Dokter::where('id_pengguna', $user->id)->first();

            if ($dokter) {
                $dokter->delete(); // Hapus data dokter
            }
        }

        // Hapus user
        $user->delete();

        return response()->json(['message' => 'User and associated dokter deleted successfully']);
    }

}