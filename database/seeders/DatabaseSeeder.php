<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Penting untuk enkripsi password

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin untuk Ken
        User::factory()->create([
            'name' => 'Ken Admin',
            'email' => 'ken.haura12@gmail.com',
            'password' => Hash::make('admin123'), // Menggunakan Hash::make lebih disarankan di Laravel terbaru
        ]);

        // Akun test bawaan (opsional, bisa kamu hapus jika tidak perlu)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}