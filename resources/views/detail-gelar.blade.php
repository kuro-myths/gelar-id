@extends('tataletak.aplikasi')
@section('judul', $gelar->kode . ' — ' . $gelar->nama)
@section('konten')

{{-- HERO --}}
<section class="py-16 relative overflow-hidden" style="background:{{ $gelar->warna }}15;border-bottom:4px solid #0f0e17;">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <div class="akan-muncul">
                <a href="/gelar" data-tautan-spa class="inline-flex items-center gap-2 text-sm font-black text-gray-500 hover:text-[#4361ee] mb-5 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Semua Gelar
                </a>
                <span class="badge-komik text-white text-sm mb-4 inline-block" style="background:{{ $gelar->warna }};border-color:#0f0e17;">
                    {{ $gelar->label_kategori }}
                </span>
                <h1 class="judul-komik text-7xl md:text-8xl text-[#0f0e17] mb-2"
                    style="text-shadow:4px 4px 0 {{ $gelar->warna }}50;">{{ $gelar->kode }}</h1>
                <h2 class="judul-komik text-3xl text-[#0f0e17] mb-3">{{ $gelar->nama }}</h2>
                @if($gelar->gelar_singkat)
                <div class="inline-block bg-[#ffd60a] px-5 py-2 rounded-xl mb-4 judul-komik text-2xl"
                     style="border:3px solid #0f0e17;box-shadow:4px 4px 0 #0f0e17;">
                    Gelar: {{ $gelar->gelar_singkat }}
                </div>
                @endif
                <p class="text-gray-700 font-bold text-lg leading-relaxed mb-6">{{ $gelar->deskripsi }}</p>
                <div class="flex flex-wrap gap-3">
                    <a href="/program?gelar={{ $gelar->kode }}" data-tautan-spa
                       class="btn-komik px-7 py-3 text-white rounded-xl text-base" style="background:{{ $gelar->warna }}">
                        <i data-lucide="book-open" class="w-5 h-5"></i> Lihat Program
                    </a>
                    <a href="/analisis-minat" data-tautan-spa
                       class="btn-komik px-6 py-3 bg-white text-[#0f0e17] rounded-xl text-base">
                        <i data-lucide="bot" class="w-5 h-5"></i> Tes Minat AI
                    </a>
                </div>
            </div>

            {{-- Kartu Info --}}
            <div class="grid grid-cols-2 gap-4 akan-muncul" style="animation-delay:.1s">
                @foreach([
                    ['ikon'=>'clock',          'label'=>'Durasi',   'nilai'=>$gelar->durasi_tahun,             'bg'=>$gelar->warna,  'tc'=>'white'],
                    ['ikon'=>'book',           'label'=>'Total SKS','nilai'=>$gelar->sks_dibutuhkan.' SKS',    'bg'=>'#ffd60a',      'tc'=>'#0f0e17'],
                    ['ikon'=>'layers',         'label'=>'Semester', 'nilai'=>$gelar->jumlah_semester.' Smt',   'bg'=>'#4361ee',      'tc'=>'white'],
                    ['ikon'=>'graduation-cap', 'label'=>'Program',  'nilai'=>$gelar->program->count().' Prg',  'bg'=>'#06d6a0',      'tc'=>'#0f0e17'],
                ] as $info)
                <div class="kartu-komik p-5 text-center"
                     style="border-color:{{ $info['bg'] }};box-shadow:5px 5px 0 {{ $info['bg'] }};">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3"
                         style="background:{{ $info['bg'] }};border:2px solid #0f0e17;">
                        <i data-lucide="{{ $info['ikon'] }}" class="w-5 h-5" style="color:{{ $info['tc'] }}"></i>
                    </div>
                    <div class="judul-komik text-2xl text-[#0f0e17]">{{ $info['nilai'] }}</div>
                    <div class="text-xs font-black text-gray-500 mt-1">{{ $info['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KONTEN UTAMA --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Keunggulan --}}
            @if($gelar->keunggulan)
            <div class="kartu-komik p-6 akan-muncul">
                <h3 class="judul-komik text-3xl text-[#0f0e17] mb-5 flex items-center gap-2">
                    <i data-lucide="star" class="w-6 h-6 text-[#ffd60a]"></i> KEUNGGULAN
                </h3>
                <div class="space-y-3">
                    @foreach($gelar->keunggulan as $k)
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-[#f0f4ff]"
                         style="border:2px solid {{ $gelar->warna }}40;">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center text-white flex-shrink-0 mt-0.5"
                             style="background:{{ $gelar->warna }};border:2px solid #0f0e17;">
                            <i data-lucide="check" class="w-3 h-3"></i>
                        </div>
                        <p class="font-bold text-[#0f0e17] text-sm">{{ $k }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Kurikulum Interaktif Per Semester --}}
            @if($gelar->mata_kuliah_inti)
            <div class="kartu-komik p-6 akan-muncul" x-data="{ tab: 1 }">
                <h3 class="judul-komik text-3xl text-[#0f0e17] mb-2 flex items-center gap-2">
                    <i data-lucide="layers" class="w-6 h-6 text-[#4361ee]"></i> KURIKULUM LENGKAP
                </h3>
                <p class="text-sm font-bold text-gray-500 mb-5">
                    {{ $gelar->jumlah_semester }} Semester · {{ $gelar->sks_dibutuhkan }} Total SKS
                </p>

                @php
                $progSmt = $gelar->program->filter(fn($p) => $p->semester->isNotEmpty())->first();
                @endphp

                @if($progSmt)
                {{-- Tab Semester --}}
                <div class="flex flex-wrap gap-2 mb-5">
                    @foreach($progSmt->semester as $smt)
                    <button @click="tab = {{ $smt->nomor }}"
                            class="btn-komik px-4 py-2 rounded-xl text-xs transition-all"
                            :class="tab === {{ $smt->nomor }} ? '' : 'bg-gray-100 text-gray-600'"
                            :style="tab === {{ $smt->nomor }} ? 'background:{{ $gelar->warna }};color:white;' : ''">
                        Smt {{ $smt->nomor }}
                    </button>
                    @endforeach
                </div>

                {{-- Konten Tiap Semester --}}
                @foreach($progSmt->semester as $smt)
                <div x-show="tab === {{ $smt->nomor }}"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-3"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="rounded-2xl overflow-hidden"
                     style="border:3px solid {{ $gelar->warna }};box-shadow:4px 4px 0 {{ $gelar->warna }};">
                    {{-- Header Semester --}}
                    <div class="px-5 py-3 text-white flex items-center justify-between"
                         style="background:{{ $gelar->warna }}">
                        <div>
                            <h4 class="judul-komik text-xl">{{ $smt->nama }}</h4>
                            @if($smt->deskripsi)<p class="text-xs opacity-80 font-bold">{{ $smt->deskripsi }}</p>@endif
                        </div>
                        <div class="text-right">
                            <div class="judul-komik text-2xl">{{ $smt->jumlah_sks }}</div>
                            <div class="text-xs opacity-80 font-bold">SKS</div>
                        </div>
                    </div>
                    {{-- Sesi / Mata Kuliah --}}
                    <div class="p-4">
                        @if($smt->sesiBelajar->isNotEmpty())
                        <div class="space-y-2">
                            @foreach($smt->sesiBelajar as $sesi)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-[#f8f9ff]" style="border:2px solid #e5e7f0;">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-black text-xs flex-shrink-0"
                                     style="background:{{ $gelar->warna }};border:2px solid #0f0e17;">
                                    {{ $sesi->pertemuan_ke }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-black text-[#0f0e17] text-sm">{{ $sesi->judul }}</p>
                                    <p class="text-xs font-bold text-gray-400">{{ $sesi->label_tipe }} · {{ $sesi->durasi_menit }} mnt</p>
                                </div>
                                @if($sesi->alat_dipakai)
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice((array)$sesi->alat_dipakai, 0, 3) as $alat)
                                    <span class="text-xs bg-[#0f0e17] text-white px-2 py-0.5 rounded font-bold">{{ $alat }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @elseif($smt->mata_kuliah)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach($smt->mata_kuliah as $mk)
                            <div class="flex items-center gap-2 p-3 rounded-xl bg-[#f8f9ff]" style="border:2px solid #e5e7f0;">
                                <i data-lucide="book-open" class="w-4 h-4 flex-shrink-0" style="color:{{ $gelar->warna }}"></i>
                                <span class="font-bold text-[#0f0e17] text-sm">{{ $mk }}</span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-400 font-bold text-sm text-center py-4">Sesi akan ditambahkan segera</p>
                        @endif
                    </div>
                </div>
                @endforeach

                @else
                {{-- Fallback: tampilkan mata kuliah inti --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($gelar->mata_kuliah_inti as $i => $mk)
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-[#f8f9ff]"
                         style="border:2px solid {{ $gelar->warna }}40;">
                        <span class="w-7 h-7 rounded-lg flex items-center justify-center text-white font-black text-xs flex-shrink-0"
                              style="background:{{ $gelar->warna }};border:2px solid #0f0e17;">{{ $i+1 }}</span>
                        <span class="font-bold text-[#0f0e17] text-sm">{{ $mk }}</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            {{-- Syarat --}}
            @if($gelar->syarat)
            <div class="kartu-komik p-6 akan-muncul">
                <h3 class="judul-komik text-3xl text-[#0f0e17] mb-4 flex items-center gap-2">
                    <i data-lucide="clipboard-check" class="w-6 h-6 text-[#4361ee]"></i> SYARAT PENDAFTARAN
                </h3>
                <div class="bg-[#ffd60a] rounded-2xl p-5" style="border:3px solid #0f0e17;box-shadow:4px 4px 0 #0f0e17;">
                    <p class="font-bold text-[#0f0e17] whitespace-pre-line">{{ $gelar->syarat }}</p>
                </div>
            </div>
            @endif

            {{-- Program Tersedia --}}
            <div class="kartu-komik p-6 akan-muncul">
                <h3 class="judul-komik text-3xl text-[#0f0e17] mb-5 flex items-center gap-2">
                    <i data-lucide="target" class="w-6 h-6 text-[#4361ee]"></i> PROGRAM TERSEDIA
                </h3>
                @forelse($gelar->program as $prog)
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 rounded-2xl bg-[#f0f4ff] mb-3"
                     style="border:2px solid {{ $gelar->warna }}40;">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <p class="font-black text-[#0f0e17]">{{ $prog->nama }}</p>
                            @if($prog->label_badge)
                            <span class="badge-komik text-white text-xs"
                                  style="background:{{ $prog->warna_badge ?? $gelar->warna }};border-color:#0f0e17;">{{ $prog->label_badge }}</span>
                            @endif
                        </div>
                        <p class="text-xs font-bold text-gray-500">
                            <i data-lucide="users" class="w-3 h-3 inline mr-1"></i>{{ $prog->jumlah_peserta }} peserta ·
                            {{ $prog->gratis ? '🆓 Gratis' : 'Rp '.number_format($prog->harga,0,',','.') }}
                            @if($prog->ada_diskon)
                            · <span class="badge-diskon">HEMAT {{ $prog->porsen_diskon }}%</span>
                            @endif
                        </p>
                    </div>
                    @auth
                    <form method="POST" action="/pengguna/daftar/{{ $prog->id }}">@csrf
                        <button type="submit" class="btn-komik px-4 py-2 text-white text-sm rounded-xl"
                                style="background:{{ $gelar->warna }}">
                            <i data-lucide="zap" class="w-4 h-4"></i> Daftar
                        </button>
                    </form>
                    @else
                    <a href="/masuk" data-tautan-spa class="btn-komik px-4 py-2 bg-[#4361ee] text-white text-sm rounded-xl">Masuk</a>
                    @endauth
                </div>
                @empty
                <p class="text-gray-400 font-black text-center py-8">Belum ada program tersedia</p>
                @endforelse
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-5">
            @if($gelar->prospek_karir)
            <div class="kartu-komik p-5 akan-muncul">
                <h4 class="judul-komik text-xl text-[#0f0e17] mb-3 flex items-center gap-2">
                    <i data-lucide="briefcase" class="w-5 h-5 text-[#4361ee]"></i> PROSPEK KARIR
                </h4>
                @foreach(explode("\n", $gelar->prospek_karir) as $karir)
                @if(trim($karir))
                <div class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                    <i data-lucide="chevron-right" class="w-4 h-4 text-[#4361ee] flex-shrink-0"></i>
                    {{ trim($karir) }}
                </div>
                @endif
                @endforeach
            </div>
            @endif

            <div class="kartu-komik p-5 text-center akan-muncul" style="background:{{ $gelar->warna }};border-color:#0f0e17;">
                <h4 class="judul-komik text-2xl text-white mb-2">SIAP MULAI?</h4>
                <p class="text-white font-bold text-sm mb-4 opacity-90">Raih gelar {{ $gelar->kode }} sekarang!</p>
                @auth
                <a href="/program?gelar={{ $gelar->kode }}" data-tautan-spa
                   class="btn-komik w-full py-3 bg-[#ffd60a] text-[#0f0e17] rounded-xl text-sm block">
                    <i data-lucide="rocket" class="w-4 h-4"></i> Pilih Program
                </a>
                @else
                <a href="/daftar" data-tautan-spa
                   class="btn-komik w-full py-3 bg-[#ffd60a] text-[#0f0e17] rounded-xl text-sm block">
                    <i data-lucide="rocket" class="w-4 h-4"></i> Daftar Gratis!
                </a>
                @endauth
            </div>

            <div class="kartu-komik p-5 text-center bg-[#f0f4ff] akan-muncul">
                <i data-lucide="bot" class="w-10 h-10 mx-auto mb-2 text-[#4361ee]"></i>
                <p class="font-black text-[#0f0e17] mb-1">Belum yakin?</p>
                <p class="text-xs font-bold text-gray-500 mb-3">Coba tes minat AI — 10 pertanyaan</p>
                <a href="/analisis-minat" data-tautan-spa
                   class="btn-komik w-full py-2.5 bg-[#4361ee] text-white rounded-xl text-sm block">
                    <i data-lucide="sparkles" class="w-4 h-4"></i> Mulai Tes Minat
                </a>
            </div>

            <a href="/gelar" data-tautan-spa
               class="btn-komik w-full py-3 bg-gray-100 text-[#0f0e17] rounded-xl text-sm text-center block">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Semua Gelar
            </a>
        </div>
    </div>
</div>
@endsection
