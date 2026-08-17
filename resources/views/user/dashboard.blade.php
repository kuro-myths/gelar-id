@extends('layouts.app')
@section('title', 'Dashboard Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900">Selamat datang, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-gray-500 mt-1">NIM Virtual: <span class="font-mono font-semibold text-blue-600">{{ auth()->user()->nim ?? '-' }}</span></p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @php
            $cards = [
                ['label'=>'Total Pendaftaran','value'=>$stats['total_enrollments'],'icon'=>'fa-book-open','color'=>'blue'],
                ['label'=>'Sedang Aktif','value'=>$stats['active'],'icon'=>'fa-play-circle','color'=>'indigo'],
                ['label'=>'Selesai','value'=>$stats['completed'],'icon'=>'fa-check-circle','color'=>'green'],
                ['label'=>'Sertifikat','value'=>$stats['certificates'],'icon'=>'fa-certificate','color'=>'yellow'],
            ];
        @endphp
        @foreach($cards as $c)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-{{ $c['color'] }}-50 flex items-center justify-center">
                    <i class="fas {{ $c['icon'] }} text-{{ $c['color'] }}-600"></i>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-gray-900">{{ $c['value'] }}</p>
                    <p class="text-xs text-gray-500">{{ $c['label'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Recent Enrollments --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-bold text-gray-900">Pendaftaran Terakhir</h3>
                <a href="/user/enrollments" class="text-sm text-blue-600 hover:underline">Lihat semua</a>
            </div>
            @if($enrollments->isEmpty())
                <div class="text-center py-10 text-gray-400">
                    <i class="fas fa-book-open text-4xl mb-3"></i>
                    <p class="text-sm">Belum ada pendaftaran.</p>
                    <a href="/programs" class="mt-3 inline-block px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg">Jelajahi Program</a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($enrollments as $enroll)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                             style="background-color: {{ $enroll->program->degreeType->color }}">
                            {{ $enroll->program->degreeType->code }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 text-sm truncate">{{ $enroll->program->name }}</p>
                            <p class="text-xs text-gray-500">{{ $enroll->enrollment_number }}</p>
                        </div>
                        <span class="badge bg-{{ $enroll->status_color }}-100 text-{{ $enroll->status_color }}-700 text-xs">
                            {{ $enroll->status_label }}
                        </span>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">
            {{-- Profile card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center text-white text-2xl font-bold mx-auto mb-3">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <h4 class="font-bold text-gray-900">{{ auth()->user()->name }}</h4>
                    <p class="text-xs text-gray-500 mt-0.5">{{ auth()->user()->email }}</p>
                    @if(auth()->user()->institution)
                    <p class="text-xs text-blue-600 mt-1 font-medium">{{ auth()->user()->institution }}</p>
                    @endif
                </div>
                <a href="/user/profile" class="mt-4 block w-full text-center py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    Edit Profil
                </a>
            </div>

            {{-- Quick links --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <h4 class="font-bold text-gray-900 mb-3 text-sm">Menu Cepat</h4>
                <div class="space-y-2">
                    <a href="/programs" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-50 text-sm text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-search w-4 text-center text-blue-500"></i> Jelajahi Program
                    </a>
                    <a href="/user/certificates" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-50 text-sm text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-certificate w-4 text-center text-yellow-500"></i> Sertifikat Saya
                    </a>
                    <a href="/verify" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-50 text-sm text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-shield-alt w-4 text-center text-green-500"></i> Verifikasi Sertifikat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
