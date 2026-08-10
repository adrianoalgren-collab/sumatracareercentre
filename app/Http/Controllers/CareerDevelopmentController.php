<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\CareerClass;
use App\Models\CareerLesson;
use App\Models\CareerEnrollment;
use App\Models\CareerLessonProgress;

class CareerDevelopmentController extends Controller
{
    /**
     * Halaman daftar kelas Career Development (publik/pelamar)
     */
    public function index(Request $request)
    {
        $query = CareerClass::where('status', 'published')
            ->withCount('lessons');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $classes = $query->latest()
            ->paginate(9)
            ->withQueryString(); // <-- tambahkan ini

        $enrolledCount = 0;

        if (auth()->check()) {
            $enrollments = CareerEnrollment::where('user_id', auth()->id())
                ->get()
                ->keyBy('class_id');

            $classes->getCollection()->transform(function ($item) use ($enrollments) {
                $item->enrollment = $enrollments->get($item->id);
                return $item;
            });

            $enrolledCount = $enrollments->count();
        }

        return view('CareerDevelopment.indexCareerDevelopmentPublic', compact('classes', 'enrolledCount'));
    }

    /**
     * Halaman detail kelas: daftar lesson beserta status
     * terkunci / bisa diakses / sudah selesai.
     */
    public function show($id)
    {
        $class = CareerClass::where('status', 'published')
            ->findOrFail($id);

        $lessons = CareerLesson::where('class_id', $class->id)
            ->orderBy('urutan')
            ->get();

        $enrollment = null;
        $completedLessonIds = collect();

        if (auth()->check()) {
            $enrollment = CareerEnrollment::where('user_id', auth()->id())
                ->where('class_id', $class->id)
                ->first();

            if ($enrollment) {
                $completedLessonIds = CareerLessonProgress::where('user_id', auth()->id())
                    ->whereIn('lesson_id', $lessons->pluck('id'))
                    ->whereNotNull('completed_at')
                    ->pluck('lesson_id');
            }
        }

        // Tandai tiap lesson: selesai, terbuka, atau terkunci.
        // Lesson pertama selalu terbuka begitu user enroll.
        // Lesson berikutnya terbuka hanya jika lesson sebelumnya sudah selesai.
        $previousCompleted = true;

        $lessons = $lessons->map(function ($lesson) use (&$previousCompleted, $completedLessonIds, $enrollment, $class) {
            $isCompleted = $completedLessonIds->contains($lesson->id);

            $lesson->is_completed = $isCompleted;
            $lesson->is_unlocked = $previousCompleted;
            $lesson->is_locked = !$enrollment || !$previousCompleted;
            $lesson->url = Route::has('career.lesson.show')
                ? route('career.lesson.show', [$class->id, $lesson->id])
                : '#';

            // Status lesson berikutnya bergantung pada status lesson ini
            $previousCompleted = $isCompleted;

            return $lesson;
        });

        $totalLessons = $lessons->count();
        $completedCount = $completedLessonIds->count();
        $progressPercent = $totalLessons > 0
            ? (int) round(($completedCount / $totalLessons) * 100)
            : 0;

        $railStats = [
            'fill_percent' => $totalLessons > 0 ? ($completedCount / $totalLessons) * 100 : 0,
            'is_course_completed' => $enrollment && $totalLessons > 0 && $completedCount === $totalLessons,
        ];

        $ring = $this->buildProgressRing($progressPercent);

        return view('CareerDevelopment.indexClassCareerDevelopmentPublic', compact(
            'class',
            'lessons',
            'enrollment',
            'totalLessons',
            'completedCount',
            'progressPercent',
            'railStats',
            'ring'
        ));
    }

    /**
     * Daftarkan user yang sedang login ke sebuah kelas.
     */
    public function enroll($id)
    {
        $class = CareerClass::where('status', 'published')
            ->findOrFail($id);

        $alreadyEnrolled = CareerEnrollment::where('user_id', auth()->id())
            ->where('class_id', $class->id)
            ->exists();

        if (!$alreadyEnrolled) {
            CareerEnrollment::create([
                'user_id' => auth()->id(),
                'class_id' => $class->id,
                'status' => 'aktif',
                'enrolled_at' => now(),
            ]);
        }

        return redirect()
            ->route('career.show', $class->id)
            ->with('success', 'Berhasil mendaftar ke kelas ini.');
    }

