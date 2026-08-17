@extends('tataletak.admin')
@section('judul','Peserta Pertemuan')
@section('konten')
<div class="flex gap-3 mb-5">
    <a href="/admin/pertemuan/{{ $pertemuan->id }}" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">← Kembali</a>
</div>
<div class="kartu-admin overflow-hidden">
    <div class="px-6 py-4 bg-[#1a1a2e] flex items-center justify-between">
        <h3 class="judul-komik text-xl text-white">👥 PESERTA — {{ $pertemuan->judul }}</h3>
        <span class="badge-komik bg-[#ffd60a] text-[#1a1a2e]">{{ $pertemuan->peserta->count() }} peserta</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['MAHASISWA','BERGABUNG','KELUAR','DURASI','HADIR','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($pertemuan->peserta as $p)
                <tr class="border-b-2 border-gray-50 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#4361ee] flex items-center justify-center text-white font-black text-xs">{{ strtoupper(substr($p->pengguna->nama,0,1)) }}</div>
                            <div>
                                <p class="font-black text-[#1a1a2e]">{{ $p->pengguna->nama }}</p>
                                <p class="text-xs text-gray-400">{{ $p->pengguna->nim }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-600">{{ $p->bergabung_pada?->format('H:i') ?? '—' }}</td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-600">{{ $p->keluar_pada?->format('H:i') ?? '—' }}</td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-600">{{ $p->durasi_hadir_menit > 0 ? $p->durasi_hadir_menit.' mnt' : '—' }}</td>
                    <td class="px-4 py-3">
                        <span class="badge-komik {{ $p->hadir ? 'bg-[#06d6a0] text-[#1a1a2e]' : 'bg-gray-100 text-gray-500' }} text-xs">
                            {{ $p->hadir ? '✅ Hadir' : '❌ Tidak' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if(!$p->hadir)
                        <form method="POST" action="/admin/pertemuan/{{ $pertemuan->id }}/hadir">
                            @csrf
                            <input type="hidden" name="pengguna_id" value="{{ $p->pengguna_id }}">
                            <button type="submit" class="btn-komik px-3 py-1.5 bg-[#06d6a0] text-[#1a1a2e] rounded-lg text-xs">✅ Tandai Hadir</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400 font-black">Belum ada peserta</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
