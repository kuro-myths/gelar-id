@extends('tataletak.aplikasi')
@section('judul','Pencapaian Saya')
@section('konten')
<div class="max-w-5xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="kartu-komik p-6 mb-8" style="background:linear-gradient(135deg,#7209b7,#4361ee);">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-[#ffd60a] border-3 border-[#1a1a2e] flex items-center justify-center text-4xl" style="border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">
                🏆
            </div>
            <div>
                <h1 class="judul-komik text-4xl text-white">PENCAPAIANKU</h1>
                <p class="font-bold text-purple-200">
                    {{ $pencapaianSaya->where('status','diverifikasi')->count() }} / {{ $semuaPencapaian->count() }} pencapaian diraih
                </p>
            </div>
        </div>
        {{-- Progress bar --}}
        @php
        $total = $semuaPencapaian->count();
        $diraih = $pencapaianSaya->where('status','diverifikasi')->count();
        $persen = $total > 0 ? round($diraih / $total * 100) : 0;
        @endphp
        <div class="mt-4 bg-white/20 rounded-full h-3 border-2 border-white/30">
            <div class="bg-[#ffd60a] h-full rounded-full transition-all duration-700"
                 style="width:{{ $persen }}%"></div>
        </div>
        <p class="text-xs font-black text-white/70 mt-1">{{ $persen }}% selesai</p>
    </div>

    {{-- Group by kategori --}}
    @foreach(['game'=>'🎮 Game & Tantangan','akademik'=>'📚 Akademik','kehadiran'=>'📅 Kehadiran','kuesioner'=>'📋 Kuesioner','sosial'=>'🤝 Sosial','khusus'=>'⭐ Khusus Spesial'] as $kat=>$labelKat)
    @php $kelompok = $semuaPencapaian->where('kategori',$kat); @endphp
    @if($kelompok->isNotEmpty())
    <div class="mb-10">
        <h2 class="judul-komik text-2xl text-[#0f0e17] mb-4">{{ $labelKat }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($kelompok->sortBy('urutan') as $p)
            @php
            $klaimSaya = $pencapaianSaya->get($p->id);
            $sudahRaih = $klaimSaya && $klaimSaya->status === 'diverifikasi';
            $menunggu  = $klaimSaya && $klaimSaya->status === 'menunggu';
            $ditolak   = $klaimSaya && $klaimSaya->status === 'ditolak';
            @endphp
            <div class="kartu-komik overflow-hidden {{ $sudahRaih ? '' : 'opacity-70' }} relative">
                {{-- Strip warna --}}
                <div class="h-2" style="background:{{ $sudahRaih ? $p->warna : '#e5e7eb' }}"></div>

                {{-- Badge status --}}
                @if($sudahRaih)
                <div class="absolute top-3 right-3 w-8 h-8 bg-[#06d6a0] rounded-full border-2 border-[#1a1a2e] flex items-center justify-center text-sm">✓</div>
                @elseif($menunggu)
                <div class="absolute top-3 right-3">
                    <span class="badge-komik bg-[#ffd60a] text-[#1a1a2e] text-xs">⏳</span>
                </div>
                @endif

                <div class="p-5">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl border-2 border-[#1a1a2e] flex-shrink-0"
                             style="background:{{ $sudahRaih ? $p->warna.'33' : '#f0f4ff' }};">
                            {{ $p->ikon }}
                        </div>
                        <div>
                            <h3 class="font-black text-[#0f0e17] text-sm leading-tight">{{ $p->nama }}</h3>
                            @if($p->poin > 0)
                            <span class="text-xs font-black text-[#4361ee]">+{{ $p->poin }} poin</span>
                            @endif
                        </div>
                    </div>

                    <p class="text-xs font-semibold text-gray-500 mb-4 leading-relaxed">{{ $p->deskripsi }}</p>

                    {{-- Status & Aksi --}}
                    @if($sudahRaih)
                    <div class="flex items-center gap-2 text-xs font-black text-[#06d6a0]">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        Diraih {{ $klaimSaya->diraih_pada?->format('d M Y') }}
                    </div>
                    @elseif($menunggu)
                    <div class="flex items-center gap-2 text-xs font-black text-[#F59E0B]">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        Menunggu verifikasi admin
                    </div>
                    @elseif($p->tipe_syarat === 'otomatis')
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-400">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                        Diraih otomatis oleh sistem
                    </div>
                    @else
                    {{-- Form ajukan klaim --}}
                    <form method="POST" action="/pengguna/pencapaian/{{ $p->id }}/ajukan" x-data="{buka:false}">
                        @csrf
                        <button type="button" @click="buka=!buka"
                                class="btn-komik w-full py-2 text-sm rounded-xl {{ $ditolak ? 'bg-[#f72585] text-white' : 'bg-[#4361ee] text-white' }}">
                            {{ $ditolak ? '🔄 Ajukan Ulang' : '📤 Ajukan Klaim' }}
                        </button>
                        <div x-show="buka" x-cloak class="mt-3 space-y-2">
                            <textarea name="catatan_pengguna" rows="2" class="input-komik text-xs resize-none"
                                      placeholder="Keterangan (opsional)..."></textarea>
                            <input type="text" name="bukti"
                                   class="input-komik text-xs"
                                   placeholder="Link bukti (URL screenshot, dll.)">
                            <button type="submit" class="btn-komik w-full py-2 bg-[#06d6a0] text-[#0f0e17] rounded-xl text-xs font-black">
                                Kirim Klaim →
                            </button>
                        </div>
                    </form>
                    @if($ditolak && $klaimSaya->catatan_admin)
                    <p class="text-xs text-[#f72585] font-semibold mt-1">Ditolak: "{{ $klaimSaya->catatan_admin }}"</p>
                    @endif
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach

    {{-- Link ke beasiswa --}}
    <div class="kartu-komik p-6 text-center" style="background:linear-gradient(135deg,#06d6a0,#4361ee);">
        <h3 class="judul-komik text-2xl text-white mb-2">GUNAKAN PENCAPAIAN UNTUK BEASISWA!</h3>
        <p class="text-white/80 font-bold text-sm mb-4">Beberapa pencapaian bisa jadi prasyarat beasiswa gratis.</p>
        <a href="/beasiswa" data-tautan-spa class="btn-komik px-6 py-3 bg-[#ffd60a] text-[#0f0e17] rounded-xl text-sm inline-flex">
            <i data-lucide="award" class="w-4 h-4"></i> Lihat Program Beasiswa
        </a>
    </div>
</div>
@endsection
