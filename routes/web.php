<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController; // Tambahkan ini
use App\Http\Controllers\Admin\InformationController;
use Illuminate\Support\Facades\Route;

// --- SISI JAMAAH (PUBLIC) ---
Route::get('/', [ServiceController::class, 'index'])->name('welcome');

// Ubah: Galeri publik sekarang lewat GalleryController agar data Album terpanggil
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// Public Store Routes (Handle Form Input)
Route::post('/layanan/daftar', [ServiceController::class, 'store'])->name('services.store');
Route::post('/donasi/konfirmasi', [DonationController::class, 'store'])->name('donations.store');
Route::post('/kontak/kirim', [ContactController::class, 'store'])->name('kontak.store');


// --- SISI ADMIN (PRIVATE) ---
Route::get('/dashboard', [DonationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // 1. Profil Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. Manajemen Layanan (Mualaf, Zakat, GSBB, Qurban)
    Route::get('/admin/layanan', [ServiceController::class, 'adminIndex'])->name('admin.layanan.index');
    Route::post('/admin/layanan/update/{id}', [ServiceController::class, 'adminUpdate'])->name('admin.layanan.update');
    Route::delete('/admin/layanan/{id}', [ServiceController::class, 'adminDestroy'])->name('admin.layanan.destroy');

    // 3. Manajemen Galeri & Dokumentasi (BARU)
    Route::get('/admin/gallery', [GalleryController::class, 'adminIndex'])->name('admin.gallery.index');
    Route::post('/admin/gallery', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('/admin/gallery/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    // Route untuk melihat detail album
    Route::get('/galeri/{slug}', [GalleryController::class, 'show'])->name('gallery.show');

    // 4. Manajemen Donasi
    Route::patch('/donasi/{id}/verifikasi', [DonationController::class, 'verify'])->name('donations.verify');
    Route::delete('/donasi/{id}', [DonationController::class, 'destroy'])->name('donations.destroy');
    Route::post('/admin/update-kas', [DonationController::class, 'updateKas'])->name('admin.updateKas');

    // 5. Laporan & Dokumen
    Route::get('/admin/laporan/pdf', [LaporanController::class, 'cetakLaporan'])->name('admin.laporan.pdf');

    // 6. Manajemen Pesan Kontak
    Route::get('/admin/pesan', [ContactController::class, 'index'])->name('admin.pesan.index');
    Route::delete('/admin/pesan/{id}', [ContactController::class, 'destroy'])->name('admin.pesan.destroy');

    // 7. Resource Media Informasi (Pengumuman/Berita)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('information', InformationController::class);
    });
});

require __DIR__.'/auth.php';