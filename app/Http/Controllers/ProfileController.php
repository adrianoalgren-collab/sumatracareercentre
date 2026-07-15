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
            'totalDiterima' => $user->lamaran()->where('status', 'diterima')->count(),
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

    // ProfilController.php
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