@extends('tataletak.admin')
@section('judul','Edit Pencapaian')
@section('konten')
<div class="max-w-2xl">
    <a href="/admin/pencapaian" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm inline-flex mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
    <div class="kartu-admin rounded-2xl p-7">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl border-2 border-[#1a1a2e]"
                 style="background:{{ $pencapaian->warna }}33;">{{ $pencapaian->ikon }}</div>
            <h2 class="judul-komik text-2xl text-[#1a1a2e]">EDIT PENCAPAIAN</h2>
        </div>

        <form method="POST" action="/admin/pencapaian/{{ $pencapaian->id }}" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Ikon (emoji)</label>
                    <input type="text" name="ikon" value="{{ old('ikon', $pencapaian->ikon) }}" required class="input-komik text-2xl text-center" maxlength="4">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Warna</label>
                    <div class="flex gap-2 items-center">
                        <input type="color" name="warna" value="{{ old('warna', $pencapaian->warna) }}" class="w-12 h-10 rounded-lg border-2 border-[#1a1a2e] cursor-pointer">
                        <input type="text" value="{{ old('warna', $pencapaian->warna) }}" class="input-komik flex-1 text-sm font-mono" oninput="document.querySelector('[name=warna]').value=this.value">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama *</label>
                <input type="text" name="nama" value="{{ old('nama', $pencapaian->nama) }}" required class="input-komik text-sm">
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi *</label>
                <textarea name="deskripsi" rows="3" required class="input-komik text-sm resize-none">{{ old('deskripsi', $pencapaian->deskripsi) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kategori *</label>
                    <select name="kategori" required class="input-komik text-sm">
                        @foreach(['akademik'=>'📚 Akademik','kehadiran'=>'📅 Kehadiran','kuesioner'=>'📋 Kuesioner','game'=>'🎮 Game & Tantangan','sosial'=>'🤝 Sosial','khusus'=>'⭐ Khusus'] as $val=>$label)
                        <option value="{{ $val }}" {{ old('kategori',$pencapaian->kategori)===$val?'selected':'' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Tipe Syarat *</label>
                    <select name="tipe_syarat" required class="input-komik text-sm">
                        <option value="otomatis" {{ old('tipe_syarat',$pencapaian->tipe_syarat)==='otomatis'?'selected':'' }}>⚡ Otomatis</option>
                        <option value="manual"   {{ old('tipe_syarat',$pencapaian->tipe_syarat)==='manual'?'selected':'' }}>👤 Manual</option>
                        <option value="upload"   {{ old('tipe_syarat',$pencapaian->tipe_syarat)==='upload'?'selected':'' }}>📤 Upload Bukti</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Poin/XP</label>
                    <input type="number" name="poin" value="{{ old('poin', $pencapaian->poin) }}" required min="0" class="input-komik text-sm">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $pencapaian->urutan) }}" required min="0" class="input-komik text-sm">
                </div>
            </div>

            <div class="flex flex-wrap gap-5">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="adalah_prasyarat_beasiswa" value="1" {{ $pencapaian->adalah_prasyarat_beasiswa?'checked':'' }} class="w-5 h-5 border-2 border-[#1a1a2e] rounded">
                    <span class="text-sm font-black">⭐ Prasyarat Beasiswa</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" {{ $pencapaian->aktif?'checked':'' }} class="w-5 h-5 border-2 border-[#1a1a2e] rounded">
                    <span class="text-sm font-black">✅ Aktif</span>
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-komik flex-1 py-3 bg-[#4361ee] text-white rounded-xl font-black">
                    <i data-lucide="save" class="w-4 h-4"></i> Perbarui
                </button>
                <a href="/admin/pencapaian" class="btn-komik px-6 py-3 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
