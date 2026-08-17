@extends('tataletak.aplikasi')
@section('judul','Sertifikat Saya')
@section('konten')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="judul-komik text-5xl text-[#1a1a2e] mb-2">🏆 SERTIFIKATKU</h1>
    <p class="text-gray-600 font-bold mb-8">Gelar dan sertifikat yang berhasil kamu raih</p>

    @if($sertifikat->isEmpty())
    <div class="kartu-komik p-16 text-center">
        <div class="text-7xl mb-4">🎓</div>
        <p class="judul-komik text-3xl text-gray-400 mb-2">Belum Ada Sertifikat</p>
        <p class="text-gray-500 font-bold mb-6">Selesaikan program studi untuk mendapatkan sertifikat gelarmu!</p>
        <a href="/program" class="btn-komik px-6 py-3 bg-[#4361ee] text-white rounded-xl inline-flex">
            📚 Lihat Program
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($sertifikat as $s)
        <div class="kartu-komik overflow-hidden group">
            {{-- Header warna gelar --}}
            <div class="h-4" style="background:{{ $s->jenisGelar->warna }}"></div>
            <div class="p-6">
                <div class="flex items-start gap-4 mb-5">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white flex-shrink-0 judul-komik text-lg"
                         style="background:{{ $s->jenisGelar->warna }};border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;">
                        {{ $s->jenisGelar->kode }}
                    </div>
                    <div>
                        <span class="badge-komik bg-[#06d6a0] text-[#1a1a2e] text-xs mb-1 inline-block">✅ Terverifikasi</span>
                        <h3 class="judul-komik text-2xl text-[#1a1a2e] leading-tight">{{ $s->jenisGelar->kode }}</h3>
                        <p class="font-bold text-gray-600 text-sm">{{ $s->jenisGelar->nama }}</p>
                    </div>
                </div>

                <p class="font-bold text-gray-700 text-sm mb-4 bg-[#f0f4ff] px-4 py-2 rounded-xl" style="border:2px solid #4361ee33;">
                    📚 {{ $s->pendaftaran->program->nama }}
                </p>

                <div class="space-y-2 mb-5">
                    @php $info = [
                        ['label' => '👤 Nama Tercetak',   'nilai' => $s->nama_tercetak],
                        ['label' => '📜 No. Sertifikat',   'nilai' => $s->nomor_sertifikat],
                        ['label' => '🔑 Kode Verifikasi',  'nilai' => $s->kode_verifikasi],
                        ['label' => '📅 Tanggal Terbit',   'nilai' => $s->tanggal_terbit->translatedFormat('d F Y')],
                    ];
                    if ($s->ipk) $info[] = ['label' => '⭐ IPK', 'nilai' => $s->ipk];
                    if ($s->predikat) $info[] = ['label' => '🏅 Predikat', 'nilai' => $s->predikat];
                    @endphp
                    @foreach($info as $item)
                    <div class="flex justify-between text-xs">
                        <span class="font-black text-gray-500">{{ $item['label'] }}</span>
                        <span class="font-black text-[#1a1a2e] font-mono text-right max-w-[180px] truncate">{{ $item['nilai'] }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="flex gap-2">
                    <a href="/verifikasi?kode={{ $s->kode_verifikasi }}" target="_blank"
                       class="btn-komik flex-1 py-2.5 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-xs text-center">
                        🛡️ Verifikasi Online
                    </a>
                    <a href="/admin/sertifikat/{{ $s->id }}/cetak" target="_blank"
                       class="btn-komik px-4 py-2.5 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-xs">
                        🖨️ Cetak
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $sertifikat->links() }}</div>
    @endif
</div>
@endsection
