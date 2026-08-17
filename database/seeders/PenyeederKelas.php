<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Pengguna;
use Illuminate\Database\Seeder;

class PenyeederKelas extends Seeder
{
    public function run(): void
    {
        // Gunakan pengajar yang sudah dibuat oleh PenyeederPengguna
        $p1 = Pengguna::where('email', 'rizki@gelar.test')->first();
        $p2 = Pengguna::where('email', 'sari@gelar.test')->first();
        $p3 = Pengguna::where('email', 'maya@gelar.test')->first();

        $daftarKelas = [
            // SD
            ['nama'=>'Pengenalan Komputer Anak SD','slug'=>'pengenalan-komputer-sd','tingkat'=>'sd','warna'=>'#EF4444','harga'=>0,'jalur_gratis'=>true,'durasi_jam'=>12,'jumlah_sesi'=>8,'unggulan'=>false,'label_badge'=>'🆓 GRATIS','deskripsi'=>'Belajar mengenal komputer, mouse, keyboard, dan internet secara menyenangkan untuk anak SD kelas 4–6. Materi ringan, penuh animasi, dan interaktif!','pengajar_id'=>$p1?->id,
              'yang_dipelajari'=>['Mengenal perangkat komputer','Mouse & keyboard','Browsing internet aman','Word sederhana','Email pertama'],
              'kurikulum'=>['Sesi 1: Apa itu komputer?','Sesi 2: Bagian komputer','Sesi 3: Mengetik','Sesi 4: Mouse','Sesi 5: Internet aman','Sesi 6: Google & YouTube','Sesi 7: Word dasar','Sesi 8: Proyek']],

            ['nama'=>'Menggambar Digital Seru','slug'=>'menggambar-digital-sd','tingkat'=>'sd','warna'=>'#F97316','harga'=>75000,'jalur_gratis'=>false,'durasi_jam'=>10,'jumlah_sesi'=>6,'unggulan'=>true,'label_badge'=>'🎨 POPULER','deskripsi'=>'Buat karya seni digital yang keren! Belajar Canva dan MS Paint untuk membuat ilustrasi, kartu ulang tahun, dan konten kreatif.','pengajar_id'=>$p2?->id,
              'yang_dipelajari'=>['Desain visual dasar','Microsoft Paint','Canva basic','Kartu ucapan digital','Edit foto sederhana'],
              'kurikulum'=>['Sesi 1: Paint & tools','Sesi 2: Warna & bentuk','Sesi 3: Gambar sederhana','Sesi 4: Canva intro','Sesi 5: Template','Sesi 6: Proyek kartu']],

            // SMP
            ['nama'=>'Coding Python untuk Pelajar SMP','slug'=>'coding-python-smp','tingkat'=>'smp','warna'=>'#84CC16','harga'=>150000,'jalur_gratis'=>false,'durasi_jam'=>20,'jumlah_sesi'=>12,'unggulan'=>true,'label_badge'=>'🔥 TERLARIS','deskripsi'=>'Belajar pemrograman Python dari nol untuk siswa SMP. Tidak perlu pengalaman coding! Mulai dari logika dasar hingga membuat program kalkulator sendiri.','pengajar_id'=>$p1?->id,
              'yang_dipelajari'=>['Logika pemrograman','Variabel Python','Percabangan if/else','Perulangan','Kalkulator program'],
              'kurikulum'=>['Sesi 1-2: Pengenalan Python','Sesi 3-4: Variabel & tipe data','Sesi 5-6: Input/output','Sesi 7-8: Kondisi','Sesi 9-10: Perulangan','Sesi 11: Fungsi','Sesi 12: Proyek kalkulator']],

            ['nama'=>'Desain Poster Digital OSIS','slug'=>'desain-poster-osis','tingkat'=>'smp','warna'=>'#EAB308','harga'=>125000,'jalur_gratis'=>false,'durasi_jam'=>15,'jumlah_sesi'=>8,'unggulan'=>false,'label_badge'=>'✨ BARU','deskripsi'=>'Buat poster, banner, dan konten sosial media yang keren dengan Canva Pro. Ideal untuk pengurus OSIS dan kegiatan sekolah!','pengajar_id'=>$p2?->id,
              'yang_dipelajari'=>['Prinsip desain visual','Canva Pro','Typography','Poster OSIS','Konten IG & WA'],
              'kurikulum'=>['Sesi 1-2: Prinsip desain','Sesi 3-4: Canva mastery','Sesi 5-6: Typography','Sesi 7: Poster acara','Sesi 8: Review']],

            // SMA
            ['nama'=>'Web Development untuk Pelajar SMA','slug'=>'web-development-sma','tingkat'=>'sma','warna'=>'#4361ee','harga'=>250000,'jalur_gratis'=>false,'durasi_jam'=>30,'jumlah_sesi'=>16,'unggulan'=>true,'label_badge'=>'⚡ INTENSIF','deskripsi'=>'Dari HTML hingga website pertamamu! Kelas intensif web development untuk siswa SMA yang ingin berkarir di dunia teknologi.','pengajar_id'=>$p1?->id,
              'yang_dipelajari'=>['HTML5 & CSS3','JavaScript','Responsive design','Git & GitHub','Deploy website'],
              'kurikulum'=>['Sesi 1-3: HTML5','Sesi 4-6: CSS3 Flexbox','Sesi 7-8: JavaScript','Sesi 9-10: DOM','Sesi 11-12: Bootstrap','Sesi 13-14: Responsive','Sesi 15: Git','Sesi 16: Deploy']],

            ['nama'=>'Digital Marketing & Bisnis Online','slug'=>'digital-marketing-sma','tingkat'=>'sma','warna'=>'#F59E0B','harga'=>200000,'jalur_gratis'=>false,'durasi_jam'=>20,'jumlah_sesi'=>10,'unggulan'=>false,'label_badge'=>'💰 CUAN','deskripsi'=>'Pelajari strategi pemasaran digital. Dari Instagram Ads hingga SEO — cocok untuk siswa SMA yang ingin bisnis online sejak dini!','pengajar_id'=>$p3?->id,
              'yang_dipelajari'=>['Digital marketing','Instagram & TikTok Ads','Copywriting','Jualan di marketplace','SEO dasar'],
              'kurikulum'=>['Sesi 1-2: Overview','Sesi 3-4: Social media','Sesi 5-6: Content','Sesi 7-8: Meta & TikTok Ads','Sesi 9: SEO','Sesi 10: Proyek']],

            // Umum
            ['nama'=>'Video Editing Pemula (CapCut & Premiere)','slug'=>'video-editing-pemula','tingkat'=>'umum','warna'=>'#7209b7','harga'=>175000,'jalur_gratis'=>false,'durasi_jam'=>18,'jumlah_sesi'=>9,'unggulan'=>true,'label_badge'=>'🎬 VIRAL','deskripsi'=>'Buat video keren untuk YouTube, TikTok, dan Instagram! Belajar CapCut & Adobe Premiere Pro dari nol.','pengajar_id'=>$p2?->id,
              'yang_dipelajari'=>['CapCut mobile editing','Premiere Pro dasar','Transisi & efek','Color grading','Export untuk semua platform'],
              'kurikulum'=>['Sesi 1-2: CapCut dasar','Sesi 3: CapCut transisi','Sesi 4-5: Premiere interface','Sesi 6: Cut & trim','Sesi 7: Color grading','Sesi 8: Efek & teks','Sesi 9: Export & publish']],

            ['nama'=>'Keamanan Digital untuk Semua Usia','slug'=>'keamanan-digital-semua','tingkat'=>'umum','warna'=>'#06d6a0','harga'=>0,'jalur_gratis'=>true,'durasi_jam'=>8,'jumlah_sesi'=>4,'unggulan'=>false,'label_badge'=>'🆓 GRATIS','deskripsi'=>'Lindungi dirimu dari ancaman siber! Cara aman berinternet, mengenali hoaks, dan melindungi data pribadi.','pengajar_id'=>$p1?->id,
              'yang_dipelajari'=>['Ancaman siber','Password kuat & 2FA','Privasi media sosial','Anti hoaks & phishing'],
              'kurikulum'=>['Sesi 1: Ancaman siber','Sesi 2: Password & 2FA','Sesi 3: Privasi','Sesi 4: Anti hoaks']],
        ];

        foreach ($daftarKelas as $k) {
            if (!Kelas::where('slug', $k['slug'])->exists()) {
                Kelas::create(array_merge($k, ['aktif' => true]));
            }
        }
    }
}
