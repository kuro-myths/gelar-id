@extends('tataletak.aplikasi')
@section('judul','Kelas')
@section('konten')

{{-- ===== POPUP PEMILIHAN JALUR ===== --}}
@if(!request()->has('jalur'))
<div id="popup-jalur" x-data="{ tampil: true }" x-show="tampil" x-cloak
     style="position:fixed;inset:0;z-index:9000;background:rgba(15,14,23,.9);backdrop-filter:blur(6px);">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white border-4 border-[#0f0e17] shadow-[12px_12px_0_#0f0e17] rounded-3xl max-w-2xl w-full p-8">
            <div class="text-center mb-8">
                <div class="text-5xl mb-3">📚</div>
                <h2 class="judul-komik text-4xl text-[#0f0e17] mb-2">PILIH JALUR BELAJARMU!</h2>
                <p class="text-gray-500 font-bold">Kami punya dua jalur berbeda — pilih yang sesuai kebutuhanmu</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Jalur Sekolah --}}
                <a href="/kelas?jalur=sekolah" @click="tampil=false"
                   class="kartu-komik p-6 text-center cursor-pointer hover:bg-[#f0f4ff] group transition-all">
                    <div class="w-16 h-16 rounded-2xl bg-[#06d6a0] border-3 border-[#0f0e17] flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform"
                         style="border:3px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                        <span class="text-3xl">🏫</span>
                    </div>
                    <h3 class="judul-komik text-2xl text-[#0f0e17] mb-2">KELAS PELAJAR</h3>
                    <p class="text-sm font-semibold text-gray-500 mb-4">Untuk siswa SD, SMP, dan SMA. Materi digital yang menyenangkan dengan sertifikat resmi.</p>
                    <div class="flex flex-wrap gap-1.5 justify-center">
                        <span class="badge-komik bg-[#EF4444] text-white text-xs">SD</span>
                        <span class="badge-komik bg-[#F59E0B] text-white text-xs">SMP</span>
                        <span class="badge-komik bg-[#4361ee] text-white text-xs">SMA</span>
                    </div>
                    <div class="mt-4 btn-komik w-full py-2.5 bg-[#06d6a0] text-[#0f0e17] rounded-xl text-sm">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i> Pilih Jalur Ini
                    </div>
                </a>
                {{-- Jalur Kuliah --}}
                <a href="/kelas?jalur=kuliah" @click="tampil=false"
                   class="kartu-komik p-6 text-center cursor-pointer hover:bg-[#f0f4ff] group transition-all">
                    <div class="w-16 h-16 rounded-2xl bg-[#7209b7] border-3 border-[#0f0e17] flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform"
                         style="border:3px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                        <span class="text-3xl">🎓</span>
                    </div>
                    <h3 class="judul-komik text-2xl text-[#0f0e17] mb-2">KELAS KAMPUS VIRTUAL</h3>
                    <p class="text-sm font-semibold text-gray-500 mb-4">Untuk mahasiswa & umum. Kelas intensif setara perguruan tinggi dengan pengajar profesional.</p>
                    <div class="flex flex-wrap gap-1.5 justify-center">
                        <span class="badge-komik bg-[#7209b7] text-white text-xs">Mahasiswa</span>
                        <span class="badge-komik bg-[#4361ee] text-white text-xs">Umum</span>
                        <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">Profesional</span>
                    </div>
                    <div class="mt-4 btn-komik w-full py-2.5 bg-[#7209b7] text-white rounded-xl text-sm">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i> Pilih Jalur Ini
                    </div>
                </a>
            </div>
            <p class="text-center text-xs font-bold text-gray-400 mt-5">
                Tidak yakin? <a href="/analisis-minat" class="text-[#4361ee] hover:underline">Coba Tes Minat AI</a> untuk rekomendasi personal!
            </p>
        </div>
    </div>
</div>
@endif

{{-- ===== HERO DINAMIS BERDASARKAN JALUR ===== --}}
@php
$jalur = request('jalur', 'semua');
$isSekolah = $jalur === 'sekolah';
$isKuliah  = $jalur === 'kuliah';
$heroWarna  = $isSekolah ? 'linear-gradient(135deg,#06d6a0 0%,#0f9e7a 100%)' : ($isKuliah ? 'linear-gradient(135deg,#7209b7 0%,#4361ee 100%)' : 'linear-gradient(135deg,#0f0e17 0%,#1e3a8a 100%)');
$heroJudul  = $isSekolah ? 'KELAS PELAJAR' : ($isKuliah ? 'KELAS KAMPUS VIRTUAL' : 'SEMUA KELAS');
$heroDeskripsi = $isSekolah
    ? 'Belajar ilmu digital sejak dini! Kelas khusus untuk pelajar SD–SMA dengan materi yang menyenangkan, sertifikat resmi, dan pengajar berpengalaman.'
    : ($isKuliah ? 'Kelas intensif setara perguruan tinggi untuk mahasiswa & profesional. Dipandu pengajar berpengalaman dengan sertifikat kampus virtual.'
    : 'Temukan kelas yang tepat untukmu — dari SD hingga level profesional. Semua ada di sini!');
