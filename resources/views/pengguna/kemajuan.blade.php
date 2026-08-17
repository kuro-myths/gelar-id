@extends('tataletak.aplikasi')
@section('judul','Kemajuan Akademik')
@section('konten')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="/pengguna/daftar-ku" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm mb-6 inline-flex">← Kembali</a>

    {{-- Header Program --}}
    <div class="kartu-komik p-6 mb-6 overflow-hidden">
        <div class="h-2 -mt-6 -mx-6 mb-5" style="background:{{ $pendaftaran->program->jenisGelar->warna }}"></div>
        <div class="flex flex-col sm:flex-row items-start gap-5">
            <div class="w-16 h-16 rounded-2xl text-white font-black text-sm flex items-center justify-center flex-shrink-0 judul-komik text-xl"
                 style="background:{{ $pendaftaran->program->jenisGelar->warna }};border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                {{ $pendaftaran->program->jenisGelar->kode }}
            </div>
            <div class="flex-1">
                <h1 class="judul-komik text-3xl text-[#1a1a2e]">{{ $pendaftaran->program->nama }}</h1>
                <p class="font-bold text-gray-500">{{ $pendaftaran->program->jenisGelar->nama }}</p>
                <p class="text-xs font-bold text-gray-400 mt-1">NIM: {{ auth()->user()->nim }} · Daftar: {{ $pendaftaran->terdaftar_pada?->format('d M Y') }}</p>
            </div>
            <div class="text-center">
                <div class="w-24 h-24 rounded-full border-8 flex items-center justify-center mx-auto" style="border-color:{{ $pendaftaran->program->jenisGelar->warna }};">
                    <span class="judul-komik text-3xl text-[#1a1a2e]">{{ $persen }}%</span>
                </div>
                <p class="font-black text-gray-600 text-sm mt-2">Kemajuan</p>
            </div>
        </div>

        {{-- Progress bar --}}
        <div class="mt-5">
            <div class="flex justify-between text-xs font-black text-gray-500 mb-1">
                <span>Progress Keseluruhan</span>
                <span>{{ $persen }}%</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-4" style="border:2px solid #1a1a2e;">
                <div class="h-4 rounded-full transition-all" style="width:{{ $persen }}%;background:{{ $pendaftaran->program->jenisGelar->warna }};"></div>
            </div>
        </div>
    </div>

    {{-- Per Semester --}}
    @forelse($pendaftaran->program->semester as $semester)
    <div class="kartu-komik overflow-hidden mb-5">
        <div class="px-5 py-4 flex items-center justify-between" style="background:#1a1a2e;">
            <div>
                <h3 class="judul-komik text-xl text-white">{{ $semester->nama }}</h3>
                <p class="text-gray-400 text-xs font-bold">
                    📅 {{ $semester->tanggal_mulai?->format('d M Y') ?? '—' }} s/d {{ $semester->tanggal_selesai?->format('d M Y') ?? '—' }}
                    &nbsp;·&nbsp; 📖 {{ $semester->jumlah_sks }} SKS
                </p>
            </div>
            <span class="badge-komik text-xs
                {{ $semester->status === 'berjalan' ? 'bg-[#4361ee] text-white' :
                   ($semester->status === 'selesai' ? 'bg-[#06d6a0] text-[#1a1a2e]' : 'bg-gray-600 text-gray-300') }}">
                {{ $semester->label_status }}
            </span>
        </div>

        <div class="divide-y-2 divide-gray-50">
            @forelse($semester->sesiBelajar as $sesi)
            @php
                $km = $pendaftaran->kemajuanAkademik->firstWhere('sesi_belajar_id', $sesi->id);
                $sudahSelesai = $km?->selesai ?? false;
            @endphp
            <div class="px-5 py-4 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-sm flex-shrink-0"
                     style="background:{{ $sudahSelesai ? '#06d6a0' : '#94a3b8' }};border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">
                    {{ $sudahSelesai ? '✓' : $sesi->pertemuan_ke }}
                </div>
                <div class="flex-1">
                    <p class="font-black text-[#1a1a2e]">{{ $sesi->judul }}</p>
                    <p class="text-xs font-bold text-gray-400">
                        {{ $sesi->label_tipe }} ·
                        📅 {{ $sesi->mulai_pada->format('d M Y, H:i') }} ·
                        ⏱️ {{ $sesi->durasi_menit }} mnt
                    </p>
                    @if($sudahSelesai && $km?->diselesaikan_pada)
                    <p class="text-xs font-black text-[#06d6a0]">✅ Selesai: {{ $km->diselesaikan_pada->format('d M Y') }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    @if(!$sudahSelesai && $sesi->status !== 'akan_datang')
                    <form method="POST" action="/pengguna/kemajuan/{{ $pendaftaran->id }}/sesi/{{ $sesi->id }}">
                        @csrf
                        <button type="submit" class="btn-komik px-4 py-2 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-xs">
                            ✓ Tandai Selesai
                        </button>
                    </form>
                    @elseif($sudahSelesai)
                    <span class="badge-komik bg-[#06d6a0] text-[#1a1a2e] text-xs">✅ Selesai</span>
                    @else
                    <span class="badge-komik bg-gray-100 text-gray-400 text-xs">🔒 Akan Datang</span>
                    @endif

                    {{-- Tombol pertemuan jika ada --}}
                    @if($sesi->pertemuan->isNotEmpty())
                    @php $ptm = $sesi->pertemuan->first(); @endphp
                    <a href="/pengguna/pertemuan/{{ $ptm->id }}"
                       class="btn-komik px-3 py-2 bg-[#4361ee] text-white rounded-xl text-xs">
                        🎥 Meeting
                    </a>
                    @endif

                    {{-- Tombol kuesioner jika ada --}}
                    @if($sesi->kuesioner->isNotEmpty())
                    @php $kuis = $sesi->kuesioner->first(); @endphp
                    <a href="/pengguna/kuesioner/{{ $kuis->id }}/isi"
                       class="btn-komik px-3 py-2 bg-[#f72585] text-white rounded-xl text-xs">
                        📋 Kuis
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="px-5 py-6 text-center text-gray-400 font-black">Belum ada sesi belajar</div>
            @endforelse
        </div>
    </div>
    @empty
    <div class="kartu-komik p-12 text-center">
        <div class="text-6xl mb-3">📚</div>
        <p class="judul-komik text-2xl text-gray-400">Semester belum tersedia</p>
    </div>
    @endforelse
</div>
@endsection
