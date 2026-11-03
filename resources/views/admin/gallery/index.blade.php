<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Manajemen Galeri</h2>
                    <p class="text-sm text-slate-400 mt-1 italic">Dokumentasikan setiap kegiatan Masjid Jami' Al-Munawwaroh</p>
                </div>
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl">📸</div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Total Album</p>
                        <p class="text-lg font-bold text-slate-800 leading-none">{{ $albums->count() }}</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-bold flex items-center gap-3">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 sticky top-8">
                        <h4 class="text-xs font-bold text-slate-800 mb-6 uppercase tracking-widest flex items-center gap-2">
                            <span>📝</span> Tambah Album Baru
                        </h4>

                        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 ml-1">Judul Kegiatan</label>
                                <input type="text" name="title" required placeholder="Misal: Kajian Rutin Ahad" 
                                    class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm">
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 ml-1">Tanggal Kegiatan</label>
                                <input type="date" name="date" required 
                                    class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500 transition text-sm text-slate-600">
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 ml-1">Pilih Foto (Bisa banyak)</label>
                                <div class="relative group">
                                    <input type="file" name="images[]" multiple required 
                                        class="w-full text-xs text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition cursor-pointer">
                                </div>
                                <p class="text-[9px] text-slate-400 mt-2 italic">*Pilih semua foto kegiatan sekaligus saat upload.</p>
                            </div>

                            <button type="submit" class="w-full py-4 bg-emerald-600 text-white rounded-2xl font-bold uppercase text-[10px] tracking-widest hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition-all duration-300">
                                Publikasikan Album
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-8 border-b border-slate-50">
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-widest flex items-center gap-2">
                                <span>📂</span> Daftar Dokumentasi
                            </h4>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50">
                                    <tr>
                                        <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Album / Kegiatan</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Foto</th>
                                        <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($albums as $album)
                                        <tr class="hover:bg-slate-50/30 transition">
                                            <td class="px-8 py-5">
                                                <p class="text-sm font-bold text-slate-800">{{ $album->title }}</p>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="text-[11px] text-slate-500 font-medium">
                                                    {{ \Carbon\Carbon::parse($album->date)->translatedFormat('d M Y') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-2">
                                                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold">
                                                        {{ $album->photos_count }} Foto
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <div class="flex justify-center gap-2">
                                                    <form action="{{ route('admin.gallery.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Hapus album ini? Semua foto di dalamnya akan hilang.')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="w-9 h-9 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition shadow-sm border border-rose-100">
                                                            <i class="fas fa-trash-alt text-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-8 py-12 text-center">
                                                <div class="flex flex-col items-center opacity-30">
                                                    <span class="text-5xl mb-3">🖼️</span>
                                                    <p class="text-sm font-bold text-slate-400 italic">Belum ada dokumentasi yang diunggah.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>