@extends('tataletak.aplikasi')
@section('judul','Program Studi')
@section('konten')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-8">
        <h1 class="judul-komik text-5xl text-[#1a1a2e] mb-2">📚 PROGRAM STUDI</h1>
        <p class="text-gray-600 font-bold">Temukan program yang sesuai dengan tujuanmu!</p>
    </div>
    <div class="flex flex-col md:flex-row gap-6">
        {{-- Filter --}}
        <aside class="w-full md:w-56 flex-shrink-0">
            <div class="kartu-komik p-5 sticky top-20">
                <h3 class="judul-komik text-lg text-[#1a1a2e] mb-4">⚡ FILTER</h3>
                <div class="space-y-1">
                    <a href="/program" class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-black {{ !request('gelar') ? 'bg-[#4361ee] text-white' : 'text-[#1a1a2e] hover:bg-[#f0f4ff]' }}" style="{{ !request('gelar') ? 'border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;' : '' }}">
                        🎓 Semua Gelar
                    </a>
                    @foreach($jenisGelar as $g)
                    <a href="/program?gelar={{ $g->kode }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-black transition-all {{ request('gelar')==$g->kode ? 'text-white' : 'text-[#1a1a2e] hover:bg-[#f0f4ff]' }}"
                       style="{{ request('gelar')==$g->kode ? 'background:'.$g->warna.';border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;' : '' }}">
                        <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:{{ $g->warna }};border:1px solid #1a1a2e;"></span>
                        {{ $g->kode }}
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <div class="flex-1">
            <form method="GET" action="/program" class="flex gap-2 mb-6">
                @if(request('gelar'))<input type="hidden" name="gelar" value="{{ request('gelar') }}">@endif
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="🔍 Cari program..."
                       class="input-komik flex-1 px-4 py-3 text-sm">
                <button type="submit" class="btn-komik px-5 py-3 bg-[#4361ee] text-white rounded-xl text-sm">Cari!</button>
            </form>

            @if($program->isEmpty())
            <div class="kartu-komik p-16 text-center">
                <div class="text-6xl mb-4">🔍</div>
                <p class="judul-komik text-2xl text-gray-400">Program tidak ditemukan!</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach($program as $p)
                <div class="kartu-komik overflow-hidden">
                    <div class="h-2" style="background:{{ $p->jenisGelar->warna }}"></div>
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-3">
                            <span class="badge-komik text-white text-xs" style="background:{{ $p->jenisGelar->warna }};border-color:#1a1a2e;">{{ $p->jenisGelar->kode }}</span>
                            @if($p->gratis)
                                <span class="badge-komik bg-[#06d6a0] text-[#1a1a2e] text-xs">GRATIS!</span>
                            @else
                                <span class="judul-komik text-lg text-[#1a1a2e]">Rp {{ number_format($p->harga,0,',','.') }}</span>
                            @endif
                        </div>
                        <h3 class="font-black text-[#1a1a2e] text-base mb-2 leading-snug">{{ $p->nama }}</h3>
                        <p class="text-xs font-semibold text-gray-500 mb-4 line-clamp-2">{{ $p->deskripsi }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-black text-gray-500">👥 {{ $p->jumlah_peserta }} peserta</span>
                            @auth
                            <form method="POST" action="/pengguna/daftar/{{ $p->id }}">
                                @csrf
                                <button type="submit" class="btn-komik px-4 py-2 text-white text-xs rounded-xl" style="background:{{ $p->jenisGelar->warna }}">Daftar!</button>
                            </form>
                            @else
                            <a href="/masuk" class="btn-komik px-4 py-2 bg-[#4361ee] text-white text-xs rounded-xl">Masuk & Daftar</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $program->withQueryString()->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
