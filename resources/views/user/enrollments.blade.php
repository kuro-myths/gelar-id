@extends('layouts.app')
@section('title', 'Pendaftaran Saya')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900">Pendaftaran Saya</h1>
        <a href="/programs" class="px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-1"></i>Daftar Program Baru
        </a>
    </div>

    @if($enrollments->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center text-gray-400">
        <i class="fas fa-book-open text-5xl mb-4 text-gray-200"></i>
        <p class="font-medium">Belum ada pendaftaran</p>
        <a href="/programs" class="mt-4 inline-block px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl">Jelajahi Program</a>
    </div>
    @else
    <div class="space-y-4">
        @foreach($enrollments as $e)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-5">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                 style="background-color: {{ $e->program->degreeType->color }}">
                {{ $e->program->degreeType->code }}
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-gray-900">{{ $e->program->name }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">{{ $e->enrollment_number }} • Daftar {{ $e->created_at->format('d M Y') }}</p>
            </div>
            <div class="text-right">
                @php $colors = ['pending'=>'yellow','active'=>'blue','completed'=>'green','cancelled'=>'red'] @endphp
                <span class="badge bg-{{ $colors[$e->status] }}-100 text-{{ $colors[$e->status] }}-700">{{ $e->status_label }}</span>
                @if($e->status === 'completed' && $e->certificate)
                <div class="mt-2">
                    <a href="/verify?code={{ $e->certificate->verify_code }}" class="text-xs text-blue-600 hover:underline">
                        <i class="fas fa-certificate mr-1"></i>Lihat Sertifikat
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $enrollments->links() }}</div>
    @endif
</div>
@endsection
