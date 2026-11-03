<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Menampilkan Galeri Utama (Public)
     */
    public function index()
    {
        // Mengambil album terbaru beserta jumlah fotonya
        $albums = Album::withCount('photos')->latest('date')->get();
        return view('gallery', compact('albums'));
    }

    /**
     * Menampilkan Detail Album (Public)
     * Fungsi ini untuk melihat 4 foto atau lebih yang sudah diupload
     */
    public function show($slug)
    {
        // Mencari album berdasarkan slug, jika tidak ada akan muncul 404
        $album = Album::with('photos')->where('slug', $slug)->firstOrFail();
        
        return view('gallery-detail', compact('album'));
    }

    /**
     * Menampilkan Halaman Manajemen Galeri (Admin)
     */
    public function adminIndex()
    {
        $albums = Album::withCount('photos')->latest('date')->get();
        return view('admin.gallery.index', compact('albums'));
    }

    /**
     * Menyimpan Album dan Foto Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date'  => 'required|date',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048' 
        ]);

        $files = $request->file('images');
        $coverPath = $files[0]->store('gallery/covers', 'public');

        $album = Album::create([
            'title'       => $request->title,
            'date'        => $request->date,
            'slug'        => Str::slug($request->title) . '-' . time(),
            'cover_image' => $coverPath,
        ]);

        foreach ($files as $image) {
            $path = $image->store('gallery', 'public');

            AlbumPhoto::create([
                'album_id'   => $album->id,
                'path'       => $path,
                'photo_path' => $path
            ]);
        }

        return back()->with('success', 'Album "' . $album->title . '" berhasil dipublikasikan!');
    }

    /**
     * Menghapus Album beserta Foto-fotonya
     */
    public function destroy($id)
    {
        $album = Album::with('photos')->findOrFail($id);

        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }

        foreach ($album->photos as $photo) {
            $filePath = $photo->photo_path ?? $photo->path;
            
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
        }

        $album->delete();

        return back()->with('success', 'Album dan seluruh file dokumentasi telah dihapus!');
    }
}