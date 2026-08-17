@extends('tataletak.admin')
@section('judul','Kemajuan Akademik')
@section('konten')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-5">
    <form method="GET" action="/admin/kemajuan" class="flex gap-2">
        <select name="program_id" class="input-komik text-sm px-3 py-2 w-auto">
            <option value="">Semua Program</option>
            @foreach($program as $p)<option value="{{ $p->id }}" {{ request('program_id')==$p->id?'selected':'' }}>{{ $p->jenisGelar->kode }} — {{ $p->nama }}</option>@endforeach
        </select>
        <button type="submit" class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">Filter</button>
    </form>
</div>
<div class="kartu-admin overflow-hidden">
    <div class="px-6 py-4 bg-[#1a1a2e]"><h3 class="judul-komik text-xl text-white">📈 KEMAJUAN AKADEMIK MAHASISWA</h3></div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['MAHASISWA','PROGRAM','TERDAFTAR','SESI SELESAI','KEMAJUAN','STATUS'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($pendaftaran as $p)
                @php $persen = $p->hitungKemajuan(); @endphp
                <tr class="border-b-2 border-gray-50 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#4361ee] text-white font-black text-xs flex items-center justify-center">{{ strtoupper(substr($p->pengguna->nama,0,1)) }}</div>
                            <div>
                                <p class="font-black text-[#1a1a2e]">{{ $p->pengguna->nama }}</p>
                                <p class="text-xs text-gray-400">{{ $p->pengguna->nim }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge-komik text-white text-xs" style="background:{{ $p->program->jenisGelar->warna }};border-color:#1a1a2e;">{{ $p->program->jenisGelar->kode }}</span>
                        <p class="text-xs text-gray-600 mt-0.5 max-w-[120px] truncate">{{ $p->program->nama }}</p>
                    </td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-600">{{ $p->terdaftar_pada?->format('d M Y') ?? '—' }}</td>
                    <td class="px-4 py-3 text-xs font-black">{{ $p->kemajuanAkademik->where('selesai',true)->count() }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <div class="w-24 bg-gray-100 rounded-full h-3" style="border:1px solid #e5e7eb;">
                                <div class="h-3 rounded-full" style="width:{{ $persen }}%;background:{{ $p->program->jenisGelar->warna }};"></div>
                            </div>
                            <span class="judul-komik text-sm text-[#1a1a2e]">{{ $persen }}%</span>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        @php $w=['menunggu'=>'bg-[#ffd60a] text-[#1a1a2e]','aktif'=>'bg-[#4361ee] text-white','selesai'=>'bg-[#06d6a0] text-[#1a1a2e]','batal'=>'bg-[#f72585] text-white'] @endphp
                        <span class="badge-komik {{ $w[$p->status] ?? 'bg-gray-100' }} text-xs">{{ $p->label_status }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400 font-black">📭 Tidak ada data kemajuan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $pendaftaran->links() }}</div>
</div>
@endsection
