<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerClass;
use App\Models\CareerLesson;
use App\Models\CareerLessonProgress;

class CareerLessonController extends Controller
{
    /**
     * Format file yang diizinkan & ukuran maksimal (dalam KB) per tipe konten.
     * Dipakai bareng oleh store() dan update() supaya aturannya konsisten.
     */
    private const FILE_RULES_BY_TIPE = [
        'dokumen' => [
            'mimes' => 'pdf,doc,docx,ppt,pptx',
            'max_kb' => 10240, // 10MB
        ],
        'video' => [
            'mimes' => 'mp4,mov,avi,mkv,webm',
            'max_kb' => 204800, // 200MB
        ],
    ];

    /**
     * Bangun rule validasi untuk field 'file' berdasarkan tipe_konten yang dipilih.
     * Tipe 'artikel' tidak butuh file, jadi cukup nullable.
     */
    private function fileRulesFor(?string $tipeKonten): array
    {
        $rules = ['nullable', 'file'];

        if (isset(self::FILE_RULES_BY_TIPE[$tipeKonten])) {
            $config = self::FILE_RULES_BY_TIPE[$tipeKonten];
            $rules[] = 'mimes:' . $config['mimes'];
            $rules[] = 'max:' . $config['max_kb'];
        }

        return $rules;
    }

    /**
     * Halaman kelola lesson untuk satu kelas.
     */
    public function index($classId)
    {
        $class = CareerClass::withCount('lessons')->findOrFail($classId);

        $lessons = CareerLesson::where('class_id', $class->id)
            ->orderBy('urutan')
            ->get();

        return view('CareerDevelopment.indexCareerDevelopmentLessonAdmin', compact(
            'class',
            'lessons'
        ));
    }

    /**
     * Halaman form tambah lesson untuk sebuah kelas.
     */
    public function create($classId)
    {
        $class = CareerClass::findOrFail($classId);

        return view('CareerDevelopment.createCareerDevelopmentLesson', compact('class'));
    }

