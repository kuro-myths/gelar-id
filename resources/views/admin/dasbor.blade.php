@extends('tataletak.admin')
@section('judul','Dasbor Admin')
@section('konten')

{{-- Statistik --}}
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4 mb-8">
    @php $kartu = [
        ['label'=>'Pengguna','nilai'=>$statistik['pengguna'],'ikon'=>'👥','warna'=>'bg-[#4361ee]','link'=>'/admin/pengguna'],
        ['label'=>'Program','nilai'=>$statistik['program'],'ikon'=>'📚','warna'=>'bg-[#7209b7]','link'=>'/admin/program'],
        ['label'=>'Pendaftaran','nilai'=>$statistik['pendaftaran'],'ikon'=>'📋','warna'=>'bg-[#06d6a0]','link'=>'/admin/pendaftaran'],
        ['label'=>'Aktif','nilai'=>$statistik['aktif'],'ikon'=>'⚡','warna'=>'bg-[#4361ee]','link'=>'/admin/pendaftaran'],
        ['label'=>'Selesai','nilai'=>$statistik['selesai'],'ikon'=>'✅','warna'=>'bg-[#06d6a0]','link'=>'/admin/pendaftaran'],
        ['label'=>'Sertifikat','nilai'=>$statistik['sertifikat'],'ikon'=>'🏆','warna'=>'bg-[#f72585]','link'=>'/admin/sertifikat'],
        ['label'=>'Meeting','nilai'=>$statistik['pertemuan'],'ikon'=>'🎥','warna'=>'bg-[#f97316]','link'=>'/admin/pertemuan'],
        ['label'=>'Kuesioner','nilai'=>$statistik['kuesioner'],'ikon'=>'📋','warna'=>'bg-[#eab308]','link'=>'/admin/kuesioner'],
    ]; @endphp
    @foreach($kartu as $k)
    <a href="{{ $k['link'] }}" class="kartu-admin p-5 {{ $k['warna'] }} text-white hover:scale-[1.02] transition-transform">
        <div class="text-3xl mb-2">{{ $k['ikon'] }}</div>
        <div class="judul-komik text-4xl">{{ $k['nilai'] }}</div>
        <div class="text-xs font-black mt-1 opacity-80 uppercase">{{ $k['label'] }}</div>
    </a>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Tabel Pendaftaran Terbaru --}}
    <div class="lg:col-span-2 kartu-admin overflow-hidden">
        <div class="px-6 py-4 bg-[#1a1a2e] flex items-center justify-between">
            <h3 class="judul-komik text-xl text-white">📋 PENDAFTARAN TERBARU</h3>
            <a href="/admin/pendaftaran" class="text-[#ffd60a] font-black text-sm hover:underline">Lihat semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead style="background:#0f172a;color:white;">
                    <tr>
                        @foreach(['MAHASISWA','PROGRAM','STATUS','TANGGAL'] as $h)
                        <th class="text-left px-4 py-3 text-xs font-black uppercase tracking-wide">{{ $h }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftaranTerbaru as $p)
                    <tr class="border-b-2 border-gray-100 hover:bg-[#f0f4ff] transition-colors">
                        <td class="px-4 py-3">
                            <div class="font-black text-[#1a1a2e]">{{ $p->pengguna->nama }}</div>
                            <div class="text-xs font-bold text-gray-400">{{ $p->pengguna->email }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="badge-komik text-white text-xs" style="background:{{ $p->program->jenisGelar->warna }};border-color:#1a1a2e;">{{ $p->program->jenisGelar->kode }}</span>
                            <div class="text-xs font-bold text-gray-600 mt-0.5">{{ Str::limit($p->program->nama,25) }}</div>
                        </td>
                        <td class="px-4 py-3">
                            @php $warna=['menunggu'=>'bg-[#ffd60a] text-[#1a1a2e]','aktif'=>'bg-[#4361ee] text-white','selesai'=>'bg-[#06d6a0] text-[#1a1a2e]','batal'=>'bg-[#f72585] text-white'] @endphp
                            <span class="badge-komik {{ $warna[$p->status] ?? 'bg-gray-100' }} text-xs">{{ $p->label_status }}</span>
                        </td>
                        <td class="px-4 py-3 text-xs font-bold text-gray-500">{{ $p->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-10 text-gray-400 font-black">📭 Belum ada pendaftaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Statistik Gelar --}}
    <div class="space-y-5">
        {{-- Pertemuan Mendatang --}}
        @if(isset($pertemuanMendatang) && $pertemuanMendatang->isNotEmpty())
        <div class="kartu-admin overflow-hidden">
            <div class="bg-[#f97316] px-4 py-3 flex items-center justify-between">
                <h3 class="judul-komik text-lg text-white">🎥 MEETING MENDATANG</h3>
                <a href="/admin/pertemuan" class="text-white text-xs font-black opacity-80 hover:opacity-100">Semua →</a>
            </div>
            <div class="divide-y-2 divide-gray-50">
                @foreach($pertemuanMendatang as $pm)
                <div class="px-4 py-3 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#f97316] text-white text-xs font-black flex items-center justify-center flex-shrink-0" style="border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">🎥</div>
                    <div class="flex-1 min-w-0">
                        <p class="font-black text-[#1a1a2e] text-sm truncate">{{ $pm->judul }}</p>
                        <p class="text-xs font-bold text-gray-400">{{ $pm->dijadwalkan_pada->format('d M, H:i') }}</p>
                    </div>
                    <a href="/admin/pertemuan/{{ $pm->id }}" class="badge-komik bg-[#ffd60a] text-[#1a1a2e] text-xs">Detail</a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="kartu-admin p-6">
            <h3 class="judul-komik text-xl text-[#1a1a2e] mb-5">📊 STATISTIK GELAR</h3>
        <div class="space-y-3">
            @foreach($statistikGelar as $g)
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-xs font-black flex-shrink-0"
                     style="background:{{ $g->warna }};border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">
                    {{ substr($g->kode,0,2) }}
                </div>
                <div class="flex-1">
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-black text-[#1a1a2e]">{{ $g->kode }}</span>
                        <span class="text-xs font-black text-gray-500">{{ $g->sertifikat_count }} sertifikat</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2" style="border:1px solid #e5e7eb;">
                        @php $maks = $statistikGelar->max('sertifikat_count') ?: 1 @endphp
                        <div class="h-2 rounded-full" style="width:{{ ($g->sertifikat_count/$maks)*100 }}%;background:{{ $g->warna }};"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-6 grid grid-cols-2 gap-3">
            <a href="/admin/gelar/buat" class="btn-komik py-2.5 bg-[#4361ee] text-white rounded-xl text-xs text-center">
                ➕ Tambah Gelar
            </a>
            <a href="/admin/program/buat" class="btn-komik py-2.5 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-xs text-center">
                ➕ Tambah Program
            </a>
        </div>
    </div>
    </div>{{-- tutup space-y-5 --}}
</div>
@endsection
