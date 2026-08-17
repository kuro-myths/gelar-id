@extends('tataletak.admin')
@section('judul','Buat Kuesioner')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">📋 BUAT KUESIONER</h3>
    @if($errors->any())<div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black text-sm" style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">@foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="/admin/kuesioner" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Judul *</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required class="input-komik text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="input-komik text-sm">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Tipe *</label>
                <select name="tipe" required class="input-komik text-sm">
                    @foreach(['pra_kelas'=>'📋 Pra-Kelas','pasca_kelas'=>'📝 Pasca-Kelas','kepuasan'=>'😊 Kepuasan','ujian'=>'📚 Ujian','umum'=>'📄 Umum'] as $v=>$l)
                    <option value="{{ $v }}" {{ old('tipe')===$v?'selected':'' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">⏱️ Batas Waktu (mnt, 0=∞)</label>
                <input type="number" name="batas_waktu_menit" value="{{ old('batas_waktu_menit',0) }}" min="0" class="input-komik text-sm">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Program</label>
                <select name="program_id" class="input-komik text-sm">
                    <option value="">—Semua Program—</option>
                    @foreach($program as $p)<option value="{{ $p->id }}" {{ old('program_id')==$p->id?'selected':'' }}>{{ $p->jenisGelar->kode }} — {{ $p->nama }}</option>@endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Sesi Belajar</label>
                <select name="sesi_belajar_id" class="input-komik text-sm">
                    <option value="">—Tidak Terhubung—</option>
                    @foreach($sesi as $s)<option value="{{ $s->id }}" {{ old('sesi_belajar_id')==$s->id?'selected':'' }}>{{ $s->judul }}</option>@endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Dibuka Pada</label>
                <input type="datetime-local" name="dibuka_pada" value="{{ old('dibuka_pada') }}" class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Ditutup Pada</label>
                <input type="datetime-local" name="ditutup_pada" value="{{ old('ditutup_pada') }}" class="input-komik text-sm">
            </div>
        </div>
        <div class="flex items-center gap-5">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="wajib" value="1" {{ old('wajib')?'checked':'' }}><span class="text-sm font-black text-[#1a1a2e]">📌 Wajib Diisi</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="acak_soal" value="1" {{ old('acak_soal')?'checked':'' }}><span class="text-sm font-black text-[#1a1a2e]">🔀 Acak Soal</span>
            </label>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">Lanjut Tambah Soal →</button>
            <a href="/admin/kuesioner" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
