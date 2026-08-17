@extends('tataletak.admin')
@section('judul','Tambah Sesi Belajar')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 rounded-xl bg-[#4361ee] text-white font-black flex items-center justify-center judul-komik text-xl" style="border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">{{ $semester->nomor }}</div>
        <div>
            <h3 class="judul-komik text-2xl text-[#1a1a2e]">➕ TAMBAH SESI BELAJAR</h3>
            <p class="text-sm font-bold text-gray-500">{{ $semester->nama }} · {{ $semester->program->nama }}</p>
        </div>
    </div>
    @if($errors->any())<div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black text-sm" style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">@foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach</div>@endif
    <form method="POST" action="/admin/semester/{{ $semester->id }}/sesi" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Pertemuan Ke- *</label>
                <input type="number" name="pertemuan_ke" value="{{ old('pertemuan_ke', $semester->sesiBelajar->count()+1) }}" required min="1" class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Tipe *</label>
                <select name="tipe" required class="input-komik text-sm">
                    @foreach(['online'=>'🎥 Online Live','rekaman'=>'📹 Rekaman','mandiri'=>'📖 Mandiri'] as $v=>$l)
                    <option value="{{ $v }}" {{ old('tipe')===$v?'selected':'' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Judul Sesi *</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="cth: Pengantar Pemrograman" class="input-komik text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="2" class="input-komik text-sm">{{ old('deskripsi') }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Materi / Konten</label>
            <textarea name="materi" rows="4" class="input-komik text-sm" placeholder="Link materi, slide, video...">{{ old('materi') }}</textarea>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Mulai *</label>
                <input type="datetime-local" name="mulai_pada" value="{{ old('mulai_pada') }}" required class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">⏱️ Durasi (mnt)</label>
                <input type="number" name="durasi_menit" value="{{ old('durasi_menit',90) }}" required min="15" class="input-komik text-sm">
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">📅 Selesai *</label>
            <input type="datetime-local" name="selesai_pada" value="{{ old('selesai_pada') }}" required class="input-komik text-sm">
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">💾 Simpan Sesi</button>
            <a href="/admin/semester/{{ $semester->id }}" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">❌ Batal</a>
        </div>
    </form>
</div>
@endsection
