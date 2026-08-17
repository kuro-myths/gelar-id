<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenyeederPengguna extends Seeder
{
    public function run(): void
    {
        // Admin
        Pengguna::firstOrCreate(['email' => 'admin@gelar.test'], [
            'nama' => 'Administrator', 'nama_pengguna' => 'admin',
            'password' => Hash::make('admin123'), 'peran' => 'admin', 'aktif' => true,
        ]);

        // Pengajar
        $pengajar = [
            ['nama'=>'Dr. Andi Wijaya, M.Kom','email'=>'andi@gelar.test','username'=>'drandi','keahlian'=>'Cloud Computing, AWS, DevOps','bio'=>'Praktisi cloud 10+ tahun, ex-engineer Google Asia Pacific.','rating'=>48,'total_pelajar'=>312],
            ['nama'=>'Sari Dewi, S.T.','email'=>'sari@gelar.test','username'=>'saridewi','keahlian'=>'UI/UX Design, Figma, Canva','bio'=>'Desainer UI/UX dengan 7 tahun pengalaman di startup tech.','rating'=>46,'total_pelajar'=>218],
            ['nama'=>'Rizki Pratama, S.Kom','email'=>'rizki@gelar.test','username'=>'rzkipratama','keahlian'=>'Python, Machine Learning, Data Science','bio'=>'Data Scientist di salah satu unicorn Indonesia.','rating'=>49,'total_pelajar'=>445],
            ['nama'=>'Maya Putri, M.M.','email'=>'maya@gelar.test','username'=>'mayaputri','keahlian'=>'Digital Marketing, SEO, E-Commerce','bio'=>'Founder agency digital marketing dengan 100+ klien UMKM.','rating'=>47,'total_pelajar'=>189],
        ];

        foreach ($pengajar as $i => $p) {
            Pengguna::firstOrCreate(['email' => $p['email']], [
                'nama' => $p['nama'], 'nama_pengguna' => $p['username'],
                'password' => Hash::make('password'),
                'peran' => 'pengajar', 'aktif' => true,
                'keahlian' => $p['keahlian'], 'bio' => $p['bio'],
                'rating' => $p['rating'], 'total_pelajar' => $p['total_pelajar'],
                'tampilkan_profil' => true,
                'nim' => 'PG-2024-' . str_pad($i+1, 3, '0', STR_PAD_LEFT),
            ]);
        }

        // Mahasiswa/pengguna biasa
        $pengguna = [
            ['nama'=>'Budi Santoso','email'=>'budi@contoh.com','username'=>'budi','nim'=>'KV-2024-0001','institusi'=>'PT. Maju Bersama'],
            ['nama'=>'Siti Rahayu','email'=>'siti@contoh.com','username'=>'siti','nim'=>'KV-2024-0002','institusi'=>'UMKM Batik Nusantara'],
            ['nama'=>'Ahmad Fauzi','email'=>'ahmad@contoh.com','username'=>'ahmadfauzi','nim'=>'KV-2024-0003','institusi'=>'SMA Negeri 1 Jakarta'],
            ['nama'=>'Dewi Lestari','email'=>'dewi@contoh.com','username'=>'dewilestari','nim'=>'KV-2024-0004','institusi'=>'SMK Informatika'],
            ['nama'=>'Hendra Gunawan','email'=>'hendra@contoh.com','username'=>'hendragu','nim'=>'KV-2024-0005','institusi'=>'Freelancer'],
            ['nama'=>'Rina Oktaviani','email'=>'rina@contoh.com','username'=>'rinaokta','nim'=>'KV-2024-0006','institusi'=>'PT. Teknologi Maju'],
        ];

        foreach ($pengguna as $p) {
            Pengguna::firstOrCreate(['email' => $p['email']], [
                'nama' => $p['nama'], 'nama_pengguna' => $p['username'],
                'nim' => $p['nim'], 'institusi' => $p['institusi'],
                'password' => Hash::make('password'), 'peran' => 'pengguna', 'aktif' => true,
            ]);
        }
    }
}
