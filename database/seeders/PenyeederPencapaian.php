<?php

namespace Database\Seeders;

use App\Models\Pencapaian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PenyeederPencapaian extends Seeder
{
    public function run(): void
    {
        $daftar = [
            // ===== GAME & TANTANGAN =====
            [
                'nama'     => 'Penakluk Minecraft Survival',
                'ikon'     => '⛏️',
                'warna'    => '#8B5CF6',
                'kategori' => 'game',
                'tipe_syarat' => 'upload',
                'poin'     => 150,
                'deskripsi'=> 'Selesaikan semua achievement Minecraft mode Survival (termasuk "The End" dan "Free the End"). Unggah screenshot achievement screen.',
                'syarat'   => ['tipe'=>'upload','keterangan'=>'Screenshot achievement Minecraft — semua tanda centang hijau'],
                'adalah_prasyarat_beasiswa' => true,
                'urutan'   => 1,
            ],
            [
                'nama'     => 'Storyteller Handal',
                'ikon'     => '📖',
                'warna'    => '#F59E0B',
                'kategori' => 'game',
                'tipe_syarat' => 'upload',
                'poin'     => 120,
                'deskripsi'=> 'Selesaikan semua chapter cerita di platform storytelling digital (Wattpad, NovelAI, dll.) atau buat cerita dengan minimal 10.000 kata yang dipublikasikan.',
                'syarat'   => ['tipe'=>'upload','keterangan'=>'Link cerita yang dipublikasikan atau screenshot progress chapter'],
                'adalah_prasyarat_beasiswa' => true,
                'urutan'   => 2,
            ],
            [
                'nama'     => 'Maestro Among Us',
                'ikon'     => '🎭',
                'warna'    => '#EF4444',
                'kategori' => 'game',
                'tipe_syarat' => 'upload',
                'poin'     => 80,
                'deskripsi'=> 'Menangkan 10 ronde sebagai Impostor di Among Us. Kirimkan screenshot riwayat kemenangan.',
                'syarat'   => ['tipe'=>'upload','keterangan'=>'Screenshot stats Impostor wins minimal 10'],
                'adalah_prasyarat_beasiswa' => false,
                'urutan'   => 3,
            ],
            [
                'nama'     => 'Speedrunner Digital',
                'ikon'     => '⚡',
                'warna'    => '#06d6a0',
                'kategori' => 'game',
                'tipe_syarat' => 'upload',
                'poin'     => 200,
                'deskripsi'=> 'Selesaikan kursus online manapun dalam waktu record tercepat di GELAR.ID (semua sesi dalam 7 hari). Sistem akan memverifikasi otomatis.',
                'syarat'   => ['tipe'=>'upload','keterangan'=>'Screenshot kemajuan kursus dengan tanggal mulai dan selesai'],
                'adalah_prasyarat_beasiswa' => true,
                'urutan'   => 4,
            ],

            // ===== AKADEMIK =====
            [
                'nama'     => 'Lulus Program Pertama',
                'ikon'     => '🎓',
                'warna'    => '#4361ee',
                'kategori' => 'akademik',
                'tipe_syarat' => 'otomatis',
                'poin'     => 300,
                'deskripsi'=> 'Selesaikan program studi pertama di GELAR.ID dan terima sertifikat kelulusan.',
                'syarat'   => ['tipe'=>'selesai_program','nilai'=>1,'keterangan'=>'Otomatis diberikan saat status pendaftaran berubah menjadi selesai'],
                'adalah_prasyarat_beasiswa' => true,
                'urutan'   => 10,
            ],
            [
                'nama'     => 'Bintang Akademik',
                'ikon'     => '⭐',
                'warna'    => '#ffd60a',
                'kategori' => 'akademik',
                'tipe_syarat' => 'otomatis',
                'poin'     => 200,
                'deskripsi'=> 'Mendaftar ke program studi pertama di GELAR.ID.',
                'syarat'   => ['tipe'=>'daftar_program','nilai'=>1,'keterangan'=>'Otomatis saat pertama kali daftar program'],
                'adalah_prasyarat_beasiswa' => false,
                'urutan'   => 11,
            ],
            [
                'nama'     => 'Penjelajah Kuesioner',
                'ikon'     => '📋',
                'warna'    => '#7209b7',
                'kategori' => 'kuesioner',
                'tipe_syarat' => 'otomatis',
                'poin'     => 50,
                'deskripsi'=> 'Isi kuesioner pertama di platform GELAR.ID.',
                'syarat'   => ['tipe'=>'isi_kuesioner','nilai'=>1,'keterangan'=>'Otomatis setelah submit kuesioner'],
                'adalah_prasyarat_beasiswa' => false,
                'urutan'   => 20,
            ],

            // ===== KEHADIRAN =====
            [
                'nama'     => 'Peserta Setia',
                'ikon'     => '📅',
                'warna'    => '#06B6D4',
                'kategori' => 'kehadiran',
                'tipe_syarat' => 'otomatis',
                'poin'     => 100,
                'deskripsi'=> 'Hadiri 5 pertemuan online di GELAR.ID.',
                'syarat'   => ['tipe'=>'hadir_pertemuan','nilai'=>5,'keterangan'=>'Otomatis setelah hadir 5 pertemuan'],
                'adalah_prasyarat_beasiswa' => false,
                'urutan'   => 30,
            ],

            // ===== SOSIAL =====
            [
                'nama'     => 'Duta GELAR.ID',
                'ikon'     => '🤝',
                'warna'    => '#10B981',
                'kategori' => 'sosial',
                'tipe_syarat' => 'manual',
                'poin'     => 100,
                'deskripsi'=> 'Berhasil mengajak minimal 3 teman bergabung ke GELAR.ID dan mendaftar program.',
                'syarat'   => ['tipe'=>'referral','nilai'=>3,'keterangan'=>'Admin verifikasi dengan mengirim bukti ajakan'],
                'adalah_prasyarat_beasiswa' => false,
                'urutan'   => 40,
            ],

            // ===== KHUSUS =====
            [
                'nama'     => 'Pionir GELAR.ID',
                'ikon'     => '🚀',
                'warna'    => '#f72585',
                'kategori' => 'khusus',
                'tipe_syarat' => 'manual',
                'poin'     => 500,
                'deskripsi'=> 'Penghargaan khusus dari admin untuk kontribusi luar biasa dalam komunitas GELAR.ID.',
                'syarat'   => ['tipe'=>'manual','keterangan'=>'Diberikan langsung oleh admin'],
                'adalah_prasyarat_beasiswa' => true,
                'urutan'   => 50,
            ],
        ];

        foreach ($daftar as $data) {
            Pencapaian::firstOrCreate(
                ['slug' => Str::slug($data['nama'])],
                array_merge($data, ['aktif' => true])
            );
        }
    }
}
