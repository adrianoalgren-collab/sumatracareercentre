<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\LowonganPekerjaanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LamaranController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [AboutUsController::class, 'index'])
    ->name('about.us');

Route::get('/lowongan-pekerjaan', [LowonganPekerjaanController::class, 'index'])
    ->name('lowongan.pekerjaan');

/* DETAIL LOWONGAN */
Route::get('/detail-lowongan-pekerjaan/{id}', [LowonganPekerjaanController::class, 'detailLowonganPekerjaan'])
    ->name('detail.lowongan.pekerjaan');

/* ARTIKEL: LISTING */
Route::get('/artikel', [ArtikelController::class, 'index'])
    ->name('artikel');

/* ARTIKEL: DETAIL */
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])
    ->name('artikel.detail');


/*
|--------------------------------------------------------------------------
| GUEST AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [RegisterController::class, 'index'])
        ->name('register');

    /* PROSES SIMPAN REGISTRASI */
    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

});


/*
|--------------------------------------------------------------------------
| AUTH ONLY ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::post('/lowongan/{id}/komentar', [KomentarController::class, 'store'])
        ->name('komentar.store');

    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])
        ->name('komentar.delete');

    /*
    |----------------------------------------------------------------------
    | LAMARAN (USER)
    |----------------------------------------------------------------------
    */

    Route::post('/lowongan/{lowongan}/lamar', [LamaranController::class, 'store'])
        ->name('lamaran.store');

    /*
    |----------------------------------------------------------------------
    | PROFIL SAYA
    |----------------------------------------------------------------------
    */

    Route::get('/profil-saya', [ProfileController::class, 'index'])
        ->name('profil.saya');

    Route::get('/profil-saya/edit', [ProfileController::class, 'edit'])
        ->name('profil.edit');

    Route::match(['put', 'patch'], '/profil-saya', [ProfileController::class, 'update'])
        ->name('profil.update');

    Route::patch('/profil/foto', [ProfileController::class, 'updateFoto'])
        ->name('profil.foto.update');

    /* JADWAL INTERVIEW SAYA */
    Route::get('/profil-saya/interview', [ProfileController::class, 'jadwalInterview'])
        ->name('interview.jadwal');

    /* PENGUMUMAN HASIL INTERVIEW SAYA */
    Route::get('/profil-saya/pengumuman', [ProfileController::class, 'pengumumanInterview'])
        ->name('pengumuman.interview');

    /* DETAIL PENGUMUMAN HASIL INTERVIEW (redirect ke view diterima/ditolak) */
    Route::get('/profil-saya/pengumuman/{id}', [ProfileController::class, 'pengumumanDetail'])
        ->name('pengumuman.detail');

    Route::post('/profil/dokumen', [DocumentController::class, 'store'])
        ->name('dokumen.store');

    Route::delete('/profil/dokumen/{document}', [DocumentController::class, 'destroy'])
        ->name('dokumen.destroy');

    Route::post('/profil/skills', [ProfileController::class, 'addSkill'])
        ->name('skills.add');

    Route::delete('/profil/skills', [ProfileController::class, 'removeSkill'])
        ->name('skills.remove');

});


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    /* DASHBOARD */
    Route::get('/admin/dashboard', [LowonganPekerjaanController::class, 'adminIndex'])
        ->name('admin.dashboard');


    /*
    |----------------------------------------------------------------------
    | DATA LOWONGAN
    |----------------------------------------------------------------------
    */

    Route::get('/admin/lowongan-pekerjaan', [LowonganPekerjaanController::class, 'adminIndex'])
        ->name('LowonganPekerjaan.indexLowonganPekerjaan');

    /* HALAMAN TAMBAH */
    Route::get('/admin/lowongan/tambah', [LowonganPekerjaanController::class, 'tambahLowonganPekerjaan'])
        ->name('admin.lowongan.tambah');

    /* CREATE */
    Route::post('/admin/lowongan/store', [LowonganPekerjaanController::class, 'store'])
        ->name('admin.lowongan.store');

    /* EDIT */
    Route::get('/admin/lowongan/edit/{id}', [LowonganPekerjaanController::class, 'editLowonganPekerjaan'])
        ->name('LowonganPekerjaan.editLowonganPekerjaan');

    /* UPDATE */
    Route::put('/admin/lowongan/update/{id}', [LowonganPekerjaanController::class, 'update'])
        ->name('admin.lowongan.update');

    /* DELETE */
    Route::delete('/admin/lowongan/delete/{id}', [LowonganPekerjaanController::class, 'destroy'])
        ->name('admin.lowongan.delete');

    Route::patch('/admin/lowongan/{id}/toggle-status', [LowonganPekerjaanController::class, 'toggleStatus'])
        ->name('admin.lowongan.toggleStatus');

    /*
    |----------------------------------------------------------------------
    | DATA PERUSAHAAN
    |----------------------------------------------------------------------
    */

    Route::get('/admin/perusahaan', [PerusahaanController::class, 'index'])
        ->name('admin.perusahaan.index');

    /* HALAMAN TAMBAH */
    Route::get('/admin/perusahaan/tambah', [PerusahaanController::class, 'create'])
        ->name('admin.perusahaan.tambah');

    /* CREATE */
    Route::post('/admin/perusahaan/store', [PerusahaanController::class, 'store'])
        ->name('admin.perusahaan.store');

    /* DETAIL */
    Route::get('/admin/perusahaan/detail/{id}', [PerusahaanController::class, 'show'])
        ->name('admin.perusahaan.detail');

    /* EDIT */
    Route::get('/admin/perusahaan/edit/{id}', [PerusahaanController::class, 'edit'])
        ->name('admin.perusahaan.edit');

    /* UPDATE */
    Route::put('/admin/perusahaan/update/{id}', [PerusahaanController::class, 'update'])
        ->name('admin.perusahaan.update');

    /* DELETE */
    Route::delete('/admin/perusahaan/delete/{id}', [PerusahaanController::class, 'destroy'])
        ->name('admin.perusahaan.destroy');


    /*
    |----------------------------------------------------------------------
    | DATA PELAMAR
    |----------------------------------------------------------------------
    */

    Route::get('/admin/pelamar', [PelamarController::class, 'index'])
        ->name('admin.pelamar.index');

    /* HALAMAN TAMBAH */
    Route::get('/admin/pelamar/tambah', [PelamarController::class, 'create'])
        ->name('admin.pelamar.tambah');

    /* CREATE */
    Route::post('/admin/pelamar/store', [PelamarController::class, 'store'])
        ->name('admin.pelamar.store');

    /* DETAIL */
    Route::get('/admin/pelamar/detail/{id}', [PelamarController::class, 'show'])
        ->name('admin.pelamar.detail');

    /* EDIT */
    Route::get('/admin/pelamar/edit/{id}', [PelamarController::class, 'edit'])
        ->name('admin.pelamar.edit');

    /* UPDATE */
    Route::put('/admin/pelamar/update/{id}', [PelamarController::class, 'update'])
        ->name('admin.pelamar.update');

    /* DELETE */
    Route::delete('/admin/pelamar/delete/{id}', [PelamarController::class, 'destroy'])
        ->name('admin.pelamar.destroy');

    /* PELAMAR PER LOWONGAN */
    Route::get('/admin/lowongan/{lowongan}/pelamar', [LowonganPekerjaanController::class, 'pelamar'])
        ->name('admin.lowongan.pelamar');

    /*
    |----------------------------------------------------------------------
    | LAMARAN (ADMIN)
    |----------------------------------------------------------------------
    */

    Route::patch('/admin/lamaran/bulk-status', [LamaranController::class, 'bulkUpdateStatus'])
        ->name('admin.lamaran.bulkStatus');

    Route::delete('/admin/lamaran/{lamaran}', [LamaranController::class, 'destroy'])
        ->name('admin.lamaran.destroy');

    Route::patch('/admin/lowongan/{lowongan}/jadwal-interview', [LamaranController::class, 'setJadwalInterview'])
        ->name('admin.lamaran.setJadwalInterview');

    /*
    |----------------------------------------------------------------------
    | DATA ARTIKEL
    |----------------------------------------------------------------------
    */

    Route::get('/admin/artikel', [ArtikelController::class, 'adminIndex'])
        ->name('admin.artikel.index');

    /* HALAMAN TAMBAH */
    Route::get('/admin/artikel/tambah', [ArtikelController::class, 'create'])
        ->name('admin.artikel.tambah');

    /* CREATE */
    Route::post('/admin/artikel/store', [ArtikelController::class, 'store'])
        ->name('admin.artikel.store');

    /* DETAIL */
    Route::get('/admin/artikel/detail/{id}', [ArtikelController::class, 'showAdmin'])
        ->name('admin.artikel.detail');

    /* EDIT */
    Route::get('/admin/artikel/edit/{id}', [ArtikelController::class, 'edit'])
        ->name('admin.artikel.edit');

    /* UPDATE */
    Route::put('/admin/artikel/update/{id}', [ArtikelController::class, 'update'])
        ->name('admin.artikel.update');

    /* DELETE */
    Route::delete('/admin/artikel/delete/{id}', [ArtikelController::class, 'destroy'])
        ->name('admin.artikel.delete');

});