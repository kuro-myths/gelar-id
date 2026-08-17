@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- HERO --}}
<section class="gradient-bg text-white py-20 md:py-28 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-300 rounded-full filter blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 text-sm font-medium mb-6">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                Platform Kampus Virtual Indonesia
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                Raih Gelar<br>
                <span class="text-cyan-300">Kampus Virtual</span><br>
                Impianmu
            </h1>
            <p class="text-lg text-blue-100 mb-8 max-w-xl leading-relaxed">
                Dapatkan gelar akademik resmi dari kampus virtual — KVT.Kom, VT.Kom, VTA.Kom, V.Com, hingga K1–K6.
                Belajar fleksibel, sertifikat terverifikasi.
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="/programs" class="px-7 py-3.5 bg-white text-blue-700 font-bold rounded-xl hover:bg-blue-50 transition-colors text-center">
                    <i class="fas fa-rocket mr-2"></i>Mulai Sekarang
                </a>
                <a href="/degrees" class="px-7 py-3.5 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold rounded-xl hover:bg-white/20 transition-colors text-center">
                    <i class="fas fa-graduation-cap mr-2"></i>Lihat Gelar
                </a>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16">
            @php
                $statItems = [
                    ['value' => number_format($stats['users']), 'label' => 'Mahasiswa Aktif', 'icon' => 'fa-users'],
                    ['value' => $stats['programs'], 'label' => 'Program Studi', 'icon' => 'fa-book-open'],
                    ['value' => $stats['certificates'], 'label' => 'Sertifikat Diterbitkan', 'icon' => 'fa-certificate'],
                    ['value' => $stats['degrees'], 'label' => 'Jenis Gelar', 'icon' => 'fa-graduation-cap'],
                ];
            @endphp
            @foreach($statItems as $s)
            <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 text-center">
                <i class="fas {{ $s['icon'] }} text-2xl text-cyan-300 mb-2"></i>
                <div class="text-3xl font-extrabold">{{ $s['value'] }}</div>
                <div class="text-sm text-blue-200 mt-1">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- DEGREE TYPES --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-3">Jenis Gelar Kampus Virtual</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Pilih jalur gelar yang sesuai dengan tujuan dan karier Anda</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($degreeTypes as $degree)
            <a href="/degrees" class="card-hover bg-white border border-gray-100 rounded-2xl p-6 shadow-sm group">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 text-white font-bold text-sm"
                     style="background-color: {{ $degree->color }}">
                    {{ $degree->code }}
                </div>
                <h3 class="font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">{{ $degree->code }}</h3>
                <p class="text-sm text-gray-500 mb-3">{{ $degree->name }}</p>
                <div class="flex items-center justify-between text-xs text-gray-400">
                    <span><i class="fas fa-clock mr-1"></i>{{ $degree->duration_months }} bulan</span>
                    <span class="badge" style="background-color: {{ $degree->color }}20; color: {{ $degree->color }}">
                        {{ ucfirst($degree->category) }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- FEATURED PROGRAMS --}}
@if($featuredPrograms->count())
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900">Program Unggulan</h2>
                <p class="text-gray-500 mt-1">Program paling diminati mahasiswa kampus virtual</p>
            </div>
            <a href="/programs" class="hidden md:inline-flex items-center gap-2 text-blue-600 font-semibold hover:underline">
                Lihat semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredPrograms as $program)
            <div class="card-hover bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="h-3" style="background-color: {{ $program->degreeType->color }}"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <span class="badge text-xs"
                              style="background-color: {{ $program->degreeType->color }}20; color: {{ $program->degreeType->color }}">
                            {{ $program->degreeType->code }}
                        </span>
                        @if($program->is_free)
                            <span class="badge bg-green-100 text-green-700">GRATIS</span>
                        @else
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($program->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 leading-snug">{{ $program->name }}</h3>
                    <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $program->description }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">
                            <i class="fas fa-users mr-1"></i>{{ $program->participant_count }} peserta
                        </span>
                        <a href="/programs/{{ $program->slug }}"
                           class="px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition-colors">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- HOW IT WORKS --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-3">Cara Mendapatkan Gelar</h2>
            <p class="text-gray-500">Proses mudah dan transparan dalam 4 langkah</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @php
                $steps = [
                    ['no'=>'1','icon'=>'fa-user-plus','title'=>'Buat Akun','desc'=>'Daftar gratis dan lengkapi profil Anda'],
                    ['no'=>'2','icon'=>'fa-search','title'=>'Pilih Program','desc'=>'Temukan program yang sesuai dengan tujuan Anda'],
                    ['no'=>'3','icon'=>'fa-laptop','title'=>'Ikuti Studi','desc'=>'Selesaikan kurikulum dan semua persyaratan'],
                    ['no'=>'4','icon'=>'fa-certificate','title'=>'Raih Gelar','desc'=>'Terima sertifikat gelar yang dapat diverifikasi'],
                ];
            @endphp
            @foreach($steps as $i => $step)
            <div class="text-center relative">
                @if($i < 3)
                    <div class="hidden md:block absolute top-6 left-[60%] w-[80%] h-0.5 bg-blue-100"></div>
                @endif
                <div class="w-12 h-12 rounded-full gradient-bg flex items-center justify-center text-white mx-auto mb-4 relative z-10">
                    <i class="fas {{ $step['icon'] }}"></i>
                </div>
                <h4 class="font-bold text-gray-900 mb-1">{{ $step['title'] }}</h4>
                <p class="text-sm text-gray-500">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="gradient-bg text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-extrabold mb-4">Siap Raih Gelarmu?</h2>
        <p class="text-blue-100 mb-8 text-lg">Bergabung dengan ribuan mahasiswa virtual Indonesia</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="/register" class="px-8 py-4 bg-white text-blue-700 font-bold rounded-xl hover:bg-blue-50 transition-colors">
                <i class="fas fa-rocket mr-2"></i>Daftar Sekarang — Gratis
            </a>
            <a href="/verify" class="px-8 py-4 border border-white/40 text-white font-semibold rounded-xl hover:bg-white/10 transition-colors">
                <i class="fas fa-shield-alt mr-2"></i>Verifikasi Sertifikat
            </a>
        </div>
    </div>
</section>

@endsection
