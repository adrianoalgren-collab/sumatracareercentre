<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PelamarController extends Controller
{
    /**
     * Menampilkan daftar seluruh pelamar.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'pelamar');

        // Pencarian nama pelamar
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $pelamar = $query->latest()->paginate(10)->withQueryString();

        return view('Pelamar.indexPelamar', compact('pelamar'));
    }

    /**
     * Menampilkan form tambah pelamar.
     */
    public function create()
    {
        return view('Pelamar.tambahPelamar');
    }

    /**
     * Menyimpan data pelamar baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('pelamar', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'pelamar';

        User::create($validated);

        return redirect()
            ->route('admin.pelamar.index')
            ->with('success', 'Data pelamar berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu pelamar.
     */
    public function show(string $id)
    {
        $pelamar = User::where('role', 'pelamar')->findOrFail($id);

        return view('admin.pelamar.detail', compact('pelamar'));
    }

    /**
     * Menampilkan form edit pelamar.
     */
    public function edit(string $id)
    {
        $pelamar = User::where('role', 'pelamar')->findOrFail($id);

        return view('Pelamar.editPelamar', compact('pelamar'));
    }

    /**
     * Memperbarui data pelamar.
     */
    public function update(Request $request, string $id)
    {
        $pelamar = User::where('role', 'pelamar')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $pelamar->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('photo')) {
            if ($pelamar->photo) {
                Storage::disk('public')->delete($pelamar->photo);
            }
            $validated['photo'] = $request->file('photo')->store('pelamar', 'public');
        }

        $pelamar->update($validated);

        return redirect()
            ->route('admin.pelamar.index')
            ->with('success', 'Data pelamar berhasil diperbarui.');
    }

    /**
     * Menghapus data pelamar.
     */
    public function destroy(string $id)
    {
        $pelamar = User::where('role', 'pelamar')->findOrFail($id);

        if ($pelamar->photo) {
            Storage::disk('public')->delete($pelamar->photo);
        }

        $pelamar->delete();

        return redirect()
            ->route('admin.pelamar.index')
            ->with('success', 'Data pelamar berhasil dihapus.');
    }
}