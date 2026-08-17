@extends('tataletak.aplikasi')
@section('judul','Kuesioner')
@section('konten')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="judul-komik text-5xl text-[#1a1a2e] mb-2">📋 KUESIONER</h1>
    <p class="text-gray-600 font-bold mb-8">Isi kuesioner untuk membantu kami meningkatkan kualitas pembelajaran</p>

    @if($kuesioner->isEmpty())
    <div class="kartu-komik p-12 text-center">
        <div class="text-6xl mb-3">📭</div>
        <p class="judul-komik text-2xl text-gray-400">Tidak ada kuesioner saat ini</p>
    </div>
    @else
    <div class="space-y-4">
        @foreach($kuesioner as $k)
        @php $selesai = in_array($k->id, $sudahIsi); @endphp
        <div class="kartu-komik overflow-hidden {{ $selesai ? 'opacity-75' : '' }}">
            <div class="h-2" style="background:{{ $k->program?->jenisGelar?->warna ?? '#4361ee' }}"></div>
            <div class="p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0"
                     style="background:{{ $k->program?->jenisGelar?->warna ?? '#4361ee' }}22;border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                    {{ $k->tipe === 'ujian' ? '📚' : ($k->tipe === 'kepuasan' ? '😊' : '📋') }}
                </div>
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <span class="badge-komik bg-[#4361ee] text-white text-xs">{{ $k->label_tipe }}</span>
                        @if($selesai)
                        <span class="badge-komik bg-[#06d6a0] text-[#1a1a2e] text-xs">✅ Sudah Diisi</span>
                        @elseif($k->status === 'ditutup')
                        <span class="badge-komik bg-gray-200 text-gray-600 text-xs">🔒 Ditutup</span>
                        @else
                        <span class="badge-komik bg-[#ffd60a] text-[#1a1a2e] text-xs">📝 Belum Diisi</span>
                        @endif
                    </div>
                    <h3 class="font-black text-[#1a1a2e] text-lg">{{ $k->judul }}</h3>
                    <p class="text-sm text-gray-500 font-bold">
                        {{ $k->pertanyaan_count }} pertanyaan
                        @if($k->batas_waktu_menit > 0) · ⏱️ {{ $k->batas_waktu_menit }} menit @endif
                        @if($k->ditutup_pada) · Tutup: {{ $k->ditutup_pada->format('d M Y H:i') }} @endif
                    </p>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    @if($selesai)
                    <a href="/pengguna/kuesioner/{{ $k->id }}/hasil" class="btn-komik px-4 py-2 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-sm">Lihat Hasil</a>
                    @elseif($k->status === 'buka')
                    <a href="/pengguna/kuesioner/{{ $k->id }}/isi" class="btn-komik px-4 py-2 bg-[#f72585] text-white rounded-xl text-sm">Isi Sekarang!</a>
                    @else
                    <span class="btn-komik px-4 py-2 bg-gray-100 text-gray-400 rounded-xl text-sm cursor-not-allowed">Tidak Tersedia</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $kuesioner->links() }}</div>
    @endif
</div>
@endsection
