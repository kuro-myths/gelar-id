@extends('layouts.app')
@section('title', 'Masuk')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 mb-6">
                <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center">
                    <span class="text-white font-bold">G</span>
                </div>
                <span class="font-bold text-2xl text-gray-900">Gelar<span class="text-blue-600">.id</span></span>
            </a>
            <h2 class="text-2xl font-extrabold text-gray-900">Masuk ke Akun</h2>
            <p class="text-gray-500 mt-1">Lanjutkan perjalanan belajar Anda</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="email@contoh.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Masukkan password">
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
                        Ingat saya
                    </label>
                </div>
                <button type="submit" class="w-full py-3.5 gradient-bg text-white font-bold rounded-xl hover:opacity-90 transition text-sm">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun?
                <a href="/register" class="text-blue-600 font-semibold hover:underline">Daftar gratis</a>
            </p>

            <div class="mt-5 pt-5 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-400 mb-2">Akun demo:</p>
                <p class="text-xs text-gray-500">Admin: <code class="bg-gray-100 px-1 rounded">admin@gelar.test</code> / <code class="bg-gray-100 px-1 rounded">admin123</code></p>
                <p class="text-xs text-gray-500 mt-1">User: <code class="bg-gray-100 px-1 rounded">budi@example.com</code> / <code class="bg-gray-100 px-1 rounded">password</code></p>
            </div>
        </div>
    </div>
</div>
@endsection
