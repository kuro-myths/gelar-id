<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Semester;
use App\Models\SesiBelajar;
use Illuminate\Database\Seeder;

class PenyeederSemester extends Seeder
{
    public function run(): void
    {
        // Tambah semester & sesi hanya untuk program K1 (gratis) sebagai contoh uji coba
        $k1 = Program::whereHas('jenisGelar', fn($q) => $q->where('kode', 'K1'))->first();
        if (!$k1) return;

        $semester = Semester::firstOrCreate(
            ['program_id' => $k1->id, 'nomor' => 1],
            ['nama' => 'Semester 1 — Literasi Digital Dasar', 'aktif' => true]
        );

        $sesi = [
            ['nama' => 'Pengenalan Komputer & Perangkat Digital', 'urutan' => 1],
            ['nama' => 'Sistem Operasi Windows 11', 'urutan' => 2],
            ['nama' => 'Internet & Browsing Aman', 'urutan' => 3],
            ['nama' => 'Email Profesional (Gmail & Outlook)', 'urutan' => 4],
            ['nama' => 'Media Sosial Positif & Produktif', 'urutan' => 5],
            ['nama' => 'Keamanan Digital & Anti-Hoaks', 'urutan' => 6],
            ['nama' => 'Praktik Produktivitas Harian', 'urutan' => 7],
        ];

        foreach ($sesi as $s) {
            SesiBelajar::firstOrCreate(
                ['semester_id' => $semester->id, 'pertemuan_ke' => $s['urutan']],
                [
                    'judul'        => $s['nama'],
                    'durasi_menit' => 60,
                    'aktif'        => true,
                    'tipe'         => 'mandiri',
                    'mulai_pada'   => now()->addDays($s['urutan'] * 7),
                    'selesai_pada' => now()->addDays($s['urutan'] * 7 + 1),
                ]
            );
        }

        // Semester untuk program VT.Kom Web Full-Stack sebagai contoh
        $vtKom = Program::where('nama', 'like', '%Full-Stack%')->first();
        if ($vtKom) {
            for ($i = 1; $i <= 3; $i++) {
                $sem = Semester::firstOrCreate(
                    ['program_id' => $vtKom->id, 'nomor' => $i],
                    ['nama' => "Semester {$i}", 'aktif' => true]
                );
                for ($j = 1; $j <= 4; $j++) {
                    SesiBelajar::firstOrCreate(
                        ['semester_id' => $sem->id, 'pertemuan_ke' => $j],
                        [
                            'judul'        => "Sesi {$j} — Modul Semester {$i}",
                            'durasi_menit' => 90,
                            'aktif'        => true,
                            'tipe'         => 'online',
                            'mulai_pada'   => now()->addWeeks(($i-1)*4 + $j),
                            'selesai_pada' => now()->addWeeks(($i-1)*4 + $j)->addHours(2),
                        ]
                    );
                }
            }
        }
    }
}
