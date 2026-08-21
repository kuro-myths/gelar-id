@extends('tataletak.aplikasi')
@section('judul','Program Beasiswa')
@section('konten')

<section class="py-12 relative overflow-hidden" style="background:linear-gradient(135deg,#0f0e17,#1e3a8a);border-bottom:4px solid #4361ee;">
    <div class="absolute inset-0" style="background-image:radial-gradient(#ffffff08 1px,transparent 1px);background-size:20px 20px;"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <div class="text-5xl mb-4">🎓</div>
        <h1 class="judul-komik text-6xl text-white mb-3" style="text-shadow:3px 3px 0 #4361ee;">PROGRAM BEASISWA</h1>
        <p class="text-gray-300 font-bold text-lg">Raih pendidikan terbaik dengan bantuan beasiswa GELAR.ID</p>
        @auth
        <a href="/pengguna/pencapaian-ku" data-tautan-spa
           class="btn-komik mt-4 inline-flex px-5 py-2.5 bg-[#ffd60a] text-[#0f0e17] rounded-xl text-sm">
            <i data-lucide="trophy" class="w-4 h-4"></i> Lihat Pencapaianku
        </a>
        @endauth
    </div>
</section>

<div class="max-w-5xl mx-auto px-4 py-12">

    @if($beasiswa->isEmpty())
    <div class="kartu-komik p-16 text-center">
        <div class="text-6xl mb-4">📭</div>
        <p class="judul-komik text-3xl text-gray-400 mb-2">Belum ada beasiswa aktif</p>
        <p class="text-gray-400 font-semibold">Pantau terus halaman ini untuk info beasiswa terbaru!</p>
    </div>
    @else
    <div class="space-y-6">
        @foreach($beasiswa as $b)
        @php $statusSaya = $pendaftaranSaya[$b->id] ?? null; @endphp
        <div class="kartu-komik overflow-hidden">
            <div class="flex flex-col md:flex-row">
                {{-- Strip status --}}
                <div class="w-full md:w-2 {{ $b->masih_buka ? 'bg-[#06d6a0]' : 'bg-gray-300' }}"></div>
                <div class="flex-1 p-6">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="flex-1">
                            {{-- Badge status --}}
                            <div class="flex flex-wrap gap-2 mb-2">
                                @if($b->masih_buka)
                                <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-xs">🟢 Pendaftaran Dibuka</span>
                                @else
                                <span class="badge-komik bg-gray-200 text-gray-500 text-xs">⚫ Ditutup</span>
                                @endif
                                <span class="badge-komik text-xs" style="background:#4361ee22;border-color:#4361ee;color:#4361ee;">
                                    {{ $b->label_manfaat }}
                                </span>
                                @if($statusSaya)
                                <span class="badge-komik text-xs"
                                      style="background:#06d6a022;border-color:#06d6a0;color:#06d6a0;">
                                    ✓ Sudah Mendaftar: {{ ucfirst($statusSaya) }}
                                </span>
                                @endif
                            </div>

                            <h2 class="judul-komik text-2xl text-[#0f0e17] mb-2">{{ $b->nama }}</h2>
                            <p class="text-sm font-semibold text-gray-600 leading-relaxed mb-4">{{ $b->deskripsi }}</p>

                            {{-- Info --}}
                            <div class="flex flex-wrap gap-4 text-xs font-black text-gray-400">
                                @if($b->kuota > 0)
                                <span class="flex items-center gap-1">
                                    <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                    Sisa kuota: {{ $b->sisa_kuota }}
                                </span>
                                @else
                                <span class="flex items-center gap-1">
                                    <i data-lucide="infinity" class="w-3.5 h-3.5"></i>
                                    Kuota tidak terbatas
                                </span>
                                @endif
                                @if($b->tutup_pada)
                                <span class="flex items-center gap-1">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                    Tutup: {{ $b->tutup_pada->format('d M Y') }}
                                </span>
                                @endif
                            </div>

                            {{-- Prasyarat pencapaian --}}
                            @if(!empty($b->pencapaian_wajib))
                            <div class="mt-3 flex flex-wrap gap-1.5 items-center">
                                <span class="text-xs font-black text-gray-400">Prasyarat:</span>
                                @foreach($b->pencapaianWajib() as $pw)
                                @php $punya = in_array($pw->id, $pencapaianDiraih); @endphp
                                <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-1 rounded-lg border-2"
                                      style="{{ $punya ? 'border-color:#06d6a0;color:#06d6a0;background:#06d6a011;' : 'border-color:#f72585;color:#f72585;background:#f7258511;' }}">
                                    {{ $pw->ikon }} {{ $pw->nama }}
                                    @if($punya) ✓ @endif
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        {{-- CTA --}}
                        <div class="flex-shrink-0">
                            @if($statusSaya)
                            <div class="text-center">
                                <span class="badge-komik bg-[#06d6a0] text-[#0f0e17] text-sm px-4 py-2">✅ Terdaftar</span>
                                <p class="text-xs font-semibold text-gray-400 mt-2">{{ ucfirst($statusSaya) }}</p>
                            </div>
                            @elseif(!$b->masih_buka)
                            <span class="badge-komik bg-gray-200 text-gray-500 text-sm">Ditutup</span>
                            @else
                            @auth
                            <a href="/beasiswa/{{ $b->slug }}" data-tautan-spa
                               class="btn-komik px-6 py-3 bg-[#4361ee] text-white rounded-xl text-sm">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                Daftar Sekarang
                            </a>
                            @else
                            <a href="/masuk" data-tautan-spa
                               class="btn-komik px-6 py-3 bg-[#4361ee] text-white rounded-xl text-sm">
                                <i data-lucide="log-in" class="w-4 h-4"></i>
                                Masuk untuk Daftar
                            </a>
                            @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
