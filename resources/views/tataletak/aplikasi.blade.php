<!DOCTYPE html>
<html lang="id" x-data="{ menuMobil: false, memuatHalaman: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('judul', 'Gelar.id') — Kampus Virtual Indonesia</title>
    <meta name="description" content="Platform kampus virtual Indonesia. Raih gelar KVT.Kom, VT.Kom, VTA.Kom, V.Com dan K1-K6 secara online.">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Nunito:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Lucide Icons (online, bukan Font Awesome) --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

    {{-- GSAP + ScrollTrigger + ScrollTo --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans:  ['Nunito', 'sans-serif'],
                    komik: ['Bangers', 'cursive'],
                    mono:  ['JetBrains Mono', 'monospace'],
                },
                colors: {
                    hitam:  '#0f0e17',
                    biru:   '#4361ee',
                    ungu:   '#7209b7',
                    merah:  '#f72585',
                    hijau:  '#06d6a0',
                    kuning: '#ffd60a',
                    abu:    '#f0f4ff',
                }
            }
        }
    }
    </script>

    <style>
        /* ========== ROOT ========== */
        :root{
            --hitam:#0f0e17; --biru:#4361ee; --ungu:#7209b7;
            --merah:#f72585; --hijau:#06d6a0; --kuning:#ffd60a;
        }
        *{box-sizing:border-box;}
        html{scroll-behavior:smooth;}
        body{font-family:'Nunito',sans-serif;background:#f8f9ff;color:#0f0e17;overflow-x:hidden;}

        /* ========== PAGE TRANSITION ========== */
        #layar-muat{
            position:fixed;inset:0;z-index:9999;
            background:#0f0e17;
            display:flex;align-items:center;justify-content:center;
            pointer-events:none;
            opacity:0;transition:opacity .4s;
        }
        #layar-muat.aktif{opacity:1;pointer-events:all;}
        .titik-muat{
            display:flex;gap:10px;
        }
        .titik-muat span{
            width:12px;height:12px;border-radius:50%;
            background:var(--biru);
            animation:lonjak .6s ease-in-out infinite alternate;
        }
        .titik-muat span:nth-child(2){animation-delay:.15s;background:var(--merah);}
        .titik-muat span:nth-child(3){animation-delay:.3s;background:var(--kuning);}
        @keyframes lonjak{from{transform:translateY(0)}to{transform:translateY(-16px)}}

        /* ========== TIPOGRAFI KOMIK ========== */
        .judul-komik{font-family:'Bangers',cursive;letter-spacing:2px;}

        /* ========== KOMIK CARD ========== */
        .kartu-komik{
            background:white;
            border:3px solid var(--hitam);
            box-shadow:6px 6px 0 var(--hitam);
            border-radius:16px;
            transition:transform .15s ease, box-shadow .15s ease;
        }
        .kartu-komik:hover{
            transform:translate(-3px,-3px);
            box-shadow:9px 9px 0 var(--hitam);
        }

        /* ========== TOMBOL KOMIK ========== */
        .btn-komik{
            border:2px solid var(--hitam);
            box-shadow:4px 4px 0 var(--hitam);
            font-weight:800;
            transition:transform .1s ease, box-shadow .1s ease;
            display:inline-flex;align-items:center;justify-content:center;gap:6px;
            cursor:pointer;
        }
        .btn-komik:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--hitam);}
        .btn-komik:active{transform:translate(2px,2px);box-shadow:2px 2px 0 var(--hitam);}

        /* ========== BADGE ========== */
        .badge-komik{
            border:2px solid var(--hitam);
            box-shadow:2px 2px 0 var(--hitam);
            font-weight:800;font-size:11px;
            padding:2px 10px;border-radius:6px;
            display:inline-block;
        }

        /* ========== INPUT ========== */
        .input-komik{
            border:2px solid var(--hitam);
            box-shadow:3px 3px 0 var(--hitam);
            border-radius:10px;font-weight:700;
            padding:10px 14px;width:100%;
            background:white;
            transition:border-color .15s, box-shadow .15s;
        }
        .input-komik:focus{
            outline:none;
            border-color:var(--biru);
            box-shadow:3px 3px 0 var(--biru);
        }

        /* ========== HALFTONE HERO ========== */
        .halftone{
            background-color:var(--biru);
            background-image:radial-gradient(#ffffff18 1px, transparent 1px);
            background-size:14px 14px;
            position:relative;overflow:hidden;
        }

        /* ========== FLASH MESSAGES ========== */
        .pesan-sukses{background:var(--hijau);border:3px solid var(--hitam);box-shadow:4px 4px 0 var(--hitam);color:var(--hitam);font-weight:800;}
        .pesan-galat{background:var(--merah);border:3px solid var(--hitam);box-shadow:4px 4px 0 var(--hitam);color:white;font-weight:800;}

        /* ========== ANIMASI SCROLL REVEAL ========== */
        .akan-muncul{opacity:0;transform:translateY(40px);}
        .sudah-muncul{opacity:1;transform:translateY(0);transition:opacity .7s ease, transform .7s ease;}

        /* ========== NAVBAR ========== */
        .navbar-komik{
            background:white;
            border-bottom:3px solid var(--hitam);
            position:sticky;top:0;z-index:100;
            backdrop-filter:blur(10px);
        }

        /* ========== FLOATING AI ========== */
        #ai-asisten{
            position:fixed;bottom:24px;right:24px;z-index:500;
        }
        .gelembung-ai{
            background:white;
            border:3px solid var(--hitam);
            box-shadow:6px 6px 0 var(--hitam);
            border-radius:20px;
            width:340px;
            max-height:480px;
            display:flex;flex-direction:column;
            overflow:hidden;
        }
        .pesan-ai-masuk{
            background:#f0f4ff;border:2px solid #4361ee22;
            border-radius:12px 12px 12px 4px;
            padding:10px 14px;font-size:13px;font-weight:600;
            max-width:85%;align-self:flex-start;
        }
        .pesan-ai-keluar{
            background:var(--biru);color:white;
            border:2px solid var(--hitam);
            border-radius:12px 12px 4px 12px;
            padding:10px 14px;font-size:13px;font-weight:600;
            max-width:85%;align-self:flex-end;
        }

        /* ========== COUNTER ANIMASI ========== */
        .angka-hitung{font-variant-numeric:tabular-nums;}

        /* ========== DISKON BADGE ========== */
        .badge-diskon{
            background:var(--merah);color:white;
            border:2px solid var(--hitam);box-shadow:2px 2px 0 var(--hitam);
            font-weight:900;font-size:12px;
            padding:2px 8px;border-radius:6px;
        }
        .harga-coret{
            text-decoration:line-through;
            color:#94a3b8;font-weight:600;font-size:13px;
        }

        /* ========== SKELETON LOADING ========== */
        .skeleton{
            background:linear-gradient(90deg,#f0f4ff 25%,#e8eeff 50%,#f0f4ff 75%);
            background-size:200% 100%;
            animation:kilas 1.5s infinite;
            border-radius:8px;
        }
        @keyframes kilas{0%{background-position:200% 0}100%{background-position:-200% 0}}

        /* ========== SCROLLBAR ========== */
        ::-webkit-scrollbar{width:6px;}
        ::-webkit-scrollbar-track{background:#f0f4ff;}
        ::-webkit-scrollbar-thumb{background:var(--biru);border-radius:3px;}

        @media(max-width:768px){
            .kartu-komik:hover{transform:none;box-shadow:6px 6px 0 var(--hitam);}
        }
    </style>
    @stack('gaya')
</head>

<body class="font-sans">

{{-- ===== LAYAR LOADING TRANSISI ===== --}}
<div id="layar-muat" style="position:fixed;inset:0;z-index:9999;background:#0f0e17;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .2s;">
    <div class="text-center">
        <div class="judul-komik text-4xl text-white mb-4">GELAR<span class="text-[#4361ee]">.id</span></div>
        <div class="titik-muat"><span></span><span></span><span></span></div>
    </div>
</div>

{{-- ===== NAVBAR ===== --}}
<nav class="navbar-komik" x-data="{ dropdown: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 group" data-tautan-spa>
                <div class="w-10 h-10 rounded-xl bg-[#4361ee] border-[3px] border-[#0f0e17] shadow-[3px_3px_0_#0f0e17] flex items-center justify-center group-hover:-translate-y-1 transition-transform">
                    <span class="judul-komik text-white text-lg leading-none">G</span>
                </div>
                <span class="judul-komik text-2xl text-[#0f0e17] tracking-wider hidden sm:block">
                    GELAR<span class="text-[#4361ee]">.id</span>
                </span>
            </a>

            {{-- Nav Desktop --}}
            <div class="hidden md:flex items-center gap-1">
                @php
                    $navItem = [
                        ['/',          'Beranda',    'home'],
                        ['/gelar',     'Jenis Gelar','graduation-cap'],
                        ['/kelas',     'Kelas',      'book'],
                        ['/program',   'Program',    'book-open'],
                        ['/pengajar',  'Pengajar',   'users'],
                        ['/verifikasi','Verifikasi', 'shield-check'],
                    ];
                @endphp
                @foreach($navItem as $n)
                <a href="{{ $n[0] }}" data-tautan-spa
                   class="flex items-center gap-1.5 px-4 py-2 rounded-xl font-bold text-sm text-[#0f0e17] hover:bg-[#4361ee] hover:text-white transition-all duration-200 relative group">
                    <i data-lucide="{{ $n[2] }}" class="w-4 h-4"></i>
                    {{ $n[1] }}
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-[#4361ee] group-hover:w-3/4 transition-all duration-300 rounded-full"></span>
                </a>
                @endforeach
            </div>

            {{-- Auth + Mobile Toggle --}}
            <div class="flex items-center gap-2">
                @auth
                <a href="{{ auth()->user()->isAdmin() ? '/admin/dasbor' : '/pengguna/dasbor' }}"
                   data-tautan-spa
                   class="hidden md:flex btn-komik px-4 py-2 bg-[#ffd60a] text-[#0f0e17] rounded-xl text-sm">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span>{{ Str::limit(auth()->user()->nama, 12) }}</span>
                </a>
                <form method="POST" action="/keluar" class="hidden md:block">
                    @csrf
                    <button type="submit" class="btn-komik px-3 py-2 bg-[#f72585] text-white rounded-xl text-sm">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
                @else
                <a href="/masuk" data-tautan-spa class="hidden md:flex btn-komik px-4 py-2 bg-white text-[#0f0e17] rounded-xl text-sm">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    Masuk
                </a>
                <a href="/daftar" data-tautan-spa class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">
                    <i data-lucide="rocket" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Daftar Gratis!</span>
                    <span class="sm:hidden">Daftar</span>
                </a>
                @endauth

                {{-- Tombol Hamburger --}}
                <button @click="menuMobil = !menuMobil"
                        class="md:hidden btn-komik p-2.5 bg-white rounded-xl">
                    <i data-lucide="menu" class="w-5 h-5" x-show="!menuMobil"></i>
                    <i data-lucide="x" class="w-5 h-5" x-show="menuMobil" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Mobile --}}
    <div x-show="menuMobil"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="md:hidden border-t-2 border-[#0f0e17] bg-white px-4 py-3 space-y-1"
         x-cloak>
        @foreach($navItem as $n)
        <a href="{{ $n[0] }}" @click="menuMobil=false" data-tautan-spa
           class="flex items-center gap-2 py-2.5 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]">
            <i data-lucide="{{ $n[2] }}" class="w-4 h-4 text-[#4361ee]"></i>
            {{ $n[1] }}
        </a>
        @endforeach
        @auth
        <div class="border-t border-gray-100 pt-2 mt-2 space-y-1">
            <a href="{{ auth()->user()->isAdmin() ? '/admin/dasbor' : '/pengguna/dasbor' }}" data-tautan-spa @click="menuMobil=false"
               class="flex items-center gap-2 py-2.5 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]">
                <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#4361ee]"></i>
                Dasbor
            </a>
            @if(!auth()->user()->isAdmin())
            <a href="/pengguna/pertemuan" data-tautan-spa @click="menuMobil=false"
               class="flex items-center gap-2 py-2.5 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]">
                <i data-lucide="video" class="w-4 h-4 text-[#4361ee]"></i>
                Pertemuan
            </a>
            <a href="/pengguna/kuesioner" data-tautan-spa @click="menuMobil=false"
               class="flex items-center gap-2 py-2.5 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]">
                <i data-lucide="clipboard-list" class="w-4 h-4 text-[#4361ee]"></i>
                Kuesioner
            </a>
            @endif
            <form method="POST" action="/keluar">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 py-2.5 px-3 rounded-xl font-bold text-[#f72585] hover:bg-red-50">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Keluar
                </button>
            </form>
        </div>
        @endauth
    </div>
</nav>

{{-- ===== FLASH MESSAGES ===== --}}
@if(session('sukses'))
<div id="flash-sukses" class="max-w-7xl mx-auto px-4 pt-4">
    <div class="pesan-sukses px-5 py-3 rounded-xl flex items-center gap-3 text-sm">
        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
        {{ session('sukses') }}
    </div>
</div>
@endif
@if(session('galat'))
<div id="flash-galat" class="max-w-7xl mx-auto px-4 pt-4">
    <div class="pesan-galat px-5 py-3 rounded-xl flex items-center gap-3 text-sm">
        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
        {{ session('galat') }}
    </div>
</div>
@endif

{{-- ===== KONTEN UTAMA ===== --}}
<main id="konten-utama">
    @yield('konten')
</main>

{{-- ===== FOOTER ===== --}}
<footer class="bg-[#0f0e17] text-white mt-20 border-t-4 border-[#4361ee]">
    <div class="max-w-7xl mx-auto px-4 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
            <div class="col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-[#4361ee] border-[3px] border-[#4361ee] flex items-center justify-center">
                        <span class="judul-komik text-white text-lg">G</span>
                    </div>
                    <span class="judul-komik text-3xl tracking-wider">GELAR<span class="text-[#4361ee]">.id</span></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-sm font-semibold">
                    Platform kampus virtual Indonesia. Raih gelar KVT.Kom, VT.Kom, VTA.Kom, V.Com dan K1–K6 secara online!
                </p>
                <div class="flex gap-3 mt-4">
                    @foreach([['instagram','#f72585'],['twitter','#4361ee'],['youtube','#EF4444'],['linkedin','#0077b5']] as $s)
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center border-2 border-gray-700 hover:border-[{{ $s[1] }}] cursor-pointer transition-colors group">
                        <i data-lucide="{{ $s[0] }}" class="w-4 h-4 text-gray-500 group-hover:text-[{{ $s[1] }}] transition-colors"></i>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="judul-komik text-xl text-[#ffd60a] mb-3 tracking-wide">🎓 GELAR</h4>
                <ul class="space-y-2 text-sm">
                    @foreach(['KVT.Kom','VT.Kom','VTA.Kom','V.Com','K1 — K6'] as $g)
                    <li><a href="/gelar" data-tautan-spa class="text-gray-400 hover:text-white font-semibold transition-colors">→ {{ $g }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="judul-komik text-xl text-[#ffd60a] mb-3 tracking-wide">🔗 TAUTAN</h4>
                <ul class="space-y-2 text-sm">
                    @foreach([['/program','Program Studi'],['/verifikasi','Verifikasi Sertifikat'],['/masuk','Masuk'],['/daftar','Daftar Gratis']] as $l)
                    <li><a href="{{ $l[0] }}" data-tautan-spa class="text-gray-400 hover:text-white font-semibold transition-colors">→ {{ $l[1] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="border-t-2 border-gray-800 pt-6 text-center text-sm text-gray-500 font-bold">
            &copy; {{ date('Y') }} GELAR.id — Platform Kampus Virtual Indonesia 🎓
        </div>
    </div>
</footer>

{{-- ===== FLOATING AI ASISTEN ===== --}}
<div id="ai-asisten" x-data="aiAsisten()">
    {{-- Bubble --}}
    <div x-show="terbuka"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90 translate-y-4"
         class="gelembung-ai mb-3"
         x-cloak>
        {{-- Header --}}
        <div class="bg-[#4361ee] px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-[#ffd60a] border-2 border-[#0f0e17] flex items-center justify-center text-sm font-black text-[#0f0e17]">AI</div>
                <div>
                    <p class="judul-komik text-lg text-white leading-none">ASISTEN GELAR</p>
                    <p class="text-blue-200 text-xs font-bold">Siap membantu!</p>
                </div>
            </div>
            <button @click="terbuka=false" class="text-white hover:text-[#ffd60a] transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        {{-- Pesan --}}
        <div class="flex-1 overflow-y-auto p-4 space-y-3 max-h-72" id="kotak-pesan-ai">
            <template x-for="pesan in riwayatPesan" :key="pesan.id">
                <div :class="pesan.dari === 'ai' ? 'flex justify-start' : 'flex justify-end'">
                    <div :class="pesan.dari === 'ai' ? 'pesan-ai-masuk' : 'pesan-ai-keluar'"
                         x-html="pesan.teks"></div>
                </div>
            </template>
            <div x-show="sedangMenulis" class="flex justify-start">
                <div class="pesan-ai-masuk flex items-center gap-1">
                    <span class="w-2 h-2 bg-[#4361ee] rounded-full animate-bounce"></span>
                    <span class="w-2 h-2 bg-[#4361ee] rounded-full animate-bounce" style="animation-delay:.15s"></span>
                    <span class="w-2 h-2 bg-[#4361ee] rounded-full animate-bounce" style="animation-delay:.3s"></span>
                </div>
            </div>
        </div>

        {{-- Pertanyaan Cepat --}}
        <div class="px-3 py-2 border-t border-gray-100 flex flex-wrap gap-1.5">
            <template x-for="q in pertanyaanCepat" :key="q">
                <button @click="kirimPesan(q)"
                        class="text-xs px-2.5 py-1 rounded-lg border-2 border-[#4361ee] text-[#4361ee] font-bold hover:bg-[#4361ee] hover:text-white transition-all">
                    <span x-text="q"></span>
                </button>
            </template>
        </div>

        {{-- Input --}}
        <div class="p-3 border-t-2 border-[#0f0e17] flex gap-2">
            <input type="text" x-model="inputPesan"
                   @keyup.enter="kirimPesan(inputPesan)"
                   placeholder="Tanya sesuatu..."
                   class="flex-1 text-xs px-3 py-2 rounded-xl border-2 border-[#0f0e17] focus:outline-none focus:border-[#4361ee] font-semibold">
            <button @click="kirimPesan(inputPesan)"
                    class="btn-komik px-3 py-2 bg-[#4361ee] text-white rounded-xl text-xs">
                <i data-lucide="send" class="w-4 h-4"></i>
            </button>
        </div>
    </div>

    {{-- Tombol Toggle --}}
    <button @click="terbuka = !terbuka"
            class="btn-komik w-14 h-14 rounded-2xl bg-[#4361ee] text-white flex items-center justify-center relative ml-auto">
        <i data-lucide="bot" class="w-7 h-7" x-show="!terbuka"></i>
        <i data-lucide="x" class="w-6 h-6" x-show="terbuka" x-cloak></i>
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-[#f72585] rounded-full border-2 border-white animate-pulse"></span>
    </button>
</div>

{{-- ===== SCRIPTS ===== --}}
<script>
// ========== INISIALISASI LUCIDE ==========
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
});

// ========== PAGE TRANSITION (SPA-like) ==========
const layarMuat = document.getElementById('layar-muat');

function tampilkanLayarMuat() {
    layarMuat.style.opacity = '1';
    layarMuat.style.pointerEvents = 'all';
}
function sembunyikanLayarMuat() {
    layarMuat.style.opacity = '0';
    layarMuat.style.pointerEvents = 'none';
}

// Intercept semua link dengan data-tautan-spa
document.addEventListener('click', (e) => {
    const tautan = e.target.closest('[data-tautan-spa]');
    if (!tautan) return;
    const href = tautan.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('http') || href.startsWith('mailto') || href.startsWith('tel')) return;
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

    e.preventDefault();

    // Animasi keluar super cepat (100ms) lalu navigasi
    gsap.to('#konten-utama', {
        opacity: 0, y: -15, duration: 0.15, ease: 'power2.in',
        onComplete: () => {
            window.location.href = href;
        }
    });
}, true);

// Muncul saat halaman load — INSTANT, tidak ada delay black screen
window.addEventListener('pageshow', (e) => {
    // Sembunyikan loading screen langsung
    sembunyikanLayarMuat();

    // Fade in konten dengan cepat
    const konten = document.getElementById('konten-utama');
    if (konten) {
        konten.style.opacity = '0';
        konten.style.transform = 'translateY(20px)';
        requestAnimationFrame(() => {
            gsap.to(konten, {
                opacity: 1, y: 0, duration: 0.35, ease: 'power2.out'
            });
        });
    }

    // Re-init Lucide setiap halaman
    if (typeof lucide !== 'undefined') lucide.createIcons();
    inisialisasiAnimasiScroll();
});

// Fallback: sembunyikan loading saat DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    sembunyikanLayarMuat();
    if (typeof lucide !== 'undefined') lucide.createIcons();
});

// ========== ANIMASI SCROLL REVEAL ==========
function inisialisasiAnimasiScroll() {
    gsap.registerPlugin(ScrollTrigger);

    // Semua elemen dengan class akan-muncul
    gsap.utils.toArray('.akan-muncul').forEach((el, i) => {
        gsap.fromTo(el,
            { opacity: 0, y: 50 },
            {
                opacity: 1, y: 0,
                duration: 0.7,
                ease: 'power3.out',
                delay: (i % 4) * 0.1,
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    toggleActions: 'play none none none',
                }
            }
        );
        el.classList.add('sudah-muncul');
    });

    // Counter animasi
    document.querySelectorAll('[data-hitung]').forEach(el => {
        const target = parseInt(el.getAttribute('data-hitung'));
        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                let obj = { nilai: 0 };
                gsap.to(obj, {
                    nilai: target,
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: () => {
                        el.textContent = Math.round(obj.nilai).toLocaleString('id-ID');
                    }
                });
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    inisialisasiAnimasiScroll();
    // Auto-hide flash
    setTimeout(() => {
        ['flash-sukses','flash-galat'].forEach(id => {
            const el = document.getElementById(id);
            if (el) gsap.to(el, { opacity: 0, height: 0, duration: 0.5, delay: 0, onComplete: () => el.remove() });
        });
    }, 4000);
});

// ========== AI ASISTEN ==========
function aiAsisten() {
    return {
        terbuka: false,
        inputPesan: '',
        sedangMenulis: false,
        riwayatPesan: [
            {
                id: 1,
                dari: 'ai',
                teks: '👋 Halo! Saya <strong>Asisten Gelar.id</strong>. Ada yang bisa saya bantu tentang kampus virtual ini?'
            }
        ],
        pertanyaanCepat: ['Apa itu Gelar.id?', 'Gelar apa saja?', 'Cara daftar?', 'Ada yang gratis?'],

        pengetahuan: {
            'gelar.id': 'Gelar.id adalah platform <strong>Kampus Virtual Indonesia</strong> yang menyediakan program pendidikan online berkualitas. Kami menawarkan gelar mulai dari K1 (3 bulan) hingga KVT.Kom (4 tahun/144 SKS)! 🎓',
            'gelar apa': 'Ada <strong>10 jenis gelar</strong>:<br>🎓 <strong>Sarjana:</strong> KVT.Kom (144 SKS), VT.Kom (120 SKS)<br>💼 <strong>Vokasi:</strong> VTA.Kom (108 SKS), V.Com (96 SKS)<br>📜 <strong>Diploma:</strong> K1 s/d K6 (18-108 SKS)',
            'cara daftar': 'Mudah! <strong>3 langkah:</strong><br>1️⃣ Klik <strong>Daftar Gratis</strong> di navbar<br>2️⃣ Isi nama, email, username & password<br>3️⃣ Pilih program dan mulai belajar! 🚀',
            'gratis': 'Ya! Program <strong>K1 Literasi Digital Dasar</strong> tersedia <strong>GRATIS</strong> untuk WNI yang belum pernah ikut sebelumnya. Ada juga promo diskon berkala! 🆓',
            'harga': 'Harga mulai dari <strong>Rp 0 (Gratis)</strong> untuk K1, hingga <strong>Rp 3.000.000</strong> untuk KVT.Kom per semester. Cek halaman Program untuk detail lengkap! 💰',
            'sertifikat': 'Sertifikat diterbitkan <strong>otomatis</strong> setelah menyelesaikan program. Bisa diverifikasi online di <strong>/verifikasi</strong> menggunakan kode unik. Sertifikat termasuk nama gelar, IPK, dan predikat! 🏆',
            'kvt.kom': '<strong>KVT.Kom</strong> (Komputer Virtual Terapan) adalah gelar tertinggi kami, setara D4/Sarjana Terapan. Durasi 4 tahun (8 semester, 144 SKS). Prospek: Software Engineer, Cyber Security, Cloud Architect! ⚡',
            'k1': '<strong>K1</strong> adalah level diploma dasar (18 SKS, 3 bulan). Isi kurikulum: komputer dasar, internet aman, email, media sosial, keamanan digital. <strong>GRATIS untuk WNI</strong>! 🆓',
            'pertemuan': 'Tersedia fitur <strong>Pertemuan Online</strong> dengan Zoom, Google Meet, MS Teams, atau ruangan internal. Admin bisa jadwalkan dan mahasiswa bisa bergabung langsung dari dashboard! 🎥',
            'kuesioner': 'Ada berbagai kuesioner: Pra-kelas, Pasca-kelas, Ujian, dan Kepuasan. Dilengkapi timer, nilai otomatis, dan hasil langsung bisa dilihat setelah submit! 📋',
            'default': 'Maaf, saya belum tahu jawabannya. Silakan cek halaman <a href="/program" class="text-blue-600 font-bold underline">Program</a> atau <a href="/gelar" class="text-blue-600 font-bold underline">Jenis Gelar</a> untuk info lebih lengkap! 😊',
        },

        cariJawaban(pertanyaan) {
            const q = pertanyaan.toLowerCase();
            for (const [kunci, jawaban] of Object.entries(this.pengetahuan)) {
                if (kunci !== 'default' && q.includes(kunci)) return jawaban;
            }
            return this.pengetahuan['default'];
        },

        async kirimPesan(teks) {
            if (!teks || !teks.trim()) return;
            this.inputPesan = '';

            // Tambah pesan user
            this.riwayatPesan.push({ id: Date.now(), dari: 'user', teks: teks });

            // Scroll ke bawah
            this.$nextTick(() => {
                const kotak = document.getElementById('kotak-pesan-ai');
                if (kotak) kotak.scrollTop = kotak.scrollHeight;
            });

            // Tampilkan typing indicator
            this.sedangMenulis = true;

            // Delay simulasi AI berpikir
            await new Promise(r => setTimeout(r, 800 + Math.random() * 600));

            this.sedangMenulis = false;
            const jawaban = this.cariJawaban(teks);
            this.riwayatPesan.push({ id: Date.now() + 1, dari: 'ai', teks: jawaban });

            // Update icon lucide di chat
            this.$nextTick(() => {
                const kotak = document.getElementById('kotak-pesan-ai');
                if (kotak) kotak.scrollTop = kotak.scrollHeight;
                lucide.createIcons();
            });
        }
    }
}
</script>
@stack('skrip')
</body>
</html>
