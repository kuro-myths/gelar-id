@extends('tataletak.aplikasi')
@section('judul','Statistik Real-Time')
@section('konten')

<div class="max-w-6xl mx-auto px-4 py-12">
    {{-- Header --}}
    <div class="text-center mb-12 akan-muncul">
        <div class="inline-flex items-center gap-2 bg-[#4361ee] text-white px-5 py-2 rounded-full text-sm font-black mb-4"
             style="border:2px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
            <span class="w-2 h-2 bg-[#06d6a0] rounded-full animate-pulse"></span>
            Data Real-Time
        </div>
        <h1 class="judul-komik text-6xl text-[#0f0e17] mb-3">STATISTIK GELAR.ID</h1>
        <p class="text-gray-500 font-bold">Data diperbarui secara langsung — transparansi adalah prioritas kami</p>
        <p class="text-xs font-bold text-gray-400 mt-2">
            <i data-lucide="clock" class="w-3.5 h-3.5 inline mr-1"></i>
            Terakhir diperbarui: {{ now()->translatedFormat('d F Y, H:i') }} WIB
        </p>
    </div>

    {{-- Kartu Utama --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mb-12">
        @php
        $kartuUtama = [
            ['ikon'=>'users',         'label'=>'Total Pelajar',      'nilai'=>$data['total_pengguna'],    'warna'=>'#4361ee', 'sub'=>$data['pengguna_aktif'].' aktif'],
            ['ikon'=>'book-open',     'label'=>'Program Studi',      'nilai'=>$data['total_program'],     'warna'=>'#7209b7', 'sub'=>'gelar & vokasi'],
            ['ikon'=>'award',         'label'=>'Sertifikat Terbit',  'nilai'=>$data['total_sertifikat'],  'warna'=>'#ffd60a', 'sub'=>'terverifikasi online'],
            ['ikon'=>'graduation-cap','label'=>'Jenis Gelar',        'nilai'=>$data['total_gelar'],       'warna'=>'#06d6a0', 'sub'=>'K1 s/d KVT.Kom'],
            ['ikon'=>'user-check',    'label'=>'Pengajar Aktif',     'nilai'=>$data['total_pengajar'],    'warna'=>'#f72585', 'sub'=>'praktisi industri'],
            ['ikon'=>'layout-grid',   'label'=>'Kelas Pelajar',      'nilai'=>$data['total_kelas'],       'warna'=>'#EF4444', 'sub'=>'SD, SMP, SMA, Umum'],
            ['ikon'=>'user-graduate', 'label'=>'Pendaftaran Aktif',  'nilai'=>$data['pendaftaran_aktif'], 'warna'=>'#06B6D4', 'sub'=>'sedang berjalan'],
            ['ikon'=>'check-circle',  'label'=>'Lulus & Sertifikat', 'nilai'=>$data['pendaftaran_selesai'],'warna'=>'#84CC16','sub'=>'program selesai'],
        ];
        @endphp
        @foreach($kartuUtama as $i => $k)
        <div class="kartu-komik p-5 text-center akan-muncul" style="animation-delay:{{ $i*0.07 }}s;border-color:{{ $k['warna'] }};box-shadow:5px 5px 0 {{ $k['warna'] }};">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3"
                 style="background:{{ $k['warna'] }}22;border:2px solid {{ $k['warna'] }};">
                <i data-lucide="{{ $k['ikon'] }}" class="w-5 h-5" style="color:{{ $k['warna'] }}"></i>
            </div>
            <div class="judul-komik text-4xl text-[#0f0e17]" data-hitung="{{ $k['nilai'] }}">0</div>
            <div class="text-xs font-black text-gray-700 mt-1">{{ $k['label'] }}</div>
            <div class="text-xs font-bold text-gray-400 mt-0.5">{{ $k['sub'] }}</div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Distribusi Gelar --}}
        <div class="kartu-komik p-6 akan-muncul">
            <h3 class="judul-komik text-2xl text-[#0f0e17] mb-5 flex items-center gap-2">
                <i data-lucide="pie-chart" class="w-5 h-5 text-[#4361ee]"></i>
                DISTRIBUSI GELAR
            </h3>
            @php
            $totalGelar = $data['gelar_per_kategori']->sum('jumlah');
            $warnaKat   = ['sarjana'=>'#4361ee','diploma'=>'#f72585','vokasi'=>'#ffd60a'];
            $labelKat   = ['sarjana'=>'Sarjana Virtual','diploma'=>'Diploma','vokasi'=>'Vokasi'];
            @endphp
            <div class="space-y-4">
                @foreach($data['gelar_per_kategori'] as $kat)
                @php $persen = $totalGelar > 0 ? round(($kat->jumlah/$totalGelar)*100) : 0; @endphp
                <div>
                    <div class="flex justify-between text-sm font-black mb-1.5">
                        <span class="text-[#0f0e17]">{{ $labelKat[$kat->kategori] ?? $kat->kategori }}</span>
                        <span style="color:{{ $warnaKat[$kat->kategori] ?? '#4361ee' }}">{{ $kat->jumlah }} ({{ $persen }}%)</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden" style="border:2px solid #0f0e17;">
                        <div class="h-4 rounded-full" style="width:{{ $persen }}%;background:{{ $warnaKat[$kat->kategori] ?? '#4361ee' }};transition:width 1.5s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Program Terpopuler --}}
        <div class="kartu-komik p-6 akan-muncul" style="animation-delay:.1s">
            <h3 class="judul-komik text-2xl text-[#0f0e17] mb-5 flex items-center gap-2">
                <i data-lucide="trending-up" class="w-5 h-5 text-[#f72585]"></i>
                PROGRAM TERPOPULER
            </h3>
            <div class="space-y-3">
                @foreach($data['program_populer'] as $i => $prog)
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl flex items-center justify-center text-white font-black text-xs flex-shrink-0 judul-komik text-base"
                         style="background:{{ $prog->jenisGelar->warna }};border:2px solid #0f0e17;">{{ $i+1 }}</div>
                    <div class="flex-1 min-w-0">
                        <p class="font-black text-[#0f0e17] text-sm truncate">{{ $prog->nama }}</p>
                        <div class="w-full bg-gray-100 rounded-full h-2 mt-1" style="border:1px solid #e5e7eb;">
                            @php
                            $maks = $data['program_populer']->max('pendaftaran_count') ?: 1;
                            $p = round(($prog->pendaftaran_count / $maks) * 100);
                            @endphp
                            <div class="h-2 rounded-full" style="width:{{ $p }}%;background:{{ $prog->jenisGelar->warna }};"></div>
                        </div>
                    </div>
                    <span class="judul-komik text-lg text-[#0f0e17] shrink-0">{{ $prog->pendaftaran_count }}</span>
                </div>
                @endforeach
                @if($data['program_populer']->isEmpty())
                <p class="text-gray-400 font-black text-center py-4">Belum ada data</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Link ke halaman lain --}}
    <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-4 akan-muncul">
        @foreach([
            ['/gelar','Jenis Gelar','graduation-cap','#4361ee'],
            ['/program','Program Studi','book-open','#7209b7'],
            ['/pengajar','Para Pengajar','users','#f72585'],
            ['/kelas','Kelas Pelajar','layout-grid','#06d6a0'],
        ] as $link)
        <a href="{{ $link[0] }}" data-tautan-spa
           class="kartu-komik p-5 text-center group">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform"
                 style="background:{{ $link[3] }}22;border:2px solid {{ $link[3] }};">
                <i data-lucide="{{ $link[2] }}" class="w-5 h-5" style="color:{{ $link[3] }}"></i>
            </div>
            <p class="font-black text-[#0f0e17] text-sm">{{ $link[1] }}</p>
        </a>
        @endforeach
    </div>
</div>
@endsection
