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

            <div class="mt-5 pt-5 border-t-2 border-gray-100">
                <p class="text-center text-xs font-black text-gray-400 mb-3 uppercase">Atau masuk dengan</p>
                <a href="/auth/google" class="btn-komik w-full py-3 bg-white text-[#0f0e17] rounded-xl text-sm flex items-center justify-center gap-3 hover:bg-gray-50">
                    <svg class="w-5 h-5" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.2 0 5.9 1.1 8.1 2.9l6-6C34.5 3.2 29.6 1 24 1 14.6 1 6.6 6.7 2.9 14.9l7 5.4C11.6 13.8 17.3 9.5 24 9.5z"/><path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h12.7c-.6 3-2.3 5.5-4.8 7.2l7.4 5.8c4.3-4 6.8-9.9 7.2-17z"/><path fill="#FBBC05" d="M9.9 28.6A14.9 14.9 0 0 1 9.5 24c0-1.6.3-3.1.7-4.5l-7-5.4A23.5 23.5 0 0 0 .5 24c0 3.8.9 7.4 2.5 10.6l6.9-6z"/><path fill="#34A853" d="M24 47c5.7 0 10.5-1.9 14-5.1l-7.4-5.8c-1.9 1.3-4.3 2-6.6 2-5.7 0-10.5-3.8-12.3-9l-7 5.4C7 42.1 15 47 24 47z"/></svg>
                    Lanjutkan dengan Google
                </a>
            </div>

            <div class="mt-4 pt-4 border-t-2 border-gray-100 text-center">
                <p class="text-xs font-black text-gray-400 mb-2 uppercase">🔑 Akun Demo</p>
                <p class="text-xs font-bold text-gray-500">Admin: <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">admin@gelar.test</code> / <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">admin123</code></p>
                <p class="text-xs font-bold text-gray-500 mt-1">User: <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">budi@contoh.com</code> / <code class="bg-gray-100 px-2 py-0.5 rounded font-mono">password</code></p>
            </div>
        </div>
    </div>
</div>
@endsection
