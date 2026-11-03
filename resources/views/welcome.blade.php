<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Jami' Al-Munawwaroh | Pusat Ibadah & Pemberdayaan</title>
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
        
        /* Utility untuk menyembunyikan scrollbar namun tetap bisa discroll */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F8FAF8] text-slate-800" x-data="{ openModal: false, openQris: false, layanan: '' }">
    <nav class="glass-nav fixed w-full z-50 top-0 border-b border-slate-100">
        <div class="max-w-[95%] mx-auto px-4 py-4 flex justify-between items-center">
            
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-emerald-200">M</div>
                <span class="text-xl font-bold tracking-tight text-emerald-900 uppercase">Al-Munawwaroh</span>
            </div>
            
            <div class="hidden md:flex space-x-10 items-center text-sm font-medium">
                <a href="#profil" class="text-slate-600 hover:text-emerald-600 transition">Tentang Kami</a>
                <a href="#layanan" class="text-slate-600 hover:text-emerald-600 transition">Layanan</a>
                <a href="#informasi" class="text-slate-600 hover:text-emerald-600 font-medium transition">Berita</a>
                <a href="{{ route('gallery.index') }}" class="text-slate-600 hover:text-emerald-600 transition">Galeri</a>
                <a href="#transparansi" class="text-slate-600 hover:text-emerald-600 transition">Laporan Keuangan</a>
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

    <header id="profil" class="relative pt-48 pb-32 overflow-hidden">
        <div class="absolute top-0 right-0 -z-10 opacity-10">
            <svg width="600" height="600" viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M300 0L340.23 259.77L600 300L340.23 340.23L300 600L259.77 340.23L0 300L259.77 259.77L300 0Z" fill="#059669"/>
            </svg>
        </div>
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-widest mb-6">Baitullah & Community Hub</span>
                <h1 class="font-display text-5xl md:text-7xl leading-tight text-slate-900 mb-8">
                    Menjemput <span class="text-emerald-600">Keberkahan</span> di Jantung Ummat.
                </h1>
                <p class="text-lg text-slate-500 mb-10 leading-relaxed">
                    Masjid Jami' Al-Munawwaroh berkomitmen pada transparansi manajemen. Setiap rupiah yang Anda infaqkan tercatat secara sistematis untuk kemaslahatan umat.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <button @click="openQris = true" class="bg-emerald-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-emerald-700 transition shadow-xl shadow-emerald-200 flex items-center justify-center">
                        Tunaikan Infaq (QRIS)
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m-3 3h2m3 3h-2m-3 3h2m3 3h-2M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z"></path></svg>
                    </button>
                    <a href="#layanan" class="bg-white text-slate-700 border border-slate-200 px-10 py-4 rounded-2xl font-bold hover:bg-slate-50 transition flex items-center justify-center">Layanan Jamaah</a>
                </div>
            </div>
            <div class="relative hidden md:block">
    <div class="w-full h-[500px] bg-emerald-100 rounded-[40px] overflow-hidden rotate-2 shadow-2xl">
        <img 
            src="{{ asset('images/foto-masjid.jpeg') }}" 
            alt="Masjid Jami' Al-Munawwaroh" 
            class="w-full h-full object-cover shadow-inner"
            loading="lazy"
        >
    </div>
    
    <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl"></div>
</div>
        </div>
    </header>

    @if(session('success'))
    <div class="container mx-auto px-6 mb-8">
        <div class="bg-emerald-500 text-white px-6 py-4 rounded-2xl relative shadow-lg flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    </div>
    @endif

