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

        $response = Http::withToken($token)->get('http://pbl-healthcare.test/api/user');
    
        if (!$response->successful()) {
            return redirect()->route('login')->withErrors(['msg' => 'Session expired']);
        }
    
        $user = $response->json();

        $response = Http::withToken($token)->get("$this->apiBaseUrl/users");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data users']);
        }

        $users = $response->json('data');

        return view('admin.users.index', compact('users', 'user'));
    }

    public function create()
    {
        $roles = Role::all(); // Asumsi roles tetap lokal, karena di API gak disediakan?
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->post("$this->apiBaseUrl/users", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'verified' => $request->has('verified') ? '1' : '0',
        ]);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            toastr()->error('Gagal membuat user: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat user']);
        }
        
        // Kalau sukses
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

        $user_edit = $response->json('data');
        $user_edit['roles_names'] = collect($user_edit['roles'])->pluck('name')->map(fn($name) => strtolower($name))->toArray();

        $roles = Role::all();

        return view('users.edit', compact('user_edit', 'roles'));
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
