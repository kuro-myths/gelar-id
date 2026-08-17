<?php

namespace App\Http\Controllers;

use App\Models\AnalisisMinat;
use App\Models\JenisGelar;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrollerAnalisisMinat extends Controller
{
    public static function pertanyaanKuis(): array
    {
        return [
            ['id'=>1,'pertanyaan'=>'Apa kegiatan yang paling kamu nikmati?','pilihan'=>['A'=>['teks'=>'Membangun sesuatu dengan teknologi & coding','skor'=>['sarjana_teknis'=>3,'vokasi_teknis'=>2]],'B'=>['teks'=>'Mendesain, menggambar, atau berkreasi visual','skor'=>['diploma_kreatif'=>3,'vokasi_bisnis'=>1]],'C'=>['teks'=>'Menganalisis data dan memecahkan masalah bisnis','skor'=>['vokasi_bisnis'=>3,'sarjana_teknis'=>1]],'D'=>['teks'=>'Menggunakan gadget dan menjelajahi internet','skor'=>['diploma_dasar'=>2,'vokasi_teknis'=>1]]]],
            ['id'=>2,'pertanyaan'=>'Berapa lama kamu bersedia belajar untuk mendapatkan gelar?','pilihan'=>['A'=>['teks'=>'4 tahun — saya ingin gelar setara sarjana penuh','skor'=>['sarjana_teknis'=>4]],'B'=>['teks'=>'2-3 tahun — cukup, yang penting siap kerja','skor'=>['vokasi_teknis'=>3,'vokasi_bisnis'=>2]],'C'=>['teks'=>'1-2 tahun — saya ingin cepat terjun ke dunia nyata','skor'=>['diploma_kreatif'=>3,'vokasi_bisnis'=>2]],'D'=>['teks'=>'3-6 bulan — mulai dari yang dasar dulu','skor'=>['diploma_dasar'=>4]]]],
            ['id'=>3,'pertanyaan'=>'Apa tujuan utama kamu mengikuti program ini?','pilihan'=>['A'=>['teks'=>'Mendirikan startup atau bisnis digital sendiri','skor'=>['vokasi_bisnis'=>3,'sarjana_teknis'=>2]],'B'=>['teks'=>'Mendapat pekerjaan di perusahaan teknologi','skor'=>['sarjana_teknis'=>3,'vokasi_teknis'=>3]],'C'=>['teks'=>'Berkarir sebagai freelancer kreatif','skor'=>['diploma_kreatif'=>4,'vokasi_bisnis'=>1]],'D'=>['teks'=>'Meningkatkan skill untuk pekerjaan saat ini','skor'=>['diploma_dasar'=>2,'diploma_kreatif'=>2]]]],
            ['id'=>4,'pertanyaan'=>'Seberapa nyaman kamu dengan coding/pemrograman?','pilihan'=>['A'=>['teks'=>'Sangat suka! Sudah pernah buat program sebelumnya','skor'=>['sarjana_teknis'=>4,'vokasi_teknis'=>2]],'B'=>['teks'=>'Tertarik belajar dari nol dengan panduan','skor'=>['vokasi_teknis'=>3,'sarjana_teknis'=>2]],'C'=>['teks'=>'Tidak terlalu tertarik, lebih suka non-teknis','skor'=>['vokasi_bisnis'=>3,'diploma_kreatif'=>2]],'D'=>['teks'=>'Belum pernah sama sekali, agak takut','skor'=>['diploma_dasar'=>3,'diploma_kreatif'=>2]]]],
            ['id'=>5,'pertanyaan'=>'Software apa yang sering kamu pakai atau ingin kuasai?','pilihan'=>['A'=>['teks'=>'VS Code, Terminal, Git — tools developer','skor'=>['sarjana_teknis'=>4,'vokasi_teknis'=>3]],'B'=>['teks'=>'Premiere Pro, CapCut, After Effects — video/kreatif','skor'=>['diploma_kreatif'=>4,'vokasi_bisnis'=>1]],'C'=>['teks'=>'Excel, Google Sheets, Power BI — data dan bisnis','skor'=>['vokasi_bisnis'=>4,'diploma_dasar'=>2]],'D'=>['teks'=>'Canva, Figma, Photoshop — desain grafis','skor'=>['diploma_kreatif'=>3,'vokasi_bisnis'=>2]]]],
            ['id'=>6,'pertanyaan'=>'Bagaimana kondisi waktumu untuk belajar?','pilihan'=>['A'=>['teks'=>'Full-time, tidak kerja — bisa fokus penuh','skor'=>['sarjana_teknis'=>3,'vokasi_teknis'=>2]],'B'=>['teks'=>'Sambil kerja, belajar malam dan weekend','skor'=>['diploma_kreatif'=>2,'vokasi_bisnis'=>2,'diploma_dasar'=>2]],'C'=>['teks'=>'Fleksibel, suka yang intensif dan cepat selesai','skor'=>['diploma_dasar'=>3,'diploma_kreatif'=>2]],'D'=>['teks'=>'Santai, 1-2 jam per hari sudah cukup','skor'=>['diploma_dasar'=>2,'vokasi_bisnis'=>1]]]],
            ['id'=>7,'pertanyaan'=>'Bidang mana yang paling menarik minatmu?','pilihan'=>['A'=>['teks'=>'Keamanan siber dan perlindungan data','skor'=>['sarjana_teknis'=>4]],'B'=>['teks'=>'E-commerce, marketing digital dan bisnis online','skor'=>['vokasi_bisnis'=>4]],'C'=>['teks'=>'Aplikasi mobile dan pengembangan web','skor'=>['vokasi_teknis'=>4,'sarjana_teknis'=>2]],'D'=>['teks'=>'Konten kreator, desain dan media sosial','skor'=>['diploma_kreatif'=>4]]]],
            ['id'=>8,'pertanyaan'=>'Apa latar belakang pendidikanmu saat ini?','pilihan'=>['A'=>['teks'=>'SMA/SMK IPA atau Informatika — sudah ada dasar','skor'=>['sarjana_teknis'=>2,'vokasi_teknis'=>2]],'B'=>['teks'=>'SMA/SMK IPS atau Bisnis — latar belakang sosial','skor'=>['vokasi_bisnis'=>2,'diploma_kreatif'=>1]],'C'=>['teks'=>'Sudah bekerja, tidak lanjut kuliah formal','skor'=>['diploma_dasar'=>2,'diploma_kreatif'=>2]],'D'=>['teks'=>'Baru lulus, masih mencari arah karir','skor'=>['diploma_dasar'=>2,'vokasi_bisnis'=>1]]]],
            ['id'=>9,'pertanyaan'=>'Bagaimana cara belajarmu yang paling efektif?','pilihan'=>['A'=>['teks'=>'Langsung praktek coding atau membuat proyek nyata','skor'=>['sarjana_teknis'=>3,'vokasi_teknis'=>3]],'B'=>['teks'=>'Menonton video tutorial step by step','skor'=>['diploma_kreatif'=>2,'diploma_dasar'=>2]],'C'=>['teks'=>'Diskusi kelompok dan belajar bersama teman','skor'=>['vokasi_bisnis'=>2,'sarjana_teknis'=>1]],'D'=>['teks'=>'Membaca materi dan mengerjakan latihan soal','skor'=>['sarjana_teknis'=>2,'vokasi_teknis'=>1]]]],
            ['id'=>10,'pertanyaan'=>'Dalam 3 tahun ke depan, gambaran hidupmu adalah...','pilihan'=>['A'=>['teks'=>'Bekerja sebagai engineer di perusahaan tech besar','skor'=>['sarjana_teknis'=>3,'vokasi_teknis'=>3]],'B'=>['teks'=>'Punya bisnis digital sendiri yang menghasilkan cuan','skor'=>['vokasi_bisnis'=>4,'sarjana_teknis'=>1]],'C'=>['teks'=>'Freelancer kreatif dengan portofolio keren','skor'=>['diploma_kreatif'=>4]],'D'=>['teks'=>'Naik jabatan di kantor dengan skill digital baru','skor'=>['diploma_dasar'=>3,'vokasi_bisnis'=>2]]]],
        ];
    }

    public function tampilKuis()
    {
        $pertanyaan = self::pertanyaanKuis();
        return view('analisis-minat.kuis', compact('pertanyaan'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'jawaban'   => 'required|array|size:10',
            'jawaban.*' => 'required|in:A,B,C,D',
        ]);

        $pertanyaanDaftar = self::pertanyaanKuis();
        $jawaban = $request->jawaban;

        $skor = ['sarjana_teknis'=>0,'vokasi_teknis'=>0,'vokasi_bisnis'=>0,'diploma_kreatif'=>0,'diploma_dasar'=>0];

        foreach ($pertanyaanDaftar as $p) {
            $id  = $p['id'];
            $jwb = $jawaban[$id] ?? null;
            if ($jwb && isset($p['pilihan'][$jwb])) {
                foreach ($p['pilihan'][$jwb]['skor'] as $kategori => $nilai) {
                    $skor[$kategori] = ($skor[$kategori] ?? 0) + $nilai;
                }
            }
        }

        arsort($skor);
        $kategoriTertinggi = array_key_first($skor);
        $nilaiTertinggi    = $skor[$kategoriTertinggi];

        $peta = [
            'sarjana_teknis'  => ['KVT.Kom','VT.Kom'],
            'vokasi_teknis'   => ['VT.Kom','KVT.Kom'],
            'vokasi_bisnis'   => ['V.Com','VTA.Kom'],
            'diploma_kreatif' => ['K3','K4'],
            'diploma_dasar'   => ['K1','K2'],
        ];
        $kodeGelar = $peta[$kategoriTertinggi] ?? ['K1'];

        $jenisGelarReko = JenisGelar::whereIn('kode', $kodeGelar)->first();
        $programReko    = null;
        if ($jenisGelarReko) {
            $programReko = Program::where('jenis_gelar_id', $jenisGelarReko->id)->aktif()->where('unggulan', true)->first()
                ?? Program::where('jenis_gelar_id', $jenisGelarReko->id)->aktif()->first();
        }

        $alasanMap = [
            'sarjana_teknis'  => 'Kamu menunjukkan minat kuat dalam membangun solusi teknologi. Kemampuan analitis dan kecintaanmu pada coding sangat cocok untuk jalur rekayasa perangkat lunak. Dengan KVT.Kom, kamu siap menjadi Software Engineer, Cloud Architect, atau CTO startup.',
            'vokasi_teknis'   => 'Kamu praktis dan ingin segera berkontribusi di industri teknologi. VT.Kom dirancang agar kamu siap kerja dalam 3 tahun dengan portofolio proyek nyata.',
            'vokasi_bisnis'   => 'Jiwa entrepreneur dan kemampuan bisnismu sangat menonjol. V.Com mempersiapkan kamu untuk dunia bisnis digital dan e-commerce yang terus berkembang pesat.',
            'diploma_kreatif' => 'Kreativitas adalah kekuatan terbesarmu. K3/K4 fokus pada desain, video editing, dan konten kreatif — skill yang sangat dicari di era media sosial.',
            'diploma_dasar'   => 'Kamu sedang memulai perjalanan digitalmu. K1 yang tersedia GRATIS adalah titik start sempurna — dari sana kamu bisa terus naik level!',
        ];

        $analisis = AnalisisMinat::create([
            'pengguna_id'                => Auth::id(),
            'sesi_id'                    => session()->getId(),
            'jawaban_kuis'               => $jawaban,
            'hasil_skor'                 => $skor,
            'jenis_gelar_rekomendasi_id' => $jenisGelarReko?->id,
            'program_rekomendasi_id'     => $programReko?->id,
            'alasan_rekomendasi'         => $alasanMap[$kategoriTertinggi] ?? '-',
            'skor_tertinggi'             => $nilaiTertinggi,
        ]);

        return redirect('/analisis-minat/hasil/' . $analisis->id);
    }

    public function hasil(AnalisisMinat $analisis)
    {
        $analisis->load(['jenisGelarRekomendasi', 'programRekomendasi.jenisGelar']);
        $semuaGelar = JenisGelar::aktif()->with('program')->get();
        $skor = $analisis->hasil_skor;

        return view('analisis-minat.hasil', compact('analisis', 'semuaGelar', 'skor'));
    }
}
