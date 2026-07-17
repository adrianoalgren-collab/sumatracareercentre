<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN LISTING ARTIKEL (PUBLIK)
    |--------------------------------------------------------------------------
    */
   public function index(Request $request)
{
    $query = Artikel::where('status', 'published');

    if ($request->filled('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    // Artikel unggulan = artikel terbaru
    $featured = (clone $query)->latest()->first();

    // 2 artikel untuk kartu kecil di samping featured (selain featured)
    $sideArticles = (clone $query)
        ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
        ->latest()
        ->take(2)
        ->get();

    // Grid "Artikel Terbaru" (paginated, selain featured)
    $artikel = $query
        ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
        ->latest()
        ->paginate(6)
        ->withQueryString();

    return view('artikel', compact('featured', 'sideArticles', 'artikel'));
}

    /*
    |--------------------------------------------------------------------------
    | HALAMAN DETAIL ARTIKEL (PUBLIK)
    |--------------------------------------------------------------------------
    */
    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $related = Artikel::where('status', 'published')
            ->where('id', '!=', $artikel->id)
            ->latest()
            ->take(3)
            ->get();

        return view('Artikel.indexDetailArtikel', compact('artikel', 'related'));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN ADMIN — LIST ARTIKEL
    |--------------------------------------------------------------------------
    */
    public function adminIndex(Request $request)
    {
        $artikel = Artikel::latest()
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%');
            })
            ->paginate(10)
            ->withQueryString();

        return view('Artikel.indexArtikel', compact('artikel'));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN TAMBAH ARTIKEL
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('Artikel.tambahArtikel');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN ARTIKEL BARU
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'konten' => ['required', 'string'],
            'waktu_baca_menit' => ['nullable', 'integer', 'min:1'],
            'tags' => ['nullable', 'string'],
            'penulis_nama' => ['nullable', 'string', 'max:255'],
            'penulis_jabatan' => ['nullable', 'string', 'max:255'],
            'penulis_bio' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'gambar_utama' => ['nullable', 'image', 'max:2048'],
            'penulis_foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $gambarUtamaPath = $request->hasFile('gambar_utama')
            ? $request->file('gambar_utama')->store('artikel', 'public')
            : null;

        $penulisFotoPath = $request->hasFile('penulis_foto')
            ? $request->file('penulis_foto')->store('artikel/penulis', 'public')
            : null;

        Artikel::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . uniqid(),
            'kategori' => $request->kategori,
            'ringkasan' => $request->ringkasan,
            'konten' => $request->konten,
            'gambar_utama' => $gambarUtamaPath,
            'waktu_baca_menit' => $request->waktu_baca_menit ?? 5,
            'tags' => $request->tags,
            'penulis_nama' => $request->penulis_nama,
            'penulis_jabatan' => $request->penulis_jabatan,
            'penulis_foto' => $penulisFotoPath,
            'penulis_bio' => $request->penulis_bio,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL ARTIKEL (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function showAdmin($id)
    {
        $artikel = Artikel::findOrFail($id);

        return view('Artikel.detailArtikel', compact('artikel'));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN EDIT ARTIKEL
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);

        return view('Artikel.editArtikel', compact('artikel'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE ARTIKEL
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'konten' => ['required', 'string'],
            'waktu_baca_menit' => ['nullable', 'integer', 'min:1'],
            'tags' => ['nullable', 'string'],
            'penulis_nama' => ['nullable', 'string', 'max:255'],
            'penulis_jabatan' => ['nullable', 'string', 'max:255'],
            'penulis_bio' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'gambar_utama' => ['nullable', 'image', 'max:2048'],
            'penulis_foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $gambarUtamaPath = $artikel->gambar_utama;
        $penulisFotoPath = $artikel->penulis_foto;

        if ($request->hasFile('gambar_utama')) {
            if ($artikel->gambar_utama && file_exists(storage_path('app/public/' . $artikel->gambar_utama))) {
                unlink(storage_path('app/public/' . $artikel->gambar_utama));
            }
            $gambarUtamaPath = $request->file('gambar_utama')->store('artikel', 'public');
        }

        if ($request->hasFile('penulis_foto')) {
            if ($artikel->penulis_foto && file_exists(storage_path('app/public/' . $artikel->penulis_foto))) {
                unlink(storage_path('app/public/' . $artikel->penulis_foto));
            }
            $penulisFotoPath = $request->file('penulis_foto')->store('artikel/penulis', 'public');
        }

        $artikel->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'ringkasan' => $request->ringkasan,
            'konten' => $request->konten,
            'gambar_utama' => $gambarUtamaPath,
            'waktu_baca_menit' => $request->waktu_baca_menit ?? $artikel->waktu_baca_menit,
            'tags' => $request->tags,
            'penulis_nama' => $request->penulis_nama,
            'penulis_jabatan' => $request->penulis_jabatan,
            'penulis_foto' => $penulisFotoPath,
            'penulis_bio' => $request->penulis_bio,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS ARTIKEL
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar_utama && file_exists(storage_path('app/public/' . $artikel->gambar_utama))) {
            unlink(storage_path('app/public/' . $artikel->gambar_utama));
        }

        if ($artikel->penulis_foto && file_exists(storage_path('app/public/' . $artikel->penulis_foto))) {
            unlink(storage_path('app/public/' . $artikel->penulis_foto));
        }

        $artikel->delete();

        return redirect()
            ->back()
            ->with('success', 'Artikel berhasil dihapus');
    }
}