    /**
     * Tampilkan konten satu lesson (video/artikel/dokumen).
     * Menolak akses kalau user belum enroll atau lesson masih terkunci.
     */
    public function lessonShow($classId, $lessonId)
    {
        $class = CareerClass::where('status', 'published')
            ->findOrFail($classId);

        $lesson = CareerLesson::where('class_id', $class->id)
            ->findOrFail($lessonId);

        $enrollment = CareerEnrollment::where('user_id', auth()->id())
            ->where('class_id', $class->id)
            ->first();

        if (!$enrollment) {
            return redirect()
                ->route('career.show', $class->id)
                ->with('error', 'Silakan daftar ke kelas ini terlebih dahulu.');
        }

        if (!$this->isLessonUnlocked(auth()->id(), $lesson)) {
            return redirect()
                ->route('career.show', $class->id)
                ->with('error', 'Selesaikan lesson sebelumnya terlebih dahulu untuk membuka lesson ini.');
        }

        $isCompleted = CareerLessonProgress::where('user_id', auth()->id())
            ->where('lesson_id', $lesson->id)
            ->whereNotNull('completed_at')
            ->exists();

        $nextLesson = CareerLesson::where('class_id', $class->id)
            ->where('urutan', $lesson->urutan + 1)
            ->first();

        $allLessons = CareerLesson::where('class_id', $class->id)
            ->orderBy('urutan')
            ->get();

        $completedLessonIds = CareerLessonProgress::where('user_id', auth()->id())
            ->whereIn('lesson_id', $allLessons->pluck('id'))
            ->whereNotNull('completed_at')
            ->pluck('lesson_id');

        $previousCompleted = true;

        $lessons = $allLessons->map(function ($item) use (&$previousCompleted, $completedLessonIds, $lesson, $class) {
            $itemCompleted = $completedLessonIds->contains($item->id);

            $item->is_completed = $itemCompleted;
            $item->is_locked = !$previousCompleted;
            $item->is_current = $item->id === $lesson->id;
            $item->url = Route::has('career.lesson.show')
                ? route('career.lesson.show', [$class->id, $item->id])
                : '#';

            $previousCompleted = $itemCompleted;

            return $item;
        });

        $totalLessons = $lessons->count();
        $completedCount = $completedLessonIds->count();

        $videoUrl = null;
        $docUrl = null;
        $docExt = null;
        $isPdf = false;

        if ($lesson->tipe_konten === 'video' && $lesson->file_path) {
            $videoUrl = asset('storage/' . $lesson->file_path);
        } elseif ($lesson->tipe_konten === 'dokumen' && $lesson->file_path) {
            $docUrl = asset('storage/' . $lesson->file_path);
            $docExt = strtolower(pathinfo($lesson->file_path, PATHINFO_EXTENSION));
            $isPdf = $docExt === 'pdf';
        }

        return view('CareerDevelopment.showLessonDetailPublic', compact(
            'class',
            'lesson',
            'isCompleted',
            'nextLesson',
            'lessons',
            'totalLessons',
            'completedCount',
            'videoUrl',
            'docUrl',
            'docExt',
            'isPdf'
        ));
    }

