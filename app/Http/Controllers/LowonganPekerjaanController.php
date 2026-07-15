<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\LowonganPekerjaan;

class LowonganPekerjaanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN LIST LOWONGAN FRONTEND
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
{
    $query = LowonganPekerjaan::with('perusahaan')
        ->where('status_lowongan', 'aktif');

    /*
    |----------------------------------------------------------------
    | FILTER: Pencarian (posisi / nama perusahaan)
    |----------------------------------------------------------------
    */
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('judul_lowongan', 'like', "%{$search}%")
              ->orWhereHas('perusahaan', function ($q2) use ($search) {
                  $q2->where('nama_perusahaan', 'like', "%{$search}%");
              });
        });
    }

    /*
    |----------------------------------------------------------------
    | FILTER: Kategori (diambil dari kolom kategori_label)
    |----------------------------------------------------------------
    */
    if ($request->filled('kategori_label') && $request->kategori_label !== 'Semua Tipe') {
        $query->where('kategori_label', $request->kategori_label);
    }

    /*
    |----------------------------------------------------------------
    | FILTER: Tanggal Posting
    |----------------------------------------------------------------
    */
    if ($request->filled('tanggal_posting')) {
        switch ($request->tanggal_posting) {
            case '24_jam':
                $query->where('created_at', '>=', now()->subDay());
                break;
            case 'minggu_ini':
                $query->where('created_at', '>=', now()->subWeek());
                break;
            // 'kapan_saja' / default -> tanpa filter tambahan
        }
    }

    /*
    |----------------------------------------------------------------
    | FILTER: Status Lowongan
    |----------------------------------------------------------------
    */
    if ($request->filled('status') && $request->status !== 'Semua Status') {
        $statusValue = $request->status === 'Lowongan Buka' ? 'aktif' : 'nonaktif';
        $query->where('status_lowongan', $statusValue);
    }

    // PAGINATE: 9 lowongan per halaman, filter tetap terbawa di query string
    $lowongan = $query->latest()
        ->paginate(6)
        ->withQueryString();

    // Daftar kategori unik untuk opsi dropdown filter
    $kategoriList = LowonganPekerjaan::where('status_lowongan', 'aktif')
        ->whereNotNull('kategori_label')
        ->distinct()
        ->pluck('kategori_label');

    return view('lowonganpekerjaan', compact('lowongan', 'kategoriList'));
}

    /*
    |--------------------------------------------------------------------------
    | HALAMAN DETAIL LOWONGAN
    |--------------------------------------------------------------------------
    */
    public function detailLowonganPekerjaan($id)
    {
        $lowongan = LowonganPekerjaan::with([
            'perusahaan',
            'jurusan',
            'syaratKhusus',
            'syaratUmum',
            'komentar'
        ])->findOrFail($id);

        return view('detailLowonganPekerjaan', compact('lowongan'));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN ADMIN CRUD
    |--------------------------------------------------------------------------
    */
    public function adminIndex()
    {
        $lowongan = LowonganPekerjaan::with('perusahaan')
            ->latest()
            ->get();

        return view(
            'LowonganPekerjaan.indexLowonganPekerjaan',
            compact('lowongan')
        );
    }

    public function tambahLowonganPekerjaan()
    {
        $perusahaan = Perusahaan::all();

        return view(
            'LowonganPekerjaan.tambahLowonganPekerjaan',
            compact('perusahaan')
        );
    }

    public function editLowonganPekerjaan($id)
    {
        $lowongan = LowonganPekerjaan::with([
            'perusahaan',
            'jurusan',
            'syaratKhusus',
            'syaratUmum'
        ])->findOrFail($id);

        $perusahaan = Perusahaan::all();

        return view(
            'LowonganPekerjaan.editLowonganPekerjaan',
            compact('lowongan', 'perusahaan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | UPLOAD GAMBAR BANNER
        |--------------------------------------------------------------------------
        */
        $gambarBanner = null;

        if ($request->hasFile('gambar_banner')) {
            $file = $request->file('gambar_banner');

            $path = $file->store('banner', 'public');

            $gambarBanner = $path;
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN LOWONGAN
        |--------------------------------------------------------------------------
        */
        $lowongan = LowonganPekerjaan::create([
            'perusahaan_id' => $request->perusahaan_id,
            'judul_lowongan' => $request->judul_lowongan,
            'lokasi' => $request->lokasi,
            'kategori_label' => $request->kategori_label,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'deadline' => $request->deadline,
            'status_lowongan' => $request->status_lowongan,
            'jumlah_lowongan_dibuka' => $request->jumlah_lowongan_dibuka,
            'total_pendaftar' => $request->total_pendaftar ?? 0,
            'total_interview' => $request->total_interview ?? 0,
            'tanggal_deadline_label' => $request->tanggal_deadline_label,
            'gambar_banner' => $gambarBanner,
        ]);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN JURUSAN
        |--------------------------------------------------------------------------
        */
        if ($request->nama_jurusan) {
            $jurusanList = explode(',', $request->nama_jurusan[0]);

            foreach ($jurusanList as $item) {
                $lowongan->jurusan()->create([
                    'nama_jurusan' => trim($item)
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN SYARAT KHUSUS
        |--------------------------------------------------------------------------
        */
        if ($request->syarat_khusus) {
            $syaratKhususList = explode(',', $request->syarat_khusus[0]);

            foreach ($syaratKhususList as $item) {
                $lowongan->syaratKhusus()->create([
                    'syarat_khusus' => trim($item)
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN SYARAT UMUM
        |--------------------------------------------------------------------------
        */
        if ($request->syarat_umum) {
            $syaratUmumList = explode(',', $request->syarat_umum[0]);

            foreach ($syaratUmumList as $item) {
                $lowongan->syaratUmum()->create([
                    'syarat_umum' => trim($item)
                ]);
            }
        }

        return redirect()
            ->route('LowonganPekerjaan.indexLowonganPekerjaan')
            ->with('success', 'Lowongan berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $data = LowonganPekerjaan::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | UPLOAD GAMBAR (OPTIONAL)
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('gambar_banner')) {

            // optional: hapus gambar lama (kalau ada)
            if ($data->gambar_banner && file_exists(storage_path('app/public/' . $data->gambar_banner))) {
                unlink(storage_path('app/public/' . $data->gambar_banner));
            }

            $file = $request->file('gambar_banner');
            $namaFile = $file->store('banner', 'public');

            $data->gambar_banner = $namaFile;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA UTAMA
        |--------------------------------------------------------------------------
        */
        $data->update([
            'perusahaan_id' => $request->perusahaan_id,
            'judul_lowongan' => $request->judul_lowongan,
            'lokasi' => $request->lokasi,
            'kategori_label' => $request->kategori_label,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'deadline' => $request->deadline,
            'status_lowongan' => $request->status_lowongan,
            'jumlah_lowongan_dibuka' => $request->jumlah_lowongan_dibuka,
            'tanggal_deadline_label' => $request->tanggal_deadline_label,
            'gambar_banner' => $data->gambar_banner,
        ]);

        return redirect()
            ->route('LowonganPekerjaan.indexLowonganPekerjaan')
            ->with('success', 'Lowongan berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE DATA
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $data = LowonganPekerjaan::findOrFail($id);

        $data->delete();

        return redirect()
            ->back()
            ->with('success', 'Lowongan berhasil dihapus');
    }

    // Tambahkan use statement ini di paling atas LowonganPekerjaanController.php
// (kalau belum ada):
//
//   use App\Models\Lamaran;
//
// lalu tempel 2 method ini di dalam class LowonganPekerjaanController,
// dekat method adminIndex() / editLowonganPekerjaan() dkk.

/**
 * Tampilkan daftar pelamar untuk satu lowongan.
 */
public function pelamar(LowonganPekerjaan $lowongan)
{
    $daftarLamaran = $lowongan->lamaran()
        ->with(['user', 'document'])
        ->latest()
        ->get();

    $ringkasan = [
        'total' => $daftarLamaran->count(),
        'pending' => $daftarLamaran->where('status', 'pending')->count(),
        'interview' => $daftarLamaran->where('status', 'interview')->count(),
        'diterima' => $daftarLamaran->where('status', 'diterima')->count(),
        'ditolak' => $daftarLamaran->where('status', 'ditolak')->count(),
    ];

    return view('LowonganPekerjaan.indexPelamarAll', [
        'lowongan' => $lowongan,
        'daftarLamaran' => $daftarLamaran,
        'ringkasan' => $ringkasan,
    ]);
}

/**
 * Ubah status satu lamaran (pending / interview / diterima / ditolak).
 */
public function updateStatusPelamar(Request $request, Lamaran $lamaran)
{
    $request->validate([
        'status' => ['required', 'in:pending,interview,diterima,ditolak'],
    ]);

    $lamaran->update(['status' => $request->status]);

    return back()->with('success', 'Status pelamar berhasil diperbarui.');
}
}