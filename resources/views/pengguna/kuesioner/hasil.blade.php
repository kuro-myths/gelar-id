@extends('tataletak.aplikasi')
@section('judul','Hasil Kuesioner')
@section('konten')
<div class="max-w-3xl mx-auto px-4 py-10">
    <a href="/pengguna/kuesioner" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm mb-6 inline-flex">← Kembali</a>

    <div class="kartu-komik p-6 mb-6 bg-[#06d6a0]">
        <div class="flex items-center gap-4">
            <div class="text-5xl">🏆</div>
            <div>
                <h1 class="judul-komik text-4xl text-[#1a1a2e]">SELESAI!</h1>
                <p class="font-black text-[#1a1a2e]">{{ $kuesioner->judul }}</p>
                @if($respons->nilai_total !== null)
                <p class="font-black text-[#1a1a2e] text-xl mt-1">Nilai: <span class="judul-komik text-4xl">{{ $respons->nilai_total }}</span> / {{ $kuesioner->getTotalBobot() }}</p>
                @endif
                <p class="text-sm font-bold text-[#1a1a2e] mt-1">
                    Diselesaikan: {{ $respons->selesai_pada?->translatedFormat('d F Y, H:i') }}
                </p>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        @foreach($kuesioner->pertanyaan as $i => $p)
        @php $jawaban = $respons->jawaban->firstWhere('pertanyaan_id', $p->id); @endphp
        <div class="kartu-komik p-5">
            <div class="flex items-start gap-3 mb-3">
                <div class="w-7 h-7 rounded-full bg-[#1a1a2e] text-white font-black flex items-center justify-center text-xs flex-shrink-0">{{ $i+1 }}</div>
                <p class="font-black text-[#1a1a2e]">{{ $p->teks_pertanyaan }}</p>
            </div>
            <div class="ml-10 bg-[#f0f4ff] rounded-xl p-3 border-2 border-[#4361ee]">
                <p class="text-sm font-bold text-gray-500 mb-1">Jawaban Anda:</p>
                <p class="font-black text-[#1a1a2e]">{{ $jawaban?->jawaban ?? '— Tidak dijawab —' }}</p>
                @if($jawaban?->nilai !== null)
                <p class="text-xs font-black text-[#4361ee] mt-1">Nilai: {{ $jawaban->nilai }} / {{ $p->bobot }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
