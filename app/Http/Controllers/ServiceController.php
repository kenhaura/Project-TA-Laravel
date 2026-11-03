<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\MasjidBank;
use App\Models\Album; 
use App\Models\Information;
use App\Models\ServiceRegistration; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        // --- 1. LOGIKA YOUTUBE API ---
        $videos = [];
        try {
            $response = Http::timeout(5)->get("https://www.googleapis.com/youtube/v3/search", [
                'key'             => env('YOUTUBE_API_KEY'),
                'channelId'       => env('YOUTUBE_CHANNEL_ID'),
                'part'            => 'snippet,id',
                'order'           => 'date',
                'maxResults'      => 10, 
                'type'            => 'video',
                'videoEmbeddable' => 'true',
            ]);
            $videos = $response->successful() ? $response->json()['items'] : [];
        } catch (\Exception $e) {
            \Log::error("YouTube API Error: " . $e->getMessage());
        }

        // --- 2. LOGIKA TRANSPARANSI KEUANGAN ---
        $totalDonasiDigital = Donation::where('status', 'success')->sum('amount');
        $dataBank = MasjidBank::latest()->first();
        
        $kasFisik = $dataBank ? $dataBank->total_kas_fisik : 0;
        $pengeluaran = $dataBank ? $dataBank->total_pengeluaran : 0;
        
        $totalSaldoSekarang = ($totalDonasiDigital + $kasFisik) - $pengeluaran;

        // --- 3. DATA LAINNYA ---
        $albums = Album::withCount('photos')->latest('date')->take(2)->get();
        $informations = Information::latest('date')->get();

        return view('welcome', compact(
            'videos',
            'totalDonasiDigital', 
            'kasFisik', 
            'pengeluaran', 
            'totalSaldoSekarang',
            'albums',
            'informations'
        ));
    }

    public function gallery()
    {
        $albums = Album::withCount('photos')->latest('date')->get();
        return view('gallery', compact('albums'));
    }

    /**
     * Menyimpan Pendaftaran Layanan
     */
    public function store(Request $request)
    {
        $request->validate([
            'subjek_utama' => 'required',
            'nama_lengkap' => 'required|string|max:255',
            'whatsapp'     => 'required|string|max:20',
        ]);

        $payloadData = [];

        // Gunakan sinkronisasi nama yang fleksibel agar data lama & baru tetap masuk
        switch ($request->subjek_utama) {
            case 'Program GSBB':
                $payloadData = $request->only(['subjek', 'pesan']);
                break;

            case 'Shohibul Qurban':
                $payloadData = $request->only(['jenis_hewan', 'tipe_qurban', 'pesan']);
                break;

            case 'Layanan Mualaf':
            case 'Mualaf Center':
                // Tambahkan 'alamat' agar tersimpan di payload
                $payloadData = $request->only(['nik', 'jenis_kelamin', 'agama_asal', 'ttl', 'pekerjaan', 'alamat', 'pelatihan', 'pesan']);
                break;
                
            case 'Zakat & Wakaf':
            case 'Zakat Corner':
                // Sesuaikan dengan name="nama_muzakki" di HTML kamu
                $payloadData = [
                    'nama_muzakki' => $request->nama_muzakki,
                    'nominal'      => $request->nominal,
                    'pesan'        => $request->pesan ?? 'Konfirmasi Zakat/Wakaf'
                ];
                break;
        }

        $registration = new ServiceRegistration();
        $registration->nama_lengkap = $request->nama_lengkap;
        $registration->whatsapp     = $request->whatsapp;
        $registration->jenis_layanan = $request->subjek_utama;
        $registration->payload       = $payloadData;

        // Upload Handling
        if ($request->hasFile('file_ikrar')) {
            $path = $request->file('file_ikrar')->store('documents/mualaf', 'public');
            $registration->file_path = $path;
        } elseif ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('documents/zakat', 'public');
            $registration->file_path = $path;
        }

        $registration->save();

        return back()->with('success', 'Pendaftaran ' . $request->subjek_utama . ' berhasil dikirim!');
    }

    public function adminIndex()
    {
        $registrations = ServiceRegistration::latest()->get();
        return view('admin.layanan.index', compact('registrations'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $registration = ServiceRegistration::findOrFail($id);
        $registration->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function adminDestroy($id)
    {
        $registration = ServiceRegistration::findOrFail($id);
        
        if ($registration->file_path) {
            Storage::disk('public')->delete($registration->file_path);
        }

        $registration->delete();

        return back()->with('success', 'Data pendaftaran berhasil dihapus!');
    }
}