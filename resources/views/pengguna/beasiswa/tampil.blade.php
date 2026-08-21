@extends('tataletak.aplikasi')
@section('judul','Daftar Beasiswa — {{ $beasiswa->nama }}')
@section('konten')
<div class="max-w-3xl mx-auto px-4 py-10">
    <a href="/beasiswa" data-tautan-spa class="btn-komik px-4 py-2 bg-gray-100 text-[#0f0e17] rounded-xl text-sm inline-flex mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar Beasiswa
    </a>

    {{-- Detail Beasiswa --}}
    <div class="kartu-komik p-7 mb-6">
        <div class="flex flex-wrap gap-2 mb-3">
            @if($beasiswa->masih_buka)
            <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">🟢 Dibuka</span>
            @endif
            <span class="badge-komik text-xs" style="background:#4361ee22;border-color:#4361ee;color:#4361ee;">
                {{ $beasiswa->label_manfaat }}
            </span>
        </div>
        <h1 class="judul-komik text-4xl text-[#0f0e17] mb-3">{{ $beasiswa->nama }}</h1>
        <p class="text-gray-600 font-semibold leading-relaxed mb-5">{{ $beasiswa->deskripsi }}</p>

        @if($beasiswa->syarat)
        <div class="bg-[#f0f4ff] border-2 border-[#e0e7ff] rounded-xl p-4 mb-5">
            <p class="text-xs font-black text-[#4361ee] uppercase mb-2">📋 Syarat Umum</p>
            <div class="text-sm text-gray-700 font-semibold whitespace-pre-line">{{ $beasiswa->syarat }}</div>
        </div>
        @endif

        {{-- Pencapaian wajib --}}
        @if($pencapaianWajib->isNotEmpty())
        <div class="mb-5">
            <p class="text-xs font-black text-[#0f0e17] uppercase mb-2">⭐ Pencapaian yang Harus Diraih</p>
            <div class="space-y-2">
                @foreach($pencapaianWajib as $pw)
                @php $punya = in_array($pw->id, $pencapaianDiraih); @endphp
                <div class="flex items-center gap-3 p-3 rounded-xl border-2 {{ $punya ? 'border-[#06d6a0] bg-[#06d6a011]' : 'border-[#f72585] bg-[#f7258511]' }}">
                    <span class="text-2xl">{{ $pw->ikon }}</span>
                    <div class="flex-1">
                        <p class="font-black text-sm {{ $punya ? 'text-[#06d6a0]' : 'text-[#f72585]' }}">{{ $pw->nama }}</p>
                        <p class="text-xs font-semibold text-gray-500">{{ $pw->deskripsi }}</p>
                    </div>
                    @if($punya)
                    <span class="text-[#06d6a0] font-black text-lg">✓</span>
                    @else
                    <a href="/pengguna/pencapaian-ku" data-tautan-spa class="text-xs font-black text-[#f72585] hover:underline">Raih dulu →</a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- Sudah daftar --}}
    @if($sudahDaftar)
    <div class="kartu-komik p-6 text-center" style="background:linear-gradient(135deg,#06d6a0,#4361ee);">
        <div class="text-5xl mb-3">✅</div>
        <h2 class="judul-komik text-2xl text-white mb-2">SUDAH MENDAFTAR!</h2>
        <p class="text-white/80 font-bold text-sm mb-2">Status: <strong>{{ $sudahDaftar->label_status }}</strong></p>
        <p class="text-white/70 font-semibold text-xs">No. Pendaftaran: {{ $sudahDaftar->nomor_pendaftaran_beasiswa }}</p>
    </div>

    {{-- Tidak memenuhi syarat --}}
    @elseif(!$memenuhiSyaratPencapaian)
    <div class="kartu-komik p-6 text-center bg-[#fff5f5]">
        <div class="text-5xl mb-3">🔒</div>
        <h2 class="judul-komik text-2xl text-[#f72585] mb-2">BELUM MEMENUHI SYARAT</h2>
        <p class="text-gray-600 font-bold text-sm mb-4">Raih semua pencapaian yang dipersyaratkan terlebih dahulu.</p>
        <a href="/pengguna/pencapaian-ku" data-tautan-spa class="btn-komik px-6 py-3 bg-[#4361ee] text-white rounded-xl text-sm">
            <i data-lucide="trophy" class="w-4 h-4"></i> Lihat & Raih Pencapaian
        </a>
    </div>

    {{-- Form Pendaftaran --}}
    @elseif($beasiswa->masih_buka)
    <div class="kartu-komik p-7">
        <h2 class="judul-komik text-2xl text-[#0f0e17] mb-5">📝 FORM PENDAFTARAN BEASISWA</h2>

        @if($errors->any())
        <div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black text-sm border-2 border-[#0f0e17]">
            @foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach
        </div>
        @endif

        <form method="POST" action="/pengguna/beasiswa/{{ $beasiswa->id }}/daftar" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Program yang Ingin Diambil</label>
                <select name="program_id" class="input-komik text-sm">
                    <option value="">-- Pilih Program (Opsional) --</option>
                    @foreach($program as $prog)
                    <option value="{{ $prog->id }}" {{ old('program_id')==$prog->id?'selected':'' }}>
                        {{ $prog->jenisGelar->kode }} — {{ $prog->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">
                    Surat Motivasi * <span class="text-gray-400 normal-case">(min. 100 karakter)</span>
                </label>
                <textarea name="surat_motivasi" rows="6" required minlength="100"
                          class="input-komik text-sm resize-none"
                          placeholder="Ceritakan mengapa kamu layak mendapat beasiswa ini, tujuanmu, dan kontribusimu...">{{ old('surat_motivasi') }}</textarea>
                <p class="text-xs font-semibold text-gray-400 mt-1">Tips: Tulis dengan jujur dan spesifik. Ceritakan pencapaian dan motivasimu!</p>
            </div>

            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Bukti Prestasi / Pencapaian</label>
                <textarea name="dokumen_prestasi" rows="3" class="input-komik text-sm resize-none"
                          placeholder="Link screenshot achievement Minecraft, link portofolio, atau keterangan prestasi lain...">{{ old('dokumen_prestasi') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Keterangan Tambahan</label>
                <textarea name="keterangan_tambahan" rows="2" class="input-komik text-sm resize-none"
                          placeholder="Informasi lain yang ingin disampaikan (opsional)...">{{ old('keterangan_tambahan') }}</textarea>
            </div>

            <button type="submit" class="btn-komik w-full py-4 bg-[#4361ee] text-white rounded-2xl text-lg font-black">
                <i data-lucide="send" class="w-5 h-5"></i> Kirim Pendaftaran Beasiswa
            </button>
        </form>
    </div>
    @else
    <div class="kartu-komik p-6 text-center bg-gray-50">
        <div class="text-5xl mb-3">⏰</div>
        <h2 class="judul-komik text-2xl text-gray-400">Pendaftaran Ditutup</h2>
    </div>
    @endif
</div>
@endsection
