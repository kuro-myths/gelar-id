@extends('tataletak.admin')
@section('judul','Kelola Pertanyaan')
@section('konten')
<div class="flex gap-3 mb-5">
    <a href="/admin/kuesioner/{{ $kuesioner->id }}" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">← Detail Kuesioner</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Form Tambah Pertanyaan --}}
    <div class="kartu-admin p-6">
        <h3 class="judul-komik text-xl text-[#1a1a2e] mb-5">➕ TAMBAH PERTANYAAN</h3>
        <form method="POST" action="/admin/kuesioner/{{ $kuesioner->id }}/pertanyaan" class="space-y-4" id="formSoal">
            @csrf
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Pertanyaan *</label>
                <textarea name="teks_pertanyaan" rows="3" required class="input-komik text-sm" placeholder="Tulis pertanyaan...">{{ old('teks_pertanyaan') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Tipe *</label>
                    <select name="tipe" required class="input-komik text-sm" id="tipeSoal" onchange="toggleOpsi(this.value)">
                        @foreach(['pilihan_ganda'=>'Pilihan Ganda','esai'=>'Esai','benar_salah'=>'Benar/Salah','skala'=>'Skala 1-5','centang'=>'Centang'] as $v=>$l)
                        <option value="{{ $v }}" {{ old('tipe')===$v?'selected':'' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Bobot Nilai</label>
                    <input type="number" name="bobot" value="{{ old('bobot',1) }}" min="0" class="input-komik text-sm">
                </div>
            </div>

            {{-- Opsi Jawaban (untuk pilihan ganda/centang) --}}
            <div id="bagianOpsi">
                <label class="block text-xs font-black text-[#1a1a2e] mb-2 uppercase">Opsi Jawaban <span class="text-gray-400 font-bold">(tambahkan [BENAR] di awal opsi yang benar)</span></label>
                <div id="daftarOpsi" class="space-y-2">
                    @for($i = 0; $i < 4; $i++)
                    <div class="flex gap-2">
                        <input type="text" name="opsi[]" value="{{ old('opsi.'.$i) }}" class="input-komik text-sm flex-1" placeholder="Opsi {{ chr(65+$i) }}">
                        @if($i === 0)<input type="text" name="opsi[]" value="" class="hidden">@endif
                    </div>
                    @endfor
                </div>
                <button type="button" onclick="tambahOpsi()" class="btn-komik mt-2 px-3 py-1.5 bg-gray-100 text-[#1a1a2e] rounded-lg text-xs">+ Tambah Opsi</button>
            </div>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="wajib" value="1" checked><span class="text-sm font-black text-[#1a1a2e]">Pertanyaan Wajib</span>
            </label>
            <button type="submit" class="btn-komik w-full py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">➕ Tambah Pertanyaan</button>
        </form>
    </div>

    {{-- Daftar Pertanyaan --}}
    <div>
        <div class="kartu-admin overflow-hidden">
            <div class="bg-[#1a1a2e] px-4 py-3 flex items-center justify-between">
                <h3 class="judul-komik text-lg text-white">📝 DAFTAR SOAL ({{ $kuesioner->pertanyaan->count() }})</h3>
                <a href="/admin/kuesioner/{{ $kuesioner->id }}" class="text-[#ffd60a] text-xs font-black">Lihat Respons →</a>
            </div>
            <div class="divide-y-2 divide-gray-50 max-h-[600px] overflow-y-auto">
                @forelse($kuesioner->pertanyaan as $i => $p)
                <div class="px-4 py-4">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-start gap-2 flex-1">
                            <div class="w-6 h-6 rounded-full bg-[#4361ee] text-white font-black text-xs flex items-center justify-center flex-shrink-0 mt-0.5">{{ $i+1 }}</div>
                            <div>
                                <p class="font-black text-[#1a1a2e] text-sm">{{ $p->teks_pertanyaan }}</p>
                                <div class="flex gap-2 mt-1 flex-wrap">
                                    <span class="badge-komik bg-gray-100 text-gray-600 text-xs">{{ $p->label_tipe }}</span>
                                    <span class="badge-komik bg-[#ffd60a] text-[#1a1a2e] text-xs">Bobot: {{ $p->bobot }}</span>
                                    @if($p->wajib)<span class="badge-komik bg-[#f72585] text-white text-xs">Wajib</span>@endif
                                </div>
                                @if($p->opsi)
                                <div class="mt-2 space-y-0.5">
                                    @foreach($p->opsi as $opsi)
                                    <p class="text-xs font-bold {{ str_starts_with($opsi,'[BENAR]') ? 'text-[#06d6a0]' : 'text-gray-500' }}">
                                        {{ str_starts_with($opsi,'[BENAR]') ? '✓ ' : '• ' }}{{ str_replace('[BENAR]','',$opsi) }}
                                    </p>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <form method="POST" action="/admin/pertanyaan/{{ $p->id }}" onsubmit="return confirm('Hapus soal ini?')">
                            @csrf @method('DELETE')
                            <button class="btn-komik px-2 py-1 bg-[#f72585] text-white rounded-lg text-xs">🗑️</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="p-10 text-center text-gray-400 font-black">Belum ada pertanyaan</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('skrip')
<script>
function toggleOpsi(tipe) {
    const b = document.getElementById('bagianOpsi');
    b.style.display = (tipe === 'pilihan_ganda' || tipe === 'centang') ? 'block' : 'none';
}
function tambahOpsi() {
    const el = document.createElement('div');
    el.className = 'flex gap-2';
    el.innerHTML = '<input type="text" name="opsi[]" class="input-komik text-sm flex-1" placeholder="Opsi baru...">';
    document.getElementById('daftarOpsi').appendChild(el);
}
toggleOpsi(document.getElementById('tipeSoal').value);
</script>
@endpush
@endsection
