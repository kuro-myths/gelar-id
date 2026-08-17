@extends('tataletak.aplikasi')
@section('judul','Masuk')
@section('konten')
<div class="min-h-screen bg-[#f0f4ff] flex items-center justify-center py-12 px-4"
     style="background-image:radial-gradient(#4361ee22 1px,transparent 1px);background-size:20px 20px;">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-[#4361ee] rounded-2xl border-4 border-[#1a1a2e] flex items-center justify-center mx-auto mb-4 apung"
                 style="box-shadow:5px 5px 0 #1a1a2e;animation:apung 3s ease-in-out infinite;">
                <span class="judul-komik text-white text-2xl">G</span>
            </div>
            <h2 class="judul-komik text-5xl text-[#1a1a2e]">MASUK!</h2>
            <p class="text-gray-600 font-bold mt-1">Lanjutkan perjalanan belajarmu 🚀</p>
        </div>

        <div class="bg-white rounded-3xl p-8" style="border:3px solid #1a1a2e;box-shadow:8px 8px 0 #1a1a2e;">
            @if($errors->any())
            <div class="bg-[#f72585] text-white px-4 py-3 rounded-xl mb-5 font-black flex items-center gap-2"
                 style="border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                💥 {{ $errors->first() }}
            </div>
            @endif
            <form method="POST" action="/masuk" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-black text-[#1a1a2e] mb-2 uppercase tracking-wide">📧 Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="input-komik w-full px-4 py-3 text-sm bg-white"
                           placeholder="email@contoh.com">
                </div>
                <div>
                    <label class="block text-sm font-black text-[#1a1a2e] mb-2 uppercase tracking-wide">🔒 Password</label>
                    <input type="password" name="password" required
                           class="input-komik w-full px-4 py-3 text-sm bg-white"
                           placeholder="Masukkan password">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="ingat" class="w-4 h-4">
                    <span class="text-sm font-bold text-gray-700">Ingat saya</span>
                </label>
                <button type="submit"
                        class="btn-komik w-full py-4 bg-[#4361ee] text-white rounded-2xl text-lg">
                    ⚡ MASUK SEKARANG!
                </button>
            </form>

            <p class="text-center text-sm font-bold text-gray-600 mt-6">
                Belum punya akun?
                <a href="/daftar" class="text-[#f72585] font-black hover:underline">Daftar GRATIS!</a>
            </p>

            <div class="mt-5 pt-5 border-t-2 border-gray-100 text-center">
                <p class="text-xs font-black text-gray-400 mb-2 uppercase">🔑 Akun Demo</p>
                <p class="text-xs font-bold text-gray-500">Admin: <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">admin@gelar.test</code> / <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">admin123</code></p>
                <p class="text-xs font-bold text-gray-500 mt-1">User: <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">budi@contoh.com</code> / <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">password</code></p>
            </div>
        </div>
    </div>
</div>
@endsection
