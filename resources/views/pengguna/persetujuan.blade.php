@extends('tataletak.aplikasi')
@section('judul','Persetujuan Pendaftaran')
@section('konten')

<div class="max-w-2xl mx-auto px-4 py-10" x-data="{ tipeWali: 'orang_tua' }">

    {{-- Header Kuning --}}
    <div class="kartu-komik p-6 mb-6 akan-muncul" style="background:#ffd60a;border-color:#0f0e17;">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-[#0f0e17] flex items-center justify-center flex-shrink-0">
                <i data-lucide="shield-check" class="w-6 h-6 text-[#ffd60a]"></i>
            </div>
            <div>
                <h1 class="judul-komik text-3xl text-[#0f0e17] mb-1">PERSETUJUAN PENDAFTARAN</h1>
                <p class="font-black text-[#0f0e17]">{{ $pendaftaran->program->nama }}</p>
                <span class="badge-komik text-white text-xs mt-1 inline-block"
                      style="background:{{ $pendaftaran->program->jenisGelar->warna }};border-color:#0f0e17;">
                    {{ $pendaftaran->program->jenisGelar->kode }}
                </span>
            </div>
        </div>
    </div>

    {{-- Info Penting Kampus Independen --}}
    <div class="kartu-komik p-6 mb-6 akan-muncul" style="background:#f0f4ff;animation-delay:.1s">
        <h3 class="judul-komik text-xl text-[#0f0e17] mb-4 flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-5 h-5 text-[#4361ee]"></i>
            BACA SEBELUM MENDAFTAR
        </h3>

        <div class="space-y-3">
            @php
            $infoList = [
                ['ikon'=>'building-2',     'teks'=>'Gelar.id adalah kampus virtual INDEPENDEN — tidak berafiliasi dengan pemerintah atau yayasan swasta manapun.'],
                ['ikon'=>'award',          'teks'=>'Sertifikat yang diterbitkan adalah bukti kompetensi dan pengalaman nyata, bukan ijazah formal akademik negara.'],
                ['ikon'=>'briefcase',      'teks'=>'Pencarian pekerjaan dan pengembangan karir sepenuhnya menjadi tanggung jawab peserta didik.'],
                ['ikon'=>'rocket',         'teks'=>'Kampus ini mendorong peserta menjadi entrepreneur digital dan pencipta lapangan kerja, bukan sekadar pencari kerja.'],
                ['ikon'=>'check-circle',   'teks'=>'Keunggulan: kurikulum modern berbasis industri, proyek nyata, sertifikat portofolio, komunitas alumni aktif.'],
                ['ikon'=>'info',           'teks'=>'Dengan mendaftar, kamu memahami dan menyetujui status kampus independen ini.'],
            ];
            @endphp

            @foreach($infoList as $item)
            <div class="flex items-start gap-3 text-sm font-semibold text-gray-700">
                <i data-lucide="{{ $item['ikon'] }}" class="w-4 h-4 text-[#4361ee] flex-shrink-0 mt-0.5"></i>
                <span>{{ $item['teks'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    @if($errors->any())
    <div class="kartu-komik p-4 mb-5 akan-muncul" style="background:#f72585;border-color:#0f0e17;">
        <ul class="space-y-1">
            @foreach($errors->all() as $e)
            <li class="text-white text-sm font-black flex items-center gap-2">
                <i data-lucide="x-circle" class="w-4 h-4"></i>{{ $e }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="/pengguna/persetujuan/{{ $pendaftaran->id }}" class="space-y-5">
        @csrf

        {{-- Pilih Tipe Wali --}}
        <div class="kartu-komik p-6 akan-muncul" style="animation-delay:.15s">
            <h3 class="judul-komik text-xl text-[#0f0e17] mb-4 flex items-center gap-2">
                <i data-lucide="users" class="w-5 h-5 text-[#4361ee]"></i>
                STATUS PERSETUJUAN
            </h3>

            <div class="space-y-3">
                @php
                $opsiWali = [
                    'orang_tua' => [
                        'ikon'  => 'home',
                        'judul' => 'Disetujui Orang Tua',
                        'sub'   => 'Ayah atau Ibu masih ada dan memberikan izin belajar di Gelar.id',
                        'warna' => '#4361ee',
                    ],
                    'wali' => [
                        'ikon'  => 'user-check',
                        'judul' => 'Disetujui Wali / Keluarga',
                        'sub'   => 'Orang tua tidak ada, digantikan wali sah (kakak, paman, bibi, dll)',
                        'warna' => '#06d6a0',
                    ],
                    'mandiri' => [
                        'ikon'  => 'shield',
                        'judul' => 'Mandiri — Tidak Memiliki Wali',
                        'sub'   => 'Yatim piatu, sudah dewasa & mandiri, atau kondisi khusus (wajib isi pernyataan)',
                        'warna' => '#f72585',
                    ],
                ];
                @endphp

                @foreach($opsiWali as $tipe => $info)
                <label class="flex items-start gap-4 p-4 rounded-2xl border-2 cursor-pointer transition-all duration-200"
                       :class="tipeWali === '{{ $tipe }}'
                           ? 'border-[#4361ee] bg-[#f0f4ff] shadow-[4px_4px_0_#4361ee]'
                           : 'border-gray-200 hover:border-gray-300 hover:bg-gray-50'">
                    <input type="radio" name="tipe_wali" value="{{ $tipe }}"
                           x-model="tipeWali"
                           class="mt-1 w-4 h-4 accent-[#4361ee]">
                    <div>
                        <p class="font-black text-[#0f0e17] flex items-center gap-2 mb-0.5">
                            <i data-lucide="{{ $info['ikon'] }}" class="w-4 h-4" style="color:{{ $info['warna'] }}"></i>
                            {{ $info['judul'] }}
                        </p>
                        <p class="text-xs font-semibold text-gray-500">{{ $info['sub'] }}</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Form Data Wali / Orang Tua --}}
        <div x-show="tipeWali !== 'mandiri'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0 -translate-y-3"
             class="kartu-komik p-6"
             x-cloak>
            <h3 class="judul-komik text-xl text-[#0f0e17] mb-4 flex items-center gap-2">
                <i data-lucide="user-check" class="w-5 h-5 text-[#4361ee]"></i>
                DATA WALI / ORANG TUA
            </h3>
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase tracking-wide">
                            Nama Lengkap <span class="text-[#f72585]">*</span>
                        </label>
                        <input type="text" name="nama_wali" value="{{ old('nama_wali') }}"
                               placeholder="Nama orang tua / wali"
                               class="input-komik text-sm"
                               :required="tipeWali !== 'mandiri'">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase tracking-wide">
                            Hubungan <span class="text-[#f72585]">*</span>
                        </label>
                        <input type="text" name="hubungan_wali" value="{{ old('hubungan_wali') }}"
                               placeholder="Ayah / Ibu / Kakak / Paman..."
                               class="input-komik text-sm"
                               :required="tipeWali !== 'mandiri'">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase tracking-wide">
                            Nomor HP Wali
                        </label>
                        <input type="text" name="telepon_wali" value="{{ old('telepon_wali') }}"
                               placeholder="08xx-xxxx-xxxx"
                               class="input-komik text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase tracking-wide">
                            Email Wali
                        </label>
                        <input type="email" name="email_wali" value="{{ old('email_wali') }}"
                               placeholder="email@contoh.com"
                               class="input-komik text-sm">
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Pernyataan Mandiri --}}
        <div x-show="tipeWali === 'mandiri'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0 -translate-y-3"
             class="kartu-komik p-6"
             x-cloak>
            <h3 class="judul-komik text-xl text-[#0f0e17] mb-4 flex items-center gap-2">
                <i data-lucide="file-text" class="w-5 h-5 text-[#f72585]"></i>
                PERNYATAAN MANDIRI
            </h3>
            <div class="bg-[#ffd60a] rounded-xl p-4 mb-4" style="border:2px solid #0f0e17;">
                <p class="text-sm font-bold text-[#0f0e17]">
                    Pernyataan ini diperlukan karena kamu memilih status mandiri.
                    Jelaskan kondisi yang menyebabkan kamu tidak memiliki wali/orang tua (min. 30 karakter).
                </p>
            </div>
            <label class="block text-xs font-black text-[#0f0e17] mb-1.5 uppercase tracking-wide">
                Kondisi / Alasan <span class="text-[#f72585]">*</span>
            </label>
            <textarea name="pernyataan_mandiri" rows="4"
                      class="input-komik text-sm"
                      placeholder="Contoh: Saya adalah yatim piatu sejak usia 8 tahun dan saat ini sudah bekerja mandiri sebagai freelancer..."
                      :required="tipeWali === 'mandiri'"
                      x-ref="pernyataanMandiri">{{ old('pernyataan_mandiri') }}</textarea>
            <p class="text-xs font-bold text-gray-400 mt-1">
                Minimal 30 karakter — pernyataan ini bersifat rahasia dan hanya dilihat admin.
            </p>
        </div>

        {{-- Persetujuan Syarat --}}
        <div class="kartu-komik p-6 akan-muncul" style="animation-delay:.2s">
            <h3 class="judul-komik text-xl text-[#0f0e17] mb-4 flex items-center gap-2">
                <i data-lucide="file-check" class="w-5 h-5 text-[#4361ee]"></i>
                PERNYATAAN PERSETUJUAN
            </h3>

            <div class="space-y-4">
                @php
                $checkList = [
                    [
                        'nama'  => 'setuju_syarat',
                        'teks'  => 'Saya (dan/atau wali) telah membaca dan menyetujui Syarat & Ketentuan serta Kebijakan Privasi Gelar.id secara lengkap.',
                        'warna' => '#4361ee',
                    ],
                    [
                        'nama'  => 'setuju_independen',
                        'teks'  => 'Saya memahami bahwa Gelar.id adalah lembaga pendidikan INDEPENDEN — bukan PTN, PTS, atau lembaga formal negara. Sertifikat yang diterbitkan merupakan bukti kompetensi mandiri yang diakui oleh komunitas industri.',
                        'warna' => '#7209b7',
                    ],
                    [
                        'nama'  => 'setuju_swadaya',
                        'teks'  => 'Saya memahami bahwa pengembangan karir dan pencarian pekerjaan adalah tanggung jawab saya sendiri. Gelar.id memberikan bekal kurikulum, portofolio, sertifikat, dan komunitas — bukan jaminan penempatan kerja.',
                        'warna' => '#06d6a0',
                    ],
                ];
                @endphp

                @foreach($checkList as $check)
                <label class="flex items-start gap-3 p-4 rounded-2xl border-2 border-gray-200 cursor-pointer hover:border-[#4361ee] hover:bg-[#f0f4ff] transition-all group">
                    <input type="checkbox" name="{{ $check['nama'] }}" value="1"
                           required
                           class="mt-1 w-4 h-4 accent-[#4361ee] flex-shrink-0">
                    <div>
                        <div class="w-4 h-1 rounded-full mb-2" style="background:{{ $check['warna'] }}"></div>
                        <p class="text-sm font-semibold text-gray-700 leading-relaxed">{{ $check['teks'] }}</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Tombol Submit --}}
        <button type="submit"
                class="btn-komik w-full py-4 bg-[#4361ee] text-white rounded-2xl text-lg akan-muncul"
                style="animation-delay:.25s">
            <i data-lucide="shield-check" class="w-5 h-5"></i>
            SIMPAN PERSETUJUAN & MULAI BELAJAR
        </button>

        <p class="text-center text-xs font-bold text-gray-400 mt-3">
            <i data-lucide="lock" class="w-3.5 h-3.5 inline mr-1"></i>
            Data persetujuan dienkripsi dan disimpan aman — tidak dibagikan ke pihak ketiga
        </p>
    </form>
</div>

@endsection
