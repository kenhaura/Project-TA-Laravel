<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     * Kita masukkan 'slug' dan 'cover_image' untuk menghindari error SQL.
     */
    protected $fillable = [
        'title',
        'slug',
        'date',
        'cover_image'
    ];

    /**
     * Relasi One-to-Many ke AlbumPhoto.
     * Satu album memiliki banyak foto dokumentasi.
     */
    public function photos()
    {
        return $this->hasMany(AlbumPhoto::class, 'album_id');
    }
}