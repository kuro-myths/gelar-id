@extends('tataletak.admin')
@section('judul','Detail Pendaftar Beasiswa')
@section('konten')
<div class="max-w-3xl">
    <a href="/admin/beasiswa/{{ $pendaftarBeasiswa->beasiswa_id }}/pendaftar"
       class="btn-komik px-4 py-2 bg-gray-100 text-[#1a1a2e] rounded-xl text-sm inline-flex mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar
    </a>

    {{-- Header --}}
    <div class="kartu-admin rounded-2xl p-6 mb-5">
        <div class="flex items-start gap-4">
            <div class="w-16 h-16 rounded-2xl bg-[#4361ee] flex items-center justify-center text-white font-black text-2xl border-3 border-[#1a1a2e]" style="border:3px solid #1a1a2e;">
                {{ strtoupper(substr($pendaftarBeasiswa->pengguna->nama,0,1)) }}
            </div>
            <div class="flex-1">
                <h2 class="judul-komik text-2xl text-[#1a1a2e]">{{ $pendaftarBeasiswa->pengguna->nama }}</h2>
                <p class="text-sm font-semibold text-gray-500">{{ $pendaftarBeasiswa->pengguna->email }}</p>
                <p class="text-xs font-bold text-gray-400 mt-1">NIM: {{ $pendaftarBeasiswa->pengguna->nim ?? '-' }}</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="badge-komik text-xs"
                          style="background:{{ $pendaftarBeasiswa->warna_status }}22;border-color:{{ $pendaftarBeasiswa->warna_status }};color:{{ $pendaftarBeasiswa->warna_status }};">
                        {{ $pendaftarBeasiswa->label_status }}
                    </span>
                    <span class="badge-komik bg-[#f0f4ff] text-[#4361ee] text-xs">
                        {{ $pendaftarBeasiswa->beasiswa->nama }}
                    </span>
                    <span class="badge-komik bg-[#f0f4ff] text-[#4361ee] text-xs">
                        {{ $pendaftarBeasiswa->beasiswa->label_manfaat }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Program yang dipilih --}}
    @if($pendaftarBeasiswa->program)
    <div class="kartu-admin rounded-2xl p-5 mb-5">
        <h3 class="judul-komik text-lg text-[#1a1a2e] mb-2">📚 PROGRAM YANG DIPILIH</h3>
        <p class="font-black text-[#4361ee]">{{ $pendaftarBeasiswa->program->nama }}</p>
        <p class="text-sm font-semibold text-gray-500">{{ $pendaftarBeasiswa->program->jenisGelar->kode }} — {{ $pendaftarBeasiswa->program->jenisGelar->nama }}</p>
    </div>
    @endif

    {{-- Surat Motivasi --}}
    @if($pendaftarBeasiswa->surat_motivasi)
    <div class="kartu-admin rounded-2xl p-5 mb-5">
        <h3 class="judul-komik text-lg text-[#1a1a2e] mb-3">✍️ SURAT MOTIVASI</h3>
        <div class="bg-[#f8f9ff] border-2 border-[#e0e7ff] rounded-xl p-4">
            <p class="text-sm text-gray-700 font-semibold leading-relaxed whitespace-pre-line">{{ $pendaftarBeasiswa->surat_motivasi }}</p>
        </div>
    </div>
    @endif

    {{-- Dokumen/Bukti --}}
    @if($pendaftarBeasiswa->dokumen)
    <div class="kartu-admin rounded-2xl p-5 mb-5">
        <h3 class="judul-komik text-lg text-[#1a1a2e] mb-3">📎 DOKUMEN & BUKTI</h3>
        @foreach($pendaftarBeasiswa->dokumen as $key => $val)
        @if($val)
        <div class="mb-3">
            <p class="text-xs font-black text-[#4361ee] uppercase mb-1">{{ str_replace('_',' ',$key) }}</p>
            <div class="bg-[#f0f4ff] border-2 border-[#e0e7ff] rounded-xl p-3">
                <p class="text-sm text-gray-700 font-semibold break-all">{{ $val }}</p>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endif

    {{-- Pencapaian yang diraih --}}
    <div class="kartu-admin rounded-2xl p-5 mb-5">
        <h3 class="judul-komik text-lg text-[#1a1a2e] mb-3">🏆 PENCAPAIAN YANG DIRAIH</h3>
        @if($pendaftarBeasiswa->pengguna->pencapaianDiraih->isEmpty())
        <p class="text-sm text-gray-400 font-semibold">Belum ada pencapaian yang diraih.</p>
        @else
        <div class="flex flex-wrap gap-2">
            @foreach($pendaftarBeasiswa->pengguna->pencapaianDiraih as $pp)
            <div class="flex items-center gap-2 bg-[#f0f4ff] border-2 border-[#e0e7ff] rounded-xl px-3 py-2">
                <span class="text-xl">{{ $pp->pencapaian->ikon }}</span>
                <div>
                    <p class="text-xs font-black text-[#1a1a2e]">{{ $pp->pencapaian->nama }}</p>
                    <p class="text-xs font-semibold text-gray-400">{{ $pp->pencapaian->poin }} poin</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Form Verifikasi --}}
    @if(in_array($pendaftarBeasiswa->status, ['menunggu','diproses']))
    <div class="kartu-admin rounded-2xl p-5 border-2 border-[#4361ee]">
        <h3 class="judul-komik text-lg text-[#1a1a2e] mb-4">⚡ KEPUTUSAN VERIFIKASI</h3>
        <form method="POST" action="/admin/beasiswa/pendaftar/{{ $pendaftarBeasiswa->id }}/verifikasi" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-black text-[#1a1a2e] mb-1.5 uppercase">Catatan untuk Pendaftar</label>
                <textarea name="catatan_admin" rows="3" class="input-komik text-sm resize-none"
                          placeholder="Opsional — akan dikirim ke email pendaftar...">{{ old('catatan_admin') }}</textarea>
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="submit" name="status" value="diproses"
                        class="btn-komik px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm">
                    🔍 Tandai Sedang Diproses
                </button>
                <button type="submit" name="status" value="diterima"
                        class="btn-komik px-5 py-2.5 bg-[#06d6a0] text-[#1a1a2e] rounded-xl text-sm font-black">
                    ✅ Terima Beasiswa
                </button>
                <button type="submit" name="status" value="ditolak"
                        class="btn-komik px-5 py-2.5 bg-[#f72585] text-white rounded-xl text-sm"
                        onclick="return confirm('Tolak pendaftar ini?')">
                    ❌ Tolak
                </button>
            </div>
            <p class="text-xs font-semibold text-gray-400">
                * Email notifikasi akan otomatis dikirim ke pendaftar.
            </p>
        </form>
    </div>
    @else
    <div class="kartu-admin rounded-2xl p-5 bg-gray-50">
        <p class="font-black text-gray-500">
            Status: {{ $pendaftarBeasiswa->label_status }}
            @if($pendaftarBeasiswa->catatan_admin)
            — "{{ $pendaftarBeasiswa->catatan_admin }}"
            @endif
        </p>
        @if($pendaftarBeasiswa->diverifikasi_pada)
        <p class="text-xs font-semibold text-gray-400 mt-1">
            Diverifikasi: {{ $pendaftarBeasiswa->diverifikasi_pada->format('d M Y H:i') }}
        </p>
        @endif
    </div>
    @endif
</div>
@endsection
