@extends('tataletak.admin')
@section('judul','Edit Semester')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">✏️ EDIT SEMESTER</h3>
    <form method="POST" action="/admin/semester/{{ $semester->id }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama Semester</label>
            <input type="text" name="nama" value="{{ old('nama',$semester->nama) }}" required class="input-komik text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik text-sm">{{ old('deskripsi',$semester->deskripsi) }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📖 Jumlah SKS</label>
            <input type="number" name="jumlah_sks" value="{{ old('jumlah_sks',$semester->jumlah_sks) }}" required min="0" class="input-komik text-sm">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai',$semester->tanggal_mulai?->format('Y-m-d')) }}" class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai',$semester->tanggal_selesai?->format('Y-m-d')) }}" class="input-komik text-sm">
            </div>
        </div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="aktif" value="1" {{ $semester->aktif?'checked':'' }}><span class="text-sm font-black text-[#1a1a2e]">✅ Aktif</span>
        </label>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan</button>
            <a href="/admin/semester/{{ $semester->id }}" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
