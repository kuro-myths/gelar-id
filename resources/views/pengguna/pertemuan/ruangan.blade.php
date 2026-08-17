@extends('tataletak.aplikasi')
@section('judul','Ruang Meeting')
@section('konten')
<div class="max-w-4xl mx-auto px-4 py-10">
    {{-- Header Ruangan --}}
    <div class="kartu-komik p-5 mb-6 bg-gradient-to-r from-[#4361ee] to-[#7209b7] text-white">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-3 h-3 rounded-full bg-[#f72585] animate-pulse"></div>
                    <span class="badge-komik bg-[#f72585] text-white text-xs">🔴 BERLANGSUNG</span>
                </div>
                <h1 class="judul-komik text-3xl">{{ $pertemuan->judul }}</h1>
                <p class="font-bold text-blue-200 text-sm">{{ $pertemuan->program->nama }}</p>
            </div>
            <div class="text-right">
                <p class="font-black text-[#ffd60a] text-lg">ID: {{ $pertemuan->id_ruangan }}</p>
                <p class="text-sm text-blue-200 font-bold">{{ $pertemuan->dijadwalkan_pada->format('H:i') }} — {{ $pertemuan->dijadwalkan_pada->addMinutes($pertemuan->durasi_menit)->format('H:i') }} WIB</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Area Video/Konten --}}
        <div class="lg:col-span-2">
            <div class="kartu-komik overflow-hidden">
                <div class="bg-[#1a1a2e] aspect-video flex items-center justify-center">
                    <div class="text-center text-white">
                        <div class="text-8xl mb-4">🎥</div>
                        <p class="judul-komik text-3xl text-[#ffd60a]">RUANG MEETING INTERNAL</p>
                        <p class="text-gray-400 font-bold mt-2">{{ $pertemuan->judul }}</p>
                        @if($pertemuan->tautan_gabung)
                        <a href="{{ $pertemuan->tautan_gabung }}" target="_blank"
                           class="btn-komik mt-5 inline-flex px-6 py-3 bg-[#f72585] text-white rounded-xl text-lg">
                            🚀 Buka Meeting Eksternal
                        </a>
                        @endif
                    </div>
                </div>
                <div class="p-4 bg-[#f0f4ff]">
                    <p class="font-black text-[#1a1a2e] text-sm">{{ $pertemuan->deskripsi }}</p>
                </div>
            </div>
            {{-- Keluar --}}
            <form method="POST" action="/pengguna/pertemuan/{{ $pertemuan->id }}/keluar" class="mt-4">
                @csrf
                <button type="submit" class="btn-komik w-full py-3 bg-[#f72585] text-white rounded-xl text-sm"
                        onclick="return confirm('Keluar dari ruang meeting?')">
                    🚪 Keluar dari Ruangan
                </button>
            </form>
        </div>

        {{-- Daftar Peserta --}}
        <div class="kartu-komik overflow-hidden">
            <div class="bg-[#1a1a2e] px-4 py-3">
                <h3 class="judul-komik text-lg text-white">👥 PESERTA ({{ $peserta->count() }})</h3>
            </div>
            <div class="divide-y-2 divide-gray-100 max-h-80 overflow-y-auto">
                @forelse($peserta as $p)
                <div class="flex items-center gap-3 px-4 py-3">
                    <div class="w-8 h-8 rounded-full bg-[#4361ee] flex items-center justify-center text-white text-xs font-black">
                        {{ strtoupper(substr($p->pengguna->nama, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-black text-[#1a1a2e] text-sm">{{ $p->pengguna->nama }}</p>
                        <p class="text-xs text-gray-400 font-bold">
                            {{ $p->hadir ? '✅ Hadir' : '⏳ Terdaftar' }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-400">
                    <p class="font-black">Belum ada peserta</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
