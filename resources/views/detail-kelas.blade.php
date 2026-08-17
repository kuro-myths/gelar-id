@extends('tataletak.aplikasi')
@section('judul', $kelas->nama)
@section('konten')

<section class="py-12 relative" style="background:{{ $kelas->warna }}12;border-bottom:4px solid #0f0e17;">
    <div class="max-w-5xl mx-auto px-4">
        <a href="/kelas" data-tautan-spa class="inline-flex items-center gap-2 text-sm font-black text-gray-500 hover:text-[#4361ee] mb-6 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Semua Kelas
        </a>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 akan-muncul">
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="badge-komik text-white text-sm" style="background:{{ $kelas->warna_label_tingkat }};border-color:#0f0e17;">{{ $kelas->label_tingkat }}</span>
                    @if($kelas->label_badge)<span class="badge-komik text-white text-sm" style="background:{{ $kelas->warna }};border-color:#0f0e17;">{{ $kelas->label_badge }}</span>@endif
                </div>
                <h1 class="judul-komik text-5xl text-[#0f0e17] mb-3">{{ $kelas->nama }}</h1>
                <p class="text-gray-700 font-bold text-lg leading-relaxed mb-6">{{ $kelas->deskripsi }}</p>
                <div class="flex flex-wrap gap-4 text-sm font-black text-gray-500">
                    <span class="flex items-center gap-1.5"><i data-lucide="clock" class="w-4 h-4 text-[#4361ee]"></i>{{ $kelas->durasi_jam }} jam total</span>
                    <span class="flex items-center gap-1.5"><i data-lucide="layers" class="w-4 h-4 text-[#4361ee]"></i>{{ $kelas->jumlah_sesi }} sesi</span>
                    <span class="flex items-center gap-1.5"><i data-lucide="users" class="w-4 h-4 text-[#4361ee]"></i>{{ $kelas->jumlah_peserta }} peserta</span>
                    <span class="flex items-center gap-1.5"><i data-lucide="award" class="w-4 h-4 text-[#ffd60a]"></i>Sertifikat termasuk</span>
                </div>
            </div>
            {{-- Kartu harga --}}
            <div class="kartu-komik p-6 text-center akan-muncul" style="animation-delay:.1s;border-color:{{ $kelas->warna }};box-shadow:6px 6px 0 {{ $kelas->warna }};">
                <div class="h-1.5 -mt-6 -mx-6 mb-5" style="background:{{ $kelas->warna }}"></div>
                @if($kelas->gratis)
                <div class="judul-komik text-5xl text-[#06d6a0] mb-1">GRATIS</div>
                <p class="text-sm font-bold text-gray-500 mb-4">Tersedia jalur gratis</p>
                @else
                <div class="judul-komik text-4xl text-[#0f0e17] mb-1">Rp {{ number_format($kelas->harga,0,',','.') }}</div>
                <p class="text-sm font-bold text-gray-500 mb-4">sekali bayar, akses selamanya</p>
                @endif
                @auth
                <button class="btn-komik w-full py-3 text-white text-base rounded-xl mb-3"
                        style="background:{{ $kelas->warna }}">
                    <i data-lucide="zap" class="w-5 h-5"></i> Daftar Kelas
                </button>
                @else
                <a href="/daftar" data-tautan-spa class="btn-komik w-full py-3 bg-[#4361ee] text-white text-base rounded-xl mb-3 block text-center">
                    <i data-lucide="user-plus" class="w-5 h-5"></i> Daftar & Mulai
                </a>
                @endauth
                @if($kelas->pengajar)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-[#f0f4ff] text-left" style="border:2px solid #4361ee33;">
                    <div class="w-10 h-10 rounded-xl bg-[#4361ee] flex items-center justify-center text-white font-black" style="border:2px solid #0f0e17;">{{ strtoupper(substr($kelas->pengajar->nama,0,1)) }}</div>
                    <div>
                        <p class="font-black text-[#0f0e17] text-sm">{{ $kelas->pengajar->nama }}</p>
                        <p class="text-xs font-bold text-gray-400">{{ $kelas->pengajar->institusi }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<div class="max-w-5xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            {{-- Yang akan dipelajari --}}
            @if($kelas->yang_dipelajari)
            <div class="kartu-komik p-6 akan-muncul">
                <h3 class="judul-komik text-2xl text-[#0f0e17] mb-4 flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-6 h-6 text-[#06d6a0]"></i>
                    YANG AKAN KAMU PELAJARI
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($kelas->yang_dipelajari as $item)
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-[#f0f4ff]" style="border:2px solid #4361ee40;">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"
                             style="background:{{ $kelas->warna }};border:2px solid #0f0e17;">
                            <i data-lucide="check" class="w-3 h-3 text-white"></i>
                        </div>
                        <p class="font-bold text-[#0f0e17] text-sm">{{ $item }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Kurikulum --}}
            @if($kelas->kurikulum)
            <div class="kartu-komik p-6 akan-muncul">
                <h3 class="judul-komik text-2xl text-[#0f0e17] mb-4 flex items-center gap-2">
                    <i data-lucide="layers" class="w-6 h-6 text-[#4361ee]"></i>
                    KURIKULUM KELAS
                </h3>
                <div class="space-y-2">
                    @foreach($kelas->kurikulum as $i => $topik)
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-[#f8f9ff]" style="border:2px solid #e5e7f0;">
                        <span class="w-7 h-7 rounded-lg flex items-center justify-center text-white font-black text-xs flex-shrink-0"
                              style="background:{{ $kelas->warna }};border:2px solid #0f0e17;">{{ $i+1 }}</span>
                        <span class="font-bold text-[#0f0e17] text-sm">{{ $topik }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-5">
            {{-- Info pengajar --}}
            @if($kelas->pengajar)
            <div class="kartu-komik p-5 akan-muncul">
                <h4 class="judul-komik text-xl text-[#0f0e17] mb-4 flex items-center gap-2">
                    <i data-lucide="user-check" class="w-5 h-5 text-[#4361ee]"></i>
                    PENGAJAR
                </h4>
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-[#4361ee] flex items-center justify-center text-white font-black text-xl judul-komik flex-shrink-0" style="border:3px solid #0f0e17;box-shadow:3px 3px 0 #0f0e17;">
                        {{ strtoupper(substr($kelas->pengajar->nama,0,1)) }}
                    </div>
                    <div>
                        <p class="font-black text-[#0f0e17]">{{ $kelas->pengajar->nama }}</p>
                        <p class="text-xs font-bold text-[#4361ee]">{{ $kelas->pengajar->keahlian }}</p>
                        @if($kelas->pengajar->bio)
                        <p class="text-xs font-semibold text-gray-500 mt-1 line-clamp-3">{{ $kelas->pengajar->bio }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Sertifikat info --}}
            <div class="kartu-komik p-5 bg-[#ffd60a] akan-muncul">
                <i data-lucide="award" class="w-8 h-8 text-[#0f0e17] mb-2"></i>
                <h4 class="judul-komik text-xl text-[#0f0e17] mb-2">DAPAT SERTIFIKAT!</h4>
                <p class="text-sm font-bold text-[#0f0e17] opacity-80">
                    Selesaikan semua sesi dan dapatkan sertifikat resmi yang bisa diverifikasi online!
                </p>
            </div>

            <a href="/pengajar" data-tautan-spa class="btn-komik w-full py-3 bg-gray-100 text-[#0f0e17] rounded-xl text-sm text-center block">
                <i data-lucide="users" class="w-4 h-4"></i> Lihat Semua Pengajar
            </a>
        </div>
    </div>
</div>
@endsection
