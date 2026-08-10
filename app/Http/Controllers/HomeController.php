<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\Artikel; // ADDED — sesuaikan namespace/nama model kalau beda

class HomeController extends Controller
{
    public function index()
    {
        $lowongan = LowonganPekerjaan::with(['perusahaan', 'jurusan'])
            ->where('status_lowongan', 'aktif')
            ->inRandomOrder()
            ->take(3)
            ->get();

        // ADDED — ambil artikel terbaru untuk section berita di homepage
        $featured = Artikel::latest()->first();

        $sideArticles = Artikel::when($featured, function ($query) use ($featured) {
                $query->where('id', '!=', $featured->id);
            })
            ->latest()
            ->take(1)
            ->get();

        return view('home', compact('lowongan', 'featured', 'sideArticles'));
    }
}