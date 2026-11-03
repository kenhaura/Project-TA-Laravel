<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'jenis_layanan',
        'nama_lengkap',
        'nomor_hp',
        'detail_permohonan',
        'status'
    ];
}