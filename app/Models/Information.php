<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan kolom diisi
    protected $fillable = [
        'title',
        'category',
        'image',
        'date',
        'description',
    ];
}