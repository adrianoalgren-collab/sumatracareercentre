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
        | PERUSAHAAN
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'HR Andalas Tech',
            'email' => 'hr@andalastech.com',
            'password' => Hash::make('password123'),
            'role' => 'perusahaan',
            'phone' => '08111111111',
            'address' => 'Medan, Sumatera Utara',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PELAMAR
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'pelamar',
            'phone' => '08222222222',
            'address' => 'Pekanbaru, Riau',
        ]);
    }
}