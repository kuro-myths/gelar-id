@extends('tataletak.aplikasi')
@section('judul','Pendaftaran Saya')
@section('konten')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="judul-komik text-5xl text-[#1a1a2e]">📚 DAFTARKU</h1>
            <p class="text-gray-600 font-bold">Semua program yang kamu ikuti</p>
        </div>
        <a href="/program" class="btn-komik px-5 py-3 bg-[#4361ee] text-white rounded-xl text-sm">
            🔍 Cari Program Baru
        </a>
    </div>

    @if($pendaftaran->isEmpty())
    <div class="kartu-komik p-16 text-center">
        <div class="text-7xl mb-4">📭</div>
        <p class="judul-komik text-3xl text-gray-400 mb-2">Belum Ada Pendaftaran</p>
        <p class="text-gray-500 font-bold mb-6">Yuk daftar program dan mulai belajar!</p>
        <a href="/program" class="btn-komik px-6 py-3 bg-[#4361ee] text-white rounded-xl inline-flex">
            🚀 Jelajahi Program
        </a>
    </div>
    @else
    <div class="space-y-4">
        @foreach($pendaftaran as $p)
        @php
            $warna = ['menunggu'=>['bg-[#ffd60a]','text-[#1a1a2e]'],'aktif'=>['bg-[#4361ee]','text-white'],'selesai'=>['bg-[#06d6a0]','text-[#1a1a2e]'],'batal'=>['bg-[#f72585]','text-white']];
            $w = $warna[$p->status] ?? ['bg-gray-100','text-gray-600'];
        @endphp
        <div class="kartu-komik overflow-hidden">
            <div class="flex flex-col sm:flex-row">
                {{-- Strip warna gelar --}}
                <div class="w-full sm:w-2 h-2 sm:h-auto flex-shrink-0" style="background:{{ $p->program->jenisGelar->warna }}"></div>
                <div class="flex-1 p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    {{-- Badge gelar --}}
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-black text-sm flex-shrink-0 judul-komik text-base"
                         style="background:{{ $p->program->jenisGelar->warna }};border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                        {{ $p->program->jenisGelar->kode }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="badge-komik {{ $w[0] }} {{ $w[1] }} text-xs">{{ $p->label_status }}</span>
                            @if($p->kemajuan > 0)
                            <span class="badge-komik bg-gray-100 text-gray-700 text-xs">📈 {{ $p->kemajuan }}%</span>
                            @endif
                        </div>
                        <h3 class="font-black text-[#1a1a2e] text-lg leading-tight">{{ $p->program->nama }}</h3>
                        <p class="text-xs font-bold text-gray-500 mt-1">
                            📋 {{ $p->nomor_pendaftaran }}
                            &nbsp;·&nbsp; 📅 Daftar {{ $p->terdaftar_pada?->format('d M Y') ?? $p->created_at->format('d M Y') }}
                            @if($p->jumlah_bayar > 0) &nbsp;·&nbsp; 💰 Rp {{ number_format($p->jumlah_bayar,0,',','.') }} @endif
                        </p>

                        {{-- Progress bar --}}
                        @if($p->status === 'aktif')
                        <div class="mt-2 w-full max-w-xs">
                            <div class="w-full bg-gray-100 rounded-full h-2" style="border:1px solid #e5e7eb;">
                                <div class="h-2 rounded-full transition-all" style="width:{{ $p->kemajuan }}%;background:{{ $p->program->jenisGelar->warna }};"></div>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="flex flex-wrap gap-2 flex-shrink-0">
                        @if($p->status === 'aktif')
                        <a href="/pengguna/kemajuan/{{ $p->id }}"
                           class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-xs">
                            📈 Kemajuan
                        </a>
                        @endif
                        @if($p->status === 'selesai' && $p->sertifikat)
                        <a href="/pengguna/sertifikat-ku"
                           class="btn-komik px-4 py-2 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-xs">
                            🏆 Sertifikat
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $pendaftaran->links() }}</div>
    @endif
</div>
@endsection
