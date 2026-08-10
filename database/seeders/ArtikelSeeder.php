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
            [
                'judul' => 'Mengenal Karier di Bidang Quality Assurance (QA)',
                'kategori' => 'Tren Industri',
                'ringkasan' => 'QA bukan sekadar mencari bug — profesi ini punya peran strategis dalam memastikan kualitas produk digital.',
                'konten' => '<p>Seiring berkembangnya industri teknologi dan fintech, kebutuhan akan tenaga Quality Assurance (QA) semakin meningkat. Banyak lulusan IT belum menyadari bahwa QA adalah jalur karier yang menjanjikan dan strategis.</p>
<h2>1. Apa Itu Quality Assurance?</h2>
<p>QA bertanggung jawab memastikan sebuah aplikasi atau sistem berjalan sesuai spesifikasi sebelum dirilis ke pengguna, mencakup pengujian fungsional, performa, hingga keamanan.</p>
<h2>2. Skill Dasar yang Perlu Dikuasai</h2>
<p>Seorang QA umumnya perlu memahami dasar pemrograman, SQL untuk validasi data, serta tools pengujian seperti Postman dan Selenium.</p>
<ul>
<li>Kemampuan menulis test case yang terstruktur</li>
<li>Pemahaman dasar SDLC dan STLC</li>
<li>Ketelitian dan kemampuan analisis root cause</li>
</ul>
<h2>3. Jenjang Karier di Bidang QA</h2>
<p>Dari QA Tester, kamu bisa berkembang menjadi QA Engineer, QA Lead, hingga QA Manager, bahkan beralih ke bidang seperti DevOps atau Product Management.</p>',
                'waktu_baca_menit' => 5,
                'tags' => 'Quality Assurance, Karier IT, Software Testing',
                'penulis_nama' => 'Dimas Prasetyo',
                'penulis_jabatan' => 'HR Consultant',
                'penulis_bio' => 'Konsultan HR yang sudah membantu ratusan perusahaan menyaring kandidat terbaik selama lebih dari 6 tahun.',
                'status' => 'published',
            ],
            [
                'judul' => 'Panduan Memilih Program Magang yang Tepat',
                'kategori' => 'Tips Karier',
                'ringkasan' => 'Tidak semua program magang diciptakan sama — kenali kriteria magang yang benar-benar memberi nilai untuk kariermu.',
                'konten' => '<p>Magang adalah kesempatan berharga untuk mendapatkan pengalaman kerja nyata sebelum lulus. Namun, tidak semua program magang memberikan manfaat yang sama, sehingga penting untuk selektif dalam memilih.</p>
<h2>1. Perhatikan Struktur Program</h2>
<p>Cari program magang yang memiliki jadwal pelatihan, mentor pembimbing, dan target pembelajaran yang jelas, bukan hanya sekadar mengisi posisi kosong.</p>
<h2>2. Cek Relevansi dengan Bidang Studi</h2>
<p>Pilih magang yang sejalan dengan jurusan atau minat kariermu agar pengalaman yang didapat benar-benar bisa dituliskan di CV secara relevan.</p>
<ul>
<li>Pastikan ada evaluasi kinerja berkala</li>
<li>Cari tahu apakah magang ini bisa dikonversi jadi SKS</li>
<li>Tanyakan peluang menjadi karyawan tetap setelah magang</li>
</ul>
<h2>3. Jangan Lupakan Aspek Kesejahteraan</h2>
<p>Uang saku, fasilitas kerja, dan jam kerja yang wajar juga penting diperhatikan agar kamu tetap produktif selama program berlangsung.</p>',
                'waktu_baca_menit' => 5,
                'tags' => 'Magang, Internship, Tips Karier',
                'penulis_nama' => 'Sarah Wulandari',
                'penulis_jabatan' => 'Talent Acquisition Lead',
                'penulis_bio' => 'Berpengalaman memimpin proses rekrutmen di berbagai startup teknologi di Sumatera dan Jawa.',
                'status' => 'published',
            ],
            [
                'judul' => 'Pertumbuhan Industri Fintech di Indonesia Tahun 2026',
                'kategori' => 'Tren Industri',
                'ringkasan' => 'Industri fintech terus berkembang pesat, membuka ribuan peluang karier baru di bidang teknologi dan keuangan digital.',
                'konten' => '<p>Sepanjang tahun 2026, industri financial technology (fintech) di Indonesia mencatatkan pertumbuhan yang signifikan, didorong oleh adopsi pembayaran digital dan layanan keuangan berbasis teknologi yang semakin meluas.</p>
<h2>1. Permintaan Talenta Teknologi Meningkat</h2>
<p>Perusahaan fintech dan penyedia solusi pembayaran digital membutuhkan lebih banyak software engineer, QA engineer, dan data analyst untuk mendukung ekspansi produk mereka.</p>
<h2>2. Kolaborasi dengan Institusi Keuangan Tradisional</h2>
<p>Bank dan lembaga keuangan konvensional semakin banyak bermitra dengan perusahaan fintech untuk mempercepat transformasi digital layanan mereka.</p>
<ul>
<li>Peningkatan adopsi pembayaran digital di sektor UMKM</li>
<li>Regulasi yang semakin mendukung inovasi fintech</li>
<li>Permintaan tinggi untuk talenta dengan skill keamanan siber</li>
</ul>
<h2>3. Peluang Karier bagi Lulusan Baru</h2>
<p>Program magang dan entry-level di perusahaan fintech menjadi pintu masuk yang baik bagi fresh graduate untuk membangun karier di industri yang terus bertumbuh ini.</p>',
                'waktu_baca_menit' => 6,
                'tags' => 'Fintech, Tren Industri, Karier Teknologi',
                'penulis_nama' => 'Fajar Nugraha',
                'penulis_jabatan' => 'Industry Analyst',
                'penulis_bio' => 'Menganalisis tren pasar kerja dan industri kreatif di kawasan Sumatera untuk berbagai publikasi bisnis.',
                'status' => 'published',
            ],
            [
                'judul' => 'Soft Skill yang Paling Dicari Perusahaan Saat Ini',
                'kategori' => 'Tips Karier',
                'ringkasan' => 'Kemampuan teknis penting, tapi soft skill sering jadi penentu akhir dalam proses seleksi kandidat.',
                'konten' => '<p>Banyak kandidat fokus mengasah hard skill, padahal soft skill sering menjadi pembeda utama saat perusahaan memutuskan siapa yang akan diterima.</p>
<h2>1. Komunikasi yang Jelas dan Efektif</h2>
<p>Kemampuan menyampaikan ide secara ringkas dan mudah dipahami sangat dihargai, baik dalam komunikasi tertulis maupun lisan.</p>
<h2>2. Kemampuan Bekerja dalam Tim</h2>
<p>Perusahaan mencari individu yang bisa berkolaborasi lintas divisi, menerima masukan, dan berkontribusi positif dalam dinamika tim.</p>
<ul>
<li>Kemampuan adaptasi terhadap perubahan</li>
<li>Problem solving dan berpikir kritis</li>
<li>Manajemen waktu dan prioritas kerja</li>
</ul>
<h2>3. Sikap Proaktif dan Mau Belajar</h2>
<p>Karyawan yang inisiatif dan terbuka terhadap hal baru cenderung berkembang lebih cepat dan dipercaya menangani tanggung jawab lebih besar.</p>',
                'waktu_baca_menit' => 5,
                'tags' => 'Soft Skill, Karier, Rekrutmen',
                'penulis_nama' => 'Rani Anggraini',
                'penulis_jabatan' => 'Career Coach',
                'penulis_bio' => 'Career coach dengan 8 tahun pengalaman mendampingi fresh graduate di Sumatera mencari pekerjaan pertama mereka.',
                'status' => 'published',
            ],
            [
                'judul' => 'Persiapan Tes Teknis untuk Posisi Software Developer',
                'kategori' => 'Tips Karier',
                'ringkasan' => 'Tes teknis sering jadi tahap paling menentukan bagi kandidat developer — berikut cara mempersiapkannya dengan efektif.',
                'konten' => '<p>Bagi kandidat posisi software developer, tes teknis atau technical interview sering menjadi tahap seleksi yang paling menentukan. Persiapan yang matang bisa meningkatkan rasa percaya diri sekaligus performa saat tes berlangsung.</p>
<h2>1. Kuasai Fundamental Pemrograman</h2>
<p>Pastikan kamu memahami konsep dasar seperti struktur data, algoritma, dan kompleksitas waktu, karena ini sering muncul dalam tes coding.</p>
<h2>2. Latihan dengan Studi Kasus Nyata</h2>
<p>Kerjakan soal-soal dari platform latihan coding dan coba selesaikan proyek kecil yang mensimulasikan kondisi kerja sesungguhnya.</p>
<ul>
<li>Biasakan menjelaskan proses berpikir saat coding</li>
<li>Pelajari dasar database dan query SQL</li>
<li>Pahami konsep version control seperti Git</li>
</ul>
<h2>3. Jangan Lupakan Komunikasi Selama Tes</h2>
<p>Pewawancara sering menilai bukan hanya jawaban akhir, tapi juga bagaimana kamu berpikir dan berkomunikasi selama proses pengerjaan soal.</p>',
                'waktu_baca_menit' => 6,
                'tags' => 'Technical Interview, Software Developer, Tips Karier',
                'penulis_nama' => 'Dimas Prasetyo',
                'penulis_jabatan' => 'HR Consultant',
                'penulis_bio' => 'Konsultan HR yang sudah membantu ratusan perusahaan menyaring kandidat terbaik selama lebih dari 6 tahun.',
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