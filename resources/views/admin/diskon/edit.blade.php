@extends('tataletak.admin')
@section('judul','Edit Diskon')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#0f0e17] mb-6 flex items-center gap-2">
        <i data-lucide="edit-2" class="w-6 h-6 text-[#4361ee]"></i>
        EDIT DISKON: <code class="bg-[#ffd60a] px-2 py-0.5 rounded text-lg ml-1" style="border:2px solid #0f0e17;">{{ $diskon->kode }}</code>
    </h3>
    <form method="POST" action="/admin/diskon/{{ $diskon->id }}" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Kode</label>
                <input type="text" value="{{ $diskon->kode }}" disabled class="input-komik text-sm bg-gray-50 text-gray-400 font-mono cursor-not-allowed">
            </div>
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Tipe *</label>
                <select name="tipe" required class="input-komik text-sm">
                    @foreach(['persen'=>'Diskon Persen (%)','nominal'=>'Potongan Rp','gratis'=>'Gratis 100%'] as $v=>$l)
                    <option value="{{ $v }}" {{ $diskon->tipe===$v?'selected':'' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Nama Promosi *</label>
            <input type="text" name="nama" value="{{ old('nama',$diskon->nama) }}" required class="input-komik text-sm">
        </div>
        <div>
            <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="2" class="input-komik text-sm">{{ old('deskripsi',$diskon->deskripsi) }}</textarea>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div><label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Nilai *</label>
            <input type="number" name="nilai" value="{{ old('nilai',$diskon->nilai) }}" required min="0" class="input-komik text-sm"></div>
            <div><label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Maks Pakai</label>
            <input type="number" name="maks_penggunaan" value="{{ old('maks_penggunaan',$diskon->maks_penggunaan) }}" min="0" class="input-komik text-sm"></div>
            <div><label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Min Pembelian</label>
            <input type="number" name="min_pembelian" value="{{ old('min_pembelian',$diskon->min_pembelian) }}" min="0" class="input-komik text-sm"></div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Berlaku Mulai</label>
            <input type="datetime-local" name="berlaku_mulai" value="{{ old('berlaku_mulai',$diskon->berlaku_mulai?->format('Y-m-d\TH:i')) }}" class="input-komik text-sm"></div>
            <div><label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Berlaku Hingga</label>
            <input type="datetime-local" name="berlaku_hingga" value="{{ old('berlaku_hingga',$diskon->berlaku_hingga?->format('Y-m-d\TH:i')) }}" class="input-komik text-sm"></div>
        </div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="aktif" value="1" {{ $diskon->aktif?'checked':'' }} class="w-4 h-4 accent-[#4361ee]">
            <span class="text-sm font-black text-[#0f0e17]">Diskon Aktif</span>
        </label>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
                <i data-lucide="check" class="w-4 h-4"></i> Simpan Perubahan
            </button>
            <a href="/admin/diskon" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#0f0e17] rounded-xl text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
