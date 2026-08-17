@extends('tataletak.admin')
@section('judul','Sertifikat')
@section('konten')
<div class="kartu-admin overflow-hidden">
    <div class="px-6 py-4 bg-[#1a1a2e]">
        <h3 class="judul-komik text-xl text-white">🏆 SEMUA SERTIFIKAT</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['NO. SERTIFIKAT','PENERIMA','GELAR','PROGRAM','KODE VERIFIKASI','TANGGAL'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($sertifikat as $s)
                <tr class="border-b-2 border-gray-100 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3 font-mono text-xs font-bold text-gray-600">{{ $s->nomor_sertifikat }}</td>
                    <td class="px-4 py-3">
                        <div class="font-black text-[#1a1a2e]">{{ $s->nama_tercetak }}</div>
                        <div class="text-xs font-bold text-gray-400">{{ $s->pengguna->email }}</div>
                    </td>
                    <td class="px-4 py-3"><span class="badge-komik text-white text-xs" style="background:{{ $s->jenisGelar->warna }};border-color:#1a1a2e;">{{ $s->jenisGelar->kode }}</span></td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-600">{{ Str::limit($s->pendaftaran->program->nama,25) }}</td>
                    <td class="px-4 py-3 font-mono text-xs font-black text-[#4361ee]">{{ $s->kode_verifikasi }}</td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-500">{{ $s->tanggal_terbit->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400 font-black">🏆 Belum ada sertifikat</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $sertifikat->links() }}</div>
</div>
@endsection
