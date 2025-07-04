<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function navbar()
    {
        $token = session('apiToken');

        $pengaturan = Http::withToken($token)->get("$this->apiBaseUrl/pengaturan")->json('data');

        return view('layouts.app', compact('pengaturan'));
    }
}
