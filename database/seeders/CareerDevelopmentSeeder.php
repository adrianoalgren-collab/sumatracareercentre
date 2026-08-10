<?php

namespace Database\Seeders;

use App\Models\CareerClass;
use App\Models\CareerLesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class CareerDevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil admin yang sudah ada, atau buat 1 kalau belum ada sama sekali
        // (supaya seeder ini tetap bisa jalan sendiri di environment baru).
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin SCC',
                'email' => 'admin@scc.test',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        $classes = [
            [
                'judul' => 'Persiapan Wawancara Kerja',
                'deskripsi' => 'Pelajari cara menjawab pertanyaan interview, bahasa tubuh, dan strategi menghadapi HRD maupun user.',
                'lessons' => [
                    ['judul' => 'Mengenal Jenis-Jenis Interview', 'tipe_konten' => 'artikel', 'durasi_menit' => 10],
                    ['judul' => 'Menjawab Pertanyaan "Ceritakan Tentang Diri Anda"', 'tipe_konten' => 'video', 'durasi_menit' => 15],
                    ['judul' => 'Bahasa Tubuh Saat Interview', 'tipe_konten' => 'video', 'durasi_menit' => 12],
                    ['judul' => 'Simulasi Interview: Studi Kasus', 'tipe_konten' => 'dokumen', 'durasi_menit' => 20],
                ],
            ],
            [
                'judul' => 'Membuat CV & Portofolio yang Menarik',
                'deskripsi' => 'Susun CV ATS-friendly dan portofolio yang mudah dilirik rekruter perusahaan.',
                'lessons' => [
                    ['judul' => 'Struktur CV yang Baik', 'tipe_konten' => 'artikel', 'durasi_menit' => 8],
                    ['judul' => 'Menulis Ringkasan Profil yang Kuat', 'tipe_konten' => 'artikel', 'durasi_menit' => 10],
                    ['judul' => 'Membangun Portofolio Online', 'tipe_konten' => 'video', 'durasi_menit' => 18],
                ],
            ],
            [
                'judul' => 'Dasar Komunikasi Profesional',
                'deskripsi' => 'Tingkatkan cara berkomunikasi di email, rapat, dan lingkungan kerja profesional.',
                'lessons' => [
                    ['judul' => 'Etika Menulis Email Profesional', 'tipe_konten' => 'artikel', 'durasi_menit' => 9],
                    ['judul' => 'Public Speaking Dasar', 'tipe_konten' => 'video', 'durasi_menit' => 14],
                    ['judul' => 'Komunikasi Efektif dalam Tim', 'tipe_konten' => 'video', 'durasi_menit' => 16],
                    ['judul' => 'Studi Kasus: Menyampaikan Ide di Rapat', 'tipe_konten' => 'dokumen', 'durasi_menit' => 11],
                ],
            ],
            [
                'judul' => 'Pengantar Quality Assurance & Software Testing',
                'deskripsi' => 'Pahami dasar-dasar QA, jenis pengujian, dan tools yang umum digunakan di industri software.',
                'lessons' => [
                    ['judul' => 'Apa Itu Quality Assurance?', 'tipe_konten' => 'artikel', 'durasi_menit' => 10],
                    ['judul' => 'Functional vs Non-Functional Testing', 'tipe_konten' => 'artikel', 'durasi_menit' => 12],
                    ['judul' => 'Mengenal Black Box, White Box, dan Gray Box Testing', 'tipe_konten' => 'video', 'durasi_menit' => 15],
                    ['judul' => 'Menulis Test Case Sederhana', 'tipe_konten' => 'dokumen', 'durasi_menit' => 18],
                    ['judul' => 'Pengenalan Tools: Postman & Jira', 'tipe_konten' => 'video', 'durasi_menit' => 14],
                ],
            ],
            [
                'judul' => 'Fundamental SQL untuk Pemula',
                'deskripsi' => 'Belajar dasar query database menggunakan SQL, dari SELECT sederhana hingga JOIN antar tabel.',
                'lessons' => [
                    ['judul' => 'Mengenal Konsep Database Relasional', 'tipe_konten' => 'artikel', 'durasi_menit' => 9],
                    ['judul' => 'Perintah Dasar SELECT, WHERE, ORDER BY', 'tipe_konten' => 'video', 'durasi_menit' => 16],
                    ['judul' => 'Menggunakan JOIN Antar Tabel', 'tipe_konten' => 'video', 'durasi_menit' => 20],
                    ['judul' => 'Latihan Query: Studi Kasus Data Karyawan', 'tipe_konten' => 'dokumen', 'durasi_menit' => 15],
                ],
            ],
            [
                'judul' => 'Pengenalan Agile & Scrum',
                'deskripsi' => 'Pelajari metodologi Agile dan Scrum yang banyak digunakan dalam pengembangan software modern.',
                'lessons' => [
                    ['judul' => 'Apa Itu Agile Development?', 'tipe_konten' => 'artikel', 'durasi_menit' => 8],
                    ['judul' => 'Peran dalam Tim Scrum: Product Owner, Scrum Master, Dev Team', 'tipe_konten' => 'video', 'durasi_menit' => 13],
                    ['judul' => 'Memahami Sprint Planning dan Retrospective', 'tipe_konten' => 'video', 'durasi_menit' => 15],
                    ['judul' => 'Studi Kasus: Menjalankan Sprint Pertama', 'tipe_konten' => 'dokumen', 'durasi_menit' => 17],
                ],
            ],
            [
                'judul' => 'Strategi Melamar Kerja & Magang',
                'deskripsi' => 'Panduan praktis mencari lowongan yang tepat, menyusun lamaran, dan mengelola proses seleksi.',
                'lessons' => [
                    ['judul' => 'Menentukan Posisi yang Sesuai dengan Minat', 'tipe_konten' => 'artikel', 'durasi_menit' => 7],
                    ['judul' => 'Menulis Surat Lamaran yang Efektif', 'tipe_konten' => 'artikel', 'durasi_menit' => 9],
                    ['judul' => 'Mengelola Banyak Lamaran Sekaligus', 'tipe_konten' => 'video', 'durasi_menit' => 11],
                    ['judul' => 'Tips Follow-Up Setelah Interview', 'tipe_konten' => 'dokumen', 'durasi_menit' => 8],
                ],
            ],
            [
                'judul' => 'Dasar Pengembangan Web (Frontend & Backend)',
                'deskripsi' => 'Kenali alur kerja pengembangan web modern, dari frontend interaktif hingga backend dan database.',
                'lessons' => [
                    ['judul' => 'Alur Kerja Fullstack Development', 'tipe_konten' => 'artikel', 'durasi_menit' => 10],
                    ['judul' => 'Pengantar HTML, CSS, dan JavaScript', 'tipe_konten' => 'video', 'durasi_menit' => 20],
                    ['judul' => 'Mengenal Framework Laravel', 'tipe_konten' => 'video', 'durasi_menit' => 18],
                    ['judul' => 'Menghubungkan Frontend dengan API Backend', 'tipe_konten' => 'dokumen', 'durasi_menit' => 16],
                ],
            ],
            [
                'judul' => 'Manajemen Waktu & Produktivitas Kerja',
                'deskripsi' => 'Tingkatkan produktivitas dengan teknik manajemen waktu yang bisa langsung diterapkan di dunia kerja.',
                'lessons' => [
                    ['judul' => 'Mengenal Teknik Pomodoro', 'tipe_konten' => 'artikel', 'durasi_menit' => 6],
                    ['judul' => 'Membuat Prioritas dengan Matriks Eisenhower', 'tipe_konten' => 'artikel', 'durasi_menit' => 9],
                    ['judul' => 'Menghindari Distraksi Saat Bekerja', 'tipe_konten' => 'video', 'durasi_menit' => 12],
                    ['judul' => 'Studi Kasus: Menyusun Jadwal Kerja Mingguan', 'tipe_konten' => 'dokumen', 'durasi_menit' => 10],
                ],
            ],
            [
                'judul' => 'Mengenal Industri Fintech untuk Pemula',
                'deskripsi' => 'Pelajari ekosistem financial technology, mulai dari pembayaran digital hingga peluang karier di dalamnya.',
                'lessons' => [
                    ['judul' => 'Apa Itu Financial Technology (Fintech)?', 'tipe_konten' => 'artikel', 'durasi_menit' => 8],
                    ['judul' => 'Jenis-Jenis Layanan Fintech: Payment, Lending, Insurtech', 'tipe_konten' => 'artikel', 'durasi_menit' => 11],
                    ['judul' => 'Bagaimana Sistem Pembayaran Digital Bekerja', 'tipe_konten' => 'video', 'durasi_menit' => 15],
                    ['judul' => 'Peluang Karier di Perusahaan Fintech', 'tipe_konten' => 'dokumen', 'durasi_menit' => 13],
                ],
            ],
        ];

        foreach ($classes as $classData) {
            $kelas = CareerClass::create([
                'judul' => $classData['judul'],
                'deskripsi' => $classData['deskripsi'],
                'status' => 'published',
                'dibuat_oleh' => $admin->id,
            ]);

            foreach ($classData['lessons'] as $index => $lessonData) {
                CareerLesson::create([
                    'class_id' => $kelas->id,
                    'judul' => $lessonData['judul'],
                    'tipe_konten' => $lessonData['tipe_konten'],
                    'konten' => 'Konten contoh untuk lesson "' . $lessonData['judul'] . '".',
                    'urutan' => $index + 1,
                    'durasi_menit' => $lessonData['durasi_menit'],
                ]);
            }
        }

        $this->command->info('Berhasil membuat ' . count($classes) . ' kelas Career Development beserta lesson-nya.');
    }
}