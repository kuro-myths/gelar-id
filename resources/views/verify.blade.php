@extends('layouts.app')
@section('title', 'Verifikasi Sertifikat')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-16">
    <div class="text-center mb-10">
        <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center text-white text-2xl mx-auto mb-4">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Verifikasi Sertifikat</h1>
        <p class="text-gray-500">Masukkan kode verifikasi untuk memastikan keaslian sertifikat</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
        <form method="GET" action="/verify" class="flex gap-3">
            <input type="text" name="code" value="{{ request('code') }}"
                   placeholder="Masukkan kode verifikasi (contoh: ABC123DE)"
                   class="flex-1 px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono uppercase"
                   style="text-transform:uppercase">
            <button type="submit" class="px-6 py-3 gradient-bg text-white font-bold rounded-xl hover:opacity-90 transition text-sm">
                <i class="fas fa-search mr-1"></i> Verifikasi
            </button>
        </form>
    </div>

    @if(request('code'))
        @if($certificate)
        <div class="bg-white rounded-2xl shadow-sm border-2 border-green-200 p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-green-700 text-lg">Sertifikat Valid</h3>
                    <p class="text-sm text-gray-500">Sertifikat ini asli dan terverifikasi</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500 text-xs mb-1">Nama Penerima</p>
                    <p class="font-bold text-gray-900">{{ $certificate->issued_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs mb-1">Gelar Diraih</p>
                    <span class="badge text-sm font-bold" style="background:{{ $certificate->degreeType->color }}20;color:{{ $certificate->degreeType->color }}">
                        {{ $certificate->degreeType->code }}
                    </span>
                </div>
                <div>
                    <p class="text-gray-500 text-xs mb-1">Nama Program</p>
                    <p class="font-semibold text-gray-800">{{ $certificate->enrollment->program->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs mb-1">Tanggal Diterbitkan</p>
                    <p class="font-semibold text-gray-800">{{ $certificate->issued_date->format('d F Y') }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-gray-500 text-xs mb-1">Nomor Sertifikat</p>
                    <p class="font-mono font-bold text-gray-800">{{ $certificate->certificate_number }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-sm border-2 border-red-200 p-8 text-center">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-times-circle text-red-500 text-2xl"></i>
            </div>
            <h3 class="font-bold text-red-700 text-lg mb-2">Sertifikat Tidak Ditemukan</h3>
            <p class="text-sm text-gray-500">Kode <code class="bg-gray-100 px-2 py-1 rounded font-mono font-bold">{{ request('code') }}</code> tidak valid atau sertifikat sudah tidak berlaku.</p>
        </div>
        @endif
    @endif
</div>
@endsection
