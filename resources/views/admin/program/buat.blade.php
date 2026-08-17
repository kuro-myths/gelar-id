@extends('tataletak.admin')
@section('judul','Tambah Program')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">➕ TAMBAH PROGRAM</h3>
    @if($errors->any())<div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black" style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">@foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="/admin/program" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Jenis Gelar *</label>
            <select name="jenis_gelar_id" required class="input-komik w-full px-4 py-2.5 text-sm">
                <option value="">Pilih gelar...</option>
                @foreach($gelar as $g)
                <option value="{{ $g->id }}" {{ old('jenis_gelar_id')==$g->id?'selected':'' }}>{{ $g->kode }} — {{ $g->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama Program *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required class="input-komik w-full px-4 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik w-full px-4 py-2.5 text-sm">{{ old('deskripsi') }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kurikulum</label>
            <textarea name="kurikulum" rows="4" class="input-komik w-full px-4 py-2.5 text-sm" placeholder="Daftar mata kuliah / modul...">{{ old('kurikulum') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">💰 Harga (Rp) *</label>
                <input type="number" name="harga" value="{{ old('harga',0) }}" required min="0" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">👥 Maks. Peserta (0=∞)</label>
                <input type="number" name="maks_peserta" value="{{ old('maks_peserta',0) }}" required min="0" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
        </div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="unggulan" value="1" {{ old('unggulan')?'checked':'' }} class="w-4 h-4">
            <span class="text-sm font-black text-[#1a1a2e]">⭐ Jadikan Program Unggulan</span>
        </label>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan</button>
            <a href="/admin/program" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
