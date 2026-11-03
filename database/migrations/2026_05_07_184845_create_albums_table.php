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
       Schema::create('albums', function (Blueprint $table) {
    $table->id();
    $table->string('title');       // Judul: "Santunan Anak Yatim"
    $table->string('slug');        // URL: "santunan-anak-yatim"
    $table->date('date');         // Tanggal kegiatan
    $table->string('cover_image'); // Foto sampul yang muncul di grid
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
