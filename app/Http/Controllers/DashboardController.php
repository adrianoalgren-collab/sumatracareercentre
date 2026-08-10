<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lamaran;
use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\Artikel;
use App\Models\CareerClass;
use App\Models\CareerEnrollment;
use App\Models\Komentar;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /* ===== STAT CARDS ===== */
        $totalPelamar    = User::where('role', 'pelamar')->count();
        $totalPerusahaan = Perusahaan::count();
        $totalLowongan   = LowonganPekerjaan::where('status_lowongan', 'aktif')->count();
        $totalLamaran    = Lamaran::count();
        $totalInterview  = Lamaran::where('status', 'interview')->count();
        $totalArtikel    = Artikel::count();

        /* ===== LAMARAN PER STATUS ===== */
        $statusCounts = Lamaran::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $lamaranStatus = [
            'menunggu'  => $statusCounts->get('menunggu', 0),
            'interview' => $statusCounts->get('interview', 0),
            'diterima'  => $statusCounts->get('diterima', 0),
            'ditolak'   => $statusCounts->get('ditolak', 0),
        ];

        /* ===== JADWAL INTERVIEW TERDEKAT ===== */
        $interviewMendatang = Lamaran::with(['user', 'lowongan.perusahaan'])
            ->whereNotNull('jadwal_interview')
            ->where('jadwal_interview', '>=', now())
            ->orderBy('jadwal_interview')
            ->take(5)
            ->get();

        /* ===== LAMARAN TERBARU ===== */
        $lamaranTerbaru = Lamaran::with(['user', 'lowongan'])
            ->latest()
            ->take(5)
            ->get();

        /* ===== LOWONGAN TERBARU ===== */
        $lowonganTerbaru = LowonganPekerjaan::with('perusahaan')
            ->withCount('lamaran')
            ->latest()
            ->take(5)
            ->get();

        /* ===== CAREER DEVELOPMENT ===== */
        $totalKelas        = CareerClass::count();
        $totalPeserta      = CareerEnrollment::count();
        $totalSelesaiKelas = CareerEnrollment::whereNotNull('completed_at')->count();

        /* ===== ARTIKEL TERBARU ===== */
        $artikelTerbaru = Artikel::latest()->take(4)->get();

        /* ===== STATISTIK RINGKAS ===== */
        $totalUserAdmin      = User::where('role', 'admin')->count();
        $totalUserPerusahaan = User::where('role', 'perusahaan')->count();
        $totalUserPelamar    = $totalPelamar;
        $totalLowonganAktif  = $totalLowongan;

        $totalLamaranHariIni   = Lamaran::whereDate('created_at', Carbon::today())->count();
        $totalLamaranMingguIni = Lamaran::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->count();

        /* ===== GRAFIK TREN 12 BULAN ===== */
        $tahunIni = Carbon::now()->year;

        $labelBulan = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des',
        ];

        $userPerBulanRaw = User::where('role', 'pelamar')
            ->whereYear('created_at', $tahunIni)
            ->selectRaw('MONTH(created_at) as bulan, count(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $lamaranPerBulanRaw = Lamaran::whereYear('created_at', $tahunIni)
            ->selectRaw('MONTH(created_at) as bulan, count(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $chartUserBulanan = [];
        $chartLamaranBulanan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $chartUserBulanan[]    = $userPerBulanRaw->get($bulan, 0);
            $chartLamaranBulanan[] = $lamaranPerBulanRaw->get($bulan, 0);
        }

        /* ===== MODERASI ===== */
        // status_lowongan sesuai fillable model LowonganPekerjaan
        $lowonganPendingApproval = LowonganPekerjaan::with('perusahaan')
            ->where('status_lowongan', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // Model Komentar tidak punya kolom status -> tampilkan yang terbaru saja
        $komentarTerbaru = Komentar::with(['user', 'lowongan'])
            ->latest()
            ->take(5)
            ->get();

        /* ===== TOP PERFORMERS ===== */
        // relasi di model Perusahaan bernama lowonganPekerjaan(), bukan lowongan()
        $topPerusahaan = Perusahaan::withCount('lowonganPekerjaan')
            ->orderByDesc('lowongan_pekerjaan_count')
            ->take(5)
            ->get();

        $topLowongan = LowonganPekerjaan::with('perusahaan')
            ->withCount('lamaran')
            ->orderByDesc('lamaran_count')
            ->take(5)
            ->get();

        /* ===== CAREER CLASS ===== */
        // status field sudah ada di model CareerClass (dipakai juga oleh scopePublished)
        $totalKelasPublished = CareerClass::published()->count();
        $totalEnrollment     = $totalPeserta;
        $rataCompletionRate  = $totalPeserta > 0
            ? round(($totalSelesaiKelas / $totalPeserta) * 100, 1)
            : 0;

        /* ===== ARTIKEL DRAFT ===== */
        // status field sudah ada di fillable model Artikel
        $artikelDraft = Artikel::where('status', 'draft')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('Dashboard.adminDashboard', compact(
            'totalPelamar', 'totalPerusahaan', 'totalLowongan', 'totalLamaran',
            'totalInterview', 'totalArtikel', 'lamaranStatus', 'interviewMendatang',
            'lamaranTerbaru', 'lowonganTerbaru', 'totalKelas', 'totalPeserta',
            'totalSelesaiKelas', 'artikelTerbaru', 'totalUserAdmin', 'totalUserPerusahaan',
            'totalUserPelamar', 'totalLowonganAktif', 'totalLamaranHariIni',
            'totalLamaranMingguIni', 'labelBulan', 'chartUserBulanan', 'chartLamaranBulanan',
            'lowonganPendingApproval', 'komentarTerbaru', 'topPerusahaan', 'topLowongan',
            'totalKelasPublished', 'totalEnrollment', 'rataCompletionRate', 'artikelDraft'
        ));
    }

    public function perusahaan()
    {
        // Perusahaan yang sedang login. Disesuaikan dengan kolom user_id di model Perusahaan
        // -> ganti ke auth()->user()->perusahaan kalau User sudah punya relasi hasOne('perusahaan').
        $perusahaan = Perusahaan::where('user_id', auth()->id())->firstOrFail();

        $lowonganIds = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->pluck('id');

        /* ===== KARTU RINGKASAN ===== */
        $totalLowonganAktif = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
            ->where('status_lowongan', 'aktif')
            ->count();

        $totalPendaftar = Lamaran::whereIn('lowongan_id', $lowonganIds)->count();
        $totalInterview = Lamaran::whereIn('lowongan_id', $lowonganIds)
            ->where('status', 'interview')
            ->count();

        /* ===== PIPELINE PELAMAR (FUNNEL) ===== */
        $funnelCounts = Lamaran::whereIn('lowongan_id', $lowonganIds)
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $funnelMenunggu  = $funnelCounts->get('menunggu', 0);
        $funnelInterview = $funnelCounts->get('interview', 0);
        $funnelDiterima  = $funnelCounts->get('diterima', 0);
        $funnelDitolak   = $funnelCounts->get('ditolak', 0);

        /* ===== KALENDER INTERVIEW ===== */
        // relasi pelamar di model Lamaran bernama user() (lihat method index() di atas)
        $interviewMendatang = Lamaran::with(['user', 'lowongan'])
            ->whereIn('lowongan_id', $lowonganIds)
            ->whereNotNull('jadwal_interview')
            ->where('jadwal_interview', '>=', now())
            ->orderBy('jadwal_interview')
            ->take(5)
            ->get();

        /* ===== PER LOWONGAN ===== */
        // komentar_count dari relasi komentar() di LowonganPekerjaan.
        // bookmark_count hanya diikutkan kalau model/relasi Bookmark sudah ada,
        // supaya query tidak error selama fitur bookmark belum dibuat.
        $withCounts = ['komentar as komentar_count'];
        if (method_exists(LowonganPekerjaan::class, 'bookmark')) {
            $withCounts[] = 'bookmark as bookmark_count';
        }

        $lowonganList = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
            ->withCount($withCounts)
            ->latest()
            ->get();
        // Catatan: total_pendaftar & total_interview per-lowongan dipakai lewat
        // accessor yang sudah ada di model LowonganPekerjaan ($item->total_pendaftar,
        // $item->total_interview), jadi tidak perlu di-query ulang di sini.

        /* ===== ENGAGEMENT ===== */
        $lowonganEngagement = $lowonganList
            ->sortByDesc(fn ($item) => ($item->komentar_count ?? 0) + ($item->bookmark_count ?? 0))
            ->take(5)
            ->values();

        return view('Dashboard.perusahaanDashboard', compact(
            'totalLowonganAktif', 'totalPendaftar', 'totalInterview',
            'funnelMenunggu', 'funnelInterview', 'funnelDiterima', 'funnelDitolak',
            'interviewMendatang', 'lowonganList', 'lowonganEngagement'
        ));
    }
}