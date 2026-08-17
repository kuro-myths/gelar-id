@extends('layouts.admin')
@section('title', 'Jenis Gelar')

@section('content')
<div class="flex items-center justify-between mb-5">
    <div></div>
    <a href="/admin/degrees/create" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-1"></i> Tambah Gelar
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($degrees as $d)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-sm"
                 style="background-color: {{ $d->color }}">
                {{ $d->code }}
            </div>
            <span class="badge {{ $d->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $d->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>
        <h3 class="font-bold text-gray-900 mb-1">{{ $d->code }}</h3>
        <p class="text-sm text-gray-500 mb-1">{{ $d->name }}</p>
        <p class="text-xs text-gray-400 mb-4">{{ $d->duration_months }} bulan • {{ $d->credits_required }} SKS • {{ $d->programs_count }} program</p>
        <div class="flex gap-2">
            <a href="/admin/degrees/{{ $d->id }}/edit" class="flex-1 text-center py-2 bg-gray-100 text-gray-700 text-xs font-semibold rounded-lg hover:bg-gray-200 transition">Edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection
