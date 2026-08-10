<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Hash;

class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        $perusahaanList = [
            [
                'name' => 'HR Riau Digital Nusantara',
                'email' => 'hr@riaudigital.co.id',
                'phone' => '08123334455',
                'address' => 'Jl. Sudirman No. 45, Pekanbaru, Riau',
                'company_name' => 'Riau Digital Nusantara',
                'company_website' => 'https://riaudigital.co.id',
            ],
            [
                'name' => 'HR Bumi Melayu Teknologi',
                'email' => 'hr@bumimelayutech.co.id',
                'phone' => '08123445566',
                'address' => 'Jl. Arifin Ahmad No. 12, Pekanbaru, Riau',
                'company_name' => 'Bumi Melayu Teknologi',
                'company_website' => 'https://bumimelayutech.co.id',
            ],
            [
                'name' => 'HR Caltex Energi Solusi',
                'email' => 'hr@caltexenergi.co.id',
                'phone' => '08123556677',
                'address' => 'Jl. HR Soebrantas No. 88, Pekanbaru, Riau',
                'company_name' => 'Caltex Energi Solusi',
                'company_website' => 'https://caltexenergi.co.id',
            ],
            [
                'name' => 'HR Pekanbaru Kreatif Media',
                'email' => 'hr@pekanbarukreatif.co.id',
                'phone' => '08123667788',
                'address' => 'Jl. Diponegoro No. 21, Pekanbaru, Riau',
                'company_name' => 'Pekanbaru Kreatif Media',
                'company_website' => 'https://pekanbarukreatif.co.id',
            ],
            [
                'name' => 'HR Siak Data Sistem',
                'email' => 'hr@siakdatasistem.co.id',
                'phone' => '08123778899',
                'address' => 'Jl. Riau No. 100, Pekanbaru, Riau',
                'company_name' => 'Siak Data Sistem',
                'company_website' => 'https://siakdatasistem.co.id',
            ],
            [
                'name' => 'HR Rantau Software House',
                'email' => 'hr@rantausoftware.co.id',
                'phone' => '08123889900',
                'address' => 'Jl. Tuanku Tambusai No. 34, Pekanbaru, Riau',
                'company_name' => 'Rantau Software House',
                'company_website' => 'https://rantausoftware.co.id',
            ],
            [
                'name' => 'HR Melayu Cloud Indonesia',
                'email' => 'hr@melayucloud.co.id',
                'phone' => '08123990011',
                'address' => 'Jl. Nangka No. 5, Pekanbaru, Riau',
                'company_name' => 'Melayu Cloud Indonesia',
                'company_website' => 'https://melayucloud.co.id',
            ],
            [
                'name' => 'HR Lancang Kuning Fintech',
                'email' => 'hr@lancangkuningfintech.co.id',
                'phone' => '08124001122',
                'address' => 'Jl. Sisingamangaraja No. 17, Pekanbaru, Riau',
                'company_name' => 'Lancang Kuning Fintech',
                'company_website' => 'https://lancangkuningfintech.co.id',
            ],
            [
                'name' => 'HR Sungai Duku Teknologi',
                'email' => 'hr@sungaidukutech.co.id',
                'phone' => '08124112233',
                'address' => 'Jl. Ahmad Yani No. 60, Pekanbaru, Riau',
                'company_name' => 'Sungai Duku Teknologi',
                'company_website' => 'https://sungaidukutech.co.id',
            ],
            [
                'name' => 'HR Zamrud Digital Karya',
                'email' => 'hr@zamruddigitalkarya.co.id',
                'phone' => '08124223344',
                'address' => 'Jl. Paus No. 9, Pekanbaru, Riau',
                'company_name' => 'Zamrud Digital Karya',
                'company_website' => 'https://zamruddigitalkarya.co.id',
            ],
        ];

        foreach ($perusahaanList as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
                'role' => 'perusahaan',
                'phone' => $data['phone'],
                'address' => $data['address'],
                'company_name' => $data['company_name'],
                'company_website' => $data['company_website'],
            ]);

            Perusahaan::create([
                'user_id' => $user->id,
                'nama_perusahaan' => $data['company_name'],
                'email_perusahaan' => $data['email'],
                'telepon_perusahaan' => $data['phone'],
                'alamat_perusahaan' => $data['address'],
                'website_perusahaan' => $data['company_website'],
                'status_perusahaan' => 'aktif',
            ]);
        }
    }
}