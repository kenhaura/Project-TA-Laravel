<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumPhoto extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     * Kita masukkan kedua kolom (path dan photo_path) agar sinkron dengan database.
     */
    protected $fillable = [
        'album_id',
        'path',
        'photo_path'
    ];

    /**
     * Relasi ke model Album.
     * Setiap foto merupakan bagian dari satu album tertentu.
     */
    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}