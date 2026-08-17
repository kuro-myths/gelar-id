@extends('tataletak.admin')
@section('judul','Edit Program')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">✏️ EDIT PROGRAM</h3>
    <form method="POST" action="/admin/program/{{ $program->id }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Jenis Gelar</label>
            <select name="jenis_gelar_id" required class="input-komik w-full px-4 py-2.5 text-sm">
                @foreach($gelar as $g)
                <option value="{{ $g->id }}" {{ $program->jenis_gelar_id==$g->id?'selected':'' }}>{{ $g->kode }} — {{ $g->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama Program</label>
            <input type="text" name="nama" value="{{ old('nama',$program->nama) }}" required class="input-komik w-full px-4 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik w-full px-4 py-2.5 text-sm">{{ old('deskripsi',$program->deskripsi) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">💰 Harga (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga',$program->harga) }}" required min="0" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">👥 Maks. Peserta</label>
                <input type="number" name="maks_peserta" value="{{ old('maks_peserta',$program->maks_peserta) }}" min="0" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
        </div>
        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="unggulan" value="1" {{ $program->unggulan?'checked':'' }} class="w-4 h-4">
                <span class="text-sm font-black text-[#1a1a2e]">⭐ Unggulan</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="aktif" value="1" {{ $program->aktif?'checked':'' }} class="w-4 h-4">
                <span class="text-sm font-black text-[#1a1a2e]">✅ Aktif</span>
            </label>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan</button>
            <a href="/admin/program" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
