@extends('tataletak.admin')
@section('judul','Detail Pertemuan')
@section('konten')
<div class="flex gap-3 mb-5 flex-wrap">
    <a href="/admin/pertemuan" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">← Kembali</a>
    <a href="/admin/pertemuan/{{ $pertemuan->id }}/edit" class="btn-komik px-4 py-2 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-sm">✏️ Edit</a>
    @if($pertemuan->status === 'terjadwal')
    <form method="POST" action="/admin/pertemuan/{{ $pertemuan->id }}/mulai">@csrf<button class="btn-komik px-4 py-2 bg-[#f72585] text-white rounded-xl text-sm">▶ Mulai Pertemuan</button></form>
    @elseif($pertemuan->status === 'berlangsung')
    <form method="POST" action="/admin/pertemuan/{{ $pertemuan->id }}/selesai">@csrf<button class="btn-komik px-4 py-2 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-sm">■ Akhiri Pertemuan</button></form>
    @endif
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="kartu-admin p-6">
            @php $wb=['terjadwal'=>'bg-[#4361ee] text-white','berlangsung'=>'bg-[#f72585] text-white','selesai'=>'bg-[#06d6a0] text-[#1a1a2e]','batal'=>'bg-gray-200 text-gray-600'] @endphp
            <span class="badge-komik {{ $wb[$pertemuan->status] ?? '' }} text-sm mb-3 inline-block">{{ $pertemuan->label_status }}</span>
            <h2 class="judul-komik text-3xl text-[#1a1a2e] mb-2">{{ $pertemuan->judul }}</h2>
            @if($pertemuan->deskripsi)<p class="text-gray-600 font-bold">{{ $pertemuan->deskripsi }}</p>@endif
        </div>

        <div class="kartu-admin p-6">
            <h3 class="judul-komik text-xl text-[#1a1a2e] mb-4">📋 INFO PERTEMUAN</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                @php $info = [
                    ['label'=>'Program','nilai'=>$pertemuan->program->nama],
                    ['label'=>'Platform','nilai'=>$pertemuan->label_platform],
                    ['label'=>'Jadwal','nilai'=>$pertemuan->dijadwalkan_pada->translatedFormat('d F Y, H:i').' WIB'],
                    ['label'=>'Durasi','nilai'=>$pertemuan->durasi_menit.' menit'],
                    ['label'=>'ID Ruangan','nilai'=>$pertemuan->id_ruangan],
                    ['label'=>'Kata Sandi','nilai'=>$pertemuan->kata_sandi ?? '—'],
                    ['label'=>'Dibuat oleh','nilai'=>$pertemuan->pembuat->nama],
                    ['label'=>'Maks Peserta','nilai'=>$pertemuan->maks_peserta],
                ]; @endphp
                @foreach($info as $i)
                <div class="bg-[#f0f4ff] rounded-xl p-3" style="border:2px solid #e5e7f0;">
                    <p class="text-xs font-black text-gray-400 mb-1">{{ $i['label'] }}</p>
                    <p class="font-black text-[#1a1a2e]">{{ $i['nilai'] }}</p>
                </div>
                @endforeach
            </div>
            @if($pertemuan->tautan_gabung)
            <div class="mt-4 bg-[#ffd60a] p-4 rounded-xl" style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                <p class="font-black text-[#1a1a2e] text-sm">🔗 Tautan: <a href="{{ $pertemuan->tautan_gabung }}" target="_blank" class="underline break-all">{{ $pertemuan->tautan_gabung }}</a></p>
            </div>
            @endif
        </div>
    </div>

    <div class="space-y-5">
        {{-- Peserta --}}
        <div class="kartu-admin overflow-hidden">
            <div class="bg-[#1a1a2e] px-4 py-3 flex items-center justify-between">
                <h3 class="judul-komik text-lg text-white">👥 PESERTA ({{ $pertemuan->peserta->count() }})</h3>
                <a href="/admin/pertemuan/{{ $pertemuan->id }}/peserta" class="text-[#ffd60a] text-xs font-black">Kelola →</a>
            </div>
            <div class="divide-y-2 divide-gray-50 max-h-64 overflow-y-auto">
                @forelse($pertemuan->peserta->take(8) as $peserta)
                <div class="flex items-center gap-3 px-4 py-2.5">
                    <div class="w-7 h-7 rounded-full bg-[#4361ee] flex items-center justify-center text-white text-xs font-black">
                        {{ strtoupper(substr($peserta->pengguna->nama,0,1)) }}
                    </div>
                    <div>
                        <p class="font-black text-[#1a1a2e] text-xs">{{ $peserta->pengguna->nama }}</p>
                        <p class="text-xs text-gray-400">{{ $peserta->hadir ? '✅ Hadir' : '—' }}</p>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-400 font-black text-sm">Belum ada peserta</div>
                @endforelse
            </div>
        </div>

        @if($pertemuan->tautan_rekaman)
        <div class="kartu-admin p-4">
            <p class="font-black text-[#1a1a2e] text-sm mb-2">📹 Rekaman Tersedia:</p>
            <a href="{{ $pertemuan->tautan_rekaman }}" target="_blank" class="btn-komik w-full py-2 bg-[#7209b7] text-white rounded-xl text-sm text-center block">▶ Tonton Rekaman</a>
        </div>
        @endif
    </div>
</div>
@endsection
