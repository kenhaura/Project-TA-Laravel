<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesan Masuk (Kontak)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500 tracking-wider">Pengirim</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500 tracking-wider">Kontak</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500 tracking-wider">Subjek & Pesan</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase text-slate-500 tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($messages as $message)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ $message->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-slate-800">{{ $message->nama_lengkap }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-xs text-slate-500">{{ $message->email }}</div>
                                            <div class="text-xs font-bold text-emerald-600">
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->whatsapp) }}" target="_blank" class="hover:underline">
                                                    {{ $message->whatsapp }}
                                                </a>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4" x-data="{ open: false }">
                                            <div class="cursor-pointer group" @click="open = true">
                                                <div class="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition">{{ $message->subjek }}</div>
                                                <div class="text-xs text-slate-400 truncate max-w-xs italic">{{ $message->pesan }}</div>
                                            </div>

                                            <div x-show="open" 
                                                 class="fixed inset-0 z-50 overflow-y-auto" 
                                                 x-transition:enter="transition ease-out duration-300"
                                                 x-transition:enter-start="opacity-0"
                                                 x-transition:enter-end="opacity-100"
                                                 x-cloak>
                                                <div class="flex items-center justify-center min-h-screen px-4">
                                                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"></div>

                                                    <div class="relative bg-white rounded-[2.5rem] shadow-2xl max-w-lg w-full p-8 overflow-hidden transform transition-all">
                                                        <div class="flex justify-between items-start mb-6">
                                                            <div>
                                                                <h3 class="text-xl font-bold text-slate-900">{{ $message->subjek }}</h3>
                                                                <p class="text-xs font-bold text-emerald-600 uppercase mt-1">Dari: {{ $message->nama_lengkap }}</p>
                                                            </div>
                                                            <button @click="open = false" class="text-slate-400 hover:text-slate-600 transition">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                            </button>
                                                        </div>

                                                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 mb-6">
                                                            <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                                                                {{ $message->pesan }}
                                                            </p>
                                                        </div>

                                                        <div class="flex flex-col gap-3">
                                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->whatsapp) }}" target="_blank" 
                                                               class="flex items-center justify-center w-full bg-emerald-600 text-white font-bold py-3 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                                                                Balas via WhatsApp
                                                            </a>
                                                            <button @click="open = false" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('admin.pesan.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-500 font-bold hover:text-rose-700 transition hover:underline text-xs">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                                            Belum ada pesan masuk saat ini.
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
</x-app-layout>