@extends('tataletak.admin')
@section('judul','Pencapaian')
@section('konten')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-gray-500 font-bold text-sm">Kelola badge pencapaian & achievement pengguna</p>
    </div>
    <div class="flex gap-2">
        <a href="/admin/pencapaian-klaim" class="btn-komik px-4 py-2 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-sm">
            <i data-lucide="bell" class="w-4 h-4"></i> Klaim Masuk
            @php $jumlahKlaim = \App\Models\PencapaianPengguna::where('status','menunggu')->count(); @endphp
            @if($jumlahKlaim > 0)
            <span class="bg-[#f72585] text-white text-xs font-black px-2 py-0.5 rounded-full ml-1">{{ $jumlahKlaim }}</span>
            @endif
        </a>
        <a href="/admin/pencapaian/buat" class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">
            <i data-lucide="plus" class="w-4 h-4"></i> Buat Pencapaian
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($pencapaian as $p)
    <div class="kartu-admin rounded-2xl overflow-hidden">
        <div class="h-2" style="background:{{ $p->warna }}"></div>
        <div class="p-5">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl border-2 border-[#1a1a2e]"
                         style="background:{{ $p->warna }}33;">
                        {{ $p->ikon }}
                    </div>
                    <div>
                        <h3 class="font-black text-[#1a1a2e] text-sm leading-tight">{{ $p->nama }}</h3>
                        <span class="text-xs font-bold text-gray-500">{{ $p->label_kategori }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    @if($p->aktif)
                    <span class="badge-komik bg-[#06d6a0] text-[#1a1a2e] text-xs">Aktif</span>
                    @else
                    <span class="badge-komik bg-gray-200 text-gray-500 text-xs">Nonaktif</span>
                    @endif
                </div>
            </div>

            <p class="text-xs text-gray-500 font-semibold mb-4 line-clamp-2">{{ $p->deskripsi }}</p>

            <div class="flex items-center justify-between text-xs font-black text-gray-400 mb-4">
                <span class="flex items-center gap-1">
                    <i data-lucide="users" class="w-3 h-3"></i>
                    {{ $p->pengguna_yang_raih_count }} diraih
                </span>
                <span class="flex items-center gap-1">
                    <i data-lucide="star" class="w-3 h-3 text-[#ffd60a]"></i>
                    {{ $p->poin }} poin
                </span>
                <span>{{ $p->label_tipe_syarat }}</span>
            </div>

            @if($p->adalah_prasyarat_beasiswa)
            <div class="text-xs font-black text-[#7209b7] mb-3 flex items-center gap-1">
                <i data-lucide="shield-check" class="w-3 h-3"></i> Prasyarat Beasiswa
            </div>
            @endif

            <div class="flex gap-2 pt-3 border-t border-gray-100">
                <a href="/admin/pencapaian/{{ $p->id }}/edit"
                   class="btn-komik flex-1 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-xs text-center">
                    <i data-lucide="edit" class="w-3 h-3"></i> Edit
                </a>
                <form method="POST" action="/admin/pencapaian/{{ $p->id }}"
                      onsubmit="return confirm('Hapus pencapaian ini?')">
                    @csrf @method('DELETE')
                    <button class="btn-komik px-3 py-2 bg-[#f72585] text-white rounded-xl text-xs">
                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 kartu-admin p-16 text-center rounded-2xl">
        <div class="text-5xl mb-4">🏆</div>
        <p class="judul-komik text-2xl text-gray-400">Belum ada pencapaian</p>
        <a href="/admin/pencapaian/buat" class="btn-komik mt-4 inline-flex px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
            + Buat Pencapaian Pertama
        </a>
    </div>
    @endforelse
</div>
@endsection