<section id="layanan" class="py-24 bg-[#F0F4F0] rounded-[60px] mx-4 md:mx-10">
    <div class="container mx-auto px-6 text-center mb-16">
        <h2 class="font-display text-4xl text-slate-900 mb-4">Layanan Administrasi & Kemaslahatan</h2>
        <p class="text-slate-500 max-w-2xl mx-auto">Kami menyediakan kemudahan akses bagi jamaah untuk berbagai kebutuhan administratif dan keagamaan secara digital.</p>
    </div>

    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-6">
            
            <div @click="openModal = true; layanan = 'Program GSBB'" 
                 class="bg-white p-8 rounded-[2.5rem] text-left border border-emerald-50 shadow-sm hover:border-emerald-500 transition group cursor-pointer flex flex-col justify-between min-h-[320px]">
                <div>
                    <div class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition shadow-lg shadow-blue-100">🌤️</div>
                    <h4 class="font-bold text-slate-800 text-lg mb-2">Program GSBB</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Gerakan Subuh Berjamaah & Berbagi.</p>
                </div>
                <button class="mt-6 w-full py-3 bg-slate-50 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-widest group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    Pilih Layanan
                </button>
            </div>

            <div @click="openModal = true; layanan = 'Shohibul Qurban'" 
                 class="bg-white p-8 rounded-[2.5rem] text-left border border-emerald-50 shadow-sm hover:border-emerald-500 transition group cursor-pointer flex flex-col justify-between min-h-[320px]">
                <div>
                    <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition shadow-lg shadow-emerald-100">🐏</div>
                    <h4 class="font-bold text-slate-800 text-lg mb-2">Shohibul Qurban</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Pendaftaran hewan qurban dan laporan penyembelihan.</p>
                </div>
                <button class="mt-6 w-full py-3 bg-slate-50 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-widest group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    Pilih Layanan
                </button>
            </div>

            <div @click="openModal = true; layanan = 'Mualaf Center'" 
                 class="bg-white p-8 rounded-[2.5rem] text-left border border-emerald-50 shadow-sm hover:border-emerald-500 transition group cursor-pointer flex flex-col justify-between min-h-[320px]">
                <div>
                    <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition shadow-lg shadow-orange-100">🤝</div>
                    <h4 class="font-bold text-slate-800 text-lg mb-2">Layanan Mualaf</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Layanan bimbingan bagi saudara baru (Mualaf).</p>
                </div>
                <button class="mt-6 w-full py-3 bg-slate-50 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-widest group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    Pilih Layanan
                </button>
            </div>

            <div @click="openModal = true; layanan = 'Zakat Corner'" 
                 class="bg-white p-8 rounded-[2.5rem] text-left border border-emerald-50 shadow-sm hover:border-emerald-500 transition group cursor-pointer flex flex-col justify-between min-h-[320px]">
                <div>
                    <div class="w-14 h-14 bg-amber-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition shadow-lg shadow-amber-100">💰</div>
                    <h4 class="font-bold text-slate-800 text-lg mb-2">Zakat & Wakaf</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Layanan konsultasi dan penyaluran Zakat Maal/Fitrah.</p>
                </div>
                <button class="mt-6 w-full py-3 bg-slate-50 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-widest group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    Pilih Layanan
                </button>
            </div>

        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    /* CSS Tambahan untuk Memaksa Tampilan Slider */
    .infoSwiper {
        width: 100%;
        padding-bottom: 20px;
    }
    .swiper-slide {
        display: flex;
        justify-content: center;
        height: auto;
    }
</style>

