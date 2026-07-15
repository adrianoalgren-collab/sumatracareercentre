<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Lamaran;
use App\Models\LowonganPekerjaan;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
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
}