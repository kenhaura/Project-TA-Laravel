<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    // Tampilkan halaman daftar informasi di admin
    public function index()
    {
        $informations = Information::latest()->get();
        return view('admin.information.index', compact('informations'));
    }

    // Simpan informasi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
        ]);

        // Upload Gambar ke folder storage/app/public/information
        $imagePath = $request->file('image')->store('information', 'public');

        Information::create([
            'title' => $request->title,
            'category' => $request->category,
            'date' => $request->date,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Informasi berhasil dipublikasikan!');
    }

    // Hapus informasi
    public function destroy(Information $information)
    {
        // Hapus file fisik gambar agar tidak memenuhi storage
        if ($information->image) {
            Storage::disk('public')->delete($information->image);
        }
        
        $information->delete();

        return back()->with('success', 'Informasi berhasil dihapus!');
    }
}