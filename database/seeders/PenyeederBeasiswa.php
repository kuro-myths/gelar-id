<?php

namespace Database\Seeders;

use App\Models\Beasiswa;
use App\Models\Pencapaian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PenyeederBeasiswa extends Seeder
{
    public function run(): void
    {
        // Ambil ID pencapaian yang ada
        $idMinecraft  = Pencapaian::where('slug','penakluk-minecraft-survival')->value('id');
        $idLulus      = Pencapaian::where('slug','lulus-program-pertama')->value('id');
        $idStoryteller= Pencapaian::where('slug','storyteller-handal')->value('id');

        $daftar = [
            [
                'nama'         => 'Beasiswa Penakluk Digital 2026',
                'slug'         => 'beasiswa-penakluk-digital-2026',
                'deskripsi'    => 'Beasiswa penuh untuk calon mahasiswa yang telah membuktikan kemampuan digital melalui penyelesaian achievement game. Khusus untuk pendaftar program K4 keatas.',
                'syarat'       => "- Warga Negara Indonesia\n- Usia 15–25 tahun\n- Telah meraih pencapaian Penakluk Minecraft Survival\n- Mengisi surat motivasi min. 200 kata",
                'pencapaian_wajib' => array_filter([$idMinecraft]),
                'tipe_manfaat' => 'penuh',
                'nilai_manfaat'=> 0,
                'kuota'        => 10,
                'buka_pada'    => now()->toDateString(),
                'tutup_pada'   => now()->addMonths(3)->toDateString(),
                'aktif'        => true,
            ],
            [
                'nama'         => 'Beasiswa Kreator Muda GELAR.ID',
                'slug'         => 'beasiswa-kreator-muda-gelar-id',
                'deskripsi'    => 'Subsidi biaya program studi untuk pelajar kreatif yang aktif di dunia storytelling, konten digital, atau game development.',
                'syarat'       => "- Pelajar SMA/sederajat atau fresh graduate\n- Telah meraih pencapaian Storyteller Handal\n- Komitmen menyelesaikan program dalam 1 tahun",
                'pencapaian_wajib' => array_filter([$idStoryteller]),
                'tipe_manfaat' => 'subsidi',
                'nilai_manfaat'=> 500000,
                'kuota'        => 25,
                'buka_pada'    => now()->toDateString(),
                'tutup_pada'   => now()->addMonths(2)->toDateString(),
                'aktif'        => true,
            ],
            [
                'nama'         => 'Beasiswa Alumni Berprestasi',
                'slug'         => 'beasiswa-alumni-berprestasi',
                'deskripsi'    => 'Beasiswa untuk melanjutkan ke program lebih tinggi bagi alumni yang telah menyelesaikan program pertama dengan hasil memuaskan.',
                'syarat'       => "- Telah lulus minimal 1 program di GELAR.ID\n- IPK minimal 3.00\n- Mendaftar ke program dengan jenis gelar lebih tinggi",
                'pencapaian_wajib' => array_filter([$idLulus]),
                'tipe_manfaat' => 'sebagian',
                'nilai_manfaat'=> 0,
                'kuota'        => 50,
                'buka_pada'    => now()->toDateString(),
                'tutup_pada'   => null,
                'aktif'        => true,
            ],
        ];

        foreach ($daftar as $data) {
            Beasiswa::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
