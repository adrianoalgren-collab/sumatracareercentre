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
        /* ============================================================
         | LOWONGAN 1: Associate QA Implementation Engineer Intern
         | OpenWay Indonesia
         ============================================================ */

        $openway = Perusahaan::firstOrCreate(
            ['nama_perusahaan' => 'OpenWay Indonesia'],
            [
                'user_id' => null,
                'email_perusahaan' => 'careers@openwaygroup.com',
                'telepon_perusahaan' => '0217654321',
                'alamat_perusahaan' => 'Gandaria 8 Office Tower, 18th Floor, Jl. Sultan Iskandar Muda No. 10, Kebayoran Lama, Jakarta 12240',
                'website_perusahaan' => 'https://openwaygroup.com',
                'status_perusahaan' => 'aktif',
            ]
        );

        $lowongan1 = LowonganPekerjaan::create([
            'perusahaan_id' => $openway->id,
            'judul_lowongan' => 'Associate QA Implementation Engineer Intern',
            'lokasi' => 'Jakarta',
            'kategori_label' => 'Internship',
            'deskripsi_pekerjaan' => 'OpenWay Group is a global provider of digital payment software solutions and the developer of the Way4 platform, serving banks, payment processors, fintech companies, telecom operators, and other payment institutions worldwide. Founded in 1995 and headquartered in Belgium, OpenWay supports organizations across more than 100 countries with technology that powers modern digital payment ecosystems. OpenWay expanded its presence into Asia, including Indonesia, in 2005 and has since supported more than 30 financial institutions and banking customers across the region. With a strong focus on advancing the payments industry in Asia, OpenWay works closely with customers to support their payment transformation journeys and digital initiatives. Through local representation and regional support capabilities, OpenWay remains committed to understanding market needs and helping financial institutions accelerate innovation in areas such as digital payments, modernization, and next-generation payment solutions. OpenWay Indonesia is now opening applications for the Associate QA Implementation Engineer Intern program, running from 1 September 2026 to 31 January 2027 (5 months), with a hybrid working arrangement based at OpenWay Indonesia, Gandaria 8 Office Tower, 18th Floor, Jl. Sultan Iskandar Muda No. 10, Kebayoran Lama, Jakarta 12240. What you will gain: hands-on experience with enterprise technologies including Oracle PL/SQL, Java, IntelliJ IDEA, Groovy, and CI/CD tools; exposure to industry best practices through guidance from experienced professionals in financial technology, with a focus on software development, IT security, quality assurance, and testing methodology for clients; a strong understanding of software delivery processes and credit card issuing solutions through structured training; mentorship, regular performance feedback, and continuous evaluations to support your professional growth; strengthened communication, teamwork, and workplace professionalism through collaborative learning; opportunities to showcase your technical capabilities through presentations and project deliverables; industry-relevant skills that enhance your career readiness and future employability in enterprise software engineering and technology delivery; and an internship allowance.',
            'deadline' => '2026-08-25',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 5,
            'total_pendaftar' => 62,
            'total_interview' => 15,
            'tanggal_deadline_label' => '25 Aug',
            'gambar_banner' => 'openway.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan1->id, 'nama_jurusan' => 'Teknik Informatika']);
        Jurusan::create(['lowongan_id' => $lowongan1->id, 'nama_jurusan' => 'Sistem Informasi']);
        Jurusan::create(['lowongan_id' => $lowongan1->id, 'nama_jurusan' => 'Ilmu Komputer']);

        SyaratKhusus::create(['lowongan_id' => $lowongan1->id, 'syarat_khusus' => 'Oracle PL/SQL']);
        SyaratKhusus::create(['lowongan_id' => $lowongan1->id, 'syarat_khusus' => 'Java & IntelliJ IDEA']);
        SyaratKhusus::create(['lowongan_id' => $lowongan1->id, 'syarat_khusus' => 'Groovy']);
        SyaratKhusus::create(['lowongan_id' => $lowongan1->id, 'syarat_khusus' => 'CI/CD Tools']);

        SyaratUmum::create(['lowongan_id' => $lowongan1->id, 'syarat_umum' => 'Mahasiswa tingkat 3-4 atau fresh graduate CS/IT, minimal IPK 3.25']);
        SyaratUmum::create(['lowongan_id' => $lowongan1->id, 'syarat_umum' => 'Menguasai dasar IT & programming (Java, database, SQL)']);
        SyaratUmum::create(['lowongan_id' => $lowongan1->id, 'syarat_umum' => 'Bahasa Inggris minimal Upper Intermediate']);
        SyaratUmum::create(['lowongan_id' => $lowongan1->id, 'syarat_umum' => 'Problem solver, passionate learner, dan siap bekerja dalam tim']);

        Komentar::create(['lowongan_id' => $lowongan1->id, 'user_id' => null, 'nama_user' => 'Fajar Nugroho', 'isi_komentar' => 'Apakah program ini bisa diperpanjang menjadi karyawan tetap?']);
        Komentar::create(['lowongan_id' => $lowongan1->id, 'user_id' => null, 'nama_user' => 'Nadia Ramadhani', 'isi_komentar' => 'Apakah wajib berdomisili di Jakarta selama magang?']);


        /* ============================================================
         | LOWONGAN 2: Frontend Developer Intern
         | Riau Digital Nusantara
         ============================================================ */

        $riauDigital = Perusahaan::where('nama_perusahaan', 'Riau Digital Nusantara')->first();

        $lowongan2 = LowonganPekerjaan::create([
            'perusahaan_id' => $riauDigital?->id ?? $openway->id,
            'judul_lowongan' => 'Frontend Developer Intern',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Internship',
            'deskripsi_pekerjaan' => 'Riau Digital Nusantara is a growing technology company based in Pekanbaru, focused on building digital products for local businesses, government partners, and startups across Sumatra. Since its establishment, the company has helped more than 50 clients transform their operations through custom web and mobile applications, internal tooling, and digital transformation consulting. With a strong commitment to nurturing local tech talent, Riau Digital Nusantara actively opens internship opportunities for students who want to gain real-world experience in a fast-paced product development environment. Riau Digital Nusantara is now opening applications for the Frontend Developer Intern position, based in Pekanbaru with a flexible hybrid working arrangement. What you will gain: hands-on experience building modern user interfaces using React, Vue, and component-driven development practices; direct mentorship from senior frontend engineers on code quality, performance optimization, and accessibility standards; exposure to real client projects, from requirement gathering to deployment; opportunities to collaborate closely with backend developers, UI/UX designers, and product managers in an agile team setting; regular code review sessions and constructive feedback to accelerate your growth as a developer; the chance to present your work in internal demo sessions; and a certificate of completion along with an internship allowance upon finishing the program.',
            'deadline' => '2026-09-10',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 2,
            'total_pendaftar' => 33,
            'total_interview' => 8,
            'tanggal_deadline_label' => '10 Sep',
            'gambar_banner' => 'company5.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan2->id, 'nama_jurusan' => 'Teknik Informatika']);
        Jurusan::create(['lowongan_id' => $lowongan2->id, 'nama_jurusan' => 'Sistem Informasi']);

        SyaratKhusus::create(['lowongan_id' => $lowongan2->id, 'syarat_khusus' => 'React & Vue']);
        SyaratKhusus::create(['lowongan_id' => $lowongan2->id, 'syarat_khusus' => 'HTML, CSS, JavaScript']);

        SyaratUmum::create(['lowongan_id' => $lowongan2->id, 'syarat_umum' => 'Mahasiswa aktif minimal semester 5']);
        SyaratUmum::create(['lowongan_id' => $lowongan2->id, 'syarat_umum' => 'Terbiasa bekerja dengan Git']);

        Komentar::create(['lowongan_id' => $lowongan2->id, 'user_id' => null, 'nama_user' => 'Andi Saputra', 'isi_komentar' => 'Apakah magang ini menyediakan sertifikat?']);


        /* ============================================================
         | LOWONGAN 3: QA Tester (Manual & Automation)
         | Bumi Melayu Teknologi
         ============================================================ */

        $bumiMelayu = Perusahaan::where('nama_perusahaan', 'Bumi Melayu Teknologi')->first();

        $lowongan3 = LowonganPekerjaan::create([
            'perusahaan_id' => $bumiMelayu?->id ?? $openway->id,
            'judul_lowongan' => 'QA Tester (Manual & Automation)',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Full Time',
            'deskripsi_pekerjaan' => 'Bumi Melayu Teknologi is a software development company delivering web and mobile solutions for clients across the logistics, retail, and education sectors in Riau and surrounding regions. The company places strong emphasis on product quality, believing that reliable software is the foundation of long-term client trust. To strengthen its quality assurance capabilities, Bumi Melayu Teknologi is opening a full-time position for a QA Tester (Manual & Automation) to join its growing engineering team in Pekanbaru. In this role, you will be responsible for designing and executing manual and automated test cases across web and mobile applications, performing API testing to validate backend functionality, and working closely with developers to identify, document, and track bugs through resolution. You will also contribute to building and maintaining automated test scripts to improve testing efficiency, participate in sprint planning and retrospective meetings as part of an agile development team, and help establish quality standards and testing best practices across projects. This role offers direct exposure to real production systems, mentorship from experienced QA engineers, opportunities to expand your skills in automation tools, and a clear path for career growth within the quality assurance discipline.',
            'deadline' => '2026-09-20',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 2,
            'total_pendaftar' => 41,
            'total_interview' => 10,
            'tanggal_deadline_label' => '20 Sep',
            'gambar_banner' => 'company6.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan3->id, 'nama_jurusan' => 'Teknik Informatika']);
        Jurusan::create(['lowongan_id' => $lowongan3->id, 'nama_jurusan' => 'Sistem Informasi']);

        SyaratKhusus::create(['lowongan_id' => $lowongan3->id, 'syarat_khusus' => 'Postman & API Testing']);
        SyaratKhusus::create(['lowongan_id' => $lowongan3->id, 'syarat_khusus' => 'Selenium / Katalon']);
        SyaratKhusus::create(['lowongan_id' => $lowongan3->id, 'syarat_khusus' => 'SQL']);

        SyaratUmum::create(['lowongan_id' => $lowongan3->id, 'syarat_umum' => 'Fresh graduate dipersilakan melamar']);
        SyaratUmum::create(['lowongan_id' => $lowongan3->id, 'syarat_umum' => 'Teliti dan berorientasi pada detail']);

        Komentar::create(['lowongan_id' => $lowongan3->id, 'user_id' => null, 'nama_user' => 'Melati Wulandari', 'isi_komentar' => 'Apakah ada tes teknis sebelum interview?']);


        /* ============================================================
         | LOWONGAN 4: Backend Developer (Laravel)
         | Caltex Energi Solusi
         ============================================================ */

        $caltexEnergi = Perusahaan::where('nama_perusahaan', 'Caltex Energi Solusi')->first();

        $lowongan4 = LowonganPekerjaan::create([
            'perusahaan_id' => $caltexEnergi?->id ?? $openway->id,
            'judul_lowongan' => 'Backend Developer (Laravel)',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Full Time',
            'deskripsi_pekerjaan' => 'Caltex Energi Solusi is a technology solutions provider serving the energy and industrial sector in Riau, building internal systems that support operational efficiency, asset management, and regulatory reporting for its clients. As the company continues to scale its engineering capabilities, Caltex Energi Solusi is opening a full-time position for a Backend Developer (Laravel) to design, build, and maintain robust backend systems that power its core business applications. In this role, you will develop and maintain RESTful APIs and backend services using Laravel, design efficient and scalable database structures with MySQL, and ensure system performance, security, and reliability across all deployed applications. You will collaborate closely with frontend developers, QA engineers, and product stakeholders to translate business requirements into technical solutions, participate in code reviews to maintain high coding standards, and contribute to the continuous improvement of development workflows and deployment pipelines. This position offers the opportunity to work on mission-critical systems used by real clients in the energy sector, mentorship from senior engineers, exposure to enterprise-grade software architecture, and a supportive environment for long-term professional growth.',
            'deadline' => '2026-10-01',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 1,
            'total_pendaftar' => 27,
            'total_interview' => 7,
            'tanggal_deadline_label' => '1 Oct',
            'gambar_banner' => 'company7.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan4->id, 'nama_jurusan' => 'Teknik Informatika']);
        Jurusan::create(['lowongan_id' => $lowongan4->id, 'nama_jurusan' => 'Teknik Komputer']);

        SyaratKhusus::create(['lowongan_id' => $lowongan4->id, 'syarat_khusus' => 'PHP (Laravel)']);
        SyaratKhusus::create(['lowongan_id' => $lowongan4->id, 'syarat_khusus' => 'MySQL']);
        SyaratKhusus::create(['lowongan_id' => $lowongan4->id, 'syarat_khusus' => 'RESTful API']);

        SyaratUmum::create(['lowongan_id' => $lowongan4->id, 'syarat_umum' => 'Minimal pengalaman 1 tahun sebagai backend developer']);
        SyaratUmum::create(['lowongan_id' => $lowongan4->id, 'syarat_umum' => 'Mampu bekerja dalam tim Scrum']);

        Komentar::create(['lowongan_id' => $lowongan4->id, 'user_id' => null, 'nama_user' => 'Rizky Ramadhan', 'isi_komentar' => 'Apakah posisi ini menerima fresh graduate?']);


        /* ============================================================
         | LOWONGAN 5: UI/UX Designer Intern
         | Pekanbaru Kreatif Media
         ============================================================ */

        $pekanbaruKreatif = Perusahaan::where('nama_perusahaan', 'Pekanbaru Kreatif Media')->first();

        $lowongan5 = LowonganPekerjaan::create([
            'perusahaan_id' => $pekanbaruKreatif?->id ?? $openway->id,
            'judul_lowongan' => 'UI/UX Designer Intern',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Internship',
            'deskripsi_pekerjaan' => 'Pekanbaru Kreatif Media is a digital creative agency specializing in branding, content production, and product design for clients ranging from local SMEs to regional enterprises across Sumatra. The agency believes that great design is rooted in genuine understanding of user needs, and it invests heavily in developing young design talent through structured internship programs. Pekanbaru Kreatif Media is now opening applications for a UI/UX Designer Intern to join its product design team in Pekanbaru. In this role, you will assist in designing wireframes, interactive prototypes, and polished user interfaces for web and mobile applications, conduct user research and usability testing to inform design decisions, and collaborate with developers to ensure designs are implemented accurately and consistently. You will also participate in design critique sessions to sharpen your craft, help maintain and evolve the agency\'s design system and component libraries, and contribute ideas during brainstorming sessions for new client projects. Interns in this program receive close mentorship from senior designers, exposure to real client briefs and deadlines, opportunities to build a strong portfolio, and a certificate of completion at the end of the internship period.',
            'deadline' => '2026-09-05',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 1,
            'total_pendaftar' => 22,
            'total_interview' => 5,
            'tanggal_deadline_label' => '5 Sep',
            'gambar_banner' => 'company8.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan5->id, 'nama_jurusan' => 'Desain Komunikasi Visual']);
        Jurusan::create(['lowongan_id' => $lowongan5->id, 'nama_jurusan' => 'Sistem Informasi']);

        SyaratKhusus::create(['lowongan_id' => $lowongan5->id, 'syarat_khusus' => 'Figma']);
        SyaratKhusus::create(['lowongan_id' => $lowongan5->id, 'syarat_khusus' => 'User Research']);

        SyaratUmum::create(['lowongan_id' => $lowongan5->id, 'syarat_umum' => 'Memiliki portofolio desain']);
        SyaratUmum::create(['lowongan_id' => $lowongan5->id, 'syarat_umum' => 'Kreatif dan komunikatif']);

        Komentar::create(['lowongan_id' => $lowongan5->id, 'user_id' => null, 'nama_user' => 'Putri Anggraini', 'isi_komentar' => 'Apakah portofolio wajib dilampirkan saat mendaftar?']);


        /* ============================================================
         | LOWONGAN 6: Data Analyst
         | Siak Data Sistem
         ============================================================ */

        $siakData = Perusahaan::where('nama_perusahaan', 'Siak Data Sistem')->first();

        $lowongan6 = LowonganPekerjaan::create([
            'perusahaan_id' => $siakData?->id ?? $openway->id,
            'judul_lowongan' => 'Data Analyst',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Full Time',
            'deskripsi_pekerjaan' => 'Siak Data Sistem is a data and analytics consultancy helping organizations across Riau make better decisions through data-driven insights, dashboard reporting, and business intelligence solutions. The company works with clients in retail, agriculture, and local government, transforming raw operational data into actionable strategies. As demand for data services grows, Siak Data Sistem is opening a full-time position for a Data Analyst to join its analytics team. In this role, you will extract, clean, and analyze large datasets using SQL and Python, build interactive dashboards and reports to visualize key business metrics, and work closely with stakeholders to understand their data needs and translate them into meaningful analysis. You will also identify trends and patterns that support strategic decision-making, document data pipelines and analytical processes for consistency and reproducibility, and present findings clearly to both technical and non-technical audiences. This position offers hands-on experience with real business datasets, mentorship from experienced data professionals, opportunities to expand your skill set in data visualization and statistical analysis, and a collaborative environment that values curiosity and continuous learning.',
            'deadline' => '2026-09-25',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 1,
            'total_pendaftar' => 30,
            'total_interview' => 6,
            'tanggal_deadline_label' => '25 Sep',
            'gambar_banner' => 'company9.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan6->id, 'nama_jurusan' => 'Sistem Informasi']);
        Jurusan::create(['lowongan_id' => $lowongan6->id, 'nama_jurusan' => 'Statistika']);

        SyaratKhusus::create(['lowongan_id' => $lowongan6->id, 'syarat_khusus' => 'SQL']);
        SyaratKhusus::create(['lowongan_id' => $lowongan6->id, 'syarat_khusus' => 'Python (Pandas)']);
        SyaratKhusus::create(['lowongan_id' => $lowongan6->id, 'syarat_khusus' => 'Data Visualization']);

        SyaratUmum::create(['lowongan_id' => $lowongan6->id, 'syarat_umum' => 'Fresh graduate dipersilakan melamar']);
        SyaratUmum::create(['lowongan_id' => $lowongan6->id, 'syarat_umum' => 'Analitis dan teliti']);

        Komentar::create(['lowongan_id' => $lowongan6->id, 'user_id' => null, 'nama_user' => 'Dewi Lestari', 'isi_komentar' => 'Apakah posisi ini bisa hybrid?']);


        /* ============================================================
         | LOWONGAN 7: Mobile Developer (Flutter)
         | Rantau Software House
         ============================================================ */

        $rantauSoftware = Perusahaan::where('nama_perusahaan', 'Rantau Software House')->first();

        $lowongan7 = LowonganPekerjaan::create([
            'perusahaan_id' => $rantauSoftware?->id ?? $openway->id,
            'judul_lowongan' => 'Mobile Developer (Flutter)',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Full Time',
            'deskripsi_pekerjaan' => 'Rantau Software House is a product-focused software studio building cross-platform mobile applications for clients in e-commerce, logistics, and community-based services across Indonesia. The studio takes pride in delivering polished, high-performance mobile experiences and fostering a culture of craftsmanship among its engineers. To support its growing project pipeline, Rantau Software House is opening a full-time position for a Mobile Developer (Flutter) to join its mobile engineering team in Pekanbaru. In this role, you will design and build cross-platform mobile applications using Flutter and Dart, integrate applications with backend APIs and third-party services such as Firebase, and ensure smooth performance and consistent user experience across both Android and iOS platforms. You will collaborate with UI/UX designers to implement pixel-accurate designs, write clean and maintainable code following mobile development best practices, and participate in testing and debugging to ensure application stability prior to release. This position offers the opportunity to work on published, real-world applications used by thousands of users, mentorship from experienced mobile engineers, exposure to the full app development lifecycle from concept to app store release, and a collaborative team culture that values technical excellence.',
            'deadline' => '2026-10-05',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 1,
            'total_pendaftar' => 24,
            'total_interview' => 5,
            'tanggal_deadline_label' => '5 Oct',
            'gambar_banner' => 'company10.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan7->id, 'nama_jurusan' => 'Teknik Informatika']);
        Jurusan::create(['lowongan_id' => $lowongan7->id, 'nama_jurusan' => 'Sistem Informasi']);

        SyaratKhusus::create(['lowongan_id' => $lowongan7->id, 'syarat_khusus' => 'Dart & Flutter']);
        SyaratKhusus::create(['lowongan_id' => $lowongan7->id, 'syarat_khusus' => 'Firebase']);

        SyaratUmum::create(['lowongan_id' => $lowongan7->id, 'syarat_umum' => 'Memiliki portofolio aplikasi mobile']);
        SyaratUmum::create(['lowongan_id' => $lowongan7->id, 'syarat_umum' => 'Mampu bekerja mandiri maupun tim']);

        Komentar::create(['lowongan_id' => $lowongan7->id, 'user_id' => null, 'nama_user' => 'Ahmad Fauzi', 'isi_komentar' => 'Apakah wajib punya aplikasi yang sudah publish di Play Store?']);


        /* ============================================================
         | LOWONGAN 8: IT Support Intern
         | Melayu Cloud Indonesia
         ============================================================ */

        $melayuCloud = Perusahaan::where('nama_perusahaan', 'Melayu Cloud Indonesia')->first();

        $lowongan8 = LowonganPekerjaan::create([
            'perusahaan_id' => $melayuCloud?->id ?? $openway->id,
            'judul_lowongan' => 'IT Support Intern',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Internship',
            'deskripsi_pekerjaan' => 'Melayu Cloud Indonesia is a managed IT services and cloud infrastructure provider supporting small and medium enterprises across Riau in modernizing their technology operations. The company manages networks, hardware assets, and cloud environments for a growing base of clients, and places strong value on hands-on, practical learning for its interns. Melayu Cloud Indonesia is now opening applications for an IT Support Intern position, based in Pekanbaru, to assist its technical operations team. In this role, you will help diagnose and resolve hardware and software issues reported by internal staff and client sites, assist in maintaining and monitoring office network infrastructure, and support the documentation and inventory management of IT assets. You will also assist senior technicians in setting up new workstations and equipment, respond to basic user support tickets under supervision, and learn fundamental practices in IT security and data backup procedures. This internship offers structured on-the-job training, mentorship from experienced IT professionals, exposure to real client environments and support workflows, and a certificate of completion along with a transport allowance upon finishing the program.',
            'deadline' => '2026-08-30',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 2,
            'total_pendaftar' => 19,
            'total_interview' => 4,
            'tanggal_deadline_label' => '30 Aug',
            'gambar_banner' => 'company11.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan8->id, 'nama_jurusan' => 'Teknik Komputer']);
        Jurusan::create(['lowongan_id' => $lowongan8->id, 'nama_jurusan' => 'Sistem Informasi']);

        SyaratKhusus::create(['lowongan_id' => $lowongan8->id, 'syarat_khusus' => 'Jaringan Komputer Dasar']);
        SyaratKhusus::create(['lowongan_id' => $lowongan8->id, 'syarat_khusus' => 'Troubleshooting Hardware']);

        SyaratUmum::create(['lowongan_id' => $lowongan8->id, 'syarat_umum' => 'Mahasiswa aktif minimal semester 4']);
        SyaratUmum::create(['lowongan_id' => $lowongan8->id, 'syarat_umum' => 'Sabar dan komunikatif']);

        Komentar::create(['lowongan_id' => $lowongan8->id, 'user_id' => null, 'nama_user' => 'Siti Nurhaliza', 'isi_komentar' => 'Apakah magang ini menyediakan uang transport?']);


        /* ============================================================
         | LOWONGAN 9: Fintech Product Analyst Intern
         | Lancang Kuning Fintech
         ============================================================ */

        $lancangKuning = Perusahaan::where('nama_perusahaan', 'Lancang Kuning Fintech')->first();

        $lowongan9 = LowonganPekerjaan::create([
            'perusahaan_id' => $lancangKuning?->id ?? $openway->id,
            'judul_lowongan' => 'Fintech Product Analyst Intern',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Internship',
            'deskripsi_pekerjaan' => 'Lancang Kuning Fintech is a homegrown financial technology company developing digital payment and micro-lending solutions for underserved communities across Sumatra. Since its founding, the company has focused on building accessible financial products that bridge the gap between traditional banking and everyday users. To support the continuous growth of its product team, Lancang Kuning Fintech is now opening applications for a Fintech Product Analyst Intern position based in Pekanbaru. In this role, you will assist the product team in gathering and analyzing business requirements from stakeholders, help draft business requirement documents (BRD) and product requirement documents (PRD), and conduct competitor research and market analysis within the fintech industry. You will also support the tracking of product metrics and user feedback to identify improvement opportunities, participate in cross-functional meetings with engineering, design, and compliance teams, and assist in preparing presentation materials for internal product reviews. This internship offers close mentorship from experienced product managers, direct exposure to how financial technology products are conceived and delivered, opportunities to develop analytical and documentation skills, and a certificate of completion along with an internship allowance.',
            'deadline' => '2026-09-15',
            'status_lowongan' => 'aktif',
            'jumlah_lowongan_dibuka' => 1,
            'total_pendaftar' => 26,
            'total_interview' => 6,
            'tanggal_deadline_label' => '15 Sep',
            'gambar_banner' => 'company12.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan9->id, 'nama_jurusan' => 'Sistem Informasi']);
        Jurusan::create(['lowongan_id' => $lowongan9->id, 'nama_jurusan' => 'Manajemen']);

        SyaratKhusus::create(['lowongan_id' => $lowongan9->id, 'syarat_khusus' => 'Penyusunan BRD/PRD']);
        SyaratKhusus::create(['lowongan_id' => $lowongan9->id, 'syarat_khusus' => 'Microsoft Excel']);

        SyaratUmum::create(['lowongan_id' => $lowongan9->id, 'syarat_umum' => 'Tertarik dengan industri fintech']);
        SyaratUmum::create(['lowongan_id' => $lowongan9->id, 'syarat_umum' => 'Analitis dan mampu berpikir struktural']);

        Komentar::create(['lowongan_id' => $lowongan9->id, 'user_id' => null, 'nama_user' => 'Budi Santoso', 'isi_komentar' => 'Apakah magang ini bisa dikonversi menjadi SKS kuliah?']);


        /* ============================================================
         | LOWONGAN 10: DevOps Engineer (Non-Aktif)
         | Sungai Duku Teknologi
         ============================================================ */

        $sungaiDuku = Perusahaan::where('nama_perusahaan', 'Sungai Duku Teknologi')->first();

        $lowongan10 = LowonganPekerjaan::create([
            'perusahaan_id' => $sungaiDuku?->id ?? $openway->id,
            'judul_lowongan' => 'DevOps Engineer',
            'lokasi' => 'Pekanbaru',
            'kategori_label' => 'Full Time',
            'deskripsi_pekerjaan' => 'Sungai Duku Teknologi is a software engineering company providing infrastructure and platform engineering services to clients across Indonesia, with a growing focus on cloud-native application deployment and automation. The company manages critical production systems for its clients and is committed to operational excellence through robust DevOps practices. Sungai Duku Teknologi previously opened a full-time position for a DevOps Engineer to strengthen its infrastructure team in Pekanbaru. In this role, the successful candidate was responsible for managing and provisioning cloud infrastructure on AWS and GCP, designing and maintaining CI/CD pipelines to automate build, test, and deployment processes, and containerizing applications using Docker and orchestrating them with Kubernetes. The role also involved monitoring system health and performance, implementing infrastructure-as-code practices, and collaborating closely with software engineers to streamline the release process and reduce deployment friction. The position offered exposure to enterprise-scale infrastructure, hands-on experience with modern DevOps tooling, and close collaboration with a cross-functional engineering team. This listing is currently non-active as the position has been filled.',
            'deadline' => '2026-06-30',
            'status_lowongan' => 'nonaktif',
            'jumlah_lowongan_dibuka' => 1,
            'total_pendaftar' => 15,
            'total_interview' => 3,
            'tanggal_deadline_label' => '30 Jun',
            'gambar_banner' => 'company13.jpg'
        ]);

        Jurusan::create(['lowongan_id' => $lowongan10->id, 'nama_jurusan' => 'Teknik Informatika']);
        Jurusan::create(['lowongan_id' => $lowongan10->id, 'nama_jurusan' => 'Teknik Komputer']);

        SyaratKhusus::create(['lowongan_id' => $lowongan10->id, 'syarat_khusus' => 'Docker & Kubernetes']);
        SyaratKhusus::create(['lowongan_id' => $lowongan10->id, 'syarat_khusus' => 'CI/CD Pipeline']);
        SyaratKhusus::create(['lowongan_id' => $lowongan10->id, 'syarat_khusus' => 'AWS / GCP']);

        SyaratUmum::create(['lowongan_id' => $lowongan10->id, 'syarat_umum' => 'Minimal pengalaman 2 tahun di bidang DevOps']);
        SyaratUmum::create(['lowongan_id' => $lowongan10->id, 'syarat_umum' => 'Mampu bekerja di bawah tekanan']);
    }
}