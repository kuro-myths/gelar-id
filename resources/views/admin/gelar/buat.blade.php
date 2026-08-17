@extends('tataletak.admin')
@section('judul','Tambah Gelar')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">➕ TAMBAH JENIS GELAR</h3>
    @if($errors->any())<div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black" style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">@foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="/admin/gelar" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kode Gelar *</label>
                <input type="text" name="kode" value="{{ old('kode') }}" required placeholder="cth: KVT.Kom" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kategori *</label>
                <select name="kategori" required class="input-komik w-full px-4 py-2.5 text-sm">
                    <option value="">Pilih...</option>
                    <option value="sarjana">Sarjana Virtual</option>
                    <option value="diploma">Diploma Virtual</option>
                    <option value="vokasi">Vokasi Virtual</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama Gelar *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required class="input-komik w-full px-4 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik w-full px-4 py-2.5 text-sm">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">⏱️ Durasi (bln) *</label>
                <input type="number" name="durasi_bulan" value="{{ old('durasi_bulan') }}" required min="1" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📖 SKS *</label>
                <input type="number" name="sks_dibutuhkan" value="{{ old('sks_dibutuhkan') }}" required min="1" class="input-komik w-full px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">🎨 Warna</label>
                <input type="color" name="warna" value="{{ old('warna','#4361ee') }}" class="w-full h-11 input-komik cursor-pointer">
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan</button>
            <a href="/admin/gelar" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
