<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gelar') — Kampus Virtual Indonesia</title>
    <meta name="description" content="Platform gelar kampus virtual Indonesia. Raih gelar KVT.Kom, VT.Kom, VTA.Kom, V.Com dan K1-K6 secara online.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: { 50:'#eff6ff',100:'#dbeafe',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',900:'#1e3a8a' }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .gradient-bg { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%); }
        .card-hover { transition: transform 0.2s, box-shadow 0.2s; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
        .badge { display: inline-flex; align-items: center; padding: 2px 10px; border-radius: 9999px; font-size: 12px; font-weight: 600; }
    </style>
    @stack('styles')
</head>
<body class="font-sans bg-gray-50 text-gray-800">

<!-- NAVBAR -->
<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-xl gradient-bg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">G</span>
                </div>
                <span class="font-bold text-xl text-gray-900">Gelar<span class="text-blue-600">.id</span></span>
            </a>

            <!-- Nav Links -->
            <div class="hidden md:flex items-center gap-6">
                <a href="/" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">Beranda</a>
                <a href="/degrees" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">Jenis Gelar</a>
                <a href="/programs" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">Program</a>
                <a href="/verify" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">Verifikasi</a>
            </div>

            <!-- Auth -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? '/admin/dashboard' : '/user/dashboard' }}"
                       class="text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fas fa-user-circle mr-1"></i>{{ auth()->user()->name }}
                    </a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition-colors">Keluar</button>
                    </form>
                @else
                    <a href="/login" class="text-sm font-medium text-gray-700 hover:text-blue-600">Masuk</a>
                    <a href="/register" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        Daftar Gratis
                    </a>
                @endauth

                <!-- Mobile menu button -->
                <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-gray-100 bg-white px-4 py-3 space-y-2">
        <a href="/" class="block py-2 text-gray-700 hover:text-blue-600">Beranda</a>
        <a href="/degrees" class="block py-2 text-gray-700 hover:text-blue-600">Jenis Gelar</a>
        <a href="/programs" class="block py-2 text-gray-700 hover:text-blue-600">Program</a>
        <a href="/verify" class="block py-2 text-gray-700 hover:text-blue-600">Verifikasi</a>
    </div>
</nav>

<!-- FLASH MESSAGES -->
@if(session('success'))
    <div class="max-w-7xl mx-auto px-4 pt-4">
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
            <i class="fas fa-check-circle text-green-500"></i>
            {{ session('success') }}
        </div>
    </div>
@endif
@if(session('error'))
    <div class="max-w-7xl mx-auto px-4 pt-4">
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            {{ session('error') }}
        </div>
    </div>
@endif

<!-- MAIN CONTENT -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-300 mt-20">
    <div class="max-w-7xl mx-auto px-4 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-9 h-9 rounded-xl gradient-bg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">G</span>
                    </div>
                    <span class="font-bold text-xl text-white">Gelar<span class="text-blue-400">.id</span></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                    Platform kampus virtual Indonesia. Raih gelar akademik secara online dengan kurikulum berstandar industri.
                </p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Gelar</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/degrees" class="hover:text-white">KVT.Kom</a></li>
                    <li><a href="/degrees" class="hover:text-white">VT.Kom</a></li>
                    <li><a href="/degrees" class="hover:text-white">VTA.Kom</a></li>
                    <li><a href="/degrees" class="hover:text-white">V.Com</a></li>
                    <li><a href="/degrees" class="hover:text-white">K1 — K6</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Tautan</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/programs" class="hover:text-white">Program Studi</a></li>
                    <li><a href="/verify" class="hover:text-white">Verifikasi Sertifikat</a></li>
                    <li><a href="/login" class="hover:text-white">Masuk</a></li>
                    <li><a href="/register" class="hover:text-white">Daftar</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 pt-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Gelar.id — Platform Kampus Virtual Indonesia
        </div>
    </div>
</footer>

<script>
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
    // Auto hide flash after 4s
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
