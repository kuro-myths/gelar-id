@extends('tataletak.aplikasi')
@section('judul','Pertemuan Saya')
@section('konten')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="judul-komik text-5xl text-[#1a1a2e] mb-2">🎥 PERTEMUANKU</h1>
    <p class="text-gray-600 font-bold mb-8">Jadwal meeting & kelas online kamu</p>

    {{-- Mendatang --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-5">
            <div class="bg-[#4361ee] text-white judul-komik text-lg px-5 py-2 rounded-xl" style="border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;">📅 MENDATANG</div>
        </div>
        @if($pertemuan->isEmpty())
        <div class="kartu-komik p-12 text-center">
            <div class="text-6xl mb-3">📭</div>
            <p class="judul-komik text-2xl text-gray-400">Tidak ada pertemuan terjadwal</p>
            <a href="/program" class="btn-komik mt-4 inline-flex px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">Daftar Program Dulu!</a>
        </div>
        @else
        <div class="space-y-4">
            @foreach($pertemuan as $p)
            <div class="kartu-komik overflow-hidden">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-5">
                    <div class="w-16 h-16 rounded-2xl flex-shrink-0 flex items-center justify-center text-white text-2xl font-black" style="background:{{ $p->program->jenisGelar->warna }};border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                        @if($p->platform === 'zoom') 🎥
                        @elseif($p->platform === 'meet') 📹
                        @else 🏠
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="badge-komik text-white text-xs" style="background:{{ $p->program->jenisGelar->warna }};border-color:#1a1a2e;">{{ $p->program->jenisGelar->kode }}</span>
                            @php $wb=['terjadwal'=>'bg-[#4361ee] text-white','berlangsung'=>'bg-[#f72585] text-white','selesai'=>'bg-[#06d6a0] text-[#1a1a2e]'] @endphp
                            <span class="badge-komik {{ $wb[$p->status] ?? 'bg-gray-100' }} text-xs">{{ $p->label_status }}</span>
                        </div>
                        <h3 class="font-black text-[#1a1a2e] text-lg">{{ $p->judul }}</h3>
                        <p class="text-sm font-bold text-gray-500">
                            📅 {{ $p->dijadwalkan_pada->translatedFormat('l, d F Y — H:i') }} WIB
                            &nbsp;·&nbsp; ⏱️ {{ $p->durasi_menit }} menit
                            &nbsp;·&nbsp; {{ $p->label_platform }}
                        </p>
                    </div>
                    <div class="flex flex-col gap-2 flex-shrink-0">
                        <a href="/pengguna/pertemuan/{{ $p->id }}" class="btn-komik px-4 py-2 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-sm">Detail</a>
                        @if($p->status === 'berlangsung')
                        <form method="POST" action="/pengguna/pertemuan/{{ $p->id }}/gabung">
                            @csrf
                            <button type="submit" class="btn-komik w-full px-4 py-2 bg-[#f72585] text-white rounded-xl text-sm">🔴 Gabung!</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $pertemuan->links() }}</div>
        @endif
    </div>

    {{-- Selesai --}}
    @if($pertemuanSelesai->isNotEmpty())
    <div>
        <div class="flex items-center gap-3 mb-5">
            <div class="bg-[#06d6a0] text-[#1a1a2e] judul-komik text-lg px-5 py-2 rounded-xl" style="border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;">✅ SUDAH SELESAI</div>
        </div>
        <div class="space-y-3">
            @foreach($pertemuanSelesai as $p)
            <div class="bg-white rounded-2xl p-4 flex items-center gap-4" style="border:2px solid #e5e7f0;">
                <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-lg">✅</div>
                <div class="flex-1">
                    <p class="font-black text-gray-700">{{ $p->judul }}</p>
                    <p class="text-xs font-bold text-gray-400">{{ $p->dijadwalkan_pada->translatedFormat('d F Y') }} · {{ $p->program->nama }}</p>
                </div>
                @if($p->tautan_rekaman)
                <a href="{{ $p->tautan_rekaman }}" target="_blank" class="btn-komik px-3 py-1.5 bg-[#7209b7] text-white rounded-lg text-xs">▶ Rekaman</a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
