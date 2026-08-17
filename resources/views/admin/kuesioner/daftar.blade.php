@extends('tataletak.admin')
@section('judul','Manajemen Kuesioner')
@section('konten')
<div class="flex justify-end mb-5">
    <a href="/admin/kuesioner/buat" class="btn-komik px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">📋 Buat Kuesioner</a>
</div>
<div class="kartu-admin overflow-hidden">
    <div class="px-6 py-4 bg-[#1a1a2e]"><h3 class="judul-komik text-xl text-white">📋 SEMUA KUESIONER</h3></div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['JUDUL','TIPE','PROGRAM','SOAL','RESPONS','STATUS','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($kuesioner as $k)
                <tr class="border-b-2 border-gray-50 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3 font-black text-[#1a1a2e] max-w-[180px]"><p class="truncate">{{ $k->judul }}</p></td>
                    <td class="px-4 py-3"><span class="badge-komik bg-[#4361ee] text-white text-xs">{{ $k->label_tipe }}</span></td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-600">{{ $k->program?->nama ?? '—' }}</td>
                    <td class="px-4 py-3 text-xs font-black text-gray-600">{{ $k->pertanyaan_count }}</td>
                    <td class="px-4 py-3 text-xs font-black text-gray-600">{{ $k->respons_count }}</td>
                    <td class="px-4 py-3">
                        <span class="badge-komik {{ $k->aktif ? 'bg-[#06d6a0] text-[#1a1a2e]' : 'bg-gray-200 text-gray-600' }} text-xs">{{ $k->aktif ? '✅ Aktif' : '❌ Nonaktif' }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-1">
                            <a href="/admin/kuesioner/{{ $k->id }}" class="btn-komik px-2 py-1 bg-[#ffd60a] text-[#1a1a2e] rounded-lg text-xs">Detail</a>
                            <a href="/admin/kuesioner/{{ $k->id }}/pertanyaan" class="btn-komik px-2 py-1 bg-[#4361ee] text-white rounded-lg text-xs">Soal</a>
                            <form method="POST" action="/admin/kuesioner/{{ $k->id }}/toggle">@csrf<button class="btn-komik px-2 py-1 bg-gray-100 text-gray-700 rounded-lg text-xs">Toggle</button></form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-10 text-gray-400 font-black">📭 Belum ada kuesioner</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $kuesioner->links() }}</div>
</div>
@endsection
