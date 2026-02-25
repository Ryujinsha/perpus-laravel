<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@librarypoint.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Ruang Server Perpustakaan Lt. 2',
        ]);

        User::create([
            'name' => 'Siswa Teladan',
            'email' => 'siswa@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
            'phone' => '089876543210',
            'address' => 'Jl. Pendidikan No. 1, Jakarta',
        ]);

        Buku::create([
            'code' => 'B001',
            'title' => 'Filosofi Teras',
            'author' => 'Henry Manampiring',
            'publisher' => 'Kompas',
            'publication_year' => 2019,
            'stock' => 5,
            'synopsis' => 'Buku yang mengajarkan penerapan stoisisme dalam kehidupan sehari-hari yang penuh tekanan.',
            'cover_image' => null,
        ]);
        
        Buku::create([
            'code' => 'B002',
            'title' => 'Laravel 12 for Beginners',
            'author' => 'Taylor Otwell',
            'publisher' => 'Laracasts',
            'publication_year' => 2025,
            'stock' => 10,
            'synopsis' => 'Panduan lengkap membangun aplikasi web modern dengan PHP.',
            'cover_image' => null, 
        ]);
    }
}