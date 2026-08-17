<!DOCTYPE html>
<html lang="id" x-data="aplikasiGelar()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('judul', 'Gelar.id') — Kampus Virtual Indonesia</title>
    <meta name="description" content="Platform kampus virtual Indonesia. Raih gelar KVT.Kom, VT.Kom, VTA.Kom, V.Com dan K1-K6 secara online.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Nunito:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
    tailwind.config = {
        theme: { extend: {
            fontFamily: { sans:['Nunito','sans-serif'], komik:['Bangers','cursive'], mono:['JetBrains Mono','monospace'] },
            colors: { hitam:'#0f0e17', biru:'#4361ee', ungu:'#7209b7', merah:'#f72585', hijau:'#06d6a0', kuning:'#ffd60a', abu:'#f0f4ff' }
        }}
    }
    </script>
    <style>
        :root{--hitam:#0f0e17;--biru:#4361ee;--ungu:#7209b7;--merah:#f72585;--hijau:#06d6a0;--kuning:#ffd60a;}
        *{box-sizing:border-box;}
        html{scroll-behavior:smooth;}
        body{font-family:'Nunito',sans-serif;background:#f8f9ff;color:#0f0e17;overflow-x:hidden;}
        .judul-komik{font-family:'Bangers',cursive;letter-spacing:2px;}
        .kartu-komik{background:white;border:3px solid var(--hitam);box-shadow:6px 6px 0 var(--hitam);border-radius:16px;transition:transform .15s ease,box-shadow .15s ease;}
        .kartu-komik:hover{transform:translate(-3px,-3px);box-shadow:9px 9px 0 var(--hitam);}
        .btn-komik{border:2px solid var(--hitam);box-shadow:4px 4px 0 var(--hitam);font-weight:800;transition:transform .1s ease,box-shadow .1s ease;display:inline-flex;align-items:center;justify-content:center;gap:6px;cursor:pointer;}
        .btn-komik:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--hitam);}
        .btn-komik:active{transform:translate(2px,2px);box-shadow:2px 2px 0 var(--hitam);}
        .badge-komik{border:2px solid var(--hitam);box-shadow:2px 2px 0 var(--hitam);font-weight:800;font-size:11px;padding:2px 10px;border-radius:6px;display:inline-block;}
        .input-komik{border:2px solid var(--hitam);box-shadow:3px 3px 0 var(--hitam);border-radius:10px;font-weight:700;padding:10px 14px;width:100%;background:white;transition:border-color .15s,box-shadow .15s;}
        .input-komik:focus{outline:none;border-color:var(--biru);box-shadow:3px 3px 0 var(--biru);}
        .halftone{background-color:var(--biru);background-image:radial-gradient(#ffffff18 1px,transparent 1px);background-size:14px 14px;position:relative;overflow:hidden;}
        .pesan-sukses{background:var(--hijau);border:3px solid var(--hitam);box-shadow:4px 4px 0 var(--hitam);color:var(--hitam);font-weight:800;}
        .pesan-galat{background:var(--merah);border:3px solid var(--hitam);box-shadow:4px 4px 0 var(--hitam);color:white;font-weight:800;}
        .akan-muncul{opacity:0;transform:translateY(40px);}
        .sudah-muncul{opacity:1;transform:translateY(0);transition:opacity .7s ease,transform .7s ease;}
        .navbar-komik{background:white;border-bottom:3px solid var(--hitam);position:sticky;top:0;z-index:100;}
        .nav-dropdown{position:absolute;top:calc(100% + 8px);left:0;min-width:220px;background:white;border:3px solid var(--hitam);box-shadow:6px 6px 0 var(--hitam);border-radius:14px;padding:8px;z-index:200;}
        .nav-dropdown a{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;font-weight:800;font-size:13px;color:#0f0e17;transition:background .15s;}
        .nav-dropdown a:hover{background:#f0f4ff;color:var(--biru);}
        .angka-hitung{font-variant-numeric:tabular-nums;}
        .badge-diskon{background:var(--merah);color:white;border:2px solid var(--hitam);box-shadow:2px 2px 0 var(--hitam);font-weight:900;font-size:12px;padding:2px 8px;border-radius:6px;}
        .harga-coret{text-decoration:line-through;color:#94a3b8;font-weight:600;font-size:13px;}
        .skeleton{background:linear-gradient(90deg,#f0f4ff 25%,#e8eeff 50%,#f0f4ff 75%);background-size:200% 100%;animation:kilas 1.5s infinite;border-radius:8px;}
        @keyframes kilas{0%{background-position:200% 0}100%{background-position:-200% 0}}
        ::-webkit-scrollbar{width:6px;}
        ::-webkit-scrollbar-track{background:#f0f4ff;}
        ::-webkit-scrollbar-thumb{background:var(--biru);border-radius:3px;}
        /* AI Chat */
        #ai-asisten{position:fixed;bottom:24px;right:24px;z-index:500;}
        .gelembung-ai{background:white;border:3px solid var(--hitam);box-shadow:6px 6px 0 var(--hitam);border-radius:20px;width:360px;max-height:560px;display:flex;flex-direction:column;overflow:hidden;}
        .pesan-ai-masuk{background:#f0f4ff;border:2px solid #4361ee22;border-radius:12px 12px 12px 4px;padding:10px 14px;font-size:13px;font-weight:600;max-width:85%;align-self:flex-start;}
        .pesan-ai-keluar{background:var(--biru);color:white;border:2px solid var(--hitam);border-radius:12px 12px 4px 12px;padding:10px 14px;font-size:13px;font-weight:600;max-width:85%;align-self:flex-end;}
        /* Karakter AI — crop dari strip 4 ekspresi */
        .karakter-ai-wajah{
            width:56px;height:56px;border-radius:50%;
            overflow:hidden;border:3px solid var(--hitam);box-shadow:3px 3px 0 var(--hitam);
            flex-shrink:0;background:#f0f4ff;
        }
        .karakter-ai-wajah img{
            width:400%;height:100%;object-fit:cover;
            transition:transform .3s ease;
        }
        /* Posisi ekspresi: normal=0, senang=25%, wow=50%, tunjuk=75% */
        .ekspresi-0 img{transform:translateX(0%);}
        .ekspresi-1 img{transform:translateX(-25%);}
        .ekspresi-2 img{transform:translateX(-50%);}
        .ekspresi-3 img{transform:translateX(-75%);}
        /* Tombol trigger karakter */
        .tombol-karakter{
            position:relative;width:64px;height:64px;
            border-radius:20px;overflow:visible;
        }
        .tombol-karakter-inner{
            width:64px;height:64px;border-radius:20px;
            border:3px solid var(--hitam);box-shadow:4px 4px 0 var(--hitam);
            overflow:hidden;cursor:pointer;
            transition:transform .15s ease,box-shadow .15s ease;
            background:linear-gradient(135deg,#7209b7,#4361ee);
        }
        .tombol-karakter-inner:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--hitam);}
        .tombol-karakter-inner:active{transform:translate(1px,1px);box-shadow:2px 2px 0 var(--hitam);}
        .tombol-karakter-inner img{width:280%;height:100%;object-fit:cover;object-position:0 0;transition:opacity .2s;}
        .tombol-karakter .notif-dot{
            position:absolute;top:-4px;right:-4px;
            width:18px;height:18px;background:var(--merah);
            border-radius:50%;border:2.5px solid white;
            animation:denyut 1.5s ease-in-out infinite;
        }
        @keyframes denyut{0%,100%{transform:scale(1);}50%{transform:scale(1.2);}}
        /* Onboarding */
        #onboarding-overlay{position:fixed;inset:0;z-index:9990;background:rgba(15,14,23,.9);backdrop-filter:blur(6px);}
        .onboarding-kartu{background:white;border:4px solid var(--hitam);box-shadow:10px 10px 0 var(--hitam);border-radius:24px;max-width:540px;width:100%;margin:auto;}
        @media(max-width:768px){.kartu-komik:hover{transform:none;box-shadow:6px 6px 0 var(--hitam);}}
        [x-cloak]{display:none!important;}
    </style>
    @stack('gaya')
</head>
<body class="font-sans">

{{-- ===== LAYAR TRANSISI ===== --}}
<div id="layar-muat" style="position:fixed;inset:0;z-index:9999;background:#0f0e17;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .25s;">
    <div class="text-center">
        <div class="judul-komik text-5xl text-white mb-5">GELAR<span class="text-[#4361ee]">.id</span></div>
        <div style="display:flex;gap:10px;justify-content:center;">
            <span style="width:12px;height:12px;border-radius:50%;background:#4361ee;animation:lonjak .6s ease-in-out infinite alternate;display:block;"></span>
            <span style="width:12px;height:12px;border-radius:50%;background:#f72585;animation:lonjak .6s ease-in-out infinite alternate;animation-delay:.15s;display:block;"></span>
            <span style="width:12px;height:12px;border-radius:50%;background:#ffd60a;animation:lonjak .6s ease-in-out infinite alternate;animation-delay:.3s;display:block;"></span>
        </div>
    </div>
</div>
<style>@keyframes lonjak{from{transform:translateY(0)}to{transform:translateY(-14px)}}</style>

{{-- ===== NAVBAR ===== --}}
<nav class="navbar-komik" x-data="navbarGelar()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 group" data-tautan-spa>
                <div class="w-10 h-10 rounded-xl bg-[#4361ee] border-[3px] border-[#0f0e17] shadow-[3px_3px_0_#0f0e17] flex items-center justify-center group-hover:-translate-y-1 transition-transform">
                    <span class="judul-komik text-white text-lg leading-none">G</span>
                </div>
                <span class="judul-komik text-2xl text-[#0f0e17] tracking-wider hidden sm:block">GELAR<span class="text-[#4361ee]">.id</span></span>
            </a>

            {{-- Nav Desktop --}}
            <div class="hidden md:flex items-center gap-0.5">
                <a href="/" data-tautan-spa class="flex items-center gap-1.5 px-3 py-2 rounded-xl font-bold text-sm text-[#0f0e17] hover:bg-[#4361ee] hover:text-white transition-all duration-200">
                    <i data-lucide="home" class="w-4 h-4"></i> Beranda
                </a>

                {{-- Dropdown Belajar --}}
                <div class="relative" @mouseenter="dropBelajar=true" @mouseleave="dropBelajar=false">
                    <button class="flex items-center gap-1.5 px-3 py-2 rounded-xl font-bold text-sm text-[#0f0e17] hover:bg-[#4361ee] hover:text-white transition-all duration-200"
                            :class="dropBelajar ? 'bg-[#4361ee] text-white' : ''">
                        <i data-lucide="book-open" class="w-4 h-4"></i> Belajar
                        <i data-lucide="chevron-down" class="w-3 h-3 transition-transform" :class="dropBelajar ? 'rotate-180':''"></i>
                    </button>
                    <div x-show="dropBelajar" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="nav-dropdown" x-cloak>
                        <a href="/gelar" data-tautan-spa><i data-lucide="graduation-cap" class="w-4 h-4 text-[#4361ee]"></i> Jenis Gelar (Kuliah)</a>
                        <a href="/program" data-tautan-spa><i data-lucide="book" class="w-4 h-4 text-[#f72585]"></i> Program Studi</a>
                        <div class="border-t-2 border-dashed border-gray-200 my-1.5"></div>
                        <a href="/kelas?jalur=sekolah" data-tautan-spa><i data-lucide="school" class="w-4 h-4 text-[#06d6a0]"></i> Kelas SD–SMA</a>
                        <a href="/kelas?jalur=kuliah" data-tautan-spa><i data-lucide="landmark" class="w-4 h-4 text-[#7209b7]"></i> Kelas Kampus Virtual</a>
                    </div>
                </div>

                {{-- Dropdown Tentang --}}
                <div class="relative" @mouseenter="dropTentang=true" @mouseleave="dropTentang=false">
                    <button class="flex items-center gap-1.5 px-3 py-2 rounded-xl font-bold text-sm text-[#0f0e17] hover:bg-[#4361ee] hover:text-white transition-all duration-200"
                            :class="dropTentang ? 'bg-[#4361ee] text-white' : ''">
                        <i data-lucide="info" class="w-4 h-4"></i> Tentang
                        <i data-lucide="chevron-down" class="w-3 h-3 transition-transform" :class="dropTentang ? 'rotate-180':''"></i>
                    </button>
                    <div x-show="dropTentang" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="nav-dropdown" x-cloak>
                        <a href="/pengajar" data-tautan-spa><i data-lucide="users" class="w-4 h-4 text-[#4361ee]"></i> Para Pengajar</a>
                        <a href="/tentang" data-tautan-spa><i data-lucide="info" class="w-4 h-4 text-[#ffd60a]"></i> Tentang Kami</a>
                        <a href="/statistik" data-tautan-spa><i data-lucide="bar-chart-2" class="w-4 h-4 text-[#06d6a0]"></i> Statistik</a>
                    </div>
                </div>

                <a href="/verifikasi" data-tautan-spa class="flex items-center gap-1.5 px-3 py-2 rounded-xl font-bold text-sm text-[#0f0e17] hover:bg-[#4361ee] hover:text-white transition-all duration-200">
                    <i data-lucide="shield-check" class="w-4 h-4"></i> Verifikasi
                </a>
                <a href="/analisis-minat" data-tautan-spa class="flex items-center gap-1.5 px-3 py-2 rounded-xl font-bold text-sm text-[#0f0e17] hover:bg-[#ffd60a] hover:text-[#0f0e17] transition-all duration-200">
                    <i data-lucide="sparkles" class="w-4 h-4"></i> Tes Minat
                </a>
            </div>

            {{-- Auth + Hamburger --}}
            <div class="flex items-center gap-2">
                @auth
                <div class="relative hidden md:block" @mouseenter="dropProfil=true" @mouseleave="dropProfil=false">
                    <button class="btn-komik px-3 py-2 bg-[#ffd60a] text-[#0f0e17] rounded-xl text-sm">
                        <div class="w-6 h-6 rounded-full bg-[#0f0e17] flex items-center justify-center text-white font-black text-xs">{{ strtoupper(substr(auth()->user()->nama,0,1)) }}</div>
                        <span class="max-w-[90px] truncate">{{ Str::limit(auth()->user()->nama,12) }}</span>
                        <i data-lucide="chevron-down" class="w-3 h-3" :class="dropProfil?'rotate-180':''"></i>
                    </button>
                    <div x-show="dropProfil" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="nav-dropdown right-0 left-auto" x-cloak>
                        <a href="{{ auth()->user()->isAdmin() ? '/admin/dasbor' : '/pengguna/dasbor' }}" data-tautan-spa>
                            <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#4361ee]"></i> Dasbor
                        </a>
                        @if(!auth()->user()->isAdmin())
                        <a href="/pengguna/profil" data-tautan-spa><i data-lucide="user" class="w-4 h-4 text-[#06d6a0]"></i> Profil Saya</a>
                        <a href="/pengguna/daftar-ku" data-tautan-spa><i data-lucide="bookmark" class="w-4 h-4 text-[#f72585]"></i> Daftar-ku</a>
                        <a href="/pengguna/sertifikat-ku" data-tautan-spa><i data-lucide="award" class="w-4 h-4 text-[#ffd60a]"></i> Sertifikat-ku</a>
                        <a href="/pengguna/pertemuan" data-tautan-spa><i data-lucide="video" class="w-4 h-4 text-[#7209b7]"></i> Pertemuan</a>
                        @endif
                        <div class="border-t-2 border-dashed border-gray-200 my-1.5"></div>
                        <form method="POST" action="/keluar">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl font-black text-sm text-[#f72585] hover:bg-red-50 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="/masuk" data-tautan-spa class="hidden md:flex btn-komik px-4 py-2 bg-white text-[#0f0e17] rounded-xl text-sm">
                    <i data-lucide="log-in" class="w-4 h-4"></i> Masuk
                </a>
                <a href="/daftar" data-tautan-spa class="btn-komik px-4 py-2 bg-[#4361ee] text-white rounded-xl text-sm">
                    <i data-lucide="rocket" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Daftar Gratis!</span>
                    <span class="sm:hidden">Daftar</span>
                </a>
                @endauth

                <button @click="menuMobil = !menuMobil" class="md:hidden btn-komik p-2.5 bg-white rounded-xl">
                    <i data-lucide="menu" class="w-5 h-5" x-show="!menuMobil"></i>
                    <i data-lucide="x" class="w-5 h-5" x-show="menuMobil" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Mobile --}}
    <div x-show="menuMobil" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-end="opacity-0" class="md:hidden border-t-2 border-[#0f0e17] bg-white px-4 py-3 space-y-1" x-cloak>
        <a href="/" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2.5 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="home" class="w-4 h-4 text-[#4361ee]"></i> Beranda</a>
        <p class="text-xs font-black text-gray-400 px-3 pt-2 uppercase tracking-wider">🎓 Belajar</p>
        <a href="/gelar" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="graduation-cap" class="w-4 h-4 text-[#4361ee]"></i> Jenis Gelar</a>
        <a href="/program" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="book" class="w-4 h-4 text-[#f72585]"></i> Program</a>
        <a href="/kelas?jalur=sekolah" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="school" class="w-4 h-4 text-[#06d6a0]"></i> Kelas SD–SMA</a>
        <a href="/kelas?jalur=kuliah" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="landmark" class="w-4 h-4 text-[#7209b7]"></i> Kelas Kampus Virtual</a>
        <p class="text-xs font-black text-gray-400 px-3 pt-2 uppercase tracking-wider">ℹ️ Tentang</p>
        <a href="/pengajar" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="users" class="w-4 h-4 text-[#4361ee]"></i> Pengajar</a>
        <a href="/tentang" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="info" class="w-4 h-4 text-[#ffd60a]"></i> Tentang Kami</a>
        <a href="/verifikasi" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="shield-check" class="w-4 h-4 text-[#06d6a0]"></i> Verifikasi</a>
        <a href="/analisis-minat" @click="menuMobil=false" data-tautan-spa class="flex items-center gap-2 py-2 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="sparkles" class="w-4 h-4 text-[#ffd60a]"></i> Tes Minat AI</a>
        @auth
        <div class="border-t border-gray-100 pt-2 mt-2 space-y-1">
            <a href="{{ auth()->user()->isAdmin() ? '/admin/dasbor' : '/pengguna/dasbor' }}" data-tautan-spa @click="menuMobil=false" class="flex items-center gap-2 py-2.5 px-3 rounded-xl font-bold text-[#0f0e17] hover:bg-[#f0f4ff]"><i data-lucide="layout-dashboard" class="w-4 h-4 text-[#4361ee]"></i> Dasbor</a>
            <form method="POST" action="/keluar">@csrf<button type="submit" class="w-full flex items-center gap-2 py-2.5 px-3 rounded-xl font-bold text-[#f72585] hover:bg-red-50"><i data-lucide="log-out" class="w-4 h-4"></i> Keluar</button></form>
        </div>
        @endauth
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('sukses'))
<div id="flash-sukses" class="max-w-7xl mx-auto px-4 pt-4">
    <div class="pesan-sukses px-5 py-3 rounded-xl flex items-center gap-3 text-sm">
        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>{{ session('sukses') }}
    </div>
</div>
@endif
@if(session('galat'))
<div id="flash-galat" class="max-w-7xl mx-auto px-4 pt-4">
    <div class="pesan-galat px-5 py-3 rounded-xl flex items-center gap-3 text-sm">
        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>{{ session('galat') }}
    </div>
</div>
@endif

<main id="konten-utama">@yield('konten')</main>

{{-- ===== FOOTER ===== --}}
<footer class="bg-[#0f0e17] text-white mt-20 border-t-4 border-[#4361ee]">
    <div class="max-w-7xl mx-auto px-4 py-14">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 mb-10">

            {{-- Brand --}}
            <div class="lg:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-11 h-11 rounded-xl bg-[#4361ee] border-[3px] border-[#4361ee] flex items-center justify-center">
                        <span class="judul-komik text-white text-xl">G</span>
                    </div>
                    <span class="judul-komik text-3xl tracking-wider">GELAR<span class="text-[#4361ee]">.id</span></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs font-semibold mb-4">
                    Platform Kampus Virtual Indonesia. Raih gelar KVT.Kom, VT.Kom, VTA.Kom, V.Com dan K1–K6 secara online dengan kurikulum industri nyata.
                </p>
                <div class="flex gap-2.5 flex-wrap">
                    <a href="https://instagram.com" target="_blank" class="w-9 h-9 rounded-xl flex items-center justify-center border-2 border-gray-700 hover:bg-[#f72585] hover:border-[#f72585] transition-all group"><i data-lucide="instagram" class="w-4 h-4 text-gray-500 group-hover:text-white"></i></a>
                    <a href="https://twitter.com" target="_blank" class="w-9 h-9 rounded-xl flex items-center justify-center border-2 border-gray-700 hover:bg-[#4361ee] hover:border-[#4361ee] transition-all group"><i data-lucide="twitter" class="w-4 h-4 text-gray-500 group-hover:text-white"></i></a>
                    <a href="https://youtube.com" target="_blank" class="w-9 h-9 rounded-xl flex items-center justify-center border-2 border-gray-700 hover:bg-red-600 hover:border-red-600 transition-all group"><i data-lucide="youtube" class="w-4 h-4 text-gray-500 group-hover:text-white"></i></a>
                    <a href="https://linkedin.com" target="_blank" class="w-9 h-9 rounded-xl flex items-center justify-center border-2 border-gray-700 hover:bg-[#0077b5] hover:border-[#0077b5] transition-all group"><i data-lucide="linkedin" class="w-4 h-4 text-gray-500 group-hover:text-white"></i></a>
                    <a href="https://wa.me/62" target="_blank" class="w-9 h-9 rounded-xl flex items-center justify-center border-2 border-gray-700 hover:bg-green-500 hover:border-green-500 transition-all group"><i data-lucide="message-circle" class="w-4 h-4 text-gray-500 group-hover:text-white"></i></a>
                </div>
            </div>

            {{-- Gelar --}}
            <div>
                <h4 class="judul-komik text-xl text-[#ffd60a] mb-4 tracking-wide">🎓 GELAR</h4>
                <ul class="space-y-2 text-sm">
                    @foreach([['KVT.Kom','Sarjana Virtual Terapan'],['VT.Kom','Sarjana Virtual'],['VTA.Kom','Vokasi Terapan'],['V.Com','Vokasi Virtual'],['K1 — K6','Diploma Virtual']] as $g)
                    <li><a href="/gelar" data-tautan-spa class="text-gray-400 hover:text-white font-semibold transition-colors flex items-center gap-1.5"><span class="text-[#4361ee]">→</span>{{ $g[0] }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Kelas --}}
            <div>
                <h4 class="judul-komik text-xl text-[#ffd60a] mb-4 tracking-wide">📚 KELAS</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/kelas?jalur=sekolah&tingkat=sd" data-tautan-spa class="text-gray-400 hover:text-white font-semibold transition-colors flex items-center gap-1.5"><span class="text-[#EF4444]">→</span> Kelas SD</a></li>
                    <li><a href="/kelas?jalur=sekolah&tingkat=smp" data-tautan-spa class="text-gray-400 hover:text-white font-semibold transition-colors flex items-center gap-1.5"><span class="text-[#F59E0B]">→</span> Kelas SMP</a></li>
                    <li><a href="/kelas?jalur=sekolah&tingkat=sma" data-tautan-spa class="text-gray-400 hover:text-white font-semibold transition-colors flex items-center gap-1.5"><span class="text-[#4361ee]">→</span> Kelas SMA</a></li>
                    <li><a href="/kelas?jalur=kuliah" data-tautan-spa class="text-gray-400 hover:text-white font-semibold transition-colors flex items-center gap-1.5"><span class="text-[#7209b7]">→</span> Kampus Virtual</a></li>
                    <li><a href="/program?gelar=K1" data-tautan-spa class="text-[#06d6a0] hover:text-white font-black transition-colors flex items-center gap-1.5"><span>→</span> K1 Gratis!</a></li>
                </ul>
            </div>

            {{-- Tautan --}}
            <div>
                <h4 class="judul-komik text-xl text-[#ffd60a] mb-4 tracking-wide">🔗 TAUTAN</h4>
                <ul class="space-y-2 text-sm">
                    @foreach([['/program','Program Studi'],['/pengajar','Para Pengajar'],['/analisis-minat','Tes Minat AI'],['/verifikasi','Verifikasi Sertifikat'],['/tentang','Tentang Kami'],['/masuk','Masuk'],['/daftar','Daftar Gratis']] as $l)
                    <li><a href="{{ $l[0] }}" data-tautan-spa class="text-gray-400 hover:text-white font-semibold transition-colors flex items-center gap-1.5"><span class="text-[#4361ee]">→</span>{{ $l[1] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Newsletter strip --}}
        <div class="bg-[#1a1a2e] rounded-2xl p-6 mb-8 border-2 border-gray-800">
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <div class="flex-1">
                    <p class="judul-komik text-2xl text-white">📬 INFO TERBARU</p>
                    <p class="text-gray-400 text-sm font-semibold">Dapatkan notifikasi promo & kelas baru</p>
                </div>
                <div class="flex gap-2 w-full sm:w-auto">
                    <input type="email" placeholder="email@anda.com" class="flex-1 sm:w-56 px-4 py-2.5 rounded-xl border-2 border-gray-700 bg-[#0f0e17] text-white text-sm font-semibold focus:outline-none focus:border-[#4361ee]">
                    <button class="btn-komik px-5 py-2.5 bg-[#4361ee] text-white rounded-xl text-sm whitespace-nowrap">Langganan</button>
                </div>
            </div>
        </div>

        <div class="border-t-2 border-gray-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-sm text-gray-500 font-bold">&copy; {{ date('Y') }} GELAR.id — Platform Kampus Virtual Indonesia 🎓</p>
            <div class="flex items-center gap-4 text-xs text-gray-600 font-semibold">
                <a href="/tentang" data-tautan-spa class="hover:text-gray-400">Tentang</a>
                <span>·</span>
                <a href="/verifikasi" data-tautan-spa class="hover:text-gray-400">Verifikasi</a>
                <span>·</span>
                <span>Made with ❤️ in Indonesia</span>
            </div>
        </div>
    </div>
</footer>

{{-- ===== FLOATING AI ASISTEN (dengan Karakter) ===== --}}
<div id="ai-asisten" x-data="aiGemini()">

    {{-- Gelembung chat --}}
    <div x-show="terbuka"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-end="opacity-0 scale-90 translate-y-4"
         class="gelembung-ai mb-3" x-cloak>

        {{-- Header dengan karakter --}}
        <div class="flex items-center justify-between px-4 py-3"
             style="background:linear-gradient(135deg,#7209b7 0%,#4361ee 100%);">
            <div class="flex items-center gap-3">
                {{-- Wajah karakter dengan ekspresi dinamis --}}
                <div class="karakter-ai-wajah" :class="'ekspresi-' + ekspresi">
                    <img src="/gambar/karakter-ekspresi.png" alt="Asisten AI" draggable="false">
                </div>
                <div>
                    <p class="judul-komik text-xl text-white leading-none tracking-wide">GELA</p>
                    <p class="text-purple-200 text-xs font-bold" x-text="statusTeks"></p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button @click="resetChat()" title="Reset chat"
                        class="text-purple-200 hover:text-white transition-colors p-1">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                </button>
                <button @click="terbuka=false"
                        class="text-white hover:text-[#ffd60a] transition-colors p-1">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        {{-- Area pesan --}}
        <div class="flex-1 overflow-y-auto p-4 space-y-3 max-h-72" id="kotak-pesan-ai">
            <template x-for="pesan in riwayat" :key="pesan.id">
                <div :class="pesan.dari === 'ai' ? 'flex justify-start items-end gap-2' : 'flex justify-end'">
                    {{-- Avatar mini untuk pesan AI --}}
                    <div x-show="pesan.dari === 'ai'"
                         class="w-7 h-7 rounded-full overflow-hidden flex-shrink-0 border-2 border-[#7209b7]"
                         style="background:#f0f4ff;">
                        <img src="/gambar/karakter-ekspresi.png" alt="AI"
                             class="w-[400%] h-full object-cover" style="margin-left:0">
                    </div>
                    <div :class="pesan.dari === 'ai' ? 'pesan-ai-masuk' : 'pesan-ai-keluar'"
                         x-html="pesan.teks"></div>
                </div>
            </template>
            {{-- Typing indicator --}}
            <div x-show="mengetik" class="flex justify-start items-end gap-2">
                <div class="w-7 h-7 rounded-full overflow-hidden flex-shrink-0 border-2 border-[#7209b7]"
                     style="background:#f0f4ff;">
                    <img src="/gambar/karakter-ekspresi.png" alt="AI"
                         class="w-[400%] h-full object-cover" style="margin-left:0">
                </div>
                <div class="pesan-ai-masuk flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-[#7209b7] rounded-full animate-bounce"></span>
                    <span class="w-2 h-2 bg-[#4361ee] rounded-full animate-bounce" style="animation-delay:.15s"></span>
                    <span class="w-2 h-2 bg-[#f72585] rounded-full animate-bounce" style="animation-delay:.3s"></span>
                </div>
            </div>
        </div>

        {{-- Pertanyaan cepat --}}
        <div class="px-3 py-2 border-t border-gray-100 flex flex-wrap gap-1.5">
            <template x-for="q in pertanyaanCepat" :key="q">
                <button @click="kirim(q)"
                        class="text-xs px-2.5 py-1 rounded-lg border-2 border-[#7209b7] text-[#7209b7] font-bold hover:bg-[#7209b7] hover:text-white transition-all">
                    <span x-text="q"></span>
                </button>
            </template>
        </div>

        {{-- Input --}}
        <div class="p-3 border-t-2 border-[#0f0e17] flex gap-2">
            <input type="text" x-model="input"
                   @keyup.enter="kirim(input)"
                   @focus="ekspresi=3"
                   @blur="ekspresi=0"
                   placeholder="Tanya Gela sesuatu..."
                   class="flex-1 text-xs px-3 py-2 rounded-xl border-2 border-[#0f0e17] focus:outline-none focus:border-[#7209b7] font-semibold">
            <button @click="kirim(input)" :disabled="mengetik"
                    class="btn-komik px-3 py-2 rounded-xl text-xs text-white"
                    style="background:linear-gradient(135deg,#7209b7,#4361ee)">
                <i data-lucide="send" class="w-4 h-4"></i>
            </button>
        </div>
    </div>

    {{-- Tombol toggle dengan karakter --}}
    <div class="tombol-karakter ml-auto" @click="terbuka = !terbuka">
        <div class="tombol-karakter-inner" x-show="!terbuka">
            <img src="/gambar/karakter-ekspresi.png" alt="Gela AI"
                 style="width:400%;height:100%;object-fit:cover;object-position:0 0;"
                 draggable="false">
        </div>
        <div class="tombol-karakter-inner flex items-center justify-center" x-show="terbuka" x-cloak>
            <i data-lucide="x" class="w-7 h-7 text-white"></i>
        </div>
        <span class="notif-dot"></span>
    </div>
</div>

{{-- ===== ONBOARDING TOUR (dengan Karakter Fullbody) ===== --}}
@auth
@if(!session('onboarding_selesai') && !auth()->user()->isAdmin())
<div id="onboarding-overlay" x-data="onboardingTour()" x-show="aktif" x-cloak>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="onboarding-kartu relative overflow-visible">
            <div class="flex flex-col md:flex-row">

                {{-- Sisi kiri: karakter fullbody --}}
                <div class="hidden md:flex flex-col items-center justify-end w-48 flex-shrink-0 relative"
                     style="background:linear-gradient(180deg,#7209b722 0%,#4361ee22 100%);border-radius:24px 0 0 24px;border-right:3px solid #0f0e17;min-height:500px;">
                    <img src="/gambar/karakter-fullbody.png"
                         alt="Gela — Asisten GELAR.ID"
                         class="w-full object-contain object-bottom"
                         style="max-height:420px;filter:drop-shadow(0 0 20px #7209b755);">
                    <div class="absolute top-4 left-0 right-0 text-center">
                        <span class="judul-komik text-xl text-[#7209b7] tracking-widest">GELA</span>
                        <p class="text-xs font-black text-gray-500">Asisten GELAR.ID</p>
                    </div>
                </div>

                {{-- Sisi kanan: konten tour --}}
                <div class="flex-1 p-7 md:p-8">
                    {{-- Header mobile: wajah mini --}}
                    <div class="flex items-center gap-3 mb-5 md:hidden">
                        <div class="karakter-ai-wajah ekspresi-1" style="width:52px;height:52px;">
                            <img src="/gambar/karakter-ekspresi.png" alt="Gela">
                        </div>
                        <div>
                            <p class="judul-komik text-xl text-[#7209b7]">GELA</p>
                            <p class="text-xs font-black text-gray-500">Asisten GELAR.ID</p>
                        </div>
                    </div>

                    {{-- Progress bar --}}
                    <div class="flex gap-1.5 mb-6">
                        <template x-for="(l,i) in langkah" :key="i">
                            <div class="h-1.5 rounded-full flex-1 transition-all duration-500"
                                 :class="i <= langkahAktif ? 'bg-[#7209b7]' : 'bg-gray-200'"></div>
                        </template>
                    </div>

                    {{-- Konten per langkah --}}
                    <template x-for="(l,i) in langkah" :key="i">
                        <div x-show="langkahAktif === i"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-x-4"
                             x-transition:enter-end="opacity-100 translate-x-0">

                            {{-- Nomor langkah --}}
                            <div class="inline-flex items-center gap-2 mb-3">
                                <span class="w-7 h-7 rounded-full bg-[#7209b7] text-white text-xs font-black flex items-center justify-center border-2 border-[#0f0e17]"
                                      x-text="i+1"></span>
                                <span class="text-xs font-black text-gray-400 uppercase tracking-wider"
                                      x-text="'Langkah ' + (i+1) + ' dari ' + langkah.length"></span>
                            </div>

                            <h3 class="judul-komik text-3xl text-[#0f0e17] mb-3" x-text="l.judul"></h3>
                            <p class="text-gray-600 font-semibold leading-relaxed text-sm mb-5" x-html="l.isi"></p>

                            {{-- Tip box --}}
                            <div class="bg-[#f0f4ff] rounded-2xl px-4 py-3 border-2 border-[#e0e7ff] mb-6 flex items-start gap-2">
                                <span class="text-lg mt-0.5" x-text="l.ikonTip"></span>
                                <span class="text-xs font-bold text-[#4361ee] leading-relaxed" x-text="l.tip"></span>
                            </div>
                        </div>
                    </template>

                    {{-- Navigasi --}}
                    <div class="flex items-center justify-between pt-2 border-t-2 border-gray-100">
                        <button @click="sebelumnya()"
                                x-show="langkahAktif > 0"
                                class="btn-komik px-4 py-2.5 bg-gray-100 text-[#0f0e17] rounded-xl text-sm">
                            ← Kembali
                        </button>
                        <div x-show="langkahAktif === 0"></div>
                        <div class="flex gap-2">
                            <button @click="lewati()"
                                    class="text-sm font-bold text-gray-400 hover:text-gray-600 px-3 py-2 transition-colors">
                                Lewati
                            </button>
                            <button @click="berikutnya()"
                                    class="btn-komik px-6 py-2.5 text-white rounded-xl text-sm"
                                    style="background:linear-gradient(135deg,#7209b7,#4361ee)"
                                    x-text="langkahAktif === langkah.length-1 ? '🚀 Mulai Belajar!' : 'Lanjut →'">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endauth

{{-- ===== SCRIPTS ===== --}}
<script>
// Lucide init
document.addEventListener('DOMContentLoaded', () => { if(typeof lucide!=='undefined') lucide.createIcons(); });

// Page Transition
const layarMuat = document.getElementById('layar-muat');
function sembunyikanLayar() { layarMuat.style.opacity='0'; layarMuat.style.pointerEvents='none'; }

document.addEventListener('click', (e) => {
    const t = e.target.closest('[data-tautan-spa]');
    if (!t) return;
    const href = t.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('http') || href.startsWith('mailto') || href.startsWith('tel')) return;
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
    e.preventDefault();
    if (typeof gsap !== 'undefined') {
        gsap.to('#konten-utama', { opacity:0, y:-12, duration:0.15, ease:'power2.in', onComplete: () => { window.location.href = href; } });
    } else { window.location.href = href; }
}, true);

window.addEventListener('pageshow', () => {
    sembunyikanLayar();
    const k = document.getElementById('konten-utama');
    if (k && typeof gsap !== 'undefined') {
        k.style.opacity='0'; k.style.transform='translateY(18px)';
        requestAnimationFrame(() => gsap.to(k, { opacity:1, y:0, duration:0.3, ease:'power2.out' }));
    }
    if (typeof lucide !== 'undefined') lucide.createIcons();
    inisialisasiScroll();
});

document.addEventListener('DOMContentLoaded', () => {
    sembunyikanLayar();
    if (typeof lucide !== 'undefined') lucide.createIcons();
    setTimeout(() => {
        ['flash-sukses','flash-galat'].forEach(id => {
            const el = document.getElementById(id);
            if (el && typeof gsap !== 'undefined') gsap.to(el, { opacity:0, height:0, duration:.5, delay:0, onComplete:()=>el.remove() });
        });
    }, 4000);
});

// Scroll Reveal + Counter
function inisialisasiScroll() {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    gsap.registerPlugin(ScrollTrigger);
    gsap.utils.toArray('.akan-muncul').forEach((el,i) => {
        gsap.fromTo(el, { opacity:0, y:50 }, {
            opacity:1, y:0, duration:.7, ease:'power3.out', delay:(i%4)*.08,
            scrollTrigger: { trigger:el, start:'top 88%', toggleActions:'play none none none' }
        });
        el.classList.add('sudah-muncul');
    });
    document.querySelectorAll('[data-hitung]').forEach(el => {
        const target = parseInt(el.getAttribute('data-hitung'));
        ScrollTrigger.create({ trigger:el, start:'top 85%', once:true, onEnter:() => {
            let obj={nilai:0};
            gsap.to(obj, { nilai:target, duration:2, ease:'power2.out', onUpdate:() => {
                el.textContent = Math.round(obj.nilai).toLocaleString('id-ID');
            }});
        }});
    });
}
document.addEventListener('DOMContentLoaded', inisialisasiScroll);

// Alpine global state
function aplikasiGelar() { return {}; }

// Navbar Alpine
function navbarGelar() {
    return { menuMobil:false, dropBelajar:false, dropTentang:false, dropProfil:false };
}
</script>

<script>
// ===== AI GEMINI =====
function aiGemini() {
    return {
        terbuka: false,
        input: '',
        mengetik: false,
        ekspresi: 0, // 0=normal, 1=senang, 2=wow, 3=tunjuk
        statusTeks: 'Tanya apapun! ✨',
        riwayat: [{
            id: 1,
            dari: 'ai',
            teks: 'Hai! Saya <strong>Gela</strong>, asisten virtual GELAR.ID 🎓<br>Aku siap bantu kamu soal gelar, kelas, dan pendaftaran. Tanya apa saja!'
        }],
        pertanyaanCepat: ['Gelar apa saja?', 'Cara daftar?', 'Ada yang gratis?', 'Kelas SD–SMA?'],

        async kirim(teks) {
            if (!teks || !teks.trim() || this.mengetik) return;
            this.input = '';
            this.riwayat.push({ id: Date.now(), dari: 'user', teks: teks });
            this.scrollBawah();
            this.mengetik = true;
            this.ekspresi = 2; // ekspresi "wow" saat mengetik
            this.statusTeks = 'Gela sedang berpikir...';

            const apiKey = '{{ config("services.gemini.key","") }}';

            if (apiKey) {
                try {
                    const res = await fetch('/ai/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify({ pesan: teks })
                    });
                    const data = await res.json();
                    this.mengetik = false;
                    this.ekspresi = 1; // ekspresi "senang" setelah jawab
                    this.statusTeks = 'Siap membantu! 🌟';
                    this.riwayat.push({ id: Date.now() + 1, dari: 'ai', teks: data.jawaban || 'Maaf, tidak bisa menjawab sekarang.' });
                } catch (e) {
                    this.mengetik = false;
                    this.ekspresi = 0;
                    this.statusTeks = 'Tanya apapun! ✨';
                    this.riwayat.push({ id: Date.now() + 1, dari: 'ai', teks: this.jawabanLokal(teks) });
                }
            } else {
                await new Promise(r => setTimeout(r, 600 + Math.random() * 400));
                this.mengetik = false;
                const jawaban = this.jawabanLokal(teks);
                // Pilih ekspresi sesuai sentimen jawaban
                this.ekspresi = jawaban.includes('GRATIS') || jawaban.includes('gratis') ? 1 : 0;
                this.statusTeks = 'Siap membantu! 🌟';
                setTimeout(() => { this.ekspresi = 0; this.statusTeks = 'Tanya apapun! ✨'; }, 3000);
                this.riwayat.push({ id: Date.now() + 1, dari: 'ai', teks: jawaban });
            }
            this.scrollBawah();
            this.$nextTick(() => { if (typeof lucide !== 'undefined') lucide.createIcons(); });
        },

        jawabanLokal(q) {
            q = q.toLowerCase();
            const kb = {
                'gelar': 'Ada <strong>10 jenis gelar</strong>: KVT.Kom, VT.Kom, VTA.Kom, V.Com, K1–K6! 🎓<br>Dari 3 bulan (K1) hingga 4 tahun (KVT.Kom). <a href="/gelar" class="text-purple-600 underline font-bold">Lihat detail →</a>',
                'cara daftar': 'Gampang banget! 🚀<br>1. Klik <a href="/daftar" class="text-purple-600 underline font-bold">Daftar Gratis</a><br>2. Isi data atau pakai Google<br>3. Pilih program & mulai belajar!',
                'gratis': 'Kabar baik! <span class="text-green-600 font-black">K1 Literasi Digital GRATIS</span> untuk semua WNI 🆓<br>Beberapa kelas SD–SMP juga gratis. Yuk <a href="/program?gelar=K1" class="text-purple-600 underline font-bold">ambil sekarang!</a>',
                'harga': 'Mulai dari <strong>Rp 0</strong> (K1 gratis) hingga <strong>Rp 3jt/semester</strong> untuk KVT.Kom 💰<br><a href="/program" class="text-purple-600 underline font-bold">Lihat semua program →</a>',
                'sertifikat': 'Sertifikat terbit <strong>otomatis</strong> setelah lulus 🏆<br>Lengkap dengan kode verifikasi unik yang bisa dicek di <a href="/verifikasi" class="text-purple-600 underline font-bold">/verifikasi</a>.',
                'kelas sd': 'Ada kelas seru untuk SD! 🎒<br>Komputer dasar, menggambar digital, internet aman. <a href="/kelas?jalur=sekolah&tingkat=sd" class="text-purple-600 underline font-bold">Lihat kelas SD →</a>',
                'kelas smp': 'Kelas SMP mantap banget! 💻<br>Python coding, desain poster, digital marketing dasar. <a href="/kelas?jalur=sekolah&tingkat=smp" class="text-purple-600 underline font-bold">Lihat kelas SMP →</a>',
                'kelas sma': 'Kelas SMA super keren! 🔥<br>Web development, digital marketing, video editing. <a href="/kelas?jalur=sekolah&tingkat=sma" class="text-purple-600 underline font-bold">Lihat kelas SMA →</a>',
                'pengajar': 'Tim pengajar kami keren-keren! 👩‍🏫<br>Praktisi aktif dari industri tech & bisnis digital Indonesia. <a href="/pengajar" class="text-purple-600 underline font-bold">Kenalan yuk →</a>',
                'kvt': '<strong>KVT.Kom</strong> itu gelar tertinggi kami ⚡<br>Setara D4/Sarjana Terapan, 4 tahun, 144 SKS. Prospek: Software Engineer, Cyber Security, Cloud Architect!',
                'pertemuan': 'Ada fitur <strong>Pertemuan Online</strong> 🎥<br>Via Zoom, Google Meet, atau MS Teams. Join langsung dari dasbor!',
                'google': 'Bisa login pakai Google! 🔐<br>Klik <strong>"Lanjutkan dengan Google"</strong> di halaman <a href="/masuk" class="text-purple-600 underline font-bold">Masuk</a>. Praktis banget!',
            };
            for (const [k, v] of Object.entries(kb)) {
                if (q.includes(k)) return v;
            }
            return 'Hmm, aku belum tahu jawabannya 🤔<br>Coba cek <a href="/program" class="text-purple-600 underline font-bold">Program</a> atau <a href="/gelar" class="text-purple-600 underline font-bold">Gelar</a> kami ya! Atau hubungi admin 😊';
        },

        scrollBawah() {
            this.$nextTick(() => {
                const k = document.getElementById('kotak-pesan-ai');
                if (k) k.scrollTop = k.scrollHeight;
            });
        },

        resetChat() {
            this.riwayat = [{
                id: Date.now(),
                dari: 'ai',
                teks: 'Chat direset! Halo lagi, aku <strong>Gela</strong>! Ada yang bisa aku bantu? 😊'
            }];
            this.ekspresi = 1;
            setTimeout(() => { this.ekspresi = 0; }, 2000);
        }
    }
}

// ===== ONBOARDING =====
function onboardingTour() {
    return {
        aktif: true,
        langkahAktif: 0,
        langkah: [
            {
                judul: 'Selamat Datang di GELAR.ID!',
                isi: 'Halo! Aku <strong>Gela</strong>, asisten virtualmu di sini 👋<br>Platform <strong>Kampus Virtual Indonesia</strong> — raih gelar resmi secara online, dari mana saja!',
                tip: 'Akun kamu sudah aktif dan siap digunakan!',
                ikonTip: '💡'
            },
            {
                judul: 'Dua Jalur Belajar',
                isi: 'Ada 2 pilihan jalur:<br>🏫 <strong>Kelas Pelajar</strong> — untuk SD, SMP, SMA<br>🎓 <strong>Kampus Virtual</strong> — setara D1 hingga Sarjana Terapan',
                tip: 'Jalur K1 tersedia GRATIS untuk semua WNI! Tidak ada syarat pendidikan.',
                ikonTip: '📌'
            },
            {
                judul: 'Cara Mulai Belajar',
                isi: 'Pilih program → Klik <strong>Daftar Sekarang</strong> → Ikuti sesi belajar → Selesaikan semua sesi → <strong>Sertifikat terbit otomatis!</strong>',
                tip: 'Rata-rata waktu penyelesaian 3–6 bulan. Bisa belajar kapan saja!',
                ikonTip: '⏱️'
            },
            {
                judul: 'Aku Selalu Ada Untukmu!',
                isi: 'Lihat tombol karakter di pojok kanan bawah? Itu aku, <strong>Gela</strong>! 🤖<br>Klik kapanpun kamu butuh bantuan — tanya gelar, harga, cara daftar, apapun!',
                tip: 'Didukung Google Gemini AI — tanya apa saja, aku akan jawab!',
                ikonTip: '✨'
            },
            {
                judul: 'Pantau Progres & Sertifikat',
                isi: 'Di <strong>Dasbor</strong> kamu bisa lihat kemajuan belajar per sesi. Sertifikat bisa diverifikasi siapapun via <strong>/verifikasi</strong>.',
                tip: 'Selamat bergabung di GELAR.ID! Semangat belajar! 🎉',
                ikonTip: '🏆'
            },
        ],
        berikutnya() {
            if (this.langkahAktif < this.langkah.length - 1) {
                this.langkahAktif++;
            } else {
                this.selesai();
            }
        },
        sebelumnya() {
            if (this.langkahAktif > 0) this.langkahAktif--;
        },
        lewati() { this.selesai(); },
        selesai() {
            this.aktif = false;
            fetch('/onboarding/selesai', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
            });
        }
    }
}
</script>
@stack('skrip')
</body>
</html>
