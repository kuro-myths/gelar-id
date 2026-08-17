@extends('layouts.admin')
@section('title', 'Edit Gelar')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h3 class="font-bold text-gray-900 mb-6">Edit Gelar: {{ $degree->code }}</h3>
        <form method="POST" action="/admin/degrees/{{ $degree->id }}" class="space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kode</label>
                    <input type="text" value="{{ $degree->code }}" disabled class="w-full px-4 py-2.5 border border-gray-100 bg-gray-50 rounded-xl text-sm text-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori</label>
                    <select name="category" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="sarjana" {{ $degree->category=='sarjana'?'selected':'' }}>Sarjana Virtual</option>
                        <option value="diploma" {{ $degree->category=='diploma'?'selected':'' }}>Diploma Virtual</option>
                        <option value="vokasi" {{ $degree->category=='vokasi'?'selected':'' }}>Vokasi Virtual</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Gelar</label>
                <input type="text" name="name" value="{{ old('name', $degree->name) }}" required
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $degree->description) }}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Durasi (bulan)</label>
                    <input type="number" name="duration_months" value="{{ old('duration_months', $degree->duration_months) }}" required min="1"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">SKS</label>
                    <input type="number" name="credits_required" value="{{ old('credits_required', $degree->credits_required) }}" required min="1"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Warna</label>
                    <input type="color" name="color" value="{{ old('color', $degree->color) }}"
                           class="w-full h-10 border border-gray-200 rounded-xl cursor-pointer">
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" id="active" {{ $degree->is_active?'checked':'' }} class="rounded">
                <label for="active" class="text-sm font-semibold text-gray-700">Aktif</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition text-sm">Simpan</button>
                <a href="/admin/degrees" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition text-sm">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