    /**
     * Simpan lesson baru ke dalam sebuah kelas.
     * Urutan otomatis diisi berdasarkan lesson terakhir + 1.
     */
    public function store(Request $request, $classId)
    {
        $class = CareerClass::findOrFail($classId);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tipe_konten' => 'required|in:video,artikel,dokumen',
            'konten' => 'nullable|string',
            'file' => $this->fileRulesFor($request->input('tipe_konten')),
            'durasi_menit' => 'nullable|integer|min:0',
        ]);

        // Wajibkan file kalau tipe kontennya dokumen atau video
        if (in_array($validated['tipe_konten'], ['dokumen', 'video']) && !$request->hasFile('file')) {
            return back()
                ->withErrors(['file' => 'File wajib diunggah untuk lesson bertipe ' . $validated['tipe_konten'] . '.'])
                ->withInput();
        }

        $urutanTerakhir = CareerLesson::where('class_id', $class->id)->max('urutan');

        $data = [
            'class_id' => $class->id,
            'judul' => $validated['judul'],
            'tipe_konten' => $validated['tipe_konten'],
            // konten (link/teks) cuma relevan untuk tipe artikel
            'konten' => $validated['tipe_konten'] === 'artikel' ? ($validated['konten'] ?? null) : null,
            'durasi_menit' => $validated['durasi_menit'] ?? null,
            'urutan' => ($urutanTerakhir ?? 0) + 1,
        ];

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('career-lessons', 'public');
        }

        CareerLesson::create($data);

        return redirect()
            ->route('admin.career.lesson.index', $class->id)
            ->with('success', 'Lesson berhasil ditambahkan.');
    }

    /**
     * Halaman form edit lesson.
     */
    public function edit($classId, $lessonId)
    {
        $class = CareerClass::findOrFail($classId);

        $lesson = CareerLesson::where('class_id', $class->id)
            ->findOrFail($lessonId);

        return view('CareerDevelopment.editCareerDevelopmentLesson', compact('class', 'lesson'));
    }

    /**
     * Update data satu lesson.
     * Kalau ada file baru diunggah, file lama akan dihapus dari storage.
     */
    public function update(Request $request, $classId, $lessonId)
    {
        $class = CareerClass::findOrFail($classId);

        $lesson = CareerLesson::where('class_id', $class->id)
            ->findOrFail($lessonId);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tipe_konten' => 'required|in:video,artikel,dokumen',
            'konten' => 'nullable|string',
            'file' => $this->fileRulesFor($request->input('tipe_konten')),
            'durasi_menit' => 'nullable|integer|min:0',
        ]);

        // Wajib ada file (baik file lama yang masih tersimpan, atau file baru)
        // untuk lesson bertipe dokumen atau video
        if (
            in_array($validated['tipe_konten'], ['dokumen', 'video'])
            && !$lesson->file_path
            && !$request->hasFile('file')
        ) {
            return back()
                ->withErrors(['file' => 'File wajib diunggah untuk lesson bertipe ' . $validated['tipe_konten'] . '.'])
                ->withInput();
        }

        $data = [
            'judul' => $validated['judul'],
            'tipe_konten' => $validated['tipe_konten'],
            'konten' => $validated['tipe_konten'] === 'artikel' ? ($validated['konten'] ?? null) : null,
            'durasi_menit' => $validated['durasi_menit'] ?? null,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama kalau ada, sebelum menyimpan yang baru
            if ($lesson->file_path) {
                Storage::disk('public')->delete($lesson->file_path);
            }

            $data['file_path'] = $request->file('file')->store('career-lessons', 'public');
        } elseif (!in_array($validated['tipe_konten'], ['dokumen', 'video']) && $lesson->file_path) {
            // Tipe konten diubah jadi artikel -> file lama (dokumen/video) sudah tidak relevan
            Storage::disk('public')->delete($lesson->file_path);
            $data['file_path'] = null;
        }

        $lesson->update($data);

        return redirect()
            ->route('admin.career.lesson.index', $class->id)
            ->with('success', 'Lesson berhasil diperbarui.');
    }

    /**
     * Hapus satu lesson beserta file terkait dan progres user yang terkait,
     * lalu rapikan kembali urutan lesson yang tersisa.
     */
    public function destroy($classId, $lessonId)
    {
        $class = CareerClass::findOrFail($classId);

        $lesson = CareerLesson::where('class_id', $class->id)
            ->findOrFail($lessonId);

        // Hapus file fisik dari storage kalau ada
        if ($lesson->file_path) {
            Storage::disk('public')->delete($lesson->file_path);
        }

        CareerLessonProgress::where('lesson_id', $lesson->id)->delete();

        $urutanDihapus = $lesson->urutan;
        $lesson->delete();

        // Geser urutan lesson yang ada di belakangnya agar tidak bolong
        CareerLesson::where('class_id', $class->id)
            ->where('urutan', '>', $urutanDihapus)
            ->decrement('urutan');

        return redirect()
            ->route('admin.career.lesson.index', $class->id)
            ->with('success', 'Lesson berhasil dihapus.');
    }

    /**
     * Ubah urutan lesson (drag & drop) dalam satu kelas.
     * Menerima array urutan lesson_id sesuai posisi barunya.
     *
     * Contoh payload:
     * { "lesson_ids": [5, 3, 4, 1, 2] }
     */
    public function reorder(Request $request, $classId)
    {
        $class = CareerClass::findOrFail($classId);

        $validated = $request->validate([
            'lesson_ids' => 'required|array',
            'lesson_ids.*' => 'integer|exists:career_lessons,id',
        ]);

        foreach ($validated['lesson_ids'] as $index => $lessonId) {
            CareerLesson::where('id', $lessonId)
                ->where('class_id', $class->id)
                ->update(['urutan' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan lesson berhasil diperbarui.',
        ]);
    }
}