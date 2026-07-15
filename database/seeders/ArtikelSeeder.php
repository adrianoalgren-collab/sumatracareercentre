<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $artikelData = [
            [
                'judul' => '5 Tips Wawancara Kerja untuk Fresh Graduate',
                'kategori' => 'Tips Karier',
                'ringkasan' => 'Persiapan yang tepat bisa mengubah wawancara kerja jadi kesempatan menunjukkan potensi terbaikmu.',
                'konten' => '<p>Wawancara kerja adalah salah satu tahap yang paling menegangkan dalam proses melamar pekerjaan, apalagi buat kamu yang baru lulus. Padahal, dengan persiapan yang tepat, wawancara bisa jadi kesempatan buat menunjukkan potensi terbaikmu.</p>
<h2>1. Riset Perusahaan Sebelum Datang</h2>
<p>Luangkan waktu untuk memahami bidang usaha, produk, dan nilai-nilai perusahaan. Pewawancara akan sangat menghargai kandidat yang datang dengan pemahaman dasar tentang tempat mereka melamar.</p>
<h2>2. Siapkan Contoh Konkret</h2>
<p>Saat ditanya soal pengalaman, gunakan contoh nyata dari organisasi kampus, magang, atau proyek kuliah. Pewawancara lebih tertarik pada cerita spesifik dibanding jawaban umum.</p>
<ul>
<li>Ceritakan situasi, tindakan, dan hasil secara singkat</li>
<li>Fokus pada kontribusi yang benar-benar kamu lakukan</li>
<li>Hindari jawaban yang terlalu panjang dan bertele-tele</li>
</ul>
<blockquote>"Kandidat yang paling diingat bukan yang paling pintar bicara, tapi yang paling jujur menceritakan prosesnya."</blockquote>
<h2>3. Latihan Menjawab Pertanyaan Umum</h2>
<p>Latih jawaban untuk pertanyaan seperti "Ceritakan tentang dirimu" atau "Apa kelemahanmu?" agar kamu tidak gugup saat ditanya langsung.</p>',
                'waktu_baca_menit' => 6,
                'tags' => 'Wawancara, Fresh Graduate, Tips Karier',
                'penulis_nama' => 'Rani Anggraini',
                'penulis_jabatan' => 'Career Coach',
                'penulis_bio' => 'Career coach dengan 8 tahun pengalaman mendampingi fresh graduate di Sumatera mencari pekerjaan pertama mereka.',
                'status' => 'published',
            ],
            [
                'judul' => 'Cara Menulis CV yang Dilirik HRD',
                'kategori' => 'Tips Karier',
                'ringkasan' => 'CV yang baik bukan soal panjang, tapi soal relevansi dan cara menyampaikan pencapaianmu.',
                'konten' => '<p>Rata-rata HRD hanya menghabiskan waktu kurang dari satu menit untuk membaca satu CV. Karena itu, penting untuk membuat CV yang langsung menarik perhatian sejak baris pertama.</p>
<h2>1. Gunakan Format yang Rapi dan Konsisten</h2>
<p>Hindari desain yang terlalu ramai. Gunakan font yang mudah dibaca dan struktur yang konsisten dari atas ke bawah.</p>
<h2>2. Tulis Pencapaian, Bukan Sekadar Tugas</h2>
<p>Daripada menuliskan "Bertanggung jawab atas media sosial", coba tulis "Meningkatkan engagement Instagram sebesar 40% dalam 3 bulan".</p>
<ul>
<li>Gunakan angka atau data pendukung jika memungkinkan</li>
<li>Sesuaikan CV dengan posisi yang dilamar</li>
<li>Sertakan link portofolio jika relevan</li>
</ul>
<h2>3. Periksa Kembali Sebelum Mengirim</h2>
<p>Kesalahan penulisan kecil bisa memberi kesan kurang teliti. Selalu baca ulang atau minta orang lain memeriksanya.</p>',
                'waktu_baca_menit' => 5,
                'tags' => 'CV, Lamaran Kerja, Tips Karier',
                'penulis_nama' => 'Dimas Prasetyo',
                'penulis_jabatan' => 'HR Consultant',
                'penulis_bio' => 'Konsultan HR yang sudah membantu ratusan perusahaan menyaring kandidat terbaik selama lebih dari 6 tahun.',
                'status' => 'published',
            ],
            [
                'judul' => 'Membangun Portofolio yang Menarik Rekruter',
                'kategori' => 'Tips Karier',
                'ringkasan' => 'Portofolio yang kuat bisa jadi pembeda utama di antara ratusan pelamar dengan kualifikasi serupa.',
                'konten' => '<p>Bagi banyak profesi kreatif dan teknis, portofolio sering kali lebih menentukan dibanding CV itu sendiri. Berikut cara membangun portofolio yang benar-benar menonjolkan kemampuanmu.</p>
<h2>1. Pilih Proyek Terbaik, Bukan Semua Proyek</h2>
<p>Tampilkan 3-5 proyek terbaik yang paling relevan dengan posisi yang kamu tuju, daripada menumpuk semua pekerjaan yang pernah dibuat.</p>
<h2>2. Jelaskan Proses, Bukan Hanya Hasil</h2>
<p>Rekruter ingin tahu bagaimana kamu berpikir dan menyelesaikan masalah, bukan cuma melihat hasil akhirnya saja.</p>
<ul>
<li>Sertakan latar belakang masalah yang dipecahkan</li>
<li>Jelaskan peran spesifikmu dalam proyek tim</li>
<li>Tambahkan hasil atau dampak dari pekerjaanmu</li>
</ul>
<h2>3. Buat Portofolio Mudah Diakses</h2>
<p>Gunakan platform online seperti website pribadi atau Behance agar rekruter bisa mengaksesnya kapan saja tanpa hambatan.</p>',
                'waktu_baca_menit' => 4,
                'tags' => 'Portofolio, Rekruter, Tips Karier',
                'penulis_nama' => 'Sarah Wulandari',
                'penulis_jabatan' => 'Talent Acquisition Lead',
                'penulis_bio' => 'Berpengalaman memimpin proses rekrutmen di berbagai startup teknologi di Sumatera dan Jawa.',
                'status' => 'published',
            ],
            [
                'judul' => 'Tren Industri Kreatif di Sumatera Tahun 2026',
                'kategori' => 'Tren Industri',
                'ringkasan' => 'Industri kreatif di Sumatera menunjukkan pertumbuhan pesat, dari desain digital hingga konten kreator lokal.',
                'konten' => '<p>Sepanjang tahun 2026, industri kreatif di wilayah Sumatera mengalami pertumbuhan yang signifikan, didorong oleh meningkatnya permintaan konten digital dan produk lokal yang mendunia.</p>
<h2>1. Meningkatnya Permintaan Desainer Digital</h2>
<p>Banyak UMKM dan perusahaan menengah mulai berinvestasi pada branding visual, membuka peluang besar bagi desainer grafis dan UI/UX di kota-kota seperti Medan, Pekanbaru, dan Palembang.</p>
<h2>2. Konten Kreator Lokal Semakin Diminati</h2>
<p>Brand lokal kini lebih memilih bekerja sama dengan konten kreator daerah karena dianggap lebih relevan dan dekat dengan audiens setempat.</p>
<ul>
<li>Kolaborasi brand dan kreator lokal meningkat</li>
<li>Konten berbasis budaya daerah semakin populer</li>
<li>Platform video pendek jadi kanal utama promosi</li>
</ul>
<h2>3. Peluang Karier yang Terbuka Lebar</h2>
<p>Perusahaan kini mencari talenta dengan kombinasi kemampuan kreatif dan pemahaman digital marketing, membuka peluang karier baru bagi lulusan desain maupun komunikasi.</p>',
                'waktu_baca_menit' => 5,
                'tags' => 'Industri Kreatif, Tren 2026, Sumatera',
                'penulis_nama' => 'Fajar Nugraha',
                'penulis_jabatan' => 'Industry Analyst',
                'penulis_bio' => 'Menganalisis tren pasar kerja dan industri kreatif di kawasan Sumatera untuk berbagai publikasi bisnis.',
                'status' => 'published',
            ],
            [
                'judul' => 'Strategi Negosiasi Gaji untuk Kandidat Baru',
                'kategori' => 'Tips Karier',
                'ringkasan' => 'Negosiasi gaji bukan hal yang perlu dihindari — dengan strategi yang tepat, kamu bisa mendapatkan penawaran yang lebih adil.',
                'konten' => '<p>Banyak kandidat baru merasa canggung membahas gaji saat wawancara, padahal negosiasi yang baik justru menunjukkan profesionalisme dan kepercayaan diri.</p>
<h2>1. Riset Standar Gaji di Industri Tersebut</h2>
<p>Sebelum wawancara, cari tahu kisaran gaji untuk posisi serupa di kota dan industri yang sama, agar kamu punya acuan yang realistis.</p>
<h2>2. Jangan Terburu-buru Menyebutkan Angka</h2>
<p>Jika memungkinkan, biarkan pihak perusahaan menyebutkan angka penawaran terlebih dahulu sebelum kamu memberikan tanggapan.</p>
<ul>
<li>Sampaikan ekspektasi dalam bentuk rentang, bukan angka pasti</li>
<li>Fokus pada value yang bisa kamu berikan, bukan hanya kebutuhan pribadi</li>
<li>Tetap sopan dan profesional meski negosiasi alot</li>
</ul>
<h2>3. Pertimbangkan Benefit di Luar Gaji Pokok</h2>
<p>Tunjangan kesehatan, fleksibilitas kerja, dan peluang pengembangan karier juga merupakan bagian penting dari keseluruhan paket kompensasi.</p>',
                'waktu_baca_menit' => 6,
                'tags' => 'Negosiasi Gaji, Karier, Tips Interview',
                'penulis_nama' => 'Rani Anggraini',
                'penulis_jabatan' => 'Career Coach',
                'penulis_bio' => 'Career coach dengan 8 tahun pengalaman mendampingi fresh graduate di Sumatera mencari pekerjaan pertama mereka.',
                'status' => 'published',
            ],
        ];

        foreach ($artikelData as $data) {
            Artikel::create([
                'user_id' => null,
                'judul' => $data['judul'],
                'slug' => Str::slug($data['judul']) . '-' . uniqid(),
                'kategori' => $data['kategori'],
                'ringkasan' => $data['ringkasan'],
                'konten' => $data['konten'],
                'gambar_utama' => null,
                'waktu_baca_menit' => $data['waktu_baca_menit'],
                'tags' => $data['tags'],
                'penulis_nama' => $data['penulis_nama'],
                'penulis_jabatan' => $data['penulis_jabatan'],
                'penulis_foto' => null,
                'penulis_bio' => $data['penulis_bio'],
                'status' => $data['status'],
            ]);
        }

        $this->command->info('ArtikelSeeder berhasil dijalankan.');
    }
}