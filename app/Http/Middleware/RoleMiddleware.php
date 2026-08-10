<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. cek login dulu
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // 2. cek role (mendukung satu atau banyak role, dipisah koma di route)
        // contoh pemakaian di route: 'role:admin' atau 'role:admin,perusahaan'
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect('/login')->with('error', 'Akses ditolak');
        }

        return $next($request);
    }
}