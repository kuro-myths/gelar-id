@extends('tataletak.aplikasi')
@section('judul','Daftar')
@section('konten')
<div class="min-h-screen bg-[#f0f4ff] flex items-center justify-center py-12 px-4"
     style="background-image:radial-gradient(#f7258522 1px,transparent 1px);background-size:20px 20px;">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="text-6xl mb-3">🎓</div>
            <h2 class="judul-komik text-5xl text-[#1a1a2e]">DAFTAR GRATIS!</h2>
            <p class="text-gray-600 font-bold mt-1">Mulai perjalanan akademik virtualmu!</p>
        </div>

        <div class="bg-white rounded-3xl p-8" style="border:3px solid #1a1a2e;box-shadow:8px 8px 0 #1a1a2e;">
            @if($errors->any())
            <div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black" style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                <ul class="space-y-1 text-sm">
                    @foreach($errors->all() as $e)<li>💥 {{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="/daftar" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">👤 Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                           class="input-komik w-full px-4 py-3 text-sm" placeholder="Nama lengkap Anda">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">📧 Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="input-komik w-full px-4 py-3 text-sm" placeholder="email@contoh.com">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">🏷️ Username *</label>
                    <input type="text" name="nama_pengguna" value="{{ old('nama_pengguna') }}" required
                           class="input-komik w-full px-4 py-3 text-sm" placeholder="username_anda">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">🏢 Instansi</label>
                    <input type="text" name="institusi" value="{{ old('institusi') }}"
                           class="input-komik w-full px-4 py-3 text-sm" placeholder="Perusahaan / institusi">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">🔒 Password *</label>
                    <input type="password" name="password" required
                           class="input-komik w-full px-4 py-3 text-sm" placeholder="Min. 8 karakter">
                </div>
                <div>
                    <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase tracking-wide">🔒 Konfirmasi Password *</label>
                    <input type="password" name="password_confirmation" required
                           class="input-komik w-full px-4 py-3 text-sm" placeholder="Ulangi password">
                </div>
                <button type="submit" class="btn-komik w-full py-4 bg-[#f72585] text-white rounded-2xl text-lg mt-2">
                    🚀 BUAT AKUN SEKARANG!
                </button>
            </form>
            <p class="text-center text-sm font-bold text-gray-600 mt-6">
                Sudah punya akun?
                <a href="/masuk" class="text-[#4361ee] font-black hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
