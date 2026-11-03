<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            // Jenis layanan: GSBB, Shohibul Qurban, Mualaf Center, atau Zakat Corner
            $table->string('jenis_layanan'); 
            
            // Data Jamaah
            $table->string('nama_lengkap');
            $table->string('nomor_hp');
            
            // Detail tambahan (misal: alamat untuk GSBB atau alasan mendaftar)
            $table->text('detail_permohonan')->nullable(); 
            
            // Status pengajuan
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};