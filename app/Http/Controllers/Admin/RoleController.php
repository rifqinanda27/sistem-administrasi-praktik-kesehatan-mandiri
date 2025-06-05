<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('services.api.base_url');
    }

    public function index(Request $request)
    {
        $token = session('api_token');

        // Ambil parameter dari request
        $page = $request->input('page', 1);
        $perPage = 10;
        $search = $request->input('search');

        // Kirim permintaan ke API eksternal
        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/roles", [
            'page' => $page,
            'per_page' => $perPage,
            'search' => $search,
        ]);

        // Tangani error dari API
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data roles']);
        }

        // Ambil dan siapkan data JSON dari API
        $json = $response->json();
        $data = $json['data'] ?? [];
        $meta = $json['meta'] ?? [];

        // Buat paginator agar bisa digunakan di Blade
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data,
            $meta['total'] ?? count($data),
            $meta['per_page'] ?? $perPage,
            $meta['current_page'] ?? $page,
            ['path' => url()->current(), 'query' => $request->query()]
        );

        // Cek apakah request dari AJAX
        if ($request->ajax()) {
            // Kirim hanya bagian tabel jika AJAX (optional, kalau pakai AJAX)
            return view('admin.roles.index', [
                'roles' => $paginator,
                'search' => $search
            ])->renderSections()['table'];
        }

        // Kirim ke view utama
        return view('admin.roles.index', [
            'roles' => $paginator,
            'search' => $search
        ]);
    }

    // public function index()
    // {
    //     $token = session('api_token');

    //     $response = Http::withToken($token)->get("$this->apiBaseUrl/roles");

    //     if (!$response->successful()) {
    //         return back()->withErrors(['message' => 'Gagal mengambil data users']);
    //     }

    //     $roles = $response->json('data');

    //     return view('admin.roles.index', compact('roles'));
    // }

    public function create()
    {
        $token = session('api_token');

        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $token = session('api_token');

        $request->validate([
            'name'         => 'required',
        ]);

        $response = Http::withToken($token)->post("$this->apiBaseUrl/roles", [
            'name' => $request->name,
        ]);
        
        // Tambahkan pengecekan statusnya
        if ($response->failed()) {
            toastr()->error('Gagal membuat role: ' . $response->json('message'));
            return back()->withErrors(['message' => $response->json('message') ?? 'Gagal membuat role']);
        }
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $token = session('api_token');
        
        $response = Http::withToken($token)->get("$this->apiBaseUrl/roles/{$id}");
        
        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user']);
        }

        $role_edit = $response->json('data');
        // dd($role_edit);


        return view('admin.roles.edit', compact('role_edit'));
    }

    public function update(Request $request, $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->put("$this->apiBaseUrl/roles/{$id}", [
            'name' => $request->name,
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal memperbarui role']);
        }

        // toastr()->success('User berhasil diperbarui');
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->delete("$this->apiBaseUrl/roles/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Gagal menghapus role']);
        }

        return redirect()->route('roles.index');
    }
}
