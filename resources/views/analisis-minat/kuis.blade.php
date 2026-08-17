@extends('tataletak.aplikasi')
@section('judul','Temukan Program Terbaik Untukmu')
@section('konten')

<div class="min-h-screen py-10 px-4"
     style="background:#f0f4ff;background-image:radial-gradient(#4361ee18 1.5px,transparent 1.5px);background-size:28px 28px;"
     x-data="kuisMinat()">

    <div class="max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-10 akan-muncul">
            <div class="inline-flex items-center gap-2 bg-[#4361ee] text-white px-5 py-2 rounded-full text-sm font-black mb-4"
                 style="border:2px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                <i data-lucide="bot" class="w-4 h-4"></i>
                AI Analisis Minat — 10 Pertanyaan
            </div>
            <h1 class="judul-komik text-5xl md:text-6xl text-[#0f0e17] mb-3">TEMUKAN PRODIMU!</h1>
            <p class="text-gray-600 font-bold max-w-md mx-auto">
                Jawab 10 pertanyaan singkat. AI kami akan rekomendasikan gelar dan program terbaik untukmu!
            </p>
        </div>

        {{-- Progress Bar --}}
        <div class="kartu-komik p-4 mb-6 akan-muncul">
            <div class="flex items-center justify-between text-sm font-black text-[#0f0e17] mb-2">
                <span>Pertanyaan <span x-text="soalAktif"></span> dari {{ count($pertanyaan) }}</span>
                <span x-text="Math.round((soalAktif - 1) / {{ count($pertanyaan) }} * 100) + '%'"></span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-4" style="border:2px solid #0f0e17;">
                <div class="h-4 rounded-full bg-[#4361ee] transition-all duration-500"
                     :style="'width:' + Math.round((soalAktif - 1) / {{ count($pertanyaan) }} * 100) + '%'"></div>
            </div>
            {{-- Indikator titik --}}
            <div class="flex justify-center gap-1.5 mt-3">
                @foreach($pertanyaan as $p)
                <div class="w-2 h-2 rounded-full transition-all duration-300 border border-[#0f0e17]"
                     :class="soalAktif > {{ $loop->index }} ? 'bg-[#4361ee]' : 'bg-gray-200'"></div>
                @endforeach
            </div>
        </div>

        {{-- Formulir Kuis --}}
        <form method="POST" action="/analisis-minat/proses" id="form-kuis">
            @csrf

            @if($errors->any())
            <div class="kartu-komik p-4 mb-5 bg-[#f72585] text-white">
                <p class="font-black text-sm">{{ $errors->first('jawaban') ?? 'Harap jawab semua pertanyaan.' }}</p>
            </div>
            @endif

            @foreach($pertanyaan as $idx => $p)
            <div class="kartu-komik p-6 mb-4 akan-muncul"
                 id="soal-{{ $p['id'] }}"
                 x-show="soalAktif === {{ $idx + 1 }}"
                 x-transition:enter="transition ease-out duration-350"
                 x-transition:enter-start="opacity-0 translate-x-8 scale-95"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0 -translate-x-4"
                 x-cloak>

                {{-- Nomor + Pertanyaan --}}
                <div class="flex items-start gap-3 mb-5">
                    <div class="w-10 h-10 rounded-2xl bg-[#4361ee] text-white font-black flex items-center justify-center judul-komik text-xl flex-shrink-0"
                         style="border:2px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                        {{ $idx + 1 }}
                    </div>
                    <h3 class="font-black text-[#0f0e17] text-lg leading-tight pt-1">{{ $p['pertanyaan'] }}</h3>
                </div>

                {{-- Pilihan Jawaban --}}
                <div class="space-y-3">
                    @foreach($p['pilihan'] as $huruf => $pilihan)
                    <label class="flex items-start gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all duration-200 group"
                           :class="jawaban[{{ $p['id'] }}] === '{{ $huruf }}'
                               ? 'border-[#4361ee] bg-[#f0f4ff] shadow-[4px_4px_0_#4361ee]'
                               : 'border-gray-200 hover:border-[#4361ee] hover:bg-[#f8f9ff]'">
                        <input type="radio"
                               name="jawaban[{{ $p['id'] }}]"
                               value="{{ $huruf }}"
                               class="mt-1 w-4 h-4 accent-[#4361ee]"
                               x-model="jawaban[{{ $p['id'] }}]"
                               @change="jawabOtomatis({{ $idx + 1 }}, {{ count($pertanyaan) }})">
                        <div class="flex items-start gap-3">
                            <span class="w-7 h-7 rounded-lg text-white font-black text-sm flex items-center justify-center flex-shrink-0 transition-colors"
                                  :class="jawaban[{{ $p['id'] }}] === '{{ $huruf }}' ? 'bg-[#4361ee]' : 'bg-[#0f0e17]'"
                                  style="min-width:1.75rem;">{{ $huruf }}</span>
                            <span class="font-bold text-[#0f0e17] text-sm leading-relaxed">{{ $pilihan['teks'] }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>

                {{-- Hint jika belum dipilih --}}
                <p class="text-xs font-bold text-gray-400 mt-3 text-center"
                   x-show="!jawaban[{{ $p['id'] }}]">
                    Pilih salah satu untuk lanjut otomatis →
                </p>
            </div>
            @endforeach

            {{-- Navigasi --}}
            <div class="flex gap-3 mt-6 akan-muncul">
                <button type="button"
                        @click="soalSebelumnya()"
                        x-show="soalAktif > 1"
                        class="btn-komik px-5 py-3 bg-gray-100 text-[#0f0e17] rounded-xl text-sm"
                        x-cloak>
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali
                </button>

                <button type="button"
                        @click="soalSelanjutnya({{ count($pertanyaan) }})"
                        x-show="soalAktif < {{ count($pertanyaan) }}"
                        class="btn-komik flex-1 py-3 rounded-xl text-base transition-all"
                        :class="jawaban[soalAktif]
                            ? 'bg-[#4361ee] text-white'
                            : 'bg-gray-200 text-gray-400 cursor-not-allowed'"
                        :disabled="!jawaban[soalAktif]">
                    Selanjutnya
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>

                <button type="submit"
                        x-show="soalAktif === {{ count($pertanyaan) }}"
                        class="btn-komik flex-1 py-3 rounded-xl text-base transition-all"
                        :class="Object.keys(jawaban).length >= {{ count($pertanyaan) }}
                            ? 'bg-[#f72585] text-white'
                            : 'bg-gray-200 text-gray-400 cursor-not-allowed'"
                        :disabled="Object.keys(jawaban).length < {{ count($pertanyaan) }}"
                        x-cloak>
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                    Lihat Rekomendasiku!
                </button>
            </div>

            {{-- Jawaban tersimpan (hidden inputs backup) --}}
            <div x-html="inputTersembunyi()"></div>
        </form>

        {{-- Info tambahan --}}
        <div class="text-center mt-8 text-xs font-bold text-gray-400 akan-muncul">
            <i data-lucide="lock" class="w-3.5 h-3.5 inline mr-1"></i>
            Jawabanmu aman — tidak dibagikan ke pihak lain
        </div>
    </div>
</div>

@push('skrip')
<script>
function kuisMinat() {
    return {
        soalAktif: 1,
        jawaban: {},

        jawabOtomatis(nomorSoal, total) {
            // Lanjut otomatis setelah 600ms
            if (nomorSoal < total) {
                setTimeout(() => {
                    this.soalAktif = nomorSoal + 1;
                    // Animasi scroll ke atas
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }, 600);
            }
        },

        soalSelanjutnya(total) {
            if (this.soalAktif < total && this.jawaban[this.soalAktif]) {
                this.soalAktif++;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },

        soalSebelumnya() {
            if (this.soalAktif > 1) {
                this.soalAktif--;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },

        // Backup hidden inputs untuk submit
        inputTersembunyi() {
            let html = '';
            for (const [id, nilai] of Object.entries(this.jawaban)) {
                html += `<input type="hidden" name="jawaban_backup[${id}]" value="${nilai}">`;
            }
            return html;
        }
    }
}
</script>
@endpush
@endsection
