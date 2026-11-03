<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRegistration extends Model
{
    use HasFactory;

    // 1. Daftarkan kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama_lengkap',
        'whatsapp',
        'jenis_layanan',
        'payload',
        'file_path',
        'status'
    ];

    // 2. INI KUNCINYA: Casting kolom payload agar otomatis jadi JSON/Array
    protected $casts = [
        'payload' => 'array',
    ];
}