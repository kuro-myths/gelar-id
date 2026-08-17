@extends('tataletak.admin')
@section('judul','Edit Pertemuan')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">✏️ EDIT PERTEMUAN</h3>
    <form method="POST" action="/admin/pertemuan/{{ $pertemuan->id }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Judul</label>
            <input type="text" name="judul" value="{{ old('judul',$pertemuan->judul) }}" required class="input-komik text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik text-sm">{{ old('deskripsi',$pertemuan->deskripsi) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Platform</label>
                <select name="platform" required class="input-komik text-sm">
                    @foreach(['zoom'=>'🎥 Zoom','meet'=>'📹 Google Meet','teams'=>'💼 MS Teams','internal'=>'🏠 Internal'] as $v=>$l)
                    <option value="{{ $v }}" {{ $pertemuan->platform===$v?'selected':'' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Status</label>
                <select name="status" required class="input-komik text-sm">
                    @foreach(['terjadwal'=>'Terjadwal','berlangsung'=>'Berlangsung','selesai'=>'Selesai','batal'=>'Dibatalkan'] as $v=>$l)
                    <option value="{{ $v }}" {{ $pertemuan->status===$v?'selected':'' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Tautan Gabung</label>
            <input type="url" name="tautan_gabung" value="{{ old('tautan_gabung',$pertemuan->tautan_gabung) }}" class="input-komik text-sm" placeholder="https://...">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Kata Sandi</label>
            <input type="text" name="kata_sandi" value="{{ old('kata_sandi',$pertemuan->kata_sandi) }}" class="input-komik text-sm">
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Jadwal</label>
                <input type="datetime-local" name="dijadwalkan_pada" value="{{ old('dijadwalkan_pada',$pertemuan->dijadwalkan_pada?->format('Y-m-d\TH:i')) }}" required class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">⏱️ Durasi</label>
                <input type="number" name="durasi_menit" value="{{ old('durasi_menit',$pertemuan->durasi_menit) }}" required min="15" class="input-komik text-sm">
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Maks Peserta</label>
            <input type="number" name="maks_peserta" value="{{ old('maks_peserta',$pertemuan->maks_peserta) }}" required min="1" class="input-komik text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">🔗 Tautan Rekaman</label>
            <input type="url" name="tautan_rekaman" value="{{ old('tautan_rekaman',$pertemuan->tautan_rekaman) }}" class="input-komik text-sm" placeholder="https://...">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Catatan</label>
            <textarea name="catatan" rows="2" class="input-komik text-sm">{{ old('catatan',$pertemuan->catatan) }}</textarea>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan</button>
            <a href="/admin/pertemuan/{{ $pertemuan->id }}" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
