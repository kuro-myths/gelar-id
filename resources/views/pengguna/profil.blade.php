@extends('tataletak.aplikasi')
@section('judul','Profil Saya')
@section('konten')
<div class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="judul-komik text-5xl text-[#1a1a2e] mb-8">👤 PROFILKU</h1>

    {{-- Kartu profil --}}
    <div class="kartu-komik overflow-hidden mb-6">
        <div class="h-3 bg-gradient-to-r from-[#4361ee] to-[#7209b7]"></div>
        <div class="p-6 flex items-center gap-5">
            <div class="w-20 h-20 rounded-2xl bg-[#4361ee] flex items-center justify-center text-white judul-komik text-4xl flex-shrink-0"
                 style="border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;">
                {{ strtoupper(substr($pengguna->nama, 0, 1)) }}
            </div>
            <div>
                <h2 class="judul-komik text-3xl text-[#1a1a2e]">{{ $pengguna->nama }}</h2>
                <p class="font-bold text-gray-500">{{ $pengguna->email }}</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="badge-komik bg-[#4361ee] text-white text-xs">{{ $pengguna->isAdmin() ? '👑 Admin' : '👤 Mahasiswa' }}</span>
                    @if($pengguna->nim)
                    <span class="badge-komik bg-[#ffd60a] text-[#1a1a2e] text-xs font-mono">NIM: {{ $pengguna->nim }}</span>
                    @endif
                    <span class="badge-komik {{ $pengguna->aktif ? 'bg-[#06d6a0] text-[#1a1a2e]' : 'bg-[#f72585] text-white' }} text-xs">
                        {{ $pengguna->aktif ? '✅ Aktif' : '❌ Nonaktif' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Form edit profil --}}
    <div class="kartu-komik p-8">
        <h3 class="judul-komik text-2xl text-[#1a1a2e] mb-6">✏️ EDIT PROFIL</h3>

        @if($errors->any())
        <div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black text-sm"
             style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
            @foreach($errors->all() as $e)<div>💥 {{ $e }}</div>@endforeach
        </div>
        @endif

        <form method="POST" action="/pengguna/profil" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">
                    👤 Nama Lengkap *
                </label>
                <input type="text" name="nama" value="{{ old('nama', $pengguna->nama) }}" required
                       class="input-komik w-full px-4 py-3 text-sm"
                       placeholder="Nama lengkap Anda">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">
                        📧 Email
                    </label>
                    <input type="email" value="{{ $pengguna->email }}" disabled
                           class="input-komik w-full px-4 py-3 text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">
                        🏷️ Username
                    </label>
                    <input type="text" value="{{ $pengguna->nama_pengguna }}" disabled
                           class="input-komik w-full px-4 py-3 text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
                </div>
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">
                    📱 Nomor Telepon
                </label>
                <input type="text" name="telepon" value="{{ old('telepon', $pengguna->telepon) }}"
                       class="input-komik w-full px-4 py-3 text-sm"
                       placeholder="08xx-xxxx-xxxx">
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">
                    🏢 Instansi / Pekerjaan
                </label>
                <input type="text" name="institusi" value="{{ old('institusi', $pengguna->institusi) }}"
                       class="input-komik w-full px-4 py-3 text-sm"
                       placeholder="Perusahaan atau institusi">
            </div>

            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">
                    📍 Alamat
                </label>
                <textarea name="alamat" rows="3"
                          class="input-komik w-full px-4 py-3 text-sm"
                          placeholder="Alamat lengkap Anda">{{ old('alamat', $pengguna->alamat) }}</textarea>
            </div>

            <button type="submit"
                    class="btn-komik w-full py-4 bg-[#4361ee] text-white rounded-2xl text-base">
                💾 SIMPAN PERUBAHAN
            </button>
        </form>
    </div>

    {{-- Info akun --}}
    <div class="kartu-komik p-5 mt-5">
        <h4 class="judul-komik text-lg text-[#1a1a2e] mb-3">📋 INFO AKUN</h4>
        <div class="space-y-2 text-sm">
            @php $akun = [
                ['label' => '🆔 NIM Virtual',    'nilai' => $pengguna->nim ?? '—'],
                ['label' => '📅 Bergabung',       'nilai' => $pengguna->created_at->translatedFormat('d F Y')],
                ['label' => '📊 Total Pendaftaran','nilai' => $pengguna->pendaftaran()->count().' program'],
                ['label' => '🏆 Sertifikat',      'nilai' => $pengguna->sertifikat()->count().' sertifikat'],
            ]; @endphp
            @foreach($akun as $a)
            <div class="flex justify-between py-2 border-b-2 border-gray-50">
                <span class="font-black text-gray-500">{{ $a['label'] }}</span>
                <span class="font-black text-[#1a1a2e]">{{ $a['nilai'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
