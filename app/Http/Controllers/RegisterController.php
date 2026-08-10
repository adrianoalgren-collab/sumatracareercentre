<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Display the register page.
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Handle a registration request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(['pelamar', 'perusahaan'])],

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'phone' => ['nullable', 'string', 'max:20'],

            // Wajib diisi hanya kalau daftar sebagai perusahaan
            'company_name' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:255'],
            'company_website' => ['nullable', 'url', 'max:255'],
            'company_address' => ['nullable', 'string'],
        ], [
            'company_name.required_if' => 'Nama perusahaan wajib diisi untuk akun perusahaan.',
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'], // otomatis di-hash lewat cast 'hashed' di model
                'role' => $validated['role'],
                'phone' => $validated['phone'] ?? null,
                'company_name' => $validated['role'] === 'perusahaan'
                    ? $validated['company_name']
                    : null,
                'company_website' => $validated['role'] === 'perusahaan'
                    ? ($validated['company_website'] ?? null)
                    : null,
            ]);

            if ($validated['role'] === 'perusahaan') {
                Perusahaan::create([
                    'user_id' => $user->id,
                    'nama_perusahaan' => $validated['company_name'],
                    'email_perusahaan' => $validated['email'],
                    'telepon_perusahaan' => $validated['phone'] ?? null,
                    'alamat_perusahaan' => $validated['company_address'] ?? null,
                    'website_perusahaan' => $validated['company_website'] ?? null,
                    'status_perusahaan' => 'pending', // menunggu verifikasi admin
                ]);
            }

            return $user;
        });

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat, silakan login untuk melanjutkan.');
    }
}