<section id="informasi" class="py-24 bg-white overflow-hidden">
    <div class="container mx-auto px-6">
        
        <div class="flex justify-between items-end mb-12">
            <div>
                <span class="text-emerald-600 font-bold uppercase tracking-widest text-[10px]">Pusat Informasi</span>
                <h2 class="font-display text-4xl text-slate-900 mt-2 italic">Media Informasi</h2>
            </div>
            <div class="flex gap-3">
                <div class="info-prev cursor-pointer bg-slate-50 text-slate-400 w-10 h-10 rounded-full flex items-center justify-center hover:bg-emerald-600 hover:text-white transition shadow-sm border border-slate-100">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </div>
                <div class="info-next cursor-pointer bg-slate-50 text-slate-400 w-10 h-10 rounded-full flex items-center justify-center hover:bg-emerald-600 hover:text-white transition shadow-sm border border-slate-100">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </div>
            </div>
        </div>

        <div class="swiper infoSwiper !px-0">
            <div class="swiper-wrapper">
                @forelse($informations as $info)
                <div class="swiper-slide">
                    <div class="group cursor-pointer w-full text-left">
                        <div class="relative h-72 mb-6 rounded-[2.5rem] overflow-hidden shadow-sm border border-slate-100">
                            <img src="{{ asset('storage/' . $info->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <div class="absolute top-6 left-6">
                                <span class="bg-blue-600 text-white px-5 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest">
                                    {{ $info->category }}
                                </span>
                            </div>
                        </div>
                        <div class="px-2">
                            <p class="text-slate-400 text-[10px] font-bold uppercase mb-3">
                                {{ \Carbon\Carbon::parse($info->date)->translatedFormat('d F Y') }}
                            </p>
                            <h3 class="text-2xl font-bold text-slate-800 group-hover:text-emerald-600 transition line-clamp-2 mb-3 leading-tight">
                                {{ $info->title }}
                            </h3>
                            <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed">
                                {{ $info->description }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="swiper-slide py-20 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                    <p class="text-slate-400 italic">Belum ada informasi terbaru.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<script>
    // Gunakan window.onload agar script jalan hanya setelah SEMUA file terdownload
    window.onload = function() {
        const swiperInfo = new Swiper(".infoSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: ".info-next",
                prevEl: ".info-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3, // MEMAKSA 3 KOLOM SEJAJAR
                },
            },
        });
    };
