@extends('tataletak.aplikasi')
@section('judul','Para Pengajar')
@section('konten')

{{-- Header --}}
<section class="halftone py-16 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-5 py-2 text-white text-sm font-black mb-4">
            <i data-lucide="users" class="w-4 h-4 text-[#ffd60a]"></i>
            Tim Pengajar Profesional
        </div>
        <h1 class="judul-komik text-6xl md:text-7xl text-white mb-3"
            style="text-shadow:4px 4px 0 rgba(0,0,0,0.3);">PARA AHLI KAMI</h1>
        <p class="text-blue-100 font-bold text-lg max-w-xl mx-auto">
            Belajar langsung dari praktisi industri aktif — bukan sekedar teori, tapi pengalaman nyata!
        </p>
    </div>
</section>

{{-- Pengajar Cards --}}
<div class="max-w-6xl mx-auto px-4 py-16">
    @if($pengajar->isEmpty())
    <div class="kartu-komik p-16 text-center">
        <i data-lucide="users" class="w-16 h-16 mx-auto mb-4 text-gray-200"></i>
        <p class="judul-komik text-3xl text-gray-400">Segera hadir pengajar terbaik!</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($pengajar as $p)
        <div class="kartu-komik overflow-hidden group akan-muncul" style="animation-delay:{{ $loop->index * 0.1 }}s">
            {{-- Header card warna --}}
            <div class="h-32 relative" style="background:linear-gradient(135deg,#4361ee,#7209b7);">
                <div class="absolute inset-0 opacity-20"
                     style="background-image:radial-gradient(#fff 1px,transparent 1px);background-size:16px 16px;"></div>
                {{-- Rating badge --}}
                <div class="absolute top-3 right-3 flex items-center gap-1 bg-[#ffd60a] rounded-full px-3 py-1"
                     style="border:2px solid #0f0e17;box-shadow:2px 2px 0 #0f0e17;">
                    <i data-lucide="star" class="w-3.5 h-3.5 text-[#0f0e17] fill-current"></i>
                    <span class="text-xs font-black text-[#0f0e17]">{{ $p->rating }}.0</span>
                </div>
                {{-- Avatar --}}
                <div class="absolute -bottom-8 left-6 w-16 h-16 rounded-2xl bg-[#ffd60a] flex items-center justify-center text-[#0f0e17] font-black text-2xl judul-komik"
                     style="border:4px solid #0f0e17;box-shadow:4px 4px 0 #0f0e17;">
                    {{ strtoupper(substr($p->nama, 0, 1)) }}
                </div>
            </div>

            <div class="pt-10 p-6">
                <h3 class="judul-komik text-2xl text-[#0f0e17] mb-0.5">{{ $p->nama }}</h3>
                <p class="text-sm font-bold text-[#4361ee] mb-2">{{ $p->institusi }}</p>
                <p class="text-sm font-semibold text-gray-500 leading-relaxed mb-4 line-clamp-3">{{ $p->bio }}</p>

                {{-- Keahlian tags --}}
                <div class="flex flex-wrap gap-1.5 mb-4">
                    @foreach(array_slice(explode(',', $p->keahlian ?? ''), 0, 3) as $skill)
                    @if(trim($skill))
                    <span class="text-xs font-black bg-[#f0f4ff] text-[#4361ee] px-2.5 py-1 rounded-lg"
                          style="border:1.5px solid #4361ee40;">{{ trim($skill) }}</span>
                    @endif
                    @endforeach
                </div>

                {{-- Statistik --}}
                <div class="flex items-center gap-4 pt-4 border-t-2 border-gray-100">
                    <div class="flex items-center gap-1.5 text-sm font-black text-gray-600">
                        <i data-lucide="users" class="w-4 h-4 text-[#4361ee]"></i>
                        {{ number_format($p->total_pelajar) }} pelajar
                    </div>
                    <div class="flex items-center gap-1.5 text-sm font-black text-gray-600">
                        <i data-lucide="book-open" class="w-4 h-4 text-[#06d6a0]"></i>
                        {{ $p->kelasDiajar->count() }} kelas
                    </div>
                </div>

                {{-- Social links --}}
                @if($p->linkedin || $p->github)
                <div class="flex gap-2 mt-3">
                    @if($p->linkedin)
                    <a href="{{ $p->linkedin }}" target="_blank"
                       class="btn-komik px-3 py-1.5 bg-[#0077b5] text-white rounded-lg text-xs">
                        <i data-lucide="linkedin" class="w-3.5 h-3.5"></i>
                    </a>
                    @endif
                    @if($p->github)
                    <a href="{{ $p->github }}" target="_blank"
                       class="btn-komik px-3 py-1.5 bg-[#0f0e17] text-white rounded-lg text-xs">
                        <i data-lucide="github" class="w-3.5 h-3.5"></i>
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- CTA Jadi Pengajar --}}
    <div class="mt-16 kartu-komik p-10 text-center bg-gradient-to-r from-[#4361ee] to-[#7209b7] text-white akan-muncul">
        <i data-lucide="graduation-cap" class="w-12 h-12 mx-auto mb-4 text-[#ffd60a]"></i>
        <h2 class="judul-komik text-4xl mb-3">INGIN JADI PENGAJAR?</h2>
        <p class="font-bold text-blue-200 max-w-lg mx-auto mb-6">
            Bagikan keahlianmu kepada ribuan pelajar Indonesia. Daftar sebagai pengajar di Gelar.id dan mulai
            membuat dampak nyata!
        </p>
        <a href="/masuk" data-tautan-spa
           class="btn-komik px-8 py-4 bg-[#ffd60a] text-[#0f0e17] rounded-2xl text-lg inline-flex">
            <i data-lucide="send" class="w-5 h-5"></i>
            Hubungi Kami
        </a>
    </div>
</div>
@endsection
