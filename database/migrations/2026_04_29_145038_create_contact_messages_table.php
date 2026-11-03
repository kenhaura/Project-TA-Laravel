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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap'); // Sesuai label "Nama Lengkap"
            $table->string('email');        // Sesuai label "Alamat Email"
            $table->string('whatsapp');     // Sesuai label "Nomor WhatsApp"
            $table->string('subjek');       // Sesuai dropdown "Subjek"
            $table->text('pesan');          // Sesuai textarea "Pesan"
            $table->boolean('is_read')->default(false); // Tambahan untuk manajemen di dashboard admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};