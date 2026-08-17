@extends('tataletak.admin')
@section('judul','Manajemen Pengguna')
@section('konten')
<div class="kartu-admin overflow-hidden">
    <div class="px-6 py-4 bg-[#1a1a2e] flex items-center justify-between">
        <h3 class="judul-komik text-xl text-white">👥 SEMUA PENGGUNA</h3>
        <span class="badge-komik bg-[#ffd60a] text-[#1a1a2e]">{{ $pengguna->total() }} pengguna</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['NAMA','NIM','PERAN','STATUS','BERGABUNG','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @foreach($pengguna as $u)
                <tr class="border-b-2 border-gray-100 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#4361ee] flex items-center justify-center text-white font-black text-sm" style="border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">
                                {{ strtoupper(substr($u->nama,0,1)) }}
                            </div>
                            <div>
                                <div class="font-black text-[#1a1a2e]">{{ $u->nama }}</div>
                                <div class="text-xs font-bold text-gray-400">{{ $u->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 font-mono text-xs font-bold text-gray-600">{{ $u->nim ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <span class="badge-komik {{ $u->isAdmin() ? 'bg-[#7209b7] text-white' : 'bg-[#4361ee] text-white' }}">
                            {{ $u->isAdmin() ? '👑 Admin' : '👤 User' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge-komik {{ $u->aktif ? 'bg-[#06d6a0] text-[#1a1a2e]' : 'bg-[#f72585] text-white' }}">
                            {{ $u->aktif ? '✅ Aktif' : '❌ Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-500">{{ $u->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="/admin/pengguna/{{ $u->id }}/edit" class="btn-komik px-3 py-1.5 bg-[#ffd60a] text-[#1a1a2e] rounded-lg text-xs">✏️ Edit</a>
                        @if($u->id !== auth()->id())
                        <form method="POST" action="/admin/pengguna/{{ $u->id }}" onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-komik px-3 py-1.5 bg-[#f72585] text-white rounded-lg text-xs">🗑️</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $pengguna->links() }}</div>
</div>
@endsection
