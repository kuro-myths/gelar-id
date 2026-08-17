@extends('tataletak.admin')
@section('judul','Edit Pengguna')
@section('konten')
<div class="max-w-lg mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">✏️ EDIT PENGGUNA</h3>
    <form method="POST" action="/admin/pengguna/{{ $pengguna->id }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama</label>
            <input type="text" name="nama" value="{{ old('nama',$pengguna->nama) }}" required class="input-komik w-full px-4 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Peran</label>
            <select name="peran" class="input-komik w-full px-4 py-2.5 text-sm">
                <option value="pengguna" {{ $pengguna->peran=='pengguna'?'selected':'' }}>👤 Pengguna</option>
                <option value="admin" {{ $pengguna->peran=='admin'?'selected':'' }}>👑 Admin</option>
            </select>
        </div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="aktif" value="1" {{ $pengguna->aktif?'checked':'' }} class="w-4 h-4">
            <span class="text-sm font-black text-[#1a1a2e]">✅ Akun Aktif</span>
        </label>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan</button>
            <a href="/admin/pengguna" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
