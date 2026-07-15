<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perusahaan;

class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        Perusahaan::create([
            'nama_perusahaan' => 'Andalas Tech Solutions',
            'email_perusahaan' => 'hr@andalastech.com',
            'telepon_perusahaan' => '081234567890',
            'alamat_perusahaan' => 'Medan, Sumatera Utara',
            'website_perusahaan' => 'https://andalastech.com',
            'status_perusahaan' => 'aktif',
        ]);

        Perusahaan::create([
            'nama_perusahaan' => 'Sumatra Digital Group',
            'email_perusahaan' => 'recruitment@sumatradigital.com',
            'telepon_perusahaan' => '081298765432',
            'alamat_perusahaan' => 'Pekanbaru, Riau',
            'website_perusahaan' => 'https://sumatradigital.com',
            'status_perusahaan' => 'aktif',
        ]);

        Perusahaan::create([
            'nama_perusahaan' => 'Nusantara Teknologi Indonesia',
            'email_perusahaan' => 'career@nusantaratech.id',
            'telepon_perusahaan' => '081377788899',
            'alamat_perusahaan' => 'Padang, Sumatera Barat',
            'website_perusahaan' => 'https://nusantaratech.id',
            'status_perusahaan' => 'aktif',
        ]);
    }
}