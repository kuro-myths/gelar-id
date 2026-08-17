@extends('tataletak.admin')
@section('judul','Semester & Sesi Belajar')
@section('konten')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-5">
    <form method="GET" action="/admin/semester" class="flex gap-2">
        <select name="program_id" class="input-komik text-sm px-3 py-2 w-auto">
            <option value="">Semua Program</option>
            @foreach($program as $p)<option value="{{ $p->id }}" {{ request('program_id')==$p->id?'selected':'' }}>{{ $p->jenisGelar->kode }} — {{ $p->nama }}</option>@endforeach
        </select>
        <button type="submit" class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">Filter</button>
    </form>
    <a href="/admin/semester/buat" class="btn-komik px-5 py-2.5 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-sm">📅 Tambah Semester</a>
</div>
<div class="kartu-admin overflow-hidden">
    <div class="px-6 py-4 bg-[#1a1a2e]"><h3 class="judul-komik text-xl text-white">📅 SEMUA SEMESTER</h3></div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['SEMESTER','PROGRAM','PERIODE','SKS','SESI','STATUS','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($semester as $s)
                <tr class="border-b-2 border-gray-50 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3">
                        <div class="w-8 h-8 rounded-full bg-[#4361ee] text-white font-black flex items-center justify-center text-sm" style="border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">{{ $s->nomor }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge-komik text-white text-xs" style="background:{{ $s->program->jenisGelar->warna }};border-color:#1a1a2e;">{{ $s->program->jenisGelar->kode }}</span>
                        <p class="text-xs font-bold text-gray-600 mt-0.5 max-w-[120px] truncate">{{ $s->program->nama }}</p>
                    </td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-600">
                        {{ $s->tanggal_mulai?->format('d M Y') ?? '—' }}<br>s/d {{ $s->tanggal_selesai?->format('d M Y') ?? '—' }}
                    </td>
                    <td class="px-4 py-3 text-xs font-black">{{ $s->jumlah_sks }}</td>
                    <td class="px-4 py-3 text-xs font-black">{{ $s->sesi_belajar_count }}</td>
                    <td class="px-4 py-3">
                        @php $ws=['belum_mulai'=>'bg-gray-200 text-gray-600','berjalan'=>'bg-[#4361ee] text-white','selesai'=>'bg-[#06d6a0] text-[#1a1a2e]'] @endphp
                        <span class="badge-komik {{ $ws[$s->status] ?? 'bg-gray-100' }} text-xs">{{ $s->label_status }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-1">
                            <a href="/admin/semester/{{ $s->id }}" class="btn-komik px-2 py-1 bg-[#ffd60a] text-[#1a1a2e] rounded-lg text-xs">Detail</a>
                            <a href="/admin/semester/{{ $s->id }}/sesi/buat" class="btn-komik px-2 py-1 bg-[#06d6a0] text-[#1a1a2e] rounded-lg text-xs">+Sesi</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-10 text-gray-400 font-black">📭 Belum ada semester</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $semester->links() }}</div>
</div>
@endsection
