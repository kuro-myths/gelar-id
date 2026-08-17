@extends('layouts.app')
@section('title', 'Sertifikat Saya')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-extrabold text-gray-900 mb-6">Sertifikat Saya</h1>

    @if($certificates->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center text-gray-400">
        <i class="fas fa-certificate text-5xl mb-4 text-gray-200"></i>
        <p class="font-medium">Belum ada sertifikat</p>
        <p class="text-sm mt-1">Selesaikan program studi untuk mendapatkan sertifikat gelar</p>
        <a href="/programs" class="mt-4 inline-block px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition">Jelajahi Program</a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach($certificates as $cert)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="h-2" style="background-color: {{ $cert->degreeType->color }}"></div>
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center text-white font-bold"
                         style="background-color: {{ $cert->degreeType->color }}">
                        {{ $cert->degreeType->code }}
                    </div>
                    <span class="badge bg-green-100 text-green-700 text-xs">
                        <i class="fas fa-check mr-1"></i>Valid
                    </span>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $cert->degreeType->code }}</h3>
                <p class="text-sm text-gray-600 mb-1">{{ $cert->degreeType->name }}</p>
                <p class="text-xs text-gray-500 mb-4">{{ $cert->enrollment->program->name }}</p>

                <div class="border-t border-gray-100 pt-4 space-y-2 text-xs text-gray-500">
                    <div class="flex justify-between">
                        <span>No. Sertifikat</span>
                        <span class="font-mono font-bold text-gray-700">{{ $cert->certificate_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Kode Verifikasi</span>
                        <span class="font-mono font-bold text-blue-600">{{ $cert->verify_code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tanggal Terbit</span>
                        <span class="font-semibold text-gray-700">{{ $cert->issued_date->format('d F Y') }}</span>
                    </div>
                </div>

                <a href="/verify?code={{ $cert->verify_code }}" target="_blank"
                   class="mt-4 block w-full text-center py-2.5 border border-gray-200 text-gray-700 text-xs font-semibold rounded-xl hover:bg-gray-50 transition">
                    <i class="fas fa-external-link-alt mr-1"></i>Verifikasi Online
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $certificates->links() }}</div>
    @endif
</div>
@endsection
