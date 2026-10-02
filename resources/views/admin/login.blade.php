<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel PT Borneo Tandayu Perkasa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-900 antialiased flex items-center justify-center min-h-screen relative overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-amber-500/20 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 rounded-full bg-blue-500/20 blur-3xl pointer-events-none"></div>

    <!-- Tombol Kembali ke Beranda — Fixed pojok kiri atas -->
    <a href="{{ route('home') }}"
       class="fixed top-5 left-5 z-50 inline-flex items-center gap-2.5 px-4 py-2.5 bg-slate-800/95 hover:bg-amber-500 text-slate-200 hover:text-white rounded-xl border border-slate-700/80 hover:border-amber-400 shadow-xl hover:shadow-amber-500/30 transition-all duration-200 group text-sm font-semibold backdrop-blur-md">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Kembali ke Beranda</span>
    </a>

    <div class="w-full max-w-md px-6 relative z-10">
        <div class="text-center mb-10">
            <img src="{{ asset('images/logo-btp.webp') }}" alt="Logo PT Borneo Tandayu Perkasa" class="h-16 w-auto object-contain mx-auto mb-4 p-1.5 bg-white rounded-2xl shadow-lg border border-slate-200">
            <h1 class="text-2xl font-bold text-white tracking-tight">Login Admin</h1>
            <p class="text-slate-400 mt-2">Masuk untuk mengelola website perusahaan.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl shadow-black/50 border border-slate-100 p-8">
            @if($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100 flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span>Email atau password salah!</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white" 
                        placeholder="admin@borneo.com">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white" 
                        placeholder="••••••••">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-md transform hover:-translate-y-0.5">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
        
        <p class="text-center text-sm text-slate-500 mt-8">&copy; {{ date('Y') }} PT Borneo Tandayu Perkasa</p>
    </div>
</body>
</html>