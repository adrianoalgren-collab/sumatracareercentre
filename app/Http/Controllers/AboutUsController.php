<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $isPerusahaan = auth()->check() && auth()->user()->role === 'perusahaan';

        return view('aboutUs', compact('isPerusahaan'));
    }
}