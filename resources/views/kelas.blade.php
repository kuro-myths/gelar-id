@extends('tataletak.aplikasi')
@section('judul','Kelas Pelajar')
@section('konten')

{{-- Hero --}}
<section class="py-16 relative overflow-hidden" style="background:linear-gradient(135deg,#0f0e17 0%,#1e3a8a 100%);border-bottom:4px solid #4361ee;">
    <div class="absolute inset-0" style="background-image:radial-gradient(#ffffff08 1px,transparent 1px);background-size:20px 20px;"></div>
    <div class="max-w-5xl mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="akan-muncul">
                <div class="inline-flex items-center gap-2 bg-[#ffd60a] text-[#0f0e17] px-4 py-2 rounded-full text-sm font-black mb-5"
                     style="border:2px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    Untuk SD, SMP, SMA & Umum
                </div>
                <h1 class="judul-komik text-6xl text-white mb-3" style="text-shadow:3px 3px 0 #4361ee;">
                    KELAS PELAJAR
                </h1>
                <p class="text-gray-300 font-bold text-lg leading-relaxed mb-6">
                    Belajar ilmu digital sejak dini! Kelas khusus untuk pelajar SD–SMA dengan materi yang
                    menyenangkan, sertifikat resmi, dan pengajar berpengalaman.
                </p>
                <div class="flex items-center gap-2 text-sm font-black text-[#06d6a0]">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    Dapatkan sertifikat setelah menyelesaikan kelas
                </div>
            </div>
            {{-- Statistik tingkat --}}
            <div class="grid grid-cols-2 gap-3 akan-muncul" style="animation-delay:.1s">
                @foreach(['sd'=>['label'=>'Kelas SD','warna'=>'#EF4444','ikon'=>'smile'],'smp'=>['label'=>'Kelas SMP','warna'=>'#F59E0B','ikon'=>'book'],'sma'=>['label'=>'Kelas SMA','warna'=>'#4361ee','ikon'=>'graduation-cap'],'umum'=>['label'=>'Kelas Umum','warna'=>'#06d6a0','ikon'=>'globe']] as $k => $info)
                <div class="kartu-komik p-4 text-center" style="border-color:{{ $info['warna'] }};box-shadow:4px 4px 0 {{ $info['warna'] }};">
                    <div class="w-10 h-10 rounded-xl mx-auto mb-2 flex items-center justify-center"
                         style="background:{{ $info['warna'] }};border:2px solid #0f0e17;">
                        <i data-lucide="{{ $info['ikon'] }}" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="judul-komik text-3xl text-[#0f0e17]">{{ $statistikKelas[$k] }}</div>
                    <div class="text-xs font-black text-gray-500 mt-0.5">{{ $info['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-12">
    {{-- Filter --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-8 akan-muncul">
        <form method="GET" action="/kelas" class="flex gap-2 flex-1">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari kelas..."
                   class="input-komik flex-1 text-sm" style="max-width:280px;">
            @if(request('tingkat'))<input type="hidden" name="tingkat" value="{{ request('tingkat') }}">@endif
            <button type="submit" class="btn-komik px-4 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
                <i data-lucide="search" class="w-4 h-4"></i>
            </button>
        </form>

        <div class="flex flex-wrap gap-2">
            <a href="/kelas" data-tautan-spa
               class="btn-komik px-4 py-2 rounded-xl text-xs {{ !request('tingkat') ? 'bg-[#0f0e17] text-white' : 'bg-gray-100 text-gray-700' }}">
                Semua
            </a>
            @foreach(['sd'=>['label'=>'SD','warna'=>'#EF4444'],'smp'=>['label'=>'SMP','warna'=>'#F59E0B'],'sma'=>['label'=>'SMA','warna'=>'#4361ee'],'umum'=>['label'=>'Umum','warna'=>'#06d6a0']] as $k=>$info)
            <a href="/kelas?tingkat={{ $k }}{{ request('cari') ? '&cari='.request('cari') : '' }}"
               data-tautan-spa
               class="btn-komik px-4 py-2 rounded-xl text-xs text-white"
               style="{{ request('tingkat')===$k ? 'background:'.$info['warna'].';border-color:#0f0e17;' : 'background:'.$info['warna'].'40;color:'.$info['warna'].';border-color:'.$info['warna'].';' }}">
                <i data-lucide="book" class="w-3.5 h-3.5"></i>
                {{ $info['label'] }}
            </a>
            @endforeach
            <a href="/kelas?gratis=1{{ request('tingkat') ? '&tingkat='.request('tingkat') : '' }}"
               data-tautan-spa
               class="btn-komik px-4 py-2 rounded-xl text-xs {{ request('gratis') ? 'bg-[#06d6a0] text-[#0f0e17]' : 'bg-gray-100 text-gray-700' }}">
                <i data-lucide="gift" class="w-3.5 h-3.5"></i>
                Gratis
            </a>
        </div>
    </div>

    {{-- Grid Kelas --}}
    @if($kelasDaftar->isEmpty())
    <div class="kartu-komik p-16 text-center">
        <i data-lucide="book-open" class="w-16 h-16 mx-auto mb-4 text-gray-200"></i>
        <p class="judul-komik text-3xl text-gray-400">Kelas tidak ditemukan</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kelasDaftar as $kelas)
        <div class="kartu-komik overflow-hidden flex flex-col akan-muncul group"
             style="animation-delay:{{ $loop->index * 0.07 }}s">
            <div class="h-2.5" style="background:{{ $kelas->warna }}"></div>
            <div class="p-5 flex flex-col flex-1">
                {{-- Header --}}
                <div class="flex items-start justify-between mb-3">
                    <div class="flex flex-wrap gap-1.5">
                        <span class="badge-komik text-white text-xs" style="background:{{ $kelas->warna_label_tingkat }};border-color:#0f0e17;">
                            {{ $kelas->label_tingkat }}
                        </span>
                        @if($kelas->label_badge)
                        <span class="badge-komik text-white text-xs" style="background:{{ $kelas->warna }};border-color:#0f0e17;">
                            {{ $kelas->label_badge }}
                        </span>
                        @endif
                    </div>
                    @if($kelas->gratis)
                    <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">GRATIS</span>
                    @else
                    <span class="judul-komik text-lg text-[#0f0e17]">Rp {{ number_format($kelas->harga,0,',','.') }}</span>
                    @endif
                </div>

                <h3 class="font-black text-[#0f0e17] text-lg mb-2 leading-snug group-hover:text-[#4361ee] transition-colors">
                    {{ $kelas->nama }}
                </h3>
                <p class="text-sm font-semibold text-gray-500 mb-4 line-clamp-2 flex-1">
                    {{ $kelas->deskripsi }}
                </p>

                {{-- Info --}}
                <div class="flex items-center gap-3 text-xs font-black text-gray-400 mb-4 pb-4 border-t-2 border-gray-100 pt-3">
                    <span class="flex items-center gap-1">
                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>{{ $kelas->durasi_jam }} jam
                    </span>
                    <span class="flex items-center gap-1">
                        <i data-lucide="layers" class="w-3.5 h-3.5"></i>{{ $kelas->jumlah_sesi }} sesi
                    </span>
                    <span class="flex items-center gap-1">
                        <i data-lucide="users" class="w-3.5 h-3.5"></i>{{ $kelas->jumlah_peserta }}
                    </span>
                </div>

                {{-- Pengajar --}}
                @if($kelas->pengajar)
                <div class="flex items-center gap-2 text-xs font-bold text-gray-500 mb-4">
                    <div class="w-6 h-6 rounded-full bg-[#4361ee] flex items-center justify-center text-white font-black text-xs"
                         style="border:1.5px solid #0f0e17;">
                        {{ strtoupper(substr($kelas->pengajar->nama, 0, 1)) }}
                    </div>
                    <span>{{ $kelas->pengajar->nama }}</span>
                </div>
                @endif

                {{-- CTA --}}
                <a href="/kelas/{{ $kelas->slug }}" data-tautan-spa
                   class="btn-komik w-full py-2.5 text-white text-sm rounded-xl text-center"
                   style="background:{{ $kelas->warna }}">
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    Lihat Kelas
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $kelasDaftar->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
