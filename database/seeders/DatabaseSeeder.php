<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Masjid',
            'email' => 'admin@masquecore.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '08123456789',
        ]);

        User::create([
            'name' => 'Jamaah Satu',
            'email' => 'jamaah@masquecore.test',
            'password' => Hash::make('password'),
            'role' => 'jamaah',
            'phone' => '08123456788',
            'pekerjaan' => 'Wiraswasta',
            'kondisi_ekonomi' => 'menengah',
            'tanggungan' => 3,
            'address' => 'Jl. Masjid No. 1, Jakarta',
        ]);
    }
}
