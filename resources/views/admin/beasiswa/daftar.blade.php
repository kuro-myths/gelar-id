@extends('tataletak.admin')
@section('judul','Beasiswa')
@section('konten')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 font-bold text-sm">Kelola program beasiswa dan pendaftarnya</p>
    <a href="/admin/beasiswa/buat" class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">
        <i data-lucide="plus" class="w-4 h-4"></i> Buat Beasiswa
    </a>
</div>

<div class="space-y-4">
    @forelse($beasiswa as $b)
    <div class="kartu-admin rounded-2xl overflow-hidden">
        <div class="flex flex-col md:flex-row">
            {{-- Strip warna status --}}
            <div class="w-full md:w-2 {{ $b->masih_buka ? 'bg-[#06d6a0]' : 'bg-gray-300' }}"></div>
            <div class="flex-1 p-5">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h3 class="font-black text-[#1a1a2e] text-lg">{{ $b->nama }}</h3>
                            @if($b->masih_buka)
                            <span class="badge-komik bg-[#06d6a0] text-[#1a1a2e] text-xs">🟢 Buka</span>
                            @else
                            <span class="badge-komik bg-gray-200 text-gray-500 text-xs">⚫ Tutup</span>
                            @endif
                            <span class="badge-komik text-xs" style="background:#4361ee22;border-color:#4361ee;color:#4361ee;">
                                {{ $b->label_manfaat }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 font-semibold line-clamp-2 mb-3">{{ $b->deskripsi }}</p>
                        <div class="flex flex-wrap gap-4 text-xs font-black text-gray-400">
                            <span class="flex items-center gap-1">
                                <i data-lucide="users" class="w-3 h-3"></i>
                                {{ $b->pendaftar_count }} pendaftar
                            </span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="target" class="w-3 h-3"></i>
                                Kuota: {{ $b->kuota === 0 ? 'Tidak terbatas' : $b->sisa_kuota.'/'.$b->kuota }}
                            </span>
                            @if($b->tutup_pada)
                            <span class="flex items-center gap-1">
                                <i data-lucide="calendar" class="w-3 h-3"></i>
                                Tutup: {{ $b->tutup_pada->format('d M Y') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <a href="/admin/beasiswa/{{ $b->id }}/pendaftar"
                           class="btn-komik px-3 py-2 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-xs">
                            <i data-lucide="list" class="w-3.5 h-3.5"></i>
                            Pendaftar ({{ $b->pendaftar_count }})
                        </a>
                        <a href="/admin/beasiswa/{{ $b->id }}/edit"
                           class="btn-komik px-3 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-xs">
                            <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                        </a>
                        <form method="POST" action="/admin/beasiswa/{{ $b->id }}"
                              onsubmit="return confirm('Hapus beasiswa ini?')">
                            @csrf @method('DELETE')
                            <button class="btn-komik px-3 py-2 bg-[#f72585] text-white rounded-xl text-xs">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="kartu-admin rounded-2xl p-16 text-center">
        <div class="text-5xl mb-4">🎓</div>
        <p class="judul-komik text-2xl text-gray-400">Belum ada beasiswa</p>
        <a href="/admin/beasiswa/buat" class="btn-komik mt-4 inline-flex px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
            + Buat Beasiswa Pertama
        </a>
    </div>
    @endforelse
</div>
<div class="mt-6">{{ $beasiswa->links() }}</div>
@endsection
