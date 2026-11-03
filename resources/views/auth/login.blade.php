<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Dashboard - Al-Munawwaroh</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased min-h-screen flex flex-col justify-center items-center p-4 relative overflow-hidden" 
      style="background-color: #f1f5f9; background-image: radial-gradient(at 0% 0%, rgba(0, 137, 100, 0.12) 0px, transparent 60%), radial-gradient(at 100% 100%, rgba(20, 184, 166, 0.12) 0px, transparent 60%);">
    
    <div class="absolute inset-0 z-0 flex items-center justify-center opacity-[0.08] pointer-events-none select-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-[600px] h-[600px]" viewBox="0 0 100 100" fill="none" stroke="#008964" stroke-width="0.5">
            <circle cx="50" cy="50" r="45" stroke-dasharray="2 2"/>
            <polygon points="50,5 95,50 50,95 5,50"/>
            <polygon points="50,12 88,50 50,88 12,50" stroke-dasharray="1 1"/>
            <rect x="25" y="25" width="50" height="50" transform="rotate(45 50 50)"/>
            <rect x="28" y="28" width="44" height="44" transform="rotate(22.5 50 50)" stroke-dasharray="1 1"/>
            <circle cx="50" cy="50" r="15"/>
            <circle cx="50" cy="50" r="5" fill="#008964" fill-opacity="0.2"/>
        </svg>
    </div>

    <div class="w-full max-w-md bg-white/95 border border-slate-200/60 rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,137,100,0.12)] p-6 md:p-8 z-10 backdrop-blur-md">
        
        <div class="mb-6 flex items-center space-x-3 pb-4 border-b border-slate-100">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-[#008964] text-white font-bold text-base shadow-sm">
                M
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800 leading-tight">Masuk Dashboard</h2>
                <p class="text-xs text-slate-400">Masjid Jami' Al-Munawwaroh</p>
            </div>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block font-medium text-xs text-slate-400 uppercase tracking-wider mb-1">E-mail</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                    class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-[#008964]/10 focus:border-[#008964] focus:bg-white transition text-sm text-slate-700"
                    placeholder="nama@gmail.com">
                @error('email')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="password" class="block font-medium text-xs text-slate-400 uppercase tracking-wider">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-semibold text-[#008964] hover:text-[#007353] transition">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-[#008964]/10 focus:border-[#008964] focus:bg-white transition text-sm text-slate-700"
                    placeholder="••••••••">
                @error('password')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center pt-1">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="rounded border-slate-300 text-[#008964] focus:ring-[#008964]/30 cursor-pointer w-4 h-4">
                <label for="remember_me" class="ml-2 text-xs text-slate-400 font-medium cursor-pointer select-none">Ingatlah aku</label>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-2 border-t border-slate-100 mt-4">
                <a href="/" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition py-2 px-3 rounded-lg">
                    Kembali
                </a>
                <button type="submit" 
                    class="inline-flex items-center px-6 py-2.5 bg-[#008964] hover:bg-[#007353] active:bg-[#005c42] border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest shadow-sm shadow-emerald-900/10 transition transform active:scale-95">
                    Masuk
                </button>
            </div>
        </form>
    </div>

</body>
</html>