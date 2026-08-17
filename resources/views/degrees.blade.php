@extends('layouts.app')
@section('title', 'Jenis Gelar')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-3">Jenis Gelar Kampus Virtual</h1>
        <p class="text-gray-500 max-w-xl mx-auto">Pilih jalur pendidikan virtual yang paling sesuai dengan tujuan karier Anda</p>
    </div>

    {{-- Sarjana & Vokasi --}}
    @php
        $grouped = $degreeTypes->groupBy('category');
        $categoryLabels = ['sarjana' => 'Sarjana Virtual', 'vokasi' => 'Vokasi Virtual', 'diploma' => 'Diploma Virtual (K1–K6)'];
    @endphp

    @foreach($categoryLabels as $cat => $label)
    @if($grouped->has($cat))
    <div class="mb-14">
        <div class="flex items-center gap-3 mb-6">
            <div class="h-1 w-8 rounded-full gradient-bg"></div>
            <h2 class="text-2xl font-extrabold text-gray-900">{{ $label }}</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ $cat=='diploma'?'6':'3' }} gap-5">
            @foreach($grouped[$cat] as $d)
            <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="h-1.5" style="background-color: {{ $d->color }}"></div>
                <div class="p-6">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-sm mb-4"
                         style="background-color: {{ $d->color }}">
                        {{ $d->code }}
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1 text-lg">{{ $d->code }}</h3>
                    <p class="text-sm text-gray-600 mb-3">{{ $d->name }}</p>
                    <p class="text-xs text-gray-500 mb-4 line-clamp-3">{{ $d->description }}</p>

                    <div class="border-t border-gray-100 pt-4 space-y-2">
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span><i class="fas fa-clock mr-1 text-blue-400"></i>{{ $d->duration_months }} bulan</span>
                            <span><i class="fas fa-book mr-1 text-green-400"></i>{{ $d->credits_required }} SKS</span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span><i class="fas fa-layer-group mr-1 text-purple-400"></i>{{ $d->programs->count() }} program</span>
                            <span class="badge" style="background:{{ $d->color }}20;color:{{ $d->color }}">{{ ucfirst($d->category) }}</span>
                        </div>
                    </div>

                    @if($d->programs->count())
                    <a href="/programs?degree={{ $d->code }}" class="mt-4 block w-full text-center py-2.5 text-white text-xs font-bold rounded-xl transition hover:opacity-90"
                       style="background-color: {{ $d->color }}">
                        Lihat Program
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection
