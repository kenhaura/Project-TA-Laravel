<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-emerald-900 leading-tight">
                {{ __('Panel Kontrol Admin') }}
            </h2>
            <div class="flex space-x-3 items-center">
                <a href="{{ route('admin.laporan.pdf') }}" class="flex items-center px-5 py-2.5 bg-slate-800 text-white rounded-2xl text-sm font-bold hover:bg-black transition shadow-lg shadow-slate-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Cetak Laporan PDF
                </a>
                <span class="px-4 py-2.5 bg-emerald-50 text-emerald-700 rounded-2xl text-sm font-bold border border-emerald-100">
                    Total Donasi Digital: {{ $donations->count() }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-1">Donasi Digital (Web)</p>
                    <p class="text-xl font-bold text-emerald-600">
                        Rp {{ number_format($donations->where('status', 'success')->sum('amount'), 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-1">Kas Fisik (Kotak Amal)</p>
                    <p class="text-xl font-bold text-slate-800">
                        Rp {{ number_format($dataBank->total_kas_fisik ?? 0, 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-1">Total Pengeluaran</p>
                    <p class="text-xl font-bold text-rose-500">
                        Rp {{ number_format($dataBank->total_pengeluaran ?? 0, 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-emerald-600 p-6 rounded-[2rem] shadow-md border border-emerald-700">
                    <p class="text-emerald-100 text-[10px] font-bold uppercase tracking-widest mb-1">Saldo Akhir</p>
                    <p class="text-xl font-bold text-white">
                        @php
                            $digital = $donations->where('status', 'success')->sum('amount');
                            $fisik = $dataBank->total_kas_fisik ?? 0;
                            $keluar = $dataBank->total_pengeluaran ?? 0;
                            $saldo = ($digital + $fisik) - $keluar;
                        @endphp
                        Rp {{ number_format($saldo, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 mb-8">
                <div class="flex items-center mb-6">
                    <div class="p-3 bg-emerald-50 rounded-2xl mr-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg">Update Kas & Pengeluaran</h3>
                        <p class="text-slate-400 text-xs">Perbarui saldo kotak amal fisik dan catatan pengeluaran masjid.</p>
                    </div>
                </div>

                <form action="{{ route('admin.updateKas') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">Total Kas Fisik</label>
                            <input type="number" name="total_kas_fisik" value="{{ $dataBank->total_kas_fisik ?? '' }}" placeholder="Contoh: 5000000" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-emerald-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">Total Pengeluaran</label>
                            <input type="number" name="total_pengeluaran" value="{{ $dataBank->total_pengeluaran ?? '' }}" placeholder="Contoh: 1200000" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-emerald-500 transition" required>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-2xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                                Simpan Data Keuangan
                            </button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-2 ml-1">Keterangan (Opsional)</label>
                        <input type="text" name="keterangan" placeholder="Contoh: Biaya listrik & renovasi tempat wudhu" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-emerald-500 transition">
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-[2.5rem] border border-slate-100">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-slate-800 text-lg">Konfirmasi Donasi Digital</h3>
                        <span class="text-amber-500 text-xs font-bold bg-amber-50 px-3 py-1 rounded-lg">
                            {{ $donations->where('status', 'pending')->count() }} Perlu Verifikasi
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100">
                                    <th class="py-4 px-4 text-slate-400 uppercase text-[10px] font-bold tracking-widest">Donatur</th>
                                    <th class="py-4 px-4 text-slate-400 uppercase text-[10px] font-bold tracking-widest">Nominal</th>
                                    <th class="py-4 px-4 text-slate-400 uppercase text-[10px] font-bold tracking-widest text-center">Bukti</th>
                                    <th class="py-4 px-4 text-slate-400 uppercase text-[10px] font-bold tracking-widest text-center">Aksi & Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($donations as $donation)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="py-5 px-4">
                                        <div class="font-bold text-slate-700">{{ $donation->donator_name }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $donation->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="py-5 px-4 text-emerald-600 font-bold">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-5 px-4 text-center">
                                        <a href="{{ asset('storage/' . $donation->bukti_transfer) }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition">
                                            🔍 Lihat
                                        </a>
                                    </td>
                                    <td class="py-5 px-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            @if($donation->status == 'pending')
                                                <form action="{{ route('donations.verify', $donation->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-4 py-1.5 bg-amber-100 text-amber-600 rounded-full text-[10px] font-bold uppercase hover:bg-emerald-600 hover:text-white transition shadow-sm">
                                                        Confirm
                                                    </button>
                                                </form>
                                            @else
                                                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-600">
                                                    {{ $donation->status }}
                                                </span>
                                            @endif

                                            <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-rose-50 text-rose-500 rounded-xl hover:bg-rose-500 hover:text-white transition shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($donations->isEmpty())
                        <div class="text-center py-20">
                            <p class="text-slate-400 italic font-medium">Belum ada donasi digital masuk.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>