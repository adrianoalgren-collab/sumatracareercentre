<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // 1. cek login dulu
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // 2. cek role
        if (Auth::user()->role !== $role) {
            return redirect('/login')->with('error', 'Akses ditolak');
        }

        return $next($request);
    }
}