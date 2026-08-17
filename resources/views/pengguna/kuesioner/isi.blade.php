@extends('tataletak.aplikasi')
@section('judul','Isi Kuesioner')
@section('konten')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="kartu-komik p-6 mb-6 bg-gradient-to-r from-[#4361ee] to-[#7209b7] text-white">
        <span class="badge-komik bg-[#ffd60a] text-[#1a1a2e] text-xs mb-2 inline-block">{{ $kuesioner->label_tipe }}</span>
        <h1 class="judul-komik text-4xl mb-1">{{ $kuesioner->judul }}</h1>
        @if($kuesioner->deskripsi)<p class="text-blue-200 font-bold text-sm">{{ $kuesioner->deskripsi }}</p>@endif
        <div class="flex flex-wrap gap-4 mt-3 text-sm font-black text-blue-100">
            <span>📝 {{ $pertanyaan->count() }} pertanyaan</span>
            @if($kuesioner->batas_waktu_menit > 0)<span id="hitungMundur" class="text-[#ffd60a]">⏱️ {{ $kuesioner->batas_waktu_menit }}:00</span>@endif
        </div>
    </div>

    <form method="POST" action="/pengguna/kuesioner/{{ $kuesioner->id }}/kirim" id="formKuesioner">
        @csrf
        <div class="space-y-5">
            @foreach($pertanyaan as $i => $p)
            <div class="kartu-komik p-6" id="soal-{{ $p->id }}">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-8 h-8 rounded-full bg-[#4361ee] text-white font-black flex items-center justify-center text-sm flex-shrink-0" style="border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">{{ $i+1 }}</div>
                    <div class="flex-1">
                        <p class="font-black text-[#1a1a2e]">{{ $p->teks_pertanyaan }}</p>
                        @if($p->wajib)<span class="text-[#f72585] text-xs font-black">* Wajib</span>@endif
                        <span class="badge-komik bg-gray-100 text-gray-600 text-xs ml-2">{{ $p->label_tipe }}</span>
                    </div>
                </div>

                @if($p->tipe === 'pilihan_ganda' && $p->opsi)
                    <div class="space-y-2 ml-11">
                        @foreach($p->opsi as $idx => $opsi)
                        @php $opsiTampil = str_replace('[BENAR]','',$opsi); @endphp
                        <label class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#f0f4ff] cursor-pointer border-2 border-transparent hover:border-[#4361ee] transition-all">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="{{ trim($opsiTampil) }}" class="w-4 h-4">
                            <span class="font-bold text-gray-700">{{ trim($opsiTampil) }}</span>
                        </label>
                        @endforeach
                    </div>
                @elseif($p->tipe === 'benar_salah')
                    <div class="flex gap-3 ml-11">
                        @foreach(['Benar','Salah'] as $opsi)
                        <label class="flex items-center gap-2 px-5 py-3 rounded-xl border-2 border-gray-200 hover:border-[#4361ee] cursor-pointer font-black transition-all">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="{{ $opsi }}" class="w-4 h-4">
                            {{ $opsi === 'Benar' ? '✅ Benar' : '❌ Salah' }}
                        </label>
                        @endforeach
                    </div>
                @elseif($p->tipe === 'skala')
                    <div class="flex gap-2 ml-11 flex-wrap">
                        <span class="text-sm font-black text-gray-500">Sangat Tidak Setuju</span>
                        @for($s = 1; $s <= 5; $s++)
                        <label class="flex flex-col items-center gap-1 cursor-pointer">
                            <input type="radio" name="jawaban[{{ $p->id }}]" value="{{ $s }}" class="w-5 h-5">
                            <span class="font-black text-lg">{{ $s }}</span>
                        </label>
                        @endfor
                        <span class="text-sm font-black text-gray-500">Sangat Setuju</span>
                    </div>
                @elseif($p->tipe === 'centang' && $p->opsi)
                    <div class="space-y-2 ml-11">
                        @foreach($p->opsi as $opsi)
                        <label class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#f0f4ff] cursor-pointer border-2 border-transparent hover:border-[#4361ee] transition-all">
                            <input type="checkbox" name="jawaban[{{ $p->id }}][]" value="{{ $opsi }}" class="w-4 h-4">
                            <span class="font-bold text-gray-700">{{ $opsi }}</span>
                        </label>
                        @endforeach
                    </div>
                @else
                    <div class="ml-11">
                        <textarea name="jawaban[{{ $p->id }}]" rows="4"
                                  class="input-komik w-full text-sm" placeholder="Tulis jawabanmu di sini..."></textarea>
                    </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mt-8 flex gap-4">
            <button type="submit" class="btn-komik flex-1 py-4 bg-[#4361ee] text-white rounded-2xl text-lg"
                    onclick="return confirm('Kirim kuesioner? Jawaban tidak bisa diubah setelah dikirim.')">
                🚀 KIRIM KUESIONER
            </button>
            <a href="/pengguna/kuesioner" class="btn-komik px-5 py-4 bg-gray-100 text-[#1a1a2e] rounded-2xl text-sm">Batal</a>
        </div>
    </form>
</div>

@if($kuesioner->batas_waktu_menit > 0)
@push('skrip')
<script>
let detik = {{ $kuesioner->batas_waktu_menit * 60 }};
const hitung = document.getElementById('hitungMundur');
const interval = setInterval(() => {
    detik--;
    const m = Math.floor(detik/60), s = detik%60;
    if(hitung) hitung.textContent = `⏱️ ${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
    if(detik <= 0) { clearInterval(interval); document.getElementById('formKuesioner').submit(); }
    if(detik <= 60 && hitung) hitung.classList.add('text-red-400');
}, 1000);
</script>
@endpush
@endif
@endsection
