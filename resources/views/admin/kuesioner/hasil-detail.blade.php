@extends('tataletak.admin')
@section('judul','Detail Respons')
@section('konten')
<div class="max-w-3xl mx-auto">
    <div class="flex gap-3 mb-5">
        <a href="/admin/kuesioner/{{ $respons->kuesioner_id }}" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">← Kembali</a>
    </div>
    <div class="kartu-admin p-6 mb-5 bg-[#1a1a2e] text-white">
        <h2 class="judul-komik text-2xl mb-1">{{ $respons->kuesioner->judul }}</h2>
        <p class="font-bold text-gray-300">Respons dari: <span class="text-[#ffd60a]">{{ $respons->pengguna->nama }}</span></p>
        <div class="flex gap-4 mt-3 text-sm font-black">
            <span>⏱️ {{ $respons->mulai_pada?->format('H:i') }} — {{ $respons->selesai_pada?->format('H:i') }}</span>
            @if($respons->nilai_total !== null)
            <span class="text-[#06d6a0]">🏆 Nilai: {{ $respons->nilai_total }} / {{ $respons->kuesioner->getTotalBobot() }}</span>
            @endif
        </div>
    </div>
    <div class="space-y-4">
        @foreach($respons->kuesioner->pertanyaan as $i => $p)
        @php $jwb = $respons->jawaban->firstWhere('pertanyaan_id', $p->id); @endphp
        <div class="kartu-admin p-5">
            <div class="flex items-start gap-3 mb-3">
                <div class="w-7 h-7 rounded-full bg-[#1a1a2e] text-white font-black text-xs flex items-center justify-center">{{ $i+1 }}</div>
                <p class="font-black text-[#1a1a2e]">{{ $p->teks_pertanyaan }}</p>
            </div>
            <div class="ml-10 bg-[#f0f4ff] rounded-xl p-3 border-2 border-[#4361ee]">
                <p class="text-xs font-black text-gray-400 mb-1">Jawaban:</p>
                <p class="font-black text-[#1a1a2e]">{{ $jwb?->jawaban ?? '— Tidak dijawab —' }}</p>
                @if($jwb?->nilai !== null)
                <p class="text-xs font-black text-[#4361ee] mt-1">Nilai: {{ $jwb->nilai }} / {{ $p->bobot }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
