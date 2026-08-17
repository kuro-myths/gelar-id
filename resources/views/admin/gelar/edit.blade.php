@extends('tataletak.admin')
@section('judul','Edit Gelar')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">✏️ EDIT GELAR: {{ $gelar->kode }}</h3>
    <form method="POST" action="/admin/gelar/{{ $gelar->id }}" class="space-y-4">
        @csrf @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kode</label>
                <input type="text" value="{{ $gelar->kode }}" disabled class="input-komik w-full px-4 py-2.5 text-sm bg-gray-50 text-gray-500">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kategori</label>
                <select name="kategori" class="input-komik w-full px-4 py-2.5 text-sm">
                    @foreach(['sarjana'=>'Sarjana Virtual','diploma'=>'Diploma Virtual','vokasi'=>'Vokasi Virtual'] as $v=>$l)
                    <option value="{{ $v }}" {{ $gelar->kategori==$v?'selected':'' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama Gelar</label>
            <input type="text" name="nama" value="{{ old('nama',$gelar->nama) }}" required class="input-komik w-full px-4 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik w-full px-4 py-2.5 text-sm">{{ old('deskripsi',$gelar->deskripsi) }}</textarea>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">⏱️ Durasi (bln)</label>
                <input type="number" name="durasi_bulan" value="{{ old('durasi_bulan',$gelar->durasi_bulan) }}" required min="1" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📖 SKS</label>
                <input type="number" name="sks_dibutuhkan" value="{{ old('sks_dibutuhkan',$gelar->sks_dibutuhkan) }}" required min="1" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">🎨 Warna</label>
                <input type="color" name="warna" value="{{ old('warna',$gelar->warna) }}" class="w-full h-11 input-komik cursor-pointer">
            </div>
        </div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="aktif" value="1" {{ $gelar->aktif?'checked':'' }} class="w-4 h-4">
            <span class="text-sm font-black text-[#1a1a2e]">✅ Aktif</span>
        </label>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan</button>
            <a href="/admin/gelar" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
