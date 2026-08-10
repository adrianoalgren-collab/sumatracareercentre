<?php
namespace App\Jobs;
use App\Models\CareerLesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
class TranscodeLessonVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Batas waktu maksimal job ini boleh berjalan (detik).
     * Video 200MB bisa butuh beberapa menit tergantung durasi/resolusi.
     */
    public int $timeout = 1800; // 30 menit
    public int $tries = 2;
    public function __construct(
        public int $lessonId,
        /** Path relatif di disk 'public', hasil store() saat upload (file mentah asli) */
        public string $rawPath,
    ) {
    }
    public function handle(): void
    {
        $lesson = CareerLesson::find($this->lessonId);
        // Kalau lesson sudah dihapus, atau file sudah ditimpa upload lain
        // sebelum job ini sempat jalan -> batalkan, tidak relevan lagi.
        if (!$lesson || $lesson->file_path !== $this->rawPath) {
            return;
        }
        $disk = Storage::disk('public');
        if (!$disk->exists($this->rawPath)) {
            Log::error("TranscodeLessonVideo: file mentah tidak ditemukan untuk lesson {$this->lessonId}: {$this->rawPath}");
            $lesson->update(['video_status' => 'failed']);
            return;
        }
        $fullInputPath = $disk->path($this->rawPath);
        $outputRelative = 'career-lessons/'
            . pathinfo($this->rawPath, PATHINFO_FILENAME)
            . '-web.mp4';
        $fullOutputPath = $disk->path($outputRelative);
        $cropFilter = $this->detectCrop($fullInputPath);
        $videoFilters = array_filter([$cropFilter]);
        $process = new Process(array_merge([
            'ffmpeg',
            '-y', // overwrite kalau file output sudah ada
            '-i', $fullInputPath,
        ], $videoFilters ? ['-vf', implode(',', $videoFilters)] : [], [
            '-c:v', 'libx264',
            '-profile:v', 'high',
            '-pix_fmt', 'yuv420p', // kunci utama fix "video hitam, audio jalan"
            '-c:a', 'aac',
            '-b:a', '160k',
            '-movflags', '+faststart',
            $fullOutputPath,
        ]));
        $process->setTimeout($this->timeout);
        try {
            $process->mustRun();
        } catch (ProcessFailedException $e) {
            Log::error("TranscodeLessonVideo gagal untuk lesson {$this->lessonId}: " . $e->getMessage());
            $lesson->update(['video_status' => 'failed']);
            // Bersihkan file output parsial kalau sempat kebuat
            if ($disk->exists($outputRelative)) {
                $disk->delete($outputRelative);
            }
            return;
        }
        // Hapus file mentah asli (mov/avi/mkv/dll), ganti file_path ke hasil transcode
        $disk->delete($this->rawPath);
        $lesson->update([
            'file_path' => $outputRelative,
            'video_status' => 'ready',
        ]);
    }
    /**
     * Scan beberapa detik pertama video buat deteksi area hitam di sekeliling
     * konten (mis. hasil rekaman video call yang cuma keisi di sebagian frame).
     * Return string filter "crop=W:H:X:Y" atau null kalau tidak ada crop yang perlu.
     */
    private function detectCrop(string $fullInputPath): ?string
    {
        $process = new Process([
            'ffmpeg',
            '-i', $fullInputPath,
            '-vf', 'cropdetect=24:16:0',
            '-t', '20', // cukup scan 20 detik pertama
            '-f', 'null',
            '-',
        ]);
        $process->setTimeout(120);
        try {
            $process->run();
        } catch (\Throwable $e) {
            Log::warning("TranscodeLessonVideo: cropdetect gagal, skip crop. " . $e->getMessage());
            return null;
        }
        $output = $process->getErrorOutput();
        if (!preg_match_all('/crop=(\d+):(\d+):(\d+):(\d+)/', $output, $matches)) {
            return null;
        }
        // Ambil hasil deteksi terakhir (paling stabil setelah beberapa frame di-scan)
        $last = count($matches[0]) - 1;
        $width  = (int) $matches[1][$last];
        $height = (int) $matches[2][$last];
        $x      = (int) $matches[3][$last];
        $y      = (int) $matches[4][$last];
        if ($width <= 0 || $height <= 0) {
            return null;
        }
        return "crop={$width}:{$height}:{$x}:{$y}";
    }
    public function failed(\Throwable $exception): void
    {
        CareerLesson::where('id', $this->lessonId)->update(['video_status' => 'failed']);
        Log::error("TranscodeLessonVideo job gagal total untuk lesson {$this->lessonId}: " . $exception->getMessage());
    }
}