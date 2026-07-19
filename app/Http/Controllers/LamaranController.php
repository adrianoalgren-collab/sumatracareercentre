<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Lamaran;
use App\Models\LowonganPekerjaan;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SIMPAN LAMARAN (USER MELAMAR LOWONGAN)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, LowonganPekerjaan $lowongan)
    {
        $user = $request->user();

        // satu user hanya boleh melamar sekali per lowongan
        if ($lowongan->sudahDilamarOleh($user->id)) {
            return back()->with('error', 'Kamu sudah pernah melamar lowongan ini.');
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255'],
            'surat_lamaran' => ['required', 'string', 'max:3000'],
            'document_id' => ['nullable', 'exists:documents,id'],
            'cv_baru' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        // Tentukan dokumen (CV) yang dipakai untuk lamaran ini
        $documentId = $validated['document_id'] ?? null;

        if ($request->hasFile('cv_baru')) {
            $file = $request->file('cv_baru');
            $path = $file->store('documents', 'public');

            $document = Document::create([
                'user_id' => $user->id,
                'name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);

            $documentId = $document->id;
        }

        // Kalau tidak upload baru dan tidak pilih dokumen manapun,
        // pakai dokumen terbaru milik user sebagai fallback.
        if (! $documentId) {
            $documentId = $user->documents()->latest()->value('id');
        }

        if (! $documentId) {
            return back()
                ->withInput()
                ->with('error', 'Kamu belum memiliki CV. Silakan upload CV di profil atau saat melamar.');
        }

        Lamaran::create([
            'user_id' => $user->id,
            'lowongan_id' => $lowongan->id,
            'document_id' => $documentId,
            'surat_lamaran' => $validated['surat_lamaran'],
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS LAMARAN (OPSIONAL, ADMIN)
    |--------------------------------------------------------------------------
    */
    public function destroy(Lamaran $lamaran)
    {
        $lamaran->delete();

        return back()->with('success', 'Lamaran berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | SET JADWAL INTERVIEW (ADMIN, PER LOWONGAN)
    |--------------------------------------------------------------------------
    | Dipanggil dari modal "Set Jadwal Interview" di halaman daftar pelamar.
    | Jadwal HANYA diterapkan ke pelamar yang berstatus 'interview' pada
    | lowongan terkait; pelamar dengan status lain tidak disentuh (tetap null).
    | Route: PATCH /admin/lowongan/{lowongan}/jadwal-interview
    | Name : admin.lamaran.setJadwalInterview
    */
    public function setJadwalInterview(Request $request, LowonganPekerjaan $lowongan)
    {
        $validated = $request->validate([
            'jadwal_interview' => ['required', 'date'],
            'lokasi_interview' => ['nullable', 'string', 'max:255'],
            'catatan_interview' => ['nullable', 'string', 'max:1000'],
        ]);

        $count = Lamaran::where('lowongan_id', $lowongan->id)
            ->where('status', 'interview')
            ->update([
                'jadwal_interview' => $validated['jadwal_interview'],
                'lokasi_interview' => $validated['lokasi_interview'] ?? null,
                'catatan_interview' => $validated['catatan_interview'] ?? null,
            ]);

        if ($count === 0) {
            return back()->with('error', 'Belum ada pelamar berstatus Interview pada lowongan ini.');
        }

        return back()->with('success', "Jadwal interview berhasil disetel untuk {$count} pelamar.");
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS BANYAK LAMARAN SEKALIGUS (BULK)
    |--------------------------------------------------------------------------
    | Dipanggil dari checkbox "select all" / select per-baris di halaman
    | admin daftar pelamar.
    | Route: PATCH /admin/lamaran/bulk-status
    | Name : admin.lamaran.bulkStatus
    */
    public function bulkUpdateStatus(Request $request)
    {
        $validated = $request->validate([
            'lamaran_ids' => ['required', 'array', 'min:1'],
            'lamaran_ids.*' => ['exists:lamaran,id'], // <-- diganti dari 'lamarans' ke 'lamaran'
            'status' => ['required', 'in:pending,interview,diterima,ditolak'],
        ]);

        $count = Lamaran::whereIn('id', $validated['lamaran_ids'])
            ->update(['status' => $validated['status']]);

        return back()->with('success', "Status {$count} pelamar berhasil diperbarui.");
    }
}