@endphp

<section class="py-14 relative overflow-hidden" style="background:{{ $heroWarna }};border-bottom:4px solid #0f0e17;">
    <div class="absolute inset-0" style="background-image:radial-gradient(#ffffff08 1px,transparent 1px);background-size:20px 20px;"></div>
    <div class="max-w-6xl mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="akan-muncul">
                {{-- Breadcrumb jalur --}}
                <div class="flex items-center gap-2 mb-4 flex-wrap">
                    <a href="/kelas" data-tautan-spa class="inline-flex items-center gap-1.5 bg-white/20 border border-white/30 rounded-full px-3 py-1 text-white text-xs font-bold hover:bg-white/30 transition-colors">
                        <i data-lucide="grid" class="w-3 h-3"></i> Semua Kelas
                    </a>
                    @if($isSekolah)
                    <span class="text-white/60">›</span>
                    <span class="inline-flex items-center gap-1.5 bg-white/30 border border-white/40 rounded-full px-3 py-1 text-white text-xs font-black">🏫 Kelas Pelajar</span>
                    @elseif($isKuliah)
                    <span class="text-white/60">›</span>
                    <span class="inline-flex items-center gap-1.5 bg-white/30 border border-white/40 rounded-full px-3 py-1 text-white text-xs font-black">🎓 Kampus Virtual</span>
                    @endif
                </div>
                <h1 class="judul-komik text-6xl text-white mb-3" style="text-shadow:3px 3px 0 rgba(0,0,0,.25);">{{ $heroJudul }}</h1>
                <p class="text-white/80 font-bold text-base leading-relaxed mb-5">{{ $heroDeskripsi }}</p>
                @if(!$jalur || $jalur === 'semua')
                <div class="flex gap-3 flex-wrap">
                    <a href="/kelas?jalur=sekolah" data-tautan-spa class="btn-komik px-5 py-2.5 bg-[#06d6a0] text-[#0f0e17] rounded-xl text-sm">🏫 Kelas Pelajar</a>
                    <a href="/kelas?jalur=kuliah" data-tautan-spa class="btn-komik px-5 py-2.5 bg-[#7209b7] text-white rounded-xl text-sm">🎓 Kampus Virtual</a>
                </div>
                @endif
            </div>
            <div class="grid grid-cols-2 gap-3 akan-muncul" style="animation-delay:.1s">
                @foreach(['sd'=>['label'=>'Kelas SD','warna'=>'#EF4444','ikon'=>'smile'],'smp'=>['label'=>'Kelas SMP','warna'=>'#F59E0B','ikon'=>'book'],'sma'=>['label'=>'Kelas SMA','warna'=>'#4361ee','ikon'=>'graduation-cap'],'umum'=>['label'=>'Kampus Virtual','warna'=>'#7209b7','ikon'=>'landmark']] as $k => $info)
                <div class="bg-white/15 border-2 border-white/25 rounded-2xl p-4 text-center backdrop-blur">
                    <div class="w-10 h-10 rounded-xl mx-auto mb-2 flex items-center justify-center" style="background:{{ $info['warna'] }};border:2px solid rgba(255,255,255,.3);">
                        <i data-lucide="{{ $info['ikon'] }}" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="judul-komik text-3xl text-white">{{ $statistikKelas[$k] }}</div>
                    <div class="text-xs font-black text-white/70 mt-0.5">{{ $info['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===== KONTEN KELAS ===== --}}
<div class="max-w-7xl mx-auto px-4 py-12">
    {{-- Filter & Search --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-8 akan-muncul">
        <form method="GET" action="/kelas" class="flex gap-2 flex-1">
            @if($jalur && $jalur !== 'semua')<input type="hidden" name="jalur" value="{{ $jalur }}">@endif
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari kelas..." class="input-komik flex-1 text-sm" style="max-width:280px;">
            @if(request('tingkat'))<input type="hidden" name="tingkat" value="{{ request('tingkat') }}">@endif
            <button type="submit" class="btn-komik px-4 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm"><i data-lucide="search" class="w-4 h-4"></i></button>
        </form>
        <div class="flex flex-wrap gap-2">
            @php $baseUrl = '/kelas?jalur='.$jalur; @endphp
            <a href="{{ $baseUrl }}" data-tautan-spa class="btn-komik px-4 py-2 rounded-xl text-xs {{ !request('tingkat') && !request('gratis') ? 'bg-[#0f0e17] text-white' : 'bg-gray-100 text-gray-700' }}">Semua</a>
            @if($isSekolah || !$jalur || $jalur === 'semua')
            @foreach(['sd'=>['SD','#EF4444'],'smp'=>['SMP','#F59E0B'],'sma'=>['SMA','#4361ee']] as $k=>[$lbl,$wrn])
            <a href="{{ $baseUrl }}&tingkat={{ $k }}{{ request('cari') ? '&cari='.request('cari') : '' }}" data-tautan-spa
               class="btn-komik px-4 py-2 rounded-xl text-xs text-white"
               style="{{ request('tingkat')===$k ? 'background:'.$wrn.';border-color:#0f0e17;' : 'background:'.$wrn.'33;color:'.$wrn.';border-color:'.$wrn.';' }}">
                <i data-lucide="book" class="w-3.5 h-3.5"></i> {{ $lbl }}
            </a>
            @endforeach
            @endif
            @if($isKuliah || !$jalur || $jalur === 'semua')
            <a href="{{ $baseUrl }}&tingkat=umum{{ request('cari') ? '&cari='.request('cari') : '' }}" data-tautan-spa
               class="btn-komik px-4 py-2 rounded-xl text-xs {{ request('tingkat')==='umum' ? 'bg-[#7209b7] text-white' : 'text-[#7209b7] bg-[#7209b7]/10' }}"
               style="{{ request('tingkat')==='umum' ? '' : 'border-color:#7209b7;' }}">
                <i data-lucide="landmark" class="w-3.5 h-3.5"></i> Umum
            </a>
            @endif
            <a href="{{ $baseUrl }}&gratis=1" data-tautan-spa class="btn-komik px-4 py-2 rounded-xl text-xs {{ request('gratis') ? 'bg-[#06d6a0] text-[#0f0e17]' : 'bg-gray-100 text-gray-700' }}">
                <i data-lucide="gift" class="w-3.5 h-3.5"></i> Gratis
            </a>
        </div>
    </div>

    {{-- Grid Kelas --}}
    @if($kelasDaftar->isEmpty())
    <div class="kartu-komik p-16 text-center">
        <div class="text-6xl mb-4">📭</div>
        <p class="judul-komik text-3xl text-gray-400 mb-2">Kelas tidak ditemukan</p>
        <p class="text-gray-400 font-semibold mb-6">Belum ada kelas untuk filter ini. Coba filter lain!</p>
        <a href="/kelas?jalur={{ $jalur }}" data-tautan-spa class="btn-komik px-6 py-3 bg-[#4361ee] text-white rounded-xl">Reset Filter</a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kelasDaftar as $kelas)
        <div class="kartu-komik overflow-hidden flex flex-col akan-muncul group" style="animation-delay:{{ $loop->index * 0.07 }}s">
            <div class="h-2.5" style="background:{{ $kelas->warna ?? $kelas->warna_label_tingkat }}"></div>
            @if($kelas->unggulan)
            <div class="px-4 pt-3">
                <span class="badge-komik bg-[#ffd60a] text-[#0f0e17] text-xs">⭐ UNGGULAN</span>
            </div>
            @endif
            <div class="p-5 flex flex-col flex-1">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex flex-wrap gap-1.5">
                        <span class="badge-komik text-white text-xs" style="background:{{ $kelas->warna_label_tingkat }};border-color:#0f0e17;">{{ $kelas->label_tingkat }}</span>
                        @if($kelas->label_badge)<span class="badge-komik text-white text-xs" style="background:{{ $kelas->warna ?? '#4361ee' }};border-color:#0f0e17;">{{ $kelas->label_badge }}</span>@endif
                    </div>
                    @if($kelas->gratis)
                    <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">GRATIS</span>
                    @else
                    <span class="judul-komik text-lg text-[#0f0e17]">Rp {{ number_format($kelas->harga,0,',','.') }}</span>
                    @endif
                </div>
                <h3 class="font-black text-[#0f0e17] text-lg mb-2 leading-snug group-hover:text-[#4361ee] transition-colors">{{ $kelas->nama }}</h3>
                <p class="text-sm font-semibold text-gray-500 mb-4 line-clamp-2 flex-1">{{ $kelas->deskripsi }}</p>
                <div class="flex items-center gap-3 text-xs font-black text-gray-400 mb-4 pb-4 border-t-2 border-gray-100 pt-3">
                    <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5"></i>{{ $kelas->durasi_jam }} jam</span>
                    <span class="flex items-center gap-1"><i data-lucide="layers" class="w-3.5 h-3.5"></i>{{ $kelas->jumlah_sesi }} sesi</span>
                    <span class="flex items-center gap-1"><i data-lucide="users" class="w-3.5 h-3.5"></i>{{ $kelas->jumlah_peserta }}</span>
                </div>
                @if($kelas->pengajar)
                <div class="flex items-center gap-2 text-xs font-bold text-gray-500 mb-4">
                    <div class="w-6 h-6 rounded-full bg-[#4361ee] flex items-center justify-center text-white font-black text-xs" style="border:1.5px solid #0f0e17;">{{ strtoupper(substr($kelas->pengajar->nama,0,1)) }}</div>
                    <span>{{ $kelas->pengajar->nama }}</span>
                </div>
                @endif
                <a href="/kelas/{{ $kelas->slug }}" data-tautan-spa
                   class="btn-komik w-full py-2.5 text-white text-sm rounded-xl text-center"
                   style="background:{{ $kelas->warna ?? $kelas->warna_label_tingkat }}">
                    <i data-lucide="arrow-right" class="w-4 h-4"></i> Lihat Kelas
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $kelasDaftar->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
