<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Layanan & Kemaslahatan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openDetail: false, activeItem: { payload: {} } }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-4">
                    <div class="bg-slate-100 p-4 rounded-2xl text-2xl">📋</div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Total Pendaftar</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $registrations->count() }}</p>
                    </div>
                </div>
                <div class="bg-emerald-50 p-6 rounded-[2rem] border border-emerald-100 flex items-center gap-4">
                    <div class="bg-emerald-100 p-4 rounded-2xl text-2xl">⏳</div>
                    <div>
                        <p class="text-emerald-600 text-[10px] font-bold uppercase tracking-widest">Menunggu Proses</p>
                        <p class="text-2xl font-bold text-emerald-700">{{ $registrations->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-100">
                <div class="p-8 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-2xl shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500 tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500 tracking-wider">Layanan</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500 tracking-wider">Nama Jamaah</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500 tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase text-slate-500 tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($registrations as $item)
                                    <tr class="hover:bg-slate-50 transition cursor-pointer">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500" @click="openDetail = true; activeItem = {{ json_encode($item) }}">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap" @click="openDetail = true; activeItem = {{ json_encode($item) }}">
                                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase
                                                {{ $item->jenis_layanan == 'Mualaf Center' ? 'bg-orange-100 text-orange-600' : 
                                                   ($item->jenis_layanan == 'Shohibul Qurban' ? 'bg-blue-100 text-blue-600' : 'bg-emerald-100 text-emerald-600') }}">
                                                {{ $item->jenis_layanan }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-800" @click="openDetail = true; activeItem = {{ json_encode($item) }}">
                                            {{ $item->nama_lengkap }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-[10px] font-bold uppercase" @click="openDetail = true; activeItem = {{ json_encode($item) }}">
                                            <span class="{{ $item->status == 'pending' ? 'text-amber-500' : ($item->status == 'diproses' ? 'text-blue-500' : 'text-emerald-500') }}">
                                                ● {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right flex justify-end gap-3 items-center">
                                            <button @click="openDetail = true; activeItem = {{ json_encode($item) }}" class="text-emerald-600 font-bold hover:underline text-xs tracking-widest uppercase">
                                                Detail
                                            </button>

                                            <form action="{{ route('admin.layanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-500 hover:text-rose-700 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                                            Belum ada pendaftaran layanan saat ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="openDetail" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openDetail = false"></div>

                <div class="relative bg-white rounded-[2.5rem] shadow-2xl max-w-lg w-full p-8 overflow-hidden transform transition-all">
                    <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900" x-text="'Detail ' + activeItem.jenis_layanan"></h3>
                            <p class="text-xs font-bold text-emerald-600 uppercase mt-1" x-text="activeItem.nama_lengkap"></p>
                        </div>
                        <button @click="openDetail = false" class="text-slate-300 hover:text-slate-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 text-sm font-bold">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">WhatsApp</span>
                            <a :href="'https://wa.me/' + (activeItem.whatsapp ? activeItem.whatsapp.replace(/\D/g,'') : '')" target="_blank" class="text-emerald-600 hover:underline" x-text="activeItem.whatsapp"></a>
                        </div>

                        <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100">
                            <h4 class="text-[10px] font-bold text-slate-400 uppercase mb-4 tracking-widest text-center italic border-b border-slate-200 pb-2">Informasi Detail Layanan</h4>
                            <div class="space-y-3">
                                <template x-for="(value, key) in activeItem.payload" :key="key">
                                    <template x-if="value && value !== ''">
                                        <div class="flex justify-between gap-4 py-1 border-b border-slate-100 last:border-0">
                                            <span class="text-[11px] text-slate-500 font-medium capitalize" x-text="key.replace(/_/g, ' ') + ':'"></span>
                                            <span class="text-[11px] text-slate-800 font-bold text-right" x-text="value"></span>
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>

                        <template x-if="activeItem.file_path">
                            <a :href="'/storage/' + activeItem.file_path" target="_blank" 
                               class="flex items-center justify-center gap-2 w-full py-4 bg-blue-50 text-blue-600 rounded-2xl font-bold text-[10px] uppercase tracking-widest hover:bg-blue-100 transition border border-blue-100 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Lihat Lampiran Dokumen
                            </a>
                        </template>
                    </div>

                    <form :action="'/admin/layanan/update/' + activeItem.id" method="POST" class="flex gap-2">
                        @csrf
                        <select name="status" x-model="activeItem.status" class="flex-1 px-4 py-3 bg-white border border-slate-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm">
                            <option value="pending">Pending</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>