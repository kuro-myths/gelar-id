@extends('tataletak.aplikasi')
@section('judul','Beranda')
@section('konten')

{{-- ===== HERO ===== --}}
<section class="halftone min-h-screen flex items-center py-16 relative overflow-hidden">

    {{-- Dekorasi background --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div id="lingkaran-1" class="absolute w-96 h-96 rounded-full opacity-20 -top-20 -right-20"
             style="background:radial-gradient(circle,#ffd60a,transparent);"></div>
        <div id="lingkaran-2" class="absolute w-64 h-64 rounded-full opacity-20 bottom-20 -left-10"
             style="background:radial-gradient(circle,#f72585,transparent);"></div>
        {{-- Grid dots --}}
        <div class="absolute inset-0" style="background-image:radial-gradient(#ffffff10 1.5px,transparent 1.5px);background-size:28px 28px;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Teks Hero --}}
            <div id="hero-teks">
                <div id="hero-badge" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur border border-white/20 rounded-full px-4 py-2 text-white text-sm font-bold mb-6">
                    <span class="w-2 h-2 bg-[#06d6a0] rounded-full animate-pulse"></span>
                    🇮🇩 Platform Kampus Virtual Indonesia
                </div>

                <h1 id="hero-judul" class="judul-komik text-6xl md:text-7xl xl:text-8xl text-white leading-none mb-6"
                    style="text-shadow:4px 4px 0 rgba(0,0,0,0.3);">
                    RAIH<br>
                    <span id="teks-animasi" class="text-[#ffd60a]">GELARMU</span><br>
                    SEKARANG!
                </h1>

                <p id="hero-sub" class="text-blue-100 text-lg font-bold mb-8 max-w-lg leading-relaxed">
                    KVT.Kom · VT.Kom · VTA.Kom · V.Com · K1–K6<br>
                    Kurikulum nyata, belajar fleksibel, sertifikat terverifikasi.
                </p>

                <div id="hero-tombol" class="flex flex-col sm:flex-row gap-4">
                    <a href="/program" data-tautan-spa
                       class="btn-komik px-8 py-4 bg-[#ffd60a] text-[#0f0e17] rounded-2xl text-lg">
                        <i data-lucide="rocket" class="w-5 h-5"></i>
                        Mulai Sekarang!
                    </a>
                    <a href="/gelar" data-tautan-spa
                       class="btn-komik px-8 py-4 bg-white/10 backdrop-blur text-white border-white/30 rounded-2xl text-lg hover:bg-white/20">
                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                        Lihat Gelar
                    </a>
                </div>

                {{-- Trust badges --}}
                <div id="hero-trust" class="flex flex-wrap items-center gap-3 mt-8">
                    @foreach([
                        ['ikon'=>'check-circle','teks'=>'Gratis daftar',    'warna'=>'#06d6a0'],
                        ['ikon'=>'award',        'teks'=>'Sertifikat resmi', 'warna'=>'#ffd60a'],
                        ['ikon'=>'zap',          'teks'=>'Mulai hari ini',  'warna'=>'#f72585'],
                        ['ikon'=>'graduation-cap','teks'=>'10 jenis gelar', 'warna'=>'#a78bfa'],
                    ] as $badge)
                    <span class="inline-flex items-center gap-1.5 text-xs font-black text-white/90 bg-white/10 px-3 py-1.5 rounded-full border border-white/20 backdrop-blur">
                        <i data-lucide="{{ $badge['ikon'] }}" class="w-3.5 h-3.5" style="color:{{ $badge['warna'] }}"></i>
                        {{ $badge['teks'] }}
                    </span>
                    @endforeach
                </div>
            </div>

            {{-- Kartu Statistik --}}
            <div id="hero-statistik" class="grid grid-cols-2 gap-4">
                @php
                $statItems = [
                    ['nilai'=>$statistik['pengguna'],'label'=>'Mahasiswa Aktif','ikon'=>'users','bg'=>'bg-[#f72585]','teks'=>'text-white'],
                    ['nilai'=>$statistik['program'],'label'=>'Program Studi','ikon'=>'book-open','bg'=>'bg-[#06d6a0]','teks'=>'text-[#0f0e17]'],
                    ['nilai'=>$statistik['sertifikat'],'label'=>'Sertifikat Terbit','ikon'=>'award','bg'=>'bg-[#ffd60a]','teks'=>'text-[#0f0e17]'],
                    ['nilai'=>$statistik['gelar'],'label'=>'Jenis Gelar','ikon'=>'graduation-cap','bg'=>'bg-white/20','teks'=>'text-white'],
                ];
                @endphp
                @foreach($statItems as $i => $s)
                <div class="kartu-komik p-6 {{ $s['bg'] }} {{ $s['teks'] }} stat-kartu"
                     style="animation-delay:{{ $i*0.1 }}s">
                    <i data-lucide="{{ $s['ikon'] }}" class="w-8 h-8 mb-3 opacity-80"></i>
                    <div class="judul-komik text-5xl angka-hitung" data-hitung="{{ $s['nilai'] }}">0</div>
                    <div class="text-sm font-black mt-1 opacity-80">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/60 animate-bounce">
            <span class="text-xs font-bold">Scroll</span>
            <i data-lucide="chevrons-down" class="w-5 h-5"></i>
        </div>
    </div>
</section>

{{-- ===== JENIS GELAR ===== --}}
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14 akan-muncul">
            <div class="inline-flex items-center gap-2 bg-[#4361ee] text-white px-6 py-2.5 rounded-full text-sm font-black mb-4 border-2 border-[#0f0e17] shadow-[3px_3px_0_#0f0e17]">
                <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                10 Jenis Gelar Tersedia
            </div>
            <h2 class="judul-komik text-5xl md:text-6xl text-[#0f0e17] mb-3">PILIH JALUR GELARMU!</h2>
            <p class="text-gray-500 font-bold max-w-xl mx-auto">Dari pemula (K1 gratis!) hingga setara sarjana terapan (KVT.Kom)</p>
        </div>

        {{-- Slider Gelar --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($jenisGelar as $i => $gelar)
            <a href="/gelar/{{ $gelar->kode }}" data-tautan-spa
               class="kartu-komik p-5 text-center group akan-muncul relative overflow-hidden"
               style="animation-delay:{{ $i*0.07 }}s">
                {{-- Badge gratis untuk K1 --}}
                @if($gelar->kode === 'K1')
                <div class="absolute top-2 right-2 badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">GRATIS</div>
                @endif

                {{-- Ikon gelar --}}
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-black mx-auto mb-3 group-hover:scale-110 transition-transform duration-300"
                     style="background:{{ $gelar->warna }};border:3px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                    <span class="judul-komik text-base leading-none">{{ $gelar->kode }}</span>
                </div>

                <h3 class="judul-komik text-xl text-[#0f0e17] group-hover:text-[#4361ee] transition-colors">{{ $gelar->kode }}</h3>
                <p class="text-xs font-bold text-gray-500 mt-1 leading-tight">{{ $gelar->nama }}</p>

                <div class="flex items-center justify-between mt-3 text-xs font-black text-gray-400">
                    <span>⏱️ {{ $gelar->durasi_tahun }}</span>
                    <span class="badge-komik text-white text-xs px-2 py-0.5" style="background:{{ $gelar->warna }};border-color:#0f0e17;">{{ $gelar->jumlah_semester }}Smt</span>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-8 akan-muncul">
            <a href="/gelar" data-tautan-spa class="btn-komik px-6 py-3 bg-[#0f0e17] text-white rounded-xl inline-flex">
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                Lihat Detail Semua Gelar
            </a>
        </div>
    </div>
</section>

{{-- ZIGZAG DIVIDER --}}
<div style="background-color:#f0f4ff;background-image:linear-gradient(135deg,white 25%,transparent 25%) -12px 0,linear-gradient(225deg,white 25%,transparent 25%) -12px 0,linear-gradient(315deg,white 25%,transparent 25%),linear-gradient(45deg,white 25%,transparent 25%);background-size:24px 24px;height:24px;"></div>

{{-- ===== PROGRAM UNGGULAN ===== --}}
@if($programUnggulan->count())
<section class="py-20 bg-[#f0f4ff]">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-end justify-between mb-10 akan-muncul">
            <div>
                <div class="inline-flex items-center gap-2 bg-[#f72585] text-white px-5 py-2 rounded-full text-sm font-black mb-3 border-2 border-[#0f0e17] shadow-[3px_3px_0_#0f0e17]">
                    <i data-lucide="flame" class="w-4 h-4"></i>
                    Paling Diminati
                </div>
                <h2 class="judul-komik text-5xl text-[#0f0e17]">PROGRAM UNGGULAN</h2>
            </div>
            <a href="/program" data-tautan-spa class="hidden md:flex btn-komik px-5 py-3 bg-[#0f0e17] text-white rounded-xl text-sm">
                <i data-lucide="layout-grid" class="w-4 h-4"></i>
                Semua Program
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($programUnggulan as $i => $prog)
            <div class="kartu-komik overflow-hidden akan-muncul flex flex-col" style="animation-delay:{{ $i*0.1 }}s">
                {{-- Strip warna --}}
                <div class="h-2.5" style="background:{{ $prog->jenisGelar->warna }}"></div>
                <div class="p-5 flex flex-col flex-1">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <span class="badge-komik text-white text-xs" style="background:{{ $prog->jenisGelar->warna }};border-color:#0f0e17;">
                                {{ $prog->jenisGelar->kode }}
                            </span>
                            @if($prog->label_badge)
                            <span class="badge-komik text-white text-xs" style="background:{{ $prog->warna_badge ?? '#4361ee' }};border-color:#0f0e17;">
                                {{ $prog->label_badge }}
                            </span>
                            @endif
                        </div>
                        <div class="text-right">
                            @if($prog->gratis)
                                <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">🆓 GRATIS</span>
                            @else
                                @if($prog->ada_diskon)
                                <div class="flex flex-col items-end">
                                    <span class="harga-coret">Rp {{ number_format($prog->harga_coret,0,',','.') }}</span>
                                    <span class="judul-komik text-lg text-[#0f0e17] leading-none">Rp {{ number_format($prog->harga,0,',','.') }}</span>
                                    <span class="badge-diskon mt-0.5">HEMAT {{ $prog->porsen_diskon }}%</span>
                                </div>
                                @else
                                <span class="judul-komik text-lg text-[#0f0e17]">Rp {{ number_format($prog->harga,0,',','.') }}</span>
                                @endif
                            @endif
                        </div>
                    </div>

                    <h3 class="font-black text-[#0f0e17] text-lg mb-2 leading-snug">{{ $prog->nama }}</h3>
                    <p class="text-sm font-semibold text-gray-500 mb-4 line-clamp-2 flex-1">{{ $prog->deskripsi }}</p>

                    {{-- Info baris --}}
                    <div class="flex items-center gap-3 text-xs font-black text-gray-400 mb-4 border-t border-gray-100 pt-3">
                        <span class="flex items-center gap-1"><i data-lucide="users" class="w-3.5 h-3.5"></i>{{ $prog->jumlah_peserta }}</span>
                        <span class="flex items-center gap-1"><i data-lucide="layers" class="w-3.5 h-3.5"></i>{{ $prog->jenisGelar->jumlah_semester }} Semester</span>
                        <span class="flex items-center gap-1"><i data-lucide="book" class="w-3.5 h-3.5"></i>{{ $prog->jenisGelar->sks_dibutuhkan }} SKS</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="/gelar/{{ $prog->jenisGelar->kode }}" data-tautan-spa
                           class="btn-komik px-3 py-2 bg-gray-100 text-[#0f0e17] rounded-xl text-xs flex-shrink-0">
                            <i data-lucide="info" class="w-3.5 h-3.5"></i>
                        </a>
                        @auth
                        <form method="POST" action="/pengguna/daftar/{{ $prog->id }}" class="flex-1">
                            @csrf
                            <button type="submit" class="btn-komik w-full py-2 text-white text-sm rounded-xl"
                                    style="background:{{ $prog->jenisGelar->warna }}">
                                <i data-lucide="zap" class="w-4 h-4"></i>
                                Daftar Sekarang!
                            </button>
                        </form>
                        @else
                        <a href="/masuk" data-tautan-spa class="btn-komik flex-1 py-2 bg-[#4361ee] text-white text-sm rounded-xl text-center">
                            <i data-lucide="log-in" class="w-4 h-4"></i>
                            Masuk & Daftar
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== JALUR GRATIS ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="kartu-komik overflow-hidden akan-muncul" style="background:linear-gradient(135deg,#06d6a0 0%,#4361ee 100%);">
            <div class="p-10 md:p-14 text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/20 border border-white/30 rounded-full px-4 py-2 text-sm font-black mb-4">
                            <i data-lucide="gift" class="w-4 h-4"></i>
                            Program Sosial Gelar.id
                        </div>
                        <h2 class="judul-komik text-5xl mb-4" style="text-shadow:3px 3px 0 rgba(0,0,0,0.2);">
                            JALUR GRATIS<br>UNTUK SEMUA!
                        </h2>
                        <p class="font-bold text-white/90 leading-relaxed mb-6">
                            K1 Literasi Digital Dasar <strong>100% GRATIS</strong> untuk Warga Negara Indonesia.
                            Tidak ada syarat pendidikan — siapapun bisa mulai!
                        </p>
                        <a href="/program?gelar=K1" data-tautan-spa class="btn-komik px-7 py-4 bg-[#ffd60a] text-[#0f0e17] rounded-2xl text-lg inline-flex">
                            <i data-lucide="gift" class="w-5 h-5"></i>
                            Ambil Program Gratis!
                        </a>
                    </div>
                    <div class="space-y-3">
                        @foreach(['✅ Warga Negara Indonesia', '✅ Belum pernah ikut K1 sebelumnya', '✅ Isi formulir pendaftaran lengkap', '✅ Komitmen ikuti min. 80% sesi', '🎁 Sertifikat gratis setelah selesai'] as $syarat)
                        <div class="bg-white/15 rounded-xl px-4 py-3 font-bold text-sm">
                            {{ $syarat }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== CARA MENDAPATKAN GELAR ===== --}}
<section class="py-20 bg-[#f0f4ff]">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-14 akan-muncul">
            <h2 class="judul-komik text-5xl text-[#0f0e17] mb-3">4 LANGKAH MUDAH!</h2>
            <p class="text-gray-500 font-bold">Proses transparannya sesimpel ini</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php $langkah = [
                ['no'=>'01','ikon'=>'user-plus','judul'=>'Buat Akun','isi'=>'Daftar gratis dan lengkapi profil dalam 2 menit','warna'=>'bg-[#f72585]','teks'=>'text-white'],
                ['no'=>'02','ikon'=>'search','judul'=>'Pilih Program','isi'=>'Temukan program yang sesuai tujuan dan budget','warna'=>'bg-[#4361ee]','teks'=>'text-white'],
                ['no'=>'03','ikon'=>'monitor','judul'=>'Ikuti Pembelajaran','isi'=>'Sesi online, kuesioner, dan proyek nyata','warna'=>'bg-[#06d6a0]','teks'=>'text-[#0f0e17]'],
                ['no'=>'04','ikon'=>'award','judul'=>'Raih Gelar','isi'=>'Sertifikat otomatis terbit dengan kode verifikasi unik','warna'=>'bg-[#ffd60a]','teks'=>'text-[#0f0e17]'],
            ]; @endphp
            @foreach($langkah as $i => $l)
            <div class="kartu-komik p-6 text-center akan-muncul relative" style="animation-delay:{{ $i*0.1 }}s">
                <div class="w-14 h-14 rounded-2xl {{ $l['warna'] }} {{ $l['teks'] }} flex items-center justify-center mx-auto mb-4 border-2 border-[#0f0e17] shadow-[3px_3px_0_#0f0e17]">
                    <i data-lucide="{{ $l['ikon'] }}" class="w-6 h-6"></i>
                </div>
                <div class="judul-komik text-4xl text-[#4361ee] mb-2">{{ $l['no'] }}</div>
                <h4 class="font-black text-[#0f0e17] mb-2">{{ $l['judul'] }}</h4>
                <p class="text-sm font-semibold text-gray-500">{{ $l['isi'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== KENAPA PILIH GELAR.ID ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-14 akan-muncul">
            <h2 class="judul-komik text-5xl text-[#0f0e17] mb-3">KENAPA GELAR.ID?</h2>
            <p class="text-gray-500 font-bold">Bukan kampus biasa — ini kampus masa depan</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php $alasan = [
                ['ikon'=>'zap','judul'=>'Kurikulum Industri','isi'=>'Disusun bersama praktisi IT aktif dari perusahaan teknologi terkemuka Indonesia','warna'=>'#ffd60a'],
                ['ikon'=>'shield-check','judul'=>'Sertifikat Terverifikasi','isi'=>'Setiap sertifikat punya kode unik yang bisa diverifikasi siapapun secara online','warna'=>'#06d6a0'],
                ['ikon'=>'clock','judul'=>'Belajar Kapan Saja','isi'=>'Akses materi 24/7, ikuti sesi live atau tonton rekaman sesuai jadwalmu','warna'=>'#4361ee'],
                ['ikon'=>'users','judul'=>'Komunitas Aktif','isi'=>'Bergabung dengan 500+ alumni dan sesama mahasiswa yang saling support','warna'=>'#f72585'],
                ['ikon'=>'trending-up','judul'=>'Progress Transparan','isi'=>'Pantau kemajuan belajar per sesi, per semester, hingga proyeksi kelulusan','warna'=>'#7209b7'],
                ['ikon'=>'gift','judul'=>'Ada Jalur Gratis','isi'=>'K1 Literasi Digital tersedia GRATIS untuk WNI — tidak ada alasan untuk tidak mulai!','warna'=>'#10B981'],
            ]; @endphp
            @foreach($alasan as $i => $a)
            <div class="kartu-komik p-6 akan-muncul group" style="animation-delay:{{ $i*0.08 }}s">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110"
                     style="background:{{ $a['warna'] }}22;border:2px solid {{ $a['warna'] }};">
                    <i data-lucide="{{ $a['ikon'] }}" class="w-5 h-5" style="color:{{ $a['warna'] }}"></i>
                </div>
                <h4 class="font-black text-[#0f0e17] mb-2 text-lg">{{ $a['judul'] }}</h4>
                <p class="text-sm font-semibold text-gray-500 leading-relaxed">{{ $a['isi'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CTA AKHIR ===== --}}
<section class="halftone py-20 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10 akan-muncul">
        <div class="text-7xl mb-4 animate-bounce inline-block">🎓</div>
        <h2 class="judul-komik text-6xl md:text-7xl text-white mb-4" style="text-shadow:4px 4px 0 rgba(0,0,0,0.3);">
            SIAP MULAI?
        </h2>
        <p class="text-blue-100 font-bold text-xl mb-8">
            Bergabung dengan ribuan mahasiswa virtual Indonesia!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/daftar" data-tautan-spa class="btn-komik px-10 py-4 bg-[#ffd60a] text-[#0f0e17] rounded-2xl text-xl">
                <i data-lucide="rocket" class="w-6 h-6"></i>
                Daftar Sekarang — GRATIS!
            </a>
            <a href="/verifikasi" data-tautan-spa class="btn-komik px-8 py-4 bg-white/10 border-white/30 text-white rounded-2xl text-lg hover:bg-white/20">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
                Verifikasi Sertifikat
            </a>
        </div>
    </div>
    <div class="absolute -bottom-8 -right-8 w-48 h-48 rounded-full opacity-20" style="background:radial-gradient(circle,#ffd60a,transparent)"></div>
</section>

@endsection

@push('skrip')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // ===== HERO ANIMASI MASUK =====
    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    tl.fromTo('#hero-badge',     { opacity:0, y:-20 }, { opacity:1, y:0, duration:.6 })
      .fromTo('#hero-judul',     { opacity:0, y:40 },  { opacity:1, y:0, duration:.8 }, '-=0.3')
      .fromTo('#hero-sub',       { opacity:0, y:20 },  { opacity:1, y:0, duration:.6 }, '-=0.4')
      .fromTo('#hero-tombol',    { opacity:0, y:20 },  { opacity:1, y:0, duration:.6 }, '-=0.3')
      .fromTo('#hero-trust',     { opacity:0 },         { opacity:1, duration:.5 }, '-=0.2')
      .fromTo('.stat-kartu',     { opacity:0, scale:.8, y:30 }, { opacity:1, scale:1, y:0, duration:.5, stagger:.1 }, '-=0.3');

    // ===== ANIMASI TEKS BERGANTIAN =====
    const kataDaftar = ['GELARMU', 'KARIERMU', 'IMPIANMU', 'MASA DEPAN'];
    let indeksKata = 0;
    const elTeks = document.getElementById('teks-animasi');
    if (elTeks) {
        setInterval(() => {
            indeksKata = (indeksKata + 1) % kataDaftar.length;
            gsap.to(elTeks, {
                opacity: 0, y: -20, duration: .3,
                onComplete: () => {
                    elTeks.textContent = kataDaftar[indeksKata];
                    gsap.to(elTeks, { opacity: 1, y: 0, duration: .3 });
                }
            });
        }, 2500);
    }

    // ===== FLOATING LINGKARAN PARALLAX =====
    document.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth - 0.5) * 30;
        const y = (e.clientY / window.innerHeight - 0.5) * 30;
        gsap.to('#lingkaran-1', { x: x, y: y, duration: 1, ease: 'power1.out' });
        gsap.to('#lingkaran-2', { x: -x * 0.5, y: -y * 0.5, duration: 1.2, ease: 'power1.out' });
    });
});
</script>
@endpush
