@extends('layouts.admin')
@section('title', 'Manajemen Program')

@section('content')
<div class="flex items-center justify-between mb-5">
    <div></div>
    <a href="/admin/programs/create" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-1"></i> Tambah Program
    </a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Program</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Gelar</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Harga</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Peserta</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Status</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($programs as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-900">{{ $p->name }}</div>
                        @if($p->is_featured)
                            <span class="badge bg-yellow-100 text-yellow-700 text-xs">Unggulan</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge text-xs" style="background:{{ $p->degreeType->color }}20;color:{{ $p->degreeType->color }}">{{ $p->degreeType->code }}</span>
                    </td>
                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                        {{ $p->is_free ? '<span class="badge bg-green-100 text-green-700">GRATIS</span>' : 'Rp ' . number_format($p->price, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-500">{{ $p->participant_count }}</td>
                    <td class="px-4 py-3">
                        <span class="badge {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="/admin/programs/{{ $p->id }}/edit" class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs rounded-lg hover:bg-gray-200 transition">Edit</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada program</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100">{{ $programs->links() }}</div>
</div>
@endsection
