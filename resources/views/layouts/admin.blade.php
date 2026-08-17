<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard') | Gelar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .gradient-bg { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); }
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { display:flex; align-items:center; gap:10px; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:500; color:#94a3b8; transition:all 0.15s; }
        .sidebar-link:hover, .sidebar-link.active { background:#1e3a8a; color:white; }
        .sidebar-link i { width:16px; text-align:center; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-60 min-h-screen bg-gray-900 flex flex-col fixed left-0 top-0 z-40">
    <div class="px-5 py-5 border-b border-gray-800">
        <a href="/" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg gradient-bg flex items-center justify-center">
                <span class="text-white font-bold text-sm">G</span>
            </div>
            <span class="font-bold text-white">Gelar<span class="text-blue-400">.id</span></span>
        </a>
        <p class="text-gray-500 text-xs mt-1">Panel Admin</p>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <a href="/admin/dashboard" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i> Dashboard
        </a>
        <p class="text-gray-600 text-xs font-semibold px-4 pt-4 pb-1 uppercase tracking-wider">Akademik</p>
        <a href="/admin/degrees" class="sidebar-link {{ request()->is('admin/degrees*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i> Jenis Gelar
        </a>
        <a href="/admin/programs" class="sidebar-link {{ request()->is('admin/programs*') ? 'active' : '' }}">
            <i class="fas fa-book-open"></i> Program
        </a>
        <a href="/admin/enrollments" class="sidebar-link {{ request()->is('admin/enrollments*') ? 'active' : '' }}">
            <i class="fas fa-user-graduate"></i> Pendaftaran
        </a>
        <a href="/admin/certificates" class="sidebar-link {{ request()->is('admin/certificates*') ? 'active' : '' }}">
            <i class="fas fa-certificate"></i> Sertifikat
        </a>
        <p class="text-gray-600 text-xs font-semibold px-4 pt-4 pb-1 uppercase tracking-wider">Manajemen</p>
        <a href="/admin/users" class="sidebar-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Pengguna
        </a>
    </nav>

    <div class="px-3 py-4 border-t border-gray-800">
        <div class="flex items-center gap-3 mb-3 px-3">
            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-white text-sm font-medium">{{ auth()->user()->name }}</p>
                <p class="text-gray-500 text-xs">Administrator</p>
            </div>
        </div>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="sidebar-link w-full text-left hover:bg-red-900 hover:text-red-300">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- MAIN CONTENT -->
<div class="flex-1 ml-60">
    <!-- TOP BAR -->
    <header class="bg-white border-b border-gray-200 px-6 py-4 sticky top-0 z-30">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <i class="fas fa-calendar"></i>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </header>

    <!-- FLASH -->
    @if(session('success'))
        <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
            <i class="fas fa-check-circle text-green-500"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
            <i class="fas fa-exclamation-circle text-red-500"></i> {{ session('error') }}
        </div>
    @endif

    <main class="p-6">
        @yield('content')
    </main>
</div>

<script>
setTimeout(() => {
    document.querySelectorAll('[class*="bg-green-50"], [class*="bg-red-50"]').forEach(el => {
        el.style.transition = 'opacity 0.5s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    });
}, 4000);
</script>
@stack('scripts')
</body>
</html>
