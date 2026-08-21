@extends('tataletak.admin')
@section('judul','Verifikasi Klaim Pencapaian')
@section('konten')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 font-bold text-sm">Klaim yang menunggu verifikasi admin</p>
    <a href="/admin/pencapaian" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Daftar Pencapaian
    </a>
</div>

@if($klaim->isEmpty())
<div class="kartu-admin rounded-2xl p-16 text-center">
    <div class="text-5xl mb-4">✅</div>
    <p class="judul-komik text-2xl text-gray-400">Tidak ada klaim yang menunggu</p>
    <p class="text-gray-400 font-semibold mt-2">Semua klaim sudah diproses!</p>
</div>
@else
<div class="space-y-4">
    @foreach($klaim as $k)
    <div class="kartu-admin rounded-2xl overflow-hidden">
        <div class="p-5">
            <div class="flex flex-col md:flex-row md:items-start gap-4">
                {{-- Ikon pencapaian --}}
                <div class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl border-2 border-[#1a1a2e] flex-shrink-0"
                     style="background:{{ $k->pencapaian->warna }}33;">
                    {{ $k->pencapaian->ikon }}
                </div>

                {{-- Info --}}
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <h3 class="font-black text-[#1a1a2e]">{{ $k->pencapaian->nama }}</h3>
                        <span class="badge-komik text-xs" style="background:{{ $k->pencapaian->warna }}33;border-color:{{ $k->pencapaian->warna }}">
                            {{ $k->pencapaian->label_kategori }}
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-3 text-xs font-bold text-gray-500 mb-3">
                        <span class="flex items-center gap-1">
                            <i data-lucide="user" class="w-3 h-3"></i>
                            {{ $k->pengguna->nama }} ({{ $k->pengguna->email }})
                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="clock" class="w-3 h-3"></i>
                            {{ $k->created_at->diffForHumans() }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="star" class="w-3 h-3 text-[#ffd60a]"></i>
                            {{ $k->pencapaian->poin }} poin
                        </span>
                    </div>

                    @if($k->catatan_pengguna)
                    <div class="bg-[#f0f4ff] border-2 border-[#e0e7ff] rounded-xl p-3 mb-3">
                        <p class="text-xs font-black text-[#4361ee] mb-1">💬 Keterangan pengguna:</p>
                        <p class="text-xs text-gray-600 font-semibold">{{ $k->catatan_pengguna }}</p>
                    </div>
                    @endif

                    @if($k->bukti)
                    <div class="bg-[#fef9c3] border-2 border-[#fbbf24] rounded-xl p-3 mb-3">
                        <p class="text-xs font-black text-[#92400e] mb-1">📎 Bukti yang diunggah:</p>
                        <p class="text-xs text-gray-700 font-semibold break-all">{{ $k->bukti }}</p>
                    </div>
                    @endif
                </div>

                {{-- Form verifikasi --}}
                <div class="flex-shrink-0 w-full md:w-64">
                    <form method="POST" action="/admin/pencapaian-klaim/{{ $k->id }}/verifikasi" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-xs font-black text-[#1a1a2e] mb-1">Catatan Admin</label>
                            <textarea name="catatan_admin" rows="2"
                                      class="input-komik text-xs resize-none"
                                      placeholder="Opsional..."></textarea>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" name="status" value="diverifikasi"
                                    class="btn-komik flex-1 py-2 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-xs font-black">
                                ✅ Setujui
                            </button>
                            <button type="submit" name="status" value="ditolak"
                                    class="btn-komik flex-1 py-2 bg-[#f72585] text-white rounded-xl text-xs font-black">
                                ❌ Tolak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-6">{{ $klaim->links() }}</div>
@endif
@endsection
