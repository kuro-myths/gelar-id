@extends('tataletak.aplikasi')
@section('judul','Tentang Gelar.id')
@section('konten')

{{-- Hero --}}
<section class="halftone py-20 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10 akan-muncul">
        <h1 class="judul-komik text-6xl md:text-7xl text-white mb-4"
            style="text-shadow:4px 4px 0 rgba(0,0,0,0.3);">TENTANG GELAR.ID</h1>
        <p class="text-blue-100 font-bold text-xl max-w-2xl mx-auto">
            Dari mimpi sederhana menjadi platform pendidikan virtual terbesar Indonesia
        </p>
    </div>
</section>

<div class="max-w-5xl mx-auto px-4 py-16 space-y-16">

    {{-- Sejarah Timeline --}}
    <div class="akan-muncul">
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-[#4361ee] text-white px-5 py-2 rounded-full text-sm font-black mb-4"
                 style="border:2px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                <i data-lucide="clock" class="w-4 h-4"></i>
                Perjalanan Kami
            </div>
            <h2 class="judul-komik text-5xl text-[#0f0e17]">SEJARAH GELAR.ID</h2>
        </div>

        <div class="relative">
            {{-- Garis vertikal --}}
            <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 bg-[#4361ee] rounded-full"
                 style="transform:translateX(-50%)"></div>

            @php
            $timeline = [
                ['tahun'=>'2022','judul'=>'Ide Awal Lahir','isi'=>'Bermula dari keprihatinan terhadap mahalnya biaya pendidikan formal di Indonesia. Sekelompok praktisi IT dan pendidik berkumpul untuk mencari solusi pendidikan digital yang terjangkau dan berkualitas.','ikon'=>'lightbulb','warna'=>'#ffd60a','kiri'=>true],
                ['tahun'=>'2023','judul'=>'Prototype Pertama','isi'=>'Platform pertama diluncurkan dengan 3 jenis gelar dan 10 program. Dalam 6 bulan pertama, lebih dari 100 pelajar bergabung dan memberikan feedback berharga untuk pengembangan lebih lanjut.','ikon'=>'rocket','warna'=>'#4361ee','kiri'=>false],
                ['tahun'=>'2024','judul'=>'Ekspansi Besar','isi'=>'Gelar.id berkembang menjadi 10 jenis gelar dan 14+ program studi. Sistem semester terkunci seperti Codedex, AI analisis minat, dan fitur pertemuan live diperkenalkan untuk pengalaman belajar yang lebih kaya.','ikon'=>'trending-up','warna'=>'#06d6a0','kiri'=>true],
                ['tahun'=>'2025','judul'=>'Kelas Pelajar Diluncurkan','isi'=>'Membuka akses pendidikan digital untuk pelajar SD, SMP, dan SMA dengan kelas-kelas khusus yang disesuaikan usia. Program gratis untuk pelajar berprestasi juga diluncurkan sebagai komitmen sosial.','ikon'=>'graduation-cap','warna'=>'#f72585','kiri'=>false],
                ['tahun'=>'2026','judul'=>'Masa Depan Cerah','isi'=>'Dengan ribuan alumni dan pengajar profesional, Gelar.id terus berkembang. Visi kami: menjadi platform kampus virtual paling dipercaya di Indonesia dengan sertifikat yang diakui dunia industri.','ikon'=>'star','warna'=>'#7209b7','kiri'=>true],
            ];
            @endphp

            <div class="space-y-12">
                @foreach($timeline as $item)
                <div class="relative flex items-start {{ $item['kiri'] ? 'md:flex-row' : 'md:flex-row-reverse' }} flex-row gap-8">
                    {{-- Ikon titik --}}
                    <div class="absolute left-8 md:left-1/2 w-10 h-10 rounded-full flex items-center justify-center text-white z-10"
                         style="background:{{ $item['warna'] }};border:3px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;transform:translateX(-50%);">
                        <i data-lucide="{{ $item['ikon'] }}" class="w-4 h-4"></i>
                    </div>

                    {{-- Konten --}}
                    <div class="ml-20 md:ml-0 md:w-5/12 kartu-komik p-6 {{ $item['kiri'] ? 'md:mr-auto md:ml-0' : 'md:ml-auto md:mr-0' }}"
                         style="border-color:{{ $item['warna'] }};box-shadow:5px 5px 0 {{ $item['warna'] }};">
                        <div class="judul-komik text-3xl mb-1" style="color:{{ $item['warna'] }}">{{ $item['tahun'] }}</div>
                        <h3 class="judul-komik text-xl text-[#0f0e17] mb-2">{{ $item['judul'] }}</h3>
                        <p class="text-sm font-semibold text-gray-600 leading-relaxed">{{ $item['isi'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Misi & Visi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 akan-muncul">
        <div class="kartu-komik p-7" style="background:#0f0e17;">
            <div class="w-12 h-12 rounded-2xl bg-[#4361ee] flex items-center justify-center mb-4"
                 style="border:3px solid #4361ee;box-shadow:3px 3px 0 #4361ee;">
                <i data-lucide="target" class="w-6 h-6 text-white"></i>
            </div>
            <h3 class="judul-komik text-3xl text-[#ffd60a] mb-3">MISI KAMI</h3>
            <p class="font-semibold text-gray-300 leading-relaxed">
                Mendemokratisasi akses pendidikan digital berkualitas untuk seluruh lapisan masyarakat Indonesia —
                dari siswa SD di pelosok desa hingga profesional di kota besar — tanpa batasan biaya, waktu, dan lokasi.
            </p>
        </div>
        <div class="kartu-komik p-7 bg-[#4361ee]">
            <div class="w-12 h-12 rounded-2xl bg-[#ffd60a] flex items-center justify-center mb-4"
                 style="border:3px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                <i data-lucide="eye" class="w-6 h-6 text-[#0f0e17]"></i>
            </div>
            <h3 class="judul-komik text-3xl text-white mb-3">VISI KAMI</h3>
            <p class="font-semibold text-blue-100 leading-relaxed">
                Menjadi platform kampus virtual paling dipercaya di Asia Tenggara pada 2030, dengan sertifikat
                yang diakui oleh 1.000+ perusahaan teknologi dan memberdayakan 1 juta pelajar Indonesia.
            </p>
        </div>
    </div>

    {{-- Nilai-Nilai --}}
    <div class="akan-muncul">
        <div class="text-center mb-10">
            <h2 class="judul-komik text-5xl text-[#0f0e17]">NILAI-NILAI KAMI</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @php $nilai = [
                ['ikon'=>'heart','judul'=>'Inklusif','isi'=>'Terbuka untuk semua — SD hingga profesional, dari kota hingga desa. Jalur gratis tersedia untuk yang membutuhkan.','warna'=>'#f72585'],
                ['ikon'=>'zap','judul'=>'Praktis','isi'=>'70% praktik, 30% teori. Kurikulum kami dirancang bersama industri agar langsung bisa diterapkan.','warna'=>'#ffd60a'],
                ['ikon'=>'shield-check','judul'=>'Terpercaya','isi'=>'Sertifikat dengan kode verifikasi unik. Setiap sertifikat bisa diverifikasi online kapanpun dan oleh siapapun.','warna'=>'#06d6a0'],
                ['ikon'=>'users','judul'=>'Komunitas','isi'=>'Bukan sekedar belajar — bergabunglah dengan komunitas alumni aktif yang saling support dan berbagi peluang.','warna'=>'#4361ee'],
                ['ikon'=>'trending-up','judul'=>'Progresif','isi'=>'Kurikulum diperbarui setiap semester mengikuti perkembangan industri teknologi yang terus bergerak cepat.','warna'=>'#7209b7'],
                ['ikon'=>'globe','judul'=>'Mandiri','isi'=>'Kami percaya setiap orang bisa berhasil dengan usahanya sendiri. Gelar.id membekali, bukan menjamin — karena keberhasilan ada di tanganmu.','warna'=>'#06B6D4'],
            ]; @endphp
            @foreach($nilai as $n)
            <div class="kartu-komik p-6 group">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110"
                     style="background:{{ $n['warna'] }}22;border:2px solid {{ $n['warna'] }};">
                    <i data-lucide="{{ $n['ikon'] }}" class="w-5 h-5" style="color:{{ $n['warna'] }}"></i>
                </div>
                <h4 class="judul-komik text-xl text-[#0f0e17] mb-2">{{ $n['judul'] }}</h4>
                <p class="text-sm font-semibold text-gray-500 leading-relaxed">{{ $n['isi'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Statistik --}}
    <div class="kartu-komik p-10 text-center bg-gradient-to-r from-[#0f0e17] to-[#1e3a8a] text-white akan-muncul">
        <h2 class="judul-komik text-4xl text-[#ffd60a] mb-8">DALAM ANGKA</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @foreach([
                ['nilai'=>$statistik['pengguna'],'label'=>'Mahasiswa & Pelajar','ikon'=>'users'],
                ['nilai'=>$statistik['program'],'label'=>'Program Studi','ikon'=>'book-open'],
                ['nilai'=>$statistik['sertifikat'],'label'=>'Sertifikat Diterbitkan','ikon'=>'award'],
                ['nilai'=>$statistik['gelar'],'label'=>'Jenis Gelar','ikon'=>'graduation-cap'],
                ['nilai'=>$statistik['pengajar'],'label'=>'Pengajar Ahli','ikon'=>'user-check'],
                ['nilai'=>$statistik['kelas'],'label'=>'Kelas Aktif','ikon'=>'layout-grid'],
            ] as $s)
            <div>
                <i data-lucide="{{ $s['ikon'] }}" class="w-8 h-8 mx-auto mb-2 text-[#4361ee]"></i>
                <div class="judul-komik text-5xl text-white" data-hitung="{{ $s['nilai'] }}">0</div>
                <p class="text-sm font-bold text-gray-400 mt-1">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- CTA --}}
    <div class="text-center akan-muncul">
        <h2 class="judul-komik text-4xl text-[#0f0e17] mb-4">BERGABUNGLAH BERSAMA KAMI</h2>
        <p class="text-gray-600 font-bold mb-8 max-w-xl mx-auto">
            Jadilah bagian dari gerakan pendidikan digital Indonesia yang terus tumbuh setiap hari.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/daftar" data-tautan-spa class="btn-komik px-8 py-4 bg-[#4361ee] text-white rounded-2xl text-lg">
                <i data-lucide="rocket" class="w-5 h-5"></i> Daftar Sekarang
            </a>
            <a href="/pengajar" data-tautan-spa class="btn-komik px-8 py-4 bg-[#ffd60a] text-[#0f0e17] rounded-2xl text-lg">
                <i data-lucide="users" class="w-5 h-5"></i> Lihat Pengajar
            </a>
        </div>
    </div>
</div>
@endsection
