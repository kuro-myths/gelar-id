@extends('tataletak.admin')
@section('judul','Edit Beasiswa')
@section('konten')
<div class="max-w-3xl">
    <a href="/admin/beasiswa" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm inline-flex mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
    <div class="kartu-admin rounded-2xl p-7">
        <h2 class="judul-komik text-2xl text-[#1a1a2e] mb-6">✏️ EDIT BEASISWA</h2>

        <form method="POST" action="/admin/beasiswa/{{ $beasiswa->id }}" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama *</label>
                <input type="text" name="nama" value="{{ old('nama',$beasiswa->nama) }}" required class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi *</label>
                <textarea name="deskripsi" rows="3" required class="input-komik text-sm resize-none">{{ old('deskripsi',$beasiswa->deskripsi) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Syarat Umum</label>
                <textarea name="syarat" rows="4" class="input-komik text-sm resize-none">{{ old('syarat',$beasiswa->syarat) }}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Tipe Manfaat *</label>
                    <select name="tipe_manfaat" required class="input-komik text-sm">
                        <option value="penuh"    {{ old('tipe_manfaat',$beasiswa->tipe_manfaat)==='penuh'?'selected':'' }}>🆓 Penuh</option>
                        <option value="sebagian" {{ old('tipe_manfaat',$beasiswa->tipe_manfaat)==='sebagian'?'selected':'' }}>💰 Sebagian</option>
                        <option value="subsidi"  {{ old('tipe_manfaat',$beasiswa->tipe_manfaat)==='subsidi'?'selected':'' }}>🎟️ Subsidi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nilai Manfaat</label>
                    <input type="number" name="nilai_manfaat" value="{{ old('nilai_manfaat',$beasiswa->nilai_manfaat) }}" min="0" class="input-komik text-sm">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kuota</label>
                    <input type="number" name="kuota" value="{{ old('kuota',$beasiswa->kuota) }}" min="0" class="input-komik text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Dibuka</label>
                    <input type="date" name="buka_pada" value="{{ old('buka_pada',$beasiswa->buka_pada?->format('Y-m-d')) }}" class="input-komik text-sm">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Ditutup</label>
                    <input type="date" name="tutup_pada" value="{{ old('tutup_pada',$beasiswa->tutup_pada?->format('Y-m-d')) }}" class="input-komik text-sm">
                </div>
            </div>
            @if($pencapaian->isNotEmpty())
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-2 uppercase">⭐ Pencapaian Wajib</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($pencapaian as $p)
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-[#4361ee]">
                        <input type="checkbox" name="pencapaian_wajib[]" value="{{ $p->id }}"
                               {{ in_array($p->id, old('pencapaian_wajib',$beasiswa->pencapaian_wajib??[])) ? 'checked' : '' }}
                               class="w-4 h-4 border-2 border-[#1a1a2e] rounded">
                        <span class="text-xl">{{ $p->ikon }}</span>
                        <span class="text-xs font-black">{{ $p->nama }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="aktif" value="1" {{ $beasiswa->aktif?'checked':'' }} class="w-5 h-5 border-2 border-[#1a1a2e] rounded">
                <span class="text-sm font-black">✅ Aktif</span>
            </label>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-komik flex-1 py-3 bg-[#4361ee] text-white rounded-xl font-black">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                </button>
                <a href="/admin/beasiswa" class="btn-komik px-6 py-3 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
