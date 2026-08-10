<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use Illuminate\Http\Request;

class JadwalInterviewController extends Controller
{
    /* LISTING SEMUA LAMARAN YANG SUDAH/PERLU DIJADWALKAN INTERVIEW */
    public function index(Request $request)
    {
        $perPageOptions = [10, 25, 50, 100];
        $perPage = $request->get('per_page', 10);

        $lamaran = Lamaran::with(['user', 'lowongan.perusahaan'])
            ->where(function ($query) {
                $query->whereNotNull('jadwal_interview')
                      ->orWhere('status', 'interview');
            })
            ->when($request->search, function ($query, $search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orderBy('jadwal_interview')
            ->paginate($perPage)
            ->withQueryString();

        return view('JadwalInterview.indexJadwalInterviewAdmin', compact('lamaran', 'perPageOptions', 'perPage'));
    }

    /* HALAMAN EDIT / SET JADWAL */
    public function edit(Lamaran $lamaran)
    {
        return view('JadwalInterview.editJadwalInterviewAdmin', compact('lamaran'));
    }

    /* SIMPAN / UPDATE JADWAL INTERVIEW */
    public function update(Request $request, Lamaran $lamaran)
    {
        $request->validate([
            'jadwal_interview' => 'required|date',
            'lokasi_interview' => 'nullable|string|max:255',
            'catatan_interview' => 'nullable|string',
        ]);

        $lamaran->update([
            'jadwal_interview'  => $request->jadwal_interview,
            'lokasi_interview'  => $request->lokasi_interview,
            'catatan_interview' => $request->catatan_interview,
            'status'            => 'interview',
        ]);

        return redirect()->route('admin.jadwalinterview.index')
            ->with('success', 'Jadwal interview berhasil disimpan.');
    }

    /* BATALKAN JADWAL INTERVIEW */
    public function cancel(Lamaran $lamaran)
    {
        $lamaran->update([
            'jadwal_interview'  => null,
            'lokasi_interview'  => null,
            'catatan_interview' => null,
        ]);

        return back()->with('success', 'Jadwal interview dibatalkan.');
    }
}