<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat — {{ $sertifikat->nomor_sertifikat }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print { .no-print { display: none; } body { margin: 0; } }
        body { font-family: 'Nunito', sans-serif; background: #f0f4ff; }
        .font-cinzel { font-family: 'Cinzel', serif; }
        .sertifikat-bg {
            background: linear-gradient(135deg, #fdf6e3 0%, #fff9f0 50%, #fdf6e3 100%);
            border: 8px double #c9a84c;
            box-shadow: 0 0 0 4px #e8d5a3, 0 20px 60px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }
        .sertifikat-bg::before {
            content: '';
            position: absolute;
            inset: 20px;
            border: 2px solid #c9a84c;
            pointer-events: none;
            border-radius: 4px;
        }
        .ornamen-pojok {
            position: absolute;
            width: 80px; height: 80px;
            border: 3px solid #c9a84c;
        }
        .watermark {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%,-50%) rotate(-30deg);
            font-size: 120px;
            color: rgba(201,168,76,0.06);
            font-weight: 900;
            font-family: 'Cinzel', serif;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-8">
    <div class="no-print flex gap-3 mb-6">
        <button onclick="window.print()" class="px-6 py-3 bg-[#4361ee] text-white font-black rounded-xl" style="border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;">🖨️ Cetak / Simpan PDF</button>
        <a href="/admin/sertifikat" class="px-6 py-3 bg-gray-100 text-gray-700 font-black rounded-xl" style="border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;">← Kembali</a>
    </div>

    {{-- SERTIFIKAT --}}
    <div class="sertifikat-bg w-full max-w-4xl rounded-2xl p-16 text-center relative" style="min-height:580px;">
        <div class="watermark">GELAR.ID</div>
        <div class="ornamen-pojok top-4 left-4 border-b-0 border-r-0 rounded-tl-xl"></div>
        <div class="ornamen-pojok top-4 right-4 border-b-0 border-l-0 rounded-tr-xl"></div>
        <div class="ornamen-pojok bottom-4 left-4 border-t-0 border-r-0 rounded-bl-xl"></div>
        <div class="ornamen-pojok bottom-4 right-4 border-t-0 border-l-0 rounded-br-xl"></div>

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-center gap-4 mb-4">
                <div class="w-1 h-12 bg-[#c9a84c]"></div>
                <p class="font-cinzel text-[#c9a84c] text-sm font-bold tracking-[6px] uppercase">Kampus Virtual Indonesia</p>
                <div class="w-1 h-12 bg-[#c9a84c]"></div>
            </div>
            <h1 class="font-cinzel text-5xl font-black text-[#5c3d11] tracking-wide mb-2">SERTIFIKAT</h1>
            <p class="font-cinzel text-[#c9a84c] tracking-[8px] text-sm uppercase">Penghargaan Akademik</p>
        </div>

        {{-- Divider --}}
        <div class="flex items-center gap-4 justify-center mb-8">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent to-[#c9a84c]"></div>
            <div class="text-[#c9a84c] text-2xl">✦</div>
            <div class="flex-1 h-px bg-gradient-to-l from-transparent to-[#c9a84c]"></div>
        </div>

        <p class="text-gray-600 font-bold mb-2 tracking-widest text-sm uppercase">Dengan bangga diberikan kepada</p>

        <h2 class="font-cinzel text-5xl font-black text-[#5c3d11] mb-2 border-b-2 border-[#c9a84c] pb-3 inline-block px-8">
            {{ strtoupper($sertifikat->nama_tercetak) }}
        </h2>

        @if($sertifikat->pendaftaran->pengguna->nim)
        <p class="font-bold text-gray-500 mt-2 tracking-widest text-sm">NIM: {{ $sertifikat->pendaftaran->pengguna->nim }}</p>
        @endif

        <p class="text-gray-600 font-bold mt-5 mb-2">Telah berhasil menyelesaikan program studi</p>
        <p class="font-cinzel text-2xl font-bold text-[#5c3d11] mb-1">{{ $sertifikat->pendaftaran->program->nama }}</p>
        <p class="text-gray-500 font-bold mb-5">dan berhak menyandang gelar</p>

        <div class="inline-block px-8 py-3 mb-5" style="background:linear-gradient(135deg,#c9a84c,#e8d5a3);border:2px solid #c9a84c;border-radius:8px;">
            <span class="font-cinzel text-4xl font-black text-[#5c3d11]">
                {{ strtoupper($sertifikat->nama_tercetak) }}, {{ $sertifikat->jenisGelar->gelar_singkat ?? $sertifikat->jenisGelar->kode }}
            </span>
        </div>

        @if($sertifikat->ipk)
        <p class="font-bold text-gray-600 mb-1">IPK: <strong class="text-[#5c3d11] text-xl">{{ $sertifikat->ipk }}</strong></p>
        @endif
        @if($sertifikat->predikat)
        <p class="font-bold text-[#c9a84c] text-lg mb-5">"{{ $sertifikat->predikat }}"</p>
        @endif

        <div class="flex items-center gap-4 justify-center mt-6 mb-8">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent to-[#c9a84c]"></div>
            <div class="text-[#c9a84c] text-2xl">✦</div>
            <div class="flex-1 h-px bg-gradient-to-l from-transparent to-[#c9a84c]"></div>
        </div>

        {{-- Footer --}}
        <div class="flex items-end justify-between mt-4">
            <div class="text-left">
                <p class="text-xs font-bold text-gray-500">No. Sertifikat</p>
                <p class="font-mono font-black text-gray-700 text-xs">{{ $sertifikat->nomor_sertifikat }}</p>
                <p class="text-xs font-bold text-gray-500 mt-1">Kode Verifikasi</p>
                <p class="font-mono font-black text-[#4361ee] text-xs">{{ $sertifikat->kode_verifikasi }}</p>
            </div>
            <div class="text-center">
                <p class="text-xs font-bold text-gray-500 mb-1">Diterbitkan</p>
                <p class="font-cinzel font-bold text-[#5c3d11] text-sm">{{ $sertifikat->tanggal_terbit->translatedFormat('d F Y') }}</p>
            </div>
            <div class="text-right">
                <div class="w-32 h-16 border-b-2 border-[#5c3d11] mb-1 mx-auto"></div>
                <p class="font-cinzel font-bold text-[#5c3d11] text-xs">{{ $sertifikat->ttd_nama ?? 'Rektor Kampus Virtual' }}</p>
                <p class="text-xs text-gray-500">{{ $sertifikat->ttd_jabatan ?? 'Pimpinan Kampus Virtual Indonesia' }}</p>
            </div>
        </div>
    </div>
</body>
</html>
