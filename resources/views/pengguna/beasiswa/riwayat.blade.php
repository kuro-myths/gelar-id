@extends('tataletak.aplikasi')
@section('judul','Beasiswa Saya')
@section('konten')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="judul-komik text-3xl text-[#0f0e17]">🎓 BEASISWA SAYA</h1>
        <a href="/beasiswa" data-tautan-spa class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">
            + Daftar Beasiswa Baru
        </a>
    </div>

    @if($pendaftaran->isEmpty())
    <div class="kartu-komik p-14 text-center">
        <div class="text-6xl mb-4">📭</div>
        <p class="judul-komik text-2xl text-gray-400 mb-2">Belum ada pendaftaran</p>
        <a href="/beasiswa" data-tautan-spa class="btn-komik mt-4 inline-flex px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
            Lihat Program Beasiswa
        </a>
    </div>
    @else
    <div class="space-y-4">
        @foreach($pendaftaran as $p)
        <div class="kartu-komik overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-2" style="background:{{ $p->warna_status }}"></div>
                <div class="flex-1 p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="flex flex-wrap gap-2 mb-1">
                                <span class="badge-komik text-xs"
                                      style="background:{{ $p->warna_status }}22;border-color:{{ $p->warna_status }};color:{{ $p->warna_status }};">
                                    {{ $p->label_status }}
                                </span>
                                <span class="badge-komik text-xs" style="background:#4361ee22;border-color:#4361ee;color:#4361ee;">
                                    {{ $p->beasiswa->label_manfaat }}
                                </span>
                            </div>
                            <h3 class="font-black text-[#0f0e17] text-lg">{{ $p->beasiswa->nama }}</h3>
                            @if($p->program)
                            <p class="text-xs font-semibold text-gray-500 mt-1">Program: {{ $p->program->nama }}</p>
                            @endif
                            <p class="text-xs font-semibold text-gray-400 mt-1">
                                No: {{ $p->nomor_pendaftaran_beasiswa }} · Daftar: {{ $p->created_at->format('d M Y') }}
                            </p>
                            @if($p->catatan_admin)
                            <div class="mt-2 bg-[#f0f4ff] border-2 border-[#e0e7ff] rounded-lg px-3 py-2">
                                <p class="text-xs font-bold text-[#4361ee]">💬 Pesan admin: "{{ $p->catatan_admin }}"</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
