@extends('tataletak.admin')
@section('judul','Pendaftaran')
@section('konten')
<div class="kartu-admin overflow-hidden">
    <div class="px-6 py-4 bg-[#1a1a2e]">
        <h3 class="judul-komik text-xl text-white">📋 SEMUA PENDAFTARAN</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['NO. DAFTAR','MAHASISWA','PROGRAM','STATUS','TANGGAL','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($pendaftaran as $p)
                <tr class="border-b-2 border-gray-100 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3 font-mono text-xs font-bold text-gray-600">{{ $p->nomor_pendaftaran }}</td>
                    <td class="px-4 py-3">
                        <div class="font-black text-[#1a1a2e]">{{ $p->pengguna->nama }}</div>
                        <div class="text-xs font-bold text-gray-400">{{ $p->pengguna->nim }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge-komik text-white text-xs" style="background:{{ $p->program->jenisGelar->warna }};border-color:#1a1a2e;">{{ $p->program->jenisGelar->kode }}</span>
                        <div class="text-xs font-bold text-gray-600 mt-0.5">{{ Str::limit($p->program->nama,22) }}</div>
                    </td>
                    <td class="px-4 py-3">
                        @php $w=['menunggu'=>'bg-[#ffd60a] text-[#1a1a2e]','aktif'=>'bg-[#4361ee] text-white','selesai'=>'bg-[#06d6a0] text-[#1a1a2e]','batal'=>'bg-[#f72585] text-white'] @endphp
                        <span class="badge-komik {{ $w[$p->status] ?? 'bg-gray-100' }} text-xs">{{ $p->label_status }}</span>
                    </td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-500">{{ $p->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="/admin/pendaftaran/{{ $p->id }}" class="flex gap-1">
                            @csrf @method('PUT')
                            <select name="status" class="input-komik text-xs px-2 py-1.5">
                                @foreach(['menunggu'=>'Menunggu','aktif'=>'Aktif','selesai'=>'Selesai','batal'=>'Batal'] as $v=>$l)
                                <option value="{{ $v }}" {{ $p->status==$v?'selected':'' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-komik px-3 py-1.5 bg-[#4361ee] text-white rounded-lg text-xs">✔</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400 font-black">📭 Belum ada pendaftaran</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $pendaftaran->links() }}</div>
</div>
@endsection