</script>

    <section id="video" class="py-16 bg-white overflow-hidden">
        <div class="max-w-[95%] mx-auto px-4">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="font-display text-3xl text-slate-900 mb-1">Video Terkini</h2>
                    <p class="text-slate-500 text-sm">Kegiatan & kajian terbaru Masjid Al-Munawwaroh</p>
                </div>
                <div class="flex space-x-2">
                    <button @click="$refs.slider.scrollBy({left: -300, behavior: 'smooth'})" class="p-2 rounded-full bg-slate-100 hover:bg-emerald-100 text-emerald-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="$refs.slider.scrollBy({left: 300, behavior: 'smooth'})" class="p-2 rounded-full bg-slate-100 hover:bg-emerald-100 text-emerald-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <div 
                x-ref="slider"
                class="flex overflow-x-auto snap-x snap-mandatory no-scrollbar pb-8 space-x-4"
            >
                @forelse($videos as $video)
                <div class="flex-none w-[75%] md:w-[23%] snap-start group">
                    <div class="aspect-[9/16] w-full bg-black rounded-[2rem] overflow-hidden shadow-lg border border-slate-100 group-hover:border-emerald-500 transition-all relative">
                        <iframe 
                            class="w-full h-full" 
                            src="https://www.youtube.com/embed/{{ $video['id']['videoId'] }}" 
                            title="YouTube video player" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="mt-4 px-2">
                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Update</span>
                        <h4 class="font-bold text-slate-800 text-sm line-clamp-2 mt-1 leading-snug">
                            {{ $video['snippet']['title'] }}
                        </h4>
                    </div>
                </div>
                @empty
                <div class="w-full py-10 text-center text-slate-400 italic">
                    Belum ada video terbaru yang dapat ditampilkan.
                </div>
                @endforelse
            </div>
            
            <div class="mt-4 text-center md:hidden">
                <a href="https://youtube.com/@MasjidJamiAl-Munawaroh" target="_blank" class="text-emerald-600 text-sm font-bold">Lihat Semua Video →</a>
            </div>
        </div>
    </section>

    <section id="transparansi" class="py-32">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="bg-emerald-900 rounded-[3rem] p-8 md:p-16 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-800 rounded-full -mr-32 -mt-32 opacity-30"></div>
                
                <div class="relative z-10">
                    <div class="text-center mb-16">
                        <span class="text-emerald-400 font-bold uppercase tracking-widest text-xs">Laporan Pertanggungjawaban</span>
                        <h2 class="font-display text-4xl md:text-5xl mt-4 italic">Transparansi Dana Umat</h2>
                        <div class="w-24 h-1 bg-emerald-500 mx-auto mt-6"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                        <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10">
                            <p class="text-emerald-200 text-xs font-bold uppercase tracking-widest mb-4">Total Pemasukan</p>
                            <p class="text-3xl font-display text-white mb-2">
                                Rp {{ number_format($totalDonasiDigital + $kasFisik, 0, ',', '.') }}
                            </p>
                            <div class="text-[10px] text-emerald-300 flex justify-between border-t border-white/10 pt-4">
                                <span>Digital: Rp {{ number_format($totalDonasiDigital, 0, ',', '.') }}</span>
                                <span>Fisik: Rp {{ number_format($kasFisik, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10">
                            <p class="text-rose-300 text-xs font-bold uppercase tracking-widest mb-4">Dana Keluar (Operasional)</p>
                            <p class="text-3xl font-display text-rose-200 mb-2">
                                Rp {{ number_format($pengeluaran, 0, ',', '.') }}
                            </p>
                            <div class="text-[10px] text-rose-300 border-t border-white/10 pt-4 italic">
                                * Diperbarui tiap minggu oleh Admin
                            </div>
                        </div>

                        <div class="bg-emerald-500/20 backdrop-blur-md p-8 rounded-3xl border border-emerald-400 shadow-inner">
                            <p class="text-emerald-100 text-xs font-bold uppercase tracking-widest mb-4">Saldo Kas Saat Ini</p>
                            <p class="text-4xl font-display text-emerald-300">
                                Rp {{ number_format($totalSaldoSekarang, 0, ',', '.') }}
                            </p>
                            <p class="text-[10px] mt-4 text-emerald-400 uppercase font-bold tracking-tighter italic">Status: Aman & Terverifikasi</p>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-emerald-300 text-sm max-w-2xl mx-auto leading-relaxed">
                            Data di atas mencakup seluruh infaq harian kotak amal masjid, donasi melalui QRIS web, serta laporan pengeluaran operasional masjid. Jazaakumullah Khairan Katsiran kepada seluruh donatur.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak" class="py-24 bg-white">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="font-display text-4xl text-slate-900 mb-4">Hubungi Pengurus Masjid</h2>
                <div class="w-24 h-1.5 bg-emerald-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
                <div class="bg-emerald-900 rounded-[3rem] p-10 text-white shadow-2xl flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute bottom-0 right-0 w-64 h-64 bg-emerald-800 rounded-full -mb-32 -mr-32 opacity-20"></div>
                    
                    <div class="relative z-10">
                        <h3 class="font-display text-3xl mb-6">Mari Berdiskusi</h3>
                        <p class="text-emerald-100/80 mb-10 leading-relaxed">Pintu kami selalu terbuka untuk pertanyaan, saran, atau kerjasama demi kemajuan umat dan kemakmuran Masjid Al-Munawwaroh.</p>

                        <div class="space-y-8">
                            <div class="flex items-start gap-5">
                                <div class="bg-white/10 p-3 rounded-2xl text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Lokasi Utama</h4>
                                    <p class="text-emerald-200/70 text-sm">Jl. Graha Prima Raya Blok B, RW.016, Mangunjaya, Kec. Tambun Selatan, Kab. Bekasi, Jawa Barat</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5">
                                <div class="bg-white/10 p-3 rounded-2xl text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Email Resmi</h4>
                                    <p class="text-emerald-200/70 text-sm">masjidalmunawwaroh27@gmail.com</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5">
                                <div class="bg-white/10 p-3 rounded-2xl text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Layanan Telepon</h4>
                                    <p class="text-emerald-200/70 text-sm">+62 812-3456-7890</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-white/10 relative z-10">
                        <h4 class="font-bold mb-2 text-emerald-400">Jam Operasional Kantor:</h4>
                        <p class="text-sm text-emerald-100/60">Senin - Jumat: 08.00 - 16.00 WIB</p>
                        <p class="text-sm text-emerald-100/60">Sabtu - Minggu: Tutup (Kecuali Acara Khusus)</p>
                    </div>
                </div>

                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-xl shadow-slate-200/50">
                    <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Nama Lengkap*</label>
                                <input type="text" name="nama_lengkap" required placeholder="Nama Anda" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Alamat Email*</label>
                                <input type="email" name="email" required placeholder="nama@email.com" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">WhatsApp*</label>
                                <input type="text" name="whatsapp" required placeholder="08xxxx" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Subjek*</label>
                                <select name="subjek" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none transition text-slate-500">
                                    <option value="">Pilih Layanan...</option>
                                    <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                                    <option value="Layanan Mualaf">Layanan Mualaf</option>
                                    <option value="Zakat & Infaq">Zakat & Infaq</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2 ml-1">Pesan Anda*</label>
                            <textarea name="pesan" rows="4" required placeholder="Tuliskan pesan secara detail..." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none transition"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-5 rounded-2xl shadow-lg shadow-emerald-100 transition-all flex items-center justify-center gap-3 active:scale-[0.98]">
                            KIRIM PESAN SEKARANG
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

   <footer class="mt-20">
    <div class="bg-emerald-950 text-white pt-20 pb-10 px-6 md:px-16 rounded-t-[50px] md:rounded-t-[100px]">
        <div class="max-w-[95%] mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
            
            <div>
                <h2 class="font-display text-4xl text-emerald-400 mb-6">Masjid Al-Munawwaroh</h2>
                <p class="text-emerald-100/70 leading-relaxed max-w-sm">
                    Selamat datang di Masjid Jami' Al-Munawwaroh, pusat moderasi beragama dan pemberdayaan ummat di Kota Malang. Merajut ukhuwah, menebar kedamaian untuk seluruh alam.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-emerald-500 mb-6 uppercase tracking-widest">Kontak & Lokasi</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 mt-1 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <span class="text-sm text-emerald-100/80">Jl. Raya Al-Munawwaroh No. 12, Kel. Lowokwaru, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 005.47 5.47l.773-1.548a1 1 0 011.06-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                        <span class="text-sm text-emerald-100/80">+62 812-3456-7890</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                        <span class="text-sm text-emerald-100/80">info@almunawwaroh.or.id</span>
                    </div>
                </div>
            </div>

            <div class="md:text-right">
                <h3 class="text-lg font-bold text-emerald-500 mb-6 uppercase tracking-widest">Ikuti Sosial Media</h3>
                <div class="flex md:justify-end gap-4">
                    <a href="#" class="w-12 h-12 bg-white/5 hover:bg-emerald-600 rounded-xl flex items-center justify-center transition-all border border-white/10 group">
                        <i class="fa-brands fa-instagram text-xl text-white group-hover:scale-110"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-white/5 hover:bg-emerald-600 rounded-xl flex items-center justify-center transition-all border border-white/10 group">
                        <i class="fa-brands fa-youtube text-xl text-white group-hover:scale-110"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-white/5 hover:bg-emerald-600 rounded-xl flex items-center justify-center transition-all border border-white/10 group">
                        <i class="fa-brands fa-facebook-f text-xl text-white group-hover:scale-110"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-20 pt-8 border-t border-white/5 text-center">
            <p class="text-sm text-emerald-100/40 font-medium">
                &copy; 2026 Masjid Jami' Al-Munawwaroh. All rights reserved.
            </p>
        </div>
    </div>
    </footer>

<div x-show="openModal" class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
    <div class="flex items-center justify-center min-h-screen px-4 py-6">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="openModal = false"></div>

        <div class="relative bg-white rounded-[2.5rem] w-full shadow-2xl transform transition-all"
             :class="layanan === 'Zakat Corner' || layanan === 'Mualaf Center' ? 'max-w-5xl p-8 md:p-12' : 'max-w-lg p-10'"
             x-show="openModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-slate-800 tracking-tight">
                    <span x-text="layanan === 'Zakat Corner' ? 'Zakat & Wakaf' : (layanan === 'Mualaf Center' ? 'Pendaftaran Layanan Mualaf' : 'Pendaftaran ' + layanan)"></span>
                </h3>
                <p class="text-sm text-slate-400 mt-2 italic">Masjid Jami' Al-Munawwaroh</p>
            </div>

            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="subjek_utama" :value="layanan">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 border-b border-slate-100 pb-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-widest">Nama Lengkap sesuai KTP</label>
                        <input type="text" name="nama_lengkap" required class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-widest">WhatsApp Aktif</label>
                        <input type="number" name="whatsapp" required class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm" placeholder="0812...">
                    </div>
                </div>

                <template x-if="layanan === 'Zakat Corner'">
                    <div class="grid md:grid-cols-2 gap-10">
                        <div class="space-y-6">
                            <div class="bg-slate-50 p-6 rounded-[2rem] border border-slate-100 text-center">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Scan QRIS</p>
                                <img src="{{ asset('images/qris-zakat.png') }}" class="w-full max-w-[180px] mx-auto rounded-xl border-4 border-white shadow-sm">
                            </div>
                            <div class="bg-[#064E3B] p-6 rounded-[2rem] text-white">
                                <h4 class="text-xs font-bold text-emerald-400 uppercase mb-3">🕌 Niat Zakat</h4>
                                <p class="text-right text-lg font-serif italic">نَوَيْتُ أَنْ أُخْرِجَ زَكَاةَ مَالِي فَرْضًا لِلَّهِ تَعَالَى</p>
                                <p class="text-[10px] mt-2 italic text-emerald-100">"Aku niat mengeluarkan zakat hartaku fardhu karena Allah Ta'ala."</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold text-slate-800 uppercase italic border-b pb-2">Konfirmasi Pembayaran</h4>
                            <input type="hidden" name="nama_muzakki" x-model="$el.closest('form').querySelector('[name=nama_lengkap]').value">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1">Nominal</label>
                                <input type="number" name="nominal" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm" placeholder="Rp.">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 mb-1">Bukti Transfer</label>
                                <input type="file" name="bukti" class="w-full text-xs">
                            </div>
                            <button type="submit" class="w-full py-4 bg-emerald-600 text-white rounded-2xl font-bold uppercase text-[10px]">Kirim Bukti</button>
                        </div>
                    </div>
                </template>

                <template x-if="layanan === 'MUALAF CENTER' || layanan === 'Mualaf Center'">
                    <div class="space-y-6">
                        <div class="bg-blue-50 border border-blue-200 p-5 rounded-[2rem] flex items-center justify-between">
                            <p class="text-[10px] font-bold text-blue-900 uppercase">Surat Permohonan Masuk Islam</p>
                            <a href="{{ asset('files/ikrar_mualaf.docx') }}" download class="px-6 py-2 bg-blue-600 text-white text-[10px] font-bold rounded-xl uppercase">Download</a>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <input type="text" name="nik" placeholder="NIK KTP" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm">
                            <select name="jenis_kelamin" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <input type="text" name="agama_asal" placeholder="Agama Saat Ini" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm">
                            <input type="text" name="ttl" placeholder="Tempat, Tgl Lahir" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm">
                            <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm">
                            <input type="file" name="file_ikrar" class="w-full text-xs text-slate-500">
                        </div>
                        <textarea name="pesan" placeholder="Alamat Lengkap KTP & Domisili" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm h-24"></textarea>
                        <div class="bg-orange-50 p-4 rounded-xl border border-orange-100 flex justify-between items-center">
                            <span class="text-[9px] font-bold text-orange-700 uppercase">Ikuti pelatihan mualaf?</span>
                            <div class="flex gap-4">
                                <label class="text-[10px]"><input type="radio" name="pelatihan" value="Ya" checked> Ya</label>
                                <label class="text-[10px]"><input type="radio" name="pelatihan" value="Tidak"> Tidak</label>
                            </div>
                        </div>
                        <button type="submit" class="w-full py-4 bg-emerald-600 text-white rounded-2xl font-bold uppercase text-[10px]">Kirim Data Mualaf</button>
                    </div>
                </template>

                <template x-if="layanan !== 'Zakat Corner' && layanan !== 'Mualaf Center'">
                    <div class="space-y-4">
                        <div x-show="layanan === 'Program GSBB'">
                            <select name="subjek" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm">
                                <option value="GSBB - Uang">Uang Tunai (Sedekah)</option>
                                <option value="GSBB - Makanan">Porsi Makanan</option>
                                <option value="GSBB - Sembako">Sembako</option>
                            </select>
                        </div>
                        <div x-show="layanan === 'Shohibul Qurban'" class="space-y-4">
                            <select name="jenis_hewan" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm">
                                <option value="Sapi">Sapi</option>
                                <option value="Kambing">Kambing/Domba</option>
                            </select>
                            <select name="tipe_qurban" class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm">
                                <option value="Individu">Individu</option>
                                <option value="Kolektif">Kolektif (1/7 Bagian Per Orang)</option>
                            </select>
                        </div>
                        <textarea name="pesan" placeholder="Keterangan Tambahan..." class="w-full px-5 py-3 border border-slate-200 rounded-2xl text-sm h-24"></textarea>
                        <button type="submit" class="w-full py-4 bg-emerald-600 text-white rounded-2xl font-bold uppercase text-[10px]">Kirim Data</button>
                    </div>
                </template>

                <div class="text-center mt-4">
                    <button type="button" @click="openModal = false" class="text-[10px] font-bold text-slate-400 uppercase">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div x-show="openQris" class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
            <div @click="openQris = false" class="fixed inset-0 transition-opacity bg-slate-900/80 backdrop-blur-md"></div>
            <div class="inline-block w-full max-w-lg p-8 my-8 overflow-hidden text-center align-middle transition-all transform bg-white shadow-2xl rounded-[2.5rem] relative">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 mx-auto mb-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-2 font-display">Infaq & Sedekah Digital</h3>
                
                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-6 mb-8 mt-4">
                    <div class="w-full bg-white mx-auto flex items-center justify-center border border-slate-100 rounded-xl shadow-sm overflow-hidden">
                        <img src="{{ asset('images/qris-masjid.jpeg') }}" alt="QRIS Masjid Al-Munawwaroh" class="w-full h-auto object-contain">
                    </div>
                    <p class="text-[10px] text-slate-400 mt-4 uppercase font-bold tracking-widest">Scan & Konfirmasi Di Bawah</p>
                </div>

                <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-left">
                    @csrf
                    <input type="text" name="nama_donatur" placeholder="Nama Anda (Bisa isi Hamba Allah)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500">
                    <input type="number" name="nominal" required placeholder="Nominal Rp (Tanpa titik/koma)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1 ml-2">Bukti Transfer (JPG/PNG)</label>
                        <input type="file" name="bukti_transfer" required class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-emerald-50 file:text-emerald-700">
                    </div>
                    <div class="flex gap-3 pt-4 font-bold uppercase tracking-widest text-xs">
                        <button type="button" @click="openQris = false" class="flex-1 py-4 text-slate-400">Batal</button>
                        <button type="submit" class="flex-[2] py-4 bg-emerald-600 text-white rounded-2xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">Kirim Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>