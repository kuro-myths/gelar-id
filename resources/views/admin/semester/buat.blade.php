@extends('tataletak.admin')
@section('judul','Tambah Semester')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">📅 TAMBAH SEMESTER</h3>
    @if($errors->any())<div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black text-sm" style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">@foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="/admin/semester" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Program *</label>
                <select name="program_id" required class="input-komik text-sm">
                    <option value="">Pilih...</option>
                    @foreach($program as $p)<option value="{{ $p->id }}" {{ old('program_id')==$p->id?'selected':'' }}>{{ $p->jenisGelar->kode }} — {{ $p->nama }}</option>@endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Semester Ke- *</label>
                <input type="number" name="nomor" value="{{ old('nomor',1) }}" required min="1" class="input-komik text-sm">
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama Semester *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="cth: Semester 1 / Ganjil 2024" class="input-komik text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik text-sm">{{ old('deskripsi') }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📖 Jumlah SKS *</label>
            <input type="number" name="jumlah_sks" value="{{ old('jumlah_sks',18) }}" required min="0" class="input-komik text-sm">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="input-komik text-sm">
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan</button>
            <a href="/admin/semester" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
