<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage; // Model yang kamu gunakan

class ContactController extends Controller
{
    /**
     * Menampilkan daftar pesan di dashboard admin
     */
    public function index()
    {
        // Mengambil pesan terbaru
        $messages = ContactMessage::latest()->get();
        return view('admin.pesan.index', compact('messages'));
    }

    /**
     * Menyimpan pesan dari form kontak (Public)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email',
            'whatsapp'     => 'required|string|max:20',
            'subjek'       => 'required',
            'pesan'        => 'required|string',
        ]);

        // Simpan ke database
        ContactMessage::create($validated); 

        return redirect()->back()->with('success', 'Jazaakumullah! Pesan Anda telah kami terima.');
    }

    /**
     * FITUR BARU: Menghapus pesan dari dashboard admin
     */
    public function destroy($id)
    {
        try {
            // Mencari pesan berdasarkan ID
            $message = ContactMessage::findOrFail($id);
            
            // Proses hapus
            $message->delete();

            return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.pesan.index')->with('error', 'Gagal menghapus pesan.');
        }
    }
}