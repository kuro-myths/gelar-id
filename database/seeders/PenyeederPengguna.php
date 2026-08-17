<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenyeederPengguna extends Seeder
{
    public function run(): void
    {
        Pengguna::create([
            'nama'          => 'Administrator',
            'email'         => 'admin@gelar.test',
            'nama_pengguna' => 'admin',
            'password'      => Hash::make('admin123'),
            'peran'         => 'admin',
            'aktif'         => true,
        ]);

        Pengguna::create([
            'nama'          => 'Budi Santoso',
            'email'         => 'budi@contoh.com',
            'nama_pengguna' => 'budi',
            'nim'           => 'KV-2024-0001',
            'password'      => Hash::make('password'),
            'peran'         => 'pengguna',
            'aktif'         => true,
            'institusi'     => 'PT. Maju Bersama',
        ]);

        Pengguna::create([
            'nama'          => 'Siti Rahayu',
            'email'         => 'siti@contoh.com',
            'nama_pengguna' => 'siti',
            'nim'           => 'KV-2024-0002',
            'password'      => Hash::make('password'),
            'peran'         => 'pengguna',
            'aktif'         => true,
            'institusi'     => 'UMKM Batik Nusantara',
        ]);
    }
}
