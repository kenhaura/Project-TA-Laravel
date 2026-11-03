<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    /**
     * Properti fillable ini sangat penting untuk mengizinkan "Mass Assignment",
     * sehingga data dari form (Nama, Nominal, Bukti) bisa disimpan ke database.
     */
      protected $fillable = [
        'donator_name',
        'amount',
        'category',
        'bukti_transfer',
        'status',
    ];
}