<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Media Informasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-2xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] p-8 mb-10 border border-slate-100">
                <h2 class="text-lg font-bold mb-6 italic text-emerald-600 uppercase tracking-wider">Tambah Informasi Baru</h2>
                
                <form action="{{ route('admin.information.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Judul Informasi</label>
                        <input type="text" name="title" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Kategori</label>
                        <select name="category" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <option value="Info Kajian">Info Kajian</option>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Program Masjid">Program Masjid</option>
                            <option value="Sosial">Sosial</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Tanggal</label>
                        <input type="date" name="date" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Gambar Banner</label>
                        <input type="file" name="image" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Ringkasan Deskripsi</label>
                        <textarea name="description" rows="3" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="Tulis ringkasan singkat kegiatan..."></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="bg-emerald-600 text-white font-bold py-3.5 px-10 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100 hover:shadow-emerald-200 w-fit">
                            PUBLIKASIKAN INFO
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500 tracking-wider">Gambar</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500 tracking-wider">Judul</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500 tracking-wider">Kategori</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500 tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($informations as $info)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-8 py-4">
                                    <img src="{{ asset('storage/' . $info->image) }}" class="w-20 h-14 object-cover rounded-2xl shadow-sm border border-slate-100">
                                </td>
                                <td class="px-8 py-4">
                                    <div class="text-sm font-bold text-slate-800">{{ $info->title }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium">{{ \Carbon\Carbon::parse($info->date)->format('d M Y') }}</div>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="bg-emerald-50 text-emerald-600 px-4 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                        {{ $info->category }}
                                    </span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <form action="{{ route('admin.information.destroy', $info->id) }}" method="POST" onsubmit="return confirm('Hapus informasi ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-500 font-bold text-xs hover:text-rose-700 transition hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center text-slate-400 italic text-sm">
                                    Belum ada informasi yang dipublikasikan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>