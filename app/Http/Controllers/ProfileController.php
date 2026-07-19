<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('Pelamar.profilsaya', [
            'user' => $user,
            'totalLamaran' => $user->lamaran()->count(),
            'totalInterview' => $user->lamaran()->where('status', 'interview')->count(),
            'totalDiterima' => $user->lamaran()->whereIn('status', ['diterima', 'ditolak'])->count(),
            'jadwalInterviews' => $user->lamaran()
                ->with('lowongan.perusahaan')
                ->where('status', 'interview')
                ->orderByRaw('jadwal_interview IS NULL, jadwal_interview ASC')
                ->get(),
        ]);
    }

    public function jadwalInterview(Request $request)
    {
        $user = $request->user();

        return view('Pelamar.indexJadwalInterview', [
            'user' => $user,
            'jadwalInterviews' => $user->lamaran()
                ->with('lowongan.perusahaan')
                ->where('status', 'interview')
                ->orderByRaw('jadwal_interview IS NULL, jadwal_interview ASC')
                ->get(),
        ]);
    }

    public function pengumumanInterview(Request $request)
    {
        $user = $request->user();

        $pengumuman = $user->lamaran()
            ->with('lowongan.perusahaan')
            ->whereIn('status', ['diterima', 'ditolak'])
            ->orderByDesc('updated_at')
            ->get();

        return view('Pelamar.indexPengumuman', [
            'user' => $user,
            'pengumuman' => $pengumuman,
            'totalDiterima' => $pengumuman->where('status', 'diterima')->count(),
            'totalDitolak' => $pengumuman->where('status', 'ditolak')->count(),
        ]);
    }

    /**
     * Detail hasil pengumuman interview (diterima / ditolak).
     * Menampilkan view berbeda sesuai status lamaran.
     */
    public function pengumumanDetail(Request $request, $id)
    {
        $user = $request->user();

        $item = $user->lamaran()
            ->with('lowongan.perusahaan')
            ->whereIn('status', ['diterima', 'ditolak'])
            ->findOrFail($id);

        if ($item->status === 'diterima') {
            return view('Pelamar.indexDiterima', [
                'user' => $user,
                'item' => $item,
            ]);
        }

        return view('Pelamar.indexDitolak', [
            'user' => $user,
            'item' => $item,
        ]);
    }

    public function edit(Request $request)
    {
        return view('Pelamar.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ];

        if ($user->isPerusahaan()) {
            $rules['company_name'] = 'nullable|string|max:255';
            $rules['company_website'] = 'nullable|url|max:255';
        }

        $data = $request->validate($rules);
        $user->update($data);

        if ($request->wantsJson()) {
            return response()->json($user->fresh());
        }

        return redirect()->route('profil.saya')->with('success', 'Profil berhasil diperbarui');
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
        ]);

        $user = $request->user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $path = $request->file('photo')->store('avatars', 'public');
        $user->update(['photo' => $path]);

        return response()->json([
            'avatar_url' => $user->fresh()->avatar_url,
        ]);
    }

    public function addSkill(Request $request)
    {
        $validated = $request->validate([
            'skill' => ['required', 'string', 'max:50'],
        ]);

        $user = $request->user();
        $skills = $user->skills ?? [];
        $skill = trim($validated['skill']);

        if (! in_array($skill, $skills, true)) {
            $skills[] = $skill;
            $user->update(['skills' => $skills]);
        }

        return response()->json(['skills' => $user->skills]);
    }

    public function removeSkill(Request $request)
    {
        $validated = $request->validate([
            'skill' => ['required', 'string', 'max:50'],
        ]);

        $user = $request->user();
        $skills = collect($user->skills ?? [])
            ->reject(fn ($s) => $s === $validated['skill'])
            ->values()
            ->all();

        $user->update(['skills' => $skills]);

        return response()->json(['skills' => $skills]);
    }
}