<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;

class KomentarController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SIMPAN KOMENTAR
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, $id)
    {
        $request->validate([
            'isi_komentar' => 'required'
        ]);

        Komentar::create([
            'lowongan_id' => $id,
            'user_id' => auth()->id(),
            'nama_user' => auth()->user()->name ?? 'Guest',
            'isi_komentar' => $request->isi_komentar,
        ]);

        return redirect()
            ->route('detail.lowongan.pekerjaan', $id)
            ->with('success', 'Komentar berhasil dikirim');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS KOMENTAR
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);

        // SECURITY: hanya pemilik komentar yang boleh hapus
        if ($komentar->user_id !== auth()->id()) {
            abort(403);
        }

        $lowonganId = $komentar->lowongan_id;

        $komentar->delete();

        return redirect()
            ->route('detail.lowongan.pekerjaan', $lowonganId)
            ->with('success', 'Komentar berhasil dihapus');
    }
}