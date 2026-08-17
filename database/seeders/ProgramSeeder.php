<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\DegreeType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            // KVT.Kom
            ['degree' => 'KVT.Kom', 'name' => 'Rekayasa Perangkat Lunak Virtual', 'price' => 2500000, 'featured' => true,
             'description' => 'Program studi rekayasa perangkat lunak berbasis virtual dengan kurikulum industri terkini.'],
            ['degree' => 'KVT.Kom', 'name' => 'Keamanan Siber Terapan', 'price' => 3000000, 'featured' => true,
             'description' => 'Pelajari keamanan jaringan, ethical hacking, dan proteksi sistem informasi secara profesional.'],

            // VT.Kom
            ['degree' => 'VT.Kom', 'name' => 'Pengembangan Aplikasi Web', 'price' => 1800000, 'featured' => true,
             'description' => 'Kuasai full-stack web development dari frontend hingga backend dengan framework modern.'],
            ['degree' => 'VT.Kom', 'name' => 'Data Science & Analitik', 'price' => 2000000, 'featured' => false,
             'description' => 'Analisis data besar, machine learning dasar, dan visualisasi data untuk pengambilan keputusan.'],

            // VTA.Kom
            ['degree' => 'VTA.Kom', 'name' => 'Administrasi Sistem Digital', 'price' => 1500000, 'featured' => false,
             'description' => 'Kelola sistem informasi perusahaan, cloud computing, dan administrasi jaringan.'],

            // V.Com
            ['degree' => 'V.Com', 'name' => 'Digital Marketing & E-Commerce', 'price' => 1200000, 'featured' => true,
             'description' => 'Strategi pemasaran digital, pengelolaan toko online, dan analitik bisnis digital.'],
            ['degree' => 'V.Com', 'name' => 'Kewirausahaan Digital', 'price' => 1000000, 'featured' => false,
             'description' => 'Bangun startup digital dari nol: ideasi, validasi, pengembangan produk, hingga pitching investor.'],

            // K1-K6
            ['degree' => 'K1', 'name' => 'Literasi Digital Dasar', 'price' => 0, 'featured' => false,
             'description' => 'Pengenalan perangkat digital, internet, email, dan produktivitas dasar untuk pemula.'],
            ['degree' => 'K2', 'name' => 'Microsoft Office & Google Workspace', 'price' => 350000, 'featured' => false,
             'description' => 'Kuasai aplikasi produktivitas perkantoran: Word, Excel, PowerPoint, Google Docs, Sheets.'],
            ['degree' => 'K3', 'name' => 'Desain Grafis Digital', 'price' => 650000, 'featured' => false,
             'description' => 'Belajar desain grafis dengan Canva, Adobe Photoshop, dan Illustrator untuk kebutuhan digital.'],
            ['degree' => 'K4', 'name' => 'Pemrograman Dasar Python', 'price' => 850000, 'featured' => false,
             'description' => 'Fondasi pemrograman Python untuk otomasi, analisis data, dan pengembangan aplikasi.'],
            ['degree' => 'K5', 'name' => 'Pengembangan Aplikasi Mobile', 'price' => 1100000, 'featured' => false,
             'description' => 'Bangun aplikasi Android/iOS dengan Flutter dan React Native dari dasar hingga publish.'],
            ['degree' => 'K6', 'name' => 'Cloud Computing & DevOps', 'price' => 1400000, 'featured' => false,
             'description' => 'Arsitektur cloud (AWS/GCP), containerisasi Docker, CI/CD pipeline, dan deployment modern.'],
        ];

        foreach ($programs as $data) {
            $degreeType = DegreeType::where('code', $data['degree'])->first();
            if ($degreeType) {
                Program::create([
                    'degree_type_id' => $degreeType->id,
                    'name'           => $data['name'],
                    'slug'           => Str::slug($data['name']),
                    'description'    => $data['description'],
                    'price'          => $data['price'],
                    'is_featured'    => $data['featured'],
                    'is_active'      => true,
                ]);
            }
        }
    }
}
