@extends('tataletak.admin')
@section('judul','Detail Semester')
@section('konten')
<div class="flex gap-3 mb-5 flex-wrap">
    <a href="/admin/semester" class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm">← Kembali</a>
    <a href="/admin/semester/{{ $semester->id }}/edit" class="btn-komik px-4 py-2 bg-[#ffd60a] text-[#1a1a2e] rounded-xl text-sm">✏️ Edit</a>
    <a href="/admin/semester/{{ $semester->id }}/sesi/buat" class="btn-komik px-4 py-2 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-sm">➕ Tambah Sesi</a>
</div>

<div class="kartu-admin p-6 mb-6">
    <div class="flex items-start gap-5">
        <div class="w-16 h-16 rounded-2xl bg-[#4361ee] text-white font-black flex items-center justify-center judul-komik text-3xl" style="border:3px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;">{{ $semester->nomor }}</div>
        <div>
            <span class="badge-komik text-white text-sm mb-2 inline-block" style="background:{{ $semester->program->jenisGelar->warna }};border-color:#1a1a2e;">{{ $semester->program->jenisGelar->kode }}</span>
            <h2 class="judul-komik text-3xl text-[#1a1a2e]">{{ $semester->nama }}</h2>
            <p class="font-bold text-gray-500">{{ $semester->program->nama }}</p>
            <div class="flex flex-wrap gap-4 mt-2 text-xs font-black text-gray-500">
                <span>📅 {{ $semester->tanggal_mulai?->format('d M Y') ?? '—' }} s/d {{ $semester->tanggal_selesai?->format('d M Y') ?? '—' }}</span>
                <span>📖 {{ $semester->jumlah_sks }} SKS</span>
                <span>📚 {{ $semester->sesiBelajar->count() }} sesi</span>
            </div>
        </div>
    </div>
</div>

{{-- Daftar Sesi Belajar --}}
<div class="kartu-admin overflow-hidden">
    <div class="bg-[#1a1a2e] px-4 py-3"><h3 class="judul-komik text-xl text-white">📚 SESI BELAJAR</h3></div>
    <div class="divide-y-2 divide-gray-50">
        @forelse($semester->sesiBelajar as $sesi)
        <div class="px-5 py-4 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-[#4361ee] text-white font-black flex items-center justify-center text-sm flex-shrink-0" style="border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;">{{ $sesi->pertemuan_ke }}</div>
            <div class="flex-1">
                <p class="font-black text-[#1a1a2e]">{{ $sesi->judul }}</p>
                <p class="text-xs font-bold text-gray-500">
                    {{ $sesi->label_tipe }} ·
                    📅 {{ $sesi->mulai_pada->format('d M Y, H:i') }} ·
                    ⏱️ {{ $sesi->durasi_menit }} mnt
                </p>
                @if($sesi->deskripsi)<p class="text-xs text-gray-400 mt-1">{{ $sesi->deskripsi }}</p>@endif
            </div>
            <div class="flex items-center gap-2">
                @if($sesi->pertemuan->isNotEmpty())
                <span class="badge-komik bg-[#4361ee] text-white text-xs">🎥 {{ $sesi->pertemuan->count() }} meeting</span>
                @endif
                @if($sesi->kuesioner->isNotEmpty())
                <span class="badge-komik bg-[#f72585] text-white text-xs">📋 {{ $sesi->kuesioner->count() }} kuis</span>
                @endif
                <form method="POST" action="/admin/sesi/{{ $sesi->id }}" onsubmit="return confirm('Hapus sesi ini?')">
                    @csrf @method('DELETE')
                    <button class="btn-komik px-2 py-1 bg-[#f72585] text-white rounded-lg text-xs">🗑️</button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-12 text-center text-gray-400 font-black">
            <div class="text-5xl mb-3">📭</div>
            Belum ada sesi belajar
            <div class="mt-4"><a href="/admin/semester/{{ $semester->id }}/sesi/buat" class="btn-komik px-5 py-2.5 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-sm inline-flex">➕ Tambah Sesi Pertama</a></div>
        </div>
        @endforelse
    </div>
</div>
@endsection
