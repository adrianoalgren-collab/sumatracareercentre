<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Halaman Login
     */
    public function index()
    {
        // jika sudah login, langsung redirect sesuai role
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('login');
    }

    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Attempt Login menggunakan tabel users
        |--------------------------------------------------------------------------
        */

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // remember me optional
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {

            // regenerate session (security)
            $request->session()->regenerate();

            return $this->redirectByRole();
        }

        /*
        |--------------------------------------------------------------------------
        | Login Gagal
        |--------------------------------------------------------------------------
        */

        return back()
            ->with('error', 'Email atau password salah.')
            ->withInput();
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // hapus session lama
        $request->session()->invalidate();

        // regenerate csrf token
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil logout');
    }

    /**
     * Redirect berdasarkan role user
     */
    private function redirectByRole()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Selamat datang Admin!');
        }

        if ($user->role === 'perusahaan') {
            return redirect()
                ->route('perusahaan.dashboard')
                ->with('success', 'Selamat datang Perusahaan!');
        }

        if ($user->role === 'pelamar') {
            return redirect()
                ->route('home')
                ->with('success', 'Selamat datang Pelamar!');
        }

        // fallback jika role tidak dikenali
        Auth::logout();

        return redirect()
            ->route('login')
            ->with('error', 'Role user tidak valid.');
    }
}