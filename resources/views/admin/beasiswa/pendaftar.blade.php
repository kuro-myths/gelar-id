@extends('tataletak.admin')
@section('judul','Pendaftar Beasiswa')
@section('konten')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="judul-komik text-2xl text-[#1a1a2e]">{{ $beasiswa->nama }}</h2>
        <p class="text-gray-500 font-bold text-sm">{{ $beasiswa->label_manfaat }} · {{ $pendaftar->total() }} pendaftar</p>
    </div>
    <a href="/admin/beasiswa" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
</div>

{{-- Filter status --}}
<div class="flex gap-2 flex-wrap mb-5">
    @foreach(['semua'=>'Semua','menunggu'=>'⏳ Menunggu','diproses'=>'🔍 Diproses','diterima'=>'✅ Diterima','ditolak'=>'❌ Ditolak'] as $val=>$label)
    <a href="?status={{ $val === 'semua' ? '' : $val }}"
       class="btn-komik px-3 py-1.5 rounded-xl text-xs {{ request('status',$val==='semua'?'':'x')===$val||($val==='semua'&&!request('status')) ? 'bg-[#0f0e17] text-white' : 'bg-gray-100 text-gray-700' }}">
        {{ $label }}
    </a>
    @endforeach
</div>

@if($pendaftar->isEmpty())
<div class="kartu-admin rounded-2xl p-16 text-center">
    <div class="text-5xl mb-4">📭</div>
    <p class="judul-komik text-2xl text-gray-400">Belum ada pendaftar</p>
</div>
@else
<div class="space-y-3">
    @foreach($pendaftar as $p)
    <div class="kartu-admin rounded-2xl overflow-hidden">
        <div class="p-5">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                {{-- Avatar + nama --}}
                <div class="flex items-center gap-3 flex-1">
                    <div class="w-11 h-11 rounded-xl bg-[#4361ee] flex items-center justify-center text-white font-black text-lg border-2 border-[#1a1a2e]">
                        {{ strtoupper(substr($p->pengguna->nama,0,1)) }}
                    </div>
                    <div>
                        <p class="font-black text-[#1a1a2e]">{{ $p->pengguna->nama }}</p>
                        <p class="text-xs font-semibold text-gray-500">{{ $p->pengguna->email }}</p>
                    </div>
                </div>

                {{-- Info --}}
                <div class="flex flex-wrap gap-3 text-xs font-bold text-gray-500">
                    @if($p->program)
                    <span class="flex items-center gap-1">
                        <i data-lucide="book" class="w-3 h-3"></i>
                        {{ $p->program->nama }}
                    </span>
                    @endif
                    <span class="flex items-center gap-1">
                        <i data-lucide="calendar" class="w-3 h-3"></i>
                        {{ $p->created_at->format('d M Y') }}
                    </span>
                    <span class="badge-komik text-xs"
                          style="background:{{ $p->warna_status }}22;border-color:{{ $p->warna_status }};color:{{ $p->warna_status }};">
                        {{ $p->label_status }}
                    </span>
                    @if($p->email_terkirim)
                    <span class="text-[#06d6a0] flex items-center gap-1">
                        <i data-lucide="mail-check" class="w-3 h-3"></i> Email terkirim
                    </span>
                    @endif
                </div>

                {{-- Aksi --}}
                <a href="/admin/beasiswa/pendaftar/{{ $p->id }}"
                   class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-xs flex-shrink-0">
                    <i data-lucide="eye" class="w-3.5 h-3.5"></i> Detail & Verifikasi
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-6">{{ $pendaftar->links() }}</div>
@endif
@endsection
