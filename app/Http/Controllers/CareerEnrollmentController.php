<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareerClass;
use App\Models\CareerEnrollment;
use App\Models\CareerLesson;
use App\Models\CareerLessonProgress;
use App\Models\User;

class CareerEnrollmentController extends Controller
{
    /**
     * Halaman kelola peserta untuk satu kelas.
     */
    public function index($classId)
    {
        $class = CareerClass::withCount('enrollments')->findOrFail($classId);

        $enrollments = CareerEnrollment::with('user')
            ->where('class_id', $class->id)
            ->latest('enrolled_at')
            ->get();

        return view('CareerDevelopment.indexCareerDevelopmentEnrollmentAdmin', compact(
            'class',
            'enrollments'
        ));
    }

    /**
     * Daftarkan user secara manual ke sebuah kelas oleh admin.
     */
    public function store(Request $request, $classId)
    {
        $class = CareerClass::findOrFail($classId);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $sudahTerdaftar = CareerEnrollment::where('user_id', $validated['user_id'])
            ->where('class_id', $class->id)
            ->exists();

        if ($sudahTerdaftar) {
            return redirect()
                ->route('admin.career.enrollment.index', $class->id)
                ->with('error', 'User ini sudah terdaftar di kelas ini.');
        }

        CareerEnrollment::create([
            'user_id' => $validated['user_id'],
            'class_id' => $class->id,
            'status' => 'aktif',
            'enrolled_at' => now(),
        ]);

        return redirect()
            ->route('admin.career.enrollment.index', $class->id)
            ->with('success', 'Peserta berhasil didaftarkan ke kelas ini.');
    }

    /**
     * Ubah status enrollment (mis. aktif -> selesai, atau nonaktifkan peserta).
     */
    public function update(Request $request, $classId, $enrollmentId)
    {
        $class = CareerClass::findOrFail($classId);

        $enrollment = CareerEnrollment::where('class_id', $class->id)
            ->findOrFail($enrollmentId);

        $validated = $request->validate([
            'status' => 'required|in:aktif,selesai,nonaktif',
        ]);

        $data = ['status' => $validated['status']];

        if ($validated['status'] === 'selesai' && !$enrollment->completed_at) {
            $data['completed_at'] = now();
        }

        $enrollment->update($data);

        return redirect()
            ->route('admin.career.enrollment.index', $class->id)
            ->with('success', 'Status peserta berhasil diperbarui.');
    }

    /**
     * Hapus enrollment (keluarkan peserta dari kelas),
     * sekaligus hapus progres lesson yang sudah dia catat di kelas ini.
     */
    public function destroy($classId, $enrollmentId)
    {
        $class = CareerClass::findOrFail($classId);

        $enrollment = CareerEnrollment::where('class_id', $class->id)
            ->findOrFail($enrollmentId);

        $lessonIds = CareerLesson::where('class_id', $class->id)->pluck('id');

        CareerLessonProgress::where('user_id', $enrollment->user_id)
            ->whereIn('lesson_id', $lessonIds)
            ->delete();

        $enrollment->delete();

        return redirect()
            ->route('admin.career.enrollment.index', $class->id)
            ->with('success', 'Peserta berhasil dikeluarkan dari kelas ini.');
    }
}