<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Dokumentasi | Masjid Jami' Al-Munawwaroh</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F8FAF8] text-slate-900" x-data="{ openModal: false, openQris: false, layanan: '' }">

    <nav class="glass-nav fixed w-full z-50 top-0 border-b border-slate-100">
        <div class="max-w-[95%] mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-emerald-200">M</div>
                <span class="text-xl font-bold tracking-tight text-emerald-900 uppercase">Al-Munawwaroh</span>
            </a>
            
            <div class="hidden md:flex space-x-10 items-center text-sm font-medium">
                <a href="{{ url('/') }}#profil" class="text-slate-600 hover:text-emerald-600 transition text-sm">Tentang Kami</a>
                <a href="{{ url('/') }}#layanan" class="text-slate-600 hover:text-emerald-600 transition text-sm">Layanan</a>
                <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.index') ? 'text-emerald-600 font-bold' : 'text-slate-600 hover:text-emerald-600' }} transition text-sm">Galeri</a>
                <a href="{{ url('/') }}#transparansi" class="text-slate-600 hover:text-emerald-600 transition text-sm">Laporan Keuangan</a>
            </div>

            <div class="flex items-center space-x-6">
                <button @click="openQris = true" class="bg-emerald-600 text-white min-w-[120px] px-6 py-3 rounded-full font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition flex items-center justify-center gap-2 text-sm leading-none">
                    <i class="fa-solid fa-heart text-xs"></i>
                    <span>Donasi</span>
                </button>
                <div class="h-6 w-[1px] bg-slate-200"></div>
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-500 hover:text-emerald-600 transition italic">Masuk</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-emerald-600">Dashboard</a>
                @endguest
            </div>
        </div>
    </nav>

    <section class="relative pt-44 pb-32 bg-emerald-900 overflow-hidden rounded-b-[60px] md:rounded-b-[100px]">
        <div class="absolute inset-0 opacity-10">
            <img src="https://www.transparenttextures.com/patterns/islamic-art.png" class="w-full h-full object-cover">
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="inline-block px-4 py-1.5 bg-emerald-800/50 text-emerald-300 rounded-full text-xs font-bold uppercase tracking-widest mb-6 border border-emerald-700">Arsip Visual Syiar</span>
            <h1 class="font-display text-5xl md:text-7xl text-white mb-6 italic">Galeri Dokumentasi</h1>
            <p class="text-emerald-100/70 text-lg mb-12 max-w-2xl mx-auto leading-relaxed">Menyimpan jejak kebaikan dan momen kebersamaan dalam melayani ummat di Masjid Al-Munawwaroh.</p>
            
            <div class="max-w-4xl mx-auto bg-white p-4 rounded-[2.5rem] shadow-2xl flex flex-col md:flex-row gap-4 border border-emerald-100">
                <div class="flex-1 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Cari Nama Album..." class="w-full pl-12 pr-4 py-4 bg-slate-50 border-none rounded-2xl text-slate-700 outline-none focus:ring-2 focus:ring-emerald-500 transition">
                </div>
                <div class="md:w-1/4">
                    <select class="w-full px-4 py-4 bg-slate-50 border-none rounded-2xl text-slate-500 outline-none">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                        @endfor
                    </select>
                </div>
                <button class="bg-emerald-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-200 uppercase tracking-widest text-sm">
                    Cari Album
                </button>
            </div>
        </div>
    </section>

    <section class="py-24 bg-[#F8FAF8] relative z-20">
        <div class="container mx-auto px-6 text-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-[95%] mx-auto -mt-44 font-display italic">
                @forelse($albums as $album)
                <div class="bg-white p-8 rounded-[3.5rem] shadow-xl border border-emerald-50 font-sans not-italic tracking-normal">
                    
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-[2px] bg-emerald-600"></span>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-[0.2em]">
                            {{ \Carbon\Carbon::parse($album->date)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    <h3 class="font-display text-3xl text-slate-800 mb-6 italic leading-tight">
                        {{ $album->title }}
                    </h3>

                    <div class="grid grid-cols-2 gap-3 mb-6">
                        @foreach($album->photos as $photo)
                            <div class="relative aspect-square rounded-[2rem] overflow-hidden border-2 border-slate-50 shadow-sm bg-slate-100">
                                <img src="{{ asset('storage/' . ($photo->photo_path ?? $photo->path)) }}" 
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-700" 
                                     alt="Dokumentasi {{ $album->title }}">
                            </div>
                        @endforeach
                    </div>

                    <p class="text-slate-400 text-sm leading-relaxed italic border-t border-slate-50 pt-4">
                        {{ $album->description ?? 'Dokumentasi kegiatan rutin dan pemberdayaan ummat di lingkungan Masjid Jami\' Al-Munawwaroh.' }}
                    </p>
                </div>
                @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[4rem] border-4 border-dashed border-emerald-100">
                    <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 text-emerald-300 text-4xl">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    <h3 class="font-display text-2xl text-slate-400 italic">Belum ada album dokumentasi yang diunggah.</h3>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="mt-20">
        <div class="bg-emerald-950 text-white pt-24 pb-12 px-6 md:px-16 rounded-t-[60px] md:rounded-t-[120px]">
            <div class="max-w-[95%] mx-auto grid grid-cols-1 md:grid-cols-3 gap-16">
                <div>
                    <h2 class="font-display text-4xl text-emerald-400 mb-8 italic">Al-Munawwaroh</h2>
                    <p class="text-emerald-100/60 leading-relaxed max-w-sm text-sm">
                        Masjid Jami' Al-Munawwaroh berkomitmen pada nilai-nilai moderasi beragama, transparansi manajemen, dan pemberdayaan ekonomi ummat di Kota Malang.
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-emerald-500 mb-8 uppercase tracking-[0.3em]">Kontak & Lokasi</h3>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <i class="fa-solid fa-location-dot text-emerald-400 mt-1"></i>
                            <span class="text-sm text-emerald-100/80 leading-relaxed text-sm">
                                Jl. Raya Al-Munawwaroh No. 12, Kel. Lowokwaru, Kota Malang, Jawa Timur 65141
                            </span>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="fa-solid fa-envelope text-emerald-400"></i>
                            <span class="text-sm text-emerald-100/80 text-sm">info@almunawwaroh.or.id</span>
                        </div>
                    </div>
                </div>

                <div class="md:text-right text-sm">
                    <h3 class="text-sm font-bold text-emerald-500 mb-8 uppercase tracking-[0.3em]">Jejak Digital</h3>
                    <div class="flex md:justify-end gap-5">
                        <a href="#" class="w-14 h-14 bg-white/5 hover:bg-emerald-600 rounded-2xl flex items-center justify-center transition-all border border-white/10 group">
                            <i class="fa-brands fa-instagram text-xl group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="w-14 h-14 bg-white/5 hover:bg-emerald-600 rounded-2xl flex items-center justify-center transition-all border border-white/10 group">
                            <i class="fa-brands fa-youtube text-xl group-hover:scale-110"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-24 pt-8 border-t border-white/5 text-center">
                <p class="text-[11px] text-emerald-100/30 uppercase font-bold tracking-[0.2em]">
                    &copy; 2026 Masjid Jami' Al-Munawwaroh. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <div x-show="openModal" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center px-4">
        <div @click="openModal = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        <div class="bg-white w-full max-w-lg p-10 rounded-[3rem] shadow-2xl relative">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 uppercase text-sm tracking-widest text-sm">Pendaftaran <span x-text="layanan" class="text-emerald-600"></span></h3>
            <form action="{{ route('services.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="jenis_layanan" :value="layanan">
                <input type="text" name="nama_lengkap" required placeholder="Nama Lengkap" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 text-sm">
                <input type="number" name="nomor_hp" required placeholder="WhatsApp (Aktif)" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 text-sm">
                <textarea name="detail_permohonan" rows="3" placeholder="Jelaskan permohonan Anda..." class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 text-sm"></textarea>
                <div class="pt-4 flex gap-4 text-sm uppercase tracking-widest font-bold">
                    <button type="button" @click="openModal = false" class="flex-1 py-4 text-slate-400">Batal</button>
                    <button type="submit" class="flex-[2] py-4 bg-emerald-600 text-white rounded-2xl hover:bg-emerald-700 transition shadow-lg">Kirim Permohonan</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="openQris" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center px-4">
        <div @click="openQris = false" class="absolute inset-0 bg-emerald-950/80 backdrop-blur-md"></div>
        <div class="bg-white w-full max-w-md p-10 rounded-[3.5rem] shadow-2xl relative text-center">
            <h3 class="font-display text-3xl text-slate-900 mb-2 italic">Infaq Digital</h3>
            <p class="text-xs text-slate-400 mb-8 uppercase tracking-widest font-bold text-[10px]">Masjid Al-Munawwaroh</p>
            <div class="bg-slate-50 p-6 rounded-3xl border-2 border-dashed border-emerald-100 mb-8">
                <img src="{{ asset('images/qris-sample.png') }}" class="w-48 h-48 mx-auto object-contain" alt="QRIS">
            </div>
            <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="text" name="nama_donatur" placeholder="Hamba Allah / Nama" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl outline-none text-sm">
                <input type="number" name="nominal" required placeholder="Nominal Rp" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl outline-none text-sm">
                <div class="text-left">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 ml-2 tracking-widest">Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" required class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-emerald-50 file:text-emerald-700">
                </div>
                <button type="submit" class="w-full py-5 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-emerald-100 text-sm uppercase tracking-widest">KONFIRMASI INFAQ</button>
            </form>
        </div>
    </div>

</body>
</html>