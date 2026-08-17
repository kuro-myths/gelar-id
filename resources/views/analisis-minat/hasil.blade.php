@extends('tataletak.aplikasi')
@section('judul','Hasil Analisis Minat — Rekomendasi Untukmu')
@section('konten')

<div class="max-w-4xl mx-auto px-4 py-12">

    {{-- Header Konfeti --}}
    <div class="text-center mb-10 akan-muncul">
        <div class="text-7xl mb-4 inline-block" id="ikon-hasil"
             style="animation:apung 2s ease-in-out infinite;display:inline-block;">🎯</div>
        <h1 class="judul-komik text-5xl md:text-6xl text-[#0f0e17] mb-3">HASIL ANALISISMU!</h1>
        <p class="text-gray-600 font-bold">
            Berdasarkan {{ count($analisis->jawaban_kuis) }} jawaban, AI kami menemukan program terbaik untukmu
        </p>
    </div>

    {{-- KARTU REKOMENDASI UTAMA --}}
    @if($analisis->jenisGelarRekomendasi)
    @php $g = $analisis->jenisGelarRekomendasi; @endphp
    <div class="akan-muncul mb-8" style="animation-delay:.1s">
        <div class="kartu-komik overflow-hidden"
             style="border-color:{{ $g->warna }};box-shadow:8px 8px 0 {{ $g->warna }};">
            <div class="h-3" style="background:{{ $g->warna }}"></div>
            <div class="p-7">
                <div class="flex flex-col md:flex-row items-start gap-6">
                    {{-- Badge Gelar --}}
                    <div class="w-24 h-24 rounded-3xl text-white flex items-center justify-center flex-shrink-0 judul-komik text-2xl"
                         style="background:{{ $g->warna }};border:4px solid #0f0e17;box-shadow:5px 5px 0 #0f0e17;">
                        {{ $g->kode }}
                    </div>

                    <div class="flex-1">
                        {{-- Label --}}
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center gap-1 bg-[#ffd60a] text-[#0f0e17] px-3 py-1 rounded-full text-xs font-black"
                                  style="border:2px solid #0f0e17;box-shadow:2px 2px 0 #0f0e17;">
                                <i data-lucide="star" class="w-3.5 h-3.5"></i>
                                REKOMENDASI TERBAIK
                            </span>
                            <span class="badge-komik text-white text-xs"
                                  style="background:{{ $g->warna }};border-color:#0f0e17;">
                                {{ $g->label_kategori }}
                            </span>
                            @if($analisis->skor_tertinggi >= 12)
                            <span class="badge-komik bg-[#f72585] text-white text-xs">Kesesuaian Tinggi</span>
                            @elseif($analisis->skor_tertinggi >= 8)
                            <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">Kesesuaian Baik</span>
                            @endif
                        </div>

                        <h2 class="judul-komik text-4xl text-[#0f0e17] mb-1">{{ $g->kode }}</h2>
                        <p class="font-black text-gray-700 text-xl mb-3">{{ $g->nama }}</p>
                        <p class="text-gray-600 font-semibold leading-relaxed mb-4">{{ $analisis->alasan_rekomendasi }}</p>

                        {{-- Info cepat --}}
                        <div class="flex flex-wrap gap-4 text-sm font-black text-gray-500 mb-4 pb-4 border-b-2 border-gray-100">
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="clock" class="w-4 h-4 text-[#4361ee]"></i>
                                {{ $g->durasi_tahun }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="book-open" class="w-4 h-4 text-[#4361ee]"></i>
                                {{ $g->sks_dibutuhkan }} SKS
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="layers" class="w-4 h-4 text-[#4361ee]"></i>
                                {{ $g->jumlah_semester }} Semester
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="graduation-cap" class="w-4 h-4 text-[#4361ee]"></i>
                                Gelar: {{ $g->gelar_singkat ?? $g->kode }}
                            </span>
                        </div>

                        {{-- Program Rekomendasi --}}
                        @if($analisis->programRekomendasi)
                        @php $prog = $analisis->programRekomendasi; @endphp
                        <div class="p-4 rounded-2xl bg-[#f0f4ff]" style="border:2px solid #4361ee33;">
                            <p class="text-xs font-black text-[#4361ee] mb-1 uppercase tracking-wide flex items-center gap-1">
                                <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                                Program yang Direkomendasikan
                            </p>
                            <p class="font-black text-[#0f0e17] text-lg">{{ $prog->nama }}</p>
                            <p class="text-sm font-semibold text-gray-500 mt-1 line-clamp-2">{{ $prog->deskripsi }}</p>
                            <div class="flex items-center gap-2 mt-3">
                                @if($prog->gratis)
                                <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">🆓 GRATIS</span>
                                @elseif($prog->ada_diskon)
                                <span class="harga-coret text-xs">Rp {{ number_format($prog->harga_coret,0,',','.') }}</span>
                                <span class="judul-komik text-lg text-[#0f0e17]">Rp {{ number_format($prog->harga,0,',','.') }}</span>
                                @else
                                <span class="judul-komik text-lg text-[#0f0e17]">Rp {{ number_format($prog->harga,0,',','.') }}</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        {{-- CTA --}}
                        <div class="flex flex-wrap gap-3 mt-5">
                            @auth
                                @if($analisis->programRekomendasi)
                                <form method="POST" action="/pengguna/daftar/{{ $analisis->programRekomendasi->id }}">
                                    @csrf
                                    <button type="submit"
                                            class="btn-komik px-7 py-3 text-white rounded-xl text-sm"
                                            style="background:{{ $g->warna }}">
                                        <i data-lucide="rocket" class="w-4 h-4"></i>
                                        Daftar Program Ini!
                                    </button>
                                </form>
                                @endif
                            @else
                            <a href="/daftar" data-tautan-spa
                               class="btn-komik px-7 py-3 bg-[#4361ee] text-white rounded-xl text-sm">
                                <i data-lucide="user-plus" class="w-4 h-4"></i>
                                Daftar Gratis & Mulai!
                            </a>
                            @endauth

                            <a href="/gelar/{{ $g->kode }}" data-tautan-spa
                               class="btn-komik px-5 py-3 bg-gray-100 text-[#0f0e17] rounded-xl text-sm">
                                <i data-lucide="info" class="w-4 h-4"></i>
                                Pelajari Gelar Ini
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- PROFIL SKOR --}}
    <div class="kartu-komik p-7 mb-8 akan-muncul" style="animation-delay:.2s">
        <h3 class="judul-komik text-2xl text-[#0f0e17] mb-5 flex items-center gap-2">
            <i data-lucide="bar-chart-3" class="w-6 h-6 text-[#4361ee]"></i>
            PROFIL SKORMU
        </h3>

        @php
        $labelKat = [
            'sarjana_teknis'  => ['label'=>'Sarjana Teknis',     'sub'=>'KVT.Kom / VT.Kom', 'warna'=>'#6366F1'],
            'vokasi_teknis'   => ['label'=>'Vokasi Teknis',      'sub'=>'VT.Kom',           'warna'=>'#3B82F6'],
            'vokasi_bisnis'   => ['label'=>'Vokasi Bisnis',      'sub'=>'V.Com / VTA.Kom',  'warna'=>'#F59E0B'],
            'diploma_kreatif' => ['label'=>'Diploma Kreatif',    'sub'=>'K3 / K4 / K5',     'warna'=>'#EAB308'],
            'diploma_dasar'   => ['label'=>'Diploma Dasar',      'sub'=>'K1 / K2',          'warna'=>'#EF4444'],
        ];
        $skorTampil = $skor;
        arsort($skorTampil);
        $skorMaks = max(array_values($skor)) ?: 1;
        @endphp

        <div class="space-y-4">
            @foreach($skorTampil as $kat => $nilai)
            @if(isset($labelKat[$kat]))
            @php $info = $labelKat[$kat]; $persen = round(($nilai / $skorMaks) * 100); @endphp
            <div class="flex items-center gap-4">
                <div class="w-36 shrink-0 text-right">
                    <p class="text-xs font-black text-[#0f0e17] leading-tight">{{ $info['label'] }}</p>
                    <p class="text-xs font-bold text-gray-400">{{ $info['sub'] }}</p>
                </div>
                <div class="flex-1 bg-gray-100 rounded-full h-6 overflow-hidden" style="border:2px solid #0f0e17;">
                    <div class="h-6 rounded-full flex items-center justify-end pr-2 transition-all duration-1000 ease-out"
                         style="width:{{ $persen }}%;background:{{ $info['warna'] }};"
                         data-target="{{ $persen }}">
                        @if($persen > 20)
                        <span class="text-white text-xs font-black">{{ $nilai }}</span>
                        @endif
                    </div>
                </div>
                @if($persen <= 20)
                <span class="text-xs font-black w-6" style="color:{{ $info['warna'] }}">{{ $nilai }}</span>
                @else
                <span class="w-6"></span>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>

    {{-- SEMUA GELAR --}}
    <div class="akan-muncul" style="animation-delay:.3s">
        <div class="flex items-center justify-between mb-5">
            <h3 class="judul-komik text-3xl text-[#0f0e17]">JELAJAHI SEMUA GELAR</h3>
            <a href="/gelar" data-tautan-spa class="btn-komik px-4 py-2 bg-[#0f0e17] text-white rounded-xl text-xs">
                Lihat Semua
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($semuaGelar as $g)
            <a href="/gelar/{{ $g->kode }}" data-tautan-spa
               class="kartu-komik p-4 text-center group relative overflow-hidden"
               @if($analisis->jenisGelarRekomendasi?->id === $g->id)
               style="border-color:{{ $g->warna }};box-shadow:5px 5px 0 {{ $g->warna }};"
               @endif>

                @if($analisis->jenisGelarRekomendasi?->id === $g->id)
                <div class="absolute top-0 right-0 bg-[#ffd60a] text-[#0f0e17] text-xs font-black px-2 py-0.5 rounded-bl-xl"
                     style="border-left:2px solid #0f0e17;border-bottom:2px solid #0f0e17;">⭐</div>
                @endif

                <div class="w-12 h-12 rounded-xl text-white font-black mx-auto mb-2 flex items-center justify-center judul-komik text-sm group-hover:scale-110 transition-transform duration-300"
                     style="background:{{ $g->warna }};border:2px solid #0f0e17;box-shadow:2px 2px 0 #0f0e17;">
                    {{ $g->kode }}
                </div>
                <p class="judul-komik text-lg text-[#0f0e17] group-hover:text-[#4361ee] transition-colors">{{ $g->kode }}</p>
                <p class="text-xs font-bold text-gray-400 mt-0.5 leading-tight">{{ Str::limit($g->nama, 20) }}</p>
                <p class="text-xs font-black text-gray-300 mt-1">{{ $g->program->count() }} program</p>
            </a>
            @endforeach
        </div>
    </div>

    {{-- TOMBOL CTA BAWAH --}}
    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10 akan-muncul" style="animation-delay:.4s">
        <a href="/analisis-minat" data-tautan-spa
           class="btn-komik px-6 py-3 bg-gray-100 text-[#0f0e17] rounded-xl text-sm">
            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
            Tes Ulang
        </a>
        <a href="/program" data-tautan-spa
           class="btn-komik px-8 py-3 bg-[#4361ee] text-white rounded-xl text-sm">
            <i data-lucide="book-open" class="w-4 h-4"></i>
            Lihat Semua Program
        </a>
        @guest
        <a href="/daftar" data-tautan-spa
           class="btn-komik px-8 py-3 bg-[#f72585] text-white rounded-xl text-sm">
            <i data-lucide="rocket" class="w-4 h-4"></i>
            Daftar Gratis Sekarang!
        </a>
        @endguest
    </div>

</div>

@push('skrip')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animasi bar skor
    document.querySelectorAll('[data-target]').forEach(el => {
        const target = parseInt(el.getAttribute('data-target'));
        el.style.width = '0%';
        setTimeout(() => {
            el.style.width = target + '%';
        }, 500);
    });

    // Konfeti sederhana
    const ikon = document.getElementById('ikon-hasil');
    if (ikon) {
        gsap.fromTo(ikon,
            { scale: 0, rotation: -20 },
            { scale: 1, rotation: 0, duration: 0.8, ease: 'back.out(1.7)', delay: 0.3 }
        );
    }
});
</script>
@endpush
@endsection
