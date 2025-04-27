<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('app.api_base_url');
    }

    public function index()
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/users");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $users = $response->json('data');

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // Asumsi roles tetap lokal, karena di API gak disediakan?
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/users", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'verified' => $request->verified,
        ]);

        // dd($request->all());

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal membuat user']);
        }

        toastr()->success('User berhasil dibuat');
        return redirect()->route('manage-user.index');
    }

    public function edit($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("$this->apiBaseUrl/users/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }

        $user = $response->json('data');
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->put("$this->apiBaseUrl/users/{$id}", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'verified' => $request->verified,
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui user']);
        }

        toastr()->success('User berhasil diperbarui');
        return redirect()->route('manage-user.index');
    }

    public function destroy($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->delete("$this->apiBaseUrl/users/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal menghapus user']);
        }

        toastr()->success('User berhasil dihapus');
        return redirect()->route('manage-user.index');
    }
}
