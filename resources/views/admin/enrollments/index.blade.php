@extends('layouts.admin')
@section('title', 'Manajemen Pendaftaran')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-900">Semua Pendaftaran</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">#</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Mahasiswa</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Program</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Status</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Tanggal</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($enrollments as $e)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-xs text-gray-400">{{ $e->enrollment_number }}</td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-900">{{ $e->user->name }}</div>
                        <div class="text-xs text-gray-400">{{ $e->user->nim }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge text-xs" style="background:{{ $e->program->degreeType->color }}20;color:{{ $e->program->degreeType->color }}">{{ $e->program->degreeType->code }}</span>
                        <div class="text-xs text-gray-600 mt-0.5">{{ Str::limit($e->program->name, 25) }}</div>
                    </td>
                    <td class="px-4 py-3">
                        @php $colors=['pending'=>'yellow','active'=>'blue','completed'=>'green','cancelled'=>'red'] @endphp
                        <span class="badge bg-{{ $colors[$e->status] }}-100 text-{{ $colors[$e->status] }}-700">{{ $e->status_label }}</span>
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-500">{{ $e->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="/admin/enrollments/{{ $e->id }}" class="flex items-center gap-1">
                            @csrf @method('PUT')
                            <select name="status" class="text-xs border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                @foreach(['pending'=>'Menunggu','active'=>'Aktif','completed'=>'Selesai','cancelled'=>'Batal'] as $val=>$label)
                                    <option value="{{ $val }}" {{ $e->status==$val?'selected':'' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition">Simpan</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada pendaftaran</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100">{{ $enrollments->links() }}</div>
</div>
@endsection
