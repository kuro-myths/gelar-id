@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

{{-- Stats Grid --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    @php
        $cards = [
            ['label'=>'Pengguna','value'=>$stats['users'],'icon'=>'fa-users','color'=>'blue','link'=>'/admin/users'],
            ['label'=>'Program','value'=>$stats['programs'],'icon'=>'fa-book-open','color'=>'indigo','link'=>'/admin/programs'],
            ['label'=>'Pendaftaran','value'=>$stats['enrollments'],'icon'=>'fa-user-graduate','color'=>'purple','link'=>'/admin/enrollments'],
            ['label'=>'Aktif','value'=>$stats['active_enrollments'],'icon'=>'fa-play-circle','color'=>'green','link'=>'/admin/enrollments'],
            ['label'=>'Selesai','value'=>$stats['completed'],'icon'=>'fa-check-circle','color'=>'teal','link'=>'/admin/enrollments'],
            ['label'=>'Sertifikat','value'=>$stats['certificates'],'icon'=>'fa-certificate','color'=>'yellow','link'=>'/admin/certificates'],
        ];
    @endphp
    @foreach($cards as $c)
    <a href="{{ $c['link'] }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-{{ $c['color'] }}-50 flex items-center justify-center flex-shrink-0">
                <i class="fas {{ $c['icon'] }} text-{{ $c['color'] }}-600 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-extrabold text-gray-900">{{ $c['value'] }}</p>
                <p class="text-xs text-gray-500">{{ $c['label'] }}</p>
            </div>
        </div>
    </a>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Recent Enrollments --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-900">Pendaftaran Terbaru</h3>
            <a href="/admin/enrollments" class="text-sm text-blue-600 hover:underline">Lihat semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Mahasiswa</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Program</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Status</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentEnrollments as $e)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $e->user->name }}</div>
                            <div class="text-xs text-gray-400">{{ $e->user->email }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="badge text-xs" style="background-color: {{ $e->program->degreeType->color }}20; color: {{ $e->program->degreeType->color }}">
                                {{ $e->program->degreeType->code }}
                            </span>
                            <div class="text-xs text-gray-600 mt-0.5">{{ Str::limit($e->program->name, 30) }}</div>
                        </td>
                        <td class="px-4 py-3">
                            @php $colors = ['pending'=>'yellow','active'=>'blue','completed'=>'green','cancelled'=>'red'] @endphp
                            <span class="badge bg-{{ $colors[$e->status] ?? 'gray' }}-100 text-{{ $colors[$e->status] ?? 'gray' }}-700">
                                {{ $e->status_label }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-500">{{ $e->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-8 text-gray-400">Belum ada pendaftaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Degree Stats --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-900 mb-4">Statistik Gelar</h3>
        <div class="space-y-3">
            @foreach($degreeStats as $d)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                     style="background-color: {{ $d->color }}">
                    {{ substr($d->code, 0, 2) }}
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-0.5">
                        <span class="text-sm font-medium text-gray-700">{{ $d->code }}</span>
                        <span class="text-xs text-gray-500">{{ $d->certificates_count }} sertifikat</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        @php $max = $degreeStats->max('certificates_count') ?: 1 @endphp
                        <div class="h-1.5 rounded-full" style="width: {{ ($d->certificates_count / $max) * 100 }}%; background-color: {{ $d->color }}"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6 grid grid-cols-2 gap-3">
            <a href="/admin/degrees/create" class="text-center py-2.5 bg-blue-600 text-white text-xs font-bold rounded-xl hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-1"></i>Tambah Gelar
            </a>
            <a href="/admin/programs/create" class="text-center py-2.5 bg-gray-100 text-gray-700 text-xs font-bold rounded-xl hover:bg-gray-200 transition">
                <i class="fas fa-plus mr-1"></i>Tambah Program
            </a>
        </div>
    </div>
</div>

@endsection
