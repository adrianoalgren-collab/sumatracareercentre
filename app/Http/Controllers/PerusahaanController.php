<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerusahaanController extends Controller
{
    /**
     * Menampilkan daftar seluruh perusahaan.
     */
    public function index(Request $request)
    {
        $query = Perusahaan::query();

        // Pencarian nama perusahaan
        if ($request->filled('search')) {
            $query->where('nama_perusahaan', 'like', '%' . $request->search . '%');
        }

        // Filter status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_perusahaan', $request->status);
        }

        $perusahaan = $query->latest()->paginate(10)->withQueryString();

        return view('perusahaan.indexPerusahaan', compact('perusahaan'));
    }

    /**
     * Menampilkan form tambah perusahaan.
     */
    public function create()
    {
        return view('perusahaan.tambahPerusahaan');
    }

    /**
     * Menyimpan data perusahaan baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'    => 'required|string|max:255',
            'email_perusahaan'   => 'required|email|max:255|unique:perusahaan,email_perusahaan',
            'telepon_perusahaan' => 'nullable|string|max:20',
            'alamat_perusahaan'  => 'nullable|string',
            'website_perusahaan' => 'nullable|url|max:255',
            'status_perusahaan'  => 'required|in:aktif,nonaktif',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Perusahaan::create($validator->validated());

        return redirect()
            ->route('admin.perusahaan.index')
            ->with('success', 'Data perusahaan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu perusahaan.
     */
    public function show(string $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        return view('admin.perusahaan.detail', compact('perusahaan'));
    }

    /**
     * Menampilkan form edit perusahaan.
     */
    public function edit(string $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        return view('perusahaan.editPerusahaan', compact('perusahaan'));
    }

    /**
     * Memperbarui data perusahaan.
     */
    public function update(Request $request, string $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_perusahaan'    => 'required|string|max:255',
            'email_perusahaan'   => 'required|email|max:255|unique:perusahaan,email_perusahaan,' . $perusahaan->id,
            'telepon_perusahaan' => 'nullable|string|max:20',
            'alamat_perusahaan'  => 'nullable|string',
            'website_perusahaan' => 'nullable|url|max:255',
            'status_perusahaan'  => 'required|in:aktif,nonaktif',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $perusahaan->update($validator->validated());

        return redirect()
            ->route('admin.perusahaan.index')
            ->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    /**
     * Menghapus data perusahaan.
     */
    public function destroy(string $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        return redirect()
            ->route('admin.perusahaan.index')
            ->with('success', 'Data perusahaan berhasil dihapus.');
    }
}