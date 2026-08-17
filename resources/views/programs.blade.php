@extends('layouts.app')
@section('title', 'Program Studi')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Program Studi</h1>
        <p class="text-gray-500">Temukan program yang sesuai dengan tujuan Anda</p>
    </div>

    <div class="flex flex-col md:flex-row gap-6">
        {{-- Filter Sidebar --}}
        <aside class="w-full md:w-56 flex-shrink-0">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sticky top-20">
                <h3 class="font-bold text-gray-900 mb-4 text-sm">Filter Gelar</h3>
                <div class="space-y-1">
                    <a href="/programs" class="block px-3 py-2 rounded-lg text-sm {{ !request('degree') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        Semua Gelar
                    </a>
                    @foreach($degreeTypes as $dt)
                    <a href="/programs?degree={{ $dt->code }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request('degree')==$dt->code ? 'font-semibold' : 'text-gray-600 hover:bg-gray-50' }}"
                       style="{{ request('degree')==$dt->code ? 'background-color:'.$dt->color.'20;color:'.$dt->color : '' }}">
                        <span class="w-2 h-2 rounded-full" style="background-color: {{ $dt->color }}"></span>
                        {{ $dt->code }}
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- Programs Grid --}}
        <div class="flex-1">
            {{-- Search --}}
            <form method="GET" action="/programs" class="flex gap-2 mb-6">
                @if(request('degree'))<input type="hidden" name="degree" value="{{ request('degree') }}">@endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program..."
                       class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-4 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            @if($programs->isEmpty())
            <div class="text-center py-20 text-gray-400">
                <i class="fas fa-search text-5xl mb-4"></i>
                <p>Program tidak ditemukan</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach($programs as $p)
                <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="h-1.5" style="background-color: {{ $p->degreeType->color }}"></div>
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-3">
                            <span class="badge text-xs" style="background:{{ $p->degreeType->color }}20;color:{{ $p->degreeType->color }}">
                                {{ $p->degreeType->code }}
                            </span>
                            @if($p->is_free)
                                <span class="badge bg-green-100 text-green-700 text-xs">GRATIS</span>
                            @else
                                <span class="text-sm font-bold text-gray-900">Rp {{ number_format($p->price,0,',','.') }}</span>
                            @endif
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2 leading-snug">{{ $p->name }}</h3>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ $p->description }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-400"><i class="fas fa-users mr-1"></i>{{ $p->participant_count }}</span>
                            @auth
                            <form method="POST" action="/user/enroll/{{ $p->id }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-white text-xs font-bold rounded-lg hover:opacity-90 transition"
                                        style="background-color: {{ $p->degreeType->color }}">
                                    Daftar
                                </button>
                            </form>
                            @else
                            <a href="/login" class="px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition">
                                Masuk & Daftar
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $programs->withQueryString()->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
