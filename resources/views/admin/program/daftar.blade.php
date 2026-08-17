@extends('tataletak.admin')
@section('judul','Program')
@section('konten')
<div class="flex justify-end mb-5">
    <a href="/admin/program/buat" class="btn-komik px-5 py-2.5 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-sm">➕ Tambah Program</a>
</div>
<div class="kartu-admin overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['PROGRAM','GELAR','HARGA','PESERTA','STATUS','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($program as $p)
                <tr class="border-b-2 border-gray-100 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3">
                        <div class="font-black text-[#1a1a2e]">{{ $p->nama }}</div>
                        @if($p->unggulan)<span class="badge-komik bg-[#ffd60a] text-[#1a1a2e] text-xs">⭐ Unggulan</span>@endif
                    </td>
                    <td class="px-4 py-3"><span class="badge-komik text-white text-xs" style="background:{{ $p->jenisGelar->warna }};border-color:#1a1a2e;">{{ $p->jenisGelar->kode }}</span></td>
                    <td class="px-4 py-3 font-black text-[#1a1a2e] text-sm">{{ $p->gratis ? '<span class="badge-komik bg-[#06d6a0] text-[#1a1a2e]">GRATIS</span>' : 'Rp '.number_format($p->harga,0,',','.') }}</td>
                    <td class="px-4 py-3 text-xs font-black text-gray-600">{{ $p->jumlah_peserta }}</td>
                    <td class="px-4 py-3"><span class="badge-komik {{ $p->aktif ? 'bg-[#06d6a0] text-[#1a1a2e]' : 'bg-[#f72585] text-white' }} text-xs">{{ $p->aktif ? '✅' : '❌' }}</span></td>
                    <td class="px-4 py-3"><a href="/admin/program/{{ $p->id }}/edit" class="btn-komik px-3 py-1.5 bg-[#ffd60a] text-[#1a1a2e] rounded-lg text-xs">✏️ Edit</a></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400 font-black">📭 Belum ada program</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $program->links() }}</div>
</div>
@endsection
