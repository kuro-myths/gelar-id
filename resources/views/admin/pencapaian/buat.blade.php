@extends('tataletak.admin')
@section('judul','Buat Pencapaian')
@section('konten')
<div class="max-w-2xl">
    <a href="/admin/pencapaian" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm inline-flex mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>

    <div class="kartu-admin rounded-2xl p-7">
        <h2 class="judul-komik text-2xl text-[#1a1a2e] mb-6">🏆 BUAT PENCAPAIAN BARU</h2>

        @if($errors->any())
        <div class="pesan-galat px-4 py-3 rounded-xl mb-5 text-sm">
            @foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach
        </div>
        @endif

        <form method="POST" action="/admin/pencapaian" class="space-y-5">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Ikon (emoji)</label>
                    <input type="text" name="ikon" value="{{ old('ikon','🏆') }}" required
                           class="input-komik text-2xl text-center" maxlength="4" placeholder="🏆">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Warna</label>
                    <div class="flex gap-2 items-center">
                        <input type="color" name="warna" value="{{ old('warna','#ffd60a') }}"
                               class="w-12 h-10 rounded-lg border-2 border-[#1a1a2e] cursor-pointer">
                        <input type="text" id="txt-warna" value="{{ old('warna','#ffd60a') }}"
                               class="input-komik flex-1 text-sm font-mono"
                               oninput="document.querySelector('[name=warna]').value=this.value">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Nama Pencapaian *</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                       class="input-komik text-sm" placeholder="mis: Penakluk Minecraft — Selesaikan semua achievement">
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi *</label>
                <textarea name="deskripsi" rows="3" required class="input-komik text-sm resize-none"
                          placeholder="Jelaskan apa yang harus dilakukan untuk meraih pencapaian ini...">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kategori *</label>
                    <select name="kategori" required class="input-komik text-sm">
                        @foreach(['akademik'=>'📚 Akademik','kehadiran'=>'📅 Kehadiran','kuesioner'=>'📋 Kuesioner','game'=>'🎮 Game & Tantangan','sosial'=>'🤝 Sosial','khusus'=>'⭐ Khusus'] as $val=>$label)
                        <option value="{{ $val }}" {{ old('kategori')===$val?'selected':'' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Tipe Syarat *</label>
                    <select name="tipe_syarat" required class="input-komik text-sm" id="sel-tipe">
                        <option value="otomatis" {{ old('tipe_syarat')==='otomatis'?'selected':'' }}>⚡ Otomatis (sistem)</option>
                        <option value="manual"   {{ old('tipe_syarat')==='manual'?'selected':'' }}>👤 Manual (admin verifikasi)</option>
                        <option value="upload"   {{ old('tipe_syarat')==='upload'?'selected':'' }}>📤 Upload Bukti</option>
                    </select>
                </div>
            </div>

            {{-- Syarat detail (tampil kondisional) --}}
            <div id="blok-syarat" class="bg-[#f0f4ff] border-2 border-[#e0e7ff] rounded-xl p-4 space-y-3">
                <p class="text-xs font-black text-[#4361ee] uppercase">⚙️ Detail Syarat Otomatis (opsional)</p>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Tipe Trigger</label>
                        <select name="syarat_tipe" class="input-komik text-sm">
                            <option value="">-- Pilih --</option>
                            <option value="selesai_program">Selesai 1 Program</option>
                            <option value="xp_min">Capai XP Minimum</option>
                            <option value="daftar_program">Mendaftar Program</option>
                            <option value="isi_kuesioner">Isi Kuesioner</option>
                            <option value="hadir_pertemuan">Hadiri Pertemuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Nilai (angka jika perlu)</label>
                        <input type="number" name="syarat_nilai" value="{{ old('syarat_nilai',1) }}"
                               class="input-komik text-sm" min="1">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Keterangan Syarat</label>
                    <input type="text" name="syarat_keterangan" value="{{ old('syarat_keterangan') }}"
                           class="input-komik text-sm" placeholder="mis: Selesaikan semua achievement Minecraft survival mode">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Poin/XP</label>
                    <input type="number" name="poin" value="{{ old('poin',50) }}" required min="0"
                           class="input-komik text-sm">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Urutan Tampil</label>
                    <input type="number" name="urutan" value="{{ old('urutan',0) }}" required min="0"
                           class="input-komik text-sm">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="adalah_prasyarat_beasiswa" id="chk-beasiswa" value="1"
                       {{ old('adalah_prasyarat_beasiswa') ? 'checked' : '' }}
                       class="w-5 h-5 border-2 border-[#1a1a2e] rounded">
                <label for="chk-beasiswa" class="text-sm font-black text-[#1a1a2e] cursor-pointer">
                    ⭐ Pencapaian ini merupakan prasyarat program beasiswa
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-komik flex-1 py-3 bg-[#4361ee] text-white rounded-xl font-black">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Pencapaian
                </button>
                <a href="/admin/pencapaian" class="btn-komik px-6 py-3 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
@push('skrip')
<script>
document.querySelector('[name=warna]').addEventListener('input', function(){
    document.getElementById('txt-warna').value = this.value;
});
document.getElementById('sel-tipe').addEventListener('change', function(){
    document.getElementById('blok-syarat').style.display = this.value === 'otomatis' ? 'block' : 'none';
});
document.getElementById('blok-syarat').style.display =
    document.getElementById('sel-tipe').value === 'otomatis' ? 'block' : 'none';
</script>
@endpush
