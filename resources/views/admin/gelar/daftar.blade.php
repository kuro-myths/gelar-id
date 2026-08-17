@extends('tataletak.admin')
@section('judul','Jenis Gelar')
@section('konten')
<div class="flex justify-end mb-5">
    <a href="/admin/gelar/buat" class="btn-komik px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">➕ Tambah Gelar</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($gelar as $g)
    <div class="kartu-admin p-6">
        <div class="flex items-start justify-between mb-4">
            <div class="w-14 h-14 rounded-xl flex items-center justify-center text-white font-black text-sm" style="background:{{ $g->warna }};border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">{{ $g->kode }}</div>
            <span class="badge-komik {{ $g->aktif ? 'bg-[#06d6a0] text-[#1a1a2e]' : 'bg-[#f72585] text-white' }} text-xs">{{ $g->aktif ? '✅ Aktif' : '❌ Nonaktif' }}</span>
        </div>
        <h3 class="judul-komik text-xl text-[#1a1a2e] mb-1">{{ $g->kode }}</h3>
        <p class="text-sm font-bold text-gray-600 mb-1">{{ $g->nama }}</p>
        <p class="text-xs font-bold text-gray-400 mb-4">⏱️ {{ $g->durasi_bulan }} bln • 📖 {{ $g->sks_dibutuhkan }} SKS • 📚 {{ $g->program_count }} program</p>
        <a href="/admin/gelar/{{ $g->id }}/edit" class="btn-komik w-full py-2 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-sm text-center block">✏️ Edit</a>
    </div>
    @endforeach
</div>
@endsection
