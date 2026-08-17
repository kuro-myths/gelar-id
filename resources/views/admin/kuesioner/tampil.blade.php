@extends('tataletak.admin')
@section('judul','Detail Kuesioner')
@section('konten')
<div class="flex gap-3 mb-5 flex-wrap">
    <a href="/admin/kuesioner" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">← Kembali</a>
    <a href="/admin/kuesioner/{{ $kuesioner->id }}/pertanyaan" class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">📝 Kelola Soal</a>
    <form method="POST" action="/admin/kuesioner/{{ $kuesioner->id }}/toggle">
        @csrf<button class="btn-komik px-4 py-2 {{ $kuesioner->aktif ? 'bg-[#f72585] text-white' : 'bg-[#06d6a0] text-[#1a1a2e]' }} rounded-xl text-sm">{{ $kuesioner->aktif ? '❌ Nonaktifkan' : '✅ Aktifkan' }}</button>
    </form>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="kartu-admin p-6 mb-5">
            <span class="badge-komik bg-[#4361ee] text-white text-sm mb-3 inline-block">{{ $kuesioner->label_tipe }}</span>
            <h2 class="judul-komik text-3xl text-[#1a1a2e] mb-2">{{ $kuesioner->judul }}</h2>
            @if($kuesioner->deskripsi)<p class="text-gray-600 font-bold">{{ $kuesioner->deskripsi }}</p>@endif
            <div class="grid grid-cols-3 gap-4 mt-5">
                @php $info=[['label'=>'Pertanyaan','nilai'=>$kuesioner->pertanyaan->count(),'bg'=>'bg-[#4361ee]','txt'=>'text-white'],['label'=>'Respons','nilai'=>$respons->total(),'bg'=>'bg-[#06d6a0]','txt'=>'text-[#1a1a2e]'],['label'=>'Batas Waktu','nilai'=>$kuesioner->batas_waktu_menit>0?$kuesioner->batas_waktu_menit.' mnt':'Tak Terbatas','bg'=>'bg-[#ffd60a]','txt'=>'text-[#1a1a2e]']]; @endphp
                @foreach($info as $i)<div class="kartu-admin p-4 {{ $i['bg'] }} text-center"><div class="judul-komik text-3xl {{ $i['txt'] }}">{{ $i['nilai'] }}</div><div class="text-xs font-black {{ $i['txt'] }} opacity-80 mt-1">{{ $i['label'] }}</div></div>@endforeach
            </div>
        </div>

        {{-- Daftar Respons --}}
        <div class="kartu-admin overflow-hidden">
            <div class="bg-[#1a1a2e] px-4 py-3"><h3 class="judul-komik text-lg text-white">📊 RESPONS MASUK</h3></div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead style="background:#0f172a;color:white;">
                        <tr>@foreach(['MAHASISWA','NILAI','DISELESAIKAN','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
                    </thead>
                    <tbody>
                        @forelse($respons as $r)
                        <tr class="border-b-2 border-gray-50 hover:bg-[#f0f4ff]">
                            <td class="px-4 py-3">
                                <p class="font-black text-[#1a1a2e]">{{ $r->pengguna->nama }}</p>
                                <p class="text-xs text-gray-400">{{ $r->pengguna->email }}</p>
                            </td>
                            <td class="px-4 py-3">
                                @if($r->nilai_total !== null)
                                <span class="judul-komik text-xl text-[#1a1a2e]">{{ $r->nilai_total }}</span>
                                <span class="text-xs text-gray-400">/ {{ $kuesioner->getTotalBobot() }}</span>
                                @else <span class="text-gray-400 font-bold">—</span> @endif
                            </td>
                            <td class="px-4 py-3 text-xs font-bold text-gray-600">{{ $r->selesai_pada?->format('d M Y, H:i') ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <a href="/admin/respons/{{ $r->id }}" class="btn-komik px-3 py-1.5 bg-[#ffd60a] text-[#1a1a2e] rounded-lg text-xs">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-10 text-gray-400 font-black">Belum ada respons</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-t-2 border-gray-100">{{ $respons->links() }}</div>
        </div>
    </div>
    <div class="space-y-5">
        <div class="kartu-admin p-5">
            <h4 class="judul-komik text-lg text-[#1a1a2e] mb-3">📋 INFO</h4>
            @php $metaInfo = [['label'=>'Program','nilai'=>$kuesioner->program?->nama ?? 'Semua'],['label'=>'Sesi Belajar','nilai'=>$kuesioner->sesiBelajar?->judul ?? '—'],['label'=>'Dibuka','nilai'=>$kuesioner->dibuka_pada?->format('d M Y H:i') ?? 'Sekarang'],['label'=>'Ditutup','nilai'=>$kuesioner->ditutup_pada?->format('d M Y H:i') ?? 'Tak Terbatas'],['label'=>'Wajib','nilai'=>$kuesioner->wajib?'Ya':'Tidak'],['label'=>'Acak Soal','nilai'=>$kuesioner->acak_soal?'Ya':'Tidak']]; @endphp
            <div class="space-y-2">
                @foreach($metaInfo as $m)
                <div class="flex justify-between text-sm">
                    <span class="font-black text-gray-500">{{ $m['label'] }}</span>
                    <span class="font-black text-[#1a1a2e]">{{ $m['nilai'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
