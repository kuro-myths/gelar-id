@extends('tataletak.aplikasi')
@section('judul','Verifikasi Sertifikat')
@section('konten')
<div class="max-w-2xl mx-auto px-4 py-16">
    <div class="text-center mb-10">
        <div class="text-7xl mb-4 apung" style="animation:apung 3s ease-in-out infinite;">🛡️</div>
        <h1 class="judul-komik text-6xl text-[#1a1a2e] mb-2">VERIFIKASI!</h1>
        <p class="text-gray-600 font-bold">Masukkan kode verifikasi untuk cek keaslian sertifikat</p>
    </div>

    <div class="kartu-komik p-8 mb-6">
        <form method="GET" action="/verifikasi" class="flex gap-3">
            <input type="text" name="kode" value="{{ request('kode') }}"
                   placeholder="Masukkan kode verifikasi..."
                   class="input-komik flex-1 px-4 py-3 text-sm font-mono uppercase"
                   style="text-transform:uppercase">
            <button type="submit" class="btn-komik px-6 py-3 bg-[#4361ee] text-white rounded-xl text-sm">🔍 Cek!</button>
        </form>
    </div>

    @if(request('kode'))
        @if($sertifikat)
        <div class="kartu-komik p-8" style="border-color:#06d6a0;box-shadow:8px 8px 0 #06d6a0;">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 bg-[#06d6a0] rounded-2xl border-3 border-[#1a1a2e] flex items-center justify-center text-4xl" style="border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">✅</div>
                <div>
                    <h3 class="judul-komik text-3xl text-[#06d6a0]">SERTIFIKAT VALID!</h3>
                    <p class="text-sm font-bold text-gray-600">Sertifikat ini asli dan terverifikasi 🎉</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                @php $info = [
                    ['label'=>'👤 Nama Penerima','nilai'=>$sertifikat->nama_tercetak],
                    ['label'=>'🎓 Gelar','nilai'=>$sertifikat->jenisGelar->kode.' — '.$sertifikat->jenisGelar->nama],
                    ['label'=>'📚 Program','nilai'=>$sertifikat->pendaftaran->program->nama],
                    ['label'=>'📅 Tanggal Terbit','nilai'=>$sertifikat->tanggal_terbit->format('d F Y')],
                ] @endphp
                @foreach($info as $i)
                <div class="kartu-komik p-4 bg-[#f0f4ff]">
                    <p class="text-xs font-black text-gray-500 mb-1">{{ $i['label'] }}</p>
                    <p class="font-black text-[#1a1a2e]">{{ $i['nilai'] }}</p>
                </div>
                @endforeach
                <div class="col-span-2 kartu-komik p-4 bg-[#f0f4ff]">
                    <p class="text-xs font-black text-gray-500 mb-1">📜 Nomor Sertifikat</p>
                    <p class="font-mono font-black text-[#1a1a2e]">{{ $sertifikat->nomor_sertifikat }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="kartu-komik p-8 text-center" style="border-color:#f72585;box-shadow:8px 8px 0 #f72585;">
            <div class="text-6xl mb-4">❌</div>
            <h3 class="judul-komik text-3xl text-[#f72585] mb-2">TIDAK DITEMUKAN!</h3>
            <p class="text-sm font-bold text-gray-600">Kode <code class="bg-gray-100 px-2 py-1 rounded font-mono font-black">{{ request('kode') }}</code> tidak valid atau sertifikat tidak berlaku.</p>
        </div>
        @endif
    @endif
</div>
@endsection
