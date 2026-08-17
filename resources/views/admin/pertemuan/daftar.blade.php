@extends('tataletak.admin')
@section('judul','Manajemen Pertemuan')
@section('konten')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-5">
    <form method="GET" action="/admin/pertemuan" class="flex gap-2">
        <select name="status" class="input-komik text-sm px-3 py-2 w-auto">
            <option value="">Semua Status</option>
            @foreach(['terjadwal'=>'Terjadwal','berlangsung'=>'Berlangsung','selesai'=>'Selesai','batal'=>'Batal'] as $v=>$l)
            <option value="{{ $v }}" {{ request('status')===$v?'selected':'' }}>{{ $l }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">Filter</button>
    </form>
    <a href="/admin/pertemuan/buat" class="btn-komik px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">🎥 Jadwalkan Pertemuan</a>
</div>

<div class="kartu-admin overflow-hidden">
    <div class="px-6 py-4 bg-[#1a1a2e]">
        <h3 class="judul-komik text-xl text-white">🎥 SEMUA PERTEMUAN</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['JUDUL','PROGRAM','JADWAL','PLATFORM','PESERTA','STATUS','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($pertemuan as $p)
                <tr class="border-b-2 border-gray-50 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3">
                        <p class="font-black text-[#1a1a2e] max-w-[180px] truncate">{{ $p->judul }}</p>
                        <p class="text-xs font-bold text-gray-400">{{ $p->id_ruangan }}</p>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge-komik text-white text-xs" style="background:{{ $p->program->jenisGelar->warna }};border-color:#1a1a2e;">{{ $p->program->jenisGelar->kode }}</span>
                        <p class="text-xs font-bold text-gray-600 mt-0.5 max-w-[120px] truncate">{{ $p->program->nama }}</p>
                    </td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-700">
                        {{ $p->dijadwalkan_pada->format('d M Y') }}<br>
                        {{ $p->dijadwalkan_pada->format('H:i') }} ({{ $p->durasi_menit }}mnt)
                    </td>
                    <td class="px-4 py-3 text-xs font-bold">{{ $p->label_platform }}</td>
                    <td class="px-4 py-3 text-xs font-black text-gray-600">{{ $p->peserta->count() }}/{{ $p->maks_peserta }}</td>
                    <td class="px-4 py-3">
                        @php $wb=['terjadwal'=>'bg-[#4361ee] text-white','berlangsung'=>'bg-[#f72585] text-white','selesai'=>'bg-[#06d6a0] text-[#1a1a2e]','batal'=>'bg-gray-200 text-gray-600'] @endphp
                        <span class="badge-komik {{ $wb[$p->status] ?? '' }} text-xs">{{ $p->label_status }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-1">
                            <a href="/admin/pertemuan/{{ $p->id }}" class="btn-komik px-2 py-1 bg-[#ffd60a] text-[#1a1a2e] rounded-lg text-xs">Detail</a>
                            @if($p->status === 'terjadwal')
                            <form method="POST" action="/admin/pertemuan/{{ $p->id }}/mulai">@csrf<button class="btn-komik px-2 py-1 bg-[#f72585] text-white rounded-lg text-xs">▶ Mulai</button></form>
                            @elseif($p->status === 'berlangsung')
                            <form method="POST" action="/admin/pertemuan/{{ $p->id }}/selesai">@csrf<button class="btn-komik px-2 py-1 bg-[#06d6a0] text-[#1a1a2e] rounded-lg text-xs">■ Selesai</button></form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-10 text-gray-400 font-black">📭 Belum ada pertemuan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $pertemuan->links() }}</div>
</div>
@endsection
