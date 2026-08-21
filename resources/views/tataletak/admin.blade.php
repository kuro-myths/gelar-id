<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('judul','Dasbor') | Gelar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body{font-family:'Nunito',sans-serif;background:#f0f4ff;}
        .judul-komik{font-family:'Bangers',cursive;letter-spacing:2px;}
        .sidebar-link{display:flex;align-items:center;gap:10px;padding:9px 14px;border-radius:10px;font-size:13px;font-weight:800;color:#94a3b8;transition:all .15s;border:2px solid transparent;}
        .sidebar-link:hover{background:#1e3a8a;color:white;border-color:#4361ee;}
        .sidebar-link.aktif{background:#4361ee;color:white;border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;}
        .sidebar-link i{width:16px;text-align:center;}
        .komik-border{border:3px solid #1a1a2e;box-shadow:5px 5px 0 #1a1a2e;}
        .komik-border-sm{border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;}
        .btn-komik{border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;font-weight:800;transition:all .1s;display:inline-flex;align-items:center;gap:5px;}
        .btn-komik:hover{transform:translate(-1px,-1px);box-shadow:4px 4px 0 #1a1a2e;}
        .btn-komik:active{transform:translate(1px,1px);box-shadow:2px 2px 0 #1a1a2e;}
        .kartu-admin{background:white;border:3px solid #1a1a2e;box-shadow:5px 5px 0 #1a1a2e;border-radius:14px;}
        .input-komik{border:2px solid #1a1a2e;box-shadow:3px 3px 0 #1a1a2e;border-radius:10px;font-weight:700;width:100%;padding:10px 14px;}
        .input-komik:focus{outline:none;border-color:#4361ee;box-shadow:3px 3px 0 #4361ee;}
        .badge-komik{border:2px solid #1a1a2e;box-shadow:2px 2px 0 #1a1a2e;font-weight:800;font-size:11px;padding:2px 10px;border-radius:6px;display:inline-block;}
        .pesan-sukses{background:#06d6a0;border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;color:#1a1a2e;font-weight:800;}
        .pesan-galat{background:#f72585;border:3px solid #1a1a2e;box-shadow:4px 4px 0 #1a1a2e;color:white;font-weight:800;}
        /* Mobile responsive */
        @media(max-width:768px){
            aside{transform:translateX(-100%);transition:transform .3s;}
            aside.buka{transform:translateX(0);}
            .konten-utama{margin-left:0!important;}
        }
    </style>
</head>
<body class="min-h-screen flex">

<aside id="sidebar" class="w-64 min-h-screen bg-[#0f172a] flex flex-col fixed left-0 top-0 z-40 border-r-4 border-[#4361ee]">
    <div class="px-5 py-4 border-b-2 border-gray-800 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-xl bg-[#4361ee] komik-border-sm flex items-center justify-center">
                <span class="judul-komik text-white">G</span>
            </div>
            <span class="judul-komik text-xl text-white tracking-wider">GELAR<span class="text-[#4361ee]">.id</span></span>
        </a>
        <button onclick="document.getElementById('sidebar').classList.toggle('buka')" class="md:hidden text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="px-5 py-2 border-b border-gray-800">
        <div class="inline-block bg-[#f72585] text-white text-xs font-black px-3 py-1 rounded-md border-2 border-[#1a1a2e]">⚡ PANEL ADMIN</div>
    </div>

    <nav class="flex-1 px-3 py-3 space-y-0.5 overflow-y-auto">
        <a href="/admin/dasbor" class="sidebar-link {{ request()->is('admin/dasbor') ? 'aktif' : '' }}">
            <i class="fas fa-chart-pie"></i> Dasbor
        </a>

        <p class="text-gray-600 text-xs font-black px-3 pt-3 pb-1 uppercase tracking-widest">📚 Akademik</p>
        <a href="/admin/gelar" class="sidebar-link {{ request()->is('admin/gelar*') ? 'aktif' : '' }}">
            <i data-lucide="graduation-cap" class="w-4 h-4"></i> Jenis Gelar
        </a>
        <a href="/admin/program" class="sidebar-link {{ request()->is('admin/program*') ? 'aktif' : '' }}">
            <i data-lucide="book-open" class="w-4 h-4"></i> Program
        </a>
        <a href="/admin/semester" class="sidebar-link {{ request()->is('admin/semester*') ? 'aktif' : '' }}">
            <i data-lucide="layers" class="w-4 h-4"></i> Semester & Sesi
        </a>

        <p class="text-gray-600 text-xs font-black px-3 pt-3 pb-1 uppercase tracking-widest">🎯 Kegiatan</p>
        <a href="/admin/pertemuan" class="sidebar-link {{ request()->is('admin/pertemuan*') ? 'aktif' : '' }}">
            <i data-lucide="video" class="w-4 h-4"></i> Pertemuan
        </a>
        <a href="/admin/kuesioner" class="sidebar-link {{ request()->is('admin/kuesioner*') ? 'aktif' : '' }}">
            <i data-lucide="clipboard-list" class="w-4 h-4"></i> Kuesioner
        </a>

        <p class="text-gray-600 text-xs font-black px-3 pt-3 pb-1 uppercase tracking-widest">📋 Manajemen</p>
        <a href="/admin/pendaftaran" class="sidebar-link {{ request()->is('admin/pendaftaran*') ? 'aktif' : '' }}">
            <i data-lucide="user-check" class="w-4 h-4"></i> Pendaftaran
        </a>
        <a href="/admin/kemajuan" class="sidebar-link {{ request()->is('admin/kemajuan*') ? 'aktif' : '' }}">
            <i data-lucide="trending-up" class="w-4 h-4"></i> Kemajuan
        </a>
        <a href="/admin/diskon" class="sidebar-link {{ request()->is('admin/diskon*') ? 'aktif' : '' }}">
            <i data-lucide="tag" class="w-4 h-4"></i> Diskon
        </a>
        <a href="/admin/sertifikat" class="sidebar-link {{ request()->is('admin/sertifikat*') ? 'aktif' : '' }}">
            <i data-lucide="award" class="w-4 h-4"></i> Sertifikat
        </a>
        <a href="/admin/pengguna" class="sidebar-link {{ request()->is('admin/pengguna*') ? 'aktif' : '' }}">
            <i data-lucide="users" class="w-4 h-4"></i> Pengguna
        </a>

        <p class="text-gray-600 text-xs font-black px-3 pt-3 pb-1 uppercase tracking-widest">🏆 Gamifikasi</p>
        <a href="/admin/pencapaian" class="sidebar-link {{ request()->is('admin/pencapaian*') ? 'aktif' : '' }}">
            <i data-lucide="trophy" class="w-4 h-4"></i> Pencapaian
            @php $jmlKlaim = \App\Models\PencapaianPengguna::where('status','menunggu')->count(); @endphp
            @if($jmlKlaim > 0)
            <span class="ml-auto bg-[#f72585] text-white text-xs font-black px-1.5 py-0.5 rounded-full">{{ $jmlKlaim }}</span>
            @endif
        </a>
        <a href="/admin/beasiswa" class="sidebar-link {{ request()->is('admin/beasiswa*') ? 'aktif' : '' }}">
            <i data-lucide="gift" class="w-4 h-4"></i> Beasiswa
            @php $jmlBeasiswaMenunggu = \App\Models\PendaftarBeasiswa::where('status','menunggu')->count(); @endphp
            @if($jmlBeasiswaMenunggu > 0)
            <span class="ml-auto bg-[#ffd60a] text-[#0f0e17] text-xs font-black px-1.5 py-0.5 rounded-full">{{ $jmlBeasiswaMenunggu }}</span>
            @endif
        </a>

        <p class="text-gray-600 text-xs font-black px-3 pt-3 pb-1 uppercase tracking-widest">🤖 AI Tool</p>
        <a href="/analisis-minat" target="_blank" class="sidebar-link">
            <i data-lucide="bot" class="w-4 h-4"></i> Tes Minat AI
        </a>
    </nav>

    <div class="px-3 py-4 border-t-2 border-gray-800">
        <div class="flex items-center gap-3 mb-3 px-2">
            <div class="w-9 h-9 rounded-full bg-[#f72585] komik-border-sm flex items-center justify-center text-white font-black text-sm">
                {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
            </div>
            <div>
                <p class="text-white text-sm font-black truncate max-w-[120px]">{{ auth()->user()->nama }}</p>
                <p class="text-gray-500 text-xs font-bold">Administrator</p>
            </div>
        </div>
        <form method="POST" action="/keluar">
            @csrf
            <button type="submit" class="sidebar-link w-full text-left hover:bg-red-900 hover:text-red-300">
                <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<div class="flex-1 ml-64 konten-utama">
    <header class="bg-white px-4 sm:px-6 py-3 sticky top-0 z-30 flex items-center justify-between" style="border-bottom:3px solid #1a1a2e;">
        <div class="flex items-center gap-3">
            <button onclick="document.getElementById('sidebar').classList.toggle('buka')" class="md:hidden btn-komik p-2 bg-white rounded-xl text-[#1a1a2e]">
                <i data-lucide="bars-3" class="w-5 h-5"></i>
            </button>
            <h1 class="judul-komik text-xl sm:text-2xl text-[#1a1a2e] tracking-wide">@yield('judul','Dasbor')</h1>
        </div>
        <span class="text-xs sm:text-sm text-gray-500 font-bold hidden sm:block">
            <i class="fas fa-calendar mr-1 text-[#4361ee]"></i>
            {{ now()->translatedFormat('d F Y') }}
        </span>
    </header>

    @if(session('sukses'))
    <div class="mx-4 sm:mx-6 mt-4 pesan-sukses px-4 py-3 rounded-xl flex items-center gap-2 text-sm">
        <i class="fas fa-check-circle"></i> {{ session('sukses') }}
    </div>
    @endif
    @if(session('galat'))
    <div class="mx-4 sm:mx-6 mt-4 pesan-galat px-4 py-3 rounded-xl flex items-center gap-2 text-sm">
        <i class="fas fa-exclamation-circle"></i> {{ session('galat') }}
    </div>
    @endif

    <main class="p-4 sm:p-6">@yield('konten')</main>
</div>

<script>
setTimeout(()=>{document.querySelectorAll('.pesan-sukses,.pesan-galat').forEach(el=>{el.style.transition='opacity .5s';el.style.opacity='0';setTimeout(()=>el.remove(),500);});},4000);
document.addEventListener('click',e=>{const s=document.getElementById('sidebar');if(window.innerWidth<768&&s.classList.contains('buka')&&!s.contains(e.target)){s.classList.remove('buka');}});
lucide.createIcons();
</script>
@stack('skrip')
</body>
</html>
