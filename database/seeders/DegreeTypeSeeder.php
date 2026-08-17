<?php

namespace Database\Seeders;

use App\Models\DegreeType;
use Illuminate\Database\Seeder;

class DegreeTypeSeeder extends Seeder
{
    public function run(): void
    {
        $degrees = [
            // Gelar Sarjana Virtual
            [
                'code'             => 'KVT.Kom',
                'name'             => 'Komputer Virtual Terapan',
                'category'         => 'sarjana',
                'description'      => 'Gelar tertinggi dalam Kampus Virtual untuk bidang teknologi komputer terapan. Setara dengan Sarjana Terapan di kampus virtual.',
                'duration_months'  => 48,
                'credits_required' => 144,
                'color'            => '#6366F1',
                'sort_order'       => 1,
            ],
            [
                'code'             => 'VT.Kom',
                'name'             => 'Vokasi Teknologi Komputer',
                'category'         => 'sarjana',
                'description'      => 'Gelar Vokasi Teknologi Komputer untuk profesional yang ingin mendalami teknologi informasi secara praktis.',
                'duration_months'  => 36,
                'credits_required' => 120,
                'color'            => '#3B82F6',
                'sort_order'       => 2,
            ],
            [
                'code'             => 'VTA.Kom',
                'name'             => 'Vokasi Teknologi Administrasi Komputer',
                'category'         => 'vokasi',
                'description'      => 'Gelar Vokasi Teknologi Administrasi Komputer untuk bidang administrasi berbasis teknologi digital.',
                'duration_months'  => 30,
                'credits_required' => 108,
                'color'            => '#10B981',
                'sort_order'       => 3,
            ],
            [
                'code'             => 'V.Com',
                'name'             => 'Vokasi Commerce',
                'category'         => 'vokasi',
                'description'      => 'Gelar Vokasi Commerce untuk bidang bisnis digital, e-commerce, dan kewirausahaan berbasis teknologi.',
                'duration_months'  => 24,
                'credits_required'  => 96,
                'color'            => '#F59E0B',
                'sort_order'       => 4,
            ],
            // Gelar Diploma (K1-K6)
            [
                'code'             => 'K1',
                'name'             => 'Kompeten Level 1',
                'category'         => 'diploma',
                'description'      => 'Tingkat kompetensi dasar. Pengenalan dunia digital dan teknologi informasi untuk pemula.',
                'duration_months'  => 3,
                'credits_required' => 18,
                'color'            => '#EF4444',
                'sort_order'       => 5,
            ],
            [
                'code'             => 'K2',
                'name'             => 'Kompeten Level 2',
                'category'         => 'diploma',
                'description'      => 'Tingkat kompetensi dasar lanjutan. Penguasaan tools digital dan produktivitas kerja.',
                'duration_months'  => 6,
                'credits_required' => 36,
                'color'            => '#F97316',
                'sort_order'       => 6,
            ],
            [
                'code'             => 'K3',
                'name'             => 'Kompeten Level 3',
                'category'         => 'diploma',
                'description'      => 'Tingkat kompetensi menengah. Pengembangan skill teknis dan soft skill profesional.',
                'duration_months'  => 9,
                'credits_required' => 54,
                'color'            => '#EAB308',
                'sort_order'       => 7,
            ],
            [
                'code'             => 'K4',
                'name'             => 'Kompeten Level 4',
                'category'         => 'diploma',
                'description'      => 'Tingkat kompetensi menengah atas. Setara D2, spesialisasi bidang teknologi pilihan.',
                'duration_months'  => 12,
                'credits_required' => 72,
                'color'            => '#84CC16',
                'sort_order'       => 8,
            ],
            [
                'code'             => 'K5',
                'name'             => 'Kompeten Level 5',
                'category'         => 'diploma',
                'description'      => 'Tingkat kompetensi tinggi. Setara D3, penguasaan teknologi untuk karir profesional.',
                'duration_months'  => 18,
                'credits_required' => 90,
                'color'            => '#06B6D4',
                'sort_order'       => 9,
            ],
            [
                'code'             => 'K6',
                'name'             => 'Kompeten Level 6',
                'category'         => 'diploma',
                'description'      => 'Tingkat kompetensi tertinggi diploma. Setara D4, siap menjadi pemimpin tim teknologi.',
                'duration_months'  => 24,
                'credits_required' => 108,
                'color'            => '#8B5CF6',
                'sort_order'       => 10,
            ],
        ];

        foreach ($degrees as $degree) {
            DegreeType::create($degree);
        }
    }
}
