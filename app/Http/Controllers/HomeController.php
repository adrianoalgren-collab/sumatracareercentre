<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;

class HomeController extends Controller
{
    public function index()
    {
        $lowongan = LowonganPekerjaan::with(['perusahaan', 'jurusan'])
            ->where('status_lowongan', 'aktif')
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('home', compact('lowongan'));
    }
}