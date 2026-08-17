@extends('tataletak.admin')
@section('judul','Buat Diskon Baru')
@section('konten')
<div class="max-w-2xl mx-auto kartu-admin p-8">
    <h3 class="judul-komik text-2xl text-[#0f0e17] mb-6 flex items-center gap-2">
        <i data-lucide="tag" class="w-6 h-6 text-[#4361ee]"></i> BUAT DISKON BARU
    </h3>
    @if($errors->any())
    <div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black text-sm" style="border:2px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
        @foreach($errors->all() as $e)<div class="flex items-center gap-1"><i data-lucide="alert-circle" class="w-4 h-4"></i>{{ $e }}</div>@endforeach
    </div>
    @endif
    <form method="POST" action="/admin/diskon" class="space-y-5">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Kode Voucher *</label>
                <input type="text" name="kode" value="{{ old('kode') }}" required placeholder="HEMAT50"
                       oninput="this.value=this.value.toUpperCase()" class="input-komik text-sm font-mono">
            </div>
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Tipe *</label>
                <select name="tipe" required class="input-komik text-sm">
                    <option value="persen">Diskon Persen (%)</option>
                    <option value="nominal">Potongan Rp</option>
                    <option value="gratis">Gratis 100%</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Nama Promosi *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required class="input-komik text-sm" placeholder="Promo Kemerdekaan 50%">
        </div>
        <div>
            <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Deskripsi</label>
            <textarea name="deskripsi" rows="2" class="input-komik text-sm">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Nilai *</label>
                <input type="number" name="nilai" value="{{ old('nilai',0) }}" required min="0" class="input-komik text-sm">
                <p class="text-xs text-gray-400 mt-1 font-bold">% atau Rp</p>
            </div>
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Maks Pakai</label>
                <input type="number" name="maks_penggunaan" value="{{ old('maks_penggunaan',0) }}" min="0" class="input-komik text-sm">
                <p class="text-xs text-gray-400 mt-1 font-bold">0 = tak terbatas</p>
            </div>
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Min Pembelian</label>
                <input type="number" name="min_pembelian" value="{{ old('min_pembelian',0) }}" min="0" class="input-komik text-sm">
                <p class="text-xs text-gray-400 mt-1 font-bold">Rp minimum</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Berlaku Mulai</label>
                <input type="datetime-local" name="berlaku_mulai" value="{{ old('berlaku_mulai') }}" class="input-komik text-sm">
            </div>
            <div>
                <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase">Berlaku Hingga</label>
                <input type="datetime-local" name="berlaku_hingga" value="{{ old('berlaku_hingga') }}" class="input-komik text-sm">
            </div>
        </div>
        <div>
            <label class="block text-xs font-black text-[#0f0e17] mb-2 uppercase">Program Berlaku <span class="normal-case text-gray-400 font-normal">(kosong=semua)</span></label>
            <div class="rounded-xl p-3 space-y-2 max-h-48 overflow-y-auto" style="border:2px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                @foreach($program as $p)
                <label class="flex items-center gap-3 cursor-pointer hover:bg-[#f0f4ff] px-2 py-1.5 rounded-lg">
                    <input type="checkbox" name="program_ids[]" value="{{ $p->id }}" class="w-4 h-4 accent-[#4361ee]">
                    <span class="badge-komik text-white text-xs shrink-0" style="background:{{ $p->jenisGelar->warna }};border-color:#0f0e17;">{{ $p->jenisGelar->kode }}</span>
                    <span class="text-sm font-bold truncate flex-1">{{ $p->nama }}</span>
                    <span class="text-xs font-black text-gray-400">{{ $p->harga > 0 ? 'Rp '.number_format($p->harga,0,',','.') : 'GRATIS' }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-komik px-6 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
                <i data-lucide="check" class="w-4 h-4"></i> Simpan Diskon
            </button>
            <a href="/admin/diskon" class="btn-komik px-6 py-2.5 bg-gray-100 text-[#0f0e17] rounded-xl text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
