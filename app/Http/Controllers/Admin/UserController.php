<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('services.api.base_url');
    }

    public function index()
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/users");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $users = $response->json('data');

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $token = session('api_token');

         // Ambil data roles dari API
        $response = Http::withToken($token)->get("$this->apiBaseUrl/roles");
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data roles']);
        }

        $roles = $response->json('data');

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/users", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role,
        ]);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            // toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat user']);
        }
        return redirect()->route('users.index');
    }


    public function edit($id)
    {
        $token = session('api_token');
        
        $response = Http::withToken($token)->get("$this->apiBaseUrl/users/{$id}");
        
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }
        
        // dd($response);
        $user_edit = $response->json('data');

        // Ambil data role
        $responseRoles = Http::withToken($token)->get("$this->apiBaseUrl/roles");
        if (!$responseRoles->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data roles']);
        }
        $roles = $responseRoles->json('data');

        return view('admin.users.edit', compact('user_edit', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->put("$this->apiBaseUrl/users/{$id}", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role,
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui user']);
        }

        // toastr()->success('User berhasil diperbarui');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->delete("$this->apiBaseUrl/users/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal menghapus user']);
        }

        return redirect()->route('users.index');
    }
}
