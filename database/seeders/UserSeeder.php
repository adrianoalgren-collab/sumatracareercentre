<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@scc.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '08123456789',
            'address' => 'Politeknik Caltex Riau',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PELAMAR
        |--------------------------------------------------------------------------
        */
        $pelamarList = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'phone' => '08222222222',
                'address' => 'Pekanbaru, Riau',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@gmail.com',
                'phone' => '08222333444',
                'address' => 'Dumai, Riau',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@gmail.com',
                'phone' => '08222444555',
                'address' => 'Pekanbaru, Riau',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'phone' => '08222555666',
                'address' => 'Rengat, Indragiri Hulu, Riau',
            ],
            [
                'name' => 'Rizky Ramadhan',
                'email' => 'rizky.ramadhan@gmail.com',
                'phone' => '08222666777',
                'address' => 'Pekanbaru, Riau',
            ],
            [
                'name' => 'Putri Anggraini',
                'email' => 'putri.anggraini@gmail.com',
                'phone' => '08222777888',
                'address' => 'Bengkalis, Riau',
            ],
            [
                'name' => 'Andi Saputra',
                'email' => 'andi.saputra@gmail.com',
                'phone' => '08222888999',
                'address' => 'Pekanbaru, Riau',
            ],
            [
                'name' => 'Nadia Ramadhani',
                'email' => 'nadia.ramadhani@gmail.com',
                'phone' => '08222999000',
                'address' => 'Duri, Bengkalis, Riau',
            ],
            [
                'name' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@gmail.com',
                'phone' => '08223000111',
                'address' => 'Pekanbaru, Riau',
            ],
            [
                'name' => 'Melati Wulandari',
                'email' => 'melati.wulandari@gmail.com',
                'phone' => '08223111222',
                'address' => 'Siak, Riau',
            ],
        ];

        foreach ($pelamarList as $data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
                'role' => 'pelamar',
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);
        }
    }
}