<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT BORNEO TANDAYU PERKASA - General Supplier</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden">

    <!-- Header / Navbar -->
    @include('layouts.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    @auth
        <!-- Floating Shortcut Khusus Admin: Hanya tampil pada perangkat admin yang login -->
        <aside aria-label="Akses Admin" class="fixed bottom-6 left-6 z-50">
            <a href="{{ route('admin.dashboard') }}" 
               class="inline-flex items-center gap-2.5 bg-slate-900/95 hover:bg-slate-950 text-white px-4 py-2.5 rounded-full shadow-2xl border border-amber-500/50 ring-2 ring-amber-500/20 backdrop-blur-md transition-all duration-200 hover:scale-105 group">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-semibold text-slate-300 hidden sm:inline">Admin Aktif:</span>
                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 group-hover:text-amber-300">
                    <svg class="w-4 h-4 text-amber-400 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                    </svg>
                    Kembali ke Halaman Admin
                </span>
            </a>
        </aside>
    @endauth

</body>
</html>
