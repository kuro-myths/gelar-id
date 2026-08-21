@extends('tataletak.aplikasi')
@section('judul','Dasbor Saya')
@section('konten')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- Sapaan --}}
    <div class="kartu-komik p-6 mb-8 bg-gradient-to-r from-[#4361ee] to-[#7209b7] text-white">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-[#ffd60a] border-3 border-[#1a1a2e] flex items-center justify-center judul-komik text-[#1a1a2e] text-3xl" style="border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                {{ strtoupper(substr(auth()->user()->nama,0,1)) }}
            </div>
            <div>
                <h1 class="judul-komik text-4xl">Halo, {{ auth()->user()->nama }}! 👋</h1>
                <p class="font-bold text-blue-200">NIM: <span class="font-mono text-[#ffd60a]">{{ auth()->user()->nim ?? '-' }}</span></p>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @php $kartu = [
            ['label'=>'Total Daftar','nilai'=>$statistik['total'],'ikon'=>'📚','warna'=>'bg-[#4361ee]','teks'=>'text-white'],
            ['label'=>'Aktif','nilai'=>$statistik['aktif'],'ikon'=>'⚡','warna'=>'bg-[#06d6a0]','teks'=>'text-[#1a1a2e]'],
            ['label'=>'Selesai','nilai'=>$statistik['selesai'],'ikon'=>'✅','warna'=>'bg-[#ffd60a]','teks'=>'text-[#1a1a2e]'],
            ['label'=>'Sertifikat','nilai'=>$statistik['sertifikat'],'ikon'=>'🏆','warna'=>'bg-[#f72585]','teks'=>'text-white'],
        ]; @endphp
        @foreach($kartu as $k)
        <div class="kartu-komik p-5 {{ $k['warna'] }} {{ $k['teks'] }}">
            <div class="text-3xl mb-2">{{ $k['ikon'] }}</div>
            <div class="judul-komik text-4xl">{{ $k['nilai'] }}</div>
            <div class="text-sm font-black mt-1 opacity-80">{{ $k['label'] }}</div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Pendaftaran --}}
        <div class="lg:col-span-2 kartu-komik overflow-hidden">
            <div class="px-6 py-4 bg-[#1a1a2e] flex items-center justify-between">
                <h3 class="judul-komik text-xl text-white">📋 PENDAFTARAN TERAKHIR</h3>
                <a href="/pengguna/daftar-ku" class="text-[#ffd60a] font-black text-sm hover:underline">Lihat semua →</a>
            </div>
            @if($pendaftaran->isEmpty())
            <div class="p-12 text-center">
                <div class="text-6xl mb-3">📭</div>
                <p class="font-black text-gray-500">Belum ada pendaftaran!</p>
                <a href="/program" class="btn-komik mt-4 inline-flex px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
                    🔍 Jelajahi Program
                </a>
            </div>
            @else
            <div class="divide-y-2 divide-gray-100">
                @foreach($pendaftaran as $p)
                <div class="flex items-center gap-4 px-6 py-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-black text-xs flex-shrink-0"
                         style="background:{{ $p->program->jenisGelar->warna }};border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">
                        {{ $p->program->jenisGelar->kode }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-black text-[#1a1a2e] text-sm truncate">{{ $p->program->nama }}</p>
                        <p class="text-xs font-bold text-gray-400">{{ $p->nomor_pendaftaran }}</p>
                    </div>
                    @php $warna=['menunggu'=>['bg-[#ffd60a]','text-[#1a1a2e]'],'aktif'=>['bg-[#4361ee]','text-white'],'selesai'=>['bg-[#06d6a0]','text-[#1a1a2e]'],'batal'=>['bg-[#f72585]','text-white']] @endphp
                    <span class="badge-komik {{ $warna[$p->status][0] ?? 'bg-gray-100' }} {{ $warna[$p->status][1] ?? 'text-gray-700' }} text-xs">
                        {{ $p->label_status }}
                    </span>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">
            <div class="kartu-komik p-6 text-center">
                <div class="w-16 h-16 rounded-2xl bg-[#4361ee] flex items-center justify-center text-white judul-komik text-3xl mx-auto mb-3" style="border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                    {{ strtoupper(substr(auth()->user()->nama,0,1)) }}
                </div>
                <h4 class="font-black text-[#1a1a2e]">{{ auth()->user()->nama }}</h4>
                <p class="text-xs font-bold text-gray-500">{{ auth()->user()->email }}</p>
                @if(auth()->user()->institusi)
                <p class="text-xs font-bold text-[#4361ee] mt-1">🏢 {{ auth()->user()->institusi }}</p>
                @endif
                <a href="/pengguna/profil" class="btn-komik mt-4 w-full py-2.5 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-sm block text-center">
                    ✏️ Edit Profil
                </a>
            </div>

            <div class="kartu-komik p-5">
                <h4 class="judul-komik text-lg text-[#1a1a2e] mb-3">⚡ MENU CEPAT</h4>
                <div class="space-y-2">
                    @foreach([['/program','🔍 Jelajahi Program'],['/pengguna/sertifikat-ku','🏆 Sertifikat Saya'],['/verifikasi','🛡️ Verifikasi Sertifikat']] as $m)
                    <a href="{{ $m[0] }}" class="flex items-center gap-2 p-2.5 rounded-xl font-bold text-sm text-[#1a1a2e] hover:bg-[#f0f4ff] transition-colors">
                        {{ $m[1] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Panel Pencapaian + Beasiswa --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        {{-- Pencapaian terbaru --}}
        <div class="kartu-komik overflow-hidden">
            <div class="px-5 py-4 bg-[#7209b7] flex items-center justify-between">
                <h3 class="judul-komik text-xl text-white">🏆 PENCAPAIANKU</h3>
                <a href="/pengguna/pencapaian-ku" data-tautan-spa class="text-yellow-300 font-black text-sm hover:underline">Lihat semua →</a>
            </div>
            @php
            $pencapaianDiraih = auth()->user()->pencapaianDiraih()->with('pencapaian')->latest('diraih_pada')->take(4)->get();
            @endphp
            @if($pencapaianDiraih->isEmpty())
            <div class="p-8 text-center">
                <div class="text-4xl mb-2">🎯</div>
                <p class="font-black text-gray-500 text-sm">Belum ada pencapaian</p>
                <a href="/pengguna/pencapaian-ku" data-tautan-spa class="btn-komik mt-3 inline-flex px-4 py-2 bg-[#7209b7] text-white rounded-xl text-xs">
                    Lihat Semua Achievement
                </a>
            </div>
            @else
            <div class="p-4 grid grid-cols-2 gap-3">
                @foreach($pencapaianDiraih as $pp)
                <div class="flex items-center gap-2 bg-[#f0f4ff] border-2 border-[#e0e7ff] rounded-xl px-3 py-2">
                    <span class="text-xl">{{ $pp->pencapaian->ikon }}</span>
                    <span class="text-xs font-black text-[#0f0e17] leading-tight">{{ Str::limit($pp->pencapaian->nama,20) }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Beasiswa --}}
        <div class="kartu-komik overflow-hidden">
            <div class="px-5 py-4 bg-[#06d6a0] flex items-center justify-between">
                <h3 class="judul-komik text-xl text-[#0f0e17]">🎓 BEASISWAKU</h3>
                <a href="/beasiswa" data-tautan-spa class="text-[#0f0e17] font-black text-sm hover:underline">Lihat program →</a>
            </div>
            @php
            $pendaftaranBeasiswaSaya = auth()->user()->pendaftaranBeasiswa()->with('beasiswa')->latest()->take(3)->get();
            @endphp
            @if($pendaftaranBeasiswaSaya->isEmpty())
            <div class="p-8 text-center">
                <div class="text-4xl mb-2">🎁</div>
                <p class="font-black text-gray-500 text-sm">Belum mendaftar beasiswa</p>
                <a href="/beasiswa" data-tautan-spa class="btn-komik mt-3 inline-flex px-4 py-2 bg-[#06d6a0] text-[#0f0e17] rounded-xl text-xs">
                    Cari Beasiswa Gratis
                </a>
            </div>
            @else
            <div class="p-4 space-y-2">
                @foreach($pendaftaranBeasiswaSaya as $pb)
                <div class="flex items-center justify-between bg-[#f0f4ff] border-2 border-[#e0e7ff] rounded-xl px-3 py-2">
                    <div>
                        <p class="text-xs font-black text-[#0f0e17]">{{ Str::limit($pb->beasiswa->nama,28) }}</p>
                    </div>
                    <span class="badge-komik text-xs"
                          style="background:{{ $pb->warna_status }}22;border-color:{{ $pb->warna_status }};color:{{ $pb->warna_status }};">
                        {{ $pb->label_status }}
                    </span>
                </div>
                @endforeach
                <a href="/pengguna/beasiswa-ku" data-tautan-spa class="text-xs font-black text-[#4361ee] hover:underline">Lihat semua →</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

