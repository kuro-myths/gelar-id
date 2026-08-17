@extends('layouts.admin')
@section('title', 'Sertifikat')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-900">Semua Sertifikat</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">No. Sertifikat</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Penerima</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Gelar</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Program</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Kode Verifikasi</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($certificates as $c)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs text-gray-600">{{ $c->certificate_number }}</td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-900">{{ $c->issued_name }}</div>
                        <div class="text-xs text-gray-400">{{ $c->user->email }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge text-xs" style="background:{{ $c->degreeType->color }}20;color:{{ $c->degreeType->color }}">{{ $c->degreeType->code }}</span>
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-600">{{ Str::limit($c->enrollment->program->name, 30) }}</td>
                    <td class="px-4 py-3 font-mono text-xs font-bold text-blue-600">{{ $c->verify_code }}</td>
                    <td class="px-4 py-3 text-xs text-gray-500">{{ $c->issued_date->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada sertifikat</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100">{{ $certificates->links() }}</div>
</div>
@endsection
