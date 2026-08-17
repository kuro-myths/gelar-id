<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@gelar.test',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@example.com',
            'username' => 'budi',
            'nim'      => 'KV-2024-001',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'is_active' => true,
            'institution' => 'PT. Maju Bersama',
        ]);

        User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@example.com',
            'username' => 'siti',
            'nim'      => 'KV-2024-002',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'is_active' => true,
            'institution' => 'UMKM Batik Nusantara',
        ]);
    }
}
