<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PenyeederKelas extends Seeder
{
    public function run(): void
    {
        // ===== 3 PENGAJAR DEMO =====
        $p1 = Pengguna::create([
            'nama'           => 'Rizki Pratama, S.Kom',
            'email'          => 'rizki.pengajar@gelar.test',
            'nama_pengguna'  => 'rizki_teach',
            'password'       => Hash::make('password'),
            'peran'          => 'pengajar',
            'aktif'          => true,
            'institusi'      => 'Universitas Terbuka Virtual',
            'keahlian'       => 'Web Development, Python, Cloud Computing',
            'bio'            => 'Software Engineer dengan 8 tahun pengalaman di industri teknologi. Telah mentoring 300+ pelajar Indonesia. Kontributor open source aktif.',
            'tampilkan_profil'=> true,
            'rating'         => 5,
            'total_pelajar'  => 342,
        ]);

        $p2 = Pengguna::create([
            'nama'           => 'Sari Indah Lestari, M.Ds',
            'email'          => 'sari.pengajar@gelar.test',
            'nama_pengguna'  => 'sari_design',
            'password'       => Hash::make('password'),
            'peran'          => 'pengajar',
            'aktif'          => true,
            'institusi'      => 'Institut Desain Digital Nusantara',
            'keahlian'       => 'UI/UX Design, Graphic Design, Figma, Adobe Suite, Video Editing',
            'bio'            => 'UI/UX Designer profesional dengan 200+ portofolio proyek. Trainer resmi Adobe Indonesia dan instruktur desain digital.',
            'tampilkan_profil'=> true,
            'rating'         => 5,
            'total_pelajar'  => 218,
        ]);

        $p3 = Pengguna::create([
            'nama'           => 'Ahmad Fauzi, S.E.',
            'email'          => 'ahmad.pengajar@gelar.test',
            'nama_pengguna'  => 'ahmad_bisnis',
            'password'       => Hash::make('password'),
            'peran'          => 'pengajar',
            'aktif'          => true,
            'institusi'      => 'Asosiasi Pengusaha Digital Indonesia',
            'keahlian'       => 'Digital Marketing, E-Commerce, Bisnis Digital, SEO, TikTok Shop',
            'bio'            => 'Entrepreneur digital dengan 5 startup berhasil. Konsultan pemasaran digital untuk 50+ UMKM. Pembicara di berbagai seminar bisnis digital.',
            'tampilkan_profil'=> true,
            'rating'         => 4,
            'total_pelajar'  => 156,
        ]);

        // ===== KELAS SD =====
        Kelas::create([
            'nama'           => 'Pengenalan Komputer untuk Anak SD',
            'slug'           => 'pengenalan-komputer-anak-sd',
            'deskripsi'      => 'Belajar mengenal komputer, mouse, keyboard, dan internet secara menyenangkan untuk anak SD kelas 4-6. Materi ringan, penuh animasi, dan interaktif!',
            'tingkat'        => 'sd',
            'kategori'       => 'Teknologi Dasar',
            'warna'          => '#EF4444',
            'label_badge'    => '🆓 GRATIS',
            'harga'          => 0,
            'jalur_gratis'   => true,
            'durasi_jam'     => 12,
            'jumlah_sesi'    => 8,
            'aktif'          => true,
            'unggulan'       => false,
            'pengajar_id'    => $p1->id,
            'yang_dipelajari'=> ['Mengenal perangkat komputer', 'Menggunakan mouse & keyboard', 'Browsing internet aman', 'Membuat dokumen Word sederhana', 'Mengirim email pertama'],
            'kurikulum'      => ['Sesi 1: Apa itu komputer?', 'Sesi 2: Bagian-bagian komputer', 'Sesi 3: Mengetik dengan keyboard', 'Sesi 4: Menggunakan mouse', 'Sesi 5: Internet & browsing aman', 'Sesi 6: Google & YouTube cerdas', 'Sesi 7: Microsoft Word dasar', 'Sesi 8: Proyek dokumen pertama'],
        ]);

        Kelas::create([
            'nama'           => 'Menggambar Digital Seru',
            'slug'           => 'menggambar-digital-seru-sd',
            'deskripsi'      => 'Buat karya seni digital yang keren! Belajar Canva dan MS Paint untuk membuat ilustrasi, kartu ulang tahun, dan konten kreatif.',
            'tingkat'        => 'sd',
            'kategori'       => 'Seni Digital',
            'warna'          => '#F97316',
            'label_badge'    => '🎨 POPULER',
            'harga'          => 75000,
            'jalur_gratis'   => false,
            'durasi_jam'     => 10,
            'jumlah_sesi'    => 6,
            'aktif'          => true,
            'unggulan'       => true,
            'pengajar_id'    => $p2->id,
            'yang_dipelajari'=> ['Dasar-dasar desain visual', 'Microsoft Paint & tools', 'Pengenalan Canva', 'Membuat kartu ucapan digital', 'Mengedit foto sederhana'],
            'kurikulum'      => ['Sesi 1: Mengenal Paint & tools', 'Sesi 2: Warna, bentuk & garis', 'Sesi 3: Membuat gambar sederhana', 'Sesi 4: Pengenalan Canva', 'Sesi 5: Template & elemen desain', 'Sesi 6: Proyek kartu ulang tahun'],
        ]);

        // ===== KELAS SMP =====
        Kelas::create([
            'nama'           => 'Coding Python untuk Pelajar SMP',
            'slug'           => 'coding-python-smp',
            'deskripsi'      => 'Belajar pemrograman Python dari nol untuk siswa SMP. Tidak perlu pengalaman coding! Mulai dari logika dasar hingga membuat program kalkulator sendiri.',
            'tingkat'        => 'smp',
            'kategori'       => 'Pemrograman',
            'warna'          => '#84CC16',
            'label_badge'    => '🔥 TERLARIS',
            'harga'          => 150000,
            'jalur_gratis'   => false,
            'durasi_jam'     => 20,
            'jumlah_sesi'    => 12,
            'aktif'          => true,
            'unggulan'       => true,
            'pengajar_id'    => $p1->id,
            'yang_dipelajari'=> ['Logika pemrograman dasar', 'Variabel & tipe data Python', 'Percabangan if/elif/else', 'Perulangan for & while', 'Membuat program kalkulator'],
            'kurikulum'      => ['Sesi 1-2: Pengenalan Python & instalasi', 'Sesi 3-4: Variabel & tipe data', 'Sesi 5-6: Input/output & string', 'Sesi 7-8: Kondisi if/elif/else', 'Sesi 9-10: Perulangan for/while', 'Sesi 11: Fungsi dasar', 'Sesi 12: Proyek kalkulator'],
        ]);

        Kelas::create([
            'nama'           => 'Desain Poster Digital OSIS',
            'slug'           => 'desain-poster-digital-osis',
            'deskripsi'      => 'Buat poster, banner, dan konten sosial media yang keren dengan Canva Pro. Ideal untuk pengurus OSIS dan kegiatan sekolah!',
            'tingkat'        => 'smp',
            'kategori'       => 'Desain Grafis',
            'warna'          => '#EAB308',
            'label_badge'    => '✨ BARU',
            'harga'          => 125000,
            'jalur_gratis'   => false,
            'durasi_jam'     => 15,
            'jumlah_sesi'    => 8,
            'aktif'          => true,
            'unggulan'       => false,
            'pengajar_id'    => $p2->id,
            'yang_dipelajari'=> ['Prinsip desain visual', 'Canva Pro fitur lengkap', 'Typography & teori warna', 'Membuat poster acara & OSIS', 'Konten Instagram & WhatsApp'],
            'kurikulum'      => ['Sesi 1-2: Prinsip desain & warna', 'Sesi 3-4: Canva Pro mastery', 'Sesi 5-6: Typography & layout', 'Sesi 7: Proyek poster acara sekolah', 'Sesi 8: Review & presentasi'],
        ]);

        // ===== KELAS SMA =====
        Kelas::create([
            'nama'           => 'Web Development untuk Pelajar SMA',
            'slug'           => 'web-development-sma',
            'deskripsi'      => 'Dari HTML hingga website pertamamu! Kelas intensif web development untuk siswa SMA yang ingin berkarir di dunia teknologi atau daftar kuliah informatika.',
            'tingkat'        => 'sma',
            'kategori'       => 'Web Development',
            'warna'          => '#4361ee',
            'label_badge'    => '⚡ INTENSIF',
            'harga'          => 250000,
            'jalur_gratis'   => false,
            'durasi_jam'     => 30,
            'jumlah_sesi'    => 16,
            'aktif'          => true,
            'unggulan'       => true,
            'pengajar_id'    => $p1->id,
            'yang_dipelajari'=> ['HTML5 & CSS3 modern', 'JavaScript interaktif', 'Responsive design dengan Bootstrap', 'Git & version control', 'Deploy website ke internet gratis'],
            'kurikulum'      => ['Sesi 1-3: HTML5 fondasi', 'Sesi 4-6: CSS3 & Flexbox', 'Sesi 7-8: JavaScript dasar', 'Sesi 9-10: DOM manipulation', 'Sesi 11-12: Bootstrap 5', 'Sesi 13-14: Responsive design', 'Sesi 15: Git & GitHub', 'Sesi 16: Deploy proyek portofolio'],
        ]);

        Kelas::create([
            'nama'           => 'Digital Marketing & Bisnis Online SMA',
            'slug'           => 'digital-marketing-sma',
            'deskripsi'      => 'Pelajari strategi pemasaran digital yang dipakai perusahaan besar. Dari Instagram Ads hingga SEO — cocok untuk siswa SMA yang ingin bisnis online sejak dini!',
            'tingkat'        => 'sma',
            'kategori'       => 'Digital Marketing',
            'warna'          => '#F59E0B',
            'label_badge'    => '💰 CUAN',
            'harga'          => 200000,
            'jalur_gratis'   => false,
            'durasi_jam'     => 20,
            'jumlah_sesi'    => 10,
            'aktif'          => true,
            'unggulan'       => false,
            'pengajar_id'    => $p3->id,
            'yang_dipelajari'=> ['Strategi pemasaran digital', 'Instagram & TikTok Ads', 'Copywriting & konten viral', 'Jualan di Shopee/Tokopedia', 'SEO & Google Ads dasar'],
            'kurikulum'      => ['Sesi 1-2: Digital marketing overview', 'Sesi 3-4: Social media marketing', 'Sesi 5-6: Content creation & copywriting', 'Sesi 7-8: Meta Ads & TikTok Ads', 'Sesi 9: SEO dasar', 'Sesi 10: Proyek kampanye produk nyata'],
        ]);

        // ===== KELAS UMUM =====
        Kelas::create([
            'nama'           => 'Video Editing Pemula (CapCut & Premiere)',
            'slug'           => 'video-editing-pemula',
            'deskripsi'      => 'Buat video yang keren untuk YouTube, TikTok, dan Instagram! Belajar CapCut mobile dan Adobe Premiere Pro dari nol — cocok semua usia.',
            'tingkat'        => 'umum',
            'kategori'       => 'Video Editing',
            'warna'          => '#7209b7',
            'label_badge'    => '🎬 VIRAL',
            'harga'          => 175000,
            'jalur_gratis'   => false,
            'durasi_jam'     => 18,
            'jumlah_sesi'    => 9,
            'aktif'          => true,
            'unggulan'       => true,
            'pengajar_id'    => $p2->id,
            'yang_dipelajari'=> ['Editing video dengan CapCut mobile', 'Adobe Premiere Pro dasar', 'Transisi & efek keren', 'Color grading pemula', 'Export untuk TikTok, YouTube, IG'],
            'kurikulum'      => ['Sesi 1-2: CapCut: dasar & fitur', 'Sesi 3: CapCut: transisi & musik', 'Sesi 4-5: Premiere Pro: interface & timeline', 'Sesi 6: Premiere Pro: cut & trim', 'Sesi 7: Color grading dasar', 'Sesi 8: Teks, efek & motion graphics', 'Sesi 9: Export & publish ke media sosial'],
        ]);

        Kelas::create([
            'nama'           => 'Keamanan Digital untuk Semua Usia',
            'slug'           => 'keamanan-digital-semua-usia',
            'deskripsi'      => 'Lindungi dirimu dari ancaman siber! Pelajari cara aman berinternet, mengenali hoaks, dan melindungi data pribadi — untuk semua kalangan usia.',
            'tingkat'        => 'umum',
            'kategori'       => 'Keamanan Digital',
            'warna'          => '#06d6a0',
            'label_badge'    => '🆓 GRATIS',
            'harga'          => 0,
            'jalur_gratis'   => true,
            'durasi_jam'     => 8,
            'jumlah_sesi'    => 4,
            'aktif'          => true,
            'unggulan'       => false,
            'pengajar_id'    => $p1->id,
            'yang_dipelajari'=> ['Kenali ancaman siber umum', 'Buat password kuat & aktifkan 2FA', 'Jaga privasi di media sosial', 'Kenali & hindari hoaks & phishing'],
            'kurikulum'      => ['Sesi 1: Ancaman siber & perlindungan', 'Sesi 2: Password aman & autentikasi 2 faktor', 'Sesi 3: Privasi & data pribadi online', 'Sesi 4: Bijak bermedia sosial & anti-hoaks'],
        ]);
    }
}
