<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\MasjidBank; // Pastikan model ini sudah dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    /**
     * Menampilkan daftar donasi & data kas di halaman Dashboard Admin
     */
    public function index()
    {
        // Mengambil semua data donasi untuk tabel
        $donations = Donation::latest()->get();
        
        // Mengambil data kas terbaru untuk ringkasan di dashboard (opsional jika ingin ditampilkan)
        $dataBank = MasjidBank::latest()->first();
        
        return view('dashboard', compact('donations', 'dataBank'));
    }

    /**
     * Menyimpan data donasi dari form di Landing Page (Update: Validasi Ketat & Pesan Custom)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_donatur'   => 'required|string|max:255',
            'nominal'        => 'required|numeric|min:1000',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_donatur.required'   => 'Mohon isi nama Anda (bisa isi Hamba Allah).',
            'nominal.required'        => 'Nominal donasi harus diisi.',
            'nominal.numeric'         => 'Nominal harus berupa angka.',
            'nominal.min'             => 'Minimal donasi adalah Rp 1.000.',
            'bukti_transfer.required' => 'Wajib mengunggah bukti transfer.',
            'bukti_transfer.image'    => 'File harus berupa foto/gambar.',
            'bukti_transfer.mimes'    => 'Format gambar harus jpeg, png, atau jpg.',
            'bukti_transfer.max'      => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $path = $request->file('bukti_transfer')->store('bukti_donasi', 'public');

        Donation::create([
            'donator_name'   => $request->nama_donatur, 
            'amount'         => $request->nominal,      
            'category'       => 'Umum',                 
            'bukti_transfer' => $path,
            'status'         => 'pending',
        ]);

        return back()->with('success', 'Alhamdulillah, konfirmasi donasi Anda telah kami terima. Tunggu verifikasi admin ya!');
    }

    /**
     * Memverifikasi donasi (Mengubah status pending menjadi success)
     */
    public function verify($id)
    {
        $donation = Donation::findOrFail($id);
        
        $donation->update([
            'status' => 'success'
        ]);

        return back()->with('success', 'Donasi berhasil diverifikasi dan masuk ke kas!');
    }

    /**
     * Menghapus data donasi
     */
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        
        if ($donation->bukti_transfer) {
            Storage::disk('public')->delete($donation->bukti_transfer);
        }

        $donation->delete();

        return back()->with('success', 'Data donasi berhasil dihapus!');
    }

    /**
     * Fitur Baru: Memperbarui Saldo Kas Fisik & Pengeluaran Masjid
     */
    public function updateKas(Request $request)
    {
        $request->validate([
            'total_kas_fisik'   => 'required|numeric|min:0',
            'total_pengeluaran' => 'required|numeric|min:0',
        ], [
            'total_kas_fisik.required'   => 'Total kas fisik harus diisi.',
            'total_pengeluaran.required' => 'Total pengeluaran harus diisi.',
            'total_kas_fisik.numeric'     => 'Input kas harus berupa angka.',
            'total_pengeluaran.numeric'   => 'Input pengeluaran harus berupa angka.',
        ]);

        MasjidBank::create([
            'total_kas_fisik'   => $request->total_kas_fisik,
            'total_pengeluaran' => $request->total_pengeluaran,
            'keterangan_pengeluaran' => $request->keterangan ?? 'Update Kas Rutin',
        ]);

        return back()->with('success', 'Data keuangan masjid berhasil diperbarui!');
    }
}