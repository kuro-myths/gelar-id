@extends('tataletak.aplikasi')
@section('judul','Jenis Gelar')
@section('konten')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <div class="inline-block bg-[#ffd60a] judul-komik text-2xl px-8 py-3 rounded-2xl mb-4" style="border:3px solid #1a1a2e;box-shadow:5px 5px 0 #1a1a2e;">🎓 JENIS GELAR</div>
        <h1 class="judul-komik text-6xl text-[#1a1a2e] mb-3">Pilih Jalurmu!</h1>
        <p class="text-gray-600 font-bold max-w-xl mx-auto">Dari pemula K1 sampai ahli KVT.Kom — semua bisa kamu raih!</p>
    </div>
    @php $kelompok = $jenisGelar->groupBy('kategori'); $labelKategori=['sarjana'=>'🎓 Sarjana Virtual','vokasi'=>'💼 Vokasi Virtual','diploma'=>'📜 Diploma Virtual (K1–K6)']; @endphp
    @foreach($labelKategori as $kat=>$label)
    @if($kelompok->has($kat))
    <div class="mb-14">
        <div class="flex items-center gap-3 mb-6">
            <div class="h-1.5 w-10 bg-[#4361ee] rounded-full" style="border:2px solid #1a1a2e;"></div>
            <h2 class="judul-komik text-4xl text-[#1a1a2e]">{{ $label }}</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 {{ $kat=='diploma'?'lg:grid-cols-6':'lg:grid-cols-3' }} gap-5">
            @foreach($kelompok[$kat] as $g)
            <a href="/program?gelar={{ $g->kode }}" class="kartu-komik overflow-hidden group">
                <div class="h-2" style="background:{{ $g->warna }}"></div>
                <div class="p-5">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-black text-sm mb-4 mx-auto" style="background:{{ $g->warna }};border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">{{ $g->kode }}</div>
                    <h3 class="judul-komik text-xl text-[#1a1a2e] mb-1 text-center group-hover:text-[#4361ee] transition-colors">{{ $g->kode }}</h3>
                    <p class="text-xs font-bold text-gray-500 mb-3 text-center">{{ $g->nama }}</p>
                    <p class="text-xs font-semibold text-gray-400 mb-4 line-clamp-3">{{ $g->deskripsi }}</p>
                    <div class="flex justify-between text-xs font-black text-gray-500">
                        <span>⏱️ {{ $g->durasi_bulan }}bln</span>
                        <span>📖 {{ $g->sks_dibutuhkan }}SKS</span>
                    </div>
                    <div class="mt-3 text-center">
                        <span class="badge-komik text-xs text-white" style="background:{{ $g->warna }};border-color:#1a1a2e;">{{ $g->program->count() }} program</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection
