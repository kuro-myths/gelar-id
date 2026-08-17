@extends('tataletak.admin')
@section('judul','Manajemen Diskon')
@section('konten')
<div class="flex justify-end mb-5">
    <a href="/admin/diskon/buat" class="btn-komik px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
        <i data-lucide="plus" class="w-4 h-4"></i> Buat Diskon
    </a>
</div>
<div class="kartu-admin overflow-hidden">
    <div class="bg-[#1a1a2e] px-6 py-4 flex items-center gap-2">
        <i data-lucide="tag" class="w-5 h-5 text-[#ffd60a]"></i>
        <h3 class="judul-komik text-xl text-white">SEMUA DISKON</h3>
        <span class="ml-auto badge-komik bg-[#ffd60a] text-[#0f0e17]">{{ $diskon->total() }}</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead style="background:#0f172a;color:white;">
                <tr>@foreach(['KODE','NAMA','TIPE','NILAI','PAKAI','BERLAKU','STATUS','AKSI'] as $h)<th class="text-left px-4 py-3 text-xs font-black uppercase">{{ $h }}</th>@endforeach</tr>
            </thead>
            <tbody>
                @forelse($diskon as $d)
                <tr class="border-b-2 border-gray-50 hover:bg-[#f0f4ff]">
                    <td class="px-4 py-3">
                        <code class="bg-[#ffd60a] px-2 py-1 rounded font-black text-xs text-[#0f0e17]" style="border:2px solid #0f0e17;">{{ $d->kode }}</code>
                    </td>
                    <td class="px-4 py-3 font-black text-[#0f0e17]">{{ Str::limit($d->nama,22) }}</td>
                    <td class="px-4 py-3"><span class="badge-komik bg-[#4361ee] text-white text-xs">{{ $d->label_tipe }}</span></td>
                    <td class="px-4 py-3 font-black">
                        @if($d->tipe==='persen') {{ $d->nilai }}%
                        @elseif($d->tipe==='nominal') Rp {{ number_format($d->nilai,0,',','.') }}
                        @else <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">GRATIS</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-xs font-black text-gray-600">{{ $d->pemakaian_count }}/{{ $d->maks_penggunaan ?: '∞' }}</td>
                    <td class="px-4 py-3 text-xs font-bold text-gray-500">
                        {{ $d->berlaku_mulai?->format('d M Y') ?? 'Kini' }}<br>
                        s/d {{ $d->berlaku_hingga?->format('d M Y') ?? '∞' }}
                    </td>
                    <td class="px-4 py-3">
                        @php $ws=['aktif'=>'bg-[#06d6a0] text-[#0f0e17]','nonaktif'=>'bg-gray-200 text-gray-600','kedaluwarsa'=>'bg-[#f72585] text-white','habis'=>'bg-yellow-200 text-yellow-800','belum_aktif'=>'bg-blue-100 text-blue-800']; @endphp
                        <span class="badge-komik {{ $ws[$d->status] ?? 'bg-gray-100' }} text-xs">{{ $d->label_status }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-1">
                            <a href="/admin/diskon/{{ $d->id }}/edit" class="btn-komik px-2.5 py-1.5 bg-[#ffd60a] text-[#0f0e17] rounded-lg text-xs">
                                <i data-lucide="edit-2" class="w-3 h-3"></i>
                            </a>
                            <form method="POST" action="/admin/diskon/{{ $d->id }}/toggle">@csrf
                                <button class="btn-komik px-2.5 py-1.5 {{ $d->aktif?'bg-gray-100 text-gray-700':'bg-[#06d6a0] text-[#0f0e17]' }} rounded-lg text-xs">
                                    <i data-lucide="{{ $d->aktif?'eye-off':'eye' }}" class="w-3 h-3"></i>
                                </button>
                            </form>
                            <form method="POST" action="/admin/diskon/{{ $d->id }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
                                <button class="btn-komik px-2.5 py-1.5 bg-[#f72585] text-white rounded-lg text-xs">
                                    <i data-lucide="trash-2" class="w-3 h-3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-10 text-gray-400 font-black">
                    <i data-lucide="tag" class="w-12 h-12 mx-auto mb-3 text-gray-200 block"></i>
                    Belum ada diskon
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t-2 border-gray-100">{{ $diskon->links() }}</div>
</div>
@endsection
