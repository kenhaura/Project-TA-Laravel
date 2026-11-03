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
        Schema::create('service_registrations', function (Blueprint $table) {
            $table->id();
            // Data Dasar Identitas
            $table->string('nama_lengkap');
            $table->string('whatsapp');
            $table->string('jenis_layanan'); // Contoh: Program GSBB, Shohibul Qurban, dll.

            /**
             * Kolom Payload (JSON)
             * Digunakan untuk menyimpan data spesifik tiap layanan 
             * agar database tetap rapi meskipun field inputan berbeda-beda.
             */
            $table->json('payload')->nullable();

            // Kolom File (Untuk Bukti Transfer Zakat atau Dokumen Ikrar Mualaf)
            $table->string('file_path')->nullable();

            // Status Manajemen Layanan
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_registrations');
    }
};