    /**
     * Tandai satu lesson sebagai selesai untuk user yang sedang login.
     * Kalau seluruh lesson di kelas sudah selesai, tandai enrollment sebagai 'selesai'.
     */
    public function lessonComplete($classId, $lessonId)
    {
        $class = CareerClass::where('status', 'published')
            ->findOrFail($classId);

        $lesson = CareerLesson::where('class_id', $class->id)
            ->findOrFail($lessonId);

        $enrollment = CareerEnrollment::where('user_id', auth()->id())
            ->where('class_id', $class->id)
            ->first();

        if (!$enrollment) {
            return redirect()
                ->route('career.show', $class->id)
                ->with('error', 'Silakan daftar ke kelas ini terlebih dahulu.');
        }

        if (!$this->isLessonUnlocked(auth()->id(), $lesson)) {
            return redirect()
                ->route('career.show', $class->id)
                ->with('error', 'Lesson ini masih terkunci.');
        }

        CareerLessonProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson_id' => $lesson->id,
            ],
            [
                'metode' => 'manual',
                'completed_at' => now(),
            ]
        );

        // Cek apakah semua lesson di kelas ini sudah selesai
        $totalLessons = CareerLesson::where('class_id', $class->id)->count();

        $completedLessons = CareerLessonProgress::where('user_id', auth()->id())
            ->whereIn('lesson_id', CareerLesson::where('class_id', $class->id)->pluck('id'))
            ->whereNotNull('completed_at')
            ->count();

        if ($totalLessons > 0 && $completedLessons === $totalLessons) {
            $enrollment->update([
                'status' => 'selesai',
                'completed_at' => now(),
            ]);
        }

        $nextLesson = CareerLesson::where('class_id', $class->id)
            ->where('urutan', $lesson->urutan + 1)
            ->first();

        if ($nextLesson) {
            return redirect()
                ->route('career.lesson.show', [$class->id, $nextLesson->id])
                ->with('success', 'Lesson selesai! Lanjut ke materi berikutnya.');
        }

        return redirect()
            ->route('career.show', $class->id)
            ->with('success', 'Selamat, kamu telah menyelesaikan seluruh kelas ini!');
    }

    /**
     * Helper: cek apakah sebuah lesson sudah bisa diakses oleh user tertentu,
     * berdasarkan apakah lesson sebelumnya (urutan - 1) sudah diselesaikan.
     */
    private function isLessonUnlocked($userId, CareerLesson $lesson): bool
    {
        if ($lesson->urutan <= 1) {
            return true;
        }

        $previousLesson = CareerLesson::where('class_id', $lesson->class_id)
            ->where('urutan', $lesson->urutan - 1)
            ->first();

        if (!$previousLesson) {
            return true;
        }

        return CareerLessonProgress::where('user_id', $userId)
            ->where('lesson_id', $previousLesson->id)
            ->whereNotNull('completed_at')
            ->exists();
    }

    /**
     * Helper: hitung parameter SVG progress ring (radius, circumference, offset)
     * berdasarkan persentase progress.
     */
    private function buildProgressRing(float $percent, int $radius = 26): array
    {
        $circumference = 2 * M_PI * $radius;

        return [
            'radius' => $radius,
            'circumference' => $circumference,
            'offset' => $circumference - ($percent / 100) * $circumference,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN: Kelola kelas & lesson Career Development
    |--------------------------------------------------------------------------
    */

    /**
     * Halaman daftar kelas Career Development (admin) — tampilkan semua status.
     */
    public function adminIndex(Request $request)
    {
        $query = CareerClass::withCount(['lessons', 'enrollments'])
            ->with('pembuat');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $classes = $query->latest()->paginate(10);

        return view('CareerDevelopment.indexCareerDevelopmentAdmin', compact('classes'));
    }

    /**
     * Halaman form tambah kelas.
     */
    public function create()
    {
        return view('CareerDevelopment.createCareerDevelopmentClass');
    }

    /**
     * Simpan kelas baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('career-thumbnails', 'public');
        }

        $validated['dibuat_oleh'] = auth()->id();

        CareerClass::create($validated);

        return redirect()
            ->route('admin.career.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Halaman detail kelas untuk admin: kelola lesson & peserta (tab).
     */
    public function showAdmin(Request $request, $id)
    {
        $class = CareerClass::withCount(['lessons', 'enrollments'])
            ->with('pembuat')
            ->findOrFail($id);

        $lessons = CareerLesson::where('class_id', $class->id)
            ->orderBy('urutan')
            ->get();

        $enrollments = CareerEnrollment::with('user')
            ->where('class_id', $class->id)
            ->latest('enrolled_at')
            ->get();

        // Tab aktif: default 'lessons', bisa 'peserta'
        $activeTab = $request->get('tab', 'lessons');
        if (!in_array($activeTab, ['lessons', 'peserta'])) {
            $activeTab = 'lessons';
        }

        return view('CareerDevelopment.indexCareerDevelopmentClassAdmin', compact(
            'class',
            'lessons',
            'enrollments',
            'activeTab'
        ));
    }

    /**
     * Halaman form edit kelas.
     */
    public function edit($id)
    {
        $class = CareerClass::findOrFail($id);

        return view('CareerDevelopment.editCareerDevelopmentClass', compact('class'));
    }

    /**
     * Update data kelas.
     */
    public function update(Request $request, $id)
    {
        $class = CareerClass::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('career-thumbnails', 'public');
        }

        $class->update($validated);

        return redirect()
            ->route('admin.career.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Hapus kelas beserta lesson & progres terkait.
     */
    public function destroy($id)
    {
        $class = CareerClass::findOrFail($id);

        $lessonIds = CareerLesson::where('class_id', $class->id)->pluck('id');

        CareerLessonProgress::whereIn('lesson_id', $lessonIds)->delete();
        CareerLesson::where('class_id', $class->id)->delete();
        CareerEnrollment::where('class_id', $class->id)->delete();
        $class->delete();

        return redirect()
            ->route('admin.career.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}