@extends('tataletak.admin')
@section('judul','Buat Beasiswa')
@section('konten')
<div class="max-w-3xl">
    <a href="/admin/beasiswa" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm inline-flex mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
    <div class="kartu-admin rounded-2xl p-7">
        <h2 class="judul-komik text-2xl text-[#1a1a2e] mb-6">🎓 BUAT PROGRAM BEASISWA</h2>

        @if($errors->any())
        <div class="pesan-galat px-4 py-3 rounded-xl mb-5 text-sm">
            @foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach
        </div>
        @endif

        <form method="POST" action="/admin/beasiswa" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama Beasiswa *</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                       class="input-komik text-sm" placeholder="mis: Beasiswa Prestasi Digital GELAR.ID 2026">
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi *</label>
                <textarea name="deskripsi" rows="3" required class="input-komik text-sm resize-none"
                          placeholder="Jelaskan tujuan dan manfaat beasiswa ini...">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Syarat Umum</label>
                <textarea name="syarat" rows="4" class="input-komik text-sm resize-none"
                          placeholder="- Warga Negara Indonesia&#10;- Telah meraih pencapaian X&#10;- Selesaikan achievement Minecraft...">{{ old('syarat') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Tipe Manfaat *</label>
                    <select name="tipe_manfaat" required class="input-komik text-sm">
                        <option value="penuh"    {{ old('tipe_manfaat')==='penuh'?'selected':'' }}>🆓 Penuh (100% gratis)</option>
                        <option value="sebagian" {{ old('tipe_manfaat')==='sebagian'?'selected':'' }}>💰 Sebagian</option>
                        <option value="subsidi"  {{ old('tipe_manfaat')==='subsidi'?'selected':'' }}>🎟️ Subsidi nominal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nilai (0=Gratis penuh)</label>
                    <input type="number" name="nilai_manfaat" value="{{ old('nilai_manfaat',0) }}"
                           min="0" class="input-komik text-sm" placeholder="0">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kuota (0=Tidak terbatas)</label>
                    <input type="number" name="kuota" value="{{ old('kuota',0) }}"
                           min="0" class="input-komik text-sm">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Dibuka Tanggal</label>
                    <input type="date" name="buka_pada" value="{{ old('buka_pada') }}" class="input-komik text-sm">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Ditutup Tanggal</label>
                    <input type="date" name="tutup_pada" value="{{ old('tutup_pada') }}" class="input-komik text-sm">
                </div>
            </div>

            {{-- Pencapaian wajib --}}
            @if($pencapaian->isNotEmpty())
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-2 uppercase">
                    ⭐ Pencapaian Wajib (prasyarat)
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    @foreach($pencapaian as $p)
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-[#4361ee] hover:bg-[#f0f4ff] transition-all">
                        <input type="checkbox" name="pencapaian_wajib[]" value="{{ $p->id }}"
                               {{ in_array($p->id, old('pencapaian_wajib',[])) ? 'checked' : '' }}
                               class="w-4 h-4 border-2 border-[#1a1a2e] rounded">
                        <span class="text-xl">{{ $p->ikon }}</span>
                        <span class="text-xs font-black text-[#1a1a2e]">{{ $p->nama }}</span>
                    </label>
                    @endforeach
                </div>
                <p class="text-xs font-semibold text-gray-400 mt-1">
                    Centang pencapaian yang harus dimiliki pendaftar. Kosongkan jika tidak ada syarat.
                </p>
            </div>
            @endif

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-komik flex-1 py-3 bg-[#4361ee] text-white rounded-xl font-black">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Beasiswa
                </button>
                <a href="/admin/beasiswa" class="btn-komik px-6 py-3 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
