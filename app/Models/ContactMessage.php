<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * Secara default Laravel akan menganggap tabelnya bernama contact_messages.
     */
    protected $table = 'contact_messages';

    /**
     * Atribut yang dapat diisi secara massal.
     * Ini harus sesuai dengan kolom yang ada di migration Anda.
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'whatsapp',
        'subjek',
        'pesan',
    ];
}