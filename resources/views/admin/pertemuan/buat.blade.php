@extends('tataletak.admin')
@section('judul','Jadwalkan Pertemuan')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">🎥 JADWALKAN PERTEMUAN</h3>
    @if($errors->any())<div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black text-sm" style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">@foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="/admin/pertemuan" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Judul Pertemuan *</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required class="input-komik text-sm">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Program *</label>
                <select name="program_id" required class="input-komik text-sm">
                    <option value="">Pilih...</option>
                    @foreach($program as $p)<option value="{{ $p->id }}" {{ old('program_id')==$p->id?'selected':'' }}>{{ $p->jenisGelar->kode }} — {{ $p->nama }}</option>@endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Sesi Belajar</label>
                <select name="sesi_belajar_id" class="input-komik text-sm">
                    <option value="">Tidak terhubung</option>
                    @foreach($sesiDaftar as $s)<option value="{{ $s->id }}" {{ old('sesi_belajar_id')==$s->id?'selected':'' }}>{{ $s->semester->program->nama }} — {{ $s->judul }}</option>@endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik text-sm">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">🖥️ Platform *</label>
                <select name="platform" required class="input-komik text-sm">
                    @foreach(['zoom'=>'🎥 Zoom','meet'=>'📹 Google Meet','teams'=>'💼 MS Teams','internal'=>'🏠 Internal'] as $v=>$l)
                    <option value="{{ $v }}" {{ old('platform')===$v?'selected':'' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">🔑 Kata Sandi</label>
                <input type="text" name="kata_sandi" value="{{ old('kata_sandi') }}" class="input-komik text-sm" placeholder="Opsional">
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">🔗 Tautan Gabung (Zoom/Meet)</label>
            <input type="url" name="tautan_gabung" value="{{ old('tautan_gabung') }}" class="input-komik text-sm" placeholder="https://...">
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Jadwal *</label>
                <input type="datetime-local" name="dijadwalkan_pada" value="{{ old('dijadwalkan_pada') }}" required class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">⏱️ Durasi (mnt) *</label>
                <input type="number" name="durasi_menit" value="{{ old('durasi_menit',90) }}" required min="15" class="input-komik text-sm">
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">👥 Maks Peserta *</label>
            <input type="number" name="maks_peserta" value="{{ old('maks_peserta',100) }}" required min="1" class="input-komik text-sm">
        </div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="rekam_otomatis" value="1" {{ old('rekam_otomatis')?'checked':'' }}>
            <span class="text-sm font-black text-[#1a1a2e]">📹 Rekam Otomatis</span>
        </label>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Jadwalkan</button>
            <a href="/admin/pertemuan" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
