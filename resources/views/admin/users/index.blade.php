@extends('layouts.admin')
@section('title', 'Manajemen Pengguna')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-bold text-gray-900">Semua Pengguna</h3>
        <span class="badge bg-blue-100 text-blue-700">{{ $users->total() }} pengguna</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Nama</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">NIM</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Role</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Status</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Bergabung</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full gradient-bg flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-xs font-mono text-gray-600">{{ $user->nim ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <span class="badge {{ $user->isAdmin() ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ $user->isAdmin() ? 'Admin' : 'User' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 flex items-center gap-2">
                        <a href="/admin/users/{{ $user->id }}/edit" class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs rounded-lg hover:bg-gray-200 transition">Edit</a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="/admin/users/{{ $user->id }}" onsubmit="return confirm('Hapus user ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 text-xs rounded-lg hover:bg-red-100 transition">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100">{{ $users->links() }}</div>
</div>
@endsection
