@extends('tataletak.aplikasi')
@section('judul','Detail Pertemuan')
@section('konten')
<div class="max-w-3xl mx-auto px-4 py-10">
    <a href="/pengguna/pertemuan" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm mb-6 inline-flex">← Kembali</a>

    <div class="kartu-komik overflow-hidden mb-6">
        <div class="h-3" style="background:{{ $pertemuan->program->jenisGelar->warna }}"></div>
        <div class="p-6">
            <div class="flex flex-wrap items-start justify-between gap-4 mb-4">
                <div>
                    @php $wb=['terjadwal'=>'bg-[#4361ee] text-white','berlangsung'=>'bg-[#f72585] text-white','selesai'=>'bg-[#06d6a0] text-[#1a1a2e]','batal'=>'bg-gray-200 text-gray-600'] @endphp
                    <span class="badge-komik {{ $wb[$pertemuan->status] ?? 'bg-gray-100' }} text-sm mb-2 inline-block">{{ $pertemuan->label_status }}</span>
                    <h1 class="judul-komik text-4xl text-[#1a1a2e]">{{ $pertemuan->judul }}</h1>
                    <p class="text-gray-600 font-bold mt-1">{{ $pertemuan->program->nama }}</p>
                </div>
                <div class="text-5xl">{{ $pertemuan->platform === 'zoom' ? '🎥' : ($pertemuan->platform === 'meet' ? '📹' : '🏠') }}</div>
            </div>

            @if($pertemuan->deskripsi)
            <p class="text-gray-700 font-semibold mb-5 p-4 bg-[#f0f4ff] rounded-2xl border-2 border-[#4361ee]">{{ $pertemuan->deskripsi }}</p>
            @endif

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-6">
                @php $info = [
                    ['ikon'=>'📅','label'=>'Jadwal','nilai'=>$pertemuan->dijadwalkan_pada->translatedFormat('d F Y, H:i').' WIB'],
                    ['ikon'=>'⏱️','label'=>'Durasi','nilai'=>$pertemuan->durasi_menit.' Menit'],
                    ['ikon'=>'🖥️','label'=>'Platform','nilai'=>$pertemuan->label_platform],
                    ['ikon'=>'👥','label'=>'Peserta','nilai'=>$pertemuan->peserta->count().' / '.$pertemuan->maks_peserta],
                    ['ikon'=>'🏠','label'=>'ID Ruangan','nilai'=>$pertemuan->id_ruangan],
                    ['ikon'=>'👨‍🏫','label'=>'Pengajar','nilai'=>$pertemuan->pembuat->nama],
                ] @endphp
                @foreach($info as $i)
                <div class="bg-[#f0f4ff] rounded-2xl p-4 border-2 border-gray-100">
                    <p class="text-xs font-black text-gray-500 mb-1">{{ $i['ikon'] }} {{ $i['label'] }}</p>
                    <p class="font-black text-[#1a1a2e] text-sm">{{ $i['nilai'] }}</p>
                </div>
                @endforeach
            </div>

            @if($pertemuan->kata_sandi)
            <div class="bg-[#ffd60a] rounded-2xl p-4 mb-5" style="border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;">
                <p class="font-black text-[#1a1a2e]">🔑 Kata Sandi: <code class="bg-white px-3 py-1 rounded-lg font-mono">{{ $pertemuan->kata_sandi }}</code></p>
            </div>
            @endif

            <div class="flex flex-wrap gap-3">
                @if($pertemuan->status === 'berlangsung')
                <form method="POST" action="/pengguna/pertemuan/{{ $pertemuan->id }}/gabung">
                    @csrf
                    <button type="submit" class="btn-komik px-8 py-4 bg-[#f72585] text-white rounded-2xl text-lg">🚀 GABUNG SEKARANG!</button>
                </form>
                @elseif($pertemuan->status === 'terjadwal')
                <div class="btn-komik px-6 py-3 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-sm cursor-not-allowed">⏳ Belum Dimulai</div>
                @endif
                @if($pertemuan->tautan_rekaman)
                <a href="{{ $pertemuan->tautan_rekaman }}" target="_blank" class="btn-komik px-6 py-3 bg-[#7209b7] text-white rounded-xl text-sm">▶ Tonton Rekaman</a>
                @endif
            </div>
        </div>
    </div>

    @if($sudahGabung && $sudahGabung->hadir)
    <div class="kartu-komik p-5 bg-[#06d6a0]">
        <p class="font-black text-[#1a1a2e]">✅ Anda sudah hadir di pertemuan ini</p>
        @if($sudahGabung->bergabung_pada)
        <p class="text-sm font-bold text-[#1a1a2e] mt-1">Bergabung: {{ $sudahGabung->bergabung_pada->format('H:i') }}</p>
        @endif
    </div>
    @endif
</div>
@endsection
