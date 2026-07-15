<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perusahaan;
use App\Models\LowonganPekerjaan;
use App\Models\Jurusan;
use App\Models\SyaratKhusus;
use App\Models\SyaratUmum;
use App\Models\Komentar;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil perusahaan yang sudah dibuat dari PerusahaanSeeder
        $perusahaan = Perusahaan::where(
            'nama_perusahaan',
            'Andalas Tech Solutions'
        )->first();

        $lowongan = LowonganPekerjaan::create([
            'perusahaan_id' => $perusahaan->id,
            'judul_lowongan' => 'Senior Software Engineer',
            'lokasi' => 'Medan',
            'kategori_label' => 'Featured Opening',
            'deskripsi_pekerjaan' => 'Kami mencari Senior Software Engineer berpengalaman untuk memimpin pengembangan aplikasi enterprise, membangun arsitektur modern, meningkatkan performa sistem, serta membimbing developer junior.',
            'deadline' => '2026-12-24',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 2,
            'total_pendaftar' => 45,
            'total_interview' => 12,
            'tanggal_deadline_label' => '24 Dec',
            'gambar_banner' => 'company1.jpg'
        ]);

        /* Jurusan */
        Jurusan::create([
            'lowongan_id' => $lowongan->id,
            'nama_jurusan' => 'Teknik Informatika'
        ]);

        Jurusan::create([
            'lowongan_id' => $lowongan->id,
            'nama_jurusan' => 'Sistem Informasi'
        ]);

        Jurusan::create([
            'lowongan_id' => $lowongan->id,
            'nama_jurusan' => 'Teknik Komputer'
        ]);

        /* Syarat Khusus */
        SyaratKhusus::create([
            'lowongan_id' => $lowongan->id,
            'syarat_khusus' => 'Node.js, React, PostgreSQL'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan->id,
            'syarat_khusus' => 'Docker & Microservices'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan->id,
            'syarat_khusus' => 'AWS / GCP'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan->id,
            'syarat_khusus' => 'CI/CD Pipeline'
        ]);

        /* Syarat Umum */
        SyaratUmum::create([
            'lowongan_id' => $lowongan->id,
            'syarat_umum' => 'Maksimal 35 tahun'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan->id,
            'syarat_umum' => 'Lulusan universitas terakreditasi'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan->id,
            'syarat_umum' => 'Mampu bekerja dalam tim'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan->id,
            'syarat_umum' => 'Komunikatif dan analitis'
        ]);

        /* Komentar */
        Komentar::create([
            'lowongan_id' => $lowongan->id,
            'user_id' => null,
            'nama_user' => 'Budi Santoso',
            'isi_komentar' => 'Apakah posisi ini bisa remote?'
        ]);

        Komentar::create([
            'lowongan_id' => $lowongan->id,
            'user_id' => null,
            'nama_user' => 'Siti Aminah',
            'isi_komentar' => 'Apakah tes teknis berupa live coding?'
        ]);


        /* ============================================================
         | LOWONGAN 2: Staff Administrasi
         ============================================================ */

        $lowongan2 = LowonganPekerjaan::create([
            'perusahaan_id' => $perusahaan->id,
            'judul_lowongan' => 'Staff Administrasi',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Full Time',
            'deskripsi_pekerjaan' => 'Bertanggung jawab mengelola dokumen, input data, serta mendukung kegiatan operasional kantor sehari-hari.',
            'deadline' => '2026-08-15',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 3,
            'total_pendaftar' => 28,
            'total_interview' => 6,
            'tanggal_deadline_label' => '15 Aug',
            'gambar_banner' => 'company2.jpg'
        ]);

        Jurusan::create([
            'lowongan_id' => $lowongan2->id,
            'nama_jurusan' => 'Administrasi Bisnis'
        ]);

        Jurusan::create([
            'lowongan_id' => $lowongan2->id,
            'nama_jurusan' => 'Manajemen'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan2->id,
            'syarat_khusus' => 'Microsoft Office (Word, Excel)'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan2->id,
            'syarat_khusus' => 'Kearsipan Digital'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan2->id,
            'syarat_umum' => 'Maksimal 30 tahun'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan2->id,
            'syarat_umum' => 'Teliti dan disiplin'
        ]);

        Komentar::create([
            'lowongan_id' => $lowongan2->id,
            'user_id' => null,
            'nama_user' => 'Rani Puspita',
            'isi_komentar' => 'Apakah ada jenjang karir untuk posisi ini?'
        ]);


        /* ============================================================
         | LOWONGAN 3: Digital Marketing Specialist
         ============================================================ */

        $lowongan3 = LowonganPekerjaan::create([
            'perusahaan_id' => $perusahaan->id,
            'judul_lowongan' => 'Digital Marketing Specialist',
            'lokasi' => 'Padang',
            'kategori_label' => 'Urgently Hiring',
            'deskripsi_pekerjaan' => 'Merancang dan menjalankan strategi pemasaran digital, mengelola konten media sosial, serta menganalisis performa kampanye iklan.',
            'deadline' => '2026-09-30',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 1,
            'total_pendaftar' => 37,
            'total_interview' => 9,
            'tanggal_deadline_label' => '30 Sep',
            'gambar_banner' => 'company3.jpg'
        ]);

        Jurusan::create([
            'lowongan_id' => $lowongan3->id,
            'nama_jurusan' => 'Ilmu Komunikasi'
        ]);

        Jurusan::create([
            'lowongan_id' => $lowongan3->id,
            'nama_jurusan' => 'Manajemen Pemasaran'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan3->id,
            'syarat_khusus' => 'SEO & SEM'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan3->id,
            'syarat_khusus' => 'Meta Ads & Google Ads'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan3->id,
            'syarat_khusus' => 'Content Planning'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan3->id,
            'syarat_umum' => 'Maksimal 28 tahun'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan3->id,
            'syarat_umum' => 'Kreatif dan aktif di media sosial'
        ]);

        Komentar::create([
            'lowongan_id' => $lowongan3->id,
            'user_id' => null,
            'nama_user' => 'Dewi Lestari',
            'isi_komentar' => 'Butuh portofolio untuk melamar posisi ini?'
        ]);


        /* ============================================================
         | LOWONGAN 4: Finance Officer (Non-Aktif)
         ============================================================ */

        $lowongan4 = LowonganPekerjaan::create([
            'perusahaan_id' => $perusahaan->id,
            'judul_lowongan' => 'Finance Officer',
            'lokasi' => 'Medan',
            'kategori_label' => 'Full Time',
            'deskripsi_pekerjaan' => 'Mengelola pencatatan transaksi keuangan, menyusun laporan bulanan, serta memastikan kepatuhan terhadap prosedur keuangan perusahaan.',
            'deadline' => '2026-06-10',
            'status_lowongan' => 'nonaktif',
            'jumlah_lowongan_dibuka' => 1,
            'total_pendaftar' => 19,
            'total_interview' => 4,
            'tanggal_deadline_label' => '10 Jun',
            'gambar_banner' => 'company4.jpg'
        ]);

        Jurusan::create([
            'lowongan_id' => $lowongan4->id,
            'nama_jurusan' => 'Akuntansi'
        ]);

        Jurusan::create([
            'lowongan_id' => $lowongan4->id,
            'nama_jurusan' => 'Manajemen Keuangan'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan4->id,
            'syarat_khusus' => 'Microsoft Excel (Advanced)'
        ]);

        SyaratKhusus::create([
            'lowongan_id' => $lowongan4->id,
            'syarat_khusus' => 'Penyusunan Laporan Keuangan'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan4->id,
            'syarat_umum' => 'Maksimal 32 tahun'
        ]);

        SyaratUmum::create([
            'lowongan_id' => $lowongan4->id,
            'syarat_umum' => 'Jujur dan teliti'
        ]);
    }
}