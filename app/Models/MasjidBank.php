<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasjidBank extends Model
{
    use HasFactory;

    protected $table = 'masjid_banks';

    // Tambahkan baris ini agar data kas bisa disimpan
    protected $fillable = [
        'total_kas_fisik',
        'total_pengeluaran',
        'keterangan'
    ];
}