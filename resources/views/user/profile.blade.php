@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-extrabold text-gray-900 mb-6">Profil Saya</h1>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-center gap-5 mb-8 pb-6 border-b border-gray-100">
            <div class="w-20 h-20 rounded-full gradient-bg flex items-center justify-center text-white text-3xl font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                <p class="text-blue-600 text-sm font-mono mt-1">NIM: {{ $user->nim ?? '-' }}</p>
            </div>
        </div>

        <form method="POST" action="/user/profile" class="space-y-4">
            @csrf @method('PUT')
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                </div>
            @endif
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor HP</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="08xx-xxxx-xxxx">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instansi / Pekerjaan</label>
                <input type="text" name="institution" value="{{ old('institution', $user->institution) }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat</label>
                <textarea name="address" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address', $user->address) }}</textarea>
            </div>
            <button type="submit" class="w-full py-3 gradient-bg text-white font-bold rounded-xl hover:opacity-90 transition text-sm">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
